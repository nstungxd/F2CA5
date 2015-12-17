<link rel="stylesheet" type="text/css" media="all" href="{$DATETIMEPICKER}css/calendar-blue.css" />
<link rel="stylesheet" type="text/css" href="{$SITE_CSS}main.css">
<div id="content-wrapper">
<div class="row">
    <div class="col-lg-12">
        <div id="content-header" class="clearfix">
            <div class="pull-left">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active"><span>Invoice</span></li>
                </ol>

                <h1>Invoice</h1>
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
        <li><a href="{$SITE_URL_DUM}invoiceview/{$iInvoiceID}{if $msg eq 'pop'}/pop{/if}">{$LBL_VIEW} {$LBL_INV_HEADER}</a></li>
    {if $imgdt neq 'yes'}
        <li class="active"><a href="{$SITE_URL_DUM}invprefview/{$iInvoiceID}{if $msg eq 'pop'}/pop{/if}">{$LBL_VIEW} {$LBL_PREFERENCES}</a></li>
        <li><a href="{$SITE_URL_DUM}invoiceviewitems/{$iInvoiceID}{if $msg eq 'pop'}/pop{/if}">{$LBL_VIEW} {$LBL_INVOICE_ITEM}</a></li>
    {/if}
    </ul>

<div class="tab-content">
<div class="tab-pane fade in active" id="tab-help">
    <div class="row" id="msg">
    {if $nxtstatus.vStatusMsg eq ''}
        {if $postat eq 'ureview'}
            {$LBL_PO_STATUS_UNDER_REVIEW}
            {elseif $postat eq 'rjct'}
            {$LBL_PO_STATUS_REJECTED}
            {elseif $postat eq 'isu'}
            {$LBL_PO_STATUS_ISSUED}
            {elseif $postat eq 'acpt'}
            {$LBL_PO_STATUS_ACCEPTED}
            {elseif $postat eq 'prt'}
            {$LBL_PO_STATUS_PARTIAL_INVOICE}
        {/if}
    {/if}
    {if $msg neq 'pop'}
        <a class="" href="javascript:openpopup('{$SITE_URL_DUM}invoiceviewhistory/{$iInvoiceID}')" >{$LBL_VIEW_HISTORY}</a>
    {/if}
    </div>
    <div class="row">
        <form name="frmadd" id="frmadd" action="{$SITE_URL}index.php?file=u-invoicecreate_a"  method="post">
            <input type="hidden" name="iInvoiceID" id="iInvoiceID" value="{$iInvoiceID}" />
            <input type="hidden" name="nstatus" id="nstatus" value="{$nxtstatus.iStatusID}" />
            <input type="hidden" name="edelete" id="edelete" value="{$invoiceData.eDelete}" />
            <input type="hidden" name="view" id="view" value="{$view}" />
        <dl class="dl-horizontal">
            <dt>{$var_msg}</dt>
            <dd></dd>
            <dt>{$LBL_SOURCE_DOC}</dt>
            <dd>{$iprefdt[0].tSourcingDocument|stripslashes}</dd>
            <dt>{$LBL_GLOBAL_AGREEMENT}</dt>
            <dd>{$iprefdt[0].tGlobalAgreement|stripslashes}</dd>
            <dt>{$LBL_PAYMENT_TERMS}</dt>
            <dd>{$iprefdt[0].tPaymentTerms|stripslashes}</dd>
            <dt>{$LBL_FOB}</dt>
            <dd>{$iprefdt[0].tFOB|stripslashes}</dd>
            <dt>{$LBL_DELIVERY_TERMS}</dt>
            <dd>{$iprefdt[0].tDeliveryTerms|stripslashes}</dd>
            <dt>{$LBL_SHIP_CONTROL}</dt>
            <dd>{$iprefdt[0].tShippingControl|stripslashes}</dd>
            <dt>{$LBL_COND_PAYMENT}</dt>
            <dd>{$iprefdt[0].tConditionsForPayment|stripslashes}</dd>
            <dt>{$LBL_PENALTIES}</dt>
            <dd>{$iprefdt[0].tPenalties|stripslashes}</dd>
            <dt>{$LBL_SPEC_INSTRUCT}</dt>
            <dd>{$iprefdt[0].tSpecialInstruction|stripslashes}</dd>
            <dt>{$LBL_NOTE} </dt>
            <dd>{$iprefdt[0].tNote|stripslashes}</dd>
        {if $permitted eq 'Yes' && $usertype neq 'orgadmin'}
        <dt>{$LBL_REASON_TO_REJECT}</dt>
        <dd> <textarea id="tReasonToReject" class="form-control" name="tReasonToReject" cols="70" rows="3"></textarea></dd>
        {/if}
        </dl>
        </form>
    </div>
    <center class="row">
    {if $msg neq 'pop'}
        <button type="button" {if $invoiceData.iPurchaseOrderID gt 0}onclick="location.href='{$SITE_URL_DUM}invacptlist/{$smarty.session.invlvl}';"{else}onclick="location.href='{$SITE_URL_DUM}invoicelist/{$smarty.session.invlvl}';"{/if} class="btn btn-primary">Back</button>
        {if $permitted eq 'Yes' && $usertype neq 'orgadmin'}
             <button type="button"  id="reset_btn" class="btn btn-primary"  onclick="$('#view').val('verify');$('#frmadd').submit();" >Verify</button>
            <button type="button"  id="reset_btn" class="btn btn-primary" onclick="$('#view').val('reject');$('#frmadd').submit();">Reject</button>
        {/if}
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