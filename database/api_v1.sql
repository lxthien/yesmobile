-- API v1 cho bên thứ 3 (chỉ đọc)
-- Chạy 1 lần trên database của website.

CREATE TABLE IF NOT EXISTS `api_keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT 'Tên đối tác',
  `key_hash` char(64) NOT NULL COMMENT 'SHA-256 của API key, không lưu key gốc',
  `allowed_ips` varchar(500) DEFAULT NULL COMMENT 'Danh sách IP cho phép, cách nhau bởi dấu phẩy. Để trống = mọi IP',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `last_used_at` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_key_hash` (`key_hash`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `api_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `api_key_id` int(11) DEFAULT NULL,
  `method` varchar(10) NOT NULL,
  `uri` varchar(500) NOT NULL,
  `ip` varchar(45) NOT NULL,
  `status` smallint(6) NOT NULL,
  `duration_ms` int(11) NOT NULL DEFAULT 0,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_key_created` (`api_key_id`, `created`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Index giúp API tra cứu nhanh (bỏ qua nếu đã có)
ALTER TABLE `customers` ADD INDEX `idx_phone` (`phone`);
ALTER TABLE `tasks` ADD INDEX `idx_customer_id` (`customer_id`);
ALTER TABLE `tasks` ADD INDEX `idx_updated` (`updated`);
ALTER TABLE `tasks_histories` ADD INDEX `idx_task_id` (`task_id`);

-- Cấp key cho đối tác:
-- 1) Sinh key ngẫu nhiên:  php -r "echo bin2hex(random_bytes(32));"
-- 2) Lưu hash của key (key gốc chỉ gửi cho đối tác, không lưu):
--    INSERT INTO api_keys (name, key_hash, allowed_ips, created)
--    VALUES ('Ten doi tac', SHA2('<key vừa sinh>', 256), NULL, NOW());
-- Thu hồi key:  UPDATE api_keys SET is_active = 0 WHERE id = <id>;
