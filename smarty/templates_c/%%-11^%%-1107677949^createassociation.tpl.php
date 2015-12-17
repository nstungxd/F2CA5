<?php /* Smarty version 2.6.0, created on 2012-05-31 11:40:10
         compiled from member/organization/createassociation.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'assign', 'member/organization/createassociation.tpl', 78, false),)), $this); ?>
<form name="frmcreateassocs" id="frmcreateassocs" action="<?php echo $this->_tpl_vars['SITE_URL']; ?>
index.php?file=or-createassociation_a" method="post">
<input type="hidden" name="iAsociationID" id="iAsociationID"value="<?php echo $this->_tpl_vars['iAsociationID']; ?>
" />
<input type="hidden" name="view" id="view"value="<?php echo $this->_tpl_vars['view']; ?>
" />
<input type="hidden" name="del[]" id="del"value="" />
<div class="middle-container">
<h1><?php echo $this->_tpl_vars['LBL_CREATE_ASSOCIATION']; ?>
</h1>
<div class="middle-containt">
	<div class="statistics-main-box-white">
		<div>
			<ul id="inner-tab">
				<li><a class="current"><em><?php echo $this->_tpl_vars['LBL_ASSOCIATION']; ?>
</em></a></li>
		   </ul>
      </div>
		<div class="clear"></div>
		<div class="inner-gray-bg" style="height:439px;"> 			<div>&nbsp;</div>
			<div>
            <span id="prc" style="display:none; float:right;"> <img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/progress.gif" /> Processing ... </span>
				  <?php if ($this->_tpl_vars['msg'] != ''): ?>
				                    		 <?php endif; ?>
				<table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="black">
				  <tr>
					 <td width="198" valign="top"><?php if ($this->_tpl_vars['view'] == 'edit'):  echo $this->_tpl_vars['LBL_ASSOCIATION_CODE']; ?>
&nbsp;<font class="reqmsg">*</font> <?php endif; ?></td>
                <td><?php if ($this->_tpl_vars['view'] == 'edit'): ?>:<?php endif; ?></td>
					 <td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td align="left">
								<input type="hidden" name="Data[vAssociationCode]" id="vAssociationCode" value="<?php echo $this->_tpl_vars['vAssociationCode']; ?>
" />
								<input type="hidden" name="iAsociationID" id="iAsociationID" value="<?php echo $this->_tpl_vars['iAsociationID']; ?>
" />
							</td>
							 <td height="20" align="left">
								 <?php if ($this->_tpl_vars['view'] == 'edit'): ?>
									<b><?php echo $this->_tpl_vars['vAssociationCode']; ?>
</b>
																	 <?php endif; ?>
							 </td>
                      <td align="right"></td>
						  </tr>
						</table>
					</td>
					</tr>
				  <tr>
					 <td width="198" valign="top"><?php echo $this->_tpl_vars['LBL_SELECT_BUYER_ORG']; ?>
&nbsp;<font class="reqmsg">*</font> </td>
               <td >:</td>
               <td>
					 						<table width="228" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							   <td height="20" >
									<!-- <?php if ($this->_tpl_vars['orgname'] != ''): ?>

										  <input type="text" name="vOrg" id="vOrg" value="<?php echo $this->_tpl_vars['orgname']; ?>
" class="input-rag required" readonly="readonly" title="<?php echo $this->_tpl_vars['MSG_SELECT_ORGANIZATION']; ?>
"/>
										  <input type="hidden" name="Data[iBuyerOrganizationID]" id="iBuyerOrganizationID" value="<?php echo $this->_tpl_vars['orgdata'][0]['iOrganizationID']; ?>
" title="<?php echo $this->_tpl_vars['MSG_SELECT_BUYER_ORGANIZATION']; ?>
"/>
									<?php else: ?>

										  <input type="hidden" name="Data[iBuyerOrganizationID]" id="iBuyerOrganizationID" value="<?php echo $this->_tpl_vars['assorgdt'][0]['iBuyerOrganizationID']; ?>
" title="<?php echo $this->_tpl_vars['MSG_SELECT_BUYER_ORGANIZATION']; ?>
"/>
										  <input type="text" name="vOrg" id="vOrg" <?php if ($this->_tpl_vars['view'] == 'edit'): ?> readonly  autocomplete="off" <?php endif; ?> value="<?php echo $this->_tpl_vars['assorgdt'][0]['vBuyerOrg']; ?>
" class="input-rag required" title="<?php echo $this->_tpl_vars['MSG_SELECT_ORGANIZATION']; ?>
"/>
									<?php endif; ?> -->
    								<?php if ($this->_tpl_vars['view'] == 'edit'): ?>
    									<?php echo smarty_function_assign(array('var' => 'readonly','value' => 'DISABLED'), $this);?>

    									<input type="hidden" name="Data[iBuyerOrganizationID]" id="iBuyerOrganizationID" value="<?php echo $this->_tpl_vars['assorgdt'][0]['iBuyerOrganizationID']; ?>
" title="<?php echo $this->_tpl_vars['MSG_SELECT_BUYER_ORGANIZATION']; ?>
"/>
										<div id="BuyerOrg">
										<select name="iBuyerOrganizationID" value=" " id="" style="width:230px;" <?php echo $this->_tpl_vars['readonly']; ?>
>
											<option value="">---<?php echo $this->_tpl_vars['MSG_SELECT_BUYER_ORGANIZATION']; ?>
---</option>
											<option value="<?php echo $this->_tpl_vars['assorgdt'][0]['iBuyerOrganizationID']; ?>
" selected="selected"><?php echo $this->_tpl_vars['orgdata'][0]['vCompanyName']; ?>
</option>
										</select>
										</div>
									<?php else: ?>
										<?php if ($this->_tpl_vars['uoa'] == 'yes'): ?>
											<input type="hidden" name="Data[iBuyerOrganizationID]" id="iBuyerOrganizationID" value="<?php echo $this->_tpl_vars['bodt'][0]['iOrganizationID']; ?>
" >
											<input type="text" name="iBuyerOrganizationID" id="iBuyerOrgID" value="<?php echo $this->_tpl_vars['bodt'][0]['vCompanyName']; ?>
" readonly="readonly" />
										<?php else: ?>
										<div id="BuyerOrg">
										<select name="Data[iBuyerOrganizationID]" id="iBuyerOrganizationID" style="width:230px;" <?php if ($this->_tpl_vars['uoa'] == 'yes'): ?>disabled="disabled"<?php endif; ?>>
											<option value="">---<?php echo $this->_tpl_vars['MSG_SELECT_BUYER_ORGANIZATION']; ?>
---</option>
										</select>
										</div>
										<?php endif; ?>
    								<?php endif; ?>
								 </td>
								  <td>
								      &nbsp;&nbsp;
								  </td>
							<?php if ($this->_tpl_vars['view'] == 'edit'): ?>
							<td colspan="3">&nbsp;</td>
							<?php elseif ($this->_tpl_vars['uoa'] != 'yes'): ?>
					      <td>
					         <input type="text" name="orgtxt" value="<?php echo $this->_tpl_vars['orgdata'][0]['orgname']; ?>
" class="input-rag" id="orgtxt" style="width:100px; vertical-align:middle;">
							</td>
							<td>&nbsp;&nbsp;</td>
							<td>
								<img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-search.gif" alt="" border="0" style="cursor: pointer;vertical-align:middle;background: #f8f8f8;border:none;" onclick="getBuyerOrgs();" />
							</td>
							<?php endif; ?>
						</tr>
						</table>
						</td>
						</td>
				  	</tr>
					  <tr>
						 <td valign="top"><?php echo $this->_tpl_vars['LBL_SELECT_SELLER_ORG']; ?>
&nbsp;<font class="reqmsg">*</font> </td>
                               <td valign="top" >:</td>
						 <td>
							<table width="486" border="0" cellspacing="0" cellpadding="0">
                                     <tr>
                                          <td height="20" style="padding-left: 4px;">
									 <?php echo $this->_tpl_vars['LBL_COMP_REG_NO']; ?>
 &nbsp;
                                              <?php echo $this->_tpl_vars['LBL_ORG_CODE']; ?>
 &nbsp;
                                              <?php echo $this->_tpl_vars['LBL_ORG_NAME']; ?>
 &nbsp;
								 </td>
							  </tr>
							  	<tr>
								<td height="30" valign="top">
									<input type="text" name="regno" value="<?php echo $this->_tpl_vars['orgdata'][0]['regno']; ?>
" class="input-rag" id="regno" style="width:100px; vertical-align:middle;" > &nbsp;
									<input type="text" name="orgcode" value="<?php echo $this->_tpl_vars['orgdata'][0]['orgcode']; ?>
" class="input-rag" id="orgcode" style="width:100px; vertical-align:middle;"> &nbsp;
									<input type="text" name="orgname" value="<?php echo $this->_tpl_vars['orgdata'][0]['orgname']; ?>
" class="input-rag" id="orgname" style="width:100px; vertical-align:middle;">
									<img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-search.gif" alt="" border="0" style="cursor: pointer;vertical-align:middle;background: #f8f8f8;border:none;" onclick="getSellerOrgs();"  />
								</td>
							  	</tr>
							  	<tr>
								<td class="light-golden-bor"  height="35">
									<div id="result" align="center"><?php echo $this->_tpl_vars['LBL_ORG_NOT_FOUND']; ?>
</div>
								</td>
								</tr>
								<tr>
									<td  height="5" style="padding-top:5px;">
									<img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-insert.gif" id="insert_btn"  alt=""  style="cursor: pointer;vertical-align:middle;border:none;background: #f8f8f8;display:none;"/>
									<img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-reset.gif" alt="" id="reset_btn" border="0" style="cursor: pointer;vertical-align:middle;border:none;background: #f8f8f8;" onclick="resetform();return false;"/>
									</td>
								</tr>
								<tr><td>&nbsp;</td></tr>
								<tr>
									<td style="padding-top:5px;">
									  									<div  style="height: 100px;overflow-y:auto;">
										<div id="assocs" class="textarea-security" >
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
												 <?php echo smarty_function_assign(array('var' => 'indx','value' => $this->_tpl_vars['res'][$this->_sections['i']['index']]['iOrganizationID']), $this);?>

											 <div id="asso<?php echo $this->_tpl_vars['res'][$this->_sections['i']['index']]['iOrganizationID']; ?>
" <?php if ($this->_sections['i']['index']%2 == 0): ?>style="background:#eeeeee;"<?php endif; ?>>
												<img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
arrow.gif" /> &nbsp;
												<span style="display:inline-block; width:430px;"><b>(<span id="sellcode<?php echo $this->_tpl_vars['res'][$this->_sections['i']['index']]['iOrganizationID']; ?>
"><?php echo $this->_tpl_vars['newarr'][$this->_tpl_vars['indx']]['vSupplierCode']; ?>
</span>) &nbsp;[Seller Organization: <?php echo $this->_tpl_vars['res'][$this->_sections['i']['index']]['vCompanyName']; ?>
(<?php echo $this->_tpl_vars['res'][$this->_sections['i']['index']]['vOrganizationCode']; ?>
)]</b> &nbsp;</span>
												<span><img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/icon-cancel.gif" onclick="delasso('<?php echo $this->_tpl_vars['res'][$this->_sections['i']['index']]['iOrganizationID']; ?>
');" /></span>
												<input type="hidden" name="assocorgs[]" id="assocorgs<?php echo $this->_tpl_vars['res'][$this->_sections['i']['index']]['iOrganizationID']; ?>
" value="<?php echo $this->_tpl_vars['res'][$this->_sections['i']['index']]['iOrganizationID']; ?>
" />
												<input type="hidden" name="suporgcode[]" id="suporgcode<?php echo $this->_tpl_vars['res'][$this->_sections['i']['index']]['iOrganizationID']; ?>
" value="<?php echo $this->_tpl_vars['res'][$this->_sections['i']['index']]['vOrganizationCode']; ?>
" />
												<input type="hidden" name="assocCode[]" id="assocCode<?php echo $this->_tpl_vars['res'][$this->_sections['i']['index']]['iOrganizationID']; ?>
" value="<?php echo $this->_tpl_vars['newarr'][$this->_tpl_vars['indx']]['vSupplierCode']; ?>
" />
											 </div>
											 <?php endfor; endif; ?>
										</div>
									  </div>
								 </td>
							  </tr>
							</table>
						 </td>
					  </tr>
					<tr>
						<td valign="top">&nbsp;</td>
						<td colspan="2">
							<img src="<?php echo $this->_tpl_vars['SITE_IMAGES']; ?>
sm_images/btn-submit.gif" alt="" id="btnSubmit" border="0" style="cursor: pointer;vertical-align:middle;cursor:pointer;border:none;background: #f8f8f8;" onclick="return submitfrm();" /> &nbsp;
						</td>
					</tr>
				</table>
			</div>
			<div>&nbsp;</div>
		</div>
	</div>
</div>
<input type="hidden" name="m" id="m" value="" />
<input type="hidden" name="vm" id="vm" value="" />
<input type="hidden" name="vms" id="vms" value="" />
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
var org = \'';  echo $this->_tpl_vars['orgname'];  echo '\';
var val="";
if(view == \'edit\') {
     var totValID = \'';  echo $this->_tpl_vars['assorgdt'][0]['iBuyerOrganizationID'];  echo '\';
     $(\'#result\').load(SITE_URL+"index.php?file=or-aj_getSellerOrgAsso&iAsociationID="+$(\'#iAsociationID\').val()+"&iBuyerOrganizationID="+totValID+"&view="+view);
}
var val="';  echo $this->_tpl_vars['orgdata'][0]['iBuyerOrganizationID'];  echo '";
// $(\'#iBuyerOrganizationID\').load(SITE_URL+"index.php?file=or-aj_getOrganization&orgtype=buyer&orgid="+$(\'#iSupplierAssocationID\').val()+"&htmlTag=option"+"&isAssoc=yes"+"&val="+val);


var assono = 0;
$(\'#saved_itms\').hide();
if(view != \'edit\') {
	$(\'#btnSubmit\').hide();
}
function getSellerOrgs() {
    if($(\'#iBuyerOrganizationID\').val() == \'\') {
        alert(MSG_SELECT_BUYER_ORGANIZATION);return false;
    }

    if($(\'#regno\').val() == \'\' && $(\'#orgcode\').val() == \'\' && $(\'#orgname\').val() == \'\') {
        alert(LBL_ENTER_COMP_REG_CODE_NAME);return false;
    }
    totValID = $(\'#iBuyerOrganizationID\').val();
   $(\'#result\').load(SITE_URL+"index.php?file=or-aj_getSellerOrgAsso&iAsociationID="+$(\'#iAsociationID\').val()+"&iBuyerOrganizationID="+totValID+"&orgname="+escape($(\'#orgname\').val())+"&orgcode="+escape($(\'#orgcode\').val())+"&regno="+escape($(\'#regno\').val()));
}
function getBuyerOrgs() {
    if($(\'#orgtxt\').val() == \'\') {
        alert(MSG_ENTER_BUYER_ORGANIZATION_NAME);return false;
    }

   var orgtxt = $(\'#orgtxt\').val();
   $(\'#BuyerOrg\').load(SITE_URL+"index.php?file=or-aj_getBuyerOrg&view=asociation&orgtxt="+orgtxt+"&orgtyp=Buyer");
}
$(\'#reset_btn\').click( function () {
//   $(\'#tAssocs\').find(\'option\').remove();
	if(view != \'edit\') {
		$(\'#assocs\').attr(\'innerHTML\',\'\');
	}
     $(\'#btnSubmit\').hide();
});

function delasso(vl)
{
     if($(\'#del\').val() != \'\') {
          $(\'#del\').val($(\'#del\').val()+\',\'+vl);
     } else {
          $(\'#del\').val(vl);
     }
	$(\'#asso\'+vl).attr(\'innerHTML\',\'\');
	$(\'#asso\'+vl).css(\'height\',\'0px\');

       if(view == \'edit\')
            $(\'#btnSubmit\').show();
       else {
            var empty=0;
           $.each($(\'#assocs div\'),function(i,el){
             if($(this).html()=="")
                  {
                  empty++;
                  }
            });
       if(empty == $(\'#assocs div\').length)
            $(\'#btnSubmit\').hide();
       }
}

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
   $(\'#iBuyerOrganizationID\').val(totValID);
   $(\'#tUserID\').find(\'option\').remove();
   //$(\'#result\').load(SITE_URL+"index.php?file=u-aj_getOrganizationUser&type=user&iId="+totValID+"");
   $(\'#OrgStatus_Div\').load(SITE_URL+"index.php?file=or-aj_getOrganizationStatus&type=user&iId="+totValID+"");
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
if(org == \'\') {
     $(document).ready(function() {
          /*$("#vOrg").autocomplete(
               SITE_URL+"index.php?file=or-aj_getOrganization&orgtype=buyer&orgid="+$(\'#iSupplierAssocationID\').val(),
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
          );*/
          $("#vSOrg").autocomplete(
               SITE_URL+"index.php?file=or-aj_getOrganization&orgtype=supplier&orgid="+$(\'#iBuyerOrganizationID\').val(),
               {
                    delay:10,
                    minChars:1,
                    matchSubset:1,
                    matchContains:1,
                    cacheLength:10,
                    onItemSelect:selectSItem,
                    onFindValue:findSValue,
                    formatItem:formatSItem,
                    autoFill:false
               }
          );
     });
}


function findSValue(li) {
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
   $(\'#iSupplierAssocationID\').val(totValID);
   $(\'#tUserID\').find(\'option\').remove();
   //$(\'#result\').load(SITE_URL+"index.php?file=u-aj_getOrganizationUser&type=user&iId="+totValID+"");
   $(\'#OrgStatus_Div\').load(SITE_URL+"index.php?file=or-aj_getOrganizationStatus&type=user&iId="+totValID+"");
}

function selectSItem(li) {
	findSValue(li);
}
function formatSItem(row) {
   var totVal = row[0];
   var totValID;
   var totValRes;
   totVal = totVal.split(\'</span>\');
   totValID = totVal[0].replace("<span style=\'display:none\'>");
   totValRes = totVal[1];
   return totValRes;
}
if(view != \'edit\')
{
	$("#frmcreateassocs").validate({
		rules: {
			"Data[vAssociationCode]": {
				remote:{
				url:SITE_URL+"index.php?file=or-aj_chkdupdata",
                  type:"get",
                  data:{
							val:function() {
								return $("#iAsociationID").val();
							},
							id:function() {
								return "iAsociationID";
							},
							field:function() {
								return "vAssociationCode";
							},
							table:function() {
								return "';  echo $this->_tpl_vars['PRJ_DB_PREFIX'];  echo '_organization_association";
							}
						}
				}
			}
		},
		messages:{
         "Data[vAssociationCode]": {
				remote: jQuery.validator.format(LBL_ASSOCIATION_CODE_IN_USE)
			}
		}
	});
}
else {
	$("#frmcreateassocs").validate();
}
function submitfrm()
{
	asorgs = $(\'input[name="assocorgs\\[\\]"]\')
     if(view == \'edit\') {
          $(\'#frmcreateassocs\').submit();
     } else {
         if(asorgs.length == 0)
			{
				$(\'#assocs\').attr(\'innerHTML\',\'<font color="red">\'+LBL_NO_ASSOCIATIONS_CREATED+\'</font>\');
				return false;
			}
			$(\'#frmcreateassocs\').submit();
     }
}

function resetform() {
	$(\'#frmcreateassocs\')[0].reset();
}
var rex = \'\';
function ajresp (resp) {
   if(resp==\'exists\') {
      rex = \'y\';
   } else {
      rex = \'n\';
   }
   $(\'#prc\').hide();
}
$(document).ready( function() {
	$(function() {
		$(\'#pane2\').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15});
	});

	$(\'#insert_btn\').click( function () {
    orgs = $(\'input:checkbox[name="orgid\\[\\]"]\');
	// chkorg = $(\'input:checked[name="orgid\\[\\]"]\');
	 if(orgs.length <1 && $(\'#vm\').val()!=LBL_SELECT_SELLER_ORG) {
		alert(LBL_SELECT_SELLER_ORG);
		$(\'#vm\').val(LBL_SELECT_SELLER_ORG);
	 } else {
		$(\'#vm\').val(\'\');
	 }
    $.each(orgs, function (ln,el) {
       if($(this).attr(\'checked\') == true) {
          var id = $(this).attr(\'id\');
          var orId = $(this).val();
          var assocCode = $(\'#vAssociationCode\'+orId+\'\').val();
				if($.trim(assocCode) == \'\' && $(\'#vms\').val()!=LBL_ENTER_SUPPLIER_ASSOCIATION_CODE)
				{
					alert(LBL_ENTER_SUPPLIER_ASSOCIATION_CODE);
					$(\'#vms\').val(LBL_ENTER_SUPPLIER_ASSOCIATION_CODE);
					$(\'#vAssociationCode\'+orId+\'\').focus();
					return false;
				} else if($.trim(assocCode) == \'\') {
					$(\'#vms\').val(\'\');
					return false;
				} else {
					$(\'#vms\').val(\'\');
				}
				var orName = $(\'#cmpname\'+orId+\'\').val();
				var orCode = $(\'#cmporgcode\'+orId+\'\').val();
               var chkvalue = 0;
               var url = SITE_URL+"index.php?file=or-aj_chkdupascode";
               var pars = "&borgid="+$(\'#iBuyerOrganizationID\').val()+"&ascode="+assocCode;    // http://192.168.33.200/B2B/index.php?file=u-aj_polist_a&borgid=29&ascode=2
               // alert(url+pars);
               $(\'#prc\').show();
               $.ajax({type:"POST", url:url, data:pars, async:false, success:ajresp});
               if(rex==\'y\') {
                  alert(LBL_SUPPLIER_ASSOCIATION_CODE+\' "\'+assocCode+\'" \'+LBL_IS_ALREADY_IN_USE);
                  return false;
               }
				asorgs = $(\'input[name="assocorgs\\[\\]"]\');
                
				if(asorgs.length > 0) {
					var ciu = \'n\';
					$.each(asorgs,function() {
						if($(\'#assocCode\'+$(this).val()).val()==assocCode) {
							ciu = \'y\';
							alert(LBL_SUPPLIER_ASSOCIATION_CODE+\' "\'+assocCode+\'" \'+LBL_IS_ALREADY_IN_USE);
							return false;
						}
                         if($(this).val() == orId) {
                              var sellcode = $(\'#vAssociationCode\'+orId+\'\').val();
                              $(\'#sellcode\'+orId+\'\').attr(\'innerHTML\',sellcode);
                              $(\'#assocCode\'+orId+\'\').val(sellcode);
                            chkvalue++;
                            $(\'#btnSubmit\').show();
                         }
					});
					if(chkvalue==0 && ciu==\'n\') {
                    //alert(\'yrs\');
						  $(\'#assocs\').append(\'<div id="asso\'+orId+\'" style="background:#efecfe;"><img src="\'+SITE_IMAGES+\'arrow.gif" /> &nbsp; <span style="display:inline-block; width:430px;"><b>(<span id="\'+\'sellcode\'+orId+\'">\' + assocCode + \'</span>) &nbsp; \' + \'[Seller Organization: \' + orName + \'(\' + orCode + \')\' + \']</b> &nbsp;</span> <span><img src="\'+SITE_IMAGES+\'sm_images/icon-cancel.gif" onclick="delasso(\'+orId+\');" /></span>\' + \'<input type="hidden" name="assocorgs[]" id="assocorgs\'+orId+\'" value="\'+orId+\'" /> <input type="hidden" name="suporgcode[]" id="suporgcode\'+orId+\'" value="\'+orCode+\'" /> <input type="hidden" name="assocCode[]" id="assocCode\'+orId+\'" value="\'+assocCode+\'" /> \' + \'<div>\');
						  $(\'#btnSubmit\').show();
                }
            } else if(ciu!=\'y\') {
					$(\'#assocs\').attr(\'innerHTML\',\'\');
               // $(\'#tAssocs\').append($("<option></option>").attr("value",\'\'+orId+\'\').attr(\'selected\',\'selected\').text(\'\'+assocName+\'\'));
					// $(\'#assocs\').append(\'<div id="asso\'+orId+\'"><img src="\'+SITE_IMAGES+\'arrow.gif" /> &nbsp; <b>\' + assocName + \'(\' + assocCode + \') &nbsp; \' + \'[Seller Organization: \' + orName + \'(\' + orCode + \')\' + \']</b> &nbsp; <img src="\'+SITE_IMAGES+\'sm_images/icon-cancel.gif" onclick="delasso(\'+orId+\');" />\' + \'<input type="hidden" name="assocorgs[]" id="assocorgs\'+orId+\'" value="\'+orId+\'" />\' + \'<div>\');
					$(\'#assocs\').append(\'<div id="asso\'+orId+\'"><img src="\'+SITE_IMAGES+\'arrow.gif" /> &nbsp; <span style="display:inline-block; width:430px;"><b>(<span id="\'+\'sellcode\'+orId+\'">\' + assocCode + \'</span>) &nbsp; \' + \'[Seller Organization: \' + orName + \'(\' + orCode + \')\' + \']</b> &nbsp;</span> <span><img src="\'+SITE_IMAGES+\'sm_images/icon-cancel.gif" onclick="delasso(\'+orId+\');" /></span>\' + \'<input type="hidden" name="assocorgs[]" id="assocorgs\'+orId+\'" value="\'+orId+\'" /> <input type="hidden" name="suporgcode[]" id="suporgcode\'+orId+\'" value="\'+orCode+\'" /> <input type="hidden" name="assocCode[]" id="assocCode\'+orId+\'" value="\'+assocCode+\'" />\' + \'<div>\');
					$(\'#btnSubmit\').show();
            }
        }
    });
	});
});
</script>
'; ?>


<?php if ($this->_tpl_vars['msg'] != ''):  echo '
<script>
$(document).ready(function() {
	var msg=\'';  echo $this->_tpl_vars['msg'];  echo '\';
	if(msg!= \'\' && msg != undefined && $(\'m\').val()!=msg) {
		alert(msg);
		$(\'m\').val(msg);
	}
});
</script>
'; ?>

<?php endif; ?>