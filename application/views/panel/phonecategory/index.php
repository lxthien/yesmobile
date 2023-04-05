<?php
    $page_link = base_url() . $this->uri->segment(1) . '/' . $this->uri->segment(2);
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
        <td height='55' background='<?php echo RES_PATH; ?>images/panel/admin-blue_08.gif' valign='middle' style='padding-left:20px'>Quản lí danh mục</td>
        <td align="right" background='<?php echo RES_PATH; ?>images/panel/admin-blue_08.gif' valign='middle' style='padding-right:10px'>&nbsp;</td>
    </tr>
</table>

<form action='<?php echo $page_link.'/delete';?>' method='post' name='form1' style='margin:0px'>
    <table width="100%" cellspacing="0" cellpadding="5" align="center" border="0">
        <tr class="tr_title_bg">
            <td width="5%" class="td_title_main" align="left">No.</td>
            <td width="30%" class="td_title_main" align="left">Name</td>
            <td width="20%" class="td_title_main" align="left">Danh mục cha</td>            
            <td width="20%" class="td_title_main" align="left">&nbsp;</td>            
            <td width="15%" class="td_title_main" align="left">Actions</td>
        </tr>
    </table>
    <table width='100%' cellspacing='0' cellpadding='5' align='center' class='table_border_line'>
        <?php
            $i = 1;
            foreach ($list_items as $row):
                $listSub = $this->product_category_model->readListByParentId($row["id"]);
        ?>
        <tr>
        	<td width="5%" align="left"><?php echo $i; ?></td>
            <td width="30%" align="left"><a href="<?php echo base_url().'panel/admin_category_phone/edit/'.$row['id']; ?>"><?php echo $row['name']; ?></a></td>
            <td width="20%" align="left">Thư mục gốc</td>
            <td width="20%" align="left">&nbsp;</td>
            <td width="15%" align="left">
            	<a href="<?php echo base_url().'panel/admin_category_phone/edit/'.$row['id']; ?>">Edit</a>
            	<img style="cursor: pointer; vertical-align: middle;" src="<?php echo base_url().'assets/images/panel/recycle.gif'; ?>" onclick='deleteRecord("<?php echo $row['id_news_category'] ?>")' width='14' height='16' border='0' title='Delete'/>
            </td>
        </tr>
            <?php
                foreach ($listSub as $rowSub):
                    $listSub2 = $this->product_category_model->readListByParentId($rowSub["id"]);
                    $i++;
            ?>
            <tr>
                <td width="5%" align="left"><?php echo $i; ?></td>
                <td width="30%" align="left"><a href="<?php echo base_url().'panel/admin_category_phone/edit/'.$rowSub['id']; ?>">..........<?php echo $rowSub['name']; ?></a></td>
                <td width="20%" align="left"><?php echo $row['name']; ?></td>
                <td width="20%" align="left">&nbsp;</td>
                <td width="15%" align="left">
                    <a href="<?php echo base_url().'panel/admin_category_phone/edit/'.$rowSub['id']; ?>">Edit</a>
                    <img style="cursor: pointer; vertical-align: middle;" src="<?php echo base_url().'assets/images/panel/recycle.gif'; ?>" onclick='deleteRecord("<?php echo $rowSub['id_news_category'] ?>")' width='14' height='16' border='0' title='Delete'/>
                </td>
            </tr>
                <?php
                    foreach ($listSub2 as $rowSub2):
                        $i++;
                ?>
                <tr>
                    <td width="5%" align="left"><?php echo $i; ?></td>
                    <td width="30%" align="left"><a href="<?php echo base_url().'panel/admin_category_phone/edit/'.$rowSub2['id']; ?>">....................<?php echo $rowSub2['name']; ?></a></td>
                    <td width="20%" align="left"><?php echo $rowSub['name']; ?></td>
                    <td width="20%" align="left">&nbsp;</td>
                    <td width="15%" align="left">
                        <a href="<?php echo base_url().'panel/admin_category_phone/edit/'.$rowSub2['id']; ?>">Edit</a>
                        <img style="cursor: pointer; vertical-align: middle;" src="<?php echo base_url().'assets/images/panel/recycle.gif'; ?>" onclick='deleteRecord("<?php echo $rowSub2['id_news_category'] ?>")' width='14' height='16' border='0' title='Delete'/>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        <?php $i++; endforeach; ?>
    </table>
    <!-- <p class='toTop'><a href='<?php echo base_url() . "panel/admin_category_phone/add" ?>'>Thêm danh mục</a></p> -->
    <!-- <input type='hidden' name='hiddelete' id='hiddelete' value=''/> -->
</form>