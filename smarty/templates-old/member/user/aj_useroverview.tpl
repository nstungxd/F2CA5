<div class="middle-containt">
   <div class="statistics-main-box-white">
      <div class="clear"></div>
      <div class="inner-gray-bg">
         <div>&nbsp;</div>
         <div>
              <form name="frmadd" id="frmadd" action="{$SITE_URL}index.php?file=u-createorganizationuser_a" method="post">
               <input type="hidden" name="iUserID" id="iUserID"value="{$iUserID}" />
               <input type="hidden" name="view" id="view"value="{$view}" />
               <table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
               <tr>
                  <td width="140">{$LBL_USER_TYPE}&nbsp;</td>
                  <td>:</td>
                  <td>{$userData.eUserType}</td>
               </tr>
               <tr>
                  <td width="140">{$LBL_FIRST_NAME}&nbsp;</td>
                  <td>:</td>
                  <td>{$userData.vFirstName}</td>
               </tr>
               <tr>
                  <td>{$LBL_LAST_NAME}&nbsp; </td>
                  <td>:</td>
                  <td>{$userData.vLastName}</td>
               </tr>
               <tr>
                  <td>Salutation </td>
                 <td>:</td>
                  <td>{$userData.eSalutation}</td>
               </tr>
               <tr>
                  <td>{$LBL_ORGANIZATION}&nbsp; </td>
                  <td>:</td>
                  <td>{$organization[0].vCompanyName}({$organization[0].vOrganizationCode})
                  </td>
               </tr>
               <tr>
                  <td>{$LBL_COMP_CODE}  </td>
                  <td>:</td>
                  <td>{$organization[0].vCompCode}</td>
               </tr>
               <tr>
                  <td>{$LBL_USER_NAME}  </td>
                  <td>:</td>
                  <td>{$userData.vUserName}</td>
               </tr>
               {if $sess_usertype neq 'orguser'}
               <tr>
                  <td>{$LBL_PASSWORD}  </td>
                  <td>:</td>
                  <td>{$generalobj->decrypt($userData.vPassword)}</td>
               </tr>
               {/if}
               <tr>
                  <td> {$LBL_ADDR_LINE} 1&nbsp; </td>
                  <td>:</td>
                  <td>{$userData.vAddressLine1}</td>
               </tr>
               <tr>
                  <td>{$LBL_ADDR_LINE} 2 </td>
                  <td>:</td>
                  <td>{$userData.vAddressLine2}</td>
               </tr>
               <tr>
                  <td> {$LBL_ADDR_LINE} 3 </td>
                  <td>:</td>
                  <td>{$userData.vAddressLine3}</td>
               </tr>
               <tr>
                    <td>{$LBL_COUNTRY}&nbsp;</td>
                    <td>:</td>
                    <td>
                             {section name=i loop=$db_country}
                                   {if $userData.vCountry eq $db_country[i].vCountryCode}
                                        {$db_country[i].vCountry}
                                   {/if}
                             {/section}
                    </td>
               </tr>
               <tr>
                    <td>{$LBL_STATE}&nbsp; </td>
                    <td>:</td>
                    <td>
                         <input type="hidden" name="selstate" id="selstate" value="{$userData.vState}">
                        {section name=i loop=$db_state}
                              {if $userData.vState eq $db_state[i].vStateCode}
                                   {$db_state[i].vState}
                              {/if}
                        {/section}
                    </td>
               </tr>

               <tr>
                  <td>{$LBL_CITY}&nbsp; </td>
                  <td>:</td>
                  <td>{$userData.vCity}</td>
               </tr>
               <tr>
                  <td>{$LBL_ZIP_CODE}&nbsp; </td>
                  <td>:</td>
                  <td>{$userData.vZipCode}</td>
               </tr>
               <tr>
                  <td>{$LBL_PHONE} </td>
                  <td>:</td>
                  <td>{$userData.vPhone}</td>
               </tr>
               <tr>
                  <td>{$LBL_EXTENTION} </td>
                  <td>:</td>
                  <td>{$userData.vExtention}</td>
               </tr>
               <tr>
                  <td>{$LBL_MOBILE} </td>
                  <td>:</td>
                  <td>{$userData.vMobile}</td>
               </tr>
               <tr>
                  <td>{$LBL_EMAIL}&nbsp; </td>
                  <td>:</td>
                  <td>{$userData.vEmail}</td>
               </tr>

               {if $sess_usertype neq 'orguser'}
               <tr>
                  <td>{$LBL_PER_TYPE}  </td>
                  <td>:</td>
                  <td>{$userData.ePermissionType}</td>
               </tr>
               {if $userData.ePermissionType eq 'Group'}
               <tr>
                  <td>{ $LBL_GROUP_ID}  </td>
                  <td>:</td>
                  <td>{$userData.iGroupID}</td>
               </tr>
               {/if}
               {/if}
                <tr>
                  <td>{$LBL_SEC_QUESTION}1</td>
                  <td>:</td>
                  <td>{$secQuestion1}
               </tr>
               <tr>
                  <td>{$LBL_ANSWER}</td>
                  <td>:</td>
                  <td>{if $userData.vAnswer neq ''}#####{else}---{/if}</td>
               </tr>
               <tr>
                  <td>{$LBL_SEC_QUESTION}2 </td>
                  <td>:</td>
                  <td>
                     {if $secQuestion2 neq ''}{$secQuestion2}{else}---{/if}
                  </td>
               </tr>
               <tr>
                  <td>{$LBL_ANSWER} </td>
                  <td>:</td>
                  <td>{if $userData.vAnwser neq ''}#####{else}---{/if}</td>
               </tr>
               <tr>
                  <td>{ $LBL_ONLINE_EMAIL_NOTIFICATION}  </td>
                  <td>:</td>
                  <td>
                     {if $userData.eEmailNotification eq ''}
                        No
                     {else}
                        {$userData.eEmailNotification}
                     {/if}
                  </td>
               </tr>
                <tr>
                  <td>{$LBL_DEFAULT_LANGUAGE}  </td>
                  <td>:</td>
                  <td>{$defaltLan}</td>
               </tr>
               <tr>
                 <td valign="top">&nbsp;</td>
               </tr>
            </table>
              </form>
         </div>
         <div>&nbsp;</div>
      </div>
   </div>
</div>
