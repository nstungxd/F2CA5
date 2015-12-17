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
                <input type="checkbox" class="radib-btn" name="iPurchaseOrderID[]" id="iPurchaseOrderID" style="vertical-align:middle;" value="{$activegroup[i].iPurchaseOrderID}" />
          {/if}
			{assign var="vponum" value="-"|str_replace:" - ":$activegroup[i].vPONumber}
         {*}{$vponum}
			</td>
        <td width="107" >{*}&nbsp;{$activegroup[i].vPoBuyerCode}</td>
        <td width="67"  align="center">{$activegroup[i].fPOTotal}</td>
        <td width="48" align="center">{$activegroup[i].days}</td>
        <td width="74" align="center">{$activegroup[i].dCreateDate|calcLTzTime|DateTime:'10'}</td>
        <td width="87" align="center">{if $activegroup[i].vSupplierName|trim eq ''}---{else}{$activegroup[i].vSupplierName}{/if}</td>
        {if $orgtype neq 'Buyer'}
         <td width="77" align="center">{$activegroup[i].vBuyerCompanyName}</td>
        {/if}
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
            <!-- <a href="#"><img src="{$SITE_IMAGES}sm_images/icon-pen.gif"  alt="" border="0" style="vertical-align:middle;" /></a> &nbsp; -->
            <a href="{$SITE_URL_DUM}purchaseorderview/{$activegroup[i].iPurchaseOrderID}"><img src="{$SITE_IMAGES}sm_images/icon-edit.gif"  alt="" border="0" style="vertical-align:middle;" /></a> &nbsp;
            {if $activegroup[i].status eq 'Rejected'}
                {assign var="ondelete" value="Delete('delete','"|cat:$activegroup[i].iPurchaseOrderID|cat:"')"}
       		{else}
                {assign var="ondelete" value="alert('$MSG_REJECTED_PO_DEL')"}
            {/if}
            {*if $activegroup[i].eDelete neq 'Yes' && $activegroup[i].iBuyerOrganizationID eq $curORGID}
            <a onclick="{$ondelete}"><img src="{$SITE_IMAGES}sm_images/icon-delete.gif"  alt="" border="0" style="vertical-align:middle;cursor: pointer" /></a>
            {else}
            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
            {/if*}
				{if $activegroup[i].status eq 'Accepted'}
				<a title="{$LBL_PRINT}" style="cursor:pointer" class="colorboxfile" rel="{$activegroup[i].iPurchaseOrderID}"><img src="{$SITE_IMAGES}report.png"  alt="" border="0" style="vertical-align:middle;" /></a>
			  {/if}
            {assign var='iex' value=$poObj->chkinvex($activegroup[i].iPurchaseOrderID)}
				{if $activegroup[i].iaStatusID eq $acptsts && $iex eq 'y' && ($activegroup[i].iInvoiceID<1 || $activegroup[i].iInvoiceID|trim neq '')}
					<img src="{$SITE_IMAGES}create_new_icon.png" title="{$LBL_CREATE_INVOICE}" alt="" border="0" onclick="return ci('{$activegroup[i].iPurchaseOrderID}');" style="vertical-align:middle; cursor:pointer;" />
				{/if}
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
