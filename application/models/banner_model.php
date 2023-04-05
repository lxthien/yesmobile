<?php

/*
 * This model access page table, manage all page of the site (download, home, about)
 */

/**
 * Description of Tin_tuc
 *
 * @author DAU GAU
 */
class Banner_model extends MY_Model {

    var $primary_table = 'banner';
    var $fields = array('id', 'title', 'url', 'image', 'active');
    var $required_fields = array('image', 'active');

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

//    public function read_list_by_position($position_id) {
//        $options = array('position_id' => $position_id, 'sort_by' => 'index',
//            'sort_direction' => 'DESC', 'active' => '1');
//        $query = $this->get($options);
//        if ($query->num_rows() > 0) {
//            $result = $query->result();
//            return $result;
//        }
//        return false;
//    }

    public function read_list() {
        $query = $this->get();
        return $query->result();
    }

    public function delete_by_id($banner_id) {
        $options = array($this->primary_key => $banner_id);
        $this->delete($options);
    }

    public function get_active_list() {
        $options = array('active' => 1, 'sort_by' => 'id', 'sort_direction' => 'DESC');        
        $query = $this->get($options);
        return $query->result();
    }

}

?>
