<?php
include(S_SECTIONS."/member/memberaccess.php");
if(!isset($orgAssocObj)) {
	require_once(SITE_CLASS_APPLICATION."organization/class.OrganizationAssociation.php");
	$orgAssocObj = new OrganizationAssociation();
}
if(!isset($orgObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
	$orgObj = new Organization();
}
if(!isset($orgGroupObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationGroup.php");
	$orgGroupObj =	new OrganizationGroup();
}
if(!isset($orgUserObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.OrganizationUser.php");
	$orgUserObj =	new OrganizationUser();
}
if(!isset($r2bdobj)) {
    include_once(SITE_CLASS_APPLICATION."user/class.Rfq2Bids.php");
    $r2bdobj = new Rfq2Bids();
}
if(!isset($rfq2awardObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.Rfq2Award.php");
	$rfq2awardObj = new Rfq2Award();
}
if(!isset($statusmasterObj)) {
	include_once(SITE_CLASS_APPLICATION."class.StatusMaster.php");
	$statusmasterObj = new StatusMaster();
}
$sts = $statusmasterObj->getDetails(" DISTINCT iStatusID, vStatus_en, vStatus_fr, vStatus_".LANG." as vStatus "," AND vForAuction LIKE '%RFQ2%'");
	 
   $smarty->assign("sts",$sts);
// --- Statistics --------------------------------------------------------------------------------------------
	$where = " iBuyerOrganizationID=$orgid ";
	$assocstats = $orgObj->getOADashboardAssocStats(PRJ_DB_PREFIX."_organization_association",$where);
	$where = " iOrganizationID=$orgid ";
	$groupstats = $orgObj->getOADashboardGrpStats(PRJ_DB_PREFIX."_organization_group",$where);
	$orguserstats = $orgUserObj->getOADashboardUsrStats(PRJ_DB_PREFIX."_organization_user",$where." AND eUserType='User' ");
	$orgadminstats = $orgUserObj->getOADashboardUsrStats(PRJ_DB_PREFIX."_organization_user",$where." AND eUserType='Admin' ");
	$where = " iUserID IN (Select iUserID from ".PRJ_DB_PREFIX."_organization_user where $where AND eUserType='User' ) ";
	$userrightsstats = $orgUserObj->getOADashboardUsrStats(PRJ_DB_PREFIX."_organization_user_permission",$where);
	// prints($userrightsstats); exit;
	$where = " AND iOrganizationID=$orgid";
   //$where = "";
	//prints($assocstats); exit;
	$smarty->assign("assocstats",$assocstats);
	$smarty->assign("groupstats",$groupstats);
	$smarty->assign("orgadminstats",$orgadminstats);
	$smarty->assign("orguserstats",$orguserstats);
	$smarty->assign("userrightsstats",$userrightsstats);
// -----------------------------------------------------------------------------------------------------------

// --- Last Logins -------------------------------------------------------------------------------------------
	if(!isset($lghObj))
	{
		require_once(SITE_CLASS_APPLICATION."class.LoginHistory.php");
		$lghObj = new LoginHistory();
	}
	$lastlogins = $lghObj->getDetails("*"," AND iAdminId=$sess_id AND eType='OA' "," dLoginDate DESC ",''," LIMIT 0,3");
   $lastLoginDate = $lastlogins[0]['dLoginDate'];
	//prints($lastlogins); exit;
	$smarty->assign("lastlogins",$lastlogins);
// -----------------------------------------------------------------------------------------------------------
   //Prints($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_INBOX_VIEWED']);exit;
   $curViewedInbox  = isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_INBOX_VIEWED']) ? $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_INBOX_VIEWED'] : '';
   $curViewedInboxStr = @implode(',',$curViewedInbox);
   if($curViewedInboxStr != '') {
      $where.=' AND iVerifiedID NOT IN('.$curViewedInboxStr.')';
   }
	$where.= ' AND ((eCreatedType = \'OA\' AND iCreatedBy <> \''.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'].'\') OR eCreatedType = \'OU\') AND iOrganizationID='.$curORGID.' ';
   // $where .= ' AND (dActionDate > \''.$lastLoginDate.'\')';		// iCreatedBy <> '.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'].' AND
   $where.= ' AND iVerifiedID NOT IN (SELECT iInboxId FROM '.PRJ_DB_PREFIX.'_user_deleted_inbox WHERE iUserId = \''.$sess_id.'\' AND eUserType = \''.$sess_usertype_short.'\') '; 	// AND eViewed=\'Yes\'
	$orderBy = " ORDER BY iVerifiedID DESC";
   $limit= ' LIMIT 0,5';
   $sql_res = 'CALL GetInbox("SM"," '.$where.'","","'.$orderBy.'","'.$limit.'")';
   $res = $dbobj->Onlyquery($sql_res);
   $smarty->assign("res",$res);
   //Prints($res);exit;
// --- Users -----------------------------------------------------------------------------------------
	$auth1sts =  $statusmasterObj->getDetails('iStatusID'," AND eFor='PO' AND vStatus_en='Auth1' ");
	$auth1sts = $auth1sts[0]['iStatusID'];
	$auth2sts =  $statusmasterObj->getDetails('iStatusID'," AND eFor='PO' AND vStatus_en='Auth2' ");
	$auth2sts = $auth2sts[0]['iStatusID'];
	$auth3sts =  $statusmasterObj->getDetails('iStatusID'," AND eFor='PO' AND vStatus_en='Auth3' ");
	$auth3sts = $auth3sts[0]['iStatusID'];

	$jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_organization_user_permission per on ou.iUserID=per.iUserID
				 LEFT JOIN ".PRJ_DB_PREFIX."_country_master cm on ou.vCountry=cm.vCountryCode ";
	$orgbyusrvrfy = $orgUserObj->getJoinTableInfo($jtbl," ou.*, cm.vCountry as vCountryName "," AND (per.tPermission LIKE '%po:%$auth1sts%' || per.tPermission LIKE '%po:%$auth2sts%' || per.tPermission LIKE '%po:%$auth3sts%') AND (ou.eStatus='Need to Verify' OR ou.eStatus='Modified' OR ou.eNeedToVerify='Yes') AND ou.iOrganizationID=$curORGID "," ou.iUserID DESC ",' ou.iUserID '," LIMIT 0,2 ",'yes');	 	// OR (Select eOrganizationType from ".PRJ_DB_PREFIX."_organization_master where iOrganization=$curORGID)!='Supplier')
	$tot_orgbyusrvrfy = $orgbyusrvrfy['tot'];
	unset($orgbyusrvrfy['tot']);
	// prints($orgbyusrvrfy); exit;
	$bid = '';
	for($l=0;$l<count($orgbyusrvrfy);$l++) {
		$bid[] = $orgbyusrvrfy[$l]['iUserID'];
	}
	$bw = '';
	if(is_array($bid)) {
		$bid = @implode(',',$bid);
		$bw = " AND ou.iUserID NOT IN ($bid)";
	}

	$auth1sts =  $statusmasterObj->getDetails('iStatusID'," AND eFor='Invoice' AND vStatus_en='Auth1' ");
	$auth1sts = $auth1sts[0]['iStatusID'];
	$auth2sts =  $statusmasterObj->getDetails('iStatusID'," AND eFor='Invoice' AND vStatus_en='Auth2' ");
	$auth2sts = $auth2sts[0]['iStatusID'];
	$auth3sts =  $statusmasterObj->getDetails('iStatusID'," AND eFor='Invoice' AND vStatus_en='Auth3' ");
	$auth3sts = $auth3sts[0]['iStatusID'];
	$jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_organization_user_permission per on ou.iUserID=per.iUserID
				 LEFT JOIN ".PRJ_DB_PREFIX."_country_master cm on ou.vCountry=cm.vCountryCode ";
	$orgslusrvrfy = $orgUserObj->getJoinTableInfo($jtbl," ou.*, cm.vCountry as vCountryName "," AND (per.tPermission LIKE '%inv:%$auth1sts%' || per.tPermission LIKE '%inv:%$auth2sts%' || per.tPermission LIKE '%inv:%$auth3sts%') AND (ou.eStatus='Need to Verify' OR ou.eStatus='Modified' OR ou.eNeedToVerify='Yes') AND ou.iOrganizationID=$curORGID) $bw "," ou.iUserID DESC ",' ou.iUserID '," LIMIT 0,2 ",'yes');
	$tot_orgslusrvrfy = $orgslusrvrfy['tot'];
	// prints($orgslusrvrfy); exit;
	unset($orgslusrvrfy['tot']);
	$smarty->assign("orgbyusrvrfy",$orgbyusrvrfy);
	$smarty->assign("tot_orgbyusrvrfy",$tot_orgbyusrvrfy);
	$smarty->assign("orgslusrvrfy",$orgslusrvrfy);
	$smarty->assign("tot_orgslusrvrfy",$tot_orgslusrvrfy);
// -----------------------------------------------------------------------------------------------------------

// --- Organization Associations -----------------------------------------------------------------------------
	$b2bpr_dtls = $generalobj->getTableInfo(" ".PRJ_DB_PREFIX."_buyer2_bproduct_association b2bpa "," AND b2bpa.iBuyer2Id=$curORGID ",
                                             "b2bpa.*, (Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=b2bpa.iBuyer2Id) as vBuyer2,
   					                            (Select vProductName from ".PRJ_DB_PREFIX."_bproduct_organization where iProductId=b2bpa.iProductId) as vProduct",
                                              " LIMIT 0,1 ", " ORDER BY iAssociationId DESC ","");
   $smarty->assign("b2bpr_dtls",$b2bpr_dtls);
   //
   $b2spr_dtls = $generalobj->getTableInfo(" ".PRJ_DB_PREFIX."_buyer2_sproduct_association b2spa "," AND b2spa.iBuyer2Id=$curORGID ",
                                             "b2spa.*, (Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=b2spa.iBuyer2Id) as vBuyer2,
   					                            (Select vProductName from ".PRJ_DB_PREFIX."_sproduct_organization where iProductId=b2spa.iProductId) as vProduct",
                                              " LIMIT 0,1 ", " ORDER BY iAssociationId DESC ","");
   $smarty->assign("b2spr_dtls",$b2spr_dtls);
	//
	$b2by_dtls = $generalobj->getTableInfo(" ".PRJ_DB_PREFIX."_buyer2_buyer_association b2ba "," AND b2ba.iBuyer2Id=$curORGID ",
                                             "b2ba.*, (Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=b2ba.iBuyer2Id) as vBuyer2,
   					                            (Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=b2ba.iBuyerId) as vBuyer",
                                              " LIMIT 0,1 ", " ORDER BY iAssociationId DESC ","");
   $smarty->assign("b2by_dtls",$b2by_dtls);
	//
	$b2sp_dtls = $generalobj->getTableInfo(" ".PRJ_DB_PREFIX."_buyer2_supplier_association b2sa "," AND b2sa.iBuyer2Id=$curORGID ",
                                             "b2sa.*, (Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=b2sa.iBuyer2Id) as vBuyer2,
   					                            (Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=b2sa.iSupplierId) as vSupplier",
                                              " LIMIT 0,1 ", " ORDER BY iAssociationId DESC ","");
   $smarty->assign("b2sp_dtls",$b2sp_dtls);
	//
	$b2byb_dtls = $generalobj->getTableInfo(" ".PRJ_DB_PREFIX."_buyer2_buyer_bproduct_association b2bpba "," AND b2bpba.iBuyer2Id=$curORGID ",
                                             "b2bpba.*, (Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=b2bpba.iBuyer2Id) as vBuyer2,
   					                            (Select vProductName from ".PRJ_DB_PREFIX."_bproduct_organization where iProductId=b2bpba.iProductId) as vProduct,
															 (Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=b2bpba.iBuyerId) as vBuyer",
                                              " LIMIT 0,1 ", " ORDER BY iAssociationId DESC ","");
   $smarty->assign("b2byb_dtls",$b2byb_dtls);
	//
	$b2sps_dtls = $generalobj->getTableInfo(" ".PRJ_DB_PREFIX."_buyer2_supplier_sproduct_association b2spsa "," AND b2spsa.iBuyer2Id=$curORGID ",
                                             "b2spsa.*, (Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=b2spsa.iBuyer2Id) as vBuyer2,
   					                            (Select vProductName from ".PRJ_DB_PREFIX."_bproduct_organization where iProductId=b2spsa.iProductId) as vProduct,
															 (Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=b2spsa.iSupplierId) as vSupplier",
                                              " LIMIT 0,1 ", " ORDER BY iAssociationId DESC ","");
   $smarty->assign("b2sps_dtls",$b2sps_dtls);
	//
   $b2asocstats = $orgObj->getB2AsocsDashboardStats(" AND iBuyer2Id=$curORGID ");
	// pr($b2asocstats); exit;
   $smarty->assign("b2asocstats", $b2asocstats);
// -----------------------------------------------------------------------------------------------------------
	// prints($orgbyusrvrfy); exit;
	$oadDetail = $orgUserObj->getDetails('tDashboard',' AND iUserID = "'.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'].'" ','','','');
   $tDashboard = $oadDetail[0]['tDashboard'];
   $smarty->assign("tDashboard",$tDashboard);
// -----------------------------------------------------------------------------------------------------------
// pr($_SESSION); exit;
// -----------------------------------------------------------------------------------------------------------
//bid award
$totalbids = $r2bdobj->getOrgBids($curORGID);
$smarty->assign("resbid",$totalbids);
$latestaward = $rfq2awardObj->getrfq2awards($curORGID);

$smarty->assign("latestaward",$latestaward);
$bidstatistic = $orgUserObj->getOrgRFQ2Bids($curORGID);
 $smarty->assign("bidstatistic",$bidstatistic);
$award = $rfq2awardObj->getB2Award($curORGID);
$smarty->assign("award",$award);
$latestrfq2 = $r2bdobj->getB2Orgrfq2($curORGID);
//prints($latestrfq2);exit;
$smarty->assign("latestrfq2",$latestrfq2);
$r2acptsts = $statusmasterObj->getDetails('iStatusID'," AND vForAuction!='' AND vStatus_en='Accepted' ");
	 //pr($r2acptsts);
	$StatusID = $r2acptsts[0]['iStatusID'];

$getRfq2count= $r2bdobj->getRfq2Awardlist($curORGID,$StatusID);
	//pr($getRfq2count);exit;
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
	$bidstats = $r2bdobj->getB2BidStats($curORGID);
	$bsts = Array('current','outbidded','awarded');
	// pr($bsts);exit;
	$b2sts = @ multi21Array($bidstats,'eStatus');
	$smarty->assign("bsts",$bsts);
	$smarty->assign("b2sts",$b2sts);
	$smarty->assign("bidstats",$bidstats);
	$smarty->assign("getRfq2countarr",$getRfq2countarr);
	$smarty->assign("getRfq2count",$getRfq2count);

?>