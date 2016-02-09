<?php
class confirmQuery{

	function dispRadio($data){
		if($data=="radiobutton"){
			$radio="広告主様";
		}else{
			$radio="広告代理店様";
		}
		return $radio;
	}
	
	function dispCompany($data){
		$res=htmlspecialchars($data);
		return $res;
	}
	
	function dispURL($data){
		$res=htmlspecialchars($data);
		return $res;
	}
	
	function dispName($data){
		$res=htmlspecialchars($data);
		return $res;
	}
	
	function dispEmail($data){
		$res=htmlspecialchars($data);
		return $res;
	}
	
	function dispPhoneNumber($phoneNumber1,$phoneNumber2,$phoneNumber3){
		$res=$phoneNumber1.'-'.$phoneNumber2.'-'.$phoneNumber3;
		return $res;
	}
	
	function dispTextfield($data){
		$res='<pre>'.htmlspecialchars($data).'</pre>';
		return $res;
	}
	
}
?>