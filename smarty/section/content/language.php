<?php
//get code variable /or changed language
$code 	= PostVar('lang_code');

//change language session variables
$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG'] = $code;

//include language file
includeLang($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG']);
//Prints($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG']);exit;

//redirect to that page
header("Location:".$_SERVER["HTTP_REFERER"]."");
exit();
?>