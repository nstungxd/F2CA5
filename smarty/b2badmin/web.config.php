<?php
ob_start();
session_start();
error_reporting(E_ERROR);
//include here settings files
require_once(SPATH_BASE."/libraries/config/routes.php");

//include here vars files
require_once(SITE_FUNC."vars.inc.php");

//include datetime functions
require_once(SITE_FUNC."datetime.inc.php");

//include db query connection file
if(!isset($dbobj)){
	require_once(SITE_CLASS_GEN."class.dbquery.php");
	$dbobj=	new DBConnection(SITE_SERVER, SITE_DB, SITE_USERNAME,SITE_PASS);
}


//include db query connection file
if(!isset($generalobj)){
	require_once(SITE_CLASS_GEN."class.general.php");
	$generalobj=new General();
}


//include db gen file
if(!isset($gdbobj)){
	require_once(SITE_CLASS_GEN."class.dbgen.php");
	$gdbobj=new DBGeneral();
	putenv("TZ=$DEFAULT_TIME");
}

if($HAVE_HTACCESS == 'No') {
    // require_once("replacehtaccess.php");
    define( 'SITE_URL_DUM',		'http://'.$_SERVER["HTTP_HOST"].SITE_FOLDER.'index.php/');
} else {
    define( 'SITE_URL_DUM',		'http://'.$_SERVER["HTTP_HOST"].SITE_FOLDER);
}

//Call Function For Recent Online Members
$generalobj->recent_online();

//include db gen file
if(!isset($adobj)){
	require_once(SITE_CLASS_GEN."class.admin.php");
	$adobj=new Admin();
}

//include db gen file
if(isset($_SESSION[''.PRJ_CONST_PREFIX.'_SESS_USERTYPE'])){
	//include module wise permission file
	if(!isset($accessobj)){
		require_once(SITE_CLASS_APPLICATION."class.accessrights.php");
		$accessobj=new AccessRights();
	}
}

//include menu file
if(!isset($comObj)){
	include_once(SITE_CLASS_GEN."class.admincommon.php");
	$comObj	=	new AdminCommon();
}

//Check Whether Admin Satus Is Active Or Not
if(isset($_SESSION[''.PRJ_CONST_PREFIX.'_SESS_USERTYPE']) && $_SESSION[''.PRJ_CONST_PREFIX.'_SESS_USERTYPE'] == 'Admin'){
	$result = $comObj->isActive($_SESSION[''.PRJ_CONST_PREFIX.'_SESS_USERID']);
	if($result != 1)
	{
		if($_GET['file'] != 'gen-logout' && $_GET['file'] != 'ge-logout'){
			header("Location:".ADMIN_URL."index.php?file=gen-logout");
			exit;
		}
	}
}

/*  Set Cookie for Admin Section */
if(isset($_SESSION[''.PRJ_CONST_PREFIX.'_LOGIN_COOKIE']) && $_SESSION[''.PRJ_CONST_PREFIX.'_LOGIN_COOKIE']!='')
{
	setcookie ("".PRJ_CONST_PREFIX."_LOGIN_COOKIE", $_SESSION[''.PRJ_CONST_PREFIX.'_LOGIN_COOKIE'], time()+2592000,'/');
	setcookie ("".PRJ_CONST_PREFIX."_PASSWORD_COOKIE", $_SESSION[''.PRJ_CONST_PREFIX.'_PASSWORD_COOKIE'], time()+2592000,'/');
	$_SESSION[''.PRJ_CONST_PREFIX.'_LOGIN_COOKIE']='';
	$_SESSION[''.PRJ_CONST_PREFIX.'_PASSWORD_COOKIE']='';
}

elseif(isset($_SESSION[''.PRJ_CONST_PREFIX.'_LOGIN_REMEMBER']) && $_SESSION[''.PRJ_CONST_PREFIX.'_LOGIN_REMEMBER']=='No')
{
	setcookie ("".PRJ_CONST_PREFIX."_LOGIN_COOKIE", '', time()+2592000,'/');
	setcookie ("".PRJ_CONST_PREFIX."_PASSWORD_COOKIE", '', time()+2592000,'/');
	$_SESSION[''.PRJ_CONST_PREFIX.'_LOGIN_REMEMBER']='';
}
?>