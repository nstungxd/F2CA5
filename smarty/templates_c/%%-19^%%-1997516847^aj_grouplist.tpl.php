<?php /* Smarty version 2.6.0, created on 2012-05-31 11:41:04
         compiled from member/user/aj_grouplist.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'assign', 'member/user/aj_grouplist.tpl', 4, false),)), $this); ?>
<table width="100%" border="0" cellspacing="1" cellpadding="1">
	<?php if (isset($this->_sections['ln'])) unset($this->_sections['ln']);
$this->_sections['ln']['name'] = 'ln';
$this->_sections['ln']['loop'] = is_array($_loop=$this->_tpl_vars['activegroup']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
   <?php if ($this->_sections['ln']['index'] % 2 == 0): ?>
      <?php echo smarty_function_assign(array('var' => 'rowclass','value' => 'golden'), $this);?>

   <?php else: ?>
      <?php echo smarty_function_assign(array('var' => 'rowclass','value' => ""), $this);?>

   <?php endif; ?>
   <tr class="<?php echo $this->_tpl_vars['rowclass']; ?>
">
		<td width="30" height="26" align="center">
			<input type="checkbox" class="radib-btn" name="groups[]" id="iGroupID" value="<?php echo $this->_tpl_vars['activegroup'][$this->_sections['ln']['index']]['iGroupID']; ?>
" />
		</td>
		<td width="188" align="left" style="padding-left:2px;"><?php echo $this->_tpl_vars['activegroup'][$this->_sections['ln']['index']]['vCompanyName']; ?>
</td>
          <td width="189" align="left"> &nbsp;<?php echo $this->_tpl_vars['activegroup'][$this->_sections['ln']['index']]['vGroupName']; ?>
</td>
		<td width="59" align="center"><?php echo $this->_tpl_vars['activegroup'][$this->_sections['ln']['index']]['eCreatedBy']; ?>
</td>
		<td width="62"  align="center">
              <?php if ($this->_tpl_vars['activegroup'][$this->_sections['ln']['index']]['eStatus'] == 'Active'): ?>
            <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/icon.gif" alt="" border="0" />
         <?php elseif ($this->_tpl_vars['activegroup'][$this->_sections['ln']['index']]['eStatus'] == 'Need to Verify'): ?>
            <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/exclaim.gif" alt="" border="0" />
         <?php elseif ($this->_tpl_vars['activegroup'][$this->_sections['ln']['index']]['eStatus'] == 'Modified'): ?>
            <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/icon-modified.png" alt="" border="0" />
         <?php elseif ($this->_tpl_vars['activegroup'][$this->_sections['ln']['index']]['eStatus'] == 'Inactive'): ?>
            <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/icon-inactive.gif" alt="" border="0" />
         <?php endif; ?>
		</td>
	  <td width="94" align="center">
			<a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
creategroup/<?php echo $this->_tpl_vars['activegroup'][$this->_sections['ln']['index']]['iGroupID']; ?>
"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/icon-pen.gif"  alt="" border="0" style="cursor:pointer; vertical-align:middle;" /></a> &nbsp;
			<a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
groupview/<?php echo $this->_tpl_vars['activegroup'][$this->_sections['ln']['index']]['iGroupID']; ?>
"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/icon-edit.gif"  alt="" border="0" style="cursor:pointer; vertical-align:middle;" /></a> &nbsp;
			<img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/icon-delete.gif"  alt="" border="0" style="cursor:pointer; vertical-align:middle;" onClick="Delete('delete','<?php echo $this->_tpl_vars['activegroup'][$this->_sections['ln']['index']]['iGroupID']; ?>
')"/>
	  </td>
	</tr>
	<?php endfor; endif; ?>
</table>
<input type="hidden" name="pg" id="pg" value=""/>
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
      <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "commonicon.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
   </td>
</tr>
</table>