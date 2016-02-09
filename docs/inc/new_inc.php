<?php
include(DIR_PHP.'100hito.php');
$arg['PHP_SELF']= $_SERVER['PHP_SELF'];			
$base_file		= basename($arg['PHP_SELF'],".php");
$skin_def_file	= $base_file.".tpl";			
$skin_chk_file	= $base_file."_CHK.tpl";		
$skin_end_file	= $base_file."_END.tpl";		
$skin_file		= $skin_def_file;				
session_start();
$Sm = new Smarty();
$Sm->template_dir	= DIR_ROOT."tpl/"; 
$Sm->compile_dir	= DIR_CASH;		
global $arg;	
fnc_sql_rst2array("M_publicity");
?>
