<form name="frmcreateassocs" id="frmcreateassocs" action="{$SITE_URL}index.php?file=or-createassociation_a" method="post">
<input type="hidden" name="iAsociationID" id="iAsociationID"value="{$iAsociationID}" />
<input type="hidden" name="view" id="view"value="{$view}" />
<input type="hidden" name="del[]" id="del"value="" />
<div class="middle-container">
<h1>{$LBL_CREATE_ASSOCIATION}</h1>
<div class="middle-containt">
	<div class="statistics-main-box-white">
		<div>
			<ul id="inner-tab">
				<li><a class="current"><em>{$LBL_ASSOCIATION}</em></a></li>
		   </ul>
      </div>
		<div class="clear"></div>
		<div class="inner-gray-bg" style="height:439px;"> {*} style="height:430px;" {*}
			<div>&nbsp;</div>
			<div>
            <span id="prc" style="display:none; float:right;"> <img src="{$SITE_IMAGES}sm_images/progress.gif" /> Processing ... </span>
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
					 <td width="198" valign="top">{if $view eq 'edit'}{$LBL_ASSOCIATION_CODE}&nbsp;<font class="reqmsg">*</font> {/if}</td>
                <td>{if $view eq 'edit'}:{/if}</td>
					 <td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td align="left">
								<input type="hidden" name="Data[vAssociationCode]" id="vAssociationCode" value="{$vAssociationCode}" />
								<input type="hidden" name="iAsociationID" id="iAsociationID" value="{$iAsociationID}" />
							</td>
							 <td height="20" align="left">
								 {if $view eq 'edit'}
									<b>{$vAssociationCode}</b>
									{*}<input type="hidden" name="Data[vAssociationCode]" id="vAssociationCode" value="{$vAssociationCode}" />
									<input type="hidden" name="iAsociationID" id="iAsociationID" value="{$iAsociationID}" />
								 {else}
									<input type="text" class="input-rag required" name="Data[vAssociationCode]" id="vAssociationCode" value="" />{*}
								 {/if}
							 </td>
                      <td align="right"></td>
						  </tr>
						</table>
					</td>
					</tr>
				  <tr>
					 <td width="198" valign="top">{$LBL_SELECT_BUYER_ORG}&nbsp;<font class="reqmsg">*</font> </td>
               <td >:</td>
               <td>
					 {*}{if $view neq 'edit'}
						<input type="hidden" name="Data[vAssociationCode]" id="vAssociationCode" value="{$vAssociationCode}" />
					 {else}
						<input type="hidden" name="Data[vAssociationCode]" id="vAssociationCode" value="{$assorgdt[0].vAssociationCode}" />
					 {/if}{*}
						<table width="228" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							   <td height="20" >
									<!-- {if $orgname neq ''}

										  <input type="text" name="vOrg" id="vOrg" value="{$orgname}" class="input-rag required" readonly="readonly" title="{$MSG_SELECT_ORGANIZATION}"/>
										  <input type="hidden" name="Data[iBuyerOrganizationID]" id="iBuyerOrganizationID" value="{$orgdata[0].iOrganizationID}" title="{$MSG_SELECT_BUYER_ORGANIZATION}"/>
									{else}

										  <input type="hidden" name="Data[iBuyerOrganizationID]" id="iBuyerOrganizationID" value="{$assorgdt[0].iBuyerOrganizationID}" title="{$MSG_SELECT_BUYER_ORGANIZATION}"/>
										  <input type="text" name="vOrg" id="vOrg" {if $view eq 'edit'} readonly  autocomplete="off" {/if} value="{$assorgdt[0].vBuyerOrg}" class="input-rag required" title="{$MSG_SELECT_ORGANIZATION}"/>
									{/if} -->
    								{if $view eq 'edit'}
    									{assign var="readonly" value="DISABLED"}
    									<input type="hidden" name="Data[iBuyerOrganizationID]" id="iBuyerOrganizationID" value="{$assorgdt[0].iBuyerOrganizationID}" title="{$MSG_SELECT_BUYER_ORGANIZATION}"/>
										<div id="BuyerOrg">
										<select name="iBuyerOrganizationID" value=" " id="" style="width:230px;" {$readonly}>
											<option value="">---{$MSG_SELECT_BUYER_ORGANIZATION}---</option>
											<option value="{$assorgdt[0].iBuyerOrganizationID}" selected="selected">{$orgdata[0].vCompanyName}</option>
										</select>
										</div>
									{else}
										{if $uoa eq 'yes'}
											<input type="hidden" name="Data[iBuyerOrganizationID]" id="iBuyerOrganizationID" value="{$bodt[0].iOrganizationID}" >
											<input type="text" name="iBuyerOrganizationID" id="iBuyerOrgID" value="{$bodt[0].vCompanyName}" readonly="readonly" />
										{else}
										<div id="BuyerOrg">
										<select name="Data[iBuyerOrganizationID]" id="iBuyerOrganizationID" style="width:230px;" {if $uoa eq 'yes'}disabled="disabled"{/if}>
											<option value="">---{$MSG_SELECT_BUYER_ORGANIZATION}---</option>
										</select>
										</div>
										{/if}
    								{/if}
								 </td>
								  <td>
								      &nbsp;&nbsp;
								  </td>
							{if $view eq 'edit'}
							<td colspan="3">&nbsp;</td>
							{elseif $uoa neq 'yes'}
					      <td>
					         <input type="text" name="orgtxt" value="{$orgdata[0].orgname}" class="input-rag" id="orgtxt" style="width:100px; vertical-align:middle;">
							</td>
							<td>&nbsp;&nbsp;</td>
							<td>
								<img src="{$SITE_IMAGES}sm_images/btn-search.gif" alt="" border="0" style="cursor: pointer;vertical-align:middle;background: #f8f8f8;border:none;" onclick="getBuyerOrgs();" />
							</td>
							{/if}
						</tr>
						</table>
						</td>
						</td>
				  	</tr>
					  <tr>
						 <td valign="top">{$LBL_SELECT_SELLER_ORG}&nbsp;<font class="reqmsg">*</font> </td>
                               <td valign="top" >:</td>
						 <td>
							<table width="486" border="0" cellspacing="0" cellpadding="0">
                                     <tr>
                                          <td height="20" style="padding-left: 4px;">
									 {$LBL_COMP_REG_NO} &nbsp;
                                              {$LBL_ORG_CODE} &nbsp;
                                              {$LBL_ORG_NAME} &nbsp;
								 </td>
							  </tr>
							  	<tr>
								<td height="30" valign="top">
									<input type="text" name="regno" value="{$orgdata[0].regno}" class="input-rag" id="regno" style="width:100px; vertical-align:middle;" > &nbsp;
									<input type="text" name="orgcode" value="{$orgdata[0].orgcode}" class="input-rag" id="orgcode" style="width:100px; vertical-align:middle;"> &nbsp;
									<input type="text" name="orgname" value="{$orgdata[0].orgname}" class="input-rag" id="orgname" style="width:100px; vertical-align:middle;">
									<img src="{$SITE_IMAGES}sm_images/btn-search.gif" alt="" border="0" style="cursor: pointer;vertical-align:middle;background: #f8f8f8;border:none;" onclick="getSellerOrgs();"  />
								</td>
							  	</tr>
							  	<tr>
								<td class="light-golden-bor"  height="35">
									<div id="result" align="center">{$LBL_ORG_NOT_FOUND}</div>
								</td>
								</tr>
								<tr>
									<td  height="5" style="padding-top:5px;">
									<img src="{$SITE_IMAGES}sm_images/btn-insert.gif" id="insert_btn"  alt=""  style="cursor: pointer;vertical-align:middle;border:none;background: #f8f8f8;display:none;"/>
									<img src="{$SITE_IMAGES}sm_images/btn-reset.gif" alt="" id="reset_btn" border="0" style="cursor: pointer;vertical-align:middle;border:none;background: #f8f8f8;" onclick="resetform();return false;"/>
									</td>
								</tr>
								<tr><td>&nbsp;</td></tr>
								<tr>
									<td style="padding-top:5px;">
									  {*}<select name="tAssocs[]" id="tAssocs" class="textarea-security required" style="width:228px; height:100px; display:none;" multiple="multiple">
									  </select>{*}
									<div  style="height: 100px;overflow-y:auto;">
										<div id="assocs" class="textarea-security" {*if $res|is_array && $res|@count gt 0}style='border 1px solid #cccccc'{/if*}>
											 {section name=i loop=$res}
												 {assign var="indx" value=$res[i].iOrganizationID}
											 <div id="asso{$res[i].iOrganizationID}" {if $smarty.section.i.index%2 eq 0}style="background:#eeeeee;"{/if}>
												<img src="{$SITE_IMAGES}arrow.gif" /> &nbsp;
												<span style="display:inline-block; width:430px;"><b>(<span id="sellcode{$res[i].iOrganizationID}">{$newarr[$indx].vSupplierCode}</span>) &nbsp;[Seller Organization: {$res[i].vCompanyName}({$res[i].vOrganizationCode})]</b> &nbsp;</span>
												<span><img src="{$SITE_IMAGES}sm_images/icon-cancel.gif" onclick="delasso('{$res[i].iOrganizationID}');" /></span>
												<input type="hidden" name="assocorgs[]" id="assocorgs{$res[i].iOrganizationID}" value="{$res[i].iOrganizationID}" />
												<input type="hidden" name="suporgcode[]" id="suporgcode{$res[i].iOrganizationID}" value="{$res[i].vOrganizationCode}" />
												<input type="hidden" name="assocCode[]" id="assocCode{$res[i].iOrganizationID}" value="{$newarr[$indx].vSupplierCode}" />
											 </div>
											 {/section}
										</div>
									  </div>
								 </td>
							  </tr>
							</table>
						 </td>
					  </tr>
					<tr>
						<td valign="top">&nbsp;</td>
						<td colspan="2">
							<img src="{$SITE_IMAGES}sm_images/btn-submit.gif" alt="" id="btnSubmit" border="0" style="cursor: pointer;vertical-align:middle;cursor:pointer;border:none;background: #f8f8f8;" onclick="return submitfrm();" /> &nbsp;
						</td>
					</tr>
				</table>
			</div>
			<div>&nbsp;</div>
		</div>
	</div>
</div>
<input type="hidden" name="m" id="m" value="" />
<input type="hidden" name="vm" id="vm" value="" />
<input type="hidden" name="vms" id="vms" value="" />
</div>
</form>

<script type="text/javascript" src="{$S_JQUERY}jquery.validate.js"></script>
<script language="JavaScript" src="{$S_JQUERY}jquery.autocomplete.js"></script>
<link type="text/css" rel="stylesheet" media="screen" href="{$SITE_CSS}jquery.autocomplete.css" />
{literal}
<script type="text/javascript">
var view = '{/literal}{$view}{literal}';
var org = '{/literal}{$orgname}{literal}';
var val="";
if(view == 'edit') {
     var totValID = '{/literal}{$assorgdt[0].iBuyerOrganizationID}{literal}';
     $('#result').load(SITE_URL+"index.php?file=or-aj_getSellerOrgAsso&iAsociationID="+$('#iAsociationID').val()+"&iBuyerOrganizationID="+totValID+"&view="+view);
}
var val="{/literal}{$orgdata[0].iBuyerOrganizationID}{literal}";
// $('#iBuyerOrganizationID').load(SITE_URL+"index.php?file=or-aj_getOrganization&orgtype=buyer&orgid="+$('#iSupplierAssocationID').val()+"&htmlTag=option"+"&isAssoc=yes"+"&val="+val);


var assono = 0;
$('#saved_itms').hide();
if(view != 'edit') {
	$('#btnSubmit').hide();
}
function getSellerOrgs() {
    if($('#iBuyerOrganizationID').val() == '') {
        alert(MSG_SELECT_BUYER_ORGANIZATION);return false;
    }

    if($('#regno').val() == '' && $('#orgcode').val() == '' && $('#orgname').val() == '') {
        alert(LBL_ENTER_COMP_REG_CODE_NAME);return false;
    }
    totValID = $('#iBuyerOrganizationID').val();
   $('#result').load(SITE_URL+"index.php?file=or-aj_getSellerOrgAsso&iAsociationID="+$('#iAsociationID').val()+"&iBuyerOrganizationID="+totValID+"&orgname="+escape($('#orgname').val())+"&orgcode="+escape($('#orgcode').val())+"&regno="+escape($('#regno').val()));
}
function getBuyerOrgs() {
    if($('#orgtxt').val() == '') {
        alert(MSG_ENTER_BUYER_ORGANIZATION_NAME);return false;
    }

   var orgtxt = $('#orgtxt').val();
   $('#BuyerOrg').load(SITE_URL+"index.php?file=or-aj_getBuyerOrg&view=asociation&orgtxt="+orgtxt+"&orgtyp=Buyer");
}
$('#reset_btn').click( function () {
//   $('#tAssocs').find('option').remove();
	if(view != 'edit') {
		$('#assocs').attr('innerHTML','');
	}
     $('#btnSubmit').hide();
});

function delasso(vl)
{
     if($('#del').val() != '') {
          $('#del').val($('#del').val()+','+vl);
     } else {
          $('#del').val(vl);
     }
	$('#asso'+vl).attr('innerHTML','');
	$('#asso'+vl).css('height','0px');

       if(view == 'edit')
            $('#btnSubmit').show();
       else {
            var empty=0;
           $.each($('#assocs div'),function(i,el){
             if($(this).html()=="")
                  {
                  empty++;
                  }
            });
       if(empty == $('#assocs div').length)
            $('#btnSubmit').hide();
       }
}

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
   $('#iBuyerOrganizationID').val(totValID);
   $('#tUserID').find('option').remove();
   //$('#result').load(SITE_URL+"index.php?file=u-aj_getOrganizationUser&type=user&iId="+totValID+"");
   $('#OrgStatus_Div').load(SITE_URL+"index.php?file=or-aj_getOrganizationStatus&type=user&iId="+totValID+"");
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
if(org == '') {
     $(document).ready(function() {
          /*$("#vOrg").autocomplete(
               SITE_URL+"index.php?file=or-aj_getOrganization&orgtype=buyer&orgid="+$('#iSupplierAssocationID').val(),
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
          );*/
          $("#vSOrg").autocomplete(
               SITE_URL+"index.php?file=or-aj_getOrganization&orgtype=supplier&orgid="+$('#iBuyerOrganizationID').val(),
               {
                    delay:10,
                    minChars:1,
                    matchSubset:1,
                    matchContains:1,
                    cacheLength:10,
                    onItemSelect:selectSItem,
                    onFindValue:findSValue,
                    formatItem:formatSItem,
                    autoFill:false
               }
          );
     });
}


function findSValue(li) {
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
   $('#iSupplierAssocationID').val(totValID);
   $('#tUserID').find('option').remove();
   //$('#result').load(SITE_URL+"index.php?file=u-aj_getOrganizationUser&type=user&iId="+totValID+"");
   $('#OrgStatus_Div').load(SITE_URL+"index.php?file=or-aj_getOrganizationStatus&type=user&iId="+totValID+"");
}

function selectSItem(li) {
	findSValue(li);
}
function formatSItem(row) {
   var totVal = row[0];
   var totValID;
   var totValRes;
   totVal = totVal.split('</span>');
   totValID = totVal[0].replace("<span style='display:none'>");
   totValRes = totVal[1];
   return totValRes;
}
if(view != 'edit')
{
	$("#frmcreateassocs").validate({
		rules: {
			"Data[vAssociationCode]": {
				remote:{
				url:SITE_URL+"index.php?file=or-aj_chkdupdata",
                  type:"get",
                  data:{
							val:function() {
								return $("#iAsociationID").val();
							},
							id:function() {
								return "iAsociationID";
							},
							field:function() {
								return "vAssociationCode";
							},
							table:function() {
								return "{/literal}{$PRJ_DB_PREFIX}{literal}_organization_association";
							}
						}
				}
			}
		},
		messages:{
         "Data[vAssociationCode]": {
				remote: jQuery.validator.format(LBL_ASSOCIATION_CODE_IN_USE)
			}
		}
	});
}
else {
	$("#frmcreateassocs").validate();
}
function submitfrm()
{
	asorgs = $('input[name="assocorgs\[\]"]')
     if(view == 'edit') {
          $('#frmcreateassocs').submit();
     } else {
         if(asorgs.length == 0)
			{
				$('#assocs').attr('innerHTML','<font color="red">'+LBL_NO_ASSOCIATIONS_CREATED+'</font>');
				return false;
			}
			$('#frmcreateassocs').submit();
     }
}

function resetform() {
	$('#frmcreateassocs')[0].reset();
}
var rex = '';
function ajresp (resp) {
   if(resp=='exists') {
      rex = 'y';
   } else {
      rex = 'n';
   }
   $('#prc').hide();
}
$(document).ready( function() {
	$(function() {
		$('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15});
	});

	$('#insert_btn').click( function () {
    orgs = $('input:checkbox[name="orgid\[\]"]');
	// chkorg = $('input:checked[name="orgid\[\]"]');
	 if(orgs.length <1 && $('#vm').val()!=LBL_SELECT_SELLER_ORG) {
		alert(LBL_SELECT_SELLER_ORG);
		$('#vm').val(LBL_SELECT_SELLER_ORG);
	 } else {
		$('#vm').val('');
	 }
    $.each(orgs, function (ln,el) {
       if($(this).attr('checked') == true) {
          var id = $(this).attr('id');
          var orId = $(this).val();
          var assocCode = $('#vAssociationCode'+orId+'').val();
				if($.trim(assocCode) == '' && $('#vms').val()!=LBL_ENTER_SUPPLIER_ASSOCIATION_CODE)
				{
					alert(LBL_ENTER_SUPPLIER_ASSOCIATION_CODE);
					$('#vms').val(LBL_ENTER_SUPPLIER_ASSOCIATION_CODE);
					$('#vAssociationCode'+orId+'').focus();
					return false;
				} else if($.trim(assocCode) == '') {
					$('#vms').val('');
					return false;
				} else {
					$('#vms').val('');
				}
				var orName = $('#cmpname'+orId+'').val();
				var orCode = $('#cmporgcode'+orId+'').val();
               var chkvalue = 0;
               var url = SITE_URL+"index.php?file=or-aj_chkdupascode";
               var pars = "&borgid="+$('#iBuyerOrganizationID').val()+"&ascode="+assocCode;    // http://192.168.33.200/B2B/index.php?file=u-aj_polist_a&borgid=29&ascode=2
               // alert(url+pars);
               $('#prc').show();
               $.ajax({type:"POST", url:url, data:pars, async:false, success:ajresp});
               if(rex=='y') {
                  alert(LBL_SUPPLIER_ASSOCIATION_CODE+' "'+assocCode+'" '+LBL_IS_ALREADY_IN_USE);
                  return false;
               }
				asorgs = $('input[name="assocorgs\[\]"]');
                
				if(asorgs.length > 0) {
					var ciu = 'n';
					$.each(asorgs,function() {
						if($('#assocCode'+$(this).val()).val()==assocCode) {
							ciu = 'y';
							alert(LBL_SUPPLIER_ASSOCIATION_CODE+' "'+assocCode+'" '+LBL_IS_ALREADY_IN_USE);
							return false;
						}
                         if($(this).val() == orId) {
                              var sellcode = $('#vAssociationCode'+orId+'').val();
                              $('#sellcode'+orId+'').attr('innerHTML',sellcode);
                              $('#assocCode'+orId+'').val(sellcode);
                            chkvalue++;
                            $('#btnSubmit').show();
                         }
					});
					if(chkvalue==0 && ciu=='n') {
                    //alert('yrs');
						  $('#assocs').append('<div id="asso'+orId+'" style="background:#efecfe;"><img src="'+SITE_IMAGES+'arrow.gif" /> &nbsp; <span style="display:inline-block; width:430px;"><b>(<span id="'+'sellcode'+orId+'">' + assocCode + '</span>) &nbsp; ' + '[Seller Organization: ' + orName + '(' + orCode + ')' + ']</b> &nbsp;</span> <span><img src="'+SITE_IMAGES+'sm_images/icon-cancel.gif" onclick="delasso('+orId+');" /></span>' + '<input type="hidden" name="assocorgs[]" id="assocorgs'+orId+'" value="'+orId+'" /> <input type="hidden" name="suporgcode[]" id="suporgcode'+orId+'" value="'+orCode+'" /> <input type="hidden" name="assocCode[]" id="assocCode'+orId+'" value="'+assocCode+'" /> ' + '<div>');
						  $('#btnSubmit').show();
                }
            } else if(ciu!='y') {
					$('#assocs').attr('innerHTML','');
               // $('#tAssocs').append($("<option></option>").attr("value",''+orId+'').attr('selected','selected').text(''+assocName+''));
					// $('#assocs').append('<div id="asso'+orId+'"><img src="'+SITE_IMAGES+'arrow.gif" /> &nbsp; <b>' + assocName + '(' + assocCode + ') &nbsp; ' + '[Seller Organization: ' + orName + '(' + orCode + ')' + ']</b> &nbsp; <img src="'+SITE_IMAGES+'sm_images/icon-cancel.gif" onclick="delasso('+orId+');" />' + '<input type="hidden" name="assocorgs[]" id="assocorgs'+orId+'" value="'+orId+'" />' + '<div>');
					$('#assocs').append('<div id="asso'+orId+'"><img src="'+SITE_IMAGES+'arrow.gif" /> &nbsp; <span style="display:inline-block; width:430px;"><b>(<span id="'+'sellcode'+orId+'">' + assocCode + '</span>) &nbsp; ' + '[Seller Organization: ' + orName + '(' + orCode + ')' + ']</b> &nbsp;</span> <span><img src="'+SITE_IMAGES+'sm_images/icon-cancel.gif" onclick="delasso('+orId+');" /></span>' + '<input type="hidden" name="assocorgs[]" id="assocorgs'+orId+'" value="'+orId+'" /> <input type="hidden" name="suporgcode[]" id="suporgcode'+orId+'" value="'+orCode+'" /> <input type="hidden" name="assocCode[]" id="assocCode'+orId+'" value="'+assocCode+'" />' + '<div>');
					$('#btnSubmit').show();
            }
        }
    });
	});
});
</script>
{/literal}

{if $msg neq ''}
{literal}
<script>
$(document).ready(function() {
	var msg='{/literal}{$msg}{literal}';
	if(msg!= '' && msg != undefined && $('m').val()!=msg) {
		alert(msg);
		$('m').val(msg);
	}
});
</script>
{/literal}
{/if}