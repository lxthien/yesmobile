<?php
    $currentUser = $this->ion_auth->user()->row();
    $currentSection = $this->uri->segment(1);
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
                <a href="<?php echo base_url(); ?>" class="navbar-brand"><img src="<?php echo base_url().'assets/admin'; ?>/assets/img/logo.png" alt=""></a>
            </header>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <!-- Menu chính (trước đây nằm ở cột trái) -->
                <ul class="nav navbar-nav top-menu">
                    <li class="dropdown<?php echo $currentSection == 'tasks' ? ' active' : ''; ?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="fa fa-table"></i>&nbsp; Yêu cầu <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo base_url().'tasks/add'; ?>"><i class="fa fa-angle-right"></i>&nbsp; Thêm mới</a></li>
                            <li><a href="<?php echo base_url().'tasks/listTask'; ?>"><i class="fa fa-angle-right"></i>&nbsp; Máy đang sửa chữa</a></li>
                            <?php if ($this->ion_auth->in_group('admin_shop')) { ?>
                            <li><a href="<?php echo base_url().'tasks/listToday'; ?>"><i class="fa fa-angle-right"></i>&nbsp; Danh thu theo ngày</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li class="dropdown<?php echo $currentSection == 'customers' ? ' active' : ''; ?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="fa fa-users"></i>&nbsp; Khách hàng <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo base_url().'customers/index'; ?>"><i class="fa fa-angle-right"></i>&nbsp; Danh sách khách hàng</a></li>
                            <li><a href="<?php echo base_url().'customers/add'; ?>"><i class="fa fa-angle-right"></i>&nbsp; Thêm mới khách hàng</a></li>
                        </ul>
                    </li>
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
