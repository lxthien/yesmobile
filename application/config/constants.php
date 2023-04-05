<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');
define('IMAGES_PATH','assets/images');
define('CSS_PATH', '/assets/css');
define('SCRIPT_PATH', 'assets/js');
define('PIC_PATH', 'assets/hinh');
//define('RES_PATH','http://thangmobile.com/assets/');
define('RES_PATH','https://yesmobile.com.vn/assets/');
define('COMPANY_INSTRODUCE_NEWS_ID','1');
define('SITE_MAP','2');
define('SERVICES','3');
define('EPKINH','1562');
define('WARRANTY','4');
define('RECRUIT','150');
define('WARRANTYPOLICY','152');
define('DELEVERYPOLICY','153');


define('URL_TRAIL','.html');
define('MAX_ITEM_PAGINAGION',15);
define('MAX_DES_TITLE', 20);
define('MAX_DES_CONTENT', 400);
define('UPLOAD_DIR','/files');
define('THUMBNAILS','/thumbnails');
define('MAX_LATEST_IMAGES','20');
define('DOWNLOAD_DIR','/files');
define('PARTNER_LOGO','/files/logo');
define('BANNER_PATH','/assets/images/banners/');
define('NO_OF_NEWS_IN_EACH_CATEGORY_IN_HOMEPAGE','3');
define('NO_OF_FOCUS_NEWS_IN_HOMEPAGE','5');
define('LIMIT_SHOW_ALL_NEWS','20');
/* End of file constants.php */
/* Location: ./application/config/constants.php */