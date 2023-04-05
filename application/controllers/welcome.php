<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller {

    var $menu_active = 'bao-hanh';

    public function __construct() {
        parent::__construct();
        $this->load->model('Image_model','image_model');
        $this->load->model('Banner_model', 'banner_model');
        $this->load->model('Advertise_model', 'advertise_model');
        $this->load->model('Download_model', 'download_model');
		$this->load->model('services_model', 'services_model');
		$this->load->model('customer_model', 'customer_model');
		$this->load->model('task_model', 'task_model');
		$this->load->helper('myhelper');
    }

	public function index() {
        $data['latest_downloads'] = $this->get_latest_download();
		$data['servicesHomepages'] = $this->services_model->read_list_by_list_categries_homepage(array(6,8,9,11,12,24,25,26,27,28,29,30,32,33,34,35,70,71), 0, 3);
        $data['phoneNumber'] = $this->uri->segment(2);

        $this->site_meta_data['meta_title'] = "Kiểm tra thời hạn bảo hành sửa chữa điện thoại tại Yes Mobile";
        $this->site_meta_data['meta_description'] = "Yes Mobile luôn bảo hành chu đáo điện thoại Quý khách hàng đã mua và sửa chữa tại cửa hàng Chúng tôi. Quý khách vui lòng truy cập trang này để kiểm tra bảo hành.";
        $this->site_meta_data['meta_keywords'] = "Yes Mobile, Yes Mobile Vũng Tàu, sửa điện thoại vũng tàu, bảo hành điện thoại vũng tàu";
        $data['site_meta_data'] = $this->site_meta_data;

        $this->load->view('welcome', $data);      
	}

	public function searchHistory() {
        $q = $this->input->post('q');
        $format = $this->input->post('format');
        $customers = $this->customer_model->getHistoryByNameOrPhone($q);
        if(count($customers) == 0) {
            if ($format)
                echo 'Số điện thoại này chưa có thông tin bảo hành tại Yes Mobile';
            else 
                echo '<p class="msg message">Số điện thoại này chưa có thông tin bảo hành tại Yes Mobile. Quý khách hàng vui lòng kiểm tra lại số điện thoại hoặc liên hệ ngay với Chúng tôi: 0847 72 72 72. Cám ơn Quý khách hàng!</p><div style="width: 100%; margin-top: 20px; float: left; font-size: 15px;"><p><strong>Yes Mobile | Sửa chữa điện thoại từ 2010</strong></p>
                    <p>Cửa hàng 1: 438 Trương Công Định, Phường 8, TP. Vũng Tàu</p>
					<p>Cửa hàng 2: Đường 28/4, Thôn 6, Xã Long Sơn, TP. Vũng Tàu</p>
                    <p>Hotline: 0847 72 72 72 - Email: yesmobile.vn@gmail.com</p>
                    <p>Website: <a href="http://yesmobile.vn/">www.yesmobile.vn</a> - <a href="http://dienthoaivungtau.com/">www.dienthoaivungtau.com</a></p></div>';
        } else {
        	$tasks = $this->task_model->customerRequest($customers[0]->id);
        	if(count($tasks) == 0) {
                if ($format)
                    echo 'Số điện thoại này chưa có thông tin bảo hành tại Yes Mobile';
                else 
                    echo '<p class="msg message">Cám ơn Quý khách đã tin tưởng và sử dụng dịch vụ của Yes Mobile. Số điện thoại này chưa có thông tin bảo hành tại cửa hàng Chúng tôi. Mọi thắc mắc vui lòng liên hệ: 0847 72 72 72</p><div style="width: 100%; margin-top: 20px; float: left; font-size: 15px;"><p><strong>Yes Mobile | Sửa chữa điện thoại từ 2010</strong></p>
                    <p>Cửa hàng 1: 438 Trương Công Định, Phường 8, TP. Vũng Tàu</p>
					<p>Cửa hàng 2: Đường 28/4, Thôn 6, Xã Long Sơn, TP. Vũng Tàu</p>
                    <p>Hotline: 0847 72 72 72 - Email: yesmobile.vn@gmail.com</p>
                    <p>Website: <a href="http://yesmobile.vn/">www.yesmobile.vn</a> - <a href="http://dienthoaivungtau.com/">www.dienthoaivungtau.com</a></p></div>';
        	} else {
                if ($format)
                    echo true;
                else {
                    $information='<p class="msg message">Cám ơn Quý khách đã tin tưởng và sử dụng dịch vụ của Yes Mobile. Dưới đây là thông tin bảo hành của Quý khách:</p><div class="table">';
                    foreach ($tasks as $key => $value) {
                        $status = $value->taskStatus == 1 ? formatDate($value->warrantyPeriod) : 'Chưa có';
                        $information .= '<div class="row">';
                        $information .= '<div class="cell">';
                        $information .= '<p><b>Tên máy:</b> '.$value->phoneType.'</p>';
                        $information .= '<p><b>Imei:</b> '.$value->phoneImei.'</p>';
                        $information .= '<p><b>Tình trạng:</b> '.$value->phoneStatus.'</p>';
                        $information .= '</div>';
                        if($value->taskType==1)
                            $information .= '<div class="cell"><b>Ngày sửa:</b> '. formatDate($value->created) .'</div>';
                        else
                            $information .= '<div class="cell"><b>Ngày mua:</b> '. formatDate($value->created) .'</div>';
                        $information .= '<div class="cell"><b>Bảo hành đến:</b> '.$status.'</div>';
                        $information .= '</div>';
                    }
                    $information.='</div>';
                    $information.='<div style="width: 100%; margin-top: 20px; float: left; font-size: 15px;"><p><strong>Yes Mobile | Sửa chữa điện thoại từ 2010</strong></p>
                        <p>Cửa hàng 1: 438 Trương Công Định, Phường 8, TP. Vũng Tàu</p>
					    <p>Cửa hàng 2: Đường 28/4, Thôn 6, Xã Long Sơn, TP. Vũng Tàu</p>
                        <p>Hotline: 0847 72 72 72 - Email: yesmobile.vn@gmail.com</p>
                        <p>Website: <a href="https://yesmobile.vn/">www.yesmobile.vn</a> - <a href="http://dienthoaivungtau.com/">www.dienthoaivungtau.com</a></p></div>';
                    echo $information;
                }
        	}
        }
        die;
    }
        
    public function save_image(){
        $this->image_model->add(array('name'=>'hinh 1.png', 'album_id'=>'17'));
    }

    public function get_latest_download() {
    	$latest_downloads = $this->download_model->_get_latest_download();
    	foreach ($latest_downloads as $download) {
    		$eachCategory = $this->download_category_model->read_by_id($download->category_id);
    		$download->link_rewrite = 'tai-ve/'.$eachCategory->link_rewrite.'/'.$download->id.'-'.$download->link_rewrite.URL_TRAIL;
    
    	}
    	 
    	return $latest_downloads;
    }
}