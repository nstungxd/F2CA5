<?php  
include(SITE_CLASS_GEN."class.xmlparser.php");
$parseObj = new xmlparser();
$keyword = $_GET['keyword'];
if($_GET['alphasearch'])
$alphasearch = $_GET['alphasearch'];
$type = $_GET['eType'];
$id = $_GET['id'];
$typSearch =$_GET['typSearch'];

$ssql= '';
if($keyword!='')
{
	$ssql .= ' AND (concat(vFirstname," ",vLastname) like "%'.$keyword.'%" ) ';
	if($id != '')
	$ssql .= ' or iMemberId IN('.$id.')';
}else if($alphasearch != '')
{
	$ssql .= ' AND (concat(vFirstname," ",vFirstname) like "'.$alphasearch.'%" ) ';
	if($id != '')
	$ssql .= ' or iMemberId IN('.$id.')';
}
else if($id != '')
{
	$ssql .= ' and iMemberId IN('.$id.')';
}

if($type == 'Member'){
	echo $sql = "select iMemberId as id ,concat(vFirstname,' ',vLastname) as Name,vEmail from ".PRJ_DB_PREFIX."_member
			where 1 $ssql order by vFirstname";
}


$Contacts = $dbobj->MySQLselect($sql);

$xmlcontent ='<?xml version="2.0" encoding="iso-8859-1"?><list>';
for($k=0; $k<count($Contacts); $k++)
{
		$xmlcontent .='<id>'.$Contacts[$k]['id'].'</id>';
		$xmlcontent .='<name>'.str_replace("&","and",$Contacts[$k]['Name']).'</name>';
		$xmlcontent .='<email>'.str_replace("&","and",$Contacts[$k]['vEmail']).'</email>';
}
$xmlcontent.='<totrec>'.count($Contacts).'</totrec>';
$xmlcontent.='</list>';
$arr_xml = $parseObj->xml2php($xmlcontent);
$xml     = $parseObj->php2xml($arr_xml);
$parseObj->output_xml($xml);
?>
