<?php
    /**
     * Danh mục thống kê: Thương hiệu (type = brand) và Hạng mục sửa (type = repair).
     * Mỗi mục có danh sách từ khoá để tự đoán từ "Tên thiết bị" / "Tình trạng".
     * Cách đoán phải giống hệt bản JS trong view customer/task/add.php.
     */
    class Task_category_model extends MY_Model {

        var $primary_table = 'task_categories';
        var $fields = array('id', 'type', 'name', 'keywords', 'sortOrder', 'active');
        var $required_fields = array('type', 'name');

        var $primary_key = 'id';

        private $cache = array();
        private $patterns = array();

        function __construct() {
            parent::__construct();
        }

        public static function types() {
            return array('brand' => 'Thương hiệu', 'repair' => 'Hạng mục sửa');
        }

        /** Danh sách theo loại, theo thứ tự hiển thị */
        public function readByType($type, $activeOnly = false) {
            $key = $type . ($activeOnly ? ':active' : ':all');
            if (!isset($this->cache[$key])) {
                $this->db->select('*');
                $this->db->from($this->primary_table);
                $this->db->where('type', $type);
                if ($activeOnly) {
                    $this->db->where('active', 1);
                }
                $this->db->order_by('sortOrder', 'asc');
                $this->db->order_by('id', 'asc');
                $this->cache[$key] = $this->db->get()->result();
            }
            return $this->cache[$key];
        }

        /** Mảng id => tên (gồm cả mục đã ẩn, để thống kê/phiếu cũ vẫn hiện đúng tên) */
        public function namesByType($type) {
            $names = array();
            foreach ($this->readByType($type) as $row) {
                $names[$row->id] = $row->name;
            }
            return $names;
        }

        public function readById($id) {
            $this->db->select('*');
            $this->db->from($this->primary_table);
            $this->db->where('id', (int) $id);
            return $this->db->get()->row();
        }

        public function save($data) {
            $row = array(
                'type' => $data['type'],
                'name' => $data['name'],
                'keywords' => $data['keywords'],
                'sortOrder' => (int) $data['sortOrder'],
                'active' => $data['active'] ? 1 : 0,
            );
            if (!empty($data['id'])) {
                $this->db->where('id', (int) $data['id']);
                $this->db->update($this->primary_table, $row);
            } else {
                $this->db->insert($this->primary_table, $row);
            }
            $this->cache = array();
            $this->patterns = array();
        }

        /** id hợp lệ (đúng loại) thì giữ, không thì 0 */
        public function validId($type, $id) {
            $id = (int) $id;
            if ($id <= 0) {
                return 0;
            }
            foreach ($this->readByType($type) as $row) {
                if ($row->id == $id) {
                    return $id;
                }
            }
            return 0;
        }

        /** Dữ liệu từ khoá cho JS tự đoán trên form: [{id, keywords: [...]}] */
        public function guessData($type) {
            $result = array();
            foreach ($this->readByType($type, true) as $row) {
                $result[] = array('id' => (int) $row->id, 'keywords' => self::splitKeywords($row->keywords));
            }
            return $result;
        }

        public static function splitKeywords($keywords) {
            $list = array();
            foreach (explode(',', (string) $keywords) as $keyword) {
                $keyword = self::normalize($keyword);
                if ($keyword !== '') {
                    $list[] = $keyword;
                }
            }
            return $list;
        }

        public static function normalize($text) {
            $text = function_exists('mb_strtolower') ? mb_strtolower((string) $text, 'UTF-8') : strtolower((string) $text);
            return trim(preg_replace('/\s+/u', ' ', $text));
        }

        /**
         * Đoán thương hiệu từ tên thiết bị. "Sửa Laptop" (phoneTypeCategory = 1) coi như tên bắt đầu bằng "laptop".
         * Trả về id hoặc 0.
         */
        public function guessBrand($phoneType, $phoneTypeCategory = 0) {
            $text = ($phoneTypeCategory == 1 ? 'laptop ' : '') . $phoneType;
            return $this->guess('brand', $text, false);
        }

        /** Đoán hạng mục từ "Tình trạng", không ra thì thử "Hướng xử lý". Trả về id hoặc 0. */
        public function guessRepair($phoneStatus, $note = '') {
            $id = $this->guess('repair', $phoneStatus, true);
            return $id ? $id : $this->guess('repair', $note, true);
        }

        /**
         * Tìm từ khoá xuất hiện SỚM NHẤT trong chuỗi (khớp nguyên từ; trùng vị trí thì từ khoá dài hơn thắng).
         * $preferAfterVerb: ưu tiên từ khoá đứng ngay sau "thay/sửa/fix…" — VD "Cắm sạc báo 0% (thay pin)" => Pin.
         */
        public function guess($type, $text, $preferAfterVerb) {
            $text = self::normalize($text);
            if ($text === '') {
                return 0;
            }
            $best = null;
            $bestAnchored = null;
            foreach ($this->compiledPatterns($type) as $item) {
                foreach ($item['patterns'] as $pattern) {
                    if (!preg_match_all($pattern['regex'], $text, $matches, PREG_OFFSET_CAPTURE)) {
                        continue;
                    }
                    foreach ($matches[0] as $match) {
                        $candidate = array('id' => $item['id'], 'pos' => $match[1], 'len' => $pattern['len']);
                        if (self::better($candidate, $best)) {
                            $best = $candidate;
                        }
                        if ($preferAfterVerb && preg_match('/(?:^|[^\p{L}\p{N}])(?:thay|sửa|fix|repair|replace)\s+$/u', substr($text, 0, $match[1]))
                            && self::better($candidate, $bestAnchored)) {
                            $bestAnchored = $candidate;
                        }
                    }
                }
            }
            if ($bestAnchored) {
                return $bestAnchored['id'];
            }
            return $best ? $best['id'] : 0;
        }

        private static function better($candidate, $current) {
            if ($current === null) {
                return true;
            }
            if ($candidate['pos'] != $current['pos']) {
                return $candidate['pos'] < $current['pos'];
            }
            return $candidate['len'] > $current['len'];
        }

        private function compiledPatterns($type) {
            if (!isset($this->patterns[$type])) {
                $this->patterns[$type] = array();
                foreach ($this->readByType($type, true) as $row) {
                    $patterns = array();
                    foreach (self::splitKeywords($row->keywords) as $keyword) {
                        $patterns[] = array(
                            // nguyên từ: trước không phải chữ/số, sau không phải chữ (cho phép số: "iphone7", "a52")
                            'regex' => '/(?<![\p{L}\p{N}])' . preg_quote($keyword, '/') . '(?!\p{L})/u',
                            'len' => function_exists('mb_strlen') ? mb_strlen($keyword, 'UTF-8') : strlen($keyword),
                        );
                    }
                    $this->patterns[$type][] = array('id' => (int) $row->id, 'patterns' => $patterns);
                }
            }
            return $this->patterns[$type];
        }
    }
?>
