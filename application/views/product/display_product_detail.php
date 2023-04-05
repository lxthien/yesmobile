<div class="nav row">
    <a href="<?php echo base_url(); ?>">Trang chủ</a>
    <a href="<?php echo base_url().'san-pham/dien-thoai'; ?>">Điện thoại</a>
    <a href="<?php echo base_url().'san-pham/dien-thoai/'.$productCategory->link_rewrite; ?>"><?php echo $productCategory->name; ?></a>
    <span><?php echo $viewProduct->model; ?></span>
</div>

<div class="product-detail allboxsp1 row">
    <div class="ttinsanpham">
        <div class="leftthongtin col-md-6 col-md-12">
            <div class="row">
                <div class="boxhinhlonsp">
                    <img alt="<?php echo $site_meta_data['meta_title']; ?>" src="<?php echo base_url(PARTNER_LOGO . '/ads/' . $viewProduct->logo); ?>"/>
                </div>
                <div class="box-chung-toi-cam-ket">
                    <span>Chúng tôi cam kết:</span>
                    <p>Yes Mobile cung cấp hàng mới 100% nguyên hộp và hàng đã qua sử dụng nhưng chất lượng và hình thức còn rất tốt.</p>
                    <p>Tuyệt đối không bán hàng dựng lại, khắc phục lỗi, đã qua sửa chữa phần cứng.</p>
                    <p>Vì hàng đã qua sử dụng thường có nhiều chất lượng, mức giá, nguồn hàng khác nhau, Yes Mobile không cạnh tranh về giá nhưng cam kết bán hàng chất lượng tốt và nâng cao dịch vụ sau bán hàng. Rất mong được Quý khách hàng lưu tâm. Trân trọng cảm ơn!</p>
                </div>
            </div>
        </div>
        <div class="rightthongtin col-md-6 col-md-12">
            <h1><?php echo $viewProduct->model; ?></h1>
            <div class="price-detail">
                <?php if ($viewProduct->gia_cu != 0 && $viewProduct->gia_cu != '' && $viewProduct->gia_cu != null) { ?>
                    <span class="product-price"><?php echo number_format($viewProduct->gia_cu, "0", ",", "."); ?></span> <span class="icon-price-rate">vnđ</span><!-- <span class="icon-price">New</span>-->
                <?php } ?>
                <span class="product-price"><?php echo number_format($viewProduct->price, "0", ",", "."); ?></span> <span class="icon-price-rate">vnđ</span>
            </div>
            <p class="product-out-of-stock" style="font-size:20px">SẢN PHẨM NGỪNG KINH DOANH<p/>
            <p class="tu-van"><span>Tư vấn:</span> <span>038 200 0080</span></p>
            <div class="thongtincoban">
                <p class="p-title">Thông tin cấu hình</p>
                <hr>
                <div class="main-thongtincoban">
                    <?php if( strlen($viewProduct->baseInformation) > 0): ?>
                        <?php echo $viewProduct->baseInformation; ?>
                    <?php else: ?>
                        <p>...</p>
                    <?php endif; ?>
                </div>
            </div>
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
            <div class="qua-khuyen-mai">
                <div class="info-qua-khuyen-mai">
                    <?php if( strlen($viewProduct->sale_off) > 0): ?>
                        <?php echo $viewProduct->sale_off; ?>
                    <?php else: ?>
                        <p>...</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="box-chung-toi-cam-ket on-mobile">
                <span>Chúng tôi cam kết:</span>
                <p>Yes Mobile cung cấp hàng mới 100% nguyên hộp và hàng đã qua sử dụng nhưng chất lượng và hình thức còn rất tốt.</p>
                <p>Tuyệt đối không bán hàng dựng lại, khắc phục lỗi, đã qua sửa chữa phần cứng.</p>
                <p>Vì hàng đã qua sử dụng thường có nhiều chất lượng, mức giá, nguồn hàng khác nhau, Yes Mobile không cạnh tranh về giá nhưng cam kết bán hàng chất lượng tốt và nâng cao dịch vụ sau bán hàng. Rất mong được Quý khách hàng lưu tâm. Trân trọng cảm ơn!</p>
            </div>
            <p class="note-delivery">Nếu bạn muốn mua hàng từ xa, vui lòng xem <a href="<?php echo base_url('chinh-sach-van-chuyen.html'); ?>">tại đây</a></p>
            <div class="share-product">
                <div class="social">
                    <div class="fb-like" data-href="<?php echo $urlSocial; ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
                    <div class="g-plusone" data-size="medium" data-href="<?php echo $urlSocial; ?>"></div>
                    <div class="fb-share-button" data-href="<?php echo $urlSocial; ?>" data-layout="button"></div>
                    <div class="g-plus" data-action="share" data-annotation="bubble" data-href="<?php echo $urlSocial; ?>"></div>
                </div>
            </div>
        </div>
        <div class="main-product-detail col-md-12">
            <div class="row">
                <div class="sreenthongso col-md-8 col-md-12">
                    <div class="thongso">
                        <a href="javascript:void(0);" onclick="showIntroduce();">
                            <p>Trải nghiệm sản phẩm</p>
                        </a>
                    </div>
                    <p class="pd-10">|</p>
                    <div class="gioithieusp">
                        <a href="javascript:void(0);" onclick="showSpecs();">
                            <p>Thông số cấu hình</p>
                        </a>
                    </div>
                </div>
                <div class="line7"></div>
                <div class="container sreenttinchitiet col-md-12">
                    <div id="thongsokithuat" class="noidungthongso">
                        <?php echo $viewProduct->description; ?>
                    </div>
                    <div id="gioithieusanpham" class="noidungthongso">
                        <?php echo $viewProduct->introduction; ?>
                    </div>
                </div>
                <div class="product-col-right col-md-4">
                    <div class="right">
                        <div class="sreenonline right-box">
                            <div class="toponline">
                                <h2>Có thể bạn quan tâm</h2>
                            </div>
                            <div class="line-title">
                                <div class="left-30">&nbsp;</div>
                                <div class="left-70">&nbsp;</div>
                            </div>
                            <div class="midonline">
                                <div class="product-news-right">
                                    <?php foreach ($san_pham_cung_gia as $eachProduct) : ?>
                                    <div class="product-news-right-item">
                                        <a href="<?php echo base_url($eachProduct->link_rewrite); ?>" class="img-product-news">
                                            <img src="<?php echo image('files/logo/ads/'.$eachProduct->logo, 'product_65_86'); ?>" alt="<?php echo $eachProduct->producer . ' ' . $eachProduct->model ?>">
                                        </a>
                                        <div class="product-news-right-info">
                                            <a href="<?php echo base_url($eachProduct->link_rewrite); ?>"><?php echo $eachProduct->producer . ' ' . $eachProduct->model ?></a>
                                            <p class="product-new-right-price">Giá: <span><?php echo number_format($eachProduct->price, "0", ",", "."); ?> đ</span>
                                            </p>
                                            <p class="product-new-right-status">
                                                <?php if ($eachProduct->moi_ve == 1) { ?>
                                                <span class="pr-news">Mới</span>
                                                <?php } ?>
                                                <?php if ($eachProduct->qua_tang == 1) { ?>
                                                <span class="pr-gift">Quà tặng</span>
                                                <?php } ?>
                                                <?php if ($eachProduct->gia_tot == 1) { ?>
                                                <span class="pr-good-price">Giá sốc</span>
                                                <?php } ?>
                                            </p>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        
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
<script>
    function showIntroduce() {
        document.getElementById("gioithieusanpham").style.display = "block";
        document.getElementById("thongsokithuat").style.display = "none";
    }
    function showSpecs() {
        document.getElementById("gioithieusanpham").style.display = "none";
        document.getElementById("thongsokithuat").style.display = "block";
    }
</script>