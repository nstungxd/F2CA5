<?php /* Smarty version 2.6.0, created on 2012-05-31 13:02:19
         compiled from member/organization/verifyassociationlist.tpl */ ?>
<div class="middle-container">
<h1><span class=""><?php echo $this->_tpl_vars['LBL_ASS_VRF_LIST']; ?>
</span></h1> <!-- blue-hadd-bg -->
<div class="middle-containt">
<div class="inner-white-bg">
   <div><h2><?php echo $this->_tpl_vars['LBL_SEARCH']; ?>
</h2></div>
   <div class="inport-gray-bg">
        <?php if ($this->_tpl_vars['msg'] != ''): ?>
				                     		  <?php endif; ?>
      <div class="import-border">&nbsp;<?php echo $this->_tpl_vars['LBL_SEARCH']; ?>
 : &nbsp; &nbsp; &nbsp; &nbsp;
         <input type="text" name="search_text" class="input-rag" id="search_text" style="width:190px; vertical-align:middle;" />
         &nbsp; <input type="image"  src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-go.gif"  alt=""  style="cursor: pointer; vertical-align:middle;background: #f8f8f8;border:none;" onclick="getassoclist('all',1)" />
      </div>
      <div  style="padding:5px;">
         <table width="100%" border="0" cellspacing="2" cellpadding="2">
            <tr>
               <td width="30%"><?php echo $this->_tpl_vars['LBL_BUY_NAME']; ?>
 :</td>
               <td width="30%"><span class="import-border">
                  <input type="text" name="buy_name" id="buy_name" class="input-rag" style="width:177px; vertical-align:middle;" />
               </span></td>
               <td width="30%"><?php echo $this->_tpl_vars['LBL_BUY_CODE']; ?>
 :</td>
               <td width="30%"><span class="import-border">
                  <input type="text" name="buy_code" id="buy_code" class="input-rag" style="width:177px; vertical-align:middle;" />
               </span></td>
            </tr>
            <tr>
               <td width="30%"><?php echo $this->_tpl_vars['LBL_SELL_NAME']; ?>
 :</td>
               <td colspan="3"><span class="import-border">
                  <input type="text" name="sell_name" id="sell_name" class="input-rag" style="width:177px; vertical-align:middle;" />
               </span>&nbsp; <input type="image" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-go.gif" alt=""   style="cursor: pointer; vertical-align:middle;background: #f8f8f8;border:none;" onclick="getassoclist('srch',1)" /></td>
            </tr>
         </table>
      </div>
   </div>
   <div>
        <div style="height:25px;" align="right">
             <span id="updating" style="display: none; padding-bottom: 7px;"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/progress.gif" alt="" /><a style="vertical-align:top;">Processing</a></span>
             <span id="dispmsg" class="msg"></span></div>
      <div class="light-golden-bor">
         <table width="100%" border="0" class="black" cellspacing="0" cellpadding="0">
            <input type="hidden" name="cursort" id="cursort" value="" />
            <input type="hidden" name="cursorttype" id="cursorttype" value="" />
            <tr>
            <td class="listing-sky-blue">
               <table width="100%" border="0" cellspacing="1" cellpadding="0">
                  <tr>
                    <!--<td width="30" height="26" align="center"><input type="checkbox" class="radib-btn" name="checkbox" id="checkbox" /></td>-->
				    <td width="100" align="left"><a href="javascript:getassoclist('all','1','vAssociationCode')"><b>Supplier Association Code</b></a></td>
                    <td width="80" height="26" align="left" style="padding-left:2px;"><a href="javascript:getassoclist('all','1','vBuyerOrg')"><strong>Buyer Name</strong></a></td>
                    <td width="70" align="center"><a href="javascript:getassoclist('all','1','CAST(vBuyerCode as SIGNED)')"><strong>Buyer Code</strong></a></td>
                    <td width="150" align="center"><a href="javascript:getassoclist('all','1','vSupplierOrg')"><strong>Supplier Name</strong></a></td>
                    <td width="62" align="center"><a href="javascript:getassoclist('all','1','eStatus')"><strong>Status</strong></a></td>
                    <td width="94" align="center">Action</td>
                  </tr>
               </table>
            </td>
         </tr>
         <tr>
            <td>
					<div id="assoclist"><input type="hidden" name="pg" id="pg" value="1"/></div>
					<span><input type="hidden" name="mod" id="mod" value="" /></span>
            </td>
         </tr>
      </table>
      </div>
   </div>
   </div>
</div>
<input type="hidden" name="m" id="m" value="" />
</div>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['SITE_JS_AJAX']; ?>
jverifylistassociation.js"></script>
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