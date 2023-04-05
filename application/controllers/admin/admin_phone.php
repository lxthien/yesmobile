<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminPhone
 *
 * @author VuQ
 */
class Admin_phone extends CI_Controller {

    var $logo_dir; //= dirname($_SERVER['SCRIPT_FILENAME']) . UPLOAD_DIR . '/logo/';

    function __construct() {
        parent::__construct();
        $this->load->model('Product_model', 'product_model');
        //$this->load->model('Advertise_position_model', 'advertise_position_model');
        // From validator
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'text'));
        $this->form_validation->set_rules('Producer', 'Logo', 'required|xss_clean');
        //$this->form_validation->set_rules('url', 'Link', 'required|xss_clean');
        //$this->form_validation->set_rules('position_id', 'Position', 'required|xss_clean');
        //$this->form_validation->set_rules('url', 'Url', 'required');
        //CK editor        
        $_SESSION['KCFINDER'] = array();
        $_SESSION['KCFINDER']['disabled'] = false;
        $this->load->library('ckeditor', array('instanceName' => 'CKEDITOR1', 'basePath' => base_url() . "ckeditor/", 'outPut' => true));
       
        $this->logo_dir = dirname($_SERVER['SCRIPT_FILENAME']) . PARTNER_LOGO . '/ads';
    }

    function index($category_id = NULL) {
        if ($category_id == NULL)
            $list_items = $this->_get_list_phones();
        else
            $list_items = $this->product_model->read_by_category_id($category_id);
        
        $news_categories = $this->product_model->getCname();
        $first_item = array('../' => "Show all");
        $news_categories = $first_item + $news_categories;
    	
        foreach ($list_items as &$item) {
            if (isset($news_categories[$item->product_category_id])) {
                $item->category_name = $news_categories[$item->product_category_id];
            } else {
                $item->category_name = 'Category không hợp lệ';
            }
        }
         
        $data['list_items'] = $list_items;
        $data['category_list'] = $news_categories;
        $data ['filter_category'] = $category_id;

        if(!$this->ion_auth->logged_in()) {
    		redirect('panel/login');
        } else {
	        $this->load->view('panel/home', $data);
        }
        
    }

    private function _get_list_phones() {
    	
        $list_phones = $this->product_model->read_list();
        return $list_phones;
    }

    public function save() {
        if (isset($_POST['save'])) {
            $id_phone = $this->input->post('item_id');
            
            //use to assign back GUI when data invalid
            @$phone_input->id = $this->input->post('item_id');
            $phone_input->producer = $this->input->post('producer');
            $phone_input->model = $this->input->post('model');
            $phone_input->price = $this->input->post('price');
            $phone_input->gia_cu = $this->input->post('gia_cu');
            $phone_input->product_category_id = $this->input->post('category');
            $phone_input->description = $this->input->post('description');
            $phone_input->introduction = $this->input->post('introduction');
            $phone_input->meta_title = $this->input->post('meta_title');
            $phone_input->meta_description = $this->input->post('meta_description');
            $phone_input->meta_keywords = $this->input->post('meta_keywords');
            $phone_input->active = $this->input->post('active');
            $phone_input->best_sell = $this->input->post('best_sell');
            $phone_input->moi_ve = $this->input->post('moi_ve');
            $phone_input->sap_ve = $this->input->post('sap_ve');
            $phone_input->gia_tot = $this->input->post('gia_tot');
            $phone_input->qua_tang = $this->input->post('qua_tang');
            $phone_input->link_rewrite = $this->input->post('link_rewrite');
            
            $phone_input->isHight = $this->input->post('isHight');
            $phone_input->isIntermediate = $this->input->post('isIntermediate');
            $phone_input->baseInformation = $this->input->post('baseInformation');
            $phone_input->noteInformation = $this->input->post('noteInformation');
            $phone_input->note = $this->input->post('note');
            $phone_input->isStatus = $this->input->post('isStatus');
            

            $phone_input->sale_off = $this->input->post('sale_off');
            $phone_input->approx_price = $this->input->post('approx_price');
            $phone_input->status = $this->input->post('status');
            $phone_input->time_warranty = $this->input->post('time_warranty');
            $phone_input->accesory = nl2br(htmlspecialchars($this->input->post('accesory')));
            $phone_input->is_new = $this->input->post('is_new');

            $phone['producer'] = $this->input->post('producer');
            $phone['model'] = $this->input->post('model');
            $phone['price'] = $this->input->post('price');
            $phone['gia_cu'] = $this->input->post('gia_cu');
            $phone['link_rewrite'] = $this->input->post('link_rewrite');
            $phone['sale_off'] = $this->input->post('sale_off');
            $phone['meta_title'] = $this->input->post('meta_title');
            $phone['meta_description'] = $this->input->post('meta_description');
            $phone['meta_keywords'] = $this->input->post('meta_keywords');
            $phone['product_category_id'] = $this->input->post('category');
            $phone['description'] = $this->input->post('description');
            $phone['introduction']  = $this->input->post('introduction');
            $phone['approx_price'] = $this->input->post('approx_price');
            $phone['accesory'] = nl2br(htmlspecialchars($this->input->post('accesory')));
            $phone['time_warranty'] = $this->input->post('time_warranty');
            $phone['status'] = $this->input->post('status');
            $phone['isStatus'] = $this->input->post('isStatus');
            $phone['isHight'] = $this->input->post('isHight');
            $phone['isIntermediate'] = $this->input->post('isIntermediate');
            $phone['baseInformation'] = $this->input->post('baseInformation');
            $phone['noteInformation'] = $this->input->post('noteInformation');
            $phone['note'] = $this->input->post('note');
                
                
            $active = $this->input->post('active');
            if (trim($active) === '') {
                $active = FALSE;
            } else {
                $active = TRUE;
            }
            $phone['active'] = $active;
			
            $best_sell = $this->input->post('best_sell');
			if(trim($best_sell) === ''){
				$best_sell = FALSE;
			}else{
				$best_sell = TRUE;
			}
			$phone['best_sell'] = $best_sell;
			
			$moi_ve = $this->input->post('moi_ve');
			if(trim($moi_ve) === ''){
				$moi_ve = FALSE;
			}else{
				$moi_ve = TRUE;
			}
			$phone['moi_ve'] = $moi_ve;
			
			$sap_ve = $this->input->post('sap_ve');
			if(trim($sap_ve) === ''){
				$sap_ve = FALSE;
			}else{
				$sap_ve = TRUE;
			}
			$phone['sap_ve'] = $sap_ve;
			
			$gia_tot = $this->input->post('gia_tot');
			if(trim($gia_tot) === ''){
				$gia_tot = FALSE;
			}else{
				$gia_tot = TRUE;
			}
			$phone['gia_tot'] = $gia_tot;
			
			$qua_tang = $this->input->post('qua_tang');
			if(trim($qua_tang) === ''){
				$qua_tang = FALSE;
			}else{
				$qua_tang = TRUE;
			}
			$phone['qua_tang'] = $qua_tang;
            
            $is_new = $this->input->post('is_new');
            if (trim($is_new) === '') {
                $is_new = FALSE;
            } else {
                $is_new = TRUE;
            }
            $phone['is_new'] = $is_new;

            $result;

            /* Start upload file */
            if (count($_FILES) > 0 && $_FILES['logo']['error'] !== 4) {

                $config['upload_path'] = $this->logo_dir;
                $config['allowed_types'] = 'gif|jpg|png';
                $file_name = preg_replace('/[^a-zA-Z]/', '', ucwords($phone['producer']));
                
                $config['file_name'] = $file_name;
                $config['overwrite'] = FALSE;
                $config['encrypt_name'] = TRUE;

                $this->load->library('upload', $config);
                foreach($_FILES as $field => $file){
                	
                    if (!$this->upload->do_upload($field)) {
                        echo 'Có lỗi upload: ';
                        $data['error'] = array('error' => $this->upload->display_errors());
                        //$data['position_names'] = $this->advertise_position_model->build_position_name();
                        $phone_input->logo = '';
                        $data['new_item'] = $phone_input;
                        $data_upload = $this->upload->data();
                        echo $data_upload['file_type'] . '<br>';
                        //var_dump($data['error']);
                        $this->load->view('panel/page_phone_edit', $data);
                    } else {
                        $data_upload = array('upload_data' => $this->upload->data());
                        if (count($data_upload) > 0) {
                            $uploaded_file = $data_upload["upload_data"];
                            $phone[$field] = $uploaded_file['file_name'];
                        } else {
                            show_error("Have error when upload file");
                        }
                    }
                }
            }                
            /* End upload file */

			$result;
            if (isset($id_phone) && trim($id_phone) !== "") {
                $phone['id'] = $id_phone;
                $this->product_model->update($phone);
            } else {
                $result = $this->product_model->add($phone);
            }
            if (isset($result)) {
                if (is_numeric($result) && (!isset($id_phone) || trim($id_phone) === "")) {
                    redirect(base_url('panel/admin_phone/edit') . '/' . $result);
                } else {
                    show_error($result);
                }
            } else {
                redirect(base_url('panel/admin_phone'));
            }
        }
    }

    public function add() {
		$data['Cname'] = $this->product_model->getCname();
		$phone = new stdClass();
		$phone->id = '';
        $phone->producer = '';
        $phone->price = '';
        $phone->gia_cu = '';
        $phone->description = '';
        $phone->introduction = '';
        $phone->model = '';
        $phone->meta_title = '';
        $phone->meta_description = '';
        $phone->meta_keywords = '';
        $phone->link_rewrite = '';
        $phone->logo = '';
        $phone->logo1 = '';
        $phone->logo2 = '';
        $phone->active = 'true';
        $phone->best_sell = 'true';
        $phone->product_category_id = '';
        $phone->sale_off = '';
        $phone->approx_price = '';
        $phone->status = '';
        $phone->time_warranty = '';
        $phone->accesory = '';
        $phone->is_new = '';
        $phone->product_image_id = '';
        $phone->moi_ve = '';
        $phone->sap_ve = '';
        $phone->gia_tot = '';
        $phone->qua_tang = '';
        
        $phone->isHight = '';
        $phone->isIntermediate = '';
        $phone->baseInformation = '';
        $phone->noteInformation = '';
        $phone->note = '';
        $phone->isStatus = '';
        
        $data['new_item'] = $phone;
        $this->load->view('panel/home', $data);
    }

    public function edit($id) {
        $new_item = $this->product_model->read_by_id($id);
        $data['Cname'] = $this->product_model->getCname();
        if (!isset($new_item) && !$new_item) {
            show_error("Phone id " . $id . ' not found');
        } else {
            $data['new_item'] = $new_item;
            $this->load->view('panel/home', $data);
        }
    }

    public function delete() {
        $id = $this->input->post('hiddelete');
        
        if (!isset($id) || strlen($id) === 0) {
            show_error('Cannot get phone to delete');
        } else {
            $delete_phone = $this->product_model->read_by_id($id);
            if (isset($delete_phone)) {
                if ($this->delete_uploaded_file($delete_phone->logo)) {
                    error_log('Cannot delete file ' . $delete_phone->logo);
                }
                $this->product_model->delete(array('id' => $id));
            } else {
                 show_error ("Cannot find phone item with id " . $id);
            }
        }
        redirect(base_url() . 'panel/admin_phone');
    }

    public function delete_uploaded_file($file_name) {
        $file_path = $this->logo_dir . $file_name;
        $success = is_file($file_path) && $file_name[0] !== '.' && unlink($file_path);
        return $success;
    }
    
    public function upload() {
    	//        error_log("Oracle database not available!".$_REQUEST['_method'], 0);
    	error_reporting(E_ALL | E_STRICT);
    
    	$this->load->helper("upload.class");
    
    	$upload_handler = new UploadHandler();
    
    	header('Pragma: no-cache');
    	header('Cache-Control: no-store, no-cache, must-revalidate');
    	header('Content-Disposition: inline; filename="files.json"');
    	header('X-Content-Type-Options: nosniff');
    	header('Access-Control-Allow-Origin: *');
    	header('Access-Control-Allow-Methods: OPTIONS, HEAD, GET, POST, PUT, DELETE');
    	header('Access-Control-Allow-Headers: X-File-Name, X-File-Type, X-File-Size');
    
    	switch ($_SERVER['REQUEST_METHOD']) {
    		case 'OPTIONS':
    			break;
    		case 'HEAD':
    		case 'GET':
    			$upload_handler->get();
    			break;
    		case 'POST':
    			if (isset($_REQUEST['_method']) && $_REQUEST['_method'] === 'DELETE') {
    				$upload_handler->delete();
    			} else {
    				$upload_handler->post();
    			}
    			break;
    		case 'DELETE':
    			$upload_handler->delete();
    			break;
    		default:
    			header('HTTP/1.1 405 Method Not Allowed');
    	}
    }

}