<?php
/**
* DBSelect
*
* セレクトメニューの時のオブジェクト
*
* @package 登録フォーム
* @author 長江
* @copyright 2008 espeid
*/
require_once('DBObject.class.php');

//class DBSelect extends DBObject
class DBSelect
{
/*
protected $table;
protected $array;
protected $sql;
protected $res;
protected $zero;		//選択してください　を入れるか？
protected $sort;		//ソートする項目を決める
*/
//protected $array;

	 function __construct($table,$zero=0,$sort=""){
	$this->table = $table;		//テーブル名が入る
	$this->sql = "SELECT * FROM ".$table;	//SQL文作成
		if($sort != ""){
		$this->sort = " ORDER BY ".$sort;
		$this->sql .= $this->sort;
		}else{
		$this->sort = " ORDER BY id ";
		$this->sql .= $this->sort;
		}
	$this->res = mysql_query($this->sql);	//SQL実行
	$this->zero= $zero;						//
	$this->_setArray();						//配列作成
	}

	/*
	* 配列を作成する
	* 
	* 
	* @access 
	* @param  no
	* @return no
	*/ 
	function _setArray(){
	$i = 1;
	//「選択してください」を出す（デフォは出す設定）
		if($this->zero == 0){
		$this->arg[$this->table][0] = "選択してください";
		}

		while($col = mysql_fetch_array($this->res)){
			while(list($key,$val) = each($col)){
			if(ereg("id$",$key)){$i = $val;	}
				if(ereg("name$",$key)){
				$this->arg[$this->table][$i] = $val;		//連想配列を作る
				$this->array[$i] = $val;					//配列を作る
				}
			}
		$i++;
		}
	}

	/*
	* 配列を取得する関数
	* 相変わらず　同じ名前
	* 
	* @access 
	* @param  no
	* @return no
	*/ 
	 function getArray(){
	return $this->array;
	}

	/*
	* こちらは、連想配列を取得する関数
	* 
	* @access 
	* @param  no
	* @return no
	*/ 
	 function getNamedArray(){
	return $this->arg;
	}

}
?>
