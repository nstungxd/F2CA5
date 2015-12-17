<?php /* Smarty version 2.6.0, created on 2015-06-22 18:34:38
         compiled from member/user/createorganizationuser.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'trim', 'member/user/createorganizationuser.tpl', 78, false),array('function', 'assign', 'member/user/createorganizationuser.tpl', 222, false),)), $this); ?>
<?php echo '
<script type="text/javascript">
	var stateArr = new Array(';  echo $this->_tpl_vars['stateArr'];  echo ');
   var groupArr = new Array(';  echo $this->_tpl_vars['groupArr'];  echo ');
   //alert(stateArr);
</script>
'; ?>

<div class="middle-container">
<h1><?php echo $this->_tpl_vars['LBL_CREATE']; ?>
 <?php echo $this->_tpl_vars['LBL_USER']; ?>
</h1>
<div class="middle-containt">
   <div class="statistics-main-box-white">
      <div>
         <ul id="inner-tab">
			   <li><a class="current"><em><?php echo $this->_tpl_vars['LBL_ORGANIZATION']; ?>
 <?php echo $this->_tpl_vars['LBL_USER']; ?>
</EM></a></li>
				<?php if (( $this->_tpl_vars['view'] == 'edit' && $this->_tpl_vars['userData']['eUserType'] == 'User' ) || $GLOBALS['HTTP_SESSION_VARS']['from'] == 'usr'): ?>
				<li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
edituserrights/<?php echo $this->_tpl_vars['userData']['iUserID']; ?>
" class="<?php if ($this->_tpl_vars['file'] == 'u-userrights'): ?>current<?php endif; ?>"><EM><?php echo $this->_tpl_vars['LBL_ORG_USER_ACCESS_RIGHTS']; ?>
</EM></a></li>
				<?php endif; ?>
         </ul>
      </div>
      <div class="clear"></div>
      <div class="inner-gray-bg">
         <div>&nbsp;</div>
         <div>
              <?php if ($this->_tpl_vars['msg'] != ''): ?>
                                                  <?php endif; ?>
            <form name="frmadd" id="frmadd" action="<?php echo $this->_tpl_vars['SITE_URL']; ?>
index.php?file=u-createorganizationuser_a"  method="post">
               <input type="hidden" name="iUserID" id="iUserID"value="<?php echo $this->_tpl_vars['iUserID']; ?>
" />
               <?php if ($this->_tpl_vars['userData']['iOrganizationID'] != ''): ?>
                    <input type="hidden" name="iOrgId" id="iOrgId" value="<?php echo $this->_tpl_vars['userData']['iOrganizationID']; ?>
" />
               <?php endif; ?>
               <input type="hidden" name="view" id="view" value="<?php echo $this->_tpl_vars['view']; ?>
" />
               <table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
              <?php if ($this->_tpl_vars['usertype'] == 'securitymanager' && $this->_tpl_vars['userData']['iOrganizationID'] == ''): ?>
               <tr>
                   <td><?php echo $this->_tpl_vars['LBL_FILTRE_ORG_BY']; ?>
</td>
                    <td>:</td>
                   <td colspan="" align="" height="20" style="padding-left: 4px;">
									Company Reg No &nbsp;
                           Organization Code &nbsp;
                           Organization name &nbsp;
								 </td>
							  </tr>
                 <tr>
                     <td>&nbsp;</td>
                      <td>&nbsp;</td>
                     <td colspan="3" height="30" valign="top">
									<input type="text" style="width: 100px; vertical-align: middle;" id="regno" class="input-rag" value="" name="regno"> &nbsp;
									<input type="text" style="width: 100px; vertical-align: middle;" id="orgcode" class="input-rag valid" value="" name="orgcode"> &nbsp;
									<input type="text" style="width: 100px; vertical-align: middle;" id="orgname" class="input-rag" value="" name="orgname">
									<img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-search.gif" alt="" border="0" style="cursor: pointer;vertical-align:middle;background: #f8f8f8;border:none;" onclick="getOrgCombo();" />
								 </td>
							  </tr>
                <tr>
                  <td><?php echo $this->_tpl_vars['LBL_ORGANIZATION']; ?>
&nbsp;<font class="reqmsg">*</font></td>
                  <td>:</td>
                  <td>
																					<div id="OrgCombo">
								<select name="Data[iOrganizationID]" id="iOrganizationID" class="required" title="<?php echo $this->_tpl_vars['MSG_SELECT_ORGANIZATION']; ?>
" onchange="return fillCompData(this.options[this.selectedIndex].value);" >
									 <option value=''>---<?php echo $this->_tpl_vars['MSG_SELECT_ORGANIZATION']; ?>
---</option>
									 <?php if (((is_array($_tmp=$this->_tpl_vars['orgdetails'][0]['vCompanyName'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) != ''): ?>
									 <option value="<?php echo $this->_tpl_vars['orgdetails'][0]['iOrganizationID']; ?>
" selected="selected"><?php echo $this->_tpl_vars['orgdetails'][0]['vCompanyName']; ?>
</option>
									 <?php endif; ?>
								</select> (<?php echo $this->_tpl_vars['LBL_SEARCH_TO_FILL_ORG']; ?>
)
							</div>
						</td>
            </tr>
          <?php else: ?>
              <tr>
                  <td><?php echo $this->_tpl_vars['LBL_ORGANIZATION']; ?>
&nbsp;<font class="reqmsg"></font></td>
                  <td>:</td>
                  <td>
						  	<input type="hidden" name="Data[iOrganizationID]" id="iOrganizationID" value="<?php echo $this->_tpl_vars['orgdetails'][0]['iOrganizationID']; ?>
" title="<?php echo $this->_tpl_vars['MSG_SELECT_ORGANIZATION']; ?>
"/>
							<input type="text" name="vOrg" readonly="readonly" id="vOrg" value="<?php echo $this->_tpl_vars['orgdetails'][0]['vCompanyName']; ?>
" class="input-rag" title="<?php echo $this->_tpl_vars['MSG_SELECT_ORGANIZATION']; ?>
" />
                  </td>
              </tr>
					<?php endif; ?>
               <tr>
                  <td><?php echo $this->_tpl_vars['LBL_USER_TYPE']; ?>
&nbsp; </td>
                  <td>:</td>
                  <td><?php echo $this->_tpl_vars['userTypes']; ?>

                  <!-- <input type="text" name="Data[iSecretQuestion1ID]" class="input-rag required " title="Enter Secret QuestionId" id="iSecretQuestion1ID" style="width:228px;" /></td>-->
               </tr>

               <tr>
                  <td width="205"><?php echo $this->_tpl_vars['LBL_FIRST_NAME']; ?>
&nbsp;<font class="reqmsg">*</font> </td>
                  <td>:</td>
                  <td><input type="text" name="Data[vFirstName]" class="input-rag required" onkeypress="return chkValidChar(event);" title="<?php echo $this->_tpl_vars['LBL_ENTER_FIRST_NAME']; ?>
" id="vFirstname" style="width:228px;" value="<?php echo $this->_tpl_vars['userData']['vFirstName']; ?>
"/></td>
               </tr>
               <tr>
                  <td><?php echo $this->_tpl_vars['LBL_LAST_NAME']; ?>
&nbsp;<font class="reqmsg">*</font> </td>
                  <td>:</td>
                  <td><input value="<?php echo $this->_tpl_vars['userData']['vLastName']; ?>
" type="text" name="Data[vLastName]" class="input-rag required" onkeypress="return chkValidChar(event);"  title="<?php echo $this->_tpl_vars['LBL_ENTER_LAST_NAME']; ?>
" id="vLastName" style="width:228px;" /></td>
               </tr>
               <tr>
                  <td>Salutation </td>
                  <td>:</td>
                  <td>
							<?php echo $this->_tpl_vars['salutation']; ?>

													</td>
               </tr>
					<tr>
                  <td><?php echo $this->_tpl_vars['LBL_USER_NAME']; ?>
 <font class="reqmsg">*</font></td>
                  <td>:</td>
                  <td><input type="text" name="Data[vUserName]"  value="<?php echo $this->_tpl_vars['userData']['vUserName']; ?>
" class="input-rag required" id="vUserName" title="<?php echo $this->_tpl_vars['LBL_ENTER_USER_NAME']; ?>
" style="width:228px;" onkeypress="return chkalphanum(event);" /></td>
               </tr>
               <tr>
                  <td><?php echo $this->_tpl_vars['LBL_PASSWORD']; ?>
&nbsp;<font class="reqmsg">*</font> </td>
                  <td>:</td>
                  <td>
							<input type="password" name="Data[vPassword]"  value="<?php echo $this->_tpl_vars['generalobj']->decrypt($this->_tpl_vars['userData']['vPassword']); ?>
" class="input-rag required" id="vPassword" title="<?php echo $this->_tpl_vars['LBL_ENTER_PASSWORD']; ?>
" style="width:228px;" minlength="5" />
							<span class="" style="position:absolute; font-size:10px; margin-left:10px;"><?php echo $this->_tpl_vars['LBL_PASSWORD_STRENGTH']; ?>
<span id="pst"></span><div id="psi" class="is0" style=""></div></span>
							<div htmlfor="vPassword" generated="true" class="err" style="padding-left:0px;"></div>
						</td>
               </tr>
					<tr>
                  <td><?php echo $this->_tpl_vars['LBL_CONFIRM_PASSWORD']; ?>
&nbsp;<font class="reqmsg">*</font> </td>
                  <td>:</td>
                  <td><input type="password" name="cPassword"  value="<?php echo $this->_tpl_vars['generalobj']->decrypt($this->_tpl_vars['userData']['vPassword']); ?>
" class="input-rag required" id="cPassword" equalTo="#vPassword" title="<?php echo $this->_tpl_vars['LBL_ENTER_PASSWORD']; ?>
" style="width:228px;" minlength="5" /></td>
               </tr>
               <tr>
                  <td> <?php echo $this->_tpl_vars['LBL_ADDR_LINE']; ?>
 1&nbsp;<font class="reqmsg">*</font> </td>
                  <td>:</td>
                  <td><input type="text" value="<?php echo $this->_tpl_vars['userData']['vAddressLine1']; ?>
" name="Data[vAddressLine1]" class="input-rag required" title="Enter Address Line1" id="vAddressLine1" style="width:228px;" /></td>
               </tr>
               <tr>
                  <td><?php echo $this->_tpl_vars['LBL_ADDR_LINE']; ?>
 2 </td>
                  <td>:</td>
                  <td><input type="text" name="Data[vAddressLine2]"  value="<?php if ($this->_tpl_vars['userData']['vAddressLine2'] != ''):  echo $this->_tpl_vars['userData']['vAddressLine2'];  else:  echo $this->_tpl_vars['orgdetails'][0]['vAddressLine2'];  endif; ?>" class="input-rag" id="vAddressLine2" style="width:228px;" /></td>
               </tr>
               <tr>
                  <td> <?php echo $this->_tpl_vars['LBL_ADDR_LINE']; ?>
 3 </td>
                  <td>:</td>
                  <td><input type="text" name="Data[vAddressLine3]" class="input-rag"  value="<?php if ($this->_tpl_vars['userData']['vAddressLine3'] != ''):  echo $this->_tpl_vars['userData']['vAddressLine3'];  else:  echo $this->_tpl_vars['orgdetails'][0]['vAddressLine3'];  endif; ?>" id="vAddressLine3" style="width:228px;" /></td>
               </tr>
               <tr>
                    <td><?php echo $this->_tpl_vars['LBL_COUNTRY']; ?>
&nbsp;<font class="reqmsg">*</font> </td>
                    <td>:</td>
                    <td>
                         <select name ="Data[vCountry]" id="vCountry" class="required"   title="Select Country" style="width:218px" onchange="getRelativeCombo(this.value,'','vState','-- Select State --',stateArr);fillCountryCode(this);">
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
                                   <option title="<?php if ($this->_tpl_vars['db_country'][$this->_sections['i']['index']]['iCountryISD'] > 0):  echo $this->_tpl_vars['db_country'][$this->_sections['i']['index']]['iCountryISD'];  endif; ?>" value="<?php echo $this->_tpl_vars['db_country'][$this->_sections['i']['index']]['vCountryCode']; ?>
" <?php if ($this->_tpl_vars['userData']['vCountry'] == $this->_tpl_vars['db_country'][$this->_sections['i']['index']]['vCountryCode']): ?> selected <?php endif; ?> ><?php echo $this->_tpl_vars['db_country'][$this->_sections['i']['index']]['vCountry']; ?>
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
                         <input type="hidden" name="selstate" id="selstate" value="<?php echo $this->_tpl_vars['userData']['vState']; ?>
">
                         <select name ="Data[vState]" id="vState" style="width:218px" class="required" title="Select State">
                                <option value="">Select State</option>
                        </select>
                    </td>
               </tr>

               <tr>
                  <td><?php echo $this->_tpl_vars['LBL_CITY']; ?>
&nbsp;<font class="reqmsg">*</font> </td>
                  <td>:</td>
                  <td><input type="text" name="Data[vCity]" value="<?php echo $this->_tpl_vars['userData']['vCity']; ?>
"  class="input-rag required" onkeypress='return chkValidChar(event);' title="Enter City" id="vCity" style="width:228px;" /></td>
               </tr>
               <tr>
                  <td><?php echo $this->_tpl_vars['LBL_ZIP_CODE']; ?>
&nbsp;<font class="reqmsg">*</font> </td>
                  <td>:</td>
                  <td><input type="text" name="Data[vZipCode]" value="<?php echo $this->_tpl_vars['userData']['vZipCode']; ?>
"  class="input-rag required" title="<?php echo $this->_tpl_vars['LBL_ZIPCODE']; ?>
" onkeypress="return chkDigitZipcode(event)" id="vZipCode" style="width:107px;" /></td>
               </tr>
               <tr>
                  <td><?php echo $this->_tpl_vars['LBL_PHONE']; ?>
 </td>
                  <td>:</td>
                  <td> <input type="text" name="vPhoneCode"  value="<?php echo $this->_tpl_vars['userData']['vPhoneCode']; ?>
" class="countryCode input-rag" id="vPhoneCode" style="width:30px;" maxlength="3" onkeypress="return chkValidPhone(event)" />
                       <input type="text" name="Data[vPhone]"  value="<?php echo $this->_tpl_vars['userData']['vPhone']; ?>
" class="input-rag" id="vPhone" onkeypress="return chkValidPhone(event)" style="width:190px;" maxlength="15" />
                  </td>
               </tr>
               <tr>
                  <td><?php echo $this->_tpl_vars['LBL_EXTENTION']; ?>
 </td>
                  <td>:</td>
                  <td><input type="text" name="Data[vExtention]" value="<?php echo $this->_tpl_vars['userData']['vExtention']; ?>
"  class="input-rag" id="vExtention" style="width:107px;" /></td>
               </tr>
               <tr>
                  <td><?php echo $this->_tpl_vars['LBL_MOBILE']; ?>
 </td>
                  <td>:</td>
                  <td>
                       <input type="text" name="vMobileCode" class="countryCode input-rag"  value="<?php echo $this->_tpl_vars['userData']['vMobileCode']; ?>
" id="vMobileCode" style="width:30px;" onkeypress="return chkValidPhone(event)" maxlength="3" />
                       <input type="text" name="Data[vMobile]" class="input-rag"  value="<?php echo $this->_tpl_vars['userData']['vMobile']; ?>
" id="vMobile" style="width:190px;" onkeypress="return chkValidPhone(event)" maxlength="15" />
                  </td>
               </tr>
               <tr>
                  <td><?php echo $this->_tpl_vars['LBL_EMAIL']; ?>
&nbsp;<font class="reqmsg">*</font> </td>
                  <td>:</td>
                  <td><input type="text" name="Data[vEmail]"  value="<?php echo $this->_tpl_vars['userData']['vEmail']; ?>
" class="input-rag required email" title="Enter Email Address"onkeypress='return chkSpace(event);' id="vEmail" style="width:228px;" /></td>
               </tr>
               <tr>
                  <td><?php echo $this->_tpl_vars['LBL_SEC_QUESTION']; ?>
1&nbsp;<font class="reqmsg">*</font></td>
                  <td>:</td>
                  <td><?php echo $this->_tpl_vars['secQuestion1']; ?>

                      <!-- <input type="text" name="Data[iSecretQuestion1ID]" class="input-rag required " title="Enter Secret QuestionId" id="iSecretQuestion1ID" style="width:228px;" /></td>-->
               </tr>
               <tr>
                  <td><?php echo $this->_tpl_vars['LBL_ANSWER']; ?>
&nbsp;<font class="reqmsg">*</font> </td>
                  <td>:</td>
                  <td>
							<?php if (((is_array($_tmp=$this->_tpl_vars['userData']['vAnswer'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) != '' && $this->_tpl_vars['view'] == 'edit'):  echo smarty_function_assign(array('var' => 'ans1','value' => "##########"), $this);?>

							<input type="text" name="vAnswer" value="<?php echo $this->_tpl_vars['ans1']; ?>
"  class="input-rag required" title="<?php echo $this->_tpl_vars['LBL_ENTER_ANSWER']; ?>
" id="vAnswer" style="width:228px;"  readonly="readonly" />
							<a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
changesecans/1/<?php echo $this->_tpl_vars['userData']['iUserID']; ?>
" class="colorbox" onmouseover="CallColoerBox(this.href,'500','300','file');"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/icon-pen.gif" onclick="" title="<?php echo $this->_tpl_vars['LBL_EDIT_ANS']; ?>
" /></a>
							<?php else: ?>
							<input type="text" name="Data[vAnswer]" value=""  class="input-rag required" title="<?php echo $this->_tpl_vars['LBL_ENTER_ANSWER']; ?>
" id="vAnswer" style="width:228px;" />
							<?php endif; ?>
						</td>
               </tr>
               <tr>
                  <td><?php echo $this->_tpl_vars['LBL_SEC_QUESTION']; ?>
2 </td>
                  <td>:</td>
                  <td>
                    <?php echo $this->_tpl_vars['secQuestion2']; ?>

                    <!--<input type="text" name="Data[iSecretQuestion2ID]" class="input-rag" id="textfield18" style="width:228px;" /> -->
                  </td>
               </tr>
               <tr>
                  <td><?php echo $this->_tpl_vars['LBL_ANSWER']; ?>
 </td>
                  <td>:</td>
                  <td>
							<?php if (((is_array($_tmp=$this->_tpl_vars['userData']['vAnwser'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) != '' && $this->_tpl_vars['view'] == 'edit'):  echo smarty_function_assign(array('var' => 'ans2','value' => "##########"), $this);?>

							<input type="text" name="vAnwser"  value="<?php echo $this->_tpl_vars['ans2']; ?>
" class="input-rag" id="vAnwser" style="width:228px;" title="<?php echo $this->_tpl_vars['LBL_ENTER_ANSWER']; ?>
"  readonly="readonly" />
							<?php if ($this->_tpl_vars['userData']['iSecretQuestion2ID'] > 0): ?><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
changesecans/2/<?php echo $this->_tpl_vars['userData']['iUserID']; ?>
" class="colorbox" onmouseover="CallColoerBox(this.href,'500','300','file');"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/icon-pen.gif" onclick="" title="<?php echo $this->_tpl_vars['LBL_EDIT_ANS']; ?>
" /></a><?php endif; ?>
							<?php else: ?>
							<input type="text" name="Data[vAnwser]"  value="" title="<?php echo $this->_tpl_vars['LBL_ENTER_ANSWER']; ?>
" class="input-rag" id="vAnwser" style="width:228px;" />
							<?php endif; ?>
						</td>
               </tr>
               <tr id="trPermission">
                  <td><?php echo $this->_tpl_vars['LBL_PER_TYPE']; ?>
 </td>
                  <td>:</td>
                  <td>
							<input type="radio" name="Data[ePermissionType]" <?php if ($this->_tpl_vars['userData']['ePermissionType'] == 'Individual'): ?>checked="checked"<?php endif; ?> id="ePermissionType1" value="Individual" onclick="showHideGroup('')" class="radib-btn " style="vertical-align:sub;" />&nbsp;
                     <?php echo $this->_tpl_vars['LBL_INDIVIDUAL']; ?>
 &nbsp;
                     <input type="radio" class="radib-btn" name="Data[ePermissionType]" <?php if ($this->_tpl_vars['userData']['ePermissionType'] == 'Group'): ?>checked="checked"<?php endif; ?> id="ePermissionType2" value="Group"  onclick="return grpclk();"  style="vertical-align:sub;" />
							&nbsp;<?php echo $this->_tpl_vars['LBL_GROUP']; ?>

						</td>
               </tr>
               <tr id="trGroupList">
                    <td valign="top"><?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_GROUP']; ?>
 </td>
                    <td>:</td>
                  <td>
                     <select name="Data[iGroupID]" id="iGroupID"  value="<?php echo $this->_tpl_vars['userData']['iGroupID']; ?>
" title="<?php echo $this->_tpl_vars['LBL_SELECT_GROUP']; ?>
" style="width:200px" ></select>
                  </td>
               </tr>
               <tr>
                    <td><?php echo $this->_tpl_vars['LBL_ONLINE_EMAIL_NOTIFICATION']; ?>
&nbsp;<font class="reqmsg"></font> </td>
                    <td>:</td>
                    <td>
                                           <input type="checkbox"  id="eEmailNotification" value="Yes" name="Data[eEmailNotification]" <?php if ($this->_tpl_vars['userData']['eEmailNotification'] == 'Yes'): ?>checked="checked"<?php endif; ?> />
                    </td>
               </tr>
               <tr>
                    <td><?php echo $this->_tpl_vars['LBL_DEFAULT_LANGUAGE']; ?>
&nbsp;<font class="reqmsg"></font> </td>
                    <td>:</td>
                    <td>
                         <select name="Data[vDefaltLan]" >
                               <?php if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['res']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                               <option <?php if ($this->_tpl_vars['userData']['vDefaltLan'] == $this->_tpl_vars['res'][$this->_sections['i']['index']]['vLanguageCode']): ?> selected <?php endif; ?> value="<?php echo $this->_tpl_vars['res'][$this->_sections['i']['index']]['vLanguageCode']; ?>
"><?php echo $this->_tpl_vars['res'][$this->_sections['i']['index']]['vLanguage']; ?>
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
                  <td colspan="2" >
                       <input type="hidden" name="dpr" id="dpr" value="nod" />
                       <img id="btnSubmit" name="Submit" title="submit" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-submit.gif" alt="" onclick="return submitform();" style="background: #f8f8f8;cursor:pointer; vertical-align:middle;border:none;"  /> &nbsp;
                       <img  src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-reset.gif" alt="" style="background: #f8f8f8;cursor: pointer;border:none; vertical-align:middle;" onclick="resetform();return false;"/> &nbsp;
                       <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-cancel.gif" alt=""  style="background: #f8f8f8;cursor: pointer;border:none; vertical-align:middle;" <?php if ($this->_tpl_vars['view'] == 'edit'): ?>onClick="window.location=SITE_URL+'index.php?file=u-organizationuserlist';"<?php else: ?>onClick="window.location=SITE_URL+'index.php?file=u-organizationuser';"<?php endif; ?>/>
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
<input type="hidden" id="vldms" name="vldms" style="display:none;" value=""/>
</div>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['S_JQUERY']; ?>
jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['S_JQUERY']; ?>
jquery.passwordstrength.js"></script>
<!---->
<?php echo '
<script type="text/javascript" async="async">
var id = \'';  echo $this->_tpl_vars['orgdetails'][0]['iOrganizationID'];  echo '\';
// fillCompData(id);
var permitType = \'';  echo $this->_tpl_vars['userData']['ePermissionType'];  echo '\';
$(\'#trGroupList\').hide();
showHidePermission("';  echo $this->_tpl_vars['userData']['eUserType'];  echo '")
/*
function orgchng() {
     if($("#vOrg").val() != \'\' && $("#ePermissionType2").is(\':checked\')) {
          showHideGroup(\'Group\');
     }
     //getRelativeCombo($(\'#iOrganizationID\').val(),"';  echo $this->_tpl_vars['userData']['iGroupID'];  echo '",\'iGroupID\',\'-- Select Group --\',groupArr);

}*/

function fillCompData(id)
{
   if(id == \'\' || id == undefined)
		return ;
    //alert(id);return false;
	var totValID = id;
   var fields="all";
   var url = SITE_URL+"index.php?file=or-aj_getDetailsComp";
   var pars = "&table="+PRJ_DB_PREFIX+"_organization_master&id="+totValID+"&jtbl=&fields="+fields;
   //alert(url+pars); return false;
	$.post(url, pars, function(resp) {
		$(\'#spn\').html(\'\');
		$(\'#spn\').append(resp);
		$(document).ready(function() {
			getRelativeCombo($(\'#vCountry\').val(),"';  echo $this->_tpl_vars['userData']['vState'];  echo '",\'vState\',\'-- Select State --\',stateArr);
		});
	});
	/*$(\'#spn\').load(url+pars, function() {
		$(document).ready(function() {
			getRelativeCombo($(\'#vCountry\').val(),"';  echo $this->_tpl_vars['userData']['vState'];  echo '",\'vState\',\'-- Select State --\',stateArr);
		});
	});*/
}
function getOrgCombo() {
   // if($(\'#iUserID\').val() == \'\') {
       // alert("Please select a buyer organization");return false;
   // }
    if($(\'#regno\').val() == \'\' && $(\'#orgcode\').val() == \'\' && $(\'#orgname\').val() == \'\') {
        alert(LBL_ENTER_COMP_REG_CODE_NAME);return false;
    }

   $(\'#OrgCombo\').load(SITE_URL+"index.php?file=or-aj_getOrgCombo&iUserID="+$(\'#iUserID\').val()+"&orgname="+escape($(\'#orgname\').val())+"&orgcode="+escape($(\'#orgcode\').val())+"&regno="+escape($(\'#regno\').val()));
}
function submitform()
{
	var vldfrm = $(\'#frmadd\').valid();
	if(!vldfrm) {
		return false;
	}
   var email = $(\'#vEmail\').val();
	pars = "&id=iUserID"+"&iUserID="+$(\'#iUserID\').val()+"&flds=vEmail"+"&vEmail="+$(\'#vEmail\').val()+"&table=';  echo $this->_tpl_vars['PRJ_DB_PREFIX'];  echo '_organization_user";
	$.post(SITE_URL+"index.php?file=m-aj_chkdupdata", pars, function(resp)
	{
		if(resp == \'dup\') {
			/*var vldfrm = $(\'#frmadd\').valid();
			if(!vldfrm) {
				return false;
			}*/
			var ans = confirm(LBL_EMAIL_TAKEN+LBL_SURE_TO_PROCEED);
			if(ans) {
				$(\'#dpr\').val(\'dpl\');
				// $(\'#emlval\').val(email);
				// alert(\'yes\');
				$(\'#frmadd\').submit();
			}
		} else if(resp == \'nodup\') {
			$(\'#dpr\').val(\'nod\');
			// alert(\'ndp\');
			/*var vldfrm = $(\'#frmadd\').valid();
			if(!vldfrm) {
				return false;
			}*/
			$(\'#frmadd\')[0].submit();
			$(document).ready( function() {
				$(function() {
					var ead=90;
					$(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:\'div.middle-container\', eladd:ead});
				});
			});
		}
	});
	$(document).ready( function() {
		$(function() {
			var ead=90;
			$(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:\'div.middle-container\', eladd:ead});
		});
	});
	return false;
}
function resetform()
{
	$(\'#frmadd\')[0].reset();
   getRelativeCombo($(\'#vCountry\').val(),"';  echo $this->_tpl_vars['userData'][0]['vState'];  echo '",\'vState\',\'-- Select State --\',stateArr);
}

function grpclk()
{
     if($("#vOrg").val() == \'\') {
         alert("Select Organization First");
         $(\'#ePermissionType1\').attr("checked",true);
         return false;
     } else {
         showHideGroup(\'Group\');
     }
}

function showHideGroup(val)
{
	if(val == \'Group\') {
		getRelativeCombo($(\'#iOrganizationID\').val(),"';  echo $this->_tpl_vars['userData']['iGroupID'];  echo '",\'iGroupID\',\'-- Select Group --\',groupArr);
		if($(\'#iGroupID option\').length<2) {
			alert("No Group Available");
			$(\'#ePermissionType1\').attr(\'checked\',\'checked\');
		}
		$(\'#trGroupList\').show();
		// $(\'#iGroupID\').addClass(\'required\');
	} else {
		// $(\'#iGroupID\').removeClass(\'required\');
		$(\'#trGroupList\').hide();
	}
}
function showHidePermission(val)
{
	if(val == \'Admin\')
	{
		  $(\'#trPermission\').hide();
		  $(\'#trGroupList\').hide();
	}
	else
	{
		  $(\'#trPermission\').show()
		  $(\'#ePermissionType1\').attr("checked",true);
	}
}
function findOrgValue(li) {
   if( li == null ) return alert("No match!");
   if( !!li.extra ) var sValue = li.extra[0];
	else var sValue = li.selectValue;
   // Coded BY SNEHASIS [TO GET ID OF A DATA]
   var totVal = sValue;
   var totValID;
   var totValRes;

   totVal = totVal.split(\'</span>\');
   totValID = totVal[0].replace("<span style=\'display:none\'>","");
   // totValRes = totVal[1];
   // alert($(\'#iOrganizationID\').val());
   $(\'#iOrganizationID\').val(totValID);
   //alert($(\'#iOrganizationID\').val());
   getRelativeCombo($(\'#iOrganizationID\').val(),"';  echo $this->_tpl_vars['userData']['iGroupID'];  echo '",\'iGroupID\',\'-- Select Group --\',groupArr);
   // $(\'#OrgStatus_Div\').load(SITE_URL+"index.php?file=or-aj_getOrganizationStatus&type=user&iId="+totValID+"");

	var url = SITE_URL+"index.php?file=u-aj_getOrgDetails";
	var pars = "&table="+PRJ_DB_PREFIX+"_organization_master"+"&iId=iOrganizationID"+"&id="+totValID+"&fields=all"+"&jtbl=&where=&js=setusr";
	//alert(url+pars); return false;
	/*$.post(url, pars, function(resp) {
	// $(\'#spn\').load(url+pars, function() {
		$(\'#spn\').html(\'\');
		$(\'#spn\').append(resp);
	});*/
	$(\'#spn\').load(url+pars);
}
function selectOrgItem(li) {
	findOrgValue(li);
}
function formatItem(row) {
   var totVal = row[0];
   var totValID;
   var totValRes;
   totVal = totVal.split(\'</span>\');
   totValID = totVal[0].replace("<span style=\'display:none\'>");
   totValRes = totVal[1];
   return totValRes;
}
$(document).ready(function()
{
	$("#frmadd").validate({
		rules:{
				 "Data[iSecretQuestion2ID]":{required:function(){
						if($.trim($(\'#vAnwser\').val())==\'\')
							  return false;
						}
				 },
				 "Data[vAnwser]":{required:function(){
						if($.trim($(\'#iSecretQuestion2ID\').val())==\'\')
							  return false;
						}
				 }/*,
				 "Data[vUserName]": {
						remote:{
							  url:SITE_URL+"index.php?file=u-aj_chkdupdata",
							  type:"get",
							  data:{
									 val:function() {
										return $("#iUserID").val();
									},
									id:function() {
										return "iUserID";
									},
									field:function() {
										return "vUserName";
									},
									extfld: function() {
										return "iOrganizationID";
									},
									extval: function() {
										return $("#iOrganizationID").val();
									},
									table:function() {
										return "';  echo $this->_tpl_vars['PRJ_DB_PREFIX'];  echo '_organization_user";
									}
								}
						}
					}*/
				 /*,
						"Data[vEmail]": {
						remote:{
								url:SITE_URL+"index.php?file=u-aj_chkdupdata",
							  type:"get",
							  data:{
									val:function() {
										return $("#iUserID").val();
									},
									id:function() {
										return "iUserID";
									},
									field:function() {
										return "vEmail";
									},
									table:function() {
										return "';  echo $this->_tpl_vars['PRJ_DB_PREFIX'];  echo '_organization_user";
									}
							}
					}
				},*/
		},
		messages:{
			"Data[vEmail]": {
				required:  LBL_EMAIL_ADDRESS,
				email: LBL_VALID_EMAIL_ADDRESS,
				remote: jQuery.validator.format(LBL_EMAIL_TAKEN)
			},
			"cPassword": { equalTo: MSG_CON_PASS },
			"Data[vUserName]": {
				required: LBL_ENTER_USER_NAME,
				remote: jQuery.validator.format(LBL_USERNAME_TAKEN)
			},
			"Data[vZip]": {required: LBL_ZIPCODE},
			"Data[vPassword]": { minlength: LBL_FIVE_CHAR_REQUIRED }
		}
	});
	//
	$(\'#vPassword\').passwordStrength({targetElement:\'#psi\', targetTextElement:\'#pst\', psimsg:["';  echo $this->_tpl_vars['LBL_WEAK'];  echo '","';  echo $this->_tpl_vars['LBL_MEDIUM'];  echo '","';  echo $this->_tpl_vars['LBL_STRONG'];  echo '","';  echo $this->_tpl_vars['LBL_VERY_STRONG'];  echo '"]});
	$(\'#vPassword\').trigger(\'blur\');
	getRelativeCombo($(\'#vCountry\').val(),"';  echo $this->_tpl_vars['userData']['vState'];  echo '",\'vState\',\'-- Select State --\',stateArr);
	/*$("#vOrg").autocomplete(
		SITE_URL+"index.php?file=or-aj_getOrganization",
		{
			delay:10,
			minChars:1,
			matchSubset:1,
			matchContains:1,
			cacheLength:10,
         onItemSelect:selectOrgItem,
			onFindValue:findOrgValue,
			formatItem:formatItem,
			autoFill:false
		});*/
      // $(\'#iOrganizationID\').load(SITE_URL+"index.php?file=or-aj_getOrganization"+"&htmlTag=option"+"&isAssoc=no"+"&val=';  echo $this->_tpl_vars['userData']['iOrganizationID'];  echo '");
	if(permitType == \'Group\') {
		$(\'#ePermissionType2\').attr(\'checked\',\'checked\');
		getRelativeCombo($(\'#iOrganizationID\').val(),"';  echo $this->_tpl_vars['userData']['iGroupID'];  echo '",\'iGroupID\',\'-- Select Group --\',groupArr);
		showHideGroup(\'Group\');
	}
});
function fillCountryCode(obj)
{
	var opt=obj.options[obj.selectedIndex];
	var currency=opt.getAttribute("currency");
	$(\'input.countryCode\').val(opt.title);
}
</script>
'; ?>


<?php if ($this->_tpl_vars['msg'] != ''): ?>
<?php echo '
<script type="text/javascript">
$(document).ready(function() {
	var vldmsg = \'';  echo $this->_tpl_vars['msg'];  echo '\';
   if(vldmsg!= \'\' && vldmsg != undefined && $(\'#vldms\').val()!=vldmsg) {
	    alert(vldmsg);
		$(\'#vldms\').val(vldmsg);
   }
});
</script>
'; ?>

<?php endif; ?>