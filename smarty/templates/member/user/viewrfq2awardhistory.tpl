<div class="{*middle-container*}" align="center">
   <h1 align="center" >{$LBL_RFQ2} {$LBL_AWARD} (#{$dtls[0].vAwardNum})</h1>
   <br/>
   <div class="{*middle-containt*}" >
      <div><center>
         <table border="1" cellpadding="3" cellspacing="0" style="border:1px solid #cccccc;">
            <tr><td width="100px"><b>{$LBL_ACTION}</b></td><td width="190px"><b>{$LBL_BY}</b></td><td width="250px"><b>{$LBL_DATE_TIME}</b></td></tr>
            {section name=i loop=$hdtls}
               {if $hdtls[i].eType eq 'Create' || $smarty.section.i.index eq 0}
                  <tr><td width="100px">{$LBL_CREATE}</td><td width="190px">{$hdtls[i].createdby}</td><td width="250px">{$hdtls[i].dActionDate|DateTime:'7'}</td></tr>
               {elseif $hdtls[i].eType eq 'Modified' && $hdtls[i].vAction eq 'Status Changed'}
                  <tr><td width="100px">{$hdtls[i].vAction}</td><td width="190px">{$hdtls[i].createdby}</td><td width="250px">{$hdtls[i].dActionDate|DateTime:'7'}</td></tr>
               {elseif $hdtls[i].eType eq 'Modified'}
                  <tr><td width="100px">{$LBL_MODIFIED}</td><td width="190px">{$hdtls[i].createdby}</td><td width="250px">{$hdtls[i].dActionDate|DateTime:'7'}</td></tr>
               {elseif $hdtls[i].vAction eq 'Verify'}
                  <tr><td width="100px">{$LBL_VERIFIED}</td><td width="190px">{$hdtls[i].verifiedby}</td><td width="250px">{$hdtls[i].dVerifyDate|DateTime:'7'}</td></tr>
               {elseif $hdtls[i].vAction eq 'Rejected'}
                  <tr><td width="100px">{$LBL_REJECTED}</td><td width="190px">{$hdtls[i].verifiedby}</td><td width="250px">{$hdtls[i].dVerifyDate|DateTime:'7'}</td></tr>
               {/if}
            {sectionelse}
               <tr><td align="center" colspan="3">{$LBL_NO_REC_AVAILABLE}</td></tr>
            {/section}
         </table>
      </center>
      </div>
   </div>
</div>