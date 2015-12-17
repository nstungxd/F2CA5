<?php
// include(S_SECTIONS."/member/memberaccess.php");
	$mode = $_POST['mod'];
   $val =(isset($_POST['val']))? $_POST['val'] : '';
	$buyer2 =(isset($_POST['buyer2']))? $_POST['buyer2'] : '';
	$code =(isset($_POST['code']))? $_POST['code'] : '';
   $product =(isset($_POST['product']))? $_POST['product'] : '';
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
		include_once(SITE_CLASS_APPLICATION."organization/class.Buyer2_SProduct_Association.php");
		$assObj = new Buyer2_SProduct_Association();
	}

   $where = "";
   $_POST['srchval'] = (isset($_POST['srchval']))? $_POST['srchval'] : '';
	if($_POST['srchval']=='act') {
		$where .= " AND b2spa.eStatus='Active' ";
	} else if($_POST['srchval']=='inact') {
		$where .= " AND b2spa.eStatus='Inactive' ";
	}
	if($mode == 'all')
	{
      if($val != '') {
         $where .= " AND ((Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=b2spa.iBuyer2Id) LIKE '%$val%' OR
                     (Select vProductName from ".PRJ_DB_PREFIX."_sproduct_organization where iProductId=b2spa.iProductId) LIKE '%$val%' OR vACode LIKE '%$val%' )";
      }
		// echo $where; exit;
	}
	else if($mode == 'srch')
	{
      if(trim($buyer2) != '')
		{
			$where .= " AND (Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=iBuyer2Id) LIKE '%$buyer2%'";
		}
		if(trim($code) != '')
		{
			$where .= " AND b2spa.vACode LIKE '%$code%'";
		}
      if(trim($product) != '')
		{
			$where .= " AND (Select vProductName from ".PRJ_DB_PREFIX."_sproduct_organization where iProductId=b2spa.iProductId) LIKE '%$product%'";
		}
	}
	if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'] == 'OA' && $uorg_type=='Buyer2') {
		$where .= " AND (b2spa.iBuyer2Id='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGID']."')";
	}

	if($stype == 'act') {
		$where .= " AND b2spa.eStatus='Active' ";
	} else if($stype == 'inact') {
		$where .= " AND b2spa.eStatus='Inactive' ";
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
      $orderBy = " b2spa.dADate DESC ";
   }
   ## ENDS HERE ###

   $where .= " AND NOT (b2spa.eStatus='Delete' AND b2spa.eNeedToVerify!='Yes') ";
	$limit = " LIMIT ".($page-1)*$REC_LIMIT_FRONT.", ".$REC_LIMIT_FRONT." ";
   $jtbl = "";
	$fields = "b2spa.*, (Select vCompanyName from ".PRJ_DB_PREFIX."_organization_master where iOrganizationID=b2spa.iBuyer2Id) as vBuyer2,
					 (Select vProductName from ".PRJ_DB_PREFIX."_sproduct_organization where iProductId=b2spa.iProductId) as vProduct";
	$asocs = $assObj->getJoinTableInfo($jtbl,$fields,$where,$orderBy,$groupBy,$limit,'yes');
	// prints($asocs); exit;
	$count = $asocs['tot'];
	unset($asocs['tot']);
   
	if(!isset($pgajxobj)) {
		require_once(SITE_CLASS_GEN."class.paging-ajax.php");
	}
   $pgajxobj = new Paging($count,$page,"listb2sprdtassocs",$REC_LIMIT_FRONT);
	$paging = $pgajxobj->getListPG($page);
	$pgmsg = $pgajxobj->setMessage("Records");
   
   $smarty->assign('count',$count);
   $smarty->assign('asocs',$asocs);
	$smarty->assign('paging',$paging);
	$smarty->assign('pgmsg',$pgmsg);
?>