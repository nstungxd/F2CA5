<?php
//header("Content-Type: application/xml; charset=UTF-8");
include(S_SECTIONS."/member/memberaccess.php");
ob_clean();
$xml = '<?xml version="1.0" encoding="iso-8859-1"?>'."\n";
$xml.='<Dataroot Table="Purshase Order detail">'."\n";
if(!isset($exportobj)) {
	require_once(SITE_CLASS_GEN."class.export.php");
   $exportobj=new Export(array('filename'=>'exportaccount'));
}

if(!isset($zip)) {
   require_once(SITE_CLASS_GEN."class.zip.php");
   $zip = new zipfile();
}
if(!isset($poObj)) {
		include_once(SITE_CLASS_APPLICATION."user/class.PurchaseOrderHeading.php");
		$poObj = new PurchaseOrderHeading();
}
if(!isset($orgprefObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationPreference.php");
	$orgprefObj =	new OrganizationPreference();
}
if(!isset($orgObj)) {
    include_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
    $orgObj =	new Organization();
}

$iPoIds = $_POST['iPurchaseOrderID'];
//prints($iPoIds);exit;
if(is_array($iPoIds)) {
	$pos = @implode(',',$iPoIds);
	$where = " AND poh.iPurchaseOrderID IN ($pos)";
}
// $enc = $_POST['enc'];
// $enc= $encPO;
//if($enc == 'y')
//{
    $opf = $orgprefObj->getDetails('*'," AND iOrganizationID=$curORGID ");
	if($opf[0]['eSecureExportPO']=='Yes') {
		$arr_loaded_ext = get_loaded_extensions();
		if(in_array('mcrypt', $arr_loaded_ext)){
			$enc = 'y';
			if(!isset($encobj)) {
				include_once(SITE_CLASS_APPLICATION."organization/class.Encryption.php");
				$encobj = new Encryption();
			}
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
/*if($enc!='y') {
	$enc = 'n';
}*/
// $exportobj->setEncValues($encKey,$encAlgo,'');
// $iv_val = $encobj->setEncValues($encKey,$encAlgo,$code,'');
// echo $iv_val; exit;
// prints($_POST); exit;
// prints($iPoIds); exit;
//$limit = " LIMIT ".($page-1)*$REC_LIMIT_FRONT.", ".$REC_LIMIT_FRONT." ";
// print $where; exit;
//and poh.iStatusID in (".$poUserStatusIds.")

// echo $where; exit;
$orderBy  = "iPurchaseOrderID";
$jtbl='';
$jtbl.= " LEFT JOIN ".PRJ_DB_PREFIX."_status_master sm on sm.iStatusID   =  poh.iStatusID";
$jtbl.= " LEFT JOIN ".PRJ_DB_PREFIX."_organization_user ou on ou.iUserID =  poh.iBuyerID";
$jtbl.= " LEFT JOIN ".PRJ_DB_PREFIX."_organization_user ous on ous.iUserID =  poh.iSupplierID";
$jtbl.= " LEFT JOIN ".PRJ_DB_PREFIX."_purchase_order_otherinformation poi on poh.iPurchaseOrderID=poi.iPurchaseOrderID ";
// $jtbl.= " LEFT JOIN ".PRJ_DB_PREFIX."_purchase_order_heading poh on poh.iPurchaseOrderID =  ioh.iPurchaseOrderID";
$fields = " poh.*,sm.vStatus_".LANG." as status,CONCAT(ou.vFirstName,' ',ou.vLastName) as buyername,CONCAT(ous.vFirstName,' ',ous.vLastName) as suppliername,DATE_FORMAT(dOrderDate,'%Y-%m-%d') as dOrderDate, DATEDIFF(NOW(),poh.dCreateDate) as days,
				'|' as '|',poi.tSourcingDocument, poi.tGlobalAgreement, poi.tPaymentTerms, poi.tFOB, poi.tDeliveryTerms, poi.tShippingControl, poi.tConditionsForPayment, poi.tPenalties, poi.tSpecialInstruction, poi.tNote ";
$ExportArr = $poObj->getJoinTableInfo($jtbl,$fields,$where,$orderBy,'',$limit,'yes');
$ExportArr = array_slice($ExportArr,0,-1);

//prints($ExportArr);exit;

$sep = "\t,";
$down_tools = 'PO';
# $enc = '';
// GET USER PROJECT MEMBER PERMISSION DETAIL
//Prints($ExportArr);exit;
switch($down_tools) {
    case 'PO':
            $xmlArr = array(
                           'Header' =>'purchaseOrder',
                           'Arr'    => $ExportArr,
                           );
            /*$TagArr = array(
                              'po-num' => 'vPONumber',
                              'po-date' => 'dCreateDate',
                              'sender-id' => 'iSupplierID',
							  'receiver-id' => 'iBuyerID',
							  'currency' => 'vCurrency',
                              'taxable' => 'eLineItemTax',
                              'tax-rate' => 'fVAT',
                              'tax-amount' => 'fOther_tax_1',
                              'po-total' => 'fPOTotal',
                              'bill-to-code' => 'vBillToParty',
                              'ship-to-code' => 'vShipToParty'
                            );
                            */
             $TagArr = array(
                              'Buyer Company ID' => 'iBuyerOrganizationID',
                              'Buyer Company Name' => 'vBuyerCompanyName',
                              'Buyer Code' => 'vBuyerCode',
                              'Suplier Company ID' => 'iSupplierOrganizationID',
                              'Suplier Company Name' => 'vSupplierName',
										'Supplier Contact Party' => 'vSupplierContactParty',
										'Po Buyer Code' => 'vPoBuyerCode',
                              'PO Code' => 'vPOCode',
                              'Order date' => 'dOrderDate',
                              'Order Description' => 'tOrderDescription',
                              'Opening Unit' => 'iOpeningUnit',
                              'Supplier Order Num' => 'vSupplierOrderNum',
                              'Carrier' => 'tCarrier',
                              'Line Item Tax' => 'eLineItemTax',
                              'VAT' => 'fVAT',
                              'Other tax 1' => 'fOther_tax_1',
                              'ShipToParty' => 'vShipToParty',
                              'Ship To Address Line1' => 'vShipToAddressLine1',
                              'Ship To Address Line 2' => 'vShipToAddressLine2',
                              'Ship To City' => 'vShipToCity',
                              'Ship To Country' => 'vShipToCountry',
                              'Ship To State' => 'vShipToState',
							  			'Ship To Zip Code' => 'vShipToZipCode',
							  			'Ship To Contact Party' => 'vShipToContactParty',
                              'Ship To Contact Telephone' => 'vShipToContactTelephone',
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
                              'PO Total' => 'fPOTotal',
                              'Prepayment' => 'fPrepayment',
                              'Sourcing Document' 	=> 'tSourcingDocument',
                              'Global Agreement' 	=> 'tGlobalAgreement',
                              'Payment Terms' 		=> 'tPaymentTerms',
                              'FOB' 					=> 'tFOB',
                              'Delivery Terms' 		=> 'tDeliveryTerms',
                              'Shipping Control' 			=> 'tShippingControl',
                              'Conditions For Payment' 	=> 'tConditionsForPayment',
                              'Penalties' 				=> 'tPenalties',
                              'Special Instruction' 	=> 'tSpecialInstruction',
                              'Note' 					=> 'tNote'
                            );
            /*foreach($TagArr as $key=>$arr){
                $ss.= ''.$key.',';
            } */
            //Prints($ss);exit;
            $repeat = array(
                            'CallFunc'=>'$poObj->GetPurchaseOrderItems',
                            'VariablePass'=>'iPurchaseOrderID',
                            'repeatcsv'=>'Order Type,Item Description,Item Line No,Quantity,Unit Of Measure,Price,Amount,VAT,Other Tax,Sub Item Type,Sub Item Quantity,Sub Item Rate,Sub Item Amount,Line Total',
                            'Header'=>'items',
                            'XmlTagArr'   => array (
                                                'Order Type'=>'eOrderType',
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
            												'Line Total'=>'fLineTotal'
                                             )
										);
                                    /* OLD ARRAY
                                    'line-item-num'=>'iLineNumber',
                                                'quantity'=>'iQuantity',
                                                'basis-for-measure'=>'vUnitOfMeasure',
                                                'price'=>'fPrice',
                                                'eaton-part-num'=>'vItemCode',
                                                'product-desc'=>'tDescription',
                                                'supplier-part-num'=>'suplierpartnum',
                                                'supplier-part-desc'=>'suplierpartdesc',
                                                'release-num'=>'releasenum',
                                                'extended-price'=>'fLineTotal'
                                    */
			// $xmlArr['Arr']['ivval'] = (isset($iv_val)) ? $iv_val : "";
            $htmlcontent = $exportobj->MakeXml($xmlArr,$TagArr,$repeat,'','',$enc);
            ///Prints($htmlcontent);exit;
				//$csv = "po-num,po-date,sender-id,receiver-id,currency,taxable,tax-rate,tax-amount,po-total,bill-to-code,ship-to-code";
            $csv = "Buyer Company ID,Buyer Company Name,Buyer Code,Suplier Company ID,Suplier Company Name,Supplier Contact Party,Po Buyer Code,PO Code,Order date,Order Description,Opening Unit,Supplier Order Num,Carrier,Line Item Tax,VAT,Other tax 1,ShipToParty,Ship To Address Line1,Ship To Address Line 2,Ship To City,Ship To Country,Ship To State,Ship To Zip Code,Ship To Contact Party,Ship To Contact Telephone,Bill To Party,Bill To AddLine 1,Bill To AddLine 2,Bill To City,Bill To Country,Bill To State,Bill To ZipCode,Bill To Contact Party,Bill To Contact Telephone,Currency,PO Total,Prepayment,tSourcingDocument,tGlobalAgreement,tPaymentTerms,tFOB,tDeliveryTerms,tShippingControl,tConditionsForPayment,tPenalties,tSpecialInstruction,tNote";
			$csvcontent = $exportobj->MakeCSV($xmlArr,$TagArr,$repeat,'','',$csv,'','',$enc,"$sep");
			$pdfcontent = $exportobj->MakePdf($xmlArr,$TagArr,$repeat,'','',$csv,'','',$enc);
			$pdfcontent = "<h1 align='center'>PO Details</h1></br>".$pdfcontent;
            # pr($csvcontent); exit;
		break;
}
//exit();
//$html = $exportobj->GenerateFormat($fieldArr,$dataArr,$CallFunctionArr);
$xml.=$htmlcontent;
$xml.='</Dataroot>'."\n";
// pr($pdfcontent); exit;
// print($exportobj->output_xml($xml));exit;
$html = $exportobj->GenerateXml($xml);
if($enc == 'y') {
//	$html = $generalobj->encrypt($html);
//	$csvcontent = $generalobj->encrypt($csvcontent);
}
// Prints($csvcontent);exit;
ini_set('zlib.output_compression', 'Off');
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

//
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