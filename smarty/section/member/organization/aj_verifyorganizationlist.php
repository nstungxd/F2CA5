<?php

include(S_SECTIONS."/member/memberaccess.php");

	$mode = $_REQUEST['mod'];
     //$mode = $_GET['mod'];
     //echo $mode;exit;
    $val=(isset($_POST['val']))? $_POST['val'] : '';
	$vCompanyName=(isset($_POST['org_name']))? $_POST['org_name'] : '';
	$vOrganizationCode=(isset($_POST['org_code']))? $_POST['org_code'] : '';
	$eOrganizationType=(isset($_POST['org_type']))? $_POST['org_type'] : '';
	$vCountry=(isset($_POST['country']))? $_POST['country'] : '';
	$page = $_POST['page'];



	if(trim($page) == '' || trim($page) < 1) {
	     $page = 1;
   }

	if(!isset($orgvrfyObj)) {
		include_once(SITE_CLASS_APPLICATION."organization/class.Organization_Toverify.php");
		$orgvrfyObj = new Organization_Toverify();
	}

	$where = "";
	if($mode == 'all') {
		$where = " AND (orgtv.vCompanyName LIKE '%$val%' OR orgtv.vOrganizationCode LIKE '%$val%' OR orgtv.eOrganizationType LIKE '%$val%' OR orgtv.vCountry LIKE '%$val%')";
	}
	else if($mode == 'srch') {
		if(trim($vCompanyName) != '') {
			$where = " AND orgtv.vCompanyName LIKE '%$vCompanyName%'";
		}
		if(trim($vOrganizationCode) != '') {
			$where .= " AND orgtv.vOrganizationCode LIKE '%$vOrganizationCode%'";
		}
		if(trim($eOrganizationType) != '') {
			$where .= " AND orgtv.eOrganizationType='$eOrganizationType'";
		}
		if(trim($vCountry) != '') {
			$where .= " AND orgtv.vCountry='$vCountry'";
		}
	}
     else if($mode == 'desc'){

          $where = " AND  order by orgtv.vOrganizationName asc";

     }

/*   //Prints($_SESSION);exit;
//   if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE'] == 'securitymanager') {
		 $where .= " AND (orgtv.iASMID!='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']."' OR (orgtv.iModifiedByID!='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']."' AND orgtv.iModifiedByID != '0'))";
//	} else {
	   //$where .= " AND iASMID <> '".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']."'";
		//exit;
//	}
	$where .= " AND (orgtv.eStatus = 'Need to Verify' OR orgtv.eStatus = 'Modified' OR orgtv.eStatus = 'Delete'  OR (orgtv.eStatus = 'Inactive' AND orgtv.eNeedToVerify = 'Yes') OR (orgtv.eStatus = 'Active' AND orgtv.eNeedToVerify = 'Yes'))";
*/
$where .= " AND (orgtv.eStatus='Need to Verify' OR orgtv.eStatus='Modified' OR orgtv.eStatus='Delete' OR orgtv.eNeedToVerify='Yes') ";
//$where .= " AND IF(orgtv.eStatus='Need to Verify', orgtv.iASMID!='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']."' , IF(orgtv.eModifiedBy='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT']."',orgtv.iModifiedByID!='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']."',1)))";
//$where .= " AND (orgtv.eStatus = 'Need to Verify' OR orgtv.eStatus = 'Modified' OR orgtv.eStatus = 'Delete'  OR orgtv.eNeedToVerify='Yes')";
if(!isset($ENABLE_AUCTION) || $ENABLE_AUCTION=='No') {
   $where .= " AND orgtv.eOrganizationType!='Buyer2'";
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
      $orderBy = " orgtv.iVerifiedID DESC ";
   }
   ## ENDS HERE ###

   // echo $where; exit;
   $groupBy = " orgtv.iOrganizationID ";
	$limit = " LIMIT ".($page-1)*$REC_LIMIT_FRONT.", ".$REC_LIMIT_FRONT." ";
	$jtbl = "LEFT JOIN ".PRJ_DB_PREFIX."_country_master cm on BINARY orgtv.vCountry=cm.vCountryCode";
   $orglist = $orgvrfyObj->getJoinTableInfo($jtbl,"orgtv.iOrganizationID,orgtv.vCompanyName,orgtv.vOrganizationCode,orgtv.eOrganizationType,cm.vCountry,orgtv.eStatus,cm.vCountry",$where,$orderBy,$groupBy,$limit,'yes');
	//$orglist = $orgvrfyObj->getDetails_PG('*',$where,$orderBy,$groupBy,$limit);
	$count = $orglist['tot'];
	//prints($count);exit;
	unset($orglist['tot']);

	if(!isset($pgajxobj))
	{
		require_once(SITE_CLASS_GEN."class.paging-ajax.php");
	}
	$pgajxobj = new Paging($count,$page,"listorgs",$REC_LIMIT_FRONT);
	$paging = $pgajxobj->getListPG($page);
	$pgmsg = $pgajxobj->setMessage("Records");
	// echo $paging; exit;
	$smarty->assign('count',$count);
	$smarty->assign('orglist',$orglist);
	$smarty->assign('paging',$paging);
	$smarty->assign('pgmsg',$pgmsg);
?>
