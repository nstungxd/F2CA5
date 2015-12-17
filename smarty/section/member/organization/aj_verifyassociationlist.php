<?php

include(S_SECTIONS."/member/memberaccess.php");

	$mode = $_POST['mod'];
    $val =(isset($_POST['val']))? $_POST['val'] : '';
	$vBuyerName =(isset($_POST['buy_name']))? $_POST['buy_name'] : '';
	$vBuyerCode =(isset($_POST['buy_code']))? $_POST['buy_code'] : '';
     $vSellerName =(isset($_POST['sell_name']))? $_POST['sell_name'] : '';
	$vSellerCode =(isset($_POST['sell_code']))? $_POST['sell_code'] : '';
	$page = $_POST['page'];
	// prints($_POST); exit;
	if(trim($page) == '' || trim($page) < 1)
	{ $page = 1; }
	if(!isset($orgObj))
	{
		include_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
		$orgObj = new Organization();
	}
   if(!isset($assvrfyObj))
	{
		include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationAssociationToVerify.php");
//		include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationAssociation.php");
		$assvrfyObj = new OrganizationAssociationToVerify();
	}
	$where = "";
	if($mode == 'all')
	{
//      if($val != '')
		$where = " AND ((Select vCompanyName from b2b_organization_master where iOrganizationID=iBuyerOrganizationID) LIKE '%$val%' OR oa.vBuyerCode LIKE '%$val%' OR
						(Select vCompanyName from b2b_organization_master where iOrganizationID=iSupplierAssocationID) LIKE '%$val%' OR oa.vSupplierCode LIKE '%$val%')";
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


/*	if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE'] == 'securitymanager') {
		 $where .= " AND (iCreatedBy <> '".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']."' AND eCreatedBy = 'SM')";
	} else {
	   //$where .= " AND iASMID <> '".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']."'";
		//exit;
	}
 */
//     $where .= " AND ((oa.eStatus = 'Need to Verify' OR oa.eStatus = 'Modified' OR oa.eStatus = 'Delete') ";
//     $where .= " OR ((oa.eStatus = 'Inactive' AND oa.eNeedToVerify = 'Yes') OR (oa.eStatus = 'Active' AND oa.eNeedToVerify = 'Yes'))) ";
//     $where .= " AND IF(oa.eStatus='Need to Verify', oa.iCreatedBy!=".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']." ,oa.iModifiedByID!=".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'].")";

	$where .= " AND (oa.eStatus = 'Need to Verify' OR oa.eStatus = 'Modified' OR oa.eStatus = 'Delete' OR oa.eNeedToVerify = 'Yes') ";
	// $where .=  " AND IF(oa.eStatus='Need to Verify' AND oa.eCreatedBy='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT']."', oa.iCreatedBy!=".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']." , IF(oa.eModifiedBy='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT']."',oa.iModifiedByID!=".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'].",1))) ";
   if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'] == 'OA') {
		$where .= " AND oa.eCreatedBy='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT']."'";
		$where .= " AND oa.iBuyerOrganizationID='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGID']."'";
   }
   // $where .= " AND NOT (oa.eStatus='Active' AND oa.eNeedToVerify='No')";
	//$where .= " AND (((oa.iCreatedBy!='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']."' AND oa.eCreatedBy='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT']."') OR (oa.iModifiedByID!='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']."' AND oa.eModifiedBy='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT']."'))";
	//$where .= " AND (oa.eStatus = 'Need to Verify' OR oa.eStatus = 'Modified' OR oa.eStatus = 'Delete'   OR (oa.eStatus = 'Inactive' AND oa.eNeedToVerify = 'Yes') OR (oa.eStatus = 'Active' AND oa.eNeedToVerify = 'Yes')))";
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
      $orderBy = " oa.iAsociationID DESC ";
   }
   ## ENDS HERE ###

	$limit = " LIMIT ".($page-1)*$REC_LIMIT_FRONT.", ".$REC_LIMIT_FRONT." ";

	$jtbl = "";
/*	$fields = " oa.*, (Select vCompanyName from b2b_organization_master where iOrganizationID=iBuyerOrganizationID) as vBuyerOrg,
					GROUP_CONCAT((Select CONCAT(vCompanyName,' (',oa.vSupplierCode,')') from b2b_organization_master where iOrganizationID=oa.iSupplierAssocationID AND (oa.eStatus!='Active' || oa.eNeedToVerify='Yes') )) as vSupplierOrg ";
     // (select iSupplierAssocationID from b2b_organization_association_toverify where iBuyerOrganizationID=oa.iBuyerOrganizationID and iSupplierAssocationID=oa.iSupplierAssocationID AND eStatus !='Active' || eNeedToVerify='Yes' order by iVerifiedID DESC LIMIT 0,1)
*/

	$fields = " oa.*, (Select vCompanyName from b2b_organization_master where iOrganizationID=iBuyerOrganizationID) as vBuyerOrg,
					(Select CONCAT(vCompanyName,' (',oa.vSupplierCode,')') from b2b_organization_master where iOrganizationID=oa.iSupplierAssocationID AND (oa.eStatus!='Active' || oa.eNeedToVerify='Yes') ) as vSupplierOrg ";
	$activegroup = $assvrfyObj->getJoinTableInfo($jtbl,$fields,$where,$orderBy,$groupBy,$limit,'yes');

	$count = $activegroup['tot'];
	unset($activegroup['tot']);

	if(!isset($pgajxobj))
	{
		require_once(SITE_CLASS_GEN."class.paging-ajax.php");
	}
	//prints($activegroup);
	$pgajxobj = new Paging($count,$page,"listassociations",$REC_LIMIT_FRONT);
	$paging = $pgajxobj->getListPG($page);
	$pgmsg = $pgajxobj->setMessage("Records");
	$smarty->assign('count',$count);
	$smarty->assign('activegroup',$activegroup);
	$smarty->assign('paging',$paging);
	$smarty->assign('pgmsg',$pgmsg);
?>
