<!--box ban nen xem -->
<?php if (isset($this->useFull)) : ?>
    <div class="sreendownload sreenonline right-box">
        <div class="toponline">
            <h2>Kiểm tra bảo hành</h2>
        </div>
        <div class="line-title">
            <div class="left-30">&nbsp;</div>
            <div class="left-70">&nbsp;</div>
        </div>
        <div class="boxdownload widget-warranty">
            <div class="3">
                <input type="text" name="phone" class="search" placeholder="Vui lòng nhập số điện thoại...">
                <p class="widget-warranty-response"></p>
                <button>Kiểm tra</button>

                <script type="text/javascript">
                    var $phoneField = $('.widget-warranty .search');

                    $(document).ready(function() {
                        $phoneField.keypress(function(e) {
                            $phoneField.css('border-color', '#cccccc');
                            $('.widget-warranty-response').hide();
                        });

                        $( ".widget-warranty button").click(function( event ) {
                            event.preventDefault();
                            
                            if ($('.widget-warranty .search').val() === '') {
                                $phoneField.focus().css('border-color', 'red');
                                return;
                            }

                            if ($('.widget-warranty .search').val().length < 10 || $('.widget-warranty .search').val().length > 11) {
                                $phoneField.focus().css('border-color', 'red');
                                return;
                            }

                            $.ajax({
                                type: "POST",
                                url: "<?php echo base_url(); ?>searchHistory",
                                data: 'q=' + $('.widget-warranty .search').val() + '&format=true',
                                dataType: "text",
                                success: function(resultData) {
                                    if (resultData != 1) {
                                        $('.widget-warranty-response').html(resultData).show();
                                        $phoneField.css('border-color', '#cccccc');
                                    } else {
                                        window.location.href = "<?php echo base_url(); ?>thong-tin-bao-hanh/" + $('.widget-warranty .search').val();
                                    }
                                }
                            });
                        });
                    })
                </script>
            </div>
        </div>
    </div>
<?php
endif;
?>

<!--box ban nen xem -->
<?php if ($this->menu_active == 'news' || $this->menu_active == 'guides') : ?>
    <div class="sreendownload sreenonline right-box">
        <div class="toponline">
            <h2>Dịch vụ sửa chữa nổi bật</h2>
        </div>
        <div class="line-title">
            <div class="left-30">&nbsp;</div>
            <div class="left-70">&nbsp;</div>
        </div>
        <div class="boxdownload">
            <div class="3">
                <?php foreach ( $servicesHot as $row ): ?>
                    <div class="sreencontentdownload">
                        <div class="imges-block-you-see"><a href="<?php echo base_url($row->id_news.'-'.$row->link_rewrite.URL_TRAIL); ?>" title="<?php echo $row->title; ?>">
                            <img src="<?php echo image($row->news_icon, 'news_125_80'); ?>" alt="<?php echo $row->title; ?>"/></a>
                        </div>
                        <a class="link-block-you-see" href="<?php echo base_url($row->id_news.'-'.$row->link_rewrite.URL_TRAIL); ?>" title="<?php echo $row->title; ?>">
                            <p><?php echo $row->title; ?></p>
                        </a>
                        <p style="display: none;"><?php echo date_format(new DateTime($row->date_add), 'd/m/Y'); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php
endif;
?>

<!--box ban nen xem -->
<?php if (isset($this->useFull)) : ?>
    <div class="sreendownload sreenonline right-box">
        <div class="toponline">
            <h2>Tin công nghệ</h2>
        </div>
        <div class="line-title">
            <div class="left-30">&nbsp;</div>
            <div class="left-70">&nbsp;</div>
        </div>
        <div class="boxdownload">
            <div class="3">
                <?php foreach ( $tinCongNghe as $_watch ): ?>
                    <div class="sreencontentdownload">
                        <div class="imges-block-you-see"><a href="<?php echo base_url($_watch['link_rewrite']); ?>" title="<?php echo $_watch['title']; ?>">
                            <img src="<?php echo image($_watch['news_icon'], 'news_125_80'); ?>" alt="<?php echo $_watch['title']; ?>"/></a>
                        </div>
                        <a class="link-block-you-see" href="<?php echo base_url($_watch['link_rewrite']); ?>" title="<?php echo $_watch['title']; ?>">
                            <p><?php echo $_watch['title']; ?></p>
                        </a>
                        <p><?php echo date_format(new DateTime($_watch['date_add']), 'd/m/Y'); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php
endif;
?>
<?php if ($this->uri->segment(1) == 'dich-vu' || $this->uri->segment(1) == 'dich-vu-sua-chua-dien-thoai.html') : ?>
<div class="sreenonline right-box">
    <div class="toponline">
        <h2>Dịch vụ sửa chữa</h2>
    </div>
    <div class="line-title">
        <div class="left-30">&nbsp;</div>
        <div class="left-70">&nbsp;</div>
    </div>
    <div class="midonline lists-service-right">
        <ul>
            <?php foreach ($menuCategoryService as $service): ?>
			<?php if(!empty($levelServices)): ?>
            <li><a class="<?php if($catServices->link_rewrite == $service['link_rewrite'] || $categoryServicesParent == $service['link_rewrite']) {echo 'menu_active';} ?>" href="<?php echo base_url('dich-vu/' . $service['link_rewrite']); ?>"><?php echo $service['name']; ?></a></li>
            <?php else: ?>
			<li><a class="aaa" href="<?php echo base_url('dich-vu/' . $service['link_rewrite']); ?>"><?php echo $service['name']; ?></a></li>
			<?php endif; ?>
			<?php endforeach; ?>
        </ul>
    </div>
</div>
<?php endif; ?>

<div class="sreendownload sreenonline right-box">
    <div class="toponline">
        <h2>Facebook</h2>
    </div>
    <div class="line-title">
        <div class="left-30">&nbsp;</div>
        <div class="left-70">&nbsp;</div>
    </div>
    <div class="boxdownload">
        <div class="3">
            <div class="fb-page" data-href="https://www.facebook.com/YesMobile.vn/" data-tabs="" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/YesMobile.vn/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/YesMobile.vn/">Yes Mobile - Sửa chữa điện thoại từ 2010</a></blockquote></div>
        </div>
    </div>
</div>

<?php if ($this->menu_active != 'home') : ?>
<!--box ban nen xem -->
<div class="sreendownload sreenonline right-box">
    <div class="toponline">
        <h2>Có thể bạn quan tâm</h2>
    </div>
    <div class="line-title">
        <div class="left-30">&nbsp;</div>
        <div class="left-70">&nbsp;</div>
    </div>
    <div class="boxdownload">
        <div class="3">
            <?php foreach ( $useFull as $_watch ): ?>
                <div class="sreencontentdownload">
                    <div class="imges-block-you-see"><a href="<?php echo base_url($_watch->link_rewrite); ?>" title="<?php echo $_watch->title; ?>">
                        <img src="<?php echo image($_watch->news_icon, 'news_125_80'); ?>" alt="<?php echo $_watch->title; ?>"/></a>
                    </div>
                    <a class="link-block-you-see" href="<?php echo base_url($_watch->link_rewrite); ?>" title="<?php echo $_watch->title; ?>">
                        <p><?php echo $_watch->title; ?></p>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if (isset($you_should_watch)) : ?>
    <div class="sreendownload sreenonline right-box" style="margin-top: 20px;">
        <div class="toponline">
            <h2>Tin tức Yes Mobile</h2>
        </div>
        <div class="line-title">
            <div class="left-30">&nbsp;</div>
            <div class="left-70">&nbsp;</div>
        </div>
        <div class="boxdownload">
            <div class="3">
                <?php foreach ( $newsThangMobile as $_watch ): ?>
                    <div class="sreencontentdownload">
                        <div class="imges-block-you-see"><a href="<?php echo base_url('tin-tuc/tin-tuc-yes-mobile/'.$_watch->id_news.'-'.$_watch->link_rewrite.'.html'); ?>" title="<?php echo $_watch->title; ?>">
                            <img src="<?php echo image($_watch->news_icon, 'news_125_80'); ?>" alt="<?php echo $_watch->title; ?>"/></a>
                        </div>
                        <a class="link-block-you-see" href="<?php echo base_url('tin-tuc/tin-tuc-yes-mobile/'.$_watch->id_news.'-'.$_watch->link_rewrite.'.html'); ?>" title="<?php echo $_watch->title; ?>">
                            <p><?php echo $_watch->title; ?></p>
                        </a>
                        <p><?php echo date_format(new DateTime($_watch->date_add), 'd/m/Y'); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php
endif;
?>