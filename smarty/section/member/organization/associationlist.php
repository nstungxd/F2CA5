<?php
include(S_SECTIONS."/member/memberaccess.php");

$msg = GetVar('msg');
//$msg =(isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']))? $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG'] : '';
unset ($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']);

$msgf = @explode("-",$msg);

if($msg == 'ras') {
     $msg = $smarty->get_template_vars('MSG_ADD_SUCC');
} elseif($msg == 'raserr') {
     $msg = $smarty->get_template_vars('MSG_ADD_ERR');
} elseif($msg == 'rus') {
   $msg = $smarty->get_template_vars('MSG_UPDATE_SUCC');
} elseif($msg == 'ruserr') {
   $msg = $smarty->get_template_vars('MSG_UPDATE_ERR');
} elseif($msg == 'rvs') {
   $msg = $smarty->get_template_vars('MSG_VERIFY_SUCC');
} elseif($msg == 'rvserr') {
   $msg = $smarty->get_template_vars('MSG_VERIFY_ERR');
} elseif($msg == 'rds') {
   $msg = $smarty->get_template_vars('MSG_DEL_SUCC');
} elseif($msg == 'rdserr') {
   $msg = $smarty->get_template_vars('MSG_DEL_ERR');
} elseif($msg == 'rss') {
   $msg = $smarty->get_template_vars('MSG_STATUS_SUCC');
} elseif($msg == 'rsserr') {
   $msg = $smarty->get_template_vars('MSG_STATUS_ERR');
}else{
   $msg='';
}

if($msgf[0]  == 'rasdup'){
    $msg = $msgf[1]." ".$smarty->get_template_vars('MSG_DUPLICATE_RECORD_NOT_INSERTED');
}

$srchval =(isset($_POST['srchval']))? $_POST['srchval'] : '';

$smarty->assign('srchval',$srchval);
$smarty->assign('msg',$msg);
?>