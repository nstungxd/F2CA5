<script type="text/javascript" src="{$S_JQUERY}jquery.validate.js"></script>
<script language="JavaScript" src="{$S_JQUERY}jquery.autocomplete.js"></script>
<link type="text/css" rel="stylesheet" media="screen" href="{$SITE_CSS}jquery.autocomplete.css" />
<div class="middle-container">
    <h1>{$LBL_CREATE_INVOICE_ITEM}</h1>
    <div class="middle-containt">
        <div class="statistics-main-box-white">
            <div>
                <ul id="inner-tab">
                    <li><a href="{$SITE_URL_DUM}invoicecreate/{$invid}"><em>{$LBL_CREATE_INVOICE}</em></a></li>
                    <li><a href="{$SITE_URL_DUM}invpref/{$invid}"><em>{$LBL_PREFERENCES}</em></a></li>
                    <li><a href="{$SITE_URL_DUM}invoiceadditems/{$invid}" class="current"><em>{$LBL_ADD_ITEM}</em></a></li>
                </ul>
            </div>
            <div class="clear"></div>
            <div class="inner-gray-bg" style="height:910px;">
                <div>&nbsp;</div>
                <div id="oldv">
                    {if $msg neq ''}
                    {*<div class="msg">{$msg}</div>*}
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
                    <form name="frmadd" id="frmadd" action="{$SITE_URL}index.php?file=u-invoiceadditems_a"  method="post">
                        <input type="hidden" name="iInvoiceID" id="iInvoiceID" value="{$invid}" />
                        <input type="hidden" name="iSupplierOrganizationID" id="iSupplierOrganizationID" value="{$curORGID}" />
                        <input type="hidden" name="view" id="view" value="{$view}" />
                        <input type="hidden" name="eSaved" id="eSaved" value="{$invdtls[0].eSaved}" />
                        <input type="hidden" value="0" id="mdiv" />
                        <table width="100%" border="0" cellspacing="0" class="black" cellpadding="0">
                            {section name="i" loop=$invitems}
                            <tr>
                                <td>
                                    <div id="Div{$smarty.section.i.index}">
                                        <table id="tbl{$smarty.section.i.index}" width="100%" border="0" cellspacing="5" cellpadding="0">
                                            {*}<tr>
                                                <td width="108">{$LBL_PURCHASE_ORDER} : </td>
                                                <td width="281">
                                                    <input type="text" name="purchaseOrder" class="input-rag" id="purchaseOrder0{$smarty.section.i.index}" title="{$LBL_ENTER} {$LBL_PURCHASE_ORDER}" style="width:117px;" value="{$invitems[i].vPOCode}" />
                                                    <input type="hidden" name="iPurchaseOrderID[]" id="iPurchaseOrderID" class="input-rag" style="width:117px;" title="{$LBL_ENTER} {$LBL_PURCHASE_ORDER}" value="{$invitems[i].iPurchaseOrderID}"/>
                                                </td>
                                                <td width="122">{$LBL_PO_REL_LINE} : </td>
                                                <td>
                                                    <input type="text" name="POItemCode" class="input-rag" id="POItemCode0{$smarty.section.i.index}" title="{$LBL_ENTER} {$LBL_PO_REL_LINE}" style="width:117px;" value="{$invitems[i].vPOItemCode}" />
                                                    <input type="hidden" name="iRelatedPurchaseOrderLineID[]" id="iRelatedPurchaseOrderLineID" class="input-rag" style="width:117px;" title="{$LBL_ENTER} {$LBL_PO_REL_LINE}" value="{$invitems[i].iRelatedPurchaseOrderLineID}"/>
                                                </td>
                                            </tr>{*}
                                            {if $invitems[i].eInvoiceType eq 'Discount'}
                                            <tr>
                                                <td width="108">{$LBL_LINE_TYPE} : &nbsp;<font class="reqmsg">*</font></td>
                                                <td width="319">
                                                    <span id="invtype">{*$invoiceTypes*}
                                                        <select name="invoiceType[]" id="eInvoiceType{$smarty.section.i.index}" class="required" >
                                                            {section name="l" loop=$invoiceTypes}
                                                            <option value="{$invoiceTypes[l]}" {if $invoiceTypes[l] eq $invitems[i].eInvoiceType}selected="selected"{/if}>{$invoiceTypes[l]}</option>
                                                            {/section}
                                                        </select>
                                                    </span>
                                                </td>
                                                <!--<td width="122">{*}{$LBL_ITEM_CODE} : &nbsp;<font class="reqmsg">*</font>{*}{$LBL_CURRENCY} : &nbsp;</td>
                                                <td>
                                                    <b>{$invdtls[0].vCurrency}</b>
                                                    <input type="hidden" name="itemCode[]" id="vItemCode{$smarty.section.i.index}" class="input-rag required" style="width:188px;" title="{$LBL_ENTER} {$LBL_ITEM_CODE}" value="{$invitems[i].vItemCode}" readonly="readonly" />
                                                </td>-->
                                                <td width="122">{$LBL_PART_NO} : </td>
                                                <td>
                                                    <b>{$invdtls[0].vPartNo}</b>
                                                    <input type="text" name="vPartNo[]" id="vPartNo{$smarty.section.i.index}" class="input-rag" style="width:188px;" title="{$LBL_ENTER} {$LBL_PART_NO}" value="{$invitems[i].vPartNo}" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign="top">{$LBL_DESCRIPTION} : </td>
                                                <td><textarea name="tDescription[]" id="tDescription{$smarty.section.i.index}" class="input-rag" style="width:188px; height: 73px;" >{$invitems[i].tDescription|stripslashes}</textarea></td>
                                                <td valign="top"><span class="ndcf">{$LBL_UNIT_MEASURE} :&nbsp;<font class="reqmsg"></font></span></td>
                                                <td valign="top" class="uoms">
                                                    {*<input type="text" name="vUnitOfMeasure[]" id="vUnitOfMeasure{$smarty.section.i.index}" class="input-rag required" style="width:188px;" title="{$LBL_ENTER} {$LBL_UNIT_MEASURE}" value="{$poitems[i].vUnitOfMeasure}" />*}
                                                    <select name="vUnitOfMeasure[]" id="vUnitOfMeasure{$smarty.section.i.index}" class="" style="width:190px;" title="{$LBL_ENTER} {$LBL_UNIT_MEASURE}">
                                                        {*<option value="">{$LBL_SELECT} {$LBL_UNIT_MEASURE}</option>*}
                                                        {section name="l" loop=$uom}
                                                        <option value="{$uom[l].vUnitOfMeasure}" {if $poitems[i].vUnitOfMeasure eq $uom[l].vUnitOfMeasure}selected="selected"{/if}>{$uom[l].vUnitOfMeasure}</option>
                                                        {/section}
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">
                                                    <table width="100%" border="0">
                                                        <tr>
                                                            <td style="display:none;"><span class="ndcf">{$LBL_QUANTITY} : &nbsp;<font class="reqmsg">*</font></span></td>
                                                            <td style="display:none;"><input type="text" name="iQuantity[]" id="iQuantity{$smarty.section.i.index}" class="input-rag required digits" style="width:117px;" title="{$LBL_ENTER} {$LBL_QUANTITY}" value="{$invitems[i].iQuantity}" /></td>
                                                            <td width="12.5%"><span class="dcr">{$LBL_RATE} : &nbsp;<font class="reqmsg">*</font></span></td>
                                                            <td width="149"><input type="text" name="fPrice[]" id="fPrice{$smarty.section.i.index}" class="input-rag required decimals" style="width:117px;" title="{$LBL_ENTER} {$LBL_PRICE}" value="{$invitems[i].fPrice|formatMoney:true}" /></td>
                                                            <td><span class="ndcf">{$LBL_AMOUNT} : &nbsp;<font class="reqmsg">*</font></span></td>
                                                            <td><input type="text" name="fAmount[]" id="fAmount{$smarty.section.i.index}" class="input-rag required decimals" style="width:117px;" title="{$LBL_ENTER} {$LBL_AMOUNT}" value="{$invitems[i].fAmount|formatMoney:true}" readonly="readonly" /></td>
                                                        </tr>
                                                        <tr>
                                                            {if $invitems[i].iInvoiceLineID < 1}
                                                            {assign var='fVAT' value=$cntrydt[0].fVat}
                                                            {assign var='fOtherTax' value=$cntrydt[0].fOtherTax}
                                                            {assign var='fWithHoldingTax' value=$cntrydt[0].fwhTax}
                                                            {else}
                                                            {assign var='fVAT' value=$invitems[i].fVAT}
                                                            {assign var='fOtherTax' value=$invitems[i].fOtherTax1}
                                                            {assign var='fWithHoldingTax' value=$invitems[i].fWithHoldingTax}
                                                            {/if}
                                                            <td><span class="ndcf">{$LBL_VAT} {$LBL_RATE} (%): &nbsp;<font class="reqmsg">*</font></span></td>
                                                            <td><input type="text" name="fVAT[]" id="fVAT{$smarty.section.i.index}" class="input-rag required decimals" style="width:117px;" title="{$LBL_ENTER} {$LBL_VAT}" value="{$fVAT}" /></td>
                                                            <td><span class="ndcf">{$LBL_VAT} : &nbsp;<font class="reqmsg">*</font></span></td>
                                                            {assign var="vat" value=`$invitems[i].fAmount*$fVAT/100`}
                                                            <td><input type="text" name="vat[]" id="vat{$smarty.section.i.index}" class="input-rag" style="width:117px;" title="{$LBL_VAT}" value="{$vat|formatMoney:true}" readonly='readonly' /></td>
                                                            <td><span class="ndcf">{$LBL_OTHER_TAX} {$LBL_RATE} (%): </span></td>
                                                            <td><input type="text" name="fOtherTax1[]" id="fOtherTax1{$smarty.section.i.index}" class="input-rag decimals" style="width:117px;" value="{$fOtherTax}" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td><span class="ndcf">{$LBL_OTHER_TAX} : </span></td>
                                                            {assign var="otax" value=`$invitems[i].fAmount*$fOtherTax/100`}
                                                            <td><input type="text" name="othertax1[]" id="othertax1{$smarty.section.i.index}" class="input-rag decimals" style="width:117px;" value="{$otax|formatMoney:true}" readonly='readonly' /></td>
                                                            <td><span class="ndcf">{$LBL_WITH_HOLDING_TAX} {$LBL_RATE} (%): </span></td>
                                                            <td><input type="text" name="fWithHoldingTax[]" id="fWithHoldingTax{$smarty.section.i.index}" class="input-rag decimals" style="width:117px;" title="{$LBL_ENTER} {$LBL_WITH_HOLDING_TAX}" value="{$invitems[i].fWithHoldingTax}" /></td>
                                                            <td><span class="ndcf">{$LBL_WITH_HOLDING_TAX} : </span></td>
                                                            {assign var="wtax" value=`$invitems[i].fAmount*$fWithHoldingTax/100`}
                                                            <td><input type="text" name="withholdingtax" id="withholdingtax{$smarty.section.i.index}" class="input-rag decimals" style="width:117px;" title="{$LBL_ENTER} {$LBL_WITH_HOLDING_TAX}" value="{$wtax|formatMoney:true}" readonly='readonly' /></td>
                                                        </tr>
                                                        <tr>
                                                            <td><span class="ndcf">{$LBL_LINE_TOTAL} : </span></td>
                                                            <td><input type="text" name="fLineTotal[]" id="fLineTotal{$smarty.section.i.index}" class="input-rag decimals" style="width:117px;" value="{$invitems[i].fLineTotal|formatMoney:true}" readonly="readonly" /></td>
                                                            <td><span class="ndcf">{$LBL_RECEIPT} : </span></td>
                                                            <td><input type="text" name="tReceipt[]" id="tReceipt{$smarty.section.i.index}" class="input-rag" style="width:117px;" value="{$invitems[i].tReceipt}" /></td>
                                                            <td>{*}{$LBL_ITEM_CODE} : &nbsp;<font class="reqmsg">*</font>{*}{$LBL_CURRENCY} : &nbsp;</td>
                                                            <td>
                                                                <b>{$invdtls[i].vCurrency}</b>
                                                                <input type="hidden" name="itemCode[]" id="vItemCode{$smarty.section.i.index}" class="input-rag required" style="width:188px;" title="{$LBL_ENTER} {$LBL_ITEM_CODE}" value="{$invitems[i].vItemCode}" readonly="readonly" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="6" align='right'>
                                                                <img src='{$SITE_IMAGES}sm_images/btn-close.gif' name='close' value='close' onclick="$('#adb').hide(); closeRow('{$smarty.section.i.index}')" />{*} &nbsp;
                                                                <img src='{$SITE_IMAGES}sm_images/btn-remove.gif' name='remove' value='remove' onclick="removeRow('Div{$smarty.section.i.index}')" />{*}
                                                            </td>
                                                        </tr>
                                                        <tr><td colspan="3">&nbsp;</td></tr>
                                                        <tr>
                                                            <td colspan="2"><span class="ndcf"><b>{$LBL_DISCOUNT} / {$LBL_CHARGE} :- </b> &nbsp; <select id="eSublineType{$smarty.section.i.index}" name="eSublineType[]"><option value="">None</option><option value="Discount" {if $invitems[i].eSublineType eq 'Discount'}selected="selected"{/if} >Discount</option><option value="Charge" {if $invitems[i].eSublineType eq 'Charge'}selected="selected"{/if}>Charge</option></select></span></td>
                                                            <td colspan="4">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td><span class="ndcf">{$LBL_QUANTITY} : </span></td>
                                                            <td><input type="text" name="iSubQuantity[]" id="iSubQuantity{$smarty.section.i.index}" class="input-rag decimals" style="width:117px;" value="0" /></td>
                                                            <td><span class="ndcf">{$LBL_RATE} : </span></td>
                                                            <td><input type="text" name="fSubRate[]" id="fSubRate{$smarty.section.i.index}" class="input-rag" style="width:117px;" value="0" /></td>
                                                            <td colspan="2"><input type="hidden" name="fSubAmount[]" id="fSubAmount{$smarty.section.i.index}" class="input-rag" style="width:117px;" value="0" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="6" align='right'>
                                                                <img src='{$SITE_IMAGES}sm_images/btn-close.gif' name='close' value='close' onclick="$('#adb').hide(); closeRow('{$smarty.section.i.index}')" />{*} &nbsp;
                                                                <img src='{$SITE_IMAGES}sm_images/btn-remove.gif' name='remove' value='remove' onclick="removeRow('Div{$smarty.section.i.index}')" />{*}
                                                            </td>
                                                        </tr>
                                                        <tr><td>&nbsp;</td></tr>
                                                        <tr>
                                                            <td colspan="6"><hr style="border-style: dashed;"/></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            {elseif $invitems[i].eInvoiceType eq 'Charge'}
                            <tr>
                                <td width="108">{$LBL_LINE_TYPE} : &nbsp;<font class="reqmsg">*</font></td>
                                <td width="319">
                                    <span id="invtype">{*$invoiceTypes*}
                                        <select name="invoiceType[]" id="eInvoiceType{$smarty.section.i.index}" class="required" >
                                            {section name="l" loop=$invoiceTypes}
                                            <option value="{$invoiceTypes[l]}" {if $invoiceTypes[l] eq $invitems[i].eInvoiceType}selected="selected"{/if}>{$invoiceTypes[l]}</option>
                                            {/section}
                                        </select>
                                    </span>
                                </td>
                                <!--<td width="122">{*}{$LBL_ITEM_CODE} : &nbsp;<font class="reqmsg">*</font>{*}{$LBL_CURRENCY} : &nbsp;</td>
                                <td>
                                    <b>{$invdtls[0].vCurrency}</b>
                                    <input type="hidden" name="itemCode[]" id="vItemCode{$smarty.section.i.index}" class="input-rag required" style="width:188px;" title="{$LBL_ENTER} {$LBL_ITEM_CODE}" value="{$invitems[i].vItemCode}" readonly="readonly" />
                                </td>-->
                                <td width="122">{$LBL_PART_NO} : </td>
                                <td>
                                    <b>{$invdtls[0].vPartNo}</b>
                                    <input type="text" name="vPartNo[]" id="vPartNo{$smarty.section.i.index}" class="input-rag" style="width:188px;" title="{$LBL_ENTER} {$LBL_PART_NO}" value="{$invitems[i].vPartNo}" />
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">{$LBL_DESCRIPTION} : </td>
                                <td><textarea name="tDescription[]" id="tDescription{$smarty.section.i.index}" class="input-rag" style="width:188px; height: 73px;" >{$invitems[i].tDescription|stripslashes}</textarea></td>
                                <td valign="top"><span class="ndcf">{$LBL_UNIT_MEASURE} :&nbsp;<font class="reqmsg"></font></span></td>
                                <td valign="top" class="uoms">
                                    {*<input type="text" name="vUnitOfMeasure[]" id="vUnitOfMeasure{$smarty.section.i.index}" class="input-rag required" style="width:188px;" title="{$LBL_ENTER} {$LBL_UNIT_MEASURE}" value="{$poitems[i].vUnitOfMeasure}" />*}
                                    <select name="vUnitOfMeasure[]" id="vUnitOfMeasure{$smarty.section.i.index}" class="" style="width:190px;" title="{$LBL_ENTER} {$LBL_UNIT_MEASURE}">
                                        {*<option value="">{$LBL_SELECT} {$LBL_UNIT_MEASURE}</option>*}
                                        {section name="l" loop=$uom}
                                        <option value="{$uom[l].vUnitOfMeasure}" {if $poitems[i].vUnitOfMeasure eq $uom[l].vUnitOfMeasure}selected="selected"{/if}>{$uom[l].vUnitOfMeasure}</option>
                                        {/section}
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <table width="100%" border="0">
                                        <tr>
                                            <td style="display:none;"><span class="ndcf">{$LBL_QUANTITY} : &nbsp;<font class="reqmsg">*</font></span></td>
                                            <td style="display:none;"><input type="text" name="iQuantity[]" id="iQuantity{$smarty.section.i.index}" class="input-rag required digits" style="width:117px;" title="{$LBL_ENTER} {$LBL_QUANTITY}" value="{$invitems[i].iQuantity}" /></td>
                                            <td width="12.5%"><span class="dcr">{$LBL_RATE} : &nbsp;<font class="reqmsg">*</font></span></td>
                                            <td width="149"><input type="text" name="fPrice[]" id="fPrice{$smarty.section.i.index}" class="input-rag required decimals" style="width:117px;" title="{$LBL_ENTER} {$LBL_PRICE}" value="{$invitems[i].fPrice|formatMoney:true}" /></td>
                                            <td><span class="ndcf">{$LBL_AMOUNT} : &nbsp;<font class="reqmsg">*</font></span></td>
                                            <td><input type="text" name="fAmount[]" id="fAmount{$smarty.section.i.index}" class="input-rag required decimals" style="width:117px;" title="{$LBL_ENTER} {$LBL_AMOUNT}" value="{$invitems[i].fAmount|formatMoney:true}" readonly="readonly" /></td>
                                        </tr>
                                        <tr>
                                            {if $invitems[i].iInvoiceLineID < 1}
                                            {assign var='fVAT' value=$cntrydt[0].fVat}
                                            {assign var='fOtherTax' value=$cntrydt[0].fOtherTax}
                                            {assign var='fWithHoldingTax' value=$cntrydt[0].fwhTax}
                                            {else}
                                            {assign var='fVAT' value=$invitems[i].fVAT}
                                            {assign var='fOtherTax' value=$invitems[i].fOtherTax1}
                                            {assign var='fWithHoldingTax' value=$invitems[i].fWithHoldingTax}
                                            {/if}
                                            <td><span class="ndcf">{$LBL_VAT} {$LBL_RATE} (%): &nbsp;<font class="reqmsg">*</font></span></td>
                                            <td><input type="text" name="fVAT[]" id="fVAT{$smarty.section.i.index}" class="input-rag required decimals" style="width:117px;" title="{$LBL_ENTER} {$LBL_VAT}" value="{$fVAT}" /></td>
                                            <td><span class="ndcf">{$LBL_VAT} : &nbsp;<font class="reqmsg">*</font></span></td>
                                            {assign var="vat" value=`$invitems[i].fAmount*$fVAT/100`}
                                            <td><input type="text" name="vat[]" id="vat{$smarty.section.i.index}" class="input-rag" style="width:117px;" title="{$LBL_VAT}" value="{$vat|formatMoney:true}" readonly='readonly' /></td>
                                            <td><span class="ndcf">{$LBL_OTHER_TAX} {$LBL_RATE} (%): </span></td>
                                            <td><input type="text" name="fOtherTax1[]" id="fOtherTax1{$smarty.section.i.index}" class="input-rag decimals" style="width:117px;" value="{$fOtherTax}" /></td>
                                        </tr>
                                        <tr>
                                            <td><span class="ndcf">{$LBL_OTHER_TAX} : </span></td>
                                            {assign var="otax" value=`$invitems[i].fAmount*$fOtherTax/100`}
                                            <td><input type="text" name="othertax1[]" id="othertax1{$smarty.section.i.index}" class="input-rag decimals" style="width:117px;" value="{$otax|formatMoney:true}" readonly='readonly' /></td>
                                            <td><span class="ndcf">{$LBL_WITH_HOLDING_TAX} {$LBL_RATE} (%): </span></td>
                                            <td><input type="text" name="fWithHoldingTax[]" id="fWithHoldingTax{$smarty.section.i.index}" class="input-rag decimals" style="width:117px;" title="{$LBL_ENTER} {$LBL_WITH_HOLDING_TAX}" value="{$invitems[i].fWithHoldingTax}" /></td>
                                            <td><span class="ndcf">{$LBL_WITH_HOLDING_TAX} : </span></td>
                                            {assign var="wtax" value=`$invitems[i].fAmount*$fWithHoldingTax/100`}
                                            <td><input type="text" name="withholdingtax" id="withholdingtax{$smarty.section.i.index}" class="input-rag decimals" style="width:117px;" title="{$LBL_ENTER} {$LBL_WITH_HOLDING_TAX}" value="{$wtax|formatMoney:true}" readonly='readonly' /></td>
                                        </tr>
                                        <tr>
                                            <td><span class="ndcf">{$LBL_LINE_TOTAL} : </span></td>
                                            <td><input type="text" name="fLineTotal[]" id="fLineTotal{$smarty.section.i.index}" class="input-rag decimals" style="width:117px;" value="{$invitems[i].fLineTotal|formatMoney:true}" readonly="readonly" /></td>
                                            <td><span class="ndcf">{$LBL_RECEIPT} : </span></td>
                                            <td><input type="text" name="tReceipt[]" id="tReceipt{$smarty.section.i.index}" class="input-rag" style="width:117px;" value="{$invitems[i].tReceipt}" /></td>
                                            <td>{*}{$LBL_ITEM_CODE} : &nbsp;<font class="reqmsg">*</font>{*}{$LBL_CURRENCY} : &nbsp;</td>
                                            <td>
                                                <b>{$invdtls[i].vCurrency}</b>
                                                <input type="hidden" name="itemCode[]" id="vItemCode{$smarty.section.i.index}" class="input-rag required" style="width:188px;" title="{$LBL_ENTER} {$LBL_ITEM_CODE}" value="{$invitems[i].vItemCode}" readonly="readonly" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" align='right'>
                                                <img src='{$SITE_IMAGES}sm_images/btn-close.gif' name='close' value='close' onclick="$('#adb').hide(); closeRow('{$smarty.section.i.index}')" />{*} &nbsp;
                                                <img src='{$SITE_IMAGES}sm_images/btn-remove.gif' name='remove' value='remove' onclick="removeRow('Div{$smarty.section.i.index}')" />{*}
                                            </td>
                                        </tr>
                                        <tr><td colspan="3">&nbsp;</td></tr>
                                        <tr>
                                            <td colspan="2"><span class="ndcf"><b>{$LBL_DISCOUNT} / {$LBL_CHARGE} :- </b> &nbsp; <select id="eSublineType{$smarty.section.i.index}" name="eSublineType[]"><option value="">None</option><option value="Discount" {if $invitems[i].eSublineType eq 'Discount'}selected="selected"{/if} >Discount</option><option value="Charge" {if $invitems[i].eSublineType eq 'Charge'}selected="selected"{/if}>Charge</option></select></span></td>
                                            <td colspan="4">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td><span class="ndcf">{$LBL_QUANTITY} : </span></td>
                                            <td><input type="text" name="iSubQuantity[]" id="iSubQuantity{$smarty.section.i.index}" class="input-rag decimals" style="width:117px;" value="{$invitems[i].iSubQuantity}" /></td>
                                            <td><span class="ndcf">{$LBL_RATE} : </span></td>
                                            <td><input type="text" name="fSubRate[]" id="fSubRate{$smarty.section.i.index}" class="input-rag" style="width:117px;" value="{$invitems[i].fSubRate}" /></td>
                                            <td colspan="2"><input type="hidden" name="fSubAmount[]" id="fSubAmount{$smarty.section.i.index}" class="input-rag" style="width:117px;" value="{$invitems[i].fSubAmount}" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" align='right'>
                                                <img src='{$SITE_IMAGES}sm_images/btn-close.gif' name='close' value='close' onclick="$('#adb').hide(); closeRow('{$smarty.section.i.index}')" />{*} &nbsp;
                                                <img src='{$SITE_IMAGES}sm_images/btn-remove.gif' name='remove' value='remove' onclick="removeRow('Div{$smarty.section.i.index}')" />{*}
                                            </td>
                                        </tr>
                                        <tr><td>&nbsp;</td></tr>
                                        <tr>
                                            <td colspan="6"><hr style="border-style:dashed;"/></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                </div>
                </td>
                </tr>
                {else}
                <tr>
                    <td width="108">{$LBL_LINE_TYPE} : &nbsp;<font class="reqmsg">*</font></td>
                    <td width="319">
                        <span id="invtype">{*$invoiceTypes*}
                            <select name="invoiceType[]" id="eInvoiceType{$smarty.section.i.index}" class="required" >
                                {section name="l" loop=$invoiceTypes}
                                <option value="{$invoiceTypes[l]}" {if $invoiceTypes[l] eq $invitems[i].eInvoiceType}selected="selected"{/if}>{$invoiceTypes[l]}</option>
                                {/section}
                            </select>
                        </span>
                    </td>
                    <!--<td width="122">{*}{$LBL_ITEM_CODE} : &nbsp;<font class="reqmsg">*</font>{*}{$LBL_CURRENCY} : &nbsp;</td>
                    <td>
                        <b>{$invdtls[0].vCurrency}</b>
                        <input type="hidden" name="itemCode[]" id="vItemCode{$smarty.section.i.index}" class="input-rag required" style="width:188px;" title="{$LBL_ENTER} {$LBL_ITEM_CODE}" value="{$invitems[i].vItemCode}" readonly="readonly" />
                    </td>-->
                    <td width="122">{$LBL_PART_NO} : </td>
                    <td>
                        <b>{$invdtls[0].vPartNo}</b>
                        <input type="text" name="vPartNo[]" id="vPartNo{$smarty.section.i.index}" class="input-rag" style="width:188px;" title="{$LBL_ENTER} {$LBL_PART_NO}" value="{$invitems[i].vPartNo}" />
                    </td>
                </tr>
                <tr>
                    <td valign="top">{$LBL_DESCRIPTION} : </td>
                    <td><textarea name="tDescription[]" id="tDescription{$smarty.section.i.index}" class="input-rag" style="width:188px; height: 73px;" >{$invitems[i].tDescription|stripslashes}</textarea></td>
                    <td valign="top"><span class="ndcf">{$LBL_UNIT_MEASURE} :&nbsp;<font class="reqmsg"></font></span></td>
                    <td valign="top" class="uoms">
                        {*<input type="text" name="vUnitOfMeasure[]" id="vUnitOfMeasure{$smarty.section.i.index}" class="input-rag required" style="width:188px;" title="{$LBL_ENTER} {$LBL_UNIT_MEASURE}" value="{$invitems[i].vUnitOfMeasure}" />*}
                        <select name="vUnitOfMeasure[]" id="vUnitOfMeasure{$smarty.section.i.index}" class="" style="width:190px;" title="{$LBL_ENTER} {$LBL_UNIT_MEASURE}">
                            {*<option value="">{$LBL_SELECT} {$LBL_UNIT_MEASURE}</option>*}
                            {section name="l" loop=$uom}
                            <option value="{$uom[l].vUnitOfMeasure}" {if $invitems[i].vUnitOfMeasure eq $uom[l].vUnitOfMeasure}selected="selected"{/if}>{$uom[l].vUnitOfMeasure}</option>
                            {/section}
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <table width="100%" border="0">
                            <tr>
                                <td width="108"><span class="ndcf">{$LBL_QUANTITY} : &nbsp;<font class="reqmsg">*</font></span></td>
                                <td width="154"><input type="text" name="iQuantity[]" id="iQuantity{$smarty.section.i.index}" class="input-rag required digits" style="width:117px;" title="{$LBL_ENTER} {$LBL_QUANTITY}" value="{$invitems[i].iQuantity}" /></td>
                                <td width="111"><span class="dcr">{$LBL_PRICE} : &nbsp;<font class="reqmsg">*</font></span></td>
                                <td width="149"><input type="text" name="fPrice[]" id="fPrice{$smarty.section.i.index}" class="input-rag required decimals" style="width:117px;" title="{$LBL_ENTER} {$LBL_PRICE}" value="{$invitems[i].fPrice|formatMoney:true}" /></td>
                                <td><span class="ndcf">{$LBL_AMOUNT} : &nbsp;<font class="reqmsg">*</font></span></td>
                                <td><input type="text" name="fAmount[]" id="fAmount{$smarty.section.i.index}" class="input-rag required decimals" style="width:117px;" title="{$LBL_ENTER} {$LBL_AMOUNT}" value="{$invitems[i].fAmount|formatMoney:true}" readonly="readonly" /></td>
                            </tr>
                            <tr>
                                {if $invitems[i].iInvoiceLineID < 1}
                                {assign var='fVAT' value=$cntrydt[0].fVat}
                                {assign var='fOtherTax' value=$cntrydt[0].fOtherTax}
                                {assign var='fWithHoldingTax' value=$cntrydt[0].fwhTax}
                                {else}
                                {assign var='fVAT' value=$invitems[i].fVAT}
                                {assign var='fOtherTax' value=$invitems[i].fOtherTax1}
                                {assign var='fWithHoldingTax' value=$invitems[i].fWithHoldingTax}
                                {/if}
                                <td><span class="ndcf">{$LBL_VAT} {$LBL_RATE} (%): &nbsp;<font class="reqmsg">*</font></span></td>
                                <td><input type="text" name="fVAT[]" id="fVAT{$smarty.section.i.index}" class="input-rag required decimals" style="width:117px;" title="{$LBL_ENTER} {$LBL_VAT}" value="{$fVAT}" /></td>
                                <td><span class="ndcf">{$LBL_VAT} : &nbsp;<font class="reqmsg">*</font></span></td>
                                {assign var="vat" value=`$invitems[i].fAmount*$fVAT/100`}
                                <td><input type="text" name="vat[]" id="vat{$smarty.section.i.index}" class="input-rag" style="width:117px;" title="{$LBL_VAT}" value="{$vat|formatMoney:true}" readonly='readonly' /></td>
                                <td><span class="ndcf">{$LBL_OTHER_TAX} {$LBL_RATE} (%): </span></td>
                                <td><input type="text" name="fOtherTax1[]" id="fOtherTax1{$smarty.section.i.index}" class="input-rag decimals" style="width:117px;" value="{$fOtherTax}" /></td>
                            </tr>
                            <tr>
                                <td><span class="ndcf">{$LBL_OTHER_TAX} : </span></td>
                                {assign var="otax" value=`$invitems[i].fAmount*$fOtherTax/100`}
                                <td><input type="text" name="othertax1[]" id="othertax1{$smarty.section.i.index}" class="input-rag decimals" style="width:117px;" value="{$otax|formatMoney:true}" readonly='readonly' /></td>
                                <td><span class="ndcf">{$LBL_WITH_HOLDING_TAX} {$LBL_RATE} (%): </span></td>
                                <td><input type="text" name="fWithHoldingTax[]" id="fWithHoldingTax{$smarty.section.i.index}" class="input-rag decimals" style="width:117px;" title="{$LBL_ENTER} {$LBL_WITH_HOLDING_TAX}" value="{$invitems[i].fWithHoldingTax}" /></td>
                                <td><span class="ndcf">{$LBL_WITH_HOLDING_TAX} : </span></td>
                                {assign var="wtax" value=`$invitems[i].fAmount*$fWithHoldingTax/100`}
                                <td><input type="text" name="withholdingtax" id="withholdingtax{$smarty.section.i.index}" class="input-rag decimals" style="width:117px;" title="{$LBL_ENTER} {$LBL_WITH_HOLDING_TAX}" value="{$wtax|formatMoney:true}" readonly='readonly' /></td>
                            </tr>
                            <tr>
                                <td><span class="ndcf">{$LBL_LINE_TOTAL} : </span></td>
                                <td><input type="text" name="fLineTotal[]" id="fLineTotal{$smarty.section.i.index}" class="input-rag decimals" style="width:117px;" value="{$invitems[i].fLineTotal|formatMoney:true}" readonly="readonly" /></td>
                                <td><span class="ndcf">{$LBL_RECEIPT} : </span></td>
                                <td><input type="text" name="tReceipt[]" id="tReceipt{$smarty.section.i.index}" class="input-rag" style="width:117px;" value="{$invitems[i].tReceipt}" /></td>
                                <td>{*}{$LBL_ITEM_CODE} : &nbsp;<font class="reqmsg">*</font>{*}{$LBL_CURRENCY} : &nbsp;</td>
                                <td>
                                    <b>{$invdtls[i].vCurrency}</b>
                                    <input type="hidden" name="itemCode[]" id="vItemCode{$smarty.section.i.index}" class="input-rag required" style="width:188px;" title="{$LBL_ENTER} {$LBL_ITEM_CODE}" value="{$invitems[i].vItemCode}" readonly="readonly" />
                                </td>
                            </tr>
                            <tr><td colspan="6">&nbsp;</td></tr>
                            <tr>
                                <td colspan="2"><span class="ndcf"><b>{$LBL_DISCOUNT} / {$LBL_CHARGE} :- </b> &nbsp; <select id="eSublineType{$smarty.section.i.index}" name="eSublineType[]"><option value="">None</option><option value="Discount" {if $invitems[i].eSublineType eq 'Discount'}selected="selected"{/if} >Discount</option><option value="Charge" {if $invitems[i].eSublineType eq 'Charge'}selected="selected"{/if}>Charge</option></select></span></td>
                                <td colspan="4">&nbsp;</td>
                            </tr>
                            <tr>
                                <td><span class="ndcf">{$LBL_QUANTITY} : </span></td>
                                <td><input type="text" name="iSubQuantity[]" id="iSubQuantity{$smarty.section.i.index}" class="input-rag decimals" style="width:117px;" value="{if $invitems[i].eSublineType eq ''}0{else}{$invitems[i].iSubQuantity}{/if}" /></td>
                                <td><span class="ndcf">{$LBL_RATE} : </span></td>
                                <td><input type="text" name="fSubRate[]" id="fSubRate{$smarty.section.i.index}" class="input-rag" style="width:117px;" value="{if $invitems[i].eSublineType eq ''}0{else}{$invitems[i].fSubRate}{/if}" /></td>
                                <td colspan="2"><input type="hidden" name="fSubAmount[]" id="fSubAmount{$smarty.section.i.index}" class="input-rag" style="width:117px;" value="{if $invitems[i].eSublineType eq ''}0{else}{$invitems[i].fSubAmount}{/if}" /></td>
                            </tr>
                            <tr>
                                <td colspan="6" align='right'>
                                    <img src='{$SITE_IMAGES}sm_images/btn-close.gif' name='close' value='close' onclick="$('#adb').hide(); closeRow('{$smarty.section.i.index}')" /><!--{*} &nbsp;
                                    <img src='{$SITE_IMAGES}sm_images/btn-remove.gif' name='remove' value='remove' onclick="removeRow('Div{$smarty.section.i.index}')" />{*}-->
                                </td>
                            </tr>
                            <tr><td>&nbsp;</td></tr>
                            <tr>
                                <td colspan="6"><hr style="border-style: dashed;"/></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                </table>
            </div>
            </td>
            </tr>
            {/if}
            {sectionelse}
            <tr>
                <td>
                    <div id="Div0">
                        <table width="100%" border="0" cellspacing="5" cellpadding="0">
                            {*}<tr>
                                <td width="108">{$LBL_PURCHASE_ORDER} : </td>
                                <td width="281">
                                    <input type="text" name="purchaseOrder" class="input-rag" id="purchaseOrder00" title="{$LBL_ENTER} {$LBL_PURCHASE_ORDER}" style="width:117px;" value="{$invitems[i].vPOCode}" />
                                    <input type="hidden" name="iPurchaseOrderID[]" id="iPurchaseOrderID" class="input-rag" style="width:117px;" title="{$LBL_ENTER} {$LBL_PURCHASE_ORDER}" value="{$invitems[i].iPurchaseOrderID}"/>
                                </td>
                                <td width="122">{$LBL_PO_REL_LINE} : </td>
                                <td>
                                    <input type="text" name="POItemCode" class="input-rag" id="POItemCode00" title="{$LBL_ENTER} {$LBL_PO_REL_LINE}" style="width:117px;" value="{$invitems[i].vPOItemCode}" />
                                    <input type="hidden" name="iRelatedPurchaseOrderLineID[]" id="iRelatedPurchaseOrderLineID" class="input-rag" style="width:117px;" title="{$LBL_ENTER} {$LBL_PO_REL_LINE}" value="{$invitems[i].iRelatedPurchaseOrderLineID}"/>
                                </td>
                            </tr>{*}
                            <tr>
                                <td width="108">{$LBL_LINE_TYPE} : &nbsp;<font class="reqmsg">*</font></td>
                                <td width="281">
                                    <span id="invtype">{*$invoiceTypes*}
                                        <select name="invoiceType[]" id="eInvoiceType{$smarty.section.i.index}" class="required" >
                                            {section name="l" loop=$invoiceTypes}
                                            <option value="{$invoiceTypes[l]}" {if $invoiceTypes[l] eq $invitems[i].eInvoiceType}selected="selected"{/if}>{$invoiceTypes[l]}</option>
                                            {/section}
                                        </select>
                                    </span>
                                </td>
                                {*}<td width="122">{$LBL_ITEM_CODE} : &nbsp;<font class="reqmsg">*</font></td>
                                <td>
                                    <input type="text" name="vItemCode[]" id="vItemCode" class="input-rag required" style="width:188px;" title="{$LBL_ENTER} {$LBL_ITEM_CODE}" value="{$invitems[i].vItemCode}" />
                                </td>{*}
                            </tr>
                            <tr>
                                <td valign="top">{$LBL_DESCRIPTION} : </td>
                                <td><textarea name="tDescription[]" id="tDescription{$smarty.section.i.index}" class="input-rag" style="width:188px; height: 73px;"  >{$invitems[i].tDescription|stripslashes}</textarea></td>
                                <td valign="top">{$LBL_UNIT_MEASURE} :&nbsp;<font class="reqmsg"></font></td>
                                <td valign="top" class="uoms">
                                    {*<input type="text" name="vUnitOfMeasure[]" id="vUnitOfMeasure{$smarty.section.i.index}" class="input-rag required" style="width:188px;" title="{$LBL_ENTER} {$LBL_UNIT_MEASURE}" value="{$poitems[i].vUnitOfMeasure}" />*}
                                    <select name="vUnitOfMeasure[]" id="vUnitOfMeasure{$smarty.section.i.index}" class="" style="width:190px;" title="{$LBL_ENTER} {$LBL_UNIT_MEASURE}">
                                        {*<option value="">{$LBL_SELECT} {$LBL_UNIT_MEASURE}</option>*}
                                        {section name="l" loop=$uom}
                                        <option value="{$uom[l].vUnitOfMeasure}" {if $poitems[i].vUnitOfMeasure eq $uom[l].vUnitOfMeasure}selected="selected"{/if}>{$uom[l].vUnitOfMeasure}</option>
                                        {/section}
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <table width="100%" border="0">
                                        <tr>
                                            <td width="108">{$LBL_QUANTITY} : &nbsp;<font class="reqmsg">*</font></td>
                                            <td width="154"><input type="text" name="iQuantity[]" id="iQuantity{$smarty.section.i.index}" class="input-rag required digits" style="width:117px;" title="{$LBL_ENTER} {$LBL_QUANTITY}" value="{$invitems[i].iQuantity}" /></td>
                                            <td width="111">{$LBL_PRICE} : &nbsp;<font class="reqmsg">*</font></td>
                                            <td width="149"><input type="text" name="fPrice[]" id="fPrice{$smarty.section.i.index}" class="input-rag required decimals" style="width:117px;" title="{$LBL_ENTER} {$LBL_PRICE}" value="{$invitems[i].fPrice}" /></td>
                                            <td>{$LBL_AMOUNT} : &nbsp;<font class="reqmsg">*</font></td>
                                            <td><input type="text" name="fAmount[]" id="fAmount{$smarty.section.i.index}" class="input-rag required decimals" style="width:117px;" title="{$LBL_ENTER} {$LBL_AMOUNT}" value="{$invitems[i].fAmount}" readonly='readonly' /></td>
                                        </tr>
                                        <tr>
                                            {if $invitems[i].iInvoiceLineID < 1}
                                            {assign var='fVAT' value=$cntrydt[0].fVat}
                                            {assign var='fOtherTax' value=$cntrydt[0].fOtherTax}
                                            {assign var='fWithHoldingTax' value=$cntrydt[0].fwhTax}
                                            {else}
                                            {assign var='fVAT' value=$invitems[i].fVAT}
                                            {assign var='fOtherTax' value=$invitems[i].fOtherTax1}
                                            {assign var='fWithHoldingTax' value=$invitems[i].fWithHoldingTax}
                                            {/if}
                                            <td>{$LBL_VAT} {$LBL_RATE} (%): &nbsp;<font class="reqmsg">*</font></td>
                                            <td><input type="text" name="fVAT[]" id="fVAT{$smarty.section.i.index}" class="input-rag required decimals" style="width:117px;" title="{$LBL_ENTER} {$LBL_VAT}" value="{$fVAT}" /></td>
                                            <td>{$LBL_VAT} : &nbsp;<font class="reqmsg">*</font></td>
                                            {assign var="vat" value=`$invitems[i].fAmount*$fVAT/100`}
                                            <td><input type="text" name="vat[]" id="vat{$smarty.section.i.index}" class="input-rag" style="width:117px;" title="{$LBL_VAT}" value="{$vat}" readonly='readonly' /></td>
                                            <td>{$LBL_OTHER_TAX} {$LBL_RATE} (%): </td>
                                            <td><input type="text" name="fOtherTax1[]" id="fOtherTax1{$smarty.section.i.index}" class="input-rag decimals" style="width:117px;" value="{$fOtherTax}" /></td>
                                        </tr>
                                        <tr>
                                            <td>{$LBL_OTHER_TAX} : </td>
                                            {assign var="otax" value=`$invitems[i].fAmount*$fOtherTax/100`}
                                            <td><input type="text" name="othertax1[]" id="othertax1{$smarty.section.i.index}" class="input-rag decimals" style="width:117px;" value="{$otax}" readonly='readonly' /></td>
                                            <td>{$LBL_WITH_HOLDING_TAX} {$LBL_RATE} (%): </td>
                                            <td><input type="text" name="fWithHoldingTax[]" id="fWithHoldingTax{$smarty.section.i.index}" class="input-rag decimals" style="width:117px;" title="{$LBL_ENTER} {$LBL_WITH_HOLDING_TAX}" value="{$invitems[i].fWithHoldingTax}" /></td>
                                            <td>{$LBL_WITH_HOLDING_TAX} : </td>
                                            {assign var="wtax" value=`$invitems[i].fAmount*$fWithHoldingTax/100`}
                                            <td><input type="text" name="withholdingtax" id="withholdingtax{$smarty.section.i.index}" class="input-rag decimals" style="width:117px;" title="{$LBL_ENTER} {$LBL_WITH_HOLDING_TAX}" value="{$wtax}" readonly='readonly' /></td>
                                        </tr>
                                        <tr>
                                            <td>{$LBL_LINE_TOTAL} : </td>
                                            <td><input type="text" name="fLineTotal[]" id="fLineTotal{$smarty.section.i.index}" class="input-rag decimals" style="width:117px;" value="{$invitems[i].fLineTotal}" readonly="readonly" /></td>
                                            <td>{$LBL_RECEIPT} : </td>
                                            <td><input type="text" name="tReceipt[]" id="tReceipt{$smarty.section.i.index}" class="input-rag" style="width:117px;" value="{$invitems[i].tReceipt}" /></td>
                                            <td>{*}{$LBL_ITEM_CODE} : &nbsp;<font class="reqmsg">*</font>{*}{$LBL_CURRENCY} : &nbsp;</td>
                                            <td>
                                                <b>{$invdtls[i].vCurrency}</b>
                                                <input type="hidden" name="itemCode[]" id="vItemCode{$smarty.section.i.index}" class="input-rag required" style="width:188px;" title="{$LBL_ENTER} {$LBL_ITEM_CODE}" value="{$invitems[i].vItemCode}" readonly="readonly" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" align='right'>
                                                <img src='{$SITE_IMAGES}sm_images/btn-close.gif' name='close' value='close' onclick="$('#adb').hide(); closeRow('{$smarty.section.i.index}')" />{*} &nbsp;
                                                <img src='{$SITE_IMAGES}sm_images/btn-remove.gif' name='remove' value='remove' onclick="removeRow('Div{$smarty.section.i.index}')" />{*}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6"><hr style="border-style: dashed;" /></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            {/section}
            <tr>
                <td>
                    <table width="100%" border="0" cellspacing="5" cellpadding="0">
                        <tr>
                            <td colspan="6">
                                <div id="addNew">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td align="right">
                                <img id="adb" src="{$SITE_IMAGES}sm_images/add-btn.png" onclick="ad='y'; addRw();" alt="" border="0" /> &nbsp;
                                <img src="{$SITE_IMAGES}sm_images/btn-addnew.gif" onclick="ad='y'; addRow();"  alt="" border="0" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" id="lines" valign="top">
                                <div><b><hr style="height:0px; color:#eeeeee;"/>{$LBL_LINE_ITEMS}<hr style="height:0px; color:#eeeeee;" /></b></div>
                                <div style="height:190px; overflow-y:scroll;">
                                    <b>
                                        <span style="display:inline-block; height:10px; w	idth:6px; padding:1px; margin:0px;">&nbsp;</span>
                                        <!--<span style="display:inline-block; height:10px; width:50px; padding:1px; margin:0px;">{$LBL_LINE_TYPE}</span>-->
                                        <span style="display:inline-block; height:10px; width:120px; padding:1px; margin:0px;">{$LBL_DESCRIPTION}</span>
                                        <span style="display:inline-block; height:10px; width:60px; padding:1px; margin:0px;">{$LBL_PART_NO}</span>
                                        <span style="display:inline-block; height:10px; width:70px; padding:1px; margin:0px;">{*$LBL_UNIT_MEASURE*}UOM</span>
                                        <span style="display:inline-block; height:10px; width:35px; padding:1px; margin:0px; text-align:right;">{*$LBL_QUANTITY*}Qty</span>
                                        <span style="display:inline-block; height:10px; width:75px; padding:1px; margin:0px; text-align:right;">{$LBL_PRICE} / {$LBL_RATE}</span>
                                        <span style="display:inline-block; height:10px; width:125px; padding:1px; margin:0px; text-align:right;">{$LBL_AMOUNT}</span>
                                        <span style="display:inline-block; height:10px; width:70px; padding:1px; margin:0px; text-align:right;">{$LBL_VAT}</span>
                                        <!--<span style="display:inline-block; height:10px; width:75px; padding:1px; margin:0px; text-align:right;">{$LBL_OTHER_TAX}</span>-->
                                        <span style="display:inline-block; height:10px; width:80px; padding:1px; margin:0px; text-align:right;">WH {*$LBL_TAX*}Tax</span>
                                        <span style="display:inline-block; height:10px; width:115px; padding:1px; margin:0px; text-align:right;">{$LBL_LINE_TOTAL}</span>
                                        <span style="display:inline-block; height:10px; padding:1px; margin:0px;">&nbsp;</span>
                                    </b>
                                    <div id="dlines">
                                        {section name="i" loop=$invitems}
                                        {if $invitems[i].eInvoiceType eq 'Discount'}
                                        <div id="spnd{$smarty.section.i.index}">
                                            <span style='display:inline-block; height:10px; width:6px; padding:1px; margin:0px;' class="ar"> <img src='{$SITE_IMAGES}sm_images/arrow-orange.gif' /></span>
                                            <span style='display:inline-block; height:10px; width:50px; padding:1px; margin:0px;display: none;' class="ot">{$invitems[i].eInvoiceType}</span>
                                            <span style='display:inline-block; height:10px; width:117px; padding:1px; margin:0px;' class="td">{$invitems[i].tDescription|stripslashes}</span>
                                            <span style='display:inline-block; height:10px; width:60px; padding:1px; margin:0px;' class="um">{$invitems[i].vPartNo}</span>
                                            <span style='display:inline-block; height:10px; width:70px; padding:1px; margin:0px;' class="um">{*$invitems[i].vUnitOfMeasure*}</span>
                                            <span style='display:inline-block; height:10px; width:35px; padding:1px; margin:0px; text-align:right;' class="iq">{*$invitems[i].iQuantity*}</span>
                                            <span style='display:inline-block; height:10px; width:84px; padding:1px; margin:0px; text-align:right;' class="fp">{$invitems[i].fPrice|formatMoney:true}</span>
                                            <span style='display:inline-block; height:10px; width:115px; padding:1px; margin:0px; text-align:right;' class="fa">{$invitems[i].fAmount|formatMoney:true}</span>
                                            <span style='display:inline-block; height:10px; width:70px; padding:1px; margin:0px; text-align:right;' class="fv">{*assign var="vt" value=`$invitems[i].fVAT*$invitems[i].fAmount/100`}{$vt|formatMoney:true*}</span>
                                            <span style='display:inline-block; height:10px; width:50px; padding:1px; margin:0px; text-align:right;display: none;' class="ox">{*assign var="ot" value=`$invitems[i].fOtherTax1*$invitems[i].fAmount/100`}{$ot|formatMoney:true*}</span>
                                            <span style='display:inline-block; height:10px; width:82px; padding:1px; margin:0px; text-align:right;' class="wt">{*assign var="wt" value=`$invitems[i].fWithHoldingTax*$invitems[i].fAmount/100`}{$wt|formatMoney:true*}</span>
                                            <span style='display:inline-block; height:10px; width:115px; padding:1px; margin:0px; text-align:right;' class="lt">{$invitems[i].fLineTotal|formatMoney:true}</span>
                                            <span style='display:inline-block; height:10px; padding:1px; margin:0px; text-align:right;' class="at">
                                                &nbsp; <img src='{$SITE_IMAGES}sm_images/icon-pen.gif' onclick='edt="y"; shwtbl({$smarty.section.i.index});' />&nbsp;<img src='{$SITE_IMAGES}sm_images/icon-cancel.gif' onclick='deltbl({$smarty.section.i.index});' />
                                            </span>
                                            <div id="subli" style="display:none; padding:3px; padding-left:19px;">
                                                <!--{*<div id="spsli">*}-->
                                                <span style='display:inline-block; height:10px; width:181px; margin:0px; text-align:left;' class="sltyp">{$invitems[i].eSublineType} </span>
                                                <span class="slqt" style="display:inline-block; height:10px; width:119px; margin:0px; text-align:right;"><span class="sqt">{$invitems[i].iSubQuantity}</span></span> &nbsp;&nbsp;&nbsp;
                                                <span class="slrt" style="display:inline-block; height:10px; width:76px; margin:0px; text-align:right;"><span class="srt">{$invitems[i].fSubRate|toFixed}%</span></span> &nbsp;&nbsp;&nbsp;
                                                <!--{*<span class="slrt" style="display:none; height:10px; width:230px; padding-left:570px; margin:0px; text-align:left;"><label style="width:170px; font-weight:bold; display:inline-block;">Amount:</label> &nbsp; 100</span>*}-->
                                                <span class="sltl" style="display:inline-block; height:10px; width:105px; margin:0px; text-align:right;"><span class="stl">{$invitems[i].fSubAmount|toFixed:true}</span></span>
                                                <span class="slvt" style="display:inline-block; height:10px; width:76px; margin:0px; text-align:right;"><span class="slv">{$invitems[i].fSubVat}</span></span>
                                                <span class="slot" style="display:inline-block; height:10px; width:54px; margin:0px; text-align:right;display: none;"><span class="slo">{$invitems[i].fSubOtherTax}</span></span>
                                                <span class="slwt" style="display:inline-block; height:10px; width:86px; margin:0px; text-align:right;"><span class="slw">{$invitems[i].fSubWHTax|number_format:true}</span></span>
                                                <span class="sltt" style="display:inline-block; height:10px; width:118px; margin:0px; text-align:right;"><span class="slf">{$invitems[i].fSubTotal}</span></span>
                                                <!--{*</div>*}-->
                                            </div>
                                        </div>
                                        {elseif $invitems[i].eInvoiceType eq 'Charge'}
                                        <div id="spnd{$smarty.section.i.index}">
                                            <span style='display:inline-block; height:10px; width:6px; padding:1px; margin:0px;' class="ar"> <img src='{$SITE_IMAGES}sm_images/arrow-orange.gif' /></span>
                                            <span style='display:inline-block; height:10px; width:50px; padding:1px; margin:0px;display: none;' class="ot">{$invitems[i].eInvoiceType}</span>
                                            <span style='display:inline-block; height:10px; width:117px; padding:1px; margin:0px;' class="td">{$invitems[i].tDescription|stripslashes}</span>
                                            <span style='display:inline-block; height:10px; width:60px; padding:1px; margin:0px;' class="um">{$invitems[i].vPartNo}</span>
                                            <span style='display:inline-block; height:10px; width:70px; padding:1px; margin:0px;' class="um">{*$invitems[i].vUnitOfMeasure*}</span>
                                            <span style='display:inline-block; height:10px; width:35px; padding:1px; margin:0px; text-align:right;' class="iq">{*$invitems[i].iQuantity*}</span>
                                            <span style='display:inline-block; height:10px; width:84px; padding:1px; margin:0px; text-align:right;' class="fp">{$invitems[i].fPrice|formatMoney:true}</span>
                                            <span style='display:inline-block; height:10px; width:115px; padding:1px; margin:0px; text-align:right;' class="fa">{$invitems[i].fAmount|formatMoney:true}</span>
                                            <span style='display:inline-block; height:10px; width:70px; padding:1px; margin:0px; text-align:right;' class="fv">{*assign var="vt" value=`$invitems[i].fVAT*$invitems[i].fAmount/100`}{$vt|formatMoney:true*}</span>
                                            <span style='display:inline-block; height:10px; width:50px; padding:1px; margin:0px; text-align:right;display: none;' class="ox">{*assign var="ot" value=`$invitems[i].fOtherTax1*$invitems[i].fAmount/100`}{$ot|formatMoney:true*}</span>
                                            <span style='display:inline-block; height:10px; width:82px; padding:1px; margin:0px; text-align:right;' class="wt">{*assign var="wt" value=`$invitems[i].fWithHoldingTax*$invitems[i].fAmount/100`}{$wt|formatMoney:true*}</span>
                                            <span style='display:inline-block; height:10px; width:115px; padding:1px; margin:0px; text-align:right;' class="lt">{$invitems[i].fLineTotal|formatMoney:true}</span>
                                            <span style='display:inline-block; height:10px; padding:1px; margin:0px; text-align:right;' class="at">
                                                &nbsp; <img src='{$SITE_IMAGES}sm_images/icon-pen.gif' onclick='edt="y"; shwtbl({$smarty.section.i.index});' />&nbsp;<img src='{$SITE_IMAGES}sm_images/icon-cancel.gif' onclick='deltbl({$smarty.section.i.index});' />
                                            </span>
                                            <div id="subli" style="display:none; padding:3px; padding-left:19px;">
                                                <!--{*<div id="spsli">*}-->
                                                <span style='display:inline-block; height:10px; width:175px; margin:0px; text-align:left;' class="sltyp">{$invitems[i].eSublineType} </span>
                                                <span class="slqt" style="display:inline-block; height:10px; width:119px; margin:0px; text-align:right;"><span class="sqt">{$invitems[i].iSubQuantity}</span></span> &nbsp;&nbsp;&nbsp;
                                                <span class="slrt" style="display:inline-block; height:10px; width:74px; margin:0px; text-align:right;"><span class="srt">{$invitems[i].fSubRate|toFixed}%</span></span> &nbsp;&nbsp;&nbsp;
                                                <!--{*<span class="slrt" style="display:none; height:10px; width:230px; padding-left:570px; margin:0px; text-align:left;"><label style="width:170px; font-weight:bold; display:inline-block;">Amount:</label> &nbsp; 100</span>*}-->
                                                <span class="sltl" style="display:inline-block; height:10px; width:104px; margin:0px; text-align:right;"><span class="stl">{$invitems[i].fSubAmount|toFixed:true}</span></span>
                                                <span class="slvt" style="display:inline-block; height:10px; width:72px; margin:0px; text-align:right;"><span class="slv">{$invitems[i].fSubVat}</span></span>
                                                <span class="slot" style="display:inline-block; height:10px; width:54px; margin:0px; text-align:right;display: none;"><span class="slo">{$invitems[i].fSubOtherTax}</span></span>
                                                <span class="slwt" style="display:inline-block; height:10px; width:84px; margin:0px; text-align:right;"><span class="slw">{$invitems[i].fSubWHTax}</span></span>
                                                <span class="sltt" style="display:inline-block; height:10px; width:117px; margin:0px; text-align:right;"><span class="slf">{$invitems[i].fSubTotal}</span></span>
                                                <!--{*</div>*}-->
                                            </div>
                                        </div>
                                        {else}
                                        <div id="spnd{$smarty.section.i.index}">
                                            <span style='display:inline-block; height:10px; width:6px; padding:1px; margin:0px;' class="ar"> <img src='{$SITE_IMAGES}sm_images/arrow-orange.gif' /></span>
                                            <span style='display:inline-block; height:10px; width:50px; padding:1px; margin:0px;display:none;' class="ot">{$invitems[i].eInvoiceType}</span>
                                            <span style='display:inline-block; height:10px; width:117px; padding:1px; margin:0px;' class="td">{$invitems[i].tDescription|stripslashes}</span>
                                            <span style='display:inline-block; height:10px; width:60px; padding:1px; margin:0px;' class="um">{$invitems[i].vPartNo}</span>
                                            <span style='display:inline-block; height:10px; width:70px; padding:1px; margin:0px;' class="um">{$invitems[i].vUnitOfMeasure}</span>
                                            <span style='display:inline-block; height:10px; width:35px; padding:1px; margin:0px; text-align:right;' class="iq">{$invitems[i].iQuantity|number_format:false}</span>
                                            <span style='display:inline-block; height:10px; width:74px; padding:1px; margin:0px; text-align:right;' class="fp">{$invitems[i].fPrice|formatMoney:true}</span>
                                            <span style='display:inline-block; height:10px; width:125px; padding:1px; margin:0px; text-align:right;' class="fa">{$invitems[i].fAmount|formatMoney:true}</span>
                                            <span style='display:inline-block; height:10px; width:70px; padding:1px; margin:0px; text-align:right;' class="fv">{assign var="vt" value=`$invitems[i].fVAT*$invitems[i].fAmount/100`}{$vt|formatMoney:true}</span>
                                            <span style='display:inline-block; height:10px; width:50px; padding:1px; margin:0px; text-align:right;display: none;' class="ox">{assign var="ot" value=`$invitems[i].fOtherTax1*$invitems[i].fAmount/100`}{$ot|formatMoney:true}</span>
                                            <span style='display:inline-block; height:10px; width:82px; padding:1px; margin:0px; text-align:right;' class="wt">{assign var="wt" value=`$invitems[i].fWithHoldingTax*$invitems[i].fAmount/100`}{$wt|formatMoney:true}</span>
                                            <span style='display:inline-block; height:10px; width:115px; padding:1px; margin:0px; text-align:right;' class="lt">{$invitems[i].fLineTotal|formatMoney:true}</span>
                                            <span style='display:inline-block; height:10px; padding:1px; margin:0px; text-align:right;' class="at">
                                                &nbsp; <img src='{$SITE_IMAGES}sm_images/icon-pen.gif' onclick='edt="y"; shwtbl({$smarty.section.i.index});' />&nbsp;<img src='{$SITE_IMAGES}sm_images/icon-cancel.gif' onclick='deltbl({$smarty.section.i.index});' />
                                            </span>
                                            <div id="subli" style="display:{if $invitems[i].eSublineType neq 'Discount' && $invitems[i].eSublineType neq 'Charge'}none{/if}; padding:3px; padding-left:12px;">
                                                <!--{*<div id="spsli">*}-->
                                                <span style='display:inline-block; height:10px; width:175px; margin:0px; text-align:left;' class="sltyp">{$invitems[i].eSublineType} </span>
                                                <span class="slqt" style="display:inline-block; height:10px; width:119px; margin:0px; text-align:right;"><span class="sqt">{$invitems[i].iSubQuantity|formatMoney:false}</span></span> &nbsp;&nbsp;&nbsp;
                                                <span class="slrt" style="display:inline-block; height:10px; width:74px; margin:0px; text-align:right;"><span class="srt">{$invitems[i].fSubRate|formatMoney:true}%</span></span> &nbsp;&nbsp;&nbsp;
                                                <!--{*<span class="slrt" style="display:none; height:10px; width:230px; padding-left:570px; margin:0px; text-align:left;"><label style="width:170px; font-weight:bold; display:inline-block;">Amount:</label> &nbsp; 100</span>*}-->
                                                <span class="sltl" style="display:inline-block; height:10px; width:104px; margin:0px; text-align:right;">{*if $invitems[i].eSublineType eq 'Discount'}&#123;{/if*}<span class="stl">{$invitems[i].fSubAmount|toFixed:true}</span>{*if $invitems[i].eSublineType eq 'Discount'}&#125;{/if*}</span>
                                                <span class="slvt" style="display:inline-block; height:10px; width:72px; margin:0px; text-align:right;"><span class="slv">{$invitems[i].fSubVat}</span></span>
                                                <span class="slot" style="display:inline-block; height:10px; width:54px; margin:0px; text-align:right;display: none;"><span class="slo">{$invitems[i].fSubOtherTax}</span></span>
                                                <span class="slwt" style="display:inline-block; height:10px; width:84px; margin:0px; text-align:right;">{*if $invitems[i].eSublineType eq 'Discount'}&#123;{/if*}<span class="slw">{$invitems[i].fSubWHTax}</span>{*if $invitems[i].eSublineType eq 'Discount'}&#125;{/if*}</span>
                                                <span class="sltt" style="display:inline-block; height:10px; width:117px; margin:0px; text-align:right;">{*if $invitems[i].eSublineType eq 'Discount'}&#123;{/if*}<span class="slf">{$invitems[i].fSubTotal}</span>{*if $invitems[i].eSublineType eq 'Discount'}&#125;{/if*}</span>
                                                <!--{*</div>*}-->
                                            </div>
                                        </div>
                                        {/if}
                                        <!--<div>&nbsp;</div>-->
                                        {sectionelse}
                                        <div id="nli" align="center"><br /><b>{$LBL_NO_LINE_ITEMS}</b></div>
                                        {/section}
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr><td colspan="6"><hr style="height:0px; color:#eeeeee;" />&nbsp;</td></tr>

                        <tr><td colspan="6" align="right" style="padding-right:19px; width:90%;"><span style="display:inline-block;width:70%;"><b>{$LBL_SUB_TOTAL}</b></span><span style="display:inline-block;width:19px;"> &nbsp; : &nbsp; </span><span id="subt" style="display:inline-block;width:21%;">0</span><input type="hidden" name="subtotal" id="subtotal" /></td></tr>
                        <tr><td colspan="6" align="right" style="padding-right:19px; width:90%;"><span style="display:inline-block;width:70%;"><b>{$LBL_VAT}</b></span><span style="display:inline-block;width:19px;"> &nbsp; : &nbsp; </span><span id="vatt" style="display:inline-block;width:21%;">0</span><input type="hidden" name="vattotal" id="vattotal" /></td></tr>
                        <tr><td colspan="6" align="right" style="padding-right:19px; width:90%;"><span style="display:inline-block;width:70%;"><b>{$LBL_OTHER_TAX}</b></span><span style="display:inline-block;width:19px;"> &nbsp; : &nbsp; </span><span id="otht" style="display:inline-block;width:21%;">0</span><input type="hidden" name="othertaxtotal" id="othertaxtotal" /></td></tr>
                        <tr><td colspan="6" align="right" style="padding-right:19px; width:90%;"><span style="display:inline-block;width:70%;"><b>{$LBL_WITH_HOLDING_TAX}</b></span><span style="display:inline-block;width:19px;"> &nbsp; : &nbsp; </span><span id="wtht" style="display:inline-block;width:21%;">0</span><input type="hidden" name="whtaxtotal" id="whtaxtotal" /></td></tr>
                        <tr><td colspan="6" align="right" style="padding-right:19px; width:90%;"><span style="display:inline-block;width:70%;"><b>{$LBL_CHARGE}</b></span><span style="display:inline-block;width:19px;"> &nbsp; : &nbsp; </span><span id="chgt" style="display:inline-block;width:21%;">0</span><input type="hidden" name="charge" id="charge" /></td></tr>
						<tr><td colspan="6" align="right" style="padding-right:19px; width:90%;"><span style="display:inline-block;width:70%;"><b>{$LBL_DISCOUNT}</b></span><span style="display:inline-block;width:19px;"> &nbsp; : &nbsp; </span><span id="dist" style="display:inline-block;width:21%;">0</span><input type="hidden" name="discount" id="discount" /></td></tr>
                        <tr><td colspan="6" align="right" style="padding-right:19px; width:90%; border-top:1px solid #9a9a9a;"><span style="display:inline-block;width:70%;"><b>{$LBL_NET_AMOUNT}</b></span><span style="display:inline-block;width:19px;"> &nbsp; : &nbsp; </span><span id="namt" style="display:inline-block;width:21%;font-weight:bold;">0</span><input type="hidden" name="nettotal" id="nettotal" /></td></tr>
                        <tr><td colspan="6"><hr style="height:0px; color:#eeeeee;" />&nbsp;</td></tr>
                        <tr>
                            <td height="35" valign="bottom">&nbsp;</td>
                            <td valign="bottom" colspan="5" align="center">
                                {*if $invdtls[0].eSaved eq 'Yes'}
                                <img src="{$SITE_IMAGES}save-btn.gif" alt="" border="0"  id="btnSubmit" name="Submit" title="submit" onclick="return frmsubmit();" style="vertical-align:middle;cursor: pointer;" />&nbsp;
                                {else}
                                <img src="{$SITE_IMAGES}sm_images/btn-submit.gif" alt="" border="0"  id="btnSubmit" name="Submit" title="submit" onclick="return frmsubmit();" style="vertical-align:middle;cursor: pointer;" />&nbsp;
                                {/if*}
                                <img src="{$SITE_IMAGES}sm_images/btn-back.gif"  alt="" border="0" id="btnBack" name="Back" style="vertical-align:middle;cursor: pointer;" onclick="back();" />&nbsp;
                                <img src="{$SITE_IMAGES}sm_images/btn-reset.gif"  alt=" " border="0" id="btnReset" name="Reset" style="vertical-align:middle;cursor: pointer;" onclick="resetform();return false;" />&nbsp;
                                <img src="{$SITE_IMAGES}save-btn.gif" alt="" border="0"  id="btnSubmit" name="Submit" title="submit" onclick="$('#eSaved').val('Yes'); return frmsubmit();" style="vertical-align:middle;cursor: pointer;" />&nbsp;
                                <img src="{$SITE_IMAGES}sm_images/btn-submit.gif" alt="" border="0"  id="btnSubmit" name="Submit" title="submit" onclick="$('#eSaved').val('No'); return frmsubmit();" style="vertical-align:middle;cursor: pointer;" />&nbsp;
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            </table>
            </form>
        </div>
    </div>
    <div>&nbsp;</div>
</div>
</div>
<span id="spn" style="display:hidden;"></span>
<span id="vldms" style="display:none;"></span>
</div>
{if $invitems|is_array && $invitems|@count>1}
{assign var="cnt" value=$invitems|@count}
{/if}
<script type="text/javascript" src="{$SITE_CONTENT_JS}money_format.js"></script>
{literal}
<script type="text/javascript">
    var sbt = 'n';
    var cnt = '{/literal}{$cnt}{literal}';
    var currency = '{/literal}{$invdtls[0].vCurrency}{literal}';
    var vat = '{/literal}{$cntrydt[0].fVat}{literal}';
    var otax = '{/literal}{$cntrydt[0].fOtherTax}{literal}';
    var wtax = '{/literal}{$cntrydt[0].fwhTax}{literal}';
    var ad = 'n';
    var edt = 'n';

    function closeRow(vl) {
        if(document.getElementById('vUnitOfMeasure'+vl)) {
            // if($("#frmadd").validate().element('#vUnitOfMeasure'+vl)==false || $("#frmadd").validate().element('#fAmount'+vl)==false || $("#frmadd").validate().element('#fLineTotal'+vl)==false) {
            if(!document.getElementById('spnd'+vl)) {
                deltbl(vl);
            } else {
                if($("#frmadd").validate().element('#vUnitOfMeasure'+vl)==false || $("#frmadd").validate().element('#fAmount'+vl)==false || $("#frmadd").validate().element('#fLineTotal'+vl)==false) {
                    //
                } else {
                    $('#Div'+vl).hide();
                }
            }
        }
    }

    function setsublines(idx)
    {
        pr = false;
        if($('#spnd'+idx+' > #subli').length > 0) {
            pr = $('#spnd'+idx+' > #subli');
            if($('.sqt',pr).length > 0) {
                $('.sqt',pr).attr('innerHTML', money_format('%i',$('#iSubQuantity'+idx).val(),'no'));
                // alert($('.srt',pr).length);
            }
        } else {
            return false;
        }
        if($.trim($('#fSubRate'+idx).val()) != '' && !isNaN(parseInt($('#fSubRate'+idx).val(), 10))) {
            var subtype = $.trim($('#eSublineType'+idx).val());
            // alert(subtype);
            if(subtype == '') {
                return false;
            }
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

            if(subtype == 'Charge') {
                var amt1 = (sum * subrate / 100);
                amt = amt1 + ((sum * vat / 100) * subrate / 100) + ((sum * otax / 100) * subrate / 100) - ((sum * whtax / 100) * subrate / 100);
            } else {
                var amt1 = (-(sum * subrate / 100));
                amt = amt1 - ((sum * vat / 100) * subrate / 100) - ((sum * otax / 100) * subrate / 100) + ((sum * whtax / 100) * subrate / 100);
            }
            // amt = amt + ramt;
            // alert(amt);
            // amt = parseFloat(amt,10).toFixed(2);
            if(!isNaN(amt1) && amt1.toString() != 'NaN') {
                if(pr) {
                    // $('.stl', pr).attr('innerHTML', Math.abs(amt1));
                    var stl = Math.abs(amt1);
                    //$('.stl', pr).attr('innerHTML', ((stl > parseInt(stl,10))? stl.toFixed(2) : stl));
                    $('.stl', pr).attr('innerHTML', money_format('%i',stl));
                }
            }
            if(!isNaN(amt) && amt.toString() != 'NaN') {
                $('#fSubAmount'+idx).val(amt);
                if(pr) {
                    // $('.slf',pr).attr('innerHTML', Math.abs(amt));
                    var slf = Math.abs(amt);
                    //$('.slf',pr).attr('innerHTML', ((slf > parseInt(slf,10))? slf.toFixed(2) : slf));
                    $('.slf',pr).attr('innerHTML', money_format('%i',slf));
                }
            }
            var slv = ((sum * vat / 100) * subrate / 100);
            //slv = (slv > parseInt(slv,10))? slv.toFixed(2) : slv;
            slv = money_format('%i',slv);
            $('.slv',pr).attr('innerHTML', slv);
            var slo = ((sum * otax / 100) * subrate / 100);
            //slo = (slo > parseInt(slo,10))? slo.toFixed(2) : slo;
            slo = slo.toFixed(2);
            $('.slo',pr).attr('innerHTML', slo);
            var slw = ((sum * whtax / 100) * subrate / 100);
            //slw = (slw > parseInt(slw,10))? slw.toFixed(2) : slw;
            slw = slw.toFixed(2);
            $('.slw',pr).attr('innerHTML', slw);
            // $('#fPrice'+idx).trigger('blur');
        }
    }

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
            $('#subt').attr('innerHTML', 0);
            $('#dist').attr('innerHTML', 0);
            $('#chgt').attr('innerHTML', 0);
            $('#vatt').attr('innerHTML', 0);
            $('#otht').attr('innerHTML', 0);
            $('#wtht').attr('innerHTML', 0);
            $('#namt').attr('innerHTML', 0);
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
        $.each($('#dlines > div[id^="spnd"]'), function(i, el)
        {
            setsublines($(this).attr('id').replace('spnd',''));
            if($.trim($(this).find('.ot').attr('innerHTML')) == 'Discount') {
                // dist = dist + parseFloat($(this).find('.fa').attr('innerHTML').replace(new RegExp(',', 'g'),''));
                // namt = namt - parseFloat($(this).find('.fa').attr('innerHTML').replace(new RegExp(',', 'g'),''));
                dist = dist + parseFloat($(this).find('.lt').attr('innerHTML').replace(new RegExp(',', 'g'),''), 10);
				if(!isNaN(parseFloat($(this).find('.lt').attr('innerHTML').replace(new RegExp(',', 'g'),'')))) {
                    namt = namt - parseFloat($(this).find('.lt').attr('innerHTML').replace(new RegExp(',', 'g'),''), 10);
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
            } else if($.trim($(this).find('.ot').attr('innerHTML')) == 'Charge') {
                // chgt = chgt + parseFloat($(this).find('.fa').attr('innerHTML').replace(new RegExp(',', 'g'),''));
                chgt = chgt + parseFloat($(this).find('.lt').attr('innerHTML').replace(new RegExp(',', 'g'),''), 10);
                /*if(!isNaN(parseFloat($(this).find('.fv').attr('innerHTML').replace(new RegExp(',', 'g'),'')))) {
                                vatt = vatt + parseFloat($(this).find('.fv').attr('innerHTML').replace(new RegExp(',', 'g'),''));
                        }
                        if(!isNaN(parseFloat($(this).find('.ox').attr('innerHTML').replace(new RegExp(',', 'g'),'')))) {
                                otht = otht + parseFloat($(this).find('.ox').attr('innerHTML').replace(new RegExp(',', 'g'),''));
                        }
                        if(!isNaN(parseFloat($(this).find('.wt').attr('innerHTML').replace(new RegExp(',', 'g'),'')))) {
                                wtht = wtht + parseFloat($(this).find('.wt').attr('innerHTML').replace(new RegExp(',', 'g'),''));
                        }*/
                if(!isNaN(parseFloat($(this).find('.lt').attr('innerHTML').replace(new RegExp(',', 'g'),'')))) {
                    namt = namt + parseFloat($(this).find('.lt').attr('innerHTML').replace(new RegExp(',', 'g'),''), 10);
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
                subt = subt + parseFloat($(this).find('.fa').attr('innerHTML').replace(new RegExp(',', 'g'),''));
                if(!isNaN(parseFloat($(this).find('.fv').attr('innerHTML').replace(new RegExp(',', 'g'),'')))) {
                    vatt = vatt + parseFloat($(this).find('.fv').attr('innerHTML').replace(new RegExp(',', 'g'),''), 10);
                }
                if(!isNaN(parseFloat($(this).find('.ox').attr('innerHTML').replace(new RegExp(',', 'g'),'')))) {
                    otht = otht + parseFloat($(this).find('.ox').attr('innerHTML').replace(new RegExp(',', 'g'),''), 10);
                }
                if(!isNaN(parseFloat($(this).find('.wt').attr('innerHTML').replace(new RegExp(',', 'g'),'')))) {
                    wtht = wtht + parseFloat($(this).find('.wt').attr('innerHTML').replace(new RegExp(',', 'g'),''), 10);
                }
                if(!isNaN(parseFloat($(this).find('.lt').attr('innerHTML').replace(new RegExp(',', 'g'),'')))) {
                    namt = namt + parseFloat($(this).find('.lt').attr('innerHTML').replace(new RegExp(',', 'g'),''), 10);
                }
                var subli = $('#subli', $(this));
                if(subli.length > 0) {
                    var sltl = parseFloat($('.stl', subli).html().replace(new RegExp(',', 'g'),''), 10);
                    if($('.slf', subli).length > 0) {
                        var slf = parseFloat($('.slf', subli).html().replace(new RegExp(',', 'g'),''), 10);
                    }
                    if($('.sltyp', subli).length > 0) {
                        var sltyp = $('.sltyp', subli).html().replace(new RegExp('-', 'g'),'').toLowerCase();
                    }
                    //alert($.trim(sltyp))
                    if($.trim(sltyp) == 'discount' || $.trim(sltyp) == 'discount') {
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
                    } else if($.trim(sltyp) == 'charge' || $.trim(sltyp) == 'charge') {
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
			namt_int = parseFloat(parseInt(namt) + '.9');
			namt = (parseInt(namt) > parseFloat(namt_int))? round(namt) : namt;
            //
            $('#subt').attr('innerHTML', $.trim(money_format('%i',subt).replace("USD","")));
            $('#dist').attr('innerHTML', $.trim(money_format('%i',dist).replace("USD","")));
            $('#chgt').attr('innerHTML', $.trim(money_format('%i',chgt).replace("USD","")));
            $('#vatt').attr('innerHTML', $.trim(money_format('%i',vatt).replace("USD","")));
            $('#otht').attr('innerHTML', $.trim(money_format('%i',otht).replace("USD","")));
            $('#wtht').attr('innerHTML', $.trim(money_format('%i',wtht).replace("USD","")));
            $('#namt').attr('innerHTML', $.trim(money_format('%i',namt).replace("USD","")));
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

	function getlitotal()
	{
		var lit = 0;
		$.each($('[id^=spnd]'), function(i, el) {
			id = $(this).attr('id').replace('spnd','');
			if($('.ot', $(this)).html()!='Discount' && $('.ot', $(this)).html()!='Charge') {
				lt = $('.lt', $(this)).html();
				lt = parseFloat(parseFloat(lt.replace(new RegExp(',', 'g'),''),10).toFixed(2));
				lit = lit + lt;
			}
		});
		return lit;
	}

	function gettxtotal(vl)
	{
		var lit = 0;
		$.each($('[id^=spnd]'), function(i, el) {
			id = $(this).attr('id').replace('spnd','');
			if($('.ot', $(this)).html()!='Discount' && $('.ot', $(this)).html()!='Charge') {
				lt = $(vl, $(this)).html();
				lt = parseFloat(parseFloat(lt.replace(new RegExp(',', 'g'),''),10).toFixed(2));
				lit = lit + lt;
			}
		});
		return lit;
	}

    $(document).ready(function()
    {
		$('#btnReset').click(function() {
			$('#frmadd')[0].reset();
			$.each($('div[id^=Div]'),function() {
				id = $(this).attr('id').replace('Div','');
				if(parseInt(id) >= cnt) {
					$(this).remove();
					$('#spnd'+id).remove();
				}
			});
			$.each($('select[name="invoiceType\[\]"]'), function() {
				$(this).trigger('change');
			});
			$.each($('select[name="eInvoiceType\[\]"]'), function() {
				$(this).trigger('change');
			});
			$.each($('select[name="fPrice\[\]"]'), function() {
				$(this).trigger('blur');
			});
		});

        $('input[name="fPrice\[\]"]').blur(function() {
            var rq = $(this).attr('id').replace('fPrice','');
            var type = $('#eInvoiceType'+rq).val();
            if($.trim(type)=='Discount' || $.trim(type)=='Charge') {
                var p = parseFloat($(this).val().replace(new RegExp(',', 'g'),'')).toFixed(2);
                $('#spnd'+rq+'>.iq').attr('innerHTML','');
                $('#spnd'+rq+'>.fp').attr('innerHTML', money_format('%i',parseFloat(p))+'%');
                $('#spnd'+rq+'>.fv').attr('innerHTML','');
                $('#spnd'+rq+'>.ox').attr('innerHTML','');
                $('#spnd'+rq+'>.wt').attr('innerHTML','');
                $('#spnd'+rq+'>.fa').attr('innerHTML','');
                //var subtotal = parseFloat($('#subt').html().replace(new RegExp(',', 'g'),''));
                //var lt = parseFloat(subtotal * p / 100).toFixed(2);
//				litotal = getlitotal();
//              var lt = parseFloat(litotal * p / 100).toFixed(2); 	// subtotal
                //$('#fLineTotal'+rq).val(lt);
				//lt = $.trim(money_format('%i', parseFloat(lt)).replace("USD",""));
                //$('#spnd'+rq+'>.lt').attr('innerHTML',lt);
				var subtotal = parseFloat($('#subt').html().replace(new RegExp(',', 'g'),''));
				var st = parseFloat(subtotal * p / 100).toFixed(2); 	// litotal
				if(!isNaN(st)) {
					$('#fAmount'+rq).val(st);
				}
				st = $.trim(money_format('%i', parseFloat(st)).replace("USD",""));
				$('#spnd'+rq+'>.fa').attr('innerHTML', st);
				st = parseFloat(st);
				//
				var fv = gettxtotal('.fv');
				if(!isNaN(p)) { $('#fVAT'+rq).val(p); }
				fv = parseFloat(fv * p / 100).toFixed(2);
				$('#spnd'+rq+'>.fv').attr('innerHTML', fv);
				fv = parseFloat(fv);
				//
				var ox = gettxtotal('.ox');
				if(!isNaN(p)) { $('#fOtherTax1'+rq).val(p); }
				ox = parseFloat(ox * p / 100).toFixed(2);
				$('#spnd'+rq+'>.ox').attr('innerHTML', ox);
				ox = parseFloat(ox);
				//
				var wt = gettxtotal('.wt');
				if(!isNaN(p)) { $('#fWithHoldingTax'+rq).val(p); }
				wt = parseFloat(wt * p / 100).toFixed(2);
				$('#spnd'+rq+'>.wt').attr('innerHTML', wt);
				wt = parseFloat(wt);
				//
				var lt = parseFloat((st + fv + ox - wt));
				if(!isNaN(lt)) {
					$('#fLineTotal'+rq).val(lt.toFixed(2));
				}
				lt = $.trim(money_format('%i', lt).replace("USD",""));
				$('#spnd'+rq+'>.lt').attr('innerHTML', lt);
            } else {
                var q = parseInt($('#iQuantity'+rq).val().replace(new RegExp(',', 'g'),''));
                var p = parseFloat($(this).val().replace(new RegExp(',', 'g'),'')).toFixed(2);
                var sum = parseInt(q)*parseFloat(p);
				if(!isNaN(sum)) {
                    $('#fAmount'+rq).val($.trim(money_format('%i',sum).replace("USD","")));
                }

                var v = parseFloat($('#fVAT'+rq).val().replace(new RegExp(',', 'g'),''));
                var t = parseFloat($('#fOtherTax1'+rq).val().replace(new RegExp(',', 'g'),''));
                var w = parseFloat($('#fWithHoldingTax'+rq).val().replace(new RegExp(',', 'g'),''));
                var a = sum;
                var sm = 0;
                if(!isNaN(a)) {
                    sm = sm + a;
                    if(!isNaN(v)) { sm = sm + (a*v/100); $('#vat'+rq).val(a*v/100); }
                    if(!isNaN(t)) { sm = sm + (a*t/100); $('#othertax1'+rq).val(a*t/100); }
                    if(!isNaN(w)) { sm = sm - (a*w/100); $('#withholdingtax'+rq).val(a*w/100); }
                    if(!isNaN(sm)) {
                        $('#fLineTotal'+rq).val($.trim(money_format('%i',sm).replace("USD","")));
                    }
                }
                //sum = (parseFloat(sum,10) > parseInt(sum,10))? sum.toFixed(2) : sum;
                //sm = (parseFloat(sm,10) > parseInt(sm,10))? sm.toFixed(2) : sm;
                // $('#fAmount'+rq).val(parseInt(q)*parseFloat(p));
                if(document.getElementById('spnd'+rq)) {
                    $('#spnd'+rq+'>.iq').attr('innerHTML',money_format('%i',q,'no'));
                    $('#spnd'+rq+'>.fp').attr('innerHTML',money_format(p));
                    $('#spnd'+rq+'>.fv').attr('innerHTML',money_format('%i',parseFloat($('#vat'+rq).val())));
                    $('#spnd'+rq+'>.ox').attr('innerHTML',parseFloat($('#othertax1'+rq).val()).toFixed(2));
                    $('#spnd'+rq+'>.wt').attr('innerHTML',parseFloat($('#withholdingtax'+rq).val()).toFixed(2));
                    var fa = $.trim(money_format('%i',sum).replace("USD",""));
                    /*if(fa.indexOf('.') != -1 && parseInt(fa.substring(fa.lastIndexOf('.')+1, fa.length),10) == 0) {
                       fa = fa.substring(0, fa.length-3);
                    }*/
					$('#spnd'+rq+'>.fa').attr('innerHTML', fa);
                    var lt = $.trim(money_format('%i',sm).replace("USD",""));
                    /*if(lt.indexOf('.') != -1 && parseInt(lt.substring(lt.lastIndexOf('.')+1, lt.length),10) == 0) {
                       lt = lt.substring(0, lt.length-3);
                    }*/
                    $('#spnd'+rq+'>.lt').attr('innerHTML', lt);
                }
                $.each($('div[id*="Div"]'), function(l) {
                    var sbtyp = $(this).find('[name="invoiceType\[\]"]');
                    if(sbtyp.val() == 'Discount' || sbtyp.val() == 'Charge') {
                        $(this).find('[name="fPrice\[\]"]').trigger('blur');
                    }
                });
            }
            settotal();
        });
        $('input[name="iQuantity\[\]"]').blur(function() {
            var rq = $(this).attr('id').replace('iQuantity','');
            $('#fPrice'+rq).trigger('blur');
            /*var p = parseFloat($('#fPrice'+rq).val().replace(new RegExp(',', 'g'),''));
                var q = parseInt($(this).val().replace(new RegExp(',', 'g'),''));
                var sum = parseInt(q)*parseFloat(p);
                if(!isNaN(sum)) {
                        $('#fAmount'+rq).val($.trim(money_format('%i',sum).replace("USD","")));
                }

                var v = parseFloat($('#fVAT'+rq).val().replace(new RegExp(',', 'g'),''));
                var t = parseFloat($('#fOtherTax1'+rq).val().replace(new RegExp(',', 'g'),''));
                var w = parseFloat($('#fWithHoldingTax'+rq).val().replace(new RegExp(',', 'g'),''));
                var a = sum;
                var sm = 0;
                if(!isNaN(a)) {
                        sm = sm + a;
                        if(!isNaN(v)) { sm = sm + (a*v/100); $('#vat'+rq).val(a*v/100); }
                        if(!isNaN(t)) { sm = sm + (a*t/100); $('#othertax1'+rq).val(a*t/100); }
                        if(!isNaN(w)) { sm = sm - (a*w/100); $('#withholdingtax'+rq).val(a*w/100); }
                        if(!isNaN(sm)) {
                                $('#fLineTotal'+rq).val($.trim(money_format('%i',sm).replace("USD","")));
                        }
                }

                if(document.getElementById('spnd'+rq)) {
                        $('#spnd'+rq+'>.iq').attr('innerHTML',q);
                        $('#spnd'+rq+'>.fp').attr('innerHTML',p);
                        $('#spnd'+rq+'>.fv').attr('innerHTML',$('#vat'+rq).val());
                        $('#spnd'+rq+'>.ox').attr('innerHTML',$('#othertax1'+rq).val());
                        $('#spnd'+rq+'>.wt').attr('innerHTML',$('#withholdingtax'+rq).val());
                        $('#spnd'+rq+'>.fa').attr('innerHTML',$.trim(money_format('%i',sum).replace("USD","")));
                        $('#spnd'+rq+'>.lt').attr('innerHTML',$.trim(money_format('%i',sm).replace("USD","")));
                }
                settotal();*/
        });

        $('input[name="fOtherTax1\[\]"]').change(function() {
            var rq = $(this).attr('id').replace('fOtherTax1','');
            $('#fPrice'+rq).trigger('blur');
            /*var a  = parseFloat($('#fAmount'+rq).val().replace(new RegExp(',', 'g'),''));
                var v = parseFloat($('#fVAT'+rq).val().replace(new RegExp(',', 'g'),''));
                var t = parseFloat($(this).val().replace(new RegExp(',', 'g'),''));
                var w = parseFloat($('#fWithHoldingTax'+rq).val().replace(new RegExp(',', 'g'),''));
                var sum = 0;
                if(!isNaN(a)) {
                        sum = sum + a;
                        if(!isNaN(v)) { sum = sum + (a*v/100); $('#vat'+rq).val(a*v/100); }
                        if(!isNaN(t)) { sum = sum + (a*t/100); $('#othertax1'+rq).val(a*t/100); }
                        if(!isNaN(w)) { sum = sum - (a*w/100); $('#withholdingtax'+rq).val(a*w/100); }
                        if(!isNaN(sum)) {
                                $('#fLineTotal'+rq).val($.trim(money_format('%i',sum).replace("USD","")));
                        }
                }

                if(document.getElementById('spnd'+rq)) {
                        // $('#spnd'+rq+'>.ox').attr('innerHTML',t);
                        $('#spnd'+rq+'>.ox').attr('innerHTML',$('#othertax1'+rq).val());
                        $('#spnd'+rq+'>.lt').attr('innerHTML',$.trim(money_format('%i',sum).replace("USD","")));
                }
                settotal();*/
        });
        $('input[name="fVAT\[\]"]').change(function() {
            var rq = $(this).attr('id').replace('fVAT','');
            $('#fPrice'+rq).trigger('blur');
            /*var a  = parseFloat($('#fAmount'+rq).val().replace(new RegExp(',', 'g'),''));
                var t = parseFloat($('#fOtherTax1'+rq).val().replace(new RegExp(',', 'g'),''));
                var w = parseFloat($('#fWithHoldingTax'+rq).val().replace(new RegExp(',', 'g'),''));
                var v = parseFloat($(this).val().replace(new RegExp(',', 'g'),''));
                var sum = 0;
                if(!isNaN(a)) {
                        sum = sum + a;
                        if(!isNaN(v)) { sum = sum + (a*v/100); $('#vat'+rq).val(a*v/100); }
                        if(!isNaN(t)) { sum = sum + (a*t/100); $('#othertax1'+rq).val(a*t/100); }
                        if(!isNaN(w)) { sum = sum - (a*w/100); $('#withholdingtax'+rq).val(a*w/100); }
                        if(!isNaN(sum)) {
                                $('#fLineTotal'+rq).val($.trim(money_format('%i',sum).replace("USD","")));
                        }
                }

                if(document.getElementById('spnd'+rq)) {
                        // $('#spnd'+rq+'>.fv').attr('innerHTML',v);
                        $('#spnd'+rq+'>.fv').attr('innerHTML',$('#vat'+rq).val());
                        $('#spnd'+rq+'>.lt').attr('innerHTML',$.trim(money_format('%i',sum).replace("USD","")));
                }
                settotal();*/
        });

        $('input[name="fWithHoldingTax\[\]"]').change(function() {
            var rq = $(this).attr('id').replace('fWithHoldingTax','');
            $('#fPrice'+rq).trigger('blur');
            /*var a  = parseFloat($('#fAmount'+rq).val().replace(new RegExp(',', 'g'),''));
                var t = parseFloat($('#fOtherTax1'+rq).val().replace(new RegExp(',', 'g'),''));
                var v = parseFloat($('#fVAT'+rq).val().replace(new RegExp(',', 'g'),''));
                var w = parseFloat($(this).val().replace(new RegExp(',', 'g'),''));
                var sum = 0;
                if(!isNaN(a)) {
                        sum = sum + a;
                        if(!isNaN(v)) { sum = sum + (a*v/100); $('#vat'+rq).val(a*v/100); }
                        if(!isNaN(t)) { sum = sum + (a*t/100); $('#othertax1'+rq).val(a*t/100); }
                        if(!isNaN(w)) { sum = sum - (a*w/100); $('#withholdingtax'+rq).val(a*w/100); }
                        if(!isNaN(sum)) {
                                $('#fLineTotal'+rq).val($.trim(money_format('%i',sum).replace("USD","")));
                        }
                }
                if(document.getElementById('spnd'+rq)) {
                        // $('#spnd'+rq+'>.wt').attr('innerHTML',w);
                        $('#spnd'+rq+'>.wt').attr('innerHTML',$('#withholdingtax'+rq).val());
                        $('#spnd'+rq+'>.lt').attr('innerHTML',$.trim(money_format('%i',sum).replace("USD","")));
                }
                settotal();*/
        });

        $('textarea[name="tDescription\[\]"]').change(function() {
            var rq = $(this).attr('id').replace('tDescription','');
            if(document.getElementById('spnd'+rq)) {
                if($.trim($(this).val()) != '') $('#spnd'+rq+'>.td').attr('innerHTML',$.trim($(this).val()));
            }
        });

        $('[name="vUnitOfMeasure\[\]"]').change(function() {
            var rq = $(this).attr('id').replace('vUnitOfMeasure','');
            if(document.getElementById('spnd'+rq)) {
                // if($.trim($(this).val()) != '')
                $('#spnd'+rq+'>.um').attr('innerHTML',$.trim($(this).val()));
            }
        });

        $('select[name="invoiceType\[\]"]').change(function() {
            var rq = $(this).attr('id').replace('eInvoiceType','');
            if(document.getElementById('spnd'+rq)) {
                if($.trim($(this).val()) != '') $('#spnd'+rq+'>.ot').attr('innerHTML',$.trim($(this).val()));
            }
            //
            if($(this).val() == 'Discount' || $(this).val() == 'Charge') {
				$('#spnd'+rq+'>.ot').attr('innerHTML', '');
                // alert($(this).closest('table[id^="tbl"]').find('.ndcf').closest('input').length);
                $(this).closest('table[id^="tbl"]').find('.ndcf').hide();
                $(this).closest('table[id^="tbl"]').find('.ndcf').parent('td').hide();
                $(this).closest('table[id^="tbl"]').find('.ndcf').parent('td').next('td').hide();
                // $(this).closest('table[id^="tbl"]').find('input[id^="iQuantity"]').parent('td').attr('width','1');
                $(this).closest('table[id^="tbl"]').find('.dcr').parent('td').attr('width','12.5%'); 	//
                $(this).closest('table[id^="tbl"]').find('.dcr').html('Rate : &nbsp;<font class="reqmsg">*</font>');
                $(this).closest('table[id^="tbl"]').find('[name="eSublineType\[\]"]').val('');
                $(this).closest('table[id^="tbl"]').find('[name="eSublineType\[\]"]').trigger('change');
            } else {
                $(this).closest('table[id^="tbl"]').find('.ndcf').show();
                $(this).closest('table[id^="tbl"]').find('.ndcf').parent('td').show();
                $(this).closest('table[id^="tbl"]').find('.ndcf').parent('td').next('td').show();
                // $(this).closest('table[id^="tbl"]').find('input[id^="iQuantity"]').parent('td').attr('width','154px');
                $(this).closest('table[id^="tbl"]').find('.dcr').parent('td').attr('width','111');
                $(this).closest('table[id^="tbl"]').find('.dcr').html('Price : &nbsp;<font class="reqmsg">*</font>');
            }
            var id = $(this).attr('id').replace('eInvoiceType','');
            $('#fPrice'+rq).trigger('blur');
            $('div[id*="Div"]').find('[name="fPrice\[\]"]').trigger('blur');
            //
        });
        //
        $.each($('select[name="invoiceType\[\]"]'), function() {
            /*if($(this).val() == 'Discount' || $(this).val() == 'Charge') {
                        // alert($(this).closest('table[id^="tbl"]').find('.ndcf').length);
                        $(this).closest('table[id^="tbl"]').find('.ndcf').hide();
                        $(this).closest('table[id^="tbl"]').find('.ndcf').parent('td').next('td').hide();
                        $(this).closest('table[id^="tbl"]').find('input[id^="iQuantity"]').parent('td').attr('width','1');
                } else {
                        $(this).closest('table[id^="tbl"]').find('.ndcf').show();
                        $(this).closest('table[id^="tbl"]').find('.ndcf').parent('td').next('td').show();
                        $(this).closest('table[id^="tbl"]').find('input[id^="iQuantity"]').parent('td').attr('width','154px');
                }*/
            if($(this).val() == 'Discount' || $(this).val() == 'Charge') {
                // alert($(this).closest('table[id^="tbl"]').find('.ndcf').closest('input').length);
                $(this).closest('table[id^="tbl"]').find('.ndcf').hide();
                $(this).closest('table[id^="tbl"]').find('.ndcf').parent('td').hide();
                $(this).closest('table[id^="tbl"]').find('.ndcf').parent('td').next('td').hide();
                // $(this).closest('table[id^="tbl"]').find('input[id^="iQuantity"]').parent('td').attr('width','1');
                $(this).closest('table[id^="tbl"]').find('.dcr').parent('td').attr('width','12.5%'); 	//
                $(this).closest('table[id^="tbl"]').find('.dcr').html('Rate : &nbsp;<font class="reqmsg">*</font>');
                $(this).closest('table[id^="tbl"]').find('[name="eSublineType\[\]"]').val('');
                $(this).closest('table[id^="tbl"]').find('[name="eSublineType\[\]"]').trigger('change');
            } else {
                $(this).closest('table[id^="tbl"]').find('.ndcf').show();
                $(this).closest('table[id^="tbl"]').find('.ndcf').parent('td').show();
                $(this).closest('table[id^="tbl"]').find('.ndcf').parent('td').next('td').show();
                // $(this).closest('table[id^="tbl"]').find('input[id^="iQuantity"]').parent('td').attr('width','154px');
                $(this).closest('table[id^="tbl"]').find('.dcr').parent('td').attr('width','111');
                $(this).closest('table[id^="tbl"]').find('.dcr').html('Price : &nbsp;<font class="reqmsg">*</font>');
            }
        });
        // alert($('select[name="invoiceType\[\]"] option:selected[value="Discount"]').length);
    });

    function shwtbl(vl) {
        var vl = parseInt(vl);
        var dvnm = '';

        $('div [id*="Div"]').hide();
        $('#Div'+vl).show();
        cr = vl;

        for(var h=0; h<i; h++) {
            if(document.getElementById('vUnitOfMeasure'+h) && h!=vl) {
                if($("#frmadd").validate().element('#vUnitOfMeasure'+h)==false || $("#frmadd").validate().element('#fAmount'+h)==false || $("#frmadd").validate().element('#fLineTotal'+h)==false) {
                    $('#Div'+h).attr('innerHTML','');
                }
            }
        }
    }
    function deltbl(vl) {
        // alert(vl);
        if($('#tbl'+vl)) {
            $('#Div'+vl).attr('innerHTML','');
        }
        if($('#spnd'+vl)) {
            $('#spnd'+vl).attr('innerHTML','');
            $('#spnd'+vl).remove();
        }

        if(cr == vl) {
            if($('#tbl'+(vl-1))) {
                // $('#Div'+(vl-1)).show();
            } else if($('#tbl'+(vl+1))) {
                // $('#Div'+(vl+1)).show();
            } else {
                // addrow();
            }
        }

        $('#Div'+vl).hide();
        if($('div [id*="spnd"]').length<1) {
            if(document.getElementById('nli')) {
                $('#nli').show();
            } else {
                $('#dlines').attr('innerHTML',"<div id='nli' align='center'><br /><b>{/literal}{$LBL_NO_LINE_ITEMS}{literal}</b></div>");
            }
        } else {
            $('#nli').hide();
        }

        $(document).ready( function() {
            $(function() {
                var ead=10;
                $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
            });
        });
        settotal();
        $.each($('div[id*="Div"]'), function(l) {
            var sbtyp = $(this).find('[name="invoiceType\[\]"]');
            if(sbtyp.val() == 'Discount' || sbtyp.val() == 'Charge') {
                $(this).find('[name="fPrice\[\]"]').trigger('blur');
            }
        });
    }

    {/literal}{section name="i" loop=$invitems}{literal}
    function findPOValue(li) {
        if( li == null ) return alert("No match!");
        if( !!li.extra ) var sValue = li.extra[0];
        else var sValue = li.selectValue;

        var totVal = sValue;
        var totValID;
        var totValRes;
        totVal = totVal.split('</span>');
        totValID = totVal[0].replace("<span style='display:none'>","");
        totValRes = totVal[1];
        var iOrgId=totValID.split('_');
        totValID=iOrgId[0];
        iOrgId=iOrgId[1];
        $('#iRelatedPurchaseOrderLineID0'+'{/literal}{$smarty.section.i.index}{literal}').val(totValID); 	//
        var url = SITE_URL+"index.php?file=m-aj_getItemDetails";
        var pars = "&table="+PRJ_DB_PREFIX+"_purchase_order_line"+"&iId=iOrderLineID"+"&id="+totValID+"&fields=all"+"&jtbl=&where=";
        //alert(url+pars); return false;
        $('#spn').load(url+pars);
        // $.ajax({type:"post", url:url, data:pars, success:getDetails});
        //alert(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+iOrgId+"&iUserID="+totValID);
        //$('#OrgStatus_Div').load(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+totValID);		// +"&iOrgId="+iOrgId
    }

    function selectPOItem(li) {
        findPOValue(li);
    }

    /*$(document).ready(function() {
        $("#POItemCode").autocomplete(
                SITE_URL+"index.php?file=u-aj_getInvPoItem&iPOId="+$('#iPurchaseOrderID').val(),
                {
                        delay:10,
                        minChars:1,
                        matchSubset:1,
                        matchContains:1,
                        cacheLength:10,
                        onItemSelect:selectPOItem,
                        onFindValue:findPOValue,
                        formatItem:formatItem,
                        autoFill:false
                }
        );
});
     */
    // SITE_URL+"index.php?file=or-aj_getInvPo&orgid="+$('#iSupplierOrganizationID').val(),


    function formatItem(row) {
        var totVal = row[0];
        var totValID;
        var totValRes;
        totVal = totVal.split('</span>');
        totValID = totVal[0].replace("<span style='display:none'>");
        totValRes = totVal[1];
        return totValRes;
    }
    function findUserValue(li) {
        if( li == null ) return alert("No match!");
        if( !!li.extra ) var sValue = li.extra[0];
        else var sValue = li.selectValue;

        var totVal = sValue;
        var totValID;
        var totValRes;
        totVal = totVal.split('</span>');
        totValID = totVal[0].replace("<span style='display:none'>","");
        totValRes = totVal[1];
        var iOrgId=totValID.split('_');
        totValID=iOrgId[0];
        iOrgId=iOrgId[1];
        //	alert(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+iOrgId+"&iUserID="+totValID);
        //$('#OrgStatus_Div').load(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+totValID);		// +"&iOrgId="+iOrgId
    }
    function selectUsrItem(li) {
        findUserValue(li);
    }

    function setuser()
    {
        $("#POItemCode0"+'{/literal}{$smarty.section.i.index}{literal}').autocomplete(
        SITE_URL+"index.php?file=u-aj_getInvPoItem&iPOId="+$("#iPurchaseOrderID0"+'{/literal}{$smarty.section.i.index}{literal}').val(),
        {
            delay:10,
            minChars:1,
            matchSubset:1,
            matchContains:1,
            cacheLength:10,
            onItemSelect:selectPOItem,
            onFindValue:findPOValue,
            formatItem:formatItem,
            autoFill:false
        }
    );
    }

    function findValue(li) {
        if( li == null ) return alert("No match!");
        if( !!li.extra ) var sValue = li.extra[0];
        else var sValue = li.selectValue;

        var totVal = sValue;
        var totValID;
        var totValRes;
        totVal = totVal.split('</span>');
        totValID = totVal[0].replace("<span style='display:none'>","");
        totValRes = totVal[1];
        $("#iPurchaseOrderID0"+'{/literal}{$smarty.section.i.index}{literal}').val(totValID);
        //$('#result').load(SITE_URL+"index.php?file=u-aj_getOrganizationUser&type=user&iId="+totValID+"");
        //$('#OrgStatus_Div').load(SITE_URL+"index.php?file=or-aj_getOrganizationStatus&type=user&iId="+totValID+"");
        if(totValID != '') { setuser(); }
    }
    function selectItem(li) {
        findValue(li);
    }

    $("#purchaseOrder0"+'{/literal}{$smarty.section.i.index}{literal}').autocomplete(
    SITE_URL+"index.php?file=u-aj_getInvPo",
    {
        delay:10,
        minChars:1,
        matchSubset:1,
        matchContains:1,
        cacheLength:10,
        onItemSelect:selectItem,
        onFindValue:findValue,
        formatItem:formatItem,
        autoFill:false
    }
);
    {/literal}{sectionelse}{literal}
    function findPOValue(li) {
        if( li == null ) return alert("No match!");
        if( !!li.extra ) var sValue = li.extra[0];
        else var sValue = li.selectValue;

        var totVal = sValue;
        var totValID;
        var totValRes;
        totVal = totVal.split('</span>');
        totValID = totVal[0].replace("<span style='display:none'>","");
        totValRes = totVal[1];
        var iOrgId=totValID.split('_');
        totValID=iOrgId[0];
        iOrgId=iOrgId[1];
        $('#iRelatedPurchaseOrderLineID00').val(totValID); 	//
        var url = SITE_URL+"index.php?file=m-aj_getItemDetails";
        var pars = "&table="+PRJ_DB_PREFIX+"_purchase_order_line"+"&iId=iOrderLineID"+"&id="+totValID+"&fields=all"+"&jtbl=&where=";
        //alert(url+pars); return false;
        $('#spn').load(url+pars);
        // $.ajax({type:"post", url:url, data:pars, success:getDetails});
        //alert(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+iOrgId+"&iUserID="+totValID);
        //$('#OrgStatus_Div').load(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+totValID);		// +"&iOrgId="+iOrgId
    }

    function selectPOItem(li) {
        findPOValue(li);
    }

    /*$(document).ready(function() {
        $("#POItemCode").autocomplete(
                SITE_URL+"index.php?file=u-aj_getInvPoItem&iPOId="+$('#iPurchaseOrderID').val(),
                {
                        delay:10,
                        minChars:1,
                        matchSubset:1,
                        matchContains:1,
                        cacheLength:10,
                        onItemSelect:selectPOItem,
                        onFindValue:findPOValue,
                        formatItem:formatItem,
                        autoFill:false
                }
        );
});
     */
    // SITE_URL+"index.php?file=or-aj_getInvPo&orgid="+$('#iSupplierOrganizationID').val(),


    function formatItem(row) {
        var totVal = row[0];
        var totValID;
        var totValRes;
        totVal = totVal.split('</span>');
        totValID = totVal[0].replace("<span style='display:none'>");
        totValRes = totVal[1];
        return totValRes;
    }
    function findUserValue(li) {
        if( li == null ) return alert("No match!");
        if( !!li.extra ) var sValue = li.extra[0];
        else var sValue = li.selectValue;

        var totVal = sValue;
        var totValID;
        var totValRes;
        totVal = totVal.split('</span>');
        totValID = totVal[0].replace("<span style='display:none'>","");
        totValRes = totVal[1];
        var iOrgId=totValID.split('_');
        totValID=iOrgId[0];
        iOrgId=iOrgId[1];
        //	alert(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+iOrgId+"&iUserID="+totValID);
        //$('#OrgStatus_Div').load(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+totValID);		// +"&iOrgId="+iOrgId
    }
    function selectUsrItem(li) {
        findUserValue(li);
    }

    function setuser()
    {
        $("#POItemCode00").autocomplete(
        SITE_URL+"index.php?file=u-aj_getInvPoItem&iPOId="+$("#iPurchaseOrderID00").val(),
        {
            delay:10,
            minChars:1,
            matchSubset:1,
            matchContains:1,
            cacheLength:10,
            onItemSelect:selectPOItem,
            onFindValue:findPOValue,
            formatItem:formatItem,
            autoFill:false
        }
    );
    }

    function findValue(li) {
        if( li == null ) return alert("No match!");
        if( !!li.extra ) var sValue = li.extra[0];
        else var sValue = li.selectValue;

        var totVal = sValue;
        var totValID;
        var totValRes;
        totVal = totVal.split('</span>');
        totValID = totVal[0].replace("<span style='display:none'>","");
        totValRes = totVal[1];
        $("#iPurchaseOrderID00").val(totValID);
        //$('#result').load(SITE_URL+"index.php?file=u-aj_getOrganizationUser&type=user&iId="+totValID+"");
        //$('#OrgStatus_Div').load(SITE_URL+"index.php?file=or-aj_getOrganizationStatus&type=user&iId="+totValID+"");
        if(totValID != '') { setuser(); }
    }
    function selectItem(li) {
        findValue(li);
    }

    $("#purchaseOrder00").autocomplete(
    SITE_URL+"index.php?file=u-aj_getInvPo",
    {
        delay:10,
        minChars:1,
        matchSubset:1,
        matchContains:1,
        cacheLength:10,
        onItemSelect:selectItem,
        onFindValue:findValue,
        formatItem:formatItem,
        autoFill:false
    }
);
    {/literal}{/section}{literal}

    function resetform()
    {
        $('#frmadd')[0].reset();
    }

    var validator = $("#frmadd").validate({
        /*		rules:{
                        "vItemCode[]": {
                                remote: {
                                        url:SITE_URL+"index.php?file=u-aj_chkdupdata",
               type:"get",
               data:{
                                                val:function() {
                                                        return $("#iInvoiceLineID").val();
                                                },
                                                id:function() {
                                                        return "iInvoiceLineID";
                                                },
                                                field:function() {
                                                        return "vItemCode";
                                                },
                                                table:function() {
                                                        return "{/literal}{$PRJ_DB_PREFIX}{literal}_invoice_detail_line";
                                                }
                                        }
                                }
                        }
                },*/
        messages:{
            "eInvoiceType[]": {
                required: LBL_SELECT_INV_TYPE
            },
            /*"vItemCode[]": {
                  required: LBL_ENTER_ITEM_CODE,
                                                remote: jQuery.validator.format(LBL_ITEM_CODE_IN_USE)
               },*/
            "vUnitOfMeasure[]": {
                required: LBL_ENTER_UNIT_OF_MEASURE
            },
            "iQuantity[]": {
                digits: LBL_DIGITS_ONLY
            },
            "fPrice[]": {
                decimals: LBL_DIGITS_ONLY
            },
            "fAmount[]": {
                decimals: LBL_DIGITS_ONLY
            },
            "fVAT[]": {
                decimals: LBL_DIGITS_ONLY
            },
            "fWithHoldingTax[]": {
                decimals: LBL_DIGITS_ONLY
            }
        }
    });


    function chkValid(allel)
    {
        rtn = 'no';
        $.each(allel,function(i,el){
            var vld = $("#frmadd").validate().element('#'+$(this).attr('id'));
            if(vld === false) {
                rtn = 'yes';
            }
        });
        return rtn;
    }

    function frmsubmit()
    {
        if(document.getElementById('eInvoiceType'+cr) && !document.getElementById('spnd'+cr)) {
            deltbl(cr);
        }

        var rtn = 'no';
        var err = '';
        allel = $("[name='eInvoiceType\[\]']");
        rtn = chkValid(allel);
        if(rtn == 'yes') { err = rtn; }

        /*	allel = $("[name=vItemCode\[\]]");
        rtn = chkValid(allel);
        if(rtn == 'yes') { err = rtn; } */

        /* allel = $("[name='vUnitOfMeasure\[\]']");
        rtn = chkValid(allel);
        if(rtn == 'yes') { err = rtn; } */

        /* allel = $("[name='iQuantity\[\]']");
        rtn = chkValid(allel);
        if(rtn == 'yes') { err = rtn; } */

        allel = $("[name='fPrice\[\]']");
        rtn = chkValid(allel);
        if(rtn == 'yes') { err = rtn; }

        allel = $("[name='fAmount\[\]']");
        rtn = chkValid(allel);
        if(rtn == 'yes') { err = rtn; }

        allel = $("[name='fVAT\[\]']");
        rtn = chkValid(allel);
        if(rtn == 'yes') { err = rtn; }

        allel = $("[name='fWithHoldingTax\[\]']");
        rtn = chkValid(allel);
        if(rtn == 'yes') { err = rtn; }

        if(err == 'yes') {
            return false;
        }

        if(! ($("#frmadd").valid())) {
            return false;
        } else {
            // $('#addNew').attr('innerHTML','');
            $("#frmadd").submit();
        }
    }
</script>
{/literal}
<script type="text/javascript" src="{$SITE_JS_AJAX}jgetinvpoitem.js"></script>
{if $vldmsg neq ''}
{literal}
<script>
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
