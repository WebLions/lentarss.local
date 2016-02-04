<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rss_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function saveCategory($post = array(), $type = "save")
    {
        $data = array(
            'title' => $post['title'],
            'description' => $post['description'],
        );
        $id = isset($post['id'])? $post['id'] : null;
        if($type=="update"&&!empty($id))
        {
            $this->db->where("id",$id);
            $this->db->update("category",$data);
            return true;
        }
        $this->db->insert("category", $data);
        return true;
    }
    public function saveDonor($post = array(), $type = "save")
    {
        $data = array(
            'id_category' => $post['id_category'],
            'title' => $post['title'],
            'description' => $post['description'],
            'link' => $post['link'],
            'period' => $post['period'],
            'mobile' => $post['mobile']
        );
        $id = isset($post['id'])?$post['id']:null;
        if($type=="update"&&!empty($id))
        {
            $this->db->where("id",$id);
            $this->db->update("donors", $data);
            return true;////////-------------------------- продумать по удобнее
        }
        $this->db->insert("donors", $data);
        $id_donor = $this->db->insert_id();
        // ключевые слова в отдельную таблицу
        $data = array();
        $keyword = explode(',',$post['keywords']);
        $keywords = array_map('trim',$keyword);
        foreach ($keywords as $keyword) {
            $data[] = array(
                'id_donor' => $id_donor,
                'word'=> $keyword
            );
        }
        $this->db->insert_batch('keywords', $data);
        return true;
    }

    public function getCategory($id = null)
    {
        if(!empty($id))
        {
            $this->db->where("id",$id);
        }
        $query = $this->db->select();
        return $query->result_array();
    }
    public function deleteCategory($id = 0)
    {
        $this->db->where("id_category", $id);
        $query = $this->db->get("donors", 0, 1);
        if($query->num_rows() <= 0 )
        {
            $this->db->where("id", $id);
            $this->db->delete("category");
            return true;
        }
        return false;
    }
}
