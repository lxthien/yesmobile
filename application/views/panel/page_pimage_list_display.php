
<?php
if (isset($pimages)):
    ?>    
    <div class="linephantrang"></div>        
    <div class="framecontentright_3" style="width:660px;  float:left; margin:10px 0px 7px 0px;">
        <ul class="gallery">
            <?php
            if (count($pimages) === 0){
                echo 'Chưa có album nào trong mục này !';
            } else {
            foreach ($pimages as $pimage):
                $thumbnail_path = THUMBNAILS . '/no_image.jpg';
                if (isset($pimage->thumbnail)) {
                    $thumbnail = $pimage->thumbnail;
                    $thumbnail_path = THUMBNAILS . '/' . $thumbnail->name;
                }
                $name = 'Album ' . $pimage->image_name;
                ?>           

                <li>
                    <a href="<?php //echo base_url($pimage->link_rewrite); ?>">
                        <div class="piece newpic" style="background-image: url(<?php echo "'" . base_url($thumbnail_path) . "'"; ?>)" ></div>
                        <div class="img-label"><?php echo $name; ?></div>
                    </a>
                </li>
            <?php endforeach;} ?>     
        </ul>       
    </div>
<?php endif; ?>