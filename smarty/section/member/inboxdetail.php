<?php
include(S_SECTIONS."/member/memberaccess.php");

$id = $_GET['id'];
$where = " AND iVerifiedID=$id";
/*if($sess_usertype_short != 'SM'){
   $where .= " AND iOrganizationId=$curORGID ";
}*/

$sql_res = 'CALL GetInbox("'.$sess_usertype_short.'","'.$where.'","","'.$orderBy.'","")';
$res = $dbobj->Onlyquery($sql_res);
$curViewedsess = isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_INBOX_VIEWED']) ? $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_INBOX_VIEWED']: '';
if(!@in_array($id,$curViewedsess)){
   $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_INBOX_VIEWED'][] = $id;
}
// prints($res);exit;

// set as viewed
if(!isset($inboxDelObj)){
	include_once(SITE_CLASS_APPLICATION."class.UserDeletedInbox.php");
	$inboxDelObj = new UserDeletedInbox();
}
$dmdtl = $inboxDelObj->getDetails('*'," AND iInboxId=$id AND eUserType='$sess_usertype_short' AND iUserId=$sess_id ");
if(is_array($dmdtl) && count($dmdtl)<1) {
   $dtl = array('iUserId' => $sess_id, 'eUserType' => $sess_usertype_short, 'iInboxId' => $id, 'eViewed' => 'Yes');
   // prints($dtl); exit;
   $inboxDelObj->setAllVar($dtl);
   $vrfres = $inboxDelObj->insert();
}
if($HAVE_HTACCESS == 'No') {
	// prints($res);
	// $res[0]['tMailContent_en'] = preg_replace('/\<a(.*)'.SITE_URL.'/$',SITE_URL_DUM,$res[0]['tMailContent_en']);
	$res[0]['tMailContent_en'] = str_replace(SITE_URL,SITE_URL_DUM,$res[0]['tMailContent_en']);
	$res[0]['tMailContent_fr'] = str_replace(SITE_URL,SITE_URL_DUM,$res[0]['tMailContent_fr']);
	$res[0]['tMailContent_fr'] = str_replace(SITE_URL,SITE_URL_DUM,$res[0]['tMailContent_fr']);
}
$smarty->assign('res',$res);
?>