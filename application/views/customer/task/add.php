<div id="content">
    <div class="outer">
        <div class="inner bg-light lter">
            <!--BEGIN INPUT TEXT FIELDS-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="box dark">
                        <header>
                            <div class="icons"><i class="fa fa-edit"></i></div>
                            <h5>Nhập thông tin yêu cầu</h5>
                            <div class="toolbar">
                                <nav style="padding: 8px;">
                                    <a href="javascript:;" class="btn btn-default btn-xs collapse-box">
                                        <i class="fa fa-minus"></i>
                                    </a>
                                    <a href="javascript:;" class="btn btn-default btn-xs full-box">
                                        <i class="fa fa-expand"></i>
                                    </a>
                                    <a href="javascript:;" class="btn btn-danger btn-xs close-box">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </nav>
                            </div>
                        </header>
                        <div id="div-1" class="body">
                            <form class="form-horizontal" action="<?php echo base_url().'tasks/save'; ?>" method="post" id="taskForm">
                                <input type="hidden" name="id" value="<?php echo $task->id; ?>">
                                <input type="hidden" name="action" value="save" />
                                <div class="form-group">
                                    <label class="control-label col-lg-4">Loại yêu cầu</label>
                                    <div class="col-lg-8">
                                        <select class="form-control" name="taskType">
                                            <option value="1" <?php echo $task->taskType == 1 ? 'selected="selected"' : ''; ?>>Sửa phần cứng</option>
                                            <option value="2" <?php echo $task->taskType == 2 ? 'selected="selected"' : ''; ?>>Sửa lấy ngay</option>
                                            <option value="3" <?php echo $task->taskType == 2 ? 'selected="selected"' : ''; ?>>Sửa phần mềm</option>
                                            <option value="4" <?php echo $task->taskType == 2 ? 'selected="selected"' : ''; ?>>Bán phụ kiện</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-4">Khách hàng</label>
                                    <div class="col-lg-8">
                                        <select class="chzn-select form-control" name="customer_id">
                                            <option>Nhập tên hoặc điện thoại để tìm kiếm khách hàng</option>
                                            <?php foreach ($customers as $row): ?>
                                            <option value="<?php echo $row->id ?>" <?php echo $row->id == $task->customer_id ? 'selected="selected"' : ''; ?>><?php echo $row->name.' ('.$row->phone.')' ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pass1" class="control-label col-lg-4">Loại máy</label>
                                    <div class="col-lg-8">
                                        <input name="phoneType" class="form-control" type="text" placeholder="Loại máy" value="<?php echo $task->phoneType; ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pass1" class="control-label col-lg-4" style="color: red;">Mật khẩu</label>
                                    <div class="col-lg-8">
                                        <input name="phonePass" class="form-control" type="text" placeholder="Mật khẩu (nếu có)" value="<?php echo $task->phonePass; ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pass1" class="control-label col-lg-4">Imei/Serial</label>
                                    <div class="col-lg-8">
                                        <input name="phoneImei" class="form-control" type="text" placeholder="Imei/Serial" value="<?php echo $task->phoneImei; ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pass1" class="control-label col-lg-4">Tình trạng <br/><span style="color: red; font-size: 13px;">(Máy treo logo, treo phần mềm... Tư vấn trước: "CÓ THỂ" không trả lại được tình trạng ban đầu.)</span></label>
                                    <div class="col-lg-8">
                                        <input name="phoneStatus" class="form-control" type="text" placeholder="Tình trạng" value="<?php echo $task->phoneStatus; ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pass1" class="control-label col-lg-4">Đặc điểm</label>
                                    <div class="col-lg-8">
                                        <input name="features" class="form-control" type="text" placeholder="Đặc điểm" value="<?php echo $task->features; ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pass1" class="control-label col-lg-4">Ghi chú <br/><span style="color: red; font-size: 13px;">(Không kiểm tra được chức năng, máy rớt, cấn móp, hư chức năng...)</span></label>
                                    <div class="col-lg-8">
                                        <textarea class="form-control" placeholder="Không kiểm tra được chức năng, Khách mượn máy, máy trầy, cấn móp, hư chức năng..." name="notePrivate"><?php echo $task->notePrivate; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-4">Đặt linh kiện</label>
                                    <div class="col-lg-8">
                                        <div class="checkbox">
                                            <label><input class="uniform" type="radio" name="useAccessories" value="1" <?php echo $task->useAccessories == 1 ? 'checked=""' : ''; ?>>&nbsp; Có</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input class="uniform" type="radio" name="useAccessories" value="0" <?php echo $task->useAccessories == 0 ? 'checked=""' : ''; ?>>&nbsp; Không</label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input class="uniform" type="radio" name="useAccessories" value="2" <?php echo $task->useAccessories == 2 ? 'checked=""' : ''; ?>><span>&nbsp; Đã đặt hàng</span>
                                                <input class="form-control" type="text" name="manufactory" value="<?php echo $task->manufactory; ?>" placeholder="Nhà cung cấp">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pass1" class="control-label col-lg-4">Phụ kiện, Sim <br/><span style="color: red; font-size: 13px;">(Sim, Thẻ nhớ, ốp lưng, Sạc, Cáp...)</span></label>
                                    <div class="col-lg-8">
                                        <input name="phoneSim" class="form-control" type="text" placeholder="Sim, thẻ nhớ, ốp lưng, bộ sạc, cáp..." value="<?php echo $task->phoneSim; ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pass1" class="control-label col-lg-4">Báo giá <br/><span style="color: red; font-size: 13px;">(Nếu máy Bảo Hành thì nhập “Bảo hành không tính phí”. <br/> Máy kiểm tra, báo giá thì để trống ô này.)</span></label>
                                    <div class="col-lg-8">
                                        <input name="phonePrice" class="form-control" type="text" placeholder="Báo giá" value="<?php echo $task->phonePrice; ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-4" for="dp3">Thời gian hẹn khách</label>
                                    <div class="col-lg-8">
                                        <div style="float: left; margin-right: 5px;" class="col-lg-3 input-group input-append date" id="dp3" data-date="<?php echo date('Y-m-d', time()) ?>" data-date-format="yyyy-mm-dd">
                                            <input class="form-control" type="text" value="<?php echo $task->warrantyPeriodEnd != '' ? formatTimeInForm($task->warrantyPeriodEnd) : date('Y-m-d', time()); ?>" name="warrantyPeriodEnd">
                                            <span class="input-group-addon add-on"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <div class="col-lg-3 input-group date" id="datetimepicker4">
                                            <input type="text" class="form-control" value="<?php echo $task->warrantyPeriodEnd != '' ? formatTimeInForm2($task->warrantyPeriodEnd) : date('g:i A', time()); ?>" name="warrantyPeriodTimeEnd">
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-time"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-4">Tình trạng kỹ thuật</label>
                                    <div class="col-lg-8">
                                        <div class="checkbox">
                                            <label><input class="uniform" type="radio" name="technicalFinish" value="0" <?php echo $task->technicalFinish == 0 ? 'checked=""' : ''; ?>>&nbsp; Chưa sửa xong</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input class="uniform" type="radio" name="technicalFinish" value="1" <?php echo $task->technicalFinish == 1 ? 'checked=""' : ''; ?>>&nbsp; Đã sửa xong</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input class="uniform" type="radio" name="technicalFinish" value="2" <?php echo $task->technicalFinish == 2 ? 'checked=""' : ''; ?>>&nbsp; Không sửa được</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input class="uniform" type="radio" name="technicalFinish" value="3" <?php echo $task->technicalFinish == 3 ? 'checked=""' : ''; ?>>&nbsp; Tư vấn không sửa</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-4">Gọi Khách hàng đến lấy máy</label>
                                    <div class="col-lg-8">
                                        <div class="checkbox">
                                            <label><input class="uniform" type="radio" name="notificationCustomer" value="1" <?php echo $task->notificationCustomer == 1 ? 'checked=""' : ''; ?>>&nbsp; Đã gọi</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input class="uniform" type="radio" name="notificationCustomer" value="0" <?php echo $task->notificationCustomer == 0 ? 'checked=""' : ''; ?>>&nbsp; Chưa gọi</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-4">Khách hàng đã lấy máy </br><span style="color: red; font-size: 13px;">(Nhập thời gian bảo hành nếu có)</span></label>
                                    <div class="col-lg-8">
                                        <div class="checkbox">
                                            <label><input class="uniform" type="radio" name="taskStatus" value="1" <?php echo $task->taskStatus == 1 ? 'checked=""' : ''; ?>>&nbsp; Đã giao máy</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input class="uniform" type="radio" name="taskStatus" value="0" <?php echo $task->taskStatus == 0 ? 'checked=""' : ''; ?>>&nbsp; Chưa giao máy</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pass1" class="control-label col-lg-4">Thời gian bảo hành (Ngày)</label>
                                    <div class="col-lg-8">
                                        <input name="timeWarranty" class="form-control" type="text" placeholder="Thời gian bảo hành (Ngày)" value="<?php echo $task->timeWarranty; ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pass1" class="control-label col-lg-4">Lưu ý nội bộ</label>
                                    <div class="col-lg-8">
                                        <textarea class="form-control" name="note"><?php echo $task->note; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-4">&nbsp;</div>
                                    <div class="col-lg-8">
                                        <button type="submit" class="btn btn-default" data-dismiss="modal" name="save">Lưu</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.inner -->
    </div>
    <!-- /.outer -->
</div>

<div id="confirmDialog" title="Xác nhận">
    <p><b>96% máy sửa chữa</b> đều có thời gian bảo hành. Bạn đã nhập thời gian bảo hành chưa?</p>
</div>