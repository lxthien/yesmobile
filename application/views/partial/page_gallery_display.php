<link rel="stylesheet" type="text/css" media="screen" href="<?php echo RES_PATH; ?>css/prettyPhoto.css" />
<script type="text/javascript" src="<?php echo RES_PATH; ?>js/jquery-1.7.1.js"></script>
<script type="text/javascript" src="<?php echo RES_PATH; ?>js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="<?php echo RES_PATH; ?>js/functions.js"></script>


<?php if (isset($gallery_categories)): ?>    
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
<div class="linephantrang"></div>        
<div class="framecontentright_3" style="width:660px;  float:left; margin:10px 0px 7px 0px;">
    <ul class="gallery-view">
        <?php
        if (isset($gallery)) :
            if (count($gallery->images) === 0) {
                echo 'Hiện chưa có hình được đưa lên cho album này !';
            } else {
                foreach ($gallery->images as $image):
                    $thumbnail_url = THUMBNAILS . '/' . $image->name;
                    $image_url = UPLOAD_DIR . '/' . $image->name;
                    $name = 'Album ' . $gallery->name;
                    ?>
                    <li>
                        <a href="<?php echo base_url($image_url); ?>" rel="prettyPhoto[gallery1]" title="<?php echo $gallery->name; ?>">
                            <div class="piece newpic" style="background-image: url(<?php echo "'" . base_url($thumbnail_url) . "'"; ?>)"></div>
            <!--                        <div class="img-label"><?php // echo $gallery->name;  ?></div>-->
                        </a>
                    </li>
                    <?php
                endforeach;
            }
        endif;
        ?>
    </ul>
</div>
