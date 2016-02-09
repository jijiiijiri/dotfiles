<?php
/**
* DBObject
*
* DB基底オブジェクト
*
* @package 登録フォーム
* @author 長江
* @copyright 2008 espeid
*/

class DBObject{
/*
protected $table;	//テーブル値
protected $array;	//配列の値
protected $res;		//実行結果
*/
//protected $status;	//状態（デフォルトが１でエラーが無いと０になる）
//protected $desc;		//値の名称
//protected $errorMsg;	//エラーメッセージ

	//まず値を取得する
	//状態を１に設定する
	 function __construct($table){
	$this->table = $table;
	}

	/**
	 *　	SQL文をQUERY処理する。
	 * 
	 * 	@access private
	 *	@param  string
	 * 	@return	string OR bool
	 */
	 function exeQuery($sql){
	$this->res = mysql_query($sql);		//SQLを実行する
	}

}

?>
