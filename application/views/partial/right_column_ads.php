<?php

$advertise = $this->advertise_model->read_by_id(1);
$advertise_5 = $this->advertise_model->read_by_id(5);
$advertise_6 = $this->advertise_model->read_by_id(6);

if($advertise->logo != '' && $advertise->logo != null) {
	echo '<div class="qc">';
	echo '<a href ="' . $advertise->url . '" title ="' . $advertise->company . '" alt ="' . $advertise->company . '">';
	echo '<img src="' . base_url(PARTNER_LOGO . '/ads/' . $advertise->logo) . '" />';
	echo '</a>';
	echo '</div>';
}
if($advertise_5->logo != '' && $advertise_5->logo != null) {
    echo '<div class="qc">';
    echo '<a href ="' . $advertise_5->url . '" title ="' . $advertise_5->company . '" alt ="' . $advertise_5->company . '">';
    echo '<img height="auto" src="' . base_url(PARTNER_LOGO . '/ads/' . $advertise_5->logo) . '" />';
    echo '</a>';
    echo '</div>';
}
/*if( $advertise_6->id != '' ){
    if($advertise_6->logo != '' && $advertise_6->logo != null) {
        echo '<div class="qc">';
        echo '<a href ="' . $advertise_6->url . '" title ="' . $advertise_6->company . '" alt ="' . $advertise_6->company . '">';
        echo '<img src="' . base_url(PARTNER_LOGO . '/ads/' . $advertise_6->logo) . '" />';
        echo '</a>';
        echo '</div>';
    }
}*/

?>
