<link href="{$SITE_CSS}jquery-ui-1.7.2.css" rel="stylesheet" type="text/css" />
<div class="middle-container">
<h1>{$LBL_DASHBOARD} </h1>
<div>
<div class="middle-containt sortable" id="one">
   <div class="statistics-main-box" id="foo_1">
	<div class="user-box"><h2><img class="plusminus-img" src="{$SITE_IMAGES}sm_images/minus-icon.gif" /> {$LBL_STATISTICS}</h2>
	<div class="statistics-text" style="background:#f7f7f7;">
   <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
         <td width="200" height="24">&nbsp;</td>
         <td width="75" align="center" class="listing-name-blue">{$LBL_ACTIVE}</td>
       	<td width="75" align="center" class="listing-name-blue">{$LBL_INACTIVE}</td>
			<td width="75" align="center" class="listing-name-blue">{$LBL_NOT_VERIFIED}</td>
         <td width="60" align="center" class="listing-name-blue">{$LBL_TOTAL} </td>
      </tr>
      <tr>
         <td height="23" class="listing-name-grey-border-to-1">{$LBL_ASSOCIATIONS}</td>
         <td align="center" class="listing-name-grey-border-nomber-1">{if $assocstats[0].actrec gt 0}<a onclick="showlist('asoc','act');" style="cursor:pointer;">{/if}&nbsp;{$assocstats[0].actrec}&nbsp;{if $assocstats[0].actrec gt 0}</a>{/if}</td>
         <td align="center" class="listing-name-grey-border-nomber-1">{if $assocstats[0].inactrec gt 0}<a onclick="showlist('asoc','inact');" style="cursor:pointer;">{/if}&nbsp;{$assocstats[0].inactrec}&nbsp;{if $assocstats[0].inactrec gt 0}</a>{/if}</td>
         <td align="center" class="listing-name-grey-border-nomber-1">{if $assocstats[0].verify_org gt 0}<a onclick="showlist('asoc','nvfy');" style="cursor:pointer;">{/if}&nbsp;{$assocstats[0].verify_org}&nbsp;{if $assocstats[0].verify_org gt 0}</a>{/if}</td>
         <td align="center" class="listing-name-grey-total-1">{$assocstats[0].tot}</td>
      </tr>
      <tr>
         <td height="23" class="listing-name-grey-border-to-1">{$LBL_GROUPS}</td>
         <td align="center" class="listing-name-grey-border-nomber-1">{if $groupstats[0].actrec gt 0}<a onclick="showlist('grp','act');" style="cursor:pointer;">{/if}&nbsp;{$groupstats[0].actrec}&nbsp;{if $groupstats[0].actrec gt 0}</a>{/if}</td>
         <td align="center" class="listing-name-grey-border-nomber-1">{if $groupstats[0].inactrec gt 0}<a onclick="showlist('grp','inact');" style="cursor:pointer;">{/if}&nbsp;{$groupstats[0].inactrec}&nbsp;{if $groupstats[0].inactrec gt 0}</a>{/if}</td>
         <td align="center" class="listing-name-grey-border-nomber-1">{if $groupstats[0].verify_org gt 0}<a onclick="showlist('grp','nvfy');" style="cursor:pointer;">{/if}&nbsp;{$groupstats[0].verify_org}&nbsp;{if $groupstats[0].verify_org gt 0}</a>{/if}</td>
         <td align="center" class="listing-name-grey-total-1">{$groupstats[0].tot}</td>
      </tr>
      <tr>
         <td height="23" class="listing-name-grey-border-to-1">{$LBL_ADMINS}</td>
         <td align="center" class="listing-name-grey-border-nomber-1">{if $orgadminstats[0].actrec gt 0}<a onclick="showlist('adm','act');" style="cursor:pointer;">{/if}&nbsp;{$orgadminstats[0].actrec}&nbsp;{if $orgadminstats[0].actrec gt 0}</a>{/if}</td>
         <td align="center" class="listing-name-grey-border-nomber-1">{if $orgadminstats[0].inactrec gt 0}<a onclick="showlist('adm','inact');" style="cursor:pointer;">{/if}&nbsp;{$orgadminstats[0].inactrec}&nbsp;{if $orgadminstats[0].inactrec gt 0}</a>{/if}</td>
         <td align="center" class="listing-name-grey-border-nomber-1">{if $orgadminstats[0].verify_org gt 0}<a onclick="showlist('adm','nvfy');" style="cursor:pointer;">{/if}&nbsp;{$orgadminstats[0].verify_org}&nbsp;{if $orgadminstats[0].verify_org gt 0}</a>{/if}</td>
         <td align="center" class="listing-name-grey-total-1">{$orgadminstats[0].tot}</td>
      </tr>
      <tr>
         <td height="23" class="listing-name-grey-border-to-1">{$LBL_USERS}</td>
         <td align="center" class="listing-name-grey-border-nomber-1">{if $orguserstats[0].actrec gt 0}<a onclick="showlist('usr','act');" style="cursor:pointer;">{/if}&nbsp;{$orguserstats[0].actrec}&nbsp;{if $orguserstats[0].actrec gt 0}</a>{/if}</td>
         <td align="center" class="listing-name-grey-border-nomber-1">{if $orguserstats[0].inactrec gt 0}<a onclick="showlist('usr','inact');" style="cursor:pointer;">{/if}&nbsp;{$orguserstats[0].inactrec}&nbsp;{if $orguserstats[0].inactrec gt 0}</a>{/if}</td>
         <td align="center" class="listing-name-grey-border-nomber-1">{if $orguserstats[0].verify_org gt 0}<a onclick="showlist('usr','nvfy');" style="cursor:pointer;">{/if}&nbsp;{$orguserstats[0].verify_org}&nbsp;{if $orguserstats[0].verify_org gt 0}</a>{/if}</td>
         <td align="center" class="listing-name-grey-total-1">{$orguserstats[0].tot}</td>
      </tr>
      <tr>
         <td height="23" class="listing-name-grey-border-to-1">{$LBL_USER_RIGHTS}</td>
         <td align="center" class="listing-name-grey-border-nomber-1">{if $userrightsstats[0].actrec gt 0}<a onclick="showlist('vur','act');" style="cursor:pointer;">{/if}&nbsp;{$userrightsstats[0].actrec}&nbsp;{if $userrightsstats[0].actrec gt 0}</a>{/if}</td>
        <td align="center" class="listing-name-grey-border-nomber-1">{if $userrightsstats[0].inactrec gt 0}<a onclick="showlist('vur','inact');" style="cursor:pointer;">{/if}&nbsp;{$userrightsstats[0].inactrec}&nbsp;{if $userrightsstats[0].inactrec gt 0}</a>{/if}</td>
        <td align="center" class="listing-name-grey-border-nomber-1">{if $userrightsstats[0].verify_org gt 0}<a onclick="showlist('vur','nvfy');" style="cursor:pointer;">{/if}&nbsp;{$userrightsstats[0].verify_org}&nbsp;{if $userrightsstats[0].verify_org gt 0}</a>{/if}</td>
         <td align="center" class="listing-name-grey-total-1">{$userrightsstats[0].tot}</td>
      </tr>
      <tr><td colspan="5" class="listing-name-grey-border-to-1" style="height:1px;"></td></tr>
   </table>
   </div>
   </div>
   <div class="user-login-box">
		<h2><img class="plusminus-img" src="{$SITE_IMAGES}sm_images/minus-icon.gif" /> {$LBL_LAST_3_LOGIN}</h2>
		<div class="user-login-text">
				{section name=l loop=$lastlogins}
					<p>
					{$LBL_LAST_LOGIN} : &nbsp; {$lastlogins[l].dLoginDate|calcLTzTime|DateTime:7} <br/>
					{$LBL_IP_ADDRESS} : &nbsp; {$lastlogins[l].vIP}
					</p>
				{sectionelse}
					<p>
						{$LBL_NO_REC_AVAILABLE}
					</p>
				{/section}
			</div>
      </div>
</div>

{if $ENABLE_AUCTION eq 'Yes'}
<div class="association-main-box column" id="foo_6">
   <h2><img class="plusminus-img" src="{$SITE_IMAGES}sm_images/minus-icon.gif" /> {$LBL_BUYER}2 {$LBL_ASSOCIATIONS} &nbsp; ({$LBL_AUCTION_TENDER})</h2>
	{if $uorg_type neq 'Supplier'}
		<div class="association-text">
		<h3>{$LBL_BUYER2_BUYER} {$LBL_ASSOCIATION}</h3>
			<p>
				{$LBL_BUYER2}:<span> {$b2by_dtls[0].vBuyer2}</span>
				{$LBL_DATE} :<span> {$b2by_dtls[0].dADate|calcLTzTime|DateTime:10}</span><br/>
				{$LBL_BPRODUCT}: <span>{$b2by_dtls[0].vBuyer}</span><br />
				{$LBL_CODE}: <span><a href="{$SITE_URL_DUM}b2buyerasocview/{$b2by_dtls[0].iAssociationId}" style="text-decoration:underline;">{$b2by_dtls[0].vACode}</a></span><br />
				{if $b2byb_dtls[0].eStatus neq 'Need to Verify' && $b2by_dtls[0].eStatus neq 'Modified' && $b2by_dtls[0].eNeedToVerify neq 'Yes'}
					{if $b2by_dtls[0].vVerifiedBy neq ''}Verified By :<span> {$b2by_dtls[0].vVerifiedBy}</span>{/if}
				{else} {$LBL_STATUS} :<span> {$b2by_dtls[0].eStatus} {*}{$LBL_NEED_TO_VERIFY}{*}</span> {/if}
			</p>
		</div>
		<div class="association-text">
		<h3>{$LBL_BUYER2_BPRODUCT_BUYER} {$LBL_ASSOCIATION}</h3>
			<p>
				{$LBL_BUYER2}:<span> {$b2byb_dtls[0].vBuyer2}</span>
				{$LBL_DATE} :<span> {$b2byb_dtls[0].dADate|calcLTzTime|DateTime:10}</span><br/>
				{$LBL_BPRODUCT}: <span>{$b2byb_dtls[0].vBuyer}</span><br />
				{$LBL_CODE}: <span><a href="{$SITE_URL_DUM}b2bprodtbasocview/{$b2byb_dtls[0].iAssociationId}" style="text-decoration:underline;">{$b2byb_dtls[0].vACode}</a></span><br />
				{if $b2byb_dtls[0].eStatus neq 'Need to Verify' && $b2byb_dtls[0].eStatus neq 'Modified' && $b2byb_dtls[0].eNeedToVerify neq 'Yes'}
					{if $b2byb_dtls[0].vVerifiedBy neq ''}Verified By :<span> {$b2byb_dtls[0].vVerifiedBy}</span>{/if}
				{else} {$LBL_STATUS} :<span> {$b2byb_dtls[0].eStatus} {*}{$LBL_NEED_TO_VERIFY}{*}</span> {/if}
			</p>
		</div>
	{/if}
	{if $uorg_type neq 'Supplier'}
		<div class="clear">&nbsp;</div>
		<div class="association-text">
			<h3>{$LBL_BUYER2_SUPPLIER} {$LBL_ASSOCIATION}</h3>
			<p>
				{$LBL_BUYER2}:<span> {$b2sp_dtls[0].vBuyer2}</span>
				{$LBL_DATE} :<span> {$b2sp_dtls[0].dADate|calcLTzTime|DateTime:10}</span><br/>
				{$LBL_BPRODUCT}: <span>{$b2sp_dtls[0].vSupplier}</span><br />
				{$LBL_CODE}: <span><a href="{$SITE_URL_DUM}b2supplierasocview/{$b2sp_dtls[0].iAssociationId}" style="text-decoration:underline;">{$b2sp_dtls[0].vACode}</a></span><br />
				{if $b2sp_dtls[0].eStatus neq 'Need to Verify' && $b2sp_dtls[0].eStatus neq 'Modified' && $b2sp_dtls[0].eNeedToVerify neq 'Yes'}
					{if $b2sp_dtls[0].vVerifiedBy neq ''}Verified By :<span> {$b2sp_dtls[0].vVerifiedBy}</span>{/if}
				{else} {$LBL_STATUS} :<span> {$b2sp_dtls[0].eStatus} {*}{$LBL_NEED_TO_VERIFY}{*}</span> {/if}
			</p>
		</div>
		<div class="association-text">
			<h3>{$LBL_BUYER2_SPRODUCT_SUPPLIER} {$LBL_ASSOCIATION}</h3>
			<p>
				{$LBL_BUYER2}:<span> {$b2sps_dtls[0].vBuyer2}</span>
				{$LBL_DATE} :<span> {$b2sps_dtls[0].dADate|calcLTzTime|DateTime:10}</span><br/>
				{$LBL_BPRODUCT}: <span>{$b2sps_dtls[0].vSupplier}</span><br />
				{$LBL_CODE}: <span><a href="{$SITE_URL_DUM}b2sprodtsasocview/{$b2sps_dtls[0].iAssociationId}" style="text-decoration:underline;">{$b2sps_dtls[0].vACode}</a></span><br />
				{if $b2sps_dtls[0].eStatus neq 'Need to Verify' && $b2sps_dtls[0].eStatus neq 'Modified' && $b2sps_dtls[0].eNeedToVerify neq 'Yes'}
					{if $b2sps_dtls[0].vVerifiedBy neq ''}Verified By :<span> {$b2sps_dtls[0].vVerifiedBy}</span>{/if}
				{else} {$LBL_STATUS} :<span> {$b2sps_dtls[0].eStatus} {*}{$LBL_NEED_TO_VERIFY}{*}</span> {/if}
			</p>
		</div>
	{/if}
</div>

{if $ENABLE_AUCTION eq 'Yes'}
 <div class="statistics-main-box" id="foo_8">
   <div class="statistics-box">
		
		<div style="height:3px;">&nbsp;</div>
		<h2>{*<img class="plusminus-img" src="{$SITE_IMAGES}sm_images/minus-icon.gif" style="cursor:pointer;"/>*}{$LBL_RFQ2}&nbsp;{$LBL_COUNTS}</h2>
		<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td width="170px">&nbsp;</td>
				{section name=l loop=$cntsts}
				<td height="25px" align="center" class="listing-name-blue-1">{$cntsts[l]}</td>
				{/section}
			</tr>
			<tr>
				<td class="listing-name-grey-border-to-1" height="25">{$LBL_RFQ2}</td>
				{assign var='ln' value=0}
				
				{section name="l" loop=$cntsts}
				    {if $cntsts[l] eq 'Not Started'}
				       {assign var='rfq2ls' value=0}
				    {/if}
				    {if $cntsts[l] eq 'Live'}
				       {assign var='rfq2ls' value=1}
				    {/if}
				    {if $cntsts[l] eq 'Completed'}
				       {assign var='rfq2ls' value=2}
				    {/if}
				    {if $cntsts[l] eq 'Cancelled'}
				       {assign var='rfq2ls' value=2}
				    {/if}
					<td height="25" align="center" class="{if $smarty.section.l.index+1 eq $cntsts|@count}listing-name-grey-total-1{else}listing-name-grey-border-nomber-1{/if}">
						{if $cntsts[l]|in_array:$r2sts}{if $cntsts[l] neq 'Awarded'}<a href="{$SITE_URL_DUM}rfq2list/{$rfq2ls}/rfq2count">{$rfq2stats[$ln].cnt}</a>{else}{$rfq2stats[$ln].cnt}{/if}{assign var='ln' value=`$ln+1`}{else} 0 {/if}
					</td>
				{/section}
			</tr>
			<tr><td colspan="11" class="listing-name-grey-border-to-1" style="height:1px;"></td></tr>
		</table>
      </div>
 
	<div class="login-box">
      <h2><img class="plusminus-img" src="{$SITE_IMAGES}sm_images/minus-icon.gif" style="cursor:pointer;"/> {$LBL_RFQ2}</h2>
        <div class="organization-text">
         {section name=l loop=$latestrfq2 max=1}
         <span style="display:inline-block; width:230px;"><b style="font-size:12.9px;">{$LBL_RFQ2_CODE}:</b> <a href="{$SITE_URL_DUM}rfq2view/{$latestrfq2[l].iRFQ2Id}"><b style="font-size:12.9px;">{$latestrfq2[l].vRFQ2Code}</b></a></span>
			<p>
            <label style="display:inline-block; width:170px;">{$LBL_INVOICE_CODE}: {$latestrfq2[l].vInvoiceCode} </label> &nbsp; <label>{$LBL_TYPE}: {$latestrfq2[l].eAuctionType}</label> <br/>
            <label style="display:inline-block; width:170px;">{$LBL_START_DATE}: {$latestrfq2[l].dStartDate|calcLTzTime|DateTime:10} </label> &nbsp; <label>{$LBL_END_DATE}:</label>{$latestrfq2[l].dEndDate|calcLTzTime|DateTime:10}<br/>
            <label>{$LBL_STATUS}:</label> {$latestrfq2[l].eAuctionStatus}
         </p>
			{sectionelse}
			<p>
				{$LBL_NO_REC_AVAILABLE}
			</p>
			{/section}
			<em style="padding-left:230px">
			<a href="{$SITE_URL_DUM}rfq2list">{$LBL_VIEW_MORE}</a>
			</em>
      </div>
   </div>
   </div>
 {/if}

<div class="association-main-box column" id="foo_7">
   <h2><img class="plusminus-img" src="{$SITE_IMAGES}sm_images/minus-icon.gif" /> {$LBL_BUYER}2 {$LBL_ASSOCIATION} {$LBL_STATISTICS}</h2>
	<div class="statistics-text">
   	<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="200" height="24">&nbsp;</td>
          <td width="75" align="center" class="listing-name-blue">{$LBL_ACTIVE}</td>
          <td width="75" align="center" class="listing-name-blue">{$LBL_INACTIVE}</td>
          <td width="75" align="center" class="listing-name-blue">{$LBL_NOT_VERIFIED}</td>
          <td width="60" align="center" class="listing-name-blue">{$LBL_TOTAL}</td>
        </tr>
		  {if $uorg_type neq 'Supplier'}
        <tr>
          <td height="29" class="listing-name-grey-border-to">{$LBL_BUYER2_BUYER} {$LBL_ASSOCIATION}</td>
          <td height="29" align="center" class="listing-name-grey-border-nomber">{if $b2asocstats[1].actrec gt 0}<a onclick="showlist('b2buyerasoclist','act');" style="cursor:pointer;">{/if}&nbsp;{$b2asocstats[1].actrec}&nbsp;{if $b2asocstats[1].actrec gt 0}</a>{/if}</td>
          <td height="29" align="center" class="listing-name-grey-border-nomber">{if $b2asocstats[1].inactrec gt 0}<a onclick="showlist('b2buyerasoclist','inact');" style="cursor:pointer;">{/if}&nbsp;{$b2asocstats[1].inactrec}&nbsp;{if $b2asocstats[1].inactrec gt 0}</a>{/if}</td>
          <td height="29" align="center" class="listing-name-grey-border-nomber">{if $b2asocstats[1].verifyrec gt 0}<a onclick="showlist('b2buyerasocvlist','nvfy');" style="cursor:pointer;">{/if}&nbsp;{$b2asocstats[1].verifyrec}&nbsp;{if $b2asocstats[1].verifyrec gt 0}</a>{/if}</td>
          <td height="29" align="center" class="listing-name-grey-total">{$b2asocstats[1].tot}</td>
        </tr>
        <tr>
          <td height="29" class="listing-name-grey-border-to">{$LBL_BUYER2_BPRODUCT_BUYER} {$LBL_ASSOCIATION}</td>
          <td height="29" align="center" class="listing-name-grey-border-nomber">{if $b2asocstats[2].actrec gt 0}<a onclick="showlist('b2bprdtbasoclist','act');" style="cursor:pointer;">{/if}&nbsp;{$b2asocstats[2].actrec}&nbsp;{if $b2asocstats[2].actrec gt 0}</a>{/if}</td>
          <td height="29" align="center" class="listing-name-grey-border-nomber">{if $b2asocstats[2].inactrec gt 0}<a onclick="showlist('b2bprdtbasoclist','inact');" style="cursor:pointer;">{/if}&nbsp;{$b2asocstats[2].inactrec}&nbsp;{if $b2asocstats[2].inactrec gt 0}</a>{/if}</td>
          <td height="29" align="center" class="listing-name-grey-border-nomber">{if $b2asocstats[2].verifyrec gt 0}<a onclick="showlist('b2bprdtbasocvlist','nvfy');" style="cursor:pointer;">{/if}&nbsp;{$b2asocstats[2].verifyrec}&nbsp;{if $b2asocstats[2].verifyrec gt 0}</a>{/if}</td>
          <td height="29" align="center" class="listing-name-grey-total">{$b2asocstats[2].tot}</td>
        </tr>
		  {/if}
		  {if $uorg_type neq 'Buyer'}
        <tr>
           <td height="29" class="listing-name-grey-border-to">{$LBL_BUYER2_SUPPLIER} {$LBL_ASSOCIATION}</td>
           <td height="29" align="center" class="listing-name-grey-border-nomber">{if $b2asocstats[4].actrec gt 0}<a onclick="showlist('b2supplierasoclist','act');" style="cursor:pointer;">{/if}&nbsp;{$b2asocstats[4].actrec}&nbsp;{if $b2asocstats[4].actrec gt 0}</a>{/if}</td>
           <td height="29" align="center" class="listing-name-grey-border-nomber">{if $b2asocstats[4].inactrec gt 0}<a onclick="showlist('b2supplierasoclist','inact');" style="cursor:pointer;">{/if}&nbsp;{$b2asocstats[4].inactrec}&nbsp;{if $b2asocstats[4].inactrec gt 0}</a>{/if}</td>
           <td height="29" align="center" class="listing-name-grey-border-nomber">{if $b2asocstats[4].verifyrec gt 0}<a onclick="showlist('b2supplierasocvlist','nvfy');" style="cursor:pointer;">{/if}&nbsp;{$b2asocstats[4].verifyrec}&nbsp;{if $b2asocstats[4].verifyrec gt 0}</a>{/if}</td>
           <td height="29" align="center" class="listing-name-grey-total">{$b2asocstats[4].tot}</td>
        </tr>
        <tr>
           <td height="29" class="listing-name-grey-border-to">{$LBL_BUYER2_SPRODUCT_SUPPLIER} {$LBL_ASSOCIATION}</td>
           <td height="29" align="center" class="listing-name-grey-border-nomber">{if $b2asocstats[5].actrec gt 0}<a onclick="showlist('b2sprdtsasoclist','act');" style="cursor:pointer;">{/if}&nbsp;{$b2asocstats[5].actrec}&nbsp;{if $b2asocstats[5].actrec gt 0}</a>{/if}</td>
           <td height="29" align="center" class="listing-name-grey-border-nomber">{if $b2asocstats[5].inactrec gt 0}<a onclick="showlist('b2sprdtsasoclist','inact');" style="cursor:pointer;">{/if}&nbsp;{$b2asocstats[5].inactrec}&nbsp;{if $b2asocstats[5].inactrec gt 0}</a>{/if}</td>
           <td height="29" align="center" class="listing-name-grey-border-nomber">{if $b2asocstats[5].verifyrec gt 0}<a onclick="showlist('b2sprdtsasocvlist','nvfy');" style="cursor:pointer;">{/if}&nbsp;{$b2asocstats[5].verifyrec}&nbsp;{if $b2asocstats[5].verifyrec gt 0}</a>{/if}</td>
           <td height="29" align="center" class="listing-name-grey-total">{$b2asocstats[5].tot}</td>
        </tr>
		  {/if}
        <tr><td colspan="5" class="listing-name-grey-border-to-1" style="height:1px;"></td></tr>
      </table>
   </div>
   <div class="clear">&nbsp;</div>
</div>
{/if}

<div class="organization-main-box column" id="foo_2">
   <div class="organization-box">
	<h2><img class="plusminus-img" src="{$SITE_IMAGES}sm_images/minus-icon.gif" /> {$LBL_PURCHASE_ORDER}</h2>
      <div class="organization-text">
			{section name=l loop=$latestpo}
         <h3><a href="{$SITE_URL_DUM}purchaseorderview/{$latestpo[l].iPurchaseOrderID}">{$latestpo[l].vPoBuyerCode}</a></h3>
         <p>
            {$latestpo[l].supplierorg}, &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				{$LBL_CREATED_DATE} : <span>{$latestpo[l].addDate|calcLTzTime|DateTime:'0'}</span> <br />
            {$latestpo[l].vCity}, {$latestpo[l].vState}, {$latestpo[l].vCountry} &nbsp; <br />
            {*}Contact Party :<a href="mailto:info@abccorprjsanf.com"> <span>Party Name</span></a><br />{*}
            {$LBL_STATUS} : <span>Active</span>
         </p>
			{sectionelse}
			<p>
				{$LBL_NO_REC_AVAILABLE}
			</p>
			{/section}
      </div>
   </div>
   <div class="organization-to-verify-box"><h2><img class="plusminus-img" src="{$SITE_IMAGES}sm_images/minus-icon.gif" /> {$LBL_INVOICE_ORDER}</h2>
      <div class="organization-to-verify-text">
         {section name=l loop=$latestio}
         <h3><a href="{$SITE_URL_DUM}invoiceview/{$latestio[l].iInvoiceID}">{$latestio[l].vInvSupplierCode}</a></h3>
         <p>
            {$latestio[l].buyerorg}, &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				{$LBL_CREATED_DATE} : <span>{$latestio[l].addDate|calcLTzTime|DateTime:'0'}</span> <br />
            {$latestio[l].vCity}, {$latestio[l].vState}, {$latestio[l].vCountry} &nbsp; <br />
            {*}Contact Party :<a href="mailto:info@abccorprjsanf.com"> <span>Party Name</span></a><br />{*}
            {$LBL_STATUS} : <span>Active</span>
         </p>
			{sectionelse}
			<p>
				{$LBL_NO_REC_AVAILABLE}
			</p>
			{/section}
         {*}<em><a href="#">{$LBL_VIEW_MORE}</a></em>{*}
      </div>
   </div>
</div>

<div class="organization-main-box" id="foo_3">
      <div class="organization-box">
         <h2><img class="plusminus-img" src="{$SITE_IMAGES}sm_images/minus-icon.gif" /> {$LBL_BUYER_USER}</h2>
         {section name=i loop=$orgbyusrvrfy}
			<div class="organization-text">
            <h3><a href="{$SITE_URL_DUM}organizationuserview/{$orgbyusrvrfy[i].iUserID}">{$orgbyusrvrfy[i].vFirstName} {$orgbyusrvrfy[i].vLastName}</a></h3>
            {$orgbyusrvrfy[i].vCity}, {$orgbyusrvrfy[i].vZipCode}<br />
            {$orgbyusrvrfy[i].vUserName} <a href="mailto:{$orgbyusrvrfy[i].vEmail}"> <span>( {$orgbyusrvrfy[i].eUserType} ) </span></a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;
            {$LBL_CREATED_DATE} : <span>{$orgbyusrvrfy[i].dCreatedDate|calcLTzTime|DateTime:'0'}</span><br />
            {$LBL_STATUS} : <span>Active</span>
			</div>
			{sectionelse}
			<div class="organization-text">
				<p>
				{$LBL_NO_REC_AVAILABLE}
				</p>
			</div>
			{/section}
      </div>
      <div class="organization-to-verify-box">
         <h2><img class="plusminus-img" src="{$SITE_IMAGES}sm_images/minus-icon.gif" />{$LBL_SUPPLIER}</h2>
         {section name=i loop=$orgslusrvrfy}
			<div class="organization-to-verify-text">
            <h3><a href="{$SITE_URL_DUM}organizationuserview/{$orgslusrvrfy[i].iUserID}">{$orgslusrvrfy[i].vFirstName} {$orgslusrvrfy[i].vLastName}</a></h3>
            {$orgslusrvrfy[i].vCity}, {$orgslusrvrfy[i].vZipCode}<br />
            {$orgslusrvrfy[i].vUserName} <a href="mailto:{$orgslusrvrfy[i].vEmail}"> <span>( {$orgslusrvrfy[i].eUserType} ) </span></a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;
            {$LBL_CREATED_DATE} : <span>{$orgslusrvrfy[i].dCreatedDate|calcLTzTime|DateTime:'0'}</span><br />
            {$LBL_STATUS} : <span>Active</span>
         </div>
			{sectionelse}
			<div class="organization-to-verify-text">
				<p>
				{$LBL_NO_REC_AVAILABLE}
				</p>
			</div>
			{/section}
      </div>
</div>

<div class="organization-main-box column" id="foo_4">
      <h2><img class="plusminus-img" src="{$SITE_IMAGES}sm_images/minus-icon.gif" /> {$LBL_ASSOCIATION}</h2>
      {section name=j loop=$activeassocs}
   <div class="association-text">
		{*if $activeassocs[j].eStatus eq 'Need to Verify' || $activeassocs[j].eStatus eq 'Modified'}
			{assign var=v value="/verify"}
		{/if*}
      <h3><a href="{$SITE_URL_DUM}associationview/{$activeassocs[j].iAsociationID}">{$activeassocs[j].vBuyerOrg}</a></h3>
      <p>
			Buyer Organization Code:<span> {$activeassocs[j].vBuyerCode}</span>
			Date :<span> {$activeassocs[j].dCreatedDate|calcLTzTime|DateTime:10}</span><br/>
			{if $activeassocs[j].eStatus neq 'Need to Verify' && $activeassocs[j].eStatus neq 'Modified'}
			{if $activeassocs[j].vVerifiedBy neq ''}Verified By :<span> {$activeassocs[j].vVerifiedBy}</span>{/if}
			{else}
			Status :<span> {$activeassocs[j].eStatus} {*}{$LBL_NEED_TO_VERIFY}{*}</span>
			{/if}
      </p>
   </div>
	{sectionelse}
		<div class="association-text">
			<p>
		{$LBL_NO_REC_AVAILABLE}
			</p>
		</div>
	{/section}
	{if $tot_activeassocs > 2}
		<div class="clear" align="right"><em><a href="{$SITE_URL_DUM}verifyassociationlist" class="viewmorelink">{$LBL_VIEW_MORE}</a></em>&nbsp;&nbsp;&nbsp;</div>
	{/if}
</div>

<div class="inbox-main-box column" id="foo_5">
   <h2><img class="plusminus-img" src="{$SITE_IMAGES}sm_images/minus-icon.gif" /> {$LBL_INBOX} ({$totInboxres})</h2>
   <div class="clear">
      <table width="98%" border="0" align="center" cellpadding="0" class="user-text" cellspacing="0">
         {*}<tr>
            <td width="42" height="30" align="center">&nbsp;</td>
            <td width="598">&nbsp;</td>
            <td width="87" align="center"><a href="#"><img src="{$SITE_IMAGES}sm_images/btn-delete-1.gif" alt="" border="0" /></a></td>
         </tr>{*}
         {if $res|@count gt 0}
         {assign var="field" value="vMailSubject_"|cat:$LANG}
         {section name=in loop=$res}
         <tr>
            <td height="30" width="10" align="left" class="user-gray-bot-bor">
               <!--<span class="golden"><input type="checkbox" class="radib-btn" name="checkbox2" id="checkbox2" style="vertical-align:middle;" /></span>-->
            </td>
            <td class="user-gray-bot-bor" height="30" width="79%"><strong><a href="{$SITE_URL_DUM}inboxdetail/{$res[in].iVerifiedID}">{$res[in].$field}</a></strong></td>
            <td align="right" class="user-gray-bot-bor"><strong>{$res[in].dActionDate|calcLTzTime|getInboxDate}</strong></td>
         </tr>
         {/section}
			<tr>
				<td colspan="3" align="right">{if $totInboxres gt $res|@count}<em><a href="{$SITE_URL_DUM}inbox" class="viewmorelink">{$LBL_VIEW_MORE}</a></em>{/if}</td>
			</tr>
         {else}
         <tr>
            <td height="30" colspan="3" align="center" class="user-gray-bot-bor">
               {$LBL_NO_RECENT_MESSAGES}
            </td>
         </tr>
         {/if}
        </table>
      </div>
</div>
</div>
<form name="golist" id="golist" method="post" action="">
<input type="hidden" name="srchfor" id="srchfor" value="" />
<input type="hidden" name="srchval" id="srchval" value="" />
</form>
</div>
{literal}
<script>
var cookie = '{/literal}{$tDashboard}{literal}';
</script>
{/literal}
<script type="text/javascript" src="{$SITE_JS_AJAX}jOaDashboard.js"></script>