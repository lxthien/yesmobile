-- Giá linh kiện (tổng giá LK + phí ship) của phiếu sửa chữa, dùng tính lợi nhuận ở trang Doanh thu theo ngày.
-- Chạy TRƯỚC khi upload code. Thêm cột ở cuối bảng nên chạy ngay, không khoá bảng lâu.
ALTER TABLE `tasks` ADD COLUMN `accessoryPrice` INT NOT NULL DEFAULT 0;
