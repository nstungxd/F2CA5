<?php /* Smarty version 2.6.0, created on 2012-05-31 12:12:39
         compiled from member/user/edituserrights.tpl */ ?>
<form name="frmassignright" id="frmassignright" action="<?php echo $this->_tpl_vars['SITE_URL']; ?>
index.php?file=u-assignrights_a" method="post">
<input type="hidden" name="Data[iUserID]" id="iUserID"value="<?php echo $this->_tpl_vars['iUserID']; ?>
" />
<input type="hidden" name="view" id="view"value="<?php echo $this->_tpl_vars['view']; ?>
" />
<div class="middle-container">
     <h1><?php echo $this->_tpl_vars['LBL_ASSIGN_RIGHTS_USER']; ?>
</h1>
     <div class="middle-containt">
          <div class="statistics-main-box-white">
               <div>
                    <ul id="inner-tab">
								 <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
createorganizationuser/<?php echo $this->_tpl_vars['iUserID']; ?>
" ><EM>Organization User</EM></a></li>
                         <li><a class="current"><EM><?php echo $this->_tpl_vars['LBL_ORG_USER_ACCESS_RIGHTS']; ?>
</EM></a></li>
                    </ul>
               </div>
               <div class="clear"></div><div class="inner-gray-bg">
                    <div>&nbsp;</div>
                    <div>
								<table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
									<tr>
										<td width="130px" valign="top"><?php echo $this->_tpl_vars['LBL_SELECT_ORG']; ?>
&nbsp;<font class="reqmsg">*</font> </td>
										<td>:</td>
									<td>
										<table width="228" border="0" cellspacing="0" cellpadding="0">
										  <tr>
											 <td height="20">
													 <?php if ($this->_tpl_vars['view'] == 'edit'): ?>
															<?php echo $this->_tpl_vars['orgname']; ?>

													 <?php else: ?>
													 <input type="text" name="vOrg" id="vOrg" value="<?php echo $this->_tpl_vars['orgdata'][0]['vCompanyName']; ?>
" class="input-rag" tabindex="1" title="<?php echo $this->_tpl_vars['MSG_SELECT_ORGANIZATION']; ?>
"/>
													 <input type="hidden" name="iOrganizationID" id="iOrganizationID" class="required" value="" title="<?php echo $this->_tpl_vars['MSG_SELECT_ORGANIZATION']; ?>
"/>
													 <?php endif; ?>
											 </td>
										  </tr>
										</table>
									</td>
									</tr>
										<tr>
                                   <td width="130px" valign="top"><?php echo $this->_tpl_vars['LBL_SELECT_USER']; ?>
 </td>
                                   <td>:</td>
                                   <td>
                                        <table width="228" border="0" cellspacing="0" cellpadding="0">
                                             <tr>
                                                  <!-- class="securitymanager-white-bg" -->
                                                  <td height="20">
                                                       <?php if ($this->_tpl_vars['view'] == 'edit'): ?>
                                                            <?php echo $this->_tpl_vars['userdata'][0]['vFirstName']; ?>
 <?php echo $this->_tpl_vars['userdata'][0]['vLastName']; ?>

                                                       <?php else: ?>
                                                       <input type="text" name="vUser" id="vUser" value="" class="input-rag" tabindex="2" title="<?php echo $this->_tpl_vars['MSG_SELECT_ORG']; ?>
"/>
                                                       <input type="hidden" name="Data[iUserID]" id="iUserID" value="" title="<?php echo $this->_tpl_vars['MSG_SELECT_ORG']; ?>
"class="required"/>
                                                       <?php endif; ?>
                                                  </td>
                                             </tr>
                                        </table>
                                   </td>
                              </tr>
                              <tr>
                                   <td colspan="2" valign="top"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/spacer.gif" width="1" height="1" alt="" border="0" /></td>
                              </tr>
                              <tr style="" id="access_row">
                                <td valign="top"><?php echo $this->_tpl_vars['LBL_ASSIGN_RIGHT_USER']; ?>
 &nbsp;<font class="reqmsg">*</font> </td>
                                <td>&nbsp;</td>
                                  <td>
												  <?php if ($this->_tpl_vars['userdata'][0]['ePermissionType'] != 'Group'): ?>
                                      <div id="OrgStatus_Div" style="overflow-y:auto; width:700px; border:1px solid #cccccc; padding:1px;"></div>
												  <?php else: ?>
												  <div><?php echo $this->_tpl_vars['LBL_USER_PERMISSION_TYPE_IS_GROUP']; ?>
. <?php echo $this->_tpl_vars['LBL_CLICK']; ?>
 <a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
groupview/<?php echo $this->_tpl_vars['userdata'][0]['iGroupID']; ?>
" style="cursor:pointer;"><?php echo $this->_tpl_vars['LBL_HERE']; ?>
</a> <?php echo $this->_tpl_vars['LBL_TO']; ?>
 <?php echo $this->_tpl_vars['LBL_VIEW_RIGHTS_OF_GROUP']; ?>
.</div>
												  <?php endif; ?>
                                  </td>
                              </tr>
                              <tr style="" id="assign_row">
                                   <td height="30" valign="top">&nbsp;</td>
                                   <td colspan="2">
													 <?php if ($this->_tpl_vars['userdata'][0]['ePermissionType'] != 'Group'): ?>
													 <input type="image" class="pointer" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-assign.gif" alt="" tabindex="3" style="vertical-align:middle;border:none;background: #f8f8f8;" onclick="frmsubmit();" /> <!--&nbsp; <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-cancel.gif" alt="" tabindex="4"  style="cursor:pointer; vertical-align:middle;border:none;background: #f8f8f8;" onclick="history.back();" />-->
													 <?php else: ?>
													 <a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
organizationuserlist"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
btn-go.gif" /></a>
													 <?php endif; ?>
											  </td>
                              </tr>
                         </table>

                    </div>
                    <div>&nbsp;</div>
               </div>
          </div>
     </div>
</div>
</form>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['S_JQUERY']; ?>
jquery.validate.js"></script>
<script language="JavaScript" src="<?php echo $this->_tpl_vars['S_JQUERY']; ?>
jquery.autocomplete.js"></script>
<link type="text/css" rel="stylesheet" media="screen" href="<?php echo $this->_tpl_vars['SITE_CSS']; ?>
jquery.autocomplete.css" />
<?php echo '
<script type="text/javascript">
var view = \'';  echo $this->_tpl_vars['view'];  echo '\';
if(view == \'edit\') {
     var totValID = \'';  echo $this->_tpl_vars['iUserID'];  echo '\';
     var fromtype = \'user\';
     var prms = \'';  echo $this->_tpl_vars['ures'][0]['tPermission'];  echo '\';
     $("#OrgStatus_Div").attr(\'innerHTML\',\'Loading...\');
     ';  if ($this->_tpl_vars['orgdata'][0]['eOrganizationType'] == 'Buyer2'):  echo '
        $(\'#OrgStatus_Div\').load(SITE_URL+"index.php?file=u-aj_getB2OrgUserStatus&type=user&iId="+totValID+"&prms="+prms+"&fromtype="+fromtype+"");
     ';  else:  echo '
	     $(\'#OrgStatus_Div\').load(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+totValID+"&prms="+prms+"&fromtype="+fromtype+"");
     ';  endif;  echo '
     //$(\'#OrgStatus_Div\').load(SITE_URL+"index.php?file=or-aj_getOrganizationStatus&type=user&iId="+totValID+"&prms="+prms+"&fromtype="+fromtype+"");
}
$(\'#saved_itms\').hide();
/*
function getUser() {
    if($(\'#iOrganizationID\').val() == \'\') {
        alert("Please select one organization first to get its users.");return false;
    }

    if($(\'#name_keyword\').val() == \'\') {
        alert("Please enter name of the User.");return false;
    }
    totValID = $(\'#iOrganizationID\').val();
    $(\'#result\').load(SITE_URL+"index.php?file=u-aj_getOrganizationUser&type=user&iId="+totValID+"&name="+$(\'#name_keyword\').val()+"");
}
$(\'#reset_btn\').click( function () {
        $(\'#tUserID\').find(\'option\').remove();
});
$(\'#insert_btn\').click( function () {
    orgs = $(\'input:checkbox[name="uid\\[\\]"]\');
    $.each(orgs, function (ln,el) {
       if($(this).attr(\'checked\') == true) {
            var id = $(this).attr(\'id\');
            var userID = $(this).val();
            var userName = $(\'#name_\'+id+\'\').val();
            var chkvalue =0;
            if($(\'#tUserID option\').length > 0){
                $(\'#tUserID option\').each(function() {
                    if($(this).val() == userID){
                       chkvalue++;
                    }
                });
                if(chkvalue == 0){
                    $(\'#tUserID\').append($("<option></option>").attr("value",\'\'+userID+\'\').attr(\'selected\',\'selected\').text(\'\'+userName+\'\'));
                }
            }else{
                 $(\'#tUserID\').append($("<option></option>").attr("value",\'\'+userID+\'\').attr(\'selected\',\'selected\').text(\'\'+userName+\'\'));
            }
        }
    });
});
*/
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
   totValRes = totVal[1];
   $(\'#iOrganizationID\').val(totValID);
	$(\'#vUser\').val(\'\');
	$(\'#iUserID\').val(\'\');
   $(\'#OrgStatus_Div\').load(SITE_URL+"index.php?file=or-aj_getOrganizationStatus&type=user&iId="+totValID+"");
	setuserauto();
}

function findUserValue(li) {
   if( li == null ) return alert("No match!");
   if( !!li.extra ) var sValue = li.extra[0];
	else var sValue = li.selectValue;

   // Coded BY SNEHASIS [TO GET ID OF A DATA]
   var totVal = sValue;
   var totValID;
   var totValRes;
   totVal = totVal.split(\'</span>\');
   totValID = totVal[0].replace("<span style=\'display:none\'>","");
   totValRes = totVal[1];
   var iOrgId=totValID.split(\'_\');
   totValID=iOrgId[0];
   iOrgId=iOrgId[1];
   $(\'#iUserID\').val(totValID);
//	alert(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+iOrgId+"&iUserID="+totValID);
   $(\'#OrgStatus_Div\').load(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+totValID);		// +"&iOrgId="+iOrgId
}
function selectOrgItem(li) {
	findOrgValue(li);
}
function selectUsrItem(li) {
	findUserValue(li);
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
function setuserauto()
{
	$("#vUser").autocomplete(
		SITE_URL+"index.php?file=u-aj_getUser&icompid="+$(\'#iOrganizationID\').val(),
		{
			delay:10,
			minChars:1,
			matchSubset:1,
			matchContains:1,
			cacheLength:10,
         onItemSelect:selectUsrItem,
			onFindValue:findUserValue,
			formatItem:formatItem,
         autoFill:false
		});
}
$(document).ready(function() {
	$("#vOrg").autocomplete(
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
		});
});
function frmsubmit()
{
   $(\'#frmassignright\').submit();
/*   chkbx = $(\'input:checkbox\');
   $.each(chkbx,function(i,el) {
	   $(this).attr(\'disabled\',\'\');
   });
	$(\'#frmassignright\').submit( function() {
	    setTimeout("$.each(chkbx,function(i,el) { $(this).attr(\'disabled\',\'disabled\'); });", 1000);
	});
   setTimeout("$.each(chkbx,function(i,el) { $(this).attr(\'disabled\',\'disabled\'); });", 1000);
*/
}
// $("#frmassignright").validate();
</script>
'; ?>