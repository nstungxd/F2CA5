<?php
include(S_SECTIONS."/member/memberaccess.php");

//sendmail class incude
include(SITE_CLASS_GEN."class.sendmail.php");
//initialization of senmail class object
$sendMail=new SendPHPMail;

if(!isset($secManObj)) {
	include_once(SITE_CLASS_APPLICATION.'class.SecurityManager.php');
	$secManObj = new SecurityManager();
}
if(!isset($orgUserObj)) {
   include_once(SITE_CLASS_APPLICATION.'user/class.OrganizationUser.php');
   $orgUserObj = new OrganizationUser();
}
if(!isset($userToVerifyObj)) {
	include_once(SITE_CLASS_APPLICATION.'user/class.OrganizationUserToverify.php');
	$userToVerifyObj = new OrganizationUserToverify();
}
if(!isset($emailObj)) {
     include_once(SITE_CLASS_APPLICATION.'class.EmailTemplate.php');
     $emailObj = new EmailTemplate();
}
if(!isset($orgUserPermObj)) {
   include_once(SITE_CLASS_APPLICATION."user/class.OrganizationUserPermission.php");
   $orgUserPermObj =	new OrganizationUserPermission();
}
if(!isset($orgUserPermVerifyObj)) {
   include_once(SITE_CLASS_APPLICATION."user/class.OrganizationUserPermissionToVerify.php");
   $orgUserPermVerifyObj =	new OrganizationUserPermissionToVerify();
}

if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'] == 'SM')
{
	$smdt = $secManObj->getDetails('*'," AND iSMID!=".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']." AND eStatus='Active' AND eEmailNotification='Yes' ");
	$ordt = $orgUserObj->getDetails('*'," AND eStatus='Active' AND eUserType='Admin' AND eEmailNotification='Yes' AND iOrganizationID=".$usrdt[0]['iOrganizationID']);
}
else if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'] == 'OA')
{
	$smdt = $secManObj->getDetails('*'," AND eStatus='Active' AND eEmailNotification='Yes' ");
	$ordt = $orgUserObj->getDetails('*'," AND iUserID!=".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']." AND eStatus='Active' AND eEmailNotification='Yes' AND eUserType='Admin' AND iOrganizationID=".$usrdt[0]['iOrganizationID']);
}
if(is_array($smdt) && is_array($ordt)) {
	$emailArr = array_merge($smdt,$ordt);
}
else if(is_array($smdt)) {
	$emailArr = $smdt;
}
else if(is_array($ordt)) {
	$emailArr = $ordt;
}

// for check of verification
if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'] == 'SM')
{
	$sm_dt = $secManObj->getDetails('*'," AND iSMID!=".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']." AND eStatus='Active' ");
	$or_dt = $orgUserObj->getDetails('*'," AND eStatus='Active' AND eUserType='Admin' AND iOrganizationID=".$usrdt[0]['iOrganizationID']);
}
else if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'] == 'OA')
{
	$sm_dt = $secManObj->getDetails('*'," AND eStatus='Active' ");
	$or_dt = $orgUserObj->getDetails('*'," AND iUserID!=".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']." AND eStatus='Active' AND eUserType='Admin' AND iOrganizationID=".$usrdt[0]['iOrganizationID']);
}
if(is_array($sm_dt) && is_array($or_dt)) {
	$emlar = array_merge($sm_dt,$or_dt);
}
else if(is_array($sm_dt)) {
	$emlar = $sm_dt;
}
else if(is_array($ordt)) {
	$emlar = $or_dt;
}

function phoneCode($field) {
     global $Data;
     if($Data[$field]!='' && $_POST[$field.'Code']!='' ){
       $Data[$field]=$_POST[$field.'Code']."-".$Data[$field];
     }
}
$Data = PostVar("Data");
$dupl = PostVar('dpr');

phoneCode('vPhone');
phoneCode('vMobile');

//prints($_POST);EXIT;
//exit;
if(!isset($Data['eEmailNotification']))
   $Data['eEmailNotification']='No';
$iOrgID=$Data['iOrganizationID'];
//prints($Data);exit;
$Data_access = PostVar("Data_access");
$iUserID = PostVar("iUserID");
$iOrganizationID = PostVar("iOrgID");
$view = PostVar("view");
$curr_date	=calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');

/*if($sess_usertype == 'securitymanager')
   $where ="and bom.iASMID='".$sess_id."'";
else $where = "and bom.iOrganizationID='".$sess_id."'";
$totRow=$orgUserObj->getDetails_PG('*',$where);
$totRow=$totRow['tot'];
if($totRow<=0) {
   $userType='Admin';
   $eStatus='Active';
} else if($Data['eUserType'] == '') {
   $userType='User';
} else {
   $userType=$Data['eUserType'];
   $eStatus=$Data['eStatus'];
}
// echo $view; exit;
### CHECK MULTIPLE ADMIN AVAILABLE FOR THIS ORGANIZATION OR NOT
$chkMulAdmin = $orgObj->ChkMultipleOrgAdmin();
if($chkMulAdmin == '1'){
   $eStatus = 'Active';
}else{
   $eStatus = $eStatus;
}*/
if($view == 'reject')
{
	$dt['eNeedToVerify'] = $dts['eNeedToVerify'] = 'No';
	$dt['tReasonToReject'] = $_POST['tReasonToReject'];
	$dt['iRejectedById'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
	$dt['eRejectedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
	$dt['dRejectedDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
   $dt['eStatus'] = $dts['eStatus'] = "Active";
	$orgusrdtls = $orgUserObj->getDetails('*'," AND iUserID=$iUserID ");
	$usrvrfydt = $userToVerifyObj->getDetails('*'," AND iUserID=$iUserID "," iVerifiedID DESC ",''," LIMIT 0,1");
   if($orgusrdtls[0]['eStatus']=='Need to Verify')
   {
		$dts['tReasonToReject'] = $dt['tReasonToReject'];
		$dt['eStatus'] = $dts['eStatus'] = "Inactive";
	} else if($usrvrfydt[0]['eStatus']=='Inactive' && $usrvrfydt[0]['eNeedToVerify']=='Yes') {
		$dt['eNeedToVerify'] = $dts['eNeedToVerify'] = "No";
		$dt['eStatus'] = $dts['eStatus'] = "Active";
	} else if($usrvrfydt[0]['eStatus']=='Active' && $usrvrfydt[0]['eNeedToVerify']=='Yes') {
		$dt['eNeedToVerify'] = $dts['eNeedToVerify'] = "No";
		$dt['eStatus'] = $dts['eStatus'] = "Inactive";
		$dts['tReasonToReject'] = $dt['tReasonToReject'];
	} else if($orgusrdtls[0]['eStatus']=='Modified') {
		$dt['eStatus'] = $dts['eStatus'] = "Active";
		$dts['iModifiedByID'] = "";
		$dts['eModifiedBy'] = "";
	} else if($orgusrdtls[0]['eStatus']=='Delete') {
	   $dt['eStatus'] = $dts['eStatus'] = "Active";
		$dts['iModifiedByID'] = "";
		$dts['eModifiedBy'] = "";
	}
	$res = $orgUserObj->updateData($dts," iUserID=$iUserID ");
	$iVerifiedID = $userToVerifyObj->getDetails('*'," AND iUserID=$iUserID "," iVerifiedID DESC ",''," LIMIT 0,1");
	if(is_array($iVerifiedID) && count($iVerifiedID)>0) {
		$iVerifiedID = $iVerifiedID[0]['iVerifiedID'];
		$rs = $userToVerifyObj->updateData($dt," iVerifiedID=$iVerifiedID ");
	}

	if($res) {
		$usrprmtdtls = $orgUserPermObj->getDetails('*'," AND iUserID=$iUserID ");
		$vudtl = $orgUserPermVerifyObj->getDetails('*'," AND iUserID=$iUserID "," iVerifiedID DESC ",''," LIMIT 0,1");
		if($usrprmtdtls[0]['eStatus']=='Need to Verify' || $usrprmtdtls[0]['eStatus']=='Modified' || $usrprmtdtls[0]['eStatus']=='Delete' || $usrprmtdtls[0]['eNeedToVerify']=='Yes') {
			$rs = $orgUserPermObj->updateData($dts," iUserID=$iUserID ");
			if($vudtl[0]['iVerifiedID'] > 0) {
				$rs = $orgUserPermVerifyObj->updateData($dt," iVerifiedID=".$vudtl[0]['iVerifiedID']);
			}
		}
	}

	// $res = $orgUserPermObj->updateData($dts," iUserID=$iUserID ");
	// $pVerifiedID = $orgUserPermVerifyObj->getDetails('iVerifiedID'," AND iUserID=$iUserID ",' iVerifiedID DESC','',' LIMIT 0,1 ');
	// $pVerifiedID = $pVerifiedID[0]['iVerifiedID'];
	// $rs = $userToVerifyObj->updateData($dt," iVerifiedID=$pVerifiedID ");

	if($res) {
		$msg = "rus";
	} else {
		$msg = "ruserr";
	}
	$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']=$msg;
	header("Location:".SITE_URL_DUM."organizationuserlist/".$msg);
   exit;
}
if($view == 'verify') {
     $where = " AND iUserID='".$iUserID."'";//exit;
     $orderby = ' iVerifiedID Desc ';
	  $dt['eNeedToVerify'] = $data['eNeedToVerify'] = 'No';
     $vrfdata=$userToVerifyObj->getDetails('*',$where,$orderby,''," LIMIT 0,1 ");
     // prints($vrfdata);exit;
     // echo $vrfdata[0]['eStatus'];EXIT;
      if($vrfdata[0]['eStatus'] == 'Delete') {
          $where = " AND iUserID='".$iUserID."'";
          $res = $orgUserObj->del($where);
          $data['eStatus'] = 'Active';
			 $data['iVerifiedSMID'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
			 $data['eVerifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
			 $data['dVerifiedDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
          $userToVerifyObj->setAllVar($data);
          $where = " iUserID IN (".$iUserID.")";
          $res = $userToVerifyObj->updateData($data, $where);
			if($res) {
				$where = " AND iUserID=$iUserID ";
				$rs = $orgUserPermObj->del($where);
			}
         if($res){$var_msg = "rds";}else{$var_msg = "rdserr";}
     } else if($vrfdata[0]['eStatus'] == 'Inactive' || $vrfdata[0]['eStatus'] == 'Active') {
          unset($data);
			 $dt['eNeedToVerify'] = $data['eNeedToVerify'] = 'No';
			 $dt['tReasonToReject'] = $data['tReasonToReject'] = '';
          if($vrfdata[0]['eStatus'] == 'Inactive')
               $data['eStatus'] = 'Inactive';
          else
               $data['eStatus'] = 'Active';
			 $data['iVerifiedSMID'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
			 $data['eVerifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
			 $data['dVerifiedDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
          $where = "iUserID='".$iUserID."'";
          $res = $orgUserObj->updateData($data, $where);
			 $iverify = $userToVerifyObj->getDetails('iVerifiedID',' AND '.$where,' iVerifiedID DESC ','',' LIMIT 0,1 ');
          $userToVerifyObj->setAllVar($data);
          $where = "iUserID IN (".$iUserID.")";
          $res = $userToVerifyObj->updateData($data," iVerifiedID=".$iverify[0]['iVerifiedID']);
			// $res = $orgUserPermObj->updateData($data," iUserID=$iUserID ");
			if($res) {
				$usrprmtdtls = $orgUserPermObj->getDetails('*'," AND iUserID=$iUserID ");
				$vudtl = $orgUserPermVerifyObj->getDetails('*'," AND iUserID=$iUserID "," iVerifiedID DESC ",''," LIMIT 0,1");
				if($usrprmtdtls[0]['eStatus']=='Need to Verify' || $usrprmtdtls[0]['eStatus']=='Modified' || $usrprmtdtls[0]['eStatus']=='Delete' || $usrprmtdtls[0]['eNeedToVerify']=='Yes') {
					$rs = $orgUserPermObj->updateData($data," iUserID=$iUserID ");
					$rs = $orgUserPermVerifyObj->updateData($data," iVerifiedID=".$vudtl[0]['iVerifiedID']);
				}
			}
          if($res){$var_msg = "rss";}else{$var_msg = "rsserr";}
     } else {
     		 $dt = array();
          $dt['iVerifiedSMID'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
			 $dt['eVerifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
			 $dt['eNeedToVerify'] = 'No';
			 $dt['tReasonToReject'] = '';
			 $dt['dVerifiedDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
          $dt['eStatus'] = 'Active';
			if($vrfdata[0]['iVerifiedID'] > 0) {
          $userToVerifyObj->setAllVar($dt);
          $where = " iVerifiedID='".$vrfdata[0]['iVerifiedID']."'";
          $iVerifiedID=$userToVerifyObj->updateData($dt,$where);
			}
         if($iVerifiedID) {
            $where = " AND iVerifiedID='".$vrfdata[0]['iVerifiedID']."'";
            $updtdata=$userToVerifyObj->getDetails('*',$where);
            $vdt = $updtdata[0];
            unset($vdt['iVerifiedID']);
            unset($vdt['iUserID']);
            $where= " iUserID='".$vrfdata[0]['iUserID']."'";
            $res=$orgUserObj->updateData($vdt,$where);
            if($res){$var_msg = "rvs";}else{$var_msg = "rvserr";}
         }
			if($res) {
				$usrprmtdtls = $orgUserPermObj->getDetails('*'," AND iUserID=$iUserID ");
				$vudtl = $orgUserPermVerifyObj->getDetails('*'," AND iUserID=$iUserID "," iVerifiedID DESC ",''," LIMIT 0,1");
				if($usrprmtdtls[0]['eStatus']=='Need to Verify' || $usrprmtdtls[0]['eStatus']=='Modified' || $usrprmtdtls[0]['eStatus']=='Delete' || $usrprmtdtls[0]['eNeedToVerify']=='Yes') {
					if($vudtl[0]['iVerifiedID'] > 0) {
						$rs = $orgUserPermVerifyObj->updateData($dt," iVerifiedID=".$vudtl[0]['iVerifiedID']);
						$vudtls = $orgUserPermVerifyObj->getDetails('*'," AND iUserID=$iUserID "," iVerifiedID DESC ",''," LIMIT 0,1");
						unset($vudtls[0]['iVerifiedID']);
						$rs = $orgUserPermObj->updateData($vudtls[0]," iUserID=$iUserID ");
					}
				}
			}
     }
	  
			if(!isset($userActionObj)) {
				  include_once(SITE_CLASS_APPLICATION.'user/class.UserActionVerification.php');
				  $userActionObj = new UserActionVerification();
			}
          $udt['eVerifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
          $udt['iVerifiedBy'] = $sess_id;
          $udt['dVerifyDate'] = $curr_date;
          $udt['vVerifyFromIP'] = $_SERVER['REMOTE_ADDR'];
          $userActionObj->setAllVar($udt);
          $where= " iItemID='".$vrfdata[0]['iVerifiedID']."' AND eSubject = 'User'";
          $res=$userActionObj->updateData($udt,$where);
          unset($udt);
          unset($vdt);
          unset($dt);
          unset($iUserID);
          $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']=$var_msg;
          header("Location:".SITE_URL_DUM."organizationuserlist/".$var_msg);
          exit;
} else if($view == 'edit') {
	include(SITE_CLASS_GEN."class.validation.php");
	$validation=new Validation();

   $id=$_POST['iUserID'];
   $Val=$Data['vEmail'];

   //$count = $validation->ChekDupEmail($id,'vEmail','".PRJ_DB_PREFIX."_organization_user',$val);
   ### SERVER SIDE VALIDATION ####
   $smarty->get_template_vars('');
    $RequiredFiledArr = array(
                                    'vFirstName'          =>$smarty->get_template_vars('LBL_ENTER_FIRST_NAME'),
                                     'vLastName'          =>$smarty->get_template_vars('LBL_ENTER_LAST_NAME'),
                                     'vUserName'          =>$smarty->get_template_vars('LBL_ENTER_USER_NAME'),
                                     'vPassword'          =>$smarty->get_template_vars('LBL_ENTER_PASSWORD'),
                                     'cPassword'          =>$smarty->get_template_vars('LBL_ENTER_CPASSWORD'),
                                     'vCountry'           =>$smarty->get_template_vars('LBL_ENTER_COUNTRY'),
                                     'vState'             =>$smarty->get_template_vars('LBL_ENTER_STATE'),
                                     'vZipCode'           =>$smarty->get_template_vars('LBL_ZIPCODE'),
                                     'vEmail'             =>$smarty->get_template_vars('LBL_EMAIL_ADDRESS'),
                                     'vCity'              =>$smarty->get_template_vars('LBL_ENTER_CITY'),
                                     'iOrganizationID'    => $smarty->get_template_vars('MSG_SELECT_ORGANIZATION'),
                                     'vAddressLine1'      =>$smarty->get_template_vars('LBL_ENTER_ADDRESSLINE1'),
                                     'vAnswer'            =>$smarty->get_template_vars('LBL_ENTER_FIRST_NAME'),
                                     'iSecretQuestion1ID' =>$smarty->get_template_vars('LBL_ENTER_QESTION')
        );

	 $resArr = $validation->isEmpty($RequiredFiledArr);
         //prints($resArr);exit;

	 ### ENDS HERE ###


       $id=$_POST['iUserID'];
        $val=$Data['vEmail'];
        $user=$Data['vUserName'];


        ###check Valid Email###
          $chekemail = array(
               'vEmail'  =>$val
            );


          $validEmailmsg[]=$smarty->get_template_vars('MSG_VALID_EMAIL');
          if($Data['vEmail'] != ''){
             $vmail= $validation->isEmail($chekemail,$validEmailmsg);
          }

          ###  End check Valid Email###

          /*
          $arr=array();
           if($Data['vPhone']!=''){ $arr=$Data['vPhone'];}
          $ar=array (explode('-',$arr));
          $Data['vPhone']= $ar[0][1];
          $Data['vPhoneCode']=$ar[0][0];
          if($Data['vMobile']!=''){ $arr=$Data['vMobile']; }
          $an=array (explode('-',$arr));
          $Data['vMobile']= $an[0][1];
          $vMobile=$Data['vMobile'];

           $Data['vMobileCode']=$an[0][0];
            */
       /*
          $arr=array();
          if($Data['vPhone']!=''){ $arr=$Data['vPhone'];}
          $ar=array (explode('-',$arr));
          $vPhone= $ar[0][1];
          $vPhoneCode=$ar[0][0];
          if($Data['vMobile']!=''){ $arr=$Data['vMobile']; }
          $an=array (explode('-',$arr));
          $vMobile= $an[0][1];
          $vMobileCode=$an[0][0];

            $NumeicFildvalue = array(
                     'vZipCode'  =>$vZipCode,
                     'vPhone'  =>$vPhone,
                     'vMobile' =>  $vMobile,
                     'vPhoneCode' =>  $vPhoneCode,
                     'vMobileCode' =>  $vMobileCode,
            );
           $NumeicFildMsg = array(
                                'vZipCode'  =>$smarty->get_template_vars('MSG_VALID_ZIPCODE'),
                                 'vPhone'  =>$smarty->get_template_vars('MSG_VALID_PHONE_NO'),
                                 'vMobile' => $smarty->get_template_vars('MSG_VALID_MOBILE_NO'),
                                 'vPhoneCode'  =>$smarty->get_template_vars('MSG_VALID_PHONE_CODE'),
                                 'vMobileCode' => $smarty->get_template_vars('MSG_VALID_MOB_CODE')

          );

            $Numeric = $validation->isNum($NumeicFildvalue,$NumeicFildMsg,$typ='');
        */
			$nary = array('vZipCode'=>$Data['vZipCode'],'vPhoneCode'=>$_POST['vPhoneCode'],'vPhone'=>$_POST['Data']['vPhone'],'vMobileCode'=>$_POST['vMobileCode'],'vMobile'=>$_POST['Data']['vMobile']);
			$nvmsg = array('vZipCode'=>$smarty->get_template_vars('MSG_VALID_ZIPCODE'),'vPhoneCode'=>$smarty->get_template_vars('MSG_VALID_PHONE_CODE'),'vPhone'=>$smarty->get_template_vars('MSG_VALID_PHONE_NO'),'vMobileCode'=>$smarty->get_template_vars('MSG_VALID_MOB_CODE'),'vMobile'=>$smarty->get_template_vars('MSG_VALID_MOBILE_NO'));
         // prints($nary);exit;
          $vNum=$validation->isNum($nary,$nvmsg,'empty');

         ### Password And Re-Password Equel  ###
             $vPassword['vPassword'] = $Data['vPassword'];
				 $cPassword = array();
             $cPassword['vPassword'] = $_POST['cPassword'];
             $vldmsg[] = $smarty->get_template_vars('MSG_PASS_NOT_EQUEL');
				 if( $vPassword['vPassword']!='' && $cPassword['cPassword'] != ''){
					$Equel = $validation->isEqual($vPassword, $cPassword, $vldmsg);
				 }

        ### Password And Re-Password Equel  ###
        ### check user Duplicate ###

              $vlmsg[]= $smarty->get_template_vars('MSG_VALID_USER');
              if($Data['vUserName']!='') {
              		$exchk = " AND iOrganizationID=".$_POST['Data']['iOrganizationID'];
						$DupUser = $validation->ChekDupUserName($id,'iUserID',PRJ_DB_PREFIX."_organization_user",$user,$vlmsg,$exchk);
              }

       //  prints($DupUser);exit;


       ### check user Duplicate ###
       ###check duplicate###

                $msg[]=$smarty->get_template_vars('MSG_DUP_EMAIL');
               // prints($msg);exit;
                if($Data['vEmail'] !='' && $vmail !='er' ) {
                    //echo "hello";exit;
                    $DupEmail = $validation->ChekDupEmail($id,'iUserID',PRJ_DB_PREFIX."_organization_user",$val,$msg);
                }

//prints($DupEmail);exit;
       ###End check duplicate###
         // prints($_SESSION);exit;
      ###  Redirect  ###
         if($resArr || $vmail=='er' || $DupUser=='er' || $Equel=='er' || $Numeric=='er' ) {
             $_SESSION['Data']=$Data;
             //echo 'in';exit;
		   header("Location:".$_SERVER['HTTP_REFERER']."");
		 exit;
	 }


   //     unset ($Data['iUserID']);
	$Data['iUserID']=$iUserID;
	//
   $dt['eStatus'] = $Data['eStatus'] = 'Modified';
	$Data['vPassword'] = $generalobj->encrypt($Data['vPassword']);
	$Data['iVerifiedID']='';
	if($Data['eEmailNotification'] == '') { $Data['eEmailNotification']='No'; }

      //if(count($emlar)>0) {
   		$dt['eStatus'] = $Data['eStatus'] = 'Modified';
   	/*} else {
   		$dt = $Data;
   		$dt['eStatus'] = $Data['eStatus'] = 'Active';
   	}

      if($chkMulAdmin == '1'){
         $dt = $Data;
         $dt['eStatus'] = $Data['eStatus'] = 'Active';
      }else{
         //$dt['eStatus'] = $Data['eStatus'] = $dt['eStatus'];
      }*/

     $whereUsr = " AND iUserID='".$iUserID."'";
     $usrdata=$orgUserObj->getDetails('eStatus',$whereUsr,'',''," LIMIT 0,1 ");
     $usrdata=$usrdata[0];
     if($usrdata['eStatus']== 'Inactive') {
        // $dt['eStatus']='Inactive';
     }
     if($usrdata['eStatus']== 'Need to Verify') {
        $dt['eStatus'] = $Data['eStatus'] = 'Need to Verify';
     }
	$dt['iModifiedByID'] = $Data['iModifiedByID'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
	$dt['eModifiedBy'] = $Data['eModifiedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
	$dt['dModifiedDate'] = $Data['dModifiedDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
	$oudt = $orgUserObj->getDetails('*'," AND iUserID=$iUserID ");
	$Data['iCreatedBy'] = $oudt[0]['iCreatedBy'];
	$Data['eCreatedBy'] = $oudt[0]['eCreatedBy'];
	$Data['dCreatedDate'] = $oudt[0]['dCreatedDate'];
	if(!isset($Data['vAnswer'])) {
		$Data['vAnswer'] = $oudt[0]['vAnswer'];
	}
	if(!isset($Data['vAnwser'])) {
		$Data['vAnwser'] = $oudt[0]['vAnwser'];
	}
	// prints($Data);exit;
	if($usrdata['eStatus']!='Need to Verify') {
		$userToVerifyObj->setAllVar($Data);
		$iVerifiedID=$userToVerifyObj->insert();
		if($iVerifiedID) {
			$where= "  iUserID='".$iUserID."'";
			unset($dt['iVerifiedID']);
			// $dt['eStatus'] = 'Modified';
	             /*
	                $array1 = array($Data['vPhoneCode'], $Data['vPhone']);
	                $Data['vPhone'] = implode("-", $array1);
	               //echo $Data['vPhone'];exit;
	                $array2 = array($Data['vMobileCode'], $Data['vMobile']);
	                $Data['vMobile'] = implode("-", $array2);*/
	            // prints($dt);exit;
			$updateSucc=$orgUserObj->updateData($dt,$where);
			if($updateSucc) {
				$rs = $orgUserPermObj->updateData($dt," iUserID=$iUserID "," iVerifiedID DESC ");
				$vrfydtl = $orgUserPermVerifyObj->getDetails('iVerifiedID'," AND iUserID=$iUserID "," iVerifiedID DESC ",'',' LIMIT 0,1 ');
				$ivfId = $vrfydtl[0]['iVerifiedID'];
				if($ivfId >0) {
					$rs = $orgUserPermVerifyObj->updateData($dt," iVerifiedID=$ivfId ");
				}
			}
	      if(!$updateSucc)
				$iUserID='';
		}
	} else if($usrdata['eStatus']=='Need to Verify') {
		$where= " iUserID='".$iUserID."'";
		unset($Data['iVerifiedID']);
		$updateSucc=$orgUserObj->updateData($Data,$where);
		if($updateSucc) {
			$vudt = $userToVerifyObj->getDetails('*',' AND '.$where,' iVerifiedID DESC ');
			if(is_array($vudt) && count($vudt)>0 && $vudt[0]['iVerifiedID']>0) {
				$ivid = $vudt[0]['iVerifiedID'];
				$where_rv = " iVerifiedID=$ivid ";
				$r = $userToVerifyObj->updateData($Data,$where_rv);
			}
		}
		if(!$updateSucc)
			$iUserID='';
	}
   // exit;
   $whereUsr = " AND iUserID='".$iUserID."'";
   $usrdata = $orgUserObj->getDetails('*',$whereUsr,'',''," LIMIT 0,1 ");
   if($usrdata[0]['eUserType']=='Admin' || $Data['eUserType']=='Admin') {
   	$redirecturl = SITE_URL_DUM."organizationuserlist";
   } else {
		$_SESSION['from']='usr';
		$redirecturl = SITE_URL_DUM."edituserrights/$iUserID/";
	}
} else {
   include(SITE_CLASS_GEN."class.validation.php");
	$validation=new Validation();

   ### SERVER SIDE VALIDATION ####


   $RequiredFiledArr = array(
                                    'vFirstName'          =>$smarty->get_template_vars('LBL_ENTER_FIRST_NAME'),
                                     'vLastName'          =>$smarty->get_template_vars('LBL_ENTER_LAST_NAME'),
                                     'vUserName'          =>$smarty->get_template_vars('LBL_ENTER_USER_NAME'),
                                     'vPassword'          =>$smarty->get_template_vars('LBL_ENTER_PASSWORD'),
                                     'cPassword'          =>$smarty->get_template_vars('LBL_ENTER_CPASSWORD'),
                                     'vCountry'           =>$smarty->get_template_vars('LBL_ENTER_COUNTRY'),
                                     'vState'             =>$smarty->get_template_vars('LBL_ENTER_STATE'),
                                     'vZipCode'           =>$smarty->get_template_vars('LBL_ZIPCODE'),
                                     'vEmail'             =>$smarty->get_template_vars('LBL_EMAIL_ADDRESS'),
                                     'vCity'              =>$smarty->get_template_vars('LBL_ENTER_CITY'),
                                     'iOrganizationID'    => $smarty->get_template_vars('MSG_SELECT_ORGANIZATION'),
                                     'vAddressLine1'      =>$smarty->get_template_vars('LBL_ENTER_ADDRESSLINE1'),
                                     'vAnswer'            =>$smarty->get_template_vars('LBL_ENTER_ANSWER'),
                                     'iSecretQuestion1ID' =>$smarty->get_template_vars('LBL_ENTER_QESTION')
        );

	 $resArr = $validation->isEmpty($RequiredFiledArr);
         //prints($resArr);exit;

	 ### ENDS HERE ###


         $id=$Data['iUserID'];
        $val=$Data['vEmail'];
        $user=$Data['vUserName'];


        ###check Valid Email###
          $chekemail = array(
                     'vEmail'  =>$val
            );


          $validEmailmsg[]=$smarty->get_template_vars('MSG_VALID_EMAIL');
          if($Data['vEmail'] != ''){
             $vmail= $validation->isEmail($chekemail,$validEmailmsg);
          }

          ###  End check Valid Email###
            if($Data['vZipcode'] != ''){
                                          $vZipCode=$Data['vZipcode'];
                                       }

           $arr=array();
           if($Data['vPhone']!=''){ $arr=$Data['vPhone'];}
          $ar=array (explode('-',$arr));
          $Data['vPhone']= $ar[0][1];
          $Data['vPhoneCode']=$ar[0][0];
          if($Data['vMobile']!=''){ $arr=$Data['vMobile']; }
          $an=array (explode('-',$arr));
          $Data['vMobile']= $an[0][1];
          $vMobile=$Data['vMobile'];
           $Data['vMobileCode']=$an[0][0];


// $vNum=$validation->isNum(array($tempData['vPhoneCode'],$tempData['vPhone']),array($smarty->get_template_vars('MSG_VALID_PHONE_CODE'),$smarty->get_template_vars('MSG_VALID_PHONE_NO')),'empty');
           /* $NumeicFildvalue = array(
                     'vZipCode'  =>$vZipCode,
                     'vPhone'  =>$vPhone,
                     'vMobile' =>  $vMobile,
                     'vPhoneCode' =>  $vPhoneCode,
                     'vMobileCode' =>  $vMobileCode,
            );
           $NumeicFildMsg = array(
                                'vZipcode'  =>$smarty->get_template_vars('MSG_VALID_ZIPCODE'),
                                 'vPhone'  =>$smarty->get_template_vars('MSG_VALID_PHONE_NO'),
                                 'vMobile' => $smarty->get_template_vars('MSG_VALID_MOBILE_NO'),
                                 'vPhoneCode'  =>$smarty->get_template_vars('MSG_VALID_PHONE_CODE'),
                                 'vMobileCode' => $smarty->get_template_vars('MSG_VALID_MOB_CODE')

          );

            $Numeric = $validation->isNum($NumeicFildvalue,$NumeicFildMsg,$typ='');
            */

            $vNum=$validation->isNum(array($Data['vPhoneCode'],$Data['vPhone'],$Data['vMobile'],$Data['vMobileCode']),array($smarty->get_template_vars('MSG_VALID_PHONE_CODE'),$smarty->get_template_vars('MSG_VALID_PHONE_NO'), $smarty->get_template_vars('MSG_VALID_MOBILE_NO'),$smarty->get_template_vars('MSG_VALID_MOB_CODE')),'empty');
          // prints($Numeric);exit;


         ### Password And Re-Password Equel  ###
             $vPassword['vPassword'] = $Data['vPassword'];
				 $cPassword = array();
             $cPassword['vPassword'] = $_POST['cPassword'];
             $vldmsg[] = $smarty->get_template_vars('MSG_PASS_NOT_EQUEL');
                              if( $vPassword['vPassword']!='' && $cPassword['cPassword'] != ''){
				 $Equel = $validation->isEqual($vPassword, $cPassword, $vldmsg);
                              }
        ### Password And Re-Password Equel  ###
        ### check user Duplicate ###
				$vlmsg[]= $smarty->get_template_vars('MSG_VALID_USER');
				if($Data['vUserName']!='') {
					$exchk = " AND iOrganizationID=".$_POST['Data']['iOrganizationID'];
					$DupUser = $validation->ChekDupUserName($id,'iUserID',PRJ_DB_PREFIX."_organization_user",$user,$vlmsg,$exchk);
				}
        // prints($DupUser);exit;



       ###check duplicate###
                $vlmsg[]=$smarty->get_template_vars('MSG_DUP_EMAIL');
                if($Data['vEmail'] !='' && $vmail !='er' ){
                $DupEmail = $validation->ChekDupEmail($id,'iUserID',PRJ_DB_PREFIX."_organization_user",$val,$vlmsg);
                }
                 if($DupEmail== 'er') {
                 $dupl == 'dpl';
             }

       ###End check duplicate###
           // prints($_SESSION);exit;
      ###  Redirect  ###
      if($resArr || $vmail=='er' || $DupUser=='er' || $Equel=='er' || $Numeric=='er' ) {
			unset($Data['vPassword']);
			unset($Data['cPassword']);
         $_SESSION['Data']=$Data;
		   header("Location:".$_SERVER['HTTP_REFERER']."");
			exit;
		}

	$Data	= array_merge($Data,array("dLastAccessDate" => $curr_date,'eStatus'=>'Need to Verify'));
	$Data['vPassword'] = $generalobj->encrypt($Data['vPassword']);
	$Data['dCreatedDate'] =calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
	//if(count($emlar)>0) {
		$dt['eStatus'] = $Data['eStatus'] = 'Need to Verify';
	/*} else {
		$dt = $Data;
		$dt['eStatus'] = $Data['eStatus'] = 'Active';
	}
   if($chkMulAdmin == '1'){
      $dt['eStatus'] = $Data['eStatus'] = 'Active';
   }else{
      $dt['eStatus'] = $Data['eStatus'] = $dt['eStatus'];
   }*/
   $Data['iCreatedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
	$Data['eCreatedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
     $usertype = $Data['eUserType'];
     //prints($Data);exit;
              $array1 = array($Data['vPhoneCode'], $Data['vPhone']);
                $Data['vPhone'] = implode("-", $array1);
               //echo $Data['vPhone'];exit;
                $array2 = array($Data['vMobileCode'], $Data['vMobile']);
                $Data['vMobile'] = implode("-", $array2);

	$orgUserObj->setAllVar($Data);
   $iUserID = $orgUserObj->insert();

	$Data['iUserID']=$iUserID;
	$Data['iVerifiedID']='';
	if($iUserID) {
		$userToVerifyObj->setAllVar($Data);
		$iVerifiedID = $userToVerifyObj->insert();
	}
	$_SESSION['from']='usr';
	// $_SERVER['fromid']=$iUserID;
	if($Data['eUserType']=='User') {
		$redirecturl = SITE_URL_DUM."edituserrights/$iUserID/";
	} else {
		$redirecturl = SITE_URL_DUM."organizationuserlist/";
	}
}

$iOrgID=$Data['iOrganizationID'];
$userName=$Data['vFirstName']." ".$Data['vLastName'];
$userEmail=$Data['vEmail'];
//unset($Data);

if($iUserID) {
     /*
     unset ($Data['dLastAccessDate']);
     $Data['iUserID']=$iUserID;
     $Data['iVerifiedID']='';
     $userToVerifyObj->setAllVar($Data);
     $iVerifiedID=$userToVerifyObj->insert(); */
	if(count($emailArr)>0)
	{
	  $link = SITE_URL_DUM."organizationuserview/".$iUserID;
     $secMan=$secManObj->select($sess_id);
     $secMan=$secMan[0];
	  if($view == "edit") {
		$body_arr = Array("#SMNAME#","#USERNAME#","#USEREMAIL#","#SECNAME#","#CNAME#","#COMPCODE#","#LINK#","#MODIFIED_BY#","#MAIL_FOOTER#","#SITE_URL#");
	  } else {
		$body_arr = Array("#SMNAME#","#USERNAME#","#USEREMAIL#","#SECNAME#","#CNAME#","#COMPCODE#","#LINK#","#ADDED_BY#","#MAIL_FOOTER#","#SITE_URL#");
	  }
     if($iVerifiedID) {
          unset($Data);
          $smname = $secMan['vFirstName'].' '.$secMan['vLastName'];
          $orgDetail=$orgObj->select($iOrgID);
          $compname=$orgDetail[0]['vCompanyName'];
          $compcode=$orgDetail[0]['vCompCode'];
          $emailTo='';
          //set the values of the body of email format
          $post_arr = Array('',$userName,$userEmail,$smname,$compname,$compcode,$link,$sess_user_name."($sess_usertype_short)",$MAIL_FOOTER,SITE_URL_DUM);
          $Data['iItemID']=$iVerifiedID;
			 //$Data['iItemID']=$curORGID;
          $Data['eSubject']='User';
          if($view == "edit") {
				$mailtype = 'Organization User Updated';
				$eType='Modified';
          }
          else {
               if($usertype == 'Admin')
				$mailtype = 'New Organization Admin Added';
               else
                    $mailtype = 'New Organization User Added';
				$eType='Create';

          }

		$where = "AND vType='$mailtype' AND eSection='Member'" ;
      $db_email = $emailObj->getDetails('*',$where);
//          if(trim($smname)!='')
//				$emailContent=$sendMail->Send($vMailSubject_en,"Member",$emailTo,$body_arr,$post_arr,'','','Yes');

		  //$body = Array("#SMNAME#","#CNAME#","#LINK#","#SITE_NAME#","#REGNO#","#ORGCODE#");
		  if($view == "edit") {
			$body = Array("#USERNAME#","#USEREMAIL#","#SECNAME#","#CNAME#","#COMPCODE#","#LINK#","#MODIFIED_BY#");
		  } else {
			$body = Array("#USERNAME#","#USEREMAIL#","#SECNAME#","#CNAME#","#COMPCODE#","#LINK#","#ADDED_BY#");
		  }
		  //$post = Array($sname,$cname,$link,$SITE_NAME,$regno,$code); // $cname
		  $post = Array($userName,$userEmail,$smname,$compname,$compcode,$link,$sess_user_name."($sess_usertype_short)");

		  $rplarr = Array("Hello #SMNAME#,","background-color: rgb(239, 239, 239);","Regards,","#MAIL_FOOTER#","#SITE_URL#");
		  $tbody_en = str_replace($rplarr," ",$db_email[0]['tBody_en']);
		  $emailContent_en = trim(str_replace($body,$post, $tbody_en));
		  $tbody_fr = str_replace($rplarr," ",$db_email[0]['tBody_fr']);
		  $emailContent_fr = trim(str_replace($body,$post, $tbody_fr));

          $Data['eType']=$eType;
          $Data['iOrganizationID'] = $iOrgID;
          $Data['vMailSubject_en']=$db_email[0]['vSub_en'];
          $Data['vMailSubject_fr']=$db_email[0]['vSub_fr'];
          $Data['tMailContent_en']=$emailContent_en;
          $Data['tMailContent_fr']=$emailContent_fr;
          $Data['iCreatedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
          $Data['eCreatedType'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
          $Data['dActionDate']= calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
          if(!isset($userActionObj)) {
				include_once(SITE_CLASS_APPLICATION.'user/class.UserActionVerification.php');
				$userActionObj = new UserActionVerification();
          }
          //prints($Data);exit;
          $userActionObj->setAllVar($Data);
          $userActionObj->insert();
     }

     //prints(count($emailArr));exit;
     for($i=0;$i<count($emailArr);$i++) {
          $smname = $emailArr[$i]['vFirstName'].' '.$emailArr[$i]['vLastName'];
          $emailTo=$emailArr[$i]['vEmail'];
          //set the values of the body of email format
          $post_arr = Array($smname,$userName,$userEmail,$secMan['vFirstName']." ".$secMan['vLast Name'],$compname,$compcode,$link,$sess_user_name."($sess_usertype_short)",$MAIL_FOOTER,SITE_URL_DUM);
          //send mail to the Security Manager and Organization's Admin User
          if(trim($smname)!='')
            $sendMail->Send($mailtype,"Member",$emailTo,$body_arr,$post_arr,'','');
     }
	}

	if($view == "edit") {
		$_SESSION['from']='usr';
		$var_msg = "rus";
	} elseif($view == "verify") {
		$var_msg = "rvs";
	} else {
		$_SESSION['from']='usr';
		$var_msg = "ras";
	}

      unset($Data);
      unset($_POST);

      if($dupl == 'dpl') 	//
     {
          $eml = $userEmail;
          $where = 'AND vType="Email Duplication" AND eSection = "Member"' ;
          $db_email = $emailObj->getDetails('*',$where);
          $link = SITE_URL_DUM."organizationuserview/".$iUserID;
          $body = Array("#REC#","#EMAIL#","#LINK#");
          $rec = $smarty->get_template_vars('LBL_USER');
          $post = Array($rec,$eml,$link);

          $rplarr = Array("Hello #NAME#,","background-color: rgb(239, 239, 239);","Regards,","#MAIL_FOOTER#","#SITE_URL#");
          $tbody_en = str_replace($rplarr," ",$db_email[0]['tBody_en']);
          $emailContent_en = trim(str_replace($body,$post, $tbody_en));
          $tbody_fr = str_replace($rplarr," ",$db_email[0]['tBody_fr']);
          $emailContent_fr = trim(str_replace($body,$post, $tbody_fr));
          // prints($emailContent_en); exit;

          $Data['iItemID']=$iUserID;
          $Data['iOrganizationID']=$iOrganizationID;
          $Data['eSubject']='User';
          $Data['eType']='Email Duplication';
          $Data['vMailSubject_en'] = $db_email[0]['vSub_en'];
          $Data['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
          $Data['tMailContent_en'] = $emailContent_en;
          $Data['tMailContent_fr'] = $emailContent_fr;
          $Data['iCreatedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
          $Data['eCreatedType'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
          $Data['dActionDate']= calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
          // prints($Data); exit;
         $userActionObj->setAllVar($Data);
         $userActionObj->insert();

         for($i=0;$i<count($emailArr);$i++) {
             $smname = $emailArr[$i]['vFirstName'].' '.$emailArr[$i]['vLastName'];
             $email = $emailArr[$i]['vEmail'];

             //set the values of the body of email format
             $body_arr = Array("#NAME#","#REC#","#EMAIL#","#LINK#","#MAIL_FOOTER#","#SITE_URL#");
             $post_arr = Array($smname,$rec,$eml,$link,$MAIL_FOOTER,SITE_URL_DUM);

             //send mail to the Admin
                 $sendMail->Send("Email Duplication","Member",$email,$body_arr,$post_arr);
         }
     }
     // dpr email for duplication of email in rec

   $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']=$var_msg;
	if($redirecturl != '') {
		header("Location:".$redirecturl.$var_msg);
	} else {
		header("Location:".SITE_URL_DUM."organizationuserlist/".$var_msg);
	}
} else {
     $var_msg="raerr.";
     $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']=$var_msg;
     header("Location:".SITE_URL_DUM."createorganizationuser/".$var_msg);
}
exit;
?>