<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminNews
 *
 * @author DAU GAU
 */
class Admin_services extends CI_Controller {

    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->model('services_model');
        $this->load->model('Admin_menu_model', 'admin_menu');
        $this->load->model('News_category_model', 'news_category_model');
        $_SESSION['KCFINDER'] = array();
        $_SESSION['KCFINDER']['disabled'] = false;
        $this->load->library('ckeditor', array('instanceName' => 'CKEDITOR1', 'basePath' => base_url() . "ckeditor/", 'outPut' => true));

        // From validator
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->form_validation->set_rules('id_news_category', 'Category', 'required');
    }

    function index($category_id = NULL) {
        
        $categories = $this->news_category_model->read_list();
        $data['options'] = $this->news_category_model->buildTree($categories);
        
        $list_items = $this->services_model->listnews($category_id);
        $news_categories = $this->services_model->getCname();
        $first_item = array ('../' => "Show all");
        $news_categories = $first_item + $news_categories;

        foreach ($list_items as &$item) {
            if (isset($news_categories[$item->id_news_category])) {
                $item->category_name = $news_categories[$item->id_news_category];
            } else {
                $item->category_name = 'Category not found';
            }
        }

        $data['list_items'] = $list_items;
        $data['category_list'] = $news_categories;
        $data ['filter_category'] = $category_id;
        if(!$this->ion_auth->logged_in()){
        	redirect('panel/login');
        } else {
	        $this->load->view('panel/home', $data);
        }
    }

    public function save() {
        if (isset($_POST['save'])) {

            @$news_input->id_language = 1;
            $id_news = $this->input->post('news_id');

            //use to assign back GUI when data invalid
            $news_input->id_news = $this->input->post('news_id');
            $news_input->id_news_category = $this->input->post('id_news_category');
            $news_input->title = $this->input->post('title');
            $news_input->meta_title = $this->input->post('meta_title');
            $news_input->meta_description = $this->input->post('meta_description');
            $news_input->meta_keywords = $this->input->post('meta_keywords');
            $news_input->content = $this->input->post('content');
            $news_input->link_rewrite = $this->input->post('link_rewrite');
            $news_input->active = $this->input->post('active');
            $news_input->focusable = $this->input->post('focus');
            $news_input->news_icon = $this->input->post('news_icon');
            $news_input->price = $this->input->post('price');
            $news_input->time_service = $this->input->post('time_service');
            $news_input->time_repair = $this->input->post('time_repair');
            $news_input->hotline = $this->input->post('hotline');

            if (strlen($id_news) > 0 && $id_news !== COMPANY_INSTRODUCE_NEWS_ID 
            		&& $id_news !== SERVICES
            		&& $id_news !== WARRANTY
            		&& $id_news !== SITE_MAP) {
                $this->form_validation->set_rules('link_rewrite', 'Link rewrite', 'required');
            }

            if (!$this->form_validation->run()) {
                $data['Cname'] = $this->services_model->getCname();
                $data['news'] = $news_input;
                $data['error'] = validation_errors();
                $this->load->view('panel/home', $data);
            } else {
                $id = $this->input->post('news_id');
                if (strlen($id) === 0 || (strlen($id) > 0 && $id !== COMPANY_INSTRODUCE_NEWS_ID 
                		&& $id !== SERVICES
                		&& $id !== WARRANTY
                		&& $id !== SITE_MAP)) {
                    $news['id_news_category'] = $this->input->post('id_news_category');
                    $news['link_rewrite'] = $this->input->post('link_rewrite');
                    $news['news_icon'] = $this->input->post('news_icon');
                    $news['price'] = $this->input->post('price');
                    $news['time_service'] = $this->input->post('time_service');
                    $news['time_repair'] = $this->input->post('time_repair');
                    $news['hotline'] = $this->input->post('hotline');

                    $focus = $this->input->post('focus');
                    if (trim($focus) === '') {
                        $focus = FALSE;
                    } else {
                        $focus = TRUE;
                    }
                    $news['focusable'] = $focus;
                }
                $news['id_language'] = 1;
                $news['title'] = $this->input->post('title');
                $news['meta_title'] = $this->input->post('meta_title');
                $news['meta_description'] = $this->input->post('meta_description');
                $news['meta_keywords'] = $this->input->post('meta_keywords');
                $news['content'] = $this->input->post('content');
                $active = $this->input->post('active');

                if (trim($active) === '') {
                    $active = FALSE;
                } else {
                    $active = TRUE;
                }
                $news['active'] = $active;

                $result;
                if (isset($id_news) && trim($id_news) !== "") {
                    $news['id_news'] = $id;
                    $this->services_model->update($news);
                    redirect(base_url('panel/admin_services'));
                } else { 
                    $result = $this->services_model->add($news);
                    if (is_numeric($result)) {
                        redirect(base_url('panel/admin_services/edit/' . $result));
                    } else {
                        show_error($result);
                    }
                }
            }
        } else {
            redirect(base_url('panel/admin_services'));
        }
    }

    public function add() {
        $categories = $this->news_category_model->read_list();
        $data['options'] = $this->news_category_model->buildTree($categories);

        $data['Cname'] = $this->services_model->getCname();
        $news = new stdClass();
        $news->id_language = 1;
        $news->id_news_category = '';
        $news->title = '';
        $news->meta_title = '';
        $news->meta_description = '';
        $news->meta_keywords = '';
        $news->content = '';
        $news->link_rewrite = '';
        $news->active = 'true';
        $news->focusable = 'false';
        $news->news_icon = '';
        $news->price = '';
        $news->time_service = '';
        $news->time_repair = '';
        $news->hotline = '';
        $data['news'] = $news;
        $this->load->view('panel/home', $data);
    }

    public function edit($id) {
        $categories = $this->news_category_model->read_list();
        $data['options'] = $this->news_category_model->buildTree($categories);

        $column = "id_news";
        $new = array();
        $data['Cname'] = $this->services_model->getCname();
        $news = $this->services_model->read_by_id($id);
        if (!isset($news) && !$news) {
            show_error("News id " . $id . ' not found');
        } else {
            $data['news'] = $news;
            if(!$this->ion_auth->logged_in()){
		    		redirect('panel/login');    	
        	}else{
            	$this->load->view('panel/home', $data);
        	}
        }
    }

    public function delete() {
        $id = $this->input->post('hiddelete');
        $this->services_model->delete(array('id_news' => $id));
        redirect(base_url() . 'panel/admin_services');
    }

}