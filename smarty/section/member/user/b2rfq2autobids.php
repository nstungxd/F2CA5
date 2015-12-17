<?php
$id = GetVar('id');
$msg = GetVar('msg');
if(!isset($autobidobj)) {
	include_once(SITE_CLASS_APPLICATION."user/"."class.AutoBids.php");
	$autobidobj = new AutoBids();
}
// $autobids = $autobidobj->getB2Rfq2AutoBids($id, $curORGID);
//prints($autobids);exit;
$smarty->assign('iRFQ2Id', $id);
$smarty->assign('msg', $msg);
// $smarty->assign('autobids', $autobids);
?>