<?php

if (!isset($poLineObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.PurchaseOrderLine.php");
    $poLineObj = new PurchaseOrderLine();
}
if (!isset($orgObj)) {
    include_once(SITE_CLASS_APPLICATION . "organization/class.Organization.php");
    $orgObj = new Organization();
}
if (!isset($pohObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.PurchaseOrderHeading.php");
    $pohObj = new PurchaseOrderHeading();
}

$eOrderType = $_POST['eOrderType'];
$iPurchaseOrderID = $_POST['iPurchaseOrderID'];

if (is_array($_POST['vItemCode']) && is_array($_POST['itemCode'])) {
    $vItemCode = array_merge($_POST['itemCode'], $_POST['vItemCode']);
} else if (is_array($_POST['itemCode'])) {
    $vItemCode = $_POST['itemCode'];
} else if (is_array($_POST['vItemCode'])) {
    $vItemCode = $_POST['vItemCode'];
}
// echo $view; exit;
// prints($_POST);
if (is_array($eOrderType)) {

### SERVER SIDE VALIDATION ####
    if (!isset($validation)) {
        include(SITE_CLASS_GEN . "class.validation.php");
        $validation = new Validation();
    }
    $RequiredFiledArr = array(
        'eOrderType' => $smarty->get_template_vars('LBL_SELECT') . " " . $smarty->get_template_vars('LBL_ORDER_TYPE'),
        'vUnitOfMeasure' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_UNIT_MEASURE'),
        // 'iQuantity' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_QUANTITY'),
        'fPrice' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_PRICE'),
        'fAmount' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_AMOUNT'),
        'fVAT' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_VAT'),
        'fWithHoldingTax' => $smarty->get_template_vars('LBL_ENTER') . " " . $smarty->get_template_vars('LBL_WITH_HOLDING_TAX')
    );
    $resArr = $validation->isEmptyMul($RequiredFiledArr);
    $nvldmsg = array(
        // 'iQuantity' => $smarty->get_template_vars('LBL_QUANTITY') . " " . $smarty->get_template_vars('LBL_MUST_BE_NUMERIC'),
        'fPrice' => $smarty->get_template_vars('LBL_PRICE') . " " . $smarty->get_template_vars('LBL_MUST_BE_NUMERIC'),
        'fAmount' => $smarty->get_template_vars('LBL_PRICE') . " " . $smarty->get_template_vars('LBL_MUST_BE_NUMERIC'),
        'fVAT' => $smarty->get_template_vars('LBL_VAT') . " " . $smarty->get_template_vars('LBL_MUST_BE_NUMERIC'),
        'fWithHoldingTax' => $smarty->get_template_vars('LBL_WITH_HOLDING_TAX') . " " . $smarty->get_template_vars('LBL_MUST_BE_NUMERIC')
    );
    if (count($nvldmsg) > 0) {
        $nvld_ary = $validation->isNumMul($nvldmsg, 'empty');
    }
// prints($nvld_ary); exit;
// prints($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']); exit;
// $resArr = $validation->isEmpty($RequiredFiledArr);
    if ($resArr || $nvld_ary == 'er') {
        header("Location:" . $_SERVER['HTTP_REFERER'] . "");
        exit;
    }
### ENDS HERE ###
    $podt = $pohObj->select($iPurchaseOrderID);
    $cnitm = $poLineObj->getDetails("*", " AND iPurchaseOrderID=$iPurchaseOrderID ");
    $subt = 0;
    $dist = 0;
    $chgt = 0;
    $tvat = 0;
    $otax = 0;
    $ltl = 0;
    $ilineItemCode = array();
    $ilineItemCode = $vItemCode;
    for ($i = 0; $i < count($eOrderType); $i++) {
        $Data = array();
        $Data['eOrderType'] = $_POST['eOrderType'][$i];
        $Data['vItemCode'] = $vItemCode[$i];
        $Data['tDescription'] = $_POST['tDescription'][$i];
        $Data['vPartNo'] = $_POST['vPartNo'][$i];
        $Data['vUnitOfMeasure'] = $_POST['vUnitOfMeasure'][$i];
        $Data['iQuantity'] = $_POST['iQuantity'][$i];
        $Data['fPrice'] = str_replace(",", "", $_POST['fPrice'][$i]);
        $Data['fAmount'] = str_replace(",", "", $_POST['fAmount'][$i]);
        $Data['fVAT'] = str_replace(",", "", $_POST['fVAT'][$i]);
        $Data['fOtherTax1'] = str_replace(",", "", $_POST['fOtherTax1'][$i]);
        $Data['fLineTotal'] = str_replace(",", "", $_POST['fLineTotal'][$i]);
        $Data['iPurchaseOrderID'] = $_POST['iPurchaseOrderID'];
        $Data['iInvoiceID'] = $_POST['iInvoiceID'][$i];
        $Data['iRelatedInvoiceLineID'] = $_POST['iRelatedInvoiceLineID'][$i];
        $view = $_POST['view'];

        if ($Data['eOrderType'] == 'Discount') {
            if (is_numeric($Data['fLineTotal'])) {
                $dist += $Data['fLineTotal'];
                $ltl = $ltl - $Data['fLineTotal'];
            }
            $Data['eSublineType'] = '';
            $Data['iSubQuantity'] = 0;
            $Data['fSubRate'] = 0;
            $Data['fSubAmount'] = 0;
        } else if ($Data['eOrderType'] == 'Charge') {
            if (is_numeric($Data['fLineTotal'])) {
                $chgt += $Data['fLineTotal'];
                $ltl = $ltl + $Data['fLineTotal'];
            }
            $Data['eSublineType'] = '';
            $Data['iSubQuantity'] = 0;
            $Data['fSubRate'] = 0;
            $Data['fSubAmount'] = 0;
            // if(is_numeric($Data['fVAT'])) { $tvat += $Data['fVAT']; }
            // if(is_numeric($Data['fOtherTax1'])) { $otax += $Data['fOtherTax1']; }
            // if(is_numeric($Data['fWithHoldingTax'])) { $whtax += $Data['fWithHoldingTax']; }
            // if(is_numeric($Data['fLineTotal'])) { $ltl += $Data['fLineTotal']; }
        } else {
            if (is_numeric($Data['fAmount'])) {
                $subt += $Data['fAmount'];
            }
            if (is_numeric($Data['fVAT'])) {
                $tvat += $Data['fVAT'];
            }
            if (is_numeric($Data['fOtherTax1'])) {
                $otax += $Data['fOtherTax1'];
            }
            // if(is_numeric($Data['fWithHoldingTax'])) { $whtax += $Data['fWithHoldingTax']; }
            if (is_numeric($Data['fLineTotal'])) {
                $ltl += $Data['fLineTotal'];
            }
            if (isset($_POST['eSublineType'][$i]) && trim($_POST['eSublineType'][$i]) != '') {
                $Data['eSublineType'] = trim($_POST['eSublineType'][$i]);
                if (trim($_POST['eSublineType'][$i]) == 'Discount') {
                    $Data['iSubQuantity'] = intval($_POST['iSubQuantity'][$i]);
                    $Data['fSubRate'] = floatval($_POST['fSubRate'][$i]);
                    $Data['fSubAmount'] = floatval($_POST['fSubAmount'][$i]);
                    $subt = $subt + intval($_POST['fSubAmount'][$i]);
                    // $ltl = $ltl + intval($_POST['fSubAmount'][$i]);
                } else if (trim($_POST['eSublineType'][$i]) == 'Charge') {
                    $Data['iSubQuantity'] = intval($_POST['iSubQuantity'][$i]);
                    $Data['fSubRate'] = floatval($_POST['fSubRate'][$i]);
                    $Data['fSubAmount'] = floatval($_POST['fSubAmount'][$i]);
                    $subt = $subt + intval($_POST['fSubAmount'][$i]);
                    // $ltl = $ltl + intval($_POST['fSubAmount'][$i]);
                } else {
                    $Data['iSubQuantity'] = 0;
                    $Data['fSubRate'] = 0;
                    $Data['fSubAmount'] = 0;
                }
            } else {
                $Data['iSubQuantity'] = 0;
                $Data['fSubRate'] = 0;
                $Data['fSubAmount'] = 0;
            }
        }

        if ($Data['fLineTotal'] <= 0) {  // $Data['fAmount']<=0 ||
            continue;
        }
        // echo $view;
        // prints($Data); // exit;
        if ($view == '' || $view == 'add') {
            $ilineItemCode[] = $vItmCode = $poLineObj->getUniqueCode();
            $Data['vItemCode'] = $vItmCode;
            $vPOItemLineNumber = $generalobj->UniqueID("", PRJ_DB_PREFIX . "_purchase_order_line", "iLineNumber", $charlimit = "10");
            $Data['iLineNumber'] = $vPOItemLineNumber;
            $Data['dETA'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
            $poLineObj->setAllVar($Data);
            $id = $poLineObj->insert();
            if ($id) {
                $msg = "ras";
            } else {
                $msg = "raserr";
            }
        } else if ($view == 'edit') {
            $podtls = $poLineObj->getDetails('*', " AND vItemCode='" . $Data['vItemCode'] . "'");
            if (count($podtls) > 0 && is_array($podtls)) {
                $ilineItemCode[] = $Data['vItemCode'];
                $where = " vItemCode='" . $Data['vItemCode'] . "'";
                unset($Data['vItemCode']);
                $id = $poLineObj->updateData($Data, $where);
                // for adding/updating tax
            } else {
                $vItmCode = $poLineObj->getUniqueCode();
                $Data['vItemCode'] = $vItmCode;
                $ilineItemCode[] = $Data['vItemCode'];
                $vPOItemLineNumber = $generalobj->UniqueID("", PRJ_DB_PREFIX . "_purchase_order_line", "iLineNumber", $charlimit = "10");
                $Data['iLineNumber'] = $vPOItemLineNumber;
                $Data['dETA'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
                $poLineObj->setAllVar($Data);
                $id = $poLineObj->insert();
                // for adding/updating tax
            }
            if ($id) {
                $msg = "rus";
            } else {
                $msg = "ruserr";
            }
        }
    }
//echo "$subt<br/>$dist<br/>$chgt<br/>$ltl";
//exit;

    $eSaved = $_POST['eSaved'];
    if ($eSaved != 'Yes') {
        $dtl['eSaved'] = $eSaved;
        $wh_cn = "iPurchaseOrderID=$iPurchaseOrderID";
        $rs = $pohObj->updateData($dtl, $wh_cn);
    }

    // prints($ilineItemCode); exit;
    $lineitmCode = "0";
    if (is_array($ilineItemCode) && count($ilineItemCode) > 0) {
        $lineitmCode = @implode("','", $ilineItemCode);
    }
    $d = $poLineObj->del(" AND vItemCode NOT IN ('$lineitmCode') AND iPurchaseOrderID=$iPurchaseOrderID ");

    $pdt = array();
    if ($podt[0]['eLineItemTax'] == 'Yes' || (!($podt[0]['fVat'] > 0) && $tvat > 0)) {
        $pdt['fVat'] = $tvat;
        // $pdt['fOther_tax_1'] = $otax;
    }
    if ($podt[0]['eLineItemTax'] == 'Yes' || (!($podt[0]['fOther_tax_1'] > 0) && $otax > 0)) {
        // $pdt['fVat'] = $tvat;
        $pdt['fOther_tax_1'] = $otax;
    }
    $pdt['fSubTotal'] = $subt;
    $pdt['fDiscount'] = $dist;
    $pdt['fCharge'] = $chgt;
    $u = $pohObj->updateData($pdt, " iPurchaseOrderID=$iPurchaseOrderID ");
    // check for total
    /* if($podt[0]['fPOTotal']>0) {
      if(trim($ltl)!=trim($podt[0]['fPOTotal'])) {
      $msg = "tmm";
      header("Location:".SITE_URL_DUM."purchaseordercreate/$iPurchaseOrderID/$msg");
      exit;
      }
      } else { */
    if ($ltl > 0) {
        $pdt['fPOTotal'] = trim($ltl);
    } else {
        $pdt['fPOTotal'] = 0;
    }
    $u = $pohObj->updateData($pdt, " iPurchaseOrderID=$iPurchaseOrderID ");
    // }
} else {
    // prints($ilineItemCode); exit;
    $lineitmCode = "0";
    if (is_array($ilineItemCode) && count($ilineItemCode) > 0) {
        $lineitmCode = @implode("','", $ilineItemCode);
    }
    $d = $poLineObj->del(" AND vItemCode NOT IN ('$lineitmCode') AND iPurchaseOrderID=$iPurchaseOrderID ");

    $eSaved = $_POST['eSaved'];
    if ($eSaved == 'Yes') {
        $dtl['eSaved'] = $eSaved;
        $wh_cn = "iPurchaseOrderID=$iPurchaseOrderID";
        $rs = $pohObj->updateData($dtl, $wh_cn);
    }
}

if (isset($_SESSION['poadd'])) {
    unset($_SESSION['poadd']);
}
if ($msg != 'raserr' && $msg != 'ruserr') {
    if (is_array($cnitm) && count($cnitm) > 0) {
        $msg = 'rus';
    } else {
        $msg = 'ras';
    }
}
$_SESSION['SESS_' . PRJ_CONST_PREFIX . '_MSG'] = $msg;
$isusts = $statusmasterObj->getDetails('*', " AND eFor='PO' AND vStatus_en='Issued' ");
$isusts = $isusts[0]['iStatusID'];
if ($podtl[0]['iStatusID'] >= $isusts && $curORGID == $podtl[0]['iSupplierOrganizationID']) {
    header("Location:" . SITE_URL_DUM . "poacptlist/$msg");
} else {
    header("Location:" . SITE_URL_DUM . "polist/$msg");
}
exit;
?>