<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'core/Api_Controller.php';

/**
 * GET /api/v1/customers                 Danh sách khách hàng (?q=, ?phone=, ?page=, ?per_page=)
 * GET /api/v1/customers/{id}            Chi tiết khách hàng
 * GET /api/v1/customers/{id}/tasks      Phiếu của khách hàng (?page=, ?per_page=)
 */
class Customers extends Api_Controller {

    public function index() {
        list($offset, $limit, $page, $per_page) = $this->pagination();

        $filters = array(
            'q' => $this->str_param('q'),
            'phone' => $this->str_param('phone'),
        );

        list($rows, $total) = $this->api_model->customers($filters, $offset, $limit);
        $this->respond($rows, $this->paging_meta($total, $page, $per_page));
    }

    public function show($id = NULL) {
        $customer = $this->api_model->customer($this->valid_id($id));
        if (!$customer) {
            $this->error(404, 'not_found', 'Không tìm thấy khách hàng.');
        }
        $this->respond($customer);
    }

    public function tasks($id = NULL) {
        $id = $this->valid_id($id);
        if (!$this->api_model->customer($id)) {
            $this->error(404, 'not_found', 'Không tìm thấy khách hàng.');
        }

        list($offset, $limit, $page, $per_page) = $this->pagination();
        list($rows, $total) = $this->api_model->tasks(array('customer_id' => $id), $offset, $limit);
        $this->respond($rows, $this->paging_meta($total, $page, $per_page));
    }
}
