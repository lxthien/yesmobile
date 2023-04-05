<?php
    if (isset($site_meta_data)) {
        $this->load->view('partial/header', $site_meta_data);
    } else {
        $this->load->view('partial/header');
    }
    $this->load->view('partial/menu');
?>

<div class="row main <?php echo $this->router->fetch_method(); ?>">
    <div class="main-service-detail col-md-12"> 
    	<?php
            $this->load->view('partial/pageSecondRight');    
    	?>
    </div>
</div>
<?php $this->load->view('partial/right_left_banner'); ?>    
<?php $this->load->view('partial/footer'); ?>    