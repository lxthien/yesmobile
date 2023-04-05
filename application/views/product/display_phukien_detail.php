<link rel="stylesheet" type="text/css" media="screen" href="<?php echo RES_PATH; ?>css/prettyPhoto.css"/>
<script type="text/javascript" src="<?php echo RES_PATH; ?>js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="<?php echo RES_PATH; ?>js/functions.js"></script>
<div class="nav">
    <a href="<?php echo base_url(); ?>">Trang chủ</a>
    <a href="<?php echo base_url().'san-pham/phu-kien-dien-thoai'; ?>">Phụ kiện điện thoại</a>
    <a href="<?php echo base_url().'san-pham/phu-kien-dien-thoai/'.$productCategory->link_rewrite; ?>"><?php echo $productCategory->name; ?></a>
    <span><?php echo $viewProduct->model; ?></span>
</div>
<div class="allboxsp1 phu-kien">
    <div class="ttinsanpham">
        <div class="leftthongtin col-md-6 col-md-12">
            <div class="row">
                <div class="boxhinhlonsp"><img title="<?php echo $viewProduct->model; ?> tại Vũng Tàu, Long Sơn" src="<?php echo image('files/logo/ads/'. $viewProduct->logo, 'product_270_358'); ?>" alt="<?php echo $viewProduct->model; ?> tại Vũng Tàu, Long Sơn" ></div>
            </div>
        </div>
        <div class="rightthongtin col-md-6 col-md-12">
            <div class="row">
                <h1><?php echo $viewProduct->model; ?></h1>
                <div class="price-detail">
                    <?php if ($viewProduct->gia_cu != 0 && $viewProduct->gia_cu != '' && $viewProduct->gia_cu != null) { ?>
                        <span class="product-price"><?php echo number_format($viewProduct->gia_cu, "0", ",", "."); ?></span> <span class="icon-price-rate">vnđ</span>
                    <?php } ?>
                    <span class="product-price"><?php echo number_format($viewProduct->price, "0", ",", "."); ?></span> <span class="icon-price-rate">vnđ</span>
                </div>
                <p class="tu-van"><span>Hotline tư vấn:</span> <span>0847 72 72 72</span></p>
                <?php if( strlen($viewProduct->noteInformation) > 0): ?>
                <div class="thongtincanluuy">
                    <p class="p-title">Thông tin cần lưu ý</p>
                    <hr>
                    <div class="main-thongtincanluuy">
                        <?php if( strlen($viewProduct->noteInformation) > 0): ?>
                            <?php echo $viewProduct->noteInformation; ?>
                        <?php else: ?>
                            <p>...</p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
                <?php if( strlen($viewProduct->baseInformation) > 0): ?>
                <div class="thongtincoban">
                    <p class="p-title">Thông tin cơ bản</p>
                    <hr>
                    <div class="main-thongtincoban">
                        <?php if( strlen($viewProduct->baseInformation) > 0): ?>
                            <?php echo $viewProduct->baseInformation; ?>
                        <?php else: ?>
                            <p>...</p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
                <div class="share-product">
                    <div class="social">
                        <div class="fb-like" data-href="<?php echo $urlSocial; ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
                        <div class="fb-share-button" data-href="<?php echo $urlSocial; ?>" data-layout="button"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-product-detail col-md-12">
            <div class="row">
                <div class="sreenthongso col-md-8 col-md-12">
                    <div class="row">
                        <div class="title">
                            <h1>Sản phẩm khác</h1>
                            <div class="title1"></div>
                        </div>
                        <ul class="accessories grid">
                            <?php
                                for ($i = 0; $i < count($eachProductList); $i++) :
                                    if ($eachProductList[$i]->id != $viewProduct->id) :
                            ?>
                            <li class="col-01 col-md-4">
                                <a class="img" href="<?php echo base_url($eachProductList[$i]->link_rewrite); ?>" title="<?php echo $eachProductList[$i]->producer . ' ' . $eachProductList[$i]->model ?>">
                                    <img title="<?php echo $eachProductList[$i]->producer . ' ' . $eachProductList[$i]->model ?> tại Vũng Tàu, Long Sơn" src="<?php echo image('files/logo/ads/'.$eachProductList[$i]->logo, 'product_90_120'); ?>" alt="<?php echo $eachProductList[$i]->producer . ' ' . $eachProductList[$i]->model ?> tại Vũng Tàu, Long Sơn">
                                </a>
                                <a class="name" href="<?php echo base_url($eachProductList[$i]->link_rewrite); ?>" title="<?php echo $eachProductList[$i]->producer . ' ' . $eachProductList[$i]->model ?>">
                                    <?php echo $eachProductList[$i]->producer . ' ' . $eachProductList[$i]->model ?>
                                </a>
                                <p>Giá: <span><?php echo number_format($eachProductList[$i]->price, "0", ",", "."); ?> đ</span></p>
                            </li>
                            <?php endif; endfor; ?>
                        </ul>
                    </div>
                </div>
                <div class="product-col-right col-md-4">
                    <div class="right row">
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
                                            <div class="imges-block-you-see"><a href="<?php echo base_url('tin-tuc/thong-tin-cong-nghe/'.$_watch->id_news.'-'.$_watch->link_rewrite.'.html'); ?>" title="<?php echo $_watch->title; ?>">
                                                <img src="<?php echo image($_watch->news_icon, 'news_125_80'); ?>" alt="<?php echo $_watch->title; ?>"/></a>
                                            </div>
                                            <a class="link-block-you-see" href="<?php echo base_url('tin-tuc/thong-tin-cong-nghe/'.$_watch->id_news.'-'.$_watch->link_rewrite.'.html'); ?>" title="<?php echo $_watch->title; ?>">
                                                <p><?php echo $_watch->title; ?></p>
                                            </a>
                                            <p><?php echo date_format(new DateTime($_watch->date_add), 'd/m/Y'); ?></p>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>