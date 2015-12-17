<?php

include(S_SECTIONS."/member/memberaccess.php");

$iGroupID = GetVar('id');
//$msg = GetVar('msg');
$msg = (isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']))? $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG'] : '';
//$msg=$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG'];
unset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']);

if($msg == 'ras') {
     $msg = $smarty->get_template_vars('MSG_ADD_SUCC');
} elseif($msg == 'raserr') {
     $msg = $smarty->get_template_vars('MSG_ADD_ERR');
} elseif($msg == 'rus') {
   $msg = $smarty->get_template_vars('MSG_UPDATE_SUCC');
} elseif($msg == 'ruserr') {
   $msg = $smarty->get_template_vars('MSG_UPDATE_ERR');
}else $msg='';
//prints($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']);

if(isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']) && $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'] != '' ) {
   include(SITE_CLASS_GEN."class.validation.php");
   $validation=new Validation();
// prints( $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']);
   $vldmsg = $validation->CreateHtmlMsg($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']);
   unset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']);
}

if(!isset($orgGroupObj)) {
    include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationGroup.php");
    $orgGroupObj =	new OrganizationGroup();
}
//print_r($orgGroupObj);
if(!isset($orgObj)) {
    include_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
    $orgObj =	new Organization();
}
if(!isset($UsrObj)) {
	require_once(SITE_CLASS_APPLICATION."user/class.OrganizationUser.php");
	$UsrObj = new OrganizationUser;
}
$grpData = Array();
$orgdata = Array();
$userdata = Array();
if($iGroupID != '') {
     $view = 'edit';
     $grpData = $orgGroupObj->select($iGroupID);
     if($sess_usertype_short == 'OA' && $grpData[0]['iOrganizationID']!=$curORGID) {
     	  header("Location: ".SITE_URL_DUM."grouplist");
     	  exit;
     }
     //prints($grpData);exit;
     if($grpData[0]['eStatus'] == 'Need to Verify' || $grpData[0]['eStatus'] == 'Modified' || $grpData[0]['eStatus'] == 'Delete' || $grpData[0]['eNeedToVerify'] == 'Yes') {
          header('Location:'.SITE_URL_DUM.'groupview/'.$iGroupID);
          exit;
     }
     $orgdata = $orgObj->select($grpData[0]['iOrganizationID']);
     $where =' AND iUserID IN ('.$grpData[0]['tUserID'].') AND iOrganizationID='.$grpData[0]['iOrganizationID'];
     $userdata = $UsrObj->getDetails("CONCAT(vFirstName,' ',vLastName) as vTitle,iUserID as Id, iOrganizationID",$where);
     //prints($userdata);exit;
}

if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'] == 'OA') {
     $orgname = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGNAME'];
     $orgid = $curORGID;
     $smarty->assign('orgid',$orgid);
}
$usertype=$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE'];
// prints($grpData); exit;
$view = (isset($view))? $view : '';
$vldmsg = (isset($vldmsg))? $vldmsg : '';
$orgname = (isset($orgname))? $orgname : '';

$smarty->assign('iGroupID',$iGroupID);
$smarty->assign('grpData',$grpData);
$smarty->assign('orgdata',$orgdata);
$smarty->assign('view',$view);
$smarty->assign('vldmsg',$vldmsg);
$smarty->assign('msg',$msg);
$smarty->assign('userdata',$userdata);
$smarty->assign('orgname',$orgname);
$smarty->assign('usertype',$usertype);
?>