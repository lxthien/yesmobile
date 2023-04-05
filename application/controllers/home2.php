<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of home
 *
 * @author DAU GAU
 */
class Home extends MY_Controller {

    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        //load phone model
        $this->load->model('Product_model', 'product_model');
        $this->load->model('Product_Category_Model', 'product_category_model');
        $this->load->model('News_model', 'newsModel');
        $this->load->model('News_category_model', 'category_model');
        $this->load->model('Page_item_model', 'page_item_model');
        $this->load->model('Page_model', 'page_model');
        $this->load->model('Mcontact');
        $this->load->model('Download_model', 'download_model');
        $this->load->model('Feedback_model', 'feedback_model');
        $this->load->model('Advertise_model', 'advertise_model');
        $this->load->model('Banner_model', 'banner_model');
//        $this->load->helper('text');
    }

    public function index() {
        $data = $this->load->get_var('data');
        $data['tinNoiBat'] = $this->_getFocusableNews();
        $data['spBanChay'] = $this->_getBestSellProduct();
        $data['newestProduct'] = $this->_getNewestProduct();
        $data['phuKienHot'] = $this->_getPhuKienHot();
        $data['tinCongNghe'] = $this->_getArrayNewsByCategoryHome(2);
        $data['nhanDinhCuaToChuc'] = $this->_getArrayNewsByCategory(6);
        $data['kinhTeTheGioi'] = $this->_getArrayNewsByCategory(2);
        $data['chungKhoanViet'] = $this->_getArrayNewsByCategory(3);
        $data['contact'] = $this->Mcontact->listcontact();
        $data['video_url'] = $this->sconfig->get_value('VIDEO_LINK');
        //$data['latest_images'] = $this->_get_latest_images();
        $data['latest_downloads'] = $this->get_latest_download();
        //$site_meta_data = array();
        $site_meta_data['site_name'] = $this->sconfig->get_value('site_name');
        $data['site_meta_data'] = $site_meta_data;
        $data['partners'] = $this->_get_partners();
        
        $data['download_menu'] = $this->download_category_model->read_by_parent_id(1);
        $data['feedbacks'] = $this->_get_latest_feedbacks();
        //get advertise for block home page
        $data['home_advertises'] = $this->advertise_model->read_list_by_position(1);
        $data['banners'] = $this->_get_active_banners();
        $this->load->view('homeView', $data);
    }
    
    public function get_latest_download() {
    	$latest_downloads = $this->download_model->_get_latest_download();
    	foreach ($latest_downloads as $download) {
    		$eachCategory = $this->download_category_model->read_by_id($download->category_id);
    		$download->link_rewrite = 'tai-ve/'.$eachCategory->link_rewrite.'/'.$download->id.'-'.$download->link_rewrite.URL_TRAIL;
    
    	}
    	
    	return $latest_downloads;
    }
    
	private function _getBestSellProduct(){
		$bestSellProdLst=$this->product_model->list_best_sell();
		foreach ($bestSellProdLst as $eachProduct) {
			$eachCategory = $this->product_category_model->read_by_id($eachProduct->product_category_id);
			$eachProduct->link_rewrite = 'san-pham/dien-thoai/'.$eachCategory->link_rewrite.'/'.$eachProduct->id.'-'.$eachProduct->link_rewrite.URL_TRAIL;
		}
		
		return $bestSellProdLst;
	}
	private function _getPhuKienHot(){
		$bestSellProdLst=$this->product_model->get_list_phu_kien_hot();
		foreach ($bestSellProdLst as $eachProduct) {
			$eachCategory = $this->product_category_model->read_by_id($eachProduct->product_category_id);
			$eachProduct->link_rewrite = 'san-pham/phu-kien/'.$eachCategory->link_rewrite.'/'.$eachProduct->id.'-'.$eachProduct->link_rewrite.URL_TRAIL;
		}
	
		return $bestSellProdLst;
	}
	private function _getNewestProduct(){
		$newestProductLst = $this->product_model->read_list_newest();
		
		foreach ($newestProductLst as $eachProduct) {
			$eachCategory = $this->product_category_model->read_by_id($eachProduct->product_category_id);
			$eachProduct->link_rewrite = 'san-pham/dien-thoai/'.$eachCategory->link_rewrite.'/'.$eachProduct->id.'-'.$eachProduct->link_rewrite.URL_TRAIL;
		}
		
		return $newestProductLst;
	}
	
    private function _getArrayNewsByCategory($idCategory) {
        $options = array('id_news_category' => $idCategory, 'limit' => NO_OF_NEWS_IN_EACH_CATEGORY_IN_HOMEPAGE, 'sort_by' => 'date_add', 'sort_direction' => 'DESC');
        $category = $this->_getCategory($idCategory);
        $news = $this->_getNews($options, $category);
        return $news;
    }
    
    private function _getArrayNewsByCategoryHome($idCategory) {
    	$options = array('limit' => NO_OF_NEWS_IN_EACH_CATEGORY_IN_HOMEPAGE, 'sort_by' => 'date_add', 'sort_direction' => 'DESC');
    	//$category = $this->_getCategory($idCategory);
    	$news = $this->_getNews($options, null);
    	return $news;
    }
 
    private function _getFocusableNews() {
        $options = array('focusable' => '1', 'limit' => NO_OF_FOCUS_NEWS_IN_HOMEPAGE, 'sort_by' => 'date_add', 'sort_direction' => 'DESC');
        $focusableNews = $this->_getNews($options, NULL);

        return $focusableNews;
    }

    /*
     * Get newest with criteria in options, if categry != null, build rewrite link with that
     * otherwise, try to get category from database by loop all item
     */

    private function _getNews($options, $category) {
        $isCategoryNull = $category === NULL;
        $query = $this->newsModel->get($options);
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
//            $content = strip_punctuation($content);
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
    
    private function _getCategory($idCategory) {
        $categoryOptions = array('id_news_category' => $idCategory);
        $category = $this->category_model->get($categoryOptions);
        return $category;
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

    private function _get_latest_images() {
        $this->load->model('Gallery_model', 'gallery_model');
        $this->load->model('Image_model', 'image_model');
        $this->load->model('Gallery_category_model', 'gallery_category_model');
        $latest_images = $this->image_model->get_latest_images(MAX_LATEST_IMAGES);
        $album_ids = array();
        $pageItem = null;

        $pageItem = $this->page_item_model->read_by_id(3);
        if (!isset($pageItem)) {
            show_error('Cannot find page item 3');
        }
        $gallery_categories = $this->gallery_category_model->read_list();
        $gallery_ids = array();
        foreach ($gallery_categories as $category) {
            $gallery_ids[$category->id] = 'gioi-thieu/' . $pageItem->link_rewrite . '/' . $category->id . '-' . $category->link_rewrite;
        }

        foreach ($latest_images as &$latest_image) {
            $album_link = '';
            if (!array_key_exists($latest_image->album_id, $album_ids)) {
                $album = $this->gallery_model->read_by_id($latest_image->album_id);
                if (isset($album)) {
                    $album_link = $gallery_ids[$album->category_id] . '/' . $album->id . '-' . $album->link_rewrite . URL_TRAIL;
                    $album_ids[$album->id] = $album_link;
                } else {
                    show_error("Cannot find album id " . $latest_image->album_id);
                }
            }
            $latest_image->link_rewrite = $album_ids[$latest_image->album_id];
        }
        return $latest_images;
    }

//     private function _get_latest_download() {
//         $downloads = $this->download_model->read_latest_list(5, TRUE);
//         foreach ($downloads as &$download) {
//             $download->file_name = base_url(DOWNLOAD_DIR . '/' . $download->file_name);
//             $file_ext = substr($download->file_name, -3);

//             $download->icon = RES_PATH . 'images/'.$download->icon;
// //            $download->icon = RES_PATH.'images/file_exts/'.$file_ext.'.png';
//         }
//         return $downloads;
//     }

    private function _get_partners() {
        $this->load->model('Partner_model', 'partner_model');
        return $this->partner_model->read_list();
    }

    private function _get_latest_feedbacks() {
        $feedbacks = $this->feedback_model->read_latest_list(5);
        foreach ($feedbacks as &$feedback) {
            $feedback->content = word_limiter($feedback->content, 20);
        }
        return $feedbacks;
    }
    private function _get_active_banners(){
        return $this->banner_model->get_active_list();
    }

}

?>
