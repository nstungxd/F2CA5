<?php

// pr($_POST); exit;
$view = PostVar('view');
$iBidId = PostVar('iBidId');
$iAwardId = PostVar('iAwardId');

if (!isset($r2bdObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/" . "class.Rfq2Bids.php");
    $r2bdObj = new Rfq2Bids();
}
if (!isset($r2awObj)) {
    include_once(SITE_CLASS_APPLICATION . "user/" . "class.Rfq2Award.php");
    $r2awObj = new Rfq2Award();
}
if (!isset($rfq2Obj)) {
    include_once(SITE_CLASS_APPLICATION . "user/class.RFQ2Master.php");
    $rfq2Obj = new RFQ2Master();
}
if (!isset($orgObj)) {
    include_once(SITE_CLASS_APPLICATION . 'user/class.Organization.php');
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

$sacpt = 'n';
if (trim(strtolower($view)) == 'award' || trim(strtolower($view)) == 'save') {
    $dtls = $r2bdObj->select($iBidId);
    if (is_array($dtls) && count($dtls) > 0 && isset($dtls[0]['iBidId']) && $dtls[0]['iBidId'] > 0) {
        $data['iBidId'] = $iBidId;
        $data['iRFQ2Id'] = $dtls[0]['iRFQ2Id'];
        $data['eOrgCreatedBy'] = $orgtyp = $rfq2Obj->getR2InvOrgType($curORGID, $dtls[0]['iRFQ2Id']);
        $data['iCreatedById'] = $sess_id;
        $data['iModifiedById'] = $sess_id;
        $data['dADate'] = calcGTzTime(date("Y-m-d H:i:s"), 'Y-m-d H:i:s');
        if (trim(strtolower($view)) == 'save') {
            $data['eSaved'] = 'Yes';
        } else {
            $data['eSaved'] = 'No';
        }
        $data['eDelete'] = 'No';
        $csts = $statusmasterObj->getDetails('*', " AND vForAuction LIKE '%RFQ2 Award,%' AND vStatus_en='Create' ");
        $vsts = $statusmasterObj->getDetails('*', " AND vForAuction LIKE '%RFQ2 Award,%' AND vStatus_en='Verify' ");
        $asts = $statusmasterObj->getDetails('*', " AND vForAuction LIKE '%RFQ2 Award,%' AND vStatus_en='Auth3' ");
        $orglsts = $orgprefObj->getLastOrgPrefFor($curORGID, "vRFQ2AwardStatusLevel", $asts[0]['iStatusID']);
        $vreq = $orgprefObj->getDetails('eRFQ2AwardVerifyReq', " AND iOrganizationID=$orgid ");
        //pr($vreq); exit;
        if ((isset($vreq[0]['eRFQ2AwardVerifyReq']) && $vreq[0]['eRFQ2AwardVerifyReq'] == 'Yes') || $data['eSaved'] == "Yes") {    // || $orglsts>$vsts[0]['iStatusID']
            $data['iStatusID'] = $csts[0]['iStatusID'];
        } else {
            $data['iStatusID'] = $vsts[0]['iStatusID'];
        }
        //exit;
        $data['iaStatusID'] = '0';
        $data['vAwardNum'] = $r2awObj->getUniqueCode();
        //pr($data); exit;
        // chk for award exists
        if ($iAwardId > 0 && $iAwardId != "") {
            $data['eSaved'] = "No";
            $res = $id = $r2awObj->updateData($data, ' iAwardId = "' . $iAwardId . '" ');
        } else {
            $res = $id = $r2awObj->insert($data);            
        }
        if ($res) {
            $msg = "ras";
            if ($data['iStatusID'] == $asts[0]['iStatusID']) {
                $sacpt = 'y';
            }
        } else {
            $msg = "raer";
        }
    } else {
        $msg = "raer";
    }
    //
} else if (trim(strtolower($view)) == 'reject') {
    $dtls = $r2bdObj->select($iBidId);
    if (is_array($dtls) && count($dtls) > 0 && isset($dtls[0]['iBidId']) && $dtls[0]['iBidId'] > 0 && isset($dtls[0]['iRFQ2Id']) && $dtls[0]['iRFQ2Id'] > 0) {
        $rsts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE 'RFQ2,%' AND vStatus_en='Rejected' ");
        $ur2dt['iStatusID'] = $rsts[0]['iStatusID'];
        $ur2dt['iRejectedById'] = $sess_id;
        $ur2dt['eAuctionStatus'] = 'Cancelled';
        $res = $rfq2Obj->updateData($ur2dt, " iRFQ2Id='" . $dtls[0]['iRFQ2Id'] . "'");
        if ($res) {
            $msg = "rrs";
        } else {
            $msg = 'rrer';
        }
    } else {
        $msg = 'rrer';
    }
}
if (trim(strtolower($view)) == 'award') {
    //
    $jtbl = " LEFT JOIN " . PRJ_DB_PREFIX . "_status_master sm on r2bd.iStatusID=sm.iStatusID
					LEFT JOIN " . PRJ_DB_PREFIX . "_rfq2_master rfq2 on r2bd.iRFQ2Id=rfq2.iRFQ2Id ";
    $where .= " AND r2bd.iBidId=$iBidId ";
    $fields = " r2bd.*, rfq2.*, sm.vStatus_en as vStatus, r2bd.eSaved ";
    $dtls = $r2bdObj->getJoinTableInfo($jtbl, $fields, $where, '', '', '', '');
    //    
    if ($sacpt == 'y') {
        //
        $db_email = $emailObj->getDetails('*', " AND vType='New RFQ2 Award' AND eSection='Member' ");
        $orgdtls = $orgObj->select($dtls[0]['iOrganizationID']);
        $link = SITE_URL . "b2rfq2awardview/" . $id;
        $body_arr = Array("#CREATED_BY#", "#RFQ2CODE#", "#BIDNUM#", "#ADVANCE#", "#PRICE#", "#LINK#");
        $post = Array($orgdtls[0]['vCompanyName'] . '(' . $orgdtls[0]['vOrganizationCode'] . ')', $dtls[0]['vRFQ2Code'], $dtls[0]['vBidNum'], $dtls[0]['fBidAdvanceTotal'], $dtls[0]['fBidPriceTotal'], $link);

        $rplarr = Array("Hello #NAME#,", "background-color: rgb(239, 239, 239);", "Regards,", "#MAIL_FOOTER#", "#SITE_URL#");
        $tbody_en = str_replace($rplarr, " ", $db_email[0]['tBody_en']);
        $emailContent_en = trim(str_replace($body, $post, $tbody_en));
        $tbody_fr = str_replace($rplarr, " ", $db_email[0]['tBody_fr']);
        $emailContent_fr = trim(str_replace($body, $post, $tbody_fr));

        $dt = array();
        $dt['iItemID'] = $id;
        $dt['iOrganizationID'] = $dtls[0]['iBuyer2Id'];
        $dt['vMailSubject_en'] = $db_email[0]['vSub_en'];
        $dt['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
        $dt['tMailContent_en'] = $emailContent_en;
        $dt['tMailContent_fr'] = $emailContent_fr;
        $dt['eSubject'] = "RFQ2 Award";
        $dt['eType'] = 'Create';
        $dt['iCreatedBy'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'];
        $dt['eCreatedType'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_USER_TYPE_SHORT'];
        $dt['dActionDate'] = calcGTzTime(date("Y-m-d H:i:s"), 'Y-m-d H:i:s');
        $userActionObj->setAllVar($dt);
        $userActionObj->insert();
        //
        $emailArr = array();
        $sts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE '%RFQ2 Award,%' AND vStatus_en='Create' ");
        $csts = $sts[0]['iStatusID'];
        $emailArr = $orgUsrObj->getPermittedUsers($dtls[0]['iBuyer2Id'], "$csts%", '', 'vRFQ2AwardPermits', " AND ou.eEmailNotification='Yes' AND ou.eStatus='Active' AND ou.iUserID != '" . $sess_id . "' ");
        $body_arr = Array("#NAME#", "#CREATED_BY#", "#RFQ2CODE#", "#BIDNUM#", "#ADVANCE#", "#PRICE#", "#LINK#", "#MAIL_FOOTER#", "#SITE_URL#");
        if ((is_array($emailArr) && count($emailArr) > 0)) {
            for ($i = 0; $i < count($emailArr); $i++) {
                $smname = $emailArr[$i]['vFirstName'] . ' ' . $emailArr[$i]['vLastName'];
                $email = $emailArr[$i]['vEmail'];
                $post_arr = Array($orgdtls[0]['vCompanyName'] . '(' . $orgdtls[0]['vOrganizationCode'] . ')', $dtls[0]['vRFQ2Code'], $dtls[0]['vBidNum'], $dtls[0]['fBidAdvanceTotal'], $dtls[0]['fBidPriceTotal'], $link, $MAIL_FOOTER, SITE_URL);
                $sendMail->Send("New RFQ2 Award", "Member", $email, $body_arr, $post_arr);
            }
        }
        //
    } else {
        //
        $db_email = $emailObj->getDetails('*', " AND vType='New RFQ2 Award' AND eSection='Member' ");
        $jtbl = " LEFT JOIN " . PRJ_DB_PREFIX . "_status_master sm on r2bd.iStatusID=sm.iStatusID
					LEFT JOIN " . PRJ_DB_PREFIX . "_rfq2_master rfq2 on r2bd.iRFQ2Id=rfq2.iRFQ2Id ";
        $where .= " AND r2bd.iBidId=$iBidId ";
        $fields = " r2bd.*, rfq2.*, sm.vStatus_en as vStatus, r2bd.eSaved ";
        $dtls = $r2bdObj->getJoinTableInfo($jtbl, $fields, $where, '', '', '', '');
        //
        $link = SITE_URL . "rfq2awardview/" . $dtls[0]['iRFQ2Id'];
        $body_arr = Array("#CREATED_BY#", "#RFQ2CODE#", "#ADVANCE#", "#PRICE#", "#LINK#");
        $post = Array($sess_user_name . "($sess_usertype_short)", $dtls[0]['vRFQ2Code'], $dtls[0]['vBidNum'], $dtls[0]['fBidAdvanceTotal'], $dtls[0]['fBidPriceTotal'], $link);

        $rplarr = Array("Hello #NAME#,", "background-color: rgb(239, 239, 239);", "Regards,", "#MAIL_FOOTER#", "#SITE_URL#");
        $tbody_en = str_replace($rplarr, " ", $db_email[0]['tBody_en']);
        $emailContent_en = trim(str_replace($body, $post, $tbody_en));
        $tbody_fr = str_replace($rplarr, " ", $db_email[0]['tBody_fr']);
        $emailContent_fr = trim(str_replace($body, $post, $tbody_fr));

        $dt = array();
        $dt['iItemID'] = $id;
        $dt['iOrganizationID'] = $dtls[0]['iOrganizationID'];
        $dt['vMailSubject_en'] = $db_email[0]['vSub_en'];
        $dt['vMailSubject_fr'] = $db_email[0]['vSub_fr'];
        $dt['tMailContent_en'] = $emailContent_en;
        $dt['tMailContent_fr'] = $emailContent_fr;
        $dt['eSubject'] = "RFQ2 Award";
        $dt['eType'] = 'Create';
        $dt['iCreatedBy'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ID'];
        $dt['eCreatedType'] = $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_USER_TYPE_SHORT'];
        $dt['dActionDate'] = calcGTzTime(date("Y-m-d H:i:s"), 'Y-m-d H:i:s');
        $userActionObj->setAllVar($dt);
        $userActionObj->insert();
        //
        $vreq_mail = $orgprefObj->getDetails('eRFQ2AwardVerifyReq', " AND iOrganizationID= '" . $dtls[0]['iOrganizationID'] . "'");

        if ($vreq_mail[0]['eRFQ2AwardVerifyReq'] == "Yes") {
            $emailArr = array();
            $sts = $statusmasterObj->getDetails('iStatusID', " AND vForAuction LIKE '%RFQ2 Award,%' AND vStatus_en='Verify' ");
            $csts = $sts[0]['iStatusID'];
            $emailArr = $orgUsrObj->getPermittedUsers($dtls[0]['iOrganizationID'], "$csts%", '', 'vRFQ2AwardPermits', " AND ou.eEmailNotification='Yes' AND ou.eStatus='Active' AND ou.iUserID != '" . $sess_id . "' ");
            $body_arr = Array("#NAME#", "#CREATED_BY#", "#RFQ2CODE#", "#BIDNUM#", "#ADVANCE#", "#PRICE#", "#LINK#", "#MAIL_FOOTER#", "#SITE_URL#");
            if ((is_array($emailArr) && count($emailArr) > 0)) {
                for ($i = 0; $i < count($emailArr); $i++) {
                    $smname = $emailArr[$i]['vFirstName'] . ' ' . $emailArr[$i]['vLastName'];
                    $email = $emailArr[$i]['vEmail'];
                    $post_arr = Array($sess_user_name . "($sess_usertype_short)", $dtls[0]['vRFQ2Code'], $dtls[0]['vBidNum'], $dtls[0]['fBidAdvanceTotal'], $dtls[0]['fBidPriceTotal'], $link, $MAIL_FOOTER, SITE_URL);
                    $sendMail->Send("New RFQ2 Award", "Member", $email, $body_arr, $post_arr);
                }
            }
        }
        //
    }
} else if (trim(strtolower($view)) == 'reject') {
    //
    $jtbl = " LEFT JOIN " . PRJ_DB_PREFIX . "_status_master sm on r2bd.iStatusID=sm.iStatusID
					LEFT JOIN " . PRJ_DB_PREFIX . "_rfq2_master rfq2 on r2bd.iRFQ2Id=rfq2.iRFQ2Id ";
    $where .= " AND r2bd.iBidId=$iBidId ";
    $fields = " r2bd.*, rfq2.*, sm.vStatus_en as vStatus, r2bd.eSaved ";
    $dtls = $r2bdObj->getJoinTableInfo($jtbl, $fields, $where, '', '', '', '');
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
    $dt['dActionDate'] = calcGTzTime(date("Y-m-d H:i:s"), 'Y-m-d H:i:s');
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
            $post_arr = Array($sess_user_name . "($sess_usertype_short)", $dtls[0]['vRFQ2Code'], $dtls[0]['vBidNum'], $dtls[0]['fBidAdvanceTotal'], $dtls[0]['fBidPriceTotal'], $link, $MAIL_FOOTER, SITE_URL);
            $sendMail->Send("RFQ2 Cancelled", "Member", $email, $body_arr, $post_arr);
        }
    }
    $emailArr = $orgUsrObj->getPermittedUsers($dtls[0]['iBuyer2Id'], "$csts%", '', 'vRFQ2BidPermits', " AND ou.eEmailNotification='Yes' AND ou.eStatus='Active' ");
    if ((is_array($emailArr) && count($emailArr) > 0)) {
        for ($i = 0; $i < count($emailArr); $i++) {
            $smname = $emailArr[$i]['vFirstName'] . ' ' . $emailArr[$i]['vLastName'];
            $email = $emailArr[$i]['vEmail'];
            $post_arr = Array($sess_user_name . "($sess_usertype_short)", $dtls[0]['vRFQ2Code'], $dtls[0]['vBidNum'], $dtls[0]['fBidAdvanceTotal'], $dtls[0]['fBidPriceTotal'], $link, $MAIL_FOOTER, SITE_URL);
            $sendMail->Send("RFQ2 Cancelled", "Member", $email, $body_arr, $post_arr);
        }
    }
    //
    header("Location: " . SITE_URL_DUM . "rfq2rlist/$msg");
    exit;
}
//
header("Location: " . SITE_URL_DUM . "rfq2awardlist/$msg");
exit;
?>