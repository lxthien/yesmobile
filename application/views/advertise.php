<?php
if (!empty($advertises)){ 
    foreach ($advertises as $key => $value): ?>
        <div class="qc2"><img src="<?php echo $value; ?>" /></div>
<?php endforeach; } ?>
