
<?php
if (isset($company_category_newses)) {
    foreach ($company_category_newses as $category):
        ?>
        <?php if (sizeof($category['posts']) > 0): ?>
            <div class="frametinhoithao" style="width:250px; height:20px; float:left;">
                <div  class="tinhoithao"><a href="<?php echo base_url($category['link_rewrite']); ?>"><?php echo $category['name']; ?></a></div>
            </div>

            <div class="linephantrang"></div>
            <?php
            $posts = $category['posts'];
            foreach ($posts as $post => $value):
                $date_post = new DateTime($value->date_add);
//            var_dump($value);
                ?>

                <div class="framecontentright">
                    <div class="picright" ><img src="<?php echo $value->news_icon; ?>"/></div>
                    <div class="boxcontentright" style="width:520px; height:105px; float:left;">
                        <p class="titleright"  style="text-align:left"><a href="<?php echo base_url($value->link_rewrite); ?>"><?php echo $value->title; ?></a></p>
                        <p style="text-align:justify; margin-top:5px;"><?php echo $value->content; ?></p> <span class="posted"><?php echo date_format($date_post,'H:i').' - '.date_format($date_post,'d.m.Y');?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    <?php endforeach;
}
?>
    
