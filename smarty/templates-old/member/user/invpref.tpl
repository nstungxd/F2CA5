<div class="middle-container">
    <h1>{$LBL_CREATE_INVOICE}</h1>
    <div class="middle-containt">
        <div class="statistics-main-box-white">
            <div>
                <ul id="inner-tab">
                    <li><a href="{$SITE_URL_DUM}invoicecreate/{$iInvoiceID}"><em>{$LBL_INV_HEADER}</em></a></li>
                    <li><a class="current" ><em>{$LBL_PREFERENCES}</em></a></li>
                    <li>{if $view eq 'edit'}<a href="{$SITE_URL_DUM}invoiceadditems/{$iInvoiceID}" >{else}<a>{/if}<em>{$LBL_LINE_ITEM}</em></a></li>
                </ul>
            </div>
            <div class="clear"></div>
            <div class="inner-gray-bg">
                <div>&nbsp;</div>
                <div>
                    {if $msg neq ''}
                    <div class="msg">{$msg}</div>
                    {*literal}
                    <script>
                        $(document).ready(function() {
                            var msg='{/literal}{$msg}{literal}';
                            if(msg!= '' && msg != undefined)
                                alert(msg);
                        });
                    </script>
                    {/literal*}
                    {/if}
                    <form name="frmadd" id="frmadd" action="{$SITE_URL}index.php?file=u-invpref_a"  method="post" enctype="multipart/form-data">
                        <input type="hidden" name="iInvoiceID" id="iInvoiceID" value="{$iInvoiceID}" />
                        <input type="hidden" name="iInvID" id="iInvID" value="{$iInvoiceID}" />
                        <input type="hidden" name="view" id="view" value="{$view}" />
                        <input type="hidden" name="eSaved" id="eSaved" value="{$invdtls[0].eSaved}" />
                        <input type="hidden" name="Data[eFrom]" id="eFrom" value="" />
                        <table width="97%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
                            <tr><td colspan="3" align="right"><font size="2" color="red"><b>{$var_msg}</b></font></td></tr>
                            <tr>
                                <td  width="190px" valign="top">{$LBL_SOURCE_DOC} </td>
                                <td valign="top">:</td>
                                <td class="blue-ore" valign="top"><textarea name="Data[tSourcingDocument]" id="tSourcingDocument" cols="100" rows="5">{$ioprefdt[0].tSourcingDocument|stripslashes}</textarea></td>
                            </tr>
                            <tr>
                                <td valign="top">{$LBL_GLOBAL_AGREEMENT} </td>
                                <td valign="top">:</td>
                                <td class="blue-ore"><textarea name="Data[tGlobalAgreement]" id="tGlobalAgreement" cols="100" rows="5">{$ioprefdt[0].tGlobalAgreement|stripslashes}</textarea></td>
                            </tr>
                            <tr>
                                <td valign="top">{$LBL_PAYMENT_TERMS} </td>
                                <td valign="top">:</td>
                                <td class="blue-ore"><textarea name="Data[tPaymentTerms]" id="tPaymentTerms" cols="100" rows="5">{$ioprefdt[0].tPaymentTerms|stripslashes}</textarea></td>
                            </tr>
                            <tr>
                                <td valign="top">{$LBL_FOB} </td>
                                <td valign="top">:</td>
                                <td class="blue-ore"><textarea name="Data[tFOB]" id="tFOB" cols="100" rows="5">{$ioprefdt[0].tFOB|stripslashes}</textarea></td>
                            </tr>
                            <tr>
                                <td valign="top">{$LBL_DELIVERY_TERMS} </td>
                                <td valign="top">:</td>
                                <td class="blue-ore"><textarea name="Data[tDeliveryTerms]" id="tDeliveryTerms" cols="100" rows="5">{$ioprefdt[0].tDeliveryTerms|stripslashes}</textarea></td>
                            </tr>
                            <tr>
                                <td valign="top">{$LBL_SHIP_CONTROL} </td>
                                <td valign="top">:</td>
                                <td class="blue-ore"><textarea name="Data[tShippingControl]" id="tShippingControl" cols="100" rows="5">{$ioprefdt[0].tShippingControl|stripslashes}</textarea></td>
                            </tr>
                            <tr>
                                <td valign="top">{$LBL_COND_PAYMENT} </td>
                                <td valign="top">:</td>
                                <td class="blue-ore"><textarea name="Data[tConditionsForPayment]" id="tConditionsForPayment" cols="100" rows="5">{$ioprefdt[0].tConditionsForPayment|stripslashes}</textarea></td>
                            </tr>
                            <tr>
                                <td valign="top">{$LBL_PENALTIES} </td>
                                <td valign="top">:</td>
                                <td class="blue-ore"><textarea name="Data[tPenalties]" id="tPenalties" cols="100" rows="5">{$ioprefdt[0].tPenalties|stripslashes}</textarea></td>
                            </tr>
                            <tr>
                                <td valign="top">{$LBL_SPEC_INSTRUCT} </td>
                                <td valign="top">:</td>
                                <td class="blue-ore"><textarea name="Data[tSpecialInstruction]" id="tSpecialInstruction" cols="100" rows="5">{$ioprefdt[0].tSpecialInstruction|stripslashes}</textarea></td>
                            </tr>
                            <tr>
                                <td valign="top">{$LBL_NOTE} </td>
                                <td valign="top">:</td>
                                <td class="blue-ore"><textarea name="Data[tNote]" id="tNote" cols="100" rows="5">{$ioprefdt[0].tNote|stripslashes}</textarea></td>
                            </tr>
                            <tr>
                                <td colspan="2" height="5"></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td colspan="2">
                                    <a href="{$SITE_URL_DUM}invoicecreate/{$iInvoiceID}"><img src="{$SITE_IMAGES}sm_images/btn-back.gif"  alt="" border="0" id="btnBack" name="Back" style="vertical-align:middle;cursor: pointer;" /></a>&nbsp;
                                    {*if $invdtls[0].eSaved eq 'Yes'}
                                    <img src="{$SITE_IMAGES}save-btn.gif" alt="" border="0"  id="btnSubmit" name="Submit" title="submit" src="images/btn-submit.gif" alt="" onclick="$('#eSaved').val('No'); return submitFrm();" style="vertical-align:middle; cursor:pointer;"/>
                                    {else}
                                    <img src="{$SITE_IMAGES}sm_images/btn-next.gif" alt="" border="0"  id="btnSubmit" name="Submit" title="submit" src="images/btn-submit.gif" alt="" onclick="$('#eSaved').val('No'); return submitFrm();" style="vertical-align:middle; cursor:pointer;"/>
                                    {/if*}
                                    <a href="javascript:reset()" ><img src="{$SITE_IMAGES}sm_images/btn-reset.gif" alt="" border="0" style="vertical-align:middle;"/></a>
                                    <img src="{$SITE_IMAGES}sm_images/btn-next.gif" alt="" border="0"  id="btnSubmit" name="Submit" title="submit" src="images/btn-submit.gif" alt="" onclick="$('#eSaved').val('Yes');$('#eFrom').val('Next');  return submitFrm();" style="vertical-align:middle; cursor:pointer;"/>
                                    {*if $invdtls[0].eSaved neq 'Yes'*}
                                    <img src="{$SITE_IMAGES}save-btn.gif" alt="" border="0"  id="btnSubmit" name="Submit" title="submit" src="images/btn-submit.gif" alt="" onclick="$('#eSaved').val('Yes'); return submitFrm();" style="vertical-align:middle; cursor:pointer;"/>
                                    {*/if*}
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div>&nbsp;</div>
            </div>
        </div>
    </div>
    <span id="spn" style="display:hidden;"></span>
    <span id="vldms" style="display:none;"></span>
</div>

{literal}
<script type="text/javascript">
    var corg = '{/literal}{$curORGID}{literal}';
    var sid = '{/literal}{$sid}{literal}';
    var view = '{/literal}{$view}{literal}';
    function submitFrm() {
        $('#frmadd').submit();
    }
    function reset(){
        $("#frmadd")[0].reset();
    }
</script>
{/literal}

{if $vldmsg neq ''}
{literal}
<script type="text/javascript">
    $(document).ready(function() {
        var vldmsg = '{/literal}{$vldmsg}{literal}';
        if(vldmsg!= '' && vldmsg != undefined && $('#vldms').attr('innerHTML')!=vldmsg) {
            alert(vldmsg);
            $('#vldms').attr('innerHTML',vldmsg);
        }
    });
</script>
{/literal}
{/if}

{if $mmsg neq ''}
{literal}
<script type="text/javascript">
    $(document).ready(function() {
        var mmsg='{/literal}{$mmsg}{literal}';
        if(mmsg!= '' && mmsg != undefined)
            alert(mmsg);
    });
</script>
{/literal}
{/if}