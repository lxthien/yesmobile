<?php
    class Tasks extends Admin_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->model('task_model', 'task_model');
            $this->load->model('customer_model', 'customer_model');
            $this->load->model('tasks_histories_model', 'tasks_histories_model');
            $this->load->model('task_category_model', 'task_category_model');
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

                $this->_prefetchCustomerRequest($data);
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
                $this->_prefetchCustomerRequest($data);
                $this->load->view('customer', $data);
            }
        }

        /**
         * View gọi customerRequest() (số máy đã sửa) cho từng dòng phiếu.
         * Đếm trước cho tất cả khách trên trang bằng 1 query để tránh mỗi dòng 1 query.
         */
        private function _prefetchCustomerRequest($data) {
            $customerIDs = array();
            foreach ($data as $rows) {
                if (!is_array($rows)) {
                    continue;
                }
                foreach ($rows as $row) {
                    if (is_object($row) && isset($row->customer_id)) {
                        $customerIDs[] = $row->customer_id;
                    }
                }
            }
            $this->task_model->prefetchCountRequest($customerIDs);
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
            $task->updateNote = '';
            $task->updateFlags = '';
            $task->paymentMethod = '';
            $task->brandId = 0;
            $task->repairCategoryId = 0;
            $data['task'] = $task;
            $data['view'] = 'customer/task/add';
            $data['customers'] = $this->customer_model->read_all();
            $this->_categoryFormData($data);
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
                $this->_categoryFormData($data);
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

                // Mục Cập nhật: chữ tự nhập + các ô tick (chỉ nhận mã hợp lệ)
                $task['updateNote'] = (string) $this->input->post('updateNote');
                $updateFlags = $this->input->post('updateFlags');
                $updateFlags = is_array($updateFlags) ? array_intersect(array_keys(taskUpdateFlagOptions()), $updateFlags) : array();
                $task['updateFlags'] = implode(',', $updateFlags);

                // Hình thức thanh toán khi giao máy (chỉ 1)
                $paymentMethod = (string) $this->input->post('paymentMethod');
                $task['paymentMethod'] = array_key_exists($paymentMethod, taskPaymentOptions()) ? $paymentMethod : '';

                // Thống kê: Thương hiệu + Hạng mục sửa (1 hạng mục chính). Để trống thì tự đoán từ Tên thiết bị / Tình trạng.
                $task['brandId'] = $this->task_category_model->validId('brand', $this->input->post('brandId'));
                if (!$task['brandId']) {
                    $task['brandId'] = $this->task_category_model->guessBrand($task['phoneType'], $task['phoneTypeCategory']);
                }
                $task['repairCategoryId'] = $this->task_category_model->validId('repair', $this->input->post('repairCategoryId'));
                if (!$task['repairCategoryId']) {
                    $task['repairCategoryId'] = $this->task_category_model->guessRepair($task['phoneStatus'], $task['note']);
                }

                // Form đã kiểm tra bằng JS; đây là chốt chặn cuối nếu JS không chạy.
                $errors = array();
                // Bắt buộc: khách hàng có thật, tên thiết bị, tình trạng
                $customerId = (int) $task['customer_id'];
                if ($customerId <= 0 || !$this->customer_model->read_by_id($customerId)) {
                    $errors[] = 'Chưa chọn <b>Khách hàng</b>.';
                }
                if (trim((string) $task['phoneType']) === '') {
                    $errors[] = 'Chưa nhập <b>Tên thiết bị</b>.';
                }
                if (trim((string) $task['phoneStatus']) === '') {
                    $errors[] = 'Chưa nhập <b>Tình trạng</b> máy.';
                }
                // Đã giao máy (trừ các tình trạng không thu tiền) thì bắt buộc có hình thức thanh toán.
                if ($task['taskStatus'] == 1 && taskNoRepairLabel($task['technicalFinish']) == '' && $task['paymentMethod'] == '') {
                    $errors[] = 'Phiếu đã giao máy phải chọn hình thức thanh toán: <b>Chuyển khoản</b> hoặc <b>Tiền mặt</b>.';
                }
                if ($errors) {
                    // Không dùng show_error(): dự án thiếu thư mục application/errors nên trang lỗi sẽ trắng
                    set_status_header(400);
                    echo '<!DOCTYPE html><html><head><meta charset="utf-8"><title>Phiếu chưa được lưu</title></head>'
                        . '<body style="font-family:Arial,sans-serif;padding:30px;">'
                        . '<h3 style="color:red;">Phiếu CHƯA được lưu</h3>'
                        . '<ul><li>' . implode('</li><li>', $errors) . '</li></ul>'
                        . '<p><a href="javascript:history.back()">&laquo; Quay lại form</a></p>'
                        . '</body></html>';
                    exit;
                }

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
                    foreach (array('updateNote', 'updateFlags', 'paymentMethod') as $newField) {
                        $oldValue = isset($currentTask->$newField) ? (string) $currentTask->$newField : '';
                        if ($oldValue != $task[$newField]) {
                            $tracks[$newField] = array('from'=>$oldValue, 'to'=>$task[$newField]);
                        }
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

        /* ================= Thống kê tháng theo Thương hiệu / Hạng mục sửa ================= */

        private function _requireAdminShop() {
            if (!$this->ion_auth->in_group('admin_shop')) {
                echo 'Bạn ko có quyền truy cập vào chức năng này'; die;
            }
        }

        /** Danh sách chọn + từ khoá tự đoán cho form phiếu */
        private function _categoryFormData(&$data) {
            $data['brands'] = $this->task_category_model->readByType('brand');
            $data['repairs'] = $this->task_category_model->readByType('repair');
            $data['categoryGuess'] = array(
                'brand' => $this->task_category_model->guessData('brand'),
                'repair' => $this->task_category_model->guessData('repair'),
            );
        }

        /**
         * Thống kê tháng: số máy + doanh thu theo hạng mục, thương hiệu và bảng chéo.
         * Cùng điều kiện với trang Doanh thu theo ngày (phiếu sửa chữa đã giao, tính theo ngày giao máy),
         * gồm cả phiếu không sửa được / khách đổi ý.
         */
        public function statistics() {
            $this->_requireAdminShop();

            $month = (string) $this->input->get('month');
            if (!preg_match('/^\d{4}-(0[1-9]|1[0-2])$/', $month)) {
                $now = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
                $month = $now->format('Y-m');
            }
            $from = new DateTime($month . '-01 00:00:00');
            $to = clone $from;
            $to->modify('+1 month');
            $prev = clone $from;
            $prev->modify('-1 month');

            $shop = (string) $this->input->get('shop');
            $shop = in_array($shop, array('1', '2'), true) ? (int) $shop : '';

            $brandNames = array(0 => 'Chưa phân loại') + $this->task_category_model->namesByType('brand');
            $repairNames = array(0 => 'Chưa phân loại') + $this->task_category_model->namesByType('repair');

            $empty = array('total' => 0, 'revenue' => 0, 'noRepair' => 0);
            $summary = $empty;
            $byBrand = array();
            $byRepair = array();
            $matrix = array();
            $rows = $this->task_model->statsByCategory($from->format('Y-m-d H:i:s'), $to->format('Y-m-d H:i:s'), $shop);
            foreach ($rows as $row) {
                $b = isset($brandNames[$row->brandId]) ? (int) $row->brandId : 0;
                $r = isset($repairNames[$row->repairCategoryId]) ? (int) $row->repairCategoryId : 0;
                foreach (array('total', 'revenue', 'noRepair') as $key) {
                    $value = (float) $row->$key;
                    $summary[$key] += $value;
                    if (!isset($byBrand[$b])) $byBrand[$b] = $empty;
                    if (!isset($byRepair[$r])) $byRepair[$r] = $empty;
                    if (!isset($matrix[$b][$r])) $matrix[$b][$r] = $empty;
                    $byBrand[$b][$key] += $value;
                    $byRepair[$r][$key] += $value;
                    $matrix[$b][$r][$key] += $value;
                }
            }
            // Nhiều máy lên trước; "Chưa phân loại" luôn ở cuối
            $sorter = function ($list) {
                uksort($list, function ($a, $b) use ($list) {
                    if (($a == 0) != ($b == 0)) return $a == 0 ? 1 : -1;
                    if ($list[$a]['total'] != $list[$b]['total']) return $list[$a]['total'] < $list[$b]['total'] ? 1 : -1;
                    return $list[$a]['revenue'] < $list[$b]['revenue'] ? 1 : -1;
                });
                return $list;
            };

            // Bấm vào 1 ô: danh sách phiếu (để kiểm tra / sửa phân loại)
            $detailBrand = $this->input->get('brand');
            $detailRepair = $this->input->get('cat');
            $detailBrand = ($detailBrand !== false && $detailBrand !== '' && ctype_digit((string) $detailBrand)) ? (int) $detailBrand : null;
            $detailRepair = ($detailRepair !== false && $detailRepair !== '' && ctype_digit((string) $detailRepair)) ? (int) $detailRepair : null;
            $data['detailTasks'] = null;
            if ($detailBrand !== null || $detailRepair !== null) {
                $data['detailTasks'] = $this->task_model->statsTasks($from->format('Y-m-d H:i:s'), $to->format('Y-m-d H:i:s'), $shop, $detailBrand, $detailRepair);
            }

            $data['month'] = $month;
            $data['prevMonth'] = $prev->format('Y-m');
            $data['nextMonth'] = $to->format('Y-m');
            $data['shop'] = $shop;
            $data['summary'] = $summary;
            $data['byBrand'] = $sorter($byBrand);
            $data['byRepair'] = $sorter($byRepair);
            $data['matrix'] = $matrix;
            $data['brandNames'] = $brandNames;
            $data['repairNames'] = $repairNames;
            $data['detailBrand'] = $detailBrand;
            $data['detailRepair'] = $detailRepair;
            $data['view'] = 'customer/task/statistics';
            $this->load->view('customer', $data);
        }

        /** Quản lý danh sách Thương hiệu / Hạng mục sửa + tự phân loại phiếu cũ */
        public function categories() {
            $this->_requireAdminShop();
            $data['brands'] = $this->task_category_model->readByType('brand');
            $data['repairs'] = $this->task_category_model->readByType('repair');
            $data['unclassified'] = $this->task_model->countUnclassified();
            $data['done'] = (string) $this->input->get('done');
            $data['view'] = 'customer/task/categories';
            $this->load->view('customer', $data);
        }

        public function saveCategory() {
            $this->_requireAdminShop();
            $type = (string) $this->input->post('type');
            $name = trim((string) $this->input->post('name'));
            $types = Task_category_model::types();
            if ($this->input->server('REQUEST_METHOD') === 'POST' && isset($types[$type]) && $name !== '') {
                $id = (int) $this->input->post('id');
                if ($id && !$this->task_category_model->validId($type, $id)) {
                    $id = 0;
                }
                if ($id || $this->input->post('isNew')) {
                    $this->task_category_model->save(array(
                        'id' => $id,
                        'type' => $type,
                        'name' => mb_substr($name, 0, 100, 'UTF-8'),
                        'keywords' => trim((string) $this->input->post('keywords')),
                        'sortOrder' => (int) $this->input->post('sortOrder'),
                        'active' => $this->input->post('active') ? 1 : 0,
                    ));
                }
            }
            redirect(base_url('tasks/categories') . '#' . $type);
        }

        /** Danh sách phiếu chưa phân loại: chọn thương hiệu / hạng mục ngay trên từng dòng (lưu bằng setCategory) */
        public function unclassified() {
            $this->_requireAdminShop();
            $missing = (string) $this->input->get('missing');
            $missing = in_array($missing, array('brand', 'repair'), true) ? $missing : '';
            $data['missing'] = $missing;
            $data['tasks'] = $this->task_model->readUnclassifiedList($missing);
            $data['brands'] = $this->task_category_model->readByType('brand');
            $data['repairs'] = $this->task_category_model->readByType('repair');
            $data['view'] = 'customer/task/unclassified';
            $this->load->view('customer', $data);
        }

        /** Lưu nhanh 1 ô phân loại (AJAX). Trả JSON {ok, message} */
        public function setCategory() {
            $this->_requireAdminShop();
            $types = array('brandId' => 'brand', 'repairCategoryId' => 'repair');
            $id = (int) $this->input->post('id');
            $column = (string) $this->input->post('column');
            $ok = false;
            if ($this->input->server('REQUEST_METHOD') === 'POST' && $id > 0 && isset($types[$column])) {
                $value = (int) $this->input->post('value');
                if ($value === 0 || $this->task_category_model->validId($types[$column], $value)) {
                    $ok = $this->task_model->setCategory($id, $column, $value);
                }
            }
            $this->output->set_content_type('application/json');
            echo json_encode(array('ok' => (bool) $ok));
        }

        /** Tự phân loại các phiếu sửa chữa còn trống thương hiệu / hạng mục (không đè lựa chọn đã có) */
        public function classifyOld() {
            $this->_requireAdminShop();
            if ($this->input->server('REQUEST_METHOD') !== 'POST') {
                redirect(base_url('tasks/categories'));
            }
            $brandGroups = array();
            $repairGroups = array();
            foreach ($this->task_model->readUnclassified() as $row) {
                if (!$row->brandId) {
                    $id = $this->task_category_model->guessBrand($row->phoneType, $row->phoneTypeCategory);
                    if ($id) $brandGroups[$id][] = $row->id;
                }
                if (!$row->repairCategoryId) {
                    $id = $this->task_category_model->guessRepair($row->phoneStatus, $row->note);
                    if ($id) $repairGroups[$id][] = $row->id;
                }
            }
            $brandCount = 0;
            $repairCount = 0;
            foreach ($brandGroups as $id => $ids) {
                $brandCount += $this->task_model->setCategoryWhereEmpty('brandId', $id, $ids);
            }
            foreach ($repairGroups as $id => $ids) {
                $repairCount += $this->task_model->setCategoryWhereEmpty('repairCategoryId', $id, $ids);
            }
            redirect(base_url('tasks/categories') . '?done=' . $brandCount . '-' . $repairCount);
        }

        public function up()
        {
            $this->load->database();
            $this->db->query("ALTER TABLE `tasks` ADD `features` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER `manufactory`;");
        }
    }