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
            <!-- Page Item -->
            <div class="page_item">

                <!-- Page Content -->
                <div class="page_content_wrap">
                
                        <?php 
						    $a = new Area('Main');
						    $a->display($c);
						?>

                        <div class="hrtag"></div>

                        <?php 
                            $a = new Area('Main2');
                            $a->display($c);
                        ?>

                </div>
                <!-- Page Content -->
                <div class="clear"></div>
            	
            </div>
            <!-- Page Item -->
        </div>
        <!-- Page Wrap -->


<?php $this->inc('elements/footer.php'); ?>

