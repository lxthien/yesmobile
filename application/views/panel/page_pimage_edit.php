<?php
// if (isset($gallery)): 
$con_link = base_url() . $this->uri->segment(1) . '/' . $this->uri->segment(2);
$message = $this->session->flashdata('message');
echo validation_errors();
?>
<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center'>
    <tr>
        <td height='55' background='<?php echo RES_PATH; ?>images/panel/admin-blue_08.gif' valign='middle' style='padding-left:20px'>Edit Content <?php
if (trim($message) !== '') {
    echo ': ' . $message;
};
?></td>
        <td align="right" background='<?php echo RES_PATH; ?>images/panel/admin-blue_08.gif' valign='middle' style='padding-right:10px'>&nbsp;</td>
    </tr>
</table>
</br>
<?php echo form_open_multipart($con_link . '/save'); ?>
<form action="<?php  echo $con_link  ?>" enctype="multipart/form-data" method="post" name="formDK" style="margin:0px">
<table width="80%" border="0" cellspacing="0" cellpadding="5" align="left">            
    
    <tr>

        <td align="right" valign="top"><input type="hidden" name="gallery_id" id="gallery_id" value="<?php echo $item->id; ?>"/>&nbsp;</td>
<!--                <td><input type="submit" name="submitButton" value="Save" /></td>-->
        <td><?php //echo form_submit('save', 'Lưu'); ?></td>
        <?php echo form_hidden('image_id', $item->id); ?>
        <?php echo form_close(); ?>
    </tr>
</table>
<input name="oldFile" type="hidden" value="{$arrResult[p].Image}">
<input name="id" type="hidden" value="{$item_id}">
</form>
    
