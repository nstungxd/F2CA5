<?php /* Smarty version 2.6.0, created on 2015-06-26 13:52:27
         compiled from member/organization/verifyorganization.tpl */ ?>
<div class="middle-container">
<h1><span class=""><?php echo $this->_tpl_vars['LBL_ORG_VRF_LIST']; ?>
</span></h1> <!-- blue-hadd-bg -->
<div class="middle-containt">
<div class="inner-white-bg">
   <div><h2><?php echo $this->_tpl_vars['LBL_SEARCH']; ?>
</h2></div>
   <div class="inport-gray-bg">
        <?php if ($this->_tpl_vars['msg'] != ''): ?>
                                             <?php echo '
                    <script>
                    $(document).ready(function() {
                         var msg=\'';  echo $this->_tpl_vars['msg'];  echo '\';
                         if(msg!= \'\' && msg != undefined)
                         alert(msg);
                    });
                    </script>
                    '; ?>

                    <?php endif; ?>
      <div class="import-border">&nbsp;<?php echo $this->_tpl_vars['LBL_SEARCH']; ?>
 : &nbsp; &nbsp; &nbsp; &nbsp;
         <input type="text" name="search_text" class="input-rag" id="search_text" style="width:190px; vertical-align:middle;" />
         &nbsp; <input type="image" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-go.gif"  alt="" border="0" style="cursor: pointer; vertical-align:middle;border:none;background: #f8f8f8;" onclick="getorglist('all',1)" />
      </div>
      <div  style="padding:5px;">
         <table width="100%" border="0" cellspacing="2" cellpadding="2">
            <tr>
               <td width="17%"><?php echo $this->_tpl_vars['LBL_ORG_NAME']; ?>
  </td>
               <td>:</td>
               <td width="30%"><span class="import-border">
               <input type="text" name="org_name" class="input-rag" id="org_name" style="width:177px; vertical-align:middle;" />
               </span></td>
               <td width="17%"><?php echo $this->_tpl_vars['LBL_ORG_CODE']; ?>
 </td>
               <td>:</td>
               <td width="36%"><span class="import-border">
                  <input type="text" name="org_code" id="org_code" class="input-rag" style="width:177px; vertical-align:middle;" />
               </span></td>
            </tr>
            <tr>
               <td><?php echo $this->_tpl_vars['LBL_ORG_TYPE']; ?>
 </td>
               <td>:</td>
               <td>
						<?php echo $this->_tpl_vars['orgTypes']; ?>

                  <!--<select name="org_type" id="org_type" class="drop-down" style="width:179px;">
                     <option value="">---Select---</option>
                  </select>-->
               </td>
               <td><?php echo $this->_tpl_vars['LBL_COUNTRY']; ?>
 </td>
               <td>:</td>
               <td>
                  <select name="country" id="country" class="drop-down" style="width:179px; vertical-align:middle;">
                     <option value="">---Select---</option>
							<?php if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['countries']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
							<option value="<?php echo $this->_tpl_vars['countries'][$this->_sections['i']['index']]['vCountryCode']; ?>
"><?php echo $this->_tpl_vars['countries'][$this->_sections['i']['index']]['vCountry']; ?>
</option>
							<?php endfor; endif; ?>
                  </select>
                  &nbsp; <input type="image" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-go.gif" alt="" border="0"  style="cursor: pointer; vertical-align:middle;border:none;background: #f8f8f8;" onclick="getorglist('srch',1)" />
               </td>
            </tr>
         </table>
      </div>
   </div>
   <div>
        <div style="height:25px;" align="right">
             <span id="updating" style="display: none; padding-bottom: 7px;"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/progress.gif" alt="" /><a style="vertical-align:top;">Processing</a></span>
             <span id="dispmsg" class="msg"></span></div>
      <div class="light-golden-bor">
         <table width="100%" border="0" class="black" cellspacing="0" cellpadding="0">
            <input type="hidden" name="cursort" id="cursort" value="" />
            <input type="hidden" name="cursorttype" id="cursorttype" value="" />
            <tr>
            <td class="listing-sky-blue">
               <table width="100%" border="0" cellspacing="1" cellpadding="0">
                  <tr>
                    <!--<td width="30" height="26" align="center"><input type="checkbox" class="radib-btn" name="checkbox" id="checkbox" /></td>-->
                    <td width="158" height="26" align=""><a href="javascript:getorglist('all','1','vCompanyName')"><strong>Organization Name</strong></a></td>
                    <td width="119" align="center"><a href="javascript:getorglist('all','1','CAST(vOrganizationCode as SIGNED)')"><strong>Organization Code</strong></a></td>
                    <td width="159" align="center"><a href="javascript:getorglist('all','1','eOrganizationType')"><strong>Organization Type</strong></a></td>
                    <td width="123" align="center"><a href="javascript:getorglist('all','1','cm.vCountry')"><strong>Country</strong></a></td>
                    <td width="62" align="center"><a href="javascript:getorglist('all','1','ou.eStatus')"><strong>Status</strong></a></td>
                    <td width="94" align="center">Action</td>
                  </tr>
               </table>
            </td>
         </tr>
         <tr>
            <td>
					<input type="hidden" name="mod" id="mod" value="" />
					<div id="orglist"><input type="hidden" name="pg" id="pg" value="1"/></div>
            </td>
         </tr>
      </table>
      </div>
   </div>
   </div>
</div>
</div>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['SITE_JS_AJAX']; ?>
jverifyorglist.js"></script>