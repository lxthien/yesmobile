<?php $cropImage = 'product_100_133'; ?>

<div class="nav">
    <a href="<?php echo base_url(); ?>">Trang chủ</a>
    <?php if($this->uri->segment(2) == 'phu-kien-dien-thoai' ): ?>
        <span>Phụ kiện diện thoại</span>
        <?php $cropImage = 'product_100_143'; ?>
    <?php else: ?>
        <span>Điện thoại</span>
    <?php endif; ?>
</div>
<div class="clearfix"></div>

<?php
if (isset($childrenCategories)) {
    foreach ($childrenCategories as $each) {
        $eachProductList = $each->productList;
        if (count($eachProductList) > 0) {
            ?>
            <div class="allboxsp1 product-list-page <?php echo $this->uri->segment(2) === 'phu-kien-dien-thoai' ? 'phu-kien' : 'san-pham'; ?>">
                <div class="title">
                    <h1><?php echo $each->name; ?></h1>
                    <div class="title1"></div>
                </div>
                <div class="spbanchay">
                    <div class="sreensp1 row">
                    <?php
                        $index = 1;
                        for ($i = 0; $i < count($eachProductList); $i++) {
                    ?>
                        <div class="boxsp col-md-3 col-12">
                            <div class="sp3">
                                <a href="<?php echo base_url($eachProductList[$i]->link_rewrite); ?>">
                                    <img alt="<?php echo $eachProductList[$i]->producer . ' ' . $eachProductList[$i]->model ?>" src="<?php echo image('files/logo/ads/'.$eachProductList[$i]->logo, $cropImage); ?>"/>
                                </a>
                            </div>
                            <div class="titlesp">
                                <a href="<?php echo base_url($eachProductList[$i]->link_rewrite); ?>">
                                    <p><?php echo $eachProductList[$i]->producer . ' ' . $eachProductList[$i]->model ?></p>
                                </a>
                            </div>
                            <?php
                                if ($eachProductList[$i]->gia_cu != 0 && $eachProductList[$i]->gia_cu != '' && $eachProductList[$i]->gia_cu != null) {
                            ?>
                                <div class="pricespold"><?php echo number_format($eachProductList[$i]->gia_cu, "0", ",", "."); ?> đ</div>
                            <?php } ?>
                            <p class="pricespnew">Giá: <?php echo number_format($eachProductList[$i]->price, "0", ",", "."); ?> đ</p>
                            <div class="boxsale">
                                <?php if ($eachProductList[$i]->sap_ve == 1) { ?>
                                <a href="<?php echo base_url($eachProductList[$i]->link_rewrite); ?>"><span>SV</span></a><?php } ?>
                                <?php if ($eachProductList[$i]->moi_ve == 1) { ?>
                                <a class="sp-news" href="<?php echo base_url($eachProductList[$i]->link_rewrite); ?>"><span>Mới</span></a><?php } ?>
                                <?php if ($eachProductList[$i]->gia_tot == 1) { ?>
                                <a class="sp-gs" href="<?php echo base_url($eachProductList[$i]->link_rewrite); ?>"><span>Giá sốc</span></a><?php } ?>
                                <?php if ($eachProductList[$i]->qua_tang == 1) { ?>
                                <a class="sp-giff" href="<?php echo base_url($eachProductList[$i]->link_rewrite); ?>"><span>Quà tặng</span></a><?php } ?>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        <?php
        }
    }
}
?>