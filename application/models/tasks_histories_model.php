<?php

class Tasks_Histories_Model extends MY_Model {

    var $primary_table = 'tasks_histories';
    var $fields = array('id', 'user_id', 'task_id', 'tracks', 'created');
    var $required_fields = array('user_id', 'task_id');

    var $primary_key = 'id';

    function __construct() {
        parent::__construct();
    }

    public function read_by_id($id) {
        $options = array($this->primary_key => $id);
        $query = $this->get($options);
        return $query;
    }

    public function read_by_task_id($taskID) {
        $this->db->select('*');
        $this->db->from($this->primary_table);
        $this->db->where(array('task_id'=>$taskID));
        $this->db->order_by("created", "desc");
        $query = $this->db->get();
        return $query->result();
    }

}