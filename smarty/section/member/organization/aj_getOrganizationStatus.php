<?php
/**
 * @author hidden
 * @copyright 2010
 */

include(S_SECTIONS."/member/memberaccess.php");

if(!isset($orgObj)) {
   include_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
   $orgObj =	new Organization();
}
if(!isset($orgPerObj)) {
	require_once(SITE_CLASS_APPLICATION."organization/class.OrganizationPermission.php");
	$orgPerObj = new OrganizationPermission;
	//$sess_id
}
if(!isset($orgStaObj)) {
	require_once(SITE_CLASS_APPLICATION."class.StatusMaster.php");
	$orgStaObj = new StatusMaster;
	//$sess_id
}
if(!isset($orgUserPerObj)) {
   require_once(SITE_CLASS_APPLICATION."user/class.OrganizationUserPermission.php");
   $orgUserPerObj = new OrganizationUserPermission();
}
if(!isset($orgPrefObj)) {
	require_once(SITE_CLASS_APPLICATION."organization/class.OrganizationPreference.php");
	$orgPrefObj = new OrganizationPreference;
	//$sess_id
}
if(!isset($orgGroupObj)) {
    include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationGroup.php");
    $orgGroupObj =	new OrganizationGroup();
}
if(!isset($orgGroupVerifyfObj)) {
    include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationGroupToVerify.php");
    $orgGroupVerifyfObj =	new OrganizationGroupToVerify();
}

$stslvl = array();
$key = (isset($_GET['q']))? $_GET['q'] : '';
$fromtype = (isset($_GET['fromtype']))? $_GET['fromtype'] : '';
$type = $_GET['type'];
$iId = $_GET['iId'];
$prms = $_GET['prms'];
$acpt = $_GET['acpt'];
$grpid = $_GET['grpid'];
$prmsarr = @explode(',',$prms);

$grpdt = array();
if(trim($grpid)!='' && is_numeric($grpid) && $grpid>0) {
   $grpdt = $orgGroupObj->select($grpid);
}
$view = (isset($view))? $view : '';
$ores = array();
if(trim($view) == 'undefined' || trim($view) == '') {
	$ores = $orgPrefObj->getDetails('*'," AND iOrganizationId=".$iId);
   $orgdtl = $orgObj->select($iId);
	$orgtype = $orgdtl[0]['eOrganizationType'];
}
if($orgtype=='Buyer2') {
   include_once('aj_getB2OrgStatus.php');
}
// prints($ores); exit;
//
$ecreate = array();
$eimport = array();
$everify = array();
$grpdt[0]['eFormCreation'] = (isset($grpdt[0]['eFormCreation']))? $grpdt[0]['eFormCreation'] : '';
if(strpos($grpdt[0]['eFormCreation'],'po')!==false) {
//	$ecreate['po'] = 'Yes';
	$ecreate['po'] = "checked='checked'";
}
if(strpos($grpdt[0]['eFormCreation'],'inv')!==false) {
//	$ecreate['inv'] = 'Yes';
   $ecreate['inv'] = "checked='checked'";
}
$grpdt[0]['eImportCreation'] = (isset($grpdt[0]['eImportCreation']))? $grpdt[0]['eImportCreation'] : '';
if(strpos($grpdt[0]['eImportCreation'],'po')!==false) {
	// $eimport['po'] = 'Yes';
	$eimport['po'] = "checked='checked'";
}
if(strpos($grpdt[0]['eImportCreation'],'inv')!==false) {
//	$eimport['inv'] = 'Yes';
	$eimport['inv'] = "checked='checked'";
}
$grpdt[0]['eVerify'] = (isset($grpdt[0]['eVerify']))? $grpdt[0]['eVerify'] : '';
if(strpos($grpdt[0]['eVerify'],'pi:ia')!==false) {
//	$everify['po'] = 'Yes';
   $everify['po'] = "checked='checked'";
}
if(strpos($grpdt[0]['eVerify'],'ii:pa')!==false) {
//	$everify['inv'] = 'Yes';
   $everify['inv'] = "checked='checked'";
}
// prints($grpdt); exit;

// prints($prmts); exit;
$stslvl = $prms;
$aptlvl = $acpt;

$poUserStatus = array();
$poUserAcpt = array();
$invUserStatus = array();
$invUserAcpt = array();
$invacptsts = Array();

// if(is_array($stslvl) && count($stslvl) > 0){
if(trim($stslvl)!='' && strpos($stslvl,';')!==false) {
    $stslvl = @explode(';',$stslvl);
    $invUserStatus = str_replace('inv:','',($stslvl[0]));
    $poUserStatus = str_replace('po:','',($stslvl[1]));
}

// if(is_array($aptlvl) && count($aptlvl) > 0){
if(trim($aptlvl) && strpos($aptlvl,';')!==false){
    $aptlvl = @explode(';',$aptlvl);
    $invUserAcpt = str_replace('inv:','',($aptlvl[0]));
    $poUserAcpt = str_replace('po:','',($aptlvl[1]));
}

$invUserStatus = @explode(',',$invUserStatus);
$invUserAcpt = @explode(',',$invUserAcpt);
$poUserStatus = @explode(',',$poUserStatus);
$poUserAcpt = @explode(',',$poUserAcpt);

// $where = " AND iGroupID = '".$iId."'";
// $res = $orgPerObj->getDetails('iGroupID,iStatusID,ePermissionType,iPermissionID as Id',$where);
$orderStatus = $invoiceStatus = array();
$res = array();

if($fromtype == 'user') {
	$where = " AND iUserID = '".$iId."'";
	$res = $orgUserPerObj->getDetails('*',$where);
	$orgdtl = $orgObj->select($res[0]['iOrganizationID']);
	$orgtype = $orgdtl[0]['eOrganizationType'];

	$permission = @explode(';',$res[0]['tPermission']);
	$inv = @explode('inv:',$permission[0]);
	$po = @explode('po:',$permission[1]);
	$res[0]['vInvoiceStatusLevel'] = $inv[1];
	$res[0]['vOrderStatusLevel'] = $po[1];
} else {
	$where = " AND iOrganizationID = '".$iId."'";
	$res = $orgPrefObj->getDetails('iOrganizationID,vOrderStatusLevel,vInvoiceStatusLevel,vOrderAcceptanceLevel,vInvoiceAcceptanceLevel,iAdditionalInfoID as Id',$where);
	$orgdtl = $orgObj->select($iId);
	$orgtype = $orgdtl[0]['eOrganizationType'];
}

$res[0]['vOrderStatusLevel'] = (isset($res[0]['vOrderStatusLevel']))? $res[0]['vOrderStatusLevel'] : '';
$res[0]['vInvoiceAcceptanceLevel'] = (isset($res[0]['vInvoiceAcceptanceLevel']))? $res[0]['vInvoiceAcceptanceLevel'] : '';
$res[0]['vInvoiceStatusLevel'] = (isset($res[0]['vInvoiceStatusLevel']))? $res[0]['vInvoiceStatusLevel'] : '';
$res[0]['vOrderAcceptanceLevel'] = (isset($res[0]['vOrderAcceptanceLevel']))? $res[0]['vOrderAcceptanceLevel'] : '';
if(trim($res[0]['vOrderStatusLevel']) != '') {
	$orderStatus = @explode(',',$res[0]['vOrderStatusLevel']);
} else {
	$orderStatus =array();
}
// pr($orderStatus); exit;
if(trim($res[0]['vInvoiceAcceptanceLevel']) != '') {
	$invacptStatus = @explode(',',$res[0]['vInvoiceAcceptanceLevel']);
} else {
	$invacptStatus =array();
}
if(trim($res[0]['vInvoiceStatusLevel']) != '') {
	$invoiceStatus = @explode(',',$res[0]['vInvoiceStatusLevel']);
} else {
	$invoiceStatus =array();
}
if(trim($res[0]['vOrderAcceptanceLevel']) != '') {
	$ordacptStatus = @explode(',',$res[0]['vOrderAcceptanceLevel']);
} else {
	$ordacptStatus = array();
}
// prints($ordacptStatus); exit;
//
$rfq2awardsts = $orgStaObj->getDetails('vStatus_'.LANG.' as title,vStatusMsg_'.LANG.',iStatusID as Id,eFor,eType,vStatusMsg_en as msg,vStatus_en as status'," AND vStatus_en NOT IN ('Create','Verify','Accepted','Rejected') AND eType='Optional' AND vForAuction LIKE '%RFQ2 Award,%' ",'','');
// prints($rfq2awardacceptsts); exit;
$codsts = $orgStaObj->getDetails('vStatus_'.LANG.' as title,vStatusMsg_'.LANG.',iStatusID as Id,eFor,eType,vStatusMsg_en as msg,vStatus_en as status'," AND vStatus_en='Create' AND vForAuction!='' ",'','');
$vodsts = $orgStaObj->getDetails('vStatus_'.LANG.' as title,vStatusMsg_'.LANG.',iStatusID as Id,eFor,eType,vStatusMsg_en as msg,vStatus_en as status'," AND vStatus_en='Verify' AND vForAuction!='' ",'','');
$aodsts = $orgStaObj->getDetails('vStatus_'.LANG.' as title,vStatusMsg_'.LANG.',iStatusID as Id,eFor,eType,vStatusMsg_en as msg,vStatus_en as status'," AND vStatus_en='Accepted' AND vForAuction!='' ",'','');
$rodsts = $orgStaObj->getDetails('vStatus_'.LANG.' as title,vStatusMsg_'.LANG.',iStatusID as Id,eFor,eType,vStatusMsg_en as msg,vStatus_en as status'," AND vStatus_en='Rejected' AND vForAuction!='' ",'','');
//
$org_rfq2AwardStatus = array();
if(trim($ores[0]['vRFQ2AwardStatusLevel'])!='') {
   $org_rfq2AwardStatus = @explode(',', $ores[0]['vRFQ2AwardStatusLevel']);
}
//
$urfq2 = array();
$urfq2awrd = array();
if(is_array($grpdt) && count($grpdt)>0) {
   if(trim($grpdt[0]['vRFQ2Permits'])!='') {
      $urfq2 = @explode(',',$grpdt[0]['vRFQ2Permits']);
   }
   if(trim($grpdt[0]['vRFQ2AwardPermits'])!='') {
      $urfq2awrd = @explode(',',$grpdt[0]['vRFQ2AwardPermits']);
   }
}
//
$where = " AND vStatus_en!='Verify' ";
$status = $orgStaObj->getDetails('vStatus_'.LANG.' as title,vStatusMsg_'.LANG.',iStatusID as Id,eFor,eType,vStatusMsg_en as msg,vStatus_en as status',$where,'iDisplayOrder','');
// prints($status);exit;
// b2b_organization_default_settings

$html = (isset($html))? $html : '';
$dis = (isset($dis))? $dis : '';
$ecreate['po'] = (isset($ecreate['po']))? $ecreate['po'] : '';
$eimport['po'] = (isset($eimport['po']))? $eimport['po'] : '';
$everify['po'] = (isset($everify['po']))? $everify['po'] : '';
$invacptsts[0]['Id'] = (isset($invacptsts[0]['Id']))? $invacptsts[0]['Id'] : '';
$ecreate['inv'] = (isset($ecreate['inv']))? $ecreate['inv'] : '';
$eimport['inv'] = (isset($eimport['inv']))? $eimport['inv'] : '';
$everify['inv'] = (isset($everify['inv']))? $everify['inv'] : '';
$ores[0]['eCreateMethodAllowedPO'] = (isset($ores[0]['eCreateMethodAllowedPO']))? $ores[0]['eCreateMethodAllowedPO'] : '';
$ores[0]['eReqVerificationPo'] = (isset($ores[0]['eReqVerificationPo']))? $ores[0]['eReqVerificationPo'] : '';
$ores[0]['eReqVerifyInvAcpt'] = (isset($ores[0]['eReqVerifyInvAcpt']))? $ores[0]['eReqVerifyInvAcpt'] : '';

if(count($status) > 0) {
if($orgtype != 'Supplier') {
/*	$html .= "<div style='width:550px;'>
					<div><b><u>Buyer Rights</u>:</b></div>
					<div><lable class=''>PO Creation:</lable><label style='display:inline-block; width:37px;'>&nbsp;</label>
					&nbsp;<label style='display:inline-block; width:205px;'>&nbsp;<input type='checkbox' name='eFormCreationPO' id='eFormCreationPO' value='Yes' ".$ecreate['po']." />&nbsp;Free-Form Creation</label>
					&nbsp;<label style='display:inline-block; width:100px;'>&nbsp;<input type='checkbox' name='eImportCreationPO' id='eImportCreationPO' value='Yes' ".$eimport['po']." />&nbsp;Import</label>
					&nbsp;<label>&nbsp;<input type='checkbox' name='eVerifyPO' id='eVerifyPO' value='Yes' ".$everify['po']." />&nbsp;Verify</label></div>
					<div><lable class=''>PO Issuance:</lable><label style='display:inline-block; width:35px;'>&nbsp;</label>";
*/
	 $html .= "<div style='width:550px;'>
					<div><b><u>Buyer Rights</u>:</b></div>
					<div><lable class=''>PO Creation:</lable><label style='display:inline-block; width:39px;'>&nbsp;</label>";
	 if($ores[0]['eCreateMethodAllowedPO']=='Free form' || $ores[0]['eCreateMethodAllowedPO']=='Both') {
	    $html .= "&nbsp;<label style='display:inline-block; width:209px;'>&nbsp;<input type='checkbox' name='eFormCreationPO' id='eFormCreationPO' value='Yes' ".$ecreate['po']." $dis />&nbsp;Free-Form Creation</label>";
	 }
	 if($ores[0]['eCreateMethodAllowedPO']=='File Import' || $ores[0]['eCreateMethodAllowedPO']=='Both') {
	    $html .= "&nbsp;<label style='display:inline-block; width:103px;'>&nbsp;<input type='checkbox' name='eImportCreationPO' id='eImportCreationPO' value='Yes' ".$eimport['po']." $dis />&nbsp;Import</label>";
	 }
	 if($ores[0]['eReqVerificationPo']=='Yes' || $ores[0]['eReqVerifyInvAcpt']=='Yes') {
	    $html .= "&nbsp;<label>&nbsp;<input type='checkbox' name='eVerifyPO' id='eVerifyPO' value='Yes' ".$everify['po']." $dis />&nbsp;Verify</label>";
	 }
	 $html .= "</div>";
	 $html .= "<div style='width:550px;'><lable class=''>PO Issuance:</lable><label style='display:inline-block; width:35px;'>&nbsp;</label>";
	 for($l=0; $l<count($status); $l++)
	{
		$chk = '';
		if($status[$l]['eFor']=='PO' && $status[$l]['eType']=='Optional' && in_array($status[$l]['Id'],$orderStatus) && $status[$l]['status']!='Create' && $status[$l]['status']!='Accepted') {
			if(in_array($status[$l]['Id'],$poUserStatus)) {
				$chk = "checked='checked'";
			}
			$html .= "&nbsp;<label class='' style='display:inline-block; width:100px;'>&nbsp;<input type='checkbox' name='OrderPermission[".$status[$l]['Id']."]' id='ordpermission_".$status[$l]['Id']."' $dis $chk value='".$status[$l]['Id']."' />&nbsp;".$status[$l]['title']."&nbsp;</label>&nbsp;";
		}
	}
	$html .= "</div>";
}
if($orgtype != 'Supplier') {
	$html .= "<div><lable class=''>Invoice Acceptance:</lable><label style='display:inline-block; width:2px;'>&nbsp;</label>";
	if(in_array($invacptsts[0]['Id'],$invUserAcpt)) {
	   $chk = "checked='checked'";
	}
	$html .= "&nbsp;<label class='' style='display:inline-block; width:100px;'>&nbsp;<input type='checkbox' name='InvoiceAcpt[".$invacptsts[0]['Id']."]' id='invacpt_".$invacptsts[0]['Id']."' $dis $chk value='".$invacptsts[0]['Id']."' />&nbsp;".$smarty->get_template_vars('LBL_ACCEPT')."&nbsp;</label>&nbsp;"; 	// $invacptsts[0]['title']
	for($l=0; $l<count($status); $l++)
	{
		$chk = '';
		if($status[$l]['eFor']=='Invoice' && $status[$l]['eType']=='Optional' && in_array($status[$l]['Id'],$invacptStatus) && $status[$l]['status']!='Create' && $status[$l]['status']!='Accepted' && $status[$l]['status']!='Issue') {
			if(in_array($status[$l]['Id'],$invUserAcpt)) {
				$chk = "checked='checked'";
			}
			$html .= "&nbsp;<label class='' style='display:inline-block; width:100px;'>&nbsp;<input type='checkbox' name='InvoiceAcpt[".$status[$l]['Id']."]' id='invacpt_".$status[$l]['Id']."' $dis $chk value='".$status[$l]['Id']."' />&nbsp;".$status[$l]['title']."&nbsp;</label>&nbsp;";
		}
	}
	$html .= "<div>&nbsp;</div>";
	if(isset($ENABLE_AUCTION) && $ENABLE_AUCTION=='Yes') {
	   $ipochk = (isset($grpdt[0]['eInvFPO']) && $grpdt[0]['eInvFPO']=='Yes')? "checked='checked'" : "";
	   $html .= "<div>".stripslashes($smarty->get_template_vars('LBL_INVOICE_FROM_PO_SUPPLIER_ONBEHALF'))." : <label class='' style='display:inline-block; width:100px;'>&nbsp;<input type='checkbox' name='eInvFPO' id='eInvFPO' value='Yes' $ipochk />&nbsp;Create&nbsp;</label> </div>";
	}
	$html .= "</div>";
}
$html .= "</div>";
$html .= "<div>&nbsp;</div>";
if($orgtype != 'Buyer') {
/*	$html .= "<div style='width:550px;'>
					<div><b><u >Supplier Rights</u>:</b></div>
					<div><lable class=''>Invoice Creation:</lable><label style='display:inline-block; width:15px;'>&nbsp;</label>
					&nbsp;<label style='display:inline-block; width:205px;'>&nbsp;<input type='checkbox' name='eFormCreationInv' id='eFormCreationInv' value='Yes' ".$ecreate['inv']." />&nbsp;Free-Form Creation</label>
					&nbsp;<label style='display:inline-block; width:100px;'>&nbsp;<input type='checkbox' name='eImportCreationInv' id='eImportCreationInv' value='Yes' ".$eimport['inv']." />&nbsp;Import</label>
					&nbsp;<label>&nbsp;<input type='checkbox' name='eVerifyInv' id='eVerifyInv' value='Yes' ".$everify['inv']." />&nbsp;Verify</label>
					<div><lable class=''>Invoice Issuance:</lable><label style='display:inline-block; width:13px;'>&nbsp;</label>";
*/
	 $html .= "<div style='width:550px;'>
					<div><b><u >Supplier Rights</u>:</b></div>
					<div><lable class=''>Invoice Creation:</lable><label style='display:inline-block; width:17px;'>&nbsp;</label>";
	 if($ores[0]['eCreateMethodAllowedInv']=='Free form' || $ores[0]['eCreateMethodAllowedInv']=='Both') {
	    $html .= "&nbsp;<label style='display:inline-block; width:209px;'>&nbsp;<input type='checkbox' name='eFormCreationInv' id='eFormCreationInv' value='Yes' ".$ecreate['inv']." $dis />&nbsp;Free-Form Creation</label>";
	 }
	 if($ores[0]['eCreateMethodAllowedInv']=='File Import' || $ores[0]['eCreateMethodAllowedInv']=='Both') {
	    $html .= "&nbsp;<label style='display:inline-block; width:103px;'>&nbsp;<input type='checkbox' name='eImportCreationInv' id='eImportCreationInv' value='Yes' ".$eimport['inv']." $dis />&nbsp;Import</label>";
	 }
	 if($ores[0]['eReqVerificationInv']=='Yes' || $ores[0]['eReqVerifyPoAcpt']=='Yes') {
	    $html .= "&nbsp;<label>&nbsp;<input type='checkbox' name='eVerifyInv' id='eVerifyInv' value='Yes' ".$everify['inv']." $dis />&nbsp;Verify</label>";
	 }
	 $html .= "</div>";
	 $html .= "<div style='width:550px;'><lable class=''>Invoice Issuance:</lable><label style='display:inline-block; width:13px;'>&nbsp;</label>";
	 for($l=0; $l<count($status); $l++)
	{
		$chk = '';
		if($status[$l]['eFor']=='Invoice' && $status[$l]['eType']=='Optional' && in_array($status[$l]['Id'],$invoiceStatus) && $status[$l]['status']!='Create' && $status[$l]['status']!='Accepted') {
			if(in_array($status[$l]['Id'],$invUserStatus)) {
				$chk = "checked='checked'";
			}
			$html .="&nbsp;<label class='' style='display:inline-block; width:100px;'>&nbsp;<input type='checkbox' name='InvoicePermission[".$status[$l]['Id']."]' id='invpermission_".$status[$l]['Id']."' $dis $chk value='".$status[$l]['Id']."' />&nbsp;".$status[$l]['title']."&nbsp;</label>&nbsp;";
		}
	}
	$html .= "</div>";
}

$poacptsts[0]['Id'] = (isset($poacptsts[0]['Id']))? $poacptsts[0]['Id'] : '';
if($orgtype != 'Buyer') {
	$html .= "<div><lable class=''>PO Acceptance:</lable><label style='display:inline-block; width:22px;'>&nbsp;</label>";
	if(in_array($poacptsts[0]['Id'],$poUserAcpt)) {
	   $chk = "checked='checked'";
	}
	$html .= "&nbsp;<label class='' style='display:inline-block; width:100px;'>&nbsp;<input type='checkbox' name='PoAcpt[".$poacptsts[0]['Id']."]' id='poacpt_".$poacptsts[0]['Id']."' $dis $chk value='".$poacptsts[0]['Id']."' />&nbsp;".$smarty->get_template_vars('LBL_ACCEPT')."&nbsp;</label>&nbsp;"; 	// $poacptsts[0]['title']
	for($l=0; $l<count($status); $l++)
	{
		$chk = '';
		if($status[$l]['eFor']=='PO' && $status[$l]['eType']=='Optional' && in_array($status[$l]['Id'],$ordacptStatus) && $status[$l]['status']!='Create' && $status[$l]['status']!='Issue' && $status[$l]['status']!='Accepted') {
			if(in_array($status[$l]['Id'],$poUserAcpt)) {
				$chk = "checked='checked'";
			}
			$html .= "&nbsp;<label class='' style='display:inline-block; width:100px;'>&nbsp;<input type='checkbox' name='PoAcpt[".$status[$l]['Id']."]' id='poacpt_".$status[$l]['Id']."' $dis $chk value='".$status[$l]['Id']."' />&nbsp;".$status[$l]['title']."</label>&nbsp;";
		}
	}
	$html .= "</div>";
}
// $html .= "</div>";
if($orgtype!='Buyer2' && $ENABLE_AUCTION=='Yes') {
	$html .= "<div>&nbsp;</div>";
   $html .= "<div style='width:700px;'>
					<div><b><u>RFQ2 Rights</u>:</b></div>
					<div><lable class=''>RFQ2 Creation:</lable><label style='display:inline-block; width:46px;'>&nbsp;</label>";
   $chk = '';
	if(in_array($codsts[0]['Id'], $urfq2)) {
		$chk = "checked='checked'";
	}
   $html .= "&nbsp;<label style='display:inline-block; width:103px;'>&nbsp;<input type='checkbox' name='eRfq2[".$codsts[0]['Id']."]' id='eRfq2_".$codsts[0]['Id']."' value='".$codsts[0]['Id']."' $dis $chk />&nbsp;Create</label>";
   if($ores[0]['eRFQ2VerifyReq']=='Yes') {
      $chk = '';
   	if(in_array($vodsts[0]['Id'], $urfq2)) {
   		$chk = "checked='checked'";
   	}
      $html .= "&nbsp;<label>&nbsp;<input type='checkbox' name='eRfq2[".$vodsts[0]['Id']."]' id='eRfq2_".$vodsts[0]['Id']."' value='".$vodsts[0]['Id']."' $dis $chk />&nbsp;Verify</label>";
   }
   $html .= "</div>";
	$html .= "</div>";
   $html .= "<div>&nbsp;</div>";
   $html .= "<div style='width:700px;'>
					<div><b><u>RFQ2 Award Rights</u>:</b></div>
					<div><lable class=''>RFQ2 Award:</lable><label style='display:inline-block; width:59px;'>&nbsp;</label>";
   $chk = '';
	if(in_array($codsts[0]['Id'], $urfq2awrd)) {
		$chk = "checked='checked'";
	}
   $html .= "&nbsp;<label class='' style='display:inline-block; width:100px;'>&nbsp;<input type='checkbox' name='eRfq2Award[".$codsts[0]['Id']."]' id='eRfq2Award_".$codsts[0]['Id']."' $dis $chk value='".$codsts[0]['Id']."' />&nbsp;".$smarty->get_template_vars('LBL_CREATE')."&nbsp;</label>&nbsp;";
	// if(in_array($vodsts[0]['Id'], $org_rfq2AwardStatus)) {
	if($ores[0]['eRFQ2AwardVerifyReq'] == 'Yes') {
		  $chk = '';
		  if(in_array($vodsts[0]['Id'], $urfq2awrd)) {
			 $chk = "checked='checked'";
		  }
		  $html .= "&nbsp;<label class='' style='display:inline-block; width:100px;'>&nbsp;<input type='checkbox' name='eRfq2Award[".$vodsts[0]['Id']."]' id='eRfq2Award_".$vodsts[0]['Id']."' $dis $chk value='".$vodsts[0]['Id']."' />&nbsp;".$smarty->get_template_vars('LBL_VERIFY')."&nbsp;</label>&nbsp;";
	}
   if(is_array($org_rfq2AwardStatus) && count($org_rfq2AwardStatus)>0) {
      for($l=0; $l<count($rfq2awardsts); $l++)
   	{
         if(in_array($rfq2awardsts[$l]['Id'], $org_rfq2AwardStatus)) {
            $chk = '';
      		if(in_array($rfq2awardsts[$l]['Id'], $urfq2awrd)) {
      			$chk = "checked='checked'";
      		}
      		$html .= "&nbsp;<label class='' style='display:inline-block; width:100px;'>&nbsp;<input type='checkbox' name='eRfq2Award[".$rfq2awardsts[$l]['Id']."]' id='eRfq2Award_".$rfq2awardsts[$l]['Id']."' $dis $chk value='".$rfq2awardsts[$l]['Id']."' />&nbsp;".$rfq2awardsts[$l]['title']."&nbsp;</label>&nbsp;";
         }
   	}
   }
   $html .= "</div>";
	$html .= "</div>";
}
//
/*
// $html="";
if(count($status) > 0) {
   $i=0;
   $html.='<table width="600" border="0" class="invoice-white-bg" cellspacing="0" cellpadding="0">
            <tr>
              <td><h2 style="padding-right:0px; padding-left:0px;">
                <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr><td width="106">&nbsp;</td>';
                       foreach($status as $arr) {
                         if($arr["title"] != $curTitle){
                           $disphtml.='<td width="70" align="center"  style="padding-left:0px;">'.$arr["title"].'</td>';
                         }
                         $curTitle = $arr["title"];

                         if(@in_array($arr['Id'],$orderStatus)){
                            $disabledOrder = '';
                         }else{
                            $disabledOrder = 'disabled="disabled"';
                         }

                         if(@in_array($arr['Id'],$invoiceStatus)){
                            $disabledInvoice = '';
                         }else{
                            $disabledInvoice = 'disabled="disabled"';
                         }
                         //Prints($disabled);
                         if(@in_array($arr['Id'],$prmsarr)){
                                   $checked = 'checked';
                              } else {
                                   $checked = 'unchecked';
                              }

                          if($arr['eType'] == 'Default') {
                              $checked = 'checked';
                              $disabledInvoice = 'disabled="disabled"';
                              $disabledOrder = 'disabled="disabled"';
                         }

								 if(($arr['status']=='Create' || $arr['status']=='Rejected') && $orgtype=='Supplier' && $arr['eFor']=='PO' ){
									$checkedorder = '';
									$checked = '';
									$disabledOrder = 'disabled="disabled"';
								 }
								 if(($arr['status']=='Create' || $arr['status']=='Rejected') && $orgtype=='Buyer' && $arr['eFor']=='Invoice' ){
									$checkedinvoice = '';
									$checked = '';
									$disabledInvoice = 'disabled="disabled"';
								 }

                         if($arr['eFor'] == 'Invoice'){
                            $invoicedispchkbox.='<td width="50" align="center">
                                 <input type="checkbox" class="radib-btn" '.$checked.' '.$disabledInvoice.' name="InvoicePermission['.$arr['Id'].']" id="invpermission_'.$arr['Id'].'" style="vertical-align:middle;" value="'.$arr['Id'].'" />';
                                 if($arr['eType']=='Default' && $disabledInvoice=='disabled="disabled"' && ($checked=='checked' || $checked=='checked="checked"' || $checked=="checked='checked'") ) {
                                    $invoicedispchkbox.='<input type="hidden" class="radib-btn" '.$checked.' name="InvoicePermission['.$arr['Id'].']" id="invpermission_'.$arr['Id'].'" style="vertical-align:middle;" value="'.$arr['Id'].'" />';
                                 }
                                 $invoicedispchkbox.='</td>';
                         }
                         if($arr['eFor'] == 'PO'){
                             $orderdispchkbox.='<td width="50" align="center">
                                 <input type="checkbox" class="radib-btn" '.$checked.' '.$disabledOrder.' name="OrderPermission['.$arr['Id'].']" id="ordpermission_'.$arr['Id'].'" style="vertical-align:middle;" value="'.$arr['Id'].'"/>';
                                 if($arr['eType']=='Default' && $disabledOrder = 'disabled="disabled"' && ($checked=='checked' || $checked=='checked="checked"' || $checked=="checked='checked'")) {
                                    $orderdispchkbox.='<input type="hidden" class="radib-btn" '.$checked.' name="OrderPermission['.$arr['Id'].']" id="ordpermission_'.$arr['Id'].'" style="vertical-align:middle;" value="'.$arr['Id'].'" />';
                                 }
                                 $orderdispchkbox.='</td>';
                         }
                       }
                        $html.=$disphtml;
            $html.='</tr>
         </table>
     </h2></td>
   </tr>
   <tr>
     <td><table width="98%" border="0" align="center" class="textarea-security" cellpadding="0" cellspacing="0">
         <tr>';
           $html.='<td width="60" height="26">&nbsp;Invoice</td>';
           $html.=$invoicedispchkbox;
         $html.='</tr>
         <tr>';
           $html.='<td width="60" height="26">&nbsp;Purchase Order</td>';
           $html.=$orderdispchkbox;
         $html.='</tr>
         <tr>
     </table></td>
   </tr>
 </table><script>
        $("#access_rights_row").show();
        </script>';
}else{
   $html.='<script>
        $("#access_rights_row").hide();
        </script>';
}*/
$html .= "<script>
        $('#access_rights_row').show();
        </script>";
}else{
   $html.='<script>
        $("#access_rights_row").hide();
        </script>';
}
echo $html;
?>
<script type="text/javascript">
$(document).ready( function() {
	$(function() {
		var ead=10;
		$('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
	});
});
</script>
<?php
exit;
?>