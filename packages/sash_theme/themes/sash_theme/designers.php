<?php   
defined('C5_EXECUTE') or die(_("Access Denied."));
$this->inc('elements/header.php'); 
$this->inc('elements/left_nav.php');
?>

        <!-- Page Wrap -->
        <div class="main_blog_wrap">

        	<div class="blogtitle">
                   	  	
            		<?php 
					    $a = new Area('Title');
					    $a->display($c);
					?>	
            
            </div>
            <div class="clear"></div>

            <div class="page_content_wrap">
                    <?php 
                        $a = new Area('Text');
                        $a->display($c);
                    ?>

            </div>
            <!-- Portfolio Navigation -->
            <div class="portpag">
                <div id="portfolio-filter">
                
                    <?php 
                        $a = new Area('Filter');
                        $a->display($c);
                    ?>
                
                </div>
            </div>
            <!-- Portfolio Navigation -->

            <div class="clear"></div>

            <div class="portfolio_item_wrap">

                        <?php 
                            $a = new Area('Designer_images');
                            $a->display($c);
                        ?>
         	
            </div>
            <!-- Page Item -->
        </div>
        <!-- Page Wrap -->


<?php $this->inc('elements/footer.php'); ?>

