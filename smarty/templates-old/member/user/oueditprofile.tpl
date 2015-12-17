<script type="text/javascript" src="{$S_JQUERY}jquery.validate.js"></script>
{literal}
<script type="text/javascript" >
	var stateArr = new Array({/literal}{$stateArr}{literal});
     var groupArr = new Array({/literal}{$groupArr}{literal});
     //alert(stateArr);
</script>
{/literal}
<div class="middle-container">
<h1>{$LBL_EDIT} {$LBL_PROFILE}</h1>
<div class="middle-containt">
   <div class="statistics-main-box-white">
      <div>
         <ul id="inner-tab">
			   <li><a class="current"><EM>{$LBL_PROFILE_INFO}</EM></a></li>
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
            <form name="frmadd" id="frmadd" action="{$SITE_URL}index.php?file=u-oueditprofile_a" method="post">
               <input type="hidden" name="iUserID" id="iUserID"value="{$iUserID}" />
               <table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
                    <tr>
                       <td width="205">{$LBL_USER_NAME} </td>
                       <td>:</td>
                       <td>{$userData.vUserName}</td>

                    </tr>
               <tr>
                  <td width="205">{$LBL_FIRST_NAME}&nbsp;<font class="reqmsg">*</font> </td>
                  <td>:</td>
                  <td><input type="text" name="Data[vFirstName]" class="input-rag required" onkeypress="return chkValidChar(event);" title="Enter First Name" id="vFirstname" style="width:228px;" tabindex="1" value="{$userData.vFirstName}"/></td>
               </tr>
               <tr>
                  <td>{$LBL_LAST_NAME}&nbsp;<font class="reqmsg">*</font> </td>
                  <td>:</td>
                  <td><input value="{$userData.vLastName}" type="text" name="Data[vLastName]" class="input-rag required" onkeypress="return chkValidChar(event);"  title="Enter last name" id="vLastName" style="width:228px;" tabindex="2"/></td>
               </tr>
               <tr>
                  <td>Salutation </td>
                  <td>:</td>
                  <td>
							{*}<input type="text" value="{$userData.vSalutation}" name="Data[vSalutation]" class="input-rag" id="vSalutation" style="width:228px;" tabindex="3"/>{*}
							{$salutation}
						</td>
               </tr>
					<tr>
                  <td>{$LBL_ORGANIZATION}&nbsp;<font class="reqmsg">*</font> </td>
                  <td>:</td>
                  <td>
                         <input type="hidden" name="Data[iOrganizationID]" id="iOrganizationID" value="{$userData.iOrganizationID}" title="{$MSG_SELECT_ORGANIZATION}"/>
                         <input type="text" tabindex="4" name="vOrg" id="vOrg" value="{$orgdtls[0].vCompanyName}" class="input-rag required"  title="{$MSG_SELECT_ORGANIZATION}"/>
                  </td>
               </tr>
               <tr>
                  <td> {$LBL_ADDR_LINE} 1&nbsp;<font class="reqmsg">*</font> </td>
                  <td>:</td>
                  <td><input type="text" value="{$userData.vAddressLine1}" name="Data[vAddressLine1]" class="input-rag required" title="Enter Address Line1" id="vAddressLine1" style="width:228px;" tabindex="4"/></td>
               </tr>
               <tr>
                  <td>{$LBL_ADDR_LINE} 2 </td>
                  <td>:</td>
                  <td><input type="text" name="Data[vAddressLine2]"  value="{$userData.vAddressLine2}" class="input-rag" id="vAddressLine2" style="width:228px;" tabindex="5"/></td>
               </tr>
               <tr>
                  <td> {$LBL_ADDR_LINE} 3 </td>
                  <td>:</td>
                  <td><input type="text" name="Data[vAddressLine3]" class="input-rag"  value="{$userData.vAddressLine3}" id="vAddressLine3" style="width:228px;" tabindex="6"/></td>
               </tr>
               <tr>
                    <td>{$LBL_COUNTRY}&nbsp;</td>
                    <td>:</td>
                    <td>
                         <select name ="Data[vCountry]" id="vCountry" class="required"   title="Select Country" style="width:218px" tabindex="7" onchange="getRelativeCombo(this.value,'','vState','-- Select State --',stateArr);">
                             <option value=""> --- Select Country --- </option>
                             {section name=i loop=$db_country}
                                   <option value="{$db_country[i].vCountryCode}" {if $userData.vCountry eq $db_country[i].vCountryCode} selected {/if} >{$db_country[i].vCountry}</option>
                             {/section}
                         </select>
                    </td>
               </tr>
               <tr>
                    <td>{$LBL_STATE}&nbsp; </td>
                    <td>:</td>
                    <td>
                         <input type="hidden" name="selstate" id="selstate" value="{$userData.vState}">
                         <select name ="Data[vState]" id="vState" style="width:218px" tabindex="8" class="required" title="Select State">
                                <option value="">Select State</option>
                        </select>
                    </td>
               </tr>

               <tr>
                  <td>{$LBL_CITY}&nbsp;<font class="reqmsg">*</font> </td>
                  <td>:</td>
                  <td><input type="text" name="Data[vCity]" value="{$userData.vCity}"  class="input-rag required" onkeypress='return chkValidChar(event);' title="Enter City" id="vCity" style="width:228px;" tabindex="9"/></td>
               </tr>
               <tr>
                  <td>{$LBL_ZIP_CODE}&nbsp;<font class="reqmsg">*</font> </td>
                  <td>:</td>
                  <td><input type="text" name="Data[vZipCode]" value="{$userData.vZipCode}"  class="input-rag required" title="Enter Zip Code" onkeypress="return chkDigitZipcode(event)" id="vZipCode" style="width:107px;" tabindex="10"/></td>
               </tr>
               <!--<tr>
                  <td>{$LBL_PHONE} </td>
                  <td>:</td>
                  <td><input type="text" name="Data[vPhone]"  value="{$userData.vPhone}" class="input-rag" id="vPhone" onkeypress="return chkValidPhone(event)" style="width:228px;" tabindex="11"/></td>
               </tr>-->
               <tr>
                  <td>{$LBL_PHONE} </td>
                  <td>:</td>
                  <td> <input type="text" name="vPhoneCode"  value="{$userData.vPhoneCode}" class="countryCode input-rag" id="vPhoneCode" style="width:30px;" maxlength="3" onkeypress="return chkValidPhone(event)" tabindex="11"/>
                       <input type="text" name="Data[vPhone]"  value="{$userData.vPhone}" class="input-rag" id="vPhone" onkeypress="return chkValidPhone(event)" style="width:190px;" maxlength="15" tabindex="11"/>
                  </td>
               </tr>
               <tr>
                  <td>{$LBL_EXTENTION} </td>
                  <td>:</td>
                  <td><input type="text" name="Data[vExtention]" value="{$userData.vExtention}"  class="input-rag" id="vExtention" style="width:107px;" tabindex="12"/></td>
               </tr>
               <!--<tr>
                  <td>{$LBL_MOBILE} </td>
                  <td>:</td>
                  <td><input type="text" name="Data[vMobile]" class="input-rag"  value="{$userData.vMobile}" id="vMobile" style="width:228px;" onkeypress="return chkValidPhone(event)" tabindex="13"/></td>
               </tr>-->
               <tr>
                  <td>{$LBL_MOBILE} </td>
                  <td>:</td>
                  <td>
                       <input type="text" name="vMobileCode" class="countryCode input-rag"  value="{$userData.vMobileCode}" id="vMobileCode" style="width:30px;" onkeypress="return chkValidPhone(event)" maxlength="3" tabindex="13"/>
                       <input type="text" name="Data[vMobile]" class="input-rag"  value="{$userData.vMobile}" id="vMobile" style="width:190px;" onkeypress="return chkValidPhone(event)" maxlength="15" tabindex="13"/>
                  </td>
               </tr>
               <tr>
                  <td>{$LBL_EMAIL}&nbsp;<font class="reqmsg">*</font> </td>
                  <td>:</td>
                  <td><input type="text" name="Data[vEmail]"  value="{$userData.vEmail}" class="input-rag required email" title="Enter Email Address"onkeypress='return chkSpace(event);' id="vEmail" style="width:228px;" tabindex="14"/></td>
               </tr>
               <tr>
                  <td>{$LBL_SEC_QUESTION}1ID&nbsp;<font class="reqmsg">*</font> </td>
                  <td>:</td>
                  <td>{$secQuestion1}
                      <!-- <input type="text" name="Data[iSecretQuestion1ID]" class="input-rag required " title="Enter Secret QuestionId" id="iSecretQuestion1ID" style="width:228px;" /></td>-->
               </tr>
               <tr>
                  <td>{$LBL_ANSWER}&nbsp;<font class="reqmsg">*</font> </td>
                  <td>:</td>
                  <td><input type="text" name="Data[vAnswer]" value="{$userData.vAnswer}"  class="input-rag required" title="Enter Answer" id="vAnswer" style="width:228px;" tabindex="19" /></td>
               </tr>
               <tr>
                  <td>{$LBL_SEC_QUESTION}2ID </td>
                  <td>:</td>
                  <td>
                    {$secQuestion2}
                    <!--<input type="text" name="Data[iSecretQuestion2ID]" class="input-rag" id="textfield18" style="width:228px;" /> -->
                  </td>
               </tr>
               <tr>
                  <td>{$LBL_ANSWER} </td>
                  <td>:</td>
                  <td><input type="text" name="Data[vAnwser]"  value="{$userData.vAnwser}" class="input-rag" id="vAnwser" style="width:228px;" tabindex="21"/></td>
               </tr>
               <!--
               <tr id="trPermission">
                  <td>{$LBL_PER_TYPE} </td>
                  <td>:</td>
                  <td><input type="radio" checked name="Data[ePermissionType]"
                             {if $userData.ePermissionType eq 'Individual'}checked{/if}
                             id="ePermissionType1" value="Individual" onclick="showHideGroup('')"
                             class="radib-btn " style="vertical-align:sub;" tabindex="22"/>&nbsp;
                       {$LBL_INDIVIDUAL} &nbsp;
                       <input type="radio"   class="radib-btn" name="Data[ePermissionType]"
                       {if $userData.ePermissionType eq 'Group'}checked{/if}
                       id="ePermissionType2" value="Group"  onclick="return grpclk();"
                       style="vertical-align:sub;" tabindex="23"/>&nbsp;{$LBL_GROUP} </td>
               </tr>
               <tr id="trGroupList">
                    <td valign="top">{$LBL_GROUP_ID} &nbsp;<font class="reqmsg">*</font>  </td>
                    <td>:</td>
                  <td>
                       <select  name="Data[iGroupID]" id="iGroupID" tabindex="24"  value="{$userData.iGroupID}" title="Select Group" style="width:200px" ></select>
                  </td>
               </tr>
               -->
               <tr>
                    <td>{$LBL_ONLINE_EMAIL_NOTIFICATION}&nbsp;<font class="reqmsg"></font> </td>
                    <td>:</td>
                    <td>
                         <!-- <select name="Data[eEmailNotification]">
                               <option {if $smdata[0].eEmailNotification eq 'No'}selected{/if}>No</option>
                              <option {if $smdata[0].eEmailNotification eq 'Yes'}selected{/if} >Yes</option>
                         </select> -->
                    { if $userData.eEmailNotification eq 'Yes'}
                         { assign var='email' value='checked'}
                    {/if}

                    <input type="checkbox"  id="eEmailNotification" value="Yes" name="Data[eEmailNotification]" {$email}>

                    </td>
               </tr>
               <tr>
                    <td>{$LBL_Default_Language}&nbsp;<font class="reqmsg"></font> </td>
                    <td>:</td>
                    <td>
                         <select name="Data[vDefaltLan]">
                               {section name=i loop=$res}
                               <option {if $userData.vDefaltLan eq $res[i].vLanguageCode} selected {/if} value="{$res[i].vLanguageCode}">{$res[i].vLanguage}</option>
                               {/section}
                         </select>
                    </td>
               </tr>
               <tr>
                  <td colspan="2" height="5"></td>
               </tr>
               <tr>
                  <td>&nbsp;</td>
                  <td colspan="2" >
                       <img id="btnSubmit" name="Submit" title="submit" src="{$SITE_IMAGES}sm_images/btn-submit.gif" alt="" onclick="submitform()" style="background: #f8f8f8;cursor:pointer; vertical-align:middle;border:none;" tabindex="25" /> &nbsp;
                       <img tabindex="26" src="{$SITE_IMAGES}sm_images/btn-reset.gif" alt="" style="background: #f8f8f8;cursor: pointer;border:none; vertical-align:middle;" onclick="resetform();return false;"/> &nbsp;
                       <img src="{$SITE_IMAGES}sm_images/btn-cancel.gif" tabindex="27" alt=""  style="background: #f8f8f8;cursor: pointer;border:none; vertical-align:middle;" {if $view eq 'edit'}onClick="window.location=SITE_URL+'index.php?file=u-organizationuserlist';"{else}onClick="window.location=SITE_URL+'index.php?file=u-organizationuser';"{/if}/>
                  </td>
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
<script language="JavaScript" src="{$S_JQUERY}jquery.autocomplete.js"></script>
<link type="text/css" rel="stylesheet" media="screen" href="{$SITE_CSS}jquery.autocomplete.css" />
{literal}
<script type="text/javascript">
showHidePermission("{/literal}{$userData.eUserType}{literal}")

/*
function orgchng() {
     if($("#vOrg").val() != '' && $("#ePermissionType2").is(':checked')) {
          showHideGroup('Group');

     }
     //getRelativeCombo($('#iOrganizationID').val(),"{/literal}{$userData.iGroupID}{literal}",'iGroupID','-- Select Group --',groupArr);

}*/


getRelativeCombo($('#vCountry').val(),"{/literal}{$userData.vState}{literal}",'vState','-- Select State --',stateArr);

function submitform()
{
	$('#frmadd')[0].submit();
}
function resetform()
{
	$('#frmadd')[0].reset();
     getRelativeCombo($('#vCountry').val(),"{/literal}{$userData.vState}{literal}",'vState','-- Select State --',stateArr);
}

function grpclk()
{
     if($("#vOrg").val() == '') {
          alert("Select Organization First");
          $('#ePermissionType1').attr("checked",true);
          return false;
     } else {
          showHideGroup('Group');
     }
}
$("#frmadd").validate({
	rules:{
			"Data[vEmail]": {
               remote:{
                    url:SITE_URL+"index.php?file=u-aj_chkdupdata",
                    type:"get",
                    data:{
                         val:function() {
									return $("#iUserID").val();
								},
								id:function() {
									return "iUserID";
								},
								field:function() {
									return "vEmail";
								},
								table:function() {
									return "{/literal}{$PRJ_DB_PREFIX}{literal}_organization_user";
								}
						}
				}
			},
               "Data[vUserName]": {
               remote:{
                    url:SITE_URL+"index.php?file=u-aj_chkdupdata",
                    type:"get",
                    data:{
                         val:function() {
									return $("#iUserID").val();
								},
								id:function() {
									return "iUserID";
								},
								field:function() {
									return "vUserName";
								},
								table:function() {
									return "{/literal}{$PRJ_DB_PREFIX}{literal}_organization_user";
								}
						}
				}
			}
	},
   messages:{
		"Data[vEmail]": {
			required: 'Enter Email Address',
			email: "Please enter a valid email address, example: you@yourdomain.com",
			remote: jQuery.validator.format("This email is already taken, please enter a different address.")
		},
          "Data[vUserName]": {
			required: 'Enter User Name',
			remote: jQuery.validator.format("This User Name is already taken, please enter a different User Name.")
		},
		"Data[vZip]": {required: 'Enter Zip Code'},
          "Data[vPassword]": {minlength: 'Atleast five characters required'}
	}
});
function showHideGroup(val)
{
     if(val == 'Group'){
          $('#trGroupList').show();
          $('#iGroupID').addClass('required');
     }
     else{
          $('#iGroupID').removeClass('required');
          $('#trGroupList').hide();
     }
}
function showHidePermission(val)
{
     if(val == 'Admin')
     {
          $('#trPermission').hide();
          $('#trGroupList').hide();
     }
     else
     {
          $('#trPermission').show()
          $('#ePermissionType1').attr("checked",true);

     }


}
function findOrgValue(li) {
   if( li == null ) return alert("No match!");
   if( !!li.extra ) var sValue = li.extra[0];
	else var sValue = li.selectValue;
   // Coded BY SNEHASIS [TO GET ID OF A DATA]
   var totVal = sValue;
   var totValID;
   var totValRes;
   totVal = totVal.split('</span>');
   totValID = totVal[0].replace("<span style='display:none'>","");
   // totValRes = totVal[1];
   $('#iOrganizationID').val(totValID);
   //getRelativeCombo($('#iOrganizationID').val(),"{/literal}{$userData.iGroupID}{literal}",'iGroupID','-- Select Group --',groupArr);
   $('#OrgStatus_Div').load(SITE_URL+"index.php?file=or-aj_getOrganizationStatus&type=user&iId="+totValID+"");
}
function selectOrgItem(li) {
	findOrgValue(li);
}
function formatItem(row) {
   var totVal = row[0];
   var totValID;
   var totValRes;
   totVal = totVal.split('</span>');
   totValID = totVal[0].replace("<span style='display:none'>");
   totValRes = totVal[1];
   return totValRes;
}
$(document).ready(function() {
	$("#vOrg").autocomplete(
		SITE_URL+"index.php?file=or-aj_getOrganization",
		{
			delay:10,
			minChars:1,
			matchSubset:1,
			matchContains:1,
			cacheLength:10,
         onItemSelect:selectOrgItem,
			onFindValue:findOrgValue,
			formatItem:formatItem,
			autoFill:false
		});

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