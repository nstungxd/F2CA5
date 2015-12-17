  <div class="middle-containt">
  <div class="statistics-main-box-white">
  <div class="clear"></div>
  <div class="inner-gray-bg">
  <div>&nbsp;</div>
  <div>
     <table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
          <tr>
               <td width="205">{$LBL_COMP_NAME}&nbsp; : </td>
               <td>{$arr[0].vCompanyName}</td>
          </tr>
          <tr>
               <td>{$LBL_COMP_REG_NO}&nbsp; :</td>
               <td>{$arr[0].vCompanyRegNo}</td>
          </tr>
          <tr>
               <td>{$LBL_ORG_CODE}&nbsp; :</td>
               <td>{$arr[0].vOrganizationCode}</td>
          </tr>
          <tr>
               <td>{$LBL_COMP_CODE}&nbsp; :</td>
               <td>{$arr[0].vCompCode}</td>
          </tr>
          <tr>
               <td> {$LBL_ADDR_LINE} 1&nbsp; :</td>
               <td>{$arr[0].vAddressLine1}</td>
          </tr>
          <tr>
               <td> {$LBL_ADDR_LINE} 2 :</td>
               <td>{$arr[0].vAddressLine2}</td>
          </tr>
          <tr>
               <td> {$LBL_ADDR_LINE} 3 :</td>
               <td>{$arr[0].vAddressLine3}</td>
          </tr>
          <tr>
               <td>{$LBL_CITY}&nbsp; :</td>
               <td>{$arr[0].vCity}</td>
          </tr>
          <tr>
               <td>{$LBL_COUNTRY}&nbsp; :</td>
               <td>
                        {section name=i loop=$db_country}
                              {if $arr[0].vCountry eq $db_country[i].vCountryCode}
                                   {$db_country[i].vCountry}
                              {/if}
                        {/section}
               </td>
          </tr>
                    <tr>
               <td>{$LBL_STATE}&nbsp; :</td>
               <td>
                    {section name=i loop=$db_state}
                         {if $arr[0].vState eq $db_state[i].vStateCode}
                              {$db_state[i].vState}
                         {/if}
                   {/section}
               </td>
          </tr>

          <tr>
               <td>{$LBL_ZIP_CODE}&nbsp; :</td>
               <td>{$arr[0].vZipcode}</td>
          </tr>
          <tr>
               <td>{$LBL_PHONE}&nbsp; :</td>
               <td>{$arr[0].vPhone}</td>
          </tr>
          <tr>
               <td>{$LBL_EMAIL}&nbsp; :</td>
               <td>{$arr[0].vEmail}</td>
          </tr>
          <tr>
               <td>{$LBL_WEB_SITE} :</td>
               <td>{$arr[0].vWebSite}</td>
          </tr>
          <tr>
               <td>{$LBL_ORG_TYPE}&nbsp; :</td>
               <td>{$arr[0].eOrganizationType}</td>
          </tr>
          <tr>
               <td>{$LBL_PRIME_CONTACT_NO} :</td>
               <td>{$arr[0].vPrimaryContactNo}</td>
          </tr>
          <tr>
               <td>{$LBL_PRIME_CONTACT_EMAIL} :</td>
               <td>{$arr[0].vPrimaryContactEmail}</td>
          </tr>
          <tr>
               <td>{$LBL_PRIME_CONTACT_TELE} :</td>
               <td>{$arr[0].vPrimaryContactTelephone}</td>
          </tr>
          <tr>
               <td>{$LBL_PRIME_CONTACT_MOB} :</td>
               <td>{$arr[0].vPrimaryContactMobile}</td>
          </tr>
          <tr>
               <td>{$LBL_VAT_ID} : </td>
               <td>{$arr[0].vVatId}</td>
          </tr>
          <tr>
               <td>{$LBL_BANK} : </td>
               <td>{$arr[0].vBankName}</td>
          </tr>
          <tr>
               <td>{$LBL_BANK_CODE} : </td>
               <td>{$arr[0].vBankCode}</td>
          </tr>
          <tr>
               <td>{$LBL_BRANCH} : </td>
               <td>{$arr[0].vBranchName}</td>
          </tr>
          <tr>
               <td>{$LBL_BRANCH_CODE} : </td>
               <td>{$arr[0].vBranchCode}</td>
          </tr>
          <tr>
               <td>Account1 Number : </td>
               <td>{$arr[0].vAccount1Number}</td>
          </tr>
             <tr>
               <td>Account1 Title : </td>
               <td>{$arr[0].vAccount1Title}</td>
          </tr>
          <tr>
               <td>Account1 Currency :</td>
               <td>{$arr[0].vAccount1Currency}</td>
          </tr>
          <tr>
               <td>Account2 Number :</td>
               <td>{$arr[0].vAccount2Number}</td>
          </tr>
          <tr>
               <td>Account2 Title :</td>
               <td>{$arr[0].vAccount2Title}</td>
          </tr>
          <tr>
               <td>Account2 Currency :</td>
               <td>{$arr[0].vAccount2Currency}</td>
          </tr>
          <tr>
               <td valign="top">&nbsp;</td>
          </tr>
     </table>
   </div>
   <div>&nbsp;</div>
   </div>
   </div>
   </div>