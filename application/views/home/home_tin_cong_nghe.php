<div class="sreennew home-technology col-md-12">
    <h1 class="h1-title">CẨM NANG ĐIỆN THOẠI</h1>
    <div class="line-title">
        <div class="left-30">&nbsp;</div>
        <div class="left-70">&nbsp;</div>
    </div>
    <div class="boxnew">
        <?php
            for ($i = 0; $i < count($tinCoTheQuanTam); $i++) {
            $divClass = 'new2';
            if ($i % 2 == 0) {
                echo '<div class="sreennew1">';
                $divClass = 'new1';
            }
            $eachNews = $tinCoTheQuanTam[$i]; ?>
            <div class="<?php echo $divClass; ?>">
                <div class="hinhnew">
                    <a href="<?php echo $eachNews['link_rewrite']; ?>" title="<?php echo $eachNews['title'];?>">
                        <img alt="<?php echo $eachNews['title']; ?>" src="<?php echo image($eachNews['news_icon'], 'news_150_90'); ?>"/>
                    </a>
                </div>
                <div class="sreentitlenew">
                    <div class="contentnew">
                        <a href="<?php echo $eachNews['link_rewrite']; ?>" title="<?php echo $eachNews['title'];?>">
                            <p><?php echo $eachNews['title'];?></p>
                        </a>
                    </div>
                    <div class="noidung">
                        <p align="justify"><?php echo $eachNews['content'];?></p>
                    </div>
                </div>
                <div class="line2"></div>
            </div>    <?php if ($i % 2 == 1 || $i == count($tinCoTheQuanTam) - 1) {
                echo '</div>';
            }
        }
        ?>
    </div>
</div>