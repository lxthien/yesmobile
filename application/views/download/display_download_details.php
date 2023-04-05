<?php
	if (isset($selectedDownload)):
?>
	<div class="ttincongghe">
		<?php 
		if (1) {
		?>
		<div class="sreentieude" style="margin: 0; padding: 0; width: 100%;">
			<div class="tieude" style="font-size:16px; font-weight:bold;" >
			    <h1 class="h1-title-detail"><?php echo $selectedDownload->name;?></h1>
		    </div>
		    <div class="main-news-social">
		    	<div class="social">
		    		<!-- Button like facebook -->
	                <div class="fb-like" data-href="<?php echo $urlSocial; ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
	                <!-- Button like facebook -->
	                <!-- Place this tag where you want the +1 button to render. -->
	                <div class="g-plusone" data-size="medium" data-href="<?php echo $urlSocial; ?>"></div>
	                <!-- Place this tag where you want the +1 button to render. -->
	                <!-- Button share facebook -->
	                <div class="fb-share-button" data-href="<?php echo $urlSocial; ?>" data-layout="button"></div>
	                <!-- Button share facebook -->
	                <!-- Place this tag where you want the share button to render. -->
	                <div class="g-plus" data-action="share" data-annotation="bubble" data-href="<?php echo $urlSocial; ?>"></div>
		    	</div>
		    	<span class="time-update-news">Cập nhật: <?php $date_post = new DateTime($selectedDownload->date_add); echo date_format($date_post,'d/m/Y'); ?></span>
		    </div>
		</div>
		<div align="justify" class="noidungthitruongchitiet" style="width:675px; margin-top:8px;">
			<p><?php echo $selectedDownload->description;?></p>
			<p align="justify">&nbsp;</p>	
		</div>
		
		<?php if (count($downloadList) > 1): ?>
	    <div class="cactinkhac2">
			<h3 class="h3-news-related">Các tin khác</h3>
			<div class="main-news-related">
				<?php             
			        foreach ($downloadList as $post): 
			        	if($post->id != $selectedDownload->id) {
			        	$posted_date = new DateTime($post->date_add);
			    ?>
					<div class="sreentieude">
						<a class="img-news-related" href="<?php echo base_url($post->link_rewrite);?>">
							<img src="<?php echo image('assets/images/'.$post->icon, 'news_100_75'); ?>" alt="<?php echo $post->name;?>">
						</a>
						<div class="sreentinkhacchitiet">
							<a title="<?php echo $post->name;?>" href="<?php echo base_url($post->link_rewrite);?>">
				   				<span><?php echo $post->name;?></span>
				   			</a>
				   			<p class="des-news-related"><?php echo $post->description; ?></p>
				   			<p class="date-news-related">
				   				<?php  echo @date_format($posted_date,'d/m/Y');?>
				   			</p>
					 	</div>	 
					 </div>
				<?php
					}
			        endforeach;
			    ?>
			</div>
		</div>
		<?php endif; ?>
	    
	    <?php 
			} else {
		?>
	    <div class="sreentieude" style=" width:610px; margin-left:20px; margin-top:10px;">
			<div class="tieude" style="font-size:16px; font-weight:bold;" >
	        	&nbsp;
	        </div>   
		</div>
		<div  align="justify" class="noidungthitruongchitiet" style="width:610px; margin-bottom:1px; margin-left:20px; margin-top:5px;">
			  <p>Hiện tại chưa có nội dung trong mục này</p>
		</div>
		<?php 
	    	}
		?>
	</div>
<?php endif; ?>