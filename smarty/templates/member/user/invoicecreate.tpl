<div id="content-wrapper">
<div class="row">
    <div class="col-lg-12">
        <div id="content-header" class="clearfix">
            <div class="pull-left">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active"><span>Invoice</span></li>
                </ol>

                <h1>{$LBL_CREATE_INVOICE}</h1>
            </div>
        </div>
    </div>
</div>
{if $msg neq ''}
<div class="msg">{$msg}</div>
{/if}
<div class="row">
<div class="main-box">
<header class="main-box-header clearfix">

</header>
<div class="main-box-body clearfix">
<form class="form-horizontal" name="frmadd" id="frmadd" action="{$SITE_URL}index.php?file=u-invoicecreate_a"  method="post" enctype="multipart/form-data">
<input type="hidden" name="iInvoiceID" id="iInvoiceID" value="{$iInvoiceID}" />
<input type="hidden" name="view" id="view" value="{$view}" />
<input type="hidden" name="frmbuyer" id="frmbuyer" value="{$frmbuyer}" />
<input type="hidden" name="Data[eFrom]" id="eFrom" value="" />

<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-5 control-label"><font size="2" color="red"><b>{$var_msg}</b></font></label>
</div>
{if $frmbuyer eq 'n' && $invdtls[0].eCreateByBuyer neq 'Yes'}
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_SUPPLIER} {$LBL_COMP_NAME}</label>
    <div class="col-md-3">
        <input type="text" id="exampleInputPassword1" class="form-control" value="{$orgname}" readonly>
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_SUPPLIER} {$LBL_CODE}</label>
    <div class="col-md-3">
        <input type="text" id="exampleInputPassword1" class="form-control" value="{$OrgCode}" readonly>
        <input type="hidden" name="Data[vInvoiceSupplierCode]" id="vInvoiceSupplierCode" value="{$OrgCode}" />
        <input type="hidden" name="iSupplierOrganizationID" id="iSupplierOrganizationID" value="{$curORGID}" />
    </div>
</div>
    {else}
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_SUPPLIER} {$LBL_COMP_NAME}</label>
    <div class="col-md-3">
        <span id="scompcombo" style="float:left;">
                                        <select name="Data[iSupplierOrganizationID]" id="iSupplierOrganizationID" class="form-control" title="{$LBL_SELECT} {$LBL_SUPPLIER} {$LBL_COMPANY}" onchange="// return getorgbilldetails(this.value)" > {*}$("#iBuyerID").load(SITE_URL+"index.php?file=u-aj_getUser&icompid="+this.value+"&htmlTag=option&orgtype=buyer");{*}
                                            <option value="">---{$LBL_SELECT} {$LBL_SUPPLIER} {$LBL_COMPANY}---</option>
                                            {if $view eq 'edit'}
                                                <option value="{$sorgdtls[0].iOrganizationID}" selected="selected">{$sorgdtls[0].vCompanyName}</option>
                                            {/if}
                                        </select>
                                    </span>&nbsp;
        <input type="text" name="scompcode" id="scompcode" value="({$LBL_ENTER} {$LBL_COMPANY})" onfocus="if(this.value=='({$LBL_ENTER} {$LBL_COMPANY})')this.value='';" onblur="if(this.value=='')this.value='({$LBL_ENTER} {$LBL_COMPANY})';" />
        <img src="{$SITE_IMAGES}sm_images/btn-search.gif" alt="" border="0" style="cursor: pointer;vertical-align:middle;background:#f8f8f8;border:none;" onclick="return getComboVal('sborg');" />
    </div>
</div>
{/if}


<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_PO_CODE}</label>
    <div class="col-md-3">
        <span id="pocombo">
                                        <select name="Data[iPurchaseOrderID]" id="iPurchaseOrderID"
                                                class="form-control"
                                                onchange="fillPOData(this.options[this.selectedIndex].id)"
                                                title="{$LBL_SELECT} {$LBL_PURCHASE_ORDER}"> {*}class="{if $POCodeData|@count gt 0 && $POCodeData|is_array}required{/if}"{*}
                                            <option value="">---{$LBL_SELECT_PO}---</option>
                                        {if $podl|is_array && $podl|@count>0}
                                            <option value="{$podl[0].iPurchaseOrderID}"
                                                    selected="selected">{$podl[0].vPOCode}</option>
                                        {/if}
                                        {*foreach from=$POCodeData item="POCode"}
                                        <option value="{$POCode.Id}"  id="{$POCode.Id}" {if $POCode.Id eq $invdtls[0].iPurchaseOrderID}selected{/if} >{$POCode.vTitle}</option>
                                        {/foreach*}
                                        </select>
                                    </span>
    </div>
    <div class="col-md-3">
        <input type="text"  class="form-control" name="poc" id="poc" value="({$LBL_ENTER} {$LBL_PO_BUYER_CODE})" onfocus="if(this.value=='({$LBL_ENTER} {$LBL_PO_BUYER_CODE})')this.value='';" onblur="if(this.value=='')this.value='({$LBL_ENTER} {$LBL_PO_BUYER_CODE})';"  />
    </div>
    <div class="col-md-2">
        <button type="button" onclick="return getComboVal('po');" class="btn btn-primary">Search</button>
    </div>
</div>

<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_EXTERNAL_PO_CODE}</label>
    <div class="col-md-3">
        <input type="text" name="Data[vExtPOCode]" id="vExtPOCode" value="{$invdtls[0].vExtPOCode}" class="form-control">
    </div>
</div>
{if $frmbuyer eq 'n' && $invdtls[0].eCreateByBuyer neq 'Yes'}
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_BUYER} {$LBL_COMPANY}  *</label>
    <div class="col-md-3">
        <span id="compcombo">
                                        <select name="Data[iBuyerOrganizationID]" id="iBuyerOrganizationID" class="form-control" title="{$LBL_SELECT} {$LBL_BUYER} {$LBL_COMPANY}" onchange="return getorgbilldetails(this.value)" > {*}$("#iBuyerID").load(SITE_URL+"index.php?file=u-aj_getUser&icompid="+this.value+"&htmlTag=option&orgtype=buyer");{*}
                                            <option value="">---{$LBL_SELECT} {$LBL_BUYER} {$LBL_COMPANY}---</option>
                                            {if $view eq 'edit'}
                                                <option value="{$borgdtls[0].iOrganizationID}" selected="selected">{$borgdtls[0].vCompanyName}</option>
                                            {/if}
                                        </select>
                                    </span>&nbsp;
    </div>
    <div class="col-md-3">
        <input type="text" class="form-control" name="compcode" id="compcode" value="({$LBL_ENTER} {$LBL_COMPANY})" onfocus="if(this.value=='({$LBL_ENTER} {$LBL_COMPANY})')this.value='';" onblur="if(this.value=='')this.value='({$LBL_ENTER} {$LBL_COMPANY})';" />
    </div>
    <div class="col-md-2">
        <button type="button" onclick="return getComboVal('org');" class="btn btn-primary">Search</button>
    </div>
</div>
{else}
<div class="form-group">
<label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_BUYER} {$LBL_COMPANY}</label>
<div class="col-md-3">
    <input type="text" id="exampleInputPassword1" class="form-control" value="{$borgname}">
</div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_BUYER} {$LBL_CODE}</label>
    <div class="col-md-3">
        <input type="text" id="exampleInputPassword1" class="form-control" value="{$bOrgCode}">
        <input type="hidden" name="Data[vAssociatePOBuyerCode]" id="vAssociatePOBuyerCode" value="{$bOrgCode}" />
        <input type="hidden" name="iBuyerOrganizationID" id="iBuyerOrganizationID" value="{$curORGID}" />
    </div>
</div>
{/if}

<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_INV_SUPPLIER_CODE}</label>
    <div class="col-md-3">
        <input type="text" name="Data[vInvSupplierCode]" id="vInvSupplierCode" title="{$LBL_ENTER} {$LBL_INV_SUPPLIER_CODE}" value="{$invdtls[0].vInvSupplierCode}" class="form-control">
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_BUYER} {$LBL_CONTACT_PARTY}</label>
    <div class="col-md-3">
        <input type="text" name="Data[vBuyerContactParty]" class="form-control" id="vBuyerContactParty" title="{$LBL_ENTER} {$LBL_SUPPLIER} {$LBL_CONTACT_PARTY}" value="{$invdtls[0].vBuyerContactParty}" />
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_INVOICE_DESCRIPTION} </label>
    <div class="col-md-3">
        <textarea name="Data[tInvoiceDescription]" class="form-control" id="tInvoiceDescription" rows="3" >{$invdtls[0].tInvoiceDescription|stripslashes}</textarea>
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_REFERENCE_NUMBER}</label>
    <div class="col-md-3">
        <input type="text" name="Data[vRegisterNumber]" class="form-control" id="vRegisterNumber" title="{$LBL_ENTER} {$LBL_REFERENCE_NUMBER}" value="{$invdtls[0].vRegisterNumber}" />
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_OPENING_UNIT}</label>
    <div class="col-md-3">
        <input type="text" name="Data[iOpeningUnit]" class="form-control" id="iOpeningUnit" title="{$LBL_ENTER} {$LBL_OPENING_UNIT}" value="{$invdtls[0].iOpeningUnit}" />
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_SUPPLIER} {$LBL_ORDER_NUMBER}</label>
    <div class="col-md-3">
        <input type="text" name="Data[vSupplierOrderNum]" class="form-control"  id="vSupplierOrderNum" title="{$LBL_ENTER} {$LBL_SUPPLIER} {$LBL_ORDER_NUMBER}" value="{$invdtls[0].vSupplierOrderNum}" />
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_LINE_ITEM_TAX}  *</label>
    <div class="col-md-4">
    {$lineItemTax}
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_VAT}</label>
    <div class="col-md-3">
        <input type="text" name="Data[fVAT]" class="form-control" id="fVAT" title="{$LBL_ENTER} {$LBL_VAT}" value="{$invdtls[0].fVAT}" />
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_OTHER_TAX}</label>
    <div class="col-md-3">
        <input type="text" name="Data[fOtherTax1]" class="form-control" id="fOthertax1" value="{$invdtls[0].fOtherTax1}" />
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_WITH_HOLDING_TAX}</label>
    <div class="col-md-3">
        <input type="text" name="Data[fWithHoldingTax]" class="form-control" id="fWithHoldingTax" value="{$invdtls[0].fWithHoldingTax}" />
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_FREIGHT}</label>
    <div class="col-md-3">
        <input type="text" name="Data[vFreight]" class="form-control" id="vFreight" value="{$invdtls[0].vFreight}" />
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_MISCELLANEOUS}</label>
    <div class="col-md-3">
        <textarea name="Data[tMiscellaneous]" id="tMiscellaneous" class="form-control" rows="3" >{$invdtls[0].tMiscellaneous|stripslashes}</textarea>
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_DISCOUNT_BASELINE_DATE}</label>
    <div class="col-md-3">
        <input type="text" name="Data[dCashDiscountBaseline]" class="form-control" id="dCashDiscountBaseline" value="{if $invdtls[0].dCashDiscountBaseline neq '0000-00-00 00:00:00'}{$invdtls[0].dCashDiscountBaseline|calcLTzTime}{/if}" readonly="readonly" />
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_MAXCASH_DISCOUNTDAYS}</label>
    <div class="col-md-3">
        <input type="text" name="Data[iMaxCashDiscountDays]" class="form-control" id="iMaxCashDiscountDays" value="{$invdtls[0].iMaxCashDiscountDays}" />
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_MAXCASH_DISCOUNTPERCENT}</label>
    <div class="col-md-3">
        <input type="text" name="Data[fMaxCashDiscountPercentage]" class="form-control" id="fMaxCashDiscountPercentage" max="100" value="{$invdtls[0].fMaxCashDiscountPercentage|substr:0:5}" title="{$LBL_ENTER} {$LBL_MAXCASH_DISCOUNTPERCENT}" maxlength="5" />
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_NORMALCASH_DISCOUNTDAYS}</label>
    <div class="col-md-3">
        <input type="text" name="Data[iNormalCashDiscountDays]" class="form-control" id="iNormalCashDiscountDays" value="{$invdtls[0].iNormalCashDiscountDays}" />
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_NORMALCASH_DISCOUNTPERCNET}</label>
    <div class="col-md-3">
        <input type="text" name="Data[iNormalCashDiscountPercentage]"  class="form-control" max="100" id="iNormalCashDiscountPercentage"  value="{$invdtls[0].iNormalCashDiscountPercentage|substr:0:5}" title="{$LBL_ENTER} {$LBL_NORMALCASH_DISCOUNTPERCNET}" maxlength="5" />
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_NET_PAYMENT_DAYS}</label>
    <div class="col-md-3">
        <input type="text" name="Data[iNetPaymentDays]" class="form-control" id="iNetPaymentDays" value="{$invdtls[0].iNetPaymentDays}" />
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_NET_PAYMENT_DATE}</label>
    <div class="col-md-3">
        <input type="text" name="Data[dNetPaymentdate]" class="form-control" id="dNetPaymentdate" value="{$invdtls[0].dNetPaymentdate|calcLTzTime}" readonly="readonly" />
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_BILL_TO}  {$LBL_PARTY} *</label>
    <div class="col-md-3">
        <input type="text" name="Data[vBillToParty]" class="form-control" id="vBillToParty" title="{$LBL_ENTER} {$LBL_BILL_TO}  {$LBL_PARTY}" value="{$invdtls[0].vBillToParty}" />
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_BILL_TO} {$LBL_ADDR_LINE}1  *</label>
    <div class="col-md-3">
        <input type="text" name="Data[vBillToAddLine1]" class="form-control" id="vBillToAddLine1" title="{$LBL_ENTER} {$LBL_BILL_TO} {$LBL_ADDR_LINE}" value="{$invdtls[0].vBillToAddLine1}" />
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_BILL_TO} {$LBL_ADDR_LINE}2</label>
    <div class="col-md-3">
        <input type="text" name="Data[vBillToAddLine2]" class="form-control" id="vBillToAddLine2" value="{$invdtls[0].vBillToAddLine2}" />
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_BILL_TO} {$LBL_CITY} *</label>
    <div class="col-md-3">
        <input type="text" name="Data[vBillToCity]" class="form-control" id="vBillToCity" title="{$LBL_ENTER} {$LBL_BILL_TO} {$LBL_CITY}" value="{$invdtls[0].vBillToCity}" />
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_BILL_TO} {$LBL_COUNTRY}  *</label>
    <div class="col-md-4">
        <select name="Data[vBillToCountry]" id="vBillToCountry" class="form-control" title="{$LBL_SELECT}&nbsp;{$LBL_BILL_TO} {$LBL_COUNTRY}" onchange="getRelativeCombo(this.value,'{$invdtls[0].vBillToState}','vBillToState','-- {$LBL_SELECT} {$LBL_COUNTRY} --',stateArr);fillCountryCode(this);" >
            <option value=""> --- {$LBL_SELECT} {$LBL_BILL_TO} {$LBL_COUNTRY} --- </option>
        {section name=i loop=$db_country}
            <option  title="{$db_country[i].iCountryISD}" currency="{$db_country[i].iCurrencyID}" value="{$db_country[i].vCountryCode}" {if $invdtls[0].vBillToCountry eq $db_country[i].vCountryCode} selected {/if} >{$db_country[i].vCountry}</option>
        {/section}
        </select>
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_BILL_TO} {$LBL_STATE}*</label>
    <div class="col-md-4">
        <select name ="Data[vBillToState]" id="vBillToState" title="{$LBL_SELECT} {$LBL_BILL_TO} {$LBL_STATE}" class="form-control" >
            <option value="">{$LBL_SELECT} {$LBL_STATE} </option>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_BILL_TO} {$LBL_ZIP_CODE}   *</label>
    <div class="col-md-3">
        <input type="text" name="Data[vBillToZipCode]" class="form-control" id="vBillToZipCode" title="{$LBL_ENTER} {$LBL_BILL_TO} {$LBL_ZIP_CODE}" value="{$invdtls[0].vBillToZipCode}" />
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_BILL_TO} {$LBL_CONTACT_PARTY}  *</label>
    <div class="col-md-3">
        <input type="text" name="Data[vBillToContactParty]" class="form-control" id="vBillToContactParty" title="{$LBL_ENTER} {$LBL_BILL_TO} {$LBL_CONTACT_PARTY}" value="{$invdtls[0].vBillToContactParty}" />
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_BILL_TO} {$LBL_CONTACT_TELEPHONE}  *</label>
    <div class="col-md-1">
        <input type="text" name="vBillToContactTelephoneCode"  value="{$invdtls[0].vBillToContactTelephoneCode}" class="form-control" id="vBillToContactTelephoneCode" maxlength="3" onkeypress="return chkValidPhone(event)" title="{$LBL_COUNTRY_CODE}"/>
    </div>
    <div class="col-md-2">
        <input type="text" name="Data[vBillToContactTelephone]" class="form-control" id="vBillToContactTelephone" onkeypress="return chkValidPhone(event)" title="{$LBL_ENTER} {$LBL_BILL_TO} {$LBL_CONTACT_TELEPHONE}" maxlength="15" value="{$invdtls[0].vBillToContactTelephone}" />
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_CURRENCY}  *</label>
    <div class="col-md-4">
        <select name="Data[vCurrency]" id="vCurrency" class="form-control" title="Enter Currency" >
        {section name="c" loop=$currency}
            <option value="{$currency[c].vCode|htmlentities}" id="{$currency[c].iCurrencyID}_1" {if $currency[c] eq $invdtls[0].vCurrency}selected="selected"{/if} >{$currency[c].vCode}</option>
        {/section}
        </select>
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_VAT_ID}</label>
    <div class="col-md-3">
        <input type="text" name="Data[vVatId]" class="form-control" id="vVatId" value="{if $invdtls[0].vVatId neq ''}{$invdtls[0].vVatId}{else}{$orgdtls[0].vVatId}{/if}" />
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_BANK}</label>
    <div class="col-md-4">
        <select name="Data[iBankId]" id="iBankId" class="form-control" title="{$LBL_SELECT} {$LBL_BANK}">
        {section name="l" loop=$bnk_dtls}
            <option value="{$bnk_dtls[l].iBankId}" {if $invdtls[0].iBankId >0}{if $bnk_dtls[l].iBankId eq $invdtls[0].iBankId}selected="selected"{/if}{elseif $bnk_dtls[l].iBankId eq $orgdtls[0].iBankId}selected="selected"{/if}>{$bnk_dtls[l].vBankName}</option>
        {/section}
        </select>
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_BANK_CODE}</label>
    <div class="col-md-3">
        <input type="text" name="Data[vBankCode]" class="form-control" id="vBankCode" value="{if $invdtls[0].vBankCode neq ''}{$invdtls[0].vBankCode}{else}{$orgdtls[0].vBankCode}{/if}" />
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_BRANCH}</label>
    <div class="col-md-3">
        <input type="text" name="Data[vBranchName]" class="form-control" id="vBranchName" value="{if $invdtls[0].vBranchName neq ''}{$invdtls[0].vBranchName}{else}{$orgdtls[0].vBranchName}{/if}" />
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_BRANCH_CODE}</label>
    <div class="col-md-3">
        <input type="text" name="Data[vBranchCode]" class="form-control" id="vBranchCode" value="{if $invdtls[0].vBranchCode neq ''}{$invdtls[0].vBranchCode}{else}{$orgdtls[0].vBranchCode}{/if}" />
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_ACCOUNT} {$LBL_TITLE}</label>
    <div class="col-md-3">
        <input type="text" name="Data[vAccountName]" class="form-control" id="vAccountName" value="{if $invdtls[0].vAccountName neq ''}{$invdtls[0].vAccountName}{else}{$orgdtls[0].vAccount1Title}{/if}" />
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_ACCOUNT} {$LBL_NUMBER}</label>
    <div class="col-md-3">
        <input type="text" name="Data[vAccountNumber]" class="form-control" id="vAccountNumber" value="{if $invdtls[0].vAccountNumber neq ''}{$invdtls[0].vAccountNumber}{else}{$orgdtls[0].vAccount1Number}{/if}" />
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_IBAN}</label>
    <div class="col-md-3">
        <input type="text" name="Data[vIBAN]" class="form-control" id="vIBAN" value="{if $invdtls[0].vIBAN neq ''}{$invdtls[0].vIBAN}{else}{$bnkdtl[0].vIBAN}{/if}" />
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_INVOICE_TOTAL}</label>
    <div class="col-md-3">
        <input type="text" name="Data[fInvoiceTotal]" class="form-control" id="fInvoiceTotal" value="{$invdtls[0].fInvoiceTotal}" />
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_PRE_PAYMENT}</label>
    <div class="col-md-3">
        <input type="text" name="Data[fPrePayment]" class="form-control" id="fPrePayment" title="{$LBL_ENTER} {$LBL_PRE_PAYMENT}" value="{$invdtls[0].fPrePayment}" />
    </div>
</div>
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_ATTACH_DOCUMENT}</label>
    <div class="col-md-3">
        <input type="file" name="upload" id="upload" class="form-control" />
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
    </div>
</div>

{if $invdtls[0].eSaved neq 'No' || $invad eq 'yes'}
<div class="form-group">
    <input type="hidden" name="Data[eSaved]"  id="eSaved" value="{$invdtls[0].eSaved}" />
</div>
{/if}
{if $invdtls[0].tReasonToReject|trim neq '' && $invdtls[0].eStatus eq $rjtsts}
<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">{$LBL_REASON_TO_REJECT}</label>
    <div class="col-md-3">
        {$invdtls[0].tReasonToReject|trim}
    </div>
</div>
{/if}

<div class="form-group">
    <center class="col-md-12">
        <button onclick="$('#eSaved').val('Yes'); $('#eFrom').val('Next'); return submitFrm();" id="btnSubmit" name="Submit" type="button" class="btn btn-primary">Next</button>
        <button type="button"  onclick="resetFrm();" class="btn btn-primary">Reset</button>
        <button type="button" class="btn btn-primary" onclick="location.href='{$SITE_URL_DUM}invacptlist/{$smarty.session.invlvl}'">Cancel</button>
    {if $invdtls[0].eSaved neq 'No'  && $view neq ''} <!-- || $invad eq 'yes'-->
        <button type="button"  id="btnSave" name="Save" onclick="$('#eSaved').val('Yes'); return submitFrm();"  class="btn btn-primary">Save</button>

    {/if}
    </center>
</div>
</form>
</div>
</div>
</div>


<span id="sn" style="display:hidden;"></span>
<span id="spn" style="display:hidden;"></span>
<span id="vldms" style="display:none;"></span>
</div>


<script src="{$SITE_JS}jquery.js"></script>
<script src="{$SITE_JS}bootstrap.js"></script>
<script src="{$SITE_JS}jquery.nanoscroller.min.js"></script>

<script src="{$SITE_JS}bootstrap-datepicker.js"></script>
<!-- this page specific scripts -->
<script src="{$SITE_JS}jquery.maskedinput.min.js"></script>
<script src="{$SITE_JS}select2.min.js"></script>
<script src="{$SITE_JS}modernizr.custom.js"></script>
<script src="{$SITE_JS}classie.js"></script>
<script src="{$SITE_JS}modalEffects.js"></script>
<!-- theme scripts -->
<script src="{$SITE_JS}scripts.js"></script>
<script src="{$SITE_JS}pace.min.js"></script>

<script language="JavaScript" src="{$S_JQUERY}jquery.autocomplete.js"></script>
<link type="text/css" rel="stylesheet" media="screen" href="{$SITE_CSS}jquery.autocomplete.css" />

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