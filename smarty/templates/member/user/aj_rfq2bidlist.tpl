<table id="table-example" class="table table-hover tablesaw" data-tablesaw-mode="columntoggle"
       data-click-to-select="true" data-tablesaw-minimap>
    <thead>
    <tr>
        <th scope="col" data-tablesaw-priority="persist" class="text-center"><a
                href="javascript:getrfq2bidlist('all','1','rfq2.vRFQ2Code')">{$LBL_RFQ2_CODE}</a></th>
        <th scope="col" data-tablesaw-priority="1" class="text-center"><a
                href="javascript:getrfq2bidlist('all','1','ioh.vInvoiceCode')">{$LBL_INV_CODE}</a></th>
        <th scope="col" data-tablesaw-priority="2" class="text-center"><a
                href="javascript:getrfq2bidlist('all','1','ioh.vInvoiceCode')">{$LBL_AMOUNT}</a></th>
        <th scope="col" data-tablesaw-priority="3" class="text-center"><a
                href="javascript:getrfq2bidlist('all','1','vProductName')">{$LBL_PRODUCT}</a></th>
        <th scope="col" data-tablesaw-priority="4" class="text-center"><a
                href="javascript:getrfq2bidlist('all','1','ioh.vBuyerName')">{$LBL_BUYER}</a></th>
        <th scope="col" data-tablesaw-priority="5" class="text-center"><a
                href="javascript:getrfq2bidlist('all','1','ioh.vSupplierName')">{$LBL_SUPPLIER}</a></th>
        <th scope="col" data-tablesaw-priority="6" class="text-center"><a
                href="javascript:getrfq2bidlist('all','1','org.vCompanyName')">{$LBL_BUYER2}</a></th>
        <th scope="col" data-tablesaw-priority="7" class="text-center"><a
                href="javascript:getrfq2bidlist('all','1','rfq2.eAuctionType')">{$LBL_TYPE}</a></th>
        <th scope="col" data-tablesaw-priority="8" class="text-center"><a
                href="javascript:getrfq2bidlist('all','1','rfq2.eBidCriteria')">{$LBL_CRITERIA}</a></th>
        <th scope="col" data-tablesaw-priority="9" class="text-center"><a
                href="javascript:getrfq2bidlist('all','1','r2bd.dBidDate')">{$LBL_BID} {$LBL_DATE}</a></th>
        <th scope="col" data-tablesaw-priority="10" class="text-center"><a
                href="javascript:getrfq2bidlist('all','1','r2bd.fBidAdvanceTotal,r2bd.fBidPriceTotal')">{$LBL_BID} {$LBL_AMOUNT}</a>
        </th>
        <th scope="col" data-tablesaw-priority="11" class="text-center"><a
                href="javascript:getrfq2bidlist('all','1','r2bd.eStatus')"><strong>{$LBL_STATUS}</a></th>
        <th class="no-order text-center">{$LBL_ACTION}</th>
    </tr>
    </thead>
    <tbody>
	{section name=i loop=$dtls}
	{if $smarty.section.i.index % 2 eq 0}
		{assign var="rowclass" value="golden"}
	{else}
		{assign var="rowclass" value=""}
	{/if}
   <tr>
      <td class="text-center">&nbsp;
			{*if $usertype neq 'orgadmin'}
				<input type="checkbox" class="radib-btn" name="iBidId[]" id="iBidId" style="vertical-align:middle;" value="{$dtls[i].iBidId}" />
			{/if*}
			{$dtls[i].vRFQ2Code}
		</td>
		<td class="text-center">{$dtls[i].vInvoiceCode}</td>
		<td class="text-center">{$dtls[i].fAcceptedAmount}</td>
		<td class="text-center">{$dtls[i].vProductName}</td>
		<td class="text-center">{$dtls[i].vBuyerName}</td>
		<td class="text-center">{$dtls[i].vSupplierName}</td>
		<td class="text-center">{$dtls[i].vBuyer2}</td>
      <td class="text-center">{$dtls[i].eAuctionType|substr:0:1|strtoupper}</td>
		<td class="text-center">{$dtls[i].eBidCriteria}</td>
		<td class="text-center">{$dtls[i].dBidDate|calcLTzTime|DateTime:10}</td>
		{*<td width="70" align="center">{if $dtls[i].rdays>0 || $dtls[i].rtime>0}{if $dtls[i].rdays>0}{$dtls[i].rdays}d{/if} {if $dtls[i].rtime>0}{$dtls[i].rtime}{/if}{else}0{/if}</td>*}
		<td class="text-center">A:{$dtls[i].fBidAdvanceTotal|number_format:2:'.':','}, P:{$dtls[i].fBidPriceTotal|number_format:2:'.':','}</td>
		{*<td width="63" align="center">{$dtls[i].totbid}</td>*}
      <td class="text-center">
			{if $dtls[i].eSaved eq 'Yes'}
				{$LBL_SAV}
			{elseif $dtls[i].eDelete eq 'Yes'}
				{$LBL_DELETE}
			{elseif $dtls[i].eStatus eq 'current'}
				{$LBL_BEST}
			{elseif $dtls[i].eStatus eq 'outbidded'}
				{$LBL_OUTBIDDED}
			{else}
				{$dtls[i].eStatus}
			{/if}
		</td>
      <td class="text-center">
			<a href="{$SITE_URL_DUM}rfq2bidview/{$dtls[i].iBidId}">
                <span class="fa-stack">
                    <i class="fa fa-check"></i>
                </span>
            </a>&nbsp;
      </td>
   </tr>
   {/section}
    </tbody>
</table>
<input type="hidden" name="pg" id="pg" value=""/>
<input type="hidden" name="enc" id="enc" value="n" />
<script src="{$SITE_JS}jquery.js"></script>
{*<script src="{$SITE_JS}bootstrap.js"></script>*}
<script src="{$SITE_JS}jquery.dataTables.js"></script>
<script src="{$SITE_JS}dataTables.fixedHeader.js"></script>
{*<script src="{$SITE_JS}dataTables.tableTools.js"></script>*}
<script src="{$SITE_JS}jquery.dataTables.bootstrap.js"></script>
<script src="{$SITE_JS}tablesaw.js"></script>
<!-- this page specific inline scripts -->
{literal}
<script>
    $(document).ready(function() {
        var table = $('#table-example').dataTable({
            'info': false,
            'filter': false,
            'columnDefs': [ { "targets": 0, "orderable": false } ],
            'sDom': 'lf<"clearfix">tip',
            'TableTools': false
        });

    });
</script>
{/literal}