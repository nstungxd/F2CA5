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
											<li class="active">
                                                <a href="{$SITE_URL_DUM}purchaseorderview/{$iPurchaseOrderID}{if $var_msg eq 'pop'}/pop{/if}" class="current"><em>{$LBL_VIEW} {$LBL_PO_HEADER}</em></a>
                                            </li>
                                            {if $imgdt neq 'yes'}
											<li><a href="{$SITE_URL_DUM}poprefview/{$iPurchaseOrderID}{if $var_msg eq 'pop'}/pop{/if}"><em>{$LBL_VIEW} {$LBL_PREFERENCES}</em></a></li>
											<li><a href="{$SITE_URL_DUM}poviewitems/{$iPurchaseOrderID}{if $var_msg eq 'pop'}/pop{/if}" ><em>{$LBL_VIEW_PO_ITEM}</em></a></li>
                                             {/if}
										</ul>
										<div class="tab-content">
											<div class="tab-pane fade in active" id="tab-home">
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
                                                    {elseif $invstat eq 'act'}
                                                    <span class="label label-danger">{$LBL_STATUS}: {$LBL_ACCEPTED}</span>
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
                                                        <dt>{$LBL_BUYER} {$LBL_COMP_NAME}</dt>
                                                        <dd>{$poData.vBuyerCompanyName}</dd>
                                                        <dt>{$LBL_BUYER} {$LBL_CODE}</dt>
                                                        <dd>{$poData.vBuyerCode}</dd>
                                                        {if $imgdt neq 'yes'}
                                                        <dt>{$LBL_SUPPLIER} {$LBL_COMPANY}</dt>
                                                        <dd>{$poData.vSupplierName}</dd>
                                                        <dt>{$LBL_SUPPLIER} {$LBL_CONTACT_PARTY}</dt>
                                                        <dd>{$poData.vSupplierContactParty}</dd>
                                                        {/if}
                                                        <dt>{$LBL_PO_BUYER_CODE}</dt>
                                                        <dd>{$poData.vPoBuyerCode}</dd>
                                                        <dt>{$LBL_PO_CODE} </dt>
                                                        <dd>{$poData.vPOCode}</dd>
                                                        <dt>{$LBL_ORDER_DATE}</dt>
                                                        <dd>{$poData.dOrderDate|DateTime:'10'}</dd>
                                                        {if $imgdt neq 'yes'}
                                                        <dt>{$LBL_ORDER_DESCRIPTION}</dt>
                                                        <dd>{$poData.tOrderDescription}</dd>
                                                        <dt>{$LBL_OPENING_UNIT}</dt>
                                                        <dd>{$poData.iOpeningUnit}</dd>
                                                        <dt>{$LBL_SUPPLIER} {$LBL_ORDER_NUMBER} </dt>
                                                        <dd>{$poData.vSupplierOrderNum}</dd>
                                                        <dt>{$LBL_CARRIER}</dt>
                                                        <dd>{$poData.tCarrier}</dd>
                                                        <dt>{$LBL_LINE_ITEM_TAX}</dt>
                                                        <dd>{$poData.eLineItemTax}</dd>
                                                        <dt>{$LBL_VAT}</dt>
                                                        <dd>{$poData.fVAT}</dd>
                                                        <dt>{$LBL_OTHER_TAX}</dt>
                                                        <dd>{$poData.fOther_tax_1}</dd>
                                                        <dt>{$LBL_SHIP_TO} {$LBL_PARTY}</dt>
                                                        <dd>{$poData.vShipToParty}</dd>
                                                        <dt>{$LBL_SHIP_TO} {$LBL_ADDR_LINE}1</dt>
                                                        <dd>{$poData.vShipToAddressLine1}</dd>
                                                        <dt>{$LBL_SHIP_TO} {$LBL_ADDR_LINE}2</dt>
                                                        <dd>{$poData.vShipToAddressLine2}</dd>
                                                        <dt>{$LBL_SHIP_TO} {$LBL_CITY}</dt>
                                                        <dd>{$poData.vShipToCity}</dd>
                                                        <dt>{$LBL_SHIP_TO} {$LBL_COUNTRY}</dt>
                                                        <dd>{$poData.vShipToCountry}</dd>
                                                        <dt>{$LBL_SHIP_TO} {$LBL_STATE}</dt>
                                                        <dd>{$poData.vShipToState}</dd>
                                                        <dt>{$LBL_SHIP_TO} {$LBL_ZIP_CODE}</dt>
                                                        <dd>{$poData.vShipToZipCode}</dd>
                                                        <dt>{$LBL_SHIP_TO} {$LBL_CONTACT_PARTY}</dt>
                                                        <dd>{$poData.vShipToContactParty}</dd>
                                                        <dt>{$LBL_SHIP_TO} {$LBL_CONTACT_TELEPHONE}</dt>
                                                        <dd>{$poData.vShipToContactTelephone}</dd>
                                                        <dt>{$LBL_BILL_TO}  {$LBL_PARTY}</dt>
                                                        <dd>{$poData.vBillToParty}</dd>
                                                        <dt>{$LBL_BILL_TO} {$LBL_ADDR_LINE}1</dt>
                                                        <dd>{$poData.vBillToAddLine1}</dd>
                                                        <dt>{$LBL_BILL_TO} {$LBL_ADDR_LINE}2</dt>
                                                        <dd>{$poData.vBillToAddLine2}</dd>
                                                        <dt>{$LBL_BILL_TO} {$LBL_CITY} </dt>
                                                        <dd>{$poData.vBillToCity}</dd>
                                                        <dt>{$LBL_BILL_TO} {$LBL_COUNTRY}</dt>
                                                        <dd>{$poData.vBillToCountry}</dd>
                                                        <dt>{$LBL_BILL_TO} {$LBL_STATE}</dt>
                                                        <dd>{$poData.vBillToState}</dd>
                                                        <dt>{$LBL_BILL_TO} {$LBL_ZIP_CODE}</dt>
                                                        <dd>{$poData.vBillToZipCode}</dd>
                                                        <dt>{$LBL_BILL_TO} {$LBL_CONTACT_PARTY}</dt>
                                                        <dd>{$poData.vBillToContactParty}</dd>
                                                        <dt>{$LBL_BILL_TO} {$LBL_CONTACT_TELEPHONE}</dt>
                                                        <dd>{$poData.vBillToContactTelephone}</dd>
                                                        <dt>{$LBL_CURRENCY}</dt>
                                                        <dd>{$poData.vCurrency}</dd>
                                                        <dt>{$LBL_PO_TOTAL}</dt>
                                                        <dd>{$poData.fPOTotal}</dd>
                                                        <dt>{$LBL_PRE_PAYMENT}</dt>
                                                        <dd>{$poData.fPrepayment}</dd>
                                                        {else}
                                                        <dt>{$LBL_OTHER_DETAILS}</dt>
                                                        <dd><img src="{$img}" /></dd>
                                                        {/if}
                                                        {if $permitted eq 'Yes' && $usertype neq 'orgadmin'}
                                                        <dt>{$LBL_REASON_TO_REJECT}</dt>
                                                        <dd><textarea id="tReasonToReject" name="tReasonToReject" class="form-control" cols="50" rows="3"></textarea></dd>
                                                        {elseif $poData.tReasonToReject|trim neq '' && $poData.eStatus eq $rjtsts}
                                                        <dt>{$LBL_REASON_TO_REJECT}</dt>
                                                        <dd><textarea id="tReasonToReject" name="tReasonToReject" class="form-control" cols="50" rows="3" readonly="readonly">{$poData.tReasonToReject|trim}</textarea></dd>
                                                        {/if}
                                                        {if $poAttachments|@count gt 0}
                                                        <dt>{$LBL_UPLOADED_FILES}</dt>
                                                        <dd><div id="files_list" class="file_upload">
                                                                <ul style="list-style-type: none">
                                                                    {foreach from=$poAttachments item="poAttach"}
                                                                    <li>
                                                                        <a href="javascript:openpopup('{$SITE_URL}upload/attachment_docs/po/{$iPurchaseOrderID}/{$poAttach.vFile}')" > {$poAttach.vFile}</a>
                                                                    </li>
                                                                    {/foreach}
                                                                </ul>
                                                            </div>
                                                        </dd>
                                                        {/if}
													</dl>
                                                    </form>
												</div>

												<center class="row">
                                                    <button class="btn btn-primary" type="button" id="rst_btn" {if $curORGID eq $poData.iSupplierOrganizationID}onclick="location.href='{$SITE_URL_DUM}poacptlist/{$smarty.session.polvl}';"{else}onclick="location.href='{$SITE_URL_DUM}polist/{$smarty.session.polvl}';"{/if}>Back</button>
                                                    {if $permitted eq 'Yes' && $usertype neq 'orgadmin'}
                                                     {if $auth neq 'y'}
                                                     {if $act eq 'y'}
                                                    <button class="btn btn-primary" type="button" id="resetbtn" onclick="$('#view').val('verify');$('#frmadd').submit();">Accept</button>
                                                    {elseif $isue eq 'y'}
                                                    <button class="btn btn-primary" type="button"  id="resetbtn" onclick="$('#view').val('verify');$('#frmadd').submit();">Issue</button>
                                                    {else}
                                                    <button class="btn btn-primary" type="button"  id="resetbtn" onclick="$('#view').val('verify');$('#frmadd').submit();" >Verify</button>
                                                    {/if}
                                                    {else}
                                                    <button class="btn btn-primary" type="button"  id="resetbtn" onclick="$('#view').val('verify');$('#frmadd').submit();">Authorise</button>
                                                    {/if}
                                                    <button class="btn btn-primary" type="button"  id="reset_btn" onclick="$('#view').val('reject');$('#frmadd').submit();" >Reject</button>
                                                    {/if}
                                                    {if $crt_inv eq 'yes'}
                                                    <button class="btn btn-primary" type="button"  id="reset_btn" onclick="$('#view').val('crtinv');$('#frmadd').submit();" >Create Invoice</button>
                                                    {/if}


                                                    {if $poData.iStatusID eq $acptsts[0].iStatusID && $poData.iaStatusID eq $acptsts[0].iStatusID && $poData.iaStatusID|trim neq '' && $poData.iaStatusID >0}
                                                    <a title="{$LBL_PRINT}" style="cursor:pointer" class="colorboxfile" rel="{$iPurchaseOrderID}">
                                                        <a href="#" class="btn btn-primary" id="print_btn">Print</a>
                                                    </a>
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
    $(".colorboxfile").live("click",function() {
        var id = $(this).attr('rel');
        $.colorbox({width:"71%", height:"90%",iframe:true,href:SITE_URL_DUM+"reportsrptpop/po/"+id+"/pop"});
    });
</script>
{/literal}