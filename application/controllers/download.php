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
class Download extends MY_Controller {

    //put your code here
    var $page_meta = array();
    var $title_character_nr = 80;
    var $content_word_nr = 100;
    var $total_posts;
    var $site_meta_data = array();

    public function __construct() {
        parent::__construct();
        $this->load->model('Download_model', 'download_model');
        $this->load->model('Download_category_model', 'download_category_model');
        $this->load->model('Mcontact');
        $this->load->model('Advertise_model','advertise_model');
        $this->load->model('Banner_model', 'banner_model');
    }
    public function index() {
        $data = $this->load->get_var('data');
        $page = $this->_load_page($this->uri->segment(1));
        
        if (!$page) {
            show_404();
        }
        $this->_get_meta_data($page);
        $data['contact_block'] = $this->_load_contact_block();        
        $data['download_block_main'] = $this->_load_downloads_block();
        $data['site_meta_data'] = $this->site_meta_data;
        $data['partners'] = $this->_get_partners();
        $data['page_name'] = 'Táº£i Vá»�';
        $data['banners'] = $this->banner_model->get_active_list();
        $data['home_advertises'] = $this->advertise_model->read_list_by_position(1);
        $data['latest_downloads'] = $this->get_latest_download();
        $data['download_menu'] = $this->download_category_model->read_by_parent_id(1);
        $this->load->view('download', $data);
    }
    
    
    public function view_download_on_category ($downloadCategory, $subCatDownload, $page_nr) {
    	
    	$category = $this->download_category_model->read_by_link_rewrite($subCatDownload);
    	$data = $this->load->get_var('data');
    	$page = $this->_load_page($this->uri->segment(1));
    	
    	if (!$page) {
    		show_404();
    	}
    	$this->_get_meta_data($page);
//     	$data['categoryDownload'] = $category;
    	$data['contact_block'] = $this->_load_contact_block();
    	$data['download_block_main'] = $this->_load_downloads_by_category($category);
    	$data['site_meta_data'] = $this->site_meta_data;
    	$data['partners'] = $this->_get_partners();
    	$data['page_name'] = 'Táº£i Vá»�';
    	$data['banners'] = $this->banner_model->get_active_list();
    	$data['home_advertises'] = $this->advertise_model->read_list_by_position(1);
    	$data['latest_downloads'] = $this->get_latest_download();
    	$data['download_menu'] = $this->download_category_model->read_by_parent_id(1);
    	$this->load->view('download', $data);
    }
    
    public function get_latest_download() {
    	$latest_downloads = $this->download_model->_get_latest_download();
    	foreach ($latest_downloads as $download) {
    		$eachCategory = $this->download_category_model->read_by_id($download->category_id);
    		$download->link_rewrite = 'tai-ve/'.$eachCategory->link_rewrite.'/'.$download->id.'-'.$download->link_rewrite.URL_TRAIL;
    
    	}
    	 
    	return $latest_downloads;
    }
    public function view_details ($downloadCategory, $subCatDownload, $downloadId) {
    	$download = $this->download_model->read_by_id($downloadId);
    	$page = $this->_load_page($this->uri->segment(1));
    	
    	if (!$page) {
    		show_404();
    	}
    	$this->_get_meta_data($page);
    	$data['contact_block'] = $this->_load_contact_block();
    	$data['download_block_main'] = $this->_view_detail_one_download($download, $downloadCategory, $subCatDownload);
    	$data['site_meta_data'] = $this->site_meta_data;
    	$data['partners'] = $this->_get_partners();
    	$data['page_name'] = 'Táº£i Vá»� aaa';
    	$data['banners'] = $this->banner_model->get_active_list();
    	$data['home_advertises'] = $this->advertise_model->read_list_by_position(1);
    	$data['latest_downloads'] = $this->get_latest_download();
    	$data['download_menu'] = $this->download_category_model->read_by_parent_id(1);
    	$this->load->view('download', $data);
    }
    
    private function _view_detail_one_download($selectedDownload, $downloadCategory, $subCatDownload) {
    	$data = array();
    	$this->_get_meta_data($selectedDownload);
    	$data['block_title'] = $this->site_meta_data['title'];
    	$data['site_meta_data'] = $this->site_meta_data;
    	$downloads = $this->download_model->read_list_by_category($selectedDownload->category_id, LIMIT_SHOW_ALL_NEWS);
    	 
    	foreach ($downloads as &$download){
    		$download->file_name = base_url(DOWNLOAD_DIR.'/'.$download->file_name);
    		$download = $this->truncate_title_content_post($download, 82, 85);
    		$download->link_rewrite = $downloadCategory.'/'.$subCatDownload.'/'.$download->id.'-'.$download->link_rewrite.URL_TRAIL;
    	}
    	
    	$category = $this->download_category_model->read_by_link_rewrite($subCatDownload);
    	$data['downloadList'] = $downloads;
    	$data['selectedDownload'] = $selectedDownload;
    	$data['categoryName'] = $category->name;
    	return $this->load->view('download/display_download_details',$data,TRUE);
    }
    
    private function _load_contact_block() {
        $data = array();
        $data['contact'] = $this->Mcontact->listcontact();
        return $this->load->view('hotline/block_hot_line', $data, TRUE);
    }
    
    private function _load_downloads_by_category($category) {
    	$data = array();
    	$page_link_rewrite = $this->uri->segment(2);
    	$post = $this->_load_page_category($page_link_rewrite);
    	$this->_get_meta_data($post);
    	$data['block_title'] = $this->site_meta_data['title'];
    	$data['site_meta_data'] = $this->site_meta_data;
    	
    	$downloads = $this->download_model->read_list_by_category($category->id, LIMIT_SHOW_ALL_NEWS);
    	
    	foreach ($downloads as &$download){
    		$download->file_name = base_url(DOWNLOAD_DIR.'/'.$download->file_name);
    		$download = $this->truncate_title_content_post($download, 82, 85);
    		$download->link_rewrite = 'tai-ve/'.$category->link_rewrite.'/'.$download->id.'-'.$download->link_rewrite.URL_TRAIL;
    	}
    
    	$data['downloadList'] = $downloads;
    	$data['selectedCategory'] = $category;
    	return $this->load->view('download/display_one_category_download',$data,TRUE);
    }

    private function _load_downloads_block() {
        $data = array();
        $data['block_title'] = $this->site_meta_data['title'];
        $download_categories = $this->download_category_model->read_list();        
//        var_dump($download_categories);
        foreach ($download_categories as $category) {
            $downloads = $this->download_model->read_list_by_category($category->id, LIMIT_SHOW_ALL_NEWS);
//            var_dump($downloads);
            foreach ($downloads as &$download){
                $eachCategory = $this->download_category_model->read_by_id($download->category_id);
                $download->file_name = base_url(DOWNLOAD_DIR.'/'.$download->file_name);
                $download = $this->truncate_title_content_post($download, 82, 85);
                $download->link_rewrite = 'tai-ve/'.$eachCategory->link_rewrite.'/'.$download->id.'-'.$download->link_rewrite.URL_TRAIL;
            }
            $category->download_items = $downloads;
        }
//        var_dump($download_categories);
        $results = array();
        foreach($download_categories as &$category){
            if (!isset($category->parent_id)){
                $category->sub_cats = array();
                $results[$category->id] = $category;                
                unset($category);
            }
        }
//        echo 'results <pre>';
//        var_dump($results);
//        echo '</pre>';
//        var_dump($download_categories);
        foreach ($download_categories as &$category){
            if (isset($category->parent_id)){
                $parent = $results[$category->parent_id];                
                $sub_cats = $parent->sub_cats;                
                array_push($sub_cats, $category);
                $parent->sub_cats = $sub_cats;
                $results[$category->parent_id] = $parent;
            }
        }

        $data['download_categories'] = $results;
        return $this->load->view('download/display_all_category_download',$data,TRUE);
    }    

    private function _load_page($page_link_rewrite) {
        $page = $this->page_model->read_by_link_rewrite($page_link_rewrite);
        return $page;
    }
	private function _load_page_category($page_link_rewrite) {
        $page = $this->download_category_model->read_by_link_rewrite($page_link_rewrite);
        return $page;
    }   

    /**
     * Truncate title and content of post to display teaser
     * @param type $posts
     * @param type $title_word
     * @param type $content_word
     * @return type 
     */
    public function truncate_title_content_posts($posts, $title_word, $content_word) {
        foreach ($posts as &$post) {
            $post = $this->truncate_title_content_post($post, $title_word, $content_word);
        }
        return $posts;
    }

    public function truncate_title_content_post($post, $title_word, $content_word) {
        $post->name = word_limiter($post->name, $title_word);
        $post->description = word_limiter($post->description, $content_word);
        $post->description = strip_tags($post->description);
        return $post;
    }   

    public function init_paging($link, $total_records) {
        $this->load->library('pagination');
        $config['base_url'] = base_url($link);
        $config['total_rows'] = $total_records;
        $config['per_page'] = MAX_ITEM_PAGINAGION;
        $config['use_page_numbers'] = TRUE;
        $config['uri_segment'] = 2;
        $config['num_tag_open'] = '<div class="phantrang">';
        $config['num_tag_close'] = '</div>';
        $config['cur_tag_open'] = '<div class="phantrang">';
        $config['cur_tag_close'] = '</div>';
        $config['next_tag_open'] = '<div class="phantrang">';
        $config['next_tag_close'] = '</div>';
//                    $config['m'] = '<div class="phantrang">';
//                    $config['prev_tag_close'] = '</div>';
        $this->pagination->initialize($config);
    }        

    /**
     * Set meta data for page
     * @param type $post 
     */
    function _get_meta_data($post) {
        if (is_array($post)) {
            if (isset($post->title)) {
                $this->site_meta_data['title'] = $post['title'];
            } else if (isset($post->name)) {
                $this->site_meta_data['title'] = $post['name'];
            }
            $this->site_meta_data['meta_title'] = $post['meta_title'];
            $this->site_meta_data['meta_description'] = $post['meta_description'];
            $this->site_meta_data['meta_keywords'] = $post['meta_keywords'];
        } else {
            if (isset($post->title)) {
                $this->site_meta_data['title'] = $post->title;
            } else if (isset($post->name)) {
                $this->site_meta_data['title'] = $post->name;
            }
            $this->site_meta_data['meta_title'] = $post->meta_title;
            $this->site_meta_data['meta_description'] = $post->meta_description;
            if (isset($post->meta_keywords)) {
                $this->site_meta_data['meta_keywords'] = $post->meta_keywords;
            }
            if (isset($post->meta_key_words)) {
                $this->site_meta_data['meta_keywords'] = $post->meta_key_words;
            }
        }
    }

    private function _get_partners(){
        $this->load->model('Partner_model','partner_model');
        return $this->partner_model->read_list();
    }
}

?>
