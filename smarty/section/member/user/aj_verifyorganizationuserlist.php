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
	$where = "";
	if($mode == 'all')
	{
      if($val != '')
		$where = " AND (ou.vFirstName LIKE '%$val%' OR ou.vLastName LIKE '%$val%' OR ou.vEmail LIKE '%$val%' OR ou.eUserType LIKE '%$val%' OR ou.vCountry LIKE '%$val%')";
		if(trim($eUserType)!='') {
			$where .= " AND ou.eUserType='$eUserType' ";
		}
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
		if(trim($eUserType) != '')
		{
			$where .= " AND ou.eUserType='$eUserType'";
		}
		if(trim($vCountry) != '')
		{
			$where .= " AND ou.vCountry='$vCountry'";
		}
      if(trim($vCompanyName) != ''){
         $where .= " AND org.vCompanyName LIKE '%$vCompanyName%'";
      }
	}
   switch($sess_usertype) {
      case "securitymanager":
          //$where .= " AND iASMID=$sess_id";
          $where .= " AND ou.iUserID IN (Select iUserID from ".PRJ_DB_PREFIX."_organization_user u INNER JOIN ".PRJ_DB_PREFIX."_organization_master o on u.iOrganizationID=o.iOrganizationID) ";
      break;
      case "orgadmin":
          $ORGID = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGID'];
          $where .= " AND ou.iOrganizationID=$ORGID";
          $where .= " AND ou.iUserID IN (Select iUserID from ".PRJ_DB_PREFIX."_organization_user where iOrganizationID=$ORGID) ";
      break;
   }

//	if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE'] == 'securitymanager') {
		//$where .= " AND (iCreatedBy <> '".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']."' AND eCreatedBy = 'SM')";
//	} else {
	   //$where .= " AND iASMID <> '".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']."'";
		//exit;
//	}
//	$where .= " AND ((iCreatedBy!='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']."' AND eCreatedBy='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT']."') OR ((iModifiedByID!='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']."' AND eModifiedBy='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT']."')))";

//	$where .= " AND (IF(eCreatedBy='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT']."',iCreatedBy!='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']."',1)) ";
//	$where .= " AND (IF(eModifiedBy='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT']."',iModifiedByID!='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']."',1)) ";
	/*$where .= " AND IF(ou.eStatus='Need to Verify',IF(ou.eCreatedBy='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT']."', ou.iCreatedBy!=".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']." ,1),1)
					AND IF(ou.eStatus='Modified',IF(ou.eModifiedBy='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT']."', ou.iModifiedByID!=".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']." ,1),1)";*/
	$where .= " AND (ou.eStatus = 'Need to Verify' OR ou.eStatus = 'Modified'  OR ou.eStatus = 'Delete' OR (ou.eStatus = 'Inactive' AND ou.eNeedToVerify = 'Yes') OR (ou.eStatus = 'Active' AND ou.eNeedToVerify = 'Yes'))";

   if(!isset($ENABLE_AUCTION) || $ENABLE_AUCTION=='No') {
      $where .= " AND org.eOrganizationType!='Buyer2'";
   }

   ### SORTING ###
   $cursort = $_POST['cursort'];
   $cursorttype = $_POST['cursorttype'];
   if($cursort != ''){
      if($cursorttype == '1') {
         $cursort_type = 'ASC';
      } else {
         $cursort_type = 'DESC';
      }
      $orderBy = " $cursort $cursort_type";
   }else{
      $orderBy = " ou.iVerifiedID DESC ";
   }
   ## ENDS HERE ###

   $groupby = "iUserID";
	$limit = " LIMIT ".($page-1)*$REC_LIMIT_FRONT.", ".$REC_LIMIT_FRONT." ";
   $jtbl = "INNER JOIN ".PRJ_DB_PREFIX."_organization_master org on (org.iOrganizationID=ou.iOrganizationID AND NOT (org.eStatus='Delete' AND org.eNeedToVerify='No'))
				  LEFT JOIN ".PRJ_DB_PREFIX."_country_master cm on BINARY ou.vCountry=cm.vCountryCode";
	$userlist = $orgUserObj->getJoinTableInfo($jtbl,"ou.iUserID,ou.vFirstName,ou.vLastName,ou.vEmail,ou.eUserType,ou.eStatus,cm.vCountry,org.vCompanyName as OrgName",$where,$orderBy,' ou.iUserID ',$limit,'yes');

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
