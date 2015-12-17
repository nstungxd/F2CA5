<?php

$UserName = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_USER_NAME'];
//echo $UserName;exit;
$var_msg = $_GET['msg'];
include(S_SECTIONS . "/member/memberaccess.php");

$iPurchaseOrderID = $_GET['id'];
if (!isset($pohObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.PurchaseOrderHeading.php");
    $pohObj = new PurchaseOrderHeading();
}
if (!isset($orgUserObj)) {
    include_once(SITE_CLASS_APPLICATION . 'user/class.OrganizationUser.php');
    $orgUserObj = new OrganizationUser();
}
if (!isset($orgprefObj)) {
    include_once(SITE_CLASS_APPLICATION . "organization/class.OrganizationPreference.php");
    $orgprefObj = new OrganizationPreference();
}
if (!isset($orgUserPermObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.OrganizationUserPermission.php");
    $orgUserPermObj = new OrganizationUserPermission();
}
if (!isset($iohObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.InvoiceOrderHeading.php");
    $iohObj = new InvoiceOrderHeading();
}
if (!isset($statusmasterObj)) {
    include_once(SITE_CLASS_APPLICATION . "class.StatusMaster.php");
    $statusmasterObj = new StatusMaster();
}
if (!isset($orgObj)) {
    include_once(SITE_CLASS_APPLICATION . "organization/class.Organization.php");
    $orgObj = new Organization();
}
if (!isset($poprefObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.PoOtherInformation.php");
    $poprefObj = new PoOtherInformation();
}

// $poData=$pohObj->select($iPurchaseOrderID);
$fields = " poh.*, (select vState from b2b_state_master sm where BINARY sm.vStateCode=poh.vShipToState AND BINARY sm.vCountryCode=poh.vShipToCountry) as vShipToState,
				(select vCountry from b2b_country_master cm where BINARY cm.vCountryCode=poh.vShipToCountry) as vShipToCountry,
				(select vState from b2b_state_master sm where BINARY sm.vStateCode=poh.vBillToState AND BINARY sm.vCountryCode=poh.vBillToCountry) as vBillToState,
				(select vCountry from b2b_country_master cm where BINARY cm.vCountryCode=poh.vBillToCountry) as vBillToCountry,
				(select org.vCompanyName from b2b_organization_master org where org.iOrganizationID=poh.iSupplierOrganizationID) as vSupplierName,
				(select CONCAT(usr.vFirstName,' ',usr.vLastName) as name from b2b_organization_user usr where usr.iUserID=poh.iSupplierID) as vSupplierContactParty ";
$poData = $pohObj->getJoinTableInfo('', $fields, " AND iPurchaseOrderID=$iPurchaseOrderID ");
$isdtls = $statusmasterObj->getDetails('*', " AND eFor='PO' AND vStatus_en='Issued' ");
$isdtls = $isdtls[0]['iStatusID'];
if ($uorg_type == 'Buyer2') {
    $b2us = $pohObj->getPurchaseOrderRfq2Buyer2OrgIds($iPurchaseOrderID);
    if (!in_array($curORGID, $b2us)) {
        header("Location: " . SITE_URL_DUM . "invoicelist");
        exit;
    }
} else if ($poData[0]['iBuyerOrganizationID'] != $curORGID && $poData[0]['iSupplierOrganizationID'] != $curORGID) {
    header("Location: " . SITE_URL_DUM . "polist/all");
    exit;
} else if ($poData[0]['iSupplierOrganizationID'] == $curORGID && $poData[0]['iStatusID'] < $isdtls) {
    header("Location: " . SITE_URL_DUM . "polist/all");
    exit;
}
$crtsts = $statusmasterObj->getDetails('*', " AND eFor='PO' AND vStatus_en='Create' ");
$stsdtls = $statusmasterObj->getDetails('*', " AND eFor='PO' AND vStatus_en='Rejected' ");
$rjtsts = $stsdtls[0]['iStatusID'];
$stsdtls = $statusmasterObj->getDetails('*', " AND eFor='PO' AND vStatus_en='Accepted' ");
$acptsts = $stsdtls;
$lang = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_LANG'];
$stsdtls = $statusmasterObj->getDetails("*, vStatusMsg_$lang as vStatusMsg", " AND eFor='PO' AND vStatus_en='Issued' ");
$isusts = $stsdtls;

// prints($isusts); exit;
//prints($poData[0]);
//exit;
/* if((($poData[0]['iStatusID'] == $rjtsts && $poData[0]['eDelete'] != 'Yes') || $poData[0]['eSaved']=='Yes') && $sess_usertype_short == 'OU') {
  if(!($poData[0]['iSupplierOrganizationID']==$curORGID && $poData[0]['iaStatusID']==$rjtsts)) {
  header("Location: ".SITE_URL_DUM."purchaseordercreate/$iPurchaseOrderID");
  exit;
  }
  } */
$orgpref = $orgprefObj->getStatusDetails($poData[0]['iBuyerOrganizationID']);
// prints($poData); exit;
/* if($poData[0]['iInvoiceID'] >0) {
  $orgpref = $orgprefObj->getStatusDetails($poData[0]['iSupplierOrganizationID'],'acceptance');
  $mchpref = $orgprefObj->getStatusDetails($poData[0]['iBuyerOrganizationID'],'acceptance');
  $mth = array();
  for($l=0;$l<count($mchpref['po']);$l++) {
  $mth[] = $mchpref['po'][$l]['iStatusID'];
  }
  // unset($mth[1]);
  // prints($mth); exit;
  } else {
  $orgpref = $orgprefObj->getStatusDetails($poData[0]['iBuyerOrganizationID']);
  } */
// prints($mth); exit;
// $orgpref = $orgprefObj->getStatusDetails($poData[0]['iBuyerOrganizationID']);
$poData = $poData[0];
$lang = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_LANG'];
$orgpostatus = $orgpref['po'];
// prints($orgpostatus); exit;
$permitted = '';
$nxtstatus = array();
$orgusrs = $orgUserObj->getDetails('*', " AND iOrganizationID=" . $poData['iBuyerOrganizationID']);
$borgprfdt = $orgprefObj->getDetails("*", " AND iOrganizationID=" . $poData['iBuyerOrganizationID']);
$sorgprfdt = $orgprefObj->getDetails("*", " AND iOrganizationID=" . $poData['iSupplierOrganizationID']);
if ($poData['iStatusID'] == $crtsts[0]['iStatusID'] && $borgprfdt[0]['eReqVerificationPo'] == 'Yes') {
    $vrfsts = $statusmasterObj->getDetails('*', " AND eFor='PO' AND vStatus_en='Verify' ");
    $nxtstatus = $vrfsts[0];
    $nxtstatus['vStatusMsg'] = $vrfsts[0]['vStatusMsg_' . $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_LANG']];
} else {
    if ($poData['iStatusID'] != $isusts[0]['iStatusID']) {
        if ($poData['iStatusID'] != $isusts[0]['iStatusID'] && $poData['iStatusID'] != $acptsts[0]['iStatusID']) {  // count($orgusrs) > 1 &&
            if ($poData['iStatusID'] == $orgpostatus[count($orgpostatus) - 1]['iStatusID'] && $poData['iStatusID'] != $rjtsts) {
                $nxtstatus = $isusts[0];  // $acptsts[0]; 	// $isusts[0];
            }/* else if($poData['iStatusID'] == $crtsts[0]['iStatusID']) {
              $nxtstatus = $orgpostatus[1];
              } */ else {
                $nxtset = 'n';
                $nxtstatus = $orgpostatus[$l];
                //if($poData['iInvoiceID']=='' || $poData['iInvoiceID']<1) {
                for ($l = 0; $l < count($orgpostatus); $l++) {
                    $nxtlevel = '1';
                    if ($poData['iStatusID'] == $orgpostatus[$l]['iStatusID']) {  // && in_array($orgpostatus[$l+1]['iStatusID'],$mth)
                        if (isset($orgpostatus[$l + 1])) {
                            $nxtstatus = $orgpostatus[$l + 1];
                            $nxtset = 'y';
                        } /* else {
                          $nxtstatus = $orgpostatus[$l];
                          } */
                        break;
                    }

                    /* if($poData['iStatusID'] == $orgpostatus[$l]['iStatusID']) {
                      if(isset($orgpostatus[$l+1])) {
                      if(in_array($orgpostatus[$l+1],$mth))
                      $nxtstatus = $orgpostatus[$l+1];
                      } else {
                      $nxtstatus = $orgpostatus[$l];
                      }
                      } */
                }
                //}
                /* else if($poData['iInvoiceID']>0) { 	// $nxtset!='y' &&
                  for($l=0; $l<count($orgpostatus); $l++) {
                  if($orgpostatus[$l]['iStatusID'] > $poData['iStatusID'] && in_array($orgpostatus[$l]['iStatusID'],$mth)) {
                  $nxtstatus = $orgpostatus[$l];
                  break;
                  }
                  }
                  } */
            }
        } else {
            $nxtstatus = $acptsts[0];
        }
    }
}

if ($poData['iStatusID'] == $isusts[0]['iStatusID'] && $orgtype != 'Buyer' && $curORGID != $poData['iBuyerOrganizationID']) {
    $upermits = $orgUserPermObj->getUserPermits($sess_id, 'acpt');
} else {
    $upermits = $orgUserPermObj->getUserPermits($sess_id);
}
if (!is_array($upermits['po'])) {
    $upermits['po'] = array();
}

// prints($nxtstatus); exit;
if ($sess_usertype != 'orgadmin') {
    if (isset($nxtstatus['iStatusID'])) {
        if ((in_array($nxtstatus['iStatusID'], $upermits['po']) && $sess_usertype_short == 'OU' && $poData['iStatusID'] != $isusts[0]['iStatusID'] && $poData['iStatusID'] != $acptsts[0]['iStatusID']) || $poData['eDelete'] == 'Yes') {
            $permitted = 'Yes';
            /* if($poData['iStatusID']==0 && strpos($ures[0]['eVerify'],'po')===false) {
              $permitted = 'No';
              } */
        } else {
            $permitted = 'No';
        }
    }
} else {
    $permitted = 'No';
}

if ($sess_usertype_short == 'OU') {
    if ($poData['iStatusID'] == $crtsts[0]['iStatusID']) {
        if ($curORGID == $poData['iBuyerOrganizationID']) {
            if ($borgprfdt[0]['eReqVerificationPo'] == 'Yes') {
                if (strpos($ures[0]['eVerify'], 'pi') !== false) {
                    $permitted = 'Yes';
                } else {
                    $permitted = 'No';
                }
            }
        }
    } else if ($poData['iaStatusID'] == $crtsts[0]['iStatusID']) {
        if ($curORGID == $poData['iSupplierOrganizationID']) {
            if ($sorgprfdt[0]['eReqVerifyPoAcpt'] == 'Yes') {
                if (strpos($ures[0]['eVerify'], 'pa') !== false) {
                    $permitted = 'Yes';
                } else {
                    $permitted = 'No';
                }
            }
        }
    }
    /* if($poData['iStatusID']==0 && strpos($ures[0]['eVerify'],'po')!==false) {
      $permitted = 'Yes';
      } else if($poData['iStatusID']==0) {
      $permitted = 'No';
      } */
}
// prints($upermits['po']); exit;
if ($poData['iModifiedByID'] == $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID']) {
    $permitted = 'No';
}
/* if(($poData['iSupplierOrganizationID']==$curORGID && $poData['iStatusID']==$isusts[0]['iStatusID'])|| $poData['eDelete'] == 'Yes') {
  if($poData['eDelete'] == 'Yes' && $poData['iModifiedByID'] != $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'])
  {
  $nxtstatus['vStatusMsg']=$smarty->get_template_vars('LBL_VERIFY_TO_DELETE');
  }
  else
  {
  $nxtstatus = $acptsts[0];
  $nxtstatus['vStatusMsg'] = $acptsts[0]['vStatusMsg_'.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG']];
  }
  $permitted = 'Yes';
  } */
if (($poData['iSupplierOrganizationID'] == $curORGID && $poData['iStatusID'] == $isusts[0]['iStatusID']) || $poData['eDelete'] == 'Yes') {
    if ($poData['eDelete'] == 'Yes' && $poData['iModifiedByID'] != $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'] && $poData['iBuyerOrganizationID'] == $curORGID) {
        $nxtstatus['vStatusMsg'] = $smarty->get_template_vars('LBL_VERIFY_TO_DELETE');
        $permitted = 'Yes';
    } /* else if($poData['eDelete'] != 'Yes') {
      $nxtstatus = $acptsts[0];
      $nxtstatus['vStatusMsg'] = $acptsts[0]['vStatusMsg_'.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG']];
      $permitted = 'Yes';
      } */ else if ($poData['iaStatusID'] < $isusts[0]['iStatusID'] && $poData['eDelete'] != 'Yes') {
        $orgacpt = $orgprefObj->getStatusDetails($poData['iSupplierOrganizationID'], 'acceptance');  // acceptance
        $sorgprfdt = $orgprefObj->getDetails("*", " AND iOrganizationID=" . $poData['iSupplierOrganizationID']);
        $orgpoacstatus = $orgacpt['po'];
        if ($sorgprfdt[0]['eReqVerifyPoAcpt'] == 'Yes' && $poData['iaStatusID'] == $crtsts[0]['iStatusID']) {
            $vrfsts = $statusmasterObj->getDetails('*', " AND eFor='PO' AND vStatus_en='Verify' ");
            $nxtstatus = $vrfsts[0];  // $orgpoacstatus[0];
            $nxtstatus['vStatusMsg'] = $vrfsts[0]['vStatusMsg_' . $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_LANG']];
            if ($sess_usertype_short == 'OU') {
                if (strpos($ures[0]['eVerify'], 'pa') !== false) {
                    $permitted = 'Yes';
                } else {
                    $permitted = 'No';
                }
            }
        } else {
            $nxtst = 'n';
            for ($l = 0; $l < count($orgpoacstatus); $l++) {
                if ($poData['iaStatusID'] == $orgpoacstatus[$l]['iStatusID']) {  // && in_array($orgpostatus[$l+1]['iStatusID'],$mth)
                    if (isset($orgpoacstatus[$l + 1])) {
                        $nxtstatus = $orgpoacstatus[$l + 1];
                        $nxtst = 'y';
                        $iststs = $statusmasterObj->getDetails('*', " AND eFor='PO' AND vStatus_en='Issue' ");
                        if ($nxtstatus['iStatusID'] == $iststs[0]['iStatusID'] || $nxtstatus['iStatusID'] == $isusts[0]['iStatusID']) {
                            if (isset($orgpoacstatus[$l + 2]) && $orgpoacstatus[$l + 2]['iStatusID'] != $rjtsts) {
                                $nxtstatus = $orgpoacstatus[$l + 2];
                            } else {
                                $nxtst = 'n';
                            }
                        }
                    }/* else {
                      $nxtstatus = $orgpoacstatus[$l];
                      } */
                    break;
                }
            }
            if ($nxtst == 'n') {
                $nxtstatus = $acptsts[0];
            }
            $upoact = @explode(',', $poUserAcptIds);
            if (in_array($nxtstatus['iStatusID'], $upoact) && $poData['iModifiedByID'] != $sess_id) {
                $permitted = 'Yes';
            }
        }
        // prints($orgpoacstatus); exit;
        // prints($orgpoacstatus); exit;
        /* if($poData['iaStatusID'] == $orgpoacstatus[count($orgpoacstatus)-1]['iStatusID'] && $poData['iStatusID'] != $rjtsts) {
          $nxtstatus = $isusts[0]; 	// $acptsts[0]; 	// $isusts[0];
          } */
    }
}
//prints($poData);
if ($poData['iModifiedByID'] == $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'] && $poData['eDelete'] == 'Yes') {
    $nxtstatus['vStatusMsg'] = $smarty->get_template_vars('MSG_OTHER_VERIFICATION_NEED');
}
//prints($poData);
$crt_inv = '';
if ($poData['iStatusID'] == $acptsts[0]['iStatusID'] && (trim($poData['iInvoiceID']) < 1 || trim($poData['iInvoiceID']) == '')) {
    if ($curORGID == $poData['iSupplierOrganizationID']) {
        $inv = $iohObj->getDetails('iInvoiceID', " AND iPurchaseOrderID=$iPurchaseOrderID ");
        if (count($inv) == 0) {
            $crt_inv = 'yes';
        }
    }
    // echo "hi"; exit;
}
$invstat = "";
if ($poData['iBuyerOrganizationID'] == $curORGID) {
    if ($isusts[0]['iStatusID'] == $poData['iStatusID'] && (trim($poData['iInvoiceID']) == '' || trim($poData['iInvoiceID']) < 1)) {
        // $invstat = 'ureview';
    } else {  // if(trim($poData['iInvoiceID'])>0)
        $rlinv = $iohObj->getDetails('iStatusID', " AND iPurchaseOrderID=$iPurchaseOrderID ", " iInvoiceID DESC ");
        if (isset($rlinv) && count($rlinv) > 0) {
            if ($rlinv[0]['iStatusID'] == 0 && isset($rlinv[0]['iStatusID'])) {
                $invstat = 'ureview';
            }
        }
        if (count($rlinv) > 0 && is_array($rlinv)) {
            $rjtinvs = $statusmasterObj->getDetails('iStatusID', " AND eFor='Invoice' AND vStatus_en='Rejected' ");
            $acptinvs = $statusmasterObj->getDetails('iStatusID', " AND eFor='Invoice' AND vStatus_en='Accepted' ");
            $crtinvs = $statusmasterObj->getDetails('iStatusID', " AND eFor='Invoice' AND vStatus_en='Create' ");
            $isuinvs = $statusmasterObj->getDetails('iStatusID', " AND eFor='Invoice' AND vStatus_en='Issued' ");
            if ($rlinv[0]['iStatusID'] == $rjtinvs[0]['iStatusID']) {
                $invstat = 'rjct';
            } else if ($rlinv[0]['iStatusID'] == $isuinvs[0]['iStatusID']) {
                $invstat = 'isu';
            } else if ($rlinv[0]['iStatusID'] == $acptinvs[0]['iStatusID']) {
                $invstat = 'acpt';
            } else if ($rlinv[0]['iStatusID'] > $crtinvs[0]['iStatusID'] && $rlinv[0]['iStatusID'] < $isuinvs[0]['iStatusID']) {
                $invstat = 'prt';
            }
        }
    }
}
if ($poData['iStatusID'] == $acptsts[0]['iStatusID']) {
    $invstat = 'act';
}
$imgdt = '';
if (trim($poData['vImage']) != '') {
    // prints($invoiceData); exit;
    $img = $generalobj->ShowImage(array('section' => 'PO', 'type' => 'image', 'id' => $poData['iPurchaseOrderID'], 'name' => $poData['vImage']));
    $imgdt = 'yes';
    $img = $img[1];
    $smarty->assign('img', $img);
    // prints($img); exit;
}
if (!isset($poAttachmentObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.PurchaseOrderAttachment.php");
    $poAttachmentObj = new PurchaseOrderAttachment();
}
$poAttachments = $poAttachmentObj->getDetails('*', ' AND iPurchaseOrderID="' . $iPurchaseOrderID . '"');

if ($poData['eDelete'] == 'Yes' && $poData['iModifiedByID'] != $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID']) {
    $nxtstatus['vStatusMsg'] = $smarty->get_template_vars('LBL_VERIFY_TO_DELETE');
} elseif ($poData['iModifiedByID'] == $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID']) {
    $permitted = 'No';
}
if ($poData['iModifiedByID'] == $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'] && $poData['eDelete'] == 'Yes') {
    $nxtstatus['vStatusMsg'] = $smarty->get_template_vars('MSG_OTHER_VERIFICATION_NEED');
}

$act = 'n';
if ($poData['iStatusID'] == $isusts[0]['iStatusID'] && $poData['iaStatusID'] == 0 && $poData['iSupplierOrganizationID'] == $curORGID) {
    $pouact = @explode(',', $poUserAcptIds);
    if (in_array($acptsts[0]['iStatusID'], $pouact)) {
        $permitted = 'Yes';
        $nxtstatus = $crtsts[0];
        $nxtstatus['vStatusMsg'] = $nxtstatus['vStatusMsg_' . LANG];
        $act = 'y';
    } else {
        $permitted = 'No';
    }
} else if ($poData['iStatusID'] < $isusts[0]['iStatusID'] && $poData['iSupplierOrganizationID'] == $curORGID) {
    $nxtstatus = array();
    $permitted = 'No';
}
$auth = 'n';
if (isset($nxtstatus['vStatus']) && $nxtstatus['vStatus'] != '') {
    if ($nxtstatus['vStatus'] == 'Auth1' || $nxtstatus['vStatus'] == 'Auth2' || $nxtstatus['vStatus'] == 'Auth3' || $nxtstatus['vStatus_en'] == 'Auth1' || $nxtstatus['vStatus_en'] == 'Auth2' || $nxtstatus['vStatus_en'] == 'Auth3') {
        $auth = 'y';
    }
    $smarty->assign('act', $act);
    $smarty->assign('auth', $auth);
    $isue = 'n';
    if ($nxtstatus['vStatus'] == 'Issue' || $nxtstatus['vStatus_en'] == 'Issue') {
        $isue = 'y';
    }
    $smarty->assign('isue', $isue);
}

if ((($poData['iStatusID'] == $rjtsts && $poData['eDelete'] != 'Yes') || $poData['eSaved'] == 'Yes') && $sess_usertype_short == 'OU') {
    if (!($poData['iSupplierOrganizationID'] == $curORGID && $poData['iaStatusID'] == $rjtsts)) {
        if ($poData['iBuyerOrganizationID'] == $curORGID && $poData['eSaved'] == 'Yes') {
            if(isset($upermits) && in_array($crtsts[0]['iStatusID'],$upermits['po'])) {
				header("Location: " . SITE_URL_DUM . "purchaseordercreate/$iPurchaseOrderID");
				exit;
			} else {
				$permitted = 'No';
				$nxtstatus = array();
			}
        } else {
            $permitted = 'No';
			$nxtstatus = array();
        }
    }
}

/* $suporgName = $orgObj->getDetails("vCompanyName"," AND iOrganizationID=".$poData['iSupplierOrganizationID']);
  $poData['vSupplierName'] = $suporgName[0]['vCompanyName'];
  $supusrName = $orgUserObj->getDetails(" CONCAT(vFirstName,' ',vLAstName) as name "," AND iUserID=".$poData['iSupplierID']);
  $poData['vSupplierContactParty'] = $supusrName[0]['name']; */
$poprefdt = $poprefObj->getDetails("*", " AND iPurchaseOrderID=$iPurchaseOrderID ");
// prints($poprefdt); exit;
//prints($isusts); exit;
// prints($poData); exit;
// prints($nxtstatus); exit;
// prints($permitted); exit;
$smarty->assign('poData', $poData);
$smarty->assign('poprefdt', $poprefdt);
$smarty->assign('iPurchaseOrderID', $iPurchaseOrderID);
$smarty->assign('permitted', $permitted);
$smarty->assign('rjtsts', $rjtsts);
$smarty->assign('nxtstatus', $nxtstatus);
$smarty->assign('crt_inv', $crt_inv);
$smarty->assign('invstat', $invstat);
$smarty->assign('imgdt', $imgdt);
$smarty->assign('poAttachments', $poAttachments);
$smarty->assign('var_msg', $var_msg);
?>