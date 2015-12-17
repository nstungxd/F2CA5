<?php /* Smarty version 2.6.0, created on 2015-06-22 09:12:55
         compiled from member/organization/organizationview.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'trim', 'member/organization/organizationview.tpl', 203, false),)), $this); ?>
<div class="middle-container">
  <h1><?php echo $this->_tpl_vars['LBL_ORG_VIEW']; ?>
</h1>
  <div class="middle-containt">
  <div class="statistics-main-box-white">
     <div>
          <ul id="inner-tab">
              <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
organizationview/<?php echo $this->_tpl_vars['iOrganizationID']; ?>
/<?php echo $this->_tpl_vars['pg']; ?>
" class="<?php if ($this->_tpl_vars['file'] == 'or-organizationview'): ?>current<?php endif; ?>"><EM><?php echo $this->_tpl_vars['LBL_ORG_INFO']; ?>
</EM></a></li>
                            <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
organizationprefview/<?php echo $this->_tpl_vars['iOrganizationID']; ?>
/<?php echo $this->_tpl_vars['iAdditionalInfoID']; ?>
/<?php echo $this->_tpl_vars['pg']; ?>
" class="<?php if ($this->_tpl_vars['file'] == 'or-organizationprefview'): ?>current<?php endif; ?>"><EM><?php echo $this->_tpl_vars['LBL_PREFERENCES']; ?>
</EM></a></li>
                        </ul>
     </div>
  <div class="clear"></div>
  <div class="inner-gray-bg">
       <?php if ($this->_tpl_vars['msg'] != '' && ( $this->_tpl_vars['Oarr'][0]['eStatus'] != 'Active' || $this->_tpl_vars['Oarr'][0]['eNeedToVerify'] == 'Yes' )): ?>
          <div class="msg"><?php echo $this->_tpl_vars['msg']; ?>
</div>
       <?php endif; ?>
  <div>&nbsp;</div>
  <div><span style="float:right;"><b><a class="" href="javascript:openpopup('<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
orgviewhistory/<?php echo $this->_tpl_vars['iOrganizationID']; ?>
')" ><?php echo $this->_tpl_vars['LBL_VIEW_HISTORY']; ?>
</a></b></span></div>
  <div>
    <form name="orgverify" id="orgverify" method="post" action="<?php echo $this->_tpl_vars['SITE_URL']; ?>
index.php?file=or-createorganization_a">
     <table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
          <tr>
               <td width="180"><?php echo $this->_tpl_vars['LBL_COMP_NAME']; ?>
&nbsp; </td>
               <td>:</td>
               <td align="left"><?php echo $this->_tpl_vars['arr'][0]['vCompanyName']; ?>
</td>
          </tr>
          <tr>
               <td><?php echo $this->_tpl_vars['LBL_COMP_REG_NO']; ?>
&nbsp; </td>
               <td>:</td>
               <td><?php echo $this->_tpl_vars['arr'][0]['vCompanyRegNo']; ?>
</td>
          </tr>
          <tr>
               <td><?php echo $this->_tpl_vars['LBL_ORG_CODE']; ?>
&nbsp; </td>
               <td>:</td>
               <td><?php echo $this->_tpl_vars['arr'][0]['vOrganizationCode']; ?>
</td>
          </tr>
          <tr>
               <td><?php echo $this->_tpl_vars['LBL_COMP_CODE']; ?>
&nbsp; </td>
               <td>:</td>
               <td><?php echo $this->_tpl_vars['arr'][0]['vCompCode']; ?>
</td>
          </tr>
          <tr>
               <td> <?php echo $this->_tpl_vars['LBL_ADDR_LINE']; ?>
 1&nbsp; </td>
               <td>:</td>
               <td><?php echo $this->_tpl_vars['arr'][0]['vAddressLine1']; ?>
</td>
          </tr>
          <tr>
               <td> <?php echo $this->_tpl_vars['LBL_ADDR_LINE']; ?>
 2 </td>
               <td>:</td>
               <td><?php echo $this->_tpl_vars['arr'][0]['vAddressLine2']; ?>
</td>
          </tr>
          <tr>
               <td> <?php echo $this->_tpl_vars['LBL_ADDR_LINE']; ?>
 3 </td>
               <td>:</td>
               <td><?php echo $this->_tpl_vars['arr'][0]['vAddressLine3']; ?>
</td>
          </tr>
          <tr>
               <td><?php echo $this->_tpl_vars['LBL_CITY']; ?>
&nbsp; </td>
               <td>:</td>
               <td><?php echo $this->_tpl_vars['arr'][0]['vCity']; ?>
</td>
          </tr>
          <tr>
               <td><?php echo $this->_tpl_vars['LBL_COUNTRY']; ?>
&nbsp; </td>
               <td>:</td>
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
                              <?php if ($this->_tpl_vars['arr'][0]['vCountry'] == $this->_tpl_vars['db_country'][$this->_sections['i']['index']]['vCountryCode']): ?>
                                   <?php echo $this->_tpl_vars['db_country'][$this->_sections['i']['index']]['vCountry']; ?>

                              <?php endif; ?>
                        <?php endfor; endif; ?>
               </td>
          </tr>
                    <tr>
               <td><?php echo $this->_tpl_vars['LBL_STATE']; ?>
&nbsp; </td>
               <td>:</td>
               <td>
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
                         <?php if ($this->_tpl_vars['arr'][0]['vState'] == $this->_tpl_vars['db_state'][$this->_sections['i']['index']]['vStateCode']): ?>
                              <?php echo $this->_tpl_vars['db_state'][$this->_sections['i']['index']]['vState']; ?>

                         <?php endif; ?>
                   <?php endfor; endif; ?>
               </td>
          </tr>

          <tr>
               <td><?php echo $this->_tpl_vars['LBL_ZIP_CODE']; ?>
&nbsp; </td>
               <td>:</td>
               <td><?php echo $this->_tpl_vars['arr'][0]['vZipcode']; ?>
</td>
          </tr>
          <tr>
               <td><?php echo $this->_tpl_vars['LBL_PHONE']; ?>
&nbsp; </td>
               <td>:</td>
               <td><?php echo $this->_tpl_vars['arr'][0]['vPhone']; ?>
</td>
          </tr>
          <tr>
               <td><?php echo $this->_tpl_vars['LBL_EMAIL']; ?>
&nbsp; </td>
               <td>:</td>
               <td><?php echo $this->_tpl_vars['arr'][0]['vEmail']; ?>
</td>
          </tr>
          <tr>
               <td><?php echo $this->_tpl_vars['LBL_WEB_SITE']; ?>
 </td>
               <td>:</td>
               <td><?php echo $this->_tpl_vars['arr'][0]['vWebSite']; ?>
</td>
          </tr>
          <tr>
               <td><?php echo $this->_tpl_vars['LBL_ORG_TYPE']; ?>
&nbsp; </td>
               <td>:</td>
               <td><?php echo $this->_tpl_vars['arr'][0]['eOrganizationType']; ?>
</td>
          </tr>
          <tr>
               <td><?php echo $this->_tpl_vars['LBL_PRIME_CONTACT_NO']; ?>
</td>
               <td>:</td>
               <td><?php echo $this->_tpl_vars['arr'][0]['vPrimaryContactNo']; ?>
</td>
          </tr>
                    <tr>
               <td><?php echo $this->_tpl_vars['LBL_PRIME_CONTACT_TELE']; ?>
 </td>
               <td>:</td>
               <td><?php echo $this->_tpl_vars['arr'][0]['vPrimaryContactTelephone']; ?>
</td>
          </tr>
          <tr>
               <td><?php echo $this->_tpl_vars['LBL_PRIME_CONTACT_MOB']; ?>
 </td>
               <td>:</td>
               <td><?php echo $this->_tpl_vars['arr'][0]['vPrimaryContactMobile']; ?>
</td>
          </tr>
          <tr>
               <td><?php echo $this->_tpl_vars['LBL_VAT_ID']; ?>
 </td>
               <td>:</td>
               <td><?php echo $this->_tpl_vars['arr'][0]['vVatId']; ?>
</td>
          </tr>
          <tr>
               <td><?php echo $this->_tpl_vars['LBL_BANK']; ?>
 </td>
               <td>:</td>
               <td><?php echo $this->_tpl_vars['arr'][0]['vBankName']; ?>
</td>
          </tr>
          <tr>
               <td><?php echo $this->_tpl_vars['LBL_BANK_CODE']; ?>
 </td>
               <td>:</td>
               <td><?php echo $this->_tpl_vars['arr'][0]['vBankCode']; ?>
</td>
          </tr>
          <tr>
               <td><?php echo $this->_tpl_vars['LBL_BRANCH']; ?>
 </td>
               <td>:</td>
               <td><?php echo $this->_tpl_vars['arr'][0]['vBranchName']; ?>
</td>
          </tr>
          <tr>
               <td><?php echo $this->_tpl_vars['LBL_BRANCH_CODE']; ?>
 </td>
               <td>:</td>
               <td><?php echo $this->_tpl_vars['arr'][0]['vBranchCode']; ?>
</td>
          </tr>
          <tr>
               <td>Account1 Number </td>
               <td>:</td>
               <td><?php echo $this->_tpl_vars['arr'][0]['vAccount1Number']; ?>
</td>
          </tr>
             <tr>
               <td>Account1 Title </td>
               <td>:</td>
               <td><?php echo $this->_tpl_vars['arr'][0]['vAccount1Title']; ?>
</td>
          </tr>
          <tr>
               <td>Account1 Currency </td>
               <td>:</td>
               <td><?php echo $this->_tpl_vars['arr'][0]['vAccount1Currency']; ?>
</td>
          </tr>
          <tr>
               <td>Account2 Number </td>
               <td>:</td>
               <td><?php echo $this->_tpl_vars['arr'][0]['vAccount2Number']; ?>
</td>
          </tr>
          <tr>
               <td>Account2 Title </td>
               <td>:</td>
               <td><?php echo $this->_tpl_vars['arr'][0]['vAccount2Title']; ?>
</td>
          </tr>
          <tr>
               <td>Account2 Currency </td>
               <td>:</td>
               <td><?php echo $this->_tpl_vars['arr'][0]['vAccount2Currency']; ?>
</td>
          </tr>
          <!-- <tr>
               <td>Create Method Allowed&nbsp; </td>
               <td>:</td>
               <td><?php echo $this->_tpl_vars['arr'][0]['eCreateMethodAllowed']; ?>
</td>
          </tr>
          <tr>
               <td>Verification Required&nbsp; </td>
               <td>:</td>
               <td><?php echo $this->_tpl_vars['arr'][0]['eReqVerification']; ?>
</td>
          </tr> -->
          <?php if ($this->_tpl_vars['verify'] == 'yes'): ?>
          <tr>
            <td valign="top"><?php echo $this->_tpl_vars['LBL_REASON_TO_REJECT']; ?>
 </td>
            <td valign="top">:</td>
            <td><textarea id="tReasonToReject" name="tReasonToReject" cols="70" rows="3"></textarea></td>
          </tr>
          <?php endif; ?>
          <?php if ($this->_tpl_vars['varr'][0]['iRejectedById'] > 0 && ((is_array($_tmp=$this->_tpl_vars['varr'][0]['tReasonToReject'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) != ''): ?>
          <tr>
            <td valign="top"><?php echo $this->_tpl_vars['LBL_REASON_TO_REJECT']; ?>
 </td>
            <td valign="top">:</td>
            <td><div style="background:#fafafa; border:1px solid #cccccc; height:30px; width:390px; overflow-y:scroll;"><?php echo ((is_array($_tmp=$this->_tpl_vars['varr'][0]['tReasonToReject'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)); ?>
</div></td>
          </tr>
          <?php endif; ?>
                    <tr>
               <td colspan="3" height="5"><input type="hidden" name="view" id="view" value="verify" /><input type="hidden" name="iOrgId" id="iOrgId" value="<?php echo $this->_tpl_vars['iOrganizationID']; ?>
" /></td>
          </tr>
          <tr>
               <td valign="top">&nbsp;</td>
               <td colspan="2">
                    <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-back.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" <?php if ($this->_tpl_vars['verify'] == 'yes'): ?>onclick="location.href='<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
verifyorganizationlist'"<?php else: ?>onclick="location.href='<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
organizationlist'"<?php endif; ?> />
                    <?php if ($this->_tpl_vars['verify'] == 'yes'): ?>
                      <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-verify.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#orgverify').submit();" />
                      <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-reject.gif" alt="" id="reset_btn" border="0" style="cursor:pointer; vertical-align:middle;" onclick="$('#view').val('reject');$('#orgverify').submit();" />
                    <?php endif; ?>
               </td>
               <td valign="top" align="right">&nbsp;<?php if ($this->_tpl_vars['Oarr'][0]['eStatus'] == 'Modified'): ?><a class="colorbox" href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
index.php?file=or-aj_orgoverview&id=<?php echo $this->_tpl_vars['Oarr'][0]['iOrganizationID']; ?>
" onmouseover="CallColoerBox(this.href,600,600,'options');">Click Here to view Original</a><?php endif; ?></td>
          </tr>
     </table>
    </form>
   </div>
   <div>&nbsp;</div>
   </div>
   </div>
   </div>
</div>