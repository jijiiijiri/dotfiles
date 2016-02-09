<?php
class inputQuery{

	var $lib = "";
	
	function inputQuery(){
		$lib = "";
		$this->lib="lib/";
		require_once($lib."inputCheck.php");
	}
	
	function defOtoiawase(){
		$res='<input name="radiobutton" type="radio" value="radiobutton" />
		      広告主様&nbsp;
		      <input name="radiobutton" type="radio" value="radiobutton2" />
			  広告代理店様';
	  	return $res;
	}
	
	function resOtoiawase($data){
		$iQ=new inputQuery();
		if($data=="radiobutton2"){
			$res[1]='<input name="radiobutton" type="radio" value="radiobutton" />
		      広告主様&nbsp;
		      <input name="radiobutton" type="radio" value="radiobutton2" checked="checked" />
			  広告代理店様';
		}elseif($data == "radiobutton"){
			$res[1]='<input name="radiobutton" type="radio" value="radiobutton" checked="checked" />
		      広告主様&nbsp;
		      <input name="radiobutton" type="radio" value="radiobutton2" />
			  広告代理店様';
		}else{
			$res[1] = $iQ->defOtoiawase();
			$res[1].= '<span class="error">[×入力してください]</span>';
			$res[0]=1;
	  	}
	  	
		return $res;
	}
	
	function defCompany($data){
		$res='<input name="company" type="text" size="32" maxlength="128" />';
		return $res;
	}
	
	function checkCompany($data){
	  
	  $check=new inputCheck();
	  
	  $err=0;
	  //入力チェック:company
	  $valcheck1 = "";
	  
	  if($check->nullCheck($data)){
	  	$valcheck1="null";
		$err=1;
	  }elseif($check->maxCheck($data,128)){
	  	$valcheck1="miss";
		$err=1;
	  }
	  
	  if($check->isHankakuKatakana($data) || $check->isUnsupportedCharacter($data)){
	  	$valcheck1="un";
		$err=1;
	  }
	  $res[0]=$err;
	  
	  if($valcheck1=="null"){
	  	$companyHTML= '<input name="company" type="text" size="32" maxlength="128" />';
	  	$companyHTML.= '<span class="error">[×入力してください]</span>';
	  }elseif($valcheck1=="miss"){
	  	$companyHTML= '<input name="company" type="text" size="32" maxlength="128" value="'.$data.'" />';
	  	$companyHTML.= '<span class="error">[×文字数制限をこえています]</span>';
	  }elseif($valcheck1=="un"){
	  	$companyHTML= '<input name="company" type="text" size="32" maxlength="128" value="'.$data.'" />';
	  	$companyHTML.= '<br /><span class="error">[×使用できない文字が含まれています]</span>';
	  }else{
	  	$companyHTML= '<input name="company" type="text" size="32" maxlength="128" value="'.$data.'" />';
	  }
	  $res[1]=$companyHTML;
	  
	  return $res;
	}
	
	function defURL($data){
		$res='<input name="url1" type="text" size="32" maxlength="255" />';
		return $res;
	}
	
	function checkURL($data){
	  $valcheck2 = "";
	  
	  
	  $check=new inputCheck();
	  
	  //入力チェックurl1
	  $err=0;
	  if($check->nullCheck($data)){
	  	$valcheck2="null";
		$err=1;
	  }elseif($check->URLCheck($data) || $check->maxCheck($data,255)){
	  	$valcheck2="miss";
		$err=1;
	  }
	  $res[0]=$err;
	  
	  if($valcheck2=="null"){
	  	$url1HTML= '<input name="url1" type="text" size="32" maxlength="255" />';
	  	$url1HTML.= '<span class="error">[×入力してください]</span>';
	  }elseif($valcheck2=="miss"){
	  	$url1HTML= '<input name="url1" type="text" size="32" maxlength="255" value="'.$data.'" />';
	  	$url1HTML.= '<span class="error">[×正しい形式で入力してください]</span>';
	  }else{
	  	$url1HTML= '<input name="url1" type="text" size="32" maxlength="255" value="'.$data.'" />';
	  }
	  $res[1]=$url1HTML;
	  return $res;
	}
	
	function defName($data){
		$res='<input name="name" type="text" size="32" maxlength="128" />';
		return $res;
	}
	
	function checkName($data){
	  $valcheck3 = "";
	  
	  $check=new inputCheck();
	  
	  $err=0;
	  //入力チェックname
	  if($check->nullCheck($data)){
	  	$valcheck3="null";
		$err=1;
	  }elseif($check->maxCheck( $data,128)){
	  	$valcheck3="miss";
		$err=1;
	  }
	  
	  if($check->isHankakuKatakana($data) || $check->isUnsupportedCharacter($data)){
	  	$valcheck3="un";
		$err=1;
	  }
	  
	  $res[0]=$err;
	  
	  if($valcheck3=="null"){
	  	$nameHTML= '<input name="name" type="text" size="32" maxlength="128" />';
	  	$nameHTML.= '<span class="error">[×入力してください]</span>';
	  }elseif($valcheck3=="miss"){
	  	$nameHTML= '<input name="name" type="text" size="32" maxlength="128" value="'.$data.'" />';
	  	$nameHTML.= '<span class="error">[×文字数制限をこえています]</span>';
	  }elseif($valcheck3=="un"){
	  	$nameHTML= '<input name="name" type="text" size="32" maxlength="128" value="'.$data.'" />';
	  	$nameHTML.= '<br /><span class="error">[×使用できない文字が含まれています]</span>';
	  }else{
	  	$nameHTML= '<input name="name" type="text" size="32" maxlength="128" value="'.$data.'" />';
	  }
	  $res[1]=$nameHTML;
	  return $res;
	}
	
	function defEmail($data){
		$res='<input name="email" type="text" size="32" maxlength="128" />';
		return $res;
	}
	
	function checkEmail($data){
	  $valcheck4 = "";
	  
	  $check=new inputCheck();
	  
	  $err=0;
	  //入力チェックemail
	  if($check->nullCheck($data)){
	  	$valcheck4="null";
		$err=1;
	  }elseif($check->mailCheck($data) || $check->maxCheck( $data,128)){
	  	$valcheck4="miss";
		$err=1;
	  }
	  $res[0]=$err;
	  
	  if($valcheck4=="null"){
	  	$emailHTML= '<input name="email" type="text" size="32" maxlength="128" />';
	  	$emailHTML.= '<span class="error">[×入力してください]</span>';
	  }elseif($valcheck4=="miss"){
	  	$emailHTML= '<input name="email" type="text" size="32" maxlength="128" value="'.$data.'" />';
	  	$emailHTML.= '<span class="error">[×正しい形式で入力してください]</span>';
	  }else{
	  	$emailHTML= '<input name="email" type="text" size="32" maxlength="128" value="'.$data.'" />';
	  }
	  $res[1]=$emailHTML;
	  return $res;
	}
	
	function defPhoneNumber($teldata1,$teldata2,$teldata3){
		$phoneNumberHTML= '<input name="phoneNumber1" type="text" id="phoneNumber1" size="5" maxlength="5" />';
      	$phoneNumberHTML.= '-';
		$phoneNumberHTML.= '<input name="phoneNumber2" type="text" id="phoneNumber2" size="5" maxlength="5" />';
		$phoneNumberHTML.= '-';
		$phoneNumberHTML.= '<input name="phoneNumber3" type="text" id="phoneNumber3" size="5" maxlength="5" />';
		return $phoneNumberHTML;
	}
	
	function checkPhoneNumber($teldata1,$teldata2,$teldata3){
	  $valchecktel = "";
	  
	  $check=new inputCheck();
	  
	  //入力チェックphoneNumber
	  $err=0;
	  if($check->nullCheck($teldata1) && $check->nullCheck($teldata2) && $check->nullCheck($teldata3)){
	  	$valchecktel="null";
		$err++;
	  }elseif($check->telCheck($teldata1,$teldata2,$teldata3)){
	  	$valchecktel="miss";
		$err++;
	  }
	  $res[0]=$err;
	  
	  if($valchecktel=="null"){
	  	$phoneNumberHTML= '<input name="phoneNumber1" type="text" id="phoneNumber1" size="5" maxlength="5" />';
      	$phoneNumberHTML.= '-';
		$phoneNumberHTML.= '<input name="phoneNumber2" type="text" id="phoneNumber2" size="5" maxlength="5" />';
		$phoneNumberHTML.= '-';
		$phoneNumberHTML.= '<input name="phoneNumber3" type="text" id="phoneNumber3" size="5" maxlength="5" />';
	  	$phoneNumberHTML.= '<span class="error">[×入力してください]</span>';
	  }elseif($valchecktel=="miss"){
	  	$phoneNumberHTML= '<input name="phoneNumber1" type="text" id="phoneNumber1" size="5" maxlength="5" value="'.$teldata1.'"/>';
      	$phoneNumberHTML.= '-';
		$phoneNumberHTML.= '<input name="phoneNumber2" type="text" id="phoneNumber2" size="5" maxlength="5" value="'.$teldata2.'"/>';
		$phoneNumberHTML.= '-';
		$phoneNumberHTML.= '<input name="phoneNumber3" type="text" id="phoneNumber3" size="5" maxlength="5" value="'.$teldata3.'"/>';
	  	$phoneNumberHTML.= '<span class="error">[×正しい形式で入力してください]</span>';
	  }else{
	  	$phoneNumberHTML= '<input name="phoneNumber1" type="text" id="phoneNumber1" size="5" maxlength="5" value="'.$teldata1.'"/>';
      	$phoneNumberHTML.= '-';
		$phoneNumberHTML.= '<input name="phoneNumber2" type="text" id="phoneNumber2" size="5" maxlength="5" value="'.$teldata2.'"/>';
		$phoneNumberHTML.= '-';
		$phoneNumberHTML.= '<input name="phoneNumber3" type="text" id="phoneNumber3" size="5" maxlength="5" value="'.$teldata3.'"/>';
	  }
	  $res[1]=$phoneNumberHTML;
	  return $res;
	}
	
	function defTextField($data){
		$res='<textarea name="textfield" cols="32" rows="10"></textarea>';
		return $res;
	}
	
	function checkTextField($data){
	  $err = "";
	  $valcheck5 = "";
	  
	  $check=new inputCheck();
	  
	  //入力チェックtextfield
	  if($check->nullCheck($data)){
	  	$valcheck5="null";
		$err=1;
	  }elseif($check->isHankakuKatakana($data) || $check->isUnsupportedCharacter($data)){
	  	$valcheck5="un";
		$err=1;
	  }
	  $res[0]=$err;
	  
	  if($valcheck5=="null"){
	  	$textfieldHTML= '<textarea name="textfield" cols="32" rows="10"></textarea><br />';
	  	$textfieldHTML.= '<span class="error">[×入力してください]</span>';
	  }elseif($valcheck5=="un"){
	  	$textfieldHTML= '<textarea name="textfield" cols="32" rows="10">'.$data.'</textarea><br />';
	  	$textfieldHTML.= '<br /><span class="error">[×使用できない文字が含まれています]</span>';
	  }else{
	  	$textfieldHTML= '<textarea name="textfield" cols="32" rows="10">'.$data.'</textarea>';
	  }
	  $res[1]=$textfieldHTML;
	  return $res;
	}
}
?>