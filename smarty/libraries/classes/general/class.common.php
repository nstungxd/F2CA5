<?php  
/*
 * @package  Common Class
 * @Created Date : 20/12/18 (dd/mm/yy)
 * Description:
   This is Common Functionlity Class that is Used for Front in All sections
------------------------------------------------------------------------------
**/
class Common
{
	public function __construct(){}

	//get All banner related to this page
	public function getbanners($file)
	{
		global $dbobj,$generalobj;
		//echo "<pre>";
		//print_r($_GET);exit;
		$var	=	explode("-",$file);
		$prefix	=	$var[0];

		if($file == ''){
			$file = 'c-home';
		}
		if($prefix == 'cus'){
			$file = 'cus';
		}
		$sql = "SELECT cli.iBannerId,cli.vBTitle,cli.eType,
						cli.vBImage,cli.tCustomCode,cli.vBURL,cli.vBTitle,cli.ePosition,
						clipr.iPRId,clipr.iPageId,clipr.iBannerId,clipr.eSpot,csfp.iPageId,
						csfp.vSecPageName,csfp.vPageName
						from ".PRJ_DB_PREFIX."_site_front_pages csfp,".PRJ_DB_PREFIX."_banner cli
						LEFT JOIN ".PRJ_DB_PREFIX."_site_banner_page_rel clipr ON(clipr.iBannerId = cli.iBannerId)
						where cli.eStatus = 'Active'
						AND csfp.vSecPageName = '".$file."'
						AND csfp.iPageId = clipr.iPageId
						ORDER BY clipr.eSpot";
		$db_sql = $dbobj->MySQLSelect($sql);
		$i=0;
		foreach($db_sql as $db_sql){
		//for($i=0;$i<count($db_sql);$i++){
			$first4Char = substr($db_sql['vBURL'],0,7);
				if($first4Char != 'http://'){
					$reqUrl = "http://".$db_sql['vBURL'];
				}else{
					$reqUrl = $db_sql['vBURL'];
				}
			if($db_sql['eType'] == 'Image'){
				$imgarr = array("id"=>$db_sql['iBannerId'],	"name"=>$db_sql['vBImage'],"type" => "image","section" =>"banner");
				$imgArr = $generalobj->ShowImage($imgarr);

				if($db_sql['ePosition']  == 'Left'){
					$ReqimgArr = $imgArr[1];
				}elseif($db_sql['ePosition']  == 'Middle'){
					$ReqimgArr = $imgArr[2];
				}

				if($ReqimgArr != ''){
					if(substr($ReqimgArr,-3) == 'swf'){
						$banner =  "<a href='".$reqUrl."' class='img-border' target='_blank'><object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0' width='100%' title='sss'><param name='movie' value='".$ReqimgArr."' /><param name='quality' value='high' /><param name='autoplay'  value='true' /><embed src='".$ReqimgArr."' quality='high'  width='230' loop='true'  pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash'></embed></object></a>";
					}else{
						$banner =  "<a href='".$reqUrl."'  target='_blank'><img src='".$ReqimgArr."'  title='".$db_sql['vBTitle']."' style='border:0px' class='img-border'></a>";
					}

				}
			}elseif($db_sql['eType'] == 'Custom'){
				$banner =  $db_sql['tCustomCode'];
			}

			$bannerarr[$i]['spot'] 		= $db_sql['eSpot'];
			$bannerarr[$i]['banner'] 	= $banner;
			$bannerarr[$i]['ePosition'] 	= $db_sql['ePosition'];
		$i++;
		}
		return $bannerarr;
	}

	public function getListPG($total,$limit,$pg,$id='',$pgnm,$fn='')
   {
      $pgmsg = '';

      if($pg == '' || $pg == 0)
      {
         $pg = 1;
      }

      // echo $total.'-'.$limit; exit;
      $totalpg = ceil($total/$limit);
      // echo $totalpg; exit;

      if($totalpg > 1)
      {
         $pgmsg .= '<ol id="pagination">';
         if($pg <= 10)
            $st = 1;
         else
            $st = (int) (($pg/10)+10);
         $lp = ((($st-1)+10) >= $totalpg)? $totalpg : (($st-1)+10);
         $prv = ($pg-1);
         $nxt = ($pg+1);

         if($pg > 1)
         {
            //$pgmsg .= "<li $class><a href='".SITE_URL_DUM.$pgnm."/$id/$prv' style='cursor:pointer;'>Previous</a></li>";
            $pgmsg .= "<li class='currentpage'><input class='btnclass' name='prev' id='prev' type='submit' value='Previous' style='width:59px;'/></li>";
//          break;
         }
         for($l=$st;$l<=$lp;$l++)
         {
            $class = '';
            if($l == $pg)
            {
               $class = "class='currentpage'";
            }
            if(trim($id) != '')
            {
               //$pgmsg .= "<li $class><a href='".SITE_URL_DUM.$pgnm."/$id/$l' style='cursor:pointer;'>$l</a></li>";
               $pgmsg .= "<li $class><input type='submit' name='pg' id='pg' class='btnclass' value='".$l."' /></li>";
            }
            else
            {
               //$pgmsg .= "<li $class><a href='".SITE_URL_DUM.$pgnm."/$l' style='cursor:pointer;'>$l</a></li>";
               $pgmsg .= "<li $class><input type='submit' class='btnclass' value='".$l."' /></li>";
            }
         }
         if($pg < $totalpg)
         {
            //$pgmsg .= "<li $class><a href='".SITE_URL_DUM.$pgnm."/$id/$nxt' style='cursor:pointer;'>Next</a></li>";
            $pgmsg .= "<li class='currentpage'><input class='btnclass' name='next' id='next' type='submit' value='Next' style='width:39px;' /></li>";
//          break;
         }
         // $pgmsg .= "<li class='currentpage' style='float:right;'><a>[$pg".'/'."$totalpg]</a></li>";
         $pgmsg .= '</ol>';
      }  // onclick='gotopage($l);'
      return $pgmsg;
   }

	function GetLanguages()
   {
      global $dbobj;
      $sql = "SELECT iLanguageId,vLanguage,vLanguageCode,eStatus
                  from ".PRJ_DB_PREFIX."_language
						where eStatus = 'Active'
						ORDER BY vLanguage";
		$db_sql = $dbobj->MySQLSelect($sql);
      return $db_sql;
   }
   
}
?>