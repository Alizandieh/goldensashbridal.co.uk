<?php     defined('C5_EXECUTE') or die("Access Denied."); ?> 
	
<div id="ccm-slideshowBlock-imgRow<?php    echo $imgInfo['slideshowImgId']?>" class="ccm-slideshowBlock-imgRow" >

	<div class="backgroundRow" style="background: url(<?php    echo $imgInfo['thumbPath']?>) no-repeat left top; padding-left: 100px">
		<div class="cm-slideshowBlock-imgRowIcons" >
			<div style="float:right">
				<a onclick="SlideshowBlock.moveUp('<?php    echo $imgInfo['slideshowImgId']?>')" class="moveUpLink"></a>
				<a onclick="SlideshowBlock.moveDown('<?php    echo $imgInfo['slideshowImgId']?>')" class="moveDownLink"></a>									  
			</div>
			<div style="margin-top:4px"><a onclick="SlideshowBlock.removeImage('<?php    echo $imgInfo['slideshowImgId']?>')"><img src="<?php    echo ASSETS_URL_IMAGES?>/icons/delete_small.png" /></a></div>
		</div>
		<strong><?php  echo t('Caption: ')?></strong><em><?php    echo $imgInfo['fileName']?></em><br/>
		
		<div style="margin-top:4px">
			<input type="hidden" name="imgFIDs[]" value="<?php    echo $imgInfo['fID']?>">
			<input type="hidden" name="imgHeight[]" value="<?php    echo $imgInfo['imgHeight']?>">
		</div>
	
		
	</div>
	

</div>	
