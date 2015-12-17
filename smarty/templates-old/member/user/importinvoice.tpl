<div class="middle-container">
<h1>{$LBL_IMPORT_PURCH_ORDER}</h1>
<div class="middle-containt">
   <div class="inner-white-bg">
      <div><h2>{$LBL_IMPORT_INVOICE}</h2></div>
      <div id="msg" class="msg">{if $msg neq ''}{*<div class="msg">{$msg}</div>*}
                    {literal}
                    <script>
                    $(document).ready(function() {
                         var msg='{/literal}{$msg}{literal}';
                         if(msg!= '' && msg != undefined)
                         alert(msg);
                    });
                    </script>
                    {/literal}{/if}</div>
      <div class="inport-gray-bg">
      <form name="frmimport" action="{$SITE_URL}index.php?file=m-importinvoice" id="frmimport" method="post" enctype="multipart/form-data" >
         <div class="import-border" style="height:59px;">
            <div style="float:left; width:350px; height:39px;">
            &nbsp;{$LBL_IMPORT_INVOICE} : &nbsp; &nbsp; &nbsp; &nbsp;
            <input type="file" name="importfile" id="importfile" style="width:190px; vertical-align:middle;" accept="csv,xml" class="required" />
            &nbsp;
            </div>
            <div style="float:left; width:350px;">
            <img src="images/btn-import.gif"  alt="" border="0" style="vertical-align:middle;" onclick="$('#frmimport').submit();" />
            </div>
            <div style="height:39px;">&nbsp;</div>
            <div style="float:left; width:350px;">
            	{if $ml eq 'y'}
               <input type="checkbox" name="enctyp" id="enctyp" value="y" /> &nbsp;
               Is data in encrypted format ?
               {else}
               [{$LBL_ENCRYPTION_LIBRARY_NOT_AVAILABLE_ONSERVER}]
               {/if}
            </div>
         </div>
         </form>
         <div style="padding-top:5px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />
            <span>{$LBL_INSTRUCTION}</span>
            <br />
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />
            <span><a href="{$SITE_URL}index.php?file=m-downloadsample&type=Invoice"><strong>{$LBL_DOWNLOAD_SAMPLE}</strong></a></span>
            <br />
         </div>
      </div>
   </div>
</div>
</div>
<script type="text/javascript" src="{$S_JQUERY}jquery.validate.js"></script>
{literal}
<script type="text/javascript">
$('#frmimport').validate({
   messages: {
      "importfile": {
         accept : MSG_CSV_XML_ALLOWED
      }
   }
});
</script>
{/literal}