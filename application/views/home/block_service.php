<div class="row home-service">
	<div class="col-md-12">
		<div class="title-service relative">
			<hr />
			<h2>Dịch vụ sửa chữa nổi bật trong tuần</h2>
		</div>
		<div class="main-service-bxslider">
			<div id="service-bxslider">
				<?php foreach ( $servicesHomepages as $_watch ): ?>
				<div class="slide">
					<a class="image" href="<?php echo base_url($_watch->id_news.'-'.$_watch->link_rewrite.URL_TRAIL); ?>">
						<img src="<?php echo image($_watch->news_icon, 'news_121_80'); ?>" alt="<?php echo $_watch->title; ?>">
					</a>
					<a class="name" href="<?php echo base_url($_watch->id_news.'-'.$_watch->link_rewrite.URL_TRAIL); ?>">
						<p><?php echo $_watch->title; ?></p>
					</a>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>