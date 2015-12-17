<?php  
//set menus object
if(!isset($menubobj)){
	require_once(SITE_CLASS_GEN."class.menus.php");
	$menubobj=new Menus();
	$subMenu = $menubobj->getSubMenudetail();
}

if($_SERVER["HTTP_HOST"] == '192.168.32.150')
	$width = "70%";
else
	$width = "237";

$curl = str_replace(SITE_FOLDER.ADMIN_FOLDER, "",$_SERVER['REQUEST_URI']);

$curfile  = GetVar('file');
$parentfile  = GetVar('parent');

$helpUrl = "index.php?file=ge-help&view=edit&AX=Yes";
$documentUrl = "index.php?file=ge-document&view=edit&AX=Yes";
$settingUrl	= "index.php?file=ge-settings&view=edit&AX=Yes";
$backupUrl = "index.php?file=ge-backup&view=edit&AX=Yes";
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td width="50%" height="80"><a href="#" title="<?php  echo  $SITE_NAME?>"><img src="<?php  echo  ADMIN_IMAGES?>exchainge.png" height="64" alt="<?php  echo  $SITE_NAME?>" title="<?php  echo  $SITE_NAME?>" hspace="15" border="0" /></a></td>
	<td width="50%" align="right">
	    <table width="270" border="0" style="margin-right:5px;" cellspacing="2" cellpadding="2">
		<tr>
		  <td colspan="9" height="18" align="right">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="50%" align="right" id="ClockBkgnd" class="day-date"><?php  echo(DateTime(time(),'5'));?></td>
					<td width="20%" align="right" id="ClockTime" class="day-date"><?php  echo(DateTime(time(),'6'));?></td>
				</tr>
				</table>
		  </td>
		</tr>
       <tr>
          <td width="30">&nbsp;</td>
    	   	<!--<td width="24"><a href="<?php  echo  $helpUrl?>" title="Help" class="toplink">Help</a></td>
    			<td width="17" align="center"><img src="<?php  echo  ADMIN_IMAGES?>bullet-square.gif" width="4" height="4" /></td>-->
    			<td width="0" align="right"><a href="<?php  echo  $settingUrl?>" title="Settings" class="toplink">Settings</a></td>
    			<td width="10" align="center"><img src="<?php  echo  ADMIN_IMAGES?>square-bullet.gif" alt="" border="0" /></td>
    			<!--<td width="46" align="center"><a href="<?php  echo  $backupUrl?>" title="Backups" class="toplink">Backups</a></td>
    			<td width="17" align="center"><img src="<?php  echo  ADMIN_IMAGES?>bullet-square.gif" width="4" height="4" /></td>-->
    			<td width="19" align="right"><a href="<?php  echo  SITE_URL_DUM?>" target="_blank" title="Site"   class="toplink">Site</a></td>
          <td width="10" align="center"><img src="<?php  echo  ADMIN_IMAGES?>square-bullet.gif" alt=""  border="0"/></td>
          <td width="37"><a href="<?php  echo  ADMIN_URL."index.php?file=gen-logout";?>" title="Logout" class="toplink">Logout</a></td>
        </tr>
		<tr>
			<td align="right" colspan="11" valign="top" class="welcome-text">Welcome : <span class=""><?php   print SessionVar(''.PRJ_CONST_PREFIX.'_SESS_NAME');?></span></td>
		</tr>
	    </table>
	</td>
</tr>

<tr>
    <td colspan="2" class="topnav-bg">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td><?php  	print $menubobj->displayMenu();?></td>
        </tr>
        </table>
    </td>
</tr>
<tr>
    <td colspan="2" class="topnav-gradient" style="padding-left:17px;">

		<?php  for($i=0;$i<count($subMenu);$i++){

			$ss = @explode("?",$subMenu[$i]['vURL']);
			$ss1 = @explode("&",$ss[1]);
			$ss2 = @explode("=",$ss1[0]);
			//print_r($ss2[1]);
			//echo "<hr>";
			if($curl == $subMenu[$i]['vURL']){
				$class = "active-sublink-act";
			}else{
				if($ss2[1] == $curfile){
					$class = "active-sublink-act";
				}elseif($ss2[1] == $parentfile){
					$class = "active-sublink-act";
				}else{
					$class = "active-sublink";
				}
			}
		?>
		<?php  if($subMenu[$i]['vMenuDisplay'] != 'importdisable'){?>
		<img src="<?php  echo  ADMIN_IMAGES?>separator.gif" hspace="4">&nbsp;<a href="<?php  echo  $subMenu[$i]['vURL']?>" title="<?php  echo  $subMenu[$i]['vMenuDisplay']?>" id="<?php  echo  $class;?>"><?php  echo  $subMenu[$i]['vMenuDisplay']?></a>
		<?php  }?>
		<?php  }?>
	</td>
</tr>
</table>
