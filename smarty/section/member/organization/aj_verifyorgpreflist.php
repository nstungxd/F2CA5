<?php

include(S_SECTIONS."/member/memberaccess.php");

	$mode = $_POST['mod'];
	$val = $_POST['val'];
	$vCompanyName = $_POST['org_name'];
	$vOrganizationCode = $_POST['org_code'];
	$eOrganizationType = $_POST['org_type'];
	$vCountry = $_POST['country'];
	$page = $_POST['page'];

	if(trim($page) == '' || trim($page) < 1) {
	     $page = 1;
   }

	if(!isset($orgprefvrfyObj)) {
		include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationPreferenceToverify.php");
		$orgprefvrfyObj = new OrganizationPreferenceToverify();
	}

	$where = "";
	if($mode == 'all') {
		$where = " AND (org.vCompanyName LIKE '%$val%' OR org.vOrganizationCode LIKE '%$val%' OR org.eOrganizationType LIKE '%$val%' OR org.vCountry LIKE '%$val%')";
	}
	else if($mode == 'srch') {
		if(trim($vCompanyName) != '') {
			$where = " AND org.vCompanyName LIKE '%$vCompanyName%'";
		}
		if(trim($vOrganizationCode) != '') {
			$where .= " AND org.vOrganizationCode LIKE '%$vOrganizationCode%'";
		}
		if(trim($eOrganizationType) != '') {
			$where .= " AND org.eOrganizationType='$eOrganizationType'";
		}
		if(trim($vCountry) != '') {
			$where .= " AND org.vCountry='$vCountry'";
		}
	}
   //Prints($_SESSION);exit;
/*   if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE'] == 'securitymanager') {
		 $where .= " AND org.iASMID <> '".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']."'";
	} else {
	   //$where .= " AND iASMID <> '".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']."'";
		//exit;
	}
   $where .= " ";
	$where .= " AND (orgpf.eStatus = 'Need to Verify' OR orgpf.eStatus = 'Modified')";
*/
	$where .= " AND (orgpf.eStatus = 'Need to Verify' OR orgpf.eStatus = 'Modified')
					AND IF(orgpf.eStatus='Need to Verify', org.iASMID!=".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']." ,1)
					AND IF(orgpf.eStatus='Modified',IF(orgpf.eModifiedBy='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT']."', orgpf.iModifiedByID!=".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']." ,1),1) ";
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
      $orderBy = " iVerifiedID DESC ";
   }
   ## ENDS HERE ###

   $groupBy = " iOrganizationID ";
	$limit = " LIMIT ".($page-1)*$REC_LIMIT_FRONT.", ".$REC_LIMIT_FRONT." ";
	$jtbl = " INNER JOIN ".PRJ_DB_PREFIX."_organization_master org on orgpf.iOrganizationID=org.iOrganizationID ";
	$orglist = $orgprefvrfyObj->getJoinTableInfo($jtbl,'org.*,orgpf.eStatus',$where,$orderBy,$groupBy,$limit,'yes');
	// prints($orglist); exit;
	$count = $orglist['tot'];
	unset($orglist['tot']);

	if(!isset($pgajxobj))
	{
		require_once(SITE_CLASS_GEN."class.paging-ajax.php");
	}
	$pgajxobj = new Paging($count,$page,"listorgs",$REC_LIMIT_FRONT);
	$paging = $pgajxobj->getListPG($page);
	$pgmsg = $pgajxobj->setMessage("Records");
	// echo $pgmsg; exit;
	$smarty->assign('orglist',$orglist);
	$smarty->assign('count',$count);
	$smarty->assign('paging',$paging);
	$smarty->assign('pgmsg',$pgmsg);
?>
