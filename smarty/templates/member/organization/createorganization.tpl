<script type="text/javascript" src="{$S_JQUERY}jquery.validate.js"></script>
{literal}
<script type="text/javascript" >
	var stateArr = new Array({/literal}{$stateArr}{literal});
	//alert(stateArr);
</script>
{/literal}
<div class="middle-container">
  <h1>{$LBL_CREATE_ORG}</h1>
  <div class="middle-containt">
  <div class="statistics-main-box-white">
	<div>
		<ul id="inner-tab">
			<li><a href="{$SITE_URL_DUM}createorganization/{$iOrganizationID}" class="{if $file eq 'or-createorganization'}current{/if}"><EM>{$LBL_ORG_INFO}</EM></a></li>
			{if $view eq 'edit'}
			<li><a href="{$SITE_URL_DUM}createorganizationpref/{$iOrganizationID}/{$iAdditionalInfoID}" class="{if $file eq 'or-createorganizationpref'}current{/if}"><EM>{$LBL_PREFERENCES}</EM></a></li>
			{elseif $view eq 'add' || $view eq ''}
			<li><a><EM>{$LBL_PREFERENCES}</EM></a></li>
			{/if}
		</ul>
	</div>
  <div class="clear"></div>
  <div class="inner-gray-bg">
  <div>&nbsp;</div>
  <div>
      {*if $msg neq ''}
			{*<div class="msg">{$msg}</div>}
			{literal}
			<script>
			$(document).ready(function() {
				 var msg='{/literal}{$msg}{literal}';
				 if(msg!= '' && msg != undefined)
				 alert(msg);
			});
			</script>
			{/literal}
		 {/if*}
     <form name="frmadd" id="frmadd" action="{$SITE_URL}index.php?file=or-createorganization_a" method="post">
     <input type="hidden" name="iOrganizationID" id="iOrganizationID"value="{$iOrganizationID}" />
     <input type="hidden" name="iAdditionalInfoID" id="iAdditionalInfoID"value="{$iAdditionalInfoID}" />
     <input type="hidden" name="iASMID" id="iASMID"value="{$iASMID}" />
     <input type="hidden" name="view" id="view"value="{$view}" />
     <table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
          <tr>
               <td width="205">{$LBL_COMP_NAME}&nbsp;<font class="reqmsg">*</font>  </td>
               <td>:</td>
               <td><input type="text" name="Data[vCompanyName]" id="vCompanyName" class="input-rag required" title="{$LBL_ENTER_COMPANY_NAME}" value="{$arr[0].vCompanyName}" MinLength="2" /></td>
          </tr>
			 {if $view eq 'edit'}
          <tr>
               <td>{$LBL_ORG_CODE}&nbsp; </td>
              <td>:</td>
               <td>
					{$arr[0].vOrganizationCode}
					</td>
          </tr>
			{/if}
          <tr>
               <td>{$LBL_COMP_CODE}&nbsp;{if $view neq 'edit'}<font class="reqmsg">*</font> {/if}</td>
               <td>:</td>
               <td>{if $view eq 'edit'}
                   {$arr[0].vCompCode}
                   {else}
                   <input type="text" name="Data[vCompCode]" id="vCompCode" class="input-rag required alphaNum" title="{$LBL_ENTER_COMP_CODE}" onkeypress="return chkalphanum(event);" value="{$arr[0].vCompCode}" />
                   {/if}
					</td>
          </tr>
          <tr>
               <td>{$LBL_COMP_REG_NO}&nbsp;<font class="reqmsg">*</font> </td>
               <td>:</td>
               <td><input type="text" name="Data[vCompanyRegNo]" id="vCompanyRegNo" class="input-rag required" title="{$LBL_ENTER_COMPANY_REG_NO}" onkeypress="// return chkDigitMobcode(event);" value="{$arr[0].vCompanyRegNo}" /></td>
          </tr>

          <tr>
               <td> {$LBL_ADDR_LINE} 1&nbsp;<font class="reqmsg">*</font> </td>
               <td>:</td>
               <td><input type="text" name="Data[vAddressLine1]" id="vAddressLine1" class="input-rag required" value="{$arr[0].vAddressLine1}" title="{$LBL_ENTER_ADDRESS}" /></td>
          </tr>
          <tr>
               <td> {$LBL_ADDR_LINE} 2 </td>
               <td>:</td>
               <td><input type="text" name="Data[vAddressLine2]" id="vAddressLine2" class="input-rag" value="{$arr[0].vAddressLine2}" /></td>
          </tr>
          <tr>
               <td> {$LBL_ADDR_LINE} 3 </td>
               <td>:</td>
               <td><input type="text" name="Data[vAddressLine3]" id="vAddressLine3" class="input-rag" value="{$arr[0].vAddressLine3}" /></td>
          </tr>
          <tr>
               <td>{$LBL_CITY}&nbsp;<font class="reqmsg">*</font> </td>
               <td>:</td>
               <td><input type="text" name="Data[vCity]" id="vCity" class="input-rag required" value="{$arr[0].vCity}" title="{$LBL_ENTER} {$LBL_CITY}" /></td>
          </tr>
          <tr>
               <td>{$LBL_COUNTRY}&nbsp;<font class="reqmsg">*</font> </td>
               <td>:</td>
               <td><select name="Data[vCountry]" id="vCountry" class="required" title="{$LBL_SELECT_COUNTRY}">
							<option value=""> --- Select Country --- </option>
							{section name=i loop=$db_country}
								<option title="{$db_country[i].iCountryISD}" currency="{$db_country[i].iCurrencyID}" value="{$db_country[i].vCountryCode}" {if $arr[0].vCountry eq $db_country[i].vCountryCode}selected{/if}>{$db_country[i].vCountry}</option>
							{/section}
						</select>
					</td>
          </tr>
                    <tr>
               <td>{$LBL_STATE}&nbsp;<font class="reqmsg">*</font> </td>
               <td>:</td>
               <td>
						<input type="hidden" name="selstate" id="selstate" value="{$arr[0].vState}">
						<select name="Data[vState]" id="vState" class="required" title="{$LBL_SELECT_STATE}" >
                    <option value=""> --- Select State ---</option>
						</select>
					</td>
          </tr>

          <tr>
               <td>{$LBL_ZIP_CODE}&nbsp;<font class="reqmsg">*</font> </td>
               <td>:</td>
               <td><input type="text" name="Data[vZipcode]" id="vZipcode" class="input-rag required digits" value="{$arr[0].vZipcode}" onkeypress="return chkDigitMobcode(event);" MaxLength="7" /></td>
          </tr>
          <tr>
               <td>{$LBL_PHONE}&nbsp;<font class="reqmsg">*</font> </td>
               <td>:</td>
               <td  valign="top">
						<input type="text" name="vPhoneCode"  class="" value="{$arr[0].vPhoneCode}" onkeypress="return chkDigitMobcode(event);"  id="vPhoneCode" style="width:30px;" maxlength="3" title="{$LBL_ENTER_PHONECODE}"  />
						<input type="text" name="Data[vPhone]" id="vPhone"  title="{$LBL_ENTER_PHONE_NO}" onkeypress="return chkDigitMobcode(event);" maxlength="15" value="{$arr[0].vPhone}" style="width:190px;"/>
               </td>
          </tr>
          <tr>
               <td>{$LBL_EMAIL}&nbsp;<font class="reqmsg">*</font> </td>
               <td>:</td>
               <td><input type="text" name="Data[vEmail]" id="vEmail" class="input-rag  required email" value="{$arr[0].vEmail}" /></td>
          </tr>
          <tr>
              <td>{$LBL_WEB_SITE} :</td>
              <td>:</td>
              <td><input type="text" name="Data[vWebSite]" id="vWebSite" class="input-rag" value="{$arr[0].vWebSite}" /></td>
          </tr>
          <tr>
               <td>{$LBL_ORG_TYPE}&nbsp;<font class="reqmsg">*</font> </td>
               <td>:</td>
               <td>{$OrgType}</td>
          </tr>
			 {*if $view eq 'edit'}
			 <tr>
				<td colspan="2">&nbsp;</td>
				<td><span class="msg">({$MSG_ORGTYPE_CHANGE_WARNING})</span></td>
			 </tr>
			 {/if*}
          <tr>
               <td>{$LBL_PRIME_CONTACT_NO} :</td>
               <td>:</td>
               <td>
                  <input type="text" name="vPrimaryContactNoCode" id="vPrimaryContactNoCode" class="countryCode input-rag" value="{$arr[0].vPrimaryContactNoCode}" onkeypress="return chkDigitMobcode(event);" style="width:30px;" maxlength="3"  />
                  <input type="text" name="Data[vPrimaryContactNo]" id="vPrimaryContactNo" class="input-rag" value="{$arr[0].vPrimaryContactNo}" onkeypress="return chkDigitMobcode(event);" maxlength="15" style="width:190px;" />
               </td>
          </tr>
          {*}<tr>
               <td>{$LBL_PRIME_CONTACT_EMAIL} </td>
              <td>:</td>
               <td><input type="text" name="Data[vPrimaryContactEmail]" id="vPrimaryContactEmail" class="input-rag" value="{$arr[0].vPrimaryContactEmail}" /></td>
          </tr>{*}
          <tr>
               <td>{$LBL_PRIME_CONTACT_TELE} </td>
               <td>:</td>
               <td>
                  <input type="text" name="vPrimaryContactTelephoneCode" id="vPrimaryContactTelephoneCode" class="countryCode input-rag" onkeypress="return chkDigitMobcode(event);" maxlength="3" value="{$arr[0].vPrimaryContactTelephoneCode}" style="width:30px;" />
                  <input type="text" name="Data[vPrimaryContactTelephone]" id="vPrimaryContactTelephone" class="input-rag" onkeypress="return chkDigitMobcode(event);" maxlength="15" value="{$arr[0].vPrimaryContactTelephone}" style="width:190px;" />
               </td>
          </tr>
          <tr>
               <td>{$LBL_PRIME_CONTACT_MOB} </td>
               <td>:</td>
               <td>
                  <input type="text" name="vPrimaryContactMobileCode" id="vPrimaryContactMobileCode" class="countryCode input-rag" value="{$arr[0].vPrimaryContactMobileCode}" onkeypress="return chkDigitMobcode(event);" maxlength="3" style="width:30px;"/>
                  <input type="text" name="Data[vPrimaryContactMobile]" id="vPrimaryContactMobile" class="input-rag" value="{$arr[0].vPrimaryContactMobile}" onkeypress="return chkDigitMobcode(event);" maxlength="15" style="width:190px;"/>
               </td>
          </tr>
			 <tr>
               <td>{$LBL_VAT_ID} </td>
               <td>:</td>
               <td>
						<input type="text" name="Data[vVatId]" id="vVatId" class="input-rag" value="{$arr[0].vVatId}" />
					</td>
          </tr>
          <tr>
               <td>{$LBL_BANK} </td>
               <td>:</td>
               <td>
						<!--<input type="text" name="Data[vBankName]" id="vBankName" class="input-rag" value="{$arr[0].vBankName}" />-->
						<select name="Data[iBankId]" id="iBankId" class="required" title="{$LBL_SELECT} {$LBL_BANK}">
						{section name="l" loop=$bnk_dtls}
						<option value="{$bnk_dtls[l].iBankId}" {if $arr[0].iBankId >0}{if $bnk_dtls[l].iBankId eq $arr[0].iBankId}selected="selected"{/if}{elseif $bnk_dtls[l].vBankName eq $arr[0].vBankName}selected="selected"{/if}>{$bnk_dtls[l].vBankName}</option>
						{/section}
						</select>
					</td>
          </tr>
			 <tr>
               <td>{$LBL_BANK_CODE} </td>
               <td>:</td>
               <td><input type="text" name="Data[vBankCode]" id="vBankCode" class="input-rag" value="{$arr[0].vBankCode}" /></td>
          </tr>
			 <tr>
               <td>{$LBL_BRANCH} </td>
               <td>:</td>
               <td><input type="text" name="Data[vBranchName]" id="vBranchName" class="input-rag" value="{$arr[0].vBranchName}" /></td>
          </tr>
			 <tr>
               <td>{$LBL_BRANCH_CODE} </td>
               <td>:</td>
               <td><input type="text" name="Data[vBranchCode]" id="vBranchCode" class="input-rag" value="{$arr[0].vBranchCode}" /></td>
          </tr>
          <tr>
               <td>Account1 Number </td>
               <td>:</td>
               <td><input type="text" name="Data[vAccount1Number]" id="vAccount1Number" class="input-rag" value="{$arr[0].vAccount1Number}" /></td>
          </tr>
             <tr>
               <td>Account1 Title </td>
               <td>:</td>
               <td><input type="text" name="Data[vAccount1Title]" id="vAccount1Title" class="input-rag" value="{$arr[0].vAccount1Title}" /></td>
          </tr>
			 <tr>
					<td>Account1 {$LBL_CURR}</td>
					<td>:</td>
					<td>
						<select name="Data[vAccount1Currency]" id="vAccount1Currency" class="required" style="width:96px;" title="Select Currency" >
						  {section name="c" loop=$currency}
								<option value="{$currency[c].vCode|htmlentities}" id="{$currency[c].iCurrencyID}_1" {if $currency[c].vCode eq $arr[0].vAccount1Currency}selected="selected"{/if} >{$currency[c].vCode}</option>
						  {/section}
						</select>
					</td>
			 </tr>
          <tr>
               <td>Account2 Number </td>
               <td>:</td>
               <td><input type="text" name="Data[vAccount2Number]" id="vAccount2Number" class="input-rag" value="{$arr[0].vAccount2Number}" /></td>
          </tr>
          <tr>
               <td>Account2 Title </td>
               <td>:</td>
               <td><input type="text" name="Data[vAccount2Title]" id="vAccount2Title" class="input-rag" value="{$arr[0].vAccount2Title}" /></td>
          </tr>
          <tr>
               <td>Account2 Currency </td>
               <td>:</td>
               <td>
						<select name="Data[vAccount2Currency]" id="vAccount2Currency" class="required" style="width:96px;" title="Select Currency" >
						  {section name="c" loop=$currency}
								<option value="{$currency[c].vCode|htmlentities}" id="{$currency[c].iCurrencyID}_2" {if $currency[c].vCode eq $arr[0].vAccount1Currency}selected="selected"{/if} >{$currency[c].vCode}</option>
						  {/section}
						</select>
					</td>
          </tr>

<tr>
               <td colspan="2" height="5"></td>
          </tr>
          <tr>
               <td>&nbsp;</td>
               <td colspan="2">
						<input type="hidden" name="dpr" id="dpr" value="nod" />
						<input type="hidden" name="emlval" id="emlval" value="" />
						<img id="btnNext"  name="Next" title="next" src="{$SITE_IMAGES}sm_images/btn-next.gif" alt="" onclick="submitFrm();" style="cursor:pointer; vertical-align:middle;border:none;background: #f8f8f8;" /> &nbsp;
						<img src="{$SITE_IMAGES}sm_images/btn-reset.gif" alt="" onclick="resetform();return false;" style="cursor:pointer;border:none;background: #f8f8f8;; vertical-align:middle;" /> &nbsp;
						<img src="{$SITE_IMAGES}sm_images/btn-cancel.gif" alt="" onClick="window.location=SITE_URL_DUM+'organizationlist';" style="cursor:pointer;border:none; vertical-align:middle;background: #f8f8f8;" />
					</td>
          </tr>
     </table>
     </form>
   </div>
   <div>&nbsp;</div>
   </div>
   </div>
   </div>
  <span id="spn" style="display:hidden;"></span>
  <input type="hidden" name="vldms" id="vldms" value="" />
  <span class="ajscript"></span>
</div>

{literal}
<script type="text/javascript" async="async">
function submitFrm()
{
   if(! $("#frmadd").valid()) {
      return false;
   }
	var email = $('#vEmail').val();
	pars = "&id=iOrganizationID"+"&iOrganizationID="+$('#iOrganizationID').val()+"&flds=vEmail"+"&vEmail="+$('#vEmail').val()+"&table={/literal}{$PRJ_DB_PREFIX}{literal}_organization_master";
	$.post(SITE_URL+"index.php?file=m-aj_chkdupdata", pars, function(resp)
	{
		if(resp == 'dup') {
			var ans = confirm(LBL_EMAIL_TAKEN+LBL_SURE_TO_PROCEED);
			if(ans) {
				$('#dpr').val('dpl');
				// $('#emlval').val(email);
				// alert('yes');
				$('#frmadd')[0].submit();
			}
		} else if(resp == 'nodup') {
			$('#dpr').val('nod');
			// alert('ndp');
			$('#frmadd')[0].submit();
			$(document).ready( function() {
				$(function() {
					var ead=10;
					$('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
				});
			});
		}
	});
	return false;
	//$('div[htmlfor=vPhone]').attr("style","float:right;")
	//$('#tdvPhone').attr("style","position:absolute;left:51.7%");
}
function resetform()
{
	$('#frmadd')[0].reset();
   getRelativeCombo($('#vCountry').val(),'{/literal}{$arr[0].vState}{literal}','vState','-- Select State --',stateArr);
}

$("#frmadd").validate({
	rules:{
          "Data[vPhone]":{
                    required: function(){
                         if($.trim($('#vPhoneCode').val()) == '') {
                                 //$('#vPhoneCode').attr("title","{/literal}{$LBL_ENTER_PHONECODE}{literal}");
											return true;
											// $("#frmadd").validate().element('#vPhoneCode');
                            } else {
										return true;
                              // $('#vPhone').attr("title","{/literal}{$LBL_ENTER_PHONE_NO}{literal}");
                           }
                    }},

		"Data[vCompanyRegNo]": {
				remote:{
					  url:SITE_URL+"index.php?file=or-aj_chkdupdata",
					  type:"get",
					  data:{
							 val:function() {
								return $("#iOrganizationID").val();
							},
							id:function() {
								return "iOrganizationID";
							},
							field:function() {
								return "vCompanyRegNo";
							},
                     country: function() {
                        return $('#vCountry').val();
                     },
							table:function() {
								return "{/literal}{$PRJ_DB_PREFIX}{literal}_organization_master";
							}
					}
			}
		},
		"Data[vCompanyName]": {
				remote:{
					  url:SITE_URL+"index.php?file=or-aj_chkdupdata",
					  type:"get",
					  data:{
							 val:function() {
								return $("#iOrganizationID").val();
							},
							id:function() {
								return "iOrganizationID";
							},
							field:function() {
								return "vCompanyName";
							},
							table:function() {
								return "{/literal}{$PRJ_DB_PREFIX}{literal}_organization_master";
							}
					}
			}
		},
		"Data[vCompCode]": {
				remote:{
					  url:SITE_URL+"index.php?file=or-aj_chkdupdata",
					  type:"get",
					  data:{
							 val:function() {
								return $("#iOrganizationID").val();
							},
							id:function() {
								return "iOrganizationID";
							},
							field:function() {
								return "vCompCode";
							},
							table:function() {
								return "{/literal}{$PRJ_DB_PREFIX}{literal}_organization_master";
							}
					}
			}
		}/*,
		"Data[vEmail]": {
				remote:{
					  url:SITE_URL+"index.php?file=or-aj_chkdupdata",
					  type:"get",
					  data:{
							 val:function() {
								return $("#iOrganizationID").val();
							},
							id:function() {
								return "iOrganizationID";
							},
							field:function() {
								return "vEmail";
							},
							table:function() {
								return "{/literal}{$PRJ_DB_PREFIX}{literal}_organization_master";
							}
					}
			}
		}*/
	},
   messages:{
      "Data[vCompanyRegNo]": {
			remote: jQuery.validator.format(LBL_COMPANY_REG_NO)
		},
		"Data[vCompanyName]": {
			remote: jQuery.validator.format(LBL_COMPANY_NAME)
		},
                "Data[vCompCode]": {
                        alphaNum : LBL_ONLY_APLHA_NUM,
                    	remote: jQuery.validator.format(LBL_COMP_CODE_TAKEN)
                },
		"Data[vEmail]": {
			required: LBL_EMAIL_ADDRESS,
			email: LBL_VALID_EMAIL_ADDRESS,
			remote: jQuery.validator.format(LBL_EMAIL_TAKEN)
		},
		"Data[vZipcode]": {required: LBL_ZIPCODE},

          "Data[eOrganizationType]": {required: LBL_ORGANIZATION_TYPE},
          "Data[eCreateMethodAllowed]": {required: CRETE_METHO_ALLOWED},
          "Data[eCreateVerification]": {required:LBL_VERIFICATION}
	}
});
function fillCountryCode()
{
	// var opt = obj.options[obj.selectedIndex];
	var currency = $('#vCountry option:selected').attr('currency'); 	// opt.getAttribute("currency");
	$('input.countryCode').val($('#vCountry option:selected').attr('title')); 	// opt.title
	$('#vAccount1Currency option[id="'+currency+'_1"]').attr("selected","selected");
	$('#vAccount2Currency option[id="'+currency+'_2"]').attr("selected","selected");
}
jQuery.validator.addMethod("alphaNum", function(value, element) {
   regex=/^[0-9A-Za-z]+$/
   if(! regex.test(value)) { return false; }
	else { return true; }
}, "Message");

$(document).ready(function()
{
	getRelativeCombo($('#vCountry').val(),'{/literal}{$arr[0].vState}{literal}','vState','-- Select State --', stateArr);
	// setTimeout("getRelativeCombo('"+$('#vCountry').val()+"','"+'{/literal}{$vdata.vState}{literal}'+"','vState','-- "+'{/literal}{$LBL_SELECT} {$LBL_STATE}{literal}'+" --', stateArr);", 100);
	$('#vCountry').change(function() {
		setTimeout("getRelativeCombo('"+$(this).val()+"','','vState','-- "+'{/literal}{$LBL_SELECT_STATE}{literal}'+" --',stateArr); fillCountryCode();",100);
		setTimeout("$('#frmadd').validate().element('#vCompanyRegNo');",1000);
	});
	function fillbankdtls() {
		var url = SITE_URL+"index.php?file=or-aj_fillbankdtls";
		var pars = "&bankid="+$('#iBankId').val()+"&flds=vSwiftCode&tflds=vBankCode";
		$.ajax({type:"get", url:url, data:pars, success:function(resp) {
				$('.ajscript').attr('innerHTML','');
				$('.ajscript').append(resp);
			}
		});
	}
	$('#iBankId').change(fillbankdtls);
	// if($('#view').val().toLowerCase() == 'add' || $.trim($('#view').val()) == '') {
		fillbankdtls();
	// }
});
</script>
{/literal}
{if $msg neq ''}
{literal}
<script type="text/javascript" async="async">
$(document).ready(function() {
	var vldmsg = '{/literal}{$vldmsg}{literal}';
	var msg='{/literal}{$msg}{literal}';
	 //alert($('#vldms').val());
   if(msg!= '' && msg != undefined && $('#vldms').val()!=msg) {
	    alert(msg);
		$('#vldms').val(msg);
   }
});
</script>
{/literal}
{/if}