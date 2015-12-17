<?php /* Smarty version 2.6.0, created on 2015-06-11 13:31:38
         compiled from member/securitymanager/smdashboard.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'calcLTzTime', 'member/securitymanager/smdashboard.tpl', 67, false),array('modifier', 'DateTime', 'member/securitymanager/smdashboard.tpl', 67, false),array('modifier', 'count', 'member/securitymanager/smdashboard.tpl', 299, false),array('modifier', 'cat', 'member/securitymanager/smdashboard.tpl', 300, false),array('modifier', 'getInboxDate', 'member/securitymanager/smdashboard.tpl', 307, false),array('function', 'assign', 'member/securitymanager/smdashboard.tpl', 126, false),)), $this); ?>
<div class="middle-container">
<h1><?php echo $this->_tpl_vars['LBL_DASHBOARD']; ?>
 </h1>
<div>
<div class="middle-containt sortable" id="one">
<div class="statistics-main-box" id="foo_1">
   <div class="statistics-box"><h2><img class="plusminus-img" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/minus-icon.gif" /> <?php echo $this->_tpl_vars['LBL_STATISTICS']; ?>
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
     <tr>
       <td height="29" class="listing-name-grey-border-to"><?php echo $this->_tpl_vars['LBL_ORGANIZATIONS']; ?>
</td>
       <td height="29" align="center" class="listing-name-grey-border-nomber"><?php if ($this->_tpl_vars['orgstats'][0]['act_org'] > 0): ?><a onclick="showlist('org','act');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['orgstats'][0]['act_org']; ?>
&nbsp;<?php if ($this->_tpl_vars['orgstats'][0]['act_org'] > 0): ?></a><?php endif; ?></td>
       <td height="29" align="center" class="listing-name-grey-border-nomber"><?php if ($this->_tpl_vars['orgstats'][0]['inact_org'] > 0): ?><a onclick="showlist('org','inact');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['orgstats'][0]['inact_org']; ?>
&nbsp;<?php if ($this->_tpl_vars['orgstats'][0]['inact_org'] > 0): ?></a><?php endif; ?></td>
       <td height="29" align="center" class="listing-name-grey-border-nomber"><?php if ($this->_tpl_vars['orgstats'][0]['verify_org'] > 0): ?><a onclick="showlist('org','nvfy');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['orgstats'][0]['verify_org']; ?>
&nbsp;<?php if ($this->_tpl_vars['orgstats'][0]['verify_org'] > 0): ?></a><?php endif; ?></td>
       <td height="29" align="center" class="listing-name-grey-total"><?php echo $this->_tpl_vars['orgstats'][0]['tot']; ?>
</td>
     </tr>
     <tr>
       <td height="29" class="listing-name-grey-border-to"><?php echo $this->_tpl_vars['LBL_ASSOCIATIONS']; ?>
</td>
       <td height="29" align="center" class="listing-name-grey-border-nomber"><?php if ($this->_tpl_vars['assostats'][0]['act_org'] > 0): ?><a onclick="showlist('asoc','act');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['assostats'][0]['act_org']; ?>
&nbsp;<?php if ($this->_tpl_vars['assostats'][0]['act_org'] > 0): ?></a><?php endif; ?></td>
       <td height="29" align="center" class="listing-name-grey-border-nomber"><?php if ($this->_tpl_vars['assostats'][0]['inact_org'] > 0): ?><a onclick="showlist('asoc','inact');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['assostats'][0]['inact_org']; ?>
&nbsp;<?php if ($this->_tpl_vars['assostats'][0]['inact_org'] > 0): ?></a><?php endif; ?></td>
       <td height="29" align="center" class="listing-name-grey-border-nomber"><?php if ($this->_tpl_vars['assostats'][0]['verify_org'] > 0): ?><a onclick="showlist('asoc','nvfy');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['assostats'][0]['verify_org']; ?>
&nbsp;<?php if ($this->_tpl_vars['assostats'][0]['verify_org'] > 0): ?><a onclick="showlist('asoc','nvfy');" style="cursor:pointer;"><?php endif; ?></td>
       <td height="29" align="center" class="listing-name-grey-total"><?php echo $this->_tpl_vars['assostats'][0]['tot']; ?>
</td>
     </tr>
     <tr>
       <td height="29" class="listing-name-grey-border-to"><?php echo $this->_tpl_vars['LBL_ORGANIZATION_ADMINS']; ?>
</td>
       <td height="29" align="center" class="listing-name-grey-border-nomber"><?php if ($this->_tpl_vars['orgadminstats'][0]['act_usr'] > 0): ?><a onclick="showlist('adm','act');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['orgadminstats'][0]['act_usr']; ?>
&nbsp;<?php if ($this->_tpl_vars['orgadminstats'][0]['act_usr'] > 0): ?>&nbsp;</a><?php endif; ?></td>
       <td height="29" align="center" class="listing-name-grey-border-nomber"><?php if ($this->_tpl_vars['orgadminstats'][0]['inact_usr'] > 0): ?><a onclick="showlist('adm','inact');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['orgadminstats'][0]['inact_usr']; ?>
&nbsp;<?php if ($this->_tpl_vars['orgadminstats'][0]['inact_usr'] > 0): ?>&nbsp;</a><?php endif; ?></td>
       <td height="29" align="center" class="listing-name-grey-border-nomber"><?php if ($this->_tpl_vars['orgadminstats'][0]['verify_usr'] > 0): ?><a onclick="showlist('adm','nvfy');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['orgadminstats'][0]['verify_usr']; ?>
&nbsp;<?php if ($this->_tpl_vars['orgadminstats'][0]['verify_usr'] > 0): ?><a onclick="showlist('adm','act');" style="cursor:pointer;"><?php endif; ?></td>
       <td height="29" align="center" class="listing-name-grey-total"><?php echo $this->_tpl_vars['orgadminstats'][0]['tot']; ?>
</td>
     </tr>
     <tr>
       <td height="29" class="listing-name-grey-border-to"><?php echo $this->_tpl_vars['LBL_USERS']; ?>
</td>
       <td height="29" align="center" class="listing-name-grey-border-nomber"><?php if ($this->_tpl_vars['orguserstats'][0]['act_usr'] > 0): ?><a onclick="showlist('usr','act');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['orguserstats'][0]['act_usr']; ?>
&nbsp;<?php if ($this->_tpl_vars['orguserstats'][0]['act_usr'] > 0): ?></a><?php endif; ?></td>
       <td height="29" align="center" class="listing-name-grey-border-nomber"><?php if ($this->_tpl_vars['orguserstats'][0]['inact_usr'] > 0): ?><a onclick="showlist('usr','inact');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['orguserstats'][0]['inact_usr']; ?>
&nbsp;<?php if ($this->_tpl_vars['orguserstats'][0]['inact_usr'] > 0): ?></a><?php endif; ?></td>
       <td height="29" align="center" class="listing-name-grey-border-nomber"><?php if ($this->_tpl_vars['orguserstats'][0]['verify_usr'] > 0): ?><a onclick="showlist('usr','nvfy');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['orguserstats'][0]['verify_usr']; ?>
&nbsp;<?php if ($this->_tpl_vars['orguserstats'][0]['verify_usr'] > 0): ?></a><?php endif; ?></td>
       <td height="29" align="center"class="listing-name-grey-total" ><?php echo $this->_tpl_vars['orguserstats'][0]['tot']; ?>
</td>
     </tr>
     <tr>
        <td height="29" class="listing-name-grey-border-to"><?php echo $this->_tpl_vars['LBL_USER_RIGHTS']; ?>
</td>
        <td height="29" align="center" class="listing-name-grey-border-nomber-1"><?php if ($this->_tpl_vars['userrightsstats'][0]['actrec'] > 0): ?><a onclick="showlist('vur','act');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['userrightsstats'][0]['actrec']; ?>
&nbsp;<?php if ($this->_tpl_vars['userrightsstats'][0]['actrec'] > 0): ?></a><?php endif; ?></td>
        <td height="29" align="center" class="listing-name-grey-border-nomber-1"><?php if ($this->_tpl_vars['userrightsstats'][0]['inactrec'] > 0): ?><a onclick="showlist('vur','inact');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['userrightsstats'][0]['inactrec']; ?>
&nbsp;<?php if ($this->_tpl_vars['userrightsstats'][0]['inactrec'] > 0): ?></a><?php endif; ?></td>
        <td height="29" align="center" class="listing-name-grey-border-nomber-1"><?php if ($this->_tpl_vars['userrightsstats'][0]['verify_org'] > 0): ?><a onclick="showlist('vur','nvfy');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['userrightsstats'][0]['verify_org']; ?>
&nbsp;<?php if ($this->_tpl_vars['userrightsstats'][0]['verify_org'] > 0): ?></a><?php endif; ?></td>
        <td height="29" align="center" class="listing-name-grey-total-1"><?php echo $this->_tpl_vars['userrightsstats'][0]['tot']; ?>
</td>
     </tr>
     <tr>
        <td height="29" class="listing-name-grey-border-to"><?php echo $this->_tpl_vars['LBL_GROUPS']; ?>
</td>
        <td height="29" align="center" class="listing-name-grey-border-nomber-1"><?php if ($this->_tpl_vars['grpstats'][0]['act_org'] > 0): ?><a onclick="showlist('grp','act');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['grpstats'][0]['act_org']; ?>
&nbsp;<?php if ($this->_tpl_vars['grpstats'][0]['act_org'] > 0): ?></a><?php endif; ?></td>
        <td height="29" align="center" class="listing-name-grey-border-nomber-1"><?php if ($this->_tpl_vars['grpstats'][0]['inact_org'] > 0): ?><a onclick="showlist('grp','inact');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['grpstats'][0]['inact_org']; ?>
&nbsp;<?php if ($this->_tpl_vars['grpstats'][0]['inact_org'] > 0): ?></a><?php endif; ?></td>
        <td height="29" align="center" class="listing-name-grey-border-nomber-1"><?php if ($this->_tpl_vars['grpstats'][0]['verify_org'] > 0): ?><a onclick="showlist('grp','nvfy');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['grpstats'][0]['verify_org']; ?>
&nbsp;<?php if ($this->_tpl_vars['grpstats'][0]['verify_org'] > 0): ?></a><?php endif; ?></td>
        <td height="29" align="center" class="listing-name-grey-total-1"><?php echo $this->_tpl_vars['grpstats'][0]['tot']; ?>
</td>
     </tr>
     <tr><td colspan="5" class="listing-name-grey-border-to-1" style="height:1px;"></td></tr>
   </table>
	</div>
   </div>
   <div class="login-box">
      <h2><img class="plusminus-img" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/minus-icon.gif" /> <?php echo $this->_tpl_vars['LBL_LAST_3_LOGIN']; ?>
</h2>
      <div class="login-text"  style="height:192px;">
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
 <br />
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
<div class="organization-box"><h2><img class="plusminus-img" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/minus-icon.gif" /> <?php echo $this->_tpl_vars['LBL_ORGANIZATION']; ?>
</h2>
   <div class="organization-text">
	<?php if (isset($this->_sections['ln'])) unset($this->_sections['ln']);
$this->_sections['ln']['name'] = 'ln';
$this->_sections['ln']['loop'] = is_array($_loop=$this->_tpl_vars['activeorgs']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ln']['show'] = true;
$this->_sections['ln']['max'] = $this->_sections['ln']['loop'];
$this->_sections['ln']['step'] = 1;
$this->_sections['ln']['start'] = $this->_sections['ln']['step'] > 0 ? 0 : $this->_sections['ln']['loop']-1;
if ($this->_sections['ln']['show']) {
    $this->_sections['ln']['total'] = $this->_sections['ln']['loop'];
    if ($this->_sections['ln']['total'] == 0)
        $this->_sections['ln']['show'] = false;
} else
    $this->_sections['ln']['total'] = 0;
if ($this->_sections['ln']['show']):

            for ($this->_sections['ln']['index'] = $this->_sections['ln']['start'], $this->_sections['ln']['iteration'] = 1;
                 $this->_sections['ln']['iteration'] <= $this->_sections['ln']['total'];
                 $this->_sections['ln']['index'] += $this->_sections['ln']['step'], $this->_sections['ln']['iteration']++):
$this->_sections['ln']['rownum'] = $this->_sections['ln']['iteration'];
$this->_sections['ln']['index_prev'] = $this->_sections['ln']['index'] - $this->_sections['ln']['step'];
$this->_sections['ln']['index_next'] = $this->_sections['ln']['index'] + $this->_sections['ln']['step'];
$this->_sections['ln']['first']      = ($this->_sections['ln']['iteration'] == 1);
$this->_sections['ln']['last']       = ($this->_sections['ln']['iteration'] == $this->_sections['ln']['total']);
?>
	<h3><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
organizationview/<?php echo $this->_tpl_vars['activeorgs'][$this->_sections['ln']['index']]['iOrganizationID']; ?>
"><?php echo $this->_tpl_vars['activeorgs'][$this->_sections['ln']['index']]['vCompanyName']; ?>
</a></h3>
   <p>
      Registration No.<span> <?php echo $this->_tpl_vars['activeorgs'][$this->_sections['ln']['index']]['vCompanyRegNo']; ?>
</span>
      Country :<span> <?php echo $this->_tpl_vars['activeorgs'][$this->_sections['ln']['index']]['vCountryName']; ?>
</span><br />
      Verified By :<span> <?php echo $this->_tpl_vars['activeorgs'][$this->_sections['ln']['index']]['vVerifiedBy']; ?>
</span><br/>
		Email :<a href="mailto:<?php echo $this->_tpl_vars['activeorgs'][$this->_sections['ln']['index']]['vEmail']; ?>
"><span> <?php echo $this->_tpl_vars['activeorgs'][$this->_sections['ln']['index']]['vEmail']; ?>
</span></a>
   </p>
	<?php endfor; else: ?>
	<p>
	<?php echo $this->_tpl_vars['LBL_NO_REC_AVAILABLE']; ?>

	</p>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['tot_activeorgs'] > 3): ?>
	<em><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
organizationlist"><?php echo $this->_tpl_vars['LBL_VIEW_MORE']; ?>
</a></em>
	<?php endif; ?>
   </div>
</div>
<div class="organization-to-verify-box column">
   <h2><img class="plusminus-img" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/minus-icon.gif" /> <?php echo $this->_tpl_vars['LBL_ORG_VERIFY']; ?>
</h2>
   <div class="organization-to-verify-text">
	<?php if (isset($this->_sections['n'])) unset($this->_sections['n']);
$this->_sections['n']['name'] = 'n';
$this->_sections['n']['loop'] = is_array($_loop=$this->_tpl_vars['orgstoverify']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['n']['show'] = true;
$this->_sections['n']['max'] = $this->_sections['n']['loop'];
$this->_sections['n']['step'] = 1;
$this->_sections['n']['start'] = $this->_sections['n']['step'] > 0 ? 0 : $this->_sections['n']['loop']-1;
if ($this->_sections['n']['show']) {
    $this->_sections['n']['total'] = $this->_sections['n']['loop'];
    if ($this->_sections['n']['total'] == 0)
        $this->_sections['n']['show'] = false;
} else
    $this->_sections['n']['total'] = 0;
if ($this->_sections['n']['show']):

            for ($this->_sections['n']['index'] = $this->_sections['n']['start'], $this->_sections['n']['iteration'] = 1;
                 $this->_sections['n']['iteration'] <= $this->_sections['n']['total'];
                 $this->_sections['n']['index'] += $this->_sections['n']['step'], $this->_sections['n']['iteration']++):
$this->_sections['n']['rownum'] = $this->_sections['n']['iteration'];
$this->_sections['n']['index_prev'] = $this->_sections['n']['index'] - $this->_sections['n']['step'];
$this->_sections['n']['index_next'] = $this->_sections['n']['index'] + $this->_sections['n']['step'];
$this->_sections['n']['first']      = ($this->_sections['n']['iteration'] == 1);
$this->_sections['n']['last']       = ($this->_sections['n']['iteration'] == $this->_sections['n']['total']);
?>
              <h3><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
organizationview/<?php echo $this->_tpl_vars['orgstoverify'][$this->_sections['n']['index']]['iOrganizationID']; ?>
"><?php echo $this->_tpl_vars['orgstoverify'][$this->_sections['n']['index']]['vCompanyName']; ?>
</a></h3>
              <p>
                 Registration No.<span> <?php echo $this->_tpl_vars['orgstoverify'][$this->_sections['n']['index']]['vCompanyRegNo']; ?>
</span>
                                Date :<span> <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['orgstoverify'][$this->_sections['n']['index']]['dCreatedDate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)))) ? $this->_run_mod_handler('DateTime', true, $_tmp, 10) : DateTime($_tmp, 10)); ?>
</span><br/>
                 Country :<span> <?php echo $this->_tpl_vars['orgstoverify'][$this->_sections['n']['index']]['vCountryName']; ?>
</span><br />
                 Email : <a href="mailto:<?php echo $this->_tpl_vars['orgstoverify'][$this->_sections['n']['index']]['vEmail']; ?>
"> <span><?php echo $this->_tpl_vars['orgstoverify'][$this->_sections['n']['index']]['vEmail']; ?>
</span></a>
              </p>
        <?php endfor; else: ?>
            <p><?php echo $this->_tpl_vars['LBL_NO_REC_AVAILABLE']; ?>

            </p>
        <?php endif; ?>
        <?php if ($this->_tpl_vars['tot_orgstoverify'] > 3): ?>
            <em><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
verifyorganization"><?php echo $this->_tpl_vars['LBL_VIEW_MORE']; ?>
</a></em>
        <?php endif; ?>
   </div>
</div>
</div>
<div class="association-main-box column" id="foo_3">
   <h2><img class="plusminus-img" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/minus-icon.gif" /> <?php echo $this->_tpl_vars['LBL_ASSOCIATIONS']; ?>
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
		<?php if ($this->_tpl_vars['activeassocs'][$this->_sections['j']['index']]['eStatus'] == 'Need to Verify' || $this->_tpl_vars['activeassocs'][$this->_sections['j']['index']]['eStatus'] == 'Modified'): ?>
			<?php echo smarty_function_assign(array('var' => 'v','value' => "/verify"), $this);?>

		<?php endif; ?>
      <h3><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
associationview/<?php echo $this->_tpl_vars['activeassocs'][$this->_sections['j']['index']]['iAsociationID'];  echo $this->_tpl_vars['v']; ?>
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

<?php if ($this->_tpl_vars['ENABLE_AUCTION'] == 'Yes'): ?>
<div class="association-main-box column" id="foo_4">
   <h2><img class="plusminus-img" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/minus-icon.gif" /> <?php echo $this->_tpl_vars['LBL_BUYER']; ?>
2 <?php echo $this->_tpl_vars['LBL_ASSOCIATIONS']; ?>
 &nbsp; (<?php echo $this->_tpl_vars['LBL_AUCTION_TENDER']; ?>
)</h2>
   <div class="association-text">
		<h3><?php echo $this->_tpl_vars['LBL_BUYER2_BPRODUCT']; ?>
 <?php echo $this->_tpl_vars['LBL_ASSOCIATION']; ?>
</h3>
      <p>
			<?php echo $this->_tpl_vars['LBL_BUYER2']; ?>
:<span> <?php echo $this->_tpl_vars['b2bpr_dtls'][0]['vBuyer2']; ?>
</span>
			<?php echo $this->_tpl_vars['LBL_DATE']; ?>
 :<span> <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['b2bpr_dtls'][0]['dADate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)))) ? $this->_run_mod_handler('DateTime', true, $_tmp, 10) : DateTime($_tmp, 10)); ?>
</span><br/>
         <?php echo $this->_tpl_vars['LBL_BPRODUCT']; ?>
: <span><?php echo $this->_tpl_vars['b2bpr_dtls'][0]['vProduct']; ?>
</span><br />
         <?php echo $this->_tpl_vars['LBL_CODE']; ?>
: <span><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
b2bprodtasocview/<?php echo $this->_tpl_vars['b2bpr_dtls'][0]['iAssociationId']; ?>
" style="text-decoration:underline;"><?php echo $this->_tpl_vars['b2bpr_dtls'][0]['vACode']; ?>
</a></span><br />
			<?php if ($this->_tpl_vars['b2bpr_dtls'][0]['eStatus'] != 'Need to Verify' && $this->_tpl_vars['b2bpr_dtls'][0]['eStatus'] != 'Modified' && $this->_tpl_vars['b2bpr_dtls'][0]['eNeedToVerify'] != 'Yes'): ?>
			   <?php if ($this->_tpl_vars['b2bpr_dtls'][0]['vVerifiedBy'] != ''): ?>Verified By :<span> <?php echo $this->_tpl_vars['b2bpr_dtls'][0]['vVerifiedBy']; ?>
</span><?php endif; ?>
			<?php else: ?> <?php echo $this->_tpl_vars['LBL_STATUS']; ?>
 :<span> <?php echo $this->_tpl_vars['b2bpr_dtls'][0]['eStatus']; ?>
 </span> <?php endif; ?>
      </p>
   </div>
   <div class="association-text">
		<h3><?php echo $this->_tpl_vars['LBL_BUYER2_SPRODUCT']; ?>
 <?php echo $this->_tpl_vars['LBL_ASSOCIATION']; ?>
</h3>
      <p>
			<?php echo $this->_tpl_vars['LBL_BUYER2']; ?>
:<span> <?php echo $this->_tpl_vars['b2spr_dtls'][0]['vBuyer2']; ?>
</span>
			<?php echo $this->_tpl_vars['LBL_DATE']; ?>
 :<span> <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['b2spr_dtls'][0]['dADate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)))) ? $this->_run_mod_handler('DateTime', true, $_tmp, 10) : DateTime($_tmp, 10)); ?>
</span><br/>
         <?php echo $this->_tpl_vars['LBL_BPRODUCT']; ?>
: <span><?php echo $this->_tpl_vars['b2spr_dtls'][0]['vProduct']; ?>
</span><br />
         <?php echo $this->_tpl_vars['LBL_CODE']; ?>
: <span><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
b2bprodtasocview/<?php echo $this->_tpl_vars['b2spr_dtls'][0]['iAssociationId']; ?>
" style="text-decoration:underline;"><?php echo $this->_tpl_vars['b2spr_dtls'][0]['vACode']; ?>
</a></span><br />
			<?php if ($this->_tpl_vars['b2spr_dtls'][0]['eStatus'] != 'Need to Verify' && $this->_tpl_vars['b2spr_dtls'][0]['eStatus'] != 'Modified' && $this->_tpl_vars['b2spr_dtls'][0]['eNeedToVerify'] != 'Yes'): ?>
			   <?php if ($this->_tpl_vars['b2spr_dtls'][0]['vVerifiedBy'] != ''): ?>Verified By :<span> <?php echo $this->_tpl_vars['b2spr_dtls'][0]['vVerifiedBy']; ?>
</span><?php endif; ?>
			<?php else: ?> <?php echo $this->_tpl_vars['LBL_STATUS']; ?>
 :<span> <?php echo $this->_tpl_vars['b2spr_dtls'][0]['eStatus']; ?>
 </span> <?php endif; ?>
      </p>
   </div>
   <div class="clear">&nbsp;</div>
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
	<div class="clear">&nbsp;</div>
	<div class="association-text">
	<h3><?php echo $this->_tpl_vars['LBL_BUYER2_BUYER']; ?>
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
   <div class="association-text">
		<h3><?php echo $this->_tpl_vars['LBL_BUYER2_SUPPLIER']; ?>
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
</div>

<div class="association-main-box column" id="foo_5">
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
        <tr>
          <td height="29" class="listing-name-grey-border-to"><?php echo $this->_tpl_vars['LBL_BUYER2_BPRODUCT']; ?>
 <?php echo $this->_tpl_vars['LBL_ASSOCIATION']; ?>
</td>
          <td height="29" align="center" class="listing-name-grey-border-nomber"><?php if ($this->_tpl_vars['b2asocstats'][0]['actrec'] > 0): ?><a onclick="showlist('b2bprodtasoclist','act');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['b2asocstats'][0]['actrec']; ?>
&nbsp;<?php if ($this->_tpl_vars['b2asocstats'][0]['actrec'] > 0): ?></a><?php endif; ?></td>
          <td height="29" align="center" class="listing-name-grey-border-nomber"><?php if ($this->_tpl_vars['b2asocstats'][0]['inactrec'] > 0): ?><a onclick="showlist('b2bprodtasoclist','inact');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['b2asocstats'][0]['inactrec']; ?>
&nbsp;<?php if ($this->_tpl_vars['b2asocstats'][0]['inactrec'] > 0): ?></a><?php endif; ?></td>
          <td height="29" align="center" class="listing-name-grey-border-nomber"><?php if ($this->_tpl_vars['b2asocstats'][0]['verifyrec'] > 0): ?><a onclick="showlist('b2bprodtasocvlist','nvfy');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['b2asocstats'][0]['verifyrec']; ?>
&nbsp;<?php if ($this->_tpl_vars['b2asocstats'][0]['verifyrec'] > 0): ?></a><?php endif; ?></td>
          <td height="29" align="center" class="listing-name-grey-total"><?php echo $this->_tpl_vars['b2asocstats'][0]['tot']; ?>
</td>
        </tr>
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
        <tr>
          <td height="29" class="listing-name-grey-border-to"><?php echo $this->_tpl_vars['LBL_BUYER2_SPRODUCT']; ?>
 <?php echo $this->_tpl_vars['LBL_ASSOCIATION']; ?>
</td>
          <td height="29" align="center" class="listing-name-grey-border-nomber"><?php if ($this->_tpl_vars['b2asocstats'][3]['actrec'] > 0): ?><a onclick="showlist('b2sprodtasoclist','act');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['b2asocstats'][3]['actrec']; ?>
&nbsp;<?php if ($this->_tpl_vars['b2asocstats'][3]['actrec'] > 0): ?></a><?php endif; ?></td>
          <td height="29" align="center" class="listing-name-grey-border-nomber"><?php if ($this->_tpl_vars['b2asocstats'][3]['inactrec'] > 0): ?><a onclick="showlist('b2sprodtasoclist','inact');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['b2asocstats'][3]['inactrec']; ?>
&nbsp;<?php if ($this->_tpl_vars['b2asocstats'][3]['inactrec'] > 0): ?></a><?php endif; ?></td>
          <td height="29" align="center" class="listing-name-grey-border-nomber"><?php if ($this->_tpl_vars['b2asocstats'][3]['verifyrec'] > 0): ?><a onclick="showlist('b2sprodtasocvlist','nvfy');" style="cursor:pointer;"><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['b2asocstats'][3]['verifyrec']; ?>
&nbsp;<?php if ($this->_tpl_vars['b2asocstats'][3]['verifyrec'] > 0): ?></a><?php endif; ?></td>
          <td height="29" align="center" class="listing-name-grey-total"><?php echo $this->_tpl_vars['b2asocstats'][3]['tot']; ?>
</td>
        </tr>
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
        <tr><td colspan="5" class="listing-name-grey-border-to-1" style="height:1px;"></td></tr>
      </table>
   </div>
   <div class="clear">&nbsp;</div>
</div>
<?php endif; ?>

<div class="inbox-main-box column" id="foo_6">
   <h2><img class="plusminus-img" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/minus-icon.gif" /> <?php echo $this->_tpl_vars['LBL_INBOX']; ?>
 (<?php echo $this->_tpl_vars['totInboxres']; ?>
)</h2>
   <div class="clear">
      <table width="98%" border="0" align="center" cellpadding="0" class="user-text" cellspacing="0">
         <!--<tr>
            <td width="42" height="30" align="center">&nbsp;</td>
            <td width="598">&nbsp;</td>
            <td width="87" align="center"><a href="#"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-delete-1.gif" alt="" border="0" /></a></td>
         </tr>-->
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
</div>
<form name="golist" id="golist" method="post" action="">
<input type="hidden" name="srchfor" id="srchfor" value="" />
<input type="hidden" name="srchval" id="srchval" value="" />
</form>
</div>
<?php echo '
<script type="text/javascript">
var cookie = \'';  echo $this->_tpl_vars['tDashboard'];  echo '\';
</script>
'; ?>

<script type="text/javascript" src="<?php echo $this->_tpl_vars['SITE_JS_AJAX']; ?>
jdashboard.js"></script>