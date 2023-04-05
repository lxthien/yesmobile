<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tin_tuc
 *
 * @author DAU GAU
 */
class Admin_menu_model extends MY_Model {

    var $primary_table = 'admin_menu';
    var $fields = array('id', 'name', 'id_item', 'active', 'content_type');
    var $required_fields = array('id', 'active', 'content_type');

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
    
    public function read_list_active(){
        $options = array('active'=>1);
        $query = $this->get($options);
        return $query->result();
    }
}
?>
