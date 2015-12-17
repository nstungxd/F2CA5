<script type="text/javascript" src="{$S_JQUERY}jquery.validate.js"></script>
{literal}
<script type="text/javascript" >
    var stateArr = new Array({/literal}{$stateArr}{literal});
    //alert(stateArr);
</script>
{/literal}

<div class="middle-container">
    <h1>{$LBL_CREATE_PURCHASE_ORDER}</h1>
    <div class="middle-containt">
        <div class="statistics-main-box-white">
            <div>
                <ul id="inner-tab">
                    {*}<li><a href="{$SITE_URL_DUM}purchaseordercreate" class="current"><EM>{$LBL_CREATE_PURCHASE_ORDER}</EM></a></li>
                    <li>{if $view eq 'edit'}<a href="{$SITE_URL_DUM}purchaseorderadditems/{$iPurchaseOrderID}" >{else}<a>{/if}<EM>{$LBL_ADD_ITEM}</EM></a></li>{*}
                    <li><a href="{$SITE_URL_DUM}purchaseordercreate" class="current"><em>{$LBL_PO_HEADER}</em></a></li>
                    <li>{if $view eq 'edit'}<a href="{$SITE_URL_DUM}popref/{$iPurchaseOrderID}" >{else}<a>{/if}<em>{$LBL_PREFERENCES}</em></a></li>
                    <li>{if $view eq 'edit'}<a href="{$SITE_URL_DUM}purchaseorderadditems/{$iPurchaseOrderID}" >{else}<a>{/if}<em>{$LBL_LINE_ITEM}</em></a></li>
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
                    <form name="frmadd" id="frmadd" action="{$SITE_URL}index.php?file=u-purchaseordercreate_a"  method="post" enctype="multipart/form-data">
                        <input type="hidden" name="iPurchaseOrderID" id="iPurchaseOrderID" value="{$iPurchaseOrderID}" />
                        <input type="hidden" name="iPOID" id="iPOID" value="{$iPurchaseOrderID}" />
                        <input type="hidden" name="view" id="view" value="{$view}" />
                        <input type="hidden" name="Data[eFrom]" id="eFrom" value="" />
                        <table width="97%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
                            <tr><td colspan="3" align="right"><font size="2" color="red"><b>{$var_msg}</b></font></td></tr>
                            <tr>
                                <td width="225">{$LBL_BUYER} {$LBL_COMP_NAME}</td>
                                <td>:</td>
                                <td class="blue-ore">{$orgname}</td>
                            </tr>
                            <tr>
                                <td width="225">{$LBL_BUYER} {$LBL_CODE} </td>
                                <td>:</td>
                                <td class="blue-ore">
                                    {$OrgCode}
                                    <input type="hidden" name="iBuyerOrganizationID" id="iBuyerOrganizationID" value="{$curORGID}" />
                                </td>
                            </tr>
                            {*}<tr>
                                <td>{$LBL_ASSOCIATION_CODE}&nbsp; </td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="vAssociationCode" class="input-rag" id="vAssociationCode" tabindex="1" title="{$LBL_ENTER} {$LBL_ASSOCIATION_CODE}" style="width:228px;" value="{$asocdtls[0].vAssociationCode}" />
                                    <input type="hidden" name="vAssocCode" id="vAssocCode" class="" value="{$asocdtls[0].vAssociationCode}" title="{$LBL_ENTER} {$LBL_ASSOCIATION}" />
                                    &nbsp;{$LBL_AUTO_COMPLATE}
                                </td>
                            </tr>{*}
                            {*}<tr>
                                <td>{$LBL_ASSOCIATION_CODE}&nbsp; </td>
                                <td>:</td>
                                <td>
                                    <!--<input type="text" name="vAssociationCode" class="input-rag" id="vAssociationCode" tabindex="1" title="{$LBL_ENTER} {$LBL_ASSOCIATION_CODE}" style="width:228px;" value="{$asocdtls[0].vAssociationCode}" />
                                    <input type="hidden" name="vAssocCode" id="vAssocCode" class="" value="{$asocdtls[0].vAssociationCode}" title="{$LBL_ENTER} {$LBL_ASSOCIATION}" />-->
                                    <span id="asoccombo">
                                        <select name="vAssocCode" id="vAssocCode" style="width:230px;">
                                            <option value="">---{$LBL_SELECT} {$LBL_ASSOCIATION}---</option>
                                        </select>
                                    </span>&nbsp;
                                    <input type="text" name="asoc" id="asoc" value="({$LBL_ENTER} {$LBL_ASSOCIATION_CODE})" onfocus="if(this.value=='({$LBL_ENTER} {$LBL_ASSOCIATION_CODE})')this.value='';" onblur="if(this.value=='')this.value='({$LBL_ENTER} {$LBL_ASSOCIATION_CODE})';" />
                                    <img src="{$SITE_IMAGES}sm_images/btn-search.gif" alt="" border="0" style="cursor: pointer;vertical-align:middle;background: #f8f8f8;border:none;" onclick="return getComboVal('asoc');" />
                                </td>
                            </tr>{*}
                            {*<tr>
                                <td>{$LBL_SELECT_PO}&nbsp;</td>
                                <td>:</td>
                                <td>
                                    <!--<input type="text" name="Data[vPOCode]" id="vPOCode" tabindex="2" class="input-rag" value="{$podtls[0].vPOCode}" />
                                      &nbsp;{$LBL_AUTO_COMPLATE}-->
                                    <span id="pocombo" style="float:left;">
                                        <select name="vPOCode" id="vPOCode"  style="width: 230px;" onchange="fillPoData(this.options[this.selectedIndex].id)">
                                            <option value="">---{$LBL_SELECT_PO}---</option>
                                            {*foreach from=$POCodeData item="POCode"}
                                            <option value="{$POCode.vTitle}"  id="{$POCode.Id}" {if $POCode.vTitle eq $podtls[0].vPOCode}selected{/if} >{$POCode.vTitle}</option>
                                            {/foreach}
                                        </select>
                                    </span>&nbsp;
                                    <input type="text" name="poc" id="poc" value="({$LBL_ENTER} {$LBL_PO_BUYER_CODE})" onfocus="if(this.value=='({$LBL_ENTER} {$LBL_PO_BUYER_CODE})')this.value='';" onblur="if(this.value=='')this.value='({$LBL_ENTER} {$LBL_PO_BUYER_CODE})';" style="width:170px; height:17px;" />
                                    <img src="{$SITE_IMAGES}sm_images/btn-search.gif" alt="" border="0" style="cursor: pointer;vertical-align:middle;background: #f8f8f8;border:none;" onclick="return getComboVal('po');" />
                                </td>
                            </tr>*}
                            {*<tr>
                                <td>{$LBL_INV_CODE} </td>
                                <td>:</td>
                                <td>
                                    <!--  <input type="text" name="vInvoiceCode" class="input-rag" id="vInvoiceCode" tabindex="3" title="{$LBL_ENTER} {$LBL_INV_CODE}" style="width:228px;" value="{$asocdtls[0].vAssociationCode}" />
                                      <input type="hidden" name="iInvoiceID" id="iInvoiceID" class="" value="{$podtls[0].iInvoiceID}" title="{$LBL_ENTER} {$LBL_INVOICE}" />
                                      &nbsp;{$LBL_AUTO_COMPLATE}-->
                                    <span id="invcombo" style="float:left;">
                                        <select name="Data[iInvoiceID]" id="iInvoiceID" style="width: 230px;" onchange="fillPoData(this.options[this.selectedIndex].id)" >
                                            <option value="">---{$LBL_SELECT_INVOICE}---</option>
                                            {if $invdl|is_array && $invdl|@count>0}
                                            <option value="{$invdl[0].iInvoiceID}" selected=selected">{$invdl[0].vInvoiceCode}</option>
                                            {/if}
                                            {*foreach from=$invoiceCodeData item="invoiceCode"}
                                            <option value="{$invoiceCode.Id}"  title="{$invoiceCode.vTitle}" id="{$invoiceCode.Id}" {if $invoiceCode.Id eq $podtls[0].iInvoiceID}selected{/if} >{$invoiceCode.vTitle}</option>
                                            {*/foreach}
                                        </select>
                                    </span>&nbsp;
                                    <input type="text" name="inv" id="inv" value="({$LBL_ENTER} {$LBL_INV_SUPPLIER_CODE})" onfocus="if(this.value=='({$LBL_ENTER} {$LBL_INV_SUPPLIER_CODE})')this.value='';" onblur="if(this.value=='')this.value='({$LBL_ENTER} {$LBL_INV_SUPPLIER_CODE})';" style="width:170px; height:17px;" />
                                    <img src="{$SITE_IMAGES}sm_images/btn-search.gif" alt="" border="0" style="cursor: pointer;vertical-align:middle;background: #f8f8f8;border:none;" onclick="return getComboVal('inv');" />
                                </td>
                            </tr>*}
                            <tr>
                                <td>{$LBL_SUPPLIER} {$LBL_COMPANY} &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td>
                                    <!-- <input type="text" name="Data[vSupplierName]" class="input-rag" id="vSupplierName" tabindex="4" title="{$LBL_ENTER} {$LBL_SUPPLIER_NAME}" style="width:228px;" value="{$podtls[0].vSupplierName}" />
                                      <input type="hidden" name="Data[iSupplierOrganizationID]" id="iSupplierOrganizationID" class="required" value="{$podtls[0].iSupplierOrganizationID}" title="{$LBL_ENTER} {$LBL_SUPPLIER_NAME}"/>
                                      &nbsp;{$LBL_AUTO_COMPLATE}-->
                                    <span id="compcombo" style="float:left;">
                                        <select name="Data[iSupplierOrganizationID]" class="required" id="iSupplierOrganizationID" style="width:230px" title="{$LBL_SELECT} {$LBL_SUPPLIER} {$LBL_COMPANY}" onchange="return getorgbilldetails(this.value)"> {*}// $("#iSupplierID").load(SITE_URL+"index.php?file=u-aj_getUser&icompid="+this.value+"&htmlTag=option&orgtype=supplier");{*}
                                            <option value="">---{$LBL_SELECT} {$LBL_SUPPLIER} {$LBL_COMPANY}---</option>
                                            {if $view eq 'edit'}
                                            <option value="{$sorgdtls[0].iOrganizationID}" selected="selected">{$sorgdtls[0].vCompanyName}</option>
                                            {/if}
                                        </select>
                                    </span>&nbsp;
                                    <input type="text" name="compcode" id="compcode" value="({$LBL_ENTER} {$LBL_COMPANY})" onfocus="if(this.value=='({$LBL_ENTER} {$LBL_COMPANY})')this.value='';" onblur="if(this.value=='')this.value='({$LBL_ENTER} {$LBL_COMPANY})';" style="width:170px; height:17px;" />
                                    <img src="{$SITE_IMAGES}sm_images/btn-search.gif" alt="" border="0" style="cursor: pointer;vertical-align:middle;background:#f8f8f8;border:none;" onclick="return getComboVal('org');" />
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_PO_BUYER_CODE} &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vPoBuyerCode]" class="input-rag required" id="vPoBuyerCode" title="{$LBL_ENTER} {$LBL_PO_BUYER_CODE}" style="width:228px;" value="{$podtls[0].vPoBuyerCode}" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_SUPPLIER} {$LBL_CONTACT_PARTY} &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="Data[vSupplierContactParty]" class="input-rag" id="supplierID" title="{$LBL_ENTER} {$LBL_SUPPLIER} {$LBL_CONTACT_PARTY}" style="width:228px;" value="{$podtls[0].vSupplierContactParty}" />
                                    {*}<input type="hidden" name="Data[iSupplierID]" id="iSupplierID" value="{$podtls[0].iSupplierID}" title="{$LBL_ENTER} {$LBL_SUPPLIER} {$LBL_CONTACT_PARTY}" class="required"/>
                                    &nbsp;{$LBL_AUTO_COMPLATE}{*}
                                    {*}<span id="usrcombo" style="float:left;">
                                        <select name="Data[iSupplierID]" class="required" id="iSupplierID" style="width:230px" title="{$LBL_SELECT} {$LBL_SUPPLIER} {$LBL_CONTACT_PARTY}">
                                            <option value="">---{$LBL_SELECT} {$LBL_SUPPLIER} {$LBL_CONTACT_PARTY}---</option>
                                        </select>
                                    </span>&nbsp;
                                    <input type="text" name="uname" id="uname" value="({$LBL_ENTER} {$LBL_USERNAME})" onfocus="if(this.value=='({$LBL_ENTER} {$LBL_USERNAME})')this.value='';" onblur="if(this.value=='')this.value='({$LBL_ENTER} {$LBL_USERNAME})';" />
                                    <img src="{$SITE_IMAGES}sm_images/btn-search.gif" alt="" border="0" style="cursor: pointer;vertical-align:middle;background:#f8f8f8;border:none;" onclick="return getComboVal('usr');" />{*}
                                </td>
                            </tr>

                            <!--       <tr>
                                       <td>{$LBL_ORDER_DATE} </td>
                                       <td>:</td>
                                       <td>
                                           <input type="text" name="Data[dOrderDate]" readonly class="input-rag" id="dOrderDate" tabindex="6" style="width:190px;" value="{$podtls[0].dOrderDate}" />
                                           &nbsp;<img src="{$SITE_IMAGES}sm_images/icon-calander.gif" />
                                       </td>
                                   </tr>       -->
                            <tr>
                                <td>{$LBL_ORDER_DESCRIPTION} </td>
                                <td>:</td>
                                <td><input type="text" name="Data[tOrderDescription]" class="input-rag" id="tOrderDescription" style="width:228px;" value="{$podtls[0].tOrderDescription|stripslashes}" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_REFERENCE_NUMBER} </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vRegisterNumber]" class="input-rag" id="vRegisterNumber" title="{$LBL_ENTER} {$LBL_REFERENCE_NUMBER}" style="width:228px;" value="{$podtls[0].vRegisterNumber}" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_OPENING_UNIT} </td>
                                <td>:</td>
                                <td><input type="text" name="Data[iOpeningUnit]" class="input-rag" id="iOpeningUnit" title="{$LBL_ENTER} {$LBL_OPENING_UNIT}" style="width:228px;" value="{$podtls[0].iOpeningUnit}" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_SUPPLIER} {$LBL_ORDER_NUMBER} </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vSupplierOrderNum]" class="input-rag"  id="vSupplierOrderNum" title="{$LBL_ENTER} {$LBL_SUPPLIER} {$LBL_ORDER_NUMBER}" style="width:228px;" value="{$podtls[0].vSupplierOrderNum}" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_CARRIER} </td>
                                <td>:</td>
                                <td><input type="text" name="Data[tCarrier]" class="input-rag" id="tCarrier" style="width:228px;" value="{$podtls[0].tCarrier}" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_LINE_ITEM_TAX} &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td>{*}<input type="text" name="Data[eLineItemTax]" class="input-rag required" id="eLineItemTax" tabindex="11" title="{$LBL_ENTER} {$LBL_LINE_ITEM_TAX}" style="width:228px;" value="{$podtls[0].eLineItemTax}" />{*}
                                    {$lineItemTax}
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_VAT} </td>
                                <td>:</td>
                                <td><input type="text" name="Data[fVAT]" class="input-rag decimals" id="fVAT" title="{$LBL_ENTER} {$LBL_VAT}" style="width:228px;" value="{$podtls[0].fVAT}" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_OTHER_TAX} </td>
                                <td>:</td>
                                <td><input type="text" name="Data[fOther_tax_1]" class="input-rag decimals" id="fOther_tax_1" style="width:228px;" value="{$podtls[0].fOther_tax_1}" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_SHIP_TO} {$LBL_PARTY} &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vShipToParty]" class="input-rag required" id="vShipToParty" title="{$LBL_ENTER} {$LBL_SHIP_TO} {$LBL_PARTY}" style="width:228px;" value="{$podtls[0].vShipToParty}" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_SHIP_TO} {$LBL_ADDR_LINE}1 &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vShipToAddressLine1]" class="input-rag required" id="vShipToAddressLine1" title="{$LBL_ENTER} {$LBL_SHIP_TO} {$LBL_ADDR_LINE}" style="width:228px;" value="{$podtls[0].vShipToAddressLine1}" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_SHIP_TO} {$LBL_ADDR_LINE}2 </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vShipToAddressLine2]" class="input-rag" id="vShipToAddressLine2" style="width:228px;" value="{$podtls[0].vShipToAddressLine2}" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_SHIP_TO} {$LBL_CITY} &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vShipToCity]" class="input-rag required" id="vShipToCity" title="{$LBL_ENTER} {$LBL_SHIP_TO} {$LBL_CITY}" style="width:228px;" value="{$podtls[0].vShipToCity}" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_SHIP_TO} {$LBL_COUNTRY} &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td>
                                    <select name="Data[vShipToCountry]" id="vShipToCountry" class="drop-down required" title="{$LBL_SELECT}&nbsp;{$LBL_SHIP_TO} {$LBL_COUNTRY}" onchange="getRelativeCombo(this.value,'{$podtls[0].vShipToState}','vShipToState','-- {$LBL_SELECT} {$LBL_STATE} --',stateArr);fillCountryCode(this);" style="width:230px;">
                                        <option value=""> --- {$LBL_SELECT} {$LBL_SHIP_TO} {$LBL_COUNTRY} --- </option>
                                        {section name=i loop=$db_country}
                                        <option title="{$db_country[i].iCountryISD}" value="{$db_country[i].vCountryCode}" {if $podtls[0].vShipToCountry eq $db_country[i].vCountryCode} selected {/if} >{$db_country[i].vCountry}</option>
                                        {/section}
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_SHIP_TO} {$LBL_STATE} &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td><!--<input type="text" name="Data[vShipToState]" class="input-rag required" id="vShipToState" tabindex="27" title="{$LBL_ENTER} {$LBL_SHIP_TO} {$LBL_STATE}" style="width:228px;" />-->
                                    <select name ="Data[vShipToState]" id="vShipToState" style="width:230px" title="{$LBL_SELECT} {$LBL_SHIP_TO} {$LBL_STATE}" class="required" >
                                        <option value="">{$LBL_SELECT} {$LBL_STATE} </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_SHIP_TO} {$LBL_ZIP_CODE} &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vShipToZipCode]" class="input-rag required" id="vShipToZipCode" title="{$LBL_ENTER} {$LBL_SHIP_TO} {$LBL_ZIP_CODE}" style="width:228px;" value="{$podtls[0].vShipToZipCode}" maxlength="10" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_SHIP_TO} {$LBL_CONTACT_PARTY} &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vShipToContactParty]" class="input-rag required" id="vShipToContactParty" title="{$LBL_ENTER} {$LBL_SHIP_TO} {$LBL_CONTACT_PARTY}" style="width:228px;" value="{$podtls[0].vShipToContactParty}" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_SHIP_TO} {$LBL_CONTACT_TELEPHONE} &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td valign="top"><input type="text" name="vShipToContactTelephoneCode"  value="{$podtls[0].vShipToContactTelephoneCode}" class="countryCode input-rag" id="vShipToContactTelephoneCode" style="width:30px;" maxlength="3" onkeypress="return chkValidPhone(event)" title="{$LBL_TELEPHONE_CODE}"/>
                                    <input type="text" name="Data[vShipToContactTelephone]" class="input-rag required" id="vShipToContactTelephone" title="{$LBL_ENTER} {$LBL_SHIP_TO} {$LBL_CONTACT_TELEPHONE}" onkeypress="return chkValidPhone(event)" style="width:190px;" value="{$podtls[0].vShipToContactTelephone}" maxlength="15" />
                                </td></tr>
                            <tr>
                                <td>{$LBL_BILL_TO}  {$LBL_PARTY} &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vBillToParty]" class="input-rag required" id="vBillToParty" title="{$LBL_ENTER} {$LBL_BILL_TO}  {$LBL_PARTY}" style="width:228px;" value="{$podtls[0].vBillToParty}" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_BILL_TO} {$LBL_ADDR_LINE}1 &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vBillToAddLine1]" class="input-rag required" id="vBillToAddLine1" title="{$LBL_ENTER} {$LBL_BILL_TO} {$LBL_ADDR_LINE}" style="width:228px;" value="{$podtls[0].vBillToAddLine1}" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_BILL_TO} {$LBL_ADDR_LINE}2 </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vBillToAddLine2]" class="input-rag" id="vBillToAddLine2" style="width:228px;" value="{$podtls[0].vBillToAddLine2}" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_BILL_TO} {$LBL_CITY}&nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vBillToCity]" class="input-rag required" id="vBillToCity" title="{$LBL_ENTER} {$LBL_BILL_TO} {$LBL_CITY}" style="width:228px;" value="{$podtls[0].vBillToCity}" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_BILL_TO} {$LBL_COUNTRY} &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td>
                                    <select name="Data[vBillToCountry]" id="vBillToCountry" class="drop-down required" title="{$LBL_SELECT}&nbsp;{$LBL_BILL_TO} {$LBL_COUNTRY}" onchange="getRelativeCombo(this.value,'{$podtls[0].vBillToState}','vBillToState','-- {$LBL_SELECT} {$LBL_STATE} --',stateArr);fillCountryCode(this);" style="width:230px;">
                                        <option value=""> --- {$LBL_SELECT} {$LBL_BILL_TO} {$LBL_COUNTRY} --- </option>
                                        {section name=i loop=$db_country}
                                        <option value="{$db_country[i].vCountryCode}"  title="{$db_country[i].iCountryISD}"  currency="{$db_country[i].iCurrencyID}" {if $podtls[0].vBillToCountry eq $db_country[i].vCountryCode} selected {/if} >{$db_country[i].vCountry}</option>
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
                                <td><input type="text" name="Data[vBillToZipCode]" class="input-rag required" id="vBillToZipCode" title="{$LBL_ENTER} {$LBL_BILL_TO} {$LBL_ZIP_CODE}" style="width:228px;" value="{$podtls[0].vBillToZipCode}" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_BILL_TO} {$LBL_CONTACT_PARTY} &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td><input type="text" name="Data[vBillToContactParty]" class="input-rag required" id="vBillToContactParty" title="{$LBL_ENTER} {$LBL_BILL_TO} {$LBL_CONTACT_PARTY}" style="width:228px;" value="{$podtls[0].vBillToContactParty}" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_BILL_TO} {$LBL_CONTACT_TELEPHONE} &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td valign="top"><input type="text" name="vBillToContactTelephoneCode"  value="{$podtls[0].vBillToContactTelephoneCode}" class="countryCode input-rag" id="vBillToContactTelephoneCode" style="width:30px;" maxlength="3" onkeypress="return chkValidPhone(event)" title="{$LBL_TELEPHONE_CODE}"/>
                                    <input type="text" name="Data[vBillToContactTelephone]" class="input-rag required" id="vBillToContactTelephone" style="width:190px;" title="{$LBL_ENTER} {$LBL_BILL_TO} {$LBL_CONTACT_TELEPHONE}" onkeypress="return chkValidPhone(event)" value="{$podtls[0].vBillToContactTelephone}" maxlength="15" />
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_CURRENCY} &nbsp;<font class="reqmsg">*</font> </td>
                                <td>:</td>
                                <td>
                                    <select name="Data[vCurrency]" id="vCurrency" class="required" style="width:96px;" title="Enter Currency" >
                                        {section name="c" loop=$currency}
                                        <option value="{$currency[c].vCode|htmlentities}" id="{$currency[c].iCurrencyID}_1" {if $currency[c].vCode eq $podtls[0].vCurrency}selected="selected"{/if} >{$currency[c].vCode}</option>
                                        {/section}
                                    </select>
                                    {*}<input type="text" name="Data[vCurrency]" class="input-rag required" id="vCurrency" tabindex="34" title="{$LBL_ENTER} {$LBL_CURRENCY}" style="width:228px;" value="{$podtls[0].vCurrency}" />{*}
                                </td>
                            </tr>
                            <tr>
                                <td>{$LBL_PO_TOTAL} </td>
                                <td>:</td>
                                <td><input type="text" name="Data[fPOTotal]" class="input-rag decimals" id="fPOTotal" title="{$LBL_ENTER} {$LBL_PO_TOTAL}" style="width:228px;" value="{$podtls[0].fPOTotal}" /></td>
                            </tr>
                            <tr>
                                <td>{$LBL_PRE_PAYMENT} </td>
                                <td>:</td>
                                <td><input type="text" name="Data[fPrepayment]" class="input-rag decimals" id="fPrepayment" title="{$LBL_ENTER} {$LBL_PRE_PAYMENT}" style="width:228px;" value="{$podtls[0].fPrepayment}" /></td>
                            </tr>
                            <tr>
                                <td valign="top">{$LBL_ATTACH_DOCUMENT}</td>
                                <td valign="top">:</td>
                                <td>
                                    <span id="uplad_file_span"><input type="file" name="upload" id="upload" /></span>
                                    <div id="files_list" class="file_upload">
                                        <ul style="list-style-type: none">
                                            {foreach from=$poAttachments item="poAttach"}
                                            <li>
                                                <a href="javascript:openpopup('{$SITE_URL_DUM}upload/attachment_docs/po/{$iPurchaseOrderID}/{$poAttach.vFile}')" > {$poAttach.vFile}</a> &nbsp; <input type="button" value="Delete" onclick="deleteFile($(this).parent(),'{$poAttach.iAttachmentID}');">
                                            </li>
                                            {/foreach}
                                        </ul>
                                        <input type="hidden" id="deleteFiles" name="deleteFiles" />
                                    </div>
                                </td>
                            </tr>
                            {if $podtls[0].eSaved neq 'No' || $poad eq 'yes'}
                            <tr>
                                <td>{*$LBL_SAVE_STATUS} Save Status&nbsp;{*}</td>
                                <td ></td>
                                <td >
                                    <input type="hidden" name="Data[eSaved]"  id="eSaved" value="{$podtls[0].eSaved}" />
                                </td>
                            </tr>
                            {/if}
                            {if $podtls[0].tReasonToReject|trim neq '' && $podtls[0].eStatus eq $rjtsts}
                            <tr>
                                <td valign="top">{$LBL_REASON_TO_REJECT} </td>
                                <td valign="top">:</td>
                                <td><div style="background:#fafafa; border:1px solid #cccccc; height:30px; width:390px; overflow-y:scroll;">{$podtls[0].tReasonToReject|trim}</div></td>
                            </tr>
                            {/if}
                            <tr>
                                <td colspan="2" height="5"></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td colspan="2">
                                    <img src="{$SITE_IMAGES}sm_images/btn-next.gif" alt="" border="0"  id="btnSubmit" name="Submit" title="submit" src="images/btn-submit.gif" alt="" onclick="$('#eSaved').val('Yes'); $('#eFrom').val('Next'); return submitFrm();" style="vertical-align:middle; cursor:pointer;"/>
                                    <a href="javascript:reset()" ><img src="{$SITE_IMAGES}sm_images/btn-reset.gif" alt="" border="0"   style="vertical-align:middle;"/></a>
                                    <a href="{$SITE_URL_DUM}polist/{$smarty.session.polvl}" ><img src="{$SITE_IMAGES}sm_images/btn-cancel.gif" alt="" border="0" style="vertical-align:middle;"/></a> &nbsp;
                                    {if $podtls[0].eSaved neq 'No' && $view neq ''} <!--|| $poad eq 'yes'-->
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

<script type="text/javascript" src="{$DATETIMEPICKER}jquery.dynDateTime.js"></script>
<script type="text/javascript" src="{$DATETIMEPICKER}lang/calendar-en.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="{$DATETIMEPICKER}css/calendar-blue.css"  />
<script type="text/javascript" src="{$SITE_JS_AJAX}jgetpoinv.js"></script>
<script type="text/javascript" src="{$SITE_JS_AJAX}jpocreate.js"></script>
<script type="text/javascript" src="{$SITE_CONTENT_JS}multifile.js"></script>
{literal}
<script type="text/javascript">
    var corg = '{/literal}{$curORGID}{literal}';
    var sid = '{/literal}{$sid}{literal}';
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
    function reset(){
        $("#frmadd")[0].reset();
    }
    if(view != 'edit') {
        $("#frmadd").validate({
            rules: {
                "Data[vShipToContactTelephone]":{
                    required: function(){
                        if($.trim($('#vShipToContactTelephoneCode').val()) == ''){
                            $('#vShipToContactTelephone').attr("title","{/literal}{$LBL_COUNTRY_CODE}{literal}");
                        }else {
                            $('#vShipToContactTelephone').attr("title","{/literal}{$LBL_ENTER} {$LBL_BILL_TO} {$LBL_CONTACT_TELEPHONE}{literal}");
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
                "Data[vPoBuyerCode]": {
                    remote:{
                        url:SITE_URL+"index.php?file=u-aj_chkdupdata"+"&extfld=iBuyerOrganizationID&extval="+corg,
                        type:"get",
                        data:{
                            val:function() {
                                return $("#iPurchaseOrderID").val();
                            },
                            id:function() {
                                return "iPurchaseOrderID";
                            },
                            field:function() {
                                return "vPoBuyerCode";
                            },
                            table:function() {
                                return "{/literal}{$PRJ_DB_PREFIX}{literal}_purchase_order_heading";
                            }
                        }
                    }
                }
            },
            messages: {
                "Data[fPOTotal]": {
                    decimals: LBL_DIGITS_ONLY
                },
                "Data[fPrepayment]": {
                    decimals: LBL_DIGITS_ONLY
                },
                "Data[fVAT]": {
                    decimals: LBL_NUMERIC_ONLY
                },
                "Data[fOther_tax_1]": {
                    decimals: LBL_NUMERIC_ONLY
                },
                "Data[vPoBuyerCode]": {
                    required: LBL_ENTER_PO_BUYER_CODE,
                    remote: jQuery.validator.format(LBL_PO_BUYER_CODE_INUSE)
                }
            }
        });
    } else {
        $("#iSupplierID").load(SITE_URL+"index.php?file=u-aj_getUser&icompid="+"{/literal}{$podtls[0].iSupplierOrganizationID}{literal}"+"&htmlTag=option&orgtype=supplier"+"&val={/literal}{$podtls[0].iSupplierID}{literal}")

        $("#frmadd").validate({
            rules:{
                "Data[vShipToContactTelephone]":{
                    required: function(){
                        if($.trim($('#vShipToContactTelephoneCode').val()) == ''){
                            $('#vShipToContactTelephone').attr("title","{/literal}{$LBL_COUNTRY_CODE}{literal}");
                        }else {
                            $('#vShipToContactTelephone').attr("title","{/literal}{$LBL_ENTER} {$LBL_BILL_TO} {$LBL_CONTACT_TELEPHONE}{literal}");
                        }
                    }
                },"Data[vBillToContactTelephone]":{
                    required: function(){
                        if($.trim($('#vBillToContactTelephoneCode').val()) == ''){
                            $('#vBillToContactTelephone').attr("title","{/literal}{$LBL_COUNTRY_CODE}{literal}");
                        }else {
                            $('#vBillToContactTelephone').attr("title","{/literal}{$LBL_ENTER} {$LBL_BILL_TO} {$LBL_CONTACT_TELEPHONE}{literal}");
                        }
                    }
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
        $('#iSupplierID').val(totValID);
        //	alert(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+iOrgId+"&iUserID="+totValID);
        //$('#OrgStatus_Div').load(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+totValID);		// +"&iOrgId="+iOrgId
    }
    function selectUsrItem(li) {
        findUserValue(li);
    }
    function setuser()
    {
        $("#supplierID").autocomplete(
        SITE_URL+"index.php?file=u-aj_getUser&icompid="+$('#iSupplierOrganizationID').val(),
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
        $('#iSupplierOrganizationID').val(totValID);
        $('#supplierID').val('');
        //$('#result').load(SITE_URL+"index.php?file=u-aj_getOrganizationUser&type=user&iId="+totValID+"");
        //$('#OrgStatus_Div').load(SITE_URL+"index.php?file=or-aj_getOrganizationStatus&type=user&iId="+totValID+"");
        if(totValID != '') { setuser(); }
    }
    function selectItem(li) {
        findValue(li);
    }

    function setSuplierOrg()
    {
        $("#vSupplierName").autocomplete(
        SITE_URL+"index.php?file=or-aj_getOrganization&orgid="+$('#iBuyerOrganizationID').val()+"&assoc="+$('#vAssocCode').val()+"&orgtype=supplier",
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
    }

    function findAsocValue(li) {
        if( li == null ) return alert("No match!");
        if( !!li.extra ) var sValue = li.extra[0];
        else var sValue = li.selectValue;

        var totVal = sValue;
        var totValID;
        var totValRes;
        totVal = totVal.split('</span>');
        totValID = totVal[0].replace("<span style='display:none'>","");
        totValRes = totVal[1];
        var vAsocCode=totValID.split('_');
        totValID=vAsocCode[0];
        vAsocCode=vAsocCode[1];
        $('#vAssocCode').val(totValID);
        // alert(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+iOrgId+"&iUserID="+totValID);
        // $('#OrgStatus_Div').load(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+totValID);		// +"&iOrgId="+iOrgId
        $('#vSupplierName').unbind().autocomplete();
        $('#supplierID').unbind().autocomplete();
        setSuplierOrg();
    }
    function selectAsocItem(li) {
        findAsocValue(li);
    }

    function setAsocs() {
        $("#vAssociationCode").autocomplete(
        SITE_URL+"index.php?file=or-aj_getAssociation&orgid="+$('#iBuyerOrganizationID').val(),
        {
            delay:10,
            minChars:1,
            matchSubset:1,
            matchContains:1,
            cacheLength:10,
            onItemSelect:selectAsocItem,
            onFindValue:findAsocValue,
            formatItem:formatItem,
            autoFill:false
        }
    );
    }

    // if(org == '') {
    $(document).ready(function() {
        setAsocs();
        // $('#vSupplierName').unbind().autocomplete();
        setSuplierOrg();
        $('#vAssociationCode').blur(function(event){
            if($.trim($('#vAssociationCode').val()) == '') {
                $('#vAssocCode').val('');
                $('#vSupplierName').unbind().autocomplete();
                // $('#supplierID').unbind().autocomplete();
                setSuplierOrg();
            }
        });
		//
		// getRelativeCombo($('#vSupplierCountry').val(),"{/literal}{$userData.vSupplierState}{literal}",'vSupplierState','---{/literal}{$LBL_SELECT} {$LBL_SUPPLIER} {$LBL_STATE}---{literal}',stateArr);
		getRelativeCombo($('#vShipToCountry').val(),"{/literal}{$podtls[0].vShipToState}{literal}",'vShipToState','---{/literal}{$LBL_SELECT} {$LBL_SHIP_TO} {$LBL_STATE}---{literal}',stateArr);
		getRelativeCombo($('#vBillToCountry').val(),"{/literal}{$podtls[0].vBillToState}{literal}",'vBillToState','---{/literal}{$LBL_SELECT} {$LBL_BILL_TO} {$LBL_STATE}---{literal}',stateArr);
		//$('#iSupplierOrganizationID').load(SITE_URL+"index.php?file=or-aj_getOrganization"+"&assoc="+$('#vAssocCode').val()+"&orgtype=supplier"+"&htmlTag=option"+"&val="+'{/literal}{$podtls[0].iSupplierOrganizationID}{literal}');
		// fillPoData($('#vPOCode option:selected').attr('id'));
		// fillPoData($('#iInvoiceID option:selected').attr('id'));
		//
    });
    // }
    // setSuplierOrg();

    jQuery(document).ready(function() {
        jQuery("#dOrderDate").dynDateTime({
            showsTime: true,
            ifFormat: "%Y-%m-%d %H:%M:00",
            daFormat: "%l;%M %p, %e %m,  %Y",
            align: "TL",
            electric: false,
            singleClick: false,
            button:".next()",
            displayArea: ".siblings('.dtcDisplayArea')"
        });
    });

    function fillCountryCode(obj)
    {    var opt=obj.options[obj.selectedIndex];
        if(obj.id == 'vShipToCountry')
        {
            $('#vShipToContactTelephoneCode').val(opt.title);
        }else{
            var currency=opt.getAttribute("currency");
            $('#vBillToContactTelephoneCode').val(opt.title);
            $('#vCurrency option[id="'+currency+'_1"]').attr("selected","selected");
        }
    }
    var fileArr=new Array();
    function deleteFile(obj,fileid)
    {
        fileArr.push(fileid);
        $('#deleteFiles').val(fileArr);
        obj.html("");
    }
    if(document.getElementById('upload'))
    {
        var multiSelect = new MultiSelector( document.getElementById('files_list'), 3);
        multiSelect.addElement(document.getElementById('upload'));
    }
    function setT()
    {
        if($('#eLineItemTax').val()=='Yes') {
            $('#fVAT').val('');
            $('#fOther_tax_1').val('');
            $('#fVAT').attr('disabled','disabled');
            $('#fOther_tax_1').attr('disabled','disabled');
            $('#fVAT').css('background-color','#eeeeee');
            $('#fOther_tax_1').css('background-color','#eeeeee');
        } else {
            $('#fVAT').attr('disabled','');
            $('#fOther_tax_1').attr('disabled','');
            $('#fVAT').css('background-color','#ffffff');
            $('#fOther_tax_1').css('background-color','#ffffff');
        }
    }
    $(document).ready(function(){
        setT();
    });
    function getorgbilldetails(vl) {
        pars = "&orgid="+vl+"&type=sup"+"&frm=po";
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