<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Contact extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('mcontact');
        $this->load->model('Admin_menu_model', 'admin_menu');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'form'));
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('yahoo', 'Yahoo', 'required');
        //$this->form_validation->set_rules('skype', 'Skype', 'required');
        //$this->form_validation->set_rules('phone', 'Phone', 'required');
        //$this->form_validation->set_rules('position', 'Position', 'required');
    }

    function index() {
        $data['list_items'] = $this->mcontact->listContactAdmin();
        if(!$this->ion_auth->logged_in()){
    		redirect('panel/login');    	
        }else{
        	
	        $this->load->view('panel/home', $data);
        }
        //$this->load->view('admin/Vcontact',$data);
    }

    function save() {
        if (isset($_POST['save'])) {
            if (isset($_POST['id_contact'])) {
                @$id = $this->input->post('id_contact');
            } else {
                $id = "";
            }
            //use to assign back GUI when data invalid
            @$contact_input->id_contact = $this->input->post('id_contact');
            $contact_input->name = $this->input->post('name');
            $contact_input->position = $this->input->post('position');
            $contact_input->skype = $this->input->post('skype');
            $contact_input->yahoo = $this->input->post('yahoo');
            $contact_input->phone = $this->input->post('phone');

            if (!$this->form_validation->run()) {
                $data['contact'] = $contact_input;
                $data['error'] = validation_errors();
                $this->load->view('panel/home', $data);
            } else {
//                $id = $this->input->post('id_contact');
                $contact['name'] = $this->input->post('name');
                $contact['position'] = $this->input->post('position');
                $contact['skype'] = $this->input->post('skype');
                $contact['yahoo'] = $this->input->post('yahoo');
                $contact['phone'] = $this->input->post('phone');
                $result;
                if (trim($id) !== "") {
                    $contact ['id_contact'] = $id;
                    $this->mcontact->update($contact);
                    redirect(base_url('panel/contact'));
                } else {
                    $result = $this->mcontact->add($contact);

                    if (is_numeric($result)) {
                        redirect(base_url('panel/contact/edit/' . $result));
                    } else {
                        show_error($result);
                    }
                }
            }
        } else {
            redirect(base_url('panel/contact'));
        }
    }

    function add() {
        @$contact->id_contact = '';
        $contact->position = '';
        $contact->name = '';
        $contact->skype = '';
        $contact->yahoo = '';
        $contact->phone = '';
        $data['contact'] = $contact;
        $this->load->view('panel/home', $data);
    }

    function edit() {
        $contact = array();
        $id = $this->uri->rsegment(3);
        $col = 'id';        
        $contact = $this->mcontact->read_by_id($id);        
        if (!isset($contact) || !$contact) {
            show_error("Connot find item id " . $id . ' in system');
        } else {
            $data['contact'] = $contact;
            $this->load->view('panel/home', $data);
        }
    }

    public function delete() {
        $id = $this->input->post('hiddelete');
        $this->mcontact->delete(array('id_contact' => $id));
        redirect(base_url() . 'panel/contact');
    }

}

?>
