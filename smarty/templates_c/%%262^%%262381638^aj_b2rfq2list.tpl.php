<?php /* Smarty version 2.6.0, created on 2015-06-26 10:58:59
         compiled from member/user/aj_b2rfq2list.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'assign', 'member/user/aj_b2rfq2list.tpl', 4, false),array('modifier', 'substr', 'member/user/aj_b2rfq2list.tpl', 20, false),array('modifier', 'strtoupper', 'member/user/aj_b2rfq2list.tpl', 20, false),array('modifier', 'number_format', 'member/user/aj_b2rfq2list.tpl', 25, false),)), $this); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<?php if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['dtls']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
      <td width="115" height="27" align="left">&nbsp;
			<?php if ($this->_tpl_vars['usertype'] != 'orgadmin'): ?>
				<input type="checkbox" class="radib-btn" name="iRFQ2Id[]" id="iRFQ2Id" style="vertical-align:middle;" value="<?php echo $this->_tpl_vars['dtls'][$this->_sections['i']['index']]['iRFQ2Id']; ?>
" />
			<?php endif; ?>
			<?php echo $this->_tpl_vars['dtls'][$this->_sections['i']['index']]['vRFQ2Code']; ?>

		</td>
				<td width="70" align="left"><?php echo $this->_tpl_vars['dtls'][$this->_sections['i']['index']]['fAcceptedAmount']; ?>
</td>
		<td width="90" align="left"><?php echo $this->_tpl_vars['dtls'][$this->_sections['i']['index']]['vProductName']; ?>
</td>
		<td width="90" align="left"><?php echo $this->_tpl_vars['dtls'][$this->_sections['i']['index']]['vBuyerName']; ?>
</td>
		<td width="90" align="left"><?php echo $this->_tpl_vars['dtls'][$this->_sections['i']['index']]['vSupplierName']; ?>
</td>
      <td width="40" align="center"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['dtls'][$this->_sections['i']['index']]['eAuctionType'])) ? $this->_run_mod_handler('substr', true, $_tmp, 0, 1) : substr($_tmp, 0, 1)))) ? $this->_run_mod_handler('strtoupper', true, $_tmp) : strtoupper($_tmp)); ?>
</td>
		<td width="30" align="center"><?php echo $this->_tpl_vars['dtls'][$this->_sections['i']['index']]['eBidCriteria']; ?>
</td>
				                <td width="70" align="center"><?php if ($this->_tpl_vars['dtls'][$this->_sections['i']['index']]['rdays'] > 0 || ( $this->_tpl_vars['dtls'][$this->_sections['i']['index']]['rtime'] != '' && $this->_tpl_vars['dtls'][$this->_sections['i']['index']]['rtime'] != '0' )):  if ($this->_tpl_vars['dtls'][$this->_sections['i']['index']]['rdays'] > 0):  echo $this->_tpl_vars['dtls'][$this->_sections['i']['index']]['rdays']; ?>
d<?php endif;  if ($this->_tpl_vars['dtls'][$this->_sections['i']['index']]['rtime'] != '' && $this->_tpl_vars['dtls'][$this->_sections['i']['index']]['rtime'] != '0'):  echo $this->_tpl_vars['dtls'][$this->_sections['i']['index']]['rtime'];  endif;  else: ?>0<?php endif; ?></td>                
		<td width="70" align="center">A:<?php echo ((is_array($_tmp=$this->_tpl_vars['dtls'][$this->_sections['i']['index']]['fBestBidAdvance'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
, P:<?php echo ((is_array($_tmp=$this->_tpl_vars['dtls'][$this->_sections['i']['index']]['fBestBidPrice'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
		<td width="63" align="center"><?php echo $this->_tpl_vars['dtls'][$this->_sections['i']['index']]['totbid']; ?>
</td>
      <td width="70" align="center">
			<?php if ($this->_tpl_vars['dtls'][$this->_sections['i']['index']]['eSaved'] == 'Yes'): ?>
				<?php echo $this->_tpl_vars['LBL_SAV']; ?>

			<?php elseif ($this->_tpl_vars['dtls'][$this->_sections['i']['index']]['eDelete'] == 'Yes'): ?>
				<?php echo $this->_tpl_vars['LBL_DELETE']; ?>

			<?php elseif ($this->_tpl_vars['dtls'][$this->_sections['i']['index']]['eStatus'] == 'Not Started'): ?>
				<?php echo $this->_tpl_vars['LBL_NOT_STARTED']; ?>

			<?php elseif ($this->_tpl_vars['dtls'][$this->_sections['i']['index']]['eStatus'] == 'LIVE'): ?>
				<?php echo $this->_tpl_vars['LBL_LIVE']; ?>

			<?php elseif ($this->_tpl_vars['dtls'][$this->_sections['i']['index']]['eStatus'] == 'Completed'): ?>
				<?php echo $this->_tpl_vars['LBL_COMPLETED']; ?>

			<?php elseif ($this->_tpl_vars['dtls'][$this->_sections['i']['index']]['eStatus'] == 'Cancelled'): ?>
				<?php echo $this->_tpl_vars['LBL_CANCELLED']; ?>

			<?php else: ?>
				<?php echo $this->_tpl_vars['dtls'][$this->_sections['i']['index']]['eStatus']; ?>

			<?php endif; ?>
		</td>
      <td width="50" align="center">
			<a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
b2rfq2view/<?php echo $this->_tpl_vars['dtls'][$this->_sections['i']['index']]['iRFQ2Id']; ?>
"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
bid.png"  alt="" height="27px;" border="0" style="vertical-align:middle;" /></a>&nbsp;
        </td>
   </tr>
   <?php endfor; endif; ?>
</table>
<input type="hidden" name="pg" id="pg" value=""/>
<input type="hidden" name="enc" id="enc" value="n" />
<div class="pagging-bg">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<?php if ($this->_tpl_vars['count'] == 0): ?>
				<td align="center" height="27"><?php echo $this->_tpl_vars['pgmsg']; ?>
</td>
			<?php else: ?>
				<td align="left" height="27"><?php echo $this->_tpl_vars['pgmsg']; ?>
</td>
			<?php endif; ?>
			<td align="right"  class="detail-graybg" style="padding-right:10px;">&nbsp;<?php echo $this->_tpl_vars['paging']; ?>
&nbsp;</td>
		</tr>
	</table>
</div>