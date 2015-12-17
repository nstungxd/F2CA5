<link rel="stylesheet" type="text/css" media="all" href="{$DATETIMEPICKER}css/calendar-blue.css" />
<link rel="stylesheet" type="text/css" href="{$SITE_CSS}main.css">
<div id="content-wrapper">
					<div class="row">
						<div class="col-lg-12">
							<div id="content-header" class="clearfix">
								<div class="pull-left">
									<ol class="breadcrumb">
										<li><a href="#">Home</a></li>
										<li class="active"><span>{$LBL_INVOICE}</span></li>
									</ol>
									
									<h1>{$LBL_VIEW} {$LBL_INVOICE}</h1>
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
											<li class="active"><a href="{$SITE_URL_DUM}invoiceview/{$iInvoiceID}{if $msg eq 'pop'}/pop{/if}">{$LBL_VIEW} {$LBL_INV_HEADER}</a></li>
                                            {if $imgdt neq 'yes'}
											<li><a href="{$SITE_URL_DUM}invprefview/{$iInvoiceID}{if $msg eq 'pop'}/pop{/if}">{$LBL_VIEW} {$LBL_PREFERENCES}</a></li>
											<li><a href="{$SITE_URL_DUM}invoiceviewitems/{$iInvoiceID}{if $msg eq 'pop'}/pop{/if}">{$LBL_VIEW} {$LBL_INVOICE_ITEM}</a></li>
                                             {/if}
										</ul>
										<div class="tab-content">
											<div class="tab-pane fade in active" id="tab-home">
												<div class="row" id="msg">
                                                    {if $msg neq 'pop'}
                                                    {if $usertype neq 'orgadmin'}{$nxtstatus.vStatusMsg|htmlentities}{/if}
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
                                                    {$LBL_PO_STATUS_PARTIAL_PO}
                                                    {elseif $postat eq 'act'}
                                                    <span class="label label-danger">{$LBL_ACCEPTED}</span>
                                                    {/if}
                                                    {/if}
                                                    {/if}
                                                    {if $msg neq 'pop'}
                                                    <a href="javascript:openpopup('{$SITE_URL_DUM}invoiceviewhistory/{$iInvoiceID}')" >{$LBL_VIEW_HISTORY}</a>
                                                     {/if}
												</div>
												<div class="row">
                                                    <form name="frmadd" id="frmadd" action="{$SITE_URL}index.php?file=u-invoicecreate_a"  method="post">
                                                    <input type="hidden" name="iInvoiceID" id="iInvoiceID" value="{$iInvoiceID}" />
                                                    <input type="hidden" name="nstatus" id="nstatus" value="{$nxtstatus.iStatusID}" />
                                                    <input type="hidden" name="edelete" id="edelete" value="{$invoiceData.eDelete}" />
                                                    <input type="hidden" name="view" id="view" value="{$view}" />
													<dl class="dl-horizontal">
														<dt>{$LBL_SUPPLIER} {$LBL_COMP_NAME}</dt>
														<dd>{$invoiceData.vSupplierName}</dd>
														<dt>{$LBL_SUPPLIER} {$LBL_CODE}</dt>
														<dd>{$invoiceData.vInvoiceSupplierCode}</dd>
														<dt>{$LBL_INV_SUPPLIER_CODE}</dt>
														<dd>{$invoiceData.vInvSupplierCode}</dd>
														<dt>{$LBL_RELATED_PO_CODE} </dt>
														<dd>{$invoiceData.vExtPOCode}</dd>
                                                        {if $imgdt neq 'yes'}
                                                        <dt>{$LBL_BUYER}</dt>
														<dd>{$invoiceData.vBuyerName}</dd>
														<dt>{$LBL_BUYER} {$LBL_CONTACT_PARTY}</dt>
														<dd>{$invoiceData.vBuyerContactParty}</dd>
                                                        {/if}
														<dt>{$LBL_INV_CODE}</dt>
														<dd>{$invoiceData.vInvoiceCode}</dd>
														<dt>{$LBL_ISSUE_DATE}</dt>
														<dd>{$invoiceData.dIssueDate|calcLTzTime|DateTime:10}</dd>
                                                        {if $imgdt neq 'yes'}
                                                        <dt>{$LBL_INVOICE_DESCRIPTION}</dt>
                                                        <dd>{$invoiceData.tOrderDescription|stripslashes}</dd>
                                                        <dt>{$LBL_OPENING_UNIT}</dt>
                                                        <dd>{$invoiceData.iOpeningUnit}</dd>
                                                        <dt>{$LBL_SUPPLIER} {$LBL_ORDER_NUMBER}</dt>
                                                        <dd>{$invoiceData.vSupplierOrderNum}</dd>
                                                        <dt>{$LBL_INVOICE_TYPE}</dt>
                                                        <dd>{$invoiceData.eInvoiceType}</dd>
                                                        <dt>{$LBL_CARRIER}</dt>
                                                        <dd>{$invoiceData.tCarrier}</dd>
                                                        <dt>{$LBL_LINE_ITEM_TAX}</dt>
                                                        <dd>{$invoiceData.eLineItemTax}</dd>
                                                        <dt>{$LBL_VAT}</dt>
                                                        <dd>{$invoiceData.fVAT}</dd>
                                                        <dt>{$LBL_OTHER_TAX}</dt>
                                                        <dd>{$invoiceData.fOtherTax1}</dd>
                                                        <dt>{$LBL_FREIGHT}</dt>
                                                        <dd>{$invoiceData.vFreight}</dd>
                                                        <dt>{$LBL_MISCELLANEOUS}</dt>
                                                        <dd>{$invoiceData.tMiscellaneous|stripslashes}</dd>
                                                        <dt>{$LBL_INVOICE_TOTAL}</dt>
                                                        <dd>{$invoiceData.fInvoiceTotal}</dd>
                                                        <dt>{$LBL_DISCOUNT_BASELINE}</dt>
                                                        <dd>{$invoiceData.dCashDiscountBaseline|DateTime:10}</dd>
                                                        <dt>{$LBL_MAXCASH_DISCOUNTDAYS}</dt>
                                                        <dd>{$invoiceData.iMaxCashDiscountDays}</dd>
                                                        <dt>{$LBL_MAXCASH_DISCOUNTPERCENT}</dt>
                                                        <dd>{$invoiceData.fMaxCashDiscountPercentage}</dd>
                                                        <dt>{$LBL_NORMALCASH_DISCOUNTDAYS}</dt>
                                                        <dd>{$invoiceData.iNormalCashDiscountDays}</dd>
                                                        <dt>{$LBL_NORMALCASH_DISCOUNTPERCNET}</dt>
                                                        <dd>{$invoiceData.iNormalCashDiscountPercentage}</dd>
                                                        <dt>{$LBL_BILL_TO}  {$LBL_PARTY}</dt>
                                                        <dd>{$invoiceData.vBillToParty}</dd>
                                                        <dt>{$LBL_BILL_TO} {$LBL_ADDR_LINE}1</dt>
                                                        <dd>{$invoiceData.vBillToAddLine1}</dd>
                                                        <dt>{$LBL_BILL_TO} {$LBL_ADDR_LINE}2</dt>
                                                        <dd>{$invoiceData.vBillToAddLine2}</dd>
                                                        <dt>{$LBL_BILL_TO} {$LBL_CITY}</dt>
                                                        <dd>{$invoiceData.vBillToCity}</dd>
                                                        <dt>{$LBL_BILL_TO} {$LBL_COUNTRY}</dt>
                                                        <dd>{$invoiceData.vBillToCountry}</dd>
                                                        <dt>{$LBL_BILL_TO} {$LBL_STATE}</dt>
                                                        <dd>{$invoiceData.vBillToState}</dd>
                                                        <dt>{$LBL_BILL_TO} {$LBL_ZIP_CODE}</dt>
                                                        <dd>{$invoiceData.vBillToZipCode}</dd>
                                                        <dt>{$LBL_BILL_TO} {$LBL_CONTACT_PARTY}</dt>
                                                        <dd>{$invoiceData.vBillToContactParty}</dd>
                                                        <dt>{$LBL_BILL_TO} {$LBL_CONTACT_TELEPHONE}</dt>
                                                        <dd>{$invoiceData.vBillToContactTelephone}</dd>
                                                        <dt>{$LBL_CURRENCY}</dt>
                                                        <dd>{$invoiceData.vCurrency}</dd>
                                                        <dt>{$LBL_VAT_ID}</dt>
                                                        <dd>{$invoiceData.vVatId}</dd>
                                                        <dt>{$LBL_BANK}</dt>
                                                        <dd>{$invoiceData.vBankName}</dd>
                                                        <dt>{$LBL_BANK_CODE}</dt>
                                                        <dd>{$invoiceData.vBankCode}</dd>
                                                        <dt>{$LBL_BRANCH}</dt>
                                                        <dd>{$invoiceData.vBranchName}</dd>
                                                        <dt>{$LBL_BRANCH_CODE}</dt>
                                                        <dd>{$invoiceData.vBranchCode}</dd>
                                                        <dt>{$LBL_ACCOUNT} {$LBL_TITLE}</dt>
                                                        <dd>{$invoiceData.vAccountName}</dd>
                                                        <dt>{$LBL_ACCOUNT} {$LBL_NUMBER}</dt>
                                                        <dd>{$invoiceData.vAccountNumber}</dd>
                                                        <dt>{$LBL_IBAN}</dt>
                                                        <dd>{$invoiceData.vIBAN}</dd>
                                                        <dt>{$LBL_INVOICE_TOTAL}</dt>
                                                        <dd>{$invoiceData.fInvoiceTotal}</dd>
                                                        <dt>{$LBL_PRE_PAYMENT}</dt>
                                                        <dd>{$invoiceData.fPrePayment}</dd>
                                                        {else}
                                                        <dt>{$LBL_OTHER_DETAILS} </dt>
														<dd><img src="{$img}" /></dd>
                                                        {/if}
                                                        {if $permitted eq 'Yes' && $usertype neq 'orgadmin'}
                                                        <dt>{$LBL_REASON_TO_REJECT} </dt>
                                                        <dd><textarea id="tReasonToReject" name="tReasonToReject" cols="70" rows="3"></textarea></dd>
                                                        {elseif $invoiceData.iStatusID eq $rjtsts}
                                                        <dt>{$LBL_REASON_TO_REJECT}</dt>
                                                        <dd><textarea id="tReasonToReject" name="tReasonToReject" cols="70" rows="3" readonly="readonly">{$invoiceData.tReasonToReject|trim}</textarea></dd>
                                                        {/if}

                                                        {if $invAttachments|@count gt 0}
                                                        <dt>{$LBL_UPLOADED_FILES}</dt>
                                                        <dd><div id="files_list" class="file_upload">
                                                                <ul style="list-style-type: none">
                                                                    {foreach from=$invAttachments item="invAttach"}
                                                                    <li>
                                                                        <a href="javascript:openpopup('{$SITE_URL}upload/attachment_docs/invoice/{$iInvoiceID}/{$invAttach.vFile}')" > {$invAttach.vFile}</a>
                                                                    </li>
                                                                    {/foreach}
                                                                </ul>
                                                            </div>
                                                        </dd>
                                                        {/if}

													</dl>
                                                    </form>
												</div>
                                                {if $msg neq 'pop'}
												<center class="row">
                                                    {if $permitted eq 'Yes' && $usertype neq 'orgadmin'}
                                                    {if $auth neq 'y'}
                                                    {if $act eq 'y'}
                                                    <button class="btn btn-primary" type="button" id="reset_btn" onclick="$('#view').val('verify');$('#frmadd').submit();">Accept</button>
                                                    {elseif $isue eq 'y'}
                                                    <button class="btn btn-primary" type="button"  id="reset_btn" onclick="$('#view').val('verify');$('#frmadd').submit();">Issue</button>
                                                    {else}
                                                    <button class="btn btn-primary" type="button"  id="reset_btn" onclick="$('#view').val('verify');$('#frmadd').submit();">Verify</button>
                                                    {/if}
                                                    {else}
                                                    <button class="btn btn-primary" type="button"  id="reset_btn" onclick="$('#view').val('verify');$('#frmadd').submit();">Authorise</button>
                                                    {/if}
                                                    <button class="btn btn-primary" type="button"  id="reset_btn" onclick="$('#view').val('verify');$('#frmadd').submit();">Reject</button>
                                                    {/if}
                                                    <button class="btn btn-primary" type="button"  id="reset_btn" {if $curORGID eq $invoiceData.iBuyerOrganizationID}onclick="location.href='{$SITE_URL_DUM}invacptlist/{$smarty.session.invlvl}';"{else}onclick="location.href='{$SITE_URL_DUM}invoicelist/{$smarty.session.invlvl}';"{/if}>Back</button>
                                                    {if $invoiceData.iStatusID eq $acptsts[0].iStatusID && $invoiceData.iaStatusID eq $acptsts[0].iStatusID && $invoiceData.iaStatusID|trim neq '' && $invoiceData.iaStatusID >0}
                                                    <a title="{$LBL_PRINT}" style="cursor:pointer" class="colorboxfile" rel="{$iInvoiceID}">
                                                        <a href="#" class="btn btn-primary" id="print_btn">Print</a>
                                                    </a>
                                                    {/if}


												</center>
                                                {/if}
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