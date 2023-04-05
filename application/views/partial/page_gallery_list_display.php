<?php
if (isset($gallery_categories)):
    ?>
    <div class="frametitlehinhanh" >
        <?php
//        if (isset($gallery_categories)):
        foreach ($gallery_categories as $category):
            ?>
            <div class="titlehinhanh1"><a href="<?php echo base_url($category->link_rewrite); ?>"><?php echo $category->name; ?> </a></div>
            <p style="float:left; margin:10px 3px 0px 3px; color:#999999;">|</p>
            <?php
        endforeach;
        ?>
    </div>
<?php endif; ?>
<?php
if (isset($galleries)):
    ?>    
    <div class="linephantrang"></div>        
    <div class="framecontentright_3" style="width:660px;  float:left; margin:10px 0px 7px 0px;">
        <ul class="gallery">
            <?php
            if (count($galleries) === 0){
                echo 'Chưa có album nào trong mục này !';
            } else {
            foreach ($galleries as $gallery):
                $thumbnail_path = THUMBNAILS . '/no_image.jpg';
                if (isset($gallery->thumbnail)) {
                    $thumbnail = $gallery->thumbnail;
                    $thumbnail_path = THUMBNAILS . '/' . $thumbnail->name;
                }
                $name = 'Album ' . $gallery->name;
                ?>           

                <li>
                    <a href="<?php echo base_url($gallery->link_rewrite); ?>">
                        <div class="piece newpic" style="background-image: url(<?php echo "'" . base_url($thumbnail_path) . "'"; ?>)" ></div>
                        <div class="img-label"><?php echo $name; ?></div>
                    </a>
                </li>
            <?php endforeach;} ?>     
        </ul>       
    </div>
<?php endif; ?>
