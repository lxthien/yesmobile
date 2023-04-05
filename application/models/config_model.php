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
class Config_model extends MY_Model {
    var $primary_table = 'site_configurations';
   
    var $fields = array('id','param','name','value','active');
    
    var $required_fields = array('id', 'param', 'name', 'active');
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
//        $this->load->helper('text');
    }    
    public function read_list($offset = NULL, $limit = NULL){
        if (isset($limit)){            
            if (isset($offset)){
                $option = array('limit' => $limit,'offset' => $offset);
            } else {
                $option = array('limit' => $limit);
            }  
        } else {
            $option = array();
        }
        $query = $this->get($option);        
        $configs = $query->result();        
        return $configs;        
    }
    
    public function get_value($name){
        $option = array('param'=>$name,'active'=>1);        
        $query = $this->get($option);                
//        $results = $query->result();
        if ($query->num_rows() > 0) {
        return $query->first_row()->value;    
        }
        return 'No value';
    }        
}

?>
