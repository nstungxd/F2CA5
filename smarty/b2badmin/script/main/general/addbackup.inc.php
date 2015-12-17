<?php  
/**
 * @package		addbackup.inc.php
 * @Section		general 
*/	
require_once(SITE_FUNC."backup.inc.php");

$msg = (isset($msg))? $msg : '';
$dataFree  = array();
if($_POST){
	$dbobj->FullDBOptmize();
	$msg="Database Optimized Successfully";
}
$sql = "SHOW TABLE status FROM ".SITE_DB."";
$db_sql = $dbobj->MySQLSelect($sql);

?>

<form id="frmbackup" name="frmbackup" method="post">
<input type="hidden" id="type" name="type" value="" >
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td colspan="9" height="75" valign="top"><?php  include_once("btop.inc.php");?></td>
</tr>	
<?php   if($msg != ''){?>
<tr>
	<td align="center" colspan="9" class="reqmsg"><?php  echo  $msg?></td>
</tr>	
<?php   }?>
<tr>
	<td align="right" colspan="9" class="errormsg"><input align="absmiddle" type="radio" name="btnOptimize" value="1" onclick="OptmizeTable();" style="border:none;">&nbsp;Optimize Full Database</td>
</tr>	
		
<tr class="grey-gradient">
	<td width="24%" height="24"  class="border-right"><a href="#" class="whitelink-bold">Table</a></td>
	<td width="8%" align="center" class="border-right"><a href="#" class="whitelink-bold">Records</a> </td>
	<td width="8%" align="center" class="border-right"><a href="#" class="whitelink-bold">Data Size</a> </td>
	<td width="15%" align="center" class="border-right"><a href="#" class="whitelink-bold">Data Free (Overhead)</a> </td>
	<td width="9%" align="center" class="border-right"><a href="#" class="whitelink-bold">Effective Size</a></td>
	<td width="9%" align="center" class="border-right"><a href="#" class="whitelink-bold">Index Size</a> </td>
	<td width="9%" align="center" class="border-right"><a href="#" class="whitelink-bold">Total Size</a> </td>
	<td width="9%" align="center" class="border-right"><a href="#" class="whitelink-bold">Created Date</a> </td>
	<td width="9%" align="center" class="border-right"><a href="#" class="whitelink-bold">Modify Date</a> </td>
</tr>
<tr>
	<td colspan="10" valign="top">
		<table width="100%" border="0" class="table-bg" cellspacing="1" cellpadding="0">
		<?php  for($j=0; $j<count($db_sql); $j++){?>
		<tr onmouseover="this.style.backgroundColor='#EDEDED'" onmouseout="this.style.backgroundColor='#FFFFFF'" bgcolor="#FFFFFF">
			<td width="24%" height="24" >&nbsp;<?php  echo  $db_sql[$j]['Name']?></td>
			<td width="8%" align="center" class="indent-left"><?php  echo  $db_sql[$j]['Rows']?></td>
			<td width="8%" class="indent-left" >
			<?php  
				$dataSize  = explode(" ",nicesize($db_sql[$j]['Data_length']));
				$dataSize[1] = (isset($dataSize[1]))? $dataSize[1] : '';
			?>
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td align="right" width="30%"><?php  echo  $dataSize[0]?></td>
					<td width="25%" align="left"><?php  echo  $dataSize[1]?></td>
				</tr>
				</table>
			</td>
			<td width="15%" class="indent-left" >
			<?php          
				$dataFree  = explode(" ",nicesize($db_sql[$j]['Data_free']));
				$dataFree[1] = (isset($dataFree[1]))? $dataFree[1] : '';
			?>
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td align="right" width="30%"><?php  echo  $dataFree[0]?></td>
					<td width="25%" align="left"><?php  echo  $dataFree[1]?></td>
				</tr>
				</table>
			
			</td>
			<td width="9%" class="indent-left" >
				<?php  
				$EffectiveSize  = explode(" ",nicesize($db_sql[$j]['Data_length']-$db_sql[$j]['Data_free']));
				$EffectiveSize[1] = (isset($EffectiveSize[1]))? $EffectiveSize[1] : '';
			?>
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td align="right" width="30%"><?php  echo  $EffectiveSize[0]?></td>
					<td width="25%" align="left"><?php  echo  $EffectiveSize[1]?></td>
				</tr>
				</table>
			</td>
			<td width="9%" class="indent-left" >
			<?php  
				$IndexSize  = explode(" ",nicesize($db_sql[$j]['Index_length']));
			?>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td align="right" width="30%"><?php  echo  $IndexSize[0]?></td>
				<td width="25%" align="left"><?php  echo  $IndexSize[1]?></td>
			</tr>
			</table>
			
			 </td>
			<td width="9%" class="indent-left" >
				<!-- DATA LENGTH +  INDEX_LENGTH + DATA_FREE -->
				<?php  
				$TotaltableSize  = explode(" ",nicesize($db_sql[$j]['Index_length']+$db_sql[$j]['Data_length']+$db_sql[$j]['Data_free']));
				?>
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td align="right" width="30%"><?php  echo  $TotaltableSize[0]?></td>
					<td width="25%" align="left"><?php  echo  $TotaltableSize[1]?></td>
				</tr>
				</table>
			 </td>
			 <td width="9%" align="center" class="border-right"><?php  echo  DateTime($db_sql[$j]['Create_time'])?></td>
			<td width="9%" align="center" class="border-right"><?php  echo  DateTime($db_sql[$j]['Update_time'])?></td>
		</tr>
		<?php  }?>
		</table>
	</td>
</tr>		
</table>
</form>
<script type="text/javascript">
function OptmizeTable()
{
	document.frmbackup.type.value = 'optimizeAll';
	document.frmbackup.submit();
}
</script>