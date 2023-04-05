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
class Admin_news extends CI_Controller
{


    //put your code here

    function __construct()
    {

        parent::__construct();

        $this->load->model('news_model');

        $this->load->model('Admin_menu_model', 'admin_menu');

        //CK editor        

//        $news['id_news_category'] = 1;

        $_SESSION['KCFINDER'] = array();

        $_SESSION['KCFINDER']['disabled'] = false;

        $this->load->library('ckeditor', array('instanceName' => 'CKEDITOR1', 'basePath' => base_url() . "ckeditor/", 'outPut' => true));


        // From validator

        $this->load->library('form_validation');

        $this->load->helper('form');

//        $this->form_validation->set_rules('meta_title', 'Meta title', 'required');

//        $this->form_validation->set_rules('meta_description', 'Description', 'required');

//        $this->form_validation->set_rules('meta_keywords', 'Keywords', 'required');

        $this->form_validation->set_rules('content', 'Content', 'required');

//        $this->form_validation->set_rules('link_rewrite', 'Link rewrite', 'required');

    }


    function index($category_id = NULL)
    {


        $list_items = $this->news_model->listnews($category_id); //


        $news_categories = $this->news_model->getCname();

        $first_item = array('../' => "Show all");

        $news_categories = $first_item + $news_categories;


        foreach ($list_items as &$item) {

            if (isset($news_categories[$item->id_news_category])) {

                $item->category_name = $news_categories[$item->id_news_category];

            } else {

                $item->category_name = 'Category không hợp lệ';

            }

        }

//        var_dump($list_items);die;

        //$this->load->view('admin/m_news',$data);

        $data['list_items'] = $list_items;

        $data['category_list'] = $news_categories;

        $data ['filter_category'] = $category_id;

        if (!$this->ion_auth->logged_in()) {

            redirect('panel/login');

        } else {

            $this->load->view('panel/home', $data);

        }

    }


    public function save()
    {

//        $news = array();

        if (isset($_POST['save'])) {


            @$news_input->id_language = 1;

            $id_news = $this->input->post('news_id');


            //use to assign back GUI when data invalid

            $news_input->id_news = $this->input->post('news_id');

            $news_input->id_news_category = $this->input->post('category');

            $news_input->title = $this->input->post('title');

            $news_input->meta_title = $this->input->post('meta_title');

            $news_input->meta_description = $this->input->post('meta_description');

            $news_input->meta_keywords = $this->input->post('meta_keywords');

            $news_input->content = $this->input->post('content');

            $news_input->link_rewrite = $this->input->post('link_rewrite');

            $news_input->active = $this->input->post('active');

            $news_input->focusable = $this->input->post('focus');

            $news_input->news_icon = $this->input->post('news_icon');

            $news_input->source = $this->input->post('source');

            if (strlen($id_news) > 0 && $id_news !== COMPANY_INSTRODUCE_NEWS_ID

                && $id_news !== SERVICES

                && $id_news !== WARRANTY

                && $id_news !== SITE_MAP
            ) {

                $this->form_validation->set_rules('link_rewrite', 'Link rewrite', 'required');

            }


            if (!$this->form_validation->run()) {

                $data['Cname'] = $this->news_model->getCname();

                $data['news'] = $news_input;

                $data['error'] = validation_errors();

                $this->load->view('panel/home', $data);

            } else {


                $id = $this->input->post('news_id');

                //check if entry is a company introduce or recruitment

                // don't update category, link rewrite,icon, focus.

                //otherwise update them

                if (strlen($id) === 0 || (strlen($id) > 0 && $id !== COMPANY_INSTRODUCE_NEWS_ID

                        && $id !== SERVICES

                        && $id !== WARRANTY

                        && $id !== SITE_MAP)
                ) {

                    $news['id_news_category'] = $this->input->post('category');

                    $news['link_rewrite'] = $this->input->post('link_rewrite');

                    $news['news_icon'] = $this->input->post('news_icon');

                    $news['source'] = $this->input->post('source');

                    $focus = $this->input->post('focus');

                    if (trim($focus) === '') {

                        $focus = FALSE;

                    } else {

                        $focus = TRUE;

                    }

                    $news['focusable'] = $focus;

                }

                $news['id_language'] = 1;

                $news['title'] = $this->input->post('title');

                $news['meta_title'] = $this->input->post('meta_title');

                $news['meta_description'] = $this->input->post('meta_description');

                $news['meta_keywords'] = $this->input->post('meta_keywords');

                $news['content'] = $this->input->post('content');

                $active = $this->input->post('active');

//                echo $active.'---';

                if (trim($active) === '') {

                    $active = FALSE;

                } else {

                    $active = TRUE;

                }

                $news['active'] = $active;


//                $id = $this->input->post('news_id');

//                $news_array = get_object_vars($news);

//                echo '<pre>';

//                print_r($news);

//                echo '</pre>';

//                var_dump($_FILES);

                $result;

                if (isset($id_news) && trim($id_news) !== "") {

                    $news['id_news'] = $id;

                    $this->news_model->update($news);

                    redirect(base_url('panel/admin_news'));

                } else {

                    //return inserted id

                    $result = $this->news_model->add($news);


                    if (is_numeric($result)) {

                        redirect(base_url('panel/admin_news/edit/' . $result));

                    } else {

                        show_error($result);

                    }

                }

            }

        } else {

            redirect(base_url('panel/admin_news'));

        }

    }


    public function add()
    {

        $data['Cname'] = $this->news_model->getCname();

        $news = new stdClass();

        $news->id_language = 1;

        $news->id_news_category = '';

        $news->title = '';

        $news->meta_title = '';

        $news->meta_description = '';

        $news->meta_keywords = '';

        $news->content = '';

        $news->link_rewrite = '';

        $news->active = 'true';

        $news->focusable = 'false';

        $news->news_icon = '';

        $news->source = '';

        $data['news'] = $news;

        $this->load->view('panel/home', $data);

    }


    public function edit($id)
    {

//        $id = $this->uri->rsegment(3);

        $column = "id_news";

        $new = array();

        $data['Cname'] = $this->news_model->getCname();

        $news = $this->news_model->read_by_id($id);

        if (!isset($news) && !$news) {

            show_error("News id " . $id . ' not found');

        } else {

            $data['news'] = $news;

            if (!$this->ion_auth->logged_in()) {

                redirect('panel/login');

            } else {


                $this->load->view('panel/home', $data);

            }

        }

//        if (isset($_POST['update'])) {

//            if ($this->form_validation->run() != FALSE) {

//                $this->load->view('admin/Editnews', $data);

//            } else {

////                echo "edit done";

////                $new['id_news'] = $id;

////                $new['id_language'] = 1;

////                $new['id_news_category'] = $this->input->post('category');

////                $new['title'] = $this->input->post('title');

////                $new['meta_title'] = $this->input->post('meta_title');

////                $new['meta_description'] = $this->input->post('meta_description');

////                $new['meta_keywords'] = $this->input->post('meta_keywords');

////                $new['content'] = $this->input->post('content');

////                $new['link_rewrite'] = 'second-post'; //$this->input->post('link_rewrite');

////                $new['active'] = $this->input->post('active');

////                $new['focusable'] = $this->input->post('focus');

////                echo '<pre>';

////                print_r($new);

////                echo '</pre>';

//                $result = $this->news_model->update($new);

//                if (!is_numeric($result)) {

//                    show_error($result);

//                }

//            }

//        } else {

//            $this->load->view('admin/EditNews', $data);

//        }

    }


    public function delete()
    {

        $id = $this->input->post('hiddelete');

        $this->news_model->delete(array('id_news' => $id));

        redirect(base_url() . 'panel/admin_news');

    }

    public function watch($id, $should_watch){
        $data = array(
            'should_watch' => ($should_watch+1)%2
        );

        $this->db->where('id_news', $id);
        $this->db->update('news', $data);

        redirect( base_url().'panel/admin_news' );
    }
}

?>