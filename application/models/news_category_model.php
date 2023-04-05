<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tintuccategory
 *
 * @author DAU GAU
 */
class News_category_model extends MY_Model{
    var $primary_table = 'news_category';
   
    var $fields = array('id_news_category','id_parent','id_lang', 'name','description', 
        'link_rewrite', 'meta_title','meta_keywords', 'meta_description', 
        'position',  'level_dept');
    
    var $required_fields = array( 'name', 'link_rewrite');
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
    var $primary_key = 'id_news_category';

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

    public function read_list() {
        $query = $this->get();
        return $query->result();
    }

    public function getIdCategoryByLinkRewrite($link_rewrite){
        $query = $this->getCategoryByLinkRewrite($link_rewrite);
        if (!$query){
            return $query->id_news_category;
        }
        return false;
    }
    
    public function getCategoryByLinkRewrite($link_rewrite){
        $catOptions = array("link_rewrite"=>$link_rewrite);
        $query = $this->get($catOptions);        
    	if ($query->num_rows() > 0){
            return $query->first_row();
        }
        return false;
    }

    public function read_by_link_rewrite($link_rewrite){
        $catOptions = array("link_rewrite"=>$link_rewrite);
        $query = $this->get($catOptions);        
        if($query->num_rows() > 0){
            $row = $query->first_row();
            return $row;
        }
        return false;
    }
 
    public function readListByParentId($parent_id){
        $catOptions = array("id_parent" => $parent_id);
        $query = $this->get($catOptions);        
        
        return $query->result_array();
    }
    
    public function read_list_by_parent_id($parent_id){
        $catOptions = array("id_parent" => $parent_id);
        $query = $this->get($catOptions);        
        
        return $query->result();
    }
    
    public function read_by_id($id){
        $options = array('id_news_category' => $id);
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

    public function buildTree($categories) {
        $resuls = array();
        $resuls['NULL'] = '---Thư mục gốc---';
        foreach ($categories as $category) {
            if ( $category->id_parent === NULL ) {
                $resuls[$category->id_news_category] = $category->name;
                foreach ($categories as $row) {
                    if ( $row->id_parent === $category->id_news_category ) {
                        $resuls[$row->id_news_category] = '..........'.$row->name;
                        foreach ($categories as $row1) {
                            if ( $row1->id_parent === $row->id_news_category ) {
                                $resuls[$row1->id_news_category] = '....................'.$row1->name;
                            }
                            unset($row1);
                        }
                    }
                    unset($row);
                }
                unset($category);
            }
        }
        return $resuls;
    }

}