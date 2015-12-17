<?php /* Smarty version 2.6.0, created on 2015-06-11 13:31:51
         compiled from member/user/organizationuserview.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'trim', 'member/user/organizationuserview.tpl', 201, false),)), $this); ?>
<div class="middle-container">
<h1><?php echo $this->_tpl_vars['LBL_USER_PROFILE']; ?>

     </h1>

<div class="middle-containt">
   <div class="statistics-main-box-white">
        <?php if ($this->_tpl_vars['sess_usertype'] != 'orguser'): ?>
      <div>
         <ul id="inner-tab">
			   <li><a class="<?php if ($this->_tpl_vars['file'] == 'u-organizationuserview'): ?>current<?php endif; ?>"><EM><?php echo $this->_tpl_vars['LBL_ORG_USER']; ?>
</EM></a></li>
				<?php if ($this->_tpl_vars['OuserData']['eUserType'] == 'User'): ?>
				<li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
userrights/<?php echo $this->_tpl_vars['userData']['iUserID']; ?>
" class="<?php if ($this->_tpl_vars['file'] == 'u-userrights'): ?>current<?php endif; ?>"><EM><?php echo $this->_tpl_vars['LBL_ORG_USER_ACCESS_RIGHTS']; ?>
</EM></a></li>
				<?php endif; ?>
         </ul>
      </div>
        <?php endif; ?>
      <div class="clear"></div>
      <div class="inner-gray-bg" <?php echo $this->_tpl_vars['style']; ?>
>
           <?php if ($this->_tpl_vars['msg'] != '' && ( ( $this->_tpl_vars['OuserData']['eStatus'] != 'Active' && $this->_tpl_vars['OuserData']['eStatus'] != 'Inactive' ) || $this->_tpl_vars['udts']['eNeedToVerify'] == 'Yes' )): ?>
                    <div class="msg"><?php echo $this->_tpl_vars['msg']; ?>
</div>
               <?php endif; ?>
         <div>&nbsp;</div>
			<div><span style="float:right;"><b><a class="" href="javascript:openpopup('<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
orguserviewhistory/<?php echo $this->_tpl_vars['userData']['iUserID']; ?>
');" ><?php echo $this->_tpl_vars['LBL_VIEW_HISTORY']; ?>
</a></b></span></div>
         <div>
              <form name="frmadd" id="frmadd" action="<?php echo $this->_tpl_vars['SITE_URL']; ?>
index.php?file=u-createorganizationuser_a" method="post">
               <input type="hidden" name="iUserID" id="iUserID" value="<?php echo $this->_tpl_vars['iUserID']; ?>
" />
               <input type="hidden" name="view" id="view" value="<?php echo $this->_tpl_vars['view']; ?>
" />
               <table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="">
               <tr>
                  <td width="190px"><?php echo $this->_tpl_vars['LBL_USER_TYPE']; ?>
&nbsp;</td>
                  <td width="1px">:</td>
                  <td ><?php echo $this->_tpl_vars['userData']['eUserType']; ?>
</td>
               </tr>
               <tr>
                  <td width="190px"><?php echo $this->_tpl_vars['LBL_FIRST_NAME']; ?>
&nbsp;</td>
                  <td width="1px">:</td>
                  <td><?php echo $this->_tpl_vars['userData']['vFirstName']; ?>
</td>
               </tr>
               <tr>
                  <td width="190px"><?php echo $this->_tpl_vars['LBL_LAST_NAME']; ?>
&nbsp; </td>
                  <td width="1px">:</td>
                  <td><?php echo $this->_tpl_vars['userData']['vLastName']; ?>
</td>
               </tr>
               <tr>
                  <td width="190px">Salutation </td>
                 <td width="1px">:</td>
                  <td><?php echo $this->_tpl_vars['userData']['eSalutation']; ?>
</td>
               </tr>
               <tr>
                  <td width="190px"><?php echo $this->_tpl_vars['LBL_ORGANIZATION']; ?>
&nbsp; </td>
                  <td width="1px">:</td>
                  <td><?php echo $this->_tpl_vars['organization'][0]['vCompanyName']; ?>
(<?php echo $this->_tpl_vars['organization'][0]['vOrganizationCode']; ?>
)
                  </td>
               </tr>
               <tr>
                  <td width="190px"><?php echo $this->_tpl_vars['LBL_COMP_CODE']; ?>
  </td>
                  <td width="1px">:</td>
                  <td><?php echo $this->_tpl_vars['organization'][0]['vCompCode']; ?>
</td>
               </tr>
               <tr>
                  <td width="190px"><?php echo $this->_tpl_vars['LBL_USER_NAME']; ?>
  </td>
                  <td width="1px">:</td>
                  <td><?php echo $this->_tpl_vars['userData']['vUserName']; ?>
</td>
               </tr>
               <?php if ($this->_tpl_vars['sess_usertype'] != 'orguser'): ?>
               <tr>
                  <td width="190px"><?php echo $this->_tpl_vars['LBL_PASSWORD']; ?>
  </td>
                  <td width="1px">:</td>
                  <td><?php if ($this->_tpl_vars['userData']['vPassword'] != ''): ?>#####<?php else: ?>---<?php endif; ?></td>
               </tr>
               <?php endif; ?>
               <tr>
                  <td width="190px"> <?php echo $this->_tpl_vars['LBL_ADDR_LINE']; ?>
 1&nbsp; </td>
                  <td width="1px">:</td>
                  <td><?php echo $this->_tpl_vars['userData']['vAddressLine1']; ?>
</td>
               </tr>
               <tr>
                  <td width="190px"><?php echo $this->_tpl_vars['LBL_ADDR_LINE']; ?>
 2 </td>
                  <td width="1px">:</td>
                  <td><?php echo $this->_tpl_vars['userData']['vAddressLine2']; ?>
</td>
               </tr>
               <tr>
                  <td width="190px"> <?php echo $this->_tpl_vars['LBL_ADDR_LINE']; ?>
 3 </td>
                  <td width="1px">:</td>
                  <td><?php echo $this->_tpl_vars['userData']['vAddressLine3']; ?>
</td>
               </tr>
               <tr>
                    <td width="190px"><?php echo $this->_tpl_vars['LBL_COUNTRY']; ?>
&nbsp;</td>
                    <td width="1px">:</td>
                    <td>
                             <?php if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['db_country']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                   <?php if ($this->_tpl_vars['userData']['vCountry'] == $this->_tpl_vars['db_country'][$this->_sections['i']['index']]['vCountryCode']): ?>
                                        <?php echo $this->_tpl_vars['db_country'][$this->_sections['i']['index']]['vCountry']; ?>

                                   <?php endif; ?>
                             <?php endfor; endif; ?>
                    </td>
               </tr>
               <tr>
                    <td width="190px"><?php echo $this->_tpl_vars['LBL_STATE']; ?>
&nbsp; </td>
                    <td width="1px">:</td>
                    <td>
                         <input type="hidden" name="selstate" id="selstate" value="<?php echo $this->_tpl_vars['userData']['vState']; ?>
">
                        <?php if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['db_state']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                              <?php if ($this->_tpl_vars['userData']['vState'] == $this->_tpl_vars['db_state'][$this->_sections['i']['index']]['vStateCode']): ?>
                                   <?php echo $this->_tpl_vars['db_state'][$this->_sections['i']['index']]['vState']; ?>

                              <?php endif; ?>
                        <?php endfor; endif; ?>
                    </td>
               </tr>

               <tr>
                  <td width="190px"><?php echo $this->_tpl_vars['LBL_CITY']; ?>
&nbsp; </td>
                  <td width="1px">:</td>
                  <td><?php echo $this->_tpl_vars['userData']['vCity']; ?>
</td>
               </tr>
               <tr>
                  <td width="190px"><?php echo $this->_tpl_vars['LBL_ZIP_CODE']; ?>
&nbsp; </td>
                  <td width="1px">:</td>
                  <td><?php echo $this->_tpl_vars['userData']['vZipCode']; ?>
</td>
               </tr>
               <tr>
                  <td width="190px"><?php echo $this->_tpl_vars['LBL_PHONE']; ?>
 </td>
                  <td width="1px">:</td>
                  <td><?php echo $this->_tpl_vars['userData']['vPhone']; ?>
</td>
               </tr>
               <tr>
                  <td width="190px"><?php echo $this->_tpl_vars['LBL_EXTENTION']; ?>
 </td>
                  <td width="1px">:</td>
                  <td><?php echo $this->_tpl_vars['userData']['vExtention']; ?>
</td>
               </tr>
               <tr>
                  <td width="190px"><?php echo $this->_tpl_vars['LBL_MOBILE']; ?>
 </td>
                  <td width="1px">:</td>
                  <td><?php echo $this->_tpl_vars['userData']['vMobile']; ?>
</td>
               </tr>
               <tr>
                  <td width="190px"><?php echo $this->_tpl_vars['LBL_EMAIL']; ?>
&nbsp; </td>
                  <td width="1px">:</td>
                  <td><?php echo $this->_tpl_vars['userData']['vEmail']; ?>
</td>
               </tr>

               <?php if ($this->_tpl_vars['sess_usertype'] != 'orguser'): ?>
               <tr>
                  <td width="190px"><?php echo $this->_tpl_vars['LBL_PER_TYPE']; ?>
  </td>
                  <td width="1px">:</td>
                  <td><?php echo $this->_tpl_vars['userData']['ePermissionType']; ?>
</td>
               </tr>
               <?php if ($this->_tpl_vars['userData']['ePermissionType'] == 'Group'): ?>
               <tr>
                  <td width="190px"><?php echo $this->_tpl_vars['LBL_GROUP']; ?>
  </td>
                  <td width="1px">:</td>
                  <td><?php echo $this->_tpl_vars['userData']['vGroupName']; ?>
</td>
               </tr>
               <?php endif; ?>
               <?php endif; ?>
                <tr>
                  <td width="190px"><?php echo $this->_tpl_vars['LBL_SEC_QUESTION']; ?>
1</td>
                  <td width="1px">:</td>
                  <td><?php echo $this->_tpl_vars['secQuestion1']; ?>

               </tr>
               <tr>
                  <td width="190px"><?php echo $this->_tpl_vars['LBL_ANSWER']; ?>
</td>
                  <td width="1px">:</td>
                  <td><?php if ($this->_tpl_vars['userData']['vAnswer'] != ''): ?>#####<?php else: ?>---<?php endif; ?></td>
               </tr>
					<?php if ($this->_tpl_vars['userData']['iSecretQuestion2ID'] > 0): ?>
               <tr>
                  <td width="190px"><?php echo $this->_tpl_vars['LBL_SEC_QUESTION']; ?>
2 </td>
                  <td width="1px">:</td>
                  <td><?php echo $this->_tpl_vars['secQuestion2']; ?>
</td>
               </tr>
               <tr>
                  <td width="190px"><?php echo $this->_tpl_vars['LBL_ANSWER']; ?>
 </td>
                  <td width="1px">:</td>
                  <td><?php if ($this->_tpl_vars['userData']['vAnwser'] != ''): ?>#####<?php else: ?>---<?php endif; ?></td>
               </tr>
					<?php endif; ?>
               <tr>
                  <td width="190px"><?php echo $this->_tpl_vars['LBL_ONLINE_EMAIL_NOTIFICATION']; ?>
  </td>
                  <td width="1px">:</td>
                  <td><?php echo $this->_tpl_vars['userData']['eEmailNotification']; ?>
</td>
               </tr>
                <tr>
                  <td width="190px"><?php echo $this->_tpl_vars['LBL_DEFAULT_LANGUAGE']; ?>
  </td>
                  <td width="1px">:</td>
                  <td><?php echo $this->_tpl_vars['defaltLan']; ?>
</td>
               </tr>
					<?php if ($this->_tpl_vars['verify'] == 'yes'): ?>
					<tr>
					  <td valign="top" width="190px"><?php echo $this->_tpl_vars['LBL_REASON_TO_REJECT']; ?>
 </td>
					  <td valign="top" width="1px">:</td>
					  <td><textarea id="tReasonToReject" name="tReasonToReject" cols="70" rows="3"></textarea></td>
					</tr>
					<?php endif; ?>
					<?php if ($this->_tpl_vars['vusrdt'][0]['iRejectedById'] > 0 && ((is_array($_tmp=$this->_tpl_vars['vusrdt'][0]['tReasonToReject'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) != ''): ?>
					<tr>
					  <td valign="top" width="190px"><?php echo $this->_tpl_vars['LBL_REASON_TO_REJECT']; ?>
 </td>
					  <td valign="top" width="1px">:</td>
					  <td><div style="background:#fafafa; border:1px solid #cccccc; height:30px; width:390px; overflow-y:scroll;"><?php echo ((is_array($_tmp=$this->_tpl_vars['vusrdt'][0]['tReasonToReject'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)); ?>
</div></td>
					</tr>
					<?php endif; ?>
               <tr>
                  <td colspan="3" height="5">&nbsp;</td>
               </tr>
               <tr>
                 <td valign="top" colspan="3" align="center">&nbsp;
							<img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-back.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" <?php if ($this->_tpl_vars['verify'] == 'yes'): ?>onclick="location.href='<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
verifyorganizationuserlist'"<?php else: ?>onclick="location.href='<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
organizationuserlist'"<?php endif; ?> />
							<?php if ($this->_tpl_vars['verify'] == 'yes' || $this->_tpl_vars['usrvrfy'] == 'yes'): ?>
                         <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-verify.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('verify');$('#frmadd').submit();" />
                         <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-reject.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('reject');$('#frmadd').submit();" />
							<?php endif; ?>
						  <span style="float:right;">
						  &nbsp;
                      <?php if ($this->_tpl_vars['OuserData']['eStatus'] == 'Modified'): ?>
                         <a class="colorbox" href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
index.php?file=u-aj_useroverview&id=<?php echo $this->_tpl_vars['OuserData']['iUserID']; ?>
" onmouseover="CallColoerBox(this.href,600,500,'file');">Click Here to view Original</a>
                      <?php endif; ?>
						  </span>
                 </td>
               </tr>
            </table>
              </form>
         </div>
         <div>&nbsp;</div>
      </div>
   </div>
</div>
</div>