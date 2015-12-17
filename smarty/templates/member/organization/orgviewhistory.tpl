<div class="middle-container" >
   <h1 align="center" ><span>{$orgdtls[0].vCompanyName} <span>({$orgdtls[0].vOrganizationCode})</span></h1>
   <br/>
   <div class="middle-containt">
      <div><center>
         <table border="1" cellpadding="3" cellspacing="0" style="border:1px solid #cccccc;">
            <tr><td width="100px"><b>{$LBL_ACTION}</b></td><td width="190px"><b>{$LBL_BY}</b></td><td width="250px"><b>{$LBL_DATE_TIME}</b></td></tr>
           {section name=i loop=$orghistory}
               {if $orghistory[i].iASMID>0 && ($orghistory[i].iModifiedByID eq '' || $orghistory[i].iModifiedByID eq '0') || $smarty.section.i.index eq 0}
                  <tr><td width="100px">{$LBL_CREATE}</td><td width="190px">{if $orghistory[i].eSelfReg eq 'Yes'}{$LBL_SELF_REGISTERED}{else}{$orghistory[i].createdby}{/if}</td><td width="250px">{$orghistory[i].dCreatedDate|DateTime:'7'}</td></tr>
                    {if $orghistory[i].iRejectedById neq '' && $orghistory[i].iRejectedById gt 0}
                    <tr><td width="100px">{$LBL_REJECTED}</td><td width="190px">{$orghistory[i].rejectedby}</td><td width="250px">{$orghistory[i].dRejectedDate|DateTime:'7'}</td></tr>
						  {elseif $orghistory[i].iVerifiedSMID neq '' && $orghistory[i].iVerifiedSMID gt 0}
                    <tr><td width="100px">{$LBL_VERIFIED}</td><td width="190px">{$orghistory[i].verifiedby}</td><td width="250px">{$orghistory[i].dVerifiedDate|DateTime:'7'}</td></tr>
                    {/if}
               {elseif $orghistory[i].iModifiedByID neq '' && $orghistory[i].iModifiedByID>0}
                  <tr><td width="100px">{$LBL_MODIFIED}</td><td width="190px">{$orghistory[i].modifiedby}</td><td width="250px">{$orghistory[i].dModifiedDate|DateTime:'7'}</td></tr>
                    {if $orghistory[i].iRejectedById neq '' && $orghistory[i].iRejectedById gt 0}
                    <tr><td width="100px">{$LBL_REJECTED}</td><td width="190px">{$orghistory[i].rejectedby}</td><td width="250px">{$orghistory[i].dRejectedDate|DateTime:'7'}</td></tr>
						  {elseif $orghistory[i].iVerifiedSMID neq '' && $orghistory[i].iVerifiedSMID gt 0 && ($orghistory[i].eStatus neq 'Need to Verify' && $orghistory[i].eStatus neq 'Modified' && $orghistory[i].eStatus neq 'Delete' && $orghistory[i].eNeedToVerify neq 'Yes')}
                    <tr><td width="100px">{$LBL_VERIFIED}</td><td width="190px">{$orghistory[i].verifiedby}</td><td width="250px">{$orghistory[i].dVerifiedDate|DateTime:'7'}</td></tr>
                    {/if}
               {/if}
            {sectionelse}
               <tr><td align="center" colspan="3">{$LBL_NO_REC_AVAILABLE}</td></tr>
           {/section}
         </table>
      </center>
      </div>
   </div>
</div>

{*}<div class="middle-container" >
   <h1 align="center" ><span>{$orgdtls[0].vCompanyName} <span>({$orgdtls[0].vOrganizationCode})</span></h1>
   <br/>
   <div class="middle-containt">
      <div><center>
         <div id="history" class="historybox" style="margin:5px; padding:5px;">
            <div id="heading" style="margin:1px; padding:1px; border:1px solid #cccccc;" >
					<span style="display:inline-block; width:100px; margin:1px; padding:1px;">{$LBL_ACTION}</span><span style="display:inline-block; width:190px; margin:1px; padding:1px;">{$LBL_BY}</span><span style="display:inline-block; width:250px; margin:1px; padding:1px;">{$LBL_DATE_TIME}</span>
				</div>
           {section name=i loop=$orghistory}
              <div style="border:1px solid #cccccc;" >
                 {if $orghistory[i].iASMID>0 && ($orghistory[i].iModifiedByID eq '' || $orghistory[i].iModifiedByID eq '0')}
                  <!--<span style="width:10px; display:inline-block;">&rarr;</span>-->
                  <span style="display:inline-block; width:100px; margin:1px; padding:1px;">{$LBL_CREATE}</span><span style="display:inline-block; width:190px; margin:1px; padding:1px;">{$orghistory[i].createdby}</span><span style="display:inline-block; width:250px; margin:1px; padding:1px;">{$orghistory[i].dCreatedDate|DateTime:'7'}</span>
                    {if $orghistory[i].iVerifiedSMID neq '' && $orghistory[i].iVerifiedSMID gt 0}
                    <br/>
                    <span style="display:inline-block; width:100px; margin:1px; padding:1px;">{$LBL_VERIFIED}</span><span style="display:inline-block; width:190px; margin:1px; padding:1px;">{$orghistory[i].verifiedby}</span><span style="display:inline-block; width:250px; margin:1px; padding:1px;">{$orghistory[i].dVerifiedDate|DateTime:'7'}</span>
                    {elseif $orghistory[i].iRejectedById neq '' && $orghistory[i].iRejectedById gt 0}
						  <br/>
                    <span style="display:inline-block; width:100px; margin:1px; padding:1px;">{$LBL_REJECTED}</span><span style="display:inline-block; width:190px; margin:1px; padding:1px;">{$orghistory[i].rejectedby}</span><span style="display:inline-block; width:250px; margin:1px; padding:1px;">{$orghistory[i].dRejectedDate|DateTime:'7'}</span>
                    {/if}
                 {elseif $orghistory[i].iModifiedByID neq '' && $orghistory[i].iModifiedByID>0}
                  <span style="display:inline-block; width:100px; margin:1px; padding:1px;">{$LBL_MODIFIED}</span><span style="display:inline-block; width:190px; margin:1px; padding:1px;">{$orghistory[i].modifiedby}</span><span style="display:inline-block; width:250px; margin:1px; padding:1px;">{$orghistory[i].dModifiedDate|DateTime:'7'}</span>
                    {if $orghistory[i].iVerifiedSMID neq '' && $orghistory[i].iVerifiedSMID gt 0 && ($orghistory[i].eStatus neq 'Need to Verify' && $orghistory[i].eStatus neq 'Modified' && $orghistory[i].eStatus neq 'Delete' && $orghistory[i].eNeedToVerify neq 'Yes')}
                    <br/>
                    <span style="display:inline-block; width:100px; margin:1px; padding:1px;">{$LBL_VERIFIED}</span><span style="display:inline-block; width:190px; margin:1px; padding:1px;">{$orghistory[i].verifiedby}</span><span style="display:inline-block; width:250px; margin:1px; padding:1px;">{$orghistory[i].dVerifiedDate|DateTime:'7'}</span>
                    {elseif $orghistory[i].iRejectedById neq '' && $orghistory[i].iRejectedById gt 0}
						  <br/>
                    <span style="display:inline-block; width:100px; margin:1px; padding:1px;">{$LBL_REJECTED}</span><span style="display:inline-block; width:190px; margin:1px; padding:1px;">{$orghistory[i].rejectedby}</span><span style="display:inline-block; width:250px; margin:1px; padding:1px;">{$orghistory[i].dRejectedDate|DateTime:'7'}</span>
                    {/if}
                 {/if}
              </div>
            {sectionelse}
					<div style="text-align:center;"><br/><br/><br/><p>{$LBL_NO_REC_AVAILABLE}</p></div>
           {/section}
         </div>
      </center>
      </div>
   </div>
</div>
{*}