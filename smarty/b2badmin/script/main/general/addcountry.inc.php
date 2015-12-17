<?php
/**
 * Add/Update File For Country
 * @Created Date :3rd-july-08.
 * @package		addcountry.inc.php
 * @Section		general
 * @author		Pradip Kumar Dash
*/

if(!isset($countryObj)) {
    include_once(SITE_CLASS_APPLICATION."class.Country.php");
    $countryObj =	new Country();
}
$gdbobj->getRequestVars();

$view  = GetVar("view");
$iCountryId = GetVar("iCountryId");
$actionfile  = GetVar("file");

if(count($_POST) > 0) {
   $arr = Array();
   $arr[0] = $_POST;
} else {
  	if($view == 'edit') {
   	$arr = $countryObj->getCountryDetail("*","AND iCountryId = '$iCountryId'");
      //prints($arr);exit;
  	} else {
  		$view = "add";
  	}
}

/* Array For Creating Country Combo */
$currencyCombArr = array(
			"ID"					=>	"iCurrencyID",
			"Name" 				=>	"Data[iCurrencyID]",
			"Type"				=>	"Query",
			"tableName" 		=>	"".PRJ_DB_PREFIX."_currency_master",
			"fieldId" 			=>	"iCurrencyID",
			"fieldName"			=>	"vCode",
			"extVal"				=>	'',
			"selectedVal" 		=>	(isset($arr[0]['iCurrencyID']))? $arr[0]['iCurrencyID'] : '',
			"width"  			=>	'216px',
			"height"  			=>	'',
			"onchange" 			=>	'',
			"selectText" 		=>	"---Select Currency---",
			"where" 				=>	" eStatus = 'Active'",
			"multiple_select" =>	"",
			"orderby" 			=>	'vCode',
			"validationmsg"	=>	'Select Currency.',
			"class"				=> 'required',
			"extra"				=>	"tabIndex='4'"
			);
/* end here */


?>
<form name="frmadd" id="frmadd" action="index.php?file=<?php  echo  $actionfile?>&view=action" method="post" enctype="multipart/form-data">
<?php  echo $generalobj->PrintElement("view","view",$view,"Hidden");?>
<?php  echo $generalobj->PrintElement("iCountryId","iCountryId",$iCountryId,"Hidden");?>
<?php  echo $generalobj->PrintElement("firstStatus","firstStatus",(isset($arr[0]['eStatus']))? $arr[0]['eStatus'] : '',"hidden");?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td width="100%" valign="top"><span class="reqmsg" style="float:right;"><?php  if(isset($arr[0]['var_msg'])){ if($arr[0]['var_msg'] != '') { echo "Country is already exists"; } } ?></span>
		<table width="100%" border="0" class="table-border" cellspacing="0" cellpadding="0">
		<tr>
			<td class="heading">Country Information</td>
		</tr>
		<tr>
			<td valign="top" colspan="2">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="50%" height="22" align="right" class="td-bg"><font class="reqmsg">*</font>&nbsp;Country</td>
					<td width="50%" class="white-bg">
						<?php  // echo $generalobj->PrintElement("Data[vCountry]","vCountry",$arr[0]['vCountry'],"Text","Enter country"," style=width:220px tabIndex=1");?>
						<input type="text" name="Data[vCountry]" id="vCountry" class="input1 required" value="<?php echo (isset($arr[0]['vCountry']))? $arr[0]['vCountry'] : ''; ?>" tabIndex="1" />
					</td>
				</tr>
				<tr>
					<td  align="right" class="td-bg"><font class="reqmsg">*</font>&nbsp;Country code</td>
					<td class="white-bg"><?php  echo $generalobj->PrintElement("Data[vCountryCode]","vCountryCode",(isset($arr[0]['vCountryCode']))? $arr[0]['vCountryCode'] : '',"Text","Enter Country Code"," class='input1 required' onkeypress='return chkStateCode(event);'style=width:210px tabIndex=2 Maxlength=2;","Enter Country Code");?></td>
				</tr>
				<tr>
					<td  align="right" class="td-bg"><font class="reqmsg">*</font>&nbsp;Country ISD code</td>
					<td class="white-bg"><?php  echo $generalobj->PrintElement("Data[iCountryISD]","iCountryISD",(isset($arr[0]['iCountryISD']))? $arr[0]['iCountryISD'] : '',"Text","Enter Country ISD Code"," class='input1 required digits' style=width:210px tabIndex=3 Maxlength=3;","Enter Country ISD Code");?></td>
				</tr>
				<tr>
					<td  align="right" class="td-bg"><font class="reqmsg">*</font>&nbsp;Default Currency</td>
					<td class="white-bg">
					 <?php  //echo $generalobj->PrintElement("Data[vCurrency]","vCurrency",$arr[0]['vCurrency'],"Text","Enter Country Currency"," class='input1 required' style=width:210px tabIndex=4 Maxlength=50;","Enter Country Currency");?>
					 <?php  echo $gdbobj->DynamicDropDown($currencyCombArr);?>
					</td>
				</tr>
				<tr>
					<td  align="right" class="td-bg"><font class="reqmsg">*</font>&nbsp;Vat</td>
					<td class="white-bg">
					 <input type="text" name="Data[fVat]" id="fVat" value="<?php echo (isset($arr[0]['fVat']))? $arr[0]['fVat'] : ''; ?>" class="" title="Enter Vat" />
					</td>
				</tr>
				<tr>
					<td align="right" class="td-bg"><font class="reqmsg">*</font>&nbsp;Other Tax</td>
					<td class="white-bg">
					 <input type="text" name="Data[fOtherTax]" id="fOtherTax" value="<?php echo (isset($arr[0]['fOtherTax']))? $arr[0]['fOtherTax'] : ''; ?>" class="" title="Enter Other Tax" />
					</td>
				</tr>
				<tr>
					<td align="right" class="td-bg"><font class="reqmsg">*</font>&nbsp;With Holding Tax</td>
					<td class="white-bg">
					 <input type="text" name="Data[fwhTax]" id="fwhTax" value="<?php echo (isset($arr[0]['fwhTax']))? $arr[0]['fwhTax'] : ''; ?>" class="" title="Enter With Holding Tax" />
					</td>
				</tr>
				<tr>
					<td height="22" align="right" class="td-bg">Status</td>
					<td class="white-bg" colspan="3"><?php  echo  $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_country_master","eStatus","Data[eStatus]","eStatus","","".(isset($arr[0]['eStatus']))? $arr[0]['eStatus'] : ''."","tabIndex=3")?></td>
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
          "Data[vCountry]": {
               remote: {
                    url:ADMIN_URL+"index.php?file=aj-chkdupdata",
                    type:"get",
                    data: {
                         val:function() {
               return $("#iCountryId").val();
               },
               id:function() {
               return "iCountryId";
               },
               field:function() {
               return "vCountry";
               },
               table:function() {
               return "<?php  echo  PRJ_DB_PREFIX?>_country_master";
               }
          }
     }
}
},
     messages: {
          "Data[vCountry]": {
               required: 'Enter Country Name',
					remote: jQuery.validator.format("This country is already taken, please select a different country.")
          },
			 "Data[iCountryISD]": {
               digits: 'Only Numeric Values Allowed'
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