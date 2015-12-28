<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'html'));
        $this->load->library('form_validation');
        $this->load->model('rss_model');
    }

    public function checkRss()
    {

        $this->data['rss_item'] = $this->rss_model->test_rss($_POST['link']);
        $this->load->view('ajax/check_rss', $this->data);
    }
    public function getRss()
    {

        $this->data['rss'] = $this->rss_model->getRss($_POST['id_rss']);
        $this->load->view('ajax/getRss', $this->data);
    }
}