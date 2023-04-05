<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of category
 *
 * @author DAU GAU
 */
class category extends Admin_Controller{
    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->model('Tin_tuc_category','newsCategory');
    }
    function buildTree(){
        $query = $this->newsCategory->getAllCategories();
        $children = array();
        foreach ($query->result() as $row)
        { 
            $child = array();
            
            $child['id_news_category'] = $row->id_news_category;
            $child['name'] = $row->name;
            $child['description'] = $row->description;
            $children[$child['id_news_category']] = $child;
        }
        
        return $children;
    }
}

?>
