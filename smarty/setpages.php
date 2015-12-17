<?php
$bodyid = '';
$mdivid = '';
$dvid = '';
$cssfile = 'style.css';
$bodycls = 'theme-whbl  pace-done123';

switch($file)
{

   case '':

        $dvid = 'theme-wrapper';
						$mdivid = 'page-wrapper';
						$cssfile = 'style.css';

        break;
   case 'c-home':
	case 'c-aboutus':
	case 'c-contactus':
	case 'c-privacypolicy':
   case 'c-404error':
	case 'c-forgotpass':
	case 'm-orgregister':
						$dvid = 'main-width';
						break;

   case 'sm-smdashboard':
   case 'sm-importpurchaseorders':
   case 'sm-editprofile':

   case 'or-organization':
	case 'or-oadashboard':
        $dvid = 'theme-wrapper';
						$mdivid = 'page-wrapper';
						$cssfile = '';
        break;
	case 'or-b2oadashboard':
        $dvid = 'theme-wrapper';
						$mdivid = 'page-wrapper';
						$cssfile = '';
        break;
   case 'or-organizationlist':
   case 'or-aj_orgoverview':
   case 'or-aj_orgprfoverview':
   case 'or-aj_assocoverview':
	case 'or-verifyorgpreflist':
	case 'or-aj_verifyorgpreflist':
   case 'or-createorganization':
   case 'or-createorganizationpref':
   case 'or-organizationview':
   case 'or-organizationprefview':
   case 'or-aj_organizationlist':
	case 'or-createassociation':
	case 'or-associationlist':
   case 'or-aj_associationlist':
	case 'or-verifyorganization':
   case 'or-aj_verifyorganizationlist':
	case 'or-associationview':
	case 'or-verifyassociationlist':
   case 'or-aj_verifyassociationlist':
   case 'or-oaview':
   case 'or-oaeditprofile':

   case 'u-user':
	case 'u-oudashboard':
	case 'u-b2oudashboard':
   case 'u-creategroup':
	case 'u-assignrights':
   case 'u-edituserrights':
	case 'u-userrights':
   case 'u-groupview':
   case 'u-aj_groupoverview':
   case 'u-aj_useroverview':
   case 'u-createorganizationuser':
   case 'u-organizationuserview':
   case 'u-organizationuserlist':
   case 'u-aj_organizationuserlist':
   case 'u-grouplist':
   case 'u-aj_grouplist':
   case 'u-purchaseorderlist':
   case 'u-purchaseordercreate':
	case 'u-popref':
	case 'u-poprefview':
   case 'u-purchaseorderadditems':
	case 'u-purchaseorderview':
	case 'u-poviewitems':
	case 'aj_getOrganizationUserStatus':
   case 'u-verifyorganizationuserlist':
   case 'u-aj_verifyorganizationuserlist':
   case 'u-listrights':
   case 'u-aj_listrights':
	case 'u-verifyrights':
   case 'u-aj_verifyrights':
   case 'u-oueditprofile':
   case 'u-verifygrouplist':
   case 'u-aj_verifygrouplist':
   case 'm-loginlist':
   case 'm-aj_loginlist':
   case 'm-inbox':
   case 'm-aj_inbox':
   case 'm-inboxdetail':
   case 'u-invoicelist':
	case 'u-invacptlist':
   case 'u-aj_invoicelist':
	case 'u-aj_invacptlist':
   case 'u-invoiceview':
   case 'u-invoiceviewitems':
   case 'u-polist':
	case 'u-poacptlist':
   case 'u-aj_polist':
	case 'u-aj_poacptlist':
   case 'u-poview':
   case 'u-invoicecreate':
	case 'u-invpref':
	case 'u-invprefview':
   case 'u-invoiceadditems':
   case 'm-exportpo':
   case 'u-importinvoice':
   case 'u-importpurchaseorders':
   case 'm-aj_chkpage':

   case 'or-b2bprodtasoc':
   case 'or-b2bprodtasocview':
   case 'or-b2bprodtasoclist':
   case 'or-aj_b2bprdtassoclist':
   case 'or-b2bprodtasocvlist':
   case 'or-aj_b2bprdtassovlist':
   case 'or-b2sprodtasoc':
   case 'or-b2sprodtasocview':
   case 'or-b2sprodtasoclist':
	case 'or-aj_b2sprdtassoclist';
   case 'or-b2sprodtasocvlist':
	case 'or-aj_b2sprdtassocvlist';
   case 'or-b2buyerasoc':
   case 'or-b2buyerasocview':
   case 'or-b2buyerasoclist':
	case 'or-aj_b2buyerasoclist';
   case 'or-b2buyerasocvlist':
	case 'or-aj_b2buyerasocvlist';
   case 'or-b2supplierasoc':
   case 'or-b2supplierasocview':
   case 'or-b2supplierasoclist':
   case 'or-aj_b2supplierasoclist':
   case 'or-b2supplierasocvlist':
   case 'or-aj_b2supplierasocvlist':
   case 'or-b2bprodtbasoc';
   case 'or-b2bprodtbasocview':
   case 'or-b2bprdtbasoclist':
   case 'or-aj_b2bprdtbassoclist':
   case 'or-b2bprdtbasocvlist':
   case 'or-aj_b2bprdtbassovlist':
   case 'or-b2sprodtsasoc';
   case 'or-b2sprodtsasocview':
   case 'or-b2sprdtsasoclist':
   case 'or-aj_b2sprdtsassoclist':
   case 'or-b2sprdtsasocvlist':
   case 'or-aj_b2sprdtsassovlist':

	case 'u-binvoiceocreatefpo':
	case 'u-rfq2create':
	case 'u-rfq2list':
	case 'u-aj_rfq2list':
	case 'u-aj_rfq2vlist':
	case 'u-aj_rfq2rlist':
	case 'u-rfq2vlist':
	case 'u-rfq2rlist':
	case 'u-rfq2view':
	case 'u-b2rfq2list':
	case 'u-aj_b2rfq2list':
	case 'u-b2rfq2view':
	case 'u-rfq2bidhistory':
	case 'u-viewsrfq2bid':
	case 'u-b2rfq2bidlist':
	case 'u-aj_b2rfq2bidlist':
	case 'u-b2rfq2bidvlist':
	case 'u-aj_b2rfq2bidvlist':
	case 'u-b2rfq2bidrlist':
	case 'u-aj_b2rfq2bidrlist':
	case 'u-rfq2bidlist':
	case 'u-aj_rfq2bidlist':
	case 'u-rfq2bidview':
	case 'u-b2rfq2watchlist':
	case 'u-aj_b2rfq2watchlist':
	case 'u-rfq2awardview':
	case 'u-rfq2awardlist':
	case 'u-aj_rfq2awardlist':
	case 'u-b2rfq2awardlist':
	case 'u-aj_b2rfq2awardlist':
	case 'u-b2rfq2awardview':
	case 'u-viewb2rfq2awardhistory':
	case 'u-viewrfq2awardhistory':
	case 'u-b2rfq2autobids':
	case 'm-inetreports':
	case 'm-reportsrpt':
	case 'm-reportsrptpop':

						$dvid = 'wraper';
						$mdivid = 'middle-part';
						$cssfile = 'sm_style.css';
						break;

	default:
						break;
}
?>