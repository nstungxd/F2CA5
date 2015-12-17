<?php

include(S_SECTIONS . "/member/memberaccess.php");
if (!isset($orgUserObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.OrganizationUser.php");
    $orgUserObj = new OrganizationUser();
}
if (!isset($orgprefObj)) {
    include_once(SITE_CLASS_APPLICATION . "organization/class.OrganizationPreference.php");
    $orgprefObj = new OrganizationPreference();
}
if (!isset($stMstrObj)) {
    include_once(SITE_CLASS_APPLICATION . "class.StatusMaster.php");
    $stMstrObj = new StatusMaster();
}
if (!isset($poheadingObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.PurchaseOrderHeading.php");
    $poheadingObj = new PurchaseOrderHeading();
}
if (!isset($invordheadingObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.InvoiceOrderHeading.php");
    $invordheadingObj = new InvoiceOrderHeading();
}
if (!isset($statusmasterObj)) {
    include_once(SITE_CLASS_APPLICATION . "class.StatusMaster.php");
    $statusmasterObj = new StatusMaster();
}
if (!isset($r2bdobj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.Rfq2Bids.php");
    $r2bdobj = new Rfq2Bids();
}
if (!isset($rfq2awardObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.Rfq2Award.php");
    $rfq2awardObj = new Rfq2Award();
}

// --- Statistics --------------------------------------------------------------------------------------------
$userrights = $orgUserObj->getUserPermission($_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID']);
// echo $userrights; exit;
if (is_array($userrights) && count($userrights) > 0) {
    $urights = $userrights;
}
if (trim($urights['issu']) != '') {
    $urights['issu'] = @explode(',', $urights['issu']);
} else {
    $urights['issu'] = array();
}
if (trim($urights['acpt']) != '') {
    $urights['acpt'] = @explode(',', $urights['acpt']);
} else {
    $urights['acpt'] = array();
}
/* if(trim($userrights)!='') {
  $urights = @explode(',',$userrights);
  } else {
  $urights = array();
  } */
$usts = array();
// prints($opf); exit;
$orglvl['poisu'] = @explode(',', $opf[0]['vOrderStatusLevel']);
$orglvl['poacpt'] = @explode(',', $opf[0]['vOrderAcceptanceLevel']);
$orglvl['invisu'] = @explode(',', $opf[0]['vInvoiceStatusLevel']);
$orglvl['invacpt'] = @explode(',', $opf[0]['vInvoiceAcceptanceLevel']);
// echo $opf[0]['vOrderAcceptanceLevel']; exit;
// prints($orglvl); exit;
//prints($urights); exit;
$smarty->assign("urights", $urights);
$smarty->assign("orglvl", $orglvl);

$userStatus = $stMstrObj->getDetails('iStatusID', "", " iStatusId ASC ");
// prints($userStatus); exit;
for ($i = 0; $i < count($userStatus); $i++) {
    $usts[] = $userStatus[$i]['iStatusID'];
}
if (is_array($usts) && count($usts) > 0) {
    $userStatus = @implode(',', $usts);
} else {
    $userStatus = "";
}

$poisu = $statusmasterObj->getDetails('iStatusID', " AND eFor='PO' AND vStatus_en='Issued' ");
$poisu = $poisu[0]['iStatusID'];
$poapt = $statusmasterObj->getDetails('iStatusID', " AND eFor='PO' AND vStatus_en='Accepted' ");
$poapt = $poapt[0]['iStatusID'];
$invisu = $statusmasterObj->getDetails('iStatusID', " AND eFor='Invoice' AND vStatus_en='Issued' ");
$invisu = $invisu[0]['iStatusID'];
$invapt = $statusmasterObj->getDetails('iStatusID', " AND eFor='Invoice' AND vStatus_en='Accepted' ");
$invapt = $invapt[0]['iStatusID'];
$wh_po = '';
$wh_inv = '';
if ($orgtype != 'Buyer') {
    $wh_po = " OR IF(bsm.iStatusID=$poisu OR bsm.iStatusID=$poapt, (iSupplierOrganizationID=$curORGID),0 ) ";
}
if ($orgtype != 'Supplier') {
    $wh_inv = " OR IF(bsm.iStatusID=$invisu OR bsm.iStatusID=$invapt, (iBuyerOrganizationID=$curORGID),0 ) ";
}
$where_s = " AND bsm.iStatusID IN(" . '0,' . $userStatus . ")";
$statistics = $orgUserObj->getOUSatistics($where_s, $curORGID, '', '');
$astatistics = $orgUserObj->getOUSatistics($where_s, $curORGID, $wh_po, $wh_inv, 'acpt');
// prints($statistics); exit;
$crstatisu = $orgUserObj->getCrStats($curORGID);
$smarty->assign("crstatisu", $crstatisu);
$crstatact = $orgUserObj->getCrStats($curORGID, 'acpt');
$vstatistics = $orgUserObj->getNtvPI($curORGID, '');
$avstatistics = $orgUserObj->getNtvPI($curORGID, 'acpt');
$povisu = $statusmasterObj->getDetails('iStatusID', " AND eFor='PO' AND vStatus_en='Verify' ");
$povisu = $povisu[0]['iStatusID'];
$iovapt = $statusmasterObj->getDetails('iStatusID', " AND eFor='Invoice' AND vStatus_en='Verify' ");
$iovapt = $iovapt[0]['iStatusID'];
$crio = $statusmasterObj->getDetails('iStatusID', " AND eFor='Invoice' AND vStatus_en='Create' ");
$crio = $crio[0]['iStatusID'];
$crpo = $statusmasterObj->getDetails('iStatusID', " AND eFor='PO' AND vStatus_en='Create' ");
$crpo = $crpo[0]['iStatusID'];
$isupo = $statusmasterObj->getDetails('iStatusID', " AND eFor='PO' AND vStatus_en='Issue' ");
$isupo = $isupo[0]['iStatusID'];
$isuio = $statusmasterObj->getDetails('iStatusID', " AND eFor='Invoice' AND vStatus_en='Issue' ");
$isuio = $isuio[0]['iStatusID'];
// prints($opf); exit;
if ($opf[0]['eReqVerificationPo'] == 'No') {
    $vstatistics[0]['pocnt'] = '&times;';
}
if ($opf[0]['eReqVerificationInv'] == 'No') {
    $vstatistics[0]['iocnt'] = '&times;';
}
if ($opf[0]['eReqVerifyPoAcpt'] == 'No') {
    $avstatistics[0]['pocnt'] = '&times;';
}
if ($opf[0]['eReqVerifyInvAcpt'] == 'No') {
    $avstatistics[0]['iocnt'] = '&times;';
}
// prints($avstatistics); exit;
$smarty->assign("crstatact", $crstatact);
$smarty->assign("crstatisu", $crstatisu);
$smarty->assign("crio", $crio);
$smarty->assign("crpo", $crpo);
$smarty->assign("povisu", $povisu);
$smarty->assign("iovapt", $iovapt);
$smarty->assign("vstatistics", $vstatistics);
$smarty->assign("avstatistics", $avstatistics);
// prints($crstatact); exit;
/* $vstatistics = $orgUserObj->getNtvPI($curORGID,'');
  // prints($ures); exit;
  $vstatistics[0]['vStatus_en'] = 'Need To Verify'; // LBL_NEED_TO_VERIFY_FOR_CREATION
  $vstatistics[0]['vStatus_fr'] = $smarty->get_template_vars('LBL_NEED_TO_VERIFY_FOR_CREATION');
  $vstatistics[0]['iStatusID'] = '-1';
  // $vstatistics[0]['vStatusMsg_fr'] = $smarty->get_template_vars('LBL_NEED_TO_VERIFY_FOR_CREATION');
  $avstatistics = $orgUserObj->getNtvPI($curORGID,'acpt');
  $avstatistics[0]['vStatus_en'] = 'Need To Verify'; // LBL_NEED_TO_VERIFY_FOR_CREATION
  $avstatistics[0]['vStatus_fr'] = $smarty->get_template_vars('LBL_NEED_TO_VERIFY_FOR_CREATION');
  $avstatistics[0]['iStatusID'] = '-1';
  // prints($opf); exit;
  if($opf[0]['eReqVerificationPo']=='No') {
  $vstatistics[0]['pocnt'] = '&times;';
  }
  if($opf[0]['eReqVerificationInv']=='No') {
  $vstatistics[0]['incnt'] = '&times;';
  }
  if($opf[0]['eReqVerifyPoAcpt']=='No') {
  $avstatistics[0]['pocnt'] = '&times;';
  }
  if($opf[0]['eReqVerifyInvAcpt']=='No') {
  $avstatistics[0]['incnt'] = '&times;';
  } */

// prints($vstatistics); exit;
// prints($avstatistics); exit;
$makeArr = array();
$mkarr = array();
$stats = array();
$astats = array();
// prints($orgtype); exit;
if ($orgtype == 'Buyer') {
    for ($i = count($statistics) - 1; $i >= 0; $i--) {
        if ($statistics[$i]['eFor'] == 'Invoice') {
            unset($statistics[$i]);
        } else {
            if (!in_array($statistics[$i]['iStatusID'], $orglvl['poisu']) && ($statistics[$i]['vStatus_en'] == 'Auth1' || $statistics[$i]['vStatus_en'] == 'Auth2' || $statistics[$i]['vStatus_en'] == 'Auth3' || $statistics[$i]['vStatus_en'] == 'Verify')) {
                $statistics[$i]['incnt'] = '&times;';
                $statistics[$i]['pocnt'] = '&times;';
            } /* else if($statistics[$i]['vStatus_en']=='Accepted') {
              $statistics[$i]['pocnt'] = '&times;';
              } */
            $stats[] = $statistics[$i];
        }
    }
    for ($i = count($astatistics) - 1; $i >= 0; $i--) {
        if ($astatistics[$i]['eFor'] == 'PO') {
            unset($astatistics[$i]);
        } else {
            if (!in_array($astatistics[$i]['iStatusID'], $orglvl['invacpt']) && ($astatistics[$i]['vStatus_en'] == 'Auth1' || $astatistics[$i]['vStatus_en'] == 'Auth2' || $astatistics[$i]['vStatus_en'] == 'Auth3' || $astatistics[$i]['vStatus_en'] == 'Verify')) {
                $astatistics[$i]['incnt'] = '&times;';
                $astatistics[$i]['pocnt'] = '&times;';
            } else if ($astatistics[$i]['vStatus_en'] == 'Issue' || $astatistics[$i]['vStatus_en'] == 'Issued') {
                $astatistics[$i]['incnt'] = '&times;';
            }
            $astats[] = $astatistics[$i];
        }
    }
    $stats = array_reverse($stats);
    $astats = array_reverse($astats);
} else if ($orgtype == 'Supplier') {
    for ($i = count($statistics) - 1; $i >= 0; $i--) {
        if ($statistics[$i]['eFor'] == 'PO') {
            unset($statistics[$i]);
        } else {
            if (!in_array($statistics[$i]['iStatusID'], $orglvl['invisu']) && ($statistics[$i]['vStatus_en'] == 'Auth1' || $statistics[$i]['vStatus_en'] == 'Auth2' || $statistics[$i]['vStatus_en'] == 'Auth3' || $statistics[$i]['vStatus_en'] == 'Verify')) {
                $statistics[$i]['incnt'] = '&times;';
                $statistics[$i]['pocnt'] = '&times;';
            } /* else if($statistics[$i]['vStatus_en']=='Accepted') {
              $statistics[$i]['incnt'] = '&times;';
              } */
            $stats[] = $statistics[$i];
        }
    }
    // prints($astatistics); exit;
    for ($i = count($astatistics) - 1; $i >= 0; $i--) {
        if ($astatistics[$i]['eFor'] == 'Invoice') {
            unset($astatistics[$i]);
        } else {
            if (!in_array($astatistics[$i]['iStatusID'], $orglvl['poacpt']) && ($astatistics[$i]['vStatus_en'] == 'Auth1' || $astatistics[$i]['vStatus_en'] == 'Auth2' || $astatistics[$i]['vStatus_en'] == 'Auth3' || $astatistics[$i]['vStatus_en'] == 'Verify')) {
                // $astatistics[$i]['vStatus_en']!='Create' && $astatistics[$i]['vStatus_en']!='Rejected'
                $astatistics[$i]['incnt'] = '&times;';
                $astatistics[$i]['pocnt'] = '&times;';
            } else if ($astatistics[$i]['vStatus_en'] == 'Issue' || $astatistics[$i]['vStatus_en'] == 'Issued') {
                $astatistics[$i]['pocnt'] = '&times;';
            }
            $astats[] = $astatistics[$i];
        }
    }
    $stats = array_reverse($stats);
    $astats = array_reverse($astats);
} else {
    // prints($statistics); exit;
    for ($i = count($statistics) - 1; $i >= 0; $i--) {
        if ($statistics[$i]['eFor'] == 'Invoice') {
            // unset($statistics[$i]);
        } else {
            if (!in_array($statistics[$i]['iStatusID'], $orglvl['poisu']) && ($statistics[$i]['vStatus_en'] == 'Auth1' || $statistics[$i]['vStatus_en'] == 'Auth2' || $statistics[$i]['vStatus_en'] == 'Auth3' || $statistics[$i]['vStatus_en'] == 'Verify')) {
                $statistics[$i]['incnt'] = '&times;';
                $statistics[$i]['pocnt'] = '&times;';
            }
            $stats[] = $statistics[$i];
        }
    }
    for ($i = count($astatistics) - 1; $i >= 0; $i--) {
        if ($astatistics[$i]['eFor'] == 'PO') {
            // unset($astatistics[$i]);
        } else {
            if (!in_array($astatistics[$i]['iStatusID'], $orglvl['invacpt']) && ($astatistics[$i]['vStatus_en'] == 'Auth1' || $astatistics[$i]['vStatus_en'] == 'Auth2' || $astatistics[$i]['vStatus_en'] == 'Auth3' || $astatistics[$i]['vStatus_en'] == 'Verify')) {
                $astatistics[$i]['incnt'] = '&times;';
                $astatistics[$i]['pocnt'] = '&times;';
            } else if ($astatistics[$i]['vStatus_en'] == 'Issue' || $astatistics[$i]['vStatus_en'] == 'Issued') {
                $astatistics[$i]['incnt'] = '&times;';
            }
            $astats[] = $astatistics[$i];
        }
    }
    for ($i = count($statistics) - 1; $i >= 0; $i--) {
        if ($statistics[$i]['eFor'] == 'PO') {
            // unset($statistics[$i]);
        } else {
            if (!in_array($statistics[$i]['iStatusID'], $orglvl['invisu']) && ($statistics[$i]['vStatus_en'] == 'Auth1' || $statistics[$i]['vStatus_en'] == 'Auth2' || $statistics[$i]['vStatus_en'] == 'Auth3')) {
                $statistics[$i]['incnt'] = '&times;';
                $statistics[$i]['pocnt'] = '&times;';
            }
            $stats[] = $statistics[$i];
        }
    }
    for ($i = count($astatistics) - 1; $i >= 0; $i--) {
        if ($astatistics[$i]['eFor'] == 'Invoice') {
            // unset($astatistics[$i]);
        } else {
            if (!in_array($astatistics[$i]['iStatusID'], $orglvl['poacpt']) && ($astatistics[$i]['vStatus_en'] == 'Auth1' || $astatistics[$i]['vStatus_en'] == 'Auth2' || $astatistics[$i]['vStatus_en'] == 'Auth3')) {
                $astatistics[$i]['incnt'] = '&times;';
                $astatistics[$i]['pocnt'] = '&times;';
            } else if ($astatistics[$i]['vStatus_en'] == 'Issue' || $astatistics[$i]['vStatus_en'] == 'Issued') {
                $astatistics[$i]['pocnt'] = '&times;';
            }
            $astats[] = $astatistics[$i];
        }
    }
    $stats = $statistics;
    $astats = $astatistics;
}
// prints($stats); exit;
// -----------
//prints($astats); exit;
$isustats = array();
$acptstats = array();
$shft_ary = Array('Verify', 'Issue', 'Auth1', 'Auth2', 'Auth3');
$ex_ary = Array('Create', 'Verify');
// prints($orglvl['poisu']); exit;
// pr($stats); exit;
for ($l = 0; $l < count($stats); $l++) {
    /* if((!in_array($stats[$l]['iStatusID'],$orglvl['poisu']) || $stats[$l]['pocnt']=='&times;') && $stats[$l]['eFor']=='PO') {
      if((!in_array($stats[$l]['vStatus_en'],$ex_ary))) {
      $isustats['poisu'][$stats[$l]['iStatusID']] = $stats[$l];
      }
      }
      else */if (in_array($stats[$l]['iStatusID'], $orglvl['poisu'])) {
        for ($ln = 0; $ln < count($orglvl['poisu']); $ln++) {
            if ($stats[$l]['iStatusID'] == $orglvl['poisu'][$ln]) {
                // echo $stats[$l]['iStatusID']."==".$orglvl['poisu'][$ln]; exit;
                if (in_array($stats[$l]['vStatus_en'], $shft_ary)) {
                    if (isset($orglvl['poisu'][$ln + 1])) {
                        $isustats['poisu'][$orglvl['poisu'][$ln + 1]] = $stats[$l];
                        // prints($isustats); exit;
                    }
                } else {
                    $isustats['poisu'][$stats[$l]['iStatusID']] = $stats[$l];
                }
            }
        }
    } else if (($stats[$l]['pocnt'] == '&times;' && !in_array($stats[$l]['vStatus_en'], $ex_ary)) && $stats[$l]['eFor'] == 'PO') {
        $isustats['poisu'][$stats[$l]['iStatusID']] = $stats[$l];
    } else {
        if ($opf[0]['eReqVerificationPo'] == 'No' && $stats[$l]['iStatusID'] == $crpo) {
            $isustats['poisu'][$isupo] = $stats[$l];
        }
        // $isustats['poisu'][$stats[$l]['iStatusID']] = $stats[$l];
    }

    /* if((!in_array($stats[$l]['iStatusID'],$orglvl['invisu']) || !in_array($stats[$l]['vStatus_en'],$ex_ary)) && $stats[$l]['eFor']=='Invoice') {
      if(!in_array($stats[$l]['vStatus_en'],$ex_ary)) {
      $isustats['invisu'][$stats[$l]['iStatusID']] = $stats[$l];
      }
      }
      else */if (in_array($stats[$l]['iStatusID'], $orglvl['invisu'])) {
        for ($ln = 0; $ln < count($orglvl['invisu']); $ln++) {
            if ($stats[$l]['iStatusID'] == $orglvl['invisu'][$ln]) {
                if (in_array($stats[$l]['vStatus_en'], $shft_ary)) {
                    if (isset($orglvl['invisu'][$ln + 1])) {
                        $isustats['invisu'][$orglvl['invisu'][$ln + 1]] = $stats[$l];
                    }
                } else {
                    $isustats['invisu'][$stats[$l]['iStatusID']] = $stats[$l];
                }
            }
        }
    } else if (($stats[$l]['incnt'] == '&times;' || !in_array($stats[$l]['vStatus_en'], $ex_ary)) && $stats[$l]['eFor'] == 'Invoice') {
        $isustats['invisu'][$stats[$l]['iStatusID']] = $stats[$l];
    } else {
        if ($opf[0]['eReqVerificationInv'] == 'No' && $stats[$l]['iStatusID'] == $crio) {
            $isustats['invisu'][$isuio] = $stats[$l];
        }
        // $isustats['poisu'][$stats[$l]['iStatusID']] = $stats[$l];
    }
}
// prints($isustats); exit;
$shft_ary = Array('Verify', 'Auth1', 'Auth2', 'Auth3');
$ex_ary = Array('Create', 'Verify');
// prints($astats); exit;
for ($l = 0; $l < count($astats); $l++) {
    if ((!in_array($astats[$l]['iStatusID'], $orglvl['poacpt']) || $astats[$l]['pocnt'] == '&times;') && $astats[$l]['eFor'] == 'PO') {
        if (!in_array($astats[$l]['vStatus_en'], $ex_ary)) {
            // prints($astats[$l]); exit;
            $acptstats['poacpt'][$astats[$l]['iStatusID']] = $astats[$l];
        } else {
            if ($opf[0]['eReqVerifyPoAcpt'] == 'No' && $astats[$l]['iStatusID'] == $crpo) {
                if ($orglvl['poacpt'][0] == $poisu) {
                    $acptstats['poacpt'][$poapt] = $astats[$l];
                } else {
                    $acptstats['poacpt'][$orglvl['poacpt'][0]] = $astats[$l];
                }
            }
        }
    } else if (in_array($astats[$l]['iStatusID'], $orglvl['poacpt'])) {
        for ($ln = 0; $ln < count($orglvl['poacpt']); $ln++) {
            if ($astats[$l]['iStatusID'] == $orglvl['poacpt'][$ln]) {
                if (in_array($astats[$l]['vStatus_en'], $shft_ary)) {
                    if (isset($orglvl['poacpt'][$ln + 1])) {
                        $acptstats['poacpt'][$orglvl['poacpt'][$ln + 1]] = $astats[$l];
                    }
                } else {
                    $acptstats['poacpt'][$astats[$l]['iStatusID']] = $astats[$l];
                }
            }
        }
    }
    /* else if(($astats[$l]['pocnt']=='&times;' || !in_array($astats[$l]['iStatusID'],$orglvl['poacpt'])) && $astats[$l]['eFor']=='PO') {
      $acptstats['poacpt'][$astats[$l]['iStatusID']] = $astats[$l];
      } */

    if ((!in_array($astats[$l]['iStatusID'], $orglvl['invacpt']) || $astats[$l]['incnt'] == '&times;') && $astats[$l]['eFor'] == 'Invoice') {
        if (!in_array($astats[$l]['vStatus_en'], $ex_ary)) {
            $acptstats['invacpt'][$astats[$l]['iStatusID']] = $astats[$l];
        } else {
            if ($opf[0]['eReqVerifyInvAcpt'] == 'No' && $astats[$l]['iStatusID'] == $crio) {
                if ($orglvl['invacpt'][0] == $invisu) {
                    $acptstats['invacpt'][$invapt] = $astats[$l];
                } else {
                    $acptstats['invacpt'][$orglvl['invacpt'][0]] = $astats[$l];
                }
            }
        }
    } else if (in_array($astats[$l]['iStatusID'], $orglvl['invacpt'])) {
        for ($ln = 0; $ln < count($orglvl['invacpt']); $ln++) {
            if ($astats[$l]['iStatusID'] == $orglvl['invacpt'][$ln]) {
                if (in_array($astats[$l]['vStatus_en'], $shft_ary)) {
                    if (isset($orglvl['invacpt'][$ln + 1])) {
                        $acptstats['invacpt'][$orglvl['invacpt'][$ln + 1]] = $astats[$l];
                    }
                } else {
                    $acptstats['invacpt'][$astats[$l]['iStatusID']] = $astats[$l];
                }
            }
        }
    } /* else if(($astats[$l]['incnt']=='&times;' || !in_array($astats[$l]['vStatus_en'],$ex_ary))&& $astats[$l]['eFor']=='Invoice') {
      $acptstats['invacpt'][$astats[$l]['iStatusID']] = $astats[$l];
      } */
}
// prints($acptstats); exit;
// -----------
$sts = $statusmasterObj->getDetails(" DISTINCT iStatusID, vStatus_en, vStatus_fr, vStatus_" . LANG . " as vStatus ", " AND eFor='PO' ");
/* $ests = $statusmasterObj->getDetails(" DISTINCT iStatusID, vStatus_en, vStatus_fr, vStatus_".LANG." as vStatus "," AND eFor='Invoice'");
  $cnt_sts = count($sts);
  $cnt_ests = count($ests);
  $sts_ary = array();
  $ests_ary = array();
  for($l=0;$l<$cnt_ests;$l++) {
  $ests_ary[$ests[$l]['iStatusID']] = $ests[$l];
  }
  for($l=0;$l<$cnt_sts;$l++) {
  $sts_ary[$sts[$l]['iStatusID']] = $sts[$l];
  } */
// prints($isustats['poisu']); exit;
if (isset($isustats['poisu'])) {
    $isustats['poisu'] = rearrange_array($isustats['poisu']);
}
if (isset($isustats['invisu'])) {
    $isustats['invisu'] = rearrange_array($isustats['invisu']);
}
if (isset($acptstats['poacpt'])) {
    $acptstats['poacpt'] = rearrange_array($acptstats['poacpt']);
}
if (isset($acptstats['invacpt'])) {
    $acptstats['invacpt'] = rearrange_array($acptstats['invacpt']);
}
// $isustats['poisu'][13] = $isustats['poisu'][12];
//unset($isustats['poisu'][12]);
// prints($acptstats['poacpt']); exit;
// pr($isustats); exit;
// pr($stats); exit;
$smarty->assign("makeArr", $makeArr);
$smarty->assign("mkarr", $mkarr);
$smarty->assign("sts", $sts);
$smarty->assign("statistics", $stats);
$smarty->assign("astatistics", $astats);
$smarty->assign("isustats", $isustats);
$smarty->assign("acptstats", $acptstats);
//$smarty->assign("sts_ary",$sts_ary);
//$smarty->assign("ests_ary",$ests_ary);
//$smarty->assign("vstatistics",$vstatistics);
//$smarty->assign("avstatistics",$avstatistics);
$tisu = $orgUserObj->getTotalPI($curORGID, "");
$tact = $orgUserObj->getTotalPI($curORGID, "acpt");
$smarty->assign("tisu", $tisu);
$smarty->assign("tact", $tact);
// prints($tisu); exit;
// -----------------------------------------------------------------------------------------------------------
// --- Last Logins -------------------------------------------------------------------------------------------
if (!isset($lghObj)) {
    require_once(SITE_CLASS_APPLICATION . "class.LoginHistory.php");
    $lghObj = new LoginHistory();
}
$lastlogins = $lghObj->getDetails("*", " AND iAdminId=$sess_id", " dLoginDate DESC ", '', " LIMIT 0,3");
$lastLoginDate = $lastlogins[0]['dLoginDate'];
$smarty->assign("lastlogins", $lastlogins);

// INBOX DETAIL -----------------------------------------------------------------------------------------------------------
//Prints($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_INBOX_VIEWED']);exit;
$curViewedInbox = (isset($_SESSION['SESS_' . PRJ_CONST_PREFIX . '_INBOX_VIEWED'])) ? $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_INBOX_VIEWED'] : '';
$curViewedInboxStr = @implode(',', $curViewedInbox);
if ($curViewedInboxStr != '') {
    $where.=' AND iVerifiedID NOT IN(' . $curViewedInboxStr . ')';
}
$where.= ' AND ((eCreatedType = \'OU\' AND iCreatedBy <> \'' . $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'] . '\') AND iOrganizationID=' . $curORGID . ') ';  // OR eCreatedType = \'OU\'
// $where .= ' AND (dActionDate > \''.$lastLoginDate.'\')';		// iCreatedBy <> '.$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'].' AND
$where.= ' AND iVerifiedID NOT IN (SELECT iInboxId FROM ' . PRJ_DB_PREFIX . '_user_deleted_inbox WHERE iUserId = \'' . $sess_id . '\' AND eUserType = \'' . $sess_usertype_short . '\') '; // AND eViewed!=\'Yes\'
$orderBy = " ORDER BY iVerifiedID DESC";
$limit = ' LIMIT 0,5';
$sql_res = 'CALL GetInbox("OU"," ' . $where . '","","' . $orderBy . '","' . $limit . '")';
// echo $sql_res;
$res = $dbobj->Onlyquery($sql_res);
$smarty->assign("res", $res);

$orgid = $curORGID;
// --- Purchase Order -----------------------------------------------------------------------------
$poisu = $statusmasterObj->getDetails('iStatusID', " AND eFor='PO' AND vStatus_en='Issued' ");
$poisu = $poisu[0]['iStatusID'];
$porjt = $statusmasterObj->getDetails('iStatusID', " AND eFor='PO' AND vStatus_en='Rejected' ");
$porjt = $porjt[0]['iStatusID'];
$invisu = $statusmasterObj->getDetails('iStatusID', " AND eFor='Invoice' AND vStatus_en='Issued' ");
$invisu = $invisu[0]['iStatusID'];
$invrjt = $statusmasterObj->getDetails('iStatusID', " AND eFor='Invoice' AND vStatus_en='Rejected' ");
$invrjt = $invrjt[0]['iStatusID'];

$groupby = " ";
$fields = " *, poh.iPurchaseOrderID, poh.dCreateDate as addDate , (select vCompanyName from " . PRJ_DB_PREFIX . "_organization_master where iOrganizationID=poh.iSupplierOrganizationID ) as supplierorg ";
if ($orgtype == 'Supplier') {
    $pcndt = " AND poh.iSupplierOrganizationID=$orgid AND poh.iStatusID>=$poisu AND poh.iStatusID!=$porjt ";
    $jtbl = " LEFT JOIN " . PRJ_DB_PREFIX . "_organization_master org on (poh.iSupplierOrganizationID=org.iOrganizationID)
				 	LEFT JOIN " . PRJ_DB_PREFIX . "_state_master st on org.vState=st.vStateCode
				 	LEFT JOIN " . PRJ_DB_PREFIX . "_country_master cnt on org.vCountry=cnt.vCountryCode
				";
} else { // if($orgtype == 'Buyer') {
    $pcndt = " AND poh.iBuyerOrganizationID=$orgid OR (poh.iSupplierOrganizationID=$orgid AND poh.iStatusID>=$poisu AND poh.iStatusID!=$porjt) ";
    $jtbl = " LEFT JOIN " . PRJ_DB_PREFIX . "_organization_master org on (poh.iBuyerOrganizationID=org.iOrganizationID)
				 LEFT JOIN " . PRJ_DB_PREFIX . "_state_master st on org.vState=st.vStateCode
				 LEFT JOIN " . PRJ_DB_PREFIX . "_country_master cnt on org.vCountry=cnt.vCountryCode
				";
}
/* else if($orgtype == 'Both') {
  $pcndt = " AND (poh.iBuyerOrganizationID=$orgid OR poh.iSupplierOrganizationID=$orgid)";
  $jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_organization_master org on (poh.iBuyerOrganizationID=org.iOrganizationID OR poh.iSupplierOrganizationID=org.iOrganizationID)
  LEFT JOIN ".PRJ_DB_PREFIX."_state_master st on org.vState=st.vStateCode
  LEFT JOIN ".PRJ_DB_PREFIX."_country_master cnt on org.vCountry=cnt.vCountryCode
  ";
  } */
$latestpo = $poheadingObj->getJoinTableInfo($jtbl, $fields, $pcndt, " poh.dOrderDate DESC ", ' poh.iPurchaseOrderID ', " LIMIT 0,2");
$tot_latestpo = "";
if (isset($latestpo['tot'])) {
    $tot_latestpo = $latestpo['tot'];
    // prints($latestpo); exit;
    unset($latestpo['tot']);
}
$smarty->assign("latestpo", $latestpo);
$smarty->assign("tot_latestpo", $tot_latestpo);
// -----------------------------------------------------------------------------------------------------------
// --- Invoice Order -----------------------------------------------------------------------------

$groupby = " ";
$fields = " *, ioh.iInvoiceID, ioh.dCreatedDate as addDate , (select vCompanyName from " . PRJ_DB_PREFIX . "_organization_master where iOrganizationID=ioh.iBuyerOrganizationID ) as buyerorg ";
if ($orgtype == 'Buyer') {
    $icndt = " AND ioh.iBuyerOrganizationID=$orgid AND ioh.iStatusID>=$invisu AND ioh.iStatusID!=$invrjt ";
    $jtbl = " LEFT JOIN " . PRJ_DB_PREFIX . "_organization_master org on (ioh.iBuyerOrganizationID=org.iOrganizationID)
				 LEFT JOIN " . PRJ_DB_PREFIX . "_state_master st on org.vState=st.vStateCode
				 LEFT JOIN " . PRJ_DB_PREFIX . "_country_master cnt on org.vCountry=cnt.vCountryCode
				";
} else { //if($orgtype == 'Supplier') {
    $icndt = " AND ioh.iSupplierOrganizationID=$orgid OR (ioh.iBuyerOrganizationID=$orgid AND ioh.iStatusID>=$invisu AND ioh.iStatusID!=$invrjt) ";
    $jtbl = " LEFT JOIN " . PRJ_DB_PREFIX . "_organization_master org on (ioh.iSupplierOrganizationID=org.iOrganizationID)
				 LEFT JOIN " . PRJ_DB_PREFIX . "_state_master st on org.vState=st.vStateCode
				 LEFT JOIN " . PRJ_DB_PREFIX . "_country_master cnt on org.vCountry=cnt.vCountryCode
				";
} /* else if($orgtype == 'Both') {
  $icndt = " AND (ioh.iSupplierOrganizationID=$orgid OR ioh.iBuyerOrganizationID=$orgid)";
  $jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_organization_master org on (ioh.iSupplierOrganizationID=org.iOrganizationID OR ioh.iBuyerOrganizationID=org.iOrganizationID)
  LEFT JOIN ".PRJ_DB_PREFIX."_state_master st on org.vState=st.vStateCode
  LEFT JOIN ".PRJ_DB_PREFIX."_country_master cnt on org.vCountry=cnt.vCountryCode
  ";
  } */

$latestio = $invordheadingObj->getJoinTableInfo($jtbl, $fields, $icndt, " ioh.dCreatedDate DESC ", ' ioh.iInvoiceID ', " LIMIT 0,2");
if (isset($latestio['tot'])) {
    $tot_latestio = $latestio['tot'];
    //prints($latestio); exit;
    unset($latestio['tot']);
}
$smarty->assign("latestio", $latestio);
$smarty->assign("tot_latestio", $latestio);

$secDetail = $orgUserObj->getDetails('tDashboard', ' AND iUserID = "' . $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'] . '" ', '', '', '');
//Prints($secDetail);exit;

$rfq2sts = $statusmasterObj->getDetails(" DISTINCT iStatusID, vStatus_en, vStatus_fr, vStatus_" . LANG . " as vStatus ", " AND vForAuction LIKE '%RFQ2%'");
// pr($rfq2sts); exit;

$r2stats = $orgUserObj->getOrgRFQ2($curORGID);
// prints($r2stats);exit;

$totalbids = $r2bdobj->getOrgBid($curORGID);
$latestrfq2 = $r2bdobj->getOrgrfq2($curORGID);
// prints($latestrfq2);exit;
$latestaward = $rfq2awardObj->getrfq2award($curORGID);
//prints($latestaward);exit;
$award = $rfq2awardObj->getaward($curORGID);
# pr($award); exit;
$saved_award = $rfq2awardObj->getsavedaward($curORGID);
$rfq2awsts = $statusmasterObj->getDetails(" DISTINCT iStatusID, vStatus_en, vStatus_fr, vStatus_" . LANG . " as vStatus ", " AND vStatus_en='Verify' AND vForAuction LIKE '%RFQ2 Award%'");  //
$rfq2awvsts = (isset($rfq2awsts[0]['iStatusID'])) ? $rfq2awsts[0]['iStatusID'] : '';  //
$orgawsts = $orgprefObj->getDetails('eRFQ2AwardVerifyReq, vRFQ2AwardStatusLevel', " AND iOrganizationID=$curORGID ");
$aworgsts = array();
$aworgsts = @ explode(',', $orgawsts[0]['vRFQ2AwardStatusLevel']);
//pr($aworgsts);exit;
//
if ($orgawsts[0]['eRFQ2AwardVerifyReq'] != 'Yes' && $rfq2awvsts != '' && in_array($rfq2awvsts, $aworgsts)) {
    for ($l = 0; $l < count($aworgsts); $l++) {
        if ($aworgsts[$l] == $rfq2awvsts) {
            unset($aworgsts[$l]);
            $aworgsts = array_values($aworgsts);
            break;
        }
    }
}  //
//pr($aworgsts); exit;
// prints($award); exit;
//prints($totalbids);exit;
$tDashboard = $secDetail[0]['tDashboard'];
$smarty->assign("award", $award);
$smarty->assign("saved_award", $saved_award);
$smarty->assign("aworgsts", $aworgsts);
$smarty->assign("latestrfq2", $latestrfq2);
$smarty->assign("resbid", $totalbids);
$smarty->assign("latestaward", $latestaward);
$smarty->assign("tDashboard", $tDashboard);
$smarty->assign("rfq2sts", $rfq2sts);
$smarty->assign("r2stats", $r2stats);
//
$rfq2stats = $r2bdobj->getRFQ2Stats($curORGID);
$cntsts = $gdbobj->mysqlEnumValues(PRJ_DB_PREFIX . "_rfq2_master", 'eAuctionStatus');
$cntsts[] = 'Awarded';
$r2sts = @multi21Array($rfq2stats, 'eAuctionStatus');
//pr($cntsts);exit;
//pr($rfq2stats); exit;
$smarty->assign("cntsts", $cntsts);
$smarty->assign("r2sts", $r2sts);
$smarty->assign("rfq2stats", $rfq2stats);
//
// calcLTzTime('2011-05-07 07:31:18','Y-m-d H:i:s');
// calcGTzTime('2011-05-07 12:11:51','Y-m-d H:i:s');
//
// ----------------------------------------------------------------------------------------------------
// $r2acptsts = $statusmasterObj->getDetails('iStatusID'," AND eForAuction!='' AND vStatus_en='Accepted' ");
//	 echo $r2acptsts[0]['iStatusID'];
// ----------------------------------------------------------------------------------------------------
?>