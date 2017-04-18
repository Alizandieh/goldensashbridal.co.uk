<?php   
defined('C5_EXECUTE') or die(_("Access Denied."));
$this->inc('elements/header.php'); ?>
	
	<!-- content-wrap starts -->
	<div id="content-wrap">
				
		<div id="main">

			
			<p><?php  
print $innerContent;
?> 			
			</p>			
			
		<!-- main ends -->	
		</div>
		
		<!-- sidebar starts -->
		<div id="sidebar">			

<?php  
    $a = new Area('Sidebar');
    $a->display($c);
?>
		<!-- sidebar ends -->		
		</div>
		
	<!-- content-wrap ends-->	
	</div>
    <?php       $this->inc('elements/footer.php'); ?>

