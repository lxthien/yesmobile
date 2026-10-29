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
                        </header>
                        <div id="div-1" class="body">
                            <form class="form-horizontal" action="<?php echo base_url().'tasks/save'; ?>" method="post" id="taskForm">
                                <input type="hidden" name="id" value="<?php echo $task->id; ?>">
                                <input type="hidden" name="action" value="save" />
                                <!-- Hàng 1: Khách hàng + Loại yêu cầu -->
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Khách hàng</label>
                                    <div class="col-lg-10">
                                        <div class="task-form-inline">
                                            <div class="tfi-field tfi-customer">
                                                <select class="chzn-select form-control" name="customer_id">
                                                    <option value="">Nhập tên hoặc điện thoại để tìm kiếm khách hàng</option>
                                                    <?php foreach ($customers as $row): ?>
                                                    <option value="<?php echo $row->id ?>" <?php echo $row->id == $task->customer_id ? 'selected="selected"' : ''; ?>><?php echo $row->name.' ('.$row->phone.')' ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <label class="tfi-label">Loại yêu cầu</label>
                                            <div class="tfi-field">
                                                <select class="form-control" name="taskType">
                                                    <option value="1" <?php echo $task->taskType == 1 ? 'selected="selected"' : ''; ?>>Sửa phần cứng</option>
                                                    <option value="2" <?php echo $task->taskType == 2 ? 'selected="selected"' : ''; ?>>Sửa lấy ngay</option>
                                                    <option value="3" <?php echo $task->taskType == 3 ? 'selected="selected"' : ''; ?>>Sửa phần mềm</option>
                                                    <option value="4" <?php echo $task->taskType == 4 ? 'selected="selected"' : ''; ?>>Bán phụ kiện</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pass1" class="control-label col-lg-2">Tên thiết bị</label>
                                    <div class="col-lg-10">
                                        <div class="task-form-inline">
                                            <div class="tfi-field tfi-device">
                                                <input name="phoneType" id="taskPhoneType" class="form-control" type="text" placeholder="Tên thiết bị" value="<?php echo $task->phoneType; ?>"/>
                                            </div>
                                            <label class="tfi-label">Thương hiệu</label>
                                            <div class="tfi-field tfi-category">
                                                <?php $this->load->view('customer/task/category_select', array('selectName' => 'brandId', 'items' => $brands, 'selected' => isset($task->brandId) ? $task->brandId : 0)); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2">&nbsp;</label>
                                    <div class="col-lg-10">
                                        <!-- Bỏ chọn cả 2 ô = điện thoại (0) -->
                                        <input type="hidden" name="phoneTypeCategory" value="0">
                                        <div class="checkbox">
                                            <label><input class="uniform radio-uncheckable" type="radio" name="phoneTypeCategory" value="1" <?php echo $task->phoneTypeCategory == 1 ? 'checked=""' : ''; ?>><span style="color: red;">&nbsp; Sửa Laptop</span></label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input class="uniform radio-uncheckable" type="radio" name="phoneTypeCategory" value="2" <?php echo $task->phoneTypeCategory == 2 ? 'checked=""' : ''; ?>><span style="color: red;">&nbsp; Mua xác</span></label>
                                        </div>
                                    </div>
                                </div>
                                <!-- Hàng: Mật khẩu (ô dài nhất) + Imei/Serial + Phụ kiện, Sim -->
                                <div class="form-group">
                                    <label for="pass1" class="control-label col-lg-2" style="color: red;">Mật khẩu</label>
                                    <div class="col-lg-10">
                                        <div class="task-form-inline">
                                            <div class="tfi-field tfi-password">
                                                <input name="phonePass" class="form-control" type="text" placeholder="Mật khẩu (nếu có)" value="<?php echo $task->phonePass; ?>"/>
                                            </div>
                                            <label class="tfi-label">Imei/Serial</label>
                                            <div class="tfi-field">
                                                <input name="phoneImei" class="form-control" type="text" placeholder="Imei/Serial" value="<?php echo $task->phoneImei; ?>"/>
                                            </div>
                                            <label class="tfi-label">Phụ kiện, Sim</label>
                                            <div class="tfi-field">
                                                <input name="phoneSim" class="form-control" type="text" placeholder="Sim, thẻ nhớ, ốp lưng, bộ sạc, cáp..." value="<?php echo $task->phoneSim; ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pass1" class="control-label col-lg-2">Đặc điểm</label>
                                    <div class="col-lg-10">
                                        <input name="features" class="form-control" type="text" placeholder="Không kiểm tra được chức năng, đã từng sửa ở cửa hàng khác, máy trầy, cấn móp, hư chức năng..." value="<?php echo $task->features; ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pass1" class="control-label col-lg-2">Tình trạng</label>
                                    <div class="col-lg-10">
                                        <div class="task-form-inline">
                                            <div class="tfi-field tfi-device">
                                                <input name="phoneStatus" id="taskPhoneStatus" class="form-control" type="text" placeholder="Tình trạng" value="<?php echo $task->phoneStatus; ?>"/>
                                            </div>
                                            <label class="tfi-label">Hạng mục sửa</label>
                                            <div class="tfi-field tfi-category">
                                                <?php $this->load->view('customer/task/category_select', array('selectName' => 'repairCategoryId', 'items' => $repairs, 'selected' => isset($task->repairCategoryId) ? $task->repairCategoryId : 0)); ?>
                                            </div>
                                        </div>
                                        <span style="color: red; font-size: 13px; font-weight: bold;">(Máy treo logo, treo phần mềm... Tư vấn trước: "CÓ THỂ" không trả lại được tình trạng ban đầu.)</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2"><span style="color: red;">Cập nhật</span></label>
                                    <div class="col-lg-10">
                                        <input name="updateNote" class="form-control" type="text" placeholder="Đã báo khách lỗi trên main, hư CPU..." value="<?php echo isset($task->updateNote) ? htmlspecialchars($task->updateNote, ENT_QUOTES, 'UTF-8') : ''; ?>"/>
                                        <?php $selectedUpdateFlags = taskUpdateFlags($task); ?>
                                        <?php foreach (taskUpdateFlagOptions() as $flagCode => $flagLabel) { ?>
                                        <label class="checkbox-inline update-flag">
                                            <input type="checkbox" name="updateFlags[]" value="<?php echo $flagCode; ?>" <?php echo in_array($flagCode, $selectedUpdateFlags) ? 'checked=""' : ''; ?>> <?php echo $flagLabel; ?>
                                        </label>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pass1" class="control-label col-lg-2"><span style="color: red;">Hướng xử lý (nội bộ)</span></label>
                                    <div class="col-lg-10">
                                        <textarea class="form-control" name="note"><?php echo $task->note; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pass1" class="control-label col-lg-2">Ghi chú</label>
                                    <div class="col-lg-10">
                                        <textarea class="form-control" name="notePrivate"><?php echo $task->notePrivate; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group dat-linh-kien">
                                    <label class="control-label col-lg-2">Đặt linh kiện</label>
                                    <div class="col-lg-10">
                                        <div class="checkbox no-padding-left">
                                            <label><input class="uniform" type="radio" name="useAccessories" value="1" <?php echo $task->useAccessories == 1 ? 'checked=""' : ''; ?>>&nbsp; Có</label>
                                        </div>
                                        <div class="checkbox no-padding-left">
                                            <label><input class="uniform" type="radio" name="useAccessories" value="0" <?php echo $task->useAccessories == 0 ? 'checked=""' : ''; ?>>&nbsp; Không</label>
                                        </div>
                                        <div class="checkbox no-padding-left">
                                            <label>
                                                <input class="uniform" type="radio" name="useAccessories" value="2" <?php echo $task->useAccessories == 2 ? 'checked=""' : ''; ?>><span>&nbsp; Đã đặt hàng</span>
                                                <input class="form-control" type="text" name="manufactory" value="<?php echo $task->manufactory; ?>" placeholder="Nhà cung cấp">
                                            </label>
                                        </div>
                                        <div class="checkbox no-padding-left accessory-price">
                                            <label>
                                                <span>Giá linh kiện</span>
                                                <input class="form-control price-input" type="text" name="accessoryPrice" value="<?php echo !empty($task->accessoryPrice) ? number_format($task->accessoryPrice) : ''; ?>" placeholder="Tổng giá LK và phí ship">
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input class="uniform" type="checkbox" name="phieu" value="1" <?php echo $task->phieu == 1 ? 'checked=""' : ''; ?>><span style="color:red; font-weight: bold;">Không phiếu</span>
                                            </label>
                                            <label>
                                                <input class="uniform" type="checkbox" name="khachMuonMay" value="1" <?php echo $task->khachMuonMay == 1 ? 'checked=""' : ''; ?>><span style="color:red; font-weight: bold;">Khách mượn máy cửa hàng</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pass1" class="control-label col-lg-2">Báo giá</label>
                                    <div class="col-lg-10">
                                        <?php // Số tiền hiện có dấu phẩy (1,400,000); khi lưu server bỏ dấu phẩy nên vẫn lưu dạng số ?>
                                        <input name="phonePrice" class="form-control price-input" type="text" placeholder="Báo giá" value="<?php echo preg_match('/^-?\d+$/', (string) $task->phonePrice) ? number_format($task->phonePrice) : $task->phonePrice; ?>"/>
                                        <span style="color: red; font-size: 13px; font-weight: bold;">(Nếu máy Bảo Hành thì nhập “Bảo hành không tính phí”. Máy kiểm tra, báo giá thì để trống ô này.)</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2" for="dp3">Thời gian hẹn khách</label>
                                    <div class="col-lg-10">
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
                                    <label class="control-label col-lg-2">Tình trạng kỹ thuật</label>
                                    <div class="col-lg-10">
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
                                        <div class="checkbox">
                                            <label><input class="uniform" type="radio" name="technicalFinish" value="4" <?php echo $task->technicalFinish == 4 ? 'checked=""' : ''; ?>>&nbsp; Không có linh kiện</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input class="uniform" type="radio" name="technicalFinish" value="5" <?php echo $task->technicalFinish == 5 ? 'checked=""' : ''; ?>>&nbsp; Khách đổi ý, không sửa</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input class="uniform" type="radio" name="technicalFinish" value="6" <?php echo $task->technicalFinish == 6 ? 'checked=""' : ''; ?>>&nbsp; Sửa hỗ trợ, không tính phí</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input class="uniform" type="radio" name="technicalFinish" value="7" <?php echo $task->technicalFinish == 7 ? 'checked=""' : ''; ?>>&nbsp; Bảo hành, không mất phí</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Gọi Khách hàng đến lấy máy</label>
                                    <div class="col-lg-10">
                                        <div class="checkbox">
                                            <label><input class="uniform" type="radio" name="notificationCustomer" value="1" <?php echo $task->notificationCustomer == 1 ? 'checked=""' : ''; ?>>&nbsp; Đã gọi</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input class="uniform" type="radio" name="notificationCustomer" value="0" <?php echo $task->notificationCustomer == 0 ? 'checked=""' : ''; ?>>&nbsp; Chưa gọi</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Khách hàng đã lấy máy </br><span style="color: red; font-size: 13px;">(Nhập thời gian bảo hành nếu có)</span></label>
                                    <div class="col-lg-10">
                                        <div class="checkbox">
                                            <label><input class="uniform" type="radio" name="taskStatus" value="1" <?php echo $task->taskStatus == 1 ? 'checked=""' : ''; ?>>&nbsp; Đã giao máy</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input class="uniform" type="radio" name="taskStatus" value="0" <?php echo $task->taskStatus == 0 ? 'checked=""' : ''; ?>>&nbsp; Chưa giao máy</label>
                                        </div>
                                        <!-- Hình thức thanh toán: chọn 1, bấm lại để bỏ chọn. Bắt buộc khi Đã giao máy (trừ 4 tình trạng không sửa) -->
                                        <input type="hidden" name="paymentMethod" value="">
                                        <div class="payment-methods">
                                            <?php foreach (taskPaymentOptions() as $paymentCode => $paymentLabel) { ?>
                                            <label class="checkbox-inline">
                                                <input class="radio-uncheckable" type="radio" name="paymentMethod" value="<?php echo $paymentCode; ?>" <?php echo isset($task->paymentMethod) && $task->paymentMethod == $paymentCode ? 'checked=""' : ''; ?>> <?php echo $paymentLabel; ?>
                                            </label>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pass1" class="control-label col-lg-2">Thời gian bảo hành (Ngày)</label>
                                    <div class="col-lg-10">
                                        <input name="timeWarranty" class="form-control" type="text" placeholder="Thời gian bảo hành (Ngày)" value="<?php echo $task->timeWarranty ? $task->timeWarranty : ''; // 0 (chưa nhập) hiện ô trống, khi lưu vẫn là 0 ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-2">&nbsp;</div>
                                    <div class="col-lg-10">
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
<script>
// Tự đoán Thương hiệu (từ Tên thiết bị) và Hạng mục sửa (từ Tình trạng, không ra thì Hướng xử lý).
// Chỉ tự chọn khi ô đang trống hoặc đang là giá trị tự đoán; nhân viên chọn tay thì giữ nguyên.
// Cách đoán giống hệt Task_category_model::guess() (PHP).
(function () {
    var data = <?php echo json_encode($categoryGuess); ?>;
    var brands, repairs, verbRe;
    function escapeRe(s) { return s.replace(/[.*+?^${}()|[\]\\\/]/g, '\\$&'); }
    function compile(list) {
        return list.map(function (item) {
            return {
                id: item.id,
                patterns: item.keywords.map(function (kw) {
                    return { re: new RegExp('(?<![\\p{L}\\p{N}])' + escapeRe(kw) + '(?!\\p{L})', 'gu'), len: kw.length };
                })
            };
        });
    }
    try {
        brands = compile(data.brand);
        repairs = compile(data.repair);
        verbRe = new RegExp('(?:^|[^\\p{L}\\p{N}])(?:thay|sửa|fix|repair|replace)\\s+$', 'u');
    } catch (e) {
        return; // trình duyệt quá cũ: bỏ qua, server vẫn tự đoán khi lưu
    }
    function normalize(t) { return (t || '').toLowerCase().replace(/\s+/g, ' ').trim(); }
    function better(c, cur) {
        if (!cur) return true;
        if (c.pos !== cur.pos) return c.pos < cur.pos;
        return c.len > cur.len;
    }
    function guess(items, text, preferAfterVerb) {
        text = normalize(text);
        if (!text) return 0;
        var best = null, anchored = null;
        items.forEach(function (item) {
            item.patterns.forEach(function (p) {
                var m;
                p.re.lastIndex = 0;
                while ((m = p.re.exec(text)) !== null) {
                    var c = { id: item.id, pos: m.index, len: p.len };
                    if (better(c, best)) best = c;
                    if (preferAfterVerb && verbRe.test(text.slice(0, m.index)) && better(c, anchored)) anchored = c;
                    if (m[0] === '') p.re.lastIndex++;
                }
            });
        });
        return anchored ? anchored.id : (best ? best.id : 0);
    }

    var form = document.getElementById('taskForm');
    var phoneType = document.getElementById('taskPhoneType');
    var phoneStatus = document.getElementById('taskPhoneStatus');
    var note = form.querySelector('[name="note"]');
    var brandSelect = document.getElementById('brandId');
    var repairSelect = document.getElementById('repairCategoryId');

    function isLaptop() {
        var r = form.querySelector('input[name="phoneTypeCategory"][value="1"]');
        return r && r.checked;
    }
    function apply(select, id) {
        if (select.getAttribute('data-auto') !== '1') return;
        select.value = select.querySelector('option[value="' + id + '"]') ? String(id) : '0';
        select.classList.toggle('is-guess', select.value !== '0');
    }
    function updateBrand() { apply(brandSelect, guess(brands, (isLaptop() ? 'laptop ' : '') + phoneType.value, false)); }
    function updateRepair() {
        var id = guess(repairs, phoneStatus.value, true);
        apply(repairSelect, id || guess(repairs, note ? note.value : '', true));
    }
    [brandSelect, repairSelect].forEach(function (select) {
        select.addEventListener('change', function () {
            // Chọn tay: giữ nguyên. Chọn lại "-- Chọn --": cho tự đoán tiếp
            select.setAttribute('data-auto', select.value === '0' ? '1' : '0');
            select.classList.remove('is-guess');
        });
    });
    phoneType.addEventListener('input', updateBrand);
    form.querySelectorAll('input[name="phoneTypeCategory"]').forEach(function (r) { r.addEventListener('change', updateBrand); r.addEventListener('click', function () { setTimeout(updateBrand, 0); }); });
    phoneStatus.addEventListener('input', updateRepair);
    if (note) note.addEventListener('input', updateRepair);
    updateBrand();
    updateRepair();
})();
</script>
