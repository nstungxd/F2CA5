<?php
   include(S_SECTIONS."/member/memberaccess.php");

	$mode = $_POST['mod'];
    $val =(isset($_POST['val']))? $_POST['val'] : '';
	$vBuyerName =(isset($_POST['buy_name']))? $_POST['buy_name'] : '';
	$vBuyerCode =(isset($_POST['buy_code']))? $_POST['buy_code'] : '';
   $vSellerName =(isset($_POST['sell_name']))? $_POST['sell_name'] : '';
	$vSellerCode =(isset($_POST['sell_code']))? $_POST['sell_code'] : '';
   $stype =(isset($_POST['styp']))? $_POST['styp'] : '';
	$page = $_POST['page'];
	if(trim($page) == '' || trim($page) < 1)
	{ $page = 1; }
	// prints($_POST); exit;
	if(!isset($orgObj))
	{
		include_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
		$orgObj = new Organization();
	}
   if(!isset($assObj))
	{
		include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationAssociation.php");
		$assObj = new OrganizationAssociation();
	}

	$where = "";
    $_POST['srchval'] =(isset($_POST['srchval']))? $_POST['srchval'] : '';
	if($_POST['srchval']=='act') {
		$where .= " AND oa.eStatus='Active' ";
	} else if($_POST['srchval']=='inact') {
		$where .= " AND oa.eStatus='Inactive' ";
	}
	if($mode == 'all')
	{
//          if($val != '')
		$where = " AND ((Select vCompanyName from b2b_organization_master where iOrganizationID=iBuyerOrganizationID) LIKE '%$val%' OR oa.vBuyerCode LIKE '%$val%' OR
						(Select vCompanyName from b2b_organization_master where iOrganizationID=iSupplierAssocationID) LIKE '%$val%' OR oa.vSupplierCode LIKE '%$val%')";
		// echo $where; exit;
	}
	else if($mode == 'srch')
	{
      if(trim($vBuyerName) != '')
		{
			$where .= " AND (Select vCompanyName from b2b_organization_master where iOrganizationID=iBuyerOrganizationID) LIKE '%$vBuyerName%'";
		}
		if(trim($vBuyerCode) != '')
		{
			$where .= " AND oa.vBuyerCode LIKE '%$vBuyerCode%'";
		}
      if(trim($vSellerName) != '')
		{
			$where .= " AND (Select vCompanyName from b2b_organization_master where iOrganizationID=iSupplierAssocationID) LIKE '%$vSellerName%'";
		}
		if(trim($vSellerCode) != '')
		{
			$where .= " AND oa.vSupplierCode LIKE '%$vSellerCode%'";
		}
	}
/*	if($sess_usertype == 'securitymanager')
	{
		// $where .= " AND iASMID=$sess_id";
	}else
	{
		//exit;
	}
*/
//	$where .= " AND (oa.eStatus!='Modified' AND oa.eStatus!='Need to Verify' AND eStatus!='Delete' AND oa.eNeedToVerify!='Yes')";
//	$where .= " AND ((oa.eStatus != 'Modified' AND oa.eStatus != 'Need to Verify')  AND (eStatus != 'Delete')";
//	$where .= " OR ((oa.iCreatedBy='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']."' AND oa.eCreatedBy='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT']."') OR (oa.iModifiedByID='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']."' AND oa.eModifiedBy='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT']."')))";

	//$where .= " AND (oa.vAssociationCode!='' ) ";
	// $where .= " OR (IF(oa.eStatus='Need to Verify',IF(oa.eCreatedBy='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT']."',oa.iCreatedBy='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']."',0), IF(oa.eCreatedBy='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT']."',oa.iCreatedBy='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']."',0)) )) ";
	if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'] == 'OA') {
		$where .= " AND (oa.iBuyerOrganizationID='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGID']."')";
	}
     //$where .= "AND (oa.eStatus!='Inactive')";

	if($stype == 'act') {
		$where .= " AND oa.eStatus='Active' ";
	} else if($stype == 'inact') {
		$where .= " AND oa.eStatus='Inactive' ";
	}

	// $groupBy = " oa.vAssociationCode ";
	$groupBy = "";
   ### SORTING ###
   $cursort = $_POST['cursort'];
   $cursorttype = $_POST['cursorttype'];
   if($cursort != ''){
      if($cursorttype == '1'){
         $cursort_type = 'ASC';
      }else{
         $cursort_type = 'DESC';
      }
      $orderBy = " $cursort $cursort_type";
   }else{
      $orderBy = " oa.dCreatedDate DESC ";
   }
   ## ENDS HERE ###

	$limit = " LIMIT ".($page-1)*$REC_LIMIT_FRONT.", ".$REC_LIMIT_FRONT." ";
     $jtbl = "";
/*	$fields = " oa.*, (Select vCompanyName from b2b_organization_master where iOrganizationID=iBuyerOrganizationID) as vBuyerOrg,
					GROUP_CONCAT((Select DISTINCT CONCAT(vCompanyName,' (',oa.vSupplierCode,')') from b2b_organization_master where iOrganizationID=oa.iSupplierAssocationID )) as vSupplierOrg "; 	// AND (oa.eStatus='Active' || oa.eStatus = 'Inactive') AND oa.eNeedToVerify!='Yes'
*/
	$fields = " oa.*, (Select vCompanyName from b2b_organization_master where iOrganizationID=iBuyerOrganizationID) as vBuyerOrg,
					 (Select vCompanyName from b2b_organization_master where iOrganizationID=oa.iSupplierAssocationID) as vSupplierOrg ";
                // (Select CONCAT(vCompanyName,' (',oa.vSupplierCode,')') from b2b_organization_master where iOrganizationID=oa.iSupplierAssocationID) as vSupplierOrg
	$activegroup = $assObj->getJoinTableInfo($jtbl,$fields,$where,$orderBy,$groupBy,$limit,'yes');
	// prints($activegroup);exit;
	$count = $activegroup['tot'];
	unset($activegroup['tot']);

	if(!isset($pgajxobj)) {
		require_once(SITE_CLASS_GEN."class.paging-ajax.php");
	}
	$pgajxobj = new Paging($count,$page,"listassociations",$REC_LIMIT_FRONT);
	$paging = $pgajxobj->getListPG($page);
	$pgmsg = $pgajxobj->setMessage("Records");
	$smarty->assign('activegroup',$activegroup);
	$smarty->assign('paging',$paging);
	$smarty->assign('pgmsg',$pgmsg);

?>