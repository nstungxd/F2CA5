<?php

$apgary = array('', 'c-home', 'c-aboutus', 'c-contactus', 'c-privacypolicy', 'c-forgotpass',
    'sm-smdashboard', 'sm-importpurchaseorders', 'sm-editprofile',
    'or-organization', 'or-oadashboard', 'or-organizationlist', 'or-aj_orgoverview', 'or-aj_orgprfoverview',
    'or-aj_assocoverview', 'or-verifyorgpreflist', 'or-aj_verifyorgpreflist', 'or-createorganization', 'or-createorganizationpref',
    'or-organizationview', 'or-organizationprefview', 'or-aj_organizationlist', 'or-createassociation', 'or-associationlist',
    'or-aj_associationlist', 'or-verifyorganization', 'or-aj_verifyorganizationlist', 'or-associationview',
    'or-verifyassociationlist', 'or-aj_verifyassociationlist', 'or-oaview', 'or-oaeditprofile', 'aj_getBuyerOrg',
    'u-user', 'u-oudashboard', 'u-creategroup', 'u-assignrights', 'u-edituserrights', 'u-userrights', 'u-groupview',
    'u-aj_groupoverview', 'u-aj_useroverview', 'u-createorganizationuser', 'u-organizationuserview', 'u-organizationuserlist',
    'u-aj_organizationuserlist', 'u-grouplist', 'u-aj_grouplist', 'u-purchaseorderlist', 'u-purchaseordercreate', 'u-popref',
    'u-poprefview', 'u-purchaseorderadditems', 'u-purchaseorderview', 'u-poviewitems', 'aj_getOrganizationUserStatus',
    'u-verifyorganizationuserlist', 'u-aj_verifyorganizationuserlist', 'u-verifyrights', 'u-aj_verifyrights', 'u-oueditprofile',
    'u-verifygrouplist', 'u-aj_verifygrouplist',
    'm-loginlist', 'm-aj_loginlist', 'm-inbox', 'm-aj_inbox', 'm-inboxdetail', 'm-exportpo', 'm-aj_chkpage', 'm-inetreports', 'm-reportsrpt', 'm-aj_getRptCombos', "m-getinetreports",
    'm-reportsrptpop',
    'u-invoicelist', 'u-invacptlist', 'u-aj_invoicelist', 'u-aj_invacptlist', 'u-invoiceview', 'u-invoiceviewitems', 'u-polist',
    'u-poacptlist', 'u-aj_polist', 'u-aj_poacptlist', 'u-poview', 'u-invoicecreate', 'u-invpref', 'u-invprefview', 'u-invoiceadditems',
    'u-importinvoice', 'u-importpurchaseorders', 'u-listrights', 'u-aj_listrights', 'u-newinvfpo_a', 'm-logout'
);

$anwpgary = array('or-b2bprodtasoc', 'or-b2bprodtasocview', 'or-b2bprodtasoclist', 'or-b2bprodtasocvlist', 'or-aj_b2bprdtassoclist', 'or-b2bprodtasoc_a', 'or-aj_b2bprdtascprv', 'or-aj_b2bprdtassoclist_a', 'or-aj_b2bprdtassovlist',
    'or-b2sprodtasoc', 'or-b2sprodtasocview', 'or-b2sprodtasoclist', 'or-b2sprodtasocvlist', 'or-aj_b2sprdtassoclist', 'or-b2sprodtasoc_a', 'or-aj_b2sprdtascprv', 'or-b2sprdthistory', 'or-aj_b2bprdtassoclist_a', 'or-aj_b2sprdtassocvlist',
    'or-b2buyerasoc', 'or-b2buyerasocview', 'or-b2buyerasoclist', 'or-b2buyerasocvlist',
    'or-b2supplierasoc', 'or-b2supplierasocview', 'or-b2supplierasoclist', 'or-b2supplierasocvlist',
    'or-b2bprodtbasoc', 'or-b2bprodtbasocview', 'or-b2bprdtbasoclist', 'or-b2bprdtbasocvlist',
    'or-b2sprodtsasoc', 'or-b2sprodtsasocview', 'or-b2sprdtsasoclist', 'or-b2sprdtsasocvlist'
);  // or-b2bprdthistory

if (isset($ENABLE_AUCTION) && $ENABLE_AUCTION == 'Yes') {
    $apgary = array_merge($apgary, $anwpgary);
}

if ($sess_usertype == '' || $sess_id == '') {
    $pfary = Array("sm", "or", "u");
    if (in_array($prefix, $pfary)) {
        header("Location: " . SITE_URL_DUM);
        exit;
    }
}

/* else if($sess_id != '' && !in_array($file,$apgary)) {
  //header("Location: ".SITE_URL_DUM."errordocument");
  //exit;
  } */ else if ($sess_usertype == 'securitymanager' && $sess_id != '') {
    /* $sql_chk_sts = "Select eStatus from ".PRJ_DB_PREFIX."_security_manager where iSMID=$sess_id";
      $sts_chk = $dbobj->MySQLSelect($sql_chk_sts);
      if(! isset($sts_chk[0]['eStatus']) || $sts_chk[0]['eStatus']!='Active') {
      header("Location: ".SITE_URL_DUM."logout");
      exit;
      } */
    $pgary = Array("", "c-home", "u-importpurchaseorders", "u-importinvoice", "u-invoicecreate", "u-purchaseordercreate",
        "u-polist", "u-invoicelist", "u-oudashboard", "u-invacptlist", "u-poacptlist", "u-purchaseorderview",
        "u-poviewhistory", "u-poviewitems", "u-invoiceview", "u-invoiceviewhistory", "u-invoiceviewitems",
        "or-oadashboard", "m-reportsrptpop");  // ,"m-inetreports","m-reportsrpt","m-reportsrptpop"

    if (in_array($file, $pgary)) {
        header("Location: " . SITE_URL_DUM . "smdashboard");
        exit;
    } else if (!isset($ENABLE_AUCTION) || $ENABLE_AUCTION != 'Yes') {
        if (in_array($file, $anwpgary)) {
            header("Location: " . SITE_URL_DUM . "smdashboard");
            exit;
        }
    }
} else if ($sess_usertype == 'orgadmin' && $sess_id != '') {
    // echo $file; exit;
    /* $sql_chk_sts = "Select eStatus, eNeedToVerify from ".PRJ_DB_PREFIX."_organization_user where iUserID=$sess_id";
      $sts_chk = $dbobj->MySQLSelect($sql_chk_sts);
      if(! isset($sts_chk[0]['eStatus']) || !($sts_chk[0]['eStatus']=='Active' && $sts_chk[0]['eNeedToVerify']=='No')) {
      header("Location: ".SITE_URL_DUM."logout");
      exit;
      } */
    if (isset($_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ORGTYPE']) && $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ORGTYPE'] == 'Buyer2') {
        $pgary = Array("", "c-home", "u-importpurchaseorders", "u-importinvoice", "u-invoicecreate", "u-purchaseordercreate",
            "or-verifyorganization", "or-organizationlist", "sm-smdashboard", "u-oueditprofile", "u-poacptlist",
            "u-invacptlist", "u-oudashboard", "sm-editprofile", "or-oadashboard");
        //
        if (in_array($file, $pgary)) {
            header("Location: " . SITE_URL_DUM . "b2oadashboard");
            exit;
        } else if (!isset($ENABLE_AUCTION) || $ENABLE_AUCTION != 'Yes') {
            $r2pgary = array('');
            $anwpgary = array_merge($apgary, $r2pgary);
            if (in_array($file, $anwpgary)) {
                header("Location: " . SITE_URL_DUM . "b2oadashboard");
                exit;
            }
        }
    } else {
        $pgary = Array("", "c-home", "u-importpurchaseorders", "u-importinvoice", "u-invoicecreate", "u-purchaseordercreate",
            "or-verifyorganization", "or-organizationlist", "sm-smdashboard", "u-oueditprofile", "u-poacptlist",
            "u-invacptlist", "u-oudashboard", "sm-editprofile");
        if (in_array($file, $pgary)) {
            header("Location: " . SITE_URL_DUM . "oadashboard");
            exit;
        } else if (!isset($ENABLE_AUCTION) || $ENABLE_AUCTION != 'Yes') {
            if (in_array($file, $anwpgary)) {
                header("Location: " . SITE_URL_DUM . "oadashboard");
                exit;
            }
        }
    }
} else if ($sess_usertype == 'orguser' && $sess_id != '') {
    /* $sql_chk_sts = "Select eStatus, eNeedToVerify from ".PRJ_DB_PREFIX."_organization_user where iUserID=$sess_id";
      $sts_chk = $dbobj->MySQLSelect($sql_chk_sts);
      if(! isset($sts_chk[0]['eStatus']) || !($sts_chk[0]['eStatus']=='Active' && $sts_chk[0]['eNeedToVerify']=='No')) {
      header("Location: ".SITE_URL_DUM."logout");
      exit;
      } */
    if (isset($_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ORGTYPE']) && $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_ORGTYPE'] == 'Buyer2') {
        $upgary = Array("u-b2oudashboard",
            "u-oueditprofile", "u-oueditprofile_a", "or-aj_getOrganization", "or-aj_getOrganization", "or-aj_getAssociation", "u-aj_chkdupdata", "u-aj_getUser",
            "m-aj_getDetails", "m-changepass", "m-inboxdetail", "m-inbox", "m-logout", "m-aj_inbox", "m-exportinvoice", "m-exportpo", "m-aj_chkoldpass", "c-aboutus", "c-contactus", "c-privacypolicy", "c-language",
            "m-aj_logoutothers", "u-organizationuserview", "u-orguserviewhistory", "u-aj_useroverview", "m-downloadsample", "m-aj_getCombo", "m-aj_inbox_a", "u-invprefview", "u-poprefview", "m-aj_getOrgBillDetails", "m-aj_chkpage",
            "u-binvoiceocreatefpo", "u-b2oudashboard", "u-b2rfq2list", "u-aj_b2rfq2list", "u-b2rfq2view", "u-invoiceview", "u-invprefview", "u-invoiceviewitems", "u-aj_getrfq2details", "u-rfq2bidhistory", "u-viewsrfq2bid", "u-viewrfq2bidhistory",
            "u-b2rfq2bidlist", "u-aj_b2rfq2bidlist", "u-b2rfq2bidvlist", "u-aj_b2rfq2bidvlist", "u-b2rfq2bidrlist", "u-aj_b2rfq2bidrlist", "u-aj_addwatchlist", "u-b2rfq2watchlist", "u-aj_b2rfq2watchlist", "u-aj_removewatchlist",
            "u-b2rfq2awardlist", "u-aj_b2rfq2awardlist", "u-b2rfq2awardview", "u-viewb2rfq2awardhistory", "u-b2rfq2autobids", 
            "u-purchaseorderview", "u-poprefview", "u-poviewitems"
        );  // ,"m-inetreports","m-reportsrpt","m-aj_getRptCombos","m-getinetreports"
        // 	"u-invoiceview", "u-invoiceviewitems","u-purchaseorderview","u-poviewitems",
        //
        //echo "1"; exit;
        if (!isset($ENABLE_AUCTION) || $ENABLE_AUCTION != 'Yes') {
            if (in_array($file, $upgary)) {
                header("Location: " . SITE_URL_DUM . "logout/ia");
                exit;
            }
        } else {
            if (!in_array($file, $upgary)) {
                header("Location: " . SITE_URL_DUM . "b2oudashboard");
                exit;
            }
        }
        
        /* if(!in_array($file, $upgary)) {
          header("Location: ".SITE_URL_DUM."b2oudashboard");
          exit;
          } else if(!isset($ENABLE_AUCTION) || $ENABLE_AUCTION!='Yes') {
          if(in_array($file, $anwpgary)) {
          header("Location: ".SITE_URL_DUM."logout/ia");
          exit;
          }
          } */
    } else {
        $upgary = Array("u-oudashboard", "u-invoicelist", "u-invacptlist", "u-aj_invacptlist", "u-invoiceview", "u-invoicecreate",
            "u-invoicecreate_a", "u-invoiceadditems_a", "u-aj_invoicelist", "u-invoiceadditems", "u-invoiceviewhistory",
            "u-invoiceviewitems", "u-purchaseorderview", "u-purchaseordercreate", "u-purchaseordercreate_a", "u-poviewitems",
            "u-poacptlist", "u-aj_poacptlist", "u-oueditprofile", "u-oueditprofile_a", "u-importinvoice", "u-polist", "u-aj_polist",
            "u-poviewhistory", "u-aj_getPoInvItem", "u-purchaseorderadditems_a", "u-aj_getInvPo", "or-aj_getOrganization",
            "or-aj_getOrganization", "or-aj_getAssociation", "u-purchaseorderadditems", "u-aj_chkdupdata", "u-aj_getPoInv", "u-aj_getUser",
            "m-aj_getDetails", "m-changepass", "m-inboxdetail", "m-inbox", "m-logout", "m-aj_inbox", "m-exportinvoice", "m-exportpo", "m-importpo", "u-importpurchaseorders",
            "u-importinvoice", "m-importinvoice", "m-aj_chkoldpass", "c-aboutus", "c-contactus", "c-privacypolicy", "c-language", "u-aj_getInvPoItem", "u-aj_getPoInvItem", "m-aj_logoutothers",
            "u-organizationuserview", "u-orguserviewhistory", "u-aj_useroverview", "m-downloadsample", "u-aj_polist_a", "u-aj_invoicelist_a", "m-aj_getCombo", "m-aj_inbox_a", "u-popref", "u-popref_a", "u-invpref", "u-invpref_a", "u-invprefview", "u-poprefview", "m-aj_getOrgBillDetails", "m-aj_chkpage",
            "u-binvoiceocreatefpo", "m-inetreports", "m-reportsrpt", "m-aj_getRptCombos", "m-getinetreports", "m-reportsrptpop", "u-newinvfpo_a"
        );
        //
        $r2pgary = array("u-rfq2create", "u-rfq2list", "u-rfq2vlist", "u-rfq2rlist", "u-rfq2view", "u-aj_rfq2list", "u-aj_rfq2vlist", "u-aj_rfq2rlist", "u-rfq2viewhistory", "u-rfq2bidlist", "u-aj_rfq2bidlist", "u-rfq2bidview", "u-rfq2awardview", "u-rfq2awardlist", "u-aj_rfq2awardlist", "u-viewrfq2awardhistory");
        if (isset($ENABLE_AUCTION) && $ENABLE_AUCTION == 'Yes') {
            $upgary = array_merge($upgary, $r2pgary);
        }
        //
        if (!in_array($file, $upgary)) {
            header("Location: " . SITE_URL_DUM . "oudashboard");
            exit;
        } /* else if(!isset($ENABLE_AUCTION) || $ENABLE_AUCTION!='Yes') {
          if(in_array($file,$anwpgary)) {
          header("Location: ".SITE_URL_DUM."oudashboard");
          exit;
          }
          } */
    }
    /*
      $pgary = Array("","c-home","or-createorganization","or-organizationlist","or-organizationview","or-orgviewhistory",
      "or-verifyorganization","or-verifyorgpreflist","or-createassociation","or-associationlist",
      "or-verifyassociationlist","or-associationview","or-createorganizationpref",
      "u-organizationuserview","u-createorganizationuser","u-organizationuserlist","u-verifyorganizationuserlist",
      "u-assignrights","u-userrights","u-edituserrights","u-creategroup","u-grouplist","u-verifygrouplist",
      "u-orguserviewhistory","u-aj_organizationuserlist","u-aj_verifyorganizationuserlist","sm-smdashboard");
     */
}
include_once(S_SECTIONS . "/member/memberaccess.php");
?>