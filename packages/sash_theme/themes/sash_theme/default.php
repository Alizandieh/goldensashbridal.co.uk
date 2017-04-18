<?php   
defined('C5_EXECUTE') or die(_("Access Denied."));
$this->inc('elements/header.php'); ?>
	

        <!-- Nav Wrap -->
        <div class="nav_wrap_start">
        
            <!-- Logo -->
            <div class="logo_home"><img src="<?=$this->getThemePath()?>/images/logo.png" alt="Moot - Coming Soon/Under Constructino Template"></div>
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
            
                <a href="https://twitter.com/GoldnSashBridal" title="Follow Us On Twitter" target="_blank"><img src="<?=$this->getThemePath()?>/images/twitter.png" alt="Follow Us On Twitter"></a>
                <!-- <a href="#" title="Follow Us" target="_blank"><img src="<?=$this->getThemePath()?>/images/dribbble.png" alt="Follow Us On Dribbble"></a> -->
                <a href="http://www.facebook.com/pages/Golden-Sash-Bridal/320267018079163" title="Follow Us On Facebook" target="_blank"><img src="<?=$this->getThemePath()?>/images/facebook.png" alt="Follow Us On Facebook"></a>
                <!-- <a href="#" title="Follow Us"><img src="<?=$this->getThemePath()?>/images/linkedin.png" alt="Follow Us On Linked In"></a> -->
                <a href="http://instagram.com/goldensashbridal" title="Follow Us On Instagram"  target="_blank"><img src="<?=$this->getThemePath()?>/images/instagram-logo.png" alt="Follow Us On Instagram"></a>
                <a href="https://www.pinterest.com/goldensash" title="Follow Us On Pinterest" target="_blank"><img src="<?=$this->getThemePath()?>/images/pinterestIcon.png" alt="Follow Us On Pinterest"></a>

                
            </div>
            <!-- Social Icons Section -->
        
        </div>
        <!-- Nav Wrap -->

        <!-- Welcome Wrap -->
        <div class="welcome_wrap">
        	
            <!-- Welcome Title -->
        	<div class="welcome_title">
        	  	<?php 
				    $a = new Area('Main');
				    $a->display($c);
				?>			
        	</div>
            <!-- Welcome Title -->
            
        </div>
        <!-- Welcome Wrap -->    

<?php $this->inc('elements/footer.php'); ?>

