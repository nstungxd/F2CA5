<?php  
/**
 * Top File For Restaurant
 *
 * @package		addadmintop.inc.php
 * @section		general
 * @author		AndrewDev
*/
$file 		= 	GetVar('file');
$parent 	=	GetVar('parent');
$iSMID 	= 	GetVar('iSMID');

?>
<?php  if($file == "se-securitymanager"){if($view == 'edit'){?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td>
		<div>
			<ul id="tabstrips">
				<li><a href="#"  class="current"><em>Security Manager Information</em></a></li>
				<li><a href="index.php?file=se-smchangepass&view=edit&iSMID=<?php  echo  $iSMID?>&parent=se-securitymanager&tabfile=securitymanager"><em>Reset Password</em></a></li>
			</ul>
		</div>
		</td>
	</tr>
</table>
<?php  }}elseif($file == "se-smchangepass"){?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td>
		<div>
			<ul id="tabstrips">
				<li><a href="index.php?file=se-securitymanager&view=edit&iSMID=<?php  echo  $iSMID?>"><em>Security Manager Information</em></a></li>
				<li><a href="#" class="current"><em>Reset Password</em></a></li>
			</ul>
		</div>
		</td>
	</tr>
</table>
 <?php  }?>