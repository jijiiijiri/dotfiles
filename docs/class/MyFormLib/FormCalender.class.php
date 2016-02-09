<?php

require_once('FormObject.class.php');

class FormCalender extends FormObject
{
//  protected $required;


  function __construct($value1,$value2,$value3,$required=0,$desc='ǯ����',$key){
    $this->value['0'] = $value1;	//ǯ
    $this->value['1'] = $value2;	//��
    $this->value['2'] = $value3;	//��
    $this->required = $required;
    $this->desc = $desc;
    $this->key  = $key;
    $this->status = 1;
  }

  function checkValue(){
    // ɬ������
    if($this->required != 0){
      $this->checkForm();
    }
    // Ǥ������
    else{
      if($this->value['0'] != '' || $this->value['1'] != '' || $this->value['2'] != ''){
        $this->checkForm();
      }
      else{
        $this->status = 0;
      }
    }
  }

 function getValueString(){
//		if($this->value['0'] != '' || $this->value['1'] != '' || $this->value['2'] != ''){
		$this->valueString = $this->value['0'] . '-' . $this->value['1'].'-' . $this->value['2'];
//		}else{
//		$valueString = $_POST["$this->key"];
//		}
	return $this->valueString;
	}

 function getValue(){
//�����϶����ʤ�����Ǥ��롣��ľ������
		if($this->valueString == "--") $this->valueString = $_POST["$this->key"];
	return $this->valueString;
	}

 function checkForm(){
    if(mb_ereg('^[0-9]{4}$',$this->value['0']) == false ||
       mb_ereg('^[0-9]{1,2}$',$this->value['1']) == false ||
       mb_ereg('^[0-9]{1,2}$',$this->value['2']) == false ){
      $this->errorMsg = "��{$this->desc}�פ����������Ϥ��Ƥ���������";
      $this->status = 1;
    }
    else{
      $this->status = 0;
    }
  }
}


?>
