<?php
if(isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MAIL_FILE']) && is_array($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MAIL_FILE']) && count($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MAIL_FILE']) >0) {
	$carg = @ implode(',', $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MAIL_FILE']);
	@ exec($php_exec.' '.S_SECTIONS.'/member/csendmail.php '.SITE_URL.' '.$carg.' >> '.SPATH_ROOT.'/tmp/ml.lg 2>&1 &');
	$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MAIL_FILE'] = array();
}
?>