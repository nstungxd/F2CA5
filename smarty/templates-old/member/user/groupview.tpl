-<form name="frmcreategroup" id="frmcreategroup" action="{$SITE_URL}index.php?file=u-creategroup_a" method="POST">
<input type="hidden" name="iGroupID" id="iGroupID" value="{$iGroupID}" />
<input type="hidden" name="view" id="view" value="{$view}" />
<div class="middle-container">
       <h1>{$LBL_GROUP_VIEW}</h1>
       <div class="middle-containt">
       <div class="statistics-main-box-white">
       <div>
          <ul id="inner-tab">
				  <li><a href="#" class="current"><EM>{$LBL_GROUP}</EM></a></li>
		    </ul>
          </div>
            <div class="clear"></div><div class="inner-gray-bg">
           {if $msg neq '' && $OgrpData[0].eStatus neq 'Active' || $verify eq 'yes'}
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
            	<div>&nbsp;</div>
					<div><span style="float:right;"><b><a class="" href="javascript:openpopup('{$SITE_URL}groupviewhistory/{$iGroupID}')" >{$LBL_VIEW_HISTORY}</a></b></span></div>
                <div>
                    <table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
                    <tr>
                      <td width="100px" valign="top">{$LBL_ORGANIZATIONS}&nbsp; </td>
                      <td width="1px">:</td>
                      <td>
                      <table width="228" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                              <!-- class="securitymanager-white-bg" -->
                            <td height="20">
                                {$orgdata[0].vCompanyName}
                            </td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td valign="top">{$LBL_GROUP_NAME}&nbsp; </td>
                      <td width="1px">:</td>
                      <td>{$grpData[0].vGroupName}</td>
                    </tr>
                    {*}<tr>
                      <td valign="top">{$LBL_USERS}&nbsp; </td>
                      <td valign="top">:</td>
                      <td>
                           <div >
                           {section name=i loop=$userdata}
                           <div>{$userdata[i].vTitle}</div>
                           {/section}
                           </div>
                      </td>
                    </tr>{*}
                    {*}<tr>
                      <td valign="top">{$LBL_ASSIGN_RIGHTS}&nbsp; </td>
                      <td>:</td>
                      <td width="300">
                            <b>{$LBL_ORDER_STATUS_LEVEL}</b>
                      </td>
							 <td width="300">
							   {if $poUserAcpt|@count > 0 && $poUserAcpt|is_array}
									 <b>{$LBL_ORDER_ACPT_LEVEL}</b>
								{/if}
							</td>
                    </tr>{*}
						  <tr>
                        <td colspan="2" valign="top"><img src="{$SITE_IMAGES}sm_images/spacer.gif" width="1" height="1" alt="" border="0" /></td>
                     </tr>
                              <tr>
                               <td valign="top">{$LBL_ASSIGN_RIGHTS}&nbsp; </td>
                                <td >&nbsp;</td>
										  <td colspan="2">&nbsp;</td>
										</tr>
                              {if $orgdata[0].eOrganizationType neq 'Buyer2'}
										{if $orgdata[0].eOrganizationType neq 'Supplier'}
										<tr>
											  <td>&nbsp;</td><br/>
											  <td valign="top" colspan="3"><b><u>{$LBL_BUYER_RIGHTS}</u>:</b></td>
										</tr>
										<tr>
											  <td colspan="2">&nbsp;</td>
											  <td valign="top" colspan="2"><b>{$LBL_PO_CREATION}:</b>
												  <span style="padding:45px;">
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
													{section name=i loop=$status}
													  {if $status[i].Id|in_array:$invUserAcpt && $status[i].eType eq 'Optional' && $status[i].status neq 'Create' && $status[i].status neq 'Issued' && $status[i].status neq 'Verify'}
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
											  <td colspan="3" style="padding-left:7px;"><b>{$LBL_INVOICE_FROM_PO_SUPPLIER_ONBEHALF} : </b> {if $grpData[0].eInvFPO eq 'Yes'} {$grpData[0].eInvFPO} {else} {$LBL_NO} {/if} </td>
										 </tr>
										 {/if}
										<tr><td colspan="4">&nbsp;</td></tr>
										{if $orgdata[0].eOrganizationType neq 'Buyer'}
										<tr>
											  <td>&nbsp;</td><br>
											  <td valign=="top" colspan="3"><b><u>{$LBL_SUPPLIER_RIGHTS}</u>:</b></td>
										</tr>
										<tr>
											  <td colspan="2">&nbsp;</td>
											  <td valign="top" colspan="2"><b>{$LBL_INV_CREATION}:</b>
												  <span style="padding:21px;">
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
													{section name=i loop=$status}
													  {if $status[i].Id|in_array:$poUserAcpt && $status[i].eType eq 'Optional' && $status[i].status neq 'Create' && $status[i].status neq 'Issued' && $status[i].status neq 'Verify'}
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
                    {*}<tr>
                        <td valign="top">&nbsp;</td><td></td>
							   <td width="300" valign="top">
									  {assign var="fg" value='n'}
									  {section name=i loop=$status}
											  {if $status[i].Id|in_array:$poUserStatus && $status[i].eType eq 'Optional'}
											  {if $fg eq 'y'},{/if}
													{$status[i].title}
													{assign var="fg" value='y'}
											  {/if}
									  {/section}
								</td>
								<td width="300" valign="top">
									  {assign var="fg" value='n'}
									  {section name=i loop=$status}
											  {if $status[i].Id|in_array:$poUserAcpt && $status[i].eType eq 'Optional'}
											  {if $fg eq 'y'},{/if}
													{$status[i].title}
													{assign var="fg" value='y'}
											  {/if}
									  {/section}
								</td>
                    </tr>
						  <tr><td colspan="3">&nbsp;</td></tr>
                    <tr>
                         <td valign="top">&nbsp;</td><td></td>
                         <td width="300">
                               <b>{$LBL_INV_STATUS_LEVEL}</b>
                         </td>
								 <td width="300">
									 {if $invUserAcpt|@count > 0 && $invUserAcpt|is_array}
										 <b>{$LBL_INV_ACPT_LEVEL}</b>
									 {/if}
								 </td>
                    </tr>
                    <tr><td></td><td></td>
									 <td>
											{assign var="fl" value='n'}
											{section name=i loop=$status}
												  {if $status[i].Id|in_array:$invUserAcpt && $status[i].eType eq 'Optional'}
														 {if $fl eq 'y'},{/if}
														 {$status[i].title}
														 {assign var="fl" value='y'}
												  {/if}
											{/section}
									 </td>
									 <td>
											{assign var="fl" value='n'}
											{section name=i loop=$status}
												  {if $status[i].Id|in_array:$invUserAcpt && $status[i].eType eq 'Optional'}
														 {if $fl eq 'y'},{/if}
														 {$status[i].title}
														 {assign var="fl" value='y'}
												  {/if}
											{/section}
									 </td>
                    </tr>{*}
                    <tr>
                      <td valign="top">&nbsp;</td>
                    </tr>
						  {if $verify eq 'yes'}
							<tr>
							  <td valign="top">{$LBL_REASON_TO_REJECT} </td>
							  <td valign="top">:</td>
							  <td><textarea id="tReasonToReject" name="tReasonToReject" cols="70" rows="3"></textarea></td>
							</tr>
							{/if}
						  {if $vgrpData[0].iRejectedById gt 0 && $vgrpData[0].tReasonToReject|trim neq ''}
							<tr>
							  <td valign="top">{$LBL_REASON_TO_REJECT} </td>
							  <td valign="top">:</td>
							  <td><div style="background:#fafafa; border:1px solid #cccccc; height:30px; width:390px; overflow-y:scroll;">{$vgrpData[0].tReasonToReject|trim}</div></td>
							</tr>
							{/if}
                    <tr>
                      <td valign="top">&nbsp;</td>
                    </tr>
                    <tr>
                      <td valign="top">&nbsp;</td>
                      <td colspan="2">
									 {*}<img src="{$SITE_IMAGES}sm_images/btn-back.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" {if $verify eq 'yes'}onclick="location.href='{$SITE_URL_DUM}verifygrouplist';"{else}onclick="location.href='{$SITE_URL_DUM}grouplist';"{/if} />{*}
									 <img src="{$SITE_IMAGES}sm_images/btn-back.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" {*onclick="//history.back();"*} {if $verify eq 'yes'}onclick="location.href='{$SITE_URL_DUM}verifygrouplist';"{else}onclick="location.href='{$SITE_URL_DUM}grouplist';"{/if} />
                            {if $verify eq 'yes'}
										 <img src="{$SITE_IMAGES}sm_images/btn-verify.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('verify');$('#frmcreategroup').submit();" />
										 <img src="{$SITE_IMAGES}sm_images/btn-reject.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('reject');$('#frmcreategroup').submit();" />
                            {/if}
                      </td>
                      <td valign="top" align="right">&nbsp;
							   {if $OgrpData[0].eStatus eq 'Modified'}
                           <a class="colorbox" href="{$SITE_URL_DUM}index.php?file=u-aj_groupoverview&id={$OgrpData[0].iGroupID}" onmouseover="CallColoerBox(this.href,700,320,'file');">Click Here to view Original</a>
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