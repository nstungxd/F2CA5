<?php
include(S_SECTIONS."/member/memberaccess.php");

if(!isset($orgObj)) {
	require_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
	$orgObj = new Organization();
}
if(!isset($orgGroupObj)) {
    include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationGroup.php");
    $orgGroupObj =	new OrganizationGroup();
}
if(!isset($orgGroupVerifyfObj)) {
    include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationGroupToVerify.php");
    $orgGroupVerifyfObj =	new OrganizationGroupToVerify();
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
if(!isset($orgUserObj)) {
     include_once(SITE_CLASS_APPLICATION."user/class.OrganizationUser.php");
     $orgUsrObj =	new OrganizationUser();
}
if(!isset($statusmasterObj)) {
	include_once(SITE_CLASS_APPLICATION."class.StatusMaster.php");
	$statusmasterObj = new StatusMaster();
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
	$emailarr = array_merge($smdt,$ordt);
}
else if(is_array($smdt)) {
	$emailarr = $smdt;
}
else if(is_array($ordt)) {
	$emailarr = $ordt;
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

if(is_array($sm_dt) && is_array($or_dt)) {
	$emlar = array_merge($sm_dt,$or_dt);
} else if(is_array($sm_dt)) {
	$emlar = $sm_dt;
} else if(is_array($or_dt)) {
	$emlar = $or_dt;
}

$Data = $_POST['Data'];
$view = $_POST['view'];
$iGroupID = $_POST['iGroupID'];
if(is_array($_POST['uid']) && is_array($_POST['tUserID'])) {
   $diffarr = array_diff($_POST['uid'], $_POST['tUserID']);
   $grpdata = $orgGroupObj->getDetails('tUserID','AND iGroupID="'.$iGroupID.'"');
   foreach($diffarr as $key=>$val) {
      if(strpos($grpdata[0]['tUserID'], $val) !== false) {
         $where = "AND tUserID = $val AND iGroupID=$iGroupID";
         $res = $orgGroupObj->del($where);
      }
   }
}

// prints($_POST);exit;
$orgdata = $orgObj->select($Data['iOrganizationID']);
$GNAME = $Data['vGroupName'];
$orgnm = $orgdata[0]['vCompanyName'];
$CODE = $orgdata[0]['vOrganizationCode'];
$Data['eCreatedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];

$tUserIDStr = @implode(',',$_POST['tUserID']);
$Data['tUserID'] = $tUserIDStr;
$Data['iCreatedID'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
$Data['eCreatedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
$Data['dCreatedDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
$Data['vIP'] = $_SERVER['REMOTE_ADDR'];
$Data['dDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');

//if(count($emlar)>0)
	$Data['eStatus'] = 'Need to Verify';
/*else
	$Data['eStatus'] = 'Active';*/

### CHECK MULTIPLE ADMIN AVAILABLE FOR THIS ORGANIZATION OR NOT
/*$chkMulAdmin = $orgObj->ChkMultipleOrgAdmin();
if($chkMulAdmin == '1'){
   $Data['eStatus'] = 'Active';
}else{
//   $Data['eStatus'] = $data['eStatus'];
}*/

## INSERT PERMISSION
$InvoicePermission  =   array();
$OrderPermission    =   array();
$InvoiceAcceptance  =   array();
$OrderAcceptance    =   array();

$invdflts = $statusmasterObj->getDetails('*'," AND eFor='Invoice' AND eType='Default' ");
$podflts = $statusmasterObj->getDetails('*'," AND eFor='PO' AND eType='Default' ");

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

$invdflts_ary = array();
$podflts_ary = array();
for($l=0; $l<count($invdflts); $l++){
	$invdflts_ary[] = $invdflts[$l]['iStatusID'];
}
for($l=0; $l<count($podflts); $l++){
	$podflts_ary[] = $podflts[$l]['iStatusID'];
}

$InvoicePermission = $_POST['InvoicePermission'];
$OrderPermission = $_POST['OrderPermission'];
$OrderAcceptance = $_POST['PoAcpt'];
$InvoiceAcceptance = $_POST['InvoiceAcpt'];
$InvoiceAcceptance[] = $invisusts;
$OrderAcceptance[] = $poisusts;
$InvoicePermission[] = $invacptsts;
$OrderPermission[] = $poacptsts;
//$InvoiceAcceptance[] = $invacptsts;
//$OrderAcceptance[] = $poacptsts;
//$InvoicePermission[] = $invisusts;
//$OrderPermission[] = $poisusts;

$Data['eFormCreation'] = '';
if($_POST['eFormCreationPO']=='Yes') {
	$Data['eFormCreation'] .= 'po';
	$OrderPermission[] = $OrderAcceptance[] = $pocrtsts;
}
if($_POST['eFormCreationInv']=='Yes') {
	$Data['eFormCreation'] .= ',inv';
	$InvoicePermission[] = $InvoiceAcceptance[] = $invcrtsts;
}
$Data['eImportCreation'] = '';
if($_POST['eImportCreationPO']=='Yes') {
	$Data['eImportCreation'] .= 'po';
	$OrderPermission[] = $OrderAcceptance[] = $pocrtsts;
}
if($_POST['eImportCreationInv']=='Yes') {
	$Data['eImportCreation'] .= ',inv';
	$InvoicePermission[] = $InvoiceAcceptance[] = $invcrtsts;
}
$Data['eVerify'] = '';
$pvdtls =  $statusmasterObj->getDetails('*'," AND eFor='PO' AND vStatus_en='Verify' ");
$pvdtls = $pvdtls[0]['iStatusID'];
$ivdtls =  $statusmasterObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Verify' ");
$ivdtls = $ivdtls[0]['iStatusID'];
if($_POST['eVerifyPO']=='Yes') {
	$Data['eVerify'] .= 'pi:ia';
	$OrderPermission[] = $pvdtls;
	$InvoiceAcceptance[] = $ivdtls;
}
if($_POST['eVerifyInv']=='Yes') {
	$Data['eVerify'] .= ',ii:pa';
	$InvoicePermission[] = $ivdtls;
	$OrderAcceptance[] = $pvdtls;
}

$OrderPermission = array_unique($OrderPermission);
$OrderAcceptance = array_unique($OrderAcceptance);
$InvoicePermission = array_unique($InvoicePermission);
$InvoiceAcceptance = array_unique($InvoiceAcceptance);
/*if($_POST['eVerifyPO']=='Yes') {
	$Data['eVerify'] .= 'po';
}
if($_POST['eVerifyInv']=='Yes') {
	$Data['eVerify'] .= ',inv';
}*/

if($_POST['InvoicePermission']){
	$InvoicePermission = array_merge($invdflts_ary,$InvoicePermission);
	$InvoicePermission = array_unique($InvoicePermission);
}
if(is_array($InvoicePermission)) {
	sort($InvoicePermission);
   $InvoicePermission = @implode(',',$InvoicePermission);
}
if($_POST['InvoiceAcpt']) {
	$InvoiceAcceptance = array_merge($invdflts_ary,$InvoiceAcceptance);
	$InvoiceAcceptance = array_unique($InvoiceAcceptance);
}
if(is_array($InvoiceAcceptance)) {
	sort($InvoiceAcceptance);
	$InvoiceAcceptance = @implode(',',$InvoiceAcceptance);
}
if($_POST['OrderPermission']) {
	$OrderPermission = array_merge($podflts_ary,$OrderPermission);
	$OrderPermission = array_unique($OrderPermission);
}
if(is_array($OrderPermission)) {
	sort($OrderPermission);
   $OrderPermission = @implode(',',$OrderPermission);
}
if($_POST['PoAcpt']) {
	$OrderAcceptance = array_merge($podflts_ary,$OrderAcceptance);
	$OrderAcceptance = array_unique($OrderAcceptance);
}
if(is_array($OrderAcceptance)) {
	sort($OrderAcceptance);
   $OrderAcceptance = @implode(',',$OrderAcceptance);
}
$inv = 'inv:'.$InvoicePermission;
$po = ';po:'.$OrderPermission;
$inva = 'inv:'.$InvoiceAcceptance;
$poa = ';po:'.$OrderAcceptance;

/*if($_POST['Invoice']) {
   $Invoice = @implode(',',$_POST['Invoice']);
   $inv = $inv.','.$Invoice;
}
if($_POST['Order']) {
   $Order = @implode(',',$_POST['Order']);
   $po = $po.','.$Order;
}
*/

$newarr = $inv.$po;
$Data['tPermission'] = $newarr;
$newary = $inva.$poa;
$Data['tAcceptancePermit'] = $newary;
$Data['eInvFPO'] = (isset($_POST['eInvFPO']))? $_POST['eInvFPO'] : 'No';

if($view == 'reject')
{
   $dt['eNeedToVerify'] = $dts['eNeedToVerify'] = 'No';
	$dt['eStatus'] = $dts['eStatus'] = "Inactive";
	$usrgrpdtls = $orgGroupObj->getDetails('*'," AND iGroupID=$iGroupID ");
	$grpvrfydt = $orgGroupVerifyfObj->getDetails('*'," AND iGroupID=$iGroupID ",' iVerifiedID DESC ','',' LIMIT 0,1 ');
   if($usrgrpdtls[0]['eStatus']=='Need to Verify')
   {
		$dt['eStatus'] = $dts['eStatus'] = "Inactive";
	} else if($grpvrfydt[0]['eStatus']=='Inactive' && $grpvrfydt[0]['eNeedToVerify']=='Yes') {
		$dt['eNeedToVerify'] = $dts['eNeedToVerify'] = "No";
		$dt['eStatus'] = $dts['eStatus'] = "Active";
	} else if($grpvrfydt[0]['eStatus']=='Active' && $grpvrfydt[0]['eNeedToVerify']=='Yes') {
		$dt['eNeedToVerify'] = $dts['eNeedToVerify'] = "No";
		$dt['eStatus'] = $dts['eStatus'] = "Inactive";
	}
	else if($usrgrpdtls[0]['eStatus']=='Modified')
	{
		$dt['eStatus'] = $dts['eStatus'] = "Active";
		$dts['iModifiedByID'] = "";
		$dts['eModifiedBy'] = "";
	}else if($usrgrpdtls[0]['eStatus']=='Delete'){
	   $dt['eStatus'] = $dts['eStatus'] = "Active";
		$dts['iModifiedByID'] = "";
		$dts['eModifiedBy'] = "";
	}
	$dt['iRejectedById'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
	$dt['eRejectedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
	$dt['tReasonToReject'] = $_POST['tReasonToReject'];
	$dt['dRejectedDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
	$res = $orgGroupObj->updateData($dts," iGroupID=$iGroupID ");
//	$vrfydtls = $orgGroupVerifyfObj->getDetails('*'," AND iGroupID=$iGroupID "," AND dCreatedDate DESC",''," LIMIT 0,1");
	$iVerifiedId = $orgGroupVerifyfObj->getDetails('*'," AND iGroupID=$iGroupID ",' iVerifiedID DESC ','',' LIMIT 0,1 ');
	if(is_array($iVerifiedId) && count($iVerifiedId)>0) {
		$iVerifiedId = $iVerifiedId[0]['iVerifiedID'];
		$rs = $orgGroupVerifyfObj->updateData($dt," iVerifiedId=$iVerifiedId ");
	}
	if($res) {
		$msg = "rus";
	}
	else {
		$msg = "ruserr";
	}
        $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']=$msg;
	header("Location:".SITE_URL_DUM."grouplist/".$msg);
   exit;
}
else if($view == 'verify') {
     $where = " AND iGroupID='".$iGroupID."'";
     $orderby = ' iVerifiedID Desc ';
     $vrfdata=$orgGroupVerifyfObj->getDetails('*',$where,$orderby,'',' LIMIT 0,1 ');
     //prints($vrfdata);exit;
     if($vrfdata[0]['eStatus'] == 'Delete') {
          $where = " AND iGroupID='".$iGroupID."'";
          $res = $orgGroupObj->del($where);
          $data['eStatus'] = 'Active';
			 $dt['iVerifiedByID'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
			 $dt['eVerifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
			 $dt['dVerifiedDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
          $data['vIP'] = $_SERVER['REMOTE_ADDR'];
          $orgGroupVerifyfObj->setAllVar($data);
          $where = "iGroupID IN (".$iGroupID.")";
          $res = $orgGroupVerifyfObj->updateData($data, $where);

          if($res){$var_msg = "rds";}else{$var_msg = "rdserr";}
     } else if($vrfdata[0]['eStatus'] == 'Inactive' || $vrfdata[0]['eStatus'] == 'Active') {
          unset($data);
          if($vrfdata[0]['eStatus'] == 'Inactive')
               $data['eStatus'] = 'Inactive';
          else
               $data['eStatus'] = 'Active';
          $data['eNeedToVerify'] = 'No';
			 $dt['iVerifiedByID'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
			 $dt['eVerifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
			 $dt['dVerifiedDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
          $data['vIP'] = $_SERVER['REMOTE_ADDR'];
          $where = "iGroupID='".$iGroupID."'";
          $res = $orgGroupObj->updateData($data, $where);
          $orgGroupVerifyfObj->setAllVar($data);
          $where = "iGroupID IN (".$iGroupID.")";
          $res = $orgGroupVerifyfObj->updateData($data, $where);

          if($res){$var_msg = "rss";}else{$var_msg = "rsserr";}
     } else {
          $dt['eStatus'] = 'Active';
			 $dt['iVerifiedByID'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
			 $dt['eVerifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
			 $dt['dVerifiedDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
          $dt['vIP'] = $_SERVER['REMOTE_ADDR'];
			if($vrfdata[0]['iVerifiedID'] > 0) {
          $orgGroupVerifyfObj->setAllVar($dt);
          $where= " iVerifiedID='".$vrfdata[0]['iVerifiedID']."'";
          $iVerifiedID=$orgGroupVerifyfObj->updateData($dt,$where);
			}
			 if($iVerifiedID) {
               $where = " AND iVerifiedID='".$vrfdata[0]['iVerifiedID']."'";
               $updtdata=$orgGroupVerifyfObj->getDetails('*',$where);
               $vdt = $updtdata[0];
               unset($vdt['iVerifiedID']);
               unset($vdt['iGroupID']);
               $where= " iGroupID='".$vrfdata[0]['iGroupID']."'";
               $res=$orgGroupObj->updateData($vdt,$where);

               if($res){$var_msg = "rvs";}else{$var_msg = "rvserr";}
          }
     }

          $udt['eVerifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
          $udt['iVerifiedBy'] = $sess_id;
          $udt['dVerifyDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
          $udt['vVerifyFromIP'] = $_SERVER['REMOTE_ADDR'];
          $userActionObj->setAllVar($udt);
          $where= " iItemID='".$vrfdata[0]['iVerifiedID']."' AND eSubject = 'Group'";
          $res=$userActionObj->updateData($udt,$where);
          unset($udt);
          unset($vdt);
          unset($dt);
}
else if($view == 'edit') {
     include(SITE_CLASS_GEN."class.validation.php");
     $validation=new Validation();
     $RequiredFiledArr = array(
			'iOrganizationID'       =>$smarty->get_template_vars('LBL_SELECT_ONE_ORG'),
			'vGroupName'       =>$smarty->get_template_vars('LBL_ENTER_GROUP_NAME')
      );

	 $resArr = $validation->isEmpty($RequiredFiledArr);
         $extVal=$Data['iOrganizationID'];
         if(trim($extVal) != '')
         {
             $extVal=" AND iOrganizationID=$extVal";
         }
         //prints($_POST);
         //exit;
         $DupGroupName = $validation->ChekDupGroupName($_POST['iGroupID'],'vGroupName',PRJ_DB_PREFIX."_organization_group",$Data['vGroupName'],$smarty->get_template_vars('LBL_GROUP_NAME_TAKEN'),$extVal);

	 if($resArr || $DupGroupName) {
		   header("Location:".$_SERVER['HTTP_REFERER']."");
		 exit;
	 }
        // exit;
//prints($emailarr); exit;
    ## UPDATE STATUS INTO MAIN TABLE
	// if(count($emlar)>0) {
		$adata['eStatus'] = 'Modified';
	/*} else {
		$adata = $Data;
		$adata['eStatus'] = 'Active';
	}
   if($chkMulAdmin == '1'){
      $adata['eStatus'] = 'Active';
   }else{
      $adata['eStatus'] = $adata['eStatus'];
   }*/
   //
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
   //
   // $rfq2awardstsdflvl = $statusmasterObj->getDetails('iStatusID'," AND vForAuction Like '%RFQ2 Award,%' AND (eType='Default' OR vStatus_en IN ('Create','Verify')) ");
	$rfq2awardstsdflvl = $statusmasterObj->getDetails('iStatusID'," AND vForAuction Like '%RFQ2 Award,%' AND vStatus_en IN ('Rejected') "); 	// 'Create','Verify'
   $rfq2awardstsdflvl = multi21Array($rfq2awardstsdflvl,'iStatusID');
   if(isset($_POST['eRfq2Award']) && is_array($_POST['eRfq2Award']) && count($_POST['eRfq2Award'])>0) {
      $rfq2awardstsdflvl = array_merge($rfq2awardstsdflvl,$_POST['eRfq2Award']);
   }
   @ sort($rfq2awardstsdflvl);
   if(count($rfq2awardstsdflvl)>0) {
      $rfq2awardstsdflvl = @implode(',',$rfq2awardstsdflvl);
   } else { $rfq2awardstsdflvl = ''; }
   //
   $Data['vRFQ2AwardPermits'] = $rfq2awardstsdflvl;
   if(is_array($_POST['eRfq2']) && count($_POST['eRfq2'])>0) {
      $Data['vRFQ2Permits'] = @implode(',',$_POST['eRfq2']);
   }
   //
	  $adata['iModifiedByID'] = $Data['iModifiedByID'] = $sess_id;
	  $adata['eModifiedBy'] = $Data['eModifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
	  $adata['dModifiedDate'] = $Data['dModifiedDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
     $orgGroupObj->setAllVar($adata);
     $where = " iGroupID = '$iGroupID'";
     $res = $orgGroupObj->updateData($adata, $where);

    ## UPDATE INTO VERIFY TABLE
    $Data_verify = $Data;
    // prints($Data_verify); exit;
    $Data_verify['iGroupID'] = $iGroupID;
	 //if(count($emlar)>0)
		$Data_verify['eStatus'] = 'Modified';
	 /*else
		$Data_verify['eStatus'] = 'Active';*/
    $orgGroupVerifyfObj->setAllVar($Data_verify);
    $vrfres = $orgGroupVerifyfObj->insert();

//     $where = 'AND iSMID != '.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'].' AND eStatus = "Active" AND eEmailNotification="Yes" ';
//     $smdtls = $secManObj->getDetails('*',$where);
     // ---------------------
	if(count($emailarr)>0)
	{
     $where = 'AND vType="Group Updated" AND eSection = "Member"' ;
     $db_email = $emailObj->getDetails('*',$where);
	  $link = SITE_URL_DUM."groupview/".$iGroupID;
     $body = Array("#GNAME#","#ORGNAME#","#CODE#","#LINK#","#MODIFIED_BY#");
     $post = Array($GNAME,$orgnm,$CODE,$link,$sess_user_name."($sess_usertype_short)");

     $rplarr = Array("Hello #SMNAME#,","background-color: rgb(239, 239, 239);","Regards,","#MAIL_FOOTER#","#SITE_URL#");
     $tbody_en = str_replace($rplarr," ",$db_email[0]['tBody_en']);
     $emailContent_en = trim(str_replace($body,$post, $tbody_en));
     $tbody_fr = str_replace($rplarr," ",$db_email[0]['tBody_fr']);
     $emailContent_fr = trim(str_replace($body,$post, $tbody_fr));
     // prints($emailContent);exit;

     $Data['iItemID']=$vrfres;
     $Data['eSubject']='Group';
     $Data['eType']='Modified';
     $Data['vMailSubject_en'] = $db_email[0]['vSub_en'];
     $Data['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
     $Data['tMailContent_en'] = $emailContent_en;
     $Data['tMailContent_fr'] = $emailContent_fr;
     $Data['iCreatedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
     $Data['eCreatedType'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
     $Data['dActionDate']= calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');

     ## INSERT INTO USER ACTION TABLE
     $userActionObj->setAllVar($Data);
     $userActionObj->insert();

     for($i=0;$i<count($emailarr);$i++)
     {
		  $smname = $emailarr[$i]['vFirstName'].' '.$emailarr[$i]['vLastName'];
		  $email = $emailarr[$i]['vEmail'];
		  $body_arr = Array("#SMNAME#","#GNAME#","#ORGNAME#","#CODE#","#LINK#","#MODIFIED_BY#","#MAIL_FOOTER#","#SITE_URL#");
		  $post_arr = Array($smname,$GNAME,$orgnm,$CODE,$link,$sess_user_name."($sess_usertype_short)",$MAIL_FOOTER,SITE_URL_DUM);
		  $sendMail->Send("Group Updated","Member",$email,$body_arr,$post_arr);
     }
	}
     unset($Data);
     unset($_POST);
     if($res) $var_msg="rus";else $var_msg="ruserr";
}
else {
     include(SITE_CLASS_GEN."class.validation.php");
     $validation=new Validation();
     $RequiredFiledArr = array(
				'iOrganizationID'  =>$smarty->get_template_vars('LBL_SELECT_ONE_ORG'),
				'vGroupName'       =>$smarty->get_template_vars('LBL_ENTER_GROUP_NAME')
			);

	$resArr = $validation->isEmpty($RequiredFiledArr);
	$DupGroupName = $validation->ChekDupGroupName($id,'vGroupName',PRJ_DB_PREFIX."_organization_group",$Data['vGroupName'],$smarty->get_template_vars('LBL_GROUP_NAME_TAKEN'));

	 if($resArr || $DupGroupName) {
		header("Location:".$_SERVER['HTTP_REFERER']."");
		exit;
	 }

    ## INSERT INTO MAIN TABLE
    //if(count($emlar)>0) {
		$Data['eStatus'] = 'Need to Verify';
	/*} else {
		$Data['eStatus'] = 'Active';
	}
   if($chkMulAdmin == '1'){
      $Data['eStatus'] = 'Active';
   }else{
      // $Data['eStatus'] = $Data['eStatus'];
   }*/
   //
   $rfq2awardacptstsdflvl = $statusmasterObj->getDetails('iStatusID'," AND vStatus_en IN ('Verify','Rejected') AND vForAuction LIKE '%RFQ2 Award Acceptance%' ",'','');
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
   $rfq2awardstsdflvl = $statusmasterObj->getDetails('iStatusID'," AND vForAuction Like '%RFQ2 Award,%' AND (eType='Default' OR vStatus_en IN ('Create','Verify')) ");
   $rfq2awardstsdflvl = multi21Array($rfq2awardstsdflvl,'iStatusID');
   if(isset($_POST['eRfq2Award']) && is_array($_POST['eRfq2Award']) && count($_POST['eRfq2Award'])>0) {
      $rfq2awardstsdflvl = array_merge($rfq2awardstsdflvl,$_POST['eRfq2Award']);
   }
   @ sort($rfq2awardstsdflvl);
   if(count($rfq2awardstsdflvl)>0) {
      $rfq2awardstsdflvl = @implode(',',$rfq2awardstsdflvl);
   } else { $rfq2awardstsdflvl = ''; }
   //
   $Data['vRFQ2AwardPermits'] = $rfq2awardstsdflvl;
   if(is_array($_POST['eRfq2']) && count($_POST['eRfq2'])>0) {
      $Data['vRFQ2Permits'] = @implode(',',$_POST['eRfq2']);
   }
   //
   // pr($Data); exit;
	$Data['dCreatedDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
   $orgGroupObj->setAllVar($Data);

    //print "<pre>";
    //print_r($Data);
   // exit;
    $res = $orgGroupObj->insert();

    ## INSERT INTO VERIFY TABLE
    $Data_verify = $Data;
    $Data_verify['iGroupID'] = $res;

    $orgGroupVerifyfObj->setAllVar($Data_verify);
    $vrfres = $orgGroupVerifyfObj->insert();
   //Prints($emailarr);exit();
//     $where = 'AND iSMID != '.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'].' AND eStatus = "Active" AND eEmailNotification="Yes" ';
//     $smdtls = $secManObj->getDetails('*',$where);
     // ---------------------

   if(count($emailarr)>0) {
     $where = 'AND vType="New Group Created" AND eSection = "Member"' ;
     $db_email = $emailObj->getDetails('*',$where);
	  $link = SITE_URL_DUM."groupview/".$Data_verify['iGroupID'];
     $body = Array("#GNAME#","#ORGNAME#","#CODE#","#LINK#","#ADDED_BY#");
     $post = Array($GNAME,$orgnm,$CODE,$link,$sess_user_name."($sess_usertype_short)");

     $rplarr = Array("Hello #SMNAME#,","background-color: rgb(239, 239, 239);","Regards,","#MAIL_FOOTER#","#SITE_URL#");
     $tbody_en = str_replace($rplarr," ",$db_email[0]['tBody_en']);
     $emailContent_en = trim(str_replace($body,$post, $tbody_en));
     $tbody_fr = str_replace($rplarr," ",$db_email[0]['tBody_fr']);
     $emailContent_fr = trim(str_replace($body,$post, $tbody_fr));
     // prints($emailContent);exit;

     $Data['iItemID']=$vrfres;
     $Data['eSubject']='Group';
     $Data['eType']='Create';
     $Data['vMailSubject_en'] = $db_email[0]['vSub_en'];
     $Data['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
     $Data['tMailContent_en'] = $emailContent_en;
     $Data['tMailContent_fr'] = $emailContent_fr;
     $Data['iCreatedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
     $Data['eCreatedType'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
     $Data['dActionDate']= calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');

     ## INSERT INTO USER ACTION TABLE
     $userActionObj->setAllVar($Data);
     $userActionObj->insert();

     for($i=0;$i<count($emailarr);$i++)
     {
         $smname = $emailarr[$i]['vFirstName'].' '.$emailarr[$i]['vLastName'];
         $email = $emailarr[$i]['vEmail'];
         $body_arr = Array("#SMNAME#","#GNAME#","#ORGNAME#","#CODE#","#LINK#","#ADDED_BY#","#MAIL_FOOTER#","#SITE_URL#");
         $post_arr = Array($smname,$GNAME,$orgnm,$CODE,$link,$sess_user_name."($sess_usertype_short)",$MAIL_FOOTER,SITE_URL_DUM);
         $sendMail->Send("New Group Created","Member",$email,$body_arr,$post_arr);
     }
	}
     unset($Data);
     unset($_POST);
     if($res) $var_msg="ras";else $var_msg="raserr";
}
unset($Data);
unset($_POST);
$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']=$var_msg;
header('Location:'.SITE_URL_DUM.'grouplist/'.$var_msg);
exit;
?>