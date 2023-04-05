<?php
	foreach ($site_meta_data as $each) {
		//echo $each."<br>";
	}
	if (isset($site_meta_data)) {
		$this->load->view('partial/header', $site_meta_data);
	} else {
		$this->load->view('partial/header');
	}
		$this->load->view('partial/menu');
		$this->load->view('home/block_banner');
		$this->load->view('home/block_service');
	?>
	<script type="application/ld+json">
	</script>
	<!--main-->	
  	<div class="row main">
	 	<div class="left col-md-8">
			<!--spbanchay-->	
			<?php $this->load->view('home/blockBestSellProduct'); ?>
			<!--end spbanchay-->
			<!--spbanhot--> 
		 	<?php $this->load->view('home/blockPhuKienHot'); ?>
			<!--end spbanhot-->
			<!--spbanmoi-->
			<?php // $this->load->view('home/blockNewProduct'); ?>
			<!--end spbanmoi-->

			<?php $this->load->view('home/home_tin_cong_nghe'); ?>
	 	</div>	 
 		<div class="right col-md-4">
			<!--download-->
			<?php  $this->load->view('download/blockDownload'); ?>
			<!--end download-->
			<!--qc-->
			<?php //$this->load->view('partial/right_column_ads'); ?>
			<!--end qc-->
		</div>
		<?php $this->load->view('home/home_tin_cong_nghe'); ?>
  	</div>
	<?php //$this->load->view('partial/right_left_banner'); ?>
<?php $this->load->view('partial/footer'); ?>