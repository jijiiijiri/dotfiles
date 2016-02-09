<?php
/**
 * 認証関連クラス
 * 
 * @package		AUTH
 * @author		h.nakase　<h.nakase@espeid.jp>
 * @copyright	2008 espeid
 */

/**
 * class MyAuth
 *
 * Formから入力された値とDBの値で認証
 *
 * @package	AUTH
 * @access	public
 * @author	h.nakase　<h.nakase@espeid.jp>
 */

class MyAuth {
/*
	public $id_key = '';		//IDキー
	public $pass_key = '';		//PASSキー
	public $val = '';			//変数
	public $bool_var = '';		//論理値変数
	public $str_var = '';		//文字列変数
	public $int_var = '';		//整数変数
	public $obj_var = '';		//オブジェクト変数
	public $key = '';			//連想配列のキー
	public $table = '';			//DB_TABLE名
	public $field = '';			//フィールド名
	public $cond = '';			//条件記号
	public $sort = '';			//昇順　OR　降順
	public $lim = '';			//表示件数			
	public $st = '';			//表示位置
	 $i = '';			//ループカウント
	 $sql = '';			//SQL文
	 $res = '';			//QUERY結果
	 $row = '';			//TABLEから取り出したデータ
	 $where_str = '';	//条件文
	
	public $array = array();	//配列
	public $array_var = array();//出力配列
	public $fields = array();	//フィールド名の配列
*/	
	/**
	* Construct
	* SESSIONのスタート
	*/
	function __construct(){
		session_start();
	}
	
	/**
	 *　	POST(連想配列)のキーの設定
	 * 
	 * 	@access public
	 *	@param  string
	 *	@param  string
	 */
	function setPostKey($id_key,$pass_key){
		$this->form_id = $_POST[$id_key];
		$this->form_pass = $_POST[$pass_key];
	}

	/**
	 *　	TABLEのフィールドキーの設定
	 * 
	 * 	@access public
	 *	@param  string
	 *	@param  string
	 */
	function setFieldKey($id_key,$pass_key){
		$this->field_id = $id_key;
		$this->field_pass = $pass_key;
	}
	
	/**
	 *　	ログイン未認証処理
	 * 
	 * 	@access public
	 * 	@param  string
	 *	@param  bool
	 */
	function exeAuthFailure($val,$bool_var){
		if(!$bool_var){
			header("location:".$val);
			exit;
		}
	}
	
	/**
	*	header関数:指定ページへ飛ばす
	*
	*	@access public
	*	@param  string
	*/
	function exeAuthSucces($val){
		header("location:".$val);
		exit;
	}
	
	/**
	 *　	$_SESSIONに値を追加
	 * 
	 * 	@access public
	 * 	@param  string
	 *	@param  string
	 */
	function setSessionAddData($key,$val){
		$_SESSION[$key] = $val; 
	}
	
//--- SQL

	/**
	 *　	SQL文をQUERY処理する。
	 * 
	 * 	@access 
	 *	@param  string
	 * 	@return	string OR bool
	 */
	 function _exeQuery($sql){
		$res = mysql_query($sql);
		return $res;
	}
	
	/**
	 *　	登録IDを返す。
	 * 
	 * 	@access public
	 *	@param  string
	 * 	@return	int
	 */
	function getRegId($table,$key){
		$sql = "SELECT * FROM $table WHERE $this->field_id = '$this->form_id' && $this->field_pass = '$this->form_pass'";
		$res = $this->_exeQuery($sql);
		$row = mysql_fetch_assoc($res);
		$int_var = $row[$key];
		return $int_var;
	}
	
	/**
	 *　	Login認証の結果を論理値で返す。
	 * 
	 * 	@access public
	 *	@param  string
	 * 	@return	string OR bool
	 */
	function exeLoginAuth($table){
		$sql = "SELECT * FROM $table WHERE $this->field_id = '$this->form_id' && $this->field_pass = '$this->form_pass'";
		$res = $this->_exeQuery($sql);
		$row = mysql_fetch_assoc($res);
		if(is_array($row)){
			$bool_var = true;
		}else{
			$bool_var = false;
		}
		return $bool_var;
	}
	
	/**
	 *　	Session認証の結果を論理値で返す。
	 * 
	 * 	@access public
	 *	@param  string
	 * 	@param  string
	 * 	@param  string
	 * 	@return	string OR bool
	 */
	function exeSessionAuth($table,$field1,$field2){
//		$sql = "SELECT * FROM $table WHERE $field1 = '$_SESSION[$field1]' && $field2 = '$_SESSION[$field2]'";
		$sql = "SELECT * FROM $table WHERE $field1 = '$_SESSION[$field1]' && $field2 = '$_SESSION[login_id]'";

		$res = $this->_exeQuery($sql);
		$row = mysql_fetch_assoc($res);
		if(is_array($row)){
			$bool_var = true;
		}else{
			$bool_var = false;
		}
		return $bool_var;
	}
	
	/**
	 * 値を更新する。
	 * 
	 * @public
	 * @param 
	 * 
	 */
	function exeUpdateData($table,$field,$val){
		$sql = "UPDATE $table SET $field = '$val' WHERE $this->field_id = '$this->form_id'";
		$res = $this->_exeQuery($sql);
	}
	
	/**
	 * 認証ページでのSESSION認証
	 */
	
}
	
?>