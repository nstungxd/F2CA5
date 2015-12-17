<?php /* Smarty version 2.6.0, created on 2012-05-31 12:09:05
         compiled from member/organization/createorganization.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'htmlentities', 'member/organization/createorganization.tpl', 229, false),)), $this); ?>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['S_JQUERY']; ?>
jquery.validate.js"></script>
<?php echo '
<script type="text/javascript" >
	var stateArr = new Array(';  echo $this->_tpl_vars['stateArr'];  echo ');
	//alert(stateArr);
</script>
'; ?>

<div class="middle-container">
  <h1><?php echo $this->_tpl_vars['LBL_CREATE_ORG']; ?>
</h1>
  <div class="middle-containt">
  <div class="statistics-main-box-white">
	<div>
		<ul id="inner-tab">
			<li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
createorganization/<?php echo $this->_tpl_vars['iOrganizationID']; ?>
" class="<?php if ($this->_tpl_vars['file'] == 'or-createorganization'): ?>current<?php endif; ?>"><EM><?php echo $this->_tpl_vars['LBL_ORG_INFO']; ?>
</EM></a></li>
			<?php if ($this->_tpl_vars['view'] == 'edit'): ?>
			<li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
createorganizationpref/<?php echo $this->_tpl_vars['iOrganizationID']; ?>
/<?php echo $this->_tpl_vars['iAdditionalInfoID']; ?>
" class="<?php if ($this->_tpl_vars['file'] == 'or-createorganizationpref'): ?>current<?php endif; ?>"><EM><?php echo $this->_tpl_vars['LBL_PREFERENCES']; ?>
</EM></a></li>
			<?php elseif ($this->_tpl_vars['view'] == 'add' || $this->_tpl_vars['view'] == ''): ?>
			<li><a><EM><?php echo $this->_tpl_vars['LBL_PREFERENCES']; ?>
</EM></a></li>
			<?php endif; ?>
		</ul>
	</div>
  <div class="clear"></div>
  <div class="inner-gray-bg">
  <div>&nbsp;</div>
  <div>
           <form name="frmadd" id="frmadd" action="<?php echo $this->_tpl_vars['SITE_URL']; ?>
index.php?file=or-createorganization_a" method="post">
     <input type="hidden" name="iOrganizationID" id="iOrganizationID"value="<?php echo $this->_tpl_vars['iOrganizationID']; ?>
" />
     <input type="hidden" name="iAdditionalInfoID" id="iAdditionalInfoID"value="<?php echo $this->_tpl_vars['iAdditionalInfoID']; ?>
" />
     <input type="hidden" name="iASMID" id="iASMID"value="<?php echo $this->_tpl_vars['iASMID']; ?>
" />
     <input type="hidden" name="view" id="view"value="<?php echo $this->_tpl_vars['view']; ?>
" />
     <table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
          <tr>
               <td width="205"><?php echo $this->_tpl_vars['LBL_COMP_NAME']; ?>
&nbsp;<font class="reqmsg">*</font>  </td>
               <td>:</td>
               <td><input type="text" name="Data[vCompanyName]" id="vCompanyName" class="input-rag required" title="<?php echo $this->_tpl_vars['LBL_ENTER_COMPANY_NAME']; ?>
" value="<?php echo $this->_tpl_vars['arr'][0]['vCompanyName']; ?>
" MinLength="2" /></td>
          </tr>
			 <?php if ($this->_tpl_vars['view'] == 'edit'): ?>
          <tr>
               <td><?php echo $this->_tpl_vars['LBL_ORG_CODE']; ?>
&nbsp; </td>
              <td>:</td>
               <td>
					<?php echo $this->_tpl_vars['arr'][0]['vOrganizationCode']; ?>

					</td>
          </tr>
			<?php endif; ?>
          <tr>
               <td><?php echo $this->_tpl_vars['LBL_COMP_CODE']; ?>
&nbsp;<?php if ($this->_tpl_vars['view'] != 'edit'): ?><font class="reqmsg">*</font> <?php endif; ?></td>
               <td>:</td>
               <td><?php if ($this->_tpl_vars['view'] == 'edit'): ?>
                   <?php echo $this->_tpl_vars['arr'][0]['vCompCode']; ?>

                   <?php else: ?>
                   <input type="text" name="Data[vCompCode]" id="vCompCode" class="input-rag required alphaNum" title="<?php echo $this->_tpl_vars['LBL_ENTER_COMP_CODE']; ?>
" onkeypress="return chkalphanum(event);" value="<?php echo $this->_tpl_vars['arr'][0]['vCompCode']; ?>
" />
                   <?php endif; ?>
					</td>
          </tr>
          <tr>
               <td><?php echo $this->_tpl_vars['LBL_COMP_REG_NO']; ?>
&nbsp;<font class="reqmsg">*</font> </td>
               <td>:</td>
               <td><input type="text" name="Data[vCompanyRegNo]" id="vCompanyRegNo" class="input-rag required" title="<?php echo $this->_tpl_vars['LBL_ENTER_COMPANY_REG_NO']; ?>
" onkeypress="// return chkDigitMobcode(event);" value="<?php echo $this->_tpl_vars['arr'][0]['vCompanyRegNo']; ?>
" /></td>
          </tr>

          <tr>
               <td> <?php echo $this->_tpl_vars['LBL_ADDR_LINE']; ?>
 1&nbsp;<font class="reqmsg">*</font> </td>
               <td>:</td>
               <td><input type="text" name="Data[vAddressLine1]" id="vAddressLine1" class="input-rag required" value="<?php echo $this->_tpl_vars['arr'][0]['vAddressLine1']; ?>
" title="<?php echo $this->_tpl_vars['LBL_ENTER_ADDRESS']; ?>
" /></td>
          </tr>
          <tr>
               <td> <?php echo $this->_tpl_vars['LBL_ADDR_LINE']; ?>
 2 </td>
               <td>:</td>
               <td><input type="text" name="Data[vAddressLine2]" id="vAddressLine2" class="input-rag" value="<?php echo $this->_tpl_vars['arr'][0]['vAddressLine2']; ?>
" /></td>
          </tr>
          <tr>
               <td> <?php echo $this->_tpl_vars['LBL_ADDR_LINE']; ?>
 3 </td>
               <td>:</td>
               <td><input type="text" name="Data[vAddressLine3]" id="vAddressLine3" class="input-rag" value="<?php echo $this->_tpl_vars['arr'][0]['vAddressLine3']; ?>
" /></td>
          </tr>
          <tr>
               <td><?php echo $this->_tpl_vars['LBL_CITY']; ?>
&nbsp;<font class="reqmsg">*</font> </td>
               <td>:</td>
               <td><input type="text" name="Data[vCity]" id="vCity" class="input-rag required" value="<?php echo $this->_tpl_vars['arr'][0]['vCity']; ?>
" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_CITY']; ?>
" /></td>
          </tr>
          <tr>
               <td><?php echo $this->_tpl_vars['LBL_COUNTRY']; ?>
&nbsp;<font class="reqmsg">*</font> </td>
               <td>:</td>
               <td><select name="Data[vCountry]" id="vCountry" class="required" title="<?php echo $this->_tpl_vars['LBL_SELECT_COUNTRY']; ?>
">
							<option value=""> --- Select Country --- </option>
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
								<option title="<?php echo $this->_tpl_vars['db_country'][$this->_sections['i']['index']]['iCountryISD']; ?>
" currency="<?php echo $this->_tpl_vars['db_country'][$this->_sections['i']['index']]['iCurrencyID']; ?>
" value="<?php echo $this->_tpl_vars['db_country'][$this->_sections['i']['index']]['vCountryCode']; ?>
" <?php if ($this->_tpl_vars['arr'][0]['vCountry'] == $this->_tpl_vars['db_country'][$this->_sections['i']['index']]['vCountryCode']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['db_country'][$this->_sections['i']['index']]['vCountry']; ?>
</option>
							<?php endfor; endif; ?>
						</select>
					</td>
          </tr>
                    <tr>
               <td><?php echo $this->_tpl_vars['LBL_STATE']; ?>
&nbsp;<font class="reqmsg">*</font> </td>
               <td>:</td>
               <td>
						<input type="hidden" name="selstate" id="selstate" value="<?php echo $this->_tpl_vars['arr'][0]['vState']; ?>
">
						<select name="Data[vState]" id="vState" class="required" title="<?php echo $this->_tpl_vars['LBL_SELECT_STATE']; ?>
" >
                    <option value=""> --- Select State ---</option>
						</select>
					</td>
          </tr>

          <tr>
               <td><?php echo $this->_tpl_vars['LBL_ZIP_CODE']; ?>
&nbsp;<font class="reqmsg">*</font> </td>
               <td>:</td>
               <td><input type="text" name="Data[vZipcode]" id="vZipcode" class="input-rag required digits" value="<?php echo $this->_tpl_vars['arr'][0]['vZipcode']; ?>
" onkeypress="return chkDigitMobcode(event);" MaxLength="7" /></td>
          </tr>
          <tr>
               <td><?php echo $this->_tpl_vars['LBL_PHONE']; ?>
&nbsp;<font class="reqmsg">*</font> </td>
               <td>:</td>
               <td  valign="top">
						<input type="text" name="vPhoneCode"  class="" value="<?php echo $this->_tpl_vars['arr'][0]['vPhoneCode']; ?>
" onkeypress="return chkDigitMobcode(event);"  id="vPhoneCode" style="width:30px;" maxlength="3" title="<?php echo $this->_tpl_vars['LBL_ENTER_PHONECODE']; ?>
"  />
						<input type="text" name="Data[vPhone]" id="vPhone"  title="<?php echo $this->_tpl_vars['LBL_ENTER_PHONE_NO']; ?>
" onkeypress="return chkDigitMobcode(event);" maxlength="15" value="<?php echo $this->_tpl_vars['arr'][0]['vPhone']; ?>
" style="width:190px;"/>
               </td>
          </tr>
          <tr>
               <td><?php echo $this->_tpl_vars['LBL_EMAIL']; ?>
&nbsp;<font class="reqmsg">*</font> </td>
               <td>:</td>
               <td><input type="text" name="Data[vEmail]" id="vEmail" class="input-rag  required email" value="<?php echo $this->_tpl_vars['arr'][0]['vEmail']; ?>
" /></td>
          </tr>
          <tr>
              <td><?php echo $this->_tpl_vars['LBL_WEB_SITE']; ?>
 :</td>
              <td>:</td>
              <td><input type="text" name="Data[vWebSite]" id="vWebSite" class="input-rag" value="<?php echo $this->_tpl_vars['arr'][0]['vWebSite']; ?>
" /></td>
          </tr>
          <tr>
               <td><?php echo $this->_tpl_vars['LBL_ORG_TYPE']; ?>
&nbsp;<font class="reqmsg">*</font> </td>
               <td>:</td>
               <td><?php echo $this->_tpl_vars['OrgType']; ?>
</td>
          </tr>
			           <tr>
               <td><?php echo $this->_tpl_vars['LBL_PRIME_CONTACT_NO']; ?>
 :</td>
               <td>:</td>
               <td>
                  <input type="text" name="vPrimaryContactNoCode" id="vPrimaryContactNoCode" class="countryCode input-rag" value="<?php echo $this->_tpl_vars['arr'][0]['vPrimaryContactNoCode']; ?>
" onkeypress="return chkDigitMobcode(event);" style="width:30px;" maxlength="3"  />
                  <input type="text" name="Data[vPrimaryContactNo]" id="vPrimaryContactNo" class="input-rag" value="<?php echo $this->_tpl_vars['arr'][0]['vPrimaryContactNo']; ?>
" onkeypress="return chkDigitMobcode(event);" maxlength="15" style="width:190px;" />
               </td>
          </tr>
                    <tr>
               <td><?php echo $this->_tpl_vars['LBL_PRIME_CONTACT_TELE']; ?>
 </td>
               <td>:</td>
               <td>
                  <input type="text" name="vPrimaryContactTelephoneCode" id="vPrimaryContactTelephoneCode" class="countryCode input-rag" onkeypress="return chkDigitMobcode(event);" maxlength="3" value="<?php echo $this->_tpl_vars['arr'][0]['vPrimaryContactTelephoneCode']; ?>
" style="width:30px;" />
                  <input type="text" name="Data[vPrimaryContactTelephone]" id="vPrimaryContactTelephone" class="input-rag" onkeypress="return chkDigitMobcode(event);" maxlength="15" value="<?php echo $this->_tpl_vars['arr'][0]['vPrimaryContactTelephone']; ?>
" style="width:190px;" />
               </td>
          </tr>
          <tr>
               <td><?php echo $this->_tpl_vars['LBL_PRIME_CONTACT_MOB']; ?>
 </td>
               <td>:</td>
               <td>
                  <input type="text" name="vPrimaryContactMobileCode" id="vPrimaryContactMobileCode" class="countryCode input-rag" value="<?php echo $this->_tpl_vars['arr'][0]['vPrimaryContactMobileCode']; ?>
" onkeypress="return chkDigitMobcode(event);" maxlength="3" style="width:30px;"/>
                  <input type="text" name="Data[vPrimaryContactMobile]" id="vPrimaryContactMobile" class="input-rag" value="<?php echo $this->_tpl_vars['arr'][0]['vPrimaryContactMobile']; ?>
" onkeypress="return chkDigitMobcode(event);" maxlength="15" style="width:190px;"/>
               </td>
          </tr>
			 <tr>
               <td><?php echo $this->_tpl_vars['LBL_VAT_ID']; ?>
 </td>
               <td>:</td>
               <td>
						<input type="text" name="Data[vVatId]" id="vVatId" class="input-rag" value="<?php echo $this->_tpl_vars['arr'][0]['vVatId']; ?>
" />
					</td>
          </tr>
          <tr>
               <td><?php echo $this->_tpl_vars['LBL_BANK']; ?>
 </td>
               <td>:</td>
               <td>
						<!--<input type="text" name="Data[vBankName]" id="vBankName" class="input-rag" value="<?php echo $this->_tpl_vars['arr'][0]['vBankName']; ?>
" />-->
						<select name="Data[iBankId]" id="iBankId" class="required" title="<?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_BANK']; ?>
">
						<?php if (isset($this->_sections['l'])) unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['bnk_dtls']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
						<option value="<?php echo $this->_tpl_vars['bnk_dtls'][$this->_sections['l']['index']]['iBankId']; ?>
" <?php if ($this->_tpl_vars['arr'][0]['iBankId'] > 0):  if ($this->_tpl_vars['bnk_dtls'][$this->_sections['l']['index']]['iBankId'] == $this->_tpl_vars['arr'][0]['iBankId']): ?>selected="selected"<?php endif;  elseif ($this->_tpl_vars['bnk_dtls'][$this->_sections['l']['index']]['vBankName'] == $this->_tpl_vars['arr'][0]['vBankName']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['bnk_dtls'][$this->_sections['l']['index']]['vBankName']; ?>
</option>
						<?php endfor; endif; ?>
						</select>
					</td>
          </tr>
			 <tr>
               <td><?php echo $this->_tpl_vars['LBL_BANK_CODE']; ?>
 </td>
               <td>:</td>
               <td><input type="text" name="Data[vBankCode]" id="vBankCode" class="input-rag" value="<?php echo $this->_tpl_vars['arr'][0]['vBankCode']; ?>
" /></td>
          </tr>
			 <tr>
               <td><?php echo $this->_tpl_vars['LBL_BRANCH']; ?>
 </td>
               <td>:</td>
               <td><input type="text" name="Data[vBranchName]" id="vBranchName" class="input-rag" value="<?php echo $this->_tpl_vars['arr'][0]['vBranchName']; ?>
" /></td>
          </tr>
			 <tr>
               <td><?php echo $this->_tpl_vars['LBL_BRANCH_CODE']; ?>
 </td>
               <td>:</td>
               <td><input type="text" name="Data[vBranchCode]" id="vBranchCode" class="input-rag" value="<?php echo $this->_tpl_vars['arr'][0]['vBranchCode']; ?>
" /></td>
          </tr>
          <tr>
               <td>Account1 Number </td>
               <td>:</td>
               <td><input type="text" name="Data[vAccount1Number]" id="vAccount1Number" class="input-rag" value="<?php echo $this->_tpl_vars['arr'][0]['vAccount1Number']; ?>
" /></td>
          </tr>
             <tr>
               <td>Account1 Title </td>
               <td>:</td>
               <td><input type="text" name="Data[vAccount1Title]" id="vAccount1Title" class="input-rag" value="<?php echo $this->_tpl_vars['arr'][0]['vAccount1Title']; ?>
" /></td>
          </tr>
			 <tr>
					<td>Account1 <?php echo $this->_tpl_vars['LBL_CURR']; ?>
</td>
					<td>:</td>
					<td>
						<select name="Data[vAccount1Currency]" id="vAccount1Currency" class="required" style="width:96px;" title="Select Currency" >
						  <?php if (isset($this->_sections['c'])) unset($this->_sections['c']);
$this->_sections['c']['name'] = 'c';
$this->_sections['c']['loop'] = is_array($_loop=$this->_tpl_vars['currency']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['c']['show'] = true;
$this->_sections['c']['max'] = $this->_sections['c']['loop'];
$this->_sections['c']['step'] = 1;
$this->_sections['c']['start'] = $this->_sections['c']['step'] > 0 ? 0 : $this->_sections['c']['loop']-1;
if ($this->_sections['c']['show']) {
    $this->_sections['c']['total'] = $this->_sections['c']['loop'];
    if ($this->_sections['c']['total'] == 0)
        $this->_sections['c']['show'] = false;
} else
    $this->_sections['c']['total'] = 0;
if ($this->_sections['c']['show']):

            for ($this->_sections['c']['index'] = $this->_sections['c']['start'], $this->_sections['c']['iteration'] = 1;
                 $this->_sections['c']['iteration'] <= $this->_sections['c']['total'];
                 $this->_sections['c']['index'] += $this->_sections['c']['step'], $this->_sections['c']['iteration']++):
$this->_sections['c']['rownum'] = $this->_sections['c']['iteration'];
$this->_sections['c']['index_prev'] = $this->_sections['c']['index'] - $this->_sections['c']['step'];
$this->_sections['c']['index_next'] = $this->_sections['c']['index'] + $this->_sections['c']['step'];
$this->_sections['c']['first']      = ($this->_sections['c']['iteration'] == 1);
$this->_sections['c']['last']       = ($this->_sections['c']['iteration'] == $this->_sections['c']['total']);
?>
								<option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['currency'][$this->_sections['c']['index']]['vCode'])) ? $this->_run_mod_handler('htmlentities', true, $_tmp) : htmlentities($_tmp)); ?>
" id="<?php echo $this->_tpl_vars['currency'][$this->_sections['c']['index']]['iCurrencyID']; ?>
_1" <?php if ($this->_tpl_vars['currency'][$this->_sections['c']['index']]['vCode'] == $this->_tpl_vars['arr'][0]['vAccount1Currency']): ?>selected="selected"<?php endif; ?> ><?php echo $this->_tpl_vars['currency'][$this->_sections['c']['index']]['vCode']; ?>
</option>
						  <?php endfor; endif; ?>
						</select>
					</td>
			 </tr>
          <tr>
               <td>Account2 Number </td>
               <td>:</td>
               <td><input type="text" name="Data[vAccount2Number]" id="vAccount2Number" class="input-rag" value="<?php echo $this->_tpl_vars['arr'][0]['vAccount2Number']; ?>
" /></td>
          </tr>
          <tr>
               <td>Account2 Title </td>
               <td>:</td>
               <td><input type="text" name="Data[vAccount2Title]" id="vAccount2Title" class="input-rag" value="<?php echo $this->_tpl_vars['arr'][0]['vAccount2Title']; ?>
" /></td>
          </tr>
          <tr>
               <td>Account2 Currency </td>
               <td>:</td>
               <td>
						<select name="Data[vAccount2Currency]" id="vAccount2Currency" class="required" style="width:96px;" title="Select Currency" >
						  <?php if (isset($this->_sections['c'])) unset($this->_sections['c']);
$this->_sections['c']['name'] = 'c';
$this->_sections['c']['loop'] = is_array($_loop=$this->_tpl_vars['currency']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['c']['show'] = true;
$this->_sections['c']['max'] = $this->_sections['c']['loop'];
$this->_sections['c']['step'] = 1;
$this->_sections['c']['start'] = $this->_sections['c']['step'] > 0 ? 0 : $this->_sections['c']['loop']-1;
if ($this->_sections['c']['show']) {
    $this->_sections['c']['total'] = $this->_sections['c']['loop'];
    if ($this->_sections['c']['total'] == 0)
        $this->_sections['c']['show'] = false;
} else
    $this->_sections['c']['total'] = 0;
if ($this->_sections['c']['show']):

            for ($this->_sections['c']['index'] = $this->_sections['c']['start'], $this->_sections['c']['iteration'] = 1;
                 $this->_sections['c']['iteration'] <= $this->_sections['c']['total'];
                 $this->_sections['c']['index'] += $this->_sections['c']['step'], $this->_sections['c']['iteration']++):
$this->_sections['c']['rownum'] = $this->_sections['c']['iteration'];
$this->_sections['c']['index_prev'] = $this->_sections['c']['index'] - $this->_sections['c']['step'];
$this->_sections['c']['index_next'] = $this->_sections['c']['index'] + $this->_sections['c']['step'];
$this->_sections['c']['first']      = ($this->_sections['c']['iteration'] == 1);
$this->_sections['c']['last']       = ($this->_sections['c']['iteration'] == $this->_sections['c']['total']);
?>
								<option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['currency'][$this->_sections['c']['index']]['vCode'])) ? $this->_run_mod_handler('htmlentities', true, $_tmp) : htmlentities($_tmp)); ?>
" id="<?php echo $this->_tpl_vars['currency'][$this->_sections['c']['index']]['iCurrencyID']; ?>
_2" <?php if ($this->_tpl_vars['currency'][$this->_sections['c']['index']]['vCode'] == $this->_tpl_vars['arr'][0]['vAccount1Currency']): ?>selected="selected"<?php endif; ?> ><?php echo $this->_tpl_vars['currency'][$this->_sections['c']['index']]['vCode']; ?>
</option>
						  <?php endfor; endif; ?>
						</select>
					</td>
          </tr>

<tr>
               <td colspan="2" height="5"></td>
          </tr>
          <tr>
               <td>&nbsp;</td>
               <td colspan="2">
						<input type="hidden" name="dpr" id="dpr" value="nod" />
						<input type="hidden" name="emlval" id="emlval" value="" />
						<img id="btnNext"  name="Next" title="next" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-next.gif" alt="" onclick="submitFrm();" style="cursor:pointer; vertical-align:middle;border:none;background: #f8f8f8;" /> &nbsp;
						<img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-reset.gif" alt="" onclick="resetform();return false;" style="cursor:pointer;border:none;background: #f8f8f8;; vertical-align:middle;" /> &nbsp;
						<img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-cancel.gif" alt="" onClick="window.location=SITE_URL_DUM+'organizationlist';" style="cursor:pointer;border:none; vertical-align:middle;background: #f8f8f8;" />
					</td>
          </tr>
     </table>
     </form>
   </div>
   <div>&nbsp;</div>
   </div>
   </div>
   </div>
  <span id="spn" style="display:hidden;"></span>
  <input type="hidden" name="vldms" id="vldms" value="" />
  <span class="ajscript"></span>
</div>

<?php echo '
<script type="text/javascript" async="async">
function submitFrm()
{
   if(! $("#frmadd").valid()) {
      return false;
   }
	var email = $(\'#vEmail\').val();
	pars = "&id=iOrganizationID"+"&iOrganizationID="+$(\'#iOrganizationID\').val()+"&flds=vEmail"+"&vEmail="+$(\'#vEmail\').val()+"&table=';  echo $this->_tpl_vars['PRJ_DB_PREFIX'];  echo '_organization_master";
	$.post(SITE_URL+"index.php?file=m-aj_chkdupdata", pars, function(resp)
	{
		if(resp == \'dup\') {
			var ans = confirm(LBL_EMAIL_TAKEN+LBL_SURE_TO_PROCEED);
			if(ans) {
				$(\'#dpr\').val(\'dpl\');
				// $(\'#emlval\').val(email);
				// alert(\'yes\');
				$(\'#frmadd\')[0].submit();
			}
		} else if(resp == \'nodup\') {
			$(\'#dpr\').val(\'nod\');
			// alert(\'ndp\');
			$(\'#frmadd\')[0].submit();
			$(document).ready( function() {
				$(function() {
					var ead=10;
					$(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:\'div.middle-container\', eladd:ead});
				});
			});
		}
	});
	return false;
	//$(\'div[htmlfor=vPhone]\').attr("style","float:right;")
	//$(\'#tdvPhone\').attr("style","position:absolute;left:51.7%");
}
function resetform()
{
	$(\'#frmadd\')[0].reset();
   getRelativeCombo($(\'#vCountry\').val(),\'';  echo $this->_tpl_vars['arr'][0]['vState'];  echo '\',\'vState\',\'-- Select State --\',stateArr);
}

$("#frmadd").validate({
	rules:{
          "Data[vPhone]":{
                    required: function(){
                         if($.trim($(\'#vPhoneCode\').val()) == \'\') {
                                 //$(\'#vPhoneCode\').attr("title","';  echo $this->_tpl_vars['LBL_ENTER_PHONECODE'];  echo '");
											return true;
											// $("#frmadd").validate().element(\'#vPhoneCode\');
                            } else {
										return true;
                              // $(\'#vPhone\').attr("title","';  echo $this->_tpl_vars['LBL_ENTER_PHONE_NO'];  echo '");
                           }
                    }},

		"Data[vCompanyRegNo]": {
				remote:{
					  url:SITE_URL+"index.php?file=or-aj_chkdupdata",
					  type:"get",
					  data:{
							 val:function() {
								return $("#iOrganizationID").val();
							},
							id:function() {
								return "iOrganizationID";
							},
							field:function() {
								return "vCompanyRegNo";
							},
                     country: function() {
                        return $(\'#vCountry\').val();
                     },
							table:function() {
								return "';  echo $this->_tpl_vars['PRJ_DB_PREFIX'];  echo '_organization_master";
							}
					}
			}
		},
		"Data[vCompanyName]": {
				remote:{
					  url:SITE_URL+"index.php?file=or-aj_chkdupdata",
					  type:"get",
					  data:{
							 val:function() {
								return $("#iOrganizationID").val();
							},
							id:function() {
								return "iOrganizationID";
							},
							field:function() {
								return "vCompanyName";
							},
							table:function() {
								return "';  echo $this->_tpl_vars['PRJ_DB_PREFIX'];  echo '_organization_master";
							}
					}
			}
		},
		"Data[vCompCode]": {
				remote:{
					  url:SITE_URL+"index.php?file=or-aj_chkdupdata",
					  type:"get",
					  data:{
							 val:function() {
								return $("#iOrganizationID").val();
							},
							id:function() {
								return "iOrganizationID";
							},
							field:function() {
								return "vCompCode";
							},
							table:function() {
								return "';  echo $this->_tpl_vars['PRJ_DB_PREFIX'];  echo '_organization_master";
							}
					}
			}
		}/*,
		"Data[vEmail]": {
				remote:{
					  url:SITE_URL+"index.php?file=or-aj_chkdupdata",
					  type:"get",
					  data:{
							 val:function() {
								return $("#iOrganizationID").val();
							},
							id:function() {
								return "iOrganizationID";
							},
							field:function() {
								return "vEmail";
							},
							table:function() {
								return "';  echo $this->_tpl_vars['PRJ_DB_PREFIX'];  echo '_organization_master";
							}
					}
			}
		}*/
	},
   messages:{
      "Data[vCompanyRegNo]": {
			remote: jQuery.validator.format(LBL_COMPANY_REG_NO)
		},
		"Data[vCompanyName]": {
			remote: jQuery.validator.format(LBL_COMPANY_NAME)
		},
                "Data[vCompCode]": {
                        alphaNum : LBL_ONLY_APLHA_NUM,
                    	remote: jQuery.validator.format(LBL_COMP_CODE_TAKEN)
                },
		"Data[vEmail]": {
			required: LBL_EMAIL_ADDRESS,
			email: LBL_VALID_EMAIL_ADDRESS,
			remote: jQuery.validator.format(LBL_EMAIL_TAKEN)
		},
		"Data[vZipcode]": {required: LBL_ZIPCODE},

          "Data[eOrganizationType]": {required: LBL_ORGANIZATION_TYPE},
          "Data[eCreateMethodAllowed]": {required: CRETE_METHO_ALLOWED},
          "Data[eCreateVerification]": {required:LBL_VERIFICATION}
	}
});
function fillCountryCode()
{
	// var opt = obj.options[obj.selectedIndex];
	var currency = $(\'#vCountry option:selected\').attr(\'currency\'); 	// opt.getAttribute("currency");
	$(\'input.countryCode\').val($(\'#vCountry option:selected\').attr(\'title\')); 	// opt.title
	$(\'#vAccount1Currency option[id="\'+currency+\'_1"]\').attr("selected","selected");
	$(\'#vAccount2Currency option[id="\'+currency+\'_2"]\').attr("selected","selected");
}
jQuery.validator.addMethod("alphaNum", function(value, element) {
   regex=/^[0-9A-Za-z]+$/
   if(! regex.test(value)) { return false; }
	else { return true; }
}, "Message");

$(document).ready(function()
{
	getRelativeCombo($(\'#vCountry\').val(),\'';  echo $this->_tpl_vars['arr'][0]['vState'];  echo '\',\'vState\',\'-- Select State --\', stateArr);
	// setTimeout("getRelativeCombo(\'"+$(\'#vCountry\').val()+"\',\'"+\'';  echo $this->_tpl_vars['vdata']['vState'];  echo '\'+"\',\'vState\',\'-- "+\'';  echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_STATE'];  echo '\'+" --\', stateArr);", 100);
	$(\'#vCountry\').change(function() {
		setTimeout("getRelativeCombo(\'"+$(this).val()+"\',\'\',\'vState\',\'-- "+\'';  echo $this->_tpl_vars['LBL_SELECT_STATE'];  echo '\'+" --\',stateArr); fillCountryCode();",100);
		setTimeout("$(\'#frmadd\').validate().element(\'#vCompanyRegNo\');",1000);
	});
	function fillbankdtls() {
		var url = SITE_URL+"index.php?file=or-aj_fillbankdtls";
		var pars = "&bankid="+$(\'#iBankId\').val()+"&flds=vSwiftCode&tflds=vBankCode";
		$.ajax({type:"get", url:url, data:pars, success:function(resp) {
				$(\'.ajscript\').attr(\'innerHTML\',\'\');
				$(\'.ajscript\').append(resp);
			}
		});
	}
	$(\'#iBankId\').change(fillbankdtls);
	// if($(\'#view\').val().toLowerCase() == \'add\' || $.trim($(\'#view\').val()) == \'\') {
		fillbankdtls();
	// }
});
</script>
'; ?>

<?php if ($this->_tpl_vars['msg'] != ''):  echo '
<script type="text/javascript" async="async">
$(document).ready(function() {
	var vldmsg = \'';  echo $this->_tpl_vars['vldmsg'];  echo '\';
	var msg=\'';  echo $this->_tpl_vars['msg'];  echo '\';
	 //alert($(\'#vldms\').val());
   if(msg!= \'\' && msg != undefined && $(\'#vldms\').val()!=msg) {
	    alert(msg);
		$(\'#vldms\').val(msg);
   }
});
</script>
'; ?>

<?php endif; ?>