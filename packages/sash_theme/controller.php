<?php        

defined('C5_EXECUTE') or die(_("Access Denied."));

class SashthemePackage extends Package {

	protected $pkgHandle = 'sash_theme';
	protected $appVersionRequired = '5.3';
	protected $pkgVersion = '1.0.0';
	
	public function getPackageDescription() {
		return t("Installs Sash bridal theme");
	}
	
	public function getPackageName() {
		return t("Sash Bridal");
	}
	
	public function install() {
		$pkg = parent::install();
		
		// install block		
		PageTheme::add('sash_theme', $pkg);		
	}




}