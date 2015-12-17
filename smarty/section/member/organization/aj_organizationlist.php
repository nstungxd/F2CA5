<?php

include(S_SECTIONS."/member/memberaccess.php");

	$mode = $_POST['mod'];
    $val = (isset($_POST['val']))? $_POST['val'] : '';
    $vCompanyName = (isset($_POST['org_name']))? $_POST['org_name'] : '';
    $vOrganizationCode = (isset($_POST['org_code']))? $_POST['org_code'] : '';
	$eOrganizationType = (isset($_POST['org_type']))? $_POST['org_type'] : '';
	$vCountry = (isset($_POST['country']))? $_POST['country'] : '';
	$page = $_POST['page'];
    $stype = (isset($_POST['styp']))? $_POST['styp'] : '';
	if(trim($page) == '' || trim($page) < 1)
	{ $page = 1; }
	// prints($_POST); exit;
	if(!isset($orgObj))
	{
		include_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
		$orgObj = new Organization();
	}
	$where = "";
	if($mode == 'all')
	{
      if($val != '')
		$where = " AND (org.vCompanyName LIKE '%$val%' OR org.vOrganizationCode LIKE '%$val%' OR org.eOrganizationType LIKE '%$val%' OR org.vCountry LIKE '%$val%')";
	}
	else if($mode == 'srch')
	{
		if(trim($vCompanyName) != '')
		{
			$where = " AND org.vCompanyName LIKE '%$vCompanyName%'";
		}
		if(trim($vOrganizationCode) != '')
		{
			$where .= " AND org.vOrganizationCode LIKE '%$vOrganizationCode%'";
		}
		if(trim($eOrganizationType) != '')
		{
			$where .= " AND org.eOrganizationType='$eOrganizationType'";
		}
		if(trim($vCountry) != '')
		{
			$where .= " AND org.vCountry='$vCountry'";
		}
	}

	if($sess_usertype == 'securitymanager') {
		// $where .= " AND iASMID=$sess_id";
	}

	$where .= " AND (org.eStatus!='Delete' OR org.iASMID=$sess_id OR org.iModifiedByID=$sess_id) "; 	// (org.eStatus != 'Need To Verify')

	if($stype == 'act') {
		$where .= " AND org.eStatus='Active' ";
	} else if($stype == 'inact') {
		$where .= " AND org.eStatus='Inactive' ";
	}

   if(!isset($ENABLE_AUCTION) || $ENABLE_AUCTION=='No') {
      $where .= " AND org.eOrganizationType!='Buyer2'";
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
      $orderBy = " dCreatedDate DESC ";
   }
   ## ENDS HERE ###

/*	if(trim($stype) != '') {
		// if($stype == 'act')
	}
*/
	$limit = " LIMIT ".($page-1)*$REC_LIMIT_FRONT.", ".$REC_LIMIT_FRONT." ";
   $jtbl = "LEFT JOIN ".PRJ_DB_PREFIX."_country_master cm on BINARY org.vCountry=cm.vCountryCode";
   $orglist = $orgObj->getJoinTableInfo($jtbl,"org.iOrganizationID,org.vCompanyName,org.vOrganizationCode,org.eOrganizationType,cm.vCountry,org.eStatus,cm.vCountry",$where,$orderBy,'',$limit,'yes');
 	//$orglist = $orgObj->getDetails_PG('*',$where,$orderBy,'',$limit);
	$count = $orglist['tot'];
	//prints($count);exit;
    // print "A".$count."A";
	unset($orglist['tot']);

	if(!isset($pgajxobj))
	{
		require_once(SITE_CLASS_GEN."class.paging-ajax.php");
	}
	$pgajxobj = new Paging($count,$page,"listorgs",$REC_LIMIT_FRONT);
	$paging = $pgajxobj->getListPG($page);
	$pgmsg = $pgajxobj->setMessage("Records");

     $smarty->assign('orglist',$orglist);
	$smarty->assign('count',$count);
	$smarty->assign('paging',$paging);
	$smarty->assign('pgmsg',$pgmsg);
?>
