<?php    
defined('C5_EXECUTE') or die("Access Denied.");
$al = Loader::helper('concrete/asset_library');
$ah = Loader::helper('concrete/interface');
$fm = loader::helper('form');
$fh = Loader::helper('form/color');
$basic_path=DIR_REL;
$basic_path=rtrim($basic_path,"/");
$burl=$basic_path.'/packages/cameracrete_slider/blocks/cameracrete_slider';
?>
<style>
#ccm-slideshowBlock-imgRows a{cursor:pointer}
#ccm-slideshowBlock-imgRows .ccm-slideshowBlock-imgRow,
#ccm-slideshowBlock-fsRow {margin-bottom:16px;clear:both;padding:7px;background-color:#eee}
#ccm-slideshowBlock-imgRows .ccm-slideshowBlock-imgRow a.moveUpLink{ display:block; background:url(<?php    echo $burl;?>/images/arrow_up.png) no-repeat center; height:10px; width:16px; }
#ccm-slideshowBlock-imgRows .ccm-slideshowBlock-imgRow a.moveDownLink{ display:block; background:url(<?php    echo $burl;?>/images/arrow_down.png) no-repeat center; height:10px; width:16px; }
#ccm-slideshowBlock-imgRows .ccm-slideshowBlock-imgRow a.moveUpLink:hover{background:url(<?php    echo $burl;?>/images/arrow_up_black.png) no-repeat center;}
#ccm-slideshowBlock-imgRows .ccm-slideshowBlock-imgRow a.moveDownLink:hover{background:url(<?php    echo $burl;?>/images/arrow_down_black.png) no-repeat center;}
#ccm-slideshowBlock-imgRows .cm-slideshowBlock-imgRowIcons{ float:right; width:35px; text-align:left; }
.ccm-ui .nav-tabs > li > a, .ccm-ui .nav-pills > li > a{margin-right:0px}
div.ccm-block-field-group{border:none}
.ccm-summary-selected-item p{font-weight:bold}
.ccm-ui .tooltip,.tooltip{opacity:1!important;display:inline-block}
</style>
<!-- Define Tabs -->
<ul class="ccm-dialog-tabs" id="ccm-wt-tabs">
	<li class="ccm-nav-active"><a href="#ccm-wt-general-tab"><?php   echo t('Slider Content')?></a></li>
	<li><a href="#ccm-wt-settings-tab"><?php  echo t('Settings')?></a></li>
	<li><a href="#ccm-wt-design-tab"><?php  echo t('Design')?></a></li>
</ul>

<!-- Begin Tab 1 -->
<div id="ccm-wt-general-tab">	
	<div class="clearfix" id="newImg">
		<p><?php   echo $form->label('wtFormat', t('Format:'));?>
			<select name="type" style="vertical-align: middle">
				<option value="CUSTOM"<?php  if ($type == 'CUSTOM') { ?> selected<?php     } ?>><?php    echo t('Custom Slideshow')?></option>
				<option value="FILESET"<?php  if ($type == 'FILESET') { ?> selected<?php     } ?>><?php    echo t('Pictures from File Set')?></option>
			</select>
		</p>
		<br /><span id="ccm-slideshowBlock-chooseImg">
		<?php  echo $ah->button_js(t('Add Image'), 'SlideshowBlock.chooseImg()', 'left');?></span>	

		<div style="clear:both"></div>
		<br/>
		<div id="ccm-slideshowBlock-imgRows">
		<?php  if ($fsID <= 0) {
			foreach($images as $imgInfo){ 
				$f = File::getByID($imgInfo['fID']);
				$fp = new Permissions($f);
				$imgInfo['thumbPath'] = $f->getThumbnailSRC(1);
				$imgInfo['fileName'] = $f->getTitle();
				$imgInfo['slideshowImgId'] = $imgInfo['fID'];
				if ($fp->canRead()) { 
					$this->inc('image_row_include.php', array('imgInfo' => $imgInfo));
				}		
			}
		} ?>
		</div>
		<?php  Loader::model('file_set');
		$s1 = FileSet::getMySets();
		$sets = array();
		foreach ($s1 as $s){
			$sets[$s->fsID] = $s->fsName;
		}
		$fsInfo['fileSets'] = $sets;
		if ($fsID > 0) {
			$fsInfo['fsID'] = $fsID;
			$fsInfo['duration']=$duration;
			$fsInfo['fadeDuration']=$fadeDuration;
		} else {
			$fsInfo['fsID']='0';
			$fsInfo['duration']=$defaultDuration;
			$fsInfo['fadeDuration']=$defaultFadeDuration;
		}
		$this->inc('fileset_row_include.php', array('fsInfo' => $fsInfo)); ?> 
		<div id="imgRowTemplateWrap" style="display:none">
		<?php  $imgInfo['slideshowImgId']='tempSlideshowImgId';
		$imgInfo['fID']='tempFID';
		$imgInfo['fileName']='tempFilename';
		$imgInfo['origfileName']='tempOrigFilename';
		$imgInfo['thumbPath']='tempThumbPath';
		$imgInfo['duration']=$defaultDuration;
		$imgInfo['fadeDuration']=$defaultFadeDuration;
		$imgInfo['groupSet']=0;
		$imgInfo['imgHeight']=tempHeight;
		$imgInfo['url']='';
		$imgInfo['class']='ccm-slideshowBlock-imgRow';
		?>
		<?php  $this->inc('image_row_include.php', array('imgInfo' => $imgInfo)); ?> 
		</div>
		<br/>
	</div>
</div>

<!-- Begin Settings Tab -->
<div id="ccm-wt-settings-tab">

	<div class="clearfix">
		<p><strong><?php   echo $form->label('time', t('Slide Duration: '));?></strong>
			<span class="cc_time"><?php  if (isset($time)){ echo ($time); } else { echo '4000'; } ?> <?php  echo t('milliseconds');?></span>
			<?php  echo $form->text('time', $time, array('class'=>'cc_time')); ?>
			<div class="cc_time" style="width: 85%; margin-left: 20px;"></div>
		</p>
		<p><strong><?php   echo $form->label('transPeriod', t('Transition Period: '));?></strong>
			<span class="cc_trans"><?php  if (isset($transPeriod)){ echo ($transPeriod); } else { echo '1500'; } ?> <?php  echo t('milliseconds');?></span>
			<?php  echo $form->text('transPeriod', $transPeriod, array('class'=>'cc_trans')); ?>
			<div class="cc_trans" style="width: 85%; margin-left: 20px;"></div>
		</p>
	</div>
	<hr />
	<div class="clearfix">
		<h4><?php  echo t('General Settings')?></h4>
		<p><label for="autoadvance"><?php  echo t('Auto-start Slideshow: ');?></label>
		<select name="autoadvance"  id="autoadvance">
			<option value="true" <?php  if($autoadvance=='true'){echo 'selected';}?>  ><?php  echo t('True')?></option>
			<option value="false" <?php  if($autoadvance=='false'){echo 'selected';}?>  ><?php  echo t('False')?></option>	
		</select>
		</p>
		
		<p><label for="slideOn"><?php  echo t('Apply transition effect to: ')?></label>
		<select name="slideOn"  id="slideOn">
			<option value="random" <?php  if($slideOn=='random'){echo 'selected';}?>  ><?php  echo t('Random Slide')?></option>
			<option value="prev" <?php  if($slideOn=='prev'){echo 'selected';}?>  ><?php  echo t('Current Slide')?></option>	
			<option value="next" <?php  if($slideOn=='next'){echo 'selected';}?>  ><?php  echo t('Next Slide')?></option>	
		</select>
		</p>
		
		<p><label for="easing"><?php  echo t('Easing Effect: ')?></label>
		<select name="easing"  id="easing">
			<option value="easeInOutExpo" <?php  if($easing=='easeInOutExpo'){echo 'selected';}?>  ><?php  echo t('Ease In-Out Expo')?></option>
			<option value="easeInExpo" <?php  if($easing=='easeInExpo'){echo 'selected';}?>  ><?php  echo t('Ease In Expo')?></option>
			<option value="easeOutExpo" <?php  if($easing=='easeOutExpo'){echo 'selected';}?>  ><?php  echo t('Ease Out Expo')?></option>
			<option value="linear" <?php  if($easing=='linear'){echo 'selected';}?>  ><?php  echo t('Linear')?></option>
			<option value="swing" <?php  if($easing=='swing'){echo 'selected';}?>  ><?php  echo t('Swing')?></option>	
			<option value="easeInQuad" <?php  if($easing=='easeInQuad'){echo 'selected';}?>  ><?php  echo t('Ease In Quad')?></option>	
			<option value="easeOutQuad" <?php  if($easing=='easeOutQuad'){echo 'selected';}?>  ><?php  echo t('Ease Out Quad')?></option>	
			<option value="easeInOutQuad" <?php  if($easing=='easeInOutQuad'){echo 'selected';}?>  ><?php  echo t('Ease In-Out Quad')?></option>
			<option value="easeInCubic" <?php  if($easing=='easeInCubic'){echo 'selected';}?>  ><?php  echo t('Ease In Cubic')?></option>	
			<option value="easeOutCubic" <?php  if($easing=='easeOutCubic'){echo 'selected';}?>  ><?php  echo t('Ease Out Cubic')?></option>	
			<option value="easeInOutCubic" <?php  if($easing=='easeInOutCubic'){echo 'selected';}?>  ><?php  echo t('Ease In-Out Cubic')?></option>
			<option value="easeInQuart" <?php  if($easing=='easeInQuart'){echo 'selected';}?>  ><?php  echo t('Ease In Quarter')?></option>
			<option value="easeOutQuart" <?php  if($easing=='easeOutQuart'){echo 'selected';}?>  ><?php  echo t('Ease Out Quarter')?></option>
			<option value="easeInOutQuart" <?php  if($easing=='easeInOutQuart'){echo 'selected';}?>  ><?php  echo t('Ease In-Out Quarter')?></option>
			<option value="easeInQuint" <?php  if($easing=='easeInQuint'){echo 'selected';}?>  ><?php  echo t('Ease In Quint')?></option>	
			<option value="easeOutQuint" <?php  if($easing=='easeOutQuint'){echo 'selected';}?>  ><?php  echo t('Ease Out Quint')?></option>	
			<option value="easeInOutQuint" <?php  if($easing=='easeInOutQuint'){echo 'selected';}?>  ><?php  echo t('Ease In-Out Quint')?></option>	
			<option value="easeInSine" <?php  if($easing=='easeInSine'){echo 'selected';}?>  ><?php  echo t('Ease In Sine')?></option>
			<option value="easeOutSine" <?php  if($easing=='easeOutSine'){echo 'selected';}?>  ><?php  echo t('Ease Out Sine')?></option>	
			<option value="easeInOutSine" <?php  if($easing=='easeInOutSine'){echo 'selected';}?>  ><?php  echo t('Ease In-Out Sine')?></option>	
			<option value="easeInBack" <?php  if($easing=='easeInBack'){echo 'selected';}?>  ><?php  echo t('Ease In Back')?></option>
			<option value="easeOutBack" <?php  if($easing=='easeOutBack'){echo 'selected';}?>  ><?php  echo t('Ease Out Back')?></option>
			<option value="easeInOutBack" <?php  if($easing=='easeInOutBack'){echo 'selected';}?>  ><?php  echo t('Ease In-Out Back')?></option>
			<option value="easeInCirc" <?php  if($easing=='easeInCirc'){echo 'selected';}?>  ><?php  echo t('Ease In Circle')?></option>
			<option value="easeOutCirc" <?php  if($easing=='easeOutCirc'){echo 'selected';}?>  ><?php  echo t('Ease Out Circle')?></option>	
			<option value="easeInOutCirc" <?php  if($easing=='easeInOutCirc'){echo 'selected';}?>  ><?php  echo t('Ease In-Out Circle')?></option>	
			<option value="easeInBounce" <?php  if($easing=='easeInBounce'){echo 'selected';}?>  ><?php  echo t('Ease In Bounce')?></option>	
			<option value="easeOutBounce" <?php  if($easing=='easeOutBounce'){echo 'selected';}?>  ><?php  echo t('Ease Out Bounce')?></option>
			<option value="easeInOutBounce" <?php  if($easing=='easeInOutBounce'){echo 'selected';}?>  ><?php  echo t('Ease In-Out Bounce')?></option>	
			<option value="easeInElastic" <?php  if($easing=='easeInElastic'){echo 'selected';}?>  ><?php  echo t('Ease In Elastic')?></option>	
			<option value="easeOutElastic" <?php  if($easing=='easeOutElastic'){echo 'selected';}?>  ><?php  echo t('Ease Out Elastic')?></option>	
			<option value="easeInOutElastic" <?php  if($easing=='easeInOutElastic'){echo 'selected';}?>  ><?php  echo t('Ease In-Out Elastic')?></option>			
		</select>
		</p>
		
		<p><label for="ccFX"><?php  echo t('Transition Effect: ')?></label>
		<select name="ccFX"  id="ccFX">
			<option value="random" <?php  if($ccFX=='random'){echo 'selected';}?>  ><?php  echo t('Random')?></option>
			<option value="simpleFade" <?php  if($ccFX=='simpleFade'){echo 'selected';}?>  ><?php  echo t('Fade')?></option>	
			<option value="stampede" <?php  if($ccFX=='stampede'){echo 'selected';}?>  ><?php  echo t('Stampede')?></option>
			<option value="curtainTopLeft" <?php  if($ccFX=='curtainTopLeft'){echo 'selected';}?>  ><?php  echo t('Curtain Top Left')?></option>
			<option value="curtainTopRight" <?php  if($ccFX=='curtainTopRight'){echo 'selected';}?>  ><?php  echo t('Curtain Top Right')?></option>
			<option value="curtainBottomLeft" <?php  if($ccFX=='curtainBottomLeft'){echo 'selected';}?>  ><?php  echo t('Curtain Bottom Left')?></option>
			<option value="curtainBottomRight" <?php  if($ccFX=='curtainBottomRight'){echo 'selected';}?>  ><?php  echo t('Curtain Bottom Right')?></option>
			<option value="curtainSliceLeft" <?php  if($ccFX=='curtainSliceLeft'){echo 'selected';}?>  ><?php  echo t('Curtain Slice Left')?></option>
			<option value="curtainSliceRight" <?php  if($ccFX=='curtainSliceRight'){echo 'selected';}?>  ><?php  echo t('Curtain Slice Right')?></option>
			<option value="blindCurtainTopLeft" <?php  if($ccFX=='blindCurtainTopLeft'){echo 'selected';}?>  ><?php  echo t('Blinds Curtain Top Left')?></option>
			<option value="blindCurtainTopRight" <?php  if($ccFX=='blindCurtainTopRight'){echo 'selected';}?>  ><?php  echo t('Blinds Curtain Top Right')?></option>
			<option value="blindCurtainBottomLeft" <?php  if($ccFX=='blindCurtainBottomLeft'){echo 'selected';}?>  ><?php  echo t('Blinds Curtain Bottom Left')?></option>
			<option value="blindCurtainBottomRight" <?php  if($ccFX=='blindCurtainBottomRight'){echo 'selected';}?>  ><?php  echo t('Blinds Curtain Bottom Right')?></option>
			<option value="blindCurtainSliceBottom" <?php  if($ccFX=='blindCurtainSliceBottom'){echo 'selected';}?>  ><?php  echo t('Blinds Curtain Slice Bottom')?></option>
			<option value="blindCurtainSliceTop" <?php  if($ccFX=='blindCurtainSliceTop'){echo 'selected';}?>  ><?php  echo t('Blinds Curtain Slice Top')?></option>
			<option value="mosaic" <?php  if($ccFX=='mosaic'){echo 'selected';}?>  ><?php  echo t('Mosaic')?></option>
			<option value="mosaicReverse" <?php  if($ccFX=='mosaicReverse'){echo 'selected';}?>  ><?php  echo t('Mosaic Reverse')?></option>
			<option value="mosaicRandom" <?php  if($ccFX=='mosaicRandom'){echo 'selected';}?>  ><?php  echo t('Mosaic Random')?></option>
			<option value="mosaicSpiral" <?php  if($ccFX=='mosaicSpiral'){echo 'selected';}?>  ><?php  echo t('Mosaic Spiral')?></option>
			<option value="mosaicSpiralReverse" <?php  if($ccFX=='mosaicSpiralReverse'){echo 'selected';}?>  ><?php  echo t('Mosaic Spiral Reverse')?></option>
			<option value="scrollLeft" <?php  if($ccFX=='scrollLeft'){echo 'selected';}?>  ><?php  echo t('Scroll Left')?></option>
			<option value="scrollRight" <?php  if($ccFX=='scrollRight'){echo 'selected';}?>  ><?php  echo t('Scroll Right')?></option>
			<option value="scrollHorz" <?php  if($ccFX=='scrollHorz'){echo 'selected';}?>  ><?php  echo t('Scroll Horizontal')?></option>
			<option value="scrollBottom" <?php  if($ccFX=='scrollBottom'){echo 'selected';}?>  ><?php  echo t('Scroll Bottom')?></option>
			<option value="scrollTop" <?php  if($ccFX=='scrollTop'){echo 'selected';}?>  ><?php  echo t('Scroll Top')?></option>
			<option value="topLeftBottomRight" <?php  if($ccFX=='topLeftBottomRight'){echo 'selected';}?>  ><?php  echo t('Top-Left-Bottom-Right')?></option>
			<option value="bottomRightTopLeft" <?php  if($ccFX=='bottomRightTopLeft'){echo 'selected';}?>  ><?php  echo t('Bottom-Right-Top-Left')?></option>
			<option value="bottomLeftTopRight" <?php  if($ccFX=='bottomLeftTopRight'){echo 'selected';}?>  ><?php  echo t('Bottom-Left-Top-Right')?></option>
		</select>
		</p>
	</div>
	<hr />	
	<div class="clearfix">
		<h4><?php  echo t('Control Preferences')?></h4>
		<p><label for="navigation"><?php  echo t('Enable navigation: ')?></label>
		<select name="navigation"  id="navigation">
			<option value="true" <?php  if($navigation=='true'){echo 'selected';}?>  ><?php  echo t('True')?></option>
			<option value="false" <?php  if($navigation=='false'){echo 'selected';}?>  ><?php  echo t('False')?></option>	
		</select>
		</p>
		
		<p><label for="navhov"><?php  echo t('Navigation buttons should be: ')?></label>
		<select name="navhov"  id="navhov">
			<option value="true" <?php  if($navhov=='true'){echo 'selected';}?>  ><?php  echo t('Visible Only On Hover')?></option>	
			<option value="false" <?php  if($navhov=='false'){echo 'selected';}?>  ><?php  echo t('Always Visible')?></option>
		</select>
		</p>
		
		<p><label for="playpausse"><?php  echo t('Play / Pause buttons should be: ')?></label>
		<select name="playpause"  id="playpause">
			<option value="true" <?php  if($playpause=='true'){echo 'selected';}?>  ><?php  echo t('Visible')?></option>
			<option value="false" <?php  if($playpause=='false'){echo 'selected';}?>  ><?php  echo t('Hidden')?></option>	
		</select>
		</p>
		
		<p><label for="playpauseOnClick"><?php  echo t('Pause slideshow on click: ')?></label>
		<select name="playpauseOnClick"  id="playpauseOnClick">
			<option value="true" <?php  if($playpauseOnClick=='true'){echo 'selected';}?>  ><?php  echo t('True')?></option>	
			<option value="false" <?php  if($playpauseOnClick=='false'){echo 'selected';}?>  ><?php  echo t('False')?></option>	
		</select>
		</p>
		
		<p><label for="hover"><?php  echo t('Pause slideshow on hover: ')?></label>
		<select name="hover"  id="hover">
			<option value="true" <?php  if($hover=='true'){echo 'selected';}?>  ><?php  echo t('True')?></option>
			<option value="false" <?php  if($hover=='false'){echo 'selected';}?>  ><?php  echo t('False')?></option>	
		</select>
		</p>
	</div>
	<hr />
	<div class="clearfix">
		<h4><?php  echo t('Display Options')?></h4>
		<p><label for="thumbs"><?php  echo t('Display thumbnail images: ')?></label>
		<select name="thumbs"  id="thumbs">
			<option value="true" <?php  if($thumbs=='true'){echo 'selected';}?>  ><?php  echo t('True')?></option>
			<option value="false" <?php  if($thumbs=='false'){echo 'selected';}?>  ><?php  echo t('False')?></option>	
		</select>
		</p>
		
		<p><label for="pagination"><?php  echo t('Pagination display: ')?></label>
		<select name="pagination"  id="pagination">
			<option value="true" <?php  if($pagination=='true'){echo 'selected';}?>  ><?php  echo t('Standard')?></option>
			<option value="false" <?php  if($pagination=='false'){echo 'selected';}?>  ><?php  echo t('Hidden / Thumbnails')?></option>	
		</select>
		</p>
	</div>
	<hr />
	<div class="clearfix">
		<h4><?php  echo t('Slide Preferences')?></h4>
		<p><label for="align"><?php  echo t('Align slideshow images to: ')?></label>
		<select name="align"  id="align">
			<option value="center" <?php  if($align=='center'){echo 'selected';}?>  ><?php  echo t('Center')?></option>
			<option value="topLeft" <?php  if($align=='topLeft'){echo 'selected';}?>  ><?php  echo t('Top Left')?></option>
			<option value="topCenter" <?php  if($align=='topCenter'){echo 'selected';}?>  ><?php  echo t('Top Center')?></option>
			<option value="topRight" <?php  if($align=='topRight'){echo 'selected';}?>  ><?php  echo t('Top Right')?></option>
			<option value="centerLeft" <?php  if($align=='centerLeft'){echo 'selected';}?>  ><?php  echo t('Center Left')?></option>	
			<option value="centerRight" <?php  if($align=='centerRight'){echo 'selected';}?>  ><?php  echo t('Center Right')?></option>	
			<option value="bottomLeft" <?php  if($align=='bottomLeft'){echo 'selected';}?>  ><?php  echo t('Bottom Left')?></option>	
			<option value="bottomCenter" <?php  if($align=='bottomCenter'){echo 'selected';}?>  ><?php  echo t('Bottom Center')?></option>
			<option value="bottomRight" <?php  if($align=='bottomRight'){echo 'selected';}?>  ><?php  echo t('Bottom Right')?></option>			
		</select>
		</p>
		
		<p><label for="portrait"><?php  echo t('Slideshow images are: ')?></label>
		<select name="portrait"  id="portrait">
			<option value="false" <?php  if($portrait=='false'){echo 'selected';}?>  ><?php  echo t('Cropped (best-fit)')?></option>
			<option value="true" <?php  if($portrait=='true'){echo 'selected';}?>  ><?php  echo t('Uncropped (original size)')?></option>	
		</select>
		</p>
		
		<p><span><?php  echo t('Image Captions')?></span>
		<?php   echo $form->checkbox('captionEnable', 1, $captionEnable); ?> <?php  echo t('Enabled?')?></p>
	</div>
	<hr />
	<div class="clearfix">
		<h4><?php  echo t('Loader Preferences')?></h4>
		<p><label for="loader"><?php  echo t('Loader style: ')?></label>
		<select name="loader"  id="loader">
			<option value="pie" <?php  if($loader=='pie'){echo 'selected';}?>  ><?php  echo t('Pie')?></option>
			<option value="bar" <?php  if($loader=='bar'){echo 'selected';}?>  ><?php  echo t('Bar')?></option>
			<option value="none" <?php  if($loader=='none'){echo 'selected';}?>  ><?php  echo t('None')?></option>			
		</select>
		</p>
		
		<p><label for="barPosition"><?php  echo t('Bar loader should be positioned on the: ')?></label>
		<select name="barPosition"  id="barPosition">
			<option value="bottom" <?php  if($barPosition=='bottom'){echo 'selected';}?>  ><?php  echo t('Bottom')?></option>
			<option value="left" <?php  if($barPosition=='left'){echo 'selected';}?>  ><?php  echo t('Left')?></option>
			<option value="right" <?php  if($barPosition=='right'){echo 'selected';}?>  ><?php  echo t('Right')?></option>
			<option value="top" <?php  if($barPosition=='top'){echo 'selected';}?>  ><?php  echo t('Top')?></option>			
		</select>
		</p>
		
		<p><label for="barDir"><?php  echo t('Animate loader bar from: ')?></label>
		<select name="barDir"  id="barDir">
			<option value="leftToRight" <?php  if($barDir=='leftToRight'){echo 'selected';}?>  ><?php  echo t('Left to Right')?></option>
			<option value="rightToLeft" <?php  if($barDir=='rightToLeft'){echo 'selected';}?>  ><?php  echo t('Right to Left')?></option>
			<option value="topToBottom" <?php  if($barDir=='topToBottom'){echo 'selected';}?>  ><?php  echo t('Top to Bottom')?></option>
			<option value="bottomToTop" <?php  if($barDir=='bottomToTop'){echo 'selected';}?>  ><?php  echo t('Bottom to Top')?></option>			
		</select>
		</p>
		
		<p><label for="piePosition"><?php  echo t('Pie loader should be positioned on the:')?></label>
		<select name="piePosition"  id="piePosition">
			<option value="rightTop" <?php  if($piePosition=='rightTop'){echo 'selected';}?>  ><?php  echo t('Top Right')?></option>
			<option value="lefttop" <?php  if($piePosition=='leftTop'){echo 'selected';}?>  ><?php  echo t('Top Left')?></option>
			<option value="rightBottom" <?php  if($piePosition=='rightBottom'){echo 'selected';}?>  ><?php  echo t('Bottom Right')?></option>
			<option value="leftBottom" <?php  if($piePosition=='leftBottom'){echo 'selected';}?>  ><?php  echo t('Bottom Left')?></option>			
		</select>
		</p>
	</div>
	<p>&nbsp;</p>
</div>

<!-- Begin Design Tab -->
<div id="ccm-wt-design-tab">
	<div class="clearfix">
		<h4><?php  echo t('Color Scheme')?></h4>
		<hr />
		<p><strong><?php  echo t('Interface Colors')?></strong></p>
		<div style="float: left; width: 50%;">
		<?php  echo $fh->output('loaderColor', 'Loader Color', ($loaderColor ? $loaderColor : '#ffffff'), true) ?>
		</div><div>
		<?php  echo $fh->output('loaderBgColor', 'Loader Background Color', ($loaderBgColor ? $loaderBgColor : '#007fff'), true) ?>
		</div>
	</div>
	<br/>
	<div class="clearfix">
		<h4><?php  echo t('Skin Style')?></h4>
		<p><?php  echo t('Set to false if you want to stop the slideshow after a manual change.')?></p>
		<select name="ccSkin"  id="ccSkin">
			<option value="azure" <?php  if($ccSkin=='azure'){echo 'selected';}?>  ><?php  echo t('Azure')?></option>
			<option value="amber" <?php  if($ccSkin=='amber'){echo 'selected';}?>  ><?php  echo t('Amber')?></option>	
			<option value="ash" <?php  if($ccSkin=='ash'){echo 'selected';}?>  ><?php  echo t('Ash')?></option>	
			<option value="beige" <?php  if($ccSkin=='beige'){echo 'selected';}?>  ><?php  echo t('Beige')?></option>	
			<option value="black" <?php  if($ccSkin=='black'){echo 'selected';}?>  ><?php  echo t('Black')?></option>	
			<option value="blue" <?php  if($ccSkin=='blue'){echo 'selected';}?>  ><?php  echo t('Blue')?></option>	
			<option value="brown" <?php  if($ccSkin=='brown'){echo 'selected';}?>  ><?php  echo t('Brown')?></option>
			<option value="burgundy" <?php  if($ccSkin=='burgundy'){echo 'selected';}?>  ><?php  echo t('Burgundy')?></option>
			<option value="charcoal" <?php  if($ccSkin=='charcoal'){echo 'selected';}?>  ><?php  echo t('Charcoal')?></option>
			<option value="chocolate" <?php  if($ccSkin=='chocolate'){echo 'selected';}?>  ><?php  echo t('Chocolate')?></option>		
			<option value="coffee" <?php  if($ccSkin=='coffee'){echo 'selected';}?>  ><?php  echo t('Coffee')?></option>
			<option value="cyan" <?php  if($ccSkin=='cyan'){echo 'selected';}?>  ><?php  echo t('Cyan')?></option>	
			<option value="fuchsia" <?php  if($ccSkin=='fuchsia'){echo 'selected';}?>  ><?php  echo t('Fuchsia')?></option>
			<option value="gold" <?php  if($ccSkin=='gold'){echo 'selected';}?>  ><?php  echo t('Gold')?></option>	
			<option value="green" <?php  if($ccSkin=='green'){echo 'selected';}?>  ><?php  echo t('Green')?></option>		
			<option value="grey" <?php  if($ccSkin=='grey'){echo 'selected';}?>  ><?php  echo t('Grey')?></option>
			<option value="indigo" <?php  if($ccSkin=='indigo'){echo 'selected';}?>  ><?php  echo t('Indigo')?></option>	
			<option value="khaki" <?php  if($ccSkin=='khaki'){echo 'selected';}?>  ><?php  echo t('Khaki')?></option>	
			<option value="lime" <?php  if($ccSkin=='lime'){echo 'selected';}?>  ><?php  echo t('Lime')?></option>	
			<option value="magenta" <?php  if($ccSkin=='magenta'){echo 'selected';}?>  ><?php  echo t('Magenta')?></option>	
			<option value="maroon" <?php  if($ccSkin=='maroon'){echo 'selected';}?>  ><?php  echo t('Maroon')?></option>	
			<option value="orange" <?php  if($ccSkin=='orange'){echo 'selected';}?>  ><?php  echo t('Orange')?></option>	
			<option value="olive" <?php  if($ccSkin=='olive'){echo 'selected';}?>  ><?php  echo t('Olive')?></option>	
			<option value="pink" <?php  if($ccSkin=='pink'){echo 'selected';}?>  ><?php  echo t('Pink')?></option>	
			<option value="pistachio" <?php  if($ccSkin=='pistachio'){echo 'selected';}?>  ><?php  echo t('Pistachio')?></option>		
			<option value="red" <?php  if($ccSkin=='red'){echo 'selected';}?>  ><?php  echo t('Red')?></option>	
			<option value="tangerine" <?php  if($ccSkin=='tangerine'){echo 'selected';}?>  ><?php  echo t('Tangerine')?></option>		
			<option value="violet" <?php  if($ccSkin=='violet'){echo 'selected';}?>  ><?php  echo t('Violet')?></option>	
			<option value="white" <?php  if($ccSkin=='white'){echo 'selected';}?>  ><?php  echo t('White')?></option>	
			<option value="yellow" <?php  if($ccSkin=='yellow'){echo 'selected';}?>  ><?php  echo t('Yellow')?></option>				
		</select>
	</div>
</div> 

<!-- Tab Setup -->
<script type="text/javascript">
$(document).ready(function(){
   $('#ccm-wt-tabs a').click(function(ev){
    var tab_to_show = $(this).attr('href');
    $('#ccm-wt-tabs li').
      removeClass('ccm-nav-active').
      find('a').
      each(function(ix, elem){
        var tab_to_hide = $(elem).attr('href');
        $(tab_to_hide).hide();
      });
    $(tab_to_show).show();
    $(this).parent('li').addClass('ccm-nav-active');
    return false;
  }).first().click();
});
</script>
<!-- Input Slider Activation -->
<script type="text/javascript">
$('input.cc_time').hide();
$('div.cc_time').
  slider(
    { min  : 0,
      step : 100,
      max  : 15000,
      value: parseInt($('span.cc_time').text(),10),
      slide: function(event, uiobj) {
               $('span.cc_time').text(uiobj.value+' milliseconds');
               $('input.cc_time').val(uiobj.value);
             }
    });
</script>
<script type="text/javascript">
$('input.cc_trans').hide();
$('div.cc_trans').
  slider(
    { min  : 0,
      step : 100,
      max  : 10000,
      value: parseInt($('span.cc_trans').text(),10),
      slide: function(event, uiobj) {
               $('span.cc_trans').text(uiobj.value+' milliseconds');
               $('input.cc_trans').val(uiobj.value);
             }
    });
</script>