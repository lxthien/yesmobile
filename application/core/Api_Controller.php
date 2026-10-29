<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller nền cho API v1 (chỉ đọc).
 *
 * - Xác thực bằng header "X-API-Key" (hoặc "Authorization: Bearer <key>").
 * - Chỉ chấp nhận GET.
 * - Trả JSON dạng {"success": true, "data": ..., "meta": ...}
 *   hoặc {"success": false, "error": {"code": ..., "message": ...}}.
 *
 * Không kế thừa MY_Controller vì lớp đó nạp menu, sản phẩm, tin tức... cho giao diện web.
 */
class Api_Controller extends CI_Controller {

    /** Bản ghi api_keys của đối tác đang gọi */
    protected $api_client = NULL;

    private $request_started;

    function __construct() {
        parent::__construct();

        $this->request_started = microtime(TRUE);
        $this->config->load('api', TRUE);
        $this->load->model('Api_model', 'api_model');

        if (strtoupper($_SERVER['REQUEST_METHOD']) !== 'GET') {
            header('Allow: GET');
            $this->error(405, 'method_not_allowed', 'API chỉ hỗ trợ phương thức GET.');
        }

        $this->authenticate();
        $this->check_rate_limit();
    }

    // ------------------------------------------------------------------
    // Xác thực & giới hạn
    // ------------------------------------------------------------------

    private function authenticate() {
        $key = $this->read_api_key();
        if ($key === '') {
            $this->error(401, 'missing_api_key', 'Thiếu API key. Gửi key qua header X-API-Key.');
        }

        $client = $this->api_model->find_active_key(hash('sha256', $key));
        if (!$client) {
            $this->error(401, 'invalid_api_key', 'API key không hợp lệ hoặc đã bị thu hồi.');
        }

        if (trim((string) $client->allowed_ips) !== '') {
            $allowed = array_map('trim', explode(',', $client->allowed_ips));
            if (!in_array($this->input->ip_address(), $allowed, TRUE)) {
                $this->api_client = $client;
                $this->error(403, 'ip_not_allowed', 'IP của bạn không được phép dùng key này.');
            }
        }

        $this->api_client = $client;
        $this->api_model->touch_key($client->id);
    }

    private function read_api_key() {
        if (!empty($_SERVER['HTTP_X_API_KEY'])) {
            return trim($_SERVER['HTTP_X_API_KEY']);
        }

        $auth = '';
        if (!empty($_SERVER['HTTP_AUTHORIZATION'])) {
            $auth = $_SERVER['HTTP_AUTHORIZATION'];
        } elseif (!empty($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
            $auth = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
        }
        if (preg_match('/^Bearer\s+(\S+)$/i', trim($auth), $m)) {
            return $m[1];
        }

        return '';
    }

    private function check_rate_limit() {
        $limit = (int) $this->config->item('rate_limit_per_minute', 'api');
        if ($limit <= 0 || !$this->config->item('log_requests', 'api')) {
            return;
        }

        $used = $this->api_model->count_recent_requests($this->api_client->id, 60);
        header('X-RateLimit-Limit: ' . $limit);
        header('X-RateLimit-Remaining: ' . max(0, $limit - $used - 1));

        if ($used >= $limit) {
            header('Retry-After: 60');
            $this->error(429, 'rate_limited', 'Vượt quá ' . $limit . ' request/phút. Vui lòng thử lại sau.');
        }
    }

    // ------------------------------------------------------------------
    // Đọc tham số
    // ------------------------------------------------------------------

    /** Trả về array(offset, limit, page, per_page) từ ?page=&per_page= */
    protected function pagination() {
        $default = (int) $this->config->item('default_per_page', 'api');
        $max = (int) $this->config->item('max_per_page', 'api');

        $page = $this->int_param('page', 1);
        $per_page = $this->int_param('per_page', $default);

        if ($page < 1) {
            $this->error(400, 'invalid_parameter', 'page phải là số nguyên >= 1.');
        }
        if ($per_page < 1 || $per_page > $max) {
            $this->error(400, 'invalid_parameter', 'per_page phải trong khoảng 1-' . $max . '.');
        }

        return array(($page - 1) * $per_page, $per_page, $page, $per_page);
    }

    protected function paging_meta($total, $page, $per_page) {
        return array(
            'page' => $page,
            'per_page' => $per_page,
            'total' => (int) $total,
            'total_pages' => (int) ceil($total / $per_page),
        );
    }

    /** Tham số chuỗi; NULL nếu không gửi hoặc rỗng */
    protected function str_param($name) {
        $value = $this->input->get($name);
        if ($value === FALSE || $value === NULL || is_array($value)) {
            return NULL;
        }
        $value = trim($value);
        return $value === '' ? NULL : $value;
    }

    /** Tham số số nguyên; báo lỗi 400 nếu sai định dạng */
    protected function int_param($name, $default = NULL) {
        $value = $this->str_param($name);
        if ($value === NULL) {
            return $default;
        }
        if (!ctype_digit($value)) {
            $this->error(400, 'invalid_parameter', $name . ' phải là số nguyên không âm.');
        }
        return (int) $value;
    }

    /** Tham số ngày giờ (Y-m-d hoặc Y-m-d H:i:s); trả về chuỗi Y-m-d H:i:s */
    protected function datetime_param($name, $end_of_day = FALSE) {
        $value = $this->str_param($name);
        if ($value === NULL) {
            return NULL;
        }
        if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
            $value .= $end_of_day ? ' 23:59:59' : ' 00:00:00';
        }
        $parsed = DateTime::createFromFormat('Y-m-d H:i:s', $value);
        if (!$parsed || $parsed->format('Y-m-d H:i:s') !== $value) {
            $this->error(400, 'invalid_parameter', $name . ' phải có dạng YYYY-MM-DD hoặc YYYY-MM-DD HH:MM:SS.');
        }
        return $value;
    }

    /** Kiểm tra id lấy từ URL là số nguyên dương */
    protected function valid_id($id) {
        if ($id === NULL || !ctype_digit((string) $id) || (int) $id < 1) {
            $this->error(404, 'not_found', 'Không tìm thấy tài nguyên.');
        }
        return (int) $id;
    }

    // ------------------------------------------------------------------
    // Trả kết quả
    // ------------------------------------------------------------------

    protected function respond($data, $meta = NULL, $status = 200) {
        $body = array('success' => TRUE, 'data' => $data);
        if ($meta !== NULL) {
            $body['meta'] = $meta;
        }
        $this->send($status, $body);
    }

    protected function error($status, $code, $message) {
        $this->send($status, array(
            'success' => FALSE,
            'error' => array('code' => $code, 'message' => $message),
        ));
    }

    private function send($status, $body) {
        // Session được autoload cho website; API không dùng cookie
        if (function_exists('header_remove')) {
            header_remove('Set-Cookie');
        }

        $flags = 0;
        if (defined('JSON_UNESCAPED_UNICODE')) {
            $flags |= JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES;
        }
        if (defined('JSON_PARTIAL_OUTPUT_ON_ERROR')) {
            $flags |= JSON_PARTIAL_OUTPUT_ON_ERROR;
        }

        // CI 2.1.2 không biết mã 429 nên luôn truyền kèm mô tả
        $texts = array(200 => 'OK', 400 => 'Bad Request', 401 => 'Unauthorized', 403 => 'Forbidden',
            404 => 'Not Found', 405 => 'Method Not Allowed', 429 => 'Too Many Requests');
        set_status_header($status, isset($texts[$status]) ? $texts[$status] : 'Error');
        header('Content-Type: application/json; charset=utf-8');
        header('Cache-Control: no-store');
        header('X-Content-Type-Options: nosniff');
        echo json_encode($body, $flags);

        $this->log_request($status);
        exit;
    }

    private function log_request($status) {
        if (!$this->config->item('log_requests', 'api')) {
            return;
        }
        $uri = $_SERVER['REQUEST_URI'];
        $this->api_model->log_request(array(
            'api_key_id' => $this->api_client ? $this->api_client->id : NULL,
            'method' => substr(strtoupper($_SERVER['REQUEST_METHOD']), 0, 10),
            'uri' => substr($uri, 0, 500),
            'ip' => $this->input->ip_address(),
            'status' => $status,
            'duration_ms' => (int) round((microtime(TRUE) - $this->request_started) * 1000),
            'created' => date('Y-m-d H:i:s'),
        ));
    }
}
