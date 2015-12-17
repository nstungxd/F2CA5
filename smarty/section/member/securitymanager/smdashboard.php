<?php

include(S_SECTIONS."/member/memberaccess.php");
if(!isset($orgUserObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.OrganizationUser.php");
	$orgUserObj =	new OrganizationUser();
}

$where ='';
// --- Statistics --------------------------------------------------------------------------------------------
	$orgstats = $secManObj->getSMDashboardOrgStats(PRJ_DB_PREFIX."_organization_master",$where);
	$assostats = $secManObj->getSMDashboardOrgStats(PRJ_DB_PREFIX."_organization_association",$where);
	$orgadminstats = $secManObj->getSMDashboardUsrStats(PRJ_DB_PREFIX."_organization_user",'Admin');
	$orguserstats = $secManObj->getSMDashboardUsrStats(PRJ_DB_PREFIX."_organization_user",'User');
	$where_user = " iUserID IN (Select iUserID from ".PRJ_DB_PREFIX."_organization_user where eUserType='User' ) ";
	$userrightsstats = $orgUserObj->getOADashboardUsrStats(PRJ_DB_PREFIX."_organization_user_permission",$where_user);
   $grpstats = $secManObj->getSMDashboardOrgStats(PRJ_DB_PREFIX."_organization_group",$where);

	$smarty->assign("orgstats",$orgstats);
   $smarty->assign("grpstats",$grpstats);
	$smarty->assign("assostats",$assostats);
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
	$lastlogins = $lghObj->getDetails("*"," AND iAdminId=$sess_id AND eType='SM' "," dLoginDate DESC ",''," LIMIT 0,3");
   $lastLoginDate = $lastlogins[0]['dLoginDate'];
	$smarty->assign("lastlogins",$lastlogins);
// -----------------------------------------------------------------------------------------------------------
   //Prints($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_INBOX_VIEWED']);exit;
   if(isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_INBOX_VIEWED']))
        $curViewedInbox  = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_INBOX_VIEWED'];
   else
        $curViewedInbox  = "";
   $curViewedInboxStr = @implode(',',$curViewedInbox);
   if($curViewedInboxStr != ''){
      $where.=' AND iVerifiedID NOT IN('.$curViewedInboxStr.')';
   }
   $where .= ' AND ((iCreatedBy <> '.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'].' AND eCreatedType = \'SM\') OR eCreatedType = \'OA\' OR eCreatedType = \'OU\') '; 	// AND dActionDate > \''.$lastLoginDate.'\'
   $where.= ' AND iVerifiedID NOT IN (SELECT iInboxId FROM '.PRJ_DB_PREFIX.'_user_deleted_inbox WHERE iUserId = \''.$sess_id.'\' AND eUserType = \''.$sess_usertype_short.'\') '; 	// AND eViewed=\'Yes\'
	$orderBy = " ORDER BY iVerifiedID DESC";
   $limit= ' LIMIT 0,5';
   //echo $where;
   $sql_res = 'CALL GetInbox("SM"," '.$where.'","","'.$orderBy.'","'.$limit.'")';
	// echo $sql_res; exit;
   $res = $dbobj->Onlyquery($sql_res);
   $smarty->assign("res",$res);
   //Prints($res);exit;
// --- Organizations -----------------------------------------------------------------------------------------
	if(!isset($orgObj))
	{
		require_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
		$orgObj = new Organization();
	}
//	$jTable = Array(" LEFT JOIN ".PRJ_DB_PREFIX."_country_master cm "," LEFT JOIN ".PRJ_DB_PREFIX."_security_manager sm ");
//	$jOn = Array(" org.vCountry=cm.vCountryCode "," org.iVerifiedSMID=sm.iSMID ");
//	$activeorgs = $orgObj->getJoinTableInfo($jTable,$jOn,"org.*,cm.vCountry as vCountryName,CONCAT(sm.vFirstName,' ',sm.vLastName) as vVerifiedBy"," AND org.eStatus='Active'"," dVerifiedDate DESC ",''," LIMIT 0,3",'yes');
	$jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_country_master cm on org.vCountry=cm.vCountryCode LEFT JOIN ".PRJ_DB_PREFIX."_security_manager sm on org.iVerifiedSMID=sm.iSMID ";
	$activeorgs = $orgObj->getJoinTableInfo($jtbl,"org.*,cm.vCountry as vCountryName,CONCAT(sm.vFirstName,' ',sm.vLastName) as vVerifiedBy"," AND org.eStatus='Active'"," org.dVerifiedDate DESC ",' org.iOrganizationID '," LIMIT 0,3",'yes');
	$tot_activeorgs = $activeorgs['tot'];
	unset($activeorgs['tot']);
//	$orgstoverify = $orgObj->getDetails("*"," AND (eStatus='Need to Verify' OR eStatus='Modified')"," dVerifiedDate DESC ",''," LIMIT 0,3");
	$jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_country_master cm on org.vCountry=cm.vCountryCode ";
	$orgstoverify = $orgObj->getJoinTableInfo($jtbl,"org.*,cm.vCountry as vCountryName"," AND (org.eStatus='Need to Verify' OR org.eStatus='Modified')"," org.dCreatedDate DESC ",' org.iOrganizationID '," LIMIT 0,3",'yes');
	$tot_orgstoverify = $orgstoverify['tot'];
	unset($orgstoverify['tot']);
	// prints($activeorgs); exit;
	$smarty->assign("activeorgs",$activeorgs);
	$smarty->assign("tot_activeorgs",$tot_activeorgs);
	$smarty->assign("orgstoverify",$orgstoverify);
	$smarty->assign("tot_orgstoverify",$tot_orgstoverify);
// -----------------------------------------------------------------------------------------------------------

// --- Organization Associations -----------------------------------------------------------------------------
	if(!isset($orgAssocObj))
	{
		require_once(SITE_CLASS_APPLICATION."organization/class.OrganizationAssociation.php");
		$orgAssocObj = new OrganizationAssociation();
	}
	$jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_security_manager sm on oa.iVerifiedSMID=sm.iSMID ";
	$groupby = " oa.iBuyerOrganizationID ";
	$fields = " oa.*,CONCAT(sm.vFirstName,' ',sm.vLastName) as vVerifiedBy,
					(Select vCompanyName from b2b_organization_master where iOrganizationID=oa.iBuyerOrganizationID) as vBuyerOrg ";
	$activeassocs = $orgAssocObj->getJoinTableInfo($jtbl,$fields," AND oa.eStatus!='Inactive'"," oa.dCreatedDate DESC ",''," LIMIT 0,2");
    if(isset($activeassocs['tot']))
	   $tot_activeassocs = $activeassocs['tot'];
    else
       $tot_activeassocs = "";
	unset($activeassocs['tot']);
	$smarty->assign("activeassocs",$activeassocs);
	$smarty->assign("tot_activeassocs",$tot_activeassocs);
// -----------------------------------------------------------------------------------------------------------

   $secDetail = $secManObj->getDetails('tDashboard',' AND iSMID = "'.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'].'" ','','','');
   $tDashboard = $secDetail[0]['tDashboard'];
   $smarty->assign("tDashboard",$tDashboard);
/* ---------- */

if(isset($ENABLE_AUCTION) && $ENABLE_AUCTION=='Yes') {
   $b2bpr_dtls = $generalobj->getTableInfo(" ".PRJ_DB_PREFIX."_buyer2_bproduct_association b2bpa ","",
                                             "b2bpa.*, (Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=b2bpa.iBuyer2Id) as vBuyer2,
   					                            (Select vProductName from ".PRJ_DB_PREFIX."_bproduct_organization where iProductId=b2bpa.iProductId) as vProduct",
                                              " LIMIT 0,1 ", " ORDER BY iAssociationId DESC ","");
   $smarty->assign("b2bpr_dtls",$b2bpr_dtls);
   //
   $b2spr_dtls = $generalobj->getTableInfo(" ".PRJ_DB_PREFIX."_buyer2_sproduct_association b2spa ","",
                                             "b2spa.*, (Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=b2spa.iBuyer2Id) as vBuyer2,
   					                            (Select vProductName from ".PRJ_DB_PREFIX."_sproduct_organization where iProductId=b2spa.iProductId) as vProduct",
                                              " LIMIT 0,1 ", " ORDER BY iAssociationId DESC ","");
   $smarty->assign("b2spr_dtls",$b2spr_dtls);
	//
	$b2by_dtls = $generalobj->getTableInfo(" ".PRJ_DB_PREFIX."_buyer2_buyer_association b2ba ","",
                                             "b2ba.*, (Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=b2ba.iBuyer2Id) as vBuyer2,
   					                            (Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=b2ba.iBuyerId) as vBuyer",
                                              " LIMIT 0,1 ", " ORDER BY iAssociationId DESC ","");
   $smarty->assign("b2by_dtls",$b2by_dtls);
	//
	$b2sp_dtls = $generalobj->getTableInfo(" ".PRJ_DB_PREFIX."_buyer2_supplier_association b2sa ","",
                                             "b2sa.*, (Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=b2sa.iBuyer2Id) as vBuyer2,
   					                            (Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=b2sa.iSupplierId) as vSupplier",
                                              " LIMIT 0,1 ", " ORDER BY iAssociationId DESC ","");
   $smarty->assign("b2sp_dtls",$b2sp_dtls);
	//
	$b2byb_dtls = $generalobj->getTableInfo(" ".PRJ_DB_PREFIX."_buyer2_buyer_bproduct_association b2bpba ","",
                                             "b2bpba.*, (Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=b2bpba.iBuyer2Id) as vBuyer2,
   					                            (Select vProductName from ".PRJ_DB_PREFIX."_bproduct_organization where iProductId=b2bpba.iProductId) as vProduct,
															 (Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=b2bpba.iBuyerId) as vBuyer",
                                              " LIMIT 0,1 ", " ORDER BY iAssociationId DESC ","");
   $smarty->assign("b2byb_dtls",$b2byb_dtls);
	//
	$b2sps_dtls = $generalobj->getTableInfo(" ".PRJ_DB_PREFIX."_buyer2_supplier_sproduct_association b2spsa ","",
                                             "b2spsa.*, (Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=b2spsa.iBuyer2Id) as vBuyer2,
   					                            (Select vProductName from ".PRJ_DB_PREFIX."_bproduct_organization where iProductId=b2spsa.iProductId) as vProduct,
															 (Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=b2spsa.iSupplierId) as vSupplier",
                                              " LIMIT 0,1 ", " ORDER BY iAssociationId DESC ","");
   $smarty->assign("b2sps_dtls",$b2sps_dtls);
	//
   $b2asocstats = $orgObj->getB2AsocsDashboardStats('');
   $smarty->assign("b2asocstats", $b2asocstats);
}
/* ---------- */
?>