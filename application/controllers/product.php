<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tintuc
 *
 * @author Quang
 */
class Product extends MY_Controller {

    //put your code here
    var $page_meta = array();
    var $title_character_nr = 80;
    var $content_word_nr = 100;
    var $total_posts;
    var $site_meta_data = array();
	var $menu_active = 'phone';

    public function __construct() {
        parent::__construct();
        $this->load->model('Download_model', 'download_model');
        $this->load->model('Product_model', 'product_model');
        $this->load->model('Image_model', 'image_model');
        $this->load->model('Product_Category_Model', 'product_category_model');
        $this->load->model('Mcontact');
        $this->load->model('Advertise_model','advertise_model');
        $this->load->model('Banner_model', 'banner_model');
        $this->load->model('News_model', 'newsModel');
        $this->load->model('News_category_model', 'category_model');
        $this->load->model('Page_item_model', 'page_item_model');
        $this->load->model('services_model', 'services_model');
    }
    
    public function index() {
        $data = $this->load->get_var('data');
        
        $data['contact'] = $this->Mcontact->listcontact();
        //$this->_get_meta_data($page);
        $data['contact_block'] = $this->_load_contact_block();        
        $data['download_block_main'] = $this->_load_downloads_block();
        //$data['site_meta_data'] = $this->site_meta_data;
        $data['partners'] = $this->_get_partners();
        $data['page_name'] = 'Tải vê';
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
    
    public function view_1st_level_category ($firstLevelCategory, $category) {
    	$data['product_block_main'] = $this->_load_product_1st_level($firstLevelCategory, $category);
    	$link_rewrite = $this->uri->segment(2);
		$this->_get_category_metadata($link_rewrite);
		$data['site_meta_data'] = $this->site_meta_data;
    	$data['partners'] = $this->_get_partners();
    	$data['currentCategory'] = $category;
    	$data['banners'] = $this->banner_model->get_active_list();
    	$data['home_advertises'] = $this->advertise_model->read_list_by_position(1);
    	$data['latest_downloads'] = $this->get_latest_download();
    	$data['download_menu'] = $this->download_category_model->read_by_parent_id(1);
    	$data['contact'] = $this->Mcontact->listcontact();
    	$this->load->view('product', $data);
    }

    private function _get_category_metadata($link_rewrite){
    	
    	$page = $this->product_category_model->read_by_link_rewrite($link_rewrite);
    	$this->_get_category_meta_data($page);
    
    	
    }
    
    private function _load_product_1st_level($firstLevelCategory, $category) {
    	$data = array();
    	if($category == 'phu-kien-dien-thoai')
			$this->menu_active = 'accessories';
		
    	$productCategory = $this->product_category_model->read_by_link_rewrite($category);
    	 
    	$children = $this->product_category_model->read_by_parent_id($productCategory->id);
    	foreach($children as $each) {
    		 $eachProductList = $this->product_model->read_by_category_id($each->id);
    		 
    		 foreach ($eachProductList as $eachProduct) {
    		 	$eachProduct->link_rewrite = $firstLevelCategory.'/'.$category.'/'.$each->link_rewrite.'/'.$eachProduct->id.'-'.$eachProduct->link_rewrite.URL_TRAIL;
    		 }
    		 $each->productList = $eachProductList;
    	}
    	
    	$data['linkViewAll'] = $firstLevelCategory.'/'.$category;
    	$data['parentCategoryName'] = $productCategory->name;
    	$data['childrenCategories'] = $children;

        $data['servicesHomepages'] = $this->services_model->read_list_by_list_categries_homepage(array(6,8,9,11,12,24,25,26,27,28,29,30,32,33,34,35,70,71), 0, 3);

    	return $this->load->view('product/display_parent_category',$data,TRUE);
    }
    
    public function view_2nd_level_category ($firstLevelCategory, $category, $subCategory) {
    	
    	$data['product_block_main'] = $this->_load_product_2nd_level($firstLevelCategory, $category, $subCategory);
    	$link_rewrite = $this->uri->segment(3);
		if($category == 'phu-kien')
			$this->menu_active = 'accessories';
    	$this->_get_category_metadata($link_rewrite);
    	$data['site_meta_data'] = $this->site_meta_data;
    	$data['partners'] = $this->_get_partners();
    	$data['currentCategory'] = $category;
    	$data['banners'] = $this->banner_model->get_active_list();
    	$data['home_advertises'] = $this->advertise_model->read_list_by_position(1);
    	$data['latest_downloads'] = $this->get_latest_download();
    	$data['download_menu'] = $this->download_category_model->read_by_parent_id(1);
    	$this->load->view('product', $data);
    }
    
    private function _load_product_2nd_level($firstLevelCategory, $category, $subCategory) {
    	$data = array();
    	 
    	$productCategory = $this->product_category_model->read_by_link_rewrite($subCategory);
    
    	$productList = $this->product_model->read_by_category_id($productCategory->id);
    		 
    	foreach ($productList as $eachProduct) {
    		$eachProduct->link_rewrite = $firstLevelCategory.'/'.$category.'/'.$subCategory.'/'.$eachProduct->id.'-'.$eachProduct->link_rewrite.URL_TRAIL;
    	}
    	$data['linkViewAll'] = $firstLevelCategory.'/'.$category;
    	$data['categoryName'] = $productCategory->name;
    	$data['eachProductList'] = $productList;
    	$data['contact'] = $this->Mcontact->listcontact();
        $data['usuallyError'] = $this->_getArrayNewsByCategoryProductUsuallyError(3);

        $data['servicesHomepages'] = $this->services_model->read_list_by_list_categries_homepage(array(6,8,9,11,12,24,25,26,27,28,29,30,32,33,34,35,70,71), 0, 3);

    	return $this->load->view('product/display_sub_category',$data,TRUE);
    }

    private function _getArrayNewsByCategoryProductUsuallyError($idCategory) {
        $options = array('limit' => 6, 'sort_by' => 'date_add', 'sort_direction' => 'DESC', 'id_news_category' => $idCategory);
        $news = $this->_getNews($options, null);
        return $news;
    }
    
    public function view_theo_khoang_gia ($firstLevelCategory, $category) {
    	$url_array = explode("-", $category);
    	if($url_array[0] == 'duoi') {
    		$from = 0;
    		$to = $url_array[1];
    		$category_name = 'Giá dưới'.$to.' triệu';
    	}
    	else if($url_array[0] == 'tren') {
    		$from = $url_array[1];
    		$to = 1000;
    		$category_name = 'Giá trên '.$from.' triệu';
    	}
    	else {
	    	$from = $url_array[2];
	    	$to = $url_array[5];
	    	$category_name = 'Giá từ '.$from.' triệu đến '.$to.' triệu';
    	}
    	
    	$link_rewrite = $this->uri->segment(2);;
    	$this->_get_category_metadata($link_rewrite);
    	$data['product_block_main'] = $this->_load_theo_khoang_gia($firstLevelCategory, $from, $to, $category_name);
    	
    	$data['site_meta_data'] = $this->site_meta_data;
    	$data['partners'] = $this->_get_partners();
    	$data['page_name'] = 'Táº£i Vá»�';
    	$data['banners'] = $this->banner_model->get_active_list();
    	$data['home_advertises'] = $this->advertise_model->read_list_by_position(1);
    	$data['latest_downloads'] = $this->get_latest_download();
    	$data['approx_price'] = $category_name;
    	$data['download_menu'] = $this->download_category_model->read_by_parent_id(1);
    	$this->load->view('product', $data);
    }
    
    private function _load_theo_khoang_gia($firstLevelCategory, $from, $to, $category_name) {
    	$data = array();
    	$productCategory = 'theo-gia-tu-'.$from.'-trieu-den-'.$to.'-trieu';
        //$this->product_category_model->read_by_link_rewrite($subCategory);
    
    	$productList = $this->product_model->read_by_price_range($from, $to);
    	 
    	foreach ($productList as $eachProduct) {
            $productCategory = $this->product_category_model->read_by_id($eachProduct->product_category_id);
            $productCategorySecond = $this->product_category_model->read_by_id($productCategory->parent_id);
    		$eachProduct->link_rewrite = $firstLevelCategory.'/'.$productCategorySecond->link_rewrite.'/'.$productCategory->link_rewrite.'/'.$eachProduct->id.'-'.$eachProduct->link_rewrite.URL_TRAIL;
    	}
    	$data['linkViewAll'] = '';
    	$data['categoryName'] = $category_name;
    	$data['eachProductList'] = $productList;

        $data['servicesHomepages'] = $this->services_model->read_list_by_list_categries_homepage(array(6,8,9,11,12,24,25,26,27,28,29,30,32,33,34,35,70,71), 0, 3);
        
    	return $this->load->view('product/display_sub_category',$data,TRUE);
    }

 	private function _load_page($id) {
        $page = $this->product_model->read_by_id($id);
        return $page;
    }

    public function view_details($firstLevelCategory, $category, $subCategory, $productLink) {
        $data['servicesHomepages'] = $this->services_model->read_list_by_list_categries_homepage(array(6,8,9,11,12,24,25,26,27,28,29,30,32,33,34,35,70,71), 0, 3);
        
        $selectedProduct = $productList = $this->product_model->read_by_id($productLink);
        if (!is_object($selectedProduct)) {
            redirect(base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3), 'location', 301);
        }

        if($category == "phu-kien") {
            redirect(base_url().$this->uri->segment(1).'/phu-kien-dien-thoai/'.$this->uri->segment(3).'/'.$this->uri->segment(4), 'location', 301);
        }
		
		if($category == 'phu-kien-dien-thoai')
			$this->menu_active = 'accessories';

        $limit_san_pham_cung_gia = 5;
        $product_price_in_mil = ($selectedProduct->price)/1000000;
        if($product_price_in_mil < 2) {
            $san_pham_cung_gia  = $this->product_model->read_by_price_range_limit(0, 2, $selectedProduct->id, $limit_san_pham_cung_gia);
        }
        else if($product_price_in_mil >= 2 && $product_price_in_mil < 4) {
            $san_pham_cung_gia = $this->product_model->read_by_price_range_limit(2, 4, $selectedProduct->id, $limit_san_pham_cung_gia);
        }
        else if($product_price_in_mil >= 4 && $product_price_in_mil < 6) {
            $san_pham_cung_gia = $this->product_model->read_by_price_range_limit(4, 6, $selectedProduct->id, $limit_san_pham_cung_gia);
        }
        else if($product_price_in_mil >= 6 && $product_price_in_mil < 8) {
            $san_pham_cung_gia = $this->product_model->read_by_price_range_limit(6, 8, $selectedProduct->id, $limit_san_pham_cung_gia);
        }
        else if($product_price_in_mil >= 8) {
            $san_pham_cung_gia = $this->product_model->read_by_price_range_limit(8, 1000, $selectedProduct->id, $limit_san_pham_cung_gia);
        }
        
        foreach ($san_pham_cung_gia as $eachProduct) {
            $productCategory = $this->product_category_model->read_by_id($eachProduct->product_category_id);
            $productCategorySecond = $this->product_category_model->read_by_id($productCategory->parent_id);
            $eachProduct->link_rewrite = $firstLevelCategory.'/'.$productCategorySecond->link_rewrite.'/'.$productCategory->link_rewrite.'/'.$eachProduct->id.'-'.$eachProduct->link_rewrite.URL_TRAIL;
        }

    	$data['view_details'] = 1;
    	$data['product_block_main'] = $this->_load_product_details($firstLevelCategory, $category, $subCategory, $productLink, $san_pham_cung_gia);
    	$data['partners'] = $this->_get_partners();
    	$data['page_name'] = 'Táº£i Vá»�';
    	$data['banners'] = $this->banner_model->get_active_list();
        
        // load metadata
    	$this->_get_meta_data($selectedProduct);
    	$data['site_meta_data'] = $this->site_meta_data;
    	$data['currentCategory'] = $category;
    	$data['home_advertises'] = $this->advertise_model->read_list_by_position(1);
    	$data['latest_downloads'] = $this->get_latest_download();
		$data['download_menu'] = $this->download_category_model->read_by_parent_id(1);
		$data['contact'] = $this->Mcontact->listcontact();
    	$this->load->view('product', $data);
    }
    
    private function _load_product_details($firstLevelCategory, $category, $subCategory, $productLink, $productRelated) {
        $data = array();
    	$viewProduct = $productList = $this->product_model->read_by_id($productLink);

        //Check link_ewwrite not exit.
        $link_rewrite = $viewProduct->link_rewrite;
        if( !strpos($productLink, $link_rewrite) ){
            redirect(base_url().$firstLevelCategory.'/'.$category.'/'.$subCategory);
        }

    	$data['linkViewAll'] = $firstLevelCategory.'/'.$category.'/'.$subCategory;
    	
    	$product_price_in_mil = ($viewProduct->price)/1000000;
    	if($product_price_in_mil < 2) {
    		$viewProduct->approx_price  = "Dưới 2 triệu";
    	}
    	else if($product_price_in_mil >= 2 && $product_price_in_mil < 4) {
    		$viewProduct->approx_price  = "Từ 2 đến 4 triệu";
    	}
    	else if($product_price_in_mil >= 4 && $product_price_in_mil < 6) {
    		$viewProduct->approx_price  = "Từ 4 đến 6 triệu";
    	}
    	else if($product_price_in_mil >= 6 && $product_price_in_mil < 8) {
    		$viewProduct->approx_price  = "Từ 6 đến 8 triệu";
    	}
    	else if($product_price_in_mil >= 8) {
    		$viewProduct->approx_price  = "Trên 8 triệu";
    	}

        /*Get title product into alt image*/
        $selectedProduct = $productList = $this->product_model->read_by_id($productLink);
        $this->_get_meta_data($selectedProduct);
        $data['site_meta_data'] = $this->site_meta_data;

        $data['san_pham_cung_gia'] = $productRelated;
    	$data['viewProduct'] = $viewProduct;
    	$images_list = $this->image_model->read_list_by_album_id($viewProduct->id);
    	$data['product_images'] = $images_list;
		$data['download_menu'] = $this->download_category_model->read_by_parent_id(1);
        $data['subCategory'] = $subCategory;
        $data['tinCongNghe'] = $this->newsModel->get_news_list_by_category_id(2, 0, 5);

        $productCategory = $this->product_category_model->read_by_link_rewrite($subCategory);
        $data['productCategory'] = $productCategory;
        $productList = $this->product_model->read_by_category_id($productCategory->id);
        foreach ($productList as $eachProduct) {
            $eachProduct->link_rewrite = $firstLevelCategory.'/'.$category.'/'.$subCategory.'/'.$eachProduct->id.'-'.$eachProduct->link_rewrite.URL_TRAIL;
        }
        $data['eachProductList'] = $productList;

        if($category != 'phu-kien-dien-thoai') {
            return $this->load->view('product/display_product_detail', $data, TRUE);
        } else {
            return $this->load->view('product/display_phukien_detail', $data, TRUE);
        }
    }
    

    /**
     * Set meta data for page
     * @param type $post 
     */
    public function _get_meta_data($post) {
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
            } else if (isset($post->producer) || isset($post->model)) {
                $this->site_meta_data['title'] = $post->producer . ' ' . $post->model;
            }
            $this->site_meta_data['meta_title'] = $post->meta_title;
            $this->site_meta_data['meta_description'] = $post->meta_description;
            if (isset($post->meta_keywords)) {
                $this->site_meta_data['meta_keywords'] = $post->meta_keywords;
            }
        }
    }

    /**
     * Set meta data for page
     * @param type $post 
     */
    public function _get_category_meta_data($post) {
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
        }
    }

    private function _get_partners(){
        $this->load->model('Partner_model','partner_model');
        return $this->partner_model->read_list();
    }

    /**
     * Description: form search product
     * Author: Thangmobile
     */
    function search() {
		//parse_str(array_pop(explode('?', $_SERVER['REQUEST_URI'], 2)), $_GET);
		
        if (!isset($_GET['value'])) {
            redirect(base_url());
        }
        $value = $this->input->get('value');

        // load meta data site
        $data['site_meta_data'] = $this->site_meta_data;

        // load data
        $data['product_block_main'] = $this->_load_product_search($value);
        $this->load->view('product', $data);
    }

    private function _load_product_search($value){
        $data = array();
    
        $productList = $this->product_model->search($value);
             
        foreach ($productList as $eachProduct) {
            //$eachProduct->link_rewrite = $firstLevelCategory.'/'.$category.'/'.$subCategory.'/'.$eachProduct->id.'-'.$eachProduct->link_rewrite.URL_TRAIL;
        }
        
        $data['value'] = $value;
        $data['eachProductList'] = $productList;
        $data['contact'] = $this->Mcontact->listcontact();
        return $this->load->view('product/search', $data, TRUE);
    }

    private function _getNews($options, $category) {
        $isCategoryNull = $category = 2;
        $query = $this->newsModel->get($options, $isLike = true, $matchKey = 'title', $matchvalue = 'iphone');
        $dsTinNoiBat = $query->result_array();

        foreach ($dsTinNoiBat as &$item) {
            $title_lengh = 82;
            $content_lengh = 145;            
            if (isset($options['focusable'])) {
                $title_lengh = 85;
                $content_lengh = 85;
            }
            $item['f_title'] = $item['title'];
            $item['title'] = text_cut(trim($item['title']), $title_lengh);

            $content = strip_tags($item['content']);
            $length_base_on_title = $content_lengh;
            if (strlen($item['title']) < 30) {
                $length_base_on_title = $content_lengh + 50;
            }
            $content = text_cut($content, $length_base_on_title, TRUE);
            $item['content'] = rip_tags($content);

            if ($isCategoryNull) {
                $category = $this->category_model->read_by_id($item['id_news_category']);
            }
            $page =  $this->_get_page_of_category($category);
            if (!isset($page)) {
                show_error("Not page map to category " . $category->name);
            }
            $item['link_rewrite'] = $page->link_rewrite . '/' . $category->link_rewrite . '/' . $item['id_news'] . '-' . $item['link_rewrite'] . URL_TRAIL;
        }
        return $dsTinNoiBat;
    }

    private function _get_page_of_category($category) {

        $page_items = $this->page_item_model->get_page_item_by_category_id($category->id_parent);
        if (sizeof($page_items) > 0) {
            $page_item = $page_items[0];
            $page = $this->page_model->read_by_id($page_item->id_page);            
            if ($page_item->link_rewrite) {
                $page->link_rewrite = $page->link_rewrite.'/'.$page_item->link_rewrite;    
            }
            
            return $page;
        } else {
            show_error("Not page item map to this category, please check in page_item_category");
        }
        return false;
    }


}