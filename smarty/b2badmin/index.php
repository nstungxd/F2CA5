<?php
//error_reporting(-1);
//include('chkconfig.php');
// Set flag that this is a parent file
define( '_B2BXEC', 1);
//define('ADMIN_FOLDER_CONST','wpadmin');

//Set here Base Path
$parts = dirname(__FILE__);
$www_path = '/';
$pos = strrpos($parts,$www_path);

if($pos == true){
    $partArr = @explode("/",$parts);
}else{
    $partArr = @explode("\\",$parts);
}
$partArr = @array_reverse($partArr);

$parts = str_replace($partArr[0],'',$parts);

//Set here Base Path
define('SPATH_BASE',$parts);

//config file
require_once("web.config.php");
//define( 'SITE_URL_DUM','http://' . $_SERVER["HTTP_HOST"] . SITE_FOLDER);

//redirect class
require SITE_CLASS_GEN."class.redirect.php";
$aObj = new Redirect();
$aObj->getRedirect();

?>
