<div class="middle-container">
     <h1><span>{$LBL_CREATE_ORG}</span></h1>
     <div class="middle-containt">
          <div class="statistics-main-box-white">
               <div>
                    <ul id="inner-tab">
                         <li><a href="{$SITE_URL_DUM}organizationview/{$iOrganizationID}" class="{if $file eq 'or-createorganization'}current{/if}"><EM>{$LBL_ORG_INFO}</EM></a></li>
                         <li><a href="{$SITE_URL_DUM}organizationprefview/{$iOrganizationID}/{$iAdditionalInfoID}" class="{if $file eq 'or-organizationprefview'}current{/if}"><EM>{$LBL_PREFERENCES}</EM></a></li>
                    </ul>
               </div>
               <div class="clear"></div>
               <div class="inner-gray-bg">
                    {if $msg neq '' && $Oarr[0].eStatus neq 'Active' && $Oarr[0].eStatus neq 'Inactive'}
                         <div class="msg">
                              {$msg}<br/>{*$chng*}
                              {*if $verify eq 'yes'}
                              {if $act neq 'yes'}
                                   {$LBL_REC_CAN_NOT_BE_VERIFIED|stripslashes} {$LBL_AS} {$LBL_ORG_NOT_ACTIVE}
                              {/if}
                              {/if*}
                         </div>
                    {/if}
                    <div style="height:10px;"></div>
                    <div>
                         {*}<form name="orgprefverify" id="orgprefverify" method="post" action="{$SITE_URL}index.php?file=or-createorganizationpref_a">{*}
                         <form name="orgverify" id="orgverify" method="post" action="{$SITE_URL}index.php?file=or-createorganization_a">
                         <table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
                              <tr>
                                   <td width="160" >{$LBL_ORGANIZATION} : </td><td></td>
                                   <td  colspan="3"  class="blue-ore">
                                        {if $orgdtls[0].vCompanyName neq ''}{$orgdtls[0].vCompanyName} <span>({$orgdtls[0].vOrganizationCode})</span>{/if}
                                        {*}<span style="float:right;"><b><a class="colorbox" href="javascript:openpopup('{$SITE_URL_DUM}orgprefviewhistory/{$iOrganizationID}')" >{$LBL_VIEW_HISTORY}</a></b></span>{*}
                                   </td>
                              </tr>
                              {if $orgdtls[0].eOrganizationType neq 'Buyer2'}
                              <tr>
                                   <td valign="top">{$LBL_SOURCE_DOC} </td>
                                   <td valign="top">:</td>
                                   <td>
                                        {$arr[0].tSourcingDocument|stripslashes}
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top">{$LBL_GLOBAL_AGREEMENT} </td>
                                   <td valign="top">:</td>
                                   <td>
                                        {$arr[0].tGlobalAgreement|stripslashes}
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top"> {$LBL_PAYMENT_TERMS} </td>
                                   <td valign="top">:</td>
                                   <td>
                                        {$arr[0].tPaymentTerms|stripslashes}
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top"> {$LBL_FOB} </td>
                                   <td valign="top">:</td>
                                   <td>
                                        {$arr[0].tFOB|stripslashes}
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top"> {$LBL_DELIVERY_TERMS} </td>
                                   <td valign="top">:</td>
                                   <td>
                                        {$arr[0].tDeliveryTerms|stripslashes}
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top">{$LBL_SHIP_CONTROL} </td>
                                   <td valign="top">:</td>
                                   <td>
                                        {$arr[0].tShippingControl|stripslashes}
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top">{$LBL_COND_PAYMENT} </td>
                                   <td valign="top">:</td>
                                   <td>
                                        {$arr[0].tConditionsForPayment|stripslashes}
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top">{$LBL_PENALTIES} </td>
                                   <td valign="top">:</td>
                                   <td>
                                        {$arr[0].tPenalties|stripslashes}
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top">{$LBL_SPEC_INSTRUCT}</td>
                                   <td valign="top">:</td>
                                   <td>
                                        {$arr[0].tSpecialInstruction|stripslashes}
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top">Note </td>
                                   <td valign="top">:</td>
                                   <td>
                                        {$arr[0].tNote|stripslashes}
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top">{$LBL_TERMS_COND} </td>
                                   <td valign="top">:</td>
                                   <td>
                                        {$arr[0].tTermsAndConditions|stripslashes}
                                   </td>
                              </tr>
                              {/if}
                              <tr>
                                   <td valign="top">{$LBL_CURR}&nbsp; </td>
                                   <td valign="top">:</td>
                                   <td>
                                        {$arr[0].vCurrency}
                                   </td>
                              </tr>
                              {if $orgvf[0].eOrganizationType neq 'Buyer2'}
                              <tr><td colspan="3" align="left">&nbsp;</td></tr>
                              <tr>
                                   <td valign="top">Create Method Allowed&nbsp; </td>
                                   <td valign="top">:</td>
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
                                   <td>{$LBL_SECURE_IMPORT}</td>
                                   <td>:</td>
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
                                   <td>{$LBL_SECURE_EXPORT}</td>
                                   <td>:</td>
                                   <td>
                                      {$LBL_PURCHASE_ORDER}: {$arr[0].eSecureExportPO} &nbsp; &nbsp; &nbsp; {$LBL_INVOICE}: {$arr[0].eSecureExportInvoice}
                                   </td>
                              </tr>
                              <tr>
                                   <td>{$LBL_ENCRYPTION_METHOD}&nbsp;</td>
                                   <td valign="top">:</td>
                                   <td>{if $arr[0].eCryptAlgo neq ''}{$arr[0].eCryptAlgo}{else}---{/if}</td>
                              </tr>
                              <tr>
                                   <td>{$LBL_ENCRYPTIONKEY}</td>
                                   <td>:</td>
                                   <td>{if $arr[0].vEncryptionKey|trim neq ''}{$arr[0].vEncryptionKey}{else}---{/if}</td>
                              </tr>
                              {*}<tr>
                                   <td>VAT </td>
                                  <td valign="top">:</td>
                                   <td>
                                        {$arr[0].fVAT}
                                   </td>
                              </tr>
                              <tr>
                                   <td>{$LBL_OTHER_TEX} </td>
                                   <td valign="top">:</td>
                                   <td>
                                        {$arr[0].fOtherTax}
                                   </td>
                              </tr>
                              <tr>
                                   <td>{$LBL_HOLD_TEXT} </td>
                                   <td valign="top">:</td>
                                   <td>
                                        {$arr[0].fWithHoldingTax}
                                   </td>
                              </tr>{*}


                              {if $bylvl eq 'Yes'}
                             <tr><td colspan="3" align="left">&nbsp;</td></tr>
                              <tr><td colspan="3" align="left">{$LBL_BUYER_RIGHTS}</td></tr>
                              <tr>
                                 <td valign="top">Verification Required</td>
                                 <td valign="top">:</td>
                                 <td align="left">
                                    PO Issuance&nbsp;:&nbsp;{$arr[0].eReqVerificationPo}&nbsp;&nbsp;&nbsp;&nbsp;
                                    Invoice Acceptance&nbsp;:&nbsp;{$arr[0].eReqVerifyInvAcpt}&nbsp;&nbsp;&nbsp;&nbsp;
                                 </td>
                              </tr>
                              <tr>
                                   <td valign="top">{$LBL_ORDER_STATUS_LEVEL} </td>
                                   <td valign="top">:</td>
                                   <td>
                                   {assign var="fl" value='n'}
                                   {section name=i loop=$POarr}
                                         {if $POarr[i].iStatusID|in_array:$selPOarr && $POarr[i].eType eq 'Optional'}
                                         {assign var="level" value="vStatus_`$LANG`"}
                                         {if $fl eq 'y'},{/if}
                                             {$POarr[i].$level}
                                             {assign var="fl" value='y'}
                                         {/if}
                                   {/section}
                                   </td>
                              </tr>
                              <tr>
                                   <td valign="top">{$LBL_INV_ACCEPTANCE_LEVEL} </td>
                                   <td valign="top">:</td>
                                   <td><span>
                                        {assign var="fl" value='n'}
                                        {section name=i loop=$invarr}
                                             {if $invarr[i].iStatusID|in_array:$acptInvArr && $invarr[i].eType eq 'Optional'}
                                             {assign var="level" value="vStatus_`$LANG`"}
                                             {if $fl eq 'y'},{/if}
                                                  {$invarr[i].$level}
                                                  {assign var="fl" value='y'}
                                             {/if}
                                        {/section}
                                        </span>
                                   </td>
                              </tr>
                              {/if}
                              {if $suplvl eq 'Yes'}
                              <tr><td colspan="3" align="left">&nbsp;</td></tr>
                              <tr><td colspan="3" align="left">{$LBL_SUPPLIER_RIGHTS}</td></tr>
                              <tr>
                                 <td valign="top">Verification Required</td>
                                 <td valign="top">:</td>
                                 <td align="left">
                                    Invoice Issuance&nbsp;:&nbsp;{$arr[0].eReqVerificationInv}&nbsp;&nbsp;&nbsp;&nbsp;
                                    PO Acceptance&nbsp;:&nbsp;{$arr[0].eReqVerifyPoAcpt}
                                 </td>
                              </tr>
                              <tr>
                                   <td valign="top">{$LBL_INV_STATUS_LEVEL} </td>
                                   <td valign="top">:</td>
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
                                   <td valign="top">{$LBL_ORD_ACCEPTANCE_LEVEL} </td>
                                   <td valign="top">:</td>
                                   <td>
                                   {assign var="fl" value='n'}
                                   {section name=i loop=$POarr}
                                         {if $POarr[i].iStatusID|in_array:$acptOrdArr && $POarr[i].eType eq 'Optional'}
                                         {assign var="level" value="vStatus_`$LANG`"}
                                         {if $fl eq 'y'},{/if}
                                             {$POarr[i].$level}
                                             {*if $POarr[i.index_next].iStatusID|in_array:$acptOrdArr},{/if*}
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
                                 <td valign="top">{$LBL_RFQ2}&nbsp;</td><td> :</td>
                                 <td>{$LBL_VERIFICATION_REQUIRED} : <b>{$arr[0].eRFQ2VerifyReq}</b></td>
                              </tr>
                              <tr>
                                 <td valign="top">{$LBL_RFQ2_AWARD}&nbsp;</td><td> :</td>
                                 <td>{$LBL_VERIFICATION_REQUIRED} : <b>{$arr[0].eRFQ2AwardVerifyReq}</b></td>
                              </tr>
                              <tr>
                                 <td valign="top">{$LBL_RFQ2_AWARD_STATUS_LEVELS}&nbsp;</td><td valign="top"> :</td>
                                 <td valign="top">{$rfq2awrdsts}</td>
                              </tr>
                              {/if}
                              {elseif $orgvf[0].eOrganizationType eq 'Buyer2'}
                              <tr>
                                 <td valign="top">{$LBL_RFQ2_BID}&nbsp;</td><td> :</td>
                                 <td>{$LBL_VERIFICATION_REQUIRED} : <b>{$arr[0].eRFQ2BidVerifyReq}</b></td>
                              </tr>
                              <tr>
                                 <td valign="top">{$LBL_RFQ2_AWARD_ACCEPTANCE}&nbsp;</td><td> :</td>
                                 <td>{$LBL_VERIFICATION_REQUIRED} : <b>{$arr[0].eRFQ2AwardAcceptVerifyReq}</b></td>
                              </tr>
                              <tr>
                                 <td valign="top">{$LBL_RFQ2_AWARD_ACCEPTANCE_STATUS_LEVELS}&nbsp;</td><td valign="top"> :</td>
                                 <td valign="top">{$rfq2awrdacptsts}</td>
                              </tr>
                              {/if}
                              {if $verify eq 'yes'}
                              <tr>
                                <td valign="top">{$LBL_REASON_TO_REJECT} </td>
                                <td valign="top">:</td>
                                <td><textarea id="tReasonToReject" name="tReasonToReject" cols="70" rows="3"></textarea></td>
                              </tr>
                              {/if}
                              {*if $varr[0].iRejectedById gt 0 && $varr[0].tReasonToReject|trim neq ''}
                              <tr>
                                <td valign="top">{$LBL_REASON_TO_REJECT} </td>
                                <td valign="top">:</td>
                                <td><div style="background:#fafafa; border:1px solid #cccccc; height:30px; width:390px; overflow-y:scroll;">{$varr[0].tReasonToReject|trim}</div></td>
                              </tr>
                              {/if*}
                              <tr>
                                   <td colspan="2" height="5"><input type="hidden" name="view" id="view" value="verify" /><input type="hidden" name="iOrgId" id="iOrgId" value="{$iOrganizationID}" /></td>
                              </tr>
                              <tr>
                                   <td valign="top">&nbsp;</td>
                                   <td colspan="2">
                                        <img src="{$SITE_IMAGES}sm_images/btn-back.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="history.back();" />
                                        {if $verify eq 'yes'}
                                         {*if $act eq 'yes'*}
                                         <img src="{$SITE_IMAGES}sm_images/btn-verify.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#orgverify').submit();" />
                                         <img src="{$SITE_IMAGES}sm_images/btn-reject.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('reject');$('#orgverify').submit();" />
                                         {*else}
                                           {$LBL_ORG_NOT_ACTIVE*} {*$MSG_VERIFY_ORG_FIRST*}
                                         {*/if*}
                                        {/if}
                                   </td>
                                   <td valign="top" align="right">&nbsp;
                                        {if $Oarr[0].eStatus eq 'Modified'}
                                           <a class="colorbox" href="{$SITE_URL_DUM}index.php?file=or-aj_orgprfoverview&orgid={$iOrganizationID}&id={$OiAdditionalInfoID}" onmouseover="CallColoerBox(this.href,520,520,'file');">Click Here to view Original</a>
                                        {/if}
                                   </td>
                              </tr>
                         </table>
                         </form>
                         </div>
                    </div>
                    <div>&nbsp;</div>
               </div>
          </div>
     </div>
</div>
