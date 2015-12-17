<style type="text/css">
    .lbl{width:75px;display: inline-block}
    .lblMain{width:125px;display: inline-block}
</style>
<?php
include(S_SECTIONS."/member/memberaccess.php");
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
// prints($_GET); exit;
// $orgUsrObj->setiUserID($iId);
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
// prints($ores); exit;
$orgdtl = $orgObj->select($userdtls[0]['iOrganizationID']);
$orgtype = $orgdtl[0]['eOrganizationType'];

$rfq2BidStatus = $rfq2AwardAcceptStatus = array();
$orderStatus = $invoiceStatus = array();
$where = " AND iUserID='".$iId."'";
$ures = $orgUserPerObj->getDetails('*',$where);
// prints($ures);exit;

// $rfq2bidsts = $orgStaObj->getDetails('vStatus_'.LANG.' as title,vStatusMsg_'.LANG.',iStatusID as Id,eFor,eType,vStatusMsg_en as msg,vStatus_en as status'," AND vForAuction LIKE '%Bid%' AND vStatus_en!='Rejected' ",'','');
// prints($rfq2bidsts); exit;

$rfq2awardacceptsts = $orgStaObj->getDetails('vStatus_'.LANG.' as title,vStatusMsg_'.LANG.',iStatusID as Id,eFor,eType,vStatusMsg_en as msg,vStatus_en as status'," AND vStatus_en NOT IN ('Create','Verify','Accepted','Rejected') AND eType='Optional' AND vForAuction LIKE '%RFQ2 Award Acceptance%' ",'','');
// prints($rfq2awardacceptsts); exit;

$codsts = $orgStaObj->getDetails('vStatus_'.LANG.' as title,vStatusMsg_'.LANG.',iStatusID as Id,eFor,eType,vStatusMsg_en as msg,vStatus_en as status'," AND vStatus_en='Create' AND vForAuction!='' ",'','');
$vodsts = $orgStaObj->getDetails('vStatus_'.LANG.' as title,vStatusMsg_'.LANG.',iStatusID as Id,eFor,eType,vStatusMsg_en as msg,vStatus_en as status'," AND vStatus_en='Verify' AND vForAuction!='' ",'','');
$aodsts = $orgStaObj->getDetails('vStatus_'.LANG.' as title,vStatusMsg_'.LANG.',iStatusID as Id,eFor,eType,vStatusMsg_en as msg,vStatus_en as status'," AND vStatus_en='Accepted' AND vForAuction!='' ",'','');
$rodsts = $orgStaObj->getDetails('vStatus_'.LANG.' as title,vStatusMsg_'.LANG.',iStatusID as Id,eFor,eType,vStatusMsg_en as msg,vStatus_en as status'," AND vStatus_en='Rejected' AND vForAuction!='' ",'','');

// prints($ores); exit;
$org_rfq2AwardAcptStatus = array();
if(trim($ores[0]['vRFQ2AwardAcceptLevel'])!='') {
   $org_rfq2AwardAcptStatus = @explode(',', $ores[0]['vRFQ2AwardAcceptLevel']);
}
// pr($ores); exit;
$urfq2awrdacpt = array();
$urfq2bid = array();
if(is_array($ures) && count($ures)>0) {
   if(trim($ures[0]['vRFQ2AwardAcceptPermits'])!='') {
      $urfq2awrdacpt = @explode(',',$ures[0]['vRFQ2AwardAcceptPermits']);
   }
   if(trim($ures[0]['vRFQ2BidPermits'])!='') {
      $urfq2bid = @explode(',',$ures[0]['vRFQ2BidPermits']);
   }
}

//
$dis = '';
if(isset($ures[0]['eStatus'])) {
   $sfrom = (isset($_SESSION['from']))? $_SESSION['from'] : '';
	if((!($ures[0]['eStatus']== 'Active' || $ures[0]['eStatus']== 'Inactive') && $ures[0]['eNeedToVerify']!= 'Yes') && $ures[0]['eStatus'] != '' && $sfrom!='usr') {
		$dis = "disabled='disabled'";
	}
}
//$html .= "<div style='width:590px; border:1px solid #cccccc;'>";
$html = '';
if($orgtype == 'Buyer2') {
	$html .= "<div style='width:700px;'>
					<div><b><u>RFQ2 Bid Rights</u>:</b></div>
					<div><lable class=''>Bid Creation:</lable><label style='display:inline-block; width:122px;'>&nbsp;</label>";
   $chk = '';
	if(in_array($codsts[0]['Id'], $urfq2bid)) {
		$chk = "checked='checked'";
	}
   $html .= "&nbsp;<label style='display:inline-block; width:103px;'>&nbsp;<input type='checkbox' name='eRfq2Bid[".$codsts[0]['Id']."]' id='eRfq2Bid_".$codsts[0]['Id']."' value='".$codsts[0]['Id']."' $dis $chk />&nbsp;Create</label>";
   if($ores[0]['eRFQ2BidVerifyReq']=='Yes') {
      $chk = '';
   	if(in_array($vodsts[0]['Id'], $urfq2bid)) {
   		$chk = "checked='checked'";
   	}
      $html .= "&nbsp;<label>&nbsp;<input type='checkbox' name='eRfq2Bid[".$vodsts[0]['Id']."]' id='eRfq2Bid_".$vodsts[0]['Id']."' value='".$vodsts[0]['Id']."' $dis $chk />&nbsp;Verify</label>";
   }
   $html .= "</div>";
	$html .= "</div>";
   $html .= "<div>&nbsp;</div>";
   $html .= "<div style='width:730px;'>
					<div><b><u>RFQ2 Award Acceptance Rights</u>:</b></div>
					<div><lable class=''>Award Acceptance:</lable><label style='display:inline-block; width:90px;'>&nbsp;</label>";
   $chk = '';
	if(in_array($aodsts[0]['Id'], $urfq2awrdacpt)) {
		$chk = "checked='checked'";
	}
   $html .= "&nbsp;<label class='' style='display:inline-block; width:100px;'>&nbsp;<input type='checkbox' name='eRfq2AwardAcpt[".$aodsts[0]['Id']."]' id='eRfq2AwardAcpt_".$aodsts[0]['Id']."' $dis $chk value='".$aodsts[0]['Id']."' />&nbsp;".$smarty->get_template_vars('LBL_ACCEPT')."&nbsp;</label>&nbsp;";
	// if(in_array($vodsts[0]['Id'], $org_rfq2AwardAcptStatus)) {
	if($ores[0]['eRFQ2AwardAcceptVerifyReq'] == 'Yes')	{
		  $chk = '';
		  if(in_array($vodsts[0]['Id'], $urfq2awrdacpt)) {
			 $chk = "checked='checked'";
		  }
		  $html .= "&nbsp;<label class='' style='display:inline-block; width:100px;'>&nbsp;<input type='checkbox' name='eRfq2AwardAcpt[".$vodsts[0]['Id']."]' id='eRfq2AwardAcpt_".$vodsts[0]['Id']."' $dis $chk value='".$vodsts[0]['Id']."' />&nbsp;".$smarty->get_template_vars('LBL_VERIFY')."&nbsp;</label>&nbsp;";
	}
	if(is_array($org_rfq2AwardAcptStatus) && count($org_rfq2AwardAcptStatus)>0) {
      for($l=0; $l<count($rfq2awardacceptsts); $l++)
   	{
         if(in_array($rfq2awardacceptsts[$l]['Id'], $org_rfq2AwardAcptStatus)) {
            $chk = '';
      		if(in_array($rfq2awardacceptsts[$l]['Id'], $urfq2awrdacpt)) {
      			$chk = "checked='checked'";
      		}
      		$html .= "&nbsp;<label class='' style='display:inline-block; width:100px;'>&nbsp;<input type='checkbox' name='eRfq2AwardAcpt[".$rfq2awardacceptsts[$l]['Id']."]' id='eRfq2AwardAcpt_".$rfq2awardacceptsts[$l]['Id']."' $dis $chk value='".$rfq2awardacceptsts[$l]['Id']."' />&nbsp;".$rfq2awardacceptsts[$l]['title']."&nbsp;</label>&nbsp;";
         }
   	}
   }
   $html .= "</div>";
	$html .= "</div>";
}
$html .= "<div>&nbsp;</div>";
if(isset($ures[0])) {
   $sfrom = isset($_SESSION['from'])? $_SESSION['from'] : '';
	if((!($ures[0]['eStatus']=='Active' || $ures[0]['eStatus']=='Inactive') && $ures[0]['eNeedToVerify']!='Yes') && $ures[0]['eStatus']!='' && $sfrom!='usr') {
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
<?php exit; ?>