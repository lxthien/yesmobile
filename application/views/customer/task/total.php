<div id="content" class="revenue-page">
    <div class="outer">
        <div class="inner bg-light lter">
            <!--Begin Datatables-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="box">
                        <header>
                            <div class="icons"><i class="fa fa-table"></i></div>
                            <h5>Doanh thu theo ngày</h5>
                        </header>
                        <div id="collapse4" class="body">
                            <?php if(count($tasks) > 0) : ?>
                                <table class="table table-bordered table-condensed table-hover table-striped">
                                    <tbody>
                                        <tr>
                                            <td><label class="control-label col-lg-4">Chọn ngày:</label></td>
                                            <td>
                                                <div class="col-lg-3 input-group input-append date" id="dpTotal" data-date="<?php echo $timeSearch != '' ? $timeSearch :  date('Y-m-d', time()) ?>" data-date-format="yyyy-mm-dd">
                                                    <input class="form-control" type="text" value="<?php echo $timeSearch != '' ? $timeSearch :  date('Y-m-d', time()) ?>" name="time">
                                                    <span class="input-group-addon add-on"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php
                                    // Cộng theo cửa hàng: giá linh kiện, doanh thu chia theo hình thức thanh toán.
                                    // Doanh thu từng phiếu = (float) phonePrice, cùng cách cộng với Task_model::revenueSql() của tổng doanh thu
                                    // (máy không thu tiền tính doanh thu 0, nhưng vẫn cộng giá LK).
                                    $paymentOptions = taskPaymentOptions();
                                    $sums = array();
                                    foreach (array('VT', 'LS', 'ALL') as $key) {
                                        $sums[$key] = array('accessory' => 0, 'payment' => array_fill_keys(array_keys($paymentOptions), 0), 'unpaid' => 0);
                                    }
                                    $sums['VT']['revenue'] = (float) $tasksVT[0]->totalPriceVT;
                                    $sums['LS']['revenue'] = (float) $tasksLS[0]->totalPriceLS;
                                    $sums['ALL']['revenue'] = $sums['VT']['revenue'] + $sums['LS']['revenue'];
                                    foreach ($tasks as $row) {
                                        // Máy không thu tiền (Không sửa được, Bảo hành...): không cộng doanh thu,
                                        // nhưng vẫn cộng giá LK (VD trả lại tiền sửa trước đây cho khách) => trừ vào lợi nhuận
                                        $noCharge = taskNoRepairLabel($row->technicalFinish) != '';
                                        $revenue = $noCharge ? 0 : (float) $row->phonePrice;
                                        $accessory = isset($row->accessoryPrice) ? (int) $row->accessoryPrice : 0;
                                        foreach (array($row->shop == 2 ? 'LS' : 'VT', 'ALL') as $key) {
                                            $sums[$key]['accessory'] += $accessory;
                                            if ($noCharge) continue;
                                            if (isset($sums[$key]['payment'][$row->paymentMethod])) {
                                                $sums[$key]['payment'][$row->paymentMethod] += $revenue;
                                            } else {
                                                $sums[$key]['unpaid'] += $revenue;
                                            }
                                        }
                                    }
                                    // Màu số tổng: chuyển khoản đỏ, tiền mặt xanh lá (cùng in đậm)
                                    $paymentClasses = array('chuyen_khoan' => 'revenue-num-red', 'tien_mat' => 'revenue-num-green');
                                    $paymentText = function ($sum) use ($paymentOptions, $paymentClasses) {
                                        $parts = array();
                                        foreach ($paymentOptions as $code => $label) {
                                            $class = isset($paymentClasses[$code]) ? $paymentClasses[$code] : '';
                                            $parts[] = 'Tổng ' . mb_strtolower($label, 'UTF-8') . ': <b class="' . $class . '">' . number_format($sum['payment'][$code]) . '</b>';
                                        }
                                        if ($sum['unpaid'] != 0) {
                                            $parts[] = 'Chưa chọn thanh toán: <b>' . number_format($sum['unpaid']) . '</b>';
                                        }
                                        return implode(' &nbsp;|&nbsp; ', $parts);
                                    };
                                    $totalRows = array(
                                        array('Tổng doanh thu cửa hàng Vũng Tàu', 'Tổng lợi nhuận cửa hàng Vũng Tàu', 'VT'),
                                        array('Tổng doanh thu cửa hàng Long Sơn', 'Tổng lợi nhuận cửa hàng Long Sơn', 'LS'),
                                        array('Tổng doanh thu', 'Tổng lợi nhuận', 'ALL'),
                                    );
                                ?>
                                <table class="table table-bordered table-condensed table-striped no-footer table-data revenue-table" id="revenueTable">
                                    <thead>
                                        <tr>
                                            <th>Ngày</th>
                                            <th>Mã số</th>
                                            <th>Thiết bị</th>
                                            <th>Lỗi thiết bị</th>
                                            <th>Báo giá</th>
                                            <th style="width: 100px;">LK/SN</th>
                                            <th>Giá LK</th>
                                            <th>Lợi nhuận</th>
                                            <th>Hướng xử lý</th>
                                            <th>Khách hàng</th>
                                            <th>Điện thoại</th>
                                            <th>Cửa hàng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($tasks as $row): ?>
                                        <?php
                                            $accessory = isset($row->accessoryPrice) ? (int) $row->accessoryPrice : 0;
                                            $noCharge = taskNoRepairLabel($row->technicalFinish) != '';
                                            $revenue = $noCharge ? 0 : (float) $row->phonePrice;
                                            $paymentLabel = taskPaymentLabel($row);
                                        ?>
                                        <tr data-shop="<?php echo $row->shop == 2 ? 'LS' : 'VT'; ?>" data-revenue="<?php echo $revenue; ?>" data-nocharge="<?php echo $noCharge ? 1 : 0; ?>">
                                            <td><?php echo $date; ?></td>
                                            <td><?php echo '...'.substr($row->code, strlen($row->code) - 5); ?></td>
                                            <td><?php echo $row->phoneType; ?></td>
                                            <td><?php echo $row->phoneStatus; ?></td>
                                            <td>
                                                <?php if ($noCharge) { ?>
                                                    <span style="color:red;"><?php echo taskNoRepairLabel($row->technicalFinish); ?></span>
                                                <?php } elseif (is_numeric($row->phonePrice)) { ?>
                                                    <span class="revenue-price"><?php echo number_format($row->phonePrice); ?></span>
                                                <?php } else { ?>
                                                    <?php echo $row->phonePrice == '' ? 'Kiểm tra, báo giá trước khi sửa chữa' : $row->phonePrice; ?>
                                                <?php } ?>
                                                <?php if ($paymentLabel != '') { ?><br><span class="revenue-paylabel"><?php echo $paymentLabel; ?></span><?php } ?>
                                            </td>
                                            <td class="revenue-lksn">
                                                <?php echo $row->useAccessories == 1 ? '<span class="revenue-lksn-order">Đặt linh kiện</span>' : ''; ?>
                                                <?php echo $row->useAccessories == 2 ? $row->manufactory : ''; ?>
                                            </td>
                                            <td class="num revenue-lk">
                                                <?php // Sửa giá LK ngay tại đây: chỉ đổi giá LK, không đổi ngày giao máy hay thông tin khác ?>
                                                <input type="text" class="form-control input-sm price-input revenue-lk-input" inputmode="numeric" data-id="<?php echo (int) $row->id; ?>" data-saved="<?php echo $accessory; ?>" value="<?php echo $accessory > 0 ? number_format($accessory) : ''; ?>" placeholder="Nhập">
                                                <span class="revenue-lk-status"></span>
                                            </td>
                                            <td class="num revenue-profit-cell"><?php echo ($revenue != 0 || $accessory > 0) ? number_format($revenue - $accessory) : ''; ?></td>
                                            <td><?php echo $row->note; ?></td>
                                            <td><?php echo getCustomerName($row->customer_id); ?></td>
                                            <td><?php echo getCustomerPhone($row->customer_id); ?></td>
                                            <td><?php echo $row->shop == 2 ? 'Long Sơn' : 'Vũng Tàu'; ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php foreach ($totalRows as $totalRow): list($revenueLabel, $profitLabel, $key) = $totalRow; $sum = $sums[$key]; ?>
                                        <tr class="revenue-total">
                                            <td colspan="4"><p style="float: right; font-weight: bold;"><?php echo $revenueLabel; ?>:</p></td>
                                            <td><b class="revenue-num-red"><?php echo number_format($sum['revenue']); ?></b></td>
                                            <td colspan="7" class="revenue-payment"><?php echo $paymentText($sum); ?></td>
                                        </tr>
                                        <tr class="revenue-total revenue-profit">
                                            <td colspan="4"><p style="float: right; font-weight: bold;"><?php echo $profitLabel; ?>:</p></td>
                                            <td><b class="revenue-num-blue" data-total-profit="<?php echo $key; ?>" data-revenue="<?php echo $sum['revenue']; ?>"><?php echo number_format($sum['revenue'] - $sum['accessory']); ?></b></td>
                                            <td colspan="7" class="revenue-payment">Tổng giá linh kiện: <b data-total-accessory="<?php echo $key; ?>"><?php echo number_format($sum['accessory']); ?></b></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <script>
                                (function () {
                                    // Giá LK sửa tại chỗ: lưu khi rời ô / bấm Enter, rồi tính lại lợi nhuận dòng và các dòng tổng
                                    var url = '<?php echo base_url('tasks/setAccessoryPrice'); ?>';
                                    var table = document.getElementById('revenueTable');
                                    var fmt = function (n) { return String(Math.round(n)).replace(/\B(?=(\d{3})+(?!\d))/g, ','); };
                                    function recalcTotals() {
                                        var acc = {VT: 0, LS: 0, ALL: 0};
                                        table.querySelectorAll('tbody tr[data-shop]').forEach(function (tr) {
                                            var v = parseInt(tr.querySelector('.revenue-lk-input').getAttribute('data-saved'), 10) || 0;
                                            acc[tr.getAttribute('data-shop')] += v;
                                            acc.ALL += v;
                                        });
                                        table.querySelectorAll('[data-total-accessory]').forEach(function (b) { b.textContent = fmt(acc[b.getAttribute('data-total-accessory')]); });
                                        table.querySelectorAll('[data-total-profit]').forEach(function (b) {
                                            b.textContent = fmt(parseFloat(b.getAttribute('data-revenue')) - acc[b.getAttribute('data-total-profit')]);
                                        });
                                    }
                                    function save(input) {
                                        var value = input.value.replace(/\D/g, '');
                                        var number = value === '' ? 0 : parseInt(value, 10);
                                        if (String(number) === input.getAttribute('data-saved')) return;
                                        var tr = input.closest('tr');
                                        var status = tr.querySelector('.revenue-lk-status');
                                        status.className = 'revenue-lk-status';
                                        status.textContent = 'Đang lưu…';
                                        var xhr = new XMLHttpRequest();
                                        xhr.open('POST', url);
                                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                        xhr.onload = function () {
                                            var res = null;
                                            try { res = xhr.status === 200 ? JSON.parse(xhr.responseText) : null; } catch (e) {}
                                            if (!res || !res.ok) {
                                                status.className = 'revenue-lk-status revenue-lk-fail';
                                                status.textContent = 'Lỗi, chưa lưu';
                                                return;
                                            }
                                            input.setAttribute('data-saved', String(res.value));
                                            input.value = res.value > 0 ? fmt(res.value) : '';
                                            status.className = 'revenue-lk-status revenue-lk-ok';
                                            status.textContent = 'Đã lưu ✓';
                                            var revenue = parseFloat(tr.getAttribute('data-revenue')) || 0;
                                            var profitCell = tr.querySelector('.revenue-profit-cell');
                                            profitCell.textContent = (revenue !== 0 || res.value > 0) ? fmt(revenue - res.value) : '';
                                            recalcTotals();
                                        };
                                        xhr.onerror = function () {
                                            status.className = 'revenue-lk-status revenue-lk-fail';
                                            status.textContent = 'Lỗi mạng, chưa lưu';
                                        };
                                        xhr.send('id=' + encodeURIComponent(input.getAttribute('data-id')) + '&value=' + number);
                                    }
                                    table.querySelectorAll('.revenue-lk-input').forEach(function (input) {
                                        input.addEventListener('change', function () { save(input); });
                                        input.addEventListener('keydown', function (e) { if (e.key === 'Enter') { e.preventDefault(); input.blur(); } });
                                    });
                                })();
                                </script>
                            <?php else: ?>
                                <table class="table table-bordered table-condensed table-hover table-striped">
                                    <tbody>
                                        <tr>
                                            <td><label class="control-label col-lg-4">Chọn ngày:</label></td>
                                            <td>
                                                <div class="col-lg-3 input-group input-append date" id="dpTotal" data-date="<?php echo $timeSearch != '' ? $timeSearch :  date('Y-m-d', time()) ?>" data-date-format="yyyy-mm-dd">
                                                    <input class="form-control" type="text" value="<?php echo $timeSearch != '' ? $timeSearch :  date('Y-m-d', time()) ?>" name="time">
                                                    <span class="input-group-addon add-on"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
                                    <p class="center">Không có doanh thu trong hôm nay</p>
                                </table>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <!--End Datatables-->
        </div>
        <!-- /.inner -->
    </div>
    <!-- /.outer -->
</div>
<style type="text/css">
    /* Custom CSS for the Soft */
    table#dataTable {
        border: none;
    }
    table.dataTable thead .sorting_asc:after, table.dataTable thead .sorting:after {
        content: "";
    }
    table#dataTable thead tr {
        background: #337ab7; color: #ffffff;
    }
    .table-bordered > thead > tr > th, .table-bordered > thead > tr > td {
        border-bottom-width: 0px;
    }
    .box header {
        background-image: none; box-shadow: none; border-bottom: none; background: #263e81; color: #ffffff;
    }

    table.table tr td .table tr td:nth-child(1) {
        width: 20%;
    }
    table.table tr td a.task-history,
    table.table tr td a.customer-name {
        /* text-decoration: underline; */
    }
</style>