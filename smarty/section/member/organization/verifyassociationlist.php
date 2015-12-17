<?php

include(S_SECTIONS."/member/memberaccess.php");

//$msg = GetVar('msg');
$msg =(isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']))? $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG'] : '';
unset ($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']);

if($msg == 'rvs') {
   $msg = $smarty->get_template_vars('MSG_VERIFY_SUCC');
} elseif($msg == 'rvserr') {
   $msg = $smarty->get_template_vars('MSG_VERIFY_ERR');
}else{
   $msg='';
}

$smarty->assign('msg',$msg);
?>