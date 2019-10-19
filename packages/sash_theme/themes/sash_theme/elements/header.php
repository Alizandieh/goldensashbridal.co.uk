<?php         defined('C5_EXECUTE') or die(_("Access Denied.")); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
<head>


<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" /> 
<!-- Css Files -->
<link rel="stylesheet" media="screen" type="text/css" href="<?php echo $this->getStyleSheet('css/style.css')?>" />
<link href='https://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<link rel="stylesheet" media="screen" type="text/css" href="<?php echo $this->getStyleSheet('fancybox/jquery.fancybox-1.3.4.css')?>" />
<!-- Css Files -->

<?php Loader::element('header_required'); ?>

<!-- Javascript Files -->

<script type="text/javascript" src="<?=$this->getThemePath()?>/js/supersized.3.2.7.min.js"></script>
<?php if (!$c->isEditMode()) { ?>
    <script type="text/javascript" src="<?=$this->getThemePath()?>/js/isotope.js"></script>
<?php } ?>
<script type="text/javascript" src="<?=$this->getThemePath()?>/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" src="<?=$this->getThemePath()?>/fancybox/jquery.easing-1.3.pack.js"></script>
<script type="text/javascript" src="<?=$this->getThemePath()?>/js/jquery-ui-personalized-1.5.2.packed.js"></script>
<script src="<?=$this->getThemePath()?>/js/custom.js"></script>
<!-- Javascript Files -->




<!-- Google Analytics -->
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36425877-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>

</head>
<body>

<!-- Background Image Overlay -->
<div class="overlay">

    <!-- Website Wrap -->
    <div class="wrap">



 

