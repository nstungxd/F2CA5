<script type="text/javascript" src="{$S_JQUERY}jquery.validate.js"></script>
{literal}
<script type="text/javascript" >
    var stateArr = new Array({/literal}{$stateArr}{literal});
    //alert(stateArr);
</script>
{/literal}

<div class="middle-container">
    <h1>{$LBL_CREATE_INVOICE}</h1>
    <div class="middle-containt">
        <div class="statistics-main-box-white">
            <div>
                <ul id="inner-tab">
                    <li><a href="{$SITE_URL_DUM}invoicecreate" class="current"><EM>{$LBL_CREATE_INVOICE}</EM></a></li>
                    <li>{if $view eq 'edit'}<a href="{$SITE_URL_DUM}invpref/{$iInvoiceID}" >{else}<a>{/if}<em>{$LBL_PREFERENCES}</em></a></li>
                    <li>{if $view eq 'edit'}<a href="{$SITE_URL_DUM}invoiceadditems/{$iInvoiceID}" >{else}<a>{/if}<EM>{$LBL_ADD_ITEM}</EM></a></li>
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
                    <form name="frmadd" id="frmadd" action="{$SITE_URL}index.php?file=u-invoicecreate_a"  method="post" enctype="multipart/form-data">
                        <input type="hidden" name="iInvoiceID" id="iInvoiceID" value="{$iInvoiceID}" />
                        <input type="hidden" name="view" id="view" value="{$view}" />
                        <input type="hidden" name="frmbuyer" id="frmbuyer" value="{$frmbuyer}" />
                        <input type="hidden" name="Data[eFrom]" id="eFrom" value="" />
                        <table width="97%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
                            <tr><td colspan="3" align="right"><font size="2" color="red"><b>{$var_msg}</b></font></td></tr>
                            {*if $uorg_type eq 'Supplier' || $uorg_type eq 'Both'*}
                            {if $frmbuyer eq 'n' && $invdtls[0].eCreateByBuyer neq 'Yes'}
                            <tr>
                                <td width="225">{$LBL_SUPPLIER} {$LBL_COMP_NAME}</td>
                                <td>:</td>
                                <td class="blue-ore">{$orgname}</td>
                            </tr>
                            <tr>
                                <td width="225">{$LBL_SUPPLIER} {$LBL_CODE} </td>
                                <td>:</td>
                                <td class="blue-ore">
                                    {$OrgCode}
                                    <input type="hidden" name="Data[vInvoiceSupplierCode]" id="vInvoiceSupplierCode" value="{$OrgCode}" />
                                    <input type="hidden" name="iSupplierOrganizationID" id="iSupplierOrganizationID" value="{$curORGID}" />
                                </td>
                            </tr>
                            {else}
                            <tr>
                                <td width="225">{$LBL_SUPPLIER} {$LBL_COMP_NAME}</td>
                                <td>:</td>
                                <td class="blue-ore">
                                    <span id="scompcombo" style="float:left;">
                                        <select name="Data[iSupplierOrganizationID]" id="iSupplierOrganizationID" style="width: 230px;" class="required" title="{$LBL_SELECT} {$LBL_SUPPLIER} {$LBL_COMPANY}" onchange="// return getorgbilldetails(this.value)" > {*}$("#iBuyerID").load(SITE_URL+"index.php?file=u-aj_getUser&icompid="+this.value+"&htmlTag=option&orgtype=buyer");{*}
                                            <option value="">---{$LBL_SELECT} {$LBL_SUPPLIER} {$LBL_COMPANY}---</option>
                                            {if $view eq 'edit'}
                                            <option value="{$sorgdtls[0].iOrganizationID}" selected="selected">{$sorgdtls[0].vCompanyName}</option>
                                            {/if}
                                        </select>
                                    </span>&nbsp;
                                    <input type="text" name="scompcode" id="scompcode" value="({$LBL_ENTER} {$LBL_COMPANY})" onfocus="if(this.value=='({$LBL_ENTER} {$LBL_COMPANY})')this.value='';" onblur="if(this.value=='')this.value='({$LBL_ENTER} {$LBL_COMPANY})';" style="width:170px; height:17px;" />
                                    <img src="{$SITE_IMAGES}sm_images/btn-search.gif" alt="" border="0" style="cursor: pointer;vertical-align:middle;background:#f8f8f8;border:none;" onclick="return getComboVal('sborg');" />
                                </td>
                            </tr>
                            {/if}
                            {*<tr>
                                <td>{$LBL_SELECT_INVOICE}&nbsp;</td>
                                <td>:</td>
                                <td>
                                    <!--<input type="text" name="Data[vInvoiceCode]" id="vInvoiceCode" class="input-rag" tabindex="1" value="{$invdtls[0].vInvoiceCode}" {if $view eq 'edit'}readonly="readonly"{/if} />
                                                                                                          &nbsp;{$LBL_AUTO_COMPLATE}
                                    -->
                                    <span id="invcombo" style="float:left;">
                                        <select name="vInvoiceCode" id="vInvoiceCode" style="width: 230px;" onchange="fillInvData(this.options[this.selectedIndex].id)" >
                                            <option>---{$LBL_SELECT_INVOICE}---</option>
                                            {*foreach from=$invoiceCodeData item="invoiceCode"}
                                            <option value="{$invoiceCode.vTitle}"  id="{$invoiceCode.Id}" {if $invoiceCode.vTitle eq $invdtls[0].vInvoiceCode}selected{/if} >{$invoiceCode.vTitle}</option>
                                            {/foreach}
                                        </select>
                                    </span>&nbsp;
                                    <input type="text" name="inv" id="inv" value="({$LBL_ENTER} {$LBL_INV_SUPPLIER_CODE})" onfocus="if(this.value=='({$LBL_ENTER} {$LBL_INV_SUPPLIER_CODE})')this.value='';" onblur="if(this.value=='')this.value='({$LBL_ENTER} {$LBL_INV_SUPPLIER_CODE})';" style="width:170px; height:17px;" />
                                    <img src="{$SITE_IMAGES}sm_images/btn-search.gif" alt="" border="0" style="cursor: pointer;vertical-align:middle;background: #f8f8f8;border:none;" onclick="return getComboVal('inv');" />
                                </td>
                            </tr>*}
                            <tr>
                                <td>{$LBL_PO_CODE} </td>
                                <td>:</td>
                                <td>
                                    <!--<input type="text" name="purchaseOrder" class="input-rag" id="purchaseOrder" tabindex="2" title="{$LBL_ENTER} {$LBL_PURCHASE_ORDER}" style="width:228px;" value="{$invdtls[0].vPOCode}" />
                                    <input type="hidden" name="iPurchaseOrderID" id="iPurchaseOrderID" onchange="fillInvData(this.options[this.selectedIndex].id)" class="" title="{$LBL_ENTER} {$LBL_PURCHASE_ORDER}" value="{$invdtls[0].iPurchaseOrderID}" />
                                    &nbsp;{$LBL_AUTO_COMPLATE}-->
                                    <span id="pocombo" style="float:left;">
                                        <select name="Data[iPurchaseOrderID]" id="iPurchaseOrderID" style="width: 230px;" onchange="fillPOData(this.options[this.selectedIndex].id)" title="{$LBL_SELECT} {$LBL_PURCHASE_ORDER}" > {*}class="{if $POCodeData|@count gt 0 && $POCodeData|is_array}required{/if}"{*}
                                            <option value="">---{$LBL_SELECT_PO}---</option>
                                            {if $podl|is_array && $podl|@count>0}
                                            <option value="{$podl[0].iPurchaseOrderID}" selected="selected">{$podl[0].vPOCode}</option>
                                            {/if}
                                            {*foreach from=$POCodeData item="POCode"}
                                            <option value="{$POCode.Id}"  id="{$POCode.Id}" {if $POCode.Id eq $invdtls[0].iPurchaseOrderID}selected{/if} >{$POCode.vTitle}</option>
                                            {/foreach*}
                                        </select>
                                    </span>&nbsp;
                                    <input type="text" name="poc" id="poc" value="({$LBL_ENTER} {$LBL_PO_BUYER_CODE})" onfocus="if(this.value=='({$LBL_ENTER} {$LBL_PO_BUYER_CODE})')this.value='';" onblur="if(this.value=='')this.value='({$LBL_ENTER} {$LBL_PO_BUYER_CODE})';" style="width:170px; height:17px;" />
                                    <img src="{$SITE_IMAGES}sm_images/btn-search.gif" alt="" border="0" style="cursor: pointer;vertical-align:middle;background: #f8f8f8;border:none;" onclick="return getComboVal('po');" />
                                </td>
                            </tr>
                            <tr id="ep">
                                <td>{$LBL_EXTERNAL_PO_CODE} </td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="Data[vExtPOCode]" id="vExtPOCode" value="{$invdtls[0].vExtPOCode}" />
                                </td>
                            </tr>
                            {*if $uorg_type eq 'Supplier' || $uorg_type eq 'Both'*}
                            {if $frmbuyer eq 'n' && $invdtls[0].eCreateByBuyer neq 'Yes'}
                            <tr>
                                <td>{$LBL_BUYER} {$LBL_COMPANY} &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td>
                                    <!--<input type="text" name="Data[vBuyerName]" class="input-rag" id="vBuyerName" tabindex="3" title="{$LBL_ENTER} {$LBL_BUYER_NAME}" style="width:228px;" value="{$invdtls[0].vBuyerName}" />
                                    <input type="hidden" name="Data[iBuyerOrganizationID]" id="iBuyerOrganizationID" class="required" title="{$LBL_ENTER} {$LBL_BUYER_NAME}" value="{$invdtls[0].iBuyerOrganizationID}" />
                                            &nbsp;{$LBL_AUTO_COMPLATE}-->
                                    <span id="compcombo" style="float:left;">
                                        <select name="Data[iBuyerOrganizationID]" id="iBuyerOrganizationID" style="width:230px;" class="required" title="{$LBL_SELECT} {$LBL_BUYER} {$LBL_COMPANY}" onchange="return getorgbilldetails(this.value)" > {*}$("#iBuyerID").load(SITE_URL+"index.php?file=u-aj_getUser&icompid="+this.value+"&htmlTag=option&orgtype=buyer");{*}
                                            <option value="">---{$LBL_SELECT} {$LBL_BUYER} {$LBL_COMPANY}---</option>
                                            {if $view eq 'edit'}
                                            <option value="{$borgdtls[0].iOrganizationID}" selected="selected">{$borgdtls[0].vCompanyName}</option>
                                            {/if}
                                        </select>
                                    </span>&nbsp;
                                    <input type="text" name="compcode" id="compcode" value="({$LBL_ENTER} {$LBL_COMPANY})" onfocus="if(this.value=='({$LBL_ENTER} {$LBL_COMPANY})')this.value='';" onblur="if(this.value=='')this.value='({$LBL_ENTER} {$LBL_COMPANY})';" style="width:170px; height:17px;" />
                                    <img src="{$SITE_IMAGES}sm_images/btn-search.gif" alt="" border="0" style="cursor: pointer;vertical-align:middle;background:#f8f8f8;border:none;" onclick="return getComboVal('org');" />
                                </td>
                            </tr>
                            {else}
                            <tr>
                                <td width="225">{$LBL_BUYER} {$LBL_COMPANY}</td>
                                <td>:</td>
                                <td class="blue-ore">{$borgname}</td>
                            </tr>
                            <tr>
                                <td width="225">{$LBL_BUYER} {$LBL_CODE} </td>
                                <td>:</td>
                                <td class="blue-ore">
                                    {$bOrgCode}
                                    <input type="hidden" name="Data[vAssociatePOBuyerCode]" id="vAssociatePOBuyerCode" value="{$bOrgCode}" />
                                    <input type="hidden" name="iBuyerOrganizationID" id="iBuyerOrganizationID" value="{$curORGID}" />
                                </td>
                            </tr>
                            {/if}
                            <tr>
                                <td>{$LBL_INV_SUPPLIER_CODE} &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vInvSupplierCode]" class="input-rag required" id="vInvSupplierCode" title="{$LBL_ENTER} {$LBL_INV_SUPPLIER_CODE}" style="width:228px;" value="{$invdtls[0].vInvSupplierCode}" /></td>
                            </tr>

                            <tr>
                                <td>{$LBL_BUYER} {$LBL_CONTACT_PARTY} &nbsp;<font class="reqmsg">*</font></td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="Data[vBuyerContactParty]" class="input-rag" id="vBuyerContactParty" title="{$LBL_ENTER} {$LBL_SUPPLIER} {$LBL_CONTACT_PARTY}" style="width:228px;" value="{$invdtls[0].vBuyerContactParty}" />
                                    {*}<input type="hidden" name="Data[iBuyerID]" id="iBuyerID" title="{$LBL_ENTER} {$LBL_BUYER} {$LBL_CONTACT_PARTY}" class="required" value="{$invdtls[0].iBuyerID}" />
                                    &nbsp;{$LBL_AUTO_COMPLATE}{*}
                                    {*}<span id="usrcombo" style="float:left;">
                                        <select name="Data[iBuyerID]" id="iBuyerID"  class="required" style="width: 230px;" title="{$LBL_SELECT} {$LBL_BUYER} {$LBL_CONTACT_PARTY}" >
                                            <option value="">---{$LBL_SELECT} {$LBL_BUYER} {$LBL_CONTACT_PARTY}---</option>
                                        </select>
                                    </span>&nbsp;
                                    <input type="text" name="uname" id="uname" value="({$LBL_ENTER} {$LBL_USERNAME})" onfocus="if(this.value=='({$LBL_ENTER} {$LBL_USERNAME})')this.value='';" onblur="if(this.value=='')this.value='({$LBL_ENTER} {$LBL_USERNAME})';" />
                                    <img src="{$SITE_IMAGES}sm_images/btn-search.gif" alt="" border="0" style="cursor: pointer;vertical-align:middle;background:#f8f8f8;border:none;" onclick="return getComboVal('usr');" />{*}
                                </td>
                            </tr>
                            {*}<tr>
                                <td>{$LBL_ISSUE_DATE} </td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="Data[dIssueDate]" class="input-rag" id="dIssueDate" tabindex="5" style="width:190px;" value="{$invdtls[0].dIssueDate}" readonly="readonly" />
                                    &nbsp;<img src="{$SITE_IMAGES}sm_images/icon-calander.gif" />
                                </td>
                            </tr>{*}
                            <tr>
                                <td valign="top">{$LBL_INVOICE_DESCRIPTION} </td>
                                <td valign="top">:</td>
                                <td>
                                    <textarea name="Data[tInvoiceDescription]" class="" id="tInvoiceDescription" style="width:228px;" rows="3" >{$invdtls[0].tInvoiceDescription|stripslashes}</textarea>
                                </td>
                            </tr>

                            <tr>
                                <td>{$LBL_REFERENCE_NUMBER} </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vRegisterNumber]" class="input-rag" id="vRegisterNumber" title="{$LBL_ENTER} {$LBL_REFERENCE_NUMBER}" style="width:228px;" value="{$invdtls[0].vRegisterNumber}" /></td>
                            </tr>

                            <tr>
                                <td>{$LBL_OPENING_UNIT} </td>
                                <td>:</td>
                                <td><input type="text" name="Data[iOpeningUnit]" class="input-rag" id="iOpeningUnit" title="{$LBL_ENTER} {$LBL_OPENING_UNIT}" style="width:228px;" value="{$invdtls[0].iOpeningUnit}" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_SUPPLIER} {$LBL_ORDER_NUMBER} </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vSupplierOrderNum]" class="input-rag"  id="vSupplierOrderNum" title="{$LBL_ENTER} {$LBL_SUPPLIER} {$LBL_ORDER_NUMBER}" style="width:228px;" value="{$invdtls[0].vSupplierOrderNum}" /></td>
                            </tr>
                            {*}<tr>
                                <td>{$LBL_INVOICE_TYPE} &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td>
                                    <!--<input type="text" name="Data[eInvoiceType]" class="input-rag required"  id="eInvoiceType" tabindex="9" title="{$LBL_ENTER} {$LBL_INVOICE_TYPE}" style="width:228px;" />-->
                                    {$invoiceType}
                                </td>
                            </tr>{*}
                            <tr>
                                <td>{$LBL_LINE_ITEM_TAX} &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td>
                                    {$lineItemTax}
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_VAT} </td>
                                <td>:</td>
                                <td><input type="text" name="Data[fVAT]" class="input-rag decimals" id="fVAT" title="{$LBL_ENTER} {$LBL_VAT}" style="width:228px;" value="{$invdtls[0].fVAT}" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_OTHER_TAX} </td>
                                <td>:</td>
                                <td><input type="text" name="Data[fOtherTax1]" class="input-rag decimals" id="fOthertax1" style="width:228px;" value="{$invdtls[0].fOtherTax1}" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_WITH_HOLDING_TAX} </td>
                                <td>:</td>
                                <td><input type="text" name="Data[fWithHoldingTax]" class="input-rag decimals" id="fWithHoldingTax" style="width:228px;" value="{$invdtls[0].fWithHoldingTax}" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_FREIGHT} </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vFreight]" class="input-rag " id="vFreight" style="width:228px;" value="{$invdtls[0].vFreight}" /></td>
                            </tr>
                            <tr>
                                <td valign="top">{$LBL_MISCELLANEOUS} </td>
                                <td valign="top">:</td>
                                <td><textarea name="Data[tMiscellaneous]" id="tMiscellaneous" style="width:228px;" rows="3" >{$invdtls[0].tMiscellaneous|stripslashes}</textarea></td>
                            </tr>
                            <tr>
                                <td>{$LBL_DISCOUNT_BASELINE_DATE} </td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="Data[dCashDiscountBaseline]" class="input-rag " id="dCashDiscountBaseline" style="width:139px;" value="{if $invdtls[0].dCashDiscountBaseline neq '0000-00-00 00:00:00'}{$invdtls[0].dCashDiscountBaseline|calcLTzTime}{/if}" readonly="readonly" />
                                    {*&nbsp;<img src="{$SITE_IMAGES}sm_images/icon-calander.gif" id="cal2"/>*}
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_MAXCASH_DISCOUNTDAYS} </td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="Data[iMaxCashDiscountDays]" class="input-rag digits" id="iMaxCashDiscountDays" style="width:190px;" value="{$invdtls[0].iMaxCashDiscountDays}" />
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_MAXCASH_DISCOUNTPERCENT} </td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="Data[fMaxCashDiscountPercentage]" class="input-rag decimals max" id="fMaxCashDiscountPercentage" style="width:190px;" max="100" value="{$invdtls[0].fMaxCashDiscountPercentage|substr:0:5}" title="{$LBL_ENTER} {$LBL_MAXCASH_DISCOUNTPERCENT}" maxlength="5" />
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_NORMALCASH_DISCOUNTDAYS} </td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="Data[iNormalCashDiscountDays]" class="input-rag digits" id="iNormalCashDiscountDays" style="width:228px;" value="{$invdtls[0].iNormalCashDiscountDays}" />
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_NORMALCASH_DISCOUNTPERCNET} </td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="Data[iNormalCashDiscountPercentage]" class="input-rag decimals max" max="100" id="iNormalCashDiscountPercentage" style="width:228px;" value="{$invdtls[0].iNormalCashDiscountPercentage|substr:0:5}" title="{$LBL_ENTER} {$LBL_NORMALCASH_DISCOUNTPERCNET}" maxlength="5" />
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_NET_PAYMENT_DAYS} </td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="Data[iNetPaymentDays]" class="input-rag digits" id="iNetPaymentDays" style="width:228px;" value="{$invdtls[0].iNetPaymentDays}" />
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_NET_PAYMENT_DATE} </td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="Data[dNetPaymentdate]" class="input-rag " id="dNetPaymentdate" style="width:139px;" value="{$invdtls[0].dNetPaymentdate|calcLTzTime}" readonly="readonly" />
                                    {*&nbsp;<img src="{$SITE_IMAGES}sm_images/icon-calander.gif" id="cal3"/>*}
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_BILL_TO}  {$LBL_PARTY} &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vBillToParty]" class="input-rag required" id="vBillToParty" title="{$LBL_ENTER} {$LBL_BILL_TO}  {$LBL_PARTY}" style="width:228px;" value="{$invdtls[0].vBillToParty}" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_BILL_TO} {$LBL_ADDR_LINE}1 &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vBillToAddLine1]" class="input-rag required" id="vBillToAddLine1" title="{$LBL_ENTER} {$LBL_BILL_TO} {$LBL_ADDR_LINE}" style="width:228px;" value="{$invdtls[0].vBillToAddLine1}" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_BILL_TO} {$LBL_ADDR_LINE}2 </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vBillToAddLine2]" class="input-rag" id="vBillToAddLine2" style="width:228px;" value="{$invdtls[0].vBillToAddLine2}" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_BILL_TO} {$LBL_CITY}&nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vBillToCity]" class="input-rag required" id="vBillToCity" title="{$LBL_ENTER} {$LBL_BILL_TO} {$LBL_CITY}" style="width:228px;" value="{$invdtls[0].vBillToCity}" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_BILL_TO} {$LBL_COUNTRY} &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td>
                                    <select name="Data[vBillToCountry]" id="vBillToCountry" class="drop-down required" title="{$LBL_SELECT}&nbsp;{$LBL_BILL_TO} {$LBL_COUNTRY}" onchange="getRelativeCombo(this.value,'{$invdtls[0].vBillToState}','vBillToState','-- {$LBL_SELECT} {$LBL_COUNTRY} --',stateArr);fillCountryCode(this);" style="width:230px;">
                                        <option value=""> --- {$LBL_SELECT} {$LBL_BILL_TO} {$LBL_COUNTRY} --- </option>
                                        {section name=i loop=$db_country}
                                        <option  title="{$db_country[i].iCountryISD}" currency="{$db_country[i].iCurrencyID}" value="{$db_country[i].vCountryCode}" {if $invdtls[0].vBillToCountry eq $db_country[i].vCountryCode} selected {/if} >{$db_country[i].vCountry}</option>
                                        {/section}
                                    </select>

                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_BILL_TO} {$LBL_STATE}&nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td><!--<input type="text" name="Data[vBillToState]" class="input-rag required" id="vBillToState" tabindex="36" title="{$LBL_ENTER} {$LBL_BILL_TO} {$LBL_STATE}" style="width:228px;" />-->
                                    <select name ="Data[vBillToState]" id="vBillToState" style="width:230px" title="{$LBL_SELECT} {$LBL_BILL_TO} {$LBL_STATE}" class="required" >
                                        <option value="">{$LBL_SELECT} {$LBL_STATE} </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_BILL_TO} {$LBL_ZIP_CODE} &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vBillToZipCode]" class="input-rag required" id="vBillToZipCode" title="{$LBL_ENTER} {$LBL_BILL_TO} {$LBL_ZIP_CODE}" style="width:228px;" value="{$invdtls[0].vBillToZipCode}" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_BILL_TO} {$LBL_CONTACT_PARTY} &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vBillToContactParty]" class="input-rag required" id="vBillToContactParty" title="{$LBL_ENTER} {$LBL_BILL_TO} {$LBL_CONTACT_PARTY}" style="width:228px;" value="{$invdtls[0].vBillToContactParty}" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_BILL_TO} {$LBL_CONTACT_TELEPHONE} &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td  valign="top">
                                    <input type="text" name="vBillToContactTelephoneCode"  value="{$invdtls[0].vBillToContactTelephoneCode}" class="input-rag" id="vBillToContactTelephoneCode" style="width:30px;" maxlength="3" onkeypress="return chkValidPhone(event)" title="{$LBL_COUNTRY_CODE}"/>
                                    <input type="text" name="Data[vBillToContactTelephone]" class="input-rag required" id="vBillToContactTelephone" onkeypress="return chkValidPhone(event)" title="{$LBL_ENTER} {$LBL_BILL_TO} {$LBL_CONTACT_TELEPHONE}" style="width:190px;" maxlength="15" value="{$invdtls[0].vBillToContactTelephone}" />

                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_CURRENCY} &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td>
                                    <select name="Data[vCurrency]" id="vCurrency" class="required" style="width:96px;" title="Enter Currency" >
                                        {section name="c" loop=$currency}
                                        <option value="{$currency[c].vCode|htmlentities}" id="{$currency[c].iCurrencyID}_1" {if $currency[c] eq $invdtls[0].vCurrency}selected="selected"{/if} >{$currency[c].vCode}</option>
                                        {/section}
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_VAT_ID} </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vVatId]" class="input-rag" id="vVatId" style="width:228px;" value="{if $invdtls[0].vVatId neq ''}{$invdtls[0].vVatId}{else}{$orgdtls[0].vVatId}{/if}" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_BANK} </td>
                                <td>:</td>
                                <td>
                                    <select name="Data[iBankId]" id="iBankId" class="required" title="{$LBL_SELECT} {$LBL_BANK}">
                                        {section name="l" loop=$bnk_dtls}
                                        <option value="{$bnk_dtls[l].iBankId}" {if $invdtls[0].iBankId >0}{if $bnk_dtls[l].iBankId eq $invdtls[0].iBankId}selected="selected"{/if}{elseif $bnk_dtls[l].iBankId eq $orgdtls[0].iBankId}selected="selected"{/if}>{$bnk_dtls[l].vBankName}</option>
                                        {/section}
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_BANK_CODE} </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vBankCode]" class="input-rag" id="vBankCode" style="width:228px;" value="{if $invdtls[0].vBankCode neq ''}{$invdtls[0].vBankCode}{else}{$orgdtls[0].vBankCode}{/if}" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_BRANCH} </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vBranchName]" class="input-rag" id="vBranchName" style="width:228px;" value="{if $invdtls[0].vBranchName neq ''}{$invdtls[0].vBranchName}{else}{$orgdtls[0].vBranchName}{/if}" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_BRANCH_CODE} </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vBranchCode]" class="input-rag" id="vBranchCode" style="width:228px;" value="{if $invdtls[0].vBranchCode neq ''}{$invdtls[0].vBranchCode}{else}{$orgdtls[0].vBranchCode}{/if}" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_ACCOUNT} {$LBL_TITLE}</td>
                                <td>:</td>
                                <td><input type="text" name="Data[vAccountName]" class="input-rag" id="vAccountName" style="width:228px;" value="{if $invdtls[0].vAccountName neq ''}{$invdtls[0].vAccountName}{else}{$orgdtls[0].vAccount1Title}{/if}" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_ACCOUNT} {$LBL_NUMBER}</td>
                                <td>:</td>
                                <td><input type="text" name="Data[vAccountNumber]" class="input-rag" id="vAccountNumber" style="width:228px;" value="{if $invdtls[0].vAccountNumber neq ''}{$invdtls[0].vAccountNumber}{else}{$orgdtls[0].vAccount1Number}{/if}" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_IBAN}</td>
                                <td>:</td>
                                <td><input type="text" name="Data[vIBAN]" class="input-rag" id="vIBAN" style="width:228px;" value="{if $invdtls[0].vIBAN neq ''}{$invdtls[0].vIBAN}{else}{$bnkdtl[0].vIBAN}{/if}" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_INVOICE_TOTAL} </td>
                                <td>:</td>
                                <td><input type="text" name="Data[fInvoiceTotal]" class="input-rag decimals" id="fInvoiceTotal" style="width:228px;" value="{$invdtls[0].fInvoiceTotal}" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_PRE_PAYMENT} </td>
                                <td>:</td>
                                <td><input type="text" name="Data[fPrePayment]" class="input-rag decimals" id="fPrePayment" title="{$LBL_ENTER} {$LBL_PRE_PAYMENT}" style="width:228px;" value="{$invdtls[0].fPrePayment}" /></td>
                            </tr>
                            {*<tr>
                                <td>{$LBL_INVOICE_PAYABLE} ({$LBL_ACCEPTED}) {$LBL_AMOUNT} &nbsp;<font class="reqmsg">*</font></td>
                                <td>:</td>
                                <td><input type="text" name="Data[fAcceptedAmount]" class="input-rag required decimals min" min="1" id="fAcceptedAmount" style="width:228px;" value="{$invdtls[0].fAcceptedAmount}" title="{$LBL_ENTER} {$LBL_INVOICE_PAYABLE} ({$LBL_ACCEPTED}) {$LBL_AMOUNT}" /></td>
                            </tr>*}
                            <tr>
                                <td valign="top">{$LBL_ATTACH_DOCUMENT}</td>
                                <td valign="top">:</td>
                                <td> <input type="file" name="upload" id="upload" />
                                    <div id="files_list" class="file_upload">
                                        <ul style="list-style-type: none">
                                            {foreach from=$invAttachments item="invAttach"}
                                            <li>
                                                <a href="javascript:openpopup('{$SITE_URL_DUM}upload/attachment_docs/invoice/{$iInvoiceID}/{$invAttach.vFile}')" > {$invAttach.vFile}</a><input type="button" value="Delete" onclick="deleteFile($(this).parent(),'{$invAttach.iAttachmentID}');"/>
                                            </li>
                                            {/foreach}
                                        </ul>
                                        <input type="hidden" name="deleteFiles" id="deleteFiles"/>
                                    </div>
                                </td>
                            </tr>
                            {if $invdtls[0].eSaved neq 'No' || $invad eq 'yes'}
                            <tr>
                                <td>{*$LBL_SAVE_STATUS} Save Status&nbsp;{*}</td>
                                <td></td>
                                <td>
                                    <input type="hidden" name="Data[eSaved]"  id="eSaved" value="{$invdtls[0].eSaved}" />
                                </td>
                            </tr>
                            {/if}
                            {if $invdtls[0].tReasonToReject|trim neq '' && $invdtls[0].eStatus eq $rjtsts}
                            <tr>
                                <td valign="top">{$LBL_REASON_TO_REJECT} </td>
                                <td valign="top">:</td>
                                <td><div style="background:#fafafa; border:1px solid #cccccc; height:30px; width:390px; overflow-y:scroll;">{$invdtls[0].tReasonToReject|trim}</div></td>
                            </tr>
                            {/if}
                            <tr>
                                <td colspan="2" height="5"></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td colspan="2"><a href="javascript:void(0)">
                                        <img src="{$SITE_IMAGES}sm_images/btn-next.gif" alt="" border="0"  id="btnSubmit" name="Submit" title="submit" src="images/btn-submit.gif" alt="" onclick="$('#eSaved').val('Yes'); $('#eFrom').val('Next'); return submitFrm();" style="vertical-align:middle;"/></a>
                                    <a ><img src="{$SITE_IMAGES}sm_images/btn-reset.gif" alt="" border="0"  onclick="resetFrm();" style="vertical-align:middle;"/></a>
                                    <a ><img src="{$SITE_IMAGES}sm_images/btn-cancel.gif" alt="" border="0" onclick="location.href='{$SITE_URL_DUM}invacptlist/{$smarty.session.invlvl}'" style="vertical-align:middle;"/></a>&nbsp;
                                    {if $invdtls[0].eSaved neq 'No'  && $view neq ''} <!-- || $invad eq 'yes'-->
                                    <img src="{$SITE_IMAGES}save-btn.gif" alt="" border="0"  id="btnSave" name="Save" title="save" src="images/btn-submit.gif" alt="" onclick="$('#eSaved').val('Yes'); return submitFrm();" style="vertical-align:middle; cursor:pointer;"/>
                                    {/if}
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div>&nbsp;</div>
            </div>
        </div>
    </div>
    <span id="sn" style="display:hidden;"></span>
    <span id="spn" style="display:hidden;"></span>
    <span id="vldms" style="display:none;"></span>
</div>

<script language="JavaScript" src="{$S_JQUERY}jquery.autocomplete.js"></script>
<link type="text/css" rel="stylesheet" media="screen" href="{$SITE_CSS}jquery.autocomplete.css" />
<script type="text/javascript" src="{$S_JQUERY}jquery-ui-timepicker.js"></script>
<!--<script type="text/javascript" src="{*$DATETIMEPICKER}jquery.dynDateTime.js"></script>
<script type="text/javascript" src="{$DATETIMEPICKER}lang/calendar-en.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="{$DATETIMEPICKER*}css/calendar-blue.css"  />-->
<script type="text/javascript" src="{$SITE_JS_AJAX}jgetinvpo.js"></script>
<script type="text/javascript" src="{$SITE_JS_AJAX}jinvoicecreate.js"></script>
<script type="text/javascript" src="{$SITE_CONTENT_JS}multifile.js"></script>
{literal}
<script type="text/javascript">
    var corg = '{/literal}{$curORGID}{literal}';
    var sid = '{/literal}{$sid}{literal}';

    if(document.getElementById('upload'))
    {
        var multiSelect = new MultiSelector( document.getElementById('files_list'), 3);
        multiSelect.addElement(document.getElementById('upload'));
    }
    var fileArr=new Array();
    function deleteFile(obj,fileid)
    {
        fileArr.push(fileid);
        $('#deleteFiles').val(fileArr);
        obj.html("");
    }

    var view = '{/literal}{$view}{literal}';
    var org = $('#vSupplierName').val();

    function submitFrm()
    {
        $('#frmadd').submit();
        $(document).ready( function() {
            $(function() {
                var ead=10;
                $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
            });
        });
    }
    function resetFrm() {
        $('#frmadd')[0].reset();
    }

    if(view != 'edit') {
        $("#frmadd").validate({
            rules:{
                "Data[vExtPOCode]": {
                    remote: {
                        url:SITE_URL+"index.php?file=u-aj_chkdupdata"+"&extfld=iSupplierOrganizationID&extval="+corg,
                        type:"get",
                        data:{
                            val:function() {
                                return $("#iInvoiceID").val();
                            },
                            id:function() {
                                return "iInvoiceID";
                            },
                            field:function() {
                                return "vExtPOCode";
                            },
                            table:function() {
                                return "{/literal}{$PRJ_DB_PREFIX}{literal}_inovice_order_heading";
                            }
                        }
                    }
                },
                "Data[vBillToContactTelephone]":{
                    required: function(){
                        if($.trim($('#vBillToContactTelephoneCode').val()) == ''){
                            $('#vBillToContactTelephone').attr("title","{/literal}{$LBL_COUNTRY_CODE}{literal}");

                        }else {
                            $('#vBillToContactTelephone').attr("title","{/literal}{$LBL_ENTER} {$LBL_BILL_TO} {$LBL_CONTACT_TELEPHONE}{literal}");
                        }
                    }
                },
                "Data[vInvSupplierCode]": {
                    remote:{
                        url:SITE_URL+"index.php?file=u-aj_chkdupdata"+"&extfld=iSupplierOrganizationID&extval="+corg,
                        type:"get",
                        data:{
                            val:function() {
                                return $("#iInvoiceID").val();
                            },
                            id:function() {
                                return "iInvoiceID";
                            },
                            field:function() {
                                return "vInvSupplierCode";
                            },
                            table:function() {
                                return "{/literal}{$PRJ_DB_PREFIX}{literal}_inovice_order_heading";
                            }
                        }
                    }
                }
            },
            messages:{
                "Data[fInvoiceTotal]":{
                    decimals: LBL_NUMERIC_ONLY
                },
                /*"Data[fAcceptedAmount]":{
                                                 decimals: LBL_NUMERIC_ONLY, min: LBL_VALUE_MUST_BE_GREATER_THAN_ZERO
                                         },*/
                "Data[fPrePayment]": {
                    decimals: LBL_NUMERIC_ONLY
                },
                "Data[fVAT]": {
                    decimals: LBL_NUMERIC_ONLY
                },
                "Data[fOtherTax1]": {
                    decimals: LBL_NUMERIC_ONLY
                },
                "Data[fWithHoldingTax]": {
                    decimals: LBL_NUMERIC_ONLY
                },
                "Data[iMaxCashDiscountDays]": {
                    digits: LBL_DIGITS_ONLY
                },
                "Data[fMaxCashDiscountPercentage]": {
                    decimals: LBL_DIGITS_ONLY,
                    max: LBL_EXCEEDS_MAX_VALUE_OF_PERCENT
                },
                "Data[iNormalCashDiscountDays]": {
                    digits: LBL_DIGITS_ONLY
                },
                "Data[iNormalCashDiscountPercentage]": {
                    decimals: LBL_DIGITS_ONLY,
                    max: LBL_EXCEEDS_MAX_VALUE_OF_PERCENT
                },
                "Data[iNetPaymentDays]": {
                    digits: LBL_DIGITS_ONLY
                },
                "Data[vInvSupplierCode]": {
                    required: LBL_ENTER_INV_SUPPLIER_CODE,
                    remote: jQuery.validator.format(LBL_INV_SUPPLIER_CODE_INUSE)
                },
                "Data[vExtPOCode]": {
                    remote: jQuery.validator.format(LBL_CODE_INUSE)
                }
            }
        });
    } else {
        $("#iBuyerID").load(SITE_URL+"index.php?file=u-aj_getUser&icompid="+'{/literal}{$invdtls[0].iBuyerOrganizationID}{literal}'+"&htmlTag=option&orgtype=buyer"+"&val={/literal}{$invdtls[0].iBuyerID}{literal}")
        $("#frmadd").validate( {
            rules: {
                "Data[vBillToContactTelephone]": {
                    required: function() {
                        if($.trim($('#vBillToContactTelephoneCode').val()) == '') {
                            $('#vBillToContactTelephone').attr("title","{/literal}{$LBL_COUNTRY_CODE}{literal}");
                        } else {
                            $('#vBillToContactTelephone').attr("title","{/literal}{$LBL_ENTER} {$LBL_BILL_TO} {$LBL_CONTACT_TELEPHONE}{literal}");
                        }
                    }
                }
            },
            messages: {
                "Data[fInvoiceTotal]":{
                    decimals: LBL_NUMERIC_ONLY
                },
                /*"Data[fAcceptedAmount]": {
                                                  decimals: LBL_NUMERIC_ONLY, min: LBL_VALUE_MUST_BE_GREATER_THAN_ZERO
                                         },*/
                "Data[fPrePayment]": {
                    decimals: LBL_NUMERIC_ONLY
                },
                "Data[fVAT]": {
                    decimals: LBL_NUMERIC_ONLY
                },
                "Data[fOtherTax1]": {
                    decimals: LBL_NUMERIC_ONLY
                },
                "Data[fWithHoldingTax]": {
                    decimals: LBL_NUMERIC_ONLY
                },
                "Data[iMaxCashDiscountDays]": {
                    digits: LBL_DIGITS_ONLY
                },
                "Data[fMaxCashDiscountPercentage]": {
                    decimals: LBL_DIGITS_ONLY,
                    max: LBL_EXCEEDS_MAX_VALUE_OF_PERCENT
                },
                "Data[iNormalCashDiscountDays]": {
                    digits: LBL_DIGITS_ONLY
                },
                "Data[iNormalCashDiscountPercentage]": {
                    decimals: LBL_DIGITS_ONLY,
                    max: LBL_EXCEEDS_MAX_VALUE_OF_PERCENT
                },
                "Data[iNetPaymentDays]": {
                    digits: LBL_DIGITS_ONLY
                }
            }
        });
    }
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
        $('#iBuyerID').val(totValID);
        //	alert(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+iOrgId+"&iUserID="+totValID);
        //$('#OrgStatus_Div').load(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+totValID);		// +"&iOrgId="+iOrgId
    }
    function selectUsrItem(li) {
        findUserValue(li);
    }
    function setuser()
    {
        $("#vBuyerContactParty").autocomplete(
        SITE_URL+"index.php?file=u-aj_getUser&icompid="+$('#iBuyerOrganizationID').val(),
        {
            delay:10,
            minChars:1,
            matchSubset:1,
            matchContains:1,
            cacheLength:10,
            onItemSelect:selectUsrItem,
            onFindValue:findUserValue,
            formatItem:formatItem,
            autoFill:false
        });
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
        $('#iBuyerOrganizationID').val(totValID);
        $('#vBuyerContactParty').val('');
        $('#iBuyerID').val('');
        //$('#result').load(SITE_URL+"index.php?file=u-aj_getOrganizationUser&type=user&iId="+totValID+"");
        //$('#OrgStatus_Div').load(SITE_URL+"index.php?file=or-aj_getOrganizationStatus&type=user&iId="+totValID+"");
        if(totValID != '') { setuser(); }
    }
    function selectItem(li) {
        findValue(li);
    }

    // if(org == '') {
    $(document).ready(function() {
        $("#vBuyerName").autocomplete(
        SITE_URL+"index.php?file=or-aj_getOrganization&orgid="+$('#iSupplierOrganizationID').val()+"&orgtype=buyer",
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
        });
    });
    // }

    jQuery(document).ready(function()
    {
        $("#dCashDiscountBaseline").attr('readonly','readonly');
        // $("#dtpCashDiscountBaseline").datepicker({
        $("#dCashDiscountBaseline").datepicker({
            // altField: '#dCashDiscountBaseline',
            dateFormat: 'yy-mm-dd',
            // timeFormat: 'hh:mm:ss',
            showOn: "button",
            buttonImage: "{/literal}{$SITE_IMAGES}{literal}calendar.png",
            buttonImageOnly: true,
            onSelect: function(dateText, inst) {
                $(document).ready(function(dateText, inst) {
                    var ead = 10;
                    $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
                });
            },
            onClose: function() {
                $(document).ready(function(dateText, inst) {
                    var ead = 10;
                    $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
                });
            }
        });
        //
        $("#dNetPaymentdate").attr('readonly','readonly');
        $("#dNetPaymentdate").datepicker({
            dateFormat: 'yy-mm-dd',
            // timeFormat: 'hh:mm:ss',
            showOn: "both",
            buttonImage: "{/literal}{$SITE_IMAGES}{literal}calendar.png",
            buttonImageOnly: true,
            onSelect: function(dateText, inst) {
                $(document).ready(function(dateText, inst) {
                    var ead = 10;
                    $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
                });
            },
            onClose: function() {
                $(document).ready(function(dateText, inst) {
                    var ead = 10;
                    $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
                });
            }
        });
        /*var cal2Pos=$('#cal2').position();
        jQuery("#dCashDiscountBaseline").dynDateTime({
            showsTime: true,
            ifFormat: "%Y-%m-%d",
            daFormat: "%l;%M %p, %e %m, %Y",
            align: "TL",
            electric: false,
            singleClick: false,
            button:".next()",
            displayArea: ".siblings('.dtcDisplayArea')"
            //position:[cal2Pos.left-230,0]
        });
        var cal3Pos=$('#cal3').position();
        jQuery("#dNetPaymentdate").dynDateTime({
            showsTime: true,
            ifFormat: "%Y-%m-%d",
            daFormat: "%l;%M %p, %e %m, %Y",
            align: "TL",
            electric: false,
            singleClick: false,
            button:".next()",
            displayArea: ".siblings('.dtcDisplayArea')"
            // position:[cal3Pos.left-230,10]
        });*/
    });
    //$(element).offset();
    function fillCountryCode(obj)
    {    var opt=obj.options[obj.selectedIndex];
        var currency=opt.getAttribute("currency");
        $('#vBillToContactTelephoneCode').val(opt.title);
        $('#vCurrency option[id="'+currency+'_1"]').attr("selected","selected");
    }
    function setT()
    {
        if($('#eLineItemTax').val()=='Yes') {
            $('#fVAT').val('');
            $('#fOthertax1').val('');
            $('#fWithHoldingTax').val('');
            $('#fVAT').attr('disabled','disabled');
            $('#fOthertax1').attr('disabled','disabled');
            $('#fWithHoldingTax').attr('disabled','disabled');
            $('#fVAT').css('background-color','#eeeeee');
            $('#fOthertax1').css('background-color','#eeeeee');
            $('#fWithHoldingTax').css('background-color','#eeeeee');

        } else {
            $('#fVAT').attr('disabled','');
            $('#fOthertax1').attr('disabled','');
            $('#fWithHoldingTax').attr('disabled','');
            $('#fVAT').css('background-color','#ffffff');
            $('#fOthertax1').css('background-color','#ffffff');
            $('#fWithHoldingTax').css('background-color','#ffffff');
        }
    }
    $(document).ready(function() {
        setT();
		//
		// getRelativeCombo($('#vSupplierCountry').val(),"{/literal}{$userData.vSupplierState}{literal}",'vSupplierState','---{/literal}{$LBL_SELECT} {$LBL_SUPPLIER} {$LBL_STATE}---{literal}',stateArr);
		// getRelativeCombo($('#vShipToCountry').val(),"{/literal}{$userData.vShipToState}{literal}",'vShipToState','---{/literal}{$LBL_SELECT} {$LBL_SHIP_TO} {$LBL_STATE}---{literal}',stateArr);
		getRelativeCombo($('#vBillToCountry').val(),"{/literal}{$invdtls[0].vBillToState}{literal}",'vBillToState','---{/literal}{$LBL_SELECT} {$LBL_BILL_TO} {$LBL_STATE}---{literal}',stateArr);
		// $('#iBuyerOrganizationID').load(SITE_URL+"index.php?file=or-aj_getOrganization"+"&orgtype=buyer"+"&htmlTag=option"+"&val="+'{/literal}{$invdtls[0].iBuyerOrganizationID}{literal}');
		// fillInvData($('#vInvoiceCode option:selected').attr('id'));
		fillInvData($('#iPurchaseOrderID option:selected').attr('id'));
		//
    });
    function getorgbilldetails(vl) {
        pars = "&orgid="+vl+"&type=sup"+"&frm=inv";
        url = SITE_URL+"index.php?file=m-aj_getOrgBillDetails";
        $('#sn').load(url+pars);
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
{if $mmsg neq ''}
{literal}
<script>
    $(document).ready(function() {
        var mmsg='{/literal}{$mmsg}{literal}';
        if(mmsg!= '' && mmsg != undefined)
            alert(mmsg);
    });
</script>
{/literal}
{/if}