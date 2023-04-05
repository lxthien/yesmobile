<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Mcontact extends MY_Model{
    var $primary_table = 'contact';
    var $fields = array('id_contact','position','name','skype','yahoo','phone');
    var $required_fields = array('position','name','phone');
    var $models = array();
    var $primary_key = 'id_contact';
    var $validate_field_existence = FALSE;
    var $no_primary_key = FALSE;
    
    function __construct() {
        parent::__construct();
        $this->load->helper('text');
    }
    public function read_by_id($id) {
        $options = array($this->primary_key=>$id);
        $query = $this->get($options);
        return $query;
    }
    function getContact($id){
        $option = array($this->primary_key=>$id);
         $this->db->where($col,$id_contact);
         return $this->get($option);
//        $query=$this->db->get('online_support');
//        foreach ($query->result_array() as $row){
//            $record=$row;
//        }
//        return $record;
    }
    
    function listContact(){
        $option = array('sort_by' => $this->primary_key,
            'sort_direction' => 'ASC');
        $query=$this->get($option);
        return $query->result();
    }
	
	function listContactAdmin(){
        $query=$this->get();
        return $query->result();
    }
}
?>
