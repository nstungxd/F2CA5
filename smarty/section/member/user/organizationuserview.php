<?php
include(S_SECTIONS."/member/memberaccess.php");

$iUserID = GetVar('id');
if($sess_usertype == 'orguser')
{
     $iUserID=$sess_id;
}
//$msg = GetVar('msg');
$msg = (isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']))? $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG'] : '';
if($msg == 'ras') {
     $msg = $smarty->get_template_vars('MSG_ADD_SUCC');
} elseif($msg == 'raerr') {
     $msg = $smarty->get_template_vars('MSG_ADD_ERR');
}

if(!isset($orgUserObj)) {
     include_once(SITE_CLASS_APPLICATION."user/class.OrganizationUser.php");
     $orgUserObj =	new OrganizationUser();
}
//print_r($orgUserObj);
if(!isset($userToVerifyObj)) {
     include_once(SITE_CLASS_APPLICATION.'user/class.OrganizationUserToverify.php');
     $userToVerifyObj = new OrganizationUserToverify();
}
if(!isset($orgObj))
{
     include_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
     $orgObj = new Organization();
}
if(!isset($countryObj)) {
     include_once(SITE_CLASS_APPLICATION."class.Country.php");
     $countryObj =	new Country();
}

if(!isset($stateObj)) {
     include_once(SITE_CLASS_APPLICATION."class.State.php");
     $stateObj =	new State();
}
if(!isset($cntstObj)) {
     include_once(SITE_CLASS_GEN."class.countrystate.php");
     $cntstObj =	new CountryState();
}
if(!isset($orgUserPerObj)) {
   require_once(SITE_CLASS_APPLICATION."user/class.OrganizationUserPermission.php");
   $orgUserPerObj = new OrganizationUserPermission();
}
if(!isset($orgUserPermVerifyObj)) {
   include_once(SITE_CLASS_APPLICATION."user/class.OrganizationUserPermissionToVerify.php");
	$orgUserPermVerifyObj =	new OrganizationUserPermissionToVerify();
}

$uprmts = Array();
if($iUserID != '') {
   $view = 'verify';
   $OuserData = $userData = $orgUserObj->select($iUserID);
   if($sess_usertype_short == 'OA' && $userData[0]['iOrganizationID']!=$curORGID) {
      header("Location: ".SITE_URL_DUM."organizationuserlist");
     	exit;
   }
   $fields = " *, grp.vGroupName ";
   $jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_organization_group grp on ou.iGroupID=grp.iGroupID ";
   $OuserData = $orgUserObj->getJoinTableInfo($jtbl,$fields," AND ou.iUserID=$iUserID ");  // $iUserID
   $OuserData = $userData = $userData[0];
   $uprmts = $orgUserPerObj->getDetails('*'," AND iUserID=$iUserID ");
   $vuprmts = $orgUserPermVerifyObj->getDetails('*'," AND iUserID=$iUserID ",' iVerifiedID DESC ','',' LIMIT 0,1 ');
}
$state =	$cntstObj->getgeneralArr(PRJ_DB_PREFIX."_state_master"," AND eStatus='Active'","vStateCode","vState","vCountryCode","vStateCode,vState,vCountryCode");
$stateArr = $state[0];
//$stateArr	=	array($stateArr);
//echo $stateArr[0][2];
//prints($stateArr);exit;
$groupArr =	$cntstObj->getgeneralArr(PRJ_DB_PREFIX."_organization_group"," AND eStatus='Active' ","iGroupID","vGroupName","iOrganizationID","iGroupID,vGroupName,iOrganizationID");
$groupArr=$groupArr[0];
$db_country = $countryObj->getCountryDetail("iCountryId,vCountry,vCountryCode","AND eStatus = 'Active'");
//prints($db_country);exit;

$db_state = $stateObj->getStateDetail("iStateId, vStateCode, vState","AND eStatus = 'Active' AND vCountryCode = '".$userData['vCountry']."'","vState");

$where = " AND iOrganizationID=".$OuserData['iOrganizationID']."";
$organization = $orgObj->getDetails('*',$where);
// prints($organization); exit;
$msg = $smarty->get_template_vars('MSG_NEED_VERIFY');

//prints($userData);exit;
if($userData['eUserType']!='')
     $userTypeVal=$userData['eUserType'];
else
     $userTypeVal='User';
$userTypes = $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_organization_user", "eUserType","Data[eUserType]", "eUserType","",$userTypeVal,"style='width:200px;' class='drop-down' ","Select User Type");
//$eStatus = $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_organization_user", "eStatus","Data[eStatus]", "eStatus","",$statusVal,"style='width:200px;' class='drop-down' ","Select Status");
$where = 'AND iUserID = '.$iUserID.'';
$udts = $userToVerifyObj->getDetails('*',$where,' iVerifiedID desc ','',' LIMIT 0,1 ');
$udts = $udts[0];
//prints($udts);//exit;
if($udts['eStatus'] == 'Modified' || $udts['eNeedToVerify'] == 'Yes' || $udts['eStatus'] == 'Delete') {
     $where = 'AND iUserID = '.$iUserID.'';
     // $userData = $userToVerifyObj->getDetails('*',$where,' iVerifiedID desc');
     $fields = " ou.*, grp.vGroupName";
     $jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_organization_group grp on ou.iGroupID=grp.iGroupID ";
     $userData = $userToVerifyObj->getJoinTableInfo($jtbl,$fields," AND ou.iUserID=$iUserID ",' iVerifiedID desc ');
     $userData = $userData[0];
//prints($userData);
//exit ;
     $db_state = $stateObj->getStateDetail("iStateId, vStateCode, vState","AND eStatus = 'Active' AND vCountryCode = '".$userData['vCountry']."'","vState");
     $where = " AND iOrganizationID=".$userData['iOrganizationID']."";
     $organization = $orgObj->getDetails('*',$where);
}

$secQuestion1=$gdbobj->getreqtableinfo(PRJ_DB_PREFIX."_sec_question","iQuestionID='".$userData['iSecretQuestion1ID']."'",'vQuestion_'.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG']);
$secQuestion1=$secQuestion1[0];
$secQuestion1=$secQuestion1['vQuestion_'.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG']];
$secQuestion2 = Array();
if($userData['iSecretQuestion2ID'] != '')
{
     $secQuestion2=$gdbobj->getreqtableinfo(PRJ_DB_PREFIX."_sec_question","iQuestionID='".$userData['iSecretQuestion2ID']."'",'vQuestion_'.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG']);
     $secQuestion2 = (isset($secQuestion2[0]))? $secQuestion2[0] : '';
     $secQuestion2 = (isset($secQuestion2['vQuestion_'.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG']]))? $secQuestion2['vQuestion_'.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG']] : '';
     //$secQuestion2=$secQuestion2['vQuestion_'.$_SESSION['SESS_B2B_LANG']];

}
$defaltLan=$gdbobj->getreqtableinfo(PRJ_DB_PREFIX."_language","vLanguageCode='".$userData['vDefaltLan']."'",'vLanguage');
//print_r($defaltLan);
$defaltLan=$defaltLan[0];
$defaltLan=$defaltLan['vLanguage'];
$verify = '';
if(($OuserData['eStatus'] == 'Need to Verify'))
{
	switch($sess_usertype)
	{
		case 'securitymanager':
					if($OuserData['eCreatedBy']=='SM') {
						if($OuserData['iCreatedBy']!=$sess_id) {
							$verify = 'yes';
						} else {
							$verify = 'no';
						}
					}
					else {
						$verify = 'yes';
					}
					break;
		case 'orgadmin':
					if($OuserData['eCreatedBy']=='OA') {
						if($OuserData['iCreatedBy']!=$sess_id) {
							$verify = 'yes';
						} else {
							$verify = 'no';
						}
					}
					else {
						$verify = 'yes';
					}
					break;
	}
}
else if($OuserData['eStatus'] == 'Modified' || $OuserData['eStatus'] == 'Delete' || $userData['eNeedToVerify'] == 'Yes')
{
   // prints($userData); exit;
	switch($sess_usertype)
	{
		case 'securitymanager':
          if($OuserData['eModifiedBy']=='SM') {
             if($OuserData['iModifiedByID']!=$sess_id) {
                $verify = 'yes';
             } else {
                $verify = 'no';
             }
          }
          else {
             $verify = 'yes';
          }
          break;
		case 'orgadmin':
          if($OuserData['eModifiedBy']=='OA') {
             if($OuserData['iModifiedByID']!=$sess_id) {
                $verify = 'yes';
             } else {
                $verify = 'no';
             }
          }
          else {
             $verify = 'yes';
          }
          break;
	}
}
// prints($OuserData); exit;
if($OuserData['eStatus'] == 'Need to Verify') {
   if($OuserData['iCreatedBy'] == $sess_id) {
     $msg = $smarty->get_template_vars('MSG_OTHER_VERIFICATION_NEED');
   }
} else {
     switch($OuserData['eStatus']) {
        case "Modified":
          if($OuserData['iModifiedByID'] == $sess_id) {
             $msg = $smarty->get_template_vars('MSG_OTHER_VERIFICATION_NEED');
          } else {
             $msg = $smarty->get_template_vars('MSG_VERIFY_MODIFICATION');
          }
        break;
        case "Delete":
          if($OuserData['iModifiedByID'] == $sess_id) {
             $msg = $smarty->get_template_vars('MSG_OTHER_VERIFICATION_NEED');
          } else {
             $msg = $smarty->get_template_vars('MSG_VERIFY_DELETE');
          }
        break;
        /*case "Inactive":
          if($OuserData[0]['iModifiedByID'] == $sess_id){
               $msg = $smarty->get_template_vars('MSG_OTHER_VERIFICATION_NEED');
          } else {
           $msg = $smarty->get_template_vars('MSG_VERIFY_INACTIVE');
          }
        break;*/
     }
}

if($udts['eNeedToVerify'] == 'Yes') {
	 $msg = $smarty->get_template_vars('MSG_VERIFY_STATUS');
    $msg .= "<br/>".$smarty->get_template_vars('LBL_NEW_STATUS_WILL_BE')." '".$udts['eStatus']."'.";
    if($udts[0]['eModifiedBy']=='SM' && $sess_usertype_short == 'SM' && $udts[0]['iModifiedByID']!=$sess_id) {
			 $verify = 'yes';
	 } else if($udts[0]['eModifiedBy']=='OA') {
	  if($sess_usertype_short == 'OA' && $udts[0]['iModifiedByID']!=$sess_id){
			 $verify = 'yes';
	  } else if($sess_usertype_short == 'SM'){
			 $verify = 'yes';
	  }
	 }
}
$where = 'AND iUserID = '.$iUserID.'';
// $userData = $userToVerifyObj->getDetails('*',$where,' iVerifiedID desc');
$vusrdt = $userToVerifyObj->getDetails('*'," AND iUserID=$iUserID ",' iVerifiedID desc ','',' LIMIT 0,1 ');

$usrvrfy = '';
$uprmts[0]['eStatus'] = (isset($uprmts[0]['eStatus']))? $uprmts[0]['eStatus'] : '';
$vuprmts[0]['eModifiedBy'] = (isset($vuprmts[0]['eModifiedBy']))? $vuprmts[0]['eModifiedBy'] : '';
if(!(($uprmts[0]['eStatus'] == 'Active' || $uprmts[0]['eStatus'] == 'Inactive') && $uprmts[0]['eNeedToVerify']!='Yes')) {
   if($vuprmts[0]['eModifiedBy']=='SM' && $sess_usertype_short=='SM' && $sess_id!=$vuprmts[0]['iModifiedByID']) {
		 $usrvrfy = 'yes';
   } else if($vuprmts[0]['eModifiedBy']=='OA') {
		 if($sess_usertype_short=='OA' && $sess_id!=$vuprmts[0]['iModifiedByID']) {
		    $usrvrfy = 'yes';
		 } else if($sess_usertype_short=='SM') {
		    $usrvrfy = 'yes';
		 }
	}
}
// prints($verify); exit;
//prints($userData);
$smarty->assign('stateArr',$stateArr);
$smarty->assign('db_country',$db_country);
$smarty->assign('db_state',$db_state);
$smarty->assign('secQuestion1',$secQuestion1);
$smarty->assign('secQuestion2',$secQuestion2);
$smarty->assign('iUserID',$iUserID);
$smarty->assign('userData',$userData);
$smarty->assign('OuserData',$OuserData);
$smarty->assign('vusrdt',$vusrdt);
$smarty->assign('usrvrfy',$usrvrfy);
$smarty->assign('udts',$udts);
$smarty->assign('organization',$organization);
$smarty->assign('groupArr',$groupArr);
$smarty->assign('view',$view);
$smarty->assign('sess_usertype',$sess_usertype);
$smarty->assign('userTypes',$userTypes);
$smarty->assign('msg',$msg);
if(isset($_REQUEST['msg'])) {
	$smarty->assign('orgMsg',$_REQUEST['msg']);
}
$smarty->assign('verify',$verify);
$smarty->assign('generalobj',$generalobj);
$smarty->assign('defaltLan',$defaltLan);
?>