<?php /* Smarty version 2.6.0, created on 2015-06-20 22:24:08
         compiled from member/user/rfq2list.tpl */ ?>
<div class="middle-container">
<h1><span class=""><?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
 <?php echo $this->_tpl_vars['LBL_LIST']; ?>
</span></h1> <!-- blue-hadd-bg -->
<div class="middle-containt">
   <div class="inner-white-bg">
   <div><h2 style="height:25px;"><a href="javascript:history.back(-1);"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/hadding-arrow.gif" alt="" border="0"  style="vertical-align:middle;"/></a>&nbsp; Search <span><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-show-all.gif"  alt="" border="0" style="vertical-align:middle;" onclick="getrfq2list('all',1)" /></span></h2></div>
   <div class="inport-gray-bg">
      <table width="100%" border="0" cellspacing="5" class="black" cellpadding="0">
	
		<tr>
			<td colspan="4" align="right">
			<span id="msg" class="msg" style="color:#ff0000;">
									</span>
			</td>
		</tr>
      <tr>
        <td width="134"><?php echo $this->_tpl_vars['LBL_RFQ2_CODE']; ?>
 :</td>
        <td width="260"> <input type="hidden" id="gmtoset" name="gmtoset" value="gmtoffset">
	 <input type="text" name="vRFQ2Code" class="input-rag" id="vRFQ2Code" style="width:188px;" /></td>
        <td width="108"><?php echo $this->_tpl_vars['LBL_INV_PO_CODE']; ?>
 :</td>
        <td><input type="text" name="vInvoiceCode" class="input-rag" id="vInvoiceCode" style="width:188px;" /></td>
      </tr>
		<tr>
        <td><?php echo $this->_tpl_vars['LBL_BEST_BID']; ?>
 :</td>
        <td><input type="text" name="bestbid" class="input-rag" id="bestbid" style="width:188px;" /></td>
		  <td><?php echo $this->_tpl_vars['LBL_PRODUCT']; ?>
 :</td>
        <td><input type="text" name="product" class="input-rag" id="product" style="width:188px;" /></td>
      </tr>
		<tr>
        <td><?php echo $this->_tpl_vars['LBL_BUYER']; ?>
 :</td>
        <td><input type="text" name="buyer" class="input-rag" id="buyer" style="width:188px;" /></td>
		  <td><?php echo $this->_tpl_vars['LBL_SUPPLIER']; ?>
 :</td>
        <td><input type="text" name="supplier" class="input-rag" id="supplier" style="width:188px;" /></td>
      </tr>
            <tr>
        <td><?php echo $this->_tpl_vars['LBL_START_DATE']; ?>
 :</td>
        <td>
				<input type="text" name="dStartDate" class="input-rag" id="dStartDate" style="width:139px;" />
						  </td>
        <td><?php echo $this->_tpl_vars['LBL_END_DATE']; ?>
 :</td>
        <td>
				<input type="text" name="dEndDate" class="input-rag" id="dEndDate" style="width:139px;" />
						  </td>
      </tr>
		<tr>
        <td><?php echo $this->_tpl_vars['LBL_TYPE']; ?>
 :</td>
        <td><?php echo $this->_tpl_vars['rfq2type']; ?>
</td>
        <td>Status :</td>
        <td><input type="text" name="eStatus" class="input-rag" id="eStatus" style="width:188px;" /></td>
      </tr>
		<tr>
			<td><?php echo $this->_tpl_vars['LBL_BID_CRITERIA']; ?>
 : </td>
			<td><?php echo $this->_tpl_vars['bidcriteria']; ?>
</td>
			<td colspan="2" align="right" style="padding-right:100px;">
				<a class="btllbl" style="textarea-decoration:none;" onclick="getrfq2list('srch',1)"><b><?php echo $this->_tpl_vars['LBL_SEARCH']; ?>
</b></a>
			</td>
		</tr>
      </table>
  </div>
<div>
   <div>
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr>
       <td height="30px">
			<?php if ($this->_tpl_vars['ur2p']['Create'] == 'y'): ?>
			<a class="btllbl" style="textarea-decoration:none;" href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
rfq2create"><b><?php echo $this->_tpl_vars['LBL_CREATE']; ?>
</b></a>
			<?php endif; ?>
		 </td>
       <td align="right">
           <span id="updating" style="display:none; padding-bottom:7px;"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/progress.gif" alt=""/><a style="vertical-align:top;">Processing</a></span>
           <span id="dispmsg" class="msg"></span>
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
										<a href="javascript:getrfq2list('all','1','rfq2.vRFQ2Code')"><strong><?php echo $this->_tpl_vars['LBL_RFQ2_CODE']; ?>
</strong></a>
			  </td>
			  			  <td width="70" align="left"><a href="javascript:getrfq2list('all','1','ioh.vInvoiceCode')"><strong><?php echo $this->_tpl_vars['LBL_AMOUNT']; ?>
</strong></a></td>
			  <td width="90" align="left"><a href="javascript:getrfq2list('all','1','vProductName')"><strong><?php echo $this->_tpl_vars['LBL_PRODUCT']; ?>
</strong></a></td>
			  <td width="90" align="left"><a href="javascript:getrfq2list('all','1','ioh.vBuyerName')"><strong><?php echo $this->_tpl_vars['LBL_BUYER']; ?>
</strong></a></td>
			  <td width="90" align="left"><a href="javascript:getrfq2list('all','1','ioh.vSupplierName')"><strong><?php echo $this->_tpl_vars['LBL_SUPPLIER']; ?>
</strong></a></td>
			  <td width="40" align="center"><a href="javascript:getrfq2list('all','1','rfq2.eAuctionType')"><strong><?php echo $this->_tpl_vars['LBL_TYPE']; ?>
</strong></a></td>
			  <td width="30" align="center"><a href="javascript:getrfq2list('all','1','rfq2.eBidCriteria')"><strong><?php echo $this->_tpl_vars['LBL_CRITERIA']; ?>
</strong></a></td>
			  <td width="70" align="center"><a href="javascript:getrfq2list('all','1','rdays,rtime')"><strong><?php echo $this->_tpl_vars['LBL_TIME_LEFT']; ?>
</strong></a></td>
			  <td width="70" align="center"><a href="javascript:getrfq2list('all','1','rfq2.fBestBidAmount')"><strong><?php echo $this->_tpl_vars['LBL_BEST_BID']; ?>
</strong></a></td>
			  <td width="63" align="center"><a href="javascript:getrfq2list('all','1','rfq2.fTotalBids')"><strong><?php echo $this->_tpl_vars['LBL_TOTAL_BIDS']; ?>
</strong></a></td>
			  <td width="70" align="center"><a href="javascript:getrfq2list('all','1','sm.eStatus')"><strong><?php echo $this->_tpl_vars['LBL_STATUS']; ?>
</strong></a></td>
			  <td width="50" align="center"><?php echo $this->_tpl_vars['LBL_ACTION']; ?>
</td>
			</tr>
		 </table>
	 </td>
  </tr>
  <tr>
    <td>
      <input type="hidden" name="mod" id="mod" value="" />
		<input type="hidden" name="sts" id="sts" value="<?php echo $this->_tpl_vars['sts']; ?>
" />
      <input type="hidden" name="status" id="status" value="<?php echo $this->_tpl_vars['status']; ?>
" />
      <input type="hidden" name="msgrfq2" id="msgrfq2" value="<?php echo $this->_tpl_vars['msgrfq2']; ?>
" />
      <input type="hidden" name="stsrfq2" id="stsrfq2" value="<?php echo $this->_tpl_vars['stsrfq2']; ?>
" />
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

<!---->
<script type="text/javascript" src="<?php echo $this->_tpl_vars['S_JQUERY']; ?>
jquery-ui-timepicker.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['SITE_JS_AJAX']; ?>
jlistrfq2.js"></script>
<?php echo '
<script type="text/javascript">
jQuery(document).ready(function()
{
	$("#dStartDate").attr(\'readonly\',\'readonly\');
	$("#dStartDate").datetimepicker({
		  dateFormat: \'yy-mm-dd\',
		  timeFormat: \'hh:mm:ss\',
		  showOn: "both",
		  buttonImage: "';  echo $this->_tpl_vars['SITE_IMAGES'];  echo 'calendar.png",
		  buttonImageOnly: true,
		  onSelect: function(dateText, inst) { $(document).ready(function(dateText, inst) { var ead = 10; $(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:\'div.middle-container\', eladd:ead}); }); },
		  onClose: function() { $(document).ready(function(dateText, inst) { var ead = 10; $(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:\'div.middle-container\', eladd:ead}); }); }
	});
	//
	$("#dEndDate").attr(\'readonly\',\'readonly\');
	$("#dEndDate").datetimepicker({
		  dateFormat: \'yy-mm-dd\',
		  timeFormat: \'hh:mm:ss\',
		  showOn: "both",
		  buttonImage: "';  echo $this->_tpl_vars['SITE_IMAGES'];  echo 'calendar.png",
		  buttonImageOnly: true,
		  onSelect: function(dateText, inst) { $(document).ready(function(dateText, inst) { var ead = 10; $(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:\'div.middle-container\', eladd:ead}); }); },
		  onClose: function() { $(document).ready(function(dateText, inst) { var ead = 10; $(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:\'div.middle-container\', eladd:ead}); }); }
	});
   //alert(gmtoffset);
	/*jQuery("#dStartDate").dynDateTime({
		showsTime: true,
		ifFormat: "%Y-%m-%d",
		daFormat: "%l;%M %p, %e %m,  %Y",
		align: "TL",
		electric: false,
		singleClick: false,
      button:".next()",
		displayArea: ".siblings(\'.dtcDisplayArea\')"
	});
	jQuery("#dEndDate").dynDateTime({
		showsTime: true,
		ifFormat: "%Y-%m-%d",
		daFormat: "%l;%M %p, %e %m,  %Y",
		align: "TL",
		electric: false,
		singleClick: false,
      button:".next()",
		displayArea: ".siblings(\'.dtcDisplayArea\')"
	});*/
});

$(\'#checkbox\').click( function ()
{
	invs = $(\'input:checkbox[name="iRFQ2Id\\[\\]"]\');
	if($(this).attr(\'checked\'))
	{
		$.each(invs, function (ln,el) {
			$(this).attr(\'checked\',\'checked\');
		});
	}
	else
	{
		$.each(invs, function (ln,el) {
			$(this).attr(\'checked\',\'\');
		});
	}
});

function chkselect()
{
	var inv = $(\'input:checked[name="iRFQ2Id\\[\\]"]\');
	if(inv.length >0) {
		/*var enct = confirm(LBL_ENCRYPT_EXPORT,"yes");
		if(enct) {
			$(\'#enc\').val(\'y\');
		} else {
			$(\'#enc\').val(\'n\');
		}*/
		$(\'#exp\').submit();
	}
}
</script>
'; ?>


<?php if ($this->_tpl_vars['msg'] != ''):  echo '
<script type="text/javascript">
$(document).ready(function() {
   
	var msg=\'';  echo $this->_tpl_vars['msg'];  echo '\';
	if(msg!= \'\' && msg != undefined && $(\'#m\').val()!=msg) {
		alert(msg);
		$(\'#m\').val(msg);
	}
});
</script>
'; ?>

<?php endif; ?>