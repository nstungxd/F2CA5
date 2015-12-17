<?php
if(!isset($bProductOrgObj)) {
   include_once(SITE_CLASS_APPLICATION.'productorganization/class.BProductOrganization.php');
   $bProductOrgObj = new BProductOrganization();
}
// $gdbobj->getRequestVars();
$view  = GetVar("view");
$iProductId = GetVar("iProductId");
$file  = GetVar("file");
$arr = Array();
if(count($_POST) > 0) {
   $arr[0] = $_POST;
} else {
   if($view == 'edit') {
      $arr = $bProductOrgObj->select($iProductId);
      //prints($arr); exit;
   } else {
      $view = "add";
   }
}

$bankcombary = Array(
      "ID"			      => "iBankId",
      "Name" 		      => "Data[iBankId]",
      "Type"			   => "Query",
      "tableName"       => "".PRJ_DB_PREFIX."_bank_master",
      "fieldId" 		   => "iBankId",
      "fieldName"		   => "vBankName",
      "extVal"		      => '',
      "selectedVal"     => (isset($arr[0]['iBankId']))? $arr[0]['iBankId'] : '',
      "width"  		   => '210px',
      "height"  		   => '',
      "onchange" 		   => '',
      "selectText" 		=> "--- Select Bank ---",
      "where" 		      => " eStatus = 'Active'",
      "multiple_select" => "",
      "orderby" 		   => 'vBankName',
      "validationmsg"	=> 'Select Bank',
      "class"		      => "required",
      "extra"		      => " title='Select Bank' "
   );
$bankcombo = $gdbobj->DynamicDropDown($bankcombary);
?>
<form name="frmadd" id="frmadd" action="index.php?file=<?php echo $file; ?>&view=action" method="post">
<?php  echo $generalobj->PrintElement("view","view",$view,"Hidden");?>
<?php  echo $generalobj->PrintElement("iProductId","iProductId",$iProductId,"Hidden");?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<?php /* if($view == 'edit') { ?>
<tr>
   <td>
        <?php  include_once("addsmtop.inc.php")?>
   </td>
</tr>
<?php } */ ?>
<tr>
   <td  valign="top"><span class="reqmsg" style="float:right;"><?php if(isset($arr[0]['var_msg'])){ if($arr[0]['var_msg'] != '') { echo $arr[0]['var_msg']; } } ?></span>
      <table width="100%" border="0" class="table-border" cellspacing="0" cellpadding="0">
         <tr>
            <td class="heading">Buyer Product Organization Information</td>
         </tr>
         <tr>
            <td valign="top">
               <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="22" class="td-bg" align="right" width="25%" valign="top"><font class="reqmsg">*</font>&nbsp;Product Name</td>
						  <td class="white-bg"  width="25%" valign="top">
                     <input type="text" name="Data[vProductName]" id="vProductName" class="required" value="<?php echo (isset($arr[0]['vProductName']))? $arr[0]['vProductName'] : ''; ?>" onkeypress='return chkValidChar(event);' style="width:210px;" title="Enter Product Name" />
                    </td>
                    <td height="22" width="25%" align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;Product Code</td>
            			<td class="white-bg" width="25%" valign="top">
                        <input type="text" name="Data[vProductCode]" id="vProductCode" class="required" value="<?php echo (isset($arr[0]['vProductCode']))? $arr[0]['vProductCode'] : ''; ?>" onkeypress='return chkValidChar(event);' style="width:210px;" title="Enter Product Code" />
            			</td>
                  </tr>
                  <tr>
            			<td height="22" width="25%" align="right" class="td-bg" valign="top">&nbsp;Description</td>
            			<td class="white-bg" width="25%">
                        <textarea name="Data[tDescription]" id="tDescription"><?php echo (isset($arr[0]['tDescription']))? $arr[0]['tDescription'] : ''; ?></textarea>
            			</td>
                     <td width="25%" height="22" align="right" class="td-bg" valign="top">&nbsp;Availability</td>
						   <td width="25%" class="white-bg" valign="top">&nbsp;
                        <?php if(!isset($arr[0]['eAvailability'])) { $arr[0]['eAvailability'] = ''; } ?>
                       <?php echo $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_bproduct_organization", "eAvailability","Data[eAvailability]", "eAvailability","", "".$arr[0]['eAvailability']."", ""); ?>
                     </td>
                  </tr>
                  <tr>
                     <td height="22" width="25%" align="right" class="td-bg" valign="top">Currency</td>
            			<td class="white-bg" width="25%">
                        <?php $currency = $generalobj->getCurrency(); ?>
                        <select name="Data[vCurrency]" id="vCurrency">
                        <?php
                           if(is_array($currency) && count($currency)>0) {
                              for($l=0;$l<count($currency);$l++) {
                                 if(trim($currency[$l]['vCode'])!='') {
                        ?>
                           <option value="<?php echo $currency[$l]['vCode']; ?>" <?php if(isset($arr[0]['vCurrency']) && $arr[0]['vCurrency']==$currency[$l]['vCode']) { ?>selected="selected"<?php } ?> ><?php echo $currency[$l]['vCode']; ?></option>
                        <?php } } } ?>
                        </select>
            			</td>
                     <td width="25%" height="22" align="right" class="td-bg" valign="top">&nbsp;Default Scheme Fee (%)</td>
						   <td width="25%" class="white-bg" valign="top">&nbsp;
                        <input type="text" id="fDefaultSchemeFeePc" name="Data[fDefaultSchemeFeePc]" value="<?php echo (isset($arr[0]['fDefaultSchemeFeePc']))? $arr[0]['fDefaultSchemeFeePc'] : ''; ?>" class="decimals" maxlength="5" max="100.00" title="Only positive numeric values (< 100) allowed" />
                     </td>
                  </tr>
                  <tr>
                     <td width="25%" height="22" align="right" class="td-bg" valign="top">&nbsp;Default Scheme Fee Flat</td>
						   <td width="25%" class="white-bg" valign="top">&nbsp;
                        <input type="text" id="fDefaultSchemeFeeFlat" name="Data[fDefaultSchemeFeeFlat]" value="<?php echo (isset($arr[0]['fDefaultSchemeFeeFlat']))? $arr[0]['fDefaultSchemeFeeFlat'] : ''; ?>" class="decimals" maxlength="10" title="Only positive numeric values allowed" />
                     </td>
                     <td width="25%" height="22" align="right" class="td-bg" valign="top">&nbsp;</td>
						   <td width="25%" class="white-bg" valign="top">&nbsp;</td>
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
   <td valign="top">
      <table width="100%" border="0" class="table-border" cellspacing="0" cellpadding="0">
         <tr>
            <td class="heading">Bank Information</td>
         </tr>
         <tr>
            <td valign="top">
               <table width="100%" border="0" cellspacing="0" cellpadding="2">
                  <tr>
                     <td width="25%" height="22" align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;Select Bank</td>
                     <td width="25%"  class="white-bg">
                        <?php echo $bankcombo; ?>
                     </td>
                     <td height="22" width="25%" align="right" class="td-bg" valign="top"><font class="reqmsg">*</font>&nbsp;Account Number</td>
                     <td class="white-bg" width="25%" valign="top">
                        <input type="text" name="Data[vBankAccount]" id="vBankAccount" class="required" value="<?php echo (isset($arr[0]['vBankAccount']))? $arr[0]['vBankAccount'] : ''; ?>" onkeypress='return chkValidChar(event);' style="width:210px;" title="Enter Account Number" />
                     </td>
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
	<!-- onclick="checkvalid(this.form);return false;" -->
     <input type="hidden" name="dpr" id="dpr" value="nod" />
     <input type="image"  id="btnSave" alt="Save" title="Save" style="cursor:pointer" onclick="return submitFrm();" src="<?php  echo  ADMIN_IMAGES?>btn-save.gif" tabIndex="17">
      <img alt="Reset" title="Reset" style="cursor:pointer" src="<?php  echo  ADMIN_IMAGES?>btn-reset.gif" onclick="resetform();return false;" tabIndex="18">
      <img style="cursor:pointer" alt="Cancel" title="Cancel" src="<?php  echo  ADMIN_IMAGES?>btn-cancle.gif" onclick="return RedirectURL('index.php?file=po-bproductorg&view=index&AX=Yes');" tabIndex="19" onblur="$('#vFirstName').focus();">
   </td>
</tr>
</table>
</form>

<script type="text/javascript" src="<?php  echo  S_JQUERY?>jquery.validate.js"></script>
<script type="text/javascript">
var LBL_EMAIL_TAKEN="This email is already in use.";
var LBL_SURE_TO_PROCEED="Do you still want to proceed?";
function resetform() {
   $('#frmadd')[0].reset();
}
function submitFrm()
{
	var vldfrm = $('#frmadd').valid();
	if(!vldfrm) {
		return false;
	}
   $('#frmadd')[0].submit();
/*	var email = $('#vEmail').val();
	pars = "&id=iSMID"+"&iSMID="+$('#iSMID').val()+"&field=vEmail"+"&vEmail="+$('#vEmail').val()+"&table=<?php  echo  PRJ_DB_PREFIX?>_security_manager";
	$.post(ADMIN_URL+"index.php?file=aj-chkdupdata", pars, function(resp)
	{
		if(resp == 'dup') {
			var ans = confirm(LBL_EMAIL_TAKEN+LBL_SURE_TO_PROCEED);
			if(ans) {
				$('#dpr').val('dpl');
				// $('#emlval').val(email);
				// alert('yes');
				$('#frmadd').submit();
			}
		}
		else if(resp != false)
		{
			$('#dpr').val('nod');
			// alert('ndp');
			$('#frmadd').submit();
		}
	});
	return false;
	//$('div[htmlfor=vPhone]').attr("style","float:right;")
	//$('#tdvPhone').attr("style","position:absolute;left:51.7%"); */
}
$("#frmadd").validate({
   rules: {
      "Data[vProductName]": {
         remote:{
            url:ADMIN_URL+"index.php?file=aj-chkdupdata",
            type:"get",
            data:{
               val:function() {
   					return $("#iProductId").val();
   				},
   				id:function() {
   					return "iProductId";
   				},
   				field:function() {
   					return "vProductName";
   				},
   				table:function() {
   					return "<?php echo PRJ_DB_PREFIX?>_bproduct_organization";
   				}
      		}
         }
      },
      "Data[vBankAccount]": {
         remote:{
            url:ADMIN_URL+"index.php?file=aj-chkdupdata",
            type:"get",
            data:{
               val:function() {
   					return $("#iProductId").val();
   				},
   				id:function() {
   					return "iProductId";
   				},
   				field:function() {
   					return "vBankAccount";
   				},
   				table:function() {
   					return "<?php echo PRJ_DB_PREFIX?>_bproduct_organization";
   				}
      		}
         }
      },
      "Data[vProductCode]": {
         remote:{
            url:ADMIN_URL+"index.php?file=aj-chkdupdata",
            type:"get",
            data:{
               val:function() {
						return $("#iProductId").val();
					},
					id:function() {
						return "iProductId";
					},
					field:function() {
						return "vProductCode";
					},
					table:function() {
						return "<?php echo PRJ_DB_PREFIX?>_bproduct_organization";
					}
			   }
         }
      }
	},
   messages:{
		"Data[vProductName]": {
			remote: jQuery.validator.format("This product name already exists")
		},
      "Data[vProductCode]": {
			remote: jQuery.validator.format("This product code is already is use")
		},
		"Data[vBankAccount]": {
			remote: jQuery.validator.format("This bank account number is already in use")
		}
	}
});
</script>