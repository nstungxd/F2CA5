<?php  
//include here vars files
require_once(SITE_FUNC."backup.inc.php");

$dir = GetVar('directory');
$updir = dirname($dir);
$updir = str_replace("\\","/",$updir);
if ($updir == "")
	$updir = "/";
if(isset($_GET[directory]) && $_GET[directory] !="")
	$path.=$_GET[directory];
else
	$path.=SPATH_ROOT."/";

$AlldataFile = DirectoryListing($path);

?><br>
<form id="frmsource" name="frmsource" method="post" action="index.php?file=gen-fullbkup&view=action">
<input type="hidden" name="action" id="action">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td colspan="5" height="75" valign="top"><?php  include_once("btop.inc.php");?></td>
</tr>
<tr>
	<td colspan="5" height="30" valign="top">
		<table border="0" cellpadding="1" cellspacing="1" width="100%">
		<tr>
			<td width="20%"><img src="<?php  echo  ADMIN_IMAGES?>btn-backupall.gif" style="CURSOR:POINTER" alt="Backup All" title="Backup All" onclick="BkupFile('sourcebackup');"><!--&nbsp;<img src="<?php  echo  ADMIN_IMAGES?>btn-download.gif" style="CURSOR:POINTER" alt="Download" title="Download" onclick="BkupFile('download');"></td>
                                                                                                                                                      -->
			<td width="100%" align="right">
				<div id="msg">
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
<tr class="grey-gradient">
	<td width="1%"  class="border-right" height="24"><input type="Checkbox" name="abcFull" id="abcFull" value="1" onclick="checkAllDb()"></td>
	<td width="3%"  align="center" class="border-right">
		<?php  if($_GET['directory']!="" && $path !=SPATH_ROOT){?>
		<a href="index.php?file=ge-source&view=edit&AX=Yes&directory=<?php  echo  $updir."/";?>"><img src='<?php  echo  ADMIN_ICONS."/updir.gif"?>' border=0 alt='Up Directory' width=16 height=16></a>
		<?php  }?>
	
	</td>
	<td width="66%" class="border-right"><a href="#" class="whitelink-bold">Directory</a></td>
	<td width="20%" align="center" class="border-right"><a href="#" class="whitelink-bold">Create</a> </td>
	<td width="14%" align="center"><a href="#" class="whitelink-bold">Size</a> </td>
</tr>
<tr>
	<td colspan="5"  valign="top">
		<table width="100%" border="0" class="table-bg" cellspacing="1" cellpadding="0">
		<?php  for($x=0; $x<count($AlldataFile); $x++){?>
		<tr onmouseover="this.style.backgroundColor='#F1E6DA'" onmouseout="this.style.backgroundColor='#FFFFFF'" bgcolor="#FFFFFF">
			<td width="1%" height="20" align="left"><input  type="checkbox" name="chkFile[]" style="border:none" id="iIdFILE"   value="<?php  echo  $AlldataFile[$x];?>"></td>
			<td width="3%"  align="center"><?php  echo  chkfile($path.$AlldataFile[$x]);?></td>
			<td width="66%"  align="left" class="indent-left">
			<?php  if(is_dir($path.$AlldataFile[$x])){?>
				<a href="index.php?file=ge-source&view=edit&AX=Yes&directory=<?php  echo  $path.$AlldataFile[$x]."/"?>" class="whitelink-normal" ><?php  echo  $AlldataFile[$x]?></a>
			<?php  }else if($_GET[directory] == "source"){?>
				<a href="index.php?file=ge-source&view=edit&AX=Yes&directory=<?php  echo  $path.$AlldataFile[$x]."/"?>" class="whitelink-normal" ><?php  echo  $AlldataFile[$x]?></a>	
			<?php  }else{?>	
				<?php  echo  $AlldataFile[$x]?>
			<?php  }?>	
			
			</td>
			<td width="20%"  align="center" ><?php  echo  DateTime(filemtime($path.$AlldataFile[$x]),'3')?></td>
			<td width="14%"  align="left">
				<?php  
					if(is_dir($path.$AlldataFile[$x]))
					{

						$size = nicesize(getUserDirectorySize($path.$AlldataFile[$x]));
					}
					else
					{
						$size = nicesize(filesize($path.$AlldataFile[$x]));
					}
					$size = explode(" ",$size);
					?>
					<table border="0" width="100%">
					<tr>
						<td align="right" width="30%"><?php  echo  $size[0]?></td>
						<td width="25%" align="left"><?php  echo  $size[1]?></td>
					</tr>	
					</table>
			</td>
		</tr>
		<?php  }
		
			if(is_dir($path.$AlldataFile[$x]))
				$total = getUserDirectorySize($path.$AlldataFile[$x]);
			else
				$total = filesize($path.$AlldataFile[$x]);
			$totalSize+=$total;
		?>
		<tr bgcolor="#EFEFEF">
			<td colspan="6" align="right"><b>
			<?php  
				$totalSize = explode(" ",nicesize($totalSize));
			?>
				<table  border="0" width="15%">
				<tr>
					<td align="right" width="48%"><b><?php  echo  $totalSize[0]?></b></td>
					<td width="25%" align="left"><b><?php  echo  $totalSize[1]?></b></td>
				</tr>
				</table>
			</td>
		</tr>	
		</table>
	</td>
</tr>
</table>
<script type="text/javascript">
function BkupFile(type)
{
	$('action').value = type;
	$('frmsource').submit();
}
function checkAllDb()
{
	var rs = ($('abcFull').checked)?true:false;
	
	for(i=0;i<$('frmsource').elements.length;i++)
	{
	  	if($('frmsource').elements[i].id == 'iIdFILE')
  		{
			$('frmsource').elements[i].checked = rs;
		}
	}  
}
</script>