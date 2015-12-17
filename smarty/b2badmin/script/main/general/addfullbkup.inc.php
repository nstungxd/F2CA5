<?php  
/**
 * File For Database Full Backup
 *
 * @package		addfullbkup.inc.php
 * @Section		general
 * @author		Jack Scott
*/
require_once(SITE_FUNC."backup.inc.php");
$dbFiles = DirectoryListing(BACKUP_DBPATH);

?>
<form id="frmfullbkup" name="frmfullbkup" method="post" action="index.php?file=gen-fullbkup&view=action">
<input type="hidden" name="action" id="action"/>
<input type="hidden" name="filedown" id="filedown"/>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td colspan="5" height="75" valign="top"><?php  include_once("btop.inc.php");?></td>
</tr>

<tr>
	<td colspan="5" height="30" valign="top">
		<table border="0" cellpadding="1" cellspacing="1" width="100%">
		<tr>
			<td width="25%"><img src="<?php  echo  ADMIN_IMAGES?>btn-backupdb.gif" style="CURSOR:POINTER" alt="Backup - DB" title="Backup - DB" onclick="BkUp();return false;"/>&nbsp;<img src="<?php  echo  ADMIN_IMAGES?>btn-delete.gif" style="CURSOR:POINTER" title="Delete" alt="Delete" onclick="DeleteDB();return false;"/></td>
			<td width="75%" align="center">
				<div id="msg" align="center">
				<?php  if(GetVar('var_msg') !='') { ?>
					<ul id="top-tabstrips">
						<li><em><?php print GetVar('var_msg');?></em></li>
					</ul>
				<?php  }?>
				</div>
			</td>
		</tr>	
		</table>
	</td>
</tr>
<?php   if(count($dbFiles) > 0){?>
<tr class="grey-gradient">
	<td width="1%"  class="border-right" height="24"><input  type="Checkbox" style="border:none" name="abcFull" id="abcFull" value="1"  onclick="checkAllDb()"></td>
	<td width="66%" class="border-right"><a href="#" class="whitelink-bold">Database File</a></td>
	<td width="10%" align="center" class="border-right"><a href="#" class="whitelink-bold">Created On</a> </td>
	<td width="10%" align="center" class="border-right"><a href="#" class="whitelink-bold">Download</a> </td>
	<td width="10%" align="center"><a href="#" class="whitelink-bold">Size</a> </td>
</tr>

<tr>
	<td colspan="5"  valign="top">
		<table width="100%" border="0" class="table-bg" cellspacing="1" cellpadding="0">
		<?php  
		for($i=0; $i<count($dbFiles); $i++)
		{?>
		<tr onmouseover="this.style.backgroundColor='#F1E6DA'" onmouseout="this.style.backgroundColor='#FFFFFF'" bgcolor="#FFFFFF">
			<td width="1%" height="20" align="left"><input  type="checkbox" style="border:none" name="chkFull[]" id="iIdFull"   value="<?php  echo  $dbFiles[$i];?>"></td>
			<td width="66%"  class="indent-left"><?php  echo  $dbFiles[$i]?></td>
			<td width="10%" class="indent-left" align="center"><?php  echo  DateTime(filemtime(BACKUP_DBPATH.$dbFiles[$i]),'3');?></td>
			<td width="10%" class="indent-left" align="center"><a  href="#"  class="whitelink-normal" onclick="DownloadDB('<?php  echo  $dbFiles[$i];?>');return false; " onMouseOver="self.status='';return true">
			<?php   if($_SERVER['HTTP_HOST'] == '192.168.32.150'){?>
			Download
			<?php   }?>
			</a></td>
			<td width="10%"class="indent-left">
					<?php  
						$sizeDB = explode(" ",nicesize(filesize(BACKUP_DBPATH.$dbFiles[$i])));
					?>
					<table border="0" width="100%">
					<tr>
						<td align="right" width="30%"><?php  echo  $sizeDB[0]?></td>
						<td width="25%" align="left"><?php  echo  $sizeDB[1]?></td>
					</tr>	
					</table>
			</td>
		</tr>
		<?php  	
				$total+= filesize(BACKUP_DBPATH.$dbFiles[$i]);
		}
		?>
		<tr  bgcolor="#FFFFFF">
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td align="center">
			<?php  
				$totalSizeDB = explode(" ",nicesize($total));
			?>
				<table  border="0" width="15%">
				<tr>
					<td align="right" width="30%"><b><?php  echo  $totalSizeDB[0]?></b></td>
					<td width="25%" align="left"><b><?php  echo  $totalSizeDB[1]?></b></td>
				</tr>	
				</table>
			</td>
		</tr>		
		</table>
	</td>
</tr>
<?php  }else{?>
<tr>
	<td colspan="5" height="30" valign="top">
		<table border="0" cellpadding="1" cellspacing="1" width="100%">
		<tr>
			<td width="100%" align="center">
				<div id="msg" align="center">
					<ul id="top-tabstrips">
						<li><em>No Back Up file found.</em></li>
					</ul>
				</div>
			</td>
		</tr>	
		</table>
	</td>
</tr>
<?php  }?>
</table>
</form>
<script type="text/javascript">
function BkUp()
{
	$('#action').val('tableBackup');
	$('#frmfullbkup').submit();
}
function DownloadDB(Fname)
{
	$('action').value = 'filedownload';
	$('filedown').value = Fname;
	$('frmfullbkup').submit();
}
function getCnt(frm)
{	
	var x=0;
	with(frm)
	{
		for(i=0;i < elements.length;i++)
		{	
			if (elements[i].id == 'iIdFull' && elements[i].checked == true) 
				x++;
		}
		return x;
	}
}
function DeleteDB()
{
	if(getCnt($('frmfullbkup')) ==0)
	{
		alert("Please Select DB File");
		return false;
	}
	$('action').value = 'delete_db_file';
	$('frmfullbkup').submit();
}
function checkAllDb()
{
	var rs = ($('abcFull').checked)?true:false;
	
	for(i=0;i<$('frmfullbkup').elements.length;i++)
	{
	  	if($('frmfullbkup').elements[i].id == 'iIdFull')
  		{
			$('frmfullbkup').elements[i].checked = rs;
		}

	}  
}
</script>