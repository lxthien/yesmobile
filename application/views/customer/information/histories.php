<div id="content" class="customer-history-page">
    <div class="outer">
        <div class="inner bg-light lter">
            <!--Begin Datatables-->
            <div class="row">
              <div class="col-lg-12">
                    <div class="box">
                        <header>
                            <div class="icons"><i class="fa fa-table"></i></div>
                            <h5 class="history-title">
                                Lịch sử sửa chữa
                                <span class="history-customer-name"><?php echo $customer->name; ?></span>
                                - <span class="history-customer-phone"><?php echo $customer->phone; ?></span>
                                - <a class="history-add-task" target="_blank" href="<?php echo base_url().'tasks/add/customer/'.$customer->id; ?>">Thêm máy sửa chữa</a>
                                - Tổng giao dịch: <span class="history-number"><?php echo $totalPrice > 0 ? number_format($totalPrice) : 0; ?></span>
                                - Tổng máy sửa: <span class="history-number"><?php echo count($tasks); ?></span>
                            </h5>
                        </header>
                        <div id="collapse4" class="body">
                            <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
                                <thead>
                                <tr>
                                    <th data-orderable="false">Thiết bị</th>
                                    <th data-orderable="false">Mật khẩu</th>
                                    <th data-orderable="false">Imei</th>
                                    <th data-orderable="false">Tình trạng</th>
                                    <th data-orderable="false">Chi phí</th>
                                    <th data-orderable="false">Bảo hành đến</th>
                                    <th data-orderable="false">Đặc điểm</th>
                                    <th data-orderable="false">Cập nhật</th>
                                    <th data-orderable="false">Hướng xử lý</th>
                                    <th data-orderable="false">LK/SN</th>
                                    <th data-orderable="false">Nhận máy</th>
                                    <th data-orderable="false">Giao máy</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tasks as $row): ?>
                                    <?php
                                        // LK/SN: giữ nguyên nội dung cũ của cột LK/Sửa Ngoài
                                        $lkContent = '';
                                        if ($row->useAccessories == 1) {
                                            $lkContent = '<b style="display:block;color:#000080;"><u>Đặt linh kiện</u></b>';
                                        } elseif ($row->useAccessories == 2) {
                                            $lkContent = '<p style="display:block;color:#007802;margin:0;"><b style="font-weigh:bold;">'.$row->manufactory.'</b></p>';
                                        }
                                    ?>
                                    <tr>
                                        <td><span style="color:#000080;font-weight:bold;"><?php echo $row->phoneType; ?></span></td>
                                        <td><span style="color:red;font-weight:bold;"><?php echo $row->phonePass; ?></span></td>
                                        <td><?php echo $row->phoneImei; ?></td>
                                        <td><span style="font-weight:bold;"><?php echo $row->phoneStatus; ?></span></td>
                                        <?php if (taskNoRepairLabel($row->technicalFinish) == '') { ?>
                                            <td><span style="color:red;font-weight:bold;"><?php echo is_numeric($row->phonePrice) ? number_format($row->phonePrice) : ($row->phonePrice == '' ? "Kiểm tra, báo giá trước khi sửa chữa" : $row->phonePrice); ?></span></td>
                                        <?php } else { ?>
                                            <td><span style="color:red;font-weight:bold;"><?php echo taskNoRepairLabel($row->technicalFinish); ?></span></td>
                                        <?php }  ?>
                                        <td><?php echo $row->taskStatus == 1 ? formatDate($row->warrantyPeriod) : 'Chưa có'; ?></td>
                                        <td><?php echo $row->features; ?></td>
                                        <td><?php echo taskUpdateHtml($row); ?></td>
                                        <td><?php if (trim(strip_tags($row->note)) != '') { ?><a href="#" class="history-toggle">Xem</a><div class="history-more" style="display:none;"><?php echo $row->note; ?></div><?php } ?></td>
                                        <td style="width: 100px;"><?php if ($lkContent != '') { ?><a href="#" class="history-toggle">Xem</a><div class="history-more" style="display:none;"><?php echo $lkContent; ?></div><?php } ?></td>
                                        <td><?php echo formatDate($row->created); ?></td>
                                        <td><?php echo $row->taskStatus == 1 ? formatDate($row->timeClosedTask) : 'Chưa giao'; ?></td>
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
<script>
    // Hướng xử lý, LK/SN: bấm "Xem" để hiện nội dung, bấm "Ẩn" để thu lại
    document.addEventListener('click', function (e) {
        var link = e.target.closest ? e.target.closest('a.history-toggle') : null;
        if (!link) return;
        e.preventDefault();
        var content = link.nextElementSibling;
        var hidden = content.style.display === 'none';
        content.style.display = hidden ? 'block' : 'none';
        link.textContent = hidden ? 'Ẩn' : 'Xem';
    });
</script>
