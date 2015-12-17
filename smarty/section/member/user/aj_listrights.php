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
	$sfor = (isset($_POST['slfor']))? $_POST['slfor'] : '';
    $stype = (isset($_POST['styp']))? $_POST['styp'] : '';

	if(trim($page) == '' || trim($page) < 1)
	{ $page = 1; }
	// prints($_POST); exit;
	if(!isset($orgUserObj))
	{
		include_once(SITE_CLASS_APPLICATION."user/class.OrganizationUser.php");
		$orgUserObj = new OrganizationUser();
	}
	$where = "";
	if($mode == 'all')
	{
          if($val != '')
		$where = " AND (ou.vFirstName LIKE '%$val%' OR ou.vLastName LIKE '%$val%' OR ou.vEmail LIKE '%$val%' OR ou.eUserType LIKE '%$val%' OR ou.vCountry LIKE '%$val%' OR CONCAT(ou.vFirstName,' ',ou.vLastName) LIKE '%$val%' )";
	}
	else if($mode == 'srch')
	{
		if(trim($vUserName) != '')
		{
			$where = " AND (ou.vFirstName LIKE '%$vUserName%' || ou.vLastName LIKE '%$vUserName%') ";
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

   //Prints($_SESSION);exit;


   switch($sess_usertype){
      case "securitymanager":
          //$where .= " AND iASMID=$sess_id";
      break;
      case "orgadmin":
          $ORGID = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGID'];
          $where .= " AND ou.iOrganizationID=$ORGID";
      break;
   }

	$where .= " AND ou.eUserType='User' ";
	// $where .= " AND (ou.eStatus!='Delete' OR ou.iCreatedBy=".$sess_id." OR ou.iModifiedByID=".$sess_id.") ";
	// $where .= " AND (ou.eStatus!='Delete' OR ou.iCreatedBy=".$sess_id." OR ou.iModifiedByID=".$sess_id.") ";
	// $where .= " AND ou.eStatus != 'Need to Verify' AND ou.eStatus != 'Modified' AND ou.eStatus != 'Delete' AND ou.eNeedToVerify != 'Yes' ";
	if($stype == 'act') {
		$where .= " AND up.eStatus='Active' ";
	} else if($stype == 'inact') {
		$where .= " AND up.eStatus='Inactive' ";
	}
   if(!isset($ENABLE_AUCTION) || $ENABLE_AUCTION=='No') {
      $where .= " AND org.eOrganizationType!='Buyer2' ";
   }

	/*if($sfor == 'usr') {
		$where .= " AND ou.eUserType='User' ";
	} else if($sfor == 'adm') {
		$where .= " AND ou.eUserType='Admin' ";
	}*/
	// $where .= " AND ou.eUserType='User' ";
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
      $orderBy = " ou.dLastAccessDate DESC ";
   }
   ## ENDS HERE ###

	$limit = " LIMIT ".($page-1)*$REC_LIMIT_FRONT.", ".$REC_LIMIT_FRONT." ";
   // echo $where; exit;
   $jtbl = " INNER JOIN ".PRJ_DB_PREFIX."_organization_user_permission up on ou.iUserID=up.iUserID
				LEFT JOIN ".PRJ_DB_PREFIX."_country_master cm on BINARY ou.vCountry=cm.vCountryCode
        		LEFT JOIN ".PRJ_DB_PREFIX."_organization_master org on org.iOrganizationID=ou.iOrganizationID";
	$userlist = $orgUserObj->getJoinTableInfo($jtbl,"ou.iUserID,ou.vFirstName,ou.vLastName,ou.vEmail,ou.eUserType,ou.eStatus,cm.vCountry,org.vCompanyName as OrgName",$where,$orderBy,'',$limit,'yes');

	//$userlist = $orgUserObj->getDetails_PG('',$where,$orderBy,'',$limit);
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