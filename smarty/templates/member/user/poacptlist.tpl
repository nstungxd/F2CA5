<link rel="stylesheet" type="text/css" href="{$SITE_CSS}main.css">
<div id="content-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div id="content-header" class="clearfix">
                <div class="pull-left">
                    <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li class="active"><span>View Purchase Order</span></li>
                    </ol>

                    <h1>View Purchase Order</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
                <div class="form-group">
                    <label for="vPONumber">PO Number</label>
                    <input type="number" class="form-control" placeholder="Enter PO Number" name="vPONumber" id="vPONumber">
                </div>
                <div class="form-group">
                    <label for="buyername">Buyer</label>
                    <input type="text" class="form-control" name="buyername" id="buyername" placeholder="buyer">
                </div>
                <div class="form-group">
                    <label for="fPOTotal">PO Amount</label>
                    <input type="number" class="form-control" name="fPOTotal" id="fPOTotal" placeholder="PO Amount">
                </div>
                <div class="form-group">
                    <label for="fDate">PO Date From</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" class="form-control"  name="fDate" id="fDate">
                    </div>
                    <span class="help-block">format yy-mm-dd</span>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <input type="text" class="form-control" name="status" id="status" placeholder="status">
                </div>
        </div>
        <div class="col-md-6">
                <div class="form-group">
                    <label for="vPOCode">PO Code</label>
                    <input type="number" class="form-control" name="vPOCode" id="vPOCode" placeholder="Enter PO Code">
                </div>
                <div class="form-group">
                    <label for="vSupplierName">Supplier</label>
                    <input type="text" class="form-control" name="vSupplierName" id="vSupplierName" placeholder="Supplier">
                </div>
                <div class="form-group">
                    <label for="iNetPaymentDays">PO days</label>
                    <input type="number" class="form-control" name="iNetPaymentDays" id="iNetPaymentDays" placeholder="Enter PO Code">
                </div>
                <div class="form-group">
                    <label for="tDate">PO Date To</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" class="form-control" name="tDate" id="tDate">
                    </div>
                    <span class="help-block">format yy-mm-dd</span>
                </div>
                <div class="form-group">
                    <label></label>
                    <div class="input-group">
                        <button class="btn btn-success" type="submit" onclick="getgrouplist('srch',1)">Search</button>
                    </div>
                </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-10">
            {if $usertype neq 'orgadmin'}
                {if $poCreate eq 'Yes'}
                    <a href="{$SITE_URL_DUM}purchaseordercreate">
                        <button class="btn btn-primary pull-left">Create</button>
                    </a>
                {/if}

                {if $doimportpo eq 'Yes' && $pocrt eq 'Yes'}
                    <a href="{$SITE_URL_DUM}importpurchaseorders">
                        <button class="btn btn-primary pull-left">Import Purchase Order</button>
                    </a>
                    &nbsp;
                {/if}
                <a style="cursor:pointer;">
                    <button class="btn btn-primary pull-left" onclick="chkselect();">Export Purchase Order</button>
                </a>
            {/if}
            </div>
            <div class="col-md-2 text-right">
                <span id="updating" style="display: none;">
                    <img src="{$SITE_IMAGES}sm_images/progress.gif" alt=""/><a style="vertical-align:top;">Processing</a>
                </span>
                <span id="dispmsg" class="msg"></span>
                {if $deletepo eq 'Yes'}
                    <button type="button" class="btn btn-primary pull-left" onClick="Delete('deleteall','')">{$LBL_DELETE}</button>
                {/if}
            </div>


        </div>
    </div>

    <div class="row margin-top-20">
        <div class="col-lg-12">
            <div class="main-box clearfix">
                <header class="main-box-header clearfix">
                    <h2></h2>
                </header>

                <div class="main-box-body clearfix">
                    <div class="table-responsive">
                        <input type="hidden" name="cursort" id="cursort" value="" />
                        <input type="hidden" name="cursorttype" id="cursorttype" value="" />
                        
                        <input type="hidden" name="mod" id="mod" value=""/>
                        <input type="hidden" name="poStatus" id="poStatus" value="{$poStatus}"/>

                        <form name="exp" id="exp" method="post"
                              action="{$SITE_URL_DUM}index.php?file=m-exportpo">
                            <div id="grouplist">
                                <input type="hidden" name="pg" id="pg" value="1"/>
                                <input type="hidden" name="enc" id="enc" value="n"/>
                            </div>
                            <input type="hidden" name="view" id="view" value=""/>
                            <input type="hidden" name="iPOID" id="iPOID" value=""/>
                        </form>
                        <input type="hidden" name="m" id="m" value=""/>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>






<script src="{$SITE_JS}jquery.js"></script>
<script src="{$SITE_JS}bootstrap.js"></script>
<script src="{$SITE_JS}jquery.nanoscroller.min.js"></script>

<script src="{$SITE_JS}scripts.js"></script>
<script src="{$SITE_JS}pace.min.js"></script>

<!-- this page specific scripts -->
<script src="{$SITE_JS}bootstrap-datepicker.js"></script>
<script src="{$SITE_JS}jquery.dataTables.js"></script>
<script src="{$SITE_JS}dataTables.fixedHeader.js"></script>
<script src="{$SITE_JS}dataTables.tableTools.js"></script>
<script src="{$SITE_JS}jquery.dataTables.bootstrap.js"></script>
<!-- theme scripts -->

<script src="{$SITE_JS}tablesaw.js"></script>

<script type="text/javascript" src="{$SITE_JS_AJAX}jlistpoacpt.js"></script>
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

        $('#checkbox').change(function(){
            if ($('#checkall:checked').length > 0) {
                //alert('checked');
                $('tbody tr').each(function(event){
                    //event.preventDefault();
                    $(this).children('td.bs-checkbox').children('.btSelectItem').removeAttr('checked').attr('checked','checked');
                    //alert($(this).children('td.bs-checkbox').html());
                });
            } else {
                //alert('unchecked');
                $('tbody tr').each(function(event){
                    //event.preventDefault();
                    $(this).children('td.bs-checkbox').children('.btSelectItem').removeAttr('checked');
                    //alert($(this).children('td.bs-checkbox').html());
                });
            }
        });
        //datepicker
        $('#tDate').datepicker({
           format: 'yy-mm-dd',
          autoclose: true
        });
        $('#fDate').datepicker({
            format: 'yy-mm-dd',
          autoclose: true
        });
        $('#datepickerDateComponent').datepicker();

    });
</script>

<script type="text/javascript">
        jQuery(document).ready(function()
{
    $(".colorboxfile").live("click",function() {
        var id = $(this).attr('rel');
        $.colorbox({width:"71%", height:"90%",iframe:true,href:SITE_URL_DUM+"reportsrptpop/po/"+id+"/pop"});
    });
    //


});
$('#checkbox').click( function ()
{
    pos = $('input:checkbox[name="iPurchaseOrderID\[\]"]');
    if($(this).attr('checked'))
    {
        $.each(pos, function (ln,el) {
            $(this).attr('checked','checked');
        });
    }
    else
    {
        $.each(pos, function (ln,el) {
            $(this).attr('checked','');
        });
    }
});
var msg = '{/literal}{$msg}{literal}';
if(msg != ''){
    setTimeout("$('#msg').attr('innerHTML','');",7000);
}
function chkselect()
{
    var po = $('input:checked[name="iPurchaseOrderID\[\]"]');
    if(po.length>0) {
        /*var enct = confirm(LBL_ENCRYPT_EXPORT,"yes");
        if(enct) {
            $('#enc').val('y');
        } else {
            $('#enc').val('n');
        }*/
        $('#exp').submit();
    }
}
function ci(vl) {
    var url = SITE_URL+'index.php?file=u-purchaseordercreate_a';
    $('#exp').attr('action',url);
    $('#view').val('crtinv');
    $('#iPOID').val(vl);
    $('#exp').submit();
}
</script>
{/literal}
{if $msg neq ''}
    {literal}
    <script type="text/javascript">
            $(document).ready(function() {
    var msg='{/literal}{$msg}{literal}';
    if(msg!= '' && msg != undefined && $('#m').val()!=msg) {
        alert(msg);
        $('#m').val(msg);
    }
});
</script>
{/literal}
{/if}