<?php /* Smarty version 2.6.0, created on 2015-06-26 11:57:39
         compiled from member/user/assignrights.tpl */ ?>
<form name="frmassignright" id="frmassignright" action="<?php echo $this->_tpl_vars['SITE_URL']; ?>
index.php?file=u-assignrights_a" method="post">
     <div class="middle-container">
          <h1><?php echo $this->_tpl_vars['LBL_ASSIGN_RIGHTS_USER']; ?>
</h1>
          <div class="middle-containt">
               <div class="statistics-main-box-white">
                    <div>
                         <ul id="inner-tab">
                              <li><a href="<?php echo $this->_tpl_vars['SITE_URL_DUM']; ?>
assignrights" class="current"><EM><?php echo $this->_tpl_vars['LBL_ASSIGN_RIGHTS_USER']; ?>
</EM></a></li>
                         </ul>
                    </div>
                    <div class="clear"></div><div class="inner-gray-bg">
                         <div>&nbsp;</div>
                         <div>
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
                              <table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">                             <?php if ($this->_tpl_vars['usertype'] == 'securitymanager'): ?>
                                   <tr>
                                        <td width="130px" valign="top"><?php echo $this->_tpl_vars['LBL_SELECT_ORG']; ?>
&nbsp;<font class="reqmsg">*</font> </td>
                                        <td>:</td>
                                        <td>
                                             <table width="228" border="0" cellspacing="0" cellpadding="0">
                                                  <tr>
                                                       <td height="20">
                                                                                                                        <div id="GetOrg">
                                                            <select name="Data[iOrganizationID]" id="" class="required" title="<?php echo $this->_tpl_vars['MSG_SELECT_ORGANIZATION']; ?>
" style="width:200px" onchange='$("#iUserID").load(SITE_URL+"index.php?file=u-aj_getUser&icompid="+$("#iOrganizationID").val()+"&type=User"+"&htmlTag=option"+"&orgtype=user")'>
                                                                <option value=''>---<?php echo $this->_tpl_vars['MSG_SELECT_ORGANIZATION']; ?>
---</option>
                                                            </select>
                                                            </div>
                                                       </td>
                                                       <td>
                                                       &nbsp;&nbsp;
                                                       </td>
                                                       <td>
                                        					        <input type="text" name="orgtxt" value="<?php echo $this->_tpl_vars['orgdata'][0]['orgname']; ?>
" class="input-rag" id="orgtxt" style="width:100px; vertical-align:middle;">
                                                         </td>
                                                         <td>
                                                            &nbsp;&nbsp;
                                                        </td>
                                                         <td>
                                                            <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-search.gif" alt="" border="0" style="cursor: pointer;vertical-align:middle;background: #f8f8f8;border:none;" onclick="getBuyerOrgs();"  />
                                        			           </td>
                                                  </tr>
                                             </table>
                                        </td>
                                   </tr>
                                   <?php else: ?>
                                       <tr>
                                        <td width="130px" valign="top"><?php echo $this->_tpl_vars['LBL_SELECT_ORG']; ?>
&nbsp;<font class="reqmsg"></font> </td>
                                        <td>:</td>
                                        <td>
                                             <table width="228" border="0" cellspacing="0" cellpadding="0">
                                                  <tr>
                                                       <td height="20">
                                                                                                                        <div id="GetOrg">
                                                            <input type="hidden" name="Data[iOrganizationID]" id="iOrganizationID" class="required" value="<?php echo $this->_tpl_vars['orgid']; ?>
" readonly title="<?php echo $this->_tpl_vars['MSG_SELECT_ORGANIZATION']; ?>
" style="width:200px"
                                                      />
                                                      <input type="text" name="Data[iOrganizationID]" id="orgid" class="required" value="<?php echo $this->_tpl_vars['orgname']; ?>
" readonly title="<?php echo $this->_tpl_vars['MSG_SELECT_ORGANIZATION']; ?>
" style="width:200px"
                                                      />
                                                            </div>
                                                       </td>
                                                       <td>
                                                       &nbsp;&nbsp;
                                                       </td>
                                                       <td>
                                                        </td>
                                                         <td>
                                                            &nbsp;&nbsp;
                                                        </td>
                                                         <td>

                                        			           </td>
                                                  </tr>
                                             </table>
                                        </td>
                                   </tr>
                                   <?php endif; ?>
                                   <tr>
                                        <td width="130px" valign="top"><?php echo $this->_tpl_vars['LBL_SELECT_USER']; ?>
 </td>
                                        <td>:</td>
                                        <td>
                                             <table width="228" border="0" cellspacing="0" cellpadding="0">
                                                  <tr>
                                                       <!-- class="securitymanager-white-bg" -->
                                                       <td height="20">
                                                            <!--
                                                            <input type="text" name="vUser" id="vUser" value="" class="input-rag" tabindex="2" title="<?php echo $this->_tpl_vars['MSG_SELECT_ORG']; ?>
"/>
                                                            <input type="hidden" name="Data[iUserID]" id="iUserID" value="" title="<?php echo $this->_tpl_vars['MSG_SELECT_ORG']; ?>
"class="required"/>
                                                            -->
                                                         <div width="200px" id="GetUser">
                                                            <input type="hidden" name="iOrganizationID" id="iOrganizationID" value="<?php echo $this->_tpl_vars['orgdata'][0]['iOrganizationID']; ?>
" title="<?php echo $this->_tpl_vars['MSG_SELECT_ORGANIZATION']; ?>
"/>
                                                            <select name="Data[iUserID]" id="" value="" title="<?php echo $this->_tpl_vars['MSG_SELECT_ORG_USER']; ?>
"class="required" style="width:200px" onchange='getUserStatus(this.value);'>
                                                                <option value="">---<?php echo $this->_tpl_vars['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['LBL_ORG_USER']; ?>
---</option>
                                                            </select>
                                                            </div>
                                                       </td>
                                                       <td>
                                                         &nbsp;&nbsp;
                                                       </td>
                                                       <td>
                                        					        <input type="text" name="username" value="<?php echo $this->_tpl_vars['orgdata'][0]['orgname']; ?>
" class="input-rag" id="username" style="width:100px; vertical-align:middle;">
                                                         </td>
                                                         <td>
                                                            &nbsp;&nbsp;
                                                        </td>
                                                         <td>
                                                            <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-search.gif" alt="" border="0" style="cursor: pointer;vertical-align:middle;background: #f8f8f8;border:none;" onclick="GetUserName();"  />
                                        			           </td>
                                                  </tr>
                                             </table>
                                        </td>

                                   </tr>
                                   <tr>
                                        <td colspan="2" valign="top"><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/spacer.gif" width="1" height="1" alt="" border="0" /></td>
                                   </tr>
											  <tr>
													 <td colspan="3" height="150px;">
															<table>
																  <tr style="display:none;" id="access_row">
																		 <td valign="top"><?php echo $this->_tpl_vars['LBL_ASSIGN_RIGHT_USER']; ?>
 &nbsp;<font class="reqmsg">*</font> </td>
																		 <td>&nbsp;</td>
																		 <td>
																				<div id="OrgStatus_Div" style="overflow-y:auto;width:700px; border:1px solid #cccccc; padding:1px;"></div>
																		 </td>
																  </tr>
																  <tr style="display:none;" id="assign_row">
																		 <td height="30" valign="top">&nbsp;</td>
																		 <td colspan="2">
																			 <img class="pointer" src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-assign.gif" alt="" tabindex="3" style="vertical-align:middle;border:none;background: #f8f8f8;" onclick="frmsubmit();" />
																				<!--&nbsp; <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-cancel.gif" alt="" tabindex="4"  style="cursor:pointer; vertical-align:middle;border:none;background: #f8f8f8;" onclick="history.back();" />-->
																		 </td>
																  </tr>
															</table>
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
     var org = \'';  echo $this->_tpl_vars['orgname'];  echo '\';
     var orgid=\'';  echo $this->_tpl_vars['orgid'];  echo '\';
    $("#iUserID").load(SITE_URL+"index.php?file=u-aj_getUser&icompid="+orgid+"&type=User"+"&htmlTag=option"+"&orgtype=user");

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
     //setuserauto();
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
     function getBuyerOrgs() {
      if($(\'#orgtxt\').val() == \'\') {
          alert("Please Enter organization name");return false;
      }
       var orgtxt = $(\'#orgtxt\').val();
       $(\'#GetOrg\').load(SITE_URL+"index.php?file=or-aj_getBuyerOrg&view=orgright&orgtxt="+orgtxt);
      }
      function GetUserName() {
      if($(\'#username\').val() == \'\') {
          alert("Please Enter Username");return false;
      }
      if($(\'#iOrganizationID\').val() == \'\'){
          alert("Please Select Organization");return false;
      }
       var iOrganizationID= $(\'#iOrganizationID\').val();
		 if(iOrganizationID==\'\' || iOrganizationID==undefined){
			 alert(LBL_SELECT+" "+LBL_ORGANIZATION);
			 return false;
		 }
       var username = $(\'#username\').val();
       $(\'#GetUser\').load(SITE_URL+"index.php?file=or-aj_getBuyerOrg&view=username&username="+username+"&iOrganizationID="+iOrganizationID);
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
          SITE_URL+"index.php?file=u-aj_getUser&icompid="+$(\'#iOrganizationID\').val()+"&type=User",
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
     if(org == \'\') {
          /*$(document).ready(function() {
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
               $(\'#iOrganizationID\').load(SITE_URL+"index.php?file=or-aj_getOrganization"+"&htmlTag=option"+"&isAssoc=no"+"&val=';  echo $this->_tpl_vars['orgdata'][0]['iOrganizationID'];  echo '");
          });*/
     }
     $("#frmassignright").validate();
     if(org != \'\') {
         $(document).ready(function() {
            setuserauto();
         });
     }
function frmsubmit()
{
     $(\'#frmassignright\').submit();
/*     chkbx = $(\'input:checkbox\');
     $.each(chkbx,function(i,el) {
        $(this).attr(\'disabled\',\'\');
     });
     $(\'#frmassignright\').submit( function() {
	    setTimeout("$.each(chkbx,function(i,el) { $(this).attr(\'disabled\',\'disabled\'); });", 1000);
     });
     setTimeout("$.each(chkbx,function(i,el) { $(this).attr(\'disabled\',\'disabled\'); });", 1000);
*/
}
function getUserStatus(res){
    $("#OrgStatus_Div").attr(\'innerHTML\',\'Loading...\');
    $("#OrgStatus_Div").load(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+res);
}
</script>
'; ?>