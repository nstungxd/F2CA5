<div class="middle-container" >
   <h1 align="center" ><span>{$orgdtls[0].vCompanyName} <span>({$orgdtls[0].vOrganizationCode})</span></h1>
   <br/>
   <div class="middle-containt">
      <div>
          <div id="history" class="historybox">
          {section name=i loop=$orgprefhistory}
               <div>&nbsp;</div>
               <div>
                 {if $orgprefhistory[i].iCreatedBy>0 && ($orgprefhistory[i].iModifiedByID eq '' || $orgprefhistory[i].iModifiedByID eq '0') || $smarty.section.i.index eq 0}
                 &rarr;
                    {$LBL_CREATED_BY} {$orgprefhistory[i].createdby} {$LBL_AT} {$orgprefhistory[i].dCreatedDate|DateTime:'7'}
                    {if $orgprefhistory[i].iVerifiedByID neq '' && $orgprefhistory[i].iVerifiedByID gt 0}
                    <br/> &nbsp;&nbsp;
                    &nbsp; {$LBL_VERIFIED_BY} {$orgprefhistory[i].verifiedby} {$LBL_AT} {$orgprefhistory[i].dVerifiedDate|DateTime:'7'}
                    {elseif $orgprefhistory[i].iRejectedById neq '' && $orgprefhistory[i].iRejectedById gt 0}
						  <br/> &nbsp;&nbsp;
                    &nbsp; {$LBL_REJECTED_BY} {$orgprefhistory[i].rejectedby} {$LBL_AT} {$orgprefhistory[i].dRejectedDate|DateTime:'7'}
                    {/if}
                 {elseif $orgprefhistory[i].iModifiedByID neq '' && $orgprefhistory[i].iModifiedByID>0}
                 &rarr;
                    {$LBL_MODIFIED_BY} {$orgprefhistory[i].modifiedby} {$LBL_AT} {$orgprefhistory[i].dModifiedDate|DateTime:'7'}
                    {if $orgprefhistory[i].iVerifiedByID neq '' && $orgprefhistory[i].iVerifiedByID gt 0 && ($orgprefhistory[i].eStatus neq 'Need to Verify' && $orgprefhistory[i].eStatus neq 'Modified' && $orgprefhistory[i].eStatus neq 'Delete' && $orgprefhistory[i].eNeedToVerify neq 'Yes')}
                    <br/> &nbsp;&nbsp;
                    &nbsp; {$LBL_VERIFIED_BY} {$orgprefhistory[i].verifiedby} {$LBL_AT} {$orgprefhistory[i].dVerifiedDate|DateTime:'7'}
                    {elseif $orgprefhistory[i].iRejectedById neq '' && $orgprefhistory[i].iRejectedById gt 0}
						  <br/> &nbsp;&nbsp;
                    &nbsp; {$LBL_REJECTED_BY} {$orgprefhistory[i].rejectedby} {$LBL_AT} {$orgprefhistory[i].dRejectedDate|DateTime:'7'}
                    {/if}
                 {/if}
               </div>
          {sectionelse}
					<div style="text-align:center;"><br/><br/><br/><p>{$LBL_NO_REC_AVAILABLE}</p></div>
          {/section}
      </div>
   </div>
</div>