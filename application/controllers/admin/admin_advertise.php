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
class Admin_advertise extends CI_Controller {

    //put your code here
    var $logo_dir; //= dirname($_SERVER['SCRIPT_FILENAME']) . UPLOAD_DIR . '/logo/';

    function __construct() {
        parent::__construct();
        $this->load->model('Advertise_model', 'advertise_model');
        $this->load->model('Advertise_position_model', 'advertise_position_model');
        // From validator
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'text'));
        $this->form_validation->set_rules('company', 'Name', 'required|xss_clean');
        $this->form_validation->set_rules('url', 'Link', 'required|xss_clean');
//        $this->form_validation->set_rules('position_id', 'Position', 'required|xss_clean');
//        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->logo_dir = dirname($_SERVER['SCRIPT_FILENAME']) . PARTNER_LOGO . '/ads';
    }

    function index() {
        $data['list_items'] = $this->_get_list_advertises();
        if(!$this->ion_auth->logged_in()){
    		redirect('panel/login');    	
        }else{
        	$this->load->view('panel/home', $data);
        }
    }

    private function _get_list_advertises() {
        $list_advertises = $this->advertise_model->read_list();
        return $list_advertises;
    }

    public function save() {
        if (isset($_POST['save'])) {
            $id_advertise = $this->input->post('item_id');
            //use to assign back GUI when data invalid
            @$advertise_input->id = $this->input->post('item_id');
            $advertise_input->company = $this->input->post('company');
            $advertise_input->url = $this->input->post('url');
            $advertise_input->active = $this->input->post('active');
            //$advertise_input->position_id = $this->input->post('position_id');
            if (!$this->form_validation->run()) {
                $advertise_input->logo = '';
                $data['new_item'] = $advertise_input;
                $data['position_names'] = $this->advertise_position_model->build_position_name();
                $data['error'] = validation_errors();
//                echo validation_errors();
                $this->load->view('panel/home', $data);
            } else {
                $advertise['company'] = $this->input->post('company');
                $advertise['url'] = $this->input->post('url');
                //$advertise['position_id'] = $this->input->post('position_id');
                if (strlen($advertise['url']) > 0) {
                    $parsed_url = parse_url($advertise['url']);
                    if (empty($parsed_url['scheme'])) {
                        $url_str = "http://" . $advertise['url'];
                        $advertise['url'] = $url_str;
                    }
                }
                $active = $this->input->post('active');
                if (trim($active) === '') {
                    $active = FALSE;
                } else {
                    $active = TRUE;
                }
                $advertise['active'] = $active;

//                $id = $this->input->post('item_id');
                $result;
                /* Start upload file */
                if ( $_FILES['logo']['name'] != '' ) {
                    $config['upload_path'] = $this->logo_dir;
                    $config['allowed_types'] = 'gif|jpg|jpeg|png';
                    $file_name = preg_replace('/[^a-zA-Z]/', '', ucwords($advertise['company']));
                    $config['file_name'] = $file_name;
                    $config['overwrite'] = FALSE;
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('logo')) {
                        echo 'Có lỗi upload: ';
                        $data['error'] = array('error' => $this->upload->display_errors());
                        $data['position_names'] = $this->advertise_position_model->build_position_name();
                        $advertise_input->logo = '';
                        $data['new_item'] = $advertise_input;
                        $data_upload = $this->upload->data();
                        echo $data_upload['file_type'] . '<br>';
                        $this->load->view('panel/page_advertise_edit', $data);
                    } else {
                        $data_upload = array('upload_data' => $this->upload->data());
                        if (count($data_upload) > 0) {
                            $uploaded_file = $data_upload["upload_data"];
                            $advertise['logo'] = $uploaded_file['file_name'];
                        } else {
                            show_error("Have error when upload file");
                        }
                    }
                }
                /* End upload file */
//              var_dump($advertise);
                if (isset($id_advertise) && trim($id_advertise) !== "") {
                    $advertise['id'] = $id_advertise;
//                    echo $id_advertise.'--';
//                     if ($id_advertise === '1'){
//                         $advertise['position_id']  = 1;
//                     }
//                    var_dump($advertise);
                    $this->advertise_model->update($advertise);
                } else {
                    $result = $this->advertise_model->add($advertise);
                }
                if (isset($result)) {
                    if (is_numeric($result) && (!isset($id_advertise) || trim($id_advertise) === "")) {
                        redirect(base_url('panel/admin_advertise/edit') . '/' . $result);
                    } else {
                        show_error($result);
                    }
                } else {
                    redirect(base_url('panel/admin_advertise'));
                }
            }
        } else {
            redirect(base_url('panel/admin_advertise'));
        }
    }

    public function add() {

        $advertise = new stdClass();
        $advertise->company = '';
        $advertise->url = '';
        $advertise->logo = '';
        $advertise->active = 'true';
        $advertise->position_id = '';
        $data['new_item'] = $advertise;
        $data['position_names'] = $this->advertise_position_model->build_position_name();
        $this->load->view('panel/home', $data);
    }

    public function edit($id) {
        $new_item = $this->advertise_model->read_by_id($id);
        if (!isset($new_item) && !$new_item) {
            show_error("Advertise id " . $id . ' not found');
        } else {
            $data['new_item'] = $new_item;
            $data['position_names'] = $this->advertise_position_model->build_position_name();
            $this->load->view('panel/home', $data);
        }
    }

    public function delete() {
        $id = $this->input->post('hiddelete');

        if (!isset($id) || strlen($id) === 0) {
            show_error('Cannot get advertise to delete');
        } else {
            $delete_advertise = $this->advertise_model->read_by_id($id);
            if (isset($delete_advertise)) {
//                 if ($delete_advertise->position_id === '1') {
//                     show_error('Delete this advertise is not allowed');
//                 }
//                 if ($this->delete_uploaded_file($delete_advertise->logo)) {
//                     error_log('Cannot delete file ' . $delete_advertise->logo);
//                 }
//                 $this->advertise_model->delete(array('id' => $id));
            	$this->delete_uploaded_file($delete_advertise->logo);
            	$delete_advertise->logo  = '';
            	//$this->advertise_model->update($delete_advertise);
            	$this->advertise_model->deleteLogo($id);
            	//redirect(base_url() . 'panel/admin_advertise');
            } else {
                 show_error ("Cannot find advertise item with id " . $id);
            }
        }
        redirect(base_url() . 'panel/admin_advertise');
    }

    public function delete_uploaded_file($file_name) {
        $file_path = $this->logo_dir . $file_name;
        $success = is_file($file_path) && $file_name[0] !== '.' && unlink($file_path);
        return $success;
    }

}

?>
