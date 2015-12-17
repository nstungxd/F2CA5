<?php  
/*
 * @File  getListing File
 * Description:
 	Ajax Listing File output xml listing
---------------------------------------------------------------------------------
*/
//include("../index.php");

include_once(SITE_CLASS_GEN."class.ajax.php");

$listObj = new AjaxListing();

$xmlcontent = $listObj->MakeXml();

include_once(SITE_CLASS_GEN."class.xmlparser.php");
$parseObj = new xmlparser();
$parseObj->output_xml($xmlcontent);
?>