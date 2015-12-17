<?php
if(!isset($bankObj)) {
   include_once(SITE_CLASS_APPLICATION."class.BankMaster.php");
   $bankObj = new BankMaster();
}

if(!isset($countryObj)) {
    include_once(SITE_CLASS_APPLICATION."class.Country.php");
    $countryObj =	new Country();
}
if(!isset($stateObj)) {
    include_once(SITE_CLASS_APPLICATION."class.State.php");
    $stateObj =	new State();
}
if(!isset($cntstObj)) {
    include_once(SITE_CLASS_GEN."class.countrystate.php");
    $cntstObj =	new CountryState();
}

$gdbobj->getRequestVars();

$view  = GetVar("view");
$iBankId = GetVar("iBankId");
$actionfile  = GetVar("file");
$arr = Array();
$arr[0]['var_msg'] = (isset($arr[0]['var_msg']))? $arr[0]['var_msg'] : '';

if(count($_POST) > 0) {
   $arr[0] = $_POST;
} else {
   if($view == 'edit') {
      $arr = $bankObj->select($iBankId);
      // prints($arr);exit;
      $vPhone = explode("-",$arr[0]['vPhone']);
      $vPhone1 = $vPhone[0];
      $vPhone2 = (isset($vPhone[1]))? $vPhone[1] : '';
   } else {
      $view = "add";
   }
}

//Get State Array
$state =	$cntstObj->getgeneralArr(PRJ_DB_PREFIX."_state_master"," AND eStatus='Active'","vStateCode","vState","vCountryCode","vStateCode,vState,vCountryCode");
$stateArr	=	$state[0];
$db_country = $countryObj->getCountryDetail("iCountryId,vCountry,vCountryCode","AND eStatus = 'Active'");
//prints($db_country);exit;
$db_state = $stateObj->getStateDetail("iStateId, vStateCode, vState","AND eStatus = 'Active'","vState");
//prints($db_state);exit;
$currency = $generalobj->getCurrency();
?>
<script language="JavaScript1.2" >
   stateArr = new Array(<?php echo $stateArr; ?>);
</script>
<form name="frmadd" id="frmadd" action="index.php?file=<?php echo $actionfile; ?>&view=action" method="post" enctype="multipart/form-data">
<?php  echo $generalobj->PrintElement("view","view",$view,"Hidden");?>
<?php  echo $generalobj->PrintElement("iBankId","iBankId",$iBankId,"Hidden");?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td width="100%" valign="top"><span class="reqmsg" style="float:right;"><?php  if(isset($arr[0]['var_msg'])){ if($arr[0]['var_msg'] != '') { echo "Country is already exists"; } } ?></span>
		<table width="100%" border="0" class="table-border" cellspacing="0" cellpadding="0">
		<tr>
			<td class="heading">Bank Information</td>
		</tr>
		<tr>
			<td valign="top" colspan="2">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="25%" height="22" align="right" class="td-bg"><font class="reqmsg">*</font>&nbsp;Bank Name</td>
					<td width="25%" class="white-bg">
                  <input type="text" id="vBankName" name="Data[vBankName]" value="<?php echo (isset($arr[0]['vBankName']))? $arr[0]['vBankName'] : ''; ?>" class="required" title="Enter Bank Name" onkeypress='return chkValidChar(event);' />
               </td>
               <td width="25%" height="22" align="right" class="td-bg"><font class="reqmsg">*</font>&nbsp;Email</td>
					<td width="25%" class="white-bg">
                  <input type="text" id="vEmail" name="Data[vEmail]" value="<?php echo (isset($arr[0]['vEmail']))? $arr[0]['vEmail'] : ''; ?>" class="required email" title="Enter Valid Email" />
               </td>
				</tr>
            <tr>
               <td width="25%" height="22" align="right" class="td-bg"><font class="reqmsg">*</font>&nbsp;Swift Code</td>
					<td width="25%" class="white-bg">
                  <input type="text" id="vSwiftCode" name="Data[vSwiftCode]" value="<?php echo (isset($arr[0]['vSwiftCode']))? $arr[0]['vSwiftCode'] : ''; ?>" class="required" title="Enter Swift Code" />
               </td>
               <td width="25%" height="22" align="right" class="td-bg"><font class="reqmsg">*</font>&nbsp;Scheme Number</td>
					<td width="25%" class="white-bg">
                  <input type="text" id="iScheme" name="Data[iScheme]" value="<?php echo (isset($arr[0]['iScheme']))? $arr[0]['iScheme'] : ''; ?>" class="required decimals" title="Enter Proper Scheme Number" onkeypress='return chkDigit(event);' />
               </td>
            </tr>
            <tr>
               <td width="25%" height="22" align="right" class="td-bg"><font class="reqmsg">*</font>&nbsp;Routing Code 1</td>
					<td width="25%" class="white-bg">
                  <input type="text" id="vRoutingCode1" name="Data[vRoutingCode1]" value="<?php echo (isset($arr[0]['vRoutingCode1']))? $arr[0]['vRoutingCode1'] : ''; ?>" class="required" title="Enter Routing Code 1" />
               </td>
               <td width="25%" height="22" align="right" class="td-bg">&nbsp;Routing Code 2</td>
					<td width="25%" class="white-bg">
                  <input type="text" id="vRoutingCode2" name="Data[vRoutingCode2]" value="<?php echo (isset($arr[0]['vRoutingCode2']))? $arr[0]['vRoutingCode2'] : ''; ?>" class="" title="Enter Routing Code 2" />
               </td>
				</tr>
            <tr>
               <td width="25%" height="22" align="right" class="td-bg">&nbsp;Routing Code 3</td>
					<td width="25%" class="white-bg">
                  <input type="text" id="vRoutingCode3" name="Data[vRoutingCode3]" value="<?php echo (isset($arr[0]['vRoutingCode3']))? $arr[0]['vRoutingCode3'] : ''; ?>" class="" title="Enter Routing Code 3" />
               </td>
               <td width="25%" height="22" align="right" class="td-bg"><font class="reqmsg">*</font>&nbsp;IBAN</td>
					<td width="25%" class="white-bg">
						<input type="text" id="vIBAN" name="Data[vIBAN]" value="<?php echo (isset($arr[0]['vIBAN']))? $arr[0]['vIBAN'] : ''; ?>" class="required" title="Enter IBAN" />
					</td>
				</tr>
            <tr>
					<td width="25%" height="22" align="right" class="td-bg"><font class="reqmsg">*</font>&nbsp;Settlement 1</td>
					<td width="25%" class="white-bg">
                  <input type="text" id="vSettlement1" name="Data[vSettlement1]" value="<?php echo (isset($arr[0]['vSettlement1']))? $arr[0]['vSettlement1'] : ''; ?>" class="required" title="Enter Settlement 1" />
               </td>
               <td width="25%" height="22" align="right" class="td-bg">&nbsp;Settlement 2</td>
					<td width="25%" class="white-bg">
                  <input type="text" id="vSettlement2" name="Data[vSettlement2]" value="<?php echo (isset($arr[0]['vSettlement2']))? $arr[0]['vSettlement2'] : ''; ?>" class="" title="Enter Settlement 2" />
               </td>
				</tr>
            <tr>
					<td width="25%" height="22" align="right" class="td-bg"><font class="reqmsg">*</font>&nbsp;Fee 1</td>
					<td width="25%" class="white-bg">
                  <input type="text" id="vFee1" name="Data[vFee1]" value="<?php echo (isset($arr[0]['vFee1']))? $arr[0]['vFee1'] : ''; ?>" class="required decimals" title="Enter Fee 1" />
               </td>
               <td width="25%" height="22" align="right" class="td-bg">&nbsp;Fee 2</td>
					<td width="25%" class="white-bg">
                  <input type="text" id="vFee2" name="Data[vFee2]" value="<?php echo (isset($arr[0]['vFee2']))? $arr[0]['vFee2'] : ''; ?>" class="decimals" title="Enter Fee 2"  />
               </td>
				</tr>
            <tr>
               <td align="right" class="td-bg">Currency 2</td>
               <td class="white-bg">
                  <select name="Data[vCurrency2]" id="vCurrency2" class="" title="Select Currenct 2">
                  <option value="">Select Currency</option>
                  <?php if(is_array($currency) && count($currency)>0) {
                     for($l=0; $l<count($currency); $l++) {
                  ?>
                     <option value="<?php echo $currency[$l]['vCode']; ?>" <?php if(isset($arr[0]['vCurrency2']) && $arr[0]['vCurrency2']==$currency[$l]['vCode']) { ?>selected="selected"<?php } ?> ><?php echo $currency[$l]['vCode']; ?></option>
                  <?php } } ?>
                  </select>
			      </td>
               <td align="right" class="td-bg"><font class="reqmsg">*</font>Currency 1</td>
               <td class="white-bg">
                  <select name="Data[vCurrency1]" id="vCurrency1" class="required" title="Select Currenct 1">
                  <option value="">Select Currency</option>
                  <?php if(is_array($currency) && count($currency)>0) {
                     for($l=0; $l<count($currency); $l++) {
                  ?>
                     <option value="<?php echo $currency[$l]['vCode']; ?>" <?php if(isset($arr[0]['vCurrency1']) && $arr[0]['vCurrency1']==$currency[$l]['vCode']) { ?>selected="selected"<?php } ?> ><?php echo $currency[$l]['vCode']; ?></option>
                  <?php } } ?>
                  </select>
			      </td>
				</tr>
            <tr>
               <td height="22" align="right" class="td-bg">Status</td>
					<td class="white-bg" colspan="3"><?php echo $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_bank_master","eStatus","Data[eStatus]","eStatus","",(isset($arr[0]['vBankName']))? $arr[0]['eStatus'] : '',"")?></td>
               <td height="22" align="right" class="td-bg">&nbsp;</td>
					<td class="white-bg" colspan="3">&nbsp;</td>
            </tr>
            <tr><td colspan="4">&nbsp;</td></tr>
            <tr>
      			<td class="heading" colspan="4">Contact Information</td>
      		</tr>
            <tr>
               <td width="25%" height="22" align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;Country</td>
               <td width="25%" class="white-bg" valign="top">
                  <select name ="Data[vCountry]" id="vCountry" class="required" title="Select Country" style="width:218px" tabindex="12" onchange="getRelativeCombo(this.value,'','vState','-- Select State --',stateArr);getISD(this.value);">
                     <option value=""> --- Select Country --- </option>
                     <?php $arr[0]['vCountry'] = (isset($arr[0]['vCountry']))? $arr[0]['vCountry'] : '';
                        for($i=0;$i<count($db_country);$i++) { ?>
                        <option value="<?php  echo  $db_country[$i]['vCountryCode'] ?>" <?php if($arr[0]['vCountry'] == $db_country[$i]['vCountryCode']){?> selected <?php  }?> ><?php  echo  $db_country[$i]['vCountry']?></option>
                     <?php } ?>
                  </select>
               </td>
               <td align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;State</td>
               <td width="25%" class="white-bg" valign="top">
                  <input type="hidden" name="selstate" id="selstate" value="<?php echo (isset($arr[0]['vState']))? $arr[0]['vState'] : ''; ?>" />
                  <select name ="Data[vState]" id="vState" style="width:218px" tabindex="13" class="required" title="Select State">
                     <option value="">Select State</option>
                     <!--<option value="<?php // echo $state[0]['vStateCode']?>" selected><?php // echo  $state[0]['vState']?></option>-->
                  </select>
               </td>
            </tr>
            <tr>
               <td width="25%" height="22" align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;City</td>
					<td width="25%" class="white-bg" valign="top">
                  <input type="text" name="Data[vCity]" id="vCity" class="required" title="Enter City" value="<?php echo (isset($arr[0]['vCity']))? $arr[0]['vCity'] : ''; ?>" />
               </td>
               <td width="25%" align="right" class="td-bg" valign="top">&nbsp;Phone</td>
               <td width="25%" class="white-bg" valign="top">
                  <input type="text" name="vPhone1" id="vPhone1" class="" value="<?php echo (isset($vPhone1))? $vPhone1 : ''; ?>" onblur="change()" onkeypress="return chkDigitMobcode(event);" style="width:30px;" maxlength="3" tabIndex="16" />
                  <input type="text" name="vPhone2" id="vPhone2" class="" value="<?php echo (isset($vPhone2))? $vPhone2 : ''; ?>" onblur="change()" onkeypress="return chkDigitMobcode(event);" style="width:173px;" maxlength="15" tabIndex="17" />
                  <div id="errmsg" style="color:red;"></div>
			      </td>
            </tr>
            <tr>
               <td align="right" class="td-bg"><font class="reqmsg">*</font>ZipCode</td>
               <td class="white-bg">
                  <input type="text" name="Data[vZipcode]" id="vZipcode" value="<?php echo (isset($arr[0]['vZipcode']))? $arr[0]['vZipcode'] : '';?>" style="width:210px;" class="required digits" maxlength="10" title="Enter ZipCode" />
			      </td>
               <td align="right" class="td-bg">&nbsp;</td>
               <td class="white-bg">&nbsp;</td>
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
		<img style="cursor:pointer"  alt="Save" title="Save" id="btnSave" name="btnSave" src="<?php echo ADMIN_IMAGES; ?>btn-save.gif" tabIndex="4" onclick="return frmsubmit();" />
		<input type="image" alt="Reset" title="Reset" style="cursor:pointer" src="<?php echo ADMIN_IMAGES; ?>btn-reset.gif" onclick="reset();return false;" tabIndex="5" />
		<img style="cursor:pointer" alt="Cancel" title="Cancel" src="<?php echo ADMIN_IMAGES; ?>btn-cancle.gif" onclick="return RedirectURL('index.php?file=<?php echo $actionfile?>&view=index&AX=Yes');" tabIndex="6" onblur="$('#vCountry').focus();" />
	</td>
</tr>
</table>
</form>

<script type="text/javascript" src="<?php echo S_JQUERY; ?>jquery.validate.js"></script>
<script type="text/javascript">
var LBL_EMAIL_TAKEN = "This email is already in use.";
var LBL_SURE_TO_PROCEED = "Do you still want to proceed?";
$('#frmadd').validate( {
   rules: {
      "Data[vBankName]": {
         remote: {
            url:ADMIN_URL+"index.php?file=aj-chkdupdata",
            type:"get",
            data: {
               val:function() {
                  return $("#iBankId").val();
               },
               id:function() {
                  return "iBankId";
               },
               field:function() {
                  return "vBankName";
               },
               table:function() {
                  return "<?php echo PRJ_DB_PREFIX; ?>_bank_master";
               }
            }
         }
      }/*,
      "Data[vEmail]": {
         remote: {
            url:ADMIN_URL+"index.php?file=aj-chkdupdata",
            type:"get",
            data: {
               val:function() {
                  return $("#iBankId").val();
               },
               id:function() {
                  return "iBankId";
               },
               field:function() {
                  return "vEmail";
               },
               table:function() {
                  return "<?php echo PRJ_DB_PREFIX; ?>_bank_master";
               }
            }
         }
      }*/
   },
   messages: {
      "Data[vBankName]": {
         required: 'Enter Bank Name',
			remote: jQuery.validator.format("This bank already exists.")
      },
      "Data[vEmail]": {
         required: 'Enter Bank Email',
			remote: jQuery.validator.format("This email is already in use.")
      }
   }
});

function frmsubmit() {
   var vldfrm = $('#frmadd').valid();
	if(!vldfrm) {
		return false;
	}
   var email = $('#vEmail').val();
	pars = "&id=iBankId"+"&iBankId="+$('#iBankId').val()+"&field=vEmail"+"&vEmail="+$('#vEmail').val()+"&table=<?php echo PRJ_DB_PREFIX; ?>_bank_master";
	$.post(ADMIN_URL+"index.php?file=aj-chkdupdata", pars, function(resp)
	{
		if(resp == 'dup') {
			var ans = confirm(LBL_EMAIL_TAKEN+LBL_SURE_TO_PROCEED);
			if(ans) {
				$('#dpr').val('dpl');
				// $('#emlval').val(email);
				// alert('yes');
				$('#frmadd')[0].submit();
			}
		}
		else if(resp != false)
		{
			$('#dpr').val('nod');
			// alert('ndp');
			$('#frmadd')[0].submit();
		}
	});
	return false;
   // $('#frmadd')[0].submit();
}

function resetform() {
   $('#frmadd')[0].reset();
   getRelativeCombo($('#vCountry').val(),'<?php echo isset($arr[0]['vState'])? $arr[0]['vState'] : ""; ?>','vState','-- Select State --',stateArr);
}

getRelativeCombo($('#vCountry').val(),'<?php  echo  isset($arr[0]['vState'])?$arr[0]['vState']:"";?>','vState','-- Select State --',stateArr);
function getISD(val) {
   var url = ADMIN_URL+"index.php?file=aj-countrycode",

   pars = '&val='+val;
   //alert(url+pars);
   //return false;
   $.ajax({ type:"GET", url:url, data:pars, success:function setarchmsg(code) {
         $('#vPhone1').val(code);
         // $('#vMobileCode').val(code);
      }
   });
   return false;
}

function change() {
   var val1 = $('#vPhone1').val();
   var val2 = $('#vPhone2').val();
   // var val3 = $('#vPhone3').val();

   if(val1.length == 0 || val2.length == 0) {
      $('#errmsg').attr('innerHTML','Enter Phone Number');
      return false;
   } else {
      $('#errmsg').attr('innerHTML','');
      return true;
   }
}
</script>