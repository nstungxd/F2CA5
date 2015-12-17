<div class="middle-container">
    <h1>{$LBL_CREATE_PO_ITEM}</h1>
    <div class="middle-containt">
        <div class="statistics-main-box-white">
            <div>
                <ul id="inner-tab">
                    <li><a href="{$SITE_URL_DUM}purchaseordercreate/{$poid}"><em>{$LBL_PO_HEADER}</em></a></li>
                    <li><a href="{$SITE_URL_DUM}popref/{$poid}"><em>{$LBL_PREFERENCES}</em></a></li>
                    <li><a href="{$SITE_URL_DUM}purchaseorderadditems/{$poid}" class="current"><em>{$LBL_LINE_ITEM}</em></a></li>
                </ul>
            </div>
            <div class="clear"></div>
            <div class="inner-gray-bg" style="height:790px;">
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
                    <form name="frmadd" id="frmadd" action="{$SITE_URL}index.php?file=u-purchaseorderadditems_a"  method="post">
                        <input type="hidden" name="iPurchaseOrderID" id="iPurchaseOrderID" value="{$poid}" />
                        <input type="hidden" name="view" id="view" value="{$view}" />
                        <input type="hidden" name="eSaved" id="eSaved" value="{$podtls[0].eSaved}" />
                        <input type="hidden" value="0" id="mdiv" />
                        <table width="100%" border="0" cellspacing="0" class="black" cellpadding="0">
                            {section name="i" loop=$poitems}
                            <tr>
                                <td>
                                    <div id="Div{$smarty.section.i.index}">
                                        <table id="tbl{$smarty.section.i.index}" width="100%" border="0" cellspacing="5" cellpadding="0">
                                            {*}<tr>
                                                <td>{$LBL_INVOICE} : </td>
                                                <td>
                                                    <input type="text" name="invoice" class="input-rag" id="invoice0{$smarty.section.i.index}" title="{$LBL_ENTER} {$LBL_INVOICE}" style="width:117px;" value="{$poitems[i].vInvoiceCode}" />
                                                    <input type="hidden" name="iInvoiceID[]" id="iInvoiceID" class="input-rag" style="width:117px;" title="{$LBL_ENTER} {$LBL_INVOICE}" value="{$poitems[i].iInvoiceID}" />
                                                </td>
                                                <td>{$LBL_INV_REL_LINE} : </td>
                                                <td>
                                                    <input type="text" name="InvItemCode" class="input-rag" id="InvItemCode0{$smarty.section.i.index}" title="{$LBL_ENTER} {$LBL_INV_REL_LINE}" style="width:117px;" value="{$poitems[i].vInvItemCode}" />
                                                    <input type="hidden" name="iRelatedInvoiceLineID[]" id="iRelatedInvoiceLineID" class="input-rag" style="width:117px;" title="{$LBL_ENTER} {$LBL_INV_REL_LINE}" value="{$poitems[i].iRelatedInvoiceLineID}"/>
                                                </td>
                                            </tr>{*}
                                            {if $poitems[i].eOrderType eq 'Discount'}
                                            <tr>
                                                <td width="108">{$LBL_LINE_TYPE} : &nbsp;<font class="reqmsg">*</font></td>
                                                <td width="281">
                                                    <input type="hidden" name="iOrderLineID[]" id="iOrderLineID{$poitems[i].vItemCode}" value="{$poitems[i].iOrderLineID}" />
                                                    <span id="ordtype">
                                                        {*$orderTypes*}
                                                        <select name="eOrderType[]" id="eOrderType{$smarty.section.i.index}" class="required" >
                                                            {section name="l" loop=$orderTypes}
                                                            <option value="{$orderTypes[l]}" {if $orderTypes[l] eq $poitems[i].eOrderType}selected="selected"{/if}>{$orderTypes[l]}</option>
                                                            {/section}
                                                        </select>
                                                    </span>
                                                </td>
                                                <!--<td width="122">{$LBL_CURRENCY} : &nbsp;</td>
                                                <td>
                                                    <b>{$podtls[0].vCurrency}</b>
                                                    <input type="hidden" name="itemCode[]" id="vItemCode{$smarty.section.i.index}" class="input-rag required" style="width:188px;" title="{$LBL_ENTER} {$LBL_ITEM_CODE}" value="{$poitems[i].vItemCode}" {if $view eq 'edit'}readonly="readonly"{/if} />
                                            </td>-->
                                                <td width="122">{$LBL_PART_NO} : &nbsp;</td>
                                                <td>
                                                    <b>{$podtls[0].vPartNo}</b>
                                                    <input type="text" name="vPartNo[]" id="vPartNo{$smarty.section.i.index}" class="input-rag" style="width:188px;" title="{$LBL_ENTER} {$LBL_PART_NO}" value="{$poitems[i].vPartNo}" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="top">{$LBL_DESCRIPTION} : </td>
                                            <td><textarea name="tDescription[]" id="tDescription{$smarty.section.i.index}" class="input-rag" style="width:188px; height: 73px;"  >{$poitems[i].tDescription|stripslashes}</textarea></td>
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
                                                <table width="100%">
                                                    <tr>
                                                        <td style="display:none;"><span class="ndcf">{$LBL_QUANTITY} : &nbsp;<font class="reqmsg">*</font></span></td>
                                                        <td style="display:none;"><input type="text" name="iQuantity[]" id="iQuantity{$smarty.section.i.index}" class="input-rag required digits" style="width:117px;" title="{$LBL_ENTER} {$LBL_QUANTITY}" value="{$poitems[i].iQuantity}"/></td>
                                                        <td width="12.5%"><span class="dcr">{$LBL_RATE} : &nbsp;<font class="reqmsg">*</font></span></td>
                                                        <td width="149"><input type="text" name="fPrice[]" id="fPrice{$smarty.section.i.index}" class="input-rag required decimals" style="width:117px;" title="{$LBL_ENTER} {$LBL_PRICE}" value="{$poitems[i].fPrice|formatMoney:true}" /></td>
                                                        <td><span class="ndcf">{$LBL_AMOUNT} : &nbsp;<font class="reqmsg">*</font></span></td>
                                                        <td><input type="text" name="fAmount[]" id="fAmount{$smarty.section.i.index}" class="input-rag required decimals" style="width:117px;" title="{$LBL_ENTER} {$LBL_AMOUNT}" value="{$poitems[i].fAmount|formatMoney:true}" readonly='readonly' /></td>
                                                    </tr>
                                                    <tr>
                                                        {if $poitems[i].iOrderLineID < 1}
                                                        {assign var='fVAT' value=$cntrydt[0].fVat}
                                                        {assign var='fOtherTax' value=$cntrydt[0].fOtherTax}
                                                        {else}
                                                        {assign var='fVAT' value=$poitems[i].fVAT}
                                                        {assign var='fOtherTax' value=$poitems[i].fOtherTax1}
                                                        {/if}
                                                        <td><span class="ndcf">{$LBL_VAT} {$LBL_RATE} (%): &nbsp;<font class="reqmsg">*</font></span></td>
                                                        <td><input type="text" name="fVAT[]" id="fVAT{$smarty.section.i.index}" class="input-rag" style="width:117px;" title="{$LBL_ENTER} {$LBL_VAT}" value="{$fVAT}" /></td>
                                                        <td><span class="ndcf">{$LBL_VAT}:</span></td>
                                                        {assign var="vat" value=`$poitems[i].fAmount*$fVAT/100`}
                                                        <td><input type="text" name="vat" id="vat{$smarty.section.i.index}" class="input-rag" style="width:117px;" title="{$LBL_VAT}" readonly="readonly" value="{$vat|formatMoney:true}" /></td>
                                                        <td><span class="ndcf">{$LBL_OTHER_TAX} {$LBL_RATE} (%): </span></td>
                                                        <td><input type="text" name="fOtherTax1[]" id="fOtherTax1{$smarty.section.i.index}" class="input-rag decimals" style="width:117px;" value="{$fOtherTax}" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="ndcf">{$LBL_OTHER_TAX}:</span></td>
                                                        {assign var="otax" value=`$poitems[i].fAmount*$fOtherTax/100`}
                                                        <td><input type="text" name="othertax1" id="othertax1{$smarty.section.i.index}" class="input-rag" style="width:117px;" value="{$otax|formatMoney:true}" readonly="readonly" /></td>
                                                        <td><span class="ndcf">{$LBL_LINE_TOTAL} : </span></td>
                                                        <td><input type="text" name="fLineTotal[]" id="fLineTotal{$smarty.section.i.index}" class="input-rag decimals" style="width:117px;" value="{$poitems[i].fLineTotal|formatMoney:true}" readonly='readonly' /></td>
                                                        <td width="122">{$LBL_CURRENCY} : &nbsp;</td>
                                                        <td>
                                                            <b>{$podtls[0].vCurrency}</b>
                                                            <input type="hidden" name="itemCode[]" id="vItemCode{$smarty.section.i.index}" class="input-rag required" style="width:188px;" title="{$LBL_ENTER} {$LBL_ITEM_CODE}" value="{$poitems[i].vItemCode}" {if $view eq 'edit'}readonly="readonly"{/if} />
                                                        </td>
                                                        <!--</td>-->
                                                    </tr>
                                                    <tr><td colspan="3">&nbsp;</td></tr>
                                                    <tr>
                                                        <td colspan="2"><span class="ndcf"><b>{$LBL_DISCOUNT} / {$LBL_CHARGE} :- </b> &nbsp; <select id="eSublineType{$smarty.section.i.index}" name="eSublineType[]"><option value="">None</option><option value="Discount" {if $poitems[i].eSublineType eq 'Discount'}selected="selected"{/if} >Discount</option><option value="Charge" {if $poitems[i].eSublineType eq 'Charge'}selected="selected"{/if}>Charge</option></select></span></td>
                                                        <td colspan="4">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="ndcf">{$LBL_QUANTITY} : </span></td>
                                                        <td><input type="text" name="iSubQuantity[]" id="iSubQuantity{$smarty.section.i.index}" class="input-rag decimals" style="width:117px;" value="{if $poitems[i].eSublineType eq ''}0{else}{$poitems[i].iSubQuantity}{/if}" /></td>
                                                        <td><span class="ndcf">{$LBL_RATE} : </span></td>
                                                        <td><input type="text" name="fSubRate[]" id="fSubRate{$smarty.section.i.index}" class="input-rag" style="width:117px;" value="{if $poitems[i].eSublineType eq ''}0{else}{$poitems[i].fSubRate}{/if}" /></td>
                                                        <td colspan="2"><input type="hidden" name="fSubAmount[]" id="fSubAmount{$smarty.section.i.index}" class="input-rag" style="width:117px;" value="{if $poitems[i].eSublineType eq ''}0{else}{$poitems[i].fSubAmount}{/if}" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6" align='right'>
                                                            <img src='{$SITE_IMAGES}sm_images/btn-close.gif' name='close' value='close' onclick="$('#adb').hide(); closeRow('{$smarty.section.i.index}')" />{*} &nbsp;
                                                            <img src='{$SITE_IMAGES}sm_images/btn-remove.gif' name='remove' value='remove' onclick="removeRow('Div{$smarty.section.i.index}')" />{*}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6"><hr style="border-style: dashed;"/></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        {elseif $poitems[i].eOrderType eq 'Charge'}
                                        <tr>
                                            <td width="108">{$LBL_LINE_TYPE} : &nbsp;<font class="reqmsg">*</font></td>
                                            <td width="281">
                                                <input type="hidden" name="iOrderLineID[]" id="iOrderLineID{$poitems[i].vItemCode}" value="{$poitems[i].iOrderLineID}" />
                                                <span id="ordtype">
                                                    {*$orderTypes*}
                                                    <select name="eOrderType[]" id="eOrderType{$smarty.section.i.index}" class="required" >
                                                        {section name="l" loop=$orderTypes}
                                                        <option value="{$orderTypes[l]}" {if $orderTypes[l] eq $poitems[i].eOrderType}selected="selected"{/if}>{$orderTypes[l]}</option>
                                                        {/section}
                                                    </select>
                                                </span>
                                            </td>
                                            <!--<td width="122">{$LBL_CURRENCY} : &nbsp;</td>
                                            <td>
                                                <b>{$podtls[0].vCurrency}</b>
                                                <input type="hidden" name="itemCode[]" id="vItemCode{$smarty.section.i.index}" class="input-rag required" style="width:188px;" title="{$LBL_ENTER} {$LBL_ITEM_CODE}" value="{$poitems[i].vItemCode}" {if $view eq 'edit'}readonly="readonly"{/if} />
                                        </td>-->
                                            <td width="122">{$LBL_PART_NO} : &nbsp;</td>
                                            <td>
                                                <b>{$podtls[0].vPartNo}</b>
                                                <input type="text" name="vPartNo[]" id="vPartNo{$smarty.section.i.index}" class="input-rag" style="width:188px;" title="{$LBL_ENTER} {$LBL_PART_NO}" value="{$poitems[i].vPartNo}" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top">{$LBL_DESCRIPTION} : </td>
                                        <td><textarea name="tDescription[]" id="tDescription{$smarty.section.i.index}" class="input-rag" style="width:188px; height: 73px;"  >{$poitems[i].tDescription|stripslashes}</textarea></td>
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
                                            <table width="100%">
                                                <tr>
                                                    <td style="display:none;"><span class="ndcf">{$LBL_QUANTITY} : &nbsp;<font class="reqmsg">*</font></span></td>
                                                    <td style="display:none;"><input type="text" name="iQuantity[]" id="iQuantity{$smarty.section.i.index}" class="input-rag required digits" style="width:117px;" title="{$LBL_ENTER} {$LBL_QUANTITY}" value="{$poitems[i].iQuantity}"/></td>
                                                    <td width="12.5"><span class="dcr">{$LBL_RATE} : &nbsp;<font class="reqmsg">*</font></span></td>
                                                    <td width="149"><input type="text" name="fPrice[]" id="fPrice{$smarty.section.i.index}" class="input-rag required decimals" style="width:117px;" title="{$LBL_ENTER} {$LBL_PRICE}" value="{$poitems[i].fPrice|formatMoney:true}" /></td>
                                                    <td><span class="ndcf">{$LBL_AMOUNT} : &nbsp;<font class="reqmsg">*</font></span></td>
                                                    <td><input type="text" name="fAmount[]" id="fAmount{$smarty.section.i.index}" class="input-rag required decimals" style="width:117px;" title="{$LBL_ENTER} {$LBL_AMOUNT}" value="{$poitems[i].fAmount|formatMoney:true}" readonly='readonly' /></td>
                                                </tr>
                                                <tr>
                                                    {if $poitems[i].iOrderLineID < 1}
                                                    {assign var='fVAT' value=$cntrydt[0].fVat}
                                                    {assign var='fOtherTax' value=$cntrydt[0].fOtherTax}
                                                    {else}
                                                    {assign var='fVAT' value=$poitems[i].fVAT}
                                                    {assign var='fOtherTax' value=$poitems[i].fOtherTax1}
                                                    {/if}
                                                    <td><span class="ndcf">{$LBL_VAT} {$LBL_RATE} (%): &nbsp;<font class="reqmsg">*</font></span></td>
                                                    <td><input type="text" name="fVAT[]" id="fVAT{$smarty.section.i.index}" class="input-rag" style="width:117px;" title="{$LBL_ENTER} {$LBL_VAT}" value="{$fVAT}" /></td>
                                                    <td><span class="ndcf">{$LBL_VAT}:</span></td>
                                                    {assign var="vat" value=`$poitems[i].fAmount*$fVAT/100`}
                                                    <td><input type="text" name="vat" id="vat{$smarty.section.i.index}" class="input-rag" style="width:117px;" title="{$LBL_VAT}" readonly="readonly" value="{$vat|formatMoney:true}" /></td>
                                                    <td><span class="ndcf">{$LBL_OTHER_TAX} {$LBL_RATE} (%): </span></td>
                                                    <td><input type="text" name="fOtherTax1[]" id="fOtherTax1{$smarty.section.i.index}" class="input-rag decimals" style="width:117px;" value="{$fOtherTax}" /></td>
                                                </tr>
                                                <tr>
                                                    <td><span class="ndcf">{$LBL_OTHER_TAX}:</span></td>
                                                    {assign var="otax" value=`$poitems[i].fAmount*$fOtherTax/100`}
                                                    <td><input type="text" name="othertax1" id="othertax1{$smarty.section.i.index}" class="input-rag" style="width:117px;" value="{$otax|formatMoney:true}" readonly="readonly" /></td>
                                                    <td><span class="ndcf">{$LBL_LINE_TOTAL} : </span></td>
                                                    <td><input type="text" name="fLineTotal[]" id="fLineTotal{$smarty.section.i.index}" class="input-rag decimals" style="width:117px;" value="{$poitems[i].fLineTotal|formatMoney:true}" readonly='readonly' /></td>
                                                    <td width="122">{$LBL_CURRENCY} : &nbsp;</td>
                                                    <td>
                                                        <b>{$podtls[0].vCurrency}</b>
                                                        <input type="hidden" name="itemCode[]" id="vItemCode{$smarty.section.i.index}" class="input-rag required" style="width:188px;" title="{$LBL_ENTER} {$LBL_ITEM_CODE}" value="{$poitems[i].vItemCode}" {if $view eq 'edit'}readonly="readonly"{/if} />
                                                    </td>
                                                    <!--</td>-->
                                                </tr>
                                                <tr><td colspan="3">&nbsp;</td></tr>
                                                <tr>
                                                    <td colspan="2"><span class="ndcf"><b>{$LBL_DISCOUNT} / {$LBL_CHARGE} :- </b> &nbsp; <select id="eSublineType{$smarty.section.i.index}" name="eSublineType[]"><option value="">None</option><option value="Discount" {if $poitems[i].eSublineType eq 'Discount'}selected="selected"{/if} >Discount</option><option value="Charge" {if $poitems[i].eSublineType eq 'Charge'}selected="selected"{/if}>Charge</option></select></span></td>
                                                    <td colspan="4">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td><span class="ndcf">{$LBL_QUANTITY} : </span></td>
                                                    <td><input type="text" name="iSubQuantity[]" id="iSubQuantity{$smarty.section.i.index}" class="input-rag decimals" style="width:117px;" value="{if $poitems[i].eSublineType eq ''}0{else}{$poitems[i].iSubQuantity}{/if}" /></td>
                                                    <td><span class="ndcf">{$LBL_RATE} : </span></td>
                                                    <td><input type="text" name="fSubRate[]" id="fSubRate{$smarty.section.i.index}" class="input-rag" style="width:117px;" value="{if $poitems[i].eSublineType eq ''}0{else}{$poitems[i].fSubRate}{/if}" /></td>
                                                    <td colspan="2"><input type="hidden" name="fSubAmount[]" id="fSubAmount{$smarty.section.i.index}" class="input-rag" style="width:117px;" value="{if $poitems[i].eSublineType eq ''}0{else}{$poitems[i].fSubAmount}{/if}" /></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6" align='right'>
                                                        <img src='{$SITE_IMAGES}sm_images/btn-close.gif' name='close' value='close' onclick="$('#adb').hide(); closeRow('{$smarty.section.i.index}')" />{*} &nbsp;
                                                        <img src='{$SITE_IMAGES}sm_images/btn-remove.gif' name='remove' value='remove' onclick="removeRow('Div{$smarty.section.i.index}')" />{*}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6"><hr style="border-style: dashed;"/></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    {else}
                                    <tr>
                                        <td width="108">{$LBL_LINE_TYPE} : &nbsp;<font class="reqmsg">*</font></td>
                                        <td width="281">
                                            <input type="hidden" name="iOrderLineID[]" id="iOrderLineID{$poitems[i].vItemCode}" value="{$poitems[i].iOrderLineID}" />
                                            <span id="ordtype">
                                                {*$orderTypes*}
                                                <select name="eOrderType[]" id="eOrderType{$smarty.section.i.index}" class="required" >
                                                    {section name="l" loop=$orderTypes}
                                                    <option value="{$orderTypes[l]}" {if $orderTypes[l] eq $poitems[i].eOrderType}selected="selected"{/if}>{$orderTypes[l]}</option>
                                                    {/section}
                                                </select>
                                            </span>
                                        </td>
                                        <!--<td width="122">{$LBL_CURRENCY} : &nbsp;</td>
                                        <td>
                                            <b>{$podtls[0].vCurrency}</b>
                                            <input type="hidden" name="itemCode[]" id="vItemCode{$smarty.section.i.index}" class="input-rag required" style="width:188px;" title="{$LBL_ENTER} {$LBL_ITEM_CODE}" value="{$poitems[i].vItemCode}" {if $view eq 'edit'}readonly="readonly"{/if} />
                                    </td>-->
                                        <td width="122">{$LBL_PART_NO} : &nbsp;</td>
                                        <td>
                                            <b>{$podtls[0].vPartNo}</b>
                                            <input type="text" name="vPartNo[]" id="vPartNo{$smarty.section.i.index}" class="input-rag" style="width:188px;" title="{$LBL_ENTER} {$LBL_PART_NO}" value="{$poitems[i].vPartNo}" />
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top">{$LBL_DESCRIPTION} : </td>
                                    <td><textarea name="tDescription[]" id="tDescription{$smarty.section.i.index}" class="input-rag" style="width:188px; height: 73px;"  >{$poitems[i].tDescription|stripslashes}</textarea></td>
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
                                        <table width="100%">
                                            <tr>
                                                <td style="display:none;"><span class="ndcf">{$LBL_QUANTITY} : &nbsp;<font class="reqmsg">*</font></span></td>
                                                <td style="display:none;"><input type="text" name="iQuantity[]" id="iQuantity{$smarty.section.i.index}" class="input-rag required digits" style="width:117px;" title="{$LBL_ENTER} {$LBL_QUANTITY}" value="{$poitems[i].iQuantity}"/></td>
                                                <td width="111"><span class="dcr">{$LBL_PRICE} : &nbsp;<font class="reqmsg">*</font></span></td>
                                                <td width="149"><input type="text" name="fPrice[]" id="fPrice{$smarty.section.i.index}" class="input-rag required decimals" style="width:117px;" title="{$LBL_ENTER} {$LBL_PRICE}" value="{$poitems[i].fPrice|formatMoney:true}" /></td>
                                                <td><span class="ndcf">{$LBL_AMOUNT} : &nbsp;<font class="reqmsg">*</font></span></td>
                                                <td><input type="text" name="fAmount[]" id="fAmount{$smarty.section.i.index}" class="input-rag required decimals" style="width:117px;" title="{$LBL_ENTER} {$LBL_AMOUNT}" value="{$poitems[i].fAmount|formatMoney:true}" readonly='readonly' /></td>
                                            </tr>
                                            <tr>
                                                {if $poitems[i].iOrderLineID < 1}
                                                {assign var='fVAT' value=$cntrydt[0].fVat}
                                                {assign var='fOtherTax' value=$cntrydt[0].fOtherTax}
                                                {else}
                                                {assign var='fVAT' value=$poitems[i].fVAT}
                                                {assign var='fOtherTax' value=$poitems[i].fOtherTax1}
                                                {/if}
                                                <td><span class="ndcf">{$LBL_VAT} {$LBL_RATE} (%): &nbsp;<font class="reqmsg">*</font></span></td>
                                                <td><input type="text" name="fVAT[]" id="fVAT{$smarty.section.i.index}" class="input-rag" style="width:117px;" title="{$LBL_ENTER} {$LBL_VAT}" value="{$fVAT}" /></td>
                                                <td><span class="ndcf">{$LBL_VAT}:</span></td>
                                                {assign var="vat" value=`$poitems[i].fAmount*$fVAT/100`}
                                                <td><input type="text" name="vat" id="vat{$smarty.section.i.index}" class="input-rag" style="width:117px;" title="{$LBL_VAT}" readonly="readonly" value="{$vat|formatMoney:true}" /></td>
                                                <td><span class="ndcf">{$LBL_OTHER_TAX} {$LBL_RATE} (%): </span></td>
                                                <td><input type="text" name="fOtherTax1[]" id="fOtherTax1{$smarty.section.i.index}" class="input-rag decimals" style="width:117px;" value="{$fOtherTax}" /></td>
                                            </tr>
                                            <tr>
                                                <td><span class="ndcf">{$LBL_OTHER_TAX}:</span></td>
                                                {assign var="otax" value=`$poitems[i].fAmount*$fOtherTax/100`}
                                                <td><input type="text" name="othertax1" id="othertax1{$smarty.section.i.index}" class="input-rag" style="width:117px;" value="{$otax|formatMoney:true}" readonly="readonly" /></td>
                                                <td><span class="ndcf">{$LBL_LINE_TOTAL} : </span></td>
                                                <td><input type="text" name="fLineTotal[]" id="fLineTotal{$smarty.section.i.index}" class="input-rag decimals" style="width:117px;" value="{$poitems[i].fLineTotal|formatMoney:true}" readonly='readonly' /></td>
                                                <td width="122">{$LBL_CURRENCY} : &nbsp;</td>
                                                <td>
                                                    <b>{$podtls[0].vCurrency}</b>
                                                    <input type="hidden" name="itemCode[]" id="vItemCode{$smarty.section.i.index}" class="input-rag required" style="width:188px;" title="{$LBL_ENTER} {$LBL_ITEM_CODE}" value="{$poitems[i].vItemCode}" {if $view eq 'edit'}readonly="readonly"{/if} />
                                                </td>
                                                <!--</td>-->
                                            </tr>
                                            <tr><td colspan="3">&nbsp;</td></tr>
                                            <tr>
                                                <td colspan="2"><span class="ndcf"><b>{$LBL_DISCOUNT} / {$LBL_CHARGE} :- </b> &nbsp; <select id="eSublineType{$smarty.section.i.index}" name="eSublineType[]"><option value="">None</option><option value="Discount" {if $poitems[i].eSublineType eq 'Discount'}selected="selected"{/if} >Discount</option><option value="Charge" {if $poitems[i].eSublineType eq 'Charge'}selected="selected"{/if}>Charge</option></select></span></td>
                                                <td colspan="4">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td><span class="ndcf">{$LBL_QUANTITY} : </span></td>
                                                <td><input type="text" name="iSubQuantity[]" id="iSubQuantity{$smarty.section.i.index}" class="input-rag decimals" style="width:117px;" value="{if $poitems[i].eSublineType eq ''}0{else}{$poitems[i].iSubQuantity}{/if}" /></td>
                                                <td><span class="ndcf">{$LBL_RATE} : </span></td>
                                                <td><input type="text" name="fSubRate[]" id="fSubRate{$smarty.section.i.index}" class="input-rag" style="width:117px;" value="{if $poitems[i].eSublineType eq ''}0{else}{$poitems[i].fSubRate}{/if}" /></td>
                                                <td colspan="2"><input type="hidden" name="fSubAmount[]" id="fSubAmount{$smarty.section.i.index}" class="input-rag" style="width:117px;" value="{if $poitems[i].eSublineType eq ''}0{else}{$poitems[i].fSubAmount}{/if}" /></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align='right'>
                                                    <img src='{$SITE_IMAGES}sm_images/btn-close.gif' name='close' value='close' onclick="$('#adb').hide(); closeRow('{$smarty.section.i.index}')" />{*} &nbsp;
                                                    <img src='{$SITE_IMAGES}sm_images/btn-remove.gif' name='remove' value='remove' onclick="removeRow('Div{$smarty.section.i.index}')" />{*}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="6">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6"><hr style="border-style: dashed;"/></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                {/if}
                            </table>
                        </div>
                    </td>
                </tr>
                {sectionelse}
                <tr>
                    <td>
                        <div id="Div0">
                            <table id="tbl0" width="100%" border="0" cellspacing="5" cellpadding="0">
                                {*}<tr>
                                    <td>{$LBL_INVOICE} : </td>
                                    <td>
                                        <input type="text" name="invoice" class="input-rag" id="invoice00" title="{$LBL_ENTER} {$LBL_INVOICE}" style="width:117px;" value="{$poitems[i].vInvoiceCode}" />
                                        <input type="hidden" name="iInvoiceID[]" id="iInvoiceID" class="input-rag" style="width:117px;" title="{$LBL_ENTER} {$LBL_INVOICE}" value="{$poitems[i].iInvoiceID}" />
                                    </td>
                                    <td>{$LBL_INV_REL_LINE} : </td>
                                    <td>
                                        <input type="text" name="InvItemCode" class="input-rag" id="InvItemCode00" title="{$LBL_ENTER} {$LBL_INV_REL_LINE}" style="width:117px;" value="{$poitems[i].vInvItemCode}" />
                                        <input type="hidden" name="iRelatedInvoiceLineID[]" id="iRelatedInvoiceLineID" class="input-rag" style="width:117px;" title="{$LBL_ENTER} {$LBL_INV_REL_LINE}" value="{$poitems[i].iRelatedInvoiceLineID}"/>
                                    </td>
                                </tr>{*}
                                <tr>
                                    <td width="108">{$LBL_LINE_TYPE} : &nbsp;<font class="reqmsg">*</font></td>
                                    <td width="281">
                                        <input type="hidden" name="iOrderLineID[]" id="iOrderLineID{$poitems[i].vItemCode}" value="{$poitems[i].iOrderLineID}" />
                                        <span id="ordtype">
                                            {*$orderTypes*}
                                            <select name="eOrderType[]" id="eOrderType{$smarty.section.i.index}" class="required" >
                                                {section name="l" loop=$orderTypes}
                                                <option value="{$orderTypes[l]}" {if $orderTypes[l] eq $poitems[i].eOrderType}selected="selected"{/if}>{$orderTypes[l]}</option>
                                                {/section}
                                            </select>
                                        </span>
                                    </td>
                                    <!--<td width="122">{$LBL_CURRENCY} : &nbsp;</td>
                                    <td>
                                        <b>{$podtls[0].vCurrency}</b>
                                    </td>-->
                                    <td width="122">{$LBL_PART_NO} : &nbsp;</td>
                                    <td>
                                        <input type="text" name="vPartNo" class="input-rag" id="InvItemCode00" title="{$LBL_ENTER} {$LBL_PART_NO}" style="width:117px;" value="{$poitems[i].vPartNo}" />
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top">{$LBL_DESCRIPTION} : </td>
                                    <td><textarea name="tDescription[]" id="tDescription{$smarty.section.i.index}" class="input-rag" style="width:188px; height: 73px;"  >{$poitems[i].tDescription|stripslashes}</textarea></td>
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
                                        <table width="100%">
                                            <tr>
                                                <td width="108">{$LBL_QUANTITY} : &nbsp;<font class="reqmsg">*</font></td>
                                                <td width="154"><input type="text" name="iQuantity[]" id="iQuantity{$smarty.section.i.index}" class="input-rag required digits" style="width:117px;" title="{$LBL_ENTER} {$LBL_QUANTITY}" value="{$poitems[i].iQuantity}"/></td>
                                                <td width="111">{$LBL_PRICE} : &nbsp;<font class="reqmsg">*</font></td>
                                                <td width="149"><input type="text" name="fPrice[]" id="fPrice{$smarty.section.i.index}" class="input-rag required decimals" style="width:117px;" title="{$LBL_ENTER} {$LBL_PRICE}" value="{$poitems[i].fPrice}" /></td>
                                                <td>{$LBL_AMOUNT} : &nbsp;<font class="reqmsg">*</font></td>
                                                <td><input type="text" name="fAmount[]" id="fAmount{$smarty.section.i.index}" class="input-rag required decimals" style="width:117px;" title="{$LBL_ENTER} {$LBL_AMOUNT}" value="{$poitems[i].fAmount}" /></td>
                                            </tr>
                                            <tr>
                                                {if $poitems[i].iOrderLineID < 1}
                                                {assign var='fVAT' value=$cntrydt[0].fVat}
                                                {assign var='fOtherTax' value=$cntrydt[0].fOtherTax}
                                                {else}
                                                {assign var='fVAT' value=$poitems[i].fVAT}
                                                {assign var='fOtherTax' value=$poitems[i].fOtherTax1}
                                                {/if}
                                                <td width="108">{$LBL_VAT} {$LBL_RATE} (%): &nbsp;<font class="reqmsg">*</font></td>
                                                <td width="154">
                                                    <input type="text" name="fVAT[]" id="fVAT{$smarty.section.i.index}" class="input-rag required decimals" style="width:117px;" title="{$LBL_ENTER} {$LBL_VAT}" value="{$fVAT}" /></td>
                                                <td width="111">{$LBL_VAT}:</td>
                                                <td width="190">
                                                    {assign var="vat" value=`$poitems[i].fAmount*$fVAT/100`}
                                                    <input type="text" name="vat" id="vat{$smarty.section.i.index}" class="input-rag" style="width:117px;" title="{$LBL_VAT}" readonly="readonly" value="{$vat}" />
                                                </td>
                                                <td>{$LBL_OTHER_TAX} {$LBL_RATE} (%): </td>
                                                <td><input type="text" name="fOtherTax1[]" id="fOtherTax1{$smarty.section.i.index}" class="input-rag decimals" style="width:117px;" value="{$fOtherTax}" /></td>
                                            </tr>
                                            <tr>
                                                <td width="108">{$LBL_OTHER_TAX}:</td>
                                                <td width="154">
                                                    {assign var="otax" value=`$poitems[i].fAmount*$fOtherTax/100`}
                                                    <input type="text" name="othertax1" id="othertax1{$smarty.section.i.index}" class="input-rag" style="width:117px;" value="{$otax}" readonly="readonly" />
                                                </td>
                                                <td>{$LBL_LINE_TOTAL} : </td>
                                                <td><input type="text" name="fLineTotal[]" id="fLineTotal{$smarty.section.i.index}" class="input-rag decimals" style="width:117px;" value="{$poitems[i].fLineTotal}" readonly='readonly' /></td>
                                                <td width="122">{$LBL_CURRENCY} : &nbsp;</td>
                                                <td>
                                                    <b>{$podtls[0].vCurrency}</b>
                                                    <input type="hidden" name="itemCode[]" id="vItemCode{$smarty.section.i.index}" class="input-rag required" style="width:188px;" title="{$LBL_ENTER} {$LBL_ITEM_CODE}" value="{$poitems[i].vItemCode}" {if $view eq 'edit'}readonly="readonly"{/if} />
                                                </td>
                                                <!--</td>-->
                                            </tr>
                                            <tr>
                                                <td colspan="6" align='right'>
                                                    <img src='{$SITE_IMAGES}sm_images/btn-close.gif' name='close' value='close' onclick="$('#adb').hide(); closeRow('{$smarty.section.i.index}')" />{*} &nbsp;
                                                    <img src='{$SITE_IMAGES}sm_images/btn-remove.gif' name='remove' value='remove' onclick="removeRow('Div{$smarty.section.i.index}')" />{*}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="6">&nbsp;</td>
                                            </tr>
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
                {/section}
                <tr>
                    <td>
                        <table width="100%" border="0" cellspacing="5" cellpadding="0">
                            <tr>
                                <td colspan="6"><div id="addNew"></div></td>
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
                                            <span style="display:inline-block; height:10px; width:6px; padding:1px; margin:0px;">&nbsp;</span>
                                            <!--<span style="display:inline-block; height:10px; width:50px; padding:1px; margin:0px;">{$LBL_LINE_TYPE}</span>-->
                                            <span style="display:inline-block; height:10px; width:120px; padding:1px; margin:0px;">{$LBL_DESCRIPTION}</span>
                                            <span style="display:inline-block; height:10px; width:60px; padding:1px; margin:0px;">{$LBL_PART_NO}</span>
                                            <span style="display:inline-block; height:10px; width:70px; padding:1px; margin:0px;">{*$LBL_UNIT_MEASURE*}UOM</span>
                                            <span style="display:inline-block; height:10px; width:35px; padding:1px; margin:0px; text-align:right;">{*$LBL_QUANTITY*}Qty</span>
                                            <span style="display:inline-block; height:10px; width:70px; padding:1px; margin:0px; text-align:right;">{$LBL_PRICE} / {$LBL_RATE}</span>
                                            <span style="display:inline-block; height:10px; width:95px; padding:1px; margin:0px; text-align:right;">{$LBL_AMOUNT}</span>
                                            <span style="display:inline-block; height:10px; width:73px; padding:1px; margin:0px; text-align:right;">{$LBL_VAT}</span>
                                            <span style="display:inline-block; height:10px; width:77px; padding:1px; margin:0px; text-align:right;">{$LBL_OTHER_TAX}</span>
                                            <span style="display:inline-block; height:10px; width:97px; margin:0px; padding:1px; text-align:right;">{$LBL_LINE_TOTAL}</span>
                                            <span style="display:inline-block; padding:1px; height:10px; margin:0px; text-align:right;">&nbsp;</span>
                                        </b>
                                        <div id="dlines">
                                            {section name="i" loop=$poitems}
                                            <div id="spnd{$smarty.section.i.index}">
                                                {if $poitems[i].eOrderType eq 'Discount'}
                                                <span style='display:inline-block; height:10px; width:6px; padding:1px; margin:0px;' class='ar'> <img src='{$SITE_IMAGES}sm_images/arrow-orange.gif' />  </span>
                                                <span style='display:inline-block; height:10px; width:50px; padding:1px; margin:0px;display: none;' class='ot'>{$poitems[i].eOrderType}</span>
                                                <span style='display:inline-block; height:10px; width:120px; padding:1px; margin:0px; word-wrap:break-word;' class='td'>{$poitems[i].tDescription|stripslashes}</span>
                                                <span style='display:inline-block; height:10px; width:60px; padding:1px; margin:0px;' class='vp'>{$poitems[i].vPartNo}</span>
                                                <span style='display:inline-block; height:10px; width:70px; padding:1px; margin:0px;' class='um'>{*$poitems[i].vUnitOfMeasure*}</span>
                                                <span style='display:inline-block; height:10px; width:35px; padding:1px; margin:0px; text-align:right;' class='iq'>{*$poitems[i].iQuantity*}</span>
                                                <span style='display:inline-block; height:10px; width:80px; padding:1px; margin:0px; text-align:right;' class='fp'>{$poitems[i].fPrice|formatMoney:true}%</span>
                                                <span style='display:inline-block; height:10px; width:85px; padding:1px; margin:0px; text-align:right;' class='fa'>{$poitems[i].fAmount|formatMoney:true}</span>
                                                <span style='display:inline-block; height:10px; width:75px; padding:1px; margin:0px; text-align:right;' class='fv'>{*assign var="vt" value=`$poitems[i].fVAT*$poitems[i].fAmount/100`}{$vt|formatMoney:true*}</span>
                                                <span style='display:inline-block; height:10px; width:75px; padding:1px; margin:0px; text-align:right;' class='ox'>{*assign var="ot" value=`$poitems[i].fOtherTax1*$poitems[i].fAmount/100`}{$ot|formatMoney:true*}</span>
                                                <span style='display:inline-block; height:10px; width:98px; padding:1px; margin:0px; text-align:right;' class='lt'>{$poitems[i].fLineTotal|formatMoney:true}</span>
                                                <span style='display:inline-block; height:10px; padding:1px; margin:0px; text-align:right;' class='at'>
                                                    &nbsp; <img src='{$SITE_IMAGES}sm_images/icon-pen.gif' onclick='edt="y"; shwtbl({$smarty.section.i.index});' />&nbsp;<img src='{$SITE_IMAGES}sm_images/icon-cancel.gif' onclick='deltbl({$smarty.section.i.index});' />
                                                </span>
                                                <div id="subli" style="display:{if $poitems[i].eSublineType neq 'Discount' && $poitems[i].eSublineType neq 'Charge'}none{/if}; padding:3px; padding-left:19px;">
                                                    <!--{*<div id="spsli">*}-->
                                                    <span style='display:inline-block; height:10px; width:226px; margin:0px; text-align:left;' class="sltyp">{$poitems[i].eSublineType} </span>
                                                    <span class="slqt" style="display:inline-block; height:10px; width:71px; margin:0px; text-align:right;"><span class="sqt">{$poitems[i].iSubQuantity}</span></span> &nbsp;&nbsp;&nbsp;
                                                    <span class="slrt" style="display:inline-block; height:10px; width:71px; margin:0px; text-align:right;"><span class="srt">{$poitems[i].fSubRate|toFixed}%</span></span> &nbsp;&nbsp;&nbsp;
                                                    <!--{*<span class="slrt" style="display:none; height:10px; width:230px; padding-left:570px; margin:0px; text-align:left;"><label style="width:170px; font-weight:bold; display:inline-block;">Amount:</label> &nbsp; 100</span>*}-->
                                                    <span class="sltl" style="display:inline-block; height:10px; width:75px; margin:0px; text-align:right;"><span class="stl">{$poitems[i].fSubAmount}</span></span>

                                                    <span class="slvt" style="display:inline-block; height:10px; width:77px; margin:0px; text-align:right;"><span class="slv">{$poitems[i].fSubVat}</span></span>
                                                    <span class="slot" style="display:inline-block; height:10px; width:77px; margin:0px; text-align:right;"><span class="slo">{$poitems[i].fSubOtherTax}</span></span>
                                                    <span class="sltt" style="display:inline-block; height:10px; width:100px; margin:0px; text-align:right;"><span class="slf">{$poitems[i].fSubTotal}</span></span>
                                                    <!--{*</div>*}-->
                                                </div>
                                                {elseif $poitems[i].eOrderType eq 'Charge'}
                                                <span style='display:inline-block; height:10px; width:6px; padding:1px; margin:0px;' class='ar'> <img src='{$SITE_IMAGES}sm_images/arrow-orange.gif' />  </span>
                                                <span style='display:inline-block; height:10px; width:50px; padding:1px; margin:0px;display: none;' class='ot'>{$poitems[i].eOrderType}</span>
                                                <span style='display:inline-block; height:10px; width:120px; padding:1px; margin:0px; word-wrap:break-word;' class='td'>{$poitems[i].tDescription|stripslashes}</span>
                                                <span style='display:inline-block; height:10px; width:60px; padding:1px; margin:0px;' class='vp'>{$poitems[i].vPartNo}</span>
                                                <span style='display:inline-block; height:10px; width:70px; padding:1px; margin:0px;' class='um'>{*$poitems[i].vUnitOfMeasure*}</span>
                                                <span style='display:inline-block; height:10px; width:35px; padding:1px; margin:0px; text-align:right;' class='iq'>{*$poitems[i].iQuantity*}</span>
                                                <span style='display:inline-block; height:10px; width:80px; padding:1px; margin:0px; text-align:right;' class='fp'>{$poitems[i].fPrice|formatMoney:true}</span>
                                                <span style='display:inline-block; height:10px; width:85px; padding:1px; margin:0px; text-align:right;' class='fa'>{$poitems[i].fAmount|formatMoney:true}</span>
                                                <span style='display:inline-block; height:10px; width:75px; padding:1px; margin:0px; text-align:right;' class='fv'>{*assign var="vt" value=`$poitems[i].fVAT*$poitems[i].fAmount/100`}{$vt|formatMoney:true*}</span>
                                                <span style='display:inline-block; height:10px; width:75px; padding:1px; margin:0px; text-align:right;' class='ox'>{*assign var="ot" value=`$poitems[i].fOtherTax1*$poitems[i].fAmount/100`}{$ot|formatMoney:true*}</span>
                                                <span style='display:inline-block; height:10px; width:98px; padding:1px; margin:0px; text-align:right;' class='lt'>{$poitems[i].fLineTotal|formatMoney:true}</span>
                                                <span style='display:inline-block; height:10px; padding:1px; margin:0px; text-align:right;' class='at'>
                                                    &nbsp; <img src='{$SITE_IMAGES}sm_images/icon-pen.gif' onclick='edt="y"; shwtbl({$smarty.section.i.index});' />&nbsp;<img src='{$SITE_IMAGES}sm_images/icon-cancel.gif' onclick='deltbl({$smarty.section.i.index});' />
                                                </span>
                                                <div id="subli" style="display:{if $poitems[i].eSublineType neq 'Discount' && $poitems[i].eSublineType neq 'Charge'}none{/if}; padding:3px; padding-left:12px;">
                                                    <!--{*<div id="spsli">*}-->
                                                    <span style='display:inline-block; height:10px; width:226px; margin:0px; text-align:left;' class="sltyp">{$poitems[i].eSublineType} </span>
                                                    <span class="slqt" style="display:inline-block; height:10px; width:70px; margin:0px; text-align:right;"><span class="sqt">{$poitems[i].iSubQuantity}</span></span> &nbsp;&nbsp;&nbsp;
                                                    <span class="slrt" style="display:inline-block; height:10px; width:71px; margin:0px; text-align:right;"><span class="srt">{$poitems[i].fSubRate|toFixed}%</span></span> &nbsp;&nbsp;&nbsp;
                                                    <!--{*<span class="slrt" style="display:none; height:10px; width:230px; padding-left:570px; margin:0px; text-align:left;"><label style="width:170px; font-weight:bold; display:inline-block;">Amount:</label> &nbsp; 100</span>*}-->
                                                    <span class="sltl" style="display:inline-block; height:10px; width:75px; margin:0px; text-align:right;"><span class="stl">{$poitems[i].fSubAmount}</span></span>

                                                    <span class="slvt" style="display:inline-block; height:10px; width:77px; margin:0px; text-align:right;"><span class="slv">{$poitems[i].fSubVat}</span></span>
                                                    <span class="slot" style="display:inline-block; height:10px; width:77px; margin:0px; text-align:right;"><span class="slo">{$poitems[i].fSubOtherTax}</span></span>
                                                    <span class="sltt" style="display:inline-block; height:10px; width:100px; margin:0px; text-align:right;"><span class="slf">{$poitems[i].fSubTotal}</span></span>
                                                    <!--{*</div>*}-->
                                                </div>
                                                {else}
                                                <span style='display:inline-block; height:10px; width:6px; padding:1px; margin:0px;' class='ar'> <img src='{$SITE_IMAGES}sm_images/arrow-orange.gif' />  </span>
                                                <span style='display:inline-block; height:10px; width:50px; padding:1px; margin:0px;display: none;' class='ot'>{$poitems[i].eOrderType}</span>
                                                <span style='display:inline-block; height:10px; width:120px; padding:1px; margin:0px; word-wrap:break-word;' class='td'>{$poitems[i].tDescription|stripslashes}</span>
                                                <span style='display:inline-block; height:10px; width:60px; padding:1px; margin:0px;' class='vp'>{$poitems[i].vPartNo}</span>
                                                <span style='display:inline-block; height:10px; width:70px; padding:1px; margin:0px;' class='um'>{$poitems[i].vUnitOfMeasure}</span>
                                                <span style='display:inline-block; height:10px; width:35px; padding:1px; margin:0px; text-align:right;' class='iq'>{$poitems[i].iQuantity|number_format:false}</span>
                                                <span style='display:inline-block; height:10px; width:70px; padding:1px; margin:0px; text-align:right;' class='fp'>{$poitems[i].fPrice|formatMoney:true}</span>
                                                <span style='display:inline-block; height:10px; width:95px; padding:1px; margin:0px; text-align:right;' class='fa'>{$poitems[i].fAmount|formatMoney:true}</span>
                                                <span style='display:inline-block; height:10px; width:75px; padding:1px; margin:0px; text-align:right;' class='fv'>{assign var="vt" value=`$poitems[i].fVAT*$poitems[i].fAmount/100`}{$vt|formatMoney:true}</span>
                                                <span style='display:inline-block; height:10px; width:75px; padding:1px; margin:0px; text-align:right;' class='ox'>{assign var="ot" value=`$poitems[i].fOtherTax1*$poitems[i].fAmount/100`}{$ot|formatMoney:true}</span>
                                                <span style='display:inline-block; height:10px; width:98px; padding:1px; margin:0px; text-align:right;' class='lt'>{$poitems[i].fLineTotal|formatMoney:true}</span>
                                                <span style='display:inline-block; height:10px; padding:1px; margin:0px; text-align:right;' class='at'>
                                                    &nbsp; <img src='{$SITE_IMAGES}sm_images/icon-pen.gif' onclick='edt="y"; shwtbl({$smarty.section.i.index});' />&nbsp;<img src='{$SITE_IMAGES}sm_images/icon-cancel.gif' onclick='deltbl({$smarty.section.i.index});' />
                                                </span>
                                                <div id="subli" style="display:{if $poitems[i].eSublineType neq 'Discount' && $poitems[i].eSublineType neq 'Charge'}none{else}block{/if}; padding:3px; padding-left:12px;">
                                                    <!--{*<div id="spsli">*}-->
                                                    <span style='display:inline-block; height:10px; width:228px; margin:0px; text-align:left;' class="sltyp">{$poitems[i].eSublineType} </span>
                                                    <span class="slqt" style="display:inline-block; height:10px; width:70px; margin:0px; text-align:right;"><span class="sqt">{$poitems[i].iSubQuantity}</span></span> &nbsp;&nbsp;&nbsp;
                                                    <span class="slrt" style="display:inline-block; height:10px; width:69px; margin:0px; text-align:right;"><span class="srt">{$poitems[i].fSubRate|toFixed}%</span></span> &nbsp;&nbsp;&nbsp;
                                                    <!--{*<span class="slrt" style="display:none; height:10px; width:230px; padding-left:570px; margin:0px; text-align:left;"><label style="width:170px; font-weight:bold; display:inline-block;">Amount:</label> &nbsp; 100</span>*}-->
                                                    <span class="sltl" style="display:inline-block; height:10px; width:75px; margin:0px; text-align:right;"><span class="stl">{$poitems[i].fSubAmount}</span></span>

                                                    <span class="slvt" style="display:inline-block; height:10px; width:77px; margin:0px; text-align:right;"><span class="slv">{$poitems[i].fSubVat}</span></span>
                                                    <span class="slot" style="display:inline-block; height:10px; width:77px; margin:0px; text-align:right;"><span class="slo">{$poitems[i].fSubOtherTax}</span></span>
                                                    <span class="sltt" style="display:inline-block; height:10px; width:100px; margin:0px; text-align:right;"><span class="slf">{$poitems[i].fSubTotal}</span></span>
                                                    <!--{*</div>*}-->
                                                </div>
                                                {/if}
                                                {*}<div style='height:1px;'>&nbsp;</div>{*}
                                            </div>
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
                            {*<tr><td colspan="6" align="right" style="padding-right:19px; width:90%;"><span style="display:inline-block;width:70%;"><b>{$LBL_WITH_HOLDING_TAX}</b></span><span style="display:inline-block;width:19px;"> &nbsp; : &nbsp; </span><span id="wtht" style="display:inline-block;width:21%;">0</span><input type="hidden" name="whtaxtotal" id="whtaxtotal" /></td></tr>*}
                            <tr><td colspan="6" align="right" style="padding-right:19px; width:90%;"><span style="display:inline-block;width:70%;"><b>{$LBL_CHARGE}</b></span><span style="display:inline-block;width:19px;"> &nbsp; : &nbsp; </span><span id="chgt" style="display:inline-block;width:21%;">0</span><input type="hidden" name="charge" id="charge" /></td></tr>
							<tr><td colspan="6" align="right" style="padding-right:19px; width:90%;"><span style="display:inline-block;width:70%;"><b>{$LBL_DISCOUNT}</b></span><span style="display:inline-block;width:19px;"> &nbsp; : &nbsp; </span><span id="dist" style="display:inline-block;width:21%;">0</span><input type="hidden" name="discount" id="discount" /></td></tr>
							<tr><td colspan="6" align="right" style="padding-right:19px; width:90%; border-top:1px solid #9a9a9a;"><span style="display:inline-block;width:70%;"><b>{$LBL_NET_AMOUNT}</b></span><span style="display:inline-block;width:19px;"> &nbsp; : &nbsp; </span><span id="namt" style="display:inline-block;width:21%;font-weight:bold;">0</span><input type="hidden" name="nettotal" id="nettotal" /></td></tr>

                            <tr><td colspan="6"><hr style="height:0px; color:#eeeeee;" />&nbsp;</td></tr>

                            <tr>
                                <td height="35" valign="bottom">&nbsp;</td>
                                <td valign="bottom" colspan="5" align="center">
                                    <img src="{$SITE_IMAGES}sm_images/btn-back.gif"  alt="" border="0" id="btnBack" name="Back" style="vertical-align:middle;cursor: pointer;" onclick="back();" />&nbsp;
                                    {*if $podtls[0].eSaved eq 'Yes'}
                                    <img src="{$SITE_IMAGES}save-btn.gif" alt="" border="0"  id="btnSubmit" name="Submit" title="submit" onclick="sbt='y'; return frmsubmit();" style="vertical-align:middle;cursor: pointer;" />&nbsp;
                                    {else}
                                    <img src="{$SITE_IMAGES}sm_images/btn-submit.gif" alt="" border="0"  id="btnSubmit" name="Submit" title="submit" onclick="sbt='y'; return frmsubmit();" style="vertical-align:middle;cursor: pointer;" />&nbsp;
                                    {/if*}
                                    <img src="{$SITE_IMAGES}sm_images/btn-reset.gif"  alt=" " border="0" id="btnReset" name="Reset" style="vertical-align:middle;cursor: pointer;" />&nbsp;
                                    <img src="{$SITE_IMAGES}save-btn.gif" alt="" border="0"  id="btnSubmit" name="Submit" title="submit" onclick="$('#eSaved').val('Yes'); return frmsubmit();" style="vertical-align:middle;cursor: pointer;" />&nbsp;
                                    <img src="{$SITE_IMAGES}sm_images/btn-submit.gif" alt="" border="0"  id="btnSubmit" name="Submit" title="submit" onclick="$('#eSaved').val('No'); return frmsubmit();" style="vertical-align:middle;cursor: pointer;" />&nbsp;
                                    {*}<img src="{$SITE_IMAGES}sm_images/btn-cancel.gif"  alt=" " border="0" id="btnCancel" name="Cancel" style="vertical-align:middle;cursor: pointer;" />&nbsp;{*}
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
{if $poitems|is_array && $poitems|@count>1}
{assign var="cnt" value=$poitems|@count}
{/if}
<script type="text/javascript" src="{$S_JQUERY}jquery.validate.js"></script>
<script language="JavaScript" src="{$S_JQUERY}jquery.autocomplete.js"></script>
<link type="text/css" rel="stylesheet" media="screen" href="{$SITE_CSS}jquery.autocomplete.css" />
<script type="text/javascript" src="{$SITE_CONTENT_JS}money_format.js"></script>
<script type="text/javascript" src="{$SITE_JS_AJAX}jgetpoinvitem.js"></script>
{literal}
<script type="text/javascript">
    var sbt = 'n';
    var cnt = '{/literal}{$cnt}{literal}';
    var currency = '{/literal}{$podtls[0].vCurrency}{literal}';
    var vat = '{/literal}{$cntrydt[0].fVat}{literal}';
    var otax = '{/literal}{$cntrydt[0].fOtherTax}{literal}';
    var ad = 'n';
    var edt = 'n';
	// alert(cnt);

    function setsublines(idx)
    {
        pr = false;
        if($('#spnd'+idx+' > #subli').length > 0) {
            pr = $('#spnd'+idx+' > #subli');
            if($('.sqt',pr).length > 0) {
                $('.sqt',pr).attr('innerHTML', $('#iSubQuantity'+idx).val());
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
            // var whtax = parseFloat($.trim($('#fWithHoldingTax'+idx).val()), 10);
            var qno = (subquantity > quantity)? quantity : subquantity;
            var sum = (qno * price);
            var amt = sum;

            if(subtype == 'Charge') {
                var amt1 = (sum * subrate / 100);
                amt = amt1 + ((sum * vat / 100) * subrate / 100) + ((sum * otax / 100) * subrate / 100);
            } else {
                var amt1 = (-(sum * subrate / 100));
                amt = amt1 - ((sum * vat / 100) * subrate / 100) - ((sum * otax / 100) * subrate / 100);
            }
            // amt = amt + ramt;
            // alert(amt);
            // amt = parseFloat(amt,10).toFixed(2);
            if(!isNaN(amt1) && amt1.toString() != 'NaN') {
                if(pr) {
                    var stl = Math.abs(amt1);
                    //$('.stl', pr).attr('innerHTML', ((stl > parseInt(stl,10))? stl.toFixed(2) : stl));
                    $('.stl', pr).attr('innerHTML', money_format('%i',stl));
                }
            }
            if(!isNaN(amt) && amt.toString() != 'NaN') {
                $('#fSubAmount'+idx).val(amt);
                if(pr) {
                    var slf = Math.abs(amt);
                    //$('.slf',pr).attr('innerHTML', ((slf > parseInt(slf,10))? slf.toFixed(2) : slf));
                    $('.slf',pr).attr('innerHTML', money_format('%i',slf));
                }
            }
            var slv = ((sum * vat / 100) * subrate / 100);
            //slv = (slv > parseInt(slv,10))? slv.toFixed(2) : slv;
            $('.slv',pr).attr('innerHTML', money_format('%i',slv));
            var slo = ((sum * otax / 100) * subrate / 100);
            //slo = (slo > parseInt(slo,10))? slo.toFixed(2) : slo;
            slo = slo.toFixed(2);
            $('.slo',pr).attr('innerHTML', slo);
            // $('.slw',pr).attr('innerHTML', ((sum * whtax / 100) * subrate / 100));
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
        // var wtht = 0;
        var namt = 0;
        //
        if($('#dlines > div[id^="spnd"]').length < 1) {
            $('#subt').attr('innerHTML', 0);
            $('#dist').attr('innerHTML', 0);
            $('#chgt').attr('innerHTML', 0);
            $('#vatt').attr('innerHTML', 0);
            $('#otht').attr('innerHTML', 0);
            // $('#wtht').attr('innerHTML', $.trim(money_format('%i',wtht).replace("USD","")));
            $('#namt').attr('innerHTML', 0);
            //
            $('#subtotal').val(0);
            $('#discount').val(0);
            $('#charge').val(0);
            $('#vattotal').val(0);
            $('#othertaxtotal').val(0);
            // $('#whtaxtotal').val(chgt);
            $('#nettotal').val(0);
        }
        $.each($('#dlines > div[id^="spnd"]'), function(i,el)
        {
            setsublines($(this).attr('id').replace('spnd',''));
            if($.trim($(this).find('.ot').attr('innerHTML')) == 'Discount') {
                //dist = dist + parseFloat($(this).find('.fa').attr('innerHTML').replace(new RegExp(',', 'g'),''));
                //namt = namt - parseFloat($(this).find('.fa').attr('innerHTML').replace(new RegExp(',', 'g'),''));
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
            } else if($.trim($(this).find('.ot').attr('innerHTML')) == 'Charge') {
                //chgt = chgt + parseFloat($(this).find('.fa').attr('innerHTML').replace(new RegExp(',', 'g'),''));
                // chgt = chgt + parseFloat($(this).find('.lt').attr('innerHTML').replace(new RegExp(',', 'g'),''), 10);
                //vatt = vatt + parseFloat($(this).find('.fv').attr('innerHTML').replace(new RegExp(',', 'g'),''));
                //otht = otht + parseFloat($(this).find('.ox').attr('innerHTML').replace(new RegExp(',', 'g'),''));
                // wtht = wtht + parseFloat($(this).find('.wt').attr('innerHTML').replace(new RegExp(',', 'g'),''));
                //namt = namt + parseFloat($(this).find('.lt').attr('innerHTML').replace(new RegExp(',', 'g'),''));
				chgt = chgt + parseFloat($(this).find('.lt').attr('innerHTML').replace(new RegExp(',', 'g'),''), 10);
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
            } else {
                subt = subt + parseFloat($(this).find('.fa').attr('innerHTML').replace(new RegExp(',', 'g'),''));
                if(!isNaN(parseFloat($(this).find('.fv').attr('innerHTML').replace(new RegExp(',', 'g'),'')))) {
                    vatt = vatt + parseFloat($(this).find('.fv').attr('innerHTML').replace(new RegExp(',', 'g'),''));
                }
                if(!isNaN(parseFloat($(this).find('.ox').attr('innerHTML').replace(new RegExp(',', 'g'),'')))) {
                    otht = otht + parseFloat($(this).find('.ox').attr('innerHTML').replace(new RegExp(',', 'g'),''));
                }
                // wtht = wtht + parseFloat($(this).find('.wt').attr('innerHTML').replace(new RegExp(',', 'g'),''));
                if(!isNaN(parseFloat($(this).find('.lt').attr('innerHTML').replace(new RegExp(',', 'g'),'')))) {
                    namt = namt + parseFloat($(this).find('.lt').attr('innerHTML').replace(new RegExp(',', 'g'),''));
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
                        //var slw = parseFloat($('.slw', subli).html().replace(new RegExp(',', 'g'),''), 10);
                        //if(!isNaN(slw)) {
                        //	wtht = wtht - slw;
                        //}
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
                        //var slw = parseFloat($('.slw', subli).html().replace(new RegExp(',', 'g'),''), 10);
                        //if(!isNaN(slw)) {
                        //	wtht = wtht + slw;
                        //}
                        namt = namt + slf;
                    }
                    if(!isNaN(sltl)) {
                        // subt = subt + sltl;
                        // namt = namt + sltl;
                    }
                    if(!isNaN(slf)) {
                        // namt = namt + slf;
                    }
                }
            }
            //
            $('#subt').attr('innerHTML', $.trim(money_format('%i',subt).replace("USD","")));
            $('#dist').attr('innerHTML', $.trim(money_format('%i',dist).replace("USD","")));
            $('#chgt').attr('innerHTML', $.trim(money_format('%i',chgt).replace("USD","")));
            $('#vatt').attr('innerHTML', $.trim(money_format('%i',vatt).replace("USD","")));
            $('#otht').attr('innerHTML', $.trim(money_format('%i',otht).replace("USD","")));
            // $('#wtht').attr('innerHTML', $.trim(money_format('%i',wtht).replace("USD","")));
            $('#namt').attr('innerHTML', $.trim(money_format('%i',namt).replace("USD","")));
            //
            $('#subtotal').val(subt);
            $('#discount').val(dist);
            $('#charge').val(chgt);
            $('#vattotal').val(vatt);
            $('#othertaxtotal').val(otht);
            // $('#whtaxtotal').val(wtht);
            $('#nettotal').val(namt);
        });
    }

    function closeRow(vl) {
        if(document.getElementById('vUnitOfMeasure'+vl)) {
            // if($("#frmadd").validate().element('#vUnitOfMeasure'+vl)==false && $("#frmadd").validate().element('#fAmount'+vl)==false && $("#frmadd").validate().element('#fLineTotal'+vl)==false) {
            if(!document.getElementById('spnd'+vl)) {
                deltbl(vl);
            } else {
                if($("#frmadd").validate().element('#fPrice'+vl)==false || $("#frmadd").validate().element('#fAmount'+vl)==false || $("#frmadd").validate().element('#fLineTotal'+vl)==false) {     // $("#frmadd").validate().element('#vUnitOfMeasure'+vl)==false ||
                    //
                } else {
                    $('#Div'+vl).hide();
                }
            }
            //$('#Div'+vl).hide();
        }
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
			$.each($('select[name="eOrderType\[\]"]'), function() {
				$(this).trigger('change');
			});
			$.each($('select[name="fPrice\[\]"]'), function() {
				$(this).trigger('blur');
			});
		});
		//
        $('input[name="fPrice\[\]"]').blur(function() {
            var rq = $(this).attr('id').replace('fPrice','');
            var type = $('#eOrderType'+rq).val();
			if($.trim(type)=='Discount' || $.trim(type)=='Charge') {
				var p = parseFloat($(this).val().replace(new RegExp(',', 'g'),'')).toFixed(2);
				$('#spnd'+rq+'>.iq').attr('innerHTML','');
                $('#spnd'+rq+'>.fp').attr('innerHTML', money_format('%i',parseFloat(p))+'%');
				$('#spnd'+rq+'>.fv').attr('innerHTML','');
                $('#spnd'+rq+'>.ox').attr('innerHTML','');
                $('#spnd'+rq+'>.wt').attr('innerHTML','');
                $('#spnd'+rq+'>.fa').attr('innerHTML','');
                var subtotal = parseFloat($('#subt').html().replace(new RegExp(',', 'g'),''));
				// litotal = getlitotal();
                //var lt = parseFloat(subtotal * p / 100).toFixed(2); 	// litotal
                //$('#fLineTotal'+rq).val(lt);
				//lt = $.trim(money_format('%i', parseFloat(lt)).replace("USD",""));
				//$('#spnd'+rq+'>.lt').attr('innerHTML', lt);
				var st = parseFloat(subtotal * p / 100).toFixed(2); 	// litotal
				if(!isNaN(st)) {
					$('#fAmount'+rq).val(st);
				}
				st = $.trim(money_format('%i', parseFloat(st)).replace("USD",""));
				$('#spnd'+rq+'>.fa').attr('innerHTML', st);
				st = parseFloat(st);
				//
				var fv = gettxtotal('.fv');
				fv = parseFloat(fv * p / 100).toFixed(2);
				if(!isNaN(p)) { $('#fVAT'+rq).val(p); }
				$('#spnd'+rq+'>.fv').attr('innerHTML', fv);
				fv = parseFloat(fv);
				//
				var ox = gettxtotal('.ox');
				ox = parseFloat(ox * p / 100).toFixed(2);
				if(!isNaN(p)) { $('#fOtherTax1'+rq).val(p); }
				$('#spnd'+rq+'>.ox').attr('innerHTML', ox);
				ox = parseFloat(ox);
				//
				var lt = parseFloat((st + fv + ox));
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
                } else {
                    $('#fAmount'+rq).val(0);
                }

                var v = parseFloat($('#fVAT'+rq).val().replace(new RegExp(',', 'g'),''));
                var t = parseFloat($('#fOtherTax1'+rq).val().replace(new RegExp(',', 'g'),''));
                var a = sum;
                var sm = 0;
                if(!isNaN(a)) {
                    sm = sm + a;
                    if(!isNaN(v)) { sm = sm + (a*v/100); $('#vat'+rq).val(a*v/100); }
                    if(!isNaN(t)) { sm = sm + (a*t/100); $('#othertax1'+rq).val(a*t/100); }
                    if(!isNaN(sm)) {
                        $('#fLineTotal'+rq).val($.trim(money_format('%i',sm).replace("USD","")));
                    } else {
                        $('#fLineTotal'+rq).val(0);
                    }
                }
                //sum = (parseFloat(sum,10) > parseInt(sum,10))? sum.toFixed(2) : sum;
                //sm = (parseFloat(sm,10) > parseInt(sm,10))? sm.toFixed(2) : sm;
                //sum = sum.toFixed(2);
                //sm = sm.toFixed(2);
                //
                if(document.getElementById('spnd'+rq)) {
                    $('#spnd'+rq+'>.iq').attr('innerHTML',money_format('%i',q,'no'));
                    $('#spnd'+rq+'>.fp').attr('innerHTML',money_format('%i',p));
                    $('#spnd'+rq+'>.fv').attr('innerHTML',money_format('%i',parseFloat($('#vat'+rq).val())));
                    $('#spnd'+rq+'>.ox').attr('innerHTML',money_format('%i',parseFloat($('#othertax1'+rq).val())));
                    var fa = $.trim(money_format('%i',sum).replace("USD",""));
                    /*if(fa.indexOf('.') != -1 && parseInt(fa.substring(fa.lastIndexOf('.')+1, fa.length),10) == 0) {
                       fa = fa.substring(0, fa.length-3);
                    }*/
                    $('#spnd'+rq+'>.fa').attr('innerHTML', fa);
                    var lt = $.trim(money_format('%i',sm).replace("USD",""));
                    // console.log(money_format('%i',sm));
                    // lt = parseFloat(lt,10).toFixed(2);
                    /*if(lt.indexOf('.') != -1 && parseInt(lt.substring(lt.lastIndexOf('.')+1, lt.length),10) == 0) {
                       lt = lt.substring(0, lt.length-3);
                    }*/
                    $('#spnd'+rq+'>.lt').attr('innerHTML', lt);
                }
                $.each($('div[id*="Div"]'), function(l) {
                    var sbtyp = $(this).find('[name="eOrderType\[\]"]');
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
                } else {
                        $('#fAmount'+rq).val(0);
                }

                var v = parseFloat($('#fVAT'+rq).val().replace(new RegExp(',', 'g'),''));
                var t = parseFloat($('#fOtherTax1'+rq).val().replace(new RegExp(',', 'g'),''));
                var a = sum;
                var sm = 0;
                if(!isNaN(a)) {
                        sm = sm + a;
                        if(!isNaN(v)) { sm = sm + (a*v/100); $('#vat'+rq).val(a*v/100); }
                        if(!isNaN(t)) { sm = sm + (a*t/100); $('#othertax1'+rq).val(a*t/100); }
                        if(!isNaN(sm)) {
                                $('#fLineTotal'+rq).val($.trim(money_format('%i',sm).replace("USD","")));
                        } else {
                                $('#fLineTotal'+rq).val(0);
                        }
                }

                if(document.getElementById('spnd'+rq)) {
                        $('#spnd'+rq+'>.iq').attr('innerHTML',q);
                        $('#spnd'+rq+'>.fp').attr('innerHTML',p);
                        $('#spnd'+rq+'>.fv').attr('innerHTML',$('#vat'+rq).val());
                        $('#spnd'+rq+'>.ox').attr('innerHTML',$('#othertax1'+rq).val());
                        $('#spnd'+rq+'>.fa').attr('innerHTML',$.trim(money_format('%i',sum).replace("USD","")));
                        $('#spnd'+rq+'>.lt').attr('innerHTML',$.trim(money_format('%i',sm).replace("USD","")));
                }
                settotal();*/
        });

        $('input[name="fOtherTax1\[\]"]').blur(function() {
            var rq = $(this).attr('id').replace('fOtherTax1','');
            $('#fPrice'+rq).trigger('blur');
            /*var a  = parseFloat($('#fAmount'+rq).val().replace(new RegExp(',', 'g'),''));
                var v = parseFloat($('#fVAT'+rq).val().replace(new RegExp(',', 'g'),''));
                var t = parseFloat($(this).val().replace(new RegExp(',', 'g'),''));
                var sum = 0;
                if(!isNaN(a)) {
                        sum = sum + a;
                        if(!isNaN(v)) { sum = sum + (a*v/100); $('#vat'+rq).val(a*v/100); }
                        if(!isNaN(t)) { sum = sum + (a*t/100); $('#othertax1'+rq).val(a*t/100); }
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
        $('input[name="fVAT\[\]"]').blur(function() {
            var rq = $(this).attr('id').replace('fVAT','');
            $('#fPrice'+rq).trigger('blur');
            /*var a  = parseFloat($('#fAmount'+rq).val().replace(new RegExp(',', 'g'),''));
                var t = parseFloat($('#fOtherTax1'+rq).val().replace(new RegExp(',', 'g'),''));
                var v = parseFloat($(this).val().replace(new RegExp(',', 'g'),''));
                var sum = 0;
                if(!isNaN(a)) {
                        sum = sum + a;
                        if(!isNaN(v)) { sum = sum + (a*v/100); $('#vat'+rq).val(a*v/100); }
                        if(!isNaN(t)) { sum = sum + (a*t/100); $('#othertax1'+rq).val(a*t/100); }
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

        $('textarea[name="tDescription\[\]"]').blur(function() {
            var rq = $(this).attr('id').replace('tDescription','');
            if(document.getElementById('spnd'+rq)) {
                if($.trim($(this).val()) != '') $('#spnd'+rq+'>.td').attr('innerHTML',$.trim($(this).val()));
            }
        });

        $('[name="vUnitOfMeasure\[\]"]').blur(function() {
            var rq = $(this).attr('id').replace('vUnitOfMeasure','');
            if(document.getElementById('spnd'+rq)) {
                // if($.trim($(this).val()) != '')
                $('#spnd'+rq+'>.um').attr('innerHTML',$.trim($(this).val()));
            }
        });

        $('select[name="eOrderType\[\]"]').change(function() {
            var rq = $(this).attr('id').replace('eOrderType','');
            if(document.getElementById('spnd'+rq)) {
                if($.trim($(this).val()) != '') $('#spnd'+rq+'>.ot').attr('innerHTML',$.trim($(this).val()));
            }
            //
            /*if($(this).val() == 'Discount' || $(this).val() == 'Charge') {
                        // alert($(this).closest('table[id^="tbl"]').find('.ndcf').closest('input').length);
                        $(this).closest('table[id^="tbl"]').find('.ndcf').hide();
                        $(this).closest('table[id^="tbl"]').find('.ndcf').parent('td').next('td').hide();
                        $(this).closest('table[id^="tbl"]').find('input[id^="iQuantity"]').parent('td').attr('width','285px');
                } else {
                        $(this).closest('table[id^="tbl"]').find('.ndcf').show();
                        $(this).closest('table[id^="tbl"]').find('.ndcf').parent('td').next('td').show();
                        $(this).closest('table[id^="tbl"]').find('input[id^="iQuantity"]').parent('td').attr('width','154px');
                        // $('#spnd'+rq).find('#subli').hide('');
                }*/
            if($(this).val() == 'Discount' || $(this).val() == 'Charge') {
				$('#spnd'+rq+'>.um').attr('innerHTML', '');
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
            //
            $('#fPrice'+rq).trigger('blur');
        });

        //
        $('[name="eSublineType\[\]"]').live("change", function() {
            var idx = $(this).attr('id').replace('eSublineType','');
            var pr = false;
            if($('#spnd'+idx+' > #subli').length > 0) {
                pr = $('#spnd'+idx+' > #subli');
                if($.trim($(this).val()) != '') {
                    $('.sltyp',pr).attr('innerHTML', ''+$(this).val()+'');
                    pr.show();
                } else {
                    $('.sltyp',pr).attr('innerHTML', '');
                    $('.sqt',pr).attr('innerHTML', '');
                    $('.srt',pr).attr('innerHTML', '');
                    $('.slt',pr).attr('innerHTML', '');
                    pr.hide();
                    $('#fSubRate'+idx).val('0');
                    $('#iSubQuantity'+idx).val('0');
                    $(this).val('Discount');
                    $('#fPrice'+idx).trigger('blur');
                    $(this).val('');
                }
            }
            $('#fSubRate'+idx).trigger('blur');
        });
        //
        $('[name="iSubQuantity\[\]"]').live('blur', function() {
            var idx = $(this).attr('id').replace('iSubQuantity','');
            pr = false;
            if($('#spnd'+idx+' > #subli').length > 0) {
                pr = $('#spnd'+idx+' > #subli');
                if($('.sqt',pr).length > 0) {
                    $('.sqt',pr).attr('innerHTML', $(this).val());
                    // alert($('.srt',pr).length);
                }
            }
            if($.trim($('#fSubRate'+idx).val()) != '' && !isNaN(parseInt($('#fSubRate'+idx).val(), 10))) {
                var subtype = $.trim($('#eSublineType'+idx).val());
                if($.trim($('#eSublineType'+idx).val()) == '') {
                    return false;
                }
                var subquantity = parseFloat($.trim($(this).val()), 10);
                var linetotal = parseFloat($.trim($('#fLineTotal'+idx).val()), 10);
                var subrate = parseFloat($.trim($('#fSubRate'+idx).val()), 10);
                var quantity = parseFloat($.trim($('#iQuantity'+idx).val()), 10);
                var price = parseFloat($.trim($('#fPrice'+idx).val()), 10);
                var vat = parseFloat($.trim($('#fVAT'+idx).val()), 10);
                var otax = parseFloat($.trim($('#fOtherTax1'+idx).val()), 10);
                // var whtax = parseFloat($.trim($('#fWithHoldingTax'+idx).val()), 10);
                var qno = (subquantity > quantity)? quantity : subquantity;
                var sum = (qno * price);
                var amt = sum;

                if(subtype == 'Charge') {
                    var amt1 = (sum * subrate / 100);
                    amt = amt1 + ((sum * vat / 100) * subrate / 100) + ((sum * otax / 100) * subrate / 100);
                } else {
                    var amt1 = (-(sum * subrate / 100));
                    amt = amt1 - ((sum * vat / 100) * subrate / 100) - ((sum * otax / 100) * subrate / 100);
                }
                // amt = amt + ramt;
                amt = parseFloat(amt,10).toFixed(2);
                // alert(amt);
                if(!isNaN(amt1) && amt1.toString() != 'NaN') {
                    if(pr) {
                        var stl = Math.abs(amt1);
                        //$('.stl', pr).attr('innerHTML', ((stl > parseInt(stl,10))? stl.toFixed(2) : stl));
                        $('.stl', pr).attr('innerHTML', stl.toFixed(2));
                    }
                }
                if(!isNaN(amt) && amt.toString() != 'NaN') {
                    $('#fSubAmount'+idx).val(amt);
                    if(pr) {
                        var slf = Math.abs(amt);
                        //$('.slf',pr).attr('innerHTML', ((slf > parseInt(slf,10))? slf.toFixed(2) : slf));
                        $('.slf',pr).attr('innerHTML', slf.toFixed(2));
                    }
                }
                var slv = ((sum * vat / 100) * subrate / 100);
                //slv = (slv > parseInt(slv,10))? slv.toFixed(2) : slv;
                slv = slv.toFixed(2);
                $('.slv',pr).attr('innerHTML', slv);
                var slo = ((sum * otax / 100) * subrate / 100);
                //slo = (slo > parseInt(slo,10))? slo.toFixed(2) : slo;
                slo = slo.toFixed(2);
                $('.slo',pr).attr('innerHTML', slo);
                // $('.slw',pr).attr('innerHTML', ((sum * whtax / 100) * subrate / 100));
                $('#fPrice'+idx).trigger('blur');
                // settotal();
                // return false;
            }
        });
        //
        $('[name="fSubRate\[\]"]').live('blur', function() {
            var idx = $(this).attr('id').replace('fSubRate','');
            pr = false;
            if($('#spnd'+idx+' > #subli').length > 0) {
                pr = $('#spnd'+idx+' > #subli');
                // alert($('.srt',pr).length);
                if($('.srt',pr).length > 0) {
                    //$('.srt',pr).attr('innerHTML', ((parseFloat($(this).val(),10) > parseInt($(this).val(),10))? parseFloat($(this).val(),10).toFixed(2) : parseInt($(this).val()))+ '%');
                    $('.srt',pr).attr('innerHTML', parseFloat($(this).val()).toFixed(2)+'%');
                }
            }
            if($.trim($('#iSubQuantity'+idx).val()) == '' || isNaN(parseInt($('#iSubQuantity'+idx).val(),10))) {
                return false;
            }
            $('div[id*="Div"]').find('[name="fPrice\[\]"]').trigger('blur');
            $('#iSubQuantity'+idx).trigger('blur');
            //
        });
        //
        $.each($('select[name="eOrderType\[\]"]'), function() {
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
        //
        $('[name="eSublineType\[\]"]').trigger('change');
        //
        // $.each($('select[name="eOrderType\[\]"]'), function() {
        // $('select[name="vUnitOfMeasure\[\]"]').live('mousedown', function(e) {
    });

    function shwtbl(vl) {
        var vl = parseInt(vl);
        var dvnm = '';

        $('div [id*="Div"]').hide();
        $('#Div'+vl).show();
        cr = vl;

        for(var h=0; h<i; h++) {
            if(document.getElementById('vUnitOfMeasure'+h) && h!=vl) {
                if($("#frmadd").validate().element('#fPrice'+h)==false || $("#frmadd").validate().element('#fAmount'+h)==false || $("#frmadd").validate().element('#fLineTotal'+h)==false) {   // $("#frmadd").validate().element('#vUnitOfMeasure'+h)==false ||
                    $('#Div'+h).attr('innerHTML','');
                }
            }
        }
    }
    function deltbl(vl) {
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
    }

    var cr = 0;
    var ordtyp = $('#ordtype').attr('innerHTML');		// {/literal}'{$orderTypes}'{literal};
    var uom = $('.uoms').attr('innerHTML');
    var i=1;
    cr = i-1;
    if(cnt>1) {
        i = parseInt(cnt);
        cr = i;
    }

    function addRw () {
		var noadd = false;
		$.each($('.ot'), function(i,el) {
			if($.trim($(this).html().toLowerCase()) == 'discount' || $.trim($(this).html().toLowerCase()) == 'charge') {
				noadd = true;
			}
		});
		if(noadd) {
			alert(LBL_NO_MORE_ITEMS_MSG);
			return false;
		}
		//
        var j=i;
        if(!document.getElementById('vUnitOfMeasure'+cr)) {
            return false;
        }

        if(document.getElementById('vUnitOfMeasure'+cr)) {
            if($('#vUnitOfMeasure'+cr) && $('#vUnitOfMeasure'+cr) != 'undefined') {
                if(($("#frmadd").validate().element('#fPrice'+cr) && $("#frmadd").validate().element('#fAmount'+cr) && $("#frmadd").validate().element('#fLineTotal'+cr)) || ($("#frmadd").validate().element('#fPrice'+cr) && ($('#eOrderType'+cr).val()=='Discount' || $('#eOrderType'+cr).val()=='Charge'))) {   // $("#frmadd").validate().element('#vUnitOfMeasure'+cr) &&
                    //
                } else {
                    return false;
                }
            }
        }

        for(var h=0; h<i; h++) {
            if(document.getElementById('vUnitOfMeasure'+h)) {
                if($("#frmadd").validate().element('#fPrice'+h)==false || $("#frmadd").validate().element('#fAmount'+h)==false || $("#frmadd").validate().element('#fLineTotal'+h)==false) {   // $("#frmadd").validate().element('#vUnitOfMeasure'+h)==false ||
                    $('#Div'+h).attr('innerHTML','');
                }
            }
        }

        if(edt!='y') {
            cr = i;
        }

        var lin = j;
        var ln = j-1;
        if(document.getElementById('eOrderType'+ln) && !document.getElementById('spnd'+ln)) {
			$('#dlines').append("<div id='spnd"+ln+"'><span style='display:inline-block; line-height:0px; width:5px; padding:0px; margin-right:5px;' class='ar'><img src='"+SITE_IMAGES+"sm_images/arrow-orange.gif' /></span><span style='display:none; height:10px; width:50px; padding:1px; margin:0px;' class='ot'>"+$('#eOrderType'+ln).val()+"</span><span style='display:inline-block; height:10px; width:124px; padding:1px; margin:0px; word-wrap:break-word;' class='td'>"+$('#tDescription'+ln).val()+"</span><span style='display:inline-block; height:10px; width:65px; padding:1px; margin:0px;' class='vp'>"+$('#vPartNo'+ln).val()+"</span><span style='display:inline-block; height:10px; width:72px; padding:1px; margin:0px;' class='um'>"+(($.trim($('#eOrderType'+ln).val())=='Discount' || $.trim($('#eOrderType'+ln).val())=='Charge')? '' : $('#vUnitOfMeasure'+ln).val())+"</span><span style='display:inline-block; height:10px; width:35px; padding:1px; margin:0px; text-align:right;' class='iq'>"+$('#iQuantity'+ln).val()+"</span><span style='display:inline-block; height:10px; width:"+(($('#eOrderType'+ln).val()=='Discount' || $('#eOrderType'+ln).val()=='Charge')? '83' : '72')+"px; padding:1px; margin:0px; text-align:right;' class='fp'>"+$('#fPrice'+ln).val()+"</span><span style='display:inline-block; height:10px; width:"+(($('#eOrderType'+ln).val()=='Discount' || $('#eOrderType'+ln).val()=='Charge')? '89' : '100')+"px; padding:1px; margin:0px; text-align:right;' class='fa'>"+$('#fAmount'+ln).val()+"</span><span style='display:inline-block; height:10px; width:77px; padding:1px; margin:0px; text-align:right;' class='fv'>"+$('#vat'+ln).val()+"</span><span style='display:inline-block; height:10px; width:79px; padding:1px; margin:0px; text-align:right;' class='ox'>"+$('#othertax1'+ln).val()+"</span><span style='display:inline-block; height:10px; width:100px; margin:0px; padding:1px; text-align:right;' class='lt'>"+$('#fLineTotal'+ln).val()+"</span><span style='display:inline-block; padding:1px; height:10px; margin:0px; text-align:right;' class='at'> &nbsp; <img src='"+SITE_IMAGES+"sm_images/icon-pen.gif' onclick='edt=\"y\"; shwtbl("+ln+");' />&nbsp;<img src='"+SITE_IMAGES+"sm_images/icon-cancel.gif' onclick='deltbl("+ln+");' /></span> <div id='subli' style='padding-left:12px; margin-bottom:10px; "+(($('#eOrderType'+ln).val()=='Discount' || $('#eOrderType'+ln).val()=='Charge' || $('#eSublineType'+ln).val()=='')? 'display:none;' : '')+"'><span style='display:inline-block; height:10px; width:230px; margin:0px; text-align:left;' class='sltyp'>"+$('#eSublineType'+ln).val()+"</span> <span class='slqt' style='display:inline-block; height:10px; width:68px; margin:0px; text-align:right;'><span class='sqt'>"+$('#iSubQuantity'+ln).val()+"</span></span> &nbsp;&nbsp;&nbsp; <span class='slrt' style='display:inline-block; height:10px; width:70px; margin:0px; text-align:right;'><span class='srt'>"+parseFloat($('#fSubRate'+ln).val()).toFixed(2)+"</span></span> &nbsp;&nbsp;&nbsp; <span class='sltl' style='display:inline-block; height:10px; width:75px; margin:0px; text-align:right;'><span class='stl'>"+$('#fSubAmount'+ln).val()+"</span></span><span class='slvt' style='display:inline-block; height:10px; width:79px; margin:0px; text-align:right;'><span class='slv'></span></span><span class='slot' style='display:inline-block; height:10px; width:82px; margin:0px; text-align:right;'><span class='slo'></span></span><span class='sltt' style='display:inline-block; height:10px; width:101px; margin:0px; text-align:right;'><span class='slf'></span></span></div>");
            edt='y';
        // } else if(document.getElementById('eOrderType'+ln) && document.getElementById('spnd'+ln)) {
        } else if(edt=='y' && document.getElementById('eOrderType'+cr) && document.getElementById('spnd'+cr)) {
            $("#spnd"+cr).attr('innerHTML',"<span style='display:inline-block; line-height:0px; width:5px; padding:0px; margin-right:5px;' class='ar'><img src='"+SITE_IMAGES+"sm_images/arrow-orange.gif' /></span><span style='display:none; height:10px; width:50px; padding:1px; margin:0px;display:none;' class='ot'>"+$('#eOrderType'+cr).val()+"</span><span style='display:inline-block; height:10px; width:124px; padding:1px; margin:0px; word-wrap:break-word;' class='td'>"+$('#tDescription'+cr).val()+"</span><span style='display:inline-block; height:10px; width:65px; padding:1px; margin:0px;' class='vp'>"+$('#vPartNo'+cr).val()+"</span><span style='display:inline-block; height:10px; width:72px; padding:1px; margin:0px;' class='um'>"+(($.trim($('#eOrderType'+cr).val())=='Discount' || $.trim($('#eOrderType'+cr).val())=='Charge')? '' : $('#vUnitOfMeasure'+cr).val())+"</span><span style='display:inline-block; height:10px; width:35px; padding:1px; margin:0px; text-align:right;' class='iq'>"+$('#iQuantity'+cr).val()+"</span><span style='display:inline-block; height:10px; width:"+(($('#eOrderType'+cr).val()=='Discount' || $('#eOrderType'+cr).val()=='Charge')? '83' : '72')+"px; padding:1px; margin:0px; text-align:right;' class='fp'>"+$('#fPrice'+cr).val()+"</span><span style='display:inline-block; height:10px; width:"+(($('#eOrderType'+cr).val()=='Discount' || $('#eOrderType'+cr).val()=='Charge')? '89' : '100')+"px; padding:1px; margin:0px; text-align:right;' class='fa'>"+$('#fAmount'+cr).val()+"</span><span style='display:inline-block; height:10px; width:77px; padding:1px; margin:0px; text-align:right;' class='fv'>"+$('#vat'+cr).val()+"</span><span style='display:inline-block; height:10px; width:79px; padding:1px; margin:0px; text-align:right;' class='ox'>"+$('#othertax1'+cr).val()+"</span><span style='display:inline-block; height:10px; width:100px; margin:0px; padding:1px; text-align:right;' class='lt'>"+$('#fLineTotal'+cr).val()+"</span><span style='display:inline-block; padding:1px; height:10px; margin:0px; text-align:right;' class='at'> &nbsp; <img src='"+SITE_IMAGES+"sm_images/icon-pen.gif' onclick='edt=\"y\"; shwtbl("+cr+");' />&nbsp;<img src='"+SITE_IMAGES+"sm_images/icon-cancel.gif' onclick='deltbl("+cr+");' /></span> <div id='subli' style='padding-left:12px; margin-bottom:10px; "+(($('#eOrderType'+cr).val()=='Discount' || $('#eOrderType'+cr).val()=='Charge' || $('#eSublineType'+cr).val()=='')? 'display:none;' : '')+"'><span style='display:inline-block; height:10px; width:230px; margin:0px; text-align:left;' class='sltyp'>"+$('#eSublineType'+cr).val()+"</span> <span class='slqt' style='display:inline-block; height:10px; width:68px; margin:0px; text-align:right;'><span class='sqt'>"+$('#iSubQuantity'+cr).val()+"</span></span> &nbsp;&nbsp;&nbsp; <span class='slrt' style='display:inline-block; height:10px; width:70px; margin:0px; text-align:right;'><span class='srt'>"+ parseFloat($('#fSubRate'+cr).val()).toFixed(2) +"</span></span> &nbsp;&nbsp;&nbsp; <span class='sltl' style='display:inline-block; height:10px; width:75px; margin:0px; text-align:right;'><span class='stl'>"+$('#fSubAmount'+cr).val()+"</span></span><span class='slvt' style='display:inline-block; height:10px; width:79px; margin:0px; text-align:right;'><span class='slv'></span></span><span class='slot' style='display:inline-block; height:10px; width:82px; margin:0px; text-align:right;'><span class='slo'></span></span><span class='sltt' style='display:inline-block; height:10px; width:101px; margin:0px; text-align:right;'><span class='slf'></span></span></div>");
            edt='n';
        }

        if($('div[id*="spnd"]').length<1) {
            if(document.getElementById('nli')) {
                $('#nli').show();
            } else {
                $('#dlines').attr('innerHTML',"<div id='nli' align='center'><br /><b>{/literal}{$LBL_NO_LINE_ITEMS}{literal}</b></div>");
            }
        } else {
            $('#nli').hide();
        }

        // alert(i); return false;

        //----------------------
        // i = i+1;
        j = i;
        cr = j;
        var ordertype = ordtyp;
        ordertype = ordertype.replace('id="eOrderType"',"id='eOrderType"+i+"'");
        ordertype = ordertype.replace('id=eOrderType',"id='eOrderType"+i+"'");
        ordertype = ordertype.replace('id="eOrderType0"',"id='eOrderType"+i+"'");
        ordertype = ordertype.replace("id='eOrderType1'","id='eOrderType"+i+"'");
        ordertype = ordertype.replace("id='eOrderType2'","id='eOrderType"+i+"'");
        ordertype = ordertype.replace("id='eOrderType3'","id='eOrderType"+i+"'");
        //
        var uoms = uom;
        uoms = uoms.replace('id="vUnitOfMeasure"',"id='vUnitOfMeasure"+i+"'");
        uoms = uoms.replace('id=vUnitOfMeasure',"id='vUnitOfMeasure"+i+"'");
        uoms = uoms.replace('id="vUnitOfMeasure0"',"id='vUnitOfMeasure"+i+"'");
        uoms = uoms.replace("id='vUnitOfMeasure1'","id='vUnitOfMeasure"+i+"'");
        uoms = uoms.replace("id='vUnitOfMeasure2'","id='vUnitOfMeasure"+i+"'");
        uoms = uoms.replace("id='vUnitOfMeasure3'","id='vUnitOfMeasure"+i+"'");
        $('div [id*="Div"]').hide();

        var ni = document.getElementById('addNew');
        var numi=document.getElementById('mdiv');
        var num = (parseInt(document.getElementById('mdiv').value) - parseInt(1)) + parseInt(2);
        numi.value = num;
        // ---
        var newdiv = document.createElement('div');
        var divIdName ="Div"+j;
        newdiv.setAttribute('id',divIdName);
        // newdiv.innerHTML ="<table id='tbl"+j+"' width='100%' border='0' cellspacing='0' class='black'><tr><td><table width='100%' border='0' cellspacing='5' cellpadding='0'><tr><td width='108'>"+LBL_LINE_TYPE+" :&nbsp;<font class='reqmsg'>*</font></td><td width='281'>"+ordertype+"</td><td width='122'>{/literal}{$LBL_CURRENCY}{literal} : &nbsp;</td><td><b>"+currency+"</b></td></tr><tr><td valign='top'>"+LBL_DESCRIPTION+" : </td><td><textarea name='tDescription[]' id='tDescription"+i+"' class='input-rag' style='width:188px; height: 73px;' >"+$('#tDescription'+ln).val()+"</textarea></td><td valign='top'><span class='ndcf'>"+LBL_UNIT_MEASURE+" :&nbsp;<font class='reqmsg'>*</font></span></td><td valign='top'>"+uoms+"</td></tr></table></td></tr><tr><td><table width='100%' border='0' cellspacing='5' cellpadding='0'><tr><td width='108'><span class='ndcf'>"+LBL_QUANTITY+" :&nbsp;<font class='reqmsg'>*</font></span></td><td width='154'><input type='text' name='iQuantity[]' id='iQuantity"+i+"' class='input-rag required digits' style='width:117px;' title='"+LBL_ENTER+" "+LBL_QUANTITY+"' value='"+$('#iQuantity'+ln).val()+"' /></td><td width='111'><span class='dcr'>"+LBL_PRICE+" :&nbsp;<font class='reqmsg'>*</font></span></td><td width='149'><input type='text' name='fPrice[]' id='fPrice"+i+"' class='input-rag required decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_PRICE+"' value='"+$('#fPrice'+ln).val()+"' /></td><td><span class='ndcf'>"+LBL_AMOUNT+" :&nbsp;<font class='reqmsg'>*</font></span></td><td><input type='text' name='fAmount[]' id='fAmount"+i+"' class='input-rag required decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_AMOUNT+"' readonly='readonly' value='"+$('#fAmount'+ln).val()+"' /></td></tr><tr><td><span class='ndcf'>"+LBL_VAT+" "+LBL_RATE+" (%):&nbsp;<font class='reqmsg'>*</font></span></td><td><input type='text' name='fVAT[]' id='fVAT"+i+"' class='input-rag required decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_VAT+"' value='"+$('#fVAT'+ln).val()+"' /></td><td><span class='ndcf'>"+LBL_VAT+" : </span></td><td><input type='text' name='vat' id='vat"+i+"' class='input-rag' style='width:117px;' title='"+LBL_ENTER+" "+LBL_VAT+"' readonly='readonly' value='"+$('#vat'+ln).val()+"' /></td><td><span class='ndcf'>"+LBL_OTHER_TAX+" "+LBL_RATE+" (%):</span></td><td><input type='text' name='fOtherTax1[]' id='fOtherTax1"+i+"' class='input-rag decimals' style='width:117px;' value='"+$('#fOtherTax1'+ln).val()+"' /></td></tr><tr><td><span class='ndcf'>"+LBL_OTHER_TAX+":</span></td><td><input type='text' name='othertax1' id='othertax1"+i+"' class='input-rag' style='width:117px;' readonly='readonly' value='"+$('#othertax1'+ln).val()+"' /></td><td><span class='ndcf'>"+LBL_LINE_TOTAL+" : </span></td><td><input type='text' name='fLineTotal[]' id='fLineTotal"+i+"' class='input-rag decimals' style='width:117px;' readonly='readonly' value='"+$('#fLineTotal'+ln).val()+"' /></td></tr><tr><td colspan='3'>&nbsp;</td></tr><tr><td colspan='2'><span class='ndcf'><b>"+LBL_DISCOUNT+" / "+LBL_CHARGE+" :- </b> &nbsp; <select id='eSublineType"+i+"' name='eSublineType[]'><option value=''>None</option><option value='Discount'>Discount</option><option value='Charge'>Charge</option></select></span></td><td colspan='4'>&nbsp;</td></tr><tr><td><span class='ndcf'>"+LBL_QUANTITY+" : </span></td><td><input type='text' name='iSubQuantity[]' id='iSubQuantity"+i+"' class='input-rag decimals' style='width:117px;' value='' /></td><td><span class='ndcf'>"+LBL_RATE+" : </span></td><td><input type='text' name='fSubRate[]' id='fSubRate"+i+"' class='input-rag' style='width:117px;' value='' /></td><td colspan='2'><input type='hidden' name='fSubAmount[]' id='fSubAmount"+i+"' class='input-rag' style='width:117px;' value='' /></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td align='right'><img src='"+SITE_IMAGES+"sm_images/btn-close.gif' name='close' value='close' onclick=\"$('#adb').hide(); closeRow(\'"+j+"\')\" /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr><tr><td colspan='6'><hr style='border-style: dashed;'></td></tr></table>";
        //newdiv.innerHTML ="<table id='tbl"+j+"' width='100%' border='0' cellspacing='0' class='black'><tr><td><table width='100%' border='0' cellspacing='5' cellpadding='0'><tr><td width='108'>"+LBL_LINE_TYPE+" :&nbsp;<font class='reqmsg'>*</font></td><td width='281'>"+ordertype+"</td><td width='122'>{/literal}{$LBL_PART_NO}{literal} : &nbsp;</td><td><input type='text' name='vPartNo[]' id='vPartNo"+i+"'></td></tr><tr><td valign='top'>"+LBL_DESCRIPTION+" : </td><td><textarea name='tDescription[]' id='tDescription"+i+"' class='input-rag' style='width:188px; height: 73px;' >"+$('#tDescription'+ln).val()+"</textarea></td><td valign='top'><span class='ndcf'>"+LBL_UNIT_MEASURE+" :&nbsp;<font class='reqmsg'></font></span></td><td valign='top'>"+uoms+"</td></tr></table></td></tr><tr><td><table width='100%' border='0' cellspacing='5' cellpadding='0'><tr><td width='108'><span class='ndcf'>"+LBL_QUANTITY+" :&nbsp;<font class='reqmsg'>*</font></span></td><td width='154'><input type='text' name='iQuantity[]' id='iQuantity"+i+"' class='input-rag required digits' style='width:117px;' title='"+LBL_ENTER+" "+LBL_QUANTITY+"' value='"+$('#iQuantity'+ln).val()+"' /></td><td width='111'><span class='dcr'>"+LBL_PRICE+" :&nbsp;<font class='reqmsg'>*</font></span></td><td width='149'><input type='text' name='fPrice[]' id='fPrice"+i+"' class='input-rag required decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_PRICE+"' value='"+$('#fPrice'+ln).val()+"' /></td><td><span class='ndcf'>"+LBL_AMOUNT+" :&nbsp;<font class='reqmsg'>*</font></span></td><td><input type='text' name='fAmount[]' id='fAmount"+i+"' class='input-rag required decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_AMOUNT+"' readonly='readonly' value='"+$('#fAmount'+ln).val()+"' /></td></tr><tr><td><span class='ndcf'>"+LBL_VAT+" "+LBL_RATE+" (%):&nbsp;<font class='reqmsg'>*</font></span></td><td><input type='text' name='fVAT[]' id='fVAT"+i+"' class='input-rag required decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_VAT+"' value='"+$('#fVAT'+ln).val()+"' /></td><td><span class='ndcf'>"+LBL_VAT+" : </span></td><td><input type='text' name='vat' id='vat"+i+"' class='input-rag' style='width:117px;' title='"+LBL_ENTER+" "+LBL_VAT+"' readonly='readonly' value='"+$('#vat'+ln).val()+"' /></td><td><span class='ndcf'>"+LBL_OTHER_TAX+" "+LBL_RATE+" (%):</span></td><td><input type='text' name='fOtherTax1[]' id='fOtherTax1"+i+"' class='input-rag decimals' style='width:117px;' value='"+$('#fOtherTax1'+ln).val()+"' /></td></tr><tr><td><span class='ndcf'>"+LBL_OTHER_TAX+":</span></td><td><input type='text' name='othertax1' id='othertax1"+i+"' class='input-rag' style='width:117px;' readonly='readonly' value='"+$('#othertax1'+ln).val()+"' /></td><td><span class='ndcf'>"+LBL_LINE_TOTAL+" : </span></td><td><input type='text' name='fLineTotal[]' id='fLineTotal"+i+"' class='input-rag decimals' style='width:117px;' readonly='readonly' value='"+$('#fLineTotal'+ln).val()+"' /></td></tr><tr><td colspan='3'>&nbsp;</td></tr><tr><td colspan='2'><span class='ndcf'><b>"+LBL_DISCOUNT+" / "+LBL_CHARGE+" :- </b> &nbsp; <select id='eSublineType"+i+"' name='eSublineType[]'><option value=''>None</option><option value='Discount'>Discount</option><option value='Charge'>Charge</option></select></span></td><td colspan='4'>&nbsp;</td></tr><tr><td><span class='ndcf'>"+LBL_QUANTITY+" : </span></td><td><input type='text' name='iSubQuantity[]' id='iSubQuantity"+i+"' class='input-rag decimals' style='width:117px;' value='' /></td><td><span class='ndcf'>"+LBL_RATE+" : </span></td><td><input type='text' name='fSubRate[]' id='fSubRate"+i+"' class='input-rag' style='width:117px;' value='' /></td><td colspan='2'><input type='hidden' name='fSubAmount[]' id='fSubAmount"+i+"' class='input-rag' style='width:117px;' value='' /></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td align='right'><img src='"+SITE_IMAGES+"sm_images/btn-close.gif' name='close' value='close' onclick=\"$('#adb').hide(); closeRow(\'"+j+"\')\" /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr><tr><td colspan='6'><hr style='border-style: dashed;'></td></tr></table>";
		newdiv.innerHTML ="<table id='tbl"+j+"' width='100%' border='0' cellspacing='0' class='black'><tr><td><table width='100%' border='0' cellspacing='5' cellpadding='0'><tr><td width='108'>"+LBL_LINE_TYPE+" :&nbsp;<font class='reqmsg'>*</font></td><td width='281'>"+ordertype+"</td><td width='122'>{/literal}{$LBL_PART_NO}{literal} : &nbsp;</td><td><input type='text' name='vPartNo[]' id='vPartNo"+i+"'></td></tr><tr><td valign='top'>"+LBL_DESCRIPTION+" : </td><td><textarea name='tDescription[]' id='tDescription"+i+"' class='input-rag' style='width:188px; height: 73px;' ></textarea></td><td valign='top'><span class='ndcf'>"+LBL_UNIT_MEASURE+" :&nbsp;<font class='reqmsg'></font></span></td><td valign='top'>"+uoms+"</td></tr></table></td></tr><tr><td><table width='100%' border='0' cellspacing='5' cellpadding='0'><tr><td width='108'><span class='ndcf'>"+LBL_QUANTITY+" :&nbsp;<font class='reqmsg'>*</font></span></td><td width='154'><input type='text' name='iQuantity[]' id='iQuantity"+i+"' class='input-rag required digits' style='width:117px;' title='"+LBL_ENTER+" "+LBL_QUANTITY+"' /></td><td width='111'><span class='dcr'>"+LBL_PRICE+" :&nbsp;<font class='reqmsg'>*</font></span></td><td width='149'><input type='text' name='fPrice[]' id='fPrice"+i+"' class='input-rag required decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_PRICE+"' /></td><td><span class='ndcf'>"+LBL_AMOUNT+" :&nbsp;<font class='reqmsg'>*</font></span></td><td><input type='text' name='fAmount[]' id='fAmount"+i+"' class='input-rag required decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_AMOUNT+"' readonly='readonly' /></td></tr><tr><td><span class='ndcf'>"+LBL_VAT+" "+LBL_RATE+" (%):&nbsp;<font class='reqmsg'>*</font></span></td><td><input type='text' name='fVAT[]' id='fVAT"+i+"' class='input-rag required decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_VAT+"' value='"+vat+"' /></td><td><span class='ndcf'>"+LBL_VAT+" : </span></td><td><input type='text' name='vat' id='vat"+i+"' class='input-rag' style='width:117px;' title='"+LBL_ENTER+" "+LBL_VAT+"' readonly='readonly' /></td><td><span class='ndcf'>"+LBL_OTHER_TAX+" "+LBL_RATE+" (%):</span></td><td><input type='text' name='fOtherTax1[]' id='fOtherTax1"+i+"' class='input-rag decimals' style='width:117px;' value='"+otax+"' /></td></tr><tr><td><span class='ndcf'>"+LBL_OTHER_TAX+":</span></td><td><input type='text' name='othertax1' id='othertax1"+i+"' class='input-rag' style='width:117px;' readonly='readonly' /></td><td><span class='ndcf'>"+LBL_LINE_TOTAL+" : </span></td><td><input type='text' name='fLineTotal[]' id='fLineTotal"+i+"' class='input-rag decimals' style='width:117px;' readonly='readonly' /></td><td>"+LBL_CURRENCY+"</td><td><b>"+currency+"<b></td></tr><tr><td colspan='3'>&nbsp;</td></tr><tr><td colspan='2'><span class='ndcf'><b>"+LBL_DISCOUNT+" / "+LBL_CHARGE+" :- </b> &nbsp; <select id='eSublineType"+i+"' name='eSublineType[]'><option value=''>None</option><option value='Discount'>Discount</option><option value='Charge'>Charge</option></select></span></td><td colspan='4'>&nbsp;</td></tr><tr><td><span class='ndcf'>"+LBL_QUANTITY+" : </span></td><td><input type='text' name='iSubQuantity[]' id='iSubQuantity"+i+"' class='input-rag decimals' style='width:117px;' value='' /></td><td><span class='ndcf'>"+LBL_RATE+" : </span></td><td><input type='text' name='fSubRate[]' id='fSubRate"+i+"' class='input-rag' style='width:117px;' value='' /></td><td colspan='2'><input type='hidden' name='fSubAmount[]' id='fSubAmount"+i+"' class='input-rag' style='width:117px;' value='' /></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td align='right'><img src='"+SITE_IMAGES+"sm_images/btn-close.gif' name='close' value='close' onclick=\"$('#adb').hide(); closeRow(\'"+j+"\')\" /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr><tr><td colspan='6'><hr style='border-style: dashed;'></td></tr></table>";
        // &nbsp; <img src='"+SITE_IMAGES+"sm_images/btn-remove.gif' name='remove' value='remove' onClick=\"removeRow(\'"+divIdName+"\')\" />
        ni.appendChild(newdiv);

        // ----------
        $('input[name="fPrice\[\]"]').blur(function() {
            var rq = $(this).attr('id').replace('fPrice','');
            var type = $('#eOrderType'+rq).val();
			if($.trim(type)=='Discount' || $.trim(type)=='Charge') {
                var p = parseFloat($(this).val().replace(new RegExp(',', 'g'),'')).toFixed(2);
				$('#spnd'+rq+'>.iq').attr('innerHTML','');
                $('#spnd'+rq+'>.fp').attr('innerHTML', money_format('%i', parseFloat(p))+'%');
                $('#spnd'+rq+'>.fv').attr('innerHTML','');
                $('#spnd'+rq+'>.ox').attr('innerHTML','');
                $('#spnd'+rq+'>.wt').attr('innerHTML','');
                $('#spnd'+rq+'>.fa').attr('innerHTML','');
                var subtotal = parseFloat($('#subt').html().replace(new RegExp(',', 'g'),''));
				// litotal = getlitotal();
                //var lt = parseFloat(subtotal * p / 100).toFixed(2); 	// litotal
                //$('#fLineTotal'+rq).val(lt);
				//lt = $.trim(money_format('%i', parseFloat(lt)).replace("USD",""));
				//$('#spnd'+rq+'>.lt').attr('innerHTML', lt);
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
				var lt = parseFloat((st + fv + ox));
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
                } else {
                    $('#fAmount'+rq).val(0);
                }

                var v = parseFloat($('#fVAT'+rq).val().replace(new RegExp(',', 'g'),''));
                var t = parseFloat($('#fOtherTax1'+rq).val().replace(new RegExp(',', 'g'),''));
                var a = sum;
                var sm = 0;
                if(!isNaN(a)) {
                    sm = sm + a;
                    if(!isNaN(v)) { sm = sm + (a*v/100); $('#vat'+rq).val(a*v/100); }
                    if(!isNaN(t)) { sm = sm + (a*t/100); $('#othertax1'+rq).val(a*t/100); }
                    if(!isNaN(sm)) {
                        $('#fLineTotal'+rq).val($.trim(money_format('%i',sm).replace("USD","")));
                    } else {
                        $('#fLineTotal'+rq).val(0);
                    }
                }
                //sum = (parseFloat(sum,10) > parseInt(sum,10))? sum.toFixed(2) : sum;
                //sm = (parseFloat(sm,10) > parseInt(sm,10))? sm.toFixed(2) : sm;
                //sum = sum.toFixed(2);
                //sm = sm.toFixed(2);
                //alert(parseFloat(money_format('%i',sum).replace("USD",""),10));
                //
                if(document.getElementById('spnd'+rq)) {
                    $('#spnd'+rq+'>.iq').attr('innerHTML',q);
                    $('#spnd'+rq+'>.fp').attr('innerHTML',money_format('%i',p));
                    $('#spnd'+rq+'>.fv').attr('innerHTML',parseFloat($('#vat'+rq).val()).toFixed(2));
                    $('#spnd'+rq+'>.ox').attr('innerHTML',parseFloat($('#othertax1'+rq).val()).toFixed(2));
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
                    var sbtyp = $(this).find('[name="eOrderType\[\]"]');
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
                } else {
                        $('#fAmount'+rq).val(0);
                }

                var v = parseFloat($('#fVAT'+rq).val().replace(new RegExp(',', 'g'),''));
                var t = parseFloat($('#fOtherTax1'+rq).val().replace(new RegExp(',', 'g'),''));
                var a = sum;
                var sm = 0;
                if(!isNaN(a)) {
                        sm = sm + a;
                        if(!isNaN(v)) { sm = sm + (a*v/100); $('#vat'+rq).val(a*v/100); }
                        if(!isNaN(t)) { sm = sm + (a*t/100); $('#othertax1'+rq).val(a*t/100); }
                        if(!isNaN(sm)) {
                                $('#fLineTotal'+rq).val($.trim(money_format('%i',sm).replace("USD","")));
                        } else {
                                $('#fLineTotal'+rq).val(0);
                        }
                }

                if(document.getElementById('spnd'+rq)) {
                        $('#spnd'+rq+'>.iq').attr('innerHTML',q);
                        $('#spnd'+rq+'>.fp').attr('innerHTML',p);
                        $('#spnd'+rq+'>.fv').attr('innerHTML',$('#vat'+rq).val());
                        $('#spnd'+rq+'>.ox').attr('innerHTML',$('#othertax1'+rq).val());
                        $('#spnd'+rq+'>.fa').attr('innerHTML',$.trim(money_format('%i',sum).replace("USD","")));
                        $('#spnd'+rq+'>.lt').attr('innerHTML',$.trim(money_format('%i',sm).replace("USD","")));
                }
                settotal();*/
        });

        $('input[name="fOtherTax1\[\]"]').blur(function() {
            var rq = $(this).attr('id').replace('fOtherTax1','');
            $('#fPrice'+rq).trigger('blur');
            /*var a  = parseFloat($('#fAmount'+rq).val().replace(new RegExp(',', 'g'),''));
                var v = parseFloat($('#fVAT'+rq).val().replace(new RegExp(',', 'g'),''));
                var t = parseFloat($(this).val().replace(new RegExp(',', 'g'),''));
                var sum = 0;
                if(!isNaN(a)) {
                        sum = sum + a;
                        if(!isNaN(v)) { sum = sum + (a*v/100); $('#vat'+rq).val(a*v/100); }
                        if(!isNaN(t)) { sum = sum + (a*t/100); $('#othertax1'+rq).val(a*t/100); }
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
        $('input[name="fVAT\[\]"]').blur(function() {
            var rq = $(this).attr('id').replace('fVAT','');
            $('#fPrice'+rq).trigger('blur');
            /*var a  = parseFloat($('#fAmount'+rq).val().replace(new RegExp(',', 'g'),''));
                var t = parseFloat($('#fOtherTax1'+rq).val().replace(new RegExp(',', 'g'),''));
                var v = parseFloat($(this).val().replace(new RegExp(',', 'g'),''));
                var sum = 0;
                if(!isNaN(a)) {
                        sum = sum + a;
                        if(!isNaN(v)) { sum = sum + (a*v/100); $('#vat'+rq).val(a*v/100); }
                        if(!isNaN(t)) { sum = sum + (a*t/100); $('#othertax1'+rq).val(a*t/100); }
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

        $('textarea[name="tDescription\[\]"]').blur(function() {
            var rq = $(this).attr('id').replace('tDescription','');
            if(document.getElementById('spnd'+rq)) {
                if($.trim($(this).val()) != '') $('#spnd'+rq+'>.td').attr('innerHTML',$.trim($(this).val()));
            }
        });

        $('[name="vUnitOfMeasure\[\]"]').blur(function() {
            var rq = $(this).attr('id').replace('vUnitOfMeasure','');
            if(document.getElementById('spnd'+rq)) {
                // if($.trim($(this).val()) != '')
                $('#spnd'+rq+'>.um').attr('innerHTML',$.trim($(this).val()));
            }
        });

        $('select[name="eOrderType\[\]"]').change(function() {
            var rq = $(this).attr('id').replace('eOrderType','');
            if(document.getElementById('spnd'+rq)) {
                if($.trim($(this).val()) != '') $('#spnd'+rq+'>.ot').attr('innerHTML',$.trim($(this).val()));
            }
            //
            /*if($(this).val() == 'Discount' || $(this).val() == 'Charge') {
                        // alert($(this).closest('table[id^="tbl"]').find('.ndcf').closest('input').length);
                        $(this).closest('table[id^="tbl"]').find('.ndcf').hide();
                        $(this).closest('table[id^="tbl"]').find('.ndcf').parent('td').next('td').hide();
                        $(this).closest('table[id^="tbl"]').find('input[id^="iQuantity"]').parent('td').attr('width','285px');
                } else {
                        $(this).closest('table[id^="tbl"]').find('.ndcf').show();
                        $(this).closest('table[id^="tbl"]').find('.ndcf').parent('td').next('td').show();
                        $(this).closest('table[id^="tbl"]').find('input[id^="iQuantity"]').parent('td').attr('width','154px');
                        // $('#spnd'+rq).find('#subli').hide('');
                }*/
            if($(this).val() == 'Discount' || $(this).val() == 'Charge') {
				$('#spnd'+rq+'>.um').attr('innerHTML', '');
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
        // ----------
		$('#eOrderType'+j).trigger('change');
        $('div[id*="Div"]').find('[name="fPrice\[\]"]').trigger('blur');
        $('#eSublineType'+ln).trigger('change');
        // $('div[id*="Div"]').find('[name="fPrice\[\]"]').trigger('blur');
        /*if($('div [id*="spnd"]').length<1) {
            $('#nli').show();
        } else {
            $('#nli').hide();
        }*/

        i = i+1;
        $(document).ready( function() {
            $(function() {
                var ead=10;
                $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
            });
        });
        //----------------------
        settotal();
    }

    function addRow(typ)
    {
		var noadd = false;
		$.each($('.ot'), function(i,el) {
			if($.trim($(this).html().toLowerCase()) == 'discount' || $.trim($(this).html().toLowerCase()) == 'charge') {
				noadd = true;
			}
		});
		if(noadd) {
			alert(LBL_NO_MORE_ITEMS_MSG);
			return false;
		}
		$('#adb').show();
        var j=i;
        var ordertype = ordtyp;
        ordertype = ordertype.replace('id="eOrderType"',"id='eOrderType"+i+"'");
        ordertype = ordertype.replace('id=eOrderType',"id='eOrderType"+i+"'");
        ordertype = ordertype.replace('id="eOrderType0"',"id='eOrderType"+i+"'");
        ordertype = ordertype.replace("id='eOrderType1'","id='eOrderType"+i+"'");
        ordertype = ordertype.replace("id='eOrderType2'","id='eOrderType"+i+"'");
        ordertype = ordertype.replace("id='eOrderType3'","id='eOrderType"+i+"'");
        //
        var uoms = uom;
        uoms = uoms.replace('id="vUnitOfMeasure"',"id='vUnitOfMeasure"+i+"'");
        uoms = uoms.replace('id=vUnitOfMeasure',"id='vUnitOfMeasure"+i+"'");
        uoms = uoms.replace('id="vUnitOfMeasure0"',"id='vUnitOfMeasure"+i+"'");
        uoms = uoms.replace("id='vUnitOfMeasure1'","id='vUnitOfMeasure"+i+"'");
        uoms = uoms.replace("id='vUnitOfMeasure2'","id='vUnitOfMeasure"+i+"'");
        uoms = uoms.replace("id='vUnitOfMeasure3'","id='vUnitOfMeasure"+i+"'");

        if(document.getElementById('vUnitOfMeasure'+cr)) {
            if($('#vUnitOfMeasure'+cr) && $('#vUnitOfMeasure'+cr) != 'undefined') {
                if(($("#frmadd").validate().element('#fPrice'+cr) && $("#frmadd").validate().element('#fAmount'+cr) && $("#frmadd").validate().element('#fLineTotal'+cr)) || ($("#frmadd").validate().element('#fPrice'+cr) && ($('#eOrderType'+cr).val()=='Discount' || $('#eOrderType'+cr).val()=='Charge'))) {   // $("#frmadd").validate().element('#vUnitOfMeasure'+cr) &&
                    //
                } else {
                    return false;
                }
            }
        }

        for(var h=0; h<i; h++) {
            if(document.getElementById('vUnitOfMeasure'+h)) {
                if($("#frmadd").validate().element('#fPrice'+h)==false || $("#frmadd").validate().element('#fAmount'+h)==false || $("#frmadd").validate().element('#fLineTotal'+h)==false) {   // $("#frmadd").validate().element('#vUnitOfMeasure'+h)==false ||
                    $('#Div'+h).attr('innerHTML','');
                }
            }
        }

        /*var ld = j;
        if(document.getElementById('vUnitOfMeasure'+ld)) {
                //if($("#frmadd").validate().element('#vUnitOfMeasure'+ld)==false || $("#frmadd").validate().element('#fAmount'+ld)==false || $("#frmadd").validate().element('#fLineTotal'+ld)==false) {
                //	$('#Div'+ld).attr('innerHTML','');
                //}
        }*/

        if(edt!='y') {
            cr = i;
        }
        $('div [id*="Div"]').hide();

        if(typeof typ == 'undefined' || typ == null || typ == '' || typ!='n') {
            var ni = document.getElementById('addNew');
            var numi=document.getElementById('mdiv');
            var num = (parseInt(document.getElementById('mdiv').value) - parseInt(1))+ parseInt(2);
            //alert(num);
            numi.value = num;
            var newdiv = document.createElement('div');
            var divIdName ="Div"+j;
            newdiv.setAttribute('id',divIdName);
            //newdiv.innerHTML ="<table id='tbl"+j+"' width='100%' border='0' cellspacing='0' class='black'><tr><td><table width='100%' border='0' cellspacing='5' cellpadding='0'><tr><td width='108'>"+LBL_LINE_TYPE+" :&nbsp;<font class='reqmsg'>*</font></td><td width='281'>"+ordertype+"</td><td width='122'>{/literal}{$LBL_CURRENCY}{literal} : &nbsp;</td><td><b>"+currency+"</b></td></tr><tr><td valign='top'>"+LBL_DESCRIPTION+" : </td><td><textarea name='tDescription[]' id='tDescription"+i+"' class='input-rag' style='width:188px; height: 73px;' ></textarea></td><td valign='top'><span class='ndcf'>"+LBL_UNIT_MEASURE+" :&nbsp;<font class='reqmsg'>*</font></span></td><td valign='top'>"+uoms+"</td></tr></table></td></tr><tr><td><table width='100%' border='0' cellspacing='5' cellpadding='0'><tr><td width='108'><span class='ndcf'>"+LBL_QUANTITY+" :&nbsp;<font class='reqmsg'>*</font></span></td><td width='154'><input type='text' name='iQuantity[]' id='iQuantity"+i+"' class='input-rag required digits' style='width:117px;' title='"+LBL_ENTER+" "+LBL_QUANTITY+"' /></td><td width='111'><span class='dcr'>"+LBL_PRICE+" :&nbsp;<font class='reqmsg'>*</font></span></td><td width='149'><input type='text' name='fPrice[]' id='fPrice"+i+"' class='input-rag required decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_PRICE+"' /></td><td><span class='ndcf'>"+LBL_AMOUNT+" :&nbsp;<font class='reqmsg'>*</font></span></td><td><input type='text' name='fAmount[]' id='fAmount"+i+"' class='input-rag required decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_AMOUNT+"' readonly='readonly' /></td></tr><tr><td><span class='ndcf'>"+LBL_VAT+" "+LBL_RATE+" (%):&nbsp;<font class='reqmsg'>*</font></span></td><td><input type='text' name='fVAT[]' id='fVAT"+i+"' class='input-rag required decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_VAT+"' value='"+vat+"' /></td><td><span class='ndcf'>"+LBL_VAT+" : </span></td><td><input type='text' name='vat' id='vat"+i+"' class='input-rag' style='width:117px;' title='"+LBL_ENTER+" "+LBL_VAT+"' readonly='readonly' /></td><td><span class='ndcf'>"+LBL_OTHER_TAX+" "+LBL_RATE+" (%):</span></td><td><input type='text' name='fOtherTax1[]' id='fOtherTax1"+i+"' class='input-rag decimals' style='width:117px;' value='"+otax+"' /></td></tr><tr><td><span class='ndcf'>"+LBL_OTHER_TAX+":</span></td><td><input type='text' name='othertax1' id='othertax1"+i+"' class='input-rag' style='width:117px;' readonly='readonly' /></td><td><span class='ndcf'>"+LBL_LINE_TOTAL+" : </span></td><td><input type='text' name='fLineTotal[]' id='fLineTotal"+i+"' class='input-rag decimals' style='width:117px;' readonly='readonly' /></td></tr><tr><td colspan='3'>&nbsp;</td></tr><tr><td colspan='2'><span class='ndcf'><b>"+LBL_DISCOUNT+" / "+LBL_CHARGE+" :- </b> &nbsp; <select id='eSublineType"+i+"' name='eSublineType[]'><option value=''>None</option><option value='Discount'>Discount</option><option value='Charge'>Charge</option></select></span></td><td colspan='4'>&nbsp;</td></tr><tr><td><span class='ndcf'>"+LBL_QUANTITY+" : </span></td><td><input type='text' name='iSubQuantity[]' id='iSubQuantity"+i+"' class='input-rag decimals' style='width:117px;' value='' /></td><td><span class='ndcf'>"+LBL_RATE+" : </span></td><td><input type='text' name='fSubRate[]' id='fSubRate"+i+"' class='input-rag' style='width:117px;' value='' /></td><td colspan='2'><input type='hidden' name='fSubAmount[]' id='fSubAmount"+i+"' class='input-rag' style='width:117px;' value='' /></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td align='right'><img src='"+SITE_IMAGES+"sm_images/btn-close.gif' name='close' value='close' onclick=\"$('#adb').hide(); closeRow(\'"+j+"\')\" /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr><tr><td colspan='6'><hr style='border-style: dashed;'></td></tr></table>";
            newdiv.innerHTML ="<table id='tbl"+j+"' width='100%' border='0' cellspacing='0' class='black'><tr><td><table width='100%' border='0' cellspacing='5' cellpadding='0'><tr><td width='108'>"+LBL_LINE_TYPE+" :&nbsp;<font class='reqmsg'>*</font></td><td width='281'>"+ordertype+"</td><td width='122'>{/literal}{$LBL_PART_NO}{literal} : &nbsp;</td><td><input type='text' name='vPartNo[]' id='vPartNo"+i+"'></td></tr><tr><td valign='top'>"+LBL_DESCRIPTION+" : </td><td><textarea name='tDescription[]' id='tDescription"+i+"' class='input-rag' style='width:188px; height: 73px;' ></textarea></td><td valign='top'><span class='ndcf'>"+LBL_UNIT_MEASURE+" :&nbsp;<font class='reqmsg'></font></span></td><td valign='top'>"+uoms+"</td></tr></table></td></tr><tr><td><table width='100%' border='0' cellspacing='5' cellpadding='0'><tr><td width='108'><span class='ndcf'>"+LBL_QUANTITY+" :&nbsp;<font class='reqmsg'>*</font></span></td><td width='154'><input type='text' name='iQuantity[]' id='iQuantity"+i+"' class='input-rag required digits' style='width:117px;' title='"+LBL_ENTER+" "+LBL_QUANTITY+"' /></td><td width='111'><span class='dcr'>"+LBL_PRICE+" :&nbsp;<font class='reqmsg'>*</font></span></td><td width='149'><input type='text' name='fPrice[]' id='fPrice"+i+"' class='input-rag required decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_PRICE+"' /></td><td><span class='ndcf'>"+LBL_AMOUNT+" :&nbsp;<font class='reqmsg'>*</font></span></td><td><input type='text' name='fAmount[]' id='fAmount"+i+"' class='input-rag required decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_AMOUNT+"' readonly='readonly' /></td></tr><tr><td><span class='ndcf'>"+LBL_VAT+" "+LBL_RATE+" (%):&nbsp;<font class='reqmsg'>*</font></span></td><td><input type='text' name='fVAT[]' id='fVAT"+i+"' class='input-rag required decimals' style='width:117px;' title='"+LBL_ENTER+" "+LBL_VAT+"' value='"+vat+"' /></td><td><span class='ndcf'>"+LBL_VAT+" : </span></td><td><input type='text' name='vat' id='vat"+i+"' class='input-rag' style='width:117px;' title='"+LBL_ENTER+" "+LBL_VAT+"' readonly='readonly' /></td><td><span class='ndcf'>"+LBL_OTHER_TAX+" "+LBL_RATE+" (%):</span></td><td><input type='text' name='fOtherTax1[]' id='fOtherTax1"+i+"' class='input-rag decimals' style='width:117px;' value='"+otax+"' /></td></tr><tr><td><span class='ndcf'>"+LBL_OTHER_TAX+":</span></td><td><input type='text' name='othertax1' id='othertax1"+i+"' class='input-rag' style='width:117px;' readonly='readonly' /></td><td><span class='ndcf'>"+LBL_LINE_TOTAL+" : </span></td><td><input type='text' name='fLineTotal[]' id='fLineTotal"+i+"' class='input-rag decimals' style='width:117px;' readonly='readonly' /></td><td>"+LBL_CURRENCY+"</td><td><b>"+currency+"<b></td></tr><tr><td colspan='3'>&nbsp;</td></tr><tr><td colspan='2'><span class='ndcf'><b>"+LBL_DISCOUNT+" / "+LBL_CHARGE+" :- </b> &nbsp; <select id='eSublineType"+i+"' name='eSublineType[]'><option value=''>None</option><option value='Discount'>Discount</option><option value='Charge'>Charge</option></select></span></td><td colspan='4'>&nbsp;</td></tr><tr><td><span class='ndcf'>"+LBL_QUANTITY+" : </span></td><td><input type='text' name='iSubQuantity[]' id='iSubQuantity"+i+"' class='input-rag decimals' style='width:117px;' value='' /></td><td><span class='ndcf'>"+LBL_RATE+" : </span></td><td><input type='text' name='fSubRate[]' id='fSubRate"+i+"' class='input-rag' style='width:117px;' value='' /></td><td colspan='2'><input type='hidden' name='fSubAmount[]' id='fSubAmount"+i+"' class='input-rag' style='width:117px;' value='' /></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td align='right'><img src='"+SITE_IMAGES+"sm_images/btn-close.gif' name='close' value='close' onclick=\"$('#adb').hide(); closeRow(\'"+j+"\')\" /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr><tr><td colspan='6'><hr style='border-style: dashed;'></td></tr></table>";
            // &nbsp; <img src='"+SITE_IMAGES+"sm_images/btn-remove.gif' name='remove' value='remove' onClick=\"removeRow(\'"+divIdName+"\')\" />
            ni.appendChild(newdiv);
        }

        function findInvValue(li)
        {
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
            $('#iRelatedInvoiceLineID'+j+'').val(totValID);

            var url = SITE_URL+"index.php?file=m-aj_getItemDetails";
            var pars = "&table="+PRJ_DB_PREFIX+"_invoice_detail_line"+"&iId=iInvoiceID"+"&id="+totValID+"&cnt="+j+"&fields=all"+"&jtbl=&where=";
            //alert(url+pars); return false;
            $('#spn').load(url+pars);
            // $.ajax({type:"post", url:url, data:pars, success:getDetails});
            //alert(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+iOrgId+"&iUserID="+totValID);
            //$('#OrgStatus_Div').load(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+totValID);		// +"&iOrgId="+iOrgId
        }

        function selectInvItem(li) {
            findInvValue(li);
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
            $("#InvItemCode"+j+"").autocomplete(
            SITE_URL+"index.php?file=u-aj_getPoInvItem&iInvId="+$("#iInvoiceID"+j+"").val(),
            {
                delay:10,
                minChars:1,
                matchSubset:1,
                matchContains:1,
                cacheLength:10,
                onItemSelect:selectInvItem,
                onFindValue:findInvValue,
                formatItem:formatItem,
                autoFill:false
            }
        );
        }

        function findValue(li)
        {
            if( li == null ) return alert("No match!");
            if( !!li.extra ) var sValue = li.extra[0];
            else var sValue = li.selectValue;

            var totVal = sValue;
            var totValID;
            var totValRes;
            totVal = totVal.split('</span>');
            totValID = totVal[0].replace("<span style='display:none'>","");
            totValRes = totVal[1];
            $("#iInvoiceID"+j+"").val(totValID);
            //$('#result').load(SITE_URL+"index.php?file=u-aj_getOrganizationUser&type=user&iId="+totValID+"");
            //$('#OrgStatus_Div').load(SITE_URL+"index.php?file=or-aj_getOrganizationStatus&type=user&iId="+totValID+"");
            if(totValID != '') { setuser(); }
        }
        function selectItem(li) {
            findValue(li);
        }

        $("#invoice"+i+"").autocomplete(SITE_URL+"index.php?file=u-aj_getPoInv", {
            delay:10,
            minChars:1,
            matchSubset:1,
            matchContains:1,
            cacheLength:10,
            onItemSelect:selectItem,
            onFindValue:findValue,
            formatItem:formatItem,
            autoFill:false
        });
        i = i+1;
        $(document).ready( function() {
            $(function() {
                var ead=10;
                $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
            });
        });

        var lin = j;
        var ln = j-1;
        if(ad=='y') { 	// && edt!='y' && document.getElementById('eOrderType'+lin)
            if(document.getElementById('eOrderType'+ln) && !document.getElementById('spnd'+ln)) {
                $('#dlines').append("<div id='spnd"+ln+"'><span style='display:inline-block; line-height:0px; width:5px; padding:0px; margin-right:5px;' class='ar'><img src='"+SITE_IMAGES+"sm_images/arrow-orange.gif' /></span><span style='display:none; height:10px; width:50px; padding:1px; margin:0px;' class='ot'>"+$('#eOrderType'+ln).val()+"</span><span style='display:inline-block; height:10px; width:124px; padding:1px; margin:0px; word-wrap:break-word;' class='td'>"+$('#tDescription'+ln).val()+"</span><span style='display:inline-block; height:10px; width:65px; padding:1px; margin:0px;' class='vp'>"+$('#vPartNo'+ln).val()+"</span><span style='display:inline-block; height:10px; width:72px; padding:1px; margin:0px;' class='um'>"+(($.trim($('#eOrderType'+ln).val())=='Discount' || $.trim($('#eOrderType'+ln).val())=='Charge')? '' : $('#vUnitOfMeasure'+ln).val())+"</span><span style='display:inline-block; height:10px; width:35px; padding:1px; margin:0px; text-align:right;' class='iq'>"+$('#iQuantity'+ln).val()+"</span><span style='display:inline-block; height:10px; width:"+(($('#eOrderType'+ln).val()=='Discount' || $('#eOrderType'+ln).val()=='Charge')? '83' : '72')+"px; padding:1px; margin:0px; text-align:right;' class='fp'>"+$('#fPrice'+ln).val()+"</span><span style='display:inline-block; height:10px; width:"+(($('#eOrderType'+ln).val()=='Discount' || $('#eOrderType'+ln).val()=='Charge')? '89' : '100')+"px; padding:1px; margin:0px; text-align:right;' class='fa'>"+$('#fAmount'+ln).val()+"</span><span style='display:inline-block; height:10px; width:77px; padding:1px; margin:0px; text-align:right;' class='fv'>"+$('#vat'+ln).val()+"</span><span style='display:inline-block; height:10px; width:79px; padding:1px; margin:0px; text-align:right;' class='ox'>"+$('#othertax1'+ln).val()+"</span><span style='display:inline-block; height:10px; width:100px; margin:0px; padding:1px; text-align:right;' class='lt'>"+$('#fLineTotal'+ln).val()+"</span><span style='display:inline-block; padding:1px; height:10px; margin:0px; text-align:right;' class='at'> &nbsp; <img src='"+SITE_IMAGES+"sm_images/icon-pen.gif' onclick='edt=\"y\"; shwtbl("+ln+");' />&nbsp;<img src='"+SITE_IMAGES+"sm_images/icon-cancel.gif' onclick='deltbl("+ln+");' /></span> <div id='subli' style='padding-left:10px; margin-bottom:10px; "+(($('#eOrderType'+ln).val()=='Discount' || $('#eOrderType'+ln).val()=='Charge' || $('#eSublineType'+ln).val()=='')? 'display:none;' : '')+"'><span style='display:inline-block; height:10px; width:230px; margin:0px; text-align:left;' class='sltyp'>"+$('#eSublineType'+ln).val()+"</span> <span class='slqt' style='display:inline-block; height:10px; width:68px; margin:0px; text-align:right;'><span class='sqt'>"+$('#iSubQuantity'+ln).val()+"</span></span> &nbsp;&nbsp;&nbsp; <span class='slrt' style='display:inline-block; height:10px; width:70px; margin:0px; text-align:right;'><span class='srt'>"+parseFloat($('#fSubRate'+ln).val()).toFixed(2)+"</span></span> &nbsp;&nbsp;&nbsp; <span class='sltl' style='display:inline-block; height:10px; width:76px; margin:0px; text-align:right;'><span class='stl'>"+$('#fSubAmount'+ln).val()+"</span></span><span class='slvt' style='display:inline-block; height:10px; width:79px; margin:0px; text-align:right;'><span class='slv'></span></span><span class='slot' style='display:inline-block; height:10px; width:82px; margin:0px; text-align:right;'><span class='slo'></span></span><span class='sltt' style='display:inline-block; height:10px; width:101px; margin:0px; text-align:right;'><span class='slf'></span></span></div>");
            }
            edt='y';
        } else if(edt=='y' && document.getElementById('eOrderType'+cr) && document.getElementById('spnd'+cr)) {
            $("#spnd"+cr).attr('innerHTML',"<span style='display:inline-block; line-height:0px; width:5px; padding:0px; margin-right:5px;' class='ar'><img src='"+SITE_IMAGES+"sm_images/arrow-orange.gif' /></span><span style='display:none; height:10px; width:50px; padding:1px; margin:0px;display:none;' class='ot'>"+$('#eOrderType'+cr).val()+"</span><span style='display:inline-block; height:10px; width:124px; padding:1px; margin:0px; word-wrap:break-word;' class='td'>"+$('#tDescription'+cr).val()+"</span><span style='display:inline-block; height:10px; width:65px; padding:1px; margin:0px;' class='vp'>"+$('#vPartNo'+cr).val()+"</span><span style='display:inline-block; height:10px; width:72px; padding:1px; margin:0px;' class='um'>"+(($.trim($('#eOrderType'+cr).val())=='Discount' || $.trim($('#eOrderType'+cr).val())=='Charge')? '' : $('#vUnitOfMeasure'+cr).val())+"</span><span style='display:inline-block; height:10px; width:35px; padding:1px; margin:0px; text-align:right;' class='iq'>"+$('#iQuantity'+cr).val()+"</span><span style='display:inline-block; height:10px; width:"+(($('#eOrderType'+cr).val()=='Discount' || $('#eOrderType'+cr).val()=='Charge')? '83' : '72')+"px; padding:1px; margin:0px; text-align:right;' class='fp'>"+$('#fPrice'+cr).val()+"</span><span style='display:inline-block; height:10px; width:"+(($('#eOrderType'+cr).val()=='Discount' || $('#eOrderType'+cr).val()=='Charge')? '89' : '100')+"px; padding:1px; margin:0px; text-align:right;' class='fa'>"+$('#fAmount'+cr).val()+"</span><span style='display:inline-block; height:10px; width:77px; padding:1px; margin:0px; text-align:right;' class='fv'>"+$('#vat'+cr).val()+"</span><span style='display:inline-block; height:10px; width:79px; padding:1px; margin:0px; text-align:right;' class='ox'>"+$('#othertax1'+cr).val()+"</span><span style='display:inline-block; height:10px; width:100px; margin:0px; padding:1px; text-align:right;' class='lt'>"+$('#fLineTotal'+cr).val()+"</span><span style='display:inline-block; padding:1px; height:10px; margin:0px; text-align:right;' class='at'> &nbsp; <img src='"+SITE_IMAGES+"sm_images/icon-pen.gif' onclick='edt=\"y\"; shwtbl("+cr+");' />&nbsp;<img src='"+SITE_IMAGES+"sm_images/icon-cancel.gif' onclick='deltbl("+cr+");' /></span> <div id='subli' style='padding-left:10px; margin-bottom:10px; "+(($('#eOrderType'+cr).val()=='Discount' || $('#eOrderType'+cr).val()=='Charge' || $('#eSublineType'+cr).val()=='')? 'display:none;' : '')+"'><span style='display:inline-block; height:10px; width:230px; margin:0px; text-align:left;' class='sltyp'>"+$('#eSublineType'+cr).val()+"</span> <span class='slqt' style='display:inline-block; height:10px; width:68px; margin:0px; text-align:right;'><span class='sqt'>"+$('#iSubQuantity'+cr).val()+"</span></span> &nbsp;&nbsp;&nbsp; <span class='slrt' style='display:inline-block; height:10px; width:70px; margin:0px; text-align:right;'><span class='srt'>"+ parseFloat($('#fSubRate'+cr).val()).toFixed(2) +"</span></span> &nbsp;&nbsp;&nbsp; <span class='sltl' style='display:inline-block; height:10px; width:76px; margin:0px; text-align:right;'><span class='stl'>"+$('#fSubAmount'+cr).val()+"</span></span><span class='slvt' style='display:inline-block; height:10px; width:79px; margin:0px; text-align:right;'><span class='slv'></span></span><span class='slot' style='display:inline-block; height:10px; width:82px; margin:0px; text-align:right;'><span class='slo'></span></span><span class='sltt' style='display:inline-block; height:10px; width:101px; margin:0px; text-align:right;'><span class='slf'></span></span></div>");
            // <div style='height:1px;'>&nbsp;</div>
            edt='n';
            // alert('#eOrderType'+cr);
            // $('#eOrderType'+cr).trigger('change');
        }
        cr = j;
        ad='n';

        // ----------
        $('input[name="fPrice\[\]"]').blur(function() {
            var rq = $(this).attr('id').replace('fPrice','');
            var type = $('#eOrderType'+rq).val();
			if($.trim(type)=='Discount' || $.trim(type)=='Charge') {
                var p = parseFloat($(this).val().replace(new RegExp(',', 'g'),'')).toFixed(2);
                $('#spnd'+rq+'>.iq').attr('innerHTML','');
                $('#spnd'+rq+'>.fp').attr('innerHTML', money_format('%i',parseFloat(p))+'%');
                $('#spnd'+rq+'>.fv').attr('innerHTML','');
                $('#spnd'+rq+'>.ox').attr('innerHTML','');
                $('#spnd'+rq+'>.wt').attr('innerHTML','');
                $('#spnd'+rq+'>.fa').attr('innerHTML','');
                var subtotal = parseFloat($('#subt').html().replace(new RegExp(',', 'g'),''));
				// litotal = getlitotal();
                //var lt = parseFloat(subtotal * p / 100).toFixed(2); 	// litotal
                //$('#fLineTotal'+rq).val(lt);
				//lt = $.trim(money_format('%i', parseFloat(lt)).replace("USD",""));
				//$('#spnd'+rq+'>.lt').attr('innerHTML', lt);
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
				var lt = parseFloat((st + fv + ox));
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
                } else {
                    $('#fAmount'+rq).val(0);
                }

                var v = parseFloat($('#fVAT'+rq).val().replace(new RegExp(',', 'g'),''));
                var t = parseFloat($('#fOtherTax1'+rq).val().replace(new RegExp(',', 'g'),''));
                var a = sum;
                var sm = 0;
                if(!isNaN(a)) {
                    sm = sm + a;
                    if(!isNaN(v)) { sm = sm + (a*v/100); $('#vat'+rq).val(a*v/100); }
                    if(!isNaN(t)) { sm = sm + (a*t/100); $('#othertax1'+rq).val(a*t/100); }
                    if(!isNaN(sm)) {
                        $('#fLineTotal'+rq).val($.trim(money_format('%i',sm).replace("USD","")));
                    } else {
                        $('#fLineTotal'+rq).val(0);
                    }
                }
                //sum = (parseFloat(sum,10) > parseInt(sum,10))? sum.toFixed(2) : sum;
                //sm = (parseFloat(sm,10) > parseInt(sm,10))? sm.toFixed(2) : sm;
                //sum = sum.toFixed(2);
                //sm = sm.toFixed(2);
                //alert(parseFloat(money_format('%i',sum).replace("USD",""),10));
                //
                if(document.getElementById('spnd'+rq)) {
                    $('#spnd'+rq+'>.iq').attr('innerHTML',q);
                    $('#spnd'+rq+'>.fp').attr('innerHTML',money_format('%i',p));
                    $('#spnd'+rq+'>.fv').attr('innerHTML',parseFloat($('#vat'+rq).val()).toFixed(2));
                    $('#spnd'+rq+'>.ox').attr('innerHTML',parseFloat($('#othertax1'+rq).val()).toFixed(2));
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
                    var sbtyp = $(this).find('[name="eOrderType\[\]"]');
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
                } else {
                        $('#fAmount'+rq).val(0);
                }

                var v = parseFloat($('#fVAT'+rq).val().replace(new RegExp(',', 'g'),''));
                var t = parseFloat($('#fOtherTax1'+rq).val().replace(new RegExp(',', 'g'),''));
                var a = sum;
                var sm = 0;
                if(!isNaN(a)) {
                        sm = sm + a;
                        if(!isNaN(v)) { sm = sm + (a*v/100); $('#vat'+rq).val(a*v/100); }
                        if(!isNaN(t)) { sm = sm + (a*t/100); $('#othertax1'+rq).val(a*t/100); }
                        if(!isNaN(sm)) {
                                $('#fLineTotal'+rq).val($.trim(money_format('%i',sm).replace("USD","")));
                        } else {
                                $('#fLineTotal'+rq).val(0);
                        }
                }

                if(document.getElementById('spnd'+rq)) {
                        $('#spnd'+rq+'>.iq').attr('innerHTML',q);
                        $('#spnd'+rq+'>.fp').attr('innerHTML',p);
                        $('#spnd'+rq+'>.fv').attr('innerHTML',$('#vat'+rq).val());
                        $('#spnd'+rq+'>.ox').attr('innerHTML',$('#othertax1'+rq).val());
                        $('#spnd'+rq+'>.fa').attr('innerHTML',$.trim(money_format('%i',sum).replace("USD","")));
                        $('#spnd'+rq+'>.lt').attr('innerHTML',$.trim(money_format('%i',sm).replace("USD","")));
                }
                settotal();*/
        });

        $('input[name="fOtherTax1\[\]"]').blur(function() {
            var rq = $(this).attr('id').replace('fOtherTax1','');
            $('#fPrice'+rq).trigger('blur');
            /*var a  = parseFloat($('#fAmount'+rq).val().replace(new RegExp(',', 'g'),''));
                var v = parseFloat($('#fVAT'+rq).val().replace(new RegExp(',', 'g'),''));
                var t = parseFloat($(this).val().replace(new RegExp(',', 'g'),''));
                var sum = 0;
                if(!isNaN(a)) {
                        sum = sum + a;
                        if(!isNaN(v)) { sum = sum + (a*v/100); $('#vat'+rq).val(a*v/100); }
                        if(!isNaN(t)) { sum = sum + (a*t/100); $('#othertax1'+rq).val(a*t/100); }
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
        $('input[name="fVAT\[\]"]').blur(function() {
            var rq = $(this).attr('id').replace('fVAT','');
            $('#fPrice'+rq).trigger('blur');
            /*var a  = parseFloat($('#fAmount'+rq).val().replace(new RegExp(',', 'g'),''));
                var t = parseFloat($('#fOtherTax1'+rq).val().replace(new RegExp(',', 'g'),''));
                var v = parseFloat($(this).val().replace(new RegExp(',', 'g'),''));
                var sum = 0;
                if(!isNaN(a)) {
                        sum = sum + a;
                        if(!isNaN(v)) { sum = sum + (a*v/100); $('#vat'+rq).val(a*v/100); }
                        if(!isNaN(t)) { sum = sum + (a*t/100); $('#othertax1'+rq).val(a*t/100); }
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

        $('textarea[name="tDescription\[\]"]').blur(function() {
            var rq = $(this).attr('id').replace('tDescription','');
            if(document.getElementById('spnd'+rq)) {
                if($.trim($(this).val()) != '') $('#spnd'+rq+'>.td').attr('innerHTML',$.trim($(this).val()));
            }
        });

        $('[name="vUnitOfMeasure\[\]"]').blur(function() {
            var rq = $(this).attr('id').replace('vUnitOfMeasure','');
            if(document.getElementById('spnd'+rq)) {
                // if($.trim($(this).val()) != '')
                $('#spnd'+rq+'>.um').attr('innerHTML',$.trim($(this).val()));
            }
        });

        $('select[name="eOrderType\[\]"]').change(function() {
            var rq = $(this).attr('id').replace('eOrderType','');
            if(document.getElementById('spnd'+rq)) {
                if($.trim($(this).val()) != '') $('#spnd'+rq+'>.ot').attr('innerHTML',$.trim($(this).val()));
            }
            //
            /*if($(this).val() == 'Discount' || $(this).val() == 'Charge') {
                        // alert($(this).closest('table[id^="tbl"]').find('.ndcf').closest('input').length);
                        $(this).closest('table[id^="tbl"]').find('.ndcf').hide();
                        $(this).closest('table[id^="tbl"]').find('.ndcf').parent('td').next('td').hide();
                        $(this).closest('table[id^="tbl"]').find('input[id^="iQuantity"]').parent('td').attr('width','285px');
                } else {
                        $(this).closest('table[id^="tbl"]').find('.ndcf').show();
                        $(this).closest('table[id^="tbl"]').find('.ndcf').parent('td').next('td').show();
                        $(this).closest('table[id^="tbl"]').find('input[id^="iQuantity"]').parent('td').attr('width','154px');
                        // $('#spnd'+rq).find('#subli').hide('');
                }*/
            if($(this).val() == 'Discount' || $(this).val() == 'Charge') {
				$('#spnd'+rq+'>.um').attr('innerHTML', '');
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
        // ----------
		$('#eOrderType'+j).trigger('change');
        $('div[id*="Div"]').find('[name="fPrice\[\]"]').trigger('blur');

        if($('div [id*="spnd"]').length<1) {
            $('#nli').show();
        } else {
            $('#nli').hide();
        }
        settotal();
    }
    $('#adb').hide();
    $('div [id*="Div"]').hide();
    // addRow();
    if(document.getElementById('vUnitOfMeasure')) {
        // alert($("#frmadd").validate().element('#vUnitOfMeasure'));
		// try {
			if($("#frmadd").find('#fPrice'+cr).length < 1 || $("#frmadd").validate().element('#fPrice'+cr)==false || $("#frmadd").validate().element('#fAmount')==false || $("#frmadd").validate().element('#fLineTotal')==false) {   //$("#frmadd").validate().element('#vUnitOfMeasure')==false ||
				$('#Div0').attr('innerHTML','');
			}
		// } catch(e) { }
    }
    function removeRow(divNum)
    {
        var a = document.getElementById('addNew');
        var rdiv = document.getElementById(divNum);
        //alert(divNum);
        // a.removeChild(rdiv);
        if(divNum=='Div1')
        {
            var t=document.getElementById('trid');
            if(t)
                t.style.display="none";
        }
        var nm = divNum.replace('Div','');
        deltbl(nm);
    }
    // removeRow("Div"+cr);

    {/literal}{section name="i" loop=$poitems}{literal}
    function findInvValue(li)
    {
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
        $('#iRelatedInvoiceLineID0'+'{/literal}{$smarty.section.i.index}{literal}').val(totValID);

        var url = SITE_URL+"index.php?file=m-aj_getItemDetails";
        var pars = "&table="+PRJ_DB_PREFIX+"_invoice_detail_line"+"&iId=iInvoiceID"+"&id="+totValID+"&fields=all"+"&jtbl=&where=";
        //alert(url+pars); return false;
        $('#spn').load(url+pars);
        // $.ajax({type:"post", url:url, data:pars, success:getDetails});
        //alert(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+iOrgId+"&iUserID="+totValID);
        //$('#OrgStatus_Div').load(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+totValID);		// +"&iOrgId="+iOrgId
    }

    function selectInvItem(li) {
        findInvValue(li);
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
        $("#InvItemCode0"+'{/literal}{$smarty.section.i.index}{literal}').autocomplete(
        SITE_URL+"index.php?file=u-aj_getPoInvItem&iInvId="+$("#iInvoiceID0"+'{/literal}{$smarty.section.i.index}{literal}').val(),
        {
            delay:10,
            minChars:1,
            matchSubset:1,
            matchContains:1,
            cacheLength:10,
            onItemSelect:selectInvItem,
            onFindValue:findInvValue,
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
        $("#iInvoiceID0"+'{/literal}{$smarty.section.i.index}{literal}').val(totValID);
        //$('#result').load(SITE_URL+"index.php?file=u-aj_getOrganizationUser&type=user&iId="+totValID+"");
        //$('#OrgStatus_Div').load(SITE_URL+"index.php?file=or-aj_getOrganizationStatus&type=user&iId="+totValID+"");
        if(totValID != '') { setuser(); }
    }
    function selectItem(li) {
        findValue(li);
    }

    $("#invoice0"+'{/literal}{$smarty.section.i.index}{literal}').autocomplete(
    SITE_URL+"index.php?file=u-aj_getPoInv",
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
    function findInvValue(li)
    {
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
        $('#iRelatedInvoiceLineID00').val(totValID);

        var url = SITE_URL+"index.php?file=m-aj_getItemDetails";
        var pars = "&table="+PRJ_DB_PREFIX+"_invoice_detail_line"+"&iId=iInvoiceID"+"&id="+totValID+"&fields=all"+"&jtbl=&where=";
        //alert(url+pars); return false;
        $('#spn').load(url+pars);
        // $.ajax({type:"post", url:url, data:pars, success:getDetails});
        //alert(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+iOrgId+"&iUserID="+totValID);
        //$('#OrgStatus_Div').load(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+totValID);		// +"&iOrgId="+iOrgId
    }

    function selectInvItem(li) {
        findInvValue(li);
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
        $("#InvItemCode00").autocomplete(
        SITE_URL+"index.php?file=u-aj_getPoInvItem&iInvId="+$("#iInvoiceID00").val(),
        {
            delay:10,
            minChars:1,
            matchSubset:1,
            matchContains:1,
            cacheLength:10,
            onItemSelect:selectInvItem,
            onFindValue:findInvValue,
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
        $("#iInvoiceID00").val(totValID);
        //$('#result').load(SITE_URL+"index.php?file=u-aj_getOrganizationUser&type=user&iId="+totValID+"");
        //$('#OrgStatus_Div').load(SITE_URL+"index.php?file=or-aj_getOrganizationStatus&type=user&iId="+totValID+"");
        if(totValID != '') { setuser(); }
    }
    function selectItem(li) {
        findValue(li);
    }

    $("#invoice00").autocomplete(
    SITE_URL+"index.php?file=u-aj_getPoInv",
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
    //$(document).ready(function() {
    var validator = $("#frmadd").validate({
        ignore: ':hidden',
        /*			rules:{
                                "vItemCode[]": {
                                        remote: {
                    url:SITE_URL+"index.php?file=u-aj_chkdupdata",
                    type:"get",
                    data:{
                        val:function() {
                                                                        return $("#iOrderLineID").val();
                                                                },
                                                                id:function() {
                                                                        return "iOrderLineID";
                                                                },
                                                                field:function() {
                                                                        return "vItemCode";
                                                                },
                                                                table:function() {
                                                                        return "{/literal}{$PRJ_DB_PREFIX}{literal}_purchase_order_line";
                                                                },
                                                                chk: function() {
                                                                        els = $("input[name='vItemCode\[\]']");
                                                                        var n = '';
                                                                        $.each(els, function(i,el) {
                                                                                if($(this).attr('readonly')) {
                                                                                        n += ","+$(this).val();
                                                                                }
                                                                        });
                                                                        return n;
                                                                }
                                                        }
                                        }
                                }
                        },*/
        messages:{
            "eOrderType[]": {
                required: LBL_SELECT_ORDER_TYPE
            },
            /*"vItemCode[]": {
                         required: LBL_ENTER_ITEM_CODE,
                                                                 remote: jQuery.validator.format(LBL_ITEM_CODE_IN_USE)
                    },*/
            /*"vUnitOfMeasure[]": {
                required: LBL_ENTER_UNIT_OF_MEASURE
            },*/
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
            }
        }
    });
    //});

    function chkValid(allel)
    {
        rtn = 'no';
        $.each(allel, function(i,el) {
            var vld = $("#frmadd").validate().element('#'+$(this).attr('id'));
            if(vld === false) {
                rtn = 'yes';
            }
        });
        return rtn;
    }
    settotal();

    function frmsubmit()
    {
        if(document.getElementById('eOrderType'+cr) && !document.getElementById('spnd'+cr)) {
            deltbl(cr);
        }

        var rtn = 'no';
        var err = '';
        allel = $("[name='eOrderType\[\]']");
        rtn = chkValid(allel);
        if(rtn == 'yes') { err = rtn; }

        /*	allel = $("[name=vItemCode\[\]]");
        rtn = chkValid(allel);
        if(rtn == 'yes') { err = rtn; }
         */
        /*allel = $("[name='vUnitOfMeasure\[\]']");
        rtn = chkValid(allel);
        if(rtn == 'yes') { err = rtn; } */

        /* allel = $("[name='iQuantity\[\]']");
        rtn = chkValid(allel);
        if(rtn == 'yes') { err = rtn; } */

        allel = $("[name='fPrice\[\]']");
        rtn = chkValid(allel);
        if(rtn == 'yes') { err = rtn; }
// alert(err);
        allel = $("[name='fAmount\[\]']");
        rtn = chkValid(allel);
        if(rtn == 'yes') { err = rtn; }

        allel = $("[name='fVAT\[\]']");
        rtn = chkValid(allel);
        if(rtn == 'yes') { err = rtn; }

        if(err == 'yes') {
            return false;
        }
        if(! ($("#frmadd").valid())) {
            // alert('');
            return false;
        } else {
            // $('#addNew').attr('innerHTML','');
            $("#frmadd").submit();
        }
    }
</script>
{/literal}

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