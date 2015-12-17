<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td class="blue-hadd-bg">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		 <td width="30px" height="26" >&nbsp;
			  <input type="checkbox" class="radib-btn" name="uid_chkall" id="uid_chkall" style="vertical-align:middle;" />
		 </td>
		 <td width="90px" >Reg. No. </td>
		 <td width="100px" >Organization Code</td>
		 <td width="100px" >Organization Name</td>
		 <td width="100px" >Association Name</td>
		 <td width="100px" >Code </td>
		</tr>
		</table>
		</td>
		</tr>
		<tr>
			<td>
			<div style="height:103px; overflow:auto;" class="scrollbar " >
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  {section name=ln loop=$dt}
			  <tr class="{if $smarty.section.ln.index%2 eq 0}golden-bg{else}listing-white-bg{/if}">
				<td width="30px" height="26" >&nbsp;
					<input type="checkbox" class="radib-btn" name="uid_chkall" id="uid_chkall" style="vertical-align:middle;" value="{$dt[ln].iOrganizationID}" />
				</td>
				 <td width="90px" >{$dt[ln].vCompanyRegNo}</td>
				 <td width="100px" >{$dt[ln].vOrganizationCode}</td>
				 <td width="100px" >{$dt[ln].vCompanyName}</td>
				 <td width="100px" align="center" ><input type="text" name="vAssociationName[{$dt[ln].iOrganizationID}]" class="input-rag" id="vAssociationName{$dt[ln].iOrganizationID}" style="width:70px; vertical-align:middle;" /></td>
				 <td width="100px" align="center" ><input type="text" name="vAssociationCode[{$dt[ln].iOrganizationID}]" class="input-rag" id="vAssociationCode{$dt[ln].iOrganizationID}" style="width:50px; vertical-align:middle;" /></td>
			  </tr>
			  {/section}			  
			</table>
			</div>
		</td>
	</tr>
</table>