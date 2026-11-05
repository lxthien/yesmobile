-- Phiếu nhấp nháy ở trang Máy đang sửa chữa khi người khác vừa thay đổi mà mình chưa mở xem.
-- Chạy file này TRƯỚC khi upload code (code tự bỏ qua chức năng nếu chưa có bảng).

-- Mỗi tài khoản đã mở xem phiếu nào, lúc nào (giờ UTC, giống tasks_histories.created)
CREATE TABLE IF NOT EXISTS `task_views` (
  `user_id` INT(11) NOT NULL,
  `task_id` INT(11) NOT NULL,
  `seen_at` DATETIME NOT NULL,
  PRIMARY KEY (`user_id`, `task_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dòng mốc (user 0, phiếu 0): chỉ tính các thay đổi SAU thời điểm chạy file này,
-- để lúc mới triển khai không phải phiếu cũ nào cũng nhấp nháy.
INSERT IGNORE INTO `task_views` (`user_id`, `task_id`, `seen_at`) VALUES (0, 0, UTC_TIMESTAMP());

-- Tìm lịch sử theo phiếu cho nhanh (bảng tasks_histories hiện chỉ có khoá chính)
ALTER TABLE `tasks_histories` ADD INDEX `idx_task_id` (`task_id`);
