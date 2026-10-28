<?php
    /**
     * Ô chọn Thương hiệu / Hạng mục lưu ngay (AJAX tasks/setCategory), chỉ đổi phân loại, không đụng dữ liệu khác của phiếu.
     * Dùng ở trang Phân loại tay và danh sách phiếu của trang Thống kê.
     * Ô chọn: <select class="uc-select" data-id="..." data-column="brandId|repairCategoryId">, trạng thái hiện ở ô .uc-status cùng dòng.
     */
?>
<script>
(function () {
    var url = '<?php echo base_url('tasks/setCategory'); ?>';
    document.querySelectorAll('.uc-select').forEach(function (select) {
        select.addEventListener('change', function () {
            var row = select.closest('tr');
            var status = row.querySelector('.uc-status');
            status.className = 'uc-status';
            status.textContent = 'Đang lưu…';
            var body = 'id=' + encodeURIComponent(select.getAttribute('data-id'))
                + '&column=' + encodeURIComponent(select.getAttribute('data-column'))
                + '&value=' + encodeURIComponent(select.value);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', url);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                var ok = false;
                try { ok = xhr.status === 200 && JSON.parse(xhr.responseText).ok; } catch (e) {}
                status.className = 'uc-status ' + (ok ? 'uc-ok' : 'uc-fail');
                status.textContent = ok ? 'Đã lưu ✓' : 'Lỗi, chưa lưu';
                select.classList.toggle('uc-empty', select.value === '0');
                var done = [].every.call(row.querySelectorAll('.uc-select'), function (s) { return s.value !== '0'; });
                row.classList.toggle('uc-done', ok && done);
            };
            xhr.onerror = function () {
                status.className = 'uc-status uc-fail';
                status.textContent = 'Lỗi mạng, chưa lưu';
            };
            xhr.send(body);
        });
    });
})();
</script>
