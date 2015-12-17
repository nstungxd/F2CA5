<?php

include(S_SECTIONS . "/member/memberaccess.php");

$UserName = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_USER_NAME'];
$msg = $_GET['msg'];

if ($msg == 'ras') {
    $msg = $smarty->get_template_vars('MSG_ADD_SUCC');
} elseif ($msg == 'raserr') {
    $msg = $smarty->get_template_vars('MSG_ADD_ERR');
} elseif ($msg == 'rus') {
    $msg = $smarty->get_template_vars('MSG_UPDATE_SUCC');
} elseif ($msg == 'ruserr') {
    $msg = $smarty->get_template_vars('MSG_UPDATE_ERR');
} else if ($msg != 'pop') {
    $msg = '';
}

$iInvoiceID = $_GET['id'];
if (!isset($invOrderObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.InvoiceOrderHeading.php");
    $invOrderObj = new InvoiceOrderHeading();
}
if (!isset($orgprefObj)) {
    include_once(SITE_CLASS_APPLICATION . "organization/class.OrganizationPreference.php");
    $orgprefObj = new OrganizationPreference();
}
if (!isset($orgUserObj)) {
    include_once(SITE_CLASS_APPLICATION . 'user/class.OrganizationUser.php');
    $orgUserObj = new OrganizationUser();
}
if (!isset($orgUserPermObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.OrganizationUserPermission.php");
    $orgUserPermObj = new OrganizationUserPermission();
}
if (!isset($pohObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.PurchaseOrderHeading.php");
    $pohObj = new PurchaseOrderHeading();
}
if (!isset($statusmasterObj)) {
    include_once(SITE_CLASS_APPLICATION . "class.StatusMaster.php");
    $statusmasterObj = new StatusMaster();
}
if (!isset($invprefObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.InvoiceOtherInformation.php");
    $invprefObj = new InvoiceOtherInformation();
}

$crtsts = $statusmasterObj->getDetails('*', " AND eFor='Invoice' AND vStatus_en='Create' ");
$stsdtls = $statusmasterObj->getDetails('*', " AND eFor='Invoice' AND vStatus_en='Rejected' ");
$rjtsts = $stsdtls[0]['iStatusID'];
$stsdtls = $statusmasterObj->getDetails('*', " AND eFor='Invoice' AND vStatus_en='Accepted' ");
$acptsts = $stsdtls;
$lang = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_LANG'];
$stsdtls = $statusmasterObj->getDetails("*, vStatusMsg_$lang as vStatusMsg", " AND eFor='Invoice' AND vStatus_en='Issued' ");
$isusts = $stsdtls;

$fields = " ioh.*, (select vState from b2b_state_master sm where BINARY sm.vStateCode=ioh.vBillToState AND BINARY sm.vCountryCode=ioh.vBillToCountry) as vBillToState,
				(select vCountry from b2b_country_master cm where BINARY cm.vCountryCode=ioh.vBillToCountry) as vBillToCountry	";
$invoiceData = $invOrderObj->getJoinTableInfo('', $fields, " AND iInvoiceID=$iInvoiceID ");
$isdtls = $statusmasterObj->getDetails('*', " AND eFor='Invoice' AND vStatus_en='Issued' ");
$isdtls = $isdtls[0]['iStatusID'];
if (!(is_array($invoiceData) && count($invoiceData) > 0)) {
    header("Location: " . SITE_URL_DUM . "invoicelist");
    exit;
}
if ($uorg_type == 'Buyer2') {
    $b2us = $invOrderObj->getInvoiceRfq2Buyer2OrgIds($iInvoiceID);
    if (!in_array($curORGID, $b2us)) {
        header("Location: " . SITE_URL_DUM . "invoicelist");
        exit;
    }
} else if ($invoiceData[0]['iBuyerOrganizationID'] != $curORGID && $invoiceData[0]['iSupplierOrganizationID'] != $curORGID) {
    header("Location: " . SITE_URL_DUM . "invoicelist/all");
    exit;
} else if ($invoiceData[0]['iBuyerOrganizationID'] == $curORGID && $invoiceData[0]['iStatusID'] < $isdtls) {
    header("Location: " . SITE_URL_DUM . "invoicelist/all");
    exit;
}

/* if((($invoiceData[0]['iStatusID']==$rjtsts || $invoiceData[0]['eSaved']=='Yes') && $invoiceData[0]['eDelete']!='Yes' && $invoiceData[0]['iBuyerOrganizationID']!=$curORGID) && $sess_usertype_short == 'OU') {
  if(!($invoiceData[0]['iSupplierOrganizationID']==$curORGID && $invoiceData[0]['iaStatusID']==$rjtsts) && $invoiceData[0]['eCreateByBuyer']!='Yes') {
  header("Location: ".SITE_URL_DUM."invoicecreate/$iInvoiceID");
  exit;
  }
  } */
// exit;
/* if((($invoiceData[0]['iStatusID']==$rjtsts && $invoiceData[0]['eDelete']!='Yes' && $invoiceData[0]['iBuyerOrganizationID']!=$curORGID) || $invoiceData[0]['eSaved']=='Yes') && $sess_usertype_short == 'OU') {
  if(!($invoiceData[0]['iSupplierOrganizationID']==$curORGID && $invoiceData[0]['iaStatusID']==$rjtsts)) {
  header("Location: ".SITE_URL_DUM."invoicecreate/$iInvoiceID");
  exit;
  }
  } */
// echo "hi"; exit;
$orgpref = $orgprefObj->getStatusDetails($invoiceData[0]['iSupplierOrganizationID']);
/* if($invoiceData[0]['iPurchaseOrderID'] >0) {
  $orgpref = $orgprefObj->getStatusDetails($invoiceData[0]['iBuyerOrganizationID'],'acceptance');
  // prints($orgpref); exit;
  $mchpref = $orgprefObj->getStatusDetails($invoiceData[0]['iSupplierOrganizationID'],'acceptance');
  $mth = array();
  for($l=0;$l<count($mchpref['inv']);$l++) {
  $mth[] = $mchpref['inv'][$l]['iStatusID'];
  }
  // unset($mth[1]);
  // prints($mth); exit;
  } else {
  $orgpref = $orgprefObj->getStatusDetails($invoiceData[0]['iSupplierOrganizationID']);
  } */
//$orgpref = $orgprefObj->getStatusDetails($invoiceData[0]['iSupplierOrganizationID']);
// $orgpref = $orgprefObj->getStatusDetails($invoiceData[0]['iBuyerOrganizationID'],'acceptance');
$invoiceData = $invoiceData[0];
$orginvstatus = $orgpref['inv'];
// prints($orginvstatus); exit;
$permitted = '';
$nxtstatus = array();
$orgusrs = $orgUserObj->getDetails('*', " AND iOrganizationID=" . $invoiceData['iSupplierOrganizationID']);
// prints($invoiceData); exit;
$sorgprfdt = $orgprefObj->getDetails("*", " AND iOrganizationID=" . $invoiceData['iSupplierOrganizationID']);
$borgprfdt = $orgprefObj->getDetails("*", " AND iOrganizationID=" . $invoiceData['iBuyerOrganizationID']);
if ($invoiceData['iStatusID'] == $crtsts[0]['iStatusID'] && $sorgprfdt[0]['eReqVerificationInv'] == 'Yes') {
    $vrfsts = $statusmasterObj->getDetails('*', " AND eFor='Invoice' AND vStatus_en='Verify' ");
    $nxtstatus = $vrfsts[0];
    $nxtstatus['vStatusMsg'] = $vrfsts[0]['vStatusMsg_' . $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_LANG']];
} else {
    if ($invoiceData['iStatusID'] != $isusts[0]['iStatusID']) {
//	if(count($orgusrs)>1 && $invoiceData['iStatusID']!=$acptsts[0]['iStatusID']) {
        if ($invoiceData['iStatusID'] != $isusts[0]['iStatusID'] && $invoiceData['iStatusID'] != $acptsts[0]['iStatusID']) {  // count($orgusrs)>1
            // echo $orginvstatus[count($orginvstatus)-1]['iStatusID']; exit;
            if ($invoiceData['iStatusID'] == $orginvstatus[count($orginvstatus) - 1]['iStatusID']) {
                $nxtstatus = $isusts[0];  // $acptsts[0]; 	// $isusts[0];
            } /* else if($invoiceData['iStatusID'] == $crtsts[0]['iStatusID']) {
              $nxtstatus = $orginvstatus[1];
              } */ else {
                $nxtset = 'n';
                $nxtstatus = $orginvstatus[$l];
                //if($invoiceData['iPurchaseOrderID']=='' || $invoiceData['iPurchaseOrderID']<1) {
                // prints($orginvstatus); exit;
                for ($l = 0; $l < count($orginvstatus); $l++) {
                    $nxtlevel = '1';
                    if ($invoiceData['iStatusID'] == $orginvstatus[$l]['iStatusID']) {
                        if (isset($orginvstatus[$l + 1])) {
                            $nxtstatus = $orginvstatus[$l + 1];
                            $nxtset = 'y';
                        }
                        break;
                    }
                }
                //}
                /* else if($invoiceData['iPurchaseOrderID']>0) { 	// $nxtset!='y' &&
                  for($l=0; $l<count($orginvstatus); $l++) {
                  if($orginvstatus[$l]['iStatusID'] > $invoiceData['iStatusID'] && in_array($orginvstatus[$l]['iStatusID'],$mth)) {
                  $nxtstatus = $orginvstatus[$l];
                  break;
                  }
                  }
                  } */
            }
        } else {
            $nxtstatus = $acptsts[0];  // $isusts[0];
        }
    }
}
// prints($nxtstatus); exit;
if ($invoiceData['iStatusID'] == $isusts[0]['iStatusID'] && $orgtype != 'Supplier' && $curORGID != $invoiceData['iSupplierOrganizationID']) {
    $upermits = $orgUserPermObj->getUserPermits($sess_id, 'acpt');
} else {
    $upermits = $orgUserPermObj->getUserPermits($sess_id);
}

if (!is_array($upermits['inv'])) {
    $upermits['inv'] = array();
}
if ($sess_usertype != 'orgadmin') {
    if (isset($nxtstatus['iStatusID'])) {
        if ((in_array($nxtstatus['iStatusID'], $upermits['inv']) && $sess_usertype_short == 'OU' && $invoiceData['iStatusID'] != $isusts[0]['iStatusID'] && $invoiceData['iStatusID'] != $acptsts[0]['iStatusID']) || $invoiceData['eDelete'] == 'Yes') {
            $permitted = 'Yes';
            /* if($invoiceData['iStatusID']==0 && strpos($ures[0]['eVerify'],'inv')===false) {
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
    if ($invoiceData['iStatusID'] == 0) {
        if ($curORGID == $invoiceData['iSupplierOrganizationID']) {
            if ($sorgprfdt[0]['eReqVerificationInv'] == 'Yes') {
                if (strpos($ures[0]['eVerify'], 'ii') !== false) {
                    $permitted = 'Yes';
                } else {
                    $permitted = 'No';
                }
            }
        }
    } else if ($invoiceData['iaStatusID'] == $crtsts[0]['iStatusID']) {
        if ($curORGID == $invoiceData['iBuyerOrganizationID']) {
            if ($borgprfdt[0]['eReqVerifyInvAcpt'] == 'Yes') {
                if (strpos($ures[0]['eVerify'], 'ia') !== false) {
                    $permitted = 'Yes';
                } else {
                    $permitted = 'No';
                }
            }
        }
    }
    /* if($invoiceData['iStatusID']==0 && strpos($ures[0]['eVerify'],'inv')!==false) {
      $permitted = 'Yes';
      } else if($invoiceData['iStatusID']==0) {
      $permitted = 'No';
      } */
}
if ($invoiceData['iModifiedByID'] == $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID']) {
    $permitted = 'No';
}
// echo $curORGID;
//prints($_SESSION);
//prints($invoiceData); exit;
if ($invoiceData['iBuyerOrganizationID'] == $curORGID && $invoiceData['iStatusID'] == $isusts[0]['iStatusID']) {
    if ($invoiceData['eDelete'] == 'Yes' && $invoiceData['iModifiedByID'] != $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'] && $invoiceData['iSupplierOrganizationID'] == $curORGID) {
        $nxtstatus['vStatusMsg'] = $smarty->get_template_vars('LBL_VERIFY_TO_DELETE');
        $permitted = 'Yes';
    } /* else if($invoiceData['eDelete'] != 'Yes') {
      $nxtstatus = $acptsts[0];
      $nxtstatus['vStatusMsg'] = $acptsts[0]['vStatusMsg_'.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG']];
      $permitted = 'Yes';
      } */ else if ($invoiceData['iaStatusID'] < $isusts[0]['iStatusID'] && $invoiceData['eDelete'] != 'Yes') {
        $orgacpt = $orgprefObj->getStatusDetails($invoiceData['iBuyerOrganizationID'], 'acceptance');
        $borgprfdt = $orgprefObj->getDetails("*", " AND iOrganizationID=" . $invoiceData['iBuyerOrganizationID']);
        $orgioacstatus = $orgacpt['inv'];
        if ($borgprfdt[0]['eReqVerifyInvAcpt'] == 'Yes' && $invoiceData['iaStatusID'] == $crtsts[0]['iStatusID']) {
            $vrfsts = $statusmasterObj->getDetails('*', " AND eFor='Invoice' AND vStatus_en='Verify' ");
            $nxtstatus = $vrfsts[0];  // $orgpoacstatus[0];
            $nxtstatus['vStatusMsg'] = $vrfsts[0]['vStatusMsg_' . $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_LANG']];
            // $nxtstatus = $orgioacstatus[0];
            if ($sess_usertype_short == 'OU') {
                if (strpos($ures[0]['eVerify'], 'ia') !== false) {
                    $permitted = 'Yes';
                } else {
                    $permitted = 'No';
                }
            }
        } else {
            $nxtst = 'n';
            for ($l = 0; $l < count($orgioacstatus); $l++) {
                if ($invoiceData['iaStatusID'] == $orgioacstatus[$l]['iStatusID']) {  // && in_array($orgpostatus[$l+1]['iStatusID'],$mth)
                    if (isset($orgioacstatus[$l + 1])) {
                        $nxtstatus = $orgioacstatus[$l + 1];
                        $nxtst = 'y';
                        $iststs = $statusmasterObj->getDetails('*', " AND eFor='Invoice' AND vStatus_en='Issue' ");
                        if ($nxtstatus['iStatusID'] == $iststs[0]['iStatusID'] || $nxtstatus['iStatusID'] == $isusts[0]['iStatusID']) {
                            if (isset($orgioacstatus[$l + 2]) && $orgioacstatus[$l + 2]['iStatusID'] != $rjtsts) {
                                $nxtstatus = $orgioacstatus[$l + 2];
                            } else {
                                $nxtst = 'n';
                            }
                        }
                    }
                    break;
                }
            }
            if ($nxtst == 'n') {
                $nxtstatus = $acptsts[0];
            }
            $uioact = @explode(',', $invUserAcptIds);
            if (in_array($nxtstatus['iStatusID'], $uioact) && $invoiceData['iModifiedByID'] != $sess_id) {
                $permitted = 'Yes';
            }
        }
    }
}
if ($invoiceData['iModifiedByID'] == $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'] && $invoiceData['eDelete'] == 'Yes') {
    $nxtstatus['vStatusMsg'] = $smarty->get_template_vars('MSG_OTHER_VERIFICATION_NEED');
}
// prints($nxtstatus); exit;
//prints ($invoiceData);
//prints($nxtstatus);
// prints($invoiceData); exit;
$crt_inv = '';
if ($invoiceData['iStatusID'] == $acptsts[0]['iStatusID'] && (trim($invoiceData['iPurchaseOrderID']) < 1 || trim($invoiceData['iPurchaseOrderID']) == '')) {
    if ($curORGID == $invoiceData['iBuyerOrganizationID']) {
        $po = $pohObj->getDetails('iInvoiceID', " AND iInvoiceID=$iInvoiceID ");
        if (count($po) == 0) {
            $crt_inv = 'yes';
        }
    }
    // echo "hi"; exit;
}
$postat = '';
if ($invoiceData['iSupplierOrganizationID'] == $curORGID) {
    if ($isusts[0]['iStatusID'] == $invoiceData['iStatusID'] && (trim($invoiceData['iPurchaseOrderID']) == '' || trim($invoiceData['iPurchaseOrderID']) < 1)) {
        // $postat = 'ureview';
    } else {
        $rlpo = $pohObj->getDetails('*', " AND iInvoiceID=$iInvoiceID ", " iPurchaseOrderID DESC ");
        if (is_array($rlpo) && count($rlpo) > 0) {
            if ($rlpo[0]['iStatusID'] == 0 && isset($rlpo[0]['iStatusID'])) {
                $postat = 'ureview';
            }
        }
        if (count($rlpo) > 0 && is_array($rlpo)) {
            $rjtinvs = $statusmasterObj->getDetails('iStatusID', " AND eFor='PO' AND vStatus_en='Rejected' ");
            $acptinvs = $statusmasterObj->getDetails('iStatusID', " AND eFor='PO' AND vStatus_en='Accepted' ");
            $crtinvs = $statusmasterObj->getDetails('iStatusID', " AND eFor='PO' AND vStatus_en='Create' ");
            $isuinvs = $statusmasterObj->getDetails('iStatusID', " AND eFor='PO' AND vStatus_en='Issued' ");
            if ($rlpo[0]['iStatusID'] == $rjtinvs[0]['iStatusID']) {
                $postat = 'rjct';
            } else if ($rlpo[0]['iStatusID'] == $isuinvs[0]['iStatusID']) {
                $postat = 'isu';
            } else if ($rlpo[0]['iStatusID'] == $acptinvs[0]['iStatusID']) {
                $postat = 'acpt';
            } else if ($rlpo[0]['iStatusID'] > $crtinvs[0]['iStatusID'] && $rlpo[0]['iStatusID'] < $isuinvs[0]['iStatusID']) {
                $postat = 'prt';
            }
        }
    }
}
if ($invoiceData['iStatusID'] == $acptsts[0]['iStatusID']) {
    $postat = 'act';
}
$imgdt = '';
if (trim($invoiceData['vImage']) != '') {
    // prints($invoiceData); exit;
    $img = $generalobj->ShowImage(array('section' => 'INV', 'type' => 'image', 'id' => $invoiceData['iInvoiceID'], 'name' => $invoiceData['vImage']));
    $imgdt = 'yes';
    $img = $img[1];
    $smarty->assign('img', $img);
}

if (!isset($invAttachmentObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.InvoiceOrderAttachment.php");
    $invAttachmentObj = new InvoiceOrderAttachment();
}
$invAttachments = $invAttachmentObj->getDetails('*', " AND iInvoiceID='" . $iInvoiceID . "'");
//prints($_SESSION);
if ($invoiceData['iModifiedByID'] == $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'] && $invoiceData['eDelete'] == 'Yes') {
    $nxtstatus['vStatusMsg'] = $smarty->get_template_vars('MSG_OTHER_VERIFICATION_NEED');
} elseif ($invoiceData['iModifiedByID'] == $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID']) {
    $permitted = 'No';
}
if ($invoiceData['eDelete'] == 'Yes' && $invoiceData['iModifiedByID'] != $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID']) {
    $nxtstatus['vStatusMsg'] = $smarty->get_template_vars('LBL_VERIFY_TO_DELETE');
}

$act = 'n';
if ($invoiceData['iStatusID'] == $isusts[0]['iStatusID'] && $invoiceData['iaStatusID'] == 0 && $invoiceData['iBuyerOrganizationID'] == $curORGID) {
    $iouact = @explode(',', $invUserAcptIds);
    // prints($ures); exit;
    if (in_array($acptsts[0]['iStatusID'], $iouact) && $invoiceData['iModifiedByID'] != $sess_id) {
        $permitted = 'Yes';
        $nxtstatus = $crtsts[0];
        $nxtstatus['vStatusMsg'] = $nxtstatus['vStatusMsg_' . LANG];
        $act = 'y';
    } else {
        $permitted = 'No';
    }
} else if ($invoiceData['iStatusID'] < $isusts[0]['iStatusID'] && $invoiceData['iBuyerOrganizationID'] == $curORGID) {
    $nxtstatus = array();
    $permitted = 'No';
}
$auth = 'n';
if (isset($nxtstatus['vStatus'])) {
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

$iprefdt = $invprefObj->getDetails("*", " AND iInvoiceID=$iInvoiceID ");
// prints($iprefdt); exit;

if ((($invoiceData['iStatusID'] == $rjtsts || $invoiceData['eSaved'] == 'Yes') && $invoiceData['eDelete'] != 'Yes' && $invoiceData['iBuyerOrganizationID'] != $curORGID) && $sess_usertype_short == 'OU') {
    if (!($invoiceData['iSupplierOrganizationID'] == $curORGID && $invoiceData['iaStatusID'] == $rjtsts) && $invoiceData['eCreateByBuyer'] != 'Yes') {
        if ($invoiceData['iSupplierOrganizationID'] == $curORGID && $invoiceData['eSaved'] == 'Yes') {
            if(isset($upermits) && in_array($crtsts[0]['iStatusID'],$upermits['inv'])) {
				header("Location: " . SITE_URL_DUM . "invoicecreate/$iInvoiceID");
				exit;
			} else {
				$permitted = 'No';
				$nxtstatus = array();
			}
        } else {
            header("Location: " . SITE_URL_DUM . "invoicecreate/$iInvoiceID");
            exit;
        }
    }
}
if ($invoiceData['iBuyerOrganizationID'] == $curORGID && ($invoiceData['eSaved'] == 'Yes' || $invoiceData['iaStatusID'] == $rjtsts) && $invoiceData['eCreateByBuyer'] == 'Yes') {
//    header("Location: " . SITE_URL_DUM . "invoicecreate/$iInvoiceID");
//    exit;
	if(isset($upermits) && in_array($crtsts[0]['iStatusID'], $upermits['inv'])) {
		header("Location: " . SITE_URL_DUM . "invoicecreate/$iInvoiceID");
		exit;
	}
    $permitted = 'No';
    $nxtstatus = array();
}

//echo $permitted; exit;
// prints($nxtstatus); exit;
$smarty->assign('invoiceData', $invoiceData);
$smarty->assign('iprefdt', $iprefdt);
$smarty->assign('iInvoiceID', $iInvoiceID);
$smarty->assign('permitted', $permitted);
$smarty->assign('rjtsts', $rjtsts);
$smarty->assign('msg', $msg);
$smarty->assign('nxtstatus', $nxtstatus);
$smarty->assign('crt_inv', $crt_inv);
$smarty->assign('postat', $postat);
$smarty->assign('imgdt', $imgdt);
$smarty->assign('invAttachments', $invAttachments);
?>