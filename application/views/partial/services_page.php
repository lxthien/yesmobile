<div class="allboxsp1">
	<div class="sub-category-service" abc="<?php echo $level; ?>">
		<?php if($level == 2): ?>
			<h1><?php echo $catServices->name.' tại Vũng Tàu, Long Sơn'; ?></h1>
		<?php else: ?>
			<h1><?php echo $catServices->name.' tại Vũng Tàu, Long Sơn'; ?></h1>
		<?php endif; ?>
		<!-- <p>Chọn mục bạn cần sửa:</p> -->
		<ul>
			<?php foreach ($categoryServices as $row): ?>
			<li><a class="<?php echo $catServices->id_news_category == $row->id_news_category ? 'breadcrumb-active' : ''; ?>" href="<?php echo base_url('dich-vu/'.$row->link_rewrite); ?>" title="<?php echo $row->name; ?>"><?php echo $row->name; ?></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php if(count($services) > 0): ?>
	<?php
		foreach ($services as $row) :
			$date_post = new DateTime($row->date_add);
	?>
		<div class="box-service">
			<a href="<?php echo base_url($row->id_news.'-'.$row->link_rewrite.URL_TRAIL); ?>" class="img-server" title="<?php echo $row->title; ?>">
				<img title="<?php echo $row->title; ?> tại Vũng Tàu, Long Sơn" src="<?php echo image($row->news_icon, 'news_220_160'); ?>" alt="<?php echo $row->title; ?> tại Vũng Tàu, Long Sơn"  />
			</a>
			<div class="right-box-service">
				<a href="<?php echo base_url($row->id_news.'-'.$row->link_rewrite.URL_TRAIL); ?>" title="<?php echo $row->title; ?>"><?php echo $row->title; ?></a>
				<div class="des-service">
					<?php if ($row->price != 0) : ?>
						<p class="product-price-text">
							Giá: <span><?php echo number_format($row->price, "0", ",", "."); ?> vnđ</span>
						</p>
					<?php else: ?>
						<p class="product-price-text">Giá: <span>Xin vui lòng liên hệ</span></p>
					<?php endif; ?>
					<p>Thời gian sửa chữa: <?php echo $row->time_repair != null ? $row->time_repair : 'Đang cập nhật ...'; ?></p>
					<p>Thời gian bảo hành: <?php echo $row->time_service != null ? $row->time_service : 'Đang cập nhật ...'; ?></p>
					<?php //echo $row->content; ?>
				</div>
			</div>
		</div>
	<?php
		endforeach;
	?>
		<div class="phantrang row">
			<div class="back col-md-12">
				<?php echo $this->pagination->create_links(); ?>
			</div>
		</div>
	<?php else: ?>
		<p class="no-item">Chưa có bài viết cho danh mục này</p>
	<?php endif; ?>
</div>