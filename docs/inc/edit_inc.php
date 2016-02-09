<?php
/**
 * @author Satoshi Nagae
 * @version 1.0.0
 * 全共通読込ファイル
 * @copyright espeid
 */


include(DIR_PHP.'100hito.php');//関数を読み込む(ちょと便利な関数)

//初期設定　別ファイル予定　ここから /*--
$arg['PHP_SELF']= $_SERVER['PHP_SELF'];			//PHPファイル名が入る
$base_file		= basename($arg['PHP_SELF'],".php");	//拡張子を除く
$skin_def_file	= $base_file.".tpl";			//初期画面(フォーム画面)
$skin_chk_file	= $base_file."_CHK.tpl";		//確認画面
$skin_end_file	= $base_file."_END.tpl";		//確認画面
$skin_file		= $skin_def_file;				//エラーの時は　通常のフォームスキンファイルを設定
session_start();		//sessionスタート

$Sm = new Smarty();
$Sm->template_dir	= DIR_ROOT."tpl/"; 	// テンプレが存在するディレクトリ
$Sm->compile_dir	= DIR_CASH;			// テンプレのcashを保存するディレクトリ
global $arg;			//グローバル関数の宣言
fnc_sql_rst2array("M_publicity");	//ラジオボタン

?>
