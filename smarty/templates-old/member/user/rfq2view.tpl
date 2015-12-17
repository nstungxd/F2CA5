<div class="middle-container">
    <h1>{$LBL_VIEW} {$LBL_RFQ2}</h1>
    <div class="middle-containt">
        <div class="statistics-main-box-white">
            <div>
                <ul id="inner-tab">
                    <li><a href="{$SITE_URL_DUM}rfq2view/{$iRFQ2Id}" class="current"><em>{$LBL_VIEW} {$LBL_RFQ2}</em></a></li>
                </ul>
            </div>
            <div class="clear"></div>
            <div class="inner-gray-bg">
                <div id="msg" class="msg">&nbsp;
                    {if $usertype neq 'orgadmin'}{if $vreq eq 'y' && $permitted eq 'y'}{if $dtls[0].eDelete eq 'Yes'}{$LBL_NEED_TO_VERIFY_FOR_DELETE}{else}{$LBL_NEED_TO_VERIFY}{/if}{elseif $vreq eq 'y'}{$LBL_NEED_TO_VERIFY_BY_OTHERS}{/if}{/if}
                </div>
                <div><span style="float:right;"><b><a class="" href="javascript:openpopup('{$SITE_URL_DUM}rfq2viewhistory/{$iRFQ2Id}')" >{$LBL_VIEW_HISTORY}</a></b></span></div>
                <div>
                    <form name="frmadd" id="frmadd" action="{$SITE_URL}index.php?file=u-rfq2create_a"  method="post">
                        <input type="hidden" name="edelete" id="edelete" value="{$invoiceData.eDelete}" />
                        <input type="hidden" name="iRFQ2Id" id="iRFQ2Id" value="{$iRFQ2Id}" />
                        <input type="hidden" name="view" id="view" value="" />
                        <input type="hidden" name="gmtoffset" id="gmtoffset" value="" />
                        <table width="97%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
                            <tr><td colspan="3" align="right"><font size="2" color="red"><b>{$var_msg}</b></font></td></tr>
                            <tr>
                                <td width="190"><b>{$LBL_RFQ2_CODE}</b></td>
                                <td width="1">:</td>
                                <td class="blue-ore" width="390">{$dtls[0].vRFQ2Code}</td>
                            </tr>
                            <tr><td colspan="3">&nbsp;</td></tr>
                            {if $dtls[0].eFrom eq 'Invoice'}
                            <tr>
                                <td colspan="2"><u><b>{$LBL_INVOICE_DETAILS}</b></u></td>
                            </tr>
                            <tr><td colspan="3" height="1px" style="border-top:1px solid #cccccc; line-height:1px; height:1px;">&nbsp;</td></tr>
                            <tr>
                                <td width="190">{$LBL_INV_CODE} </td>
                                <td  width="1">:</td>
                                <td class="blue-ore">
                                    <a target="_blank" style="text-decoration:underline; cursor:pointer;" onclick="openpopup('{$SITE_URL_DUM}invoiceview/{$dtls[0].iInvoiceID}/pop');">{$dtls[0].vInvoiceCode}</a>
                                </td>
                            </tr>
                            <tr>
                                <td >{$LBL_BUYER}</td>
                                <td>:</td>
                                <td class="">{$dtls[0].vBuyerName}</td>
                            </tr>
                            <tr>
                                <td >{$LBL_SUPPLIER}</td>
                                <td>:</td>
                                <td class="">{$dtls[0].vSupplierName}</td>
                            </tr>
                            <tr>
                                <td >{$LBL_BANK}</td>
                                <td>:</td>
                                <td class="">{$dtls[0].vBankName}</td>
                            </tr>
                            <tr>
                                <td >{$LBL_BANK_CODE}</td>
                                <td>:</td>
                                <td class="">{$dtls[0].vBankCode}</td>
                            </tr>
                            <tr>
                                <td >{$LBL_ACCOUNT}</td>
                                <td>:</td>
                                <td class="">{$dtls[0].vAccountName}</td>
                            </tr>
                            <tr>
                                <td >{$LBL_ACCOUNT} {$LBL_NUMBER}</td>
                                <td>:</td>
                                <td class="">{$dtls[0].vAccountNumber}</td>
                            </tr>
                            <tr>
                                <td >{$LBL_INVOICE_PAYABLE_DATE}</td>
                                <td>:</td>
                                <td class="">{if $dtls[0].dNetPaymentdate neq '0000-00-00'}{$dtls[0].dNetPaymentdate|calcLTzTime|DateTime:10}{else}---{/if}</td>
                            </tr>
                            <tr>
                                <td >{$LBL_ACCEPTED} {$LBL_DATE}</td>
                                <td>:</td>
                                <td class="">{if $dtls[0].dAcceptedDate neq '0000-00-00'}{$dtls[0].dAcceptedDate|calcLTzTime|DateTime:10}{else}---{/if}</td>
                            </tr>
                            <tr>
                                <td >{$LBL_INVOICE_PAYABLE} ({$LBL_ACCEPTED}) {$LBL_AMOUNT}</td>
                                <td>:</td>
                                <td class="ipaam">{$dtls[0].fAcceptedAmount|number_format:2:'.':','}</td>
                            </tr>
                            <tr>
                                <td >{$LBL_INVOICE_TOTAL}</td>
                                <td>:</td>
                                <td class="">{$dtls[0].fInvoiceTotal|number_format:2:'.':','}</td>
                            </tr>
                            <tr>
                                <td >{$LBL_CURRENCY}</td>
                                <td>:</td>
                                <td class="">{$dtls[0].vCurrency}</td>
                            </tr>
                            {/if}
                            {if $dtls[0].eFrom eq 'PO'}
                            <tr>
                                <td colspan="2"><u><b>{$LBL_PURCHASE_ORDER_DETAILS}</b></u></td>
                            </tr>
                            <tr><td colspan="3" height="1px" style="border-top:1px solid #cccccc; line-height:1px; height:1px;">&nbsp;</td></tr>
                            <tr>
                                <td width="190">{$LBL_PO_CODE} </td>
                                <td  width="1">:</td>
                                <td class="blue-ore">
                                    <a target="_blank" style="text-decoration:underline; cursor:pointer;" onclick="openpopup('{$SITE_URL_DUM}purchaseorderview/{$dtls[0].iPurchaseOrderID}/pop');">{$dtls[0].vPOCode}</a>
                                </td>
                            </tr>
                            <tr>
                                <td >{$LBL_BUYER}</td>
                                <td>:</td>
                                <td class="">{$dtls[0].vBuyerCompanyName}</td>
                            </tr>
                            <tr>
                                <td >{$LBL_SUPPLIER}</td>
                                <td>:</td>
                                <td class="">{$dtls[0].poh_vSupplierName}</td>
                            </tr>                            
                            <tr>
                                <td >{$LBL_PO_TOTAL}</td>
                                <td>:</td>
                                <td class="">{$dtls[0].fPOTotal|number_format:2:'.':','}</td>
                            </tr>
                            <tr>
                                <td >{$LBL_CURRENCY}</td>
                                <td>:</td>
                                <td class="">{$dtls[0].vCurrency}</td>
                            </tr>
                            {/if}

                            {*if $invattachs|is_array && $invattachs|@count>0}
                            <tr>
                                <td width="150">{$LBL_ATTACHMENTS} </td>
                                <td  width="1">:</td>
                                <td class="">
                                    {section name="l" loop=$invattachs}
                                    {if $smarty.section.l.index>0}, {/if}
                                    <a {*href="{$invattachs[l]}"} class="colorbox" onmouseover="// CallColoerBox(this.href,750,500,'options');" onclick="return openpopup('{$invattachs[l]}');" style="cursor:pointer;">{$LBL_FILE}-{$smarty.section.l.index+1}</a>
                                    {/section}
                                </td>
                            </tr>
                            {/if*}

                            {*<tr>
                                <td colspan="2">&nbsp;</td>
                                <td class="" align="right">
                                    <a href="{$SITE_URL_DUM}invoiceview/{$dtls[0].iInvoiceID}" target="_blank">{$LBL_VIEW} {$LBL_INVOICE_DETAILS}</a>
                                </td>
                            </tr>*}
                            <tr><td colspan="3" style="border-top:1px solid #cccccc;">&nbsp;</td></tr>

                            <tr>
                                <td>{$LBL_TYPE}  </td>
                                <td>:</td>
                                <td>{$dtls[0].eAuctionType}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_BID_CRITERIA}</td>
                                <td>:</td>
                                <td>{$dtls[0].eBidCriteria}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_START_DATE}</td>
                                <td>:</td>
                                <td><span class='lsdt'>{$dtls[0].dStartDate|calcLTzTime|DateTime:9} {$dtls[0].dStartDate|calcLTzTime|DateTime:15}</span></td>
                            </tr>
                            <tr>
                                <td>{$LBL_END_DATE}</td>
                                <td>:</td>
                                <td><span class='ledt'>{$dtls[0].dEndDate|calcLTzTime|DateTime:9} {$dtls[0].dEndDate|calcLTzTime|DateTime:15}</span></td>
                            </tr>
                            <tr>
                                <td>{$LBL_ADVANCE}</td>
                                <td>:</td>
                                <td>{$dtls[0].fAdvanceMinPc}% ({$dtls[0].fAdvanceMinAmt|number_format:2:'.':','})</td>
                            </tr>
                            <tr>
                                <td>{$LBL_PRICE}</td>
                                <td>:</td>
                                <td>{$dtls[0].fPriceMaxPc}% ({$dtls[0].fPriceMaxAmt|number_format:2:'.':','})</td>
                            </tr>
                            {*<tr>
                                <td>{$LBL_BID_INTERVAL_AMOUNT}</td>
                                <td>:</td>
                                <td>{$dtls[0].fIntervalPrice}</td>
                            </tr>*}
                            <tr>
                                <td>{$LBL_AUCTION_TENDER} {$LBL_STATUS}</td>
                                <td>:</td>
                                <td>{$dtls[0].eAuctionStatus}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_INSTRUCTIONS_CONDITIONS}</td>
                                <td>:</td>
                                <td style="word-wrap:break-word;">{if $dtls[0].tInstruction|trim neq ''}{$dtls[0].tInstruction|stripslashes}{else}---{/if}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_DESCRIPTION}</td>
                                <td>:</td>
                                <td style="word-wrap:break-word;">{if $dtls[0].tDescription|trim neq ''}{$dtls[0].tDescription|stripslashes}{else}---{/if}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_PRODUCT_TYPE}</td>
                                <td>:</td>
                                <td>{$rfq2pb2_dtls[0].ePType}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_PRODUCT}</td>
                                <td>:</td>
                                <td>{$product_dtls[0].vProductName} ({$product_dtls[0].vProductCode})</td>
                            </tr>
                            <tr>
                                <td valign="top">{$LBL_BUYER2}</td>
                                <td valign="top">:</td>
                                <td style="word-wrap:break-word; width:590px;" valign="top">
                                    <div><input type="text" id="b2fltr" name="b2fltr" style="width:190px; width:393px;" /></div>
                                    <div id="b2s" style="display:inline-block; padding:3px; height:100px; width:390px; overflow:scroll; border:1px solid #cccccc;">
                                        {section name="l" loop=$buyer2_dtls}
                                        {*if $smarty.section.l.index>0}, {/if*}
                                        <div>{$smarty.section.l.index+1}) &nbsp; {$buyer2_dtls[l].vCompanyName} ({$buyer2_dtls[l].vCompCode})</div>
                                        {/section}
                                    </div>
                                </td>
                            </tr>
                            {if $dtls[0].eAuctionStatus|strtolower neq 'not started' && $dtls[0].iOrganizationID eq $curORGID}
                            <tr><td colspan="3"><img src="{$SITE_IMAGES}sm_images/arrow-orange.gif" /> <a href="{$SITE_URL_DUM}rfq2bidlist/{$iRFQ2Id}"><b>{$LBL_VIEW} {$LBL_BID} {$LBL_LIST}</b></a></td></tr>
                            {/if}
                            {if $dtls[0].iOrganizationID eq $curORGID && ($dtls[0].eAuctionStatus|strtolower eq 'completed' || $dtls[0].eAuctionStatus|strtolower eq 'cancelled')}
                            <tr><td colspan="3"><img src="{$SITE_IMAGES}sm_images/arrow-orange.gif" /> <a href="{$SITE_URL_DUM}rfq2awardlist/{$iRFQ2Id}/a"><b>{$LBL_VIEW} {$LBL_AWARD} {$LBL_LIST}</b></a></td></tr>
                            {/if}
                            <tr>
                                <td valign="top" colspan="3" align="center">
                                    <div></div>
                                </td>
                            </tr>

                            {if $permitted eq 'y' && $vreq eq 'y' && $usertype neq 'orgadmin'}
                            <tr>
                                <td valign="top">{$LBL_REASON_TO_REJECT} </td>
                                <td valign="top">:</td>
                                <td><textarea id="tReasonToReject" name="tReasonToReject" cols="70" rows="3"></textarea></td>
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
                            <tr>
                                <td valign="bottom" align="center" colspan="3">
                                    {if $usertype neq 'orgadmin'}{if $vreq eq 'y' && $permitted eq 'y'}
                                    <a class="btllbl" style="textarea-decoration:none;" onclick="$('#view').val('verify'); $('#frmadd').submit();"><b>{$LBL_VERIFY}</b></a>
                                    <a class="btllbl" style="textarea-decoration:none;" onclick="$('#view').val('reject'); $('#frmadd').submit();"><b>{$LBL_REJECT}</b></a>
                                    {elseif $dtls[0].eAuctionStatus|strtolower eq 'live'}
                                    <a class="btllbl" style="textarea-decoration:none;" onclick="return cancelrfq2();"><b>{$LBL_CANCEL} {$LBL_RFQ2}</b></a>
                                    {/if}{/if}
                                    <a class="btllbl" style="textarea-decoration:none;" {if $vreq neq 'y' && $dtls[0].eDelete eq 'No'}href="{$SITE_URL_DUM}rfq2list"{else}href="{$SITE_URL_DUM}rfq2vlist"{/if}><b>{$LBL_BACK}</b></a>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div>&nbsp;</div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{$SITE_CONTENT_JS}jfdatetime.js"></script>
{literal}
<script type="text/javascript">
    $('#gmtoffset').val(gmtoffset);
    var sd = '{/literal}{$dtls[0].dStartDate|strtotime}{literal}';
    var ed = '{/literal}{$dtls[0].dEndDate|strtotime}{literal}';
    var original_sd = sd;
    var original_ed = ed;
    sd = date('Y-m-d H:i:s', strtotime('+'+(-gmtoffset)+' minutes',sd));
    ed = date('Y-m-d H:i:s', strtotime('+'+(-gmtoffset)+' minutes',ed));
    sd = date('F j, Y', strtotime(sd)) + ' ' + date('h:i a', strtotime(sd));
    ed = date('F j, Y', strtotime(ed)) + ' ' + date('h:i a', strtotime(ed));
    //
    function cancelrfq2()
    {
        var ans = confirm(MSG_CONFIRM_DEL+" "+LBL_RFQ2+" ?");
        if(ans) {
            $('#view').val('cancel'); $('#frmadd').submit();
        } else {
            return false;
        }
        return false;
    }
    $(document).ready(function() {
        if(original_sd != ""){
            $('.lsdt').attr('innerHTML',sd);
        }        
        if(original_ed != ""){
            $('.ledt').attr('innerHTML',ed);
        }        
        //
        $("#b2fltr").bind("blur keyup", function(event) {
            if($.trim($(this).val())=='') {
                $('#b2s>div').show();
            } else {
                $('#b2s>div:not(:icontains('+$.trim($(this).val())+'))').hide();
                $('#b2s>div:icontains('+$.trim($(this).val())+')').show();
            }
        });
    });
</script>
{/literal}