<?php
include(S_SECTIONS."/member/memberaccess.php");
if(!isset($orgUserObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.OrganizationUser.php");
	$orgUserObj = new OrganizationUser();
}
if(!isset($orgprefObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationPreference.php");
	$orgprefObj =	new OrganizationPreference();
}
if(!isset($stMstrObj)) {
    include_once(SITE_CLASS_APPLICATION."class.StatusMaster.php");
    $stMstrObj = new StatusMaster();
}
if(!isset($statusmasterObj)) {
	include_once(SITE_CLASS_APPLICATION."class.StatusMaster.php");
	$statusmasterObj = new StatusMaster();
}
if(!isset($r2bdobj)) {
    include_once(SITE_CLASS_APPLICATION."user/class.Rfq2Bids.php");
    $r2bdobj = new Rfq2Bids();
}
if(!isset($rfq2awardObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.Rfq2Award.php");
	$rfq2awardObj = new Rfq2Award();
}


// --- Statistics --------------------------------------------------------------------------------------------

// -----------
	$sts = $statusmasterObj->getDetails(" DISTINCT iStatusID, vStatus_en, vStatus_fr, vStatus_".LANG." as vStatus "," AND vForAuction LIKE '%RFQ2%'");
   #pr($sts);exit;
        $smarty->assign("sts",$sts);
// -----------------------------------------------------------------------------------------------------------

// --- Last Logins -------------------------------------------------------------------------------------------
	if(!isset($lghObj))
	{
		require_once(SITE_CLASS_APPLICATION."class.LoginHistory.php");
		$lghObj = new LoginHistory();
	}
	$lastlogins = $lghObj->getDetails("*"," AND iAdminId=$sess_id"," dLoginDate DESC ",''," LIMIT 0,3");
   $lastLoginDate = $lastlogins[0]['dLoginDate'];
	$smarty->assign("lastlogins",$lastlogins);

// INBOX DETAIL -----------------------------------------------------------------------------------------------------------
   //Prints($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_INBOX_VIEWED']);exit;
   $curViewedInbox  = (isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_INBOX_VIEWED']))? $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_INBOX_VIEWED'] : '';
   $curViewedInboxStr = @implode(',',$curViewedInbox);
   if($curViewedInboxStr != ''){
      $where.=' AND iVerifiedID NOT IN('.$curViewedInboxStr.')';
   }
	$where.= ' AND ((eCreatedType = \'OU\' AND iCreatedBy <> \''.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'].'\') AND iOrganizationID='.$curORGID.') '; 	// OR eCreatedType = \'OU\'
   // $where .= ' AND (dActionDate > \''.$lastLoginDate.'\')';		// iCreatedBy <> '.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'].' AND
   $where.= ' AND iVerifiedID NOT IN (SELECT iInboxId FROM '.PRJ_DB_PREFIX.'_user_deleted_inbox WHERE iUserId = \''.$sess_id.'\' AND eUserType = \''.$sess_usertype_short.'\') '; // AND eViewed!=\'Yes\'
	$orderBy = " ORDER BY iVerifiedID DESC";
   $limit= ' LIMIT 0,5';
   $sql_res = 'CALL GetInbox("OU"," '.$where.'","","'.$orderBy.'","'.$limit.'")';
   // echo $sql_res;
	$res = $dbobj->Onlyquery($sql_res);
   $smarty->assign("res",$res);

   
// -----------
   $secDetail = $orgUserObj->getDetails('tDashboard',' AND iUserID = "'.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'].'" ','','','');
   //Prints($secDetail);exit;
   $tDashboard  = $secDetail[0]['tDashboard'];
   $smarty->assign("tDashboard",$tDashboard);
   $totalbids = $r2bdobj->getOrgBids($curORGID);
   //prints($result);exit;
   
//----
	$bidstatistic = $orgUserObj->getOrgRFQ2Bids($curORGID);
	# prints($bidstatistic); exit;
	$latestaward = $rfq2awardObj->getrfq2awards($curORGID);
	// prints($latestaward);exit;
	$award = $rfq2awardObj->getB2Award($curORGID);
	$orgawsts = $orgprefObj->getDetails('vRFQ2AwardAcceptLevel', " AND iOrganizationID=$curORGID ");
	$aworgsts = array();
	$aworgsts = @ explode(',', $orgawsts[0]['vRFQ2AwardAcceptLevel']);
	// $award = $award[0];
	//pr($sts);EXIT; 
	// prints($award);exit;
	$smarty->assign("award", $award);
	$smarty->assign("aworgsts", $aworgsts);
	$smarty->assign("latestaward",$latestaward);
   $smarty->assign("resbid",$totalbids);
   $smarty->assign("bidstatistic",$bidstatistic);
   $latestrfq2 = $r2bdobj->getB2Orgrfq2($curORGID);
	//prints($latestrfq2);exit;
	$smarty->assign("latestrfq2",$latestrfq2);
	$bidstats = $r2bdobj->getB2BidStats($curORGID);
	$bsts = Array('current','outbidded','awarded');
	// pr($bsts);exit;
	$b2sts = @ multi21Array($bidstats,'eStatus');
	$smarty->assign("bsts",$bsts);
	$smarty->assign("b2sts",$b2sts);
	$smarty->assign("bidstats",$bidstats);
	// pr($b2sts); exit;
	
	
	 $r2acptsts = $statusmasterObj->getDetails('iStatusID'," AND vForAuction!='' AND vStatus_en='Accepted' ");
	 //pr($r2acptsts);
	$StatusID = $r2acptsts[0]['iStatusID'];
	$getRfq2count= $r2bdobj->getRfq2Awardlist($curORGID,$StatusID);
	// pr($getRfq2count);
	$getRfq2countarr = array();
	for($i=0;$i<count($getRfq2count);$i++) {
		if($getRfq2count[$i]['eAuctionStatus']=="Live")
		{
			$getRfq2countarr['Live']=$getRfq2count[$i]['cnt'];	
		}
		elseif($getRfq2count[$i]['eAuctionStatus']=="Completed")
		{
			$getRfq2countarr['Completed']=$getRfq2count[$i]['cnt'];	
		}
		elseif($getRfq2count[$i]['eAuctionStatus']=="Cancelled")
		{
			$getRfq2countarr['Cancelled']=$getRfq2count[$i]['cnt'];	
		}
		elseif($getRfq2count[$i]['eAuctionStatus']=="Awarded")
		{
			$getRfq2countarr['Awarded']=$getRfq2count[$i]['cnt'];	
		}
		
	}
	//pr($getRfq2countarr);exit;
	$smarty->assign("getRfq2countarr",$getRfq2countarr);
	$smarty->assign("getRfq2count",$getRfq2count);
// ----------------------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------------------
?>