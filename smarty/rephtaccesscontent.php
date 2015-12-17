<?php
####CONTENT Section URLS
$home						= "&file=c-home&msg=$1";
$notauthorised			= "&file=c-notauthorised";
$support					= "&file=c-support";
$aboutus					= "&file=c-aboutus&id=$1";
$sitemap					= "&file=c-sitemap";
$contactus				= "&file=c-contactus";
$privacypolicy			= "&file=c-privacypolicy";
$login					= "&file=c-home&msg=$1";
$logout					= "&file=m-logout&msg=$1";
$changepass				= "&file=m-changepass&id=$1";
$closepage				= "&file=c-closepage";
$forgotpass				= "&file=c-forgotpass&msg=$1";

$inboxdetail			= "&file=m-inboxdetail&id=$1";
$inbox 					= "&file=m-inbox";

$smdashboard			      = "&file=sm-smdashboard";
$editprofile 					= "&file=sm-editprofile&msg=$1";

$importpurchaseorders 		= "&file=u-importpurchaseorders&msg=$1";
$importinvoice 				= "&file=u-importinvoice&msg=$1";
$userrights 					= "&file=u-userrights&id=$1";
$oudashboard 					= "&file=u-oudashboard";
$assignrights 					= "&file=u-assignrights";
$edituserrights 				= "&file=u-edituserrights&id=$1&msg=$2";
$creategroup 					= "&file=u-creategroup&id=$1&msg=$2";
$groupviewhistory 			= "&file=u-groupviewhistory&id=$1";
$groupview 						= "&file=u-groupview&id=$1&msg=$2";
$createorganizationuser 	= "&file=u-createorganizationuser&id=$1&msg=$2";
$organizationuserview 		= "&file=u-organizationuserview&id=$1&msg=$2";
$organizationuserlist 		= "&file=u-organizationuserlist&msg=$1";
$grouplist 						= "&file=u-grouplist&msg=$1";
$verifyorganizationuserlist = "&file=u-verifyorganizationuserlist&msg=$1";
$verifygrouplist 				= "&file=u-verifygrouplist&msg=$1";
$oueditprofile					= "&file=u-oueditprofile&msg=$1";
$orguserviewhistory 			= "&file=u-orguserviewhistory&id=$1";
$urightsviewhistory 			= "&file=u-urightsviewhistory&id=$1";
$listrights 					= "&file=u-listrights&msg=$1";
$verifyrights 					= "&file=u-verifyrights&msg=$1";
$poviewhistory 				= "&file=u-poviewhistory&id=$1";
$invoiceviewhistory 			= "&file=u-invoiceviewhistory&id=$1";
$changesecans 					= "&file=u-changesecans&n=$1&id=$2";

$organizationview 			= "&file=or-organizationview&id=$1&pg=$2";
$organizationlist          = "&file=or-organizationlist&msg=$1";
$organizationprefview 		= "&file=or-organizationprefview&orgid=$1&id=$2&pg=$3";
$oadashboard               = "&file=or-oadashboard";
$verifyorganization 			= "&file=or-verifyorganization&msg=$1";
$oaeditprofile 				= "&file=or-oaeditprofile&msg=$1";
$oaview 							= "&file=or-oaview&msg=$1";
$orgviewhistory 				= "&file=or-orgviewhistory&id=$1";
$orgprefviewhistory 			= "&file=or-orgprefviewhistory&id=$1";
$asocviewhistory 				= "&file=or-asocviewhistory&id=$1";

$createorganizationpref    = "&file=or-createorganizationpref&orgid=$1&id=$2&msg=$3";
$createorganization        = "&file=or-createorganization&id=$1&msg=$2";
$createassociation         = "&file=or-createassociation&id=$1&msg=$2";
$associationlist           = "&file=or-associationlist&msg=$1";
$verifyassociationlist     = "&file=or-verifyassociationlist&msg=$1";
$associationview				= "&file=or-associationview&id=$1&msg=$2";
$verifyorganizationlist		= "&file=or-verifyorganizationlist&msg=$1";
$verifyorgpreflist			= "&file=or-verifyorgpreflist&msg=$1";

$invoicelist					= "&file=u-invoicelist&id=$1&msg=$2";
$invacptlist					= "&file=u-invacptlist&id=$1&msg=$2";
$invoicecreate					= "&file=u-invoicecreate&id=$1&msg=$2";
$invprefview					= "&file=u-invprefview&id=$1&msg=$2";
$invpref							= "&file=u-invpref&id=$1&msg=$2";
$invoiceadditems				= "&file=u-invoiceadditems&id=$1&msg=$2";
$invoiceview               = "&file=u-invoiceview&id=$1&msg=$2";
$invoiceviewitems				= "&file=u-invoiceviewitems&id=$1&msg=$2";
$polist                		= "&file=u-polist&id=$1&msg=$2";
$poacptlist                = "&file=u-poacptlist&id=$1&msg=$2";
$poviewitems					= "&file=u-poviewitems&id=$1&msg=$2";
$poview                		= "&file=u-poview&id=$1&msg=$2";

$purchaseorderlist         = "&file=u-purchaseorderlist";
$purchaseordercreate			= "&file=u-purchaseordercreate&id=$1&msg=$2";
$poprefview             	= "&file=u-poprefview&id=$1&msg=$2";
$popref         				= "&file=u-popref&id=$1&msg=$2";
$purchaseorderadditems     = "&file=u-purchaseorderadditems&id=$1&msg=$2";
$purchaseorderview			= "&file=u-purchaseorderview&id=$1&msg=$2";

//
// $b2association             = "&file=or-b2association&id=$1&msg=$2";
$b2bprodtasocview          = "&file=or-b2bprodtasocview&id=$1&msg=$2";
$b2bprodtasoclist          = "&file=or-b2bprodtasoclist&id=$1&msg=$2";
$b2bprodtasocvlist         = "&file=or-b2bprodtasocvlist&id=$1&msg=$2";
$b2bprodtasoc              = "&file=or-b2bprodtasoc&id=$1&msg=$2";

$b2sprodtasocview          = "&file=or-b2sprodtasocview&id=$1&msg=$2";
$b2sprodtasoclist          = "&file=or-b2sprodtasoclist&id=$1&msg=$2";
$b2sprodtasocvlist         = "&file=or-b2sprodtasocvlist&id=$1&msg=$2";
$b2sprodtasoc              = "&file=or-b2sprodtasoc&id=$1&msg=$2";

$b2buyerasocview           = "&file=or-b2buyerasocview&id=$1&msg=$2";
$b2buyerasoclist           = "&file=or-b2buyerasoclist&id=$1&msg=$2";
$b2buyerasocvlist          = "&file=or-b2buyerasocvlist&id=$1&msg=$2";
$b2buyerasoc               = "&file=or-b2buyerasoc&id=$1&msg=$2";

$b2supplierasocview        = "&file=or-b2supplierasocview&id=$1&msg=$2";
$b2supplierasoclist        = "&file=or-b2supplierasoclist&id=$1&msg=$2";
$b2supplierasocvlist       = "&file=or-b2supplierasocvlist&id=$1&msg=$2";
$b2supplierasoc            = "&file=or-b2supplierasoc&id=$1&msg=$2";

$b2bprodtbasocview         = "&file=or-b2bprodtbasocview&id=$1&msg=$2";
$b2bprdtbasoclist          = "&file=or-b2bprdtbasoclist&id=$1&msg=$2";
$b2bprdtbasocvlist         = "&file=or-b2bprdtbasocvlist&id=$1&msg=$2";
$b2bprodtbasoc             = "&file=or-b2bprodtbasoc&id=$1&msg=$2";

$b2sprodtsasocview         = "&file=or-b2sprodtsasocview&id=$1&msg=$2";
$b2sprdtsasoclist          = "&file=or-b2sprdtsasoclist&id=$1&msg=$2";
$b2sprdtsasocvlist         = "&file=or-b2sprdtsasocvlist&id=$1&msg=$2";
$b2sprodtsasoc             = "&file=or-b2sprodtsasoc&id=$1&msg=$2";

// BUYER2
$b2oadashboard 				= "&file=or-b2oadashboard&id=$1&msg=$2";
$b2oudashboard 				= "&file=u-b2oudashboard&id=$1&msg=$2";

$bprodtls 						= "&index.php?file=u-bprodtls&id=$1&msg=$2";
$sprodtls 						= "&index.php?file=u-sprodtls&id=$1&msg=$2";
$binvoiceocreatefpo 			= "&file=u-binvoiceocreatefpo&id=$1&msg=$2";
$b2rfq2list 					= "&file=u-b2rfq2list&id=$1&msg=$2";
$b2rfq2view 					= "&file=u-b2rfq2view&id=$1&msg=$2";
$rfq2create 					= "&file=u-rfq2create&id=$1&msg=$2";
$rfq2list 						= "&file=u-rfq2list&id=$1&msg=$2";
$rfq2vlist 						= "&file=u-rfq2vlist&id=$1&msg=$2";
$rfq2rlist 						= "&file=u-rfq2rlist&id=$1&msg=$2";
$rfq2viewhistory 				= "&file=u-rfq2viewhistory&id=$1&msg=$2";
$rfq2view 						= "&file=u-rfq2view&id=$1&msg=$2";
$rfq2bidhistory 				= "&file=u-rfq2bidhistory&id=$1&msg=$2";
$viewsrfq2bid 					= "&file=u-viewsrfq2bid&id=$1&msg=$2";
$viewrfq2bidhistory 			= "&file=u-viewrfq2bidhistory&id=$1&msg=$2";
$b2rfq2bidlist 				= "&file=u-b2rfq2bidlist&id=$1&msg=$2";
$b2rfq2bidvlist 				= "&file=u-b2rfq2bidvlist&id=$1&msg=$2";
$b2rfq2bidrlist 				= "&file=u-b2rfq2bidrlist&id=$1&msg=$2";
$rfq2bidlist 					= "&file=u-rfq2bidlist&id=$1&msg=$2";
$rfq2awardlist 				= "&file=u-rfq2awardlist&id=$1&msg=$2";

$rfq2bidview 					= "&file=u-rfq2bidview&id=$1&msg=$2";
$b2rfq2watchlist 				= "&file=u-b2rfq2watchlist&msg=$1";
$rfq2awardview 				= "&file=u-rfq2awardview&id=$1&msg=$2";
$b2rfq2awardlist 				= "&file=u-b2rfq2awardlist&id=$1&msg=$2";
$b2rfq2awardview 				= "&file=u-b2rfq2awardview&id=$1&msg=$2";
$viewb2rfq2awardhistory 	= "&file=u-viewb2rfq2awardhistory&id=$1&msg=$2";
$viewrfq2awardhistory 		= "&file=u-viewrfq2awardhistory&id=$1&msg=$2";

$registrationactivation 	= "&file=c-registrationactivation&msg=$1";
$orgregister 					= "&file=m-orgregister&msg=$1";
$reportsrptpop 				= "&file=m-reportsrptpop&tParameters=$1&id=$2&msg=$3";
$reportsrpt 					= "&file=m-reportsrpt&msg=$1";

?>