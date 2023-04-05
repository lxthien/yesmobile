<?php
$link = base_url('panel');
?>

<table width='100%' border='0' cellpadding='0' cellspacing='0' align='center'>
    <tr><td align='center' height='55' background='<?php echo RES_PATH; ?>images/panel/admin-blue_07.gif' style='background-repeat:no-repeat'>Hi, <?php echo $this->session->userdata('username'); ?>
            <B><font color='#FF0000'><?php // echo @$_SESSION["currentuserfull"];    ?></font></B>
            <BR>[ <a href='<?php echo base_url($this->uri->segment(1) . '/change-password'); ?>'>Change password</a> ] [ <a href='<?php echo base_url($this->uri->segment(1) . '/logout'); ?>'>Logout</a> ]</td></tr>
</table>
<table width='100%' border="0" cellspacing='0' cellpadding='0' align='center'>
    <tr><td><img src='<?php echo RES_PATH ?>images/panel/admin-blue_10.gif' width='194' height='30'></td></tr>

    <!-- start each element : gioi thieu -->
    <tr>
        <td height='25' background='<?php echo RES_PATH; ?>images/panel/admin-blue_15.gif' style='padding-left:12px'>
            <img src='<?php echo RES_PATH ?>images/panel/detail_07.gif' width='8' height='7' align="absmiddle">&nbsp;&nbsp;
            <a href='<?php echo $link . '/admin_news/edit/' . COMPANY_INSTRODUCE_NEWS_ID; ?>'>Giới thiệu</a>
        </td>
    </tr>
    <tr><td><img src='<?php echo RES_PATH; ?>images/panel/admin-blue_13.gif' width='194' height='1'></td></tr>
    <!--end gioi thieu-->        
    
    <!-- start each element : site map -->
    <!--tr>
        <td height='25' background='<?php echo RES_PATH; ?>images/panel/admin-blue_15.gif' style='padding-left:12px'>
            <img src='<?php echo RES_PATH ?>images/panel/detail_07.gif' width='8' height='7' align="absmiddle">&nbsp;&nbsp;
            <a href='<?php echo $link . '/admin_news/edit/' . SITE_MAP; ?>'>Site map</a>
        </td>
    </tr>
    <tr><td><img src='<?php echo RES_PATH; ?>images/panel/admin-blue_13.gif' width='194' height='1'></td></tr>
    <!--end site map-->

    <tr>
        <td height='25' background='<?php echo RES_PATH; ?>images/panel/admin-blue_15.gif' style='padding-left:12px'>
            <img src='<?php echo RES_PATH ?>images/panel/detail_07.gif' width='8' height='7' align="absmiddle">&nbsp;&nbsp;
            <a href='<?php echo $link . '/admin_category/index/'; ?>'>Quản lí danh mục</a>
        </td>
    </tr>
    <tr><td><img src='<?php echo RES_PATH; ?>images/panel/admin-blue_13.gif' width='194' height='1'></td></tr>
    
    <!-- start each element : dich vu sua chua -->
    <tr>
        <td height='25' background='<?php echo RES_PATH; ?>images/panel/admin-blue_15.gif' style='padding-left:12px'>
            <img src='<?php echo RES_PATH ?>images/panel/detail_07.gif' width='8' height='7' align="absmiddle">&nbsp;&nbsp;
            <a href='<?php echo $link . '/admin_news/edit/' . SERVICES; ?>'>Trang sửa chữa</a>
        </td>
    </tr>
    <tr><td><img src='<?php echo RES_PATH; ?>images/panel/admin-blue_13.gif' width='194' height='1'></td></tr>

    <tr>
        <td height='25' background='<?php echo RES_PATH; ?>images/panel/admin-blue_15.gif' style='padding-left:12px'>
            <img src='<?php echo RES_PATH ?>images/panel/detail_07.gif' width='8' height='7' align="absmiddle">&nbsp;&nbsp;
            <a href='<?php echo $link . '/admin_services/'; ?>'>Danh sách dịch vụ </a>
        </td>
    </tr>
    <tr><td><img src='<?php echo RES_PATH; ?>images/panel/admin-blue_13.gif' width='194' height='1'></td></tr>
    <!--end dich vu sua chua-->
	
	<!-- start each element : dich vu sua chua -->
    <tr>
        <td height='25' background='<?php echo RES_PATH; ?>images/panel/admin-blue_15.gif' style='padding-left:12px'>
            <img src='<?php echo RES_PATH ?>images/panel/detail_07.gif' width='8' height='7' align="absmiddle">&nbsp;&nbsp;
            <a href='<?php echo $link . '/admin_news/edit/' . EPKINH; ?>'>Ép kính điện thoại</a>
        </td>
    </tr>
    <tr><td><img src='<?php echo RES_PATH; ?>images/panel/admin-blue_13.gif' width='194' height='1'></td></tr>

    <!-- start each element : che do bao hanh -->
    <tr>
        <td height='25' background='<?php echo RES_PATH; ?>images/panel/admin-blue_15.gif' style='padding-left:12px'>
            <img src='<?php echo RES_PATH ?>images/panel/detail_07.gif' width='8' height='7' align="absmiddle">&nbsp;&nbsp;
            <a href='<?php echo $link . '/admin_news/edit/' . WARRANTY; ?>'>Chế độ bảo hành</a>
        </td>
    </tr>
    <tr>
        <td><img src='<?php echo RES_PATH; ?>images/panel/admin-blue_13.gif' width='194' height='1'></td>
    </tr>
    <!--end che do bao hanh-->
    <!-- start each element : che do bao hanh -->
    <tr>
        <td height='25' background='<?php echo RES_PATH; ?>images/panel/admin-blue_15.gif' style='padding-left:12px'>
            <img src='<?php echo RES_PATH ?>images/panel/detail_07.gif' width='8' height='7' align="absmiddle">&nbsp;&nbsp;
            <a href='<?php echo $link . '/admin_news/edit/' . RECRUIT; ?>'>Tuyển dụng</a>
        </td>
    </tr>
    <tr>
        <td><img src='<?php echo RES_PATH; ?>images/panel/admin-blue_13.gif' width='194' height='1'></td>
    </tr>
    <!--end che do bao hanh-->
	
    <!--
    <tr>
        <td height='20' background='<?php echo RES_PATH; ?>images/panel/admin-blue_15.gif' style='padding-left:12px'>
            <img src='<?php echo RES_PATH ?>images/panel/detail_07.gif' width='8' height='7' align="absmiddle">&nbsp;&nbsp;
            <a href='<?php echo $link . '/admin_news/edit/' . WARRANTYPOLICY; ?>'>Chính sách bảo hành</a>
        </td>
    </tr>
    <tr>
        <td><img src='<?php echo RES_PATH; ?>images/panel/admin-blue_13.gif' width='194' height='1'></td>
    </tr>
    -->
	
    <!-- start each element : che do bao hanh -->
    <tr>
        <td height='25' background='<?php echo RES_PATH; ?>images/panel/admin-blue_15.gif' style='padding-left:12px'>
            <img src='<?php echo RES_PATH ?>images/panel/detail_07.gif' width='8' height='7' align="absmiddle">&nbsp;&nbsp;
            <a href='<?php echo $link . '/admin_news/edit/' . DELEVERYPOLICY; ?>'>Khách hàng ở xa</a>
        </td>
    </tr>
    <tr>
        <td><img src='<?php echo RES_PATH; ?>images/panel/admin-blue_13.gif' width='194' height='1'></td>
    </tr>
    <!--end che do bao hanh-->
    
    <tr>
        <td height='25' background='<?php echo RES_PATH; ?>images/panel/admin-blue_15.gif' style='padding-left:12px'>
            <img src='<?php echo RES_PATH ?>images/panel/detail_07.gif' width='8' height='7' align="absmiddle">&nbsp;&nbsp;
            <a href='<?php echo $link . '/admin_news' ?>'>Tin tức</a>
        </td>
    </tr>
    <tr>
        <td><img src='<?php echo RES_PATH; ?>images/panel/admin-blue_13.gif' width='194' height='1'></td>
    </tr>
    <!-- end each element -->
    
    <!-- start each element : y kien khach hang -->
    <!--tr>
        <td height='20' background='<?php //echo RES_PATH; ?>images/panel/admin-blue_15.gif' style='padding-left:12px'>
            <img src='<?php //echo RES_PATH; ?>images/panel/detail_07.gif' width='8' height='7' align="absmiddle">&nbsp;&nbsp;
            <a href='<?php //echo $link . '/admin_feedback'; ?>'>Ã� kiáº¿n khÃ¡ch hÃ ng</a>
        </td>
    </tr>
    <tr><td><img src='<?php //echo RES_PATH ?>images/panel/admin-blue_13.gif' width='194' height='1'></td></tr-->
    <!-- end each element -->

    <!--
    <tr>
        <td height='20' background='<?php echo RES_PATH; ?>images/panel/admin-blue_15.gif' style='padding-left:12px'>
            <img src='<?php echo RES_PATH; ?>images/panel/detail_07.gif' width='8' height='7' align="absmiddle">&nbsp;&nbsp;
            <a href='<?php echo base_url('panel/admin_download'); ?>'>Download</a>
        </td>
    </tr>
    <tr>
        <td><img src='<?php echo RES_PATH ?>images/panel/admin-blue_13.gif' width='194' height='1'></td>
    </tr>
    -->

    <!-- 
    <tr>
        <td height='20' background='<?php echo RES_PATH ?>images/panel/admin-blue_15.gif' style='padding-left:12px'>
            <img src='<?php echo RES_PATH ?>images/panel/detail_07.gif' width='8' height='7' align="absmiddle">&nbsp;&nbsp;
            <a href='<?php echo $link . '/admin_partner'; ?>'>Khách hàng</a>
        </td>
    </tr>

    <tr><td><img src='<?php echo RES_PATH ?>images/panel/admin-blue_13.gif' width='194' height='1'></td></tr>
    -->

    <!-- start element: Hinh anh -->
    <!--tr>
        <td height='20' background='<?php //echo RES_PATH ?>images/panel/admin-blue_15.gif' style='padding-left:12px'>
            <img src='<?php //echo RES_PATH ?>images/panel/detail_07.gif' width='8' height='7' align="absmiddle">&nbsp;&nbsp;
            <a href='<?php //echo base_url('panel/gallery'); ?>'>HÃ¬nh áº£nh</a>
        </td>
    </tr>
    <tr><td><img src='<?php//echo RES_PATH; ?>images/panel/admin-blue_13.gif' width='194' height='1'></td></tr-->
    <!-- end element -->

    <!-- 
    <tr>
        <td height='20' background='<?php echo RES_PATH; ?>images/panel/admin-blue_15.gif' style='padding-left:12px'>
            <img src='<?php echo RES_PATH; ?>images/panel/detail_07.gif' width='8' height='7' align="absmiddle">&nbsp;&nbsp;
            <a href='<?php echo $link . '/contact' ?>'>Hỗ trợ trực tuyến</a>
        </td>
    </tr>
    <tr><td><img src='<?php echo RES_PATH; ?>images/panel/admin-blue_13.gif' width='194' height='1'></td></tr>
    <!-- end element -->

    <!-- start element: User -->
    <tr>
        <td height='25' background='<?php echo RES_PATH ?>images/panel/admin-blue_15.gif' style='padding-left:12px'>
            <img src='<?php echo RES_PATH ?>images/panel/detail_07.gif' width='8' height='7' align="absmiddle">&nbsp;&nbsp;
            <a href='<?php echo base_url('panel/config'); ?>'>Configuration</a>
        </td>
    </tr>
    <tr><td><img src='<?php echo RES_PATH ?>images/panel/admin-blue_13.gif' width='194' height='1'></td></tr>
    <!-- end element -->

    <!-- 
    <tr>
        <td height='20' background='<?php echo RES_PATH ?>images/panel/admin-blue_15.gif' style='padding-left:12px'>
            <img src='<?php echo RES_PATH ?>images/panel/detail_07.gif' width='8' height='7' align="absmiddle">&nbsp;&nbsp;
            <a href='<?php echo $link.'/admin_advertise'; ?>'>Advertise</a>
        </td>
    </tr>
    <tr><td><img src='<?php echo RES_PATH ?>images/panel/admin-blue_13.gif' width='194' height='1'></td></tr>
    -->

    <!-- start element: Advertise -->
    <tr>
        <td height='25' background='<?php echo RES_PATH ?>images/panel/admin-blue_15.gif' style='padding-left:12px'>
            <img src='<?php echo RES_PATH ?>images/panel/detail_07.gif' width='8' height='7' align="absmiddle">&nbsp;&nbsp;
            <a href='<?php echo $link.'/admin_banner'; ?>'>Banner</a>
        </td>
    </tr>
    <tr><td><img src='<?php echo RES_PATH ?>images/panel/admin-blue_13.gif' width='194' height='1'></td></tr>
    <!-- end element -->
    
    <!-- 
    <?php if ($this->ion_auth->is_admin()): ?>
        <tr>
            <td height='20' background='<?php echo RES_PATH ?>images/panel/admin-blue_15.gif' style='padding-left:12px'>
                <img src='<?php echo RES_PATH ?>images/panel/detail_07.gif' width='8' height='7' align="absmiddle">&nbsp;&nbsp;
                <a href='<?php echo $link . '/auth'; ?>'>User</a>
            </td>
        </tr>
        <tr><td><img src='<?php echo RES_PATH ?>images/panel/admin-blue_13.gif' width='194' height='1'></td></tr>
    <?php endif ?>
    -->
	
    <!-- start element: mobile phone -->
    <?php if ($this->ion_auth->is_admin()): ?>
        <tr>
            <td height='25' background='<?php echo RES_PATH ?>images/panel/admin-blue_15.gif' style='padding-left:12px'>
                <img src='<?php echo RES_PATH ?>images/panel/detail_07.gif' width='8' height='7' align="absmiddle">&nbsp;&nbsp;
                <a href='<?php echo $link . '/admin_phone'; ?>'>Phụ kiện</a>
            </td>
        </tr>
        <tr><td><img src='<?php echo RES_PATH ?>images/panel/admin-blue_13.gif' width='194' height='1'></td></tr>
    <?php endif ?>
    <!-- end element -->
    
    <?php if ($this->ion_auth->is_admin()): ?>
        <tr>
            <td height='25' background='<?php echo RES_PATH ?>images/panel/admin-blue_15.gif' style='padding-left:12px'>
                <img src='<?php echo RES_PATH ?>images/panel/detail_07.gif' width='8' height='7' align="absmiddle">&nbsp;&nbsp;
                <a href='<?php echo $link . '/admin_category_phone'; ?>'>Danh mục phụ kiện</a>
            </td>
        </tr>
        <tr><td><img src='<?php echo RES_PATH ?>images/panel/admin-blue_13.gif' width='194' height='1'></td></tr>
    <?php endif ?>

</table>