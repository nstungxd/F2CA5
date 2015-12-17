<?php
if (!isset($invOrdObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.InvoiceOrderHeading.php");
    $invOrdObj = new InvoiceOrderHeading();
}
if (!isset($purOrdObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.PurchaseOrderHeading.php");
    $purOrdObj = new PurchaseOrderHeading();
}
if (!isset($bnkObj)) {
    include_once(SITE_CLASS_APPLICATION . "class.BankMaster.php");
    $bnkObj = new BankMaster();
}
if (!isset($rfq2Obj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.RFQ2Masterphp");
    $rfq2Obj = new RFQ2Master();
}
if (!isset($rfq2awObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.Rfq2Award.php");
    $rfq2awObj = new Rfq2Award();
}
if (!isset($rfq2bidObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.Rfq2Bids.php");
    $rfq2bidObj = new Rfq2Bids();
}
$iInvoiceID = PostVar('invoiceid');
$iPurchaseOrderID = PostVar('poid');
// $orgdtls = $orgObj->select($curORGID);
$dtls = array();
if (trim($iInvoiceID) != '' && $iInvoiceID > 0) {
    $dtls = $invOrdObj->select($iInvoiceID);
    $bdtls = $bnkObj->select($dtls[0]['iBankId']);
    if ($dtls[0]['iPurchaseOrderID'] != "" && $dtls[0]['iPurchaseOrderID'] != "0") {
        $rfq2_dets = $rfq2Obj->getDetails('*', " AND iPurchaseOrderID = '" . $dtls[0]['iPurchaseOrderID'] . "' ");
        if (count($rfq2_dets) > 0) {
            $awrdtls = $rfq2awObj->getDetails('*', " AND iRFQ2Id='" . $rfq2_dets[0]['iRFQ2Id'] . "' ");
            $bid_dtls = $rfq2bidObj->getDetails('*', " AND iBidId='" . $awrdtls[0]['iBidId'] . "' ");
            $dtls[0]['fPOAwardAdvace'] = $bid_dtls[0]['fBidAdvanceTotal'];
            $dtls[0]['fPOAwardPrice'] = $bid_dtls[0]['fBidPriceTotal'];
            $dtls[0]['fPOAwardAmount'] = $bid_dtls[0]['fBidAmount'];
        }
    }
}
if (trim($iPurchaseOrderID) != '' && $iPurchaseOrderID > 0) {
    $dtls = $purOrdObj->select($iPurchaseOrderID);
}
?>
<?php if (trim($iInvoiceID) != '' && $iInvoiceID > 0) { ?>
    <input type="hidden" name="dNetPaymentdate" id="dNetPaymentdate" value="<?php echo $dtls[0]['dNetPaymentdate']; ?>" />
        <label class="col-md-2 control-label"><?php echo $smarty->get_template_vars('LBL_INV_CODE'); ?></label>
        <div class="col-md-4">
            <a target="_blank" style="text-decoration:none; cursor:pointer;" onclick="openpopup('<?php echo $SITE_URL_DUM . "invoiceview/" . $dtls[0]['iInvoiceID'] . "/pop"; ?>');"><b><?php echo $dtls[0]['vInvoiceCode']; ?></b></a>
        </div>
        <label class="col-md-2 control-label"><?php echo $smarty->get_template_vars('LBL_BUYER'); ?></label>
        <div class="col-md-4">
            <?php echo $dtls[0]['vBuyerName']; ?>
        </div>
        <label class="col-md-2 control-label"><?php echo $smarty->get_template_vars('LBL_SUPPLIER'); ?></label>
        <div class="col-md-4">
            <?php echo $dtls[0]['vSupplierName']; ?>
        </div>
        <label class="col-md-2 control-label"> <?php echo $smarty->get_template_vars('LBL_BANK'); ?></label>
        <div class="col-md-4">
            <?php echo $bdtls[0]['vBankName']; ?>
        </div>
        <label class="col-md-2 control-label"><?php echo $smarty->get_template_vars('LBL_BANK_CODE'); ?></label>
        <div class="col-md-4">
            <?php echo $dtls[0]['vBankCode']; ?>
        </div>
        <label class="col-md-2 control-label"> <?php echo $smarty->get_template_vars('LBL_ACCOUNT'); ?></label>
        <div class="col-md-4">
            <?php echo $dtls[0]['vAccountName']; ?>
        </div>
        <label class="col-md-2 control-label"><?php echo $smarty->get_template_vars('LBL_ACCOUNT') . ' ' . $smarty->get_template_vars('LBL_NUMBER'); ?></label>
        <div class="col-md-4">
            <?php echo $dtls[0]['vAccountNumber']; ?>
        </div>
        <label class="col-md-2 control-label"><?php echo $smarty->get_template_vars('LBL_INVOICE_PAYABLE_DATE'); ?></label>
        <div class="col-md-4">
            <?php echo ($dtls[0]['dNetPaymentdate'] != '0000-00-00') ? DateTime(calcLTzTime($dtls[0]['NetPaymentdate']), 10) : '---'; ?>
        </div>
        <label class="col-md-2 control-label"><?php echo $smarty->get_template_vars('LBL_ACCEPTED') . ' ' . $smarty->get_template_vars('LBL_DATE'); ?></label>
        <div class="col-md-4">
            <?php echo ($dtls[0]['dAcceptedDate'] != '0000-00-00') ? DateTime(calcLTzTime($dtls[0]['dAcceptedNetPaymentDate']), 10) : '---'; ?>
        </div>
        <label class="col-md-2 control-label"><?php echo $smarty->get_template_vars('LBL_INVOICE_PAYABLE') . ' (' . $smarty->get_template_vars('LBL_ACCEPTED') . ') ' . $smarty->get_template_vars('LBL_AMOUNT'); ?></label>
        <div class="col-md-4">
            <?php echo $dtls[0]['fAcceptedAmount']; ?>
        </div>
        <label class="col-md-2 control-label"> <?php echo $smarty->get_template_vars('LBL_INVOICE_TOTAL'); ?></label>
        <div class="col-md-4">
            <?php echo $dtls[0]['fInvoiceTotal']; ?>
        </div>
        <?php if (count($bid_dtls) > 0) { ?>
        <label class="col-md-2 control-label"> <?php echo $smarty->get_template_vars('LBL_BID_ADVANCE'); ?></label>
        <div class="col-md-4">
            <?php echo $dtls[0]['fPOAwardAdvace']; ?>
            <input type="hidden" name="Data[fPOAwardAdvace]" id="fPOAwardAdvace" value="" />
        </div>
        <label class="col-md-2 control-label"> <?php echo $smarty->get_template_vars('LBL_BID_PRICE'); ?></label>
        <div class="col-md-4">
            <?php echo $dtls[0]['fPOAwardPrice']; ?>
            <input type="hidden" name="Data[fPOAwardPrice]" id="fPOAwardPrice" value="" />
        </div>
        <label class="col-md-2 control-label"> <?php echo $smarty->get_template_vars('LBL_BID_TOTAL'); ?></label>
        <div class="col-md-4">
            <?php echo $dtls[0]['fPOAwardAmount']; ?>
            <input type="hidden" name="Data[fPOAwardAmount]" id="fPOAwardAmount" value="" />
        </div>

        <?php } ?>



        <label class="col-md-2 control-label"> {$LBL_FILTER_LIST_BY}</label>
        <div class="col-md-4">
            <input type="text" name="b2filter" id="b2filter" class="form-control">
        </div>
<?php } else if (trim($iPurchaseOrderID) != '' && $iPurchaseOrderID > 0) { ?>
        <label class="col-md-2 control-label"> <?php echo $smarty->get_template_vars('LBL_PO_CODE'); ?></label>
        <div class="col-md-4">
            <a target="_blank" style="text-decoration:none; cursor:pointer;" onclick="openpopup('<?php echo $SITE_URL_DUM . "purchaseorderview/" . $dtls[0]['iPurchaseOrderID'] . "/pop"; ?>');"><b><?php echo $dtls[0]['vPOCode']; ?></b></a>
        </div>
        <label class="col-md-2 control-label"> <?php echo $smarty->get_template_vars('LBL_BUYER'); ?></label>
        <div class="col-md-4">
            <?php echo $dtls[0]['vBuyerCompanyName']; ?>
        </div>
        <label class="col-md-2 control-label"> <?php echo $smarty->get_template_vars('LBL_SUPPLIER'); ?></label>
        <div class="col-md-4">
            <?php echo $dtls[0]['vSupplierName']; ?>
        </div>
        <label class="col-md-2 control-label"> <?php echo $smarty->get_template_vars('LBL_PO_TOTAL'); ?></label>
        <div class="col-md-4">
            <?php echo $dtls[0]['fPOTotal']; ?>
        </div>
<?php } exit; ?>