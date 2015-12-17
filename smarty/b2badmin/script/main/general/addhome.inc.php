<?php  
/**
 * Home Page
 *
 * @package		addhome.inc.php
 * @Section		general
 * @author		Jack Scott
*/

//For Last Login And Ip Address
$last_log		=	$adobj->lastlogin();

/* For Administrator Section */

//Total Active Administrator
$t_admin_a =	$adobj->hcntlist(''.PRJ_DB_PREFIX.'_administrator',' where eStatus="Active"');

//Total Inactive Administrator
$t_admin_i			=	$adobj->hcntlist(''.PRJ_DB_PREFIX.'_administrator',' where eStatus="Inactive"');

//Total  Administrator
$t_admin			=	$adobj->hcntlist(''.PRJ_DB_PREFIX.'_administrator','');


//Total Active Members
$t_mem_a			=	$adobj->hcntlist(''.PRJ_DB_PREFIX.'_security_manager',' where eStatus="Active"');
//Total Inactive Members
$t_mem_i			=	$adobj->hcntlist(''.PRJ_DB_PREFIX.'_security_manager',' where eStatus="Inactive"');
//Total  Blocked Members
$t_mem_b 	=	$adobj->hcntlist(''.PRJ_DB_PREFIX.'_security_manager',' where eStatus="Block"');
//Total  Members
$t_mem			=	$adobj->hcntlist(''.PRJ_DB_PREFIX.'_security_manager','');


//total Members Registered Today
$t_mem_tod		=	$adobj->hcntlist(''.PRJ_DB_PREFIX.'_security_manager',' where eStatus="Active"  AND DATE_FORMAT(dAddedDate,"%y-%m-%d") = DATE_FORMAT(CURDATE(),"%y-%m-%d")');

//total Members Registered This Month
$t_mem_mon		=	$adobj->hcntlist(''.PRJ_DB_PREFIX.'_security_manager',' where eStatus="Active"  AND DATE_FORMAT(dAddedDate,"%m") = DATE_FORMAT(CURDATE(),"%m") AND DATE_FORMAT(dAddedDate,"%y") = DATE_FORMAT(CURDATE(),"%y")');

//total Members Registered This Year
$t_mem_yr		=	$adobj->hcntlist(''.PRJ_DB_PREFIX.'_security_manager',' where eStatus="Active"  AND DATE_FORMAT(dAddedDate,"%y") = DATE_FORMAT(CURDATE(),"%y")');


/*//Member Plan Expairy
$Mem_Plan_Tod		=	$adobj->hcntlist(''.PRJ_DB_PREFIX.'_user_plan',' where dEndDate = CURDATE()');
$Mem_Plan_Mon		=	$adobj->hcntlist(''.PRJ_DB_PREFIX.'_user_plan',' where DATE_FORMAT(dEndDate,"%m") = DATE_FORMAT(CURDATE(),"%m")');
$Mem_Plan_Yer		=	$adobj->hcntlist(''.PRJ_DB_PREFIX.'_user_plan',' where DATE_FORMAT(dEndDate,"%y") = DATE_FORMAT(CURDATE(),"%y")');
$Mem_Plan_Tot		=	$adobj->hcntlist(''.PRJ_DB_PREFIX.'_user_plan','');
*/
//Recently Online Members
$online_mem = $generalobj->getTableInfo("".PRJ_DB_PREFIX."_recent_online",'','*','','order by vTimeEntry DESC');
//Prints($online_mem);exit;
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td valign="top">
            <table width="100%" border="0" cellspacing="1" cellpadding="1">
                <tr>
<!--                  <td width="13%"><a href="#" title="Backup"><img src="<?php  echo  ADMIN_IMAGES?>backup-icon.gif"  alt="Backup" title="Backup" border="0" /></a></td>-->
				  <!--  <td width="13%"><a href="index.php?file=ge-backup&view=edit&AX=Yes" title="Backup"><img src="<?php  echo  ADMIN_IMAGES?>backup-icon.gif"  alt="Backup" title="Backup" border="0" /></a></td>-->
					<td width="13%"><a href="index.php?file=ge-settings&view=edit&AX=Yes" title="System Settings"><img src="<?php  echo  ADMIN_IMAGES?>setting-icon.gif"  alt="System Settings" title="System Settings" border="0" /></a></td>
                    <td width="66%">&nbsp;</td>

                </tr>
            </table>
        </td>
        <td>&nbsp;</td>
        <td valign="top">&nbsp;</td>
    </tr>
    <tr>
        <td valign="top">&nbsp;</td>
        <td valign="top">&nbsp;</td>
        <td valign="top">&nbsp;</td>
    </tr>
    <tr>
    <td valign="top" width="65%">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td class="gradient-strip"><img src="<?php  echo  ADMIN_IMAGES?>square-bullet.gif" align="absmiddle" border="0" alt=""/>Quick View</td>
            </tr>
            <tr>
                <td  class="inner-border">
                    <table  width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="100%" class="member-bg">Registered Security Manager</td>
                        </tr>
						<tr>
							<td colspan="3"></td>
						</tr>
                        <tr>
                            <td  valign="top" height="50">
                                <table width="100%" border="0" class="table-border-new" cellpadding="1" cellspacing="1">
                                    <tr >
                                        <th width="15%" valign="top" height="20">Today</th>
                                        <th width="35%" valign="top">Current Month</th>
                                        <th width="35%" valign="top">Current Year</th>
                                        <th width="15%" valign="top">Total</th>
                                    </tr>
                                    <tr bgcolor="#FFFFFF">
                                        <td align="center" height="30">
                                            <?php  echo  $t_mem_tod[0]['tot']?>
                                        </td>
                                        <td align="center">
                                            <?php  echo  $t_mem_mon[0]['tot']?>
                                        </td>
                                        <td align="center">
                                            <?php  echo  $t_mem_yr[0]['tot']?>
                                        </td>
                                        <td align="center">
                                            <?php  echo  $t_mem_a[0]['tot']?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>

						<tr>
							<td colspan="3"></td>
						</tr>

                    </table>
                </td>

            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
        <td valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td valign="top">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td class="gradient-strip"><img src="<?php  echo  ADMIN_IMAGES?>square-bullet.gif" align="absmiddle" border="0"/>Statistics</td>
                            </tr>
                            <tr>
                                <td class="inner-border">
                                    <table border="0" cellpadding="2" cellspacing="2" width="100%">
                                        <tr>
                                            <td width="50%" valign="top" class="vr-dottedline">
                                                <table border="0" cellpadding="1" cellspacing="1" width="97%">
                                                    <tr>
                                                        <td class="sub-heading">Administrator</td>
                                                    </tr>
                                                    <tr>
                                                        <td height="20">
                                                            <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1">
                                                                <tr>
                                                                    <td width="90%">Inactive</td>
                                                                    <td width="10%">
                                                                        <?php  echo  $t_admin_i[0]['tot'];?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Active</td>
                                                                    <td>
                                                                        <?php  echo  $t_admin_a[0]['tot'];?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Total</strong></td>
                                                                    <td><strong>
                                                                        <?php  echo  $t_admin[0]['tot']?>
                                                                        </strong></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td width="50%" valign="top" >
                                                <table border="0" cellpadding="1" cellspacing="1" width="97%">
                                                    <tr>
                                                        <td class="sub-heading">Security Manager</td>
                                                    </tr>
                                                    <tr>
                                                        <td height="20">
                                                            <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1">
                                                                <tr>
                                                                    <td width="90%">Block</td>
                                                                    <td width="10%">
                                                                        <?php  echo  $t_mem_b[0]['tot'];?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Inactive</td>
                                                                    <td>
                                                                        <?php  echo  $t_mem_i[0]['tot'];?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Active</td>
                                                                    <td>
                                                                        <?php  echo  $t_mem_a[0]['tot'];?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Total</strong></td>
                                                                    <td><strong>
                                                                        <?php  echo  $t_mem[0]['tot']?>
                                                                        </strong></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </td>
        <td>&nbsp;</td>
    </tr>
			<!--<tr>
                <td  class="inner-border">
                    <table  width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="100%" class="member-bg">User Plan Expairy</td>
                        </tr>
						<tr>
							<td colspan="3"></td>
						</tr>
                        <tr>
                            <td  valign="top" height="50">
                                <table width="100%" border="0" class="table-border-new" cellpadding="1" cellspacing="1">
                                    <tr >
                                        <th width="15%" valign="top" height="20">Today</th>
                                        <th width="35%" valign="top">Current Month</th>
                                        <th width="35%" valign="top">Current Year</th>
                                        <th width="15%" valign="top">Total</th>
                                    </tr>
                                    <tr bgcolor="#FFFFFF">
                                        <td align="center" height="30">
                                            <?php  //=$Mem_Plan_Tod[0]['tot']?>
                                        </td>
                                        <td align="center">
                                            <?php  //=$Mem_Plan_Mon[0]['tot']?>
                                        </td>
                                        <td align="center">
                                            <?php  //=$Mem_Plan_Yer[0]['tot']?>
                                        </td>
                                        <td align="center">
                                            <?php  //=$Mem_Plan_Tot[0]['tot']?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>

						<tr>
							<td colspan="3"></td>
						</tr>

                    </table>
                </td>

            </tr>-->
        </table>
    </td>
    <td width="1%"></td>
    <td colspan="2" valign="top">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td class="gradient-strip"><img src="<?php  echo  ADMIN_IMAGES?>square-bullet.gif" align="absmiddle" border="0" alt="" />Last login </td>
            </tr>
            <tr>
                <td class="inner-border">
                    <table width="100%" border="0" cellspacing="2" cellpadding="2">
                        <tr>
                            <td width="24%">Last login</td>
                            <td width="1%">:</td>
                            <td width="75%"><strong>
                                <?php  echo  DateTime($last_log[0]['dLoginDate'],"7");?>
                                </strong></td>
                        </tr>
                        <tr>
                            <td>IP address</td>
                            <td>:</td>
                            <td><strong>
                                <?php  echo  $last_log[0]['vIP'];?>
                                </strong></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td class="gradient-strip"><img src="<?php  echo  ADMIN_IMAGES?>square-bullet.gif" align="absmiddle" border="0" alt="" />Recent Online Members </td>
            </tr>
            <tr>
                <td class="inner-border">
                    <table width="100%" border="0" cellspacing="2" cellpadding="2">
                        <tr >
                            <th width="50%" align="left" valign="top">User Name</th>
                            <th width="50%" valign="top" align="left">IP</th>
                        </tr>
                        <?php  for($i=0;$i<2;$i++){?>
                        <tr>
                            <td width="50%" align="left">
                                <?php  echo  $online_mem[$i]['vCutomerName']?>
                            </td>
                            <td width="50%">
                                <?php  echo  $online_mem[$i]['vIP']?>
                            </td>
                        </tr>
                        <?php  }?>
                    </table>
                </td>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            </tr>

        </table>
    </td>
    </tr>

    <tr>
        <td colspan="4">&nbsp;</td>
    </tr>
    
</table>