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
										<li class="active"><span>{$LBL_INBOX}</span></li>
									</ol>

									<h1>{$LBL_INBOX}</h1>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
								<div class="form-group">
                                    <div class="col-md-12">
									<label for="exampleInputPassword1">Search By Subject</label>
									<input type="text" class="form-control" name="search_key" id="search_key" placeholder="Search By Subject">
                                    </div>
								</div>

								<div class="form-group">
                                    <div class="col-md-5">
									<label for="datepickerDate">From</label>
									<div class="input-group col-md-12">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										<input type="text" class="form-control" name="from" id="from">
									</div>
                                    </div>
                                    <div class="col-md-5">
                                    <label for="datepickerDate1">To</label>
									<div class="input-group col-md-12">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										<input type="text" class="form-control"name="to" id="to">
									</div>
                                    </div>
                                    <div class="col-md-2">
									<input type="button" class="btn btn-primary search" value="Search" id="exampleInputPassword1" placeholder="status" onclick="getgrouplist('srch',1,'')">
                                    </div>
								</div>
                                

						</div>
					</div>
                    <div class="row" align="center">
                        <div class="col-md-10">
                            <span id="dispmsg" style="font-size: 15px;font-weight: bold;color: red;">
                           </span>
                        </div>
                        <div class="col-md-1">
                            <span id="updating" style="display: none;">
                               <img src="{$SITE_IMAGES}sm_images/progress.gif" alt="" style="vertical-align:middle;" />&nbsp;Processing
                              </span>
                           {*<img src="{$SITE_IMAGES}sm_images/btn-delete-1.gif"  align="right" alt="" border="0" style="cursor:pointer;" onclick="Delete('deleteall','')"/>*}

                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-primary search" align="right" onclick="Delete('deleteall','')">Delete </button>
                        </div>


                      </div>

							<div class="row">
								<div class="col-lg-12">
									<div class="main-box clearfix">
										<header class="main-box-header clearfix">
											
										</header>

										<div class="main-box-body clearfix">
											<div class="table-responsive">
												<input type="hidden" name="mod" id="mod" value="" />
					                            <div id="grouplist"><input type="hidden" name="pg" id="pg" value="1"/></div>
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


	<!-- this page specific scripts -->
	<script src="{$SITE_JS}jquery.dataTables.js"></script>
	<script src="{$SITE_JS}dataTables.fixedHeader.js"></script>
	<script src="{$SITE_JS}dataTables.tableTools.js"></script>
	<script src="{$SITE_JS}jquery.dataTables.bootstrap.js"></script>
	<script src="{$SITE_JS}bootstrap-timepicker.min.js"></script>

	<!-- theme scripts -->
	<script src="{$SITE_JS}scripts.js"></script>
	<script src="{$SITE_JS}pace.min.js"></script>
	<script src="{$SITE_JS}tablesaw.js"></script>


<script type="text/javascript" src="{$SITE_JS_AJAX}jlistinbox.js"></script>

{literal}
<script>
	$(document).ready(function() {
    	//datepicker
		$('#from').datepicker({
		  format: 'mm-dd-yyyy',
		  autoclose: true
		});
		$('#to').datepicker({
		  format: 'mm-dd-yyyy',
		  autoclose: true
		});

	});
	</script>
<script type="text/javascript">
jQuery(document).ready(function() {
	$("#from").attr('readonly','readonly');

	//
	$("#to").attr('readonly','readonly');
	
	/*jQuery("#from").dynDateTime({
		showsTime: true,
		ifFormat: "%Y-%m-%d %H:%M:00",
		daFormat: "%l;%M %p, %e %m,  %Y",
		align: "TL",
		electric: false,
		singleClick: false,
      button:".next()",
		displayArea: ".siblings('.dtcDisplayArea')"
	});
	jQuery("#to").dynDateTime({
		showsTime: true,
		ifFormat: "%Y-%m-%d %H:%M:00",
		daFormat: "%l;%M %p, %e %m,  %Y",
		align: "TL",
		electric: false,
		singleClick: false,
      button:".next()",
		displayArea: ".siblings('.dtcDisplayArea')"
	});*/
});
/*
Date.format = 'yyyy-mm-dd';
//dateFormat: 'yy-mm-dd',
//Date.timeFormat= ' hh:ii:ss';
$("#from").attr('readonly','readonly');
$('#from').datePicker({startDate:'2001-01-01'});
$("#to").attr('readonly','readonly');
$('#to').datePicker({startDate:'2001-01-01'});
*/
</script>
{/literal}