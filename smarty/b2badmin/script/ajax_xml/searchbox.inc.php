<?php  

include(SITE_CLASS_GEN."class.xmlparser.php");
$parseObj=new xmlparser;

$field  = GetVar('field');
$table = GetVar('table');

$enumvalue = array();

$enumvalue = $gdbobj->mysqlEnumValues($table,$field);

$cnt=0;
$xmlcontent ='<?xml version="1.0"?><list>';
for($i=0; $i<count($enumvalue);$i++)
{
	//if($enumvalue[$i] != 'isDelete'){
		$xmlcontent .='<enumval>'.$enumvalue[$i].'</enumval>';
		$cnt++;
//}
	
}
$xmlcontent .='<total>'.$cnt.'</total>';
$xmlcontent.='</list>';
$parseObj->output_xml($xmlcontent);
exit;
?>