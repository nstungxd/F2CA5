<?php /* Smarty version 2.6.0, created on 2012-05-31 12:57:18
         compiled from member/organization/b2sprdthistory.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'DateTime', 'member/organization/b2sprdthistory.tpl', 10, false),)), $this); ?>
<div class="middle-container" >
   <h1 align="center" ><span><?php echo $this->_tpl_vars['LBL_ASSOCIATION']; ?>
 (<?php echo $this->_tpl_vars['b2sprdtls'][0]['vACode']; ?>
)</span></h1>
   <br/>
   <div class="middle-containt">
      <div><center>
         <table border="1" cellpadding="3" cellspacing="0" style="border:1px solid #cccccc;">
            <tr><td width="100px"><b><?php echo $this->_tpl_vars['LBL_ACTION']; ?>
</b></td><td width="190px"><b><?php echo $this->_tpl_vars['LBL_BY']; ?>
</b></td><td width="250px"><b><?php echo $this->_tpl_vars['LBL_DATE_TIME']; ?>
</b></td></tr>
           <?php if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['b2sprdthistory']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
               <?php if ($this->_tpl_vars['b2sprdthistory'][$this->_sections['i']['index']]['iASMID'] > 0 && ( $this->_tpl_vars['b2sprdthistory'][$this->_sections['i']['index']]['iModifiedByID'] == '' || $this->_tpl_vars['b2sprdthistory'][$this->_sections['i']['index']]['iModifiedByID'] == '0' ) || $this->_sections['i']['index'] == 0): ?>
                  <tr><td width="100px"><?php echo $this->_tpl_vars['LBL_CREATE']; ?>
</td><td width="190px"><?php echo $this->_tpl_vars['b2sprdthistory'][$this->_sections['i']['index']]['createdby']; ?>
</td><td width="250px"><?php echo ((is_array($_tmp=$this->_tpl_vars['b2sprdthistory'][$this->_sections['i']['index']]['dADate'])) ? $this->_run_mod_handler('DateTime', true, $_tmp, '7') : DateTime($_tmp, '7')); ?>
</td></tr>
                    <?php if ($this->_tpl_vars['b2sprdthistory'][$this->_sections['i']['index']]['iRejectedByID'] != '' && $this->_tpl_vars['b2sprdthistory'][$this->_sections['i']['index']]['iRejectedByID'] > 0): ?>
                    <tr><td width="100px"><?php echo $this->_tpl_vars['LBL_REJECTED']; ?>
</td><td width="190px"><?php echo $this->_tpl_vars['b2sprdthistory'][$this->_sections['i']['index']]['rejectedby']; ?>
</td><td width="250px"><?php echo ((is_array($_tmp=$this->_tpl_vars['b2sprdthistory'][$this->_sections['i']['index']]['dRejectedDate'])) ? $this->_run_mod_handler('DateTime', true, $_tmp, '7') : DateTime($_tmp, '7')); ?>
</td></tr>
						  <?php elseif ($this->_tpl_vars['b2sprdthistory'][$this->_sections['i']['index']]['iVerifiedByID'] != '' && $this->_tpl_vars['b2sprdthistory'][$this->_sections['i']['index']]['iVerifiedByID'] > 0): ?>
                    <tr><td width="100px"><?php echo $this->_tpl_vars['LBL_VERIFIED']; ?>
</td><td width="190px"><?php echo $this->_tpl_vars['b2sprdthistory'][$this->_sections['i']['index']]['verifiedby']; ?>
</td><td width="250px"><?php echo ((is_array($_tmp=$this->_tpl_vars['b2sprdthistory'][$this->_sections['i']['index']]['dVerifiedDate'])) ? $this->_run_mod_handler('DateTime', true, $_tmp, '7') : DateTime($_tmp, '7')); ?>
</td></tr>
                    <?php endif; ?>
               <?php elseif ($this->_tpl_vars['b2sprdthistory'][$this->_sections['i']['index']]['iModifiedByID'] != '' && $this->_tpl_vars['b2sprdthistory'][$this->_sections['i']['index']]['iModifiedByID'] > 0): ?>
                  <tr><td width="100px"><?php echo $this->_tpl_vars['LBL_MODIFIED']; ?>
</td><td width="190px"><?php echo $this->_tpl_vars['b2sprdthistory'][$this->_sections['i']['index']]['modifiedby']; ?>
</td><td width="250px"><?php echo ((is_array($_tmp=$this->_tpl_vars['b2sprdthistory'][$this->_sections['i']['index']]['dModifiedDate'])) ? $this->_run_mod_handler('DateTime', true, $_tmp, '7') : DateTime($_tmp, '7')); ?>
</td></tr>
                    <?php if ($this->_tpl_vars['b2sprdthistory'][$this->_sections['i']['index']]['iRejectedByID'] != '' && $this->_tpl_vars['b2sprdthistory'][$this->_sections['i']['index']]['iRejectedByID'] > 0): ?>
                    <tr><td width="100px"><?php echo $this->_tpl_vars['LBL_REJECTED']; ?>
</td><td width="190px"><?php echo $this->_tpl_vars['b2sprdthistory'][$this->_sections['i']['index']]['rejectedby']; ?>
</td><td width="250px"><?php echo ((is_array($_tmp=$this->_tpl_vars['b2sprdthistory'][$this->_sections['i']['index']]['dRejectedDate'])) ? $this->_run_mod_handler('DateTime', true, $_tmp, '7') : DateTime($_tmp, '7')); ?>
</td></tr>
						  <?php elseif ($this->_tpl_vars['b2sprdthistory'][$this->_sections['i']['index']]['iVerifiedByID'] != '' && $this->_tpl_vars['b2sprdthistory'][$this->_sections['i']['index']]['iVerifiedByID'] > 0 && ( $this->_tpl_vars['b2sprdthistory'][$this->_sections['i']['index']]['eStatus'] != 'Need to Verify' && $this->_tpl_vars['b2sprdthistory'][$this->_sections['i']['index']]['eStatus'] != 'Modified' && $this->_tpl_vars['b2sprdthistory'][$this->_sections['i']['index']]['eStatus'] != 'Delete' && $this->_tpl_vars['b2sprdthistory'][$this->_sections['i']['index']]['eNeedToVerify'] != 'Yes' )): ?>
                    <tr><td width="100px"><?php echo $this->_tpl_vars['LBL_VERIFIED']; ?>
</td><td width="190px"><?php echo $this->_tpl_vars['b2sprdthistory'][$this->_sections['i']['index']]['verifiedby']; ?>
</td><td width="250px"><?php echo ((is_array($_tmp=$this->_tpl_vars['b2sprdthistory'][$this->_sections['i']['index']]['dVerifiedDate'])) ? $this->_run_mod_handler('DateTime', true, $_tmp, '7') : DateTime($_tmp, '7')); ?>
</td></tr>
                    <?php endif; ?>
               <?php endif; ?>
            <?php endfor; else: ?>
               <tr><td align="center" colspan="3"><?php echo $this->_tpl_vars['LBL_NO_REC_AVAILABLE']; ?>
</td></tr>
           <?php endif; ?>
         </table>
      </center>
      </div>
   </div>
</div>