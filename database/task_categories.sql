-- Thống kê tháng theo Thương hiệu / Hạng mục sửa.
-- Chạy file này trên production TRƯỚC khi upload code.
-- An toàn: chỉ tạo bảng mới + thêm 2 cột vào CUỐI bảng tasks (MariaDB 10.3 thêm tức thì, không khoá bảng lâu).

CREATE TABLE IF NOT EXISTS `task_categories` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(10) NOT NULL COMMENT 'brand = Thương hiệu, repair = Hạng mục sửa',
  `name` VARCHAR(100) NOT NULL,
  `keywords` TEXT NULL COMMENT 'Từ khoá tự nhận, cách nhau dấu phẩy',
  `sortOrder` INT(11) NOT NULL DEFAULT 0,
  `active` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `idx_type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- 0 = chưa phân loại
ALTER TABLE `tasks`
  ADD COLUMN `brandId` INT(11) NOT NULL DEFAULT 0 COMMENT 'task_categories.id (brand)',
  ADD COLUMN `repairCategoryId` INT(11) NOT NULL DEFAULT 0 COMMENT 'task_categories.id (repair)';

-- Danh sách ban đầu (admin sửa/thêm/ẩn được ở trang Danh mục thống kê)
INSERT INTO `task_categories` (`type`, `name`, `keywords`, `sortOrder`) VALUES
('brand', 'Apple',    'iphone, ipad, ipod, airpods, air pods, apple, ip', 1),
('brand', 'Samsung',  'samsung, samssung, sansung, samsungg, samsungtab, sam sung, galaxy, ss', 2),
('brand', 'Oppo',     'oppo, reno', 3),
('brand', 'Xiaomi',   'xiaomi, redmi, poco, pocco, pocophone, mi', 4),
('brand', 'Vivo',     'vivo', 5),
('brand', 'Realme',   'realme, realmi', 6),
('brand', 'Huawei',   'huawei', 7),
('brand', 'Honor',    'honor', 8),
('brand', 'Nokia',    'nokia, lumia', 9),
('brand', 'Sony',     'sony, xperia', 10),
('brand', 'Vsmart',   'vsmart', 11),
('brand', 'Google',   'google, pixel, nexus', 12),
('brand', 'Asus',     'asus, zenfone, rog', 13),
('brand', 'Lenovo',   'lenovo', 14),
('brand', 'HTC',      'htc', 15),
('brand', 'LG',       'lg', 16),
('brand', 'Laptop',   'laptop, macbook, dell, hp, acer, msi, thinkpad', 17),
('brand', 'Khác',     'blackberry, bb, sky, mobell, masstel, motorola, zte, meizu, tecno, techno, itel, nubia, coolpad, wiko, oneplus, philips, mobiistar, fairphone, one plus, phillips, ulephone, obi, mobiado, vertu, black shark, loa, tai nghe, sạc dự phòng, cục phát, bộ sạc, củ sạc, cáp, dây sạc, camera, bàn phím, quạt', 99),

('repair', 'Màn hình',              'màn hình, màn, cảm ứng, sọc, ép cáp, phản quang, lcd, oled, screen, touch, liệt, loạn, hiển thị, đèn', 1),
('repair', 'Ép kính / Thay kính',   'ép kính, thay kính, kính, glass', 2),
('repair', 'Pin',                   'pin, cell, battery, batteries, baterry', 3),
('repair', 'Chân sạc / Cụm sạc',    'sạc, chân sạc, cụm sạc, charg, charge, charging, ic sạc, usb', 4),
('repair', 'Nút bấm',               'nút, phím, phím nguồn, volume, button, power button, home, bàn phím', 5),
('repair', 'Loa / Mic / Âm thanh',  'loa, loa thoại, mic, micro, âm thanh, audio, nghe, tai nghe, chuông, rung', 6),
('repair', 'Camera / Face ID / Vân tay', 'camera, cam, face id, faceid, vân tay, touch id', 7),
('repair', 'Vỏ / Kính lưng',        'vỏ, kính lưng, nắp lưng, nắp sau, nắp, lưng, khung, back, bản lề, sườn', 8),
('repair', 'Nguồn / Main',          'không lên nguồn, nguồn, main, logo, ic, chạm, tụ, sim, sóng, wifi, no power, cpu, imei, baseband, modem, khởi động, tắt, nóng, đơ, lên táo, ổ cứng', 9),
('repair', 'Vào nước',              'nước, vô nước, rớt nước', 10),
('repair', 'Phần mềm / Tài khoản',  'phần mềm, icloud, google, tài khoản, mật khẩu, rom, win, cài, unlock, vô hiệu hóa, frp, reset, chạy chậm, giật, office, treo, bypass, root, recovery, bootloader, itunes, restore, nạp, tiếng việt, dữ liệu, active, kích hoạt, micloud, mở mạng, ứng dụng, account, pm, quảng cáo, windows, danh bạ', 11),
('repair', 'Phụ kiện / Dán màn',    'dán, cường lực, mua, ốp, dây sạc, cáp sạc, bộ sạc', 12),
('repair', 'Khác',                  'bán máy, bán xác, vệ sinh', 99);
