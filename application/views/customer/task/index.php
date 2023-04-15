<div id="content">
    <div class="outer">
        <div class="inner bg-light lter">
            <!--Begin Datatables-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="box">
                        <header>
                            <div class="icons"><i class="fa fa-table"></i></div>
                            <h5>MÁY ĐANG SỬA CHỬA</h5>
                        </header>
                        <div id="collapse4" class="body">
                            <?php if(count($tasks) > 0) : ?>
                            <table id="dataTableTask1" class="table table-bordered table-condensed">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Mã số</th>
                                    <th>Tên/</br>SĐT</th>
                                    <th>Tên máy</th>
                                    <th>Đặc điểm</th>
                                    <th>Pass</th>
                                    <th>Imei</th>
                                    <th>Phụ kiện</th>
                                    <th>Ghi chú</th>
                                    <th>Báo giá</th>
                                    <th>TG nhận máy</th>
                                    <th>TG hẹn khách</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tasks as $row): ?>
                                        <?php if($row->useAccessories == 1) {$cssBgAccessories = 'background: #5b8e4b; color: #ffffff;';} else {$cssBgAccessories = '';} ?>
                                        <?php if($row->quickStatus == 1) {$cssBg = 'background: #b51b1b; color: #ffffff;';} else {$cssBg = '';} ?>
                                        <?php if($row->isCustomerVip == 1) {$cssBgVip = 'background: #5cb85c; color: #ffffff;';} else {$cssBgVip = '';} ?>
                                        <tr style="<?php echo $cssBg.$cssBgVip; ?>" class="<?php echo isTaskNotifyCustomerEnd($row->id) ? 'expired' : ''; ?>">
                                            <td><?php echo $row->id; ?></td>
                                            <td><?php echo '...'.substr($row->code, strlen($row->code) - 4); ?></td>
                                            <td>
                                                <a style="<?php echo $cssBg.$cssBgVip; ?>color:red;font-weight:bold;" href="<?php echo base_url().'customers/histories/'.$row->customer_id; ?>" target="_blank" class="customer-name"><?php echo getCustomerName($row->customer_id); ?></a>
                                                </br>
                                                <?php echo getCustomerPhone($row->customer_id); ?>
                                            </td>
                                            <td>
                                                <a style="<?php echo $cssBg.$cssBgVip; ?>color:#000080;font-weight:bold;" data-url="<?php echo base_url().'tasks/histories/'.$row->id; ?>" href="javascript:void(0)" class="task-history"><?php echo $row->phoneType; ?></a>
                                                <?php echo $row->phoneStatus != '' ? '<br><span>'.$row->phoneStatus.'</span>' : ''; ?>
                                            </td>
                                            <td><?php echo $row->features; ?></td>
                                            <td><span style="color:<?php echo isTaskNotifyCustomerEnd($row->id) ? '#ffffff' : '#000080'; ?>"><?php echo $row->phonePass; ?></span></td>
                                            <td><?php echo $row->phoneImei; ?></td>
                                            <td><?php echo $row->phoneSim; ?></td>
                                            <td>
                                                <?php echo $row->notePrivate; ?>
                                                <?php echo $row->useAccessories == 1 ? '<br><br><b style="display:block;color:#000080;"><u>Đặt linh kiện</u></b>' : ''; ?>
                                                <?php echo $row->useAccessories == 2 ? '<br><br><p style="display:block;color:#007802;">LK/Sửa ngoài: <b style="font-weigh:bold;">'.$row->manufactory.'</b></p>' : ''; ?>
                                                <?php echo $row->phieu == 1 ? '<br><p style="display:block;color:#007802;"><b style="font-weigh:bold;">'.'Không phiếu'.'</b></p>' : ''; ?>
                                                <?php echo $row->khachMuonMay == 1 ? '<br><p style="display:block;color:#007802;"><b style="font-weigh:bold;">'.'Khách mượn máy cửa hàng'.'</b></p>' : ''; ?>
                                            </td>
                                            <?php if ($row->technicalFinish == 2) { ?>
                                                <td><span style="color:red;">Không sửa được</span></td>
                                            <?php } elseif ($row->technicalFinish == 3) { ?>
                                                <td><span style="color:red;">Tư vấn không sửa</span></td>
                                            <?php } else { ?>
                                                <td><span style="color:<?php echo isTaskNotifyCustomerEnd($row->id) ? '#ffffff' : 'red'; ?>;"><?php echo is_numeric($row->phonePrice) ? number_format($row->phonePrice) : ($row->phonePrice == '' ? "KT, báo giá" : $row->phonePrice); ?></span></td>
                                            <?php } ?>
                                            <td><?php echo formatTimeLineBreak($row->created, true); ?></td>
                                            <td><b><?php echo formatTimeLineBreak($row->warrantyPeriodEnd); ?></b></td>
                                            <td>
                                                <a style="<?php echo $cssBg.$cssBgVip; ?>" href="<?php echo base_url().'tasks/edit/'.$row->id; ?>" title="Chỉnh sửa"><i class="fa fa-edit"></i></a>
                                            </td>
                                            <td>
                                                <a style="<?php echo $cssBg.$cssBgVip; ?>" href="<?php echo base_url().'tasks/printTask/'.$row->id; ?>" title="In hóa đơn"><i class="fa fa-print"></i></a>
                                            </td>
                                            <td><?php echo $row->createdBy != 0 ? $this->ion_auth->user($row->createdBy)->row()->first_name.' '.$this->ion_auth->user($row->createdBy)->row()->last_name : 'Không xác định'; ?></td>
                                            <td><?php echo $row->note; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php else: ?>
                            <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
                                <p class="center">Không có yêu cầu nào đang sửa chữa</p>
                            </table>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="box">
                        <header>
                            <div class="icons"><i class="fa fa-table"></i></div>
                            <h5>[SỬA LAPTOP, PC] MÁY ĐANG SỬA CHỬA</h5>
                        </header>
                        <div id="collapse4" class="body">
                            <?php if(count($tasksPC) > 0) : ?>
                            <table id="dataTableTask11" class="table table-bordered table-condensed">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Mã số</th>
                                    <th>Tên/</br>SĐT</th>
                                    <th>Tên máy</th>
                                    <th>Đặc điểm</th>
                                    <th>Pass</th>
                                    <th>Imei</th>
                                    <th>Phụ kiện</th>
                                    <th>Ghi chú</th>
                                    <th>Báo giá</th>
                                    <th>TG nhận máy</th>
                                    <th>TG hẹn khách</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tasksPC as $row): ?>
                                        <?php if($row->useAccessories == 1) {$cssBgAccessories = 'background: #5b8e4b; color: #ffffff;';} else {$cssBgAccessories = '';} ?>
                                        <?php if($row->quickStatus == 1) {$cssBg = 'background: #b51b1b; color: #ffffff;';} else {$cssBg = '';} ?>
                                        <?php if($row->isCustomerVip == 1) {$cssBgVip = 'background: #5cb85c; color: #ffffff;';} else {$cssBgVip = '';} ?>
                                        <tr style="<?php echo $cssBg.$cssBgVip; ?>" class="<?php echo isTaskNotifyCustomerEnd($row->id) ? 'expired' : ''; ?>">
                                            <td><?php echo $row->id; ?></td>
                                            <td><?php echo '...'.substr($row->code, strlen($row->code) - 4); ?></td>
                                            <td>
                                                <a style="<?php echo $cssBg.$cssBgVip; ?>color:red;font-weight:bold;" href="<?php echo base_url().'customers/histories/'.$row->customer_id; ?>" target="_blank" class="customer-name"><?php echo getCustomerName($row->customer_id); ?></a>
                                                </br>
                                                <?php echo getCustomerPhone($row->customer_id); ?>
                                            </td>
                                            <td>
                                                <a style="<?php echo $cssBg.$cssBgVip; ?>color:#000080;font-weight:bold;" data-url="<?php echo base_url().'tasks/histories/'.$row->id; ?>" href="javascript:void(0)" class="task-history"><?php echo $row->phoneType; ?></a>
                                                <?php echo $row->phoneStatus != '' ? '<br><span>'.$row->phoneStatus.'</span>' : ''; ?>
                                            </td>
                                            <td><?php echo $row->features; ?></td>
                                            <td><span style="color:<?php echo isTaskNotifyCustomerEnd($row->id) ? '#ffffff' : '#000080'; ?>"><?php echo $row->phonePass; ?></span></td>
                                            <td><?php echo $row->phoneImei; ?></td>
                                            <td><?php echo $row->phoneSim; ?></td>
                                            <td>
                                                <?php echo $row->notePrivate; ?>
                                                <?php echo $row->useAccessories == 1 ? '<br><br><b style="display:block;color:#000080;"><u>Đặt linh kiện</u></b>' : ''; ?>
                                                <?php echo $row->useAccessories == 2 ? '<br><br><p style="display:block;color:#007802;">LK/Sửa ngoài: <b style="font-weigh:bold;">'.$row->manufactory.'</b></p>' : ''; ?>
                                                <?php echo $row->phieu == 1 ? '<br><p style="display:block;color:#007802;"><b style="font-weigh:bold;">'.'Không phiếu'.'</b></p>' : ''; ?>
                                                <?php echo $row->khachMuonMay == 1 ? '<br><p style="display:block;color:#007802;"><b style="font-weigh:bold;">'.'Khách mượn máy cửa hàng'.'</b></p>' : ''; ?>
                                            </td>
                                            <?php if ($row->technicalFinish == 2) { ?>
                                                <td><span style="color:red;">Không sửa được</span></td>
                                            <?php } elseif ($row->technicalFinish == 3) { ?>
                                                <td><span style="color:red;">Tư vấn không sửa</span></td>
                                            <?php } else { ?>
                                                <td><span style="color:<?php echo isTaskNotifyCustomerEnd($row->id) ? '#ffffff' : 'red'; ?>;"><?php echo is_numeric($row->phonePrice) ? number_format($row->phonePrice) : ($row->phonePrice == '' ? "KT, báo giá" : $row->phonePrice); ?></span></td>
                                            <?php } ?>
                                            <td><?php echo formatTimeLineBreak($row->created, true); ?></td>
                                            <td><b><?php echo formatTimeLineBreak($row->warrantyPeriodEnd); ?></b></td>
                                            <td>
                                                <a style="<?php echo $cssBg.$cssBgVip; ?>" href="<?php echo base_url().'tasks/edit/'.$row->id; ?>" title="Chỉnh sửa"><i class="fa fa-edit"></i></a>
                                            </td>
                                            <td>
                                                <a style="<?php echo $cssBg.$cssBgVip; ?>" href="<?php echo base_url().'tasks/printTask/'.$row->id; ?>" title="In hóa đơn"><i class="fa fa-print"></i></a>
                                            </td>
                                            <td><?php echo $row->createdBy != 0 ? $this->ion_auth->user($row->createdBy)->row()->first_name.' '.$this->ion_auth->user($row->createdBy)->row()->last_name : 'Không xác định'; ?></td>
                                            <td><?php echo $row->note; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php else: ?>
                            <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
                                <p class="center">Không có yêu cầu nào đang sửa chữa</p>
                            </table>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="box">
                        <header>
                            <div class="icons"><i class="fa fa-table"></i></div>
                            <h5>KỸ THUẬT ĐÃ SỬA XONG</h5>
                        </header>
                        <div id="collapse4" class="body">
                            <?php if(count($tasksFinish) > 0) : ?>
                            <table id="dataTableTask2" class="table table-bordered table-condensed">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Mã số</th>
                                    <th>Tên/</br>SĐT</th>
                                    <th>Tên máy</th>
                                    <th>Đặc điểm</th>
                                    <th>Pass</th>
                                    <th>Imei</th>
                                    <th>Phụ kiện</th>
                                    <th>Ghi chú</th>
                                    <th>Báo giá</th>
                                    <th>TG nhận máy</th>
                                    <th>TG hẹn khách</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tasksFinish as $row): ?>
                                        <?php if($row->quickStatus == 1) {$cssBg = 'background: #b51b1b; color: #ffffff;';} else {$cssBg = '';} ?>
                                        <?php if($row->isCustomerVip == 1) {$cssBgVip = 'background: #5cb85c; color: #ffffff;';} else {$cssBgVip = '';} ?>
                                        <tr style="<?php echo $cssBg.$cssBgVip; ?>">
                                            <td></td>
                                            <td><?php echo '...'.substr($row->code, strlen($row->code) - 4); ?></td>
                                            <td>
                                                <a style="<?php echo $cssBg.$cssBgVip; ?>color:red;font-weight:bold;" href="<?php echo base_url().'customers/histories/'.$row->customer_id; ?>" target="_blank" class="customer-name"><?php echo getCustomerName($row->customer_id); ?></a>
                                                </br>
                                                <?php echo getCustomerPhone($row->customer_id); ?>
                                            </td>
                                            <td>
                                                <a style="<?php echo $cssBg.$cssBgVip; ?>color:#000080;font-weight:bold;" data-url="<?php echo base_url().'tasks/histories/'.$row->id; ?>" href="javascript:void(0)" class="task-history"><?php echo $row->phoneType; ?></a>
                                                <?php echo $row->phoneStatus != '' ? '<br><span>'.$row->phoneStatus.'</span>' : ''; ?>
                                            </td>
                                            <td><?php echo $row->features; ?></td>
                                            <td><span style="color:<?php echo isTaskNotifyCustomerEnd($row->id) ? '#ffffff' : '#000080'; ?>"><?php echo $row->phonePass; ?></span></td>
                                            <td><?php echo $row->phoneImei; ?></td>
                                            <td><?php echo $row->phoneSim; ?></td>
                                            <td>
                                                <?php echo $row->notePrivate; ?>
                                                <?php echo $row->useAccessories == 1 ? '<br><br><b style="display:block;color:#000080;"><u>Đặt linh kiện</u></b>' : ''; ?>
                                                <?php echo $row->useAccessories == 2 ? '<br><br><p style="display:block;color:#007802;">LK/Sửa ngoài: <b style="font-weigh:bold;">'.$row->manufactory.'</b></p>' : ''; ?>
                                                <?php echo $row->phieu == 1 ? '<br><p style="display:block;color:#007802;"><b style="font-weigh:bold;">'.'Không phiếu'.'</b></p>' : ''; ?>
                                                <?php echo $row->khachMuonMay == 1 ? '<br><p style="display:block;color:#007802;"><b style="font-weigh:bold;">'.'Khách mượn máy cửa hàng'.'</b></p>' : ''; ?>
                                            </td>
                                            <?php if ($row->technicalFinish == 2) { ?>
                                                <td><span style="color:red;">Không sửa được</span></td>
                                            <?php } elseif ($row->technicalFinish == 3) { ?>
                                                <td><span style="color:red;">Tư vấn không sửa</span></td>
                                            <?php } else { ?>
                                                <td><span style="color:<?php echo isTaskNotifyCustomerEnd($row->id) ? '#ffffff' : 'red'; ?>;"><?php echo is_numeric($row->phonePrice) ? number_format($row->phonePrice) : ($row->phonePrice == '' ? "KT, báo giá" : $row->phonePrice); ?></span></td>
                                            <?php } ?>
                                            <td><?php echo formatTimeLineBreak($row->created, true); ?></td>
                                            <td><b><?php echo formatTimeLineBreak($row->warrantyPeriodEnd); ?></b></td>
                                            <td>
                                                <a href="<?php echo base_url().'tasks/edit/'.$row->id; ?>" title="Chỉnh sửa"><i class="fa fa-edit"></i></a>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url().'tasks/printTask/'.$row->id; ?>" title="In hóa đơn"><i class="fa fa-print"></i></a>
                                            </td>
                                            <td><?php echo $row->createdBy != 0 ? $this->ion_auth->user($row->createdBy)->row()->first_name.' '.$this->ion_auth->user($row->createdBy)->row()->last_name : 'Không xác định'; ?></td>
                                            <td><?php echo $row->note; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php else: ?>
                            <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
                                <p class="center">Không có yêu cầu nào đã sửa xong</p>
                            </table>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="box">
                        <header>
                            <div class="icons"><i class="fa fa-table"></i></div>
                            <h5>ĐÃ BÁO KHÁCH HÀNG ĐẾN LẤY MÁY</h5>
                        </header>
                        <div id="collapse4" class="body">
                            <?php if(count($tasksNotifiedCustomer) > 0) : ?>
                            <table id="dataTableTask3" class="table table-bordered table-condensed">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Mã số</th>
                                    <th>Tên/</br>SĐT</th>
                                    <th>Tên máy</th>
                                    <th>Đặc điểm</th>
                                    <th>Pass</th>
                                    <th>Imei</th>
                                    <th>Phụ kiện</th>
                                    <th>Ghi chú</th>
                                    <th>Báo giá</th>
                                    <th>TG nhận máy</th>
                                    <th>TG báo khách</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tasksNotifiedCustomer as $row): ?>
                                        <?php if($row->quickStatus == 1) {$cssBg = 'background: #b51b1b; color: #ffffff;';} else {$cssBg = '';} ?>
                                        <?php if($row->isCustomerVip == 1) {$cssBgVip = 'background: #5cb85c; color: #ffffff;';} else {$cssBgVip = '';} ?>
                                        <tr style="<?php echo $cssBg.$cssBgVip; ?>">
                                            <td></td>
                                            <td><?php echo '...'.substr($row->code, strlen($row->code) - 4); ?></td>
                                            <td>
                                                <a style="<?php echo $cssBg.$cssBgVip; ?>color:red;font-weight:bold;" href="<?php echo base_url().'customers/histories/'.$row->customer_id; ?>" target="_blank" class="customer-name"><?php echo getCustomerName($row->customer_id); ?></a>
                                                </br>
                                                <?php echo getCustomerPhone($row->customer_id); ?>
                                            </td>
                                            <td>
                                                <a style="<?php echo $cssBg.$cssBgVip; ?>color:#000080;font-weight:bold;" data-url="<?php echo base_url().'tasks/histories/'.$row->id; ?>" href="javascript:void(0)" class="task-history"><?php echo $row->phoneType; ?></a>
                                                <?php echo $row->phoneStatus != '' ? '<br><span>'.$row->phoneStatus.'</span>' : ''; ?>
                                            </td>
                                            <td><?php echo $row->features; ?></td>
                                            <td><span style="color:<?php echo isTaskNotifyCustomerEnd($row->id) ? '#ffffff' : '#000080'; ?>"><?php echo $row->phonePass; ?></span></td>
                                            <td><?php echo $row->phoneImei; ?></td>
                                            <td><?php echo $row->phoneSim; ?></td>
                                            <td>
                                                <?php echo $row->notePrivate; ?>
                                                <?php echo $row->useAccessories == 1 ? '<br><br><b style="display:block;color:#000080;"><u>Đặt linh kiện</u></b>' : ''; ?>
                                                <?php echo $row->useAccessories == 2 ? '<br><br><p style="display:block;color:#007802;">LK/Sửa ngoài: <b style="font-weigh:bold;">'.$row->manufactory.'</b></p>' : ''; ?>
                                                <?php echo $row->phieu == 1 ? '<br><p style="display:block;color:#007802;"><b style="font-weigh:bold;">'.'Không phiếu'.'</b></p>' : ''; ?>
                                                <?php echo $row->khachMuonMay == 1 ? '<br><p style="display:block;color:#007802;"><b style="font-weigh:bold;">'.'Khách mượn máy cửa hàng'.'</b></p>' : ''; ?>
                                            </td>
                                            <?php if ($row->technicalFinish == 2) { ?>
                                                <td><span style="color:red;">Không sửa được</span></td>
                                            <?php } elseif ($row->technicalFinish == 3) { ?>
                                                <td><span style="color:red;">Tư vấn không sửa</span></td>
                                            <?php } else { ?>
                                                <td><span style="color:<?php echo isTaskNotifyCustomerEnd($row->id) ? '#ffffff' : 'red'; ?>;"><?php echo is_numeric($row->phonePrice) ? number_format($row->phonePrice) : ($row->phonePrice == '' ? "KT, báo giá" : $row->phonePrice); ?></span></td>
                                            <?php } ?>
                                            <td><?php echo formatTimeLineBreak($row->created, true); ?></td>
                                            <td><?php echo $row->timeNotificationCustomer != "0000-00-00 00:00:00" ? formatTimeLineBreak($row->timeNotificationCustomer, true, true) : 'Không xác định'; ?></td>
                                            <td>
                                                <a href="<?php echo base_url().'tasks/edit/'.$row->id; ?>" title="Chỉnh sửa"><i class="fa fa-edit"></i></a>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url().'tasks/printTask/'.$row->id; ?>" title="In hóa đơn"><i class="fa fa-print"></i></a>
                                            </td>
                                            <td><?php echo $row->createdBy != 0 ? $this->ion_auth->user($row->createdBy)->row()->first_name.' '.$this->ion_auth->user($row->createdBy)->row()->last_name : 'Không xác định'; ?></td>
                                            <td><?php echo $row->note; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php else: ?>
                            <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
                                <p class="center">Không có yêu cầu nào đã báo khách hàng</p>
                            </table>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="box">
                        <header>
                            <div class="icons"><i class="fa fa-table"></i></div>
                            <h5>CÁC MÁY ĐÃ GIAO CHO KHÁCH HÀNG</h5>
                        </header>
                        <div id="collapse4" class="body">
                            <?php if(count($tasksCustomerReceived) > 0) : ?>
                            <p style="color: red;">Lưu ý: Tin này sẽ không hiển thị sau 48h (2 ngày) kể từ lúc khách hàng nhận máy</p>
                            <table id="dataTableTask4" class="table table-bordered table-condensed">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Mã số</th>
                                    <th>Tên/</br>SĐT</th>
                                    <th>Tên máy</th>
                                    <th>Đặc điểm</th>
                                    <th>Pass</th>
                                    <th>Imei</th>
                                    <th>Phụ kiện</th>
                                    <th>Ghi chú</th>
                                    <th>Báo giá</th>
                                    <th>TG Giao Máy</th>
                                    <th>TG Bảo hành</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tasksCustomerReceived as $row): ?>
                                        <?php if($row->quickStatus == 1) {$cssBg = 'background: #b51b1b; color: #ffffff;';} else {$cssBg = '';} ?>
                                        <?php if($row->isCustomerVip == 1) {$cssBgVip = 'background: #5cb85c; color: #ffffff;';} else {$cssBgVip = '';} ?>
                                        <tr style="<?php echo $cssBg.$cssBgVip; ?>">
                                            <td></td>
                                            <td><?php echo '...'.substr($row->code, strlen($row->code) - 4); ?></td>
                                            <td>
                                                <a style="<?php echo $cssBg.$cssBgVip; ?>color:red;font-weight:bold;" href="<?php echo base_url().'customers/histories/'.$row->customer_id; ?>" target="_blank" class="customer-name"><?php echo getCustomerName($row->customer_id); ?></a>
                                                </br>
                                                <?php echo getCustomerPhone($row->customer_id); ?>
                                            </td>
                                            <td>
                                                <a style="<?php echo $cssBg.$cssBgVip; ?>color:#000080;font-weight:bold;" data-url="<?php echo base_url().'tasks/histories/'.$row->id; ?>" href="javascript:void(0)" class="task-history"><?php echo $row->phoneType; ?></a>
                                                <?php echo $row->phoneStatus != '' ? '<br><span>'.$row->phoneStatus.'</span>' : ''; ?>
                                            </td>
                                            <td><?php echo $row->features; ?></td>
                                            <td><span style="color:<?php echo isTaskNotifyCustomerEnd($row->id) ? '#ffffff' : '#000080'; ?>"><?php echo $row->phonePass; ?></span></td>
                                            <td><?php echo $row->phoneImei; ?></td>
                                            <td><?php echo $row->phoneSim; ?></td>
                                            <td>
                                                <?php echo $row->notePrivate; ?>
                                                <?php echo $row->useAccessories == 1 ? '<br><br><b style="display:block;color:#000080;"><u>Đặt linh kiện</u></b>' : ''; ?>
                                                <?php echo $row->useAccessories == 2 ? '<br><br><p style="display:block;color:#007802;">LK/Sửa ngoài: <b style="font-weigh:bold;">'.$row->manufactory.'</b></p>' : ''; ?>
                                                <?php echo $row->phieu == 1 ? '<br><p style="display:block;color:#007802;"><b style="font-weigh:bold;">'.'Không phiếu'.'</b></p>' : ''; ?>
                                                <?php echo $row->khachMuonMay == 1 ? '<br><p style="display:block;color:#007802;"><b style="font-weigh:bold;">'.'Khách mượn máy cửa hàng'.'</b></p>' : ''; ?>
                                            </td>
                                            <?php if ($row->technicalFinish == 2) { ?>
                                                <td><span style="color:red;">Không sửa được</span></td>
                                            <?php } elseif ($row->technicalFinish == 3) { ?>
                                                <td><span style="color:red;">Tư vấn không sửa</span></td>
                                            <?php } else { ?>
                                                <td><span style="color:<?php echo isTaskNotifyCustomerEnd($row->id) ? '#ffffff' : 'red'; ?>;"><?php echo is_numeric($row->phonePrice) ? number_format($row->phonePrice) : ($row->phonePrice == '' ? "KT, báo giá" : $row->phonePrice); ?></span></td>
                                            <?php } ?>
                                            <td><?php echo formatTimeLineBreak($row->timeClosedTask, false, true); ?></td>
                                            <td><?php echo formatTimeLineBreak($row->warrantyPeriod); ?></td>
                                            <td>
                                                <a href="<?php echo base_url().'tasks/edit/'.$row->id; ?>" title="Chỉnh sửa"><i class="fa fa-edit"></i></a>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url().'tasks/printTask/'.$row->id; ?>" title="In hóa đơn"><i class="fa fa-print"></i></a>
                                            </td>
                                            <td><?php echo $row->createdBy != 0 ? $this->ion_auth->user($row->createdBy)->row()->first_name.' '.$this->ion_auth->user($row->createdBy)->row()->last_name : 'Không xác định'; ?></td>
                                            <td><?php echo $row->note; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php else: ?>
                            <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
                                <p class="center">Không có yêu cầu nào đã giao cho khách hàng</p>
                            </table>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="box">
                        <header>
                            <div class="icons"><i class="fa fa-table"></i></div>
                            <h5>CÁC MÁY ĐÃ GIAO CHO KHÁCH HÀNG (> 300k)</h5>
                        </header>
                        <div id="collapse4" class="body">
                            <?php if(count($tasksCustomerReceivedWithPrice) > 0) : ?>
                            <!-- <p style="color: red;">Lưu ý: Tin này sẽ không hiển thị sau 48h (2 ngày) kể từ lúc khách hàng nhận máy</p> -->
                            <table id="dataTableTask5" class="table table-bordered table-condensed">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Mã số</th>
                                    <th>Tên/</br>SĐT</th>
                                    <th>Tên máy</th>
                                    <th>Đặc điểm</th>
                                    <th>Pass</th>
                                    <th>Imei</th>
                                    <th>Phụ kiện</th>
                                    <th>Ghi chú</th>
                                    <th>Báo giá</th>
                                    <th>TG Giao Máy</th>
                                    <th>TG Bảo hành</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tasksCustomerReceivedWithPrice as $row): ?>
                                        <?php if($row->quickStatus == 1) {$cssBg = 'background: #b51b1b; color: #ffffff;';} else {$cssBg = '';} ?>
                                        <?php if($row->isCustomerVip == 1) {$cssBgVip = 'background: #5cb85c; color: #ffffff;';} else {$cssBgVip = '';} ?>
                                        <tr style="<?php echo $cssBg.$cssBgVip; ?>">
                                            <td></td>
                                            <td><?php echo '...'.substr($row->code, strlen($row->code) - 4); ?></td>
                                            <td>
                                                <a style="<?php echo $cssBg.$cssBgVip; ?>color:red;font-weight:bold;" href="<?php echo base_url().'customers/histories/'.$row->customer_id; ?>" target="_blank" class="customer-name"><?php echo getCustomerName($row->customer_id); ?></a>
                                                </br>
                                                <?php echo getCustomerPhone($row->customer_id); ?>
                                            </td>
                                            <td>
                                                <a style="<?php echo $cssBg.$cssBgVip; ?>color:#000080;font-weight:bold;" data-url="<?php echo base_url().'tasks/histories/'.$row->id; ?>" href="javascript:void(0)" class="task-history"><?php echo $row->phoneType; ?></a>
                                                <?php echo $row->phoneStatus != '' ? '<br><span>'.$row->phoneStatus.'</span>' : ''; ?>
                                            </td>
                                            <td><?php echo $row->features; ?></td>
                                            <td><span style="color:<?php echo isTaskNotifyCustomerEnd($row->id) ? '#ffffff' : '#000080'; ?>"><?php echo $row->phonePass; ?></span></td>
                                            <td><?php echo $row->phoneImei; ?></td>
                                            <td><?php echo $row->phoneSim; ?></td>
                                            <td>
                                                <?php echo $row->notePrivate; ?>
                                                <?php echo $row->useAccessories == 1 ? '<br><br><b style="display:block;color:#000080;"><u>Đặt linh kiện</u></b>' : ''; ?>
                                                <?php echo $row->useAccessories == 2 ? '<br><br><p style="display:block;color:#007802;">Linh kiện/Sửa ngoài: <b style="font-weigh:bold;">'.$row->manufactory.'</b></p>' : ''; ?>
                                                <?php echo $row->phieu == 1 ? '<br><p style="display:block;color:#007802;"><b style="font-weigh:bold;">'.'Không phiếu'.'</b></p>' : ''; ?>
                                                <?php echo $row->khachMuonMay == 1 ? '<br><p style="display:block;color:#007802;"><b style="font-weigh:bold;">'.'Khách mượn máy cửa hàng'.'</b></p>' : ''; ?>
                                            </td>
                                            <?php if ($row->technicalFinish == 2) { ?>
                                                <td><span style="color:red;">Không sửa được</span></td>
                                            <?php } elseif ($row->technicalFinish == 3) { ?>
                                                <td><span style="color:red;">Tư vấn không sửa</span></td>
                                            <?php } else { ?>
                                                <td><span style="color:<?php echo isTaskNotifyCustomerEnd($row->id) ? '#ffffff' : 'red'; ?>;"><?php echo is_numeric($row->phonePrice) ? number_format($row->phonePrice) : ($row->phonePrice == '' ? "KT, báo giá" : $row->phonePrice); ?></span></td>
                                            <?php } ?>
                                            <td><?php echo formatTimeLineBreak($row->timeClosedTask); ?></td>
                                            <td><?php echo formatTimeLineBreak($row->warrantyPeriod); ?></td>
                                            <td>
                                                <a href="<?php echo base_url().'tasks/edit/'.$row->id; ?>" title="Chỉnh sửa"><i class="fa fa-edit"></i></a>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url().'tasks/printTask/'.$row->id; ?>" title="In hóa đơn"><i class="fa fa-print"></i></a>
                                            </td>
                                            <td><?php echo $row->createdBy != 0 ? $this->ion_auth->user($row->createdBy)->row()->first_name.' '.$this->ion_auth->user($row->createdBy)->row()->last_name : 'Không xác định'; ?></td>
                                            <td><?php echo $row->note; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php else: ?>
                            <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
                                <p class="center">Không có yêu cầu nào đã giao cho khách hàng</p>
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
        background: #000080; color: #ffffff;
    }
    .table-bordered > thead > tr > th, .table-bordered > thead > tr > td {
        border-bottom-width: 0px;
    }
    .box header {
        background-image: none; box-shadow: none; border-bottom: none; background: #000080; color: #ffffff;
    }

    table.table tr td .table tr td:nth-child(1) {
        width: 20%;
    }

    table.table tr td a.task-history,
    table.table tr td a.customer-name {
        /* text-decoration: underline; */
    }

    #dataTableTask1_wrapper .toolbar,
    #dataTableTask1_wrapper .dataTables_length,
    #dataTableTask1_wrapper .dataTables_filter {
        width: 33.33%;
        display: inline-block;
    }

    #dataTableTask1_wrapper .toolbar .task-add {
        padding: 8px 20px;
        background: #000080;
        color: #fff;
        margin-right: 15px;
    }

    #dataTableTask1_wrapper .toolbar .customer-add {
        padding: 8px 20px;
        background: #000080;
        color: #fff;
    }

    #dataTableTask1,
    #dataTableTask1_LS,
    #dataTableTask2,
    #dataTableTask2_LS,
    #dataTableTask3,
    #dataTableTask3_LS,
    #dataTableTask4,
    #dataTableTask4_LS,
    #dataTableTask5,
    #dataTableTask5_LS {
        width: 100% !important;
    }
</style>