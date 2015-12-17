<?php
$row = 1;
$data_time = file_get_contents('configfiles/timezone.dct');
$s = "\n";
$mat = preg_match_all("/($s.*)/",$data_time,$matched);
$opt = '';
$matcheds = $matched[0];

$DEFAULT_TIME = (isset($_POST['DEFAULT_TIME'])?$_POST['DEFAULT_TIME']:"");

//echo $DEFAULT_TIME;exit;
if(count($matcheds) > 0){    
    foreach($matcheds as $key=>$var){
        if(trim($var) != ''){
            if(trim($DEFAULT_TIME) == trim($var)){
                //echo "sa";exit;
                $selval = "selected";
            }else{
                $selval = "";
            }
            $opt.= "<option ".$selval." value='".trim($var)."'>".trim($var)."</option>";    
        }        
    }
}
//echo $opt;exit;
?>