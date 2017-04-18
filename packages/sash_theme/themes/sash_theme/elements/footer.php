<?php  defined('C5_EXECUTE') or die(_("Access Denied.")); ?>

<?php
	$page = Page::getCurrentPage();
	$page_name = $page->getCollectionName();
?>
    </div>
    <!-- Website Wrap -->
<div id="footer_right">
		<?php 
			if ($page_name == 'HOME') { ?>
			  <a href="#showr" name="showr" class="showr" id="read-more">&copy; Golden Sash Bridal</a>
			  <div class="hiddentxt">
			  	<a href="#showr" name="showr" class="showr" style="float:right; text-decoration:underline; font-size:12px;">X Close</a>
			  	<br/>
				<h1 style="font-size:20px; color:gray;">Designer Wedding Dresses in London</h1>
				<p>
					Golden Sash Bridal was formed in 2012 to offer all Brides to be an exclusive experience 
					and provide them with their wedding essentials from A-Z, such as the exclusive wedding dresses, 
					matching shoes, bridesmaids dresses, flower girl dress, hair accessories…etc.<br/><br/>

					Golden Sash Bridal has a reputation for stocking and providing some of the finest wedding dresses in London. 
					The boutique carries a unique collection of wedding dresses and bridal gowns from acclaimed designers, 
					thoughtfully selected for you by our passionate team of bridal consultants who will assist you in 
					choosing your perfect gown.<br/><br/>

					The designers we carry at Golden Sash Bridal in London are dedicated to creating the 
					finest designs with a careful attention to detail, quality, fit and finish. All wedding dresses 
					and gowns at Golden Sash Bridal are cut to enhance a woman's body shape and designed for ease of 
					wear for the bride on one of the most important days of her life.<br/><br/>

					Golden Sash Bridal not only provide stunning wedding dresses in London, but also offer brides 
					an exclusive in house bridal alteration service, our seamstresses have the experience to work on 
					any kind of fabric, and all dresses and gowns are finished to a high standard.<br/><br/>

					At Golden Sash Bridal we offer a variety of services by our business partners, such as Wedding Photography, 
					Dance teaching for your first dance, Personal training, the perfect cake, and not to forget your flower bouquet, 
					ask the bridal consultant for more details.<br/><br/>

					Golden Sash Bridal in Fulham, London, operate on an appointment only basis, Appointments can be taken by phone only, 
					please call 020 7736 2233 to book.<br/><br/>

				</p>
			  </div>
		<? } else { ?>
			<span id="footer_copy">&copy; Golden Sash Bridal</span>
		<? } // end else ?>
</div>




<div id="developer">
    Website Development by <a href="http://www.ali-zandieh.com" target="_blank">Ali Zandieh</a>
</div>

</div>
<!-- Background Image Overlay -->

<!-- Start Scroll To Top Div -->
<div id="scrolltab"></div>
<!-- End Scroll To Top Div -->


<?php  Loader::element('footer_required'); ?>
</body>
</html>

