<?php if (isset($configs)): 
    $message = $this->session->flashdata('message');
    ?>
    <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center'>
        <tr>
            <td height='55' background='<?php echo RES_PATH; ?>images/panel/admin-blue_08.gif' valign='middle' style='padding-left:20px'>Edit Content <?php if(trim($message)!==''){echo ': '.$message;};?></td>
            <td align="right" background='<?php echo RES_PATH; ?>images/panel/admin-blue_08.gif' valign='middle' style='padding-right:10px'>&nbsp;</td>
        </tr>
    </table>
<?php // echo '----------------';?>
    </br>
    <?php // echo form_open(base_url().'panel/config/save'); ?>
    <form action="<?php echo base_url().'panel/config/save'; ?>" enctype="multipart/form-data" method="post" name="formDK" style="margin:0px">
        <table width="80%" border="0" cellspacing="0" cellpadding="5" align="left">
            <?php
            $index = 0;            
            foreach ($configs as $item):
                
                ?>
                <?php
//                $css = 'field_set field_set_odd';
//                if ($index%2){
//                    $css='field_set field_set_even';
//                };
//                $data_field_set = array('class' => $css);
//                echo form_fieldset('',$data_field_set);
//                echo form_label($item->name, $item -> param);
//                $data_field = array(
//                    'name' => $item->param,
//                    'id' => $item->param,
//                    'value' => $item->value,
//                    'cols' => '255',                    
//                    'class' => 'field',
//                );
//                echo form_input($data_field);
//                echo form_fieldset_close();
                ?>
                <tr bgcolor="<?php if ($index % 2) echo '#F3E2A7'; else echo '#FFF1BC'; ?>">
                    <td align="right" width="30%"><div class="field_name"><?php echo $item->name; ?></div></td>
                    <td align="left" width="70%"><div class ="field"><input size="50" type="text" name="param_<?php echo $item->param; ?>" value="<?php echo $item->value; ?>"/>&nbsp;</div></td>
                </tr>
                <?php
                $index++;
            endforeach;
            ?>
            <tr>
                <td align="right" valign="top">&nbsp;</td>
    <!--                <td><input type="submit" name="submitButton" value="Save" /></td>-->
                <td><?php echo form_submit('save', 'Lưu'); ?></td>

                <?php echo form_close(); ?>
            </tr>            
        </table>
        <input name="oldFile" type="hidden" value="{$arrResult[p].Image}">
        <input name="id" type="hidden" value="{$item_id}">
    </form>
<?php endif; ?>