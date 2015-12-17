<?php

if (!isset($pohObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.PurchaseOrderHeading.php");
    $pohObj = new PurchaseOrderHeading();
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
if (!isset($iohObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.InvoiceOrderHeading.php");
    $iohObj = new InvoiceOrderHeading();
}
if (!isset($invLineObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.InvoiceDetailLine.php");
    $invLineObj = new InvoiceDetailLine();
}
if (!isset($poLineObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.PurchaseOrderLine.php");
    $poLineObj = new PurchaseOrderLine();
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
if (!isset($imgObj)) {
    include_once(SITE_CLASS_GEN . "class.imagecrop.php");
    $imgObj = new imagecrop();
}
if (!isset($poAttachmentObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.PurchaseOrderAttachment.php");
    $poAttachmentObj = new PurchaseOrderAttachment();
}
if (!isset($poprefObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.PoOtherInformation.php");
    $poprefObj = new PoOtherInformation();
}
if (!isset($ioprefObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.InvoiceOtherInformation.php");
    $ioprefObj = new InvoiceOtherInformation();
}

$poisu = $statusmasterObj->getDetails('iStatusID', " AND eFor='PO' AND (vStatus_en='Auth1' || vStatus_en='Auth2' || vStatus_en='Auth3') ");
// prints($poisu); exit;

$totusrs = $orgUsrObj->getDetails(" COUNT(*) as tot ", " AND iOrganizationID=$curORGID AND eUserType='User'");
$totusrs = $totusrs[0]['tot'];

$ordt = $orgUsrObj->getDetails('*', " AND iOrganizationID=$curORGID AND eUserType='Admin' AND eStatus='Active'");
$org = $orgObj->select($curORGID);
$smdt = $secManObj->getDetails('*', " AND iASMID=" . $org[0]['iASMID'] . " AND eStatus='Active'");
// $jtbl = " LEFT JOIN b2b_organization_user_permission up on ou.iUserID=up.iUserID ";
// $usreml = $orgUsrObj->getJoinTableInfo($jtbl,'*'," AND ou.iOrganizationID=$curORGID AND ou.iUserID!=$sess_id AND ou.eUserType='User' AND ou.eStatus='Active' AND (up.tPermission LIKE '%po:%".$poisu[0]['iStatusID']."%' OR up.tPermission LIKE '%po:%".$poisu[1]['iStatusID']."%' OR up.tPermission LIKE '%po:%".$poisu[2]['iStatusID']."%')");
// prints($usreml); exit;

if (is_array($smdt) && is_array($ordt)) {
    $emailArr = array_merge($smdt, $ordt);
} else if (is_array($smdt)) {
    $emailArr = $smdt;
} else if (is_array($ordt)) {
    $emailArr = $ordt;
}
/* if(is_array($smdt) && is_array($ordt) && is_array($usreml)) {
  $emailArr = array_merge($smdt,$ordt,$usreml);
  } else if(is_array($smdt) && is_array($ordt) ) {
  $emailArr = array_merge($smdt,$ordt);
  // $emailArr = $smdt;
  } else if(is_array($smdt) && is_array($usreml) ) {
  $emailArr = array_merge($smdt,$usreml);
  // $emailArr = $smdt;
  } else if(is_array($ordt) && is_array($usreml) ) {
  $emailArr = array_merge($ordt,$usreml);
  // $emailArr = $smdt;
  } else if(is_array($smdt)) {
  $emailArr = $smdt;
  } else if(is_array($ordt)) {
  $emailArr = $ordt;
  } else if(is_array($usreml)) {
  $emailArr = $usreml;
  } */
// prints($emailArr); exit;
//print_r($orgUserObj);
$Data = $_POST['Data'];
$eFrom = $Data['eFrom'];
unset($Data['eFrom']);
$generalobj->getRequestVars();
$Data['vBillToContactTelephone'] = $_POST['vBillToContactTelephoneCode'] . "-" . $Data['vBillToContactTelephone'];
$Data['vShipToContactTelephone'] = $_POST['vShipToContactTelephoneCode'] . "-" . $Data['vShipToContactTelephone'];
$view = $_POST['view'];
$iInvoiceID = $_POST['iInvoiceID'];

$buyerOrgDtls = $orgObj->select($curORGID);
// $Data['iInvoiceID'] = $iInvoiceID;
$Data['vBuyerCode'] = $buyerOrgDtls[0]['vOrganizationCode'];
$Data['vBuyerCompanyName'] = $buyerOrgDtls[0]['vCompanyName'];
$Data['iBuyerID'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'];
$Data['iBuyerOrganizationID'] = $curORGID;
$Data['vBuyerContactName'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_USER_NAME'];
$Data['vBuyerContactTelephone'] = $buyerOrgDtls[0]['vPhone'];
$Data['vBuyerContactEmail'] = $buyerOrgDtls[0]['vEmail'];
// ($buyerOrgDtls);exit;
$supplierOrgDtls = $orgObj->select($Data['iSupplierOrganizationID']);
$Data['vSupplierAddLine1'] = $supplierOrgDtls[0]['vAddressLine1'];
$Data['vSupplierAddLine2'] = $supplierOrgDtls[0]['vAddressLine2'];
$Data['vSupplierZipCode'] = $supplierOrgDtls[0]['vZipcode'];
$Data['vSupplierName'] = $supplierOrgDtls[0]['vCompanyName'];
$Data['vSupplierState'] = $supplierOrgDtls[0]['vState'];
$Data['vSupplierCountry'] = $supplierOrgDtls[0]['vCountry'];
$Data['vSupplierContactTelephone'] = $supplierOrgDtls[0]['vPhone'];
// $Data['vSupplierContactParty'] = $Data['supplierID'];
// unset($Data['supplierID']);

if ($Data['eSaved'] != 'Yes')
    $Data['eSaved'] = 'No';
if ($Data['eSaved'] == 'Yes') {
    //
}


if ($view == '' || $view == 'add') {

    ### SERVER SIDE VALIDATION ####
    include(SITE_CLASS_GEN . "class.validation.php");
    $validation = new Validation();
    $RequiredFiledArr = array(
        'iSupplierOrganizationID' => $smarty->get_template_vars('LBL_SELECT') . " " . $smarty->get_template_vars('LBL_SUPPLIER') . " " . $smarty->get_template_vars('LBL_COMPANY'),
        'vSupplierContactParty' => $smarty->get_template_vars('LBL_SELECT') . " " . $smarty->get_template_vars('LBL_SUPPLIER') . " " . $smarty->get_template_vars('LBL_CONTACT_PARTY'),
        // 'vRegisterNumber'      		=> $smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_REFERENCE_NUMBER'),
        // 'iOpeningUnit'             => $smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_OPENING_UNIT'),
        'eLineItemTax' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_LINE_ITEM_TAX'),
        // 'fVAT'           				=> $smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_VAT'),
        'vShipToParty' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_SHIP_TO') . " " . $smarty->get_template_vars('LBL_PARTY'),
        'vShipToAddressLine1' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_SHIP_TO') . " " . $smarty->get_template_vars('LBL_ADDR_LINE') . "1",
        'vShipToCity' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_SHIP_TO') . " " . $smarty->get_template_vars('LBL_CITY'),
        'vShipToCountry' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_SHIP_TO') . " " . $smarty->get_template_vars('LBL_COUNTRY'),
        'vShipToState' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_SHIP_TO') . " " . $smarty->get_template_vars('LBL_STATE'),
        'vShipToZipCode' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_SHIP_TO') . " " . $smarty->get_template_vars('LBL_ZIP_CODE'),
        'vShipToContactParty' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_SHIP_TO') . " " . $smarty->get_template_vars('LBL_CONTACT_PARTY'),
        'vShipToContactTelephoneCode' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_SHIP_TO') . " " . $smarty->get_template_vars('LBL_CONTACT_TELEPHONE') . " " . $smarty->get_template_vars('LBL_CODE'),
        'vShipToContactTelephone' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_SHIP_TO') . " " . $smarty->get_template_vars('LBL_CONTACT_TELEPHONE'),
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
            //'fPOTotal' 						=> $smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_PO_TOTAL'),
            //'fPrepayment' 					=> $smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_PRE_PAYMENT')
    );
    $resArr = $validation->isEmpty($RequiredFiledArr);
    $numdt = array();
    if (!is_array($resArr)) {
        $resArr = array();
    }

    //$numdt['iOpeningUnit'] = $Data['iOpeningUnit'];
    // $nvldmsg['iOpeningUnit'] = $smarty->get_template_vars('LBL_PRE_PAYMENT')." ".$smarty->get_template_vars('LBL_MUST_BE_NUMERIC');
    $numdt['fVAT'] = $Data['fVAT'];
    $nvldmsg['fVAT'] = $smarty->get_template_vars('LBL_VAT') . " " . $smarty->get_template_vars('LBL_MUST_BE_NUMERIC');
    $numdt['fPOTotal'] = $Data['fPOTotal'];
    $nvldmsg['fPOTotal'] = $smarty->get_template_vars('LBL_PO_TOTAL') . " " . $smarty->get_template_vars('LBL_MUST_BE_NUMERIC');
    $numdt['fPrepayment'] = $Data['fPrepayment'];
    $nvldmsg['fPrepayment'] = $smarty->get_template_vars('LBL_PRE_PAYMENT') . " " . $smarty->get_template_vars('LBL_MUST_BE_NUMERIC');
    $numdt['vShipToContactTelephone'] = str_replace('-', '', $Data['vShipToContactTelephone']);
    $nvldmsg['vShipToContactTelephone'] = $smarty->get_template_vars('LBL_SHIP_TO') . " " . $smarty->get_template_vars('LBL_CONTACT_TELEPHONE') . " " . $smarty->get_template_vars('LBL_MUST_BE_NUMERIC');
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

    $Data['dCreateDate'] = $Data['dOrderDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
    $Data['vFromIP'] = $_SERVER['REMOTE_ADDR'];
    $Data['iModifiedByID'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'];
    $buyerOrgPrefDtls = $orgprefObj->getDetails('*', " AND iOrganizationID=" . $buyerOrgDtls[0]['iOrganizationID']);
    // prints($buyerOrgPrefDtls); exit;
    //if($totusrs > 1) {
    $stsdtls = $statusmasterObj->getDetails('*', " AND eFor='PO' AND vStatus_en='Create' ");
    $Data['iStatusID'] = $stsdtls[0]['iStatusID'];
    $postatus = $buyerOrgPrefDtls[0]['vOrderStatusLevel'];
    /* if($buyerOrgPrefDtls[0]['eReqVerificationPo'] == 'Yes') {
      $Data['iStatusID'] = '0';
      } else {
      if(trim($postatus) != '') {
      $postatus = @explode(',',$postatus);
      sort($postatus);
      $Data['iStatusID'] = $postatus[0];
      }
      }
      if($Data['eSaved'] == 'Yes') {
      // $stsdtls = $statusmasterObj->getDetails('*'," AND eFor='PO' AND vStatus_en='Create' ");
      // $Data['iStatusID'] = $stsdtls[0]['iStatusID'];
      } */
    /* } else {
      if($Data['eSaved'] == 'Yes') {
      $stsdtls = $statusmasterObj->getDetails('*'," AND eFor='PO' AND vStatus_en='Create' ");
      } else {
      $stsdtls = $statusmasterObj->getDetails('*'," AND eFor='PO' AND vStatus_en='Issued' ");
      }
      $Data['iStatusID'] = $stsdtls[0]['iStatusID'];
      } */

    // $vPONumber = $generalobj->UniqueID("PO",PRJ_DB_PREFIX."_purchase_order_heading","vPONumber",$charlimit="7");
    // $vPOCode = $generalobj->UniqueID("PO",PRJ_DB_PREFIX."_purchase_order_heading","vPOCode",$charlimit="10");
    $vPOCode = $pohObj->getUniqueCode();
    $Data['vPOCode'] = $vPOCode;
    $vPONumber = "PO" . $Data['vPOCode'] . "-" . trim($Data['vBuyerCode']);
    $Data['vPONumber'] = $vPONumber;
    $Data['eDelete'] = 'No';
    $Data['eRfq2Awarded'] = 'No';
    $dOrderDate = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
    $Data['dOrderDate'] = $dOrderDate;
    $pohObj->setAllVar($Data);
    $id = $pohObj->insert();

    if ($id) {
        $files = $_FILES['files'];
        $titles = $_POST['titles'];
        $descprtiption = $_POST['descriptions'];
        $dAdate = calcGTzTime(date('Y-m-d'), 'Y-m-d');
        if (trim($files['name'][0]) == '')
            unset($files['name'][0]);
        $fileData['iPurchaseOrderID'] = $id;
        $fileData['eRelatedTo'] = 'PO';
        $fileData['dAdate'] = $dAdate;

        $fileUpload = array();
        for ($i = 0; $i < count($files['name']); $i++) {
            // $fileData['vTitle']=$titles[$i];
            // $fileData['tDescription']=$descprtiption[$i];
            $fileUpload['name'] = $files['name'][$i + 1];
            $fileUpload['tmp_name'] = $files['tmp_name'][$i + 1];
            $fileName = $imgObj->UploadFile('PO', 'docs', $id, $fileUpload, '');
            $fileData['vFile'] = $fileName;
            if ($fileName != '') {
                $poAttachmentObj->setAllVar($fileData);
                $poAttachmentObj->insert();
            }
        }
        $msg = "ras";
        $_SESSION['poadd'] = 'yes';
        $redirecturl = SITE_URL_DUM . "popref/$id/" . $msg;
    } else {
        $msg = "raserr";
        $redirecturl = SITE_URL_DUM . 'polist/' . $msg;
    }

    //if($Data['eSaved']!='Yes')
    //{
    if ($id) {
        $sub1 = "Purchase Order Created";
        $type = "Create";
        $actn = "Create";
        $sub2 = "New Purchase Order";
    }
    //}
    if ($Data['eSaved'] == 'Yes') {
        if($eFrom == "Next"){
            $redirecturl = SITE_URL . "index.php?file=u-popref&id=$id&msg=$msg";
        }else{
            $redirecturl = SITE_URL . "index.php?file=u-polist&msg=$msg";
        }        
    } else {
        $redirecturl = SITE_URL . "index.php?file=u-popref&id=$id&msg=$msg";
    }
    $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_MSG'] = $msg;
} else if ($view == 'verify') {
    // prints($_POST); exit;
    $dt = array();
    $eDelete = $_POST['edelete'];
    $iPurchaseOrderID = $_POST['iPOID'];
    if ($eDelete == 'Yes') {
        $pohObj->delete($iPurchaseOrderID);
        $msg = "rds";
        $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_MSG'] = $msg;
        header("location:" . SITE_URL_DUM . 'polist/' . $msg);
        exit;
    }
    $nstatus = $_POST['nstatus'];

    $podtl = $pohObj->select($iPurchaseOrderID);
    //if($totusrs > 1) {
    $stsdtls = $statusmasterObj->getDetails('*', " AND eFor='PO' AND vStatus_en='Issued' ");
    $isusts = $stsdtls[0]['iStatusID'];
    $iprvsts = "";
    $orgposl = @explode(",", $opf[0]['vOrderStatusLevel']);
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
    // prints($dt['iStatusID']); exit;
    /* } else {
      $stsdtls =  $statusmasterObj->getDetails('*'," AND eFor='PO' AND vStatus_en='Issued' ");
      $isusts = $stsdtls[0]['iStatusID'];
      if($podtl[0]['iSupplierOrganizationID']==$curORGID && $podtl[0]['iStatusID']==$isusts) {
      $acptsts =  $statusmasterObj->getDetails('*'," AND eFor='PO' AND vStatus_en='Accepted' ");
      $dt['iStatusID'] = $acptsts[0]['iStatusID'];
      } else {
      // $stsdtls =  $statusmasterObj->getDetails('*'," AND eFor='PO' AND vStatus_en='Issued' ");
      $dt['iStatusID'] = $isusts;
      }
      } */
    $stsdtls = $statusmasterObj->getDetails('*', " AND eFor='PO' AND vStatus_en='Issued' ");
    $isusts = $stsdtls[0]['iStatusID'];
    $acptsts = $statusmasterObj->getDetails('*', " AND eFor='PO' AND vStatus_en='Accepted' ");
    $acptsts = $acptsts[0]['iStatusID'];
    $rsts = $statusmasterObj->getDetails('*', " AND eFor='PO' AND vStatus_en='Rejected' ");
    $rsts = $rsts[0]['iStatusID'];
    $cstsdtl = $statusmasterObj->getDetails('*', " AND eFor='PO' AND vStatus_en='Create' ");
    if ($dt['iStatusID'] == $isusts) {
        $sorgpfdt = $orgprefObj->getDetails('*', " AND iOrganizationID=" . $podtl[0]['iSupplierOrganizationID']);
        //if($sorgpfdt[0]['eReqVerifyPoAcpt'] != 'Yes') {
        $dt['iaStatusID'] = 0;  // $cstsdtl[0]['iStatusID'];
        //}
    //
	}

    if ($podtl[0]['iStatusID'] == $isusts) {
        $stsdtls = $statusmasterObj->getDetails('*', " AND eFor='PO' AND vStatus_en='Issued' ");
        $isusts = $stsdtls[0]['iStatusID'];
        $iprvsts = "";
        $orgposl = @explode(",", $opf[0]['vOrderAcceptanceLevel']);
        // prints($orgposl); exit;
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
        if (($orgposl[0] == $isusts || $orgposl[0] == $acptsts) && $opf[0]['eReqVerifyPoAcpt'] == 'No' && $nstatus == $cstsdtl[0]['iStatusID']) {
            $iprvsts = $cstsdtl[0]['iStatusID'];
        }
        // prints($iprvsts); exit;
        $dt['iaStatusID'] = $nstatus;
        if ($nstatus == $iprvsts) {
            $nstatus = $dt['iaStatusID'] = $acptsts;
        }
        // prints($nstatus); exit;
        if (($podtl[0]['iaStatusID'] < $isusts || $podtl[0]['iaStatusID'] == $rsts) && $nstatus < $isusts) {
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
    //prints($dt); exit;
//	echo $podtl[0]['iStatusID'];
//	prints($dt); exit;
    $dt['iModifiedByID'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'];
    // prints($dt); exit;
    $nsts = $dt['iStatusID'];
    $id = $pohObj->updateData($dt, " iPurchaseOrderID=$iPurchaseOrderID ");
    $vrfydt['iVerifiedBy'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'];
    $vrfydt['eVerifiedBy'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_USER_TYPE_SHORT'];
    // $vrfydt['eCreatedType'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
    $vrfydt['dVerifyDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
    $vrfydt['vVerifyFromIP'] = $_SERVER['REMOTE_ADDR'];
    $res = $userActionObj->updateData($vrfydt, "iItemID=$id AND eSubject='PO'");

    if ($id) {
        $act = $act[0]['vStatus_en'];
        if ($dt['iaStatusID'] == $cstsdtl[0]['iStatusID']) {
            $sub1 = "Purchase Order Created";
            $type = "Create";
            $actn = "Create";
            $sub2 = "New Purchase Order";
            $vorgid = $podtl[0]['iSupplierOrganizationID'];
        } else {
            $sub1 = "Purchase Order Status Changed";
            $type = "Modified";
            $actn = $act;
            $sub2 = "Purchase Order Status Changed";
        }
    }

    if ($id) {
        $isusts = $statusmasterObj->getDetails('*', " AND eFor='PO' AND vStatus_en='Issued' ");
        if ($nsts == $isusts[0]['iStatusID'] && $podtl[0]['iStatusID'] != $isusts[0]['iStatusID']) {  // && ($podtl[0]['iInvoiceID'] == '' || $podtl[0]['iInvoiceID']<1)
            // $vInvoiceCode = $generalobj->getUniqueCode(PRJ_DB_PREFIX."_inovice_order_heading","vInvoiceCode");
            $povdt = $pohObj->select($iPurchaseOrderID);
            $splrorg = $orgObj->select($povdt[0]['iSupplierOrganizationID']);
            // New PO Acceptance
            $acptsts = $statusmasterObj->getDetails('*', " AND eFor='PO' AND vStatus_en='Accepted' ");
            $tusrs = $orgUsrObj->getPermittedUsers($povdt[0]['iSupplierOrganizationID'], $acptsts[0]['iStatusID'], 'po', 'acpt');
            $where = "AND vType='New PO Acceptance' AND eSection='Member'";
            $db_email = $emailObj->getDetails('*', $where);
            $link = SITE_URL . "purchaseorderview/" . $iPurchaseOrderID;
            $body = Array("#POCODE#", "#SUPPLIERORG#", "#SUPORGCODE#", "#BUYERORG#", "#BUYORGCODE#", "#LINK#");
            $post = Array($povdt[0]['vPoBuyerCode'], $povdt[0]['vSupplierName'], $splrorg[0]['vOrganizationCode'], $povdt[0]['vBuyerCompanyName'], $povdt[0]['vBuyerCode'], $link);

            $rplarr = Array("Hello #NAME#,", "background-color: rgb(239, 239, 239);", "Regards,", "#MAIL_FOOTER#", "#SITE_URL#");
            $tbody_en = str_replace($rplarr, " ", $db_email[0]['tBody_en']);
            $emailContent_en = trim(str_replace($body, $post, $tbody_en));
            $tbody_fr = str_replace($rplarr, " ", $db_email[0]['tBody_fr']);
            $emailContent_fr = trim(str_replace($body, $post, $tbody_fr));

            $dt['iItemID'] = $iPurchaseOrderID;  // $id
            $dt['iOrganizationID'] = $povdt[0]['iSupplierOrganizationID'];  // $povdt[0]['iBuyerOrganizationID'];
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

            if ((is_array($tusrs) && count($tusrs) > 0)) {
                $body_arr = Array("#NAME#", "#MODIFIED_BY#", "#POCODE#", "#SUPPLIERORG#", "#SUPORGCODE#", "#BUYERORG#", "#BUYORGCODE#", "#LINK#", "#MAIL_FOOTER#", "#SITE_URL#");
                for ($i = 0; $i < count($tusrs); $i++) {
                    $smname = $tusrs[$i]['vFirstName'] . ' ' . $tusrs[$i]['vLastName'];
                    $email = $tusrs[$i]['vEmail'];
                    $post_arr = Array($smname, $sess_user_name . "($sess_usertype_short)", $povdt[0]['vPOCode'], $povdt[0]['vSupplierName'], $splrorg[0]['vOrganizationCode'], $povdt[0]['vBuyerCompanyName'], $povdt[0]['vBuyerCode'], $link, $MAIL_FOOTER, SITE_URL);
                    $sendMail->Send('New PO Acceptance', "Member", $email, $body_arr, $post_arr);
                }
            }

            /* $invdt[0]['vInvoiceSupplierCode'] = $splrorg[0]['vOrganizationCode'];
              $invdt[0]['vInvoiceCode'] = $vInvoiceCode;
              $vInvoiceNumber = "INV".$vInvoiceCode."-".trim($invdt[0]['vInvoiceSupplierCode']);
              $invdt[0]['vInvoiceNumber'] = $vInvoiceNumber;
              $invdt[0]['fOtherTax1'] = $invdt[0]['fOther_tax_1'];
              $invdt[0]['vAssociatePOBuyerCode'] = $invdt[0]['vBuyerCode'];
              $invdt[0]['vBuyerName'] = $invdt[0]['vBuyerCompanyName'];
              $invdt[0]['vBuyerContactParty'] = $invdt[0]['vBuyerContactName'];
              $invdt[0]['tInvoiceDescription'] = $invdt[0]['tOrderDescription'];
              $invdt[0]['fInvoiceTotal'] = $invdt[0]['fPOTotal'];
              $invdt[0]['vFromIP'] = $_SERVER['REMOTE_ADDR'];
              $invdt[0]['dCreatedDate'] = $invdt[0]['dIssueDate'] = date("Y-m-d H:i:s");
              unset($invdt[0]['fOther_tax_1']);
              unset($invdt[0]['vPONumber']);
              unset($invdt[0]['vPOCode']);
              unset($invdt[0]['tCarrier']);
              unset($invdt[0]['dOrderDate']);
              unset($invdt[0]['dVerifyDate']);
              unset($invdt[0]['iModifiedByID']);
              unset($invdt[0]['vBuyerCompanyName']);
              unset($invdt[0]['vBuyerContactName']);
              unset($invdt[0]['tOrderDescription']);
              unset($invdt[0]['fPOTotal']);
              $invdt = $invdt[0];
              // prints($invdt); exit;
              //$iohObj->setAllVar($invdt);
              //$iohObj->insert();
              $poitems = $poLineObj->getDetails('*'," AND iPurchaseOrderID=$iPurchaseOrderID");
              // prints($poitems); exit;
              for($l=0;$l<count($poitems);$l++)
              {
              $invItems = $poitems[$l];
              $invItems['iRelatedPurchaseOrderLineID'] = $invItems['iOrderLineID'];
              unset($invItems['iOrderLineID']);
              unset($invItems['dETA']);
              $vItemCode = $invItems['vItemCode'];
              //prints($vItemCode); exit;
              $invitmdtl = $invLineObj->getDetails('*'," AND vItemCode=$vItemCode");
              if(count($invitmdtl) > 0) {
              $vItemCode = $generalobj->getUniqueCode(PRJ_DB_PREFIX."_invoice_detail_line","vItemCode");
              }
              $vInvItemLineNumber = $generalobj->UniqueID("",PRJ_DB_PREFIX."_invoice_detail_line","iLineNumber",$charlimit="7");
              $invItems['vItemCode'] = $vItemCode;
              $invItems['iLineNumber'] = $vInvItemLineNumber;
              $invLineObj->setAllVar($invItems);
              $invLineObj->insert();
              } */
        }
    }

    if ($id) {
        $msg = "rus";
    } else {
        $msg = "ruserr";
    }
    // if($podtl[0]['iInvoiceID'] == '' || $podtl[0]['iInvoiceID']<1) {
    $isusts = $statusmasterObj->getDetails('*', " AND eFor='PO' AND vStatus_en='Issued' ");
    $isusts = $isusts[0]['iStatusID'];
    if ($podtl[0]['iStatusID'] >= $isusts && $curORGID == $podtl[0]['iSupplierOrganizationID']) {
        $redirecturl = SITE_URL_DUM . 'poacptlist/' . $nstatus . '/' . $msg;
    } else {
        $redirecturl = SITE_URL_DUM . 'polist/' . $nstatus . '/' . $msg;
    }
    $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_MSG'] = $msg;
    $id = $iPurchaseOrderID;
} else if ($view == 'reject') {
    $nstatus = $_POST['nstatus'];
    $tReasonToReject = $_POST['tReasonToReject'];
    $stsdtls = $statusmasterObj->getDetails('*', " AND eFor='PO' AND vStatus_en='Rejected' ");
    $sts = $stsdtls[0]['iStatusID'];
    $iPurchaseOrderID = $_POST['iPurchaseOrderID'];
    $dt['iStatusID'] = $sts;
    $dt['iModifiedByID'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'];
    $dt['tReasonToReject'] = $tReasonToReject;
    $eDelete = $_POST['edelete'];
    if ($eDelete == 'Yes')
        $dt['eDelete'] = 'No';
    $podtl = $pohObj->select($iPurchaseOrderID);
    if ($podtl[0]['iaStatusID'] > 0 && $curORGID == $podtl[0]['iSupplierOrganizationID']) {
        $dt['iaStatusID'] = $dt['iStatusID'];
    }
    $id = $pohObj->updateData($dt, " iPurchaseOrderID=$iPurchaseOrderID ");
    if ($id) {
        $sub1 = "Purchase Order Status Changed";
        $type = "Rejected";
        $actn = "Rejected";
        $sub2 = "Purchase Order Status Changed";
    }
    $isusts = $statusmasterObj->getDetails('*', " AND eFor='PO' AND vStatus_en='Issued' ");
    $isusts = $isusts[0]['iStatusID'];
    if ($id) {
        $msg = "rus";
    } else {
        $msg = "ruserr";
    }
    if ($podtl[0]['iStatusID'] >= $isusts && $curORGID == $podtl[0]['iSupplierOrganizationID']) {
        $redirecturl = SITE_URL_DUM . 'poacptlist/' . $sts . '/' . $msg;
    } else {
        $redirecturl = SITE_URL_DUM . 'polist/' . $sts . '/' . $msg;
    }
    $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_MSG'] = $msg;
    $id = $iPurchaseOrderID;
} else if ($view == 'edit') {    
    ### SERVER SIDE VALIDATION ####
    include(SITE_CLASS_GEN . "class.validation.php");
    $validation = new Validation();
    $RequiredFiledArr = array(
        'iSupplierOrganizationID' => $smarty->get_template_vars('LBL_SELECT') . " " . $smarty->get_template_vars('LBL_SUPPLIER') . " " . $smarty->get_template_vars('LBL_COMPANY'),
        'vSupplierContactParty' => $smarty->get_template_vars('LBL_SELECT') . " " . $smarty->get_template_vars('LBL_SUPPLIER') . " " . $smarty->get_template_vars('LBL_CONTACT_PARTY'),
        //'vRegisterNumber'      		=> $smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_REFERENCE_NUMBER'),
        //'iOpeningUnit'             => $smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_OPENING_UNIT'),
        'eLineItemTax' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_LINE_ITEM_TAX'),
        //'fVAT'           				=> $smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_VAT'),
        'vShipToParty' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_SHIP_TO') . " " . $smarty->get_template_vars('LBL_PARTY'),
        'vShipToAddressLine1' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_SHIP_TO') . " " . $smarty->get_template_vars('LBL_ADDR_LINE') . "1",
        'vShipToCity' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_SHIP_TO') . " " . $smarty->get_template_vars('LBL_CITY'),
        'vShipToCountry' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_SHIP_TO') . " " . $smarty->get_template_vars('LBL_COUNTRY'),
        'vShipToState' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_SHIP_TO') . " " . $smarty->get_template_vars('LBL_STATE'),
        'vShipToZipCode' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_SHIP_TO') . " " . $smarty->get_template_vars('LBL_ZIP_CODE'),
        'vShipToContactParty' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_SHIP_TO') . " " . $smarty->get_template_vars('LBL_CONTACT_PARTY'),
        'vShipToContactTelephoneCode' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_SHIP_TO') . " " . $smarty->get_template_vars('LBL_CONTACT_TELEPHONE') . " " . $smarty->get_template_vars('LBL_CODE'),
        'vShipToContactTelephone' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_SHIP_TO') . " " . $smarty->get_template_vars('LBL_CONTACT_TELEPHONE'),
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
            //'fPOTotal' 						=> $smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_PO_TOTAL'),
            //'fPrepayment' 					=> $smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_PRE_PAYMENT')
    );
    $resArr = $validation->isEmpty($RequiredFiledArr);
    $numdt = array();
    /*
      if(!in_array($smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_OPENING_UNIT'),$resArr)) {
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
      if(!in_array($smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_SHIP_TO')." ".$smarty->get_template_vars('LBL_CONTACT_TELEPHONE'),$resArr)) {
      $numdt['vShipToContactTelephone'] = str_replace('-','',$Data['vShipToContactTelephone']);
      $nvldmsg['vShipToContactTelephone'] = $smarty->get_template_vars('LBL_SHIP_TO')." ".$smarty->get_template_vars('LBL_CONTACT_TELEPHONE')." ".$smarty->get_template_vars('LBL_MUST_BE_NUMERIC');
      }
      if(!in_array($smarty->get_template_vars('LBL_ENTER')." ".$smarty->get_template_vars('LBL_BILL_TO')." ".$smarty->get_template_vars('LBL_CONTACT_TELEPHONE'),$resArr)) {
      $numdt['vBillToContactTelephone'] = str_replace('-','',$Data['vBillToContactTelephone']);
      $nvldmsg['vBillToContactTelephone'] = $smarty->get_template_vars('LBL_BILL_TO')." ".$smarty->get_template_vars('LBL_CONTACT_TELEPHONE')." ".$smarty->get_template_vars('LBL_MUST_BE_NUMERIC');
      }
      $vNum=$validation->isNum(array($tempData['vPhone'],$tempData['vZipcode']),array('Valid Phone Number','Valid ZipCode'),'empty'); */
    // prints($_POST);exit;
    $nvldmsg['iOpeningUnit'] = $smarty->get_template_vars('LBL_PRE_PAYMENT') . " " . $smarty->get_template_vars('LBL_MUST_BE_NUMERIC');
    $nvldmsg['fVAT'] = $smarty->get_template_vars('LBL_VAT') . " " . $smarty->get_template_vars('LBL_MUST_BE_NUMERIC');
    if (count($numdt) > 0) {
        $nvld_ary = $validation->isNum($numdt, $nvldmsg, 'empty');
    }
    //prints($resArr); exit;
    // prints($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']); exit;
    // $resArr = $validation->isEmpty($RequiredFiledArr);
    if ($resArr || $nvld_ary == 'er') {        
        header("Location:" . $_SERVER['HTTP_REFERER'] . "");
        exit;
    }    
    ### ENDS HERE ###

    $iPurchaseOrderID = $_POST['iPOID'];
    $Data['iModifiedByID'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'];

//	prints($Data); exit;

    $stsdtls = $statusmasterObj->getDetails('*', " AND eFor='PO' AND (vStatus_en='Rejected') ");
    //prints($stsdtls);exit;
    $sts = $stsdtls[0]['iStatusID'];
    $podt = $pohObj->select($iPurchaseOrderID);

    $buyerOrgPrefDtls = $orgprefObj->getDetails('*', " AND iOrganizationID=" . $buyerOrgDtls[0]['iOrganizationID']);
    //if($totusrs > 1) {
    /* if($podt[0]['iStatusID'] == $sts) {
      $postatus = $buyerOrgPrefDtls[0]['vOrderStatusLevel'];
      if($buyerOrgPrefDtls[0]['eReqVerificationPo'] == 'Yes') {
      $Data['iStatusID'] = '0';
      } else{
      if(trim($postatus) != '') {
      $postatus = @explode(',',$postatus);
      sort($postatus);
      $Data['iStatusID'] = $postatus[0];
      }
      }
      } */
    /* } else {
      $stsdtls =  $statusmasterObj->getDetails('*'," AND eFor='PO' AND vStatus_en='Issued' ");
      $Data['iStatusID'] = $stsdtls[0]['iStatusID'];
      } */

    #Delete Purchase Order Attachment File [START]
    $deleteFiles = $_POST['deleteFiles'];
    if ($deleteFiles) {
        $poAttachmentFiles = $poAttachmentObj->getDetails('vFile', " AND iAttachmentID in($deleteFiles)");
        $path = $cfgimg['PO']['docs']['path'] . "$iPurchaseOrderID/";
        if (is_array($poAttachmentFiles) && count($poAttachmentFiles) > 0) {
            for ($i = 0; $i < count($poAttachmentFiles); $i++) {
                @unlink($path . $poAttachmentFiles[$i]['vFile']);
            }
            //prints($stsdtls);exit;
            $poAttachmentObj->delete($deleteFiles);
        }
        #Delete Purchase Order Attachment File [END]
    }
    //prints($stsdtls);exit;
    //prints($Data); exit;

    /* if($Data['eSaved'] == 'Yes') {
      $stsdtls = $statusmasterObj->getDetails('*'," AND eFor='PO' AND vStatus_en='Create' ");
      $Data['iStatusID'] = $stsdtls[0]['iStatusID'];
      } else if($podt[0]['eSaved']=='Yes') {
      $borgpfdt = $orgprefObj->getDetails('*'," AND iOrganizationID=".$podt[0]['iBuyerOrganizationID']);
      if($borgpfdt[0]['eReqVerificationPo'] == 'Yes') {
      $Data['iStatusID'] = 0;
      } else {
      $stsdtls = $statusmasterObj->getDetails('*'," AND eFor='PO' AND vStatus_en='Create' ");
      $Data['iStatusID'] = $stsdtls[0]['iStatusID'];
      }
      } */
    $stsdtls = $statusmasterObj->getDetails('*', " AND eFor='PO' AND vStatus_en='Create' ");
    $Data['iStatusID'] = $stsdtls[0]['iStatusID'];    
    unset($Data['eFrom']);
    $id = $pohObj->updateData($Data, "iPurchaseOrderID=$iPurchaseOrderID");

    if ($id) {        
        $files = $_FILES['files'];
        $titles = $_POST['titles'];
        $descprtiption = $_POST['descriptions'];
        $dAdate = calcGTzTime(date('Y-m-d'), 'Y-m-d');
        if (trim($files['name'][0]) == '')
            unset($files['name'][0]);
        $fileData['iPurchaseOrderID'] = $iPurchaseOrderID;
        $fileData['eRelatedTo'] = 'PO';
        $fileData['dAdate'] = $dAdate;

        $fileUpload = array();
        for ($i = 0; $i < count($files['name']); $i++) {
            // $fileData['vTitle']=$titles[$i];
            // $fileData['tDescription']=$descprtiption[$i];
            $fileUpload['name'] = $files['name'][$i + 1];
            $fileUpload['tmp_name'] = $files['tmp_name'][$i + 1];
            $fileName = $imgObj->UploadFile('PO', 'docs', $iPurchaseOrderID, $fileUpload, '');
            $fileData['vFile'] = $fileName;
            if ($fileName != '') {
                //Prints($fileData);exit;
                $poAttachmentObj->setAllVar($fileData);
                $poAttachmentObj->insert();
            }
        }
        $msg = "rus";        
        $redirecturl = SITE_URL_DUM . "popref/$iPurchaseOrderID/" . $msg;                
    } else {        
        $msg = "ruserr";
        $redirecturl = SITE_URL_DUM . 'polist/' . $msg;
    }

    if ($Data['eSaved'] != 'Yes' && $_SESSION['poadd'] != 'yes') {
        if ($id) {
            $sub1 = "Purchase Order Modified";
            $type = "Modified";
            $actn = "Modified";
            $sub2 = "Purchase Order Modified";
        }
    }
    $_SESSION['poadd'] = 'yes';
    // echo $iPurchaseOrderID; exit;
    if ($Data['eSaved'] == 'Yes') {
        if($eFrom == "Next"){
            $redirecturl = SITE_URL . "index.php?file=u-popref&id=$iPurchaseOrderID&msg=$msg";
        }else{
            $redirecturl = SITE_URL . "index.php?file=u-polist&msg=$msg";
        }        
    } else {
        $redirecturl = SITE_URL . "index.php?file=u-popref&id=$iPurchaseOrderID&msg=$msg";
    }
    $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_MSG'] = $msg;
    $id = $iPurchaseOrderID;
} else if ($view == 'crtinv') {
    $iPurchaseOrderID = $_POST['iPOID'];
    $acptsts = $statusmasterObj->getDetails('*', " AND eFor='PO' AND vStatus_en='Accepted' ");
    $invdt = $pohObj->select($iPurchaseOrderID);
    // prints($invdt); exit;
    if ($acptsts[0]['iStatusID'] == $invdt[0]['iStatusID'] && (trim($invdt[0]['iInvoiceID']) == '' || trim($invdt[0]['iInvoiceID']) < 1)) {
        // $vInvoiceCode = $generalobj->getUniqueCode(PRJ_DB_PREFIX."_inovice_order_heading","vInvoiceCode");
        $vInvoiceCode = $iohObj->getUniqueCode();
        // $invdt = $pohObj->select($iPurchaseOrderID);
        $splrorg = $orgObj->select($invdt[0]['iSupplierOrganizationID']);
        $splrpf = $orgprefObj->getDetails('*', " AND iOrganizationID=" . $invdt[0]['iSupplierOrganizationID']);
        $invdt[0]['vInvoiceSupplierCode'] = $splrorg[0]['vOrganizationCode'];
        $invdt[0]['vSupplierName'] = $splrorg[0]['vCompanyName'];
        $invdt[0]['vInvoiceCode'] = $vInvoiceCode;
        $invdt[0]['vInvSupplierCode'] = $vInvoiceCode;
        $vInvoiceNumber = "INV" . $vInvoiceCode . "-" . trim($invdt[0]['vInvoiceSupplierCode']);
        $invdt[0]['vInvoiceNumber'] = $vInvoiceNumber;
        $invdt[0]['fOtherTax1'] = $invdt[0]['fOther_tax_1'];
        $invdt[0]['vAssociatePOBuyerCode'] = $invdt[0]['vBuyerCode'];
        $invdt[0]['vBuyerName'] = $invdt[0]['vBuyerCompanyName'];
        $invdt[0]['vBuyerContactParty'] = $invdt[0]['vBuyerContactName'];
        $invdt[0]['tInvoiceDescription'] = $invdt[0]['tOrderDescription'];
        $invdt[0]['fInvoiceTotal'] = $invdt[0]['fPOTotal'];
        $invdt[0]['vFromIP'] = $_SERVER['REMOTE_ADDR'];
        $invdt[0]['dCreatedDate'] = $invdt[0]['dIssueDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
        $invdt[0]['iModifiedByID'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'];
        $invdt[0]['vExtPOCode'] = $invdt[0]['vPoBuyerCode'];
        $invdt[0]['iaStatusID'] = 0;
        // pritns($invdt); exit;
        unset($invdt[0]['fOther_tax_1']);
        unset($invdt[0]['vPONumber']);
        unset($invdt[0]['vPOCode']);
        unset($invdt[0]['tCarrier']);
        unset($invdt[0]['dOrderDate']);
        unset($invdt[0]['dVerifyDate']);
        // unset($invdt[0]['iModifiedByID']);
        unset($invdt[0]['vBuyerCompanyName']);
        unset($invdt[0]['vBuyerContactName']);
        unset($invdt[0]['tOrderDescription']);
        unset($invdt[0]['iInvoiceID']);
        unset($invdt[0]['fPOTotal']);
        $invdt = $invdt[0];

        $byrorg = $orgObj->select($invdt['iBuyerOrganizationID']);
        // $byrpf = $orgprefObj->getDetails('*'," AND iOrganizationID=".$invdt['iBuyerOrganizationID']);
        $byrpf = $orgprefObj->getDetails('*', " AND iOrganizationID=" . $curORGID);
        $invstatus = $byrpf[0]['vInvoiceAcceptanceLevel'];
        $totusrs = $orgUsrObj->getDetails(" COUNT(*) as tot ", " AND iOrganizationID=$curORGID AND eUserType='User'");
        $totusrs = $totusrs[0]['tot'];
        //if($totusrs > 1) {
        /* if($byrpf[0]['eReqVerifyInvAcpt'] == 'Yes') {
          $invdt['iStatusID'] = '0';
          } else {
          if(trim($invstatus) != '') {
          $invstatus = @explode(',',$invstatus);
          sort($invstatus);
          $invdt['iStatusID'] = $invstatus[0];
          }
          } */
        $icstsdtls = $statusmasterObj->getDetails('*', " AND eFor='Invoice' AND vStatus_en='Create' ");
        $invdt['iStatusID'] = $icstsdtls[0]['iStatusID'];
        $invdt['eSaved'] = 'Yes';
        /* } else {
          $invisusts = $statusmasterObj->getDetails('*'," AND eFor='Invoice' AND vStatus_en='Issued' ");
          $invdt['iStatusID'] = $invisusts[0];
          } */

        // prints($invdt); exit;
        $iohObj->setAllVar($invdt);
        $in = $iohObj->insert();
        $popref = $poprefObj->getDetails('*', " AND iPurchaseOrderID=$iPurchaseOrderID ");
        $popref[0]['iInvoiceID'] = $in;
        unset($popref[0]['iPurchaseOrderID']);
        $iprf = $ioprefObj->insert($popref);
        $poitems = $poLineObj->getDetails('*', " AND iPurchaseOrderID=$iPurchaseOrderID");
        // prints($poitems); exit;
        for ($l = 0; $l < count($poitems); $l++) {
            $invItems = $poitems[$l];
            $invItems['iRelatedPurchaseOrderLineID'] = $invItems['iOrderLineID'];
            unset($invItems['iOrderLineID']);
            unset($invItems['dETA']);
            unset($invItems['iRelatedInvoiceLineID']);
            // $vItemCode = $invItems['vItemCode'];
            // prints($vItemCode); exit;
            // $invitmdtl = $invLineObj->getDetails('*'," AND vItemCode=$vItemCode");
            /* if(count($invitmdtl) > 0) {
              $vItemCode = $generalobj->getUniqueCode(PRJ_DB_PREFIX."_invoice_detail_line","vItemCode");
              } */
            $vItemCode = $invLineObj->getUniqueCode();
            $vInvItemLineNumber = $generalobj->UniqueID("", PRJ_DB_PREFIX . "_invoice_detail_line", "iLineNumber", $charlimit = "10");
            $invItems['vItemCode'] = $vItemCode;
            $invItems['iLineNumber'] = $vInvItemLineNumber;
            $invItems['dCreatedDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
            $invItems['iInvoiceID'] = $in;
            // prints($invItems); exit;
            $invLineObj->setAllVar($invItems);
            $itm = $invLineObj->insert();
        }
    }
// mail
    if ($in > 0) {
        $sub1 = "New Invoice Created";
        $type = "Create";
        $actn = "Create";
        $sub2 = "New Invoice";

        $dt['iItemID'] = $in;
        $dt['eSubject'] = $sub1;
        $dt['eType'] = $type;
        $where = "AND vType='$sub1' AND eSection='Member'";
        $db_email = $emailObj->getDetails('*', $where);
        $invdt = $iohObj->select($in);

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
        } else {
            $nxtstatus['iStatusID'] = '0';
        }

        $sts = $nxtstatus['iStatusID'];  //	$invdt[0]['iStatusID'];
        // $usrarr = $orgUsrObj->getPermittedUsers($invdt[0]['iSupplierOrganizationID'],$sts,'inv','acpt');
        $usrarr = $orgUsrObj->getPermittedUsers($invdt[0]['iSupplierOrganizationID'], $sts, 'inv', 'isu');

        $link = SITE_URL . "invoiceview/" . $in;
        $body = Array("#ADDED_BY#", "#INVCODE#", "#SUPPLIERORG#", "#SUPORGCODE#", "#BUYERORG#", "#BUYORGCODE#", "#LINK#");
        $post = Array($sess_user_name . "($sess_usertype_short)", $invdt[0]['vInvoiceCode'], $invdt[0]['vSupplierName'], $invdt[0]['vInvoiceSupplierCode'], $invdt[0]['vBuyerName'], $invdt[0]['vAssociatePOBuyerCode'], $link);

        $rplarr = Array("Hello #NAME#,", "background-color: rgb(239, 239, 239);", "Regards,", "#MAIL_FOOTER#", "#SITE_URL#");
        $tbody_en = str_replace($rplarr, " ", $db_email[0]['tBody_en']);
        $emailContent_en = trim(str_replace($body, $post, $tbody_en));
        $tbody_fr = str_replace($rplarr, " ", $db_email[0]['tBody_fr']);
        $emailContent_fr = trim(str_replace($body, $post, $tbody_fr));

        $dt['iOrganizationID'] = $curORGID;  // $invdt[0]['iSupplierOrganizationID'];
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

        if (!isset($poaObj)) {
            include_once(SITE_CLASS_APPLICATION . "user/class.PurchaseOrderAttachment.php");
            $poaObj = new PurchaseOrderAttachment();
        }
        $po_attach = $poaObj->getDetails('*', " AND iPurchaseOrderID=$iPurchaseOrderID");
        // $po_attach = $poaObj->getDetails('*'," AND iPurchaseOrderID=39");
        //prints($po_attach); exit;
        if (is_array($po_attach) && count($po_attach) > 0) {
//				$semi_rand = md5(time());
//				$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
//				$h_append .= "Content-Type: multipart/mixed;\r\n" . " boundary=\"{$mime_boundary}\"";
            // prints($po_attach); exit;
            for ($l = 0; $l < count($po_attach); $l++) {
                $filepath = $generalobj->GetImagePath(array('section' => 'PO', 'type' => 'docs', 'id' => $iPurchaseOrderID, 'name' => $po_attach[$l]['vFile']));
                // prints($filepath); exit;
                if (file_exists($filepath)) {
                    $attachments[$l]['path'] = $filepath;
                    $attachments[$l]['name'] = $po_attach[$l]['vFile'];
                }
// file attachment
//			$fileatt = $filepath; // Path to the file
//			$fileatt_type = "application/octet-stream"; // File Type
//			$fileatt_name = $po_attach[$l]['vFile']; 	// Filename that will be used for the file as the attachment

                /* $email_from = ""; // Who the email is from
                  $email_subject = ""; // The Subject of the email
                  $email_txt = ""; // Message that the email has in it

                  $email_to = ""; // Who the email is too

                  $headers = "From: ".$email_from; */

//			$file = fopen($fileatt,'rb');
//			$data = fread($file,filesize($fileatt));
//			fclose($file);
                // prints($data); exit;
//			$data = chunk_split(base64_encode($data));
//			$attach_pre .= "\n\n" .	"--{$mime_boundary}\n" . "Content-Type:text/html; charset=\"iso-8859-1\"\n" . "Content-Transfer-Encoding: 7bit\n\n";
//			$attach .= "--{$mime_boundary}\n" . "Content-Type: {$fileatt_type};\n" . " name=\"{$fileatt_name}\"\n" . "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";

                /* $message .= "Content-Type: {\"application/octet-stream\"};\n" . " name=\"$files[$x]\"\n" .
                  "Content-Disposition: attachment;\n" . " filename=\"$files[$x]\"\n" .
                  "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
                  $message .= "--{$mime_boundary}\n"; */
//
            }
        }
        // $attach = "";
        // prints($attach); exit;
        // prints($invdt); exit;
        $body_arr = Array("#NAME#", "#ADDED_BY#", "#INVCODE#", "#SUPPLIERORG#", "#SUPORGCODE#", "#BUYERORG#", "#BUYORGCODE#", "#LINK#", "#MAIL_FOOTER#", "#SITE_URL#");
        // prints($usrarr); exit;
        if (is_array($emailArr) && count($emailArr) > 0) {
            for ($i = 0; $i < count($emailArr); $i++) {
                // echo $emailArr[$i]['vFirstName'].' '.$emailArr[$i]['vLastName']; exit;
                $smname = $emailArr[$i]['vFirstName'] . ' ' . $emailArr[$i]['vLastName'];
                $email = $emailArr[$i]['vEmail'];
                $post_arr = Array($smname, $sess_user_name . "($sess_usertype_short)", $invdt[0]['vInvoiceCode'], $invdt[0]['vSupplierName'], $invdt[0]['vInvoiceSupplierCode'], $invdt[0]['vBuyerName'], $invdt[0]['vAssociatePOBuyerCode'], $link, $MAIL_FOOTER, SITE_URL);
                $sendMail->SendWithAttachments($sub1, "Member", $email, $body_arr, $post_arr, $SITE_NAME, $sub1, 'No', $attachments);
            }
        }
        if (is_array($usrarr) && count($usrarr) > 0) {
            for ($i = 0; $i < count($usrarr); $i++) {
                $smname = $usrarr[$i]['vFirstName'] . ' ' . $usrarr[$i]['vLastName'];
                $email = $usrarr[$i]['vEmail'];
                $post_arr = Array($smname, $SITE_NAME, $invdt[0]['vInvoiceCode'], $invdt[0]['vSupplierName'], $invdt[0]['vInvoiceSupplierCode'], $invdt[0]['vBuyerName'], $invdt[0]['vAssociatePOBuyerCode'], $link, $MAIL_FOOTER, SITE_URL);
                $sendMail->SendWithAttachments($sub2, "Member", $email, $body_arr, $post_arr, $SITE_NAME, $sub2, 'No', $attachments);
            }
        }
    }
//
//	exit;
    $msg = 'invc';
    // $redirecturl = SITE_URL_DUM."invoicelist/".$msg;
    $redirecturl = SITE_URL_DUM . "invoicecreate/" . $in;
    // $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MSG']=$msg;
    header("Location:" . $redirecturl);
    exit;
}

if ($Data['eSaved'] != 'Yes' || $sub1 == "Purchase Order Created") {
    if ($id && trim($sub1) != '') {
        $dt = array();
//          if(is_array($emailArr) && count($emailArr) > 0) {
        $dt['iItemID'] = $id;
        $dt['eSubject'] = $sub1;
        $dt['eType'] = $type;
        $dt['vAction'] = $actn;
        $where = "AND vType='$sub1' AND eSection='Member'";
        $db_email = $emailObj->getDetails('*', $where);
        $podt = $pohObj->select($id);

        $orgpref = $orgprefObj->getStatusDetails($podt[0]['iBuyerOrganizationID']);
        $orgpostatus = $orgpref['po'];

        $orgusrs = $orgUsrObj->getDetails('*', " AND iOrganizationID=" . $podt[0]['iBuyerOrganizationID']);

        $stsdtls = $statusmasterObj->getDetails('*', " AND eFor='PO' AND vStatus_en='Rejected' ");
        $rjtsts = $stsdtls[0]['iStatusID'];
        $stsdtls = $statusmasterObj->getDetails('*', " AND eFor='PO' AND vStatus_en='Accepted' ");
        $acptsts = $stsdtls;
        $lang = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_LANG'];
        $stsdtls = $statusmasterObj->getDetails("*, vStatusMsg_$lang as vStatusMsg", " AND eFor='PO' AND vStatus_en='Issued' ");
        $isusts = $stsdtls;

        if ($podt[0]['iStatusID'] != $isusts[0]['iStatusID']) {
            if (count($orgusrs) > 1 && $podt[0]['iStatusID'] != $acptsts[0]['iStatusID']) {
                for ($l = 0; $l < count($orgpostatus); $l++) {
                    $nxtlevel = '1';
                    if ($podt[0]['iStatusID'] == $orgpostatus[$l]['iStatusID']) {
                        if (isset($orgpostatus[$l + 1]))
                            $nxtstatus = $orgpostatus[$l + 1];
                        else
                            $nxtstatus = $orgpostatus[$l];
                    }
                }
            } else {
                $nxtstatus = $isusts[0];
            }
        }
        // prints($podt); exit;
        if ($podt[0]['iInvoiceID'] > 0) {
            $orgpref = $orgprefObj->getStatusDetails($podt[0]['iSupplierOrganizationID'], 'acceptance');
            $mchpref = $orgprefObj->getStatusDetails($podt[0]['iBuyerOrganizationID']);
            $mth = array();
            for ($l = 0; $l < count($mchpref['po']); $l++) {
                $mth[] = $mchpref['po'][$l]['iStatusID'];
            }
            $orgpostatus = $orgpref['po'];
            for ($l = 0; $l < count($orgpostatus); $l++) {
                if ($orgpostatus[$l]['iStatusID'] > $podt[0]['iStatusID'] && in_array($orgpostatus[$l]['iStatusID'], $mth)) {
                    $nxtstatus = $orgpostatus[$l];
                    break;
                }
            }
        }
        // prints($nxtstatus); exit;
        if ($curORGID == $podt[0]['iSupplierOrganizationID'] && $podt[0]['iStatusID'] >= $isusts[0]['iStatusID']) {
            $sorgprfdt = $orgprefObj->getDetails("*", " AND iOrganizationID=" . $podt[0]['iSupplierOrganizationID']);
            if ($sorgprfdt[0]['eReqVerifyPoAcpt'] == 'Yes') {
                $iss = $statusmasterObj->getDetails("*, vStatusMsg_$lang as vStatusMsg", " AND eFor='PO' AND vStatus_en='Verify' ");
            } else {
                $iss = $statusmasterObj->getDetails("*, vStatusMsg_$lang as vStatusMsg", " AND eFor='PO' AND vStatus_en='Issue' ");
            }
            $usrarr = $orgUsrObj->getPermittedUsers($podt[0]['iSupplierOrganizationID'], $iss[0]['iStatusID'], 'po', 'acpt');
        } else {
            $sts = $nxtstatus['iStatusID'];  //	$podt[0]['iStatusID'];
            $usrarr = $orgUsrObj->getPermittedUsers($podt[0]['iBuyerOrganizationID'], $sts, 'po');
        }
        // prints($usrarr); exit;
        $supdt = $orgObj->select($podt[0]['iSupplierOrganizationID']);
        $link = SITE_URL . "purchaseorderview/" . $id;
        if ($sub1 == 'Purchase Order Created') {
            $body = Array("#ADDED_BY#", "#POCODE#", "#SUPPLIERORG#", "#SUPORGCODE#", "#BUYERORG#", "#BUYORGCODE#", "#LINK#");
        } else {
            $body = Array("#MODIFIED_BY#", "#POCODE#", "#SUPPLIERORG#", "#SUPORGCODE#", "#BUYERORG#", "#BUYORGCODE#", "#LINK#");
        }
        $post = Array($sess_user_name . "($sess_usertype_short)", $podt[0]['vPoBuyerCode'], $podt[0]['vSupplierName'], $supdt[0]['vOrganizationCode'], $podt[0]['vBuyerCompanyName'], $podt[0]['vBuyerCode'], $link);

        $rplarr = Array("Hello #NAME#,", "background-color: rgb(239, 239, 239);", "Regards,", "#MAIL_FOOTER#", "#SITE_URL#");
        $tbody_en = str_replace($rplarr, " ", $db_email[0]['tBody_en']);
        $emailContent_en = trim(str_replace($body, $post, $tbody_en));
        $tbody_fr = str_replace($rplarr, " ", $db_email[0]['tBody_fr']);
        $emailContent_fr = trim(str_replace($body, $post, $tbody_fr));

        if ($vorgid > 0) {
            $dt['iOrganizationID'] = $curORGID;  // $vorgid; 	// $podt[0]['iSupplierOrganizationID'];
        } else {
            $dt['iOrganizationID'] = $curORGID;  // $podt[0]['iBuyerOrganizationID'];
        }
        $dt['vMailSubject_en'] = $db_email[0]['vSub_en'];
        $dt['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
        $dt['tMailContent_en'] = $emailContent_en;
        $dt['tMailContent_fr'] = $emailContent_fr;
        $dt['iCreatedBy'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'];
        $dt['eCreatedType'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_USER_TYPE_SHORT'];
        $dt['eSubject'] = "PO";
        $dt['dActionDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');

        // if((is_array($emailArr) && count($emailArr) > 0) || (is_array($usrarr) && count($usrarr)>0)) {
        //$userActionObj->setAllVar($dt);
        // pritns($dt); exit;
        $userActionObj->insert($dt);
        if ($sub1 == 'Purchase Order Created') {
            $body_arr = Array("#NAME#", "#ADDED_BY#", "#POCODE#", "#SUPPLIERORG#", "#SUPORGCODE#", "#BUYERORG#", "#BUYORGCODE#", "#LINK#", "#MAIL_FOOTER#", "#SITE_URL#");
        } else {
            $body_arr = Array("#NAME#", "#MODIFIED_BY#", "#POCODE#", "#SUPPLIERORG#", "#SUPORGCODE#", "#BUYERORG#", "#BUYORGCODE#", "#LINK#", "#MAIL_FOOTER#", "#SITE_URL#");
        }
        if ((is_array($emailArr) && count($emailArr) > 0)) {
            for ($i = 0; $i < count($emailArr); $i++) {
                $smname = $emailArr[$i]['vFirstName'] . ' ' . $emailArr[$i]['vLastName'];
                $email = $emailArr[$i]['vEmail'];
                $post_arr = Array($smname, $sess_user_name . "($sess_usertype_short)", $podt[0]['vPoBuyerCode'], $podt[0]['vSupplierName'], $supdt[0]['vOrganizationCode'], $podt[0]['vBuyerCompanyName'], $podt[0]['vBuyerCode'], $link, $MAIL_FOOTER, SITE_URL);
                $sendMail->Send($sub1, "Member", $email, $body_arr, $post_arr);
            }
        }
        if ((is_array($usrarr) && count($usrarr) > 0)) {
            for ($i = 0; $i < count($usrarr); $i++) {
                $smname = $usrarr[$i]['vFirstName'] . ' ' . $usrarr[$i]['vLastName'];
                $email = $usrarr[$i]['vEmail'];
                $post_arr = Array($smname, $sess_user_name . "($sess_usertype_short)", $podt[0]['vPoBuyerCode'], $podt[0]['vSupplierName'], $supdt[0]['vOrganizationCode'], $podt[0]['vBuyerCompanyName'], $podt[0]['vBuyerCode'], $link, $MAIL_FOOTER, SITE_URL);
                $sendMail->Send($sub2, "Member", $email, $body_arr, $post_arr);
            }
        }
//          }
    }
}

header("Location:" . $redirecturl);
exit;
?>