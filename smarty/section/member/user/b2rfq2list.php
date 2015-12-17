<?php
if(!isset($rfq2Obj)) {
   include_once(SITE_CLASS_APPLICATION."user/class.RFQ2Master.php");
   $rfq2Obj = new RFQ2Master();
}
$status = GetVar('id');
$msg = GetVar('msg');
$sts = "";
if($msg == 'isu' || $msg == 'acpt') {
   $sts = $msg;
}
if($msg == "rfq2count") {
   $sts = $msg;
   $auctionstatus =$status;
   $msg = '';
}
$rfq2type = $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_rfq2_master", "eAuctionType","eAuctionType", "eAuctionType","","","class='form-control' ","Select RFQ2 Type","---Select---");
$bidcriteria = $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_rfq2_master", "eBidCriteria","eBidCriteria", "eBidCriteria","","","class='form-control' ","Select Bid Criteria","---Select---");
$smarty->assign('sts',$sts);
$smarty->assign('auctionstatus',$auctionstatus);
$smarty->assign('status',$status);
$smarty->assign('rfq2type',$rfq2type);
$smarty->assign('bidcriteria',$bidcriteria);
?>