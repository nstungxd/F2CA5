<?php /* Smarty version 2.6.0, created on 2012-05-31 15:43:00
         compiled from member/organization/oadashboard.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'calcLTzTime', 'member/organization/oadashboard.tpl', 61, false),array('modifier', 'DateTime', 'member/organization/oadashboard.tpl', 61, false),array('modifier', 'count', 'member/organization/oadashboard.tpl', 161, false),array('modifier', 'in_array', 'member/organization/oadashboard.tpl', 162, false),array('modifier', 'cat', 'member/organization/oadashboard.tpl', 363, false),array('modifier', 'getInboxDate', 'member/organization/oadashboard.tpl', 370, false),array('function', 'assign', 'member/organization/oadashboard.tpl', 146, false),)), $this); ?>
<link href="<?php echo $this->_tpl_vars['SITE_CSS']; ?>
jquery-ui-1.7.2.css" rel="stylesheet" type="text/css" />
<div class="middle-container">
<h1><?php echo $this->_tpl_vars['LBL_DASHBOARD']; ?>
 </h1>
<div>
<div class="middle-containt sortable" id="one">
   <div class="statistics-main-box" id="foo_1">
	<div class="user-box"><h2><img class="plusminus-img" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/minus-icon.gif" /> <?php echo $this->_tpl_vars['LBL_STATISTICS']; ?>
</h2>
	<div class="statistics-text" style="background:#f7f7f7;">
   <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
         <td width="200" height="24">&nbsp;</td>
         <td width="75" align="center" class="listing-name-blue"><?php echo $this->_tpl_vars['LBL_ACTIVE']; ?>
</td>
       	<td width="75" align="center" class="listing-name-blue"><?php echo $this->_tpl_vars['LBL_INACTIVE']; ?>
</td>
			<td width="75" align="center" class="listing-name-blue"><?php echo $this->_tpl_vars['LBL_NOT_VERIFIED']; ?>
</td>
         <td width="60" align="center" class="listing-name-blue"><?php echo $this->_tpl_vars['LBL_TOTAL']; ?>
 </td>
      </tr>
      <tr>
         <td height="23" class="listing-name-grey-border-to-1"><?php echo $this->_tpl_vars['LBL_ASSOCIATIONS']; ?>
</td>
         <td align="center" class="listing-name-grey-border-nomber-1"><?php if ($this->_tpl_vars['assocstats'][0]['actrec'] > 0): ?><a onclick="showlist('asoc','act');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['assocstats'][0]['actrec']; ?>
&nbsp;<?php if ($this->_tpl_vars['assocstats'][0]['actrec'] > 0): ?></a><?php endif; ?></td>
         <td align="center" class="listing-name-grey-border-nomber-1"><?php if ($this->_tpl_vars['assocstats'][0]['inactrec'] > 0): ?><a onclick="showlist('asoc','inact');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['assocstats'][0]['inactrec']; ?>
&nbsp;<?php if ($this->_tpl_vars['assocstats'][0]['inactrec'] > 0): ?></a><?php endif; ?></td>
         <td align="center" class="listing-name-grey-border-nomber-1"><?php if ($this->_tpl_vars['assocstats'][0]['verify_org'] > 0): ?><a onclick="showlist('asoc','nvfy');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['assocstats'][0]['verify_org']; ?>
&nbsp;<?php if ($this->_tpl_vars['assocstats'][0]['verify_org'] > 0): ?></a><?php endif; ?></td>
         <td align="center" class="listing-name-grey-total-1"><?php echo $this->_tpl_vars['assocstats'][0]['tot']; ?>
</td>
      </tr>
      <tr>
         <td height="23" class="listing-name-grey-border-to-1"><?php echo $this->_tpl_vars['LBL_GROUPS']; ?>
</td>
         <td align="center" class="listing-name-grey-border-nomber-1"><?php if ($this->_tpl_vars['groupstats'][0]['actrec'] > 0): ?><a onclick="showlist('grp','act');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['groupstats'][0]['actrec']; ?>
&nbsp;<?php if ($this->_tpl_vars['groupstats'][0]['actrec'] > 0): ?></a><?php endif; ?></td>
         <td align="center" class="listing-name-grey-border-nomber-1"><?php if ($this->_tpl_vars['groupstats'][0]['inactrec'] > 0): ?><a onclick="showlist('grp','inact');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['groupstats'][0]['inactrec']; ?>
&nbsp;<?php if ($this->_tpl_vars['groupstats'][0]['inactrec'] > 0): ?></a><?php endif; ?></td>
         <td align="center" class="listing-name-grey-border-nomber-1"><?php if ($this->_tpl_vars['groupstats'][0]['verify_org'] > 0): ?><a onclick="showlist('grp','nvfy');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['groupstats'][0]['verify_org']; ?>
&nbsp;<?php if ($this->_tpl_vars['groupstats'][0]['verify_org'] > 0): ?></a><?php endif; ?></td>
         <td align="center" class="listing-name-grey-total-1"><?php echo $this->_tpl_vars['groupstats'][0]['tot']; ?>
</td>
      </tr>
      <tr>
         <td height="23" class="listing-name-grey-border-to-1"><?php echo $this->_tpl_vars['LBL_ADMINS']; ?>
</td>
         <td align="center" class="listing-name-grey-border-nomber-1"><?php if ($this->_tpl_vars['orgadminstats'][0]['actrec'] > 0): ?><a onclick="showlist('adm','act');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['orgadminstats'][0]['actrec']; ?>
&nbsp;<?php if ($this->_tpl_vars['orgadminstats'][0]['actrec'] > 0): ?></a><?php endif; ?></td>
         <td align="center" class="listing-name-grey-border-nomber-1"><?php if ($this->_tpl_vars['orgadminstats'][0]['inactrec'] > 0): ?><a onclick="showlist('adm','inact');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['orgadminstats'][0]['inactrec']; ?>
&nbsp;<?php if ($this->_tpl_vars['orgadminstats'][0]['inactrec'] > 0): ?></a><?php endif; ?></td>
         <td align="center" class="listing-name-grey-border-nomber-1"><?php if ($this->_tpl_vars['orgadminstats'][0]['verify_org'] > 0): ?><a onclick="showlist('adm','nvfy');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['orgadminstats'][0]['verify_org']; ?>
&nbsp;<?php if ($this->_tpl_vars['orgadminstats'][0]['verify_org'] > 0): ?></a><?php endif; ?></td>
         <td align="center" class="listing-name-grey-total-1"><?php echo $this->_tpl_vars['orgadminstats'][0]['tot']; ?>
</td>
      </tr>
      <tr>
         <td height="23" class="listing-name-grey-border-to-1"><?php echo $this->_tpl_vars['LBL_USERS']; ?>
</td>
         <td align="center" class="listing-name-grey-border-nomber-1"><?php if ($this->_tpl_vars['orguserstats'][0]['actrec'] > 0): ?><a onclick="showlist('usr','act');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['orguserstats'][0]['actrec']; ?>
&nbsp;<?php if ($this->_tpl_vars['orguserstats'][0]['actrec'] > 0): ?></a><?php endif; ?></td>
         <td align="center" class="listing-name-grey-border-nomber-1"><?php if ($this->_tpl_vars['orguserstats'][0]['inactrec'] > 0): ?><a onclick="showlist('usr','inact');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['orguserstats'][0]['inactrec']; ?>
&nbsp;<?php if ($this->_tpl_vars['orguserstats'][0]['inactrec'] > 0): ?></a><?php endif; ?></td>
         <td align="center" class="listing-name-grey-border-nomber-1"><?php if ($this->_tpl_vars['orguserstats'][0]['verify_org'] > 0): ?><a onclick="showlist('usr','nvfy');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['orguserstats'][0]['verify_org']; ?>
&nbsp;<?php if ($this->_tpl_vars['orguserstats'][0]['verify_org'] > 0): ?></a><?php endif; ?></td>
         <td align="center" class="listing-name-grey-total-1"><?php echo $this->_tpl_vars['orguserstats'][0]['tot']; ?>
</td>
      </tr>
      <tr>
         <td height="23" class="listing-name-grey-border-to-1"><?php echo $this->_tpl_vars['LBL_USER_RIGHTS']; ?>
</td>
         <td align="center" class="listing-name-grey-border-nomber-1"><?php if ($this->_tpl_vars['userrightsstats'][0]['actrec'] > 0): ?><a onclick="showlist('vur','act');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['userrightsstats'][0]['actrec']; ?>
&nbsp;<?php if ($this->_tpl_vars['userrightsstats'][0]['actrec'] > 0): ?></a><?php endif; ?></td>
        <td align="center" class="listing-name-grey-border-nomber-1"><?php if ($this->_tpl_vars['userrightsstats'][0]['inactrec'] > 0): ?><a onclick="showlist('vur','inact');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['userrightsstats'][0]['inactrec']; ?>
&nbsp;<?php if ($this->_tpl_vars['userrightsstats'][0]['inactrec'] > 0): ?></a><?php endif; ?></td>
        <td align="center" class="listing-name-grey-border-nomber-1"><?php if ($this->_tpl_vars['userrightsstats'][0]['verify_org'] > 0): ?><a onclick="showlist('vur','nvfy');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['userrightsstats'][0]['verify_org']; ?>
&nbsp;<?php if ($this->_tpl_vars['userrightsstats'][0]['verify_org'] > 0): ?></a><?php endif; ?></td>
         <td align="center" class="listing-name-grey-total-1"><?php echo $this->_tpl_vars['userrightsstats'][0]['tot']; ?>
</td>
      </tr>
      <tr><td colspan="5" class="listing-name-grey-border-to-1" style="height:1px;"></td></tr>
   </table>
   </div>
   </div>
   <div class="user-login-box">
		<h2><img class="plusminus-img" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/minus-icon.gif" /> <?php echo $this->_tpl_vars['LBL_LAST_3_LOGIN']; ?>
</h2>
		<div class="user-login-text">
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
 : &nbsp; <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['lastlogins'][$this->_sections['l']['index']]['dLoginDate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)))) ? $this->_run_mod_handler('DateTime', true, $_tmp, 7) : DateTime($_tmp, 7)); ?>
 <br/>
					<?php echo $this->_tpl_vars['LBL_IP_ADDRESS']; ?>
 : &nbsp; <?php echo $this->_tpl_vars['lastlogins'][$this->_sections['l']['index']]['vIP']; ?>

					</p>
				<?php endfor; else: ?>
					<p>
						<?php echo $this->_tpl_vars['LBL_NO_REC_AVAILABLE']; ?>

					</p>
				<?php endif; ?>
			</div>
      </div>
</div>

<?php if ($this->_tpl_vars['ENABLE_AUCTION'] == 'Yes'): ?>
<div class="association-main-box column" id="foo_6">
   <h2><img class="plusminus-img" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/minus-icon.gif" /> <?php echo $this->_tpl_vars['LBL_BUYER']; ?>
2 <?php echo $this->_tpl_vars['LBL_ASSOCIATIONS']; ?>
 &nbsp; (<?php echo $this->_tpl_vars['LBL_AUCTION_TENDER']; ?>
)</h2>
	<?php if ($this->_tpl_vars['uorg_type'] != 'Supplier'): ?>
		<div class="association-text">
		<h3><?php echo $this->_tpl_vars['LBL_BUYER2_BUYER']; ?>
 <?php echo $this->_tpl_vars['LBL_ASSOCIATION']; ?>
</h3>
			<p>
				<?php echo $this->_tpl_vars['LBL_BUYER2']; ?>
:<span> <?php echo $this->_tpl_vars['b2by_dtls'][0]['vBuyer2']; ?>
</span>
				<?php echo $this->_tpl_vars['LBL_DATE']; ?>
 :<span> <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['b2by_dtls'][0]['dADate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)))) ? $this->_run_mod_handler('DateTime', true, $_tmp, 10) : DateTime($_tmp, 10)); ?>
</span><br/>
				<?php echo $this->_tpl_vars['LBL_BPRODUCT']; ?>
: <span><?php echo $this->_tpl_vars['b2by_dtls'][0]['vBuyer']; ?>
</span><br />
				<?php echo $this->_tpl_vars['LBL_CODE']; ?>
: <span><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
b2buyerasocview/<?php echo $this->_tpl_vars['b2by_dtls'][0]['iAssociationId']; ?>
" style="text-decoration:underline;"><?php echo $this->_tpl_vars['b2by_dtls'][0]['vACode']; ?>
</a></span><br />
				<?php if ($this->_tpl_vars['b2byb_dtls'][0]['eStatus'] != 'Need to Verify' && $this->_tpl_vars['b2by_dtls'][0]['eStatus'] != 'Modified' && $this->_tpl_vars['b2by_dtls'][0]['eNeedToVerify'] != 'Yes'): ?>
					<?php if ($this->_tpl_vars['b2by_dtls'][0]['vVerifiedBy'] != ''): ?>Verified By :<span> <?php echo $this->_tpl_vars['b2by_dtls'][0]['vVerifiedBy']; ?>
</span><?php endif; ?>
				<?php else: ?> <?php echo $this->_tpl_vars['LBL_STATUS']; ?>
 :<span> <?php echo $this->_tpl_vars['b2by_dtls'][0]['eStatus']; ?>
 </span> <?php endif; ?>
			</p>
		</div>
		<div class="association-text">
		<h3><?php echo $this->_tpl_vars['LBL_BUYER2_BPRODUCT_BUYER']; ?>
 <?php echo $this->_tpl_vars['LBL_ASSOCIATION']; ?>
</h3>
			<p>
				<?php echo $this->_tpl_vars['LBL_BUYER2']; ?>
:<span> <?php echo $this->_tpl_vars['b2byb_dtls'][0]['vBuyer2']; ?>
</span>
				<?php echo $this->_tpl_vars['LBL_DATE']; ?>
 :<span> <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['b2byb_dtls'][0]['dADate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)))) ? $this->_run_mod_handler('DateTime', true, $_tmp, 10) : DateTime($_tmp, 10)); ?>
</span><br/>
				<?php echo $this->_tpl_vars['LBL_BPRODUCT']; ?>
: <span><?php echo $this->_tpl_vars['b2byb_dtls'][0]['vBuyer']; ?>
</span><br />
				<?php echo $this->_tpl_vars['LBL_CODE']; ?>
: <span><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
b2bprodtbasocview/<?php echo $this->_tpl_vars['b2byb_dtls'][0]['iAssociationId']; ?>
" style="text-decoration:underline;"><?php echo $this->_tpl_vars['b2byb_dtls'][0]['vACode']; ?>
</a></span><br />
				<?php if ($this->_tpl_vars['b2byb_dtls'][0]['eStatus'] != 'Need to Verify' && $this->_tpl_vars['b2byb_dtls'][0]['eStatus'] != 'Modified' && $this->_tpl_vars['b2byb_dtls'][0]['eNeedToVerify'] != 'Yes'): ?>
					<?php if ($this->_tpl_vars['b2byb_dtls'][0]['vVerifiedBy'] != ''): ?>Verified By :<span> <?php echo $this->_tpl_vars['b2byb_dtls'][0]['vVerifiedBy']; ?>
</span><?php endif; ?>
				<?php else: ?> <?php echo $this->_tpl_vars['LBL_STATUS']; ?>
 :<span> <?php echo $this->_tpl_vars['b2byb_dtls'][0]['eStatus']; ?>
 </span> <?php endif; ?>
			</p>
		</div>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['uorg_type'] != 'Supplier'): ?>
		<div class="clear">&nbsp;</div>
		<div class="association-text">
			<h3><?php echo $this->_tpl_vars['LBL_BUYER2_SUPPLIER']; ?>
 <?php echo $this->_tpl_vars['LBL_ASSOCIATION']; ?>
</h3>
			<p>
				<?php echo $this->_tpl_vars['LBL_BUYER2']; ?>
:<span> <?php echo $this->_tpl_vars['b2sp_dtls'][0]['vBuyer2']; ?>
</span>
				<?php echo $this->_tpl_vars['LBL_DATE']; ?>
 :<span> <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['b2sp_dtls'][0]['dADate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)))) ? $this->_run_mod_handler('DateTime', true, $_tmp, 10) : DateTime($_tmp, 10)); ?>
</span><br/>
				<?php echo $this->_tpl_vars['LBL_BPRODUCT']; ?>
: <span><?php echo $this->_tpl_vars['b2sp_dtls'][0]['vSupplier']; ?>
</span><br />
				<?php echo $this->_tpl_vars['LBL_CODE']; ?>
: <span><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
b2supplierasocview/<?php echo $this->_tpl_vars['b2sp_dtls'][0]['iAssociationId']; ?>
" style="text-decoration:underline;"><?php echo $this->_tpl_vars['b2sp_dtls'][0]['vACode']; ?>
</a></span><br />
				<?php if ($this->_tpl_vars['b2sp_dtls'][0]['eStatus'] != 'Need to Verify' && $this->_tpl_vars['b2sp_dtls'][0]['eStatus'] != 'Modified' && $this->_tpl_vars['b2sp_dtls'][0]['eNeedToVerify'] != 'Yes'): ?>
					<?php if ($this->_tpl_vars['b2sp_dtls'][0]['vVerifiedBy'] != ''): ?>Verified By :<span> <?php echo $this->_tpl_vars['b2sp_dtls'][0]['vVerifiedBy']; ?>
</span><?php endif; ?>
				<?php else: ?> <?php echo $this->_tpl_vars['LBL_STATUS']; ?>
 :<span> <?php echo $this->_tpl_vars['b2sp_dtls'][0]['eStatus']; ?>
 </span> <?php endif; ?>
			</p>
		</div>
		<div class="association-text">
			<h3><?php echo $this->_tpl_vars['LBL_BUYER2_SPRODUCT_SUPPLIER']; ?>
 <?php echo $this->_tpl_vars['LBL_ASSOCIATION']; ?>
</h3>
			<p>
				<?php echo $this->_tpl_vars['LBL_BUYER2']; ?>
:<span> <?php echo $this->_tpl_vars['b2sps_dtls'][0]['vBuyer2']; ?>
</span>
				<?php echo $this->_tpl_vars['LBL_DATE']; ?>
 :<span> <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['b2sps_dtls'][0]['dADate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)))) ? $this->_run_mod_handler('DateTime', true, $_tmp, 10) : DateTime($_tmp, 10)); ?>
</span><br/>
				<?php echo $this->_tpl_vars['LBL_BPRODUCT']; ?>
: <span><?php echo $this->_tpl_vars['b2sps_dtls'][0]['vSupplier']; ?>
</span><br />
				<?php echo $this->_tpl_vars['LBL_CODE']; ?>
: <span><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
b2sprodtsasocview/<?php echo $this->_tpl_vars['b2sps_dtls'][0]['iAssociationId']; ?>
" style="text-decoration:underline;"><?php echo $this->_tpl_vars['b2sps_dtls'][0]['vACode']; ?>
</a></span><br />
				<?php if ($this->_tpl_vars['b2sps_dtls'][0]['eStatus'] != 'Need to Verify' && $this->_tpl_vars['b2sps_dtls'][0]['eStatus'] != 'Modified' && $this->_tpl_vars['b2sps_dtls'][0]['eNeedToVerify'] != 'Yes'): ?>
					<?php if ($this->_tpl_vars['b2sps_dtls'][0]['vVerifiedBy'] != ''): ?>Verified By :<span> <?php echo $this->_tpl_vars['b2sps_dtls'][0]['vVerifiedBy']; ?>
</span><?php endif; ?>
				<?php else: ?> <?php echo $this->_tpl_vars['LBL_STATUS']; ?>
 :<span> <?php echo $this->_tpl_vars['b2sps_dtls'][0]['eStatus']; ?>
 </span> <?php endif; ?>
			</p>
		</div>
	<?php endif; ?>
</div>

<?php if ($this->_tpl_vars['ENABLE_AUCTION'] == 'Yes'): ?>
 <div class="statistics-main-box" id="foo_8">
   <div class="statistics-box">
		
		<div style="height:3px;">&nbsp;</div>
		<h2><?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
&nbsp;<?php echo $this->_tpl_vars['LBL_COUNTS']; ?>
</h2>
		<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td width="170px">&nbsp;</td>
				<?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['cntsts']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<td height="25px" align="center" class="listing-name-blue-1"><?php echo $this->_tpl_vars['cntsts'][$this->_sections['l']['index']]; ?>
</td>
				<?php endfor; endif; ?>
			</tr>
			<tr>
				<td class="listing-name-grey-border-to-1" height="25"><?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
</td>
				<?php echo smarty_function_assign(array('var' => 'ln','value' => 0), $this);?>

				
				<?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['cntsts']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				    <?php if ($this->_tpl_vars['cntsts'][$this->_sections['l']['index']] == 'Not Started'): ?>
				       <?php echo smarty_function_assign(array('var' => 'rfq2ls','value' => 0), $this);?>

				    <?php endif; ?>
				    <?php if ($this->_tpl_vars['cntsts'][$this->_sections['l']['index']] == 'Live'): ?>
				       <?php echo smarty_function_assign(array('var' => 'rfq2ls','value' => 1), $this);?>

				    <?php endif; ?>
				    <?php if ($this->_tpl_vars['cntsts'][$this->_sections['l']['index']] == 'Completed'): ?>
				       <?php echo smarty_function_assign(array('var' => 'rfq2ls','value' => 2), $this);?>

				    <?php endif; ?>
				    <?php if ($this->_tpl_vars['cntsts'][$this->_sections['l']['index']] == 'Cancelled'): ?>
				       <?php echo smarty_function_assign(array('var' => 'rfq2ls','value' => 2), $this);?>

				    <?php endif; ?>
					<td height="25" align="center" class="<?php if ($this->_sections['l']['index']+1 == count($this->_tpl_vars['cntsts'])): ?>listing-name-grey-total-1<?php else: ?>listing-name-grey-border-nomber-1<?php endif; ?>">
						<?php if (((is_array($_tmp=$this->_tpl_vars['cntsts'][$this->_sections['l']['index']])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['r2sts']) : in_array($_tmp, $this->_tpl_vars['r2sts']))):  if ($this->_tpl_vars['cntsts'][$this->_sections['l']['index']] != 'Awarded'): ?><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
rfq2list/<?php echo $this->_tpl_vars['rfq2ls']; ?>
/rfq2count"><?php echo $this->_tpl_vars['rfq2stats'][$this->_tpl_vars['ln']]['cnt']; ?>
</a><?php else:  echo $this->_tpl_vars['rfq2stats'][$this->_tpl_vars['ln']]['cnt'];  endif;  echo smarty_function_assign(array('var' => 'ln','value' => ($this->_tpl_vars['ln']+1)), $this); else: ?> 0 <?php endif; ?>
					</td>
				<?php endfor; endif; ?>
			</tr>
			<tr><td colspan="11" class="listing-name-grey-border-to-1" style="height:1px;"></td></tr>
		</table>
      </div>
 
	<div class="login-box">
      <h2><img class="plusminus-img" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/minus-icon.gif" style="cursor:pointer;"/> <?php echo $this->_tpl_vars['LBL_RFQ2']; ?>
</h2>
        <div class="organization-text">
         <?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['latestrfq2']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['l']['max'] = (int)1;
$this->_sections['l']['show'] = true;
if ($this->_sections['l']['max'] < 0)
    $this->_sections['l']['max'] = $this->_sections['l']['loop'];
$this->_sections['l']['step'] = 1;
$this->_sections['l']['start'] = $this->_sections['l']['step'] > 0 ? 0 : $this->_sections['l']['loop']-1;
if ($this->_sections['l']['show']) {
    $this->_sections['l']['total'] = min(ceil(($this->_sections['l']['step'] > 0 ? $this->_sections['l']['loop'] - $this->_sections['l']['start'] : $this->_sections['l']['start']+1)/abs($this->_sections['l']['step'])), $this->_sections['l']['max']);
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
         <span style="display:inline-block; width:230px;"><b style="font-size:12.9px;"><?php echo $this->_tpl_vars['LBL_RFQ2_CODE']; ?>
:</b> <a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
rfq2view/<?php echo $this->_tpl_vars['latestrfq2'][$this->_sections['l']['index']]['iRFQ2Id']; ?>
"><b style="font-size:12.9px;"><?php echo $this->_tpl_vars['latestrfq2'][$this->_sections['l']['index']]['vRFQ2Code']; ?>
</b></a></span>
			<p>
            <label style="display:inline-block; width:170px;"><?php echo $this->_tpl_vars['LBL_INVOICE_CODE']; ?>
: <?php echo $this->_tpl_vars['latestrfq2'][$this->_sections['l']['index']]['vInvoiceCode']; ?>
 </label> &nbsp; <label><?php echo $this->_tpl_vars['LBL_TYPE']; ?>
: <?php echo $this->_tpl_vars['latestrfq2'][$this->_sections['l']['index']]['eAuctionType']; ?>
</label> <br/>
            <label style="display:inline-block; width:170px;"><?php echo $this->_tpl_vars['LBL_START_DATE']; ?>
: <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['latestrfq2'][$this->_sections['l']['index']]['dStartDate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)))) ? $this->_run_mod_handler('DateTime', true, $_tmp, 10) : DateTime($_tmp, 10)); ?>
 </label> &nbsp; <label><?php echo $this->_tpl_vars['LBL_END_DATE']; ?>
:</label><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['latestrfq2'][$this->_sections['l']['index']]['dEndDate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)))) ? $this->_run_mod_handler('DateTime', true, $_tmp, 10) : DateTime($_tmp, 10)); ?>
<br/>
            <label><?php echo $this->_tpl_vars['LBL_STATUS']; ?>
:</label> <?php echo $this->_tpl_vars['latestrfq2'][$this->_sections['l']['index']]['eAuctionStatus']; ?>

         </p>
			<?php endfor; else: ?>
			<p>
				<?php echo $this->_tpl_vars['LBL_NO_REC_AVAILABLE']; ?>

			</p>
			<?php endif; ?>
			<em style="padding-left:230px">
			<a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
rfq2list"><?php echo $this->_tpl_vars['LBL_VIEW_MORE']; ?>
</a>
			</em>
      </div>
   </div>
   </div>
 <?php endif; ?>

<div class="association-main-box column" id="foo_7">
   <h2><img class="plusminus-img" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/minus-icon.gif" /> <?php echo $this->_tpl_vars['LBL_BUYER']; ?>
2 <?php echo $this->_tpl_vars['LBL_ASSOCIATION']; ?>
 <?php echo $this->_tpl_vars['LBL_STATISTICS']; ?>
</h2>
	<div class="statistics-text">
   	<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="200" height="24">&nbsp;</td>
          <td width="75" align="center" class="listing-name-blue"><?php echo $this->_tpl_vars['LBL_ACTIVE']; ?>
</td>
          <td width="75" align="center" class="listing-name-blue"><?php echo $this->_tpl_vars['LBL_INACTIVE']; ?>
</td>
          <td width="75" align="center" class="listing-name-blue"><?php echo $this->_tpl_vars['LBL_NOT_VERIFIED']; ?>
</td>
          <td width="60" align="center" class="listing-name-blue"><?php echo $this->_tpl_vars['LBL_TOTAL']; ?>
</td>
        </tr>
		  <?php if ($this->_tpl_vars['uorg_type'] != 'Supplier'): ?>
        <tr>
          <td height="29" class="listing-name-grey-border-to"><?php echo $this->_tpl_vars['LBL_BUYER2_BUYER']; ?>
 <?php echo $this->_tpl_vars['LBL_ASSOCIATION']; ?>
</td>
          <td height="29" align="center" class="listing-name-grey-border-nomber"><?php if ($this->_tpl_vars['b2asocstats'][1]['actrec'] > 0): ?><a onclick="showlist('b2buyerasoclist','act');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['b2asocstats'][1]['actrec']; ?>
&nbsp;<?php if ($this->_tpl_vars['b2asocstats'][1]['actrec'] > 0): ?></a><?php endif; ?></td>
          <td height="29" align="center" class="listing-name-grey-border-nomber"><?php if ($this->_tpl_vars['b2asocstats'][1]['inactrec'] > 0): ?><a onclick="showlist('b2buyerasoclist','inact');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['b2asocstats'][1]['inactrec']; ?>
&nbsp;<?php if ($this->_tpl_vars['b2asocstats'][1]['inactrec'] > 0): ?></a><?php endif; ?></td>
          <td height="29" align="center" class="listing-name-grey-border-nomber"><?php if ($this->_tpl_vars['b2asocstats'][1]['verifyrec'] > 0): ?><a onclick="showlist('b2buyerasocvlist','nvfy');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['b2asocstats'][1]['verifyrec']; ?>
&nbsp;<?php if ($this->_tpl_vars['b2asocstats'][1]['verifyrec'] > 0): ?></a><?php endif; ?></td>
          <td height="29" align="center" class="listing-name-grey-total"><?php echo $this->_tpl_vars['b2asocstats'][1]['tot']; ?>
</td>
        </tr>
        <tr>
          <td height="29" class="listing-name-grey-border-to"><?php echo $this->_tpl_vars['LBL_BUYER2_BPRODUCT_BUYER']; ?>
 <?php echo $this->_tpl_vars['LBL_ASSOCIATION']; ?>
</td>
          <td height="29" align="center" class="listing-name-grey-border-nomber"><?php if ($this->_tpl_vars['b2asocstats'][2]['actrec'] > 0): ?><a onclick="showlist('b2bprdtbasoclist','act');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['b2asocstats'][2]['actrec']; ?>
&nbsp;<?php if ($this->_tpl_vars['b2asocstats'][2]['actrec'] > 0): ?></a><?php endif; ?></td>
          <td height="29" align="center" class="listing-name-grey-border-nomber"><?php if ($this->_tpl_vars['b2asocstats'][2]['inactrec'] > 0): ?><a onclick="showlist('b2bprdtbasoclist','inact');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['b2asocstats'][2]['inactrec']; ?>
&nbsp;<?php if ($this->_tpl_vars['b2asocstats'][2]['inactrec'] > 0): ?></a><?php endif; ?></td>
          <td height="29" align="center" class="listing-name-grey-border-nomber"><?php if ($this->_tpl_vars['b2asocstats'][2]['verifyrec'] > 0): ?><a onclick="showlist('b2bprdtbasocvlist','nvfy');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['b2asocstats'][2]['verifyrec']; ?>
&nbsp;<?php if ($this->_tpl_vars['b2asocstats'][2]['verifyrec'] > 0): ?></a><?php endif; ?></td>
          <td height="29" align="center" class="listing-name-grey-total"><?php echo $this->_tpl_vars['b2asocstats'][2]['tot']; ?>
</td>
        </tr>
		  <?php endif; ?>
		  <?php if ($this->_tpl_vars['uorg_type'] != 'Buyer'): ?>
        <tr>
           <td height="29" class="listing-name-grey-border-to"><?php echo $this->_tpl_vars['LBL_BUYER2_SUPPLIER']; ?>
 <?php echo $this->_tpl_vars['LBL_ASSOCIATION']; ?>
</td>
           <td height="29" align="center" class="listing-name-grey-border-nomber"><?php if ($this->_tpl_vars['b2asocstats'][4]['actrec'] > 0): ?><a onclick="showlist('b2supplierasoclist','act');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['b2asocstats'][4]['actrec']; ?>
&nbsp;<?php if ($this->_tpl_vars['b2asocstats'][4]['actrec'] > 0): ?></a><?php endif; ?></td>
           <td height="29" align="center" class="listing-name-grey-border-nomber"><?php if ($this->_tpl_vars['b2asocstats'][4]['inactrec'] > 0): ?><a onclick="showlist('b2supplierasoclist','inact');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['b2asocstats'][4]['inactrec']; ?>
&nbsp;<?php if ($this->_tpl_vars['b2asocstats'][4]['inactrec'] > 0): ?></a><?php endif; ?></td>
           <td height="29" align="center" class="listing-name-grey-border-nomber"><?php if ($this->_tpl_vars['b2asocstats'][4]['verifyrec'] > 0): ?><a onclick="showlist('b2supplierasocvlist','nvfy');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['b2asocstats'][4]['verifyrec']; ?>
&nbsp;<?php if ($this->_tpl_vars['b2asocstats'][4]['verifyrec'] > 0): ?></a><?php endif; ?></td>
           <td height="29" align="center" class="listing-name-grey-total"><?php echo $this->_tpl_vars['b2asocstats'][4]['tot']; ?>
</td>
        </tr>
        <tr>
           <td height="29" class="listing-name-grey-border-to"><?php echo $this->_tpl_vars['LBL_BUYER2_SPRODUCT_SUPPLIER']; ?>
 <?php echo $this->_tpl_vars['LBL_ASSOCIATION']; ?>
</td>
           <td height="29" align="center" class="listing-name-grey-border-nomber"><?php if ($this->_tpl_vars['b2asocstats'][5]['actrec'] > 0): ?><a onclick="showlist('b2sprdtsasoclist','act');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['b2asocstats'][5]['actrec']; ?>
&nbsp;<?php if ($this->_tpl_vars['b2asocstats'][5]['actrec'] > 0): ?></a><?php endif; ?></td>
           <td height="29" align="center" class="listing-name-grey-border-nomber"><?php if ($this->_tpl_vars['b2asocstats'][5]['inactrec'] > 0): ?><a onclick="showlist('b2sprdtsasoclist','inact');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['b2asocstats'][5]['inactrec']; ?>
&nbsp;<?php if ($this->_tpl_vars['b2asocstats'][5]['inactrec'] > 0): ?></a><?php endif; ?></td>
           <td height="29" align="center" class="listing-name-grey-border-nomber"><?php if ($this->_tpl_vars['b2asocstats'][5]['verifyrec'] > 0): ?><a onclick="showlist('b2sprdtsasocvlist','nvfy');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['b2asocstats'][5]['verifyrec']; ?>
&nbsp;<?php if ($this->_tpl_vars['b2asocstats'][5]['verifyrec'] > 0): ?></a><?php endif; ?></td>
           <td height="29" align="center" class="listing-name-grey-total"><?php echo $this->_tpl_vars['b2asocstats'][5]['tot']; ?>
</td>
        </tr>
		  <?php endif; ?>
        <tr><td colspan="5" class="listing-name-grey-border-to-1" style="height:1px;"></td></tr>
      </table>
   </div>
   <div class="clear">&nbsp;</div>
</div>
<?php endif; ?>

<div class="organization-main-box column" id="foo_2">
   <div class="organization-box">
	<h2><img class="plusminus-img" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/minus-icon.gif" /> <?php echo $this->_tpl_vars['LBL_PURCHASE_ORDER']; ?>
</h2>
      <div class="organization-text">
			<?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['latestpo']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
         <h3><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
purchaseorderview/<?php echo $this->_tpl_vars['latestpo'][$this->_sections['l']['index']]['iPurchaseOrderID']; ?>
"><?php echo $this->_tpl_vars['latestpo'][$this->_sections['l']['index']]['vPoBuyerCode']; ?>
</a></h3>
         <p>
            <?php echo $this->_tpl_vars['latestpo'][$this->_sections['l']['index']]['supplierorg']; ?>
, &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				<?php echo $this->_tpl_vars['LBL_CREATED_DATE']; ?>
 : <span><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['latestpo'][$this->_sections['l']['index']]['addDate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)))) ? $this->_run_mod_handler('DateTime', true, $_tmp, '0') : DateTime($_tmp, '0')); ?>
</span> <br />
            <?php echo $this->_tpl_vars['latestpo'][$this->_sections['l']['index']]['vCity']; ?>
, <?php echo $this->_tpl_vars['latestpo'][$this->_sections['l']['index']]['vState']; ?>
, <?php echo $this->_tpl_vars['latestpo'][$this->_sections['l']['index']]['vCountry']; ?>
 &nbsp; <br />
                        <?php echo $this->_tpl_vars['LBL_STATUS']; ?>
 : <span>Active</span>
         </p>
			<?php endfor; else: ?>
			<p>
				<?php echo $this->_tpl_vars['LBL_NO_REC_AVAILABLE']; ?>

			</p>
			<?php endif; ?>
      </div>
   </div>
   <div class="organization-to-verify-box"><h2><img class="plusminus-img" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/minus-icon.gif" /> <?php echo $this->_tpl_vars['LBL_INVOICE_ORDER']; ?>
</h2>
      <div class="organization-to-verify-text">
         <?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['latestio']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
         <h3><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
invoiceview/<?php echo $this->_tpl_vars['latestio'][$this->_sections['l']['index']]['iInvoiceID']; ?>
"><?php echo $this->_tpl_vars['latestio'][$this->_sections['l']['index']]['vInvSupplierCode']; ?>
</a></h3>
         <p>
            <?php echo $this->_tpl_vars['latestio'][$this->_sections['l']['index']]['buyerorg']; ?>
, &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				<?php echo $this->_tpl_vars['LBL_CREATED_DATE']; ?>
 : <span><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['latestio'][$this->_sections['l']['index']]['addDate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)))) ? $this->_run_mod_handler('DateTime', true, $_tmp, '0') : DateTime($_tmp, '0')); ?>
</span> <br />
            <?php echo $this->_tpl_vars['latestio'][$this->_sections['l']['index']]['vCity']; ?>
, <?php echo $this->_tpl_vars['latestio'][$this->_sections['l']['index']]['vState']; ?>
, <?php echo $this->_tpl_vars['latestio'][$this->_sections['l']['index']]['vCountry']; ?>
 &nbsp; <br />
                        <?php echo $this->_tpl_vars['LBL_STATUS']; ?>
 : <span>Active</span>
         </p>
			<?php endfor; else: ?>
			<p>
				<?php echo $this->_tpl_vars['LBL_NO_REC_AVAILABLE']; ?>

			</p>
			<?php endif; ?>
               </div>
   </div>
</div>

<div class="organization-main-box" id="foo_3">
      <div class="organization-box">
         <h2><img class="plusminus-img" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/minus-icon.gif" /> <?php echo $this->_tpl_vars['LBL_BUYER_USER']; ?>
</h2>
         <?php if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['orgbyusrvrfy']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<div class="organization-text">
            <h3><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
organizationuserview/<?php echo $this->_tpl_vars['orgbyusrvrfy'][$this->_sections['i']['index']]['iUserID']; ?>
"><?php echo $this->_tpl_vars['orgbyusrvrfy'][$this->_sections['i']['index']]['vFirstName']; ?>
 <?php echo $this->_tpl_vars['orgbyusrvrfy'][$this->_sections['i']['index']]['vLastName']; ?>
</a></h3>
            <?php echo $this->_tpl_vars['orgbyusrvrfy'][$this->_sections['i']['index']]['vCity']; ?>
, <?php echo $this->_tpl_vars['orgbyusrvrfy'][$this->_sections['i']['index']]['vZipCode']; ?>
<br />
            <?php echo $this->_tpl_vars['orgbyusrvrfy'][$this->_sections['i']['index']]['vUserName']; ?>
 <a href="mailto:<?php echo $this->_tpl_vars['orgbyusrvrfy'][$this->_sections['i']['index']]['vEmail']; ?>
"> <span>( <?php echo $this->_tpl_vars['orgbyusrvrfy'][$this->_sections['i']['index']]['eUserType']; ?>
 ) </span></a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;
            <?php echo $this->_tpl_vars['LBL_CREATED_DATE']; ?>
 : <span><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['orgbyusrvrfy'][$this->_sections['i']['index']]['dCreatedDate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)))) ? $this->_run_mod_handler('DateTime', true, $_tmp, '0') : DateTime($_tmp, '0')); ?>
</span><br />
            <?php echo $this->_tpl_vars['LBL_STATUS']; ?>
 : <span>Active</span>
			</div>
			<?php endfor; else: ?>
			<div class="organization-text">
				<p>
				<?php echo $this->_tpl_vars['LBL_NO_REC_AVAILABLE']; ?>

				</p>
			</div>
			<?php endif; ?>
      </div>
      <div class="organization-to-verify-box">
         <h2><img class="plusminus-img" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/minus-icon.gif" /><?php echo $this->_tpl_vars['LBL_SUPPLIER']; ?>
</h2>
         <?php if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['orgslusrvrfy']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<div class="organization-to-verify-text">
            <h3><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
organizationuserview/<?php echo $this->_tpl_vars['orgslusrvrfy'][$this->_sections['i']['index']]['iUserID']; ?>
"><?php echo $this->_tpl_vars['orgslusrvrfy'][$this->_sections['i']['index']]['vFirstName']; ?>
 <?php echo $this->_tpl_vars['orgslusrvrfy'][$this->_sections['i']['index']]['vLastName']; ?>
</a></h3>
            <?php echo $this->_tpl_vars['orgslusrvrfy'][$this->_sections['i']['index']]['vCity']; ?>
, <?php echo $this->_tpl_vars['orgslusrvrfy'][$this->_sections['i']['index']]['vZipCode']; ?>
<br />
            <?php echo $this->_tpl_vars['orgslusrvrfy'][$this->_sections['i']['index']]['vUserName']; ?>
 <a href="mailto:<?php echo $this->_tpl_vars['orgslusrvrfy'][$this->_sections['i']['index']]['vEmail']; ?>
"> <span>( <?php echo $this->_tpl_vars['orgslusrvrfy'][$this->_sections['i']['index']]['eUserType']; ?>
 ) </span></a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;
            <?php echo $this->_tpl_vars['LBL_CREATED_DATE']; ?>
 : <span><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['orgslusrvrfy'][$this->_sections['i']['index']]['dCreatedDate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)))) ? $this->_run_mod_handler('DateTime', true, $_tmp, '0') : DateTime($_tmp, '0')); ?>
</span><br />
            <?php echo $this->_tpl_vars['LBL_STATUS']; ?>
 : <span>Active</span>
         </div>
			<?php endfor; else: ?>
			<div class="organization-to-verify-text">
				<p>
				<?php echo $this->_tpl_vars['LBL_NO_REC_AVAILABLE']; ?>

				</p>
			</div>
			<?php endif; ?>
      </div>
</div>

<div class="organization-main-box column" id="foo_4">
      <h2><img class="plusminus-img" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/minus-icon.gif" /> <?php echo $this->_tpl_vars['LBL_ASSOCIATION']; ?>
</h2>
      <?php if (isset($this->_sections['j'])) unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['activeassocs']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['j']['show'] = true;
$this->_sections['j']['max'] = $this->_sections['j']['loop'];
$this->_sections['j']['step'] = 1;
$this->_sections['j']['start'] = $this->_sections['j']['step'] > 0 ? 0 : $this->_sections['j']['loop']-1;
if ($this->_sections['j']['show']) {
    $this->_sections['j']['total'] = $this->_sections['j']['loop'];
    if ($this->_sections['j']['total'] == 0)
        $this->_sections['j']['show'] = false;
} else
    $this->_sections['j']['total'] = 0;
if ($this->_sections['j']['show']):

            for ($this->_sections['j']['index'] = $this->_sections['j']['start'], $this->_sections['j']['iteration'] = 1;
                 $this->_sections['j']['iteration'] <= $this->_sections['j']['total'];
                 $this->_sections['j']['index'] += $this->_sections['j']['step'], $this->_sections['j']['iteration']++):
$this->_sections['j']['rownum'] = $this->_sections['j']['iteration'];
$this->_sections['j']['index_prev'] = $this->_sections['j']['index'] - $this->_sections['j']['step'];
$this->_sections['j']['index_next'] = $this->_sections['j']['index'] + $this->_sections['j']['step'];
$this->_sections['j']['first']      = ($this->_sections['j']['iteration'] == 1);
$this->_sections['j']['last']       = ($this->_sections['j']['iteration'] == $this->_sections['j']['total']);
?>
   <div class="association-text">
		      <h3><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
associationview/<?php echo $this->_tpl_vars['activeassocs'][$this->_sections['j']['index']]['iAsociationID']; ?>
"><?php echo $this->_tpl_vars['activeassocs'][$this->_sections['j']['index']]['vBuyerOrg']; ?>
</a></h3>
      <p>
			Buyer Organization Code:<span> <?php echo $this->_tpl_vars['activeassocs'][$this->_sections['j']['index']]['vBuyerCode']; ?>
</span>
			Date :<span> <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['activeassocs'][$this->_sections['j']['index']]['dCreatedDate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)))) ? $this->_run_mod_handler('DateTime', true, $_tmp, 10) : DateTime($_tmp, 10)); ?>
</span><br/>
			<?php if ($this->_tpl_vars['activeassocs'][$this->_sections['j']['index']]['eStatus'] != 'Need to Verify' && $this->_tpl_vars['activeassocs'][$this->_sections['j']['index']]['eStatus'] != 'Modified'): ?>
			<?php if ($this->_tpl_vars['activeassocs'][$this->_sections['j']['index']]['vVerifiedBy'] != ''): ?>Verified By :<span> <?php echo $this->_tpl_vars['activeassocs'][$this->_sections['j']['index']]['vVerifiedBy']; ?>
</span><?php endif; ?>
			<?php else: ?>
			Status :<span> <?php echo $this->_tpl_vars['activeassocs'][$this->_sections['j']['index']]['eStatus']; ?>
 </span>
			<?php endif; ?>
      </p>
   </div>
	<?php endfor; else: ?>
		<div class="association-text">
			<p>
		<?php echo $this->_tpl_vars['LBL_NO_REC_AVAILABLE']; ?>

			</p>
		</div>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['tot_activeassocs'] > 2): ?>
		<div class="clear" align="right"><em><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
verifyassociationlist" class="viewmorelink"><?php echo $this->_tpl_vars['LBL_VIEW_MORE']; ?>
</a></em>&nbsp;&nbsp;&nbsp;</div>
	<?php endif; ?>
</div>

<div class="inbox-main-box column" id="foo_5">
   <h2><img class="plusminus-img" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/minus-icon.gif" /> <?php echo $this->_tpl_vars['LBL_INBOX']; ?>
 (<?php echo $this->_tpl_vars['totInboxres']; ?>
)</h2>
   <div class="clear">
      <table width="98%" border="0" align="center" cellpadding="0" class="user-text" cellspacing="0">
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
               <?php echo $this->_tpl_vars['LBL_NO_RECENT_MESSAGES']; ?>

            </td>
         </tr>
         <?php endif; ?>
        </table>
      </div>
</div>
</div>
<form name="golist" id="golist" method="post" action="">
<input type="hidden" name="srchfor" id="srchfor" value="" />
<input type="hidden" name="srchval" id="srchval" value="" />
</form>
</div>
<?php echo '
<script>
var cookie = \'';  echo $this->_tpl_vars['tDashboard'];  echo '\';
</script>
'; ?>

<script type="text/javascript" src="<?php echo $this->_tpl_vars['SITE_JS_AJAX']; ?>
jOaDashboard.js"></script>