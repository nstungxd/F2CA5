<?php
/**
 * System Settings
 * @package		addsettings.inc.php
*/

require_once(SITE_CLASS_GEN."class.settings.php");
$set = new Settings();
$msg	=	GetVar('var_msg');

$sql = "SELECT vName,vDesc,vValue,iOrderBy,eConfigType,eDisplayType,eSource,vSourceValue,vDefValue
		eStatus from ".PRJ_DB_PREFIX."_configuration where eStatus = 'Active'";
$db_sql = $dbobj->MySQLSelect($sql);

//config type general
for($i=0; $i<count($db_sql); $i++)
{
	if($db_sql[$i]['eConfigType'] =='General')
	{
		$genarr[] = $db_sql[$i];
	}
}

//config type appearance
for($i=0; $i<count($db_sql); $i++)
{
	if($db_sql[$i]['eConfigType'] =='Appearance')
	{
		$apnarr[] = $db_sql[$i];
	}
}

//config type Paging
for($i=0; $i<count($db_sql); $i++)
{
	if($db_sql[$i]['eConfigType'] =='Paging')
	{
		$pagenarr[] = $db_sql[$i];
	}
}

//config type Titles
for($i=0; $i<count($db_sql); $i++)
{
	if($db_sql[$i]['eConfigType'] =='Titles')
	{
		$titnarr[] = $db_sql[$i];
	}
}

//config type Emails
for($i=0; $i<count($db_sql); $i++)
{
	if($db_sql[$i]['eConfigType'] =='Emails')
	{
		$emnarr[] = $db_sql[$i];
	}
}


//config type SEO
for($i=0; $i<count($db_sql); $i++)
{
	if($db_sql[$i]['eConfigType'] =='SEO')
	{
		$senarr[] = $db_sql[$i];
	}
}
//config type PAYMENT
for($i=0; $i<count($db_sql); $i++)
{
	if($db_sql[$i]['eConfigType'] =='Payment')
	{
		$panarr[] = $db_sql[$i];
	}
}
?>
<form name="frmadd" id="frmadd" action="index.php?file=ge-settings&view=action" method="post" enctype="multipart/form-data">
<table border="0" cellpadding="1" cellspacing="1" width="100%">
<tr>
    <td align="center">
		<?php  if($msg !='') { ?>
      <div style="width:100%; float: left;">
			<ul id="top-tabstrips" style="margin:0; padding:0; width:250px;">
				<li><em><?php print GetVar('var_msg');?></em></li>
			</ul>
		</div>
      <?php  }?>
		</td>
</tr>
<tr>
	<td class="help-heading">General</td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<?php  for($u=0; $u<count($genarr); $u++){?>
			<tr>
				<td width="30%" height="22"  class="td-bg"><?php  echo  $genarr[$u]['vDesc']?></td>
				<td class="white-bg"><?php print $set->disValue($genarr[$u]);?></td>
			</tr>
		<?php  }?>
		</table>
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td class="help-heading">PAYMENT</td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<?php $panarr = (isset($panarr))? $panarr : array(); ?>
		<?php  for($u=0; $u<count($panarr); $u++){?>
			<tr>
				<td width="30%" height="22"  class="td-bg" ><?php  echo  $panarr[$u]['vDesc']?></td>
				<td class="white-bg"><?php print $set->disValue($panarr[$u]);?></td>
			</tr>
		<?php  }?>
		</table>
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>

<tr>
	<td class="help-heading">Paging</td>
</tr>

<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<?php  for($u=0; $u<count($pagenarr); $u++){?>
			<tr>
				<td width="30%" height="22"  class="td-bg" ><?php  echo  $pagenarr[$u]['vDesc']?></td>
				<td class="white-bg"><?php print $set->disValue($pagenarr[$u]);?></td>
			</tr>
		<?php  }?>
		</table>
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td class="help-heading">Others</td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<?php  for($u=0; $u<count($apnarr); $u++){?>
		<tr>
			<td width="30%" height="22"  class="td-bg" ><?php  echo  $apnarr[$u]['vDesc']?></td>
			<td class="white-bg"><?php print $set->disValue($apnarr[$u]);?></td>
		</tr>
		<?php  }?>
		</table>
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td class="help-heading">Titles</td>
</tr>

<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<?php  for($u=0; $u<count($titnarr); $u++){?>
			<tr>
				<td width="30%" height="22"  class="td-bg" ><?php  echo  $titnarr[$u]['vDesc']?></td>
				<td class="white-bg"><?php print $set->disValue($titnarr[$u]);?></td>
			</tr>
		<?php  }?>
		</table>
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td class="help-heading">E-mails</td>
</tr>

<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<?php  for($u=0; $u<count($emnarr); $u++){?>
			<tr>
				<td width="30%" height="22"  class="td-bg" ><?php  echo  $emnarr[$u]['vDesc']?></td>
				<td class="white-bg"><?php print $set->disValue($emnarr[$u]);?></td>
			</tr>
		<?php  }?>
		</table>
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td class="help-heading">SEO</td>
</tr>

<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<?php  for($u=0; $u<count($senarr); $u++){?>
			<tr>
				<td width="30%" height="22"  class="td-bg" valign="top"><?php  echo  $senarr[$u]['vDesc']?></td>
				<td class="white-bg"><?php print $set->disValue($senarr[$u]);?></td>
			</tr>
		<?php  }?>
		</table>
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td align="center">
		<input type="Image" alt="Save" title="Save" id="btnSave" style="cursor:pointer" id="btnSave" name="btnSave" src="<?php echo ADMIN_IMAGES; ?>btn-save.gif" />
		<input type="image" alt="Reset" title="Reset" style="cursor:pointer" src="<?php echo ADMIN_IMAGES; ?>btn-reset.gif" onclick="reset();return false;" />
	</td>
</tr>
</table>
</form>