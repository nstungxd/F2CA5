<?php  
$nstart   	= $_GET['nstart'];
$start   	= $_GET['start'];
$pg_limit 	= 3;
$rec_limit 	= $REC_LIMIT;
$num_tmp 	= 0;
$var_flg 	= "0";
$var_limit 	= "";
$num_limit 	= 0; 
$var_filter = "";

//CODE FOR EXTRA VARIABLES
	foreach ($_GET as $key=>$val)
	{
		if($key != "stat" && $key != "start" && $key != "nstart" && $key != "tempvar" && $key != "sorton")
		$var_filter.= "&$key=".stripslashes($val);
	}

   if(isset($start)){
       $num_limit = ($start-1)*$rec_limit;
	   $var_limit = " LIMIT $num_limit,$rec_limit"; 
   }else $var_limit = " LIMIT 0,$rec_limit";

   if(!isset($nstart)){
       if($num_totrec){ //if recs exists!!
		   if($rec_limit>$num_totrec){
	 	       $num_pgs = 1;
			   $var_flg = "2";
		   }else{
		       $num_loopctr =0;
				$num_loopctr = ceil($num_totrec/$rec_limit);
		       if($pg_limit>$num_loopctr){
			     $num_pgs = $num_loopctr;
				  $var_flg = "2";
		       }else{
			      $num_pgs = $pg_limit;
		 	      if($num_totrec<=($rec_limit*$pg_limit)) $var_flg = "2";
		   else $var_flg = "1";
		       }
		   }
		   $var_link = "";
		   $var_prevlink ="";
		   //if sorting is set
		   $var_sort_link="";
		   if(isset($sorton)) $var_sort_link = "&sorton=$sorton";

		   for($i=1;$i<=$num_pgs;$i++){
		      $var_link.= "<a href=\"$PHP_SELF?nstart=1&start=$i$var_filter$var_sort_link$var_extra\" class=greylink-normal>$i</font></a>";
           }
		   if($var_flag !="0" and $var_flg!="2"){ $var_link .= "<a href=\"$PHP_SELF?nstart=2&start=$i$var_filter$var_filter$var_sort_link$var_extra\" class=greylink-normal><font class=paging>Older </font></a>"; }else {$var_link .= " ";
           }
		   $page_link = "";
		   $page_link = "$var_prevlink $var_link";
	   }else{ 
	     //IF NO RECORDS EXISTS!!
		 $var_link="";
       }
   }else{ //if nstart is set
	   if($num_totrec){ //if recs exists!!
	       $num_loopctr =0;
		   $num_rem_rec = 0;
		   $num_rem_rec = ($num_totrec-(($nstart-1)*$rec_limit*$pg_limit));
	       $num_loopctr = ceil($num_rem_rec/$rec_limit);
			$num_tmp = $rec_limit*$nstart*$pg_limit;
	       if($num_tmp>$num_totrec){
				$num_pgs = $num_loopctr;
			   $var_flg = "2";
		   }else{
			   $num_pgs = $pg_limit;
			   if($num_totrec==($nstart*$rec_limit*$pg_limit)) $var_flg = "2";
			   else $var_flg = "1";
		   }

		   $var_link = "";
		   $var_prevlink ="";
   		   //if sorting is set
		   $var_sort_link="";
		   if(isset($sorton)) $var_sort_link = "&sorton=$sorton";
		   $num_prevnstart = 0;
		   $num_prevstart = 0;
		   $num_prevnstart = $nstart-1;
		   $num_prevstart = ($nstart*$pg_limit)-$pg_limit;
		   $num_tmp = ($num_totrec/$rec_limit);
		   if($nstart<=1) $var_prevlink ="";
           else $var_prevlink ="<a href=\"$PHP_SELF?nstart=$num_prevnstart&start=$num_prevstart$var_filter$var_sort_link$var_extra\" class=greylink-normal>Newer</a>";  
		   for($i=1;$i<=$num_pgs;$i++){
		      $num_start =  $num_prevstart+$i;
			  $num_nstart = $nstart+1;
		      $var_link.= "<a href=\"$PHP_SELF?nstart=$nstart&start=$num_start$var_filter$var_sort_link$var_extra\" class=greylink-normal>$num_start</a>";
           }
		   $num_start++;
		   if($var_flag!="0" and $var_flg!="2"){ $var_link .= "<a href=\"$PHP_SELF?nstart=$num_nstart&start=$num_start$var_filter$var_sort_link$var_extra\" class=greylink-normal>Older ›</a>"; }else {$var_link .= "&nbsp;";
           } 		   		   		   
		   $page_link = "";
		   $page_link = "$var_prevlink $var_link";
       }else{ 
	     //IF NO RECORDS EXISTS!!
	     $var_link="";
       }
  }

if(isset($nstart)) $var_pgs = "&nstart=$nstart&start=$start";
?>