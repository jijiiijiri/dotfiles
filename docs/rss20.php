<?php
/**
*/

include("./inc/config.php");
include("./inc/new_inc.php");

$Year_flag = 1;
$n = 0;
$sql = "SELECT * FROM  T_item WHERE T_item.flag_id = 2 ORDER BY T_item.datetime DESC";
$rst = mysql_query($sql);

$rows=array();
while($row=mysql_fetch_array($rst)){
	$desc=Array();
	mb_ereg(".+?</p>",$row['body'],$desc);
	$rows[]=Array("id"=>$row['id'],"title"=>$row['title'],"desc"=>$desc[0],"datetime"=>$row['datetime']);
}

$skin_file	= "rss20.tpl";
$Sm->assign("doc_root",DOC_ROOT);
$Sm->assign("rows",$rows);
$Sm->register_outputfilter("output_filter");
$Sm->display($skin_file);


?>
