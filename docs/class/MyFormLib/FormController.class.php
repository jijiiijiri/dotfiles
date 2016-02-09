<?php

require_once('./inc/smarty/Smarty.class.php');
require_once('./inc/InquiryForm/FormObjectRequire.php');

class FormController
{
  const execConfirm = 'confirm';
  const execSend = 'send';
  protected $exec;
  protected $smarty;
  protected $formObject;
  protected $fromMailAddress;
  protected $toMailAdderss;
  protected $mailTitle;
  protected $initTemplate;
  protected $confirmTemplate;
  protected $finishTemplate;
  protected $mailTemplate;
  protected $errorTemplate;
  protected $templateDir;
  protected $compileDir;
  private $errorMsg;
  private $errorCount;

  public function __construct($formObject,$exec,
                  $fromMailAddress,$toMailAddress,$mailTitle){
    $this->formObject = $formObject;
    $this->exec = $exec;
    $this->fromMailAddress = $fromMailAddress;
    $this->toMailAddress = $toMailAddress;
    $this->mailTitle = $mailTitle;
    $this->errorMsg = '';
    $this->errorCount = 0;
  }

  public function setSmartyDir($templateDir,$compileDir,$cacheDir){
    $this->templateDir = $templateDir;
    $this->compileDir = $compileDir;
    $this->cacheDir = $cacheDir;
  }

  public function setTemplates($initTemplate,$confirmTemplate,
                  $finishTemplate,$mailTemplate,$errorTemplate){
    $this->initTemplate = $initTemplate;
    $this->confirmTemplate = $confirmTemplate;
    $this->finishTemplate = $finishTemplate;
    $this->mailTemplate = $mailTemplate;
    $this->errorTemplate = $errorTemplate;
  }

  public function doFormAction(){
    $dispTemplate;
    $this->createSmarty();		   // Smarty����

    // ����������Ƚ��
    switch($this->exec){

	case self::execConfirm:		//��confirm�פλ��ǡ���ǧ���̤�

		if($this->confirmFormObject() == 0){
		$dispTemplate = $this->confirmTemplate;
		}else{
		$dispTemplate = $this->errorTemplate;
		}

	$this->assignValues();
	break;

	case self::execSend:		//��λ���̤ء��᡼������
		if($this->confirmFormObject() == 0){
		$this->sendMailAction();		//�᡼������
		//        $this->testSendMailAction();
		$dispTemplate = $this->finishTemplate;
		}else{
		$this->assignValues();			//
		$dispTemplate = $this->errorTemplate;
		}
	break;

    default:
	$dispTemplate = $this->initTemplate;
	break;
	}

    // �ڡ���ɽ��
    $this->smarty->display($dispTemplate);
  }

  protected function checkFormObject(){
    foreach($this->formObject as $key => $value){
      $value->checkValue();
      if($value->getStatus() != 0){
        $this->errorCount++;
        $this->errorMsg[] = $value->getErrorMsg();
      }
    }
  }

  protected function confirmFormObject(){
    $this->checkFormObject();
    if($this->errorCount > 0){
      // ���ϥ��顼����
      $this->smarty->assign('errorMsg',$this->errorMsg);
    }
    return $this->errorCount;
  }

  protected function assignValues(){
    // ���Ϲ��ܥ�������
    foreach($this->formObject as $key => $value){
      $this->smarty->assign($key,$value->getValue());
    }
    $this->smarty->assign('errorCount',$this->errorCount);
    $this->smarty->assign('errorMsg',$this->errorMsg);
  }

  protected function sendMailAction(){
    $mailBody;
    // �᡼����ʸ����
    foreach($this->formObject as $key => $value){
      $this->smarty->assign($key,$value->getValueString());
    }
    $this->smarty->clear_cache($this->mailTemplate);
    $mailBody = $this->smarty->fetch($this->mailTemplate);
    // �᡼������
    $mailObj = new SendMail($this->fromMailAddress,$this->toMailAddress,
                            $this->mailTitle,$mailBody);
    $mailObj->send();
  }

  protected function testSendMailAction(){
    echo "OK";
  }

  protected function createSmarty(){
    $this->smarty = new Smarty;
    $this->smarty->template_dir = $this->templateDir;
    $this->smarty->compile_dir = $this->compileDir;
    $this->smarty->cache_dir = $this->cacheDir;
  }
}

// *****************************************��
?>
