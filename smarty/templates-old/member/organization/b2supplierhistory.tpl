<div class="middle-container">
   <h1 align="center" ><span>{$LBL_ASSOCIATION} ({$b2bprdtls[0].vACode})</span></h1>
   <br/>
   <div class="middle-containt">
      <div><center>
         <table border="1" cellpadding="3" cellspacing="0" style="border:1px solid #cccccc;">
            <tr><td width="100px"><b>{$LBL_ACTION}</b></td><td width="190px"><b>{$LBL_BY}</b></td><td width="250px"><b>{$LBL_DATE_TIME}</b></td></tr>
           {section name=i loop=$b2bprdthistory}
               {if $b2bprdthistory[i].iASMID>0 && ($b2bprdthistory[i].iModifiedByID eq '' || $b2bprdthistory[i].iModifiedByID eq '0') || $smarty.section.i.index eq 0}
                  <tr><td width="100px">{$LBL_CREATE}</td><td width="190px">{$b2bprdthistory[i].createdby}</td><td width="250px">{$b2bprdthistory[i].dADate|DateTime:'7'}</td></tr>
                    {if $b2bprdthistory[i].iRejectedByID neq '' && $b2bprdthistory[i].iRejectedByID gt 0}
                    <tr><td width="100px">{$LBL_REJECTED}</td><td width="190px">{$b2bprdthistory[i].rejectedby}</td><td width="250px">{$b2bprdthistory[i].dRejectedDate|DateTime:'7'}</td></tr>
						  {elseif $b2bprdthistory[i].iVerifiedByID neq '' && $b2bprdthistory[i].iVerifiedByID gt 0}
                    <tr><td width="100px">{$LBL_VERIFIED}</td><td width="190px">{$b2bprdthistory[i].verifiedby}</td><td width="250px">{$b2bprdthistory[i].dVerifiedDate|DateTime:'7'}</td></tr>
                    {/if}
               {elseif $b2bprdthistory[i].iModifiedByID neq '' && $b2bprdthistory[i].iModifiedByID>0}
                  <tr><td width="100px">{$LBL_MODIFIED}</td><td width="190px">{$b2bprdthistory[i].modifiedby}</td><td width="250px">{$b2bprdthistory[i].dModifiedDate|DateTime:'7'}</td></tr>
                    {if $b2bprdthistory[i].iRejectedByID neq '' && $b2bprdthistory[i].iRejectedByID gt 0}
                    <tr><td width="100px">{$LBL_REJECTED}</td><td width="190px">{$b2bprdthistory[i].rejectedby}</td><td width="250px">{$b2bprdthistory[i].dRejectedDate|DateTime:'7'}</td></tr>
						  {elseif $b2bprdthistory[i].iVerifiedByID neq '' && $b2bprdthistory[i].iVerifiedByID gt 0 && ($b2bprdthistory[i].eStatus neq 'Need to Verify' && $b2bprdthistory[i].eStatus neq 'Modified' && $b2bprdthistory[i].eStatus neq 'Delete' && $b2bprdthistory[i].eNeedToVerify neq 'Yes')}
                    <tr><td width="100px">{$LBL_VERIFIED}</td><td width="190px">{$b2bprdthistory[i].verifiedby}</td><td width="250px">{$b2bprdthistory[i].dVerifiedDate|DateTime:'7'}</td></tr>
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