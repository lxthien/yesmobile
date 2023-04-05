<div class="allboxsp1 col-md-12">
	<?php if(empty($show_cam_nang)): ?>
		<h1 class="h1-title">Tin tức</h1>
	<?php else: ?>
		<h1 class="h1-title">Cẩm nang</h1>
	<?php endif; ?>
	<div class="line-title">
		<div class="left-30">&nbsp;</div>
		<div class="left-70">&nbsp;</div>
	</div>
	<div class="ttincongghe">
		<?php 
		if (isset($news)) {
			$this->load->model('News_category_model', 'category_model');
		    foreach ($news as $item):
		    	$categoryUrl = getCategory($item->id_news_category);
		        $date_post = new DateTime($item->date_add);
		?>
				<div class="box-service">
					<a href="<?php echo base_url($category.'/'.$categoryUrl.'/'.$item->id_news.'-'.$item->link_rewrite. URL_TRAIL); ?>" title="<?php echo $item->title; ?>" class="img-server" >
						<img src="<?php echo image($item->news_icon, 'news_220_160'); ?>" alt="<?php echo $item->title; ?>" />
					</a>
					<div class="right-box-service">
						<a href="<?php echo base_url($category.'/'.$categoryUrl.'/'.$item->id_news.'-'.$item->link_rewrite. URL_TRAIL); ?>" title="<?php echo $item->title; ?>">
							<?php echo $item->title; ?>
						</a>
						<p class="des-service">
							<?php echo $item->content; ?>
						</p>
					</div>
				</div>
			<?php
		    	endforeach;
			}
		?>		                
		<div class="phantrang">
			<div class="back">
				<?php 
					echo $this->pagination->create_links();
				?>
			</div>
		</div>
    </div>
</div>