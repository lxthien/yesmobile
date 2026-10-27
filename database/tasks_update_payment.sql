-- Trang nhập/sửa phiếu: mục "Cập nhật", các ô Chờ khách báo lại/Gọi 2 lần, hình thức thanh toán khi giao máy.
-- PHẢI chạy file này trên database production TRƯỚC khi upload code mới, nếu không lưu phiếu sẽ lỗi.

-- Bảng tasks mặc định là latin1, nên cột chữ phải khai báo utf8 giống các cột cũ (nếu không tiếng Việt bị lỗi).
ALTER TABLE `tasks`
  ADD COLUMN `updateNote` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT 'Muc Cap nhat (noi dung tu nhap)' AFTER `phoneStatus`,
  ADD COLUMN `updateFlags` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT 'O tick cua muc Cap nhat: cho_bao_lai,goi_kbm,goi_klld' AFTER `updateNote`,
  ADD COLUMN `paymentMethod` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT 'Thanh toan khi giao may: chuyen_khoan|tien_mat' AFTER `timeWarranty`;

-- Giá trị mới của tasks.technicalFinish (không cần đổi cấu trúc bảng):
--   4 = Không có linh kiện, 5 = Khách đổi ý, không sửa
