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
if(!isset($poheadingObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.PurchaseOrderHeading.php");
	$poheadingObj = new PurchaseOrderHeading();
}
if(!isset($invordheadingObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.InvoiceOrderHeading.php");
	$invordheadingObj = new InvoiceOrderHeading();
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
	$jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_security_manager sm on oa.iVerifiedSMID=sm.iSMID
				 LEFT JOIN ".PRJ_DB_PREFIX."_organization_user ou on oa.iVerifiedSMID=ou.iUserID
				";
	$groupby = " oa.iBuyerOrganizationID ";
	$fields = " oa.*, CONCAT(ou.vFirstName,' ',ou.vLastName) as oaVerifiedBy , CONCAT(sm.vFirstName,' ',sm.vLastName) as smverifiedBy,
					(Select vCompanyName from b2b_organization_master where iOrganizationID=oa.iBuyerOrganizationID) as vBuyerOrg ";
	$activeassocs = $orgAssocObj->getJoinTableInfo($jtbl,$fields," AND iBuyerOrganizationID=$curORGID AND oa.eStatus!='Inactive'"," oa.dCreatedDate DESC ",' oa.iAsociationID '," LIMIT 0,2");
	$tot_activeassocs = isset($activeassocs['tot']) ? $activeassocs['tot'] : "";
	unset($activeassocs['tot']);
	//prints($activeassocs); exit;
	$smarty->assign("activeassocs",$activeassocs);
	$smarty->assign("tot_activeassocs",$tot_activeassocs);
// -----------------------------------------------------------------------------------------------------------

// --- Purchase Order -----------------------------------------------------------------------------
	$poisu = $statusmasterObj->getDetails('iStatusID'," AND eFor='PO' AND vStatus_en='Issued' ");
	$poisu = $poisu[0]['iStatusID'];
	$porjt = $statusmasterObj->getDetails('iStatusID'," AND eFor='PO' AND vStatus_en='Rejected' ");
	$porjt = $porjt[0]['iStatusID'];
	$invisu = $statusmasterObj->getDetails('iStatusID'," AND eFor='Invoice' AND vStatus_en='Issued' ");
	$invisu = $invisu[0]['iStatusID'];
	$invrjt = $statusmasterObj->getDetails('iStatusID'," AND eFor='Invoice' AND vStatus_en='Rejected' ");
	$invrjt = $invrjt[0]['iStatusID'];

	/*$jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_organization_master org on poh.iBuyerID=org.iOrganizationID
				 LEFT JOIN ".PRJ_DB_PREFIX."_state_master st on org.vState=st.vStateCode
				 LEFT JOIN ".PRJ_DB_PREFIX."_country_master cnt on org.vCountry=cnt.vCountryCode
				";*/
	// echo $orgtype; exit;
	$groupby = " ";
	$fields = " *, poh.dCreateDate as addDate , (select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=poh.iSupplierOrganizationID ) as supplierorg ";
	if($orgtype == 'Supplier') {
	   $pcndt = " AND poh.iSupplierOrganizationID=$orgid AND poh.iaStatusID>=$poisu AND poh.iaStatusID!=$porjt ";
       $jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_organization_master org on (poh.iSupplierOrganizationID=org.iOrganizationID)
				 LEFT JOIN ".PRJ_DB_PREFIX."_state_master st on org.vState=st.vStateCode
				 LEFT JOIN ".PRJ_DB_PREFIX."_country_master cnt on org.vCountry=cnt.vCountryCode
				";
   } else { // if($orgtype == 'Buyer') {
        $pcndt = " AND poh.iBuyerOrganizationID=$orgid OR (poh.iSupplierOrganizationID=$orgid AND poh.iaStatusID>=$poisu AND poh.iaStatusID!=$porjt) ";
        $jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_organization_master org on (poh.iBuyerOrganizationID=org.iOrganizationID)
				 LEFT JOIN ".PRJ_DB_PREFIX."_state_master st on org.vState=st.vStateCode
				 LEFT JOIN ".PRJ_DB_PREFIX."_country_master cnt on org.vCountry=cnt.vCountryCode
				";
   }
	$latestpo = $poheadingObj->getJoinTableInfo($jtbl,$fields,$pcndt," poh.dOrderDate DESC ",' poh.iPurchaseOrderID '," LIMIT 0,2");
	$tot_latestpo = isset($latestpo['tot']) ? $latestpo['tot'] : "";
	//prints($latestpo); exit;
	unset($latestpo['tot']);
	$smarty->assign("latestpo",$latestpo);
	$smarty->assign("tot_latestpo",$tot_latestpo);
// -----------------------------------------------------------------------------------------------------------

// --- Invoice Order -----------------------------------------------------------------------------
	/*$jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_organization_master org on ioh.iSupplierID=org.iOrganizationID
				 LEFT JOIN ".PRJ_DB_PREFIX."_state_master st on org.vState=st.vStateCode
				 LEFT JOIN ".PRJ_DB_PREFIX."_country_master cnt on org.vCountry=cnt.vCountryCode
				";*/
	$groupby = " ";
	$fields = " *, ioh.dCreatedDate as addDate , (select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=ioh.iBuyerOrganizationID ) as buyerorg ";
	if($orgtype == 'Buyer') {
	   $icndt = " AND ioh.iBuyerOrganizationID=$orgid AND ioh.iaStatusID>=$invisu AND ioh.iaStatusID!=$invrjt ";
      $jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_organization_master org on (ioh.iBuyerOrganizationID=org.iOrganizationID)
				 LEFT JOIN ".PRJ_DB_PREFIX."_state_master st on org.vState=st.vStateCode
				 LEFT JOIN ".PRJ_DB_PREFIX."_country_master cnt on org.vCountry=cnt.vCountryCode
				";
	} else { //if($orgtype == 'Supplier') {
	   $icndt = " AND ioh.iSupplierOrganizationID=$orgid OR (ioh.iBuyerOrganizationID=$orgid AND ioh.iaStatusID>=$invisu AND ioh.iaStatusID!=$invrjt) ";
      $jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_organization_master org on (ioh.iSupplierOrganizationID=org.iOrganizationID)
				 LEFT JOIN ".PRJ_DB_PREFIX."_state_master st on org.vState=st.vStateCode
				 LEFT JOIN ".PRJ_DB_PREFIX."_country_master cnt on org.vCountry=cnt.vCountryCode
				";
	}
	$latestio = $invordheadingObj->getJoinTableInfo($jtbl,$fields,$icndt," ioh.dCreatedDate DESC ",' ioh.iInvoiceID '," LIMIT 0,2");
	$tot_latestio = isset($latestio['tot']) ? $latestio['tot'] : "";
	//prints($latestio); exit;
	unset($latestio['tot']);
	$smarty->assign("latestio",$latestio);
	$smarty->assign("tot_latestio",$latestio);
// -----------------------------------------------------------------------------------------------------------
	// prints($orgbyusrvrfy); exit;
	$oadDetail = $orgUserObj->getDetails('tDashboard',' AND iUserID = "'.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'].'" ','','','');
   $tDashboard = $oadDetail[0]['tDashboard'];
   $smarty->assign("tDashboard",$tDashboard);

// --- Buyer2 Associations -----------------------------------------------------------------------------
	if(isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGTYPE']) && ($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGTYPE']=='Buyer' || $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGTYPE']=='Both')) {
		$b2by_dtls = $generalobj->getTableInfo(" ".PRJ_DB_PREFIX."_buyer2_buyer_association b2ba "," AND b2ba.iBuyerId=$curORGID ",
																"b2ba.*, (Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=b2ba.iBuyer2Id) as vBuyer2,
																 (Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=b2ba.iBuyerId) as vBuyer",
																 " LIMIT 0,1 ", " ORDER BY iAssociationId DESC ","");
		$smarty->assign("b2by_dtls",$b2by_dtls);
		//
		$b2byb_dtls = $generalobj->getTableInfo(" ".PRJ_DB_PREFIX."_buyer2_buyer_bproduct_association b2bpba "," AND b2bpba.iBuyerId=$curORGID ",
																"b2bpba.*, (Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=b2bpba.iBuyer2Id) as vBuyer2,
																 (Select vProductName from ".PRJ_DB_PREFIX."_bproduct_organization where iProductId=b2bpba.iProductId) as vProduct,
																 (Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=b2bpba.iBuyerId) as vBuyer",
																 " LIMIT 0,1 ", " ORDER BY iAssociationId DESC ","");
		$smarty->assign("b2byb_dtls",$b2byb_dtls);
	} else if(isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGTYPE']) && ($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGTYPE']=='Supplier' || $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGTYPE']=='Both')) {
		$b2sp_dtls = $generalobj->getTableInfo(" ".PRJ_DB_PREFIX."_buyer2_supplier_association b2sa "," AND b2sa.iSupplierId=$curORGID ",
                                             "b2sa.*, (Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=b2sa.iBuyer2Id) as vBuyer2,
   					                            (Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=b2sa.iSupplierId) as vSupplier",
                                              " LIMIT 0,1 ", " ORDER BY iAssociationId DESC ","");
		$smarty->assign("b2sp_dtls",$b2sp_dtls);
		//
		$b2sps_dtls = $generalobj->getTableInfo(" ".PRJ_DB_PREFIX."_buyer2_supplier_sproduct_association b2spsa "," AND b2spsa.iSupplierId=$curORGID ",
																"b2spsa.*, (Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=b2spsa.iBuyer2Id) as vBuyer2,
																 (Select vProductName from ".PRJ_DB_PREFIX."_bproduct_organization where iProductId=b2spsa.iProductId) as vProduct,
																 (Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=b2spsa.iSupplierId) as vSupplier",
																 " LIMIT 0,1 ", " ORDER BY iAssociationId DESC ","");
		$smarty->assign("b2sps_dtls",$b2sps_dtls);
	}
	//
   $b2asocstats = $orgObj->getBB2AsocsDashboardStats("$curORGID", $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGTYPE']);
	// pr($b2asocstats); exit;
   $smarty->assign("b2asocstats", $b2asocstats);
// -----------------------------------------------------------------------------------------------------------
	// prints($orgbyusrvrfy); exit;
	$oadDetail = $orgUserObj->getDetails('tDashboard',' AND iUserID = "'.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'].'" ','','','');
   $tDashboard = $oadDetail[0]['tDashboard'];
   $smarty->assign("tDashboard",$tDashboard);
// -----------------------------------------------------------------------------------------------------------
 $rfq2sts = $statusmasterObj->getDetails(" DISTINCT iStatusID, vStatus_en, vStatus_fr, vStatus_".LANG." as vStatus "," AND vForAuction LIKE '%RFQ2%'");
   // pr($rfq2sts); exit;
      $r2stats = $orgUserObj->getOrgRFQ2($curORGID);
   //prints($r2stats);exit;
   $latestrfq2 = $r2bdobj->getOrgrfq2($curORGID);
   // prints($latestrfq2);exit;
    $award = $rfq2awardObj->getaward($curORGID);
   // pr($award);exit;
   $orgawsts = $orgprefObj->getDetails('vRFQ2AwardStatusLevel', " AND iOrganizationID=$curORGID ");
	$aworgsts = array();
	$aworgsts = @ explode(',', $orgawsts[0]['vRFQ2AwardStatusLevel']);
	$rfq2stats = $r2bdobj->getRFQ2Stats($curORGID);
	$cntsts = $gdbobj->mysqlEnumValues(PRJ_DB_PREFIX."_rfq2_master",'eAuctionStatus');
	$cntsts[] = 'Awarded';
	$r2sts = @multi21Array($rfq2stats,'eAuctionStatus');
	 //pr($r2sts);exit;  
	 //pr($rfq2stats); exit;
	 $smarty->assign("r2sts",$r2sts);
	$smarty->assign("cntsts",$cntsts);
	$smarty->assign("rfq2stats",$rfq2stats);
	$smarty->assign("aworgsts",$aworgsts);
	$smarty->assign("latestrfq2",$latestrfq2);
	$smarty->assign("rfq2sts",$rfq2sts);
	$smarty->assign("r2stats",$r2stats);
	 $smarty->assign("award",$award);
?>