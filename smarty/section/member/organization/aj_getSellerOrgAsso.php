<?php
/**
 * @author hidden
 * @copyright 2010
 */

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

$view = (isset($_GET['view']))? $_GET['view'] : '';
$iAsociationID = $_GET['iAsociationID'];
$iBuyerOrganizationID = $_GET['iBuyerOrganizationID'];
$asocCode = '';
if($view == 'edit' || (trim($iAsociationID) != '' && is_numeric($iAsociationID)) ) {
	$asocdtls = $orgAssocObj->select($iAsociationID);
	$asocCode = $asocdtls[0]['vAssociationCode'];
} else {
     $regno = $_GET['regno'];
     $orgcode = $_GET['orgcode'];
     $orgname = $_GET['orgname'];
}
// prints($_GET);exit;
$ISSEARCHED = 'No';
$regno = (isset($regno))? $regno : '';
if(trim($regno) != '') {
	$where = " AND vCompanyRegNo REGEXP '^".$regno."'";
   $ISSEARCHED = 'Yes';
}
$orgcode = (isset($orgcode))? $orgcode : '';
if(trim($orgcode) != '') {
	$where .= " AND vOrganizationCode LIKE '$orgcode%'";
   $ISSEARCHED = 'Yes';
}
$orgname = (isset($orgname))? $orgname : '';
if(trim($orgname) != '') {
	$where .= " AND vCompanyName LIKE '%$orgname%'";
   $ISSEARCHED = 'Yes';
}
$whr = (isset($whr))? $whr : '';
if(trim($asocCode) != '') {
	$whr .= " AND vAssociationCode!='$asocCode'";
}
// $where .= " AND  eOrganizationType !='Buyer' AND iOrganizationID!=$iBuyerOrganizationID";
$where .= " AND  eOrganizationType NOT IN ('Buyer','Buyer2') AND iOrganizationID!=$iBuyerOrganizationID
            AND iOrganizationID NOT IN (Select iSupplierAssocationID from ".PRJ_DB_PREFIX."_organization_association where iBuyerOrganizationID=$iBuyerOrganizationID) ";
$sellerorgs = $orgAssocObj->getDetails('iSupplierAssocationID'," AND iBuyerOrganizationID=$iBuyerOrganizationID $whr ");
// prints($asocCode); exit;
/*$slorgs = $orgAssocObj->getDetails('iSupplierAssocationID'," AND iBuyerOrganizationID=$iBuyerOrganizationID AND (eStatus='Need to Verify' || eStatus='Modified' || eStatus='Delete' || eNeedToVerify='Yes') ");
// AND (eStatus='Active' AND eNeedToVerify='No')
foreach($slorgs as $k=>$v) {
        $starr[] = $v['iSupplierAssocationID'];
}
if(is_array($slorgs) && count($slorgs)>0) {
	$islorgs = @implode(',',$starr);
}
else if(trim($slorgs[0]['iSupplierAssocationID']) != '') {
	$islorgs = $slorgs[0]['iSupplierAssocationID'];
}
// echo $islorgs; exit;
*/
if(is_array($sellerorgs)) {
	foreach($sellerorgs as $k=>$v) {
		$starr[] = $v['iSupplierAssocationID'];
	}
}

$sellerorgs[0]['iSupplierAssocationID'] = (isset($sellerorgs[0]['iSupplierAssocationID']))? $sellerorgs[0]['iSupplierAssocationID'] : '';
$iSellerOrgs = (isset($sellerorgs[0]['iSupplierAssocationID']))? $sellerorgs[0]['iSupplierAssocationID'] : '';
if(is_array($sellerorgs) && count($sellerorgs)>0) {
	$iSellerOrgs = @implode(',',$starr);
}
else if(trim($sellerorgs[0]['iSupplierAssocationID']) != '') {
	$iSellerOrgs = $sellerorgs[0]['iSupplierAssocationID'];
}
// prints($iSellerOrgs); exit;
if(trim($iSellerOrgs) != '')
{
		/*  if($ISSEARCHED != 'Yes'){
				$where .= " AND iOrganizationID IN ($iSellerOrgs) ";
			}else{
		*/
	  //$where .= " AND iOrganizationID NOT IN ($iSellerOrgs) ";
		/*if($islorgs != '')
			$where .= " AND iOrganizationID NOT IN ($iSellerOrgs".','."$islorgs) ";
		else
			$where .= " AND iOrganizationID NOT IN ($iSellerOrgs) ";
		 */
	//   }
}
// echo $where;exit;
$orderBy = " iOrganizationID Asc";
//echo $where; exit;
$res = $orgObj->getDetails('vOrganizationCode,vCompanyName,vCompanyRegNo,iOrganizationID',$where,$orderBy);
// print_r($res);exit;
if(count($res)>0 && is_array($res)) {
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td class="blue-hadd-bg">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		 <td width="30px" height="26" >&nbsp;
			  <input type="checkbox" class="radib-btn" name="uid_chkall" id="uid_chkall" style="vertical-align:middle;" />
		 </td>
		 <td width="70px" >Reg. No. </td>
		 <td width="100px" >Organization Code</td>
		 <td width="100px" >Organization Name</td>
		 <td width="70px" align="center">Code </td>
		</tr>
		</table>
		</td>
		</tr>
		<tr>
			<td>
			<div style="height:103px; overflow:auto;" class="scrollbar " >
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php  				for($l=0;$l<count($res);$l++)
				{
?>				  <tr class="<?php echo ($l%2 == 0)? 'golden-bg' : 'listing-white-bg';?>">
					<td width="30px" height="26" >&nbsp;
						<input type="checkbox" class="radib-btn" name="orgid[]" id="orgid<?php echo $res[$l]['iOrganizationID']?>" style="vertical-align:middle;" value="<?php echo $res[$l]['iOrganizationID']?>" />
					</td>
					 <td width="70px" >
						<?php echo $res[$l]['vCompanyRegNo']?>
						 <input type="hidden" class="radib-btn" name="cmpregno[]" id="cmpregno<?php echo $res[$l]['iOrganizationID']?>" style="vertical-align:middle;" value="<?php echo $res[$l]['vCompanyRegNo']?>" />
					 </td>
					 <td width="100px" >
						<?php echo $res[$l]['vOrganizationCode']?>
						 <input type="hidden" class="radib-btn" name="cmporgcode[]" id="cmporgcode<?php echo $res[$l]['iOrganizationID']?>" style="vertical-align:middle;" value="<?php echo $res[$l]['vOrganizationCode']?>" />
					 </td>
					 <td width="100px" >
						<?php echo $res[$l]['vCompanyName']?>
						<input type="hidden" class="radib-btn" name="cmpname[]" id="cmpname<?php echo $res[$l]['iOrganizationID']?>" style="vertical-align:middle;" value="<?php echo $res[$l]['vCompanyName']?>" />
					 </td>
					 <td width="70px" align="right" ><input type="text" name="vAssociationCode[<?php echo $dt[$l]['iOrganizationID']?>]" class="input-rag" id="vAssociationCode<?php echo $res[$l]['iOrganizationID']?>" style="width:50px; vertical-align:middle;" />&nbsp;</td>
				  </tr>
<?php  				}	?>
			</table>
			</div>
		</td>
	</tr>
</table>
<script>
$('#insert_btn').show();
</script>
<?php
} else {
?>
	<div id="result" align="center">No Organizations Found.</div>
   <script>
$('#insert_btn').hide();
</script>
<?php
}
?>
<script type="text/javascript">
$('#uid_chkall').click( function ()
{
	orgs = $('input:checkbox[name="orgid\[\]"]');
	if($(this).attr('checked')) {
		$.each(orgs, function (ln,el) {
			$(this).attr('checked','checked');
		});
	} else {
		$.each(orgs, function (ln,el) {
			$(this).attr('checked','');
		});
	}
});
/*$('input[name="vAssociationCode\[\]"]').blur( function ()
{
	var crid = $(this).attr('id');
	el = $(this);
	asocd = $('input[name="vAssociationCode\[\]"]');
	$.each(asocd, function() {
		if(crid != $(this).attr('id')) {
			if(el.val() == $(this).val()) {
				alert("Association Code Already In Use");
				return false;
			}
		}
	});
});*/
</script>
<?php
	exit;
//$smarty->assign("dt",$res);

/*
$html="";
if(count($res) > 0) {
   $i=0;
   foreach($res as $arr) {
      $html.="<span style='display:none'>".$arr['Id']."</span>".$arr['vTitle'];
      if($i < count($res)){
         $html.="\n";
      }
   }
}
echo $html;
exit;
 */
?>