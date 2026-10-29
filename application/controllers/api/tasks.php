<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'core/Api_Controller.php';

/**
 * GET /api/v1/tasks                     Danh sách phiếu (xem bộ lọc trong index())
 * GET /api/v1/tasks/{id}                Chi tiết phiếu
 * GET /api/v1/tasks/code/{code}         Chi tiết phiếu theo mã (VD: YMS0000009)
 * GET /api/v1/tasks/{id}/histories      Lịch sử thay đổi của phiếu
 */
class Tasks extends Api_Controller {

    public function index() {
        list($offset, $limit, $page, $per_page) = $this->pagination();

        $filters = array();

        $customer_id = $this->int_param('customer_id');
        if ($customer_id !== NULL) {
            $filters['customer_id'] = $customer_id;
        }

        $status = $this->str_param('status');
        if ($status !== NULL) {
            if (!in_array($status, array('open', 'closed'), TRUE)) {
                $this->error(400, 'invalid_parameter', 'status phải là open hoặc closed.');
            }
            $filters['status'] = $status;
        }

        $type = $this->int_param('type');
        if ($type !== NULL) {
            if ($type < 1 || $type > 4) {
                $this->error(400, 'invalid_parameter', 'type phải trong khoảng 1-4.');
            }
            $filters['type'] = $type;
        }

        $shop = $this->int_param('shop');
        if ($shop !== NULL) {
            if ($shop !== 1 && $shop !== 2) {
                $this->error(400, 'invalid_parameter', 'shop phải là 1 hoặc 2.');
            }
            $filters['shop'] = $shop;
        }

        foreach (array('imei', 'code') as $name) {
            $value = $this->str_param($name);
            if ($value !== NULL) {
                $filters[$name] = $value;
            }
        }

        $created_from = $this->datetime_param('created_from');
        $created_to = $this->datetime_param('created_to', TRUE);
        $updated_since = $this->datetime_param('updated_since');
        if ($created_from !== NULL) $filters['created_from'] = $created_from;
        if ($created_to !== NULL) $filters['created_to'] = $created_to;
        if ($updated_since !== NULL) $filters['updated_since'] = $updated_since;

        list($rows, $total) = $this->api_model->tasks($filters, $offset, $limit);
        $this->respond($rows, $this->paging_meta($total, $page, $per_page));
    }

    public function show($id = NULL) {
        $task = $this->api_model->task($this->valid_id($id));
        if (!$task) {
            $this->error(404, 'not_found', 'Không tìm thấy phiếu.');
        }
        $this->respond($task);
    }

    public function by_code($code = NULL) {
        $task = $code ? $this->api_model->task_by_code($code) : NULL;
        if (!$task) {
            $this->error(404, 'not_found', 'Không tìm thấy phiếu.');
        }
        $this->respond($task);
    }

    public function histories($id = NULL) {
        $id = $this->valid_id($id);
        if (!$this->api_model->task($id)) {
            $this->error(404, 'not_found', 'Không tìm thấy phiếu.');
        }
        $this->respond($this->api_model->task_histories($id));
    }
}
