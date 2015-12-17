<?php
//header("Content-Type: application/xml; charset=UTF-8");
ob_clean();
$xml = '<?xml version="1.0" encoding="iso-8859-1"?>'."\n";
$xml.='<Dataroot Table="Invoice Detail">'."\n";
if(!isset($exportobj)) {
	require_once(SITE_CLASS_GEN."class.export.php");
   $exportobj=new Export(array('filename'=>'exportaccount'));
}

if(!$zip) {
   require_once(SITE_CLASS_GEN."class.zip.php");
   $zip = new zipfile();
}

if(!isset($poObj)) {
		include_once(SITE_CLASS_APPLICATION."user/class.InvoiceOrderHeading.php");
		$poObj = new InvoiceOrderHeading();
}
if(!isset($orgprefObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationPreference.php");
	$orgprefObj =	new OrganizationPreference();
}
if(!isset($orgObj)) {
    include_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
    $orgObj =	new Organization();
}

$iInvIds = $_POST['iInvoiceID'];
if(is_array($iInvIds) && count($iInvIds)>0) {
	$iInvIds = array_filter($iInvIds);
	$invs = @ implode(',', $iInvIds);
	$where = " AND ioh.iInvoiceID IN ($invs)";
}
// echo $where; exit;
//$enc = $_POST['enc'];
//$enc=$encInvoice;
//if($enc == 'y')
//{
   $opf = $orgprefObj->getDetails('*'," AND iOrganizationID=$curORGID ");
	if($opf[0]['eSecureExportInvoice']=='Yes') {
		$arr_loaded_ext = get_loaded_extensions();
		if(in_array('mcrypt',$arr_loaded_ext)){
			$enc = 'y';
			//
			$encKey = $opf[0]['vEncryptionKey'];
			$encAlgo = $opf[0]['eCryptAlgo'];
			$orgdt = $orgObj->select($curORGID);
			$code[] = $orgdt[0]['vOrganizationCode'].$orgdt[0]['iOrganizationID'];
			$code[] = $orgdt[0]['dCreatedDate'];
			//
			$iv_val = $encobj->setEncValues($encKey,$encAlgo,$code,'');
		}
	}
//}
// $limit = " LIMIT ".($page-1)*$REC_LIMIT_FRONT.", ".$REC_LIMIT_FRONT." ";
// print $where;
// and poh.iStatusID in (".$poUserStatusIds.")
$orderBy  = " ioh.iInvoiceID ";
$jtbl.= " LEFT JOIN ".PRJ_DB_PREFIX."_status_master sm on sm.iStatusID = ioh.iStatusID";
$jtbl.= " LEFT JOIN ".PRJ_DB_PREFIX."_organization_user ou on ou.iUserID = ioh.iBuyerID";
$jtbl.= " LEFT JOIN ".PRJ_DB_PREFIX."_purchase_order_heading poh on poh.iPurchaseOrderID = ioh.iPurchaseOrderID";
$jtbl.= " LEFT JOIN ".PRJ_DB_PREFIX."_invoice_otherinformation ioi on ioh.iInvoiceID=ioi.iInvoiceID ";
$fields = " ioh.*,sm.vStatus_".LANG." as status,CONCAT(ou.vFirstName,' ',ou.vLastName) as buyername, DATEDIFF(NOW(),ioh.dCreatedDate) as days,DATE_FORMAT(ioh.dIssueDate,'%Y-%m-%d') as dIssueDate,poh.vPONumber,poh.dCreateDate as podate,
				ioi.tSourcingDocument, ioi.tGlobalAgreement, ioi.tPaymentTerms, ioi.tFOB, ioi.tDeliveryTerms, ioi.tShippingControl, ioi.tConditionsForPayment, ioi.tPenalties, ioi.tSpecialInstruction, ioi.tNote ";
$ExportArr = $poObj->getJoinTableInfo($jtbl,$fields,$where,$orderBy,'',$limit,'yes');
$ExportArr = array_slice($ExportArr,0,-1);
// prints($ExportArr);exit;
$sep = "\t,";
$down_tools = 'INVOICE';
// GET USER PROJECT MEMBER PERMISSION DETAIL
switch($down_tools) {
   case 'INVOICE':
            $xmlArr = array(
                           'Header' =>'invoices',
                           'Arr'    => $ExportArr,
            				);
            $TagArr = array(
                              'Supplier Company Name' => 'vSupplierName',
                              'Supplier Company ID' => 'iSupplierOrganizationID',
                              'Supplier Code'       => 'vInvoiceSupplierCode',
                              'Invoice Supplier Code'=> 'vInvSupplierCode',
                              'Related PO Code '    => 'vExtPOCode',
                              'Buyer Name' => 'vBuyerName',
                              'Buyer ID' => 'iBuyerOrganizationID',
                              'Buyer Contact Party ' => 'vBuyerContactParty',
						  				'Invoice Code' => 'vInvoiceCode',
                              'Issue Date' => 'dIssueDate',
                              'Invioce Description' => 'tInvoiceDescription',
                              'Opening Unit' => 'iOpeningUnit',
                              'Supplier Order Num' => 'vSupplierOrderNum',
                              'Invoice Type'   => 'eInvoiceType',
                              'Line Item Tax' => 'eLineItemTax',
                              'VAT' => 'fVAT',
                              'Other tax 1' => 'fOtherTax1',
                              'Freight'     => 'vFreight',
                              'Miscellaneous'     => 'tMiscellaneous',
                              'Discount Baseline'   => 'dCashDiscountBaseline',
                              'Max Cash Discount Days'=>'iMaxCashDiscountDays',
                              'Max Cash Discount Percentage'=> 'fMaxCashDiscountPercentage',
                              'Normal Cash Discount Days '=> 'iNormalCashDiscountDays',
                              'Normal Cash Discount Percentage'=> 'iNormalCashDiscountPercentage',
                              'Bill To Party' => 'vBillToParty',
                              'Bill To AddLine 1' => 'vBillToAddLine1',
                              'Bill To AddLine 2' => 'vBillToAddLine2',
                              'Bill To City' => 'vBillToCity',
                              'Bill To Country' => 'vBillToCountry',
                              'Bill To State' => 'vBillToState',
                              'Bill To ZipCode' => 'vBillToZipCode',
                              'Bill To Contact Party' => 'vBillToContactParty',
                              'Bill To Contact Telephone' => 'vBillToContactTelephone',
                              'Currency' => 'vCurrency',
                              'Invoice Total' => 'fInvoiceTotal',
                              'Prepayment' => 'fPrePayment',
                              'Sourcing Document' 	=> 'tSourcingDocument',
                              'Global Agreement' 	=> 'tGlobalAgreement',
                              'Payment Terms' 		=> 'tPaymentTerms',
                              'FOB' 					=> 'tFOB',
                              'Delivery Terms' 		=> 'tDeliveryTerms',
                              'Shipping Control' 			=> 'tShippingControl',
                              'Conditions For Payment' 	=> 'tConditionsForPayment',
                              'Penalties' 				=> 'tPenalties',
                              'Special Instruction' 	=> 'tSpecialInstruction',
                              'Note' 						=> 'tNote'
                            );
            /*foreach($TagArr as $key=>$arr){
                $ss.= ''.$key.',';
            }
            echo   $ss;exit;
            */
            $repeat = array(
                            'CallFunc'=>'$poObj->GetInvoiceItems',
                            'VariablePass'=>'iInvoiceID',
                            'repeatcsv'=>'Order Type,Item Description,Item Line No,Quantity,Unit Of Measure,Price,Amount,VAT,Other Tax,Sub Item Type,Sub Item Quantity,Sub Item Rate,Sub Item Amount,Line Total',
                            'Header'=>'items',
                            'XmlTagArr'   => array(
                                                'Order Type'=>'eInvoiceType',
                                                'Item Description'=>'tDescription',
                                                'Item Line No'=>'iLineNumber',
            												'Quantity'=>'iQuantity',
            												'Unit Of Measure'=>'vUnitOfMeasure',
            												'Price'=>'fPrice',
                                                'Amount'=> 'fAmount',
                                                'VAT'=> 'fVAT',
                                                'Other Tax'=> 'fOtherTax1',
																'Sub Item Type'=> 'eSublineType',
																'Sub Item Quantity'=> 'iSubQuantity',
																'Sub Item Rate'=> 'fSubRate',
																'Sub Item Amount'=> 'fSubAmount',
            												'Line Total'=>'fLineTotal',
                                             )
                           );
			// $xmlArr['Arr']['ivval'] = (isset($iv_val)) ? $iv_val : "";
            $htmlcontent = $exportobj->MakeXml($xmlArr,$TagArr,$repeat,'','',$enc);
            //Prints($htmlcontent);exit;
            //$csv = "invoice-num,invoice-date,iPurchaseOrderID,sender-id,receiver-id,currency,taxable,tax-rate,tax-amount,invoice-total,bill-to-party";
            $csv = "Supplier Company Name,Supplier Company ID,Supplier Code,Invoice Supplier Code,Related PO Code ,Buyer Name,Buyer ID,Buyer Contact Party ,Invoice Code,Issue Date,Invioce Description,Opening Unit,Supplier Order Num,Invoice Type,Line Item Tax,VAT,Other tax 1,Freight,Miscellaneous,Discount Baseline,Max Cash Discount Days,Max Cash Discount Percentage,Normal Cash Discount Days ,Normal Cash Discount Percentage,Bill To Party,Bill To AddLine 1,Bill To AddLine 2,Bill To City,Bill To Country,Bill To State,Bill To ZipCode,Bill To Contact Party,Bill To Contact Telephone,Currency,Invoice Total,Prepayment,tSourcingDocument,tGlobalAgreement,tPaymentTerms,tFOB,tDeliveryTerms,tShippingControl,tConditionsForPayment,tPenalties,tSpecialInstruction,tNote";
			$csvcontent = $exportobj->MakeCSV($xmlArr,$TagArr,$repeat,'','',$csv,'','',$enc,"$sep");
			$pdfcontent = $exportobj->MakePdf($xmlArr,$TagArr,$repeat,'','',$csv,'','',$enc);
			$pdfcontent = "<h1 align='center'>Invoice Details</h1></br>".$pdfcontent;
            // Prints($csvcontent);exit;
   break;
}
//exit();
//$html = $exportobj->GenerateFormat($fieldArr,$dataArr,$CallFunctionArr);
$xml .= $htmlcontent;
$xml .= '</Dataroot>'."\n";
// pr($csvcontent); exit;
// print($exportobj->output_xml($xml));exit;

ini_set('zlib.output_compression', 'Off');
$html = $exportobj->GenerateXml($xml);
// pr($html); exit;
$timeval = date('Y-m-d_H_i_s');
$zip->add_file($html,'export_'.$timeval.'.xml');
$zip->add_file($csvcontent,'export_'.$timeval.'.csv');

define('_MPDF_PATH',SITE_CO_PATH . 'MPDF44/');
//include(DIR_LIB . '/fpdf/mpdf.php');
include(SITE_CO_PATH."MPDF44/mpdf.php");
$mpdf=new mPDF();
//$mpdf=new mPDF('utf-8-s');
$mpdf->AddPage();
$mpdf->WriteHTML($pdfcontent);
$pdffile = $mpdf->Output('export_'.$timeval.'.pdf','S');
$zip->add_file($pdffile,'export_'.$timeval.'.pdf');

//$filepath = $zip->file();
// $mime = 'application/download';
$mime = 'application/zip';
header('Content-type: '.$mime);
header('Content-Disposition: attachment; filename=export.zip');
header('Content-Transfer-Encoding: binary');
header("Expires: 0");
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
ob_clean();
ob_flush();
flush();
echo $zip->file();
exit;
?>