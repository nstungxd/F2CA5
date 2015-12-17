<?php
//No direct access
defined('_B2BXEC')  or die( 'No Direct access' );

$reg_globals = ini_get("register_globals");
if (!isset($reg_globals) || !$reg_globals) {
	include_once("globals.php");
}

$file = GetVar('file');
// prints($_GET); exit;
//explode with "-" and find section
$var	=	explode("-",$file);-

$prefix	=	$var[0];
$scr = (isset($var[1]))? $var[1]: '';

if($scr == '')
{
	$scr = 'home';
}
$subsec = '';
switch ($prefix) {
	case "m":
		$sec = "member";
		break;
	case "sm":
		$sec = "member/securitymanager";
      $subsec = "securitymanager";
		break;
	case "or":
		$sec = "member/organization";
      $subsec = "organization";
		break;
	case "u":
		$sec = "member/user";
      $subsec = "user";
		break;
	default:
		$sec = "content";
		break;
}

//include smarty class
require_once(SMARTY_PATH."Smarty.class.php");

//smarty object
$smarty = new Smarty;

//use subdire in template_c folder ?
$smarty->use_sub_dirs = false;

//define here template folder path
$smarty->template_dir	= SPATH_ROOT."/templates";

//define here template_c folder path
$smarty->compile_dir 	= SPATH_ROOT."/templates_c";

//define here template path
$smarty->config_dir 	= SPATH_ROOT."/templates";

//define here cache dire path
//$smarty->cache_dir 		= SPATH_ROOT."/cache";

//define here secure dir path
$smarty->secure_dir 	= SPATH_ROOT."/templates";

//check if compile directory is writable or not?
if( !is_writable($smarty->compile_dir) || !is_dir($smarty->compile_dir) )
{
	echo "Can't write template cache in the directory: <b>".$smarty->compile_dir."</b>.<br>Please check if it exists, and have writable permissions.";
	exit;
}

//set here path for section wise for php files
$pagepath = S_SECTIONS."/".$sec."/".$scr.".php";
// echo $pagepath; exit;

if(!isset($comobj)) {
   require_once(SITE_CLASS_GEN."class.common.php");
   $comobj =	new Common();
}
//echo $DEFAULT_LANGUAGE;exit;
if(!isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG']) || $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG'] == "") {
	$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG']	= $DEFAULT_LANGUAGE;
}

//define here lang for mysql quieres
define("LANG",$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG']);

//include language file
includeLang($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG']);
//print_r($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG']);exit;
//include seo file
$SEOID = "";
$PageType = "";
require_once(SITE_CLASS_GEN."class.seo.php");
$seoobj 	=	new SEO($prefix,$scr,$SEOID,$PageType);
$seoArr 	= 	$seoobj->getmetaarray();

//assign the file names which won't include the total index page
// pr($_GET); exit;
$notincludeindex = array("m-changepass","or-aj_organizationlist","u-aj_organizationuserlist","u-aj_grouplist","or-aj_getSellerOrgAsso","or-aj_associationlist","or-aj_verifyorganizationlist","or-aj_verifyassociationlist","u-aj_getOrganizationUserStatus","u-aj_verifyorganizationuserlist","u-aj_verifygrouplist","or-aj_verifyorgpreflist","m-aj_loginlist","m-aj_inbox","or-aj_orgoverview","or-aj_orgprfoverview","or-aj_assocoverview","u-aj_groupoverview","u-aj_useroverview","u-aj_invoicelist","u-aj_invacptlist","u-aj_polist","u-aj_poacptlist","or-orgprefviewhistory","or-orgviewhistory","or-asocviewhistory","u-orguserviewhistory","u-groupviewhistory","u-urightsviewhistory","u-poviewhistory","u-invoiceviewhistory","u-changesecans","u-aj_getInvPoItem","m-aj_getCombo","u-aj_verifyrights","u-aj_listrights","m-aj_chkpage","c-closepage",
                        "or-aj_b2bprdtassoclist","or-aj_b2bprdtascprv","or-b2bprdthistory","or-aj_b2bprdtassoclist_a","or-aj_b2bprdtassovlist","or-aj_b2sprdtassoclist","or-b2sprdthistory","or-aj_b2sprdtassoclist_a","or-aj_b2sprdtassocvlist","or-aj_b2buyerasoclist","or-aj_b2buyerasocvlist","or-b2buyerhistory","or-aj_b2supplierasoclist","or-aj_b2supplierasocvlist","or-b2supplierhistory","or-aj_b2bprdtbassoclist","or-aj_b2bprdtbassovlist","or-b2bprdtbhistory","or-aj_b2sprdtsassoclist","or-aj_b2sprdtsassovlist","or-b2sprdtshistory","or-aj_getb2bpdtlsfa",
								"u-aj_rfq2list","u-aj_rfq2vlist","u-aj_rfq2rlist","u-rfq2viewhistory","u-aj_b2rfq2list","u-aj_getrfq2details","u-viewrfq2bidhistory","u-aj_b2rfq2bidlist","u-aj_b2rfq2bidvlist","u-aj_b2rfq2bidrlist","u-aj_rfq2bidlist","u-aj_addwatchlist","u-aj_b2rfq2watchlist","u-aj_removewatchlist","u-aj_rfq2awardlist","u-aj_b2rfq2awardlist","u-viewrfq2awardhistory","u-viewb2rfq2awardhistory","m-inetreports"
                     );
if(isset($_GET['msg']) && $_GET['msg']=='pop') {
	$notincludeindex = array_merge($notincludeindex,array($_GET['file']));
}
//,"or-createorganization","sm-smdashboard","m-inbox"
//prints($notincludeindex); exit;
//echo $file;
$notUserLeft = array("c-home","c-aboutus","c-contactus","c-privacypolicy",'c-404error','c-closepage');
$notUserTop = array("c-home","c-aboutus","c-contactus","c-privacypolicy",'c-404error','c-closepage');
$bodyarr = array();

// if(!in_array($scr, $notincludeindex)) {
	include_once(SPATH_ROOT."/section/content/common.php");
/*} else {
	//header('Content-Type: text/html; charset=iso-8859-1');
}*/
include_once('setpages.php');
// echo $pagepath;
// echo file_exists($pagepath); exit;
if(file_exists($pagepath)) {
   include_once($pagepath);
} else {
   header("Location: index.php");
   exit();
}

if($file != 'c-404error') {
	include_once(SPATH_ROOT."/section/content/setaccess.php");
}
//include_once('');

//define here page
$smarty->assign("page",$scr);

//define here prefix
$smarty->assign("prefix",$prefix);

//define here section
$smarty->assign("section",$sec);
$smarty->assign("subsec",$subsec);

//define here generalize variables of front section like siteurl,path,bottom text,etc...
$smarty->register_modifier("sslash","stripslashes");

//assign the file names which won't include left.tpl
$notincleft = array();


////commment when development [Caching files for pages]
if($sec == "content"){
  $sec_pre = "c";
  //include_caching($scr,$sec_pre);
}

//logout from here
$slog = $generalobj->getlogoutset();
// prints($slog); exit;
if(is_array($slog) && count($slog)>0) {
	header("Location: ".SITE_URL_DUM."logout/sotp");
	exit;
}

//Call Function For Recent Online Members
$generalobj->recent_online();

$smarty->assign("LANG",LANG);
$smarty->assign("SITE_SEO_TITLE",stripslashes($seoArr['tTitle']));
$smarty->assign("META_KEYWORD",$seoArr['tKeyword']);
$smarty->assign("META_DESCRIPTION",$seoArr['vMeta_Description']);
$smarty->assign("META_OTHER",$META_OTHER);

$smarty->assign("COLOR_BOX_URL",COLOR_BOX_URL);
// $smarty->assign("LIGHTVIEW_URL",LIGHTVIEW_URL);
$smarty->assign("TINY_MCE",TINY_MCE);
$smarty->assign("S_SECTIONS",S_SECTIONS);

$smarty->assign("COPYRIGHT_TEXT",$COPYRIGHT_TEXT);
$smarty->assign("SUPPORT_EMAIL",$SUPPORT_EMAIL);
if(isset($SET_BREADCUM)) {
	$smarty->assign("SET_BREADCUM",$SET_BREADCUM);
}
$smarty->assign("DATEPICKER",DATEPICKER);
$smarty->assign("DATETIMEPICKER",DATETIMEPICKER);

$smarty->assign('notincludeindex',$notincludeindex);
$smarty->assign('notUserLeft',$notUserLeft);
$smarty->assign('notUserTop',$notUserTop);


$smarty->assign("file",$file);

$smarty->assign("SITE_URL",SITE_URL);
$smarty->assign("SITE_URL_DUM",SITE_URL_DUM);
$smarty->assign("SPATH_ROOT",SPATH_ROOT);
$smarty->assign("SITE_CSS",SITE_CSS);
$smarty->assign("SITE_IMAGES",SITE_IMAGES);
$smarty->assign("SITE_TITLE",$SITE_TITLE);
if(isset($COPYRIGHT)) {
	$smarty->assign("COPYRIGHT",$COPYRIGHT);
}
$smarty->assign("SITE_NAME",$SITE_NAME);
$smarty->assign("FRONT_REC_LIMIT",$REC_LIMIT_FRONT);
$smarty->assign("SITE_CONTENT_JS",SITE_CONTENT_JS);
if(isset($CHK_DUPLICAT_EMAIL)) {
	$smarty->assign("CHK_DUPLICAT_EMAIL",$CHK_DUPLICAT_EMAIL);
}

//Contact US Inforamtion
$smarty->assign("Contact_Address",$Contact_Address);
$smarty->assign("Contact_Phone",$Contact_Phone);
$smarty->assign("Contact_Fax",$Contact_Fax);
$smarty->assign("SUPPORT_EMAIL",$SUPPORT_EMAIL);
$smarty->assign("SITE_ADV_SUPPORT_TEXT",$SITE_ADV_SUPPORT_TEXT);

$smarty->assign("SITE_JS",SITE_JS);
$smarty->assign("S_JQUERY",S_JQUERY);
$smarty->assign("CK_EDITOR_PATH",CK_EDITOR_PATH);
$smarty->assign("CK_EDITOR_URL",CK_EDITOR_URL);
$smarty->assign("SITE_JS_AJAX",SITE_JS_AJAX);
$smarty->assign("SITE_VALIDATION_JS",SITE_VALIDATION_JS);
$smarty->assign("SITE_CONTENT_JS",SITE_CONTENT_JS);
// $smarty->assign("S_PROTOTYPE",S_PROTOTYPE);
$smarty->assign("SITE_CO_URL",SITE_CO_URL);
$smarty->assign("COPYRIGHT_TEXT",$COPYRIGHT_TEXT);
$smarty->assign("PRJ_DB_PREFIX",PRJ_DB_PREFIX);
$smarty->assign("PRJ_CONST_PREFIX",PRJ_CONST_PREFIX);
$smarty->assign("bodyid",$bodyid);
$smarty->assign("bodycls",$bodycls);
$smarty->assign("dvid",$dvid);
$smarty->assign("mdivid",$mdivid);
$smarty->assign("cssfile",$cssfile);
$curSessid = (isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']))? $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']: '';
$smarty->assign("curSessid",$curSessid);

//Prints($_SESSION);exit;
//display index file tpl
$smarty->display("index.tpl");
$smarty->clear_all_assign();
$dbobj->MySQLClose();
unset($dbobj);
include_once(S_SECTIONS."/member/atlast.php");
exit;
?>