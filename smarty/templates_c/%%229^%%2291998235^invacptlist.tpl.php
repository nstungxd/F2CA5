<?php /* Smarty version 2.6.0, created on 2015-06-20 22:53:23
         compiled from member/user/invacptlist.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'ucfirst', 'member/user/invacptlist.tpl', 65, false),)), $this); ?>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['DATETIMEPICKER']; ?>
jquery.dynDateTime.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['DATETIMEPICKER']; ?>
lang/calendar-en.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $this->_tpl_vars['DATETIMEPICKER']; ?>
css/calendar-blue.css"  />
<div class="middle-container">
<h1><span class="">View Invoice Listing</span></h1> <!-- blue-hadd-bg -->
<div class="middle-containt">
   <div class="inner-white-bg">
   <div><h2 style="height:25px;"><a href="javascript:history.back(-1);"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/hadding-arrow.gif" alt="" border="0"  style="vertical-align:middle;"/></a>&nbsp; Search <span><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-show-all.gif"  alt="" border="0" style="vertical-align:middle;" onclick="getgrouplist('all',1)" /></span></h2></div>
   <div class="inport-gray-bg">
      <table width="100%" border="0" cellspacing="5" class="black" cellpadding="0">
		<tr><td colspan="4" align="right"><span id="msg" class="msg" style="color:#ff0000;">					</span>
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
          		  </td>
        <td>Invoice Date To :</td>
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
                 <?php if ($this->_tpl_vars['invCreate'] == 'Yes'): ?><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
invoicecreate/0/b"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-create.gif" alt="" title="<?php echo $this->_tpl_vars['LBL_CREATE']; ?>
 <?php echo $this->_tpl_vars['LBL_INVOICE']; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['LBL_AS'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
 <?php echo $this->_tpl_vars['LBL_BUYER']; ?>
" border="0" style="vertical-align:middle;" /></a><?php endif; ?>
                 <?php if ($this->_tpl_vars['doimportinv'] == 'Yes' && $this->_tpl_vars['invcrt'] == 'Yes'): ?>&nbsp; <a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
importinvoice"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-import-invoice.gif" alt="" border="0" style="vertical-align:middle;" /></a><?php endif; ?>
                 <a style="cursor:pointer;"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-export-invoice.gif" alt="" border="0" style="vertical-align:middle;" onclick="chkselect();" /></a>
             <?php endif; ?>
       </td>
       <td align="right">
             <span id="updating" style="display: none;padding-bottom: 7px;"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/progress.gif" alt=""/><a style="vertical-align:top;">Processing</a></span>
            <span id="dispmsg" class="msg"></span>
            <?php if ($this->_tpl_vars['deletepo'] == 'Yes'): ?>
            <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-delete-all.gif" alt="" border="0" style="cursor:pointer;border: none; padding-right: 5px;vertical-align:top;" onClick="Delete('deleteall','')" />
            <?php endif; ?>
           <!-- <a href="#"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-delete.gif" alt="" border="0" style="vertical-align:middle;" /></a> -->
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
             <?php if ($this->_tpl_vars['usertype'] != 'orgadmin'): ?>
                    <input type="checkbox" class="radib-btn" name="checkbox" id="checkbox" style="vertical-align:middle;" />
               <?php endif; ?>
               &nbsp;<a href="javascript:getgrouplist('all','1','ioh.vInvoiceCode')"><strong>Invoice Supplier Code</strong></a></td>
        <td width="67" align="center"><a href="javascript:getgrouplist('all','1','ioh.fInvoiceTotal')"><strong>Amount</strong></a></td>
        <td width="48" align="center"><a href="javascript:getgrouplist('all','1','ioh.iNetPaymentDays')"><strong>Days</strong></a></td>
        <td width="74" align="center"><a href="javascript:getgrouplist('all','1','ioh.dCreatedDate')"><strong>Date</strong></a></td>
        <?php if ($this->_tpl_vars['orgtype'] != 'Supplier'): ?>
        <td width="87" align="center"><a href="javascript:getgrouplist('all','1','ioh.vSupplierName')"><strong>Supplier</strong></a></td>
        <?php endif; ?>
        <td width="77" align="center"><a href="javascript:getgrouplist('all','1','CONCAT(ou.vFirstName,\' \',ou.vLastName)')"><strong>Buyer</strong></a></td>
        <td width="58" align="center"><a href="javascript:getgrouplist('all','1','sm.vStatus_<?php echo $this->_tpl_vars['LANG']; ?>
')"><strong>Status</strong></a></td>
        <td width="74" align="center">Action</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>
      <input type="hidden" name="mod" id="mod" value="" />
		<input type="hidden" name="invsts" id="invsts" value="<?php echo $this->_tpl_vars['invsts']; ?>
" />
      <input type="hidden" name="invStatus" id="invStatus" value="<?php echo $this->_tpl_vars['invStatus']; ?>
" />
      <form name="exp" id="exp" method="post" action="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
index.php?file=m-exportinvoice">
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
<script type="text/javascript" src="<?php echo $this->_tpl_vars['S_JQUERY']; ?>
jquery-ui-timepicker.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['SITE_JS_AJAX']; ?>
jlistinvacpt.js"></script>
<?php echo '
<script type="text/javascript">
jQuery(document).ready(function()
{
	$(".colorboxfile").live("click",function() {
	   var id = $(this).attr(\'rel\');
	   $.colorbox({width:"71%", height:"90%",iframe:true,href:SITE_URL_DUM+"reportsrptpop/inv/"+id+"/pop"});
	});
	//
	$("#fDate").attr(\'readonly\',\'readonly\');
	$("#fDate").datetimepicker({
		dateFormat: \'yy-mm-dd\',
		timeFormat: \'hh:mm:ss\',
		showOn: "both",
		buttonImage: "';  echo $this->_tpl_vars['SITE_IMAGES'];  echo 'calendar.png",
		buttonImageOnly: true,
		onSelect: function(dateText, inst) { $(document).ready(function(dateText, inst) { var ead = 10; $(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:\'div.middle-container\', eladd:ead}); }); },
		onClose: function() { $(document).ready(function(dateText, inst) { var ead = 10; $(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:\'div.middle-container\', eladd:ead}); }); }
	});
	//
	$("#tDate").attr(\'readonly\',\'readonly\');
	$("#tDate").datetimepicker({
		  dateFormat: \'yy-mm-dd\',
		  timeFormat: \'hh:mm:ss\',
		  showOn: "both",
		  buttonImage: "';  echo $this->_tpl_vars['SITE_IMAGES'];  echo 'calendar.png",
		  buttonImageOnly: true,
		  onSelect: function(dateText, inst) { $(document).ready(function(dateText, inst) { var ead = 10; $(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:\'div.middle-container\', eladd:ead}); }); },
		  onClose: function() { $(document).ready(function(dateText, inst) { var ead = 10; $(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:\'div.middle-container\', eladd:ead}); }); }
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
	invs = $(\'input:checkbox[name="iInvoiceID\\[\\]"]\');
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
	var inv = $(\'input:checked[name="iInvoiceID\\[\\]"]\');
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