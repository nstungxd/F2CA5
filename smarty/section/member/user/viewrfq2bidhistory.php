<?php
$iBidId = GetVar('id');
if(!isset($r2bdObj)) {
   include_once(SITE_CLASS_APPLICATION."user/class.Rfq2Bids.php");
	$r2bdObj = new Rfq2Bids();
}

$bdtls = $r2bdObj->select($iBidId);
$hdtls = $r2bdObj->getHistory($iBidId);

$smarty->assign('bdtls',$bdtls);
$smarty->assign('hdtls',$hdtls);
?>