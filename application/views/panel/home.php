<?php
$notice = '';
?>
<?php $this->load->view('panel/_header'); ?>
<table width="100%" cellspacing="0" cellpadding="0" align="center" class="table_border_line">
    <tr>
        <td width="194" height="495" background='<?php echo RES_PATH; ?>images/panel/admin-blue_15.gif' valign="top"><?php include_once '_menu.php'; ?></td>
        <td valign="top" bgcolor="#FFFFFF">
            <?php
            if (@$notice != '') {
                include_once '_errorMessage.php';
            } else {
                $data = array();
                $controller = $this->uri->segment(2);

                $action = $this->uri->segment(3);
                if ($controller === 'config') {
//                    var_dump($configs);
                    $this->load->view('panel/page_configs_edit');
                } else if (strtolower($controller) === 'gallery') {
                    if (isset($action) && trim($action) !== "") {
//                        if(isset($edit_item)){
                        $data['gallery'] = $edit_item['item'];
                        $data['gallery_categories'] = $edit_item['gallery_categories'];
//                            var_dump($edit_item);
//                            var_dump($data);

                        $this->load->view('panel/page_' . $controller . '_edit', $data);
//                        }
//                    $this->load->view('panel/page_'.$controller.'_edit');
                    } else if (isset($galleries)) {
                        $data['item_list'] = $galleries;                        
                        $this->load->view('panel/display_list_items', $data);
                    }
                } else if ($controller === 'change-password') {
                    $this->load->view('auth/change_password');
                } else if ($controller === 'login') {
                    $this->load->view('panel/index');
                } else if ($controller === 'create-user') {
                    $this->load->view('auth/create_user');
                } else if ($controller === 'admin_category') {
                    if (!isset($action) || trim($action) === "" || trim($action) === "index") {
                        $this->load->view('panel/category/index');
                    } else {
                        $this->load->view('panel/category/edit');
                    }
                } else if ($controller === 'admin_news') {

                    if (!isset($action) || trim($action) === "" || trim($action) === "index") {
                        if (isset($list_items)) {
                            $data['item_list'] = $list_items;
                            $data['category_list'] = $category_list;
                            $data ['filter_category'] = $filter_category;
                            $this->load->view('panel/display_list_news', $data);
                        } else {
                            echo 'Have error';
                        }
                    } else { // load edit page                        
                        $this->load->view('panel/page_news_edit');
                    }
                } else if ($controller === 'admin_services') {

                    if (!isset($action) || trim($action) === "" || trim($action) === "index") {
                        if (isset($list_items)) {
                            $data['item_list'] = $list_items;
                            $data['category_list'] = $category_list;
                            $data ['filter_category'] = $filter_category;
                            $this->load->view('panel/display_list_services', $data);
                        } else {
                            echo 'Have error';
                        }
                    } else { // load edit page                        
                        $this->load->view('panel/page_services_edit');
                    }
                } else if ($controller === 'contact') {

                    if (!isset($action) || trim($action) === "") {
                        if (isset($list_items)) {
                            $data['item_list'] = $list_items;
                            $this->load->view('panel/display_list_contact', $data);
                        } else {
                            echo 'Have error';
                        }
                    } else { // load edit page                        
                        $this->load->view('panel/page_contact_edit');
                    }
                }else if ($controller === 'admin_download') {
                    if (!isset($action) || trim($action) === "") {
                        if (isset($list_items)) {
                            $data['item_list'] = $list_items;
                            $this->load->view('panel/display_list_download', $data);
                        } else {
                            echo 'Have error';
                        }
                    } else {
                        $this->load->view('panel/page_download_edit');
                    }
                } else if ($controller === 'admin_partner') {
                    if (!isset($action) || trim($action) === "") {
                        if (isset($list_items)) {
                            $data['item_list'] = $list_items;
                            $this->load->view('panel/display_list_partner', $data);
                        } else {
                            echo 'Have error';
                        }
                    } else {
                        $this->load->view('panel/page_partner_edit');
                    }
                } else if ($controller === 'admin_feedback') {
                    if (!isset($action) || trim($action) === "") {
                        if (isset($list_items)) {
                            $data['item_list'] = $list_items;
                            $this->load->view('panel/display_list_feedback', $data);
                        } else {
                            echo 'Have error';
                        }
                    } else {
                        $this->load->view('panel/page_feedback_edit');
                    }                    
                } else if ($controller === 'admin_advertise') {
                    if (!isset($action) || trim($action) === "") {
                        if (isset($list_items)) {
                            $data['item_list'] = $list_items;
                            $this->load->view('panel/display_list_advertise', $data);
                        } else {
                            echo 'Have error';
                        }
                    } else {
                        $this->load->view('panel/page_advertise_edit');
                    }                    
                } else if ($controller === 'product_image') {
                	if (!isset($action) || trim($action) === "") {
	                	if(isset($pimages)) {
	                			$data['item_list'] = $pimages;                        
	                        	$this->load->view('panel/display_list_pimages', $data);
	                   	}
                	} else {
	                   		
	                		//$data['pimage'] = $edit_item['item'];
	                        //$data['gallery_categories'] = $edit_item['gallery_categories'];
	//                            var_dump($edit_item);
	//                            var_dump($data);
	
	                		$this->load->view('panel/page_pimage_edit', $data);
	                   	}
                } else if ($controller === 'admin_phone') {
                	if (!isset($action) || trim($action) === "" || trim($action) === "index") {
                		if (isset($list_items)) {
                			$data['item_list'] = $list_items;
                			$this->load->view('panel/display_list_phone', $data);
                		} else {
                			echo 'Have error';
                		}
                	} else {
                		$this->load->view('panel/page_phone_edit');
                	}
                } else if ($controller === 'admin_category_phone') {
                    if (!isset($action) || trim($action) === "" || trim($action) === "index") {
                        $this->load->view('panel/phonecategory/index');
                    } else {
                        $this->load->view('panel/phonecategory/edit');
                    }
                } else if ($controller === 'admin_banner') {
                    if (!isset($action) || trim($action) === "") {
                        if (isset($list_items)) {
                            $data['item_list'] = $list_items;
                            $this->load->view('panel/display_list_banner', $data);
                        } else {
                            echo 'Have error, I need item_list variable';
                        }
                    } else {
                        $this->load->view('panel/page_banner_edit');
                    }                    
                }else if ($controller === 'auth') {
                    echo $users;
//                    if (!isset($action) || trim($action) === "") {
                        
                    
                }else { // load edit page                        
//                    var_dump($new_item);
//                    $this->load->view('panel/page_news_edit');
                } 
            }
            ?>
            &nbsp;
        </td>
    </tr>
</table>
<?php include_once '_footer.php'; ?>
<?php
// ob_flush(); ?>