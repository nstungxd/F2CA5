<?php

if (!isset($rfq2Obj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.RFQ2Master.php");
    $rfq2Obj = new RFQ2Master();
}
if (!isset($rfq2flObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.Rfq2Files.php");
    $rfq2flObj = new Rfq2Files();
}
if (!isset($rpb2Obj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.Rfq2ProductBuyer2.php");
    $rpb2Obj = new Rfq2ProductBuyer2();
}
if (!isset($orgObj)) {
    include_once(SITE_CLASS_APPLICATION . 'user/class.Organization.php');
    $orgObj = new Organization();
}
if (!isset($orgUsrObj)) {
    require_once(SITE_CLASS_APPLICATION . "user/class.OrganizationUser.php");
    $orgUsrObj = new OrganizationUser();
}
if (!isset($fluplObj)) {
    include_once(SITE_CLASS_GEN . "class.imagecrop.php");
    $fluplObj = new imagecrop();
}
if (!isset($statusmasterObj)) {
    include_once(SITE_CLASS_APPLICATION . "class.StatusMaster.php");
    $statusmasterObj = new StatusMaster();
}
if (!isset($userActionObj)) {
    include_once(SITE_CLASS_APPLICATION . 'user/class.UserActionVerification.php');
    $userActionObj = new UserActionVerification();
}
if (!isset($emailObj)) {
    include_once(SITE_CLASS_APPLICATION . 'class.EmailTemplate.php');
    $emailObj = new EmailTemplate();
}
if (!isset($sendMail)) {
    include(SITE_CLASS_GEN . "class.sendmail.php");
    $sendMail = new SendPHPMail();
}

$view = PostVar('view');
$Data = PostVar('Data');
$Data['iProductId'] = (isset($Data['iProductId'])) ? $Data['iProductId'] : 0;
$iInvoiceID = (isset($Data['iInvoiceID'])) ? $Data['iInvoiceID'] : 0;
$iPurchaseOrderID = (isset($Data['iPurchaseOrderID'])) ? $Data['iPurchaseOrderID'] : 0;
$iProductId = preg_replace('/\w-/', '', $Data['iProductId']);
$opatype = preg_replace('/-\d/', '', $Data['iProductId']);
$opatype = (strtolower($opatype) == 'b') ? 'BProduct' : (strtolower($opatype) == 's') ? 'SProduct' : '';
$eFrom = PostVar('eFor');
$Data['eFrom'] = $eFrom;
if($eFrom == 'PO') {
    $Data['iInvoiceID'] = 0;
    $Data['eInstantStart'] = 'Yes';
    $Data['eRelativeEndTime'] = 'Yes';
    // $Data['iEndAfterHrs'] = '00';
    // $Data['iEndAfterMin'] = '00';
} else if($eFrom == 'Invoice') {
    $Data['iPurchaseOrderID'] = 0;
}
$vrfy_eml = 'n';
//echo $iPurchaseOrderID; exit;
if ($iInvoiceID > 0 || $iPurchaseOrderID > 0) {
    /* if(!isset($rfq2Obj)) {
      include_once(SITE_CLASS_APPLICATION."user/class.RFQ2Master.php");
      $rfq2Obj = new RFQ2Master();
      } */
    $orgas = "";
    if ($eFrom == 'Invoice') {
        if (!isset($invOrdObj)) {
            include_once(SITE_CLASS_APPLICATION . "user/class.InvoiceOrderHeading.php");
            $invOrdObj = new InvoiceOrderHeading();
        }
        $invdtls = $invOrdObj->getDetails('iBuyerOrganizationID,iSupplierOrganizationID', " AND iInvoiceID=$iInvoiceID ");
        if ($invdtls[0]['iBuyerOrganizationID'] == $curORGID) {
            $orgas = "Buyer";
        } else if ($invdtls[0]['iSupplierOrganizationID'] == $curORGID) {
            $orgas = "Supplier";
        }
    } else if ($eFrom == 'PO') {
        if (!isset($poOrdObj)) {
            include_once(SITE_CLASS_APPLICATION . "user/class.PurchaseOrderHeading.php");
            $poOrdObj = new PurchaseOrderHeading();
        }
        $podtls = $poOrdObj->getDetails('iBuyerOrganizationID,iSupplierOrganizationID', " AND iPurchaseOrderID=$iPurchaseOrderID ");
        if ($podtls[0]['iBuyerOrganizationID'] == $curORGID) {
            $orgas = "Buyer";
        } else if ($podtls[0]['iSupplierOrganizationID'] == $curORGID) {
            $orgas = "Supplier";
        }
    }
    $orgas = (trim($orgas) != '') ? $orgas : $uorg_type;
    if ($view == '' || $view == 'add') {
        // pr($_POST); pr($_FILES); exit;

        $adata['iProductId'] = $iProductId;
        $abdata = $Data['iBuyer2Id'];

        unset($Data['iProductId']);
        unset($Data['Buyer2Id']);
        unset($Data['iBuyer2Id']);
        $Data['vRFQ2No'] = $rfq2Obj->getUniqueCode('RFQ2');
        // $Data['fTotal'] = (float) ( ((float)$Data['fAdvanceTotal'] + (float)$Data['fPriceTotal']) / 2 );
        $Data = $rfq2Obj->iacalcRfq2Amount($Data);
        $Data['iUserID'] = $sess_id;
        $Data['iModifiedById'] = $sess_id;
        $Data['iOrganizationID'] = $curORGID;
        $Data['eCreatedBy'] = $orgas;
        $Data['eDelete'] = 'No';
        $Data['dADate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
        $Data['vFromIP'] = $_SERVER['REMOTE_ADDR'];
        
        $Data['vRFQ2Code'] = uniqid('r2');

        $orgprf = $orgprefObj->getDetails('*', " AND iOrganizationID=" . $curORGID);
        // $orgprf = $orgprefObj->select($dtls[0]['iOrganizationID']);
        $gmtoffset = $_POST['gmtoffset'];
        // $gmtoffset = mintouts($gmtoffset);
        $Data['eAuctionStatus'] = "Not Started";
        $Data['dStartDate'] = calcGTzTimeFmo($Data['dStartDate'], 'Y-m-d H:i:s', $gmtoffset);
        $Data['dEndDate'] = calcGTzTimeFmo($Data['dEndDate'], 'Y-m-d H:i:s', $gmtoffset);
        if ($orgprf[0]['eRFQ2VerifyReq'] == 'Yes' || $Data['eSaved'] == 'Yes') {
            $sts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE 'RFQ2,%' AND vStatus_en='Create' ");
            $Data['iStatusID'] = $sts[0]['iStatusID'];
        } else {
            $sts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE 'RFQ2,%' AND vStatus_en='Verify' ");
            $Data['iStatusID'] = $sts[0]['iStatusID'];
            //
            if ($Data['eInstantStart'] == 'Yes') {
                $Data['dStartDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
                $Data['eRelativeEndTime'] = 'Yes';
            }
            if ($Data['eRelativeEndTime'] == 'Yes') {
                $Data['iEndAfterHrs'] = ($Data['iEndAfterHrs'] != '' && $Data['iEndAfterHrs'] != '00') ? intval($Data['iEndAfterHrs']) : 0;
                $Data['iEndAfterMin'] = ($Data['iEndAfterMin'] != '' && $Data['iEndAfterMin'] != '00') ? intval($Data['iEndAfterMin']) : 0;
                $Data['dEndDate'] = date("Y-m-d H:i:s", strtotime($Data['dStartDate'] . "+" . $Data['iEndAfterHrs'] . " hour +" . $Data['iEndAfterMin'] . " minutes"));
            }
            //
            if (strtotime($Data['dStartDate']) - strtotime(calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s')) > 0 || $Data['eSaved'] == 'Yes') {  //
                $Data['eAuctionStatus'] = "Not Started";
            } else if (strtotime($Data['dEndDate']) - strtotime(calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s')) > 0) {
                $Data['eAuctionStatus'] = "Live";
            } else if ($Data['dStartDate'] == $Data['dEndDate']) {
                $Data['eAuctionStatus'] = "Completed";
            } else {
                $Data['eAuctionStatus'] = "Cancelled";
            }
			// pr($Data); exit;
        }

//        if ($Data['eInstantStart'] == 'Yes') {
//            $Data['dStartDate'] = calcGTzTimeFmo(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
//            $Data['eRelativeEndTime'] = 'Yes';
//        }
//        if ($Data['eRelativeEndTime'] == 'Yes') {
//            $Data['iEndAfterHrs'] = ($Data['iEndAfterHrs'] == '' && $Data['iEndAfterHrs'] != '00') ? intval($Data['iEndAfterHrs']) : '0';
//            $Data['iEndAfterMin'] = ($Data['iEndAfterMin'] == '' && $Data['iEndAfterMin'] != '00') ? intval($Data['iEndAfterMin']) : '0';
//            $Data['dEndDate'] = date("Y-m-d H:i:s", strtotime(date('Y-m-d H:i:s') . "+" . $Date['iEndAfterHrs'] . " hour +" . $Date['iEndAfterMin'] . " minutes"));
//        }
        //
        if ($eFrom == 'Invoice') {
            $dup_dtls = $rfq2Obj->getDetails('iRFQ2Id', " AND iInvoiceID=$iInvoiceID AND eDelete!='Verified' AND eAuctionStatus!='Cancelled' ");
            if (is_array($dup_dtls) && count($dup_dtls) > 0) {
                header("Location: " . SITE_URL_DUM . "rfq2list");  // rae
                exit;
            }
        } else if ($eFrom == 'PO') {
            $dup_dtls = $rfq2Obj->getDetails('iRFQ2Id', " AND iPurchaseOrderID=$iPurchaseOrderID AND eDelete!='Verified' AND eAuctionStatus!='Cancelled' ");
            if (is_array($dup_dtls) && count($dup_dtls) > 0) {
                header("Location: " . SITE_URL_DUM . "rfq2list");  // rae
                exit;
            }
        }
        //
        //pr($Data); exit;
        $res = $id = $rfq2Obj->insert($Data);
        $iRFQ2Id = $res;
        if ($res > 0) {
            $opatype = ($orgas == 'Buyer') ? 'BProduct' : (($orgas == 'Supplier') ? 'SProduct' : $opatype);
            $atbl = ($opatype == 'BProduct') ? PRJ_DB_PREFIX . "_buyer2_buyer_bproduct_association" : (($opatype == 'SProduct') ? PRJ_DB_PREFIX . "_buyer2_supplier_sproduct_association" : '');
            $absfld = ($opatype == 'BProduct') ? "iBuyerId" : (($opatype == 'SProduct') ? "iSupplierId" : '');
            if (is_array($abdata) && count($abdata) > 0 && $iProductId > 0 && $curORGID > 0 && $atbl != '') {
                for ($l = 0; $l < count($abdata); $l++) {
                    $sql = "Select iAssociationId from $atbl where iProductId=$iProductId AND $absfld=$curORGID AND iBuyer2Id=" . $abdata[$l];
                    $adt = $dbobj->MySQLSelect($sql);
                    if (isset($adt[0]['iAssociationId']) && $adt[0]['iAssociationId'] > 0) {
                        $adata['iRFQ2Id'] = $id;
                        $adata['iBuyer2Id'] = $abdata[$l];
                        $adata['iAssociationId'] = $adt[0]['iAssociationId'];
                        $adata['ePType'] = $opatype;
                        $adata['dADate'] = calcGTzTime(date('Y-m-d'), 'Y-m-d');
                        $rs = $rpb2Obj->insert($adata);
                    } else {
                        $rs = $rfq2Obj->clearRfq2NAssoc($id);
                        if ($rs) {
                            $generalobj->getPostForm($_POST, '', SITE_URL_DUM . "rfq2create/pb2m");
                            exit;
                        } else {
                            $sql = "Select iAssociationId, iProductId from $atbl where $absfld=$curORGID AND iBuyer2Id=" . $abdata[$l];  // iProductId=$iProductId AND
                            $adt = $dbobj->MySQLSelect($sql);
                            //
                            if (isset($adt[0]['iAssociationId']) && $adt[0]['iAssociationId'] > 0) {
                                $adata['iRFQ2Id'] = $id;
                                $adata['iBuyer2Id'] = $abdata[$l];
                                $adata['iProductId'] = $adt[0]['iProductId'];
                                $adata['iAssociationId'] = $adt[0]['iAssociationId'];
                                $adata['ePType'] = $opatype;
                                $adata['dADate'] = calcGTzTime(date('Y-m-d'), 'Y-m-d');
                                $rs = $rpb2Obj->insert($adata);
                            } else {
                                $rs = $rfq2Obj->clearRfq2NAssoc($id);
                                $generalobj->getPostForm($_POST, '', SITE_URL_DUM . "rfq2create/pb2m");
                                exit;
                            }
                        }
                        //
                    }
                }
            }
            //
            $files = $_FILES['files'];
            for ($i = 0; $i < count($files['name']); $i++) {
                $flnm = '';
                if (($files['error'][$i] == 0) && ($files['size'][$i] > 0)) {
                    $fileUpload['name'] = $files['name'][$i];
                    $fileUpload['tmp_name'] = $files['tmp_name'][$i];
                    $flnm = $fluplObj->UploadFile('rfq2', 'docs', $id, $fileUpload, '');
                    $fdata['vFile'] = $flnm;
                    $fdata['iRFQ2Id'] = $id;
                    if (strrpos($flnm, '.') !== false) {
                        $fdata['vExt'] = substr($flnm, (strrpos($flnm, '.') + 1));
                    } else {
                        $fdata['vExt'] = '';
                    }
                    $fdata['dADate'] = calcGTzTime(date('Y-m-d'), 'Y-m-d');
                    if (trim($flnm) != '') {
                        $rs = $rfq2flObj->insert($fdata);
                    }
                }
            }
            //
            $sts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE 'RFQ2,%' AND vStatus_en='Verify' ");
            if ($Data['iStatusID'] == $sts[0]['iStatusID']) {
                $vrfy_eml = 'y';
                //
                if($Data['eAuctionType'] == 'Tender') {
                    $aacptl = $rfq2Obj->chkAutoAcptLimit($iRFQ2Id);
                }
                //
            }
            if ($Data['eSaved'] != 'Yes' || $vrfy_eml == 'y') {
                if ($eFrom == 'Invoice') {
                    $jtbl = " LEFT JOIN " . PRJ_DB_PREFIX . "_status_master sm on rfq2.iStatusID=sm.iStatusID
							LEFT JOIN " . PRJ_DB_PREFIX . "_inovice_order_heading ioh on rfq2.iInvoiceID=ioh.iInvoiceID ";
                } else if ($eFrom == 'PO') {
                    $jtbl = " LEFT JOIN " . PRJ_DB_PREFIX . "_status_master sm on rfq2.iStatusID=sm.iStatusID
							LEFT JOIN " . PRJ_DB_PREFIX . "_purchase_order_heading ioh on rfq2.iPurchaseOrderID=ioh.iPurchaseOrderID ";
                }
                $where .= " AND rfq2.iRFQ2ID=$id ";
                $fields = " rfq2.*, ioh.*, sm.vStatus_en as vStatus, rfq2.eSaved ";
                $dtls = $rfq2Obj->getJoinTableInfo($jtbl, $fields, $where, '', '', '', '');
                if ($eFrom == 'PO') {
                    $dtls[0]['vInvoiceCode'] = $dtls[0]['vPOCode'];
                }
                //
                $orgdtls = $orgObj->select($dtls[0]['iOrganizationID']);
                if (is_array($dtls) && count($dtls) > 0 && is_array($orgdtls) && count($orgdtls) > 0) {
                    $db_email = $emailObj->getDetails('*', " AND vType='New RFQ2' AND eSection='Member' ");
                    $link = SITE_URL . "rfq2view/" . $id;
                    $body = Array("#CREATED_BY#", "#RFQ2CODE#", "#INVOICECODE#", "#STARTDATE#", "#ENDDATE#", "#TYPE#", "#LINK#");
                    // calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
                    $post = Array($orgdtls[0]['vCompanyName'] . '(' . $orgdtls[0]['vOrganizationCode'] . ')', $dtls[0]['vRFQ2Code'], $dtls[0]['vInvoiceCode'], $dtls[0]['dStartDate'], $dtls[0]['dEndDate'], $dtls['eBidCriteria'], $link);

                    $rplarr = Array("Hello #USER#,", "background-color: rgb(239, 239, 239);", "Regards,", "#MAIL_FOOTER#", "#SITE_URL#");
                    $tbody_en = str_replace($rplarr, " ", $db_email[0]['tBody_en']);
                    $emailContent_en = trim(str_replace($body, $post, $tbody_en));
                    $tbody_fr = str_replace($rplarr, " ", $db_email[0]['tBody_fr']);
                    $emailContent_fr = trim(str_replace($body, $post, $tbody_fr));

                    $dt['iItemID'] = $id;
                    $dt['iOrganizationID'] = $dtls[0]['iOrganizationID'];
                    $dt['vMailSubject_en'] = $db_email[0]['vSub_en'];
                    $dt['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
                    $dt['tMailContent_en'] = $emailContent_en;
                    $dt['tMailContent_fr'] = $emailContent_fr;
                    $dt['eSubject'] = "RFQ2";
                    $dt['eType'] = "Create";
                    $dt['iCreatedBy'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'];
                    $dt['eCreatedType'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_USER_TYPE_SHORT'];
                    $dt['dActionDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
                    $userActionObj->setAllVar($dt);
                    $userActionObj->insert();
                    //
                    $emailArr = array();
                    $sts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE '%RFQ2,%' AND vStatus_en='Verify' ");
                    $vsts = $sts[0]['iStatusID'];
                    $emailArr = $orgUsrObj->getPermittedUsers($dtls[0]['iOrganizationID'], "$vsts%", '', 'vRFQ2Permits', " AND ou.eEmailNotification='Yes' AND ou.eStatus='Active' ");
                    $body_arr = Array("#USER#", "#CREATED_BY#", "#RFQ2CODE#", "#INVOICECODE#", "#STARTDATE#", "#ENDDATE#", "#TYPE#", "#LINK#", "#MAIL_FOOTER#", "#SITE_URL#");
                    if ((is_array($emailArr) && count($emailArr) > 0)) {
                        for ($i = 0; $i < count($emailArr); $i++) {
                            $smname = $emailArr[$i]['vFirstName'] . ' ' . $emailArr[$i]['vLastName'];
                            $email = $emailArr[$i]['vEmail'];
                            $post_arr = Array($smname, $orgdtls[0]['vCompanyName'] . '(' . $orgdtls[0]['vOrganizationCode'] . ')', $dtls[0]['vRFQ2Code'], $dtls[0]['vInvoiceCode'], $dtls[0]['dStartDate'], $dtls[0]['dEndDate'], $dtls[0]['eBidCriteria'], $link, $MAIL_FOOTER, SITE_URL);
                            $sendMail->Send("New RFQ2", "Member", $email, $body_arr, $post_arr);
                        }
                    }
                }
            }
            $msg = 'ras';
        } else {
            $msg = 'raer';
        }
    } else if (trim($view) == 'edit') {
        // pr($_POST); pr($_FILES); exit;

        $adata['iProductId'] = $iProductId;
        $abdata = $Data['iBuyer2Id'];
        $id = $iRFQ2Id = PostVar('iRFQ2Id');

        unset($Data['iProductId']);
        unset($Data['Buyer2Id']);
        unset($Data['iBuyer2Id']);
        $rfq2_dtls = $rfq2Obj->select($iRFQ2Id);
        if (!isset($rfq2_dtls[0]['vRFQ2No']) || trim($rfq2_dtls[0]['vRFQ2No']) == '') {
            $Data['vRFQ2No'] = $rfq2Obj->getUniqueCode('RFQ2');
        }
        $Data = $rfq2Obj->iacalcRfq2Amount($Data);
        $Data['iUserID'] = $sess_id;
        $Data['iModifiedById'] = $sess_id;
        $Data['iOrganizationID'] = $curORGID;
        $Data['eCreatedBy'] = $orgas;
        $Data['eSaved'] = ($Data['eSaved'] == 'Yes') ? 'Yes' : 'No';
        $Data['dADate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
        $Data['vFromIP'] = $_SERVER['REMOTE_ADDR'];

        $orgprf = $orgprefObj->getDetails('*', " AND iOrganizationID=" . $curORGID);
        // $orgprf = $orgprefObj->select($dtls[0]['iOrganizationID']);
        $gmtoffset = $_POST['gmtoffset'];
        if($Data['dStartDate'] != ""){
            $Data['dStartDate'] = calcGTzTimeFmo($Data['dStartDate'], 'Y-m-d H:i:s', $gmtoffset);
        }
        if($Data['dEndDate'] != ""){
            $Data['dEndDate'] = calcGTzTimeFmo($Data['dEndDate'], 'Y-m-d H:i:s', $gmtoffset);
        }
        if ($orgprf[0]['eRFQ2VerifyReq'] == 'Yes' || $Data['eSaved'] == 'Yes') {
            $sts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE 'RFQ2,%' AND vStatus_en='Create' ");
            $Data['iStatusID'] = $sts[0]['iStatusID'];
        } else {
            $sts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE 'RFQ2,%' AND vStatus_en='Verify' ");
            $Data['iStatusID'] = $sts[0]['iStatusID'];
            if ($Data['eInstantStart'] == 'Yes') {
                $Data['dStartDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
                $Data['eRelativeEndTime'] = 'Yes';
            }
            if ($Data['eRelativeEndTime'] == 'Yes') {
                $Data['iEndAfterHrs'] = ($Data['iEndAfterHrs'] != '' && $Data['iEndAfterHrs'] != '00') ? intval($Data['iEndAfterHrs']) : 0;
                $Data['iEndAfterMin'] = ($Data['iEndAfterMin'] != '' && $Data['iEndAfterMin'] != '00') ? intval($Data['iEndAfterMin']) : 0;
				$Data['dEndDate'] = date("Y-m-d H:i:s", strtotime($Data['dStartDate'] . "+" . $Data['iEndAfterHrs'] . " hour +" . $Data['iEndAfterMin'] . " minutes"));
            }

            if (strtotime($Data['dStartDate']) - strtotime(calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s')) > 0 || $Data['eSaved'] == 'Yes') {
                $Data['eAuctionStatus'] = "Not Started";
            } else if (strtotime($Data['dEndDate']) - strtotime(calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s')) > 0) {
                $Data['eAuctionStatus'] = "Live";
            } else if ($Data['dStartDate'] == $Data['dEndDate']) {
                $Data['eAuctionStatus'] = "Completed";
            } else {
                $Data['eAuctionStatus'] = "Cancelled";
            }
        }
        //pr($Data); exit;
        $res = $rfq2Obj->updateData($Data, " iRFQ2Id=$iRFQ2Id ");
        if ($res > 0) {
            $opatype = (trim($orgas) == 'Buyer') ? 'BProduct' : (($orgas == 'Supplier') ? 'SProduct' : '');
            $atbl = ($opatype == 'BProduct') ? PRJ_DB_PREFIX . "_buyer2_buyer_bproduct_association" : (($opatype == 'SProduct') ? PRJ_DB_PREFIX . "_buyer2_supplier_sproduct_association" : '');
            $absfld = ($opatype == 'BProduct') ? "iBuyerId" : (($opatype == 'SProduct') ? "iSupplierId" : '');
            if (is_array($abdata) && count($abdata) > 0 && $iProductId > 0 && $curORGID > 0 && $atbl != '') {
                $drs = $rpb2Obj->del(" iRFQ2Id=$iRFQ2Id ");
                for ($l = 0; $l < count($abdata); $l++) {
                    $sql = "Select iAssociationId from $atbl where iProductId=$iProductId AND $absfld=$curORGID AND iBuyer2Id=" . $abdata[$l];
                    $adt = $dbobj->MySQLSelect($sql);
                    if (isset($adt[0]['iAssociationId']) && $adt[0]['iAssociationId'] > 0) {
                        $adata['iRFQ2Id'] = $id;
                        $adata['iBuyer2Id'] = $abdata[$l];
                        $adata['iAssociationId'] = $adt[0]['iAssociationId'];
                        $adata['ePType'] = $opatype;
                        $adata['dADate'] = calcGTzTime(date('Y-m-d'), 'Y-m-d');
                        $rs = $rpb2Obj->insert($adata);
                    }
                }
            }
            //
            $files = $_FILES['files'];
            $dfid = PostVar('deleteFiles');
            if (trim($dfid) != '') {
                $drs = $rfq2flObj->del(" iRfq2FileId IN ($dfid) ");
            }
            for ($i = 0; $i < count($files['name']); $i++) {
                $flnm = '';
                if (($files['error'][$i] == 0) && ($files['size'][$i] > 0)) {
                    $fileUpload['name'] = $files['name'][$i];
                    $fileUpload['tmp_name'] = $files['tmp_name'][$i];
                    $flnm = $fluplObj->UploadFile('rfq2', 'docs', $id, $fileUpload, '');
                    $fdata['vFile'] = $flnm;
                    $fdata['iRFQ2Id'] = $id;
                    if (strrpos($flnm, '.') !== false) {
                        $fdata['vExt'] = substr($flnm, (strrpos($flnm, '.') + 1));
                    } else {
                        $fdata['vExt'] = '';
                    }
                    $fdata['dADate'] = calcGTzTime(date('Y-m-d'), 'Y-m-d');
                    if (trim($flnm) != '') {
                        $rs = $rfq2flObj->insert($fdata);
                    }
                }
            }
            //
            $sts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE 'RFQ2,%' AND vStatus_en='Verify' ");
            if ($Data['iStatusID'] == $sts[0]['iStatusID']) {
                $vrfy_eml = 'y';
                //
                if($Data['eAuctionType'] == 'Tender') {
                    $aacptl = $rfq2Obj->chkAutoAcptLimit($iRFQ2Id);
                }
                //
            } else if ($Data['eSaved'] != 'Yes') {
                if ($eFrom == 'Invoice') {
                    $jtbl = " LEFT JOIN " . PRJ_DB_PREFIX . "_status_master sm on rfq2.iStatusID=sm.iStatusID
							LEFT JOIN " . PRJ_DB_PREFIX . "_inovice_order_heading ioh on rfq2.iInvoiceID=ioh.iInvoiceID ";
                } else if ($eFrom == 'PO') {
                    $jtbl = " LEFT JOIN " . PRJ_DB_PREFIX . "_status_master sm on rfq2.iStatusID=sm.iStatusID
							LEFT JOIN " . PRJ_DB_PREFIX . "_purchase_order_heading ioh on rfq2.iPurchaseOrderID=ioh.iPurchaseOrderID ";
                }
                $where .= " AND rfq2.iRFQ2ID=$iRFQ2Id ";
                $fields = " rfq2.*, ioh.*, sm.vStatus_en as vStatus, rfq2.eSaved ";
                $dtls = $rfq2Obj->getJoinTableInfo($jtbl, $fields, $where, '', '', '', '');
                if ($eFrom == 'PO') {
                    $dtls[0]['vInvoiceCode'] = $dtls[0]['vPOCode'];
                }
                //
                $orgdtls = $orgObj->select($dtls[0]['iOrganizationID']);
                if (is_array($dtls) && count($dtls) > 0 && is_array($orgdtls) && count($orgdtls) > 0) {
                    $db_email = $emailObj->getDetails('*', " AND vType='RFQ2 Status Changed' AND eSection='Member' ");
                    $link = SITE_URL . "rfq2view/" . $iRFQ2Id;
                    $body = Array("#MODIFIED_BY#", "#RFQ2CODE#", "#INVOICECODE#", "#STARTDATE#", "#ENDDATE#", "#TYPE#", "#LINK#");
                    $post = Array($sess_user_name . "($sess_usertype_short)", $dtls[0]['vRFQ2Code'], $dtls[0]['vInvoiceCode'], $dtls[0]['dStartDate'], $dtls[0]['dEndDate'], $dtls[0]['eBidCriteria'], $link);

                    $rplarr = Array("Hello #USER#,", "background-color: rgb(239, 239, 239);", "Regards,", "#MAIL_FOOTER#", "#SITE_URL#");
                    $tbody_en = str_replace($rplarr, " ", $db_email[0]['tBody_en']);
                    $emailContent_en = trim(str_replace($body, $post, $tbody_en));
                    $tbody_fr = str_replace($rplarr, " ", $db_email[0]['tBody_fr']);
                    $emailContent_fr = trim(str_replace($body, $post, $tbody_fr));

                    $dt['iItemID'] = $iRFQ2Id;  // $id
                    $dt['iOrganizationID'] = $dtls[0]['iOrganizationID'];
                    $dt['vMailSubject_en'] = $db_email[0]['vSub_en'];
                    $dt['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
                    $dt['tMailContent_en'] = $emailContent_en;
                    $dt['tMailContent_fr'] = $emailContent_fr;
                    $dt['eSubject'] = "RFQ2";
                    $dt['eType'] = "Modified";
                    $dt['iCreatedBy'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'];
                    $dt['eCreatedType'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_USER_TYPE_SHORT'];
                    $dt['dActionDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
                    $userActionObj->setAllVar($dt);
                    $userActionObj->insert();
                    //
                    $emailArr = array();
                    $sts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE '%RFQ2,%' AND vStatus_en='Verify' ");
                    $vsts = $sts[0]['iStatusID'];
                    $emailArr = $orgUsrObj->getPermittedUsers($dtls[0]['iOrganizationID'], "%$vsts%", '', 'vRFQ2Permits', " AND ou.eEmailNotification='Yes' AND ou.eStatus='Active' ");
                    $body_arr = Array("#USER#", "#MODIFIED_BY#", "#RFQ2CODE#", "#INVOICECODE#", "#STARTDATE#", "#ENDDATE#", "#TYPE#", "#LINK#", "#MAIL_FOOTER#", "#SITE_URL#");
                    if ((is_array($emailArr) && count($emailArr) > 0)) {
                        for ($i = 0; $i < count($emailArr); $i++) {
                            $smname = $emailArr[$i]['vFirstName'] . ' ' . $emailArr[$i]['vLastName'];
                            $email = $emailArr[$i]['vEmail'];
                            $post_arr = Array($smname, $sess_user_name . "($sess_usertype_short)", $dtls[0]['vRFQ2Code'], $dtls[0]['vInvoiceCode'], $dtls[0]['dStartDate'], $dtls[0]['dEndDate'], $dtls[0]['eBidCriteria'], $link, $MAIL_FOOTER, SITE_URL);
                            $sendMail->Send("RFQ2 Status Changed", "Member", $email, $body_arr, $post_arr);
                        }
                    }
                }
                //
            }
            $msg = 'res';
        } else {
            $msg = 'reer';
        }
        //
    }
}
//

$aacptl['chk'] = 'n';
if (trim($view) != '' && trim($view) != 'add') {
    $iRFQ2Id = PostVar('iRFQ2Id');
}
if (trim($iRFQ2Id) != '' && $iRFQ2Id > 0) {
    if ($view == 'verify') {
        // pr($_POST); exit;
        $dt = $rfq2Obj->select($iRFQ2Id);
        $updt['iVerifiedBy'] = $sess_id;
        if (isset($dt[0]['eDelete']) && $dt[0]['eDelete'] == 'Yes') {
            $updt['eDelete'] = 'Verified';
        } else {
            $sts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE 'RFQ2,%' AND vStatus_en='Verify' ");
            $updt['iStatusID'] = $sts[0]['iStatusID'];
        }
        # // date logic if instant
        $gmtoffset = $_POST['gmtoffset'];
        if ($dt[0]['eInstantStart'] == 'Yes') {
            $updt['dStartDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
            $dt[0]['eRelativeEndTime'] = 'Yes';
        }
        if ($dt[0]['eRelativeEndTime'] == 'Yes') {
            $updt['iEndAfterHrs'] = ($dt[0]['iEndAfterHrs'] != '' && $dt[0]['iEndAfterHrs'] != '00') ? intval($dt[0]['iEndAfterHrs']) : 0;
            $updt['iEndAfterMin'] = ($dt[0]['iEndAfterMin'] != '' && $dt[0]['iEndAfterMin'] != '00') ? intval($dt[0]['iEndAfterMin']) : 0;
            $updt['dEndDate'] = date("Y-m-d H:i:s", strtotime($updt['dStartDate'] . "+" . $dt[0]['iEndAfterHrs'] . " hour +" . $dt[0]['iEndAfterMin'] . " minutes"));
        }
        if (strtotime($updt['dStartDate']) - strtotime(calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s')) > 0 || $dt[0]['eSaved'] == 'Yes') {
            $updt['eAuctionStatus'] = "Not Started";
        } else if (strtotime($updt['dEndDate']) - strtotime(calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s')) > 0) {
            $updt['eAuctionStatus'] = "Live";
        } else if ($updt['dStartDate'] == $updt['dEndDate']) {
            $Data['eAuctionStatus'] = "Completed";
        } else {
            $updt['eAuctionStatus'] = "Cancelled";
        }
		$res = $rfq2Obj->updateData($updt, " iRFQ2Id=$iRFQ2Id ");
        if ($res) {
            if (!isset($dt[0]['eDelete']) || $dt[0]['eDelete'] != 'Yes') {
                $vrfy_eml = 'y';
                if ($dt[0]['eAuctionType'] == 'Tender') {
                    /*if ($dt[0]['eFrom'] == "PO") {
                        $aacptl['chk'] = 'y';
                        $r2pb2_dtls = $rfq2Obj->getRfq2PB2Asoc($iRFQ2Id);
                        $aacptl['iBuyer2Id'] = $r2pb2_dtls[0]['iBuyer2Id'];
                    } else { */
                        $aacptl = $rfq2Obj->chkAutoAcptLimit($iRFQ2Id);
                    // }
                    // pr($aacptl); exit;
                }
            }
            $vrfydt['iVerifiedBy'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'];
            $vrfydt['eVerifiedBy'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_USER_TYPE_SHORT'];
            $vrfydt['dVerifyDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
            $vrfydt['vVerifyFromIP'] = $_SERVER['REMOTE_ADDR'];
            $vrfydt['vAction'] = 'Verify';
            $ivid = $userActionObj->getDetails('iVerifiedID', " AND iItemID=$iRFQ2Id AND eSubject='RFQ2' ", " iVerifiedID DESC ");
            if (isset($ivid[0]['iVerifiedID']) && trim($ivid[0]['iVerifiedID']) != '' && $ivid[0]['iVerifiedID'] > 0) {
                $ivid = $ivid[0]['iVerifiedID'];
                $rs = $userActionObj->updateData($vrfydt, " iVerifiedID=$ivid ");
            }
            $msg = "rvs";
        } else {
            $msg = "rver";
        }
    } else if ($view == 'reject') {
        $dt = $rfq2Obj->select($iRFQ2Id);
        $updt['iRejectedById'] = $sess_id;
        if (isset($dt[0]['eDelete']) && $dt[0]['eDelete'] == 'Yes') {
            $updt['eDelete'] = 'No';
        } else {
            $sts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE 'RFQ2,%' AND vStatus_en='Rejected' ");
            $updt['iStatusID'] = $sts[0]['iStatusID'];
        }
        $updt['tReasonToReject'] = Postvar('tReasonToReject');
        $res = $rfq2Obj->updateData($updt, " iRFQ2Id=$iRFQ2Id ");
        //
        if ($res) {
            $vrfydt['iVerifiedBy'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'];
            $vrfydt['eVerifiedBy'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_USER_TYPE_SHORT'];
            $vrfydt['dVerifyDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
            $vrfydt['vVerifyFromIP'] = $_SERVER['REMOTE_ADDR'];
            $vrfydt['vAction'] = 'Rejected';
            $ivid = $userActionObj->getDetails('iVerifiedID', " AND iItemID=$iRFQ2Id AND eSubject='RFQ2' ", " iVerifiedID DESC ");
            if (isset($ivid[0]['iVerifiedID']) && trim($ivid[0]['iVerifiedID']) != '' && $ivid[0]['iVerifiedID'] > 0) {
                $ivid = $ivid[0]['iVerifiedID'];
                $rs = $userActionObj->updateData($vrfydt, " iVerifiedID=$ivid ");
            }
            //
            /* $jtbl = " LEFT JOIN ".PRJ_DB_PREFIX."_status_master sm on rfq2.iStatusID=sm.iStatusID
              LEFT JOIN ".PRJ_DB_PREFIX."_inovice_order_heading ioh on rfq2.iInvoiceID=ioh.iInvoiceID ";
              $where .= " AND rfq2.iRFQ2ID=$iRFQ2Id ";
              $fields = " rfq2.*, ioh.*, sm.vStatus_en as vStatus, rfq2.eSaved ";
              $dtls = $rfq2Obj->getJoinTableInfo($jtbl, $fields, $where,'','','','');
              //
              $orgdtls = $orgObj->select($dtls[0]['iOrganizationID']);
              if(is_array($dtls) && count($dtls)>0 && is_array($orgdtls) && count($orgdtls)>0)
              {
              $db_email = $emailObj->getDetails('*', " AND vType='RFQ2 Status Changed' AND eSection='Member' ");
              $link = SITE_URL."rfq2view/".$iRFQ2Id;
              $body = Array("#REJECTED_BY#","#RFQ2CODE#","#INVOICECODE#","#STARTDATE#","#ENDDATE#","#TYPE#","#LINK#");
              $post = Array($sess_user_name."($sess_usertype_short)", $dtls[0]['vRFQ2Code'], $dtls[0]['vInvoiceCode'], $dtls[0]['dStartDate'], $dtls[0]['dEndDate'], $link);

              $rplarr = Array("Hello #NAME#,","background-color: rgb(239, 239, 239);","Regards,","#MAIL_FOOTER#","#SITE_URL#");
              $tbody_en = str_replace($rplarr," ",$db_email[0]['tBody_en']);
              $emailContent_en = trim(str_replace($body,$post, $tbody_en));
              $tbody_fr = str_replace($rplarr," ",$db_email[0]['tBody_fr']);
              $emailContent_fr = trim(str_replace($body,$post, $tbody_fr));

              $dt['iItemID'] = $iRFQ2Id;
              $dt['iOrganizationID'] = $dtls[0]['iOrganizationID'];
              $dt['vMailSubject_en'] = $db_email[0]['vSub_en'];
              $dt['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
              $dt['tMailContent_en'] = $emailContent_en;
              $dt['tMailContent_fr'] = $emailContent_fr;
              $dt['eSubject'] = "RFQ2";
              $dt['eSubject'] = "Rejected";
              $dt['iCreatedBy'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
              $dt['eCreatedType'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'];
              $dt['dActionDate'] = date("Y-m-d H:i:s");
              $userActionObj->setAllVar($dt);
              $userActionObj->insert();
              //
              $emailArr = array();
              $sts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE 'RFQ2,%' AND vStatus_en='Create' ");
              $crs = $sts[0]['iStatusID'];
              $emailArr = $orgUsrObj->getPermittedUsers($dtls[0]['iOrganizationID'],"$crs%",'','vRFQ2Permits'," AND ou.eEmailNotification='Yes' AND ou.eStatus='Active' ");
              $body_arr = Array("#NAME#","#REJECTED_BY#","#RFQ2CODE#","#INVOICECODE#","#STARTDATE#","#ENDDATE#","#TYPE#","#LINK#","#MAIL_FOOTER#","#SITE_URL#");
              if((is_array($emailArr) && count($emailArr) > 0)) {
              for($i=0;$i<count($emailArr);$i++) {
              $smname = $emailArr[$i]['vFirstName'].' '.$emailArr[$i]['vLastName'];
              $email = $emailArr[$i]['vEmail'];
              $post_arr = Array($smname,$sess_user_name."($sess_usertype_short)",$orgdtls[0]['vCompanyName'].'('.$orgdtls[0]['vOrganizationCode'].')', $dtls[0]['vRFQ2Code'], $dtls[0]['vInvoiceCode'], $dtls[0]['dStartDate'], $dtls[0]['dEndDate'], $link,$MAIL_FOOTER,SITE_URL);
              $sendMail->Send("RFQ2 Rejected","Member",$email,$body_arr,$post_arr);
              }
              }
              } */
            $msg = "rrs";
        } else {
            $msg = "rrer";
        }
        //
    } else if ($view == 'cancel') {
        $dt = $rfq2Obj->select($iRFQ2Id);
        $eFrom = $dt[0]['eFrom'];
        if ($eFrom == 'Invoice') {
            $jtbl = " LEFT JOIN " . PRJ_DB_PREFIX . "_status_master sm on rfq2.iStatusID=sm.iStatusID
					LEFT JOIN " . PRJ_DB_PREFIX . "_inovice_order_heading ioh on rfq2.iInvoiceID=ioh.iInvoiceID ";
        } else if ($eFrom == 'PO') {
            $jtbl = " LEFT JOIN " . PRJ_DB_PREFIX . "_status_master sm on rfq2.iStatusID=sm.iStatusID
					LEFT JOIN " . PRJ_DB_PREFIX . "_purchase_order_heading ioh on rfq2.iPurchaseOrderID=ioh.iPurchaseOrderID ";
        }
        $where .= " AND rfq2.iRFQ2ID=$iRFQ2Id ";
        $fields = " rfq2.*, ioh.*, sm.vStatus_en as vStatus, rfq2.eSaved ";
        $dtls = $rfq2Obj->getJoinTableInfo($jtbl, $fields, $where, '', '', '', '');
        if ($eFrom == 'PO') {
            $dtls[0]['vInvoiceCode'] = $dtls[0]['vPOCode'];
        }
        if (is_array($dtls) && count($dtls) > 0 && isset($dtls[0]['iRFQ2Id']) && $dtls[0]['iRFQ2Id'] > 0) {
            $rsts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE 'RFQ2,%' AND vStatus_en='Rejected' ");
            $ur2dt['iStatusID'] = $rsts[0]['iStatusID'];
            $ur2dt['iRejectedById'] = $sess_id;
            $ur2dt['eAuctionStatus'] = 'Cancelled';
            $res = $rfq2Obj->updateData($ur2dt, " iRFQ2Id='" . $dtls[0]['iRFQ2Id'] . "'");
            if ($res) {
                $msg = "rcs";
            } else {
                $msg = 'rcer';
            }
        } else {
            $msg = 'rcer';
        }
        //
        $db_email = $emailObj->getDetails('*', " AND vType='RFQ2 Cancelled' AND eSection='Member' ");
        $link = SITE_URL . "rfq2view/" . $id;
        $body = Array("#CANCELLED_BY#", "#RFQ2CODE#", "#INVOICECODE#", "#STARTDATE#", "#ENDDATE#", "#TYPE#", "#LINK#");
        $post = Array($sess_user_name . "($sess_usertype_short)", $dtls[0]['vRFQ2Code'], $dtls[0]['vInvoiceCode'], $dtls[0]['dStartDate'], $dtls[0]['dEndDate'], $dtls[0]['eBidCriteria'], $link);

        $rplarr = Array("Hello #NAME#,", "background-color: rgb(239, 239, 239);", "Regards,", "#MAIL_FOOTER#", "#SITE_URL#");
        $tbody_en = str_replace($rplarr, " ", $db_email[0]['tBody_en']);
        $emailContent_en = trim(str_replace($body, $post, $tbody_en));
        $tbody_fr = str_replace($rplarr, " ", $db_email[0]['tBody_fr']);
        $emailContent_fr = trim(str_replace($body, $post, $tbody_fr));

        $dt = array();
        $dt['iItemID'] = $dtls[0]['iRFQ2Id'];
        $dt['iOrganizationID'] = $dtls[0]['iOrganizationID'];
        $dt['vMailSubject_en'] = $db_email[0]['vSub_en'];
        $dt['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
        $dt['tMailContent_en'] = $emailContent_en;
        $dt['tMailContent_fr'] = $emailContent_fr;
        $dt['eSubject'] = "RFQ2";
        $dt['eType'] = 'Rejected';
        $dt['vAction'] = 'Cancelled';
        $dt['iCreatedBy'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'];
        $dt['eCreatedType'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_USER_TYPE_SHORT'];
        $dt['dActionDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
        $userActionObj->setAllVar($dt);
        $userActionObj->insert();
        $dt['iOrganizationID'] = $dtls[0]['iBuyer2Id'];
        $userActionObj->setAllVar($dt);
        $userActionObj->insert();
        //
        $emailArr = array();
        $sts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE 'RFQ2,%' AND vStatus_en='Create' ");
        $csts = $sts[0]['iStatusID'];
        $emailArr = $orgUsrObj->getPermittedUsers($dtls[0]['iOrganizationID'], "$csts%", '', 'vRFQ2BidPermits', " AND ou.eEmailNotification='Yes' AND ou.eStatus='Active' ");
        $body_arr = Array("#NAME#", "#CANCELLED_BY#", "#RFQ2CODE#", "#INVOICECODE#", "#STARTDATE#", "#ENDDATE#", "#TYPE#", "#LINK#", "#MAIL_FOOTER#", "#SITE_URL#");
        if ((is_array($emailArr) && count($emailArr) > 0)) {
            for ($i = 0; $i < count($emailArr); $i++) {
                $smname = $emailArr[$i]['vFirstName'] . ' ' . $emailArr[$i]['vLastName'];
                $email = $emailArr[$i]['vEmail'];
                $post_arr = Array($smname, $sess_user_name . "($sess_usertype_short)", $dtls[0]['vRFQ2Code'], $dtls[0]['vBidNum'], $dtls[0]['fBidAdvanceTotal'], $dtls[0]['fBidPriceTotal'], $link, $MAIL_FOOTER, SITE_URL);
                $sendMail->Send("RFQ2 Cancelled", "Member", $email, $body_arr, $post_arr);
            }
        }
        $emailArr = $orgUsrObj->getPermittedUsers($dtls[0]['iBuyer2Id'], "$csts%", '', 'vRFQ2BidPermits', " AND ou.eEmailNotification='Yes' AND ou.eStatus='Active' ");
        if ((is_array($emailArr) && count($emailArr) > 0)) {
            for ($i = 0; $i < count($emailArr); $i++) {
                $smname = $emailArr[$i]['vFirstName'] . ' ' . $emailArr[$i]['vLastName'];
                $email = $emailArr[$i]['vEmail'];
                $post_arr = Array($smname, $sess_user_name . "($sess_usertype_short)", $dtls[0]['vRFQ2Code'], $dtls[0]['vBidNum'], $dtls[0]['fBidAdvanceTotal'], $dtls[0]['fBidPriceTotal'], $link, $MAIL_FOOTER, SITE_URL);
                $sendMail->Send("RFQ2 Cancelled", "Member", $email, $body_arr, $post_arr);
            }
        }
        //
        header("Location: " . SITE_URL_DUM . "rfq2rlist/$msg");
        exit;
        //
    }
}
//
if ($vrfy_eml == 'y') {
    $dt = $rfq2Obj->select($iRFQ2Id);
    $eFrom = $dt[0]['eFrom'];
    if ($eFrom == 'Invoice') {
        $jtbl = " LEFT JOIN " . PRJ_DB_PREFIX . "_status_master sm on rfq2.iStatusID=sm.iStatusID
				  LEFT JOIN " . PRJ_DB_PREFIX . "_inovice_order_heading ioh on rfq2.iInvoiceID=ioh.iInvoiceID ";
    } else if ($eFrom == 'PO') {
        $jtbl = " LEFT JOIN " . PRJ_DB_PREFIX . "_status_master sm on rfq2.iStatusID=sm.iStatusID
				  LEFT JOIN " . PRJ_DB_PREFIX . "_purchase_order_heading ioh on rfq2.iPurchaseOrderID=ioh.iPurchaseOrderID ";
    }
    $where .= " AND rfq2.iRFQ2ID=$iRFQ2Id ";
    $fields = " rfq2.*, ioh.*, sm.vStatus_en as vStatus, rfq2.eSaved ";
    $dtls = $rfq2Obj->getJoinTableInfo($jtbl, $fields, $where, '', '', '', '');
    if ($eFrom == 'PO') {
        $dtls[0]['vInvoiceCode'] = $dtls[0]['vPOCode'];
    }
    // pr($dtls); exit;
    //
	$orgdtls = $orgObj->select($dtls[0]['iOrganizationID']);
    if (is_array($dtls) && count($dtls) > 0 && is_array($orgdtls) && count($orgdtls) > 0) {
        $rfq2b2 = $rfq2Obj->getRfq2B2($iRFQ2Id);
        if (is_array($rfq2b2) && count($rfq2b2) > 0) {
            for ($l = 0; $l < count($rfq2b2); $l++) {
                if ($rfq2b2[0]['iOrganizationID'] > 0) {
                    //
                    $db_email = $emailObj->getDetails('*', " AND vType='New RFQ2' AND eSection='Member' ");
                    $link = SITE_URL . "rfq2view/" . $iRFQ2Id;
                    $body = Array("#CREATED_BY#", "#RFQ2CODE#", "#INVOICECODE#", "#STARTDATE#", "#ENDDATE#", "#TYPE#", "#LINK#");
                    $post = Array($orgdtls[0]['vCompanyName'] . '(' . $orgdtls[0]['vOrganizationCode'] . ')', $dtls[0]['vRFQ2Code'], $dtls[0]['vInvoiceCode'], $dtls[0]['dStartDate'], $dtls[0]['dEndDate'], $dtls[0]['eBidCriteria'], $link);

                    $rplarr = Array("Hello #USER#,", "background-color: rgb(239, 239, 239);", "Regards,", "#MAIL_FOOTER#", "#SITE_URL#");
                    $tbody_en = str_replace($rplarr, " ", $db_email[0]['tBody_en']);
                    $emailContent_en = trim(str_replace($body, $post, $tbody_en));
                    $tbody_fr = str_replace($rplarr, " ", $db_email[0]['tBody_fr']);
                    $emailContent_fr = trim(str_replace($body, $post, $tbody_fr));

                    $dt['iItemID'] = $iRFQ2Id;  // $id
                    $dt['iOrganizationID'] = $rfq2b2[$l]['iOrganizationID'];
                    $dt['vMailSubject_en'] = $db_email[0]['vSub_en'];
                    $dt['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
                    $dt['tMailContent_en'] = $emailContent_en;
                    $dt['tMailContent_fr'] = $emailContent_fr;
                    $dt['eSubject'] = "RFQ2";
                    $dt['eType'] = "Create";
                    $dt['vAction'] = "Create";
                    $dt['iCreatedBy'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'];
                    $dt['eCreatedType'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_USER_TYPE_SHORT'];
                    $dt['dActionDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
                    $userActionObj->setAllVar($dt);
                    $userActionObj->insert();
                    //
                    $emailArr = array();
                    $sts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE '%Bid,%' AND vStatus_en='Create' ");
                    $crs = $sts[0]['iStatusID'];
                    $emailArr = $orgUsrObj->getPermittedUsers($rfq2b2[0]['iOrganizationID'], "$crs%", '', 'vRFQ2BidPermits', " AND ou.eEmailNotification='Yes' AND ou.eStatus='Active' ");
                    $body_arr = Array("#USER#", "#CREATED_BY#", "#RFQ2CODE#", "#INVOICECODE#", "#STARTDATE#", "#ENDDATE#", "#TYPE#", "#LINK#", "#MAIL_FOOTER#", "#SITE_URL#");
                    if ((is_array($emailArr) && count($emailArr) > 0)) {
                        for ($i = 0; $i < count($emailArr); $i++) {
                            $smname = $emailArr[$i]['vFirstName'] . ' ' . $emailArr[$i]['vLastName'];
                            $email = $emailArr[$i]['vEmail'];
                            $post_arr = Array($smname, $orgdtls[0]['vCompanyName'] . '(' . $orgdtls[0]['vOrganizationCode'] . ')', $dtls[0]['vRFQ2Code'], $dtls[0]['vInvoiceCode'], $dtls[0]['dStartDate'], $dtls[0]['dEndDate'], $dtls[0]['eBidCriteria'], $link, $MAIL_FOOTER, SITE_URL);
                            $sendMail->Send("New RFQ2", "Member", $email, $body_arr, $post_arr);
                        }
                    }
                    //
                }
                //
            }
        }
        //
    }

    // Auto Accept RFQ2
    if ($iRFQ2Id > 0 && $dt[0]['eAuctionType'] == 'Tender' && $aacptl['chk'] == 'y') {  // && $aacptl['bidamount']>0
        if (!isset($r2bdObj)) {
            include_once(SITE_CLASS_APPLICATION . "user/class.Rfq2Bids.php");
            $r2bdObj = new Rfq2Bids();
        }
        $rdtls = $rfq2Obj->select($iRFQ2Id);
        // add bid
        $bdt['iRFQ2Id'] = $iRFQ2Id;
        $dtls[0]['iBuyer2Id'] = $bdt['iBuyer2Id'] = $aacptl['iBuyer2Id'];
        $bdt['vBidNum'] = $r2bdObj->getUniqueCode('');
        $bdt['fBidAdvancePc'] = $rdtls[0]['fAdvanceMinPc'];
        $bdt['fBidAdvanceAmt'] = $rdtls[0]['fAdvanceMinAmt'];
        $bdt['fBidPricePc'] = $rdtls[0]['fPriceMaxPc'];
        $bdt['fBidPriceAmt '] = $rdtls[0]['fPriceMaxAmt'];
        $bdt['fBidAdvanceTotal'] = $rdtls[0]['fAdvanceTotal'];
        $bdt['fBidPriceTotal'] = $rdtls[0]['fPriceTotal'];
        $bdt['fBidAmount'] = $rdtls[0]['fTotal'];
        $gmtoffset = $_POST['gmtoffset'];
        $bdt['dBidDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
        $sts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE '%RFQ2 Bid,%' AND vStatus_en='Verify' ");
        $bdt['iStatusID'] = $sts[0]['iStatusID'];
        $bdt['eStatus'] = 'current';
        $rs = $bid = $r2bdObj->insert($bdt);
        if ($rdtls[0]['eFrom'] != "PO") {
            $ress = $rfq2Obj->updateData(Array('eAuctionStatus' => 'Completed'), " iRFQ2Id=$iRFQ2Id ");
        }

        // add award to bid as accepted
        if (!isset($r2awObj)) {
            include_once(SITE_CLASS_APPLICATION . "user/class.Rfq2Award.php");
            $r2awObj = new Rfq2Award();
        }
        $dat = array();
        $dat['iBidId'] = $bid;
        $dat['iRFQ2Id'] = $dtls[0]['iRFQ2Id'];
        $dat['eOrgCreatedBy'] = $rfq2Obj->getR2InvOrgType($curORGID, $dtls[0]['iRFQ2Id'], $rdtls[0]['eFrom']);
        $dat['iCreatedById'] = $sess_id;
        $dat['iModifiedById'] = $sess_id;
        $dat['dADate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
        $dat['vAwardNum'] = $r2awObj->getUniqueCode();
        $asts = $statusmasterObj->getDetails('*', " AND vForAuction LIKE '%RFQ2 Award,%' AND vStatus_en='Accepted' ");
        $dat['iStatusID'] = $asts[0]['iStatusID'];
        $dat['iaStatusID'] = $asts[0]['iStatusID'];
        $r2awid = $r2awObj->insert($dat);

        if ($r2awid > 0) {
            //
            if (!isset($rfq2extractObj)) {
                include_once(SITE_CLASS_APPLICATION . "user/class.RFQ2Extract.php");
                $rfq2extractObj = new RFQ2Extract();
            }
            # // need to chqange this array
            $redtl = array('iRFQ2Id' => $dtls[0]['iRFQ2Id'], 'iBuyer2Id' => $dtls[0]['iBuyer2Id'], 'iBuyerId' => $dtls[0]['iBuyerOrganizationId'], 'iSupplierId' => $dtls[0]['iSupplierOrganizationId'], 'iInvoiceID' => $dtls[0]['iInvoiceID'], 'iPurchaseOrderID' => $dtls[0]['iPurchaseOrderID'], 'vCurrency' => $dtls[0]['vCurrency'], 'dReviewDate' => date('Y-m-d', strtotime("+5 day", strtotime(date('Y-m-d')))), 'eFrom' => $dtls[0]['eFrom']);
            $re = $rfq2extractObj->insert($redtl);
            // set invoice rfq2awarded yes
            if ($dtls[0]['eFrom'] == 'Invoice') {
                if (!isset($invOrdObj)) {
                    include_once(SITE_CLASS_APPLICATION . "user/class.InvoiceOrderHeading.php");
                    $invOrdObj = new InvoiceOrderHeading();
                }
                $ress = $invOrdObj->updateData(Array('eRfq2Awarded' => 'Yes'), " iInvoiceID=" . $dtls[0]['iInvoiceID']);
            } else if ($dtls[0]['eFrom'] == 'PO') {
                if (!isset($poOrdObj)) {
                    include_once(SITE_CLASS_APPLICATION . "user/class.PurchaseOrderHeading.php");
                    $poOrdObj = new PurchaseOrderHeading();
                }
                $ress = $poOrdObj->updateData(Array('eRfq2Awarded' => 'Yes'), " iPurchaseOrderID=" . $dtls[0]['iPurchaseOrderID']);
            }

            //send mail to buyer2 for award.
            $db_email = $emailObj->getDetails('*', " AND vType='New RFQ2 Award' AND eSection='Member' ");
            $orgdtls = $orgObj->select($dtls[0]['iOrganizationID']);
            $link = SITE_URL . "b2rfq2awardview/" . $r2awid;
            $body = Array("#CREATED_BY#", "#RFQ2CODE#", "#BIDNUM#", "#ADVANCE#", "#PRICE#", "#LINK#");
            $post = Array($orgdtls[0]['vCompanyName'] . '(' . $orgdtls[0]['vOrganizationCode'] . ')', $dtls[0]['vRFQ2Code'], $dtls[0]['vBidNum'], $dtls[0]['fBidAdvanceTotal'], $dtls[0]['fBidPriceTotal'], $link);

            $rplarr = Array("Hello #NAME#,", "background-color: rgb(239, 239, 239);", "Regards,", "#MAIL_FOOTER#", "#SITE_URL#");
            $tbody_en = str_replace($rplarr, " ", $db_email[0]['tBody_en']);
            $emailContent_en = trim(str_replace($body, $post, $tbody_en));
            $tbody_fr = str_replace($rplarr, " ", $db_email[0]['tBody_fr']);
            $emailContent_fr = trim(str_replace($body, $post, $tbody_fr));

            $dt = array();
            $dt['iItemID'] = $r2awid;
            $dt['iOrganizationID'] = $dtls[0]['iBuyer2Id'];
            $dt['vMailSubject_en'] = $db_email[0]['vSub_en'];
            $dt['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
            $dt['tMailContent_en'] = $emailContent_en;
            $dt['tMailContent_fr'] = $emailContent_fr;
            $dt['eSubject'] = "RFQ2 Award";
            $dt['eType'] = 'Create';
            $dt['iCreatedBy'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'];
            $dt['eCreatedType'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_USER_TYPE_SHORT'];
            $dt['dActionDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
            $userActionObj->setAllVar($dt);
            $userActionObj->insert();
            //
            $emailArr = array();
            $sts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE '%RFQ2 Award,%' AND vStatus_en='Create' ");
            $csts = $sts[0]['iStatusID'];
            $emailArr = $orgUsrObj->getPermittedUsers($dtls[0]['iBuyer2Id'], "$csts%", '', 'vRFQ2AwardPermits', " AND ou.eEmailNotification='Yes' AND ou.eStatus='Active' ");
            $body_arr = Array("#NAME#", "#CREATED_BY#", "#RFQ2CODE#", "#BIDNUM#", "#ADVANCE#", "#PRICE#", "#LINK#", "#MAIL_FOOTER#", "#SITE_URL#");
            if((is_array($emailArr) && count($emailArr) > 0)) {
                for($i = 0; $i < count($emailArr); $i++) {
                    $smname = $emailArr[$i]['vFirstName'] . ' ' . $emailArr[$i]['vLastName'];
                    $email = $emailArr[$i]['vEmail'];
                    $post_arr = Array($smname, $orgdtls[0]['vCompanyName'] . '(' . $orgdtls[0]['vOrganizationCode'] . ')', $dtls[0]['vRFQ2Code'], $dtls[0]['vBidNum'], $dtls[0]['fBidAdvanceTotal'], $dtls[0]['fBidPriceTotal'], $link, $MAIL_FOOTER, SITE_URL);
                    $sendMail->Send("RFQ2 Award", "Member", $email, $body_arr, $post_arr);
                }
            }
        }
        //
    }
}
//
header("Location: " . SITE_URL_DUM . "rfq2list/$msg");
exit;
?>