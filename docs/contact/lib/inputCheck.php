<?php

class inputCheck{
	// ■ 必須チェック
	//
	function nullCheck( $data ) {
		if( strlen($data)==0 ) {
			return True;
		}

		return False;
	}
	
	// ■ 最大入力文字数チェック
	//
	function maxCheck( $data, $max ) {
		if( $max < mb_strlen($data,"utf-8") ) {
			return True;
		}

		return False;
	}
	
	/*
	function maxCheck_mb( $data, $max ){
		if( $max < (mb_strlen($data),"utf-8") ) {
			return True;
		}
		return False;
	}
	*/
	// ■ URL チェック
	//
	function URLCheck( $data ) {
		
		// URL 形式チェックを行う
		if( ereg( "^(http|https):\/\/([a-zA-Z0-9]|\.|\-|_|/|\?|=|~|%|&)+$",$data ) == False ) {
			return True;
		}

		return False;
	}
	
	// ■ メールアドレスチェック
	//
	function mailCheck( $data ) {

		// 全角文字は使用禁止とする
		if( ereg( "[^\x21-\x7E]", $data ) ) {
			return True;
		}

		// 英大文字は使用禁止とする
		if( ereg( "[A-Z]", $data ) ) {
			return True;
		}

		// メールアドレス形式チェックを行う
		if( ereg("^[^@]+@[^.]+\..+",  $data ) == False ) {
			return True;
		}

		// メールアドレス禁止文字チェックを行う
		if( ereg( "[\(\)<>,;:\\\"]", $data ) ) {
			return True;
		}

		return False;
	}
	
	// ■ 電話番号チェック
	//
	function telCheck( $data1,$data2,$data3 ) {
	
		if( ereg( "0[0-9]{1,5}" , $data1 )==false ) {
			return True;
		}
		if( ereg( "[0-9]{1,5}" , $data2 )==false ) {
			return True;
		}
		if( ereg( "[0-9]{1,5}" , $data3 )==false ) {
			return True;
		}

		return False;
	}
	
	//半角カナチェック
	function isHankakuKatakana($value){
		mb_regex_encoding("UTF-8");
		if(mb_ereg("[ｱ-ﾝﾞﾟ]", $value)){
			return true;
		}
		
		return false;

	}
	
	//機種依存文字チェック
	function isUnsupportedCharacter($value){
		
		mb_regex_encoding("UTF-8");
		
		//cf1-http://memo.xight.org/2006-06-19-13
		//cf2-http://www.d-toybox.com/studio/lib/romanNumerals.html
		if(mb_ereg("[\xE2\x84\x80-\xE2\x84\xB8]|[\xE2\x85\x93-\xE2\x85\xBF]|[\xE2\x86\x80-\xE2\x86\x82]|[\xE2\x86\x90-\xE2\x93\xAF]|[\xE2\x98\x80-\xE2\x99\xAF]|[\xE2\x91\xA0-\xE2\x93\xAF]|[\xE3\x88\xA0-\xE3\x8F\xBE]", $value)){
			return true;
		}
		return false;

	}

	/*
	function telCheckOld( $data1,$data2,$data3 ) {
		$data=$data1.$data2.$data3;
		
		$check1=new inputCheck();
		if( $check1->nullCheck( $data1 ) || $check1->hnumCheck( $data1 ) || strlen($data1)<2 ) {
			return True;
		}
		if( $check1->nullCheck( $data2 ) || $check1->hnumCheck( $data1 ) || 4<strlen($data2) ) {
			return True;
		}
		if( $check1->nullCheck( $data3 ) || $check1->hnumCheck( $data1 ) || 4<strlen($data3) ) {
			return True;
		}

		return False;
	}
	
	// ■ 半角数字チェック
	//
	function hnumCheck( $data ) {
		if( ereg( "[0-9]+", $data ) == False ) {
			return True;
		}

		return False;
	}
	
	// ■ 数字チェック
	//
	function AsciiCheck( $data ) {
		if( ereg( "^[\x30-\x39]+$", $data ) == False ) {
			return True;
		}

		return False;
	}
	*/
}
?>