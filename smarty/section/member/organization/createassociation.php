<?php

include(S_SECTIONS."/member/memberaccess.php");

$iAsociationID = $_GET['id'];
//$msg = GetVar('msg');
//prints($_SESSION);exit;
$msg=(isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']))? $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG'] : '';
unset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']);

if($msg == 'ras') {
   $msg = $smarty->get_template_vars('MSG_ADD_SUCC');
} elseif($msg == 'raserr') {
   $msg = $smarty->get_template_vars('MSG_ADD_ERR');
} elseif($msg == 'rus') {
   $msg = $smarty->get_template_vars('MSG_UPDATE_SUCC');
} elseif($msg == 'ruserr') {
   $msg = $smarty->get_template_vars('MSG_UPDATE_ERR');
}else{
   $msg='';
}

if(!isset($orgAssocObj)) {
	require_once(SITE_CLASS_APPLICATION."organization/class.OrganizationAssociation.php");
	$orgAssocObj = new OrganizationAssociation();
}
if(!isset($orgObj)) {
    include_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
    $orgObj =	new Organization();
}

if(isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']) && $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'] != '' ) {
   include(SITE_CLASS_GEN."class.validation.php");
   $validation=new Validation();

   $msg = $validation->CreateHtmlMsg($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']);
   unset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']);
}
$assorgdt = array();
$res = array();
$sellerorgs = array();
$newarr = array();
if($iAsociationID != '') {
     $view = 'edit';
     $orgAssocObj->setiAsociationID($iAsociationID);
     $fields = " *, (Select vCompanyName from b2b_organization_master where iOrganizationID=iBuyerOrganizationID) as vBuyerOrg,
                         (Select vCompanyName from b2b_organization_master where iOrganizationID=iSupplierAssocationID) as vSupplierOrg ";
     $assorgdt = $orgAssocObj->getDetails($fields," AND iAsociationID=$iAsociationID",'','','');
	 if($sess_usertype_short == 'OA' && $assorgdt[0]['iBuyerOrganizationID']!=$curORGID) {
		 header("Location: ".SITE_URL_DUM."associationlist");
		 exit;
	 }
     // prints($assorgdt);exit;
     if($assorgdt[0]['eStatus'] == 'Need to Verify' || $assorgdt[0]['eStatus'] == 'Modified') {
          header('Location:'.SITE_URL_DUM.'associationview/'.$iAsociationID);
          exit;
     }
     $orgdata = $orgObj->select($assorgdt[0]['iBuyerOrganizationID']);
     $orgdata[0]['iBuyerOrganizationID']=$assorgdt[0]['iBuyerOrganizationID'];
          $where .= " AND  eOrganizationType!='Buyer' AND iOrganizationID!='".$assorgdt[0]['iBuyerOrganizationID']."'";
          $sellerorgs = $orgAssocObj->getDetails('iSupplierAssocationID,vSupplierCode'," AND iBuyerOrganizationID='".$assorgdt[0]['iBuyerOrganizationID']."' AND vAssociationCode='".$assorgdt[0]['vAssociationCode']."' AND ((eStatus='Active' || eStatus='Inactive') AND eNeedToVerify!='Yes')");
			 // exit;
               foreach($sellerorgs as $k=>$v) {
               if($v['iSupplierAssocationID'] != 0) {
                  $newarr[$v['iSupplierAssocationID']]['vSupplierCode'] = $v['vSupplierCode'];
               }
                  $starr[] = $v['iSupplierAssocationID'];
               }
               if(is_array($sellerorgs) && count($sellerorgs)>0)
               {
                    $iSellerOrgs = @implode(',',$starr);
               }
               else if(trim($sellerorgs[0]['iSupplierAssocationID']) != '')
               {
                    $iSellerOrgs = $sellerorgs[0]['iSupplierAssocationID'];
               }
               if(trim($iSellerOrgs) != '')
               {
                    $where .= " AND iOrganizationID IN ($iSellerOrgs)";
               }
               $orderBy = " iOrganizationID Asc";
               $res = $orgObj->getDetails('vOrganizationCode,vCompanyName,vCompanyRegNo,iOrganizationID',$where,$orderBy);
               // prints($res);exit;

}else
{
    $orgdata[0]=(isset($_SESSION['Data']))? $_SESSION['Data'] : '';
    //$orgdata[0]['iBuyerOrganizationID']=$assorgdt[0]['iBuyerOrganizationID'];
    unset ($_SESSION['Data']);
}

if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'] == 'OA') {
   $orgname = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGNAME'];
}

$vAssociationCode =(isset($assorgdt[0]['vAssociationCode']))? $assorgdt[0]['vAssociationCode'] : '';
$alasocdt = $orgAssocObj->getDetails('*'," AND vAssociationCode='$vAssociationCode'");

$view =(isset($view))? $view : '';
if($view != 'edit') {
	$vAssociationCode = $generalobj->UniqueID("AS",PRJ_DB_PREFIX."_organization_association","vAssociationCode",$charlimit="10");
	$data['vAssociationCode'] = $vAssociationCode;
} else if($view == 'edit') {
     //prints($alasocdt);exit;
	for($l=0;$l<count($alasocdt);$l++) {
		if($alasocdt[$l]['eStatus'] == 'Need to Verify' || $alasocdt[$l]['eStatus'] == 'Modified' || $alasocdt[$l]['eStatus'] == 'Delete' || (($alasocdt[$l]['eStatus'] == 'Active' || $alasocdt[$l]['eStatus'] == 'Inactive') && $alasocdt[$l]['eNeedToVerify'] == 'Yes')) {
			$verifyreq = 'Yes';
        //       prints($alasocdt[$l]);
      //         print"<br>";
		}
	}
    // exit;
    $verifyreq = (isset($verifyreq))? $verifyreq : '';
	if($verifyreq == 'Yes') {
		header('Location:'.SITE_URL_DUM.'associationview/'.$iAsociationID);
      exit;
	}
}
$uoa = '';
$bodt = array();
if($sess_usertype_short=='OA' && $view!='edit') {
   $uoa='yes';
	$bodt = $orgObj->select($curORGID);
}
// prints($newarr);exit;
// prints($sellerorgs);exit;
//print_r($orgdata);
//prints($assorgdt);

$orgname=(isset($orgname))? $orgname : '';

$smarty->assign('iAsociationID',$iAsociationID);
$smarty->assign('msg',$msg);
$smarty->assign('view',$view);
$smarty->assign('assorgdt',$assorgdt);
$smarty->assign('orgdata',$orgdata);
$smarty->assign('res',$res);
$smarty->assign('uoa',$uoa);
$smarty->assign('bodt',$bodt);
$smarty->assign('sellerorgs',$sellerorgs);
$smarty->assign('newarr',$newarr);
$smarty->assign('orgname',$orgname);
$smarty->assign('vAssociationCode',$vAssociationCode);
//prints($orgdata);

?>