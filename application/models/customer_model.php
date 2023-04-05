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
    }
?>