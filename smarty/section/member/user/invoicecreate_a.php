<?php

if (!isset($invOrdObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.InvoiceOrderHeading.php");
    $invOrdObj = new InvoiceOrderHeading();
}
if (!isset($invLineObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.InvoiceDetailLine.php");
    $invLineObj = new InvoiceDetailLine();
}
if (!isset($orgObj)) {
    include_once(SITE_CLASS_APPLICATION . "organization/class.Organization.php");
    $orgObj = new Organization();
}
if (!isset($orgprefObj)) {
    include_once(SITE_CLASS_APPLICATION . "organization/class.OrganizationPreference.php");
    $orgprefObj = new OrganizationPreference();
}
if (!isset($statusmasterObj)) {
    include_once(SITE_CLASS_APPLICATION . "class.StatusMaster.php");
    $statusmasterObj = new StatusMaster();
}
if (!isset($orgUsrObj)) {
    require_once(SITE_CLASS_APPLICATION . "user/class.OrganizationUser.php");
    $orgUsrObj = new OrganizationUser();
}
if (!isset($secManObj)) {
    require_once(SITE_CLASS_APPLICATION . "securitymanager/class.SecurityManager.php");
    $secManObj = new SecurityManager();
}
if (!isset($emailObj)) {
    include_once(SITE_CLASS_APPLICATION . 'class.EmailTemplate.php');
    $emailObj = new EmailTemplate();
}
if (!isset($userActionObj)) {
    include_once(SITE_CLASS_APPLICATION . 'user/class.UserActionVerification.php');
    $userActionObj = new UserActionVerification();
}
if (!isset($sendMail)) {
    include(SITE_CLASS_GEN . "class.sendmail.php");
    $sendMail = new SendPHPMail();
}
if (!isset($pohObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.PurchaseOrderHeading.php");
    $pohObj = new PurchaseOrderHeading();
}
if (!isset($poLineObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.PurchaseOrderLine.php");
    $poLineObj = new PurchaseOrderLine();
}
if (!isset($invAttachmentObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.InvoiceOrderAttachment.php");
    $invAttachmentObj = new InvoiceOrderAttachment();
}
if (!isset($imgObj)) {
    include_once(SITE_CLASS_GEN . "class.imagecrop.php");
    $imgObj = new imagecrop();
}

$totusrs = $orgUsrObj->getDetails(" COUNT(*) as tot ", " AND iOrganizationID=$curORGID AND eUserType='User'");
$totusrs = $totusrs[0]['tot'];

$ordt = $orgUsrObj->getDetails('*', " AND iOrganizationID=$curORGID AND eUserType='Admin' AND eStatus='Active'");
$org = $orgObj->select($curORGID);
$smdt = $secManObj->getDetails('*', " AND iASMID=" . $org[0]['iASMID'] . " AND eStatus='Active'");
if (is_array($smdt) && is_array($ordt)) {
    $emailArr = array_merge($smdt, $ordt);
} else if (is_array($smdt)) {
    $emailArr = $smdt;
} else if (is_array($ordt)) {
    $emailArr = $ordt;
}

// prints($emailArr); exit;
$view = $_POST['view'];
$frmbuyer = $_POST['frmbuyer'];
$Data1 = $_POST['Data'];
$eFrom = $Data1['eFrom'];
unset($Data1['eFrom']);
$iInvoiceID = PostVar('iInvoiceID');
$generalobj->getRequestVars();
// prints($Data);exit;
$buyerOrgDtls = $orgObj->select($Data['iBuyerOrganizationID']);
// prints($buyerOrgDtls); exit;
$Data['vAssociatePOBuyerCode'] = $buyerOrgDtls[0]['vOrganizationCode'];
$Data['vBuyerName'] = $buyerOrgDtls[0]['vCompanyName'];
//$Data['vBuyerContactName'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_NAME'];
if (isset($_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ORGTYPE']) && ($_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ORGTYPE'] == 'Supplier' || ($_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ORGTYPE'] == 'Both' && $frmbuyer != 'y')) && ($view == 'add' || $view == '' || $view == 'edit')) {
    $supplierOrgDtls = $orgObj->select($curORGID);
    $Data['vSupplierName'] = $supplierOrgDtls[0]['vCompanyName'];
    $Data['vSupplierAddLine1'] = $supplierOrgDtls[0]['vAddressLine1'];
    $Data['vSupplierAddLine2'] = $supplierOrgDtls[0]['vAddressLine2'];
    $Data['vSupplierZipCode'] = $supplierOrgDtls[0]['vZipcode'];
    $Data['vSupplierState'] = $supplierOrgDtls[0]['vState'];
    $Data['vSupplierCountry'] = $supplierOrgDtls[0]['vCountry'];
    $Data['vInvoiceSupplierCode'] = $supplierOrgDtls[0]['vOrganizationCode'];
    $Data['vSupplierContactTelephone'] = $supplierOrgDtls[0]['vPhone'];
    $Data['vSupplierContactParty'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_USER_NAME'];
    $Data['iSupplierID'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'];
    $Data['iSupplierOrganizationID'] = $curORGID;
} else if (isset($_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ORGTYPE']) && ($_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ORGTYPE'] == 'Buyer' || ($_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ORGTYPE'] == 'Both' && $frmbuyer == 'y')) && ($view == 'add' || $view == '' || $view == 'edit')) {
    if (isset($Data['iSupplierOrganizationID']) && $Data['iSupplierOrganizationID'] > 0) {
        $supplierOrgDtls = $orgObj->select($Data['iSupplierOrganizationID']);
        $Data['vSupplierName'] = $supplierOrgDtls[0]['vCompanyName'];
        $Data['vSupplierAddLine1'] = $supplierOrgDtls[0]['vAddressLine1'];
        $Data['vSupplierAddLine2'] = $supplierOrgDtls[0]['vAddressLine2'];
        $Data['vSupplierZipCode'] = $supplierOrgDtls[0]['vZipcode'];
        $Data['vSupplierState'] = $supplierOrgDtls[0]['vState'];
        $Data['vSupplierCountry'] = $supplierOrgDtls[0]['vCountry'];
        $Data['vInvoiceSupplierCode'] = $supplierOrgDtls[0]['vOrganizationCode'];
        $Data['vSupplierContactTelephone'] = $supplierOrgDtls[0]['vPhone'];
        // $Data['vSupplierContactParty'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_NAME'];
        // $Data['iSupplierID'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
        $Data['iSupplierOrganizationID'] = $Data['iSupplierOrganizationID'];
    }
    $bOrgDtls = $orgObj->select($curORGID);
    $Data['vBuyerName'] = (isset($bOrgDtls[0]['vCompanyName'])) ? $bOrgDtls[0]['vCompanyName'] : '';
    $Data['vAssociatePOBuyerCode'] = (isset($bOrgDtls[0]['vOrganizationCode'])) ? $bOrgDtls[0]['vOrganizationCode'] : '';
    $Data['iBuyerID'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'];
    $Data['iBuyerOrganizationID'] = $curORGID;
    $Data['eCreateByBuyer'] = 'Yes';
} /* else if($view=='edit' && $iInvoiceID>0) {
  $invd = $invOrdObj->select($iInvoiceID);
  if(is_array($invd) && count($invd)>0) {
  $supplierOrgDtls = $orgObj->select($invd[0]['iSupplierOrganizationID']);
  $Data['vSupplierName'] = $supplierOrgDtls[0]['vCompanyName'];
  $Data['vSupplierAddLine1'] = $supplierOrgDtls[0]['vAddressLine1'];
  $Data['vSupplierAddLine2'] = $supplierOrgDtls[0]['vAddressLine2'];
  $Data['vSupplierZipCode'] = $supplierOrgDtls[0]['vZipcode'];
  $Data['vSupplierState'] = $supplierOrgDtls[0]['vState'];
  $Data['vSupplierCountry'] = $supplierOrgDtls[0]['vCountry'];
  $Data['vInvoiceSupplierCode'] = $supplierOrgDtls[0]['vOrganizationCode'];
  $Data['vSupplierContactTelephone'] = $supplierOrgDtls[0]['vPhone'];
  $Data['vSupplierContactParty'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_NAME'];
  $Data['iSupplierID'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
  $Data['iSupplierOrganizationID'] = $curORGID;
  }
  } */
// $Data['iPurchaseOrderID'] = $_POST['iPurchaseOrderID'];
$Data['vBillToContactTelephone'] = $_POST['vBillToContactTelephoneCode'] . "-" . $Data['vBillToContactTelephone'];
$Data['dCashDiscountBaseline'] = ($Data['dCashDiscountBaseline'] != '') ? calcGTzTime($Data['dCashDiscountBaseline'], 'Y-m-d') : '';
$Data['dNetPaymentdate'] = ($Data['dNetPaymentdate'] != '') ? calcGTzTime($Data['dNetPaymentdate'], 'Y-m-d') : '';
// prints($Data); exit;
unset($Data['supplierID']);

if ($Data['eSaved'] != 'Yes') {
    $Data['eSaved'] = 'No';
}

if ($view == '' || $view == 'add') {
    ### SERVER SIDE VALIDATION ####
    include(SITE_CLASS_GEN . "class.validation.php");
    $validation = new Validation();
    $RequiredFiledArr = array(
        // 'iPurchaseOrderID' 		=> $smarty->get_template_vars('LBL_SELECT')." ".$smarty->get_template_vars('LBL_PURCHASE_ORDER'),
        'iBuyerOrganizationID' => $smarty->get_template_vars('LBL_SELECT') . " " . $smarty->get_template_vars('LBL_BUYER') . " " . $smarty->get_template_vars('LBL_COMPANY'),
        'vBuyerContactParty' => $smarty->get_template_vars('LBL_SELECT') . " " . $smarty->get_template_vars('LBL_BUYER') . " " . $smarty->get_template_vars('LBL_CONTACT_PARTY'),
        // 'vRegisterNumber'      	=> $smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_REFERENCE_NUMBER'),
        // 'iOpeningUnit'          => $smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_OPENING_UNIT'),
        'eLineItemTax' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_LINE_ITEM_TAX'),
        // 'fVAT'           			=> $smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_VAT'),
        'vBillToParty' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_BILL_TO') . " " . $smarty->get_template_vars('LBL_PARTY'),
        'vBillToAddLine1' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_BILL_TO') . " " . $smarty->get_template_vars('LBL_ADDR_LINE') . "1",
        'vBillToCity' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_BILL_TO') . " " . $smarty->get_template_vars('LBL_CITY'),
        'vBillToCountry' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_BILL_TO') . " " . $smarty->get_template_vars('LBL_COUNTRY'),
        'vBillToState' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_BILL_TO') . " " . $smarty->get_template_vars('LBL_STATE'),
        'vBillToZipCode' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_BILL_TO') . " " . $smarty->get_template_vars('LBL_ZIP_CODE'),
        'vBillToContactParty' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_BILL_TO') . " " . $smarty->get_template_vars('LBL_CONTACT_PARTY'),
        'vBillToContactTelephoneCode' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_BILL_TO') . " " . $smarty->get_template_vars('LBL_CONTACT_TELEPHONE') . " " . $smarty->get_template_vars('LBL_CODE'),
        'vBillToContactTelephone' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_BILL_TO') . " " . $smarty->get_template_vars('LBL_CONTACT_TELEPHONE'),
        'vCurrency' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_CURRENCT')
            //'fInvoiceTotal' 			=> $smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_INVOICE_TOTAL'),
            //'fPrePayment' 				=> $smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_PRE_PAYMENT')
    );
    $stsdtls = $statusmasterObj->getDetails('*', " AND vStatus_en='Accepted' AND eFor='PO' ");
    $sts = $stsdtls[0]['iStatusID'];
    $where = " AND iStatusID=$sts ";
    $where .= " AND iSupplierOrganizationID=$curORGID ";
    $where .= " AND (Select count(iInvoiceID) from b2b_inovice_order_heading where iPurchaseOrderID=poh.iPurchaseOrderID)=0 ";
    $POCodeData = $pohObj->getJoinTableInfo('', "poh.vPOCode as vTitle,poh.iPurchaseOrderID as Id", $where);
    if (is_array($POCodeData) && count($POCodeData) > 0) {
        // $RequiredFiledArr['iPurchaseOrderID'] = $smarty->get_template_vars('LBL_SELECT')." ".$smarty->get_template_vars('LBL_PURCHASE_ORDER');
    }
    $resArr = $validation->isEmpty($RequiredFiledArr);
    $numdt = array();
    //$numdt['iOpeningUnit'] = $Data['iOpeningUnit'];
    //$nvldmsg['iOpeningUnit'] = $smarty->get_template_vars('LBL_PRE_PAYMENT')." ".$smarty->get_template_vars('LBL_MUST_BE_NUMERIC');
    $numdt['fVAT'] = $Data['fVAT'];
    $nvldmsg['fVAT'] = $smarty->get_template_vars('LBL_VAT') . " " . $smarty->get_template_vars('LBL_MUST_BE_NUMERIC');
    $numdt['fPOTotal'] = $Data['fPOTotal'];
    $nvldmsg['fPOTotal'] = $smarty->get_template_vars('LBL_PO_TOTAL') . " " . $smarty->get_template_vars('LBL_MUST_BE_NUMERIC');
    $numdt['fPrepayment'] = $Data['fPrepayment'];
    $nvldmsg['fPrepayment'] = $smarty->get_template_vars('LBL_PRE_PAYMENT') . " " . $smarty->get_template_vars('LBL_MUST_BE_NUMERIC');
    $numdt['vBillToContactTelephone'] = str_replace('-', '', $Data['vBillToContactTelephone']);
    $nvldmsg['vBillToContactTelephone'] = $smarty->get_template_vars('LBL_BILL_TO') . " " . $smarty->get_template_vars('LBL_CONTACT_TELEPHONE') . " " . $smarty->get_template_vars('LBL_MUST_BE_NUMERIC');
    if (count($numdt) > 0) {
        $nvld_ary = $validation->isNum($numdt, $nvldmsg, 'empty');
    }
    // prints($resArr); exit;
    // prints($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']); exit;
    // $resArr = $validation->isEmpty($RequiredFiledArr);
    if ($resArr || $nvld_ary == 'er') {
        $_SESSION['Data'] = $Data;
        header("Location:" . $_SERVER['HTTP_REFERER'] . "");
        exit;
    }
    ### ENDS HERE ###

    /* if(!isset($bnkObj)) {
      include_once(SITE_CLASS_APPLICATION."class.BankMaster.php");
      $bnkObj = new BankMaster();
      }
      $bnk_dtls = $bnkObj->getDetails('*', " AND iBankId=".$Data['iBankId']);
      $Data['vBankName'] = $bnk_dtls[0]['vBankName'];
      $Data['vSwiftCode'] = $bnk_dtls[0]['vSwiftCode']; */

// unset($Data['iPurchaseOrderID']);
    $Data['dCreatedDate'] = $Data['dIssueDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
    $Data['vFromIP'] = $_SERVER['REMOTE_ADDR'];
    $Data['iModifiedByID'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'];
    $supplierOrgPrefDtls = $orgprefObj->getDetails('*', " AND iOrganizationID=" . $supplierOrgDtls[0]['iOrganizationID']);
    //if($totusrs > 1) {
    $stsdtls = $statusmasterObj->getDetails('*', " AND eFor='Invoice' AND vStatus_en='Create' ");
    $Data['iStatusID'] = $stsdtls[0]['iStatusID'];
    $invstatus = $supplierOrgPrefDtls[0]['vInvoiceStatusLevel'];
    /* if($supplierOrgPrefDtls[0]['eReqVerificationInv'] == 'Yes') {
      $Data['iStatusID'] = '0';
      } else {
      if(trim($invstatus) != '') {
      $invstatus = @explode(',',$invstatus);
      sort($invstatus);
      $Data['iStatusID'] = $invstatus[0];
      }
      }
      if($Data['eSaved'] == 'Yes') {
      $stsdtls = $statusmasterObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Create' ");
      $Data['iStatusID'] = $stsdtls[0]['iStatusID'];
      } */
    /* } else {
      if($Data['eSaved'] == 'Yes') {
      $stsdtls = $statusmasterObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Create' ");
      } else {
      $stsdtls = $statusmasterObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Issued' ");
      }
      $Data['iStatusID'] = $stsdtls[0]['iStatusID'];
      } */
    // $vPONumber = $generalobj->UniqueID("PO",PRJ_DB_PREFIX."_purchase_order_heading","vPONumber",$charlimit="7");
    // $vInvoiceCode=$generalobj->UniqueID("INV",PRJ_DB_PREFIX."_inovice_order_heading","vInvoiceCode",$charlimit="10");
    // $Data['iSupplierOrganizationID'] = $curORGID;
    //
	if ($uorg_type == 'Buyer' || ($uorg_type == 'Both' && $frmbuyer == 'y')) {
        $icstsdtls = $statusmasterObj->getDetails('*', " AND eFor='Invoice' AND vStatus_en='Issued' ");
        $Data['iStatusID'] = $icstsdtls[0]['iStatusID'];
        $Data['iaStatusID'] = 0;
    }
    //
    $vInvoiceCode = $invOrdObj->getUniqueCode();
    $Data['vInvoiceCode'] = $vInvoiceCode;
    $vInvoiceNumber = "INV" . $Data['vInvoiceCode'] . "-" . trim($Data['vInvoiceSupplierCode']);
    $Data['vInvoiceNumber'] = $vInvoiceNumber;
    $Data['eDelete'] = 'No';
    // pr($Data); exit;
    $invOrdObj->setAllVar($Data);
    $id = $invOrdObj->insert();
    //exit;
    //if($Data['eSaved']!='Yes')
    //{
    if ($id) {
        $sub1 = "New Invoice Created";
        $type = "Create";
        $actn = "Create";
        $sub2 = "New Invoice";
    }
    //}
    if ($id) {
        $files = $_FILES['files'];
        $titles = $_POST['titles'];
        $descprtiption = $_POST['descriptions'];
        $dAdate = calcGTzTime(date('Y-m-d'), 'Y-m-d');
        if (trim($files['name'][0]) == '')
            unset($files['name'][0]);
        $fileData['iInvoiceID'] = $id;
        $fileData['eRelatedTo'] = 'Invoice';
        $fileData['dAdate'] = $dAdate;

        $fileUpload = array();
        for ($i = 0; $i < count($files['name']); $i++) {
            // $fileData['vTitle']=$titles[$i];
            // $fileData['tDescription']=$descprtiption[$i];
            $fileUpload['name'] = $files['name'][$i + 1];
            $fileUpload['tmp_name'] = $files['tmp_name'][$i + 1];
            $fileName = $imgObj->UploadFile('INV', 'docs', $id, $fileUpload, '');
            $fileData['vFile'] = $fileName;
            if ($fileName != '') {
                $invAttachmentObj->setAllVar($fileData);
                $invAttachmentObj->insert();
            }
        }

        $msg = "ras";
        $_SESSION['invadd'] = 'yes';                
        if ($Data['eSaved'] == 'Yes') {
            if ($_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ORGTYPE'] == 'Buyer') {
                $redirecturl = SITE_URL_DUM . 'invacptlist/' . $msg;
            } else {
                $redirecturl = SITE_URL_DUM . 'invoicelist/' . $msg;
            }
            if($eFrom == "Next"){
                $redirecturl = SITE_URL_DUM . 'invpref/' . $id . '/' . $msg;
            }else{
                $redirecturl = SITE_URL_DUM . 'invoicelist/' . $msg;
            }
        } else {
            $redirecturl = SITE_URL_DUM . 'invpref/' . $id . '/' . $msg;
        }
    } else {
        $msg = "raserr";
        $redirecturl = SITE_URL_DUM . 'invoicelist/' . $msg;
    }
    $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_MSG'] = $msg;
// unset($Data);
// unset($_POST);
} else if ($view == 'verify') {
    $dt = array();
    $eDelete = $_POST['edelete'];
    $iInvoiceID = $_POST['iInvoiceID'];
    if ($eDelete == 'Yes') {
        $invOrdObj->delete($iInvoiceID);
        $msg = "rds";
        $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_MSG'] = $msg;
        header("location:" . SITE_URL_DUM . 'invoicelist/' . $msg);
        exit;
    }
    $nstatus = $_POST['nstatus'];

    $invdtl = $invOrdObj->select($iInvoiceID);
    // echo $nstatus; exit;
    // prints($Data); exit;
    //if($totusrs > 1) {
    $stsdtls = $statusmasterObj->getDetails('*', " AND eFor='Invoice' AND vStatus_en='Issued' ");
    $isusts = $stsdtls[0]['iStatusID'];
    $iprvsts = "";
    $orgposl = @explode(",", $opf[0]['vInvoiceStatusLevel']);
    for ($l = 0; $l < count($orgposl); $l++) {
        if ($orgposl[$l] == $isusts) {
            if (isset($orgposl[$l - 1])) {
                $iprvsts = $orgposl[$l - 1];
            }
        }
    }
    // prints($iprvsts); exit;
    $dt['iStatusID'] = $nstatus;
    if ($nstatus == $iprvsts) {
        $dt['iStatusID'] = $isusts;
    }
    $act = $statusmasterObj->getDetails('vStatus_en', " AND iStatusID=" . $dt['iStatusID']);
    /* } else {
      $stsdtls =  $statusmasterObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Issued' ");
      $isusts = $stsdtls[0]['iStatusID'];
      if($invdtl[0]['iBuyerOrganizationID']==$curORGID && $invdtl[0]['iStatusID']==$isusts) {
      $acptsts =  $statusmasterObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Accepted' ");
      $dt['iStatusID'] = $acptsts[0]['iStatusID'];
      $sfmail = 'yes';
      } else {
      // $stsdtls =  $statusmasterObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Issued' ");
      $dt['iStatusID'] = $isusts;
      }
      } */

    $stsdtls = $statusmasterObj->getDetails('*', " AND eFor='Invoice' AND vStatus_en='Issued' ");
    $isusts = $stsdtls[0]['iStatusID'];
    $acptsts = $statusmasterObj->getDetails('*', " AND eFor='Invoice' AND vStatus_en='Accepted' ");
    $acptsts = $acptsts[0]['iStatusID'];
    $rsts = $statusmasterObj->getDetails('*', " AND eFor='Invoice' AND vStatus_en='Rejected' ");
    $rsts = $rsts[0]['iStatusID'];
    $cstsdtl = $statusmasterObj->getDetails('*', " AND eFor='Invoice' AND vStatus_en='Create' ");
    if ($dt['iStatusID'] == $isusts) {
        $borgpfdt = $orgprefObj->getDetails('*', " AND iOrganizationID=" . $invdtl[0]['iBuyerOrganizationID']);
        //if($borgpfdt[0]['eReqVerifyInvAcpt'] != 'Yes') {
        $dt['iaStatusID'] = 0;  // $cstsdtl[0]['iStatusID'];
        //}
    }
    if ($invdtl[0]['iStatusID'] == $isusts) {
        $stsdtls = $statusmasterObj->getDetails('*', " AND eFor='Invoice' AND vStatus_en='Issued' ");
        $isusts = $stsdtls[0]['iStatusID'];
        $iprvsts = "";
        $orgposl = @explode(",", $opf[0]['vInvoiceAcceptanceLevel']);
        for ($l = 0; $l < count($orgposl); $l++) {
            if ($orgposl[$l] == $isusts) {
                if (isset($orgposl[$l - 1])) {
                    $iprvsts = $orgposl[$l - 1];
                }
            }
        }
        if (trim($iprvsts) == "") {
            for ($l = 0; $l < count($orgposl); $l++) {
                if ($orgposl[$l] == $acptsts) {
                    if (isset($orgposl[$l - 1])) {
                        $iprvsts = $orgposl[$l - 1];
                    }
                }
            }
        }
        if (($orgposl[0] == $isusts || $orgposl[0] == $acptsts) && $opf[0]['eReqVerifyInvAcpt'] == 'No' && $nstatus == $cstsdtl[0]['iStatusID']) {
            $iprvsts = $cstsdtl[0]['iStatusID'];
        }
        // prints($iprvsts); exit;
        $dt['iStatusID'] = $nstatus;
        if ($nstatus == $iprvsts) {
            $nstatus = $dt['iStatusID'] = $acptsts;
        }

        if (($invdtl[0]['iaStatusID'] < $isusts || $podtl[0]['iaStatusID'] == $rsts) && $nstatus < $isusts) {
            $dt['iaStatusID'] = $nstatus;
        } else {
            $dt['iaStatusID'] = $acptsts;
        }
        unset($dt['iStatusID']);
        if ($dt['iaStatusID'] == $acptsts) {
            $dt['iStatusID'] = $acptsts;
        }
        $act = $statusmasterObj->getDetails('vStatus_en', " AND iStatusID=" . $dt['iaStatusID']);
    }

    $dt['iModifiedByID'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'];
    // prints($dt); exit;
    $nsts = $dt['iStatusID'];
    if (isset($_POST['Data']['fAcceptedAmount']) && $dt['iaStatusID'] > 0) {
        $dt['fAcceptedAmount'] = $_POST['Data']['fAcceptedAmount'];
        $dt['dAcceptedVat'] = $_POST['Data']['dAcceptedVat'];
        $dt['dAcceptedOtherTax'] = $_POST['Data']['dAcceptedOtherTax'];
        $dt['dAcceptedWHTax'] = $_POST['Data']['dAcceptedWHTax'];
        $dt['dAcceptedNetPaymentDate'] = $_POST['Data']['dAcceptedNetPaymentDate'];
    }
    // pr($_POST);
    // pr($dt); exit;
    $id = $invOrdObj->updateData($dt, " iInvoiceID=$iInvoiceID ");
    $vrfydt['iVerifiedBy'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'];
    $vrfydt['eVerifiedBy'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_USER_TYPE_SHORT'];
    $vrfydt['dVerifyDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
    $vrfydt['vVerifyFromIP'] = $_SERVER['REMOTE_ADDR'];
    $res = $userActionObj->updateData($vrfydt, "iItemID=$iInvoiceID AND eSubject='Invoice'");
    // prints($act); exit;
    if ($id) {
        $act = $act[0]['vStatus_en'];
        if ($dt['iaStatusID'] == $cstsdtl[0]['iStatusID']) {
            $sub1 = "New Invoice Created";
            $type = "Create";
            $actn = "Create";
            $sub2 = "New Invoice";
            $vorgid = $invdtl[0]['iBuyerOrganizationID'];
        } else {
            $sub1 = "Invoice Status Changed";
            $type = "Modified";
            $actn = $act;
            $sub2 = "Invoice Status Changed";
        }
    }

    if ($id) {
        if ($dt['iaStatusID'] == $acptsts) {
            $r = $invOrdObj->updateData(array('dAcceptedDate' => calcGTzTime(date('Y-m-d'), 'Y-m-d')), " iInvoiceID=$iInvoiceID ");
        }
        $isusts = $statusmasterObj->getDetails('*', " AND eFor='Invoice' AND vStatus_en='Issued' ");
        if ($nsts == $isusts[0]['iStatusID'] && $invdtl[0]['iStatusID'] != $isusts[0]['iStatusID']) {  // && ($invdtl[0]['iPurchaseOrderID'] == '' || $invdtl[0]['iPurchaseOrderID']<1)
            // $vInvoiceCode = $generalobj->getUniqueCode(PRJ_DB_PREFIX."_inovice_order_heading","vInvoiceCode");
            $iovdt = $invOrdObj->select($iInvoiceID);
            #$splrorg = $orgObj->select($iovdt[0]['iSupplierOrganizationID']); 	// iBuyerOrganizationID
            #$byrorg = $orgObj->select($iovdt[0]['iBuyerOrganizationID']);
            #pr($splrorg);
            #pr($byrorg);
            // New Invoice Acceptance
            $acptsts = $statusmasterObj->getDetails('*', " AND eFor='Invoice' AND vStatus_en='Accepted' ");
            $tusrs = $orgUsrObj->getPermittedUsers($iovdt[0]['iBuyerOrganizationID'], $acptsts[0]['iStatusID'], 'inv', 'acpt');
            $where = "AND vType='New Invoice Acceptance' AND eSection='Member'";
            $db_email = $emailObj->getDetails('*', $where);
            $link = SITE_URL . "invoiceview/" . $iInvoiceID;
            $body = Array("#INVCODE#", "#SUPPLIERORG#", "#SUPORGCODE#", "#BUYERORG#", "#BUYORGCODE#", "#LINK#");
            $post = Array($iovdt[0]['vInvSupplierCode'], $iovdt[0]['vSupplierName'], $iovdt[0]['vInvoiceSupplierCode'], $iovdt[0]['vBuyerName'], $iovdt[0]['vAssociatePOBuyerCode'], $link);

            $rplarr = Array("Hello #NAME#,", "background-color: rgb(239, 239, 239);", "Regards,", "#MAIL_FOOTER#", "#SITE_URL#");
            $tbody_en = str_replace($rplarr, " ", $db_email[0]['tBody_en']);
            $emailContent_en = trim(str_replace($body, $post, $tbody_en));
            $tbody_fr = str_replace($rplarr, " ", $db_email[0]['tBody_fr']);
            $emailContent_fr = trim(str_replace($body, $post, $tbody_fr));

            $dt['iItemID'] = $iInvoiceID;  // $id
            $dt['iOrganizationID'] = $iovdt[0]['iBuyerOrganizationID'];  // $iovdt[0]['iSupplierOrganizationID'];
            $dt['vMailSubject_en'] = $db_email[0]['vSub_en'];
            $dt['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
            $dt['tMailContent_en'] = $emailContent_en;
            $dt['tMailContent_fr'] = $emailContent_fr;
            $dt['eSubject'] = "Invoice";
            $dt['iCreatedBy'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'];
            $dt['eCreatedType'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_USER_TYPE_SHORT'];
            $dt['dActionDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
            $userActionObj->setAllVar($dt);
            $userActionObj->insert();

            if ((is_array($tusrs) && count($tusrs) > 0)) {
                $body_arr = Array("#NAME#", "#MODIFIED_BY#", "#INVCODE#", "#SUPPLIERORG#", "#SUPORGCODE#", "#BUYERORG#", "#BUYORGCODE#", "#LINK#", "#MAIL_FOOTER#", "#SITE_URL#");
                #pr($iovdt);
                for ($i = 0; $i < count($tusrs); $i++) {
                    $smname = $tusrs[$i]['vFirstName'] . ' ' . $tusrs[$i]['vLastName'];
                    $email = $tusrs[$i]['vEmail'];
                    # $post_arr = Array($smname,$sess_user_name."($sess_usertype_short)",$iovdt[0]['vInvoiceCode'],$iovdt[0]['vSupplierName'],$splrorg[0]['vOrganizationCode'],$iovdt[0]['vBuyerCompanyName'],$iovdt[0]['vBuyerCode'],$link,$MAIL_FOOTER,SITE_URL);
                    $post_arr = Array($smname, $sess_user_name . "($sess_usertype_short)", $iovdt[0]['vInvoiceCode'], $iovdt[0]['vSupplierName'], $iovdt[0]['vInvoiceSupplierCode'], $iovdt[0]['vBuyerName'], $iovdt[0]['vAssociatePOBuyerCode'], $link, $MAIL_FOOTER, SITE_URL);
                    $sendMail->Send('New Invoice Acceptance', "Member", $email, $body_arr, $post_arr);
                    #echo "<hr/>";
                }
            }
        }
    }

    if ($id) {
        $msg = "rus";
    } else {
        $msg = "ruserr";
    }
    $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_MSG'] = $msg;

    $isusts = $statusmasterObj->getDetails('*', " AND eFor='Invoice' AND vStatus_en='Issued' ");
    $isusts = $isusts[0]['iStatusID'];
    if ($invdtl[0]['iStatusID'] >= $isusts && $curORGID == $invdtl[0]['iBuyerOrganizationID']) {
        $nstatus = ($nstatus == 1) ? 'all' : $nstatus;
        $redirecturl = SITE_URL_DUM . 'invacptlist/' . $nstatus . '/' . $msg;
    } else {
        $redirecturl = SITE_URL_DUM . 'invoicelist/' . $nstatus . '/' . $msg;
    }
    $id = $iInvoiceID;
} else if ($view == 'reject') {
    $nstatus = $_POST['nstatus'];
    $tReasonToReject = $_POST['tReasonToReject'];
    $stsdtls = $statusmasterObj->getDetails('*', " AND eFor='Invoice' AND vStatus_en='Rejected' ");
    $sts = $stsdtls[0]['iStatusID'];
    $iInvoiceID = $_POST['iInvoiceID'];
    $eDelete = $_POST['edelete'];
    if ($eDelete == 'Yes')
        $dt['eDelete'] = 'No';
    $dt['iStatusID'] = $sts;
    $dt['iModifiedByID'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'];
    $dt['tReasonToReject'] = $tReasonToReject;
    $invdtl = $invOrdObj->select($iInvoiceID);
    if ($invdtl[0]['iaStatusID'] >= 0 && $curORGID == $invdtl[0]['iBuyerOrganizationID']) {
        $dt['iaStatusID'] = $dt['iStatusID'];
    }
    $id = $invOrdObj->updateData($dt, " iInvoiceID=$iInvoiceID ");
    if ($id) {
        $sub1 = "Invoice Status Changed";
        $type = "Rejected";
        $actn = "Rejected";
        $sub2 = "Invoice Status Changed";
    }
    if ($id) {
        $msg = "rus";
    } else {
        $msg = "ruserr";
    }
    $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_MSG'] = $msg;
    // if($invdtl[0]['iPurchaseOrderID'] == '' || $invdtl[0]['iPurchaseOrderID']<1) {
    $isusts = $statusmasterObj->getDetails('*', " AND eFor='Invoice' AND vStatus_en='Issued' ");
    $isusts = $isusts[0]['iStatusID'];
    if ($invdtl[0]['iStatusID'] >= $isusts) {  // && $curORGID == $invdtl[0]['iBuyerOrganizationID']
        if ($invdtl[0]['iBuyerOrganizationID'] == $curORGID && $invdtl[0]['eCreateByBuyer'] == 'Yes') {
            $redirecturl = SITE_URL_DUM . 'invacptlist/' . $sts . '/' . $msg;
        } else {
            $redirecturl = SITE_URL_DUM . 'invoicelist/' . $sts . '/' . $msg;
        }
    } else {
        $redirecturl = SITE_URL_DUM . 'invacptlist/' . $sts . '/' . $msg;
    }
    $id = $iInvoiceID;
} else if ($view == 'edit') {
    ### SERVER SIDE VALIDATION ####
    include(SITE_CLASS_GEN . "class.validation.php");
    $validation = new Validation();
    $RequiredFiledArr = array(
        // 'iPurchaseOrderID' 		=> $smarty->get_template_vars('LBL_SELECT')." ".$smarty->get_template_vars('LBL_PURCHASE_ORDER'),
        'iBuyerOrganizationID' => $smarty->get_template_vars('LBL_SELECT') . " " . $smarty->get_template_vars('LBL_BUYER') . " " . $smarty->get_template_vars('LBL_COMPANY'),
        'vBuyerContactParty' => $smarty->get_template_vars('LBL_SELECT') . " " . $smarty->get_template_vars('LBL_BUYER') . " " . $smarty->get_template_vars('LBL_CONTACT_PARTY'),
        //'vRegisterNumber'      	=> $smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_REFERENCE_NUMBER'),
        //'iOpeningUnit'           => $smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_OPENING_UNIT'),
        'eLineItemTax' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_LINE_ITEM_TAX'),
        //'fVAT'           			=> $smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_VAT'),
        'vBillToParty' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_BILL_TO') . " " . $smarty->get_template_vars('LBL_PARTY'),
        'vBillToAddLine1' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_BILL_TO') . " " . $smarty->get_template_vars('LBL_ADDR_LINE') . "1",
        'vBillToCity' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_BILL_TO') . " " . $smarty->get_template_vars('LBL_CITY'),
        'vBillToCountry' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_BILL_TO') . " " . $smarty->get_template_vars('LBL_COUNTRY'),
        'vBillToState' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_BILL_TO') . " " . $smarty->get_template_vars('LBL_STATE'),
        'vBillToZipCode' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_BILL_TO') . " " . $smarty->get_template_vars('LBL_ZIP_CODE'),
        'vBillToContactParty' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_BILL_TO') . " " . $smarty->get_template_vars('LBL_CONTACT_PARTY'),
        'vBillToContactTelephoneCode' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_BILL_TO') . " " . $smarty->get_template_vars('LBL_CONTACT_TELEPHONE') . " " . $smarty->get_template_vars('LBL_CODE'),
        'vBillToContactTelephone' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_BILL_TO') . " " . $smarty->get_template_vars('LBL_CONTACT_TELEPHONE'),
        'vCurrency' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_CURRENCT')
            //'fPOTotal' 					=> $smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_PO_TOTAL'),
            //'fPrepayment' 				=> $smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_PRE_PAYMENT')
    );
    // pr($_POST); exit;
    $invdt = $invOrdObj->select($iInvoiceID);
    $stsdtls = $statusmasterObj->getDetails('*', " AND vStatus_en='Accepted' AND eFor='PO' ");
    $sts = $stsdtls[0]['iStatusID'];
    $where = " AND iStatusID=$sts ";
    if (isset($_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ORGTYPE']) && $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ORGTYPE'] == 'Supplier') {
        $where .= " AND iSupplierOrganizationID=$curORGID ";
    } else {
        $where .= " AND iSupplierOrganizationID=$invdt[0]['iSupplierOrganizationID'] ";
    }
    $where .= " AND (Select count(iInvoiceID) from b2b_inovice_order_heading where iPurchaseOrderID=poh.iPurchaseOrderID)=0 ";
    $POCodeData = $pohObj->getJoinTableInfo('', "poh.vPOCode as vTitle,poh.iPurchaseOrderID as Id", $where);
    if (is_array($POCodeData) && count($POCodeData) > 0) {
        // $RequiredFiledArr['iPurchaseOrderID'] = $smarty->get_template_vars('LBL_SELECT')." ".$smarty->get_template_vars('LBL_PURCHASE_ORDER');
    }
    $resArr = $validation->isEmpty($RequiredFiledArr);
    $numdt = array();
    /* if(!in_array($smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_OPENING_UNIT'),$resArr)) {
      $numdt['iOpeningUnit'] = $Data['iOpeningUnit'];
      $nvldmsg['iOpeningUnit'] = $smarty->get_template_vars('LBL_PRE_PAYMENT')." ".$smarty->get_template_vars('LBL_MUST_BE_NUMERIC');
      }
      if(!in_array($smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_VAT'),$resArr)) {
      $numdt['fVAT'] = $Data['fVAT'];
      $nvldmsg['fVAT'] = $smarty->get_template_vars('LBL_VAT')." ".$smarty->get_template_vars('LBL_MUST_BE_NUMERIC');
      }
      if(!in_array($smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_PO_TOTAL'),$resArr)) {
      $numdt['fPOTotal'] = $Data['fPOTotal'];
      $nvldmsg['fPOTotal'] = $smarty->get_template_vars('LBL_PO_TOTAL')." ".$smarty->get_template_vars('LBL_MUST_BE_NUMERIC');
      }
      if(!in_array($smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_PRE_PAYMENT'),$resArr)) {
      $numdt['fPrepayment'] = $Data['fPrepayment'];
      $nvldmsg['fPrepayment'] = $smarty->get_template_vars('LBL_PRE_PAYMENT')." ".$smarty->get_template_vars('LBL_MUST_BE_NUMERIC');
      }
      if(!in_array($smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_BILL_TO')." ".$smarty->get_template_vars('LBL_CONTACT_TELEPHONE'),$resArr)) {
      $numdt['vBillToContactTelephone'] = str_replace('-','',$Data['vBillToContactTelephone']);
      $nvldmsg['vBillToContactTelephone'] = $smarty->get_template_vars('LBL_BILL_TO')." ".$smarty->get_template_vars('LBL_CONTACT_TELEPHONE')." ".$smarty->get_template_vars('LBL_MUST_BE_NUMERIC');
      } */

    $numdt['fVAT'] = $Data['fVAT'];
    $nvldmsg['fVAT'] = $smarty->get_template_vars('LBL_VAT') . " " . $smarty->get_template_vars('LBL_MUST_BE_NUMERIC');
    $numdt['fPOTotal'] = $Data['fPOTotal'];
    $nvldmsg['fPOTotal'] = $smarty->get_template_vars('LBL_PO_TOTAL') . " " . $smarty->get_template_vars('LBL_MUST_BE_NUMERIC');
    $numdt['fPrepayment'] = $Data['fPrepayment'];
    $nvldmsg['fPrepayment'] = $smarty->get_template_vars('LBL_PRE_PAYMENT') . " " . $smarty->get_template_vars('LBL_MUST_BE_NUMERIC');
    $numdt['vBillToContactTelephone'] = str_replace('-', '', $Data['vBillToContactTelephone']);
    $nvldmsg['vBillToContactTelephone'] = $smarty->get_template_vars('LBL_BILL_TO') . " " . $smarty->get_template_vars('LBL_CONTACT_TELEPHONE') . " " . $smarty->get_template_vars('LBL_MUST_BE_NUMERIC');
    if (count($numdt) > 0) {
        $nvld_ary = $validation->isNum($numdt, $nvldmsg, 'empty');
    }
    // prints($resArr); exit;
    // prints($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']); exit;
    // $resArr = $validation->isEmpty($RequiredFiledArr);
    if ($resArr || $nvld_ary == 'er') {
        header("Location:" . $_SERVER['HTTP_REFERER'] . "");
        exit;
    }
    ### ENDS HERE ###

    /* if(!isset($bnkObj)) {
      include_once(SITE_CLASS_APPLICATION."class.BankMaster.php");
      $bnkObj = new BankMaster();
      }
      $bnk_dtls = $bnkObj->getDetails('*', " AND iBankId=".$Data['iBankId']);
      $Data['vBankName'] = $bnk_dtls[0]['vBankName'];
      $Data['vSwiftCode'] = $bnk_dtls[0]['vSwiftCode']; */

    $iInvoiceID = $_POST['iInvoiceID'];
    $Data['iModifiedByID'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'];
    // prints($Data); exit;

    $stsdtls = $statusmasterObj->getDetails('*', " AND eFor='Invoice' AND vStatus_en='Rejected'");
    $sts = $stsdtls[0]['iStatusID'];
    // $invdt = $invOrdObj->select($iInvoiceID);
    $supplierOrgPrefDtls = $orgprefObj->getDetails('*', " AND iOrganizationID=" . $supplierOrgDtls[0]['iOrganizationID']);
    //if($totusrs > 1) {
    /* if($invdt[0]['iStatusID'] == $sts) {
      $invstatus = $supplierOrgPrefDtls[0]['vInvoiceStatusLevel'];
      if($supplierOrgPrefDtls[0]['eReqVerificationInv'] == 'Yes') {
      $Data['iStatusID'] = '0';
      } else{
      if(trim($invstatus) != '') {
      $invstatus = @explode(',',$invstatus);
      sort($invstatus);
      $Data['iStatusID'] = $invstatus[0];
      }
      }
      } */
    /* } else {
      $stsdtls =  $statusmasterObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Issued' ");
      $Data['iStatusID'] = $stsdtls[0]['iStatusID'];
      } */
    #Delete Invoice Order Attachment File [START]
    $deleteFiles = $_POST['deleteFiles'];
    $invAttachmentFiles = $invAttachmentObj->getDetails('vFile', " AND iAttachmentID in($deleteFiles)");
    $path = $cfgimg['INV']['docs']['path'] . "$iInvoiceID/";
    if (is_array($invAttachmentFiles) && count($invAttachmentFiles) > 0) {
        for ($i = 0; $i < count($invAttachmentFiles); $i++) {
            @unlink($path . $invAttachmentFiles[$i]['vFile']);
        }
        $invAttachmentObj->delete($deleteFiles);
        #Delete Purchase Order Attachment File [END]
    }
    /* if($Data['eSaved'] == 'Yes') {
      $stsdtls = $statusmasterObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Create' ");
      $Data['iStatusID'] = 0; 	// $stsdtls[0]['iStatusID'];
      } else if($invdt[0]['eSaved']=='Yes') {
      $sorgpfdt = $orgprefObj->getDetails('*'," AND iOrganizationID=".$invdt[0]['iSupplierOrganizationID']);
      if($sorgpfdt[0]['eReqVerificationInv'] == 'Yes') {
      $Data['iStatusID'] = 0;
      } else {
      $stsdtls = $statusmasterObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Create' ");
      $Data['iStatusID'] = $stsdtls[0]['iStatusID'];
      }
      } */

    if (!($invdt[0]['iBuyerOrganizationID'] == $curORGID && $invdt[0]['eCreateByBuyer'] == 'Yes')) {
        $stsdtls = $statusmasterObj->getDetails('*', " AND eFor='Invoice' AND vStatus_en='Create' ");
        $Data['iStatusID'] = $stsdtls[0]['iStatusID'];
    } else if ($invdt[0]['iBuyerOrganizationID'] == $curORGID && $invdt[0]['eCreateByBuyer'] == 'Yes') {
        $rstsdtls = $statusmasterObj->getDetails('*', " AND eFor='Invoice' AND vStatus_en='Rejected' ");
        $rjtsts = $rstsdtls[0]['iStatusID'];
        if ($invdt[0]['iaStatusID'] == $rjtsts) {
            $stsd = $statusmasterObj->getDetails('*', " AND eFor='Invoice' AND vStatus_en='Issued' ");
            $isusts = $stsd[0]['iStatusID'];
            $Data['iStatusID'] = $isusts;
            $Data['iaStatusID'] = 0;
        }
    }
    // pr($Data); exit;
    unset($Data['eFrom']);
    $id = $invOrdObj->updateData($Data, "iInvoiceID=$iInvoiceID");    
    if ($Data['eSaved'] != 'Yes' && $_SESSION['invadd'] != 'yes') {
        if ($id) {
            $sub1 = "Invoice Modified";
            $type = "Modified";
            $actn = "Modified";
            $sub2 = "Invoice Modified";
        }
    }
    if ($id) {
        $files = $_FILES['files'];
        $titles = $_POST['titles'];
        $descprtiption = $_POST['descriptions'];
        $dAdate = calcGTzTime(date('Y-m-d'), 'Y-m-d');
        if (trim($files['name'][0]) == '')
            unset($files['name'][0]);
        $fileData['iInvoiceID'] = $iInvoiceID;
        $fileData['eRelatedTo'] = 'Invoice';
        $fileData['dAdate'] = $dAdate;

        $fileUpload = array();
        for ($i = 0; $i < count($files['name']); $i++) {
            // $fileData['vTitle']=$titles[$i];
            // $fileData['tDescription']=$descprtiption[$i];
            $fileUpload['name'] = $files['name'][$i + 1];
            $fileUpload['tmp_name'] = $files['tmp_name'][$i + 1];
            $fileName = $imgObj->UploadFile('INV', 'docs', $iInvoiceID, $fileUpload, '');
            $fileData['vFile'] = $fileName;
            if ($fileName != '') {
                $invAttachmentObj->setAllVar($fileData);
                $invAttachmentObj->insert();
            }
        }
        $msg = "rus";
        $_SESSION['invadd'] = 'yes';
        // $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']=$msg;
        if ($Data['eSaved'] == 'Yes') {
            if ($invdt[0]['iBuyerOrganizationID'] == $curORGID && $invdt[0]['eCreateByBuyer'] == 'Yes') {
                $redirecturl = SITE_URL_DUM . 'invacptlist/' . $msg;
            } else {
                $redirecturl = SITE_URL_DUM . 'invoicelist/' . $msg;
            }
            if($eFrom == "Next"){
                $redirecturl = SITE_URL_DUM . 'invpref/' . $iInvoiceID . '/' . $msg;
            }
        } else {
            $redirecturl = SITE_URL_DUM . 'invpref/' . $iInvoiceID . '/' . $msg;
        }
    } else {
        $msg = "ruserr";
        //$redirecturl = SITE_URL_DUM."index.php?file=u-invoiceadditems&id=$iInvoiceID&msg=$msg";
        $redirecturl = SITE_URL_DUM . 'invoicelist/' . $msg;
    }
    $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_MSG'] = $msg;
    $id = $iInvoiceID;
} else if ($view == 'crtpo') {
    $iInvoiceID = $_POST['iInvoiceID'];
    $acptsts = $statusmasterObj->getDetails('*', " AND eFor='Invoice' AND vStatus_en='Accepted' ");
    $invdt = $invOrdObj->select($iInvoiceID);
    // prints($invdt); exit;
    if ($acptsts[0]['iStatusID'] == $invdt[0]['iStatusID'] && (trim($invdt[0]['iPurchaseOrderID']) == '' || trim($invdt[0]['iPurchaseOrderID']) < 1)) {
        // $vInvoiceCode = $generalobj->getUniqueCode(PRJ_DB_PREFIX."_inovice_order_heading","vInvoiceCode");
        $vPOCode = $pohObj->getUniqueCode();
        // $invdt = $pohObj->select($iPurchaseOrderID);
        //prints($vPOCode); exit;
        $splrorg = $orgObj->select($invdt[0]['iSupplierOrganizationID']);
        $splrpf = $orgprefObj->getDetails('*', " AND iOrganizationID=" . $invdt[0]['iSupplierOrganizationID']);
        $byrorg = $orgObj->select($invdt[0]['iBuyerOrganizationID']);
        $byrpf = $orgprefObj->getDetails('*', " AND iOrganizationID=" . $invdt[0]['iBuyerOrganizationID']);

        // prints($invdt); exit;
        $vPONumber = "PO" . $vPOCode . "-" . trim($invdt[0]['vAssociatePOBuyerCode']);
        $invdt[0]['vPONumber'] = $vPONumber;
        $invdt[0]['vPOCode'] = $vPOCode;
        // $invdt[0]['vInvoiceSupplierCode'] = $splrorg[0]['vOrganizationCode'];
        $invdt[0]['vBuyerCode'] = $invdt[0]['vAssociatePOBuyerCode'];
        $invdt[0]['fOther_tax_1'] = $invdt[0]['fOtherTax1'];
        $invdt[0]['vBuyerCompanyName'] = $invdt[0]['vBuyerName'];
        $invdt[0]['vBuyerContactName'] = $invdt[0]['vBuyerContactParty'];
        $invdt[0]['tOrderDescription'] = $invdt[0]['tInvoiceDescription'];
        $invdt[0]['fPOTotal'] = $invdt[0]['fInvoiceTotal'];
        $invdt[0]['vFromIP'] = $_SERVER['REMOTE_ADDR'];
        $invdt[0]['dCreateDate'] = $invdt[0]['dOrderDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
        $invdt[0]['iModifiedByID'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'];
        unset($invdt[0]['fOtherTax1']);
        unset($invdt[0]['vInvoiceNumber']);
        unset($invdt[0]['vInvoiceCode']);
        unset($invdt[0]['dCreatedDate']);
        // unset($invdt[0]['tCarrier']);
        // unset($invdt[0]['dOrderDate']);
        unset($invdt[0]['dVerifyDate']);
        // unset($invdt[0]['iModifiedByID']);
        unset($invdt[0]['vBuyerName']);
        unset($invdt[0]['vBuyerContactParty']);
        unset($invdt[0]['tInvoiceDescription']);
        unset($invdt[0]['iPurchaseOrderID']);
        unset($invdt[0]['fInvoiceTotal']);
        unset($invdt[0]['vAssociatePOBuyerCode']);
        unset($invdt[0]['vInvoiceSupplierCode']);
        $invdt = $invdt[0];

// 		$byrorg = $orgObj->select($invdt['iBuyerOrganizationID']);
//			$byrpf = $orgprefObj->getDetails('*'," AND iOrganizationID=".$invdt['iBuyerOrganizationID']);
        $postatus = $splrpf[0]['vOrderAcceptanceLevel'];
        $totusrs = $orgUsrObj->getDetails(" COUNT(*) as tot ", " AND iOrganizationID=$curORGID AND eUserType='User'");
        $totusrs = $totusrs[0]['tot'];
        //if($totusrs > 1) {
        /* if($byrpf[0]['eReqVerifyPoAcpt'] == 'Yes') {
          $invdt['iStatusID'] = '0';
          } else {
          if(trim($postatus) != '') {
          $postatus = @explode(',',$postatus);
          sort($postatus);
          $invdt['iStatusID'] = $postatus[0];
          }
          } */
        $pcstsdtls = $statusmasterObj->getDetails('*', " AND eFor='PO' AND vStatus_en='Create' ");
        $invdt['iStatusID'] = $pcstsdtls[0]['iStatusID'];
        /* } else {
          $poisusts = $statusmasterObj->getDetails('*'," AND eFor='PO' AND vStatus_en='Issued' ");
          $invdt['iStatusID'] = $poisusts[0];
          } */

        // prints($invdt); exit;
        $pohObj->setAllVar($invdt);
        $po = $pohObj->insert();
        $poitems = $invLineObj->getDetails('*', " AND iInvoiceID=$iInvoiceID");
        // prints($poitems); exit;
        for ($l = 0; $l < count($poitems); $l++) {
            $invItems = $poitems[$l];
            $invItems['iRelatedInvoiceLineID'] = $invItems['iInvoiceLineID'];
            unset($invItems['iInvoiceLineID']);
            unset($invItems['dCreatedDate']);
            unset($invItems['iRelatedPurchaseOrderLineID']);
            // $vItemCode = $invItems['vItemCode'];
            // prints($vItemCode); exit;
            // $invitmdtl = $invLineObj->getDetails('*'," AND vItemCode=$vItemCode");
            /* if(count($invitmdtl) > 0) {
              $vItemCode = $generalobj->getUniqueCode(PRJ_DB_PREFIX."_invoice_detail_line","vItemCode");
              } */
            $vItemCode = $poLineObj->getUniqueCode();
            $vPOItemLineNumber = $generalobj->UniqueID("", PRJ_DB_PREFIX . "_purchase_order_line", "iLineNumber", $charlimit = "10");
            $invItems['vItemCode'] = $vItemCode;
            $invItems['iLineNumber'] = $vPOItemLineNumber;
            $invItems['dETA'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
            $invItems['iPurchaseOrderID'] = $po;
            // prints($invItems); exit;
            $poLineObj->setAllVar($invItems);
            $itm = $poLineObj->insert();
        }
    }
// mail
    if ($po > 0) {
        $sub1 = "Purchase Order Created";
        $type = "Create";
        $actn = "Create";
        $sub2 = "New Purchase Order";

        $dt['iItemID'] = $po;
        $dt['eSubject'] = $sub1;
        $dt['eType'] = $type;
        $where = "AND vType='$sub1' AND eSection='Member'";
        $db_email = $emailObj->getDetails('*', $where);
        $invdt = $pohObj->select($po);

        $orgpref = $orgprefObj->getStatusDetails($invdt[0]['iBuyerOrganizationID']);
        $orginvstatus = $orgpref['po'];

        $orgusrs = $orgUsrObj->getDetails('*', " AND iOrganizationID=" . $invdt[0]['iBuyerOrganizationID']);

        $stsdtls = $statusmasterObj->getDetails('*', " AND eFor='PO' AND vStatus_en='Rejected' ");
        $rjtsts = $stsdtls[0]['iStatusID'];
        $stsdtls = $statusmasterObj->getDetails('*', " AND eFor='PO' AND vStatus_en='Accepted' ");
        $acptsts = $stsdtls;
        $lang = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_LANG'];
        $stsdtls = $statusmasterObj->getDetails("*, vStatusMsg_$lang as vStatusMsg", " AND eFor='PO' AND vStatus_en='Issued' ");
        $isusts = $stsdtls;

        /* if($invdt[0]['iStatusID'] != $isusts[0]['iStatusID']) {
          if(count($orgusrs) > 1 && $invdt[0]['iStatusID'] != $acptsts[0]['iStatusID'] ) {
          for($l=0;$l<count($orginvstatus);$l++) {
          $nxtlevel = '1';
          if($invdt[0]['iStatusID'] == $orginvstatus[$l]['iStatusID']) {
          if(isset($orginvstatus[$l+1]))
          $nxtstatus = $orginvstatus[$l+1];
          else
          $nxtstatus = $orginvstatus[$l];
          }
          }
          } else {
          $nxtstatus = $isusts[0];
          }
          } */

        if ($invdt[0]['iInvoiceID'] > 0) {
            $orgpref = $orgprefObj->getStatusDetails($invdt[0]['iSupplierOrganizationID'], 'acceptance');
            $mchpref = $orgprefObj->getStatusDetails($invdt[0]['iBuyerOrganizationID']);
            $mth = array();
            for ($l = 0; $l < count($mchpref['inv']); $l++) {
                $mth[] = $mchpref['inv'][$l]['iStatusID'];
            }
            $orginvstatus = $orgpref['inv'];
            for ($l = 0; $l < count($orginvstatus); $l++) {
                if ($orginvstatus[$l]['iStatusID'] > $invdt[0]['iStatusID'] && in_array($orginvstatus[$l]['iStatusID'], $mth)) {
                    $nxtstatus = $orginvstatus[$l];
                    break;
                }
            }
        } else {
            $nxtstatus['iStatusID'] = '0';
        }

        $sts = $nxtstatus['iStatusID'];  //	$invdt[0]['iStatusID'];
        $usrarr = $orgUsrObj->getPermittedUsers($invdt[0]['iBuyerOrganizationID'], $sts, 'inv', 'acpt');

        $link = SITE_URL . "purchaseorderview/" . $po;
        // $body = Array("#SITE_NAME#","#INVCODE#","#SUPPLIERORG#","#SUPORGCODE#","#BUYERORG#","#BUYORGCODE#","#LINK#");
        // $post = Array($SITE_NAME,$invdt[0]['vInvoiceCode'],$invdt[0]['vSupplierName'],$invdt[0]['vInvoiceSupplierCode'],$invdt[0]['vBuyerName'],$invdt[0]['vAssociatePOBuyerCode'],$link);

        $body = Array("#ADDED_BY#", "#POCODE#", "#SUPPLIERORG#", "#SUPORGCODE#", "#BUYERORG#", "#BUYORGCODE#", "#LINK#");
        $post = Array($sess_user_name . "($sess_usertype_short)", $invdt[0]['vPOCode'], $invdt[0]['vSupplierName'], $splrorg[0]['vOrganizationCode'], $invdt[0]['vBuyerCompanyName'], $invdt[0]['vBuyerCode'], $link);

        $rplarr = Array("Hello #NAME#,", "background-color: rgb(239, 239, 239);", "Regards,", "#MAIL_FOOTER#", "#SITE_URL#");
        $tbody_en = str_replace($rplarr, " ", $db_email[0]['tBody_en']);
        $emailContent_en = trim(str_replace($body, $post, $tbody_en));
        $tbody_fr = str_replace($rplarr, " ", $db_email[0]['tBody_fr']);
        $emailContent_fr = trim(str_replace($body, $post, $tbody_fr));

        $dt['iOrganizationID'] = $curORGID;  // $invdt[0]['iBuyerOrganizationID'];
        $dt['vMailSubject_en'] = $db_email[0]['vSub_en'];
        $dt['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
        $dt['tMailContent_en'] = $emailContent_en;
        $dt['tMailContent_fr'] = $emailContent_fr;
        $dt['eSubject'] = "PO";
        $dt['iCreatedBy'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'];
        $dt['eCreatedType'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_USER_TYPE_SHORT'];
        $dt['dActionDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
        $userActionObj->setAllVar($dt);
        $userActionObj->insert();

        //$body_arr = Array("#NAME#","#SITE_NAME#","#INVCODE#","#SUPPLIERORG#","#SUPORGCODE#","#BUYERORG#","#BUYORGCODE#","#LINK#","#MAIL_FOOTER#","#SITE_URL#");
        $body_arr = Array("#NAME#", "#ADDED_BY#", "#POCODE#", "#SUPPLIERORG#", "#SUPORGCODE#", "#BUYERORG#", "#BUYORGCODE#", "#LINK#", "#MAIL_FOOTER#", "#SITE_URL#");
        if ((is_array($emailArr) && count($emailArr) > 0)) {
            for ($i = 0; $i < count($emailArr); $i++) {
                $smname = $emailArr[$i]['vFirstName'] . ' ' . $emailArr[$i]['vLastName'];
                $email = $emailArr[$i]['vEmail'];
                $post_arr = Array($smname, $sess_user_name . "($sess_usertype_short)", $invdt[0]['vPOCode'], $invdt[0]['vSupplierName'], $splrorg[0]['vOrganizationCode'], $invdt[0]['vBuyerCompanyName'], $invdt[0]['vBuyerCode'], $link, $MAIL_FOOTER, SITE_URL);
                $sendMail->Send($sub1, "Member", $email, $body_arr, $post_arr);
            }
        }
        if ((is_array($usrarr) && count($usrarr) > 0)) {
            for ($i = 0; $i < count($usrarr); $i++) {
                $smname = $usrarr[$i]['vFirstName'] . ' ' . $usrarr[$i]['vLastName'];
                $email = $usrarr[$i]['vEmail'];
                $post_arr = Array($smname, $SITE_NAME, $invdt[0]['vPOCode'], $invdt[0]['vSupplierName'], $splrorg[0]['vOrganizationCode'], $invdt[0]['vBuyerCompanyName'], $invdt[0]['vBuyerCode'], $link, $MAIL_FOOTER, SITE_URL);
                $sendMail->Send($sub2, "Member", $email, $body_arr, $post_arr);
            }
        }
    }
//
    // exit;
    $msg = 'pocr';
    $redirecturl = SITE_URL_DUM . "poacptlist/" . $msg;
    $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_MSG'] = $msg;
    header("Location:" . $redirecturl);
    exit;
}

if ($Data['eSaved'] != 'Yes' || $sub1 == "New Invoice Created") {
    if ($id && trim($sub1) != '') {
        $dt = array();
        $dt['iItemID'] = $id;
        $dt['eSubject'] = $sub1;
        $dt['eType'] = $type;
        $dt['vAction'] = $actn;
        $where = "AND vType='$sub1' AND eSection='Member'";
        $db_email = $emailObj->getDetails('*', $where);
        $invdt = $invOrdObj->select($id);

        $orgpref = $orgprefObj->getStatusDetails($invdt[0]['iSupplierOrganizationID']);
        $orginvstatus = $orgpref['inv'];

        $orgusrs = $orgUsrObj->getDetails('*', " AND iOrganizationID=" . $invdt[0]['iSupplierOrganizationID']);

        $stsdtls = $statusmasterObj->getDetails('*', " AND eFor='Invoice' AND vStatus_en='Rejected' ");
        $rjtsts = $stsdtls[0]['iStatusID'];
        $stsdtls = $statusmasterObj->getDetails('*', " AND eFor='Invoice' AND vStatus_en='Accepted' ");
        $acptsts = $stsdtls;
        $lang = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_LANG'];
        $stsdtls = $statusmasterObj->getDetails("*, vStatusMsg_$lang as vStatusMsg", " AND eFor='Invoice' AND vStatus_en='Issued' ");
        $isusts = $stsdtls;

        if ($invdt[0]['iStatusID'] != $isusts[0]['iStatusID']) {
            if (count($orgusrs) > 1 && $invdt[0]['iStatusID'] != $acptsts[0]['iStatusID']) {
                for ($l = 0; $l < count($orginvstatus); $l++) {
                    $nxtlevel = '1';
                    if ($invdt[0]['iStatusID'] == $orginvstatus[$l]['iStatusID']) {
                        if (isset($orginvstatus[$l + 1]))
                            $nxtstatus = $orginvstatus[$l + 1];
                        else
                            $nxtstatus = $orginvstatus[$l];
                    }
                }
            } else {
                $nxtstatus = $isusts[0];
            }
        }

        if ($invdt[0]['iPurchaseOrderID'] > 0) {
            $orgpref = $orgprefObj->getStatusDetails($invdt[0]['iBuyerOrganizationID'], 'acceptance');
            $mchpref = $orgprefObj->getStatusDetails($invdt[0]['iSupplierOrganizationID']);
            $mth = array();
            for ($l = 0; $l < count($mchpref['inv']); $l++) {
                $mth[] = $mchpref['inv'][$l]['iStatusID'];
            }
            $orginvstatus = $orgpref['inv'];
            for ($l = 0; $l < count($orginvstatus); $l++) {
                if ($orginvstatus[$l]['iStatusID'] > $invdt[0]['iStatusID'] && in_array($orginvstatus[$l]['iStatusID'], $mth)) {
                    $nxtstatus = $orginvstatus[$l];
                    break;
                }
            }
        }

        if ($curORGID == $invdt[0]['iBuyerOrganizationID'] && $invdt[0]['iStatusID'] >= $isusts[0]['iStatusID']) {
            $sorgprfdt = $orgprefObj->getDetails("*", " AND iOrganizationID=" . $invdt[0]['iBuyerOrganizationID']);
            if ($sorgprfdt[0]['eReqVerifyInvAcpt'] == 'Yes') {
                $iss = $statusmasterObj->getDetails("*, vStatusMsg_$lang as vStatusMsg", " AND eFor='Invoice' AND vStatus_en='Verify' ");
            } else {
                $iss = $statusmasterObj->getDetails("*, vStatusMsg_$lang as vStatusMsg", " AND eFor='Invoice' AND vStatus_en='Issue' ");
            }
            $usrarr = $orgUsrObj->getPermittedUsers($podt[0]['iBuyerOrganizationID'], $iss[0]['iStatusID'], 'inv', 'acpt');
        } else {
            $sts = $nxtstatus['iStatusID'];  //	$invdt[0]['iStatusID'];
            $usrarr = $orgUsrObj->getPermittedUsers($invdt[0]['iSupplierOrganizationID'], $sts, 'inv');
        }

        $link = SITE_URL_DUM . "invoiceview/" . $id;
        if ($sub1 == 'New Invoice Created') {
            $body = Array("#ADDED_BY#", "#INVCODE#", "#SUPPLIERORG#", "#SUPORGCODE#", "#BUYERORG#", "#BUYORGCODE#", "#LINK#");
        } else {
            $body = Array("#MODIFIED_BY#", "#INVCODE#", "#SUPPLIERORG#", "#SUPORGCODE#", "#BUYERORG#", "#BUYORGCODE#", "#LINK#");
        }
        $post = Array($sess_user_name . "($sess_usertype_short)", $invdt[0]['vInvSupplierCode'], $invdt[0]['vSupplierName'], $invdt[0]['vInvoiceSupplierCode'], $invdt[0]['vBuyerName'], $invdt[0]['vAssociatePOBuyerCode'], $link);

        $rplarr = Array("Hello #NAME#,", "background-color: rgb(239, 239, 239);", "Regards,", "#MAIL_FOOTER#", "#SITE_URL#");
        $tbody_en = str_replace($rplarr, " ", $db_email[0]['tBody_en']);
        $emailContent_en = trim(str_replace($body, $post, $tbody_en));
        $tbody_fr = str_replace($rplarr, " ", $db_email[0]['tBody_fr']);
        $emailContent_fr = trim(str_replace($body, $post, $tbody_fr));

        if ($vorgid > 0) {
            $dt['iOrganizationID'] = $curORGID;  // $vorgid; 	// $invdt[0]['iBuyerOrganizationID'];
        } else {
            $dt['iOrganizationID'] = $curORGID;  // $invdt[0]['iSupplierOrganizationID'];
        }
        $dt['vMailSubject_en'] = $db_email[0]['vSub_en'];
        $dt['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
        $dt['tMailContent_en'] = $emailContent_en;
        $dt['tMailContent_fr'] = $emailContent_fr;
        $dt['eSubject'] = "Invoice";
        $dt['iCreatedBy'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'];
        $dt['eCreatedType'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_USER_TYPE_SHORT'];
        $dt['dActionDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
        //$userActionObj->setAllVar($dt);
        $userActionObj->insert($dt);
        // prints($dt); exit;

        if ($sfmail == 'yes') {
            if (!isset($ioaObj)) {
                include_once(SITE_CLASS_APPLICATION . "user/class.InvoiceOrderAttachment.php");
                $ioaObj = new InvoiceOrderAttachment();
            }
            $inv_attach = $ioaObj->getDetails('*', " AND iInvoiceID=$id");  // $iInvoiceID
            if (is_array($inv_attach) && count($inv_attach) > 0) {
                for ($l = 0; $l < count($inv_attach); $l++) {
                    $filepath = $generalobj->GetImagePath(array('section' => 'INV', 'type' => 'docs', 'id' => $id, 'name' => $inv_attach[$l]['vFile']));
                    // prints($filepath); exit;
                    if (file_exists($filepath)) {
                        $attachments[$l]['path'] = $filepath;
                        $attachments[$l]['name'] = $inv_attach[$l]['vFile'];
                    }
                    // $sendMail->SendWithAttachments($sub1,"Member",$email,$body_arr,$post_arr,$SITE_NAME,$sub2,'No',$attachments);
                }
            }
        }

        if ($sub1 == 'New Invoice Created') {
            $body_arr = Array("#NAME#", "#ADDED_BY#", "#INVCODE#", "#SUPPLIERORG#", "#SUPORGCODE#", "#BUYERORG#", "#BUYORGCODE#", "#LINK#", "#MAIL_FOOTER#", "#SITE_URL#");
        } else {
            $body_arr = Array("#NAME#", "#MODIFIED_BY#", "#INVCODE#", "#SUPPLIERORG#", "#SUPORGCODE#", "#BUYERORG#", "#BUYORGCODE#", "#LINK#", "#MAIL_FOOTER#", "#SITE_URL#");
        }
        if (is_array($emailArr) && count($emailArr) > 0) {
            for ($i = 0; $i < count($emailArr); $i++) {
                $smname = $emailArr[$i]['vFirstName'] . ' ' . $emailArr[$i]['vLastName'];
                $email = $emailArr[$i]['vEmail'];
                $post_arr = Array($smname, $sess_user_name . "($sess_usertype_short)", $invdt[0]['vInvSupplierCode'], $invdt[0]['vSupplierName'], $invdt[0]['vInvoiceSupplierCode'], $invdt[0]['vBuyerName'], $invdt[0]['vAssociatePOBuyerCode'], $link, $MAIL_FOOTER, SITE_URL);
                if ($sfmail == 'yes' && is_array($attachments) && count($attachments) > 0) {
                    $sendMail->SendWithAttachments($sub1, "Member", $email, $body_arr, $post_arr, $SITE_NAME, $sub1, 'No', $attachments);
                } else {
                    $sendMail->Send($sub1, "Member", $email, $body_arr, $post_arr);
                }
            }
        }
        if (is_array($usrarr) && count($usrarr) > 0) {
            for ($i = 0; $i < count($usrarr); $i++) {
                $smname = $usrarr[$i]['vFirstName'] . ' ' . $usrarr[$i]['vLastName'];
                $email = $usrarr[$i]['vEmail'];
                $post_arr = Array($smname, $sess_user_name . "($sess_usertype_short)", $invdt[0]['vInvSupplierCode'], $invdt[0]['vSupplierName'], $invdt[0]['vInvoiceSupplierCode'], $invdt[0]['vBuyerName'], $invdt[0]['vAssociatePOBuyerCode'], $link, $MAIL_FOOTER, SITE_URL);
                if ($sfmail == 'yes' && is_array($attachments) && count($attachments) > 0) {
                    $sendMail->SendWithAttachments($sub2, "Member", $email, $body_arr, $post_arr, $SITE_NAME, $sub2, 'No', $attachments);
                } else {
                    $sendMail->Send($sub2, "Member", $email, $body_arr, $post_arr);
                }
            }
        }
    }
}

header('Location:' . $redirecturl);
exit;
?>