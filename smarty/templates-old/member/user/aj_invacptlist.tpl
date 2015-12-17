<table width="100%" border="0" cellspacing="0" cellpadding="0">
      {section name=i loop=$activegroup}
      {if $smarty.section.i.index % 2 eq 0}
         {assign var="rowclass" value="golden"}
      {else}
         {assign var="rowclass" value=""}
      {/if}
      <tr class="{$rowclass}">
        <td width="190" height="26" > &nbsp;
		{if $usertype neq 'orgadmin'}
             <input type="checkbox" class="radib-btn" name="iInvoiceID[]" id="iInvoiceID" style="vertical-align:middle;" value="{$activegroup[i].iInvoiceID}" />
          {/if}
			{assign var="vinvnum" value="-"|str_replace:" - ":$activegroup[i].vInvoiceNumber}
         {*}{$vinvnum}
		  </td>
        <td width="107" >{*}&nbsp;{$activegroup[i].vInvSupplierCode}</td>
        <td width="67"  align="center">{$activegroup[i].fInvoiceTotal}</td>
        <td width="48" align="center">{$activegroup[i].iNetPaymentDays}</td>
        <td width="74" align="center">{$activegroup[i].dCreatedDate|calcLTzTime|DateTime:'10'}</td>
        {if $orgtype neq 'Supplier'}
        <td width="87" align="center">{$activegroup[i].vSupplierName}</td>
        {/if}
         <td width="77" align="center">{if $activegroup[i].vBuyerName|trim eq ''}---{else}{$activegroup[i].vBuyerName}{/if}</td>
         <td width="58" align="center">
				<b>
				{if $activegroup[i].eSaved eq 'Yes'}
					{$MSG_SAVED}
				{else}
					{if $activegroup[i].iaStatusID eq 0}
						{$LBL_NEED_TO_ACCEPT}
					{elseif $activegroup[i].status eq 'Rejected' and $activegroup[i].eDelete eq 'Yes'}
						{$LBL_DELETE}
					{else}
						{$activegroup[i].status|htmlentities}
					{/if}
			   {/if}
				</b>
			</td>
        <td width="74" align="center">
             {if $activegroup[i].status eq 'Rejected'}
                {assign var="ondelete" value="Delete('delete','"|cat:$activegroup[i].iInvoiceID|cat:"')"}
            {else}
                {assign var="ondelete" value="alert('$MSG_REJECTED_INVOICE_DEL')"}
            {/if}
				{if $activegroup[i].status eq 'Accepted'}
					<a title="{$LBL_PRINT}" style="cursor:pointer" class="colorboxfile" rel="{$activegroup[i].iInvoiceID}"><img src="{$SITE_IMAGES}report.png"  alt="" border="0" style="vertical-align:middle;" /></a>
			   {/if}
            <!-- <a href="#"><img src="{$SITE_IMAGES}sm_images/icon-pen.gif"  alt="" border="0" style="vertical-align:middle;" /></a> &nbsp; -->
             <a href="{$SITE_URL_DUM}invoiceview/{$activegroup[i].iInvoiceID}"><img src="{$SITE_IMAGES}sm_images/icon-edit.gif"  alt="" border="0" style="vertical-align:middle;" /></a> &nbsp;
             {*if $activegroup[i].eDelete neq 'Yes' && $activegroup[i].iSupplierOrganizationID eq $curORGID}
                <a onclick="{$ondelete}"><img src="{$SITE_IMAGES}sm_images/icon-delete.gif"  alt="" border="0" style="vertical-align:middle;cursor: pointer;" /></a>
             {else}
                <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
             {/if*}
        </td>
      </tr>
      {/section}
    </table>
    {*}<div style="height:8px;"></div>{*}
    <input type="hidden" name="pg" id="pg" value=""/>
	 <input type="hidden" name="enc" id="enc" value="n" />
<div class="pagging-bg">
	<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			{if $count eq 0}
			<td align="center" height="27"><!--Showing 1 - 30 Records Of 3838-->{$pgmsg}</td>
			{else}
			<td align="left" height="27">{$pgmsg}</td>
			{/if}
			<td align="right"  class="detail-graybg" style="padding-right:12px;">
				{$paging}
				<!--Pages : &nbsp;&nbsp;<span>1</span><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#">Next</a>-->
			</td>
		</tr>
	</table>
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
   <td colspan="5">
      {*include file="commonicon.tpl"*}
   </td>
</tr>
</table>
