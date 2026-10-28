<?php
    $h = function ($text) { return htmlspecialchars((string) $text, ENT_QUOTES, 'UTF-8'); };
    // Link giữ tháng + cửa hàng đang xem
    $statsUrl = function ($params = array()) use ($month, $shop) {
        $query = array_merge(array('month' => $month, 'shop' => $shop), $params);
        $query = array_filter($query, function ($v) { return $v !== '' && $v !== null; });
        return base_url('tasks/statistics') . '?' . http_build_query($query);
    };
    $money = function ($value) { return number_format((float) $value); };
    $percent = function ($value, $total) { return $total > 0 ? round($value * 100 / $total, 1) . '%' : '-'; };
    $shops = array('' => 'Tất cả cửa hàng', 1 => 'Vũng Tàu', 2 => 'Long Sơn');
    $monthLabel = substr($month, 5, 2) . '/' . substr($month, 0, 4);
    // Ô chọn phân loại lưu ngay (giống trang Phân loại tay)
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
<div id="content" class="statistics-page">
    <div class="outer">
        <div class="inner bg-light lter">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box">
                        <header>
                            <div class="icons"><i class="fa fa-bar-chart-o"></i></div>
                            <h5>Thống kê tháng <?php echo $monthLabel; ?> · <?php echo $shops[$shop]; ?></h5>
                        </header>
                        <div class="body">
                            <form class="stats-filter" method="get" action="<?php echo base_url('tasks/statistics'); ?>">
                                <a class="btn btn-default btn-sm" href="<?php echo $statsUrl(array('month' => $prevMonth)); ?>">&laquo; Tháng trước</a>
                                <input type="month" name="month" class="form-control input-sm" value="<?php echo $month; ?>">
                                <select name="shop" class="form-control input-sm">
                                    <?php foreach ($shops as $value => $label): ?>
                                    <option value="<?php echo $value; ?>" <?php echo (string) $value === (string) $shop ? 'selected' : ''; ?>><?php echo $label; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm">Xem</button>
                                <a class="btn btn-default btn-sm" href="<?php echo $statsUrl(array('month' => $nextMonth)); ?>">Tháng sau &raquo;</a>
                                <span class="stats-note">Tính theo ngày giao máy, giống trang Doanh thu theo ngày.</span>
                            </form>

                            <div class="stats-summary">
                                <div class="stats-card"><span>Máy đã giao</span><b><?php echo $money($summary['total']); ?></b></div>
                                <div class="stats-card"><span>Doanh thu</span><b><?php echo $money($summary['revenue']); ?></b></div>
                                <div class="stats-card"><span>Không sửa / Khách đổi ý</span><b><?php echo $money($summary['noRepair']); ?></b></div>
                                <?php
                                    $unBrand = isset($byBrand[0]) ? $byBrand[0]['total'] : 0;
                                    $unRepair = isset($byRepair[0]) ? $byRepair[0]['total'] : 0;
                                ?>
                                <div class="stats-card<?php echo ($unBrand || $unRepair) ? ' stats-card-warn' : ''; ?>">
                                    <span>Chưa phân loại (thương hiệu / hạng mục)</span>
                                    <b><?php echo $unBrand . ' / ' . $unRepair; ?></b>
                                    <a class="stats-card-link" href="<?php echo base_url('tasks/unclassified'); ?>">Phân loại tay &raquo;</a>
                                </div>
                            </div>

                            <?php if ($summary['total'] == 0): ?>
                                <p class="center stats-empty">Không có máy nào giao trong tháng <?php echo $monthLabel; ?>.</p>
                            <?php else: ?>
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4 class="stats-title">Theo tình trạng kỹ thuật</h4>
                                    <table class="table table-bordered table-condensed table-striped table-hover table-data stats-table">
                                        <thead>
                                            <tr>
                                                <th>Tình trạng kỹ thuật</th>
                                                <th class="num">Số máy</th>
                                                <th class="num">% số máy</th>
                                                <th class="num">Doanh thu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($byTechnical as $t => $row): ?>
                                            <tr class="<?php echo ($detailTechnical === $t) ? 'stats-active' : ''; ?>">
                                                <td><a href="<?php echo $statsUrl(array('tech' => $t)); ?>#chi-tiet"><?php echo $h(isset($technicalNames[$t]) ? $technicalNames[$t] : 'Khác (' . $t . ')'); ?></a></td>
                                                <td class="num"><b><?php echo $money($row['total']); ?></b></td>
                                                <td class="num"><?php echo $percent($row['total'], $summary['total']); ?></td>
                                                <td class="num"><?php echo $money($row['revenue']); ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                            <tr class="stats-total">
                                                <td>Tổng</td>
                                                <td class="num"><?php echo $money($summary['total']); ?></td>
                                                <td class="num">100%</td>
                                                <td class="num"><?php echo $money($summary['revenue']); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <?php foreach (array(
                                    array('Theo hạng mục sửa', 'Hạng mục', $byRepair, $repairNames, 'cat'),
                                    array('Theo thương hiệu', 'Thương hiệu', $byBrand, $brandNames, 'brand'),
                                ) as $block): list($title, $column, $list, $names, $param) = $block; ?>
                                <div class="col-lg-6">
                                    <h4 class="stats-title"><?php echo $title; ?></h4>
                                    <table class="table table-bordered table-condensed table-striped table-hover table-data stats-table">
                                        <thead>
                                            <tr>
                                                <th><?php echo $column; ?></th>
                                                <th class="num">Số máy</th>
                                                <th class="num">Doanh thu</th>
                                                <th class="num">% doanh thu</th>
                                                <th class="num">Không sửa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($list as $id => $row): ?>
                                            <tr class="<?php echo $id == 0 ? 'stats-unclassified' : ''; ?>">
                                                <td><a href="<?php echo $statsUrl(array($param => $id)); ?>#chi-tiet"><?php echo $h($names[$id]); ?></a></td>
                                                <td class="num"><b><?php echo $money($row['total']); ?></b></td>
                                                <td class="num"><?php echo $money($row['revenue']); ?></td>
                                                <td class="num"><?php echo $percent($row['revenue'], $summary['revenue']); ?></td>
                                                <td class="num"><?php echo $row['noRepair'] ? $money($row['noRepair']) : ''; ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                            <tr class="stats-total">
                                                <td>Tổng</td>
                                                <td class="num"><?php echo $money($summary['total']); ?></td>
                                                <td class="num"><?php echo $money($summary['revenue']); ?></td>
                                                <td class="num">100%</td>
                                                <td class="num"><?php echo $money($summary['noRepair']); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <?php endforeach; ?>
                            </div>

                            <h4 class="stats-title">Thương hiệu × Hạng mục <small>(số máy, dòng dưới là doanh thu; bấm vào số để xem danh sách phiếu)</small></h4>
                            <div class="table-responsive">
                                <table class="table table-bordered table-condensed table-data stats-matrix">
                                    <thead>
                                        <tr>
                                            <th>Thương hiệu</th>
                                            <?php foreach ($byRepair as $repairId => $repairRow): ?>
                                            <th class="num"><?php echo $h($repairNames[$repairId]); ?></th>
                                            <?php endforeach; ?>
                                            <th class="num">Tổng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($byBrand as $brandId => $brandRow): ?>
                                        <tr>
                                            <td class="stats-row-name"><?php echo $h($brandNames[$brandId]); ?></td>
                                            <?php foreach ($byRepair as $repairId => $repairRow): ?>
                                                <?php $cell = isset($matrix[$brandId][$repairId]) ? $matrix[$brandId][$repairId] : null; ?>
                                                <td class="num<?php echo ($detailBrand === $brandId && $detailRepair === $repairId) ? ' stats-active' : ''; ?>">
                                                    <?php if ($cell): ?>
                                                        <a href="<?php echo $statsUrl(array('brand' => $brandId, 'cat' => $repairId)); ?>#chi-tiet"><b><?php echo $money($cell['total']); ?></b></a>
                                                        <small><?php echo $money($cell['revenue']); ?></small>
                                                    <?php endif; ?>
                                                </td>
                                            <?php endforeach; ?>
                                            <td class="num stats-total">
                                                <a href="<?php echo $statsUrl(array('brand' => $brandId)); ?>#chi-tiet"><b><?php echo $money($brandRow['total']); ?></b></a>
                                                <small><?php echo $money($brandRow['revenue']); ?></small>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <tr class="stats-total">
                                            <td>Tổng</td>
                                            <?php foreach ($byRepair as $repairId => $repairRow): ?>
                                            <td class="num">
                                                <a href="<?php echo $statsUrl(array('cat' => $repairId)); ?>#chi-tiet"><b><?php echo $money($repairRow['total']); ?></b></a>
                                                <small><?php echo $money($repairRow['revenue']); ?></small>
                                            </td>
                                            <?php endforeach; ?>
                                            <td class="num"><b><?php echo $money($summary['total']); ?></b><small><?php echo $money($summary['revenue']); ?></small></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <?php endif; ?>

                            <?php if ($detailTasks !== null): ?>
                            <h4 class="stats-title" id="chi-tiet">
                                Danh sách phiếu:
                                <?php
                                    $parts = array();
                                    if ($detailBrand !== null) $parts[] = $h(isset($brandNames[$detailBrand]) ? $brandNames[$detailBrand] : '?');
                                    if ($detailRepair !== null) $parts[] = $h(isset($repairNames[$detailRepair]) ? $repairNames[$detailRepair] : '?');
                                    if ($detailTechnical !== null) $parts[] = $h(isset($technicalNames[$detailTechnical]) ? $technicalNames[$detailTechnical] : '?');
                                    echo implode(' · ', $parts) . ' (' . count($detailTasks) . ' máy)';
                                ?>
                                <a class="stats-close" href="<?php echo $statsUrl(); ?>">Đóng</a>
                            </h4>
                            <p class="categories-note">Chọn lại Thương hiệu / Hạng mục ở 2 cột dưới là <b>lưu ngay</b>, chỉ đổi phân loại, không đổi ngày giao máy hay thông tin khác của phiếu. Bảng số liệu phía trên cập nhật khi tải lại trang.</p>
                            <table class="table table-bordered table-condensed table-striped table-hover table-data stats-detail-table">
                                <thead>
                                    <tr>
                                        <th>Ngày giao</th>
                                        <th>Mã số</th>
                                        <th>Tên thiết bị</th>
                                        <th>Tình trạng</th>
                                        <th>Thương hiệu</th>
                                        <th>Hạng mục</th>
                                        <th>Báo giá</th>
                                        <th>Cửa hàng</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($detailTasks as $row): ?>
                                    <tr>
                                        <td><?php echo date('d/m/Y', strtotime($row->timeClosedTask)); ?></td>
                                        <td><?php echo $h('...' . substr($row->code, strlen($row->code) - 5)); ?></td>
                                        <td><?php echo $h($row->phoneType); ?></td>
                                        <td><?php echo $h($row->phoneStatus); ?></td>
                                        <td><?php echo $select('brandId', $brands, $row->brandId, $row->id); ?></td>
                                        <td><?php echo $select('repairCategoryId', $repairs, $row->repairCategoryId, $row->id); ?></td>
                                        <td><?php echo taskNoRepairLabel($row->technicalFinish) != '' ? '<span style="color:red;">' . taskNoRepairLabel($row->technicalFinish) . '</span>' : (is_numeric($row->phonePrice) ? number_format($row->phonePrice) : $h($row->phonePrice)); ?></td>
                                        <td><?php echo $row->shop == 2 ? 'Long Sơn' : 'Vũng Tàu'; ?></td>
                                        <td><a href="<?php echo base_url('tasks/edit/' . $row->id); ?>" target="_blank">Sửa phiếu</a> <span class="uc-status"></span></td>
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
<?php $this->load->view('customer/task/category_inline'); ?>
