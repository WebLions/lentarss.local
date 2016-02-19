<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rss_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    //Категории
    //Отображение списка категорий
    public function get_category_list( $page )
    {
        $page = empty($page) ? 1 : $page;
        $query = $this->db->get('category',10,($page-1)*10);
        return $query->result_array();
    }
    //Добовление новой категории
    public function add_rss($title = '',$link = '', $description = ''){
        $this->db->where("link",$link);
        if($this->db->count_all_results("category")>0)
        {
            return false;
        }
        //создаем новую категорию
        $data = array(
            'title' => $title,
            'link' => $link,
            'description' => $description,
            'date' => date("Y-m-d H:i:s")
        );
        $this->db->insert('category', $data);
        return true;

    }
    // Редактирование категорий
    // Данные для редактирование
    public function data_to_edit($id)
    {
        $this->db->select('*');
        $this->db->where('id',$id);
        $query = $this->db->get('category');
        $data = $query->result_array();
        return $data;
    }
    // Сохранение редактирования
    public function edit_rss($id = '', $title = '',$link = '', $description = ''){
        $this->db->where("link",$link);
        $this->db->where("id !=",$id);
        if($this->db->count_all_results("category")>0)
        {
            return false;
        }
        //создаем новую ленту
        $data = array(
            'title' => $title,
            'link' => $link,
            'description' => $description,
            'date' => date("Y-m-d H:i:s")
        );
        $this->db->where('id', $id);
        $query = $this->db->update('category', $data);
        // $rss_id = $this->db->insert_id();

        return TRUE;
    }
    //Удаление категории
    public function delete_rss($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('category');

        $this->db->where('category_id', $id);
        $this->db->delete('item');

        return true;
    }
    //Удаление новостей категорий
    public function delete_rss_news($id = 0){

        $this->db->select('item.id, item.img');
        $this->db->where('category_id', $id);
        $this->db->where('special', 0);
        $query1 = $this->db->get("item");
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
            $this->db->delete('item',$data);
        }

        return true;
    }
    //Предпросмотр ленты
    public function view($id)
    {
        /////////////////////////////////////////////////////////////////////
        /*******************************************************************/
        /*-----------------------------------------------------------------*/
        /*-***************************************************************-*/
        /*-*/////////////////////////////////////////////////////////////*-*/
        /*-*/    $this->db->select('id, title, link, description');     /*-*/
        /*-*/    $this->db->where('id', $id);                           /*-*/
        /*-*/    $query = $this->db->get('category',1,0);               /*-*/
        /*-*/    $data['rss'] = $query->row();                          /*-*/


        //-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-//
        $this->db->select('item.id, item.title, item.description, item.link, item.img, item.date, source.mobile, source.title as source, item.now');
        $this->db->join('source','source.id = item.source_id');
        $this->db->join('category_to_source','category_to_source.source_id = item.source_id','left');
        $this->db->where('category_to_source.category_id', $id);
        $this->db->order_by('item.date', 'DESC');
        $this->db->get('item',200,0);
        $subQuery1 = $this->db->last_query();

        $this->db->select('special_item.id, special_item.title, special_item.description, special_item.link, special_item.img, special_item.date ,(NULL) as mobile, (NULL) as source, special_item.now');
        $this->db->join('category_to_special','category_to_special.item_id = special_item.id','left');
        $this->db->where('category_to_special.category_id', $id);
        $this->db->order_by('special_item.date', 'DESC');
        $this->db->get('special_item');
        $subQuery2 = $this->db->last_query();

        $query = $this->db->query("({$subQuery1}) UNION ( {$subQuery2} ) ORDER BY  `date` DESC, `now` ASC LIMIT 0, 200");

        $data['item'] = $query->result_array();
        //-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-//

        return $data;

    }
    //Конец блока категорий

    //Источники
    //Отображение списка источников
    public function getSourceList()
    {
        $query = $this->db->get('source');
        return $query->result_array();
    }
    //Добовление нового источника
    //Список категорий для привязки
    public function getCategoryList()
    {
        $this->db->select('id, title');
        $query = $this->db->get('category');
        return $query->result_array();
    }
    //Добовление нового источника
    public function add_source($post = array()){
        $el = 0;
        foreach ($post['category'] as $item) {
            if($item==$el)
                return false;
            $el = $item;
        }
        //создаем новый источник
        $data = array(
            'title' => trim($post['title']),
            'link' => trim($post['link']),
            'period' => trim($post['period']),
            'mobile' => trim($post['mob_version']),
            'tag' => trim($post['key_words']),
            'date' => date("Y-m-d H:i:s")
        );
        $this->db->insert('source', $data);
        $id = $this->db->insert_id();

        $data = array();
        foreach ($post['category'] as $item) {
            $data[] = array('category_id'=>$item, 'source_id'=>$id);
        }
        $this->db->insert_batch('category_to_source',$data);

        return true;

    }
    //Редактирование источника
    //Получение данных для редактирования
    public function data_to_edit_source($id = 0)
    {
        $this->db->select('*');
        $this->db->where('id',$id);
        $query = $this->db->get('source');
        $data['source'] = $query->row();

        $this->db->select('*');
        $this->db->where('source_id',$id);
        $query = $this->db->get('category_to_source');
        $data['category'] = $query->result_array();

        $this->db->select('*');
        $query = $this->db->get('category');
        $data['categories'] = $query->result_array();

        return $data;
    }
    //Сохранение редактирования
    public function edit_source($id,$post = array()){
        $el = 0;
        foreach ($post['category'] as $item) {
            if($item==$el)
                return false;
            $el = $item;
        }
        $data = array(
            'title' => trim($post['title']),
            'link' => trim($post['link']),
            'period' => trim($post['period']),
            'mobile' => trim($post['mob_version']),
            'tag' => trim($post['key_words']),
            'date' => date("Y-m-d H:i:s")
        );
        $this->db->where('id',$id);
        $this->db->update('source', $data);

        $data = array();
        $this->db->select('*');
        $this->db->where('source_id',$id);
        $query = $this->db->get('category_to_source');
        $result = $query->result_array();
        foreach ($result as $item) {
            if( !array_search($item['category_id'],$post['category']) ){
                $this->db->where('id',$item['id']);
                $this->db->delete('category_to_source');
            }
        }
        $data = array();
        foreach ($post['category'] as $item) {
            if( !array_search($item, $result) ){
                $data[] = array('category_id'=>$item, 'source_id'=>$id);
            }
        }
        $this->db->insert_batch('category_to_source',$data);

        return true;

    }
    //Удаление источника
    public function delete_source($id = 0){

        $this->db->select('id, img');
        $this->db->where('source_id', $id);
        $this->db->where('special', 0);
        $query1 = $this->db->get("item");
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
            $this->db->delete('item',$data);
        }
        $this->db->flush_cache();
        $this->db->where('id', $id);
        $this->db->delete('source');

        $this->db->flush_cache();
        $this->db->where('source_id', $id);
        $this->db->delete('category_to_source');
        return true;
    }
    //Конец блока источников

    //Сам парсер
    public function parser(){
        set_time_limit(9800);
        //Обновили периоды источников
        $this->update_period_rss();

        $this->db->select('source.id as source, source.title as title, source.link as link');
        $this->db->where('source.update >=','source.period');
        $query = $this->db->get('source');

        echo '<meta http-equiv="content-type" content="text/html; charset=UTF-8" />';

        echo "Старт парсера. Найдено " . $query->num_rows() . " лент для обновления<br>";


        foreach($query->result() as $row){

            echo "Парсим {$row->link} <br>";

            $xml = @simplexml_load_file($row->link);
            if (!$xml) {

                $data = array(
                    'text'=> "Не рабочая лента ".$row->link,
                    'link'=> "/rss/edit/".$row->source,
                    'rang'=> "1",
                    'date'=> date("Y-m-d H:i:s")
                );
                $this->db->insert('error_log', $data);
                echo "Лента не работает<br>";
                continue;
            }

            $coll = 0;
            foreach($xml as $entry) {
                $data = array();
                foreach($entry->item as $item) {

                    $title = md5( trim($item->title) );
                    if(empty($item->guid) || $item->guid['isPermaLink']=="true")
                        $item->guid = $title;

                    if( $this->item_check($item, $row->source, $row->title) ) //проверяем запись по всем параметрам
                    {

                        preg_match("/.*\/(.*).jpg/", $item->enclosure['url'], $output_array);
                        //print_r($output_array);
                        if(!empty($output_array[1])){
                            $img = $this->resize_img_rss($item->enclosure['url'], NULL, $row->source);
                        }else{
                            $img = '/images/default.jpg';
                        }
                        $date = DateTime::createFromFormat('D, d M Y H:i:s P', trim($item->pubDate) );
                        $date = $date->format('Y-m-d H:i:s');
                        $coll++;
                        $data[] = array(
                            'source_id' => $row->source,
                            'title' => (string) $item->title,
                            'description' => (string) $row->title . " " . $date,
                            'link' => (string) $item->link,
                            'guid' => (string) $item->guid,
                            'img' => $img,
                            'date' => $date
                        );
                    }else{
                        continue 2;
                    }
                }
                if(!empty($data))
                {
                    $this->db->insert_batch('item',$data);
                    echo "Добавленно {$coll} новых новостей<br>";
                }else{
                    echo "Добавленно {$coll} новых новостей<br>";
                }
            }
            $this->db->where('id',$row->source);
            $this->db->update('source', array('update'=>0));

        }
        echo "Конец парсинга<br>";
/*
        $data = array(
            'text'=> $text,
            'link'=> "/rss/edit/",
            'date'=> date("Y-m-d H:i:s")
        );
        $this->db->insert('error_log', $data);*/

        return true;
    }
    //Нужно обновить периоды перед парсингом
    public function update_period_rss(){

        $this->db->query("UPDATE `source` SET `update` = `update` + 1");

        //$this->db->query("UPDATE `special_item` SET `now` = `now` - 1 WHERE `now` > 0 ");

        $this->update_period_special();
        return true;
    }
    //Обновить периоды спец новостей
    function update_period_special(){

        $query = $this->db->query(" SELECT `id`, `date`, `period`, `update` FROM `special_item` WHERE `period` > '0'");

        foreach ($query->result_array() as $item) {

            $datetime1 = DateTime::createFromFormat("Y-m-d H:i:s", $item['date']);
            $datetime2 = DateTime::createFromFormat( "Y-m-d H:i:s", date("Y-m-d H:i:s") );
            $interval = $datetime1->diff($datetime2);

            if( $interval->format('%h') > $item['period'] )
            {
                $data = array( 'date' => date("Y-m-d H:i:s"), 'now'=> $item['update'] );
                $this->db->where('id', $item['id']);
                $this->db->update('special_item',$data);
            }
        }

        return true;

    }
    //Проверка новости по параметрам
    private function item_check($item = array(), $source, $title)
    {
        $data = array();

        $this->db->where('source_id', $source);
        $this->db->where('guid', (string) $item->guid);
        if( $this->db->count_all_results('item') > 0 )
            return false;

        if( !isset($item->title) || empty($item->title) )
        {
            $data[] = array(
                'text'=> "Не найден заголовок новости № ".$item->guid,
                'link'=> "/rss/edit/".$source,
                'date'=> date("Y-m-d H:i:s")
            );
        }

        if( !isset($item->link) || empty($item->link) )
        {
            $data[] = array(
                'text'=> "Не найдена ссылка на новость № ".$item->guid,
                'link'=> "/rss/edit/".$source,
                'date'=> date("Y-m-d H:i:s")
            );
        }
        if( !isset($item->pubDate) || empty($item->pubDate) ) {

            $data[] = array(
                'text'=> "Не найдена дата на новость № ".$item->guid,
                'link'=> "/rss/edit/".$source,
                'date'=> date("Y-m-d H:i:s")
            );

            $date = DateTime::createFromFormat('D, d M Y H:i:s P', trim($item->pubDate));
            $date_1 = $date->format('Y-m-d');
            $date_2 = date('Y-m-d');
            $interval = $date_1->diff($date_2);
            if( $interval->format('%a') >= 10)
            {
                $data[] = array(
                    'text'=> "Лента " . $title . " не обновлялась " . $interval->format('%a') . " день.",
                    'link'=> "/rss/edit/".$source,
                    'rang'=> "1",
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
    //Ресайз картинки и сохранение
    private function resize_img_rss($item, $img = '', $source)
    {

        if(!empty($img))
        {

            $source = $_SERVER['DOCUMENT_ROOT'] . $img;

            $this->image_resize($source,$source,144,90,100);

            return true;

        }elseif( strpos($item, '.jpg') ){

            $dir =  "/images/{$source}"; //". date("Y-m-d");
            $uploaddir = $_SERVER['DOCUMENT_ROOT'] . $dir;

            if( file_exists($uploaddir) === FALSE ) {
                mkdir($uploaddir, 0750);
            }
            $uploaddir = $uploaddir . "/" . date("Y-m-d");
                if( file_exists($uploaddir) === FALSE )
                    mkdir($uploaddir, 0750);

            $uploaddir = $_SERVER['DOCUMENT_ROOT'] . $dir . "/" . date("Y-m-d");
            $dir = $dir . "/" . date("Y-m-d");
            try{
                $remote_image = file_get_contents( trim($item) );
            }catch(Exception $e){
                //sleep(1);
                echo "не получил картинку";
                return  '/images/default.jpg';
            }
            $file = time() . "_" . rand(0,2016) . ".jpg"; //новое имя файла
            $uploadfile = $uploaddir . "/" . $file;
            try{
                file_put_contents( $uploadfile, $remote_image);

            }catch(Exception $e){
                echo "сохранил на сарвер картинку";
                return '/images/default.jpg';
            }
            $source = $uploadfile;
            $this->image_resize($source,$source,144,90,100);

            return $dir . "/" . $file;

        }else{
            return '/images/default.jpg';
        }

    }
    //Скрипт ресайза
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

    //Генерация новыъ лент
    public function generate($url)
    {
        /////////////////////////////////////////////////////////////////////
        /*******************************************************************/
        /*-----------------------------------------------------------------*/
        /*-***************************************************************-*/
        /*-*/////////////////////////////////////////////////////////////*-*/
        /*-*/    $this->db->select('id, title, link, description');     /*-*/
        /*-*/    $this->db->where('link', $url);                        /*-*/
        /*-*/    $query = $this->db->get('category',1,0);               /*-*/
        /*-*/    $data['rss'] = $query->row();                          /*-*/
        /*-*/    $id = $data['rss']->id;                                /*-*/
        /*-----------------------------------------------------------------*/

        //-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-//
        $this->db->select('item.id, item.title, item.description, item.link, item.img, item.date, source.mobile, source.title as source, item.now');
        $this->db->join('source','source.id = item.source_id');
        $this->db->join('category_to_source','category_to_source.source_id = item.source_id','left');
        $this->db->where('category_to_source.category_id', $id);
        $this->db->order_by('item.date', 'DESC');
        $this->db->get('item',200,0);
        $subQuery1 = $this->db->last_query();

        $this->db->select('special_item.id, special_item.title, special_item.description, special_item.link, special_item.img, special_item.date ,(NULL) as mobile, (NULL) as source, special_item.now');
        $this->db->join('category_to_special','category_to_special.item_id = special_item.id','left');
        $this->db->where('category_to_special.category_id', $id);
        $this->db->order_by('special_item.date', 'DESC');
        $this->db->get('special_item');
        $subQuery2 = $this->db->last_query();

        $query = $this->db->query("({$subQuery1}) UNION ( {$subQuery2} ) ORDER BY  `date` DESC, `now` ASC LIMIT 0, 200");

        $data['item'] = $query->result_array();
        //-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-//
        return $data;
    }

    //Специальные новости
    //Список спец новостей
    public function get_list_spec()
    {
        $query = $this->db->get('special_item');
        return $query->result_array();
    }
    //Создание спец.новости
    //Выбираем категории для спецюновостей
    public function get_list_rss()
    {
        $this->db->select('id, title');
        $query = $this->db->get('category');
        $data = $query->result_array();
        return $data;
    }
    //Список категоий в селект
    public function getRss($id_rss = array())
    {
        $this->db->select('id, title');
        $this->db->or_where_not_in('id',$id_rss);
        $query = $this->db->get('category');
        $data = $query->result_array();
        return $data;
    }
    //Сохранение новой спец.новости
    public function add_news($data)
    {
        $id_rss = $data['id_rss'];
        $title = $data['title'];
        $link = $data['link'];
        $description = $data['description'];
        $datetime = $data['datetime'];
        $period = $data['period'];
        $update = $data['update'];
        $id_spec = time();

        $dir =  '/images/special/'. date("Y-m-d");
        $uploaddir = $_SERVER['DOCUMENT_ROOT'] . $dir;

        if( file_exists($uploaddir) === FALSE )
        {
            mkdir($uploaddir, 0750);
        }

        //загружаем картинку
        $file = time() . "_" . basename($_FILES['picture']['name']); //новое имя файла
        $uploadfile = $uploaddir . "/" . $file;
        if( @move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile) ){

        }else{
            return false;
        }

        $img = $dir . "/" . $file;

        $this->resize_img_rss( NULL, $img, NULL);

        $data = array(
            'title' => $title,
            'link' => $link,
            'description' => $description,
            'img' => $img,
            'period' => $period,
            'update' => $update,
            'date' => $datetime
        );
        $this->db->insert('special_item', $data);
        $news = $this->db->insert_id();
        $data = array();
        foreach ($id_rss as $id) {
            $data[] = array(
                'category_id' => $id,
                'item_id' => $news
            );
        }
        $this->db->insert_batch('category_to_special', $data);

        return true;
    }
    //Редактировние спецюновости
    //Данные для редактирования
    public function special_to_edit($id)
    {
        $this->db->select('*');
        $this->db->where('id',$id);
        $query = $this->db->get('special_item',1,0);
        $data['item'] = $query->row();

        $this->db->select('category.id, category.title');
        $this->db->join('category_to_special','category_to_special.category_id=category.id');
        $this->db->where('category_to_special.item_id',$id);
        $query = $this->db->get('category');
        $data['category'] = $query->result_array();
        return $data;
    }
    //Сохранение редактирования
    public function edit_special($spec, $post)
    {
        $title = $post['title'];
        $link = $post['link'];
        $description = $post['description'];
        $period = $post['period'];
        $update = $post['update'];
        $date = $post['datetime'];
        $id = $post['id_rss'];

        if(!empty($_FILES['picture']['name'])){
            $query = $this->db->query("SELECT `img` FROM `special_item` WHERE `id` = '{$spec}' ");
            $result = $query->row();
            if(file_exists($_SERVER['DOCUMENT_ROOT'] . $result->img ) === true)
            {
                unlink($_SERVER['DOCUMENT_ROOT'] . $result->img);
            }
            $dir =  '/images/special/'. date("Y-m-d");
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
            $this->resize_img_rss( NULL, $img, NULL);


        }
        $query = $this->db->query("SELECT * FROM `special_item` WHERE `id_spec` = '".$spec."' ");
        $result = $query->result_array();

        $data = array(
            'title' => $title,
            'link' => $link,
            'description' => $description,
            'period' => $period,
            'update' => $update,
            'date' => $date,
        );
        if(!empty($img))
            $data['img'] = $img;
        $this->db->where('id', $spec);
        $this->db->update('special_item', $data);

        $this->db->where('item_id', $spec);
        $this->db->delete('category_to_special');

        unset($data);
        foreach ($id as $item) {
            $data[] = array(
                'category_id' => $item,
                'item_id' => $spec
            );
        }
        $this->db->insert_batch('category_to_special', $data);

        return true;
    }
    //Удаление спец новости
    public function delete_special($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get('special_item',1,0);
        $result = $query->row();
        if(file_exists($_SERVER['DOCUMENT_ROOT'] . $result->img ) === true)
        {
            unlink($_SERVER['DOCUMENT_ROOT'] . $result->img);
        }

        $this->db->where('id',$id);
        $this->db->delete('special_item');

        $this->db->where('id',$id);
        $this->db->delete('category_to_special');
        return true;
    }
    //Поднять новость вверх
    public function checkNews($id)
    {

        $this->db->query(" UPDATE `special_item` SET `now` = `update`, `date` = '" . date('Y-m-d H:i:s')."' WHERE `id_spec` = '".$id."' ");

    }
    //Удрать приоритет новости
    public function oncheckNews($id)
    {

        $this->db->query(" UPDATE `special_item` SET `now` = 0 WHERE `id_spec` = '".$id."' ");

    }

    //Страница ошибок
    public function errors($rang = 0)
    {
        $this->db->order_by('date','desc');
        $this->db->where('rang', $rang);
        $query = $this->db->get('error_log', 200, 0);
        $data['errors'] = $query->result_array();
        return $data;
    }
    //Очистка ошибок
    public function delete_log()
    {
        $this->db->truncate('error_log');
    }




    public function get_source_list( $page , $tag )
    {
        $page = empty($page) ? 1 : $page;
        if(!empty($tag)) {
            $data = array(
                'title' => $tag,
                'tag' => $tag
            );
            $this->db->or_like($data);
        }
        $query = $this->db->get('source',10,($page-1)*10);
        return $query->result_array();
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

    //Тестирование ленты
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
                    'img' => isset($item->enclosure['url'])? $item->enclosure['url'] : "/images/default.jpg",
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




}








