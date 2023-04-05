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
class Admin_feedback extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Feedback_model', 'feedback_model');
        // From validator
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'form'));
        $this->form_validation->set_rules('content', 'Content', 'required|max_length[255]');
        $this->form_validation->set_rules('customer_name', 'Customer', 'required|max_length[50]');
        $this->form_validation->set_rules('designation', 'Designation', 'required|max_length[50]');

    }

    function index() {
        $data['list_items'] = $this->_get_list_feedbacks();
        //$this->load->view('admin/m_news',$data);
        if(!$this->ion_auth->logged_in()){
    		redirect('panel/login');    	
        }else{
        	
	        $this->load->view('panel/home', $data);
        }
    }

    private function _get_list_feedbacks() {
        $list_feedbacks = $this->feedback_model->read_list();
        return $list_feedbacks;
    }

    public function save() {
        if (isset($_POST['save'])) {
            $id_feedback = $this->input->post('item_id');
            //use to assign back GUI when data invalid
            $feedback_input->id = $this->input->post('item_id');
            $feedback_input->content = $this->input->post('content');
            $feedback_input->customer_name = $this->input->post('customer_name');
            $feedback_input->designation = $this->input->post('designation');
            if (!$this->form_validation->run()) {
                $data['new_item'] = $feedback_input;
                $data['error'] = validation_errors();
                $this->load->view('panel/home', $data);
            } else {
                $feedback['content'] = $feedback_input->content;
                $feedback['customer_name'] = $feedback_input->customer_name;
                $feedback['designation'] = $feedback_input->designation;
                
                $result;
                if (isset($id_feedback) && trim($id_feedback) !== "") {
                    $feedback['id'] = $id_feedback;
                    $this->feedback_model->update($feedback);
                } else {
                    $result = $this->feedback_model->add($feedback);
                }
                if (isset($result)) {
                    if (is_numeric($result) && (!isset($id_feedback) || trim($id_feedback) === "")) {
                        redirect(base_url('panel/admin_feedback/edit') . '/' . $result);
                    } else {
                        show_error($result);
                    }
                } else {
                    redirect(base_url('panel/admin_feedback'));
                }
            }
        } else {
            redirect(base_url('panel/admin_feedback'));
        }
    }

    public function add() {

        $feedback->content = '';
        $feedback->customer_name = '';
        $feedback->designation = '';
        $data['new_item'] = $feedback;
        $this->load->view('panel/home', $data);
    }

    public function edit($id) {
        $new_item = $this->feedback_model->read_by_id($id);
        if (!isset($new_item) && !$new_item) {
            show_error("Feedback id " . $id . ' not found');
        } else {
            $data['new_item'] = $new_item;
            $this->load->view('panel/home', $data);
        }
    }

    public function delete() {
        $id = $this->input->post('hiddelete');
        $delete_feedback = $this->feedback_model->read_by_id($id);
        if (isset($delete_feedback)) {            
            $this->feedback_model->delete(array('id' => $id));
        } else {
            show_error("Cannot find and delete item with id " . $id);
        }
        redirect(base_url() . 'panel/admin_feedback');
    }   
}

?>
