<div class="middle-container" >
   <h1 align="center" ><span>{$LBL_ASSOCIATION} (#{$vAsocode})</span></h1>
   <br/>
   <div class="middle-containt">
      <div><center>
         <table border="1" cellpadding="3" cellspacing="0" style="border:1px solid #cccccc;">
            <tr><td width="100px"><b>{$LBL_ACTION}</b></td><td width="190px"><b>{$LBL_BY}</b></td><td width="250px"><b>{$LBL_DATE_TIME}</b></td></tr>
           {section name=i loop=$asochistory}
               {if $asochistory[i].iASMID>0 && ($asochistory[i].iModifiedByID eq '' || $asochistory[i].iModifiedByID eq '0') || $smarty.section.i.index eq 0}
                  <tr><td width="100px">{$LBL_CREATE}</td><td width="190px">{$asochistory[i].createdby}</td><td width="250px">{$asochistory[i].dCreatedDate|DateTime:'7'}</td></tr>
                    {if $asochistory[i].iRejectedById neq '' && $asochistory[i].iRejectedById gt 0}
                    <tr><td width="100px">{$LBL_REJECTED}</td><td width="190px">{$asochistory[i].rejectedby}</td><td width="250px">{$asochistory[i].dRejectedDate|DateTime:'7'}</td></tr>
						  {elseif $asochistory[i].iVerifiedSMID neq '' && $asochistory[i].iVerifiedSMID gt 0}
                    <tr><td width="100px">{$LBL_VERIFIED}</td><td width="190px">{$asochistory[i].verifiedby}</td><td width="250px">{$asochistory[i].dVerifiedDate|DateTime:'7'}</td></tr>
                    {/if}
               {elseif $asochistory[i].iModifiedByID neq '' && $asochistory[i].iModifiedByID>0}
                  <tr><td width="100px">{$LBL_MODIFIED}</td><td width="190px">{$asochistory[i].modifiedby}</td><td width="250px">{$asochistory[i].dModifiedDate|DateTime:'7'}</td></tr>
                    {if $asochistory[i].iRejectedById neq '' && $asochistory[i].iRejectedById gt 0}
                    <tr><td width="100px">{$LBL_REJECTED}</td><td width="190px">{$asochistory[i].rejectedby}</td><td width="250px">{$asochistory[i].dRejectedDate|DateTime:'7'}</td></tr>
						  {elseif $asochistory[i].iVerifiedSMID neq '' && $asochistory[i].iVerifiedSMID gt 0 && ($asochistory[i].eStatus neq 'Need to Verify' && $asochistory[i].eStatus neq 'Modified' && $asochistory[i].eStatus neq 'Delete' && $asochistory[i].eNeedToVerify neq 'Yes')}
                    <tr><td width="100px">{$LBL_VERIFIED}</td><td width="190px">{$asochistory[i].verifiedby}</td><td width="250px">{$asochistory[i].dVerifiedDate|DateTime:'7'}</td></tr>
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

{*}
<div class="middle-container" >
   <h1 align="center" ><span>{$LBL_ASSOCIATION} (#{$vAsocode})</span></h1>
   <br/>
   <div class="middle-containt">
      <div><center>
         <table border="1" cellpadding="3" cellspacing="0" style="border:1px solid #cccccc;">
            <tr><td width="100px"><b>{$LBL_ACTION}</b></td><td colspan='2'>&nbsp;<b>{$LBL_BY}</b> <span style='display:inline-block; width:190px;'> &nbsp; </span> <b>{$LBL_DATE_TIME}</b></td></tr>
           {section name=i loop=$asochistory}
                 {if $asochistory[i].iChangeNo eq 0}
						<tr><td width="100px">{$LBL_CREATE}</td><td colspan='2'><span style='display:inline-block; width:190px;'>{$asochistory[i].createdby} </span> &nbsp; {$asochistory[i].dCreatedDate|DateTime:'7'}</td></tr>
                    {if $asochistory[i].iVerifiedSMID neq '' && $asochistory[i].iVerifiedSMID gt 0}
                    <tr><td width="100px">{$LBL_VERIFIED}</td><td colspan='2'>{$asochistory[i].verifiedby}</td></tr>
                    {elseif $asochistory[i].iRejectedById neq '' && $asochistory[i].iRejectedById gt 0}
						  <tr><td width="100px">{$LBL_VERIFIED}</td><td colspan='2'>{$asochistory[i].rejectedby}</td></tr>
						  {/if}
                 {elseif $asochistory[i].iModifiedByID neq '' && $asochistory[i].iModifiedByID>0}
					  <tr><td width="100px">{$LBL_MODIFIED}</td><td colspan='2'><span style='display:inline-block; width:190px;'>{$asochistory[i].modifiedby} </span> &nbsp; {$asochistory[i].dModifiedDate|DateTime:'7'}</td></tr>
                    {if $asochistory[i].iRejectedById neq '' && $asochistory[i].iRejectedById gt 0}
						  <tr><td width="100px">{$LBL_VERIFIED}</td><td colspan='2'>{$asochistory[i].rejectedby}</td></tr>
						  {elseif $asochistory[i].iVerifiedSMID neq '' && $asochistory[i].iVerifiedSMID gt 0 && ($asochistory[i].eStatus neq 'Need to Verify' && $asochistory[i].eStatus neq 'Modified' && $asochistory[i].eStatus neq 'Delete' && $asochistory[i].eNeedToVerify neq 'Yes')}
                    <tr><td width="100px">{$LBL_VERIFIED}</td><td colspan='2'>{$asochistory[i].verifiedby}</td></tr>
						  {/if}
                 {/if}
              </div>
           {/section}
			</table>
			</center>
		</div>
   </div>
</div>
{*}

{*}
<div class="middle-container" >
   <h1 align="center" ><span>{$LBL_ASSOCIATION} (#{$vAsocode})</span></h1>
   <br/>
   <div class="middle-containt">
      <div><center>
         <table border="1" cellpadding="3" cellspacing="0" style="border:1px solid #cccccc;">
            <tr><td width="100px"><b>{$LBL_ACTION}</b></td><td width="190px"><b>{$LBL_BY}</b></td><td width="250px"><b>{$LBL_DATE_TIME}</b></td></tr>
           {section name=i loop=$asochistory}
                 {if $asochistory[i].iChangeNo eq 0}
						<tr><td width="100px">{$LBL_CREATE}</td><td width="190px">{$asochistory[i].createdby}</td><td width="250px">{$asochistory[i].dCreatedDate|DateTime:'7'}</td></tr>
                    {if $asochistory[i].iVerifiedSMID neq '' && $asochistory[i].iVerifiedSMID gt 0}
                    <br/>
                    &nbsp; {*}<!--Verified by {*}{$asochistory[i].verifiedby}{*} on {$asochistory[i].dVerifiedDate|DateTime:'0'}-->{*}
                    {elseif $asochistory[i].iRejectedById neq '' && $asochistory[i].iRejectedById gt 0}
						  <br/> &nbsp;&nbsp;
						  &nbsp; {$asochistory[i].rejectedby}
						  {/if}
                 {elseif $asochistory[i].iModifiedByID neq '' && $asochistory[i].iModifiedByID>0}
                  &rarr;
                    {$LBL_MODIFIED_BY} {$asochistory[i].modifiedby} {$LBL_AT} {$asochistory[i].dModifiedDate|DateTime:'7'}
                    {if $asochistory[i].iRejectedById neq '' && $asochistory[i].iRejectedById gt 0}
						  <br/> &nbsp;&nbsp;
						  &nbsp; {$asochistory[i].rejectedby}
						  {elseif $asochistory[i].iVerifiedSMID neq '' && $asochistory[i].iVerifiedSMID gt 0 && ($asochistory[i].eStatus neq 'Need to Verify' && $asochistory[i].eStatus neq 'Modified' && $asochistory[i].eStatus neq 'Delete' && $asochistory[i].eNeedToVerify neq 'Yes')}
                    <br/> &nbsp;&nbsp;
                    &nbsp; {*}<!--Verified by {*}{$asochistory[i].verifiedby}{*} on {$asochistory[i].dVerifiedDate|DateTime:'0'}-->{*}
						  {/if}
                 {/if}
              </div>
           {/section}
			</table>
			</center>
		</div>
   </div>
</div>
{*}