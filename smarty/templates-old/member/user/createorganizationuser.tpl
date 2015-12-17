{literal}
<script type="text/javascript">
	var stateArr = new Array({/literal}{$stateArr}{literal});
   var groupArr = new Array({/literal}{$groupArr}{literal});
   //alert(stateArr);
</script>
{/literal}
<div class="middle-container">
<h1>{$LBL_CREATE} {$LBL_USER}</h1>
<div class="middle-containt">
   <div class="statistics-main-box-white">
      <div>
         <ul id="inner-tab">
			   <li><a class="current"><em>{$LBL_ORGANIZATION} {$LBL_USER}</EM></a></li>
				{if ($view eq 'edit' && $userData.eUserType eq 'User') || $smarty.session.from eq 'usr'}
				<li><a href="{$SITE_URL_DUM}edituserrights/{$userData.iUserID}" class="{if $file eq 'u-userrights'}current{/if}"><EM>{$LBL_ORG_USER_ACCESS_RIGHTS}</EM></a></li>
				{/if}
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
            <form name="frmadd" id="frmadd" action="{$SITE_URL}index.php?file=u-createorganizationuser_a"  method="post">
               <input type="hidden" name="iUserID" id="iUserID"value="{$iUserID}" />
               {if $userData.iOrganizationID neq ''}
                    <input type="hidden" name="iOrgId" id="iOrgId" value="{$userData.iOrganizationID}" />
               {/if}
               <input type="hidden" name="view" id="view" value="{$view}" />
               <table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
              {if $usertype eq 'securitymanager' && $userData.iOrganizationID eq ''}
               <tr>
                   <td>{$LBL_FILTRE_ORG_BY}</td>
                    <td>:</td>
                   <td colspan="" align="" height="20" style="padding-left: 4px;">
									Company Reg No &nbsp;
                           Organization Code &nbsp;
                           Organization name &nbsp;
								 </td>
							  </tr>
                 <tr>
                     <td>&nbsp;</td>
                      <td>&nbsp;</td>
                     <td colspan="3" height="30" valign="top">
									<input type="text" style="width: 100px; vertical-align: middle;" id="regno" class="input-rag" value="" name="regno"> &nbsp;
									<input type="text" style="width: 100px; vertical-align: middle;" id="orgcode" class="input-rag valid" value="" name="orgcode"> &nbsp;
									<input type="text" style="width: 100px; vertical-align: middle;" id="orgname" class="input-rag" value="" name="orgname">
									<img src="{$SITE_IMAGES}sm_images/btn-search.gif" alt="" border="0" style="cursor: pointer;vertical-align:middle;background: #f8f8f8;border:none;" onclick="getOrgCombo();" />
								 </td>
							  </tr>
                <tr>
                  <td>{$LBL_ORGANIZATION}&nbsp;<font class="reqmsg">*</font></td>
                  <td>:</td>
                  <td>
							{*if $orgdetails[0].iOrganizationID neq ''}
								{$orgdetails[0].vCompanyName}
						  	<input type="hidden" name="Data[iOrganizationID]" id="iOrganizationID" class="input-rag required" value="{$orgdetails[0].iOrganizationID}" title="{$MSG_SELECT_ORGANIZATION}"/>
							{else}
                           <input type="text" tabindex="5" name="vOrg" id="vOrg" value="{$orgdetails[0].vCompanyName}" class="input-rag" title="{$MSG_SELECT_ORGANIZATION}"/>
                           <input type="hidden" name="Data[iOrganizationID]" id="iOrganizationID"   value="{$userData.iOrganizationID}" class="required" title="{$MSG_SELECT_ORGANIZATION}"/>
							{/if*}
							{*}{$organization}{*}
							<div id="OrgCombo">
								<select name="Data[iOrganizationID]" id="iOrganizationID" class="required" title="{$MSG_SELECT_ORGANIZATION}" onchange="return fillCompData(this.options[this.selectedIndex].value);" >
									 <option value=''>---{$MSG_SELECT_ORGANIZATION}---</option>
									 {if $orgdetails[0].vCompanyName|trim neq ''}
									 <option value="{$orgdetails[0].iOrganizationID}" selected="selected">{$orgdetails[0].vCompanyName}</option>
									 {/if}
								</select> ({$LBL_SEARCH_TO_FILL_ORG})
							</div>
						</td>
            </tr>
          {else}
              <tr>
                  <td>{$LBL_ORGANIZATION}&nbsp;<font class="reqmsg"></font></td>
                  <td>:</td>
                  <td>
						  	<input type="hidden" name="Data[iOrganizationID]" id="iOrganizationID" value="{$orgdetails[0].iOrganizationID}" title="{$MSG_SELECT_ORGANIZATION}"/>
							<input type="text" name="vOrg" readonly="readonly" id="vOrg" value="{$orgdetails[0].vCompanyName}" class="input-rag" title="{$MSG_SELECT_ORGANIZATION}" />
                  </td>
              </tr>
					{/if}
               <tr>
                  <td>{$LBL_USER_TYPE}&nbsp; </td>
                  <td>:</td>
                  <td>{$userTypes}
                  <!-- <input type="text" name="Data[iSecretQuestion1ID]" class="input-rag required " title="Enter Secret QuestionId" id="iSecretQuestion1ID" style="width:228px;" /></td>-->
               </tr>

               <tr>
                  <td width="205">{$LBL_FIRST_NAME}&nbsp;<font class="reqmsg">*</font> </td>
                  <td>:</td>
                  <td><input type="text" name="Data[vFirstName]" class="input-rag required" onkeypress="return chkValidChar(event);" title="{$LBL_ENTER_FIRST_NAME}" id="vFirstname" style="width:228px;" value="{$userData.vFirstName}"/></td>
               </tr>
               <tr>
                  <td>{$LBL_LAST_NAME}&nbsp;<font class="reqmsg">*</font> </td>
                  <td>:</td>
                  <td><input value="{$userData.vLastName}" type="text" name="Data[vLastName]" class="input-rag required" onkeypress="return chkValidChar(event);"  title="{$LBL_ENTER_LAST_NAME}" id="vLastName" style="width:228px;" /></td>
               </tr>
               <tr>
                  <td>Salutation </td>
                  <td>:</td>
                  <td>
							{$salutation}
							{*}<input type="text" value="{$userData.vSalutation}" name="Data[vSalutation]" class="input-rag" id="vSalutation" style="width:228px;" tabindex="4"/>{*}
						</td>
               </tr>
					<tr>
                  <td>{$LBL_USER_NAME} <font class="reqmsg">*</font></td>
                  <td>:</td>
                  <td><input type="text" name="Data[vUserName]"  value="{$userData.vUserName}" class="input-rag required" id="vUserName" title="{$LBL_ENTER_USER_NAME}" style="width:228px;" onkeypress="return chkalphanum(event);" /></td>
               </tr>
               <tr>
                  <td>{$LBL_PASSWORD}&nbsp;<font class="reqmsg">*</font> </td>
                  <td>:</td>
                  <td>
							<input type="password" name="Data[vPassword]"  value="{$generalobj->decrypt($userData.vPassword)}" class="input-rag required" id="vPassword" title="{$LBL_ENTER_PASSWORD}" style="width:228px;" minlength="5" />
							<span class="" style="position:absolute; font-size:10px; margin-left:10px;">{$LBL_PASSWORD_STRENGTH}<span id="pst"></span><div id="psi" class="is0" style=""></div></span>
							<div htmlfor="vPassword" generated="true" class="err" style="padding-left:0px;"></div>
						</td>
               </tr>
					<tr>
                  <td>{$LBL_CONFIRM_PASSWORD}&nbsp;<font class="reqmsg">*</font> </td>
                  <td>:</td>
                  <td><input type="password" name="cPassword"  value="{$generalobj->decrypt($userData.vPassword)}" class="input-rag required" id="cPassword" equalTo="#vPassword" title="{$LBL_ENTER_PASSWORD}" style="width:228px;" minlength="5" /></td>
               </tr>
               <tr>
                  <td> {$LBL_ADDR_LINE} 1&nbsp;<font class="reqmsg">*</font> </td>
                  <td>:</td>
                  <td><input type="text" value="{$userData.vAddressLine1}" name="Data[vAddressLine1]" class="input-rag required" title="Enter Address Line1" id="vAddressLine1" style="width:228px;" /></td>
               </tr>
               <tr>
                  <td>{$LBL_ADDR_LINE} 2 </td>
                  <td>:</td>
                  <td><input type="text" name="Data[vAddressLine2]"  value="{if $userData.vAddressLine2 neq ''}{$userData.vAddressLine2}{else}{$orgdetails[0].vAddressLine2}{/if}" class="input-rag" id="vAddressLine2" style="width:228px;" /></td>
               </tr>
               <tr>
                  <td> {$LBL_ADDR_LINE} 3 </td>
                  <td>:</td>
                  <td><input type="text" name="Data[vAddressLine3]" class="input-rag"  value="{if $userData.vAddressLine3 neq ''}{$userData.vAddressLine3}{else}{$orgdetails[0].vAddressLine3}{/if}" id="vAddressLine3" style="width:228px;" /></td>
               </tr>
               <tr>
                    <td>{$LBL_COUNTRY}&nbsp;<font class="reqmsg">*</font> </td>
                    <td>:</td>
                    <td>
                         <select name ="Data[vCountry]" id="vCountry" class="required"   title="Select Country" style="width:218px" onchange="getRelativeCombo(this.value,'','vState','-- Select State --',stateArr);fillCountryCode(this);">
                             <option value=""> --- Select Country --- </option>
                             {section name=i loop=$db_country}
                                   <option title="{if $db_country[i].iCountryISD gt 0}{$db_country[i].iCountryISD}{/if}" value="{$db_country[i].vCountryCode}" {if $userData.vCountry eq $db_country[i].vCountryCode} selected {/if} >{$db_country[i].vCountry}</option>
                             {/section}
                         </select>
                    </td>
               </tr>
               <tr>
                    <td>{$LBL_STATE}&nbsp;<font class="reqmsg">*</font> </td>
                    <td>:</td>
                    <td>
                         <input type="hidden" name="selstate" id="selstate" value="{$userData.vState}">
                         <select name ="Data[vState]" id="vState" style="width:218px" class="required" title="Select State">
                                <option value="">Select State</option>
                        </select>
                    </td>
               </tr>

               <tr>
                  <td>{$LBL_CITY}&nbsp;<font class="reqmsg">*</font> </td>
                  <td>:</td>
                  <td><input type="text" name="Data[vCity]" value="{$userData.vCity}"  class="input-rag required" onkeypress='return chkValidChar(event);' title="Enter City" id="vCity" style="width:228px;" /></td>
               </tr>
               <tr>
                  <td>{$LBL_ZIP_CODE}&nbsp;<font class="reqmsg">*</font> </td>
                  <td>:</td>
                  <td><input type="text" name="Data[vZipCode]" value="{$userData.vZipCode}"  class="input-rag required" title="{$LBL_ZIPCODE}" onkeypress="return chkDigitZipcode(event)" id="vZipCode" style="width:107px;" /></td>
               </tr>
               <tr>
                  <td>{$LBL_PHONE} </td>
                  <td>:</td>
                  <td> <input type="text" name="vPhoneCode"  value="{$userData.vPhoneCode}" class="countryCode input-rag" id="vPhoneCode" style="width:30px;" maxlength="3" onkeypress="return chkValidPhone(event)" />
                       <input type="text" name="Data[vPhone]"  value="{$userData.vPhone}" class="input-rag" id="vPhone" onkeypress="return chkValidPhone(event)" style="width:190px;" maxlength="15" />
                  </td>
               </tr>
               <tr>
                  <td>{$LBL_EXTENTION} </td>
                  <td>:</td>
                  <td><input type="text" name="Data[vExtention]" value="{$userData.vExtention}"  class="input-rag" id="vExtention" style="width:107px;" /></td>
               </tr>
               <tr>
                  <td>{$LBL_MOBILE} </td>
                  <td>:</td>
                  <td>
                       <input type="text" name="vMobileCode" class="countryCode input-rag"  value="{$userData.vMobileCode}" id="vMobileCode" style="width:30px;" onkeypress="return chkValidPhone(event)" maxlength="3" />
                       <input type="text" name="Data[vMobile]" class="input-rag"  value="{$userData.vMobile}" id="vMobile" style="width:190px;" onkeypress="return chkValidPhone(event)" maxlength="15" />
                  </td>
               </tr>
               <tr>
                  <td>{$LBL_EMAIL}&nbsp;<font class="reqmsg">*</font> </td>
                  <td>:</td>
                  <td><input type="text" name="Data[vEmail]"  value="{$userData.vEmail}" class="input-rag required email" title="Enter Email Address"onkeypress='return chkSpace(event);' id="vEmail" style="width:228px;" /></td>
               </tr>
               <tr>
                  <td>{$LBL_SEC_QUESTION}1&nbsp;<font class="reqmsg">*</font></td>
                  <td>:</td>
                  <td>{$secQuestion1}
                      <!-- <input type="text" name="Data[iSecretQuestion1ID]" class="input-rag required " title="Enter Secret QuestionId" id="iSecretQuestion1ID" style="width:228px;" /></td>-->
               </tr>
               <tr>
                  <td>{$LBL_ANSWER}&nbsp;<font class="reqmsg">*</font> </td>
                  <td>:</td>
                  <td>
							{if $userData.vAnswer|trim neq '' && $view eq 'edit'}{assign var="ans1" value="##########"}
							<input type="text" name="vAnswer" value="{$ans1}"  class="input-rag required" title="{$LBL_ENTER_ANSWER}" id="vAnswer" style="width:228px;"  readonly="readonly" />
							<a href="{$SITE_URL_DUM}changesecans/1/{$userData.iUserID}" class="colorbox" onmouseover="CallColoerBox(this.href,'500','300','file');"><img src="{$SITE_IMAGES}sm_images/icon-pen.gif" onclick="" title="{$LBL_EDIT_ANS}" /></a>
							{else}
							<input type="text" name="Data[vAnswer]" value=""  class="input-rag required" title="{$LBL_ENTER_ANSWER}" id="vAnswer" style="width:228px;" />
							{/if}
						</td>
               </tr>
               <tr>
                  <td>{$LBL_SEC_QUESTION}2 </td>
                  <td>:</td>
                  <td>
                    {$secQuestion2}
                    <!--<input type="text" name="Data[iSecretQuestion2ID]" class="input-rag" id="textfield18" style="width:228px;" /> -->
                  </td>
               </tr>
               <tr>
                  <td>{$LBL_ANSWER} </td>
                  <td>:</td>
                  <td>
							{if $userData.vAnwser|trim neq '' && $view eq 'edit'}{assign var="ans2" value="##########"}
							<input type="text" name="vAnwser"  value="{$ans2}" class="input-rag" id="vAnwser" style="width:228px;" title="{$LBL_ENTER_ANSWER}"  readonly="readonly" />
							{if $userData.iSecretQuestion2ID gt 0}<a href="{$SITE_URL_DUM}changesecans/2/{$userData.iUserID}" class="colorbox" onmouseover="CallColoerBox(this.href,'500','300','file');"><img src="{$SITE_IMAGES}sm_images/icon-pen.gif" onclick="" title="{$LBL_EDIT_ANS}" /></a>{/if}
							{else}
							<input type="text" name="Data[vAnwser]"  value="" title="{$LBL_ENTER_ANSWER}" class="input-rag" id="vAnwser" style="width:228px;" />
							{/if}
						</td>
               </tr>
               <tr id="trPermission">
                  <td>{$LBL_PER_TYPE} </td>
                  <td>:</td>
                  <td>
							<input type="radio" name="Data[ePermissionType]" {if $userData.ePermissionType eq 'Individual'}checked="checked"{/if} id="ePermissionType1" value="Individual" onclick="showHideGroup('')" class="radib-btn " style="vertical-align:sub;" />&nbsp;
                     {$LBL_INDIVIDUAL} &nbsp;
                     <input type="radio" class="radib-btn" name="Data[ePermissionType]" {if $userData.ePermissionType eq 'Group'}checked="checked"{/if} id="ePermissionType2" value="Group"  onclick="return grpclk();"  style="vertical-align:sub;" />
							&nbsp;{$LBL_GROUP}
						</td>
               </tr>
               <tr id="trGroupList">
                    <td valign="top">{$LBL_SELECT} {$LBL_GROUP} </td>
                    <td>:</td>
                  <td>
                     <select name="Data[iGroupID]" id="iGroupID"  value="{$userData.iGroupID}" title="{$LBL_SELECT_GROUP}" style="width:200px" ></select>
                  </td>
               </tr>
               <tr>
                    <td>{$LBL_ONLINE_EMAIL_NOTIFICATION}&nbsp;<font class="reqmsg"></font> </td>
                    <td>:</td>
                    <td>
                       {* if $smdata[0].eEmailNotification eq 'Yes'}
                         { assign var='email' value='checked'}
                    {/if*}
                    <input type="checkbox"  id="eEmailNotification" value="Yes" name="Data[eEmailNotification]" {if $userData.eEmailNotification eq 'Yes'}checked="checked"{/if} />
                    </td>
               </tr>
               <tr>
                    <td>{$LBL_DEFAULT_LANGUAGE}&nbsp;<font class="reqmsg"></font> </td>
                    <td>:</td>
                    <td>
                         <select name="Data[vDefaltLan]" >
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
                       <input type="hidden" name="dpr" id="dpr" value="nod" />
                       <img id="btnSubmit" name="Submit" title="submit" src="{$SITE_IMAGES}sm_images/btn-submit.gif" alt="" onclick="return submitform();" style="background: #f8f8f8;cursor:pointer; vertical-align:middle;border:none;"  /> &nbsp;
                       <img  src="{$SITE_IMAGES}sm_images/btn-reset.gif" alt="" style="background: #f8f8f8;cursor: pointer;border:none; vertical-align:middle;" onclick="resetform();return false;"/> &nbsp;
                       <img src="{$SITE_IMAGES}sm_images/btn-cancel.gif" alt=""  style="background: #f8f8f8;cursor: pointer;border:none; vertical-align:middle;" {if $view eq 'edit'}onClick="window.location=SITE_URL+'index.php?file=u-organizationuserlist';"{else}onClick="window.location=SITE_URL+'index.php?file=u-organizationuser';"{/if}/>
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
<input type="hidden" id="vldms" name="vldms" style="display:none;" value=""/>
</div>
<script type="text/javascript" src="{$S_JQUERY}jquery.validate.js"></script>
<script type="text/javascript" src="{$S_JQUERY}jquery.passwordstrength.js"></script>
<!--{*<link type="text/css" rel="stylesheet" media="screen" href="{$SITE_CSS}jquery.autocomplete.css" />
<script language="JavaScript" src="{$S_JQUERY}jquery.autocomplete.js"></script>*}-->
{literal}
<script type="text/javascript" async="async">
var id = '{/literal}{$orgdetails[0].iOrganizationID}{literal}';
// fillCompData(id);
var permitType = '{/literal}{$userData.ePermissionType}{literal}';
$('#trGroupList').hide();
showHidePermission("{/literal}{$userData.eUserType}{literal}")
/*
function orgchng() {
     if($("#vOrg").val() != '' && $("#ePermissionType2").is(':checked')) {
          showHideGroup('Group');
     }
     //getRelativeCombo($('#iOrganizationID').val(),"{/literal}{$userData.iGroupID}{literal}",'iGroupID','-- Select Group --',groupArr);

}*/

function fillCompData(id)
{
   if(id == '' || id == undefined)
		return ;
    //alert(id);return false;
	var totValID = id;
   var fields="all";
   var url = SITE_URL+"index.php?file=or-aj_getDetailsComp";
   var pars = "&table="+PRJ_DB_PREFIX+"_organization_master&id="+totValID+"&jtbl=&fields="+fields;
   //alert(url+pars); return false;
	$.post(url, pars, function(resp) {
		$('#spn').html('');
		$('#spn').append(resp);
		$(document).ready(function() {
			getRelativeCombo($('#vCountry').val(),"{/literal}{$userData.vState}{literal}",'vState','-- Select State --',stateArr);
		});
	});
	/*$('#spn').load(url+pars, function() {
		$(document).ready(function() {
			getRelativeCombo($('#vCountry').val(),"{/literal}{$userData.vState}{literal}",'vState','-- Select State --',stateArr);
		});
	});*/
}
function getOrgCombo() {
   // if($('#iUserID').val() == '') {
       // alert("Please select a buyer organization");return false;
   // }
    if($('#regno').val() == '' && $('#orgcode').val() == '' && $('#orgname').val() == '') {
        alert(LBL_ENTER_COMP_REG_CODE_NAME);return false;
    }

   $('#OrgCombo').load(SITE_URL+"index.php?file=or-aj_getOrgCombo&iUserID="+$('#iUserID').val()+"&orgname="+escape($('#orgname').val())+"&orgcode="+escape($('#orgcode').val())+"&regno="+escape($('#regno').val()));
}
function submitform()
{
	var vldfrm = $('#frmadd').valid();
	if(!vldfrm) {
		return false;
	}
   var email = $('#vEmail').val();
	pars = "&id=iUserID"+"&iUserID="+$('#iUserID').val()+"&flds=vEmail"+"&vEmail="+$('#vEmail').val()+"&table={/literal}{$PRJ_DB_PREFIX}{literal}_organization_user";
	$.post(SITE_URL+"index.php?file=m-aj_chkdupdata", pars, function(resp)
	{
		if(resp == 'dup') {
			/*var vldfrm = $('#frmadd').valid();
			if(!vldfrm) {
				return false;
			}*/
			var ans = confirm(LBL_EMAIL_TAKEN+LBL_SURE_TO_PROCEED);
			if(ans) {
				$('#dpr').val('dpl');
				// $('#emlval').val(email);
				// alert('yes');
				$('#frmadd').submit();
			}
		} else if(resp == 'nodup') {
			$('#dpr').val('nod');
			// alert('ndp');
			/*var vldfrm = $('#frmadd').valid();
			if(!vldfrm) {
				return false;
			}*/
			$('#frmadd')[0].submit();
			$(document).ready( function() {
				$(function() {
					var ead=90;
					$('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
				});
			});
		}
	});
	$(document).ready( function() {
		$(function() {
			var ead=90;
			$('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
		});
	});
	return false;
}
function resetform()
{
	$('#frmadd')[0].reset();
   getRelativeCombo($('#vCountry').val(),"{/literal}{$userData[0].vState}{literal}",'vState','-- Select State --',stateArr);
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

function showHideGroup(val)
{
	if(val == 'Group') {
		getRelativeCombo($('#iOrganizationID').val(),"{/literal}{$userData.iGroupID}{literal}",'iGroupID','-- Select Group --',groupArr);
		if($('#iGroupID option').length<2) {
			alert("No Group Available");
			$('#ePermissionType1').attr('checked','checked');
		}
		$('#trGroupList').show();
		// $('#iGroupID').addClass('required');
	} else {
		// $('#iGroupID').removeClass('required');
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
   // alert($('#iOrganizationID').val());
   $('#iOrganizationID').val(totValID);
   //alert($('#iOrganizationID').val());
   getRelativeCombo($('#iOrganizationID').val(),"{/literal}{$userData.iGroupID}{literal}",'iGroupID','-- Select Group --',groupArr);
   // $('#OrgStatus_Div').load(SITE_URL+"index.php?file=or-aj_getOrganizationStatus&type=user&iId="+totValID+"");

	var url = SITE_URL+"index.php?file=u-aj_getOrgDetails";
	var pars = "&table="+PRJ_DB_PREFIX+"_organization_master"+"&iId=iOrganizationID"+"&id="+totValID+"&fields=all"+"&jtbl=&where=&js=setusr";
	//alert(url+pars); return false;
	/*$.post(url, pars, function(resp) {
	// $('#spn').load(url+pars, function() {
		$('#spn').html('');
		$('#spn').append(resp);
	});*/
	$('#spn').load(url+pars);
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
$(document).ready(function()
{
	$("#frmadd").validate({
		rules:{
				 "Data[iSecretQuestion2ID]":{required:function(){
						if($.trim($('#vAnwser').val())=='')
							  return false;
						}
				 },
				 "Data[vAnwser]":{required:function(){
						if($.trim($('#iSecretQuestion2ID').val())=='')
							  return false;
						}
				 }/*,
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
									extfld: function() {
										return "iOrganizationID";
									},
									extval: function() {
										return $("#iOrganizationID").val();
									},
									table:function() {
										return "{/literal}{$PRJ_DB_PREFIX}{literal}_organization_user";
									}
								}
						}
					}*/
				 /*,
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
				},*/
		},
		messages:{
			"Data[vEmail]": {
				required:  LBL_EMAIL_ADDRESS,
				email: LBL_VALID_EMAIL_ADDRESS,
				remote: jQuery.validator.format(LBL_EMAIL_TAKEN)
			},
			"cPassword": { equalTo: MSG_CON_PASS },
			"Data[vUserName]": {
				required: LBL_ENTER_USER_NAME,
				remote: jQuery.validator.format(LBL_USERNAME_TAKEN)
			},
			"Data[vZip]": {required: LBL_ZIPCODE},
			"Data[vPassword]": { minlength: LBL_FIVE_CHAR_REQUIRED }
		}
	});
	//
	$('#vPassword').passwordStrength({targetElement:'#psi', targetTextElement:'#pst', psimsg:["{/literal}{$LBL_WEAK}{literal}","{/literal}{$LBL_MEDIUM}{literal}","{/literal}{$LBL_STRONG}{literal}","{/literal}{$LBL_VERY_STRONG}{literal}"]});
	$('#vPassword').trigger('blur');
	getRelativeCombo($('#vCountry').val(),"{/literal}{$userData.vState}{literal}",'vState','-- Select State --',stateArr);
	/*$("#vOrg").autocomplete(
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
		});*/
      // $('#iOrganizationID').load(SITE_URL+"index.php?file=or-aj_getOrganization"+"&htmlTag=option"+"&isAssoc=no"+"&val={/literal}{$userData.iOrganizationID}{literal}");
	if(permitType == 'Group') {
		$('#ePermissionType2').attr('checked','checked');
		getRelativeCombo($('#iOrganizationID').val(),"{/literal}{$userData.iGroupID}{literal}",'iGroupID','-- Select Group --',groupArr);
		showHideGroup('Group');
	}
});
function fillCountryCode(obj)
{
	var opt=obj.options[obj.selectedIndex];
	var currency=opt.getAttribute("currency");
	$('input.countryCode').val(opt.title);
}
</script>
{/literal}

{if $msg neq ''}
{literal}
<script type="text/javascript">
$(document).ready(function() {
	var vldmsg = '{/literal}{$msg}{literal}';
   if(vldmsg!= '' && vldmsg != undefined && $('#vldms').val()!=vldmsg) {
	    alert(vldmsg);
		$('#vldms').val(vldmsg);
   }
});
</script>
{/literal}
{/if}