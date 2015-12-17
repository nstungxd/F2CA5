<?php /* Smarty version 2.6.0, created on 2012-05-31 12:49:16
         compiled from member/organization/b2buyerasoclist.tpl */ ?>
<div class="middle-container">
<h1><span class=""><?php echo $this->_tpl_vars['LBL_ASSO_LIST']; ?>
</span></h1> <!-- blue-hadd-bg -->
<div class="middle-containt">
<div class="inner-white-bg">
   <div><h2><?php echo $this->_tpl_vars['LBL_SEARCH']; ?>
</h2></div>
   <div class="inport-gray-bg">
        <?php if ($this->_tpl_vars['msg'] != ''): ?>
                             <?php endif; ?>
      <div class="import-border">&nbsp;<?php echo $this->_tpl_vars['LBL_SEARCH']; ?>
 : &nbsp; &nbsp; &nbsp; &nbsp;
         <input type="text" name="search_text" class="input-rag" id="search_text" style="width:190px;" /> &nbsp;
         <a class="btllbl" onclick="getb2buyerassoclist('all',1)" style="height:19px; text-decoration:none;"><b><?php echo $this->_tpl_vars['LBL_GO']; ?>
</b></a>
      </div>
      <div  style="padding:5px;">
         <table width="100%" border="0" cellspacing="2" cellpadding="2">
            <tr>
               <td width="25%"><?php echo $this->_tpl_vars['LBL_BUYER']; ?>
2 :</td>
               <td width="25%" align="left">
                  <span class="import-border">
                     <input type="text" name="buyer2" id="buyer2" class="input-rag" style="width:177px; vertical-align:middle;" />
                  </span>
               </td>
               <td width="25%"><?php echo $this->_tpl_vars['LBL_BUYER']; ?>
 :</td>
               <td width="25%" align="left">
                  <span class="import-border">
                     <input type="text" name="buyer" id="buyer" class="input-rag" style="width:177px; vertical-align:middle;" />
                  </span>
               </td>
            </tr>
            <tr>
               <td width="30%"><?php echo $this->_tpl_vars['LBL_CODE']; ?>
 :</td>
               <td width="30%" colspan="3" align="left">
                  <span class="import-border">
                     <input type="text" name="code" id="code" class="input-rag" style="width:177px; vertical-align:middle;" />
                  </span>
                  <a class="btllbl" onclick="getb2buyerassoclist('srch',1)" style="height:19px; text-decoration:none;"><b><?php echo $this->_tpl_vars['LBL_GO']; ?>
</b></a>
               </td>
            </tr>
         </table>
      </div>
   </div>
   <div>
      <div style="height:25px; padding-right:10px;" align="right">
			<?php if (( $this->_tpl_vars['uorg_type'] == 'Buyer2' && $this->_tpl_vars['sess_usertype_short'] == 'OA' ) || $this->_tpl_vars['sess_usertype_short'] == 'SM'): ?>
			<span class="btllbl" style="float:left;"><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
b2buyerasoc" style="textarea-decoration:none;"><b><?php echo $this->_tpl_vars['LBL_CREATE']; ?>
</b></a></span>
			<?php endif; ?>
         <span id="updating" style="display: none; padding-bottom: 7px;"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/progress.gif" alt=""/><a style="vertical-align:top;">Processing</a></span>
         <span id="dispmsg" class="msg"></span>
			<?php if (( $this->_tpl_vars['uorg_type'] == 'Buyer2' && $this->_tpl_vars['sess_usertype_short'] == 'OA' ) || $this->_tpl_vars['sess_usertype_short'] == 'SM'): ?>
         <span class="btllbl" style="float:right;"><b onclick="status('deleteall','')"><?php echo $this->_tpl_vars['LBL_DELETE']; ?>
</b></span>
         <span class="btllbl" style="float:right;"><b onclick="status('status','')"><?php echo $this->_tpl_vars['LBL_ACTIVE_INACTIVE']; ?>
</b></span>
			<?php endif; ?>
      </div>
      <div class="light-golden-bor">
         <table width="100%" border="0" class="black" cellspacing="0" cellpadding="0">
            <input type="hidden" name="cursort" id="cursort" value="" />
            <input type="hidden" name="cursorttype" id="cursorttype" value="" />
            <tr>
            <td class="listing-sky-blue">
               <table width="100%" border="0" cellspacing="1" cellpadding="0">
                  <tr>
                    <td width="20" height="26" align="center"><input type="checkbox" class="radib-btn" name="checkbox" id="checkbox" /></td>
				        <td width="100" align="left"><a href="javascript:getb2buyerassoclist('all','1','vBuyer2')"><b><?php echo $this->_tpl_vars['LBL_BUYER']; ?>
2</b></a></td>
				        <td width="80" align="left"><a href="javascript:getb2buyerassoclist('all','1','vBuyer')"><strong><?php echo $this->_tpl_vars['LBL_BUYER']; ?>
</strong></a></td>
                    <td width="70" align="center"><a href="javascript:getb2buyerassoclist('all','1','vACode')"><strong><?php echo $this->_tpl_vars['LBL_CODE']; ?>
</strong></a></td>
                    <td width="62" align="center"><a href="javascript:getb2buyerassoclist('all','1','eStatus')"><strong><?php echo $this->_tpl_vars['LBL_STATUS']; ?>
</strong></a></td>
                    <td width="94" align="center"><?php echo $this->_tpl_vars['LBL_ACTION']; ?>
</td>
                  </tr>
               </table>
            </td>
         </tr>
         <tr>
            <td>
					<div id="assoclist"><input type="hidden" name="pg" id="pg" value="1"/></div>
					<span>
						<input type="hidden" name="mod" id="mod" value="" />
						<input type="hidden" name="srchfor" id="srchfor" value="<?php echo $this->_tpl_vars['srchfor']; ?>
" />
						<input type="hidden" name="srchval" id="srchval" value="<?php echo $this->_tpl_vars['srchval']; ?>
" />
					</span>
            </td>
         </tr>
      </table>
      </div>
   </div>
   </div>
</div>
<input type="hidden" name="sltyp" id="sltyp" value="<?php echo $this->_tpl_vars['srchval']; ?>
" />
</div>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['SITE_JS_AJAX']; ?>
jlistb2buyerassoc.js"></script>
<?php if ($this->_tpl_vars['msg'] != ''): ?>
<?php echo '
<script type="text/javascript">
	$(document).ready(function() {
		var msg = \'';  echo $this->_tpl_vars['msg'];  echo '\';
		// if(msg!= \'\' && msg != undefined && $(\'#m\').val()!=msg) {
			alert(msg);
			// $(\'#m\').val(msg);
		// }
	});
</script>
'; ?>

<?php endif; ?>