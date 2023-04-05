<div class="nav">
    <a href="<?php echo base_url(); ?>">Trang chủ</a>
    <span><?php echo 'Tìm kiếm'; ?></span>
</div>

<?php
if (isset($eachProductList)) {
    ?>
    <div class="allboxsp1">
        <div class="title">
            <h1><?php echo $value; ?></h1>
            <div class="title1" style="background-color:#cccccc; width:980px; height:2px; margin-bottom:20px; float:left;"></div>
        </div>
        <div class="sp_sub_category">
            <div class="sreensp1" style="width:980px; margin-left:0px; float:left; margin-bottom:15px;">
            <?php
            $index = 1;
            for ($i = 0; $i < count($eachProductList); $i++) {
                ?>
                <div class="boxsp">
                    <div class="sp3">
                        <a href="<?php echo base_url($eachProductList[$i]->link_rewrite); ?>">
                            <img alt="<?php echo $eachProductList[$i]->producer . ' ' . $eachProductList[$i]->model ?>"
                                src="<?php echo base_url(PARTNER_LOGO . '/ads/' . $eachProductList[$i]->logo) ?>"/>
                        </a>
                    </div>
                    <div class="titlesp">
                        <a href="<?php echo base_url($eachProductList[$i]->link_rewrite); ?>">
                            <p style="font-size: 13px;"><?php echo $eachProductList[$i]->producer . ' ' . $eachProductList[$i]->model ?></p>
                        </a>
                    </div>
                    <?php
                    if ($eachProductList[$i]->gia_cu != 0 && $eachProductList[$i]->gia_cu != '' && $eachProductList[$i]->gia_cu != null) {
                    ?>
                        <div class="pricespold"><?php echo number_format($eachProductList[$i]->gia_cu, "0", ",", "."); ?> đ</div>
                    <?php } ?>
                    <p class="pricespnew"><?php echo number_format($eachProductList[$i]->price, "0", ",", "."); ?> đ</p>
                    <div class="boxsale">
                        <?php if ($eachProductList[$i]->sap_ve == 1) { ?>
                        <a href="<?php echo base_url($eachProductList[$i]->link_rewrite); ?>"><span>SV</span></a><?php } ?>
                        <?php if ($eachProductList[$i]->moi_ve == 1) { ?>
                        <a class="sp-news" href="<?php echo base_url($eachProductList[$i]->link_rewrite); ?>"><span>Mới</span></a><?php } ?>
                        <?php if ($eachProductList[$i]->gia_tot == 1) { ?>
                        <a class="sp-gs" href="<?php echo base_url($eachProductList[$i]->link_rewrite); ?>"><span>Giá sốc</span></a><?php } ?>
                        <?php if ($eachProductList[$i]->qua_tang == 1) { ?>
                        <a href="<?php echo base_url($eachProductList[$i]->link_rewrite); ?>"><span>Quà tặng</span></a><?php } ?>
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
?>