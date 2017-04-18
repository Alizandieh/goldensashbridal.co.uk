<?php
defined('C5_EXECUTE') or die(_("Access Denied."));
/**
 * Handles the install of the JellyfishEditableForm package
 *
 * @package concrete5-package-jellyfish-editable-form
 * @author Ali Zandieh <ali.zandieh@jellyfish.co.uk>
 **/
class SashDesignersImagePackage extends Package {
    
    protected $pkgHandle = 'sash_designers_image';
	protected $appVersionRequired = '0.1.0';
	protected $pkgVersion = '0.1.1';
	
	/**
	 * C5 function
	 *
	 * @access public
	 * @return string
	 */
	public function getPackageDescription() {
		return t('Contains an image block that allows users to add images in designers pages.');
	}
	
	/**
	 * C5 function
	 *
	 * @access public
	 * @return string
	 */
	public function getPackageName() {
		return t('Sash Designers Image');
	}
	
	/**
	 * Installs the Editable_form block
	 *
	 * @access public
	 * @return void
	 **/
	public function install() {
	    $pkg = parent::install();
	    
	    BlockType::installBlockTypeFromPackage('designers_image', $pkg);
	}
    
} // END class JellyfishEditableFormPackage extends Package