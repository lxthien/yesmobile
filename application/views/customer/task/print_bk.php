<div id="content">
    <div class="outer">
        <div class="inner bg-light lter">
            <!--Begin Datatables-->
            <div class="row">
              <div class="col-lg-12">
                    <div class="box">
                        <style type="text/css">
                            .cl {
                                clear: both;
                            }
                            .cls2 {
                                width: 600px; padding: 10px 5px; margin: 0 auto; font-size: 13px; border: 0px solid #cccccc; margin-top: 20px; font-family: "Roboto";
                            }
                            .cls2 .header {
                                padding: 10px 0;
                            }
                            .cls2 .header .logo {
                                width: 35%; text-align: center; float: left; border-right: 1px solid #000000; padding-right: 1%; margin-right: 1%;
                            }
                            .cls2 .header .logo img{
                                width: 100%; margin-top: 20px;
                            }
                            .cls2 .header .logo p {
                                margin-bottom: 15px; font-size: 12px;
                            }
                            .cls2 .address {
                                width: 62%; float: right;
                            }
                            .cls2 .address p {
                                margin: 0;
                            }
                            .cls2 .address p.company {
                                text-transform: uppercase; font-weight: 500;
                            }
                            p.title {
                                text-align: center; font-weight: 600; padding: 10px 0; margin-bottom: 0;
                            }
                            .pers .left {
                                width: 48%; float: left;
                            }
                            .pers .right {
                                width: 50%; float: right;
                            }
                            .pers .right p {
                                font-size: 12px; margin: 0;
                            }
                            .cls2 .footer {
                                height: 80px; width: 100%; text-align: right; padding-top: 0px;
                            }
                            .cls2 .footer p {
                                text-transform: uppercase; font-weight: 600;
                            }
                            .cls2 .black {
                                width: 100%; text-align: center; padding: 10px 0 10px;
                            }
                            .cls2 .black p{
                                text-transform: uppercase; font-size: 16px; font-weight: 600;
                            }
                            .cls2 .wrapper-print {
                                width: 100%; text-align: center;
                            }
                            #btnSubmit {
                                border: none; width: 100px; height: 30px; cursor: pointer; background: #263e81; color: #ffffff; text-transform: uppercase; font-size: 18px;
                            }
                            table {
                                width: 100%; padding: 0px;
                            }
                            .table-striped > tbody > tr td {
                                width: 50%;
                            }
                            .table-striped > tbody > tr:nth-of-type(odd) {
                                background-color: #f9f9f9;
                            }
                            section.table {
                                border: none;
                            }
                            section.table .row-table {
                                width: 100%; display: inline-flex;
                            }
                            section.table .row-table .col-table {
                                width: 50%; float: left; font-size: 12px; line-height: 20px;
                            }
                        </style>
                        <div id="printTask">
                            <div class="cls2">
                                <style type="text/css">
                                    @media print {
                                        .cl {
                                            clear: both;
                                        }
                                        .cls2 {
                                            width: 600px; padding: 10px 5px; margin: 0 auto; font-size: 14px; border: 0px solid #cccccc; margin-top: 20px; font-family: "Roboto";
                                        }
                                        .cls2 .header {
                                            padding: 10px 0;
                                        }
                                        .cls2 .header .logo {
                                            width: 35%; text-align: center; float: left; border-right: 1px solid #000000; padding-right: 1%; margin-right: 1%;
                                        }
                                        .cls2 .header .logo img{
                                            width: 100%; margin-top: 10px;
                                        }
                                        .cls2 .header .logo p {
                                            margin-bottom: 15px; font-size: 14px;
                                        }
                                        .cls2 .address {
                                            width: 62%; float: right;
                                        }
                                        .cls2 .address p {
                                            margin: 0;
                                        }
                                        .cls2 .address p.company {
                                            text-transform: uppercase; font-weight: 500;
                                        }
                                        p.title {
                                            text-align: center; font-weight: 600; padding: 10px 0; margin-bottom: 0;
                                        }
                                        .pers .left {
                                            width: 48%; float: left;
                                        }
                                        .pers .right {
                                            width: 50%; float: right;
                                        }
                                        .pers .right p {
                                            font-size: 13px; margin: 0;
                                        }
                                        .cls2 .footer {
                                            height: 80px; width: 100%; text-align: right; padding-top: 0px; margin-bottom: -5px;
                                        }
                                        .cls2 .footer p {
                                            text-transform: uppercase; font-weight: 600;
                                        }
                                        .cls2 .black {
                                            width: 100%; text-align: center; padding: 10px 0 10px;
                                        }
                                        .cls2 .black p{
                                            text-transform: uppercase; font-size: 16px; font-weight: 600;
                                        }
                                        .cls2 .wrapper-print {
                                            width: 100%; text-align: center;
                                        }
                                        #btnSubmit {
                                            display: none;
                                        }
                                        table {
                                            width: 100%; padding: 0px;
                                        }
                                        .table-striped > tbody > tr td {
                                            width: 50%;
                                        }
                                        .table-striped > tbody > tr:nth-of-type(odd) {
                                            background-color: #f9f9f9;
                                        }
                                        section.table {
                                            border: none;
                                        }
                                        section.table .row-table {
                                            width: 100%; height: 20px;
                                        }
                                        section.table .row-table .col-table {
                                            width: 50%; float: left; font-size: 12px; line-height: 20px;
                                        }
                                    }
                                </style>
                                <div class="wrapper">
                                    <div class="header">
                                        <div class="logo">
                                            <img src="http://yesmobile.vn/assets/images/logo-print.png">
                                            <p>sửa chữa điện thoại từ 2010</p>
                                        </div>
                                        <div class="address">
                                            <p class="company"><strong>YES MOBILE | SỬA CHỮA ĐIỆN THOẠI TỪ 2010 </strong></p>
                                            <p><strong>CH 1</strong>: 438 Trương Công Định, Phường 8, TP.Vũng Tàu</p>
                                            <p><strong>CH 2</strong>: Đường 28/4, Thôn 6, Xã Long Sơn, TP.Vũng Tàu</p>
                                            <p><strong>Tel</strong>: (0254) 6 557 999 – <strong>Email</strong>: yesmobile.vn@gmail.com</p>
                                            <p><strong>Web</strong>: www.yesmobile.vn – <strong>FB</strong>: www.fb.com/yesmobile.vn</p>
											<p><strong>Kiểm tra tình trạng máy sửa chữa: 0847 72 72 72</strong></p>
                                        </div>
                                    </div>
                                    <div class="cl"></div>
                                    <p class="title">PHIẾU BIÊN NHẬN SỬA CHỮA ĐIỆN THOẠI</p>
                                    <div class="cl"></div>
                                    <div class="pers">
                                        <div class="left">
                                        <section class="table table-bordered table-condensed table-hover table-striped">
                                              <div class="row-table">
                                                <div class="col-table">Khách hàng</div>
                                                <div class="col-table"><strong><?php echo getCustomerName($task->customer_id); ?></strong></div>
                                              </div>
                                              <div class="row-table">
                                                <div class="col-table">Số điện thoại</div>
                                                <div class="col-table"><?php echo getCustomerPhone($task->customer_id); ?></div>
                                              </div>
                                              <div class="row-table">
                                                <div class="col-table">Loại máy</div>
                                                <div class="col-table"><strong><?php echo $task->phoneType; ?></strong></div>
                                              </div>
                                              <div class="row-table">
                                                <div class="col-table">Imei/Serial</div>
                                                <div class="col-table"><?php echo $task->phoneImei; ?></div>
                                              </div>
                                              <div class="row-table">
                                                <div class="col-table">Mật khẩu</div>
                                                <div class="col-table"><?php echo $task->phonePass; ?></div>
                                              </div>
											   <div class="row-table">
                                                <div class="col-table">Tình trạng lỗi</div>
                                                <div class="col-table"><strong><?php echo $task->phoneStatus; ?></strong></div>
                                              </div>
											 <div class="row-table">
                                                <div class="col-table">Phụ kiện</div>
                                                <div class="col-table"><?php echo $task->phoneSim; ?></div>
                                              </div>
                                              <div class="row-table">
                                                <div class="col-table">Lưu ý</div>
                                                <div class="col-table"><?php echo $task->notePrivate; ?></div>
                                              </div>
                                              <div class="row-table">
                                                <div class="col-table">Chi phí sửa chữa</div>
                                                <div class="col-table"><strong><?php echo is_numeric($task->phonePrice) ? number_format($task->phonePrice).' VND' : ($task->phonePrice == '' ? "Kiểm tra, báo giá trước khi sửa chữa" : $task->phonePrice); ?></strong></div>
                                              </div>
                                              <div class="row-table">
                                                <div class="col-table">Mã số dịch vụ</div>
                                                <div class="col-table"><?php echo $task->code; ?></div>
                                              </div>
                                              <div class="row-table">
                                                <div class="col-table">Thời gian nhận máy</div>
                                                <div class="col-table"><?php echo formatTime($task->created, true); ?></div>
                                              </div>
                                              <div class="row-table">
                                                <div class="col-table">Dự kiến sửa xong</div>
                                                <div class="col-table"><strong><?php echo formatTime($task->warrantyPeriodEnd); ?></strong></div>
                                              </div>
                                        </section>
                                        </div>
                                        <div class="right">
                                            <p><b>Lưu ý:</b></p>
                                            <p>- Quý Khách Hàng sử dụng phiếu này để nhận lại máy sửa chữa. Nếu bị mất phiếu, vui lòng gọi ngay: <strong>0847 72 72 72</strong>.</p>
                                            <p>- Trường hợp máy treo logo, lên logo tắt, khi trả lại máy, có thể không trả lại được tình trạng ban đầu.</p>
											<p>- Biên nhận này có giá trị nhận lại máy trong thời gian <strong>30 ngày</strong>.</p>
                                            <p><b>Các trường hợp từ chối bảo hành:</b></p>
                                            <p>- Các chức năng Yes Mobile không sửa chữa.</p>
                                            <p>- Phiếu bảo hành không có dấu bảo hành, tem bảo hành bị tẩy xóa, chỉnh sửa, không còn nguyên vẹn.</p>
                                            <p>- Trong thời gian bảo hành: Máy đã từng qua sửa chữa, bị ẩm nước, biến dạng, cong vênh (rớt, va đập...).</p>
                                            <div class="footer">
                                                <p>Đại diện cửa hàng</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cl"></div>
                                <strong>Trân trọng cám ơn Quý khách hàng đã tin tưởng và sử dụng dịch vụ của Yes Mobile!</strong>
                                </div>
                                <div class="wrapper-print">
                                    <input id="btnSubmit" type="submit" value="Print" onclick="divPrint();" />
                                </div>
                                <script type="text/javascript">
                                      function divPrint() {
                                        var newWindow = window.open('','printwindow');
                                        newWindow.document.write('<html><head><title>In hóa đơn!</title>');
                                        newWindow.document.write('<link rel="stylesheet" type="text/css" href="http://dienthoaivungtau.com/assets/admin/assets/font/stylesheet.css" media="print">');
                                        newWindow.document.write('</head><body>');
                                        newWindow.document.write(document.getElementById("printTask").innerHTML);
                                        newWindow.document.write('</body></html>');
                                        newWindow.print();
                                        newWindow.close();
                                      }
                                </script>
                            </div>
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