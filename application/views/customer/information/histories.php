<div id="content">
    <div class="outer">
        <div class="inner bg-light lter">
            <!--Begin Datatables-->
            <div class="row">
              <div class="col-lg-12">
                    <div class="box">
                        <header>
                            <div class="icons"><i class="fa fa-table"></i></div>
                            <h5>Lịch sử giao dịch - Tổng giao dịch <span style="color: red; font-weight: bold;"><?php echo $totalPrice > 0 ? number_format($totalPrice) : 0; ?></span> <span style="color: red; font-weight: bold; margin-left: 50px;"><?php echo $customer->name; ?></span> - <a href="<?php echo base_url().'tasks/add/customer/'.$customer->id; ?>">Thêm máy sửa chữa</a></h5>
                        </header>
                        <div id="collapse4" class="body">
                            <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Loại máy</th>
                                    <th>Imei</th>
                                    <th>Mật khẩu</th>
                                    <th>Tình trạng</th>
                                    <th style="width: 100px;">LK/Sửa Ngoài</th>
                                    <th>Chi phí</th>
                                    <th>Tình trạng</th>
                                    <th>Thời gian nhận máy</th>
                                    <th>Thời gian bảo hành</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tasks as $row): ?>
                                    <tr>
                                        <td><?php echo $row->phoneType; ?></td>
                                        <td><?php echo $row->phoneImei; ?></td>
                                        <td><?php echo $row->phonePass; ?></td>
                                        <td><?php echo $row->phoneStatus; ?></td>
                                        <td>
                                            <?php echo $row->useAccessories == 1 ? '<b style="display:block;color:#000080;"><u>Đặt linh kiện</u></b><br><br>' : ''; ?>
                                            <?php echo $row->useAccessories == 2 ? '<p style="display:block;color:#FF8C00;"><b style="font-weigh:bold;">'.$row->manufactory.'</b></p>' : ''; ?>
                                        </td>
                                        <?php if ($row->technicalFinish != 2) { ?>
                                            <td><?php echo is_numeric($row->phonePrice) ? number_format($row->phonePrice) : ($row->phonePrice == '' ? "Kiểm tra, báo giá trước khi sửa chữa" : $row->phonePrice); ?></td>
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