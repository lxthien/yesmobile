<?php
/**
 * Description of Admin_Controller
 *
 * @author DAU GAU
 */
class MY_Controller extends CI_Controller {

	var $menu_active;
	
    //put your code here
    function __construct() {
        parent::__construct();

        $this->load->helper('myhelper');

        if (isset($_SERVER['HTTP_REFERER'])) {
            $this->session->set_userdata('previous_page', $_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_userdata('previous_page', base_url());
        }
        $this->load->model('Config_model', 'sconfig');
        $this->load->model('Download_category_model', 'download_category_model');
        $this->load->model('news_category_model');
        $this->load->model('Product_model', 'product_model');
        $this->load->model('Product_Category_Model', 'product_category_model');
        $this->load->model('News_model', 'news_model');
        $this->load->model('services_model', 'services_model');

        $data = array();
        $data['header_main_menus'] = $this->_read_pages_list();
        $site_meta_data = array();
        $site_meta_data['site_name'] = $this->sconfig->get_value('site_name');
        $data['site_meta_data'] = $site_meta_data;
        $vars = array();
        $vars['data'] = $data;
        
        // get all service to show in menu
        $this->load->model('Services_model', 'services_model');
        $vars['listService'] = $this->services_model->getAll();
        $vars['menuCategoryService'] = $this->news_category_model->readListByParentId(4);
        $vars['newestProduct'] = $this->_getNewestProduct();
        $vars['urlSocial'] = base_url().substr($this->uri->uri_string, 1, strlen($this->uri->uri_string));

        $useFulls = $this->news_model->read_list_viewmost_by_list_categries(array(66, 67, 68), 0, 5);
        foreach ($useFulls as &$news) {
            $news = $this->_build_link_rewrite($news);
        }
        $vars['useFull'] = $useFulls;

        $servicesHot = $this->services_model->read_list_by_list_categries_homepage(array(6,8,9,11,12,24,25,26,27,28,29,30,32,33,34,35,70,71), 0, 5);
        $vars['servicesHot'] = $servicesHot;
        
        $this->load->vars($vars);
    }

    private function _read_pages_list() {
        $pages = $this->page_model->read_list();
        foreach($pages as &$page){
            if ($page->link_rewrite ==='home'){
                $page->link_rewrite= '';
                break;
            }
        }
        return $pages;
    }

    private function _getNewestProduct(){
        $newestProductLst = $this->product_model->read_list_newest();
        
        foreach ($newestProductLst as $eachProduct) {
            $eachCategory = $this->product_category_model->read_by_id($eachProduct->product_category_id);
            $eachProduct->link_rewrite = 'san-pham/dien-thoai/'.$eachCategory->link_rewrite.'/'.$eachProduct->id.'-'.$eachProduct->link_rewrite.URL_TRAIL;
        }
        
        return $newestProductLst;
    }

    private function _build_link_rewrite($post) {
        $category_id = $post->id_news_category;
        $category = $this->news_category_model->read_by_id($category_id);
        $categoryFirst = $this->news_category_model->read_by_id($category->id_parent);
        $post->link_rewrite = $categoryFirst->link_rewrite . '/' . $category->link_rewrite . '/' . $post->id_news . '-' . $post->link_rewrite . URL_TRAIL;
        return $post;
    }
}

class Admin_controller extends CI_Controller {
    function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect(base_url('panel/login'));
        }
    }
}

?>