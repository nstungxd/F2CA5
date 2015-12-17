<table id="table-example" class="table table-hover tablesaw" data-tablesaw-mode="columntoggle"
       data-click-to-select="true" data-tablesaw-minimap>
    <thead>
    <tr>
        <th class="no-order text-center">
        {if $usertype neq 'orgadmin'}
            <input type="checkbox" name="checkbox" id="checkbox"/>
        {/if}
        </th>
        <th scope="col" data-tablesaw-priority="persist"><a href="javascript:getgrouplist('all','1','poh.vPOCode')">PO
            Buyer Code</a></th>
        <th scope="col" data-tablesaw-priority="1" class="text-center"><a
                href="javascript:getgrouplist('all','1','poh.fPOTotal')">Amount</a></th>
        <th scope="col" data-tablesaw-priority="2" class="text-center"><a
                href="javascript:getgrouplist('all','1','days')">Days</a></th>
        <th scope="col" data-tablesaw-priority="3" class="text-center"><a
                href="javascript:getgrouplist('all','1','poh.dCreateDate')">Date</a></th>
        <th scope="col" data-tablesaw-priority="4" class="text-center"><a
                href="javascript:getgrouplist('all','1','poh.vSupplierName')">Supplier</a></th>
    {if $orgtype neq 'Buyer'}
        <th scope="col" data-tablesaw-priority="5" class="text-center"><a
                href="javascript:getgrouplist('all','1','poh.vBuyerCompanyName')">Buyer</a></th>
    {/if}
        <th scope="col" data-tablesaw-priority="6" class="text-center"><a
                href="javascript:getgrouplist('all','1','sm.vStatus_{$LANG}')">Status</a></th>
        <th class="no-order text-center">Action</th>
    </tr>
    </thead>
    <tbody>
      {section name=i loop=$activegroup}
      {if $smarty.section.i.index % 2 eq 0}
         {assign var="rowclass" value="golden"}
      {else}
         {assign var="rowclass" value=""}
      {/if}
      <tr>
          <td class="bs-checkbox text-center">
              {if $usertype neq 'orgadmin'}
                <input type="checkbox" class="btSelectItem" name="iPurchaseOrderID[]" id="iPurchaseOrderID"  value="{$activegroup[i].iPurchaseOrderID}" />
          {/if}
          </td>
        <td class="text-center"> &nbsp;

			{assign var="vponum" value="-"|str_replace:" - ":$activegroup[i].vPONumber}
         {*}{$vponum}
			</td>
        <td width="107" >{*}&nbsp;{$activegroup[i].vPoBuyerCode}</td>
        <td class="text-center">{$activegroup[i].fPOTotal}</td>
        <td class="text-center">{$activegroup[i].days}</td>
        <td class="text-center">{$activegroup[i].dCreateDate|calcLTzTime|DateTime:'10'}</td>
        <td class="text-center">{if $activegroup[i].vSupplierName|trim eq ''}---{else}{$activegroup[i].vSupplierName}{/if}</td>
        {if $orgtype neq 'Buyer'}
         <td class="text-center">{$activegroup[i].vBuyerCompanyName}</td>
        {/if}
         <td class="text-center">
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
        <td class="text-center">
            <!-- <a href="#"><img src="{$SITE_IMAGES}sm_images/icon-pen.gif"  alt="" border="0" style="vertical-align:middle;" /></a> &nbsp; -->
            <a href="{$SITE_URL_DUM}purchaseorderview/{$activegroup[i].iPurchaseOrderID}">
                <span class="fa-stack">
                    <i class="fa fa-eye"></i>
                </span>
            </a> &nbsp;
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
				<a title="{$LBL_PRINT}" rel="{$activegroup[i].iPurchaseOrderID}">
                    <span class="fa-stack">
                            <i class="fa fa-print"></i>
                        </span>
                </a>
			  {/if}
            {assign var='iex' value=$poObj->chkinvex($activegroup[i].iPurchaseOrderID)}
				{if $activegroup[i].iaStatusID eq $acptsts && $iex eq 'y' && ($activegroup[i].iInvoiceID<1 || $activegroup[i].iInvoiceID|trim neq '')}
					<img src="{$SITE_IMAGES}create_new_icon.png" title="{$LBL_CREATE_INVOICE}" alt="" border="0" onclick="return ci('{$activegroup[i].iPurchaseOrderID}');" style="vertical-align:middle; cursor:pointer;" />
				{/if}
        </td>
      </tr>
      {/section}
    </tbody>
    </table>
    {*}<div style="height:8px;"></div>{*}
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
        $('#checkbox').click( function ()
        {
            invs = $('input:checkbox[name="iPurchaseOrderID\[\]"]');
            if($(this).is(":checked"))
            {
                $.each(invs, function (ln,el) {
                    $(this).prop('checked', true);
                });
            }
            else
            {
                $.each(invs, function (ln,el) {
                    $(this).prop('checked', false);
                });
            }
        });
    });
</script>
{/literal}