<?php
    $h = function ($text) { return htmlspecialchars((string) $text, ENT_QUOTES, 'UTF-8'); };
    $doneParts = explode('-', $done);
    $saveUrl = base_url('tasks/saveCategory');
?>
<div id="content" class="categories-page">
    <div class="outer">
        <div class="inner bg-light lter">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box">
                        <header>
                            <div class="icons"><i class="fa fa-tags"></i></div>
                            <h5>Danh mục thống kê</h5>
                        </header>
                        <div class="body">
                            <p class="categories-help">
                                Mỗi phiếu chọn <b>1 thương hiệu</b> và <b>1 hạng mục sửa chính</b>. Form tự chọn sẵn theo <b>từ khoá</b> dưới đây
                                (Thương hiệu đoán từ "Tên thiết bị", Hạng mục đoán từ "Tình trạng"), nhân viên chỉ sửa khi đoán sai.
                                Từ khoá cách nhau dấu phẩy, khớp nguyên từ, không phân biệt hoa thường.
                                Không xoá mục để giữ số liệu cũ, chỉ bỏ tick <b>Hiển thị</b> để ẩn khỏi form.
                            </p>

                            <div class="categories-classify">
                                <?php if (count($doneParts) == 2): ?>
                                    <div class="alert alert-success">Đã phân loại thêm: <b><?php echo (int) $doneParts[0]; ?></b> phiếu có thương hiệu, <b><?php echo (int) $doneParts[1]; ?></b> phiếu có hạng mục.</div>
                                <?php endif; ?>
                                <form method="post" action="<?php echo base_url('tasks/classifyOld'); ?>" onsubmit="this.querySelector('button').disabled = true;">
                                    Phiếu sửa chữa còn trống thương hiệu hoặc hạng mục: <b><?php echo number_format($unclassified); ?></b>
                                    <?php if ($unclassified > 0): ?>
                                    <a class="btn btn-default btn-sm" href="<?php echo base_url('tasks/unclassified'); ?>">Xem danh sách &amp; phân loại tay</a>
                                    <?php endif; ?>
                                    <button type="submit" class="btn btn-primary btn-sm">Tự phân loại các phiếu này theo từ khoá</button>
                                    <span class="categories-note">Chỉ điền vào ô còn trống, không đổi phiếu đã có phân loại. Phiếu không khớp từ khoá nào vẫn để trống ("Chưa phân loại").</span>
                                </form>
                            </div>

                            <div class="row">
                                <?php foreach (array('brand' => array('Thương hiệu', $brands), 'repair' => array('Hạng mục sửa', $repairs)) as $type => $block): list($title, $items) = $block; ?>
                                <div class="col-lg-6" id="<?php echo $type; ?>">
                                    <h4 class="stats-title"><?php echo $title; ?></h4>
                                    <?php
                                        // Mỗi dòng 1 form (form nằm ngoài bảng, ô nhập gắn bằng thuộc tính form="...")
                                        $rows = $items;
                                        $rows[] = null; // dòng thêm mới
                                    ?>
                                    <?php foreach ($rows as $item): $fid = 'catForm-' . $type . '-' . ($item ? $item->id : 'new'); ?>
                                    <form id="<?php echo $fid; ?>" method="post" action="<?php echo $saveUrl; ?>"></form>
                                    <?php endforeach; ?>
                                    <table class="table table-bordered table-condensed table-data categories-table">
                                        <thead>
                                            <tr>
                                                <th>Tên</th>
                                                <th>Từ khoá tự nhận</th>
                                                <th class="num">Thứ tự</th>
                                                <th>Hiển thị</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($rows as $item): $fid = 'catForm-' . $type . '-' . ($item ? $item->id : 'new'); ?>
                                            <tr class="<?php echo !$item ? 'categories-new' : ($item->active ? '' : 'categories-hidden'); ?>">
                                                <td>
                                                    <?php if ($item): ?>
                                                    <input form="<?php echo $fid; ?>" type="hidden" name="id" value="<?php echo $item->id; ?>">
                                                    <?php else: ?>
                                                    <input form="<?php echo $fid; ?>" type="hidden" name="isNew" value="1">
                                                    <?php endif; ?>
                                                    <input form="<?php echo $fid; ?>" type="hidden" name="type" value="<?php echo $type; ?>">
                                                    <input form="<?php echo $fid; ?>" type="text" name="name" class="form-control input-sm" value="<?php echo $item ? $h($item->name) : ''; ?>" placeholder="<?php echo $item ? '' : 'Thêm mới...'; ?>" required maxlength="100">
                                                </td>
                                                <td><textarea form="<?php echo $fid; ?>" name="keywords" class="form-control input-sm" rows="<?php echo $item ? min(5, max(1, (int) ceil(mb_strlen((string) $item->keywords, 'UTF-8') / 42))) : 1; ?>" placeholder="<?php echo $item ? '' : ($type == 'brand' ? 'VD: infinix, tecno' : 'VD: bản lề, sườn'); ?>"><?php echo $item ? $h($item->keywords) : ''; ?></textarea></td>
                                                <td><input form="<?php echo $fid; ?>" type="number" name="sortOrder" class="form-control input-sm" value="<?php echo $item ? (int) $item->sortOrder : 50; ?>"></td>
                                                <td class="center"><input form="<?php echo $fid; ?>" type="checkbox" name="active" value="1" <?php echo (!$item || $item->active) ? 'checked' : ''; ?>></td>
                                                <td><button form="<?php echo $fid; ?>" type="submit" class="btn <?php echo $item ? 'btn-default' : 'btn-primary'; ?> btn-xs"><?php echo $item ? 'Lưu' : 'Thêm'; ?></button></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
