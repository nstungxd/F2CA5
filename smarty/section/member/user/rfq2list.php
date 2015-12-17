<?php
if(!isset($rfq2Obj)) {
   include_once(SITE_CLASS_APPLICATION."user/class.RFQ2Master.php");
   $rfq2Obj = new RFQ2Master();
}
if(!isset($orgUserPermObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.OrganizationUserPermission.php");
	$orgUserPermObj =	new OrganizationUserPermission();
}

$status = GetVar('id');

$msg = GetVar('msg');
$sts = "";
if($msg == 'rfq2count') {
   $msgrfq2 = 'rfq2count';
   $stsrfq2 =$status;
   
}
if($msg == 'ras') {
   $msg = $smarty->get_template_vars('MSG_ADD_SUCC');
} elseif($msg == 'raer') {
   $msg = $smarty->get_template_vars('MSG_ADD_ERR');
} elseif($msg == 'res') {
   $msg = $smarty->get_template_vars('MSG_UPDATE_SUCC');
} elseif($msg == 'reer') {
   $msg = $smarty->get_template_vars('MSG_UPDATE_ERR');
} elseif($msg == 'rvs') {
   $msg = $smarty->get_template_vars('MSG_VERIFY_SUCC');
} elseif($msg == 'rver') {
   $msg = $smarty->get_template_vars('MSG_VERIFY_ERR');
} elseif($msg == 'rrs') {
   $msg = $smarty->get_template_vars('MSG_REJECTED_SUCC');
} elseif($msg == 'rrer') {
   $msg = $smarty->get_template_vars('MSG_REJECTED_ERR');
} elseif($msg == 'rcs') {
   $msg = $smarty->get_template_vars('MSG_CANCELLED_SUCC');
} elseif($msg == 'rcer') {
   $msg = $smarty->get_template_vars('MSG_CANCELLED_ERR');
}

else {
   if(is_int($msg)) {
      $sts = $msg;
   }
   $msg = '';
}
if($sess_usertype_short=='OU' && $uorg_type!='Buyer2' && $uorg_type!='SM') {
   $ur2p = $orgUserPermObj->getUserR2Permits($sess_id,'%,RFQ2 Award,%','vRFQ2Permits');
   $smarty->assign('ur2p',$ur2p);
}
$rfq2type = $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_rfq2_master", "eAuctionType","eAuctionType", "eAuctionType","","","class='form-control' ","Select RFQ2 Type","---Select---");
$bidcriteria = $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_rfq2_master", "eBidCriteria","eBidCriteria", "eBidCriteria","","","class='form-control' ","Select Bid Criteria","---Select---");
$smarty->assign('sts',$sts);
$smarty->assign('msg',$msg);
$smarty->assign('status',$status);
$smarty->assign('rfq2type',$rfq2type);
$smarty->assign('bidcriteria',$bidcriteria);
$smarty->assign('msgrfq2',$msgrfq2);
$smarty->assign('stsrfq2',$stsrfq2);
?>