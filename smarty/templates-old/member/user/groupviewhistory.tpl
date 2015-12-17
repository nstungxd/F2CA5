<div class="middle-container" >
   <h1 align="center" >{$grpdtls[0].vGroupName}</h1>
   <br/>
   <div class="middle-containt">
      <div><center>
         <table border="1" cellpadding="3" cellspacing="0" style="border:1px solid #cccccc;">
            <tr><td width="100px"><b>{$LBL_ACTION}</b></td><td width="190px"><b>{$LBL_BY}</b></td><td width="250px"><b>{$LBL_DATE_TIME}</b></td></tr>
           {section name=i loop=$grouphistory}
                 {if $grouphistory[i].iCreatedID>0 && ($grouphistory[i].iModifiedByID eq '' || $grouphistory[i].iModifiedByID eq '0') || $smarty.section.i.index eq 0}
						<tr><td width="100px">{$LBL_CREATE}</td><td width="190px">{$grouphistory[i].createdby}</td><td width="250px">{$grouphistory[i].dCreatedDate|DateTime:'7'}</td></tr>
                    {if $grouphistory[i].iRejectedById neq '' && $grouphistory[i].iRejectedById gt 0}
						  <tr><td width="100px">{$LBL_REJECTED}</td><td width="190px">{$grouphistory[i].rejectedby}</td><td width="250px">{$grouphistory[i].dRejectedDate|DateTime:'7'}</td></tr>
						  {elseif $grouphistory[i].iVerifiedByID neq '' && $grouphistory[i].iVerifiedByID gt 0}
                    <tr><td width="100px">{$LBL_VERIFIED}</td><td width="190px">{$grouphistory[i].verifiedby}</td><td width="250px">{$grouphistory[i].dVerifiedDate|DateTime:'7'}</td></tr>
                    {/if}
                 {elseif $grouphistory[i].iModifiedByID neq '' && $grouphistory[i].iModifiedByID>0}
						<tr><td width="100px">{$LBL_MODIFIED}</td><td width="190px">{$grouphistory[i].modifiedby}</td><td width="250px">{$grouphistory[i].dModifiedDate|DateTime:'7'}</td></tr>
                    {if $grouphistory[i].iRejectedById neq '' && $grouphistory[i].iRejectedById gt 0}
						  <tr><td width="100px">{$LBL_REJECTED}</td><td width="190px">{$grouphistory[i].rejectedby}</td><td width="250px">{$grouphistory[i].dRejectedDate|DateTime:'7'}</td></tr>
						  {elseif $grouphistory[i].iVerifiedByID neq '' && $grouphistory[i].iVerifiedByID gt 0 && ($grouphistory[i].eStatus neq 'Need to Verify' && $grouphistory[i].eStatus neq 'Modified' && $grouphistory[i].eStatus neq 'Delete' && $grouphistory[i].eNeedToVerify neq 'Yes')}
                    <tr><td width="100px">{$LBL_VERIFIED}</td><td width="190px">{$grouphistory[i].verifiedby}</td><td width="250px">{$grouphistory[i].dVerifiedDate|DateTime:'7'}</td></tr>
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