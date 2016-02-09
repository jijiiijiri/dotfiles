<?php
/**
* �ե�����Υ��饹
*
* 
* 
* 
* @package 
* @author Ĺ��
* @copyright 2008 espeid
*/


//require_once('./class/MyFormLib/FormController.class.php');	//�ե����४�֥������ȴ������饹
require_once('/virtual/210.150.69.216/home/H20enquete/class/MyFormLib/FormString.class.php');		//�ե����४�֥������ȴ��쥯�饹
require_once('/virtual/210.150.69.216/home/H20enquete/class/MyFormLib/FormSelect.class.php');		//���ޤ��Ĥ��������ɥ��쥯�ȥ�˥塼�Υ��饹



//�ե����४�֥�������
class MyForm {

	protected $FORM_MODE;	//
	protected $formObj;		//�ե�����ˤ��뤽�줾��Υǡ������֥�������(����ˤʤ�)
	protected $arg;		//�ե�����ˤ��뤽�줾��Υǡ������֥�������(����ˤʤ�)

	public function getERROR_CNT(){
	return $this->errorCnt;				//���顼���
	}

	public function getERROR_MSG(){
	return $this->errorMsg;				//���顼��å�����
	}

	public function setERROR_MSG($mes){
	$this->errorMsg[] = $mes;	//���顼��å������������
	$this->errorCnt++;					//���顼����򥫥����
	}

	public function getArg(){
	$this->arg["ERROR_MSG"]  = $this->errorMsg; 		//���顼��å������������
	$this->arg["FORM_CONT"]  = $this->getFORM_CONT(); 	//���������Ĥ���
	$this->arg["ERROR_CNT"]  = $this->errorCnt; 		//���顼�����ɽ��
		foreach($this->formObj as $key => $value){
		$this->arg["$key"] = $value->getValue();
		}
	return $this->arg;
	}

	public function getArgPure(){
		foreach($this->formObj as $key => $value){
		$this->arg["$key"] = $value->getValue();
		}
	return $this->arg;
	}

	/*
	* ĺ����Array���ͤ򤤤�Ƥ�����
	*
	* @access publice
	* @param  $array
	* @return $array
	*/ 

	public function getArgNext($arg){
	$this->arg = $arg;
		//���顼��å�����������ľ��
		//����ˤ���Ƥ��������Ԥ򡡤ޤ��Ф��Ƥ�Ȥ���ˡ����촶������
		for($i = 0 ; $i < count($this->errorMsg) ; $i++){
			if($this->errorMsg[$i] != ""){	//��FormObj���顡�ɤ����Ƥ�­���Ƥ��ޤ��ΤǤ�����ɤ�
			$this->arg["ERROR_MSG"][] = $this->errorMsg[$i];
			}
		}

	$this->arg["FORM_CONT"]  .= $this->getFORM_CONT(); 					//�����������ɲ�
	$this->arg["ERROR_CNT"]   = $arg["ERROR_CNT"] + $this->errorCnt; 	//���顼�����׻�
		foreach($this->formObj as $key => $value){
		$this->arg["$key"] = $value->getValue();						//�ե������ɬ�פ����Ǥ������
		}
	return $this->arg;
	}

	/*
	* �ޤ��ϥ��󥹥ȥ饯��
	*
	* @access private
	* @param  $key
	* @return no
	*/ 

	public function __construct($formObj,$db_table){
    $this->formObj		= $formObj;	//�ե����४�֥�������
    $this->db_table		= $db_table;//�ơ��֥����
    $this->errorMsg		= '';		//���顼��å�����������
    $this->errorCnt		= 0;		//���顼���ϡ�0��
	}

	/*
	* �ե����४�֥������Ȥ��ǧ
	*
	* @access protected
	* @param  no
	* @return no
	*/ 
	public function confirmFormObject(){
	$this->_checkFormObject();			//�ƥե�����ι��ܤΥ��顼�����å�
	return $this->errorCnt;				//���ϥ��顼���������
	}

	/*
	* �ե����४�֥������Ȥ�����å�����
	* ���顼�����å��򤷤ơ����顼�����ä���
	* ���顼��å����������餤����
	* @access protected
	* @param  no
	* @return no
	*/ 
	protected function _checkFormObject(){
		foreach($this->formObj as $key => $value){		//���Τ�������������
		$value->checkValue();							//���줾��Υ��֥������ȤΥ����å��ؿ����������(Ʊ��̾��)
			if($value->getStatus() != 0){				//���顼�����ä���
			$this->errorCnt++;							//���顼����򥫥����
			$this->errorMsg[] = $value->getErrorMsg();	//��å�����������
			}
		}
	}

	/*
	* �Խ����̤ʤɤǺ������뱣���������������
	*
	* @access protected
	* @param  no
	* @return no
	*/ 
	public function getFORM_CONT(){
		foreach($this->formObj as $key => $value){			//�ե����४�֥������Ȥ��
		$val = $value->getValue();
			if(is_array($val)){			//����ʤ�
				foreach($val as $VAL){
				$FORM_CONT .= '<input type="hidden" name="'.$key.'[]" value="'.$VAL.'">'."\n";	
				}
			}else{
			$FORM_CONT .= '<input type="hidden" name="'.$key.'" value="'.$val.'">'."\n";	
			}
		}
	return $FORM_CONT;
	}

	/*
	* ������Ͽ�Ѥߤ��ɤ���������å����ޤ���(����)
	*
	* @access private
	* @param  $key
	* @return no
	*/ 
	public function checkName($key){
	$value = $this->formObj[$key]->getValue();	//̾�������
	$sql = "SELECT id FROM $this->db_table WHERE ".$key."='".$value."'";
	$res = mysql_query($sql);
		if(mysql_num_rows($res) > 0){
			$this->errorCnt++;									//���顼����򥫥����
			$desc = $this->formObj[$key]->getValueDesc();		//ɽ��̾�����
			$this->errorMsg[] = "������Ͽ�Ѥߤ�".$desc."�Ǥ�";	//��å�����������
		}
	}

	/*
	* ������Ͽ�Ѥߤ��ɤ���������å����ޤ��ʹ���)
	*
	* @access private
	* @param  no
	* @return no
	*/ 
	public function checkUpdateName($key){
	$id		= $this->formObj['id']->getValue();	//id�����
	$value	= $this->formObj[$key]->getValue();	//̾�������
	$sql = "SELECT id FROM $this->db_table WHERE ".$key."='".$value."'";
	$res = mysql_query($sql);
		if(mysql_num_rows($res) > 0){
			while($col = mysql_fetch_array($res)){
				while(list($k,$v) = each($col)){
					if($v != $id)	$flag = 1;
				}
			}	
		}
		if($flag){											//id���̤��ä���
		$this->errorCnt++;									//���顼����򥫥����
		$desc = $this->formObj[$key]->getValueDesc();		//ɽ��̾�����
		$this->errorMsg[] = "������Ͽ�Ѥߤ�".$desc."�Ǥ�";	//��å�����������
		}
	}

	/*
	* DB��ή������
	* 
	* 
	* @access private
	* @param  no
	* @return no
	*/ 
	public function insertData($debug=0){
		foreach($this->formObj as $key => $value){			//�ե����४�֥������Ȥ��
		$col .= $key.",";						//����̾���㡧name,id,mailadd
			if(is_array($value->getValue())){			//����ʤ�
			$val .= "'".$value->getValueString()."',";	//getValueString���ͤ��������
			}else{
			$val .= "'".$value->getValue()."',";		//getValue���ͤ��������
			}
		}
	$col  = preg_replace("/,$/","",$col);		//�Ǹ�Ρ�,�פ���
	$val  = preg_replace("/,$/","",$val);		//�Ǹ�Ρ�',�פ���
	$sql = "INSERT INTO $this->db_table (".$col.") VALUES(".$val.")";
	if($debug){ echo $sql;}
	mysql_query($sql);
	}

	/*
	* DB�򹹿�����
	* 
	* @access private
	* @param  no
	* @return no
	*/ 
	public function updateData($debug=0){
	$i = 0;
		foreach($this->formObj as $key => $value){			//�ե����४�֥������Ȥ��
			if($i == 0){
			$col = $key." = '".$value->getValue()."'";
			}else{
			$val .= $key." = '".$value->getValue()."',";
			}
		$i++;
		}
	$val = preg_replace("/,$/","",$val);		//�Ǹ�Ρ�,�פ���
	$sql = "UPDATE $this->db_table SET ".$val." WHERE ".$col;
	if($debug){ echo $sql;}
	mysql_query($sql);
	}

	/*
	* DB����ä�
	* 
	* 
	* @access private
	* @param  no
	* @return no
	*/ 
	public function deleteData(){
	$id		= $this->formObj['id']->getValue();	//id�����
	$sql = "DELETE FROM $this->db_table WHERE id = ".$id;
	mysql_query($sql);
	}




	/*
	* ���̤Υǡ�������Ф���
	* 
	* @access private
	* @param  $val
	* @return no
	*/ 
	public function getArgDirect($key){
	return $this->formObj[$key]->getValue();	//̾�������
	}

}

?>