<?php foreach ($download_items as $item) : ?>
    <tr>
        <td height="13" width="536" style="border:#CCCCCC solid 1px;">
            <p class="icon4"><img src="<?php echo RES_PATH; ?>images/icon10.png" /></p>
            <p style=" font-size:14px; color:#666666; margin-top:5px; <!-- margin-left:-5px;--> float:left;"> <?php echo $item->name; ?></p>					    </td>
        <td height="13" width="91" style="border:#999999 solid 1px; ">
            <div class="icontaive"><a  href="<?php echo $item->file_name; ?>"></a></div></td>
    </tr>

    <?php
endforeach;
?>
    
 