<?php
include(S_SECTIONS."/member/memberaccess.php");

$table = PostVar('table');
$id = PostVar('id');
$fields = PostVar('fields');
//$where = GetVar('where');

if($fields == 'all') {
	$fields = '*';
}
if($table != '') {
	if($id != '') {
		$sql = "select $fields from $table  where iOrganizationID = '$id' ";
	}
	//echo $sql;exit;
   if($sql != '') {
		$dtls = $dbobj->MySqlSelect($sql);
	}
}
// prints($dtls);exit;
//echo $dtls[0]['vPhone'];exit;
$Phone=array ();
if(strpos($dtls[0]['vPhone'],'-') !== false) {
	$Phone = @explode('-',$dtls[0]['vPhone']);
} else {
	$Phone[0] = '';
	$Phone[1] = $dtls[0]['vPhone'];
}

if(!isset($cntstObj)) {
   include_once(SITE_CLASS_GEN."class.countrystate.php");
   $cntstObj =	new CountryState();
}

// $state =	$cntstObj->getgeneralArr(PRJ_DB_PREFIX."_state_master"," AND eStatus='Active'","vStateCode","vState","vCountryCode","vStateCode,vState,vCountryCode");
// $stateArr = $state[0];

//prints($Phone);exit;
//if(is_array($dtls) && count($dtls) > 0) {
//	for($ln=0;$ln<count($dtls);$ln++) {
ob_clean();
if(is_array($dtls[0]) && count($dtls[0])>0) {
?>
<script type="text/javascript">
	// var stateArr = new Array(<?php echo $stateArr; ?>);
</script>
<script type="text/javascript">
	$('#vAddressLine1').val('<?php echo $dtls[0]['vAddressLine1']?>');
	$('#vAddressLine2').val('<?php echo $dtls[0]['vAddressLine2']?>');
	$('#vAddressLine3').val('<?php echo $dtls[0]['vAddressLine3']?>');
	$('#vCity').val('<?php echo $dtls[0]['vCity']?>');
	//$('#vState').val('<?php echo $dtls[0]['vState']?>');
	//$('#vCountry').val('<?php echo $dtls[0]['vCountry']?>');
	$('#vZipCode').val('<?php echo $dtls[0]['vZipcode']?>');
	$('#vPhone').val('<?php echo $Phone[1]?>');
	$('#vPhoneCode').val('<?php echo $Phone[0]?>');
	$("#vCountry option[value='<?php echo $dtls[0]['vCountry']?>']").attr("selected","selected");
	getRelativeCombo($('#vCountry').val(),"<?php echo $dtls[0]['vState']?>",'vState','---Select State---',stateArr);
	setTimeout(function(){ $("#vState option[value='<?php echo $dtls[0]['vState']?>']").attr("selected","selected"); }, 300);
	// $('#vAddressLine3').val('asdasd');
</script>
<?php
}
echo ' ';
ob_flush();
flush();
exit;
?>