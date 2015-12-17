<link rel="stylesheet" type="text/css" href="{$SITE_CSS}main.css">
<link rel="stylesheet" href="{$SITE_CSS}libs/datepicker.css" type="text/css" />
<link rel="stylesheet" href="{$SITE_CSS}libs/select2.css" type="text/css" />

<div id="content-wrapper">
					<div class="row">
						<div class="col-lg-12">
							<div id="content-header" class="clearfix">
								<div class="pull-left">
									<ol class="breadcrumb">
										<li><a href="#">Home</a></li>
										<li class="active"><span>View Invoice Listing</span></li>
									</ol>

									<h1>View Invoice Listing</h1>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
								<div class="form-group">
									<label for="vInvoiceNumber">Invoice Number</label>
									<input type="number" class="form-control" name="vPONumber" id="vInvoiceNumber" placeholder="Enter Invoice Number">
								</div>
								<div class="form-group">
									<label for="buyername">{$LBL_BUYER}</label>
									<input type="text" class="form-control" name="buyername" id="buyername" placeholder="buyer">
								</div>
								<div class="form-group">
									<label for="fInvoiceTotal">Invoice Amount</label>
									<input type="number" class="form-control" name="fPOTotal" id="fInvoiceTotal"  placeholder="Invoice Amount">
								</div>
								<div class="form-group">
									<label for="fDate">Invoice Date From</label>
                                    <div class="input-group col-md-6">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										<input type="text" class="form-control" id="fDate" name="fDate">
									</div>
                                    <span class="help-block">format yy-mm-dd</span>

									{*<div class="input-group input-append bootstrap-timepicker col-md-6">
										<span class="add-on input-group-addon"><i class="fa fa-clock-o"></i></span>
										<input type="text" class="form-control" id="fTime" name="fTime">
									</div>*}

								</div>

								<div class="form-group">
									<label for="status">Status</label>
									<input type="text" class="form-control" name="status" id="status" placeholder="status">
								</div>
						</div>
						<div class="col-md-6">
								<div class="form-group">
									<label for="vInvoiceCode">Invoice Code</label>
									<input type="number" class="form-control" name="vPOCode" id="vInvoiceCode" placeholder="Enter Invoice Code">
								</div>
								<div class="form-group">
									<label for="vSupplierName">Supplier</label>
									<input type="text" class="form-control" name="vSupplierName" id="vSupplierName" placeholder="Supplier">
								</div>
								<div class="form-group">
									<label for="iNetPaymentDays">Invoice days</label>
									<input type="number" class="form-control" name="iNetPaymentDays" id="iNetPaymentDays" placeholder="Enter Invoice Days">
								</div>
								<div class="form-group">
									<label for="tDate">Invoice Date To</label>
                                    <div class="input-group col-md-6">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										<input type="text" class="form-control" id="tDate" name="tDate">
									</div>
                                    <span class="help-block">format yy-mm-dd</span>

									{*<div class="input-group input-append bootstrap-timepicker col-md-6">
										<span class="add-on input-group-addon"><i class="fa fa-clock-o"></i></span>
										<input type="text" class="form-control" id="tTime" name="tTime">
									</div>*}
								</div>
								<div class="form-group">
                                    <button type="submit" class="btn btn-primary search" onclick="getgrouplist('srch',1)" id="exampleInputPassword1">Search</button>
								</div>
						</div>
					</div>
                    <div class="row">
        <div class="col-md-12">
            <div class="col-md-10">
            {if $usertype neq 'orgadmin'}
                 {if $invCreate eq 'Yes'}
                     <a href="{$SITE_URL_DUM}invoicecreate" class="btn btn-primary">
                         Create
                     </a>
                 {/if}
                 {if $doimportinv eq 'Yes' && $invcrt eq 'Yes'}&nbsp;
                     <a href="{$SITE_URL_DUM}importinvoice" class="btn btn-primary">
                         Import Invoice
                     </a>
                 {/if}
                 <a style="cursor:pointer;">
                     <button class="btn btn-primary" onclick="chkselect();">Export Invoice</button>
                 </a>
             {/if}
            </div>
            <div class="col-md-2 text-right">
                <span id="updating" style="display: none;">
                    <img src="{$SITE_IMAGES}sm_images/progress.gif" alt=""/><a style="vertical-align:top;">Processing</a>
                </span>
                <span id="dispmsg" class="msg"></span>
                {if $deletepo eq 'Yes'}
                    <button class="btn btn-primary pull-left" onClick="Delete('deleteall','')">Delete All</button>
                {/if}
            </div>


        </div>
    </div>
					<div class="row">
								<div class="col-lg-12">
									<div class="main-box clearfix">
										<header class="main-box-header clearfix">

										</header>

										<div class="main-box-body clearfix">
											<div class="table-responsive">


                                                <input type="hidden" name="cursort" id="cursort" value="" />
                                                <input type="hidden" name="cursorttype" id="cursorttype" value="" />

                                                <input type="hidden" name="mod" id="mod" value=""/>
                                                <input type="hidden" name="invsts" id="invsts"
                                                       value="{$invsts}"/>
                                                <input type="hidden" name="invStatus" id="invStatus"
                                                       value="{$invStatus}"/>

                                                <form name="exp" id="exp" method="post"
                                                      action="{$SITE_URL_DUM}index.php?file=m-exportinvoice">
                                                    <div id="grouplist">
                                                        <input type="hidden" name="pg" id="pg" value="1"/>
                                                        <input type="hidden" name="enc" id="enc" value="n"/>
                                                    </div>
                                                </form>
                                                <input type="hidden" name="m" id="m" value="" />
											</div>
										</div>
									</div>
								</div>
							</div>
</div>



<!-- global scripts -->

	<script src="{$SITE_JS}jquery.js"></script>
	<script src="{$SITE_JS}bootstrap.js"></script>
	<script src="{$SITE_JS}jquery.nanoscroller.min.js"></script>
	<script src="{$SITE_JS}bootstrap-datepicker.js"></script>


	<!-- this page specific scripts -->
	<script src="{$SITE_JS}bootstrap-timepicker.min.js"></script>

	<!-- theme scripts -->
	<script src="{$SITE_JS}scripts.js"></script>
	<script src="{$SITE_JS}pace.min.js"></script>
	<!-- this page specific inline scripts -->
<script type="text/javascript" src="{$SITE_JS_AJAX}jlistinvoice.js"></script>

{literal}
<script>
	$(document).ready(function() {


		//timepicker
		$('#fTime').timepicker({
			minuteStep: 5,
			showSeconds: true,
			showMeridian: false,
			disableFocus: false,
			showWidget: true
		}).focus(function() {
			$(this).next().trigger('click');
		});
		$('#tTime').timepicker({
			minuteStep: 5,
			showSeconds: true,
			showMeridian: false,
			disableFocus: false,
			showWidget: true
		}).focus(function() {
			$(this).next().trigger('click');
		});

    	//datepicker
		$('#fDate').datepicker({
		  format: 'yy-mm-dd',
          autoclose: true
		});
		$('#tDate').datepicker({
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
	   $.colorbox({width:"71%", height:"90%",iframe:true,href:SITE_URL_DUM+"reportsrptpop/inv/"+id+"/pop"});
	});
	//

});

function chkselect()
{
	var inv = $('input:checked[name="iInvoiceID\[\]"]');
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