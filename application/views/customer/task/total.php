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
                                    // Doanh thu từng phiếu = (float) phonePrice, cùng cách cộng với SUM(phonePrice) của tổng doanh thu.
                                    $paymentOptions = taskPaymentOptions();
                                    $sums = array();
                                    foreach (array('VT', 'LS', 'ALL') as $key) {
                                        $sums[$key] = array('accessory' => 0, 'payment' => array_fill_keys(array_keys($paymentOptions), 0), 'unpaid' => 0);
                                    }
                                    $sums['VT']['revenue'] = (float) $tasksVT[0]->totalPriceVT;
                                    $sums['LS']['revenue'] = (float) $tasksLS[0]->totalPriceLS;
                                    $sums['ALL']['revenue'] = $sums['VT']['revenue'] + $sums['LS']['revenue'];
                                    foreach ($tasks as $row) {
                                        $revenue = (float) $row->phonePrice;
                                        $accessory = isset($row->accessoryPrice) ? (int) $row->accessoryPrice : 0;
                                        foreach (array($row->shop == 2 ? 'LS' : 'VT', 'ALL') as $key) {
                                            $sums[$key]['accessory'] += $accessory;
                                            if (isset($sums[$key]['payment'][$row->paymentMethod])) {
                                                $sums[$key]['payment'][$row->paymentMethod] += $revenue;
                                            } else {
                                                $sums[$key]['unpaid'] += $revenue;
                                            }
                                        }
                                    }
                                    $paymentText = function ($sum) use ($paymentOptions) {
                                        $parts = array();
                                        foreach ($paymentOptions as $code => $label) {
                                            $parts[] = 'Tổng ' . mb_strtolower($label, 'UTF-8') . ': <b>' . number_format($sum['payment'][$code]) . '</b>';
                                        }
                                        if ($sum['unpaid'] != 0) {
                                            $parts[] = 'Chưa chọn thanh toán: <b>' . number_format($sum['unpaid']) . '</b>';
                                        }
                                        return implode(' &nbsp;|&nbsp; ', $parts);
                                    };
                                    $totalRows = array(
                                        array('Tổng doanh thu cửa hàng Vũng Tàu', 'Tổng lợi nhuận cửa hàng Vũng Tàu', $sums['VT']),
                                        array('Tổng doanh thu cửa hàng Long Sơn', 'Tổng lợi nhuận cửa hàng Long Sơn', $sums['LS']),
                                        array('Tổng doanh thu', 'Tổng lợi nhuận', $sums['ALL']),
                                    );
                                ?>
                                <table class="table table-bordered table-condensed table-striped no-footer table-data revenue-table">
                                    <thead>
                                        <tr>
                                            <th>Ngày</th>
                                            <th>Mã số</th>
                                            <th>Thiết bị</th>
                                            <th>Lỗi thiết bị</th>
                                            <th>Báo giá</th>
                                            <th>Giá LK</th>
                                            <th>Lợi nhuận</th>
                                            <th>Hướng xử lý</th>
                                            <th>Khách hàng</th>
                                            <th>Điện thoại</th>
                                            <th style="width: 100px;">LK/SN</th>
                                            <th>Cửa hàng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($tasks as $row): ?>
                                        <?php
                                            $accessory = isset($row->accessoryPrice) ? (int) $row->accessoryPrice : 0;
                                            $revenue = (float) $row->phonePrice;
                                        ?>
                                        <tr>
                                            <td><?php echo $date; ?></td>
                                            <td><?php echo '...'.substr($row->code, strlen($row->code) - 5); ?></td>
                                            <td><?php echo $row->phoneType; ?></td>
                                            <td><?php echo $row->phoneStatus; ?></td>
                                            <td><?php echo taskNoRepairLabel($row->technicalFinish) != '' ? '<span style="color:red;">'.taskNoRepairLabel($row->technicalFinish).'</span>' : (is_numeric($row->phonePrice) ? number_format($row->phonePrice) : ($row->phonePrice == '' ? "Kiểm tra, báo giá trước khi sửa chữa" : $row->phonePrice)); ?><?php echo taskPaymentHtml($row); ?></td>
                                            <td class="num"><?php echo $accessory > 0 ? number_format($accessory) : ''; ?></td>
                                            <td class="num"><?php echo ($revenue != 0 || $accessory > 0) ? '<b>' . number_format($revenue - $accessory) . '</b>' : ''; ?></td>
                                            <td><?php echo $row->note; ?></td>
                                            <td><?php echo getCustomerName($row->customer_id); ?></td>
                                            <td><?php echo getCustomerPhone($row->customer_id); ?></td>
                                            <td>
                                                <?php echo $row->useAccessories == 1 ? '<b style="display:block;color:#000080;"><u>Đặt linh kiện</u></b><br><br>' : ''; ?>
                                                <?php echo $row->useAccessories == 2 ? '<p style="display:block;color:#FF8C00;"><b style="font-weigh:bold;">'.$row->manufactory.'</b></p>' : ''; ?>
                                            </td>
                                            <td><?php echo $row->shop == 2 ? 'Long Sơn' : 'Vũng Tàu'; ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php foreach ($totalRows as $totalRow): list($revenueLabel, $profitLabel, $sum) = $totalRow; ?>
                                        <tr class="revenue-total">
                                            <td colspan="4"><p style="float: right; font-weight: bold;"><?php echo $revenueLabel; ?>:</p></td>
                                            <td><?php echo number_format($sum['revenue']); ?></td>
                                            <td colspan="7" class="revenue-payment"><?php echo $paymentText($sum); ?></td>
                                        </tr>
                                        <tr class="revenue-total revenue-profit">
                                            <td colspan="4"><p style="float: right; font-weight: bold;"><?php echo $profitLabel; ?>:</p></td>
                                            <td><b><?php echo number_format($sum['revenue'] - $sum['accessory']); ?></b></td>
                                            <td colspan="7" class="revenue-payment"><?php echo $sum['accessory'] > 0 ? 'Tổng giá linh kiện: <b>' . number_format($sum['accessory']) . '</b>' : ''; ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
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