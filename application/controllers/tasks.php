<?php
    class Tasks extends Admin_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->model('task_model', 'task_model');
            $this->load->model('customer_model', 'customer_model');
            $this->load->model('tasks_histories_model', 'tasks_histories_model');
            $this->load->helper(array('form', 'form'));
            $this->load->helper('myhelper');
        }

        public function index() {
            $data['countTasks'] = $this->task_model->countTask();
            $data['countCustomer'] = $this->customer_model->get_all_customers();
            
            $this->load->view('customer/dashboard', $data);
        }

        public function listTask() {
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            
            $shop = 0;
            if ($this->ion_auth->in_group('members_shopA')) {
                $shop = 1;
            } else if ($this->ion_auth->in_group('members_shopB')) {
                $shop = 2;
            }

            if ($shop != 0) {
                $data['tasks'] = $this->task_model->readListDoing($shop);
                $data['tasksPC'] = $this->task_model->readListPCDoing($shop);
                $data['tasksXac'] = $this->task_model->readListXacDoing($shop);
                $data['tasksFinish'] = $this->task_model->readListFinish($shop);
                $data['tasksNotifiedCustomer'] = $this->task_model->readListNotifiedCustomer($shop);
                $data['tasksCustomerReceived'] = $this->task_model->readListCustomerReceived($shop);
                $data['tasksCustomerReceivedWithPrice'] = $this->task_model->readListCustomerReceivedWithPrice($shop);
                $data['view'] = 'customer/task/index';
                
                $this->load->view('customer', $data);
            } else {
                $data['tasksVT'] = $this->task_model->readListVTDoing();
                $data['tasksLS'] = $this->task_model->readListLSDoing();
                $data['tasksPCVT'] = $this->task_model->readListPCVTDoing();
                $data['tasksPCLS'] = $this->task_model->readListPCLSDoing();
                $data['tasksXacVT'] = $this->task_model->readListXacVTDoing();
                $data['tasksXacLS'] = $this->task_model->readListXacLSDoing();
                $data['tasksFinishVT'] = $this->task_model->readListVTFinish();
                $data['tasksFinishLS'] = $this->task_model->readListLSFinish();
                $data['tasksNotifiedCustomerVT'] = $this->task_model->readListVTNotifiedCustomer();
                $data['tasksNotifiedCustomerLS'] = $this->task_model->readListLSNotifiedCustomer();
                $data['tasksCustomerReceivedVT'] = $this->task_model->readListVTCustomerReceived();
                $data['tasksCustomerReceivedLS'] = $this->task_model->readListLSCustomerReceived();
                $data['tasksCustomerReceivedWithPriceVT'] = $this->task_model->readListVTCustomerReceivedWithPrice();
                $data['tasksCustomerReceivedWithPriceLS'] = $this->task_model->readListLSCustomerReceivedWithPrice();

                $data['view'] = 'customer/task/indexAdmin';
                $this->load->view('customer', $data);
            }
        }

        function listToday() {
            if (!$this->ion_auth->in_group('admin_shop')) {
                echo 'Bạn ko có quyền truy cập vào chức năng này'; die;
            }

            $timeSearch = $this->input->get("time");
            if (empty($timeSearch)) {
                //$datetime = new DateTime(date('Y-m-d H:i:s', time()));
                $datetime = new DateTime("now", new DateTimeZone('Asia/Ho_Chi_Minh') );
            } else {
                $datetime = new DateTime($timeSearch);
                //$datetime->add(new DateInterval("PT420M"));
            }

            $timeFrom = $datetime->format('Y-m-d 00:00:00');
            $timeTo = $datetime->format('Y-m-d 23:59:59');

            $data['date'] = $datetime->format('Y-m-d');
            $data['tasks'] = $this->task_model->getAllTask($timeFrom, $timeTo);
            $data['tasksVT'] = $this->task_model->getAllTaskVT($timeFrom, $timeTo);
            $data['tasksLS'] = $this->task_model->getAllTaskLS($timeFrom, $timeTo);
            $data['timeSearch'] = $timeSearch;

            $data['view'] = 'customer/task/total';
            $this->load->view('customer', $data);
        }

        public function add() {
            $customer_id = $this->uri->rsegment(3);

            $task = new stdClass();
            $task->id = '';
            $task->taskName = '';
            $task->taskType = '';
            $task->customer_id = '';
            
            if (trim($customer_id) !== "") {
                $task->customer_id = $customer_id;
                $taskRequest = customerRequest($customer_id);

                if ($taskRequest >= 2) {
                    $task->isCustomerVip = 1;
                }
            }
            
            $task->phoneType = '';
            $task->phoneTypeCategory = '';
            $task->phoneImei = '';
            $task->notePrivate = '';
            $task->phonePass = '';
            $task->phonePrice = '';
            $task->phoneStatus = '';
            $task->warrantyPeriod = '';
            $task->warrantyPeriodEnd = '';
            $task->phoneSim = '';
            $task->technicalFinish = '';
            $task->notificationCustomer = '';
            $task->timeNotificationCustomer = '';
            $task->quickStatus = '';
            $task->taskStatus = '';
            $task->timeClosedTask = '';
            $task->timeWarranty = '';
            $task->useAccessories = 0;
            $task->note = '';
            $task->manufactory = '';
            $task->features = '';
            $task->phieu = '';
            $task->khachMuonMay = '';
            $data['task'] = $task;
            $data['view'] = 'customer/task/add';
            $data['customers'] = $this->customer_model->read_all();
            $this->load->view('customer', $data);
        }

        public function edit() {
            $id = $this->uri->rsegment(3);
            $task = $this->task_model->read_by_id($id);
            $data['customers'] = $this->customer_model->read_all();
            if (!isset($task) || !$task) {
                show_error("Connot find item id " . $id . ' in system');
            } else {
                $data['task'] = $task;
                $data['view'] = 'customer/task/add';
                $this->load->view('customer', $data);
            }
        }

        public function save() {
            if (isset($_POST['action'])) {
                if (isset($_POST['id'])) {
                    $id = $this->input->post('id');
                    $currentTask = $this->task_model->read_by_id($id);
                } else {
                    $id = "";
                }

                $task['taskName'] = $this->input->post('taskName');
                $task['taskType'] = $this->input->post('taskType');
                $task['customer_id'] = $this->input->post('customer_id');
                $task['phoneType'] = $this->input->post('phoneType');
                $task['phoneTypeCategory'] = $this->input->post('phoneTypeCategory');
                $task['phoneImei'] = $this->input->post('phoneImei');
                $task['notePrivate'] = $this->input->post('notePrivate');
                $task['phonePass'] = $this->input->post('phonePass');
                $task['phonePrice'] = str_replace(',', '', $this->input->post('phonePrice'));
                $task['phoneStatus'] = $this->input->post('phoneStatus');
                $task['phoneSim'] = $this->input->post('phoneSim');
                $task['technicalFinish'] = $this->input->post('technicalFinish');
                $task['notificationCustomer'] = $this->input->post('notificationCustomer');
                $task['quickStatus'] = $this->input->post('quickStatus');
                $task['isCustomerVip'] = $this->input->post('isCustomerVip');
                $task['taskStatus'] = $this->input->post('taskStatus');
                $task['timeWarranty'] = $this->input->post('timeWarranty') ? $this->input->post('timeWarranty') : 0;
                $task['useAccessories'] = $this->input->post('useAccessories');
                $task['note'] = $this->input->post('note');
                $task['manufactory'] = $this->input->post('manufactory');
                $task['features'] = $this->input->post('features');
                $task['phieu'] = $this->input->post('phieu');
                $task['khachMuonMay'] = $this->input->post('khachMuonMay');

                if ($this->input->post('warrantyPeriodEnd') != '') {
                    $dateAndTime = $this->input->post('warrantyPeriodEnd').' '.$this->input->post('warrantyPeriodTimeEnd');
                    $warrantyPeriodEnd = new DateTime($dateAndTime);
                    $task['warrantyPeriodEnd'] = $warrantyPeriodEnd->format('Y-m-d H:i:s');
                }

                $result = '';

                if (trim($id) !== "") {
                    $task['code'] = $this->createCode($id, $this->input->post('taskType'), 7);
                    $task['id'] = $id;
                    $task['updated'] = date('Y-m-d H:i:s');
                    $task['updatedBy'] = $this->ion_auth->user()->row()->id;
                    if ($this->input->post('taskStatus') == 1) {
                        $task['timeClosedTask'] = date('Y-m-d H:i:s');
                        
                        $dateWarrantyPerios = new DateTime(date('Y-m-d H:i:s', time()));
                        $dateWarrantyPerios->add(new DateInterval('P'.$this->input->post('timeWarranty').'D'));
                        $task['warrantyPeriod'] = $dateWarrantyPerios->format('Y-m-d H:i:s');
                    }

                    if ($this->input->post('notificationCustomer') == 1 && $currentTask->notificationCustomer == 0) {
                        $task['timeNotificationCustomer'] = date('Y-m-d H:i:s');
                    }

                    $tracks = array();
                    if ($currentTask->taskType != $task['taskType']) {
                        $tracks['taskType'] = array('from'=>$currentTask->taskType, 'to'=>$task['taskType']);
                    }
                    if ($currentTask->phoneType != $task['phoneType']) {
                        $tracks['phoneType'] = array('from'=>$currentTask->phoneType, 'to'=>$task['phoneType']);
                    }
                    if ($currentTask->phoneImei != $task['phoneImei']) {
                        $tracks['phoneImei'] = array('from'=>$currentTask->phoneImei, 'to'=>$task['phoneImei']);
                    }
                    if ($currentTask->notePrivate != $task['notePrivate']) {
                        $tracks['notePrivate'] = array('from'=>$currentTask->notePrivate, 'to'=>$task['notePrivate']);
                    }
                    if ($currentTask->phonePass != $task['phonePass']) {
                        $tracks['phonePass'] = array('from'=>$currentTask->phonePass, 'to'=>$task['phonePass']);
                    }
                    if ($currentTask->phoneStatus != $task['phoneStatus']) {
                        $tracks['phoneStatus'] = array('from'=>$currentTask->phoneStatus, 'to'=>$task['phoneStatus']);
                    }
                    if ($currentTask->phoneSim != $task['phoneSim']) {
                        $tracks['phoneSim'] = array('from'=>$currentTask->phoneSim, 'to'=>$task['phoneSim']);
                    }
                    if ($currentTask->phonePrice != $task['phonePrice']) {
                        $tracks['phonePrice'] = array('from'=>$currentTask->phonePrice, 'to'=>$task['phonePrice']);
                    }
                    if ($currentTask->useAccessories != $task['useAccessories']) {
                        $tracks['useAccessories'] = array('from'=>$currentTask->useAccessories, 'to'=>$task['useAccessories']);
                    }
                    if ($currentTask->technicalFinish != $task['technicalFinish']) {
                        $tracks['technicalFinish'] = array('from'=>$currentTask->technicalFinish, 'to'=>$task['technicalFinish']);
                    }
                    if ($currentTask->notificationCustomer != $task['notificationCustomer']) {
                        $tracks['notificationCustomer'] = array('from'=>$currentTask->notificationCustomer, 'to'=>$task['notificationCustomer']);
                    }
                    if ($currentTask->quickStatus != $task['quickStatus']) {
                        $tracks['quickStatus'] = array('from'=>$currentTask->quickStatus, 'to'=>$task['quickStatus']);
                    }
                    if ($currentTask->isCustomerVip != $task['isCustomerVip']) {
                        $tracks['isCustomerVip'] = array('from'=>$currentTask->isCustomerVip, 'to'=>$task['isCustomerVip']);
                    }
                    if ($currentTask->taskStatus != $task['taskStatus']) {
                        $tracks['taskStatus'] = array('from'=>$currentTask->taskStatus, 'to'=>$task['taskStatus']);
                    }
                    if ($currentTask->timeWarranty != $task['timeWarranty']) {
                        $tracks['timeWarranty'] = array('from'=>$currentTask->timeWarranty, 'to'=>$task['timeWarranty']);
                    }
                    if ($currentTask->note != $task['note']) {
                        $tracks['note'] = array('from'=>$currentTask->note, 'to'=>$task['note']);
                    }
                    if ($currentTask->note != $task['note']) {
                        $tracks['manufactory'] = array('from'=>$currentTask->manufactory, 'to'=>$task['manufactory']);
                    }
                    if (sizeof($tracks) > 0) {
                        $tasks_histories['tracks'] = json_encode($tracks);
                    }
                    $tasks_histories['user_id'] = $this->ion_auth->user()->row()->id;
                    $tasks_histories['task_id'] = $id;
                    $createDate = new DateTime(date('Y-m-d H:i:s'));
                    $createDate->setTimezone(new DateTimeZone('UTC'));
                    $tasks_histories['created'] = $createDate->format('Y-m-d H:i:s');
                    
                    $this->tasks_histories_model->add($tasks_histories);

                    $this->task_model->update($task);
                    redirect(base_url().'tasks/listTask');
                } else {
                    // Convert time to UTC
                    $createDate = new DateTime(date('Y-m-d H:i:s'));
                    $createDate->setTimezone(new DateTimeZone('UTC'));
                    $task['created'] = $createDate->format('Y-m-d H:i:s');
                    $task['createdBy'] = $this->ion_auth->user()->row()->id;
                    $task['shop'] = 1;
                    
                    $groupShop = array('admin_shop', 'members_shopA');
                    if (!$this->ion_auth->in_group($groupShop)) {
                        $task['shop'] = 2;
                    }
                    
                    $result = $this->task_model->add($task);
                    if (is_numeric($result)) {
                        $task['id'] = $result;
                        $task['code'] = $this->createCode($result, $this->input->post('taskType'), 7);
                        $this->task_model->update($task);
                        redirect(base_url('tasks/listTask'));
                    } else {
                        show_error($result);
                    }
                }
            } else {
                redirect(base_url('customers/list'));
            }
        }

        public function printTask() {
            $id = $this->uri->rsegment(3);
            $task = $this->task_model->read_by_id($id);
            $data['task'] = $task;
            $data['view'] = 'customer/task/print';
            $this->load->view('customer', $data);
        }

        private function createCode($id, $typeTask, $number) {
            if($typeTask == 1) {
                $text = 'YMS';
            } else {
                $text = 'YM';
            }

            $count = strlen($id);
            for($i=1; $i <= ($number-$count); $i++) {
                $text .= '0';
            }
            return $text.$id;
        }

        public function delete($id) {
            $id = $this->uri->rsegment(3);
            $this->task_model->delete(array('id' => $id));
            redirect(base_url() . 'tasks/listTask');
        }

        public function histories($taskID) {
            $taskID = $this->uri->rsegment(3);
            $data['tasks'] = $this->tasks_histories_model->read_by_task_id($taskID);
            $this->load->view('customer/task/histories', $data);
        }

        public function up()
        {
            $this->load->database();
            $this->db->query("ALTER TABLE `tasks` ADD `features` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER `manufactory`;");
        }
    }