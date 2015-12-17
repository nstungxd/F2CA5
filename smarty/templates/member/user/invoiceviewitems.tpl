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
											<li><a href="{$SITE_URL_DUM}invprefview/{$iInvoiceID}{if $msg eq 'pop'}/pop{/if}">{$LBL_VIEW} {$LBL_PREFERENCES}</a></li>
											<li class="active"><a href="{$SITE_URL_DUM}invoiceviewitems/{$iInvoiceID}{if $msg eq 'pop'}/pop{/if}">{$LBL_VIEW} {$LBL_INVOICE_ITEM}</a></li>
                                             {/if}
										</ul>

										<div class="tab-content">
											<div class="tab-pane fade in active" id="tab-item">
                                            {if $msg neq '' && $msg neq 'pop' && $usertype neq 'orgadmin'}
                                            <div class="msg">{$msg}</div>
                                            {/if}
                                            <form name="frmadd" id="frmadd" action="{$SITE_URL}index.php?file=u-invoiceadditems_a"  method="post">
                                            <input type="hidden" name="iInvoiceID" id="iInvoiceID" value="{$invid}" />
                                            <input type="hidden" name="iSupplierOrganizationID" id="iSupplierOrganizationID" value="{$curORGID}" />
                                            <input type="hidden" name="view" id="view" value="{$view}" />
                                            <input type="hidden" value="0" id="mdiv" />
                                            {if $invoiceData|@count neq 0}
                                            {section name=i loop=$invoiceData}
                                            {assign var="cnt" value=$smarty.section.i.index+1}
                                            {if $invoiceData[i].eInvoiceType|trim eq 'Discount'}
                                            <div id="Div{$invoiceData[i].iInvoiceLineID}" name="rctbl" class="row">
													<div class="row">
														<div class="col-md-3">
															<div class="invoice-box-total detail clearfix">
																<div class="row">
																	<div class="col-sm-6 col-md-6 col-xs-6 text-left invoice-box-total-label">
																		{$LBL_LINE_TYPE} :
																	</div>
																	<div class="col-sm-6 col-md-6 col-xs-6 text-right invoice-box-total-value">
																		{$invoiceData[i].eInvoiceType}
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-3 col-md-offset-1">
															<div class="invoice-box-total detail clearfix">
																<div class="row">
																	<div class="col-sm-6 col-md-6 col-xs-6 text-left invoice-box-total-label">
																		{$LBL_ITEM_CODE} :
																	</div>
																	<div class="col-sm-6 col-md-6 col-xs-6 text-right invoice-box-total-value">
																		{$invoiceData[i].vItemCode}
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<div class="invoice-box-total detail clearfix">
																<div class="row">
																	<div class="col-md-2 text-left invoice-box-total-label">
																		{$LBL_DESCRIPTION} :
																	</div>
																	<div class="col-md-10">
																		<textarea class="form-control" cols="100" rows="3" readonly="readonly">{$invoiceData[i].tDescription|stripslashes}</textarea>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-3">
															<div class="invoice-box-total detail clearfix">
																<div class="row">
																	<div class="col-sm-6 col-md-6 col-xs-6 text-left invoice-box-total-label">
																		{$LBL_RATE} :
																	</div>
																	<div class="col-sm-6 col-md-6 col-xs-6 text-right invoice-box-total-value">
																		{$invoiceData[i].fPrice|formatMoney:true}
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-3 col-md-offset-1">
															<div class="invoice-box-total detail clearfix">
																<div class="row">
																	<div class="col-sm-6 col-md-6 col-xs-6 text-left invoice-box-total-label">
																		{$LBL_LINE_TOTAL} :
																	</div>
																	<div class="col-sm-6 col-md-6 col-xs-6 text-right invoice-box-total-value">
																		{$invoiceData[i].fLineTotal|formatMoney:true}
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-3 col-md-offset-1">
															<div class="invoice-box-total detail clearfix">
																<div class="row">
																	<div class="col-sm-6 col-md-6 col-xs-6 text-left invoice-box-total-label">
																	</div>
																	<div class="col-sm-6 col-md-6 col-xs-6 text-right invoice-box-total-value">
																	</div>
																</div>
															</div>
														</div>
													</div>
													
												</div>
                                            {elseif $invoiceData[i].eInvoiceType|trim eq 'Charge'}
                                            <div id="Div{$invoiceData[i].iInvoiceLineID}" name="rctbl" class="row">
													<div class="row">
														<div class="col-md-3">
															<div class="invoice-box-total detail clearfix">
																<div class="row">
																	<div class="col-sm-6 col-md-6 col-xs-6 text-left invoice-box-total-label">
																		{$LBL_LINE_TYPE} :
																	</div>
																	<div class="col-sm-6 col-md-6 col-xs-6 text-right invoice-box-total-value">
																		{$invoiceData[i].eInvoiceType}
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-3 col-md-offset-1">
															<div class="invoice-box-total detail clearfix">
																<div class="row">
																	<div class="col-sm-6 col-md-6 col-xs-6 text-left invoice-box-total-label">
																		{$LBL_ITEM_CODE} :
																	</div>
																	<div class="col-sm-6 col-md-6 col-xs-6 text-right invoice-box-total-value">
																		{$invoiceData[i].vItemCode}
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<div class="invoice-box-total detail clearfix">
																<div class="row">
																	<div class="col-md-2 text-left invoice-box-total-label">
																		{$LBL_DESCRIPTION} :
																	</div>
																	<div class="col-md-10">
																		<textarea class="form-control" cols="100" rows="3" readonly="readonly">{$invoiceData[i].tDescription|stripslashes}</textarea>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-3">
															<div class="invoice-box-total detail clearfix">
																<div class="row">
																	<div class="col-sm-6 col-md-6 col-xs-6 text-left invoice-box-total-label">
																		{$LBL_RATE} :
																	</div>
																	<div class="col-sm-6 col-md-6 col-xs-6 text-right invoice-box-total-value">
																		{$invoiceData[i].fPrice|formatMoney:true}
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-3 col-md-offset-1">
															<div class="invoice-box-total detail clearfix">
																<div class="row">
																	<div class="col-sm-6 col-md-6 col-xs-6 text-left invoice-box-total-label">
																		{$LBL_LINE_TOTAL} :
																	</div>
																	<div class="col-sm-6 col-md-6 col-xs-6 text-right invoice-box-total-value">
																		{$invoiceData[i].fLineTotal|formatMoney:true}
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-3 col-md-offset-1">
															<div class="invoice-box-total detail clearfix">
																<div class="row">
																	<div class="col-sm-6 col-md-6 col-xs-6 text-left invoice-box-total-label">
																		
																	</div>
																	<div class="col-sm-6 col-md-6 col-xs-6 text-right invoice-box-total-value">
																		
																	</div>
																</div>
															</div>
														</div>
													</div>

												</div>
                                            {else}
                                            <div id="Div{$invoiceData[i].iInvoiceLineID}" name="rctbl" class="row">
													<div class="row">
														<div class="col-md-3">
															<div class="invoice-box-total detail clearfix">
																<div class="row">
																	<div class="col-sm-6 col-md-6 col-xs-6 text-left invoice-box-total-label">
																		{$LBL_LINE_TYPE} :
																	</div>
																	<div class="col-sm-6 col-md-6 col-xs-6 text-right invoice-box-total-value">
																		{$invoiceData[i].eInvoiceType}
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-3 col-md-offset-1">
															<div class="invoice-box-total detail clearfix">
																<div class="row">
																	<div class="col-sm-6 col-md-6 col-xs-6 text-left invoice-box-total-label">
																		{$LBL_ITEM_CODE} :
																	</div>
																	<div class="col-sm-6 col-md-6 col-xs-6 text-right invoice-box-total-value">
																		{$invoiceData[i].vItemCode}
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-3">
															<div class="invoice-box-total detail clearfix">
																<div class="row">
																	<div class="col-sm-6 col-md-6 col-xs-6 text-left invoice-box-total-label">
																		{$LBL_UNIT_MEASURE} :
																	</div>
																	<div class="col-sm-6 col-md-6 col-xs-6 text-right invoice-box-total-value">
																		{$invoiceData[i].vUnitOfMeasure}
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-3 col-md-offset-1">
															<div class="invoice-box-total detail clearfix">
																<div class="row">
																	<div class="col-sm-6 col-md-6 col-xs-6 text-left invoice-box-total-label">
																		{$LBL_PART_NO} :
																	</div>
																	<div class="col-sm-6 col-md-6 col-xs-6 text-right invoice-box-total-value">
																		{$invoiceData[i].vPartNo}
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<div class="invoice-box-total detail clearfix">
																<div class="row">
																	<div class="col-md-2 text-left invoice-box-total-label">
																		{$LBL_DESCRIPTION} :
																	</div>
																	<div class="col-md-10">
																		<textarea class="form-control" cols="100" rows="3" readonly="readonly">{$invoiceData[i].tDescription|stripslashes}</textarea>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-3">
															<div class="invoice-box-total detail clearfix">
																<div class="row">
																	<div class="col-sm-6 col-md-6 col-xs-6 text-left invoice-box-total-label">
																		{$LBL_QUANTITY} :
																	</div>
																	<div class="col-sm-6 col-md-6 col-xs-6 text-right invoice-box-total-value">
																		{$invoiceData[i].iQuantity}
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-3 col-md-offset-1">
															<div class="invoice-box-total detail clearfix">
																<div class="row">
																	<div class="col-sm-6 col-md-6 col-xs-6 text-left invoice-box-total-label">
																		{$LBL_PRICE} :
																	</div>
																	<div class="col-sm-6 col-md-6 col-xs-6 text-right invoice-box-total-value">
																		{$invoiceData[i].fPrice|formatMoney:true}
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-3 col-md-offset-1">
															<div class="invoice-box-total detail clearfix">
																<div class="row">
																	<div class="col-sm-6 col-md-6 col-xs-6 text-left invoice-box-total-label">
																		{$LBL_AMOUNT} :
																	</div>
																	<div class="col-sm-6 col-md-6 col-xs-6 text-right invoice-box-total-value">
																		{$invoiceData[i].fAmount|formatMoney:true}
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-3">
															<div class="invoice-box-total detail clearfix">
																<div class="row">
																	<div class="col-sm-6 col-md-6 col-xs-6 text-left invoice-box-total-label">
																		{$LBL_VAT} {$LBL_RATE} (%) :
																	</div>
																	<div class="col-sm-6 col-md-6 col-xs-6 text-right invoice-box-total-value">
																		{$invoiceData[i].fVAT}
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-3 col-md-offset-1">
															<div class="invoice-box-total detail clearfix">
																<div class="row">
																	<div class="col-sm-6 col-md-6 col-xs-6 text-left invoice-box-total-label">
																		{$LBL_VAT} :
																	</div>
                                                                    {assign var="vat" value=`$invoiceData[i].fAmount*$invoiceData[i].fVAT/100`}
																	<div class="col-sm-6 col-md-6 col-xs-6 text-right invoice-box-total-value">
																		{$vat|formatMoney:true}
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-3 col-md-offset-1">
															<div class="invoice-box-total detail clearfix">
																<div class="row">
																	<div class="col-sm-6 col-md-6 col-xs-6 text-left invoice-box-total-label">
																		{$LBL_OTHER_TAX} {$LBL_RATE} (%):
																	</div>
																	<div class="col-sm-6 col-md-6 col-xs-6 text-right invoice-box-total-value">
																		{$invoiceData[i].fOtherTax1}
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-3">
															<div class="invoice-box-total detail clearfix">
																<div class="row">
																	<div class="col-sm-6 col-md-6 col-xs-6 text-left invoice-box-total-label">
																		{$LBL_OTHER_TAX} :
																	</div>
                                                                    {assign var="otax" value=`$invoiceData[i].fAmount*$invoiceData[i].fOtherTax1/100`}
																	<div class="col-sm-6 col-md-6 col-xs-6 text-right invoice-box-total-value">
																		{$otax|formatMoney:true}
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-3 col-md-offset-1">
															<div class="invoice-box-total detail clearfix">
																<div class="row">
																	<div class="col-sm-6 col-md-6 col-xs-6 text-left invoice-box-total-label">
																		{$LBL_WITH_HOLDING_TAX} {$LBL_RATE} (%) :
																	</div>
																	<div class="col-sm-6 col-md-6 col-xs-6 text-right invoice-box-total-value">
																		{$invoiceData[i].fWithHoldingTax}
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-3 col-md-offset-1">
															<div class="invoice-box-total detail clearfix">
																<div class="row">
																	<div class="col-sm-6 col-md-6 col-xs-6 text-left invoice-box-total-label">
																		{$LBL_WITH_HOLDING_TAX}  :
																	</div>
                                                                    {assign var="wtax" value=`$invoiceData[i].fAmount*$invoiceData[i].fWithHoldingTax/100`}
																	<div class="col-sm-6 col-md-6 col-xs-6 text-right invoice-box-total-value">
																		{$wtax|formatMoney:true}
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-3">
															<div class="invoice-box-total detail clearfix">
																<div class="row">
																	<div class="col-sm-6 col-md-6 col-xs-6 text-left invoice-box-total-label">
																		{$LBL_LINE_TOTAL} :
																	</div>
																	<div class="col-sm-6 col-md-6 col-xs-6 text-right invoice-box-total-value">
																		{$invoiceData[i].fLineTotal|formatMoney:true}
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-3 col-md-offset-1">
															<div class="invoice-box-total detail clearfix">
																<div class="row">
																	<div class="col-sm-6 col-md-6 col-xs-6 text-left invoice-box-total-label">
																		{$LBL_RECEIPT} :
																	</div>
																	<div class="col-sm-6 col-md-6 col-xs-6 text-right invoice-box-total-value">
																		{$invoiceData[i].tReceipt}
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-3 col-md-offset-1">
															<div class="invoice-box-total detail clearfix">
																<div class="row">
																	<div class="col-sm-6 col-md-6 col-xs-6 text-left invoice-box-total-label">
																		{$LBL_CURRENCY} :
																	</div>
																	<div class="col-sm-6 col-md-6 col-xs-6 text-right invoice-box-total-value">
																		{$invdtls[0].vCurrency}
																	</div>
																</div>
															</div>
														</div>
													</div>
                                                    {if $invoiceData[i].eSublineType|trim neq ''}
                                                    <div class="row">
														<div class="col-md-3">
															<div class="invoice-box-total detail clearfix">
																<div class="row">
																	<div class="col-sm-6 col-md-6 col-xs-6 text-left invoice-box-total-label">
																		{$invoiceData[i].eSublineType}} :
																	</div>
																	<div class="col-sm-6 col-md-6 col-xs-6 text-right invoice-box-total-value">

																	</div>
																</div>
															</div>
														</div>
													</div>
                                                    <div class="row">
														<div class="col-md-3">
															<div class="invoice-box-total detail clearfix">
																<div class="row">
																	<div class="col-sm-6 col-md-6 col-xs-6 text-left invoice-box-total-label">
																		{$LBL_QUANTITY} :
																	</div>
																	<div class="col-sm-6 col-md-6 col-xs-6 text-right invoice-box-total-value">
																		{if $invoiceData[i].eSublineType eq ''}0{else}{$invoiceData[i].iSubQuantity}{/if}
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-3 col-md-offset-1">
															<div class="invoice-box-total detail clearfix">
																<div class="row">
																	<div class="col-sm-6 col-md-6 col-xs-6 text-left invoice-box-total-label">
																		{$LBL_RATE} :
																	</div>
																	<div class="col-sm-6 col-md-6 col-xs-6 text-right invoice-box-total-value">
																		{if $invoiceData[i].eSublineType eq ''}0{else}{$invoiceData[i].fSubRate}{/if}
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-3 col-md-offset-1">
															<div class="invoice-box-total detail clearfix">
																<div class="row">
																	<div class="col-sm-6 col-md-6 col-xs-6 text-left invoice-box-total-label">
																		<input type="hidden" name="fSubAmount[]" id="fSubAmount{$smarty.section.i.index}" class="input-rag" style="width:117px;" value="{if $invoiceData[i].eSublineType eq ''}0{else}{$invoiceData[i].fSubAmount}{/if}" />
																	</div>
																	<div class="col-sm-6 col-md-6 col-xs-6 text-right invoice-box-total-value">
																		
																	</div>
																</div>
															</div>
														</div>
													</div>
                                                    {/if}
												</div>
                                            {/if}
                                            {sectionelse}
                                            <div id="Div{$invoiceData[i].iInvoiceLineID}" name="rctbl" class="row">
													<div class="row">
														<div class="col-md-3">
															<div class="invoice-box-total detail clearfix">
																<div class="row">
																	<div class="col-sm-6 col-md-6 col-xs-6 text-left invoice-box-total-label">
                                                                        {$LBL_NO_REC_AVAILABLE}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                            {/section}
                                            <div class="row">
                                                <div id="dlines" lass="table-responsive">
                                                <table id="table-example" class="table table-hover tablesaw" data-tablesaw-mode="columntoggle" data-click-to-select="true" data-tablesaw-minimap>
                                                    <thead>
                                                    <tr>
                                                        <th scope="col" data-tablesaw-priority="persist"></th>
                                                        <th scope="col" data-tablesaw-priority="1">{$LBL_LINE_TYPE}</th>
                                                        <th scope="col" data-tablesaw-priority="4">{$LBL_DESCRIPTION}</th>
                                                        <th scope="col" data-tablesaw-priority="3">{$LBL_PART_NO}</th>
                                                        <th scope="col" data-tablesaw-priority="5" class="text-center">UOM</th>
                                                        <th scope="col" data-tablesaw-priority="6" class="text-center">Qty</th>
                                                        <th scope="col" data-tablesaw-priority="6" class="text-center">{$LBL_PRICE} / {$LBL_RATE}</th>
                                                        <th scope="col" data-tablesaw-priority="6" class="text-center">{$LBL_AMOUNT}</th>
                                                        <th scope="col" data-tablesaw-priority="6" class="text-center">{$LBL_VAT}</th>
                                                        <th scope="col" data-tablesaw-priority="6" class="text-center">{$LBL_OTHER_TAX}</th>
                                                        <th scope="col" data-tablesaw-priority="6" class="text-center">WH {$LBL_TAX}</th>
                                                        <th scope="col" data-tablesaw-priority="2" class="text-center">{$LBL_LINE_TOTAL}</th>
                                                        <th class="no-order"></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>


                                                    {section name="i" loop=$invoiceData}
                                                    {if $invoiceData[i].eInvoiceType|trim eq 'Discount'}
                                                    <tr id="spnd{$smarty.section.i.index}">
                                                        <td class="ar"><img src='{$SITE_IMAGES}sm_images/arrow-orange.gif' /></td>
                                                        <td class="text-center"><span  class="ot">{$invoiceData[i].eInvoiceType}</span></td>
                                                        <td class="text-center"><span class="td">{$invoiceData[i].tDescription}</span></td>
                                                        <td class="text-center"><span>{$invoiceData[i].vPartNo}</span></td>
                                                        <td><span class="um"></span></td>
                                                        <td><span class="iq"></span></td>
                                                        <td class="text-center"><span class="fp">{$invoiceData[i].fPrice|formatMoney:true}%</span></td>
                                                        <td class="text-center"><span class="fa">{$invoiceData[i].fAmount|formatMoney:true}</span></td>
                                                        <td class="text-center"><span class="fv">{assign var="vt" value=`$invoiceData[i].fVAT*$invoiceData[i].fAmount/100`}{$vt|formatMoney:true}</span></td>
                                                        <td class="text-center"><span class="ox">{assign var="ot" value=`$invoiceData[i].fOtherTax1*$invoiceData[i].fAmount/100`}{$ot|formatMoney:true}</span></td>
                                                        <td class="text-center"><span class="wt">{assign var="wt" value=`$invoiceData[i].fWithHoldingTax*$invoiceData[i].fAmount/100`}{$wt|formatMoney:true}</span></td>
                                                        <td class="text-center"><span class="lt">{$invoiceData[i].fLineTotal|formatMoney:true}</span></td>
                                                        <td><span class="at">
                                                            <a id="show-invoice-detail"  onclick='shwtbl({$invoiceData[i].iInvoiceLineID});'>
                                                                <span class="fa-stack"><i class="fa fa-eye"></i></span>
                                                            </a>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                {elseif $invoiceData[i].eInvoiceType|trim eq 'Charge'}
                                                    <tr id="spnd{$smarty.section.i.index}">
                                                        <td class="ar"><img src='{$SITE_IMAGES}sm_images/arrow-orange.gif' /></td>
                                                        <td class="text-center"><span class="ot">{$invoiceData[i].eInvoiceType}</span></td>
                                                        <td class="text-center"><span class="td">{$invoiceData[i].tDescription}</span></td>
                                                        <td class="text-center"><span>{$invoiceData[i].vPartNo}</span></td>
                                                        <td><span class="um"></span></td>
                                                        <td><span class="iq"></span></td>
                                                        <td class="text-center"><span class="fp">{$invoiceData[i].fPrice|formatMoney:true}%</span></td>
                                                        <td class="text-center"><span class="fa">{$invoiceData[i].fAmount|formatMoney:true}</span></td>
                                                        <td class="text-center"><span class="fv">{assign var="vt" value=`$invoiceData[i].fVAT*$invoiceData[i].fAmount/100`}{$vt|formatMoney:true}</span></td>
                                                        <td class="text-center"><span class="ox">{assign var="ot" value=`$invoiceData[i].fOtherTax1*$invoiceData[i].fAmount/100`}{$ot|formatMoney:true}</span></td>
                                                        <td class="text-center"><span class="wt">{assign var="wt" value=`$invoiceData[i].fWithHoldingTax*$invoiceData[i].fAmount/100`}{$wt|formatMoney:true}</span></td>
                                                        <td class="text-center"><span  class="lt">{$invoiceData[i].fLineTotal|formatMoney:true}</span></td>
                                                        <td class="text-center"><span class="at">
                                                            <a id="show-invoice-detail" onclick="shwtbl({$invoiceData[i].iInvoiceLineID});">
                                                                <span class="fa-stack"><i class="fa fa-eye"></i></span>
                                                            </a></span>
                                                        </td>
                                                    </tr>
                                                 {else}
                                                        <tr id="spnd{$smarty.section.i.index}">
                                                            <td class="ar"><img src='{$SITE_IMAGES}sm_images/arrow-orange.gif' /></td>
                                                            <td class="text-center"><span class="ot">{$invoiceData[i].eInvoiceType}</span></td>
                                                            <td class="text-center"><span class="td">{$invoiceData[i].tDescription}</span></td>
                                                            <td class="text-center"><span>{$invoiceData[i].vPartNo}</span></td>
                                                            <td class="text-center"><span class="um">{$invoiceData[i].vUnitOfMeasure}</span></td>
                                                            <td class="text-center"><span class="iq">{$invoiceData[i].iQuantity|formatMoney:false}</span> <input type="hidden" name="iQuantity{$smarty.section.i.index}" id="iQuantity{$smarty.section.i.index}" value="{$invoiceData[i].iQuantity}" /></td>
                                                            <td class="text-center"><span class="fp">{$invoiceData[i].fPrice|formatMoney:true}</span> <input type="hidden" name="fPrice{$smarty.section.i.index}" id="fPrice{$smarty.section.i.index}" value="{$invoiceData[i].fPrice}" /></td>
                                                            <td class="text-center"><span class="fa">{$invoiceData[i].fAmount|formatMoney:true}</span> <input type="hidden" name="fAmount{$smarty.section.i.index}" id="fAmount{$smarty.section.i.index}" value="{$invoiceData[i].fAmount}" /></td>
                                                            <td class="text-center"><span class="fv">{assign var="vt" value=`$invoiceData[i].fVAT*$invoiceData[i].fAmount/100`}{$vt|formatMoney:true}</span> <input type="hidden" name="fVAT{$smarty.section.i.index}" id="fVAT{$smarty.section.i.index}" value="{$invoiceData[i].fVAT}" /></td>
                                                            <td class="text-center"><span class="ox">{assign var="ot" value=`$invoiceData[i].fOtherTax1*$invoiceData[i].fAmount/100`}{$ot|formatMoney:true}</span> <input type="hidden" name="fOtherTax1{$smarty.section.i.index}" id="fOtherTax1{$smarty.section.i.index}" value="{$invoiceData[i].fOtherTax1}" /></td>
                                                            <td class="text-center"><span class="wt">{assign var="wt" value=`$invoiceData[i].fWithHoldingTax*$invoiceData[i].fAmount/100`}{$wt|formatMoney:true}</span> <input type="hidden" name="fWithHoldingTax{$smarty.section.i.index}" id="fWithHoldingTax{$smarty.section.i.index}" value="{$invoiceData[i].fWithHoldingTax}" /></td>
                                                            <td class="text-center"><span class="lt">{$invoiceData[i].fLineTotal|formatMoney:true}</span> <input type="hidden" name="fLineTotal{$smarty.section.i.index}" id="fLineTotal{$smarty.section.i.index}" value="{$invoiceData[i].fLineTotal}" /></td>
                                                            <td class="text-center"><span class="at">
                                                                <a onclick='shwtbl({$invoiceData[i].iInvoiceLineID});'>
                                                                    <span class="fa-stack">
                                                                        <i class="fa fa-eye"></i>
                                                                    </span>
                                                                </a></span>
                                                            </td>
                                                        </tr>
                                                        {*<tr>
                                                            <td></td>
                                                            <td class="text-center">{$invoiceData[i].eSublineType} <input type="hidden" name="eSublineType{$smarty.section.i.index}" id="eSublineType{$smarty.section.i.index}" value="{$invoiceData[i].eSublineType}" /></td>
                                                            <td class="text-center">{$invoiceData[i].iSubQuantity|formatMoney:false} <input type="hidden" name="iSubQuantity{$smarty.section.i.index}" id="iSubQuantity{$smarty.section.i.index}" value="{$invoiceData[i].iSubQuantity}" /></td>
                                                            <td class="text-center">{$invoiceData[i].fSubRate|formatMoney:true}% <input type="hidden" name="fSubRate{$smarty.section.i.index}" id="fSubRate{$smarty.section.i.index}" value="{$invoiceData[i].fSubRate}" /></td>
                                                            <td class="text-center">{$invoiceData[i].fSubAmount|formatMoney:true} <input type="hidden" name="fSubAmount{$smarty.section.i.index}" id="fSubAmount{$smarty.section.i.index}" value="{$invoiceData[i].fSubAmount}" /></td>
                                                            <td class="text-center">{$invoiceData[i].fSubVat|formatMoney:true}</td>
                                                            <td class="text-center">{$invoiceData[i].fSubOtherTax|toFixed:true}</td>
                                                            <td class="text-center">{$invoiceData[i].fSubWHTax|toFixed:true}</td>
                                                            <td class="text-center">{$invoiceData[i].fSubTotal|formatMoney:true}</td>
                                                            <td class="text-center"></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>

                                                        </tr>*}
                                                    {/if}
                                                    {sectionelse}
                                                    <tr>
                                                        <td colspan="13"><b>{$LBL_NO_LINE_ITEMS}</b></td>
                                                    </tr>
                                                    {/section}
                                                    
                                                    </tbody>
                                                </table>
                                                </div>
                                            </div>
                                            <div class="invoice-box-total clearfix">
                                                <div class="row">
                                                    <div class="col-sm-9 col-md-10 col-xs-6 text-right invoice-box-total-label">
                                                        {$LBL_SUB_TOTAL} :
                                                    </div>
                                                    <div class="col-sm-3 col-md-2 col-xs-6 text-right invoice-box-total-value">
                                                        <span id="subt">0</span><input type="hidden" name="subtotal" id="subtotal" />
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-9 col-md-10 col-xs-6 text-right invoice-box-total-label">
                                                        {$LBL_VAT} :
                                                    </div>
                                                    <div class="col-sm-3 col-md-2 col-xs-6 text-right invoice-box-total-value">
                                                        <span id="vatt">0</span><input type="hidden" name="vattotal" id="vattotal" />
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-9 col-md-10 col-xs-6 text-right invoice-box-total-label">
                                                        {$LBL_OTHER_TAX} :
                                                    </div>
                                                    <div class="col-sm-3 col-md-2 col-xs-6 text-right invoice-box-total-value">
                                                        <span id="otht">0</span><input type="hidden" name="whtaxtotal" id="whtaxtotal" />
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-9 col-md-10 col-xs-6 text-right invoice-box-total-label">
                                                        {$LBL_WITH_HOLDING_TAX} :
                                                    </div>
                                                    <div class="col-sm-3 col-md-2 col-xs-6 text-right invoice-box-total-value">
                                                        <span id="wtht">0</span><input type="hidden" name="whtaxtotal" id="whtaxtotal" />
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-9 col-md-10 col-xs-6 text-right invoice-box-total-label">
                                                        {$LBL_CHARGE} :
                                                    </div>
                                                    <div class="col-sm-3 col-md-2 col-xs-6 text-right invoice-box-total-value">
                                                        <span id="chgt">0</span><input type="hidden" name="charge" id="charge" />
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-9 col-md-10 col-xs-6 text-right invoice-box-total-label">
                                                        {$LBL_DISCOUNT} :
                                                    </div>
                                                    <div class="col-sm-3 col-md-2 col-xs-6 text-right invoice-box-total-value">
                                                        <span id="dist">0</span><input type="hidden" name="discount" id="discount" />
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-9 col-md-10 col-xs-6 text-right invoice-box-total-label">
                                                        {$LBL_NET_AMOUNT}
                                                    </div>
                                                    <div class="col-sm-3 col-md-2 col-xs-6 text-right invoice-box-total-value">
                                                        <span id="namt" style="font-weight:bold;">0</span><input type="hidden" name="nettotal" id="nettotal" />
                                                    </div>
                                                </div>
                                            </div>
                                                {else}
                                            <div>{$LBL_NO_LINE_ITEMS}</div>
                                            {/if}
                                            {if $view neq 'edit' && $usertype neq 'orgadmin'}
                                            <button class="btn btn-primary pull-right" type="button"  id="reset_btn" onclick="history.back();">Back</button>
                                            <button class="btn btn-primary pull-right" type="button"  id="reset_btn" onclick="$('#view').val('verify');$('#frmadd').submit();">Verify</button>
                                            <button class="btn btn-primary pull-right" type="button"  id="reset_btn" onclick="$('#view').val('reject');$('#frmadd').submit();">Reject</button>
                                            {/if}
                                                </form>
												<center class="row">
                                                {if $view neq 'edit' && $usertype neq 'orgadmin'} {elseif $msg neq 'pop'}
												 <button type="button" class="btn btn-primary" onclick="history.back();">Back</button>
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
<span id="spn" style="display:hidden;"></span>

<script type="text/javascript" src="{$SITE_CONTENT_JS}money_format.js"></script>
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
$(document).ready(function() {
    var table = $('#table-example').dataTable({
        'info': false,
        'filter': false,
        'columnDefs': [ { "targets": 0, "orderable": false } ],
        'sDom': 'lf<"clearfix">tip',
        'TableTools': false
    });

    $(".plusminus-img").click( function() {
        $(this).parent().parent('div').children('table').toggle();
        if($(this).attr('src') == SITE_IMAGES+'sm_images/minus-icon.gif') {
            $(this).attr('src',SITE_IMAGES+'sm_images/plus-icon.gif');
        } else {
            $(this).attr('src',SITE_IMAGES+'sm_images/minus-icon.gif');
        }

    });
});


$('div [name="rctbl"]').hide();
function shwtbl(vl) {
    $('div [name="rctbl"]').hide();
    $('#Div'+vl).show();
    $(function() {
        var ead=10;
        $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
    });
}

function setsublines()
{
    if($('tr[id^="spnd"] > .subli').length > 0) {
        $.each($('div[id^="spnd"] > .subli'),function(i,el) {
            var idx = $(this).parent().attr('id').replace('spnd','');
            //
            pr = false;
            if($('#spnd'+idx+' > .subli').length > 0) {
                pr = $('#spnd'+idx+' > .subli');
                if($('.sqt',pr).length > 0) {
                    $('.sqt',pr).attr('innerHTML', money_format('%i',$('#iSubQuantity'+idx).val(),'no'));
                    // alert($('.srt',pr).length);
                }
                if($.trim($('#fSubRate'+idx).val()) != '' && !isNaN(parseInt($('#fSubRate'+idx).val(), 10))) {
                    var subtype = $.trim($('#eSublineType'+idx).val().toLowerCase());
                    // alert(subtype);
                    if(subtype != '') {
                        // alert(idx);
                        var subquantity = parseFloat($.trim($('#iSubQuantity'+idx).val()), 10);
                        var linetotal = parseFloat($.trim($('#fLineTotal'+idx).val()), 10);
                        var subrate = parseFloat($.trim($('#fSubRate'+idx).val()), 10);
                        var quantity = parseFloat($.trim($('#iQuantity'+idx).val()), 10);
                        var price = parseFloat($.trim($('#fPrice'+idx).val()), 10);
                        var vat = parseFloat($.trim($('#fVAT'+idx).val()), 10);
                        var otax = parseFloat($.trim($('#fOtherTax1'+idx).val()), 10);
                        var whtax = parseFloat($.trim($('#fWithHoldingTax'+idx).val()), 10);
                        var qno = (subquantity > quantity)? quantity : subquantity;
                        var sum = (qno * price);
                        var amt = sum;
                        // alert(subtype);
                        if(subtype == 'charge') {
                            var amt1 = (sum * subrate / 100);
                            amt = amt1 + ((sum * vat / 100) * subrate / 100) + ((sum * otax / 100) * subrate / 100) - ((sum * whtax / 100) * subrate / 100);
                        } else {
                            var amt1 = (-(sum * subrate / 100));
                            amt = amt1 - ((sum * vat / 100) * subrate / 100) - ((sum * otax / 100) * subrate / 100) + ((sum * whtax / 100) * subrate / 100);
                        }
                        // amt = amt + ramt;
                        // amt = parseFloat(amt,10).toFixed(2);
                        if(!isNaN(amt1) && amt1.toString() != 'NaN') {
                            if(pr){
                                $('.stl', pr).attr('innerHTML', money_format('%i',(Math.abs(amt1))));
                            }
                        }
                        if(!isNaN(amt) && amt.toString() != 'NaN') {
                            $('#fSubAmount'+idx).val(amt);
                            if(pr){
                                $('.slf',pr).attr('innerHTML', money_format('%i',(Math.abs(amt))));
                            }
                        }
                        $('.slv',pr).attr('innerHTML', money_format('%i',((sum * vat / 100) * subrate / 100)));
                        $('.slo',pr).attr('innerHTML', (parseFloat((sum * otax / 100) * subrate / 100)).toFixed(2));
                        $('.slw',pr).attr('innerHTML', (parseFloat((sum * whtax / 100) * subrate / 100)).toFixed(2));
                    }
                }
            }
            //
        });
    }
}
setsublines();

function settotal()
{
    var subt = 0;
    var dist = 0;
    var chgt = 0;
    var vatt = 0;
    var otht = 0;
    var wtht = 0;
    var namt = 0;
    //
    if($('#dlines > div[id^="spnd"]').length < 1) {
        $('#subt').html(0);
        $('#dist').html(0);
        $('#chgt').html(0);
        $('#vatt').html(0);
        $('#otht').html(0);
        $('#wtht').html(0);
        $('#namt').html(0);
        //
        $('#subtotal').val(0);
        $('#discount').val(0);
        $('#charge').val(0);
        $('#vattotal').val(0);
        $('#othertaxtotal').val(0);
        $('#whtaxtotal').val(0);
        $('#nettotal').val(0);
    }
    // $('div[id*="Div"]').find('[name="fSubRate\[\]"]').trigger('blur');
    $.each($('tr[id^="spnd"]'), function(i, el)
    {
        setsublines($(this).attr('id').replace('spnd',''));
        if($.trim($(this).find('.ot').html().toLowerCase()) == 'discount') {
            // dist = dist + parseFloat($(this).find('.fa').attr('innerHTML').replace(new RegExp(',', 'g'),''));
            // namt = namt - parseFloat($(this).find('.fa').attr('innerHTML').replace(new RegExp(',', 'g'),''));
            dist = dist + parseFloat($(this).find('.lt').html().replace(new RegExp(',', 'g'),''), 10);
            if(!isNaN(parseFloat($(this).find('.lt').html().replace(new RegExp(',', 'g'),'')))) {
                namt = namt - parseFloat($(this).find('.lt').html().replace(new RegExp(',', 'g'),''), 10);
            }
            //
            var slv = parseFloat($('.fv', $(this)).html().replace(new RegExp(',', 'g'),''), 10);
            if(!isNaN(slv)) {
                vatt = vatt - slv;
            }
            var slo = parseFloat($('.ox', $(this)).html().replace(new RegExp(',', 'g'),''), 10);
            if(!isNaN(slo)) {
                otht = otht - slo;
            }
            var slw = parseFloat($('.wt', $(this)).html().replace(new RegExp(',', 'g'),''), 10);
            if(!isNaN(slw)) {
                wtht = wtht - slw;
            }
        } else if($.trim($(this).find('.ot').html().toLowerCase()) == 'charge') {
            // chgt = chgt + parseFloat($(this).find('.fa').attr('innerHTML').replace(new RegExp(',', 'g'),''));
            chgt = chgt + parseFloat($(this).find('.lt').html().replace(new RegExp(',', 'g'),''), 10);
            /*if(!isNaN(parseFloat($(this).find('.fv').attr('innerHTML').replace(new RegExp(',', 'g'),'')))) {
                            vatt = vatt + parseFloat($(this).find('.fv').attr('innerHTML').replace(new RegExp(',', 'g'),''));
                    }
                    if(!isNaN(parseFloat($(this).find('.ox').attr('innerHTML').replace(new RegExp(',', 'g'),'')))) {
                            otht = otht + parseFloat($(this).find('.ox').attr('innerHTML').replace(new RegExp(',', 'g'),''));
                    }
                    if(!isNaN(parseFloat($(this).find('.wt').attr('innerHTML').replace(new RegExp(',', 'g'),'')))) {
                            wtht = wtht + parseFloat($(this).find('.wt').attr('innerHTML').replace(new RegExp(',', 'g'),''));
                    }*/
            if(!isNaN(parseFloat($(this).find('.lt').html().replace(new RegExp(',', 'g'),'')))) {
                namt = namt + parseFloat($(this).find('.lt').html().replace(new RegExp(',', 'g'),''), 10);
            }
            //
            var slv = parseFloat($('.fv', $(this)).html().replace(new RegExp(',', 'g'),''), 10);
            if(!isNaN(slv)) {
                vatt = vatt + slv;
            }
            var slo = parseFloat($('.ox', $(this)).html().replace(new RegExp(',', 'g'),''), 10);
            if(!isNaN(slo)) {
                otht = otht + slo;
            }
            var slw = parseFloat($('.wt', $(this)).html().replace(new RegExp(',', 'g'),''), 10);
            if(!isNaN(slw)) {
                wtht = wtht + slw;
            }
        } else {
            subt = subt + parseFloat($(this).find('.fa').html().replace(new RegExp(',', 'g'),''));
            if(!isNaN(parseFloat($(this).find('.fv').html().replace(new RegExp(',', 'g'),'')))) {
                vatt = vatt + parseFloat($(this).find('.fv').html().replace(new RegExp(',', 'g'),''), 10);
            }
            if(!isNaN(parseFloat($(this).find('.ox').html().replace(new RegExp(',', 'g'),'')))) {
                otht = otht + parseFloat($(this).find('.ox').html().replace(new RegExp(',', 'g'),''), 10);
            }
            if(!isNaN(parseFloat($(this).find('.wt').html().replace(new RegExp(',', 'g'),'')))) {
                wtht = wtht + parseFloat($(this).find('.wt').html().replace(new RegExp(',', 'g'),''), 10);
            }
            if(!isNaN(parseFloat($(this).find('.lt').html().replace(new RegExp(',', 'g'),'')))) {
                namt = namt + parseFloat($(this).find('.lt').html().replace(new RegExp(',', 'g'),''), 10);
            }
            var subli = $('.subli', $(this));
            if(subli.length > 0) {
                var sltl = parseFloat($('.stl', subli).html().replace(new RegExp(',', 'g'),''), 10);
                if($('.slf', subli).length > 0) {
                    var slf = parseFloat($('.slf', subli).html().replace(new RegExp(',', 'g'),''), 10);
                }
                if($('.sltyp', subli).length > 0) {
                    var sltyp = $('.sltyp', subli).html().replace(new RegExp('-', 'g'),'').toLowerCase();
                    var sltyp_ary = sltyp.split(' ');
                    sltyp = sltyp_ary[0];
                }
                if($.trim(sltyp.toLowerCase()) == 'discount :' || $.trim(sltyp.toLowerCase()) == 'discount:' || $.trim(sltyp.toLowerCase()) == 'discount') {
                    dist = dist + Math.abs(sltl);
                    var slv = parseFloat($('.slv', subli).html().replace(new RegExp(',', 'g'),''), 10);
                    if(!isNaN(slv)) {
                        vatt = vatt - slv;
                    }
                    var slo = parseFloat($('.slo', subli).html().replace(new RegExp(',', 'g'),''), 10);
                    if(!isNaN(slo)) {
                        otht = otht - slo;
                    }
                    var slw = parseFloat($('.slw', subli).html().replace(new RegExp(',', 'g'),''), 10);
                    if(!isNaN(slw)) {
                        wtht = wtht - slw;
                    }
                    namt = namt - slf;
                } else if($.trim(sltyp.toLowerCase()) == 'charge :' || $.trim(sltyp.toLowerCase()) == 'charge:' || $.trim(sltyp.toLowerCase()) == 'charge') {
                    chgt = chgt + Math.abs(sltl);
                    var slv = parseFloat($('.slv', subli).html().replace(new RegExp(',', 'g'),''), 10);
                    if(!isNaN(slv)) {
                        vatt = vatt + slv;
                    }
                    var slo = parseFloat($('.slo', subli).html().replace(new RegExp(',', 'g'),''), 10);
                    if(!isNaN(slo)) {
                        otht = otht + slo;
                    }
                    var slw = parseFloat($('.slw', subli).html().replace(new RegExp(',', 'g'),''), 10);
                    if(!isNaN(slw)) {
                        wtht = wtht + slw;
                    }
                    namt = namt + slf;
                }
                if(!isNaN(sltl)) {
                    // subt = subt + sltl;
                    // subt = subt + sltl;
                    // namt = namt + sltl;
                }
                if(!isNaN(slf)) {
                    // namt = namt + slf;
                }
            }
        }
        //
        $('#subt').html($.trim(money_format('%i',subt).replace("USD","")));
        $('#dist').html($.trim(money_format('%i',dist).replace("USD","")));
        $('#chgt').html($.trim(money_format('%i',chgt).replace("USD","")));
        $('#vatt').html($.trim(money_format('%i',vatt).replace("USD","")));
        $('#otht').html($.trim(money_format('%i',otht).replace("USD","")));
        $('#wtht').html($.trim(money_format('%i',wtht).replace("USD","")));
        $('#namt').html($.trim(money_format('%i',namt).replace("USD","")));
        //
        $('#subtotal').val(subt);
        $('#discount').val(dist);
        $('#charge').val(chgt);
        $('#vattotal').val(vatt);
        $('#othertaxtotal').val(otht);
        $('#whtaxtotal').val(wtht);
        $('#nettotal').val(namt);
        //
        // setsublines($(this).attr('id').replace('spnd',''));
        // $('#iSubQuantity'+idx).trigger('blur');
        //
    });
}
settotal();
</script>
{/literal}