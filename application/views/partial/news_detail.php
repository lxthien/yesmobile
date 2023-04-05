<?php
    if (isset($news_item)):
    $new_id = $news_item->id_news;
    $isNotFixNews = $new_id !== COMPANY_INSTRODUCE_NEWS_ID && $new_id !== SERVICES && $new_id !== WARRANTY && $new_id !== SITE_MAP && $new_id !== RECRUIT && $new_id !== WARRANTYPOLICY && $new_id !== DELEVERYPOLICY;
    if ($isNotFixNews) {
        $pageHeadTitle = $category->name;
    }
    else {
        $pageHeadTitle = $news_item->title;
    }
?>
<div class="nav">
    <?php if($isNotFixNews = $new_id == COMPANY_INSTRODUCE_NEWS_ID || $new_id == SERVICES || $new_id == WARRANTY || $new_id == SITE_MAP || $new_id == RECRUIT || $new_id == WARRANTYPOLICY || $new_id == DELEVERYPOLICY): ?>
        <a href="<?php echo base_url(); ?>">Trang chủ</a>
        <span><?php echo $news_item->title; ?></span>
    <?php endif; ?>
    <?php if ($this->menu_active == 'news' || $this->menu_active == 'guides') : ?>
        <a href="<?php echo base_url(); ?>">Trang chủ</a>
        <a href="<?php echo base_url($categoryParent->link_rewrite); ?>"><?php echo $categoryParent->name; ?></a>
        <span><?php echo $category->name; ?></span>
    <?php endif; ?>
</div>
<div class="ttincongghe col-md-12">
    <?php 
        if ($news_item->active === '1') {
    ?>
    <div class="sreentieude">
        <div class="tieude">
            <h1 class="h1-title-detail"><?php echo $news_item->title; ?></h1>
        </div>
        <div class="main-news-social">
            <div class="social">
                <!-- Button like facebook -->
                <div class="fb-like" data-href="<?php echo $urlSocial; ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
                <!-- Button like facebook -->
                <!-- Button share facebook -->
                <div class="fb-share-button" data-href="<?php echo $urlSocial; ?>" data-layout="button"></div>
                <!-- Button share facebook -->
            </div>
            <?php if($news_item->id_news != 3 && $news_item->id_news != 4 && $news_item->id_news != 1 && $news_item->id_news != 150 && $news_item->id_news != 153): ?>
            <span class="time-update-news">Cập nhật: <?php echo date_format(new DateTime($news_item->date_add),'d/m/Y'); ?></span>
            <?php endif; ?>
        </div>
    </div>
    <div class="noidungthitruongchitiet">
        <p><?php echo $news_item->content;?></p>
          <?php if($news_item->source != ''): ?>
              <p align="right">Nguồn: <?php echo $news_item->source; ?></p>
        <?php endif; ?>
        <p align="justify">&nbsp;</p>	
    </div>
    <?php 
    if (!$isNotFixNews) {
    ?>

    <div class="cactinkhac2 cactinkhac2-large">
        <h3 class="h3-news-related">Các tin khác</h3>
        <div class="main-news-related">
            <?php
                foreach ($posts_same_category as $post): 
                    $posted_date = new DateTime($post->date_add);
            ?>
            <div class="sreentieude">
                <a class="img-news-related" href="<?php echo base_url($post->link_rewrite);?>">
                    <picture>
                        <source media="(max-width: 799px)" srcset="<?php echo image($post->news_icon, 'news_345_227'); ?>">
                        <source media="(min-width: 800px)" srcset="<?php echo image($post->news_icon, 'news_200_120'); ?>">
                        <img src="<?php echo image($post->news_icon, 'news_200_120'); ?>" alt="<?php echo $post->title;?>">
                    </picture>
                </a>
                <div class="sreentinkhacchitiet">
                    <a title="<?php echo $post->title;?>" href="<?php echo base_url($post->link_rewrite);?>">
                        <span><?php echo $post->title;?></span>
                    </a>
                    <p class="des-news-related"><?php echo $post->content; ?></p>
                </div>
            </div>
            <?php
                endforeach;
            ?>
        </div>
    </div>
    <?php 
    }
    } else {
    ?>
        <div class="sreentieude">
            <div class="tieude">
                &nbsp;
            </div>   
        </div>
        <div class="noidungthitruongchitiet">
            <p>Hiện tại chưa có nội dung trong mục này</p>
        </div>
    <?php 
    }
    ?>
</div>
<?php endif;?>