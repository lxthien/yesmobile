<div class="allboxsp1 col-md-12">
    <div class="main-product">
        <div class="nav">
            <a href="<?php echo base_url(); ?>" title="Trang chủ">Trang chủ</a>
            <a href="<?php echo base_url('dich-vu-sua-chua-dien-thoai.html'); ?>" title="Sửa chữa điện thoại">Sửa chữa điện thoại</a>
            <a href="<?php echo base_url('dich-vu/'.$catParentServices->link_rewrite); ?>" title="<?php echo $catParentServices->name; ?>"><?php echo $catParentServices->name; ?></a>
            <span><?php echo $catServices->name; ?></span>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="server-information">
        <div class="server-information-left col-md-5">
            <div class="row">
                <img title="<?php echo $servicesDetail->title;?> tại Vũng Tàu" src="<?php echo image($servicesDetail->news_icon, 'news_390_258'); ?>" alt="<?php echo $servicesDetail->title;?> tại Bà Rịa Vũng Tàu">
            </div>
        </div>
        <div class="server-information-right col-md-7">
            <div class="row">
                <h1 class="title-service h1-title"><?php echo $servicesDetail->title; ?></h1>
                <div class="price-detail">
                    <p>
                    <?php if ($servicesDetail->price != 0) { ?>
                        <span class="product-price"><?php echo number_format($servicesDetail->price, "0", ",", "."); ?></span> <span class="icon-price-rate">vnđ</span> <span class="ngan-cach">|</span> <span class="hotline-tu-van"><span>Tư vấn:</span> 0847 72 72 72</span>
                    <?php }else{ ?>
                        <span class="product-price-text">Giá: Xin vui lòng liên hệ</span> <span class="ngan-cach">|</span> <span class="hotline-tu-van"><span>Tư vấn:</span> 0847 72 72 72</span>
                    <?php } ?>
                    </p>
                </div>
                <p class="service-at-home" style="font-size:16px" color="#000080"><b>Giá niêm yết, không thêm chi phí nào khác.</b></p> </br>
				<p class="time-wanarry"><span>Thời gian sửa chữa:</span><b> <?php echo $servicesDetail->time_repair != null ? $servicesDetail->time_repair : 'Đang cập nhật ...'; ?></b></p>
                <p class="time-wanarry"><span>Thời gian bảo hành:</span><b> <?php echo $servicesDetail->time_service != null ? $servicesDetail->time_service : 'Đang cập nhật ...'; ?></b> - <a class="service-warranty" style="font-size:16px" target="_blank" href="<?php echo base_url('/che-do-bao-hanh.html'); ?>">Chính sách bảo hành</a></p>
                <p class="address">
                    <b>Địa chỉ sửa chữa:</b> </br>
					- 438 Trương Công Định, Phường 8, TP.Vũng Tàu (Gần ngã ba Trương Công Định và Nguyễn Tri Phương) 
                </p>
				<p class="address">
                    - Đường 28/04, Thôn 6, Xã Long Sơn, TP.Vũng Tàu (Cách chợ Long Sơn 300m) </p>
				<p class="address">Tham khảo <a class="service-map" style="font-size:16px" target="_blank" href="<?php echo base_url('tin-tuc/tin-tuc-yes-mobile/142-ban-do-duong-di-den-cac-cua-hang.html'); ?>">Bản đồ đường đi</a>
                </p>
                <div class="main-news-social">
                    <div class="social">
                        <!-- Button like facebook -->
                        <div class="fb-like" data-href="<?php echo $urlSocial; ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
                        <!-- Button like facebook -->
                        <!-- Button share facebook -->
                        <div class="fb-share-button" data-href="<?php echo $urlSocial; ?>" data-layout="button"></div>
                        <!-- Button share facebook -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="server-information-detail server-information">
        <div class="server-information-left col-md-8">
            <?php if ($servicesDetail->content != '') : ?>
            <div class="noidungthitruongchitiet row">
                <article>
                    <p><?php echo $servicesDetail->content;?></p>
                </article>
                <script type="text/javascript" src="<?php echo base_url().'assets/'; ?>js/readmore.min.js"></script>
                <script type="text/javascript">
                    $('article').readmore({
                        speed: 75,
                        moreLink: '<a class="read-more" href="javascript:void(0)">Đọc thêm</a>',
                        lessLink: '<a class="read-more" href="javascript:void(0)">Rút gọn</a>',
                        collapsedHeight: 750,
                        heightMargin:1,
                    });
                </script>
            </div>
            <?php endif; ?>
            <?php if(count($newsRelateds) > 0): ?>
            <div class="cactinkhac2 cactinkhac2-large row">
                <h3 class="h3-news-related">Các lỗi khác</h3>
                <div class="main-news-related">
                    <div class="main-news-related">
                        <?php
                            foreach ($newsRelateds as $post): 
                                $posted_date = new DateTime($post->date_add);
                        ?>
                            <div class="sreentieude">
                                <a class="img-news-related" href="<?php echo base_url($post->id_news.'-'.$post->link_rewrite.URL_TRAIL);?>">
                                    <picture>
                                        <source media="(max-width: 799px)" srcset="<?php echo image($post->news_icon, 'news_345_227'); ?>">
                                        <source media="(min-width: 800px)" srcset="<?php echo image($post->news_icon, 'news_200_132'); ?>">
                                        <img src="<?php echo image($post->news_icon, 'news_200_132'); ?>" alt="<?php echo $post->title;?> tại Vũng Tàu">
                                    </picture>
                                </a>
                                <div class="sreentinkhacchitiet">
                                    <a title="<?php echo $post->title;?>" href="<?php echo base_url($post->id_news.'-'.$post->link_rewrite.URL_TRAIL);?>">
                                        <span><?php echo $post->title;?></span>
                                    </a>
                                    <div class="des-news-related">
                                        <?php if ($post->price != 0) : ?>
                                            <p class="product-price-text">
                                                Giá: <span><?php echo number_format($post->price, "0", ",", "."); ?> vnđ</span>
                                            </p>
                                        <?php else: ?>
                                            <p class="product-price-text">Giá: <span>Xin vui lòng liên hệ</span></p>
                                        <?php endif; ?>
                                        <p>Thời gian sửa chữa: <?php echo $post->time_repair != null ? $post->time_repair : 'Đang cập nhật ...'; ?></p>
                                        <p>Thời gian bảo hành: <?php echo $post->time_service != null ? $post->time_service : 'Đang cập nhật ...'; ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php
                            endforeach;
                        ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <div class="server-information-right col-md-4">
            <div class="right">
                <div class="sreenonline right-box">
                    <div class="toponline">
                        <h2>Danh mục sửa chữa điện thoại</h2>
                    </div>
                    <div class="line-title">
                        <div class="left-30">&nbsp;</div>
                        <div class="left-70">&nbsp;</div>
                    </div>
                    <div class="midonline lists-service-right">
                        <ul>
                            <?php foreach ($menuCategoryService as $service): ?>
                            <li><a class="<?php if($catParentServices->link_rewrite == $service['link_rewrite']) {echo 'menu_active';} ?>" href="<?php echo base_url('dich-vu/' . $service['link_rewrite']); ?>"><?php echo $service['name']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>