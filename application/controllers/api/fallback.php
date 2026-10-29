<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'core/Api_Controller.php';

/** Mọi đường dẫn /api/... không khớp route nào: trả 404 dạng JSON thay vì trang web */
class Fallback extends Api_Controller {

    public function index() {
        $this->error(404, 'not_found', 'Endpoint không tồn tại.');
    }
}
