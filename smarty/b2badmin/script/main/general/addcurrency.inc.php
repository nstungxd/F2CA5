<?php  
/**
 * Add/Update File For Country
 * @Created Date :3rd-july-08.
 * @package		addcountry.inc.php
 * @Section		general
 * @author		Pradip Kumar Dash
*/

if(!isset($currencyObj)) {
    include_once(SITE_CLASS_APPLICATION."class.Currency.php");
    $currencyObj =	new Currency();
}
$gdbobj->getRequestVars();

$view  = GetVar("view");
$iCurrencyID = GetVar("iCurrencyID");
$actionfile  = GetVar("file");
$arr = Array();

if(count($_POST) > 0) {
	 $arr[0] = $_POST;
} else {
	 if($view == 'edit') {
		  $arr = $currencyObj->select($iCurrencyID);
		  //prints($arr);exit;
	 } else {
		  $view = "add";
	 }
}
$arr[0]['eStatus'] = (isset($arr[0]['eStatus']))? $arr[0]['eStatus'] : '';
$arr[0]['vCode'] = (isset($arr[0]['vCode']))? $arr[0]['vCode'] : '';

/* Array For Creating Country Combo */
/*$couCombArr = array(
			"ID"				=>	"vCurrencyCountry",
			"Name" 				=>	"Data[vCurrencyCountry]",
			"Type"				=>	"Query",
			"tableName" 		=>	"".PRJ_DB_PREFIX."_country_master",
			"fieldId" 			=>	"iCountryId",
			"fieldName"			=>	"vCountry",
			"extVal"			=>	'',
			"selectedVal" 		=>	$arr[0]['iCountryID'],
			"width"  			=>	'216px',
			"height"  			=>	'',
			"onchange" 			=>	'',
			"selectText" 		=>	"---Select Country---",
			"where" 			=>	" eStatus = 'Active'",
			"multiple_select" 	=>	"",
			"orderby" 			=>	'vCountry',
			"validationmsg"		=>	'Select country.',
			"extra"				=>	"tabIndex='1'"
			);
*/
/* end here */

?>
<form name="frmadd" id="frmadd" action="index.php?file=<?php  echo  $actionfile?>&view=action" method="post" enctype="multipart/form-data">
<?php  echo $generalobj->PrintElement("view","view",$view,"Hidden");?>
<?php  echo $generalobj->PrintElement("iCurrencyID","iCurrencyID",$iCurrencyID,"Hidden");?>
<?php  echo $generalobj->PrintElement("firstStatus","firstStatus",$arr[0]['eStatus'],"hidden");?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td width="100%" valign="top"><span class="reqmsg" style="float:right;"><?php  if(isset($arr[0]['var_msg'])){ if($arr[0]['var_msg'] != '') { echo "Country is already exists"; } } ?></span>
		<table width="100%" border="0" class="table-border" cellspacing="0" cellpadding="0">
		<tr>
			<td class="heading">Currency Information</td>
		</tr>
		<tr>
			<td valign="top" colspan="2">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="50%" height="22" align="right" class="td-bg"><font class="reqmsg">*</font>&nbsp;Currency code</td>
					<td width="50%" class="white-bg"><?php  echo $generalobj->PrintElement("Data[vCode]","vCode",$arr[0]['vCode'],"Text","Enter Currency Code"," class='input1 required' onkeypress='return chkStateCode(event);' style='width:210px;' tabIndex='2' Maxlength='10'","Enter Currency Code");?></td>
				</tr>
				<tr>
					<td height="22" align="right" class="td-bg">Status</td>
					<td class="white-bg" colspan="3"><?php  echo  $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_country_master","eStatus","Data[eStatus]","eStatus","","".$arr[0]['eStatus']."","tabIndex='3'")?></td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td valign="top">&nbsp;</td>
</tr>
<tr>
	<td valign="top" align="center" colspan="2">
		<input type="image" style="cursor:pointer"  alt="Save" title="Save" id="btnSave" name="btnSave" src="<?php  echo  ADMIN_IMAGES?>btn-save.gif" tabIndex="4">
		<input type="image" alt="Reset" title="Reset" style="cursor:pointer" src="<?php  echo  ADMIN_IMAGES?>btn-reset.gif" onclick="reset();return false;" tabIndex="5">
		<img style="cursor:pointer" alt="Cancel" title="Cancel" src="<?php  echo  ADMIN_IMAGES?>btn-cancle.gif" onclick="return RedirectURL('index.php?file=<?php  echo  $actionfile?>&view=index&AX=Yes');" tabIndex="6" onblur="$('#vCountry').focus();">
	</td>
</tr>
</table>
</form>

<script type="text/javascript" src="<?php  echo  S_JQUERY?>jquery.validate.js"></script>
<script type="text/javascript">
$('#frmadd').validate( {
         rules: {
          "Data[vCode]": {
               remote: {
                    url:ADMIN_URL+"index.php?file=aj-chkdupdata",
                    type:"get",
                    data: {
                         val:function() {
               return $("#iCurrencyID").val();
               },
               id:function() {
               return "iCurrencyID";
               },
               field:function() {
               return "vCode";
               },
               table:function() {
               return "<?php  echo  PRJ_DB_PREFIX?>_currency_master";
               }
          }
     }
}
},
     messages: {
          "Data[vCode]": {
               required: 'Enter Country Name',
					remote: jQuery.validator.format("This currency already exists.")
          }
     }
});

/*$('vCountry').focus();
new Validator({
        formId: 'frmadd',
		btnId:'btnSave',
        isRequired: ['vCountry','vCountryCode'],
		isDuplicate:['vCountry','vCountry','<?php  echo  PRJ_DB_PREFIX?>_country_master','iCountryId']
	});
*/
</script>