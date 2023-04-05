<?php

/*
 * This model access page table, manage all page of the site (download, home, about)
 */

/**
 * Description of Tin_tuc
 *
 * @author DAU GAU
 */
class Image_model extends MY_Model {

    var $primary_table = 'image';
    var $fields = array('id', 'name', 'description', 'album_id', 'date_add', 'date_upd');
    var $required_fields = array('name', 'album_id');

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
//        var_dump($query);
        return $query;
    }

    public function read_list() {
//        $options = array('active'=>TRUE);        
//        $query = $this->get($options);
        $query = $this->get();
        return $query->result();
    }

    public function read_list_by_album_id($album_id) {
        $options = array('album_id' => $album_id, 'sort_by' => 'date_add', 'sort_direction' => 'DESC');
        $query = $this->get($options);
        return $query->result();
    }

    public function read_array_by_album_id($album_id) {
        $options = array('album_id' => $album_id, 'sort_by' => 'date_add', 'sort_direction' => 'DESC');
        $query = $this->get($options);
        return $query->result_array();
    }

    public function delete_by_name($name) {
        $this->db->delete($this->primary_table, array('name' => $name));
    }

    public function get_first_image_by_album($album_id) {
        $options = array('album_id' => $album_id, 'limit' => '1', 
                         'sort_by' => 'date_add', 
                         'sort_direction' => 'DESC');
        $query = $this->get($options);
        $result = $query->first_row();
        if (count($result) > 0)
        return $result;
    }

        public function get_latest_image_by_gallery_ids($gallery_ids,$limit_per_category){
        $results = array();
        foreach($gallery_ids as $gallery_id){
         $result = $this->get_lastest_image_by_gallery_id($gallery_id, $limit_per_category);
         if (isset($result) && count($result) > 0){
             $results = array_merge($results, $result);
         }
        }
        return $results;
    }
    public function get_lastest_image_by_gallery_id($gallery_id, $limit){
        $options = array('album_id' => $album_id, 'limit' => $limit, 
                         'sort_by' => 'date_add', 
                         'sort_direction' => 'DESC');
        $query = $this->get($options);
        $result = $query->result();        
        return $result;
    }
    public function get_latest_images($limit){
        $options = array('limit' => $limit, 
                         'sort_by' => 'date_add', 
                         'sort_direction' => 'DESC');
        $query = $this->get($options);
        $result = $query->result();        
        return $result;
    }
}

?>
