<table id="table-example" class="table table-hover tablesaw" data-tablesaw-mode="columntoggle"
       data-click-to-select="true" data-tablesaw-minimap>
    <thead>
    <tr>
        <th scope="col" data-tablesaw-priority="persist" class="text-center"><a
                href="javascript:getrfq2list('all','1','rfq2.vRFQ2Code')">{$LBL_RFQ2_CODE}</th>
        <th scope="col" data-tablesaw-priority="1" class="text-center"><a
                href="javascript:getrfq2list('all','1','vProductName')">{$LBL_PRODUCT}</th>
        <th scope="col" data-tablesaw-priority="2" class="text-center"><a
                href="javascript:getrfq2list('all','1','ioh.vBuyerName')">{$LBL_BUYER}</th>
        <th scope="col" data-tablesaw-priority="3" class="text-center"><a
                href="javascript:getrfq2list('all','1','ioh.vSupplierName')">{$LBL_SUPPLIER}</th>
        <th scope="col" data-tablesaw-priority="4" class="text-center"><a
                href="javascript:getrfq2list('all','1','rfq2.eAuctionType')">{$LBL_TYPE}</th>
        <th scope="col" data-tablesaw-priority="5" class="text-center"><a
                href="javascript:getrfq2list('all','1','rfq2.eBidCriteria')">{$LBL_BID_CRITERIA}</th>
        <th scope="col" data-tablesaw-priority="6" class="text-center"><a
                href="javascript:getrfq2list('all','1','rdays,rtime')">{$LBL_TIME_LEFT}</th>
        <th scope="col" data-tablesaw-priority="7" class="text-center"><a
                href="javascript:getrfq2list('all','1','sm.eStatus')">{$LBL_STATUS}</th>
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
      <td>&nbsp;
			{*if $usertype neq 'orgadmin'}
				<input type="checkbox" class="radib-btn" name="iRFQ2Id[]" id="iRFQ2Id" style="vertical-align:middle;" value="{$dtls[i].iRFQ2Id}" />
			{/if*}
			{$dtls[i].vRFQ2Code}
		</td>
		{*<td width="95" align="left">{$dtls[i].vInvoiceCode}</td>*}
		<td class="text-center">{$dtls[i].vProductName}</td>
		<td class="text-center">{$dtls[i].vBuyerName}</td>
		<td class="text-center">{$dtls[i].vSupplierName}</td>
      <td class="text-center">{$dtls[i].eAuctionType|substr:0:1|strtoupper}</td>
		<td class="text-center">{$dtls[i].eBidCriteria}</td>
		<td class="text-center">{if $dtls[i].rdays>0 || $dtls[i].rtime>0}{if $dtls[i].rdays>0}{$dtls[i].rdays}d{/if} {if $dtls[i].rtime>0}{$dtls[i].rtime}{/if}{else}0{/if}</td>
		<td class="text-center">
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
      <td class="text-center">
			<a href="{$SITE_URL_DUM}rfq2view/{$dtls[i].iRFQ2Id}">
                <span class="fa-stack">
                    <i class="fa fa-edit"></i>
                </span>
            </a>&nbsp;
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