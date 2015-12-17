<div class="middle-container">
    <h1>{$LBL_VIEW} {$LBL_RFQ2}</h1>
    <div class="middle-containt">
        <div class="statistics-main-box-white">
            <div>
                <ul id="inner-tab">
                    <li><a href="{$SITE_URL_DUM}b2rfq2view/{$iRFQ2Id}" class="current"><em>{$LBL_VIEW} {$LBL_RFQ2}</em></a></li>
                    {*if $dtls[0].iRFQ2Id >0}<li><a href="{$SITE_URL_DUM}b2rfq2autobids/{$iRFQ2Id}" class=""><em>{$LBL_AUTO_BID} {$LBL_SETTINGS}</em></a></li>{/if*}
                    {if $dtls[0].iRFQ2Id >0}<li><a href="{$SITE_URL_DUM}rfq2bidhistory/{$dtls[0].iRFQ2Id}" class=""><em>{$LBL_RFQ2} {$LBL_BIDS}</em></a></li>{/if}
                </ul>
            </div>
            <div class="clear"></div>
            <div class="inner-gray-bg">
                <div id="msg" class="msg">&nbsp;
                    {if $usertype neq 'orgadmin'}{if $vreq eq 'y' && $permitted eq 'y'}{if $dtls[0].eDelete eq 'Yes'}{$LBL_NEED_TO_VERIFY_FOR_DELETE}{else}{$LBL_NEED_TO_VERIFY}{/if}{elseif $vreq eq 'y'}{$LBL_NEED_TO_VERIFY_BY_OTHERS}{/if}{/if}
                </div>
                <div>
                    <form name="frmadd" id="frmadd" action="{$SITE_URL}index.php?file=u-rfq2bidcreate_a"  method="post" enctype="multipart/form-data">
                        <input type="hidden" name="iBidId" id="iBidId" value="{$bdtls[0].iBidId}" />
                        <input type="hidden" name="view" id="view" value="{$view}" />
                        <table width="97%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
                            <tr><td colspan="3" align="right"><font size="2" color="red"><b>{$var_msg}</b></font></td></tr>
                            {if $dtls[0].iRFQ2Id >0}
                            <tr>
                                <td width="139"><b>{$LBL_RFQ2_CODE}</b></td>
                                <td width="1">:</td>
                                <td class="blue-ore" width="390">
                                    {$dtls[0].vRFQ2Code}
                                    <input type="hidden" name="Data[iRFQ2Id]" id="iRFQ2Id" value="{$iRFQ2Id}" />
                                </td>
                            </tr>
                            {else}
                            <tr>
                                <td width="230"><b>{$LBL_SELECT} {$LBL_RFQ2}</b></td>
                                <td width="1">:</td>
                                <td class="blue-ore" width="390">{$rfq2s}</td>
                            </tr>
                            {/if}
                            <tr><td colspan="3">&nbsp;</td></tr>
                            <tr>
                                <td colspan="3" width="100%">
                                    <div id="rfq2dtls" style="{if $dtls[0].iRFQ2Id >0}{else}display:none;{/if}"">
                                         <table cellpadding="0" cellspacing="0" width="100%">
                                            {if $dtls[0].eFrom eq 'Invoice'}
                                            <tr>
                                                <td colspan="3"><u><b>{$LBL_INVOICE_DETAILS}</b></u></td>
                                            </tr>
                                            <tr><td colspan="3" height="1px" style="border-top:1px solid #cccccc; line-height:1px; height:1px;">&nbsp;</td></tr>
                                            <tr>
                                                <td width="230">{$LBL_INV_CODE} </td>
                                                <td  width="5">:</td>
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
                                                <td class="">{if $dtls[0].vBankName neq ''}{$dtls[0].vBankName}{else}---{/if}</td>
                                            </tr>
                                            <tr>
                                                <td >{$LBL_BANK_CODE}</td>
                                                <td>:</td>
                                                <td class="">{if $dtls[0].vBankCode neq ''}{$dtls[0].vBankCode}{else}---{/if}</td>
                                            </tr>
                                            <tr>
                                                <td >{$LBL_ACCOUNT}</td>
                                                <td>:</td>
                                                <td class="">{if $dtls[0].vAccountName neq ''}{$dtls[0].vAccountName}{else}---{/if}</td>
                                            </tr>
                                            <tr>
                                                <td >{$LBL_ACCOUNT} {$LBL_NUMBER}</td>
                                                <td>:</td>
                                                <td class="">{if $dtls[0].vAccountNumber neq ''}{$dtls[0].vAccountNumber}{else}---{/if}</td>
                                            </tr>
                                            <tr>
                                                <td >{$LBL_INVOICE_PAYABLE_DATE}</td>
                                                <td>:</td>
                                                <td class="">{if $dtls[0].dNetPaymentdate neq '0000-00-00'}{$dtls[0].dNetPaymentdate|DateTime:10}{else}---{/if}</td>
                                            </tr>
                                            <tr>
                                                <td >{$LBL_ACCEPTED} {$LBL_DATE}</td>
                                                <td>:</td>
                                                <td class="">{if $dtls[0].dAcceptedDate neq '0000-00-00'}{$dtls[0].dAcceptedDate|DateTime:10}{else}---{/if}</td>
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
                                                <td colspan="3"><u><b>{$LBL_PURCHASE_ORDER_DETAILS}</b></u></td>
                                            </tr>
                                            <tr><td colspan="3" height="1px" style="border-top:1px solid #cccccc; line-height:1px; height:1px;">&nbsp;</td></tr>
                                            <tr>
                                                <td width="230">{$LBL_PO_CODE} </td>
                                                <td  width="5">:</td>
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
                                                <td class="ipaam">{$dtls[0].fPOTotal|number_format:2:'.':','}</td>
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
                                                <td>{$dtls[0].dStartDate|calcLTzTime|DateTime:9} {$dtls[0].dStartDate|calcLTzTime|DateTime:15}</td>
                                            </tr>
                                            <tr>
                                                <td>{$LBL_END_DATE}</td>
                                                <td>:</td>
                                                <td>{$dtls[0].dEndDate|calcLTzTime|DateTime:9} {$dtls[0].dEndDate|calcLTzTime|DateTime:15}</td>
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
                                                <td>{$LBL_INSTRUCTIONS_CONDITIONS}</td>
                                                <td>:</td>
                                                <td style="word-wrap:break-word;">{if $dtls[0].tInstruction|trim neq ''}{$dtls[0].tInstruction}{else}---{/if}</td>
                                            </tr>
                                            <tr>
                                                <td>{$LBL_DESCRIPTION}</td>
                                                <td>:</td>
                                                <td style="word-wrap:break-word;">{if $dtls[0].tDescription|trim neq ''}{$dtls[0].tDescription}{else}---{/if}</td>
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
                                                <td>{$LBL_STATUS}</td>
                                                <td>:</td>
                                                <td style="text-transform:capitalize;">{$b2rfq2sts}</td>
                                            </tr>
                                            <tr>
                                                <td valign="top">{$LBL_DOCUMENT}</td>
                                                <td valign="top">:</td>
                                                <td>
                                                    <div>
                                                        <ul style="list-style-type:none">
                                                            {section name=i loop=$rfq2filearr}
                                                            <li>
                                                                <a href="javascript:openpopup('{$rfq2filearr[i].rfq2files}')">{$rfq2filearr[i].namefiles}</a><br>
                                                            </li>
                                                            {/section}
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">&nbsp;</td>
                                            </tr>

                                            {if $b2rfq2sts eq 'live' && $ur2p.Create eq 'y' && $allow_bid eq 'y'}
                                            <tr id="bdnwb" style="{if $b2rfq2sts neq 'live'}display:none;{/if}">
                                                <td><b class="blue-ore bdnw" style="font-size:14px; cursor:pointer;">{$LBL_BID_NOW}</b></td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr id="bd_adv" style="{if $b2rfq2sts neq 'live'}display:none;{/if}">
                                                <td valign="top">{$LBL_BID} {$LBL_ADVANCE}</td>
                                                <td valign="top">:</td>
                                                <td valign="top">
                                                    <input type="text" id="fBidAdvancePc" name="Data[fBidAdvancePc]" class="decimals" size="5" maxlength="6" title="{$LBL_ENTER} {$LBL_BID} {$LBL_ADVANCE}" value="{if $bdtls[0].eSaved eq 'Yes' || $dtls[0].eAuctionType eq 'Tender'}{$bdtls[0].fBidAdvancePc}{/if}" />% &nbsp;
                                                    <input type="text" id="fBidAdvanceAmt" name="Data[fBidAdvanceAmt]" class="required decimals" maxlength="10" title="{$LBL_ENTER} {$LBL_BID} {$LBL_ADVANCE}" value="{if $bdtls[0].eSaved eq 'Yes' || $dtls[0].eAuctionType eq 'Tender'}{$bdtls[0].fBidAdvanceAmt}{/if}" /> &nbsp;
                                                    <input type="hidden" id="fBidAdvanceTotal" name="Data[fBidAdvanceTotal]" value="{if $bdtls[0].eSaved eq 'Yes'}{$bdtls[0].fBidAdvanceTotal}{/if}" />
                                                    <!--<b><span class="bdat"></span></b>-->
                                                </td>
                                            </tr>
                                            <tr id="bd_prc" style="{if $b2rfq2sts neq 'live'}display:none;{/if}">
                                                <td valign="top">{$LBL_BID} {$LBL_PRICE}</td>
                                                <td valign="top">:</td>
                                                <td valign="top">
                                                    <input type="text" id="fBidPricePc" name="Data[fBidPricePc]" class="decimals" size="5" maxlength="6" title="{$LBL_ENTER} {$LBL_BID} {$LBL_PRICE}" value="{if $bdtls[0].eSaved eq 'Yes' || $dtls[0].eAuctionType eq 'Tender'}{$bdtls[0].fBidPricePc}{/if}" />% &nbsp;
                                                    <input type="text" id="fBidPriceAmt" name="Data[fBidPriceAmt]" class="required decimals" maxlength="10" title="{$LBL_ENTER} {$LBL_BID} {$LBL_PRICE}" value="{if $bdtls[0].eSaved eq 'Yes' || $dtls[0].eAuctionType eq 'Tender'}{$bdtls[0].fBidPriceAmt}{/if}" /> &nbsp;
                                                    <input type="hidden" id="fBidPriceTotal" name="Data[fBidPriceTotal]" value="" />
                                                    <!--<b><span class="bdpt"></span></b>-->
                                                </td>
                                            </tr>
                                            <tr id="bd_adc" style="{if $b2rfq2sts neq 'live'}display:none;{/if}">
                                                <td valign="top">{$LBL_ATTACH_DOCUMENT}</td>
                                                <td valign="top">:</td>
                                                <td>
                                                    <input type="file" name="upload" id="upload" style="height:23px;" />
                                                    <div id="files_list" class="file_upload"></div>
                                                    {if $bdtls[0].eSaved eq 'Yes' || $dtls[0].eAuctionType eq 'Tender'}
                                                    <ul style="list-style-type: none">
                                                        {foreach from=$rfq2bidfiles item="files"}
                                                        <li>
                                                            <a href="javascript:openpopup('{$files.vFile}')" > {$files.vFileName}</a><input type="button" value="Delete" onclick="deleteFile($(this).parent(),'{$files.iFileId}');" />
                                                        </li>
                                                        {/foreach}
                                                    </ul>
                                                    {/if}
                                                    <input type="hidden" name="deleteFiles" id="deleteFiles"/>
                                                </td>
                                            </tr>
                                            {/if}
                                        </table>
                                    </div>
                                </td>
                            </tr>

                            <tr><td valign="top" colspan="3"><input type="hidden" id="eSaved" name="Data[eSaved]" value="" /></td></tr>

                            {*if $permitted eq 'y' && $usertype neq 'orgadmin'}
                            <tr>
                                <td valign="top">{$LBL_REASON_TO_REJECT} </td>
                                <td valign="top">:</td>
                                <td><textarea id="tReasonToReject" name="tReasonToReject" cols="70" rows="3"></textarea></td>
                            </tr>
                            {/if*}
                            <tr><td colspan="3">&nbsp;</td></tr>
                            <tr>
                                <td valign="bottom" align="center" colspan="3">
                                    <span class="shmbtn">
                                        {*if $bdtls[0].eSaved neq 'No'*}
                                        {if $b2rfq2sts eq 'live' && $ur2p.Create eq 'y' && $allow_bid eq 'y'}
                                        <a id="btnSave" name="save" class="btllbl" style="textarea-decoration:none;" onclick="$('#eSaved').val('Yes'); return frmsubmit();" ondblclick="return false;" title="{$LBL_SAVE}" ><b>{$LBL_SAVE}</b></a>
                                        {*/if*}
                                        <a id="btnSubmit" name="submit" class="btllbl" style="textarea-decoration:none;" onclick="$('#eSaved').val('No'); return frmsubmit();" ondblclick="return false;" title="{$LBL_SUBMIT}" ><b>{$LBL_SUBMIT}</b></a>
                                        <a id="btnreset" name="reset" class="btllbl" style="textarea-decoration:none;" onclick="frmreset();" title="{$LBL_RESET}" ><b>{$LBL_RESET}</b></a>
                                        {/if}
                                        {*if $usertype neq 'orgadmin'}{if $vreq eq 'y' && $permitted eq 'y'}
                                        <a class="btllbl" style="width:59px; textarea-decoration:none;" onclick="$('#view').val('verify'); $('#frmadd').submit();"><b>{$LBL_VERIFY}</b></a>
                                        <a class="btllbl" style="width:59px; textarea-decoration:none;" onclick="$('#view').val('reject'); $('#frmadd').submit();"><b>{$LBL_REJECT}</b></a>
                                        {/if}{/if*}
                                    </span>
                                    <a class="btllbl" style="textarea-decoration:none;" href="{$SITE_URL_DUM}b2rfq2list"><b>{$LBL_BACK}</b></a>
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

<script type="text/javascript" src="{$SITE_CONTENT_JS}multifile.js"></script>
<script type="text/javascript" src="{$S_JQUERY}jquery.validate.js"></script>
<script type="text/javascript" src="{$SITE_JS_AJAX}jrfq2bidcreate.js"></script>
{literal}
<script type="text/javascript">
    //
    var vmsg = '{/literal}{$vmsg}{literal}';
    if(vmsg!='') {
        alert(vmsg);
    }
    $('#frmadd').validate({
        rules: {
            /*"Data[fBidAdvancePc]": {
                   required: function() {
                                if($('#fBidAdvancePc').val()=='' && $('#fBidAdvanceAmt').val()=='') {
                                   return true;
                                }
                                return false;
                        }
                },*/
            "Data[fBidAdvanceAmt]": {
                required: function() {
                    if($('#fBidAdvancePc').val()=='' && $('#fBidAdvanceAmt').val()=='') {
                        return true;
                    }
                    return false;
                }
            },
            /*"Data[fBidPricePc]": {
                   required: function() {
                                if($('#fBidPricePc').val()=='' && $('#fBidPriceAmt').val()=='') {
                                   return true;
                                }
                                return false;
                        }
                },*/
            "Data[fBidPriceAmt]": {
                required: function() {
                    if($('#fBidPricePc').val()=='' && $('#fBidPriceAmt').val()=='') {
                        return true;
                    }
                    return false;
                }
            }
        },
        messages: {
            "Data[fBidAdvancePc]": { decimals: LBL_MUST_BE_NUMERIC },
            "Data[fBidAdvanceAmt]": { decimals: LBL_MUST_BE_NUMERIC, min: LBL_VALUE_MUST_BE_GREATER_THAN_ZERO },
            "Data[fBidPricePc]": { decimals: LBL_MUST_BE_NUMERIC },
            "Data[fBidPriceAmt]": { decimals: LBL_MUST_BE_NUMERIC, min: LBL_VALUE_MUST_BE_GREATER_THAN_ZERO }
        }
    });
    //
    function frmsubmit()
    {
        var vld = $('#frmadd').valid();
        $(document).ready( function() {
            $(function() {
                var ead=100;
                $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
            });
        });
        if(! vld) {
            return false;
        }
        $('#frmadd').submit();
        $(document).ready( function() {
            $(function() {
                var ead=100;
                $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
            });
        });
    }
    function frmreset() {
        $('#frmadd')[0].reset();
    }
    //
    var fileArr = new Array();
    function deleteFile(obj,fileid) {
        fileArr.push(fileid);
        $('#deleteFiles').val(fileArr);
        obj.html("");
    }
    //
    $(document).ready(function()
    {
        if(document.getElementById('upload')) {
            var multiSelect = new MultiSelector( document.getElementById('files_list'), 5);
            multiSelect.addElement(document.getElementById('upload'));
        }

        $('.bdnw').click(function() {
            if($('#bd_adv').is(':hidden')) {
                $('#bd_adv').show();
                $('#bd_prc').show();
                $('#bd_adc').show();
            } else {
                $('#bd_adv').hide();
                $('#bd_prc').hide();
                $('#bd_adc').hide();
            }
            /*$(document).ready( function() {
                                var ead = 10;
                                $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
                  });*/
        });
        $("#iRFQ2Id").change(function() {
            if($.trim($("#iRFQ2Id").val())!='' && !isNaN(parseInt($("#iRFQ2Id").val())) && parseInt($("#iRFQ2Id").val())>0) {
                var url=SITE_URL+"index.php?file=u-aj_getrfq2details";
                $.post(url,{iRFQ2Id:$("#iRFQ2Id").val()},function(resp) {
                    $("#rfq2dtls").attr('innerHTML',resp);
                    // $("#rfq2dtls").append(resp);
                    $("#rfq2dtls").show();
                    //
                    var url=SITE_URL+"index.php?file=u-aj_chkrfq2sts";
                    $.post(url,{iRFQ2Id:$("#iRFQ2Id").val()},function(resp) {
                        if($.trim(resp)!='') {
                            if($.trim(resp)!='nts') {
                                $('.shmbtn').attr('innerHTML',resp);
                                $('#bdnwb').show();
                                $('#bd_adv').show();
                                $('#bd_prc').show();
                                $('#bd_adc').show();
                            } else {
                                $('.shmbtn').attr('innerHTML','');
                                $('#bdnwb').hide();
                                $('#bd_adv').hide();
                                $('#bd_prc').hide();
                                $('#bd_adc').hide();
                            }
                        }
                    });
                    //
                    $(document).ready( function() {
                        var ead = 10;
                        $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
                    });
                });
            } else {
                $("#rfq2dtls").attr('innerHTML','');
                // $("#rfq2dtls").append(resp);
                $("#rfq2dtls").hide();
            }
        });
    });
</script>
{/literal}