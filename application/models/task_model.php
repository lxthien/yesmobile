<?php
    class Task_model extends MY_Model {
        
        var $primary_table = 'tasks';
        var $fields = array('id', 'code', 'taskName', 'taskType', 'customer_id', 'phoneType', 'phoneTypeCategory', 'phoneImei', 'notePrivate', 'phonePass', 'phonePrice', 'phoneStatus', 'phoneSim', 'warrantyPeriod', 'warrantyPeriodEnd', 'technicalFinish', 'notificationCustomer', 'timeNotificationCustomer', 'quickStatus', 'taskStatus', 'note', 'isCustomerVip', 'timeClosedTask', 'timeWarranty', 'useAccessories', 'createdBy', 'updatedBy', 'shop', 'manufactory', 'features', 'phieu', 'khachMuonMay', 'created', 'updated');
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
            $this->db->where_in('phoneTypeCategory', array(1,2));
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
            $this->db->where_in('phoneTypeCategory', array(1,2));
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
            $this->db->where_in('phoneTypeCategory', array(1,2));
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
            $this->db->where_in('technicalFinish', array(1, 2, 3));
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
            $this->db->where_in('technicalFinish', array(1, 2, 3));
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
            $this->db->where_in('technicalFinish', array(1, 2, 3));
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
            $this->db->order_by("created", "asc");
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
            $this->db->order_by("created", "asc");
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
            $this->db->order_by("created", "asc");
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

        public function countRequest($customerID) {
            $this->db->select('*');
            $this->db->from($this->primary_table);
            $this->db->where(array('customer_id'=>$customerID));
            $query = $this->db->get();
            return $query->num_rows();
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
    }