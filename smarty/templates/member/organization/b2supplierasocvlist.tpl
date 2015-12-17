<div class="middle-container">
<h1><span class="">{$LBL_ASSO_LIST}</span></h1> <!-- blue-hadd-bg -->
<div class="middle-containt">
<div class="inner-white-bg">
   <div><h2>{$LBL_SEARCH}</h2></div>
   <div class="inport-gray-bg">
        {if $msg neq ''}
             {*<div class="msg">{$msg}</div>*}
        {*literal}
        <script>
        $(document).ready(function() {
             var msg='{/literal}{$msg}{literal}';
             if(msg!= '' && msg != undefined)
             alert(msg);
        });
        </script>
        {/literal*}
        {/if}
      <div class="import-border">&nbsp;{$LBL_SEARCH} : &nbsp; &nbsp; &nbsp; &nbsp;
         <input type="text" name="search_text" class="input-rag" id="search_text" style="width:190px;" /> &nbsp;
         <a class="btllbl" onclick="getb2supplierasocvlist('all',1)" style="height:19px; text-decoration:none;"><b>{$LBL_GO}</b></a>
      </div>
      <div  style="padding:5px;">
         <table width="100%" border="0" cellspacing="2" cellpadding="2">
            <tr>
               <td width="25%">{$LBL_BUYER}2 :</td>
               <td width="25%" align="left">
                  <span class="import-border">
                     <input type="text" name="buyer2" id="buyer2" class="input-rag" style="width:177px; vertical-align:middle;" />
                  </span>
               </td>
               <td width="25%">{$LBL_SUPPLIER} :</td>
               <td width="25%" align="left">
                  <span class="import-border">
                     <input type="text" name="supplier" id="supplier" class="input-rag" style="width:177px; vertical-align:middle;" />
                  </span>
               </td>
            </tr>
            <tr>
               <td width="30%">{$LBL_CODE} :</td>
               <td width="30%" colspan="3" align="left">
                  <span class="import-border">
                     <input type="text" name="code" id="code" class="input-rag" style="width:177px; vertical-align:middle;" />
                  </span>
                  <a class="btllbl" onclick="getb2supplierasocvlist('srch',1)" style="height:19px; text-decoration:none;"><b>{$LBL_GO}</b></a>
               </td>
            </tr>
         </table>
      </div>
   </div>
   <div>
      <div style="height:25px; padding-right:10px;" align="right">
         <span id="updating" style="display: none; padding-bottom: 7px;"><img src="{$SITE_IMAGES}sm_images/progress.gif" alt=""/><a style="vertical-align:top;">Processing</a></span>
         <span id="dispmsg" class="msg"></span>
      </div>
      <div class="light-golden-bor">
         <table width="100%" border="0" class="black" cellspacing="0" cellpadding="0">
            <input type="hidden" name="cursort" id="cursort" value="" />
            <input type="hidden" name="cursorttype" id="cursorttype" value="" />
            <tr>
            <td class="listing-sky-blue">
               <table width="100%" border="0" cellspacing="1" cellpadding="0">
                  <tr>
				        <td width="150" align="left"><a href="javascript:getb2supplierasocvlist('all','1','vBuyer2')">&nbsp;<b>{$LBL_BUYER}2</b></a></td>
				        <td width="150" align="left"><a href="javascript:getb2supplierasocvlist('all','1','vProduct')"><b>{$LBL_SUPPLIER}</b></a></td>
                    <td width="70" align="center"><a href="javascript:getb2supplierasocvlist('all','1','vACode')"><b>{$LBL_CODE}</b></a></td>
                    <td width="70" align="center"><a href="javascript:getb2supplierasocvlist('all','1','eStatus')"><b>{$LBL_STATUS}</b></a></td>
                    <td width="50" align="center">{$LBL_VIEW}</td>
                  </tr>
               </table>
            </td>
         </tr>
         <tr>
            <td>
					<div id="assoclist"><input type="hidden" name="pg" id="pg" value="1"/></div>
					<span>
						<input type="hidden" name="mod" id="mod" value="" />
						<input type="hidden" name="srchfor" id="srchfor" value="{$srchfor}" />
						<input type="hidden" name="srchval" id="srchval" value="{$srchval}" />
					</span>
            </td>
         </tr>
      </table>
      </div>
   </div>
   </div>
</div>
<input type="hidden" name="sltyp" id="sltyp" value="{$srchval}" />
<input type="hidden" name="m" id="m" value="" />
</div>
<!--<div id="asa" name="asas" style="color:#ff0000;">asdasdsa</div>-->
<script type="text/javascript" src="{$SITE_JS_AJAX}jvlistb2supplierassoc.js"></script>
{literal}
<script>
   //$('div [style*=width:10px]').hide();
   //alert($('div').find(":color:red").html());
   /*$('span').each(function(){
      if($(this).css('color') == 'red'){
         alert($(this).html());
      }
   });*/
	$(document).ready(function() {
		{/literal}{if $msg neq ''}{literal}
		var msg='{/literal}{$msg}{literal}';
		if(msg!= '' && msg != undefined && $('#m').val()!=msg) {
			alert(msg);
			$('#m').val(msg);
		}
	  {/literal}{/if}{literal}
	});
</script>
{/literal}