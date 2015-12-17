<?php  
/** 
 * @package		addcontactus.inc.php
 * @Section		resturent
 * @author		JIMIT SHAH
*/

$view  = GetVar("view");
$iContactId = GetVar("iContactId");

if($view == 'edit')
{
	$arr = $gdbobj->getInfoTable("".PRJ_DB_PREFIX."_contact_us","iContactUsId",$iContactUsId);
}
?>
<script language="JavaScript" src="<?php  echo  A_G_VALIDATION_JS?>jvalidator.js"></script>
<form name="frmadd" id="frmadd" action="" method="post" enctype="multipart/form-data">

<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td width="49%" valign="top">
		<table width="100%" border="0" class="table-border" cellspacing="0" cellpadding="0">
		<tr>
			<td class="heading">Contact Us</td>
		</tr>
		<tr>
			<td valign="top">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="15%" height="22" align="right" class="td-bg">&nbsp;<strong>Contact ID</strong></td>
					<td class="white-bg"><?php  echo  $arr[0]['vContactId']?></td>
				</tr>
				<tr>
					<td width="15%" height="22" align="right" class="td-bg">&nbsp;<strong>Name</strong></td>
					<td class="white-bg"><?php  echo  $arr[0]['vName']?></td>
				</tr>
				<tr>
					<td align="right" class="td-bg"><strong>Phone</strong></td>
					<td  class="white-bg"><?php  echo  $arr[0]['vPhone']?></td>
				</tr>	
				<tr>
					<td align="right" class="td-bg"><strong>Email</strong></td>
					<td  class="white-bg"><?php  echo  $arr[0]['vEmail']?></td>
				</tr>	
				<tr>
					<td align="right" class="td-bg"><strong>Subject</strong></td>
					<td  class="white-bg"><?php  echo  $arr[0]['vSubject']?></td>
				</tr>
				<tr>
					<td align="right" class="td-bg"><strong>Date</strong></td>
					<td  class="white-bg"><?php  echo  date("F d,Y (H:i:s)",strtotime($arr[0]['dDate']))?></td>
				</tr>	
				<tr>
					<td align="right" class="td-bg" valign="top"><strong>Comments</strong></td>
					<td  class="white-bg"><?php  echo  nl2br($arr[0]['tComments'])?></td>
				</tr>	
				</table>
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>
</form>