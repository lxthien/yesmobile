<?php
    class Task_model extends MY_Model {
        
        var $primary_table = 'tasks';
        var $fields = array('id', 'code', 'taskName', 'taskType', 'customer_id', 'phoneType', 'phoneTypeCategory', 'phoneImei', 'notePrivate', 'phonePass', 'phonePrice', 'phoneStatus', 'phoneSim', 'warrantyPeriod', 'warrantyPeriodEnd', 'technicalFinish', 'notificationCustomer', 'timeNotificationCustomer', 'quickStatus', 'taskStatus', 'note', 'isCustomerVip', 'timeClosedTask', 'timeWarranty', 'useAccessories', 'createdBy', 'updatedBy', 'shop', 'manufactory', 'features', 'phieu', 'khachMuonMay', 'updateNote', 'updateFlags', 'paymentMethod', 'created', 'updated');
        var $required_fields = array('taskType', 'customer_id');

        var $primary_key = 'id';

        function __construct() {
            parent::__construct();
        }

        public function read_by_id($id) {
            $options = array($this->primary_key => $id);
            $query = $this->get($options);
            return $query;
        }

        public function read_list() {
            $this->db->select('*');
            $this->db->from($this->primary_table);
            $this->db->where('taskType', 1);
            $this->db->where('taskStatus', 0);
            $this->db->order_by("created", "asc");
            $query = $this->db->get();
            return $query->result();
        }

        public function readListDoing($shop = null) {
            $this->db->select('*');
            $this->db->from($this->primary_table);
            $this->db->where('taskType', 1);
            $this->db->where('taskStatus', 0);
            $this->db->where('phoneTypeCategory', 0);
            $this->db->where('technicalFinish', 0);
            $this->db->where('notificationCustomer', 0);
            if ($shop == 1) {
                $this->db->where_in('shop', array(0, 1));
            } else if ($shop == 2) {
                $this->db->where('shop', 2);
            } else if ($shop == 0) {
                $this->db->where_in('shop', array(0, 1, 2));
            }
            $this->db->order_by("warrantyPeriodEnd", "asc");
            $query = $this->db->get();
            return $query->result();
        }

        public function readListPCDoing($shop = null) {
            $this->db->select('*');
            $this->db->from($this->primary_table);
            $this->db->where('taskType', 1);
            $this->db->where('taskStatus', 0);
            $this->db->where_in('phoneTypeCategory', array(1));
            $this->db->where('technicalFinish', 0);
            $this->db->where('notificationCustomer', 0);
            if ($shop == 1) {
                $this->db->where_in('shop', array(0, 1));
            } else if ($shop == 2) {
                $this->db->where('shop', 2);
            } else if ($shop == 0) {
                $this->db->where_in('shop', array(0, 1, 2));
            }
            $this->db->order_by("warrantyPeriodEnd", "asc");
            $query = $this->db->get();
            return $query->result();
        }

        public function readListXacDoing($shop = null) {
            $this->db->select('*');
            $this->db->from($this->primary_table);
            $this->db->where('taskType', 1);
            $this->db->where('taskStatus', 0);
            $this->db->where_in('phoneTypeCategory', array(2));
            $this->db->where('technicalFinish', 0);
            $this->db->where('notificationCustomer', 0);
            if ($shop == 1) {
                $this->db->where_in('shop', array(0, 1));
            } else if ($shop == 2) {
                $this->db->where('shop', 2);
            } else if ($shop == 0) {
                $this->db->where_in('shop', array(0, 1, 2));
            }
            $this->db->order_by("warrantyPeriodEnd", "asc");
            $query = $this->db->get();
            return $query->result();
        }

        public function readListVTDoing() {
            $this->db->select('*');
            $this->db->from($this->primary_table);
            $this->db->where('taskType', 1);
            $this->db->where('taskStatus', 0);
            $this->db->where('phoneTypeCategory', 0);
            $this->db->where('technicalFinish', 0);
            $this->db->where('notificationCustomer', 0);
            $this->db->where_in('shop', array(0, 1));
            $this->db->order_by("warrantyPeriodEnd", "asc");
            
            $query = $this->db->get();
            return $query->result();
        }

        public function readListPCVTDoing() {
            $this->db->select('*');
            $this->db->from($this->primary_table);
            $this->db->where('taskType', 1);
            $this->db->where('taskStatus', 0);
            $this->db->where('phoneTypeCategory', 1);
            $this->db->where('technicalFinish', 0);
            $this->db->where('notificationCustomer', 0);
            $this->db->where_in('shop', array(0, 1));
            $this->db->order_by("warrantyPeriodEnd", "asc");
            
            $query = $this->db->get();
            return $query->result();
        }

        public function readListXacVTDoing() {
            $this->db->select('*');
            $this->db->from($this->primary_table);
            $this->db->where('taskType', 1);
            $this->db->where('taskStatus', 0);
            $this->db->where('phoneTypeCategory', 2);
            $this->db->where('technicalFinish', 0);
            $this->db->where('notificationCustomer', 0);
            $this->db->where_in('shop', array(0, 1));
            $this->db->order_by("warrantyPeriodEnd", "asc");
            
            $query = $this->db->get();
            return $query->result();
        }

        public function readListLSDoing() {
            $this->db->select('*');
            $this->db->from($this->primary_table);
            $this->db->where('taskType', 1);
            $this->db->where('taskStatus', 0);
            $this->db->where('phoneTypeCategory', 0);
            $this->db->where('technicalFinish', 0);
            $this->db->where('notificationCustomer', 0);
            $this->db->where_in('shop', array(2));
            $this->db->order_by("warrantyPeriodEnd", "asc");
            
            $query = $this->db->get();
            return $query->result();
        }

        public function readListPCLSDoing() {
            $this->db->select('*');
            $this->db->from($this->primary_table);
            $this->db->where('taskType', 1);
            $this->db->where('taskStatus', 0);
            $this->db->where('phoneTypeCategory', 1);
            $this->db->where('technicalFinish', 0);
            $this->db->where('notificationCustomer', 0);
            $this->db->where_in('shop', array(2));
            $this->db->order_by("warrantyPeriodEnd", "asc");
            
            $query = $this->db->get();
            return $query->result();
        }

        public function readListXacLSDoing() {
            $this->db->select('*');
            $this->db->from($this->primary_table);
            $this->db->where('taskType', 1);
            $this->db->where('taskStatus', 0);
            $this->db->where('phoneTypeCategory', 2);
            $this->db->where('technicalFinish', 0);
            $this->db->where('notificationCustomer', 0);
            $this->db->where_in('shop', array(2));
            $this->db->order_by("warrantyPeriodEnd", "asc");
            
            $query = $this->db->get();
            return $query->result();
        }

        public function readListFinish($shop = null) {
            $this->db->select('*');
            $this->db->from($this->primary_table);
            $this->db->where('taskType', 1);
            $this->db->where('taskStatus', 0);
            $this->db->where_in('technicalFinish', array(1, 2, 3, 4, 5));
            $this->db->where('notificationCustomer', 0);
            if ($shop == 1) {
                $this->db->where_in('shop', array(0, 1));
            } else if ($shop == 2) {
                $this->db->where('shop', 2);
            } else if ($shop == 0) {
                $this->db->where_in('shop', array(0, 1, 2));
            }
            $this->db->order_by("created", "asc");
            $query = $this->db->get();
            return $query->result();
        }

        public function readListVTFinish() {
            $this->db->select('*');
            $this->db->from($this->primary_table);
            $this->db->where('taskType', 1);
            $this->db->where('taskStatus', 0);
            $this->db->where_in('technicalFinish', array(1, 2, 3, 4, 5));
            $this->db->where('notificationCustomer', 0);
            $this->db->where_in('shop', array(0, 1));
            $this->db->order_by("created", "asc");
            $query = $this->db->get();
            return $query->result();
        }

        public function readListLSFinish() {
            $this->db->select('*');
            $this->db->from($this->primary_table);
            $this->db->where('taskType', 1);
            $this->db->where('taskStatus', 0);
            $this->db->where_in('technicalFinish', array(1, 2, 3, 4, 5));
            $this->db->where('notificationCustomer', 0);
            $this->db->where_in('shop', array(2));
            $this->db->order_by("created", "asc");
            $query = $this->db->get();
            return $query->result();
        }

        public function readListNotifiedCustomer($shop = null) {
            $this->db->select('*');
            $this->db->from($this->primary_table);
            $this->db->where('taskType', 1);
            $this->db->where('taskStatus', 0);
            $this->db->where('notificationCustomer', 1);
            if ($shop == 1) {
                $this->db->where_in('shop', array(0, 1));
            } else if ($shop == 2) {
                $this->db->where('shop', 2);
            } else if ($shop == 0) {
                $this->db->where_in('shop', array(0, 1, 2));
            }
            // Box "Đã báo khách hàng đến lấy máy": báo khách sau cùng nằm dưới cùng
            $this->db->order_by("timeNotificationCustomer", "asc");
            $query = $this->db->get();
            return $query->result();
        }

        public function readListVTNotifiedCustomer() {
            $this->db->select('*');
            $this->db->from($this->primary_table);
            $this->db->where('taskType', 1);
            $this->db->where('taskStatus', 0);
            $this->db->where('notificationCustomer', 1);
            $this->db->where_in('shop', array(0, 1));
            $this->db->order_by("timeNotificationCustomer", "asc");
            $query = $this->db->get();
            return $query->result();
        }

        public function readListLSNotifiedCustomer() {
            $this->db->select('*');
            $this->db->from($this->primary_table);
            $this->db->where('taskType', 1);
            $this->db->where('taskStatus', 0);
            $this->db->where('notificationCustomer', 1);
            $this->db->where_in('shop', array(2));
            $this->db->order_by("timeNotificationCustomer", "asc");
            $query = $this->db->get();
            return $query->result();
        }

        public function readListCustomerReceived($shop = null) {
            $datetime = new DateTime(date('Y-m-d H:i:s', time()));
            $datetime->sub(new DateInterval('P2D'));

            $this->db->select('*');
            $this->db->from($this->primary_table);
            $this->db->where('taskType', 1);
            $this->db->where('taskStatus', 1);
            $this->db->where('timeClosedTask >=', $datetime->format('Y-m-d H:i:s'));
            if ($shop == 1) {
                $this->db->where_in('shop', array(0, 1));
            } else if ($shop == 2) {
                $this->db->where('shop', 2);
            } else if ($shop == 0) {
                $this->db->where_in('shop', array(0, 1, 2));
            }
            $this->db->order_by("timeClosedTask", "desc");
            $query = $this->db->get();
            return $query->result();
        }

        public function readListVTCustomerReceived() {
            $datetime = new DateTime(date('Y-m-d H:i:s', time()));
            $datetime->sub(new DateInterval('P2D'));

            $this->db->select('*');
            $this->db->from($this->primary_table);
            $this->db->where('taskType', 1);
            $this->db->where('taskStatus', 1);
            $this->db->where('timeClosedTask >=', $datetime->format('Y-m-d H:i:s'));
            $this->db->where_in('shop', array(0, 1));
            $this->db->order_by("timeClosedTask", "desc");
            $query = $this->db->get();
            return $query->result();
        }

        public function readListLSCustomerReceived() {
            $datetime = new DateTime(date('Y-m-d H:i:s', time()));
            $datetime->sub(new DateInterval('P2D'));

            $this->db->select('*');
            $this->db->from($this->primary_table);
            $this->db->where('taskType', 1);
            $this->db->where('taskStatus', 1);
            $this->db->where('timeClosedTask >=', $datetime->format('Y-m-d H:i:s'));
            $this->db->where_in('shop', array(2));
            $this->db->order_by("timeClosedTask", "desc");
            $query = $this->db->get();
            return $query->result();
        }

        public function readListCustomerReceivedWithPrice($shop = null) {
            $datetime = new DateTime(date('Y-m-d H:i:s', time()));
            $datetime->sub(new DateInterval('P2D'));

            $this->db->select('*');
            $this->db->from($this->primary_table);
            $this->db->where('taskType', 1);
            $this->db->where('taskStatus', 1);
            $this->db->where('timeClosedTask >=', $datetime->format('Y-m-d 0:0:0'));
            $this->db->where('timeClosedTask <=', $datetime->format('Y-m-d 23:59:59'));
            $this->db->where('phonePrice >=', 300000);
            if ($shop == 1) {
                $this->db->where_in('shop', array(0, 1));
            } else if ($shop == 2) {
                $this->db->where('shop', 2);
            } else if ($shop == 0) {
                $this->db->where_in('shop', array(0, 1, 2));
            }
            $this->db->order_by("timeClosedTask", "desc");
            $query = $this->db->get();
            return $query->result();
        }

        public function readListVTCustomerReceivedWithPrice() {
            $datetime = new DateTime(date('Y-m-d H:i:s', time()));
            $datetime->sub(new DateInterval('P2D'));

            $this->db->select('*');
            $this->db->from($this->primary_table);
            $this->db->where('taskType', 1);
            $this->db->where('taskStatus', 1);
            $this->db->where('timeClosedTask >=', $datetime->format('Y-m-d 0:0:0'));
            $this->db->where('timeClosedTask <=', $datetime->format('Y-m-d 23:59:59'));
            $this->db->where('phonePrice >=', 300000);
            $this->db->where_in('shop', array(0, 1));
            $this->db->order_by("timeClosedTask", "desc");
            $query = $this->db->get();
            return $query->result();
        }

        public function readListLSCustomerReceivedWithPrice() {
            $datetime = new DateTime(date('Y-m-d H:i:s', time()));
            $datetime->sub(new DateInterval('P2D'));

            $this->db->select('*');
            $this->db->from($this->primary_table);
            $this->db->where('taskType', 1);
            $this->db->where('taskStatus', 1);
            $this->db->where('timeClosedTask >=', $datetime->format('Y-m-d 0:0:0'));
            $this->db->where('timeClosedTask <=', $datetime->format('Y-m-d 23:59:59'));
            $this->db->where('phonePrice >=', 300000);
            $this->db->where_in('shop', array(2));
            $this->db->order_by("timeClosedTask", "desc");
            $query = $this->db->get();
            return $query->result();
        }

        public function getAllTask($timeFrom, $timeTo) {
            $this->db->select('*');
            $this->db->from($this->primary_table);
            $this->db->where('taskType', 1);
            $this->db->where('taskStatus', 1);
            //$this->db->where('phonePrice >=', 0);
            //$this->db->where_in('shop', array(0, 1, 2));
            $this->db->where('timeClosedTask >', $timeFrom);
            $this->db->where('timeClosedTask <', $timeTo);
            $this->db->order_by("timeClosedTask", "asc");
            
            $query = $this->db->get();
            return $query->result();
        }
        
        public function getAllTaskVT($timeFrom, $timeTo) {
            $this->db->select('COUNT(id) as taskVT, SUM(phonePrice) as totalPriceVT');
            $this->db->from($this->primary_table);
            $this->db->where('taskType', 1);
            $this->db->where('taskStatus', 1);
            //$this->db->where('phonePrice >=', 0);
            $this->db->where_in('shop', array(0, 1));
            $this->db->where('timeClosedTask >', $timeFrom);
            $this->db->where('timeClosedTask <', $timeTo);
            $this->db->order_by("timeClosedTask", "asc");
            
            $query = $this->db->get();
            return $query->result();
        }

        public function getAllTaskLS($timeFrom, $timeTo) {
            $this->db->select('COUNT(id) as taskLS, SUM(phonePrice) as totalPriceLS');
            $this->db->from($this->primary_table);
            $this->db->where('taskType', 1);
            $this->db->where('taskStatus', 1);
            //$this->db->where('phonePrice >=', 0);
            $this->db->where('shop', 2);
            $this->db->where('timeClosedTask >', $timeFrom);
            $this->db->where('timeClosedTask <', $timeTo);
            $this->db->order_by("timeClosedTask", "asc");
            
            $query = $this->db->get();
            return $query->result();
        }

        public function delete_by_id($id) {
            $options = array($this->primary_key => $id);
            $this->delete($options);
        }

        /**
         * Bộ đệm số phiếu theo khách, chỉ có dữ liệu khi trang gọi prefetchCountRequest()
         * (hiện chỉ dùng ở tasks/listTask). Các trang khác: countRequest() query như cũ.
         */
        private $countRequestCache = array();

        /** Đếm số phiếu của nhiều khách bằng 1 query, lưu vào bộ đệm cho countRequest() */
        public function prefetchCountRequest($customerIDs) {
            $customerIDs = array_values(array_unique($customerIDs));
            if (count($customerIDs) == 0) {
                return;
            }
            foreach ($customerIDs as $id) {
                $this->countRequestCache[(string) $id] = 0;
            }
            $this->db->select('customer_id, COUNT(*) AS total', FALSE);
            $this->db->from($this->primary_table);
            $this->db->where_in('customer_id', $customerIDs);
            $this->db->group_by('customer_id');
            foreach ($this->db->get()->result() as $row) {
                $this->countRequestCache[(string) $row->customer_id] = (int) $row->total;
            }
        }

        public function countRequest($customerID) {
            if (isset($this->countRequestCache[(string) $customerID])) {
                return $this->countRequestCache[(string) $customerID];
            }

            // Đếm bằng COUNT(*) trong MySQL thay vì tải toàn bộ phiếu về PHP rồi num_rows()
            $this->db->from($this->primary_table);
            $this->db->where(array('customer_id'=>$customerID));
            return $this->db->count_all_results();
        }

        public function countPriceCustomerRequest ($customerID) {
            $this->db->select_sum('phonePrice');
            $this->db->from($this->primary_table);
            $this->db->where(array('customer_id'=>$customerID));
            $query = $this->db->get();
            if($query->num_rows() > 0)
                return $query->row()->phonePrice;
            else
                return 0;
        }

        public function customerRequest($customerID) {
            $this->db->select('*');
            $this->db->from($this->primary_table);
            $this->db->where(array('customer_id'=>$customerID));
            $this->db->order_by("created", "desc");
            $query = $this->db->get();
            return $query->result();
        }

        public function customerRequestOne($customerID) {
            $this->db->select('*');
            $this->db->from($this->primary_table);
            $this->db->where(array('customer_id'=>$customerID));
            $this->db->order_by("created", "desc");
            $this->db->limit(1);
            $query = $this->db->get();
            return $query->result();
        }

        public function getTaskCustomerAfterTime($customerID, $timeBack) {
            $datetime = new DateTime(date('Y-m-d H:i:s', time()));
            if ($timeBack == 1) {
                $datetime->sub(new DateInterval('P1Y'));
            } else {
                $datetime->sub(new DateInterval('P2Y'));
            }

            $this->db->select('id');
            $this->db->from($this->primary_table);
            $this->db->where(array('customer_id'=>$customerID));
            $this->db->where('created >=', $datetime->format('Y-m-d H:i:s'));
            $query = $this->db->get();
            
            return $query->num_rows();
        }

        public function countTask() {
            $this->db->select('*');
            $this->db->from($this->primary_table);
            $query = $this->db->get();
            return $query->num_rows();
        }

        /**
         * Số phiếu và tổng tiền của nhiều khách trong 1 query
         * (thay cho countRequest() + countPriceCustomerRequest() gọi từng khách).
         * Trả về array(customer_id => object{total, price})
         */
        public function summaryByCustomers($customerIDs) {
            $result = array();
            if (count($customerIDs) == 0) {
                return $result;
            }
            $this->db->select('customer_id, COUNT(*) AS total, SUM(phonePrice) AS price', FALSE);
            $this->db->from($this->primary_table);
            $this->db->where_in('customer_id', $customerIDs);
            $this->db->group_by('customer_id');
            foreach ($this->db->get()->result() as $row) {
                $result[$row->customer_id] = $row;
            }
            return $result;
        }

        /**
         * Phiếu mới nhất (theo created) của nhiều khách trong 1 query
         * (thay cho customerRequestOne() gọi từng khách).
         * Trả về array(customer_id => row phiếu)
         */
        public function latestByCustomers($customerIDs) {
            $result = array();
            if (count($customerIDs) == 0) {
                return $result;
            }
            $ids = implode(',', array_map('intval', $customerIDs));
            $sql = "SELECT t.* FROM tasks t
                    JOIN (SELECT customer_id, MAX(created) AS maxCreated FROM tasks
                          WHERE customer_id IN ({$ids}) GROUP BY customer_id) m
                      ON m.customer_id = t.customer_id AND m.maxCreated = t.created
                    ORDER BY t.id ASC";
            foreach ($this->db->query($sql)->result() as $row) {
                // Trùng created thì giữ phiếu id nhỏ nhất
                if (!isset($result[$row->customer_id])) {
                    $result[$row->customer_id] = $row;
                }
            }
            return $result;
        }
    }