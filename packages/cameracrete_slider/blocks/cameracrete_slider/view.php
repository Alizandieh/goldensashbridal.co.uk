<?php     defined('C5_EXECUTE') or die("Access Denied."); 
echo '<style >.ccslider_edit_disable{width:100%;min-height:20px;background:#999999;padding:10px;text-align:center;color:#fff}
.ccslider_edit_disable.error{color:#cf0000}
a:focus{outline:none!important;}
</style>';
global $c;
if ($c->isEditMode()) { 
	//disable in edit mode
	echo t('<div class="ccslider_edit_disable"><h4 >CameraCRETE Slider disabled in edit mode.</h4></div>');
}
else { ?>	

<!-- Begin Camera Slider -->
	<script>
		jQuery(function(){
			jQuery('#camerawrap-<?php  echo intval($bID) ?>').camera({
				alignment: '<?php  echo $align ?>',
				autoAdvance: <?php  echo $autoadvance ?>, mobileAutoAdvance: <?php  echo $autoadvance ?>,
				barDirection: '<?php  echo $barDir ?>', barPosition: '<?php  echo $barPosition ?>',
				easing: '<?php  echo $easing ?>', fx: '<?php  echo $ccFX ?>',
				hover: <?php  echo $hover ?>, loader: '<?php  echo $loader ?>',
				loaderColor: '<?php   if(!empty($loaderColor)){ echo $loaderColor;}else{echo "#ffffff";}?>', loaderBgColor: '<?php   if(!empty($loaderBgColor)){ echo $loaderBgColor;}else{echo "#007fff";}?>',
				minHeight : '600px',
				navigation: <?php  echo $navigation ?>,
				navigationHover: <?php  echo $navhov ?>, mobileNavHover: <?php  echo $navhov ?>,
				pagination: <?php  echo $pagination ?>,
				playPause: <?php  echo $playpause ?>, pauseOnClick: <?php  echo $playpauseOnClick ?>,
				piePosition: '<?php  echo $piePosition ?>',
				portrait: <?php  echo $portrait ?>,
				slideOn: '<?php  echo $slideOn ?>',
				thumbnails: <?php  echo $thumbs ?>,
				time: <?php  echo $time ?>, transPeriod: <?php  echo $transPeriod ?>
			});
		});
	</script>
	<div class="camera_wrap camera_<?php  echo $ccSkin ?>_skin" id="camerawrap-<?php  echo intval($bID) ?>">
		<?php  foreach($images as $imgInfo) {
		$f = File::getByID($imgInfo['fID']);
		$fp = new Permissions($f);
		$caption = array_key_exists('caption', $imgInfo) ? $imgInfo['caption'] : $f->getTitle();
		$fv = $f->getApprovedVersion(); 
		if ($fp->canRead()) {		
			if($crop=='true' && !empty($width) && !empty($height) ){
				$ih = Loader::helper('image');
				$img_path_o=$ih->getThumbnail($f, $width, $height, true);
				$imgpath=$img_path_o->src;
			}
			else{$imgpath=$f->getRelativePath(); }
			if($cdncache=='true'){
				if(!empty($cdnurl)){
					$cdnthumburl=$cdnurl.$imgpath;	
					$imglink=$cdnthumburl;
				}
				else{
					$imglink=$imgpath;
				}
			}
			else{$imglink=$imgpath;} ?>
		<div data-thumb="<?php  echo $imglink; ?>" data-src="<?php  echo $imglink; ?>">
			<?php  if($captionEnable) { ?>
			<div class="camera_caption fadeFromBottom">
				<?php  echo $fv->getTitle();?>
            </div>
			<?php  }?>
        </div>
		<?php     }
		} ?>
	</div>
<!-- End Camera Slider -->

<?php    } ?>		<!-- End block display if NOT in edit mode -->