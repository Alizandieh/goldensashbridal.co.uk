<?php    
defined('C5_EXECUTE') or die("Access Denied.");
class CameracreteSliderBlockController extends BlockController {
	
	protected $btTable = 'btCcSlider';
	protected $btInterfaceWidth = "650";
	protected $btInterfaceHeight = "400";


	protected $btExportFileColumns = array('fID');
	protected $btExportTables = array('btCcSlider','btCcSliderImg');

	public $defaultDuration = 5;	
	public $defaultFadeDuration = 2;	
	
	public $playback = "ORDER";	
	
	/** 
	 * Used for localization. If we want to localize the name/description we have to include this
	 */
	public function getBlockTypeDescription() {
		return t("Responsive image slider with touch support.");
	}
	
	public function getBlockTypeName() {
		return t("CameraCRETE Slider");
	}
	
	public function getJavaScriptStrings() {
		return array(
			'choose-file' => t('Choose Image/File'),
			'choose-min-2' => t('Please choose at least two images.'),
			'choose-fileset' => t('Please choose a file set.')
		);
	}
	
	function getFileSetName(){
		$sql = "SELECT fsName FROM FileSets WHERE fsID=".intval($this->fsID);
		$db = Loader::db();
		return $db->getOne($sql); 
	}

	function loadFileSet(){
		if (intval($this->fsID) < 1) {
			return false;
		}
        Loader::helper('concrete/file');
		Loader::model('file_attributes');
		Loader::library('file/types');
		Loader::model('file_list');
		Loader::model('file_set');
		
		$ak = FileAttributeKey::getByHandle('height');

		$fs = FileSet::getByID($this->fsID);
		$fileList = new FileList();		
		$fileList->filterBySet($fs);
		$fileList->filterByType(FileType::T_IMAGE);	
		$fileList->sortByFileSetDisplayOrder();
		
		$files = $fileList->get(1000,0);
		
		
		$image = array();
		$image['duration'] = $this->duration;
		$image['fadeDuration'] = $this->fadeDuration;
		$image['groupSet'] = 0;
		$image['caption'] = '';
		$images = array();
		$maxHeight = 0;
		foreach ($files as $f) {
			$fp = new Permissions($f);
			if(!$fp->canRead()) { continue; }
			$image['fID'] 			= $f->getFileID();
			$image['fileName'] 		= $f->getFileName();
			$image['fullFilePath'] 	= $f->getPath();
			//$image['url']			= $f->getRelativePath();
			
			// find the max height of all the images so Unoslider doesn't bounce around while rotating
			$vo = $f->getAttributeValueObject($ak);
			if (is_object($vo)) {
				$image['imgHeight'] = $vo->getValue('height');
			}
			if ($maxHeight == 0 || $image['imgHeight'] > $maxHeight) {
				$maxHeight = $image['imgHeight'];
			}
			$images[] = $image;
		}
		$this->images = $images;
	
	}

	function loadImages(){
		if(intval($this->bID)==0) $this->images=array();
		$sortChoices=array('ORDER'=>'position','RANDOM-SET'=>'groupSet asc, position asc','RANDOM'=>'rand()');
		if( !array_key_exists($this->playback,$sortChoices) ) 
			$this->playback='ORDER';
		if(intval($this->bID)==0) return array();
		$sql = "SELECT * FROM btCcSliderImg WHERE bID=".intval($this->bID).' ORDER BY '.$sortChoices[$this->playback];
		$db = Loader::db();
		$this->images=$db->getAll($sql); 
	}
	
	function delete(){
		$db = Loader::db();
		$db->query("DELETE FROM btCcSliderImg WHERE bID=".intval($this->bID));		
		parent::delete();
	}
	
	function loadBlockInformation() {
		if ($this->fsID == 0) {
			$this->loadImages();
		} else {
			$this->loadFileSet();
		}
		$this->randomizeImages();	
		$this->set('defaultFadeDuration', $this->defaultFadeDuration);
		$this->set('defaultDuration', $this->defaultDuration);
		$this->set('fadeDuration', $this->fadeDuration);
		$this->set('duration', $this->duration);
		$this->set('minHeight', $this->minHeight);
		$this->set('fsID', $this->fsID);
		$this->set('fsName', $this->getFileSetName());
		$this->set('images', $this->images);
		$this->set('playback', $this->playback);
		$type = ($this->fsID > 0) ? 'FILESET' : 'CUSTOM';
		$this->set('type', $type);
		$this->set('bID', $this->bID);				
	}
	
	function view() {
		$this->loadBlockInformation();
	
}

	function add() {
		$this->loadBlockInformation();
	}
	
	function edit() {
		$this->loadBlockInformation();
	}
	
	function duplicate($nbID) {
		parent::duplicate($nbID);
		$this->loadBlockInformation();
		$db = Loader::db();
		foreach($this->images as $im) {
			$db->Execute('insert into btCcSliderImg (bID, fID, caption, duration, fadeDuration, groupSet, position, imgHeight,url) values (?, ?, ?, ?, ?, ?, ?, ?,?)', 
				array($nbID, $im['fID'], $im['caption'], $im['duration'], $im['fadeDuration'], $im['groupSet'], $im['position'], $im['imgHeight'],$im['url'])
			);		
		}
	}
	
	function save($data) { 
		
		$args['position'] = isset($data['position']) ? trim($data['position']) : '';			
		
		//General Settings
		$args['autoadvance'] = isset($data['autoadvance']) ? trim($data['autoadvance']) : 'true';
		$args['playpause'] = isset($data['playpause']) ? trim($data['playpause']) : 'true';
		$args['playpauseOnClick'] = isset($data['playpauseOnClick']) ? trim($data['playpauseOnClick']) : 'true';
		$args['hover'] = isset($data['hover']) ? trim($data['hover']) : 'true';
		$args['thumbs'] = isset($data['thumbs']) ? trim($data['thumbs']) : 'true';
		$args['navigation'] = isset($data['navigation']) ? trim($data['navigation']) : 'true';
		$args['pagination'] = isset($data['pagination']) ? trim($data['pagination']) : 'true';
		$args['navhov'] = isset($data['navhov']) ? trim($data['navhov']) : 'true';
		$args['portrait'] = isset($data['portrait']) ? trim($data['portrait']) : 'false';
		$args['loader'] = isset($data['loader']) ? trim($data['loader']) : 'pie';
		$args['barPosition'] = isset($data['barPosition']) ? trim($data['barPosition']) : 'bottom';
		$args['barDir'] = isset($data['barDir']) ? trim($data['barDir']) : 'leftToRight';
		$args['piePosition'] = isset($data['piePosition']) ? trim($data['piePosition']) : 'rightTop';
		$args['slideOn'] = isset($data['slideOn']) ? trim($data['slideOn']) : 'random';
		$args['align'] = isset($data['align']) ? trim($data['align']) : 'center';
		$args['easing'] = isset($data['easing']) ? trim($data['easing']) : 'easeInOutExpo';
		$args['ccFX'] = isset($data['ccFX']) ? trim($data['ccFX']) : 'random';
		$args['captionEnable'] 	= $data['captionEnable'];
		$args['time'] = is_numeric($data['time']) ? intval($data['time']) : '4000';
		$args['transPeriod'] = is_numeric($data['transPeriod']) ? intval($data['transPeriod']) : '1500';
		
		//Design Options
		$args['loaderColor'] = isset($data['loaderColor']) ? trim($data['loaderColor']) : '#ffffff';
		$args['loaderBgColor'] = isset($data['loaderBgColor']) ? trim($data['loaderBgColor']) : '#007fff';
		$args['ccSkin'] = isset($data['ccSkin']) ? trim($data['ccSkin']) : 'azure';
		
		$db = Loader::db();
		
		if( $data['type'] == 'FILESET' && $data['fsID'] > 0){
			$args['fsID'] = $data['fsID'];

			$files = $db->getAll("SELECT fv.fID FROM FileSetFiles fsf, FileVersions fv WHERE fsf.fsID = " . $data['fsID'] .
			         " AND fsf.fID = fv.fID AND fvIsApproved = 1");
			
			//delete existing images
			$db->query("DELETE FROM btCcSliderImg WHERE bID=".intval($this->bID));
		} else if( $data['type'] == 'CUSTOM' && count($data['imgFIDs']) ){
			$args['fsID'] = 0;

			//delete existing images
			$db->query("DELETE FROM btCcSliderImg WHERE bID=".intval($this->bID));
			
			//loop through and add the images
			$pos=0;
			foreach($data['imgFIDs'] as $imgFID){ 
				if(intval($imgFID)==0 || $data['fileNames'][$pos]=='tempFilename') continue;
				$vals = array(intval($this->bID),intval($imgFID), trim($data['caption'][$pos]),trim($data['url'][$pos]),intval($data['duration'][$pos]),intval($data['fadeDuration'][$pos]),
						intval($data['groupSet'][$pos]),intval($data['imgHeight'][$pos]),$pos);
				$db->query("INSERT INTO btCcSliderImg (bID,fID,caption,url,duration,fadeDuration,groupSet,imgHeight,position) values (?,?,?,?,?,?,?,?,?)",$vals);
				$pos++;
			}
		}
		
		parent::save($args);
	}
	
	function randomizeImages()
	{
		if($this->playback == 'RANDOM')
		{
			shuffle($this->images);
		}
		else if($this->playback == 'RANDOM-SET')
		{
			$imageGroups=array();
			$imageGroupIds=array();
			$sortedImgs=array();
			foreach($this->images as $imgInfo){
				$imageGroups[$imgInfo['groupSet']][]=$imgInfo;
				if( !in_array($imgInfo['groupSet'],$imageGroupIds) )
					$imageGroupIds[]=$imgInfo['groupSet'];
			}
			shuffle($imageGroupIds);
			foreach($imageGroupIds as $imageGroupId){
				foreach($imageGroups[$imageGroupId] as $imgInfo)
					$sortedImgs[]=$imgInfo;
			}
			$this->images=$sortedImgs;
		}
	}
	

}

?>
