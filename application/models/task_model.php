<?php
    class Task_model extends MY_Model {
        
        var $primary_table = 'tasks';
        var $fields = array('id', 'code', 'taskName', 'taskType', 'customer_id', 'phoneType', 'phoneTypeCategory', 'phoneImei', 'notePrivate', 'phonePass', 'phonePrice', 'phoneStatus', 'phoneSim', 'warrantyPeriod', 'warrantyPeriodEnd', 'technicalFinish', 'notificationCustomer', 'timeNotificationCustomer', 'quickStatus', 'taskStatus', 'note', 'isCustomerVip', 'timeClosedTask', 'timeWarranty', 'useAccessories', 'createdBy', 'updatedBy', 'shop', 'manufactory', 'features', 'phieu', 'khachMuonMay', 'updateNote', 'updateFlags', 'paymentMethod', 'accessoryPrice', 'brandId', 'repairCategoryId', 'created', 'updated');
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
            $this->db->where_in('technicalFinish', array(1, 2, 3, 4, 5, 6, 7));
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
            $this->db->where_in('technicalFinish', array(1, 2, 3, 4, 5, 6, 7));
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
            $this->db->where_in('technicalFinish', array(1, 2, 3, 4, 5, 6, 7));
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
         * Ô "Tìm kiếm Khách hàng": tìm khách theo TÊN MÁY hoặc IMEI của các phiếu (khách đổi số, quên số cũ).
         * Trả về array(customer_id => phiếu khớp gần nhất), tối đa $limit khách, phiếu mới nhất trước.
         * $excludeIDs: khách đã tìm thấy theo tên/SĐT, bỏ qua.
         */
        public function searchCustomersByDevice($search, $limit = 10, $excludeIDs = array()) {
            $like = $this->db->escape_like_str($search);
            $conditions = array("phoneType LIKE '%{$like}%'");
            // Cột phoneImei là latin1: chỉ so khi từ khoá không có ký tự ngoài ASCII (IMEI chỉ gồm chữ, số)
            if (!preg_match('/[^\x20-\x7E]/', $search)) {
                $conditions[] = "phoneImei LIKE '%{$like}%'";
            }

            $this->db->select('customer_id, phoneType, phoneImei');
            $this->db->from($this->primary_table);
            $this->db->where('customer_id >', 0);
            $this->db->where('(' . implode(' OR ', $conditions) . ')', NULL, FALSE);
            if (count($excludeIDs) > 0) {
                $this->db->where_not_in('customer_id', $excludeIDs);
            }
            $this->db->order_by('id', 'desc');
            $this->db->limit(300);

            $result = array();
            foreach ($this->db->get()->result() as $row) {
                if (!isset($result[$row->customer_id])) {
                    $result[$row->customer_id] = $row;
                    if (count($result) >= $limit) {
                        break;
                    }
                }
            }
            return $result;
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
    
        /**
         * Thống kê tháng: cùng điều kiện với trang Doanh thu theo ngày (phiếu sửa chữa, đã giao, theo ngày giao máy).
         * $shop: '' = tất cả, 1 = Vũng Tàu (shop 0/1), 2 = Long Sơn.
         */
        private function _statsFilter($timeFrom, $timeTo, $shop) {
            $this->db->from($this->primary_table);
            $this->db->where('taskType', 1);
            $this->db->where('taskStatus', 1);
            $this->db->where('timeClosedTask >=', $timeFrom);
            $this->db->where('timeClosedTask <', $timeTo);
            if ($shop == 1) {
                $this->db->where_in('shop', array(0, 1));
            } else if ($shop == 2) {
                $this->db->where('shop', 2);
            }
        }

        /** Số máy, doanh thu, số máy không sửa theo từng cặp (thương hiệu, hạng mục) */
        public function statsByCategory($timeFrom, $timeTo, $shop) {
            $this->db->select('brandId, repairCategoryId, COUNT(*) AS total, SUM(phonePrice) AS revenue, SUM(technicalFinish IN (2,3,4,5)) AS noRepair', FALSE);
            $this->_statsFilter($timeFrom, $timeTo, $shop);
            $this->db->group_by(array('brandId', 'repairCategoryId'));
            return $this->db->get()->result();
        }

        /** Danh sách phiếu của 1 ô thống kê ($brandId / $repairId = null: không lọc) */
        public function statsTasks($timeFrom, $timeTo, $shop, $brandId, $repairId) {
            $this->db->select('*');
            $this->_statsFilter($timeFrom, $timeTo, $shop);
            if ($brandId !== null) {
                $this->db->where('brandId', (int) $brandId);
            }
            if ($repairId !== null) {
                $this->db->where('repairCategoryId', (int) $repairId);
            }
            $this->db->order_by('timeClosedTask', 'asc');
            return $this->db->get()->result();
        }

        /** Phiếu sửa chữa còn thiếu thương hiệu hoặc hạng mục (để tự phân loại) */
        public function readUnclassified() {
            $this->db->select('id, phoneType, phoneTypeCategory, phoneStatus, note, brandId, repairCategoryId');
            $this->db->from($this->primary_table);
            $this->db->where('taskType', 1);
            $this->db->where('(brandId = 0 OR repairCategoryId = 0)', NULL, FALSE);
            return $this->db->get()->result();
        }

        public function countUnclassified() {
            $this->db->from($this->primary_table);
            $this->db->where('taskType', 1);
            $this->db->where('(brandId = 0 OR repairCategoryId = 0)', NULL, FALSE);
            return $this->db->count_all_results();
        }

        /**
         * Danh sách phiếu chưa phân loại để phân loại tay.
         * $missing: '' = thiếu 1 trong 2, 'brand' = thiếu thương hiệu, 'repair' = thiếu hạng mục. Phiếu mới lên trước.
         */
        public function readUnclassifiedList($missing = '') {
            $this->db->select('id, code, customer_id, phoneType, phoneStatus, note, phonePrice, technicalFinish, taskStatus, timeClosedTask, created, shop, brandId, repairCategoryId');
            $this->db->from($this->primary_table);
            $this->db->where('taskType', 1);
            if ($missing == 'brand') {
                $this->db->where('brandId', 0);
            } else if ($missing == 'repair') {
                $this->db->where('repairCategoryId', 0);
            } else {
                $this->db->where('(brandId = 0 OR repairCategoryId = 0)', NULL, FALSE);
            }
            $this->db->order_by('id', 'desc');
            return $this->db->get()->result();
        }

        /** Phân loại tay 1 phiếu (chỉ 2 cột brandId / repairCategoryId) */
        public function setCategory($id, $column, $value) {
            if (!in_array($column, array('brandId', 'repairCategoryId'))) {
                return false;
            }
            $this->db->where('id', (int) $id);
            $this->db->where('taskType', 1);
            $this->db->update($this->primary_table, array($column => (int) $value));
            return true;
        }

        /** Gán 1 cột phân loại cho nhiều phiếu, chỉ những phiếu cột đó đang trống (không đè lựa chọn của nhân viên) */
        public function setCategoryWhereEmpty($column, $value, $ids) {
            if (!in_array($column, array('brandId', 'repairCategoryId')) || count($ids) == 0) {
                return 0;
            }
            $updated = 0;
            foreach (array_chunk($ids, 500) as $chunk) {
                $this->db->where_in('id', $chunk);
                $this->db->where($column, 0);
                $this->db->update($this->primary_table, array($column => (int) $value));
                $updated += $this->db->affected_rows();
            }
            return $updated;
        }
    }