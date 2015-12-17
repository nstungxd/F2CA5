<div class="middle-container">
<h1>
          Edit Profile Organization Admin
</h1>

<div class="middle-containt">
   <div class="statistics-main-box-white">
        {if $sess_usertype neq 'orgadmin'}
      <div>
         <ul id="inner-tab">
			   <li><a class="{if $file eq 'u-organizationuserview'}current{/if}"><EM>{$LBL_ORG_USER}</EM></a></li>
				<li><a href="{$SITE_URL_DUM}userrights/{$userData.iUserID}" class="{if $file eq 'u-userrights'}current{/if}"><EM>{$LBL_ORG_USER_ACCESS_RIGHTS}</EM></a></li>
         </ul>
      </div>
        {/if}
      <div class="clear"></div>
      <div class="inner-gray-bg" {$style}>
           {if $msg neq '' && $OuserData.eStatus neq 'Active' && $OuserData.eStatus neq 'Inactive'}
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
               {/if}
         <div>&nbsp;</div>
         <div>
              <form name="frmadd" id="frmadd" action="{$SITE_URL}index.php?file=u-createorganizationuser_a" method="post">
               <input type="hidden" name="iUserID" id="iUserID" value="{$iUserID}" />
               <input type="hidden" name="view" id="view" value="{$view}" />
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
                  <td>{$LBL_USER_NAME}  </td>
                  <td>:</td>
                  <td>{$userData.vUserName}</td>
               </tr>
               {*if $sess_usertype neq 'orguser'*}
               {*}<tr>
                  <td>{$LBL_PASSWORD}  </td>
                  <td>:</td>
                  <td>{$generalobj->decrypt($userData.vPassword)}</td>
               </tr>{*}
               {*/if*}
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

               {*if $sess_usertype neq 'orguser'*}
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
               {*/if*}
                <tr>
                  <td>{$LBL_SEC_QUESTION}1ID</td>
                  <td>:</td>
                  <td>{$secQuestion1}
               </tr>
               <tr>
                  <td>{$LBL_ANSWER}</td>
                  <td>:</td>
                  <td>{$userData.vAnswer}</td>
               </tr>
               <tr>
                  <td>{$LBL_SEC_QUESTION}2ID </td>
                  <td>:</td>
                  <td>
                    {$secQuestion2}
                  </td>
               </tr>
               <tr>
                  <td>{$LBL_ANSWER} </td>
                  <td>:</td>
                  <td>{$userData.vAnwser}</td>
               </tr>

               <tr>
                  <td>{ $LBL_ONLINE_EMAIL_NOTIFICATION}  </td>
                  <td>:</td>
                  <td>{if $userData.eEmailNotification eq ''}
                       No
                      {else}
                       {$userData.eEmailNotification}
                      {/if}</td>
               </tr>
                <tr>
                  <td>{$LBL_DEFAULT_LANGUAGE}  </td>
                  <td>:</td>
                  <td>{$defaltLan}</td>
               </tr>

               <tr>
                  <td colspan="2" height="5"></td>
               </tr>
               <tr>
                 <td valign="top">&nbsp;</td>
                 <td colspan="2">
							<img src="{$SITE_IMAGES}sm_images/btn-back.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="history.back();" />
							{if $verify eq 'yes'}
								<img src="{$SITE_IMAGES}sm_images/btn-verify.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('verify');$('#frmadd').submit();" />
                      <img src="{$SITE_IMAGES}sm_images/btn-reject.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('reject');$('#frmadd').submit();" />
							{/if}
                 </td>
                 <td valign="top" align="right">&nbsp;
                      {if $OuserData.eStatus eq 'Modified'}
                         <a class="colorbox" href="{$SITE_URL_DUM}index.php?file=u-aj_useroverview&id={$OuserData.iUserID}" onmouseover="CallColoerBox(this.href,600,500,'file');">Click Here to view Original</a>
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
</div>
