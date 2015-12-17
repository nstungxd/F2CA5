<?php
include(S_SECTIONS."/member/memberaccess.php");

$table = GetVar('table');
$iId = GetVar('iId');
$id = GetVar('id');
$fields = GetVar('fields');
$jtbl = GetVar('jtbl');
$where = GetVar('where');
$js = trim($_GET['js']);

if($fields == 'all') {
	$fields = '*';
}

if($table != '') {
	if($iId != '' && $id != '') {
		$sql = "select $fields from $table $jtbl where $iId=$id ";
	} else if($where != '') {
		$sql = "select $fields from $table $jtbl where $where ";
	}
	//echo $sql;exit;
	if($sql != '') {
		$dtls = $dbobj->MySqlSelect($sql);
	}
}

//if(is_array($dtls) && count($dtls) > 0) {
//	for($ln=0;$ln<count($dtls);$ln++) {
		if(is_array($dtls[0])) {
//			foreach($dtls[0] as $ky => $vl) {
	if(trim($js) == 'setusr')
	{
?>
			<script type="text/javascript">
				$('#vAddressLine1').val('<?php echo $dtls[0]['vAddressLine1']?>');
				$('#vAddressLine2').val('<?php echo $dtls[0]['vAddressLine2']?>');
				$('#vAddressLine3').val('<?php echo $dtls[0]['vAddressLine3']?>');
				$('#vCity').val('<?php echo $dtls[0]['vCity']?>');
				$('#vZipCode').val('<?php echo $dtls[0]['vZipcode']?>');

				$("#vCountry option[value='<?php echo $dtls[0]['vCountry']?>']").attr("selected","selected");
				getRelativeCombo($('#vCountry').val(),"<?php echo $dtls[0]['vCountry']?>",'vState','---Select State---',stateArr);
				$("#vState option[value='<?php echo $dtls[0]['vState']?>']").attr("selected","selected");
			</script>
<?php  
	}
//			}
		}
//	}
//}

/*$msg = $smarty->get_template_vars('LBL_NO_REC_AVAILABLE');
// prints($dtls); exit;

if(is_array($dtls) && count($dtls) > 0) {
	for($ln=0;$ln<count($dtls);$ln++) {
		if(is_array($dtls[$ln])) {
			foreach($dtls[$ln] as $ky => $vl) {
				$content .= "<".htmlspecialchars($ky).">".htmlspecialchars($vl)."</".htmlspecialchars($ky).">";
			}
		}
	}
} else {
	$content .= '<msg>'.$msg.'</msg>';
}
// print_r($content); exit;
include_once(SITE_CLASS_GEN."class.xmlparser.php");
$parseObj = new xmlparser('UTF-8');
$xmlcontent ='<?xml version="2.0" encoding="UTF-8"?><list>';
$xmlcontent .= $content;
$xmlcontent .= '</list>';
$arr_xml = $parseObj->xml2php($xmlcontent);
$xml = $parseObj->php2xml($arr_xml);
$parseObj->output_xml($xml);
ob_clean();
ob_flush();
 */
exit;
?>