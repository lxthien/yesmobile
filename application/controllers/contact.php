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
class Contact extends MY_Controller {

    //put your code here
    var $page_meta = array();
    var $title_character_nr = 80;
    var $content_word_nr = 100;
    var $total_posts;
    var $site_meta_data = array();
	var $menu_active = 'contact';

    public function __construct() {
        parent::__construct();
        $this->load->model('Mcontact');
        $this->load->model('Banner_model', 'banner_model');
        $this->load->model('Advertise_model', 'advertise_model');
        $this->load->model('Download_model', 'download_model');
		$this->load->model('services_model', 'services_model');
    }

    public function index() {
        $data = $this->load->get_var('data');
        $this->load->library('form_validation');
            $this->load->helper(array('form', 'form'));
        if (isset($_POST['submit'])) {            
            $this->form_validation->set_message('required', 'Vui lòng nhập');
            $this->form_validation->set_message('valid_email', 'Vui lòng kiểm tra email');
            $this->form_validation->set_message('numeric', 'Số điện thoại không hợp lệ');
            $this->form_validation->set_message('min_length', 'Số điện thoại không hợp lệ');
            $this->form_validation->set_message('max_length', 'Số điện thoại không hợp lệ');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            $this->form_validation->set_rules('full_name', 'Họ và tên', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
            $this->form_validation->set_rules('telephone', 'Điện thoại', 'trim|required|numeric|xss_clean|min_length[10]|max_length[11]');
            $this->form_validation->set_rules('message', 'Nội dung', 'trim|required|xss_clean');            
            
            if (!$this->form_validation->run()) {                
                $data_contact['full_name'] = $this->input->post('full_name');
                $data_contact['email'] = $this->input->post('email');
                $data_contact['telephone'] = $this->input->post('telephone');
                $data_contact['message'] = $this->input->post('message');                
            } else {
                $contact_name = $this->input->post('full_name');
                $contact_email = $this->input->post('email');
                $contact_phone = $this->input->post('telephone');
                $contact_message = $this->input->post('message');
                $received_contact_email_address = $this->sconfig->get_value('CONTACT_EMAIL');
                
                //              put send mail here start
               	if ($this->_send_mail_contact($contact_name, $contact_email, $contact_phone, $contact_message, $received_contact_email_address)) {
                	$data_contact['success'] = '<p class="success" style="font-size: 15px; padding: 5px 0 0px; line-height: 18px;">Cảm ơn bạn! Yes Mobile đã nhận được thông tin của bạn. Chúng tôi sẽ liên lạc với bạn ngay nhé! </p>';
               	}
               	else {
               		$data_contact['success'] = '<p class="success" style="font-size: 13px; padding: 5px 0 0px; line-height: 18px;">Có lỗi xảy ra, xin Quý khách vui lòng thử lại!</p>';
               	}
//              put send mail here end

                         
            }
        } else {             
                $data_contact['full_name'] = '';
                $data_contact['email'] = '';
                $data_contact['telephone'] = '';
                $data_contact['message'] = ''; 
        }
        $this->_get_meta_data();
	//	echo 'QUANG'.$data_contact['success'];
       // $data['contact_block'] = $this->_load_contact_block();
        $data['download_block_main'] = $this->load->view('lienHe/lien_he', $data_contact, TRUE);
        $data['site_meta_data'] = $this->site_meta_data;
        $data['partners'] = $this->_get_partners();
        $data['block_title'] = 'Liên hệ';
        $data['banners'] = $this->banner_model->get_active_list();
        $data['home_advertises'] = $this->advertise_model->read_list_by_position(1);
        $data['latest_downloads'] = $this->get_latest_download();
        $data['contact'] = $this->Mcontact->listcontact();
        $data['download_menu'] = $this->download_category_model->read_by_parent_id(1);
		$data['servicesHomepages'] = $this->services_model->read_list_by_list_categries_homepage(array(6,8,9,11,12,24,25,26,27,28,29,30,32,33,34,35,70,71), 0, 3);
        $this->load->view('contact', $data);
        
    }
    public function get_latest_download() {
    	$latest_downloads = $this->download_model->_get_latest_download();
    	foreach ($latest_downloads as $download) {
    		$eachCategory = $this->download_category_model->read_by_id($download->category_id);
    		$download->link_rewrite = 'tai-ve/'.$eachCategory->link_rewrite.'/'.$download->id.'-'.$download->link_rewrite.URL_TRAIL;
    
    	}
    	 
    	return $latest_downloads;
    }

    private function _load_contact_block() {
        $data = array();
        $data['contact'] = $this->Mcontact->listcontact();
//        var_dump($data);
        return $this->load->view('hotline/block_hot_line', $data, TRUE);
    }

    /**
     * Set meta data for page
     * @param type $post 
     */
    function _get_meta_data() {
        $this->	site_meta_data['title'] = 'Liên hệ cửa hàng điện thoại Yes Mobile';
        $this->site_meta_data['meta_title'] = 'Liên hệ cửa hàng điện thoại Yes Mobile';
        $this->site_meta_data['meta_description'] = 'Thông tin liên hệ cửa hàng điện thoại Yes Mobile Vũng Tàu, cung cấp các dịch vụ sửa chữa smartphone từ năm 2010. ';
        $this->site_meta_data['meta_keywords'] = 'sua dien thoai vung tau, sua iphone vung tau, ep kinh vung tau';
    }

    private function _get_partners() {
        $this->load->model('Partner_model', 'partner_model');
        return $this->partner_model->read_list();
    }
    
    function _send_mail_contact($contact_name, $contact_email, $contact_phone, $contact_message, $received_contact_email_address) {
    	
    	require_once('class.phpmailer.php');
    	
    	$mail = new PHPMailer(); // defaults to using php "mail()"
    	$mail->CharSet = "UTF-8";
    	$body = $contact_message;
    	$body .= ('<br>Số điện thoại khách hàng: '. $contact_phone);
    	
    	$mail->SetFrom($contact_email, $contact_name);
    	
    	$mail->AddAddress($received_contact_email_address);
    	
    	
    	$mail->Subject    = "Yes Mobile - Khánh hàng gởi liên hệ";
    	
    	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
    	
    	$mail->MsgHTML($body);
    	
    	
    	return $mail->Send();
    	
    }

}

?>
