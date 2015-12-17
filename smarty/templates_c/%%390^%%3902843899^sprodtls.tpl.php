<?php /* Smarty version 2.6.0, created on 2015-06-26 12:23:55
         compiled from member/user/sprodtls.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'is_array', 'member/user/sprodtls.tpl', 2, false),)), $this); ?>
<table cellpadding="0" cellspacing="0" style="background:#f7f7f7; font-size:14px; width:100%; padding:10px;">
<?php if (((is_array($_tmp=$this->_tpl_vars['dtls'])) ? $this->_run_mod_handler('is_array', true, $_tmp) : is_array($_tmp)) && $this->_tpl_vars['dtls'] != 'nrf'): ?>
<tr>
	<td colspan="2" align="center" valign="top"><b><u><?php echo $this->_tpl_vars['LBL_PRODUCT']; ?>
 <?php echo $this->_tpl_vars['LBL_DETAILS']; ?>
</u></b></td>
</tr>
<tr><td colspan="2" align="center" valign="top">&nbsp;</td></tr>
<tr>
	<td width="190px" valign="top"><?php echo $this->_tpl_vars['LBL_PRODUCT']; ?>
: </td>
	<td align="left"><?php echo $this->_tpl_vars['vProductName']; ?>
 <?php echo $this->_tpl_vars['dtls'][0]['vProductCode']; ?>
</td>
</tr>
<tr>
	<td valign="top"><?php echo $this->_tpl_vars['LBL_AVAILABILITY']; ?>
: </td>
	<td align="left"><?php echo $this->_tpl_vars['dtls'][0]['eAvailability']; ?>
</td>
</tr>
<tr>
	<td valign="top"><?php echo $this->_tpl_vars['LBL_FEE']; ?>
(%): </td>
	<td align="left"><?php if ($this->_tpl_vars['dtls'][0]['fFeePc'] != ''):  echo $this->_tpl_vars['dtls'][0]['fFeePc'];  else: ?>---<?php endif; ?></td>
</tr>
<tr>
	<td valign="top"><?php echo $this->_tpl_vars['LBL_FEE_FLAT']; ?>
: </td>
	<td align="left"><?php if ($this->_tpl_vars['dtls'][0]['fFeeFlat'] != ''):  echo $this->_tpl_vars['dtls'][0]['fFeeFlat'];  else: ?>---<?php endif; ?></td>
</tr>
<tr>
	<td valign="top"><?php echo $this->_tpl_vars['LBL_BANK']; ?>
: </td>
	<td><?php echo $this->_tpl_vars['dtls'][0]['vBankName']; ?>
</td>
</tr>
<tr>
	<td valign="top"><?php echo $this->_tpl_vars['LBL_ACCOUNT_NUMBER']; ?>
: </td>
	<td><?php echo $this->_tpl_vars['dtls'][0]['vBankAccount']; ?>
</td>
</tr>
<?php else: ?>
<tr>
	<td valign="top" colspan="2" style="width:100%; padding:10px;"><div align="center"><h2><?php echo $this->_tpl_vars['LBL_NO_DETAILS_AVAILABLE']; ?>
</h2></div></td>
</tr>
<?php endif; ?>
</table>