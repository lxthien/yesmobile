<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Truy vấn dữ liệu cho API v1.
 *
 * Chỉ SELECT các cột được phép công khai. Các cột nhạy cảm như
 * phonePass (mật khẩu máy), notePrivate/note (ghi chú nội bộ),
 * createdBy/updatedBy không bao giờ được đọc ra ở đây.
 */
class Api_model extends CI_Model {

    private $customer_columns = 'id, name, phone, shop, created, updated';

    private $task_columns = 'id, code, taskType, phoneTypeCategory, customer_id, phoneType, phoneImei, phoneSim, features, phoneStatus, phonePrice, useAccessories, technicalFinish, notificationCustomer, timeNotificationCustomer, taskStatus, timeClosedTask, timeWarranty, warrantyPeriod, warrantyPeriodEnd, shop, created, updated';

    /** Các khoá trong tasks_histories.tracks được phép trả ra */
    private $history_public_fields = array(
        'taskType', 'phoneType', 'phoneImei', 'phoneStatus', 'phoneSim', 'phonePrice',
        'useAccessories', 'technicalFinish', 'notificationCustomer', 'taskStatus', 'timeWarranty',
    );

    private $task_types = array(1 => 'Sửa phần cứng', 2 => 'Sửa lấy ngay', 3 => 'Sửa phần mềm', 4 => 'Bán phụ kiện');
    private $categories = array(0 => 'Điện thoại', 1 => 'Laptop', 2 => 'Mua xác');
    private $technical_statuses = array(0 => 'Chưa sửa xong', 1 => 'Đã sửa xong', 2 => 'Không sửa được', 3 => 'Tư vấn không sửa', 4 => 'Không có linh kiện', 5 => 'Khách đổi ý, không sửa', 6 => 'Sửa hỗ trợ, không tính phí', 7 => 'Bảo hành, không mất phí');
    private $accessory_statuses = array(0 => 'Không', 1 => 'Có', 2 => 'Đã đặt hàng');

    function __construct() {
        parent::__construct();
    }

    // ------------------------------------------------------------------
    // API key & log
    // ------------------------------------------------------------------

    public function find_active_key($key_hash) {
        $query = $this->db->select('id, name, allowed_ips')
            ->from('api_keys')
            ->where('key_hash', $key_hash)
            ->where('is_active', 1)
            ->limit(1)
            ->get();
        return $query ? $query->row() : NULL;
    }

    public function touch_key($id) {
        $this->db->where('id', $id)->update('api_keys', array('last_used_at' => date('Y-m-d H:i:s')));
    }

    public function count_recent_requests($key_id, $seconds) {
        return $this->db->from('api_logs')
            ->where('api_key_id', $key_id)
            ->where('created >=', date('Y-m-d H:i:s', time() - $seconds))
            ->count_all_results();
    }

    public function log_request($row) {
        $this->db->insert('api_logs', $row);
    }

    // ------------------------------------------------------------------
    // Khách hàng
    // ------------------------------------------------------------------

    /** $filters: q (tên/SĐT chứa), phone (chính xác) */
    public function customers($filters, $offset, $limit) {
        $this->apply_customer_filters($filters);
        $total = $this->db->count_all_results();

        $this->db->select($this->customer_columns);
        $this->apply_customer_filters($filters);
        $rows = $this->db->order_by('id', 'desc')->limit($limit, $offset)->get()->result();

        return array(array_map(array($this, 'format_customer'), $rows), $total);
    }

    private function apply_customer_filters($filters) {
        $this->db->from('customers');
        if (!empty($filters['phone'])) {
            $this->db->where('phone', $filters['phone']);
        }
        if (!empty($filters['q'])) {
            // CI 2 không có group_start(), tự bọc điều kiện OR trong ngoặc
            $like = $this->db->escape_like_str($filters['q']);
            $this->db->where("(name LIKE '%{$like}%' OR phone LIKE '%{$like}%')", NULL, FALSE);
        }
    }

    public function customer($id) {
        $row = $this->db->select($this->customer_columns)->from('customers')
            ->where('id', $id)->limit(1)->get()->row();
        return $row ? $this->format_customer($row) : NULL;
    }

    public function customer_by_phone($phone) {
        $row = $this->db->select($this->customer_columns)->from('customers')
            ->where('phone', $phone)->order_by('id', 'asc')->limit(1)->get()->row();
        return $row ? $this->format_customer($row) : NULL;
    }

    public function format_customer($row) {
        return array(
            'id' => (int) $row->id,
            'name' => $row->name,
            'phone' => $row->phone,
            'shop' => $this->shop_number($row->shop),
            'created_at' => $this->datetime($row->created),
            'updated_at' => $this->datetime($row->updated),
        );
    }

    // ------------------------------------------------------------------
    // Phiếu sửa chữa
    // ------------------------------------------------------------------

    /**
     * $filters: customer_id, status (open|closed), type (1-4), shop (1|2),
     *           imei, code, created_from, created_to, updated_since
     */
    public function tasks($filters, $offset, $limit) {
        $this->apply_task_filters($filters);
        $total = $this->db->count_all_results();

        $this->db->select($this->task_columns);
        $this->apply_task_filters($filters);
        $rows = $this->db->order_by('id', 'desc')->limit($limit, $offset)->get()->result();

        return array(array_map(array($this, 'format_task'), $rows), $total);
    }

    private function apply_task_filters($f) {
        $this->db->from('tasks');
        if (isset($f['customer_id'])) {
            $this->db->where('customer_id', $f['customer_id']);
        }
        if (isset($f['status'])) {
            $this->db->where('taskStatus', $f['status'] === 'closed' ? 1 : 0);
        }
        if (isset($f['type'])) {
            $this->db->where('taskType', $f['type']);
        }
        if (isset($f['shop'])) {
            // shop 0 là dữ liệu cũ, thuộc cửa hàng 1 (giống task_model)
            if ($f['shop'] == 1) {
                $this->db->where_in('shop', array(0, 1));
            } else {
                $this->db->where('shop', 2);
            }
        }
        if (isset($f['imei'])) {
            $this->db->where('phoneImei', $f['imei']);
        }
        if (isset($f['code'])) {
            $this->db->where('code', $f['code']);
        }
        if (isset($f['created_from'])) {
            $this->db->where('created >=', $f['created_from']);
        }
        if (isset($f['created_to'])) {
            $this->db->where('created <=', $f['created_to']);
        }
        if (isset($f['updated_since'])) {
            $this->db->where('updated >=', $f['updated_since']);
        }
    }

    public function task($id) {
        $row = $this->db->select($this->task_columns)->from('tasks')
            ->where('id', $id)->limit(1)->get()->row();
        return $row ? $this->format_task($row) : NULL;
    }

    public function task_by_code($code) {
        $row = $this->db->select($this->task_columns)->from('tasks')
            ->where('code', $code)->limit(1)->get()->row();
        return $row ? $this->format_task($row) : NULL;
    }

    /** Tất cả phiếu của 1 khách, mới nhất trước (dùng cho tra cứu bảo hành) */
    public function tasks_of_customer($customer_id) {
        $rows = $this->db->select($this->task_columns)->from('tasks')
            ->where('customer_id', $customer_id)->order_by('created', 'desc')->get()->result();
        return array_map(array($this, 'format_task'), $rows);
    }

    /** Phiếu theo IMEI/Serial, mới nhất trước */
    public function tasks_by_imei($imei) {
        $rows = $this->db->select($this->task_columns)->from('tasks')
            ->where('phoneImei', $imei)->order_by('created', 'desc')->get()->result();
        return array_map(array($this, 'format_task'), $rows);
    }

    public function format_task($row) {
        $type = (int) $row->taskType;
        $category = (int) $row->phoneTypeCategory;
        $technical = (int) $row->technicalFinish;
        $accessory = (int) $row->useAccessories;
        $closed = ((int) $row->taskStatus) === 1;

        return array(
            'id' => (int) $row->id,
            'code' => $row->code,
            'customer_id' => (int) $row->customer_id,
            'type' => $type,
            'type_label' => isset($this->task_types[$type]) ? $this->task_types[$type] : NULL,
            'category' => $category,
            'category_label' => isset($this->categories[$category]) ? $this->categories[$category] : NULL,
            'device' => array(
                'name' => $row->phoneType,
                'imei' => $row->phoneImei,
                'accessories' => $row->phoneSim,
                'features' => $row->features,
            ),
            'issue' => $row->phoneStatus,
            'price' => $row->phonePrice,
            'parts_ordered' => $accessory,
            'parts_ordered_label' => isset($this->accessory_statuses[$accessory]) ? $this->accessory_statuses[$accessory] : NULL,
            'technical_status' => $technical,
            'technical_status_label' => isset($this->technical_statuses[$technical]) ? $this->technical_statuses[$technical] : NULL,
            'customer_notified' => ((int) $row->notificationCustomer) === 1,
            'customer_notified_at' => ((int) $row->notificationCustomer) === 1 ? $this->datetime($row->timeNotificationCustomer) : NULL,
            'appointment_at' => $this->datetime($row->warrantyPeriodEnd),
            'status' => $closed ? 'closed' : 'open',
            'closed_at' => $closed ? $this->datetime($row->timeClosedTask) : NULL,
            'warranty_days' => (int) $row->timeWarranty,
            'warranty_until' => $closed ? $this->datetime($row->warrantyPeriod) : NULL,
            'shop' => $this->shop_number($row->shop),
            'created_at' => $this->datetime($row->created),
            'updated_at' => $this->datetime($row->updated),
        );
    }

    // ------------------------------------------------------------------
    // Lịch sử phiếu
    // ------------------------------------------------------------------

    public function task_histories($task_id) {
        $rows = $this->db->select('id, task_id, tracks, created')->from('tasks_histories')
            ->where('task_id', $task_id)->order_by('created', 'desc')->get()->result();

        $result = array();
        foreach ($rows as $row) {
            $changes = array();
            $tracks = json_decode($row->tracks, TRUE);
            if (is_array($tracks)) {
                foreach ($tracks as $field => $change) {
                    if (in_array($field, $this->history_public_fields, TRUE) && is_array($change)) {
                        $changes[$field] = array(
                            'from' => isset($change['from']) ? $change['from'] : NULL,
                            'to' => isset($change['to']) ? $change['to'] : NULL,
                        );
                    }
                }
            }
            // Bỏ các lần lưu chỉ đổi trường nội bộ (mật khẩu, ghi chú)
            if (count($changes) === 0) {
                continue;
            }
            $result[] = array(
                'id' => (int) $row->id,
                'task_id' => (int) $row->task_id,
                'changes' => $changes,
                'created_at' => $this->datetime($row->created),
            );
        }
        return $result;
    }

    // ------------------------------------------------------------------
    // Tiện ích
    // ------------------------------------------------------------------

    /** shop 0 (dữ liệu cũ) được tính là cửa hàng 1 */
    private function shop_number($shop) {
        return ((int) $shop) === 2 ? 2 : 1;
    }

    private function datetime($value) {
        if ($value === NULL || $value === '' || strpos($value, '0000-00-00') === 0) {
            return NULL;
        }
        return $value;
    }
}
