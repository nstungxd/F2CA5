<div class="middle-container">
<h1>{$LBL_CREATE_ASSOCIATION}</h1>
<div class="middle-containt">
	<div class="statistics-main-box-white">
		<div>
			<ul id="inner-tab">
				<li><a class="current"><em>{$LBL_BUYER2_ASSOCIATION}</em></li>
		   </ul>
      </div>
		<div class="clear"></div>
		<div class="inner-gray-bg" style="height:439px;"> {*} style="height:430px;" {*}
      <form id="frmadd" name="frmadd" method="post" action="{$SITE_URL}index.php?file=or-b2association_a">
			<div>&nbsp;</div>
			<div>
            <span id="prc" style="display:none; float:right;"> <img src="{$SITE_IMAGES}sm_images/progress.gif" /> Processing ... </span>
               {if $msg neq ''}
               {*<div class="msg">{$msg}</div>*}
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
				<table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
				  <tr>
					 <td width="198" valign="top">{if $view eq 'edit'}{$LBL_ASSOCIATION_CODE}&nbsp;<font class="reqmsg">*</font> {/if}</td>
                <td>{if $view eq 'edit'}:{/if}</td>
					 <td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td align="left">
								<input type="hidden" name="Data[vAssociationCode]" id="vAssociationCode" value="{$vAssociationCode}" />
								<input type="hidden" name="iAsociationID" id="iAsociationID" value="{$iAsociationID}" />
							</td>
							 <td height="20" align="left">
								 {if $view eq 'edit'}
									<b>{$vAssociationCode}</b>
								 {/if}
							 </td>
                      <td align="right"></td>
						  </tr>
						</table>
					</td>
					</tr>
				  <tr>
					 <td width="198" valign="top">{$LBL_SELECT_BUYER_ORG}&nbsp;<font class="reqmsg">*</font> </td>
               <td >:</td>
               <td>
						<table width="228" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							   <td height="20" >
									{if $view eq 'edit'}
    									{assign var="readonly" value="DISABLED"}
    									<input type="hidden" name="Data[iBuyerOrganizationID]" id="iBuyerOrganizationID" value="{$assorgdt[0].iBuyerOrganizationID}" title="{$MSG_SELECT_BUYER_ORGANIZATION}"/>
										<div id="BuyerOrg">
										<select name="iBuyerOrganizationID" id="" style="width:230px;" {$readonly}>
											<option value="">---{$MSG_SELECT_BUYER_ORGANIZATION}---</option>
											<option value="{$assorgdt[0].iBuyerOrganizationID}" selected="selected">{$orgdata[0].vCompanyName}</option>
										</select>
										</div>
									{else}
										{if $uoa eq 'yes'}
											<input type="hidden" name="Data[iBuyerOrganizationID]" id="iBuyerOrganizationID" value="{$bodt[0].iOrganizationID}" >
											<input type="text" name="iBuyerOrganizationID" id="iBuyerOrgID" value="{$bodt[0].vCompanyName}" readonly="readonly" />
										{else}
										<div id="BuyerOrg">
										<select name="Data[iBuyerOrganizationID]" id="iBuyerOrganizationID" style="width:230px;" {if $uoa eq 'yes'}disabled="disabled"{/if}>
											<option value="">---{$MSG_SELECT_BUYER_ORGANIZATION}---</option>
										</select>
										</div>
										{/if}
    								{/if}
								 </td>
								  <td>
								      &nbsp;&nbsp;
								  </td>
							{if $view eq 'edit'}
							<td colspan="3">&nbsp;</td>
							{elseif $uoa neq 'yes'}
					      <td>
					         <input type="text" name="orgtxt" value="{$orgdata[0].orgname}" class="input-rag" id="orgtxt" style="width:100px; vertical-align:middle;">
							</td>
							<td>&nbsp;&nbsp;</td>
							<td>
								<img src="{$SITE_IMAGES}sm_images/btn-search.gif" alt="" border="0" style="cursor: pointer;vertical-align:middle;background: #f8f8f8;border:none;" onclick="getBuyerOrgs();" />
							</td>
							{/if}
						</tr>
						</table>
						</td>
						</td>
				  	</tr>
					  <tr>
						 <td valign="top">{$LBL_SELECT_SELLER_ORG}&nbsp;<font class="reqmsg">*</font> </td>
                               <td valign="top" >:</td>
						 <td>
							<table width="486" border="0" cellspacing="0" cellpadding="0">
                                     <tr>
                                          <td height="20" style="padding-left: 4px;">
									 {$LBL_COMP_REG_NO} &nbsp;
                                              {$LBL_ORG_CODE} &nbsp;
                                              {$LBL_ORG_NAME} &nbsp;
								 </td>
							  </tr>
							  	<tr>
								<td height="30" valign="top">
									<input type="text" name="regno" value="{$orgdata[0].regno}" class="input-rag" id="regno" style="width:100px; vertical-align:middle;" > &nbsp;
									<input type="text" name="orgcode" value="{$orgdata[0].orgcode}" class="input-rag" id="orgcode" style="width:100px; vertical-align:middle;"> &nbsp;
									<input type="text" name="orgname" value="{$orgdata[0].orgname}" class="input-rag" id="orgname" style="width:100px; vertical-align:middle;">
									<img src="{$SITE_IMAGES}sm_images/btn-search.gif" alt="" border="0" style="cursor: pointer;vertical-align:middle;background: #f8f8f8;border:none;" onclick="getSellerOrgs();"  />
								</td>
							  	</tr>
							  	<tr>
								<td class="light-golden-bor"  height="35">
									<div id="result" align="center">{$LBL_ORG_NOT_FOUND}</div>
								</td>
								</tr>
								<tr>
									<td  height="5" style="padding-top:5px;">
									<img src="{$SITE_IMAGES}sm_images/btn-insert.gif" id="insert_btn"  alt=""  style="cursor: pointer;vertical-align:middle;border:none;background: #f8f8f8;display:none;"/>
									<img src="{$SITE_IMAGES}sm_images/btn-reset.gif" alt="" id="reset_btn" border="0" style="cursor: pointer;vertical-align:middle;border:none;background: #f8f8f8;" onclick="resetform();return false;"/>
									</td>
								</tr>
								<tr><td>&nbsp;</td></tr>
								<tr>
									<td style="padding-top:5px;">
									  {*}<select name="tAssocs[]" id="tAssocs" class="textarea-security required" style="width:228px; height:100px; display:none;" multiple="multiple">
									  </select>{*}
									<div  style="height: 100px;overflow-y:auto;">
										<div id="assocs" class="textarea-security" {*if $res|is_array && $res|@count gt 0}style='border 1px solid #cccccc'{/if*}>
											 {section name=i loop=$res}
												 {assign var="indx" value=$res[i].iOrganizationID}
											 <div id="asso{$res[i].iOrganizationID}" {if $smarty.section.i.index%2 eq 0}style="background:#eeeeee;"{/if}>
												<img src="{$SITE_IMAGES}arrow.gif" /> &nbsp;
												<span style="display:inline-block; width:430px;"><b>(<span id="sellcode{$res[i].iOrganizationID}">{$newarr[$indx].vSupplierCode}</span>) &nbsp;[Seller Organization: {$res[i].vCompanyName}({$res[i].vOrganizationCode})]</b> &nbsp;</span>
												<span><img src="{$SITE_IMAGES}sm_images/icon-cancel.gif" onclick="delasso('{$res[i].iOrganizationID}');" /></span>
												<input type="hidden" name="assocorgs[]" id="assocorgs{$res[i].iOrganizationID}" value="{$res[i].iOrganizationID}" />
												<input type="hidden" name="suporgcode[]" id="suporgcode{$res[i].iOrganizationID}" value="{$res[i].vOrganizationCode}" />
												<input type="hidden" name="assocCode[]" id="assocCode{$res[i].iOrganizationID}" value="{$newarr[$indx].vSupplierCode}" />
											 </div>
											 {/section}
										</div>
									  </div>
								 </td>
							  </tr>
							</table>
						 </td>
					  </tr>
					<tr>
						<td valign="top">&nbsp;</td>
						<td colspan="2">
							<img src="{$SITE_IMAGES}sm_images/btn-submit.gif" alt="" id="btnSubmit" border="0" style="cursor: pointer;vertical-align:middle;cursor:pointer;border:none;background: #f8f8f8;" onclick="return submitfrm();" /> &nbsp;
						</td>
					</tr>
				</table>
			</div>
			<div>&nbsp;</div>
         </form>
		</div>
	</div>
</div>
</div>