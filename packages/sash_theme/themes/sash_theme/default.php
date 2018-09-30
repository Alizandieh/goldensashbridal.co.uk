<?php   
defined('C5_EXECUTE') or die(_("Access Denied."));

$this->inc('elements/header.php'); 

$this->inc('elements/left_nav.php'); 

?>

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

