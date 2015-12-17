<div class="middle-container" >
   <h1 align="center" >{$usrdtls[0].vFirstName} {$usrdtls[0].vLastName}</h1>
   <br/>
   <div class="middle-containt">
      <div><center>
         <table border="1" cellpadding="3" cellspacing="0" style="border:1px solid #cccccc;">
            <tr><td width="100px"><b>{$LBL_ACTION}</b></td><td width="190px"><b>{$LBL_BY}</b></td><td width="250px"><b>{$LBL_DATE_TIME}</b></td></tr>
          {section name=i loop=$usrhistory}
                 {if $usrhistory[i].iCreatedBy>0 && ($usrhistory[i].iModifiedByID eq '' || $usrhistory[i].iModifiedByID eq '0') || $smarty.section.i.index eq 0}
                 	<tr><td width="100px">{$LBL_CREATE}</td><td width="190px">{if $usrhistory[i].eSelfReg eq 'Yes'}{$LBL_SELF_REGISTERED}{else}{$usrhistory[i].createdby}{/if}</td><td width="250px">{$usrhistory[i].dCreatedDate|DateTime:'7'}</td></tr>
                    {if $usrhistory[i].iRejectedById neq '' && $usrhistory[i].iRejectedById gt 0}
						  <tr><td width="100px">{$LBL_REJECTED}</td><td width="190px">{$usrhistory[i].rejectedby}</td><td width="250px">{$usrhistory[i].dRejectedDate|DateTime:'7'}</td></tr>
						  {elseif $usrhistory[i].iVerifiedSMID neq '' && $usrhistory[i].iVerifiedSMID gt 0}
                    <tr><td width="100px">{$LBL_VERIFIED}</td><td width="190px">{$usrhistory[i].verifiedby}</td><td width="250px">{$usrhistory[i].dVerifiedDate|DateTime:'7'}</td></tr>
                    {/if}
                 {elseif $usrhistory[i].iModifiedByID neq '' && $usrhistory[i].iModifiedByID>0}
						<tr><td width="100px">{$LBL_MODIFIED}</td><td width="190px">{$usrhistory[i].modifiedby}</td><td width="250px">{$usrhistory[i].dModifiedDate|DateTime:'7'}</td></tr>
                    {if $usrhistory[i].iRejectedById neq '' && $usrhistory[i].iRejectedById gt 0}
						  <tr><td width="100px">{$LBL_REJECTED}</td><td width="190px">{$usrhistory[i].rejectedby}</td><td width="250px">{$usrhistory[i].dRejectedDate|DateTime:'7'}</td></tr>
						  {elseif $usrhistory[i].iVerifiedSMID neq '' && $usrhistory[i].iVerifiedSMID gt 0 && ($usrhistory[i].eStatus neq 'Need to Verify' && $usrhistory[i].eStatus neq 'Modified' && $usrhistory[i].eStatus neq 'Delete' && $usrhistory[i].eNeedToVerify neq 'Yes')}
                    <tr><td width="100px">{$LBL_VERIFIED}</td><td width="190px">{$usrhistory[i].verifiedby}</td><td width="250px">{$usrhistory[i].dVerifiedDate|DateTime:'7'}</td></tr>
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