<?php /* Smarty version 2.6.0, created on 2015-06-20 22:22:37
         compiled from member/orgregister.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'htmlentities', 'member/orgregister.tpl', 156, false),)), $this); ?>
<?php echo '
<script type="text/javascript">
	var stateArr = new Array(';  echo $this->_tpl_vars['stateArr'];  echo ');
</script>
'; ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
		<div class="security-bg" style="width:100%;">
			<div class="organization" style="">
				<div><a style="">&nbsp;<img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
icon-admini.png" />&nbsp; <?php echo $this->_tpl_vars['LBL_REGISTER_ORGANIZATION']; ?>
</a></div>
				<div id="msg" class="msg err" align="center"></div>
				<div id="forgreg" style="padding-left:59px;" align="left">
					<form name="frmorgreg" id="frmorgreg" method="post" action="">
						<div>
							<span class="username" style="display:inline-block; width:250px;"><?php echo $this->_tpl_vars['LBL_USER_NAME']; ?>
 * :  </span>
							<input type="text" id="vUserName" name="vUserName" class="required" style="width:390px; height:21px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_USER_NAME']; ?>
" onkeypress="return chkalphanum(event);" value="<?php echo $this->_tpl_vars['vdata']['vUserName']; ?>
" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;"><?php echo $this->_tpl_vars['LBL_PASSWORD']; ?>
 * :  </span>
							<input type="password" id="vPassword" name="vPassword" class="required" style="width:390px; height:21px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_PASSWORD']; ?>
" onkeypress="// return chkalphanum(event);" minlength="5" />
							<span class="" style="position:absolute; font-size:10px; margin-left:10px;"><?php echo $this->_tpl_vars['LBL_PASSWORD_STRENGTH']; ?>
<span id="pst"></span><div id="psi" class="is0" style=""></div></span>
							<div htmlfor="vPassword" generated="true" class="err" style="padding-left:0px;"></div>
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;"><?php echo $this->_tpl_vars['LBL_CONFIRM']; ?>
 <?php echo $this->_tpl_vars['LBL_PASSWORD']; ?>
 * :  </span>
							<input type="password" id="vConPassword" name="vConPassword" class="required equalto" equalto="#vPassword" style="width:390px; height:21px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_CONFIRM']; ?>
 <?php echo $this->_tpl_vars['LBL_PASSWORD']; ?>
" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;"><?php echo $this->_tpl_vars['LBL_FIRST_NAME']; ?>
 * :  </span>
							<input type="text" id="vFirstName" name="vFirstName" class="required" style="width:390px; height:21px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_FIRST_NAME']; ?>
" onkeypress="return chkalphanum(event);" value="<?php echo $this->_tpl_vars['vdata']['vFirstName']; ?>
" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;"><?php echo $this->_tpl_vars['LBL_LAST_NAME']; ?>
 * :  </span>
							<input type="text" id="vLastName" name="vLastName" class="required" style="width:390px; height:21px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_LAST_NAME']; ?>
" onkeypress="return chkalphanum(event);" value="<?php echo $this->_tpl_vars['vdata']['vLastName']; ?>
" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;"><?php echo $this->_tpl_vars['LBL_ORGANIZATION']; ?>
 <?php echo $this->_tpl_vars['LBL_NAME']; ?>
 * : </span> 
							<input type="text" id="vCompanyName" name="vCompanyName" class="required" style="width:390px; height:21px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_ORGANIZATION']; ?>
 <?php echo $this->_tpl_vars['LBL_NAME']; ?>
" value="<?php echo $this->_tpl_vars['vdata']['vCompanyName']; ?>
" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;"><?php echo $this->_tpl_vars['LBL_ORGANIZATION']; ?>
 <?php echo $this->_tpl_vars['LBL_TYPE']; ?>
 * : </span> 
							<?php echo $this->_tpl_vars['OrgType']; ?>

						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;"><?php echo $this->_tpl_vars['LBL_COMP_CODE']; ?>
 * : </span> 
							<input type="text" id="vCompCode" name="vCompCode" class="required" style="width:390px; height:21px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_COMP_CODE']; ?>
" onkeypress="return chkalphanum(event);" value="<?php echo $this->_tpl_vars['vdata']['vCompCode']; ?>
" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;"><?php echo $this->_tpl_vars['LBL_COMP_REG_NO']; ?>
 * : </span> 
							<input type="text" id="vCompanyRegNo" name="vCompanyRegNo" class="required" style="width:390px; height:21px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_COMP_REG_NO']; ?>
" onkeypress="// return chkDigitMobcode(event);" value="<?php echo $this->_tpl_vars['vdata']['vCompanyRegNo']; ?>
" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;"><?php echo $this->_tpl_vars['LBL_COMPANY']; ?>
 <?php echo $this->_tpl_vars['LBL_ADDR_LINE']; ?>
 1 * : </span> 
							<input type="text" id="vAddressLine1" name="vAddressLine1" class="required" style="width:390px; height:21px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_COMPANY']; ?>
 <?php echo $this->_tpl_vars['LBL_ADDR_LINE']; ?>
 1" value="<?php echo $this->_tpl_vars['vdata']['vAddressLine1']; ?>
" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;"><?php echo $this->_tpl_vars['LBL_COMPANY']; ?>
 <?php echo $this->_tpl_vars['LBL_ADDR_LINE']; ?>
 2 : </span> 
							<input type="text" id="vAddressLine2" name="vAddressLine2" class="" style="width:390px; height:21px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_COMPANY']; ?>
 <?php echo $this->_tpl_vars['LBL_ADDR_LINE']; ?>
 2" value="<?php echo $this->_tpl_vars['vdata']['vAddressLine2']; ?>
" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;"><?php echo $this->_tpl_vars['LBL_COMPANY']; ?>
 <?php echo $this->_tpl_vars['LBL_ADDR_LINE']; ?>
 3 : </span> 
							<input type="text" id="vAddressLine3" name="vAddressLine3" class="" style="width:390px; height:21px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_COMPANY']; ?>
 <?php echo $this->_tpl_vars['LBL_ADDR_LINE']; ?>
 3" value="<?php echo $this->_tpl_vars['vdata']['vAddressLine3']; ?>
" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;"><?php echo $this->_tpl_vars['LBL_COUNTRY']; ?>
 * : </span> 
							<select name="vCountry" id="vCountry" class="required" title="<?php echo $this->_tpl_vars['LBL_SELECT_COUNTRY']; ?>
">
							<option value=""> --- <?php echo $this->_tpl_vars['LBL_SELECT_COUNTRY']; ?>
 --- </option>
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
" <?php if ($this->_tpl_vars['db_country'][$this->_sections['i']['index']]['vCountryCode'] == $this->_tpl_vars['vdata']['vCountry']): ?>selected='selected'<?php endif; ?>><?php echo $this->_tpl_vars['db_country'][$this->_sections['i']['index']]['vCountry']; ?>
</option>
							<?php endfor; endif; ?>
							</select>
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;"><?php echo $this->_tpl_vars['LBL_STATE']; ?>
 * : </span> 
							<select name="vState" id="vState" class="required" title="<?php echo $this->_tpl_vars['LBL_SELECT_STATE']; ?>
">
								<option value="">--- <?php echo $this->_tpl_vars['LBL_SELECT_STATE']; ?>
 ---</option>
							</select>
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;"><?php echo $this->_tpl_vars['LBL_CITY']; ?>
 * : </span> 
							<input type="text" id="vCity" name="vCity" class="required" style="width:390px; height:21px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_CITY']; ?>
" value="<?php echo $this->_tpl_vars['vdata']['vCity']; ?>
" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;"><?php echo $this->_tpl_vars['LBL_ZIP_CODE']; ?>
 * : </span> 
							<input type="text" id="vZipcode" name="vZipcode" class="required" style="width:390px; height:21px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_ZIP_CODE']; ?>
" onkeypress="return chkDigitMobcode(event);" maxLength="7" value="<?php echo $this->_tpl_vars['vdata']['vZipcode']; ?>
" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;"><?php echo $this->_tpl_vars['LBL_PHONE']; ?>
 * : </span>
							<input type="text" id="vPhoneCode" name="vPhoneCode"  class="countryCode" onkeypress="return chkDigitMobcode(event);" style="width:30px; height:21px;" maxlength="3" title="<?php echo $this->_tpl_vars['LBL_ENTER_PHONECODE']; ?>
" value="<?php echo $this->_tpl_vars['vdata']['vPhoneCode']; ?>
" />
							<input type="text" id="vPhone" name="vPhone" title="<?php echo $this->_tpl_vars['LBL_ENTER_PHONE_NO']; ?>
" onkeypress="return chkDigitMobcode(event);" maxlength="15" style="width:150px; height:21px;" value="<?php echo $this->_tpl_vars['vdata']['vPhone']; ?>
" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;"><?php echo $this->_tpl_vars['LBL_COMPANY']; ?>
 <?php echo $this->_tpl_vars['LBL_EMAIL']; ?>
 * : </span> 
							<input type="text" id="vEmail" name="vEmail" class="required" style="width:390px; height:21px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_COMPANY']; ?>
 <?php echo $this->_tpl_vars['LBL_EMAIL']; ?>
" value="<?php echo $this->_tpl_vars['vdata']['vEmail']; ?>
" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;"><?php echo $this->_tpl_vars['LBL_PERSONAL']; ?>
 <?php echo $this->_tpl_vars['LBL_EMAIL']; ?>
 * : </span> 
							<input type="text" id="vpEmail" name="vpEmail" class="required" style="width:390px; height:21px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_PERSONAL']; ?>
 <?php echo $this->_tpl_vars['LBL_EMAIL']; ?>
" value="<?php echo $this->_tpl_vars['vdata']['vpEmail']; ?>
" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;"><?php echo $this->_tpl_vars['LBL_VAT_ID']; ?>
 * : </span> 
							<input type="text" id="vVatId" name="vVatId" class="" style="width:390px; height:21px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_VAT_ID']; ?>
" value="<?php echo $this->_tpl_vars['vdata']['vVatId']; ?>
" />
						</div>
						
						<div>
							<span class="username" style="display:inline-block; width:250px;"><?php echo $this->_tpl_vars['LBL_SEC_QUESTION']; ?>
 1 * :  </span>
							<?php echo $this->_tpl_vars['secQuestion1']; ?>

						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;"><?php echo $this->_tpl_vars['LBL_ANSWER']; ?>
 * :  </span>
							<input type="text" id="vAnswer" name="vAnswer" class="required" style="width:390px; height:21px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_ANSWER']; ?>
" onkeypress="return chkalphanum(event);" value="<?php echo $this->_tpl_vars['vdata']['vAnswer']; ?>
" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;"><?php echo $this->_tpl_vars['LBL_SEC_QUESTION']; ?>
 2 :  </span>
							<?php echo $this->_tpl_vars['secQuestion2']; ?>

						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;"><?php echo $this->_tpl_vars['LBL_ANSWER']; ?>
 * :  </span>
							<input type="text" id="vAnwser" name="vAnwser" class="required" style="width:390px; height:21px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_ANSWER']; ?>
" onkeypress="return chkalphanum(event);" value="<?php echo $this->_tpl_vars['vdata']['vAnwser']; ?>
" />
						</div>
						
						<div>
							<span class="username" style="display:inline-block; width:250px;"><?php echo $this->_tpl_vars['LBL_BANK']; ?>
 : </span> 
							<select name="iBankId" id="iBankId" class="" title="<?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_BANK']; ?>
">
							<option value="">--- <?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_BANK']; ?>
 ---</option>
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
" <?php if ($this->_tpl_vars['bnk_dtls'][$this->_sections['l']['index']]['iBankId'] == $this->_tpl_vars['vdata']['iBankId']): ?>selected='selected'<?php endif; ?>><?php echo $this->_tpl_vars['bnk_dtls'][$this->_sections['l']['index']]['vBankName']; ?>
</option>
							<?php endfor; endif; ?>
							</select>
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;"><?php echo $this->_tpl_vars['LBL_BANK_CODE']; ?>
 : </span> 
							<input type="text" id="vBankCode" name="vBankCode" class="" style="width:390px; height:21px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_BANK_CODE']; ?>
" value="<?php echo $this->_tpl_vars['vdata']['vBankCode']; ?>
" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;"><?php echo $this->_tpl_vars['LBL_BRANCH']; ?>
: </span> 
							<input type="text" id="vBranchName" name="vBranchName" class="" style="width:390px; height:21px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_BRANCH']; ?>
" value="<?php echo $this->_tpl_vars['vdata']['vBranchName']; ?>
" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;"><?php echo $this->_tpl_vars['LBL_BRANCH_CODE']; ?>
: </span> 
							<input type="text" id="vBranchCode" name="vBranchCode" class="" style="width:390px; height:21px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_BRANCH_CODE']; ?>
" value="<?php echo $this->_tpl_vars['vdata']['vBranchCode']; ?>
" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;"><?php echo $this->_tpl_vars['LBL_ACCOUNT_NUMBER']; ?>
 : </span> 
							<input type="text" id="vAccount1Number" name="vAccount1Number" class="" style="width:390px; height:21px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_ACCOUNT_NUMBER']; ?>
" value="<?php echo $this->_tpl_vars['vdata']['vAccount1Number']; ?>
" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;"><?php echo $this->_tpl_vars['LBL_ACCOUNT_TITLE']; ?>
 : </span> 
							<input type="text" id="vAccount1Title" name="vAccount1Title" class="" style="width:390px; height:21px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_ACCOUNT_TITLE']; ?>
" value="<?php echo $this->_tpl_vars['vdata']['vAccount1Title']; ?>
" />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;"><?php echo $this->_tpl_vars['LBL_ACCOUNT_CURRENCY']; ?>
 : </span>
							<select name="vAccount1Currency" id="vAccount1Currency" class="" title="<?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_ACCOUNT_CURRENCY']; ?>
" >
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
								<option id="<?php echo $this->_tpl_vars['currency'][$this->_sections['c']['index']]['iCurrencyID']; ?>
_1" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['currency'][$this->_sections['c']['index']]['vCode'])) ? $this->_run_mod_handler('htmlentities', true, $_tmp) : htmlentities($_tmp)); ?>
" <?php if ($this->_tpl_vars['vdata']['vAccount1Currency']): ?>selected='selected'<?php endif; ?> ><?php echo $this->_tpl_vars['currency'][$this->_sections['c']['index']]['vCode']; ?>
</option>
							<?php endfor; endif; ?>
						</select>
						</div>
						
						<div>
							<span class="username" style="display:inline-block; width:250px;"><?php echo $this->_tpl_vars['LBL_ONLINE_EMAIL_NOTIFICATION']; ?>
 * :  </span>
							<input type="checkbox" id="eEmailNotification" name="eEmailNotification" class="" style="height:21px;" title="<?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_ONLINE_EMAIL_NOTIFICATION']; ?>
" value="Yes" checked='checked' />
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;"><?php echo $this->_tpl_vars['LBL_DEFAULT_LANGUAGE']; ?>
 * :  </span>
							<select name="vDefaltLan" id="vDefaltLan">
								<?php if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['dlang']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
								<option value="<?php echo $this->_tpl_vars['dlang'][$this->_sections['i']['index']]['vLanguageCode']; ?>
" <?php if ($this->_tpl_vars['dlang'][$this->_sections['i']['index']]['vLanguageCode'] == $this->_tpl_vars['vdata']['vDefaltLan']): ?>selected='selected'<?php endif; ?>><?php echo $this->_tpl_vars['dlang'][$this->_sections['i']['index']]['vLanguage']; ?>
</option>
								<?php endfor; endif; ?>
                     </select>
						</div>
						
						<div>
							<span class="username" style="display:inline-block; width:250px;">&nbsp;</span>
							<div style='margin-left:250px;'><img id='captchaimg' src="" /> &nbsp; <img id='refresh' src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
refresh.jpg" height="39px" /></div>
						</div>
						<div>
							<span class="username" style="display:inline-block; width:250px;"><?php echo $this->_tpl_vars['LBL_SECURITY_CODE']; ?>
 : </span>
							<input type='text' name='scode' id='scode' class='' style='width:150px; height:21px;' title="<?php echo $this->_tpl_vars['LBL_ENTER_SECURITY_CODE']; ?>
" />
						</div>						
						
						<div style="height:10px; line-height:10px;">&nbsp;</div>
						<div class="remember" style="padding-left:250px; margin:10px;">
							<span class="send" style=""> <img id="fpsend" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
btn-send.gif" alt="" border="0" class="valignmidd pointer" onkeypress="return chkEnter(event,'yes','forgotPass()')" /> &nbsp; </span>  &nbsp;
							<span style="display:inline-block; width:30px;"> &nbsp; </span>
						</div>
						<div style="height:15px;">&nbsp;</div>
					</form>
				</div>
			</div>
		</div>
    </td>
  </tr>
</table>
<span class="ajscript"></span>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['S_JQUERY']; ?>
jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['S_JQUERY']; ?>
jquery.passwordstrength.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['SITE_JS_AJAX']; ?>
jorgreg.js"></script>
<?php echo '
<script type="text/javascript">
function fillCountryCode() {
	var currency = $(\'#vCountry option:selected\').attr(\'currency\'); 	// opt.getAttribute("currency");
	$(\'input.countryCode\').val($(\'#vCountry option:selected\').attr(\'title\')); 	// opt.title
	$(\'#vAccount1Currency option[id="\'+currency+\'_1"]\').attr("selected","selected");
}
$(\'document\').ready(function() {
	$(\'#vPassword\').passwordStrength({targetElement:\'#psi\', targetTextElement:\'#pst\', psimsg:["';  echo $this->_tpl_vars['LBL_WEAK'];  echo '","';  echo $this->_tpl_vars['LBL_MEDIUM'];  echo '","';  echo $this->_tpl_vars['LBL_STRONG'];  echo '","';  echo $this->_tpl_vars['LBL_VERY_STRONG'];  echo '"]});
	$(\'#vCountry\').change(function() {
		setTimeout("getRelativeCombo(\'"+$(this).val()+"\',\'\',\'vState\',\'-- "+\'';  echo $this->_tpl_vars['LBL_SELECT_STATE'];  echo '\'+" --\',stateArr); fillCountryCode();",100);
		setTimeout("$(\'#frmorgreg\').validate().element(\'#vCompanyRegNo\');",1000);
	});
	$(\'#eOrganizationType\').change(function() {
		$(\'#frmorgreg\').validate().element(\'#vCompanyRegNo\');
	});
	setTimeout("getRelativeCombo(\'"+$(\'#vCountry\').val()+"\',\'"+\'';  echo $this->_tpl_vars['vdata']['vState'];  echo '\'+"\',\'vState\',\'-- "+\'';  echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_STATE'];  echo '\'+" --\', stateArr);", 10);
	// getRelativeCombo($(\'#vCountry\').val(),\'';  echo $this->_tpl_vars['vdata']['vState'];  echo '\',\'vState\',\'-- ';  echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_STATE'];  echo ' --\', stateArr);
});
</script>
'; ?>