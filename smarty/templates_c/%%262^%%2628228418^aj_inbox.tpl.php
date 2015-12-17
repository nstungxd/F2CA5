<?php /* Smarty version 2.6.0, created on 2015-06-20 22:53:15
         compiled from member/aj_inbox.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'assign', 'member/aj_inbox.tpl', 1, false),array('modifier', 'cat', 'member/aj_inbox.tpl', 1, false),array('modifier', 'in_array', 'member/aj_inbox.tpl', 5, false),array('modifier', 'calcLTzTime', 'member/aj_inbox.tpl', 10, false),array('modifier', 'getInboxDate', 'member/aj_inbox.tpl', 10, false),array('modifier', 'count', 'member/aj_inbox.tpl', 28, false),)), $this); ?>
<?php echo smarty_function_assign(array('var' => 'field','value' => ((is_array($_tmp='vMailSubject_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['LANG']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['LANG']))), $this);?>

<table width="100%" border="0" cellspacing="1" cellpadding="0">
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
		<tr <?php if (in_array($this->_tpl_vars['activegroup'][$this->_sections['ln']['index']]['iVerifiedID'], $this->_tpl_vars['readm'])): ?> class="golden" <?php else: ?> class="inbox-unread" <?php endif; ?>>
		<td width="5" height="26" align="center">
			<input type="checkbox" class="radib-btn" name="inbox[]" id="inbox" value="<?php echo $this->_tpl_vars['activegroup'][$this->_sections['ln']['index']]['iVerifiedID']; ?>
" />
		</td>
      <td height="26" width="158" align="left"><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
inboxdetail/<?php echo $this->_tpl_vars['activegroup'][$this->_sections['ln']['index']]['iVerifiedID']; ?>
"><?php echo $this->_tpl_vars['activegroup'][$this->_sections['ln']['index']][$this->_tpl_vars['field']]; ?>
</a></td>
		<td width="119" align="center"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['activegroup'][$this->_sections['ln']['index']]['dActionDate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)))) ? $this->_run_mod_handler('getInboxDate', true, $_tmp) : getInboxDate($_tmp)); ?>
</td>
	</tr>
	<?php endfor; endif; ?>
</table>
<input type="hidden" name="pg" id="pg" value=""/>
<div class="pagging-bg">
	<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td height="27"><!--Showing 1 - 30 Records Of 3838--><?php echo $this->_tpl_vars['pgmsg']; ?>
</td>
			<td align="right"  class="detail-graybg" style="padding-right:12px;">
				<?php echo $this->_tpl_vars['paging']; ?>

				<!--Pages : &nbsp;&nbsp;<span>1</span><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#">Next</a>-->
			</td>
		</tr>
	</table>
</div>
<?php echo '
<script type="text/javascript">
   $(\'#invoice_count\').html(\'';  echo count($this->_tpl_vars['activegroup']);  echo '\');
</script>
'; ?>