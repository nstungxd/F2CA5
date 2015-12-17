<?php  
include_once("web.config.php");

$dLogoutDate = date("Y-m-d H:i");
$Data =array("dLogoutDate"=>$dLogoutDate);

$dbobj->MySQLQueryPerform(''.PRJ_DB_PREFIX.'_login_history',$Data,'update',"iLLogsId = '".SessionVar(''.PRJ_CONST_PREFIX.'_SESS_ID_LOG')."'");
$err_msg = "You have successfully Logged Out";

foreach($_SESSION as $key=>$val){
  $sesscode = substr($key,0,strlen(PRJ_CONST_PREFIX));
  if($sesscode == ''.PRJ_CONST_PREFIX.''){
    $_SESSION[$key]="";
  }  
}

//session_destroy();
header("Location:".ADMIN_URL);
exit;
?>