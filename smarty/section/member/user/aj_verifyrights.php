<?php

include(S_SECTIONS."/member/memberaccess.php");

   $mode = $_POST['mod'];
    $val = (isset($_POST['val']))? $_POST['val'] : '';
	$vUserName = (isset($_POST['vUserName']))? $_POST['vUserName'] : '';
	$vEmail = (isset($_POST['vEmail']))? $_POST['vEmail'] : '';
	$eUserType = (isset($_POST['eUserType']))? $_POST['eUserType'] : '';
	$vCountry = (isset($_POST['vCountry']))? $_POST['vCountry'] : '';
	$vCompanyName = (isset($_POST['vCompanyName']))? $_POST['vCompanyName'] : '';
	$page = $_POST['page'];
	if(trim($page) == '' || trim($page) < 1)
	{ $page = 1; }
	// prints($_POST); exit;

	if(!isset($orgUserObj)) {
          include_once(SITE_CLASS_APPLICATION."user/class.OrganizationUserToverify.php");
          $orgUserObj =	new OrganizationUserToverify();
   }
	if(!isset($orgUserPermVerifyObj)) {
    include_once(SITE_CLASS_APPLICATION."user/class.OrganizationUserPermissionToVerify.php");
    $orgUserPermVerifyObj =	new OrganizationUserPermissionToVerify();
	}
	if(!isset($orgUserPermObj)) {
    include_once(SITE_CLASS_APPLICATION."user/class.OrganizationUserPermission.php");
    $orgUserPermObj =	new OrganizationUserPermission();
	}
	$where = "";
	if($mode == 'all')
	{
      if($val != '')
		$where = " AND (ou.vFirstName LIKE '%$val%' OR ou.vLastName LIKE '%$val%' OR ou.vEmail LIKE '%$val%' OR ou.eUserType LIKE '%$val%' OR ou.vCountry LIKE '%$val%')";
	}
	else if($mode == 'srch')
	{
		if(trim($vUserName) != '')
		{
			$where = " AND (CONCAT(ou.vFirstName,' ',ou.vLastName) LIKE '%$vUserName%') ";
		}

		if(trim($vEmail) != '')
		{
			$where .= " AND ou.vEmail LIKE '%$vEmail%'";
		}
		/*if(trim($eUserType) != '')
		{
			$where .= " AND ou.eUserType='$eUserType'";
		}*/
		if(trim($vCountry) != '')
		{
			$where .= " AND ou.vCountry='$vCountry'";
		}
      if(trim($vCompanyName) != ''){
         $where .= " AND org.vCompanyName LIKE '%$vCompanyName%'";
      }
	}

   switch($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT']){
      case "SM":
          //$where .= " AND iASMID=$sess_id";
			 $where .= " AND uv.iUserID IN (Select iUserID from ".PRJ_DB_PREFIX."_organization_user u INNER JOIN ".PRJ_DB_PREFIX."_organization_master o on u.iOrganizationID=o.iOrganizationID) ";
      break;
      case "OA":
          $ORGID = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGID'];
          $where .= " AND ou.iOrganizationID=$ORGID";
			 $where .= " AND uv.iUserID IN (Select iUserID from ".PRJ_DB_PREFIX."_organization_user where iOrganizationID=$ORGID) ";
      break;
   }
	$where .= " AND ou.eUserType='User' ";
	/*$where .= " AND IF(uv.eStatus='Need to Verify',IF(uv.eCreatedBy='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT']."', uv.iCreatedBy!=".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']." ,1),1)
					AND IF(uv.eStatus='Modified',IF(uv.eModifiedBy='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT']."', uv.iModifiedByID!=".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']." ,1),1)";*/
	$where .= " AND (uv.eStatus = 'Need to Verify' OR uv.eStatus = 'Modified'  OR uv.eStatus = 'Delete' OR uv.eNeedToVerify = 'Yes')";

   if(!isset($ENABLE_AUCTION) || $ENABLE_AUCTION=='No') {
      $where .= " AND org.eOrganizationType!='Buyer2' ";
   }

   ### SORTING ###
	// echo $where; exit;
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
      $orderBy = " uv.iVerifiedID DESC ";
   }
   ## ENDS HERE ###
   $groupby = "iUserID";
	$limit = " LIMIT ".($page-1)*$REC_LIMIT_FRONT.", ".$REC_LIMIT_FRONT." ";
     $jtbl = "	LEFT JOIN ".PRJ_DB_PREFIX."_organization_user ou on uv.iUserID=ou.iUserID
					LEFT JOIN ".PRJ_DB_PREFIX."_country_master cm on BINARY ou.vCountry=cm.vCountryCode
               LEFT JOIN ".PRJ_DB_PREFIX."_organization_master org on ou.iOrganizationID=org.iOrganizationID";
	$userlist = $orgUserPermObj->getJoinTableInfo($jtbl,"ou.iUserID,ou.vFirstName,ou.vLastName,ou.vEmail,ou.eUserType,ou.eStatus,cm.vCountry,org.vCompanyName as OrgName",$where,$orderBy,' ou.iUserID ',$limit,'yes');
	// prints($userlist); exit;
	//$userlist = $orgUserObj->getDetails_PG('*',$where,$orderBy,$groupby,$limit);
     //prints($userlist);exit;
     $count = $userlist['tot'];
	unset($userlist['tot']);

	if(!isset($pgajxobj))
	{
		require_once(SITE_CLASS_GEN."class.paging-ajax.php");
		$pgajxobj = new Paging($count,$page,"listusers",$REC_LIMIT_FRONT);
	}
	$paging = $pgajxobj->getListPG($page);
     //print $paging;
	$pgmsg = $pgajxobj->setMessage("Records");
	//echo $paging; exit;
	$smarty->assign('count',$count);
	$smarty->assign('userlist',$userlist);
	$smarty->assign('paging',$paging);
	$smarty->assign('pgmsg',$pgmsg);
?>