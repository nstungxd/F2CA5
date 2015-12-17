<?php /* Smarty version 2.6.0, created on 2015-06-20 22:23:48
         compiled from member/user/aj_polist.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'assign', 'member/user/aj_polist.tpl', 4, false),array('modifier', 'str_replace', 'member/user/aj_polist.tpl', 13, false),array('modifier', 'calcLTzTime', 'member/user/aj_polist.tpl', 19, false),array('modifier', 'DateTime', 'member/user/aj_polist.tpl', 19, false),array('modifier', 'trim', 'member/user/aj_polist.tpl', 20, false),array('modifier', 'htmlentities', 'member/user/aj_polist.tpl', 36, false),array('modifier', 'cat', 'member/user/aj_polist.tpl', 50, false),)), $this); ?>
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
                <input type="checkbox" class="radib-btn" name="iPurchaseOrderID[]" id="iPurchaseOrderID" style="vertical-align:middle;" value="<?php echo $this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['iPurchaseOrderID']; ?>
" />
          <?php endif; ?>
			 <?php echo smarty_function_assign(array('var' => 'vponum','value' => ((is_array($_tmp="-")) ? $this->_run_mod_handler('str_replace', true, $_tmp, " - ", $this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['vPONumber']) : str_replace($_tmp, " - ", $this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['vPONumber']))), $this);?>

         &nbsp;<?php echo $this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['vPoBuyerCode']; ?>
</td>
        <td width="67"  align="center"><?php echo $this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['fPOTotal']; ?>
</td>
        <td width="48" align="center"><?php echo $this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['days']; ?>
</td>
        <td width="74" align="center"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['dCreateDate'])) ? $this->_run_mod_handler('calcLTzTime', true, $_tmp) : calcLTzTime($_tmp)))) ? $this->_run_mod_handler('DateTime', true, $_tmp, '10') : DateTime($_tmp, '10')); ?>
</td>
        <td width="87" align="center"><?php if (((is_array($_tmp=$this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['vSupplierName'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) == ''): ?>---<?php else:  echo $this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['vSupplierName'];  endif; ?></td>
        <?php if ($this->_tpl_vars['orgtype'] != 'Buyer'): ?>
        	<td width="77" align="center"><?php echo $this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['vBuyerCompanyName']; ?>
</td>
        <?php endif; ?>
        <td width="58" align="center">
              <b>
						<?php if ($this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['eSaved'] == 'Yes'): ?>
								<?php echo $this->_tpl_vars['MSG_SAVED']; ?>

						<?php else: ?>
								<?php if ($this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['iStatusID'] == 0): ?>
								<?php echo $this->_tpl_vars['LBL_NEED_TO_VERIFY']; ?>

								<?php elseif ($this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['status'] == 'Rejected' && $this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['eDelete'] == 'Yes'): ?>
                        	<?php echo $this->_tpl_vars['LBL_DELETE']; ?>

       						<?php elseif ($this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['iSupplierOrganizationID'] == $this->_tpl_vars['curORGID'] && $this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['iStatusID'] == $this->_tpl_vars['isusts'] && $this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['iaStatusID'] == 0): ?>
		                  	<?php echo $this->_tpl_vars['LBL_NEED_TO_ACCEPT']; ?>

                        <?php else: ?>
								<?php echo ((is_array($_tmp=$this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['status'])) ? $this->_run_mod_handler('htmlentities', true, $_tmp) : htmlentities($_tmp)); ?>

								<?php endif; ?>
						<?php endif; ?>
              </b>

         </td>
        <td width="74" align="center">
             <!-- <a href="#"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/icon-pen.gif"  alt="" border="0" style="vertical-align:middle;" /></a> &nbsp; -->
				<?php echo smarty_function_assign(array('var' => 'iex','value' => $this->_tpl_vars['poObj']->chkinvex($this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['iPurchaseOrderID'])), $this);?>

				<?php if ($this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['iaStatusID'] == $this->_tpl_vars['acptsts'] && $this->_tpl_vars['iex'] == 'y' && ( $this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['iInvoiceID'] < 1 || ((is_array($_tmp=$this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['iInvoiceID'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) != '' )): ?>
					<img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
create_new_icon.png" title="<?php echo $this->_tpl_vars['LBL_CREATE_INVOICE']; ?>
" alt="" border="0" onclick="return ci('<?php echo $this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['iPurchaseOrderID']; ?>
');" style="vertical-align:middle; cursor:pointer;" /> &nbsp;
				<?php endif; ?>
            <a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
purchaseorderview/<?php echo $this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['iPurchaseOrderID']; ?>
"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/icon-edit.gif"  alt="" border="0" style="vertical-align:middle;" /></a> &nbsp;
            <?php if ($this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['status'] == 'Rejected'): ?>
                <?php echo smarty_function_assign(array('var' => 'ondelete','value' => ((is_array($_tmp=((is_array($_tmp="Delete('delete','")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['iPurchaseOrderID']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['iPurchaseOrderID'])))) ? $this->_run_mod_handler('cat', true, $_tmp, "')") : smarty_modifier_cat($_tmp, "')"))), $this);?>

            <?php else: ?>
                <?php echo smarty_function_assign(array('var' => 'ondelete','value' => "alert('".($this->_tpl_vars['MSG_REJECTED_PO_DEL'])."')"), $this);?>

            <?php endif; ?>
				<?php if (((is_array($_tmp=$this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['status'])) ? $this->_run_mod_handler('htmlentities', true, $_tmp) : htmlentities($_tmp)) == 'Accepted'): ?>
					<a title="<?php echo $this->_tpl_vars['LBL_PRINT']; ?>
" style="cursor:pointer" class="colorboxfile" rel="<?php echo $this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['iPurchaseOrderID']; ?>
">
					<img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
report.png"  alt="" border="0" style="vertical-align:middle;" /></a> &nbsp;
					</a>
				<?php endif; ?>
            <?php if ($this->_tpl_vars['usertype'] != 'orgadmin'): ?>
            <?php if ($this->_tpl_vars['activegroup'][$this->_sections['i']['index']]['eDelete'] != 'Yes'): ?>
             <a onclick="<?php echo $this->_tpl_vars['ondelete']; ?>
"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/icon-delete.gif"  alt="" border="0" style="vertical-align:middle;cursor: pointer" /></a>
             <?php else: ?>
             <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
             <?php endif; ?>
             <?php endif; ?>
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