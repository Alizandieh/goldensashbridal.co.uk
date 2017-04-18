<?php   
defined('C5_EXECUTE') or die(_("Access Denied."));

class CameracreteSliderPackage extends Package {

    protected $pkgHandle = 'cameracrete_slider';
    protected $appVersionRequired = '5.5.1';
    protected $pkgVersion = '1.0';

    public function getPackageDescription() {
        return t("Responsive image slider with touch support.");
    }
	
    public function getPackageName() {
        return t("CameraCRETE Slider");
    }
    
    public function install() {
        $pkg = parent::install(); 
		Loader::model('collection_types');
		BlockType::installBlockTypeFromPackage('cameracrete_slider', $pkg);	
    }
	
	public function uninstall() {
		BlockType::getByHandle('cameracrete_slider')->controller->uninstall();
		parent::uninstall();
	}
}
?>