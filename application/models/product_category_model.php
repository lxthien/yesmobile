<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tin_tuc
 *
 * @author Quang
 */
class Product_Category_Model extends MY_Model {

    var $primary_table = 'product_category';
    var $fields = array('id', 'name', 'index', 'parent_id', 'meta_title',
        'meta_description', 'meta_keywords', 'link_rewrite');
    var $required_fields = array('name');

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
        foreach ($categories as $key => $value) {
            if (!isset($value->parent_id) || strlen($value->parent_id) === 0) {
                echo $value->parent_id;
                $children = $this->build_selection_list($categories, $value->id);
                if (count($children) > 0) {
                    $results[$value->name] = $children;
                } else {
                    $results[$value->id] = $value->name;
                }
                unset($categories[$key]);
            }
        }
        return $results;
    }

    public function read_by_id($id) {
        $options = array($this->primary_key => $id);
        $query = $this->get($options);
        return $query;
    }

    private function build_selection_list(&$categories, $parent_id) {
        $resuls = array();        
        foreach ($categories as $category) {
            if (isset($category->parent_id) && $category->parent_id === $parent_id) {
                $resuls[$category->id] = $category->name;
                unset($category);
            }
        }         
        return $resuls;
    }
    
    public function read_by_link_rewrite($link_rewrite) {
        $options = array('link_rewrite' => $link_rewrite);
        $query = $this->get($options);
        if ($query->num_rows() > 0){
        	return $query->first_row();
        }
        return false;
    }
    
    public function read_by_parent_id($parent_id) {
    	$options = array('parent_id' => $parent_id);
    	$query = $this->get($options);
    	return $query->result();
    }

    public function readListByParentId($parent_id){
        $catOptions = array("parent_id" => $parent_id);
        $query = $this->get($catOptions);        
        
        return $query->result_array();
    }
}