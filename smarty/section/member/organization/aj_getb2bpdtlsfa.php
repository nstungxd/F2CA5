<?php
if(!isset($b2bpaObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.Buyer2_BProduct_Association.php");
	$b2bpaObj = new Buyer2_BProduct_Association();
}
$b2orgid = PostVar('b2orgid');
$prdtid = PostVar('prdtid');
$flds = PostVar('flds');
$dtls = $b2bpaObj->getDetails("$flds"," AND iProductId=$prdtid AND iBuyer2Id=$b2orgid ");
$txt = array();
if(is_array($dtls) && count($dtls)>0) {
	foreach($dtls[0] as $ky => $vl) {
		$txt[] .= $vl;
	}
}
if(is_array($txt) && count($txt)>0) {
	echo implode('|,|',$txt);
}
exit;
?>