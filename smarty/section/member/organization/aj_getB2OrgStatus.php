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
$grfq2awrdacpt = array();
$grfq2bid = array();
if(trim($grpid)!='' && is_numeric($grpid) && $grpid>0) {
   $grpdt = $orgGroupObj->select($grpid);
   if(is_array($grpdt) && count($grpdt)>0) {
      if(trim($grpdt[0]['vRFQ2AwardAcceptPermits'])!='') {
         $grfq2awrdacpt = @explode(',',$grpdt[0]['vRFQ2AwardAcceptPermits']);
      }
      if(trim($grpdt[0]['vRFQ2BidPermits'])!='') {
         $grfq2bid = @explode(',',$grpdt[0]['vRFQ2BidPermits']);
      }
   }
}

$view = (isset($view))? $view : '';
$ores = array();
// if(trim($view) == 'undefined' || trim($view) == '') {
$ores = $orgPrefObj->getDetails('*'," AND iOrganizationId=".$iId);
$orgdtl = $orgObj->select($iId);
$orgtype = $orgdtl[0]['eOrganizationType'];
$org_rfq2AwardAcptStatus = array();
if(trim($ores[0]['vRFQ2AwardAcceptLevel'])!='') {
   $org_rfq2AwardAcptStatus = @explode(',', $ores[0]['vRFQ2AwardAcceptLevel']);
}
// }
// prints($grpdt); exit;

$rfq2awardacceptsts = $orgStaObj->getDetails('vStatus_'.LANG.' as title,vStatusMsg_'.LANG.',iStatusID as Id,eFor,eType,vStatusMsg_en as msg,vStatus_en as status'," AND vStatus_en NOT IN ('Create','Verify','Accepted','Rejected') AND eType='Optional' AND vForAuction LIKE '%RFQ2 Award Acceptance%' ",'','');
// prints($rfq2awardacceptsts); exit;

$codsts = $orgStaObj->getDetails('vStatus_'.LANG.' as title,vStatusMsg_'.LANG.',iStatusID as Id,eFor,eType,vStatusMsg_en as msg,vStatus_en as status'," AND vStatus_en='Create' AND vForAuction!='' ",'','');
$vodsts = $orgStaObj->getDetails('vStatus_'.LANG.' as title,vStatusMsg_'.LANG.',iStatusID as Id,eFor,eType,vStatusMsg_en as msg,vStatus_en as status'," AND vStatus_en='Verify' AND vForAuction!='' ",'','');
$aodsts = $orgStaObj->getDetails('vStatus_'.LANG.' as title,vStatusMsg_'.LANG.',iStatusID as Id,eFor,eType,vStatusMsg_en as msg,vStatus_en as status'," AND vStatus_en='Accepted' AND vForAuction!='' ",'','');
$rodsts = $orgStaObj->getDetails('vStatus_'.LANG.' as title,vStatusMsg_'.LANG.',iStatusID as Id,eFor,eType,vStatusMsg_en as msg,vStatus_en as status'," AND vStatus_en='Rejected' AND vForAuction!='' ",'','');

$html = '';
$dis = '';
if(isset($grpdt[0]['eStatus'])) {
	if((!($grpdt[0]['eStatus']== 'Active' || $grpdt[0]['eStatus']== 'Inactive') && $grpdt[0]['eNeedToVerify']!= 'Yes') && $grpdt[0]['eStatus'] != '') {
		$dis = "disabled='disabled'";
	}
}
if($orgtype == 'Buyer2') {
$html .= "<div style='width:700px;'>
					<div><b><u>RFQ2 Bid Rights</u>:</b></div>
					<div><lable class=''>Bid Creation:</lable><label style='display:inline-block; width:122px;'>&nbsp;</label>";
   $chk = '';
	if(in_array($codsts[0]['Id'], $grfq2bid)) {
		$chk = "checked='checked'";
	}
   $html .= "&nbsp;<label style='display:inline-block; width:103px;'>&nbsp;<input type='checkbox' name='eRfq2Bid[".$codsts[0]['Id']."]' id='eRfq2Bid_".$codsts[0]['Id']."' value='".$codsts[0]['Id']."' $dis $chk />&nbsp;Create</label>";
   if($ores[0]['eRFQ2BidVerifyReq']=='Yes') {
      $chk = '';
   	if(in_array($vodsts[0]['Id'], $grfq2bid)) {
   		$chk = "checked='checked'";
   	}
      $html .= "&nbsp;<label>&nbsp;<input type='checkbox' name='eRfq2Bid[".$vodsts[0]['Id']."]' id='eRfq2Bid_".$vodsts[0]['Id']."' value='".$vodsts[0]['Id']."' $dis $chk />&nbsp;Verify</label>";
   }
   $html .= "</div>";
	$html .= "</div>";
   $html .= "<div>&nbsp;</div>";
   $html .= "<div style='width:750px;'>
					<div><b><u>RFQ2 Award Acceptance Rights</u>:</b></div>
					<div><lable class=''>Award Acceptance:</lable><label style='display:inline-block; width:90px;'>&nbsp;</label>";
   $chk = '';
	if(in_array($aodsts[0]['Id'], $grfq2awrdacpt)) {
		$chk = "checked='checked'";
	}
   $html .= "&nbsp;<label class='' style='display:inline-block; width:100px;'>&nbsp;<input type='checkbox' name='eRfq2AwardAcpt[".$aodsts[0]['Id']."]' id='eRfq2AwardAcpt_".$aodsts[0]['Id']."' $dis $chk value='".$aodsts[0]['Id']."' />&nbsp;".$smarty->get_template_vars('LBL_ACCEPT')."&nbsp;</label>&nbsp;";
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
      		if(in_array($rfq2awardacceptsts[$l]['Id'], $grfq2awrdacpt)) {
      			$chk = "checked='checked'";
      		}
      		$html .= "&nbsp;<label class='' style='display:inline-block; width:100px;'>&nbsp;<input type='checkbox' name='eRfq2AwardAcpt[".$rfq2awardacceptsts[$l]['Id']."]' id='eRfq2AwardAcpt_".$rfq2awardacceptsts[$l]['Id']."' $dis $chk value='".$rfq2awardacceptsts[$l]['Id']."' />&nbsp;".$rfq2awardacceptsts[$l]['title']."&nbsp;</label>&nbsp;";
         }
   	}
   }
   $html .= "</div>";
	$html .= "</div>";
}
$html .= "<script>
        $('#access_rights_row').show();
        </script>";
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