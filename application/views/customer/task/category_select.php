<?php
    // Ô chọn Thương hiệu / Hạng mục sửa trên form phiếu. Mục đã ẩn chỉ hiện khi phiếu đang chọn nó.
    $selected = (int) $selected;
?>
<select class="form-control task-category-select" name="<?php echo $selectName; ?>" id="<?php echo $selectName; ?>" data-auto="<?php echo $selected ? 0 : 1; ?>">
    <option value="0">-- Chọn --</option>
    <?php foreach ($items as $item): ?>
        <?php if ($item->active || $item->id == $selected): ?>
        <option value="<?php echo $item->id; ?>" <?php echo $item->id == $selected ? 'selected="selected"' : ''; ?>><?php echo htmlspecialchars($item->name, ENT_QUOTES, 'UTF-8'); ?></option>
        <?php endif; ?>
    <?php endforeach; ?>
</select>
