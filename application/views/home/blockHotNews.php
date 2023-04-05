<?php /*revieve */
//var_dump($tinNoiBat);
if(count($tinNoiBat) > 0):
$newestNews = $tinNoiBat[0];
unset($tinNoiBat[0]);
?>
<div class="boxnewcontent">
        <p style="font-weight:bold; margin:5px 0px 0px 0px; font-size:16px; color:#636363;text-align:left;">
            <a href="<?php echo base_url($newestNews['link_rewrite']); ?>">
                <?php echo $newestNews['title'];?>
            </a>
        </p>
        <div class="picnewcontent"><img src="<?php echo $newestNews['news_icon']?>" /></div>
        <p style="font-size:15px; color:#676767; text-align:left; width:320px;"> <?php echo $newestNews['content']?></p>
        <p class="detail"><a href="<?php echo base_url($newestNews['link_rewrite']); ?>">Chi tiết</a></p>
</div>            
<div  class="line1"></div>

<div  class="line1"></div>

<?php 
$index =1;
foreach ($tinNoiBat as $item):?>
<div class="boxnew<?php echo $index; $index ++;?>">
        <div class="picnew1"><img src="<?php echo $item['news_icon'];?>" /></div>
        <p  class="news_title" style="text-align:left;"><a href="<?php echo base_url($item['link_rewrite']);?>"><?php echo $item['title']; ?></a></p>
        <p  class="contentnew1"><?php echo $item['content']; ?></p>
        <p  class="detail"><a href="<?php echo base_url($item['link_rewrite']);?>">Chi tiết...</a></p>
</div>
<?php endforeach; ?>
<?php endif;?>