<script type="text/javascript" src="{$DATETIMEPICKER}jquery.dynDateTime.js"></script>
<script type="text/javascript" src="{$DATETIMEPICKER}lang/calendar-en.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="{$DATETIMEPICKER}css/calendar-blue.css"  />
<div class="middle-container">
<h1><span class="">View Invoice Listing</span></h1> <!-- blue-hadd-bg -->
<div class="middle-containt">
   <div class="inner-white-bg">
   <div><h2 style="height:25px;"><a href="javascript:history.back(-1);"><img src="{$SITE_IMAGES}sm_images/hadding-arrow.gif" alt="" border="0"  style="vertical-align:middle;"/></a>&nbsp; Search <span><img src="{$SITE_IMAGES}sm_images/btn-show-all.gif"  alt="" border="0" style="vertical-align:middle;" onclick="getgrouplist('all',1)" /></span></h2></div>
   <div class="inport-gray-bg">
      <table width="100%" border="0" cellspacing="5" class="black" cellpadding="0">
		<tr><td colspan="4" align="right"><span id="msg" class="msg" style="color:#ff0000;">{*<div class="msg">{$msg}</div>*}
					{*if $msg neq ''} {literal}
					 <script>
					 $(document).ready(function() {
							var msg='{/literal}{$msg}{literal}';
							if(msg!= '' && msg != undefined)
							alert(msg);
					 });
					 </script>
					 {/literal}{/if*}</span>
			</td>
		</tr>
      <tr>
        <td width="134">Invoice Number :</td>
        <td width="260"><input type="text" name="vPONumber" class="input-rag" id="vInvoiceNumber" style="width:188px;" /></td>
        <td width="108">Invoice Code :</td>
        <td><input type="text" name="vPOCode" class="input-rag" id="vInvoiceCode" style="width:188px;" /></td>
      </tr>
      <tr>
        <td>Buyer :</td>
        <td><input type="text" name="buyername" class="input-rag" id="buyername" style="width:188px;" /></td>
        <td>Supplier :</td>
        <td><input type="text" name="vSupplierName" class="input-rag" id="vSupplierName" style="width:188px;" /></td>
      </tr>
      <tr>
        <td>Invoice Amount :</td>
        <td><input type="text" name="fPOTotal" class="input-rag" id="fInvoiceTotal" style="width:188px;" /></td>
        <td>Invoice Days :</td>
        <td><input type="text" name="iNetPaymentDays" class="input-rag" id="iNetPaymentDays" style="width:188px;" /></td>
      </tr>
      <tr>
        <td>Invoice Date From :</td>
        <td><input type="text" name="fDate" readonly class="input-rag" id="fDate" style="width:139px; vertical-align:middle;" />
          {*&nbsp; <img src="{$SITE_IMAGES}sm_images/icon-calander.gif"  alt="" border="0" style="vertical-align:middle;" />*}
		  </td>
        <td>Invoice Date To :</td>
        <td><input type="text" name="tDate" readonly class="input-rag" id="tDate" style="width:139px; vertical-align:middle;" />
         {*&nbsp;<img src="{$SITE_IMAGES}sm_images/icon-calander.gif"  alt="" border="0" style="vertical-align:middle;" />*}
		  </td>
      </tr>
      <tr>
        <td>Status :</td>
        <td><input type="text" name="status" class="input-rag" id="status" style="width:188px;" /></td>
        <td>&nbsp;</td>
        <td><img src="{$SITE_IMAGES}sm_images/btn-search.gif" alt="" border="0" style="vertical-align:middle;" onclick="getgrouplist('srch',1)" /></td>
      </tr>
      </table>
  </div>
<div>
   <div>
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr>
       <td height="35">
            {if $usertype neq 'orgadmin'}
                 {if $invCreate eq 'Yes'}<a href="{$SITE_URL_DUM}invoicecreate/0/b"><img src="{$SITE_IMAGES}sm_images/btn-create.gif" alt="" title="{$LBL_CREATE} {$LBL_INVOICE} {$LBL_AS|ucfirst} {$LBL_BUYER}" border="0" style="vertical-align:middle;" /></a>{/if}
                 {if $doimportinv eq 'Yes' && $invcrt eq 'Yes'}&nbsp; <a href="{$SITE_URL_DUM}importinvoice"><img src="{$SITE_IMAGES}sm_images/btn-import-invoice.gif" alt="" border="0" style="vertical-align:middle;" /></a>{/if}
                 <a style="cursor:pointer;"><img src="{$SITE_IMAGES}sm_images/btn-export-invoice.gif" alt="" border="0" style="vertical-align:middle;" onclick="chkselect();" /></a>
             {/if}
       </td>
       <td align="right">
             <span id="updating" style="display: none;padding-bottom: 7px;"><img src="{$SITE_IMAGES}sm_images/progress.gif" alt=""/><a style="vertical-align:top;">Processing</a></span>
            <span id="dispmsg" class="msg"></span>
            {if $deletepo eq 'Yes'}
            <img src="{$SITE_IMAGES}sm_images/btn-delete-all.gif" alt="" border="0" style="cursor:pointer;border: none; padding-right: 5px;vertical-align:top;" onClick="Delete('deleteall','')" />
            {/if}
           <!-- <a href="#"><img src="{$SITE_IMAGES}sm_images/btn-delete.gif" alt="" border="0" style="vertical-align:middle;" /></a> -->
       </td>
     </tr>
   </table>
   </div>
  <div class="light-golden-bor">
  <table width="100%" border="0" class="black" cellspacing="0" cellpadding="0">
  <input type="hidden" name="cursort" id="cursort" value="" />
            <input type="hidden" name="cursorttype" id="cursorttype" value="" />
  <tr>
    <td class="listing-sky-blue"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="197" height="26"> &nbsp;
             {if $usertype neq 'orgadmin'}
                    <input type="checkbox" class="radib-btn" name="checkbox" id="checkbox" style="vertical-align:middle;" />
               {/if}
               {*}<a href="javascript:getgrouplist('all','1','ioh.vInvoiceNumber')">
               <strong>Invoice Number</strong></a>
		  </td>
        <td width="107" align="left">{*}&nbsp;<a href="javascript:getgrouplist('all','1','ioh.vInvoiceCode')"><strong>Invoice Supplier Code</strong></a></td>
        <td width="67" align="center"><a href="javascript:getgrouplist('all','1','ioh.fInvoiceTotal')"><strong>Amount</strong></a></td>
        <td width="48" align="center"><a href="javascript:getgrouplist('all','1','ioh.iNetPaymentDays')"><strong>Days</strong></a></td>
        <td width="74" align="center"><a href="javascript:getgrouplist('all','1','ioh.dCreatedDate')"><strong>Date</strong></a></td>
        {if $orgtype neq 'Supplier'}
        <td width="87" align="center"><a href="javascript:getgrouplist('all','1','ioh.vSupplierName')"><strong>Supplier</strong></a></td>
        {/if}
        <td width="77" align="center"><a href="javascript:getgrouplist('all','1','CONCAT(ou.vFirstName,\' \',ou.vLastName)')"><strong>Buyer</strong></a></td>
        <td width="58" align="center"><a href="javascript:getgrouplist('all','1','sm.vStatus_{$LANG}')"><strong>Status</strong></a></td>
        <td width="74" align="center">Action</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>
      <input type="hidden" name="mod" id="mod" value="" />
		<input type="hidden" name="invsts" id="invsts" value="{$invsts}" />
      <input type="hidden" name="invStatus" id="invStatus" value="{$invStatus}" />
      <form name="exp" id="exp" method="post" action="{$SITE_URL_DUM}index.php?file=m-exportinvoice">
		<div id="grouplist">
			<input type="hidden" name="pg" id="pg" value="1"/>
			<input type="hidden" name="enc" id="enc" value="n" />
		</div>
		</form>
    </td>
   </tr>
   </table>
   </div>
   </div>
</div>
<input type="hidden" name="m" id="m" value="" />
</div>
<script type="text/javascript" src="{$S_JQUERY}jquery-ui-timepicker.js"></script>
<script type="text/javascript" src="{$SITE_JS_AJAX}jlistinvacpt.js"></script>
{literal}
<script type="text/javascript">
jQuery(document).ready(function()
{
	$(".colorboxfile").live("click",function() {
	   var id = $(this).attr('rel');
	   $.colorbox({width:"71%", height:"90%",iframe:true,href:SITE_URL_DUM+"reportsrptpop/inv/"+id+"/pop"});
	});
	//
	$("#fDate").attr('readonly','readonly');
	$("#fDate").datetimepicker({
		dateFormat: 'yy-mm-dd',
		timeFormat: 'hh:mm:ss',
		showOn: "both",
		buttonImage: "{/literal}{$SITE_IMAGES}{literal}calendar.png",
		buttonImageOnly: true,
		onSelect: function(dateText, inst) { $(document).ready(function(dateText, inst) { var ead = 10; $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead}); }); },
		onClose: function() { $(document).ready(function(dateText, inst) { var ead = 10; $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead}); }); }
	});
	//
	$("#tDate").attr('readonly','readonly');
	$("#tDate").datetimepicker({
		  dateFormat: 'yy-mm-dd',
		  timeFormat: 'hh:mm:ss',
		  showOn: "both",
		  buttonImage: "{/literal}{$SITE_IMAGES}{literal}calendar.png",
		  buttonImageOnly: true,
		  onSelect: function(dateText, inst) { $(document).ready(function(dateText, inst) { var ead = 10; $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead}); }); },
		  onClose: function() { $(document).ready(function(dateText, inst) { var ead = 10; $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead}); }); }
	});
	/*jQuery("#fDate").dynDateTime({
		showsTime: true,
		ifFormat: "%Y-%m-%d %H:%M:00",
		daFormat: "%l;%M %p, %e %m,  %Y",
		align: "TL",
		electric: false,
		singleClick: false,
      button:".next()",
		displayArea: ".siblings('.dtcDisplayArea')"
	});
	jQuery("#tDate").dynDateTime({
		showsTime: true,
		ifFormat: "%Y-%m-%d %H:%M:00",
		daFormat: "%l;%M %p, %e %m,  %Y",
		align: "TL",
		electric: false,
		singleClick: false,
      button:".next()",
		displayArea: ".siblings('.dtcDisplayArea')"
	});*/
});
$('#checkbox').click( function ()
{
	invs = $('input:checkbox[name="iInvoiceID\[\]"]');
	if($(this).attr('checked'))
	{
		$.each(invs, function (ln,el) {
			$(this).attr('checked','checked');
		});
	}
	else
	{
		$.each(invs, function (ln,el) {
			$(this).attr('checked','');
		});
	}
});
function chkselect()
{
	var inv = $('input:checked[name="iInvoiceID\[\]"]');
	if(inv.length >0) {
		/*var enct = confirm(LBL_ENCRYPT_EXPORT,"yes");
		if(enct) {
			$('#enc').val('y');
		} else {
			$('#enc').val('n');
		}*/
		$('#exp').submit();
	}
}
</script>
{/literal}
{if $msg neq ''}
{literal}
<script type="text/javascript">
$(document).ready(function() {
	var msg='{/literal}{$msg}{literal}';
	if(msg!= '' && msg != undefined && $('#m').val()!=msg) {
		alert(msg);
		$('#m').val(msg);
	}
});
</script>
{/literal}
{/if}