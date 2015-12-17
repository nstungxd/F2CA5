<div class="middle-container">
    <h1>{$LBL_VIEW_BID_DETAILS}</h1>
    <div class="middle-containt">
        <div class="statistics-main-box-white">
            <div class="clear"></div>
            <div class="inner-gray-bg">
                <form name="frmadd" id="frmadd" method="post" action="{$SITE_URL}index.php?file=u-rfq2bidawardcreate_a">
                    <input type="hidden" id="view" name="view" value="" />
                    <input type="hidden" id="iBidId" name="iBidId" value="{$iBidId}" />
                    {if $award_created|@count gt 0}
                    <input type="hidden" id="iAwardId" name="iAwardId" value="{$award_created[0].iAwardId}" />
                    {/if}
                    <div id="msg" class="msg">&nbsp;
                        {if $acpdt eq 'ex'}{$LBL_STATUS}: {$LBL_AWARDED}{/if}
                        {*if $usertype neq 'orgadmin'}{if $vreq eq 'y' && $permitted eq 'y'}{if $bidarr[0].eDelete eq 'Yes'}{$LBL_NEED_TO_VERIFY_FOR_DELETE}{else}{$LBL_NEED_TO_VERIFY}{/if}{elseif $vreq eq 'y'}{$LBL_NEED_TO_VERIFY_BY_OTHERS}{/if}{/if*}
                    </div>
                    <div>{*if $bidarr[0].iBidId >0}<span style="float:right;"><b><a class="" href="javascript:openpopup('{$SITE_URL_DUM}viewrfq2bidhistory/{$iBidId}')" >{$LBL_VIEW_BID_HISTORY}</a></b></span>{else}&nbsp;{/if*}</div>

                    <div id="r2bh" align="center">
                        <div>
                            <table cellspacing="0" cellspadding="0" border="0" width="100%" align="left">
                                <tr>
                                    <td width="190px" class="blue-ore"><b>{$LBL_BIDNUM}</b></td>
                                    <td>:</td>
                                    <td class="blue-ore">
                                        {$bidarr[0].vBidNum}
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>{$LBL_BUYER2}</b></td>
                                    <td>:</td>
                                    <td>{$bidarr[0].vBuyer2}</td>
                                </tr>
                                <tr>
                                    <td><b>{$LBL_RFQCODE}</b></td>
                                    <td>:</td>
                                    <td>{$bidarr[0].vRFQ2Code}</td>
                                </tr>
                                <tr>
                                    <td><b>{$LBL_BIDADVANCE}</b></td>
                                    <td>:</td>
                                    <td>{$bidarr[0].fBidAdvanceTotal|number_format:2:'.':','}</td>
                                </tr>
                                <tr>
                                    <td><b>{$LBL_BIDPRICE}</b></td>
                                    <td>:</td>
                                    <td>{$bidarr[0].fBidPriceTotal|number_format:2:'.':','}</td>
                                </tr>
                                <tr>
                                    <td><b>{$LBL_STATUS}</b></td>
                                    <td>:</td>
                                    <td>
                                        {if $bidarr[0].eSaved eq 'Yes'}
                                        {$LBL_SAV}
                                        {elseif $bidarr[0].eDelete eq 'Yes'}
                                        {$LBL_DELETE}
                                        {elseif $bidarr[0].eStatus eq 'Not Started'}
                                        {$LBL_NOT_STARTED}
                                        {elseif $bidarr[0].eStatus eq 'LIVE'}
                                        {$LBL_LIVE}
                                        {elseif $bidarr[0].eStatus eq 'Completed'}
                                        {$LBL_COMPLETED}
                                        {elseif $bidarr[0].eStatus eq 'Cancelled'}
                                        {$LBL_CANCELLED}
                                        {else}
                                        {$bidarr[0].eStatus}
                                        {/if}
                                    </td>
                                </tr>
                                <tr id="bd_adc" style="{*if $rfq2bidfiles|is_array && $rfq2bidfiles| @ count>0}{else}display:none;{/if*}">
                                    <td valign="top"><b>{$LBL_DOCUMENTS}</b></td>
                                    <td valign="top">:</td>
                                    <td>
                                        <div>
                                            {foreach from=$rfq2bidfiles item="files"}
                                            <div><a href="javascript:openpopup('{$files.vFile}')" > {$files.vFileName}</a></div>
                                            {foreachelse}
                                            <div>{$LBL_NO_DOCUMENTS_AVAILABLE}</div>
                                            {/foreach}
                                        </div>
                                    </td>
                                </tr>
                                {if $permitted eq 'y' && $vreq eq 'y' && $usertype neq 'orgadmin'}
                                <tr>
                                    <td valign="top">{$LBL_REASON_TO_REJECT} </td>
                                    <td valign="top">:</td>
                                    <td><textarea id="tReasonToReject" name="tReasonToReject" cols="70" rows="3"></textarea></td>
                                </tr>
                                {/if}
                            </table>
                        </div>
                        <div>&nbsp;</div>
                    </div>
                    <div style="clear:both;">&nbsp;</div>
                    <div><b class="blue-ore bdnw" style="font-size:12.9px; cursor:pointer;" onclick="showrfq2details();">{$LBL_RFQ2_DETAILS}</b></div>

                    <div id="rfq2details" name="rfq2details">
                        <table cellspacing="0" cellspadding="0" border="0" width="100%">
                            <tr>
                                <td width="190px">{$LBL_TYPE}</td>
                                <td>:</td>
                                <td>{$bidarr[0].eAuctionType}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_BID_CRITERIA}</td>
                                <td>:</td>
                                <td>{$bidarr[0].eBidCriteria}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_START_DATE}</td>
                                <td>:</td>
                                <td>{$bidarr[0].dStartDate|calcLTzTime|DateTime:9} {$bidarr[0].dStartDate|calcLTzTime|DateTime:15}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_END_DATE}</td>
                                <td>:</td>
                                <td>{$bidarr[0].dEndDate|calcLTzTime|DateTime:9} {$bidarr[0].dEndDate|calcLTzTime|DateTime:15}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_ADVANCE}</td>
                                <td>:</td>
                                <td>{$bidarr[0].fAdvanceMinPc}% ({$bidarr[0].fAdvanceMinAmt|number_format:2:'.':','})</td>
                            </tr>
                            <tr>
                                <td>{$LBL_PRICE}</td>
                                <td>:</td>
                                <td>{$bidarr[0].fPriceMaxPc}% ({$bidarr[0].fPriceMaxAmt|number_format:2:'.':','})</td>
                            </tr>
                            <tr>
                                <td>{$LBL_INSTRUCTIONS_CONDITIONS}</td>
                                <td>:</td>
                                <td style="word-wrap:break-word;">{if $bidarr[0].tInstruction|trim neq ''}{$bidarr[0].tInstruction}{else}---{/if}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_DESCRIPTION}</td>
                                <td>:</td>
                                <td style="word-wrap:break-word;">{if $productdtls[0].tDescription|trim neq ''}{$productdtls[0].tDescription}{else}---{/if}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_PRODUCT_TYPE}</td>
                                <td>:</td>
                                <td>{$rfq2pb2_dtls[0].ePType}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_PRODUCT}</td>
                                <td>:</td>
                                <td>{$productdtls[0].vProductName} ({$productdtls[0].vProductCode})</td>
                            </tr>
                            <tr>
                                <td valign="top">{$LBL_DOCUMENT}</td>
                                <td valign="top">:</td>
                                <td>
                                    <div>
                                        <ul style="list-style-type:none">
                                            {section name=i loop=$rfq2files}
                                            <li>
                                                <a href="javascript:openpopup('{$rfq2files[i].fileurl}')">{$rfq2files[i].filename}</a><br>
                                            </li>
                                            {/section}
                                        </ul>
                                    </div>	
                                </td>
                            </tr>
                            <tr><td colspan="3">&nbsp;</td></tr>			    
                        </table>
                    </div>
                    <div>&nbsp;</div>

                    {if $bidarr[0].eFrom eq 'Invoice'}
                    <div><b class="blue-ore bdnw" style="font-size:12.9px; cursor:pointer;" onclick="showinvoicedetails()">{$LBL_INVOICE_DETAILS}</b></div>
                    <div id="invoicedetails" name="invoicedetails">                        
                        <table cellspacing="0" cellspadding="0" border="0" width="100%">
                            <tr>
                                <td width="190px">{$LBL_INV_CODE}</td>
                                <td>:</td>
                                <td>{$bidarr[0].vInvoiceCode}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_BUYER}</td>
                                <td>:</td>
                                <td>{$bidarr[0].vBuyerName}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_SUPPLIER}</td>
                                <td>:</td>
                                <td>{$bidarr[0].vSupplierName}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_BANK}</td>
                                <td>:</td>
                                <td class="">{if $bidarr[0].vBankName neq ''}{$dtls[0].vBankName}{else}---{/if}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_BANK_CODE}</td>
                                <td>:</td>
                                <td class="">{if $bidarr[0].vBankCode neq ''}{$bidarr[0].vBankCode}{else}---{/if}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_ACCOUNT}</td>
                                <td>:</td>
                                <td class="">{if $bidarr[0].vAccountName neq ''}{$bidarr[0].vAccountName}{else}---{/if}</td>
                            </tr>
                            <tr>
                                <td >{$LBL_ACCOUNT} {$LBL_NUMBER}</td>
                                <td>:</td>
                                <td class="">{if $bidarr[0].vAccountNumber neq ''}{$bidarr[0].vAccountNumber}{else}---{/if}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_INVOICE_PAYABLE_DATE}</td>
                                <td>:</td>
                                <td class="">{if $bidarr[0].dNetPaymentdate neq '0000-00-00'}{$bidarr[0].dNetPaymentdate|calcLTzTime|DateTime:10}{else}---{/if}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_ACCEPTED} {$LBL_DATE}</td>
                                <td>:</td>
                                <td class="">{if $bidarr[0].dAcceptedDate neq '0000-00-00'}{$bidarr[0].dAcceptedDate|calcLTzTime|DateTime:10}{else}---{/if}</td>
                            </tr>
                            <tr>
                                <td >{$LBL_INVOICE_PAYABLE} ({$LBL_ACCEPTED}) {$LBL_AMOUNT}</td>
                                <td>:</td>
                                <td class="ipaam">{$bidarr[0].fAcceptedAmount|number_format:2:'.':','}</td>
                            </tr>
                            <tr>
                                <td >{$LBL_INVOICE_TOTAL}</td>
                                <td>:</td>
                                <td class="">{$bidarr[0].fInvoiceTotal|number_format:2:'.':','}</td>
                            </tr>
                            <tr>
                                <td >{$LBL_CURRENCY}</td>
                                <td>:</td>
                                <td class="">{$bidarr[0].vCurrency}</td>
                            </tr>
                            <tr>
                                <td valign="top">{$LBL_DOCUMENT}</td>
                                <td valign="top">:</td>
                                <td>
                                    <div>
                                        <ul style="list-style-type:none">
                                            {section name=j loop=$invoiceorder}
                                            <li><a href="javascript:openpopup('{$invoiceorder[j].fileurl}')">{$invoiceorder[j].filename}</a><br></li>
                                            {/section}
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    {/if}
                    {if $bidarr[0].eFrom eq 'PO'}
                    <div><b class="blue-ore bdnw" style="font-size:12.9px; cursor:pointer;" onclick="showpodetails()">{$LBL_PURCHASE_ORDER_DETAILS}</b></div>
                    <div id="podetails" name="podetails">                        
                        <table cellspacing="0" cellspadding="0" border="0" width="100%">
                            <tr>
                                <td width="190px">{$LBL_PO_CODE}</td>
                                <td>:</td>
                                <td>{$bidarr[0].vPOCode}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_BUYER}</td>
                                <td>:</td>
                                <td>{$bidarr[0].vBuyerCompanyName}</td>
                            </tr>
                            <tr>
                                <td>{$LBL_SUPPLIER}</td>
                                <td>:</td>
                                <td>{$bidarr[0].ph_vSupplierName}</td>
                            </tr>
                            <tr>
                                <td >{$LBL_PO_TOTAL}</td>
                                <td>:</td>
                                <td class="">{$bidarr[0].fPOTotal|number_format:2:'.':','}</td>
                            </tr>
                            <tr>
                                <td >{$LBL_CURRENCY}</td>
                                <td>:</td>
                                <td class="">{$bidarr[0].vCurrency}</td>
                            </tr>
                            <tr>
                                <td valign="top">{$LBL_DOCUMENT}</td>
                                <td valign="top">:</td>
                                <td>
                                    <div>
                                        <ul style="list-style-type:none">
                                            {section name=j loop=$invoiceorder}
                                            <li><a href="javascript:openpopup('{$invoiceorder[j].fileurl}')">{$invoiceorder[j].filename}</a><br></li>
                                            {/section}
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    {/if}
                    
                    {if $bidarr[0].iRFQ2Id >0}
                    <div>&nbsp;</div>
                    <div><img src="{$SITE_IMAGES}sm_images/arrow-orange.gif" /> <a href="{$SITE_URL_DUM}rfq2view/{$bidarr[0].iRFQ2Id}"><b>{$LBL_GO_TO} {$LBL_RFQ2} {$LBL_DETAILS} {$LBL_PAGE}</b></a></div>
                    {/if}
                    {if $obid_dtls|is_array && $obid_dtls|count >0 && $rfq2_awarded neq 'y'}
                    <div>&nbsp;</div>
                    <div>
                        <span style="display:inline-block; width:190px; vertical-align:top;"><b>{$LBL_OTHER_BIDS}:</b></span>
                        <span style="display:inline-block;"><input type="text" id="bidfilter" name="bidfilter" style="width:505px;" /></span><br/>
                        <span style="display:inline-block; width:190px; vertical-align:top;">&nbsp;</span>
                        <span class="bidlist" style="display:inline-block; border:1px solid #cccccc; padding:3px; width:500px; height:130px; overflow:scroll;">
                            {section name="l" loop=$obid_dtls}
                            <div class="bbid" style="height:20px; {if $bestbid_id>0 && $obid_dtls[l].iBidId eq $bestbid_id}background:#f3fcca;{/if}">
                                <input type="radio" id="bidids_{$obid_dtls[l].iBidId}" name="bidids[]" value="{$obid_dtls[l].iBidId}" />
                                <span>{$obid_dtls[l].vBuyer2} [<b>{$LBL_ADVANCE}:</b> {$obid_dtls[l].fBidAdvanceTotal|number_format:2:'.':','}, <b>{$LBL_PRICE}:</b> {$obid_dtls[l].fBidPriceTotal|number_format:2:'.':','}]</span>
                            </div>
                            {/section}
                        </span>
                        <div>
                            <span style="display:inline-block; width:190px; vertical-align:top;">&nbsp;</span>
                            <a class="btllbl" style="textarea-decoration:none;" onclick="gotoselbid()"><b>{$LBL_SELECT} {$LBL_BID}</b></a>
                        </div>
                    </div>
                    {/if}
                    {if $rejdt eq 'ex'}
                    <div>&nbsp;</div>
                    <div class="err">{$MSG_AWARD_ON_THIS_BID_REJECTED_BY_BUYER2}</div>
                    {/if}
                    <div>&nbsp;</div>
                    <div align="center">
                        {if $usertype neq 'orgadmin'}{if $vreq eq 'y' && $permitted eq 'y' && $rfq2_awarded neq 'y' && $rejdt neq 'ex'}
                        <a class="btllbl" style="width:59px; textarea-decoration:none;" onclick="$('#view').val('save'); $('#frmadd').submit();"><b>{$LBL_SAVE}</b></a>
                        <a class="btllbl" style="textarea-decoration:none;" onclick="$('#view').val('award'); $('#frmadd').submit();"><b>{$LBL_AWARD}</b></a>
                        <a class="btllbl" style="textarea-decoration:none;" onclick="return cancelrfq2();"><b>{$LBL_CANCEL} {$LBL_RFQ2}</b></a>
                        {/if}{/if}
                        <a class="btllbl" style="textarea-decoration:none;" href="{$SITE_URL_DUM}rfq2bidlist"><b>{$LBL_BACK}</b></a>
                    </div>
                    <div>&nbsp;</div>
                </form>
            </div>
        </div>  
    </div>
</div>

<script type="text/javascript" src="{$S_JQUERY}jquery.validate.js"></script>
{literal}
<script type="text/javascript">
    function cancelrfq2() {
        var ans = confirm(MSG_CONFIRM_DEL+" "+LBL_RFQ2+" ?");
        if(ans) {
            $('#view').val('reject'); $('#frmadd').submit();
        } else {
            return false;
        }
        return false;
    }
    function showrfq2details() {
        $("#rfq2details").show();
        $(document).ready( function() {
            var ead = 10;
            $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
        });
    }
    function showinvoicedetails() {
        $("#invoicedetails").show();
        $(document).ready( function() {
            var ead = 10;
            $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
        });
    }
    function showpodetails() {
        $("#podetails").show();
        $(document).ready( function() {
            var ead = 10;
            $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
        });
    }
    function gotoselbid() {
        $bid = $('input[name="bidids\[\]"]:checked').val();
        if($.trim($bid)!='' && parseInt($bid)>0) {
            window.location = SITE_URL+'rfq2bidview/'+$bid;
        }
    }
    $(document).ready(function() {	   
        $("#invoicedetails").hide();
        $("#rfq2details").hide();
        $("#podetails").hide();
    });
    $(document).ready( function() {
        var ead=100;
        $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
    });
    $(document).ready(function() {
        textfilter('#bidfilter','.bbid','blur keyup');
    });
</script>
{/literal}