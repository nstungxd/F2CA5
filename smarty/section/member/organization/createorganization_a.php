<?php
set_time_limit(0);
include(S_SECTIONS."/member/memberaccess.php");

//sendmail class incude
include(SITE_CLASS_GEN."class.sendmail.php");
//initialization of senmail class object
$sendMail = new SendPHPMail();

if(!isset($orgObj)) {
    include_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
    $orgObj = new Organization();
}
if(!isset($orgvrfObj)) {
    include_once(SITE_CLASS_APPLICATION."organization/class.Organization_Toverify.php");
    $orgvrfObj = new Organization_Toverify();
}
if(!isset($userActionObj)) {
     include_once(SITE_CLASS_APPLICATION.'user/class.UserActionVerification.php');
     $userActionObj = new UserActionVerification();
}
if(!isset($emailObj)) {
	include_once(SITE_CLASS_APPLICATION.'class.EmailTemplate.php');
	$emailObj = new EmailTemplate();
}
if(!isset($orgprefObj)) {
    include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationPreference.php");
    $orgprefObj =	new OrganizationPreference();
}
if(!isset($orgPrefVrfObj)) {
    include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationPreferenceToverify.php");
    $orgPrefVrfObj =	new OrganizationPreferenceToverify();
}
if(!isset($orgUserObj)) {
   include_once(SITE_CLASS_APPLICATION.'user/class.OrganizationUser.php');
   $orgUserObj = new OrganizationUser();
}
if(!isset($orgUserPermObj)) {
   include_once(SITE_CLASS_APPLICATION."user/class.OrganizationUserPermission.php");
	$orgUserPermObj =	new OrganizationUserPermission();
}
if(!isset($orgStaObj)) {
	require_once(SITE_CLASS_APPLICATION."class.StatusMaster.php");
	$orgStaObj = new StatusMaster;
	//$sess_id
}
if(!isset($statusmasterObj)) {
	include_once(SITE_CLASS_APPLICATION."class.StatusMaster.php");
	$statusmasterObj = new StatusMaster();
}
if(!isset($bnkObj)) {
   include_once(SITE_CLASS_APPLICATION."class.BankMaster.php");
   $bnkObj = new BankMaster();
}

//prints($_POST);exit;
function phoneCode($field){
     global $Data;
     if($Data[$field]!='' && $_POST[$field.'Code']!='' ){
       $Data[$field]=$_POST[$field.'Code']."-".$Data[$field];
     }
}

$Data = PostVar("Data");
$view = PostVar("view");
$dupl = $_POST['dpr'];

phoneCode('vPhone');
phoneCode('vPrimaryContactNo');
phoneCode('vPrimaryContactTelephone');
phoneCode('vPrimaryContactMobile');

$eOrganizationType=$Data['eOrganizationType'];
$iOrganizationID = PostVar("iOrganizationID");
$iOrgId = (isset($_POST['iOrgId']))? $_POST['iOrgId'] : '';
if($iOrganizationID<1 && $iOrgId>0) {
	 $iOrganizationID = $iOrgId;
}
$opf = $orgprefObj->getDetails('*'," AND iOrganizationID=$iOrganizationID ");

if($sess_usertype_short == 'SM') {
	 $wh = " AND iSMID!=$sess_id ";
}
$where = $wh.' AND eStatus = "Active" AND eEmailNotification="Yes" ';
$arr = $secManObj->getDetails('*',$where);
$whu = '';
if($sess_usertype_short == 'OA') {
   $whu = " AND iUserID!=$sess_id ";
}
$where = $whu.' AND eStatus="Active" AND eUserType="Admin" AND iOrganizationID='.$iOrganizationID.' AND eEmailNotification="Yes" ';
$uarr = $orgUserObj->getDetails('*',$where);
// prints($uarr); exit;
if(is_array($arr) && is_array($uarr)) {
	$emailArr = array_merge($arr,$uarr);
} else if(is_array($arr)) {
	$emailArr = $arr;
} else if(is_array($uarr)) {
	$emailArr = $uarr;
}
// prints($emailArr); exit;
if($sess_usertype_short == 'SM') {
	 $wh = " AND iSMID!=$sess_id ";
}
$where = $wh.' AND eStatus = "Active" ';
$sar = $secManObj->getDetails('*',$where);

if($sess_usertype_short == 'OA') {
   $whu = " AND iUserID!=$sess_id ";
}
$where = $whu.' AND eStatus="Active" AND eUserType="Admin" AND iOrganizationID='.$iOrganizationID.' ';
$uar = $orgUserObj->getDetails('*',$where);
// prints($uarr); exit;
if(is_array($sar) && is_array($uar)) {
	$emlar = array_merge($sar,$uar);
} else if(is_array($sar)) {
	$emlar = $sar;
} else if(is_array($uar)) {
	$emlar = $uar;
}

$sname = $arr[0]['vFirstName'].' '.$arr[0]['vLastName'];
$cname = $Data['vCompanyName'];
$regno = $Data['vCompanyRegNo'];
$code =  (isset($Data['vOrganizationCode']))? $Data['vOrganizationCode'] : '';

// echo $view; exit;
if($view == 'reject')
{
	//echo $view; exit;
	$iOrganizationID = $_POST['iOrgId'];
	$dt['eNeedToVerify'] = $data['eNeedToVerify'] = 'No';
	$dt['tReasonToReject'] = $_POST['tReasonToReject'];
	$dt['iRejectedById'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
	$dt['eRejectedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
	$dt['dRejectedDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
	$dt['eStatus'] = $data['eStatus'] = "Active";
	$orgdtls = $orgObj->getDetails('*'," AND iOrganizationID=$iOrganizationID ");
	$orgvrfdt = $orgvrfObj->getDetails('*'," AND iOrganizationID=$iOrganizationID ",' iVerifiedID DESC ','',' LIMIT 0,1 ');
   if($orgdtls[0]['eStatus']=='Need to Verify') {
		 $dt['eStatus'] = $data['eStatus'] = "Inactive";
	}
	else if($orgvrfdt[0]['eStatus']=='Inactive' && $orgvrfdt[0]['eNeedToVerify']=='Yes') {
		$dt['eNeedToVerify'] = $data['eNeedToVerify'] = "No";
		$dt['eStatus'] = $data['eStatus'] = "Active";
	} else if($orgvrfdt[0]['eStatus']=='Active' && $orgvrfdt[0]['eNeedToVerify']=='Yes') {
		$dt['eNeedToVerify'] = $data['eNeedToVerify'] = "No";
		$dt['eStatus'] = $data['eStatus'] = "Inactive";
	}
	else if($orgdtls[0]['eStatus']=='Modified') {
		 $dt['eStatus'] = $data['eStatus'] = "Active";
		 $data['iModifiedByID'] = "";
		 $data['eModifiedBy'] = "";
	} else if($orgdtls[0]['eStatus']=='Delete') {
	    $dt['eStatus'] = $data['eStatus'] = "Active";
		 $data['iModifiedByID'] = "";
		 $data['eModifiedBy'] = "";
	}
	$res = $orgObj->updateData($data," iOrganizationID=$iOrganizationID ");
	$vrfydtls = $orgvrfObj->getDetails('*'," AND iOrganizationID=$iOrganizationID "," iVerifiedID DESC",''," LIMIT 0,1");
	if(is_array($vrfydtls) && count($vrfydtls)>0) {
	 $ivrfId = $vrfydtls[0]['iVerifiedID'];
	 $rs = $orgvrfObj->updateData($dt," iVerifiedID=$ivrfId ");
	}
	if($res) {
	 if(is_array($opf) && count($opf) >0) {
		  $rs = $orgprefObj->updateData($data,"iOrganizationID=$iOrganizationID");
		  $iVerifiedID = $orgPrefVrfObj->getDetails('iVerifiedID'," AND iOrganizationID=$iOrganizationID ",' iVerifiedID DESC ','',' LIMIT 0,1 ');
		  if(is_array($iVerifiedID) && count($iVerifiedID)>0) {
				$iVerifiedID = $iVerifiedID[0]['iVerifiedID'];
				$rs = $orgPrefVrfObj->updateData($dt,"iVerifiedID=$iVerifiedID"); 	// $iVerifiedID
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
	 if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'] == 'OA') {
		  header("Location:".SITE_URL_DUM."createorganization/".$iOrganizationID."/".$msg);
		  exit;
	 } else {
		  header("Location:".SITE_URL_DUM."organizationlist/".$msg);
		  exit;
	 }
}
if($view == 'verify')
{
	     if(strpos($_SERVER['HTTP_REFERER'],'organizationprefview') !== 'false') {
		  $dt['eStatus'] = $Data['eStatus'] = "Active";
		  $dt['iVerifiedByID'] = $Data['iVerifiedByID'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
		  $dt['eVerifiedBy'] = $Data['eVerifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
		  $dt['dVerifiedDate'] = $Data['dVerifiedDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
		  //$Data['iOrganizationID'] = $iOrganizationID;
		  $where = " AND iOrganizationID=$iOrganizationID";
			$vrfydtls = $orgPrefVrfObj->getDetails('*',$where," iVerifiedID DESC ",''," LIMIT 0,1");
			if(is_array($vrfydtls) && count($vrfydtls)>0) {
			$res =$orgPrefVrfObj->updateData($dt," iVerifiedID=".$vrfydtls[0]['iVerifiedID']);
			//prints($res);exit;
		  $dt = $orgPrefVrfObj->getDetails('*'," AND iVerifiedID=".$vrfydtls[0]['iVerifiedID']);
		  $iVerifiedID = $dt[0]['iVerifiedID'];
		  unset($dt[0]['iVerifiedID']);
		  if(count($dt) == 0) {
			  $dt['eStatus'] = "Active";
		  }
		  // prints($dt); exit;
		  $res = $orgprefObj->updateData($dt[0],"iOrganizationID=$iOrganizationID");
		  }
		  unset($dt); unset($Data);
		  /*$rs = $orgObj->updateData($dt," iOrganizationID=$iOrganizationID ");
		  $verified = $orgvrfObj->getDetails('iVerifiedID'," AND iOrganizationID=$iOrganizationID ",' iVerifiedID DESC ','',' LIMIT 0,1 ');
		  $ivid = $verified[0]['iVerifiedID'];
		  $rs = $orgvrfObj->updateData($dt," iVerifiedID=$ivid ");

		  $where = " iVerifiedID=$iVerifiedID ";
		  $dtls['eVerifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
		  $dtls['iVerifiedBy']	= $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
		  $dtls['dVerifyDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
		  $dtls['vVerifyFromIP'] = $_SERVER['REMOTE_ADDR'];
		  $rs = $userActionObj->updateData($dtls,$where);*/

//		  if($res) {
//				 $orgdtls = $orgObj->select($iOrganizationID);
				 /*if($orgdtls[0]['eOrganizationType'] == 'Supplier'){
					  $opdt['vOrderStatusLevel'] = '';
					  $rs = $orgprefObj->updateData($opdt,"iOrganizationID=$iOrganizationID");
				 } else if($orgdtls[0]['eOrganizationType'] == 'Buyer'){
					  $opdt['vInvoiceStatusLevel'] = '';
					  $rs = $orgprefObj->updateData($opdt,"iOrganizationID=$iOrganizationID");
				 }*/
//				 $rs = $orgUserPermObj->clearExtraPermits($iOrganizationID,$orgdtls[0]['eOrganizationType']);
//		  }

	 //   $orgObj->setAllVar($Data);
	 //	$res = $orgvrfObj->insert();
		 // CHANGE STATUS IN ORGANIZATION MASTER
	 //	$rs = $orgObj->updateData($dt,$where);
/*		 if($res) {
			 $msg = "orgvrfy";
		 }
		 else {
			 $msg = "orgvrfyer";
		 }*/
	 }

	 //prints($_POST); exit;
	 $iOrganizationID = $_POST['iOrgId'];
    $where = " AND iOrganizationID='".$iOrganizationID."'";
    $orderby = ' iVerifiedID Desc ';
    $vrfdata=$orgvrfObj->getDetails('*',$where,$orderby,'',' LIMIT 0,1 ');
	 $orgdtls = $orgObj->select($iOrganizationID);
    $eOrganizationType=$orgdtls[0]['eOrganizationType'];

    if($vrfdata[0]['eStatus'] == 'Delete') {
        $where = " AND iOrganizationID=$iOrganizationID ";
        //$res = $orgObj->del($where);
        unset($data);
        $data['eStatus'] = 'Active';
		  //$data['eStatus'] = 'Delete';
		  //$data['eNeedToVerify'] = 'No';
		  $data['iVerifiedSMID'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
		  $data['dVerifiedDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
        $data['dVerifiedFromIP'] = $_SERVER['REMOTE_ADDR'];
        $where = " iOrganizationID IN (".$iOrganizationID.") ";
        $res = $orgvrfObj->updateData($data, $where);
		  if($res) {
            $orgdtls = (isset($orgdtls) && is_array($orgdtls))? $orgdtls : array();
				$rs = $orgObj->delOrgRelRec($iOrganizationID, $orgdtls);
		  }
        if($res){$msg = "rds";}else{$msg = "rdserr";}
     } else if($vrfdata[0]['eStatus'] == 'Inactive' || $vrfdata[0]['eStatus'] == 'Active') {
          unset($data);
          if($vrfdata[0]['eStatus'] == 'Inactive')
               $data['eStatus'] = 'Inactive';
          else
               $data['eStatus'] = 'Active';
          $rdt['eNeedToVerify'] = $data['eNeedToVerify'] = 'No';
          $data['dVerifiedFromIP'] = $_SERVER['REMOTE_ADDR'];
          $rdt['iVerifiedByID'] = $dt['iVerifiedSMID'] = $data['iVerifiedSMID'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
			 $rdt['dVerifiedDate'] = $dt['dVerifiedDate'] = $data['dVerifiedDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
          $where = "iOrganizationID='".$iOrganizationID."'";
          $res = $orgObj->updateData($data, $where);
          $orgvrfObj->setAllVar($data);
          $where = "iOrganizationID IN (".$iOrganizationID.")";
          $res = $orgvrfObj->updateData($data, $where);
			 if($res) {
				$rdt['eStatus'] = $dts['eStatus'] = $data['eStatus'];
				if(is_array($opf) && count($opf) >0) {
					 $rs = $orgprefObj->updateData($rdt,"iOrganizationID=$iOrganizationID");
					 $iVerifiedID = $orgPrefVrfObj->getDetails('iVerifiedID'," AND iOrganizationID=$iOrganizationID ",' iVerifiedID DESC ','',' LIMIT 0,1 ');
					 if(is_array($iVerifiedID) && count($iVerifiedID)>0) {
						  $iVerifiedID = $iVerifiedID[0]['iVerifiedID'];
						  $rs = $orgPrefVrfObj->updateData($rdt,"iVerifiedID=$iVerifiedID"); 	// $iVerifiedID
					 }
				}
			 }
          if($res){$msg = "rss";}else{$msg = "rsserr";}
     } else {
          $rdt['eStatus'] = $dt['eStatus'] = $Data['eStatus'] = "Active";
          $rdt['iVerifiedByID'] = $dt['iVerifiedSMID'] = $Data['iVerifiedSMID'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
			 $rdt['eVerifiedBy'] = $dt['eVerifiedBy'] = $Data['eVerifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
			 $rdt['dVerifiedDate'] = $dt['dVerifiedDate'] = $Data['dVerifiedDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
          //$Data['iOrganizationID'] = $iOrganizationID;
          $where = " AND iOrganizationID=$iOrganizationID";
          $vrfydtls = $orgvrfObj->getDetails('*',$where," iVerifiedID DESC ",''," LIMIT 0,1 ");
          if(is_array($vrfydtls) && count($vrfydtls)>0) {
          $ures = $orgvrfObj->updateData($dt," iVerifiedID=".$vrfydtls[0]['iVerifiedID']);
          $dt = $orgvrfObj->getDetails('*'," AND iVerifiedID=".$vrfydtls[0]['iVerifiedID']);
			 $dt = $dt[0];
          $iVerifiedID = $dt['iVerifiedID'];
          unset($dt['iVerifiedID']);
          }
			 // prints($dt); exit;
          if(count($dt) == 0) {
				$dtl['eStatus'] = "Active";
				$dtl['iVerifiedSMID'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
				$res = $orgObj->updateData($dtl,"iOrganizationID=$iOrganizationID");
          } else {
				$dt['eStatus'] = 'Active';
				$dt['eNeedToVerify'] = 'No';
				$dt['iVerifiedSMID'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
				$dt['eVerifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
				$dt['dVerifiedDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
				$res = $orgObj->updateData($dt,"iOrganizationID=$iOrganizationID");
			 }

			 if($res)
			 {
				if(is_array($opf) && count($opf) >0) {
					 $iVerifiedID = $orgPrefVrfObj->getDetails('iVerifiedID'," AND iOrganizationID=$iOrganizationID ",' iVerifiedID DESC ','',' LIMIT 0,1 ');
					 if(is_array($iVerifiedID) && count($iVerifiedID)>0) {
						 $iVerifiedID = $iVerifiedID[0]['iVerifiedID'];
						 $rs = $orgPrefVrfObj->updateData($rdt,"iVerifiedID=$iVerifiedID"); 	// $iVerifiedID
						 $nwdtls = $orgPrefVrfObj->getDetails('*'," AND iOrganizationID=$iOrganizationID ",' iVerifiedID DESC ','',' LIMIT 0,1 ');
	 					 unset($nwdtls[0]['iVerifiedID']);
						 $rs = $orgprefObj->updateData($nwdtls[0],"iOrganizationID=$iOrganizationID");
					 }
				}
				$orgdtls = $orgObj->select($iOrganizationID);
				if($orgdtls[0]['eOrganizationType'] == 'Supplier') {
					 $opdt['vOrderStatusLevel'] = '';
					 $opdt['vInvoiceAcceptanceLevel'] ='';
                /*          $orgStatus=$orgStaObj->getDetails('group_concat(iStatusID) as defaultStatus'," AND efor='invoice' and eType='default' and eStatus='active'");
                          $opdt['vInvoiceStatusLevel'] = $orgStatus[0]['defaultStatus'];
					 $poisu = $statusmasterObj->getDetails('*'," AND eFor='PO' AND vStatus_en='Issued' ");
					 $poapt = $statusmasterObj->getDetails('*'," AND eFor='PO' AND vStatus_en='Issued' ");
					 $opdt['vOrderAcceptanceLevel'] = "$poisu,$poapt"; //*/


					 if($vrfdata[0]['eStatus'] == 'Need to Verify') {
						  $opdt['eStatus'] = 'Active';
					 }
					 if(is_array($opf) && count($opf) >0) {
						  $rs = $orgprefObj->updateData($opdt,"iOrganizationID=$iOrganizationID");
						  $rs = $orgPrefVrfObj->updateData($opdt,"iVerifiedID=$iVerifiedID"); // $iVerifiedID 	// $rs
					 }
				} else if($orgdtls[0]['eOrganizationType'] == 'Buyer') {
					 $opdt['vInvoiceStatusLevel'] = '';
                          $opdt['vOrderAcceptanceLevel'] ='';
					 /*$orgStatus=$orgStaObj->getDetails('group_concat(iStatusID) as defaultStatus'," AND efor='po' and eType='default' and eStatus='active'");
					 $opdt['vOrderStatusLevel'] = $orgStatus[0]['defaultStatus'];
					 $invisu = $statusmasterObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Issued' ");
					 $invapt = $statusmasterObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Issued' ");
					 $opdt['vInvoiceAcceptanceLevel'] = "$invisu,$invapt";

                          //$opdt['vInvoiceAcceptanceLevel'] = $orgStatus[0]['defaultStatus'];*/

                          if($vrfdata[0]['eStatus'] == 'Need to Verify') {
						  $opdt['eStatus'] = 'Active';
					 }
					 if(is_array($opf) && count($opf) >0) {
						  $rs = $orgprefObj->updateData($opdt,"iOrganizationID=$iOrganizationID");
						  $rs = $orgPrefVrfObj->updateData($opdt,"iVerifiedID=$iVerifiedID");
					 }
				}
                if($vrfdata[0]['eStatus'] == 'Need to Verify') {
						  $opupdt['eStatus'] = 'Active';
						  $opupdt['iVerifiedByID'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
						  $opupdt['eVerifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
						  $opupdt['dVerifiedDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
						  if(is_array($opf) && count($opf) >0) {
								$rs = $orgprefObj->updateData($opupdt,"iOrganizationID=$iOrganizationID");
								$rs = $orgPrefVrfObj->updateData($opupdt,"iOrganizationID=$iOrganizationID"); 	// $iVerifiedID iAdditionalInfoID=$rs
						  }
				}
				$rs = $orgUserPermObj->clearExtraPermits($iOrganizationID,$orgdtls[0]['eOrganizationType']);
			 }
     //   $orgObj->setAllVar($Data);
     //	$res = $orgvrfObj->insert();
          // CHANGE STATUS IN ORGANIZATION MASTER
     //	$rs = $orgObj->updateData($dt,$where);
          if($res) {
               $msg = "orgvrfy";
          }
          else {
               $msg = "orgvrfyer";
          }
     }

    // exit;
    // $eOrganizationType = "Buyer";
  //   print $vrfdata[0]['eOrganizationType'].",$eOrganizationType";
    // exit;
     if(count($vrfdata)>0 && isset($vrfdata[0]['eOrganizationType']) && $vrfdata[0]['eOrganizationType'] != $eOrganizationType)
     {
		  //$usql = "Select * from ".PRJ_DB_PREFIX."_organization_user_permission where iUserID IN (Select iUserID from ".PRJ_DB_PREFIX."_organization_user where iOrganizationID=$iOrgId)";
		  $usr = $orgUserPermObj->getDetails('*'," AND iUserID IN (Select iUserID from ".PRJ_DB_PREFIX."_organization_user where iOrganizationID=$iOrganizationID)");
		  //prints($usr);exit;
          if($eOrganizationType == "Both")
          {

          }
          else if($eOrganizationType == "Buyer")
          {
            for($l=0;$l<count($usr);$l++) {
					 if(trim($usr[$l]['tPermission']) != '') {
					//$usr[$l]['tPermission'] = preg_replace('/inv:(.*);/','inv:5,6;',$usr[$l]['tPermission']);
                         $tempPermission=@explode(";",$usr[$l]['tPermission']);
//prints($tempPermission);
                         $usr[$l]['tPermission']="inv:5,6;".$tempPermission[1];
					//$sql = "Update ".PRJ_DB_PREFIX."_organization_user_permission set tPermission='".$usr[$l]['tPermission']."' where iUserID=".$usr[$l]['iUserID'];
                         $pData['tPermission']=$usr[$l]['tPermission'];
                         $pWhere=" iUserID='".$usr[$l]['iUserID']."'";
                         //prints($pData);
						  $row =  $orgUserPermObj->updateData($pData,$pWhere);
					 }
				}
		     //$orgUserPermObj->updateData($pData,$pWhere);
          }
          else if($eOrganizationType == "Supplier")
          {
				for($l=0;$l<count($usr);$l++) {
					 if(trim($usr[$l]['tPermission']) != '') {
						 //$usr[$l]['tPermission'] = preg_replace('/po:(.*)/','po:5,6;',$usr[$l]['tPermission']);

									  $pWhere="  iUserID='".$usr[$l]['iUserID']."'";
									  $tempPermission=@explode(";",$usr[$l]['tPermission']);

									  $usr[$l]['tPermission']=$tempPermission[0].";po:15,16";
									  $pData['tPermission']=$usr[$l]['tPermission'];
									//  prints($pData);
									  //print $where;
						 $row =  $orgUserPermObj->updateData($pData,$pWhere);
					 }
				}
               //$orgUserPermObj->updateData($pData,$pWhere);
          }
		  // delete all associations of org
		  $da = $orgObj->delAllAssocs($iOrganizationID);
     }//exit;

       $udt['eVerifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
       $udt['iVerifiedBy'] = $sess_id;
       $udt['dVerifyDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
       $udt['vVerifyFromIP'] = $_SERVER['REMOTE_ADDR'];
       $userActionObj->setAllVar($udt);
       if(count($vrfdata)>0) {
	       if($vrfdata[0]['eStatus'] != 'Delete' && $vrfdata[0]['eStatus'] != 'Inactive' && $vrfdata[0]['eStatus'] != 'Active') {
	         //$where = "iVerifiedID=$iVerifiedID";
				$where = "iItemID=$iVerifiedID";
	       } else {
	       	$where= " iItemID='".$vrfdata[0]['iVerifiedID']."' AND eSubject = 'OA'";
	       }
	       $res=$userActionObj->updateData($udt,$where);
       }
       $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']=$msg;
	 if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'] == 'OA') {
		  $_SESSION['from'] = 'org';
		  header("Location:".SITE_URL_DUM."createorganization/".$iOrganizationID."/".$msg);
		  exit;
	 } else {
		  header("Location:".SITE_URL_DUM."organizationlist/".$msg);
		  exit;
	 }
} else if($view == 'edit') {
 // $smarty->get_template_vars('');
	 ### SERVER SIDE VALIDATION ####

	 include(SITE_CLASS_GEN."class.validation.php");
	 $validation=new Validation();
	 $RequiredFiledArr = array(
									 'vCompanyName'       => $smarty->get_template_vars('LBL_ENTER_COMPANY_NAME'),
									 'vCompanyRegNo'      => $smarty->get_template_vars('LBL_ENTER_COMPANY_REG_NO'),
									 'vAddressLine1'      => $smarty->get_template_vars('LBL_ENTER_ADDRESS')."1",
									 'vCity'              => $smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_CITY'),
									 'vCountry'           => $smarty->get_template_vars('LBL_SELECT_COUNTRY'),
									 'vState'             => $smarty->get_template_vars('LBL_SELECT_STATE'),
									 'vZipcode'           => $smarty->get_template_vars('LBL_ZIPCODE'),
									 'vEmail'             => $smarty->get_template_vars('LBL_ENTER_EMAIL'),
									 'eOrganizationType'  => $smarty->get_template_vars('LBL_ORGANIZATION_TYPE')
								);
	 $resArr = $validation->isEmpty($RequiredFiledArr);
	 $tempData=$_POST['Data'];
	 $tempData['vPhoneCode'] = (isset($tempData['vPhoneCode']))? $tempData['vPhoneCode'] : '';
	 $vNum=$validation->isNum(array($tempData['vPhoneCode'],$tempData['vPhone']),array($smarty->get_template_vars('MSG_VALID_PHONE_CODE'),$smarty->get_template_vars('MSG_VALID_PHONE_NO')),'empty');
	//prints($vNum);exit;
         ###check Valid Email###
        // echo $tempData['vEmail'];exit;
         if($tempData['vEmail']!=''){
              $vmail= $validation->isEmail(array($tempData['vEmail']),array($smarty->get_template_vars('MSG_VALID_EMAIL')));
              }
    ###check duplicate Email###
		  $vlmsg[]=$smarty->get_template_vars('MSG_DUP_EMAIL');
                  $val=$tempData['vEmail'];
            if( $vmail != 'er' && $tempData['vEmail']!='' ){
					 $DupEmail = $validation->ChekDupEmail($iOrganizationID,'iOrganizationID',PRJ_DB_PREFIX."_organization_master",$val,$vlmsg);
            }
            ###End check duplicate Email###

            if($DupEmail == 'er') {
				$dupl = 'dpl';
		  }

           if($resArr || $vNum || $vmail=='er'  ) {
					 $_SESSION['Data']=$Data;
					header("Location:".$_SERVER['HTTP_REFERER']."");
				exit;
		  }

	 ### ENDS HERE ###

	 $bnkdt = $bnkObj->getDetails('*', " AND iBankId=".$Data['iBankId']);
	 $Data['vBankName'] = $bnkdt[0]['vBankName'];
	// INSERT THIS RECORD IN ORGANIZATION_MASTER_TOVERIFY TABLE
	//if(count($emlar)>0) {
		$dt['eStatus'] = $Data['eStatus'] = "Modified";
	/*} else {
		$dt = $Data;
		$dt['eStatus'] = $Data['eStatus'] = "Active";
	}*/

   ### CHECK MULTIPLE ADMIN AVAILABLE FOR THIS ORGANIZATION OR NOT
   //$chkMulAdmin = $orgObj->ChkMultipleOrgAdmin();
   // Prints($chkMulAdmin);exit();
   /*if($chkMulAdmin == '1'){
      $dt = $Data;
      $dt['eStatus'] = $Data['eStatus'] = 'Active';
   }else{
      $dt['eStatus'] = $Data['eStatus'] = $dt['eStatus'];
   }*/

	$odt = $orgObj->getDetails('*'," AND iOrganizationID=$iOrganizationID");
	if($odt[0]['eStatus']=='Need to Verify' || $odt[0]['eStatus']=='Modified' || $odt[0]['eStatus']=='Delete' || $odt[0]['eNeedToVerify']=='Yes')
	{
	 $res = $iOrganizationID;
	} else {
	$Data['iASMID'] = $odt[0]['iASMID'];
	$Data['dCreatedDate'] = $odt[0]['dCreatedDate'];
	$regno = $Data['vCompanyRegNo'] = $odt[0]['vCompanyRegNo'];
	$Data['vCompCode'] = $odt[0]['vCompCode'];
	$code = $Data['vOrganizationCode'] = $odt[0]['vOrganizationCode'];
	$rdt['iModifiedByID'] = $dt['iModifiedByID'] = $Data['iModifiedByID'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
	$rdt['eModifiedBy'] = $dt['eModifiedBy'] = $Data['eModifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
	$rdt['dModifiedDate'] = $dt['dModifiedDate'] = $Data['dModifiedDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
	$rdt['eStatus'] = $dt['eStatus'];
//	$dt['iModifiedByID'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
//	$dt['eModifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
	$Data['iOrganizationID'] = $iOrganizationID;

	// prints($Data); exit;
    $orgvrfObj->setAllVar($Data);
	$res = $orgvrfObj->insert();
	// CHANGE STATUS IN ORGANIZATION MASTER
	$where = " iOrganizationID = '".$iOrganizationID."'";
	$rs = $orgObj->updateData($dt,$where);

	if(is_array($opf) && count($opf) >0) {
	 $rs = $orgprefObj->updateData($rdt,"iOrganizationID=$iOrganizationID");
	 $ivid = $orgPrefVrfObj->getDetails('iVerifiedID'," AND iOrganizationID=$iOrganizationID ",' iVerifiedID DESC ','',' LIMIT 0,1 ');
	 $ivid = $ivid[0]['iVerifiedID'];
	 $rs = $orgPrefVrfObj->updateData($rdt,"iVerifiedID=$ivid"); 	// $iVerifiedID
	}
	// exit;

    //INSERT THIS RECORD IN USER_ACTION_VERIFICATION TABLE
	if(count($emailArr)>0)
	{
     $where = 'AND vType="Organization Updated" AND eSection = "Member"' ;
     $db_email = $emailObj->getDetails('*',$where);
	  $link = SITE_URL_DUM."organizationview/".$iOrganizationID;
     $body = Array("#CNAME#","#LINK#","#MODIFIED_BY#","#REGNO#","#ORGCODE#");
     $post = Array($cname,$link,$sess_user_name."($sess_usertype_short)",$regno,$code);

     $rplarr = Array("Hello #SMNAME#,","background-color: rgb(239, 239, 239);","Regards,","#MAIL_FOOTER#","#SITE_URL#");
     $tbody_en = str_replace($rplarr," ",$db_email[0]['tBody_en']);
     $emailContent_en = trim(str_replace($body,$post, $tbody_en));
     $tbody_fr = str_replace($rplarr," ",$db_email[0]['tBody_fr']);
     $emailContent_fr = trim(str_replace($body,$post, $tbody_fr));

     $Data['iItemID']=$res;
     $Data['eSubject']='OA';
     $Data['eType']='Modified';
     $Data['vMailSubject_en'] = $db_email[0]['vSub_en'];
     $Data['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
     $Data['tMailContent_en'] = $emailContent_en;
     $Data['tMailContent_fr'] = $emailContent_fr;
     $Data['iCreatedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
     $Data['eCreatedType'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
     $Data['dActionDate']=calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');

     // print_r($Data);
     $userActionObj->setAllVar($Data);
     $userActionObj->insert();

     for($i=0;$i<count($emailArr);$i++) {
          $smname = $emailArr[$i]['vFirstName'].' '.$emailArr[$i]['vLastName'];
          $email = $emailArr[$i]['vEmail'];

          //set the values of the body of email format
          $body_arr = Array("#SMNAME#","#CNAME#","#LINK#","#MODIFIED_BY#","#REGNO#","#ORGCODE#","#MAIL_FOOTER#","#SITE_URL#");
          $post_arr = Array($smname,$cname,$link,$sess_user_name."($sess_usertype_short)",$regno,$code,$MAIL_FOOTER,SITE_URL_DUM);
          //prints($body_arr);exit;
          //send mail to the Admin
          $sendMail->Send("Organization Updated","Member",$email,$body_arr,$post_arr);
     }
	}

	 if($res){
		  $orgdtls = $orgObj->select($iOrganizationID);
		  if($orgdtls[0]['eOrganizationType'] == 'Supplier'){
				$opdt['vOrderStatusLevel'] = '';
				$rs = $orgprefObj->updateData($opdt,"iOrganizationID=$iOrganizationID");
		  } else if($orgdtls[0]['eOrganizationType'] == 'Buyer'){
				$opdt['vInvoiceStatusLevel'] = '';
				$rs = $orgprefObj->updateData($opdt,"iOrganizationID=$iOrganizationID");
		  }
		  $rs = $orgUserPermObj->clearExtraPermits($iOrganizationID,$orgdtls[0]['eOrganizationType']);
	 }
	}
	$veml = $Data['vEmail'];
	if($res)$var_msg = "rus";else $var_msg="ruserr.";
     unset($_POST);
     unset($Data);
     unset($Data1);

    //echo SITE_URL_DUM."createorganizationpref/".$iOrganizationID."/".$msg;exit;
	 $_SESSION['from'] = 'org';
	 $var_msg='';
	 $rurl = SITE_URL_DUM."createorganizationpref/".$iOrganizationID;
	 // header("Location:".SITE_URL_DUM."createorganizationpref/".$iOrganizationID."/".$var_msg);
    // exit;
} else {

	 ### SERVER SIDE VALIDATION ####
	 include(SITE_CLASS_GEN."class.validation.php");
	 $validation=new Validation();
	 $RequiredFiledArr = array(
									 'vCompanyName'       =>'Organization Name',
									 'vCompCode'          =>'Company Code',
									 'vCompanyRegNo'      =>'Organization Registartion No',
									 'vAddressLine1'      =>'Organization Address line1',
									 'vCity'              =>'Organization City',
									 'vCountry'           =>'Organization country',
									 'vState'             =>'Organization State',
									 'vZipcode'           =>'Organization ZipCode',
									 'vEmail'             =>'Organization Email',
									 'eOrganizationType'  =>'Organization Type'
								);
	 $resArr = $validation->isEmpty($RequiredFiledArr);
	 $tempData=$_POST['Data'];
	 $vNum=$validation->isNum(array($tempData['vPhone'],$tempData['vZipcode']),array('Valid Phone Number','Valid ZipCode'),'empty');

         ###check Valid Email###
        // prints($tempData['vEmail']);exit;
          if($tempData['vEmail'] != ''){
              $vmail= $validation->isEmail(array($tempData['vEmail']),array($smarty->get_template_vars('MSG_VALID_EMAIL')));
          }

          ###check duplicate Email###
            $vlmsg[]=$smarty->get_template_vars('MSG_DUP_EMAIL');
            $DupEmail = $validation->ChekDupEmail($iOrganizationID,'iOrganizationID',PRJ_DB_PREFIX."_organization_master",$tempData['vEmail'],$vlmsg);
          ###End check duplicate Email###

          ###check alphaNumeric Company Code###
            $vlmsg=$smarty->get_template_vars('MSG_ONLY_ALPHA_NUMERIC');
            $alphanum=$msga=$validation->isAlphaNum($tempData['vCompCode'],$vlmsg,'empty');
          ###End check duplicate Email###

            if($resArr || $vNum || $vmail=='er' || $alphanum=='er') {
                    $_SESSION['Data']=$Data;
				header("Location:".$_SERVER['HTTP_REFERER']."");
				exit;
		  }
		  if($DupEmail == 'er') {
				$dupl = 'dpl';
		  }
	 ### ENDS HERE ###

	 $bnkdt = $bnkObj->getDetails('*', " AND iBankId=".$Data['iBankId']);
	 $Data['vBankName'] = $bnkdt[0]['vBankName'];

     $Data['iASMID'] = PostVar("iASMID");
     $Data['dCreatedDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
     $Data['dCreateFromIP'] = $_SERVER['REMOTE_ADDR'];
	  // $vOrganizationCode = $generalobj->UniqueID("ORG",PRJ_DB_PREFIX."_organization_master","vOrganizationCode",$charlimit="10");
	  $vOrganizationCode = $orgObj->getUniqueCode($Data['eOrganizationType']);
	  // echo $vOrganizationCode; exit;
	  $code = $Data['vOrganizationCode'] = $vOrganizationCode;
//	  $vCompanyRegNo = $generalobj->UniqueID("",PRJ_DB_PREFIX."_organization_master","vCompanyRegNo",$charlimit="10");
	  $regno = $Data['vCompanyRegNo']; // = $vCompanyRegNo;
          $compcode=$Data['vCompCode'];
	  // if(count($arr)>0) {
		 $Data['eStatus'] = "Need to Verify";
	  /*} else {
		 $Data['eStatus'] = "Active";
	  }*/
    // prints($Data);exit;
	 $orgObj->setAllVar($Data);
	 $iOrganizationID = $res = $orgObj->insert();

     //INSERT THIS RECORD IN ORGANIZATION_MASTER_TOVERIFY TABLE
     $insID = $gdbobj->getMaxId(PRJ_DB_PREFIX."_organization_master",'iOrganizationID');

    $Data1 = $Data;
    $iOrganizationID = $Data1['iOrganizationID'] = $insID[0]['id'];
    $orgvrfObj->setAllVar($Data1);
    $res = $orgvrfObj->insert();

/*	 if($res){
		  $orgdtls = $orgObj->select($iOrganizationID);
		  if($orgdtls[0]['eOrganizationType'] == 'Supplier'){
				$opdt['vOrderStatusLevel'] = '';
				$rs = $orgprefObj->updateData($opdt,"iOrganizationID=$iOrganizationID");
		  } else if($orgdtls[0]['eOrganizationType'] == 'Buyer'){
				$opdt['vInvoiceStatusLevel'] = '';
				$rs = $orgprefObj->updateData($opdt,"iOrganizationID=$iOrganizationID");
		  }
		  $rs = $orgUserPermObj->clearExtraPermits($iOrganizationID,$orgdtls[0]['eOrganizationType']);
	 }
*/
     //INSERT THIS RECORD IN USER_ACTION_VERIFICATION TABLE
	if(count($arr)>0)
	{
     $where = 'AND vType="New Organization Added" AND eSection = "Member"' ;
     $db_email = $emailObj->getDetails('*',$where);
	  $link = SITE_URL_DUM."organizationview/".$Data1['iOrganizationID'];
     $body = Array("#SMNAME#","#CNAME#","#LINK#","#ADDED_BY#","#REGNO#","#ORGCODE#","#COMPCODE#");
     $post = Array($sname,$cname,$link,$sess_user_name."($sess_usertype_short)",$regno,$code,$compcode);

     $rplarr = Array("Hello #SMNAME#,","background-color: rgb(239, 239, 239);","Regards,","#MAIL_FOOTER#","#SITE_URL#");
     $tbody_en = str_replace($rplarr," ",$db_email[0]['tBody_en']);
     $emailContent_en = trim(str_replace($body,$post, $tbody_en));
     $tbody_fr = str_replace($rplarr," ",$db_email[0]['tBody_fr']);
     $emailContent_fr = trim(str_replace($body,$post, $tbody_fr));
     //prints($emailContent);exit;

     $Data['iItemID']=$res;
     $Data['iOrganizationID']=$iOrganizationID;
     $Data['eSubject']='OA';
     $Data['eType']='Create';
     $Data['vMailSubject_en'] = $db_email[0]['vSub_en'];
     $Data['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
     $Data['tMailContent_en'] = $emailContent_en;
     $Data['tMailContent_fr'] = $emailContent_fr;
     $Data['iCreatedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
     $Data['eCreatedType'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
     $Data['dActionDate']=calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');

     $userActionObj->setAllVar($Data);
     $userActionObj->insert();

     for($i=0;$i<count($arr);$i++) {
          $smname = $arr[$i]['vFirstName'].' '.$arr[$i]['vLastName'];
          $email = $arr[$i]['vEmail'];

          //set the values of the body of email format
          $body_arr = Array("#SMNAME#","#CNAME#","#LINK#","#ADDED_BY#","#REGNO#","#ORGCODE#","#COMPCODE#","#MAIL_FOOTER#","#SITE_URL#");
          $post_arr = Array($smname,$cname,$link,$sess_user_name."($sess_usertype_short)",$regno,$code,$compcode,$MAIL_FOOTER,SITE_URL_DUM);

          //send mail to the Admin
          $sendMail->Send("New Organization Added","Member",$email,$body_arr,$post_arr);
     }
	}
	 $veml = $Data['vEmail'];
	if($res)$var_msg = "ras";else $var_msg="raserr";
     unset($_POST);
     unset($Data);
     unset($Data1);

	 $_SESSION['from'] = 'org'; $var_msg = '';
	 $rurl = SITE_URL_DUM."createorganizationpref/".$insID[0]['id'];
    // header("Location:".SITE_URL_DUM."createorganizationpref/".$insID[0]['id']."/".$var_msg);
    // exit;
}

// dpr email for duplication of email in rec
if($dupl == 'dpl')
{
	 $eml = $veml;
	 $where = 'AND vType="Email Duplication" AND eSection = "Member"' ;
     $db_email = $emailObj->getDetails('*',$where);
	  $link = SITE_URL_DUM."organizationview/".$iOrganizationID;
     $body = Array("#REC#","#EMAIL#","#LINK#");
	  $rec = $smarty->get_template_vars('LBL_ORGANIZATION');
     $post = Array($rec,$eml,$link);

     $rplarr = Array("Hello #NAME#,","background-color: rgb(239, 239, 239);","Regards,","#MAIL_FOOTER#","#SITE_URL#");
     $tbody_en = str_replace($rplarr," ",$db_email[0]['tBody_en']);
     $emailContent_en = trim(str_replace($body,$post, $tbody_en));
     $tbody_fr = str_replace($rplarr," ",$db_email[0]['tBody_fr']);
     $emailContent_fr = trim(str_replace($body,$post, $tbody_fr));
     // prints($emailContent_en); exit;

     $Data['iItemID']=$res;
     $Data['iOrganizationID']=$iOrganizationID;
     $Data['eSubject']='OA';
     $Data['eType']='Email Duplication';
     $Data['vMailSubject_en'] = $db_email[0]['vSub_en'];
     $Data['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
     $Data['tMailContent_en'] = $emailContent_en;
     $Data['tMailContent_fr'] = $emailContent_fr;
     $Data['iCreatedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
     $Data['eCreatedType'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
     $Data['dActionDate']=calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
     // prints($Data); exit;
    $userActionObj->setAllVar($Data);
    $userActionObj->insert();

    for($i=0;$i<count($arr);$i++)
	 {
        $smname = $arr[$i]['vFirstName'].' '.$arr[$i]['vLastName'];
        $email = $arr[$i]['vEmail'];

        //set the values of the body of email format
        $body_arr = Array("#NAME#","#REC#","#EMAIL#","#LINK#","#MAIL_FOOTER#","#SITE_URL#");
        $post_arr = Array($smname,$rec,$eml,$link,$MAIL_FOOTER,SITE_URL_DUM);

        //send mail to the Admin
		  $sendMail->Send("Email Duplication","Member",$email,$body_arr,$post_arr);
    }
}
// prints($_SESSION['from']); exit;
if($view=='edit' && $_SESSION['from']!='org') {
   $_SESSION['from'] = 'org';
}

$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']=$var_msg;
header("Location:".$rurl."/".$var_msg);
exit;
?>