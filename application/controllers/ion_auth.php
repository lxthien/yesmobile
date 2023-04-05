<?php
class Ion_auth extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('customer_model', 'customer_model');
        $this->load->helper(array('form', 'form'));
        $this->load->helper('myhelper');
    }

    public function authenticate() {
        $data['login'] = 1;
        $this->load->view('customer/login/login', $data);
    }

}