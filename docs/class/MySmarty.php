<?php
/**
*
* @package	
* @since PHP 5.0
* @version $Id: 
*/

class MySmarty extends Smarty{

	//--- Constructor 
//	function __construct(){
	function MySmarty(){
		$this->_exeInitSmarty();
	}

	function _exeInitSmarty() {
		$this->template_dir	= DIR_TPL;
		$this->compile_dir	= DIR_CASH;
	    $this->cache_dir    = DIR_CASH;
    	$this->config_dir   = DIR_INC;

		$this->security		 = FALSE;
	    $this->debugging     = false;
	    $this->force_compile = TRUE;
	    $this->caching       = false;

	    $this->left_delimiter  = '{';
	    $this->right_delimiter = '}';
	}
	function setSettingFile($len) {

	$this->config_load(INI_FILE,$len);
	}
	function getSettingWord($len) {
	return $this->get_config_vars("$len");
	}
	function exeDisplay($len){
	$this->display($len);
	}

	function assignNamedArray($dbObj){
		foreach($dbObj as $key => $value){		
		$this->assign($value->getNamedArray());	
		}
	}
}
?>