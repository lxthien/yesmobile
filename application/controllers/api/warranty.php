<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'core/Api_Controller.php';

/**
 * GET /api/v1/warranty?phone=0988071819
 * GET /api/v1/warranty?imei=123456
 * GET /api/v1/warranty?code=YMS0000009
 *
 * Tra cứu bảo hành, cùng logic với trang "thong-tin-bao-hanh" (welcome/searchHistory):
 * phiếu đã trả máy (taskStatus = 1) thì bảo hành đến ngày warrantyPeriod.
 */
class Warranty extends Api_Controller {

    public function index() {
        $phone = $this->str_param('phone');
        $imei = $this->str_param('imei');
        $code = $this->str_param('code');

        $given = ($phone !== NULL) + ($imei !== NULL) + ($code !== NULL);
        if ($given !== 1) {
            $this->error(400, 'invalid_parameter', 'Gửi đúng 1 trong các tham số: phone, imei, code.');
        }

        $customer = NULL;
        if ($phone !== NULL) {
            $customer = $this->api_model->customer_by_phone($phone);
            $tasks = $customer ? $this->api_model->tasks_of_customer($customer['id']) : array();
        } elseif ($imei !== NULL) {
            $tasks = $this->api_model->tasks_by_imei($imei);
        } else {
            $task = $this->api_model->task_by_code($code);
            $tasks = $task ? array($task) : array();
        }

        if ($customer === NULL && count($tasks) > 0) {
            $customer = $this->api_model->customer($tasks[0]['customer_id']);
        }

        $now = date('Y-m-d H:i:s');
        $items = array();
        foreach ($tasks as $task) {
            $until = $task['warranty_until'];
            $items[] = array(
                'task_id' => $task['id'],
                'code' => $task['code'],
                'type' => $task['type'],
                'type_label' => $task['type_label'],
                'device' => $task['device']['name'],
                'imei' => $task['device']['imei'],
                'issue' => $task['issue'],
                'received_at' => $task['created_at'],
                'status' => $task['status'],
                'warranty_days' => $task['warranty_days'],
                'warranty_until' => $until,
                'in_warranty' => $until !== NULL && $until >= $now,
            );
        }

        $this->respond(array(
            'found' => count($items) > 0,
            'customer' => $customer ? array('name' => $customer['name'], 'phone' => $customer['phone']) : NULL,
            'items' => $items,
        ));
    }
}
