<div class="row">
    <div class="sreenbaner col-md-12">
        <div class="main-slider">
            <div class="slider-wrapper theme-bar">
                <div id="slider" class="nivoSlider">
                    <?php if (sizeof($banners) ==0) {
                        echo '<img src="'.image('/assets/images/banner.png', 'slider_625_277').'" data-thumb="'.base_url().'assets/images/banner.png" />';
                    } else {
                        foreach($banners as $banner){
                            if (isset($banner->url) &&  trim($banner->url) !== ''){
                                echo '<a href="'.$banner->url.'"><img src="'.image('assets/images/banners/'.$banner->image, 'slider_625_277').'" data-thumb="'.  base_url(BANNER_PATH).'/'.$banner->image.'" alt="" title="'.$banner->title.'" /></a>';
                            } else {                            
                                echo '<img src="'.image('assets/images/banners/'.$banner->image, 'slider_625_277').'" data-thumb="'.  base_url(BANNER_PATH).'/'.$banner->image.'" alt="" title="'.$banner->title.'" />';
                            }
                        }
                    } ?>
                </div>
            </div>
        </div>
        <div class="banner d-none d-lg-block">
            <div class="row">
                <div class="col-md-6 col-6 ml">
                    <a href="https://yesmobile.vn/#">
                        <img src="<?php echo image('assets/images/sua-chua.jpg', 'banner_168_87'); ?>">
                    </a>
                </div>
                <div class="col-md-6 col-6 mr">
                    <a href="https://yesmobile.vn/#">
                        <img src="<?php echo image('assets/images/ep-kinh.jpg', 'banner_168_87'); ?>">
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-6 ml">
                    <a href="https://yesmobile.vn/tuyen-dung.html">
                        <img src="<?php echo image('assets/images/phu-kien.png', 'banner_168_87'); ?>">
                    </a>
                </div>
                <div class="col-md-6 col-6 mr">
                    <a href="#">
                        <img src="<?php echo image('assets/images/tuyen-dung.jpg', 'banner_168_87'); ?>">
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <a href="#">
                        <img src="<?php echo image('assets/images/banner-iPad-389x1467101.jpg', 'banner_345_87'); ?>">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>