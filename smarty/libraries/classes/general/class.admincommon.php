<?php  
/**
 * Common Class for Admin Panel
 * @package		class.admincommon.php
 * @general		general
 * @author		Andrew Dev
*/

Class AdminCommon
{
	public function __construct()
  {
  }

	/**
	* @getRelation
	* @Get the Relation / Count onthe listing
	* @param 	$ID
	* @return	Require Fields
	*/
	public function getRelation($ID)
	{
		// $ID = 1;
	//return $_GET['tabfile'];
		global $adobj;
		switch($_GET['tabfile'])
		{
			case "faq":
					$result =  $adobj->getRelationArr("".PRJ_DB_PREFIX."_faq","iFaqId","","iFCId","".PRJ_DB_PREFIX."_faq_cate", "","vFCategory","No");
					break;
			case "loginhistory":
					$result =  $adobj->getRelationArr("".PRJ_DB_PREFIX."_login_history","iLLogsId","","iAdminId","".PRJ_DB_PREFIX."_administrator", "","concat(vFirstName,' ',vLastName)","No");
					break;
			case "state":
					$result =  $adobj->getRelationArr("".PRJ_DB_PREFIX."_state_master","iStateId","","iCountryId","".PRJ_DB_PREFIX."_country_master", "","vCountry","No");
					break;
		}
		//echo $ID;exit;
		for($i=0; $i<count($result); $i++)
		{
			//return $result[$i]['ID'];
			if($result[$i]['ID'] == $ID){
				if($result[$i]['total']){

					return $result[$i]['total'];
				}else{
					return $result[$i]['Name'];
				}
			}
		}
		return "---";
	}

	/**
	* @for geting the category type display into the product
	*/

	function getImage1($ID){
		switch($_GET['tabfile'])
		{
			case "newsletter":
				$img = "<a href='index.php?file=ge-sendnewsletter&view=edit&AX=Yes&parent=ge-newsletter&iNformatId=".$ID."'><img src='images/btn-send.gif' border='0'></a>";
			break;
		}
		return $img;
	}

	/**
	* @get Image(Button) on Ajax Listing
	* @$ID
	* @return	$img
	*/
	public function getImage($ID)
  {
		global $gdbobj;
		global $generalobj;
		switch($_GET['tabfile'])
		{//echo GetVar('iStateId');
			case "state":
				$img = "<a href='index.php?file=ge-city&view=index&AX=Yes&parent=ge-state&iStateId=".$ID."' class='top-nav-active'>View Cities</a>";
				break;
			case "city":
				$img = "<a href='index.php?file=ge-city&view=edit&AX=Yes&parent=ge-state&iCityId=".$ID."&iStateId=".GetVar('iStateId')."&addtype=zip' class='top-nav-active'>Add</a>";
				break;
			case "newsletter":
				$img = "<a href='index.php?file=ge-sendnewsletter&view=edit&AX=Yes&parent=ge-newsletter&iNformatId=".$ID."'><img src='images/btn-send-list.gif'  align='absmiddle' border='0' alt='Send Mail' style='cursor:pointer'></a>";
			break;
		}
		return $img;
	}



	/**
	* @checke Member is Active or not.
	* @return	true/false
	*/
	public function isActive($iAdminId)
	{
		global $dbobj;
		$sql_query = "SELECT eStatus FROM ".PRJ_DB_PREFIX."_administrator where iAdminId = '".$iAdminId."'";
		$db_sql = $dbobj->MySQLSelect($sql_query);
		if($db_sql[0]['eStatus'] == 'Active')
		{
			return true;
		}else{
			return false;
		}
	}

   /* Get Detail On Mouse Over on Listing*/
	function GetMouseOverDetail($compval)
       {
		global $dbobj;
		switch($_GET['tabfile'])
		{
			case "languagelebel":
				$sql ="SELECT iLabelId as ID,vName as title
						FROM ".PRJ_DB_PREFIX."_lang_lable
						WHERE vName = '".$compval."'";
				$hover_type	= 'languagelebel';
			break;
		}
		if($sql != ''){
			$dbsql = $dbobj->MySQLSelect($sql);
		}
		if(count($dbsql) > 0 && $dbsql != ''){
			$iId = $dbsql[0]['ID'];
			$vTitle.= '<span onmouseover="getCallTooltip(event,\''.$iId.'\',\''.$hover_type.'\')" onmouseout="hideTip()" style="cursor:pointer">';
			$vTitle.=$dbsql[0]['title'];
			$vTitle.='</span>';
		}else{
			$vTitle =  "---";
		}
		return $vTitle;
	}
}
?>