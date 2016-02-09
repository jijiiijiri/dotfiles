<?php
/**
* FormObject
*
* Form基底オブジェクト
*
* @package 登録フォーム
* @author 長江
* @copyright 2008 espeid
*/

class FormObject{
/*
protected $value;	//そのもの値
protected $status;	//状態（デフォルトが１でエラーが無いと０になる）
protected $desc;	//値の名称
protected $errorMsg;//エラーメッセージ
*/
	//まず値を取得する
	//状態を１に設定する
	function __construct($value){
	$this->value = $value;
	$this->status = 1;
	}

//	unction checkValue();

	function getValue(){
	return $this->value;
	}

	function getValueString(){
	return $this->value;
	}

	function getStatus(){
	return $this->status;
	}

	function getErrorMsg(){
	return $this->errorMsg;
	}

	function getValueDesc(){
	return $this->desc;
	}

}

?>
