<div class="middle-container" >
   <h1 align="center" >{$usrdtls[0].vFirstName} {$usrdtls[0].vLastName}</h1>
   <br/>
   <div class="middle-containt">
      <div><center>
         <table border="1" cellpadding="3" cellspacing="0" style="border:1px solid #cccccc;">
           <tr><td width="100px"><b>{$LBL_ACTION}</b></td><td width="190px"><b>{$LBL_BY}</b></td><td width="250px"><b>{$LBL_DATE_TIME}</b></td></tr>
           {section name=i loop=$urightshistory}
                 {if $urightshistory[i].iCreatedBy>0 && ($urightshistory[i].iModifiedByID eq '' || $urightshistory[i].iModifiedByID eq '0') || $smarty.section.i.index eq 0}
						  <tr><td width="100px">{$LBL_CREATE}</td><td width="190px">{$urightshistory[i].createdby}</td><td width="250px">{$urightshistory[i].dDate|DateTime:'7'}</td></tr>
                    {if $urightshistory[i].iVerifiedSMID neq '' && $urightshistory[i].iVerifiedSMID gt 0}
                    <tr><td width="100px">{$LBL_VERIFIED}</td><td width="190px">{$urightshistory[i].verifiedby}</td><td width="250px">{$urightshistory[i].dVerifiedDate|DateTime:'7'}</td></tr>
                    {elseif $urightshistory[i].iRejectedById neq '' && $urightshistory[i].iRejectedById gt 0}
						  <tr><td width="100px">{$LBL_REJECTED}</td><td width="190px">{$urightshistory[i].rejectedby}</td><td width="250px">{$urightshistory[i].dRejectedDate|DateTime:'7'}</td></tr>
                    {/if}
                 {elseif $urightshistory[i].iModifiedByID neq '' && $urightshistory[i].iModifiedByID>0}
						  <tr><td width="100px">{$LBL_MODIFIED}</td><td width="190px">{$urightshistory[i].modifiedby}</td><td width="250px">{$urightshistory[i].dModifiedDate|DateTime:'7'}</td></tr>
                    {if $urightshistory[i].iVerifiedSMID neq '' && $urightshistory[i].iVerifiedSMID gt 0 && ($urightshistory[i].eStatus neq 'Need to Verify' && $urightshistory[i].eStatus neq 'Modified' && $urightshistory[i].eStatus neq 'Delete' && $urightshistory[i].eNeedToVerify neq 'Yes')}
                    <tr><td width="100px">{$LBL_VERIFIED}</td><td width="190px">{$urightshistory[i].verifiedby}</td><td width="250px">{$urightshistory[i].dVerifiedDate|DateTime:'7'}</td></tr>
                    {elseif $urightshistory[i].iRejectedById neq '' && $urightshistory[i].iRejectedById gt 0}
						  <tr><td width="100px">{$LBL_REJECTED}</td><td width="190px">{$urightshistory[i].rejectedby}</td><td width="250px">{$urightshistory[i].dRejectedDate|DateTime:'7'}</td></tr>
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