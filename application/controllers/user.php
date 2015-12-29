<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url','html'));
        $this->load->library('form_validation');
        $this->load->model('rss_model');
    }

    public function index()
    {
       // $this->load->view('welcome_message');
    }
    public function login()
    {
        if($this->data['user_token']) {
            redirect('user/profile');
        }
        $this->form_validation->set_rules('login','Login','trim|required|xss_clean');
        $this->form_validation->set_rules('password','Password','trim|required|xss_clean');
        if( $this->form_validation->run() == TRUE )
        {
            $recaptcha=$this->input->post('g-recaptcha-response');
            if(!empty($recaptcha))
            {
                $google_url="https://www.google.com/recaptcha/api/siteverify";
                $secret=$this->config->item('secret_key_captcha');
                //echo $secret;
                $ip=$_SERVER['REMOTE_ADDR'];
                $url=$google_url."?secret=".$secret."&response=".$recaptcha."&remoteip=".$ip;
                $res= $this->getCurlData($url);
                $res= json_decode($res, true);
                //reCaptcha введена
                if($res['success'])
                {
                    $result = $this->user_model->login( $this->input->post('login'), $this->input->post('password') );
                    if($result){
                        redirect('user/profile');
                    }else{
                        redirect('login');
                    }
                }
                else
                {
                    redirect('login');
                }
            }else{
                redirect('login');
            }
        }else{
            $data['key'] = $this->config->item('publick_key_captcha');
            $this->load->view('user/login_header');
            $this->load->view('user/login',$data);
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
            $this->data = $this->rss_model->errors($rang = 1);
            $this->load->view('user/header');
            $this->load->view('user/profile',$this->data);
            $this->load->view('user/footer');
        }else{
            redirect('/login','refresh');
        }

    }
    public function new_pass()
    {
        $this->form_validation->set_rules('login', 'Логин', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Пароль', 'trim|required|xss_clean');
        if( $this->form_validation->run() == TRUE )
        {
            $this->user_model->new_pass($this->input->post('login'), $this->input->post('password'));
            redirect('/login','refresh');
        }else {
            $this->load->view('user/header.php');
            $this->load->view('user/new_pass.php');
            $this->load->view('user/footer.php');
        }
    }
    function getCurlData($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
        $curlData = curl_exec($curl);
        curl_close($curl);
        return $curlData;
    }

}