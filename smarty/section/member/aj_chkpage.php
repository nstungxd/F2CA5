<?php  
/*//member include class
require_once(SITE_CLASS_APPLICATION."class.member.php");
//initialize object of member
$memobj = new Member();

//xml parser class
include_once(SITE_CLASS_GEN."class.xmlparser.php");
*/

$prc = $_POST['prc'];
// echo $prc; exit;
if(trim($prc) != "")
{
	if($prc != $_COOKIE['bt_prc'])
	{
		echo "stop";
		exit;
	}
}
// echo $prc . "-" . $_COOKIE['bt_prc'];
echo "proceed";
exit;

/*//intialize object of xml parser
$parseObj = new xmlparser('UTF-8');
$xmlcontent = '<?xml version="2.0" encoding="UTF-8"?><list>';*/
/*$xmlcontent = '<?xml version="1.0" encoding="iso-8859-1"?><list>'; */
/*$xmlcontent .= '<msg>'.$msg.'</msg>';
$xmlcontent .= '</list>';

$arr_xml = $parseObj->xml2php($xmlcontent);
$xml = $parseObj->php2xml($arr_xml);
$parseObj->output_xml($xml);
*/
exit;
?>