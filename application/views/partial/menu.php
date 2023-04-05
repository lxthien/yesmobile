<!--menu-->
<div class="row">
    <div class="headter-top col-md-12" id="nav">
        <nav class="navbar navbar-expand-lg container justify-content-between">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand d-block d-sm-none" href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url().'assets/images/logo-mobile.png'; ?>" height="25" class="d-inline-block" alt="Yes Mobile">
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link home <?php echo $this->menu_active == 'home' ? 'active' : ''; ?>" href="<?php echo base_url(); ?>">
                            <img src="<?php echo base_url('assets/images/icon-home.png'); ?>" alt="Yes Mobile">
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo $this->menu_active == 'services' ? 'active' : ''; ?>" href="<?php echo base_url('dich-vu-sua-chua-dien-thoai.html'); ?>">Dịch vụ sửa chữa</a>
                        <span class="drop-down"><span class="icon-drop-down"></span></span>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php foreach ($menuCategoryService as $service): ?>
                                <li class="dropdown-item">
                                    <a class="nav-link" href="<?php echo base_url('dich-vu/' . $service['link_rewrite']); ?>">
                                        <?php echo $service['name']; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo $this->menu_active == 'accessories' ? 'active' : ''; ?>" href="<?php echo base_url('san-pham/phu-kien-dien-thoai'); ?>">Phụ kiện</a>
                        <span class="drop-down"><span class="icon-drop-down"></span></span>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li class="dropdown-item">
                                <a class="nav-link" href="<?php echo base_url('san-pham/phu-kien/pin-sac-cap'); ?>" class="haslink ">Sạc - Cáp</a>
                            </li>
                            <li class="dropdown-item">
                                <a class="nav-link" href="<?php echo base_url('san-pham/phu-kien/tai-nghe'); ?>" class="haslink ">Tai nghe</a>
                            </li>
                            <li class="dropdown-item">
                                <a class="nav-link" href="<?php echo base_url('san-pham/phu-kien/sac-du-phong'); ?>" class="haslink ">Sạc dự phòng</a>
                            </li>
                            <li class="dropdown-item">
                                <a class="nav-link" href="<?php echo base_url('san-pham/phu-kien/phu-kien-khac'); ?>" class="haslink ">Phụ kiện khác</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $this->menu_active == 'bao-hanh' ? 'active' : ''; ?>" href="<?php echo base_url('thong-tin-bao-hanh'); ?>">Kiểm tra bảo hành</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo $this->menu_active == 'news' ? 'active' : ''; ?>" href="<?php echo base_url('tin-tuc'); ?>">Tin tức</a>
                        <span class="drop-down"><span class="icon-drop-down"></span></span>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li class="dropdown-item">
                                <a class="nav-link" href="<?php echo base_url('tin-tuc/san-pham-moi'); ?>" class="haslink ">Sản phẩm mới</a>
                            </li>
                            <li class="dropdown-item">
                                <a class="nav-link" href="<?php echo base_url('tin-tuc/thong-tin-cong-nghe'); ?>" class="haslink ">Thông tin công nghệ</a>
                            </li>
                            <li class="dropdown-item">
                                <a class="nav-link" href="<?php echo base_url('tin-tuc/tin-tuc-yes-mobile'); ?>" class="haslink ">Tin tức Yes Mobile</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo $this->menu_active == 'guides' ? 'active' : ''; ?>" href="<?php echo base_url('cam-nang'); ?>">Cẩm nang</a>
                        <span class="drop-down"><span class="icon-drop-down"></span></span>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li class="dropdown-item">
                                <a class="nav-link" href="<?php echo base_url('cam-nang/cam-nang-android'); ?>" class="haslink ">Cẩm nang Android</a>
                            </li>
                            <li class="dropdown-item">
                                <a class="nav-link" href="<?php echo base_url('cam-nang/cam-nang-ios'); ?>" class="haslink ">Cẩm nang iOS</a>
                            </li>
                            <li class="dropdown-item">
                                <a class="nav-link" href="<?php echo base_url('cam-nang/cam-nang-dien-thoai'); ?>" class="haslink ">Cẩm nang điện thoại</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $this->menu_active == 'contact' ? 'active' : ''; ?>" href="<?php echo base_url('lien-he'); ?>">Liên hệ</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>