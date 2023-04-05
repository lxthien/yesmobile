<table class="table">
    <tbody>
        <thead>
            <tr>
                <th>Ngày</th>
                <th>Nội dung thay đổi</th>
                <th>Cập nhật</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tasks as $row): ?>
            <tr>
                <td><?php echo formatTime($row->created, true); ?></td>
                <td>
                    <?php
                        $tracks = json_decode($row->tracks);
                    ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Giá trị</th>
                                <th>Cũ</th>
                                <th>Mới</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (array_key_exists('phoneType', $tracks)) { ?>
                            <tr>
                                <th>Loại máy</th>
                                <th><?php echo $tracks->phoneType->from; ?></th>
                                <th><?php echo $tracks->phoneType->to; ?></th>
                            </tr>
                            <?php } ?>
                            <?php if (array_key_exists('phoneImei', $tracks)) { ?>
                            <tr>
                                <th>Imei</th>
                                <th><?php echo $tracks->phoneImei->from; ?></th>
                                <th><?php echo $tracks->phoneImei->to; ?></th>
                            </tr>
                            <?php } ?>
                            <?php if (array_key_exists('notePrivate', $tracks)) { ?>
                            <tr>
                                <th>Lưu ý</th>
                                <th><?php echo $tracks->notePrivate->from; ?></th>
                                <th><?php echo $tracks->notePrivate->to; ?></th>
                            </tr>
                            <?php } ?>
                            <?php if (array_key_exists('phonePass', $tracks)) { ?>
                            <tr>
                                <th>Mật khẩu</th>
                                <th><?php echo $tracks->phonePass->from; ?></th>
                                <th><?php echo $tracks->phonePass->to; ?></th>
                            </tr>
                            <?php } ?>
                            <?php if (array_key_exists('phoneStatus', $tracks)) { ?>
                            <tr>
                                <th>Tình trạng</th>
                                <th><?php echo $tracks->phoneStatus->from; ?></th>
                                <th><?php echo $tracks->phoneStatus->to; ?></th>
                            </tr>
                            <?php } ?>
                            <?php if (array_key_exists('phoneSim', $tracks)) { ?>
                            <tr>
                                <th>Sim, Thẻ SD</th>
                                <th><?php echo $tracks->phoneSim->from; ?></th>
                                <th><?php echo $tracks->phoneSim->to; ?></th>
                            </tr>
                            <?php } ?>
                            <?php if (array_key_exists('phonePrice', $tracks)) { ?>
                            <tr>
                                <th>Giá</th>
                                <th><?php echo $tracks->phonePrice->from; ?></th>
                                <th><?php echo $tracks->phonePrice->to; ?></th>
                            </tr>
                            <?php } ?>
                            <?php if (array_key_exists('useAccessories', $tracks)) { ?>
                            <tr>
                                <th>Đặt linh kiện</th>
                                <th><?php echo $tracks->useAccessories->from == 1 ? 'Có' : 'Không'; ?></th>
                                <th><?php echo $tracks->useAccessories->to == 0 ? 'Không' : 'Có'; ?></th>
                            </tr>
                            <?php } ?>
                            <?php if (array_key_exists('technicalFinish', $tracks)) { ?>
                            <tr>
                                <th>Tình hình kỹ thuật</th>
                                <th><?php echo $tracks->technicalFinish->from == 1 ? 'Đã xong' : 'Chưa xong'; ?></th>
                                <th><?php echo $tracks->technicalFinish->to == 0 ? 'Chưa xong' : 'Đã xong'; ?></th>
                            </tr>
                            <?php } ?>
                            <?php if (array_key_exists('notificationCustomer', $tracks)) { ?>
                            <tr>
                                <th>Đã gọi khách đến lấy máy</th>
                                <th><?php echo $tracks->notificationCustomer->from == 1 ? 'Đã báo' : 'Chưa báo'; ?></th>
                                <th><?php echo $tracks->notificationCustomer->to == 0 ? 'Chưa báo' : 'Đã báo'; ?></th>
                            </tr>
                            <?php } ?>
                            <?php if (array_key_exists('quickStatus', $tracks)) { ?>
                            <tr>
                            <?php } ?>
                            <?php if (array_key_exists('taskStatus', $tracks)) { ?>
                            <tr>
                                <th>Khách hàng đã lấy máy</th>
                                <th><?php echo $tracks->taskStatus->from == 1 ? 'Đã xong' : 'Chưa xong'; ?></th>
                                <th><?php echo $tracks->taskStatus->to == 0 ? 'Chưa xong' : 'Đã xong'; ?></th>
                            </tr>
                            <?php } ?>
                            <?php if (array_key_exists('timeWarranty', $tracks)) { ?>
                            <tr>
                                <th>Thời gian bảo hành</th>
                                <th><?php echo $tracks->timeWarranty->from; ?></th>
                                <th><?php echo $tracks->timeWarranty->to; ?></th>
                            </tr>
                            <?php } ?>
                            <?php if (array_key_exists('note', $tracks)) { ?>
                            <tr>
                                <th>Lưu ý nội bộ</th>
                                <th><?php echo $tracks->note->from; ?></th>
                                <th><?php echo $tracks->note->to; ?></th>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </td>
                <td><?php echo $row->user_id != 0 ? $this->ion_auth->user($row->user_id)->row()->first_name.' '.$this->ion_auth->user($row->user_id)->row()->last_name : 'Không xác định'; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </tbody>
</table>