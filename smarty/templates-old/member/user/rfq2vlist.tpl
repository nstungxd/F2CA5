<div class="middle-container">
<h1><span class="">{$LBL_RFQ2} {$LBL_LIST}</span></h1> <!-- blue-hadd-bg -->
<div class="middle-containt">
   <div class="inner-white-bg">
   <div><h2 style="height:25px;"><a href="javascript:history.back(-1);"><img src="{$SITE_IMAGES}sm_images/hadding-arrow.gif" alt="" border="0"  style="vertical-align:middle;"/></a>&nbsp; Search <span><img src="{$SITE_IMAGES}sm_images/btn-show-all.gif"  alt="" border="0" style="vertical-align:middle;" onclick="getrfq2list('all',1)" /></span></h2></div>
   <div class="inport-gray-bg">
      <table width="100%" border="0" cellspacing="5" class="black" cellpadding="0">
		<tr>
			<td colspan="4" align="right">
			<span id="msg" class="msg" style="color:#ff0000;">
			{*<div class="msg">{$msg}</div>*}
			{*if $msg neq ''} {literal}
			 <script>
			 $(document).ready(function() {
					var msg='{/literal}{$msg}{literal}';
					if(msg!= '' && msg != undefined)
					alert(msg);
			 });
			 </script>
			 {/literal}{/if*}
			</span>
			</td>
		</tr>
      <tr>
        <td width="134">{$LBL_RFQ2_CODE} :</td>
        <td width="260"><input type="text" name="vRFQ2Code" class="input-rag" id="vRFQ2Code" style="width:188px;" /></td>
        <td width="108">{$LBL_INV_PO_CODE} :</td>
        <td><input type="text" name="vInvoiceCode" class="input-rag" id="vInvoiceCode" style="width:188px;" /></td>
      </tr>
		<tr>
        <td>{$LBL_BEST_BID} :</td>
        <td><input type="text" name="bestbid" class="input-rag" id="bestbid" style="width:188px;" /></td>
		  <td>{$LBL_PRODUCT} :</td>
        <td><input type="text" name="product" class="input-rag" id="product" style="width:188px;" /></td>
      </tr>
		<tr>
        <td>{$LBL_BUYER} :</td>
        <td><input type="text" name="buyer" class="input-rag" id="buyer" style="width:188px;" /></td>
		  <td>{$LBL_SUPPLIER} :</td>
        <td><input type="text" name="supplier" class="input-rag" id="supplier" style="width:188px;" /></td>
      </tr>
      {*<tr>
        <td>{$LBL_MAX_PRICE} :</td>
        <td><input type="text" name="fMaxPrice" class="input-rag" id="fMaxPrice" style="width:188px;" /></td>
        <td>{$LBL_MIN_PRICE} :</td>
        <td><input type="text" name="fMinPrice" class="input-rag" id="fMinPrice" style="width:188px;" /></td>
      </tr>*}
      <tr>
        <td>{$LBL_START_DATE} :</td>
        <td>
				<input type="text" name="dStartDate" class="input-rag" id="dStartDate" style="width:139px;" />
				{*&nbsp;<img src="{$SITE_IMAGES}sm_images/icon-calander.gif"  alt="" border="0" style="vertical-align:middle;" />*}
		  </td>
        <td>{$LBL_END_DATE} :</td>
        <td>
				<input type="text" name="dEndDate" class="input-rag" id="dEndDate" style="width:139px;" />
				{*&nbsp;<img src="{$SITE_IMAGES}sm_images/icon-calander.gif"  alt="" border="0" style="vertical-align:middle;" />*}
		  </td>
      </tr>
		<tr>
			<td>{$LBL_TYPE} :</td>
			<td>{$rfq2type}</td>
			{*<td>Status :</td>
			<td><input type="text" name="eStatus" class="input-rag" id="eStatus" style="width:188px;" /></td>*}
			<td>{$LBL_BID_CRITERIA} : </td>
			<td>
				{$bidcriteria} &nbsp;&nbsp;&nbsp;
				<a class="btllbl" style="textarea-decoration:none;" onclick="getrfq2list('srch',1)"><b>{$LBL_SEARCH}</b></a>
			</td>
      </tr>
		{*<tr>
			<td>{$LBL_BID_CRITERIA} : </td>
			<td>{$bidcriteria}</td>
			<td colspan="2" align="right" style="padding-right:100px;">
				<a class="btllbl" style="textarea-decoration:none;" onclick="getrfq2list('srch',1)"><b>{$LBL_SEARCH}</b></a>
			</td>
		</tr>*}
      </table>
  </div>
<div>
   <div>
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr>
       <td height="30px">&nbsp;</td>
       <td align="right">
           <span id="updating" style="display:none; padding-bottom:7px;"><img src="{$SITE_IMAGES}sm_images/progress.gif" alt=""/><a style="vertical-align:top;">Processing</a></span>
           <span id="dispmsg" class="msg"></span>
			  {*<span class="btllbl" style="float:right; width:59px;"><b onclick="chstatus('deleteall','')">{$LBL_DELETE}</b></span>*}
       </td>
     </tr>
   </table>
   </div>
  <div class="light-golden-bor">
	<table width="100%" border="0" class="black" cellspacing="0" cellpadding="0">
	<input type="hidden" name="cursort" id="cursort" value="" />
	<input type="hidden" name="cursorttype" id="cursorttype" value="" />
  <tr>
    <td class="listing-sky-blue">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
			  <td width="100" height="27" align="left">&nbsp;
					{*if $usertype neq 'orgadmin'}
						<input type="checkbox" class="radib-btn" name="checkbox" id="checkbox" style="vertical-align:middle;" />
					{/if*}
					<a href="javascript:getrfq2list('all','1','rfq2.vRFQ2Code')"><strong>{$LBL_RFQ2_CODE}</strong></a>
			  </td>
			  {*<td width="100" align="left"><a href="javascript:getrfq2list('all','1','ioh.vInvoiceCode')"><strong>{$LBL_INV_CODE}</strong></a></td>*}
			  <td width="100" align="left"><a href="javascript:getrfq2list('all','1','vProductName')"><strong>{$LBL_PRODUCT}</strong></a></td>
			  <td width="100" align="left"><a href="javascript:getrfq2list('all','1','ioh.vBuyerName')"><strong>{$LBL_BUYER}</strong></a></td>
			  <td width="100" align="left"><a href="javascript:getrfq2list('all','1','ioh.vSupplierName')"><strong>{$LBL_SUPPLIER}</strong></a></td>
			  <td width="30" align="center"><a href="javascript:getrfq2list('all','1','rfq2.eAuctionType')"><strong>{$LBL_TYPE}</strong></a></td>
			  <td width="70" align="center"><a href="javascript:getrfq2list('all','1','rfq2.eBidCriteria')"><strong>{$LBL_BID_CRITERIA}</strong></a></td>
			  <td width="90" align="center"><a href="javascript:getrfq2list('all','1','rdays,rtime')"><strong>{$LBL_TIME_LEFT}</strong></a></td>
			  <td width="70" align="center"><a href="javascript:getrfq2list('all','1','sm.eStatus')"><strong>{$LBL_STATUS}</strong></a></td>
			  <td width="70" align="center">{$LBL_ACTION}</td>
			</tr>
		 </table>
	 </td>
  </tr>
  <tr>
    <td>
      <input type="hidden" name="mod" id="mod" value="" />
		<input type="hidden" name="sts" id="sts" value="{$sts}" />
      <input type="hidden" name="status" id="status" value="{$status}" />
      <form name="exp" id="exp" method="post" action="">
		<div id="grouplist">
			<input type="hidden" name="pg" id="pg" value="1" />
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

<!--{*<script type="text/javascript" src="{$DATETIMEPICKER}jquery.dynDateTime.js"></script>
<script type="text/javascript" src="{$DATETIMEPICKER}lang/calendar-en.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="{$DATETIMEPICKER}css/calendar-blue.css"  />*}-->
<script type="text/javascript" src="{$S_JQUERY}jquery-ui-timepicker.js"></script>
<script type="text/javascript" src="{$SITE_JS_AJAX}jvlistrfq2.js"></script>
{literal}
<script type="text/javascript">
jQuery(document).ready(function()
{
	$("#dStartDate").attr('readonly','readonly');
	$("#dStartDate").datetimepicker({
		  dateFormat: 'yy-mm-dd',
		  timeFormat: 'hh:mm:ss',
		  showOn: "both",
		  buttonImage: "{/literal}{$SITE_IMAGES}{literal}calendar.png",
		  buttonImageOnly: true,
		  onSelect: function(dateText, inst) { $(document).ready(function(dateText, inst) { var ead = 10; $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead}); }); },
		  onClose: function() { $(document).ready(function(dateText, inst) { var ead = 10; $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead}); }); }
	});
	//
	$("#dEndDate").attr('readonly','readonly');
	$("#dEndDate").datetimepicker({
		  dateFormat: 'yy-mm-dd',
		  timeFormat: 'hh:mm:ss',
		  showOn: "both",
		  buttonImage: "{/literal}{$SITE_IMAGES}{literal}calendar.png",
		  buttonImageOnly: true,
		  onSelect: function(dateText, inst) { $(document).ready(function(dateText, inst) { var ead = 10; $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead}); }); },
		  onClose: function() { $(document).ready(function(dateText, inst) { var ead = 10; $('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead}); }); }
	});
	/*jQuery("#dStartDate").dynDateTime({
		showsTime: true,
		ifFormat: "%Y-%m-%d",
		daFormat: "%l;%M %p, %e %m,  %Y",
		align: "TL",
		electric: false,
		singleClick: false,
      button:".next()",
		displayArea: ".siblings('.dtcDisplayArea')"
	});
	jQuery("#dEndDate").dynDateTime({
		showsTime: true,
		ifFormat: "%Y-%m-%d",
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
	invs = $('input:checkbox[name="iRFQ2Id\[\]"]');
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
	var inv = $('input:checked[name="iRFQ2Id\[\]"]');
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