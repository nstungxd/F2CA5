<?php
if(!isset($imgObj)) {
	include_once(SITE_CLASS_GEN."class.imagecrop.php");
	$imgObj =	new imagecrop();
}
if(!isset($pohObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.InvoiceOrderHeading.php");
	$pohObj = new InvoiceOrderHeading();
}
if(!isset($orgprefObj)) {
	include_once(SITE_CLASS_APPLICATION."organization/class.OrganizationPreference.php");
	$orgprefObj =	new OrganizationPreference();
}
if(!isset($orgObj)) {
    include_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
    $orgObj =	new Organization();
}

$arr_loaded_ext = get_loaded_extensions();
if(in_array('mcrypt',$arr_loaded_ext)){
	if(!isset($encobj)) {
		require_once(SITE_CLASS_GEN."class.encryption.php");
	   $encobj= new Encryption();
	}
}

if(!isset($ioprefObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.InvoiceOtherInformation.php");
	$ioprefObj = new InvoiceOtherInformation();
}
$row = 1;
//$type = $_POST['type'];
//$type = 'xml';
$img_file = $_FILES['importfile'];
$fileName = $imgObj->UploadFile('IMPORT_FILES_PATH','file','',$img_file,$OldImg);
$fileType = substr($fileName,-4);
//$fileurl =  $cfgimg['IMPORT_FILES_PATH']['file']['url']."/".$fileName;
$fileurl =  $cfgimg['IMPORT_FILES_PATH']['file']['url'].$fileName;
$filepath =  $cfgimg['IMPORT_FILES_PATH']['file']['path'].$fileName;
$type = $fileType;
if ($type == ".jpg" || $type == "jpeg" || $type == ".png" || $type == ".gif" || $type == ".bmp") {
	$Data['dCreatedDate'] = $Data['dIssueDate'] =date('Y-m-d H:i:s');
	$Data['vFromIP'] = $_SERVER['REMOTE_ADDR'];
	$Data['iModifiedByID'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
	$stsdtls = $statusmasterObj->getDetails('iStatusID'," AND eFor='Invoice' AND vStatus_en='Create' ");
	if($reqVerification == 'Yes') {
		$Data['iStatusID'] = 0;
	} else {
		$Data['iStatusID'] = $stsdtls[0]['iStatusID'];
	}
	//$Data['iStatusID'] = $stsdtls[0]['iStatusID'];
	$Data['iSupplierOrganizationID'] = $curORGID;
	$Data['iSupplierID'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
	$Data['vSupplierContactParty'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_NAME'];

	$supOrgDtls = $orgObj->select($curORGID);
	$Data['vInvoiceSupplierCode'] = $supOrgDtls[0]['vOrganizationCode'];
	$Data['vSupplierName'] = $supOrgDtls[0]['vCompanyName'];
	$Data['vSupplierContactTelephone'] = $supOrgDtls[0]['vPhone'];
	// $Data['vBuyerContactEmail'] = $supOrgDtls[0]['vEmail'];
	$vItmCode = $pohObj->getUniqueCode();
	$Data['vInvoiceCode'] = $vItmCode;
	$vInvoiceNumber = "INV".$vItmCode."-".trim($Data['vInvoiceSupplierCode']);
	$Data['vInvoiceNumber'] = $vInvoiceNumber;
	if(trim($Data['eSaved']) == '') {
		$Data['eSaved'] = 'No';
	}
	// prints($Data); exit;
	$pohObj->setAllVar($Data);
	$iInvId = $pohObj->insert();
	$vImage = $imgObj->ImageUpload('INV','image',$iInvId,$_FILES['importfile'],'');
   $Dta['vImage'] = $vImage;
	$iInvId = $pohObj->updateData($Dta,"iInvoiceID=$iInvId");

	$var_msg = 'invimportsucc';
	@unlink($filepath);
	header("Location:".SITE_URL."importinvoice/$var_msg");
	exit;
}

$opf = $orgprefObj->getDetails('*'," AND iOrganizationID=$curORGID ");
if($opf[0]['eSecureImportInvoice']=='Yes') {
	$enc = 'y';
}
$encKey = $opf[0]['vEncryptionKey'];
$encAlgo = $opf[0]['eCryptAlgo'];
$orgdt = $orgObj->select($curORGID);
$code[] = $orgdt[0]['vOrganizationCode'].$orgdt[0]['iOrganizationID'];
$code[] = $orgdt[0]['dCreatedDate'];

if(isset($encobj) && $encobj!='') {
$encobj->setkey($encKey);
$encobj->setAlgo($encAlgo);
$encobj->setMode('');
$iv = $encobj->setiv($code);
$itmhd = $encobj->mencrypt('###items###');
} else {
	$itmhd = '###items###';
}
// echo $encobj->mdecrypt($itmhd);
// echo $itmhd; exit;
$enc = $_POST['enctyp'];
// $enc = $encInvoice;
/*if($enc == 'y')
{
	$opf = $orgprefObj->getDetails('*'," AND iOrganizationID=$curORGID ");
   $encKey=$opf[0]['vEncryptionKey'];
}*/

// if($enc=='' || $enc=='no' || $enc=='n') {
if($enc!='y') {
	$enc = 'n';
}
//$file = SPATH_ROOT."/export_2010-05-07_13_49_54.csv";
//$file = SPATH_ROOT."/export_2010-05-07_13_49_54.xml";

switch($type){
   case ".xml":
      $fileget = file_get_contents($filepath);
      include_once(SITE_CLASS_GEN."class.xml2array.php");
      $xmltoarobj = new XmlToArray($fileget);
      $poOrder = $xmltoarobj->createArray();
      $reqVal = $poOrder['Dataroot']['invoices'];
   break;
   case ".csv":
      if (($handle = fopen($filepath, "r")) !== FALSE) {
          $itemstarts=0;
          $invcode = '';
          $item =0;
          $itemrow = 0;
          while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
              $num = count($data);
				  if($data[0] == ''){
                  $itemstarts = '2';
              }
              if($num > 0) {
                  //Prints($num);
                  if($num > 1 || $data[0]=='###items###' || $data[0]==$itmhd) {
                     if($data[0]=='###items###' || $data[0]==$itmhd){
                        $itemstarts = '1';
                        //$item++;
                     }

							/*$inm = $encobj->encryptText('Invoice-num');
                     if($data[0]=='Invoice-num' || $data[0]==$inm) {
                        $itemstarts = '0';
                        //$item++;
                     }*/
							/*if($data[0] == $itmhd || $data[0] == $inm) {
								$enc = 'y';
							}*/
                     for ($c=0; $c < $num; $c++) {
                       if($row == 1){
                           $fileds[] = $data[$c];
                       }else{
                              if($data[0]!='###items###' && $data[0]!=$itmhd){
                                 if($itemstarts == '1'){
                                    //Prints($lastRowId);
                                    if($itemrow == 0){
                                       $eIncItem  = 'Yes';
                                       $itemfileds[] = $data[$c];
                                    }else {
                                       if(!in_array($data[$c],$itemfileds)){
                                          $values[$c] =$data[$c];
                                          $itemval[$lastRowId][$row][] = $data[$c];
                                       }
                                    }
                                 }
                              }
                              if($itemstarts == '0' || $itemstarts == '2'){
                                 //if(!in_array($data[$c],$fileds)){
                                    $invcode =$data[0];
                                    $values[$c] =$data[$c];
                                    $reqVal[$row][] = $data[$c];
                                    $lastRowId =$row;
                                 //}
                              }
                       }
                    }
                    $item = $row;
                  }
                 if($eIncItem == 'Yes'){
                  $eIncItem  = 'No';
                  $itemrow++;
                 }
                 $row++;
              }
          }
          fclose($handle);
      }
   break;
}
//$reqVal = Recompile($reqVal);
/*Prints($fileds);
Prints($itemfileds);

Prints($reqVal);
Prints($itemval);
exit;
*/
$scs = 'n';
// prints($reqVal); exit;
if(count($reqVal) > 0) {
   if(!isset($poLineObj)) {
   	include_once(SITE_CLASS_APPLICATION."user/class.InvoiceDetailLine.php");
   	$poLineObj =	new InvoiceDetailLine();
   }
	if(!isset($orgObj)) {
		include_once(SITE_CLASS_APPLICATION."organization/class.Organization.php");
		$orgObj = new Organization();
	}
	if(!isset($statusmasterObj)) {
		include_once(SITE_CLASS_APPLICATION."class.StatusMaster.php");
		$statusmasterObj = new StatusMaster();
	}
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
                              'Note' 					=> 'tNote'
                            );
            $pref_ary = array('tSourcingDocument','tGlobalAgreement','tPaymentTerms','tFOB','tDeliveryTerms','tShippingControl','tConditionsForPayment','tPenalties','tSpecialInstruction','tNote');
   			$itemTagArr  = array(
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
								'Line Total'=>'fLineTotal'
                     );
   foreach($reqVal as $key=>$val) {
      $Data = array();
      $i=0;
      foreach($TagArr as $key1=>$val1){
         if($type == '.xml'){
            $key1 = strtolower(str_replace(" ","",$key1));
            $Data[$val1]=trim($val[$key1]);
         }else{
            $Data[$val1]=trim($val[$i]);
         }
         $i++;
      }
		// prints($Data); exit;
		if($enc == 'y') {
			foreach($Data as $k => $v) {
				$Data[$k] = $encobj->mdecrypt($v);
			}
		}
		for($l=0;$l<count($pref_ary);$l++) {
			$Data_pref[$pref_ary[$l]] = $Data[$pref_ary[$l]];
			unset($Data[$pref_ary[$l]]);
		}
		// prints($Data); exit;
      $Data['dCreatedDate'] = date('Y-m-d H:i:s');
	   $Data['vFromIP'] = $_SERVER['REMOTE_ADDR'];
		$stsdtls = $statusmasterObj->getDetails('iStatusID'," AND eFor='Invoice' AND vStatus_en='Create' ");

		if($reqVerification == 'Yes')
			$Data['iStatusID'] = 0;
		else
			$Data['iStatusID'] = $stsdtls[0]['iStatusID'];

      $Data['iSupplierOrganizationID'] = $curORGID;
		$Data['iSupplierID'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
		$Data['vSupplierContactParty'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_NAME'];

		$supplierOrgDtls = $orgObj->select($curORGID);
		$Data['vSupplierName'] = $supplierOrgDtls[0]['vCompanyName'];
		$Data['vSupplierAddLine1'] = $supplierOrgDtls[0]['vAddressLine1'];
		$Data['vSupplierAddLine2'] = $supplierOrgDtls[0]['vAddressLine2'];
		$Data['vSupplierZipCode'] = $supplierOrgDtls[0]['vZipcode'];
		$Data['vSupplierState'] = $supplierOrgDtls[0]['vState'];
		$Data['vSupplierCountry'] = $supplierOrgDtls[0]['vCountry'];
		$Data['vInvoiceSupplierCode'] = $supplierOrgDtls[0]['vOrganizationCode'];
		$Data['vSupplierContactTelephone'] = $supplierOrgDtls[0]['vPhone'];
		$vItmCode = $pohObj->getUniqueCode();
		$Data['vInvoiceCode'] = $vItmCode;
		$vInvoiceNumber = "INV".$vItmCode."-".trim($Data['vInvoiceSupplierCode']);
		$Data['vInvoiceNumber'] = $vInvoiceNumber;
		if(trim($Data['eSaved']) == '') {
			$Data['eSaved'] = 'No';
		}
      $pohObj->setAllVar($Data);
      $dup = $pohObj->chkDuplicate('vInvoiceNumber',$Data);
		// prints($Data); exit;
      if($dup > 0){
        $ids = $pohObj->updateData($Data, " iInvoiceID = $dup ");
        $id = $dup;
		  if($ids>0) {
			$scs = 'y';
		  }
        //Prints("upd->".$id);
      }else{
        $id = $pohObj->insert();
		  if($id>0) {
			$scs = 'y';
		  }
        //Prints("insrt->".$id);
      }
      if($id>0) {
      	$Data_pref['iInvoiceID'] = $id;
      	$rs = $ioprefObj->insert($Data_pref);
      }
      if($val['items']){
         $ItemArr = $val['items'];
      }else{
         $ItemArr = $itemval[$key];
      }

      if(is_array($ItemArr)) {
         foreach($ItemArr as $itemkey=>$itemvals) {
            $Data_item = array();
            $it=0;
            foreach($itemTagArr as $itemkey1=>$itemval1){
               if($type == '.xml'){
                  $itemkey1 = strtolower(str_replace(" ","",$itemkey1));
                  $Data_item[$itemval1]=trim($itemvals[$itemkey1]);
               }else{
                  $Data_item[$itemval1]=trim($itemvals[$it]);
               }
               $it++;
            }
				if($enc == 'y') {
					foreach($Data_item as $k => $v) {
						$Data_item[$k] = $encobj->mdecrypt($v);
					}
				}
				$itmCode = $poLineObj->getUniqueCode();
				$Data_item['vItemCode'] = $itmCode;
            $Data_item['dCreatedDate'] = date('Y-m-d H:i:s');
            $Data_item['iInvoiceID'] = $id;
				$Data_item['iLineNumber'] = $generalobj->UniqueID("",PRJ_DB_PREFIX."_invoice_detail_line","iLineNumber",$charlimit="10");
            $poLineObj->setAllVar($Data_item);
            $dupit = $poLineObj->chkDuplicate('iLineNumber',$Data_item);
            if($dupit > 0){
              $id_items = $poLineObj->updateData($Data_item, " iInvoiceLineID = $dupit ");
              $id_items= $dupit;
            }else{
              $id_items = $poLineObj->insert();
            }
         }
      }
   }
}
if($scs == 'y') {
	$var_msg = 'invimportsucc';
} else {
	$var_msg = 'invimporterr';
}
@unlink($filepath);
?>
<?php
header("Location:".SITE_URL."importinvoice/$var_msg");
exit;
?>