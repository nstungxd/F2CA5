<table width="100%" border="0" cellspacing="0" cellpadding="0">
	{section name=i loop=$dtls}
	{if $smarty.section.i.index % 2 eq 0}
		{assign var="rowclass" value="golden"}
	{else}
		{assign var="rowclass" value=""}
	{/if}
   <tr class="{$rowclass}">
      <td width="115" height="27" align="left">&nbsp;
			{if $usertype neq 'orgadmin'}
				<input type="checkbox" class="radib-btn" name="iRFQ2Id[]" id="iRFQ2Id" style="vertical-align:middle;" value="{$dtls[i].iRFQ2Id}" />
			{/if}
			{$dtls[i].vRFQ2Code}
		</td>
		{*<td width="95" align="left">{$dtls[i].vInvoiceCode}</td>*}
		<td width="70" align="left">{$dtls[i].fAcceptedAmount}</td>
		<td width="90" align="left">{$dtls[i].vProductName}</td>
		<td width="90" align="left">{$dtls[i].vBuyerName}</td>
		<td width="90" align="left">{$dtls[i].vSupplierName}</td>
      <td width="40" align="center">{$dtls[i].eAuctionType|substr:0:1|strtoupper}</td>
		<td width="30" align="center">{$dtls[i].eBidCriteria}</td>
		{*<td width="70" align="center">{$dtls[i].dStartDate|calcLTzTime|DateTime:10}</td>*}
		{*<td width="70" align="center">{if $dtls[i].rdays>0 || $dtls[i].rtime>0}{if $dtls[i].rdays>0}{$dtls[i].rdays}d{/if} {if $dtls[i].rtime>0}{$dtls[i].rtime}{/if}{else}0{/if}</td>*}
                <td width="70" align="center">{if $dtls[i].rdays>0 || ($dtls[i].rtime neq '' && $dtls[i].rtime neq '0')}{if $dtls[i].rdays>0}{$dtls[i].rdays}d{/if}{if $dtls[i].rtime neq '' && $dtls[i].rtime neq '0'}{$dtls[i].rtime}{/if}{else}0{/if}</td>                
		<td width="70" align="center">A:{$dtls[i].fBestBidAdvance|number_format:2:'.':','}, P:{$dtls[i].fBestBidPrice|number_format:2:'.':','}</td>
		<td width="63" align="center">{$dtls[i].totbid}</td>
      <td width="70" align="center">
			{if $dtls[i].eSaved eq 'Yes'}
				{$LBL_SAV}
			{elseif $dtls[i].eDelete eq 'Yes'}
				{$LBL_DELETE}
			{elseif $dtls[i].eStatus eq 'Not Started'}
				{$LBL_NOT_STARTED}
			{elseif $dtls[i].eStatus eq 'LIVE'}
				{$LBL_LIVE}
			{elseif $dtls[i].eStatus eq 'Completed'}
				{$LBL_COMPLETED}
			{elseif $dtls[i].eStatus eq 'Cancelled'}
				{$LBL_CANCELLED}
			{else}
				{$dtls[i].eStatus}
			{/if}
		</td>
      <td width="50" align="center">
			<a href="{$SITE_URL_DUM}b2rfq2view/{$dtls[i].iRFQ2Id}"><img src="{$SITE_IMAGES}bid.png"  alt="" height="27px;" border="0" style="vertical-align:middle;" /></a>&nbsp;
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