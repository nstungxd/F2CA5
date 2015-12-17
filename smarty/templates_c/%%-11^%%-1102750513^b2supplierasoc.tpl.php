<?php /* Smarty version 2.6.0, created on 2012-05-31 12:48:19
         compiled from member/organization/b2supplierasoc.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'trim', 'member/organization/b2supplierasoc.tpl', 11, false),array('modifier', 'stripslashes', 'member/organization/b2supplierasoc.tpl', 43, false),)), $this); ?>
<div class="middle-container">
<h1><?php echo $this->_tpl_vars['LBL_CREATE_ASSOCIATION']; ?>
</h1>
<div class="middle-containt">
	<div class="statistics-main-box-white">
		<div>
			<ul id="inner-tab">
				<li><a class="current"><em><?php echo $this->_tpl_vars['LBL_BUYER2_SUPPLIER']; ?>
 <?php echo $this->_tpl_vars['LBL_ASSOCIATION']; ?>
</em></a></li>
		   </ul>
      </div>
		<div class="clear"></div>
		<?php if (((is_array($_tmp=$this->_tpl_vars['arr'][0]['tReasonToReject'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) != ''): ?>
			<div class="inner-gray-bg" style="height:490px;"> 		<?php else: ?>
			<div class="inner-gray-bg" style="height:450px;"> 		<?php endif; ?>
      <form id="frmadd" name="frmadd" method="post" action="<?php echo $this->_tpl_vars['SITE_URL']; ?>
index.php?file=or-b2supplierasoc_a">
         <input type="hidden" id="mod" name="mod" value="<?php echo $this->_tpl_vars['mod']; ?>
" />
         <input type="hidden" id="admr" name="admr" value="" />
         <input type="hidden" id="iAssociationId" name="iAssociationId" value="<?php echo $this->_tpl_vars['iAssociationId']; ?>
" />
			<div>&nbsp;</div>
			<div>
            <span id="prc" style="display:none; float:right;"> <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/progress.gif" /> Processing ... </span>
               <?php if ($this->_tpl_vars['msg'] != ''): ?>
                                               <?php endif; ?>
				<table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
					<?php if ($this->_tpl_vars['uorg_type'] != 'Buyer2'): ?>
					<tr>
						<td><?php echo $this->_tpl_vars['LBL_SEARCH']; ?>
 <?php echo $this->_tpl_vars['LBL_BUYER2']; ?>
 : </td>
						<td>
							<input type="text" class="ttp" id="b2nm" name="b2nm" value="<?php echo $this->_tpl_vars['post_data']['b2nm']; ?>
" class="input-rag" style="width:143px; height:17px; vertical-align:middle;" title="<?php echo $this->_tpl_vars['LBL_NAME']; ?>
" />&nbsp;
							<input type="text" class="ttp" id="b2cd" name="b2cd" value="<?php echo $this->_tpl_vars['post_data']['b2cd']; ?>
" class="input-rag" style="width:143px; height:17px; vertical-align:middle;" title="<?php echo $this->_tpl_vars['LBL_CODE']; ?>
" />&nbsp;
							<span class="btllbl" style="height:17px;"><b onclick="getBuyer2Combo('');"><?php echo $this->_tpl_vars['LBL_SEARCH']; ?>
</b></span>
							&nbsp; [<?php echo ((is_array($_tmp=$this->_tpl_vars['MSG_CAN_USE_WILD_CHAR'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
]
						</td>
					</tr>
					<?php endif; ?>
               <tr>
                  <td width="190px" valign="top"><?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_BUYER2']; ?>
&nbsp;<font class="reqmsg">*</font> : </td>
                  <td>
							<?php if ($this->_tpl_vars['uorg_type'] != 'Buyer2'): ?>
   						<span id="b2org" style="float:left;">
   							<select name="Data[iBuyer2Id]" id="iBuyer2Id" style="width:300px;" class="required" title="<?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_BUYER2']; ?>
" onchange="return ps();">
   								<option value="">---<?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_BUYER2']; ?>
---</option>
                           <?php if ($this->_tpl_vars['arr'][0]['iBuyer2Id'] > 0): ?>
                              <option value="<?php echo $this->_tpl_vars['arr'][0]['iBuyer2Id']; ?>
" selected="selected"><?php echo $this->_tpl_vars['arr'][0]['vBuyer2']; ?>
</option>
                           <?php endif; ?>
   							</select>
   						</span>
   						<span style="float:right; padding-right:70px;">
                        <?php echo $this->_tpl_vars['LBL_FILTER_LIST_BY']; ?>
 : <input type="text" name="b2filter" id="b2filter" style="width:100px;" />
                     </span>
							<?php else: ?>
							<span id="b2org" style="float:left;"><input type="hidden" name="iBuyer2Id" id="iBuyer2Id" style="width:300px;" title="<?php echo $this->_tpl_vars['LBL_BUYER2']; ?>
" value="<?php echo $this->_tpl_vars['arr'][0]['iBuyer2Id']; ?>
"><b><?php echo $this->_tpl_vars['arr'][0]['vBuyer2']; ?>
 (<?php echo $this->_tpl_vars['arr'][0]['vB2Code']; ?>
)</b></span>
							<?php endif; ?>
                  </td>
				  	</tr>
					<tr><td colspan="2">&nbsp;</td></tr>
					<tr class="prs" style="display:none;">
						<td><?php echo $this->_tpl_vars['LBL_SEARCH']; ?>
 <?php echo $this->_tpl_vars['LBL_SUPPLIER']; ?>
 :</td>
						<td>
							<input type="text" class="ttp" id="bnm" name="bnm" value="<?php echo $this->_tpl_vars['post_data']['bnm']; ?>
" class="input-rag" style="width:143px; height:17px; vertical-align:middle;" title="<?php echo $this->_tpl_vars['LBL_NAME']; ?>
" />&nbsp;
							<input type="text" class="ttp" id="bcd" name="bcd" value="<?php echo $this->_tpl_vars['post_data']['bcd']; ?>
" class="input-rag" style="width:143px; height:17px; vertical-align:middle;" title="<?php echo $this->_tpl_vars['LBL_CODE']; ?>
" />&nbsp;
							<span class="btllbl" style="height:17px;"><b onclick="getSupplierCombo('<?php echo $this->_tpl_vars['arr'][0]['iSupplierId']; ?>
');"><?php echo $this->_tpl_vars['LBL_SEARCH']; ?>
</b></span>
							&nbsp; [<?php echo ((is_array($_tmp=$this->_tpl_vars['MSG_CAN_USE_WILD_CHAR'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
]
						</td>
					</tr>
               <tr>
                  <td width="190px" valign="top"><?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_SUPPLIER']; ?>
&nbsp;<font class="reqmsg">*</font> : </td>
                  <td>
   						<span id="sprdt" style="float:left;">
   							<select name="Data[iSupplierId]" id="iSupplierId" style="width:300px;" class="required" title="<?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_SUPPLIER']; ?>
">
   								<option value="">---<?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_SUPPLIER']; ?>
---</option>
                           <?php if ($this->_tpl_vars['arr'][0]['iSupplierId'] > 0): ?>
                              <option value="<?php echo $this->_tpl_vars['arr'][0]['iSupplierId']; ?>
" selected="selected"><?php echo $this->_tpl_vars['arr'][0]['vSupplier']; ?>
</option>
                           <?php endif; ?>
   							</select>
   						</span>
   						<span class="prs" style="float:right; padding-right:70px; display:none;">
                        <?php echo $this->_tpl_vars['LBL_FILTER_LIST_BY']; ?>
 : <input type="text" name="sfilter" id="sfilter" style="width:100px;" />
                     </span>
                  </td>
				  	</tr>
					<tr><td colspan="2">&nbsp;</td></tr>
               <tr>
                  <td valign="top"><?php echo $this->_tpl_vars['LBL_ACCOUNT']; ?>
1&nbsp;<font class="reqmsg">*</font> : </td>
                  <td><input type="text" id="vAccount1" name="Data[vAccount1]" value="<?php echo $this->_tpl_vars['arr'][0]['vAccount1']; ?>
" class="required" style="width:270px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_ACCOUNT']; ?>
1"/></td>
               </tr>
					<tr>
                  <td valign="top"><?php echo $this->_tpl_vars['LBL_ACCOUNT']; ?>
1 <?php echo $this->_tpl_vars['LBL_CODE']; ?>
 <font class="reqmsg">*</font> : </td>
                  <td><input type="text" id="vAcc1Code" name="Data[vAcc1Code]" value="<?php echo $this->_tpl_vars['arr'][0]['vAcc1Code']; ?>
" class="required" style="width:270px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_ACCOUNT']; ?>
1 <?php echo $this->_tpl_vars['LBL_CODE']; ?>
"/></td>
               </tr>
					<tr>
                  <td valign="top"><?php echo $this->_tpl_vars['LBL_CURRENCY']; ?>
1&nbsp;<font class="reqmsg">*</font> : </td>
                  <td>
							<select name="Data[vCurrency1]" id="vCurrency1" style="width:100px;" class="required" title="<?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_CURRENCY']; ?>
1">
								<?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['currency']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['l']['show'] = true;
$this->_sections['l']['max'] = $this->_sections['l']['loop'];
$this->_sections['l']['step'] = 1;
$this->_sections['l']['start'] = $this->_sections['l']['step'] > 0 ? 0 : $this->_sections['l']['loop']-1;
if ($this->_sections['l']['show']) {
    $this->_sections['l']['total'] = $this->_sections['l']['loop'];
    if ($this->_sections['l']['total'] == 0)
        $this->_sections['l']['show'] = false;
} else
    $this->_sections['l']['total'] = 0;
if ($this->_sections['l']['show']):

            for ($this->_sections['l']['index'] = $this->_sections['l']['start'], $this->_sections['l']['iteration'] = 1;
                 $this->_sections['l']['iteration'] <= $this->_sections['l']['total'];
                 $this->_sections['l']['index'] += $this->_sections['l']['step'], $this->_sections['l']['iteration']++):
$this->_sections['l']['rownum'] = $this->_sections['l']['iteration'];
$this->_sections['l']['index_prev'] = $this->_sections['l']['index'] - $this->_sections['l']['step'];
$this->_sections['l']['index_next'] = $this->_sections['l']['index'] + $this->_sections['l']['step'];
$this->_sections['l']['first']      = ($this->_sections['l']['iteration'] == 1);
$this->_sections['l']['last']       = ($this->_sections['l']['iteration'] == $this->_sections['l']['total']);
?>
								<option value="<?php echo $this->_tpl_vars['currency'][$this->_sections['l']['index']]['vCode']; ?>
" <?php if ($this->_tpl_vars['currency'][$this->_sections['l']['index']]['vCode'] == $this->_tpl_vars['arr'][0]['vCurrency1']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['currency'][$this->_sections['l']['index']]['vCode']; ?>
</option>
								<?php endfor; endif; ?>
							</select>
						</td>
               </tr>
               <tr>
                  <td valign="top"><?php echo $this->_tpl_vars['LBL_ACCOUNT']; ?>
2 : </td>
                  <td><input type="text" id="vAccount2" name="Data[vAccount2]" value="<?php echo $this->_tpl_vars['arr'][0]['vAccount2']; ?>
" class="" style="width:270px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_ACCOUNT']; ?>
2"/></td>
               </tr>
					<tr>
                  <td valign="top"><?php echo $this->_tpl_vars['LBL_ACCOUNT']; ?>
2 <?php echo $this->_tpl_vars['LBL_CODE']; ?>
 : </td>
                  <td><input type="text" id="vAcc2Code" name="Data[vAcc2Code]" value="<?php echo $this->_tpl_vars['arr'][0]['vAcc2Code']; ?>
" class="" style="width:270px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_ACCOUNT']; ?>
2 <?php echo $this->_tpl_vars['LBL_CODE']; ?>
"/></td>
               </tr>
					<tr>
                  <td valign="top"><?php echo $this->_tpl_vars['LBL_CURRENCY']; ?>
2&nbsp; : </td>
                  <td>
							<select name="Data[vCurrency2]" id="vCurrency2" style="width:100px;" class="required">
								<?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['currency']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['l']['show'] = true;
$this->_sections['l']['max'] = $this->_sections['l']['loop'];
$this->_sections['l']['step'] = 1;
$this->_sections['l']['start'] = $this->_sections['l']['step'] > 0 ? 0 : $this->_sections['l']['loop']-1;
if ($this->_sections['l']['show']) {
    $this->_sections['l']['total'] = $this->_sections['l']['loop'];
    if ($this->_sections['l']['total'] == 0)
        $this->_sections['l']['show'] = false;
} else
    $this->_sections['l']['total'] = 0;
if ($this->_sections['l']['show']):

            for ($this->_sections['l']['index'] = $this->_sections['l']['start'], $this->_sections['l']['iteration'] = 1;
                 $this->_sections['l']['iteration'] <= $this->_sections['l']['total'];
                 $this->_sections['l']['index'] += $this->_sections['l']['step'], $this->_sections['l']['iteration']++):
$this->_sections['l']['rownum'] = $this->_sections['l']['iteration'];
$this->_sections['l']['index_prev'] = $this->_sections['l']['index'] - $this->_sections['l']['step'];
$this->_sections['l']['index_next'] = $this->_sections['l']['index'] + $this->_sections['l']['step'];
$this->_sections['l']['first']      = ($this->_sections['l']['iteration'] == 1);
$this->_sections['l']['last']       = ($this->_sections['l']['iteration'] == $this->_sections['l']['total']);
?>
								<option value="<?php echo $this->_tpl_vars['currency'][$this->_sections['l']['index']]['vCode']; ?>
" <?php if ($this->_tpl_vars['currency'][$this->_sections['l']['index']]['vCode'] == $this->_tpl_vars['arr'][0]['vCurrency2']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['currency'][$this->_sections['l']['index']]['vCode']; ?>
</option>
								<?php endfor; endif; ?>
							</select>
						</td>
               </tr>
               <?php if (((is_array($_tmp=$this->_tpl_vars['arr'][0]['tReasonToReject'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) != ''): ?>
               <tr>
                  <td valign="top"><?php echo $this->_tpl_vars['LBL_REASON_TO_REJECT']; ?>
8 : </td>
                  <td><div style="word-wrap:break-word; width:390px; height:70px; border:1px solid #cccccc; overflow:scroll;"><?php echo $this->_tpl_vars['arr'][0]['tReasonToReject']; ?>
</div></td>
               </tr>
               <?php endif; ?>
               					<tr>
						<td valign="top">&nbsp;</td>
						<td>
                     <span class="btllbl" style=""><b id="btnSubmit" onclick="return submitfrm('');"><?php echo $this->_tpl_vars['LBL_SUBMIT']; ?>
</b></span>
                     <span class="btllbl" style=""><b id="btnSubmit" onclick="return submitfrm('admr');"><?php echo $this->_tpl_vars['LBL_SAVE_AND_ADDMORE']; ?>
</b></span>
						</td>
					</tr>
				</table>
			</div>
			<div>&nbsp;</div>
         </form>
		</div>
	</div>
</div>
</div>

<script type="text/javascript" src="<?php echo $this->_tpl_vars['S_JQUERY']; ?>
jquery.listboxfilter.js" ></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['S_JQUERY']; ?>
jquery.validate.js" ></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['SITE_JS_AJAX']; ?>
jb2supplierasoc.js"></script>
<?php echo '
<script type="text/javascript">
function ps()
{
   if($(\'#iBuyer2Id\').val()!=\'\') {
      $(\'.prs\').show();
   }
}
ps();
$(\'#frmadd\').validate({
   ignore: \':hidden\',
   rules: {
      "Data[iSupplierId]": {
         remote: {
   			url: SITE_URL+"index.php?file=or-aj_chkdupdata",
            type: "get",
            data: {
   				val:function() {
   					return $("#iAssociationId").val();
   				},
   				id:function() {
   					return "iAssociationId";
   				},
   				field:function() {
   					return "iSupplierId";
   				},
               chkf: function () {
                  return "iBuyer2Id";
               },
               chkfvl: function () {
                  return $("#iBuyer2Id").val();
               },
					extc: function () {
                  return " AND NOT (eStatus=\'Delete\' AND eNeedToVerify=\'No\')";
               },
   				table:function() {
   					return "';  echo $this->_tpl_vars['PRJ_DB_PREFIX'];  echo '_buyer2_supplier_association";
   				}
   			}
   		}
      }
   },
   messages: {
      "Data[iSupplierId]": {
         remote: jQuery.validator.format(LBL_SUPPLIER_ALREADY_INASSOCIATION_WITH_SELECTED_BUYER2)
      }
   }
});

function submitfrm(vl)
{
   var vldfrmdt = $(\'#frmadd\').valid();
   $(document).ready(function() {
     $(function() {
        var ead=130;
        $(\'div.inner-gray-bg\').css(\'height\', parseInt($(\'div.inner-gray-bg\').css(\'height\').replace(\'px\',\'\'))+130);
        $(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:\'div.middle-container\', eladd:ead});
     });
   });
   if(!vldfrmdt) {
      return false;
   }
   $(\'#admr\').val(vl);
   $(\'#frmadd\')[0].submit();
}

$(document).ready(function() {
	$("#b2filter").bigoFilter("#iBuyer2Id", {property: \'text\'});
	$("#sfilter").bigoFilter("#iSupplierId", {property: \'text\'});
	
   $(\'.ttp\').blur(function() {
      if($.trim($(this).val())==\'\') {
         $(this).val($(this).attr(\'title\'));
      }
   });
   $(\'.ttp\').focus(function() {
      if($.trim($(this).val())==$(this).attr(\'title\')) {
         $(this).val(\'\');
      }
   });
   $.each($(\'.ttp\'), function(i,el) {
      if($.trim($(this).val())==\'\') {
         $(this).val($(this).attr(\'title\'));
      }
   });
   //
});
</script>
'; ?>

<?php if ($this->_tpl_vars['msg'] != ''): ?>
<?php echo '
<script type="text/javascript" async="async" defer="defer">
$(document).ready(function() {
	var msg = \'';  echo $this->_tpl_vars['msg'];  echo '\';
   if(msg!= \'\') { alert(msg); }
});
</script>
'; ?>

<?php endif; ?>
<?php if ($this->_tpl_vars['arr'][0]['iBuyer2Id'] > 0 && ( ((is_array($_tmp=$this->_tpl_vars['post_data']['bnm'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) != '' || ((is_array($_tmp=$this->_tpl_vars['post_data']['bcd'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) != '' )): ?>
<?php echo '<script type="text/javascript">getSupplierCombo(\'\');</script>'; ?>

<?php endif; ?>