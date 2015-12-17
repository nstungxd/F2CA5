<div class="middle-container">
     <h1><span>{$LBL_CREATE_ORG}</span></h1>
     <div class="middle-containt">
          <div class="statistics-main-box-white">
               <div>
                    <ul id="inner-tab">
                         <li><a href="{$SITE_URL_DUM}createorganization/{$iOrganizationID}" class="{if $file eq 'or-createorganization'}current{/if}"><EM>{$LBL_ORG_INFO}</EM></a></li>
                         <li><a href="{$SITE_URL_DUM}createorganizationpref/{$iOrganizationID}/{$iAdditionalInfoID}" class="{if $file eq 'or-createorganizationpref'}current{/if}"><EM>{$LBL_PREFERENCES}</EM></a></li>
                    </ul>
               </div>
               <div class="clear"></div>
               <div class="inner-gray-bg">
                    <div style="height:10px;"></div>
                    <div>
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
                         <form name="frmadd" id="frmadd" action="{$SITE_URL}index.php?file=or-createorganizationpref_a" method="post">
                         <input type="hidden" name="iOrganizationID" id="iOrganizationID"value="{$iOrganizationID}" />
                         <input type="hidden" name="iAdditionalInfoID" id="iAdditionalInfoID"value="{$iAdditionalInfoID}" />
                         <input type="hidden" name="iASMID" id="iASMID"value="{$iASMID}" />
                         <input type="hidden" name="view" id="view"value="{$view}" />
                         <table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
                              <tr>
                                   <td width="205">{$LBL_ORGANIZATION} : </td>
                                   <td class="blue-ore">{if $orgdtls[0].vCompanyName neq ''}{$orgdtls[0].vCompanyName},{/if} <span>{$orgdtls[0].vOrganizationCode}</span></td>
                              </tr>
                              {if $orgdtls[0].eOrganizationType neq 'Buyer2'}
                              <tr>
                                   <td valign="top">{$LBL_SOURCE_DOC} :</td>
                                   <td>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                             <tr>
                                                  <td height="78" valign="top"><textarea name="Data[tSourcingDocument]" id="tSourcingDocument"  class="text-area" style="width:495px; height:78px;" >{$arr[0].tSourcingDocument|stripslashes}</textarea></td>
                                             </tr>
                                        </table>
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top">{$LBL_GLOBAL_AGREEMENT} :</td>
                                   <td>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                             <tr>
                                                  <td height="78" valign="top"><textarea name="Data[tGlobalAgreement]" id="tGlobalAgreement"  class="text-area"  style="width:495px; height:78px;" >{$arr[0].tGlobalAgreement|stripslashes}</textarea></td>
                                             </tr>
                                        </table>
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top"> {$LBL_PAYMENT_TERMS} :</td>
                                   <td>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                             <tr>
                                                  <td height="78" valign="top"><textarea name="Data[tPaymentTerms]" id="tPaymentTerms"  class="text-area"  style="width:495px; height:78px;" >{$arr[0].tPaymentTerms|stripslashes}</textarea></td>
                                             </tr>
                                        </table>
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top"> {$LBL_FOB} :</td>
                                   <td>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                             <tr>
                                                  <td height="78" valign="top"><textarea name="Data[tFOB]" id="tFOB"  class="text-area"  style="width:495px; height:78px;" >{$arr[0].tFOB|stripslashes}</textarea></td>
                                             </tr>
                                        </table>
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top"> {$LBL_DELIVERY_TERMS} :</td>
                                   <td>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                             <tr>
                                                  <td height="78" valign="top"><textarea name="Data[tDeliveryTerms]" id="tDeliveryTerms"  class="text-area"  style="width:495px; height:78px;" >{$arr[0].tDeliveryTerms|stripslashes}</textarea></td>
                                             </tr>
                                        </table>
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top">{$LBL_SHIP_CONTROL} :</td>
                                   <td>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                             <tr>
                                                  <td height="78" valign="top"><textarea name="Data[tShippingControl]" id="tShippingControl"  class="text-area"  style="width:495px; height:78px;" >{$arr[0].tShippingControl|stripslashes}</textarea></td>
                                             </tr>
                                        </table>
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top">{$LBL_COND_PAYMENT} :</td>
                                   <td>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                             <tr>
                                                  <td height="78" valign="top"><textarea name="Data[tConditionsForPayment]" id="tConditionsForPayment"  class="text-area"  style="width:495px; height:78px;" >{$arr[0].tConditionsForPayment|stripslashes}</textarea></td>
                                             </tr>
                                        </table>
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top">{$LBL_PENALTIES} :</td>
                                   <td>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                             <tr>
                                                  <td height="78" valign="top"><textarea name="Data[tPenalties]" id="tPenalties"  class="text-area"  style="width:495px; height:78px;" >{$arr[0].tPenalties|stripslashes}</textarea></td>
                                             </tr>
                                        </table>
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top">{$LBL_SPEC_INSTRUCT} :</td>
                                   <td>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                             <tr>
                                                  <td height="78" valign="top"><textarea name="Data[tSpecialInstruction]" id="tSpecialInstruction"  class="text-area"  style="width:495px; height:78px;" >{$arr[0].tSpecialInstruction|stripslashes}</textarea></td>
                                             </tr>
                                        </table>
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top">Note :</td>
                                   <td>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                             <tr>
                                                  <td height="78" valign="top"><textarea name="Data[tNote]" id="tNote"  class="text-area"  style="width:495px; height:78px;" >{$arr[0].tNote|stripslashes}</textarea></td>
                                             </tr>
                                        </table>
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top">{$LBL_TERMS_COND} :</td>
                                   <td>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                             <tr>
                                                  <td height="78" valign="top"><textarea name="Data[tTermsAndConditions]" id="tTermsAndConditions"  class="text-area"  style="width:495px; height:78px;" >{$arr[0].tTermsAndConditions|stripslashes}</textarea></td>
                                             </tr>
                                        </table>
                                   </td>
                              </tr>
                              {/if}
                              <tr>
                                   <td valign="top">{$LBL_CURR}&nbsp;<font class="reqmsg">*</font> :</td>
                                   <td>
                                        <select name="Data[vCurrency][]" id="vCurrency" class="required" style="width:100px; height:100px;" title="{$LBL_SELECT} {$LBL_CURR}" multiple="multiple" >
                                        {section name="c" loop=$currency}
                                           <option value="{$currency[c].vCurrency|htmlentities}" {if $currency[c].vCurrency|in_array:$arr[0].vCurrency}selected="selected"{/if} >{$currency[c].vCurrency}</option>
                                        {/section}
                                        </select>
                                        {*}<input type="text" name="Data[vCurrency]" class="input-rag required" id="vCurrency" style="width:96px;" title="Enter Currency" value="{$arr[0].vCurrency}" tabIndex="12"/>{*}
                                   </td>
                              </tr>
                              {if $orgdtls[0].eOrganizationType neq 'Buyer2'}
                              <tr>
                                 <td >{$LBL_SECURE_IMPORT}&nbsp;:</td>
                                 <td >
                                    {if $bylvl eq 'Yes'}
                                    <input  type="checkbox" name="Data[eSecureImportPO]" id="eSecureImportPO" {if $arr[0].eSecureImportPO eq 'Yes'}checked="checked"{/if} value="Yes" />
                                    <label style="padding-right:20px"> {$LBL_PURCHASE_ORDER}</label>
                                    {/if}
                                    {if $suplvl eq 'Yes'}
                                    <input type="checkbox" name="Data[eSecureImportInvoice]" id="eSecureImportInvoice" {if $arr[0].eSecureImportInvoice eq 'Yes'}checked="checked"{/if} value="Yes" />
                                    {$LBL_INVOICE}
                                    {/if}
                                 </td>
                              </tr>
                              <tr>
                                 <td >{$LBL_SECURE_EXPORT}&nbsp;:</td>
                                 <td>
                                    {*if $bylvl eq 'Yes'*}
                                    <input  type="checkbox" name="Data[eSecureExportPO]" id="eSecureExportPO" {if $arr[0].eSecureExportPO eq 'Yes'}checked="checked"{/if} value="Yes" />
                                    <label style="padding-right:20px"> {$LBL_PURCHASE_ORDER}</label>
                                    {*/if*}
                                    {*if $suplvl eq 'Yes'*}
                                    <input type="checkbox" name="Data[eSecureExportInvoice]" id="eSecureExportInvoice" {if $arr[0].eSecureExportInvoice eq 'Yes'}checked="checked"{/if} value="Yes" />
                                    {$LBL_INVOICE}
                                    {*/if*}
                                 </td>
                              </tr>
                              <tr>
                                   <td>{$LBL_ENCRYPTION_METHOD}&nbsp;:</td>
                                   <td>{$cryptAlgo}</td>
                              </tr>
                              <tr>
                                 <td valign="top">{$LBL_ENCRYPTIONKEY}&nbsp;:</td>
                                 <td>
                                   <input type="text" name="Data[vEncryptionKey]" style="width:190px" id="vEncryptionKey" class="input" title="{$LBL_ENTER_ENCRYPTION_KEY}" value="{$arr[0].vEncryptionKey|trim}" />
                                    {*if $view eq 'edit'}
                                       {if $arr[0].vEncryptionKey|trim neq ''}<b>{$arr[0].vEncryptionKey}</b>{else}<input type="text" name="Data[vEncryptionKey]" style="width:190px" id="vEncryptionKey" class="input" title="{$LBL_ENTER_ENCRYPTION_KEY}" />{/if}
                                    {else}
                                       <input type="text" name="Data[vEncryptionKey]" style="width:190px" id="vEncryptionKey" class="input" title="{$LBL_ENTER_ENCRYPTION_KEY}" />
                                    {/if*}
                                 </td>
                              </tr>
                              <tr>
                                   <td colspan="2" height="5"></td>
                              </tr>
                              {*}<tr>
                                   <td>VAT :</td>
                                   <td>
                                        <input type="text" name="Data[fVAT]" class="input-rag" id="fVAT" style="width:96px;" value="{$arr[0].fVAT}" tabIndex="13"/></td>
                              </tr>
                              <tr>
                                   <td>{$LBL_OTHER_TEX} :</td>
                                   <td>
                                        <input type="text" name="Data[fOtherTax]" class="input-rag" id="fOtherTax" style="width:96px;" value="{$arr[0].fOtherTax}" tabIndex="14"/></td>
                              </tr>
                              <tr>
                                   <td>{$LBL_HOLD_TEXT} :</td>
                                   <td>
                                        <input type="text" name="Data[fWithHoldingTax]" class="input-rag" id="fWithHoldingTax" style="width:96px;" value="{$arr[0].fWithHoldingTax}" tabIndex="15"/></td>
                              </tr>{*}
                              <tr>
                                   <td>{$LBL_CREATE_METHOD_ALLOWED}&nbsp;<font class="reqmsg">*</font> :</td>
                                   <td>
                                      {if $bylvl eq 'Yes'}
                                      {$LBL_PURCHASE_ORDER}: {$crMethodPO} &nbsp; &nbsp; &nbsp;
                                      {/if}
                                      {if $suplvl eq 'Yes'}
                                      {$LBL_INVOICE}: {$crMethodINV}
                                      {/if}
                                   </td>
                              </tr>
                              {*}<tr>
                                   <td>{$LBL_VERIFICATION_REQUIRED}&nbsp;<font class="reqmsg"></font> :</td>
                                   <td>
                                       {if $bylvl eq 'Yes'}
                                       <input type="checkbox" name="Data[eReqVerificationPo]" value="Yes" {if $arr[0].eReqVerificationPo eq 'Yes'} checked {/if}  /> {$LBL_PO_ISSUANCE} &nbsp;&nbsp;&nbsp;
                                       <input type="checkbox" name="Data[eReqVerifyInvAcpt]" value="Yes" {if $arr[0].eReqVerifyInvAcpt eq 'Yes'} checked {/if}  /> {$LBL_INVOICE_ACCEPTANCE} &nbsp;&nbsp;&nbsp;
                                       {/if}
                                       {if $suplvl eq 'Yes'}
                                       <input type="checkbox" name="Data[eReqVerificationInv]" value="Yes" {if $arr[0].eReqVerificationInv eq 'Yes'} checked {/if} /> {$LBL_INVOICE_ISSUANCE} &nbsp;&nbsp;&nbsp;
                                       <input type="checkbox" name="Data[eReqVerifyPoAcpt]" value="Yes" {if $arr[0].eReqVerifyPoAcpt eq 'Yes'} checked {/if}  /> {$LBL_PO_ACCEPTANCE}
                                       {/if}
                                   </td>
                              </tr>{*}
                              <tr>
                                   <td colspan="2" height="5"></td>
                              </tr>
                              {*if $orgdtls[0].eReqVerification eq 'Yes'*}
                              {if $bylvl eq 'Yes'}
                              <tr id="trBuyer">
                                   <td valign="top">{$LBL_BUYER_RIGHTS} : </td>
                                   <td>
                                   <table>
                                   <tr>
                                      <td>{$LBL_VERIFICATION_REQUIRED}&nbsp;<font class="reqmsg"></font> :</td>
                                      <td>
                                         <input type="checkbox" name="Data[eReqVerificationPo]" value="Yes" {if $arr[0].eReqVerificationPo eq 'Yes'} checked {/if}  /> {$LBL_PO_ISSUANCE} &nbsp;&nbsp;&nbsp;
                                         <input type="checkbox" name="Data[eReqVerifyInvAcpt]" value="Yes" {if $arr[0].eReqVerifyInvAcpt eq 'Yes'} checked {/if}  /> {$LBL_INVOICE_ACCEPTANCE} &nbsp;&nbsp;&nbsp;
                                      </td>
                                   </tr>
                                   <tr>
                                   <td>
                                        {$LBL_ORDER_STATUS_LEVEL} : <br/>
                                        <select multiple="multiple" name="vOrderStatusLevel[]" id="vOrderStatusLevel" style="width:176px; height:50px;" >
                                             {section name=i loop=$POarr}
                                                {if $POarr[i].status|in_array:$lvls}
                                                <option value="{$POarr[i].iStatusID}" {if $POarr[i].iStatusID|in_array:$selPOarr}selected{/if}>{assign var="level" value="vStatus_`$LANG`"}{$POarr[i].$level}</option>
                                                {/if}
                                             {/section}
                                        </select>
                                   </td>
                                   <td>
                                        {$LBL_INV_ACCEPTANCE_LEVEL} : <br/>
                                        <select multiple="multiple" name="vInvoiceAcceptanceLevel[]" id="vInvoiceAcceptanceLevel" style="width:176px; height:50px;" >
                                             {section name=i loop=$invarr}
                                                {if $invarr[i].status|in_array:$lvls}
                                                <option value="{$invarr[i].iStatusID}" {if $invarr[i].iStatusID|in_array:$acptInvArr}selected{/if}>{assign var="level" value="vStatus_`$LANG`"}{$invarr[i].$level}</option>
                                                {/if}
                                             {/section}
                                        </select>
                                   </td>
                                   </tr>
                                   </table>
                                   </td>
                              </tr>
                              {/if}
                              {if $suplvl eq 'Yes'}
                              <tr id="trSupplier">
                                   <td valign="top">{$LBL_SUPPLIER_RIGHTS} : </td>
                                   <td>
                                   <table>
                                   <tr>
                                      <td>{$LBL_VERIFICATION_REQUIRED}&nbsp;<font class="reqmsg"></font> :</td>
                                      <td>
                                         <input type="checkbox" name="Data[eReqVerificationInv]" value="Yes" {if $arr[0].eReqVerificationInv eq 'Yes'} checked {/if} /> {$LBL_INVOICE_ISSUANCE} &nbsp;&nbsp;&nbsp;
                                         <input type="checkbox" name="Data[eReqVerifyPoAcpt]" value="Yes" {if $arr[0].eReqVerifyPoAcpt eq 'Yes'} checked {/if}  /> {$LBL_PO_ACCEPTANCE}
                                      </td>
                                   </tr>
                                   <tr>
                                   <td>
                                        {$LBL_INV_STATUS_LEVEL} : <br/>
                                        <select multiple="multiple" name="vInvoiceStatusLevel[]" id="vInvoiceStatusLevel" style="width:176px; height:50px;" >
                                             {section name=i loop=$invarr}
                                                {if $invarr[i].status|in_array:$lvls}
                                                <option value="{$invarr[i].iStatusID}" {if $invarr[i].iStatusID|in_array:$selinvarr}selected{/if}>{assign var="level" value="vStatus_`$LANG`"}{$invarr[i].$level}</option>
                                                {/if}
                                             {/section}
                                        </select>
                                   </td>
                                   <td>
                                        {$LBL_ORD_ACCEPTANCE_LEVEL} : <br/>
                                        <select multiple="multiple" name="vOrderAcceptanceLevel[]" id="vOrderAcceptanceLevel" style="width:176px; height:50px;" >
                                             {section name=i loop=$POarr}
                                                {if $POarr[i].status|in_array:$lvls}
                                                <option value="{$POarr[i].iStatusID}" {if $POarr[i].iStatusID|in_array:$acptOrdArr}selected{/if}>{assign var="level" value="vStatus_`$LANG`"}{$POarr[i].$level}</option>
                                                {/if}
                                             {/section}
                                        </select>
                                   </td>
                                   </tr>
                                   </table>
                                   </td>
                              </tr>
                              {/if}
                              {*/if*}
                              {if $ENABLE_AUCTION eq 'Yes'}
                              <tr>
                                 <td valign="top">{$LBL_RFQ2}&nbsp; :</td>
                                 <td><label><input type="checkbox" name="Data[eRFQ2VerifyReq]" id="eRFQ2VerifyReq" value="Yes" {if $arr[0].eRFQ2VerifyReq eq 'Yes'}checked="checked"{/if} /> &nbsp; {$LBL_VERIFICATION_REQUIRED}</label></td>
                              </tr>
                              <tr>
                                 <td valign="top">{$LBL_RFQ2_AWARD}&nbsp; :</td>
                                 <td><label><input type="checkbox" name="Data[eRFQ2AwardVerifyReq]" id="eRFQ2AwardVerifyReq" value="Yes" {if $arr[0].eRFQ2AwardVerifyReq eq 'Yes'}checked="checked"{/if} /> &nbsp; {$LBL_VERIFICATION_REQUIRED}</label></td>
                              </tr>
                              <tr>
                                 <td valign="top">{$LBL_RFQ2_AWARD_STATUS_LEVELS}&nbsp; :</td>
                                 <td>
                                 <select id="vRFQ2AwardStatusLevel" name="vRFQ2AwardStatusLevel[]" multiple="multiple" style="width:100px;">
                                    {section name='l' loop=$awardStatus}
                                    <option value="{$awardStatus[l].iStatusID}" {if $awardStatus[l].iStatusID|in_array:$rfq2awrdstssel}selected="selected"{/if}>{$awardStatus[l].vStatus}</option>
                                    {/section}
                                 </select>
                                 </td>
                              </tr>
                              {/if}
                              {elseif $orgdtls[0].eOrganizationType eq 'Buyer2'}
                              <tr>
                                 <td valign="top">{$LBL_RFQ2_BID}&nbsp; :</td>
                                 <td><label><input type="checkbox" name="Data[eRFQ2BidVerifyReq]" id="eRFQ2BidVerifyReq" value="Yes" {if $arr[0].eRFQ2BidVerifyReq eq 'Yes'}checked="checked"{/if} /> &nbsp; {$LBL_VERIFICATION_REQUIRED}</label></td>
                              </tr>
                              <tr>
                                 <td valign="top">{$LBL_RFQ2_AWARD_ACCEPTANCE}&nbsp; :</td>
                                 <td><label><input type="checkbox" name="Data[eRFQ2AwardAcceptVerifyReq]" id="eRFQ2AwardAcceptVerifyReq" value="Yes" {if $arr[0].eRFQ2AwardAcceptVerifyReq eq 'Yes'}checked="checked"{/if} /> &nbsp; {$LBL_VERIFICATION_REQUIRED}</label></td>
                              </tr>
                              <tr>
                                 <td valign="top">{$LBL_RFQ2_AWARD_ACCEPTANCE_STATUS_LEVELS}&nbsp; :</td>
                                 <td>
                                 <select id="vRFQ2AwardAcceptLevel" name="vRFQ2AwardAcceptLevel[]" multiple="multiple" style="width:100px;">
                                    {section name='l' loop=$awardAcceptStatus}
                                    <option value="{$awardAcceptStatus[l].iStatusID}" {if $awardAcceptStatus[l].iStatusID|in_array:$rfq2awrdacptsel}selected="selected"{/if}>{$awardAcceptStatus[l].vStatus}</option>
                                    {/section}
                                 </select>
                                 </td>
                              </tr>
                              {/if}
                              <tr>
                                   <td colspan="2" height="5"></td>
                              </tr>
                              <tr>
                                   <td>&nbsp;</td>
                                   <td>
                                        <img id="btnSubmit" name="Submit" title="Submit" src="{$SITE_IMAGES}sm_images/btn-submit.gif" alt="" onclick="return frmSubmit();" style="cursor:pointer; vertical-align:middle;" border="0" /> &nbsp; <img id="reset_btn" src="{$SITE_IMAGES}sm_images/btn-reset.gif" alt="" border="0" onclick="resetform();return false;" style="cursor:pointer; vertical-align:middle;" /> &nbsp; <img src="{$SITE_IMAGES}sm_images/btn-cancel.gif" alt="" border="0" onClick="window.location=SITE_URL_DUM+'organizationlist';" style="cursor:pointer; vertical-align:middle;" />
                                   </td>
                              </tr>
                         </table>
                         </form>
                    </div>
                    <div>&nbsp;</div>
               </div>
          </div>
     </div>
<input id="vldms" name="vldms" style="display:none;" value="" />
</div>

<script type="text/javascript">//<![CDATA[
// window.CKEDITOR_BASEPATH='{$CK_EDITOR_URL}';
//]]>
</script>
<!--<script type="text/javascript" src="{$CK_EDITOR_URL}ckeditor.js"></script>-->
<script type="text/javascript" src="{$S_JQUERY}jquery.validate.js"></script>
<!--<script type="text/javascript" src="{$SITE_JS}jckeditorpref.js"></script>-->

{literal}
<script type="text/javascript">
var vld = $("#frmadd").validate({
     rules: {
        "Data[vEncryptionKey]": {
           required: function() {
              if($('#eSecureImportPO').attr('checked') == true || $('#eSecureImportInvoice').attr('checked') == true || $('#eSecureExportPO').attr('checked') == true || $('#eSecureExportInvoice').attr('checked') == true) {
                 return true;
              } else {
                 return false;
              }
           }
        },
        "Data[eCryptAlgo]": {
           required: function() {
              if($('#eSecureImportPO').attr('checked') == true || $('#eSecureImportInvoice').attr('checked') == true || $('#eSecureExportPO').attr('checked') == true || $('#eSecureExportInvoice').attr('checked') == true) {
                 return true;
              } else {
                 return false;
              }
           }
        }
     },
     messages:{
        "Data[vCurrency]": {
           digits: "Please Enters only Digits"
        }
     }
});
//changeStatus($('#eReqVerification').val());
//var buyerDefault= $('#trBuyer').html();
//var supplierDefault=$('#trSupplier').html();
function resetform()
{
	$('#frmadd')[0].reset();
   vld.resetForm();
}
function changeStatus(vRight)
{
     var vRight;
     if(vRight == 'Yes')
     {
          //$('#trBuyer').html(buyerDefault);
          $('#trBuyer').show();
         // $('#trSupplier').html(supplierDefault);
          $('#trSupplier').show();
     }
    else
    {
         $('#trBuyer').hide();
         $('#trSupplier').hide();
         $('#trSupplier select option').removeAttr("selected");
         $('#trBuyer select option').removeAttr("selected");

   }
}
function frmSubmit()
{
   $('#frmadd').submit();
   $(document).ready( function() {
     $(function() {
        var ead=10;
        $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
     });
   });
}
</script>
{/literal}
<script type="text/javascript" src="{$SITE_JS_AJAX}jorgpref.js"></script>
{if $msg neq ''}
{literal}
<script type="text/javascript">
$(document).ready(function() {
	var msg = '{/literal}{$msg}{literal}';
   if(msg!= '' && msg != undefined && $('#vldms').val()!=msg) {
	  alert(msg);
     $('#vldms').val(msg);
   }
});
</script>
{/literal}
{/if}