<div id="content">
    <div class="outer">
        <div class="inner bg-light lter">
            <!--Begin Datatables-->
            <div class="row">
              <div class="col-lg-12">
                    <div class="box">
                        <header>
                            <div class="icons"><i class="fa fa-table"></i></div>
                            <h5>Lịch sử giao dịch - Tổng giao dịch <span style="color: red; font-weight: bold;"><?php echo $totalPrice > 0 ? number_format($totalPrice) : 0; ?></span> <span style="color: red; font-weight: bold; margin-left: 50px;"><?php echo $customer->name; ?></span> - <a style="color:#000080" target="_blank" href="<?php echo base_url().'tasks/add/customer/'.$customer->id; ?>">Thêm máy sửa chữa</a></h5>
                        </header>
                        <div id="collapse4" class="body">
                            <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Loại máy</th>
                                    <th>Mật khẩu</th>
                                    <th>Imei</th>
                                    <th>Tình trạng</th>
                                    <th>Đặc điểm</th>
                                    <th>Hướng xử lý</th>
                                    <th style="width: 100px;">LK/Sửa Ngoài</th>
                                    <th>Chi phí</th>
                                    <th>Tình trạng</th>
                                    <th>Nhận máy</th>
                                    <th>Bảo hành đến</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tasks as $row): ?>
                                    <tr>
                                        <td><span style="color:#000080;font-weight:bold;"><?php echo $row->phoneType; ?></span></td>
                                        <td><span style="color:red;"><?php echo $row->phonePass; ?></span></td>
                                        <td><?php echo $row->phoneImei; ?></td>
                                        <td><span style="font-weight:bold;"><?php echo $row->phoneStatus; ?></span></td>
                                        <td><?php echo $row->features; ?></td>
                                        <td><?php echo $row->note; ?></td>
                                        <td>
                                            <?php echo $row->useAccessories == 1 ? '<b style="display:block;color:#000080;"><u>Đặt linh kiện</u></b><br><br>' : ''; ?>
                                            <?php echo $row->useAccessories == 2 ? '<p style="display:block;color:#007802;"><b style="font-weigh:bold;">'.$row->manufactory.'</b></p>' : ''; ?>
                                        </td>
                                        <?php if ($row->technicalFinish != 2) { ?>
                                            <td><span style="color:red;font-weight:bold;"><?php echo is_numeric($row->phonePrice) ? number_format($row->phonePrice) : ($row->phonePrice == '' ? "Kiểm tra, báo giá trước khi sửa chữa" : $row->phonePrice); ?></span></td>
                                        <?php } else { ?>
                                            <td>Không sửa được</td>
                                        <?php }  ?>
                                        <td><?php echo $row->taskStatus == 1 ? 'Đã xong':'Chưa xong'; ?></td>
                                        <td><?php echo formatDate($row->created); ?></td>
                                        <td><?php echo $row->taskStatus == 1 ? formatDate($row->warrantyPeriod) : 'Chưa có'; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
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