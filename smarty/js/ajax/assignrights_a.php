<?php
include(S_SECTIONS."/member/memberaccess.php");

if(!isset($orgObj)) {
    include_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
    $orgObj =	new Organization();
}
if(!isset($orgUserPermObj)) {
    include_once(SITE_CLASS_APPLICATION."user/class.OrganizationUserPermission.php");
    $orgUserPermObj =	new OrganizationUserPermission();
}
if(!isset($orgUserPermVerifyObj)) {
    include_once(SITE_CLASS_APPLICATION."user/class.OrganizationUserPermissionToVerify.php");
    $orgUserPermVerifyObj =	new OrganizationUserPermissionToVerify();
}
if(!isset($secManObj)) {
	require_once(SITE_CLASS_APPLICATION."securitymanager/class.SecurityManager.php");
	$secManObj = new SecurityManager();
}
if(!isset($orgUsrObj)) {
	require_once(SITE_CLASS_APPLICATION."user/class.OrganizationUser.php");
	$orgUsrObj = new OrganizationUser();
}
if(!isset($userToVerifyObj)) {
	include_once(SITE_CLASS_APPLICATION.'user/class.OrganizationUserToverify.php');
	$userToVerifyObj = new OrganizationUserToverify();
}
if(!isset($userActionObj)) {
	include_once(SITE_CLASS_APPLICATION.'user/class.UserActionVerification.php');
   $userActionObj = new UserActionVerification();
}
if(!isset($emailObj)) {
     include_once(SITE_CLASS_APPLICATION.'class.EmailTemplate.php');
     $emailObj = new EmailTemplate();
}
if(!isset($sendMail)) {
	include_once(SITE_CLASS_GEN."class.sendmail.php");
	$sendMail = new SendPHPMail();
}
if(!isset($statusmasterObj)) {
	include_once(SITE_CLASS_APPLICATION."class.StatusMaster.php");
	$statusmasterObj = new StatusMaster();
}

$Data = $_POST['Data'];
$iUserId = $Data['iUserID'];
$iPermissionID = (isset($_POST['iPermissionID']))? $_POST['iPermissionID'] : '';
$view = $_POST['view'];
$usrdt = $orgUsrObj->getDetails('*'," AND iUserID=$iUserId");
$orgdt = $orgObj->getDetails('*'," AND iOrganizationID=".$usrdt[0]['iOrganizationID']."");
// prints($orgdt);exit;
// pr($_POST); exit;
if($iUserId!='') {
	 $uprmt = $orgUserPermObj->getDetails('*'," AND iUserID=$iUserId");
    if(is_array($uprmt) && count($uprmt)>0) {
   	 if(($uprmt[0]['eStatus']=='Active' || $uprmt[0]['eStatus']=='Inactive') && $uprmt[0]['eNeedToVerify']!='Yes') {
   		 // prints($orgdt); exit;
   	 } else if(($view == 'edit' || $view == 'add' || $view == '') && count($uprmt)>0 && $_SESSION['from']!='usr') {
   		 header('Location:'.SITE_URL_DUM.'organizationuserlist');
   		 exit;
   	 }
    }
}

if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'] == 'SM')
{
	$smdt = $secManObj->getDetails('*'," AND iSMID!=".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']." AND eStatus='Active' AND eEmailNotification='Yes' ");
	$ordt = $orgUsrObj->getDetails('*'," AND eStatus='Active' AND eEmailNotification='Yes' AND eUserType='Admin' AND iOrganizationID=".$usrdt[0]['iOrganizationID']);
}
else if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'] == 'OA')
{
	$smdt = $secManObj->getDetails('*'," AND eStatus='Active' AND eEmailNotification='Yes' ");
	$ordt = $orgUsrObj->getDetails('*'," AND iUserID!=".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']." AND eStatus='Active' AND eUserType='Admin' AND eEmailNotification='Yes' AND iOrganizationID=".$usrdt[0]['iOrganizationID']);
}
if(is_array($smdt) && is_array($ordt)) {
	$emailArr = array_merge($smdt,$ordt);
}
else if(is_array($smdt)) {
	$emailArr = $smdt;
}
else if(is_array($ordt)) {
	$emailArr = $ordt;
}

// for check of verification
if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'] == 'SM')
{
	$smdt = $secManObj->getDetails('*'," AND iSMID!=".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']." AND eStatus='Active' ");
	$ordt = $orgUsrObj->getDetails('*'," AND eStatus='Active' AND eUserType='Admin' AND iOrganizationID=".$usrdt[0]['iOrganizationID']);
}
else if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'] == 'OA')
{
	$smdt = $secManObj->getDetails('*'," AND eStatus='Active' ");
	$ordt = $orgUsrObj->getDetails('*'," AND iUserID!=".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']." AND eStatus='Active' AND eUserType='Admin' AND iOrganizationID=".$usrdt[0]['iOrganizationID']);
}
if(is_array($smdt) && is_array($ordt)) {
	$emlar = array_merge($smdt,$ordt);
}
else if(is_array($smdt)) {
	$emlar = $smdt;
}
else if(is_array($ordt)) {
	$emlar = $ordt;
}

//prints($emailArr);exit;
if($view == 'reject')
{
	$dt['eStatus'] = $dts['eStatus'] = "Active";
	$usrprmtdtls = $orgUserPermObj->getDetails('*'," AND iPermissionID=$iPermissionID ");
   if($usrprmtdtls[0]['eStatus']=='Need to Verify')
   {
		$dt['eStatus'] = $dts['eStatus'] = "Inactive";
	}
	else if($usrprmtdtls[0]['eStatus']=='Modified')
	{
		$dt['eStatus'] = $dts['eStatus'] = "Active";
		$dts['iModifiedByID'] = "";
		$dts['eModifiedBy'] = "";
	}
	$dt['tReasonToReject'] = $_POST['tReasonToReject'];
	$dt['iRejectedById'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
	$dt['eRejectedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
	$dt['dRejectedDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
	$res = $orgUserPermObj->updateData($dts," iPermissionID=$iPermissionID ");
	$iVerifiedID = $orgUserPermVerifyObj->getDetails('*'," AND iPermissionID=$iPermissionID "," iVerifiedID DESC ",''," LIMIT 0,1");
	if(is_array($iVerifiedID) && count($iVerifiedID)>0) {
	 $iVerifiedID = $iVerifiedID[0]['iVerifiedID'];
	 $rs = $orgUserPermVerifyObj->updateData($dt," iVerifiedID=$iVerifiedID ");
	}

	 if($res) {
		  $updtl = $orgUserPermObj->select($iPermissionID);
		  $iUserID = $updtl[0]['iUserID'];
		  $usrprmtdtls = $orgUsrObj->getDetails('*'," AND iUserID=$iUserID ");
		  $vudtl = $userToVerifyObj->getDetails('*'," AND iUserID=$iUserID "," iVerifiedID DESC ",''," LIMIT 0,1");
		  if($usrprmtdtls[0]['eStatus']=='Need to Verify' || $usrprmtdtls[0]['eStatus']=='Modified' || $usrprmtdtls[0]['eStatus']=='Delete' || $usrprmtdtls[0]['eNeedToVerify']=='Yes') {
			  $rs = $orgUsrObj->updateData($dts," iUserID=$iUserID ");
			  if($vudtl[0]['iVerifiedID'] > 0) {
				  $rs = $userToVerifyObj->updateData($dt," iVerifiedID=".$vudtl[0]['iVerifiedID']);
			  }
		  }
	 }

	if($res) {
		$msg = "rus";
	}
	else {
		$msg = "ruserr";
	}
	 unset($_SESSION['from']);
    $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']=$msg;
     if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'] == 'OA') {
          header('Location:'.SITE_URL_DUM.'createorganizationuser/'.$usrprmtdtls[0]['iUserID'].'/'.$var_msg);
          exit;
     } else {
          header("Location:".SITE_URL_DUM."organizationuserlist/".$msg);
          exit;
     }

}
else if($view == 'verify')
{
   $where = " AND iPermissionID='".$iPermissionID."'";
   $orderby = ' iVerifiedID Desc ';
	if($iPermissionID > 0)
	{
		$vrfdata=$orgUserPermVerifyObj->getDetails('*',$where,$orderby,'',' LIMIT 0,1 ');
		$dt['iVerifiedSMID'] = $sess_id;
		$dt['eStatus'] = 'Active';
		$dt['iVerifiedSMID'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
		$dt['eVerifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
		$dt['dVerifiedDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
	 if($vrfdata[0]['iVerifiedID'] > 0) {
		$orgUserPermVerifyObj->setAllVar($dt);
		$where= " iVerifiedID='".$vrfdata[0]['iVerifiedID']."'";
		$iVerifiedID=$orgUserPermVerifyObj->updateData($dt,$where);
	 }
		if($iVerifiedID) {
				 $where = " AND iVerifiedID='".$vrfdata[0]['iVerifiedID']."'";
				 $updtdata=$orgUserPermVerifyObj->getDetails('*',$where);
				 $vdt = $updtdata[0];
				 unset($vdt['iVerifiedID']);
				 unset($vdt['iPermissionID']);
		  $where= " iPermissionID='".$vrfdata[0]['iPermissionID']."'";
		  $res=$orgUserPermObj->updateData($vdt,$where);
		  if($res) {
				$updtl = $orgUserPermObj->select($iPermissionID);
				$iUserID = $updtl[0]['iUserID'];
				$usrprmtdtls = $orgUsrObj->getDetails('*'," AND iUserID=$iUserID ");
				$vudtl = $userToVerifyObj->getDetails('*'," AND iUserID=$iUserID "," iVerifiedID DESC ",''," LIMIT 0,1");
				if($vudtl[0]['iVerifiedID'] > 0) {
				  $rs = $userToVerifyObj->updateData($dt," iVerifiedID=".$vudtl[0]['iVerifiedID']);
				  $vudtls = $userToVerifyObj->getDetails('*'," AND iUserID=$iUserID "," iVerifiedID DESC ",''," LIMIT 0,1");
				  unset($vudtls[0]['iVerifiedID']);
				  $rs = $orgUsrObj->updateData($vudtls[0]," iUserID=$iUserID ");
			  }
		  }
				 $udt['eVerifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
				 $udt['iVerifiedBy'] = $sess_id;
				 $udt['dVerifyDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
				 $udt['vVerifyFromIP'] = $_SERVER['REMOTE_ADDR'];
				 $userActionObj->setAllVar($udt);
				 $where= " iItemID='".$vrfdata[0]['iVerifiedID']."' AND eSubject = 'User Rights'";
				 $res=$userActionObj->updateData($udt,$where);
		}
    }
		  unset($udt);
		  unset($vdt);
		  unset($dt);
		  unset($_SESSION['from']);
		  if($res){$var_msg = "rvs";}else{$var_msg = "rvserr";}
         $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']=$var_msg;
      if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'] == 'OA') {
          //header('Location:'.SITE_URL_DUM.'createorganizationuser/'.$vrfdata[0]['iUserID'].'/'.$var_msg);
			 header('Location:'.SITE_URL_DUM.'organizationuserlist/'.$var_msg);
          exit;
     } else {
          header('Location:'.SITE_URL_DUM.'organizationuserlist/'.$var_msg);
          exit;
     }
}

if(strpos($_SERVER['HTTP_REFERER'],'edituserrights') === 'false') {
 ### SERVER SIDE VALIDATION ####
	 include(SITE_CLASS_GEN."class.validation.php");
	 $validation=new Validation();
	 $RequiredFiledArr = array( 'iOrganizationID'=>$smarty->get_template_vars('MSG_SELECT_ORGANIZATION'), 'iUserID'=>$smarty->get_template_vars('LBL_SELECT')." ".$smarty->get_template_vars('LBL_ORG_USER'));
	 $resArr = $validation->isEmpty($RequiredFiledArr);
	// prints($resArr);exit;
    if($resArr) {
       $_SESSION['Data']=$Data;
       header("Location:".$_SERVER['HTTP_REFERER']."");
       exit;
    }
}

if($Data['iUserID'] != '' ) {
	// prints($_POST); exit;
   // Prints($_SESSION);exit;
    //$Data['iUserID'] = $_POST['iUserID'];
	 //
	 $Data['eInvFPO'] = $_POST['eInvFPO'];
	 //
    ## INSERT PERMISSION
	 $po_deflvl_ary = $statusmasterObj->getDetails('iStatusID'," AND eType='Default' AND eFor='PO' ",' iDisplayOrder ASC ');
	 $inv_deflvl_ary = $statusmasterObj->getDetails('iStatusID'," AND eType='Default' AND eFor='Invoice' ",' iDisplayOrder ASC ');
	 $stsdtls =  $statusmasterObj->getDetails('*'," AND eFor='PO' AND vStatus_en='Issued' ");
	 $poisusts = $stsdtls[0]['iStatusID'];
	 $stsdtls =  $statusmasterObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Issued' ");
	 $invisusts = $stsdtls[0]['iStatusID'];
	 $stsdtls =  $statusmasterObj->getDetails('*'," AND eFor='PO' AND vStatus_en='Accepted' ");
	 $poacptsts = $stsdtls[0]['iStatusID'];
	 $stsdtls =  $statusmasterObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Accepted' ");
	 $invacptsts = $stsdtls[0]['iStatusID'];
	 $stsdtls =  $statusmasterObj->getDetails('*'," AND eFor='PO' AND vStatus_en='Create' ");
	 $pocrtsts = $stsdtls[0]['iStatusID'];
	 $stsdtls =  $statusmasterObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Create' ");
	 $invcrtsts = $stsdtls[0]['iStatusID'];
	 $stsdtls =  $statusmasterObj->getDetails('*'," AND eFor='PO' AND vStatus_en='Rejected' ");
	 $porjsts = $stsdtls[0]['iStatusID'];
	 $stsdtls =  $statusmasterObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Rejected' ");
	 $invrjsts = $stsdtls[0]['iStatusID'];

	 $inv_deflvl = array();
	 for($l=0;$l<count($inv_deflvl_ary);$l++) {
		  $inv_deflvl[] = $inv_deflvl_ary[$l]['iStatusID'];
	 }
	 for($l=0;$l<count($po_deflvl_ary);$l++) {
		  $po_deflvl[] = $po_deflvl_ary[$l]['iStatusID'];
	 }
    $InvoicePermission = (isset($_POST['InvoicePermission']))? $_POST['InvoicePermission'] : '';
    $OrderPermission = (isset($_POST['OrderPermission']))? $_POST['OrderPermission'] : '';
	 $OrderAcceptance = (isset($_POST['PoAcpt']))? $_POST['PoAcpt'] : '';
	 $InvoiceAcceptance = (isset($_POST['InvoiceAcpt']))? $_POST['InvoiceAcpt'] : '';
	 // $InvoiceAcceptance = $_POST['InvoiceAcpt'];
//	 $InvoiceAcceptance[] = $invisusts;
	 // $InvoiceAcceptance[] = $invacptsts; //
//	 $OrderAcceptance[] = $poisusts;
	 //$OrderAcceptance[] = $poacptsts; //
	 $InvoicePermission[] = $invacptsts;
	 // $InvoicePermission[] = $invisusts; //
	 // $OrderPermission[] = $poisusts; //
	 $OrderPermission[] = $poacptsts;
	 $OrderPermission[] = $OrderAcceptance[] = $porjsts;
	 $InvoicePermission[] = $InvoiceAcceptance[]  = $invrjsts;

	 $Data['eFormCreation'] = '';
	 if(isset($_POST['eFormCreationPO']) && $_POST['eFormCreationPO']=='Yes') {
		 $Data['eFormCreation'] .= 'po';
	    $OrderPermission[] = $OrderAcceptance[] = $pocrtsts;
	 }
	 if(isset($_POST['eFormCreationInv']) && $_POST['eFormCreationInv']=='Yes') {
       $Data['eFormCreation'] .= ',inv';
		 $InvoicePermission[] = $InvoiceAcceptance[] = $invcrtsts;
	 }
	 $Data['eImportCreation'] = '';
	 if(isset($_POST['eImportCreationPO']) && $_POST['eImportCreationPO']=='Yes') {
		 $Data['eImportCreation'] .= 'po';
	    $OrderPermission[] = $OrderAcceptance[] = $pocrtsts;
	 }
	 if(isset($_POST['eImportCreationInv']) && $_POST['eImportCreationInv']=='Yes') {
       $Data['eImportCreation'] .= ',inv';
		 $InvoicePermission[] = $InvoiceAcceptance[] = $invcrtsts;
	 }

	 $Data['eVerify'] = '';
	 $pvdtls =  $statusmasterObj->getDetails('*'," AND eFor='PO' AND vStatus_en='Verify' ");
	 $pvdtls = $pvdtls[0]['iStatusID'];
	 $ivdtls =  $statusmasterObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Verify' ");
	 $ivdtls = $ivdtls[0]['iStatusID'];
	 if(isset($_POST['eVerifyPO']) && $_POST['eVerifyPO']=='Yes') {
		 $Data['eVerify'] .= 'pi:ia';
		 $OrderPermission[] = $pvdtls;
		 $InvoiceAcceptance[] = $ivdtls;
	 }
	 if(isset($_POST['eVerifyInv']) && $_POST['eVerifyInv']=='Yes') {
        $Data['eVerify'] .= ',ii:pa';
		$InvoicePermission[] = $ivdtls;
        $OrderAcceptance[] = $pvdtls;
	 }

	$OrderPermission = array_unique($OrderPermission);
	$OrderAcceptance = array_unique($OrderAcceptance);
	$InvoicePermission = array_unique($InvoicePermission);
	$InvoiceAcceptance = array_unique($InvoiceAcceptance);
	 // prints($InvoiceAcceptance); exit;
	 $tPermits = '';
	 if(is_array($InvoicePermission) && count($InvoicePermission)>0)
	 {
		 $InvoicePermission = array_merge($InvoicePermission,$inv_deflvl);
		 $InvoicePermission = array_unique($InvoicePermission);
		 sort($InvoicePermission);
		 $tPermits = "inv:".@implode(",",$InvoicePermission).";";
	 }
	 /* else if(is_array($inv_deflvl) && count($inv_deflvl)>0) {
	    $InvoicePermission = "inv:".@implode(",",$inv_deflvl).";";
	 }*/
	 if(is_array($OrderPermission) && count($OrderPermission)>0)
	 {
		 $OrderPermission = array_merge($OrderPermission,$po_deflvl);
		 $OrderPermission = array_unique($OrderPermission);
		 sort($OrderPermission);
		 if(trim($tPermits) == '')
			$tPermits .= ";po:".@implode(",",$OrderPermission);
		 else
			$tPermits .= "po:".@implode(",",$OrderPermission);
	 }
	 /*else if(is_array($po_deflvl) && count($po_deflvl)>0) {
		   if(trim($tPermits) == '')
			   $tPermits .= ";po:".@implode(",",$po_deflvl);
		   else
			   $tPermits .= "po:".@implode(",",$po_deflvl);
	 }*/
	 // echo $tPermits; exit;
/*    if($_POST['InvoicePermission'])
        $InvoicePermission = serialize($_POST['InvoicePermission']);
    if($_POST['OrderPermission'])
        $OrderPermission = serialize($_POST['OrderPermission']);
*/
//    $newarr = $InvoicePermission."||".$OrderPermission ;
//    $Data['tPermission'] = $newarr;
	 $Data['tPermission'] = $tPermits;
	 // $Data['eFormCreation']
	 if(is_array($InvoiceAcceptance) && count($InvoiceAcceptance)>0)
	 {
		 $InvoiceAcceptance = array_merge($InvoiceAcceptance,$inv_deflvl);
		 $InvoicePermission = array_unique($InvoicePermission);
		 sort($InvoiceAcceptance);
		 $tAcceptance = "inv:".@implode(",",$InvoiceAcceptance).";";
	 }
	 /* else if(is_array($inv_deflvl) && count($inv_deflvl)>0) {
	    $InvoicePermission = "inv:".@implode(",",$inv_deflvl).";";
	 }*/
	 if(is_array($OrderAcceptance) && count($OrderAcceptance)>0)
	 {
		 $OrderAcceptance = array_merge($OrderAcceptance,$po_deflvl);
		 $OrderAcceptance = array_unique($OrderAcceptance);
		 sort($OrderAcceptance);
		 if(trim($tAcceptance) == '')
			$tAcceptance .= ";po:".@implode(",",$OrderAcceptance);
		 else
			$tAcceptance .= "po:".@implode(",",$OrderAcceptance);
	 }

	 $Data['tAcceptancePermit'] = $tAcceptance;
	 //
    // pr($_POST); // exit;
    $rfq2awardacptstsdflvl = $statusmasterObj->getDetails('iStatusID'," AND vStatus_en IN ('Rejected') AND vForAuction LIKE '%RFQ2 Award Acceptance%' ",'',''); 	// 'Verify',
    $rfq2awardacptstsdflvl = multi21Array($rfq2awardacptstsdflvl,'iStatusID');
    if(isset($_POST['eRfq2AwardAcpt']) && is_array($_POST['eRfq2AwardAcpt']) && count($_POST['eRfq2AwardAcpt'])>0) {
      $rfq2awardacptstsdflvl = array_merge($rfq2awardacptstsdflvl,$_POST['eRfq2AwardAcpt']);
    }
    @ sort($rfq2awardacptstsdflvl);
    if(count($rfq2awardacptstsdflvl)>0) {
      $rfq2awardacptstsdflvl = @implode(',',$rfq2awardacptstsdflvl);
    } else { $rfq2awardacptstsdflvl = ''; }
    //
    $Data['vRFQ2AwardAcceptPermits'] = $rfq2awardacptstsdflvl;
    if(is_array($_POST['eRfq2Bid']) && count($_POST['eRfq2Bid'])>0) {
      $Data['vRFQ2BidPermits'] = @implode(',',$_POST['eRfq2Bid']);
    }
    //
	 $rfq2awardstsdflvl = array();
    // $rfq2awardstsdflvl = $statusmasterObj->getDetails('iStatusID'," AND vForAuction Like '%RFQ2 Award,%' AND (eType='Default' OR vStatus_en IN ('Rejected')) "); 	// 'Create','Verify'
	 $rfq2awardstsdflvl = $statusmasterObj->getDetails('iStatusID'," AND vForAuction Like '%RFQ2 Award,%' AND vStatus_en IN ('Rejected') "); 	// 'Create','Verify'
    $rfq2awardstsdflvl = multi21Array($rfq2awardstsdflvl,'iStatusID');
    if(isset($_POST['eRfq2Award']) && is_array($_POST['eRfq2Award']) && count($_POST['eRfq2Award'])>0) {
      $rfq2awardstsdflvl = array_merge($rfq2awardstsdflvl,$_POST['eRfq2Award']);
    }
	 // pr($rfq2awardstsdflvl); exit;
    @ sort($rfq2awardstsdflvl);
    if(count($rfq2awardstsdflvl)>0) {
      $rfq2awardstsdflvl = @implode(',',$rfq2awardstsdflvl);
    } else { $rfq2awardstsdflvl = ''; }
    //
    $Data['vRFQ2AwardPermits'] = $rfq2awardstsdflvl;
    if(is_array($_POST['eRfq2']) && count($_POST['eRfq2'])>0) {
      $Data['vRFQ2Permits'] = @implode(',',$_POST['eRfq2']);
    }
    // pr($rfq2awardacptstsdflvl); exit;
    // pr($Data); exit;
    //
	 $usrpermitdt = $orgUserPermObj->getDetails('*'," AND iUserID=".$Data['iUserID']);
	 if(isset($usrpermitdt[0]['iPermissionID']) && $usrpermitdt[0]['iPermissionID'] != '')
	 {
		## INSERT INTO VERIFY TABLE
//			$Data['iCreatedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
//			$Data['eCreatedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
		$Data['dDate'] = date('Y-m-d H:i:s');
		$dt['iModifiedByID'] = $Data['iModifiedByID'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
		$dt['eModifiedBy'] = $Data['eModifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
		$dt['dModifiedDate'] = $Data['dModifiedDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
		//if(count($emlar) > 0) {
		$dt['eStatus'] = $Data['eStatus'] = 'Modified';
		/*} else {
			$dt = $Data;
			$dt['eStatus'] = $Data['eStatus'] = $Data_verify['eStatus'] = 'Active';
		}*/
		$Data_verify = $Data;
		$ipermitid = $usrpermitdt[0]['iPermissionID'];
		$Data_verify['iPermissionID'] = $ipermitid;
		  // pr($Data_verify); exit;
		$orgUserPermVerifyObj->setAllVar($Data_verify);
		$res = $orgUserPermVerifyObj->insert();

		$where = "iPermissionID=".$usrpermitdt[0]['iPermissionID'];
		// prints($dt); exit;
		$rs = $orgUserPermObj->updateData($dt,$where);
		  unset($dt['eFormCreation']);
		  unset($dt['eImportCreation']);
		  unset($dt['eVerify']);
		  unset($dt['tPermission']);
		  unset($dt['tAcceptancePermit']);
		  unset($dt['dDate']);
		$iPermissionID = $res;
		if($res)
		{
		  $iUserID = $Data['iUserID'];
		  $usrst = $orgUsrObj->getDetails('*'," AND iUserID=$iUserID AND eStatus!='Need to Verify' AND eStatus!='Modified' AND eStatus!='Delete' AND eNeedToVerify!='Yes'");
		  if(is_array($usrst) && count($usrst)>0) {
			  $rs = $orgUsrObj->updateData($dt," iUserID=$iUserID AND eStatus!='Need to Verify' AND eStatus!='Modified' AND eStatus!='Delete' AND eNeedToVerify!='Yes'");
			  if($rs) {
				  $orgdl = $orgUsrObj->getDetails("*"," AND iUserID=$iUserID ");
				  $orgdl = $orgdl[0];
				  $rs = $userToVerifyObj->insert($orgdl);
			  }
		  }
		  //$vudtl = $userToVerifyObj->getDetails('iVerifiedID'," AND iUserID=$iUserID "," iVerifiedID DESC ",'',' LIMIT 0,1 ');
		  //$iVerifId = $vudtl[0]['iVerifiedID'];
		  // $rs = $userToVerifyObj->updateData($dt," iVerifiedID=$iVerifId ");
	   }
      if($res){ $var_msg="rus"; } else { $var_msg="ruserr"; }
      $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']=$var_msg;
	 }
    else
	 {
           $Data['dDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
           $Data['iCreatedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
           $Data['eCreatedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
		//if(count($emlar) > 0)
			$dt['eStatus'] = $Data['eStatus'] = 'Need to Verify';
		/*else
			$dt['eStatus'] = $Data['eStatus'] = 'Active';*/
		 $orgUserPermObj->setAllVar($Data);
		 $res = $orgUserPermObj->insert();
		 $iPermissionID = $res;
		 if($res)
		 {
			 ## INSERT INTO VERIFY TABLE
			 $Data_verify = $Data;
			 $Data_verify['iPermissionID'] = $iPermissionID;
			 $orgUserPermVerifyObj->setAllVar($Data_verify);
			 $res = $orgUserPermVerifyObj->insert();

			$dt['iModifiedByID'] = $Data['iModifiedByID'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
			$dt['eModifiedBy'] = $Data['eModifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
			$dt['dModifiedDate'] = $Data['dModifiedDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
			$dt['eStatus'] = 'Modified';
			$iUserID = $Data['iUserID'];
			$usrst = $orgUsrObj->getDetails('*'," AND iUserID=$iUserID AND eStatus!='Need to Verify' AND eStatus!='Modified' AND eStatus!='Delete' AND eNeedToVerify!='Yes'");
			if(is_array($usrst) && count($usrst)>0) {
				$rs = $orgUsrObj->updateData($dt," iUserID=$iUserID AND eStatus!='Need to Verify' AND eStatus!='Modified' AND eStatus!='Delete' AND eNeedToVerify!='Yes'");
				if($rs>0) {
					$orgdl = $orgUsrObj->getDetails("*"," AND iUserID=$iUserID ");
				  	$orgdl = $orgdl[0];
				  	$rs = $userToVerifyObj->insert($orgdl);
		  		}
			}
			  //$vudtl = $userToVerifyObj->getDetails('iVerifiedID'," AND iUserID=$iUserID "," iVerifiedID DESC ",'',' LIMIT 0,1 ');
			  //$iVerifId = $vudtl[0]['iVerifiedID'];
			  //$rs = $userToVerifyObj->updateData($dt," iVerifiedID=$iVerifId ");
		 }
		 if($res) {
		   $var_msg = "ras";
		 } else {
			$var_msg = "raserr";
		 }
	 }

	 if($res && count($emailArr)>0)
	 {
	  //INSERT THIS RECORD IN USER_ACTION_VERIFICATION TABLE
     $where = 'AND vType="User Rights Changed" AND eSection = "Member"' ;
     $db_email = $emailObj->getDetails('*',$where);
	  $link = SITE_URL_DUM."userrights/".$usrdt[0]['iUserID'];
     $body = Array("#ORGNAME#","#ORGCODE#","#USERNAME#","#USEREMAIL#","#LINK#","#MODIFIED_BY#");
     $post = Array($orgdt[0]['vCompanyName'],$orgdt[0]['vOrganizationCode'],$usrdt[0]['vUserName'],$usrdt[0]['vEmail'],$link,$sess_user_name."($sess_usertype_short)");

     $rplarr = Array("Hello #NAME#,","background-color: rgb(239, 239, 239);","Regards,","#MAIL_FOOTER#","#SITE_URL#");
     $tbody_en = str_replace($rplarr," ",$db_email[0]['tBody_en']);
     $emailContent_en = trim(str_replace($body,$post, $tbody_en));
     $tbody_fr = str_replace($rplarr," ",$db_email[0]['tBody_fr']);
     $emailContent_fr = trim(str_replace($body,$post, $tbody_fr));

     $Data['iItemID']=$res;
     $Data['iOrganizationID'] = $usrdt[0]['iOrganizationID'];
     $Data['eSubject']='User Rights';
     $Data['eType']='Modified';
     $Data['vMailSubject_en'] = $db_email[0]['vSub_en'];
     $Data['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
     $Data['tMailContent_en'] = $emailContent_en;
     $Data['tMailContent_fr'] = $emailContent_fr;
     $Data['dActionDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');

      //print_r($Data);exit;
	 $Data['iCreatedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
	 $Data['eCreatedType'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
	 // prints($Data); exit;
     $userActionObj->setAllVar($Data);
     $userActionObj->insert();
	  // prints($emailArr); exit;
	  for($i=0;$i<count($emailArr);$i++) {
		  $smname = $emailArr[$i]['vFirstName'].' '.$emailArr[$i]['vLastName'];
		  $email = $emailArr[$i]['vEmail'];
		  //set the values of the body of email format
		  $body_arr = Array("#NAME#","#ORGNAME#","#ORGCODE#","#USERNAME#","#USEREMAIL#","#LINK#","#MODIFIED_BY#","#MAIL_FOOTER#","#SITE_URL#");
		  $post_arr = Array($smname,$orgdt[0]['vCompanyName'],$orgdt[0]['vOrganizationCode'],$usrdt[0]['vUserName'],$usrdt[0]['vEmail'],$link,$sess_user_name."($sess_usertype_short)",$MAIL_FOOTER,SITE_URL_DUM);
		  //send mail to the Admin
		  $sendMail->Send("User Rights Changed","Member",$email,$body_arr,$post_arr);
	 }
}
/*
    ## INSERT INTO VERIFY TABLE
    $Data_verify = $Data;
    $Data_verify['iPermissionID'] = $iPermissionID;
    $orgUserPermVerifyObj->setAllVar($Data_verify);
    $res = $orgUserPermVerifyObj->insert();
*/
      unset($Data);
      unset($_POST);
    if($res && $var_msg=='') {
		$var_msg="ras";
    }else if($var_msg=='') {
		$var_msg="raserr"; 	// rightsader
	 }
	 unset($_SESSION['from']);
	 $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']=$var_msg;
    if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'] == 'OA') {
        //header('Location:'.SITE_URL_DUM.'createorganizationuser/'.$Data['iUserID'].'/'.$var_msg);
		  header('Location:'.SITE_URL_DUM.'organizationuserlist/'.$var_msg);
        exit;
    } else {
        header('Location:'.SITE_URL_DUM.'organizationuserlist/'.$var_msg);
        exit;
    }
}
?>