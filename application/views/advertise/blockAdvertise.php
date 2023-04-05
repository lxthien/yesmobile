<?php

foreach ($advertises as $advertise) {
    echo '<div class="qc2">';
    echo '<a href ="'. $advertise->url .'" title ="'.$advertise->company.'" alt ="'.$advertise->company.'">';
    echo '<img src="' . base_url(PARTNER_LOGO . '/ads/' . $advertise->logo) . '" width="654" height="auto"/>';
    echo '</a>';
    echo '</div>';
}
?>