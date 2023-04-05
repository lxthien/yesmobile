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
class Product_image extends Admin_Controller {

    //put your code here
    var $data;

    function __construct() {
        parent::__construct();
        $this->load->model('Product_image_model', 'product_image_model');
        $this->load->model('Image_model', 'image_model');
        //$this->load->model('Gallery_category_model', 'gallery_category_model');
        $this->load->helper(array('form', 'url'));
        
        $data = $this->load->get_var('data');
    }

    public function index() {
        $data['pimages'] = $this->product_image_model->read_list();
        if(!$this->ion_auth->logged_in()){
    		redirect('panel/login');    	
        }else{
	        $this->load->view('panel/home', $data);
        }
    }

    public function save() {
        $data = $this->load->get_var('data');
        $this->load->library('form_validation');
        //$this->load->library('upload');
        $rules = array(
            array('field' => 'image_name', 'label' => 'Image name',
                'rules' => 'required|max_length[100]|xss_clean'),
            array('field' => 'image_type', 'label' => 'Image Type', 'rules' => 'max_length[255]|xss_clean'),
            //array('field' => 'link_rewrite', 'label' => 'Link rewrite', 'rules' => 'max_length[255]|xss_clean'),
            array('field' => 'product_id', 'label' => 'Product', 'rules' => 'required')
        );
            
        /*if (!$this->form_validation->run()) {
            $edit_item = array();
            $item->id = $this->input->post('product_image_id');
            $item->image_name = $this->input->post('image_name');
            //$item->description = $this->input->post('gallery_description');
            //$item->link_rewrite = $this->input->post('link_rewrite');
            $item->meta_title = $this->input->post('gallery_meta_title');
            $item->meta_key_words = $this->input->post('gallery_meta_key_words');
            $item->meta_description = $this->input->post('gallery_meta_description');
            $item->active = trim($this->input->post('gallery_active'));
            $item->product_id = $this->input->post('product_id');

            if ($item->active === "") {
                $item->active = 0;
            }
            $edit_item['item'] = $item;
            $edit_item['gallery_categories'] = $this->gallery_category_model->read_list_id_and_name();
            $data['edit_item'] = $edit_item;
            $this->load->view('panel/home', $data);
        } else {
        */    $data = array();
            $pimage = array();
            $id = $this->input->post('image_id');
            //$name = $this->input->post('image_name');
//            echo $this->input->post('gallery_description').'8888';
            $product_id = $this->input->post('product_id');
           // $link_rewrite = $this->input->post('link_rewrite');
            //$meta_title = $this->input->post('gallery_meta_title');
            //$meta_key_words = $this->input->post('gallery_meta_key_words');
            //$meta_description = $this->input->post('gallery_meta_description');
            //$active = $this->input->post('gallery_active');
            //$category_id = $this->input->post('category_id');
            //$category_id = trim($category_id);

            //$pimage['image_name'] = trim($name);
            $pimage['product_id'] = trim($product_id);
            //$gallery['link_rewrite'] = trim($link_rewrite);
            //$gallery['meta_title'] = trim($meta_title);
            //$gallery['meta_key_words'] = trim($meta_key_words);
            //$gallery['meta_description'] = trim($meta_description);
           // $gallery['active'] = trim($this->input->post('gallery_active'));
            //$gallery['category_id'] = $category_id;

    		
            if (!isset($id) || trim($id) === "") {
                $inserted = $this->product_image_model->add($pimage);
                if (is_numeric($inserted)) {
                    $this->session->set_flashdata('message', 'a new entry added!');
                    redirect(base_url('panel/product_image'));
                } else {
                    echo $inserted;
                    var_dump($pimage);
                }
            } else {
                $pimage['id'] = $id;
                $this->product_image_model->update($pimage);
                $this->session->set_flashdata('message', 'Update successly!');
                redirect(base_url('panel/product_image'));
            }
        //}
    }

    public function delete() {
        $image_id = $this->input->post('hiddelete');
        $file_name = $_GET['file'];
        //$images_in_category = $this->image_model->read_list_by_album_id($gallery_id);
//        Delete all image before delete category
        //$this->load->helper("upload.class");
        //$upload_handler = new UploadHandler();
        //foreach ($images_in_category as $image) {
         //   $upload_handler->delete_an_image($image->name);
        //}
        $this->product_image_model->delete_by_id($image_id);
        //$this->product_image_model->delete_by_filename($file_name);
        redirect(base_url() . 'panel/product_image');
    }

    public function edit($product_id) {
        if (is_numeric($product_id)) {
            $selected_pimages = $this->product_image_model->read_list_by_product_id($product_id);
            if (!($selected_pimages)) {
                show_error('product id ' . $product_id . ' not exist');
            } else {
                $edit_item = array();
                $edit_item['item'] = $selected_pimages;
                //$edit_item['gallery_categories'] = $this->gallery_category_model->read_list_id_and_name();
                $data['edit_item'] = $edit_item;
                $data['item'] = $item;
                $this->load->view('panel/home', $data);
            }
        } else {
            redirect('panel');
        }
    }

    public function add() {
    	$item = new stdClass();
        //$edit_item = array();
        $item->id = '';
        $item->image_name = '';
        $item->product_id = '';
        $item->image_type = '';
        //$item->description = '';
        //$item->link_rewrite = '';
        //$item->active = 1;
        //$item->category_id = '';
        //$edit_item['item'] = $item;
        //$edit_item['gallery_categories'] = $this->gallery_category_model->read_list_id_and_name();
        //$data ['edit_item'] = $edit_item;
        $data['item'] = $item;
        $this->load->view('panel/home', $data);
    }

    public function upload() {
//        error_log("Oracle database not available!".$_REQUEST['_method'], 0);
        error_reporting(E_ALL | E_STRICT);
        $pimage = array();
         
		$product_id = $this->input->post('product_id');
		//$product_id1 = $_POST['item_id'];
		$image_name = $this->input->post('image_name');
		$id = $this->input->post('image_id');		
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
        $pimage['product_id'] = trim($product_id);
        $pimage['image_name'] = trim($image_name);
        $inserted = $this->product_image_model->add($pimage);
        if (is_numeric($inserted)) {
            $this->session->set_flashdata('message', 'a new entry added!');
            $this->session->set_flashdata('pimage_id', $inserted);
            $data['pimage_id'] = $inserted;
                    //redirect(base_url('panel/admin_phone/edit/' . $product_id));
            //$this->load->view('panel/home', $data);
        } else {
            echo $inserted;
            var_dump($pimage);
        }
    }

}

?>
