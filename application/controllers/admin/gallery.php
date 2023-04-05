<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of category
 *
 * @author DAU GAU
 */
class Gallery extends Admin_Controller {

    //put your code here
    var $data;

    function __construct() {
        parent::__construct();
        $this->load->model('Gallery_model', 'gallery_model');
        $this->load->model('Image_model', 'image_model');
        $this->load->model('Gallery_category_model', 'gallery_category_model');
        $this->load->helper(array('form', 'url'));
        $data = $this->load->get_var('data');
    }

    public function index() {
        $data['galleries'] = $this->gallery_model->read_list();
        if(!$this->ion_auth->logged_in()){
    		redirect('panel/login');    	
        }else{
        	
	        $this->load->view('panel/home', $data);
        }
    }

    public function save() {
        $data = $this->load->get_var('data');
        $this->load->library('form_validation');
        $rules = array(
            array('field' => 'gallery_name', 'label' => 'Gallery name',
                'rules' => 'required|max_length[100]|xss_clean'),
            array('field' => 'gallery_description', 'label' => 'Description', 'rules' => 'max_length[255]|xss_clean'),
            array('field' => 'link_rewrite', 'label' => 'Link rewrite', 'rules' => 'max_length[255]|xss_clean'),
            array('field' => 'category_id', 'label' => 'Category', 'rules' => 'required')
        );
        $this->form_validation->set_rules($rules);
        if (!$this->form_validation->run()) {
            $edit_item = array();
            $item->id = $this->input->post('gallery_id');
            $item->name = $this->input->post('gallery_name');
            $item->description = $this->input->post('gallery_description');
            $item->link_rewrite = $this->input->post('link_rewrite');
            $item->meta_title = $this->input->post('gallery_meta_title');
            $item->meta_key_words = $this->input->post('gallery_meta_key_words');
            $item->meta_description = $this->input->post('gallery_meta_description');
            $item->active = trim($this->input->post('gallery_active'));
            $item->category_id = $this->input->post('category_id');

            if ($item->active === "") {
                $item->active = 0;
            }
            $edit_item['item'] = $item;
            $edit_item['gallery_categories'] = $this->gallery_category_model->read_list_id_and_name();
            $data['edit_item'] = $edit_item;
            $this->load->view('panel/home', $data);
        } else {
            $data = array();
            $gallery = array();
            $id = $this->input->post('gallery_id');
            $name = $this->input->post('gallery_name');
//            echo $this->input->post('gallery_description').'8888';
            $description = $this->input->post('gallery_description');
            $link_rewrite = $this->input->post('link_rewrite');
            $meta_title = $this->input->post('gallery_meta_title');
            $meta_key_words = $this->input->post('gallery_meta_key_words');
            $meta_description = $this->input->post('gallery_meta_description');
            $active = $this->input->post('gallery_active');
            $category_id = $this->input->post('category_id');
            $category_id = trim($category_id);

            $gallery['name'] = trim($name);
            $gallery['description'] = trim($description);
            $gallery['link_rewrite'] = trim($link_rewrite);
            $gallery['meta_title'] = trim($meta_title);
            $gallery['meta_key_words'] = trim($meta_key_words);
            $gallery['meta_description'] = trim($meta_description);
            $gallery['active'] = trim($this->input->post('gallery_active'));
            $gallery['category_id'] = $category_id;

            if ($gallery['active'] === "") {
                $gallery['active'] = 0;
            }
            if (!isset($id) || trim($id) === "") {
                $inserted = $this->gallery_model->add($gallery);
                if (is_numeric($inserted)) {
                    $this->session->set_flashdata('message', 'a new entry added!');
                    redirect(base_url('panel/gallery/edit/' . $inserted));
                } else {
                    echo $inserted;
                    var_dump($gallery);
                }
            } else {
                $gallery['id'] = $id;
                $this->gallery_model->update($gallery);
                $this->session->set_flashdata('message', 'Update successly!');
                redirect(base_url('panel/gallery'));
            }
        }
    }

    public function delete() {
        $gallery_id = $this->input->post('hiddelete');
        $images_in_category = $this->image_model->read_list_by_album_id($gallery_id);
//        Delete all image before delete category
        $this->load->helper("upload.class");
        $upload_handler = new UploadHandler();
        foreach ($images_in_category as $image) {
            $upload_handler->delete_an_image($image->name);
        }
        $this->gallery_model->delete_by_id($gallery_id);
        redirect(base_url() . 'panel/gallery');
    }

    public function edit($id) {
        if (is_numeric($id)) {
            $selected_gallery = $this->gallery_model->read_by_id($id);
            if (!($selected_gallery)) {
                show_error('Gallery id ' . $id . ' not exist');
            } else {
                $edit_item = array();
                $edit_item['item'] = $selected_gallery;
                $edit_item['gallery_categories'] = $this->gallery_category_model->read_list_id_and_name();
                $data['edit_item'] = $edit_item;
                $this->load->view('panel/home', $data);
            }
        } else {
            redirect('panel');
        }
    }

    public function add() {
        $edit_item = array();
        $item->id = '';
        $item->name = '';
        $item->description = '';
        $item->link_rewrite = '';
        $item->active = 1;
        $item->category_id = '';
        $edit_item['item'] = $item;
        $edit_item['gallery_categories'] = $this->gallery_category_model->read_list_id_and_name();
        $data ['edit_item'] = $edit_item;
        $this->load->view('panel/home', $data);
    }

    public function upload() {
//        error_log("Oracle database not available!".$_REQUEST['_method'], 0);
        error_reporting(E_ALL | E_STRICT);

        $this->load->helper("upload.class");

        $upload_handler = new UploadHandler();

        header('Pragma: no-cache');
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Content-Disposition: inline; filename="files.json"');
        header('X-Content-Type-Options: nosniff');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: OPTIONS, HEAD, GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: X-File-Name, X-File-Type, X-File-Size');

        switch ($_SERVER['REQUEST_METHOD']) {
            case 'OPTIONS':
                break;
            case 'HEAD':
            case 'GET':
                $upload_handler->get();
                break;
            case 'POST':
                if (isset($_REQUEST['_method']) && $_REQUEST['_method'] === 'DELETE') {
                    $upload_handler->delete();
                } else {
                    $upload_handler->post();
                }
                break;
            case 'DELETE':
                $upload_handler->delete();
                break;
            default:
                header('HTTP/1.1 405 Method Not Allowed');
        }
    }

}

?>
