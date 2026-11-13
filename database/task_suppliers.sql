-- Nhà cung cấp linh kiện (dùng chung bảng task_categories, type = 'supplier').
-- Không bắt buộc chạy: lần đầu mở form phiếu / trang Danh mục thống kê, code tự thêm danh sách này nếu chưa có nhà cung cấp nào.
-- Phiếu vẫn lưu TÊN nhà cung cấp vào cột tasks.manufactory như cũ (phiếu cũ nhập tay vẫn thống kê được, không khớp thì tính vào "Khác").

INSERT INTO `task_categories` (`type`, `name`, `keywords`, `sortOrder`)
SELECT * FROM (
    SELECT 'supplier' AS t, 'Envy' AS n, 'envy' AS k, 1 AS s UNION ALL
    SELECT 'supplier', '555', '555, kho (555)', 2 UNION ALL
    SELECT 'supplier', 'Thành Tuyên', 'thành tuyên', 3 UNION ALL
    SELECT 'supplier', 'Mr Tư', 'mr tư, a tư, anh tư', 4 UNION ALL
    SELECT 'supplier', 'Văn Hiến', 'văn hiến', 5 UNION ALL
    SELECT 'supplier', 'Mr Đức', 'mr đức', 6 UNION ALL
    SELECT 'supplier', 'Mr Thanh', 'mr thanh', 7 UNION ALL
    SELECT 'supplier', 'TT Samsung', 'tt samsung', 8 UNION ALL
    SELECT 'supplier', 'Khác', '', 99
) AS d
WHERE NOT EXISTS (SELECT 1 FROM `task_categories` WHERE `type` = 'supplier');

