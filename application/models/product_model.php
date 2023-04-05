<?php

/**
 * Description of Phone
 *
 * @author VuQ
 */

class Product_model extends MY_Model {

    var $primary_table = 'product';
    var $fields = array('id', 'producer', 'model', 'price','description', 'introduction','logo', 'product_category_id','best_sell',
    						'link_rewrite','meta_title','meta_description','meta_keywords','date_add','date_upd','active',
    					 'sale_off', 'approx_price', 'status', 'accesory', 'time_warranty', 'is_new', 'moi_ve', 'sap_ve', 'gia_tot', 'qua_tang', 'gia_cu',
    					 'isHight', 'isIntermediate', 'baseInformation', 'noteInformation', 'note', 'isStatus' );
    var $required_fields = array('producer', 'active');

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
        return $query;
    }
    
    public function read_by_category_id2($id) {
    	
    	$options = array('product_category_id' => $id);
    	$query = $this->get($options);
    	
    	return $query->result();
    }
    
    public function read_by_category_id($id) {
    	$this->db->select('*');
    	$this->db->from($this->primary_table);
    	$where_statement = 'product_category_id = '.$id;
    	$this->db->where($where_statement);
    	$this->db->order_by("id", "desc");
    	
    	$query = $this->db->get();
    	return $query->result();    
    }
    
    public function read_by_price_range($from, $to) {
    	
    	$this->db->select('*');
		$this->db->from($this->primary_table);
		$where_statement = 'product_category_id in (2,3,4,7,8,9,10) and price between '. $from*1000000 .' and '. $to*1000000;
		$this->db->where($where_statement);
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		return $query->result();
    }
    
    public function read_by_price_range_limit($from, $to, $with, $limit) {
    	 
    	$this->db->select('*');
    	$this->db->from($this->primary_table);
    	$where_statement = 'product_category_id in (2,3,4,7,8,9,10) and price between '. $from*1000000 .' and '. $to*1000000  .' and id <> '. $with;
    	$this->db->where($where_statement);
    	$this->db->order_by("id", "desc");
    	$this->db->limit($limit);
    	$query = $this->db->get();
    	return $query->result();
    }

    public function read_list() {
    	$this->db->select('*');
    	$this->db->from($this->primary_table);
    	$where_statement =$this->primary_key . " <> " . COMPANY_INSTRODUCE_NEWS_ID 
        							. ' AND ' . $this->primary_key . ' <> ' . SERVICES
							        . ' AND ' . $this->primary_key . ' <> ' . WARRANTY
							        . ' AND ' . $this->primary_key . ' <> ' . SITE_MAP;   
    	$this->db->where($where_statement);
    	$this->db->order_by("id", "desc");
        $query = $this->db->get();
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

	public function list_best_sell(){
		$this->db->select('*');
		$this->db->from($this->primary_table);
		$where_statement = 'product_category_id in (2,3,4,7,8,9,10) and best_sell = 1';
		$this->db->where($where_statement);
		$this->db->order_by("id", "desc");
		$this->db->limit(9);
		$query = $this->db->get();
		return $query->result();
	}

    public function list_home_page(){
        $this->db->select('*');
        $this->db->from($this->primary_table);
        $where_statement = 'product_category_id in (2,3,4,7,8,9,10, 17) and active = 1';
        $this->db->where($where_statement);
        $this->db->order_by("id", "desc");
        $this->db->limit(9);
        $query = $this->db->get();
        return $query->result();
    }
	
	public function get_list_phu_kien_hot(){
		$this->db->select('*');
		$this->db->from($this->primary_table);
		$where_statement = 'product_category_id in (12,13,14,15,16) and active = 1';
		$this->db->where($where_statement);
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		return $query->result();
	}

	public function read_list_newest(){
		$this->db->select('*');
		$this->db->from($this->primary_table);
		$where_statement = 'product_category_id in (2,3,4,7,8,9,10) and active = 1';
		$this->db->where($where_statement);
		$this->db->order_by("id", "desc");
		$this->db->limit(3);
		$query = $this->db->get();
		return $query->result();
	}

	public function getCname()
	{
		$this->db->select('id, parent_id, name');
		$query = $this->db->get('product_category');
		$record = array();
		$results = $query->result();
		$parents = array();
		foreach($results as $parent){
			if(!isset($parent->parent_id)){
				$parents[$parent->id]=$parent->name;
			}
		}
		foreach($results as $child){
			if (isset($child->parent_id)) {
	                if (isset($parents[$child->parent_id])) {
	                    $record[$child->id] = $parents[$child->parent_id].' / '.$child->name;
	                }
	        }
		}
		return $record;
	}

	public function read_by_link_rewrite($link_rewrite){
        $options = array('link_rewrite' => $link_rewrite);
        $query = $this->get($options);
        if ($query->num_rows() > 0){
            return $query->first_row();
        }
        return false;        
    }
    
    public function productHight(){
        $this->db->select('*');
        $this->db->from($this->primary_table);
        $this->db->where( array('isHight' => 1) );
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    public function productIntermediate(){
        $this->db->select('*');
        $this->db->from($this->primary_table);
        $this->db->where( array('isIntermediate' => 1) );
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    public function search($value) {
        $this->db->select('*');
        $this->db->from($this->primary_table);
        //$this->db->where( array('isIntermediate' => 1) );
        $this->db->like('model', $value);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result();
    }

}