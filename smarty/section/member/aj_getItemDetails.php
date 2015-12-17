<?php
include(S_SECTIONS."/member/memberaccess.php");

$table = GetVar('table');
$iId = GetVar('iId');
$id = GetVar('id');
$cnt = GetVar('cnt');
$fields = GetVar('fields');
$jtbl = GetVar('jtbl');
$where = GetVar('where');

if($fields == 'all') {
	$fields = '*';
}

if($table != '') {
	if($iId != '' && $id != '') {
		$sql = "select $fields from $table $jtbl where $iId=$id ";
	} else if($where != '') {
		$sql = "select $fields from $table $jtbl where $where ";
	}
	// echo $sql;exit;
	if($sql != '') {
		$dtls = $dbobj->MySqlSelect($sql);
	}
}

//if(is_array($dtls) && count($dtls) > 0) {
//	for($ln=0;$ln<count($dtls);$ln++) {
		if(is_array($dtls[0])) {
//			foreach($dtls[0] as $ky => $vl) {
?>
			<script type="text/javascript">
                    var cnt = '<?php echo $cnt?>';
				$('#eInvoiceType'+cnt+'').val('<?php echo $dtls[0]['eOrderType']?>');
				$('#tDescription'+cnt+'').val('<?php echo $dtls[0]['tDescription']?>');
				$('#vUnitOfMeasure'+cnt+'').val('<?php echo $dtls[0]['vUnitOfMeasure']?>');
				$('#iQuantity'+cnt+'').val('<?php echo $dtls[0]['iQuantity']?>');
				$('#fPrice'+cnt+'').val('<?php echo $dtls[0]['fPrice']?>');
				$('#fAmount'+cnt+'').val('<?php echo $dtls[0]['fAmount']?>');
				$('#fVAT'+cnt+'').val('<?php echo $dtls[0]['fVAT']?>');
				$('#fOtherTax1'+cnt+'').val('<?php echo $dtls[0]['fOtherTax1']?>');
				$('#fLineTotal'+cnt+'').val('<?php echo $dtls[0]['fLineTotal']?>');
				//$('#save').attr('checked', true);

                    //$("div:addNew").("input:fVAT").val('<?php  //=$dtls[0]['fVAT']?>');
                    
			</script>
<?php  
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