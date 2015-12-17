<form name="frmassignright" id="frmassignright" action="{$SITE_URL}index.php?file=u-assignrights_a" method="post">
<input type="hidden" name="iPermissionID" id="iPermissionID"value="{$ures[0].iPermissionID}" />
<input type="hidden" name="view" id="view" value="{$view}" />
<div class="middle-container" >
     <h1>{$LBL_ASSIGN_RIGHTS_USER}</h1>
     <div class="middle-containt">
          <div class="statistics-main-box-white" >
               <div>
                  <ul id="inner-tab">
                  <li><a href="{$SITE_URL_DUM}organizationuserview/{$iUserID}" class="{if $file eq 'u-organizationuserview'}current{/if}"><EM>{$LBL_ORG_USER}</EM></a></li>
     				   <li><a class="{if $file eq 'u-userrights'}current{/if}"><EM>{$LBL_ORG_USER_ACCESS_RIGHTS}</EM></a></li>
                  </ul>
               </div>
               <div class="clear"></div>
					<div class="inner-gray-bg">
                    {if $msg neq '' && $userdata.eStatus neq 'Active' && $userdata.eStatus neq 'Inactive'}
                         <div class="msg">{$msg}</div>
                    {/if}
                    <div>&nbsp;</div>
						  <div><span style="float:right;"><b><a class="colorbox" href="javascript:openpopup('{$SITE_URL_DUM}urightsviewhistory/{$iUserID}');">{$LBL_VIEW_HISTORY}</a></b></span></div>
                    <div>
								<table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
									<tr>
									<td width="130" valign="top">{$LBL_ORGANIZATION}&nbsp; </td>
										<td width="5">:</td>
										<td>
										<table width="228" border="0" cellspacing="0" cellpadding="0">
										  <tr>
											 <td height="20">
                                        {$orgname}
											 </td>
										  </tr>
										</table>
									</td>
									</tr>
										<tr>
                                   <td width="130" valign="top">{$LBL_USER} </td>
                                   <td>:</td>
                                   <td>
                                        <table width="228" border="0" cellspacing="0" cellpadding="0">
                                             <tr>
                                                  <!-- class="securitymanager-white-bg" -->
                                                  <td height="20">
                                                       {$userdata[0].vFirstName} {$userdata[0].vLastName}
                                                  </td>
                                             </tr>
                                        </table>
                                   </td>
                              </tr>
                              <tr>
                                   <td colspan="2" valign="top"><img src="{$SITE_IMAGES}sm_images/spacer.gif" width="1" height="1" alt="" border="0" /></td>
                              </tr>
                              <tr>
                                <td width="130" valign="top"><u><b>{$LBL_ASSIGN_RIGHT_USER}</b></u>&nbsp; </td>
                                <td >&nbsp;</td>
										  <td colspan="2">&nbsp;</td>
										</tr>
                              {if $userdata[0].ePermissionType neq 'Group'}
                              {if $orgdata[0].eOrganizationType neq 'Buyer2'}
										{if $orgdata[0].eOrganizationType neq 'Supplier'}
										<tr>
											  <td>&nbsp;</td></br>
											  <td valign="top" colspan="3"><b><u>{$LBL_BUYER_RIGHTS}</u>:</b></td>
										</tr>
										<tr>
											  <td colspan="2">&nbsp;</td>
											  <td valign="top" colspan="2"><b>{$LBL_PO_CREATION}:</b>
												  <span style="padding:50px;">
													 <label style="display:inline-block; width:170px;"><b>{$LBL_FREE_FORM_CREATION}: </b>{if $ecreate.po eq 'Yes'}{$ecreate.po}{else}{$LBL_NO}{/if}</label>
													 <label style="display:inline-block; width:110px;"><b>{$LBL_IMPORT}: </b>{if $eimport.po eq 'Yes'}{$eimport.po}{else}{$LBL_NO}{/if}</label>
													 <label style="display:inline-block; width:100px;"><b>{$LBL_VERIFY}: </b>{if $everify.po eq 'Yes'}{$LBL_YES}{else}{$LBL_NO}{/if}</label>
											     <span>
											  </td>
										</tr>
										<tr>
											  <td colspan="2">&nbsp;</td>
											  <td  width="300">
												  {*if $poUserStatus|@count > 0 && $poUserStatus|is_array*}
                                      <b>{$LBL_ORDER_STATUS_LEVEL}</b>
												  {*/if*}
                                  </td>
											 <td width="300">
											  {*if $invUserAcpt|@count > 0 && $invUserAcpt|is_array*}
                                      <b>{$LBL_INV_ACPT_LEVEL}</b>
											  {*/if*}
                                  </td>
                              </tr>
                               <tr>
                                    <td width="130" valign="top">&nbsp;</td>
                                    <td></td>
                                    <td width="300" valign="top">
													{if $poUserStatus|@count > 0 && $poUserStatus|is_array}
													{assign var="po_count" value=$poUserStatus|@count}
													{assign var='cm' value='n'}
													{section name=i loop=$status}
														{if $status[i].Id|in_array:$poUserStatus && $status[i].eType eq 'Optional' && $status[i].status neq 'Create' && $status[i].status neq 'Accepted' && $status[i].status neq 'Verify'}
														{if $cm eq 'y'},{/if}
														 {$status[i].title}
														 {assign var='cm' value='y'}
														 {*if $status[i.index_next].Id|in_array:$poUserStatus},{/if*}
														{/if}
													{/section}
													{/if}
													{if $cm neq 'y'}
													{$LBL_NO_PO_ISSUANCE_RIGTS}
													{/if}
                                   </td>
												<td valign="top" width="300">
													 {if $invUserAcpt|@count > 0 && $invUserAcpt|is_array}
													{assign var="inv_count" value=$invUserAcpt|@count}
													{assign var='cm' value='n'}
													{if $invapt[0].Id|in_array:$invUserAcpt}
													   {*$invapt[0].title*}{$LBL_ACCEPT}
													   {assign var='cm' value='y'}
													{/if}
													{section name=i loop=$status}
													  {if $status[i].Id|in_array:$invUserAcpt && $status[i].eType eq 'Optional' && $status[i].status neq 'Create' && $status[i].status neq 'Issued' && $status[i].status neq 'Accepted' && $status[i].status neq 'Verify'}
															{if $cm eq 'y'},{/if}
														 {$status[i].title}{*if $status[i.index_next].Id neq $invUserStatus[$inv_count]},{/if*}
														 {*if $status[i.index_next].Id|in_array:$invUserStatus},{/if*}
														 {assign var='cm' value='y'}
													  {/if}
													{/section}
													{/if}
													{if $cm neq 'y'}
													{$LBL_NO_INVOICE_ACCEPTANCE_RIGHTS}
													{/if}
                                   </td>
                              </tr>
										 <tr>
											  <td>&nbsp;</td>
											  <td colspan="3" style="padding-left:9px;"><b>{$LBL_INVOICE_FROM_PO_SUPPLIER_ONBEHALF|stripslashes} : </b> {if $vures[0].eInvFPO eq 'Yes'} {$vures[0].eInvFPO} {else} {$LBL_NO} {/if} </td>
										 </tr>
										 {/if}
										<tr><td colspan="4">&nbsp;</td></tr>
										{if $orgdata[0].eOrganizationType neq 'Buyer'}
										<tr>
											  <td>&nbsp;</td>
											  <td valign="top" colspan="3"><b><u>{$LBL_SUPPLIER_RIGHTS}</u>:</b></td>
										</tr>
										<tr>
											  <td colspan="2">&nbsp;</td>
											  <td valign="top" colspan="2"><b>{$LBL_INV_CREATION}:</b>
												  <span style="padding:25px;">
													 <label style="display:inline-block; width:170px;"><b>{$LBL_FREE_FORM_CREATION}: </b>{if $ecreate.inv eq 'Yes'}{$ecreate.inv}{else}{$LBL_NO}{/if}</label>
													 <label style="display:inline-block; width:110px;"><b>{$LBL_IMPORT}: </b>{if $eimport.inv eq 'Yes'}{$eimport.inv}{else}{$LBL_NO}{/if}</label>
													 <label style="display:inline-block; width:100px;"><b>{$LBL_VERIFY}: </b>{if $everify.inv eq 'Yes'}{$LBL_YES}{else}{$LBL_NO}{/if}</label>
											     <span>
											  </td>
										</tr>
										<tr>
                                <td width="130" valign="top"> &nbsp; </td>
                                <td >&nbsp;</td>
                                  <td  width="300">
											  {*if $invUserStatus|@count > 0 && $invUserStatus|is_array*}
                                      <b>{$LBL_INV_STATUS_LEVEL}</b>
											  {*/if*}
                                  </td>
                                  <td width="300">
											  {*if $poUserAcpt|@count > 0 && $poUserAcpt|is_array*}
                                      <b>{$LBL_ORDER_ACPT_LEVEL}</b>
											  {*/if*}
                                  </td>
                              </tr>
										 <tr>
                                    <td width="130" valign="top">&nbsp;</td>
                                    <td></td>
                                    <td width="300" valign="top">
													{if $invUserStatus|@count > 0 && $invUserStatus|is_array}
													{assign var="inv_count" value=$invUserStatus|@count}
													{assign var='cm' value='n'}
													{section name=i loop=$status}
													  {if $status[i].Id|in_array:$invUserStatus && $status[i].eType eq 'Optional' && $status[i].status neq 'Create' && $status[i].status neq 'Accepted' && $status[i].status neq 'Verify'}
															{if $cm eq 'y'},{/if}
														 {$status[i].title}{*if $status[i.index_next].Id neq $invUserStatus[$inv_count]},{/if*}
														 {*if $status[i.index_next].Id|in_array:$invUserStatus},{/if*}
														 {assign var='cm' value='y'}
													  {/if}
													{/section}
													{/if}
													{if $cm neq 'y'}
													{$LBL_NO_INVOICE_ISSUANCE_RIGTS}
													{/if}
                                   </td>
                                   <td valign="top" width="300">
													{if $poUserAcpt|@count > 0 && $poUserAcpt|is_array}
													{assign var="inv_count" value=$poUserAcpt|@count}
													{assign var='cm' value='n'}
													{if $poapt[0].Id|in_array:$poUserAcpt}
													   {*$poapt[0].title*}{$LBL_ACCEPT}
													   {assign var='cm' value='y'}
													{/if}
													{section name=i loop=$status}
													  {if $status[i].Id|in_array:$poUserAcpt && $status[i].eType eq 'Optional' && $status[i].status neq 'Create' && $status[i].status neq 'Issued' && $status[i].status neq 'Accepted' && $status[i].status neq 'Verify'}
															{if $cm eq 'y'},{/if}
														 {$status[i].title}{*if $status[i.index_next].Id neq $invUserStatus[$inv_count]},{/if*}
														 {*if $status[i.index_next].Id|in_array:$invUserStatus},{/if*}
														 {assign var='cm' value='y'}
													  {/if}
													{/section}
													{/if}
													{if $cm neq 'y'}
													{$LBL_NO_PO_ACCEPTANCE_RIGTS}
													{/if}
                                   </td>
                              </tr>
										{/if}
										{if $ENABLE_AUCTION eq 'Yes'}
										<tr><td colspan="2">&nbsp;</td></tr>
                              <tr>
										  <td>&nbsp;</td>
										  <td valign="top" colspan="3">
                                <span style="display:inline-block; width:130px;"><b><u>{$LBL_RFQ2_RIGHTS}</u>:</b></span>
                                <span style="display:inline-block; width:100px;">{$LBL_CREATE}: {if $crfq2awrdsts|in_array:$rfq2s}{$LBL_YES}{else}{$LBL_NO}{/if}</span>
										  {if $ores[0].eRFQ2VerifyReq eq 'Yes'}
                                <span style="display:inline-block; width:100px;">{$LBL_VERIFY}: {if $vrfq2awrdsts|in_array:$rfq2s}{$LBL_YES}{else}{$LBL_NO}{/if}</span>
										  {/if}
                                <br /> <br />
                                </td>
									   </tr>
                              <tr>
											  <td>&nbsp;</td>
											  <td valign="top" colspan="3">
                                   <span style="display:inline-block; width:130px;"><b><u>{$LBL_RFQ2_AWARD_RIGHTS}</u>:</b></span>
                                   {assign var="an" value="n"}
                                   {section name="l" loop=$rfq2awrdsts}
                                       {if $rfq2awrdsts[l].iStatusID|in_array:$rfq2awrd}
                                          {if $an eq 'y'},{/if} {$rfq2awrdsts[l].vStatus}
                                          {assign var="an" value="y"}
                                       {/if}
                                   {/section}
                                   <br /> <br />
                                   </td>
										</tr>
										{/if}
                              {elseif $orgdata[0].eOrganizationType eq 'Buyer2'}
                                 <tr>
											  <td>&nbsp;</td>
											  <td valign="top" colspan="3">
                                   <span style="display:inline-block; width:170px;"><b><u>{$LBL_BID_RIGHTS}</u>:</b></span>
                                   <span style="display:inline-block; width:100px;">{$LBL_CREATE}: {if $crfq2awrdsts|in_array:$rfq2bid}{$LBL_YES}{else}{$LBL_NO}{/if}</span>
											  {if $ores[0].eRFQ2BidVerifyReq eq 'Yes'}
                                   <span style="display:inline-block; width:100px;">{$LBL_VERIFY}: {if $vrfq2awrdsts|in_array:$rfq2bid}{$LBL_YES}{else}{$LBL_NO}{/if}</span>
											  {/if}
                                   <br /> <br />
                                   </td>
										   </tr>
                                 <tr>
											  <td>&nbsp;</td>
											  <td valign="top" colspan="3">
                                   <span style="display:inline-block; width:170px;"><b><u>{$LBL_AWARD_ACCEPTANCE_RIGHTS}</u>:</b></span>
											  {assign var="an" value="n"}
											  {if $rfq2awrdacpt|is_array && $arfq2awrdsts[0].iStatusID|in_array:$rfq2awrdacpt}
													 {$LBL_ACCEPT}
													 {assign var="an" value="y"}
											  {/if}
                                   {section name="l" loop=$rfq2awrdacptsts}
                                       {if $rfq2awrdacptsts[l].iStatusID|in_array:$rfq2awrdacpt && $rfq2awrdacptsts[l].vStatus_en neq 'Accepted'}
                                          {if $an eq 'y'},{/if} {$rfq2awrdacptsts[l].vStatus}
                                          {assign var="an" value="y"}
                                       {/if}
                                   {/section}
                                   <br /> <br />
                                   </td>
										   </tr>
                              {/if}
										{else}
										<tr>
											  <td>&nbsp;</td>
											  <td colspan="3">
											  <div>{$LBL_USER_PERMISSION_TYPE_IS_GROUP}. {$LBL_CLICK} <a href="{$SITE_URL_DUM}groupview/{$userdata[0].iGroupID}" style="cursor:pointer;">{$LBL_HERE}</a> {$LBL_TO} {$LBL_VIEW_RIGHTS_OF_GROUP}.</div>
											  </td>
										</tr>
										{/if}
										<tr><td colspan="4">&nbsp;</td></tr>
										{if $verify eq 'yes'}
										<tr>
										  <td valign="top">{$LBL_REASON_TO_REJECT} </td>
										  <td valign="top">:</td>
										  <td colspan="2"><textarea id="tReasonToReject" name="tReasonToReject" cols="70" rows="3"></textarea></td>
										</tr>
										{/if}
										{if $vures[0].iRejectedById gt 0 && $vures[0].tReasonToReject|trim neq ''}
										<tr>
										  <td valign="top">{$LBL_REASON_TO_REJECT} </td>
										  <td valign="top">:</td>
										  <td colspan="2"><div style="background:#fafafa; border:1px solid #cccccc; height:30px; width:390px; overflow-y:scroll;">{$vures[0].tReasonToReject|trim}</div></td>
										</tr>
										{/if}
										<tr><td colspan="4">&nbsp;</td></tr>
                              <tr>
                                   <td valign="top">&nbsp;</td>
                                <td colspan="3">
											  <img src="{$SITE_IMAGES}sm_images/btn-back.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="history.back();" />
                                       {if $verify eq 'yes' || $usrvrfy eq 'yes'}
                                        <img src="{$SITE_IMAGES}sm_images/btn-verify.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('verify');$('#frmassignright').submit();" />
													 <img src="{$SITE_IMAGES}sm_images/btn-reject.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('reject');$('#frmassignright').submit();" />
                                       {/if}
                                  </td>
                              </tr>
                         </table>
                    </div>
                    <div>&nbsp;</div>
               </div>
          </div>
     </div>
</div>
</form>