<div class="middle-container">
<h1>{$LBL_USER_PROFILE}
     {*if $sess_usertype neq 'orguser'}
           Create User
     {else}
          Edit Profile User
          {assign var="style" value="style='margin-top:0px'"}
     {/if*}
</h1>

<div class="middle-containt">
   <div class="statistics-main-box-white">
        {if $sess_usertype neq 'orguser'}
      <div>
         <ul id="inner-tab">
			   <li><a class="{if $file eq 'u-organizationuserview'}current{/if}"><EM>{$LBL_ORG_USER}</EM></a></li>
				{if $OuserData.eUserType eq 'User'}
				<li><a href="{$SITE_URL_DUM}userrights/{$userData.iUserID}" class="{if $file eq 'u-userrights'}current{/if}"><EM>{$LBL_ORG_USER_ACCESS_RIGHTS}</EM></a></li>
				{/if}
         </ul>
      </div>
        {/if}
      <div class="clear"></div>
      <div class="inner-gray-bg" {$style}>
           {if $msg neq '' && (($OuserData.eStatus neq 'Active' && $OuserData.eStatus neq 'Inactive') || $udts.eNeedToVerify eq 'Yes')}
                    <div class="msg">{$msg}</div>
               {/if}
         <div>&nbsp;</div>
			<div><span style="float:right;"><b><a class="" href="javascript:openpopup('{$SITE_URL_DUM}orguserviewhistory/{$userData.iUserID}');" >{$LBL_VIEW_HISTORY}</a></b></span></div>
         <div>
              <form name="frmadd" id="frmadd" action="{$SITE_URL}index.php?file=u-createorganizationuser_a" method="post">
               <input type="hidden" name="iUserID" id="iUserID" value="{$iUserID}" />
               <input type="hidden" name="view" id="view" value="{$view}" />
               <table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="">
               <tr>
                  <td width="190px">{$LBL_USER_TYPE}&nbsp;</td>
                  <td width="1px">:</td>
                  <td >{$userData.eUserType}</td>
               </tr>
               <tr>
                  <td width="190px">{$LBL_FIRST_NAME}&nbsp;</td>
                  <td width="1px">:</td>
                  <td>{$userData.vFirstName}</td>
               </tr>
               <tr>
                  <td width="190px">{$LBL_LAST_NAME}&nbsp; </td>
                  <td width="1px">:</td>
                  <td>{$userData.vLastName}</td>
               </tr>
               <tr>
                  <td width="190px">Salutation </td>
                 <td width="1px">:</td>
                  <td>{$userData.eSalutation}</td>
               </tr>
               <tr>
                  <td width="190px">{$LBL_ORGANIZATION}&nbsp; </td>
                  <td width="1px">:</td>
                  <td>{$organization[0].vCompanyName}({$organization[0].vOrganizationCode})
                  </td>
               </tr>
               <tr>
                  <td width="190px">{$LBL_COMP_CODE}  </td>
                  <td width="1px">:</td>
                  <td>{$organization[0].vCompCode}</td>
               </tr>
               <tr>
                  <td width="190px">{$LBL_USER_NAME}  </td>
                  <td width="1px">:</td>
                  <td>{$userData.vUserName}</td>
               </tr>
               {if $sess_usertype neq 'orguser'}
               <tr>
                  <td width="190px">{$LBL_PASSWORD}  </td>
                  <td width="1px">:</td>
                  <td>{if $userData.vPassword neq ''}#####{else}---{/if}</td>
               </tr>
               {/if}
               <tr>
                  <td width="190px"> {$LBL_ADDR_LINE} 1&nbsp; </td>
                  <td width="1px">:</td>
                  <td>{$userData.vAddressLine1}</td>
               </tr>
               <tr>
                  <td width="190px">{$LBL_ADDR_LINE} 2 </td>
                  <td width="1px">:</td>
                  <td>{$userData.vAddressLine2}</td>
               </tr>
               <tr>
                  <td width="190px"> {$LBL_ADDR_LINE} 3 </td>
                  <td width="1px">:</td>
                  <td>{$userData.vAddressLine3}</td>
               </tr>
               <tr>
                    <td width="190px">{$LBL_COUNTRY}&nbsp;</td>
                    <td width="1px">:</td>
                    <td>
                             {section name=i loop=$db_country}
                                   {if $userData.vCountry eq $db_country[i].vCountryCode}
                                        {$db_country[i].vCountry}
                                   {/if}
                             {/section}
                    </td>
               </tr>
               <tr>
                    <td width="190px">{$LBL_STATE}&nbsp; </td>
                    <td width="1px">:</td>
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
                  <td width="190px">{$LBL_CITY}&nbsp; </td>
                  <td width="1px">:</td>
                  <td>{$userData.vCity}</td>
               </tr>
               <tr>
                  <td width="190px">{$LBL_ZIP_CODE}&nbsp; </td>
                  <td width="1px">:</td>
                  <td>{$userData.vZipCode}</td>
               </tr>
               <tr>
                  <td width="190px">{$LBL_PHONE} </td>
                  <td width="1px">:</td>
                  <td>{$userData.vPhone}</td>
               </tr>
               <tr>
                  <td width="190px">{$LBL_EXTENTION} </td>
                  <td width="1px">:</td>
                  <td>{$userData.vExtention}</td>
               </tr>
               <tr>
                  <td width="190px">{$LBL_MOBILE} </td>
                  <td width="1px">:</td>
                  <td>{$userData.vMobile}</td>
               </tr>
               <tr>
                  <td width="190px">{$LBL_EMAIL}&nbsp; </td>
                  <td width="1px">:</td>
                  <td>{$userData.vEmail}</td>
               </tr>

               {if $sess_usertype neq 'orguser'}
               <tr>
                  <td width="190px">{$LBL_PER_TYPE}  </td>
                  <td width="1px">:</td>
                  <td>{$userData.ePermissionType}</td>
               </tr>
               {if $userData.ePermissionType eq 'Group'}
               <tr>
                  <td width="190px">{$LBL_GROUP}  </td>
                  <td width="1px">:</td>
                  <td>{$userData.vGroupName}</td>
               </tr>
               {/if}
               {/if}
                <tr>
                  <td width="190px">{$LBL_SEC_QUESTION}1</td>
                  <td width="1px">:</td>
                  <td>{$secQuestion1}
               </tr>
               <tr>
                  <td width="190px">{$LBL_ANSWER}</td>
                  <td width="1px">:</td>
                  <td>{if $userData.vAnswer neq ''}#####{else}---{/if}</td>
               </tr>
					{if $userData.iSecretQuestion2ID gt 0}
               <tr>
                  <td width="190px">{$LBL_SEC_QUESTION}2 </td>
                  <td width="1px">:</td>
                  <td>{$secQuestion2}</td>
               </tr>
               <tr>
                  <td width="190px">{$LBL_ANSWER} </td>
                  <td width="1px">:</td>
                  <td>{if $userData.vAnwser neq ''}#####{else}---{/if}</td>
               </tr>
					{/if}
               <tr>
                  <td width="190px">{$LBL_ONLINE_EMAIL_NOTIFICATION}  </td>
                  <td width="1px">:</td>
                  <td>{$userData.eEmailNotification}</td>
               </tr>
                <tr>
                  <td width="190px">{$LBL_DEFAULT_LANGUAGE}  </td>
                  <td width="1px">:</td>
                  <td>{$defaltLan}</td>
               </tr>
					{if $verify eq 'yes'}
					<tr>
					  <td valign="top" width="190px">{$LBL_REASON_TO_REJECT} </td>
					  <td valign="top" width="1px">:</td>
					  <td><textarea id="tReasonToReject" name="tReasonToReject" cols="70" rows="3"></textarea></td>
					</tr>
					{/if}
					{if $vusrdt[0].iRejectedById gt 0 && $vusrdt[0].tReasonToReject|trim neq ''}
					<tr>
					  <td valign="top" width="190px">{$LBL_REASON_TO_REJECT} </td>
					  <td valign="top" width="1px">:</td>
					  <td><div style="background:#fafafa; border:1px solid #cccccc; height:30px; width:390px; overflow-y:scroll;">{$vusrdt[0].tReasonToReject|trim}</div></td>
					</tr>
					{/if}
               <tr>
                  <td colspan="3" height="5">&nbsp;</td>
               </tr>
               <tr>
                 <td valign="top" colspan="3" align="center">&nbsp;
							<img src="{$SITE_IMAGES}sm_images/btn-back.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" {if $verify eq 'yes'}onclick="location.href='{$SITE_URL_DUM}verifyorganizationuserlist'"{else}onclick="location.href='{$SITE_URL_DUM}organizationuserlist'"{/if} />
							{if $verify eq 'yes' || $usrvrfy eq 'yes'}
                         <img src="{$SITE_IMAGES}sm_images/btn-verify.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('verify');$('#frmadd').submit();" />
                         <img src="{$SITE_IMAGES}sm_images/btn-reject.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('reject');$('#frmadd').submit();" />
							{/if}
						  <span style="float:right;">
						  &nbsp;
                      {if $OuserData.eStatus eq 'Modified'}
                         <a class="colorbox" href="{$SITE_URL_DUM}index.php?file=u-aj_useroverview&id={$OuserData.iUserID}" onmouseover="CallColoerBox(this.href,600,500,'file');">Click Here to view Original</a>
                      {/if}
						  </span>
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
