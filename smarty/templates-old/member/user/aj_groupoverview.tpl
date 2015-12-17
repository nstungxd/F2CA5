<form name="frmcreategroup" id="frmcreategroup" action="{$SITE_URL}index.php?file=u-creategroup_a" method="POST">
<input type="hidden" name="iGroupID" id="iGroupID"value="{$iGroupID}" />
<input type="hidden" name="view" id="view"value="{$view}" />
       <div class="middle-containt">
       <div class="statistics-main-box-white">
      <div class="clear"></div><div class="inner-gray-bg">
            	<div>&nbsp;</div>
                <div>
                    <table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
                    <tr>
                      <td width="198" valign="top">{$LBL_ORGANIZATIONS}&nbsp; :</td>
                      <td>
                      <table width="228" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                              <!-- class="securitymanager-white-bg" -->
                            <td height="20">
                                {$orgdata[0].vCompanyName}
                            </td>
                          </tr>
                      </table>
							 </td>
                    </tr>
                    <tr>
                      <td valign="top">{$LBL_GROUP_NAME}&nbsp; :</td>
                      <td>{$grpData[0].vGroupName}</td>
                    </tr>
                    {*}<tr>
                      <td valign="top">{$LBL_USERS}&nbsp; :</td>
                      <td>
                           <div style="height: 50px;">
                           {section name=i loop=$userdata}
                           <div>{$userdata[i].vTitle}</div>
                           {/section}
                           </div>
                      </td>
                    </tr>{*}
                    {*}<tr>
                      <td valign="top">{$LBL_ASSIGN_RIGHTS}&nbsp; :</td>
                      <td  width="150">
                            {$LBL_ORDER_STATUS_LEVEL}
                      </td>
                      <td>
                          {$LBL_INV_STATUS_LEVEL}
                      </td>
                    </tr>
                    <tr>
                         <td valign="top">&nbsp;</td>
                           <td width="150">
												{section name=i loop=$status}
														{if $status[i].Id|in_array:$poUserStatus}
														{if $smarty.section.i.index gt 1},{/if}
															 {$status[i].title}
														{/if}
												{/section}
									</td>
									<td>
												{section name=i loop=$status}
													  {if $status[i].Id|in_array:$invUserStatus}
															 {if $smarty.section.i.index gt 1},{/if}
															 {$status[i].title}
													  {/if}
												{/section}
                           </td>
                    </tr>{*}
                    <tr><td colspan="3">&nbsp;</td></tr>
						  <tr>
                      <td valign="top"><b>{$LBL_ASSIGN_RIGHTS}&nbsp;</b></td>
							  <td colspan="2">&nbsp;</td>
							</tr>
                     {if $orgdata[0].eOrganizationType neq 'Buyer2'}
										{if $orgdata[0].eOrganizationType neq 'Supplier'}
										<tr>
											  <td>&nbsp;</td><br>
											  <td valign="top"><b><u>{$LBL_BUYER_RIGHTS}</u>:</b></td>
										</tr>
										<tr>
											  <td>&nbsp;</td>
											  <td valign="top" width="100%"><b>{$LBL_PO_CREATION}:</b>
												  <span style="padding:10px;">
													 <label style="display:inline-block; width:140px;"><b>{$LBL_FREE_FORM_CREATION}: </b>{if $ecreate.po eq 'Yes'}{$ecreate.po}{else}{$LBL_NO}{/if}</label>
													 <label style="display:inline-block; width:100px;"><b>{$LBL_IMPORT}: </b>{if $eimport.po eq 'Yes'}{$eimport.po}{else}{$LBL_NO}{/if}</label>
													 <label style="display:inline-block; width:100px;"><b>{$LBL_VERIFY}: </b>{if $everify.po eq 'Yes'}{$everify.po}{else}{$LBL_NO}{/if}</label>
											     <span>
											  </td>
										</tr>
										<tr>
												<td>&nbsp;</td>
											  <td width="100%">
												<table cellspacing="0" cellpadding="0" border="0" width="100%"><tr><td width="300px">
												  {if $poUserStatus|@count > 0 && $poUserStatus|is_array}
                                      <b>{$LBL_ORDER_STATUS_LEVEL}</b>
												  {/if}
												  </td>
												<td>
											  {if $invUserAcpt|@count > 0 && $invUserAcpt|is_array}
                                      <b>{$LBL_INV_ACPT_LEVEL}</b>
											  {/if}
											  </td></tr></table>
                                  </td>
                              </tr>
                               <tr>
											<td>&nbsp;</td>
                                 <td valign="top" width="100%">
												<table cellspacing="0" cellpadding="0" border="0" width="100%">
												<tr>
                                    <td valign="top" width="300px">
													{if $poUserStatus|@count > 0 && $poUserStatus|is_array}
													{assign var="po_count" value=$poUserStatus|@count}
													{assign var='cm' value='n'}
													{section name=i loop=$status}
														{if $status[i].Id|in_array:$poUserStatus && $status[i].eType eq 'Optional' && $status[i].status neq 'Create' && $status[i].status neq 'Accepted' && $status[i].status neq 'Verified'}
														{if $cm eq 'y'},{/if}
														 {$status[i].title}
														 {assign var='cm' value='y'}
														 {*if $status[i.index_next].Id|in_array:$poUserStatus},{/if*}
														{/if}
													{/section}
													{/if}
                                   </td>
												<td valign="top">
													 {if $invUserAcpt|@count > 0 && $invUserAcpt|is_array}
													{assign var="inv_count" value=$invUserAcpt|@count}
													{assign var='cm' value='n'}
													{section name=i loop=$status}
													  {if $status[i].Id|in_array:$invUserAcpt && $status[i].eType eq 'Optional' && $status[i].status neq 'Create' && $status[i].status neq 'Issued' && $status[i].status neq 'Verified'}
															{if $cm eq 'y'},{/if}
														 {$status[i].title}{*if $status[i.index_next].Id neq $invUserStatus[$inv_count]},{/if*}
														 {*if $status[i.index_next].Id|in_array:$invUserStatus},{/if*}
														 {assign var='cm' value='y'}
													  {/if}
													{/section}
													{/if}
                                   </td>
												</tr>
											</table>
											</td>
                              </tr>
										 <tr>
											  <td>&nbsp;</td>
											  <td colspan="3" style="padding-left:1px;"><b>{$LBL_INVOICE_FROM_PO_SUPPLIER_ONBEHALF} : </b> {if $grpData[0].eInvFPO eq 'Yes'} {$grpData[0].eInvFPO} {else} {$LBL_NO} {/if} </td>
										 </tr>
										 {/if}
										<tr><td colspan="2">&nbsp;</td></tr>
										{if $orgdata[0].eOrganizationType neq 'Buyer'}
										<tr>
											  <td>&nbsp;</td><br/>
											  <td valign="top" ><b><u>{$LBL_SUPPLIER_RIGHTS}</u>:</b></td>
										</tr>
										<tr>
											  <td >&nbsp;</td>
											  <td valign="top" ><b>{$LBL_INV_CREATION}:</b>
												  <span style="padding:10px;">
													 <label style="display:inline-block; width:140px;"><b>{$LBL_FREE_FORM_CREATION}: </b>{if $ecreate.inv eq 'Yes'}{$ecreate.inv}{else}{$LBL_NO}{/if}</label>
													 <label style="display:inline-block; width:100px;"><b>{$LBL_IMPORT}: </b>{if $eimport.inv eq 'Yes'}{$eimport.inv}{else}{$LBL_NO}{/if}</label>
													 <label style="display:inline-block; width:100px;"><b>{$LBL_VERIFY}: </b>{if $everify.inv eq 'Yes'}{$everify.inv}{else}{$LBL_NO}{/if}</label>
											     <span>
											  </td>
										</tr>
										<tr>
                                <td >&nbsp;</td>
                                  <td  width="100%">
												<table cellspacing="0" cellpadding="0" border="0" width="100%"><tr><td width="300px">
											  {if $invUserStatus|@count > 0 && $invUserStatus|is_array}
                                      <b>{$LBL_INV_STATUS_LEVEL}</b>
											  {/if}
											  </td>
												<td>
											  {if $poUserAcpt|@count > 0 && $poUserAcpt|is_array}
                                      <b>{$LBL_ORDER_ACPT_LEVEL}</b>
											  {/if}
											  </td></tr></table>
                                  </td>
                              </tr>
										 <tr>
                                    <td valign="top">&nbsp;</td>
                                    <td width="100%" valign="top">
												<table cellspacing="0" cellpadding="0" border="0" width="100%">
												<tr>
												<td valign="top" width="300px">
													{if $invUserStatus|@count > 0 && $invUserStatus|is_array}
													{assign var="inv_count" value=$invUserStatus|@count}
													{assign var='cm' value='n'}
													{section name=i loop=$status}
													  {if $status[i].Id|in_array:$invUserStatus && $status[i].eType eq 'Optional' && $status[i].status neq 'Create' && $status[i].status neq 'Accepted' && $status[i].status neq 'Verified'}
															{if $cm eq 'y'},{/if}
														 {$status[i].title}{*if $status[i.index_next].Id neq $invUserStatus[$inv_count]},{/if*}
														 {*if $status[i.index_next].Id|in_array:$invUserStatus},{/if*}
														 {assign var='cm' value='y'}
													  {/if}
													{/section}
													{/if}
                                   </td>
                                   <td valign="top">
													 {if $poUserAcpt|@count > 0 && $poUserAcpt|is_array}
													{assign var="inv_count" value=$poUserAcpt|@count}
													{assign var='cm' value='n'}
													{section name=i loop=$status}
													  {if $status[i].Id|in_array:$poUserAcpt && $status[i].eType eq 'Optional' && $status[i].status neq 'Create' && $status[i].status neq 'Issued' && $status[i].status neq 'Verified'}
															{if $cm eq 'y'},{/if}
														 {$status[i].title}{*if $status[i.index_next].Id neq $invUserStatus[$inv_count]},{/if*}
														 {*if $status[i.index_next].Id|in_array:$invUserStatus},{/if*}
														 {assign var='cm' value='y'}
													  {/if}
													{/section}
													{/if}
                                   </td>
											  </tr>
											  </table>
									        </td>
                              </tr>
										{/if}
										{if $ENABLE_AUCTION eq 'Yes'}
										<tr><td colspan="2">&nbsp;</td></tr>
                              <tr>
										  <td valign="top"><span style="display:inline-block; width:130px;"><b><u>{$LBL_RFQ2_RIGHTS}</u>:</b></span></td>
										  <td valign="top" >
                                   <span style="display:inline-block; width:100px;">{$LBL_CREATE}: {if $crfq2awrdsts|in_array:$rfq2s}{$LBL_YES}{else}{$LBL_NO}{/if}</span>
												{if $ores[0].eRFQ2VerifyReq eq 'Yes'}
                                   <span style="display:inline-block; width:100px;">{$LBL_VERIFY}: {if $vrfq2awrdsts|in_array:$rfq2s}{$LBL_YES}{else}{$LBL_NO}{/if}</span>
												{/if}
                                   <br /> <br />
                                </td>
									   </tr>
                              <tr>
										  <td valign="top"><span style="display:inline-block; width:130px;"><b><u>{$LBL_RFQ2_AWARD_RIGHTS}</u>:</b></span></td>
										  <td valign="top">
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
                                   <td valign="top"><span style="display:inline-block; width:170px;"><b><u>{$LBL_BID_RIGHTS}</u>:</b></span></td>
											  <td valign="top">
                                   <span style="display:inline-block; width:100px;">{$LBL_CREATE}: {if $crfq2awrdsts|in_array:$rfq2bid}{$LBL_YES}{else}{$LBL_NO}{/if}</span>
											  {if $ores[0].eRFQ2BidVerifyReq eq 'Yes'}
                                   <span style="display:inline-block; width:100px;">{$LBL_VERIFY}: {if $vrfq2awrdsts|in_array:$rfq2bid}{$LBL_YES}{else}{$LBL_NO}{/if}</span>
											  {/if}
                                   <br /> <br />
                                   </td>
										   </tr>
                                 <tr>
                                   <td valign="top"><span style="display:inline-block; width:170px;" ><b><u>{$LBL_AWARD_ACCEPTANCE_RIGHTS}</u>:</b></span></td>
											  <td valign="top" >
                                   {assign var="an" value="n"}
											  {if $rfq2awrdacpt|is_array && $arfq2awrdsts[0].iStatusID|in_array:$rfq2awrdacpt}
													 {$LBL_ACCEPT}
													 {assign var="an" value="y"}
											  {/if}
                                   {section name="l" loop=$rfq2awrdacptsts}
                                       {if $rfq2awrdacptsts[l].iStatusID|in_array:$rfq2awrdacpt}
                                          {if $an eq 'y'},{/if} {$rfq2awrdacptsts[l].vStatus}
                                          {assign var="an" value="y"}
                                       {/if}
                                   {/section}
                                   <br /> <br />
                                   </td>
										   </tr>
                              {/if}
                    <tr>
                      <td valign="top">&nbsp;</td>
                    </tr>
                    </table>
                </div>
                <div>&nbsp;</div>
            </div>
       </div>
       </div>
</form>
