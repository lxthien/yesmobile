<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['thong-tin-bao-hanh'] = "welcome";
$route['thong-tin-bao-hanh/(:num)'] = "welcome";
$route['searchHistory'] = "welcome/searchHistory";

$route['default_controller'] = "home";
$route['panel'] = 'admin/dashboard';
$route['panel/(:any)'] = 'admin/$1';
$route['panel/(:any)/(:any)'] = 'admin/$1/$2';
$route['panel/login'] = 'admin/auth/login';
$route['panel/logout'] = 'admin/auth/logout';
$route['panel/change-password'] = 'admin/auth/change_password';
$route['panel/forgot-password'] = 'admin/auth/forgot_password';
$route['panel/create-user'] 	= 'admin/auth/create_user';
$route['admin/(:any)/([0-9]+)'] = 'admin/admin_news/$1/$2';
$route['contact/(:any)/([0-9]+)']='admin/contact/$1/$2';
//$route['panel/user'] = 'panel/auth';
//$route['panel/user/(:any)'] = 'panel/auth/$1';


$route['media/(:any)']                      = 'media/resize/$1';

$route['auths']                     = 'auths/$1';
$route['auths/checkWarrantyPeriod(:any)']              = 'auths/checkWarrantyPeriod/$1';
$route['auths/(:any)']              = 'auths/$1';

//For the member
$route['customers']                 = 'customers/$1';
$route['customers/customersPage(:any)']   = 'customers/customersPage/$1';
$route['customers/(:any)']          = 'customers/$1';
$route['customers/(:any)/(:any)']   = 'customers/$1/$2';

//For the tasks
$route['tasks']                     = 'tasks/$1';
$route['tasks/add/customer/(:any)']	= 'tasks/add/$1';
$route['tasks/listToday(:any)']		= 'tasks/listToday/$1';
$route['tasks/(:any)']              = 'tasks/$1';
$route['tasks/(:any)/(:any)']       = 'tasks/$1/$2';

#$route['tasks/listTask']            = 'tasks/listTask';
#$route['tasks/add']                 = 'tasks/add';
#$route['tasks/save']                = 'tasks/save';
#$route['tasks/edit/(:num)']         = 'tasks/edit/$1';
#$route['tasks/delete/(:num)']       = 'tasks/delete/$1';


$route['404_override'] = '';
$route['home'] = 'home/index';
$route['fbclid(:any)'] = 'home/index';
//$route['tin-tuc/(:any)/(:num)-(:any)'] = 'news/index/$2';
$route['gioi-thieu.html'] = 'company_introduce/index/gioi-thieu-cong-ty';
$route['site-map.html'] = 'company_introduce/index/site-map';
$route['dich-vu-sua-chua-dien-thoai.html'] = 'company_introduce/index/dich-vu-sua-chua';
$route['ep-kinh-dien-thoai-tai-vung-tau.html'] = 'company_introduce/index/ep-kinh-dien-thoai-tai-vung-tau';
$route['che-do-bao-hanh.html'] = 'company_introduce/index/che-do-bao-hanh';
$route['tuyen-dung.html'] = 'company_introduce/index/tuyen-dung';
$route['chinh-sach-bao-hanh.html'] = 'company_introduce/index/chinh-sach-bao-hanh';
$route['chinh-sach-van-chuyen.html'] = 'company_introduce/index/chinh-sach-van-chuyen';
//$route['gioi-thieu/(:any)'] = 'company_introduce/index/$1';

$route['san-pham/(:any)/(:any)/(:num)-(:any)'] = 'product/view_details/$0/$1/$2/$3';
$route['san-pham/gia-tu-(:num)-trieu-den-(:num)-trieu'] = 'product/view_theo_khoang_gia/$0/$1';
$route['san-pham/duoi-(:num)-trieu'] = 'product/view_theo_khoang_gia/$0/$1';
$route['san-pham/tren-(:num)-trieu'] = 'product/view_theo_khoang_gia/$0/$1';
$route['san-pham/(:any)/(:any)'] = 'product/view_2nd_level_category/$0/$1/$2';
$route['san-pham/(:any)'] = 'product/view_1st_level_category/$0/$1';
//$route['san-pham/(:any)'] = 'product';


$route['tai-ve/(:any)/(:num)-(:any)'] = 'download/view_details/$0/$1/$2';
$route['tai-ve/(:any)'] = 'download/view_download_on_category/$0/$1';
$route['tai-ve'] = 'download';

$route['lien-he'] = 'contact/index';
$route['lien-he/(:any)'] = 'contact/$1';
$route['search/(:any)'] = 'product/search/$1';
$route['search'] = 'product/search';

$route['tin-tuc/(:num)'] = 'news/view_post_on_page/$0/$1';
$route['(:any)/(:any)/(:num)-(:any)'] = 'news/index/$0/$1/$2';
$route['tin-tuc/(:any)'] = 'news/view_post_on_category/$0/$1';

$route['cam-nang/(:num)'] = 'news/view_post_on_page/$0/$1';
$route['(:any)/(:any)/(:num)-(:any)'] = 'news/index/$0/$1/$2';
$route['cam-nang/(:any)'] = 'news/view_post_on_category/$0/$1';

$route['(:any)/(:any)/(:num)-(:any)'] = 'news/index/$0/$1/$2';
$route['dich-vu'] = 'news/servicesDetail/$1';
$route['dich-vu/(:any)'] = 'news/servicesCat/$1/$2';
$route['(:num)-(:any)'] = 'news/servicesDetail/$0/$1';

$route['(:any)'] = 'news/view_post_on_page/$0/1';


/* End of file routes.php */
/* Location: ./application/config/routes.php */