<script type="text/javascript" src="{$DATETIMEPICKER}jquery.dynDateTime.js"></script>
<script type="text/javascript" src="{$DATETIMEPICKER}lang/calendar-en.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="{$DATETIMEPICKER}css/calendar-blue.css" />
<div class="middle-container">
    <h1>{$LBL_VIEW} {$LBL_INVOICE}</h1>
    <div class="middle-containt">
        <div class="statistics-main-box-white">
            <div>
                <ul id="inner-tab">
                    <li><a href="{$SITE_URL_DUM}invoiceview/{$iInvoiceID}{if $msg eq 'pop'}/pop{/if}" class="current"><em>{$LBL_VIEW} {$LBL_INV_HEADER}</em></a></li>
                    {if $imgdt neq 'yes'}
                    <li><a href="{$SITE_URL_DUM}invprefview/{$iInvoiceID}{if $msg eq 'pop'}/pop{/if}"><em>{$LBL_VIEW} {$LBL_PREFERENCES}</em></a></li>
                    <li><a href="{$SITE_URL_DUM}invoiceviewitems/{$iInvoiceID}{if $msg eq 'pop'}/pop{/if}"><em>{$LBL_VIEW} {$LBL_INVOICE_ITEM}</em></a></li>
                    {/if}
                </ul>
            </div>
            <div class="clear"></div>
            <div class="inner-gray-bg">
                <div id="msg" class="msg">&nbsp;
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
                    {$LBL_STATUS}: {$LBL_ACCEPTED}
                    {/if}
                    {/if}
                    {/if}
                </div>
                <div>&nbsp;
                    {if $msg neq 'pop'}
                    <span style="float:right;"><b>
                            <a class="" href="javascript:openpopup('{$SITE_URL_DUM}invoiceviewhistory/{$iInvoiceID}')" >{$LBL_VIEW_HISTORY}</a>
                        </b></span>
                    {/if}
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
                                <td width="190">{$LBL_SUPPLIER} {$LBL_COMP_NAME}</td>
                                <td width="1">:</td>
                                <td class="blue-ore" width="390">{$invoiceData.vSupplierName}</td>
                            </tr>
                            <tr>
                                <td width="190">{$LBL_SUPPLIER} {$LBL_CODE} </td>
                                <td  width="1">:</td>
                                <td class="blue-ore">
                                    {$invoiceData.vInvoiceSupplierCode}
                                </td>
                            </tr>
                            <tr>
                                <td width="150">{$LBL_INV_SUPPLIER_CODE} </td>
                                <td  width="1">:</td>
                                <td class="blue-ore">
                                    {$invoiceData.vInvSupplierCode}
                                </td>
                            </tr>
                            {*if $invoiceData.vExtPOCode|trim neq ''*}
                            <tr>
                                <td>{$LBL_RELATED_PO_CODE} </td>
                                <td>:</td>
                                <td>{$invoiceData.vExtPOCode}</td>
                            </tr>
                            {*/if*}
                            {if $imgdt neq 'yes'}
                            <tr>
                                <td>{$LBL_BUYER}  </td>
                                <td>:</td>
                                <td>
                                    {$invoiceData.vBuyerName}
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_BUYER} {$LBL_CONTACT_PARTY}  </td>
                                <td>:</td>
                                <td>
                                    {$invoiceData.vBuyerContactParty}
                                </td>
                            </tr>
                            {/if}
                            <tr>
                                <td>{$LBL_INV_CODE}  </td>
                                <td>:</td>
                                <td>
                                    {$invoiceData.vInvoiceCode}
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_ISSUE_DATE} </td>
                                <td>:</td>
                                <td>
                                    {$invoiceData.dIssueDate|calcLTzTime|DateTime:10}
                                </td>
                            </tr>
                            {if $imgdt neq 'yes'}
                            <tr>
                                <td valign="top">{$LBL_INVOICE_DESCRIPTION} </td>
                                <td valign="top">:</td>
                                <td>
                                    {$invoiceData.tOrderDescription|stripslashes}
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_OPENING_UNIT}  </td>
                                <td>:</td>
                                <td>{$invoiceData.iOpeningUnit}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_SUPPLIER} {$LBL_ORDER_NUMBER}  </td>
                                <td>:</td>
                                <td>{$invoiceData.vSupplierOrderNum}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_INVOICE_TYPE}  </td>
                                <td>:</td>
                                <td>
                                    {$invoiceData.eInvoiceType}
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_CARRIER} </td>
                                <td>:</td>
                                <td>{$invoiceData.tCarrier}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_LINE_ITEM_TAX}  </td>
                                <td>:</td>
                                <td>{$invoiceData.eLineItemTax}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_VAT}  </td>
                                <td>:</td>
                                <td>{$invoiceData.fVAT}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_OTHER_TAX} </td>
                                <td>:</td>
                                <td>{$invoiceData.fOtherTax1}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_FREIGHT} </td>
                                <td>:</td>
                                <td>{$invoiceData.vFreight}</td>
                            </tr>
                            <tr>
                                <td valign="top">{$LBL_MISCELLANEOUS} </td>
                                <td valign="top">:</td>
                                <td>{$invoiceData.tMiscellaneous|stripslashes}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_INVOICE_TOTAL} </td>
                                <td>:</td>
                                <td>{$invoiceData.fInvoiceTotal}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_DISCOUNT_BASELINE} </td>
                                <td>:</td>
                                <td>
                                    {$invoiceData.dCashDiscountBaseline|DateTime:10}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_MAXCASH_DISCOUNTDAYS} </td>
                                <td>:</td>
                                <td>
                                    {$invoiceData.iMaxCashDiscountDays}
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_MAXCASH_DISCOUNTPERCENT} </td>
                                <td>:</td>
                                <td>
                                    {$invoiceData.fMaxCashDiscountPercentage}
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_NORMALCASH_DISCOUNTDAYS} </td>
                                <td>:</td>
                                <td>
                                    {$invoiceData.iNormalCashDiscountDays}
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_NORMALCASH_DISCOUNTPERCNET} </td>
                                <td>:</td>
                                <td>
                                    {$invoiceData.iNormalCashDiscountPercentage}
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_BILL_TO}  {$LBL_PARTY}  </td>
                                <td>:</td>
                                <td>{$invoiceData.vBillToParty}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_BILL_TO} {$LBL_ADDR_LINE}1  </td>
                                <td>:</td>
                                <td>{$invoiceData.vBillToAddLine1}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_BILL_TO} {$LBL_ADDR_LINE}2 </td>
                                <td>:</td>
                                <td>{$invoiceData.vBillToAddLine2}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_BILL_TO} {$LBL_CITY} </td>
                                <td>:</td>
                                <td>{$invoiceData.vBillToCity}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_BILL_TO} {$LBL_COUNTRY}  </td>
                                <td>:</td>
                                <td>
                                    {$invoiceData.vBillToCountry}
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_BILL_TO} {$LBL_STATE} </td>
                                <td>:</td>
                                <td>{$invoiceData.vBillToState}
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_BILL_TO} {$LBL_ZIP_CODE}  </td>
                                <td>:</td>
                                <td>{$invoiceData.vBillToZipCode}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_BILL_TO} {$LBL_CONTACT_PARTY}  </td>
                                <td>:</td>
                                <td>{$invoiceData.vBillToContactParty}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_BILL_TO} {$LBL_CONTACT_TELEPHONE}  </td>
                                <td>:</td>
                                <td>{$invoiceData.vBillToContactTelephone}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_CURRENCY}  </td>
                                <td>:</td>
                                <td>{$invoiceData.vCurrency}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_VAT_ID} </td>
                                <td>:</td>
                                <td>{$invoiceData.vVatId}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_BANK} </td>
                                <td>:</td>
                                <td>{$invoiceData.vBankName}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_BANK_CODE} </td>
                                <td>:</td>
                                <td>{$invoiceData.vBankCode}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_BRANCH} </td>
                                <td>:</td>
                                <td>{$invoiceData.vBranchName}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_BRANCH_CODE} </td>
                                <td>:</td>
                                <td>{$invoiceData.vBranchCode}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_ACCOUNT} {$LBL_TITLE}</td>
                                <td>:</td>
                                <td>{$invoiceData.vAccountName}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_ACCOUNT} {$LBL_NUMBER}</td>
                                <td>:</td>
                                <td>{$invoiceData.vAccountNumber}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_IBAN}</td>
                                <td>:</td>
                                <td>{$invoiceData.vIBAN}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_INVOICE_TOTAL}  </td>
                                <td>:</td>
                                <td>{$invoiceData.fInvoiceTotal}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_PRE_PAYMENT} </td>
                                <td>:</td>
                                <td>{$invoiceData.fPrePayment}</td>
                            </tr>
                            {if $ntacpt eq 'y'}
                            <tr>
                                <td> {$LBL_ACCEPTED_VAT}&nbsp;</td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="Data[dAcceptedVat]" class="input-rag id="fVAT" style="width:228px;" value="{$invoiceData.fVAT}" title="{$LBL_ENTER} {$LBL_INVOICE_PAYABLE} ({$LBL_ACCEPTED}) {$LBL_AMOUNT}" />
                            </td>
                        </tr>
                        <tr>
                            <td> {$LBL_ACCEPTED_TAX}&nbsp;</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="Data[dAcceptedOtherTax]" class="input-rag id="fOtherTax1" style="width:228px;" value="{$invoiceData.fOtherTax1}" title="{$LBL_ENTER} {$LBL_INVOICE_PAYABLE} ({$LBL_ACCEPTED}) {$LBL_AMOUNT}" />
                        </td>
                    </tr>
                    <tr>
                        <td> {$LBL_ACCEPTED_WITH_HOLDING_TAX}&nbsp;</td>
                        <td>:</td>
                        <td>
                            <input type="text" name="Data[dAcceptedWHTax]" class="input-rag "  id="fWithHoldingTax" style="width:228px;" value="{$invoiceData.fWithHoldingTax}" />
                        </td>
                    </tr>
                    <tr>
                        <td> {$LBL_ACCEPTED_NET_PAYMENT_DATE}&nbsp;</td>
                        <td>:</td>
                        <td>
                            <input type="text" name="Data[dAcceptedNetPaymentDate]" readonly class="input-rag" id="dNetPaymentdate" value="{$invoiceData.dNetPaymentdate}"style="width:139px; vertical-align:middle;" />
                        </td>
                    </tr>
                    <tr>
                        <td>{$LBL_INVOICE_PAYABLE} ({$LBL_ACCEPTED}) {$LBL_AMOUNT} &nbsp;<font class="reqmsg">*</font></td>
                        <td>:</td>
                        <td><input type="text" name="Data[fAcceptedAmount]" class="input-rag required id="fAcceptedAmount" style="width:228px;" value="{$invoiceData.fAcceptedAmount}" title="{$LBL_ENTER} {$LBL_INVOICE_PAYABLE} ({$LBL_ACCEPTED}) {$LBL_AMOUNT}" /></td>
                    </tr>
                    {elseif $invoiceData.iaStatusID > 0}
                    <tr>
                        <td>{$LBL_ACCEPTED_VAT}&nbsp;</td>
                        <td>:</td>
                        <td>{$invoiceData.dAcceptedVat}</td>
                    </tr>
                    <tr>
                        <td>{$LBL_ACCEPTED_TAX}&nbsp;</td>
                        <td>:</td>
                        <td>{$invoiceData.dAcceptedOtherTax}</td>
                    </tr>
                    <tr>
                        <td>{$LBL_ACCEPTED_WITH_HOLDING_TAX}&nbsp;</td>
                        <td>:</td>
                        <td>{$invoiceData.dAcceptedWHTax}</td>
                    </tr>
                    </tr>
                    <tr>
                        <td>{$LBL_ACCEPTED_NET_PAYMENT_DATE}&nbsp;</td>
                        <td>:</td>
                        <td>{if $invoiceData.dAcceptedNetPaymentDate neq '0000-00-00'}{$invoiceData.dAcceptedNetPaymentDate|calcLTzTime|DateTime:10}{else}---{/if}</td>
                    </tr>


                    {if $invoiceData.fAcceptedAmount >0}
                    <tr>
                        <td>{$LBL_ACCEPTED_AMOUNT}  </td>
                        <td>:</td>
                        <td>{$invoiceData.fAcceptedAmount}</td>
                    </tr>
                    {/if}
                    {/if}
                    {else}
                    <tr>
                        <td colspan="3"><hr/></td>
                    </tr>
                    <tr>
                        <td ><b>{$LBL_OTHER_DETAILS} : </b></td>
                        <td >&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td valign="top" colspan="3" align="center"><div id="img" class="img-details"><img src="{$img}" /></div></td>
                    </tr>
                    {/if}
                    {if $permitted eq 'Yes' && $usertype neq 'orgadmin'}
                    <tr>
                        <td valign="top">{$LBL_REASON_TO_REJECT} </td>
                        <td valign="top">:</td>
                        <td><textarea id="tReasonToReject" name="tReasonToReject" cols="70" rows="3"></textarea></td>
                    </tr>
                    {elseif $invoiceData.iStatusID eq $rjtsts}
                    <tr>
                        <td valign="top">{$LBL_REASON_TO_REJECT} </td>
                        <td valign="top">:</td>
                        <td><textarea id="tReasonToReject" name="tReasonToReject" cols="70" rows="3" readonly="readonly">{$invoiceData.tReasonToReject|trim}</textarea></td>
                    </tr>
                    {/if}

                    {if $invAttachments|@count gt 0}
                    <tr>
                        <td>{$LBL_UPLOADED_FILES}</td>
                        <td>:</td>
                        <td>
                            <div id="files_list" class="file_upload">
                                <ul style="list-style-type: none">
                                    {foreach from=$invAttachments item="invAttach"}
                                    <li>
                                        <a href="javascript:openpopup('{$SITE_URL}upload/attachment_docs/invoice/{$iInvoiceID}/{$invAttach.vFile}')" > {$invAttach.vFile}</a>
                                    </li>
                                    {/foreach}
                                </ul>
                            </div>
                        </td>
                    </tr>
                    {/if}
                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    {if $msg neq 'pop'}
                    <tr>
                        <td valign="bottom" align="center" colspan="3">
                            <!--<img src="{$SITE_IMAGES}sm_images/btn-back.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" {if $curORGID eq $invoiceData.iBuyerOrganizationID}onclick="location.href='{$SITE_URL_DUM}invacptlist/{$smarty.session.invlvl}';"{else}onclick="location.href='{$SITE_URL_DUM}invoicelist/{$smarty.session.invlvl}';"{/if} />-->
                            {if $permitted eq 'Yes' && $usertype neq 'orgadmin'}
                            {if $auth neq 'y'}
                            {if $act eq 'y'}
                            <img src="{$SITE_IMAGES}btn-accept.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('verify');$('#frmadd').submit();" />
                            {elseif $isue eq 'y'}
                            <img src="{$SITE_IMAGES}btn-issue.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('verify');$('#frmadd').submit();" />
                            {else}
                            <img src="{$SITE_IMAGES}sm_images/btn-verify.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('verify');$('#frmadd').submit();" />
                            {/if}
                            {else}
                            <img src="{$SITE_IMAGES}btn-authorise.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('verify');$('#frmadd').submit();" />
                            {/if}
                            <img src="{$SITE_IMAGES}sm_images/btn-reject.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('reject');$('#frmadd').submit();" />
                            {/if}
                            <img src="{$SITE_IMAGES}sm_images/btn-back.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" {if $curORGID eq $invoiceData.iBuyerOrganizationID}onclick="location.href='{$SITE_URL_DUM}invacptlist/{$smarty.session.invlvl}';"{else}onclick="location.href='{$SITE_URL_DUM}invoicelist/{$smarty.session.invlvl}';"{/if} />
                                 {if $invoiceData.iStatusID eq $acptsts[0].iStatusID && $invoiceData.iaStatusID eq $acptsts[0].iStatusID && $invoiceData.iaStatusID|trim neq '' && $invoiceData.iaStatusID >0}
                                 <a title="{$LBL_PRINT}" style="cursor:pointer" class="colorboxfile" rel="{$iInvoiceID}"><img src="{$SITE_IMAGES}btn-print.gif" alt="" id="print_btn" border="0" style="cursor:pointer; vertical-align:middle;" /></a>
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