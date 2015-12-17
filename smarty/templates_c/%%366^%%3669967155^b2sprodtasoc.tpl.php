<?php /* Smarty version 2.6.0, created on 2015-06-26 12:17:33
         compiled from member/organization/b2sprodtasoc.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'trim', 'member/organization/b2sprodtasoc.tpl', 9, false),array('modifier', 'stripslashes', 'member/organization/b2sprodtasoc.tpl', 41, false),)), $this); ?>
<div class="middle-container">
<h1><?php echo $this->_tpl_vars['LBL_CREATE_ASSOCIATION']; ?>
</h1>
<div class="middle-containt">
	<div class="statistics-main-box-white">
      <div>
         <ul id="inner-tab"><li><a class="current"><em><?php echo $this->_tpl_vars['LBL_BUYER2_BPRODUCT']; ?>
 <?php echo $this->_tpl_vars['LBL_ASSOCIATION']; ?>
</em></a></li></ul>
      </div>
      <div class="clear"></div>
		<?php if (((is_array($_tmp=$this->_tpl_vars['arr'][0]['tReasonToReject'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) != ''): ?>
			<div class="inner-gray-bg" style="height:690px;"> 		<?php else: ?>
			<div class="inner-gray-bg" style="height:670px;"> 		<?php endif; ?>
		<div>&nbsp;</div>
      <form id="frmadd" name="frmadd" method="post" action="<?php echo $this->_tpl_vars['SITE_URL']; ?>
index.php?file=or-b2sprodtasoc_a">
         <input type="hidden" id="mod" name="mod" value="<?php echo $this->_tpl_vars['mod']; ?>
" />
         <input type="hidden" id="admr" name="admr" value="" />
         <input type="hidden" id="iAssociationId" name="iAssociationId" value="<?php echo $this->_tpl_vars['iAssociationId']; ?>
" />
			<div>
            <span id="prc" style="display:none; float:right;"> <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/progress.gif" /> Processing ... </span>
               <?php if ($this->_tpl_vars['msg'] != ''): ?>
                                               <?php endif; ?>
				<table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
					<?php if ($this->_tpl_vars['uorg_type'] != 'Buyer2'): ?>
					<tr>
						<td><?php echo $this->_tpl_vars['LBL_SEARCH']; ?>
 <?php echo $this->_tpl_vars['LBL_BUYER2']; ?>
 : </td>
						<td>
							<input type="text" class="ttp" id="b2nm" name="b2nm" value="<?php echo $this->_tpl_vars['post_data']['b2nm']; ?>
" class="input-rag" style="width:143px; height:17px; vertical-align:middle;" title="<?php echo $this->_tpl_vars['LBL_NAME']; ?>
" />&nbsp;
							<input type="text" class="ttp" id="b2cd" name="b2cd" value="<?php echo $this->_tpl_vars['post_data']['b2cd']; ?>
" class="input-rag" style="width:143px; height:17px; vertical-align:middle;" title="<?php echo $this->_tpl_vars['LBL_CODE']; ?>
" />&nbsp;
							<span class="btllbl" style="height:17px;"><b onclick="getBuyer2Combo('');"><?php echo $this->_tpl_vars['LBL_SEARCH']; ?>
</b></span>
							&nbsp; [<?php echo ((is_array($_tmp=$this->_tpl_vars['MSG_CAN_USE_WILD_CHAR'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
]
						</td>
					</tr>
					<?php endif; ?>
               <tr>
                  <td width="190px" valign="top"><?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_BUYER2']; ?>
&nbsp;<font class="reqmsg">*</font> : </td>
                  <td>
							<?php if ($this->_tpl_vars['uorg_type'] != 'Buyer2'): ?>
   						<span id="b2org" style="float:left;">
   							<select name="Data[iBuyer2Id]" id="iBuyer2Id" style="width:300px;" class="required" title="<?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_BUYER2']; ?>
" onchange="return ps();">
   								<option value="">---<?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_BUYER2']; ?>
---</option>
                           <?php if ($this->_tpl_vars['arr'][0]['iBuyer2Id'] > 0): ?>
                              <option value="<?php echo $this->_tpl_vars['arr'][0]['iBuyer2Id']; ?>
" selected="selected"><?php echo $this->_tpl_vars['arr'][0]['vBuyer2']; ?>
 (<?php echo $this->_tpl_vars['arr'][0]['vB2Code']; ?>
)</option>
                           <?php endif; ?>
   							</select>
   						</span>
   						<span style="float:right; padding-right:70px;">
								<?php echo $this->_tpl_vars['LBL_FILTER_LIST_BY']; ?>
 : <input type="text" name="b2filter" id="b2filter" style="width:100px;" />
                     </span>
							<?php else: ?>
							<span id="b2org" style="float:left;"><input type="hidden" name="iBuyer2Id" id="iBuyer2Id" style="width:300px;" title="<?php echo $this->_tpl_vars['LBL_BUYER2']; ?>
" value="<?php echo $this->_tpl_vars['arr'][0]['iBuyer2Id']; ?>
"><b><?php echo $this->_tpl_vars['arr'][0]['vBuyer2']; ?>
 (<?php echo $this->_tpl_vars['arr'][0]['vB2Code']; ?>
)</b></span>
							<?php endif; ?>
                  </td>
				  	</tr>
					<tr><td colspan="2">&nbsp;</td></tr>
					<tr class="prs" style="display:none;">
						<td><?php echo $this->_tpl_vars['LBL_SEARCH']; ?>
 <?php echo $this->_tpl_vars['LBL_SPRODUCT']; ?>
 :</td>
						<td>
							<input type="text" class="ttp" id="pnm" name="pnm" value="<?php echo $this->_tpl_vars['post_data']['pnm']; ?>
" class="input-rag" style="width:143px; height:17px; vertical-align:middle;" title="<?php echo $this->_tpl_vars['LBL_NAME']; ?>
" />&nbsp;
							<input type="text" class="ttp" id="pcd" name="pcd" value="<?php echo $this->_tpl_vars['post_data']['pcd']; ?>
" class="input-rag" style="width:143px; height:17px; vertical-align:middle;" title="<?php echo $this->_tpl_vars['LBL_CODE']; ?>
" />&nbsp;
							<span class="btllbl" style="height:17px;"><b onclick="getSProductCombo('<?php echo $this->_tpl_vars['arr'][0]['iProductId']; ?>
');"><?php echo $this->_tpl_vars['LBL_SEARCH']; ?>
</b></span>
							&nbsp; [<?php echo ((is_array($_tmp=$this->_tpl_vars['MSG_CAN_USE_WILD_CHAR'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
]
						</td>
					</tr>
               <tr>
                  <td width="190px" valign="top"><?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_SPRODUCT']; ?>
&nbsp;<font class="reqmsg">*</font> : </td>
                  <td>
   						<span id="sprdt" style="float:left;">
   							<select name="Data[iProductId]" id="iProductId" style="width:300px;" class="required" title="<?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_SPRODUCT']; ?>
">
   								<option value="">---<?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_SPRODUCT']; ?>
---</option>
                           <?php if ($this->_tpl_vars['arr'][0]['iProductId'] > 0): ?>
                              <option value="<?php echo $this->_tpl_vars['arr'][0]['iProductId']; ?>
" selected="selected"><?php echo $this->_tpl_vars['arr'][0]['vProduct']; ?>
 (<?php echo $this->_tpl_vars['arr'][0]['vProductCode']; ?>
)</option>
                           <?php endif; ?>
   							</select>
   						</span>
   						<span class="prs" style="float:right; padding-right:70px; display:none;">
								<?php echo $this->_tpl_vars['LBL_FILTER_LIST_BY']; ?>
 : <input type="text" name="spfilter" id="spfilter" style="width:100px;" />
                     </span>
                  </td>
				  	</tr>
					<tr><td colspan="2"><span style="float:right; padding-right:70px;"><a class="opnprdtls" style="cursor:pointer;"><?php echo $this->_tpl_vars['LBL_VIEW']; ?>
 <?php echo $this->_tpl_vars['LBL_PRODUCT']; ?>
 <?php echo $this->_tpl_vars['LBL_DETAILS']; ?>
</a></span></td></tr>
               <tr>
                  <td valign="top"><?php echo $this->_tpl_vars['LBL_GLOBAL_LIMIT']; ?>
&nbsp;<font class="reqmsg">*</font> : </td>
                  <td><input type="text" id="fGlobalLimit" name="Data[fGlobalLimit]" value="<?php echo $this->_tpl_vars['arr'][0]['fGlobalLimit']; ?>
" class="required decimals" style="width:270px;" maxlength="10" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_GLOBAL_LIMIT']; ?>
" /></td>
               </tr>
					                              <tr class="fperc">
                  <td valign="top"><?php echo $this->_tpl_vars['LBL_FEE']; ?>
 (%)&nbsp;<font class="reqmsg">*</font> : </td>
                  <td><input type="text" id="fFeePc" name="Data[fFeePc]" value="<?php echo $this->_tpl_vars['arr'][0]['fFeePc']; ?>
" class="required decimals" min="0" max="100" maxlength="6" style="width:270px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_FEE']; ?>
" /></td>
               </tr>
               <tr class="fval">
                  <td valign="top"><?php echo $this->_tpl_vars['LBL_FEE']; ?>
 &nbsp;<font class="reqmsg">*</font> : </td>
                  <td><input type="text" id="fFeeFlat" name="Data[fFeeFlat]" value="<?php echo $this->_tpl_vars['arr'][0]['fFeeFlat']; ?>
" class="required decimals" maxlength="10" style="width:270px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_FEE']; ?>
" /></td>
               </tr>
               <tr>
                  <td valign="top"><?php echo $this->_tpl_vars['LBL_ADVANCE']; ?>
 (%)&nbsp;<font class="reqmsg">*</font> : </td>
                  <td><input type="text" id="fAdvancePc" name="Data[fAdvancePc]" value="<?php echo $this->_tpl_vars['arr'][0]['fAdvancePc']; ?>
" class="required decimals" min="0" max="100" maxlength="6" style="width:270px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_ADVANCE']; ?>
" /></td>
               </tr>
               <tr>
                  <td valign="top"><?php echo $this->_tpl_vars['LBL_MINIMUM_VALUE']; ?>
&nbsp;<font class="reqmsg">*</font> : </td>
                  <td><input type="text" id="fMinValue" name="Data[fMinValue]" value="<?php echo $this->_tpl_vars['arr'][0]['fMinValue']; ?>
" class="required decimals" maxlength="10" style="width:270px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_MINIMUM_VALUE']; ?>
" /></td>
               </tr>
               <tr>
                  <td valign="top"><?php echo $this->_tpl_vars['LBL_MAXIMUM_VALUE']; ?>
&nbsp;<font class="reqmsg">*</font> : </td>
                  <td><input type="text" id="fMaxValue" name="Data[fMaxValue]" value="<?php echo $this->_tpl_vars['arr'][0]['fMaxValue']; ?>
" class="required decimals" maxlength="10" style="width:270px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_MAXIMUM_VALUE']; ?>
" /></td>
               </tr>
               <tr>
                  <td valign="top"><?php echo $this->_tpl_vars['LBL_NARRATIVE']; ?>
&nbsp;<font class="reqmsg">*</font> : </td>
                  <td><textarea id="vNarrative" name="Data[vNarrative]" class="required" style="width:270px; height:70px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_NARRATIVE']; ?>
" ><?php echo $this->_tpl_vars['arr'][0]['vNarrative']; ?>
</textarea></td>
               </tr>
               <tr>
                  <td valign="top"><?php echo $this->_tpl_vars['LBL_ACCOUNT']; ?>
1&nbsp;<font class="reqmsg">*</font> : </td>
                  <td><input type="text" id="vAccount1" name="Data[vAccount1]" value="<?php echo $this->_tpl_vars['arr'][0]['vAccount1']; ?>
" class="required" style="width:270px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_ACCOUNT']; ?>
1"/></td>
               </tr>
               <tr>
                  <td valign="top"><?php echo $this->_tpl_vars['LBL_ACCOUNT']; ?>
2 : </td>
                  <td><input type="text" id="vAccount2" name="Data[vAccount2]" value="<?php echo $this->_tpl_vars['arr'][0]['vAccount2']; ?>
" class="" style="width:270px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_ACCOUNT']; ?>
2"/></td>
               </tr>
               <tr>
                  <td valign="top"><?php echo $this->_tpl_vars['LBL_ACCOUNT']; ?>
3 : </td>
                  <td><input type="text" id="vAccount3" name="Data[vAccount3]" value="<?php echo $this->_tpl_vars['arr'][0]['vAccount3']; ?>
" class="" style="width:270px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_ACCOUNT']; ?>
3"/></td>
               </tr>
               <tr>
                  <td valign="top"><?php echo $this->_tpl_vars['LBL_ACCOUNT']; ?>
4 : </td>
                  <td><input type="text" id="vAccount4" name="Data[vAccount4]" value="<?php echo $this->_tpl_vars['arr'][0]['vAccount4']; ?>
" class="" style="width:270px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_ACCOUNT']; ?>
4"/></td>
               </tr>
               <tr>
                  <td valign="top"><?php echo $this->_tpl_vars['LBL_ACCOUNT']; ?>
5 : </td>
                  <td><input type="text" id="vAccount5" name="Data[vAccount5]" value="<?php echo $this->_tpl_vars['arr'][0]['vAccount5']; ?>
" class="" style="width:270px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_ACCOUNT']; ?>
5"/></td>
               </tr>
               <tr>
                  <td valign="top"><?php echo $this->_tpl_vars['LBL_ACCOUNT']; ?>
6 : </td>
                  <td><input type="text" id="vAccount6" name="Data[vAccount6]" value="<?php echo $this->_tpl_vars['arr'][0]['vAccount6']; ?>
" class="" style="width:270px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_ACCOUNT']; ?>
6"/></td>
               </tr>
               <tr>
                  <td valign="top"><?php echo $this->_tpl_vars['LBL_ACCOUNT']; ?>
7 : </td>
                  <td><input type="text" id="vAccount7" name="Data[vAccount7]" value="<?php echo $this->_tpl_vars['arr'][0]['vAccount7']; ?>
" class="" style="width:270px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_ACCOUNT']; ?>
7"/></td>
               </tr>
               <tr>
                  <td valign="top"><?php echo $this->_tpl_vars['LBL_ACCOUNT']; ?>
8 : </td>
                  <td><input type="text" id="vAccount8" name="Data[vAccount8]" value="<?php echo $this->_tpl_vars['arr'][0]['vAccount8']; ?>
" class="" style="width:270px;" title="<?php echo $this->_tpl_vars['LBL_ENTER']; ?>
 <?php echo $this->_tpl_vars['LBL_ACCOUNT']; ?>
8"/></td>
               </tr>
               <?php if (((is_array($_tmp=$this->_tpl_vars['arr'][0]['tReasonToReject'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) != ''): ?>
               <tr>
                  <td valign="top"><?php echo $this->_tpl_vars['LBL_REASON_TO_REJECT']; ?>
8 : </td>
                  <td><div style="word-wrap:break-word; width:390px; height:70px; border:1px solid #cccccc; overflow:scroll;"><?php echo $this->_tpl_vars['arr'][0]['tReasonToReject']; ?>
</div></td>
               </tr>
               <?php endif; ?>
               					<tr>
						<td valign="top">&nbsp;</td>
						<td>
                     <span class="btllbl" style=""><b id="btnSubmit" onclick="return submitfrm('');"><?php echo $this->_tpl_vars['LBL_SUBMIT']; ?>
</b></span>
                     <span class="btllbl" style=""><b id="btnSubmit" onclick="return submitfrm('admr');"><?php echo $this->_tpl_vars['LBL_SAVE_AND_ADDMORE']; ?>
</b></span>
						</td>
					</tr>
				</table>
			</div>
			<div>&nbsp;</div>
         </form>
		</div>
	</div>
</div>
</div>

<script type="text/javascript" src="<?php echo $this->_tpl_vars['S_JQUERY']; ?>
jquery.validate.js" ></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['S_JQUERY']; ?>
jquery.listboxfilter.js" ></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['SITE_JS_AJAX']; ?>
jb2sprdtasoc.js"></script>
<?php echo '
<script type="text/javascript">
function ps()
{
   if($(\'#iBuyer2Id\').val()!=\'\') {
      $(\'.prs\').show();
   }
}
ps();
jQuery.validator.addMethod("lessthan", function(value, element, params)
{
	var val = element.value;
	var vl1 = parseFloat(value);
	var vl2 = parseFloat($(params).val());
	if(isNaN(parseFloat(vl1)) || isNaN(vl2)) {
		return true;
	}
	if(vl1 >= vl2) {
		return false;
	} else {
		return true;
	}
});
$(\'#frmadd\').validate({
   ignore: \':hidden\',
   rules: {
		/*"Data[fOutstandingAmt]": {
			lessthan: { param: \'#fGlobalLimit\' }
		},*/
      "Data[iProductId]": {
         remote: {
   			url: SITE_URL+"index.php?file=or-aj_chkdupdata",
            type: "get",
            data: {
   				val:function() {
   					return $("#iAssociationId").val();
   				},
   				id:function() {
   					return "iAssociationId";
   				},
   				field:function() {
   					return "iProductId";
   				},
               chkf: function () {
                  return "iBuyer2Id";
               },
               chkfvl: function () {
                  return $("#iBuyer2Id").val();
               },
					extc: function () {
                  return " AND NOT (eStatus=\'Delete\' AND eNeedToVerify=\'No\')";
               },
   				table:function() {
   					return "';  echo $this->_tpl_vars['PRJ_DB_PREFIX'];  echo '_buyer2_sproduct_association";
   				}
   			}
   		}
      }
   },
   messages: {
      "Data[iProductId]": {
         remote: jQuery.validator.format(LBL_PRODUCT_ALREADY_INASSOCIATION_WITH_SELECTED_BUYER2)
      },
      "Data[fGlobalLimit]": {
         decimals: LBL_MUST_BE_NUMERIC
      },
      /*"Data[fOutstandingAmt]": {
			lessthan: LBL_MUSTBE_LESSTHAN_GLOBALLIMIT,
         decimals: LBL_MUST_BE_NUMERIC
      },*/
      "Data[fFeePc]": {
         decimals: LBL_MUST_BE_NUMERIC,
         max: LBL_PERCENT_MUST_NOT_EXCEED_100
      },
      "Data[fFeeFlat]": {
         decimals: LBL_MUST_BE_NUMERIC
      },
      "Data[fAdvancePc]": {
         decimals: LBL_MUST_BE_NUMERIC,
         max: LBL_PERCENT_MUST_NOT_EXCEED_100
      },
      "Data[fMinValue]": {
         decimals: LBL_MUST_BE_NUMERIC
      },
      "Data[fMaxValue]": {
         decimals: LBL_MUST_BE_NUMERIC
      }
   }
});

function submitfrm(vl)
{
   var vldfrmdt = $(\'#frmadd\').valid();
   $(document).ready(function() {
     $(function() {
        var ead=130;
        $(\'div.inner-gray-bg\').css(\'height\', parseInt($(\'div.inner-gray-bg\').css(\'height\').replace(\'px\',\'\'))+130);
        $(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:\'div.middle-container\', eladd:ead});
     });
   });
   if(!vldfrmdt) {
      return false;
   }
   $(\'#admr\').val(vl);
   $(\'#frmadd\')[0].submit();
}

$(document).ready(function() {
	$("#b2filter").bigoFilter("#iBuyer2Id", {property: \'text\'});
	$("#spfilter").bigoFilter("#iProductId", {property: \'text\'});
	
   function shfeeclick() {
      // if($(this).val()==\'percent\') {
		if($(\'#fee_type2\').attr(\'checked\')) {
         $(\'tr.fperc\').hide();
         $(\'tr.fval\').show();
         $(\'#fFeePc\').val(\'\');
      } else {
			$(\'tr.fval\').hide();
         $(\'tr.fperc\').show();
         $(\'#fFeeFlat\').val(\'\');
      }
   }
	// shfeeclick();
   // $(\'input[name="fee_type"]\').click(shfeeclick);
   $(\'.ttp\').blur(function() {
      if($.trim($(this).val())==\'\') {
         $(this).val($(this).attr(\'title\'));
      }
   });
   $(\'.ttp\').focus(function() {
      if($.trim($(this).val())==$(this).attr(\'title\')) {
         $(this).val(\'\');
      }
   });
   $.each($(\'.ttp\'), function(i,el) {
      if($.trim($(this).val())==\'\') {
         $(this).val($(this).attr(\'title\'));
      }
   });
   //
	function opnPrdtls() {
		if($.trim($(\'#iProductId\').val())==\'\' || parseInt($(\'#iProductId\').val())<1) {
			return false;
		}
		var url = \'';  echo $this->_tpl_vars['SITE_URL'];  echo 'sprodtls/\'+$(\'#iProductId\').val()+\'/pop\';
		openpopup(url);
	}
	$(\'.opnprdtls\').click(opnPrdtls);
});
</script>
'; ?>

<?php if ($this->_tpl_vars['msg'] != ''): ?>
<?php echo '
<script type="text/javascript" async="async" defer="defer">
$(document).ready(function() {
	var msg = \'';  echo $this->_tpl_vars['msg'];  echo '\';
   if(msg!= \'\') { alert(msg); }
});
</script>
'; ?>

<?php endif; ?>
<?php if ($this->_tpl_vars['arr'][0]['iBuyer2Id'] > 0 && ( ((is_array($_tmp=$this->_tpl_vars['post_data']['pnm'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) != '' || ((is_array($_tmp=$this->_tpl_vars['post_data']['pcd'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) != '' )): ?>
<?php echo '<script type="text/javascript">getSProductCombo(\'\');</script>'; ?>

<?php endif; ?>