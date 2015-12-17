<?php

include(S_SECTIONS."/member/memberaccess.php");

//sendmail class incude
include(SITE_CLASS_GEN."class.sendmail.php");

//initialization of senmail class object
$sendMail=new SendPHPMail;

if(!isset($orgprefObj)) {
    include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationPreference.php");
    $orgprefObj =	new OrganizationPreference();
}
if(!isset($orgPrefVrfObj)) {
    include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationPreferenceToverify.php");
    $orgPrefVrfObj =	new OrganizationPreferenceToverify();
}
if(!isset($orgObj)) {
    include_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
    $orgObj =	new Organization();
}
if(!isset($orgvrfObj)) {
     include_once(SITE_CLASS_APPLICATION."organization/class.Organization_Toverify.php");
     $orgvrfObj = new Organization_Toverify();
}
if(!isset($orgUserObj)) {
   include_once(SITE_CLASS_APPLICATION.'user/class.OrganizationUser.php');
   $orgUserObj = new OrganizationUser();
}
if(!isset($orgUserPermObj)) {
    include_once(SITE_CLASS_APPLICATION."user/class.OrganizationUserPermission.php");
    $orgUserPermObj =	new OrganizationUserPermission();
}
if(!isset($stMstrObj)) {
    include_once(SITE_CLASS_APPLICATION."class.StatusMaster.php");
    $stMstrObj =	new StatusMaster();
}
if(!isset($userActionObj)) {
     include_once(SITE_CLASS_APPLICATION.'user/class.UserActionVerification.php');
     $userActionObj = new UserActionVerification();
}
if(!isset($emailObj)) {
     include_once(SITE_CLASS_APPLICATION.'class.EmailTemplate.php');
     $emailObj = new EmailTemplate();
}


$Data = PostVar("Data");
if(is_array($Data['vCurrency'])) {
	 $Data['vCurrency'] = @implode(',',$Data['vCurrency']);
}
if(trim($Data['eSecureImportExport']) != 'Yes') {
	 $Data['eSecureImportExport'] = 'No';
}
$iAdditionalInfoID = PostVar("iAdditionalInfoID");
$iOrganizationID = PostVar("iOrganizationID");
$iASMID = PostVar("iASMID");
$view = PostVar("view");

if($iOrganizationID != ''){
//$orgObj->setiOrganizationID($iOrganizationID);
$orgdtls = $orgObj->select($iOrganizationID);
$arr = $orgprefObj->getDetails('*'," AND iOrganizationID=$iOrganizationID");
	if($arr[0]['iAdditionalInfoID'] != '') {
		$view = 'edit';
	} else {
		$view = 'add';
	}
}

//------------------------DEFALT VALUES OF PURCHASE ORDER -----------------------------------------//
if($orgdtls[0]['eOrganizationType'] != 'Supplier') {
	 $where = ' AND eFor = "PO"  AND eType = "Default" AND eStatus = "Active"';
	 $postatus = $stMstrObj->getDetails('*',$where);
	 foreach($postatus as $k=>$v) {
		$poarr[] = $v['iStatusID'];
	 }
	 $postatus = @implode(',',$poarr);
}
//------------------------DEFALT VALUES OF PURCHASE ORDER -----------------------------------------//
if($orgdtls[0]['eOrganizationType'] != 'Buyer') {
	 $where = ' AND eFor = "Invoice"  AND eType = "Default" AND eStatus = "Active"';
	 $invstatus = $stMstrObj->getDetails('*',$where);
	 foreach($invstatus as $k=>$v) {
		$invarr[] = $v['iStatusID'];
	 }
	 $invstatus = @ implode(',',$invarr);
}
//echo $postatus.'===';//exit;
//echo $invstatus;exit;
$stsdtls = $stMstrObj->getDetails('*'," AND eFor='PO' AND vStatus_en='Issued' ");
$poisusts = $stsdtls[0]['iStatusID'];
$stsdtls = $stMstrObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Issued' ");
$invisusts = $stsdtls[0]['iStatusID'];
$stsdtls = $stMstrObj->getDetails('*'," AND eFor='PO' AND vStatus_en='Accepted' ");
$poacptsts = $stsdtls[0]['iStatusID'];
$stsdtls = $stMstrObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Accepted' ");
$invacptsts = $stsdtls[0]['iStatusID'];
$stsdtls = $stMstrObj->getDetails('*'," AND eFor='PO' AND vStatus_en='Issue' ");
$poists = $stsdtls[0]['iStatusID'];
$stsdtls = $stMstrObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Issue' ");
$invists = $stsdtls[0]['iStatusID'];
$prjdtls = $stMstrObj->getDetails('*'," AND eFor='PO' AND vStatus_en='Rejected' ");
$prjsts = $prjdtls[0]['iStatusID'];
$irjdtls = $stMstrObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Rejected' ");
$irjsts = $irjdtls[0]['iStatusID'];
//==================================================================================================//

$vOrderStatusLevel = $_POST['vOrderStatusLevel'];
$vInvoiceStatusLevel = $_POST['vInvoiceStatusLevel'];
$vOrderAcceptanceLevel = $_POST['vOrderAcceptanceLevel'];
$vInvoiceAcceptanceLevel = $_POST['vInvoiceAcceptanceLevel'];
if($orgdtls[0]['eOrganizationType'] != 'Buyer') {
	$vInvoiceStatusLevel[] = $invists;
	$vInvoiceStatusLevel[] = $invisusts;
	$vInvoiceStatusLevel[] = $invacptsts;
	// $vOrderAcceptanceLevel[] = $poisusts;
	$vOrderAcceptanceLevel[] = $poacptsts;
}
if($orgdtls[0]['eOrganizationType'] != 'Supplier') {
	$vOrderStatusLevel[] = $poists;
	$vOrderStatusLevel[] = $poisusts;
	$vOrderStatusLevel[] = $poacptsts;
	// $vInvoiceAcceptanceLevel[] = $invisusts;
	$vInvoiceAcceptanceLevel[] = $invacptsts;
}
$vInvoiceStatusLevel[] = $irjsts;
$vInvoiceAcceptanceLevel[] = $irjsts;
$vOrderStatusLevel[] = $prjsts;
$vOrderAcceptanceLevel[] = $prjsts;

$pvdtls =  $stMstrObj->getDetails('*'," AND eFor='PO' AND vStatus_en='Verify' ");
$pvdtls = $pvdtls[0]['iStatusID'];
$ivdtls =  $stMstrObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Verify' ");
$ivdtls = $ivdtls[0]['iStatusID'];
if($Data['eReqVerificationInv']=='Yes') {
	$vInvoiceStatusLevel[] = $ivdtls;
}
if($Data['eReqVerifyInvAcpt']=='Yes') {
	$vInvoiceAcceptanceLevel[] = $ivdtls;
}
if($Data['eReqVerificationPo']=='Yes') {
	$vOrderStatusLevel[] = $pvdtls;
}
if($Data['eReqVerifyPoAcpt']=='Yes') {
	$vOrderAcceptanceLevel[] = $pvdtls;
}
sort($vOrderStatusLevel);
sort($vInvoiceStatusLevel);
sort($vInvoiceAcceptanceLevel);
sort($vOrderAcceptanceLevel);
if(is_array($vOrderStatusLevel)){
	 $Data['vOrderStatusLevel'] = @implode(',',$vOrderStatusLevel);
} else{
	 $Data['vOrderStatusLevel'] = '';
}
if(is_array($vInvoiceStatusLevel)){
	 $Data['vInvoiceStatusLevel'] = @implode(',',$vInvoiceStatusLevel);
} else {
	 $Data['vInvoiceStatusLevel'] = '';
}
if(is_array($vInvoiceAcceptanceLevel)){
	 $Data['vInvoiceAcceptanceLevel'] = @implode(',',$vInvoiceAcceptanceLevel);
} else {
	 $Data['vInvoiceAcceptanceLevel'] = '';
}
if(is_array($vOrderAcceptanceLevel)){
	 $Data['vOrderAcceptanceLevel'] = @implode(',',$vOrderAcceptanceLevel);
} else {
	 $Data['vOrderAcceptanceLevel'] = '';
}
// prints($vOrderAcceptanceLevel); exit;
if($postatus != '') {
     $Data['vOrderStatusLevel'] = $Data['vOrderStatusLevel'].','.$postatus;
	  $Data['vOrderAcceptanceLevel'] = $Data['vOrderAcceptanceLevel'].','.$postatus;
     $parr = @explode(',',$Data['vOrderStatusLevel']);
     $purchaseorder = array_unique($parr);
     sort($purchaseorder);
     $Data['vOrderStatusLevel'] = @implode(',',$purchaseorder);
	  $paArr = @explode(',',$Data['vOrderAcceptanceLevel']);
     $purchaseordera = array_unique($paArr);
     sort($purchaseordera);
     $Data['vOrderAcceptanceLevel'] = @implode(',',$purchaseordera);
}

if($invstatus != '') {
	 $Data['vInvoiceStatusLevel'] = $Data['vInvoiceStatusLevel'].','.$invstatus;
	 $Data['vInvoiceAcceptanceLevel'] = $Data['vInvoiceAcceptanceLevel'].','.$invstatus;
	 $iarr = @explode(',',$Data['vInvoiceStatusLevel']);
	 $invoice = array_unique($iarr);
	 sort($invoice);
	 $Data['vInvoiceStatusLevel'] = @implode(',',$invoice);
	 $iaArr = @explode(',',$Data['vInvoiceAcceptanceLevel']);
	 $invoicea = array_unique($iaArr);
	 sort($invoicea);
	 $Data['vInvoiceAcceptanceLevel'] = @implode(',',$invoicea);
}
// prints($Data); exit;
foreach($Data as $k=>$v) {
    $v = trim(stripslashes($v));
}

$where = 'AND iSMID != '.$iASMID.' AND eStatus = "Active" AND eEmailNotification="Yes" ';
$arr = $secManObj->getDetails('*',$where);
//prints($arr);exit;
if($sess_usertype_short == 'SM') {
   $wh = " AND iSMID!=$sess_id ";
}
$where = $wh.' AND eStatus = "Active" ';
$sar = $secManObj->getDetails('*',$where);

if($sess_usertype_short == 'OA') {
   $whu = " AND iUserID!=$sess_id ";
}
if($iOrganizationID != '') {
   $where = $whu.' AND eStatus="Active" AND eUserType="Admin" AND iOrganizationID='.$iOrganizationID.' ';
   $uar = $orgUserObj->getDetails('*',$where);
} else {
   $uar = array();
}
// prints($uarr); exit;
if(is_array($sar) && is_array($uar)) {
	$emlar = array_merge($sar,$uar);
} else if(is_array($sar)) {
	$emlar = $sar;
} else if(is_array($uar)) {
	$emlar = $uar;
}
// prints($Data);exit;
$where = 'AND iOrganizationID = '.$iOrganizationID.'';
$ordata = $orgObj->getDetails('*',$where);
$sname = $arr[0]['vFirstName'].' '.$arr[0]['vLastName'];
$cname = $ordata[0]['vCompanyName'];
$regno = $ordata[0]['vCompanyRegNo'];
$code = $ordata[0]['vOrganizationCode'];

if($view == 'reject')
{
	 //echo $view; exit;
	$iOrganizationID = $_POST['iOrgId'];
   $dt['eNeedToVerify'] = $data['eNeedToVerify'] = 'No';
	$dt['tReasonToReject'] = $_POST['tReasonToReject'];
	$dt['iRejectedById'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
	$dt['eRejectedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
	$dt['dRejectedDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
	$dt['eStatus'] = $data['eStatus'] = "Active";
	$orgpfdtls = $orgprefObj->getDetails('*'," AND iOrganizationID=$iOrganizationID ");
   if($orgpfdtls[0]['eStatus']=='Need to Verify')
   {
		 $dt['eStatus'] = $data['eStatus'] = "Inactive";
	}
	else if($orgpfdtls[0]['eStatus']=='Modified')
	{
		 $dt['eStatus'] = $data['eStatus'] = "Active";
		 $data['iModifiedByID'] = "";
		 $data['eModifiedBy'] = "";
	}
	$res = $orgprefObj->updateData($data," iOrganizationID=$iOrganizationID ");
	$rs = $orgObj->updateData($data," iOrganizationID=$iOrganizationID ");
	$verified = $orgvrfObj->getDetails('iVerifiedID'," AND iOrganizationID=$iOrganizationID ",' iVerifiedID DESC ','',' LIMIT 0,1 ');
	$iVerifiedID = $verified[0]['iVerifiedID'];
	$rs = $orgvrfObj->updateData($dt," iVerifiedID=$iVerifiedID ");
	$vrfydtls = $orgPrefVrfObj->getDetails('*'," AND iOrganizationID=$iOrganizationID "," AND iVerifiedID DESC",''," LIMIT 0,1");
	$iVerifiedID = $vrfydtls[0]['iVerifiedID'];
	$rs = $orgPrefVrfObj->updateData($dt," iVerifiedID=$iVerifiedID ");
	if($res) {
		$msg = "rus";
	} else {
		$msg = "ruserr";
	}
        $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']=$msg;
	if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'] == 'OA') {
		  unset($_SESSION['from']);
		  header("Location:".SITE_URL_DUM."createorganizationpref/".$iOrganizationID."/".$msg);
		  exit;
	 } else {
		  unset($_SESSION['from']);
		  header("Location:".SITE_URL_DUM."organizationlist/".$msg);
		  exit;
	 }
}
if($view == 'verify')
{
	$iOrganizationID = $_POST['iOrgId'];

	$dt['eStatus'] = $Data['eStatus'] = "Active";
	$dt['iVerifiedByID'] = $Data['iVerifiedByID'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
	$dt['eVerifiedBy'] = $Data['eVerifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
	$dt['dVerifiedDate'] = $Data['dVerifiedDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
	//$Data['iOrganizationID'] = $iOrganizationID;
	$where = " AND iOrganizationID=$iOrganizationID";
	$vrfydtls = $orgPrefVrfObj->getDetails('*',$where," iVerifiedID DESC ",''," LIMIT 0,1");
	$res =$orgPrefVrfObj->updateData($dt," iVerifiedID=".$vrfydtls[0]['iVerifiedID']);
	$dt = $orgPrefVrfObj->getDetails('*'," AND iVerifiedID=".$vrfydtls[0]['iVerifiedID']);
	$iVerifiedID = $dt[0]['iVerifiedID'];
	unset($dt[0]['iVerifiedID']);
	if(count($dt) == 0) {
		$dt['eStatus'] = "Active";
	}
	$res = $orgprefObj->updateData($dt,"iOrganizationID=$iOrganizationID");
	$rs = $orgObj->updateData($dt," iOrganizationID=$iOrganizationID ");
	$verified = $orgvrfObj->getDetails('iVerifiedID'," AND iOrganizationID=$iOrganizationID ",' iVerifiedID DESC ','',' LIMIT 0,1 ');
	$ivid = $verified[0]['iVerifiedID'];
	$rs = $orgvrfObj->updateData($dt," iVerifiedID=$ivid ");

	$where = " iVerifiedID=$iVerifiedID ";
	$dtls['eVerifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
	$dtls['iVerifiedBy']	= $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
	$dtls['dVerifyDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
	$dtls['vVerifyFromIP'] = $_SERVER['REMOTE_ADDR'];
   $rs = $userActionObj->updateData($dtls,$where);

	 if($res) {
		  $orgdtls = $orgObj->select($iOrganizationID);
		  /*if($orgdtls[0]['eOrganizationType'] == 'Supplier'){
				$opdt['vOrderStatusLevel'] = '';
				$rs = $orgprefObj->updateData($opdt,"iOrganizationID=$iOrganizationID");
		  } else if($orgdtls[0]['eOrganizationType'] == 'Buyer'){
				$opdt['vInvoiceStatusLevel'] = '';
				$rs = $orgprefObj->updateData($opdt,"iOrganizationID=$iOrganizationID");
		  }*/
		  $rs = $orgUserPermObj->clearExtraPermits($iOrganizationID,$orgdtls[0]['eOrganizationType']);
		  // $rs = $orgUserPermObj->clearExPermits($iOrganizationID,$orgdtls[0]['eOrganizationType'],$Data1);
	 }

//   $orgObj->setAllVar($Data);
//	$res = $orgvrfObj->insert();
	// CHANGE STATUS IN ORGANIZATION MASTER
//	$rs = $orgObj->updateData($dt,$where);
	if($res) {
		$msg = "orgvrfy";
	}
	else {
		$msg = "orgvrfyer";
	}
        $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']=$msg;
	if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'] == 'OA') {
		  unset($_SESSION['from']);
		  header("Location:".SITE_URL_DUM."createorganizationpref/".$iOrganizationID."/".$msg);
		  exit;
	 } else {
		  unset($_SESSION['from']);
		  header("Location:".SITE_URL_DUM."organizationlist/".$msg);
		exit;
	 }
}
else if($view == 'edit')
{
	 ### SERVER SIDE VALIDATION ####
	 include(SITE_CLASS_GEN."class.validation.php");
	 $validation=new Validation();
	 $RequiredFiledArr = array(
                    'vCurrency' 		=> $smarty->get_template_vars('LBL_SELECT')." ".$smarty->get_template_vars('LBL_CURR')
					 );
	 if($orgdtls[0]['eOrganizationType']=='Buyer' || $orgdtls[0]['eOrganizationType']=='Both') {
		  $RequiredFiledArr['eCreateMethodAllowedPO'] = $smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_CREATE_METHOD_ALLOWED');
	 }
	 if($orgdtls[0]['eOrganizationType']=='Supplier' || $orgdtls[0]['eOrganizationType']=='Both') {
		  $RequiredFiledArr['eCreateMethodAllowedInv'] = $smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_CREATE_METHOD_ALLOWED');
	 }
	 $resArr = $validation->isEmptyMul($RequiredFiledArr);
	 // $RequiredFiledArr = array('vCurrency' => $smarty->get_template_vars('LBL_SELECT')." ".$smarty->get_template_vars('LBL_CURR'));
	 // $resArr = $validation->isEmpty($RequiredFiledArr);
	 // prints($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']); exit;
	 if($resArr){
             $_SESSION['Data']=$Data;
		 header("Location:".$_SERVER['HTTP_REFERER']."");
		 exit;
	 }
	 ### ENDS HERE ###

   // prints($Data);exit;
	// if(count($emlar) > 0) {
		$dt['eStatus'] = $Data['eStatus'] = "Modified";
	/*} else {
		$dt = $Data;
		$dt['eStatus'] = $Data['eStatus'] = "Active";
	}*/
       if ($Data['eReqVerificationPo'] != 'Yes') {
            $Data['eReqVerificationPo'] = 'No';
        }
        if ($Data['eReqVerificationInv'] != 'Yes') {
            $Data['eReqVerificationInv'] = 'No';
        }
		  if ($Data['eReqVerifyPoAcpt'] != 'Yes') {
            $Data['eReqVerifyPoAcpt'] = 'No';
        }
        if ($Data['eReqVerifyInvAcpt'] != 'Yes') {
            $Data['eReqVerifyInvAcpt'] = 'No';
        }
        if ($Data['eSecureExportPO'] != 'Yes') {
            $Data['eSecureExportPO'] = 'No';
        }
        if ($Data['eSecureImportInvoice'] != 'Yes') {
            $Data['eSecureImportInvoice'] = 'No';
        }
		  if ($Data['eSecureImportPO'] != 'Yes') {
            $Data['eSecureImportPO'] = 'No';
        }
        if ($Data['eSecureExportInvoice'] != 'Yes') {
            $Data['eSecureExportInvoice'] = 'No';
        }

      //
      if(!isset($Data['eRFQ2VerifyReq']) || $Data['eRFQ2VerifyReq']!='Yes') {
         $Data['eRFQ2VerifyReq'] = 'No';
      }
      if(!isset($Data['eRFQ2AwardVerifyReq']) || $Data['eRFQ2AwardVerifyReq']!='Yes') {
         $Data['eRFQ2AwardVerifyReq'] = 'No';
      }
      if(!isset($Data['eRFQ2BidVerifyReq']) || $Data['eRFQ2BidVerifyReq']!='Yes') {
         $Data['eRFQ2BidVerifyReq'] = 'No';
      }
      if(!isset($Data['eRFQ2AwardAcceptVerifyReq']) || $Data['eRFQ2AwardAcceptVerifyReq']!='Yes') {
         $Data['eRFQ2AwardAcceptVerifyReq'] = 'No';
      }

      $award_accept_status = $stMstrObj->getDetails('iStatusId'," AND vForAuction Like '%RFQ2 Award Acceptance%' AND (eType='Default' OR vStatus_en IN ('Create','Verify','Accepted')) ");
      $awardacceptstslvl = array();
      if(is_array($award_accept_status) && count($award_accept_status)>0) {
         for($l=0;$l<count($award_accept_status);$l++) {
            $awardacceptstslvl[] = $award_accept_status[$l]['iStatusId'];
         }
      }
      if(isset($_POST['vRFQ2AwardAcceptLevel'])) {
         $awardacceptstslvl = array_merge($awardacceptstslvl,$_POST['vRFQ2AwardAcceptLevel']);
      }
      sort($awardacceptstslvl);
      $awardacceptstslvl = @implode(',',$awardacceptstslvl);
      $Data['vRFQ2AwardAcceptLevel'] = $awardacceptstslvl;
      //
      $award_status = $stMstrObj->getDetails('iStatusId'," AND vForAuction Like '%RFQ2 Award,%' AND (eType='Default' OR vStatus_en IN ('Create','Verify')) ");
      $awardstslvl = array();
      if(is_array($award_status) && count($award_status)>0) {
         for($l=0;$l<count($award_status);$l++) {
            $awardstslvl[] = $award_status[$l]['iStatusId'];
         }
      }
      if(isset($_POST['vRFQ2AwardStatusLevel'])) {
         $awardstslvl = array_merge($awardstslvl,$_POST['vRFQ2AwardStatusLevel']);
      }
      sort($awardstslvl);
      $awardstslvl = @implode(',',$awardstslvl);
      $Data['vRFQ2AwardStatusLevel'] = $awardstslvl;

   ### CHECK MULTIPLE ADMIN AVAILABLE FOR THIS ORGANIZATION OR NOT
   /*$chkMulAdmin = $orgObj->ChkMultipleOrgAdmin();
   if($chkMulAdmin == '1') {
      $dt = $Data;
      $dt['eStatus'] = $Data['eStatus'] = 'Active';
   } else {
      $dt['eStatus'] = $Data['eStatus'] = $dt['eStatus'];
   }*/

	$rdt['iModifiedByID'] = $dt['iModifiedByID'] = $Data['iModifiedByID'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
	$rdt['eModifiedBy'] = $dt['eModifiedBy'] = $Data['eModifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
	$rdt['dModifiedDate'] = $dt['dModifiedDate'] = $Data['dModifiedDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
	$rdt['eStatus'] = $dt['eStatus'];
//	$where = " iAdditionalInfoID = '".$iAdditionalInfoID."'";
//	$res = $orgprefObj->updateData($dt,$where);
	$odt = $orgObj->getDetails('*'," AND iOrganizationID=$iOrganizationID");

     //INSERT THIS RECORD IN ORGANIZATION_MASTER_TOVERIFY TABLE
	  $opfdtls = $orgprefObj->select($iAdditionalInfoID);
	  // $Data['vEncryptionKey'] = $opfdtls[0]['vEncryptionKey'];
     $Data1 = $Data;
     $Data1['iAdditionalInfoID'] = $iAdditionalInfoID;

     $Data1['iOrganizationID'] = $iOrganizationID;
     foreach($Data1 as $k=>$v) {
			$Data1[$k] = trim($v);
     }
     //
	  // prints($Data1); exit;
     $orgPrefVrfObj->setAllVar($Data1);
     $res = $orgPrefVrfObj->insert();
   //  prints ($orgprefObj);
//exit;
	$where = " iAdditionalInfoID = '".$iAdditionalInfoID."'";
	$res = $orgprefObj->updateData($dt,$where);

	$rs = $orgObj->updateData($rdt," iOrganizationID=$iOrganizationID ");
	// $verified = $orgvrfObj->getDetails('iVerifiedID'," AND iOrganizationID=$iOrganizationID ",' iVerifiedID DESC ','',' LIMIT 0,1 ');
	// $ivid = $verified[0]['iVerifiedID'];
	// $rs = $orgvrfObj->updateData($rdt," iVerifiedID=$ivid ");
   $org_ndetails = $orgObj->select($iOrganizationID);
   $org_ndetails = $org_ndetails[0];
   $rs = $orgvrfObj->insert($org_ndetails);

	 if($res) {
		  $orgdtls = $orgObj->select($iOrganizationID);
		  /*if($orgdtls[0]['eOrganizationType'] == 'Supplier'){
				$opdt['vOrderStatusLevel'] = '';
				$rs = $orgprefObj->updateData($opdt,"iOrganizationID=$iOrganizationID");
		  } else if($orgdtls[0]['eOrganizationType'] == 'Buyer'){
				$opdt['vInvoiceStatusLevel'] = '';
				$rs = $orgprefObj->updateData($opdt,"iOrganizationID=$iOrganizationID");
		  }*/
		  $rs = $orgUserPermObj->clearExtraPermits($iOrganizationID,$orgdtls[0]['eOrganizationType']);
		  // $rs = $orgUserPermObj->clearExPermits($iOrganizationID,$orgdtls[0]['eOrganizationType'],$Data1);
	 }

     //INSERT THIS RECORD IN USER_ACTION_VERIFICATION TABLE
	if(count($arr) > 0)
	{
     $where = 'AND vType="Organization Preference Updated" AND eSection = "Member"' ;
     $db_email = $emailObj->getDetails('*',$where);
	  $link = SITE_URL_DUM."organizationprefview/".$iOrganizationID;
     $body = Array("#SMNAME#","#CNAME#","#LINK#","#MODIFIED_BY#","#REGNO#","#ORGCODE#");
     $post = Array($sname,$cname,$link,$sess_user_name."($sess_usertype_short)",$regno,$code);

     $rplarr = Array("Hello #SMNAME#,","background-color: rgb(239, 239, 239);","Regards,","#MAIL_FOOTER#","#SITE_URL#");
     $tbody_en = str_replace($rplarr," ",$db_email[0]['tBody_en']);
     $emailContent_en = trim(str_replace($body,$post, $tbody_en));
     $tbody_fr = str_replace($rplarr," ",$db_email[0]['tBody_fr']);
     $emailContent_fr = trim(str_replace($body,$post, $tbody_fr));
     //prints($emailContent);exit;

     $Data['iItemID']=$res;
     $Data['iOrganizationID'] = $iOrganizationID;
     $Data['eSubject']='OA';
     $Data['eType']='Modified';
     $Data['vMailSubject_en'] = $db_email[0]['vSub_en'];
     $Data['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
     $Data['tMailContent_en'] = $emailContent_en;
     $Data['tMailContent_fr'] = $emailContent_fr;
     $Data['iCreatedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
     $Data['eCreatedType'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
     $Data['dActionDate']=calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');

     // print_r($Data);
     $userActionObj->setAllVar($Data);
     $userActionObj->insert();

/*     for($i=0;$i<count($arr);$i++) {
          $smname = $arr[$i]['vFirstName'].' '.$arr[$i]['vLastName'];
          $email = $arr[$i]['vEmail'];
//			 $link = SITE_URL_DUM."organizationprefview/".$iAdditionalInfoID;
          //set the values of the body of email format
          $body_arr = Array("#SMNAME#","#CNAME#","#LINK#","#SITE_NAME#","#REGNO#","#ORGCODE#","#MAIL_FOOTER#","#SITE_URL#");
          $post_arr = Array($smname,$cname,$link,$SITE_NAME,$regno,$code,$MAIL_FOOTER,SITE_URL_DUM);

          //send mail to the Admin
          $sendMail->Send("Organization Preference Updated","Member",$email,$body_arr,$post_arr);
     }
*/
	}

	if($res)$var_msg = "rus";else $var_msg="ruserr.";
     unset($_POST);
     unset($Data);
     unset($Data1);
     $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']=$var_msg;
	  if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'] == 'OA') {
		  unset($_SESSION['from']);
			header("Location:".SITE_URL_DUM."createorganizationpref/".$iOrganizationID.'/'.$var_msg);
			exit;
	  } else {
		  unset($_SESSION['from']);
			header("Location:".SITE_URL_DUM."organizationlist/".$var_msg);
			exit;
	  }
} else {

	 ### SERVER SIDE VALIDATION ####
	 include(SITE_CLASS_GEN."class.validation.php");
	 $validation=new Validation();
	 $RequiredFiledArr = array(
						  'vCurrency' 				=> $smarty->get_template_vars('LBL_SELECT')." ".$smarty->get_template_vars('LBL_CURR')
                );
	 if($orgdtls[0]['eOrganizationType']=='Buyer' || $orgdtls[0]['eOrganizationType']=='Both') {
		  $RequiredFiledArr['eCreateMethodAllowedPO'] = $smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_CREATE_METHOD_ALLOWED');
	 }
	 if($orgdtls[0]['eOrganizationType']=='Supplier' || $orgdtls[0]['eOrganizationType']=='Both') {
		  $RequiredFiledArr['eCreateMethodAllowedInv'] = $smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_CREATE_METHOD_ALLOWED');
	 }
	 $resArr = $validation->isEmptyMul($RequiredFiledArr);
	 // $RequiredFiledArr = array('vCurrency' => $smarty->get_template_vars('LBL_SELECT')." ".$smarty->get_template_vars('LBL_CURR'));
	 // $resArr = $validation->isEmpty($RequiredFiledArr);

	 if($resArr) {
       $_SESSION['Data']=$Data;
		 header("Location:".$_SERVER['HTTP_REFERER']."");
		 exit;
	 }

	 ### ENDS HERE ###

	$Data['iOrganizationID'] = $iOrganizationID;
	// if(count($emlar) > 0)
		$Data['eStatus'] = 'Need to Verify';
	/*else
		$Data['eStatus'] = 'Active';*/

   ### CHECK MULTIPLE ADMIN AVAILABLE FOR THIS ORGANIZATION OR NOT
   /*$chkMulAdmin = $orgObj->ChkMultipleOrgAdmin();
   if($chkMulAdmin == '1'){
      $Data['eStatus']  = 'Active';
   } else {
      // $Data['eStatus']  = $dt['eStatus'];
   }*/
       $Data['iCreatedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
       $Data['eCreatedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
       if ($Data['eReqVerificationPo'] != 'Yes') {
            $Data['eReqVerificationPo'] = 'No';
        }
        if ($Data['eReqVerificationInv'] != 'Yes') {
            $Data['eReqVerificationInv'] = 'No';
        }
		  if ($Data['eReqVerifyPoAcpt'] != 'Yes') {
            $Data['eReqVerifyPoAcpt'] = 'No';
        }
        if ($Data['eReqVerifyInvAcpt'] != 'Yes') {
            $Data['eReqVerifyInvAcpt'] = 'No';
        }
        if ($Data['eSecureExportPO'] != 'Yes') {
            $Data['eSecureExportPO'] = 'No';
        }
        if ($Data['eSecureImportInvoice'] != 'Yes') {
            $Data['eSecureImportInvoice'] = 'No';
        }
		  if ($Data['eSecureImportPO'] != 'Yes') {
            $Data['eSecureImportPO'] = 'No';
        }
        if ($Data['eSecureExportInvoice'] != 'Yes') {
            $Data['eSecureExportInvoice'] = 'No';
        }

        if(!isset($Data['eRFQ2VerifyReq']) || $Data['eRFQ2VerifyReq']!='Yes') {
            $Data['eRFQ2VerifyReq'] = 'No';
        }
        if(!isset($Data['eRFQ2AwardVerifyReq']) || $Data['eRFQ2AwardVerifyReq']!='Yes') {
            $Data['eRFQ2AwardVerifyReq'] = 'No';
        }
        if(!isset($Data['eRFQ2BidVerifyReq']) || $Data['eRFQ2BidVerifyReq']!='Yes') {
            $Data['eRFQ2BidVerifyReq'] = 'No';
        }
        if(!isset($Data['eRFQ2AwardAcceptVerifyReq']) || $Data['eRFQ2AwardAcceptVerifyReq']!='Yes') {
            $Data['eRFQ2AwardAcceptVerifyReq'] = 'No';
        }

   $award_accept_status = $stMstrObj->getDetails('iStatusId'," AND vForAuction Like '%RFQ2 Award Acceptance%' AND (eType='Default' OR vStatus_en IN ('Create','Verify','Accepted')) ");
   $awardacceptstslvl = array();
   if(is_array($award_accept_status) && count($award_accept_status)>0) {
      for($l=0;$l<count($award_accept_status);$l++) {
         $awardacceptstslvl[] = $award_accept_status[$l]['iStatusId'];
      }
   }
   if(isset($_POST['vRFQ2AwardAcceptLevel'])) {
      $awardacceptstslvl = array_merge($awardacceptstslvl,$_POST['vRFQ2AwardAcceptLevel']);
   }
   sort($awardacceptstslvl);
   $awardacceptstslvl = @implode(',',$awardacceptstslvl);
   $Data['vRFQ2AwardAcceptLevel'] = $awardacceptstslvl;
   //
   $award_status = $stMstrObj->getDetails('iStatusId'," AND vForAuction Like '%RFQ2 Award,%' AND (eType='Default' OR vStatus_en IN ('Create','Verify')) ");
   $awardstslvl = array();
   if(is_array($award_status) && count($award_status)>0) {
      for($l=0;$l<count($award_status);$l++) {
         $awardstslvl[] = $award_status[$l]['iStatusId'];
      }
   }
   if(isset($_POST['vRFQ2AwardStatusLevel'])) {
      $awardstslvl = array_merge($awardstslvl,$_POST['vRFQ2AwardStatusLevel']);
   }
   sort($awardstslvl);
   $awardstslvl = @implode(',',$awardstslvl);
   $Data['vRFQ2AwardStatusLevel'] = $awardstslvl;
   // prints($Data); exit;
	$Data['dCreatedDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
	$orgprefObj->setAllVar($Data);
	$res = $orgprefObj->insert();

     //INSERT THIS RECORD IN ORGANIZATION_MASTER_TOVERIFY TABLE
     $insID = $gdbobj->getMaxId(PRJ_DB_PREFIX."_organization_default_settings",'iAdditionalInfoID');

     $Data1 = $Data;
     $Data1['iAdditionalInfoID'] = $insID[0]['id'];
     /*foreach($Data1 as $k=>$v) {
        $Data1[$k] = trim($v);
     }*/
     $orgPrefVrfObj->setAllVar($Data1);
     $res = $orgPrefVrfObj->insert();
	  // echo $res; exit;

	 if($res) {
        $orgdtls = $orgObj->select($iOrganizationID);
        if(($orgdtls[0]['eStatus']=='Active' || $orgdtls[0]['eStatus']=='Inactive') && $orgdtls[0]['eNeedToVerify']!='Yes') {
           $rdt['iModifiedByID'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
      	  $rdt['eModifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
      	  $rdt['dModifiedDate'] = $Data['dModifiedDate'];
           $rdt['eStatus'] = 'Modified';
           $drs = $orgObj->updateData($rdt,"iOrganizationID=$iOrganizationID");
           $orgdtls[0]['iModifiedByID'] = $rdt['iModifiedByID'];
           $orgdtls[0]['eModifiedBy'] = $rdt['eModifiedBy'];
           $orgdtls[0]['dModifiedDate'] = $rdt['eModifiedBy'];
           $orgdtls[0]['eStatus'] = 'Modified';
           $org_ndetails = $orgdtls[0];
           $orgvrfObj->setAllVar($org_ndetails);
           $drs = $orgvrfObj->insert($org_ndetails);
        }
		  /*if($orgdtls[0]['eOrganizationType'] == 'Supplier'){
				$opdt['vOrderStatusLevel'] = '';
				$rs = $orgprefObj->updateData($opdt,"iOrganizationID=$iOrganizationID");
		  } else if($orgdtls[0]['eOrganizationType'] == 'Buyer') {
				$opdt['vInvoiceStatusLevel'] = '';
				$rs = $orgprefObj->updateData($opdt,"iOrganizationID=$iOrganizationID");
		  }*/
		  $rs = $orgUserPermObj->clearExtraPermits($iOrganizationID,$orgdtls[0]['eOrganizationType']);
		  // $rs = $orgUserPermObj->clearExPermits($iOrganizationID,$orgdtls[0]['eOrganizationType'],$Data1);
	 }

/*     //INSERT THIS RECORD IN USER_ACTION_VERIFICATION TABLE
	if(count($arr) > 0)
	{
     $where = 'AND vType="New Organization Preference Added" AND eSection = "Member"' ;
     $db_email = $emailObj->getDetails('*',$where);
	  $link = SITE_URL_DUM."organizationprefview/".$iOrganizationID;
     $body = Array("#SMNAME#","#CNAME#","#LINK#","#SITE_NAME#","#REGNO#","#ORGCODE#");
     $post = Array($sname,$cname,$link,$SITE_NAME,$regno,$code);

     $rplarr = Array("Hello #SMNAME#,","background-color: rgb(239, 239, 239);","Regards,","#MAIL_FOOTER#","#SITE_URL#");
     $tbody_en = str_replace($rplarr," ",$db_email[0]['tBody_en']);
     $emailContent_en = trim(str_replace($body,$post, $tbody_en));
     $tbody_fr = str_replace($rplarr," ",$db_email[0]['tBody_fr']);
     $emailContent_fr = trim(str_replace($body,$post, $tbody_fr));
     //prints($emailContent);exit;

     $Data['iItemID']=$res;
     $Data['eSubject']='OA';
     $Data['eType']='Create';
     $Data['vMailSubject_en'] = $db_email[0]['vSub_en'];
     $Data['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
     $Data['tMailContent_en'] = $emailContent_en;
     $Data['tMailContent_fr'] = $emailContent_fr;
     $Data['iCreatedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
     $Data['eCreatedType'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
     $Data['dActionDate']=date("Y-m-d H:i:s");

     // print_r($Data);
     $userActionObj->setAllVar($Data);
     $userActionObj->insert();

//     for($i=0;$i<count($arr);$i++) {
//          $smname = $arr[$i]['vFirstName'].' '.$arr[$i]['vLastName'];
//          $email = $arr[$i]['vEmail'];

          //set the values of the body of email format
//          $body_arr = Array("#SMNAME#","#CNAME#","#LINK#","#SITE_NAME#","#REGNO#","#ORGCODE#","#MAIL_FOOTER#","#SITE_URL#");
//          $post_arr = Array($smname,$cname,$link,$SITE_NAME,$regno,$code,$MAIL_FOOTER,SITE_URL_DUM);

          //send mail to the Admin
//          $sendMail->Send("New Organization Preference Added","Member",$email,$body_arr,$post_arr);
//     }

	}
*/
	if($res) {
	 if($orgdtls[0]['eStatus']=='Need to Verify') {
		  $var_msg = "ras";
	 } else {
		  $var_msg = "rus";
	 }
        $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']=$var_msg;
	} else {
	 if($orgdtls[0]['eStatus']=='Need to Verify') {
		  $var_msg="raserr";
	 } else {
		  $var_msg="ruserr";
	 }
        $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']=$var_msg;
	}
     unset($_POST);
     unset($Data);
     unset($Data1);

	 unset($_SESSION['from']);
    header("Location:".SITE_URL_DUM."organizationlist/".$var_msg);
    exit;
}
?>