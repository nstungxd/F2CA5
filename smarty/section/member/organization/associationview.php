<?php

include(S_SECTIONS."/member/memberaccess.php");

if(!isset($orgObj)) {
	require_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
	$orgObj = new Organization();
}
if(!isset($orgAssocObj)) {
	require_once(SITE_CLASS_APPLICATION."organization/class.OrganizationAssociation.php");
	$orgAssocObj = new OrganizationAssociation();
}
if(!isset($orgAssocVerifyObj)) {
    include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationAssociationToVerify.php");
    $orgAssocVerifyObj =	new OrganizationAssociationToVerify();
}

$OiAsociationID = $iAsociationID = $_GET['id'];
$view = 'verify';
$msg = $smarty->get_template_vars('MSG_NEED_VERIFY');
$orgAssocObj->setiAsociationID($iAsociationID);
$asocdt = $orgAssocObj->select();
// prints($asocdt); exit;
if($sess_usertype_short == 'OA' && $asocdt[0]['iBuyerOrganizationID']!=$curORGID) {
	header("Location: ".SITE_URL_DUM."associationlist");
	exit;
}
$vAsocode = $asocdt[0]['vAssociationCode'];
$fields = " *, (Select vCompanyName from b2b_organization_master where iOrganizationID=iBuyerOrganizationID) as vBuyerOrg,
					(Select vCompanyName from b2b_organization_master where iOrganizationID=iSupplierAssocationID) as vSupplierOrg ";
//$Oassorgdt = $assorgdt = $orgAssocObj->getDetails($fields," AND iAsociationID=$iAsociationID",'','','');
$Oassorgdt = $assorgdt = $orgAssocObj->getDetails($fields," AND vAssociationCode='$vAsocode'",'','','');
//print_r($iAsociationID);
// prints($assorgdt); exit;
for($l=0;$l<count($Oassorgdt);$l++) {
	if($Oassorgdt[$l]['eStatus'] == 'Need to Verify' || $Oassorgdt[$l]['eStatus'] == 'Modified' || $Oassorgdt[$l]['eStatus'] == 'Delete' || (($Oassorgdt[$l]['eStatus'] == 'Active' || $Oassorgdt[$l]['eStatus'] == 'Inactive') && $Oassorgdt[$l]['eNeedToVerify'] == 'Yes')) {
		$verifyreq = 'Yes';
	}
     /*if($assorgdt[$l]['eStatus'] == 'Modified' || (($assorgdt[$l]['eStatus'] == 'Active' || $assorgdt[$l]['eStatus'] == 'Inactive') && $assorgdt[$l]['eNeedToVerify'] == 'Yes'))
     {
        $verifyAssocreq='Yes';
     }*/
}
//print "a".$verifyreq;
//   prints($Oassorgdt);
$verifyreq =(isset($verifyreq))? $verifyreq : '';
if($verifyreq == 'Yes') {
     $orgAssocVerifyObj->setiAsociationID($iAsociationID);
	  $asocdt = $orgAssocObj->select();
	  $vAsocode = $asocdt[0]['vAssociationCode'];
     $fields = " *, SUBSTRING_INDEX(group_concat(vsuppliercode order by iverifiedid desc),',',1) AS vSupplierCode, (Select vCompanyName from b2b_organization_master where iOrganizationID=iBuyerOrganizationID) as vBuyerOrg,
                              (Select vCompanyName from b2b_organization_master where iOrganizationID=iSupplierAssocationID) as vSupplierOrg ";
     $assorgdt = $orgAssocVerifyObj->getDetails($fields," AND vAssociationCode='$vAsocode' and  (eStatus='Need to Verify' OR eStatus='Modified' OR eStatus='Delete' OR eNeedToVerify='Yes') AND eStatus!='' ",'iVerifiedID Desc',' vSupplierOrg ','');
    /* SELECT *,SUBSTRING_INDEX(group_concat(vsuppliercode order by iverifiedid desc),",",1) AS vSupplierCode, (Select vCompanyName from b2b_organization_master where iOrganizationID=iBuyerOrganizationID) as vBuyerOrg, (Select vCompanyName from b2b_organization_master where iOrganizationID=iSupplierAssocationID) as vSupplierOrg FROM b2b_organization_association_toverify
Where 1 AND
vAssociationCode='AS0000014'
Group By vsupplierorg order by iverifiedid desc
*/
   //  print "ab";
}
// prints($assorgdt); exit;
if(($assorgdt[0]['eStatus'] == 'Need to Verify'))
{
	switch($sess_usertype)
	{
		case 'securitymanager':
					if($assorgdt[0]['eCreatedBy']=='SM') {
						if($assorgdt[0]['iCreatedBy']!=$sess_id) {
							$verify = 'yes';
						} else {
							$verify = 'no';
						}
					}
					else {
						$verify = 'yes';
					}
					break;
		case 'orgadmin':
					if($assorgdt[0]['eCreatedBy']=='OA') {
						if($assorgdt[0]['iCreatedBy']!=$sess_id) {
							$verify = 'yes';
						} else {
							$verify = 'no';
						}
					}
					else {
						$verify = 'yes';
					}
					break;
	}
}
else if($assorgdt[0]['eStatus'] == 'Modified' || $assorgdt[0]['eStatus'] == 'Delete' || ($assorgdt[0]['eStatus'] == 'Inactive' && $assorgdt[0]['eNeedToVerify'] == 'Yes') || ($assorgdt[0]['eStatus'] == 'Active' && $assorgdt[0]['eNeedToVerify'] == 'Yes'))
{
	switch($sess_usertype)
	{
		case 'securitymanager':
					if($assorgdt[0]['eModifiedBy']=='SM') {
						if($assorgdt[0]['iModifiedByID']!=$sess_id) {
							$verify = 'yes';
						} else {
							$verify = 'no';
						}
					}
					else {
						$verify = 'yes';
					}
					break;
		case 'orgadmin':
					if($assorgdt[0]['eModifiedBy']=='OA') {
						if($assorgdt[0]['iModifiedByID']!=$sess_id) {
							$verify = 'yes';
						} else {
							$verify = 'no';
						}
					}
					else {
						$verify = 'yes';
					}
					break;
	}
	if($assorgdt[0]['eModifiedBy'] == 'SM' && $sess_usertype_short == 'OA') {
		$verify = 'no';
	}
}
// prints($verify); exit;
//prints($assorgdt);exit;
for($l=0;$l<count($assorgdt);$l++) {
if($assorgdt[$l]['eStatus'] == 'Need to Verify') {
	if($assorgdt[$l]['iCreatedBy'] == $sess_id){
		 $msg = $smarty->get_template_vars('MSG_OTHER_VERIFICATION_NEED');
	}
} else {
	switch($assorgdt[$l]['eStatus']){
		case "Modified":
			$status= 'Modified';
			if($assorgdt[$l]['iModifiedByID'] == $sess_id){
				$msg = $smarty->get_template_vars('MSG_OTHER_VERIFICATION_NEED');
			} else {
				$msg = $smarty->get_template_vars('MSG_VERIFY_MODIFICATION');
			}
		break;
		case "Delete":
			$status ='Delete';
			if($assorgdt[$l]['iModifiedByID'] == $sess_id){
				$msg = $smarty->get_template_vars('MSG_OTHER_VERIFICATION_NEED');
			} else {
				$msg = $smarty->get_template_vars('MSG_VERIFY_DELETE');
			}
		break;
		case "Inactive":
			if($assorgdt[$l]['eNeedToVerify'] == 'Yes'){
				$status ='Inactive';
				if($assorgdt[$l]['iModifiedByID'] == $sess_id){
					$msg = $smarty->get_template_vars('MSG_OTHER_VERIFICATION_NEED');
				} else {
				  $msg = $smarty->get_template_vars('MSG_VERIFY_INACTIVE');
				}
			}
		break;
	}
}
}
// prints($assorgdt); exit;
$asvrfy = array();
for($l=0;$l<count($assorgdt);$l++) {
     //print $assorgdt[$l]['eStatus']."<br>";
	if($assorgdt[$l]['eStatus'] == 'Need to Verify' || $assorgdt[$l]['eStatus'] == 'Modified' || $assorgdt[$l]['eStatus'] == 'Delete' || (($assorgdt[$l]['eStatus'] == 'Active' || $assorgdt[$l]['eStatus'] == 'Inactive') && $assorgdt[$l]['eNeedToVerify'] == 'Yes')) {
		$assorgdt[$l]['vsh'] = 'Yes';
		$vrf = 'y';
		$asvrfy[] = $assorgdt[$l]['iAsociationID'];
		$msg = $smarty->get_template_vars('MSG_VERIFY_MODIFICATION');
	}
}
// $Oassorgdt[0]['eStatus']=='Active' && $Oassorgdt[0]['eNeedToVerify']!='Yes' &&
$chngno = $orgAssocObj->getDetails('iChangeNo'," AND vAssociationCode='$vAsocode' ",' iChangeNo DESC ','',' LIMIT 0,1 ');
$chngno = $chngno[0]['iChangeNo'];
$lmt = @count($Oassorgdt);
$asocdt = $orgAssocObj->select($iAsociationID);
$vAsocode = $asocdt[0]['vAssociationCode'];
$ntvascdt = $orgAssocVerifyObj->getDetails('*'," AND vAssociationCode='$vAsocode' AND iChangeNo>$chngno ",'iVerifiedID Desc',''," LIMIT 0,$lmt");
$vassorgdt = $ntvascdt;
// prints($ascorgdt); exit;
$vrf =(isset($vrf))? $vrf : '';
if($vrf!='y') {
	$chng = 'yes';
	$assorgdt = $Oassorgdt;
}
// prints($_SERVER); exit;
$backpage = $_SERVER['HTTP_REFERER'];
// echo $backpage;
// prints($vassorgdt); exit;
$msg =(isset($msg))? $msg : '';
$status =(isset($status))? $status : '';
$verify =(isset($verify))? $verify : '';

$asvf_len =  count($asvrfy);
$len = @count($assorgdt);
$smarty->assign('iAsociationID',$iAsociationID);
$smarty->assign('assorgdt',$assorgdt);
$smarty->assign('OiAsociationID',$OiAsociationID);
$smarty->assign('Oassorgdt',$Oassorgdt);
$smarty->assign('vassorgdt',$vassorgdt);
$smarty->assign('view',$view);
$smarty->assign('msg',$msg);
$smarty->assign('asvrfy',$asvrfy);
$smarty->assign('status',$status);
$smarty->assign('verify',$verify);
$smarty->assign('verifyreq',$verifyreq);
$smarty->assign('len',$len);
$smarty->assign('vrf',$vrf);
$smarty->assign('asvf_len',$asvf_len);
?>