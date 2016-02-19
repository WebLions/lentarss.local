<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'html'));
        $this->load->library('form_validation');
        $this->load->model('rss_model');
        $this->load->model('ajax_model');
    }

    public function checkRss()
    {

        $this->data['rss_item'] = $this->rss_model->test_rss($_POST['link']);
        $this->data['mobile'] =  $_POST['mobile'];
        $this->load->view('ajax/check_rss', $this->data);
    }
    //Получение списка категорий для спец.новости
    public function getRss()
    {
        $this->data['rss'] = $this->rss_model->getRss($_POST['id_rss']);
        $this->load->view('ajax/getRss', $this->data);
    }
    public function getCategory()
    {
        $this->data['category'] = $this->ajax_model->getCategoryAjax($_POST['category']);
        $this->load->view('ajax/getCategory', $this->data);
    }
    public function checkNews()
    {

        $this->rss_model->checkNews($_POST['id']);
        return true;

    }
    public function oncheckNews()
    {

        $this->rss_model->oncheckNews($_POST['id']);

    }
    public function saveCategory($update = NULL)
    {
        $this->form_validation->set_rules('title','Заголовок','trim|required|xss_clean');
        $this->form_validation->set_rules('description','Описание','trim|required|xss_clean');

        if($this->form_validation->run() == true)
        {
            $this->ajax_model->saveCategory( $this->input->post() , $update );
            $this->data['category'] = $this->rss_model->getCategory();
            $this->load->view('ajax/listCategory');
        }else{
            $this->data['error'] = 1;
        }
        echo json_encode($this->data);
    }
    public function getCategoryInfo()
    {
        $this->data['category'] = $this->ajax_model->getCategoty( $this->input->post['id'] );
        $this->load->view('ajax/categoryInfo', $this->data);
    }
    public function deleteCategory()
    {
        $result = $this->ajax_model->deleteCategory( $this->input->post['id'] );
        if($result){
            $this->data['error'] = 0;
        }else{
            $this->data['error'] = 1;
        }
        echo json_encode($this->data);
    }
    public function saveDonor($update = NULL)
    {
        $this->form_validation->set_rules('title','Заголовок','trim|required|xss_clean');
        $this->form_validation->set_rules('description','Описание','trim|required|xss_clean');
        $this->form_validation->set_rules('link','Ссылка','trim|required|xss_clean');
        $this->form_validation->set_rules('period','Период обновления','trim|required|xss_clean');
        $this->form_validation->set_rules('mobile','Моб. версия','trim|xss_clean');

        if($this->form_validation->run() == true)
        {
            $this->ajax_model->saveDonor( $this->input->post() , $update );
            $this->data['category'] = $this->rss_model->getCategory();
            $this->load->view('ajax/listDonor');
        }else{
            $this->data['error'] = 1;
        }
        echo json_encode($this->data);
    }

}