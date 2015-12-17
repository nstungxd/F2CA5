<form name="frmcreateassocs" id="frmcreateassocs" action="{$SITE_URL}index.php?file=or-createassociation_a" method="post">
<input type="hidden" name="iAsociationID" id="iAsociationID"value="{$iAsociationID}" />
<input type="hidden" name="view" id="view" value="{$view}" />
<input type="hidden" name="status" id="status" value="{$status}" />
<div class="middle-container">
<h1>{$LBL_ASSOCIATION_VIEW}</h1>
<div class="middle-containt">
	<div class="statistics-main-box-white">
		<div>
			<ul id="inner-tab">
				<li><a class="current"><EM>{$LBL_ASSOCIATION}</EM></a></li>
		   </ul>
      </div>
		<div class="clear"></div>
		<div class="inner-gray-bg">
				{if $msg neq '' && $vrf eq 'y'}
					<div class="msg">{$msg}</div>
				{/if}
			<div>&nbsp;</div>
			<div><span style="float:right;"><b><a class="" href="javascript:openpopup('{$SITE_URL_DUM}asocviewhistory/{$iAsociationID}')" >{$LBL_VIEW_HISTORY}</a></b></span></div>
			<div>
				<table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
				  <tr>
					 <td width="160" valign="top">{$LBL_ASSOCIATION_CODE} </td>
                          <td valign="top">:</td>
					 <td>
						<table width="486" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							 <td height="20">
								{$assorgdt[0].vAssociationCode}
							 </td>
						  </tr>
						</table>
					</td>
					</tr>
				  <tr>
					 <td width="160" valign="top">{$LBL_BUYER_ORG} </td>
                          <td valign="top">:</td>
					 <td>
						<table width="486" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							 <td height="20">
								{$assorgdt[0].vBuyerOrg}
							 </td>
						  </tr>
						</table>
					</td>
					</tr>
                         <tr>
						<td valign="top">{$LBL_BUY_CODE} </td>
                              <td valign="top">:</td>
						 <td>
							<table width="550" border="0" cellspacing="0" cellpadding="0">
							  <tr>
								 <td height="30" valign="top">
									{$assorgdt[0].vBuyerCode}
								 </td>
							  </tr>
							</table>
						</td>
					</tr>
					<tr>
						<td valign="top">{$LBL_SUPPLIER_ORGS} </td>
                  <td valign="top">:</td>
						 <td>
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
							  <tr>
								 <td height="30" valign="top">
								 {assign var='chkCount' value=0}
                           {section name=i loop=$assorgdt}
										{if $assorgdt[i].vsh eq 'Yes' && $verify eq 'yes'} {*}&& $assorgdt[i].eStatus != 'Delete'{*}
                                 <span style="float:right;">Reason to Reject: <input name="tReasonToReject[{$assorgdt[i].iAsociationID}]" style="width:190px;" /></span>
											  <input type="checkbox" value="{$assorgdt[i].iAsociationID}" name="vSupplierOrg[]" onclick="countUnchecked('');"/>
											  {$assorgdt[i].vSupplierOrg} ({$assorgdt[i].vSupplierCode}) [{$assorgdt[i].eStatus}]
											  {assign var='chkCount' value=$chkCount+1}
											  <br />
                                   <br />
										{else} {*}if $assorgdt[i].eStatus neq 'Need to Verify' && $assorgdt[i].eStatus neq 'Inactive'{*}
										 <img src="{$SITE_IMAGES}arrow.gif" />&nbsp;&nbsp;&nbsp;{$assorgdt[i].vSupplierOrg} ({$assorgdt[i].vSupplierCode}) {if $assorgdt[i].vsh eq 'Yes' || $verify eq 'yes'}[{$assorgdt[i].eStatus}]{*else}[{$assorgdt[i].eStatus}]{*}{/if}
										 {if $vassorgdt[i].iRejectedById gt 0 && $vassorgdt[i].tReasonToReject|trim neq ''}
											&nbsp; [Reason To Reject: {$vassorgdt[i].tReasonToReject|trim}]
										 {/if}
										 <br />
                               <br />
										{/if}
								 {/section}
									{if $Oassorgdt|is_array && $Oassorgdt|@count gt 0 && $asvf_len gt 0}
									{section name=i loop=$Oassorgdt}
										{if !($Oassorgdt[i].iAsociationID|in_array:$asvrfy)}
										<img src="{$SITE_IMAGES}arrow.gif" />&nbsp;&nbsp;&nbsp;{$Oassorgdt[i].vSupplierOrg} ({$Oassorgdt[i].vSupplierCode}) {*}[{$Oassorgdt[i].eStatus}]{*}
										{if $vassorgdt[i].iRejectedById gt 0 && $vassorgdt[i].tReasonToReject|trim neq ''}
											&nbsp; [Reason To Reject: {$vassorgdt[i].tReasonToReject|trim}]
										{/if}
										<br />
                              <br />
										{/if}
								 {/section}
								 {/if}
                              <div id="toolmsg" class="err"></div>
								 </td>
							  </tr>
							</table>
						</td>
					</tr>
					<tr>
						<td valign="top">&nbsp;</td>
						<td colspan="3" valign="top">
							{if $verify eq 'yes'}
							<a href="{$SITE_URL_DUM}verifyassociationlist">
							{else}
							<a href="{$SITE_URL_DUM}associationlist">
							{/if}
							<img src="{$SITE_IMAGES}sm_images/btn-back.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" /></a>
							{if $verify eq 'yes'}
								<img src="{$SITE_IMAGES}sm_images/btn-verify.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="return countUnchecked('verify');" />
                        <img src="{$SITE_IMAGES}sm_images/btn-reject.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="return countUnchecked('reject');" />
							{/if}
							<span style="float:right;">&nbsp;
							{if $Oassorgdt[0].eStatus eq 'Modified'}
							{*if $verify eq 'yes'*}
								<a class="colorbox" href="{$SITE_URL_DUM}index.php?file=or-aj_assocoverview&id={$OiAsociationID}" onmouseover="CallColoerBox(this.href,500,300,'file');">Click Here to view Original</a>
							{/if}
						</span>
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

{literal}
<script type="text/javascript">
function countUnchecked(vl) {
	var n = $("input:checked[name='vSupplierOrg\[\]']").length;
	if(n<1) {
		$('#toolmsg').attr('innerHTML',LBL_SELECT_ONE_SUP_ORG);
		return false;
	} else {
		$('#toolmsg').attr('innerHTML','');
		$('#view').val(vl);
		if($.trim(vl) != '') {
			$('#frmcreateassocs').submit();
		}
		return true;
	}
}
</script>
{/literal}