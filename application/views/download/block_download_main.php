<table width="639" border="1" style="border:#CCCCCC solid 1px;">
    <?php foreach ($download_categories as $category) : ?>
        <tr>
            <td height="28" colspan="2" style="border:#CCCCCC solid 1px; background-color:#0098ef" >
                <p style="font-size:14px; font-weight:bold; color:#ffffff; margin-left:10px;"> <?php echo $category->name; ?></p>						</td>
        </tr>
        <?php
        if (isset($category->sub_cats)):
            $sub_cats = $category->sub_cats;
            foreach ($sub_cats as $sub_cat):
                ?>
                <tr>
                    <td height="28" colspan="2" style="border:#CCCCCC solid 1px;background-color:#f9f9f9;">
                        <p style=" font-size:14px; font-weight:bold; color:#666666;margin-left:10px; "> <?php echo $sub_cat->name; ?> </p>						</td>
                </tr>

                <?php
                if (isset($sub_cat->download_items)) {
                    $data = array();
                    $data['download_items'] = $sub_cat->download_items;
                    $this->load->view('download/block_download_list_display', $data);
                }
                ?>
            <?php endforeach; ?>
        <?php endif; ?>
        <?php
        if (isset($category->download_items)) {
            $data = array();
            $data['download_items'] = $category->download_items;
            $this->load->view('download/block_download_list_display', $data);
        }
        ?>        
        <?php
    endforeach;
    ?>    
</table>