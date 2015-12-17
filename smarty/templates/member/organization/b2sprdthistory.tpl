<div class="middle-container" >
   <h1 align="center" ><span>{$LBL_ASSOCIATION} ({$b2sprdtls[0].vACode})</span></h1>
   <br/>
   <div class="middle-containt">
      <div><center>
         <table border="1" cellpadding="3" cellspacing="0" style="border:1px solid #cccccc;">
            <tr><td width="100px"><b>{$LBL_ACTION}</b></td><td width="190px"><b>{$LBL_BY}</b></td><td width="250px"><b>{$LBL_DATE_TIME}</b></td></tr>
           {section name=i loop=$b2sprdthistory}
               {if $b2sprdthistory[i].iASMID>0 && ($b2sprdthistory[i].iModifiedByID eq '' || $b2sprdthistory[i].iModifiedByID eq '0') || $smarty.section.i.index eq 0}
                  <tr><td width="100px">{$LBL_CREATE}</td><td width="190px">{$b2sprdthistory[i].createdby}</td><td width="250px">{$b2sprdthistory[i].dADate|DateTime:'7'}</td></tr>
                    {if $b2sprdthistory[i].iRejectedByID neq '' && $b2sprdthistory[i].iRejectedByID gt 0}
                    <tr><td width="100px">{$LBL_REJECTED}</td><td width="190px">{$b2sprdthistory[i].rejectedby}</td><td width="250px">{$b2sprdthistory[i].dRejectedDate|DateTime:'7'}</td></tr>
						  {elseif $b2sprdthistory[i].iVerifiedByID neq '' && $b2sprdthistory[i].iVerifiedByID gt 0}
                    <tr><td width="100px">{$LBL_VERIFIED}</td><td width="190px">{$b2sprdthistory[i].verifiedby}</td><td width="250px">{$b2sprdthistory[i].dVerifiedDate|DateTime:'7'}</td></tr>
                    {/if}
               {elseif $b2sprdthistory[i].iModifiedByID neq '' && $b2sprdthistory[i].iModifiedByID>0}
                  <tr><td width="100px">{$LBL_MODIFIED}</td><td width="190px">{$b2sprdthistory[i].modifiedby}</td><td width="250px">{$b2sprdthistory[i].dModifiedDate|DateTime:'7'}</td></tr>
                    {if $b2sprdthistory[i].iRejectedByID neq '' && $b2sprdthistory[i].iRejectedByID gt 0}
                    <tr><td width="100px">{$LBL_REJECTED}</td><td width="190px">{$b2sprdthistory[i].rejectedby}</td><td width="250px">{$b2sprdthistory[i].dRejectedDate|DateTime:'7'}</td></tr>
						  {elseif $b2sprdthistory[i].iVerifiedByID neq '' && $b2sprdthistory[i].iVerifiedByID gt 0 && ($b2sprdthistory[i].eStatus neq 'Need to Verify' && $b2sprdthistory[i].eStatus neq 'Modified' && $b2sprdthistory[i].eStatus neq 'Delete' && $b2sprdthistory[i].eNeedToVerify neq 'Yes')}
                    <tr><td width="100px">{$LBL_VERIFIED}</td><td width="190px">{$b2sprdthistory[i].verifiedby}</td><td width="250px">{$b2sprdthistory[i].dVerifiedDate|DateTime:'7'}</td></tr>
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