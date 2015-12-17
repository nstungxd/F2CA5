<?php
$links = '';
$backURL='';
		//include ajax class
		include_once(SITE_CLASS_GEN."class.ajax.php");

		//intiailize ajax object
		$listObj = new AjaxListing();

      // echo GetVar('view'); exit;
		//get table array according to module
		$TableArr = $listObj->getTableArray();


		//encrypt table array
		for($i=0, $ni=count($TableArr) ; $i<$ni ; $i++)	{
			$TableArr_inc[]=$listObj->encrptyArrayFields($TableArr[$i]);
		}

		//get extra array according to module
		$ExtraPara = $listObj->getExtraParamArray();

		//get filed array according to module
		$Field_arr = $listObj->getFieldArray();
		//print_r($Field_arr)
		for($i=0, $ni=count($Field_arr) ; $i<$ni ; $i++){
			$field_arr_inc[]=$listObj->encrptyArrayFields($Field_arr[$i]);
		}
		$addFile = $ExtraPara[4];
		$tableString = $listObj->setTableAndRelationforAlphaSearch();
		//ends here
		switch(GetVar('file')){
			case "ge-city":
				$sql_state = "select vStateCode from ".PRJ_DB_PREFIX."_state_master where iStateId = '".GetVar('iStateId')."'";
				$db_state = $dbobj->MySQLSelect($sql_state);
				$ssql.=" AND cit.vState = '".$db_state[0]['vStateCode']."'";
			break;
			/*case "ge-admin":
				$ssql.=" AND Log.Type = 'Admin'";
			break;*/

		}
		$getParam = (isset($getParam))? $getParam : '';
		$ssql = (isset($ssql))? $ssql : '';
		$sql = "select distinct(substring(".$ExtraPara[8].",1,1)) as alphaSearch from ".$tableString.$getParam.$ssql;
//		echo $sql;
		$db_alpha = $dbobj->MySQLSelect($sql);
		$alpha_rs = (isset($alpha_rs))? $alpha_rs : '';
		if(count($db_alpha) > 0)
		{
			for($a=0;$a<count($db_alpha);$a++)
			{
				$alpha_rs .= strtoupper($db_alpha[$a]['alphaSearch']).",";
			}
			$alpha_rs = substr($alpha_rs,0,-1);
		}
		//print_r($alpha_rs);
?>
<?php

$accessmod	= $accessobj->getAdminAccessmodules();
$modinfo = $accessobj->getModuleInfo();
//prints($accessmod);exit;

$modinfo[0]['iModuleId'] = (isset($modinfo[0]['iModuleId']))? $modinfo[0]['iModuleId'] : '';
$iModId = $modinfo[0]['iModuleId'];
//Declare active / Inactive / Delete access variable
$updatemod = @explode(',',$accessmod[0]['tUpdate']);
$addmod = @explode(',',$accessmod[0]['tAdd']);

if(@in_array($iModId,$updatemod)){
	$update = "Yes";
}else{
	$update = "No";
}
if(@in_array($iModId,$addmod)){
	$addlink = "Yes";
}else{
	$addlink = "No";
}
?>
<?php
if($ExtraPara[2] == "")
{
//for linking product search criteria to link in top of price details of that page
$edArgu = '';
if(stripos($_SERVER['QUERY_STRING'],"&eStatus")) {
	$edArgu = substr($_SERVER['QUERY_STRING'],stripos($_SERVER['QUERY_STRING'],"&eStatus"));
}
$tabfil = (isset($_GET['tabfile']))? $_GET['tabfile'] : '';
$edArgu = str_replace("&tabfile=".$tabfil,"",$edArgu);
$proName="";

if(GetVar('iProductID'))
     $proName=$comObj->getProductName(GetVar('iProductID'));
	$label = array(
			//define here general section file module name
			"ge-home"					=>	"My Home Page",
			"ge-settings"				=>	"System Settings",
			"ge-backup"					=>	"Tabels Backup",
			"ge-source"					=>	"Source Backup",
			"ge-fullbkup"				=>	"Full DB Backup/Download",
			"ge-restore"				=>	"Restore Database"
	);

	if(GetVar('parent') !='')
	{
		//set here back link
		$url = str_replace(SITE_FOLDER.ADMIN_FOLDER, "",$_SERVER['REQUEST_URI']);
		$url=  explode("&",$url);
		if(GetVar('file') != 'ge-comessage' && GetVar('file') != 'ge-sentmails' && GetVar('file') != 'ge-msgdetail' && GetVar('file') != 'ge-threadpost' && GetVar('file') != 'ge-ediinterval' && GetVar('file') != 'ge-emailrequests')
		if(GetVar('parent') =='ge-thread' || GetVar('file') != 'ge-threadpostdetail'){
		$file = 'ge-threadpost';
		if(GetVar('file') == 'ge-adminchangepassword' || GetVar('file') == 'se-smchangepass'){
		  $backURL = '<a href="index.php?file='.GetVar('parent').'&view=index&AX=Yes" class="back-link" title="Go Back"><img src="'.ADMIN_URL.'images/back.gif" style="border:0px"></a>';
		}else{
		  $backURL = '<a href="index.php?file='.$file.'&view=edit&iThreadID='.GetVar('iThreadID').'&parent='.GetVar('parent').' class="back-link" title="Go Back"><img src="'.ADMIN_URL.'images/back.gif" style="border:0px"></a>';
		}
		}else{
		 $backURL = '<a href="index.php?file='.GetVar('parent').'&view=index&AX=Yes" class="back-link" title="Go Back"><img src="'.ADMIN_URL.'images/back.gif" style="border:0px"></a>';
		}

		//ends here
	}

}
else
{
	switch(GetVar('view'))
	{
		case "add":
				$label =" Add ".ucwords($ExtraPara[2]);
				//set here back link
				$url = str_replace(SITE_FOLDER.ADMIN_FOLDER, "",$_SERVER['REQUEST_URI']);
				$url=  explode("&",$url);
				$backURL = '<a href="'.$url[0].'&view=index&AX=Yes" class="back-link" title="Go Back" id="backurl"><img src="'.ADMIN_URL.'images/back.gif" style="border:0px"></a>';
            //prints($url); exit;
				//ends here
			break;

		case "edit":
		  	$tempval 		= 	getPOSTGETParam();
			if( (GetVar('file')=="ge-statpg") || (GetVar('file')=="ge-emailtemplate") )
			$label =" Edit ".ucwords($ExtraPara[2]);
			else
			$label =" View ".ucwords($ExtraPara[2])." Details";

			/*$editArgu="";
			if(stripos($_SERVER['QUERY_STRING'],"&eStatus"))
      			$editArgu = substr($_SERVER['QUERY_STRING'],stripos($_SERVER['QUERY_STRING'],"&eStatus"));
      		*/
			//set here back link
			$tempval = str_replace('&view=edit','',$tempval);
			$editArgu = $tempval;
			$url = str_replace(SITE_FOLDER.ADMIN_FOLDER, "",$_SERVER['REQUEST_URI']);
			$url=  explode("&",$url);

			//$editArgu = str_replace('"','/"',$editArgu);
			//echo $editArgu;exit;
			$editArgu = urldecode($editArgu);
			$pos = strpos($editArgu,'"');
			// echo $editArgu;
			//echo $pos;exit;
			if(GetVar('file') == 'ge-adminchangepassword' || GetVar('file') == 'se-smchangepass'){
				$backURL = '<a href="index.php?file='.GetVar('parent').'&view=index&AX=Yes" class="back-link" title="Go Back"><img src="'.ADMIN_URL.'images/back.gif" style="border:0px"></a>';
			}else{
				if ($pos === false) {
					$backURL = '<a href="'.$url[0].'&view=index&AX=Yes'.$editArgu.'" class="back-link" title="Go Back" id="backurl"><img src="'.ADMIN_URL.'images/back.gif" style="border:0px"></a>';
				}else{
					$backURL = "<a href='".$url[0]."&view=index&AX=Yes".$editArgu."' class='back-link' title='Go Back' id='backurl'><img src='".ADMIN_URL."images/back.gif' style='border:0px'></a>";
				}
			}
			//echo 'href="'.$url[0].'&view=index&AX=Yes'.$editArgu.'"';exit;
			//ends here
      		//echo "<pre>";print_r($_SERVER);
			break;
		default :
			$label = ucwords($ExtraPara[2]);
			break;
	}

}

/*if(GetVar('file') == 'ge-adminchangepassword')
{
	$iAdminId = GetVar('iAdminId');

	$arr = $gdbobj->getInfoTable("".PRJ_DB_PREFIX."_administrator","iAdminId",$iAdminId);

	if(isset($iAdminId))
	{
		$links = '<a href='.ADMIN_URL.'index.php?file=ge-admin&view=edit&iAdminId='.$iAdminId.'>'.$arr[0]['vFirstName']." ".$arr[0]['vLastName'].'</a> >> ';
	}
    if(GetVar('view')){
    }
}*/


if(GetVar('file') == 'ge-custresetpass'){
	$iCustomerId = GetVar('iCustomerId');
	$arr = $gdbobj->getInfoTable("".PRJ_DB_PREFIX."_customer","iCustomerId",$iCustomerId);
	$links ='<a href='.ADMIN_URL.'index.php?file=ge-customer&view=edit&iCustomerId='.$iCustomerId.'>'.$arr[0]['vFirstname']." ".$arr[0]['vLastname'].'</a>'." >>&nbsp;";
}

//print_r($ExtraPara);exit;
if($ExtraPara[2] )
{
?>
<?php
$sort = array();
$sort = $ExtraPara[1];
$sort = explode(" ",$sort);
$sort[1] = (isset($sort[1]))? $sort[1] : '';
if($sort[1] == 'ASC'){
	$statval = "1";
}else{
	$statval = "0";
}
?>
<input type="hidden" name="sort_odr" id="sort_odr" value="<?php  echo  $statval;?>">
<input type="hidden" name="sort_field" id="sort_field" value="<?php  echo  $sort[0]?>">
<input type="hidden" name="vfileName" id="vfileName" value="<?php  echo  ucwords($ExtraPara[2])?>">
<input type="hidden" name="addUrl" id="addUrl" value="<?php  echo  $addFile?>">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td height="40" width="40%"  style="padding-left:15px;" class='breadcrumbs'><?php  echo $links;?><?php   print $label;?></td>
	<td width="20%" align="center"><?php print $menubobj->getIcons($ExtraPara);?></td>
	<td width="40%" align="right"><?php print $backURL;?></td>
</tr>
<tr>
	<td colspan="3" valign="top">
		<table width="99%" border="0" cellspacing="0" cellpadding="0" style="margin : 5px 5px 5px 5px; ">
		<tr>
			<!--<td width="6" align="left" class="grey-topbg"><img src="<?php // echo  ADMIN_IMAGES?>grey-topleftcorner.gif" alt=""  /></td>-->
			<td class="grey-topbg" colspan="3" style="height:1px;" ><!--<img src="<?php // echo  ADMIN_IMAGES; ?>blank.gif" alt="" border="0" />--></td>
			<!--<td align="right" class="grey-topbg"><img src="<?php // echo  ADMIN_IMAGES?>grey-toprightcorner.gif" alt=""  /></td>-->
		</tr>
		<tr>
			<td class="grey-middle-bg" colspan="3" width="100%"><?php include_once($script); ?></td>
		</tr>
		<tr>
		    <!--<td width="6" class="grey-bottbg"><img src="<?php // echo ADMIN_IMAGES?>grey-bottleftcorner.gif" alt=""></td>-->
		    <td class="grey-bottbg" colspan="3" style="height:1px;"><!--<img src="<?php // echo ADMIN_IMAGES?>blank.gif" alt="" border="0" />--></td>
		    <!--<td class="grey-bottbg" align="right"><img src="<?php // echo ADMIN_IMAGES?>grey-bottrightcorner.gif" alt=""></td>-->
		</tr>
		</table>
	</td>
</tr>
</table>
<?php
}
else
{
$label[GetVar('file')] = (isset($label[GetVar('file')]))? $label[GetVar('file')] : '';
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td height="40"  style="padding-left:15px;"><span class='breadcrumbs'><?php  echo $links;?><?php   print $label[GetVar('file')];?></span></td>
	<td align="right"><?php print $backURL;?></td>
</tr>
<tr>
	<td valign="top" colspan="2">
		<table width="99%" border="0" cellspacing="0" cellpadding="0" style="margin : 5px 5px 5px 5px; ">
		<tr>
			<!--<td width="6"><img src="<?php // echo  ADMIN_IMAGES?>grey-topleftcorner.gif" alt=""  /></td>-->
			<td class="grey-topbg" colspan="3" width="1000px" style="height:1px;"><!--<img src="<?php // echo  ADMIN_IMAGES?>blank.gif" alt="" border="0" />--></td>
			<!--<td width="6"><img src="<?php  echo  ADMIN_IMAGES?>grey-toprightcorner.gif" alt=""  /></td>-->
		</tr>
		<tr>
			<td class="grey-middle-bg" colspan="3"><?php include_once($script);?></td>
		</tr>
		<tr>
		    <!--<td><img src="<?php // echo  ADMIN_IMAGES?>grey-bottleftcorner.gif" alt=""></td>-->
		    <td class="grey-bottbg" colspan="3" style="height:1px;"><!--<img src="<?php // echo ADMIN_IMAGES?>blank.gif" alt="" border="0" />--></td>
		    <!--<td><img src="<?php // echo  ADMIN_IMAGES?>grey-bottrightcorner.gif" alt=""></td>-->
		</tr>
		</table>
	</td>
</tr>
</table>
<?php
}
?>