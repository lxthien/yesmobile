<div class="allboxsp1">
	<h1 class="h1-title"><?php echo $category_name;?></h1>
 	<div class="line-title">
		<div class="left-30">&nbsp;</div>
		<div class="left-70">&nbsp;</div>
	</div>
	<div class="ttincongghe">
		<?php
		if (isset($all_news)) {
		    $i = 0;
		    foreach ($all_news as $item):
		        $date_post = new DateTime($item->date_add);
		        ?>
				<div class="box-service">
					<a href="<?php echo base_url($item->link_rewrite); ?>" title="<?php echo $item->title; ?>">
						<img class="img-server" alt="<?php echo $item->title; ?>" src="<?php echo image($item->news_icon, 'news_220_160'); ?>" />
					</a>
					<div class="right-box-service">
						<a href="<?php echo base_url($item->link_rewrite); ?>" title="<?php echo $item->title; ?>"><?php echo $item->title; ?></a>
						<p class="des-service"><?php echo $item->content; ?></p>
					</div>
				</div>
		    <?php
		    endforeach;
		}
		?>
		<div class="phantrang">
			<div class="back">
				<?php echo $this->pagination->create_links(); ?>
			</div>
		</div>
	</div>
</div>