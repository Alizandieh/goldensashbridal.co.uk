//// Isotope Section ////
jQuery(window).load(function($) {
	
	jQuery('.portfolio_item_wrap').isotope({
		animationOptions: {
		  duration: 750
		},
		animationEngine : 'best-available',
		itemSelector: '.item'
	});
	
});

jQuery(document).ready(function($) {

	// Home page read more bit 
	$(".showr").click(function () {
      $(".hiddentxt").toggle(2000);
    });
	
	var transition_effect = 1;
	if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i))) {
	   var transition_effect = 0;
	} 

	var dochigh = $(document).height();
	$('.overlay').css('height', dochigh + 'px');
	
	
	// background slider settings	
	$.supersized({	
	// Functionality
	slide_interval          :   4000,		// Length between transitions
	transition              :   transition_effect, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
	transition_speed		:	1000,		// Speed of transition
	slides 					:  	[			
	
	// Slideshow Images
	{image : '/packages/sash_theme/themes/sash_theme/slides/new_bg1.jpg'},
	{image : '/packages/sash_theme/themes/sash_theme/slides/new_bg2.jpg'},
	{image : '/packages/sash_theme/themes/sash_theme/slides/new_bg3.jpg'},
	{image : '/packages/sash_theme/themes/sash_theme/slides/new_bg4.jpg'},
	{image : '/packages/sash_theme/themes/sash_theme/slides/new_bg5.jpg'}				
	// Slideshow Images							
								]
	});
	
	$('.nav_wrap_start').delay(300).animate({top:'0px'},1500).queue(function(next) { /*$(this).attr('class','nav_wrap');*/ next(); });
	$('.welcome_wrap').delay(2100).fadeIn(500);
	$('.nav_wrapleft').delay(300).fadeIn(700);
	
	// fancybox settings
	$("a.fancyboxnumber").fancybox({
		'titlePosition'		: 'outside',
		'overlayColor'		: '#000',
		'overlayOpacity'	: 0.9
	});
	
	//portfolio filter
	jQuery('#portfolio-filter a').click(function(){
            var selector = $(this).attr('data-filter');
            $('.portfolio_item_wrap').isotope({ filter: selector });
            return false;
     });
	 
	 $('.portchanger a').click(function(){
		 var portchangevalue = $(this).attr('data-portval');
		 $('.item').addClass('count' + portchangevalue);
	 });
	
	// navigation //
	$("<select />").appendTo(".nav");
	$("<option />", {"selected": "selected","value"   : "","text" : "Menu"}).appendTo(".nav select");
	$(".nav ul li a").each(function() {
		
		var el = $(this);
		$("<option />", {"value"   : el.attr("href"),"text"    : el.text()}).appendTo(".nav select");
	});
	
	$(".nav select").change(function() {
		
		window.location = $(this).find("option:selected").val();
	});
	
	
	// Categories //
	$("<select />").appendTo(".navcat");
	$("<option />", {"selected": "selected","value"   : "","text" : "Blog Categories"}).appendTo(".navcat select");
	$(".navcat ul li a").each(function() {
		
		var el = $(this);
		$("<option />", {"value"   : el.attr("href"),"text"    : el.text()}).appendTo(".navcat select");
	});
	
	$(".navcat select").change(function() {
		
		window.location = $(this).find("option:selected").val();
	});
	
	
	// Paginations //
	$("<select />").appendTo(".pagination");
	$("<option />", {"selected": "selected","value"   : "","text" : "Page..."}).appendTo(".pagination select");
	$(".pagination ul li a").each(function() {
		
		var el = $(this);
		$("<option />", {"value"   : el.attr("href"),"text"    : el.text()}).appendTo(".pagination select");
	});
	
	$(".pagination select").change(function() {
		
		window.location = $(this).find("option:selected").val();
	});
	
	//// Start Scroll Top Function //// 
	$(window).bind('scroll', function(){
		if($(this).scrollTop() > 200) {
		$("#scrolltab").fadeIn('3000');
		}
		if($(this).scrollTop() < 199){
			$("#scrolltab").fadeOut('3000');
		}
	});
	
	$('#scrolltab').live('click', function(){
		$("html, body").animate({scrollTop:0}, 'slow');
	});
	//// End Scroll Top Function ////
	
/*
 * AJAX Section
 * This function will handle the contact process through AJAX
 */
 $('#slickform').submit(
	function slickcontactparse() {
		
		// EMAIL VALIDATION FUNCTION
		var emailReg = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);

		// PHONE VALIDATION FUNCTION
		var phoneReg = new RegExp(/^\s*\d+\s*$/);
		

		// EDIT THIS SECTION IF DIFFERENT FORM ELEMENTS
		// Values
		var successmessage = "Thank you for email, we will be in contact soon!";
		var failedmessage = "There was a problem, please try again!";
		var usersemail = $('#email');
		var usersname = $('#name');
		var usersphone = $('#phone');
		var wedding_date = $('#date');
		var userscomment = $('#comment');
		var isvalid = 1;
		var url = "/packages/sash_theme/themes/sash_theme/contact_result.php";
		
		//Checking information is correct before sending data
		
		//CHECKING NAME IS PRESENT
		if (usersname.val() == "" || usersname.val() == "name...") {
			$("#name").attr('class', 'inputsectionerror');
			$('input[type=submit]', $("#slickform")).removeAttr('disabled');
			return false;
		} else $("#name").attr('class', 'inputsection');

		//CHECKING EMAIL IS PRESENT AND IS VALID
		if (usersemail.val() == "" || usersemail.val() == "email...") {
			$("#email").attr('class', 'inputsection_righterror');
			$('input[type=submit]', $("#slickform")).removeAttr('disabled');
			return false;
		} else $("#email").attr('class', 'inputsection_right');
		
		//CHECKING PHONE IS PRESENT AND IS VALID
		if (usersphone.val() == "" || usersphone.val() == "phone..." || !phoneReg.test(usersphone.val())) {
			$("#phone").attr('class', 'inputsectionerror');
			$('input[type=submit]', $("#slickform")).removeAttr('disabled');
			return false;
		} else $("#phone").attr('class', 'inputsection');

		//CHECKING WEDDING DATE IS PRESENT
		if (wedding_date.val() == "" || wedding_date.val() == "wedding date..." ) {
			$("#date").attr('class', 'inputsection_righterror');
			$('input[type=submit]', $("#slickform")).removeAttr('disabled');
			return false;
		} else $("#date").attr('class', 'inputsection_right');

		//CHECKING COMMENT IS PRESENT
		if (userscomment.val() == "" || userscomment.val() == "Comment...") {
			$("#comment").attr('class', 'inputlargesectionerror');
			$('input[type=submit]', $("#slickform")).removeAttr('disabled');
			return false;
		}

		var valid = emailReg.test(usersemail.val());
		
		if(!valid) {
			$("#email").attr('class', 'inputsection_righterror');
			$('input[type=submit]', $("#slickform")).removeAttr('disabled');
			return false;
		}
		//CHECKING EMAIL IS PRESENT AND IS VALID
		
		/* 
		 *
		 * POSTING DATA USING AJAX AND
		 * THEN RETREIVING DATA FROM PHP SCRIPT
		 *
		*/
	
		$.post(url,{ usersname: usersname.val(), usersemail: usersemail.val(), usersphone: usersphone.val(), wedding_date: wedding_date.val(), userscomment: userscomment.val(), isvalid: isvalid } , function(data) {

			if(data == 'success'){
				$("#email").attr('class', 'inputsection_right');
				$("#comment").attr('class', 'inputlargesection');
				$("#name").attr('class', 'inputsection');
				$(".emailsuccess").html(successmessage);
				$("#slickform").slideUp(500);
				$('.emailsuccess').delay(500).fadeIn(500);
				$('input[type=submit]', $("#slickform")).removeAttr('disabled');
			
			} else {
				$("#email").attr('class', 'inputsection_right');
				$("#comment").attr('class', 'inputlargesection');
				$("#name").attr('class', 'inputsection');
				$("#phone").attr('class', 'inputsection');
				$(".emailfail").html(failedmessage);
				$('.emailfail').delay(500).fadeIn(500);
				$('input[type=submit]', $("#slickform")).removeAttr('disabled');
				return false;
				
			}
			
		});
		
		/* 
		 *
		 * POSTING DATA USING AJAX AND
		 * THEN RETREIVING DATA FROM PHP SCRIPT
		 *
		*/
		
	}
	
);
/*
 * AJAX Section
 * This function will handle the contact process through AJAX
 */
 
 	/* Google Maps */
	loadGoogleMaps();
	
	/** Tabs Section **/
	$('#tabs > ul').tabs({ fx: { height: 'toggle', opacity: 'toggle' } });
	
	/** Accordion Section **/
	$('dd').filter(':nth-child(n+4)').slideUp(200);
	$('dt').on('mouseenter', function(){
		$(this).next().slideDown(200).siblings('dd').slideUp(200);
	});


});

// Google maps api settings //
$(window).load(function() {
	
/* Google Maps */
	loadGoogleMaps();
	
});

function initGoogleMaps() {
	/* Google Maps Init */
	var myLatlng = new google.maps.LatLng(51.470661, -0.191517);
	var myOptions = {
		zoom: 16,
		center: myLatlng,
		popup: true,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	var map = new google.maps.Map(document.getElementById("googlemap"), myOptions);
	
	var marker = new google.maps.Marker({
		position: myLatlng, 
		map: map,
		title:"Our Company Location"
	});
	google.maps.event.addListener(marker, 'click', function() {
		map.setZoom(17);
	});
}
  
function loadGoogleMaps() {
	/* Google Maps Load */
	if($('#googlemap').length != 0){
		var script = document.createElement("script");
		script.type = "text/javascript";
		script.src = "http://maps.google.com/maps/api/js?sensor=false&callback=initGoogleMaps";
		document.body.appendChild(script);
	}
}
