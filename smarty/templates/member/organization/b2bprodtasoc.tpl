<div class="middle-container">
<h1>{$LBL_CREATE_ASSOCIATION}</h1>
<div class="middle-containt">
	<div class="statistics-main-box-white">
      <div>
         <ul id="inner-tab"><li><a class="current"><em>{$LBL_BUYER2_BPRODUCT} {$LBL_ASSOCIATION}</em></a></li></ul>
      </div>
      <div class="clear"></div>
      {if $arr[0].tReasonToReject|trim neq ''}
			<div class="inner-gray-bg" style="height:690px;"> {*} style="height:430px;" {*}
		{else}
			<div class="inner-gray-bg" style="height:670px;"> {*} style="height:430px;" {*}
		{/if}
      <div>&nbsp;</div>
      <form id="frmadd" name="frmadd" method="post" action="{$SITE_URL}index.php?file=or-b2bprodtasoc_a">
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
					{if $uorg_type != 'Buyer2'}
					<tr>
						<td>{$LBL_SEARCH} {$LBL_BUYER2} :</td>
						<td>
							<input type="text" class="ttp" id="b2nm" name="b2nm" value="{$post_data.bnm}" class="input-rag" style="width:143px; height:17px; vertical-align:middle;" title="{$LBL_NAME}" />&nbsp;
							<input type="text" class="ttp" id="b2cd" name="b2cd" value="{$post_data.b2cd}" class="input-rag" style="width:143px; height:17px; vertical-align:middle;" title="{$LBL_CODE}" />&nbsp;
							<span class="btllbl" style="height:17px;"><b onclick="getBuyer2Combo('');">{$LBL_SEARCH}</b></span>
							&nbsp; [{$MSG_CAN_USE_WILD_CHAR|stripslashes}]
						</td>
					</tr>
					{/if}
               <tr>
                  <td width="190px" valign="top">{$LBL_SELECT} {$LBL_BUYER2}&nbsp;<font class="reqmsg">*</font> : </td>
                  <td>
							{if $uorg_type != 'Buyer2'}
							<span id="b2org" style="float:left;">
   							<select name="Data[iBuyer2Id]" id="iBuyer2Id" style="width:300px;" class="required" title="{$LBL_SELECT} {$LBL_BUYER2}" onchange="return ps();">
   								<option value="">---{$LBL_SELECT} {$LBL_BUYER2}---</option>
                           {if $arr[0].iBuyer2Id>0}
                              <option value="{$arr[0].iBuyer2Id}" selected="selected">{$arr[0].vBuyer2} ({$arr[0].vB2Code})</option>
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
						<td>{$LBL_SEARCH} {$LBL_BPRODUCT} :</td>
						<td>
							<input type="text" class="ttp" id="pnm" name="pnm" value="{$post_data.pnm}" class="input-rag" style="width:143px; height:17px; vertical-align:middle;" title="{$LBL_NAME}" />&nbsp;
							<input type="text" class="ttp" id="pcd" name="pcd" value="{$post_data.pcd}" class="input-rag" style="width:143px; height:17px; vertical-align:middle;" title="{$LBL_CODE}" />&nbsp;
							<span class="btllbl" style="height:17px;"><b onclick="getBProductCombo('{$arr[0].iProductId}');">{$LBL_SEARCH}</b></span>
							&nbsp; [{$MSG_CAN_USE_WILD_CHAR|stripslashes}]
						</td>
					</tr>
               <tr>
                  <td width="190px" valign="top">{$LBL_SELECT} {$LBL_BPRODUCT}&nbsp;<font class="reqmsg">*</font> : </td>
                  <td>
   						<span id="bprdt" style="float:left;">
   							<select name="Data[iProductId]" id="iProductId" style="width:300px;" class="required" title="{$LBL_SELECT} {$LBL_BPRODUCT}">
   								<option value="">---{$LBL_SELECT} {$LBL_BPRODUCT}---</option>
                           {if $arr[0].iProductId>0}
                              <option value="{$arr[0].iProductId}" selected="selected">{$arr[0].vProduct} ({$arr[0].vProductCode})</option>
                           {/if}
   							</select>
   						</span>
   						<span class="prs" style="float:right; padding-right:70px; display:none;">
                        {$LBL_FILTER_LIST_BY} : <input type="text" name="bpfilter" id="bpfilter" style="width:100px;" />
                     </span>
                  </td>
				  	</tr>
					<tr><td colspan="2"><span style="float:right; padding-right:70px;"><a class="opnprdtls" style="cursor:pointer;">{$LBL_VIEW} {$LBL_PRODUCT} {$LBL_DETAILS}</a></span></td></tr>
               <tr>
                  <td valign="top">{$LBL_GLOBAL_LIMIT}&nbsp;<font class="reqmsg">*</font> : </td>
                  <td><input type="text" id="fGlobalLimit" name="Data[fGlobalLimit]" value="{$arr[0].fGlobalLimit}" class="required decimals" style="width:270px;" maxlength="10" title="{$LBL_ENTER} {$LBL_GLOBAL_LIMIT}" /></td>
               </tr>
					{*<tr>
                  <td valign="top">{$LBL_OUTSTANDING_AMOUNT}&nbsp;<font class="reqmsg">*</font> : </td>
                  <td><input type="text" id="fOutstandingAmt" name="Data[fOutstandingAmt]" value="{$arr[0].fOutstandingAmt}" class="required decimals" style="width:270px;" maxlength="10" title="{$LBL_ENTER} {$LBL_OUTSTANDING_AMOUNT}" /></td>
               </tr>*}
               {*<tr>
                  <td valign="top">{$LBL_FEE} {$LBL_IN}&nbsp;</td>
                  <td>
                     <label><input type="radio" id="fee_type1" name="fee_type" value="percent" {if $arr[0].fFeePc>0}checked="checked"{/if} title="{$LBL_SELECT} {$LBL_FEE} {$LBL_IN}" /> {$LBL_PERCENT}</label> &nbsp;
                     <label><input type="radio" id="fee_type2" name="fee_type" value="value" {if $arr[0].fFeeFlat>0}checked="checked"{/if} title="{$LBL_SELECT} {$LBL_FEE} {$LBL_IN}" /> {$LBL_VALUE}</label>
                  </td>
               </tr>*}
               <tr class="fperc">
                  <td valign="top">{$LBL_FEE} (%)&nbsp;<font class="reqmsg">*</font> : </td>
                  <td><input type="text" id="fFeePc" name="Data[fFeePc]" value="{$arr[0].fFeePc}" class="required decimals" min="0" max="100" maxlength="6" style="width:270px;" title="{$LBL_ENTER} {$LBL_FEE}" /></td>
               </tr>
               <tr class="fval">
                  <td valign="top">{$LBL_FEE} &nbsp;<font class="reqmsg">*</font> : </td>
                  <td><input type="text" id="fFeeFlat" name="Data[fFeeFlat]" value="{$arr[0].fFeeFlat}" class="required decimals" maxlength="10" style="width:270px;" title="{$LBL_ENTER} {$LBL_FEE}" /></td>
               </tr>
               <tr>
                  <td valign="top">{$LBL_ADVANCE} (%)&nbsp;<font class="reqmsg">*</font> : </td>
                  <td><input type="text" id="fAdvancePc" name="Data[fAdvancePc]" value="{$arr[0].fAdvancePc}" class="required decimals" min="0" max="100" maxlength="6" style="width:270px;" title="{$LBL_ENTER} {$LBL_ADVANCE}" /></td>
               </tr>
               <tr>
                  <td valign="top">{$LBL_MINIMUM_VALUE}&nbsp;<font class="reqmsg">*</font> : </td>
                  <td><input type="text" id="fMinValue" name="Data[fMinValue]" value="{$arr[0].fMinValue}" class="required decimals" maxlength="10" style="width:270px;" title="{$LBL_ENTER} {$LBL_MINIMUM_VALUE}" /></td>
               </tr>
               <tr>
                  <td valign="top">{$LBL_MAXIMUM_VALUE}&nbsp;<font class="reqmsg">*</font> : </td>
                  <td><input type="text" id="fMaxValue" name="Data[fMaxValue]" value="{$arr[0].fMaxValue}" class="required decimals" maxlength="10" style="width:270px;" title="{$LBL_ENTER} {$LBL_MAXIMUM_VALUE}" /></td>
               </tr>
               <tr>
                  <td valign="top">{$LBL_NARRATIVE}&nbsp;<font class="reqmsg">*</font> : </td>
                  <td><textarea id="vNarrative" name="Data[vNarrative]" class="required" style="width:270px; height:70px;" title="{$LBL_ENTER} {$LBL_NARRATIVE}" >{$arr[0].vNarrative}</textarea></td>
               </tr>
               <tr>
                  <td valign="top">{$LBL_ACCOUNT}1&nbsp;<font class="reqmsg">*</font> : </td>
                  <td><input type="text" id="vAccount1" name="Data[vAccount1]" value="{$arr[0].vAccount1}" class="required" style="width:270px;" title="{$LBL_ENTER} {$LBL_ACCOUNT}1"/></td>
               </tr>
               <tr>
                  <td valign="top">{$LBL_ACCOUNT}2 : </td>
                  <td><input type="text" id="vAccount2" name="Data[vAccount2]" value="{$arr[0].vAccount2}" class="" style="width:270px;" title="{$LBL_ENTER} {$LBL_ACCOUNT}2"/></td>
               </tr>
               <tr>
                  <td valign="top">{$LBL_ACCOUNT}3 : </td>
                  <td><input type="text" id="vAccount3" name="Data[vAccount3]" value="{$arr[0].vAccount3}" class="" style="width:270px;" title="{$LBL_ENTER} {$LBL_ACCOUNT}3"/></td>
               </tr>
               <tr>
                  <td valign="top">{$LBL_ACCOUNT}4 : </td>
                  <td><input type="text" id="vAccount4" name="Data[vAccount4]" value="{$arr[0].vAccount4}" class="" style="width:270px;" title="{$LBL_ENTER} {$LBL_ACCOUNT}4"/></td>
               </tr>
               <tr>
                  <td valign="top">{$LBL_ACCOUNT}5 : </td>
                  <td><input type="text" id="vAccount5" name="Data[vAccount5]" value="{$arr[0].vAccount5}" class="" style="width:270px;" title="{$LBL_ENTER} {$LBL_ACCOUNT}5"/></td>
               </tr>
               <tr>
                  <td valign="top">{$LBL_ACCOUNT}6 : </td>
                  <td><input type="text" id="vAccount6" name="Data[vAccount6]" value="{$arr[0].vAccount6}" class="" style="width:270px;" title="{$LBL_ENTER} {$LBL_ACCOUNT}6"/></td>
               </tr>
               <tr>
                  <td valign="top">{$LBL_ACCOUNT}7 : </td>
                  <td><input type="text" id="vAccount7" name="Data[vAccount7]" value="{$arr[0].vAccount7}" class="" style="width:270px;" title="{$LBL_ENTER} {$LBL_ACCOUNT}7"/></td>
               </tr>
               <tr>
                  <td valign="top">{$LBL_ACCOUNT}8 : </td>
                  <td><input type="text" id="vAccount8" name="Data[vAccount8]" value="{$arr[0].vAccount8}" class="" style="width:270px;" title="{$LBL_ENTER} {$LBL_ACCOUNT}8"/></td>
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
							{*<img src="{$SITE_IMAGES}sm_images/btn-submit.gif" alt="" id="btnSubmit" border="0" style="cursor: pointer;vertical-align:middle;cursor:pointer;border:none;background: #f8f8f8;" onclick="return submitfrm();" /> &nbsp;*}
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

<script type="text/javascript" src="{$S_JQUERY}jquery.validate.js" ></script>
<script type="text/javascript" src="{$S_JQUERY}jquery.listboxfilter.js" ></script>
<script type="text/javascript" src="{$SITE_JS_AJAX}jb2bprdtasoc.js"></script>
{literal}
<script type="text/javascript">
function ps()
{
   if($('#iBuyer2Id').val()!='') {
      $('.prs').show();
   }
}
ps();
jQuery.validator.addMethod("lessthan", function(value, element, params)
{
	var val = element.value;
	var vl1 = parseFloat(value);
	var vl2 = parseFloat($(params).val());
	if(isNaN(parseFloat(vl1)) || isNaN(vl2)) {
		return true;
	}
	if(vl1 >= vl2) {
		return false;
	} else {
		return true;
	}
});
$('#frmadd').validate({
   ignore: ':hidden',
   rules: {
		/*"Data[fOutstandingAmt]": {
			lessthan: { param: '#fGlobalLimit' }
		},*/
      "Data[iProductId]": {
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
   					return "iProductId";
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
   					return "{/literal}{$PRJ_DB_PREFIX}{literal}_buyer2_bproduct_association";
   				}
   			}
   		}
      }
   },
   messages: {
      "Data[iProductId]": {
         remote: jQuery.validator.format(LBL_PRODUCT_ALREADY_INASSOCIATION_WITH_SELECTED_BUYER2)
      },
      "Data[fGlobalLimit]": {
         decimals: LBL_MUST_BE_NUMERIC
      },
      /*"Data[fOutstandingAmt]": {
			lessthan: LBL_MUSTBE_LESSTHAN_GLOBALLIMIT,
         decimals: LBL_MUST_BE_NUMERIC
      },*/
      "Data[fFeePc]": {
         decimals: LBL_MUST_BE_NUMERIC,
         max: LBL_PERCENT_MUST_NOT_EXCEED_100
      },
      "Data[fFeeFlat]": {
         decimals: LBL_MUST_BE_NUMERIC
      },
      "Data[fAdvancePc]": {
         decimals: LBL_MUST_BE_NUMERIC,
         max: LBL_PERCENT_MUST_NOT_EXCEED_100
      },
      "Data[fMinValue]": {
         decimals: LBL_MUST_BE_NUMERIC
      },
      "Data[fMaxValue]": {
         decimals: LBL_MUST_BE_NUMERIC
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
	$("#bpfilter").bigoFilter("#iProductId", {property: 'text'});
	
   function shfeeclick() {
      // if($(this).val()=='percent') {
		if($('#fee_type2').attr('checked')) {
         $('tr.fperc').hide();
         $('tr.fval').show();
         $('#fFeePc').val('');
      } else {
			$('tr.fval').hide();
         $('tr.fperc').show();
         $('#fFeeFlat').val('');
      }
   }
	// shfeeclick();
   // $('input[name="fee_type"]').click(shfeeclick);
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
	function opnPrdtls() {
		if($.trim($('#iProductId').val())=='' || parseInt($('#iProductId').val())<1) {
			return false;
		}
		var url = '{/literal}{$SITE_URL}{literal}bprodtls/'+$('#iProductId').val()+'/pop';
		openpopup(url);
	}
	$('.opnprdtls').click(opnPrdtls);
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
{if $arr[0].iBuyer2Id>0 && ($post_data.pnm|trim neq '' || $post_data.pcd|trim neq '')}
{literal}<script type="text/javascript">getBProductCombo('');</script>{/literal}
{/if}