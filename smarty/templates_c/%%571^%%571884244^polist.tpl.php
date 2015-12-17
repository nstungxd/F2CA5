<?php /* Smarty version 2.6.0, created on 2015-06-20 22:23:46
         compiled from member/user/polist.tpl */ ?>
<!--<script type="text/javascript" src="<?php echo $this->_tpl_vars['DATETIMEPICKER']; ?>
jquery.dynDateTime.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['DATETIMEPICKER']; ?>
lang/calendar-en.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $this->_tpl_vars['DATETIMEPICKER']; ?>
css/calendar-blue.css" />-->
<div class="middle-container">
<h1><span class="">View Purchase Order</span></h1> <!-- blue-hadd-bg -->
<div class="middle-containt">
   <div class="inner-white-bg">
   <div><h2 style="height:25px;"><a href="javascript:history.back(-1);"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/hadding-arrow.gif" alt="" border="0"  style="vertical-align:middle;"/></a>&nbsp; Search <span><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-show-all.gif"  alt="" border="0" style="vertical-align:middle;" onclick="getgrouplist('all',1)"/></span></h2></div>
   <div class="inport-gray-bg">
      <table width="100%" border="0" cellspacing="5" class="black" cellpadding="0">
		<tr>
      <td colspan="4" align="right">
            <?php if ($this->_tpl_vars['msg'] != ''): ?>
						 		 <?php endif; ?>
      </td>
		</tr>
      <tr>
        <td width="134">PO Number :</td>
        <td width="260"><input type="text" name="vPONumber" class="input-rag" id="vPONumber" style="width:188px;" /></td>
        <td width="108">PO Code :</td>
        <td><input type="text" name="vPOCode" class="input-rag" id="vPOCode" style="width:188px;" /></td>
      </tr>
      <tr>
        <td>Buyer :</td>
        <td><input type="text" name="buyername" class="input-rag" id="buyername" style="width:188px;" /></td>
        <td>Supplier :</td>
        <td><input type="text" name="vSupplierName" class="input-rag" id="vSupplierName" style="width:188px;" /></td>
      </tr>
      <tr>
        <td>PO Amount :</td>
        <td><input type="text" name="fPOTotal" class="input-rag" id="fPOTotal" style="width:188px;" /></td>
        <td>PO Days :</td>
        <td><input type="text" name="iNetPaymentDays" class="input-rag" id="iNetPaymentDays" style="width:188px;" /></td>
      </tr>
      <tr>
        <td>PO Date From :</td>
        <td><input type="text" name="fDate" readonly class="input-rag" id="fDate" style="width:139px; vertical-align:middle;" />
          		  </td>
        <td>PO Date To :</td>
        <td><input type="text" name="tDate" readonly class="input-rag" id="tDate" style="width:139px; vertical-align:middle;" />
           		  </td>
      </tr>
      <tr>
        <td>Status :</td>
        <td><input type="text" name="status" class="input-rag" id="status" style="width:188px;" /></td>
        <td>&nbsp;</td>
        <td><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-search.gif" alt="" border="0" style="vertical-align:middle;" onclick="getgrouplist('srch',1)" /></td>
      </tr>
      </table>
  </div>
<div>
   <div>
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr>
       <td height="35">
            <?php if ($this->_tpl_vars['usertype'] != 'orgadmin'): ?>
               <?php if ($this->_tpl_vars['poCreate'] == 'Yes'): ?><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
purchaseordercreate"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-create.gif" alt="" border="0" style="vertical-align:middle;" /></a><?php endif; ?> &nbsp;
               <?php if ($this->_tpl_vars['doimportpo'] == 'Yes' && $this->_tpl_vars['pocrt'] == 'Yes'): ?><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
importpurchaseorders"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-import-pur-order.gif" alt="" border="0" style="vertical-align:middle;" /></a>&nbsp;<?php endif; ?>
               <a style="cursor:pointer;"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-export-pur-order.gif" alt="" border="0" style="vertical-align:middle;" onclick="chkselect();" /></a>
            <?php endif; ?>
       </td>
       <td align="right">
            <!-- <a href="#"> <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-delete.gif" alt="" border="0" style="vertical-align:middle;" align="right"/></a> -->
            <span id="updating" style="display: none;padding-bottom: 7px;"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/progress.gif" alt=""/><a style="vertical-align:top;">Processing</a></span>
            <span id="dispmsg" class="msg"></span>
            <?php if ($this->_tpl_vars['deletepo'] == 'Yes'): ?>
            <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-delete-all.gif" alt="" border="0" style="cursor:pointer;border: none; padding-right: 5px;vertical-align:top;" onClick="Delete('deleteall','')" />
            <?php endif; ?>
       </td>
     </tr>
   </table>
   </div>
<!--<div style="height:330px;">-->
  <div class="light-golden-bor">
  <table width="100%" border="0" class="black" cellspacing="0" cellpadding="0">
  <input type="hidden" name="cursort" id="cursort" value="" />
            <input type="hidden" name="cursorttype" id="cursorttype" value="" />
  <tr>
    <td class="listing-sky-blue"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="190" height="26"> &nbsp;
             <?php if ($this->_tpl_vars['usertype'] != 'orgadmin'): ?>
               <input type="checkbox" class="radib-btn" name="checkbox" id="checkbox" style="vertical-align:middle;" />
             <?php endif; ?>
               &nbsp;<a href="javascript:getgrouplist('all','1','poh.vPOCode')"><strong>PO Buyer Code</strong></a></td>
        <td width="67" align="center"><a href="javascript:getgrouplist('all','1','poh.fPOTotal')"><strong>Amount</strong></a></td>
        <td width="48" align="center"><a href="javascript:getgrouplist('all','1','days')"><strong>Days</strong></a></td>
        <td width="74" align="center"><a href="javascript:getgrouplist('all','1','poh.dCreateDate')"><strong>Date</strong></a></td>
        <td width="87" align="center"><a href="javascript:getgrouplist('all','1','poh.vSupplierName')"><strong>Supplier</strong></a></td>
        <?php if ($this->_tpl_vars['orgtype'] != 'Buyer'): ?>
        <td width="77" align="center"><a href="javascript:getgrouplist('all','1','poh.vBuyerCompanyName')"><strong>Buyer</strong></a></td>
        <?php endif; ?>
        <td width="58" align="center"><a href="javascript:getgrouplist('all','1','sm.vStatus_<?php echo $this->_tpl_vars['LANG']; ?>
')"><strong>Status</strong></a></td>
        <td width="74" align="center">Action</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>
      <input type="hidden" name="mod" id="mod" value="" />
      <input type="hidden" name="poStatus" id="poStatus" value="<?php echo $this->_tpl_vars['poStatus']; ?>
" />
		<form name="exp" id="exp" method="post" action="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
index.php?file=m-exportpo">
		<div id="grouplist">
			<input type="hidden" name="pg" id="pg" value="1" />
			<input type="hidden" name="enc" id="enc" value="n" />
		</div>
		<input type="hidden" name="view" id="view" value="" />
		<input type="hidden" name="iPOID" id="iPOID" value="" />
		</form>
    </td>
   </tr>
   </table>
   </div>
   </div>
	<!--</div>-->
</div>
<input type="hidden" name="m" id="m" value="" />
</div>

<script type="text/javascript" src="<?php echo $this->_tpl_vars['S_JQUERY']; ?>
jquery-ui-timepicker.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['SITE_JS_AJAX']; ?>
jlistpo.js"></script>
<?php echo '
<script type="text/javascript">
jQuery(document).ready(function()
{
	$(".colorboxfile").live("click",function() {
		var id = $(this).attr(\'rel\');
		$.colorbox({width:"71%", height:"90%",iframe:true,href:SITE_URL_DUM+"reportsrptpop/po/"+id+"/pop"});
	});
	//
	$("#fDate").attr(\'readonly\',\'readonly\');
	$("#fDate").datetimepicker({
		  dateFormat: \'yy-mm-dd\',
		  timeFormat: \'hh:mm:ss\',
		  showOn: "both",
		  buttonImage: "';  echo $this->_tpl_vars['SITE_IMAGES'];  echo 'calendar.png",
		  buttonImageOnly: true,
		  onSelect: function(dateText, inst) {
				$(document).ready(function(dateText, inst) {
					 var ead = 10;
					 $(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:\'div.middle-container\', eladd:ead});
				});
		  },
		  onClose: function() {
				$(document).ready(function(dateText, inst) {
					 var ead = 10;
					 $(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:\'div.middle-container\', eladd:ead});
				});
		  }
	});
	//
	$("#tDate").attr(\'readonly\',\'readonly\');
	$("#tDate").datetimepicker({
		  dateFormat: \'yy-mm-dd\',
		  timeFormat: \'hh:mm:ss\',
		  showOn: "both",
		  buttonImage: "';  echo $this->_tpl_vars['SITE_IMAGES'];  echo 'calendar.png",
		  buttonImageOnly: true,
		  onSelect: function(dateText, inst) {
				$(document).ready(function(dateText, inst) {
					 var ead = 10;
					 $(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:\'div.middle-container\', eladd:ead});
				});
		  },
		  onClose: function() {
				$(document).ready(function(dateText, inst) {
					 var ead = 10;
					 $(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:\'div.middle-container\', eladd:ead});
				});
		  }
	});
	/*jQuery("#fDate").dynDateTime({
		showsTime: true,
		ifFormat: "%Y-%m-%d %H:%M:00",
		daFormat: "%l;%M %p, %e %m,  %Y",
		align: "TL",
		electric: false,
		singleClick: false,
      button:".next()",
		displayArea: ".siblings(\'.dtcDisplayArea\')"
	});
	jQuery("#tDate").dynDateTime({
		showsTime: true,
		ifFormat: "%Y-%m-%d %H:%M:00",
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
	pos = $(\'input:checkbox[name="iPurchaseOrderID\\[\\]"]\');
	if($(this).attr(\'checked\'))
	{
		$.each(pos, function (ln,el) {
			$(this).attr(\'checked\',\'checked\');
		});
	}
	else
	{
		$.each(pos, function (ln,el) {
			$(this).attr(\'checked\',\'\');
		});
	}
});
var msg = \'';  echo $this->_tpl_vars['msg'];  echo '\';
if(msg != \'\'){
	setTimeout("$(\'#msg\').attr(\'innerHTML\',\'\');",7000);
}
function chkselect()
{
	var po = $(\'input:checked[name="iPurchaseOrderID\\[\\]"]\');
	if(po.length >0) {
		/*var enct = confirm(LBL_ENCRYPT_EXPORT,"yes");
		if(enct) {
			$(\'#enc\').val(\'y\');
		} else {
			$(\'#enc\').val(\'n\');
		}*/
		$(\'#exp\').submit();
	}
}
function ci(vl) {
	var url = SITE_URL+\'index.php?file=u-newinvfpo_a\';
	$(\'#exp\').attr(\'action\',url);
	$(\'#view\').val(\'crtinv\');
	$(\'#iPOID\').val(vl);
	$(\'#exp\').submit();
}
</script>
'; ?>

<?php if ($this->_tpl_vars['msg'] != ''): ?>
<?php echo '
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