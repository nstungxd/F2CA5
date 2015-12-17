<?php
if(isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG'])) {
   $msg = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG'];
} else {
   $msg = GetVar('msg');
}
unset ($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']);
$currency = $generalobj->getCurrency();

if(!isset($countryObj)) {
   include_once(SITE_CLASS_APPLICATION."class.Country.php");
   $countryObj =	new Country();
}
if(!isset($stateObj)) {
   include_once(SITE_CLASS_APPLICATION."class.State.php");
   $stateObj =	new State();
}
if(!isset($cntstObj)) {
   include_once(SITE_CLASS_GEN."class.countrystate.php");
   $cntstObj =	new CountryState();
}
if(!isset($bnkObj)) {
   include_once(SITE_CLASS_APPLICATION."class.BankMaster.php");
   $bnkObj = new BankMaster();
}
if(!isset($secManObj)) {
	include_once(SITE_CLASS_APPLICATION.'class.SecurityManager.php');
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
	include(SITE_CLASS_GEN."class.sendmail.php");
	$sendMail = new SendPHPMail();
}

if(!isset($orgObj)) {
	require_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
	$orgObj = new Organization();
}
if(!isset($orgvrfObj)) {
   include_once(SITE_CLASS_APPLICATION."organization/class.Organization_Toverify.php");
   $orgvrfObj =	new Organization_Toverify();
}
if(!isset($orgUsrObj)) {
	require_once(SITE_CLASS_APPLICATION."user/class.OrganizationUser.php");
	$orgUsrObj = new OrganizationUser();
}
if(!isset($userToVerifyObj)) {
	include_once(SITE_CLASS_APPLICATION.'user/class.OrganizationUserToverify.php');
	$userToVerifyObj = new OrganizationUserToverify();
}
if(!isset($stMstrObj)) {
	include_once(SITE_CLASS_APPLICATION."class.StatusMaster.php");
	$stMstrObj =	new StatusMaster();
}
if(!isset($orgprefObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationPreference.php");
	$orgprefObj =	new OrganizationPreference();
}
if(!isset($orgPrefVrfObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationPreferenceToverify.php");
	$orgPrefVrfObj =	new OrganizationPreferenceToverify();
}

if(isset($_POST) && is_array($_POST) && count($_POST)>0) {
	$ere = '';
	//
	### SERVER SIDE VALIDATION ####
	include(SITE_CLASS_GEN."class.validation.php");
	$validation = new Validation();
		$RequiredFiledArr = array(
									'vUserName'          => $smarty->get_template_vars('LBL_ENTER').' '.$smarty->get_template_vars('LBL_USER_NAME'),
									'vPassword' 	  		=> $smarty->get_template_vars('LBL_ENTER').' '.$smarty->get_template_vars('LBL_PASSWORD'),
									'vFirstName'         => $smarty->get_template_vars('LBL_ENTER').' '.$smarty->get_template_vars('LBL_FIRST_NAME'),
									'vLastName'          => $smarty->get_template_vars('LBL_ENTER').' '.$smarty->get_template_vars('LBL_LAST_NAME'),
									'vCompanyName'       => $smarty->get_template_vars('LBL_ENTER').' '.$smarty->get_template_vars('LBL_ORGANIZATION'),
									'vCompCode'          => $smarty->get_template_vars('LBL_ENTER').' '.$smarty->get_template_vars('LBL_COMP_CODE'),
									'vCompanyRegNo'      => $smarty->get_template_vars('LBL_ENTER').' '.$smarty->get_template_vars('LBL_COMP_REG_NO'),
									'eOrganizationType'  => $smarty->get_template_vars('LBL_ENTER').' '.$smarty->get_template_vars('LBL_ORGANIZATION'),
									'vEmail'             => $smarty->get_template_vars('LBL_ENTER').' '.$smarty->get_template_vars('LBL_COMPANY').' '.$smarty->get_template_vars('LBL_EMAIL'),
									'vpEmail'            => $smarty->get_template_vars('LBL_ENTER').' '.$smarty->get_template_vars('LBL_PERSONAL').' '.$smarty->get_template_vars('LBL_EMAIL'),
									'vPhone'             => $smarty->get_template_vars('LBL_ENTER_PHONE_NO'),
									'vCity'              => $smarty->get_template_vars('LBL_ENTER').' '.$smarty->get_template_vars('LBL_CITY'),
									'vCountry'           => $smarty->get_template_vars('LBL_SELECT_COUNTRY'),
									'vState'             => $smarty->get_template_vars('LBL_SELECT_STATE'),
									'vZipcode'           => $smarty->get_template_vars('LBL_SELECT_STATE'),
									'vVatId'             => $smarty->get_template_vars('LBL_ENTER').' '.$smarty->get_template_vars('LBL_ZIP_CODE'),
									'vAddressLine1'      => $smarty->get_template_vars('LBL_ENTER').' '.$smarty->get_template_vars('LBL_COMPANY').' '.$smarty->get_template_vars('LBL_ADDR_LINE')
								);
		$resArr = $validation->isEmpty($RequiredFiledArr);
		$tempData = $_POST;
		$vNum=$validation->isNum(array($tempData['vPhone'],$tempData['vZipcode']),array('Valid Phone Number','Valid ZipCode'),'empty');

		###check Valid Email###
		// prints($tempData['vEmail']);exit;
		if($tempData['vEmail'] != '') {
			$vmail= $validation->isEmail(array($tempData['vEmail']),array($smarty->get_template_vars('MSG_VALID_EMAIL')));
		}

		###check duplicate Email###
		if($tempData['vEmail']!='') {
			$vlmsg[] = $smarty->get_template_vars('MSG_DUP_EMAIL');
			$DupEmail = $validation->ChekDupEmail('','iOrganizationID',PRJ_DB_PREFIX."_organization_master",$tempData['vEmail'],$vlmsg);
		}
		if($tempData['vpEmail']!='') {
			$vlmsg[] = $smarty->get_template_vars('MSG_DUP_EMAIL');
			$pDupEmail = $validation->ChekDupEmail('','iUserID',PRJ_DB_PREFIX."_organization_user",$tempData['vpEmail'],$vlmsg);
		}
		###End check duplicate Email###
		###check duplicate Username###
		$vlmsg[]= $smarty->get_template_vars('MSG_VALID_USER');
		if($tempData['vUserName']!='') {
			$DupUser = $validation->ChekDupUserName("",'iUserID',PRJ_DB_PREFIX."_organization_user",$tempData['vUserName'],$vlmsg,"");
		}
		###End check duplicate Username###

		###check alphaNumeric Company Code###
		$vlmsg=$smarty->get_template_vars('MSG_ONLY_ALPHA_NUMERIC');
		$alphanum = $msga = $validation->isAlphaNum($tempData['vCompCode'],$vlmsg,'empty');
		###End check duplicate Email###

		if($resArr || $vNum || $vmail=='er' || $alphanum=='er') {
			$ere = 'er';
			//$_SESSION['Data'] = $Data;
			$vdata = $_POST;
			// header("Location:".$_SERVER['HTTP_REFERER']."");
			// exit;
		}
	### ENDS HERE ###
	//
	if($ere != 'er') {
		// $activationcode = md5($_POST['vEmail'].time());
		$odata['vCompanyName'] = $_POST['vCompanyName'];
		$odata['eOrganizationType'] = $_POST['eOrganizationType'];
		$odata['vCompCode'] = $_POST['vCompCode'];
		$odata['vCompanyRegNo'] = $_POST['vCompanyRegNo'];
		$odata['vEmail'] = $_POST['vEmail'];
		$odata['vCity'] = $_POST['vCity'];
		$odata['vState'] = $_POST['vState'];
		$odata['vCountry'] = $_POST['vCountry'];
		$odata['vZipcode'] = $_POST['vZipcode'];
		$odata['vPhone'] = $_POST['vPhoneCode'].'-'.$_POST['vPhone'];
		$odata['vAddressLine1'] = $_POST['vAddressLine1'];
		$odata['vAddressLine2'] = $_POST['vAddressLine2'];
		$odata['vVatId'] = $_POST['vVatId'];
		$odata['iBankId'] = $_POST['iBankId'];
		$odata['vBankCode'] = $_POST['vBankCode'];
		$odata['vBranchName'] = $_POST['vBranchName'];
		$odata['vBranchCode'] = $_POST['vBranchCode'];
		$odata['vAccount1Number'] = $_POST['vAccount1Number'];
		$odata['vAccount1Title'] = $_POST['vAccount1Title'];
		$odata['vAccount1Currency'] = $_POST['vAccount1Currency'];
		$odata['eSelfReg'] = 'Yes';
		// $odata['vActivationCode'] = $activationcode;
		$odata['dCreatedDate']  = $odata['dModifiedDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
		$odata['eStatus'] = 'Need to Verify';

		$udata['vFirstName'] = $_POST['vFirstName'];
		$udata['vLastName'] = $_POST['vLastName'];
		$udata['vUserName'] = $_POST['vUserName'];
		$udata['vPassword'] = $generalobj->encrypt($_POST['vPassword']);
		$udata['eEmailNotification'] = $_POST['eEmailNotification'];
		$udata['vDefaltLan'] = $_POST['vDefaltLan'];
		$udata['iSecretQuestion1ID'] = $_POST['iSecretQuestion1ID'];
		$udata['iSecretQuestion2ID'] = $_POST['iSecretQuestion2ID'];
		$udata['vAnswer'] = $_POST['vAnswer'];
		$udata['vAnwser'] = $_POST['vAnwser'];
		$udata['vEmail'] = $_POST['vpEmail'];
		$udata['eUserType'] = $_POST['eUserType'];
		$udata['vAddressLine1'] = $_POST['vAddressLine1'];
		$udata['vAddressLine2'] = $_POST['vAddressLine2'];
		$udata['vAddressLine3'] = $_POST['vAddressLine3'];
		$udata['vCity'] = $_POST['vCity'];
		$udata['vCountry'] = $_POST['vCountry'];
		$udata['vState'] = $_POST['vState'];
		$udata['vZipcode'] = $_POST['vZipcode'];
		$udata['vPhone'] = $odata['vPhone'];
		$udata['eUserType'] = 'Admin';
		$udata['eSelfReg'] = 'Yes';
		// $udata['vActivationCode'] = $activationcode;
		$udata['dCreatedDate']  = $udata['dModifiedDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
		$udata['eStatus'] = 'Need to Verify';
		// pr($_POST);
		$odata['vOrganizationCode'] = $orgObj->getUniqueCode($odata['eOrganizationType']);
		// pr($odata);
		$oid = $res = $orgObj->insert($odata);
		if($oid > 0) {
			$odata['iOrganizationID'] = $oid;
			$res = $orgvrfObj->insert($odata);
			//
			$udata['iOrganizationID'] = $oid;
			$uid = $orgUsrObj->insert($udata);
			if($uid > 0) {
				$udata['iUserID'] = $uid;
				$iVerifiedID = $userToVerifyObj->insert($udata);
			}
			// echo $uid; exit;
			// org default preferences
				//------------------------DEFALT VALUES OF PURCHASE ORDER -----------------------------------------//
				if($odata['eOrganizationType'] != 'Supplier') {
					 $where = ' AND eFor = "PO"  AND eType = "Default" AND eStatus = "Active"';
					 $postatus = $stMstrObj->getDetails('*',$where);
					 foreach($postatus as $k=>$v) {
						$poarr[] = $v['iStatusID'];
					 }
					 $postatus = @implode(',',$poarr);
				}
				//------------------------DEFALT VALUES OF PURCHASE ORDER -----------------------------------------//
				if($odata['eOrganizationType'] != 'Buyer') {
					 $where = ' AND eFor = "Invoice"  AND eType = "Default" AND eStatus = "Active"';
					 $invstatus = $stMstrObj->getDetails('*',$where);
					 foreach($invstatus as $k=>$v) {
						$invarr[] = $v['iStatusID'];
					 }
					 $invstatus = @implode(',',$invarr);
				}
				//echo $postatus.'===';//exit;
				//echo $invstatus;exit;
				$stsdtls = $stMstrObj->getDetails('*'," AND eFor='PO' AND vStatus_en='Issued' ");
				$poisusts = $stsdtls[0]['iStatusID'];
				$stsdtls = $stMstrObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Issued' ");
				$invisusts = $stsdtls[0]['iStatusID'];
				$stsdtls = $stMstrObj->getDetails('*'," AND eFor='PO' AND vStatus_en='Accepted' ");
				$poacptsts = $stsdtls[0]['iStatusID'];
				$stsdtls = $stMstrObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Accepted' ");
				$invacptsts = $stsdtls[0]['iStatusID'];
				$stsdtls = $stMstrObj->getDetails('*'," AND eFor='PO' AND vStatus_en='Issue' ");
				$poists = $stsdtls[0]['iStatusID'];
				$stsdtls = $stMstrObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Issue' ");
				$invists = $stsdtls[0]['iStatusID'];
				$prjdtls = $stMstrObj->getDetails('*'," AND eFor='PO' AND vStatus_en='Rejected' ");
				$prjsts = $prjdtls[0]['iStatusID'];
				$irjdtls = $stMstrObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Rejected' ");
				$irjsts = $irjdtls[0]['iStatusID'];
				//==================================================================================================//

				$vOrderStatusLevel = array();
				$vInvoiceStatusLevel = array();
				$vOrderAcceptanceLevel = array();
				$vInvoiceAcceptanceLevel = array();
				if($odata['eOrganizationType'] != 'Buyer') {
					$vInvoiceStatusLevel[] = $invists;
					$vInvoiceStatusLevel[] = $invisusts;
					$vInvoiceStatusLevel[] = $invacptsts;
					// $vOrderAcceptanceLevel[] = $poisusts;
					$vOrderAcceptanceLevel[] = $poacptsts;
				}
				if($odata['eOrganizationType'] != 'Supplier') {
					$vOrderStatusLevel[] = $poists;
					$vOrderStatusLevel[] = $poisusts;
					$vOrderStatusLevel[] = $poacptsts;
					// $vInvoiceAcceptanceLevel[] = $invisusts;
					$vInvoiceAcceptanceLevel[] = $invacptsts;
				}
				$vInvoiceStatusLevel[] = $irjsts;
				$vInvoiceAcceptanceLevel[] = $irjsts;
				$vOrderStatusLevel[] = $prjsts;
				$vOrderAcceptanceLevel[] = $prjsts;

				$pvdtls =  $stMstrObj->getDetails('*'," AND eFor='PO' AND vStatus_en='Verify' ");
				$pvdtls = $pvdtls[0]['iStatusID'];
				$ivdtls =  $stMstrObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Verify' ");
				$ivdtls = $ivdtls[0]['iStatusID'];
				if($oprfdt['eReqVerificationInv']=='Yes') {
					$vInvoiceStatusLevel[] = $ivdtls;
				}
				if($oprfdt['eReqVerifyInvAcpt']=='Yes') {
					$vInvoiceAcceptanceLevel[] = $ivdtls;
				}
				if($oprfdt['eReqVerificationPo']=='Yes') {
					$vOrderStatusLevel[] = $pvdtls;
				}
				if($oprfdt['eReqVerifyPoAcpt']=='Yes') {
					$vOrderAcceptanceLevel[] = $pvdtls;
				}
				sort($vOrderStatusLevel);
				sort($vInvoiceStatusLevel);
				sort($vInvoiceAcceptanceLevel);
				sort($vOrderAcceptanceLevel);
				if(is_array($vOrderStatusLevel)) {
					$oprfdt['vOrderStatusLevel'] = @ implode(',',$vOrderStatusLevel);
				} else {
					$oprfdt['vOrderStatusLevel'] = '';
				}
				if(is_array($vInvoiceStatusLevel)) {
					$oprfdt['vInvoiceStatusLevel'] = @ implode(',',$vInvoiceStatusLevel);
				} else {
					$oprfdt['vInvoiceStatusLevel'] = '';
				}
				if(is_array($vInvoiceAcceptanceLevel)) {
					 $oprfdt['vInvoiceAcceptanceLevel'] = @ implode(',',$vInvoiceAcceptanceLevel);
				} else {
					 $oprfdt['vInvoiceAcceptanceLevel'] = '';
				}
				if(is_array($vOrderAcceptanceLevel)) {
					 $oprfdt['vOrderAcceptanceLevel'] = @ implode(',',$vOrderAcceptanceLevel);
				} else {
					 $oprfdt['vOrderAcceptanceLevel'] = '';
				}
				// prints($vOrderAcceptanceLevel); exit;
				if($postatus != '') {
					  $oprfdt['vOrderStatusLevel'] = $oprfdt['vOrderStatusLevel'].','.$postatus;
					  $oprfdt['vOrderAcceptanceLevel'] = $oprfdt['vOrderAcceptanceLevel'].','.$postatus;
					  $parr = @ explode(',',$oprfdt['vOrderStatusLevel']);
					  $purchaseorder = array_unique($parr);
					  sort($purchaseorder);
					  $oprfdt['vOrderStatusLevel'] = @ implode(',',$purchaseorder);
					  $paArr = @ explode(',',$oprfdt['vOrderAcceptanceLevel']);
					  $purchaseordera = array_unique($paArr);
					  sort($purchaseordera);
					  $oprfdt['vOrderAcceptanceLevel'] = @ implode(',',$purchaseordera);
				}

				if($invstatus != '') {
					  $oprfdt['vInvoiceStatusLevel'] = $oprfdt['vInvoiceStatusLevel'].','.$invstatus;
					  $oprfdt['vInvoiceAcceptanceLevel'] = $oprfdt['vInvoiceAcceptanceLevel'].','.$invstatus;
					  $iarr = @explode(',',$oprfdt['vInvoiceStatusLevel']);
					  $invoice = array_unique($iarr);
					  sort($invoice);
					  $oprfdt['vInvoiceStatusLevel'] = @implode(',',$invoice);
					  $iaArr = @explode(',',$oprfdt['vInvoiceAcceptanceLevel']);
					  $invoicea = array_unique($iaArr);
					  sort($invoicea);
					  $oprfdt['vInvoiceAcceptanceLevel'] = @implode(',',$invoicea);
				}
				$oprfdt['iOrganizationID'] = $oid;
				$oprfdt['eStatus'] = 'Need to Verify';
				//
				$oprfdt['iCreatedBy'] = $uid;
				$oprfdt['eCreatedBy'] = 'OA';
				$oprfdt['eReqVerificationPo'] = 'No';
				$oprfdt['eReqVerificationInv'] = 'No';
				$oprfdt['eReqVerifyPoAcpt'] = 'No';
				$oprfdt['eReqVerifyInvAcpt'] = 'No';
				$oprfdt['eSecureExportPO'] = 'No';
				$oprfdt['eSecureImportInvoice'] = 'No';
				$oprfdt['eSecureImportPO'] = 'No';
				$oprfdt['eSecureExportInvoice'] = 'No';

				$oprfdt['eRFQ2VerifyReq'] = 'No';
				$oprfdt['eRFQ2AwardVerifyReq'] = 'No';
				$oprfdt['eRFQ2BidVerifyReq'] = 'No';
				$oprfdt['eRFQ2AwardAcceptVerifyReq'] = 'No';

				$award_accept_status = $stMstrObj->getDetails('iStatusId'," AND vForAuction Like '%RFQ2 Award Acceptance%' AND (eType='Default' OR vStatus_en IN ('Create','Verify','Accepted')) ");
				$awardacceptstslvl = array();
				if(is_array($award_accept_status) && count($award_accept_status)>0) {
					for($l=0;$l<count($award_accept_status);$l++) {
						$awardacceptstslvl[] = $award_accept_status[$l]['iStatusId'];
					}
				}
				sort($awardacceptstslvl);
				$awardacceptstslvl = @ implode(',',$awardacceptstslvl);
				$oprfdt['vRFQ2AwardAcceptLevel'] = $awardacceptstslvl;
				//
				$award_status = $stMstrObj->getDetails('iStatusId'," AND vForAuction Like '%RFQ2 Award,%' AND (eType='Default' OR vStatus_en IN ('Create','Verify')) ");
				$awardstslvl = array();
				if(is_array($award_status) && count($award_status)>0) {
					for($l=0;$l<count($award_status);$l++) {
						$awardstslvl[] = $award_status[$l]['iStatusId'];
					}
				}
				sort($awardstslvl);
				$awardstslvl = @implode(',',$awardstslvl);
				$oprfdt['vRFQ2AwardStatusLevel'] = $awardstslvl;
				// prints($oprfdt); exit;
				$oprfdt['vCurrency'] = $odata['vAccount1Currency'];
				$oprfdt['dCreatedDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
				$orgprefObj->setAllVar($oprfdt);
				$drs = $orgprefObj->insert();
				if($drs > 0) {
					$oprfdt['iAdditionalInfoID'] = $drs;
					$orgPrefVrfObj->setAllVar($oprfdt);
					$vds = $orgPrefVrfObj->insert($oprfdt);
				}
		}
		// pr($udata); exit;
		//
	}
	//

	$swh = " AND iSMID!='$sess_id' AND eStatus='Active' AND eEmailNotification='Yes' ";
	$arr = $secManObj->getDetails('*',$swh);
	/* $semail = array();  */
	//
	if($oid && count($arr)>0) {
		$cname = $_POST['vCompanyName'];
		$regno = $_POST['vCompanyRegNo'];
		$compcode = $_POST['vCompCode'];
		$code = $odata['vOrganizationCode'];
		$where = 'AND vType="New Organization Added" AND eSection = "Member"' ;
		$db_email = $emailObj->getDetails('*',$where);
		$link = SITE_URL_DUM."organizationview/".$oid;
		$body = Array("#SMNAME#","#CNAME#","#LINK#","#ADDED_BY#","#REGNO#","#ORGCODE#","#COMPCODE#");
		$post = Array('',$cname,$link,$smarty->get_template_vars('LBL_SELF_REGISTRATION'),$regno,$code,$compcode);

		$rplarr = Array("Hello #SMNAME#,","background-color: rgb(239, 239, 239);","Regards,","#MAIL_FOOTER#","#SITE_URL#");
		$tbody_en = str_replace($rplarr," ",$db_email[0]['tBody_en']);
		$emailContent_en = trim(str_replace($body,$post, $tbody_en));
		$tbody_fr = str_replace($rplarr," ",$db_email[0]['tBody_fr']);
		$emailContent_fr = trim(str_replace($body,$post, $tbody_fr));
		//prints($emailContent);exit;
		$Data = array();
		$Data['iItemID'] = $res;
		$Data['iOrganizationID'] = $oid;
		$Data['eSubject'] = 'OA';
		$Data['eType']='Create';
		$Data['vMailSubject_en'] = $db_email[0]['vSub_en'];
		$Data['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
		$Data['tMailContent_en'] = $emailContent_en;
		$Data['tMailContent_fr'] = $emailContent_fr;
		$Data['iCreatedBy'] = (isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']))? $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'] : '0';
		$Data['eCreatedType'] = (isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT']))? $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'] : '0';
		$Data['dActionDate']=calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');

		$userActionObj->setAllVar($Data);
		$userActionObj->insert();

		for($i=0;$i<count($arr);$i++) {
			  $smname = $arr[$i]['vFirstName'].' '.$arr[$i]['vLastName'];
			  $email = $arr[$i]['vEmail'];
			  //set the values of the body of email format
			  $body_arr = Array("#SMNAME#","#CNAME#","#LINK#","#ADDED_BY#","#REGNO#","#ORGCODE#","#COMPCODE#","#MAIL_FOOTER#","#SITE_URL#");
			  $post_arr = Array($smname,$cname,$link,$smarty->get_template_vars('LBL_SELF_REGISTRATION'),$regno,$code,$compcode,$MAIL_FOOTER,SITE_URL_DUM);
			  //send mail to the Admin
			  $sendMail->Send("New Organization Added","Member",$email,$body_arr,$post_arr);
		}
	}
	//
	if($uid && count($arr)>0) {
		$userName = $_POST['vUserName'];
		$userEmail = $_POST['vpEmail'];
		$link = SITE_URL_DUM."organizationuserview/".$uid;
		$body_arr = Array("#SMNAME#","#USERNAME#","#USEREMAIL#","#CNAME#","#COMPCODE#","#LINK#","#ADDED_BY#","#MAIL_FOOTER#","#SITE_URL#");

		$orgDetail = $orgObj->select($oid);
		$compname = $orgDetail[0]['vCompanyName'];
		$compcode = $orgDetail[0]['vCompCode'];
		$emailTo='';
		//set the values of the body of email format
		$post_arr = Array('',$userName,$userEmail,$smname,$compname,$compcode,$link,$smarty->get_template_vars('LBL_SELF_REGISTRATION'),$MAIL_FOOTER,SITE_URL_DUM);

		$where = " AND vType='New Organization Admin Added' AND eSection='Member' ";
      $db_email = $emailObj->getDetails('*',$where);
		$body = Array("#USERNAME#","#USEREMAIL#","#CNAME#","#COMPCODE#","#LINK#","#ADDED_BY#");
		$post = Array($userName,$userEmail,$compname,$compcode,$link,$smarty->get_template_vars('LBL_SELF_REGISTRATION'));

		$rplarr = Array("Hello #SMNAME#,","background-color: rgb(239, 239, 239);","Regards,","#MAIL_FOOTER#","#SITE_URL#");
		$tbody_en = str_replace($rplarr," ",$db_email[0]['tBody_en']);
		$emailContent_en = trim(str_replace($body,$post, $tbody_en));
		$tbody_fr = str_replace($rplarr," ",$db_email[0]['tBody_fr']);
		$emailContent_fr = trim(str_replace($body,$post, $tbody_fr));
		$Data = array();
		$Data['iItemID'] = $iVerifiedID;
		$Data['eSubject'] = 'User';
		$Data['eType'] = 'Create';
		$Data['iOrganizationID'] = $iOrgID;
		$Data['vMailSubject_en']=$db_email[0]['vSub_en'];
		$Data['vMailSubject_fr']=$db_email[0]['vSub_fr'];
		$Data['tMailContent_en']=$emailContent_en;
		$Data['tMailContent_fr']=$emailContent_fr;
		$Data['iCreatedBy'] = (isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']))? $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'] : '0';
		$Data['eCreatedType'] = (isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT']))? $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'] : '0';
		$Data['dActionDate']= calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
		if(!isset($userActionObj)) {
		  include_once(SITE_CLASS_APPLICATION.'user/class.UserActionVerification.php');
		  $userActionObj = new UserActionVerification();
		}
		//prints($Data);exit;
		$userActionObj->setAllVar($Data);
		$userActionObj->insert();

		for($i=0;$i<count($arr);$i++) {
			$smname = $arr[$i]['vFirstName'].' '.$arr[$i]['vLastName'];
			$emailTo=$arr[$i]['vEmail'];
			//set the values of the body of email format
			$post_arr = Array($smname,$userName,$userEmail,$compname,$compcode,$link,$smarty->get_template_vars('LBL_SELF_REGISTRATION'),$MAIL_FOOTER,SITE_URL_DUM);
			//send mail to the Security Manager and Organization's Admin User
			if(trim($smname)!='') {
				$sendMail->Send("New Organization Admin Added","Member",$emailTo,$body_arr,$post_arr,'','');
			}
		}
	}
	//
	// dpr email for duplication of email in rec
	if($DupEmail == 'er' && $ere != 'er')
	{
		$eml = $_POST['vEmail'];
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
		$Data['iCreatedBy'] = (isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']))? $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'] : '0';
		$Data['eCreatedType'] = (isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT']))? $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'] : '0';
		$Data['dActionDate']=calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
		// prints($Data); exit;
	  $userActionObj->setAllVar($Data);
	  $userActionObj->insert();

	  for($i=0;$i<count($arr);$i++) {
			$smname = $arr[$i]['vFirstName'].' '.$arr[$i]['vLastName'];
			$email = $arr[$i]['vEmail'];
			//set the values of the body of email format
			$body_arr = Array("#NAME#","#REC#","#EMAIL#","#LINK#","#MAIL_FOOTER#","#SITE_URL#");
			$post_arr = Array($smname,$rec,$eml,$link,$MAIL_FOOTER,SITE_URL_DUM);
			//send mail to the Admin
			$sendMail->Send("Email Duplication","Member",$email,$body_arr,$post_arr);
		}
	}
	//
	if($pDupEmail == 'er' && $ere != 'er')
	{
		$eml = $_POST['vpEmail'];
		$where = 'AND vType="Email Duplication" AND eSection = "Member"' ;
		$db_email = $emailObj->getDetails('*',$where);
		$link = SITE_URL_DUM."organizationview/".$iOrganizationID;
		$body = Array("#REC#","#EMAIL#","#LINK#");
		$rec = $smarty->get_template_vars('LBL_ORG_USER');
		$post = Array($rec,$eml,$link);

		$rplarr = Array("Hello #NAME#,","background-color: rgb(239, 239, 239);","Regards,","#MAIL_FOOTER#","#SITE_URL#");
		$tbody_en = str_replace($rplarr," ",$db_email[0]['tBody_en']);
		$emailContent_en = trim(str_replace($body,$post, $tbody_en));
		$tbody_fr = str_replace($rplarr," ",$db_email[0]['tBody_fr']);
		$emailContent_fr = trim(str_replace($body,$post, $tbody_fr));
		// prints($emailContent_en); exit;

		$Data['iItemID'] = $res;
		$Data['iOrganizationID'] = $oid;
		$Data['eSubject'] = 'OA';
		$Data['eType'] = 'Email Duplication';
		$Data['vMailSubject_en'] = $db_email[0]['vSub_en'];
		$Data['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
		$Data['tMailContent_en'] = $emailContent_en;
		$Data['tMailContent_fr'] = $emailContent_fr;
		$Data['iCreatedBy'] = (isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID']))? $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'] : '0';
		$Data['eCreatedType'] = (isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT']))? $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'] : '0';
		$Data['dActionDate']=calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
		// prints($Data); exit;
	   $userActionObj->setAllVar($Data);
	   $userActionObj->insert();

	   for($i=0;$i<count($arr);$i++) {
			$smname = $arr[$i]['vFirstName'].' '.$arr[$i]['vLastName'];
			$email = $arr[$i]['vEmail'];
			//set the values of the body of email format
			$body_arr = Array("#NAME#","#REC#","#EMAIL#","#LINK#","#MAIL_FOOTER#","#SITE_URL#");
			$post_arr = Array($smname,$rec,$eml,$link,$MAIL_FOOTER,SITE_URL_DUM);
			//send mail to the Admin
			$sendMail->Send("Email Duplication","Member",$email,$body_arr,$post_arr);
	   }
	}
	//
	// activation mail
	$bodyarray = array("#SITE_NAME#","#NAME#","#MAIL_FOOTER#","#SITE_URL#");
	//print_r($_POST);
	$name = $_POST['vUserName'];
	$email = $_POST['vEmail'];
	// $link = SITE_URL_DUM."registrationactivation".'/'.$activationcode;
	$postarray = array($SITE_NAME,$name,$MAIL_FOOTER,SITE_URL_DUM);
	$rs = $sendMail->Send('Registration Notification','Member',$email,$bodyarray,$postarray);
	//
	if($oid>0 && $uid>0) {
		header("Location: ".SITE_URL_DUM.'home/oregs');
		exit;
	}
}

//Get State Array
$state =	$cntstObj->getgeneralArr(PRJ_DB_PREFIX."_state_master"," AND eStatus='Active'","vStateCode","vState","vCountryCode","vStateCode,vState,vCountryCode");
$stateArr = $state[0];
//prints($stateArr);exit;
$db_country = $countryObj->getCountryDetail("iCountryId,vCountry,vCountryCode,iCountryISD,iCurrencyID","AND eStatus = 'Active'");
//prints($db_country);exit;
$db_state = $stateObj->getStateDetail("iStateId, vStateCode, vState","AND eStatus = 'Active'","vState");
$arrorgtype = (isset($vdata['eOrganizationType']))? $vdata['eOrganizationType'] : '';
if(isset($ENABLE_AUCTION) && $ENABLE_AUCTION=='Yes') {
   $OrgType = $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_organization_master", "eOrganizationType","eOrganizationType", "eOrganizationType","", "".$arrorgtype."","class='required'","Select Organization Type","---Select Organization Type----");
} else {
   $OrgType = $gdbobj->getEnumSelect("".PRJ_DB_PREFIX."_organization_master", "eOrganizationType","eOrganizationType", "eOrganizationType","", "".$arrorgtype."","class='required'","Select Organization Type","---Select Organization Type----",'Buyer2');
}
$bnk_dtls = $bnkObj->getDetails('*', " AND eStatus='Active'");
$sql = "Select vLanguage, vLanguageCode from ".PRJ_DB_PREFIX."_language Order By vLanguage";
$dlang = $dbobj->MySQLSelect($sql);

$secQueArr1 = array(
	"ID"					=>	"iSecretQuestion1ID",
	"Name" 				=>	"iSecretQuestion1ID",
	"Type"				=>	"Query",
	"tableName" 		=>	PRJ_DB_PREFIX."_sec_question",
	"fieldId" 			=>	"iQuestionId",
	"fieldName"			=>	"vQuestion_".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG'],
	"extVal"				=>	'',
	"selectedVal" 		=>	(isset($vdata['iSecretQuestion1ID']))? $vdata['iSecretQuestion1ID'] : '',
	"width"  			=>	'200px',
	"height"  			=>	'',
	"onchange" 			=>	'',
	"selectText" 		=>	"--- ".$smarty->get_template_vars('LBL_SEC_QUESTION')." 1 ---",
	"where" 				=>	"eStatus ='Active' ",
	"multiple_select" =>	"",
	"orderby" 			=>	'',
	"extra"				=>	"",
	"validationmsg"	=> "title='".$smarty->get_template_vars('LBL_ENTER').' '.$smarty->get_template_vars('LBL_SEC_QUESTION')." 1'",
	"class" 				=> "required"
);
$secQueArr2 = array(
	"ID"				=>	"iSecretQuestion2ID",
	"Name" 				=>	"Data[iSecretQuestion2ID]",
	"Type"				=>	"Query",
	"tableName" 		=>	PRJ_DB_PREFIX."_sec_question",
	"fieldId" 			=>	"iQuestionId",
	"fieldName"			=>	"vQuestion_".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG'],
	"extVal"			=>	'',
	"selectedVal" 		=>	isset($userData['iSecretQuestion2ID']) ? $userData['iSecretQuestion2ID']: '',
	"width"  			=>	'200px',
	"height"  			=>	'',
	"onchange" 			=>	'',
	"selectText" 		=>	"--- ".$smarty->get_template_vars('LBL_SEC_QUESTION')." 2 ---",
	"where" 			=>	"eStatus ='Active' ",
	"multiple_select" 	=>	"",
	"orderby" 			=>	'',
	"extra"			=>	"",
	"validationmsg"	=> "title='".$smarty->get_template_vars('LBL_ENTER').' '.$smarty->get_template_vars('LBL_SEC_QUESTION')." 2'",
	"class" 			=> "required"
);
$secQuestion1 = $gdbobj->DynamicDropDown($secQueArr1);
$secQuestion2 = $gdbobj->DynamicDropDown($secQueArr2);

if(!isset($gencaptchaObj)) {
	include_once(SITE_CLASS_GEN."class.gencaptcha.php");
	$gencaptchaObj =	new gencaptcha();
}
$smarty->assign('gencaptchaObj',$gencaptchaObj);
$smarty->assign('dlang', $dlang);
$smarty->assign('stateArr', $stateArr);
$smarty->assign('bnk_dtls', $bnk_dtls);
$smarty->assign('currency', $currency);
$smarty->assign('db_country', $db_country);
$smarty->assign('db_state', $db_state);
$smarty->assign('OrgType', $OrgType);
$smarty->assign('secQuestion1', $secQuestion1);
$smarty->assign('secQuestion2', $secQuestion2);
$smarty->assign('vdata', $vdata);
?>