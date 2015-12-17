<?php

include(S_SECTIONS."/member/memberaccess.php");

	$mode = $_POST['mod'];
    $val = (isset($_POST['val']))? $_POST['val'] : '';
	$vCompanyName = (isset($_POST['org_name']))? $_POST['org_name'] : '';
	$vGroupName = (isset($_POST['grp_name']))? $_POST['grp_name'] : '';
	$page = $_POST['page'];
	if(trim($page) == '' || trim($page) < 1)
	{ $page = 1; }
	 //prints($_POST); exit;
	if(!isset($orgObj))
	{
		include_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
		$orgObj = new Organization();
	}
     if(!isset($orgGroupObj)) {
         include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationGroupToVerify.php");
         $orgGroupObj =	new OrganizationGroupToVerify();
     }
	$where = "";
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

     $where .= " AND (grp.eStatus = 'Need to Verify' OR grp.eStatus = 'Modified' OR grp.eStatus = 'Delete' OR grp.eNeedToVerify = 'Yes') ";
     // $where .= " OR ((grp.eStatus = 'Inactive' AND grp.eNeedToVerify = 'Yes') OR (grp.eStatus = 'Active' AND grp.eNeedToVerify = 'Yes'))) ";
     // $where .= " AND IF(grp.eStatus='Need to Verify', grp.iCreatedID!=".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']." ,grp.iModifiedByID!=".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'].")";
     if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'] == 'OA') {
          // $where .= " AND grp.eCreatedBy='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT']."'";
          $where .= " AND grp.iOrganizationID='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGID']."'";
     }

     //$where .= " AND ((grp.iCreatedID!='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']."' AND grp.eCreatedBy='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT']."') OR ((grp.iModifiedByID!='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']."' AND grp.eModifiedBy='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT']."')))";
	//$where .= " AND (grp.eStatus = 'Need to Verify' OR grp.eStatus = 'Modified' OR grp.eStatus = 'Delete') OR (grp.eStatus = 'Inactive' AND grp.eNeedToVerify = 'Yes') OR (grp.eStatus = 'Active' AND grp.eNeedToVerify = 'Yes')";

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
      $orderBy = " grp.iVerifiedID DESC ";
   }
   ## ENDS HERE ###

   $groupby = "grp.iGroupID";
	$limit = " LIMIT ".($page-1)*$REC_LIMIT_FRONT.", ".$REC_LIMIT_FRONT." ";
   //echo $where;
   $jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_organization_master org on org.iOrganizationID=grp.iOrganizationID";

	$activegroup = $orgGroupObj->getJoinTableInfo($jtbl,"grp.*,org.vCompanyName as vCompanyName",$where,$orderBy,$groupby,$limit,'yes');

     //$orglist = $orgGroupObj->getDetails_PG('*',$where,$orderBy,'',$limit);
	$count = $activegroup['tot'];
	unset($activegroup['tot']);
//print"<pre>";
//print_r($activegroup);
   if(!isset($pgajxobj)) {
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
