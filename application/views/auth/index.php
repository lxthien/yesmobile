<?php
$page_link = base_url() . $this->uri->segment(1) . '/' . $this->uri->segment(2);
?>
<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center'>
    <tr>
        <td height='55' background='<?php echo RES_PATH; ?>images/panel/admin-blue_08.gif' valign='middle' style='padding-left:20px'>Users Management</td>
        <td align="right" background='<?php echo RES_PATH; ?>images/panel/admin-blue_08.gif' valign='middle' style='padding-right:10px'>&nbsp;</td>
    </tr>
</table>
<!--<p>Below is a list of the users.</p>-->

<div id="infoMessage"><?php echo $message; ?></div>

<table width="100%" cellspacing="0" cellpadding="5" align="center" border="0">
    <tr class="tr_title_bg">
        <td width="10%" class="td_title_main" align="left">First Name</td>
        <td width="10%" class="td_title_main" align="left">Last Name</td>
        <td width="10%" class="td_title_main" align="left">Username</td>
        <td width="25%" class="td_title_main" align="left">Email</td>
        <td width="15%" class="td_title_main" align="left">Groups</td>
        <td width="5%" class="td_title_main" align="left">Status</td>
        <td width="5%" class="td_title_main" align="left">Action</td>
    </tr>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user->first_name; ?></td>
            <td><?php echo $user->last_name; ?></td>
            <td><?php echo $user->username; ?></td>
            <td><?php echo $user->email; ?></td>
            <td>
                <?php foreach ($user->groups as $group): ?>
<!--                    <?php // echo anchor($page_link."/edit_group/" . $group->id, $group->name); ?><br />-->
                    <?php echo form_label($group->name); ?><br />
                <?php endforeach ?>
            </td>
            <td><?php echo ($user->active) ? anchor($page_link."/deactivate/" . $user->id, 'Active') : anchor($page_link."/activate/" . $user->id, 'Inactive'); ?></td>
            <td><?php echo anchor($page_link."/edit_user/" . $user->id, 'Edit'); ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<p><a href="<?php echo $page_link.'/create_user'; ?>">Create a new user</a> 
<!--    | <a href="<?php // echo $page_link.'/create_group'; ?>">Create a new group</a></p>-->