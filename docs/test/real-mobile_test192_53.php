<html>
<body>
<h1>mobile test 192_53</h1>
<?php
$IOGOUS_ADV = 'ctbNiEPO4PgH';
$IOGOUS_ADU ='eRPG5zCaEDbK';
$IOGOUS_ADS = '1';
$IOGOUS_ADSZ = '8';
if ($_SERVER['HTTP_X_DCMGUID']) $UID = $_SERVER['HTTP_X_DCMGUID'];
if ($_SERVER['HTTP_X_UP_SUBNO']) $UID = $_SERVER['HTTP_X_UP_SUBNO'];
if ($_SERVER['HTTP_X_JPHONE_UID']) $UID = $_SERVER['HTTP_X_JPHONE_UID'];
$GLOBALS['IOGOUS']['UA'] = $_SERVER['HTTP_USER_AGENT'];
$GLOBALS['IOGOUS']['IP'] = $_SERVER['REMOTE_ADDR'];
$GLOBALS['IOGOUS']['TYPE'] = 'X';
$GLOBALS['IOGOUS']['PLANG'] = 'PHP';
if ($UID) {
	$GLOBALS['IOGOUS']['UID'] = $UID;
}
function iogous_get_ad_url($adv,$adu,$ads,$adsize) {
	$iogous_ad_url = "http://feemo.rssad.jp/mb/msh/ADV=" . $adv . "/ADU=" . $adu . "/ADS=" . $ads . "/ADSZ=" . $adsize . "?";
	foreach ($GLOBALS['IOGOUS'] as $key => $value) {
		$iogous_ad_url .= "&" . $key . "=" . urlencode($value);
	}
	return $iogous_ad_url;
}
$iogous_ad_handle = fopen(iogous_get_ad_url($IOGOUS_ADV, $IOGOUS_ADU, $IOGOUS_ADS, $IOGOUS_ADSZ), "r");
if ($iogous_ad_handle) {
while (!feof($iogous_ad_handle)) {
	echo fread($iogous_ad_handle, 8192);
}
fclose($iogous_ad_handle);
}
?>
</body>
</html>