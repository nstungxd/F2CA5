<form name="frmcreategroup" id="frmcreategroup" action="{$SITE_URL}index.php?file=u-creategroup_a" method="POST">
<input type="hidden" name="iGroupID" id="iGroupID"value="{$iGroupID}" />
<input type="hidden" name="view" id="view"value="{$view}" />
<div class="middle-container">
       <h1>{$LBL_CREATE_GROUP}</h1>
       <div class="middle-containt">
       <div class="statistics-main-box-white">
       <div>
         <ul id="inner-tab">
				<li><a href="#" class="current"><EM>{$LBL_GROUP}</EM></a></li>
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
                    <table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
                    <tr>
                      <td width="130px" valign="top">{$LBL_SELECT_ORG}&nbsp;<font class="reqmsg">*</font> </td>
                      <td>:</td>
                      <td>
                      <table width="228" border="0" cellspacing="0" cellpadding="0">
                      {if $usertype eq 'securitymanager'}
                          <tr>
                              <!-- class="securitymanager-white-bg" -->
                            <td height="20">
                                 {*if $orgname neq ''}
                                        <input type="text" name="vOrg" id="vOrg" value="{$orgname}" class="input-rag required" readonly="readonly" title="{$MSG_SELECT_ORGANIZATION}"/>
                                        <input type="hidden" name="Data[iOrganizationID]" id="iOrganizationID" value="{$orgdata[0].iOrganizationID}" title="{$MSG_SELECT_ORGANIZATION}"/>
                                   {else}
                                        <input type="hidden" name="Data[iOrganizationID]" id="iOrganizationID" value="{$orgdata[0].iOrganizationID}" tabindex="1" title="{$MSG_SELECT_ORGANIZATION}"/>
                                        <input type="text" name="vOrg" id="vOrg" value="{$orgdata[0].vCompanyName}" class="input-rag required" tabindex="2" title="{$MSG_SELECT_ORGANIZATION}"/>
                                    {/if*}
                            	<div id="grouporg">
                            		{if $view eq 'edit'}
                            			<input type="text" class="input-rag" readonly="readonly" id="org" name="org" value="{$orgdata[0].vCompanyName}" />
												<input type="hidden" class="input-rag" readonly="readonly" id="iOrganizationID" name="Data[iOrganizationID]" value="{$orgdata[0].iOrganizationID}" />
                            		{elseif $view neq 'edit'}
                                  	<select name="Data[iOrganizationID]" id="iOrganizationID" class="required" title="{$MSG_SELECT_ORGANIZATION}" style="width:230px" onchange='getOrgStatus(this.value);'>
                                          <option value=''>---{$MSG_SELECT_ORGANIZATION}---</option>
														{*if $sess_usertype_short eq 'OA'*}
														{if $orgdata|is_array && $orgdata|@count>0}
														<option value='{$orgdata[0].iOrganizationID}' selected="selected">{$orgdata[0].vCompanyName}</option>
														{/if}
														{*/if*}
                               		</select>
                               	{/if}
                               </div>
                           </td>
                           <td>&nbsp;</td>
              					    <td valign="top">
              					    	{if $view neq 'edit'}
              					          <input type="text" name="orgtxt" value="{$orgdata[0].orgname}" class="" id="orgtxt" style="vertical-align:middle; height:18px;" />
         					          {/if}
                               </td>
                               <td >&nbsp;</td>
                               <td valign="top">
                               	{if $view neq 'edit'}
                                  <img src="{$SITE_IMAGES}sm_images/btn-search.gif" alt="" border="0" style="cursor: pointer;vertical-align:middle;background: #f8f8f8;border:none;" onclick="getBuyerOrgs();"  />
                                  {/if}
              			           </td>

                          </tr>
                          {else}
                          <tr>
                               <tr>
                              <!-- class="securitymanager-white-bg" -->
                            <td height="20">

                                        <input type="text" name="vOrg" id="vOrg" value="{$orgname}" class="input-rag required" readonly="readonly" title="{$MSG_SELECT_ORGANIZATION}"/>
                                        <input type="hidden" name="Data[iOrganizationID]" id="iOrganizationID" value="{$orgid}" title="{$MSG_SELECT_ORGANIZATION}"/>


                               </select>
                               </div>
                            </td>
                            <td colspan="4">&nbsp;</td>
                          </tr>
                          <tr>
                          {/if}
                        </table></td>
                    </tr>
                    <tr>
                      <td valign="top">{$LBL_GROUP_NAME}&nbsp;<font class="reqmsg">*</font> </td>
                      <td>:</td>
                      <td>
                         {if $view eq 'edit'}
                              <input type="text" name="Data[vGroupName]" value="{$grpData[0].vGroupName}" class="input-rag required" id="vGroupName" style="width:228px;"/>
                              {*$grpData[0].vGroupName*}
                         {else}
                              <input type="text" name="Data[vGroupName]" value="{$grpData[0].vGroupName}" class="input-rag required" id="vGroupName" style="width:228px;"/>
                         {/if}
                      </td>
                    </tr>
						  {*}<tr><td colspan="3">&nbsp;</td></tr>
                    <tr>
                      <td valign="top">{$LBL_SELECT_USER}&nbsp;<font class="reqmsg">*</font> </td>
                      <td valign="top">:</td>
                      <td>
                        <table width="486" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td height="30" valign="top">
                                {$LBL_SEARCH_NAME} :
                                <input type="text" name="name_keyword" class="input-rag" id="name_keyword" style="width:100px; vertical-align:middle;" /> &nbsp;
                                <img src="{$SITE_IMAGES}sm_images/btn-search.gif" alt=""  style="cursor: pointer;vertical-align:middle;border: none;background: #f8f8f8;" onclick="getUser();"  />
                            </td>
                          </tr>
								  <tr><td colspan="3">&nbsp;</td></tr>
                          <tr>
                            <td class="light-golden-bor" align="left" height="35">
                                <div id="result">{$LBL_USER_NOT_FOUND}</div>
                            </td>
                          </tr>
                          <tr>
                            <td style="padding-top:5px;">
                                <img src="{$SITE_IMAGES}sm_images/btn-insert.gif" id="insert_btn"  alt=""  style="cursor: pointer;vertical-align:middle;border: none;background: #f8f8f8;display:none;"/>
                                <img src="{$SITE_IMAGES}sm_images/btn-delete.gif" id="delete_btn"  alt=""  style="cursor: pointer;vertical-align:middle;border: none;background: #f8f8f8;display:none;"/>
                            </td>
                          </tr>
                          <tr>
                            <td style="padding-top:5px;">
                                <select name="tUserID[]" id="tUserID" class="textarea-security" style="width:228px; height:100px;display:none;" multiple="multiple">
                                     {section name=i loop=$userdata}
                                     <option value="{$userdata[i].Id}" selected="selected">{$userdata[i].vTitle}</option>
                                     {/section}
                                </select>
                            </td>
                          </tr>
                          <tr>
                            <td style="padding-top:5px;" valign="bottom">
                                <img src="{$SITE_IMAGES}sm_images/btn-reset.gif" alt="" id="reset_btn" border="0" style="cursor: pointer;vertical-align:middle;border: none;background: #f8f8f8;display:none;" />
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>{*}
                    <tr id="access_rights_row" style="display:none;">
                      <td valign="top">{$LBL_ASSIGN_RIGHTS}&nbsp;<font class="reqmsg">*</font> </td>
                      <td valign="top">:</td>
                        <td>
                            <div id="OrgStatus_Div" style="width:700px; overflow-x:auto; border:1px solid #cccccc; padding:1px;"></div>
                        </td>
                    </tr>
                    <tr>
                      <td valign="top">&nbsp;</td>
                      <td colspan="2">
                        <img id="go" src="{$SITE_IMAGES}sm_images/btn-submit.gif" alt="" style="vertical-align:middle;cursor:pointer;border:none;background: #f8f8f8;" onclick="return frmsubmit();" /> &nbsp;
                      </td>
                    </tr>
                  </table>
                </div>
                <div>&nbsp;</div>
            </div>
       </div>
       </div>
     </div>
</form>
<input id="vldms" name="vldms" style="display:none;" value="" />
<script type="text/javascript" src="{$S_JQUERY}jquery.validate.js"></script>
<script language="JavaScript" src="{$S_JQUERY}jquery.autocomplete.js"></script>
<link type="text/css" rel="stylesheet" media="screen" href="{$SITE_CSS}jquery.autocomplete.css" />
{literal}
<script type="text/javascript">
var view = '{/literal}{$view}{literal}';
var org = '{/literal}{$orgname}{literal}';
var grpid = '{/literal}{$iGroupID}{literal}';

//$(document).ready({
   var validator = $("#frmcreategroup").validate({
      rules: {
      "Data[vGroupName]": {
         remote: {
            url:SITE_URL+"index.php?file=u-aj_chkdupdata",
            type:"get",
            data:{
               val:function() {
                  return $("#iGroupID").val();
               },
               id:function() {
                  return "iGroupID";
               },
               field:function() {
                  return "vGroupName";
               },
               extfld: function() {
                  return "iOrganizationID";
               },
               extval: function() {
                  return $("#iOrganizationID").val();
               },
               table:function() {
                  return "{/literal}{$PRJ_DB_PREFIX}{literal}_organization_group";
               }
            }
         }
      }
      },
      messages: {
	      "Data[vGroupName]": {
		      required:  '{/literal}{$LBL_ENTER_GROUP_NAME}{literal}',
			   remote: jQuery.validator.format(LBL_GROUP_NAME_TAKEN)
         }
      }
   });
// });

var shgo_fn = function shgo() {
   ln = $('#tUserID option').length;
   if(ln == 0){
      // $('#go').hide();
   } else if(ln > 0) {
		// $('#go').show();
	}
}
// shgo_fn();
$(document).ready(function() {
   $('#insert_btn').click(shgo_fn);
	$('#reset_btn').click(shgo_fn);
});
if(view == 'edit') {
   var totValID = '{/literal}{$orgdata[0].iOrganizationID}{literal}';
   var userid = '{/literal}{$grpData[0].tUserID}{literal}';
   var prms = '{/literal}{$grpData[0].tPermission}{literal}';
	var acpt = '{/literal}{$grpData[0].tAcceptancePermit}{literal}';
   $('#OrgStatus_Div').load(SITE_URL+"index.php?file=or-aj_getOrganizationStatus&type=user&iId="+totValID+"&prms="+prms+"&acpt="+acpt+"&grpid="+grpid);
   $('#result').load(SITE_URL+"index.php?file=u-aj_getOrganizationUser&type=user&iId="+totValID+"&userid="+userid+"");
}

$('#saved_itms').hide();
function getUser() {
   if(view != 'edit') {
    if($('#iOrganizationID').val() == '') {
        alert("Please select one organization first to get its users.");return false;
    }
   }
    if($('#name_keyword').val() == '') {
        alert("Please enter name of the User.");return false;
    }
   totValID = $('#iOrganizationID').val();
   $('#result').load(SITE_URL+"index.php?file=u-aj_getOrganizationUser&type=user&iId="+totValID+"&name="+$('#name_keyword').val()+"");
}
$('#reset_btn').click( function () {
        $('#tUserID').find('option').remove();
});
function rset() {
	$('#tUserID option').remove();
	$('#result').attr('innerHTML','{/literal}{$LBL_USER_NOT_FOUND}{literal}');
}
function getBuyerOrgs() {
    if($('#orgtxt').val() == '') {
        alert("Please Enter Organization Name");return false;
    }

   var orgtxt = $('#orgtxt').val();
   $('#grouporg').load(SITE_URL+"index.php?file=or-aj_getBuyerOrg&view=group&orgtxt="+orgtxt);
}
$('#insert_btn').click( function () {
    orgs = $('input:checkbox[name="uid\[\]"]');
    $.each(orgs, function (ln,el) {
       if($(this).attr('checked') == true) {
            var id = $(this).attr('id');
            var userID = $(this).val();
            var userName = $('#name_'+id+'').val();
            var chkvalue =0;
            if($('#tUserID option').length > 0){
                $('#tUserID option').each(function() {
                    if($(this).val() == userID){
                       chkvalue++;
                    }
                });
                if(chkvalue == 0){
                    $('#tUserID').append($("<option></option>").attr("value",''+userID+'').attr('selected','selected').text(''+userName+''));
                }
            }else{
                 $('#tUserID').append($("<option></option>").attr("value",''+userID+'').attr('selected','selected').text(''+userName+''));
            }
        }
    });
});

$('#delete_btn').click( function () {
    orgs = $('input:checkbox[name="uid\[\]"]');
    $.each(orgs, function (ln,el) {
       if($(this).attr('checked') == true) {
            var id = $(this).attr('id');
            var userID = $(this).val();
            var userName = $('#name_'+id+'').val();
            var chkvalue =0;
            if($('#tUserID option').length > 0){
                $('#tUserID option').each(function() {
                    if($(this).attr('selected')){
                         $(this).remove();
                    }
                });
            }
        }
    });
});

function findValue(li) {
   if( li == null ) return alert("No match!");
   if( !!li.extra ) var sValue = li.extra[0];
	else var sValue = li.selectValue;

   // Coded BY SNEHASIS [TO GET ID OF A DATA]
   var totVal = sValue;
   var totValID;
   var totValRes;
   totVal = totVal.split('</span>');
   totValID = totVal[0].replace("<span style='display:none'>","");
   totValRes = totVal[1];
   $('#iOrganizationID').val(totValID);
   $('#tUserID').find('option').remove();
	$('#result').attr('innerHTML','{/literal}{$LBL_USER_NOT_FOUND}{literal}');
   //$('#result').load(SITE_URL+"index.php?file=u-aj_getOrganizationUser&type=user&iId="+totValID+"");
   $('#OrgStatus_Div').load(SITE_URL+"index.php?file=or-aj_getOrganizationStatus&type=user&iId="+totValID+"&grpid="+grpid);
}

function selectItem(li) {
	findValue(li);
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
/*if(org == '') {
     $(document).ready(function() {
          $("#vOrg").autocomplete(
               SITE_URL+"index.php?file=or-aj_getOrganization",
               {
                    delay:10,
                    minChars:1,
                    matchSubset:1,
                    matchContains:1,
                    cacheLength:10,
                    onItemSelect:selectItem,
                    onFindValue:findValue,
                    formatItem:formatItem,
                    autoFill:false
               }
          );
     });
     //$('#iOrganizationID').load(SITE_URL+"index.php?file=or-aj_getOrganization"+"&htmlTag=option"+"&isAssoc=no"+"&val={/literal}{$orgdata[0].iOrganizationID}{literal}");
}*/

if(org != '') {
    $(document).ready(function() {
          var totValID = '{/literal}{$orgdata[0].iOrganizationID}{literal}';
          if(totValID == '') {
          	totValID = '{/literal}{$orgid}{literal}';
          }
          var userid = '{/literal}{$grpData[0].tUserID}{literal}';
          var prms = '{/literal}{$grpData[0].tPermission}{literal}';
			 var acpt = '{/literal}{$grpData[0].tAcceptancePermit}{literal}';
          $('#OrgStatus_Div').load(SITE_URL+"index.php?file=or-aj_getOrganizationStatus&type=user&iId="+totValID+"&prms="+prms+"&acpt="+acpt+"&grpid="+grpid);
			 $(function() {
				  var ead=10;
				  $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
			 });
    });
}
function frmsubmit() {
	if(! ($("#frmcreategroup").valid())) {
		return false;
	} else {
		$('#frmcreategroup')[0].submit();
	}
}
</script>
{/literal}

{if $vldmsg neq ''}
{literal}
<script type="text/javascript">
$(document).ready(function() {
	var vldmsg = '{/literal}{$vldmsg}{literal}';
   if(vldmsg!= '' && vldmsg != undefined && $('#vldms').val()!=vldmsg) {
	   alert(vldmsg);
		$('#vldms').val(vldmsg);
   }
});

function getOrgStatus(res){
    $("#OrgStatus_Div").attr('innerHTML','Loading...');
    $("#OrgStatus_Div").load(SITE_URL+"index.php?file=or-aj_getOrganizationStatus&type=user&iId="+this.value+"&prms="+prms+"&acpt="+acpt+"&grpid="+res+"&view="+view);
}
</script>
{/literal}
{/if}