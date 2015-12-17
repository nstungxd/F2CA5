<script type="text/javascript" src="{$S_JQUERY}jquery.validate.js"></script>
{literal}
<script type="text/javascript" >
	var stateArr = new Array({/literal}{$stateArr}{literal});
     //alert(stateArr);
</script>
{/literal}
<div class="middle-container">
  <h1>{$LBL_EDIT_PROFILE}</h1>
  <div class="middle-containt">
  <div class="statistics-main-box-white">
       <div>
          <ul id="inner-tab">
               <li><a class="current"><EM>{$LBL_PROFILE_INFO}</EM></a></li>
               <!--<li><a href="{$SITE_URL_DUM}changepass" class="{if $file eq 'm-changepass'}current{/if}"><EM>{$LBL_CHANGE_PASSWORD}</EM></a></li>-->
          </ul>
       </div>
  <div class="clear"></div>
  <div class="inner-gray-bg">
  <div>&nbsp;</div>
  <div>
       {if $msg neq ''}
                         {*<div class="msg">{$msg}</div>*}
                    {*literal}
                    <script>
                    $(document).ready(function() {
                         var msg='{/literal}{$msg}{literal}';
                         if(msg!= '' && msg != undefined)
                         alert(msg);
                    });
                    </script>
                    {/literal*}
                    {/if}
     <form name="frmadd" id="frmadd" action="{$SITE_URL}index.php?file=sm-editprofile_a" method="post">
     <input type="hidden" name="iSMID" id="iSMID"value="{$iSMID}" />
     <table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
          <tr>
               <td width="140">{$LBL_USER_NAME}  </td>
               <td>:</td>
               <td><strong>{$smdata[0].vUserName}</strong></td>
          </tr>
          <tr>
               <td>{$LBL_FIRST_NAME}&nbsp;<font class="reqmsg">*</font> </td>
               <td>:</td>
               <td><input type="text" name="Data[vFirstName]" class="input-rag required" id="vFirstName" onkeypress="return chkValidChar(event);" title="Enter first name" Maxlength=20 value="{$smdata[0].vFirstName}" tabindex="1"/></td>
          </tr>
          <tr>
               <td>{$LBL_LAST_NAME}&nbsp;<font class="reqmsg">*</font> </td>
               <td>:</td>
               <td><input type="text" name="Data[vLastName]" class="input-rag required" id="vLastName"  onkeypress="return chkValidChar(event);"  title="Enter last name" Maxlength=20 value="{$smdata[0].vLastName}" tabindex="2"/></td>
          </tr>
          <tr>
               <td>{$LBL_EMAIL}&nbsp;<font class="reqmsg">*</font> </td>
               <td>:</td>
               <td><input type="text" name="Data[vEmail]" class="input-rag required email" id="vEmail"  Maxlength="50" onkeypress='return chkSpace(event);' value="{$smdata[0].vEmail}" tabindex="3"/></td>
          </tr>
           <tr>
               <td>{$LBL_ADDR_LINE} 1&nbsp;<font class="reqmsg">*</font> </td>
               <td>:</td>
               <td><input type="text" name="Data[vAddressLine1]" class="input-rag required" id="vAddressLine1"  oncontextmenu='return false;' title="Enter Address Line1" Maxlength="40" value="{$smdata[0].vAddressLine1}" tabindex="4"/></td>
          </tr>
          <tr>
               <td>{$LBL_ADDR_LINE} 2 </td>
               <td>:</td>
               <td><input type="text" name="Data[vAddressLine2]" class="input-rag" id="vAddressLine2"  oncontextmenu='return false;' Maxlength="40" value="{$smdata[0].vAddressLine2}" tabindex="5"/></td>
          </tr>
          <tr>
               <td>{$LBL_ADDR_LINE} 3 </td>
               <td>:</td>
               <td><input type="text" name="Data[vAddressLine3]" class="input-rag" id="vAddressLine3"  oncontextmenu='return false;' Maxlength="40" value="{$smdata[0].vAddressLine3}" tabindex="6"/></td>
          </tr>
          <tr>
               <td>{$LBL_COUNTRY}&nbsp;<font class="reqmsg">*</font> </td>
               <td>:</td>
               <td>
                    <select name ="Data[vCountry]" id="vCountry" class="required" title="Select Country" style="width:218px" tabindex="7" onchange="getRelativeCombo(this.value,'','vState','-- Select State --',stateArr);">
                        <option value=""> --- Select Country --- </option>
                        {section name=i loop=$db_country}
                              <option value="{$db_country[i].vCountryCode}" {if $smdata[0].vCountry eq $db_country[i].vCountryCode} selected {/if} >{$db_country[i].vCountry}</option>
                        {/section}
                    </select>
               </td>
          </tr>
          <tr>
               <td>{$LBL_STATE}&nbsp;<font class="reqmsg">*</font> </td>
               <td>:</td>
               <td>
                    <input type="hidden" name="selstate" id="selstate" value="{$smdata[0].vState}">
                    <select name ="Data[vState]" id="vState" style="width:218px" tabindex="8" class="required" title="Select State">
                           <option value="">Select State</option>
                        </select>
          </tr>
          <tr>
               <td>{$LBL_CITY}&nbsp;<font class="reqmsg">*</font> </td>
               <td>:</td>
               <td><input type="text" name="Data[vCity]" class="input-rag required" id="vCity"  onkeypress='return chkValidChar(event);' title="Enter city" Maxlength=30 value="{$smdata[0].vCity}" tabindex="9"/></td>
          </tr>
          <tr>
               <td>{$LBL_ZIP_CODE}&nbsp;<font class="reqmsg">*</font> </td>
               <td>:</td>
               <td><input type="text" name="Data[vZipcode]" class="input-rag required digits" id="vZipcode"  maxlength=5" value="{$smdata[0].vZipcode}" tabindex="10"/></td>
          </tr>
           <tr>
               <td>{$LBL_ONLINE_EMAIL_NOTIFICATION}&nbsp;<font class="reqmsg"></font> </td>
               <td>:</td>
               <td>

                    { if $smdata[0].eEmailNotification eq 'Yes'}
                         { assign var='email' value='checked'}
                    {/if}

                    <input type="checkbox" tabindex="11" id="eEmailNotificationNo" value="Yes" name="Data[eEmailNotification]" {$email} >
               </td>
          </tr>
           <tr>
               <td>{$LBL_Default_Language}&nbsp;<font class="reqmsg"></font> </td>
               <td>:</td>
               <td>
                    <select name="Data[vDefaltLan]"  tabindex="12">
								{section name=i loop=$res}
								<option {if $smdata[0].vDefaltLan eq $res[i].vLanguageCode} selected {/if} value="{$res[i].vLanguageCode}">{$res[i].vLanguage}</option>
								{/section}
                    </select>
               </td>
          </tr>
          <tr>
             <td colspan="2" height="5"></td>
          </tr>
          <tr>
             <td>&nbsp;</td>
             <td colspan="2"><img id="btnSubmit" name="Submit" title="submit" src="{$SITE_IMAGES}sm_images/btn-submit.gif" alt="" onclick="$('#frmadd').submit();" style="cursor:pointer;border: none; vertical-align:middle;background: #f8f8f8;" tabIndex="13"/> &nbsp; <input type="image" src="{$SITE_IMAGES}sm_images/btn-reset.gif" alt="" border="0" onclick="resetform();return false;" style="cursor:pointer; vertical-align:middle;border:none;background: #f8f8f8;" tabIndex="14"/> &nbsp; <a href="#"><input type="image" src="{$SITE_IMAGES}sm_images/btn-cancel.gif" alt="" style="cursor:pointer; vertical-align:middle;border:none;background: #f8f8f8;" tabIndex="15"/></a></td>
          </tr>
     </table>
     </form>
   </div>
   <div>&nbsp;</div>
   </div>
   </div>
   </div>
<input type="hidden" name="m" id="m" value="" />
</div>
{literal}
<script type="text/javascript">

getRelativeCombo($('#vCountry').val(),"{/literal}{$smdata[0].vState}{literal}",'vState','-- Select State --',stateArr);

function resetform()
{
	$('#frmadd')[0].reset();
     getRelativeCombo($('#vCountry').val(),"{/literal}{$smdata[0].vState}{literal}",'vState','-- Select State --',stateArr);
}

$("#frmadd").validate({
	/*rules:{
			"Data[vEmail]": {
               remote:{
                    url:SITE_URL+"index.php?file=sm-aj_chkdupdata",
                    type:"get",
                    data:{
                         val:function() {
									return $("#iSMID").val();
								},
								id:function() {
									return "iSMID";
								},
								field:function() {
									return "vEmail";
								},
								table:function() {
									return "{/literal}{$PRJ_DB_PREFIX}{literal}_security_manager";
								}
						}
				}
			}
	},*/
   messages:{
		"Data[vEmail]": {
			required: 'Enter Email Address',
			email: "Please enter a valid email address, example: you@yourdomain.com",
			remote: jQuery.validator.format("This email is already taken, please enter a different address.")
		},
		"Data[vZip]": {required: 'Enter Zip Code'}
	}
});
</script>
{/literal}

{if $msg neq ''}
{literal}
<script>
$(document).ready(function() {
	var msg='{/literal}{$msg}{literal}';
	if(msg!= '' && msg != undefined && $('#m').val()!=msg) {
		alert(msg);
		$('#m').val(msg);
	}
});
</script>
{/literal}
{/if}