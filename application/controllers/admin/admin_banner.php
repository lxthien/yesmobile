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
class Admin_banner extends CI_Controller {

    //put your code here
    var $banner_dir; //= dirname($_SERVER['SCRIPT_FILENAME']) . UPLOAD_DIR . '/logo/';

    function __construct() {
        parent::__construct();
        $this->load->model('Banner_model', 'banner_model');
        // From validator
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'text'));
        $this->form_validation->set_rules('title', 'Description', 'xss_clean');
        $this->form_validation->set_rules('url', 'Link', 'xss_clean');        
//        $this->form_validation->set_rules('position_id', 'Position', 'required|xss_clean');
//        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->banner_dir = dirname($_SERVER['SCRIPT_FILENAME']) . BANNER_PATH;
    }

    function index() {
        $data['list_items'] = $this->_get_list_banners();
        if(!$this->ion_auth->logged_in()){
    		redirect('panel/login');    	
        }else{
        	
	        $this->load->view('panel/home', $data);
        }
    }

    private function _get_list_banners() {
        $list_partners = $this->banner_model->read_list();
        return $list_partners;
    }

    public function save() {
        if (isset($_POST['save'])) {
            $is_error = false;
            $id_banner = $this->input->post('item_id');
            if (!isset($id_banner) || trim($id_banner)===''){
                $this->form_validation->set_rules('image', 'Image', 'callback_handle_upload');
            }
            //use to assign back GUI when data invalid
            @$banner_input->id = $this->input->post('item_id');
            $banner_input->title = $this->input->post('title');
            $banner_input->url = $this->input->post('url');
            $banner_input->active = $this->input->post('active');
//            $banner_input->position_id = $this->input->post('position_id');
            if (!$this->form_validation->run()) {
                $banner_input->image = '';
                $data['new_item'] = $banner_input;                
                $data['error'] = validation_errors();
//                echo validation_errors();
                $this->load->view('panel/home', $data);
            } else {
                $banner['title'] = $this->input->post('title');
                $banner['url'] = $this->input->post('url');
                if (strlen($banner['url']) > 0) {
                    $parsed_url = parse_url($banner['url']);
                    if (empty($parsed_url['scheme'])) {
                        $url_str = "http://" . $banner['url'];
                        $banner['url'] = $url_str;
                    }
                }
                $active = $this->input->post('active');
                if (trim($active) === '') {
                    $active = FALSE;
                } else {
                    $active = TRUE;
                }
                $banner['active'] = $active;

//                $id = $this->input->post('item_id');
                $result;
                /* Start upload file */
                if (count($_FILES) > 0 && $_FILES['image']['error'] !== 4) {

                    $config['upload_path'] = $this->banner_dir;
//                    echo $this->banner_dir;die;
                    $config['allowed_types'] = 'gif|jpg|png';
//                    $file_name = preg_replace('/[^a-zA-Z]/', '', ucwords($banner['title']));
//                    $config['file_name'] = $file_name;
                    $config['encrypt_name'] = TRUE;
                    $config['overwrite'] = TRUE;
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('image')) {
//                        echo 'Có lỗi upload: ';
                        $banner_input->image = '';
                        $data['error'] =$this->upload->display_errors();                        
                        $data['new_item'] = $banner_input;
                        $data_upload = $this->upload->data();
//                        echo $data_upload['file_type'] . '<br>';                    
                        $is_error = TRUE;
                        $this->load->view('panel/home', $data);                        
                    } else {
                        $data_upload = array('upload_data' => $this->upload->data());
//                        echo count($data_upload);
                        if (count($data_upload) > 0) {
                            $uploaded_file = $data_upload["upload_data"];
                            $banner['image'] = $uploaded_file['file_name'];
//                            var_dump($data_upload);
//                        var_dump($download);
                        } else {
                            $is_error = TRUE;
                            show_error("Have error when upload file");
                        }
                    }
                }
                /* End upload file */
                if (!$is_error) {
                if (isset($id_banner) && trim($id_banner) !== "") {
                    $banner['id'] = $id_banner;
                    if ($id_banner === '1'){
                        $banner['position_id']  = 1;
                    }
                    $this->banner_model->update($banner);
                } else {                    
                    $result = $this->banner_model->add($banner);
                }
                if (isset($result)) {
                    if (is_numeric($result) && (!isset($id_banner) || trim($id_banner) === "")) {
                        redirect(base_url('panel/admin_banner/edit') . '/' . $result);
                    } else {
                        $is_error = TRUE;
                        show_error($result);
                    }
                } else {
                    redirect(base_url('panel/admin_banner'));
                } 
               }
            }
        } else {
            redirect(base_url('panel/admin_banner'));
        }
    }

    public function add() {

        @$banner->title = '';
        $banner->url = '';
        $banner->image = '';
        $banner->active = 'true';
        $data['new_item'] = $banner;
        $this->load->view('panel/home', $data);
    }

    public function edit($id) {
        $new_item = $this->banner_model->read_by_id($id);
        if (!isset($new_item) && !$new_item) {
            show_error("Advertise id " . $id . ' not found');
        } else {
            $data['new_item'] = $new_item;
            $this->load->view('panel/home', $data);
        }
    }

    public function delete() {
        $id = $this->input->post('hiddelete');
        
        if (!isset($id) || strlen($id) === 0) {
            show_error('Cannot get banner to delete');
        } else {
            $delete_banner = $this->banner_model->read_by_id($id);
            if (isset($delete_banner)) {
                if ($this->delete_uploaded_file($delete_banner->image)) {
                    error_log('Cannot delete file ' . $delete_banner->image);
                }
                $this->banner_model->delete(array('id' => $id));
            } else {
                 show_error ("Cannot find baner item with id " . $id);
            }
        }
        redirect(base_url() . 'panel/admin_banner');
    }

    public function delete_uploaded_file($file_name) {
        $file_path = $this->banner_dir . $file_name;
        $success = is_file($file_path) && $file_name[0] !== '.' && unlink($file_path);
        return $success;
    }
    
    function handle_upload()
    {
      if (isset($_FILES['image']) && !empty($_FILES['image']['name']))
        {
//        if ($this->upload->do_upload('image'))
//        {
//          // set a $_POST value for 'image' that we can use later
//          $upload_data    = $this->upload->data();
//          $_POST['image'] = $upload_data['file_name'];
//          return true;
//        }
//        else
//        {
//          // possibly do some clean up ... then throw an error
//          $this->form_validation->set_message('handle_upload', $this->upload->display_errors());
//          return false;
//        }
          return TRUE;
      }
      else
      {
        // throw an error because nothing was uploaded
        $this->form_validation->set_message('handle_upload', "You must choose an image!");
        return false;
      }
    }

}

?>
