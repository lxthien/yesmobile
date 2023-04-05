<?php
if (isset($listItem)) {
    foreach ($listItem as $item):
        $date_post = new DateTime($item->date_add);
        ?>
        
        <div class="sreenttin" style="width:648px; height:105px; float:left; margin-top:10px;">
		       	
		       	<div class="hinhcongnghe"><img src="<?php echo base_url() . $item->news_icon; ?>" /></div>
		             <div class="titlecongnghe"><a href="<?php echo base_url($item->link_rewrite); ?>">
		             <p style="width:500px; float:left; height:20px;"><?php echo $item->title; ?></p>
		             </a></div>
					 <div class="noidungcongnghe" style="margin-left:10px; float:left; width:490px; height:100px;">
					 <p align="justify"><?php echo $item->content; ?></p>					 
					 
					 </div>
		   		</div>	 
		        <div class="line3"></div>
    <?php
    endforeach;
}?>

				