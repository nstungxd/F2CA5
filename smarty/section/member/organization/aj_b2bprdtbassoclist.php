<?php
// include(S_SECTIONS."/member/memberaccess.php");
	$mode = $_POST['mod'];
   $val =(isset($_POST['val']))? $_POST['val'] : '';
	$buyer2 =(isset($_POST['buyer2']))? $_POST['buyer2'] : '';
	$code =(isset($_POST['code']))? $_POST['code'] : '';
   $product =(isset($_POST['product']))? $_POST['product'] : '';
   $buyer =(isset($_POST['buyer']))? $_POST['buyer'] : '';
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
		include_once(SITE_CLASS_APPLICATION."organization/class.Buyer2_Buyer_BProduct_Association.php");
		$assObj = new Buyer2_Buyer_BProduct_Association();
	}

   $where = "";
   $_POST['srchval'] = (isset($_POST['srchval']))? $_POST['srchval'] : '';
	if($_POST['srchval']=='act') {
		$where .= " AND b2bpb.eStatus='Active' ";
	} else if($_POST['srchval']=='inact') {
		$where .= " AND b2bpb.eStatus='Inactive' ";
	}
	if($mode == 'all')
	{
		if($val != '') {
			$where .= " AND ((Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=b2bpb.iBuyer2Id) LIKE '%$val%' OR
   						(Select vProductName from ".PRJ_DB_PREFIX."_bproduct_organization where iProductId=b2bpb.iProductId) LIKE '%$val%' OR
                     (Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=b2bpb.iBuyerId) LIKE '%$val%' OR
                     vACode LIKE '%$val%' )";
		}
		// echo $where; exit;
	}
	else if($mode == 'srch')
	{
      if(trim($buyer2) != '')
		{
			$where .= " AND (Select vCompanyName from b2b_organization_master where iOrganizationID=iBuyer2Id) LIKE '%$buyer2%'";
		}
		if(trim($code) != '')
		{
			$where .= " AND b2bpb.vACode LIKE '%$code%'";
		}
      if(trim($product) != '')
		{
			$where .= " AND (Select vProductName from b2b_bproduct_organization where iProductId=b2bpb.iProductId) LIKE '%$product%'";
		}
      if(trim($buyer) != '')
		{
			$where .= " AND (Select vCompanyName from b2b_organization_master where iOrganizationID=iBuyerId) LIKE '%$buyer%'";
		}
	}

	if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'] == 'OA' && $uorg_type=='Buyer2') {
		$where .= " AND (b2bpb.iBuyer2Id='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGID']."')";
	} else if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'] == 'OA' && $uorg_type!='Supplier') {
		$where .= " AND (b2bpb.iBuyerId='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGID']."')";
	}

	if($stype == 'act') {
		$where .= " AND b2bpb.eStatus='Active' ";
	} else if($stype == 'inact') {
		$where .= " AND b2bpb.eStatus='Inactive' ";
	}

	$groupBy = "";
   ### SORTING ###
   $cursort = $_POST['cursort'];
   $cursorttype = $_POST['cursorttype'];
   if($cursort != '') {
      if($cursorttype == '1') {
         $cursort_type = 'ASC';
      } else {
         $cursort_type = 'DESC';
      }
      $orderBy = " $cursort $cursort_type";
   } else {
      $orderBy = " b2bpb.dADate DESC ";
   }
   ## ENDS HERE ###

   $where .= " AND NOT (b2bpb.eStatus='Delete' AND b2bpb.eNeedToVerify!='Yes') ";
	$limit = " LIMIT ".($page-1)*$REC_LIMIT_FRONT.", ".$REC_LIMIT_FRONT." ";
   $jtbl = "";
	$fields = "b2bpb.*, (Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=b2bpb.iBuyer2Id) as vBuyer2,
					 (Select vProductName from ".PRJ_DB_PREFIX."_bproduct_organization where iProductId=b2bpb.iProductId) as vProduct,
                (Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=b2bpb.iBuyerId) as vBuyer";
                // (Select CONCAT(vCompanyName,' (',b2bpb.vSupplierCode,')') from b2b_organization_master where iOrganizationID=b2bpb.iSupplierAssocationID) as vSupplierOrg
	$asocs = $assObj->getJoinTableInfo($jtbl,$fields,$where,$orderBy,$groupBy,$limit,'yes');
	// prints($asocs); exit;
	$count = $asocs['tot'];
	unset($asocs['tot']);

	if(!isset($pgajxobj)) {
		require_once(SITE_CLASS_GEN."class.paging-ajax.php");
	}
	$pgajxobj = new Paging($count,$page,"listb2bprdtbassocs",$REC_LIMIT_FRONT);
	$paging = $pgajxobj->getListPG($page);
	$pgmsg = $pgajxobj->setMessage("Records");

   $smarty->assign('count',$count);
   $smarty->assign('asocs',$asocs);
	$smarty->assign('paging',$paging);
	$smarty->assign('pgmsg',$pgmsg);
?>