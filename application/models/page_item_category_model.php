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
class Page_item_category_model extends MY_Model {
    var $primary_table = 'page_item_category';
   
    var $fields = array('id_page_item_category','id_page_item', 'id_news_category');
    
    var $required_fields = array('id_page_item_category','id_page_item', 'id_news_category');
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
    var $primary_key = 'id_page_item_category';

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
        
    public function get_category_by_page_item($page_item_id){
        $options = array('id_page_item', $page_item_id);
        $query = $this->get($options);
        return $query->result_array();           
    }
}

?>
