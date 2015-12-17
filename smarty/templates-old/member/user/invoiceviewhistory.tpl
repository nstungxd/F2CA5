<div class="middle-container" >
   <h1 align="center" >{$LBL_INVOICE} (#{$invdtls[0].vInvoiceNumber})</h1>
   <br/>
   <div class="middle-containt">
      <div><center>
         <table border="1" cellpadding="3" cellspacing="0" style="border:1px solid #cccccc;">
            <tr><td width="100px"><b>{$LBL_ACTION}</b></td><td width="190px"><b>{$LBL_BY}</b></td><td width="250px"><b>{$LBL_DATE_TIME}</b></td></tr>
            {section name=i loop=$invhistory}
                 {if $invhistory[i].eType eq 'Create' || $smarty.section.i.index eq 0}
                     {if $smarty.section.i.index eq 1}
                     <tr><td width="100px">{$LBL_VERIFY}</td><td width="190px">{$invhistory[i].createdby}</td><td width="250px">{$invhistory[i].dActionDate|DateTime:'7'}</td></tr>
                     {else}
                     <tr><td width="100px">{$LBL_CREATE}</td><td width="190px">{$invhistory[i].createdby}</td><td width="250px">{$invhistory[i].dActionDate|DateTime:'7'}</td></tr>
                     {/if}
                 {elseif $invhistory[i].eType eq 'Modified' && $invhistory[i].vMailSubject_en eq 'Invoice Modified'}
                     <tr><td width="100px">{$LBL_MODIFIED}</td><td width="190px">{$invhistory[i].createdby}</td><td width="250px">{$invhistory[i].dActionDate|DateTime:'7'}</td></tr>
                  {elseif $invhistory[i].eType eq 'Modified' && $invhistory[i].vMailSubject_en eq 'Invoice Status Changed'}
                     <tr><td width="100px">{$invhistory[i].vAction}</td><td width="190px">{$invhistory[i].createdby}</td><td width="250px">{$invhistory[i].dActionDate|DateTime:'7'}</td></tr>
                  {elseif $invhistory[i].eType eq 'Rejected' && $invhistory[i].vMailSubject_en eq 'Invoice Status Changed'}
                     <tr><td width="100px">{$LBL_REJECTED}</td><td width="190px">{$invhistory[i].createdby}</td><td width="250px">{$invhistory[i].dActionDate|DateTime:'7'}</td></tr>
                 {/if}
            {sectionelse}
               <tr><td align="center" colspan="3">{$LBL_NO_REC_AVAILABLE}</td></tr>
            {/section}
         </table>
      </center>
      </div>
   </div>
</div>