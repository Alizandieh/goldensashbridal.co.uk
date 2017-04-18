var SlideshowBlock = {
	
	init:function(){},	
	
	chooseImg:function(){ 
		ccm_launchFileManager('&fType=' + ccmi18n_filemanager.FTYPE_IMAGE);
	},
	
	showImages:function(){
		$("#ccm-slideshowBlock-imgRows").show();
		$("#ccm-slideshowBlock-chooseImg").show();
		$("#ccm-slideshowBlock-fsRow").hide();
	},

	showFileSet:function(){
		$("#ccm-slideshowBlock-imgRows").hide();
		$("#ccm-slideshowBlock-chooseImg").hide();
		$("#ccm-slideshowBlock-fsRow").show();
	},

	selectObj:function(obj){
		if (obj.fsID != undefined) {
			$("#ccm-slideshowBlock-fsRow input[name=fsID]").attr("value", obj.fsID);
			$("#ccm-slideshowBlock-fsRow input[name=fsName]").attr("value", obj.fsName);
			$("#ccm-slideshowBlock-fsRow .ccm-slideshowBlock-fsName").text(obj.fsName);
		} else {
			this.addNewImage(obj.fID, obj.thumbnailLevel1, obj.height, obj.title);
		}
	},

	addImages:0, 
	addNewImage: function(fID, thumbPath, imgHeight, title) { 
		this.addImages--; //negative counter - so it doesn't compete with real slideshowImgIds
		var slideshowImgId=this.addImages;
		var templateHTML=$('#imgRowTemplateWrap .ccm-slideshowBlock-imgRow').html().replace(/tempFID/g,fID);
		templateHTML=templateHTML.replace(/tempThumbPath/g,thumbPath);
		templateHTML=templateHTML.replace(/tempFilename/g,title);
		templateHTML=templateHTML.replace(/tempSlideshowImgId/g,slideshowImgId).replace(/tempHeight/g,imgHeight);
		var imgRow = document.createElement("div");
		imgRow.innerHTML=templateHTML;
		imgRow.id='ccm-slideshowBlock-imgRow'+parseInt(slideshowImgId);	
		imgRow.className='ccm-slideshowBlock-imgRow';
		document.getElementById('ccm-slideshowBlock-imgRows').appendChild(imgRow);
		var bgRow=$('#ccm-slideshowBlock-imgRow'+parseInt(fID)+' .backgroundRow');
		bgRow.css('background','url('+escape(thumbPath)+') no-repeat left top');
	},
	
	removeImage: function(fID){
		$('#ccm-slideshowBlock-imgRow'+fID).remove();
	},
	
	moveUp:function(fID){
		var thisImg=$('#ccm-slideshowBlock-imgRow'+fID);
		var qIDs=this.serialize();
		var previousQID=0;
		for(var i=0;i<qIDs.length;i++){
			if(qIDs[i]==fID){
				if(previousQID==0) break; 
				thisImg.after($('#ccm-slideshowBlock-imgRow'+previousQID));
				break;
			}
			previousQID=qIDs[i];
		}	 
	},
	moveDown:function(fID){
		var thisImg=$('#ccm-slideshowBlock-imgRow'+fID);
		var qIDs=this.serialize();
		var thisQIDfound=0;
		for(var i=0;i<qIDs.length;i++){
			if(qIDs[i]==fID){
				thisQIDfound=1;
				continue;
			}
			if(thisQIDfound){
				$('#ccm-slideshowBlock-imgRow'+qIDs[i]).after(thisImg);
				break;
			}
		} 
	},
	serialize:function(){
		var t = document.getElementById("ccm-slideshowBlock-imgRows");
		var qIDs=[];
		for(var i=0;i<t.childNodes.length;i++){ 
			if( t.childNodes[i].className && t.childNodes[i].className.indexOf('ccm-slideshowBlock-imgRow')>=0 ){ 
				var qID=t.childNodes[i].id.replace('ccm-slideshowBlock-imgRow','');
				qIDs.push(qID);
			}
		}
		return qIDs;
	},	

	validate:function(){
		var failed=0; 
		
		if ($("#newImg select[name=type]").val() == 'FILESET')
		{
			if ($("#ccm-slideshowBlock-fsRow input[name=fsID]").val() <= 0) {
				alert(ccm_t('choose-fileset'));
				$('#ccm-slideshowBlock-AddImg').focus();
				failed=1;
			}	
		} else {
			qIDs=this.serialize();
			if( qIDs.length<2 ){
				alert(ccm_t('choose-min-2'));
				$('#ccm-slideshowBlock-AddImg').focus();
				failed=1;
			}	
		}
		
		if(failed){
			ccm_isBlockError=1;
			return false;
		}
		return true;
	} 
	
}

ccmValidateBlockForm = function() { return SlideshowBlock.validate(); }
ccm_chooseAsset = function(obj) { SlideshowBlock.selectObj(obj); }

$(function() {
	if ($("#newImg select[name=type]").val() == 'FILESET') {
		$("#newImg select[name=type]").val('FILESET');
		SlideshowBlock.showFileSet();
	} else {
		$("#newImg select[name=type]").val('CUSTOM');
		SlideshowBlock.showImages();
	}
	

	$("#newImg select[name=type]").change(function(){
		if (this.value == 'FILESET') {
			SlideshowBlock.showFileSet();
		} else {
			SlideshowBlock.showImages();
		}
	});
	
	if ($("#indicator_area select[name=indicator]").val() == 'true') {
	$("#indicator_box").show();
	}else{$("#indicator_box").hide();}
	$("#indicator_area select[name=indicator]").change(function(){
		if ($("#indicator_area select[name=indicator]").val() == 'true') {
			$("#indicator_box").show();	}
		else{
			$("#indicator_box").hide();
			}
	});
	
	if ($("#navigation_area select[name=navigation]").val() == 'true') {
	$("#navigation_box").show();
	}else{$("#navigation_box").hide();}
	$("#navigation_area select[name=navigation]").change(function(){
		if ($("#navigation_area select[name=navigation]").val() == 'true') {
			$("#navigation_box").show();	}
		else{
			$("#navigation_box").hide();
			}
	});
	
	if ($("#slideshow_area select[name=slideshow]").val() == 'true') {
	$("#slideshow_box").show();
	}else{$("#slideshow_box").hide();}
	$("#slideshow_area select[name=slideshow]").change(function(){
		if ($("#slideshow_area select[name=slideshow]").val() == 'true') {
			$("#slideshow_box").show();	}
		else{
			$("#slideshow_box").hide();
			}
	});
	
	if ($("#block_area select[name=block]").val() == 'true') {
	$("#block_box").show();
	}else{$("#block_box").hide();}
	$("#block_area select[name=block]").change(function(){
		if ($("#block_area select[name=block]").val() == 'true') {
			$("#block_box").show();	}
		else{
			$("#block_box").hide();
			}
	});
	
	if ($("#animation_area select[name=animation]").val() == 'true') {
	$("#animation_box").show();
	}else{$("#animation_box").hide();}
	$("#animation_area select[name=animation]").change(function(){
		if ($("#animation_area select[name=animation]").val() == 'true') {
			$("#animation_box").show();	}
		else{
			$("#animation_box").hide();
			}
	});
	
	if ($("#preset_options select[name=preset]").val() == 'false') {
	$(".no_custom_animation").show();
	
	
	}else{$(".no_custom_animation").hide();
	
	}
	$("#preset_options select[name=preset]").change(function(){
		if ($("#preset_options select[name=preset]").val() == 'false') {
			$(".no_custom_animation").show();
			
				}
		else{
			$(".no_custom_animation").hide();
			
			}
	});
	
	if ($("#preset_options select[name=preset]").val() == 'all') {
	
	$(".order_presets").show();
	
	}else{
	$(".order_presets").hide();
	}
	$("#preset_options select[name=preset]").change(function(){
		if ($("#preset_options select[name=preset]").val() == 'all') {
			
			$(".order_presets").show();
				}
		else{
			
			$(".order_presets").hide();
			}
	});
	
});

