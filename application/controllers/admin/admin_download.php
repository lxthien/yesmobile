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
class Admin_download extends CI_Controller {

    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->model('Download_model', 'download_model');
        $this->load->model('Admin_menu_model', 'admin_menu');
        $this->load->model('Download_category_model', 'download_category_model');
        //CK editor        
       $news['id_news_category'] = 1;
       $_SESSION['KCFINDER'] = array();
       $_SESSION['KCFINDER']['disabled'] = false;
       $this->load->library('ckeditor', array('instanceName' => 'CKEDITOR1', 'basePath' => base_url() . "ckeditor/", 'outPut' => true));
        // From validator
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'form'));
//        $this->form_validation->set_rules('meta_title', 'Meta title', 'required');
//        $this->form_validation->set_rules('meta_description', 'Description', 'required');
//        $this->form_validation->set_rules('meta_keywords', 'Keywords', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
//        $this->form_validation->set_rules('link_rewrite', 'Link rewrite', 'required');
    }

    function index() {
        $data['list_items'] = $this->_get_list_downloads();
        //$this->load->view('admin/m_news',$data);
        if(!$this->ion_auth->logged_in()){
    		redirect('panel/login');    	
        }else{
        	
	        $this->load->view('panel/home', $data);
        }
    }

    private function _get_list_downloads() {
        $list_downloads = $this->download_model->read_list();
        return $list_downloads;
    }

    public function save() {
        if (isset($_POST['save'])) {
            @$id_download = $this->input->post('item_id');
            //use to assign back GUI when data invalid
            @$download_input->id = $this->input->post('item_id');
            $download_input->category_id = $this->input->post('category');
            $download_input->name = $this->input->post('name');
           $download_input->meta_title = $this->input->post('meta_title');
           $download_input->meta_description = $this->input->post('meta_description');
           $download_input->meta_keywords = $this->input->post('meta_keywords');
            $download_input->description = $this->input->post('description');
            $download_input->link_rewrite = $this->input->post('link_rewrite');
            $download_input->active = $this->input->post('active');
            $download_input->icon = $this->input->post('icon');
            $download_input->display_home_page = $this->input->post('display_home_page');
            
            if (!$this->form_validation->run()) {
                $data['Cname'] = $this->download_category_model->read_list_id_and_name();
                $data['icons'] = $this->_build_icon_list();
                $data['new_item'] = $download_input;
                $data['error'] = validation_errors();
//                echo validation_errors();
                $this->load->view('panel/home', $data);
            } else {
                $download['category_id'] = $this->input->post('category');
                $download['name'] = $this->input->post('name');
                $download['meta_title'] = $this->input->post('meta_title');
               $download['meta_description'] = $this->input->post('meta_description');
               $download['meta_keywords'] = $this->input->post('meta_keywords');
                $download['description'] = $this->input->post('description');
                $download['link_rewrite'] = $this->input->post('link_rewrite');
                $download['icon'] = $this->input->post('icon');
                
                $active = $this->input->post('active');
                if (trim($active) === '') {
                    $active = FALSE;
                } else {
                    $active = TRUE;
                }
                $download['active'] = $active;

                $display_home_page = $this->input->post('display_home_page');
                if (trim($display_home_page) === ''){
                    $display_home_page = FALSE;                    
                } else {
                    $display_home_page = TRUE;
                }
                $download['display_home_page'] = $display_home_page;
                $id = $this->input->post('item_id');

                $result;
                if (isset($id_download) && trim($id_download) !== "") {
                    $download['id'] = $id;
                    $this->download_model->update($download);
                    redirect(base_url('panel/admin_download'));
                } else {
                	$result = $this->download_model->add($download);
                	if (isset($result)) {
                		if (is_numeric($result) && (!isset($id_download) || trim($id_download) === "")) {
                			redirect(base_url('panel/admin_download/edit') . '/' . $result);
                		} else {
                			show_error($result);
                		}
                	} else {
                		redirect(base_url('panel/admin_download'));
                	}
                }
            }
        } else {
            redirect(base_url('panel/admin_download'));
        }
    }

    public function add() {
        $data['Cname'] = $this->download_category_model->read_list_id_and_name();
//            $this->load->view('admin/AddNews',$data);
//                $news->id = $id;
        $download = new stdClass();
        $download->name = '';
        $download->description = '';
        $download->file_name = '';
        $download->category_id = '';
        $download->downloads = '';
        $download->link_rewrite = '';
        $download->meta_title = '';
        $download->meta_description = '';
        $download->meta_keywords = '';
        $download->icon = "";
        $download->active = 'true';
        $download->display_home_page = 'TRUE';
//        $download->focusable = 'false';
//        $download->news_icon = '';
        $data['new_item'] = $download;
        $data['icons'] = $this->_build_icon_list();
        $this->load->view('panel/home', $data);
    }

    public function edit($id) {
//        $id = $this->uri->rsegment(3);
//        $column = "id_news";
//        $new = array();
        $data['Cname'] = $this->download_category_model->read_list_id_and_name();
        $data['icons'] = $this->_build_icon_list();
        $new_item = $this->download_model->read_by_id($id);
        if (!isset($new_item) && !$new_item) {
            show_error("Download id " . $id . ' not found');
        } else {
            $data['new_item'] = $new_item;
            $this->load->view('panel/home', $data);
        }
    }

    public function delete() {
        $id = $this->input->post('hiddelete');
        $delete_download = $this->download_model->read_by_id($id);
        if (isset($delete_download)) {
            if ($this->delete_uploaded_file($delete_download->file_name)) {
                error_log('Cannot delete file ' . $delete_download->file_name);
            }
            $this->download_model->delete(array('id' => $id));
        } else {
            show_error("Cannot find download item with id " . $id);
        }
        redirect(base_url() . 'panel/admin_download');
    }

//    function do_upload() {
//        $config['upload_path'] = './uploads/';
//        $config['allowed_types'] = 'gif|jpg|png';
//        $config['max_size'] = '100';
//        $config['max_width'] = '1024';
//        $config['max_height'] = '768';
//
//        $this->load->library('upload', $config);
//
//        if (!$this->upload->do_upload()) {
//            $error = array('error' => $this->upload->display_errors());
////			$this->load->view('upload_form', $error);
//        } else {
//            $data = array('upload_data' => $this->upload->data());
////			$this->load->view('upload_success', $data);
//        }
//    }

    public function delete_uploaded_file($file_name) {
        $upload_directory = dirname($_SERVER['SCRIPT_FILENAME']) . UPLOAD_DIR . '/';
        $file_path = $upload_directory . $file_name;
        $success = is_file($file_path) && $file_name[0] !== '.' && unlink($file_path);
//        if ($success) {
//            foreach ($this->options['image_versions'] as $version => $options) {
//                $file = $options['upload_dir'] . $file_name;
//                if (is_file($file)) {
//            unlink($file_path);
//                }
//            }

        /** try to save into db start */
//            $CI = get_instance();
//            $CI->load->model('Image_model', 'image_model');
//
//            $CI->image_model->delete_by_name($file_name);
//
//            /** try to save into db finish */
        return $success;
//        }
    }
    
    private function _build_icon_list(){
        $icons = array ('hinh-dai-dien-1.png'=> "iPhone", 
                        'hinh-dai-dien-2.png' => 'iMac', 
                        'hinh-dai-dien-3.png' => 'iPad');
        return $icons;
    }

}

?>
