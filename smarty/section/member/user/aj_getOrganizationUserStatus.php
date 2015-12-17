<?php /*<style type="text/css">
    .lbl{width:75px;display: inline-block}
    .lblMain{width:125px;display: inline-block}
</style>*/ ?>
<?php

include(S_SECTIONS."/member/memberaccess.php");
/**
 * @author hidden
 * @copyright 2010
 */
if(!isset($orgObj)) {
    include_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
    $orgObj =	new Organization();
}
if(!isset($orgUserPerObj)) {
	require_once(SITE_CLASS_APPLICATION."user/class.OrganizationUserPermission.php");
	$orgUserPerObj = new OrganizationUserPermission();
	//$sess_id
}

if(!isset($orgStaObj)) {
	require_once(SITE_CLASS_APPLICATION."class.StatusMaster.php");
	$orgStaObj = new StatusMaster();
	//$sess_id
}

if(!isset($orgPrefObj)) {
	require_once(SITE_CLASS_APPLICATION."organization/class.OrganizationPreference.php");
	$orgPrefObj = new OrganizationPreference();
	//$sess_id
}

if(!isset($orgUsrObj)) {
	require_once(SITE_CLASS_APPLICATION."user/class.OrganizationUser.php");
	$orgUsrObj = new OrganizationUser();
}
$_GET['q'] = (isset($_GET['q']))? $_GET['q'] : '';
$key = $_GET['q'];
$type = $_GET['type'];
$iId = $_GET['iId'];
$orgUsrObj->setiUserID($iId);
$userdtls = $orgUsrObj->select($iId);
// prints($userdtls); exit;
if(! (is_array($userdtls) && count($userdtls)>0)) {
	echo $smarty->get_template_vars('MSG_SELECT_ORG_USER')." ".$smarty->get_template_vars('LBL_TO_PROCEED')." !";
	exit;
}
if($userdtls[0]['eUserType']=='Admin') {
	echo $smarty->get_template_vars('MSG_ADMIN_RIGHTS_NOT_REQ');
	exit;
}

//$where = " AND iGroupID = '".$iId."'";
$ores = $orgPrefObj->getDetails('*'," AND iOrganizationId=".$userdtls[0]['iOrganizationID']);
$orgdtl = $orgObj->select($userdtls[0]['iOrganizationID']);
$orgtype = $orgdtl[0]['eOrganizationType'];
if($orgtype=='Buyer2') {
   include_once('aj_getB2OrgUserStatus.php');
}

$orderStatus = $invoiceStatus = array();
$where = " AND iUserID='".$iId."'";
$ures = $orgUserPerObj->getDetails('*',$where);
// prints($ures);exit;

$poisusts = $orgStaObj->getDetails('vStatus_'.LANG.' as title,vStatusMsg_'.LANG.',iStatusID as Id,eFor,eType,vStatusMsg_en as msg,vStatus_en as status'," AND vStatus_en='Issue' AND eFor='PO' ",'','');
// $orderStatus .= ",".$poisusts[0]['iStatusID'];
//$ores[0]['vOrderStatusLevel'] .= ",".$poisusts[0]['iStatusID'];
$poacptsts = $orgStaObj->getDetails('vStatus_'.LANG.' as title,vStatusMsg_'.LANG.',iStatusID as Id,eFor,eType,vStatusMsg_en as msg,vStatus_en as status'," AND vStatus_en='Accepted' AND eFor='PO' ",'','');
// $ordacptStatus .= ",".$poacptsts[0]['iStatusID'];
//$ores[0]['vOrderAcceptanceLevel'] .= ",".$poacptsts[0]['iStatusID'];
$invisusts = $orgStaObj->getDetails('vStatus_'.LANG.' as title,vStatusMsg_'.LANG.',iStatusID as Id,eFor,eType,vStatusMsg_en as msg,vStatus_en as status'," AND vStatus_en='Issue' AND eFor='Invoice' ",'','');
// $invoiceStatus .= ",".$invisusts[0]['iStatusID'];
//$ores[0]['vInvoiceStatusLevel'] .= ",".$invisusts[0]['iStatusID'];
$invacptsts = $orgStaObj->getDetails('vStatus_'.LANG.' as title,vStatusMsg_'.LANG.',iStatusID as Id,eFor,eType,vStatusMsg_en as msg,vStatus_en as status'," AND vStatus_en='Accepted' AND eFor='Invoice' ",'','');
// $invacptStatus .= ",".$invacptsts[0]['iStatusID'];
//$ores[0]['vInvoiceAcceptanceLevel'] .= ",".$invacptsts[0]['iStatusID'];

$orderStatus = @explode(',',$ores[0]['vOrderStatusLevel']);
$invacptStatus = @explode(',',$ores[0]['vInvoiceAcceptanceLevel']);
$invoiceStatus = @explode(',',$ores[0]['vInvoiceStatusLevel']);
$ordacptStatus = @explode(',',$ores[0]['vOrderAcceptanceLevel']);

// $orgStaObj->getDetails('vStatus_'.LANG.' as title,vStatusMsg_'.LANG.',iStatusID as Id,eFor,eType,vStatusMsg_en as msg,vStatus_en as status'," AND vStatus_en='Issued' AND eFor='PO' ",'','');
// prints($ures); exit;
$ecreate = array();
$ecreate['inv'] = '';
$ecreate['po'] = '';
$eimport = array();
$eimport['inv'] = '';
$eimport['po']  = '';
$everify = array();
$everify['inv'] = '';
$everify['po']  = '';

if(isset($ures[0]['eFormCreation']) && strpos($ures[0]['eFormCreation'],'po')!==false) {
//	$ecreate['po'] = 'Yes';
	$ecreate['po'] = "checked='checked'";
}
if(isset($ures[0]['eFormCreation']) && strpos($ures[0]['eFormCreation'],'inv')!==false) {
//	$ecreate['inv'] = 'Yes';
   $ecreate['inv'] = "checked='checked'";
}
if(isset($ures[0]['eImportCreation']) && strpos($ures[0]['eImportCreation'],'po')!==false) {
	// $eimport['po'] = 'Yes';
	$eimport['po'] = "checked='checked'";
}
if(isset($ures[0]['eImportCreation']) && strpos($ures[0]['eImportCreation'],'inv')!==false) {
//	$eimport['inv'] = 'Yes';
	$eimport['inv'] = "checked='checked'";
}
if(isset($ures[0]['eVerify']) && strpos($ures[0]['eVerify'],'pi:ia')!==false) {
//	$everify['po'] = 'Yes';
   $everify['po'] = "checked='checked'";
}
if(isset($ures[0]['eVerify']) && strpos($ures[0]['eVerify'],'ii:pa')!==false) {
//	$everify['inv'] = 'Yes';
   $everify['inv'] = "checked='checked'";
}
// prints($ecreate); exit;
//
$userStatus = @explode(";",$ures[0]['tPermission']);
$usrAcptStatus = @explode(";",$ures[0]['tAcceptancePermit']);
//
$invUserStatus = (isset($userStatus[0])) ? $userStatus[0] : '';
$invUserStatus = str_replace("inv:","",$invUserStatus);

$poUserStatus = (isset($userStatus[1]))? $userStatus[1] : '';
$poUserStatus = str_replace("po:","",$poUserStatus);

$invUserStatus = @explode(',',$invUserStatus);
$poUserStatus = @explode(',',$poUserStatus);
//
$invUserAcpt = (isset($usrAcptStatus[0]))? $usrAcptStatus[0] : '';
$invUserAcpt = str_replace("inv:","",$invUserAcpt);

$poUserAcpt = (isset($usrAcptStatus[1]))? $usrAcptStatus[1] : '';
$poUserAcpt = str_replace("po:","",$poUserAcpt);

$invUserAcpt = @explode(',',$invUserAcpt);
$poUserAcpt = @explode(',',$poUserAcpt);

//prints($invoiceStatus);
//prints($orderStatus); exit;
//prints($poUserStatus);
//prints($invUserStatus); exit;
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
if(is_array($ures) && count($ures)>0) {
   if(trim($ures[0]['vRFQ2Permits'])!='') {
      $urfq2 = @explode(',',$ures[0]['vRFQ2Permits']);
   }
   if(trim($ures[0]['vRFQ2AwardPermits'])!='') {
      $urfq2awrd = @explode(',',$ures[0]['vRFQ2AwardPermits']);
   }
}

//
$where = " AND vStatus_en!='Verify' ";
$status = $orgStaObj->getDetails('vStatus_'.LANG.' as title,vStatusMsg_'.LANG.',iStatusID as Id,eFor,eType,vStatusMsg_en as msg,vStatus_en as status',$where,'iDisplayOrder','');
// prints($status);exit;
//b2b_organization_default_settings
// echo $orgtype; exit;
//prints($ordacptStatus); exit;
// prints($ures); exit;
if(isset($ures[0])) {
	if((!($ures[0]['eStatus']== 'Active' || $ures[0]['eStatus']== 'Inactive') && $ures[0]['eNeedToVerify']!= 'Yes') && $ures[0]['eStatus'] != '' && $_SESSION['from']!='usr') {
		$dis = "disabled='disabled'";
	}
}

//$html .= "<div style='width:590px; border:1px solid #cccccc;'>";
$dis = (isset($dis))? $dis : '';
$html = (isset($html))? $html : '';
if($orgtype != 'Supplier') {
	$html .= "<div style='width:700px;'>
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
	$html .= "<div style='width:700px;'><lable class=''>PO Issuance:</lable><label style='display:inline-block; width:35px;'>&nbsp;</label>";
	$chk = '';
	if(in_array($poisusts[0]['Id'],$poUserStatus)) {
	   $chk = "checked='checked'";
	}
	$html .= "&nbsp;<label class='' style='display:inline-block; width:100px;'>&nbsp;<input type='checkbox' name='OrderPermission[".$poisusts[0]['Id']."]' id='ordpermission_".$poisusts[0]['Id']."' $dis $chk value='".$poisusts[0]['Id']."' />&nbsp;".$poisusts[0]['title']."&nbsp;</label>&nbsp;";
	for($l=0; $l<count($status); $l++)
	{
		$chk = '';
		if($status[$l]['eFor']=='PO' && $status[$l]['eType']=='Optional' && in_array($status[$l]['Id'],$orderStatus) && $status[$l]['status']!='Create' && $status[$l]['status']!='Accepted' && $status[$l]['status']!='Issue') {
			if(in_array($status[$l]['Id'],$poUserStatus)) {
				$chk = "checked='checked'";
			}
			$html .= "&nbsp;<label class='' style='display:inline-block; width:100px;'>&nbsp;<input type='checkbox' name='OrderPermission[".$status[$l]['Id']."]' id='ordpermission_".$status[$l]['Id']."' $dis $chk value='".$status[$l]['Id']."' />&nbsp;".$status[$l]['title']."&nbsp;</label>&nbsp;";
		}
	}
	$html .= "</div>";
}
if($orgtype != 'Supplier') {
	$html .= "<div style='width:700px;'><lable class=''>Invoice Acceptance:</lable><label style='display:inline-block; width:2px;'>&nbsp;</label>";
	if(in_array($invacptsts[0]['Id'],$invUserAcpt)) {
	   $chk = "checked='checked'";
	}
	$html .= "&nbsp;<label class='' style='display:inline-block; width:100px;'>&nbsp;<input type='checkbox' name='InvoiceAcpt[".$invacptsts[0]['Id']."]' id='invacpt_".$invacptsts[0]['Id']."' $dis $chk value='".$invacptsts[0]['Id']."' />&nbsp;".$smarty->get_template_vars('LBL_ACCEPT')."&nbsp;</label>&nbsp;"; 	// $invacptsts[0]['title']
	for($l=0; $l<count($status); $l++)
	{
		$chk = '';
		if($status[$l]['eFor']=='Invoice' && $status[$l]['eType']=='Optional' && in_array($status[$l]['Id'],$invacptStatus) && $status[$l]['status']!='Create' && $status[$l]['status']!='Issue' && $status[$l]['status']!='Accepted') {
			if(in_array($status[$l]['Id'],$invUserAcpt)) {
				$chk = "checked='checked'";
			}
			$html .= "&nbsp;<label class='' style='display:inline-block; width:100px;'>&nbsp;<input type='checkbox' name='InvoiceAcpt[".$status[$l]['Id']."]' id='invacpt_".$status[$l]['Id']."' $dis $chk value='".$status[$l]['Id']."' />&nbsp;".$status[$l]['title']."&nbsp;</label>&nbsp;";
		}
	}
	$html .= "<div>&nbsp;</div>";
	if(isset($ENABLE_AUCTION) && $ENABLE_AUCTION=='Yes') {
	   $ipochk = (isset($ures[0]['eInvFPO']) && $ures[0]['eInvFPO']=='Yes')? "checked='checked'" : "";
	   $html .= "<div>".stripslashes($smarty->get_template_vars('LBL_INVOICE_FROM_PO_SUPPLIER_ONBEHALF'))." : <label class='' style='display:inline-block; width:100px;'>&nbsp;<input type='checkbox' name='eInvFPO' id='eInvFPO' value='Yes' $dis $ipochk />&nbsp;Create&nbsp;</label> </div>";
	}
	$html .= "</div>";
}
$html .= "</div>";
$html .= "<div>&nbsp;</div>";
if($orgtype != 'Buyer') {
	$html .= "<div style='width:700px;'>
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
	$html .= "<div style='width:700px;'><lable class=''>Invoice Issuance:</lable><label style='display:inline-block; width:13px;'>&nbsp;</label>";
	if(in_array($invisusts[0]['Id'],$invUserStatus)) {
	   $chk = "checked='checked'";
	}
	$html .= "&nbsp;<label class='' style='display:inline-block; width:100px;'>&nbsp;<input type='checkbox' name='InvoicePermission[".$invisusts[0]['Id']."]' id='invpermission_".$invisusts[0]['Id']."' $dis $chk value='".$invisusts[0]['Id']."' />&nbsp;".$invisusts[0]['title']."&nbsp;</label>&nbsp;";
	for($l=0; $l<count($status); $l++)
	{
		$chk = '';
		if($status[$l]['eFor']=='Invoice' && $status[$l]['eType']=='Optional' && in_array($status[$l]['Id'],$invoiceStatus) && $status[$l]['status']!='Create' && $status[$l]['status']!='Accepted' && $status[$l]['status']!='Issue') {
			if(in_array($status[$l]['Id'],$invUserStatus)) {
				$chk = "checked='checked'";
			}
			$html .="&nbsp;<label class='' style='display:inline-block; width:100px;'>&nbsp;<input type='checkbox' name='InvoicePermission[".$status[$l]['Id']."]' id='invpermission_".$status[$l]['Id']."' $dis $chk value='".$status[$l]['Id']."' />&nbsp;".$status[$l]['title']."&nbsp;</label>&nbsp;";
		}
	}
	$html .= "</div>";
}
if($orgtype != 'Buyer') {
	$html .= "<div style='width:700px;'><lable class=''>PO Acceptance:</lable><label style='display:inline-block; width:22px;'>&nbsp;</label>";
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

if($orgtype!='Buyer2' && $ENABLE_AUCTION=='Yes') {
   $html .= "<div style=''>&nbsp;</div>";
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
	// pr($urfq2awrd); exit;
	//
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
// $html .= "</div>";
// if($ures[0]['eStatus'] != 'Active' && $ures[0]['eStatus'] != '') {
if(isset($ures[0])) {
	if((!($ures[0]['eStatus']== 'Active' || $ures[0]['eStatus']== 'Inactive') && $ures[0]['eNeedToVerify']!= 'Yes') && $ures[0]['eStatus'] != '' && $_SESSION['from']!='usr') {
		$html .= "<div><span class='msg' style='float:left;'>Can't change, record is in inactive or modified status.</span> <span style='float:left; color:red;'> &nbsp; (Click <a href='".SITE_URL_DUM."userrights/$iId'>here</a> to view details.)</span></div>";
	}
}
// $html .= "</div>";
$html .= '<script>$("#access_row").show();$("#assign_row").show();</script>';
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