<?php

include(S_SECTIONS."/member/memberaccess.php");

if(!isset($inboxDelObj)){
	include_once(SITE_CLASS_APPLICATION."class.UserDeletedInbox.php");
	$inboxDelObj = new UserDeletedInbox();
}
   //Prints($_SESSION);exit;
	$page = $_POST['page'];
   if(trim($page) == '' || trim($page) < 1) {
	     $page = 1;
   }
   $search_key = (isset($_POST['search_key']))? $_POST['search_key'] : '';
   $from = (isset($_POST['from']))? $_POST['from'] : '';
	// $from = calcGTzTime($from, 'Y-m-d H:i:s');
   $to = (isset($_POST['to']))? $_POST['to'] : '';
	// $to = calcGTzTime($to, 'Y-m-d H:i:s');
//prints($_REQUEST);
   $sess_id = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
   $curViewedInbox = (isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_INBOX_VIEWED']))? $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_INBOX_VIEWED'] : '';

   switch($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT']){
      case "SM":
         $sessType = 'SM';
         $where = ' AND ((iCreatedBy <> \''.$sess_id.'\' AND eCreatedType = \''.$sessType.'\') OR eCreatedType = \'OA\' OR eCreatedType = \'OU\') ';
      break;
      case "OA":
         $sessType = 'OA';
         $where.= ' AND ((eCreatedType = \'OA\' AND iCreatedBy <> \''.$sess_id.'\') OR eCreatedType = \'OU\') AND iOrganizationId='.$curORGID;
      break;
      case "OU":
         $sessType = 'OU';
         $where = ' AND ((eCreatedType = \'OU\' AND iCreatedBy <> \''.$sess_id.'\') AND iOrganizationId='.$curORGID.' )';	// OR eCreatedType = \'OU\'
      break;
   }

   if($curViewedInbox == ''){
      $curViewedInbox = array();
   }


   $where.= ' AND iVerifiedID NOT IN (SELECT iInboxId FROM '.PRJ_DB_PREFIX.'_user_deleted_inbox WHERE iUserId = \''.$sess_id.'\' AND eUserType = \''.$sessType.'\' AND eViewed!=\'Yes\' )';
   if(trim($search_key) != ''){
      $where.=' AND vMailSubject_'.LANG.' LIKE(\'%'.$search_key.'%\')';
   }

   if(trim($from) != ''){
      $where.=' AND dActionDate>=\''.$from.'\'';
   }

   if(trim($to) != ''){
      $where.=' AND dActionDate<=\''.$to.'\'';
   }
//	  echo $where; exit;
	$orderBy = " ORDER BY iVerifiedID DESC";
	$limit = " LIMIT ".($page-1)*$REC_LIMIT_FRONT.", ".$REC_LIMIT_FRONT." ";
//print $where;
   $sql_cnt = 'CALL GetInbox("'.$sessType.'","'.$where.'","","'.$orderBy.'","")';
	// echo $sql_cnt; exit;
   $cnt = $dbobj->Onlyquery($sql_cnt);

   $sql_res = 'CALL GetInbox("'.$sessType.'"," '.$where.'","","'.$orderBy.'","'.$limit.'")';
	// echo $sql_res; exit;
   $res = $dbobj->Onlyquery($sql_res);

	$count = count($cnt);

	if(!isset($pgajxobj)) {
	  require_once(SITE_CLASS_GEN."class.paging-ajax.php");
	}

   $pgajxobj = new Paging($count,($page),"listgroup",$REC_LIMIT_FRONT);
	$paging = $pgajxobj->getListPG($page);
	$pgmsg = $pgajxobj->setMessage("Records");
	//echo $paging; exit;

   $readm = array();
   $dmdtl = $inboxDelObj->getDetails('iInboxId'," AND eUserType='$sessType' AND iUserId=$sess_id ");
	for($l=0;$l<count($dmdtl);$l++) {
	  $readm[] = $dmdtl[$l]['iInboxId'];
	}

   // prints($res); exit;
	//$smarty->assign('orglist',$orglist);
   $smarty->assign('curViewedInbox',$curViewedInbox);
   $smarty->assign('activegroup',$res);
	$smarty->assign('readm',$readm);
	$smarty->assign('paging',$paging);
	$smarty->assign('pgmsg',$pgmsg);
?>