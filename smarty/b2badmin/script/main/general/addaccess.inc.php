<?php  
/**
 * Access Rights File For Admin
 * @package		addaccess.inc.php
 * @Section		general
*/
//print_r($_SESSION['SESS_A_ROLE']);exit;

if(!isset($adminUserObj)) {
     include_once(SITE_CLASS_APPLICATION.'class.AccessPerModule.php');
     $accModObj = new AccessPerModule();
}
$gdbobj->getRequestVars();


if(isset($_SESSION['SESS_A_ROLE']) && $_SESSION['SESS_A_ROLE'] != 'Premium Admin'){
	//header("Location:index.php?file=ge-noaccess&view=add&AX=Yes");
	//exit;
}

$iAdminId = GetVar('iAdminId');
$type = GetVar('admintype');
$actionfile  = GetVar("file");

$arr = $accModObj->getAcc_Per_ModDetail("*","AND iAdminId = '$iAdminId'");
//prints($arr);exit;

$tListing 	= @explode(",",$arr[0]['tListing']);
$tAdd 		= @explode(",",$arr[0]['tAdd']);
$tUpdate 	= @explode(",",$arr[0]['tUpdate']);
$tDelete 	= @explode(",",$arr[0]['tDelete']);
$tActive 	= @explode(",",$arr[0]['tActive']);
$tInactive 	= @explode(",",$arr[0]['tInactive']);
$tBlock 	= @explode(",",$arr[0]['tBlock']);
$tSearch 	= @explode(",",$arr[0]['tSearch']);

// For the Module List Names
$moduleArr = $gdbobj->getInfoTable("".PRJ_DB_PREFIX."_modules","1","1",""," AND eStatus = 'Active' AND iParentId <> 0 order by iModuleId");
//prints($moduleArr);exit;
//$typearr =  $gdbobj->mysqlEnumValues("".PRJ_DB_PREFIX."_administrator","eType");

$AdminArr	= array(
			"ID"				=>	"iAdminId",
			"Name" 				=>	"Data[iAdminId]",
			"Type"				=>	"Query",
			"tableName" 		=>	"".PRJ_DB_PREFIX."_administrator",
			"fieldId" 			=>	"iAdminId",
			"fieldName"			=>	"concat(vFirstName,' ',vLastName)",
			"concat_fieldName"	=>	"Name",
			"extVal"			=>	'',
			"selectedVal" 		=>	GetVar('iAdminId'),
			"width"  			=>	'200px',
			"height"  			=>	'',
			"onchange" 			=>	'getGroupinfo(this.value)',
			"selectText" 		=>	"--- Select Admin--- ",
			"where" 			=>	"",
			"multiple_select" 	=>	"",
			"orderby" 			=>	'vFirstName',
			"validationmsg"		=>	"Select Admin",
			"extra"				=>	""
			);
$admincomb = $gdbobj->DynamicDropDown($AdminArr);
//Prints($admincomb);exit;
$mode = '';
?>
<script type="text/javascript" src="<?php  echo  S_JQUERY?>jquery.validate.js"></script>
<form name="frmadd" id="frmadd" action="index.php?file=<?php  echo  $actionfile?>&view=action" method="post" enctype="multipart/form-data">
<?php   echo $generalobj->PrintElement("mode","mode",$mode,"Hidden");?>
<?php   echo $generalobj->PrintElement("totModule","totModule",count($moduleArr),"Hidden");?>
<?php   echo $generalobj->PrintElement("actionfile","actionfile",$actionfile,"Hidden");?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<?php  if(GetVar('var_msg') !='') { ?>
<tr id="msgrow" >
	<td height="35" align="center">
	<div id="msg">
			<ul id="top-tabstrips">
				<li><em><?php print GetVar('var_msg');?></em></li>
			</ul>
	</div>
	</td>
</tr>
<?php  }?>
<tr>
	<td valign="top">
		<table width="100%" border="0" class="table-border" cellspacing="0" cellpadding="0">
		<tr>
			<td colspan="2" class="heading">Module & Permission Information</td>
		</tr>
		<tr>
			<td class="td-bg" width="20%" align="right">Select Admin <span class="reqmsg">&nbsp;*</span></td>
			<td class="white-bg">
			<!--<select  name="Data[eAdminType]"  id="eAdminType" onchange="getGroupinfo(this.value);" validationmsg='Select Group' class="input">
				<option value="">--- Select Group ---</option>				
				<option <?php  echo  ($type == 'Premier Admin')? "selected":""?> value="Premier Admin">Premier Admin</option>
				<option <?php  echo  ($type == 'Sub Admin')? "selected":""?> value="Sub Admin">Sub Admin</option>
			</select>-->
			<?php  echo  $admincomb?>
			</td>
		</tr>
		<tr>
			<td colspan="2" class="white-bg">&nbsp;</td>
		</tr>
		<tr>
			<td valign="top" colspan="2">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				
				
				<?php   if(count($moduleArr) > 0){?>
				<tr>
					<td width="20%" height="22"  class="td-bg"></td>
					<td width="10%" class="white-bg" align="center"><input type="Checkbox" name="c1" id="c1" style="border:none" onclick="checkAll(this.id,'view');">&nbsp;View</td>
					<td width="10%"	class="white-bg" align="center"><input type="Checkbox" name="c2" id="c2" style="border:none" onclick="checkAll(this.id,'add');">&nbsp;Add</td>					
					<td width="10%" class="white-bg" align="center"><input type="Checkbox" name="c3" id="c3" style="border:none" onclick="checkAll(this.id,'upd');">&nbsp;Update</td>					
					<td width="10%" class="white-bg" align="center"><input type="Checkbox" name="c4" id="c4" style="border:none" onclick="checkAll(this.id,'del');">&nbsp;Delete</td>										
					<td width="10%" class="white-bg" align="center"><input type="Checkbox" name="c5" id="c5" style="border:none" onclick="checkAll(this.id,'act');">&nbsp;Active</td>					
					<td width="10%" class="white-bg" align="center"><input type="Checkbox" name="c6" id="c6" style="border:none" onclick="checkAll(this.id,'ina');">&nbsp;Inactive</td>
					<td width="10%" class="white-bg" align="center"><input type="Checkbox" name="c7" id="c7" style="border:none" onclick="checkAll(this.id,'block');">&nbsp;Block</td>
					<td width="10%" class="white-bg" align="center"><input type="Checkbox" name="c8" id="c8" style="border:none" onclick="checkAll(this.id,'search');">&nbsp;Search</td>					
					<td width="10%" class="td-bg">&nbsp;</td>
				</tr>
					<?php  for($i=0;$i<count($moduleArr);$i++){?>
				 <tr>
					<td height="22"  align="right" class="td-bg"><?php  echo  $moduleArr[$i]['vModuleName']?></td>
					<td class="white-bg" align="center"><input type="Checkbox" value="<?php  echo  $moduleArr[$i]['iModuleId']?>" name="listing[]" id="view_<?php  echo  $i+1?>" <?php  echo  @in_array($moduleArr[$i]['iModuleId'],$tListing)?"checked":"";?> onclick="javascript:chkrow(this.id);" ></td>
					<td class="white-bg" align="center"><input type="Checkbox" value="<?php  echo  $moduleArr[$i]['iModuleId']?>" name="add[]" id="add_<?php  echo  $i+1?>" <?php  echo  @in_array($moduleArr[$i]['iModuleId'],$tAdd)? "checked":"";?> onclick="javascript:chkrow(this.id);"></td>
					<td class="white-bg" align="center"><input type="Checkbox" name="update[]" id="upd_<?php  echo  $i+1?>" value="<?php  echo  $moduleArr[$i]['iModuleId']?>" <?php  echo  @in_array($moduleArr[$i]['iModuleId'],$tUpdate)? "checked":"";?> onclick="javascript:chkrow(this.id);" ></td>
					<td class="white-bg" align="center"><input type="Checkbox" name="delete[]" id="del_<?php  echo  $i+1?>" value="<?php  echo  $moduleArr[$i]['iModuleId']?>" <?php  echo  @in_array($moduleArr[$i]['iModuleId'],$tDelete)? "checked":"";?> onclick="javascript:chkrow(this.id);" ></td>
					<td class="white-bg" align="center"><input type="Checkbox" name="active[]" id="act_<?php  echo  $i+1?>" value="<?php  echo  $moduleArr[$i]['iModuleId']?>" <?php  echo  @in_array($moduleArr[$i]['iModuleId'],$tActive)? "checked":"";?> onclick="javascript:chkrow(this.id);"></td>
					<td class="white-bg" align="center"><input type="Checkbox" name="inactive[]" id="ina_<?php  echo  $i+1?>" value="<?php  echo  $moduleArr[$i]['iModuleId']?>" <?php  echo  @in_array($moduleArr[$i]['iModuleId'],$tInactive)? "checked":"";?> onclick="javascript:chkrow(this.id);"></td>
					<td class="white-bg" align="center"><input type="Checkbox" name="block[]" id="block_<?php  echo  $i+1?>" value="<?php  echo  $moduleArr[$i]['iModuleId']?>" <?php  echo  @in_array($moduleArr[$i]['iModuleId'],$tBlock)? "checked":"";?> onclick="javascript:chkrow(this.id);"></td>
					<td class="white-bg" align="center"><input type="Checkbox" name="search[]" id="search_<?php  echo  $i+1?>" value="<?php  echo  $moduleArr[$i]['iModuleId']?>" <?php  echo  @in_array($moduleArr[$i]['iModuleId'],$tSearch)? "checked":"";?> onclick="javascript:chkrow(this.id);"></td>
					<td class="td-bg">&nbsp;</td>															
				</tr>
				<?php   }
				}?>
				</table>
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td valign="top">&nbsp;</td>
</tr>
<tr>
	<td valign="top" align="center">
		<input type="image" style="cursor:pointer" alt="btnSave" title="btnSave"  id="btnSave" name="btnSave" src="<?php  echo  ADMIN_IMAGES?>btn-save.gif">
		<input type="image" alt="Reset" title="Reset" style="cursor:pointer" src="<?php  echo  ADMIN_IMAGES?>btn-reset.gif" onclick="reset();return false;">
<!--		<img style="cursor:pointer" alt="Cancel" title="Cancel" src="<?php  //=ADMIN_IMAGES?>btn-cancle.gif" onclick="return RedirectURL('index.php?file=<?php  //=$actionfile?>&view=index&AX=Yes');">-->
	</td>
</tr>
<tr>
	<td valign="top">&nbsp;</td>
</tr>
</table>
</form>
<script type="text/javascript">
/*
$('iAdminId').focus();
new Validator({ 
        formId: 'frmadd', 
		btnId:'btnSave',
        isRequired: ['iAdminId']
	});
*/
function checkAll(id,val)
{
     //alert($('input[id='+id+']').is(':checked'));
	var rs = ($('input[id='+id+']').is(':checked'))?true:false;
     
	for(i=0;i<document.frmadd.elements.length;i++)
	{
		var chkid =  document.frmadd.elements[i].id.split("_");		
	  	if(chkid[0] == val)
  		{
	  		
			document.frmadd.elements[i].checked = rs;
		}
		
		if(chkid[1] == 1 || chkid[1] == 3)
		{
			document.getElementById("add_"+chkid[1]).checked = rs;
			document.getElementById("upd_"+chkid[1]).checked = rs;
		}
	}		
	
	if(id=='c1' && $('input[id=c1]').is(':checked') == false)
	{
		for(i=0;i<document.frmadd.elements.length;i++)
		{
			document.frmadd.elements[i].checked = false;
		}
	}
	if(id!='c1')
	{	
		
		if(rs != false)
		{	
			$('input[id=c1]').attr('checked', rs);
			for(i=0;i<document.frmadd.elements.length;i++)
			{
				var chkid =  document.frmadd.elements[i].id.split("_");		
			  	if(chkid[0] == 'view')
		  		{
					document.frmadd.elements[i].checked = rs;
				}
			}
		}	
	}
}
function chkrow(id)
{	
	var res= ($('input[id='+id+']').is(':checked'))?true:false;
	var postfix = id.split("_");	
	if(res == true)
	{
		for(i=0;i<document.frmadd.elements.length;i++)
		{
			var chkid =  document.frmadd.elements[i].id;				
			if(chkid == 'view_'+postfix[1])
		  	{
		  		if(postfix[1] == 1 || postfix[1] == 3)
		  		{
		  			document.getElementById("add_"+postfix[1]).checked = res;
		  			document.getElementById("upd_"+postfix[1]).checked = res;
		  		}
				document.frmadd.elements[i].checked = res;
			}
		}
	}
	if(postfix[0]=='view' && res == false)	
	{		
		for(i=0;i<document.frmadd.elements.length;i++)
		{
			var chkid =  document.frmadd.elements[i].id.split("_");	
			if(chkid[0] == 'add'&& chkid[1]==postfix[1]){
				document.frmadd.elements[i].checked = res;
			}else if(chkid[0] == 'upd'&& chkid[1]==postfix[1]){
				document.frmadd.elements[i].checked = res;				
			}else if(chkid[0] == 'del'&& chkid[1]==postfix[1]){
				document.frmadd.elements[i].checked = res;				
			}else if(chkid[0] == 'act'&& chkid[1]==postfix[1]){
				document.frmadd.elements[i].checked = res;				
			}else if(chkid[0] == 'ina'&& chkid[1]==postfix[1]){
				document.frmadd.elements[i].checked = res;				
			}else if(chkid[0] == 'block'&& chkid[1]==postfix[1]){
				document.frmadd.elements[i].checked = res;				
			}else if(chkid[0] == 'search'&& chkid[1]==postfix[1]){
				document.frmadd.elements[i].checked = res;				
			}					
		}
	}
}
function getGroupinfo(val)
{
	ext = "";
	if(val != ''){
		ext= "&iAdminId="+val;
	}
	window.location = ADMIN_URL+"index.php?file=ge-access&view=edit&AX=Yes"+ext;
	return false;
}

$("#frmadd").validate( {
     rules: {
          "Data[iAdminId]": {
               required:true
          }
     },
     messages: {
          "Data[iAdminId]": {
               required:"Select Admin"
          }
     }
})
</script>