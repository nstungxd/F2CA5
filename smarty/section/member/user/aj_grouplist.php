<?php

include(S_SECTIONS."/member/memberaccess.php");

	$mode = $_POST['mod'];
    $val = (isset($_POST['val']))? $_POST['val'] : '';
	$vCompanyName = (isset($_POST['org_name']))? $_POST['org_name'] : '';
	$vGroupName = (isset($_POST['grp_name']))? $_POST['grp_name'] : '';
	$page = $_POST['page'];
	// prints($_POST); exit;
	if(trim($page) == '' || trim($page) < 1)
	{ $page = 1; }
	if(!isset($orgObj))
	{
		include_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
		$orgObj = new Organization();
	}
     if(!isset($orgGroupObj)) {
         include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationGroup.php");
         $orgGroupObj =	new OrganizationGroup();
     }
	$where = "";
	if($_POST['srchval']=='act') {
		$where .= " AND grp.eStatus='Active' ";
	} else if($_POST['srchval']=='inact') {
		$where .= " AND grp.eStatus='Inactive' ";
	}
	if($mode == 'all')
	{
          if($val != '')
		$where = " AND ( org.vCompanyName LIKE '%$val%' OR grp.vGroupName LIKE '%$val%')";
	}
	else if($mode == 'srch')
	{
		if(trim($vCompanyName) != '')
		{
			$where = " AND org.vCompanyName LIKE '%$vCompanyName%'";
		}
		if(trim($vGroupName) != '')
		{
			$where .= " AND grp.vGroupName LIKE '%$vGroupName%'";
		}
	}

     // $where .= " AND (grp.eStatus!='Need to Verify' AND grp.eStatus!='Modified' AND grp.eStatus!='Delete' AND grp.eNeedToVerify!='Yes')";
     /*$where .= " OR IF(grp.eStatus='Need to Verify',IF(grp.eCreatedBy='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT']."', grp.iCreatedID=".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']." ,0),0)
					OR IF(grp.eStatus='Modified',IF(grp.eModifiedBy='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT']."', grp.iModifiedByID=".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']." ,0),0))";*/
   if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'] == 'OA') {
      $where .= " AND (grp.iOrganizationID='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGID']."')";
   }

   if(!isset($ENABLE_AUCTION) || $ENABLE_AUCTION=='No') {
      $where .= " AND org.eOrganizationType!='Buyer2' ";
   }

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
      $orderBy = " grp.dDate DESC ";
   }
   ## ENDS HERE ###

	$limit = " LIMIT ".($page-1)*$REC_LIMIT_FRONT.", ".$REC_LIMIT_FRONT." ";
    // print $where;
   $jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_organization_master org on org.iOrganizationID=grp.iOrganizationID";
	$activegroup = $orgGroupObj->getJoinTableInfo($jtbl,"grp.*,org.vCompanyName as vCompanyName",$where,$orderBy,'',$limit,'yes');
     //prints($activegroup);exit;
	//$orglist = $orgGroupObj->getDetails_PG('*',$where,$orderBy,'',$limit);
	$count = $activegroup['tot'];
	unset($activegroup['tot']);

     if(!isset($pgajxobj))
	{
		require_once(SITE_CLASS_GEN."class.paging-ajax.php");
		$pgajxobj = new Paging($count,$page,"listgroup",$REC_LIMIT_FRONT);
	}
	$paging = $pgajxobj->getListPG($page);
	$pgmsg = $pgajxobj->setMessage("Records");
	//echo $paging; exit;
     $smarty->assign('activegroup',$activegroup);
	//$smarty->assign('orglist',$orglist);
	$smarty->assign('count',$count);
	$smarty->assign('paging',$paging);
	$smarty->assign('pgmsg',$pgmsg);
?>
