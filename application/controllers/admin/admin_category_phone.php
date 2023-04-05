<?php

class Admin_category_phone extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('Product_Category_Model', 'product_category_model');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'form'));
        $this->form_validation->set_rules('title', 'Description', 'xss_clean');
        $this->form_validation->set_rules('url', 'Link', 'xss_clean');
        $this->load->model('services_model');
        $this->load->model('Admin_menu_model', 'admin_menu');
    }

	function index() {
		$data['list_items'] = $this->product_category_model->readListByParentId(NULL);
		$this->load->view('panel/home', $data);
	}

	function add() {
        $category = new stdClass();
		$category->id_parent = '';
        $category->id_news_category="";
		$category->name = '';
        $category->link_rewrite = '';
        $category->meta_title = '';
        $category->meta_description = '';
        $category->meta_keywords = '';
        $category->active = 'true';
        $data['new_item'] = $category;
		
        $categories = $this->news_category_model->read_list();
        $data['options'] = $this->news_category_model->buildTree($categories);

        $this->load->view('panel/home', $data);
	}

    function save() {
        if (isset($_POST['save'])) {
            @$id_news_category = $this->input->post('id');
            
            $object->id = $this->input->post('id');
            $object->name = $this->input->post('name');
            $object->link_rewrite = $this->input->post('link_rewrite');
            
            if (!$this->form_validation->run()) {
                $data['Cname'] = $this->product_category_model->read_list_id_and_name();
                $data['icons'] = $this->_build_icon_list();
                $data['new_item'] = $download_input;
                $data['error'] = validation_errors();
                $this->load->view('panel/home', $data);
            } else {
                $object = array();
                $object['id'] = $this->input->post('id');
                $object['name'] = $this->input->post('name');
                $object['meta_title'] = $this->input->post('meta_title');
                $object['meta_description'] = $this->input->post('meta_description');
                $object['meta_keywords'] = $this->input->post('meta_keywords');
                $object['link_rewrite'] = $this->input->post('link_rewrite');

                //echo 2; die;
                $result;
                if (isset($id_news_category) && trim($id_news_category) !== "") {
                    $this->news_model->update($object);
                    redirect(base_url('panel/admin_category_phone'));
                } else {
                    $result = $this->product_category_model->add($object);
                    if (is_numeric($result)) {
                        redirect(base_url('panel/admin_category_phone'));
                    } else {
                        show_error($result);
                    }
                }
            }
        } else if (isset($_POST['update'])) {
            $object = array();
            $object['id'] = $this->input->post('id');

            $object['name'] = $this->input->post('name');
            $object['meta_title'] = $this->input->post('meta_title');
            $object['meta_description'] = $this->input->post('meta_description');
            $object['meta_keywords'] = $this->input->post('meta_keywords');
            $object['link_rewrite'] = $this->input->post('link_rewrite');

            
            $this->product_category_model->update($object);
            redirect(base_url('panel/admin_category_phone'));
        } else {
            redirect(base_url('panel/admin_category_phone'));
        }
    }

    function edit ($id=0) {
        //$categories = $this->product_category_model->read_list();
        //$data['options'] = $this->product_category_model->buildTree($categories);

        $object = $this->product_category_model->read_by_id($id);
        if (count($object) == 0) {
            show_error("Object id " . $id . ' not found');
        } else {
            $data['new_item'] = $object;
            $this->load->view('panel/home', $data);
        }
    }

    public function delete() {
        $id = $this->input->post('hiddelete');
        $this->news_category_model->delete(array('id_news_category' => $id));
        redirect(base_url() . 'panel/admin_category');
    }
}