<?php
/**
* FormSelect
*
* ���쥯�ȥ�˥塼�λ��Υ��֥�������
*
* @package ��Ͽ�ե�����
* @author Ĺ��
* @copyright 2008 espeid
*/
require_once('FormObject.class.php');

class FormSelect extends FormObject
{
protected $value;
protected $valueSet;
protected $required;

	public function __construct($value,$valueSet,$required=0,$desc){
	$this->value = $value;		//������(���ξ�������
	$this->valueSet = $valueSet;//���쥯�ȥ�˥塼�����󤬤Ϥ���
	$this->required = $required;//ɬ�ܹ��ܤ��ɤ���
	$this->desc = $desc;		//ɽ��̾
	$this->status = 1;			//���顼����
	}

	/*
	* �ͤ�����å�����ؿ�
	* ���Ѥ�餺��Ʊ��̾��
	* 
	* @access public
	* @param  no
	* @return no
	*/ 
	public function checkValue(){
		if($this->required != 0){    // ɬ������
		$this->checkSelected();
			if($this->status != 1){
			$this->checkSelectedValue();
			}
		}else{   					 // Ǥ������
			if($this->value != "" && $this->value != "0"){
			$this->checkSelectedValue();
			}else{
			$this->status = 0;
			}
		}
	}
	/*
	* �ͤ��������ؿ�
	* ʸ����ʤΤǡ��̾�Ȥϰ�äơ�getValueString()�Ǥ��롣
	* �̾�ϡ�getValue()
	*
	* @access public
	* @param  no
	* @return no
	*/ 
	public function getValueString(){
		if(array_key_exists($this->value,$this->valueSet)){	//����ʤ��
		return $this->valueSet[$this->value];				//�ͤ򤤤�ơ�ʸ������֤�
		}else{
		return '';
		}
	}

	private function checkSelected(){
    if($this->value == "" || $this->value == "0"){
      $this->errorMsg = "��{$this->desc}�פ����򤷤Ƥ���������";
      $this->status = 1;
    }
    else{
      $this->status = 0;
    }
  }

  private function checkSelectedValue(){
    $hitFlag = 0;
//    foreach($this->valueSet as $key => $item){
      if($this->value > 0){
        $hitFlag = 1;
        $this->status = 0;
//      break;
//     }
    }

    if($hitFlag != 1){
      $this->errorMsg = "��{$this->desc}�פ����򤷤Ƥ���������";
      $this->status = 1;
    }
  }
}

// *****************************************��
?>