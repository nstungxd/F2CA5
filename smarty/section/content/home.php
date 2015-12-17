<?php
$msg = (isset($_GET['msg']))? $_GET['msg'] : '';
$staticarr_left = $stPageObj->getStaticPageDetail("*","AND vFile = 'Home'");
if($msg=='sotp') {
	$msg = $smarty->get_template_vars('LBL_ALSO_LOGIN_FROM_OTHER_PLACE');
} else if($msg == 'oregs') {
	$msg = $smarty->get_template_vars('LBL_ORGANIZATION_REGISTRATION_SUCCESS'). '. ' . $smarty->get_template_vars('LBL_ACCOUNT_IS_INACTIVE_AND_WILL_BE_ACTIVATED_ON_APPROVAL').''; 	// LBL_WILL_RECEIVE_ACTIVATION_EMAIL
} else if($msg == 'ina') {
	$msg = $smarty->get_template_vars('LBL_ACCOUNT_NOT_ACTIVE_OR_MODIFIED');
} else {
	$msg = '';
}
// require_once(SITE_CLASS_APPLICATION."class.member.php");
// $memobj = new Member();
// $member = $memobj->checkauthentication('HBPHPUSER',$gdbobj->encrypt('HBPHPUSER'),'orguser',PRJ_DB_PREFIX.'_organization_user','iUserID','hbphp');
// pr($member); exit;
$smarty->assign("gobj",$gdbobj);
$smarty->assign("topwelcometext",$staticarr_top[0]['tContent_'.LANG]);
$smarty->assign("homecontent",$staticarr_left[0]['tContent_'.LANG]);
$smarty->assign("msg",$msg);
?>