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
    //Категории
    //Отображение списка категорий
    public function index( )
    {
        if($this->data['user_token']){
            $page = isset($_GET['page']) ? $_GET['page'] : '' ;
            $this->data['rss'] = $this->rss_model->get_category_list( (int) $page );
            $this->load->view('user/header.php');
            $this->load->view('rss/index.php', $this->data);
            $this->load->view('user/footer.php');
        }

    }
    //Добовление новой категории
    public function add_category()
    {
        if($this->data['user_token']){

            $this->form_validation->set_rules('title','Название','trim|required|xss_clean');
            $this->form_validation->set_rules('link','Ссылка','trim|required|xss_clean');
            $this->form_validation->set_rules('description','Описание','trim|required|xss_clean');
            $this->data['error']['link'] = "";

            if( $this->form_validation->run() == TRUE ) {
                $result = $this->rss_model->add_rss($this->input->post('title'),
                    $this->input->post('link'),
                    $this->input->post('description'));
                if ($result) {
                    redirect('/rss', 'refresh');
                }else{
                    $this->data['error']['link'] = "Такая ссылка уже существует!";
                }
            }
            $this->load->view('user/header.php');
            $this->load->view('rss/add_category.php',$this->data);
            $this->load->view('user/footer.php');

        }

    }
    // Редактирование категорий
    public function edit($id)
    {
        if($this->data['user_token']){

            $this->form_validation->set_rules('title','Название','trim|required|xss_clean');
            $this->form_validation->set_rules('link','Ссылка','trim|required|xss_clean');
            $this->form_validation->set_rules('description','Описание','trim|required|xss_clean');
            $this->data['error']['link'] = "";

            if( $this->form_validation->run() == TRUE )
            {
                $result = $this->rss_model->edit_rss(
                    $id,
                    $this->input->post('title'),
                    $this->input->post('link'),
                    $this->input->post('description'));
                if($result){
                    redirect('/rss','refresh');
                }else{
                    $this->data['error']['link'] = "Такая ссылка уже существует!";
                }
            }
            $this->data['rss'] = $this->rss_model->data_to_edit($id);
            $this->load->view('user/header.php');
            $this->load->view('rss/edit_rss.php', $this->data);
            $this->load->view('user/footer.php');

        }

    }
    //Удаление категории
    public function delete($id)
    {
        if($this->data['user_token'])
        {
            $this->rss_model->delete_rss($id);
            redirect('/rss','refresh');
        }

    }
    //Удаление новостей категорий
    public function clear($id)
    {
        if($this->data['user_token'])
        {
            $this->rss_model->delete_rss_news($id);
            redirect('/rss','refresh');
        }

    }
    //Предпросмотри новой ленты
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
    //Конец блока категорий

    //Источники
    //Отображение списка источников
    public function source_items()
    {
        if($this->data['user_token'])
        {
            $this->data['source'] = $this->rss_model->getSourceList();
            $this->load->view('user/header.php');
            $this->load->view('rss/source.php', $this->data);
            $this->load->view('user/footer.php');
        }
    }
    //Добовление нового источника
    public function add_source()
    {
        if($this->data['user_token'])
        {
            $this->form_validation->set_rules('title','Название','trim|required|xss_clean');
            $this->form_validation->set_rules('link','Название','trim|required|xss_clean');
            $this->form_validation->set_rules('period','Название','trim|required|xss_clean');

            if( $this->form_validation->run() == TRUE )
            {
                $result = $this->rss_model->add_source($this->input->post());
                if($result){
                    redirect('/rss/source_items','refresh');
                }else{

                }
            }
            $this->data['category'] = $this->rss_model->getCategoryList();

            $this->load->view('user/header.php');
            $this->load->view('rss/add_source.php', $this->data);
            $this->load->view('user/footer.php');

        }
    }
    //Редактирование источника
    public function edit_source($id)
    {
        if($id==0||empty($id))
            redirect('/404','refresh');
        if($this->data['user_token']){

            $this->form_validation->set_rules('title','Название','trim|required|xss_clean');
            $this->form_validation->set_rules('link','Ссылка','trim|required|xss_clean');
            $this->form_validation->set_rules('period','период','trim|required|xss_clean');
            $this->data['error']['link'] = "";

            if( $this->form_validation->run() == TRUE )
            {
                $result = $this->rss_model->edit_source($id,$this->input->post());
                if($result){
                    redirect('/rss/source_items','refresh');
                }else{
                    $this->data['error']['link'] = "Такая ссылка уже существует!";
                }
            }
            $this->data = $this->rss_model->data_to_edit_source($id);
            $this->load->view('user/header.php');
            $this->load->view('rss/edit_source.php', $this->data);
            $this->load->view('user/footer.php');

        }
    }
    //Удаление источника
    public function delete_source($id)
    {
        if($this->data['user_token'])
        {
            $this->rss_model->delete_source($id);
            redirect('/rss/source_items','refresh');
        }

    }
    //Конец блока источников

    //Парсер
    public function parser(){
        $this->rss_model->parser();
    }

    //Генерация новыъ лент
    public function generate($url)//генерация ленты рсс
    {
        $this->data = $this->rss_model->generate($url);
        $this->load->view('rss.php',$this->data);
    }

    //Специальные новости
    //Список спец новостей
    public function special_news()
    {
        if($this->data['user_token'])
        {
            $this->data['news'] = $this->rss_model->get_list_spec();
            $this->load->view('user/header.php');
            $this->load->view('rss/special_news.php', $this->data);
            $this->load->view('user/footer.php');
        }
    }
    //Создание спец.новости
    public function create_special_news()
    {
        $this->form_validation->set_rules('title','Название','trim|required|xss_clean');
        $this->form_validation->set_rules('link','Ссылка','trim|required|xss_clean');
        $this->form_validation->set_rules('description','Описание','trim|required|xss_clean');
        $this->form_validation->set_rules('period','Период','trim|required|xss_clean');
        $this->form_validation->set_rules('id_rss','Период','required|xss_clean');

        if( $this->form_validation->run() == TRUE ) {
            $result = $this->rss_model->add_news($this->input->post());
            if ($result) {
                redirect('/special_news', 'refresh');
            } else {

            }
        }
            $this->data['rss'] = $this->rss_model->get_list_rss();
            $this->load->view('user/header.php');
            $this->load->view('rss/special_rss.php', $this->data);
            $this->load->view('user/footer.php');

    }
    //Редактировние спецюновости
    public function edit_special($id)
    {
        if($this->data['user_token'])
        {
            $this->form_validation->set_rules('title','Название','trim|required|xss_clean');
            if( $this->form_validation->run() == TRUE ) {
                $result = $this->rss_model->edit_special($id, $this->input->post());
                if ($result) {
                    redirect('/special_news', 'refresh');
                }
            }
                $this->data = $this->rss_model->special_to_edit($id);
                $this->load->view('user/header.php');
                $this->load->view('rss/edit_special.php', $this->data);
                $this->load->view('user/footer.php');

        }
    }
    //Удаление спец.новости
    public function delete_special($id){
        if($this->data['user_token'])
        {
            $this->rss_model->delete_special($id);
            redirect('/special_news','refresh');
        }
    }


    //Страница ошибок
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
    //Очистка ошибок
    public function delete_log()
    {
        if($this->data['user_token'])
        {
            $this->rss_model->delete_log();
            redirect('/errors','refresh');
        }
    }


    public function test()
    {
        $this->rss_model->update_period_special();
    }





    public function delete_old_news()
    {
        $this->rss_model->delete_old_news();
    }


    public function source()
    {
        if( $this->data['user_token'] ){
            $this->data = $this->rss_model->errors();
            $this->load->view('user/header.php');
            $this->load->view('rss/source.php', $this->data);
            $this->load->view('user/footer.php');
        }else{
            redirect('404','refresh');
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


    public function add_source_item()
    {
        if($this->data['user_token'])
        {
            $this->load->view('user/header.php');
            $this->load->view('rss/add_source.php');
            $this->load->view('user/footer.php');
        }
    }
}