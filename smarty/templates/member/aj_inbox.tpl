{assign var="field" value="vMailSubject_"|cat:$LANG}
<table id="table-example" class="table table-hover tablesaw" data-tablesaw-mode="columntoggle" data-click-to-select="true" data-tablesaw-minimap>
    <thead>
        <th class="no-order text-center">
            <input type="checkbox" class="radib-btn" name="checkbox" id="checkbox" style="vertical-align:middle;" />
        </th>
        <th scope="col" data-tablesaw-priority="persist"><a href="javascript:getgrouplist('all','1','ioh.vInvoiceCode')">{$LBL_SUBJECT}</a></th>
        <th scope="col" data-tablesaw-priority="1" class="text-center"><a href="javascript:getgrouplist('all','1','ioh.fInvoiceTotal')">{$LBL_DATE}</a></th>
    </thead>
    <tbody>
    {section name=ln loop=$activegroup}
        <tr {if $activegroup[ln].iVerifiedID|@in_array:$readm} class="golden" {else} class="inbox-unread" {/if}>
            <td width="5" height="26" align="center">
			<input type="checkbox" class="form-control" name="inbox[]" id="inbox" value="{$activegroup[ln].iVerifiedID}" />
		</td>
        <td height="26" width="158" align="left"><a href="{$SITE_URL_DUM}inboxdetail/{$activegroup[ln].iVerifiedID}">{$activegroup[ln].$field}</a></td>
		<td width="119" align="center">{$activegroup[ln].dActionDate|calcLTzTime|getInboxDate}</td>
        </tr>
    {/section}
    </tbody>
</table>
<input type="hidden" name="pg" id="pg" value=""/>
<script src="{$SITE_JS}jquery.js"></script>
{*<script src="{$SITE_JS}bootstrap.js"></script>*}
<script src="{$SITE_JS}jquery.dataTables.js"></script>
<script src="{$SITE_JS}dataTables.fixedHeader.js"></script>
{*<script src="{$SITE_JS}dataTables.tableTools.js"></script>*}
<script src="{$SITE_JS}jquery.dataTables.bootstrap.js"></script>
<script src="{$SITE_JS}tablesaw.js"></script>
<!-- this page specific inline scripts -->
{literal}
<script type="text/javascript">
   $('#invoice_count').html('{/literal}{$activegroup|@count}{literal}');
</script>
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