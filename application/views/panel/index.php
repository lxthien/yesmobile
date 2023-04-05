
<?php require_once '_header.php'; ?>
<table width="100%" border="0" cellspacing="10" cellpadding="0" align="center" bgcolor="#f2f2f2">
    <tr><td align="left"><B>User Login</B></td></tr>
    <tr><td><hr size="1" noshade></td></tr>
    <!-- tr><td align='center'><p>Please login with your email/username and password below.</p></td></tr></td></tr-->
<tr><td height="430" valign="top" align ="center">
        <?php
        echo '<div id = "infoMessage">' . $message . '</div>';
        ?>
        <form action="<?php echo base_url($this->uri->segment(1) . '/login') ?>" method="post" enctype="multipart/form-data" name="formDK" onsubmit="return checkLoginIndex();">
            <table width="100%" border="0" cellpadding="0" cellspacing="15" align="center">
                <tr valign="middle">
                    <td width="40%" align="right">Username</td>

                    <td width="60%">
                        <?php
                        $identity['class'] = 'form';
                        $identity['size'] = '35';
                        echo form_input($identity);
                        ?>
                    </td>
                </tr>
                <tr valign="middle">
                    <td align="right">Password</td>
                    <td>

                        <?php
                        $password['size'] = '35';
                        $password['class'] = 'form';
                        echo form_input($password);
                        ?>
                    </td>
                </tr>
                <!--tr valign="middle">
                    <td align="right">Remember me</td>
                    <td>

                        <-?php
                        echo form_checkbox('remember', '1', FALSE, 'id="remember"');
                        ?>
                    </td>
                </tr-->
                <tr>
                    <td>&nbsp;</td>
                    <td>                            
                        <input type="submit" name="submitButton" value="Login" class="form">
                        <input name="Reset" type="reset" value="Reset" onClick="javascript:document.formDK.User.focus();" class="form">
                        <input type="hidden" name="option" value="1">
                    </td>
                </tr>
                <!--tr><td>&nbsp;</td><td><p><a href="<-?php echo base_url('panel/forgot-password')?>">Forgot your password?</a></p></td></-->
            </table>
        </form>	
    </td></tr>
</table>
<?php include_once '_footer.php'; ?>
<?php // ob_flush(); ?>
