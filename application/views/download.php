<?php
	if (isset($site_meta_data)) {
		$this->load->view('partial/header', $site_meta_data);
	} else {
		$this->load->view('partial/header');
	}
	$this->load->view('partial/menu');
?>

<!--main-->	
<div class="main">
	<!-- left-->	
	<div class="left">
		<?php echo $download_block_main;?>		      
	</div>
	<!--end left-->	
	<!--right-->		 
 	<div class="right">
		<!--download-->
		<?php  $this->load->view('download/blockDownload'); ?>
		<!--end download-->
 	</div>
	<!--end right-->
</div>
<?php $this->load->view('partial/right_left_banner'); ?>
<?php $this->load->view('partial/footer'); ?>