<?php  
include(SITE_CLASS_GEN."class.xmlparser.php");
$parseObj=new xmlparser;
$exist = 0;
$mode 		=	str_replace("|repadn|","?",GetVar('mode'));
$table 		=	@explode(',',GetVar('table'));
$Field_val 	=	str_replace("|repadn|","?",GetVar('val'));
$comp_Field =	str_replace("|repadn|","?",GetVar('compid'));

$iPrimId 	=	str_replace("|repadn|","?",GetVar('primeid'));
$primeId_val =	str_replace("|repadn|","?",GetVar('primeval'));
$tableprimid =	@explode(',',GetVar('tableprimid'));
$Thrtype	=  		str_replace("|repadn|","?",GetVar('Thrtype'));
$vEmail = str_replace("|repadn|","?",GetVar('vEmail'));
$vUserName = str_replace("|repadn|","?",GetVar('vUserName'));

$eType 	=	str_replace("|repadn|","?",GetVar('eType'));
$eSection =	str_replace("|repadn|","?",GetVar('eSection'));
$vQuestion =	str_replace("|repadn|","?",GetVar('vQuestion'));
$iUserId = str_replace("|repadn|","?",GetVar('iUserId'));
$iPercentage = str_replace("|repadn|","?",GetVar('iPercentage'));

$exist = 0;
$extra_query ="";

if($vEmail != '' && $vUserName != '')
{
    $sql = "select iMemberId,if((vEmail='".$vEmail."'),'vEmail','vUserName') as field from ".$table[0]." where vEmail='".$vEmail."' or vUserName =  '".$vUserName."'";

		$db_exist = $dbobj->MySQLselect($sql);
		if(count($db_exist) > 0)
		{
			$exist = 1;
			$comp_Field = $db_exist[0][field];
		}else
		{
			$comp_Field = 'no';
		}
}else if($iUserId != '' && $iPercentage != '' && $mode == "add"){
    $sql = "select iUserId as field from ".$table[0]." where iUserId='".$iUserId."' or iPercentage =  '".$iPercentage."'";
		$db_exist = $dbobj->MySQLselect($sql);
       
		if(count($db_exist) > 0)
		{
			$exist = 1;
			$comp_Field = 'iPercentage';
		}
}else
{

	$Field_val 	= str_replace("|repadn|","?",$Field_val);
	for($i=0;$i<count($table);$i++)
   {
		if($mode == "edit")
      { 
			if($vEmail != '')
         {
			 $fileds = 'vEmail';

			 $join="vEmail='".$vEmail."' AND";
			 $sql = "select ".$fileds." from ".$table[$i]." where ".$join." ".$iPrimId." <> ".$primeId_val."  ".$extra_query." ";

			 $db_exist = $dbobj->MySQLselect($sql);
			 if(count($db_exist) > 0){
    			     $comp_Field = 'vEmail';
                     $exist = $exist+1;
    			 }elseif($vUserName != ''){
    			  $fileds = 'vUserName';

			      $join="vUserName='".$vUserName."' AND";
			      $sql = "select ".$fileds." from ".$table[$i]." where ".$join." ".$iPrimId." <> ".$primeId_val."  ".$extra_query." ";

			      $db_exist1 = $dbobj->MySQLselect($sql);
                   if(count($db_exist) > 0){
                    $comp_Field = 'vUserName';
                     $exist = $exist+1;
                   }else{
                    $comp_Field = 'vUserName';
                   }
    			 }
			}else if($iUserId != '' && $iPercentage != ''){
			     $join="(iUserId='".$iUserId."' OR iPercentage ='".$iPercentage."') AND";
			     $sql = "select iUserId as field from ".$table[$i]." where ".$join." ".$iPrimId." <> ".$primeId_val."  ".$extra_query." ";
                //echo $sql;exit;
                 $db_exist = $dbobj->MySQLselect($sql);
            		if(count($db_exist) > 0)
            		{
            			$exist = 1;
            			$comp_Field = 'iPercentage';
            		}
			}
         else
         {
            if(strpos($comp_Field,",") !== false)
            {
               $flds = @explode(",",$comp_Field);
               $vls = @explode(",",$Field_val);
               $join = '';
               for($l=0; $l<count($flds); $l++)
               {
                  if($l != (count($flds)-1))
                  {
                     $join .= $flds[$l]."='".$vls[$l]."' AND ";
                  }
                  else
                  {
                     $join .= $flds[$l]."='".$vls[$l]."'";
                  }
               }
               //echo $join;
               $fileds = $comp_Field;
               //prints($flds); exit;
            }
				else if($comp_Field != '')
            {
					$join = "".$comp_Field."='".$Field_val."'";
					$fileds=$comp_Field;
				}
            else
            {
					$join = "1 AND";
					$fileds = "*";
				}
			     $sql = "select ".$fileds." from ".$table[$i]." where ".$join." AND ".$iPrimId." <> ".$primeId_val."  ".$extra_query." ";
			}
			  //echo $sql;exit;
			 $db_exist = $dbobj->MySQLselect($sql);
         // print_r($db_exist); //exit;
         if(count($db_exist) > 0)
				$exist = $exist+1;
		}
      else
      {
            //echo $Field_val; exit;
            if(strpos($comp_Field,",") !== false)
            {
               $flds = @explode(",",$comp_Field);
               $vls = @explode(",",$Field_val);
               $join = '';
               for($l=0; $l<count($flds); $l++)
               {
                  if($l != (count($flds)-1))
                  {
                     $join .= $flds[$l]."='".$vls[$l]."' AND ";
                  }
                  else
                  {
                     $join .= $flds[$l]."='".$vls[$l]."'";
                  }
               }
               //echo $join;
               $fileds = $comp_Field;
               //prints($flds); exit;
            }
            else if($comp_Field != '')
            {
					$join = "".$comp_Field."='".$Field_val."' ";
					$fileds=$comp_Field;
				}else{
					$join = " 1";
					$fileds = "*";
				}

			if($vEmail != '')
         {
			 $fileds = 'vEmail';

			 $join="vEmail='".$vEmail."'";
			 $sql = "select ".$fileds." from ".$table[$i]." where ".$join ." ".$extra_query." ";

			 $db_exist = $dbobj->MySQLselect($sql);
			 if(count($db_exist) > 0){
    			     $comp_Field = 'vEmail';
                     $exist = $exist+1;
    			 }elseif($vUserName != ''){
    			  $fileds = 'vUserName';

			      $join="vUserName='".$vUserName."'";
			      $sql = "select ".$fileds." from ".$table[$i]." where ".$join ." ".$extra_query." ";

			      $db_exist1 = $dbobj->MySQLselect($sql);
                   if(count($db_exist) > 0){
                    $comp_Field = 'vUserName';
                     $exist = $exist+1;
                   }else{
                    $comp_Field = 'vUserName';
                   }
    			 }
			}
         else
         {
            // echo $join; exit;
				$sql = "select ".$fileds." from ".$table[$i]." where ".$join ." ".$extra_query." ";
			}

            // echo $sql;exit;
				$db_exist = $dbobj->MySQLselect($sql);
					// print_r(count($db_exist));
					if(count($db_exist) > 0)
					$exist = $exist+1;
		}

	}
}
if($comp_Field == '')
{
	$comp_Field = '-';
}
// exit;
$xmlcontent ='<?xml version="1.0"?><list>';
$xmlcontent .='<exist>'.$exist.'</exist>';
$xmlcontent .='<field>'.$comp_Field.'</field>';
$xmlcontent.='</list>';
// exit;
$parseObj = new xmlparser();
$parseObj->output_xml($xmlcontent);

exit;

?>