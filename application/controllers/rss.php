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
    public function generate($url)//генерация ленты рсс
    {
        $this->data = $this->rss_model->generate($url);
        $this->load->view('rss.php',$this->data);
    }

    public function index( )
    {
        if($this->data['user_token']){
            $page = isset($_GET['page']) ? $_GET['page'] : '' ;
            $tag = isset($_GET['tag']) ? $_GET['tag'] : '' ;
            $this->data['rss'] = $this->rss_model->get_rss_list( (int) $page, $tag);
            $this->load->view('user/header.php');
            $this->load->view('rss/index.php', $this->data);
            $this->load->view('user/footer.php');
        }

    }
    public function delete_old_news()
    {
        $this->rss_model->delete_old_news();
    }
    public function view( $id )
    {
        if($this->data['user_token'] && isset( $id ) ){
            $this->data = $this->rss_model->view($id);
            $this->load->view('user/header.php');
            $this->load->view('rss/view.php', $this->data);
            $this->load->view('user/footer.php');
        }else{
            redirect('404','refresh');
        }
    }
    public function create()
    {
        if($this->data['user_token']){

            $this->form_validation->set_rules('title','Название','trim|required|xss_clean');
            $this->form_validation->set_rules('link','Ссылка','trim|required|xss_clean');
            $this->form_validation->set_rules('description','Описание','trim|required|xss_clean');
            $this->form_validation->set_rules('period','Описание','trim|required|xss_clean');
            $this->form_validation->set_rules('keywords','Ключеве слова','trim|required|xss_clean');

            if( $this->form_validation->run() == TRUE )
            {
                $result = $this->rss_model->add_rss($this->input->post('title'),
                                                    $this->input->post('link'),
                                                    $this->input->post('description'),
                                                    $this->input->post('period'),
                                                    $this->input->post('keywords'),
                                                    $this->input->post('donors'));
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

    public function parser(){

        $this->rss_model->parser();
    }

    public function errors()
    {
        if( $this->data['user_token'] ){
            $this->data = $this->rss_model->errors();
            $this->load->view('user/header.php');
            $this->load->view('rss/errors.php', $this->data);
            $this->load->view('user/footer.php');
        }else{
            redirect('404','refresh');
        }
    }

    public function create_special_news()
    {
        $this->form_validation->set_rules('title','Название','trim|required|xss_clean');
        $this->form_validation->set_rules('link','Ссылка','trim|required|xss_clean');
        $this->form_validation->set_rules('description','Описание','trim|required|xss_clean');
        $this->form_validation->set_rules('period','Период','trim|required|xss_clean');
        $this->form_validation->set_rules('id_rss','Период','required|xss_clean');
       // $this->form_validation->set_rules('picture','Картинка','trim|required|xss_clean');


        if( $this->form_validation->run() == TRUE )
        {
            $result = $this->rss_model->add_news( $this->input->post() );
            if($result){
                redirect('/rss','refresh');
            }else{
                redirect('/special_rss','refresh');
            }
        }else {
            $this->data['rss'] = $this->rss_model->get_list_rss();
            $this->load->view('user/header.php');
            $this->load->view('rss/special_rss.php', $this->data);
            $this->load->view('user/footer.php');
        }
    }
    public function edit($id)
    {
        if($this->data['user_token']){

            $this->form_validation->set_rules('title','Название','trim|required|xss_clean');
            $this->form_validation->set_rules('link','Ссылка','trim|required|xss_clean');
            $this->form_validation->set_rules('description','Описание','trim|required|xss_clean');
            $this->form_validation->set_rules('period','Описание','trim|required|xss_clean');
            $this->form_validation->set_rules('keywords','Ключеве слова','trim|required|xss_clean');

            if( $this->form_validation->run() == TRUE )
            {
                $result = $this->rss_model->edit_rss($id,$this->input->post('title'),
                    $this->input->post('link'),
                    $this->input->post('description'),
                    $this->input->post('period'),
                    $this->input->post('keywords'),
                    $this->input->post('donors'));
                if($result){
                    redirect('/rss','refresh');
                }else{
                    redirect('/rss/edit/'.$id ,'refresh');
                }
            }else {
                $this->data = $this->rss_model->data_to_edit($id);
                $this->load->view('user/header.php');
                $this->load->view('rss/edit_rss.php', $this->data);
                $this->load->view('user/footer.php');
            }
        }

    }
    public function delete($id)
    {
        if($this->data['user_token'])
        {
            $this->rss_model->delete_rss($id);
            redirect('/rss','refresh');
        }

    }
    public function delete_log()
    {
        if($this->data['user_token'])
        {
            $this->rss_model->delete_log();
            redirect('/errors','refresh');
        }
    }
    public function check()
    {
        if($this->data['user_token'])
        {
            $this->load->view('user/header.php');
            $this->load->view('rss/check_rss.php');
            $this->load->view('user/footer.php');
        }
    }
}