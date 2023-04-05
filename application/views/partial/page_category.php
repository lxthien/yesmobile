<!--Display category on left side of page-->
<?php if ( isset($page_categories)) :?>
    <div class="tabtintucsukien"></div>
        <div class="frametintucsukien">
            <?php 
                $isNextItem = false;
            foreach ($page_categories as $key => $value):?>                                            
                <?php                
                    if ($isNextItem) {
                        echo '<p class="line3"></p>';
                    }
                    $isNextItem = true;
                    
                ?>             
                <div class="framecontenttintucsukien">                    
                    <p class="icon4"><img src="<?php echo RES_PATH;?>images/icon10.png" /></p>                    
                    <p class="contenttintucsukien"><a href="<?php echo base_url($value->link_rewrite); ?>">
                        <?php  echo $value->name; ?></a> 
                    </p>                    
                </div>
            <?php endforeach; ?>            
</div>
<?php endif;?>