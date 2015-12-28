<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rss_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_rss_list( $page , $tag = '')
    {
        $page = empty($page) ? 1 : $page;
        if(!empty($tag)) {
            //$this->db->join('keywords', 'keywords.id_rss=rss.id');
            //$this->db->where('keywords.word', $tag);
            $data = array(
                'title' => $tag,
                'description' => $tag,
                'tag' => $tag
            );
            $this->db->or_like($data);
        }
        //$this->db->order_by('date', 'desc');
        $query = $this->db->get('rss',10,($page-1)*10);
        return $query->result_array();
    }

    public function generate($url)
    {
        $this->db->select('id, title, link, description');
        $this->db->from('rss');
        $this->db->where('link', $url);
        $query = $this->db->get();
        $data['rss'] = $query->result_array();

        $this->db->select('id, title, description, link, img, date');
        //$this->db->from('rss_item');
        $this->db->where('id_rss', $data['rss'][0]['id']);
        $this->db->order_by('date', 'desc');
        $query = $this->db->get('rss_item' ,200, 0);
        $data['rss_item'] = $query->result_array();

        foreach($data['rss_item'] as $k => $v)
        {
            $data['rss_item'][$k]['date'] = date("r", strtotime($v['date']));
        }
        $item_1 = $data['rss_item'];
        $this->db->where('id_rss', $data['rss'][0]['id']);
        $this->db->where('now >', '0');
        $this->db->order_by('date', 'desc');
        $query = $this->db->get('special_item');
        //echo $this->db->last_query();
        $item = $query->result_array();
        $data['rss_item'] = array();
        $data['rss_item'] = $item + $item_1;

        return $data;

    }

    public function add_rss($title = '',$link = '', $description = '', $period = '', $keywords = '', $donors = array()){

        //создаем новую ленту
        $data = array(
                        'title' => $title,
                        'link' => $link,
                        'description' => $description,
                        'tag' => $keywords,
                        'period' => $period,
                        'date' => date("Y-m-d H:i:s")
                        );
        $query = $this->db->insert('rss', $data);
        $rss_id = $this->db->insert_id();

        //записываем ей ключевые слова в отдельную таблицу
        $data = array();
        $keyword = explode(',',$keywords);
        $keywords = array_map('trim',$keyword);
        foreach ($keywords as $keyword) {
            $data[] = array(
                            'id_rss' => $rss_id,
                            'word'=> $keyword
                            );
        }
        $this->db->insert_batch('keywords', $data);

        //записываем доноров ленты
        $data = array();
        foreach ($donors as $key => $donor) {
            $data[] = array(
                'id_rss' => $rss_id,
                'link' => $donor
            );
        }
        $this->db->insert_batch('rss_parser', $data);

        return TRUE;

    }
    public function delete_old_news(){
        $this->db->select('id');
        $query = $this->db->get("rss");
        foreach( $query->result_array() as $row)
        {
            $data = array();
            $this->db->select('id, img');
            $this->db->where('id_rss', $row['id']);
            $this->db->where('special', 0);
            $this->db->order_by('date', 'DESC');
            $query1 = $this->db->get("rss_item",400,200);
            foreach( $query1->result_array() as $rows)
            {
                if($rows['img']!='/images/default.jpg')
                {
                    try
                    {
                        unlink( $_SERVER['DOCUMENT_ROOT'] . $rows['img'] );
                    }catch(Exception $e){
                        //sleep(1);
                        //continue;
                    }
                }
                $data = array('id' => $rows['id']);
                $this->db->flush_cache();
                $this->db->delete('rss_item',$data);
            }

        }

        return true;
    }
    public function delete_rss_news($id = 0){

            $data = array();
            $this->db->select('id, img');
            $this->db->where('id_rss', $id);
            $this->db->where('special', 0);
            $query1 = $this->db->get("rss_item");
            foreach( $query1->result_array() as $rows)
            {
                if($rows['img']!='/images/default.jpg')
                {
                    try
                    {
                        unlink( $_SERVER['DOCUMENT_ROOT'] . $rows['img'] );
                    }catch(Exception $e){
                        //sleep(1);
                        //continue;
                    }
                }
                $data = array('id' => $rows['id']);
                $this->db->flush_cache();
                $this->db->delete('rss_item',$data);
            }

        return true;
    }
    public function update_period_rss(){

        $query = $this->db->query("UPDATE `rss` SET `update` = `update` + 1");

        $this->db->query("UPDATE `special_item` SET `now` = `now` - 1 WHERE `now` > 0 ");

        $this->update_period_special();
        //echo $this->db->last_query();
        return true;
    }

    function update_period_special(){

        $date = DateTime::createFromFormat( "Y-m-d H:i:s", date("Y-m-d H:i:s") );
        $date->modify( "-1 hour" );
        $date = $date->format("Y-m-d H:i:00");
        echo $date;
        $query = $this->db->query(" SELECT DISTINCT `id_spec`, `date`, `period`, `update` FROM `special_item` WHERE `date` = '{$date}'");

        //$data = array();

        foreach ($query->result_array() as $item) {
            $newdate = DateTime::createFromFormat("Y-m-d H:i:s", $item['date']);
            $newdate->modify( "+{$item['period']} hour" );
            $newdate = $newdate->format("Y-m-d H:i:s");

            $data = array( 'date' => $newdate, 'now'=> $item['update'] );
            $this->db->where('id_spec', $item['id_spec']);
            $this->db->update('special_item',$data);
        }

        return true;

    }
    public function view($id)
    {
        $this->db->select('*');
        $this->db->where('rss.id',$id);
        $query = $this->db->get('rss');
        $data['rss'] = $query->result_array();
/*
        $this->db->select('rss_item.title, rss_item.description, rss_item.link, rss_item.img');
        $this->db->from('rss_item');
        $this->db->join('rss_parser','rss_parser.id = rss_item.id_rss_parser');
  */
        $this->db->where('id_rss', $id);
        $this->db->where('period', '0');
        $this->db->order_by('date', 'desc');
        $query = $this->db->get('rss_item', 200, 0);
        //echo $this->db->last_query();
        $item_1 = $query->result_array();

        $this->db->where('id_rss', $id);
        $this->db->where('now >', '0');
        $this->db->order_by('date', 'desc');
        $query = $this->db->get('special_item', 1, 0);
        //echo $this->db->last_query();
        $item = $query->result_array();

        $data['rss_item'] = $item + $item_1;

        return $data;

    }
    public function parser(){
        $rep = 0;
        //include('/simple/simple_html_dom.php');
        $this->update_period_rss();
        $query = $this->db->query('SELECT `rss_parser`.`id` as `id`, `rss_parser`.`id_rss` as `id_rss`, `rss_parser`.`link` as `link`
FROM `rss_parser` LEFT JOIN `rss` ON `rss`.`id`=`rss_parser`.`id_rss`
WHERE `rss`.`update`>=`rss`.`period`');
        //echo $this->db->last_query();
        $result = $query->result();
        //echo "<pre>";
        //print_r($result);
        foreach($result as $row){

            $xml = @simplexml_load_file($row->link);
            if (!$xml) {

                $data = array(
                    'text'=> "Не рабочая лента ".$row->link,
                    'link'=> "/rss/edit/".$row->id_rss,
                    'date'=> date("Y-m-d H:i:s")
                );
                $this->db->insert('error_log', $data);
                continue;
            }

            //echo $row->link;
            //print_r($xml);
            $key = 1;
            foreach($xml as $entry) {
                $data = array();
                foreach($entry->item as $item) {
                    //print_r($item);
                    if( $this->item_check($item, $row->id, $item->link, $key) ) //проверяем запись по всем параметрам
                    {
                        $key = 0;
                        $img = '';
                        preg_match("/.*\/(.*).jpg/", $item->enclosure['url'], $output_array);
                        if(!empty($output_array[1])){
                            $img = $this->resize_img_rss($item);

                        }else{
                            $img = '/images/default.jpg';
                        }
                        $date = DateTime::createFromFormat('D, d M Y H:i:s P', trim($item->pubDate) );
                        $date = $date->format('Y-m-d H:i:s');
                        $data[] = array(
                            'id_rss' => $row->id_rss,
                            'id_rss_parser' => $row->id,
                            'title' => (string) $item->title,
                            'description' => (string) $item->link . " - " . $date,
                            'link' => (string) $item->link,
                            'guid' => (string) $item->guid,
                            'img' => $img,
                            'date' => $date
                        );
                    }
                }
                if(!empty($data))
                {
                    $this->db->insert_batch('rss_item',$data);
                }
            }
            $this->db->where('id',$row->id_rss);
            $this->db->update('rss', array('update'=>0));
            //print_r($data);
            //echo "Gotovo!";
            if($rep != $row->id_rss){
                $rep = $row->id_rss;
                $data = array(
                    'text'=> "Обновлена лента №".$row->id_rss,
                    'link'=> "/rss/edit/".$row->id_rss,
                    'date'=> date("Y-m-d H:i:s")
                );
                $this->db->insert('error_log', $data);
            }

        }
        return true;
    }
    private function image_resize($outfile,$infile,$neww,$newh,$quality) {
        $im=imagecreatefromjpeg($infile);
        $k1=$neww/imagesx($im);
        $k2=$newh/imagesy($im);
        $k=$k1>$k2?$k2:$k1;

        $w=intval(imagesx($im)*$k);
        $h=intval(imagesy($im)*$k);

        $im1=imagecreatetruecolor($w,$h);
        imagecopyresampled($im1,$im,0,0,0,0,$w,$h,imagesx($im),imagesy($im));

        imagejpeg($im1,$outfile,$quality);
        imagedestroy($im);
        imagedestroy($im1);
    }

    /**
     * @param array $item
     * @param string $img
     * @return bool|string
     */
    private function resize_img_rss($item = array(), $img = '')
    {
        //print_r($item->enclosure['url']);

        if(!empty($img))
        {
            //include "/simple/classSimpleImage.php";

            $source = $_SERVER['DOCUMENT_ROOT'] . $img;

            $this->image_resize($source,$source,144,90,100);

            return true;

        }elseif( strpos($item->enclosure['url'], '.jpg') ){
            //echo trim($item->enclosure['url']);
            $dir =  '/images/'. date("Y-m-d");
            $uploaddir = $_SERVER['DOCUMENT_ROOT'] . $dir;

            if( file_exists($uploaddir) === FALSE )
            {
                mkdir($uploaddir, 0750);
            }
            try{
                $remote_image = file_get_contents( trim($item->enclosure['url']) );
            }catch(Exception $e){
                //sleep(1);
                return  '/images/default.jpg';
            }
            $file = time() . "_" . rand(0,2016) . ".jpg"; //новое имя файла
            $uploadfile = $uploaddir . "/" . $file;
            try{
                file_put_contents( $uploadfile, $remote_image);

            }catch(Exception $e){

                return '/images/default.jpg';
            }
            $source = $uploadfile;
            $this->image_resize($source,$source,144,90,100);
            //sleep(1);
            //$this->data['cache_img'] = $dir . "/" . $file;
            return $dir . "/" . $file;

        }else{
            return false;
        }

    }

    private function item_check($item = array(), $rss = '', $link = '', $key = '')
    {
        $data = array();
        $query = $this->db->query("SELECT `id` FROM `rss_item` WHERE `id_rss_parser` = '".$rss."' AND `guid` = '".$item->guid."'");
        if($query->num_rows() > 0)
        {
            return false;
        }
        if( !isset($item->title) || empty($item->title) )
        {
            $data[] = array(
                            'text'=> "Не найден заголовок новости № ".$item->guid,
                            'link'=> "/rss/edit/".$rss,
                            'date'=> date("Y-m-d H:i:s")
                            );
        }
        if( !isset($item->description) || empty($item->description) )
        {
            $data[] = array(
                'text'=> "Не найденно описание новости № ".$item->guid,
                'link'=> "/rss/edit/".$rss,
                'date'=> date("Y-m-d H:i:s")
            );
        }
        if( !isset($item->link) || empty($item->link) )
        {
            $data[] = array(
                'text'=> "Не найдена ссылка на новость № ".$item->guid,
                'link'=> "/rss/edit/".$rss,
                'date'=> date("Y-m-d H:i:s")
            );
        }
        if( !isset($item->pubDate) || empty($item->pubDate) && $key ==1 ) {
            $date = DateTime::createFromFormat('D, d M Y H:i:s P', trim($item->pubDate));
            $date_1 = $date->format('Y-m-d');
            $date_1 = date('Y-m-d');
            $interval = $date_1->diff($date_2);
            if( $interval->format('%a') >= 10)
            {
                $data[] = array(
                    'text'=> "Лента " . $link . " не обновлялась " . $interval->format('%a') . " день.",
                    'link'=> "/rss/edit/".$rss,
                    'date'=> date("Y-m-d H:i:s")
                );
            }
        }
        if(!empty($data))
        {
            $this->db->insert_batch('error_log', $data);

        }
        return true;
    }

    public function add_news($data)
    {
        $id_rss = $data['id_rss'];
        $title = $data['title'];
        $link = $data['link'];
        $description = $data['description'];
        $datetime = $data['datetime'];
        $period = $data['period'];
        $update = $data['update'];

        $dir =  '/images/'. date("Y-m-d");
        $uploaddir = $_SERVER['DOCUMENT_ROOT'] . $dir;

        if( file_exists($uploaddir) === FALSE )
        {
            mkdir($uploaddir, 0750);
        }else{

        }
        //загружаем картинку
        $file = time() . "_" . basename($_FILES['picture']['name']); //новое имя файла
        $uploadfile = $uploaddir . "/" . $file;
        if( @move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile) ){

        }else{
            return false;
        }

        $img = $dir . "/" . $file;

        $this->resize_img_rss( NULL ,$img);
        $data = array();
        foreach ($id_rss as $id) {
            $data[] = array(
                'id_rss' => $id,
                'title' => $title,
                'link' => $link,
                'description' => $description,
                'img' => $img,
                'period' => $period,
                'update' => $update,
                'date' => $datetime
            );
        }
        $this->db->insert_batch('special_item', $data);
        return true;
    }
    public function get_list_rss()
    {
        $query = $this->db->get('rss');
        $data = $query->result_array();
        return $data;
    }
    public function errors()
    {
        $this->db->order_by('date','desc');
        $query = $this->db->get('error_log');
        $data['errors'] = $query->result_array();
        return $data;
    }
    public function data_to_edit($id)
    {
        $this->db->select('*');
        $this->db->where('rss.id',$id);
        $query = $this->db->get('rss');
        $data['rss'] = $query->result_array();

        $this->db->where('id_rss', $id);
        $query = $this->db->get('rss_parser');
        $data['rss_parser'] = $query->result_array();

        $this->db->where('id_rss', $id);
        $query = $this->db->get('keywords');
        $data['keywords'] = $query->result_array();
        $word = $data['keywords'][0]['word'];
        for($i=1; $i < count($data['keywords']); $i++) {
            $word = $word . ", " . $data['keywords'][$i]['word'];
        }
        $data['keywords'] = $word;
        return $data;
    }
    public function delete_rss($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('rss');
        $this->db->where('id_rss', $id);
        $this->db->delete('rss_item');

        $this->db->where('id_rss', $id);
        $this->db->delete('rss_parser');
        return true;
    }
    public function edit_rss($id = '', $title = '',$link = '', $description = '', $period = '', $keywords = '', $donors = array()){

        //создаем новую ленту
        $data = array(
            'title' => $title,
            'link' => $link,
            'description' => $description,
            'tag' => $keywords,
            'period' => $period,
            'date' => date("Y-m-d H:i:s")
        );
        $this->db->where('id', $id);
        $query = $this->db->update('rss', $data);
       // $rss_id = $this->db->insert_id();

        //записываем ей ключевые слова в отдельную таблицу
        $data = array();
        $this->db->where('id_rss', $id);
        $this->db->delete('keywords');

        $keyword = explode(',',$keywords);
        $keywords = array_map('trim',$keyword);
        foreach ($keywords as $keyword) {
            $data[] = array(
                'id_rss' => $id,
                'word'=> $keyword
            );
        }
        $this->db->insert_batch('keywords', $data);

        //записываем доноров ленты
        $data = array();
        $this->db->where('id_rss',$id);
        $query = $this->db->get('rss_parser');
        $result = $query->result_array();
        if(!empty($result[0])){
            foreach ($result as $item) {
                if(in_array($item['link'],$donors)){

                }else{
                    //echo array_search($item['link'],$donors);
                    $this->db->where('id_rss', $id);
                    $this->db->where('link', $item['link']);
                    $this->db->delete('rss_parser');
                }
            }
        }
        foreach ($donors as $key => $donor) {
            $this->db->where('id_rss',$id);
            $this->db->where('link',$donor);
            $query = $this->db->get('rss_parser');
            if($query->num_rows <= 0){
                $data[] = array(
                    'id_rss' => $id,
                    'link' => $donor
                );
            }
        }
        if(!empty($data)){
            $this->db->insert_batch('rss_parser', $data);
        }

        return TRUE;

    }
    public function delete_log()
    {
        $this->db->truncate('error_log');
    }
    public function test_rss($link)
    {
        $xml = @simplexml_load_file($link);
        if (!$xml) {

            echo "Лента не работает";
            exit;
        }

        foreach($xml as $entry) {
            $data = array();
            $i=0;
            foreach($entry->item as $item) {
                $data[] = array(
                    'title' => (string) $item->title,
                    'description' => (string) preg_replace("/<img[^>]+>/i", "", $item->description),
                    'link' => (string) $item->link,
                    'img' => $item->enclosure['url'],
                    'date' => $item->pubDate
                );
                $i++;
                if($i>=5){
                    break;
                }
            }
        }
        return $data;
    }
    public function getRss($id_rss = array())
    {
        $this->db->select('id, title');
        $this->db->or_where_not_in('id',$id_rss);
        $query = $this->db->get('rss');
        $data = $query->result_array();
        return $data;
    }
}








