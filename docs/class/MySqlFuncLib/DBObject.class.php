<?php
/**
* DBObject
*
* DB���쥪�֥�������
*
* @package ��Ͽ�ե�����
* @author Ĺ��
* @copyright 2008 espeid
*/

class DBObject{
/*
protected $table;	//�ơ��֥���
protected $array;	//�������
protected $res;		//�¹Է��
*/
//protected $status;	//���֡ʥǥե���Ȥ����ǥ��顼��̵���ȣ��ˤʤ��
//protected $desc;		//�ͤ�̾��
//protected $errorMsg;	//���顼��å�����

	//�ޤ��ͤ��������
	//���֤򣱤����ꤹ��
	 function __construct($table){
	$this->table = $table;
	}

	/**
	 *��	SQLʸ��QUERY�������롣
	 * 
	 * 	@access private
	 *	@param  string
	 * 	@return	string OR bool
	 */
	 function exeQuery($sql){
	$this->res = mysql_query($sql);		//SQL��¹Ԥ���
	}

}

?>
