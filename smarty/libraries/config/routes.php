<?php
/**
* @version	 : routes.php
* Configration file, define here all vars related to general config
*/

define('PRJ_DB_PREFIX','b2b');
define('PRJ_CONST_PREFIX','/');
define('ADMIN_FOLDER_CONST','b2badmin');
$prj_site_name = '/';
//No direct access
//defined( '_B2BXEC' )  or die( 'No Direct access' );

//base site path, url
$parts = explode( "/", SPATH_BASE);


if(in_array(ADMIN_FOLDER_CONST,$parts)) array_pop( $parts );
// echo "<pre>";
// print_r($_SERVER); exit;
// $parts = array_filter($parts);
define('SPATH_ROOT', rtrim(implode( "/", $parts),'\/')); 	// used rtrim to remove extra //
//echo SPATH_ROOT;
$site_foler = str_replace($_SERVER['DOCUMENT_ROOT'],'',$_SERVER['SCRIPT_FILENAME']);

if(strpos($site_foler,'/')!==0) { $site_foler = '/'.$site_foler; }
$site_foler = substr($site_foler,0,strpos($site_foler,$prj_site_name)+strlen($prj_site_name));
// echo $site_foler; exit;
//$site_foler = '/exchdemo/';
define('SITE_FOLDER', $site_foler);
//echo $site_foler;
// echo SITE_FOLDER; //exit;
// define( 'SITE_FOLDER', '/B2B/');

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=="on") {
	define( 'SITE_URL',	'https://' . $_SERVER["HTTP_HOST"] . SITE_FOLDER);
} else {
	define( 'SITE_URL',	'http://' . $_SERVER["HTTP_HOST"] . SITE_FOLDER);
}
//echo SITE_URL;
// define( 'SITE_URL',	'http://' . $_SERVER["HTTP_HOST"] . SITE_FOLDER);
// define( 'SITE_URL_DUM',	'http://' . $_SERVER["HTTP_HOST"] . SITE_FOLDER);
define( 'SITE_IMAGES',SITE_URL . 'images/');

//database configuration
define( 'SITE_SERVER','localhost');
define( 'SITE_DB','b2braw');
define( 'SITE_USERNAME','root');
define( 'SITE_PASS','');

//site libraries path
define( 'SITE_LIB',		SPATH_ROOT . '/libraries/');
define( 'S_SECTIONS',	SPATH_ROOT . "/section");
define( 'SITE_CACHES_FILES', SPATH_ROOT . '/cache/');

//site class directory
define( 'SITE_CLASS',	SITE_LIB . 'classes/');
define( 'SITE_CLASS_GEN',	SITE_LIB . 'classes/general/');
define( 'SITE_CLASS_APPLICATION',	SITE_LIB . 'classes/application/');

//set funcs folder
define( 'SITE_FUNC',	SITE_LIB . 'func/');

//libraries section ends here

//Language Folder
define( 'SITE_LABEL_PATH',	SPATH_ROOT.'/language/');
//front ends  css & js
define( 'SITE_CSS_PATH',	SPATH_ROOT . '/css/');
define( 'SITE_CSS',	SITE_URL . 'css/');
define( 'SITE_JS',	SITE_URL . 'js/');
define( 'SITE_JS_AJAX',	SITE_URL . 'js/ajax/');
define( 'SITE_AJAX_URL',SITE_URL . 'ajax_xml/');
define( 'SITE_CONTENT_JS',	SITE_JS . 'general/');
define( 'SITE_VALIDATION_JS',	SITE_JS . 'validation/');
define( 'S_JQUERY',	SITE_JS . 'jquery/');
define( 'S_SCRIPT',	SITE_JS . 'script/');
define( 'S_GOOGLE_LANG',	SITE_JS . 'GoogleLang/');


//font path
//define( 'SITE_FONT_PATH',	SITE_CSS_PATH.'fonts/');

### Set components path & url ###
define( 'SITE_CO_PATH',	SPATH_ROOT . '/components/');
define( 'SITE_CO_URL',	SITE_URL . 'components/');
define( 'SMARTY_PATH',	SITE_CO_PATH . 'smarty/');

// define( 'SITE_OFC', SITE_CO_PATH . 'ofc/');

define( 'CK_EDITOR_PATH',			SITE_CO_PATH . 'ckeditor/');
define( 'CK_EDITOR_URL',			SITE_CO_URL . 'ckeditor/');
define( 'TINY_MCE',			SITE_CO_URL . 'tiny_mce/');
define( 'DATEPICKER',		SITE_CO_URL . 'date/');
define( 'DATETIMEPICKER',		SITE_CO_URL . 'datetimepicker/');
define( 'COLOR_BOX_URL',	SITE_CO_URL . 'colorbox/');

//set backups path & URL
define( 'SITE_BACKUP_PATH',		SPATH_ROOT . '/s_back_ups/');
define( 'SITE_BACKUP_URL',		SITE_URL . 's_back_ups/');
define( 'BACKUP_DBPATH',		SITE_BACKUP_PATH . 'db/');
define( 'BACKUP_DBURL',			SITE_BACKUP_URL . 'db/');
define( 'BACKUP_SOURCEPATH',	SITE_BACKUP_PATH . 'src/');
define( 'BACKUP_SOURCEURL',		SITE_BACKUP_URL . 'src/');


//Administrator Settings Starts From Here
define( 'ADMIN_FOLDER',		ADMIN_FOLDER_CONST . '/');
define( 'SAPATH_ROOT',		SPATH_ROOT."/".ADMIN_FOLDER);
define( 'ADMIN_URL',		SITE_URL.ADMIN_FOLDER_CONST . '/');


define( 'ADMIN_IMAGES',		ADMIN_URL . 'images/');
define( 'ADMIN_ICONS',		ADMIN_IMAGES . 'icons/');
define( 'ADMIN_THEME',		SITE_URL.ADMIN_FOLDER."theme/");

//script base url section starts here
define( 'ADMIN_SCRIPT_URL',		ADMIN_URL . 'script/');

//main
define( 'A_M_MAIN',			ADMIN_SCRIPT_URL . 'main/');

define( 'A_M_GENE_URL',		A_M_MAIN . 'general/');
//

//action starts from here
define( 'A_M_ACTION',		ADMIN_SCRIPT_URL . 'action/');

define( 'A_A_GENE_URL',		A_M_ACTION . 'general/');
//ends here

define( 'ADMIN_AJAX_URL',		ADMIN_SCRIPT_URL . 'ajax_xml/');
define( 'ADMIN_GENERAL_URL',	ADMIN_SCRIPT_URL . 'general/');

//plugins path & url
define( 'A_PLUGINS',	ADMIN_URL . 'plugins/');
define( 'A_PLUGINS_MENU',	A_PLUGINS . 'menu/');
//

//js path set here
define( 'A_M_JS',				ADMIN_URL . 'js/');
define( 'A_M_AJAX_JS',			A_M_JS . 'ajax/');
define( 'A_G_JS',				A_M_JS . 'general/');
define( 'A_M_PROTOTYPE_JS',		A_M_JS . 'prototype/');
define( 'A_G_VALIDATION_JS',	A_M_JS . 'validation/');

define( 'FLASH_TOOL_PATH',	SPATH_ROOT . '/flash/');
define( 'FLASH_TOOL_URL',	SITE_URL . 'flash/');
//Administrator section ends here

##### Set Image Congigurations Here ######
//Temporary Upload Folder
define('SITE_FONT_PATH', SPATH_ROOT . '/fonts/');
///echo SITE_FONT_PATH;
define('ADMIN_FONT_PATH', SAPATH_ROOT . 'fonts/');
define('FLASH_FONT_PATH', FLASH_TOOL_PATH . 'fonts/');

define('SITE_TEMP_UPLOAD_PATH', SPATH_ROOT . '/upload/temp_gallery/');

//$site_pdfchets_path = SITE_PDF_PATH;
//$hb_uploadTemplate_path = SITE_PRODXML_PATH;
//$hb_uploadTemplate_url =  SITE_PRODXML_URL;

//Member Images
$cfgimg['User_image']['image']['imgconfig'][] = array("ID" =>1,"width" =>"50","height" => "50");
$cfgimg['User_image']['image']['imgconfig'][] = array("ID" =>2,"width" =>"150","height" => "150");
$cfgimg['User_image']['image']['imgconfig'][] = array("ID"=>3,"width" =>"","height" => "");
$cfgimg['User_image']['image']['path'] = SPATH_ROOT . '/upload/User_image/';
$cfgimg['User_image']['image']['url'] =  SITE_URL . 'upload/User_image/';
//Member Files


define('FILES_UPLOAD_PATH',SPATH_ROOT.'/upload/files_media/');
define('FILES_UPLOAD_URL',SITE_URL.'upload/files_media/');

define('EXPORT_FILES_PATH',SPATH_ROOT.'/upload/export/');
define('EXPORT_FILES_URL',SITE_URL.'upload/export/');

//Member Images
$cfgimg['IMPORT_FILES_PATH']['file']['imgconfig'][] = array("ID"=>1,"width" =>"","height" => "");
$cfgimg['IMPORT_FILES_PATH']['file']['path'] = SPATH_ROOT . '/upload/import/';
$cfgimg['IMPORT_FILES_PATH']['file']['url'] =  SITE_URL . 'upload/import/';

// Invoice Images
$cfgimg['INV']['image']['imgconfig'][] = array("ID"=>1,"width" =>"","height" => "");
$cfgimg['INV']['image']['path'] = SPATH_ROOT . '/upload/invoice_images/';
$cfgimg['INV']['image']['url'] =  SITE_URL . 'upload/invoice_images/';

// PO Images
$cfgimg['PO']['image']['imgconfig'][] = array("ID"=>1,"width" =>"","height" => "");
$cfgimg['PO']['image']['path'] = SPATH_ROOT . '/upload/po_images/';
$cfgimg['PO']['image']['url'] =  SITE_URL . 'upload/po_images/';

// PO Attachment Docs
$cfgimg['PO']['docs']['imgconfig'][] = array("ID"=>1,"width" =>"","height" => "");
$cfgimg['PO']['docs']['path'] = SPATH_ROOT . '/upload/attachment_docs/po/';
$cfgimg['PO']['docs']['url'] =  SITE_URL . 'upload/attachment_docs/po/';

// Invoice Attachment Docs
$cfgimg['INV']['docs']['imgconfig'][] = array("ID"=>1,"width" =>"","height" => "");
$cfgimg['INV']['docs']['path'] = SPATH_ROOT . '/upload/attachment_docs/invoice/';
$cfgimg['INV']['docs']['url'] =  SITE_URL . 'upload/attachment_docs/invoice/';

//Member Files
define('SAMPLE_FILES_PATH',SPATH_ROOT.'/upload/sample/');
define('SAMPLE_FILES_URL',SITE_URL.'upload/sample/');

//Banner section
$cfgimg['video']['video']['imgconfig'][] = array("ID" =>1,"width" =>"320","height" => "240");
//Display on its sections pages.
$cfgimg['video']['video']['path'] = SPATH_ROOT.'/upload/video/';
$cfgimg['video']['video']['url'] =  SITE_URL.'upload/video/';

### Image Settings Ends Here ####
?>
