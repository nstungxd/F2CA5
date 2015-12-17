<?php /* Smarty version 2.6.0, created on 2012-05-31 11:41:04
         compiled from member/user/grouplist.tpl */ ?>
<div class="middle-container">
<h1><span class=""><?php echo $this->_tpl_vars['LBL_GROUP_LIST']; ?>
</span></h1> <!-- blue-hadd-bg -->
<div class="middle-containt">
<div class="inner-white-bg">
   <div><h2><?php echo $this->_tpl_vars['LBL_SEARCH']; ?>
</h2></div>
   <div class="inport-gray-bg">
        <?php if ($this->_tpl_vars['msg'] != ''): ?>                                        <?php endif; ?>
      <div class="import-border">&nbsp;<?php echo $this->_tpl_vars['LBL_SEARCH']; ?>
 : &nbsp; &nbsp; &nbsp; &nbsp;
         <input type="text" name="search_text" class="input-rag" id="search_text" style="width:190px; vertical-align:middle;" />
         &nbsp; <input type="image" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-go.gif"  alt="" style="cursor: pointer; vertical-align:middle;background: #f8f8f8;border: none" onclick="getgrouplist('all',1)" />
      </div>
      <div  style="padding:5px;">
         <table width="100%" border="0" cellspacing="2" cellpadding="2">
            <tr>
               <td width="17%"><?php echo $this->_tpl_vars['LBL_ORG_NAME']; ?>
 : </td>
               <td width="30%"><span class="import-border">
               <input type="text" name="org_name" class="input-rag" id="org_name" style="width:177px; vertical-align:middle;" />
               </span></td>
               <td width="17%"><?php echo $this->_tpl_vars['LBL_GROUP_NAME']; ?>
 :</td>
               <td width="36%"><span class="import-border">
                  <input type="text" name="grp_name" id="grp_name" class="input-rag" style="width:177px; vertical-align:middle;" />
               </span>
                    &nbsp; <input type="image" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-go.gif" alt=""   style="cursor: pointer; vertical-align:middle;background: #f8f8f8;border: none" onclick="getgrouplist('srch',1)" />
               </td>
            </tr>
         </table>
      </div>
   </div>
   <div>
        <div style="height:25px;" align="right">
             <span id="updating" style="display: none;padding-bottom: 7px;"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/progress.gif" alt=""/><a style="vertical-align:top;">Processing</a></span>
             <span id="dispmsg" class="msg"></span>
             <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
btn-active-inactive.gif" alt="" border="0" style="cursor:pointer;padding-right: 5px;vertical-align:top;" onclick="Delete('status','')"/>
             <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-delete-all.gif" alt="" border="0" style="cursor:pointer;padding-right: 5px;vertical-align:top;" onClick="Delete('deleteall','')"/></div>
      <div class="light-golden-bor">
         <table width="100%" border="0" class="black" cellspacing="0" cellpadding="0">
            <input type="hidden" name="cursort" id="cursort" value="" />
            <input type="hidden" name="cursorttype" id="cursorttype" value="" />
            <tr>
            <td class="listing-sky-blue">
               <table width="100%" border="0" cellspacing="1" cellpadding="0">
                  <tr>
                    <td width="30" height="26" align="center"><input type="checkbox" class="radib-btn" name="checkbox" id="checkbox" /></td>
                    <td width="188" align="left" style="padding-left:2px;"><a href="javascript:getgrouplist('all','1','vCompanyName')"><strong>Organization Name</strong></a></td>
                    <td width="189" align="left"><a href="javascript:getgrouplist('all','1','vGroupName')"><strong>Group Name</strong></a></td>
                    <td width="59" align="center"><a href="javascript:getgrouplist('all','1','eCreatedBy')"><strong>Created By</strong></a></td>
                    <td width="62" align="center"><a href="javascript:getgrouplist('all','1','grp.eStatus')"><strong>Status</strong></a></td>
                    <td width="94" align="center">Action</td>
                  </tr>
               </table>
            </td>
         </tr>
         <tr>
            <td>
					<div id="grouplist"><input type="hidden" name="pg" id="pg" value="1"/></div>
					<input type="hidden" name="mod" id="mod" value="" />
					<input type="hidden" name="srchfor" id="srchfor" value="<?php echo $this->_tpl_vars['srchfor']; ?>
" />
					<input type="hidden" name="srchval" id="srchval" value="<?php echo $this->_tpl_vars['srchval']; ?>
" />
            </td>
         </tr>
      </table>
      </div>
   </div>
   </div>
</div>
<input type="hidden" name="m" id="m" value="" />
</div>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['SITE_JS_AJAX']; ?>
jlistgroup.js"></script>
<?php if ($this->_tpl_vars['msg'] != ''): ?>
<?php echo '
<script type="text/javascript">
$(document).ready(function() {
	var msg=\'';  echo $this->_tpl_vars['msg'];  echo '\';
	if(msg!= \'\' && msg != undefined && $(\'#m\').val()!=msg) {
		alert(msg);
		$(\'#m\').val(msg);
	}
});
</script>
'; ?>

<?php endif; ?>