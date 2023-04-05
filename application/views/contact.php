<?php
if (isset($site_meta_data)) {
    $this->load->view('partial/header', $site_meta_data);
} else {
    $this->load->view('partial/header');
}
$this->load->view('partial/menu');
//echo '<div class="baner"></div>';

//$this->load->view('home/block_banner'); 
?>

	<!--main-->	
	<div class="row main contact">
		<div class="nav nav-contact">
		    <a href="<?php echo base_url(); ?>">Trang chủ</a>
		    <span>Liên hệ</span>
		</div>
		<!-- left-->	
	 	<div class="left col-md-8">
    		<?php $this->load->view('lienHe/lien_he');?>
		</div>
		<!--end left-->	
		<!--right-->		 
		<div class="right col-md-4">
			<!--download-->
			<?php  $this->load->view('download/blockDownload'); ?>
			<!--end download-->
		</div>
		<!--end right-->
	</div>
	<!--doitac-->
	<?php $this->load->view('home/block_service'); ?>
	<!--end doitac-->
<?php $this->load->view('partial/right_left_banner'); ?>
<?php $this->load->view('partial/footer'); ?>