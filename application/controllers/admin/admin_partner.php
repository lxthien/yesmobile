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
class Admin_partner extends CI_Controller {

    //put your code here
    var $logo_dir; //= dirname($_SERVER['SCRIPT_FILENAME']) . UPLOAD_DIR . '/logo/';

    function __construct() {
        parent::__construct();
        $this->load->model('Partner_model', 'partner_model');
        // From validator
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'form'));
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->logo_dir = dirname($_SERVER['SCRIPT_FILENAME']) . PARTNER_LOGO;
    }

    function index() {
        $data['list_items'] = $this->_get_list_partners();
        if(!$this->ion_auth->logged_in()){
    		redirect('panel/login');    	
        }else{
        	
	        $this->load->view('panel/home', $data);
        }
    }

    private function _get_list_partners() {
        $list_partners = $this->partner_model->read_list();
        return $list_partners;
    }

    public function save() {
        if (isset($_POST['save'])) {
            $id_partner = $this->input->post('item_id');
            //use to assign back GUI when data invalid
            @$partner_input->id = $this->input->post('item_id');
            $partner_input->name = $this->input->post('name');
            $partner_input->url = $this->input->post('url');
            $partner_input->active = $this->input->post('active');
            if (!$this->form_validation->run()) {
                $partner_input->logo = '';
                $data['new_item'] = $partner_input;
                $data['error'] = validation_errors();
//                echo validation_errors();
                $this->load->view('panel/home', $data);
            } else {
                $partner['name'] = $this->input->post('name');
                $partner['url'] = $this->input->post('url');
                if (strlen($partner['url']) > 0) {
                    $parsed_url = parse_url($partner['url']);
                    if (empty($parsed_url['scheme'])) {
                        $url_str = "http://" . $partner['url'];
                        $partner['url'] = $url_str;
                    }
                }
                $active = $this->input->post('active');
                if (trim($active) === '') {
                    $active = FALSE;
                } else {
                    $active = TRUE;
                }
                $partner['active'] = $active;

//                $id = $this->input->post('item_id');
                $result;
                /* Start upload file */
                if (count($_FILES) > 0 && $_FILES['logo']['error'] !== 4) {
                    $config['upload_path'] = $this->logo_dir;
                    $config['allowed_types'] = 'gif|jpg|png';
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('logo')) {
                        echo 'Có lỗi upload: ';
                        $data['error'] = array('error' => $this->upload->display_errors());
//                        $data['Cname'] = $this->download_category_model->read_list_id_and_name();
                        $data['new_item'] = $partner_input;
                        $data_upload = $this->upload->data();
                        echo $data_upload['file_type'] . '<br>';
//                    var_dump($data['error']);
                        $this->load->view('panel/page_partner_edit', $data);
                    } else {
                        $data_upload = array('upload_data' => $this->upload->data());
//                        echo count($data_upload);
                        if (count($data_upload) > 0) {
                            $uploaded_file = $data_upload["upload_data"];
                            $partner['logo'] = $uploaded_file['file_name'];
//                        $result = $this->partner_model->add($partner);
//                            var_dump($data_upload);
//                        var_dump($download);
                        } else {
                            show_error("Have error when upload file");
                        }
                    }
                }
                /* End upload file */

                if (isset($id_partner) && trim($id_partner) !== "") {
                    $partner['id'] = $id_partner;
                    $this->partner_model->update($partner);
                } else {
                    $result = $this->partner_model->add($partner);
                }
                if (isset($result)) {
                    if (is_numeric($result) && (!isset($id_partner) || trim($id_partner) === "")) {
                        redirect(base_url('panel/admin_partner/edit') . '/' . $result);
                    } else {
                        show_error($result);
                    }
                } else {
                    redirect(base_url('panel/admin_partner'));
                }
            }
        } else {
            redirect(base_url('panel/admin_partner'));
        }
    }

    public function add() {

        @$partner->name = '';
        $partner->url = '';
        $partner->logo = '';
        $partner->active = 'true';
        $data['new_item'] = $partner;
        $this->load->view('panel/home', $data);
    }

    public function edit($id) {
        $new_item = $this->partner_model->read_by_id($id);
        if (!isset($new_item) && !$new_item) {
            show_error("Partner id " . $id . ' not found');
        } else {
            $data['new_item'] = $new_item;
            $this->load->view('panel/home', $data);
        }
    }

    public function delete() {
        $id = $this->input->post('hiddelete');
        $delete_partner = $this->partner_model->read_by_id($id);
        if (isset($delete_partner)) {
            if ($this->delete_uploaded_file($delete_partner->logo)) {
                error_log('Cannot delete file ' . $delete_partner->logo);
            }
            $this->partner_model->delete(array('id' => $id));
        } else {
            show_error("Cannot find download item with id " . $id);
        }
        redirect(base_url() . 'panel/admin_partner');
    }

    public function delete_uploaded_file($file_name) {
        $file_path = $this->logo_dir . $file_name;
        $success = is_file($file_path) && $file_name[0] !== '.' && unlink($file_path);
        return $success;
    }

}

?>
