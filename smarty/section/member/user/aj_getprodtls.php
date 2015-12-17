<?php
$iProductId = PostVar('iProductId');
$fld = PostVar('fld');
$ipids = preg_replace('/\w-/','',$iProductId);
$pt = preg_replace('/-\d/','',$iProductId);
$fld = (trim($fld)!='')? $fld : 'tDescription';
// pr($_POST); exit;
if(trim($ipids)!='' && $ipids>0) {
	$dtls = array();
	if(strtolower(trim($pt))=='b') {
		$sql = "SELECT $fld FROM ".PRJ_DB_PREFIX."_bproduct_organization where iProductId=$ipids";
		$dtls = $dbobj->MySQLSelect($sql);
	} else if(strtolower(trim($pt))=='b') {
		$sql = "SELECT $fld FROM ".PRJ_DB_PREFIX."_sproduct_organization where iProductId=$ipids";
		$dtls = $dbobj->MySQLSelect($sql);
	}
	if(isset($dtls[0][$fld]) && count($fld)>0) {
		echo $dtls[0][$fld];
	}
} else {
	echo '';
}
exit;
?>