<?php
include(S_SECTIONS."/member/memberaccess.php");
if(!isset($imgObj)) {
	include_once(SITE_CLASS_GEN."class.imagecrop.php");
	$imgObj = new imagecrop();
}
if(!isset($pohObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.PurchaseOrderHeading.php");
	$pohObj =	new PurchaseOrderHeading();
}
if(!isset($poprefObj)) {
	include_once(SITE_CLASS_APPLICATION."user/class.PoOtherInformation.php");
	$poprefObj = new PoOtherInformation();
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
$row = 1;
//$type = $_POST['type'];
//$type = 'xml';
$img_file = $_FILES['importfile'];
$fileName = $imgObj->UploadFile('IMPORT_FILES_PATH','file','',$img_file,$OldImg);
$fileType = substr($fileName,-4);
//$fileurl =  $cfgimg['IMPORT_FILES_PATH']['file']['url']."/".$fileName;
$fileurl =  $cfgimg['IMPORT_FILES_PATH']['file']['url'].$fileName;
$filepath = $cfgimg['IMPORT_FILES_PATH']['file']['path'].$fileName;
$type = strtolower($fileType);
// echo $fileType; exit;
if ($type == ".jpg" || $type == "jpeg" || $type == ".png" || $type == ".gif" || $type == ".bmp") {
	$Data['dCreateDate'] = $Data['dOrderDate'] = date('Y-m-d H:i:s');
	$Data['vFromIP'] = $_SERVER['REMOTE_ADDR'];
	$Data['iModifiedByID'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
	$stsdtls = $statusmasterObj->getDetails('iStatusID'," AND eFor='PO' AND vStatus_en='Create' ");
	if($reqVerification == 'Yes')
		$Data['iStatusID'] = 0;
	else
		$Data['iStatusID'] = $stsdtls[0]['iStatusID'];
	//$Data['iStatusID'] = $stsdtls[0]['iStatusID'];
	$Data['iBuyerOrganizationID'] = $curORGID;
	$Data['iBuyerID'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
	$Data['vBuyerContactName'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_NAME'];

	$buyerOrgDtls = $orgObj->select($curORGID);
	$Data['vBuyerCode'] = $buyerOrgDtls[0]['vOrganizationCode'];
	$Data['vBuyerCompanyName'] = $buyerOrgDtls[0]['vCompanyName'];
	$Data['vBuyerContactTelephone'] = $buyerOrgDtls[0]['vPhone'];
	$Data['vBuyerContactEmail'] = $buyerOrgDtls[0]['vEmail'];
	$vItmCode = $pohObj->getUniqueCode();
	$Data['vPOCode'] = $vItmCode;
	$Data['vPONumber'] = "PO".$Data['vPOCode']."-".trim($Data['vBuyerCode']);
	if(trim($Data['eSaved']) == '') {
		$Data['eSaved'] = 'No';
	}
	// prints($Data); exit;
	$pohObj->setAllVar($Data);
	$iPOId = $pohObj->insert();
	$vImage = $imgObj->ImageUpload('PO','image',$iPOId,$_FILES['importfile'],'');
   $Dta['vImage'] = $vImage;
	$iPOId = $pohObj->updateData($Dta,"iPurchaseOrderID=$iPOId");

	$var_msg = 'poimportsucc';
	@unlink($filepath);
	header("Location:".SITE_URL."importpurchaseorders/$var_msg");
	exit;
}
$enc = $_POST['enctyp'];
// $enc = $encPO;
//if($enc == 'y')
//{
   $opf = $orgprefObj->getDetails('*'," AND iOrganizationID=$curORGID ");
	if($opf[0]['eSecureImportPO']=='Yes') {
		$enc = 'y';
	}
	$encKey=$opf[0]['vEncryptionKey'];
	$encAlgo = $opf[0]['eCryptAlgo'];
	$orgdt = $orgObj->select($curORGID);
	$code[] = $orgdt[0]['vOrganizationCode'].$orgdt[0]['iOrganizationID'];
	$code[] = $orgdt[0]['dCreatedDate'];
//}
$itmhd = "";
if(isset($encobj) && $encobj!='') {
	$encobj->setkey($encKey);
	$encobj->setAlgo($encAlgo);
	$encobj->setMode('');
	$iv = $encobj->setiv($code);
	// echo $iv; exit;
	$itmhd = $encobj->mencrypt('###items###');
} else {
	$itmhd = '###items###';
}
// echo $encobj->mdecrypt($itmhd);
// echo $itmhd; // exit;
$enc = $_POST['enctyp'];
if($enc!='y') {
	$enc = 'n';
}
//$file = SPATH_ROOT."/export_2010-05-07_13_49_54.csv";
//$file = SPATH_ROOT."/export_2010-05-07_13_49_54.xml";
//prints($poOrder);exit;
switch($type) {
   case ".xml":
      $fileget = file_get_contents($filepath);
      include_once(SITE_CLASS_GEN."class.xml2array.php");
		$xmltoarobj = new XmlToArray($fileget);
      $poOrder = $xmltoarobj->createArray();
      $reqVal = $poOrder['Dataroot']['purchaseorder'];
		// prints($reqVal); exit;
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
					// Prints($data);
              if($num > 0){
                  //Prints($data);
                  //Prints($itmhd);
                  if($data[0]==$itmhd){
                     //Prints("Items");
                  }

                  if($num > 1 || $data[0]=='###items###' || $data[0]==$itmhd){
                     //Prints($data);
                     //Prints($itemstarts);
                     if($data[0] == '###items###' || $data[0]==$itmhd){
                           //echo $itmhd; exit;
                           $itemstarts = '1';
                           //$itemstartsloop = '1';
                           //$item++;

                     }

							/* $pnm = $encobj->encryptText('po-num');
                     if($data[0] == 'po-num' || $data[0] == $pnm) {
                        $itemstarts = '0';
                        //$item++;
                     } */
							/*if($data[0] == $itmhd || $data[0] == $pnm) {
								$enc = 'y';
							}*/
                     for ($c=0; $c < $num; $c++)
							{
                       	if($row == 1){
                           $fileds[] = $data[$c];

                       	} else {
                              if($data[0]!='###items###' && $data[0]!=$itmhd) {
                                 //Prints($itemstarts);
                                 if($itemstarts == '1') {
                                    //Prints($lastRowId);
                                    if($itemrow == 0) {
                                       $eIncItem  = 'Yes';
                                       $itemfileds[] = $data[$c];
                                    } else {
                                       if(!in_array($data[$c],$itemfileds)) {
                                          //Prints($lastRowId."=>".$row);
                                          $values[$c] =$data[$c];
                                          $itemval[$lastRowId][$row][] = $data[$c];
                                          //Prints($itemval);
                                       }
                                    }
                                 }
                              }
                              // echo $data[$c]."<br/>";
                              if($itemstarts == '0' || $itemstarts == '2') {
                                 // if(!in_array($data[$c],$fileds)) {
                                    $invcode =$data[0];
                                    $values[$c] =$data[$c];
                                    $reqVal[$row][] = $data[$c];
                                    $lastRowId =$row;
                                 // }
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
          //exit;
          fclose($handle);
      }
   break;
}

//$reqVal = Recompile($reqVal);
/*Prints($fileds);
Prints($itemfileds);

Prints($reqVal);
Prints($itemval);
exit;*/
$scs = 'n';
// Prints($itemval);
// pr($reqVal); exit;
if(count($reqVal) > 0) {
         if(!isset($poLineObj)) {
         	include_once(SITE_CLASS_APPLICATION."user/class.PurchaseOrderLine.php");
         	$poLineObj =	new PurchaseOrderLine();
         }
			if(!isset($orgUsrObj)) {
				require_once(SITE_CLASS_APPLICATION."user/class.OrganizationUser.php");
				$orgUsrObj = new OrganizationUser();
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
						$pref_ary = array('tSourcingDocument','tGlobalAgreement','tPaymentTerms','tFOB','tDeliveryTerms','tShippingControl','tConditionsForPayment','tPenalties','tSpecialInstruction','tNote');
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
                           'grand-total' => 'fPOTotal',
                           'bill-to-code' => 'vBillToParty',
                           'ship-to-code' => 'vShipToParty'
                         );*/
         $itemTagArr  = array(
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
								);
			// prints($reqVal); exit;
         foreach($reqVal as $key=>$val) {
				// prints($val); exit;
            $Data = array();
            $i=0;
            foreach($TagArr as $key1=>$val1) {
               if($type == '.xml') {
                  $key1 = strtolower(str_replace(" ","",$key1));
                  $Data[$val1]=$val[$key1];
               } else {
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
				//
				for($l=0;$l<count($pref_ary);$l++) {
					$Data_pref[$pref_ary[$l]] = $Data[$pref_ary[$l]];
					unset($Data[$pref_ary[$l]]);
				}
				// prints($Data); exit;
            $Data['dCreateDate'] = date('Y-m-d H:i:s');
      	   $Data['vFromIP'] = $_SERVER['REMOTE_ADDR'];
				$stsdtls = $statusmasterObj->getDetails('iStatusID'," AND eFor='PO' AND vStatus_en='Create' ");
				if($reqVerification == 'Yes')
     				$Data['iStatusID'] = 0;
            else
					$Data['iStatusID'] = $stsdtls[0]['iStatusID'];
     			//$Data['iStatusID'] = $stsdtls[0]['iStatusID'];
				$Data['iBuyerOrganizationID'] = $curORGID;
				$Data['iBuyerID'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
				$Data['vBuyerContactName'] = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_NAME'];

				$buyerOrgDtls = $orgObj->select($curORGID);
				$Data['vBuyerCode'] = $buyerOrgDtls[0]['vOrganizationCode'];
				$Data['vBuyerCompanyName'] = $buyerOrgDtls[0]['vCompanyName'];
				$Data['vBuyerContactTelephone'] = $buyerOrgDtls[0]['vPhone'];
				$Data['vBuyerContactEmail'] = $buyerOrgDtls[0]['vEmail'];
				$vItmCode = $pohObj->getUniqueCode();
				$Data['vPOCode'] = $vItmCode;
				$Data['vPONumber'] = "PO".$Data['vPOCode']."-".trim($Data['vBuyerCode']);
				if(trim($Data['eSaved']) == '') {
					$Data['eSaved'] = 'No';
				}
				//prints($Data); exit;
            $pohObj->setAllVar($Data);
            $dup = $pohObj->chkDuplicate('vPONumber',$Data);

            if($dup > 0) {
              $ids = $pohObj->updateData($Data, " iPurchaseOrderID = $dup ");
              $id = $dup;
				  if($ids>0) {
					$scs = 'y';
				  }
              //Prints("upd->".$id);
            } else {
              $id = $pohObj->insert();
				  if($id>0) {
					$scs = 'y';
				  }
              //Prints("insrt->".$id);
            }
            if($id>0) {
            	$Data_pref['iPurchaseOrderID'] = $id;
            	$rs = $poprefObj->insert($Data_pref);
            }
            //
            if($val['items']){
               $ItemArr = $val['items'];
            }else{
               $ItemArr = $itemval[$key];
            }

            if($ItemArr) {
               foreach($ItemArr as $itemkey=>$itemvals){
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
                  $Data_item['dETA'] = date('Y-m-d H:i:s');
                  $Data_item['iPurchaseOrderID'] = $id;
                  $Data_item['iLineNumber'] = $generalobj->UniqueID("",PRJ_DB_PREFIX."_purchase_order_line","iLineNumber",$charlimit="10");
                  $poLineObj->setAllVar($Data_item);
                  $dupit = $poLineObj->chkDuplicate('iLineNumber',$Data_item);
                  if($dupit > 0) {
                    $id_items = $poLineObj->updateData($Data_item, " iOrderLineID = $dupit ");
                    $id_items= $dupit;
                  } else {
                    $id_items = $poLineObj->insert();
                  }
               }
            }
         }
      }
if($scs == 'y') {
	$var_msg = 'poimportsucc';
} else {
	$var_msg = 'poimporterr';
}
@unlink($filepath);
?>
<?php
header("Location:".SITE_URL."importpurchaseorders/$var_msg");
exit;
?>