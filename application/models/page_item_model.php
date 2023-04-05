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
class Page_item_model extends MY_Model {
    var $primary_table = 'page_item';
   
    var $fields = array('id_page_item','id_page', 'id_parent', 'name', 'index',
        'link_rewrite', 'meta_title', 'meta_description', 'meta_keywords',
        'map_to_category','active');
    
    var $required_fields = array('name','active','link_rewrite');
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
    var $primary_key = 'id_page_item';

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
    /**
     *Search a page in system by link url
     * @param type $linkRewrite
     * @return boolean 
     */
    public function getPageItemByLinkRewrite($linkRewrite){
    $catOptions = array("link_rewrite"=>$linkRewrite);
    $query = $this->get($catOptions);
    $results = $query->result_array();
    if($query->num_rows() > 0){
        return $first_item = $query->first_row();
        
    }
    return false;
    }
    
    public function get_page_items_by_page($page_id){
        $options = array('id_page'=>$page_id);
        $query = $this->get($options);
        return $query->result();
    }
    public function get_page_item_by_category_id($category_id){
        $option = array('map_to_category' => $category_id);
        $query = $this->get($option);
        return $query->result();
    }
    public function read_by_id($page_item_id){
         $option = array($this->primary_key => $page_item_id);         
         $query = $this->get($option);         
         return $query;
    }
}

?>
