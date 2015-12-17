<div class="middle-container">
<h1>{$LBL_DASHBOARD} </h1>
<div>
<div class="middle-containt sortable" id="one">
<div class="statistics-main-box" id="foo_1">
   <div class="statistics-box"><h2><img class="plusminus-img" src="{$SITE_IMAGES}sm_images/minus-icon.gif" /> {$LBL_STATISTICS}</h2>
	<div class="statistics-text">
	<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
     <tr>
       <td width="200" height="24">&nbsp;</td>
       <td width="75" align="center" class="listing-name-blue">{$LBL_ACTIVE}</td>
       <td width="75" align="center" class="listing-name-blue">{$LBL_INACTIVE}</td>
       <td width="75" align="center" class="listing-name-blue">{$LBL_NOT_VERIFIED}</td>
       <td width="60" align="center" class="listing-name-blue">{$LBL_TOTAL}</td>
     </tr>
     <tr>
       <td height="29" class="listing-name-grey-border-to">{$LBL_ORGANIZATIONS}</td>
       <td height="29" align="center" class="listing-name-grey-border-nomber">{if $orgstats[0].act_org gt 0}<a onclick="showlist('org','act');" style="cursor:pointer;">{/if}&nbsp;{$orgstats[0].act_org}&nbsp;{if $orgstats[0].act_org gt 0}</a>{/if}</td>
       <td height="29" align="center" class="listing-name-grey-border-nomber">{if $orgstats[0].inact_org gt 0}<a onclick="showlist('org','inact');" style="cursor:pointer;">{/if}&nbsp;{$orgstats[0].inact_org}&nbsp;{if $orgstats[0].inact_org gt 0}</a>{/if}</td>
       <td height="29" align="center" class="listing-name-grey-border-nomber">{if $orgstats[0].verify_org gt 0}<a onclick="showlist('org','nvfy');" style="cursor:pointer;">{/if}&nbsp;{$orgstats[0].verify_org}&nbsp;{if $orgstats[0].verify_org gt 0}</a>{/if}</td>
       <td height="29" align="center" class="listing-name-grey-total">{$orgstats[0].tot}</td>
     </tr>
     <tr>
       <td height="29" class="listing-name-grey-border-to">{$LBL_ASSOCIATIONS}</td>
       <td height="29" align="center" class="listing-name-grey-border-nomber">{if $assostats[0].act_org gt 0}<a onclick="showlist('asoc','act');" style="cursor:pointer;">{/if}&nbsp;{$assostats[0].act_org}&nbsp;{if $assostats[0].act_org gt 0}</a>{/if}</td>
       <td height="29" align="center" class="listing-name-grey-border-nomber">{if $assostats[0].inact_org gt 0}<a onclick="showlist('asoc','inact');" style="cursor:pointer;">{/if}&nbsp;{$assostats[0].inact_org}&nbsp;{if $assostats[0].inact_org gt 0}</a>{/if}</td>
       <td height="29" align="center" class="listing-name-grey-border-nomber">{if $assostats[0].verify_org gt 0}<a onclick="showlist('asoc','nvfy');" style="cursor:pointer;">{/if}&nbsp;{$assostats[0].verify_org}&nbsp;{if $assostats[0].verify_org gt 0}<a onclick="showlist('asoc','nvfy');" style="cursor:pointer;">{/if}</td>
       <td height="29" align="center" class="listing-name-grey-total">{$assostats[0].tot}</td>
     </tr>
     <tr>
       <td height="29" class="listing-name-grey-border-to">{$LBL_ORGANIZATION_ADMINS}</td>
       <td height="29" align="center" class="listing-name-grey-border-nomber">{if $orgadminstats[0].act_usr gt 0}<a onclick="showlist('adm','act');" style="cursor:pointer;">{/if}&nbsp;{$orgadminstats[0].act_usr}&nbsp;{if $orgadminstats[0].act_usr gt 0}&nbsp;</a>{/if}</td>
       <td height="29" align="center" class="listing-name-grey-border-nomber">{if $orgadminstats[0].inact_usr gt 0}<a onclick="showlist('adm','inact');" style="cursor:pointer;">{/if}&nbsp;{$orgadminstats[0].inact_usr}&nbsp;{if $orgadminstats[0].inact_usr gt 0}&nbsp;</a>{/if}</td>
       <td height="29" align="center" class="listing-name-grey-border-nomber">{if $orgadminstats[0].verify_usr gt 0}<a onclick="showlist('adm','nvfy');" style="cursor:pointer;">{/if}&nbsp;{$orgadminstats[0].verify_usr}&nbsp;{if $orgadminstats[0].verify_usr gt 0}<a onclick="showlist('adm','act');" style="cursor:pointer;">{/if}</td>
       <td height="29" align="center" class="listing-name-grey-total">{$orgadminstats[0].tot}</td>
     </tr>
     <tr>
       <td height="29" class="listing-name-grey-border-to">{$LBL_USERS}</td>
       <td height="29" align="center" class="listing-name-grey-border-nomber">{if $orguserstats[0].act_usr gt 0}<a onclick="showlist('usr','act');" style="cursor:pointer;">{/if}&nbsp;{$orguserstats[0].act_usr}&nbsp;{if $orguserstats[0].act_usr gt 0}</a>{/if}</td>
       <td height="29" align="center" class="listing-name-grey-border-nomber">{if $orguserstats[0].inact_usr gt 0}<a onclick="showlist('usr','inact');" style="cursor:pointer;">{/if}&nbsp;{$orguserstats[0].inact_usr}&nbsp;{if $orguserstats[0].inact_usr gt 0}</a>{/if}</td>
       <td height="29" align="center" class="listing-name-grey-border-nomber">{if $orguserstats[0].verify_usr gt 0}<a onclick="showlist('usr','nvfy');" style="cursor:pointer;">{/if}&nbsp;{$orguserstats[0].verify_usr}&nbsp;{if $orguserstats[0].verify_usr gt 0}</a>{/if}</td>
       <td height="29" align="center"class="listing-name-grey-total" >{$orguserstats[0].tot}</td>
     </tr>
     <tr>
        <td height="29" class="listing-name-grey-border-to">{$LBL_USER_RIGHTS}</td>
        <td height="29" align="center" class="listing-name-grey-border-nomber-1">{if $userrightsstats[0].actrec gt 0}<a onclick="showlist('vur','act');" style="cursor:pointer;">{/if}&nbsp;{$userrightsstats[0].actrec}&nbsp;{if $userrightsstats[0].actrec gt 0}</a>{/if}</td>
        <td height="29" align="center" class="listing-name-grey-border-nomber-1">{if $userrightsstats[0].inactrec gt 0}<a onclick="showlist('vur','inact');" style="cursor:pointer;">{/if}&nbsp;{$userrightsstats[0].inactrec}&nbsp;{if $userrightsstats[0].inactrec gt 0}</a>{/if}</td>
        <td height="29" align="center" class="listing-name-grey-border-nomber-1">{if $userrightsstats[0].verify_org gt 0}<a onclick="showlist('vur','nvfy');" style="cursor:pointer;">{/if}&nbsp;{$userrightsstats[0].verify_org}&nbsp;{if $userrightsstats[0].verify_org gt 0}</a>{/if}</td>
        <td height="29" align="center" class="listing-name-grey-total-1">{$userrightsstats[0].tot}</td>
     </tr>
     <tr>
        <td height="29" class="listing-name-grey-border-to">{$LBL_GROUPS}</td>
        <td height="29" align="center" class="listing-name-grey-border-nomber-1">{if $grpstats[0].act_org gt 0}<a onclick="showlist('grp','act');" style="cursor:pointer;">{/if}&nbsp;{$grpstats[0].act_org}&nbsp;{if $grpstats[0].act_org gt 0}</a>{/if}</td>
        <td height="29" align="center" class="listing-name-grey-border-nomber-1">{if $grpstats[0].inact_org gt 0}<a onclick="showlist('grp','inact');" style="cursor:pointer;">{/if}&nbsp;{$grpstats[0].inact_org}&nbsp;{if $grpstats[0].inact_org gt 0}</a>{/if}</td>
        <td height="29" align="center" class="listing-name-grey-border-nomber-1">{if $grpstats[0].verify_org gt 0}<a onclick="showlist('grp','nvfy');" style="cursor:pointer;">{/if}&nbsp;{$grpstats[0].verify_org}&nbsp;{if $grpstats[0].verify_org gt 0}</a>{/if}</td>
        <td height="29" align="center" class="listing-name-grey-total-1">{$grpstats[0].tot}</td>
     </tr>
     <tr><td colspan="5" class="listing-name-grey-border-to-1" style="height:1px;"></td></tr>
   </table>
	</div>
   </div>
   <div class="login-box">
      <h2><img class="plusminus-img" src="{$SITE_IMAGES}sm_images/minus-icon.gif" /> {$LBL_LAST_3_LOGIN}</h2>
      <div class="login-text"  style="height:192px;">
        {section name=l loop=$lastlogins}
             <p>
             {$LBL_LAST_LOGIN} : {$lastlogins[l].dLoginDate|calcLTzTime|DateTime:7} <br />
			 {$LBL_IP_ADDRESS} : {$lastlogins[l].vIP}
             </p>
	{sectionelse}
            <p>
                {$LBL_NO_REC_AVAILABLE}
            </p>
	{/section}
      </div>
   </div>
</div>

<div class="organization-main-box column" id="foo_2">
<div class="organization-box"><h2><img class="plusminus-img" src="{$SITE_IMAGES}sm_images/minus-icon.gif" /> {$LBL_ORGANIZATION}</h2>
   <div class="organization-text">
	{section name=ln loop=$activeorgs}
	<h3><a href="{$SITE_URL_DUM}organizationview/{$activeorgs[ln].iOrganizationID}">{$activeorgs[ln].vCompanyName}</a></h3>
   <p>
      Registration No.<span> {$activeorgs[ln].vCompanyRegNo}</span>
      Country :<span> {$activeorgs[ln].vCountryName}</span><br />
      Verified By :<span> {$activeorgs[ln].vVerifiedBy}</span><br/>
		Email :<a href="mailto:{$activeorgs[ln].vEmail}"><span> {$activeorgs[ln].vEmail}</span></a>
   </p>
	{sectionelse}
	<p>
	{$LBL_NO_REC_AVAILABLE}
	</p>
	{/section}
	{if $tot_activeorgs>3}
	<em><a href="{$SITE_URL_DUM}organizationlist">{$LBL_VIEW_MORE}</a></em>
	{/if}
   </div>
</div>
<div class="organization-to-verify-box column">
   <h2><img class="plusminus-img" src="{$SITE_IMAGES}sm_images/minus-icon.gif" /> {$LBL_ORG_VERIFY}</h2>
   <div class="organization-to-verify-text">
	{section name=n loop=$orgstoverify}
              <h3><a href="{$SITE_URL_DUM}organizationview/{$orgstoverify[n].iOrganizationID}">{$orgstoverify[n].vCompanyName}</a></h3>
              <p>
                 Registration No.<span> {$orgstoverify[n].vCompanyRegNo}</span>
                                Date :<span> {$orgstoverify[n].dCreatedDate|calcLTzTime|DateTime:10}</span><br/>
                 Country :<span> {$orgstoverify[n].vCountryName}</span><br />
                 Email : <a href="mailto:{$orgstoverify[n].vEmail}"> <span>{$orgstoverify[n].vEmail}</span></a>
              </p>
        {sectionelse}
            <p>{$LBL_NO_REC_AVAILABLE}
            </p>
        {/section}
        {if $tot_orgstoverify>3}
            <em><a href="{$SITE_URL_DUM}verifyorganization">{$LBL_VIEW_MORE}</a></em>
        {/if}
   </div>
</div>
</div>
<div class="association-main-box column" id="foo_3">
   <h2><img class="plusminus-img" src="{$SITE_IMAGES}sm_images/minus-icon.gif" /> {$LBL_ASSOCIATIONS}</h2>
	{section name=j loop=$activeassocs}
   <div class="association-text">
		{if $activeassocs[j].eStatus eq 'Need to Verify' || $activeassocs[j].eStatus eq 'Modified'}
			{assign var=v value="/verify"}
		{/if}
      <h3><a href="{$SITE_URL_DUM}associationview/{$activeassocs[j].iAsociationID}{$v}">{$activeassocs[j].vBuyerOrg}</a></h3>
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

{if $ENABLE_AUCTION eq 'Yes'}
<div class="association-main-box column" id="foo_4">
   <h2><img class="plusminus-img" src="{$SITE_IMAGES}sm_images/minus-icon.gif" /> {$LBL_BUYER}2 {$LBL_ASSOCIATIONS} &nbsp; ({$LBL_AUCTION_TENDER})</h2>
   <div class="association-text">
		<h3>{$LBL_BUYER2_BPRODUCT} {$LBL_ASSOCIATION}</h3>
      <p>
			{$LBL_BUYER2}:<span> {$b2bpr_dtls[0].vBuyer2}</span>
			{$LBL_DATE} :<span> {$b2bpr_dtls[0].dADate|calcLTzTime|DateTime:10}</span><br/>
         {$LBL_BPRODUCT}: <span>{$b2bpr_dtls[0].vProduct}</span><br />
         {$LBL_CODE}: <span><a href="{$SITE_URL_DUM}b2bprodtasocview/{$b2bpr_dtls[0].iAssociationId}" style="text-decoration:underline;">{$b2bpr_dtls[0].vACode}</a></span><br />
			{if $b2bpr_dtls[0].eStatus neq 'Need to Verify' && $b2bpr_dtls[0].eStatus neq 'Modified' && $b2bpr_dtls[0].eNeedToVerify neq 'Yes'}
			   {if $b2bpr_dtls[0].vVerifiedBy neq ''}Verified By :<span> {$b2bpr_dtls[0].vVerifiedBy}</span>{/if}
			{else} {$LBL_STATUS} :<span> {$b2bpr_dtls[0].eStatus} {*}{$LBL_NEED_TO_VERIFY}{*}</span> {/if}
      </p>
   </div>
   <div class="association-text">
		<h3>{$LBL_BUYER2_SPRODUCT} {$LBL_ASSOCIATION}</h3>
      <p>
			{$LBL_BUYER2}:<span> {$b2spr_dtls[0].vBuyer2}</span>
			{$LBL_DATE} :<span> {$b2spr_dtls[0].dADate|calcLTzTime|DateTime:10}</span><br/>
         {$LBL_BPRODUCT}: <span>{$b2spr_dtls[0].vProduct}</span><br />
         {$LBL_CODE}: <span><a href="{$SITE_URL_DUM}b2bprodtasocview/{$b2spr_dtls[0].iAssociationId}" style="text-decoration:underline;">{$b2spr_dtls[0].vACode}</a></span><br />
			{if $b2spr_dtls[0].eStatus neq 'Need to Verify' && $b2spr_dtls[0].eStatus neq 'Modified' && $b2spr_dtls[0].eNeedToVerify neq 'Yes'}
			   {if $b2spr_dtls[0].vVerifiedBy neq ''}Verified By :<span> {$b2spr_dtls[0].vVerifiedBy}</span>{/if}
			{else} {$LBL_STATUS} :<span> {$b2spr_dtls[0].eStatus} {*}{$LBL_NEED_TO_VERIFY}{*}</span> {/if}
      </p>
   </div>
   <div class="clear">&nbsp;</div>
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
	<div class="clear">&nbsp;</div>
	<div class="association-text">
	<h3>{$LBL_BUYER2_BUYER} {$LBL_ASSOCIATION}</h3>
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
   <div class="association-text">
		<h3>{$LBL_BUYER2_SUPPLIER} {$LBL_ASSOCIATION}</h3>
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
</div>

<div class="association-main-box column" id="foo_5">
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
        <tr>
          <td height="29" class="listing-name-grey-border-to">{$LBL_BUYER2_BPRODUCT} {$LBL_ASSOCIATION}</td>
          <td height="29" align="center" class="listing-name-grey-border-nomber">{if $b2asocstats[0].actrec gt 0}<a onclick="showlist('b2bprodtasoclist','act');" style="cursor:pointer;">{/if}&nbsp;{$b2asocstats[0].actrec}&nbsp;{if $b2asocstats[0].actrec gt 0}</a>{/if}</td>
          <td height="29" align="center" class="listing-name-grey-border-nomber">{if $b2asocstats[0].inactrec gt 0}<a onclick="showlist('b2bprodtasoclist','inact');" style="cursor:pointer;">{/if}&nbsp;{$b2asocstats[0].inactrec}&nbsp;{if $b2asocstats[0].inactrec gt 0}</a>{/if}</td>
          <td height="29" align="center" class="listing-name-grey-border-nomber">{if $b2asocstats[0].verifyrec gt 0}<a onclick="showlist('b2bprodtasocvlist','nvfy');" style="cursor:pointer;">{/if}&nbsp;{$b2asocstats[0].verifyrec}&nbsp;{if $b2asocstats[0].verifyrec gt 0}</a>{/if}</td>
          <td height="29" align="center" class="listing-name-grey-total">{$b2asocstats[0].tot}</td>
        </tr>
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
        <tr>
          <td height="29" class="listing-name-grey-border-to">{$LBL_BUYER2_SPRODUCT} {$LBL_ASSOCIATION}</td>
          <td height="29" align="center" class="listing-name-grey-border-nomber">{if $b2asocstats[3].actrec gt 0}<a onclick="showlist('b2sprodtasoclist','act');" style="cursor:pointer;">{/if}&nbsp;{$b2asocstats[3].actrec}&nbsp;{if $b2asocstats[3].actrec gt 0}</a>{/if}</td>
          <td height="29" align="center" class="listing-name-grey-border-nomber">{if $b2asocstats[3].inactrec gt 0}<a onclick="showlist('b2sprodtasoclist','inact');" style="cursor:pointer;">{/if}&nbsp;{$b2asocstats[3].inactrec}&nbsp;{if $b2asocstats[3].inactrec gt 0}</a>{/if}</td>
          <td height="29" align="center" class="listing-name-grey-border-nomber">{if $b2asocstats[3].verifyrec gt 0}<a onclick="showlist('b2sprodtasocvlist','nvfy');" style="cursor:pointer;">{/if}&nbsp;{$b2asocstats[3].verifyrec}&nbsp;{if $b2asocstats[3].verifyrec gt 0}</a>{/if}</td>
          <td height="29" align="center" class="listing-name-grey-total">{$b2asocstats[3].tot}</td>
        </tr>
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
        <tr><td colspan="5" class="listing-name-grey-border-to-1" style="height:1px;"></td></tr>
      </table>
   </div>
   <div class="clear">&nbsp;</div>
</div>
{/if}

<div class="inbox-main-box column" id="foo_6">
   <h2><img class="plusminus-img" src="{$SITE_IMAGES}sm_images/minus-icon.gif" /> {$LBL_INBOX} ({$totInboxres})</h2>
   <div class="clear">
      <table width="98%" border="0" align="center" cellpadding="0" class="user-text" cellspacing="0">
         <!--<tr>
            <td width="42" height="30" align="center">&nbsp;</td>
            <td width="598">&nbsp;</td>
            <td width="87" align="center"><a href="#"><img src="{$SITE_IMAGES}sm_images/btn-delete-1.gif" alt="" border="0" /></a></td>
         </tr>-->
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
</div>
<form name="golist" id="golist" method="post" action="">
<input type="hidden" name="srchfor" id="srchfor" value="" />
<input type="hidden" name="srchval" id="srchval" value="" />
</form>
</div>
{literal}
<script type="text/javascript">
var cookie = '{/literal}{$tDashboard}{literal}';
</script>
{/literal}
<script type="text/javascript" src="{$SITE_JS_AJAX}jdashboard.js"></script>