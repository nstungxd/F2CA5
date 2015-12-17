<div class="middle-container">
    <h1>{$LBL_VIEW} {$LBL_INVOICE_ITEM}</h1>
    <div class="middle-containt">
        <div class="statistics-main-box-white">
            <div>
                <ul id="inner-tab">
                    <li><a href="{$SITE_URL_DUM}invoiceview/{$iInvoiceID}{if $msg eq 'pop'}/pop{/if}"><em>{$LBL_VIEW} {$LBL_INV_HEADER}</em></a></li>
                    <li><a href="{$SITE_URL_DUM}invprefview/{$iInvoiceID}{if $msg eq 'pop'}/pop{/if}"><em>{$LBL_VIEW} {$LBL_PREFERENCES}</em></a></li>
                    <li><a href="{$SITE_URL_DUM}invoiceviewitems/{$iInvoiceID}{if $msg eq 'pop'}/pop{/if}" class="current"><em>{$LBL_VIEW} {$LBL_LINE_ITEM}</em></a></li>
                </ul>
            </div>
            <div class="clear"></div>
            <div class="inner-gray-bg">
                <div>&nbsp;</div>
                <div id="oldDiv">
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
                        <div id="Div{$invoiceData[i].iInvoiceLineID}" name="rctbl">
                            <h2><!--<img class="plusminus-img" src="{$SITE_IMAGES}sm_images/minus-icon.gif" style="cursor:pointer;"/>--> {$LBL_INVOICE_ITEM}-{$cnt}</h2>
                            <table width="100%" border="0" cellspacing="0" class="black" cellpadding="0" bgcolor="#eeefee" >
                                <tr>
                                    <td>
                                        <table width="100%" border="0" cellspacing="5" cellpadding="0">
                                            <tr>
                                                <td width="15%">{$LBL_LINE_TYPE} : </td>
                                                <td width="15%"><span id="invtype">{$invoiceData[i].eInvoiceType}</span></td>
                                                <td width="10%">{$LBL_ITEM_CODE} : </td>
                                                <td width="20%" align="left">{$invoiceData[i].vItemCode}</td>
                                                <td width="15%" valign="top">{*$LBL_UNIT_MEASURE} :*}</td>
                                                <td width="15%" valign="top">{*$invoiceData[i].vUnitOfMeasure*}</td>
                                            </tr>
                                            <tr>
                                                <td valign="top">{$LBL_DESCRIPTION} : </td>
                                                <td colspan="5">
                                                    <textarea cols="100" rows="3" style="background-color:#eeefee;" readonly="readonly">{$invoiceData[i].tDescription|stripslashes}</textarea>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table width="100%" border="0" cellspacing="5" cellpadding="0">
                                            <tr>
                                                <td width="30px">{$LBL_RATE} : </td>
                                                <td width="30px">{$invoiceData[i].fPrice|formatMoney:true}</td>
                                                <td width="30px">{$LBL_LINE_TOTAL} : </td>
                                                <td width="30px">{$invoiceData[i].fLineTotal|formatMoney:true}</td>
                                                <td width="19%">{*$LBL_QUANTITY} : *}</td>
                                                <td width="19%">{*$invoiceData[i].iQuantity*}</td>
                                                {*<td width="15%">{$LBL_AMOUNT} : </td>
                                                <td width="15%">{$invoiceData[i].fAmount|formatMoney:true}</td>*}
                                            </tr>
                                            {*<tr>
                                                <td>{$LBL_VAT} {$LBL_RATE} (%): </td>
                                                <td>{$invoiceData[i].fVAT}</td>
                                                <td>{$LBL_VAT} : </td>
                                                {assign var="vat" value=`$invoiceData[i].fAmount*$invoiceData[i].fVAT/100`}
                                                <td>{$vat|formatMoney:true}</td>
                                                <td>{$LBL_OTHER_TAX} {$LBL_RATE} (%): </td>
                                                <td>{$invoiceData[i].fOtherTax1}</td>
                                            </tr>
                                            <tr>
                                                <td>{$LBL_OTHER_TAX} : </td>
                                                {assign var="otax" value=`$invoiceData[i].fAmount*$invoiceData[i].fOtherTax1/100`}
                                                <td>{$otax|formatMoney:true}</td>
                                                <td>{$LBL_WITH_HOLDING_TAX} {$LBL_RATE} (%): </td>
                                                <td>{$invoiceData[i].fWithHoldingTax}</td>
                                                <td>{$LBL_WITH_HOLDING_TAX} : </td>
                                                {assign var="wtax" value=`$invoiceData[i].fAmount*$invoiceData[i].fWithHoldingTax/100`}
                                                <td>{$wtax|formatMoney:true}</td>
                                            </tr>
                                            <tr>
                                                <td>{$LBL_LINE_TOTAL} : </td>
                                                <td>{$invoiceData[i].fLineTotal|formatMoney:true}</td>
                                                <td>{$LBL_RECEIPT} : </td>
                                                <td>{$invoiceData[i].tReceipt}</td>
                                                <td>{$LBL_CURRENCY} : </td>
                                                <td>{$invdtls[0].vCurrency}</td>
                                            </tr>*}
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr><td>&nbsp;</td></tr>
                            </table>
                            <div>&nbsp;</div>
                        </div>
                        {elseif $invoiceData[i].eInvoiceType|trim eq 'Charge'}
                        <div id="Div{$invoiceData[i].iInvoiceLineID}" name="rctbl">
                            <h2><!--<img class="plusminus-img" src="{$SITE_IMAGES}sm_images/minus-icon.gif" style="cursor:pointer;"/>--> {$LBL_INVOICE_ITEM}-{$cnt}</h2>
                            <table width="100%" border="0" cellspacing="0" class="black" cellpadding="0" bgcolor="#eeefee" >
                                <tr>
                                    <td>
                                        <table width="100%" border="0" cellspacing="5" cellpadding="0">
                                            <tr>
                                                <td width="15%">{$LBL_LINE_TYPE} : </td>
                                                <td width="15%"><span id="invtype">{$invoiceData[i].eInvoiceType}</span></td>
                                                <td width="10%">{$LBL_ITEM_CODE} : </td>
                                                <td width="20%" align="left">{$invoiceData[i].vItemCode}</td>
                                                <td width="15%" valign="top">{*$LBL_UNIT_MEASURE} :*}</td>
                                                <td width="15%" valign="top">{*$invoiceData[i].vUnitOfMeasure*}</td>
                                            </tr>
                                            <tr>
                                                <td valign="top">{$LBL_DESCRIPTION} : </td>
                                                <td colspan="5">
                                                    <textarea cols="100" rows="3" style="background-color:#eeefee;" readonly="readonly">{$invoiceData[i].tDescription|stripslashes}</textarea>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table width="100%" border="0" cellspacing="5" cellpadding="0">
                                            <tr>
                                                <td width="30px">{$LBL_RATE} : </td>
                                                <td width="30px">{$invoiceData[i].fPrice|formatMoney:true}</td>
                                                <td width="30px">{$LBL_LINE_TOTAL} : </td>
                                                <td width="30px">{$invoiceData[i].fLineTotal|formatMoney:true}</td>
                                                <td width="19%">{*$LBL_QUANTITY} : *}</td>
                                                <td width="19%">{*$invoiceData[i].iQuantity*}</td>
                                                {*<td width="15%">{$LBL_AMOUNT} : </td>
                                                <td width="15%">{$invoiceData[i].fAmount|formatMoney:true}</td>*}
                                            </tr>
                                            {*<tr>
                                                <td>{$LBL_VAT} {$LBL_RATE} (%): </td>
                                                <td>{$invoiceData[i].fVAT}</td>
                                                <td>{$LBL_VAT} : </td>
                                                {assign var="vat" value=`$invoiceData[i].fAmount*$invoiceData[i].fVAT/100`}
                                                <td>{$vat|formatMoney:true}</td>
                                                <td>{$LBL_OTHER_TAX} {$LBL_RATE} (%): </td>
                                                <td>{$invoiceData[i].fOtherTax1}</td>
                                            </tr>
                                            <tr>
                                                <td>{$LBL_OTHER_TAX} : </td>
                                                {assign var="otax" value=`$invoiceData[i].fAmount*$invoiceData[i].fOtherTax1/100`}
                                                <td>{$otax|formatMoney:true}</td>
                                                <td>{$LBL_WITH_HOLDING_TAX} {$LBL_RATE} (%): </td>
                                                <td>{$invoiceData[i].fWithHoldingTax}</td>
                                                <td>{$LBL_WITH_HOLDING_TAX} : </td>
                                                {assign var="wtax" value=`$invoiceData[i].fAmount*$invoiceData[i].fWithHoldingTax/100`}
                                                <td>{$wtax|formatMoney:true}</td>
                                            </tr>
                                            <tr>
                                                <td>{$LBL_LINE_TOTAL} : </td>
                                                <td>{$invoiceData[i].fLineTotal|formatMoney:true}</td>
                                                <td>{$LBL_RECEIPT} : </td>
                                                <td>{$invoiceData[i].tReceipt}</td>
                                                <td>{$LBL_CURRENCY} : </td>
                                                <td>{$invdtls[0].vCurrency}</td>
                                            </tr>*}
                                            <tr><td>&nbsp;</td></tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr><td>&nbsp;</td></tr>
                            </table>
                            <div>&nbsp;</div>
                        </div>
                        {else}
                        <div id="Div{$invoiceData[i].iInvoiceLineID}" name="rctbl">
                            <h2><!--<img class="plusminus-img" src="{$SITE_IMAGES}sm_images/minus-icon.gif" style="cursor:pointer;"/>--> {$LBL_INVOICE_ITEM}-{$cnt}</h2>
                            <table width="100%" border="0" cellspacing="0" class="black" cellpadding="0" bgcolor="#eeefee" >
                                <tr>
                                    <td>
                                        <table width="100%" border="0" cellspacing="5" cellpadding="0">
                                            <tr>
                                                <td width="17%">{$LBL_LINE_TYPE} : </td>
                                                <td width="16%"><span id="invtype">{$invoiceData[i].eInvoiceType}</span></td>
                                                <td width="10%">{$LBL_ITEM_CODE} : </td>
                                                <td width="10%" align="left">{$invoiceData[i].vItemCode}</td>
                                                <td colspan="2">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td width="17%" valign="top">{$LBL_UNIT_MEASURE} :</td>
                                                <td width="16%" valign="top">{$invoiceData[i].vUnitOfMeasure}</td>
                                                <td width="10%">{$LBL_PART_NO} : </td>
                                                <td width="10%" align="left">{$invoiceData[i].vPartNo}</td>
                                                <td colspan="2">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td valign="top">{$LBL_DESCRIPTION} : </td>
                                                <td colspan="5">
                                                    <textarea cols="100" rows="3" style="background-color:#eeefee;" readonly="readonly">{$invoiceData[i].tDescription|stripslashes}</textarea>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table width="100%" border="0" cellspacing="5" cellpadding="0">
                                            <tr>
                                                <td width="15%">{$LBL_QUANTITY} : </td>
                                                <td width="15%">{$invoiceData[i].iQuantity}</td>
                                                <td width="10%">{$LBL_PRICE} : </td>
                                                <td width="20%">{$invoiceData[i].fPrice|formatMoney:true}</td>
                                                <td width="15%">{$LBL_AMOUNT} : </td>
                                                <td width="15%">{$invoiceData[i].fAmount|formatMoney:true}</td>
                                            </tr>
                                            <tr>
                                                <td>{$LBL_VAT} {$LBL_RATE} (%): </td>
                                                <td>{$invoiceData[i].fVAT}</td>
                                                <td>{$LBL_VAT} : </td>
                                                {assign var="vat" value=`$invoiceData[i].fAmount*$invoiceData[i].fVAT/100`}
                                                <td>{$vat|formatMoney:true}</td>
                                                <td>{$LBL_OTHER_TAX} {$LBL_RATE} (%): </td>
                                                <td>{$invoiceData[i].fOtherTax1}</td>
                                            </tr>
                                            <tr>
                                                <td>{$LBL_OTHER_TAX} : </td>
                                                {assign var="otax" value=`$invoiceData[i].fAmount*$invoiceData[i].fOtherTax1/100`}
                                                <td>{$otax|formatMoney:true}</td>
                                                <td>{$LBL_WITH_HOLDING_TAX} {$LBL_RATE} (%): </td>
                                                <td>{$invoiceData[i].fWithHoldingTax}</td>
                                                <td>{$LBL_WITH_HOLDING_TAX} : </td>
                                                {assign var="wtax" value=`$invoiceData[i].fAmount*$invoiceData[i].fWithHoldingTax/100`}
                                                <td>{$wtax|formatMoney:true}</td>
                                            </tr>
                                            <tr>
                                                <td>{$LBL_LINE_TOTAL} : </td>
                                                <td>{$invoiceData[i].fLineTotal|formatMoney:true}</td>
                                                <td>{$LBL_RECEIPT} : </td>
                                                <td>{$invoiceData[i].tReceipt}</td>
                                                <td>{$LBL_CURRENCY} : </td>
                                                <td>{$invdtls[0].vCurrency}</td>
                                            </tr>
                                            {if $invoiceData[i].eSublineType|trim neq ''}
                                            <tr><td colspan="3">&nbsp;</td></tr>
                                            <tr>
                                                <td colspan="2"><span><b>{$invoiceData[i].eSublineType}:-</b></span></td>
                                                <td colspan="4">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td><span class="ndcf">{$LBL_QUANTITY} : </span></td>
                                                <td>{if $invoiceData[i].eSublineType eq ''}0{else}{$invoiceData[i].iSubQuantity}{/if}</td>
                                                <td><span class="ndcf">{$LBL_RATE} : </span></td>
                                                <td>{if $invoiceData[i].eSublineType eq ''}0{else}{$invoiceData[i].fSubRate}{/if}</td>
                                                <td colspan="2"><input type="hidden" name="fSubAmount[]" id="fSubAmount{$smarty.section.i.index}" class="input-rag" style="width:117px;" value="{if $invoiceData[i].eSublineType eq ''}0{else}{$invoiceData[i].fSubAmount}{/if}" /></td>
                                            </tr>
                                            {/if}
                                            <tr><td>&nbsp;</td></tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr><td>&nbsp;</td></tr>
                            </table>
                            <div>&nbsp;</div>
                        </div>
                        {/if}
                        {sectionelse}
                        <div>{$LBL_NO_REC_AVAILABLE}</div>
                        {/section}
                        <table width="100%" border="0" cellspacing="0" class="black" cellpadding="0">
                            <tr>
                                <td colspan="6" id="lines" valign="top">
                                    <div><b><hr style="height:0px; color:#eeeeee;"/>{$LBL_LINE_ITEMS}<hr style="height:0px; color:#eeeeee;" /></b></div>
                                    <div style="height:190px; overflow-y:scroll;">
                                        <b>
                                            <span style="display:inline-block; height:10px; width:6px; padding:1px; margin:0px;">&nbsp;</span>
                                            <!--<span style="display:inline-block; height:10px; width:50px; padding:1px; margin:0px;">{$LBL_LINE_TYPE}</span>-->
                                            <span style="display:inline-block; height:10px; width:100px; padding:1px; margin:0px;">{$LBL_DESCRIPTION}</span>
                                            <span style="display:inline-block; height:10px; width:60px; padding:1px; margin:0px;">{$LBL_PART_NO}</span>
                                            <span style="display:inline-block; height:10px; width:70px; padding:1px; margin:0px;">{*$LBL_UNIT_MEASURE*}UOM</span>
                                            <span style="display:inline-block; height:10px; width:45px; padding:1px; margin:0px; text-align:right;">{*$LBL_QUANTITY*}Qty</span>
                                            <span style="display:inline-block; height:10px; width:80px; padding:1px; margin:0px; text-align:right;">{$LBL_PRICE} / {$LBL_RATE}</span>
                                            <span style="display:inline-block; height:10px; width:120px; padding:1px; margin:0px; text-align:right;">{$LBL_AMOUNT}</span>
                                            <span style="display:inline-block; height:10px; width:80px; padding:1px; margin:0px; text-align:right;">{$LBL_VAT}</span>
                                            <!--<span style="display:inline-block; height:10px; width:50px; padding:1px; margin:0px; text-align:right;">{$LBL_OTHER_TAX}</span>-->
                                            <span style="display:inline-block; height:10px; width:80px; padding:1px; margin:0px; text-align:right;">{*$LBL_WITH_HOLDING_TAX*}WH {$LBL_TAX}</span>
                                            <span style="display:inline-block; height:10px; width:155px; padding:1px; margin:0px; text-align:right;">{$LBL_LINE_TOTAL}</span>
                                            <span style="display:inline-block; height:10px; padding:1px; margin:0px;">&nbsp;</span>
                                        </b>
                                        <div id="dlines">
                                            {section name="i" loop=$invoiceData}
                                            {if $invoiceData[i].eInvoiceType|trim eq 'Discount'}
                                            <div id="spnd{$smarty.section.i.index}">
                                                <span style='display:inline-block; height:10px; width:6px; padding:1px; margin:0px;' class="ar"> <img src='{$SITE_IMAGES}sm_images/arrow-orange.gif' /></span>
                                                <span style='display:none; height:10px; width:50px; padding:1px; margin:0px;display: none;' class="ot">{$invoiceData[i].eInvoiceType}</span>
                                                <span style='display:inline-block; height:10px; width:100px; padding:1px; margin:0px;' class="td">{$invoiceData[i].tDescription}</span>
                                                <span style='display:inline-block; height:10px; width:60px; padding:1px; margin:0px;'>{$invoiceData[i].vPartNo}</span>
                                                <span style='display:inline-block; height:10px; width:70px; padding:1px; margin:0px;' class="um">{*$invoiceData[i].vUnitOfMeasure*}</span>
                                                <span style='display:inline-block; height:10px; width:45px; padding:1px; margin:0px; text-align:right;' class="iq">{*$invoiceData[i].iQuantity*}</span>
                                                <span style='display:inline-block; height:10px; width:90px; padding:1px; margin:0px; text-align:right;' class="fp">{$invoiceData[i].fPrice|formatMoney:true}%</span>
                                                <span style='display:inline-block; height:10px; width:110px; padding:1px; margin:0px; text-align:right;' class="fa">{$invoiceData[i].fAmount|formatMoney:true}</span>
                                                <span style='display:inline-block; height:10px; width:80px; padding:1px; margin:0px; text-align:right;' class="fv">{assign var="vt" value=`$invoiceData[i].fVAT*$invoiceData[i].fAmount/100`}{$vt|formatMoney:true}</span>
                                                <span style='display:inline-block; height:10px; width:50px; padding:1px; margin:0px; text-align:right;display: none;' class="ox">{assign var="ot" value=`$invoiceData[i].fOtherTax1*$invoiceData[i].fAmount/100`}{$ot|formatMoney:true}</span>
                                                <span style='display:inline-block; height:10px; width:80px; padding:1px; margin:0px; text-align:right;' class="wt">{assign var="wt" value=`$invoiceData[i].fWithHoldingTax*$invoiceData[i].fAmount/100`}{$wt|formatMoney:true}</span>
                                                <span style='display:inline-block; height:10px; width:155px; padding:1px; margin:0px; text-align:right;' class="lt">{$invoiceData[i].fLineTotal|formatMoney:true}</span>
                                                <span style='display:inline-block; height:10px; padding:1px;  padding-left:10px; margin:0px; text-align:right;' class="at">
                                                    &nbsp; <img src='{$SITE_IMAGES}sm_images/icon-edit.gif' onclick='shwtbl({$invoiceData[i].iInvoiceLineID});' style="cursor:pointer;"/>
                                                </span>
                                            </div>
                                            {elseif $invoiceData[i].eInvoiceType|trim eq 'Charge'}
                                            <div id="spnd{$smarty.section.i.index}">
                                                <span style='display:inline-block; height:10px; width:6px; padding:1px; margin:0px;' class="ar"> <img src='{$SITE_IMAGES}sm_images/arrow-orange.gif' /></span>
                                                <span style='display:none; height:10px; width:50px; padding:1px; margin:0px;' class="ot">{$invoiceData[i].eInvoiceType}</span>
                                                <span style='display:inline-block; height:10px; width:100px; padding:1px; margin:0px;' class="td">{$invoiceData[i].tDescription}</span>
                                                <span style='display:inline-block; height:10px; width:60px; padding:1px; margin:0px;'>{$invoiceData[i].vPartNo}</span>
                                                <span style='display:inline-block; height:10px; width:70px; padding:1px; margin:0px;' class="um">{*$invoiceData[i].vUnitOfMeasure*}</span>
                                                <span style='display:inline-block; height:10px; width:45px; padding:1px; margin:0px; text-align:right;' class="iq">{*$invoiceData[i].iQuantity*}</span>
                                                <span style='display:inline-block; height:10px; width:90px; padding:1px; margin:0px; text-align:right;' class="fp">{$invoiceData[i].fPrice|formatMoney:true}%</span>
                                                <span style='display:inline-block; height:10px; width:110px; padding:1px; margin:0px; text-align:right;' class="fa">{$invoiceData[i].fAmount|formatMoney:true}</span>
                                                <span style='display:inline-block; height:10px; width:80px; padding:1px; margin:0px; text-align:right;' class="fv">{assign var="vt" value=`$invoiceData[i].fVAT*$invoiceData[i].fAmount/100`}{$vt|formatMoney:true}</span>
                                                <span style='display:inline-block; height:10px; width:50px; padding:1px; margin:0px; text-align:right;display: none;' class="ox">{assign var="ot" value=`$invoiceData[i].fOtherTax1*$invoiceData[i].fAmount/100`}{$ot|formatMoney:true}</span>
                                                <span style='display:inline-block; height:10px; width:80px; padding:1px; margin:0px; text-align:right;' class="wt">{assign var="wt" value=`$invoiceData[i].fWithHoldingTax*$invoiceData[i].fAmount/100`}{$wt|formatMoney:true}</span>
                                                <span style='display:inline-block; height:10px; width:155px; padding:1px; margin:0px; text-align:right;' class="lt">{$invoiceData[i].fLineTotal|formatMoney:true}</span>
                                                <span style='display:inline-block; height:10px; padding:1px;  padding-left:10px; margin:0px; text-align:right;' class="at">
                                                    &nbsp; <img src='{$SITE_IMAGES}sm_images/icon-edit.gif' onclick='shwtbl({$invoiceData[i].iInvoiceLineID});' style="cursor:pointer;"/>
                                                </span>
                                            </div>
                                            {else}
                                            <div id="spnd{$smarty.section.i.index}">
                                                <span style='display:inline-block; height:10px; width:6px; padding:1px; margin:0px;' class="ar"> <img src='{$SITE_IMAGES}sm_images/arrow-orange.gif' /></span>
                                                <span style='display:none; height:10px; width:50px; padding:1px; margin:0px;' class="ot">{$invoiceData[i].eInvoiceType}</span>
                                                <span style='display:inline-block; height:10px; width:100px; padding:1px; margin:0px;' class="td">{$invoiceData[i].tDescription}</span>
                                                <span style='display:inline-block; height:10px; width:60px; padding:1px; margin:0px;'>{$invoiceData[i].vPartNo}</span>
                                                <span style='display:inline-block; height:10px; width:70px; padding:1px; margin:0px;' class="um">{$invoiceData[i].vUnitOfMeasure}</span>
                                                <span style='display:inline-block; height:10px; width:45px; padding:1px; margin:0px; text-align:right;' class="iq">{$invoiceData[i].iQuantity|formatMoney:false} <input type="hidden" name="iQuantity{$smarty.section.i.index}" id="iQuantity{$smarty.section.i.index}" value="{$invoiceData[i].iQuantity}" /> </span>
                                                <span style='display:inline-block; height:10px; width:80px; padding:1px; margin:0px; text-align:right;' class="fp">{$invoiceData[i].fPrice|formatMoney:true} <input type="hidden" name="fPrice{$smarty.section.i.index}" id="fPrice{$smarty.section.i.index}" value="{$invoiceData[i].fPrice}" /> </span>
                                                <span style='display:inline-block; height:10px; width:120px; padding:1px; margin:0px; text-align:right;' class="fa">{$invoiceData[i].fAmount|formatMoney:true} <input type="hidden" name="fAmount{$smarty.section.i.index}" id="fAmount{$smarty.section.i.index}" value="{$invoiceData[i].fAmount}" /> </span>
                                                <span style='display:inline-block; height:10px; width:80px; padding:1px; margin:0px; text-align:right;' class="fv">{assign var="vt" value=`$invoiceData[i].fVAT*$invoiceData[i].fAmount/100`}{$vt|formatMoney:true} <input type="hidden" name="fVAT{$smarty.section.i.index}" id="fVAT{$smarty.section.i.index}" value="{$invoiceData[i].fVAT}" /> </span>
                                                <span style='display:inline-block; height:10px; width:50px; padding:1px; margin:0px; text-align:right;display: none;' class="ox">{assign var="ot" value=`$invoiceData[i].fOtherTax1*$invoiceData[i].fAmount/100`}{$ot|formatMoney:true} <input type="hidden" name="fOtherTax1{$smarty.section.i.index}" id="fOtherTax1{$smarty.section.i.index}" value="{$invoiceData[i].fOtherTax1}" /> </span>
                                                <span style='display:inline-block; height:10px; width:80px; padding:1px; margin:0px; text-align:right;' class="wt">{assign var="wt" value=`$invoiceData[i].fWithHoldingTax*$invoiceData[i].fAmount/100`}{$wt|formatMoney:true} <input type="hidden" name="fWithHoldingTax{$smarty.section.i.index}" id="fWithHoldingTax{$smarty.section.i.index}" value="{$invoiceData[i].fWithHoldingTax}" /> </span>
                                                <span style='display:inline-block; height:10px; width:155px; padding:1px; margin:0px; text-align:right;' class="lt">{$invoiceData[i].fLineTotal|formatMoney:true} <input type="hidden" name="fLineTotal{$smarty.section.i.index}" id="fLineTotal{$smarty.section.i.index}" value="{$invoiceData[i].fLineTotal}" /> </span>
                                                <span style='display:inline-block; height:10px; padding:1px;  padding-left:10px; margin:0px; text-align:right;' class="at">
                                                    &nbsp; <img src='{$SITE_IMAGES}sm_images/icon-edit.gif' onclick='shwtbl({$invoiceData[i].iInvoiceLineID});' style="cursor:pointer;"/>
                                                </span>
                                                <div class="subli" style="display:{if $invoiceData[i].eSublineType neq 'Discount' && $invoiceData[i].eSublineType neq 'Charge'}none{/if}; padding-left:10px;">
                                                    <!--{*<div id="spsli">*}-->
													<span style='display:inline-block; height:10px; margin:0px; padding:0px;' class='ar'></span>
                                                    <span style='display:inline-block; height:10px; width:151px; margin:0px; text-align:left;' class="sltyp">{$invoiceData[i].eSublineType}</span> <input type="hidden" name="eSublineType{$smarty.section.i.index}" id="eSublineType{$smarty.section.i.index}" value="{$invoiceData[i].eSublineType}" />
                                                    <span class="slqt" style="display:inline-block; height:10px; width:135px; margin:0px; text-align:right;"><span class="sqt">{$invoiceData[i].iSubQuantity|formatMoney:false}</span> <input type="hidden" name="iSubQuantity{$smarty.section.i.index}" id="iSubQuantity{$smarty.section.i.index}" value="{$invoiceData[i].iSubQuantity}" /> </span> &nbsp;&nbsp;&nbsp;
                                                    <span class="slrt" style="display:inline-block; height:10px; width:81px; margin:0px; text-align:right;"><span class="srt">{$invoiceData[i].fSubRate|formatMoney:true}%</span> <input type="hidden" name="fSubRate{$smarty.section.i.index}" id="fSubRate{$smarty.section.i.index}" value="{$invoiceData[i].fSubRate}" /> </span> &nbsp;&nbsp;&nbsp;
                                                    <!--{*<span class="slrt" style="display:none; height:10px; width:230px; margin:0px; text-align:left;"><label style="width:170px; font-weight:bold; display:inline-block;">Amount:</label> &nbsp; 100</span>*}-->
                                                    <span class="sltl" style="display:inline-block; height:10px; width:99px; margin:0px; text-align:right;"><span class="stl">{$invoiceData[i].fSubAmount|formatMoney:true}</span> <input type="hidden" name="fSubAmount{$smarty.section.i.index}" id="fSubAmount{$smarty.section.i.index}" value="{$invoiceData[i].fSubAmount}" /> </span>
                                                    <span class="slvt" style="display:inline-block; height:10px; width:82px; margin:0px; text-align:right;"><span class="slv">{$invoiceData[i].fSubVat|formatMoney:true}</span></span>
                                                    <span class="slot" style="display:inline-block; height:10px; width:50px; margin:0px; text-align:right;display:none;"><span class="slo">{$invoiceData[i].fSubOtherTax|toFixed:true}</span></span>
                                                    <span class="slwt" style="display:inline-block; height:10px; width:82px; margin:0px; text-align:right;"><span class="slw">{$invoiceData[i].fSubWHTax|toFixed:true}</span></span>
                                                    <span class="sltt" style="display:inline-block; height:10px; width:157px; margin:0px; text-align:right;"><span class="slf">{$invoiceData[i].fSubTotal|formatMoney:true}</span></span>
                                                    <!--{*</div>*}-->
                                                </div>
                                            </div>
                                            {/if}
                                            <div>&nbsp;</div>
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
                            {else}
                            <div id="nli" align="center"><br /><b>{$LBL_NO_LINE_ITEMS}</b></div>
                            {/if}
                            {if $view neq 'edit' && $usertype neq 'orgadmin'}
                            <tr>
                                <td valign="bottom"></td>
                                <td>&nbsp;</td>
                                <td valign="bottom" align="center" colspan="2">
                                    <img src="{$SITE_IMAGES}sm_images/btn-back.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="history.back();" />
                                    <img src="{$SITE_IMAGES}sm_images/btn-verify.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('verify');$('#frmadd').submit();" />
                                    <img src="{$SITE_IMAGES}sm_images/btn-reject.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('reject');$('#frmadd').submit();" />
                                </td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            {/if}
                        </table>
                    </form>
                </div>
                <span style="display:block;text-align:center;height:30px;">
                    {if $view neq 'edit' && $usertype neq 'orgadmin'} {elseif $msg neq 'pop'}
                    <img src="{$SITE_IMAGES}sm_images/btn-back.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="history.back();" />
                    {/if}
                </span>
            </div>
            <div>&nbsp;</div>
        </div>
    </div>
</div>
<span id="spn" style="display:hidden;"></span>

<script type="text/javascript" src="{$SITE_CONTENT_JS}money_format.js"></script>
{literal}
<script type="text/javascript">
    $(document).ready(function() {
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
        if($('div[id^="spnd"] > .subli').length > 0) {
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
            if($.trim($(this).find('.ot').attr('innerHTML').toLowerCase()) == 'discount') {
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
            } else if($.trim($(this).find('.ot').attr('innerHTML').toLowerCase()) == 'charge') {
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
    settotal();
</script>
{/literal}
