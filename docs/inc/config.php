<?php
require_once "/usr/share/pear/PEAR/Config.php";

$config = parse_ini_file("/usr/local/corp/conf/corpConfig.ini");

#$conf = new MyConfig();
#$config = $conf->confArr;

//キャッシュフォルダの設定（パーミッション：７７７)
define("DIR_CASH", $config['cache']);
define("DIR_ROOT", $config['dir_root']);
define("DOC_ROOT", $config['doc_root']);

define("DIR_PHP", DIR_ROOT.'php/');		
define("DIR_INC", DIR_ROOT.'inc/');		
define("DIR_LIB", DIR_ROOT.'lib/');		
define("DIR_CLS", DIR_ROOT.'class/');	

require_once "/usr/local/lib/php/Smarty/libs/Smarty.class.php";

$db_host	= $config['host'];	//DBサーバ
$db_user	= $config['user'];		//DBユーザー
$db_passwd	= $config['passwd'];		//パスワード
$db_name	= $config['database'];		//使用DB
$db = mysql_connect($db_host,$db_user,$db_passwd);
mysql_select_db($db_name,$db);

mysql_query("SET NAMES utf8");

mb_regex_encoding('UTF-8');
mb_internal_encoding('UTF-8');
mb_language('Ja');


function output_filter($buff, &$smarty)
{
    if (function_exists("mb_convert_encoding")) {
        $enc = mb_detect_encoding($buff);
        if ($enc != "UTF-8") {
            return mb_convert_encoding($buff, "UTF-8", $enc);
        }
    }
    return $buff;
}


mb_http_input("UTF-8");
mb_internal_encoding("UTF-8");
mb_http_output("UTF-8");

?>