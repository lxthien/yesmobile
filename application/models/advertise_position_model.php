<?php

/*
 * This model access page table, manage all page of the site (download, home, about)
 */

/**
 * Description of Tin_tuc
 *
 * @author DAU GAU
 */
class Advertise_position_model extends MY_Model {

    var $primary_table = 'advertise_position';
    var $fields = array('id', 'name');
    var $required_fields = array();

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

    public function build_position_name() {
        $positions = $this->read_list();        
        $position_names = array();
        foreach ($positions as $position) {
            if ($position->id !== '1') {
                $position_names[$position->id] = $position->name;
            }
        }
        return $position_names;
    }

//    public function delete_by_id($gallery_id) {
//        $options = array($this->primary_key => $gallery_id);
//        $this->delete($options);
//    }
//
//    public function read_latest_list($limit) {
//        $options = array('limit' => $limit);
//        $query = $this->get($options);
//        return $query->result();
//    }
}

?>
