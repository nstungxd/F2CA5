<?php
include(S_SECTIONS."/member/memberaccess.php");

if(!isset($orgAssocObj)) {
	require_once(SITE_CLASS_APPLICATION."organization/class.OrganizationAssociation.php");
	$orgAssocObj = new OrganizationAssociation();
}
if(!isset($orgObj)) {
   include_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
   $orgObj =	new Organization();
}
$view = $_GET['view'];
$iOrganizationID =(isset($_GET['iOrganizationID']))? $_GET['iOrganizationID'] : '';
$username =(isset($_GET['username']))? $_GET['username'] : '';
$orgtxt = (isset($_GET['orgtxt']))? $_GET['orgtxt'] : '';
$orgtyp = (isset($_GET['orgtyp']))? $_GET['orgtyp'] : '';
$res = Array();
if(trim($orgtxt)!='') {
   $where = '';
   if(!isset($ENABLE_AUCTION) || $ENABLE_AUCTION=='No') {
      $where .= " AND eOrganizationType!='Buyer2' ";
   }
	if(trim($orgtyp)=='Buyer') {
		$where .= " AND eOrganizationType IN ('Buyer','Both')";
	} else if(trim($orgtyp)=='Supplier') {
		$where .= " AND eOrganizationType IN ('Supplier','Both')";
	} else if(trim($orgtyp)!='') {
		$where .= " AND eOrganizationType='$orgtyp' ";
	}
	$sql="select iOrganizationID AS iBuyerOrganizationID,vCompanyName from ".PRJ_DB_PREFIX."_organization_master where vCompanyName like '%$orgtxt%' AND eStatus!='Need to Verify' AND eStatus!='Inactive' $where ";
	// echo $sql; exit;
	$res=$dbobj->MySqlSelect($sql);
}

$cnt=count($res);
$db_sql = Array();
if(trim($username)!='') {
   $where = '';
   if(!isset($ENABLE_AUCTION) || $ENABLE_AUCTION=='No') {
      $where .= " AND iOrganizationID NOT IN (Select iOrganizationID from ".PRJ_DB_PREFIX."_organization_master where eOrganizationType='Buyer2')";
   }
	$sql="select concat(vFirstName,' ',vLastName) as name,iUserId  from ".PRJ_DB_PREFIX."_organization_user where iOrganizationID=$iOrganizationID and (vFirstName like '%$username%' or vLastName like '%$username%') AND eUserType='User' AND ePermissionType='Individual' AND eStatus!='Need to Verify' AND eStatus!='Inactive' $where";
	$db_sql = $dbobj->MySqlSelect($sql);
}
// pr($db_sql); exit;
$count=count($db_sql);
if($view=='asociation') {
?>
                <select name="Data[iBuyerOrganizationID]" id="iBuyerOrganizationID" style="width:230px;" readonly>
    					  <option value="">---<?php echo $smarty->get_template_vars('MSG_SELECT_BUYER_ORGANIZATION')?>---</option>
              			<?php
                   for($i=0;$i<$cnt;$i++){
                  ?>
                    <option value="<?php echo $res[$i]['iBuyerOrganizationID']?>"><?php echo $res[$i]['vCompanyName']?></option>
    					     <?php  }?>
                </select>

<?php

}elseif($view=='group'){
?>                 <select name="Data[iOrganizationID]" id="iOrganizationID" class="required" title="<?php echo $smarty->get_template_vars('MSG_SELECT_ORGANIZATION')?>" style="width:230px" onchange='$("#OrgStatus_Div").load(SITE_URL+"index.php?file=or-aj_getOrganizationStatus&type=user&iId="+this.value+"&prms="+prms+"&acpt="+acpt+"&grpid="+this.value); rset();'>
                                          <option value="">---<?php echo $smarty->get_template_vars('MSG_SELECT_ORGANIZATION')?>---</option>

														<?php
                            for($i=0;$i<$cnt;$i++){   ?>

													<option value="<?php echo $res[$i]['iBuyerOrganizationID']?>"><?php echo $res[$i]['vCompanyName']?></option>
														 <?php  }?>

                        </select>

<?php  }
elseif($view=='orgright') {

  ?>                  <select name="Data[iOrganizationID]" id="iOrganizationID" class="required" title="<?php echo $smarty->get_template_vars('MSG_SELECT_ORGANIZATION')?>" style="width:200px" onchange='$("#iUserID").load(SITE_URL+"index.php?file=u-aj_getUser&icompid="+$("#iOrganizationID").val()+"&type=User"+"&htmlTag=option"+"&orgtype=user")'>
                      <option value="">---<?php echo $smarty->get_template_vars('MSG_SELECT_ORGANIZATION')?>---</option>

														<?php
                            for($i=0;$i<$cnt;$i++){   ?>

													<option value="<?php echo $res[$i]['iBuyerOrganizationID']?>"><?php echo $res[$i]['vCompanyName']?></option>
														 <?php  }?>

                        </select>


<?php  }
elseif($view=='username') {
?>
	<select  name="Data[iUserID]" id="iUserID" class="required" title="<?php echo $smarty->get_template_vars('MSG_SELECT_ORGANIZATION')?>" style="width:200px" onchange='$("#OrgStatus_Div").load(SITE_URL+"index.php?file=u-aj_getOrganizationUserStatus&type=user&iId="+this.value);'>
	<option value="">---<?php echo $smarty->get_template_vars('LBL_SELECT')?> <?php echo $smarty->get_template_vars('LBL_ORG_USER')?>---</option>
	<?php
	for($j=0;$j<$count;$j++){   ?>
		<option value="<?php echo $db_sql[$j]['iUserId']?>"><?php echo $db_sql[$j]['name']?></option>
	<?php  }?>
	</select>
<?php  }
exit;
?>