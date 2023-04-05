<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center'>
    <tr>
        <td height='55' background='<?php echo RES_PATH; ?>images/panel/admin-blue_08.gif' valign='middle' style='padding-left:20px'>Change password</td>        
        <td align="right" background='<?php echo RES_PATH; ?>images/panel/admin-blue_08.gif' valign='middle' style='padding-right:10px'>&nbsp;</td>
    </tr>
    <tr>
        <td cols ="2"><div id="infoMessage"><?php echo $message; ?></div></td>
    </tr>
</table>
</br>
<table width="80%" border="0" cellspacing="0" cellpadding="5" align="left">            
    <?php echo form_open(base_url($this->uri->segment(1) . "/change-password")); ?>
    <tr>
        <td align="right" valign="top" width="30%"><div class ="field_name">Old password</div></td>
        <td>
            <?php
            $old_password['style'] = 'width:300px';
            $old_password['class'] = 'form';
            echo form_input($old_password);
            ?>            
        </td>
    </tr>
    <tr>
        <td align="right" valign="top" width="10%" style="line-height: 8px;"><div class ="field_name">New Password</div></br>(at least <?php echo $min_password_length; ?> characters long)</td>
        <td>
            <?php
            $new_password['class'] = 'form';
            $new_pasword['style'] = 'width:300px';
            echo form_input($new_password);
            ?>            
        </td>
    </tr>
    <tr>
        <td align="right" valign="top" width="10%"><div class ="field_name">Confirm New Password</div></td>
        <td>
            <?php
//            $data = array(
//                'name' => 'new_password_confirm',
//                'id' => 'new_password_confirm',
//                'value' => '',
//                'style' => 'width:300px',
//                'class' => 'form'
//            );
//            echo form_password($data);
            $new_password_confirm['style'] = 'width:300px';
            $new_password_confirm['class'] = 'form';
            echo form_input($new_password_confirm);
            ?>            
        </td>
    </tr>    
    <tr>

        <td align="right" valign="top"><?php echo form_input($user_id); ?></td>
        <td><?php echo form_submit('submit', 'Change'); ?></td>
        <?php echo form_close(); ?>
    </tr>
</table>

<div id="infoMessage"><?php // echo $message;       ?></div>