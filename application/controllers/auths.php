<?php
class Auths extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('customer_model', 'customer_model');
        $this->load->model('task_model', 'task_model');
        $this->load->helper('myhelper');
    }

    public function authenticate() {
        $data['login'] = 1;
        $this->load->view('customer/login/login', $data);
    }

    public function checkWarrantyPeriod () {
        $customers = $this->customer_model->read_list();
        
        $dataJsons = array();
        foreach ($customers as $row) {
            $dataJson = array(
                'id' => $row->id,
                'name' => $row->name.' - '.$row->phone
            );
            array_push($dataJsons, $dataJson);
        }
        
        echo json_encode($dataJsons);
    }

}