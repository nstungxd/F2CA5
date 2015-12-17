<?php
$status = GetVar('id');
$msg = GetVar('msg');
$sts = "";
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
} else {
   /*if(is_int($msg)) {
      $sts = $msg;
   }*/
   $msg = '';
}
$rfq2type = $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_rfq2_master", "eAuctionType","eAuctionType", "eAuctionType","","","class='form-control' ","Select RFQ2 Type","---Select---");
$bidcriteria = $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_rfq2_master", "eBidCriteria","eBidCriteria", "eBidCriteria","","","class='form-control' ","Select Bid Criteria","---Select---");
$smarty->assign('sts',$sts);
$smarty->assign('status',$status);
$smarty->assign('rfq2type',$rfq2type);
$smarty->assign('bidcriteria',$bidcriteria);
?>