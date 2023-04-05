<?php
	if (isset($site_meta_data)) {
	    $this->load->view('partial/header', $site_meta_data);
	} else {
	    $this->load->view('partial/header');
	}
	$this->load->view('partial/menu');
?>
  	<div class="row main main-product product-page clearfix">
		<div class="left col-md-12">
			<?php echo $product_block_main;?>
		</div>
		<div class="clearfix"></div>
		<div class="container">
			<?php $this->load->view('home/block_service'); ?>
		</div>
  	</div>
<?php $this->load->view('partial/right_left_banner'); ?>
<?php $this->load->view('partial/footer'); ?>