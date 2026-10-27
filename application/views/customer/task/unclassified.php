<?php
    $h = function ($text) { return htmlspecialchars((string) $text, ENT_QUOTES, 'UTF-8'); };
    $filters = array('' => 'Tất cả', 'brand' => 'Thiếu thương hiệu', 'repair' => 'Thiếu hạng mục');
    $select = function ($column, $items, $selected, $taskId) use ($h) {
        $html = '<select class="form-control input-sm uc-select' . ($selected ? '' : ' uc-empty') . '" data-id="' . (int) $taskId . '" data-column="' . $column . '">';
        $html .= '<option value="0">-- Chọn --</option>';
        foreach ($items as $item) {
            if (!$item->active && $item->id != $selected) continue; // mục đã ẩn chỉ hiện khi phiếu đang chọn nó
            $html .= '<option value="' . $item->id . '"' . ($item->id == $selected ? ' selected' : '') . '>' . $h($item->name) . '</option>';
        }
        return $html . '</select>';
    };
?>
<div id="content" class="categories-page unclassified-page">
    <div class="outer">
        <div class="inner bg-light lter">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box">
                        <header>
                            <div class="icons"><i class="fa fa-tags"></i></div>
                            <h5>Phiếu chưa phân loại (<?php echo count($tasks); ?>)</h5>
                        </header>
                        <div class="body">
                            <div class="uc-toolbar">
                                <a href="<?php echo base_url('tasks/categories'); ?>">&laquo; Danh mục thống kê</a>
                                <span class="uc-filters">
                                    <?php foreach ($filters as $value => $label): ?>
                                        <a class="btn btn-sm <?php echo $missing === $value ? 'btn-primary' : 'btn-default'; ?>" href="<?php echo base_url('tasks/unclassified') . ($value ? '?missing=' . $value : ''); ?>"><?php echo $label; ?></a>
                                    <?php endforeach; ?>
                                </span>
                                <span class="categories-note">Chọn ở 2 cột bên phải là <b>lưu ngay</b>. Phiếu đã đủ 2 ô sẽ không còn trong danh sách khi tải lại trang.</span>
                            </div>
                            <?php if (count($tasks) == 0): ?>
                                <p class="center" style="margin: 20px 0;">Không còn phiếu nào chưa phân loại.</p>
                            <?php else: ?>
                            <table class="table table-bordered table-condensed table-striped table-data uc-table">
                                <thead>
                                    <tr>
                                        <th>Mã số</th>
                                        <th>Ngày nhận</th>
                                        <th>Tên thiết bị</th>
                                        <th>Tình trạng</th>
                                        <th>Hướng xử lý</th>
                                        <th>Thương hiệu</th>
                                        <th>Hạng mục sửa</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tasks as $row): ?>
                                    <tr>
                                        <td><a href="<?php echo base_url('tasks/edit/' . $row->id); ?>" target="_blank" title="Mở phiếu"><?php echo $h($row->code); ?></a></td>
                                        <td><?php echo $row->created ? date('d/m/Y', strtotime($row->created)) : ''; ?></td>
                                        <td><?php echo $row->phoneType !== '' ? $h($row->phoneType) : '<i class="uc-blank">(trống)</i>'; ?></td>
                                        <td><?php echo trim($row->phoneStatus) !== '' ? $h($row->phoneStatus) : '<i class="uc-blank">(trống)</i>'; ?></td>
                                        <td class="uc-note"><?php echo $h(mb_strimwidth((string) $row->note, 0, 80, '…', 'UTF-8')); ?></td>
                                        <td><?php echo $select('brandId', $brands, $row->brandId, $row->id); ?></td>
                                        <td><?php echo $select('repairCategoryId', $repairs, $row->repairCategoryId, $row->id); ?></td>
                                        <td class="uc-status"></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
