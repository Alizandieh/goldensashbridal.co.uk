<?php     defined('C5_EXECUTE') or die("Access Denied."); ?> 
<div id="ccm-slideshowBlock-fsRow" class="ccm-slideshowBlock-fsRow" >
	<div class="backgroundRow" >
		<strong><?php    echo t('File Set:')?></strong> <span class="ccm-file-set-pick-cb"><?php    echo $form->select('fsID', $fsInfo['fileSets'], $fsInfo['fsID'])?></span><br/><br/>
		</div>
</div>
