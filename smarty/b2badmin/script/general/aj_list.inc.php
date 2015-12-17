<?php
$eStatus = "Search";
$start = "0";
$stat = "0";
$sorton = "0";
//prints($TableArr_inc);
$js_field_var = "";
$js_ExtraPara_var = (isset($js_ExtraPara_var))? $js_ExtraPara_var : '';
$catArr = (isset($catArr))? $catArr : '';
$catArr1 = (isset($catArr1))? $catArr1 : '';
$js_TableArr_var = "TableArr = new Array(".implode(",\n\t", $TableArr_inc).");";
$js_field_var = "Field_arr = new Array(".@implode(",\n\t", $field_arr_inc).");";
//echo $alpha_rs;exit;

/* Array For Member Combo */
$memberCombArr = array(
			"ID"				=>	"iMemberId",
			"Name" 				=>	"iMemberId",
			"Type"				=>	"Query",
			"tableName" 		=>	"hfin_member",
			"fieldId" 			=>	"iMemberId",
			"fieldName"			=>	"concat(vFirstname,' ',vLastname)",
			"extVal"			=>	'',
			"selectedVal" 		=>	GetVar('iMemberId'),
			"width"  			=>	'200px',
			"height"  			=>	'',
			"onchange" 			=>	'new AjaxListing({eStatus: "Search", sorton: "'.$sorton.'", st: "'.$start.'"});',
			"selectText" 		=>	"--- Select Member---",
			"where" 			=>	"eStatus = 'Active'",
			"multiple_select" 	=>	"",
			"orderby" 			=>	'vFirstname',
			"extra"				=>	""
			);

$FaqcatCombArr	= array(
			"ID"				=>	"iFCId",
			"Name" 				=>	"iFCId",
			"Type"				=>	"Query",
			"tableName" 		=>	"hfin_faq_cate",
			"fieldId" 			=>	"iFCId",
			"fieldName"			=>	"vFCategory",
			"extVal"			=>	'',
			"selectedVal" 		=>	GetVar('iFCId'),
			"width"  			=>	'200px',
			"height"  			=>	'',
			"onchange" 			=>	'new AjaxListing({eStatus: "Search", sorton: "'.$sorton.'", st: "'.$start.'"});',
			"selectText" 		=>	"--- Select Faq Category--- ",
			"where" 			=>	"",
			"multiple_select" 	=>	"",
			"orderby" 			=>	'vFCategory',
			"extra"				=>	""
			);

/* Array For Member Combo */
$userCombArr = array(
			"ID"				=>	"iUserId",
			"Name" 				=>	"iUserId",
			"Type"				=>	"Query",
			"tableName" 		=>	"wpm_user",
			"fieldId" 			=>	"iUserId",
			"fieldName"			=>	"concat(vFirstname,' ',vLastname)",
			"extVal"			=>	'',
			"selectedVal" 		=>	GetVar('iUserId'),
			"width"  			=>	'200px',
			"height"  			=>	'',
			"onchange" 			=>	'new AjaxListing({eStatus: "Search", sorton: "'.$sorton.'", st: "'.$start.'"});',
			"selectText" 		=>	"--- Select User---",
			"where" 			=>	"eStatus = 'Active'",
			"multiple_select" 	=>	"",
			"orderby" 			=>	'vFirstname',
			"extra"				=>	""
			);

require_once(SITE_CLASS_GEN."class.general.php");
$generalobj=new General();

//exit;
foreach($Field_arr as $datearr)
{
//|| $datearr[7] == 'Time_Format'
	if($datearr[7] == 'DateTime' || $datearr[7] == 'Time_Format'){
		$dateids[]= $datearr[0];
	}
}
$editArgu="";
if(stripos($_SERVER['QUERY_STRING'],"&eStatus"))
$editArgu = substr($_SERVER['QUERY_STRING'],stripos($_SERVER['QUERY_STRING'],"&eStatus"));
//echo $editArgu;exit;
$datesId = @implode(',',$dateids);
?>
<?php  if($editArgu){?>
<input type="hidden" id="editArguVar" value="<?php  echo  $editArgu?>">
<?php  }?>
<script>
RECLIMIT 			= '<?php echo $REC_LIMIT ?>';		// Record Limit on one screen for one page..
var datesId = '<?php echo $datesId ?>';

// Page limit on one screen
<?php  echo  $js_field_var ?>;								// Table Field Array
<?php  echo  $js_ExtraPara_var ?>;							// Extra Param Array
<?php  echo  $js_TableArr_var ?>;							// Table Name Array
<?php  echo  $catArr; ?>
<?php  echo  $catArr1; ?>
</script>
<script language="JavaScript1.2" src="<?php  echo  A_M_AJAX_JS?>ajax_grid.js"></script>
<script language="JavaScript1.2" src="<?php  echo  DATEPICKER?>date.js"></script>
<!--[if IE]><script type="text/javascript" src="<?php  echo  DATEPICKER?>jquery.bgiframe.min.js"></script><![endif]-->
<script language="JavaScript1.2" src="<?php  echo  DATEPICKER?>jquery.datePicker.js" async="async"></script>
<?php  if($_GET['file'] == 'ge-languagelebel'){?>
<script>
	var messages = new Array();
</script>
<script language="JavaScript">
function blockError()
{
	return true;
}
//window.onerror = blockError;
</script>
<SCRIPT type="text/javascript" src="<?php  echo  A_G_JS?>jtooltip.js"></SCRIPT>
<?php   }?>
<link href="<?php  echo  DATEPICKER?>datePicker.css" rel="stylesheet" type="text/css" />
<form name="frmlist" id="frmlist" method="post"  enctype="multipart/form-data">
<input type="hidden" name="sessadminid" id="sessadminid" value="<?php  echo  $_SESSION[''.PRJ_CONST_PREFIX.'_SESS_USERID']?>">
<input type="hidden" name="updatelink" id="updatelink" value="<?php  echo  $update?>">
<input type="hidden" name="addlink" id="addlink" value="<?php  echo  $addlink?>">
<input type="hidden" name="sorton_param" id="sorton_param" value="">
<input type="hidden" name="stat_param" id="stat_param" value="">
<input type="Hidden" id="arraychk" name="arraychk" value="">
<input type="hidden" id="arraychkall" name="arraychkall" value="">
<?php
/*
if(GetVar('file') =='ge-admin'){
	$alphasearchfield = 'concat(adm.vFirstName," ",adm.vLastName)';
}elseif(GetVar('file') =='ge-customer'){
	$alphasearchfield = 'concat(res.vFirstname," ",res.vLastname)';
}else{
*/
	$alphasearchfield = $ExtraPara[8];
//}
?>
<input type="hidden" name="alphafield" id="alphafield" value="<?php  echo  htmlentities($alphasearchfield)?>">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr id="divSearchBox" style="<?php  if(!GetVar('keyword')){?>display:none<?php }?>">
	<td>
		<div >

    		<?php   print $menubobj->getSearchBox($Field_arr,$alpha_rs,$TableArr);?>
		</div>
	</td>
</tr>
<tr>
	<td height="10px"></td>
</tr>
<tr id="msgrow" style="display:none;">
	<td height="35" align="center" width="100%">
	<div id="msg">
		<?php  if(GetVar('var_msg') !='') { ?>
			<ul id="top-tabstrips" >
				<li><em><?php print GetVar('var_msg');?></em></li>
			</ul>
		<?php  }?>
	</div>
	</td>
</tr>

<?php  if(GetVar('file') == 'ge-sprequest' || GetVar('file') == 'ge-reportabuse'){?>
<tr>
	<td  align="right" style="padding-bottom:3px">
	<strong>Search by Member :</strong>
		<?php   echo $gdbobj->DynamicDropDown($memberCombArr);?>
	</td>
</tr>
<?php  }elseif(GetVar('file') == 'ge-faq'){?>
<tr>
	<td  align="right" style="padding-bottom:3px">
	<strong>Search by Faq Category :</strong>
		<?php   echo $gdbobj->DynamicDropDown($FaqcatCombArr);?>
	</td>
</tr>
<?php  }elseif(GetVar('file') == 'pr-taxrates'){?>
<tr>
	<td  align="right" style="padding-bottom:3px">
	<strong>Search by User :</strong>
		<?php   echo $gdbobj->DynamicDropDown($userCombArr);?>
	</td>
</tr>
<?php  }?>
<tr>
	<td valign="top">

		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td colspan="3" valign="top"><div id="listing"></div></td>
		</tr>
		<tr>
			<td colspan="3" valign="top" class="gradient-bg">
				<div id="toolbar"><?php   print $menubobj->getGridToolBar($TableArr[0][0]);?></div>
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>
<input  type="hidden" name="no" id="no" value="">
<input  type="hidden" name="pagenumber" id="pagenumber" value="1">
<?php   if($_GET['file'] == 'ge-languagelebel'){?>
<div id="tipDiv"  style="position:absolute;visibility:hidden; z-index:100;"></div>
<?php   }?>
<script type="text/javascript">
function getSearch()
{
	var searchyes= $('#searchyes').val();
	if($('#searchyes').val() == '0')
	$('#searchyes').val(1);
	else
	$('#searchyes').val(0);
	if(searchyes == 1)
	$('#search').show();
	else
	$('#search').hide();
}
new AjaxListing({eStatus: '<?php  echo  $eStatus?>', sorton: '<?php  echo  $sorton?>', st: '<?php  echo  $start?>'});

<?php  if(GetVar('eStatus')=='Alpha'){?>
	$('#divSearchBox a').each(function (intIndex) {
		if($( this ).html() == "<?php  echo  GetVar('keyword')?>"){
			$( this ).addClass('serching-active');
		}
});

$('#keyword').val("<?php  echo  GetVar('keyword')?>");
$('#sOption').val($('#alphafield').val);
<?php  }?>

<?php  if(GetVar('eStatus')=='Search' && GetVar('keyword')){?>
$('#keyword').val("<?php  echo  GetVar('keyword')?>");
$('#sOption option[value="<?php  echo  GetVar('option')?>"]').attr("selected","selected");
<?php  }?>
<?php  if(GetVar('eStatus')=='Num'){?>
if($('#divSearchBox')) {
	$('#divSearchBox option[value="<?php  echo  GetVar('CustomerNo')?>"]').attr("selected","selected");
}
<?php  }?>

<?php  if(GetVar('start')){?>
$('#pagenumber').val("<?php  echo  GetVar('start')?>");
<?php  }?>

<?php  if(GetVar('var_msg') !='') { ?>
$('#msgrow').show();
	setTimeout("$('#msgrow').hide();",5000);
<?php  }?>
<?php   if($_GET['file'] == 'ge-languagelebel'){?>
initTip();
<?php   }?>
var ADMIN_AJAX_URL  = '<?php  echo  ADMIN_AJAX_URL?>';
function getCallTooltip(event,iId,hover_type){
//alert(''+ADMIN_URL+'index.php?file=aj-getmouseoverdetail&iId='+iId+'&hover_type='+hover_type+'');
	doTooltip(event,'<div id="tooltip_'+iId+'"  class="tooltipdiv"><iframe src="'+ADMIN_URL+'index.php?file=aj-getmouseoverdetail&iId='+iId+'&hover_type='+hover_type+'" scrolling=no style="width:550px;"  frameborder=0 id="ifrasmes_'+iId+'"></iframe></div>');
}
</script>