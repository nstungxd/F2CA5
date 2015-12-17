<?php
include(S_SECTIONS."/member/memberaccess.php");

if(!isset($rfq2Obj)) {
   include_once(SITE_CLASS_APPLICATION."user/class.RFQ2Master.php");
	$rfq2Obj = new RFQ2Master();
}

$id = GetVar('id');
$dtls = $rfq2Obj->select($id);
$hdtls = $rfq2Obj->getHistory($id, $curORGID);
// prints($hdtls); // exit;

$smarty->assign('dtls',$dtls);
$smarty->assign('hdtls',$hdtls);
?>