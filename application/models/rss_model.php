<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rss_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    public function get_rss_list()
    {
        $query = $this->db->get('rss');
        return $query->result_array();
    }
    public function add_rss($title = '', $description = '', $keywords = '', $donors = array()){

        //создаем новую ленту
        $data = array(
                        'title' => $title,
                        'description' => $description,
                        'date' => date("Y-m-d H:i:s")
                        );
        $query = $this->db->insert('rss', $data);

        $rss_id = $this->db->insert_id();
        //записываем ей ключевые слова в отдельную таблицу
        $data = '';
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
        $data = '';
        foreach ($donors as $donor) {
            $data[] = array(
                'id_rss' => $rss_id,
                'link' => $donor
            );
        }
        $this->db->insert_batch('rss_parser', $data);

        return TRUE;

    }
    public function update_period_rss(){
        $data = array(
                        'update' => "'update' + 1"
                        );
        $this->db->update('rss_parser', $data);
        return true;
    }
    public function view($id)
    {
        $this->db->select('*');
        $this->db->where('rss.id',$id);
        $query = $this->db->get('rss');
        $data['rss'] = $query->result_array();

        $this->db->select('rss_item.title, rss_item.description, rss_item.link');
        $this->db->from('rss_item');
        $this->db->join('rss_parser','rss_parser.id = rss_item.id_rss_parser');
        $this->db->where('rss_parser.id_rss', $id);
        $query = $this->db->get();
        //echo $this->db->last_query();
        $data['rss_item'] = $query->result_array();
        //print_r($data);
        return $data;

    }
    public function parser(){
        //include('/simple/simple_html_dom.php');

        $query = $this->db->query('SELECT `id`, `link` FROM `rss_parser` WHERE `period`=`update`');
        //echo $this->db->last_query();
        $result = $query->result();
        echo "<pre>";
        print_r($result);
        foreach($result as $row){
            $xml = simplexml_load_file( $row->link );
            $data = array();
            echo $row->link;
            print_r($xml);
            foreach($xml as $entry) {
                foreach($entry->item as $item) {
                    $data[] = array(
                                    'id_rss_parser' => $row->id,
                                    'title' => (string) $item->title,
                                    'description' => (string) $item->description,
                                    'link' => (string) $item->link
                    );
                }
            }
            $this->db->insert_batch('rss_item',$data);
            $this->db->where('id',$row->id);
            $this->db->update('rss_parser', array('update'=>0));
            print_r($data);
        }
        return true;
    }
}