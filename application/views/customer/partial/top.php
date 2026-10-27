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
    // Báo cáo (chỉ admin_shop): gom vào 1 menu thả xuống cho thanh top gọn 1 hàng
    $reportLinks = array();
    if ($this->ion_auth->in_group('admin_shop')) {
        $reportLinks = array(
            'tasks/listtoday' => array('tasks/listToday', 'Doanh thu theo ngày'),
            'tasks/statistics' => array('tasks/statistics', 'Thống kê tháng'),
            'tasks/categories' => array('tasks/categories', 'Danh mục thống kê'),
        );
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
                    <?php if ($reportLinks) { ?>
                    <li class="top-menu-group dropdown">
                        <a href="#" class="dropdown-toggle<?php echo isset($reportLinks[$currentPage]) ? ' active' : ''; ?>" data-toggle="dropdown" role="button" aria-expanded="false">
                            <?php echo isset($reportLinks[$currentPage]) ? $reportLinks[$currentPage][1] : 'Báo cáo'; ?> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu top-menu-dropdown" role="menu">
                            <?php foreach ($reportLinks as $pageKey => $link) { ?>
                            <li class="<?php echo $currentPage == $pageKey ? 'active' : ''; ?>"><a href="<?php echo base_url($link[0]); ?>"><?php echo $link[1]; ?></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php } ?>
                </ul>
                <!-- Người dùng + đăng xuất -->
                <ul class="nav navbar-nav navbar-right top-user">
                    <li class="top-user-greeting">
                        <span>Chào</span>
                        <b class="top-user-name"><?php echo $currentUser ? $currentUser->first_name.' '.$currentUser->last_name : ''; ?></b>
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
