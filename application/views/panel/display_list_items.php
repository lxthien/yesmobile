<?php
$con_link = base_url() . $this->uri->segment(1) . '/' . $this->uri->segment(2);
?>
<script language="Javascript">
    function deleteRecord(id)
    {
        var answer = window.confirm('Do you want to delete this record?');
        if (answer==false) 
        {
            return false;
        }
        else	
        {
            document.form1.hiddelete.value=id;
            document.form1.submit();
            return true;
        }
    }
</script>
<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center'>
    <tr>
        <td height='55' background='<?php echo RES_PATH; ?>images/panel/admin-blue_08.gif' valign='middle' style='padding-left:20px'>Test Result List</td>
        <td align="right" background='<?php echo RES_PATH; ?>images/panel/admin-blue_08.gif' valign='middle' style='padding-right:10px'>&nbsp;</td>
    </tr>
</table>
<?php // echo form_open($con_link.'/delete');  ?>
<form action="<?php echo $con_link . '/delete'; ?>" method='post' name='form1' style='margin:0px'>
      <table width="100%" cellspacing="0" cellpadding="5" align="center" border="0">
        <tr class="tr_title_bg">
            <td width="10%" class="td_title_main" align="left">No.</td>           
            <td class="td_title_main" align="left">Name</td>
            <td width="10%" class="td_title_main" align="left"></td>
            <td width="10%" class="td_title_main" align="left"></td>
        </tr>
    </table>
    <table width="100%" cellspacing="0" cellpadding="5" align="center" class="table_border_line">
        <?php
        $index = 1;
        if (isset($item_list) && sizeof($item_list) > 0) {
            foreach ($item_list as $item) {
                //echo "<tr bgcolor=''>";
                $title ="";
                if (isset($item->name)){
                    $title = $item->name;
                } else if(isset($item->title)){
                    $title = $item->title;
                }
                echo "<tr>";
                echo "<td width='10%'  align='left'>" .$index . "</td>";  
                echo "<td width='70%'  align='left'><a href='" . $con_link . "/edit/" . $item->id . "'>".$title."</a></td>";
                echo "<td width='10%'  align='left'><a href='" . $con_link . "/edit/" . $item->id . "'>Edit</a></td>";
                echo "<td width='10%' align='left'><img src='" . RES_PATH . "images/panel/recycle.gif' onclick='deleteRecord(" . $item->id . ")' width='14' height='16' border='0' title='Delete'/></td>";
                echo "</tr>";
                $index++;
            }
        } else {
            echo 'Chưa có gallery nào được tạo !';
        }
        ?>  
    </table>
    <p class="toTop"><a href="<?php echo $con_link . '/add' ?>">Thêm mới</a></p>

    <input type="hidden" name="hiddelete" id="hiddelete" value=""/>
</form>
