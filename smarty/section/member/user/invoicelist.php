<?php
include(S_SECTIONS."/member/memberaccess.php");
$invStatus = (isset($_GET['id']))? $_GET['id'] : '';
$_SESSION['invlvl'] = $invStatus;
$msg = (isset($_REQUEST['msg']))? $_REQUEST['msg']: '';
//prints($_SESSION);
//print $reqVerification ;
$msg = (isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']))? $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG'] : '';
unset ($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']);
$invsts = "";
if($msg == 'isu' || $msg == 'acpt') {
   $invsts = $msg;
}

if($msg == 'ras') {
   $msg = $smarty->get_template_vars('MSG_ADD_SUCC');
} elseif($msg == 'raserr') {
   $msg = $smarty->get_template_vars('MSG_ADD_ERR');
} elseif($msg == 'rus') {
   $msg = $smarty->get_template_vars('MSG_UPDATE_SUCC');
} elseif($msg == 'ruserr') {
   $msg = $smarty->get_template_vars('MSG_UPDATE_ERR');
} elseif($msg == 'rds'){
   $msg = $smarty->get_template_vars('MSG_INVOICE_DELETED_SUCC');
} else {
	$msg = '';
}

if(!isset($statusmasterObj)) {
   include_once(SITE_CLASS_APPLICATION."class.StatusMaster.php");
   $statusmasterObj =	new StatusMaster();
}
$rejectStatusID=$statusmasterObj->getDetails('iStatusID',' AND vStatus_en="Rejected" AND eFor="Invoice"');
$rejectStatusID=$rejectStatusID[0]['iStatusID'];
$deletepo = "";
if($invStatus == $rejectStatusID)
{
	$deletepo='Yes';
}
$smarty->assign('deletepo',$deletepo);
$smarty->assign('msg',$msg);
$smarty->assign('invsts',$invsts);
$smarty->assign('invStatus',$invStatus);
?>