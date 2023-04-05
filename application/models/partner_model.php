<?php

/*
 * This model access page table, manage all page of the site (download, home, about)
 */

/**
 * Description of Tin_tuc
 *
 * @author DAU GAU
 */
class Partner_model extends MY_Model {

    var $primary_table = 'partner';
    var $fields = array('id', 'name', 'url', 'url','logo');
    var $required_fields = array('name', 'url');

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

    public function read_by_link_rewrite($link_rewrite) {
        $options = array('link_rewrite' => $link_rewrite);
        $query = $this->get($options);
        if ($query->num_rows() > 0) {
            return $query->first_row();
        }
        return false;
    }

    public function read_list() {
//        $options = array('active'=>TRUE);        
//        $query = $this->get($options);
        $query = $this->get();
        return $query->result();
    }

    public function delete_by_id($gallery_id) {
        $options = array($this->primary_key => $gallery_id);
        $this->delete($options);
    }

    public function read_latest_list($limit) {
        $options = array('limit' => $limit);
        $query = $this->get($options);
        return $query->result();
    }
}

?>
