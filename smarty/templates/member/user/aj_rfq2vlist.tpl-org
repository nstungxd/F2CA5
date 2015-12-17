<table width="100%" border="0" cellspacing="0" cellpadding="0">
	{section name=i loop=$dtls}
	{if $smarty.section.i.index % 2 eq 0}
		{assign var="rowclass" value="golden"}
	{else}
		{assign var="rowclass" value=""}
	{/if}
   <tr class="{$rowclass}">
      <td width="95" height="27" align="left">&nbsp;
			{*if $usertype neq 'orgadmin'}
				<input type="checkbox" class="radib-btn" name="iRFQ2Id[]" id="iRFQ2Id" style="vertical-align:middle;" value="{$dtls[i].iRFQ2Id}" />
			{/if*}
			{$dtls[i].vRFQ2Code}
		</td>
		{*<td width="95" align="left">{$dtls[i].vInvoiceCode}</td>*}
		<td width="100" align="left">{$dtls[i].vProductName}</td>
		<td width="100" align="left">{$dtls[i].vBuyerName}</td>
		<td width="100" align="left">{$dtls[i].vSupplierName}</td>
      <td width="30" align="center">{$dtls[i].eAuctionType|substr:0:1|strtoupper}</td>
		<td width="70" align="center">{$dtls[i].eBidCriteria}</td>
		<td width="90" align="center">{if $dtls[i].rdays>0 || $dtls[i].rtime>0}{if $dtls[i].rdays>0}{$dtls[i].rdays}d{/if} {if $dtls[i].rtime>0}{$dtls[i].rtime}{/if}{else}0{/if}</td>
		<td width="70" align="center">
			{if $dtls[i].eSaved eq 'Yes'}
				{$LBL_SAV}
			{elseif $dtls[i].eStatus eq 'Create'}
				{$LBL_CREATE}
			{elseif $dtls[i].eStatus eq 'Rejected'}
				{$LBL_REJECTED}
			{elseif $dtls[i].eStatus eq 'Verify'}
				{$LBL_VERIFIED}
			{else}
				{$dtls[i].eStatus}
			{/if}
		</td>
      <td width="70" align="center">
			<a href="{$SITE_URL_DUM}rfq2view/{$dtls[i].iRFQ2Id}"><img src="{$SITE_IMAGES}sm_images/icon-edit.gif"  alt="" border="0" style="vertical-align:middle;" /></a>&nbsp;
			{*if $usertype neq 'orgadmin'}
				{if $dtls[i].eDelete neq 'Yes'}
					<a onclick="status('delete','{$dtls[i].iRFQ2Id}');"><img src="{$SITE_IMAGES}sm_images/icon-delete.gif"  alt="" border="0" style="vertical-align:middle; cursor:pointer;" /></a>
				{else}
					<span>&nbsp;</span>
				{/if}
			{/if*}
        </td>
   </tr>
   {/section}
</table>
<input type="hidden" name="pg" id="pg" value=""/>
<input type="hidden" name="enc" id="enc" value="n" />
<div class="pagging-bg">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			{if $count eq 0}
				<td align="center" height="27">{$pgmsg}</td>
			{else}
				<td align="left" height="27">{$pgmsg}</td>
			{/if}
			<td align="right"  class="detail-graybg" style="padding-right:10px;">&nbsp;{$paging}&nbsp;</td>
		</tr>
	</table>
</div>