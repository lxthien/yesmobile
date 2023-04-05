<div class="allboxsp1" style="float:left;">
	<h1 style="font-weight:bold; font-size:16px; margin-bottom:3px; margin-left: 0px; text-transform: uppercase;"><?php echo $selectedCategory->name; ?></h1>
	<div class="line-title">
		<div class="left-30">&nbsp;</div>
		<div class="left-70">&nbsp;</div>
	</div>
    <div class="ttincongghe">
		<?php
            if (isset($downloadList)) {
                $data = array();
                foreach ($downloadList as $item) : ?>
                	<div class="sreenttin" style="width: 675px; height: 105px; float: left;">
						<div class="hinhcongnghe"><img src="<?php echo base_url().'assets/images/'.$item->icon; ?>" alt="<?php echo $item->name; ?>" /></div>
						<div class="titlecongnghe">
							<a href="<?php echo base_url($item->link_rewrite); ?>">
								<p style="width: 500px; float: left; margin-bottom: 3px;"><?php echo $item->name; ?></p>
							</a>
						</div>
						<div class="noidungcongnghe" style="float: left; width: 465px; height: 85px;">
							<p class="date-technology"><?php $date_post = new DateTime($item->date_add); echo date_format($date_post,'d/m/Y'); ?></p>
							<p align="justify">
								<?php echo $item->description; ?>
							</p>
						</div>
					</div>
                    <?php
                endforeach;
            }
        ?>
		<div class="phantrang" style="float:right; width:108px; height:20px;">
			<div class="back">
				<a href="<?php echo base_url('tai-ve');?>"><p>Xem tất cả các mục</p></a> 		 
			</div>
	    </div>				   		
  	</div>
</div>