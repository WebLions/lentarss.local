<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rss extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'html'));
        $this->load->library('form_validation');
        $this->load->model('rss_model');
    }

    public function index()
    {
        if($this->data['user_token']){
            $this->data['rss'] = $this->rss_model->get_rss_list();
            $this->load->view('user/header.php');
            $this->load->view('rss/index.php', $this->data);
            $this->load->view('user/footer.php');
        }

    }
    public function create()
    {
        if($this->data['user_token']){

            $this->form_validation->set_rules('title','Название','trim|required|xss_clean');
            $this->form_validation->set_rules('description','Описание','trim|required|xss_clean');

            if( $this->form_validation->run() == TRUE )
            {
                $result = $this->rss_model->add_rss($this->input->post('title'), $this->input->post('description'));
                if($result){
                    redirect('/rss','refresh');
                }else{
                    redirect('/rss/create','refresh');
                }
            }else {
                $this->load->view('user/header.php');
                $this->load->view('rss/create.php');
                $this->load->view('user/footer.php');
            }
        }

    }

}