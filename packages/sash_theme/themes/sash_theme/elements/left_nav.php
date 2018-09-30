<?php
$page = $c->getCollectionName();

if ($page == "HOME") {
    $nav_class = "nav_wrap_start";
} else {
    $nav_class = "nav_wrapleft";
}

?> 
        <!-- Nav Wrap -->
        <div class="<?= $nav_class; ?>">
        
            <!-- Logo -->
            <div class="logo"><img src="<?=$this->getThemePath()?>/images/logo.png" alt="Moot - Coming Soon/Under Constructino Template"></div>
            <!-- Logo -->
            
            <div class="clear"></div>
            
            <!-- Navigation Area -->
            <div class="nav">
            <?php 
                $subnav = BlockType::getByHandle('autonav');
                $subnav->controller->orderBy = 'display_asc';
                $subnav->controller->displayPages = 'custom';
                $subnav->controller->displayPagesCID = '1';
                $subnav->controller->displaySubPages = 'all';
                $subnav->controller->displaySubPageLevels = 'all';
                $subnav->controller->displayPagesIncludeSelf = '1';
                $subnav->render('templates/side_nav'); 
            ?>
			</div>
            <!-- Navigation Area -->
            
            <div class="clear"></div>
            
         
            <!-- Social Icons Section -->
            <div class="socialicons">
            
                <a href="https://twitter.com/GoldenSashBrida" title="Follow Us On Twitter" target="_blank"><img src="<?=$this->getThemePath()?>/images/twitter.png" alt="Follow Us On Twitter"></a> 
                <!-- <a href="#" title="Follow Us" target="_blank"><img src="<?=$this->getThemePath()?>/images/dribbble.png" alt="Follow Us On Dribbble"></a> -->
                <a href="https://www.facebook.com/goldensashbridaluk/" title="Follow Us On Facebook" target="_blank"><img src="<?=$this->getThemePath()?>/images/facebook.png" alt="Follow Us On Facebook"></a>
                <!-- <a href="#" title="Follow Us"><img src="<?=$this->getThemePath()?>/images/linkedin.png" alt="Follow Us On Linked In"></a> -->
                <a href="http://instagram.com/goldensashbridal" title="Follow Us On Instagram"  target="_blank"><img src="<?=$this->getThemePath()?>/images/instagram-logo.png" alt="Follow Us On Instagram"></a> 
                <a href="https://www.pinterest.com/goldensash" title="Follow Us On Pinterest" target="_blank"><img src="<?=$this->getThemePath()?>/images/pinterestIcon.png" alt="Follow Us On Pinterest"></a>
                <a href="https://plus.google.com/116664496213727508855" title="Follow Us On Google+" target="_blank"><img src="<?=$this->getThemePath()?>/images/gplus.png" alt="Follow Us On Google+"></a>               
            </div>
            <!-- Social Icons Section -->
        
        </div>
        <!-- Nav Wrap -->
       	<div class="clear"></div>
