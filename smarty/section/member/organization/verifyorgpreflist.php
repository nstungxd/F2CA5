<?php

include(S_SECTIONS."/member/memberaccess.php");

     //$msg = GetVar('msg');
$msg=$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG'];
unset ($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']);
     if($msg == 'rvs') {
        $msg = $smarty->get_template_vars('MSG_VERIFY_SUCC');
     } elseif($msg == 'rvserr') {
        $msg = $smarty->get_template_vars('MSG_VERIFY_ERR');
     }else{
          $msg='';
}
	if(!isset($countryObj))
	{
		include_once(SITE_CLASS_APPLICATION."class.Country.php");
		$countryObj =	new Country();
	}
	$orgTypes = $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_organization_master", "eOrganizationType","org_type", "org_type","","","style='width:179px;' class='drop-down' ","Select Admin Type","---Select---");
	$countries = $countryObj->getCountryDetail("iCountryId,vCountry,vCountryCode","AND eStatus='Active'");
	$smarty->assign('orgTypes',$orgTypes);
	$smarty->assign('countries',$countries);
     $smarty->assign('msg',$msg);
?>