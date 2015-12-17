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
if(!isset($secManObj)) {
	require_once(SITE_CLASS_APPLICATION."$usersec/class.SecurityManager.php");
	$secManObj = new SecurityManager();
}
if(!isset($userActionObj)) {
     include_once(SITE_CLASS_APPLICATION.'user/class.UserActionVerification.php');
     $userActionObj = new UserActionVerification();
}
if(!isset($emailObj)) {
     include_once(SITE_CLASS_APPLICATION.'class.EmailTemplate.php');
     $emailObj = new EmailTemplate();
}
if(!isset($sendMail)) {
	include_once(SITE_CLASS_GEN."class.sendmail.php");
	$sendMail = new SendPHPMail();
}
if(!isset($orgUsrObj)) {
	require_once(SITE_CLASS_APPLICATION."user/class.OrganizationUser.php");
	$orgUsrObj = new OrganizationUser();
}

$dt = PostVar('Data');
$view = PostVar('view');
$status = PostVar('status');
$iAsociationID = PostVar('iAsociationID');
$iBuyerOrganizationID = $dt['iBuyerOrganizationID'];
$vAssociationCode = $dt['vAssociationCode'];

$where = 'AND iSMID != '.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'].' AND eStatus = "Active" AND eEmailNotification="Yes" ';
$smdtls = $secManObj->getDetails('*',$where);
//
if($sess_usertype_short == 'SM') {
	$wh = " AND iSMID!=$sess_id ";
}
$where = $wh.' AND eStatus = "Active" ';
$sar = $secManObj->getDetails('*',$where);

if($sess_usertype_short == 'OA') {
   $whu = " AND iUserID!=$sess_id ";
}
$where = $whu.' AND eStatus="Active" AND eUserType="Admin" AND iOrganizationID='.$curORGID.' ';
$uar = $orgUsrObj->getDetails('*',$where);
// prints($uarr); exit;
if(is_array($sar) && is_array($uar)) {
	$emlar = array_merge($sar,$uar);
} else if(is_array($sar)) {
	$emlar = $sar;
} else if(is_array($uar)) {
	$emlar = $uar;
}

// $orgObj->setiOrganizationID($dt['iBuyerOrganizationID']);
$dt = $orgObj->select($iBuyerOrganizationID);
$vBuyerCode = $dt[0]['vOrganizationCode']; 	// $orgObj->getvOrganizationCode();
$vBuyerName = $dt[0]['vCompanyName'];
$iSupplierAssocationID = PostVar('assocorgs');
$del = PostVar('del');
// prints($_POST); exit;
// $arr=$orgAssocObj->getDetails('iBuyerOrganizationID',' AND iAsociationID="'.$iAsociationID.'" and eStatus != "Inactive" ');

//$vSupplierCode = PostVar('suporgcode');
$vSupplierCode = PostVar('assocCode');
$data['iBuyerOrganizationID'] = $iBuyerOrganizationID;
$data['vAssociationCode'] = $vAssociationCode;
$data['vBuyerCode'] = $vBuyerCode;
$data['iCreatedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
$data['eCreatedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
// pr($data); exit;
// if(count($emlar) > 0){
   $data['eStatus'] = 'Need to Verify';
/*}else{
   $data['eStatus'] = 'Active';
}*/

### CHECK MULTIPLE ADMIN AVAILABLE FOR THIS ORGANIZATION OR NOT
/*$chkMulAdmin = $orgObj->ChkMultipleOrgAdmin();
if($chkMulAdmin == '1'){
   $data['eStatus'] = 'Active';
}else{
   $data['eStatus'] = $data['eStatus'];
}*/
$asoc_ary = array();
//$assarr = $orgAssocObj->getDetails('*'," AND iBuyerOrganizationID=$iBuyerOrganizationID",'iAsociationID Asc','','');
$assarr = $orgAssocObj->getDetails('*'," AND vAssociationCode='".$vAssociationCode."'",' iSupplierAssocationID Asc ','','');
for($l=0;$l<count($assarr);$l++) {
	$asoc_ary[] = $assarr[$l]['iSupplierAssocationID'];
	$asocd[$assarr[$l]['iSupplierAssocationID']] = $assarr[$l];
}
// prints($assarr);exit;
// prints($_POST);exit;
// echo $view; exit;
if($view == 'reject')
{
	$reasonToReject = $_POST['tReasonToReject'];
   $dt['eNeedToVerify'] = $dts['eNeedToVerify'] = 'No';
	$dt['eStatus'] = $dts['eStatus'] = "Active";
	$asorgdtls = $orgAssocObj->getDetails('*'," AND iAsociationID=$iAsociationID ");
	$where = " AND vAssociationCode='".$asorgdtls[0]['vAssociationCode']."'";
	$updt=$orgAssocObj->getDetails('*',$where);

	$aAssocArr=$_POST['vSupplierOrg'];

//	prints($updt); exit;
	if(is_array($aAssocArr)) {
	for($ln=0;$ln<count($updt); $ln++) {
		$avrdt = $orgAssocVerifyObj->getDetails("*"," AND iAsociationID=".$updt[$ln]['iAsociationID'].""," iVerifiedID DESC ");
	  if(in_array($updt[$ln]['iAsociationID'],$aAssocArr))
	  {
		if($updt[$ln]['eStatus']=='Need to Verify') {
			$dt['eStatus'] = $dts['eStatus'] = "Delete";
		} else if($avrdt[0]['eStatus']=='Inactive' && $avrdt[0]['eNeedToVerify']=='Yes') {
			$dt['eNeedToVerify'] = $dts['eNeedToVerify'] = "No";
			$dt['eStatus'] = $dts['eStatus'] = "Active";
		} else if($avrdt[0]['eStatus']=='Active' && $avrdt[0]['eNeedToVerify']=='Yes') {
			$dt['eNeedToVerify'] = $dts['eNeedToVerify'] = "No";
			$dt['eStatus'] = $dts['eStatus'] = "Inactive";
		} else if($updt[$ln]['eStatus']=='Modified') {
			$dt['eStatus'] = $dts['eStatus'] = "Active";
			$dts['iModifiedByID'] = "";
			$dts['eModifiedBy'] = "";
		} else if($updt[$ln]['eStatus']=='Delete') {
			$dt['eStatus'] = $dts['eStatus'] = "Active";
			$dts['iModifiedByID'] = "";
			$dts['eModifiedBy'] = "";
		}
		if($dt['eStatus'] == 'Delete') {
			$where = " AND iAsociationID='".$updt[$ln]['iAsociationID']."'";
         $res = $orgAssocObj->del($where);
			$dt['eStatus'] = $dts['eStatus'] = "Inctive";
			$dt['eNeedToVerify'] = $dts['eNeedToVerify'] = "No";
		} else {
			$res = $orgAssocObj->updateData($dts," iAsociationID=".$updt[$ln]['iAsociationID']);
		}
		$dt['iRejectedById'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
		$dt['eRejectedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
		$dt['tReasonToReject'] = $reasonToReject[$updt[$ln]['iAsociationID']];
		$dt['dRejectedDate'] = date("Y-m-d H:i:s");
	//	$vrfydtls = $orgAssocVerifyObj->getDetails('*'," AND iAsociationID=$iAsociationID "," AND dCreatedDate DESC",''," LIMIT 0,1");
		$rs = $orgAssocVerifyObj->updateData($dt," iAsociationID=".$updt[$ln]['iAsociationID']);
	  }
	}
	}
	if($res) {
		$msg = "rus";
	}
	else {
		$msg = "ruserr";
	}
        $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']=$msg;
	header("Location:".SITE_URL_DUM."associationlist/".$msg);
   exit;
}

if($view == 'verify')
{
	//prints($_POST); exit;
   $where = " AND iAsociationID='".$iAsociationID."'";
   $orderby = 'iVerifiedID Desc';
   $vrfdata=$orgAssocVerifyObj->getDetails('*',$where,$orderby,'',' LIMIT 0,1 ');
 //prints($vrfdata);exit;

//	$asocdt = $orgAssocObj->select();
	$vAsocode = $vrfdata[0]['vAssociationCode'];
	      // print_r($vrfdata[0]);
	 $orgAssocVerifyObj->updateData(array("eStatus"=>'Inactive'), 'vAssociationCode="'.$vAsocode.'" and iBuyerOrganizationID!="'.$vrfdata[0]['iBuyerOrganizationID'].'"');
	 $orgAssocObj->updateData(array("iBuyerOrganizationID"=>$vrfdata[0]['iBuyerOrganizationID'],"eStatus"=>"Inactive"), 'vAssociationCode="'.$vAsocode.'" and iBuyerOrganizationID!="'.$vrfdata[0]['iBuyerOrganizationID'].'"');

		 //   exit;
	$where = " AND vAssociationCode='".$vAsocode."' AND (eStatus='Need to Verify' OR eStatus='Modified' OR eNeedToVerify='Yes' OR eStatus='Delete') ";
	// $where = " AND vAssociationCode='".$vAsocode."' AND (eStatus!='Active' OR eNeedToVerify='Yes') ";
	$updt=$orgAssocVerifyObj->getDetails('*',$where);
	// prints($updt); exit;
//	prints($_POST);
//exit;
//	prints($updt); exit;
     $aAssocArr=$_POST['vSupplierOrg'];
	// prints($aAssocArr); //exit;
     // echo $status; exit;
	  //prints($aAssocArr);
     //prints($updt); // exit;
	  //prints($_POST); exit;

	  if(is_array($aAssocArr)) {
     for($ln=0;$ln<count($updt); $ln++) {
		if(in_array($updt[$ln]['iAsociationID'],$aAssocArr)) {
			$where = "";
		// echo $updt[$ln]['iAsociationID']; exit;
			$where = " AND iAsociationID='".$aAssocArr[$ln]."'";
			$orderby = 'iVerifiedID Desc';
			$vrfdata=$orgAssocVerifyObj->getDetails('*',$where,$orderby,'',' LIMIT 0,1 ');
			// prints($vrfdata); exit;
//		prints($updt); exit;
     if($updt[$ln]['eStatus'] == 'Delete') {
			$iAsociationID = $updt[$ln]['iAsociationID'];
          $where = " AND iAsociationID='".$iAsociationID."'";
          $res = $orgAssocObj->del($where);
          unset($data);
          $data['eStatus'] = 'Active';
          $data['iVerifiedSMID'] = $sess_id;
			 $data['eVerifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
			 $data['dVerifiedDate'] = date('Y-m-d H:i:s');
          $orgAssocVerifyObj->setAllVar($data);
          $where = "iAsociationID IN (".$iAsociationID.")";
          $res = $orgAssocVerifyObj->updateData($data, $where);
          if($res){$msg = "rds";}else{$msg = "rdserr";}
     } else if(($updt[$ln]['eStatus'] == 'Inactive' || $updt[$ln]['eStatus'] == 'Active') && $updt[$ln]['eNeedToVerify'] == 'Yes' && in_array($updt[$ln]['iAsociationID'],$aAssocArr)) {
			$where = "";
         unset($data);
         if($updt[$ln]['eStatus'] == 'Inactive')
				$data['eStatus'] = 'Inactive';
         else
				$data['eStatus'] = 'Active';
         $data['eNeedToVerify'] = 'No';
         $data['iVerifiedSMID'] = $sess_id;
			$data['eVerifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
			$data['dVerifiedDate'] = date('Y-m-d H:i:s');
			$iAsociationID = $updt[$ln]['iAsociationID'];
          $where = "iAsociationID='".$iAsociationID."'";
         // prints($data);print"<br>";//exit;
          $res = $orgAssocObj->updateData($data, $where);
          //print "<br>";
          $orgAssocVerifyObj->setAllVar($data);
          $where = "iAsociationID IN (".$iAsociationID.")";
          $res = $orgAssocVerifyObj->updateData($data, $where);
         // print "<br>";
//prints($data);
//exit;
          if($res){$msg = "rss";}else{$msg = "rsserr";}
     } else {
          if(in_array($updt[$ln]['iAsociationID'],$aAssocArr))
          {
          $dt['eStatus'] = 'Active';
          $dt['iVerifiedSMID'] = $sess_id;
			 $dt['eVerifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
			 $dt['dVerifiedDate'] = date('Y-m-d H:i:s');
          $orgAssocVerifyObj->setAllVar($dt);
           $dt['eNeedToVerify'] = 'No';

          $where= " iVerifiedID='".$updt[$ln]['iVerifiedID']."'";
			 //prints($where); //exit;
//			 $where = " vAssociationCode='$vAsocode'";
          $iVerifiedID=$orgAssocVerifyObj->updateData($dt,$where);
			 // echo $iVerifiedID; exit;
          if($iVerifiedID) {
					$iVerifiedID = $updt[$ln]['iVerifiedID'];
					$iAsociationID = $updt[$ln]['iAsociationID'];
               $where = " AND iVerifiedID='".$updt[$ln]['iVerifiedID']."'";
//					$where = " AND vAssociationCode='$vAsocode'";
               $updtdata=$orgAssocVerifyObj->getDetails('*',$where);
					//rints($updtdata); exit;
//					for($l=0; $l<count($updtdata);$l++) {
//						if($updtdata[$l]['eStatus'] != 'Active') {
						//	echo "hi"; exit;
						//unset($updtdata[$l]['iVerifiedID']);
						//unset($updtdata[$l]['iAsociationID']);
						//$where= " iAsociationID='".$updtdata[0]['iAsociationID']."'";
						//echo $where; exit;
						//prints($vdt); exit;
						$where= " iAsociationID='".$updtdata[0]['iAsociationID']."' ";
						unset($updtdata[0]['iVerifiedID']);
						unset($updtdata[0]['iAsociationID']);
						$vdt = $updtdata[0];
						//prints($where);
						// prints($vdt); exit;
						$res=$orgAssocObj->updateData($vdt,$where);
						// echo "<br/>".$where; exit;
						//echo $where; exit;
						 $udt['eVerifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
						 $udt['iVerifiedBy'] = $sess_id;
						 $udt['dVerifyDate'] = date('Y-m-d H:i:s');
						 $udt['vVerifyFromIP'] = $_SERVER['REMOTE_ADDR'];
                              // $udt['eNeedToVerify']='No';
						 $userActionObj->setAllVar($udt);
						 $where = " iItemID='".$iVerifiedID."' AND eSubject = 'Association'";
						 // echo $where; exit;
						 $res=$userActionObj->updateData($udt,$where);
						 $where = "";
						 unset($udt);
						 //unset($vdt);
						 //unset($dt);
//						}
//					}
               if($res){$msg = "rvs";}else{$msg = "rvserr";}
          }

          } else {
           //$where = "iAsociationID='".$updt[$ln]['iAsociationID']."'";
           //$orgAssocVerifyObj->updateData(array('eStatus'=>"Inactive"), $where);
           //$orgAssocObj->updateData(array('eStatus'=>"Inactive"), $where);
          }
			 $where = "";
     }
/*          $udt['eVerifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
          $udt['iVerifiedBy'] = $sess_id;
          $udt['dVerifyDate'] = date('Y-m-d H:i:s');
          $udt['vVerifyFromIP'] = $_SERVER['REMOTE_ADDR'];

          $userActionObj->setAllVar($udt);
          $where= " iItemID='".$vrfdata[0]['iVerifiedID']."' AND eSubject = 'Association'";
          $res=$userActionObj->updateData($udt,$where);
          unset($udt);
          unset($vdt);
          unset($dt);
*/
		$where = "";
		}
     }
	  }
/*     if($status == 'Delete')
     {
         // $whereDel = "vAssociationCode='".$vAsocode."'";
         // $orgAssocObj->del("AND ".$whereDel);
         // $orgAssocVerifyObj->updateData(array('eStatus'=>"Inactive"), $whereDel);
     }
*/
     //exit;
	  //exit;
}
else if($view == 'edit') {
include(SITE_CLASS_GEN."class.validation.php");
    $validation=new Validation();
    ### SERVER SIDE VALIDATION ####
    $RequiredFiledArr = array(
					'iBuyerOrganizationID' => $smarty->get_template_vars('MSG_SELECT_BUYER_ORGANIZATION'),
                'assocorgs' => $smarty->get_template_vars("LBL_SELECT_SELLER_ORG"),
                'suporgcode' => $smarty->get_template_vars("LBL_SELECT_SELLER_ORG"),
                'assocCode' => $smarty->get_template_vars("LBL_SELECT_SELLER_ORG"),
        );
	 /*
	  array(  'orgcode'   =>$smarty->get_template_vars('LBL_ENTER_COMP_REG_CODE_NAME'),
                'regno'     =>$smarty->get_template_vars('LBL_ENTER_COMP_REG_CODE_NAME'),
                'orgname'   =>$smarty->get_template_vars('LBL_ENTER_COMP_REG_CODE_NAME')),
	 */
	 $resArr = $validation->isEmpty(array('iBuyerOrganizationID' => $smarty->get_template_vars('MSG_SELECT_BUYER_ORGANIZATION')));
    $resArr1 = $validation->isEmptyMul($RequiredFiledArr);
   // prints($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']); exit;
   // prints($resArr1); exit;
	 if($resArr || $resArr1) {
             $Data['regno']=$_POST['regno'];
             $Data['orgcode']=$_POST['orgcode'];
             $Data['orgname']=$_POST['orgname'];
                 $_SESSION['Data']=$Data;
                 //prints($Data);exit;
           	 header("Location:".$_SERVER['HTTP_REFERER']."");
		 exit;
	 }
         //exit;
	 ### ENDS HERE ###

// prints($del); exit;
if(is_array($del)){
	$del_ary = $del[0];
	if(trim($del_ary) == '') {
		$del_ary = array();
	} else {
		$del_ary = @explode(',',$del_ary);
	}
} else {
	if(trim($del) == '') {
		$del_ary = array();
	} else {
		$del_ary = @explode(',',$del);
	}
}
if(!is_array($iSupplierAssocationID)) {
	$iSupplierAssocationID = array();
}
$dl_ary = array_diff($del_ary,$iSupplierAssocationID);
$del[0] = @implode(',',$dl_ary);
// prints($del); exit;
/*
prints($vSupplierCode);
prints($asoc_ary);
prints($assarr);
prints($asocd);
prints($iSupplierAssocationID); // exit;
*/
$asdt = $orgAssocObj->getDetails('iChangeNo'," AND vAssociationCode='$vAssociationCode' ",' iChangeNo DESC ','',' LIMIT 0,1');
// prints($asdt); exit;
if($asdt[0]['iChangeNo'] == '') {
	$asdt[0]['iChangeNo'] = 0;
}
$data['iChangeNo'] = ($asdt[0]['iChangeNo']+1);
     for($l=0;$l<count($iSupplierAssocationID);$l++)
     {
		// $asocd
         if($asocd[$iSupplierAssocationID[$l]]['vSupplierCode'] != $vSupplierCode[$l] && in_array($iSupplierAssocationID[$l],$asoc_ary)) { 	// $iSupplierAssocationID[$l] == $assarr[$l]['iAsociationID']

				/*pritns($del); exit;
				if(trim($del) == '') {
					$del_ary = array();
				} else {
					$del_ary = @explode(',',$del);
				}
				if(in_array($iSupplierAssocationID[$l],$del_ary)) {
					for($ln=0;$ln<count($del_ary);$ln++){
						if($del_ary[$ln] == $iSupplierAssocationID[$l]){
							unset($del_ary[$ln]);
						}
					}
				}
				$del = @implode(',',$del_ary);
				*/

				// if(count($emlar) > 0) {
               $adata['eStatus'] = 'Modified';
				/*} else {
					$adata = $data;
					$adata['eStatus'] = 'Active';
				}
            if($chkMulAdmin == '1'){
               $adata = $data;
               $adata['eStatus'] = 'Active';
            } else {
               $adata['eStatus'] = $adata['eStatus'];
            }*/
            //$adata['eNeedToVerify']=$data['eNeedToVerify']='Yes';
            $adata['iModifiedByID'] = $data['iModifiedByID'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
				$adata['eModifiedBy'] = $data['eModifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
				$adata['dModifiedDate'] = $data['dModifiedDate'] = date('Y-m-d H:i:s');
				$asdt = $orgAssocObj->getDetails('*'," AND vAssociationCode='$vAssociationCode'  AND iBuyerOrganizationID=$iBuyerOrganizationID AND iSupplierAssocationID=".$iSupplierAssocationID[$l]." ");
				// echo $iSupplierAssocationID[$l]."hi";
				// prints($asdt); // exit;
				if(count($asdt) > 0)
				{
					$orgAssocObj->setAllVar($adata);
					// $where = " iAsociationID = '".$assarr[$l]['iAsociationID']."'"; //
					$where = " iAsociationID = '".$asocd[$iSupplierAssocationID[$l]]['iAsociationID']."'";
					//prints($adata);exit;
					$ascid = $orgAssocObj->updateData($adata, $where);
					//print $ascid; exit;
					//exit;
					// $data['iAsociationID'] = $assarr[$l]['iAsociationID']; //
					$data['iAsociationID'] = $asocd[$iSupplierAssocationID[$l]]['iAsociationID'];
				} else {
					$data['iSupplierAssocationID'] = $iSupplierAssocationID[$l];
					$data['vSupplierCode'] = $vSupplierCode[$l];
					//$data['vAssociationCode'] = $vAssociationCode[$l];
					$data['vAssociationCode'] = $vAssociationCode;
					$data['dCreatedDate'] = date("Y-m-d H:i:s");
					//if(count($emlar) > 0)
						$data['eStatus'] = 'Need to Verify';
					/*else
						$data['eStatus'] = 'Active';
                    //$data['eNeedToVerify']='Yes';
               if($chkMulAdmin == '1'){
                  $data['eStatus'] = 'Active';
               }else{
                  $data['eStatus'] = $data['eStatus'];
               }*/
					// prints($data); exit;
					$orgAssocObj->setAllVar($data);
					$ascid = $orgAssocObj->insert();
					$data['iAsociationID'] = $ascid;
				}
               if($ascid)
               {
                  $data['iSupplierAssocationID'] = $iSupplierAssocationID[$l];
                  $data['vSupplierCode'] = $vSupplierCode[$l];
                  //$data['vAssociationCode'] = $vAssociationCode[$l];
						$data['vAssociationCode'] = $vAssociationCode;
                  $data['dCreatedDate'] = date("Y-m-d H:i:s");
						if(count($asdt) > 0) {
							$data['eStatus'] = 'Modified';
						} else {
							$data['eStatus'] = 'Need to Verify';
						}
						//if(count($emlar) > 0) {
						//	if(count($asdt) > 0) {
							// $data['eStatus'] = 'Modified';
						/*	} else {
								$data['eStatus'] = 'Need to Verify';
							}
						}
						else
							$data['eStatus'] = 'Active';*/
                  //prints($data);exit;
                    // $data['eNeedToVerify']='Yes';

                     /*if($chkMulAdmin == '1'){
                        $data['eStatus'] = 'Active';
                        $data['eNeedToVerify']='No';
                     }else{
                        $data['eStatus'] = $data['eStatus'];
                     }*/
							/*$asdt = $orgAssocObj->getDetails('iChangeNo'," AND vAssociationCode='$vAssociationCode' ",' iChangeNo DESC ','',' LIMIT 0,1');
							// prints($asdt); exit;
							if($asdt[0]['iChangeNo'] == '') {
								$asdt[0]['iChangeNo'] = 0;
							}
							$data['iChangeNo'] = ($asdt[0]['iChangeNo']+1);
							// prints($data['iChangeNoId']); exit;*/
                    $orgAssocVerifyObj->setAllVar($data);
                    $ascvrfyid = $orgAssocVerifyObj->insert();
                    unset ($data['eNeedToVerify']);
                    $msg = "rus";

//                    $where = 'AND iSMID != '.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'].' AND eStatus = "Active" AND eEmailNotification="Yes" ';
//                    $smdtls = $secManObj->getDetails('*',$where);
          // ---------------------
          // -----------
               } else { $msg = "ruserr"; }
          } else if (! in_array($iSupplierAssocationID[$l],$asoc_ary)) {
				//if(count($emlar) > 0) {
               $adata['eStatus'] = 'Modified';
				/*} else {
					$adata = $data;
					$adata['eStatus'] = 'Active';
				}
            if($chkMulAdmin == '1'){
               $adata = $data;
               $adata['eStatus'] = 'Active';
            }else{
               $adata['eStatus'] = $adata['eStatus'];
            }*/
            //$adata['eNeedToVerify']=$data['eNeedToVerify']='Yes';
            $adata['iModifiedByID'] = $data['iModifiedByID'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
				$adata['eModifiedBy'] = $data['eModifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
				$adata['dModifiedDate'] = $data['dModifiedDate'] = date('Y-m-d H:i:s');
				$asdt = $orgAssocObj->getDetails('*'," AND vAssociationCode='$vAssociationCode'  AND iBuyerOrganizationID=$iBuyerOrganizationID AND iSupplierAssocationID=".$iSupplierAssocationID[$l]." ");
				// echo $iSupplierAssocationID[$l]."hi";
				// prints($asdt); // exit;
				if(count($asdt) > 0)
				{
					$orgAssocObj->setAllVar($adata);
					// $where = " iAsociationID = '".$assarr[$l]['iAsociationID']."'";
					$where = " iAsociationID = '".$asocd[$iSupplierAssocationID[$l]]['iAsociationID']."'";
					//prints($adata);exit;
					$ascid = $orgAssocObj->updateData($adata, $where);
					//print $ascid; exit;
					//exit;
					// $data['iAsociationID'] = $assarr[$l]['iAsociationID'];
					$data['iAsociationID'] = $asocd[$iSupplierAssocationID[$l]]['iAsociationID'];
				} else {
					$data['iSupplierAssocationID'] = $iSupplierAssocationID[$l];
					$data['vSupplierCode'] = $vSupplierCode[$l];
					//$data['vAssociationCode'] = $vAssociationCode[$l];
					$data['vAssociationCode'] = $vAssociationCode;
					$data['dCreatedDate'] = date("Y-m-d H:i:s");
					//if(count($emlar) > 0)
						$data['eStatus'] = 'Need to Verify';
					/*else
						$data['eStatus'] = 'Active';
                    //$data['eNeedToVerify']='Yes';
               if($chkMulAdmin == '1'){
                  $data['eStatus'] = 'Active';
               }else{
                  $data['eStatus'] = $data['eStatus'];
               }*/
					// prints($data); exit;
					$orgAssocObj->setAllVar($data);
					$ascid = $orgAssocObj->insert();
					$data['iAsociationID'] = $ascid;
				}
               if($ascid)
               {
                  $data['iSupplierAssocationID'] = $iSupplierAssocationID[$l];
                  $data['vSupplierCode'] = $vSupplierCode[$l];
                  //$data['vAssociationCode'] = $vAssociationCode[$l];
						$data['vAssociationCode'] = $vAssociationCode;
                  $data['dCreatedDate'] = date("Y-m-d H:i:s");
						if(count($asdt) > 0) {
							$data['eStatus'] = 'Modified';
						} else {
							$data['eStatus'] = 'Need to Verify';
						}
						/*if(count($emlar) > 0) {
							if(count($asdt) > 0) {
								$data['eStatus'] = 'Modified';
							} else {
								$data['eStatus'] = 'Need to Verify';
							}
						}
						else
							$data['eStatus'] = 'Active';
                  //prints($data);exit;
                    $data['eNeedToVerify']='Yes';

                     if($chkMulAdmin == '1'){
                        $data['eStatus'] = 'Active';
                        $data['eNeedToVerify']='No';
                     }else{
                        $data['eStatus'] = $data['eStatus'];
                     }*/
							/*$asdt = $orgAssocObj->getDetails('iChangeNo'," AND vAssociationCode='$vAssociationCode' ",' iChangeNo DESC ','',' LIMIT 0,1');
							// prints($asdt); exit;
							if($asdt[0]['iChangeNo'] == '') {
								$asdt[0]['iChangeNo'] = 0;
							}
							$data['iChangeNo'] = ($asdt[0]['iChangeNo']+1);*/
                    $orgAssocVerifyObj->setAllVar($data);
                    $ascvrfyid = $orgAssocVerifyObj->insert();
                    unset ($data['eNeedToVerify']);
                    $msg = "rus";

//                    $where = 'AND iSMID != '.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'].' AND eStatus = "Active" AND eEmailNotification="Yes" ';
//                    $smdtls = $secManObj->getDetails('*',$where);
          // ---------------------
          // -----------
               } else { $msg = "ruserr"; }
			 }
     }

	  if(count($smdtls) > 0) {
			  $where = 'AND vType="Association Updated" AND eSection = "Member"' ;
			  $db_email = $emailObj->getDetails('*',$where);
			  $link = SITE_URL_DUM."associationview/".$iAsociationID;
			  $body = Array("#ORGNAME#","#ACODE#","#LINK#","#MODIFIED_BY#");
			  $post = Array($vBuyerName,$data['vAssociationCode'],$link,$sess_user_name."($sess_usertype_short)");

			  $rplarr = Array("Hello #SMNAME#,","background-color: rgb(239, 239, 239);","Regards,","#MAIL_FOOTER#","#SITE_URL#");
			  $tbody_en = str_replace($rplarr," ",$db_email[0]['tBody_en']);
			  $emailContent_en = trim(str_replace($body,$post, $tbody_en));
			  $tbody_fr = str_replace($rplarr," ",$db_email[0]['tBody_fr']);
			  $emailContent_fr = trim(str_replace($body,$post, $tbody_fr));
			  // prints($emailContent);exit;

			  $Data['iItemID']=$ascvrfyid;
			  $Data['iOrganizationID']=$iBuyerOrganizationID;
			  $Data['eSubject']='Association';
			  $Data['eType']='Modified';
			  $Data['vMailSubject_en'] = $db_email[0]['vSub_en'];
			  $Data['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
			  $Data['tMailContent_en'] = $emailContent_en;
			  $Data['tMailContent_fr'] = $emailContent_fr;
			  $Data['iCreatedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
			  $Data['eCreatedType'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
			  $Data['dActionDate']=date("Y-m-d H:i:s");
			  $userActionObj->setAllVar($Data);
			  $userActionObj->insert();

			  for($i=0;$i<count($smdtls);$i++)
			  {
					  $smname = $smdtls[$i]['vFirstName'].' '.$smdtls[$i]['vLastName'];
					  $email = $smdtls[$i]['vEmail'];
					  $body_arr = Array("#SMNAME#","#ORGNAME#","#ACODE#","#LINK#","#MODIFIED_BY#","#MAIL_FOOTER#","#SITE_URL#");
					  $post_arr = Array($smname,$vBuyerName,$data['vAssociationCode'],$link,$sess_user_name."($sess_usertype_short)",$MAIL_FOOTER,SITE_URL_DUM);
					  $sendMail->Send("Association Updated","Member",$email,$body_arr,$post_arr);
			  }
		}
     //if($msg == 'rus')
     //{
         // $where = " vAssociationCode = '".$vAssociationCode."' and iBuyerOrganizationID != '".$iBuyerOrganizationID."'";
        //  $orgAssocObj->updateData(array('eStatus'=>'Inactive'), $where);

         // $orgAssocVerifyObj->updateData(array('eStatus'=>'Inactive'), $where);

     //}
} else {
    include(SITE_CLASS_GEN."class.validation.php");
    $validation=new Validation();
    ### SERVER SIDE VALIDATION ####

    $RequiredFiledArr = array(
				'iBuyerOrganizationID' => $smarty->get_template_vars('MSG_SELECT_BUYER_ORGANIZATION'),
				'assocorgs' => $smarty->get_template_vars("LBL_SELECT_SELLER_ORG"),
				'suporgcode' => $smarty->get_template_vars("LBL_SELECT_SELLER_ORG"),
				'assocCode' => $smarty->get_template_vars("LBL_SELECT_SELLER_ORG"),
        );
	 /*
	  array(  'orgcode'   =>$smarty->get_template_vars('LBL_ENTER_COMP_REG_CODE_NAME'),
                'regno'     =>$smarty->get_template_vars('LBL_ENTER_COMP_REG_CODE_NAME'),
                'orgname'   =>$smarty->get_template_vars('LBL_ENTER_COMP_REG_CODE_NAME')),
	 */
	 // $resArr = $validation->isEmpty($RequiredFiledArr);
    $resArr = $validation->isEmpty(array('iBuyerOrganizationID' => $smarty->get_template_vars('MSG_SELECT_BUYER_ORGANIZATION')));
    $resArr1 = $validation->isEmptyMul($RequiredFiledArr);
    if($resArr || $resArr1) {
       $Data['regno']=$_POST['regno'];
       $Data['orgcode']=$_POST['orgcode'];
       $Data['orgname']=$_POST['orgname'];
       $_SESSION['Data']=$Data;
     	 header("Location:".$_SERVER['HTTP_REFERER']."");
		 exit;
	 }
    // exit;
	 ### ENDS HERE ###

	// $vAssociationCode = $generalobj->UniqueID("AS",PRJ_DB_PREFIX."_organization_association","vAssociationCode",$charlimit="10");
	$vAssociationCode = $orgAssocObj->getUniqueCode('A');
	// echo $vAssociationCode; exit;
	$data['vAssociationCode'] = $vAssociationCode;
	$data['iChangeNo'] = 0;
	$data['eStatus'] = 'Need to Verify';
	//prints($data); exit;
    $dup =0;
     for($l=0;$l<count($iSupplierAssocationID);$l++)
     {
            $boid = $data['iBuyerOrganizationID'];
            $ascode = $vSupplierCode[$l];
            if(trim($ascode)!='' && $boid>0) {
               $sql = "select * from ".PRJ_DB_PREFIX."_organization_association where vSupplierCode='$ascode' AND iBuyerOrganizationID='$boid' ";
               $dtl = $dbobj->MySqlSelect($sql);
               if(is_array($dtl) && count($dtl)>0) {
                      $dup++;
               }else{
                  $data['iSupplierAssocationID'] = $iSupplierAssocationID[$l];
                  $data['vSupplierCode'] = $vSupplierCode[$l];
                  // $data['vAssociationCode'] = $vAssociationCode[$l];
                  $data['dCreatedDate'] = date("Y-m-d H:i:s");
                  $orgAssocObj->setAllVar($data);
                  $ascid = $orgAssocObj->insert();
                  if($ascid){
                       $data['iAsociationID'] = $ascid;
                       $orgAssocVerifyObj->setAllVar($data);
                       $ascvrfyid = $orgAssocVerifyObj->insert();
                       $msg = "ras";

                        //$where = 'AND iSMID != '.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'].' AND eStatus = "Active" AND eEmailNotification="Yes" ';
                        //$smdtls = $secManObj->getDetails('*',$where);
                 }else{
                    $msg = "raserr";
                 }
               }
            }
          if($dup > 0){
            //$msg = "rasdup-".$dup."";
          }
     }

      // ---------------------
          if(count($smdtls) > 0)
          {
               $where = 'AND vType="New Association Created" AND eSection = "Member"' ;
               $db_email = $emailObj->getDetails('*',$where);
					$link = SITE_URL_DUM."associationview/".$ascid;
               $body = Array("#ORGNAME#","#ACODE#","#LINK#","#ADDED_BY#");
               $post = Array($vBuyerName,$data['vAssociationCode'],$link,$SITE_NAME);

               $rplarr = Array("Hello #SMNAME#,","background-color: rgb(239, 239, 239);","Regards,","#MAIL_FOOTER#","#SITE_URL#");
               $tbody_en = str_replace($rplarr," ",$db_email[0]['tBody_en']);
               $emailContent_en = trim(str_replace($body,$post, $tbody_en));
               $tbody_fr = str_replace($rplarr," ",$db_email[0]['tBody_fr']);
               $emailContent_fr = trim(str_replace($body,$post, $tbody_fr));
               // prints($emailContent);exit;

               $Data['iItemID']=$ascvrfyid;
					$Data['iOrganizationID']=$iBuyerOrganizationID;
               $Data['eSubject']='Association';
               $Data['eType']='Create';
               $Data['vMailSubject_en'] = $db_email[0]['vSub_en'];
               $Data['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
               $Data['tMailContent_en'] = $emailContent_en;
               $Data['tMailContent_fr'] = $emailContent_fr;
               $Data['iCreatedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
               $Data['eCreatedType'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
               $Data['dActionDate']=date("Y-m-d H:i:s");
               $userActionObj->setAllVar($Data);
               $userActionObj->insert();

               for($i=0;$i<count($smdtls);$i++)
               {
                     $smname = $smdtls[$i]['vFirstName'].' '.$smdtls[$i]['vLastName'];
                     $email = $smdtls[$i]['vEmail'];
                     $body_arr = Array("#SMNAME#","#ORGNAME#","#ACODE#","#LINK#","#ADDED_BY#","#MAIL_FOOTER#","#SITE_URL#");
                     $post_arr = Array($smname,$vBuyerName,$data['vAssociationCode'],$link,$sess_user_name."($sess_usertype_short)",$MAIL_FOOTER,SITE_URL_DUM);
                     $sendMail->Send("New Association Created","Member",$email,$body_arr,$post_arr);
               }
		}
     // -----------
}

if(trim($view)!='add' && trim($view)!='') {
	$delasso = array();
	$asocid = array();
	$iassocids = 0;
	if(trim($del[0]) != '') {
	$delasso = @explode(',',$del[0]);
	$delasso = array_unique($delasso);
		for($l=0;$l<count($delasso);$l++) {
			$iassocs = $orgAssocObj->getDetails('iAsociationID'," AND iBuyerOrganizationID=$iBuyerOrganizationID AND iSupplierAssocationID=$delasso[$l] AND vAssociationCode='$vAssociationCode'");
			$asocid[] = $iassocs[0]['iAsociationID'];
		}
	}
	//exit;
	if(count($asocid)>0) {
	$str = @implode(',',$asocid);
	// echo $str; exit;
	include_once('delasso.php');
	//   $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']=$msg;
	//	header("Location:".SITE_URL_DUM."associationlist/".$msg);
	//	exit;
	}
}
$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']=$msg;
header("Location:".SITE_URL_DUM."associationlist/".$msg);
exit;
?>