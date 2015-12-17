<?php  
/**
 * Add/Update File For State
 * @package		addstate.inc.php
 * @Section		general
*/

if(!isset($stateObj)) {
    include_once(SITE_CLASS_APPLICATION."class.State.php");
    $stateObj =	new State();
}
$gdbobj->getRequestVars();

$view  = GetVar("view");
$iStateId = GetVar("iStateId");
$arr = Array();

if(count($_POST) > 0) {
          $arr[0] = $_POST;
} else {
     if($view == 'edit')
     {
          $arr = $stateObj->getStateDetail("*","AND iStateId = '$iStateId'");
          $selected = (isset($arr[0]['vCountryCode']))?$arr[0]['vCountryCode']:"";
          //$validation = "'iCountryId','vState','vStateCode'";
          $topheader = "Update State Information";
     }
     else
     {
          $view = "add";
          //$validation = "'iCountryId','vState','vStateCode'";
          $topheader = "Add State Information";
     }
}

$arr[0]['iCountryId'] = (isset($arr[0]['iCountryId']))? $arr[0]['iCountryId'] : '';
$arr[0]['iStateId'] = (isset($arr[0]['iStateId']))? $arr[0]['iStateId'] : '';
$arr[0]['eStatus'] = (isset($arr[0]['eStatus']))? $arr[0]['eStatus'] : '';
$arr[0]['vState'] = (isset($arr[0]['vState']))? $arr[0]['vState'] : '';
$arr[0]['vStateCode'] = (isset($arr[0]['vStateCode']))? $arr[0]['vStateCode'] : '';

/* Array For Creating Country Combo */
$couCombArr = array(
			"ID"				=>	"iCountryId",
			"Name" 				=>	"Data[iCountryId]",
			"Type"				=>	"Query",
			"tableName" 		=>	"".PRJ_DB_PREFIX."_country_master",
			"fieldId" 			=>	"iCountryId",
			"fieldName"			=>	"vCountry",
			"extVal"			=>	'',
			"selectedVal" 		=>	$arr[0]['iCountryId'],
			"width"  			=>	'216px',
			"height"  			=>	'',
			"onchange" 			=>	'',
			"selectText" 		=>	"---Select Country---",
			"where" 			=>	" eStatus = 'Active'",
			"multiple_select" 	=>	"",
			"orderby" 			=>	'vCountry',
			"validationmsg"		=>	'Select country.',
			"extra"				=>	"tabIndex=1"
			);
/* end here */	


?>
<script type="text/javascript" src="<?php  echo  S_JQUERY?>jquery.validate.js"></script>
<form name="frmadd" id="frmadd" action="index.php?file=ge-state&view=action" method="post" enctype="multipart/form-data">
<?php  echo $generalobj->PrintElement("view","view",$view,"Hidden");?>
<?php  echo $generalobj->PrintElement("iStateId","iStateId",$arr[0]['iStateId'],"Hidden");?>
<?php  echo $generalobj->PrintElement("firstStatus","firstStatus",$arr[0]['eStatus'],"hidden");?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td width="49%" valign="top"><span class="reqmsg" style="float:right;"><?php  if(isset($arr[0]['var_msg'])){ if($arr[0]['var_msg'] != '') { echo "State is already exists"; } } ?></span>
		<table width="100%" border="0" class="table-border" cellspacing="0" cellpadding="0">
		<tr>
			<td class="heading">State Information</td>
		</tr>
		<tr>
			<td valign="top">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="25%" height="22"  align="right" class="td-bg"><font class="reqmsg">*</font>&nbsp;Select Country</td>
					<td width="25%" class="white-bg" ><?php  echo $gdbobj->DynamicDropDown($couCombArr);?></td>
				</tr>
				<tr>	
					<td height="22" width="25%" align="right" class="td-bg"><font class="reqmsg">*</font>&nbsp;State</td>
					<td class="white-bg" width="25%"><?php  echo $generalobj->PrintElement("Data[vState]","vState",$arr[0]['vState'],"text","Enter state"," class='required' onkeypress='return chkValidChar(event);' style=width:210px tabIndex=2 Maxlength=20;","Enter state");?></td>
				</tr>
				<tr>
					<td width="25%"  align="right" class="td-bg"><font class="reqmsg">*</font>&nbsp;State Code</td>
					<td width="25%" class="white-bg"><?php  echo $generalobj->PrintElement("Data[vStateCode]","vStateCode",$arr[0]['vStateCode'],"Text","Enter state code"," class='required' onkeypress='return chkStateCode(event);'style=width:210px tabIndex=3 Maxlength=3;","Enter state code");?></td>
				</tr>
				<tr>	
					<td height="25" align="right" class="td-bg">Status</td>
					<td class="white-bg" ><?php  echo  $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_state_master","eStatus","Data[eStatus]","eStatus","","".$arr[0]['eStatus']."","tabIndex=4")?></td>
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
	<td valign="top" align="center">
		<input type="Image" alt="Save" title="Save" id="btnSave" name="btnSave" src="<?php  echo  ADMIN_IMAGES?>btn-save.gif" tabIndex="5">
		<input type="image" alt="Reset" title="Reset" style="cursor:pointer" src="<?php  echo  ADMIN_IMAGES?>btn-reset.gif" onclick="reset();return false;" tabIndex="6">
		<img style="cursor:pointer" alt="Cancel" tabIndex="7" title="Cancel" src="<?php  echo  ADMIN_IMAGES?>btn-cancle.gif" onclick="return RedirectURL('index.php?file=ge-state&view=index&AX=Yes');" onblur="$('#iCountryId').focus();">
	</td>
</tr>
</table>
</form>
<script type="text/javascript">
$('#frmadd').validate( {
     rules: {
          "Data[iCountryId]":{required: true},
          "Data[vState]": {
               remote: {
                    url:ADMIN_URL+"index.php?file=aj-chkdupdata",
                    type:"get",
                    data: {
                         val:function() {
               return $("#iStateId").val();
               },
               id:function() {
               return "iStateId";
               },
               field:function() {
               return "vState";
               },
               table:function() {
               return "<?php  echo  PRJ_DB_PREFIX?>_state_master";
               }
          }
     }
}
     },
     messages: {
          "Data[iCountryId]":{required: "Select country"},
          "Data[vState]": {
               required: 'Enter state name',
			remote: jQuery.validator.format("This state is already taken, please select a different state.")
               }
     }

});

/*$('iCountryId').focus();
new Validator({ 
        formId: 'frmadd', 
		btnId:'btnSave',
        isRequired: [<?php  echo  $validation?>],
		isMinlen:['vStateCode','2','State Code Should be minimum two characters'],
	isDuplicateMultiple:['vStateCode,iCountryId','vStateCode,iCountryId','<?php  echo  PRJ_DB_PREFIX?>_state_master','iStateId'] 
		//isDuplicate:['vStateCode','vStateCode','<?php  echo  PRJ_DB_PREFIX?>_state_master','iStateId']
	});
*/
</script>