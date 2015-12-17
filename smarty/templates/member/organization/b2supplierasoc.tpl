<div class="middle-container">
<h1>{$LBL_CREATE_ASSOCIATION}</h1>
<div class="middle-containt">
	<div class="statistics-main-box-white">
		<div>
			<ul id="inner-tab">
				<li><a class="current"><em>{$LBL_BUYER2_SUPPLIER} {$LBL_ASSOCIATION}</em></a></li>
		   </ul>
      </div>
		<div class="clear"></div>
		{if $arr[0].tReasonToReject|trim neq ''}
			<div class="inner-gray-bg" style="height:490px;"> {*} style="height:430px;" {*}
		{else}
			<div class="inner-gray-bg" style="height:450px;"> {*} style="height:430px;" {*}
		{/if}
      <form id="frmadd" name="frmadd" method="post" action="{$SITE_URL}index.php?file=or-b2supplierasoc_a">
         <input type="hidden" id="mod" name="mod" value="{$mod}" />
         <input type="hidden" id="admr" name="admr" value="" />
         <input type="hidden" id="iAssociationId" name="iAssociationId" value="{$iAssociationId}" />
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
					{if $uorg_type!='Buyer2'}
					<tr>
						<td>{$LBL_SEARCH} {$LBL_BUYER2} : </td>
						<td>
							<input type="text" class="ttp" id="b2nm" name="b2nm" value="{$post_data.b2nm}" class="input-rag" style="width:143px; height:17px; vertical-align:middle;" title="{$LBL_NAME}" />&nbsp;
							<input type="text" class="ttp" id="b2cd" name="b2cd" value="{$post_data.b2cd}" class="input-rag" style="width:143px; height:17px; vertical-align:middle;" title="{$LBL_CODE}" />&nbsp;
							<span class="btllbl" style="height:17px;"><b onclick="getBuyer2Combo('');">{$LBL_SEARCH}</b></span>
							&nbsp; [{$MSG_CAN_USE_WILD_CHAR|stripslashes}]
						</td>
					</tr>
					{/if}
               <tr>
                  <td width="190px" valign="top">{$LBL_SELECT} {$LBL_BUYER2}&nbsp;<font class="reqmsg">*</font> : </td>
                  <td>
							{if $uorg_type!='Buyer2'}
   						<span id="b2org" style="float:left;">
   							<select name="Data[iBuyer2Id]" id="iBuyer2Id" style="width:300px;" class="required" title="{$LBL_SELECT} {$LBL_BUYER2}" onchange="return ps();">
   								<option value="">---{$LBL_SELECT} {$LBL_BUYER2}---</option>
                           {if $arr[0].iBuyer2Id>0}
                              <option value="{$arr[0].iBuyer2Id}" selected="selected">{$arr[0].vBuyer2}</option>
                           {/if}
   							</select>
   						</span>
   						<span style="float:right; padding-right:70px;">
                        {$LBL_FILTER_LIST_BY} : <input type="text" name="b2filter" id="b2filter" style="width:100px;" />
                     </span>
							{else}
							<span id="b2org" style="float:left;"><input type="hidden" name="iBuyer2Id" id="iBuyer2Id" style="width:300px;" title="{$LBL_BUYER2}" value="{$arr[0].iBuyer2Id}"><b>{$arr[0].vBuyer2} ({$arr[0].vB2Code})</b></span>
							{/if}
                  </td>
				  	</tr>
					<tr><td colspan="2">&nbsp;</td></tr>
					<tr class="prs" style="display:none;">
						<td>{$LBL_SEARCH} {$LBL_SUPPLIER} :</td>
						<td>
							<input type="text" class="ttp" id="bnm" name="bnm" value="{$post_data.bnm}" class="input-rag" style="width:143px; height:17px; vertical-align:middle;" title="{$LBL_NAME}" />&nbsp;
							<input type="text" class="ttp" id="bcd" name="bcd" value="{$post_data.bcd}" class="input-rag" style="width:143px; height:17px; vertical-align:middle;" title="{$LBL_CODE}" />&nbsp;
							<span class="btllbl" style="height:17px;"><b onclick="getSupplierCombo('{$arr[0].iSupplierId}');">{$LBL_SEARCH}</b></span>
							&nbsp; [{$MSG_CAN_USE_WILD_CHAR|stripslashes}]
						</td>
					</tr>
               <tr>
                  <td width="190px" valign="top">{$LBL_SELECT} {$LBL_SUPPLIER}&nbsp;<font class="reqmsg">*</font> : </td>
                  <td>
   						<span id="sprdt" style="float:left;">
   							<select name="Data[iSupplierId]" id="iSupplierId" style="width:300px;" class="required" title="{$LBL_SELECT} {$LBL_SUPPLIER}">
   								<option value="">---{$LBL_SELECT} {$LBL_SUPPLIER}---</option>
                           {if $arr[0].iSupplierId>0}
                              <option value="{$arr[0].iSupplierId}" selected="selected">{$arr[0].vSupplier}</option>
                           {/if}
   							</select>
   						</span>
   						<span class="prs" style="float:right; padding-right:70px; display:none;">
                        {$LBL_FILTER_LIST_BY} : <input type="text" name="sfilter" id="sfilter" style="width:100px;" />
                     </span>
                  </td>
				  	</tr>
					<tr><td colspan="2">&nbsp;</td></tr>
               <tr>
                  <td valign="top">{$LBL_ACCOUNT}1&nbsp;<font class="reqmsg">*</font> : </td>
                  <td><input type="text" id="vAccount1" name="Data[vAccount1]" value="{$arr[0].vAccount1}" class="required" style="width:270px;" title="{$LBL_ENTER} {$LBL_ACCOUNT}1"/></td>
               </tr>
					<tr>
                  <td valign="top">{$LBL_ACCOUNT}1 {$LBL_CODE} <font class="reqmsg">*</font> : </td>
                  <td><input type="text" id="vAcc1Code" name="Data[vAcc1Code]" value="{$arr[0].vAcc1Code}" class="required" style="width:270px;" title="{$LBL_ENTER} {$LBL_ACCOUNT}1 {$LBL_CODE}"/></td>
               </tr>
					<tr>
                  <td valign="top">{$LBL_CURRENCY}1&nbsp;<font class="reqmsg">*</font> : </td>
                  <td>
							<select name="Data[vCurrency1]" id="vCurrency1" style="width:100px;" class="required" title="{$LBL_SELECT} {$LBL_CURRENCY}1">
								{section name="l" loop=$currency}
								<option value="{$currency[l].vCode}" {if $currency[l].vCode eq $arr[0].vCurrency1}selected="selected"{/if}>{$currency[l].vCode}</option>
								{/section}
							</select>
						</td>
               </tr>
               <tr>
                  <td valign="top">{$LBL_ACCOUNT}2 : </td>
                  <td><input type="text" id="vAccount2" name="Data[vAccount2]" value="{$arr[0].vAccount2}" class="" style="width:270px;" title="{$LBL_ENTER} {$LBL_ACCOUNT}2"/></td>
               </tr>
					<tr>
                  <td valign="top">{$LBL_ACCOUNT}2 {$LBL_CODE} : </td>
                  <td><input type="text" id="vAcc2Code" name="Data[vAcc2Code]" value="{$arr[0].vAcc2Code}" class="" style="width:270px;" title="{$LBL_ENTER} {$LBL_ACCOUNT}2 {$LBL_CODE}"/></td>
               </tr>
					<tr>
                  <td valign="top">{$LBL_CURRENCY}2&nbsp; : </td>
                  <td>
							<select name="Data[vCurrency2]" id="vCurrency2" style="width:100px;" class="required">
								{section name="l" loop=$currency}
								<option value="{$currency[l].vCode}" {if $currency[l].vCode eq $arr[0].vCurrency2}selected="selected"{/if}>{$currency[l].vCode}</option>
								{/section}
							</select>
						</td>
               </tr>
               {if $arr[0].tReasonToReject|trim neq ''}
               <tr>
                  <td valign="top">{$LBL_REASON_TO_REJECT}8 : </td>
                  <td><div style="word-wrap:break-word; width:390px; height:70px; border:1px solid #cccccc; overflow:scroll;">{$arr[0].tReasonToReject}</div></td>
               </tr>
               {/if}
               {*<tr><td colspan="2">&nbsp;</td></tr>*}
					<tr>
						<td valign="top">&nbsp;</td>
						<td>
                     <span class="btllbl" style=""><b id="btnSubmit" onclick="return submitfrm('');">{$LBL_SUBMIT}</b></span>
                     <span class="btllbl" style=""><b id="btnSubmit" onclick="return submitfrm('admr');">{$LBL_SAVE_AND_ADDMORE}</b></span>
						</td>
					</tr>
				</table>
			</div>
			<div>&nbsp;</div>
         </form>
		</div>
	</div>
</div>
</div>

<script type="text/javascript" src="{$S_JQUERY}jquery.listboxfilter.js" ></script>
<script type="text/javascript" src="{$S_JQUERY}jquery.validate.js" ></script>
<script type="text/javascript" src="{$SITE_JS_AJAX}jb2supplierasoc.js"></script>
{literal}
<script type="text/javascript">
function ps()
{
   if($('#iBuyer2Id').val()!='') {
      $('.prs').show();
   }
}
ps();
$('#frmadd').validate({
   ignore: ':hidden',
   rules: {
      "Data[iSupplierId]": {
         remote: {
   			url: SITE_URL+"index.php?file=or-aj_chkdupdata",
            type: "get",
            data: {
   				val:function() {
   					return $("#iAssociationId").val();
   				},
   				id:function() {
   					return "iAssociationId";
   				},
   				field:function() {
   					return "iSupplierId";
   				},
               chkf: function () {
                  return "iBuyer2Id";
               },
               chkfvl: function () {
                  return $("#iBuyer2Id").val();
               },
					extc: function () {
                  return " AND NOT (eStatus='Delete' AND eNeedToVerify='No')";
               },
   				table:function() {
   					return "{/literal}{$PRJ_DB_PREFIX}{literal}_buyer2_supplier_association";
   				}
   			}
   		}
      }
   },
   messages: {
      "Data[iSupplierId]": {
         remote: jQuery.validator.format(LBL_SUPPLIER_ALREADY_INASSOCIATION_WITH_SELECTED_BUYER2)
      }
   }
});

function submitfrm(vl)
{
   var vldfrmdt = $('#frmadd').valid();
   $(document).ready(function() {
     $(function() {
        var ead=130;
        $('div.inner-gray-bg').css('height', parseInt($('div.inner-gray-bg').css('height').replace('px',''))+130);
        $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
     });
   });
   if(!vldfrmdt) {
      return false;
   }
   $('#admr').val(vl);
   $('#frmadd')[0].submit();
}

$(document).ready(function() {
	$("#b2filter").bigoFilter("#iBuyer2Id", {property: 'text'});
	$("#sfilter").bigoFilter("#iSupplierId", {property: 'text'});
	
   $('.ttp').blur(function() {
      if($.trim($(this).val())=='') {
         $(this).val($(this).attr('title'));
      }
   });
   $('.ttp').focus(function() {
      if($.trim($(this).val())==$(this).attr('title')) {
         $(this).val('');
      }
   });
   $.each($('.ttp'), function(i,el) {
      if($.trim($(this).val())=='') {
         $(this).val($(this).attr('title'));
      }
   });
   //
});
</script>
{/literal}
{if $msg neq ''}
{literal}
<script type="text/javascript" async="async" defer="defer">
$(document).ready(function() {
	var msg = '{/literal}{$msg}{literal}';
   if(msg!= '') { alert(msg); }
});
</script>
{/literal}
{/if}
{if $arr[0].iBuyer2Id>0 && ($post_data.bnm|trim neq '' || $post_data.bcd|trim neq '')}
{literal}<script type="text/javascript">getSupplierCombo('');</script>{/literal}
{/if}