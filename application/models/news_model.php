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
class News_model extends MY_Model {

    var $primary_table = 'news';
    var $fields = array('id_news', 'id_news_category', 'id_language', 'title', 'meta_title',
        'meta_description', 'meta_keywords', 'content', 'link_rewrite', 'active',
        'date_add', 'date_upd', 'focusable', 'news_icon', 'source');
    var $required_fields = array('id_news_category', 'active', 'content', 'link_rewrite');

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
    var $primary_key = 'id_news';

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

    public function get_news_list_by_category_id($category_id, $offset = NULL, $limit = NULL) {
        if (isset($limit)) {
            if (isset($offset)) {
                $option = array('id_news_category' => $category_id, 'limit' => $limit, 'offset' => $offset);
            } else {
                $option = array('id_news_category' => $category_id, 'limit' => $limit);
            }
        } else {
            $option = array('id_news_category' => $category_id);
        }
        $option['sort_by'] = 'date_add';
        $option['sort_direction'] = 'DESC';
        $query = $this->get($option);
        $newses = $query->result();

        return $newses;
    }

    public function count_postnr_by_category_id($category_id) {
        $option = array('id_news_category' => $category_id);
        $query = $this->get($option);
        return $query->num_rows();
    }

    public function read_by_id($id) {
        $options = array($this->primary_key => $id);
        $query = $this->get($options);
        return $query;
    }

    public function getRecordSameCategory($category_id, $post_id, $nb) {
        $this->db->select();
        $this->db->where('id_news_category', $category_id);
        $post_ids = array($post_id);
        $this->db->where_not_in('id_news', $post_ids);
        $this->db->limit($nb);
        $this->db->order_by("date_add", "desc");
        $query = $this->db->get($this->primary_table);
        return $query;
    }

    public function read_list_by_list_categries($category_ids, $offset = NULL, $limit = NULL) {

        if (isset($limit)) {
            if (isset($offset)) {
                $option = array('id_news_category' => $category_ids, 'limit' => $limit, 'offset' => $offset);
            } else {
                $option = array('id_news_category' => $category_ids, 'limit' => $limit);
            }
        } else {
            $option = array('id_news_category' => $category_ids);
        }
        $option['sort_by'] = 'date_add';
        $option['sort_direction'] = 'DESC';

        $query = $this->get($option);
        $newses = $query->result();

        return $newses;
    }

    public function read_list_viewmost_by_list_categries($category_ids, $offset = NULL, $limit = NULL) {

        if (isset($limit)) {
            if (isset($offset)) {
                $option = array('id_news_category' => $category_ids, 'limit' => $limit, 'offset' => $offset);
            } else {
                $option = array('id_news_category' => $category_ids, 'limit' => $limit);
            }
        } else {
            $option = array('id_news_category' => $category_ids);
        }
        $option['sort_by'] = 'counts';
        $option['sort_direction'] = 'DESC';

        $query = $this->get($option);
        $newses = $query->result();

        return $newses;
    }

    public function count_postnr_by_list_categries($category_ids, $offset = NULL, $limit = NULL) {

        if (isset($limit)) {
            if (isset($offset)) {
                $option = array('id_news_category' => $category_ids, 'limit' => $limit, 'offset' => $offset);
            } else {
                $option = array('id_news_category' => $category_ids, 'limit' => $limit);
            }
        } else {
            $option = array('id_news_category' => $category_ids);
        }
        $option['sort_by'] = 'date_add';
        $option['sort_direction'] = 'DESC';

        $query = $this->get($option);
        return $query->num_rows();
    }

    function getCname() {
        $this->db->select('id_news_category,id_parent,name');
        $query = $this->db->get('news_category');
        $record = array();
        $results = $query->result();
        $parents = array();
        foreach ($results as $parent) {
            if (!isset($parent->id_parent)) {
                $parents[$parent->id_news_category] = $parent->name;
            }
        }
        
        foreach ($results as $child) {            
            if (isset($child->id_parent)) {
                if (isset($parents[$child->id_parent])) {
                    $record[$child->id_news_category] = $parents[$child->id_parent].' / '.$child->name;
                }
            }
        }
        return $record;
    }

    function getNew($columm, $id) {
        $this->db->where($columm, $id);
        $query = $this->db->get('news');
        foreach ($query->result_array() as $row) {
            $record = $row;
        }
        return $record;
    }

    function listnews($category_id = NULL) {
        $this->db->select('*');
        $this->db->from($this->primary_table);
        $where_statement =$this->primary_key . " <> " . COMPANY_INSTRODUCE_NEWS_ID 
        							. ' AND ' . $this->primary_key . ' <> ' . SERVICES
							        . ' AND ' . $this->primary_key . ' <> ' . WARRANTY
							        . ' AND ' . $this->primary_key . ' <> ' . SITE_MAP;        
        if (isset($category_id)) {
            $where_statement = $where_statement . ' AND id_news_category = '.$category_id;
        }
        $this->db->where($where_statement);
        $this->db->order_by("id_news", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    public function search($key_search) {
        $this->db->select($this->primary_key . ', id_news_category, title, content, link_rewrite, date_add');
        $this->db->from($this->primary_table);
        $this->db->like('title', $key_search, 'both');
        $this->db->or_like('content', $key_search, 'both');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function you_should_watch()
    {
        $this->db->select('*');
        $this->db->from($this->primary_table);
        $this->db->where( array('id_news_category' => 3, 'should_watch' => 1) );
        $this->db->order_by("date_add", "desc");
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result();
    }

    public function read_by_link_rewrite($link_rewrite){
        $options = array('link_rewrite' => $link_rewrite);
        $query = $this->get($options);
        if ($query->num_rows() > 0){
            return $query->first_row();
        }
        return false;        
    }
}