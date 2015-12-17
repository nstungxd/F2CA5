<?php
// include_once(S_SECTIONS."/member/memberaccess.php");
// $msg = GetVar('msg');
unset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']);
$msg = '';
if(isset($_SESSION[PRJ_CONST_PREFIX.'_action_msg']) && trim($_SESSION[PRJ_CONST_PREFIX.'_action_msg'])!='') {
   $msg = $_SESSION[PRJ_CONST_PREFIX.'_action_msg'];
   unset($_SESSION[PRJ_CONST_PREFIX.'_action_msg']);
}

if($msg == 'ras') {
   $msg = $smarty->get_template_vars('MSG_ADD_SUCC');
} elseif($msg == 'aerr') {
   $msg = $smarty->get_template_vars('MSG_ADD_ERR');
} elseif($msg == 'rus') {
   $msg = $smarty->get_template_vars('MSG_UPDATE_SUCC');
} elseif($msg == 'uerr') {
   $msg = $smarty->get_template_vars('MSG_UPDATE_ERR');
} elseif($msg == 'rvs') {
   $msg = $smarty->get_template_vars('MSG_VERIFY_SUCC');
} elseif($msg == 'verr') {
   $msg = $smarty->get_template_vars('MSG_VERIFY_ERR');
} elseif($msg == 'rds') {
   $msg = $smarty->get_template_vars('MSG_DEL_SUCC');
} elseif($msg == 'derr') {
   $msg = $smarty->get_template_vars('MSG_DEL_ERR');
} elseif($msg == 'rss') {
   $msg = $smarty->get_template_vars('MSG_STATUS_SUCC');
} elseif($msg == 'rserr') {
   $msg = $smarty->get_template_vars('MSG_STATUS_ERR');
} elseif($msg == 'rnme') {
   $msg = $smarty->get_template_vars('LBL_RECORD_DOES_NOT_EXISTS');
} else {
   $msg='';
}

if($msgf[0]  == 'rasdup') {
   $msg = $msgf[1]." ".$smarty->get_template_vars('MSG_DUPLICATE_RECORD_NOT_INSERTED');
}

$srchval =(isset($_POST['srchval']))? $_POST['srchval'] : '';

$smarty->assign('srchval',$srchval);
$smarty->assign('msg',$msg);
?>