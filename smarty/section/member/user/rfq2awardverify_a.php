<?php

$view = PostVar('view');
$iAwardId = PostVar('iAwardId');
if (!($iAwardId > 0 && trim($view) != '')) {
    header("Location: " . SITE_URL_DUM . "rfq2awardlist");
    exit;
}
if (!isset($rfq2awObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.Rfq2Award.php");
    $rfq2awObj = new Rfq2Award();
}
if (!isset($orgObj)) {
    include_once(SITE_CLASS_APPLICATION . 'user/class.Organization.php');
    $orgObj = new Organization();
}
if (!isset($orgprefObj)) {
    include_once(SITE_CLASS_APPLICATION . "organization/class.OrganizationPreference.php");
    $orgprefObj = new OrganizationPreference();
}
if (!isset($orgUserPermObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.OrganizationUserPermission.php");
    $orgUserPermObj = new OrganizationUserPermission();
}
if (!isset($invOrdObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.InvoiceOrderHeading.php");
    $invOrdObj = new InvoiceOrderHeading();
}
if (!isset($purOrdObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.PurchaseOrderHeading.php");
    $purOrdObj = new PurchaseOrderHeading();
}
if (!isset($rfq2Obj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.RFQ2Masterphp");
    $rfq2Obj = new RFQ2Master();
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

// record details before verify
$jtbl = " INNER JOIN " . PRJ_DB_PREFIX . "_rfq2_master rfq2 on r2aw.iRFQ2Id=rfq2.iRFQ2Id
            INNER JOIN " . PRJ_DB_PREFIX . "_rfq2_bids r2bd ON r2bd.iBidId=r2aw.iBidId
            LEFT JOIN " . PRJ_DB_PREFIX . "_inovice_order_heading ih ON rfq2.iInvoiceID=ih.iInvoiceID
                LEFT JOIN " . PRJ_DB_PREFIX . "_purchase_order_heading ph ON rfq2.iPurchaseOrderID=ph.iPurchaseOrderID
				LEFT JOIN " . PRJ_DB_PREFIX . "_status_master sm ON sm.iStatusID=r2aw.iStatusID
				LEFT JOIN " . PRJ_DB_PREFIX . "_organization_master org ON org.iOrganizationID=r2bd.iBuyer2Id";
$where = " AND r2aw.iAwardId=$iAwardId ";
$prv_dtls = $rfq2awObj->getJoinTableInfo($jtbl, " DISTINCT *, IF(rfq2.eFrom = 'Invoice',ih.iBuyerOrganizationID,ph.iBuyerOrganizationID) as iBuyerOrganizationID, IF(rfq2.eFrom = 'Invoice',ih.iSupplierOrganizationID,ph.iSupplierOrganizationID) as iSupplierOrganizationID, IF(rfq2.eFrom = 'Invoice',ih.vCurrency,ph.vCurrency) as vCurrency, r2aw.iAwardId, rfq2.iOrganizationID, org.vCompanyName as vBuyer2, r2aw.iStatusID, r2aw.iaStatusID, sm.vStatus_en as status, sm.vStatus_" . LANG . " as eStatus, r2aw.eSaved, r2aw.eDelete, r2aw.iModifiedById ", "$where", "", "", "", "");

if (!(is_array($prv_dtls) && count($prv_dtls) > 0)) {
    header("Location: " . SITE_URL_DUM . "rfq2awardlist");
    exit;
}

// get next status and check for user permission as per organization
$permitted = 'n';
if ($prv_dtls[0]['iModifiedById'] != $sess_id && $prv_dtls[0]['iOrganizationID'] == $curORGID) {
    $rfq2vp = $orgUserPermObj->getUserR2Permits($sess_id, "%RFQ2 Award,%", "vRFQ2AwardPermits");
    $onp = $orgprefObj->getNextStatus($curORGID, $prv_dtls[0]['iStatusID'], "vRFQ2AwardStatusLevel", 'y');
    $nsts = key($onp);
    #if($prv_dtls[0]['iStatusID'] == $asts) { $vreq = 'n'; }
    if (isset($rfq2vp[$onp[$nsts]]) && $rfq2vp[$onp[$nsts]] == 'y') {
        $permitted = 'y';
    }
} else if ($prv_dtls[0]['iModifiedById'] != $sess_id && $prv_dtls[0]['iBuyer2Id'] == $curORGID) {
    $rfq2vp = $orgUserPermObj->getUserR2Permits($sess_id, "%RFQ2 Award,%", "vRFQ2AwardAcceptPermits");
    if ($prv_dtls[0]['iaStatusID'] == 0) {
        $acpt_sts = $statusmasterObj->getDetails('*', " AND vForAuction LIKE '%RFQ2 Award,%' AND vStatus_en='Accepted' ");
        $acpt_sts = $acpt_sts[0]['iStatusID'];
        $onp[$acpt_sts] = 'Accepted';
        $nsts = key($onp);
        if (isset($rfq2vp[$onp[$nsts]]) && $rfq2vp[$onp[$nsts]] == 'y') {
            $permitted = 'y';
        }
        //
        $onp = $orgprefObj->getNextStatus($curORGID, $prv_dtls[0]['iaStatusID'], "vRFQ2AwardAcceptLevel", 'y');
        $nsts = key($onp);
    } else {
        $onp = $orgprefObj->getNextStatus($curORGID, $prv_dtls[0]['iaStatusID'], "vRFQ2AwardAcceptLevel", 'y');
        $nsts = key($onp);
        if (isset($rfq2vp[$onp[$nsts]]) && $rfq2vp[$onp[$nsts]] == 'y') {
            $permitted = 'y';
        }
    }
    // $nsts = key($onp);
    // if(isset($rfq2vp[$onp[$nsts]]) && $rfq2vp[$onp[$nsts]]=='y') { $permitted = 'y'; }
} else if ($prv_dtls[0]['iOrganizationID'] != $curORGID && $prv_dtls[0]['iBuyer2Id'] != $curORGID) {
    header("Location: " . SITE_URL_DUM . "rfq2awardlist");
    exit;
}

if ($permitted != 'y') {
    header("Location: " . SITE_URL_DUM . "rfq2awardlist");
    exit;
}

$a3sts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE '%RFQ2 Award,%' AND vStatus_en='Auth3' ");
if ($prv_dtls[0]['iBuyer2Id'] == $curORGID && $prv_dtls[0]['iStatusID'] != $a3sts[0]['iStatusID']) {
    header("Location: " . SITE_URL_DUM . "b2rfq2awardlist");
    exit;
}

if ($view == 'verify') {
    if (trim($nsts) == '' || $nsts < 1) {
        if ($prv_dtls[0]['iOrganizationID'] == $curORGID) {
            $asts = $a3sts;
        } else if ($prv_dtls[0]['iBuyer2Id'] == $curORGID) {
            $asts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE '%RFQ2 Award,%' AND vStatus_en='Accepted' ");
        }
        $nsts = $asts[0]['iStatusID'];
    }
    if ($prv_dtls[0]['iOrganizationID'] == $curORGID) {
        $data['iStatusID'] = $nsts;
        $data['iaStatusID'] = 0;
        $nxtp = $orgprefObj->getNextStatus($curORGID, $nsts, "vRFQ2AwardStatusLevel", 'y');
    } else if ($prv_dtls[0]['iBuyer2Id'] == $curORGID) {
        $data['iaStatusID'] = $nsts;
        $nxtp = $orgprefObj->getNextStatus($curORGID, $nsts, "vRFQ2AwardAcceptLevel", 'y');
    }
    $nstatus = $statusmasterObj->select($nsts);
    $nxtk = key($nxtp);
    //
    if ($prv_dtls[0]['iBuyer2Id'] == $curORGID) {
        $acpt_sts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE '%RFQ2 Award,%' AND vStatus_en='Accepted' ");
        $alsts = $orgprefObj->getLastOrgPrefFor($curORGID, 'vRFQ2AwardAcceptLevel', $acpt_sts[0]['iStatusID']);
        if ($data['iaStatusID'] == $alsts) {
            $data['iStatusID'] = $data['iaStatusID'] = $acpt_sts[0]['iStatusID'];
        }
        // get org awacpt last sts
    }

    $data['iModifiedById'] = $sess_id;
    $data['iVerifiedById'] = $sess_id;
    $asts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE '%RFQ2 Award,%' AND vStatus_en='Accepted' ");
    if ($data['iaStatusID'] == $asts[0]['iStatusID']) {
        $data['iStatusID'] = $asts[0]['iStatusID'];
    }
//	pr($data);
//	pr($nsts);
//	pr($nxtk); exit;
    $res = $rfq2awObj->updateData($data," iAwardId=$iAwardId ");
    //
    if ($res) {
        $msg = 'rvs';
        //
        // if($nstatus[0]['vStatus_en']!='Auth3' && $nstatus[0]['vStatus_en']!='Accepted')
        // {
        $db_email = $emailObj->getDetails('*', " AND vType='RFQ2 Award Status Changed' AND eSection='Member' ");
        $link = SITE_URL . "rfq2awardview/" . $iAwardId;
        $body_arr = Array("#MODIFIED_BY#", "#RFQ2CODE#", "#BIDNUM#", "#ADVANCE#", "#PRICE#", "#LINK#");
        $post = Array($sess_user_name . "($sess_usertype_short)", $prv_dtls[0]['vRFQ2Code'], $prv_dtls[0]['vBidNum'], $prv_dtls[0]['fBidAdvanceTotal'], $prv_dtls[0]['fBidPriceTotal'], $link);

        $rplarr = Array("Hello #NAME#,", "background-color: rgb(239, 239, 239);", "Regards,", "#MAIL_FOOTER#", "#SITE_URL#");
        $tbody_en = str_replace($rplarr, " ", $db_email[0]['tBody_en']);
        $emailContent_en = trim(str_replace($body, $post, $tbody_en));
        $tbody_fr = str_replace($rplarr, " ", $db_email[0]['tBody_fr']);
        $emailContent_fr = trim(str_replace($body, $post, $tbody_fr));

        $dt = array();
        $dt['iItemID'] = $iAwardId;
        $dt['iOrganizationID'] = $curORGID;
        $dt['vMailSubject_en'] = $db_email[0]['vSub_en'];
        $dt['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
        $dt['tMailContent_en'] = $emailContent_en;
        $dt['tMailContent_fr'] = $emailContent_fr;
        $dt['eSubject'] = "RFQ2 Award";
        $dt['eType'] = 'Modified';
        $dt['vAction'] = 'Status Changed';
        $dt['iCreatedBy'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'];
        $dt['eCreatedType'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_USER_TYPE_SHORT'];
        $dt['dActionDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
        $userActionObj->setAllVar($dt);
        $userActionObj->insert();
        //
        $emailArr = array(); //
        $sts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE '%RFQ2 Award,%' AND vStatus_en='" . $nxtp[$nxtk] . "' ");
        $csts = $sts[0]['iStatusID'];
        $emailArr = $orgUsrObj->getPermittedUsers($curORGID, "%$csts%", '', 'vRFQ2AwardPermits', " AND ou.eEmailNotification='Yes' AND ou.eStatus='Active' ");
        $body_arr = Array("#NAME#", "#MODIFIED_BY#", "#RFQ2CODE#", "#BIDNUM#", "#ADVANCE#", "#PRICE#", "#LINK#", "#MAIL_FOOTER#", "#SITE_URL#");
        if ((is_array($emailArr) && count($emailArr) > 0)) {
            for ($i = 0; $i < count($emailArr); $i++) {
                $smname = $emailArr[$i]['vFirstName'] . ' ' . $emailArr[$i]['vLastName'];
                $email = $emailArr[$i]['vEmail'];
                $post_arr = Array($smname, $sess_user_name . "($sess_usertype_short)", $prv_dtls[0]['vRFQ2Code'], $prv_dtls[0]['vBidNum'], $prv_dtls[0]['fBidAdvanceTotal'], $prv_dtls[0]['fBidPriceTotal'], $link, $MAIL_FOOTER, SITE_URL);
                $sendMail->Send("RFQ2 Award Status Changed", "Member", $email, $body_arr, $post_arr);
            }
        }
        // }
        // else
        if ($nstatus[0]['vStatus_en'] == 'Auth3' || $nstatus[0]['vStatus_en'] == 'Accepted') {
            if ($nstatus[0]['vStatus_en'] == 'Auth3' && $data['iStatusID'] != $asts[0]['iStatusID']) {
                $db_email = $emailObj->getDetails('*', " AND vType='New RFQ2 Award' AND eSection='Member' ");
                $oth_org = $orgObj->select($prv_dtls[0]['iOrganizationID']);
                $link = SITE_URL . "b2rfq2awardview/" . $iAwardId;
                $body_arr = Array("#BY#", "#RFQ2CODE#", "#BIDNUM#", "#ADVANCE#", "#PRICE#", "#LINK#");
                $post = Array($oth_org[0]['vCompanyName'] . '(' . $oth_org[0]['vOrganizationCode'] . ')', $prv_dtls[0]['vRFQ2Code'], $prv_dtls[0]['vBidNum'], $prv_dtls[0]['fBidAdvanceTotal'], $prv_dtls[0]['fBidPriceTotal'], $link);

                $rplarr = Array("Hello #NAME#,", "background-color: rgb(239, 239, 239);", "Regards,", "#MAIL_FOOTER#", "#SITE_URL#");
                $tbody_en = str_replace($rplarr, " ", $db_email[0]['tBody_en']);
                $emailContent_en = trim(str_replace($body, $post, $tbody_en));
                $tbody_fr = str_replace($rplarr, " ", $db_email[0]['tBody_fr']);
                $emailContent_fr = trim(str_replace($body, $post, $tbody_fr));

                $dt = array();
                $dt['iItemID'] = $iAwardId;
                $dt['iOrganizationID'] = $prv_dtls[0]['iBuyer2Id'];
                $dt['vMailSubject_en'] = $db_email[0]['vSub_en'];
                $dt['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
                $dt['tMailContent_en'] = $emailContent_en;
                $dt['tMailContent_fr'] = $emailContent_fr;
                $dt['eSubject'] = "RFQ2 Award";
                $dt['eType'] = 'Create';
                $dt['vAction'] = 'Create';
                $dt['iCreatedBy'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'];
                $dt['eCreatedType'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_USER_TYPE_SHORT'];
                $dt['dActionDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
                $userActionObj->setAllVar($dt);
                $userActionObj->insert();
                //
                $emailArr = array(); //
                $sts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE '%RFQ2 Award,%' AND vStatus_en='Accepted' ");
                $acsts = $sts[0]['iStatusID'];
                $emailArr = $orgUsrObj->getPermittedUsers($prv_dtls[0]['iBuyer2Id'], "%$acsts%", '', 'vRFQ2AwardPermits', " AND ou.eEmailNotification='Yes' AND ou.eStatus='Active' ");
                $body_arr = Array("#NAME#", "#BY#", "#RFQ2CODE#", "#BIDNUM#", "#ADVANCE#", "#PRICE#", "#LINK#", "#MAIL_FOOTER#", "#SITE_URL#");
                if ((is_array($emailArr) && count($emailArr) > 0)) {
                    for ($i = 0; $i < count($emailArr); $i++) {
                        $smname = $emailArr[$i]['vFirstName'] . ' ' . $emailArr[$i]['vLastName'];
                        $email = $emailArr[$i]['vEmail'];
                        $post_arr = Array($smname, $oth_org[0]['vCompanyName'] . '(' . $oth_org[0]['vOrganizationCode'] . ')', $prv_dtls[0]['vRFQ2Code'], $prv_dtls[0]['vBidNum'], $prv_dtls[0]['fBidAdvanceTotal'], $prv_dtls[0]['fBidPriceTotal'], $link, $MAIL_FOOTER, SITE_URL);
                        $sendMail->Send("New RFQ2 Award", "Member", $email, $body_arr, $post_arr);
                    }
                }
                //
            } else if ($nstatus[0]['vStatus_en'] == 'Accepted' || $data['iStatusID'] == $asts[0]['iStatusID']) {
                //
                if (!isset($rfq2extractObj)) {
                    include_once(SITE_CLASS_APPLICATION . "user/class.RFQ2Extract.php");
                    $rfq2extractObj = new RFQ2Extract();
                }
                $redtl = array('iRFQ2Id' => $prv_dtls[0]['iRFQ2Id'], 'iBuyer2Id' => $prv_dtls[0]['iBuyer2Id'], 'iBuyerId' => $prv_dtls[0]['iBuyerOrganizationId'], 'iSupplierId' => $prv_dtls[0]['iSupplierOrganizationId'], 'iInvoiceID' => $prv_dtls[0]['iInvoiceID'], 'vCurrency' => $prv_dtls[0]['vCurrency'], 'dReviewDate' => date('Y-m-d', strtotime("+5 day", strtotime(date('Y-m-d')))));
                $re = $rfq2extractObj->insert($redtl);
                //
                $db_email = $emailObj->getDetails('*', " AND vType='RFQ2 Award Accepted' AND eSection='Member' ");
                $oth_org = $orgObj->select($prv_dtls[0]['iBuyer2Id']);
                $link = SITE_URL . "rfq2awardview/" . $iAwardId;
                $body_arr = Array("#BY#", "#RFQ2CODE#", "#BIDNUM#", "#ADVANCE#", "#PRICE#", "#LINK#");
                $post = Array($oth_org[0]['vCompanyName'] . '(' . $oth_org[0]['vOrganizationCode'] . ')', $prv_dtls[0]['vRFQ2Code'], $prv_dtls[0]['vBidNum'], $prv_dtls[0]['fBidAdvanceTotal'], $prv_dtls[0]['fBidPriceTotal'], $link);

                $rplarr = Array("Hello #NAME#,", "background-color: rgb(239, 239, 239);", "Regards,", "#MAIL_FOOTER#", "#SITE_URL#");
                $tbody_en = str_replace($rplarr, " ", $db_email[0]['tBody_en']);
                $emailContent_en = trim(str_replace($body, $post, $tbody_en));
                $tbody_fr = str_replace($rplarr, " ", $db_email[0]['tBody_fr']);
                $emailContent_fr = trim(str_replace($body, $post, $tbody_fr));

                $dt = array();
                $dt['iItemID'] = $iAwardId;
                $dt['iOrganizationID'] = $prv_dtls[0]['iOrganizationID'];
                $dt['vMailSubject_en'] = $db_email[0]['vSub_en'];
                $dt['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
                $dt['tMailContent_en'] = $emailContent_en;
                $dt['tMailContent_fr'] = $emailContent_fr;
                $dt['eSubject'] = "RFQ2 Award";
                $dt['eType'] = 'Modified';
                $dt['vAction'] = 'Accepted';
                $dt['iCreatedBy'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'];
                $dt['eCreatedType'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_USER_TYPE_SHORT'];
                $dt['dActionDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
                $userActionObj->setAllVar($dt);
                $userActionObj->insert();
                //
                $emailArr = array(); //
                $sts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE '%RFQ2 Award,%' AND vStatus_en='Create' ");
                $csts = $sts[0]['iStatusID'];
                $emailArr = $orgUsrObj->getPermittedUsers($prv_dtls[0]['iOrganizationID'], "$csts%", '', 'vRFQ2AwardPermits', " AND ou.eEmailNotification='Yes' AND ou.eStatus='Active' ");
                $body_arr = Array("#NAME#", "#BY#", "#RFQ2CODE#", "#BIDNUM#", "#ADVANCE#", "#PRICE#", "#LINK#", "#MAIL_FOOTER#", "#SITE_URL#");
                if ((is_array($emailArr) && count($emailArr) > 0)) {
                    for ($i = 0; $i < count($emailArr); $i++) {
                        $smname = $emailArr[$i]['vFirstName'] . ' ' . $emailArr[$i]['vLastName'];
                        $email = $emailArr[$i]['vEmail'];
                        $post_arr = Array($smname, $oth_org[0]['vCompanyName'] . '(' . $oth_org[0]['vOrganizationCode'] . ')', $prv_dtls[0]['vRFQ2Code'], $prv_dtls[0]['vBidNum'], $prv_dtls[0]['fBidAdvanceTotal'], $prv_dtls[0]['fBidPriceTotal'], $link, $MAIL_FOOTER, SITE_URL);
                        $sendMail->Send("RFQ2 Award Accepted", "Member", $email, $body_arr, $post_arr);
                    }
                }
                //
                if ($prv_dtls[0]['eFrom'] == "Invoice") {
                    $ress = $invOrdObj->updateData(array('eRfq2Awarded' => 'Yes'), " iInvoiceID=" . $prv_dtls[0]['iInvoiceID'] . " ");
                } else if ($prv_dtls[0]['eFrom'] == "PO") {
                    $ress = $purOrdObj->updateData(array('eRfq2Awarded' => 'Yes'), " iPurchaseOrderID=" . $prv_dtls[0]['iPurchaseOrderID'] . " ");
                    if ($prv_dtls[0]['iPurchaseOrderID'] != "0" && $prv_dtls[0]['iPurchaseOrderID'] != "") {
                        $inv_det = $invOrdObj->getDetails('*', " AND iPurchaseOrderID = '" . $prv_dtls[0]['iPurchaseOrderID'] . "' ");
                        $rfq2_dets = $rfq2Obj->getDetails('*', " AND iInvoiceID = '" . $inv_det[0]['iInvoiceID'] . "' ");
                        if (count($rfq2_dets) > 0) {
                            $rfq2_dtls['fPOAwardAdvace'] = $prv_dtls[0]['fBidAdvanceTotal'];
                            $rfq2_dtls['fPOAwardPrice'] = $prv_dtls[0]['fBidPriceTotal'];
                            $rfq2_dtls['fPOAwardAmount'] = $prv_dtls[0]['fBidAmount'];
                            $ress = $rfq2Obj->updateData($rfq2_dtls, " iRFQ2Id=" . $prv_dtls[0]['iRFQ2Id'] . " ");
                        }
                    }
                }
            }
        }
    } else {
        $msg = 'rver';
    }
} else if ($view == 'reject') {
    $rsts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE '%RFQ2 Award,%' AND vStatus_en='Rejected' ");
    $nsts = $rsts[0]['iStatusID'];
    $data['iStatusID'] = $rsts[0]['iStatusID'];
    $data['iaStatusID'] = $rsts[0]['iStatusID'];
    $res = $rfq2awObj->updateData($data, " iAwardId=$iAwardId ");
    //
    if ($res) {
        $msg = 'rrs';
        //
        if ($prv_dtls[0]['iOrganizationID'] == $curORGID) {
            $link = SITE_URL . "rfq2awardview/" . $iAwardId;
        } else if ($prv_dtls[0]['iBuyer2Id'] == $curORGID) {
            $link = SITE_URL . "b2rfq2awardview/" . $iAwardId;
        }
        // if($prv_dtls[0]['iBuyer2Id']==$curORGID) {
        // $oth_org[0]['vCompanyName'].'('.$oth_org[0]['vOrganizationCode'].')'
        // }
        $db_email = $emailObj->getDetails('*', " AND vType='RFQ2 Award Accepted' AND eSection='Member' ");
        $body_arr = Array("#REJECTED_BY#", "#RFQ2CODE#", "#BIDNUM#", "#ADVANCE#", "#PRICE#", "#LINK#");
        $post = Array($sess_user_name . "($sess_usertype_short)", $prv_dtls[0]['vRFQ2Code'], $prv_dtls[0]['vBidNum'], $prv_dtls[0]['fBidAdvanceTotal'], $prv_dtls[0]['fBidPriceTotal'], $link);

        $rplarr = Array("Hello #NAME#,", "background-color: rgb(239, 239, 239);", "Regards,", "#MAIL_FOOTER#", "#SITE_URL#");
        $tbody_en = str_replace($rplarr, " ", $db_email[0]['tBody_en']);
        $emailContent_en = trim(str_replace($body, $post, $tbody_en));
        $tbody_fr = str_replace($rplarr, " ", $db_email[0]['tBody_fr']);
        $emailContent_fr = trim(str_replace($body, $post, $tbody_fr));

        $dt = array();
        $dt['iItemID'] = $iAwardId;
        $dt['iOrganizationID'] = $curORGID;
        $dt['vMailSubject_en'] = $db_email[0]['vSub_en'];
        $dt['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
        $dt['tMailContent_en'] = $emailContent_en;
        $dt['tMailContent_fr'] = $emailContent_fr;
        $dt['eSubject'] = "RFQ2 Award";
        $dt['eType'] = 'Rejected';
        $dt['vAction'] = 'Rejected';
        $dt['iCreatedBy'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'];
        $dt['eCreatedType'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_USER_TYPE_SHORT'];
        $dt['dActionDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
        $userActionObj->setAllVar($dt);
        $userActionObj->insert();
        //
        $emailArr = array(); //
        $sts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE '%RFQ2 Award,%' AND vStatus_en='Create' ");
        $csts = $sts[0]['iStatusID'];
        $emailArr = $orgUsrObj->getPermittedUsers($curORGID, "$csts%", '', 'vRFQ2AwardPermits', " AND ou.eEmailNotification='Yes' AND ou.eStatus='Active' ");
        $body_arr = Array("#NAME#", "#REJECTED_BY#", "#RFQ2CODE#", "#BIDNUM#", "#ADVANCE#", "#PRICE#", "#LINK#", "#MAIL_FOOTER#", "#SITE_URL#");
        if ((is_array($emailArr) && count($emailArr) > 0)) {
            for ($i = 0; $i < count($emailArr); $i++) {
                $smname = $emailArr[$i]['vFirstName'] . ' ' . $emailArr[$i]['vLastName'];
                $email = $emailArr[$i]['vEmail'];
                $post_arr = Array($smname, $sess_user_name . "($sess_usertype_short)", $prv_dtls[0]['vRFQ2Code'], $prv_dtls[0]['vBidNum'], $prv_dtls[0]['fBidAdvanceTotal'], $prv_dtls[0]['fBidPriceTotal'], $link, $MAIL_FOOTER, SITE_URL);
                $sendMail->Send("RFQ2 Award Rejected", "Member", $email, $body_arr, $post_arr);
            }
        }
        //
        if ($prv_dtls[0]['iBuyer2Id'] == $curORGID) {
            $oth_org = $orgObj->select($prv_dtls[0]['iBuyer2Id']);
            $link = SITE_URL . "rfq2awardview/" . $iAwardId;
            $body_arr = Array("#REJECTED_BY#", "#RFQ2CODE#", "#BIDNUM#", "#ADVANCE#", "#PRICE#", "#LINK#");
            $post = Array($oth_org[0]['vCompanyName'] . '(' . $oth_org[0]['vOrganizationCode'] . ')', $prv_dtls[0]['vRFQ2Code'], $prv_dtls[0]['vBidNum'], $prv_dtls[0]['fBidAdvanceTotal'], $prv_dtls[0]['fBidPriceTotal'], $link);

            $rplarr = Array("Hello #NAME#,", "background-color: rgb(239, 239, 239);", "Regards,", "#MAIL_FOOTER#", "#SITE_URL#");
            $tbody_en = str_replace($rplarr, " ", $db_email[0]['tBody_en']);
            $emailContent_en = trim(str_replace($body, $post, $tbody_en));
            $tbody_fr = str_replace($rplarr, " ", $db_email[0]['tBody_fr']);
            $emailContent_fr = trim(str_replace($body, $post, $tbody_fr));

            $dt = array();
            $dt['iItemID'] = $iAwardId;
            $dt['iOrganizationID'] = $prv_dtls[0]['iOrganizationID'];
            $dt['vMailSubject_en'] = $db_email[0]['vSub_en'];
            $dt['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
            $dt['tMailContent_en'] = $emailContent_en;
            $dt['tMailContent_fr'] = $emailContent_fr;
            $dt['eSubject'] = "RFQ2 Award";
            $dt['eType'] = 'Rejected';
            $dt['vAction'] = 'Rejected';
            $dt['iCreatedBy'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'];
            $dt['eCreatedType'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_USER_TYPE_SHORT'];
            $dt['dActionDate'] = calcGTzTime(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
            $userActionObj->setAllVar($dt);
            $userActionObj->insert();
            //
            $emailArr = array(); //
            $sts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE '%RFQ2 Award,%' AND vStatus_en='Create' ");
            $csts = $sts[0]['iStatusID'];
            $emailArr = $orgUsrObj->getPermittedUsers($prv_dtls[0]['iOrganizationID'], "$csts%", '', 'vRFQ2AwardPermits', " AND ou.eEmailNotification='Yes' AND ou.eStatus='Active' ");
            $body_arr = Array("#NAME#", "#REJECTED_BY#", "#RFQ2CODE#", "#BIDNUM#", "#ADVANCE#", "#PRICE#", "#LINK#", "#MAIL_FOOTER#", "#SITE_URL#");
            if ((is_array($emailArr) && count($emailArr) > 0)) {
                for ($i = 0; $i < count($emailArr); $i++) {
                    $smname = $emailArr[$i]['vFirstName'] . ' ' . $emailArr[$i]['vLastName'];
                    $email = $emailArr[$i]['vEmail'];
                    $post_arr = Array($smname, $oth_org[0]['vCompanyName'] . '(' . $oth_org[0]['vOrganizationCode'] . ')', $prv_dtls[0]['vRFQ2Code'], $prv_dtls[0]['vBidNum'], $prv_dtls[0]['fBidAdvanceTotal'], $prv_dtls[0]['fBidPriceTotal'], $link, $MAIL_FOOTER, SITE_URL);
                    $sendMail->Send("RFQ2 Award Rejected", "Member", $email, $body_arr, $post_arr);
                }
            }
        }
        //
    } else {
        $msg = 'rrer';
    }
}
//
if ($uorg_type != 'Buyer2') {
    header("Location: " . SITE_URL_DUM . "rfq2awardlist/$msg");
} else {
    header("Location: " . SITE_URL_DUM . "b2rfq2awardlist/$msg");
}
//

exit;
?>