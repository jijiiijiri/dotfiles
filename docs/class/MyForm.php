<?php
/**
* フォームのクラス
*
* 
* 
* 
* @package 
* @author 長江
* @copyright 2008 espeid
*/


//require_once('./class/MyFormLib/FormController.class.php');	//フォームオブジェクト管理クラス
require_once('/virtual/210.150.69.216/home/H20enquete/class/MyFormLib/FormString.class.php');		//フォームオブジェクト基底クラス
require_once('/virtual/210.150.69.216/home/H20enquete/class/MyFormLib/FormSelect.class.php');		//あまり手つかずだけどセレクトメニューのクラス



//フォームオブジェクト
class MyForm {

	protected $FORM_MODE;	//
	protected $formObj;		//フォームにあるそれぞれのデータオブジェクト(配列になる)
	protected $arg;		//フォームにあるそれぞれのデータオブジェクト(配列になる)

	public function getERROR_CNT(){
	return $this->errorCnt;				//エラー件数
	}

	public function getERROR_MSG(){
	return $this->errorMsg;				//エラーメッセージ
	}

	public function setERROR_MSG($mes){
	$this->errorMsg[] = $mes;	//エラーメッセージを入れる
	$this->errorCnt++;					//エラー件数をカウント
	}

	public function getArg(){
	$this->arg["ERROR_MSG"]  = $this->errorMsg; 		//エラーメッセージを入れる
	$this->arg["FORM_CONT"]  = $this->getFORM_CONT(); 	//隠しタグつくる
	$this->arg["ERROR_CNT"]  = $this->errorCnt; 		//エラー件数を表示
		foreach($this->formObj as $key => $value){
		$this->arg["$key"] = $value->getValue();
		}
	return $this->arg;
	}

	public function getArgPure(){
		foreach($this->formObj as $key => $value){
		$this->arg["$key"] = $value->getValue();
		}
	return $this->arg;
	}

	/*
	* 頂いたArrayに値をいれてかえす
	*
	* @access publice
	* @param  $array
	* @return $array
	*/ 

	public function getArgNext($arg){
	$this->arg = $arg;
		//エラーメッセージを入れ直す
		//配列にいれてため込んだ者を　また出してるところに　今一感がある
		for($i = 0 ; $i < count($this->errorMsg) ; $i++){
			if($this->errorMsg[$i] != ""){	//別FormObjから　どうしても足してしまうのでそれを防ぐ
			$this->arg["ERROR_MSG"][] = $this->errorMsg[$i];
			}
		}

	$this->arg["FORM_CONT"]  .= $this->getFORM_CONT(); 					//隠しタグを追加
	$this->arg["ERROR_CNT"]   = $arg["ERROR_CNT"] + $this->errorCnt; 	//エラー件数を計算
		foreach($this->formObj as $key => $value){
		$this->arg["$key"] = $value->getValue();						//フォームに必要な要素を入れる
		}
	return $this->arg;
	}

	/*
	* まずはコンストラクト
	*
	* @access private
	* @param  $key
	* @return no
	*/ 

	public function __construct($formObj,$db_table){
    $this->formObj		= $formObj;	//フォームオブジェクト
    $this->db_table		= $db_table;//テーブル指定
    $this->errorMsg		= '';		//エラーメッセージを初期化
    $this->errorCnt		= 0;		//エラー数は　0に
	}

	/*
	* フォームオブジェクトを確認
	*
	* @access protected
	* @param  no
	* @return no
	*/ 
	public function confirmFormObject(){
	$this->_checkFormObject();			//各フォームの項目のエラーチェック
	return $this->errorCnt;				//入力エラー件数を送る
	}

	/*
	* フォームオブジェクトをチェックする
	* エラーチェックをして　エラーがあったら
	* エラーメッセージを総ざらいする
	* @access protected
	* @param  no
	* @return no
	*/ 
	protected function _checkFormObject(){
		foreach($this->formObj as $key => $value){		//このやり方が凄く上手
		$value->checkValue();							//それぞれのオブジェクトのチェック関数を処理する(同じ名前)
			if($value->getStatus() != 0){				//エラーがあったら
			$this->errorCnt++;							//エラー件数をカウント
			$this->errorMsg[] = $value->getErrorMsg();	//メッセージを代入
			}
		}
	}

	/*
	* 編集画面などで作成する隠しタグを作成する
	*
	* @access protected
	* @param  no
	* @return no
	*/ 
	public function getFORM_CONT(){
		foreach($this->formObj as $key => $value){			//フォームオブジェクトより
		$val = $value->getValue();
			if(is_array($val)){			//配列なら
				foreach($val as $VAL){
				$FORM_CONT .= '<input type="hidden" name="'.$key.'[]" value="'.$VAL.'">'."\n";	
				}
			}else{
			$FORM_CONT .= '<input type="hidden" name="'.$key.'" value="'.$val.'">'."\n";	
			}
		}
	return $FORM_CONT;
	}

	/*
	* 既に登録済みかどうかをチェックします。(新規)
	*
	* @access private
	* @param  $key
	* @return no
	*/ 
	public function checkName($key){
	$value = $this->formObj[$key]->getValue();	//名前を取得
	$sql = "SELECT id FROM $this->db_table WHERE ".$key."='".$value."'";
	$res = mysql_query($sql);
		if(mysql_num_rows($res) > 0){
			$this->errorCnt++;									//エラー件数をカウント
			$desc = $this->formObj[$key]->getValueDesc();		//表示名を取得
			$this->errorMsg[] = "既に登録済みの".$desc."です";	//メッセージを代入
		}
	}

	/*
	* 既に登録済みかどうかをチェックします（更新)
	*
	* @access private
	* @param  no
	* @return no
	*/ 
	public function checkUpdateName($key){
	$id		= $this->formObj['id']->getValue();	//idを取得
	$value	= $this->formObj[$key]->getValue();	//名前を取得
	$sql = "SELECT id FROM $this->db_table WHERE ".$key."='".$value."'";
	$res = mysql_query($sql);
		if(mysql_num_rows($res) > 0){
			while($col = mysql_fetch_array($res)){
				while(list($k,$v) = each($col)){
					if($v != $id)	$flag = 1;
				}
			}	
		}
		if($flag){											//idが別だったら
		$this->errorCnt++;									//エラー件数をカウント
		$desc = $this->formObj[$key]->getValueDesc();		//表示名を取得
		$this->errorMsg[] = "既に登録済みの".$desc."です";	//メッセージを代入
		}
	}

	/*
	* DBに流し込む
	* 
	* 
	* @access private
	* @param  no
	* @return no
	*/ 
	public function insertData($debug=0){
		foreach($this->formObj as $key => $value){			//フォームオブジェクトより
		$col .= $key.",";						//項目名。例：name,id,mailadd
			if(is_array($value->getValue())){			//配列なら
			$val .= "'".$value->getValueString()."',";	//getValueStringで値を取得する
			}else{
			$val .= "'".$value->getValue()."',";		//getValueで値を取得する
			}
		}
	$col  = preg_replace("/,$/","",$col);		//最後の「,」を取る
	$val  = preg_replace("/,$/","",$val);		//最後の「',」を取る
	$sql = "INSERT INTO $this->db_table (".$col.") VALUES(".$val.")";
	if($debug){ echo $sql;}
	mysql_query($sql);
	}

	/*
	* DBを更新する
	* 
	* @access private
	* @param  no
	* @return no
	*/ 
	public function updateData($debug=0){
	$i = 0;
		foreach($this->formObj as $key => $value){			//フォームオブジェクトより
			if($i == 0){
			$col = $key." = '".$value->getValue()."'";
			}else{
			$val .= $key." = '".$value->getValue()."',";
			}
		$i++;
		}
	$val = preg_replace("/,$/","",$val);		//最後の「,」を取る
	$sql = "UPDATE $this->db_table SET ".$val." WHERE ".$col;
	if($debug){ echo $sql;}
	mysql_query($sql);
	}

	/*
	* DBから消す
	* 
	* 
	* @access private
	* @param  no
	* @return no
	*/ 
	public function deleteData(){
	$id		= $this->formObj['id']->getValue();	//idを取得
	$sql = "DELETE FROM $this->db_table WHERE id = ".$id;
	mysql_query($sql);
	}




	/*
	* 個別のデータを抽出する
	* 
	* @access private
	* @param  $val
	* @return no
	*/ 
	public function getArgDirect($key){
	return $this->formObj[$key]->getValue();	//名前を取得
	}

}

?>