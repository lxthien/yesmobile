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
class Config extends Admin_Controller {

    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->model('Config_model', 'config_model');
        $this->load->helper('form');
    }

    public function index() {
        $data = $this->load->get_var('data');
        $data['configs'] = $this->config_model->read_list();        
        $this->load->view('panel/home', $data);
    }

    public function save() {
        $configs = $this->config_model->read_list();
        $rules = array(array(
                'field' => 'firstname',
                'label' => 'First Name',
                'rules' => 'required|strtolower|min_length[3]'
                ));
        foreach ($configs as &$config) {            
                $conf_value = $this->input->post('param_' . $config->param);
                if (isset($conf_value)){
                $config->value = $conf_value;
                $arr = get_object_vars($config);
                $this->config_model->update($arr);
            }
        }
        $this->session->set_flashdata('message', 'Lưu cấu hình thành công !');
        $data['configs'] = $configs;        
        $this->load->view('panel/home', $data);
    }

}

?>
