<div id="content-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div id="content-header" class="clearfix">
                <div class="pull-left">
                    <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li class="active"><span>{$LBL_REPORTS}</span></li>
                    </ol>

                    <h1>{if $inetserverurl|trim eq ''}<br/>{$LBL_INET_SERVER_URL_UNAVAILABLE}<br/><br/>{/if}</h1>
                </div>
            </div>
        </div>
    </div>
    {if $inetserverurl|trim neq ''}
    <form id="frmrpt" name="frmrpt" method="post" action="{$inetserverurl}{*$SITE_URL}index.php?file=m-inetreports*}">
    <div class="row">
        <div class="col-md-3 list-label">
            {$LBL_SELECT} {$LBL_AVAILABLE} {$LBL_REPORT} * :
        </div>
        <div class="col-md-3 list-text">
            {if $rptfls|is_array && $rptfls|@count >0}
                <select id="rptfile" name="report" class="form-control">
                    {section name="l" loop=$rptfls}
                        <option id="{$rptfls[l].iReportId}" lp="{$smarty.section.l.index}" value="{$rptfls[l].path}">{$rptfls[l].name}</option>
                    {/section}
                </select>
                {else}
                {$LBL_NO_REPORT_FILES_AVAILABLE}
            {/if}
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 list-label">
            {$LBL_DESCRIPTION} :
        </div>
        <div class="col-md-3 list-text">
            ___
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 list-label">
            {$LBL_TYPE} :
        </div>
        <div class="col-md-3 list-text">
            <select id="init" name="init" class="form-control">
                <option value="pdf">PDF</option>
                <option value="png">PNG</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 list-label">
            {$LBL_PARAMETERS} :
        </div>
        <div class="col-md-3 list-text">

        </div>
    </div>
    <center class="row">
        <a id="btncancel" name="btncancel" href="{$SITE_URL_DUM}"><button type="button" class="btn btn-primary">{$LBL_CANCEL}</button></a>
        <a id="printnew" name="printnew"><button type="button"  class="btn btn-primary">{$LBL_PRINT_NEW}</button></a>
        <a id="btnsubmit" name="btnsubmit"><button type="button"  class="btn btn-primary">{$LBL_SUBMIT}</button></a>
    </center>
    </form>
    {/if}
    <span id="preview" style="display:none;"></span>
</div>
<script type="text/javascript" src="{$S_JQUERY}jquery.listboxfilter.js" ></script>
<script type="text/javascript" src="{$S_JQUERY}jquery.validate.js"></script>

<script src="{$SITE_JS}demo-skin-changer.js"></script> <!-- only for demo -->

<script src="{$SITE_JS}jquery.js"></script>
<script src="{$SITE_JS}bootstrap.js"></script>
<script src="{$SITE_JS}jquery.nanoscroller.min.js"></script>
<script src="{$SITE_JS}bootstrap-datepicker.js"></script>
<script src="{$SITE_JS}demo.js"></script> <!-- only for demo -->

<!-- this page specific scripts -->
<script src="{$SITE_JS}jquery.dataTables.js"></script>
<script src="{$SITE_JS}dataTables.fixedHeader.js"></script>
<script src="{$SITE_JS}dataTables.tableTools.js"></script>
<script src="{$SITE_JS}jquery.dataTables.bootstrap.js"></script>
<!-- theme scripts -->
<script src="{$SITE_JS}scripts.js"></script>
<script src="{$SITE_JS}pace.min.js"></script>
<script src="{$SITE_JS}tablesaw.js"></script>

{literal}
<script type="text/javascript">
var prms = ["{/literal}{$prms}{literal}"];
var rptdesc = ["{/literal}{$rptdesc}{literal}"];
        $(document).ready(function()
{
    $("#orgfilter").bigoFilter("#promptorganization_id", {property: 'text'});
    $("#usrfilter").bigoFilter("#promptuser_id", {property: 'text'});
    $("#pofilter").bigoFilter("#promptpo_id", {property: 'text'});
    $("#invfilter").bigoFilter("#promptinvoice_id", {property: 'text'});
    $("#rfq2filter").bigoFilter("#promptrfq2_id", {property: 'text'});
    $("#rfq2bidfilter").bigoFilter("#promptrfq2_bid_id", {property: 'text'});
    $("#rfq2bidawardfilter").bigoFilter("#promptrfq2_bid_award_id", {property: 'text'});
function getorgusers() {
        if($.trim($('#promptorganization_id').val()) == '') {
    if($('#promptuser_id option').length >0) {
        $('#promptuser_id option[value!=""]').remove();
    }
} else if($('#promptuser_id option').length >0) {
    var url = SITE_URL+"index.php?file=m-aj_getRptCombos";
var pars = $('#frmrpt').serialize()+'&type=usr&dseltxt='+'{/literal}{$LBL_SELECT} {$LBL_USER}{literal}';
    $.ajax({type:"post", url:url, data:pars, success:function(resp) {
        $('.puser').attr('innerHTML',resp);
    }});
}
}
    $('#promptorganization_id').live("change", getorgusers);
function setprms() {
    var lp = $('#rptfile option:selected').attr('lp');
    $('#prms').attr('innerHTML', prms[lp]);
    $('#rptdesc').attr('innerHTML', rptdesc[lp]);
    //
    // $('#prms > el').hide();
    // $('#prms > el[pth="'+$('#rptfile').val()+'"]').show();
        $("#promptfrom_date").datepicker({
    dateFormat: 'yy-mm-dd',
    // timeFormat: 'hh:mm:ss',
    showOn: "both",
buttonImage: "{/literal}{$SITE_IMAGES}{literal}calendar.png",
    buttonImageOnly: true,
    onSelect: function(dateText, inst) {
        $(document).ready(function(dateText, inst) {
            var ead = 10;
            $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
        });
    },
    onClose: function() {
        $(document).ready(function(dateText, inst) {
            var ead = 10;
            $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
        });
    }
});
    //});
    // $("#tDate").live("click",function() {
        $("#promptto_date").datepicker({
    dateFormat: 'yy-mm-dd',
    // timeFormat: 'hh:mm:ss',
    showOn: "both",
buttonImage: "{/literal}{$SITE_IMAGES}{literal}calendar.png",
    buttonImageOnly: true,
    onSelect: function(dateText, inst) {
        $(document).ready(function(dateText, inst) {
            var ead = 10;
            $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
        });
    },
    onClose: function() {
        $(document).ready(function(dateText, inst) {
            var ead = 10;
            $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
        });
    }
});
}
    setprms();
    $('#rptfile').change(setprms);
    $('#frmrpt').validate({
        "ignore":":hidden"
    });
function frmsubmit(rpt) {
    var vld = $('#frmrpt').valid();
    if(! vld) {
        return false;
    }
        if($('#rptfile').length >0 && $('#rptfile').val()!='') {
    // var href = $('#frmrpt').attr('action')+'&rptfile='+$('#rptfile').val()+'&init='+$('#init').val();
    // var href = '{/literal}{$SITE_URL}{literal}index.php?file=m-getinetreports&'+$('#frmrpt').serialize();
var url = "{/literal}{$SITE_URL}{literal}"+"index.php?file=m-getinetreports";
    var prms = $('#frmrpt').serialize()+"&nwrpt=y";
    $.ajax({type:"post", url:url, data:prms, success:function(resp) {
        rslt = $.parseJSON(resp);
        // alert(rslt['file']);
        if($.trim(rslt['file'])=='') {
            alert(LBL_REPORT_NOT_AVAILABLE);
            return false;
        }
        $.colorbox({ width:"790px", height:"550px", iframe:true, href:rslt['file'] });
    } });
    // var href = $('#frmrpt').attr('action')+'/?'+$('#frmrpt').serialize();
    // $.colorbox({ width:"790px", height:"550px", iframe:true, href:href });
    // $(".btnsubmit").trigger('click');
    // $('#frmrpt')[0].submit();
    return true;
}
    alert('No Report Selected');
    return false;
}
    //$('#btnsubmit').click(frmsubmit('n'));
    //$('#printnew').click(frmsubmit('y'));
    $("#btnsubmit").click(function() {
        frmsubmit('n');
    });
    $("#printnew").click(function() {
        frmsubmit('y');
    });
});
</script>
{/literal}