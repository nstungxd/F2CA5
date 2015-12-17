<form name="frmcreateassocs" id="frmcreateassocs" action="{$SITE_URL_DUM}index.php?file=or-createassociation_a" method="post">
<input type="hidden" name="iAsociationID" id="iAsociationID"value="{$iAsociationID}" />
<input type="hidden" name="view" id="view"value="{$view}" />
<div class="middle-containt">
	<div class="statistics-main-box-white">
		<div class="clear"></div>
		<div class="inner-gray-bg">
			<div>&nbsp;</div>
			<div>
				<table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
				  <tr>
					 <td width="198" valign="top">{$LBL_BUYER_ORG} :</td>
					 <td>
						<table width="228" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							 <td height="20">
								{$assorgdt[0].vBuyerOrg}
							 </td>
						  </tr>
						</table>
					</td>
					</tr>
               <tr>
						<td valign="top">{$LBL_BUY_CODE} :</td>
						 <td>
							<table width="486" border="0" cellspacing="0" cellpadding="0">
							  <tr>
								 <td height="30" valign="top">
									{$assorgdt[0].vBuyerCode}
								 </td>
							  </tr>
							</table>
						</td>
					</tr>
					<tr>
						<td valign="top">{$LBL_SUPPLIER_ORG} :</td>
						 <td>
							<table width="486" border="0" cellspacing="0" cellpadding="0">
							  <tr>
								 <td height="30" valign="top">
									{$assorgdt[0].vSupplierOrg}
								 </td>
							  </tr>
							</table>
						</td>
					</tr>
                         <tr>
						<td valign="top">{$LBL_SUPPLIER_CODE} :</td>
						 <td>
							<table width="486" border="0" cellspacing="0" cellpadding="0">
							  <tr>
								 <td height="30" valign="top">
									{section name="i" loop=$assorgdt}
									{$assorgdt[i].vSupplierOrg} ({$assorgdt[i].vSupplierCode}) <br/>
									{/section}
								 </td>
							  </tr>
							</table>
						</td>
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
</form>