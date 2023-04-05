<?php

/*
 * This model access page table, manage all page of the site (download, home, about)
 */

/**
 * Description of Tin_tuc
 *
 * @author DAU GAU
 */
class Feedback_model extends MY_Model {

    var $primary_table = 'customer_feedback';
    var $fields = array('id', 'content', 'customer_name', 'designation', 'date_add', 'date_upd');
    var $required_fields = array('content', 'customer_name', 'designation');

    /**
     * Specify additional models to be loaded
     *
     * @var array
     */
    var $models = array();

    /**
     * Set the primary key for the table
     *
     * @var string
     */
    var $primary_key = 'id';

    /**
     * Boolean to toggle field existence checks
     *
     * @var bool
     */
    var $validate_field_existence = FALSE;

    /**
     * Used if there is no primary key for the table
     *
     * @var bool
     */
    var $no_primary_key = FALSE;

    function __construct() {
        parent::__construct();
    }

    public function read_by_id($id) {
        $options = array($this->primary_key => $id);
        $query = $this->get($options);
//        var_dump($query);
        return $query;
    }

    public function read_list() {
        $query = $this->get();
        return $query->result();
    }

    public function delete_by_id($gallery_id) {
        $options = array($this->primary_key => $gallery_id);
        $this->delete($options);
    }

    public function read_latest_list($limit) {
        $options = array('limit' => $limit, 'sort_by' => 'date_add',
            'sort_direction' => 'DESC');
        $query = $this->get($options);
        return $query->result();
    }

}

?>
