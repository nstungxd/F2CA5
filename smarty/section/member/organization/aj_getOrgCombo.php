<?php
include(S_SECTIONS."/member/memberaccess.php");

if(!isset($orgObj))
{
	require_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
	$orgObj = new Organization;
}
if(!isset($orgAssocObj))
{
	require_once(SITE_CLASS_APPLICATION."organization/class.OrganizationAssociation.php");
	$orgAssocObj = new OrganizationAssociation();
}
//prints($_GET);exit;
$view = (isset($_GET['view']))? $_GET['view'] : '';
$iUserID = $_GET['iUserID'];

     $regno = $_GET['regno'];
     $orgcode = $_GET['orgcode'];
     $orgname = $_GET['orgname'];
 //prints($_GET);exit;

//$ISSEARCHED = 'No';
if(trim($regno) != '') {
	$where = " AND vCompanyRegNo REGEXP '^".$regno."'";
   $ISSEARCHED = 'Yes';
}
if(trim($orgcode) != '') {
	$where .= " AND vOrganizationCode LIKE '$orgcode%'";
   $ISSEARCHED = 'Yes';
}
if(trim($orgname) != '') {
	$where .= " AND vCompanyName LIKE '%$orgname%'";
   $ISSEARCHED = 'Yes';
}
$where .= " AND eStatus!='Need to Verify' AND eStatus!='Inactive' AND NOT (eStatus='Delete' AND eNeedToVerify='No') ";

if(!isset($ENABLE_AUCTION) || $ENABLE_AUCTION=='No') {
   $where .= " AND eOrganizationType!='Buyer2'";
}

/*
if(trim($asocCode) != '') {
	$whr .= " AND vAssociationCode!='$asocCode'";
}
*/

//$where .= "AND iUserID!=$iUserID";
// $whr .= "";
$whr = (isset($whr))? $whr : '';
$sellerorgs = $orgAssocObj->getDetails('iSupplierAssocationID'," AND iUserID=$iUserID $whr ");
//echo $where;exit;

$orderBy = " iOrganizationID Asc";
// echo $where; exit;
$res = $orgObj->getDetails('vOrganizationCode,vCompanyName,vCompanyRegNo,iOrganizationID',$where,$orderBy);
// prints($res);exit;
$cnt = count($res);
//echo $cnt;exit;
?>
	<select name="Data[iOrganizationID]" id="iOrganizationID" class="required" title="<?php echo $smarty->get_template_vars('MSG_SELECT_ORGANIZATION')?>" onchange="return fillCompData(this.options[this.selectedIndex].value);" >
		<option value=''>---<?php echo $smarty->get_template_vars('MSG_SELECT_ORGANIZATION')?>---</option>
		<?php
			for($i=0;$i<$cnt;$i++) {
		?>
			<option value="<?php echo $res[$i]['iOrganizationID']?>"><?php echo $res[$i]['vCompanyName']?></option>
		<?php  }
		?>
	</select>
<?php
exit;
?>