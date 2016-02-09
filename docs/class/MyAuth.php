<?php
/**
 * ǧ�ڴ�Ϣ���饹
 * 
 * @package		AUTH
 * @author		h.nakase��<h.nakase@espeid.jp>
 * @copyright	2008 espeid
 */

/**
 * class MyAuth
 *
 * Form�������Ϥ��줿�ͤ�DB���ͤ�ǧ��
 *
 * @package	AUTH
 * @access	public
 * @author	h.nakase��<h.nakase@espeid.jp>
 */

class MyAuth {
/*
	public $id_key = '';		//ID����
	public $pass_key = '';		//PASS����
	public $val = '';			//�ѿ�
	public $bool_var = '';		//�������ѿ�
	public $str_var = '';		//ʸ�����ѿ�
	public $int_var = '';		//�����ѿ�
	public $obj_var = '';		//���֥��������ѿ�
	public $key = '';			//Ϣ������Υ���
	public $table = '';			//DB_TABLE̾
	public $field = '';			//�ե������̾
	public $cond = '';			//��ﵭ��
	public $sort = '';			//���硡OR���߽�
	public $lim = '';			//ɽ�����			
	public $st = '';			//ɽ������
	 $i = '';			//�롼�ץ������
	 $sql = '';			//SQLʸ
	 $res = '';			//QUERY���
	 $row = '';			//TABLE������Ф����ǡ���
	 $where_str = '';	//���ʸ
	
	public $array = array();	//����
	public $array_var = array();//��������
	public $fields = array();	//�ե������̾������
*/	
	/**
	* Construct
	* SESSION�Υ�������
	*/
	function __construct(){
		session_start();
	}
	
	/**
	 *��	POST(Ϣ������)�Υ���������
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
	 *��	TABLE�Υե�����ɥ���������
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
	 *��	������̤ǧ�ڽ���
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
	*	header�ؿ�:����ڡ��������Ф�
	*
	*	@access public
	*	@param  string
	*/
	function exeAuthSucces($val){
		header("location:".$val);
		exit;
	}
	
	/**
	 *��	$_SESSION���ͤ��ɲ�
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
	 *��	SQLʸ��QUERY�������롣
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
	 *��	��ϿID���֤���
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
	 *��	Loginǧ�ڤη�̤������ͤ��֤���
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
	 *��	Sessionǧ�ڤη�̤������ͤ��֤���
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
	 * �ͤ򹹿����롣
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
	 * ǧ�ڥڡ����Ǥ�SESSIONǧ��
	 */
	
}
	
?>