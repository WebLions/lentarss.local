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
    public function add_rss($title = '', $description = ''){

        $data = array(
                        'title' => $title,
                        'description' => $description,
                        'date' => date("Y-m-d H:i:s")
                        );
        $query = $this->db->insert('rss', $data);

        return TRUE;


    }
}