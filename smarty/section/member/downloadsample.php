<?php
//header("Content-Type: application/xml; charset=UTF-8");
ob_clean();
if(!$zip){
   require_once(SITE_CLASS_GEN."class.zip.php");
   $zip = new zipfile();
}
$type = $_GET['type'];

switch($type){
   case "PO":
      $html = file_get_contents(SAMPLE_FILES_PATH.'sample_po.xml');
      $csvcontent = file_get_contents(SAMPLE_FILES_PATH.'sample_po.csv');
   break;
   case "Invoice":
      $html = file_get_contents(SAMPLE_FILES_PATH.'sample_invoice.xml');
      $csvcontent =file_get_contents(SAMPLE_FILES_PATH.'sample_invoice.csv');
   break;
}

$timeval = date('Y-m-d_H_i_s');
$zip->add_file($html,'export_'.$timeval.'.xml');
$zip->add_file($csvcontent,'export_'.$timeval.'.csv');

//$filepath = $zip->file();

$mime = 'application/download';
header('Content-type: '.$mime);
header('Content-Disposition: attachment; filename=export.zip');
header('Content-Transfer-Encoding: binary');
header("Expires: 0");
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
echo $zip->file();
exit;
?>