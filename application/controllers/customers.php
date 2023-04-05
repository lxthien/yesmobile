<?php
    class Customers extends Admin_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->model('customer_model', 'customer_model');
            $this->load->model('task_model', 'task_model');
            $this->load->helper(array('form', 'form'));
            $this->load->helper('myhelper');
        }

        public function index() {
            $data['view'] = 'customer/information/index';
            $this->load->view('customer', $data);
        }

        public function customersPage() {
            // Datatables Variables
            $draw = intval($this->input->get("sEcho"));
            $start = intval($this->input->get("iDisplayStart"));
            $length = intval($this->input->get("iDisplayLength"));
            $timeBack = intval($this->input->get("customer_back"));
            $search = $this->input->get("sSearch");
            $customerHasTaskAfterTime = 0;

            $customers = $this->customer_model->read_list($search, $start, $length);
            $customersCount = empty($search) ? $this->customer_model->get_all_customers() : count($customers);
            $data = array();

            foreach($customers as $r) {
                if (empty($timeBack) || $timeBack < 1) {
                    $data[] = array(
                            "id" => $r->id,
                            "customer1" => $r->name . '(<a href="' . base_url().'tasks/add/customer/'.$r->id . '" title="Tạo yêu cầu cho khách hàng này"><i class="fa fa-plus" aria-hidden="true"></i> Tasks</a>)',
                            "customer2" => $r->phone,
                            "customer3" => lastDoing($r->id),
                            "customer4" => customerRequestImei($r->id),
                            "customer5" => customerRequestTimeReceive($r->id),
                            "customer6" => customerRequestPrice($r->id),
                            "customer7" => customerRequestTimeWarranty($r->id),
                            "customer8" => customerRequestNote($r->id),
                            "customer9" => customerRequest($r->id),
                            "customer10" => number_format(countPriceCustomerRequest($r->id)),
                            "customer11" => '<a href="' . base_url().'customers/edit/'.$r->id . '" title="Chỉnh sửa"><i class="fa fa-edit"></i></a>' . '&nbsp;&nbsp;&nbsp;' .
                            '<a href="' . base_url().'customers/histories/'.$r->id. '" title="Lịch sử" target="_blank"><i class="fa fa-history"></i></a>',
                            "customer12" => $r->shop != 2 ? 'Vũng tàu' : 'Long Sơn'
                    );
                } else {
                    $takskOfCustomerAfterTime = $this->task_model->getTaskCustomerAfterTime($r->id, $timeBack);
                    if ($takskOfCustomerAfterTime <= 0) {
                        $customerHasTaskAfterTime++;
                        $data[] = array(
                            "id" => $r->id,
                            "customer1" => $r->name . '(<a href="' . base_url().'tasks/add/customer/'.$r->id . '" title="Tạo yêu cầu cho khách hàng này"><i class="fa fa-plus" aria-hidden="true"></i> Tasks</a>)',
                            "customer2" => $r->phone,
                            "customer3" => lastDoing($r->id),
                            "customer4" => customerRequestImei($r->id),
                            "customer5" => customerRequestTimeReceive($r->id),
                            "customer6" => customerRequestPrice($r->id),
                            "customer7" => customerRequestTimeWarranty($r->id),
                            "customer8" => customerRequestNote($r->id),
                            "customer9" => customerRequest($r->id),
                            "customer10" => number_format(countPriceCustomerRequest($r->id)),
                            "customer11" => '<a href="' . base_url().'customers/edit/'.$r->id . '" title="Chỉnh sửa"><i class="fa fa-edit"></i></a>' . '&nbsp;&nbsp;&nbsp;' .
                            '<a href="' . base_url().'customers/histories/'.$r->id. '" title="Lịch sử" target="_blank"><i class="fa fa-history"></i></a>',
                            "customer12" => $r->shop != 2 ? 'Vũng tàu' : 'Long Sơn'
                        );
                    }
                }
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $customerHasTaskAfterTime > 0 ? $customerHasTaskAfterTime : $customersCount,
                "recordsFiltered" => $customerHasTaskAfterTime > 0 ? $customerHasTaskAfterTime : $customersCount,
                "data" => $data
            );
           
            echo json_encode($output);
            exit();
        }

        public function add() {
            $customer = new stdClass();
            $customer->id = '';
            $customer->name = '';
            $customer->phone = '';
            $data['customer'] = $customer;
            $data['view'] = 'customer/information/add';
            $this->load->view('customer', $data);
        }

        public function save() {
            if (isset($_POST['action'])) {
                if (isset($_POST['id'])) {
                    $id = $this->input->post('id');
                } else {
                    $id = "";
                }

                $customer['name'] = $this->input->post('name');
                $customer['phone'] = $this->input->post('phone');
                $result = '';

                if (trim($id) !== "") {
                    $customer['id'] = $id;
                    $this->customer_model->update($customer);
                    redirect(base_url().'customers/index');
                } else {
                    $groupShop = array('admin_shop', 'members_shopA');
                    if ($this->ion_auth->in_group($groupShop)) {
                        $customer['shop'] = 1;
                    } else {
                        $customer['shop'] = 2;
                    }

                    $result = $this->customer_model->add($customer);
                    if (is_numeric($result)) {
                        redirect(base_url('tasks/add/customer/'.$result));
                    } else {
                        show_error($result);
                    }
                }
            } else {
                redirect(base_url('customers/index'));
            }
        }

        public function edit() {
            $id = $this->uri->rsegment(3);
            $customer = $this->customer_model->read_by_id($id);

            $shop = 0;
            if ($this->ion_auth->in_group('members_shopA')) {
                $shop = 1;
            } else if ($this->ion_auth->in_group('members_shopB')) {
                $shop = 2;
            }

            if (!isset($customer) || !$customer) {
                show_error("Connot find item id " . $id . ' in system');
            } else {
                $data['customer'] = $customer;
                $data['shop'] = $shop;
                $data['view'] = 'customer/information/add';
                $this->load->view('customer', $data);
            }
        }

        public function delete() {
            $id = $this->uri->rsegment(3);
            $this->customer_model->delete(array('id' => $id));
            redirect(base_url() . 'customers/index');
        }

        public function histories() {
            $customerID = $this->uri->rsegment(3);
            $data['tasks'] = $this->task_model->customerRequest($customerID);
            $data['totalPrice'] = $this->task_model->countPriceCustomerRequest($customerID);
            $data['customer'] = $customer = $this->customer_model->read_by_id($customerID);
            $data['view'] = 'customer/information/histories';
            $this->load->view('customer', $data);
        }

        function phoneCheckSignup(){
            $phone = $this->input->post('phone');
            $customer = $this->customer_model->read_by_phone($phone);

            if (!isset($customer) || !$customer) {
                echo "true";
            } else {
                echo "false";
            }
            exit;
        }
    }