<?php

require_once('FormObject.class.php');

class FormCalender extends FormObject
{
//  protected $required;


  function __construct($value1,$value2,$value3,$required=0,$desc='年月日',$key){
    $this->value['0'] = $value1;	//年
    $this->value['1'] = $value2;	//月
    $this->value['2'] = $value3;	//日
    $this->required = $required;
    $this->desc = $desc;
    $this->key  = $key;
    $this->status = 1;
  }

  function checkValue(){
    // 必須入力
    if($this->required != 0){
      $this->checkForm();
    }
    // 任意入力
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
//ここは強引なやり方である。見直すこと
		if($this->valueString == "--") $this->valueString = $_POST["$this->key"];
	return $this->valueString;
	}

 function checkForm(){
    if(mb_ereg('^[0-9]{4}$',$this->value['0']) == false ||
       mb_ereg('^[0-9]{1,2}$',$this->value['1']) == false ||
       mb_ereg('^[0-9]{1,2}$',$this->value['2']) == false ){
      $this->errorMsg = "「{$this->desc}」を正しく入力してください。";
      $this->status = 1;
    }
    else{
      $this->status = 0;
    }
  }
}


?>
