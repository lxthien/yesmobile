<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!--IE Compatibility modes-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Mobile first-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Trang chủ | Phần mềm quản lý công việc nội bộ | Yes Mobile</title>

    <meta name="description" content="Hệ thống quản lý công việc nội bộ của Yes Mobile | Hệ thống sửa chữa điện thoại từ 2010.">
    <meta name="author" content="Yes Mobile">

    <meta name="msapplication-TileColor" content="#5bc0de" />
    <meta name="msapplication-TileImage" content="assets/admin/assets/img/logo2.png" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/admin'; ?>/assets/lib/bootstrap/css/bootstrap.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/admin'; ?>/assets/lib/font-awesome/css/font-awesome.css">

    <!-- Metis core stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/admin'; ?>/assets/css/main.css">

    <!-- metisMenu stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/admin'; ?>/assets/lib/metismenu/metisMenu.css">

    <!-- onoffcanvas stylesheet -->
    <!-- <link rel="stylesheet" href="<?php echo base_url().'assets/admin'; ?>/assets/lib/onoffcanvas/onoffcanvas.css"> -->

    <!-- animate.css stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/admin'; ?>/assets/lib/animate.css/animate.css">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="dashboard">
    <div class="dashboard-header">
        <div class="dashboard">
            <a href="<?php echo base_url(); ?>" target="_blank">
                <img src="<?php echo base_url().'assets/admin'; ?>/assets/img/logo.png" alt="Yes Mobile">
            </a>
            <h1>Đoàn kết là sức mạnh</h1>
        </div>
    </div>
    <div class="dashboard-body">
        <div class="dashboard">
            <div class="text-center">
                <h1><b>PHẦN MỀM QUẢN LÍ CÔNG VIỆC NỘI BỘ</b></h1>
                <p>Yes Mobile được thành lập từ 03/2010</p>
                <p>Đang có <span><?php echo $countCustomer; ?>+</span> Khách hàng, đã sửa hoàn thành <span><?php echo $countTasks; ?>+</span> thiết bị <i>(từ 06/2017)</i></p>
            </div>
            <div class="tab-content">
                <div class="row">
                    <div class="col-md-6 col-link-left">
                        <div class="row link">
                            <div class="col-md-6">
                                <a href="<?php echo base_url().'tasks/listTask'; ?>" target="_blank">
                                    Máy đang sửa chữa
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="<?php echo base_url().'tasks/add'; ?>" target="_blank">
                                Thêm dịch vụ mới
                                </a>
                            </div>
                        </div>
                        <div class="row link">
                            <div class="col-md-6">
                                <a href="<?php echo base_url().'customers/index'; ?>" target="_blank">
                                    Danh sách khách hàng
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="<?php echo base_url().'customers/add'; ?>" target="_blank">
                                Thêm khách hàng mới
                                </a>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <p><b>LƯU Ý VỀ BẢO HÀNH</b></p>
                                <p><span>- <b>Pin iPhone, ép kính</b> bảo hành 12 tháng.</span></p>
								<p><span>- <b>Pin Android, iPad</b> bảo hành 6 tháng.</span></p>
                                <p><span>- <b>Màn hình iPhone, cảm ứng iPad</b> bảo hành 6 tháng. </span></p>
								<p><span>- <b>Màn hình, cảm ứng Android, ép cảm ứng</b> bảo hành 3 tháng.</span></p>
                                <p><span>- <b>Sửa chữa (không liên quan đến ic)</b>, bảo hành 6 tháng.</span></p>
                                <p><span>- <b>Sửa chữa liên quan đến ic</b> bảo hành 2-3 tháng.</span></p>
								<p><span>- Máy rớt nước: Nếu máy vệ sinh không lên thì <b>không lấy tiền</b>. Vệ sinh lên, còn lỗi thì tư vấn khách hàng về địa phương sửa. Nếu khách vẫn muốn sửa thì nhận lại, sửa xong mình chuyển phát nhanh.</span></p>
                                <p><span>Xem thêm về</span> <a target="_blank" href="<?php echo base_url().'che-do-bao-hanh.html'; ?>"><b><u>Chế độ bảo hành</u></b></a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
						<p><b>LƯU Ý QUAN TRỌNG</b></p>
                        <p><span><b>- Khi nhận máy:</b></span> lấy mật khẩu, nhất là máy mất nguồn, không lên màn hình.</p>
                        <p><span><b>- BP.Kỹ thuật:</b></span> Trả lại linh kiện cũ cho khách, sạc pin sau khi sửa xong.</p>
						<br>
					    <p><b>LINH KIỆN</b></p>
                        <p><span><b>- Thành Tuyên:</b></span> Giao hàng lúc 10h30, 16h30 mỗi ngày</p>
                        <p><span><b>- Minh Phát, Quốc Tuấn:</b></span> Có thể giao ngay</p>
						<p><span><b>- Đặt hàng BR:</b></span> Có hàng trong ngày, lấy hàng tài xế.</p>
                        <p><span><b>- Phương Trang:</b></span> Anh Thành đặt, <b>đặt trước 18h</b>, lấy hàng đường XVNT. Mang theo CMND và đọc số 0847.727272</p>
                        <p><span><b>- Đặt hàng SG:</b></span> Anh Thành đặt, <b>đặt trước 17h30</b>, sáng hôm sau khoảng 8-9h có hàng ở Hoa Mai - 154 Bình Giã. Lấy hàng đọc số 0847.727272</p>
              
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dashboard-footer">
        <div class="dashboard">
            <p><b>Yes Mobile | Sửa chữa điện thoại từ 2010</b></p>
            <p><span>Cửa hàng 1: 438 Trương Công Định, Phường 8, TP.Vũng Tàu</span></p>
            <p><span>Cửa hàng 2: Đường 28/4, Thôn 6, X.Long Sơn, TP.Vũng Tàu</span></p>
            <p><span>Điện thoại: (0254) 6 557 999 - Hotline: 0847.727272</span></p>
            <p><span>Email: yesmobile.vn@gmail.com - Website: https://yesmobile.vn/</span></p>

            <a href="https://www.facebook.com/YesMobile.vn" target="_blank">
                <img src="<?php echo base_url().'assets/admin'; ?>/assets/img/facebook-icon.png" alt="Facebook">
            </a>
        </div>
    </div>

    <style>
        body {
            margin: 0;
        }

        div.dashboard {
            width: 900px;
            margin: 0 auto;
        }
        .dashboard-header {
            height: 50px;
            background: #000080;
            display: block;
        }
        .dashboard-header .dashboard {
            padding: 0px 135px;
        }
        .dashboard-header a img {
            display: inline-block;
            padding: 10px 0;
            height: 50px;
        }

        .dashboard-header h1 {
            display: inline-block;
            float: right;
            color: #ffffff;
            font-size: 20px;
            margin: 14px 0;
        }

        .dashboard-body {

        }

        .text-center h1 {
            color: #000080;
            font-size: 25px;
            margin-bottom: 15px;
        }
        .text-center p {
            color: #000080;
            font-size: 20px;
        }
        .text-center p span{
            color: red;
        }
        .text-center p i{
            font-size: 19px;
        }

        .tab-content {
            margin-top: 40px;
            padding-bottom: 20px;
        }
        .tab-content .col-link-left {
            border-right: 2px solid #000;
        }

        .link .col-md-6 a {
            display: block;
            background: #000080;
            padding: 10px 0;
            text-align: center;
            color: #ffffff;
            margin-bottom: 20px;
        }


        .dashboard-footer {
            background: #000080;
            padding: 25px 20px 5px;
            color: #fff;
        }
        .dashboard-footer .dashboard {
            position: relative;
        }
        .dashboard-footer a {
            position: absolute;
            right: 10px;
            top: 35%;
        }
        .dashboard-footer a img {
            width: 60px;
        }
    </style>

    <!--jQuery -->
    <script src="<?php echo base_url().'assets/admin'; ?>/assets/lib/jquery/jquery.js"></script>

    <!--Bootstrap -->
    <script src="<?php echo base_url().'assets/admin'; ?>/assets/lib/bootstrap/js/bootstrap.js"></script>


    <script type="text/javascript">
        (function($) {
            $(document).ready(function() {
                $('.list-inline li > a').click(function() {
                    var activeForm = $(this).attr('href') + ' > form';
                    //console.log(activeForm);
                    $(activeForm).addClass('animated fadeIn');
                    //set timer to 1 seconds, after that, unload the animate animation
                    setTimeout(function() {
                        $(activeForm).removeClass('animated fadeIn');
                    }, 1000);
                });
            });
        })(jQuery);
    </script>
</body>

</html>