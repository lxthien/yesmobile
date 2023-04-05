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
        <td height='55' background='<?php echo RES_PATH; ?>images/panel/admin-blue_08.gif' valign='middle' style='padding-left:20px'>Test Result List</td>
        <td align="right" background='<?php echo RES_PATH; ?>images/panel/admin-blue_08.gif' valign='middle' style='padding-right:10px'>&nbsp;</td>
    </tr>
</table>

<form action='<?php echo $page_link.'/delete';?>' method='post' name='form1' style='margin:0px'>
    <table width="100%" cellspacing="0" cellpadding="5" align="center" border="0">
        <tr class="tr_title_bg">
            <td width="5%" class="td_title_main" align="left">No.</td>
            <td width =25%" class="td_title_main" align="left">Name</td>
            <!-- <td width="10%" class="td_title_main" align="left">Position</td>            
            <td width="10%" class="td_title_main" align="left">Skype</td> -->            
            <td width="20%" class="td_title_main" align="left">Yahoo</td>            
            <td width="45%" class="td_title_main" align="left">Actions</td>
        </tr>
    </table>
    <table width='100%' cellspacing='0' cellpadding='5' align='center' class='table_border_line'>
        <?php
        $index = 1;
        foreach ($list_items as $row) {

            $bg_color = "";
            if ($index % 2) {
                $bg_color = '#F3E2A7';
            }
            else {
                $bg_color = '#FFF1BC';
            }
            echo "<tr" . $bg_color . ">";
            echo "<td width='5%'  align='left'>" . $index . "</td>";            
            echo "<td width='25%'  align='left'><a href='". base_url() . "panel/contact/edit/" . $row->id_contact."'>". set_value('name',$row->name) . "</a></td>";
//            echo "<td width ='10%' align='left'><a href='". base_url() . "panel/contact/edit/" . $row->id_contact."'>". set_value('position',$row->position) . "</a></td>";
//            echo "<td  width ='10%' align='left'><a href='". base_url() . "panel/contact/edit/" . $row->id_contact."'>". set_value('skype',$row->skype) . "</a></td>";
            echo "<td  width ='20%' align='left'><a href='". base_url() . "panel/contact/edit/" . $row->id_contact."'>". set_value('yahoo',$row->yahoo) . "</a></td>";
            echo "<td width='45%'  align='left'><a href='" . base_url() . "panel/contact/edit/" . $row->id_contact . "'>Edit</a>";
            echo " | <img src='" . RES_PATH . "images/panel/recycle.gif' onclick='deleteRecord(" . $row->id_contact . ")' width='14' height='16' border='0' title='Delete'/></td>";
            echo "</tr>";
            $index++;
        }
        echo "";
        echo "";
        ?>
    </table>
    <p class='toTop'><a href='<?php echo base_url() . "panel/contact/add" ?>'>Add Contact</a></p>
    <input type='hidden' name='hiddelete' id='hiddelete' value=''/>
</form>