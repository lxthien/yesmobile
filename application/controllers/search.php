<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tintuc
 *
 * @author DAU GAU
 */
class Search extends MY_Controller {

    //put your code here
    var $page_meta = array();
    var $title_character_nr = 80;
    var $content_word_nr = 100;
    var $total_posts;
    var $site_meta_data = array();

    public function __construct() {
        parent::__construct();
        $this->load->model('News_model', 'news_model');
        $this->load->model('Page_model', 'page_model');
        $this->load->model('Page_item_model', 'page_item_model');
        $this->load->model('News_category_model', 'news_category_model');
        $this->load->model('Gallery_model', 'gallery_model');
        $this->load->model('Gallery_category_model', 'gallery_category_model');
        $this->load->model('Mcontact');
    }

    function index($key_search = NULL) {
        if (!isset($_GET['value'])) {
            redirect(base_url());
        }
        $key_search = $this->input->get('value');
        $data = $this->load->get_var('data');
        $page_second_left['page_name'] = 'Search';
        $data['page_second_left'] = $page_second_left;
        $data['partners'] = $this->_get_partners();
        $this->_load_meta_data($key_search);
        $data['site_meta_data'] = $this->site_meta_data;
        $data['contact_block'] = $this->_load_contact_block();
        $data['download_block_main'] = $this->_get_search_results($key_search);
        $this->load->view('download', $data);
    }

    private function _load_meta_data($search_phrase){
        $this->site_meta_data['title'] = 'Tìm từ khóa "'.$search_phrase.'"' ;
        $this->site_meta_data['meta_title'] = $this->site_meta_data['title'];
    }

    private function _load_contact_block() {
        $data = array();
        $data['contact'] = $this->Mcontact->listcontact();
        return $this->load->view('hotline/block_hot_line', $data, TRUE);
    }

    private function _get_search_results($key_search) {
        $data = array();
        $data['block_title'] = 'Tìm kiếm Thanh Tuấn FX';
        $search_results = array();
        $page_links = $this->_page_links();

        $page_items_links = $this->_page_item_links($page_links);
        if (isset($key_search)) {
            $news_searches = $this->news_model->search($key_search);
            if ($news_searches !== FALSE) {
                $category_links = $this->_category_links($page_items_links);
                $news_search_results = $this->_build_news_search_results($news_searches, $category_links);
                if (count($news_search_results) > 0) {
                    $search_results = array_merge($search_results, $news_search_results);
                }
            }

            $gallery_searches = $this->gallery_model->search($key_search);
            if ($gallery_searches !== FALSE) {
                $gallery_category_links = $this->_gallery_category_links($page_items_links['page_item3']);
                $gallery_search_results = $this->_build_gallery_search_results($gallery_searches, $gallery_category_links);
                if (count($gallery_search_results) > 0) {
                    $search_results = array_merge($search_results, $gallery_search_results);
                }
            }
        }


        $data['search_results'] = $search_results;

        return $this->load->view('search/block_result_list_display', $data, TRUE);
    }

    private function _build_news_search_results($news_search_results, $news_category_links) {
        $results = array();
        foreach ($news_search_results as $news_search_result) {
            $result = new stdClass();
            if ($news_search_result->id_news === COMPANY_INSTRODUCE_NEWS_ID 
            		|| $news_search_result->id_news === SERVICES
            		|| $news_search_result->id_news === WARRANTY
            		|| $news_search_result->id_news === SITE_MAP) {
                $link_rewrite = 'gioi-thieu/' . $news_search_result->link_rewrite . URL_TRAIL;
            } else {
                $link_rewrite = $news_category_links[$news_search_result->id_news_category] . '/' .
                        $news_search_result->id_news . '-' . $news_search_result->link_rewrite . URL_TRAIL;
            }
            $description = $news_search_result->content;
            $date_add;
            if (isset($news_search_result->date_add)) {
                $date_add = $news_search_result->date_add;                
            }
            $result = $this->_create_search_result($news_search_result->title, $description, $link_rewrite, $date_add);
            array_push($results, $result);
        }
        return $results;
    }

    private function _create_search_result($name, $description, $link_rewrite, $date_add) {
        $result = new stdClass();
        $result->name = $name;
        $description = strip_tags($description);
        $description = text_cut($description, MAX_DES_CONTENT);
        $result->description = trim($description);
        $result->link_rewrite = $link_rewrite;
        if (isset($date_add)) {
            $result->date_add = $date_add;
        }
        return $result;
    }

    private function _page_links() {
        $pages = $this->page_model->read_list();
        $page_links = array();
        foreach ($pages as $page) {
            $page_links[$page->id_page] = $page->link_rewrite;
        }
        return $page_links;
    }

    private function _page_item_links($page_links) {
        $page_items = $this->page_item_model->get()->result();
        $page_item_links = array();
        foreach ($page_items as $page_item) {
            $link_rewrite = $page_links[$page_item->id_page];
            if (isset($page_item->link_rewrite)) {
                $link_rewrite = $link_rewrite . '/' . $page_item->link_rewrite;
            }

            if (isset($page_item->map_to_category)) {
                $page_item_links[$page_item->map_to_category] = $link_rewrite;
            } else {
                $page_item_links['page_item' . $page_item->id_page_item] = $link_rewrite;
            }
        }
        return $page_item_links;
    }

    private function _category_links($page_item_links) {
        $categories = $this->news_category_model->get()->result();
        $category_links = array();
        foreach ($categories as &$category) {
            if (!isset($category->id_parent)) {
                $category_links[$category->id_news_category] = $page_item_links[$category->id_news_category];
                unset($category);
            }
        }
        foreach ($categories as $category) {
            if (isset($category->id_parent)) {
                $category_links[$category->id_news_category] = $category_links[$category->id_parent] . '/' . $category->link_rewrite;
            }
        }
        return $category_links;
    }

    private function _gallery_category_links($page_link) {
        $gallery_categories = $this->gallery_category_model->read_list();
        $gallery_category_links = array();
        foreach ($gallery_categories as $category) {
            $gallery_category_links[$category->id] = $page_link . '/' . $category->id . '-' . $category->link_rewrite;
        }
        return $gallery_category_links;
    }

    private function _get_partners() {
        $this->load->model('Partner_model', 'partner_model');
        return $this->partner_model->read_list();
    }

    private function _build_gallery_search_results($gallery_searches, $gallery_category_links) {
        $results = array();
        foreach ($gallery_searches as $gallery) {
            $link_rewrite = $gallery_category_links[$gallery->category_id] . '/' . $gallery->id . '-' . $gallery->link_rewrite . URL_TRAIL;
            $result = $this->_create_search_result($gallery->name, $gallery->description, $link_rewrite);
            array_push($results, $result);
        }
        return $results;
    }

}