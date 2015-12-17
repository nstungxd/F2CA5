<div class="middle-container">
    <h1>{$LBL_VIEW} {$LBL_INVOICE}</h1>
    <div class="middle-containt">
        <div class="statistics-main-box-white">
            <div>
                <ul id="inner-tab">
                  <li><a href="{$SITE_URL_DUM}invoiceview/{$iInvoiceID}{if $msg eq 'pop'}/pop{/if}"><em>{$LBL_VIEW} {$LBL_INV_HEADER}</em></a></li>
                  {*if $imgdt neq 'yes'*}
                  	<li><a href="{$SITE_URL_DUM}invprefview/{$iInvoiceID}{if $msg eq 'pop'}/pop{/if}" class="current"><em>{$LBL_VIEW} {$LBL_PREFERENCES}</em></a></li>
							<li><a href="{$SITE_URL_DUM}invoiceviewitems/{$iInvoiceID}{if $msg eq 'pop'}/pop{/if}"><em>{$LBL_VIEW} {$LBL_INVOICE_ITEM}</em></a></li>
						{*/if*}
                </ul>
            </div>
            <div class="clear"></div>
            <div class="inner-gray-bg">
                <div id="msg" class="msg">&nbsp;{if $usertype neq 'orgadmin'}{$nxtstatus.vStatusMsg}{/if}
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
                </div>
                <div>
						  <span style="float:right;"><b>
						  {if $msg neq 'pop'}
						  <a class="" href="javascript:openpopup('{$SITE_URL_DUM}invoiceviewhistory/{$iInvoiceID}')" >{$LBL_VIEW_HISTORY}</a>
						  {/if}
						  </b></span>
					 </div>
                <div>
                    <form name="frmadd" id="frmadd" action="{$SITE_URL}index.php?file=u-invoicecreate_a"  method="post">
                        <input type="hidden" name="iInvoiceID" id="iInvoiceID" value="{$iInvoiceID}" />
                        <input type="hidden" name="nstatus" id="nstatus" value="{$nxtstatus.iStatusID}" />
                        <input type="hidden" name="edelete" id="edelete" value="{$invoiceData.eDelete}" />
                        <input type="hidden" name="view" id="view" value="{$view}" />
                        <table width="97%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
                            <tr><td colspan="3" align="right"><font size="2" color="red"><b>{$var_msg}</b></font></td></tr>
                            <tr>
                                <td width="150">{$LBL_SOURCE_DOC}</td>
                                <td width="1">:</td>
                                <td class="blue-ore" width="390">{$iprefdt[0].tSourcingDocument|stripslashes}</td>
                            </tr>
                            <tr>
                                <td width="150">{$LBL_GLOBAL_AGREEMENT} </td>
                                <td  width="1">:</td>
                                <td class="blue-ore">{$iprefdt[0].tGlobalAgreement|stripslashes}</td>
                            </tr>
                            <tr>
										  <td valign="top">{$LBL_PAYMENT_TERMS} </td>
                                <td valign="top">:</td>
                                <td class="blue-ore">{$iprefdt[0].tPaymentTerms|stripslashes}</td>
                            </tr>
									 <tr>
										  <td valign="top">{$LBL_FOB} </td>
                                <td valign="top">:</td>
                                <td class="blue-ore">{$iprefdt[0].tFOB|stripslashes}</td>
                            </tr>
									 <tr>
										  <td valign="top">{$LBL_DELIVERY_TERMS} </td>
                                <td valign="top">:</td>
                                <td class="blue-ore">{$iprefdt[0].tDeliveryTerms|stripslashes}</td>
                            </tr>
									 <tr>
										  <td valign="top">{$LBL_SHIP_CONTROL} </td>
                                <td valign="top">:</td>
                                <td class="blue-ore">{$iprefdt[0].tShippingControl|stripslashes}</td>
                            </tr>
									 <tr>
										  <td valign="top">{$LBL_COND_PAYMENT} </td>
                                <td valign="top">:</td>
                                <td class="blue-ore">{$iprefdt[0].tConditionsForPayment|stripslashes}</td>
                            </tr>
									 <tr>
										  <td valign="top">{$LBL_PENALTIES} </td>
                                <td valign="top">:</td>
                                <td class="blue-ore">{$iprefdt[0].tPenalties|stripslashes}</td>
                            </tr>
									 <tr>
										  <td valign="top">{$LBL_SPEC_INSTRUCT} </td>
                                <td valign="top">:</td>
                                <td class="blue-ore">{$iprefdt[0].tSpecialInstruction|stripslashes}</td>
                            </tr>
									 <tr>
										  <td valign="top">{$LBL_NOTE} </td>
                                <td valign="top">:</td>
                                <td class="blue-ore">{$iprefdt[0].tNote|stripslashes}</td>
                            </tr>
                            {if $permitted eq 'Yes' && $usertype neq 'orgadmin'}
                            <tr>
                                <td valign="top">{$LBL_REASON_TO_REJECT} </td>
                                <td valign="top">:</td>
                                <td><textarea id="tReasonToReject" name="tReasonToReject" cols="70" rows="3"></textarea></td>
                            </tr>
                            {/if}
                            <tr><td colspan="3">&nbsp;</td></tr>
									 {if $msg neq 'pop'}
                            <tr>
                                <td valign="bottom" align="center" colspan="3">
                                    <img src="{$SITE_IMAGES}sm_images/btn-back.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" {if $invoiceData.iPurchaseOrderID gt 0}onclick="location.href='{$SITE_URL_DUM}invacptlist/{$smarty.session.invlvl}';"{else}onclick="location.href='{$SITE_URL_DUM}invoicelist/{$smarty.session.invlvl}';"{/if} />
                                         {if $permitted eq 'Yes' && $usertype neq 'orgadmin'}
                                         <img src="{$SITE_IMAGES}sm_images/btn-verify.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('verify');$('#frmadd').submit();" />
													 <img src="{$SITE_IMAGES}sm_images/btn-reject.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('reject');$('#frmadd').submit();" />
														{/if}
													 {*if $crt_inv eq 'yes'}
                                    &nbsp;<span style="background:url({$SITE_IMAGES}bg.png) repeat; padding:3px; border:1px solid #cccccc;"><span onclick="$('#view').val('crtpo');$('#frmadd').submit();" style="cursor:pointer; color:#256292;"><b>{$LBL_CREATE_PO}</b></span></span>
                                    <img src="{$SITE_IMAGES}sm_images/btn-create.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('crtpo');$('#frmadd').submit();" />
													 {/if*}
                                </td>
                            </tr>
									 {/if}
                        </table>
                    </form>
                </div>
                <div>&nbsp;</div>
            </div>
        </div>
    </div>
</div>