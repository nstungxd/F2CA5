<?php /* Smarty version 2.6.0, created on 2015-07-11 18:11:09
         compiled from member/user/creategroup.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'is_array', 'member/user/creategroup.tpl', 54, false),array('modifier', 'count', 'member/user/creategroup.tpl', 54, false),)), $this); ?>
<form name="frmcreategroup" id="frmcreategroup" action="<?php echo $this->_tpl_vars['SITE_URL']; ?>
index.php?file=u-creategroup_a" method="POST">
<input type="hidden" name="iGroupID" id="iGroupID"value="<?php echo $this->_tpl_vars['iGroupID']; ?>
" />
<input type="hidden" name="view" id="view"value="<?php echo $this->_tpl_vars['view']; ?>
" />
<div class="middle-container">
       <h1><?php echo $this->_tpl_vars['LBL_CREATE_GROUP']; ?>
</h1>
       <div class="middle-containt">
       <div class="statistics-main-box-white">
       <div>
         <ul id="inner-tab">
				<li><a href="#" class="current"><EM><?php echo $this->_tpl_vars['LBL_GROUP']; ?>
</EM></a></li>
		 	</ul>
       </div>
      <div class="clear"></div>
		<div class="inner-gray-bg">
            	<div>&nbsp;</div>
                <div>
                    <?php if ($this->_tpl_vars['msg'] != ''): ?>
                                                                 <?php endif; ?>
                    <table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
                    <tr>
                      <td width="130px" valign="top"><?php echo $this->_tpl_vars['LBL_SELECT_ORG']; ?>
&nbsp;<font class="reqmsg">*</font> </td>
                      <td>:</td>
                      <td>
                      <table width="228" border="0" cellspacing="0" cellpadding="0">
                      <?php if ($this->_tpl_vars['usertype'] == 'securitymanager'): ?>
                          <tr>
                              <!-- class="securitymanager-white-bg" -->
                            <td height="20">
                                                             	<div id="grouporg">
                            		<?php if ($this->_tpl_vars['view'] == 'edit'): ?>
                            			<input type="text" class="input-rag" readonly="readonly" id="org" name="org" value="<?php echo $this->_tpl_vars['orgdata'][0]['vCompanyName']; ?>
" />
												<input type="hidden" class="input-rag" readonly="readonly" id="iOrganizationID" name="Data[iOrganizationID]" value="<?php echo $this->_tpl_vars['orgdata'][0]['iOrganizationID']; ?>
" />
                            		<?php elseif ($this->_tpl_vars['view'] != 'edit'): ?>
                                  	<select name="Data[iOrganizationID]" id="iOrganizationID" class="required" title="<?php echo $this->_tpl_vars['MSG_SELECT_ORGANIZATION']; ?>
" style="width:230px" onchange='getOrgStatus(this.value);'>
                                          <option value=''>---<?php echo $this->_tpl_vars['MSG_SELECT_ORGANIZATION']; ?>
---</option>
																												<?php if (((is_array($_tmp=$this->_tpl_vars['orgdata'])) ? $this->_run_mod_handler('is_array', true, $_tmp) : is_array($_tmp)) && count($this->_tpl_vars['orgdata']) > 0): ?>
														<option value='<?php echo $this->_tpl_vars['orgdata'][0]['iOrganizationID']; ?>
' selected="selected"><?php echo $this->_tpl_vars['orgdata'][0]['vCompanyName']; ?>
</option>
														<?php endif; ?>
														                               		</select>
                               	<?php endif; ?>
                               </div>
                           </td>
                           <td>&nbsp;</td>
              					    <td valign="top">
              					    	<?php if ($this->_tpl_vars['view'] != 'edit'): ?>
              					          <input type="text" name="orgtxt" value="<?php echo $this->_tpl_vars['orgdata'][0]['orgname']; ?>
" class="" id="orgtxt" style="vertical-align:middle; height:18px;" />
         					          <?php endif; ?>
                               </td>
                               <td >&nbsp;</td>
                               <td valign="top">
                               	<?php if ($this->_tpl_vars['view'] != 'edit'): ?>
                                  <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-search.gif" alt="" border="0" style="cursor: pointer;vertical-align:middle;background: #f8f8f8;border:none;" onclick="getBuyerOrgs();"  />
                                  <?php endif; ?>
              			           </td>

                          </tr>
                          <?php else: ?>
                          <tr>
                               <tr>
                              <!-- class="securitymanager-white-bg" -->
                            <td height="20">

                                        <input type="text" name="vOrg" id="vOrg" value="<?php echo $this->_tpl_vars['orgname']; ?>
" class="input-rag required" readonly="readonly" title="<?php echo $this->_tpl_vars['MSG_SELECT_ORGANIZATION']; ?>
"/>
                                        <input type="hidden" name="Data[iOrganizationID]" id="iOrganizationID" value="<?php echo $this->_tpl_vars['orgid']; ?>
" title="<?php echo $this->_tpl_vars['MSG_SELECT_ORGANIZATION']; ?>
"/>


                               </select>
                               </div>
                            </td>
                            <td colspan="4">&nbsp;</td>
                          </tr>
                          <tr>
                          <?php endif; ?>
                        </table></td>
                    </tr>
                    <tr>
                      <td valign="top"><?php echo $this->_tpl_vars['LBL_GROUP_NAME']; ?>
&nbsp;<font class="reqmsg">*</font> </td>
                      <td>:</td>
                      <td>
                         <?php if ($this->_tpl_vars['view'] == 'edit'): ?>
                              <input type="text" name="Data[vGroupName]" value="<?php echo $this->_tpl_vars['grpData'][0]['vGroupName']; ?>
" class="input-rag required" id="vGroupName" style="width:228px;"/>
                                                       <?php else: ?>
                              <input type="text" name="Data[vGroupName]" value="<?php echo $this->_tpl_vars['grpData'][0]['vGroupName']; ?>
" class="input-rag required" id="vGroupName" style="width:228px;"/>
                         <?php endif; ?>
                      </td>
                    </tr>
						                      <tr id="access_rights_row" style="display:none;">
                      <td valign="top"><?php echo $this->_tpl_vars['LBL_ASSIGN_RIGHTS']; ?>
&nbsp;<font class="reqmsg">*</font> </td>
                      <td valign="top">:</td>
                        <td>
                            <div id="OrgStatus_Div" style="width:700px; overflow-x:auto; border:1px solid #cccccc; padding:1px;"></div>
                        </td>
                    </tr>
                    <tr>
                      <td valign="top">&nbsp;</td>
                      <td colspan="2">
                        <img id="go" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-submit.gif" alt="" style="vertical-align:middle;cursor:pointer;border:none;background: #f8f8f8;" onclick="return frmsubmit();" /> &nbsp;
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
<input id="vldms" name="vldms" style="display:none;" value="" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['S_JQUERY']; ?>
jquery.validate.js"></script>
<script language="JavaScript" src="<?php echo $this->_tpl_vars['S_JQUERY']; ?>
jquery.autocomplete.js"></script>
<link type="text/css" rel="stylesheet" media="screen" href="<?php echo $this->_tpl_vars['SITE_CSS']; ?>
jquery.autocomplete.css" />
<?php echo '
<script type="text/javascript">
var view = \'';  echo $this->_tpl_vars['view'];  echo '\';
var org = \'';  echo $this->_tpl_vars['orgname'];  echo '\';
var grpid = \'';  echo $this->_tpl_vars['iGroupID'];  echo '\';

//$(document).ready({
   var validator = $("#frmcreategroup").validate({
      rules: {
      "Data[vGroupName]": {
         remote: {
            url:SITE_URL+"index.php?file=u-aj_chkdupdata",
            type:"get",
            data:{
               val:function() {
                  return $("#iGroupID").val();
               },
               id:function() {
                  return "iGroupID";
               },
               field:function() {
                  return "vGroupName";
               },
               extfld: function() {
                  return "iOrganizationID";
               },
               extval: function() {
                  return $("#iOrganizationID").val();
               },
               table:function() {
                  return "';  echo $this->_tpl_vars['PRJ_DB_PREFIX'];  echo '_organization_group";
               }
            }
         }
      }
      },
      messages: {
	      "Data[vGroupName]": {
		      required:  \'';  echo $this->_tpl_vars['LBL_ENTER_GROUP_NAME'];  echo '\',
			   remote: jQuery.validator.format(LBL_GROUP_NAME_TAKEN)
         }
      }
   });
// });

var shgo_fn = function shgo() {
   ln = $(\'#tUserID option\').length;
   if(ln == 0){
      // $(\'#go\').hide();
   } else if(ln > 0) {
		// $(\'#go\').show();
	}
}
// shgo_fn();
$(document).ready(function() {
   $(\'#insert_btn\').click(shgo_fn);
	$(\'#reset_btn\').click(shgo_fn);
});
if(view == \'edit\') {
   var totValID = \'';  echo $this->_tpl_vars['orgdata'][0]['iOrganizationID'];  echo '\';
   var userid = \'';  echo $this->_tpl_vars['grpData'][0]['tUserID'];  echo '\';
   var prms = \'';  echo $this->_tpl_vars['grpData'][0]['tPermission'];  echo '\';
	var acpt = \'';  echo $this->_tpl_vars['grpData'][0]['tAcceptancePermit'];  echo '\';
   $(\'#OrgStatus_Div\').load(SITE_URL+"index.php?file=or-aj_getOrganizationStatus&type=user&iId="+totValID+"&prms="+prms+"&acpt="+acpt+"&grpid="+grpid);
   $(\'#result\').load(SITE_URL+"index.php?file=u-aj_getOrganizationUser&type=user&iId="+totValID+"&userid="+userid+"");
}

$(\'#saved_itms\').hide();
function getUser() {
   if(view != \'edit\') {
    if($(\'#iOrganizationID\').val() == \'\') {
        alert("Please select one organization first to get its users.");return false;
    }
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
function rset() {
	$(\'#tUserID option\').remove();
	$(\'#result\').attr(\'innerHTML\',\'';  echo $this->_tpl_vars['LBL_USER_NOT_FOUND'];  echo '\');
}
function getBuyerOrgs() {
    if($(\'#orgtxt\').val() == \'\') {
        alert("Please Enter Organization Name");return false;
    }

   var orgtxt = $(\'#orgtxt\').val();
   $(\'#grouporg\').load(SITE_URL+"index.php?file=or-aj_getBuyerOrg&view=group&orgtxt="+orgtxt);
}
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

$(\'#delete_btn\').click( function () {
    orgs = $(\'input:checkbox[name="uid\\[\\]"]\');
    $.each(orgs, function (ln,el) {
       if($(this).attr(\'checked\') == true) {
            var id = $(this).attr(\'id\');
            var userID = $(this).val();
            var userName = $(\'#name_\'+id+\'\').val();
            var chkvalue =0;
            if($(\'#tUserID option\').length > 0){
                $(\'#tUserID option\').each(function() {
                    if($(this).attr(\'selected\')){
                         $(this).remove();
                    }
                });
            }
        }
    });
});

function findValue(li) {
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
   $(\'#tUserID\').find(\'option\').remove();
	$(\'#result\').attr(\'innerHTML\',\'';  echo $this->_tpl_vars['LBL_USER_NOT_FOUND'];  echo '\');
   //$(\'#result\').load(SITE_URL+"index.php?file=u-aj_getOrganizationUser&type=user&iId="+totValID+"");
   $(\'#OrgStatus_Div\').load(SITE_URL+"index.php?file=or-aj_getOrganizationStatus&type=user&iId="+totValID+"&grpid="+grpid);
}

function selectItem(li) {
	findValue(li);
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
/*if(org == \'\') {
     $(document).ready(function() {
          $("#vOrg").autocomplete(
               SITE_URL+"index.php?file=or-aj_getOrganization",
               {
                    delay:10,
                    minChars:1,
                    matchSubset:1,
                    matchContains:1,
                    cacheLength:10,
                    onItemSelect:selectItem,
                    onFindValue:findValue,
                    formatItem:formatItem,
                    autoFill:false
               }
          );
     });
     //$(\'#iOrganizationID\').load(SITE_URL+"index.php?file=or-aj_getOrganization"+"&htmlTag=option"+"&isAssoc=no"+"&val=';  echo $this->_tpl_vars['orgdata'][0]['iOrganizationID'];  echo '");
}*/

if(org != \'\') {
    $(document).ready(function() {
          var totValID = \'';  echo $this->_tpl_vars['orgdata'][0]['iOrganizationID'];  echo '\';
          if(totValID == \'\') {
          	totValID = \'';  echo $this->_tpl_vars['orgid'];  echo '\';
          }
          var userid = \'';  echo $this->_tpl_vars['grpData'][0]['tUserID'];  echo '\';
          var prms = \'';  echo $this->_tpl_vars['grpData'][0]['tPermission'];  echo '\';
			 var acpt = \'';  echo $this->_tpl_vars['grpData'][0]['tAcceptancePermit'];  echo '\';
          $(\'#OrgStatus_Div\').load(SITE_URL+"index.php?file=or-aj_getOrganizationStatus&type=user&iId="+totValID+"&prms="+prms+"&acpt="+acpt+"&grpid="+grpid);
			 $(function() {
				  var ead=10;
				  $(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:\'div.middle-container\', eladd:ead});
			 });
    });
}
function frmsubmit() {
	if(! ($("#frmcreategroup").valid())) {
		return false;
	} else {
		$(\'#frmcreategroup\')[0].submit();
	}
}
</script>
'; ?>


<?php if ($this->_tpl_vars['vldmsg'] != ''):  echo '
<script type="text/javascript">
$(document).ready(function() {
	var vldmsg = \'';  echo $this->_tpl_vars['vldmsg'];  echo '\';
   if(vldmsg!= \'\' && vldmsg != undefined && $(\'#vldms\').val()!=vldmsg) {
	   alert(vldmsg);
		$(\'#vldms\').val(vldmsg);
   }
});

function getOrgStatus(res){
    $("#OrgStatus_Div").attr(\'innerHTML\',\'Loading...\');
    $("#OrgStatus_Div").load(SITE_URL+"index.php?file=or-aj_getOrganizationStatus&type=user&iId="+this.value+"&prms="+prms+"&acpt="+acpt+"&grpid="+res+"&view="+view);
}
</script>
'; ?>

<?php endif; ?>