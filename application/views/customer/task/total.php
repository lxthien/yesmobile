<div id="content">
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
                                <table class="table table-bordered table-condensed table-striped no-footer">
                                    <thead>
                                        <tr>
                                            <th>Ngày</th>
                                            <th>Mã số</th>
                                            <th>Loại máy</th>
                                            <th>Tình trạng</th>
                                            <th>Tên</th>
                                            <th>Điện thoại</th>
                                            <th style="width: 100px;">LK/Sửa Ngoài</th>
                                            <th>Báo giá</th>
                                            <th>Cửa hàng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($tasks as $row): ?>
                                        <tr>
                                            <td><?php echo $date; ?></td>
                                            <td><?php echo '...'.substr($row->code, strlen($row->code) - 5); ?></td>
                                            <td><?php echo $row->phoneType; ?></td>
                                            <td><?php echo $row->phoneStatus; ?></td>
                                            <td><?php echo getCustomerName($row->customer_id); ?></td>
                                            <td><?php echo getCustomerPhone($row->customer_id); ?></td>
                                            <td>
                                                <?php echo $row->useAccessories == 1 ? '<b style="display:block;color:#000080;"><u>Đặt linh kiện</u></b><br><br>' : ''; ?>
                                                <?php echo $row->useAccessories == 2 ? '<p style="display:block;color:#FF8C00;"><b style="font-weigh:bold;">'.$row->manufactory.'</b></p>' : ''; ?>
                                            </td>
                                            <td><?php echo is_numeric($row->phonePrice) ? number_format($row->phonePrice) : ($row->phonePrice == '' ? "Kiểm tra, báo giá trước khi sửa chữa" : $row->phonePrice); ?></td>
                                            <td><?php echo $row->shop == 2 ? 'Long Sơn' : 'Vũng Tàu'; ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td colspan="8"><p style="float: right; font-weight: bold;">Tổng doanh thu cửa hàng Vũng Tàu:</p></td>
                                            <td><?php echo number_format($tasksVT[0]->totalPriceVT); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="8"><p style="float: right; font-weight: bold;">Tổng doanh thu cửa hàng Long Sơn:</p></td>
                                            <td><?php echo number_format($tasksLS[0]->totalPriceLS); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="8"><p style="float: right; font-weight: bold;">Tổng doanh thu:</p></td>
                                            <td><?php echo number_format($tasksVT[0]->totalPriceVT + $tasksLS[0]->totalPriceLS); ?></td>
                                        </tr>
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