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
<!--<form action="<?php // echo $con_link  ?>/save" enctype="multipart/form-data" method="post" name="formDK" style="margin:0px">-->
<table width="80%" border="0" cellspacing="0" cellpadding="5" align="left">            
    <tr>
        <td align="right" valign="top" width="10%">Gallery name</td>
        <td>
            <?php
            $data = array('name' => 'gallery_name',
                'id' => 'gallery_name', 'style' => 'width:500px; height:24px', 'class' => 'form',
                'value' => $gallery->name,
                'onchange' => "copy2friendlyURL('#gallery_name');",
                'onkeyup' => "if (isArrowKey(event)) return; copy2friendlyURL('#gallery_name');");
            echo form_input($data);
            ?>            
        </td>
    </tr>
    <tr>
        <td align="right" valign="top" width="10%">Category</td>
        <td>
            <?php
            echo form_dropdown('category_id', $gallery_categories, set_value('category_id', $gallery->category_id), array('style' => 'border:1px solid #F6BA00')), '<br>';
            ?>            
        </td>
    </tr>
    <tr>
        <td align="right" valign="top" width="10%">Link rewrite</td>
        <td>
            <input name="link_rewrite" value="<?php echo $gallery->link_rewrite; ?>" id="link_rewrite" type="text" style="width:500px; height:24px" class="form">
        </td>
    </tr>
    <tr>
        <td align="right" valign="top" width="10%">Description</td>
        <td>
            <textarea name="gallery_description" id="gallery_description" type="textarea" class="form" cols ="80" rows ="4" style="width: 501px; height: 192px;"><?php echo $gallery->description; ?></textarea>
        </td>
    </tr>
    <tr>
        <td align="right" valign="top" width="10%">Enable</td>
        <td align ="left" valign ="top">
<!--                <input type ="checkbox" name="Enable" value="<?php // echo $gallery->active;  ?>" id="gallery_active" type="checkbox" class="form">-->

            <?php
            $data = array(
                'name' => 'gallery_active',
                'id' => 'gallery_active',
                'value' => $gallery->active,
                'checked' => $gallery->active,
                'class' => 'form',
            );
            echo form_checkbox($data);
            ?>
        </td>
    </tr>
    <?php if (isset($gallery->id)): ?>    
    <?php endif; ?>
    <tr>

        <td align="right" valign="top"><input type="hidden" name="gallery_id" id="gallery_id" value="<?php echo $gallery->id; ?>"/>&nbsp;</td>
<!--                <td><input type="submit" name="submitButton" value="Save" /></td>-->
        <td><?php echo form_submit('save', 'Lưu'); ?></td>
        <?php echo form_hidden('gallery_id', $gallery->id); ?>
        <?php echo form_close(); ?>
    </tr>
</table>
<input name="oldFile" type="hidden" value="{$arrResult[p].Image}">
<input name="id" type="hidden" value="{$item_id}">
</form>
<?php if (isset($gallery->id) && $gallery->id !== ""): ?>
    <div id ="upload_panel">
        <?php
        $this->load->view('panel/upload')
        ?>
    </div>
<?php endif; ?>
