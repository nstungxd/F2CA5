<?php
$sess_id        = (isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']))? $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']: '';
$sess_usertype  = (isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE']))? $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE']: '';
$curORGID       = (isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGID']))? $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGID']: '';
$uorg_type = (isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGTYPE']))? $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGTYPE'] : '';
//echo getenv("HTTP_REFERER");
//echo $_SERVER['HTTP_REFERER'];
if(isset($_SERVER['HTTP_REFERER']) && isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'])) {
	if(strpos($_SERVER['HTTP_REFERER'],'B2B')===false && $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']>0) {
		//echo "Multi browsing in this site is not allowed !"; exit;
	}
}
if($sess_id>0)
{
	if(!in_array($file,$notincludeindex) && !in_array($file,$notUserLeft) && !in_array($file,$notUserTop) && strpos($file,"aj_")===false) {
		if(isset($_COOKIE['bt_prc']) && isset($_SESSION['prc']) && $_COOKIE['bt_prc'] != $_SESSION['prc']) {
			// echo "Multi browsing in this site is not allowed !"; exit;
		} else {
			$dv[0] = "";
			$dv[1] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
			$c = $generalobj->genUniqueCode($dv);
	  		$prc = $_SESSION['prc'] = $c . "/" . $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
	  		// setcookie('bt_prc',$prc);
	  		$smarty->assign("prc",$prc);
		}
	}
}
$dv = "";
if(!isset($stPageObj))
{
    include_once(SITE_CLASS_APPLICATION."class.StaticPage.php");
    $stPageObj =	new StaticPage();
}
if(!isset($lhObj))
{
   include_once(SITE_CLASS_APPLICATION."class.LoginHistory.php");
   $lhObj =	new LoginHistory();
}
if(!isset($orgObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
	$orgObj =	new Organization();
}
if(!isset($orgUsrObj)) {
	 require_once(SITE_CLASS_APPLICATION."user/class.OrganizationUser.php");
	 $orgUsrObj = new OrganizationUser();
}
if(!isset($orgUserPerObj)) {
	 require_once(SITE_CLASS_APPLICATION."user/class.OrganizationUserPermission.php");
	 $orgUserPerObj = new OrganizationUserPermission();
}
if(!isset($secManObj)) {
	 require_once(SITE_CLASS_APPLICATION."securitymanager/class.SecurityManager.php");
	 $secManObj = new SecurityManager();
}
if(!isset($orgprefObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationPreference.php");
	$orgprefObj =	new OrganizationPreference();
}
if(!isset($statusmasterObj)) {
	include_once(SITE_CLASS_APPLICATION."class.StatusMaster.php");
	$statusmasterObj = new StatusMaster();
}
if(!isset($orgGrpObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationGroup.php");
	$orgGrpObj = new OrganizationGroup();
}

// set folder struct for users
$usersec = "";
$orderStatus = $invoiceStatus = $ures = array();
$poUserStatusIds = $poUserStatus = $invUserStatusIds = $invUserStatus = $poUserAcptIds = $invUserAcptIds = $poUserAcpt = $invUserAcpt = "";
switch($sess_usertype)
{
	case 'securitymanager':
				$usersec = 'securitymanager';
				$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'] = 'SM';
				break;
	case 'orguser':
				$usersec = 'user';
				$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'] = 'OU';
						  $usrdtls = $orgUsrObj->select($sess_id);
						  $odt = $orgObj->select($curORGID);
						  $opf = $orgprefObj->getDetails('*'," AND iOrganizationID=$curORGID ");
//					 if($odt[0]['eReqVerification'] == 'Yes') {

						  if($usrdtls[0]['ePermissionType'] == 'Individual') {
								$uWhere = " AND iUserID='".$sess_id."' AND eStatus!='Need to Verify' ";
								$ures = $orgUserPerObj->getDetails('*',$uWhere);
						  } else if($usrdtls[0]['ePermissionType'] == 'Group') {
								$gwhere .= " AND iGroupID=".$usrdtls[0]['iGroupID']." AND eStatus!='Need to Verify' ";
								$ures = $orgGrpObj->getDetails('*',$gwhere);
								// prints($ures); exit;
						  }
//
						if(!isset($userStatusObj)) {
						 require_once(SITE_CLASS_APPLICATION."class.StatusMaster.php");
						 $userStatusObj = new StatusMaster();
                 }
							// prints($opf); exit;
							$poOrgStatus = @explode(",",$opf[0]['vOrderStatusLevel']);
							$invOrgStatus = @explode(",",$opf[0]['vInvoiceStatusLevel']);
							$poOrgAcpt = @explode(",",$opf[0]['vOrderAcceptanceLevel']);
							$invOrgAcpt = @explode(",",$opf[0]['vInvoiceAcceptanceLevel']);
							// prints($opf[0]['vInvoiceAcceptanceLevel']); exit;
							$poOrgStatus     = $userStatusObj->getDetails('vStatus_'.$_SESSION["SESS_".PRJ_CONST_PREFIX."_LANG"].' as vStatus,vStatus_en,iStatusID', " AND (iStatusID in(".$opf[0]['vOrderStatusLevel'].") AND eFor='PO') ",' iDisplayOrder ASC ','');
							$invOrgStatus    = $userStatusObj->getDetails('vStatus_'.$_SESSION["SESS_".PRJ_CONST_PREFIX."_LANG"].' as vStatus,vStatus_en,iStatusID', " AND (iStatusID in(".$opf[0]['vInvoiceStatusLevel'].") AND eFor='Invoice') ",' iDisplayOrder ASC ','');
							$poOrgAcpt       = $userStatusObj->getDetails('vStatus_'.$_SESSION["SESS_".PRJ_CONST_PREFIX."_LANG"].' as vStatus,vStatus_en,iStatusID', " AND (iStatusID in(".$opf[0]['vOrderAcceptanceLevel'].") AND eFor='PO') ",' iDisplayOrder ASC ','');
							$invOrgAcpt      = $userStatusObj->getDetails('vStatus_'.$_SESSION["SESS_".PRJ_CONST_PREFIX."_LANG"].' as vStatus,vStatus_en,iStatusID', " AND (iStatusID in(".$opf[0]['vInvoiceAcceptanceLevel'].") AND eFor='Invoice') ",' iDisplayOrder ASC ','');
							// prints($invOrgAcpt); exit;
							$smarty->assign('poOrgStatus',$poOrgStatus);
							$smarty->assign('invOrgStatus',$invOrgStatus);
							$smarty->assign('poOrgAcpt',$poOrgAcpt);
							$smarty->assign('invOrgAcpt',$invOrgAcpt);

                    $userStatus         = @explode(";",$ures[0]['tPermission']);
                    $invUserStatus      = $userStatus[0];
                    $invUserStatusIds   = str_replace("inv:","",$invUserStatus);
                    $poUserStatus       = (isset($userStatus[1]))? $userStatus[1] : '';
                    $poUserStatusIds    = str_replace("po:","",$poUserStatus);

                    $userAcpt           = @explode(";",$ures[0]['tAcceptancePermit']);
                    $invUserAcpt        = $userAcpt[0];
                    $invUserAcptIds     = str_replace("inv:","",$invUserAcpt);
                    $poUserAcpt         = (isset($userAcpt[1]))? $userAcpt[1] : '';
                    $poUserAcptIds      = str_replace("po:","",$poUserAcpt);
					// prints($invUserAcpt); exit;
					if((isset($ures[0]['eVerify'])) && strpos($ures[0]['eVerify'],'pi')!==false) {
					   $poUserStatusIds = '0,'.$poUserStatusIds;
					}
					if(isset($ures[0]['eVerify']) && strpos($ures[0]['eVerify'],'pa')!==false) {
					   $poUserAcptIds = '0,'.$poUserAcptIds;
					}
					if(isset($ures[0]['eVerify']) && strpos($ures[0]['eVerify'],'ii')!==false) {
					   $invUserStatusIds = '0,'.$invUserStatusIds;
					}
					if(isset($ures[0]['eVerify']) && strpos($ures[0]['eVerify'],'ia')!==false) {
					   $invUserAcptIds = '0,'.$invUserAcptIds;
					}
							// echo $poUserAcptIds; exit;

               $invUserStatus=$userStatusObj->getDetails('vStatus_'.$_SESSION["SESS_".PRJ_CONST_PREFIX."_LANG"].' as vStatus,vStatus_en,iStatusID', " AND (iStatusId in(".$invUserStatusIds.") AND eFor='Invoice') ",' iDisplayOrder ASC ','');
               $poUserStatus=$userStatusObj->getDetails('vStatus_'.$_SESSION["SESS_".PRJ_CONST_PREFIX."_LANG"].' as vStatus,vStatus_en,iStatusID', " AND (iStatusId in(".$poUserStatusIds.") AND eFor='PO') ",' iDisplayOrder ASC ','');
					$invUserAcpt=$userStatusObj->getDetails('vStatus_'.$_SESSION["SESS_".PRJ_CONST_PREFIX."_LANG"].' as vStatus,vStatus_en,iStatusID', " AND (iStatusId in(".$invUserAcptIds.") AND eFor='Invoice') ",' iDisplayOrder ASC ','');
               $poUserAcpt=$userStatusObj->getDetails('vStatus_'.$_SESSION["SESS_".PRJ_CONST_PREFIX."_LANG"].' as vStatus,vStatus_en,iStatusID', " AND (iStatusId in(".$poUserAcptIds.") AND eFor='PO') ",' iDisplayOrder ASC ','');
						  // $odt = $orgObj->select($curORGID);
						  // printS($odt); exit;
						  // prints($opf); exit;
						  if($opf[0]['eCreateMethodAllowedPO'] != 'File Import') {
							  $pocrt = 'Yes';
						  }
						  if($opf[0]['eCreateMethodAllowedInv'] != 'File Import') {
							  $invcrt = 'Yes';
						  } // $doimprt
						  if($opf[0]['eCreateMethodAllowedPO'] == 'File Import' || $opf[0]['eCreateMethodAllowedPO'] == 'Both') {
							  $doimprtpo = 'Yes';
						  }
						  if($opf[0]['eCreateMethodAllowedInv'] == 'File Import' || $opf[0]['eCreateMethodAllowedInv'] == 'Both') {
							  $doimprtinv = 'Yes';
						  }
						  for($i=0;$i<count($invUserAcpt);$i++) {
							 if(strtolower($invUserAcpt[$i]['vStatus_en']) == "create") {
								unset($invUserAcpt[$i]);
							 }
						  }
						  for($i=0;$i<count($poUserAcpt);$i++) {
							 if(strtolower($poUserAcpt[$i]['vStatus_en']) == "create") {
								unset($poUserAcpt[$i]);
							 }
						  }
						  for($i=0;$i<count($invUserStatus);$i++) {
							 if(strtolower($invUserStatus[$i]['vStatus_en']) == "create") {
								unset($invUserStatus[$i]);
							 }
						  }
						  for($i=0;$i<count($poUserStatus);$i++) {
							 if(strtolower($poUserStatus[$i]['vStatus_en']) == "create") {
								unset($poUserStatus[$i]);
							 }
						  }
							$invCreate = '';
							$poCreate = '';
							$doimportpo = '';
							$doimportinv = '';
						  if(isset($ures[0]['eFormCreation']) && strpos($ures[0]['eFormCreation'],'inv')!==false && $invcrt=='Yes') {
						     $invCreate = 'Yes';
						  }
						  if(isset($ures[0]['eImportCreation']) && strpos($ures[0]['eImportCreation'],'inv')!==false && $doimprtinv=='Yes') {
						     $doimportinv = 'Yes';
						  }
						  if(isset($ures[0]['eFormCreation']) && strpos($ures[0]['eFormCreation'],'po')!==false && $pocrt=='Yes') {
						     $poCreate = 'Yes';
						  }
						  if(isset($ures[0]['eImportCreation']) && strpos($ures[0]['eImportCreation'],'po')!==false && $doimprtpo=='Yes') {
						     $doimportpo = 'Yes';
						  }
						  // prints($ures); exit;
						  /*for($i=0;$i<count($invUserStatus);$i++)
						  {
							 if(strtolower($invUserStatus[$i]['vStatus_en']) == "create")
							 {
								unset($invUserStatus[$i]);
								if($invcrt == 'Yes') {
									$invCreate = 'Yes';
								}
								if($doimprt == 'Yes') {
									$doimport = 'Yes';
								}
								break;
							 }
						  }
						  for($i=0;$i<count($poUserStatus);$i++)
						  {
							 if(strtolower($poUserStatus[$i]['vStatus_en']) == "create")
							 {
								unset($poUserStatus[$i]);
								if($pocrt == 'Yes') {
									$poCreate = 'Yes';
								}
								if($doimprt == 'Yes') {
									$doimport = 'Yes';
								}
								// $smarty->assign('poCreate','Yes');
								break;
							 }
						  }*/
						  // prints($poUserStatus); exit;
/*					 } else {
						  $invCreate = "Yes";
						  $poCreate = "Yes";
						  $doimport = "Yes";
						  $poUserStatusIds = "";
						  $invUserStatusIds = "";
						  $poUserAcptIds = "";
						  $invUserAcptIds = "";
						  $poUserStatus = array();
						  $invUserStatus = array();
						  $poUserAcpt = array();
						  $invUserAcpt = array();
						  $ures = array();
						  $ures[0]['tPermission'] = "";
					 }
*/                        //$doimport = 'Yes';
					 $smarty->assign('pocrt',$pocrt);
					 $smarty->assign('invcrt',$invcrt);
					 $smarty->assign('invCreate',$invCreate);
					 $smarty->assign('poCreate',$poCreate);
					 $smarty->assign('doimportpo',$doimportpo);
					 $smarty->assign('doimportinv',$doimportinv);
				break;
	 case 'orgadmin':
				$usersec = 'user';
				$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'] = 'OA';
				break;
}
$orgid = "";
if($sess_usertype == 'orguser')
{
	$orgUsrObj->setiUserID($sess_id);
	$udts              = $orgUsrObj->select($sess_id);
	$usrtype           = $orgUsrObj->geteUserType();
	$orgid             = $curORGID;	// $orgUsrObj->getiOrganizationID();
    // $reqVerification   = $opf[0]['eReqVerification'];
    /*$encInvoice = $opf[0]['eSecureImportExportInvoice'];
    if($encInvoice == 'Yes')
        $encInvoice='y';
    $encPO = $opf[0]['eSecureImportExportPO'];
    if ($encPO == 'Yes')
        $encPO='y';*/

    if($usrtype == 'Admin')
	{
		$sess_usertype = 'orgadmin';
		$usersec = 'organization';
		$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'] = 'OA';
	}
}


$staticarr_top = $stPageObj->getStaticPageDetail("*","AND vFile = 'Top Welcome Text'");
//Prints($_SESSION['SET_URL']);exit;
if($HAVE_HTACCESS == 'No') {
    if(isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'SET_URL']) && $_SESSION['SESS_'.PRJ_CONST_PREFIX.'SET_URL'] != '') {
       $currentUrl = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'SET_URL'];
    } else {
       $currentUrl = SITE_URL_DUM.str_replace(SITE_FOLDER.'index.php/','',$_SERVER['REQUEST_URI']);
    }
    $currentUrl = SITE_URL_DUM.str_replace(SITE_FOLDER.'index.php/','',$_SERVER['REQUEST_URI']);
} else {
    if(isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'SET_URL']) && $_SESSION['SESS_'.PRJ_CONST_PREFIX.'SET_URL'] != '') {
       $currentUrl = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'SET_URL'];
    } else {
       $currentUrl = SITE_URL_DUM.str_replace(SITE_FOLDER,'',$_SERVER['REQUEST_URI']);
    }
    $currentUrl = SITE_URL_DUM.str_replace(SITE_FOLDER,'',$_SERVER['REQUEST_URI']);
}
// prints($currentUrl); // exit;

if(!isset($lghObj)) {
	require_once(SITE_CLASS_APPLICATION."class.LoginHistory.php");
	$lghObj = new LoginHistory();
}

$sess_user_name  = (isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_NAME']))? $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_NAME']: '';
$sess_usertype_short = (isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT']))? $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT']: '';

if($sess_usertype_short == 'SM') {
	$usrobj = $secManObj;
} else {
	$usrobj = $orgUsrObj;
}
$lastLoginDate = "";
$totInboxres = "";
if(isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']) && $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'] != '') {
   $sess_id = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
   $lastLog = $lghObj->getDetails("*"," AND iAdminId=$sess_id"," dLoginDate DESC ",''," LIMIT 0,1");
   $lastLoginDate = $lastLog[0]['dLoginDate'];
   //Prints($lastLog);exit;

   //Prints($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_INBOX_VIEWED']);exit;
   $curViewedInbox  = (isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_INBOX_VIEWED']))? $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_INBOX_VIEWED']: '';
   $curViewedInboxStr = @implode(',',$curViewedInbox);
   $where_inbox = "";
   if($curViewedInboxStr != ''){
      $where_inbox.=' AND iVerifiedID NOT IN('.$curViewedInboxStr.')';
   }
   switch($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT']) {
      case "SM":
         $sessType = 'SM';
         $where_inbox .= ' AND ((iCreatedBy <> '.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'].' AND eCreatedType = \'SM\') OR eCreatedType = \'OA\' OR eCreatedType = \'OU\')';
      break;
      case "OA":
         $sessType = 'OA';
         $where_inbox .= ' AND ((iCreatedBy <> '.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'].' AND eCreatedType = \'OA\') OR eCreatedType = \'OU\') AND iOrganizationID='.$curORGID.' ';	// AND iOrganizationID='.$curORGID.'
      break;
      case "OU":
         $sessType = 'OU';
         $where_inbox .= ' AND ((iCreatedBy <> '.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'].' AND eCreatedType = \'OU\') AND iOrganizationID='.$curORGID.')';
      break;
   }

   // $where_inbox .= ' AND (dActionDate > \''.$lastLoginDate.'\')';
   $where_inbox.= ' AND iVerifiedID NOT IN (SELECT iInboxId FROM '.PRJ_DB_PREFIX.'_user_deleted_inbox WHERE iUserId = \''.$sess_id.'\' AND eUserType = \''.$sess_usertype_short.'\')'; 	// AND eViewed!=\'Yes\'
   $orderBy = " ORDER BY iVerifiedID DESC";
   $limit= ""; 	// ' LIMIT 0,5';

   $ss = 'Select * from Information_schema.Routines Where Routine_Name = "GetInbox"';
   $exita = $dbobj->MySQLSelect($ss);
   //prints();exit;
   /*if(!$exita){
    $alerthtml = "Please Run the store procedure & trigger file with logged in as a Super Privillage User.Please find below Store Procedure & Trigeer File Path.1)Store Procedure : ".SPATH_ROOT."SQL/storeprocedure.sql 2)Triggers : ".SPATH_ROOT."SQL/triggers.sql";
    ?>
    <script type="text/javascript">var cnt=0; if(cnt==0) {
        alert("<?php echo $alerthtml;?>");cnt++;}</script>
   <?php
   }*/

    $sql_res = 'CALL GetInbox("'.$sess_usertype_short.'"," '.$where_inbox.'","","'.$orderBy.'","'.$limit.'")';
	# echo $sql_res; exit;
    $totInboxres = $dbobj->Onlyquery($sql_res);
}

if(isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT']) && $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'] == 'OA') {
    $orgdata = $orgObj->select($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGID']);
    $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGNAME'] = $orgdata[0]['vCompanyName'];

	 $orgpref = $orgprefObj->getDetails('*'," AND iOrganizationID=$curORGID");
	 // print_r($orgpref[0]);
    $postatus = $orgpref[0]['vOrderStatusLevel'];
	 $invstatus = $orgpref[0]['vInvoiceStatusLevel'];
	 $poUserStatusIds	  =$postatus;
    $invUserStatusIds=$invstatus;
	 //print $postatus;
    if(trim($postatus) != '') {
		  $postatus = @explode(',',$postatus);
	 }
	 if(trim($invstatus) != '') {
		  $invstatus = @explode(',',$invstatus);
	 }
    //print_r($postatus);
	 $postatus = $statusmasterObj->getStatusDetails($postatus,'PO');
	 //print_r($invstatus);
    $invstatus = $statusmasterObj->getStatusDetails($invstatus,'Invoice');

    $smarty->assign('postatus',$postatus);
	 $smarty->assign('invstatus',$invstatus);
}

if($uorg_type!='SM' && isset($ENABLE_AUCTION) && $ENABLE_AUCTION=='Yes') {
	if(!isset($rfq2Obj)) {
		include_once(SITE_CLASS_APPLICATION."user/class.RFQ2Master.php");
		$rfq2Obj = new RFQ2Master();
	}
	$rs = $rfq2Obj->setAllRfq2Ststus();
}

$where = "";
$orgtype = (isset($odt[0]['eOrganizationType']))? $odt[0]['eOrganizationType']: '';

if(isset($_SESSION['from'])) {
	if($file != 'or-createorganization' && $file != 'or-createorganizationpref' && $file != 'or-createorganization_a' && $file != 'or-createorganizationpref_a' && $file!='m-aj_chkpage' && $_SESSION['from']=='org') {
	   unset($_SESSION['from']);
	} else if($file != 'u-createorganizationuser' && $file!='u-aj_getOrganizationUserStatus' && $file!='u-aj_getB2OrgUserStatus' && $file != 'u-edituserrights' && $file != 'u-createorganizationuser_a' && $file != 'u-assignrights_a' && $file!='m-aj_chkpage' && $file!="or-aj_getOrgCombo" && $file!="or-aj_getDetailsComp" && $file!="u-aj_chkdupdata" && $_SESSION['from']=='usr') {
	   unset($_SESSION['from']);
	}
}

// check for currently online from elsewhere -------------------------------------
$uip = $_SERVER['REMOTE_ADDR'];
// $mltplsignin = $lhObj->getDetails(' iAdminId,dLoginDate,dLogoutDate,vIP '," AND (iAdminId=$sess_id AND eType='$sess_usertype_short') AND (dLogoutDate='0000-00-00 00:00:00')");
// prints($mltplsignin); exit;
// $dte = $date('Y-m-d H:i:s');
// $ml = $lhObj->getDetails(' iAdminId,dLoginDate,dLogoutDate,vIP,vSessionId '," AND (iAdminId=$sess_id AND eType='$sess_usertype_short' AND vSessionId!='".session_id()."' AND dLogoutDate='0000-00-00 00:00:00')");
$rsql = "Select * from ".PRJ_DB_PREFIX."_recent_online where iCustomerId=$sess_id AND eType='$sess_usertype_short' AND vTimeLastClick > DATE_SUB(NOW(), INTERVAL 600 SECOND) AND eSetLogout!='Yes'"; // session timeout value check
// echo $rsql; exit;
$ml = $dbobj->MySqlSelect($rsql);
//if(is_array($ml) && count($ml)>1) {
	 //$multipleLogins = 'yes';
//}
// $mlusr = array();
$mlusr = '';
// prints($ml); exit;
if(is_array($ml) && count($ml)>1) {
	for($ln=0;$ln<count($ml);$ln++) {
	 	// $rsql = "Select * from ".PRJ_DB_PREFIX."_recent_online where iCustomerId=$sess_id AND eType='$sess_usertype_short' AND vSessionId='".$ml[$ln]['vSessionId']."' AND eSetLogout!='Yes'"; 	// AND vTimeLastClick > DATE_SUB(NOW(), INTERVAL 2500 SECOND) 	// session timeout value check
	 	// echo $rsql; exit;
	 	// echo session_id(); exit;
		$mltplsignin = $lhObj->getDetails(' iAdminId,dLoginDate,dLogoutDate,vIP,vSessionId '," AND (iAdminId=$sess_id AND eType='$sess_usertype_short' AND vSessionId='".$ml[$ln]['vSessionId']."' AND dLogoutDate='0000-00-00 00:00:00')"); 	// user logout check
		// $mltplsignin = $dbobj->MySqlSelect($rsql);
	   if(is_array($mltplsignin) && count($mltplsignin)>0) {
			$mlusr = 'yes';
	   }
   }
}
// logout if multiple login exists
// if($mlusr == 'yes' && $_SESSION['mlusr']!='yes') {
if($mlusr == 'yes' && (!isset($_SESSION['mlusr']) || $_SESSION['mlusr']!='yes')) {
	$_SESSION['mlusr'] = 'yes';
//	 header("Location: ".SITE_URL_DUM."logout/sotp");
//	 exit;
}
// prints($_SERVER); exit;
// prints($_SESSION); exit;
// $rp = $_SERVER['REQUEST_URI']."---".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
// setcookie('B2B_PGS',$rp);
// if(trim($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']) >0)
// prints($_SERVER); exit;
//-------------------------------
// prints($sess_usertype_short); exit;
// prints($odt); exit;
// prints($invUserAcpt); exit;
// prints($poUserStatusIds);
// prints($invUserStatusIds); exit
//prints($poUserStatus); exit;
$ENABLE_AUCTION = (isset($ENABLE_AUCTION))? $ENABLE_AUCTION : '';
$smarty->assign("ENABLE_AUCTION",$ENABLE_AUCTION);
$smarty->assign("lastLoginDate",$lastLoginDate);
$smarty->assign("totInboxres",count($totInboxres));
$smarty->assign("orgtype",$orgtype);
$smarty->assign('currentUrl',$currentUrl);
$smarty->assign('iUserId',$sess_id);
$smarty->assign('usersec',$usersec);
$smarty->assign('ures',$ures);
$smarty->assign('sess_user_name',$sess_user_name);
$smarty->assign('usertype',$sess_usertype);
$smarty->assign('orgid',$orgid);
$smarty->assign('poUserStatusIds',$poUserStatusIds);
$smarty->assign('invUserStatusIds',$invUserStatusIds);
$smarty->assign('poUserStatus',$poUserStatus);
$smarty->assign('invUserStatus',$invUserStatus);
$smarty->assign('poUserAcptIds',$poUserAcptIds);
$smarty->assign('invUserAcptIds',$invUserAcptIds);
$smarty->assign('poUserAcpt',$poUserAcpt);
$smarty->assign('invUserAcpt',$invUserAcpt);
$smarty->assign('curORGID',$curORGID);
$smarty->assign('sess_usertype_short',$sess_usertype_short);
$smarty->assign('multipleLogins',$mlusr);
$smarty->assign('uorg_type',$uorg_type);
?>