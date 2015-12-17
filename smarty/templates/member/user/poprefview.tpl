<link rel="stylesheet" type="text/css" media="all" href="{$DATETIMEPICKER}css/calendar-blue.css" />
<link rel="stylesheet" type="text/css" href="{$SITE_CSS}main.css">
<div id="content-wrapper">
<div class="row">
    <div class="col-lg-12">
        <div id="content-header" class="clearfix">
            <div class="pull-left">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active"><span>{$LBL_VIEW_PURCHASE_ORDER}</span></li>
                </ol>

                <h1>{$LBL_VIEW_PURCHASE_ORDER}</h1>
            </div>
        </div>
    </div>
</div>
<div class="row">
<div class="col-lg-12">
<div class="main-box clearfix">
<header class="main-box-header clearfix">
    <h2></h2>
</header>
<div class="main-box-body clearfix">
<div class="tabs-wrapper">
    <ul class="nav nav-tabs">
        <li><a href="{$SITE_URL_DUM}purchaseorderview/{$iPurchaseOrderID}{if $var_msg eq 'pop'}/pop{/if}"><em>{$LBL_VIEW} {$LBL_PO_HEADER}</em></a></li>
        <li class="active"><a href="{$SITE_URL_DUM}poprefview/{$iPurchaseOrderID}{if $var_msg eq 'pop'}/pop{/if}" class="current"><em>{$LBL_VIEW} {$LBL_PREFERENCES}</em></a></li>
        <li><a href="{$SITE_URL_DUM}poviewitems/{$iPurchaseOrderID}{if $var_msg eq 'pop'}/pop{/if}" ><em>{$LBL_VIEW_PO_ITEM}</em></a></li>
    </ul>

<div class="tab-content">
<div class="tab-pane fade in active" id="tab-help">
    <div class="row" id="msg">
    {if $nxtstatus.vStatusMsg eq ''}
                    {if $invstat eq 'ureview'}
                    {$LBL_INV_STATUS_UNDER_REVIEW}
                    {elseif $invstat eq 'rjct'}
                    {$LBL_INV_STATUS_REJECTED}
                    {elseif $invstat eq 'isu'}
                    {$LBL_INV_STATUS_ISSUED}
                    {elseif $invstat eq 'acpt'}
                    {$LBL_INV_STATUS_ACCEPTED}
                    {elseif $invstat eq 'prt'}
                    {$LBL_INV_STATUS_PARTIAL_INVOICE}
                    {/if}
                    {/if}
    <a class="" href="javascript:openpopup('{$SITE_URL_DUM}poviewhistory/{$iPurchaseOrderID}')" >{$LBL_VIEW_HISTORY}</a>
    </div>
    <div class="row">
        <form name="frmadd" id="frmadd" action="{$SITE_URL}index.php?file=u-purchaseordercreate_a" method="post">
        <input type="hidden" name="iPurchaseOrderID" id="iPurchaseOrderID" value="{$iPurchaseOrderID}" />
        <input type="hidden" name="iPOID" id="iPOID" value="{$iPurchaseOrderID}" />
        <input type="hidden" name="nstatus" id="nstatus" value="{$nxtstatus.iStatusID}" />
        <input type="hidden" name="edelete" id="edelete" value="{$poData.eDelete}" />
        <input type="hidden" name="view" id="view" value="{$view}" />
        <dl class="dl-horizontal">
            {if $var_msg neq ''}
            <dt>{$var_msg}</dt>
            <dd></dd>
            {/if}
            <dt>{$LBL_SOURCE_DOC}</dt>
            <dd>{$poprefdt[0].tSourcingDocument|stripslashes}</dd>
            <dt>{$LBL_GLOBAL_AGREEMENT}</dt>
            <dd>{$poprefdt[0].tGlobalAgreement|stripslashes}</dd>
            <dt>{$LBL_PAYMENT_TERMS}</dt>
            <dd>{$poprefdt[0].tPaymentTerms|stripslashes}</dd>
            <dt>{$LBL_FOB}</dt>
            <dd>{$poprefdt[0].tFOB|stripslashes}</dd>
            <dt>{$LBL_DELIVERY_TERMS}</dt>
            <dd>{$poprefdt[0].tDeliveryTerms|stripslashes}</dd>
            <dt>{$LBL_SHIP_CONTROL}</dt>
            <dd>{$poprefdt[0].tShippingControl|stripslashes}</dd>
            <dt>{$LBL_COND_PAYMENT}</dt>
            <dd>{$poprefdt[0].tConditionsForPayment|stripslashes}</dd>
            <dt>{$LBL_PENALTIES}</dt>
            <dd>{$poprefdt[0].tPenalties|stripslashes}</dd>
            <dt>{$LBL_SPEC_INSTRUCT}</dt>
            <dd>{$poprefdt[0].tSpecialInstruction|stripslashes}</dd>
            <dt>{$LBL_NOTE}</dt>
            <dd>{$poprefdt[0].tNote|stripslashes}</dd>
            {if $permitted eq 'Yes' && $usertype neq 'orgadmin'}
            <dt>{$LBL_REASON_TO_REJECT}</dt>
            <dd><textarea id="tReasonToReject" name="tReasonToReject" class="form-control" cols="70" rows="3"></textarea></dd>
            {elseif $poData.tReasonToReject|trim neq '' && $poData.eStatus eq $rjtsts}
            <dt>{$LBL_REASON_TO_REJECT}</dt>
            <dd><textarea id="tReasonToReject" name="tReasonToReject" class="form-control" cols="70" rows="3">{$poData.tReasonToReject|trim}</textarea></dd>
            {/if}
        </dl>
        </form>
    </div>
    <center class="row">
        <button type="button" class="btn btn-primary" id="rst_btn" {if $poData.iInvoiceID gt 0}onclick="location.href='{$SITE_URL_DUM}poacptlist/{$smarty.session.polvl}';"{else}onclick="location.href='{$SITE_URL_DUM}polist/{$smarty.session.polvl}';"{/if}>Back</button>
        {if $permitted eq 'Yes' && $usertype neq 'orgadmin'}
            <button type="button"  id="resetbtn" class="btn btn-primary"  onclick="$('#view').val('verify');$('#frmadd').submit();" >Verify</button>
            <button type="button"  id="reset_btn" class="btn btn-primary" onclick="$('#view').val('reject');$('#frmadd').submit();">Reject</button>
        {/if}
        {if $crt_inv eq 'yes'}
            <button type="button" onclick="$('#view').val('crtinv');$('#frmadd').submit();" class="btn btn-primary">Create Invoice</button>
        {/if}
    </center>
</div>
</div>
</div>

</div>
</div>
</div>
</div>



</div>
<script type="text/javascript" src="{$S_JQUERY}jquery.js"></script>
<script type="text/javascript" src="{$SITE_CONTENT_JS}jgeneral.js"></script>

<script src="{$SITE_JS}jquery.js"></script>
<script src="{$SITE_JS}bootstrap.js"></script>
<script src="{$SITE_JS}jquery.nanoscroller.min.js"></script>
<script src="{$SITE_JS}bootstrap-datepicker.js"></script>


<!-- this page specific scripts -->
<script src="{$SITE_JS}jquery.dataTables.js"></script>
<script src="{$SITE_JS}dataTables.fixedHeader.js"></script>
<script src="{$SITE_JS}dataTables.tableTools.js"></script>
<script src="{$SITE_JS}jquery.dataTables.bootstrap.js"></script>
<!-- theme scripts -->
<script src="{$SITE_JS}scripts.js"></script>
<script src="{$SITE_JS}pace.min.js"></script>
<script src="{$SITE_JS}tablesaw.js"></script>
<script type="text/javascript" src="{$S_JQUERY}jquery.validate.js"></script>
<script type="text/javascript" src="{$S_JQUERY}jquery-ui-timepicker.js"></script>
{literal}
<script type="text/javascript">
        jQuery(document).ready(function()
{
    $(".colorboxfile").live("click",function() {
        var id = $(this).attr('rel');
        $.colorbox({width:"71%", height:"90%",iframe:true,href:SITE_URL_DUM+"reportsrptpop/inv/"+id+"/pop"});
    });
    $("#dNetPaymentdate").attr('readonly','readonly');
        $("#dNetPaymentdate").datepicker({
    dateFormat: 'yy-mm-dd',
    showOn: "both",
buttonImage: "{/literal}{$SITE_IMAGES}{literal}calendar.png",
    buttonImageOnly: true,
    onSelect: function(dateText, inst) { $(document).ready(function(dateText, inst) { var ead = 10; $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead}); }); },
    onClose: function() { $(document).ready(function(dateText, inst) { var ead = 10; $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead}); }); }
});

});
$("#frmadd").validate({
    rules: {
        //
    },
    messages: {
        "Data[fAcceptedAmount]": { decimals: LBL_NUMERIC_ONLY, min: LBL_VALUE_MUST_BE_GREATER_THAN_ZERO }
    }
});

</script>
{/literal}