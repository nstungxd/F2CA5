     <div class="middle-containt">
          <div class="statistics-main-box-white">
               <div class="clear"></div>
               <div class="inner-gray-bg">
                    {if $msg neq '' && $Oarr[0].eStatus neq 'Active' && $Oarr[0].eStatus neq 'Inactive'}
                         <div class="msg">{$msg}</div>
                    {/if}
                    <div style="height:10px;"></div>
                    <div>
                         <table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
                              <tr>
                                   <td width="205">{$LBL_ORGANIZATION} : </td>
                                   <td class="blue-ore">{if $orgdtls[0].vCompanyName neq ''}{$orgdtls[0].vCompanyName},{/if} <span>00001</span></td>
                              </tr>
                              {if $orgdtls[0].eOrganizationType neq 'Buyer2'}
                              <tr>
                                   <td valign="top">{$LBL_SOURCE_DOC} :</td>
                                   <td>
                                        {$arr[0].tSourcingDocument|stripslashes}
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top">{$LBL_GLOBAL_AGREEMENT} :</td>
                                   <td>
                                        {$arr[0].tGlobalAgreement|stripslashes}
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top"> {$LBL_PAYMENT_TERMS} :</td>
                                   <td>
                                        {$arr[0].tPaymentTerms|stripslashes}
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top"> {$LBL_FOB} :</td>
                                   <td>
                                        {$arr[0].tFOB|stripslashes}
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top"> {$LBL_DELIVERY_TERMS} :</td>
                                   <td>
                                        {$arr[0].tDeliveryTerms|stripslashes}
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top">{$LBL_SHIP_CONTROL} :</td>
                                   <td>
                                        {$arr[0].tShippingControl|stripslashes}
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top">{$LBL_COND_PAYMENT} :</td>
                                   <td>
                                        {$arr[0].tConditionsForPayment|stripslashes}
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top">{$LBL_PENALTIES} :</td>
                                   <td>
                                        {$arr[0].tPenalties|stripslashes}
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top">{$LBL_SPEC_INSTRUCT} :</td>
                                   <td>
                                        {$arr[0].tSpecialInstruction|stripslashes}
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top">Note :</td>
                                   <td>
                                        {$arr[0].tNote|stripslashes}
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top">{$LBL_TERMS_COND} :</td>
                                   <td>
                                        {$arr[0].tTermsAndConditions|stripslashes}
                                   </td>
                              </tr>
                              {/if}
                              <tr>
                                   <td>{$LBL_CURR}&nbsp; :</td>
                                   <td>
                                        {$arr[0].vCurrency}
                                   </td>
                              </tr>

                              {if $orgdtls[0].eOrganizationType neq 'Buyer2'}
                               <tr>
                                   <td valign="top">Create Method Allowed&nbsp;: </td>
                                   {*}<td>{$arr[0].eCreateMethodAllowed}</td>{*}
                                   <td>
                                      {if $bylvl eq 'Yes'}
                                      {$LBL_PURCHASE_ORDER}: {$arr[0].eCreateMethodAllowedPO} &nbsp; &nbsp; &nbsp;
                                      {/if}
                                      {if $suplvl eq 'Yes'}
                                      {$LBL_INVOICE}: {$arr[0].eCreateMethodAllowedInv}
                                      {/if}
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top">Create Method Allowed&nbsp;: </td>
                                   <td>
                                      {if $bylvl eq 'Yes'}
                                      {$LBL_PURCHASE_ORDER}: {$arr[0].eCreateMethodAllowedPO} &nbsp; &nbsp; &nbsp;
                                      {/if}
                                      {if $suplvl eq 'Yes'}
                                      {$LBL_INVOICE}: {$arr[0].eCreateMethodAllowedInv}
                                      {/if}
                                   </td>
                              </tr>
                              <tr>
                                 <td>{$LBL_SECURE_IMPORT} :</td>
                                 <td>
                                      {if $bylvl eq 'Yes'}
                                      {$LBL_PURCHASE_ORDER}: {$arr[0].eSecureImportPO} &nbsp; &nbsp; &nbsp;
                                      {/if}
                                      {if $suplvl eq 'Yes'}
                                      {$LBL_INVOICE}: {$arr[0].eSecureImportInvoice}
                                      {/if}
                                 </td>
                              </tr>
                              <tr>
                                 <td>{$LBL_ENCRYPTION_METHOD}&nbsp;:</td>
                                 <td>{if $arr[0].eCryptAlgo neq ''}{$arr[0].eCryptAlgo}{else}---{/if}</td>
                              </tr>
                              <tr>
                                 <td>{$LBL_ENCRYPTIONKEY}: </td>
                                 <td>{if $arr[0].vEncryptionKey neq ''}{$arr[0].vEncryptionKey}{else}---{/if}</td>
                              </tr>
                              {*}<tr>
                                   <td valign="top">Verification Required&nbsp;: </td>
                                    <td>
                                        <!--Invoice&nbsp;:&nbsp;{$arr[0].eReqVerificationInv}&nbsp;&nbsp;&nbsp;&nbsp;PO&nbsp;:&nbsp;{$arr[0].eReqVerificationPo}-->
                                        {if $bylvl eq 'Yes'}
                                        PO Issuance&nbsp;:&nbsp;{$arr[0].eReqVerificationPo}&nbsp;&nbsp;&nbsp;&nbsp;
                                        Invoice Acceptance&nbsp;:&nbsp;{$arr[0].eReqVerifyInvAcpt}&nbsp;&nbsp;&nbsp;&nbsp;
                                        {/if}
                                        {if $suplvl eq 'Yes'}
                                        Invoice Issuance&nbsp;:&nbsp;{$arr[0].eReqVerificationInv}&nbsp;&nbsp;&nbsp;&nbsp;
                                        PO Acceptance&nbsp;:&nbsp;{$arr[0].eReqVerifyPoAcpt}
                                        {/if}
                                    </td>
                              </tr>{*}

                              {*}<tr>
                                   <td>{$LBL_SECURE_IMPORT}</td>
                                   <td>{$LBL_PURCHASE_ORDER}: {$arr[0].eSecureImportPO} &nbsp; &nbsp; &nbsp; {$LBL_INVOICE}: {$arr[0].eSecureImportInvoice}</td>
                              </tr>
                              <tr>
                                   <td>{$LBL_SECURE_EXPORT}</td>
                                   <td>{$LBL_PURCHASE_ORDER}: {$arr[0].eSecureExportPO} &nbsp; &nbsp; &nbsp; {$LBL_INVOICE}: {$arr[0].eSecureExportInvoice}</td>
                              </tr>{*}

                              {*}<tr>
                                   <td>VAT :</td>
                                   <td>
                                        {$arr[0].fVAT}
                                   </td>
                              </tr>
                              <tr>
                                   <td>{$LBL_OTHER_TEX} :</td>
                                   <td>
                                        {$arr[0].fOtherTax}
                                   </td>
                              </tr>
                              <tr>
                                   <td>{$LBL_HOLD_TEXT} :</td>
                                   <td>
                                        {$arr[0].fWithHoldingTax}
                                   </td>
                              </tr>{*}

                              {if $bylvl eq 'Yes'}
                              <tr><td colspan="2" align="left">&nbsp;</td></tr>
                              <tr><td colspan="2" align="left">{$LBL_BUYER_RIGHTS}</td></tr>
                              <tr>
                                 <td valign="top">Verification Required:</td>
                                 <td align="left">
                                    PO Issuance&nbsp;:&nbsp;{$arr[0].eReqVerificationPo}&nbsp;&nbsp;&nbsp;&nbsp;
                                    Invoice Acceptance&nbsp;:&nbsp;{$arr[0].eReqVerifyInvAcpt}&nbsp;&nbsp;&nbsp;&nbsp;
                                 </td>
                              </tr>
                              <tr>
                                   <td valign="top">{$LBL_ORDER_STATUS_LEVEL} : </td>
                                   <td>
                                   {assign var="fl" value='n'}
                                   {section name=i loop=$POarr}
                                         {if $POarr[i].iStatusID|in_array:$selPOarr && $POarr[i].eType eq 'Optional'}
                                         {assign var="level" value="vStatus_`$LANG`"}
                                         {if $fl eq 'y'},{/if}
                                             {$POarr[i].$level}
                                             {*if $POarr[i.index_next].iStatusID|in_array:$selPOarr},{/if*}
                                             {assign var="fl" value='y'}
                                         {/if}
                                   {/section}
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top">{$LBL_INV_ACCEPTANCE_LEVEL} : </td>
                                   <td>
                                        {assign var="fl" value='n'}
                                        {section name=i loop=$invarr}
                                             {if $invarr[i].iStatusID|in_array:$acptInvArr && $invarr[i].eType eq 'Optional'}
                                             {assign var="level" value="vStatus_`$LANG`"}
                                             {if $fl eq 'y'},{/if}
                                                  {$invarr[i].$level}
                                                  {assign var="fl" value='y'}
                                             {/if}
                                        {/section}
                                   </td>
                              </tr>
                              {/if}
                              {if $suplvl eq 'Yes'}
                              <tr><td colspan="2" align="left">&nbsp;</td></tr>
                              <tr><td colspan="2" align="left">{$LBL_SUPPLIER_RIGHTS}</td></tr>
                              <tr>
                                 <td valign="top">Verification Required</td>
                                 <td align="left">
                                    Invoice Issuance&nbsp;:&nbsp;{$arr[0].eReqVerificationInv}&nbsp;&nbsp;&nbsp;&nbsp;
                                    PO Acceptance&nbsp;:&nbsp;{$arr[0].eReqVerifyPoAcpt}
                                 </td>
                              </tr>
                              <tr>
                                   <td valign="top">{$LBL_INV_STATUS_LEVEL} : </td>
                                   <td><span>
                                        {assign var="fl" value='n'}
                                        {section name=i loop=$invarr}
                                             {if $invarr[i].iStatusID|in_array:$selinvarr && $invarr[i].eType eq 'Optional'}
                                             {assign var="level" value="vStatus_`$LANG`"}
                                             {if $fl eq 'y'},{/if}
                                                  {$invarr[i].$level}
                                                  {assign var="fl" value='y'}
                                             {/if}
                                        {/section}
                                        </span>
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top">{$LBL_ORD_ACCEPTANCE_LEVEL} : </td>
                                   <td>
                                   {assign var="fl" value='n'}
                                   {section name=i loop=$POarr}
                                         {if $POarr[i].iStatusID|in_array:$acptOrdArr && $POarr[i].eType eq 'Optional'}
                                         {assign var="level" value="vStatus_`$LANG`"}
                                         {if $fl eq 'y'},{/if}
                                             {$POarr[i].$level}
                                             {assign var="fl" value='y'}
                                         {/if}
                                   {/section}
                                   </td>
                              </tr>
                              {/if}
                              {if $ENABLE_AUCTION eq 'Yes'}
                              <tr><td colspan="2">&nbsp;</td></tr>
                              <tr><td colspan="2">{$LBL_AUCTION_TENDER_RIGHTS}&nbsp;</td></tr>
                              <tr>
                                 <td valign="top">{$LBL_RFQ2}&nbsp;:</td>
                                 <td align="left">{$LBL_VERIFICATION_REQUIRED} : <b>{$arr[0].eRFQ2VerifyReq}</b></td>
                              </tr>
                              <tr>
                                 <td valign="top">{$LBL_RFQ2_AWARD}&nbsp;:</td>
                                 <td align="left">{$LBL_VERIFICATION_REQUIRED} : <b>{$arr[0].eRFQ2AwardVerifyReq}</b></td>
                              </tr>
                              <tr>
                                 <td valign="top">{$LBL_RFQ2_AWARD_STATUS_LEVELS}&nbsp;:</td>
                                 <td valign="top" align="left">{$rfq2awrdsts}</td>
                              </tr>
                              {/if}
                              {elseif $orgdtls[0].eOrganizationType eq 'Buyer2'}
                              <tr>
                                 <td valign="top">{$LBL_RFQ2_BID}&nbsp;<font class="reqmsg">*</font> : </td>
                                 <td>{$LBL_VERIFICATION_REQUIRED} : <b>{$arr[0].eRFQ2BidVerifyReq}</b></td>
                              </tr>
                              <tr>
                                 <td valign="top">{$LBL_RFQ2_AWARD_ACCEPTANCE}&nbsp;<font class="reqmsg">*</font> : </td>
                                 <td>{$LBL_VERIFICATION_REQUIRED} : <b>{$arr[0].eRFQ2AwardAcceptVerifyReq}</b></td>
                              </tr>
                              <tr>
                                 <td valign="top">{$LBL_RFQ2_AWARD_ACCEPTANCE_STATUS_LEVELS}&nbsp;<font class="reqmsg">*</font> : </td>
                                 <td valign="top">{$rfq2awrdacptsts}</td>
                              </tr>
                              {/if}
                              {if $verify eq 'yes'}
                              <tr>
                                <td valign="top">{$LBL_REASON_TO_REJECT}: </td>
                                <td><textarea id="tReasonToReject" name="tReasonToReject" cols="70" rows="3"></textarea></td>
                              </tr>
                              {/if}
                              {*}<tr>
                                   <td valign="top">{$LBL_ORDER_STATUS_LEVEL} :</td>
                                   <td>
                                             {section name=i loop=$POarr}
                                                   {if $POarr[i].iStatusID|in_array:$selPOarr}
                                                   {assign var="level" value="vStatus_`$LANG`"}
                                                       {$POarr[i].$level}
                                                       {if $POarr[i.index_next].iStatusID|in_array:$selPOarr},{/if}
                                                   {/if}
                                             {/section}
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top">{$LBL_INV_STATUS_LEVEL} :</td>
                                   <td><span>
                                             {section name=i loop=$invarr}
                                                  {if $invarr[i].iStatusID|in_array:$selinvarr}
                                                  {assign var="level" value="vStatus_`$LANG`"}
                                                       {$invarr[i].$level}
                                                       {if $invarr[i.index_next].iStatusID|in_array:$selinvarr},{/if}
                                                  {/if}
                                             {/section}
                                        </span>
                                   </td>
                              </tr>{*}
                              <tr>
                                   <td colspan="2" valign="top">&nbsp;</td>
                              </tr>
                         </table>
                    </div>
                    <div>&nbsp;</div>
               </div>
          </div>
     </div>
