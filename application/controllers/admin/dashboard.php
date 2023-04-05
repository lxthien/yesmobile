<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminNews
 *
 * @author DAU GAU
 */
class Dashboard extends Admin_controller {

    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->model('Admin_menu_model', 'admin_menu');
        $this->load->library('ion_auth');
    }

    function index() {
        if(!$this->ion_auth->logged_in()){
            redirect('panel/login');
        } else {
            $this->load->helper('cookie');
            $dateOfWeek = date('D', time());
            //get_cookie('isResetNews'); die;
            if ($dateOfWeek == "Mon" && !get_cookie('isResetNews')) {
                // This function to reset news of service object
                $this->load->model('Services_model', 'services_model');
                $page_category_ids = array(5,6,8,9,11,78,79,13,24,25,26,27,28,29,30,70,71,14,32,33,34,35,77,15,36,37,38,39,40,41,42,16,50,51,52,60,17,58,59,18,53,54,55,56,20,57,73,74,75,22,23,44,45,46,48,49);
                $services = $this->services_model->read_list_by_list_categries($page_category_ids, 0, 300);
                foreach($services as $row) {
                    $data = array(
                        'counts' => 0
                    );
                    $this->db->where('id_news', $row->id_news);
                    $this->db->update('services', $data);
                }

                // This function to reset news of guide object
                $this->load->model('News_model', 'news_model');
                $page_category_guide_ids = array(66, 67, 68);
                $guides = $this->news_model->read_list_by_list_categries($page_category_guide_ids, 0, 300);
                foreach($guides as $guide) {
                    $data = array(
                        'counts' => 0
                    );
                    $this->db->where('id_news', $guide->id_news);
                    $this->db->update('news', $data);
                }
                
                set_cookie('isResetNews', true,  time() + 86400);
            }
            $this->load->view('panel/home');
        }        
    }

    public function save() {
        $news = array();
        // $news['id_news_category'] = 1;

        $news['id_language'] = 1;
        $news['meta_title'] = '';
        $news['meta_description'] = '';
        $news['meta_keywords'] = '';
        $news['meta_title'] = '';
        $news['content'] = 'Hello, this is my first news';
        $news['link_rewrite'] = 'first-post';
        $news['active'] = 1;
        $result = $this->newsModel->add($news);

        if (!is_numeric($result)) {
            show_error($result);
        }
    }

    public function delete($id_news) {
        echo $id_news;
        $this->newsModel->delete(array('id_news' => $id_news));
    }

    function _build_admin_menu() {
        $admin_menus = $this->admin_menu->read_list_active();
        $menu_items = array();
        foreach ($admin_menus as $admin_menu) {
            $menu_item = array();
            if (isset($admin_menu->name) && trim($admin_menu->name)) {
                $menu_item['name'] = trim($admin_menu->name);
            } else {
                // if ($admin_menu->is)
            }
        }
        return $menu_item;
    }

}

?>
