<?php

$UserName = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_USER_NAME'];
include(S_SECTIONS . "/member/memberaccess.php");
$var_msg = $_GET['msg'];
if (isset($_SESSION['SESS_' . PRJ_CONST_PREFIX . '_MSG'])) {
    $msg = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_MSG'];
    unset($_SESSION['SESS_' . PRJ_CONST_PREFIX . '_MSG']);
}
if ($msg == 'ras') {
    $msg = $smarty->get_template_vars('MSG_ADD_SUCC');
} elseif ($msg == 'raserr') {
    $msg = $smarty->get_template_vars('MSG_ADD_ERR');
} elseif ($msg == 'rus') {
    $msg = $smarty->get_template_vars('MSG_UPDATE_SUCC');
} elseif ($msg == 'ruserr') {
    $msg = $smarty->get_template_vars('MSG_UPDATE_ERR');
} else {
    $msg = '';
}

$iPurchaseOrderID = $_GET['id'];
if (!isset($poLineObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.PurchaseOrderLine.php");
    $poLineObj = new PurchaseOrderLine();
}
if (!isset($pohObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.PurchaseOrderHeading.php");
    $pohObj = new PurchaseOrderHeading();
}

if (trim($iPurchaseOrderID) != '' && is_numeric($iPurchaseOrderID)) {
    $view = 'edit';
    $where = " AND iPurchaseOrderID=$iPurchaseOrderID";
    $poData = $poLineObj->getDetails('*', $where);
    //prints($poData);exit;
    $podtls = $pohObj->select($iPurchaseOrderID);
    $isdtls = $statusmasterObj->getDetails('*', " AND eFor='PO' AND vStatus_en='Issued' ");
    $isdtls = $isdtls[0]['iStatusID'];
    if ($uorg_type == 'Buyer2') {
        $b2us = $pohObj->getPurchaseOrderRfq2Buyer2OrgIds($iPurchaseOrderID);
        if (!in_array($curORGID, $b2us)) {
            header("Location: " . SITE_URL_DUM . "invoicelist");
            exit;
        }
    } else if ($podtls[0]['iBuyerOrganizationID'] != $curORGID && $podtls[0]['iSupplierOrganizationID'] != $curORGID) {
        header("Location: " . SITE_URL_DUM . "polist/all");
        exit;
    } else if ($podtls[0]['iSupplierOrganizationID'] == $curORGID && $podtls[0]['iStatusID'] < $isdtls) {
        header("Location: " . SITE_URL_DUM . "polist/all");
        exit;
    }
}

$smarty->assign('iPurchaseOrderID', $iPurchaseOrderID);
$smarty->assign('poData', $poData);
$smarty->assign('podtls', $podtls);
$smarty->assign('view', $view);
$smarty->assign('var_msg', $var_msg);
?>