<?php  
/**
 * This file is useful to get Type of Menu Category
 *
 * @package		menucattype.inc.php
 * @section		script/ajax_xml
 * @author		Jack Scott
 */

include_once(SITE_CLASS_GEN."class.xmlparser.php");
$parseObj=new xmlparser;
$val =	GetVar('val');
$field = GetVar('field');
$table = GetVar('table');
 
//$id 	=	GetVar('id');
$mode = GetVar('mode');

//for detault category header.
if($val == 0)
{
		$where = " iParentId = '".$val."'  and eStatus = 'Active'";
	  $dispcount = $generalobj->GenerateDispOrder($table,$where,$mode);
	//echo $dispcount;exit;
}
else
{	
  if($table=''.PRJ_DB_PREFIX.'_clip_art_image')
  {
    	$where = " iClCategoryId = '".$val."'  and eStatus = 'Active'";
  }else
		$where = " iParentId = '".$val."'  and eStatus = 'Active'";
		
		$dispcount = $generalobj->GenerateDispOrder($table,$where,$mode);
		
}

//echo $dispcount;exit;
	$xmlcontent ='<?xml version="1.0" encoding="iso-8859-1"?><list>';
	$xmlcontent .='<val>'.$val.'</val>';
	$xmlcontent .='<cnt>'.$dispcount.'</cnt>';
	$xmlcontent.='</list>';
$parseObj->output_xml($xmlcontent);
?>