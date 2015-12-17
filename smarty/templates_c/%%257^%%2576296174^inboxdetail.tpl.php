<?php /* Smarty version 2.6.0, created on 2015-06-26 13:37:14
         compiled from member/inboxdetail.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'assign', 'member/inboxdetail.tpl', 1, false),array('modifier', 'cat', 'member/inboxdetail.tpl', 1, false),array('modifier', 'Time_Format', 'member/inboxdetail.tpl', 19, false),)), $this); ?>
<?php echo smarty_function_assign(array('var' => 'field','value' => ((is_array($_tmp='vMailSubject_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['LANG']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['LANG']))), $this);?>

<?php echo smarty_function_assign(array('var' => 'fielddesc','value' => ((is_array($_tmp='tMailContent_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['LANG']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['LANG']))), $this);?>

<div class="middle-container">
       <h1><?php echo $this->_tpl_vars['LBL_INBOX']; ?>
</h1>
       <div class="middle-containt">
       <div class="statistics-main-box-white">
       <div class="clear"></div><div class="inner-gray-bg">
            	<div>&nbsp;</div>
                <div>
                    <table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
                    <tr>
                      <td width="60" valign="top"><?php echo $this->_tpl_vars['LBL_SUBJECT']; ?>
&nbsp; :</td>
                      <td>
                        <?php echo $this->_tpl_vars['res'][0][$this->_tpl_vars['field']]; ?>

                      </td>
                    </tr>
                    <tr>
                      <td valign="top"><?php echo $this->_tpl_vars['LBL_DATE']; ?>
&nbsp; :</td>
                      <td><?php echo ((is_array($_tmp=$this->_tpl_vars['res'][0]['dActionDate'])) ? $this->_run_mod_handler('Time_Format', true, $_tmp) : Time_Format($_tmp)); ?>
</td>
                    </tr>
                    <tr>
                      <td valign="top"><?php echo $this->_tpl_vars['LBL_CONTENT']; ?>
&nbsp; :</td>
                      <td>
                        <?php echo $this->_tpl_vars['res'][0][$this->_tpl_vars['fielddesc']]; ?>

                      </td>
                    </tr>
                    </table>
						  <div align="center"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-back.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="history.back();" /></div>
                </div>
                <div>&nbsp;</div>
            </div>
       </div>
       </div>
     </div>
</form>