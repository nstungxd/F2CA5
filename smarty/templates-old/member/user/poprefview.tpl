<div class="middle-container">
    <h1>{$LBL_VIEW_PURCHASE_ORDER}</h1>
    <div class="middle-containt">
        <div class="statistics-main-box-white">
            <div>
                <ul id="inner-tab">
                    <li><a href="{$SITE_URL_DUM}purchaseorderview/{$iPurchaseOrderID}{if $var_msg eq 'pop'}/pop{/if}"><em>{$LBL_VIEW} {$LBL_PO_HEADER}</em></a></li>
                    {*if $imgdt neq 'yes'*}
                    <li><a href="{$SITE_URL_DUM}poprefview/{$iPurchaseOrderID}{if $var_msg eq 'pop'}/pop{/if}" class="current"><em>{$LBL_VIEW} {$LBL_PREFERENCES}</em></a></li>
                    <li><a href="{$SITE_URL_DUM}poviewitems/{$iPurchaseOrderID}{if $var_msg eq 'pop'}/pop{/if}" ><em>{$LBL_VIEW_PO_ITEM}</em></a></li>
                    {*/if*}
                </ul>
            </div>
            <div class="clear"></div>
            <div class="inner-gray-bg">
                <div id="msg" class="msg">{if $usertype neq 'orgadmin'}&nbsp;{$nxtstatus.vStatusMsg}{/if}
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
                    {/if}
                    {/if}
                </div>
                <div><span style="float:right;"><b><a class="" href="javascript:openpopup('{$SITE_URL_DUM}poviewhistory/{$iPurchaseOrderID}')" >{$LBL_VIEW_HISTORY}</a></b></span></div>
                <div class="clear"></div>
                <div>
                    <form name="frmadd" id="frmadd" action="{$SITE_URL}index.php?file=u-purchaseordercreate_a" method="post">
                        <input type="hidden" name="iPurchaseOrderID" id="iPurchaseOrderID" value="{$iPurchaseOrderID}" />
                        <input type="hidden" name="iPOID" id="iPOID" value="{$iPurchaseOrderID}" />
                        <input type="hidden" name="nstatus" id="nstatus" value="{$nxtstatus.iStatusID}" />
                        <input type="hidden" name="edelete" id="edelete" value="{$poData.eDelete}" />
                        <input type="hidden" name="view" id="view" value="{$view}" />
                        <table width="97%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
                            <tr><td colspan="3" align="right"><font size="2" color="red"><b>{$var_msg}</b></font></td></tr>
                            <tr>
                                <td  width="190px" valign="top">{$LBL_SOURCE_DOC} </td>
                                <td valign="top">:</td>
                                <td class="blue-ore" valign="top">{$poprefdt[0].tSourcingDocument|stripslashes}</td>
                            </tr>
                            <tr>
                                <td valign="top">{$LBL_GLOBAL_AGREEMENT} </td>
                                <td valign="top">:</td>
                                <td class="blue-ore" valign="top">{$poprefdt[0].tGlobalAgreement|stripslashes}</td>
                            </tr>
                            <tr>
                                <td valign="top">{$LBL_PAYMENT_TERMS} </td>
                                <td valign="top">:</td>
                                <td class="blue-ore" valign="top">{$poprefdt[0].tPaymentTerms|stripslashes}</td>
                            </tr>
                            <tr>
                                <td valign="top">{$LBL_FOB} </td>
                                <td valign="top">:</td>
                                <td class="blue-ore" valign="top">{$poprefdt[0].tFOB|stripslashes}</td>
                            </tr>
                            <tr>
                                <td valign="top">{$LBL_DELIVERY_TERMS} </td>
                                <td valign="top">:</td>
                                <td class="blue-ore" valign="top">{$poprefdt[0].tDeliveryTerms|stripslashes}</td>
                            </tr>
                            <tr>
                                <td valign="top">{$LBL_SHIP_CONTROL} </td>
                                <td valign="top">:</td>
                                <td class="blue-ore" valign="top">{$poprefdt[0].tShippingControl|stripslashes}</td>
                            </tr>
                            <tr>
                                <td valign="top">{$LBL_COND_PAYMENT} </td>
                                <td valign="top">:</td>
                                <td class="blue-ore" valign="top">{$poprefdt[0].tConditionsForPayment|stripslashes}</td>
                            </tr>
                            <tr>
                                <td valign="top">{$LBL_PENALTIES} </td>
                                <td valign="top">:</td>
                                <td class="blue-ore" valign="top">{$poprefdt[0].tPenalties|stripslashes}</td>
                            </tr>
                            <tr>
                                <td valign="top">{$LBL_SPEC_INSTRUCT} </td>
                                <td valign="top">:</td>
                                <td class="blue-ore" valign="top">{$poprefdt[0].tSpecialInstruction|stripslashes}</td>
                            </tr>
                            <tr>
                                <td valign="top">{$LBL_NOTE} </td>
                                <td valign="top">:</td>
                                <td class="blue-ore" valign="top">{$poprefdt[0].tNote|stripslashes}</td>
                            </tr>
                            {if $permitted eq 'Yes' && $usertype neq 'orgadmin'}
                            <tr>
                                <td valign="top">{$LBL_REASON_TO_REJECT} </td>
                                <td valign="top">:</td>
                                <td><textarea id="tReasonToReject" name="tReasonToReject" cols="70" rows="3"></textarea></td>
                            </tr>
                            {elseif $poData.tReasonToReject|trim neq '' && $poData.eStatus eq $rjtsts}
                            <tr>
                                <td valign="top">{$LBL_REASON_TO_REJECT} </td>
                                <td valign="top">:</td>
                                <td><textarea id="tReasonToReject" name="tReasonToReject" cols="70" rows="3">{$poData.tReasonToReject|trim}</textarea></td>
                            </tr>
                            {/if}
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td valign="bottom" align="center" colspan="3">
                                    <img src="{$SITE_IMAGES}sm_images/btn-back.gif" alt="" id="rst_btn" border="0" style="cursor:pointer; vertical-align:middle;" {if $poData.iInvoiceID gt 0}onclick="location.href='{$SITE_URL_DUM}poacptlist/{$smarty.session.polvl}';"{else}onclick="location.href='{$SITE_URL_DUM}polist/{$smarty.session.polvl}';"{/if} />
                                         {if $permitted eq 'Yes' && $usertype neq 'orgadmin'}
                                         <img src="{$SITE_IMAGES}sm_images/btn-verify.gif" alt="" id="resetbtn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('verify');$('#frmadd').submit();" />
                                        <img src="{$SITE_IMAGES}sm_images/btn-reject.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('reject');$('#frmadd').submit();" />
                                        {/if}
                                        {if $crt_inv eq 'yes'}
                                        <span style="cursor:pointer;" onclick="$('#view').val('crtinv');$('#frmadd').submit();"><img src="{$SITE_IMAGES}createinvoice-btn.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" /></span>
                                        {/if}
                                        {*if $crt_inv eq 'yes'}
                                        &nbsp;<span style="background:url({$SITE_IMAGES}bg.png) repeat; padding:3px; border:1px solid #cccccc;"><span onclick="$('#view').val('crtinv');$('#frmadd').submit();" style="cursor:pointer; color:#256292;"><b>{$LBL_CREATE_INV}</b></span></span>
                                        <!--<img src="{$SITE_IMAGES}bg.png" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" />-->
                                        {/if*}
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