<?php
$val = PostVar('val');
if(trim($val)!='') {
	if(!isset($gencaptchaObj)) {
		include_once(SITE_CLASS_GEN."class.gencaptcha.php");
		$gencaptchaObj =	new gencaptcha();
	}
	if($gencaptchaObj->chkcaptcha($val)) {
		echo 'true';
	} else {
		echo 'false';
	}
} else {
	echo 'false';
}
exit;
?>