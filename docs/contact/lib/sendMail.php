<?php
class sendMail{
	
	function send( $id ){
		
		mb_internal_encoding("UTF-8");
		mb_language("japanese");
		
		if($_SERVER["REQUEST_METHOD"]=="POST"){
			foreach($_POST as $k => $v){
				if(get_magic_quotes_gpc()){
					$v = stripslashes($v);
				}
				$v = htmlspecialchars($v);
				$$k = $v;
			}
		}else{
		
			exit;
		}
		
		//送信先区分
		if($id=="pm"){
			$form="メディアパートナ様フォーム";
			$to="info@fringe81.com";
		}elseif($id=="am1"){
			$form="広告主/代理店様フォーム";
			if(isset($radiobutton)){
				if($radiobutton=="radiobutton"){
					// 広告主様
					$to="info@fringe81.com";
				}elseif($radiobutton=="radiobutton2"){
					// 代理店様
					$to="info@fringe81.com";
				}else{
					// その他はとりあえず「adsales@fringe81.com」
					$to="info@fringe81.com";
				}
			}
		}else{
			echo "<h1>ID:$id</h1>";
			exit;
		}
		
		$title="$form よりお問い合わせがありました。";
		
		//送信先判別
		if(isset($radiobutton)){
			if($radiobutton=="radiobutton"){
				$radio="広告主様";
			}elseif($radiobutton=="radiobutton2"){
				$radio="広告代理店様";
			}
		}
		/*
		echo "<pre>";
		var_dump($_POST);
		var_dump("radio：".$radio);
		echo "</pre>";
		/*/
		
		$naiyou ="\n$title\n\n";
		if(isset($radio)){$naiyou .="■お問い合わせ区分\n$radio\n\n";}
		$naiyou .="■社名\n$company\n\n";
		$naiyou .="■URL\n$url1\n\n";
		$naiyou .="■担当者名\n$name\n\n";
		$naiyou .="■メールアドレス\n$email\n\n";
		$naiyou .="■電話番号\n$phoneNumber1-$phoneNumber2-$phoneNumber3\n\n";
		$naiyou .="■問い合わせ内容\n$textfield\n";
		//テストメール送信先
		
		//return true;
		//$to="nishino@netage.co.jp";
		//$to="mitsuhashi@netage.co.jp";
		
		$From=$email;
		
		
		//*
		if (mb_send_mail($to, $title, $naiyou, "From:$From")){
			return true;
		}else{
			return false;
		}
		//*/
	}
}
?>