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
$iAdminId 	= 	GetVar('iAdminId');

?>
<?php  if($file == "ge-admin"){if($view == 'edit'){?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td>
		<div>
			<ul id="tabstrips">
				<li><a href="#"  class="current"><em>Admin Information</em></a></li>
				<li><a href="index.php?file=ge-adminchangepassword&view=edit&iAdminId=<?php  echo  $iAdminId?>&parent=ge-admin&tabfile=admin"><em>Reset Password</em></a></li>
			</ul>
		</div>
		</td>
	</tr>
</table>
<?php  }}elseif($file == "ge-adminchangepassword"){?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td>
		<div>
			<ul id="tabstrips">
				<li><a href="index.php?file=ge-admin&view=edit&iAdminId=<?php  echo  $iAdminId?>"><em>Admin Information</em></a></li>
				<li><a href="#" class="current"><em>Reset Password</em></a></li>
			</ul>
		</div>
		</td>
	</tr>
</table>
<?php  }elseif($file == "ge-user"){if($view == 'edit'){?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td>
		<div>
			<ul id="tabstrips">
				<li><a href="#"  class="current"><em>User Information</em></a></li>
				<li><a href="index.php?file=ge-userchangepassword&view=edit&iUserId=<?php  echo  $iUserId?>&parent=ge-user"><em>Reset Password</em></a></li>
			</ul>
		</div>
		</td>
	</tr>
</table>
<?php  }}elseif($file == "ge-userchangepassword"){?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td>
		<div>
			<ul id="tabstrips">
				<li><a href="index.php?file=ge-user&view=edit&iUserId=<?php  echo  $iUserId?>"><em>User Information</em></a></li>
				<li><a href="#" class="current"><em>Reset Password</em></a></li>
			</ul>
		</div>
		</td>
	</tr>
</table>	<?php  }?>