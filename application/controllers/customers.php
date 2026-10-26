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

            // "Khách hàng chưa quay lại": không có phiếu nào tạo trong 1 năm / 2 năm gần đây
            $inactiveSince = null;
            if (!empty($timeBack) && $timeBack >= 1) {
                $datetime = new DateTime(date('Y-m-d H:i:s', time()));
                $datetime->sub(new DateInterval($timeBack == 1 ? 'P1Y' : 'P2Y'));
                $inactiveSince = $datetime->format('Y-m-d H:i:s');
            }

            // Lọc, đếm và phân trang đều làm trong SQL; length = -1 là lựa chọn "All"
            $customers = $this->customer_model->readListForPage($search, $inactiveSince, $start, $length);
            $customersCount = $this->customer_model->countListForPage($search, $inactiveSince);

            // Lấy dữ liệu phiếu cho cả trang bằng 2 query thay vì 8 query mỗi khách
            $customerIDs = array();
            foreach ($customers as $r) {
                $customerIDs[] = $r->id;
            }
            $latestTasks = $this->task_model->latestByCustomers($customerIDs);
            $summaries = $this->task_model->summaryByCustomers($customerIDs);

            $data = array();
            foreach ($customers as $r) {
                $last = isset($latestTasks[$r->id]) ? $latestTasks[$r->id] : null;
                $summary = isset($summaries[$r->id]) ? $summaries[$r->id] : null;
                $data[] = $this->_customerRow($r, $last, $summary);
            }

            $output = array(
                "draw" => $draw,
                "recordsTotal" => $customersCount,
                "recordsFiltered" => $customersCount,
                "data" => $data
            );

            echo json_encode($output);
            exit();
        }

        /**
         * Một dòng của bảng khách hàng. Giá trị từng cột giống hệt các helper cũ
         * (lastDoing, customerRequestImei, customerRequestPrice, ...), chỉ khác là
         * dùng dữ liệu đã lấy sẵn thay vì query lại.
         */
        private function _customerRow($r, $last, $summary) {
            $price = '';
            $timeWarranty = '';
            if ($last) {
                $price = is_numeric($last->phonePrice) ? number_format($last->phonePrice) : ($last->phonePrice == '' ? 'Kiểm tra, báo giá trước khi sửa chữa' : $last->phonePrice);
                $timeWarranty = $last->taskStatus == 1 ? formatTime($last->warrantyPeriod) : 'Không có';
            }

            return array(
                "id" => $r->id,
                "customer1" => $r->name,
                "customer2" => $r->phone,
                "customer3" => $last ? $last->phoneType : "",
                "customer4" => $last ? $last->phoneImei : "",
                "customer5" => $last ? formatTime($last->timeClosedTask) : "",
                "customer6" => $price,
                "customer7" => $timeWarranty,
                "customer8" => $last ? $last->note : "",
                "customer9" => $summary ? (int) $summary->total : 0,
                "customer10" => '<span style="color:red;font-weight:bold;">' . number_format($summary ? $summary->price : 0) . '</span>',
                "customer11" => '<a href="' . base_url().'customers/edit/'.$r->id . '" title="Chỉnh sửa"><i class="fa fa-edit"></i></a>' . '&nbsp;&nbsp;&nbsp;' .
                '<a href="' . base_url().'customers/histories/'.$r->id. '" title="Lịch sử" target="_blank"><i class="fa fa-history"></i></a>',
                "customer12" => $r->shop != 2 ? 'Vũng tàu' : 'Long Sơn',
                "customer13" => '<a href="' . base_url().'tasks/add/customer/'.$r->id . '" title="Thêm máy sửa" target="_blank">+ Thêm máy sửa</a>',
                "customer14" => '<a href="' . base_url().'customers/histories/'.$r->id. '" title="Lịch sử" target="_blank">Xem lịch sử</a>'
            );
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

        /**
         * Ô "Tìm kiếm Khách hàng" ở trang danh sách phiếu: tìm theo tên hoặc SĐT, trả JSON tối đa 10 khách
         * GET customers/quickSearch?keyword=...
         * (không dùng tên tham số "q": một số cấu hình nginx dùng ?q= để chuyển đường dẫn vào index.php)
         */
        public function quickSearch() {
            $q = trim((string) $this->input->get('keyword'));
            $result = array();

            $qLength = function_exists('mb_strlen') ? mb_strlen($q, 'UTF-8') : strlen($q);
            if ($qLength >= 2) {
                // MySQL so khớp không phân biệt dấu (ư = u), nên lấy rộng rồi đưa khách khớp đúng dấu lên trước
                $customers = $this->customer_model->readListForPage($q, null, 0, 50, true);
                $exact = array();
                $others = array();
                foreach ($customers as $c) {
                    $nameMatch = function_exists('mb_stripos') ? mb_stripos($c->name, $q, 0, 'UTF-8') !== false : stripos($c->name, $q) !== false;
                    if ($nameMatch || strpos($c->phone, $q) !== false) {
                        $exact[] = $c;
                    } else {
                        $others[] = $c;
                    }
                }
                $customers = array_slice(array_merge($exact, $others), 0, 10);
                $ids = array();
                foreach ($customers as $c) {
                    $ids[] = $c->id;
                }
                $summaries = $this->task_model->summaryByCustomers($ids);
                foreach ($customers as $c) {
                    $result[] = array(
                        'id' => (int) $c->id,
                        'name' => $c->name,
                        'phone' => $c->phone,
                        'tasks' => isset($summaries[$c->id]) ? (int) $summaries[$c->id]->total : 0,
                        'historyUrl' => base_url().'customers/histories/'.$c->id,
                        'addTaskUrl' => base_url().'tasks/add/customer/'.$c->id,
                    );
                }
            }

            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($result, defined('JSON_UNESCAPED_UNICODE') ? JSON_UNESCAPED_UNICODE : 0);
            exit();
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