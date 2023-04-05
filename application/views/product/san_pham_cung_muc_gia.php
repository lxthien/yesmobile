<p align="center" style=" color:#005cda; font-size:16px; font-weight:bold;">Tư vấn 24/24</p>
<div class="tuvan"></div>
<div class="sreendownload" style=" width:237px; margin-bottom:20px; float:left;">
    <h4><p align="center" style="color:#424242; font-size:16px; font-weight:bold; margin-bottom:3px;">Sản phẩm cùng mức giá</p></h4>
    <div class="titledownload" style="margin-bottom: 10px;"></div>
    <div class="boxmucgia">
        <?php
        if (isset($san_pham_cung_gia)) {
            foreach ($san_pham_cung_gia as $each) {
                ?>
                <div class="boxsp">
                    <div class="sp3" align="center">
                        <a title="<?php echo $each->model; ?>" href="<?php echo base_url($each->link_rewrite); ?>"><img src="<?php echo base_url(PARTNER_LOGO . '/ads/' . $each->logo); ?>" width="90" height="119"/></a>
                    </div>
                    <div class="titlesp">
                        <a href="<?php echo base_url($each->link_rewrite); ?>"><p align="center" style=" margin-top:-20px;width:163px;"><?php echo $each->model; ?></p></a>
                    </div>
                    <?php
                    if ($each->gia_cu != 0 && $each->gia_cu != '' && $each->gia_cu != null) {
                        ?>
                        <div class="pricespold" align="center"><?php echo number_format($each->gia_cu, "0", ",", "."); ?> VNÐ</div>
                    <?php
                    }
                    ?>
                    <div class="pricespnew" align="center"><?php echo number_format($each->price, "0", ",", "."); ?>
                        VNÐ
                    </div>
                </div>
                <div class="linedot"></div>
            <?php
            }
        }
        ?>
    </div>
</div>