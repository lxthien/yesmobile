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
class Gallery_category_model extends MY_Model {

    var $primary_table = 'gallery_category';
    var $fields = array('id', 'name', 'index', 'description', 'meta_title',
        'meta_description', 'meta_keywords', 'link_rewrite');
    var $required_fields = array('name', 'index', 'link_rewrite');

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
        $this->load->helper('text');
    }

    public function read_list() {
        $query = $this->get();
        return $query->result();
    }

    public function read_list_id_and_name() {
        $query = $this->get();
        $categories = $query->result();
        $results = array();
        foreach ($categories as $category) {
            $results[$category->id] = $category->name;
        }
        return $results;
    }

    public function read_by_id($id) {
        $options = array($this->primary_key => $id);
        $query = $this->get($options);
//        var_dump($query);
        return $query;
    }
    
}

?>
