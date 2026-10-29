<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
| Cấu hình API v1 cho bên thứ 3.
*/

// Ghi log mỗi request vào bảng api_logs (cần cho giới hạn tần suất)
$config['log_requests'] = TRUE;

// Số request tối đa mỗi key trong 60 giây. 0 = không giới hạn.
$config['rate_limit_per_minute'] = 60;

// Phân trang
$config['default_per_page'] = 20;
$config['max_per_page'] = 100;

/* End of file api.php */
