<?php
/**
* DBSelect
*
* ���쥯�ȥ�˥塼�λ��Υ��֥�������
*
* @package ��Ͽ�ե�����
* @author Ĺ��
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
protected $zero;		//���򤷤Ƥ���������������뤫��
protected $sort;		//�����Ȥ�����ܤ����
*/
//protected $array;

	 function __construct($table,$zero=0,$sort=""){
	$this->table = $table;		//�ơ��֥�̾������
	$this->sql = "SELECT * FROM ".$table;	//SQLʸ����
		if($sort != ""){
		$this->sort = " ORDER BY ".$sort;
		$this->sql .= $this->sort;
		}else{
		$this->sort = " ORDER BY id ";
		$this->sql .= $this->sort;
		}
	$this->res = mysql_query($this->sql);	//SQL�¹�
	$this->zero= $zero;						//
	$this->_setArray();						//�������
	}

	/*
	* ������������
	* 
	* 
	* @access 
	* @param  no
	* @return no
	*/ 
	function _setArray(){
	$i = 1;
	//�����򤷤Ƥ��������פ�Ф��ʥǥե��ϽФ������
		if($this->zero == 0){
		$this->arg[$this->table][0] = "���򤷤Ƥ�������";
		}

		while($col = mysql_fetch_array($this->res)){
			while(list($key,$val) = each($col)){
			if(ereg("id$",$key)){$i = $val;	}
				if(ereg("name$",$key)){
				$this->arg[$this->table][$i] = $val;		//Ϣ���������
				$this->array[$i] = $val;					//�������
				}
			}
		$i++;
		}
	}

	/*
	* ������������ؿ�
	* ���Ѥ�餺��Ʊ��̾��
	* 
	* @access 
	* @param  no
	* @return no
	*/ 
	 function getArray(){
	return $this->array;
	}

	/*
	* ������ϡ�Ϣ��������������ؿ�
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
