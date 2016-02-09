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
    $this->createSmarty();		   // Smarty生成

    // 処理コード判定
    switch($this->exec){

	case self::execConfirm:		//「confirm」の時で、確認画面へ

		if($this->confirmFormObject() == 0){
		$dispTemplate = $this->confirmTemplate;
		}else{
		$dispTemplate = $this->errorTemplate;
		}

	$this->assignValues();
	break;

	case self::execSend:		//完了画面へ　メール送信
		if($this->confirmFormObject() == 0){
		$this->sendMailAction();		//メール送信
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

    // ページ表示
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
      // 入力エラー処理
      $this->smarty->assign('errorMsg',$this->errorMsg);
    }
    return $this->errorCount;
  }

  protected function assignValues(){
    // 入力項目アサイン
    foreach($this->formObject as $key => $value){
      $this->smarty->assign($key,$value->getValue());
    }
    $this->smarty->assign('errorCount',$this->errorCount);
    $this->smarty->assign('errorMsg',$this->errorMsg);
  }

  protected function sendMailAction(){
    $mailBody;
    // メール本文作成
    foreach($this->formObject as $key => $value){
      $this->smarty->assign($key,$value->getValueString());
    }
    $this->smarty->clear_cache($this->mailTemplate);
    $mailBody = $this->smarty->fetch($this->mailTemplate);
    // メール送信
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

// *****************************************＃
?>
