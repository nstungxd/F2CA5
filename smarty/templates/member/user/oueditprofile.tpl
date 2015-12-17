<script type="text/javascript" src="{$S_JQUERY}jquery.validate.js"></script>
{literal}
<script type="text/javascript" >
	var stateArr = new Array({/literal}{$stateArr}{literal});
     var groupArr = new Array({/literal}{$groupArr}{literal});
</script>
{/literal}

<div id="content-wrapper">
					<div class="row">
						<div class="col-lg-12">
							<div id="content-header" class="clearfix">
								<div class="pull-left">
									<ol class="breadcrumb">
										<li><a href="#">Home</a></li>
										<li class="active"><span>Profile</span></li>
									</ol>

									<h1>{$LBL_EDIT} {$LBL_PROFILE}</h1>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="main-box">
							<header class="main-box-header clearfix">

							</header>
							<div class="main-box-body clearfix">
								<form class="form-horizontal" name="frmadd" id="frmadd" action="{$SITE_URL}index.php?file=u-oueditprofile_a" method="post">
                                    <input type="hidden" name="iUserID" id="iUserID"value="{$iUserID}" />
									<div class="form-group">
										<label for="exampleInputEmail1"  class="col-md-2 control-label">{$LBL_USER_NAME} : {$userData.vUserName}</label>
									</div>
									<div class="form-group">
										<label for="vFirstname" class="col-md-2 control-label">{$LBL_FIRST_NAME} *</label>
										<div class="col-md-6">
											<input type="text" name="Data[vFirstName]" onkeypress="return chkValidChar(event);" class="form-control" tabindex="1" id="vFirstname" value="{$userData.vFirstName}" placeholder="Enter First Name">
										</div>
									</div>
									<div class="form-group">
										<label for="vLastName" class="col-md-2 control-label">{$LBL_LAST_NAME} *</label>
										<div class="col-md-6">
											<input type="text" name="Data[vLastName]" onkeypress="return chkValidChar(event);" class="form-control" tabindex="2" id="vLastName" value="{$userData.vLastName}" placeholder="Enter last name" >
										</div>
									</div>
									<div class="form-group">
										<label for="eSalutation" class="col-md-2 control-label">Salutation </label>
                                       

										<div class="col-md-6">
											<select id="eSalutation" tabindex="4" class="form-control" name="Data[eSalutation]">
												<option>-- Select --</option>
												<option>Mr.</option>
												<option>Dr.</option>
												<option>Sir</option>
												<option>Mrs.</option>
												<option>Miss</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="vOrg" class="col-md-2 control-label">{$LBL_ORGANIZATION} *</label>
										<div class="col-md-6">
                                            <input type="hidden" name="Data[iOrganizationID]" id="iOrganizationID" value="{$userData.iOrganizationID}" title="{$MSG_SELECT_ORGANIZATION}"/>
											<input type="text" tabindex="5" name="vOrg" id="vOrg" value="{$orgdtls[0].vCompanyName}"  class="form-control" placeholder="{$MSG_SELECT_ORGANIZATION}">
										</div>
									</div>
									<div class="form-group">
										<label for="vAddressLine1" class="col-md-2 control-label">{$LBL_ADDR_LINE} 1 *</label>
										<div class="col-md-6">
											<input type="text" class="form-control" value="{$userData.vAddressLine1}" name="Data[vAddressLine1]" placeholder="Enter Address Line1" id="vAddressLine1" tabindex="6">
										</div>
									</div>
									<div class="form-group">
										<label for="vAddressLine2" class="col-md-2 control-label">{$LBL_ADDR_LINE} 2</label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="Data[vAddressLine2]"  value="{$userData.vAddressLine2}" placeholder="Enter Address Line2" id="vAddressLine2" tabindex="7">
										</div>
									</div>
									<div class="form-group">
										<label for="vAddressLine3" class="col-md-2 control-label">{$LBL_ADDR_LINE} 3</label>
										<div class="col-md-6">
											<input type="text" class="form-control" placeholder="Address Line 3" name="Data[vAddressLine3]" value="{$userData.vAddressLine3}" id="vAddressLine3"  tabindex="8">
										</div>
									</div>
									<div class="form-group form-group-select2">
										<label class="col-md-2 control-label" for="vCountry">{$LBL_COUNTRY}</label>
										<div class="col-md-6">
											
                                            <select class="form-control" name ="Data[vCountry]" id="vCountry"  title="Select Country" tabindex="9" onchange="getRelativeCombo(this.value,'','vState','-- Select State --',stateArr);">
                                                 <option value=""> --- Select Country --- </option>
                                                 {section name=i loop=$db_country}
                                                       <option value="{$db_country[i].vCountryCode}" {if $userData.vCountry eq $db_country[i].vCountryCode} selected {/if} >{$db_country[i].vCountry}</option>
                                                 {/section}
                                             </select>
										</div>
									</div>
									<div class="form-group form-group-select2">
										<label class="col-md-2 control-label" for="vState">{$LBL_STATE}</label>
										<div class="col-md-6">
											<input type="hidden" name="selstate" id="selstate" value="{$userData.vState}">
                                             <select name ="Data[vState]" id="vState" tabindex="10" class="form-control" title="Select State">
                                                    <option value="">Select State</option>
                                            </select>
										</div>
									</div>
									<div class="form-group">
										<label for="vCity" class="col-md-2 control-label">{$LBL_CITY} *</label>
										<div class="col-md-6">
											<input type="text" name="Data[vCity]" value="{$userData.vCity}" class="form-control" ionkeypress='return chkValidChar(event);' id="vCity" placeholder="Enter City" tabindex="11">
										</div>
									</div>
									<div class="form-group">
										<label for="vZipCode" class="col-md-2 control-label">{$LBL_ZIP_CODE} *</label>
										<div class="col-md-6">
											<input type="number" class="form-control" name="Data[vZipCode]" value="{$userData.vZipCode}"  placeholder="Enter Zip Code" onkeypress="return chkDigitZipcode(event)" id="vZipCode" tabindex="12">
										</div>
									</div>
									<div class="form-group">
										<label for="vPhoneCode" class="col-md-2 control-label">{$LBL_PHONE}</label>
										<div class="col-md-2">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-phone"></i></span>
												<input type="text" class="form-control" name="vPhoneCode"  value="{$userData.vPhoneCode}" id="vPhoneCode" maxlength="3" onkeypress="return chkValidPhone(event)" tabindex="13">
											</div>
										</div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" tabindex="14" id="vPhone" onkeypress="return chkValidPhone(event)" maxlength="20" name="Data[vPhone]"  value="{$userData.vPhone}" >
                                                </div>
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_EXTENTION}</label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="Data[vExtention]" value="{$userData.vExtention}" id="vExtention" placeholder="Extention" tabindex="15">
										</div>
									</div>
									<div class="form-group">
										<label for="vMobileCode" class="col-md-2 control-label">{$LBL_MOBILE}</label>
										<div class="col-md-2">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-mobile-phone"></i></span>
												<input type="text" name="vMobileCode" class="form-control" value="{$userData.vMobileCode}" id="vMobileCode" onkeypress="return chkValidPhone(event)" maxlength="3" tabindex="16">
											</div>
										</div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="Data[vMobile]" value="{$userData.vMobile}" id="vMobile" onkeypress="return chkValidPhone(event)" maxlength="17" tabindex="13" />
                                            </div>
									</div>
									<div class="form-group">
										<label for="vEmail" class="col-md-2 control-label">{$LBL_EMAIL} *</label>
										<div class="col-md-6">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
												<input type="email" class="form-control" name="Data[vEmail]"  value="{$userData.vEmail}" placeholder="Enter Email Address"  onkeypress='return chkSpace(event);' id="vEmail" tabindex="18">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="secret1" class="col-md-2 control-label">{$LBL_SEC_QUESTION}1ID *</label>
										<div class="col-md-6">
											{$secQuestion1}
										</div>
									</div>
									<div class="form-group">
										<label for="vAnswer" class="col-md-2 control-label">{$LBL_ANSWER} *</label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="Data[vAnswer]" value="{$userData.vAnswer}" placeholder="Enter Answer" id="vAnswer" tabindex="19">
										</div>
									</div>
									<div class="form-group">
										<label for="secret1" class="col-md-2 control-label">{$LBL_SEC_QUESTION}2ID</label>
										<div class="col-md-6">
											{$secQuestion2}
										</div>
									</div>
									<div class="form-group">
										<label for="vAnwser" class="col-md-2 control-label">{$LBL_ANSWER}</label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="Data[vAnwser]"  value="{$userData.vAnwser}" id="vAnwser" tabindex="21">
										</div>
									</div>
									<div class="form-group">
										<label for="eEmailNotification" class="col-md-2 control-label">{$LBL_ONLINE_EMAIL_NOTIFICATION}</label>
										<div class="col-md-6">
                                             { if $userData.eEmailNotification eq 'Yes'}
                                                 { assign var='email' value='checked'}
                                            {/if}
											<input type="checkbox" id="eEmailNotification" value="Yes" name="Data[eEmailNotification]" {$email}/>
										</div>
									</div>
									<div class="form-group">
										<label for="vLanguage" class="col-md-2 control-label">{$LBL_Default_Language}</label>
										<div class="col-md-6">
                                            <select name="Data[vDefaltLan]" class="form-control">
                                                   {section name=i loop=$res}
                                                   <option {if $userData.vDefaltLan eq $res[i].vLanguageCode} selected {/if} value="{$res[i].vLanguageCode}">{$res[i].vLanguage}</option>
                                                   {/section}
                                             </select>
										</div>
									</div>
									<center class="form-group">
										<button type="button"  class="btn btn-primary" onclick="submitform()">Submit</button>
										<button type="button"  class="btn btn-primary" onclick="resetform();return false;">Reset</button>
										<button type="button"  class="btn btn-primary" {if $view eq 'edit'}onClick="window.location=SITE_URL+'index.php?file=u-organizationuserlist';"{else}onClick="window.location=SITE_URL+'index.php?file=u-organizationuser';"{/if}>Cancel</button>
									</center>
								</form>
							</div>
						</div>
					</div>



				</div>
<script language="JavaScript" src="{$S_JQUERY}jquery.autocomplete.js"></script>
<link type="text/css" rel="stylesheet" media="screen" href="{$SITE_CSS}jquery.autocomplete.css" />



<script src="{$SITE_JS}jquery.js"></script>
<script src="{$SITE_JS}bootstrap.js"></script>
<script src="{$SITE_JS}jquery.nanoscroller.min.js"></script>


<!-- this page specific scripts -->
<script src="{$SITE_JS}jquery.maskedinput.min.js"></script>
<script src="{$SITE_JS}select2.min.js"></script>
<script src="{$SITE_JS}modernizr.custom.js"></script>
<script src="{$SITE_JS}classie.js"></script>
<script src="{$SITE_JS}modalEffects.js"></script>
<!-- theme scripts -->
<script src="{$SITE_JS}scripts.js"></script>
<script src="{$SITE_JS}pace.min.js"></script>

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