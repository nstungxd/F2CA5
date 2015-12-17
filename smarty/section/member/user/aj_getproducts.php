<?php
$productname = PostVar('prdt_nm');
$productcode = PostVar('prdt_cd');
$iInvoiceID = PostVar('iInvoiceID');
$eType = PostVar('eType');
$iPurchaseOrderID = PostVar('iPurchaseOrderID');
$availability = PostVar('availability');
$orgas = PostVar('orgas');
$elid = PostVar('elid');
$elnm = PostVar('elnm');
$ocf = stripcslashes(PostVar('ocf'));
$ext = stripcslashes(PostVar('ext'));
$dflt = stripcslashes(PostVar('dflt'));
$productname = (trim($productname) == 'Product Name') ? '' : $productname;
$productcode = (trim($productcode) == 'Product Code') ? '' : $productcode;
// pr($_POST); exit;
if (!isset($invOrdObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.InvoiceOrderHeading.php");
    $invOrdObj = new InvoiceOrderHeading();
}
if (!isset($purOrdObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.PurchaseOrderHeading.php");
    $purOrdObj = new PurchaseOrderHeading();
}

$orgas = "";
if($eType == "Invoice"){
    $invdtls = $invOrdObj->getDetails('iBuyerOrganizationID,iSupplierOrganizationID', " AND iInvoiceID=$iInvoiceID ");
}else if($eType == "PO"){
    $invdtls = $purOrdObj->getDetails('iBuyerOrganizationID,iSupplierOrganizationID', " AND iPurchaseOrderID=$iPurchaseOrderID ");
}
if ($invdtls[0]['iBuyerOrganizationID'] == $curORGID) {
    $orgas = "Buyer";
} else if ($invdtls[0]['iSupplierOrganizationID'] == $curORGID) {
    $orgas = "Supplier";
}
$orgas = (trim($orgas) != '') ? $orgas : $uorg_type;
// echo $orgas; exit;
$whr = "";
if (trim($productname) != '') {
    $whr .= " AND vProductName LIKE '$productname%' ";
} else if (trim($productcode) != '') {
    $whr .= " AND vProductCode LIKE '$productcode%' ";
}
$dtls = array();

if (($curORGID > 0 && $orgas != '') && ($iInvoiceID > 0 || $iPurchaseOrderID > 0 )) {
    if ($orgas == 'Buyer') {
        if (!isset($bProductOrgObj)) {
            include_once(SITE_CLASS_APPLICATION . 'productorganization/class.BProductOrganization.php');
            $bProductOrgObj = new BProductOrganization();
        }
        $dtls = $bProductOrgObj->getDetails("iProductId, vProductName, vProductCode, 'bproduct' as eProductType", " AND eAvailability='$availability' $whr");        
    } else if ($orgas == 'Supplier') {
        if (!isset($sProductOrgObj)) {
            include_once(SITE_CLASS_APPLICATION . 'productorganization/class.SProductOrganization.php');
            $sProductOrgObj = new SProductOrganization();
        }
        $dtls = $sProductOrgObj->getDetails("iProductId, vProductName, vProductCode, 'sproduct' as eProductType", " AND eAvailability='$availability' $whr");
    } else if ($orgas == 'Both') {
        $sql = "(Select iProductId, vProductName, vProductCode, 'b' as eProductType from " . PRJ_DB_PREFIX . "_bproduct_organization where eAvailability='$availability $whr')
					UNION
					(Select iProductId, vProductName, vProductCode, 's' as eProductType from " . PRJ_DB_PREFIX . "_sproduct_organization where eAvailability='$availability $whr')
					ORDER BY vProductName ASC";
        $dtls = $dbobj->MySQLSelect($sql);
    }
}
?>
<select id="<?php echo $elid; ?>" class="save required" name="<?php echo $elnm; ?>" <?php echo $ext; ?> onchange="<?php echo $ocf; ?>">
    <?php echo $dflt; ?>
    <?php
    if (is_array($dtls) && count($dtls) > 0) {
        $len = count($dtls);
        for ($l = 0; $l < $len; $l++) {
            ?>
            <option value="<?php echo substr(strtolower($dtls[$l]['eProductType']), 0, 1) . '-' . $dtls[$l]['iProductId']; ?>"><?php echo $dtls[$l]['vProductName'] . ' (' . $dtls[$l]['vProductCode'] . ')'; ?></option>
            <?php
        }
    }
    ?>
</select>
    <?php exit; ?>