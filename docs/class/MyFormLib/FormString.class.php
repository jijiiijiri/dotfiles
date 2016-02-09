<?php
/**
* FormString
*
* 文字列のオブジェクト
*
* @package 登録フォーム
* @author 長江
* @copyright 2008 espeid
*/

require_once('FormObject.class.php');

class FormString extends FormObject		{

/*
 $min;	//文字数の最小値
 $max;	//文字数の最大値
*/
	 function __construct($value,$min,$max,$desc){
	$this->value	= $value;	//その値
    $this->min		= $min;
    $this->max		= $max;
    $this->desc		= $desc;	//表示名
    $this->status	= 1;		//エラー状態
  }

	/*
	* 値をチェックする関数
	* 回りくどいやり方をしてるが　これは、それぞれのオブジェクト(文字列、セレクトメニューなど）で
	* 処理する関数を統一するためか?
	* @access 
	* @param  no
	* @return no
	*/ 
	 function checkValue(){
	$this->checkLength();
	}

	/*
	* 文字数をチェックする関数
	* エラーがなければ $statusは　０になる。
	* @access 
	* @param  no
	* @return no
	*/ 
	 function checkLength(){
		if(mb_strlen($this->value) < $this->min){		//値の文字数が　最小値より小さかったら
			if($this->min == 1){
			$this->errorMsg = "「{$this->desc}」は必須入力です。";
			$this->status = 1;
			}else{
			$this->errorMsg =
            "「{$this->desc}」は{$this->min}文字〜{$this->max}文字以内で入力してください。";
			$this->status = 1;
			}
		}elseif(mb_strlen($this->value) > $this->max){	//値の文字数が　最大値が大きかったら
		$this->errorMsg = "「{$this->desc}」は最大{$this->max}文字です。";
		$this->status = 1;
		}else{
		$this->status = 0;
		}
	}

}
?>
