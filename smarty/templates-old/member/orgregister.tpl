{literal}
<script type="text/javascript">
	var stateArr = new Array({/literal}{$stateArr}{literal});
</script>
{/literal}
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
		<div class="security-bg" style="width:100%;">
			<div class="organization" style="">
				<div><a style="">&nbsp;<img src="{$SITE_IMAGES}icon-admini.png" />&nbsp; {$LBL_REGISTER_ORGANIZATION}</a></div>
				<div id="msg" class="msg err" align="center"></div>
				<div id="forgreg" style="padding-left:59px;" align="left">
					<form name="frmorgreg" id="frmorgreg" method="post" action="">
						<div>
							<span class="username" style="display:inline-block; width:250px;">{$LBL_USER_NAME} * :  </span>
							<input type="text" id="vUserName" name="vUserName" class="required" style="width:390px; height:21px;" title="{$LBL_ENTER} {$LBL_USER_NAME}" onkeypress="return chkalphanum(event);" value="{$vdata.vUserName}" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;">{$LBL_PASSWORD} * :  </span>
							<input type="password" id="vPassword" name="vPassword" class="required" style="width:390px; height:21px;" title="{$LBL_ENTER} {$LBL_PASSWORD}" onkeypress="// return chkalphanum(event);" minlength="5" />
							<span class="" style="position:absolute; font-size:10px; margin-left:10px;">{$LBL_PASSWORD_STRENGTH}<span id="pst"></span><div id="psi" class="is0" style=""></div></span>
							<div htmlfor="vPassword" generated="true" class="err" style="padding-left:0px;"></div>
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;">{$LBL_CONFIRM} {$LBL_PASSWORD} * :  </span>
							<input type="password" id="vConPassword" name="vConPassword" class="required equalto" equalto="#vPassword" style="width:390px; height:21px;" title="{$LBL_ENTER} {$LBL_CONFIRM} {$LBL_PASSWORD}" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;">{$LBL_FIRST_NAME} * :  </span>
							<input type="text" id="vFirstName" name="vFirstName" class="required" style="width:390px; height:21px;" title="{$LBL_ENTER} {$LBL_FIRST_NAME}" onkeypress="return chkalphanum(event);" value="{$vdata.vFirstName}" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;">{$LBL_LAST_NAME} * :  </span>
							<input type="text" id="vLastName" name="vLastName" class="required" style="width:390px; height:21px;" title="{$LBL_ENTER} {$LBL_LAST_NAME}" onkeypress="return chkalphanum(event);" value="{$vdata.vLastName}" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;">{$LBL_ORGANIZATION} {$LBL_NAME} * : </span> 
							<input type="text" id="vCompanyName" name="vCompanyName" class="required" style="width:390px; height:21px;" title="{$LBL_ENTER} {$LBL_ORGANIZATION} {$LBL_NAME}" value="{$vdata.vCompanyName}" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;">{$LBL_ORGANIZATION} {$LBL_TYPE} * : </span> 
							{$OrgType}
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;">{$LBL_COMP_CODE} * : </span> 
							<input type="text" id="vCompCode" name="vCompCode" class="required" style="width:390px; height:21px;" title="{$LBL_ENTER} {$LBL_COMP_CODE}" onkeypress="return chkalphanum(event);" value="{$vdata.vCompCode}" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;">{$LBL_COMP_REG_NO} * : </span> 
							<input type="text" id="vCompanyRegNo" name="vCompanyRegNo" class="required" style="width:390px; height:21px;" title="{$LBL_ENTER} {$LBL_COMP_REG_NO}" onkeypress="// return chkDigitMobcode(event);" value="{$vdata.vCompanyRegNo}" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;">{$LBL_COMPANY} {$LBL_ADDR_LINE} 1 * : </span> 
							<input type="text" id="vAddressLine1" name="vAddressLine1" class="required" style="width:390px; height:21px;" title="{$LBL_ENTER} {$LBL_COMPANY} {$LBL_ADDR_LINE} 1" value="{$vdata.vAddressLine1}" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;">{$LBL_COMPANY} {$LBL_ADDR_LINE} 2 : </span> 
							<input type="text" id="vAddressLine2" name="vAddressLine2" class="" style="width:390px; height:21px;" title="{$LBL_ENTER} {$LBL_COMPANY} {$LBL_ADDR_LINE} 2" value="{$vdata.vAddressLine2}" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;">{$LBL_COMPANY} {$LBL_ADDR_LINE} 3 : </span> 
							<input type="text" id="vAddressLine3" name="vAddressLine3" class="" style="width:390px; height:21px;" title="{$LBL_ENTER} {$LBL_COMPANY} {$LBL_ADDR_LINE} 3" value="{$vdata.vAddressLine3}" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;">{$LBL_COUNTRY} * : </span> 
							<select name="vCountry" id="vCountry" class="required" title="{$LBL_SELECT_COUNTRY}">
							<option value=""> --- {$LBL_SELECT_COUNTRY} --- </option>
							{section name=i loop=$db_country}
								<option title="{$db_country[i].iCountryISD}" currency="{$db_country[i].iCurrencyID}" value="{$db_country[i].vCountryCode}" {if $db_country[i].vCountryCode eq $vdata.vCountry}selected='selected'{/if}>{$db_country[i].vCountry}</option>
							{/section}
							</select>
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;">{$LBL_STATE} * : </span> 
							<select name="vState" id="vState" class="required" title="{$LBL_SELECT_STATE}">
								<option value="">--- {$LBL_SELECT_STATE} ---</option>
							</select>
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;">{$LBL_CITY} * : </span> 
							<input type="text" id="vCity" name="vCity" class="required" style="width:390px; height:21px;" title="{$LBL_ENTER} {$LBL_CITY}" value="{$vdata.vCity}" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;">{$LBL_ZIP_CODE} * : </span> 
							<input type="text" id="vZipcode" name="vZipcode" class="required" style="width:390px; height:21px;" title="{$LBL_ENTER} {$LBL_ZIP_CODE}" onkeypress="return chkDigitMobcode(event);" maxLength="7" value="{$vdata.vZipcode}" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;">{$LBL_PHONE} * : </span>
							<input type="text" id="vPhoneCode" name="vPhoneCode"  class="countryCode" onkeypress="return chkDigitMobcode(event);" style="width:30px; height:21px;" maxlength="3" title="{$LBL_ENTER_PHONECODE}" value="{$vdata.vPhoneCode}" />
							<input type="text" id="vPhone" name="vPhone" title="{$LBL_ENTER_PHONE_NO}" onkeypress="return chkDigitMobcode(event);" maxlength="15" style="width:150px; height:21px;" value="{$vdata.vPhone}" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;">{$LBL_COMPANY} {$LBL_EMAIL} * : </span> 
							<input type="text" id="vEmail" name="vEmail" class="required" style="width:390px; height:21px;" title="{$LBL_ENTER} {$LBL_COMPANY} {$LBL_EMAIL}" value="{$vdata.vEmail}" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;">{$LBL_PERSONAL} {$LBL_EMAIL} * : </span> 
							<input type="text" id="vpEmail" name="vpEmail" class="required" style="width:390px; height:21px;" title="{$LBL_ENTER} {$LBL_PERSONAL} {$LBL_EMAIL}" value="{$vdata.vpEmail}" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;">{$LBL_VAT_ID} * : </span> 
							<input type="text" id="vVatId" name="vVatId" class="" style="width:390px; height:21px;" title="{$LBL_ENTER} {$LBL_VAT_ID}" value="{$vdata.vVatId}" />
						</div>
						
						<div>
							<span class="username" style="display:inline-block; width:250px;">{$LBL_SEC_QUESTION} 1 * :  </span>
							{$secQuestion1}
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;">{$LBL_ANSWER} * :  </span>
							<input type="text" id="vAnswer" name="vAnswer" class="required" style="width:390px; height:21px;" title="{$LBL_ENTER} {$LBL_ANSWER}" onkeypress="return chkalphanum(event);" value="{$vdata.vAnswer}" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;">{$LBL_SEC_QUESTION} 2 :  </span>
							{$secQuestion2}
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;">{$LBL_ANSWER} * :  </span>
							<input type="text" id="vAnwser" name="vAnwser" class="required" style="width:390px; height:21px;" title="{$LBL_ENTER} {$LBL_ANSWER}" onkeypress="return chkalphanum(event);" value="{$vdata.vAnwser}" />
						</div>
						
						<div>
							<span class="username" style="display:inline-block; width:250px;">{$LBL_BANK} : </span> 
							<select name="iBankId" id="iBankId" class="" title="{$LBL_SELECT} {$LBL_BANK}">
							<option value="">--- {$LBL_SELECT} {$LBL_BANK} ---</option>
							{section name="l" loop=$bnk_dtls}
							<option value="{$bnk_dtls[l].iBankId}" {if $bnk_dtls[l].iBankId eq $vdata.iBankId}selected='selected'{/if}>{$bnk_dtls[l].vBankName}</option>
							{/section}
							</select>
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;">{$LBL_BANK_CODE} : </span> 
							<input type="text" id="vBankCode" name="vBankCode" class="" style="width:390px; height:21px;" title="{$LBL_ENTER} {$LBL_BANK_CODE}" value="{$vdata.vBankCode}" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;">{$LBL_BRANCH}: </span> 
							<input type="text" id="vBranchName" name="vBranchName" class="" style="width:390px; height:21px;" title="{$LBL_ENTER} {$LBL_BRANCH}" value="{$vdata.vBranchName}" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;">{$LBL_BRANCH_CODE}: </span> 
							<input type="text" id="vBranchCode" name="vBranchCode" class="" style="width:390px; height:21px;" title="{$LBL_ENTER} {$LBL_BRANCH_CODE}" value="{$vdata.vBranchCode}" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;">{$LBL_ACCOUNT_NUMBER} : </span> 
							<input type="text" id="vAccount1Number" name="vAccount1Number" class="" style="width:390px; height:21px;" title="{$LBL_ENTER} {$LBL_ACCOUNT_NUMBER}" value="{$vdata.vAccount1Number}" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;">{$LBL_ACCOUNT_TITLE} : </span> 
							<input type="text" id="vAccount1Title" name="vAccount1Title" class="" style="width:390px; height:21px;" title="{$LBL_ENTER} {$LBL_ACCOUNT_TITLE}" value="{$vdata.vAccount1Title}" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;">{$LBL_ACCOUNT_CURRENCY} : </span>
							<select name="vAccount1Currency" id="vAccount1Currency" class="" title="{$LBL_SELECT} {$LBL_ACCOUNT_CURRENCY}" >
							{section name="c" loop=$currency}
								<option id="{$currency[c].iCurrencyID}_1" value="{$currency[c].vCode|htmlentities}" {if $vdata.vAccount1Currency}selected='selected'{/if} >{$currency[c].vCode}</option>
							{/section}
						</select>
						</div>
						
						<div>
							<span class="username" style="display:inline-block; width:250px;">{$LBL_ONLINE_EMAIL_NOTIFICATION} * :  </span>
							<input type="checkbox" id="eEmailNotification" name="eEmailNotification" class="" style="height:21px;" title="{$LBL_SELECT} {$LBL_ONLINE_EMAIL_NOTIFICATION}" value="Yes" checked='checked' />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;">{$LBL_DEFAULT_LANGUAGE} * :  </span>
							<select name="vDefaltLan" id="vDefaltLan">
								{section name="i" loop=$dlang}
								<option value="{$dlang[i].vLanguageCode}" {if $dlang[i].vLanguageCode eq $vdata.vDefaltLan}selected='selected'{/if}>{$dlang[i].vLanguage}</option>
								{/section}
                     </select>
						</div>
						
						<div>
							<span class="username" style="display:inline-block; width:250px;">&nbsp;</span>
							<div style='margin-left:250px;'><img id='captchaimg' src="" /> &nbsp; <img id='refresh' src="{$SITE_IMAGES}refresh.jpg" height="39px" /></div>
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;">{$LBL_SECURITY_CODE} : </span>
							<input type='text' name='scode' id='scode' class='' style='width:150px; height:21px;' title="{$LBL_ENTER_SECURITY_CODE}" />
						</div>						
						
						<div style="height:10px; line-height:10px;">&nbsp;</div>
						<div class="remember" style="padding-left:250px; margin:10px;">
							<span class="send" style=""> <img id="fpsend" src="{$SITE_IMAGES}btn-send.gif" alt="" border="0" class="valignmidd pointer" onkeypress="return chkEnter(event,'yes','forgotPass()')" /> &nbsp; </span>  &nbsp;
							<span style="display:inline-block; width:30px;"> &nbsp; </span>
						</div>
						<div style="height:15px;">&nbsp;</div>
					</form>
				</div>
			</div>
		</div>
    </td>
  </tr>
</table>
<span class="ajscript"></span>
<script type="text/javascript" src="{$S_JQUERY}jquery.validate.js"></script>
<script type="text/javascript" src="{$S_JQUERY}jquery.passwordstrength.js"></script>
<script type="text/javascript" src="{$SITE_JS_AJAX}jorgreg.js"></script>
{literal}
<script type="text/javascript">
function fillCountryCode() {
	var currency = $('#vCountry option:selected').attr('currency'); 	// opt.getAttribute("currency");
	$('input.countryCode').val($('#vCountry option:selected').attr('title')); 	// opt.title
	$('#vAccount1Currency option[id="'+currency+'_1"]').attr("selected","selected");
}
$('document').ready(function() {
	$('#vPassword').passwordStrength({targetElement:'#psi', targetTextElement:'#pst', psimsg:["{/literal}{$LBL_WEAK}{literal}","{/literal}{$LBL_MEDIUM}{literal}","{/literal}{$LBL_STRONG}{literal}","{/literal}{$LBL_VERY_STRONG}{literal}"]});
	$('#vCountry').change(function() {
		setTimeout("getRelativeCombo('"+$(this).val()+"','','vState','-- "+'{/literal}{$LBL_SELECT_STATE}{literal}'+" --',stateArr); fillCountryCode();",100);
		setTimeout("$('#frmorgreg').validate().element('#vCompanyRegNo');",1000);
	});
	$('#eOrganizationType').change(function() {
		$('#frmorgreg').validate().element('#vCompanyRegNo');
	});
	setTimeout("getRelativeCombo('"+$('#vCountry').val()+"','"+'{/literal}{$vdata.vState}{literal}'+"','vState','-- "+'{/literal}{$LBL_SELECT} {$LBL_STATE}{literal}'+" --', stateArr);", 10);
	// getRelativeCombo($('#vCountry').val(),'{/literal}{$vdata.vState}{literal}','vState','-- {/literal}{$LBL_SELECT} {$LBL_STATE}{literal} --', stateArr);
});
</script>
{/literal}