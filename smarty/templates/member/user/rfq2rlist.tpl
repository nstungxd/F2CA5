<link rel="stylesheet" type="text/css" href="{$SITE_CSS}main.css">
<div id="content-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div id="content-header" class="clearfix">
                <div class="pull-left">
                    <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li class="active"><span>{$LBL_RFQ2}</span></li>
                    </ol>

                    <h1>{$LBL_RFQ2} {$LBL_REJECT} {$LBL_LIST}</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="alert" role="alert">
        <a href="javascript:history.back(-1);">
            <button type="button"  class="btn btn-primary">Back</button>
        </a>
        <button type="button"  class="btn btn-primary"  onclick="getrfq2list('all',1)">Show all</button>
        <span id="msg" class="msg" style="color:#ff0000;"></span>
    </div>

    <div class="row">
        <div class="col-md-6">
                <div class="form-group">
                    <label for="vRFQ2Code">{$LBL_RFQ2_CODE} </label>
                    <input type="number" class="form-control" name="vRFQ2Code" id="vRFQ2Code" placeholder="Enter RFQ2 Code">
                </div>
                <div class="form-group">
                    <label for="bestbid">{$LBL_BEST_BID}</label>
                    <input type="text" class="form-control" name="bestbid" id="bestbid" placeholder="Best Bid">
                </div>
                <div class="form-group">
                    <label for="buyer">{$LBL_BUYER}</label>
                    <input type="text" class="form-control" name="buyer" id="buyer" placeholder="Buyer">
                </div>
                <div class="form-group">
                    <label for="dStartDate">{$LBL_START_DATE}</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" class="form-control" name="dStartDate" id="dStartDate">
                    </div>
                    <span class="help-block">format yy-mm-dd</span>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">{$LBL_TYPE}</label>
                    {$rfq2type}
                </div>
        </div>
        <div class="col-md-6">
                <div class="form-group">
                    <label for="vInvoiceCode">{$LBL_INV_PO_CODE}</label>
                    <input type="number" class="form-control" name="vInvoiceCode" id="vInvoiceCode" placeholder="Enter Invoice/PO Code">
                </div>
                <div class="form-group">
                    <label for="product">{$LBL_PRODUCT}</label>
                    <input type="text" class="form-control" iname="product" id="product" placeholder="Product">
                </div>
                <div class="form-group">
                    <label for="supplier">{$LBL_SUPPLIER}</label>
                    <input type="number" class="form-control" name="supplier" id="supplier" placeholder="Supplier">
                </div>
                <div class="form-group">
                    <label for="dEndDate">{$LBL_END_DATE}</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" class="form-control" name="dEndDate" id="dEndDate">
                    </div>
                    <span class="help-block">format yy-mm-dd</span>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">{$LBL_BID_CRITERIA}</label>
                    {$bidcriteria}
                </div>
                <div class="form-group">
                    <label></label>
                    <div class="input-group">
                        <a onclick="getrfq2list('srch',1)"> <button class="btn btn-success" type="button">Search</button></a>
                    </div>
                </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-10">
                <button type="button" class="btn btn-primary pull-left" onclick="chstatus('deleteall','')">{$LBL_DELETE}</button>
            </div>
            <div class="col-md-2 text-right">
                <span id="updating" style="display:none; padding-bottom:7px;">
               <img src="{$SITE_IMAGES}sm_images/progress.gif" alt=""/>
               <a style="vertical-align:top;">Processing</a>
               </span>
                <span id="dispmsg" class="msg"></span>


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
                        <input type="hidden" name="sts" id="sts" value="{$sts}"/>
                        <input type="hidden" name="status" id="status" value="{$status}"/>

                        <form name="exp" id="exp" method="post" action="">
                            <div id="grouplist">
                                <input type="hidden" name="pg" id="pg" value="1"/>
                                <input type="hidden" name="enc" id="enc" value="n"/>
                            </div>
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
<!-- this page specific inline scripts -->

<script type="text/javascript" src="{$SITE_JS_AJAX}jrlistrfq2.js"></script>

{literal}
<script>
    $(document).ready(function() {
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
        $('#dStartDate').datepicker({
            format: 'yy-mm-dd',
          autoclose: true
        });
        $('#dEndDate').datepicker({
            format: 'yy-mm-dd',
          autoclose: true
        });
        $('#datepickerDateComponent').datepicker();

    });
</script>
<script type="text/javascript">
function chkselect()
{
    var inv = $('input:checked[name="iRFQ2Id\[\]"]');
    if(inv.length >0) {
        /*var enct = confirm(LBL_ENCRYPT_EXPORT,"yes");
        if(enct) {
            $('#enc').val('y');
        } else {
            $('#enc').val('n');
        }*/
        $('#exp').submit();
    }
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
