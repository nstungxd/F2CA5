<?php

include(S_SECTIONS."/member/memberaccess.php");

// $msg = GetVar('msg');
$msg = (isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']))? $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG'] : '';
unset ($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']);
if($msg == 'ras') {
     $msg = $smarty->get_template_vars('MSG_ADD_SUCC');
} elseif($msg == 'raserr') {
     $msg = $smarty->get_template_vars('MSG_ADD_ERR');
} elseif($msg == 'rus') {
   $msg = $smarty->get_template_vars('MSG_UPDATE_SUCC');
} elseif($msg == 'ruserr') {
   $msg = $smarty->get_template_vars('MSG_UPDATE_ERR');
} elseif($msg == 'orgvrfy') {
   $msg = $smarty->get_template_vars('MSG_VERIFY_SUCC');
} elseif($msg == 'orgvrfyer') {
   $msg = $smarty->get_template_vars('MSG_VERIFY_ERR');
} elseif($msg == 'rds') {
   $msg = $smarty->get_template_vars('MSG_DEL_SUCC');
} elseif($msg == 'rdserr') {
   $msg = $smarty->get_template_vars('MSG_DEL_ERR');
} elseif($msg == 'rss') {
   $msg = $smarty->get_template_vars('MSG_STATUS_SUCC');
} elseif($msg == 'rsserr') {
   $msg = $smarty->get_template_vars('MSG_STATUS_ERR');
} else{
     $msg='';
}

if(!isset($countryObj))
{
   include_once(SITE_CLASS_APPLICATION."class.Country.php");
   $countryObj =	new Country();
}

// $srchfor = $_POST['srchfor'];
$srchval = (isset($_POST['srchval']))? $_POST['srchval'] : '';

if(isset($ENABLE_AUCTION) && $ENABLE_AUCTION=='Yes') {
   $orgTypes = $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_organization_master", "eOrganizationType","org_type", "org_type","","","style='width:179px;' class='drop-down' ","Select Admin Type","---Select---");
} else {
   $orgTypes = $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_organization_master", "eOrganizationType","org_type", "org_type","","","style='width:179px;' class='drop-down' ","Select Admin Type","---Select---",'Buyer2');
}
$countries = $countryObj->getCountryDetail("iCountryId,vCountry,vCountryCode","AND eStatus='Active'");
$smarty->assign('orgTypes',$orgTypes);
$smarty->assign('countries',$countries);
$smarty->assign('msg',$msg);
$smarty->assign('srchval',$srchval);

?>