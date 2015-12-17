<?php
$msg = $_GET['msg'];
$dLogoutDate = date("Y-m-d H:i:s");
$sesslogId = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LOG_ID'];

$sql = "update ".PRJ_DB_PREFIX."_login_history set dLogoutDate = '".$dLogoutDate."' where iLLogsId = '".$sesslogId."'";
$d_sql = $dbobj->sql_query($sql);
unset($_SESSION['prc']);
unset($_COOKIE['bt_prc']);
if($msg=='sotp') {
	$sessid = session_id();
	$sql = "update ".PRJ_DB_PREFIX."_recent_online set eSetLogout='No' where vSessionId='$sessid'";
	$d_sql = $dbobj->sql_query($sql);
	unset($_SESSION['mlusr']);
}

if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE'] == 'orguser')
{
	$table = PRJ_DB_PREFIX.'_organization_user';
	$iPrId = 'iUserID';
}
else if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE'] == 'securitymanager')
{
	$table = PRJ_DB_PREFIX.'_security_manager';
	$iPrId = 'iSMID';
}

if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'] != '') {
	$sql_u = "update $table  set dLastAccessDate = '".$dLogoutDate."' where $iPrId= '".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']."'";
	$d_sql_u = $dbobj->sql_query($sql_u);
}

if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'] == '' && trim($msg)=='') {
   $msg = 'sessexp';
}

if($_SESSION['FROM_ADMIN'] == 'Yes')
{
	foreach($_SESSION as $key=>$val)
   {
	  $sesscode = substr($key,0,strlen(PRJ_CONST_PREFIX)+5);
	  if($sesscode == 'SESS_'.PRJ_CONST_PREFIX.'')
     {
		unset($_SESSION[$key]);
	  }
	}
   unset($_SESSION['FROM_ADMIN']);
   unset($_SESSION['showfilter']);
	//redirect after process complete
	header("Location:".ADMIN_URL."index.php?file=ge-admin&view=index&AX=Yes");
   exit;
}
else
{
	foreach($_SESSION as $key=>$val)
   {
	  $sesscode = substr($key,0,strlen(PRJ_CONST_PREFIX)+5);
	  if($sesscode == 'SESS_'.PRJ_CONST_PREFIX.'')
     {
		unset($_SESSION[$key]);
	  }
	}
//   unset($_SESSION['showfilter']);
	//message set here
	if($msg == '') {
	  $msg = "succlgout";
	} else {
	  $msg = $msg;
	}

	header("Location:".SITE_URL_DUM."home/".$msg."");
	exit;

/*   if($msg == 'planexpired'){
      //redirect after process complete
	  header("Location:".SITE_URL_DUM."home/".$msg."");
     exit;
   } else {
      header("Location:".SITE_URL_DUM."login/".$msg."");
      exit;
   }*/

}
/*echo "<pre>";
print_r($_SESSION);exit;*/
// exit;
?>