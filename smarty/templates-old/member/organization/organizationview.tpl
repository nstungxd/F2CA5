<div class="middle-container">
  <h1>{$LBL_ORG_VIEW}</h1>
  <div class="middle-containt">
  <div class="statistics-main-box-white">
     <div>
          <ul id="inner-tab">
              <li><a href="{$SITE_URL_DUM}organizationview/{$iOrganizationID}/{$pg}" class="{if $file eq 'or-organizationview'}current{/if}"><EM>{$LBL_ORG_INFO}</EM></a></li>
              {*if $chng eq 'yes'*}
              <li><a href="{$SITE_URL_DUM}organizationprefview/{$iOrganizationID}/{$iAdditionalInfoID}/{$pg}" class="{if $file eq 'or-organizationprefview'}current{/if}"><EM>{$LBL_PREFERENCES}</EM></a></li>
              {*/if*}
          </ul>
     </div>
  <div class="clear"></div>
  <div class="inner-gray-bg">
       {if $msg neq '' && ($Oarr[0].eStatus neq 'Active' || $Oarr[0].eNeedToVerify eq 'Yes')}
          <div class="msg">{$msg}</div>
       {/if}
  <div>&nbsp;</div>
  <div><span style="float:right;"><b><a class="" href="javascript:openpopup('{$SITE_URL_DUM}orgviewhistory/{$iOrganizationID}')" >{$LBL_VIEW_HISTORY}</a></b></span></div>
  <div>
    <form name="orgverify" id="orgverify" method="post" action="{$SITE_URL}index.php?file=or-createorganization_a">
     <table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
          <tr>
               <td width="180">{$LBL_COMP_NAME}&nbsp; </td>
               <td>:</td>
               <td align="left">{$arr[0].vCompanyName}</td>
          </tr>
          <tr>
               <td>{$LBL_COMP_REG_NO}&nbsp; </td>
               <td>:</td>
               <td>{$arr[0].vCompanyRegNo}</td>
          </tr>
          <tr>
               <td>{$LBL_ORG_CODE}&nbsp; </td>
               <td>:</td>
               <td>{$arr[0].vOrganizationCode}</td>
          </tr>
          <tr>
               <td>{$LBL_COMP_CODE}&nbsp; </td>
               <td>:</td>
               <td>{$arr[0].vCompCode}</td>
          </tr>
          <tr>
               <td> {$LBL_ADDR_LINE} 1&nbsp; </td>
               <td>:</td>
               <td>{$arr[0].vAddressLine1}</td>
          </tr>
          <tr>
               <td> {$LBL_ADDR_LINE} 2 </td>
               <td>:</td>
               <td>{$arr[0].vAddressLine2}</td>
          </tr>
          <tr>
               <td> {$LBL_ADDR_LINE} 3 </td>
               <td>:</td>
               <td>{$arr[0].vAddressLine3}</td>
          </tr>
          <tr>
               <td>{$LBL_CITY}&nbsp; </td>
               <td>:</td>
               <td>{$arr[0].vCity}</td>
          </tr>
          <tr>
               <td>{$LBL_COUNTRY}&nbsp; </td>
               <td>:</td>
               <td>
                        {section name=i loop=$db_country}
                              {if $arr[0].vCountry eq $db_country[i].vCountryCode}
                                   {$db_country[i].vCountry}
                              {/if}
                        {/section}
               </td>
          </tr>
                    <tr>
               <td>{$LBL_STATE}&nbsp; </td>
               <td>:</td>
               <td>
                    {section name=i loop=$db_state}
                         {if $arr[0].vState eq $db_state[i].vStateCode}
                              {$db_state[i].vState}
                         {/if}
                   {/section}
               </td>
          </tr>

          <tr>
               <td>{$LBL_ZIP_CODE}&nbsp; </td>
               <td>:</td>
               <td>{$arr[0].vZipcode}</td>
          </tr>
          <tr>
               <td>{$LBL_PHONE}&nbsp; </td>
               <td>:</td>
               <td>{$arr[0].vPhone}</td>
          </tr>
          <tr>
               <td>{$LBL_EMAIL}&nbsp; </td>
               <td>:</td>
               <td>{$arr[0].vEmail}</td>
          </tr>
          <tr>
               <td>{$LBL_WEB_SITE} </td>
               <td>:</td>
               <td>{$arr[0].vWebSite}</td>
          </tr>
          <tr>
               <td>{$LBL_ORG_TYPE}&nbsp; </td>
               <td>:</td>
               <td>{$arr[0].eOrganizationType}</td>
          </tr>
          <tr>
               <td>{$LBL_PRIME_CONTACT_NO}</td>
               <td>:</td>
               <td>{$arr[0].vPrimaryContactNo}</td>
          </tr>
          {*}<tr>
               <td>{$LBL_PRIME_CONTACT_EMAIL} </td>
               <td>:</td>
               <td>{$arr[0].vPrimaryContactEmail}</td>
          </tr>{*}
          <tr>
               <td>{$LBL_PRIME_CONTACT_TELE} </td>
               <td>:</td>
               <td>{$arr[0].vPrimaryContactTelephone}</td>
          </tr>
          <tr>
               <td>{$LBL_PRIME_CONTACT_MOB} </td>
               <td>:</td>
               <td>{$arr[0].vPrimaryContactMobile}</td>
          </tr>
          <tr>
               <td>{$LBL_VAT_ID} </td>
               <td>:</td>
               <td>{$arr[0].vVatId}</td>
          </tr>
          <tr>
               <td>{$LBL_BANK} </td>
               <td>:</td>
               <td>{$arr[0].vBankName}</td>
          </tr>
          <tr>
               <td>{$LBL_BANK_CODE} </td>
               <td>:</td>
               <td>{$arr[0].vBankCode}</td>
          </tr>
          <tr>
               <td>{$LBL_BRANCH} </td>
               <td>:</td>
               <td>{$arr[0].vBranchName}</td>
          </tr>
          <tr>
               <td>{$LBL_BRANCH_CODE} </td>
               <td>:</td>
               <td>{$arr[0].vBranchCode}</td>
          </tr>
          <tr>
               <td>Account1 Number </td>
               <td>:</td>
               <td>{$arr[0].vAccount1Number}</td>
          </tr>
             <tr>
               <td>Account1 Title </td>
               <td>:</td>
               <td>{$arr[0].vAccount1Title}</td>
          </tr>
          <tr>
               <td>Account1 Currency </td>
               <td>:</td>
               <td>{$arr[0].vAccount1Currency}</td>
          </tr>
          <tr>
               <td>Account2 Number </td>
               <td>:</td>
               <td>{$arr[0].vAccount2Number}</td>
          </tr>
          <tr>
               <td>Account2 Title </td>
               <td>:</td>
               <td>{$arr[0].vAccount2Title}</td>
          </tr>
          <tr>
               <td>Account2 Currency </td>
               <td>:</td>
               <td>{$arr[0].vAccount2Currency}</td>
          </tr>
          <!-- <tr>
               <td>Create Method Allowed&nbsp; </td>
               <td>:</td>
               <td>{$arr[0].eCreateMethodAllowed}</td>
          </tr>
          <tr>
               <td>Verification Required&nbsp; </td>
               <td>:</td>
               <td>{$arr[0].eReqVerification}</td>
          </tr> -->
          {if $verify eq 'yes'}
          <tr>
            <td valign="top">{$LBL_REASON_TO_REJECT} </td>
            <td valign="top">:</td>
            <td><textarea id="tReasonToReject" name="tReasonToReject" cols="70" rows="3"></textarea></td>
          </tr>
          {/if}
          {if $varr[0].iRejectedById gt 0 && $varr[0].tReasonToReject|trim neq ''}
          <tr>
            <td valign="top">{$LBL_REASON_TO_REJECT} </td>
            <td valign="top">:</td>
            <td><div style="background:#fafafa; border:1px solid #cccccc; height:30px; width:390px; overflow-y:scroll;">{$varr[0].tReasonToReject|trim}</div></td>
          </tr>
          {/if}
          {*}<tr>
               <td>Create Verification&nbsp; </td>
               <td>:</td>
               <td>{$arr[0].vAccount2Currency}</td>
          </tr>{*}
          <tr>
               <td colspan="3" height="5"><input type="hidden" name="view" id="view" value="verify" /><input type="hidden" name="iOrgId" id="iOrgId" value="{$iOrganizationID}" /></td>
          </tr>
          <tr>
               <td valign="top">&nbsp;</td>
               <td colspan="2">
                    <img src="{$SITE_IMAGES}sm_images/btn-back.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" {if $verify eq 'yes'}onclick="location.href='{$SITE_URL_DUM}verifyorganizationlist'"{else}onclick="location.href='{$SITE_URL_DUM}organizationlist'"{/if} />
                    {if $verify eq 'yes'}
                      <img src="{$SITE_IMAGES}sm_images/btn-verify.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#orgverify').submit();" />
                      <img src="{$SITE_IMAGES}sm_images/btn-reject.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('reject');$('#orgverify').submit();" />
                    {/if}
               </td>
               <td valign="top" align="right">&nbsp;{if $Oarr[0].eStatus eq 'Modified'}<a class="colorbox" href="{$SITE_URL_DUM}index.php?file=or-aj_orgoverview&id={$Oarr[0].iOrganizationID}" onmouseover="CallColoerBox(this.href,600,600,'options');">Click Here to view Original</a>{/if}</td>
          </tr>
     </table>
    </form>
   </div>
   <div>&nbsp;</div>
   </div>
   </div>
   </div>
</div>