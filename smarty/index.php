<?php
// error_reporting(-1);    // E_ALL |
//include('chkconfig.php');
// Set flag that this is a parent file
define( '_B2BXEC', 1);
//Set here Base Path
define('SPATH_BASE', dirname(__FILE__) );
$parts_org = SPATH_BASE;
$parts_orgArr = explode( "/", $parts_org);
//config file
require_once("web.config.php");
//echo '<noscript><meta http-equiv="REFRESH" content="0; URL='.SITE_URL_DUM.'nojavascript.php" /></noscript>';
//include load section file to load section
require_once("loadsection.php");
?>