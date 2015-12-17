<?php
$orgcode = PostVar('orcode');
$unm = PostVar('unm');
$table = $PRJ_DB_PREFIX."security_manager";
$html = "";
if(trim($orgcode)!='') {
	$sql = "Select * from ".PRJ_DB_PREFIX."_organization_user usr LEFT JOIN ".PRJ_DB_PREFIX."_organization_master org on usr.iOrganizationID=org.iOrganizationID where usr.vUserName='$unm' AND org.vCompCode='$orgcode'";
} else {
	$sql = "Select * from ".PRJ_DB_PREFIX."_security_manager where vUserName='$unm'";
}
$dtls = $dbobj->MySQLSelect($sql);
if(isset($dtls[0]['vEmail']) && trim($dtls[0]['vEmail'])!='') {
	if(isset($dtls[0]['iSecretQuestion1ID']) && trim($dtls[0]['iSecretQuestion1ID'])!='' && $dtls[0]['iSecretQuestion1ID']>0) {
		$sql = "Select * from ".PRJ_DB_PREFIX."_sec_question where iQuestionId='".$dtls[0]['iSecretQuestion1ID']."'";
		$sdtls = $dbobj->MySQLSelect($sql);
	}
	/*// captcha
	if(!isset($gencaptchaObj)) {
		include_once(SITE_CLASS_GEN."class.gencaptcha.php");
		$gencaptchaObj =	new gencaptcha();
	}*/
	//	$cimg = $gencaptchaObj->getcaptcha();
	if(isset($sdtls[0]['vQuestion_'.LANG]) && trim($sdtls[0]['vQuestion_'.LANG])!='') {
		$question = $sdtls[0]['vQuestion_'.LANG];
		$html .= "<div id='sq' style=''>
						<div>
						<br/><span class='username' style=''>".$smarty->get_template_vars('LBL_SECURITY_QUESTION')." : </span>
						<div class='' style='display:inline-block; padding-left:1px; color:#737373; word-wrap:break-word; font-size:17px; width:330px;'>$question</div>
						</div>
						<div style='padding-left:50px;'>
						<span class='username' style=''>".$smarty->get_template_vars('LBL_ANSWER')." : &nbsp; </span> &nbsp; 
						<div class='user-input-bg' style='display:inline-block; padding-left:1px; width:293px;'>
							<input type='text' name='answer' id='answer' class='user-input required' style='width:279px; padding:0px; margin:0px;' title='".$smarty->get_template_vars('LBL_ENTER_ANSWER')."' />
							<div htmlfor='answer' generated='true' class='err' style='position:absolute; display:none;'></div>
						</div>
						</div>
					</div>";
	}
	/*$html .= "<div id='cap' style=''>
						<span class='username' style=''>".$smarty->get_template_vars('LBL_SECURITY_CODE')." : &nbsp; </span> &nbsp; 
						<div class='user-input-bg' style='display:inline-block; padding-left:1px; width:293px;'>
							<img id='captchaimg' src='".$gencaptchaObj->getcaptcha()."' /> &nbsp; <img id='refresh' src='".SITE_IMAGES."refresh.jpg' /><br/>
							<input type='text' name='scode' id='scode' class='user-input required' style='width:279px; padding:0px; margin:0px;' title='".$smarty->get_template_vars('LBL_ENTER_SECURITY_CODE')."' />
							<div htmlfor='unm' generated='true' class='err' style='position:absolute; display:none;'></div>
						</div>
					</div>";*/
}
echo $html; exit;
?>