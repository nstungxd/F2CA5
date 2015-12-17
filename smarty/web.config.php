<?php
ob_start();
session_start();
error_reporting(E_ERROR);
//No direct access
//defined( '_B2BXEC' )  or die( 'No Direct access' );

//include here settings files
require_once("libraries/config/routes.php");
include_once("libraries/config/fileuploadcfgs.php");

//include here vars files
require_once(SITE_FUNC."language.inc.php");

//include here vars files
require_once(SITE_FUNC."vars.inc.php");

//include datetime functions
require_once(SITE_FUNC."datetime.inc.php");

//include seo file
require_once(SITE_FUNC."seo.inc.php");

if(!isset($dbobj))
{
	require_once(SITE_CLASS_GEN."class.dbquery.php");
	$dbobj=	new DBConnection(SITE_SERVER, SITE_DB, SITE_USERNAME,SITE_PASS);
}
//include db gen file
if(!isset($gdbobj))
{
	require_once(SITE_CLASS_GEN."class.dbgen.php");
	$gdbobj=new DBGeneral();
	// @ putenv("TZ=$DEFAULT_TIME");
	if(function_exists('date_default_timezone_set')) {
		// @ date_default_timezone_set('UTC');
		@ date_default_timezone_set("$DEFAULT_TIME");
	} else {
		// @ putenv("TZ=UTC");
		@ putenv("TZ=$DEFAULT_TIME");
	}
}

$gensconfig = $gdbobj->genSiteConfigs();
$ENABLE_MESSAGE_QUEUE = (isset($gensconfig['ENABLE_MESSAGE_QUEUE']['vValue']))? $gensconfig['ENABLE_MESSAGE_QUEUE']['vValue'] : '';
// prints($_GET); exit;
if(isset($ENABLE_HTTPS) && $ENABLE_HTTPS == 'Yes') {
	if(isset($HAVE_HTACCESS) && $HAVE_HTACCESS == 'No') {
	    require_once("replacehtaccess.php");
	    define( 'SITE_URL_DUM',		'https://'.$_SERVER["HTTP_HOST"].SITE_FOLDER.'index.php/');
	} else {
	    define( 'SITE_URL_DUM',		'https://'.$_SERVER["HTTP_HOST"].SITE_FOLDER);
	}
} else {
	if(isset($HAVE_HTACCESS) && $HAVE_HTACCESS == 'No') {
	    require_once("replacehtaccess.php");
	    define( 'SITE_URL_DUM',		'http://'.$_SERVER["HTTP_HOST"].SITE_FOLDER.'index.php/');
	} else {
	    define( 'SITE_URL_DUM',		'http://'.$_SERVER["HTTP_HOST"].SITE_FOLDER);
	}
}

$SMTP_HOST = (isset($SMTP_HOST))? $SMTP_HOST : '';
$SMTP_SECURE_TYPE = (isset($SMTP_SECURE_TYPE))? $SMTP_SECURE_TYPE : '';
$SMTP_PORT = (isset($SMTP_PORT))? $SMTP_PORT : '';
$SMTP_USERNAME = (isset($SMTP_USERNAME))? $SMTP_USERNAME : '';
$SMTP_PASSWORD = (isset($SMTP_PASSWORD))? $SMTP_PASSWORD : '';

//include db query connection file
if(!isset($generalobj)){
	require_once(SITE_CLASS_GEN."class.general.php");
	$generalobj = new General();
}

$arr_loaded_ext = get_loaded_extensions();
if(in_array('mcrypt',$arr_loaded_ext)){
	if(!isset($encobj)){
		require_once(SITE_CLASS_GEN."class.encryption.php");
		$encobj = new Encryption();
	}
}

//include here breadcums class
require_once(SITE_CLASS_GEN."class.breadcrumb.php");
$bcObj = new Breadcrumb();
?>