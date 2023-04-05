<div class="allboxsp1 row">
    <?php        
        if (isset($page_second_right['single_post'])) {
            $data['news_item'] = $page_second_right['single_post'];
            if (isset($page_second_right['posts_same_category'])) {
                $data['posts_same_category'] = $page_second_right['posts_same_category'];
            }
            @$data['category'] = $page_second_right['category'];
            @$data['categoryParent'] = $page_second_right['categoryParent'];
            $this->load->view('partial/news_detail', $data);
        } else if (isset($show_all_news) && $show_all_news == 'true') {
            $data = array();
            $this->load->view('partial/display_all_category_news', $data);
        } else if (isset($show_category_news) && $show_category_news == 'true') {
            $data = array();
            $this->load->view('partial/display_category_news', $data);
        } else if (isset($page_second_right['company_category_newses'])) {
            $data = array();
            $data['company_category_newses'] = $page_second_right['company_category_newses'];
            $this->load->view('partial/company_category_newses', $data);
        } else if (isset($servicesDetail)) {
            $this->load->view('partial/services_detail', $data);
        } else if(isset($services)){
            $this->load->view('partial/services_page', $data);
        }
    ?>
</div>