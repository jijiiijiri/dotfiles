<?php
/**
* FormSelect
*
* セレクトメニューの時のオブジェクト
*
* @package 登録フォーム
* @author 長江
* @copyright 2008 espeid
*/
require_once('FormObject.class.php');

class FormSelect extends FormObject
{
/*
protected $value;
protected $array;
protected $required;
*/
	function __construct($value,$array,$required=0,$desc){
	$this->value = $value;		//その値(この場合数字）
	$this->array = $array;		//セレクトメニューの配列がはいる
	$this->required = $required;//必須項目かどうか
	$this->desc = $desc;		//表示名
	$this->status = 1;			//エラー状態
	}

	/*
	* 値をチェックする関数
	* 相変わらず　同じ名前
	* 
	* @access public
	* @param  no
	* @return no
	*/ 
	function checkValue(){
		if($this->required != 0){    // 必須入力
		$this->checkSelected();
			if($this->status != 1){
			$this->checkSelectedValue();
			}
		}else{   					 // 任意入力
			if($this->value != "" && $this->value != "0"){
			$this->checkSelectedValue();
			}else{
			$this->status = 0;
			}
		}
	}
	/*
	* 値を取得する関数
	* 文字列なので　通常とは違って　getValueString()である。
	* 通常は　getValue()
	*
	* @access public
	* @param  no
	* @return no
	*/ 
	function getValueString(){
		if(array_key_exists($this->value,$this->array)){	//配列ならば
		return $this->array[$this->value];				//値をいれて　文字列を返す
		}else{
		return '';
		}
	}

	/*
	* selectで選択した値で　その項目名を取得する
	* 文字列なので　通常とは違って　getValueString()である。
	* 通常は　getValue()
	*
	* @access public
	* @param  no
	* @return no
	*/ 
	function getValueName(){
	return $this->array[$this->value];				//値をいれて　文字列を返す
	}

	function checkSelected(){
    if($this->value == "" || $this->value == "0"){
      $this->errorMsg = "「{$this->desc}」を選択してください。";
      $this->status = 1;
    }
    else{
      $this->status = 0;
    }
  }

  function checkSelectedValue(){
    $hitFlag = 0;
//    foreach($this->valueSet as $key => $item){
      if($this->value > 0){
        $hitFlag = 1;
        $this->status = 0;
//      break;
//     }
    }

    if($hitFlag != 1){
      $this->errorMsg = "「{$this->desc}」を選択してください。";
      $this->status = 1;
    }
  }
}

// *****************************************＃
?>
