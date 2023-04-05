            <div class="clearfix"></div>
            <!--foter-->
            <div class="foter">
                <div class="row">
                    <div class="col-md-7">
                        <div class="add">
                            <ul class="footer-menu">
                                <li><a href="<?php echo base_url('gioi-thieu.html'); ?>">Về Chúng tôi</a></li>
                                <li><a href="<?php echo base_url('tuyen-dung.html'); ?>">Tuyển dụng</a></li>
                                <li><a href="<?php echo base_url('che-do-bao-hanh.html'); ?>">Chính sách bảo hành</a></li>
                                <li><a href="<?php echo base_url('chinh-sach-van-chuyen.html'); ?>">Khách hàng ở xa</a></li>
                                <li><a href="<?php echo base_url('lien-he'); ?>">Liên hệ</a></li>
                            </ul>
                            <ul class="category">
                                <li><a href="<?php echo base_url('dich-vu/ep-kinh-ep-man-hinh-cam-ung-dien-thoai-tai-ba-ria-vung-tau'); ?>" class="haslink ">Ép kính điện thoại</a></li>
                                <li><a href="<?php echo base_url('dich-vu/sua-dien-thoai-iphone-apple-tai-ba-ria-vung-tau'); ?>" class="haslink ">Sửa chữa iPhone </a></li>
                                <li><a href="<?php echo base_url('dich-vu/ep-kinh-ep-man-hinh-cam-ung-iphone-tai-ba-ria-vung-tau'); ?>" class="haslink ">Ép kính iPhone</a></li>
                                <li><a href="<?php echo base_url('dich-vu/thay-pin-dien-thoai-iphone-tai-ba-ria-vung-tau'); ?>" class="haslink ">Thay pin iPhone</a></li>
                                <li><a href="<?php echo base_url('dich-vu/ep-kinh-ep-man-hinh-cam-ung-samsung-tai-ba-ria-vung-tau'); ?>" class="haslink ">Ép kính Samsung</a></li>
                                <li><a href="<?php echo base_url('dich-vu/thay-man-hinh-dien-thoai-iphone-tai-ba-ria-vung-tau'); ?>" class="haslink ">Thay màn hình iPhone</a></li>
                                <li><a href="<?php echo base_url('dich-vu/ep-kinh-ep-man-hinh-cam-ung-dien-thoai-oppo-tai-ba-ria-vung-tau'); ?>" class="haslink ">Ép kính Oppo</a></li>
                                <li><a href="<?php echo base_url('dich-vu/sua-sac-dien-thoai-iphone-tai-ba-ria-vung-tau'); ?>" class="haslink ">Sửa lỗi sạc iPhone</a></li>
                                <li><a href="<?php echo base_url('dich-vu/ep-kinh-ep-man-hinh-cam-ung-nokia-tai-ba-ria-vung-tau'); ?>" class="haslink ">Ép kính Nokia</a></li>
                                <li><a href="<?php echo base_url('dich-vu/sua-loa-micro-dien-thoai-iphone-tai-ba-ria-vung-tau'); ?>" class="haslink ">Sửa loa iPhone</a></li>
                                <li><a href="<?php echo base_url('dich-vu/ep-kinh-ep-man-hinh-cam-ung-dien-thoai-xiaomi-tai-ba-ria-vung-tau'); ?>" class="haslink ">Ép kính Xiaomi</a></li>
                                <li><a href="<?php echo base_url('dich-vu/sua-main-iphone-tai-ba-ria-vung-tau'); ?>" class="haslink ">Sửa main iPhone</a></li>
                                <li><a href="<?php echo base_url('dich-vu/ep-kinh-ep-man-hinh-cam-ung-dien-thoai-sony-tai-ba-ria-vung-tau'); ?>" class="haslink ">Ép kính Sony</a></li>
                                <li><a href="<?php echo base_url('dich-vu/mo-khoa-tai-khoan-icloud-ipad-tai-ba-ria-vung-tau'); ?>" class="haslink ">Mở khóa iCloud iPad</a></li>
                            </ul>
                        </div>
                    </div>  
                    <div class="col-md-5">
                        <div class="footer-right">
                            <h3>Tài khoản thanh toán chính thức</h3>
                            <div class="footer-right-01">
                                <p>Vietcombank - Chi nhánh Vũng Tàu</p>
                                <p>Số TK: <b>10240 99999</b> - Chủ TK: <b>Nguyễn Văn Thành</b></p>
                            </div>
                            <div class="footer-right-01">
                                <p>MB Bank - Chi nhánh Vũng Tàu</p>
                                <p>Số TK: <b>0847 727272</b> - Chủ TK: <b>Nguyễn Văn Thành</b></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 footer-address text-left">
                        <p>Yes Mobile | Sửa chữa điện thoại từ 2010</p>
                        <p><b>Cửa hàng 1:</b> <?php echo $this->sconfig->get_value('address');?></p>
                        <p><b>Cửa hàng 2:</b> Đường 28/4, Thôn 6, X.Long Sơn, TP.Vũng Tàu, Bà Rịa - Vũng Tàu</p>
                        <p>Điện thoại: <?php echo $this->sconfig->get_value('TEL');?> - Hotline: <?php echo $this->sconfig->get_value('FAX');?></p>
                        <p>Email: <?php echo $this->sconfig->get_value('CONTACT_EMAIL');?> - Website: <?php echo base_url(); ?></p>
						</br>
                    </div>
                </div>
            </div>
            <!--end foter-->
        </div>
        <!--end main-->
     </div>
    <!--end wrap-->
    
<!-- Load Facebook SDK for JavaScript -->
      <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v7.0'
          });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>

      <!-- Your customer chat code -->
      <div class="fb-customerchat"
        attribution=setup_tool
        page_id="355967864486249"
        theme_color="#000080">
      </div>

    <!--jQuery caroufredsel-->
    <script src="<?php echo base_url(); ?>assets/js/jquery.carouFredSel-5.6.4-packed.js"></script>

    <!--jQuery Nivo Slider-->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.nivo.slider.js"></script>

    <!--jQuery Mobile Detect-->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/detectmobilebrowser.js"></script>

    <!-- Product detail page -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo RES_PATH; ?>css/prettyPhoto.css"/>
    <script type="text/javascript" src="<?php echo RES_PATH; ?>js/jquery.prettyPhoto.js"></script>
    <script type="text/javascript" src="<?php echo RES_PATH; ?>js/functions.js"></script>
    
    <!-- Custom JS -->
    <script src="<?php echo base_url(); ?>assets/js/app.js?v=<?php echo time(); ?>"></script>

    <!-- JS Bootstrap -->
    <!-- <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>