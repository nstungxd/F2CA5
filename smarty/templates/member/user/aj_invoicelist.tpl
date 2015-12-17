<table id="table-example" class="table table-hover tablesaw" data-tablesaw-mode="columntoggle" data-click-to-select="true" data-tablesaw-minimap>
    <thead>
    <tr>
        <th class="no-order text-center">
        {if $usertype neq 'orgadmin'}
            <input type="checkbox" class="radib-btn" name="checkbox" id="checkbox" style="vertical-align:middle;" />
        {/if}
        </th>
        <th scope="col" data-tablesaw-priority="persist"><a href="javascript:getgrouplist('all','1','ioh.vInvoiceCode')">Invoice Supplier Code</a></th>
        <th scope="col" data-tablesaw-priority="1" class="text-center"><a href="javascript:getgrouplist('all','1','ioh.fInvoiceTotal')">Amount</a></th>
        <th scope="col" data-tablesaw-priority="2" class="text-center"><a href="javascript:getgrouplist('all','1','ioh.iNetPaymentDays')">Days</a></th>
        <th scope="col" data-tablesaw-priority="3" class="text-center"><a href="javascript:getgrouplist('all','1','ioh.dCreatedDate')">Date</a></th>
    {if $orgtype neq 'Supplier'}
        <th scope="col" data-tablesaw-priority="4" class="text-center"><a href="javascript:getgrouplist('all','1','ioh.vSupplierName')">Supplier</a></th>
    {/if}
        <th scope="col" data-tablesaw-priority="5" class="text-center"><a href="javascript:getgrouplist('all','1','CONCAT(ou.vFirstName,\' \',ou.vLastName)')">Buyers</a></th>
        <th scope="col" data-tablesaw-priority="6" class="text-center"><a href="javascript:getgrouplist('all','1','sm.vStatus_{$LANG}')">Status</a></th>
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
                  <input type="checkbox" class="btSelectItem" name="iInvoiceID[]" id="iInvoiceID" value="{$activegroup[i].iInvoiceID}" />
              {/if}
          </td>
          <td> &nbsp;
			 {assign var="vinvnum" value="-"|str_replace:" - ":$activegroup[i].vInvoiceNumber}
         {*}{$vinvnum}
		  </td>
        <td width="107" >{*}&nbsp;{$activegroup[i].vInvSupplierCode}</td>
          <td class="text-center">{$activegroup[i].fInvoiceTotal}</td>
          <td class="text-center">{$activegroup[i].days}</td>
          <td class="text-center">{$activegroup[i].dCreatedDate|calcLTzTime|DateTime:'10'}</td>
        {if $orgtype neq 'Supplier'}
            <td class="text-center">{$activegroup[i].vSupplierName}</td>
        {/if}
          <td class="text-center">{if $activegroup[i].vBuyerName|trim eq ''}---{else}{$activegroup[i].vBuyerName}{/if}</td>
          <td class="text-center">
                    <span class="label label-success">
				{if $activegroup[i].eSaved eq 'Yes'}
					{$MSG_SAVED}
				{else}
					{if $activegroup[i].iStatusID eq 0}
						{$LBL_NEED_TO_VERIFY}
					{elseif $activegroup[i].status eq 'Rejected' and $activegroup[i].eDelete eq 'Yes'}
						{$LBL_DELETE}
					{elseif $activegroup[i].iBuyerOrganizationID eq $curORGID && $activegroup[i].iStatusID eq $isusts && $activegroup[i].iaStatusID eq 0}
						{$LBL_NEED_TO_ACCEPT}
					{else}
						{$activegroup[i].status|htmlentities}
					{/if}
			   {/if}
                    </span>
			</td>
          <td class="text-center">
            {if $activegroup[i].status eq 'Rejected'}
               {assign var="ondelete" value="Delete('delete','"|cat:$activegroup[i].iInvoiceID|cat:"')"}
            {else}
               {assign var="ondelete" value="alert('$MSG_REJECTED_INVOICE_DEL')"}
            {/if}
				<!-- <a href="#"><img src="{$SITE_IMAGES}sm_images/icon-pen.gif"  alt="" border="0" style="vertical-align:middle;" /></a> &nbsp; -->
            <a class="table-link" href="{$SITE_URL_DUM}invoiceview/{$activegroup[i].iInvoiceID}">
                <span class="fa-stack">
                    <i class="fa fa-eye"></i>
                </span>
            </a> &nbsp;
            {if $activegroup[i].status eq 'Accepted'}
					<a class="table-link"  title="{$LBL_PRINT}" style="cursor:pointer" class="colorboxfile" rel="{$activegroup[i].iInvoiceID}">
                        <span class="fa-stack">
                            <i class="fa fa-print"></i>
                        </span>
                    </a>
				{/if}
				{if $usertype neq 'orgadmin'}
            {if $activegroup[i].eDelete neq 'Yes' }
               <a class="table-link" onclick="{$ondelete}">
                   <span class="fa-stack">
                       <i class="fa fa-trash-o"></i>
                   </span>
               </a>
            {else}
               <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
            {/if}
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
            invs = $('input:checkbox[name="iInvoiceID\[\]"]');
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
