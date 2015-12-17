<?php
if(!isset($gencaptchaObj)) {
	include_once(SITE_CLASS_GEN."class.gencaptcha.php");
	$gencaptchaObj =	new gencaptcha();
}
$gencaptchaObj->getcaptcha();
?>