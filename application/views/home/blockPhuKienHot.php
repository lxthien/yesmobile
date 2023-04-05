<div class="sreensphot home-accessories">
	<h1 class="h1-title">PHỤ KIỆN ĐIỆN THOẠI</h1>
	<div class="line-title">
		<div class="left-30">&nbsp;</div>
		<div class="left-70">&nbsp;</div>
	</div>
	<div class="phu-kien-hot">
		<ul id="slider1">
			<li>
			<?php 
			$index = 0;
			foreach($phuKienHot as $each) {
				$index++;
			?>			  
				<div class="boxsp2" align="center">
					<div class="sp2" align="center">
						<a href="<?php echo base_url($each->link_rewrite);?>"><img alt="<?php echo $each->model?>" src="<?php echo base_url(PARTNER_LOGO. '/ads/' . $each->logo)?>"/></a></div>
					   		<div class="titlesp3"><a href="<?php echo base_url($each->link_rewrite);?>">
					   		<p><?php echo $each->model?></p>
					   	</a>
					</div>
					<div class="pricesphot"><span style="color: #FF0000;"><?php echo number_format($each->price,"0",",",".");?> VNÐ</span></div>
				</div>
			<?php 
				if($index % 4 == 0 && $index != count($phuKienHot)) {
					echo '</li><li>';
				}
			}
			?>		 
			</li>
		</ul>
	</div>
</div>