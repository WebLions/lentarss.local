<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url','html'));
        $this->load->library('form_validation');
    }

    public function index()
    {
       // $this->load->view('welcome_message');
    }
    public function login()
    {
        $this->form_validation->set_rules('login','Login','trim|required|xss_clean');
        $this->form_validation->set_rules('password','Password','trim|required|xss_clean');
        if( $this->form_validation->run() == TRUE )
        {
            $result = $this->user_model->login( $this->input->post('login'), $this->input->post('password') );
            if($result){
                redirect('user/profile');
            }else{
                redirect('login');
            }
        }else{
            $this->load->view('user/header');
            $this->load->view('user/login');
            $this->load->view('user/footer');
        }

    }
    public function logout()
    {
        unset($_SESSION['token']);
        session_destroy();
        redirect('/login','refresh');
    }
    public function profile()
    {
        if($this->data['user_token']){
            $this->load->view('user/header');
            $this->load->view('user/profile');
            $this->load->view('user/footer');
        }else{
            redirect('/login','refresh');
        }

    }

}