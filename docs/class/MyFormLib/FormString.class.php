<?php
/**
* FormString
*
* ʸ����Υ��֥�������
*
* @package ��Ͽ�ե�����
* @author Ĺ��
* @copyright 2008 espeid
*/

require_once('FormObject.class.php');

class FormString extends FormObject		{

/*
 $min;	//ʸ�����κǾ���
 $max;	//ʸ�����κ�����
*/
	 function __construct($value,$min,$max,$desc){
	$this->value	= $value;	//������
    $this->min		= $min;
    $this->max		= $max;
    $this->desc		= $desc;	//ɽ��̾
    $this->status	= 1;		//���顼����
  }

	/*
	* �ͤ�����å�����ؿ�
	* ��꤯�ɤ�������򤷤Ƥ뤬������ϡ����줾��Υ��֥�������(ʸ���󡢥��쥯�ȥ�˥塼�ʤɡˤ�
	* ��������ؿ������줹�뤿�ᤫ?
	* @access 
	* @param  no
	* @return no
	*/ 
	 function checkValue(){
	$this->checkLength();
	}

	/*
	* ʸ����������å�����ؿ�
	* ���顼���ʤ���� $status�ϡ����ˤʤ롣
	* @access 
	* @param  no
	* @return no
	*/ 
	 function checkLength(){
		if(mb_strlen($this->value) < $this->min){		//�ͤ�ʸ���������Ǿ��ͤ�꾮�����ä���
			if($this->min == 1){
			$this->errorMsg = "��{$this->desc}�פ�ɬ�����ϤǤ���";
			$this->status = 1;
			}else{
			$this->errorMsg =
            "��{$this->desc}�פ�{$this->min}ʸ����{$this->max}ʸ����������Ϥ��Ƥ���������";
			$this->status = 1;
			}
		}elseif(mb_strlen($this->value) > $this->max){	//�ͤ�ʸ�������������ͤ��礭���ä���
		$this->errorMsg = "��{$this->desc}�פϺ���{$this->max}ʸ���Ǥ���";
		$this->status = 1;
		}else{
		$this->status = 0;
		}
	}

}
?>
