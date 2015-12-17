<?php
include(S_SECTIONS."/member/memberaccess.php");
$invStatus=$_GET['id'];
$_SESSION['invlvl'] = $invStatus;
$msg = (isset($_REQUEST['msg']))? $_REQUEST['msg'] : '';
$invsts = '';
if($msg == 'isu' || $msg == 'acpt') {
   $invsts = $msg;
}

$msg = (isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']))? $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG'] : '';
unset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']);
if($msg == 'ras') {
     $msg = $smarty->get_template_vars('MSG_ADD_SUCC');
} elseif($msg == 'raserr') {
     $msg = $smarty->get_template_vars('MSG_ADD_ERR');
} elseif($msg == 'rus') {
   $msg = $smarty->get_template_vars('MSG_UPDATE_SUCC');
} elseif($msg == 'ruserr') {
   $msg = $smarty->get_template_vars('MSG_UPDATE_ERR');
} else if($msg == 'invc') {
	$msg = $smarty->get_template_vars('MSG_INVOICE_CREATED');
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
if($invStatus == $rejectStatusID) {
	$deletepo='Yes';
}
if($uorg_type=='Buyer') {
	// echo $uorg_type; exit;
	if(!isset($orgUserObj)) {
		include_once(SITE_CLASS_APPLICATION."user/class.OrganizationUser.php");
		$orgUserObj =	new OrganizationUser();
	}
	$invCreate = $orgUserObj->hasBuyerInvPermit($sess_id);
	$smarty->assign('invCreate',$invCreate);
}
// echo $curORGID;
$smarty->assign('deletepo',$deletepo);
$smarty->assign('msg',$msg);
$smarty->assign('invsts',$invsts);
$smarty->assign('invStatus',$invStatus);
?>