<?php /* Smarty version 2.6.0, created on 2012-05-31 12:59:49
         compiled from member/user/b2oudashboard.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'assign', 'member/user/b2oudashboard.tpl', 8, false),array('modifier', 'cat', 'member/user/b2oudashboard.tpl', 8, false),array('modifier', 'htmlentities', 'member/user/b2oudashboard.tpl', 13, false),array('modifier', 'in_array', 'member/user/b2oudashboard.tpl', 45, false),array('modifier', 'strtolower', 'member/user/b2oudashboard.tpl', 48, false),array('modifier', 'count', 'member/user/b2oudashboard.tpl', 104, false),array('modifier', 'calcLTzTime', 'member/user/b2oudashboard.tpl', 118, false),array('modifier', 'DateTime', 'member/user/b2oudashboard.tpl', 118, false),array('modifier', 'getInboxDate', 'member/user/b2oudashboard.tpl', 225, false),)), $this); ?>
<div class="middle-container">
<h1><?php echo $this->_tpl_vars['LBL_DASHBOARD']; ?>
</h1>
<div class="middle-containt sortable" id="one">

<div class="statistics-main-box" id="foo_1">
   <div class="statistics-box"><h2><img class="plusminus-img" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/minus-icon.gif" style="cursor:pointer;"/><?php echo $this->_tpl_vars['LBL_STATISTICS']; ?>
</h2>
      <div class="statistics-text">
		<?php echo smarty_function_assign(array('var' => 'field','value' => ((is_array($_tmp='vStatus_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['LANG']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['LANG']))), $this);?>

      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
	      <tr><td> &nbsp;</td>
			<?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['sts']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<td height="25px" width="50px" align="center" class="listing-name-blue-1">
		     <?php if (((is_array($_tmp=$this->_tpl_vars['sts'][$this->_sections['l']['index']]['vStatus'])) ? $this->_run_mod_handler('htmlentities', true, $_tmp) : htmlentities($_tmp)) == 'Accepted'): ?>
			<?php echo $this->_tpl_vars['LBL_AUTHORISED']; ?>

		     <?php else: ?>
		     <?php echo ((is_array($_tmp=$this->_tpl_vars['sts'][$this->_sections['l']['index']]['vStatus'])) ? $this->_run_mod_handler('htmlentities', true, $_tmp) : htmlentities($_tmp)); ?>

		     <?php endif; ?>
			</td>
      	<?php endfor; endif; ?>
      	<td width="50px" align="center" class="listing-name-blue-1"><?php echo $this->_tpl_vars['LBL_TOTAL']; ?>
</td>
		</tr>
		<tr>
			<td class="listing-name-grey-border-to-1"><?php echo $this->_tpl_vars['LBL_BIDS']; ?>
</td>
			<?php echo smarty_function_assign(array('var' => 'st','value' => 0), $this);?>

			<?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['sts']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			   <td height="29" align="center" class="listing-name-grey-border-nomber-1">
					<?php echo smarty_function_assign(array('var' => 'vl','value' => $this->_tpl_vars['sts'][$this->_sections['l']['index']]['vStatus_en']), $this);?>

					<?php if ($this->_tpl_vars['sts'][$this->_sections['l']['index']]['vStatus_en'] == 'Auth1' || $this->_tpl_vars['sts'][$this->_sections['l']['index']]['vStatus_en'] == 'Auth2' || $this->_tpl_vars['sts'][$this->_sections['l']['index']]['vStatus_en'] == 'Auth3'): ?> x 
					<?php elseif ($this->_tpl_vars['bidstatistic'][$this->_tpl_vars['vl']] != ''): ?> 					<?php if ($this->_tpl_vars['bidstatistic'][$this->_tpl_vars['vl']] != 'x'): ?><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
b2rfq2bidlist/<?php if ($this->_tpl_vars['vl'] != 'Rejected'):  echo $this->_tpl_vars['st'];  else:  echo $this->_tpl_vars['sts'][$this->_sections['l']['index']]['iStatusID'];  endif; ?>/b2"><?php endif;  echo $this->_tpl_vars['bidstatistic'][$this->_tpl_vars['vl']];  if ($this->_tpl_vars['bidstatistic'][$this->_tpl_vars['vl']] != 'x'): ?></a><?php endif; ?>
					<?php echo smarty_function_assign(array('var' => 'st','value' => $this->_tpl_vars['sts'][$this->_sections['l']['index']]['iStatusID']), $this);?>

					<?php else: ?>0<?php endif; ?>
			   </td>
			<?php endfor; endif; ?>
			<td align="center" class="listing-name-grey-total-1">
			   <?php if ($this->_tpl_vars['bidstatistic']['ttol'] != ''):  echo $this->_tpl_vars['bidstatistic']['ttol'];  else: ?>0<?php endif; ?>
			</td>
		</tr>
		<tr>
			<td class="listing-name-grey-border-to-1"><?php echo $this->_tpl_vars['LBL_AWARD']; ?>
</td>
				<?php echo smarty_function_assign(array('var' => 'tot','value' => 0), $this);?>

				<?php echo smarty_function_assign(array('var' => 'st','value' => 0), $this);?>

				<?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['sts']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
					<td height="29" align="center" class="listing-name-grey-border-nomber-1">
						<?php if (((is_array($_tmp=$this->_tpl_vars['sts'][$this->_sections['l']['index']]['iStatusID'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['aworgsts']) : in_array($_tmp, $this->_tpl_vars['aworgsts']))): ?>
							<?php echo smarty_function_assign(array('var' => 'vl','value' => $this->_tpl_vars['sts'][$this->_sections['l']['index']]['vStatus_en']), $this);?>

							<?php echo smarty_function_assign(array('var' => 'vll','value' => $this->_tpl_vars['sts'][$this->_sections['l']['index']]['iStatusID']), $this);?>

							<?php if (((is_array($_tmp=$this->_tpl_vars['vl'])) ? $this->_run_mod_handler('strtolower', true, $_tmp) : strtolower($_tmp)) == 'rejected' || ((is_array($_tmp=$this->_tpl_vars['vl'])) ? $this->_run_mod_handler('strtolower', true, $_tmp) : strtolower($_tmp)) == 'accepted'):  echo smarty_function_assign(array('var' => 'st','value' => $this->_tpl_vars['vll']), $this); endif; ?>
							<?php if ($this->_tpl_vars['award'][$this->_tpl_vars['st']] != ''): ?>
							<?php if ($this->_tpl_vars['award'][$this->_tpl_vars['st']] != 0): ?>
							<a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
b2rfq2awardlist/<?php echo $this->_tpl_vars['st']; ?>
"><?php echo $this->_tpl_vars['award'][$this->_tpl_vars['st']]; ?>
</a>
							<?php echo smarty_function_assign(array('var' => 'tot','value' => ($this->_tpl_vars['tot']+$this->_tpl_vars['award'][$this->_tpl_vars['st']])), $this);?>

							<?php else: ?>
							<?php echo $this->_tpl_vars['award'][$this->_tpl_vars['st']]; ?>

							<?php endif; ?>
							<?php echo smarty_function_assign(array('var' => 'st','value' => $this->_tpl_vars['sts'][$this->_sections['l']['index']]['iStatusID']), $this);?>

							<?php else: ?> 0 <?php endif; ?>
						<?php else: ?> x <?php endif; ?>
					</td>
				<?php endfor; endif; ?>
			<td align="center" class="listing-name-grey-total-1">
			   <?php if ($this->_tpl_vars['tot'] != ''):  echo $this->_tpl_vars['tot'];  else: ?>0<?php endif; ?>
			</td>
		</tr>
		<tr><td colspan="11" class="listing-name-grey-border-to-1" style="height:1px;"></td></tr>
      </table>
		<div style="height:3px;">&nbsp;</div>
		<h2 style="background:#ececec; border-bottom:1px solid #cecece;"><?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
&nbsp;<?php echo $this->_tpl_vars['LBL_COUNTS']; ?>
</h2>
		<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td width="170px">&nbsp;</td>
				<td height="25px" align="center" class="listing-name-blue-1"><?php echo $this->_tpl_vars['LBL_LIVE']; ?>
</td>
				<td height="25px" align="center" class="listing-name-blue-1"><?php echo $this->_tpl_vars['LBL_COMPLETED']; ?>
</td>
				<td height="25px" align="center" class="listing-name-blue-1"><?php echo $this->_tpl_vars['LBL_AWARDED']; ?>
</td>
			</tr>
			<tr>
				<td class="listing-name-grey-border-to-1" height="25"><?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
</td>				
				<td class="listing-name-grey-border-to-1" align="center"  height="25"><?php if ($this->_tpl_vars['getRfq2countarr']['Live'] != ''): ?><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
b2rfq2list/1/rfq2count"><?php echo $this->_tpl_vars['getRfq2countarr']['Live']; ?>
</a><?php else: ?>0<?php endif; ?></td>
				<td class="listing-name-grey-border-to-1" align="center" height="25"><?php if ($this->_tpl_vars['getRfq2countarr']['Completed'] != ''): ?><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
b2rfq2list/2/rfq2count"><?php echo $this->_tpl_vars['getRfq2countarr']['Completed']; ?>
</a><?php else: ?>0<?php endif; ?></td>
				<td class="listing-name-grey-total-1" align="center" height="25"><?php if ($this->_tpl_vars['getRfq2countarr']['Awarded'] != ''):  echo $this->_tpl_vars['getRfq2countarr']['Awarded'];  else: ?>0<?php endif; ?></td>
			</tr>
			<tr><td colspan="11" class="listing-name-grey-border-to-1" style="height:1px;"></td></tr>
		</table>
		<div style="height:3px;">&nbsp;</div>
		<h2 style="background:#ececec; border-bottom:1px solid #cecece;"><?php echo $this->_tpl_vars['LBL_BID']; ?>
&nbsp;<?php echo $this->_tpl_vars['LBL_COUNTS']; ?>
</h2>
		<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td width="170px">&nbsp;</td>
								<td height="25px" align="center" class="listing-name-blue-1"><?php echo $this->_tpl_vars['LBL_CURRENT']; ?>
</td>
				<td height="25px" align="center" class="listing-name-blue-1"><?php echo $this->_tpl_vars['LBL_OUTBIDDED']; ?>
</td>
				<td height="25px" align="center" class="listing-name-blue-1"><?php echo $this->_tpl_vars['LBL_AWARDED']; ?>
</td>
							</tr>
			<tr>
				<td class="listing-name-grey-border-to-1" height="25"><?php echo $this->_tpl_vars['LBL_BIDS']; ?>
</td>
				<?php echo smarty_function_assign(array('var' => 'ln','value' => 0), $this);?>

				<?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['bsts']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<?php if ($this->_tpl_vars['bsts'][$this->_sections['l']['index']] == 'current'): ?>
				<?php echo smarty_function_assign(array('var' => 'stsid','value' => 1), $this);?>

				<?php else: ?>
				<?php echo smarty_function_assign(array('var' => 'stsid','value' => 2), $this);?>

				<?php endif; ?>
					<td height="25" align="center" class="<?php if ($this->_sections['l']['index']+1 == count($this->_tpl_vars['bsts'])): ?>listing-name-grey-total-1<?php else: ?>listing-name-grey-border-nomber-1<?php endif; ?>">
						<?php if (((is_array($_tmp=$this->_tpl_vars['bsts'][$this->_sections['l']['index']])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['b2sts']) : in_array($_tmp, $this->_tpl_vars['b2sts']))):  if ($this->_tpl_vars['bsts'][$this->_sections['l']['index']] != 'awarded'): ?><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
b2rfq2bidlist/<?php echo $this->_tpl_vars['stsid']; ?>
/bidcount"><?php echo $this->_tpl_vars['bidstats'][$this->_tpl_vars['ln']]['cnt']; ?>
</a><?php else:  echo $this->_tpl_vars['bidstats'][$this->_tpl_vars['ln']]['cnt'];  endif;  echo smarty_function_assign(array('var' => 'ln','value' => ($this->_tpl_vars['ln']+1)), $this); else: ?> 0 <?php endif; ?>
					</td>
				<?php endfor; endif; ?>
			</tr>
			<tr><td colspan="11" class="listing-name-grey-border-to-1" style="height:1px;"></td></tr>
		</table>
      </div>
   </div>
	<div class="login-box">
			<h2><img class="plusminus-img" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/minus-icon.gif" style="cursor:pointer;"/> <?php echo $this->_tpl_vars['LBL_LAST_3_LOGIN']; ?>
</h2>
			<div class="login-text">
			<?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['lastlogins']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				 <p>
					 <?php echo $this->_tpl_vars['LBL_LAST_LOGIN']; ?>
 : <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['lastlogins'][$this->_sections['l']['index']]['dLoginDate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)))) ? $this->_run_mod_handler('DateTime', true, $_tmp, 7) : DateTime($_tmp, 7)); ?>
 <br/>
					 <?php echo $this->_tpl_vars['LBL_IP_ADDRESS']; ?>
 : <?php echo $this->_tpl_vars['lastlogins'][$this->_sections['l']['index']]['vIP']; ?>

				 </p>
			<?php endfor; else: ?>
				<p>
					 <?php echo $this->_tpl_vars['LBL_NO_REC_AVAILABLE']; ?>

				</p>
			<?php endif; ?>
		</div>
		</div>
</div>
	
<div class="organization-main-box column" id="foo_2">
   <div class="organization-box">
      <h2><img class="plusminus-img" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/minus-icon.gif" style="cursor:pointer;"/> <?php echo $this->_tpl_vars['LBL_BIDS']; ?>
</h2>
        <div class="organization-text">
         <?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['resbid']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
         <span style="display:inline-block; width:370px;"><b style="font-size:12.9px;"><?php echo $this->_tpl_vars['LBL_BID_NO']; ?>
: <a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
viewsrfq2bid/<?php echo $this->_tpl_vars['resbid'][$this->_sections['l']['index']]['iBidId']; ?>
"><b style="font-size:12.9px;"><?php echo $this->_tpl_vars['resbid'][$this->_sections['l']['index']]['vBidNum']; ?>
</b></a></b></span><span display:inline-block;><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['resbid'][$this->_sections['l']['index']]['dBidDate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)))) ? $this->_run_mod_handler('DateTime', true, $_tmp, 10) : DateTime($_tmp, 10)); ?>
</span>
         <p>
            <label style="display:inline-block; width:90px;"><b><?php echo $this->_tpl_vars['LBL_RFQ2_CODE']; ?>
:</b></label> <?php echo $this->_tpl_vars['resbid'][$this->_sections['l']['index']]['vRFQ2Code']; ?>
<br/>
            <label style="display:inline-block; width:90px;"><b><?php echo $this->_tpl_vars['LBL_BID']; ?>
 <?php echo $this->_tpl_vars['LBL_ADVANCE']; ?>
:</b></label> <?php echo $this->_tpl_vars['resbid'][$this->_sections['l']['index']]['fBidAdvanceTotal']; ?>
<br/>
            <label style="display:inline-block; width:90px;"><b><?php echo $this->_tpl_vars['LBL_BID']; ?>
 <?php echo $this->_tpl_vars['LBL_PRICE']; ?>
:</b></label> <?php echo $this->_tpl_vars['resbid'][$this->_sections['l']['index']]['fBidPriceTotal']; ?>
<br/>
            <label style="display:inline-block; width:90px;"><b><?php echo $this->_tpl_vars['LBL_STATUS']; ?>
:</b></label> <?php echo $this->_tpl_vars['resbid'][$this->_sections['l']['index']]['eStatus']; ?>
 <br/>
         </p>
			<?php endfor; else: ?>
			<p>
				<?php echo $this->_tpl_vars['LBL_NO_REC_AVAILABLE']; ?>

			</p>
			<?php endif; ?>
         <em><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
b2rfq2bidlist"><?php echo $this->_tpl_vars['LBL_VIEW_MORE']; ?>
</a></em>
      </div>
   </div>
   <div class="organization-to-verify-box"><h2><img class="plusminus-img" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/minus-icon.gif" style="cursor:pointer;"/><?php echo $this->_tpl_vars['LBL_AWARDS']; ?>
</h2>
   <div class="organization-to-verify-text">
      <?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['latestaward']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<p>
			<span style="display:inline-block; width:359px;"><b style="font-size:12.9px;"><?php echo $this->_tpl_vars['LBL_AWARD_NO']; ?>
:</b>&nbsp;<a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
b2rfq2awardview/<?php echo $this->_tpl_vars['latestaward'][$this->_sections['l']['index']]['iAwardId']; ?>
"><b style="font-size:12.9px;"><?php echo $this->_tpl_vars['latestaward'][$this->_sections['l']['index']]['vAwardNum']; ?>
</b></a></span>
			<span><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['latestaward'][$this->_sections['l']['index']]['dADate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)))) ? $this->_run_mod_handler('DateTime', true, $_tmp, 10) : DateTime($_tmp, 10)); ?>
</span><br>
		  <label><?php echo $this->_tpl_vars['LBL_RFQ2_CODE']; ?>
:</label>&nbsp;<?php echo $this->_tpl_vars['latestaward'][$this->_sections['l']['index']]['vRFQ2Code']; ?>
<br>
		  <label><?php echo $this->_tpl_vars['LBL_BUYER2']; ?>
:</label>&nbsp;<?php echo $this->_tpl_vars['latestaward'][$this->_sections['l']['index']]['vCompanyName']; ?>
<br>
		  <label><?php echo $this->_tpl_vars['LBL_ADVANCE_TOTAL']; ?>
:</label>&nbsp;<?php echo $this->_tpl_vars['latestaward'][$this->_sections['l']['index']]['fBidAdvanceTotal']; ?>
<br>
		  <label><?php echo $this->_tpl_vars['LBL_PRICE_TOTAL']; ?>
:</label>&nbsp;<?php echo $this->_tpl_vars['latestaward'][$this->_sections['l']['index']]['fBidPriceTotal']; ?>
<br>
		  <label><?php echo $this->_tpl_vars['LBL_STATUS']; ?>
:</label>&nbsp;<?php echo $this->_tpl_vars['latestaward'][$this->_sections['l']['index']]['vStatus_en']; ?>

	       </p> 
		<?php endfor; else: ?>
		<p>
			<?php echo $this->_tpl_vars['LBL_NO_REC_AVAILABLE']; ?>

		</p>
		<?php endif; ?>
		<?php if (count($this->_tpl_vars['latestaward']) > 0): ?>
      <em><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
b2rfq2awardlist"><?php echo $this->_tpl_vars['LBL_VIEW_MORE']; ?>
</a></em>
		<?php endif; ?>
   </div>
   </div>
</div>
	
<div class="association-main-box column" id="foo_5">
   <h2><img class="plusminus-img" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/minus-icon.gif" style="cursor:pointer;"/> <?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
</h2>
   <div class="clear">
      <table width="98%" border="0" align="center" cellpadding="0" class="user-text" cellspacing="0">
	 <?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['latestrfq2']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	   
	 <div class="association-text">
		 <span style="display:inline-block; width:370px;"><b style="font-size:12.9px;"><?php echo $this->_tpl_vars['LBL_RFQ2_CODE']; ?>
:</b> <a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
b2rfq2view/<?php echo $this->_tpl_vars['latestrfq2'][$this->_sections['l']['index']]['iRFQ2Id']; ?>
"><b style="font-size:12.9px;"><?php echo $this->_tpl_vars['latestrfq2'][$this->_sections['l']['index']]['vRFQ2Code']; ?>
</b></a></span>	 
         <p>
            <label><?php echo $this->_tpl_vars['LBL_INVOICE_CODE']; ?>
:</label> <?php echo $this->_tpl_vars['latestrfq2'][$this->_sections['l']['index']]['vInvoiceCode']; ?>
<br/>
            <label><?php echo $this->_tpl_vars['LBL_AUCTION_TYPE']; ?>
:</label> <?php echo $this->_tpl_vars['latestrfq2'][$this->_sections['l']['index']]['eAuctionType']; ?>
<br/>
            <label><?php echo $this->_tpl_vars['LBL_START_DATE']; ?>
:</label> <?php echo ((is_array($_tmp=$this->_tpl_vars['latestrfq2'][$this->_sections['l']['index']]['dStartDate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)); ?>
&nbsp;<br/>
	    <label><?php echo $this->_tpl_vars['LBL_END_DATE']; ?>
:</label><?php echo ((is_array($_tmp=$this->_tpl_vars['latestrfq2'][$this->_sections['l']['index']]['dEndDate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)); ?>
<br/>
            <label><?php echo $this->_tpl_vars['LBL_AUCTION_STATUS']; ?>
:</label> <?php echo $this->_tpl_vars['latestrfq2'][$this->_sections['l']['index']]['eAuctionStatus']; ?>

         </p>
	    
	 </div>
	<?php endfor; else: ?>
		<div class="association-text">
			<p>
		<?php echo $this->_tpl_vars['LBL_NO_REC_AVAILABLE']; ?>

			</p>
		</div>
	<?php endif; ?>
	<div class="clear" align="right">
	 <em><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
b2rfq2list" class="viewmorelink"><?php echo $this->_tpl_vars['LBL_VIEW_MORE']; ?>
&nbsp;&nbsp;</a></em>
	</div>
      </table>
   </div>
</div>   
   
   
<div class="association-main-box column" id="foo_3">
   <h2><img class="plusminus-img" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/minus-icon.gif" style="cursor:pointer;"/> <?php echo $this->_tpl_vars['LBL_INBOX']; ?>
 (<?php echo $this->_tpl_vars['totInboxres']; ?>
)</h2>
   <div class="clear">
      <table width="98%" border="0" align="center" cellpadding="0" class="user-text" cellspacing="0">
      <!--
      <tr>
         <td width="42" height="30" align="center">&nbsp;</td>
         <td width="598">&nbsp;</td>
         <td width="87" align="center"><a href="#"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-delete-1.gif" alt="" border="0" /></a></td>
      </tr>
-->
       <?php if (count($this->_tpl_vars['res']) > 0): ?>
         <?php echo smarty_function_assign(array('var' => 'field','value' => ((is_array($_tmp='vMailSubject_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['LANG']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['LANG']))), $this);?>

         <?php if (isset($this->_sections['in'])) unset($this->_sections['in']);
$this->_sections['in']['name'] = 'in';
$this->_sections['in']['loop'] = is_array($_loop=$this->_tpl_vars['res']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['in']['show'] = true;
$this->_sections['in']['max'] = $this->_sections['in']['loop'];
$this->_sections['in']['step'] = 1;
$this->_sections['in']['start'] = $this->_sections['in']['step'] > 0 ? 0 : $this->_sections['in']['loop']-1;
if ($this->_sections['in']['show']) {
    $this->_sections['in']['total'] = $this->_sections['in']['loop'];
    if ($this->_sections['in']['total'] == 0)
        $this->_sections['in']['show'] = false;
} else
    $this->_sections['in']['total'] = 0;
if ($this->_sections['in']['show']):

            for ($this->_sections['in']['index'] = $this->_sections['in']['start'], $this->_sections['in']['iteration'] = 1;
                 $this->_sections['in']['iteration'] <= $this->_sections['in']['total'];
                 $this->_sections['in']['index'] += $this->_sections['in']['step'], $this->_sections['in']['iteration']++):
$this->_sections['in']['rownum'] = $this->_sections['in']['iteration'];
$this->_sections['in']['index_prev'] = $this->_sections['in']['index'] - $this->_sections['in']['step'];
$this->_sections['in']['index_next'] = $this->_sections['in']['index'] + $this->_sections['in']['step'];
$this->_sections['in']['first']      = ($this->_sections['in']['iteration'] == 1);
$this->_sections['in']['last']       = ($this->_sections['in']['iteration'] == $this->_sections['in']['total']);
?>
         <tr>
            <td height="30" width="10" align="left" class="user-gray-bot-bor">
               <!--<span class="golden"><input type="checkbox" class="radib-btn" name="checkbox2" id="checkbox2" style="vertical-align:middle;" /></span>-->
            </td>
            <td class="user-gray-bot-bor" height="30" width="79%"><strong><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
inboxdetail/<?php echo $this->_tpl_vars['res'][$this->_sections['in']['index']]['iVerifiedID']; ?>
"><?php echo $this->_tpl_vars['res'][$this->_sections['in']['index']][$this->_tpl_vars['field']]; ?>
</a></strong></td>
            <td align="right" class="user-gray-bot-bor"><strong><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['res'][$this->_sections['in']['index']]['dActionDate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)))) ? $this->_run_mod_handler('getInboxDate', true, $_tmp) : getInboxDate($_tmp)); ?>
</strong></td>
         </tr>
         <?php endfor; endif; ?>
			<tr>
				<td colspan="3" align="right"><?php if ($this->_tpl_vars['totInboxres'] > count($this->_tpl_vars['res'])): ?><em><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
inbox" class="viewmorelink"><?php echo $this->_tpl_vars['LBL_VIEW_MORE']; ?>
</a></em><?php endif; ?></td>
			</tr>
      <?php else: ?>
      <tr>
         <td height="30" colspan="3" align="center" class="user-gray-bot-bor">
            <strong><?php echo $this->_tpl_vars['LBL_NO_RECENT_MESSAGES']; ?>
</strong>
         </td>
      </tr>
      <?php endif; ?>
      <tr>
         <td align="center">&nbsp;</td>
         <td>&nbsp;</td>
         <td align="right"></td>
      </tr>
   </table>
   </div>
</div>

</div>
</div>
<?php echo '
<script>
var cookie = \'';  echo $this->_tpl_vars['tDashboard'];  echo '\';
</script>
'; ?>

<script type="text/javascript" src="<?php echo $this->_tpl_vars['SITE_JS_AJAX']; ?>
jOuDashboard.js"></script>