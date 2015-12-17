<?php
$iAwardId = GetVar('id');
if(!isset($rfq2awObj)) {
   include_once(SITE_CLASS_APPLICATION."user/class.Rfq2Award.php");
	$rfq2awObj = new Rfq2Award();
}

$dtls = $rfq2awObj->select($iAwardId);
$hdtls = $rfq2awObj->getHistory($iAwardId,$curORGID);
// pr($hdtls); exit;
$smarty->assign('dtls',$dtls);
$smarty->assign('hdtls',$hdtls);
?>