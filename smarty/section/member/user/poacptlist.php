<?php
include(S_SECTIONS."/member/memberaccess.php");
$msg = (isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']))? $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG'] : '';
unset ($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']);
if($msg == 'ras') {
   $msg = $smarty->get_template_vars('MSG_ADD_SUCC');
} elseif($msg == 'raserr') {
	$msg = $smarty->get_template_vars('MSG_ADD_ERR');
} elseif($msg == 'rus') {
   $msg = $smarty->get_template_vars('MSG_UPDATE_SUCC');
} elseif($msg == 'ruserr') {
   $msg = $smarty->get_template_vars('MSG_UPDATE_ERR');
} else if($msg == 'pocr') {
	$msg = $smarty->get_template_vars('MSG_PO_CREATED');
} else {
	$msg = '';
}

if(!isset($statusmasterObj)) {
   include_once(SITE_CLASS_APPLICATION."class.StatusMaster.php");
   $statusmasterObj =	new StatusMaster();
}
$poStatus=$_GET['id'];
$_SESSION['polvl'] = $poStatus;
$rejectStatusID=$statusmasterObj->getDetails('iStatusID',' AND vStatus_en="Rejected" AND eFor="PO"');
$rejectStatusID=$rejectStatusID[0]['iStatusID'];
$deletepo = '';
if($poStatus == $rejectStatusID) {
   $deletepo='Yes';
}

$smarty->assign('deletepo',$deletepo);
$smarty->assign('poStatus',$poStatus);
$smarty->assign("msg",$msg);
?>