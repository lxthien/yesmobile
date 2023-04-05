<?php

/*
 * This model manage pages of site ( home, intro, download...)
 */

/**
 * Description of introduce
 *
 * @author DAU GAU
 */
class Company_introduce extends MY_Controller {

    var $pageId = 2;
    var $site_meta_data = array();

    function __construct() {
        parent::__construct();
        $this->load->model('News_model', 'newsModel');
        $this->load->model('Page_item_model', 'pageItemModel');
        $this->load->model('Page_model', 'pageModel');
        $this->load->model('Page_item_model', 'pageItemModel');
        $this->load->model('News_category_model', 'newsCategoryModel');
        $this->load->model('Gallery_category_model', 'gallery_category_model');
        $this->load->model('Gallery_model', 'gallery_model');
        $this->load->model('Image_model', 'image_model');
        $this->load->model('Advertise_model','advertise_model');
        $this->load->model('Banner_model', 'banner_model');
        $this->load->model('Download_model', 'download_model');
        $this->load->model('Mcontact');
    }

    function load_pagination($item = NULL, $sub_item = NULL, $page_nr = 0) {
        $this->index($item, $sub_item, NULL, $page_nr);
    }

    //sub_item is category_id
    function view_gallery($page, $category_id = NULL, $album_id = NULL) {
        $this->index($page, $category_id, $album_id, 0);
    }

    function index($item = NULL, $sub_item = NULL, $thread = NULL, $page_nr = 0) {
        $data = $this->load->get_var('data');
        $site_meta_data = $data['site_meta_data'];
        $pageSecondLeft = array();
        $page = $this->_loadPageInfo($this->pageId);

        $pageCategories = $this->_loadPageItems($page);
        $pageSecondLeft['page_categories'] = $pageCategories;
        $pageSecondLeft['page_name'] = $page->name;
        $pageSecondLeft['advertises'] = array('1' => 1);
        $data['page_second_left'] = $pageSecondLeft;
        $data['partners'] = $this->_get_partners();
        $data['page_second_right'] = $this->_loadPageSecondRight($item, $sub_item, $page_nr, $thread);
        
        //get adverties for left menu
        $data['left_advertises'] = $this->advertise_model->read_list_by_position(2);
        $data['site_meta_data'] = $this->site_meta_data;
        $data['banners'] = $this->banner_model->get_active_list();
        $data['home_advertises'] = $this->advertise_model->read_list_by_position(1);
        $data['latest_downloads'] = $this->get_latest_download();
        $data['contact'] = $this->Mcontact->listcontact();
        $data['download_menu'] = $this->download_category_model->read_by_parent_id(1);
        $this->load->view('universalView', $data);
    }

    public function get_latest_download() {
        $latest_downloads = $this->download_model->_get_latest_download();
        foreach ($latest_downloads as $download) {
            $eachCategory = $this->download_category_model->read_by_id($download->category_id);
            $download->link_rewrite = 'tai-ve/'.$eachCategory->link_rewrite.'/'.$download->id.'-'.$download->link_rewrite.URL_TRAIL;
    
        }
         
        return $latest_downloads;
    }

    /**
     * Get all category of a Page, build re-write url for each item
     * @param type $page
     * @return type 
     */
    private function _loadPageItems($page) {

        $options = array('id_page' => $page->id_page, 'active' => 1, 'sort by' => 'index');
        $query = $this->pageItemModel->get($options);
        $results = $query->result();
        foreach ($results as &$item) {
            $item->link_rewrite = $page->link_rewrite . '/' . $item->link_rewrite;
        }
        return $results;
    }

    /*
     * Read from database info of current page ( title, link_rewrite...)
     */

    private function _loadPageInfo($pageId) {
        $options = array('id_page' => $pageId, 'active' => 1, 'sort by' => 'index');
        $query = $this->pageModel->get($options);
        return $query;
    }

    /**
     * Read data from database for right page display.
     * Depend of what item on left page select
     * @param type $selectItem
     * @return type 
     */
    private function _loadPageSecondRight($item = NULL, $sub_item = NULL, $page_nr, $thread = NULL) {
        $result = array();
        $page = $this->pageModel->read_by_id(2);
        if (!isset($page)) {
            show_404();
        }
        $pageItem = null;
        if (isset($item)) {
            $pageItem = $this->pageItemModel->getPageItemByLinkRewrite($item);
            if (!isset($pageItem)) {
                show_404();
            }
        }
        if ($pageItem !== false) {
            $pageItem->link_rewrite = $page->link_rewrite . '/' . $pageItem->link_rewrite;
        }
        //TODO
        //var_dump($pageItem);
        if ($pageItem === false || $item === 'gioi-thieu-cong-ty' || 
                $item === 'site-map' || $item === 'dich-vu-sua-chua' || 
                $item === 'che-do-bao-hanh') {
            
            if ($item === 'che-do-bao-hanh') {
                $this->menu_active = 'cdbh';
                $query = $this->newsModel->read_by_id(WARRANTY);
            } 
            else if($item === 'dich-vu-sua-chua') {
                $this->menu_active = 'services';
                $query = $this->newsModel->read_by_id(SERVICES);
            }
            else if($item === 'ep-kinh-dien-thoai-tai-vung-tau') {
                $this->menu_active = 'ep-kinh';
                $query = $this->newsModel->read_by_id(EPKINH);
            }
            else if($item === 'site-map') {
                $query = $this->newsModel->read_by_id(SITE_MAP);
            }
            else if($item === 'tuyen-dung') {
                $query = $this->newsModel->read_by_id(RECRUIT);
            }
            else if($item === 'chinh-sach-bao-hanh') {
                $query = $this->newsModel->read_by_id(WARRANTYPOLICY);
            }
            else if($item === 'chinh-sach-van-chuyen') {
                $query = $this->newsModel->read_by_id(DELEVERYPOLICY);
            }
            else {
                $query = $this->newsModel->read_by_id(COMPANY_INSTRODUCE_NEWS_ID);
            }
            $result ['single_post'] = $query;
            $this->_get_meta_data($query);
        } else if ($pageItem->id_page_item === '2') {
            if (isset($sub_item)) {
                $selected_category = $this->newsCategoryModel->getCategoryByLinkRewrite($sub_item);
                if (!$selected_category) {
                    show_404(base_url());
                }
                $selected_category->link_rewrite = $pageItem->link_rewrite . '/' . $selected_category->link_rewrite;
                if (isset($thread)) {
                    $post = $this->newsModel->read_by_id($thread);

                    if (!$post) {
                        show_404('home');
                    }

                    $same_posts = $this->newsModel->getRecordSameCategory($post->id_news_category, $post->id_news, 5);
                    $same_posts_array = $same_posts->result();
                    foreach ($same_posts_array as &$same_post) {
                        $same_post->link_rewrite = $selected_category->link_rewrite . '/' . $same_post->id_news . '-' . $same_post->link_rewrite . URL_TRAIL;
                    }
                    $result ['single_post'] = $post;
                    $this->_get_meta_data($post);
                    $result['posts_same_category'] = $same_posts_array;
                } else {
                    $page_offset = 0;
                    if ($page_nr > 0) {
                        $page_offset = $page_nr - 1;
                    }
                    $offset = $page_nr * MAX_ITEM_PAGINAGION;
                    $category_posts = $this->newsModel->get_news_list_by_category_id($selected_category->id_news_category, $offset, MAX_ITEM_PAGINAGION);

                    foreach ($category_posts as &$post) {
                        $post->link_rewrite = $selected_category->link_rewrite . '/' . $post->id_news . '-' . $post->link_rewrite . URL_TRAIL;
                    }
                    $posts = $this->truncate_title_content($category_posts, MAX_DES_TITLE, MAX_DES_CONTENT);
                    $category_news = array();
                    $category_news['category'] = $selected_category;
                    $this->_get_meta_data($selected_category);
                    $category_news['newses'] = $category_posts;
                    $result['selected_company_category_newses'] = $category_news;

                    $this->load->library('pagination');
                    $config['base_url'] = base_url($selected_category->link_rewrite);

                    $totalRecord = $this->newsModel->count_postnr_by_category_id($selected_category->id_news_category);
                    $config['total_rows'] = $totalRecord;
                    $config['use_page_numbers'] = TRUE;
                    $config['per_page'] = MAX_ITEM_PAGINAGION;
                    $config['uri_segment'] = 4;
                    $config['num_tag_open'] = '<div class="phantrang">';
                    $config['num_tag_close'] = '</div>';
                    $config['cur_tag_open'] = '<div class="phantrang">';
                    $config['cur_tag_close'] = '</div>';
                    $config['next_tag_open'] = '<div class="phantrang">';
                    $config['next_tag_close'] = '</div>';
                    $this->pagination->initialize($config);
                }
            } else {
                $parent_category = $this->newsCategoryModel->read_by_id(7);
                $this->_get_meta_data($parent_category);
                $categories = $this->newsCategoryModel->readListByParentId(7);
                foreach ($categories as &$category) {
                    $posts = $this->newsModel->get_news_list_by_category_id(
                            $category['id_news_category'], NULL, 1, 100);
                    $category['link_rewrite'] = $pageItem->link_rewrite . '/' . $category['link_rewrite'];
                    foreach ($posts as &$post) {
                        $post->link_rewrite = $category['link_rewrite'] . '/' . $post->id_news . '-' . $post->link_rewrite . URL_TRAIL;
                    }
                    $posts = $this->truncate_title_content($posts, MAX_DES_TITLE, MAX_DES_CONTENT);
                    $category['posts'] = $posts;
                }
                $result['company_category_newses'] = $categories;
            }
        } else if ($pageItem->id_page_item === '3') {
            $this->_get_meta_data($pageItem);
            $gallery_data = $this->_load_gallery_data($pageItem->link_rewrite, $sub_item, $thread);
            return $gallery_data;
        }
        return $result;
    }

    function _load_gallery_data($page_link, $category_id = NULL, $album_id = NULL) {
        $data = array();
        $gallery_categories = $this->gallery_category_model->read_list();
        foreach ($gallery_categories as &$category) {
            $category->link_rewrite = $page_link . '/' . $category->id . '-' . $category->link_rewrite;
        }
        $data['gallery_categories'] = $gallery_categories;

        if (isset($category_id)) {
            $gallery_category = $this->gallery_category_model->read_by_id($category_id);
            if (!isset($gallery_category)) {
                show_404();
            }
            $gallery_category->link_rewrite = $page_link . '/' . $gallery_category->id . '-' . $gallery_category->link_rewrite;
            $this->_get_meta_data($gallery_category);



            if (isset($album_id)) {
                $album = $this->gallery_model->read_by_id($album_id);
                if (!isset($album)) {
                    show_error('Cannot find album id: ' . $album_id);
                }
                $album->link_rewrite = $gallery_category->link_rewrite . '/' . $album->id . '-' . $album->link_rewrite . URL_TRAIL;
                $album->images = $this->image_model->read_list_by_album_id($album->id);
                $this->_get_meta_data($album);
                $data['selected_album'] = $album;
            } else {
                $galleries = $this->gallery_model->read_list_by_category($gallery_category->id);
                foreach ($galleries as &$gallery) {
                    $gallery->link_rewrite = $gallery_category->link_rewrite . '/' . $gallery->id . '-' . $gallery->link_rewrite . URL_TRAIL;
                    $image_thumbnail = $this->_get_thumbnail($gallery->id);
                    if (isset($image_thumbnail)) {
                        $gallery->thumbnail = $image_thumbnail;
                    }
                }
                $data['galleries'] = $galleries;
            }
        } else {
            $latest_album = $this->gallery_model->read_latest_list(20);
            foreach ($latest_album as &$album) {
                $category_link = $this->_get_category_link_rewrite($album->category_id, $gallery_categories);
                $album->link_rewrite = $category_link . '/' . $album->id . '-' . $album->link_rewrite . URL_TRAIL;
                $image_thumbnail = $this->_get_thumbnail($album->id);
                $album->thumbnail = $image_thumbnail;
            }
            $data['galleries'] = $latest_album;
        }
        return $data;
    }

    function _get_category_link_rewrite($category_id, $categories) {
        foreach ($categories as $category) {
            if ($category_id === $category->id) {
                return $category->link_rewrite;
            }
        }
        return 'Cannot get link rewrite for category id ' . $category_id;
    }

    function _get_thumbnail($album_id) {
        $image = $this->image_model->get_first_image_by_album($album_id);
        return $image;
    }

    /**
     * Truncate title and content of post to display teaser
     * @param type $posts
     * @param type $title_word
     * @param type $content_word
     * @return type 
     */
    public function truncate_title_content($posts, $title_word, $content_word) {
        foreach ($posts as &$post) {
            $post->title = word_limiter($post->title, $title_word);
            $content = strip_tags($post->content);        
            $post->content = text_cut($content, $content_word);                   
        }
        return $posts;
    }

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

    private function _get_partners() {
        $this->load->model('Partner_model', 'partner_model');
        return $this->partner_model->read_list();
    }

    public function tuyen_dung() {
        
    }

}

?>
