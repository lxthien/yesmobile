<?php
    class Customer_model extends MY_Model {
        
        var $primary_table = 'customers';
        var $fields = array('id', 'name', 'phone', 'shop');
        var $required_fields = array('name', 'phone');

        var $primary_key = 'id';

        function __construct() {
            parent::__construct();
        }

        public function read_by_id($id) {
            $options = array($this->primary_key => $id);
            $query = $this->get($options);
            return $query;
        }

        public function read_by_phone($phone) {
            $options = array('phone' => $phone);
            $query = $this->get($options);

            return $query->result();
        }

        public function read_list($search = null, $start = 0, $length = 50) {
            $this->db->select('*');
            $this->db->from($this->primary_table);

            if ($search) {
                $this->db->like('name', $search);
                $this->db->or_like('phone', $search);
            }
            
            $this->db->offset($start);
            $this->db->limit($length);

            $query = $this->db->get();
            return $query->result();
        }

        public function read_all() {
            $query = $this->get();

            return $query->result();
        }

        public function get_all_customers() {
            $query = $this->get();
            return $query->num_rows();
        }

        public function delete_by_id($id) {
            $options = array($this->primary_key => $id);
            $this->delete($options);
        }

        public function getHistoryByNameOrPhone($query) {
            $this->db->select('*');
            $this->db->from($this->primary_table);
            $this->db->where('phone', $query);
            $query = $this->db->get();
            return $query->result();
        }

        /**
         * Danh sách khách cho trang customers/index (DataTables).
         * $inactiveSince: nếu có, chỉ lấy khách KHÔNG có phiếu nào tạo từ thời điểm này.
         * $length <= 0: lấy tất cả (lựa chọn "All").
         * $newestFirst: true = khách mới nhất lên trước (ô tìm nhanh ở trang danh sách phiếu)
         */
        public function readListForPage($search, $inactiveSince, $start, $length, $newestFirst = false) {
            $this->db->select('*');
            $this->_applyListFilters($search, $inactiveSince);
            $this->db->order_by('id', $newestFirst ? 'desc' : 'asc');
            if ($length > 0) {
                $this->db->limit($length, $start);
            }
            return $this->db->get()->result();
        }

        /**
         * Ô "Tìm kiếm Khách hàng" (trang danh sách phiếu): tên hoặc SĐT chứa chuỗi tìm,
         * KHÔNG phân biệt hoa/thường nhưng PHÂN BIỆT DẤU (tìm "Vân" không ra "Vạn", "Văn").
         * Khách mới nhất lên trước.
         */
        public function quickSearchList($search, $limit = 10) {
            $this->db->select('*');
            $this->db->from($this->primary_table);
            $this->db->where($this->_searchCondition($search), NULL, FALSE);
            $this->db->order_by('id', 'desc');
            $this->db->limit($limit);
            return $this->db->get()->result();
        }

        /** Tổng số khách theo cùng điều kiện với readListForPage() */
        public function countListForPage($search, $inactiveSince) {
            $this->_applyListFilters($search, $inactiveSince);
            return $this->db->count_all_results();
        }

        /**
         * Điều kiện tìm khách dùng chung (ô tìm nhanh ở trang danh sách phiếu + trang Danh sách khách hàng):
         * tên hoặc SĐT chứa chuỗi tìm, KHÔNG phân biệt hoa/thường nhưng PHÂN BIỆT DẤU
         * (cột name dùng utf8_general_ci vốn coi "Vân" = "Vạn" = "Văn", nên so sánh LOWER(name) bằng utf8_bin)
         */
        private function _searchCondition($search) {
            $lower = function_exists('mb_strtolower') ? mb_strtolower($search, 'UTF-8') : strtolower($search);
            $like = $this->db->escape_like_str($lower);
            return "(LOWER(name) COLLATE utf8_bin LIKE '%{$like}%' OR phone LIKE '%{$like}%')";
        }

        private function _applyListFilters($search, $inactiveSince) {
            $this->db->from($this->primary_table);

            if ($search) {
                // Tên hoặc SĐT chứa chuỗi tìm kiếm, khớp đúng dấu
                $this->db->where($this->_searchCondition($search), NULL, FALSE);
            }

            if ($inactiveSince) {
                $since = $this->db->escape($inactiveSince);
                $this->db->where("NOT EXISTS (SELECT 1 FROM tasks t WHERE t.customer_id = customers.id AND t.created >= {$since})", NULL, FALSE);
            }
        }
    }
?>