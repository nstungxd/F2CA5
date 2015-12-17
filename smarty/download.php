<?php
/**
 * @author Andrew
 * @copyright 2010
 */
define('SPATH_BASE', dirname(__FILE__) );

$public_path  = "public_html/";
$www_path  = "www/";
$www_path_wamp  = "www";

$pos = strrpos(SPATH_BASE,$public_path);
$exp = @explode($public_path,SPATH_BASE);

$pos1 = strrpos(SPATH_BASE,$www_path);
$exp1 = @explode($www_path,SPATH_BASE);

$pos2 = strrpos(SPATH_BASE,$www_path_wamp);
$exp2 = @explode($www_path_wamp,SPATH_BASE);

if ($pos == true) {
    $folderPath = '/'.$exp[1].'/';
}elseif($pos1 == true){
    $folderPath = '/'.$exp1[1].'/';
}elseif($pos2 == true){
    $fchar = substr($exp2[1],0,1);
    $fchar_rep = substr($exp2[1],1);
    if(!ctype_alpha($fchar)){
        $folderPath = '/'.$fchar_rep.'/';
    }else{
        $folderPath = '/'.$exp2[1].'/';    
    }
}else{
    $folderPath =SPATH_BASE; 
}
$folderPath = str_replace('\\','/',$folderPath);

$type   = $_GET['type'];
if($type == 'triggers'){
    $filename = 'triggers.sql';
    $sqlfilename	=	SPATH_BASE."/SQL/triggers.sql";
}elseif($type == 'storeprocedure'){
    $sqlfilename	=	SPATH_BASE."/SQL/storeprocedure.sql";
    $filename = 'storeprocedure.sql';
}
$handle_s = fopen($sqlfilename, "r");    
$contents_sql = file_get_contents($sqlfilename);
$mime = 'application/download';
header('Content-type: '.$mime);
header('Content-Disposition: attachment; filename='.$filename.'');
header('Content-Transfer-Encoding: binary');
header("Expires: 0");
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
echo $contents_sql;
exit;
?>