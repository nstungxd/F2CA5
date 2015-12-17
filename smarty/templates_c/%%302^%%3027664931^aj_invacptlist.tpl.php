<?php /* Smarty version 2.6.0, created on 2015-06-20 22:53:26
         compiled from member/user/aj_invacptlist.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'assign', 'member/user/aj_invacptlist.tpl', 4, false),array('modifier', 'str_replace', 'member/user/aj_invacptlist.tpl', 13, false),array('modifier', 'calcLTzTime', 'member/user/aj_invacptlist.tpl', 19, false),array('modifier', 'DateTime', 'member/user/aj_invacptlist.tpl', 19, false),array('modifier', 'trim', 'member/user/aj_invacptlist.tpl', 23, false),array('modifier', 'htmlentities', 'member/user/aj_invacptlist.tpl', 34, false),array('modifier', 'cat', 'member/user/aj_invacptlist.tpl', 41, false),)), $this); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <?php if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['activegroup']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
      <?php if ($this->_sections['i']['index'] % 2 == 0): ?>
         <?php echo smarty_function_assign(array('var' => 'rowclass','value' => 'golden'), $this);?>

      <?php else: ?>
         <?php echo smarty_function_assign(array('var' => 'rowclass','value' => ""), $this);?>

      <?php endif; ?>
      <tr class="<?php echo $this->_tpl_vars['rowclass']; ?>
">
        <td width="190" height="26" > &nbsp;
		<?php if ($this->_tpl_vars['usertype'] != 'orgadmin'): ?>
             <input type="checkbox" class="radib-btn" name="iInvoiceID[]" id="iInvoiceID" style="vertical-align:middle;" value="<?php echo $this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['iInvoiceID']; ?>
" />
          <?php endif; ?>
			<?php echo smarty_function_assign(array('var' => 'vinvnum','value' => ((is_array($_tmp="-")) ? $this->_run_mod_handler('str_replace', true, $_tmp, " - ", $this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['vInvoiceNumber']) : str_replace($_tmp, " - ", $this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['vInvoiceNumber']))), $this);?>

         &nbsp;<?php echo $this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['vInvSupplierCode']; ?>
</td>
        <td width="67"  align="center"><?php echo $this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['fInvoiceTotal']; ?>
</td>
        <td width="48" align="center"><?php echo $this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['iNetPaymentDays']; ?>
</td>
        <td width="74" align="center"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['dCreatedDate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)))) ? $this->_run_mod_handler('DateTime', true, $_tmp, '10') : DateTime($_tmp, '10')); ?>
</td>
        <?php if ($this->_tpl_vars['orgtype'] != 'Supplier'): ?>
        <td width="87" align="center"><?php echo $this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['vSupplierName']; ?>
</td>
        <?php endif; ?>
         <td width="77" align="center"><?php if (((is_array($_tmp=$this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['vBuyerName'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) == ''): ?>---<?php else:  echo $this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['vBuyerName'];  endif; ?></td>
         <td width="58" align="center">
				<b>
				<?php if ($this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['eSaved'] == 'Yes'): ?>
					<?php echo $this->_tpl_vars['MSG_SAVED']; ?>

				<?php else: ?>
					<?php if ($this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['iaStatusID'] == 0): ?>
						<?php echo $this->_tpl_vars['LBL_NEED_TO_ACCEPT']; ?>

					<?php elseif ($this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['status'] == 'Rejected' && $this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['eDelete'] == 'Yes'): ?>
						<?php echo $this->_tpl_vars['LBL_DELETE']; ?>

					<?php else: ?>
						<?php echo ((is_array($_tmp=$this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['status'])) ? $this->_run_mod_handler('htmlentities', true, $_tmp) : htmlentities($_tmp)); ?>

					<?php endif; ?>
			   <?php endif; ?>
				</b>
			</td>
        <td width="74" align="center">
             <?php if ($this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['status'] == 'Rejected'): ?>
                <?php echo smarty_function_assign(array('var' => 'ondelete','value' => ((is_array($_tmp=((is_array($_tmp="Delete('delete','")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['iInvoiceID']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['iInvoiceID'])))) ? $this->_run_mod_handler('cat', true, $_tmp, "')") : smarty_modifier_cat($_tmp, "')"))), $this);?>

            <?php else: ?>
                <?php echo smarty_function_assign(array('var' => 'ondelete','value' => "alert('".($this->_tpl_vars['MSG_REJECTED_INVOICE_DEL'])."')"), $this);?>

            <?php endif; ?>
				<?php if ($this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['status'] == 'Accepted'): ?>
					<a title="<?php echo $this->_tpl_vars['LBL_PRINT']; ?>
" style="cursor:pointer" class="colorboxfile" rel="<?php echo $this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['iInvoiceID']; ?>
"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
report.png"  alt="" border="0" style="vertical-align:middle;" /></a>
			   <?php endif; ?>
            <!-- <a href="#"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/icon-pen.gif"  alt="" border="0" style="vertical-align:middle;" /></a> &nbsp; -->
             <a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
invoiceview/<?php echo $this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['iInvoiceID']; ?>
"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/icon-edit.gif"  alt="" border="0" style="vertical-align:middle;" /></a> &nbsp;
                     </td>
      </tr>
      <?php endfor; endif; ?>
    </table>
        <input type="hidden" name="pg" id="pg" value=""/>
	 <input type="hidden" name="enc" id="enc" value="n" />
<div class="pagging-bg">
	<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<?php if ($this->_tpl_vars['count'] == 0): ?>
			<td align="center" height="27"><!--Showing 1 - 30 Records Of 3838--><?php echo $this->_tpl_vars['pgmsg']; ?>
</td>
			<?php else: ?>
			<td align="left" height="27"><?php echo $this->_tpl_vars['pgmsg']; ?>
</td>
			<?php endif; ?>
			<td align="right"  class="detail-graybg" style="padding-right:12px;">
				<?php echo $this->_tpl_vars['paging']; ?>

				<!--Pages : &nbsp;&nbsp;<span>1</span><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#">Next</a>-->
			</td>
		</tr>
	</table>
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
   <td colspan="5">
         </td>
</tr>
</table>