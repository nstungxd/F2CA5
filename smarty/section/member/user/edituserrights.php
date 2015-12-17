<?php

include(S_SECTIONS."/member/memberaccess.php");

if(!isset($orgUserObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.OrganizationUser.php");
	$orgUserObj =	new OrganizationUser();
}
if(!isset($orgUserPerObj)) {
   require_once(SITE_CLASS_APPLICATION."user/class.OrganizationUserPermission.php");
   $orgUserPerObj = new OrganizationUserPermission();
}

if(!isset($orgStaObj)) {
   require_once(SITE_CLASS_APPLICATION."class.StatusMaster.php");
   $orgStaObj = new StatusMaster();
}
if(!isset($orgObj)) {
   include_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
   $orgObj =	new Organization();
}
$verify = isset($verify) ? $verify : '';
$iUserID = $_GET['id'];
$msg=isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']) ? $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']: '';
unset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']);
//$msg = GetVar('msg');
if($msg == 'ras') {
     $msg = $smarty->get_template_vars('MSG_ADD_SUCC');
} elseif($msg == 'raerr') {
     $msg = $smarty->get_template_vars('MSG_ADD_ERR');
}else $msg='';

$orgUserObj->setiUserID($iUserID);
$usrdata = $orgUserObj->select($iUserID);
$usrdata[0]['eUSerType'] = isset($usrdata[0]['eUSerType']) ? $usrdata[0]['eUSerType'] : '';
if($usrdata[0]['eUSerType'] == 'Admin') {
   header("Location: ".SITE_URL_DUM."createorganizationuser/$iUserID");
   exit;
}
$view = isset($view) ? $view : '';
if($iUserID != '') {
   $view = 'edit';
   $where = " AND iUserID='".$iUserID."'";
   $userdata = $orgUserObj->getDetails('*',$where);

   $ures = $orgUserPerObj->getDetails('*',$where);
   $userStatus = @explode(";",$ures[0]['tPermission']);
   $invUserStatus = $userStatus[0];
   $invUserStatus = str_replace("inv:","",$invUserStatus);
   $poUserStatus = isset($userStatus[1]) ? $userStatus[1] : '';
   $poUserStatus = str_replace("po:","",$poUserStatus);
   $invUserStatus = @explode(',',$invUserStatus);
   $poUserStatus = @explode(',',$poUserStatus);

   $where = " AND iOrganizationID='".$userdata[0]['iOrganizationID']."'";
   $orgdata = $orgObj->getDetails('*',$where);
   // prints($orgdata); exit;
   $orgname = $orgdata[0]['vCompanyName'];
   $where = "";
   $status = $orgStaObj->getDetails('vStatus_'.LANG.' as title,vStatusMsg_'.LANG.',iStatusID as Id,eFor',$where,'iDisplayOrder','');
}
$ures[0]['eStatus'] = isset($ures[0]['eStatus']) ? $ures[0]['eStatus'] : '';
if(($ures[0]['eStatus'] == 'Need to Verify'))
{
	switch($sess_usertype)
	{
		case 'securitymanager':
					if($ures[0]['eCreatedBy']=='SM') {
						if($ures[0]['iCreatedBy']!=$sess_id) {
							$verify = 'yes';
						}
					}
					else {
						$verify = 'no';
					}
					break;
		case 'orgadmin':
					if($ures[0]['eCreatedBy']=='OA') {
						if($ures[0]['iCreatedBy']!=$sess_id) {
							$verify = 'yes';
						}
					}
					else {
						$verify = 'no';
					}
					break;
	}
}
else if($ures[0]['eStatus'] == 'Modified')
{
	switch($sess_usertype)
	{
		case 'securitymanager':
					if($ures[0]['eModifiedBy']=='SM') {
						if($ures[0]['iModifiedByID']!=$sess_id) {
							$verify = 'yes';
						}
					}
					else {
						$verify = 'no';
					}
					break;
		case 'orgadmin':
					if($ures[0]['eModifiedBy']=='OA') {
						if($ures[0]['iModifiedByID']!=$sess_id) {
							$verify = 'yes';
						}
					}
					else {
						$verify = 'no';
					}
					break;
	}
}
// prints($orgdata); exit;
// prints($userdata[0]['ePermissionType']); exit;
$smarty->assign('iUserID',$iUserID);
$smarty->assign('status',$status);
$smarty->assign('poUserStatus',$poUserStatus);
$smarty->assign('invUserStatus',$invUserStatus);
$smarty->assign('userdata',$userdata);
$smarty->assign('orgdata',$orgdata);
$smarty->assign('ures',$ures);
$smarty->assign('orgname',$orgname);
$smarty->assign('view',$view);
$smarty->assign('verify',$verify);
?>