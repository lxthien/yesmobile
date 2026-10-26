<?php
    $currentUser = $this->ion_auth->user()->row();
    // Trang đang mở (controller/method) để in đậm link tương ứng trên menu
    $currentPage = strtolower($this->router->fetch_class() . '/' . $this->router->fetch_method());
    $menuGroups = array(
        array(
            'tasks/listtask' => array('tasks/listTask', 'Máy đang sửa chữa'),
            'tasks/add' => array('tasks/add', 'Thêm mới'),
        ),
        array(
            'customers/add' => array('customers/add', 'Thêm mới Khách hàng'),
            'customers/index' => array('customers/index', 'Danh sách Khách hàng'),
        ),
    );
    if ($this->ion_auth->in_group('admin_shop')) {
        $menuGroups[] = array('tasks/listtoday' => array('tasks/listToday', 'Doanh thu theo ngày'));
    }
?>
<div id="top">
    <!-- .navbar -->
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <header class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="<?php echo base_url('tasks/listTask'); ?>" class="navbar-brand"><img src="<?php echo base_url().'assets/admin'; ?>/assets/img/logo.png" alt=""></a>
            </header>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <!-- Menu chính dàn ngang: các nhóm link, trong nhóm cách nhau bởi "|"; trang đang mở in đậm -->
                <ul class="nav navbar-nav top-menu">
                    <?php foreach ($menuGroups as $group) { ?>
                    <li class="top-menu-group">
                        <?php $first = true; foreach ($group as $pageKey => $link) { ?>
                            <?php if (!$first) { ?><span class="top-menu-sep">|</span><?php } $first = false; ?>
                            <a href="<?php echo base_url($link[0]); ?>" class="<?php echo $currentPage == $pageKey ? 'active' : ''; ?>"><?php echo $link[1]; ?></a>
                        <?php } ?>
                    </li>
                    <?php } ?>
                </ul>
                <!-- Người dùng + đăng xuất -->
                <ul class="nav navbar-nav navbar-right top-user">
                    <li class="top-user-greeting">
                        <span>Chào</span>
                        <a href="<?php echo base_url('panel/change-password'); ?>" title="Đổi mật khẩu"><?php echo $currentUser ? $currentUser->first_name.' '.$currentUser->last_name : ''; ?></a>
                    </li>
                    <li class="top-user-logout">
                        <a href="<?php echo base_url('panel/logout'); ?>" data-toggle="tooltip" data-original-title="Logout" data-placement="bottom"
                           class="btn btn-metis-1 btn-sm">
                            <i class="fa fa-power-off"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /.container-fluid -->
    </nav>
    <!-- /.navbar -->
</div>
