<?php /* Smarty version 2.6.0, created on 2015-06-23 18:11:02
         compiled from member/organization/associationview.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'assign', 'member/organization/associationview.tpl', 69, false),array('modifier', 'trim', 'member/organization/associationview.tpl', 80, false),array('modifier', 'is_array', 'member/organization/associationview.tpl', 87, false),array('modifier', 'count', 'member/organization/associationview.tpl', 87, false),array('modifier', 'in_array', 'member/organization/associationview.tpl', 89, false),)), $this); ?>
<form name="frmcreateassocs" id="frmcreateassocs" action="<?php echo $this->_tpl_vars['SITE_URL']; ?>
index.php?file=or-createassociation_a" method="post">
<input type="hidden" name="iAsociationID" id="iAsociationID"value="<?php echo $this->_tpl_vars['iAsociationID']; ?>
" />
<input type="hidden" name="view" id="view" value="<?php echo $this->_tpl_vars['view']; ?>
" />
<input type="hidden" name="status" id="status" value="<?php echo $this->_tpl_vars['status']; ?>
" />
<div class="middle-container">
<h1><?php echo $this->_tpl_vars['LBL_ASSOCIATION_VIEW']; ?>
</h1>
<div class="middle-containt">
	<div class="statistics-main-box-white">
		<div>
			<ul id="inner-tab">
				<li><a class="current"><EM><?php echo $this->_tpl_vars['LBL_ASSOCIATION']; ?>
</EM></a></li>
		   </ul>
      </div>
		<div class="clear"></div>
		<div class="inner-gray-bg">
				<?php if ($this->_tpl_vars['msg'] != '' && $this->_tpl_vars['vrf'] == 'y'): ?>
					<div class="msg"><?php echo $this->_tpl_vars['msg']; ?>
</div>
				<?php endif; ?>
			<div>&nbsp;</div>
			<div><span style="float:right;"><b><a class="" href="javascript:openpopup('<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
asocviewhistory/<?php echo $this->_tpl_vars['iAsociationID']; ?>
')" ><?php echo $this->_tpl_vars['LBL_VIEW_HISTORY']; ?>
</a></b></span></div>
			<div>
				<table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
				  <tr>
					 <td width="160" valign="top"><?php echo $this->_tpl_vars['LBL_ASSOCIATION_CODE']; ?>
 </td>
                          <td valign="top">:</td>
					 <td>
						<table width="486" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							 <td height="20">
								<?php echo $this->_tpl_vars['assorgdt'][0]['vAssociationCode']; ?>

							 </td>
						  </tr>
						</table>
					</td>
					</tr>
				  <tr>
					 <td width="160" valign="top"><?php echo $this->_tpl_vars['LBL_BUYER_ORG']; ?>
 </td>
                          <td valign="top">:</td>
					 <td>
						<table width="486" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							 <td height="20">
								<?php echo $this->_tpl_vars['assorgdt'][0]['vBuyerOrg']; ?>

							 </td>
						  </tr>
						</table>
					</td>
					</tr>
                         <tr>
						<td valign="top"><?php echo $this->_tpl_vars['LBL_BUY_CODE']; ?>
 </td>
                              <td valign="top">:</td>
						 <td>
							<table width="550" border="0" cellspacing="0" cellpadding="0">
							  <tr>
								 <td height="30" valign="top">
									<?php echo $this->_tpl_vars['assorgdt'][0]['vBuyerCode']; ?>

								 </td>
							  </tr>
							</table>
						</td>
					</tr>
					<tr>
						<td valign="top"><?php echo $this->_tpl_vars['LBL_SUPPLIER_ORGS']; ?>
 </td>
                  <td valign="top">:</td>
						 <td>
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
							  <tr>
								 <td height="30" valign="top">
								 <?php echo smarty_function_assign(array('var' => 'chkCount','value' => 0), $this);?>

                           <?php if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['assorgdt']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
										<?php if ($this->_tpl_vars['assorgdt'][$this->_sections['i']['index']]['vsh'] == 'Yes' && $this->_tpl_vars['verify'] == 'yes'): ?>                                  <span style="float:right;">Reason to Reject: <input name="tReasonToReject[<?php echo $this->_tpl_vars['assorgdt'][$this->_sections['i']['index']]['iAsociationID']; ?>
]" style="width:190px;" /></span>
											  <input type="checkbox" value="<?php echo $this->_tpl_vars['assorgdt'][$this->_sections['i']['index']]['iAsociationID']; ?>
" name="vSupplierOrg[]" onclick="countUnchecked('');"/>
											  <?php echo $this->_tpl_vars['assorgdt'][$this->_sections['i']['index']]['vSupplierOrg']; ?>
 (<?php echo $this->_tpl_vars['assorgdt'][$this->_sections['i']['index']]['vSupplierCode']; ?>
) [<?php echo $this->_tpl_vars['assorgdt'][$this->_sections['i']['index']]['eStatus']; ?>
]
											  <?php echo smarty_function_assign(array('var' => 'chkCount','value' => $this->_tpl_vars['chkCount']+1), $this);?>

											  <br />
                                   <br />
										<?php else: ?> 										 <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
arrow.gif" />&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['assorgdt'][$this->_sections['i']['index']]['vSupplierOrg']; ?>
 (<?php echo $this->_tpl_vars['assorgdt'][$this->_sections['i']['index']]['vSupplierCode']; ?>
) <?php if ($this->_tpl_vars['assorgdt'][$this->_sections['i']['index']]['vsh'] == 'Yes' || $this->_tpl_vars['verify'] == 'yes'): ?>[<?php echo $this->_tpl_vars['assorgdt'][$this->_sections['i']['index']]['eStatus']; ?>
]<?php endif; ?>
										 <?php if ($this->_tpl_vars['vassorgdt'][$this->_sections['i']['index']]['iRejectedById'] > 0 && ((is_array($_tmp=$this->_tpl_vars['vassorgdt'][$this->_sections['i']['index']]['tReasonToReject'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) != ''): ?>
											&nbsp; [Reason To Reject: <?php echo ((is_array($_tmp=$this->_tpl_vars['vassorgdt'][$this->_sections['i']['index']]['tReasonToReject'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)); ?>
]
										 <?php endif; ?>
										 <br />
                               <br />
										<?php endif; ?>
								 <?php endfor; endif; ?>
									<?php if (((is_array($_tmp=$this->_tpl_vars['Oassorgdt'])) ? $this->_run_mod_handler('is_array', true, $_tmp) : is_array($_tmp)) && count($this->_tpl_vars['Oassorgdt']) > 0 && $this->_tpl_vars['asvf_len'] > 0): ?>
									<?php if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['Oassorgdt']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
										<?php if (! ( ((is_array($_tmp=$this->_tpl_vars['Oassorgdt'][$this->_sections['i']['index']]['iAsociationID'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['asvrfy']) : in_array($_tmp, $this->_tpl_vars['asvrfy'])) )): ?>
										<img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
arrow.gif" />&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['Oassorgdt'][$this->_sections['i']['index']]['vSupplierOrg']; ?>
 (<?php echo $this->_tpl_vars['Oassorgdt'][$this->_sections['i']['index']]['vSupplierCode']; ?>
) 										<?php if ($this->_tpl_vars['vassorgdt'][$this->_sections['i']['index']]['iRejectedById'] > 0 && ((is_array($_tmp=$this->_tpl_vars['vassorgdt'][$this->_sections['i']['index']]['tReasonToReject'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) != ''): ?>
											&nbsp; [Reason To Reject: <?php echo ((is_array($_tmp=$this->_tpl_vars['vassorgdt'][$this->_sections['i']['index']]['tReasonToReject'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)); ?>
]
										<?php endif; ?>
										<br />
                              <br />
										<?php endif; ?>
								 <?php endfor; endif; ?>
								 <?php endif; ?>
                              <div id="toolmsg" class="err"></div>
								 </td>
							  </tr>
							</table>
						</td>
					</tr>
					<tr>
						<td valign="top">&nbsp;</td>
						<td colspan="3" valign="top">
							<?php if ($this->_tpl_vars['verify'] == 'yes'): ?>
							<a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
verifyassociationlist">
							<?php else: ?>
							<a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
associationlist">
							<?php endif; ?>
							<img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-back.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" /></a>
							<?php if ($this->_tpl_vars['verify'] == 'yes'): ?>
								<img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-verify.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="return countUnchecked('verify');" />
                        <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-reject.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="return countUnchecked('reject');" />
							<?php endif; ?>
							<span style="float:right;">&nbsp;
							<?php if ($this->_tpl_vars['Oassorgdt'][0]['eStatus'] == 'Modified'): ?>
															<a class="colorbox" href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
index.php?file=or-aj_assocoverview&id=<?php echo $this->_tpl_vars['OiAsociationID']; ?>
" onmouseover="CallColoerBox(this.href,500,300,'file');">Click Here to view Original</a>
							<?php endif; ?>
						</span>
						</td>
					</tr>
				</table>
			</div>
			<div>&nbsp;</div>
		</div>
	</div>
</div>
</div>
</form>

<?php echo '
<script type="text/javascript">
function countUnchecked(vl) {
	var n = $("input:checked[name=\'vSupplierOrg\\[\\]\']").length;
	if(n<1) {
		$(\'#toolmsg\').attr(\'innerHTML\',LBL_SELECT_ONE_SUP_ORG);
		return false;
	} else {
		$(\'#toolmsg\').attr(\'innerHTML\',\'\');
		$(\'#view\').val(vl);
		if($.trim(vl) != \'\') {
			$(\'#frmcreateassocs\').submit();
		}
		return true;
	}
}
</script>
'; ?>