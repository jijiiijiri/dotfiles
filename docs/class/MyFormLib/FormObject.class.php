<?php
/**
* FormObject
*
* Form���쥪�֥�������
*
* @package ��Ͽ�ե�����
* @author Ĺ��
* @copyright 2008 espeid
*/

class FormObject{
/*
protected $value;	//���Τ����
protected $status;	//���֡ʥǥե���Ȥ����ǥ��顼��̵���ȣ��ˤʤ��
protected $desc;	//�ͤ�̾��
protected $errorMsg;//���顼��å�����
*/
	//�ޤ��ͤ��������
	//���֤򣱤����ꤹ��
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
