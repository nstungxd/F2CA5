<div class="middle-container" >
   <h1 align="center" >{$LBL_PURCHASE_ORDER} (#{$podtls[0].vPONumber})</h1>
   <br/>
   <div class="middle-containt">
      <div><center>
         <table border="1" cellpadding="3" cellspacing="0" style="border:1px solid #cccccc;">
            <tr><td width="100px"><b>{$LBL_ACTION}</b></td><td width="190px"><b>{$LBL_BY}</b></td><td width="250px"><b>{$LBL_DATE_TIME}</b></td></tr>
         {section name=i loop=$pohistory}
               {if $pohistory[i].eType eq 'Create' || $smarty.section.i.index eq 0}
               <tr><td width="100px">{$LBL_CREATE}</td><td width="190px">{$pohistory[i].createdby}</td><td width="250px">{$pohistory[i].dActionDate|DateTime:'7'}</td></tr>
               {elseif $pohistory[i].eType eq 'Modified' && $pohistory[i].vMailSubject_en eq 'Purchase Order Modified'}
                  <tr><td width="100px">{$LBL_MODIFIED}</td><td width="190px">{$pohistory[i].createdby}</td><td width="250px">{$pohistory[i].dActionDate|DateTime:'7'}</td></tr>
                {elseif $pohistory[i].eType eq 'Modified' && $pohistory[i].vMailSubject_en eq 'Purchase Order Status Changed'}
                  <tr><td width="100px">{$pohistory[i].vAction}{*$LBL_STATUS_CYHANGED*}</td><td width="190px">{$pohistory[i].createdby}</td><td width="250px">{$pohistory[i].dActionDate|DateTime:'7'}</td></tr>
                {elseif $pohistory[i].eType eq 'Rejected' && $pohistory[i].vMailSubject_en eq 'Purchase Order Status Changed'}
                <tr><td width="100px">{$LBL_REJECTED}</td><td width="190px">{$pohistory[i].createdby}</td><td width="250px">{$pohistory[i].dActionDate|DateTime:'7'}</td></tr>
               {/if}
          {sectionelse}
            <tr><td align="center" colspan="3">{$LBL_NO_REC_AVAILABLE}</td></tr>
         {/section}
         </table>
      </center>
      </div>
   </div>
</div>