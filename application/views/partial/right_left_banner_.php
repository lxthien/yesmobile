<?php 
$left_advertise = $this->advertise_model->read_by_id(2);
$right_advertise = $this->advertise_model->read_by_id(3);

if($left_advertise->logo != '' && $left_advertise->logo != null) {
?>	
<div class="banner-left" style="bottom: 213.167px;">
	<a href="<?php echo $left_advertise->url;?>"><img width="150" src="<?php echo base_url(PARTNER_LOGO . '/ads/' . $left_advertise->logo);?>"></a>
</div>
<?php 
}
if($right_advertise->logo != '' && $right_advertise->logo != null) {
?>
<div class="banner-right" style="bottom: 213.167px;">
	<a href="<?php echo $right_advertise->url;?>"><img width="150" src="<?php echo base_url(PARTNER_LOGO . '/ads/' . $right_advertise->logo);?>"></a>
</div>	
<?php }?>

