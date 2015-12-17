<?php
/**
 * This Class is useful for Permission User wise
 * @package		class.acessrights.php
 * @general		general
 * @author		Jack Scott
 */

class AccessRights
{
	public function __construct(){

		$this->accesspages = $this->getAdminAccessmodules();
		$this->getUniqueAccessmod();
		$this->GetAdminAccess();
	}

	/* DBGeneral::gerAccesspagesArray()
	 * @Return access unique pages array
	 * @param
	 * @return	unique modules ID array
	 */
	public function gerAccesspagesArray(){
		return $this->uniqReqMod;
	}

	/* DBGeneral::getUniqueAccessmod()
	 * @Get Logged admin Access module Unique IDs (i.e it combine all the accessed Id
	 	and make them combine if exists more that once)
	 * @param
	 * @return	unique modules ID array
	 */
	public function getUniqueAccessmod(){
		global $generalobj;
		$tListingArr = @explode(',',$this->accesspages[0]['tListing']);
		$tAddArr = @explode(',',$this->accesspages[0]['tAdd']);
		$tUpdateArr = @explode(',',$this->accesspages[0]['tUpdate']);
		$tDeleteArr = @explode(',',$this->accesspages[0]['tDelete']);
		$tActiveArr = @explode(',',$this->accesspages[0]['tActive']);
		$tInactiveArr = @explode(',',$this->accesspages[0]['tInactive']);
		$tBlockArr = @explode(',',$this->accesspages[0]['tBlock']);
		$tSearchArr = @explode(',',$this->accesspages[0]['tSearch']);

		$blank = @explode(',',"");

		$result_array = array_unique(array_merge($tListingArr, $tAddArr,$tUpdateArr,$tDeleteArr,$tActiveArr,$tInactiveArr,$tBlockArr,$tSearchArr));

		$uniqReqMod = $generalobj->RecompileArray($result_array);
		$this->uniqReqMod = array_diff($uniqReqMod, $blank);

		return $result_array;
	}

	/* DBGeneral::GetAdminAccess()
	 * @Get Admin Access pages
	 * @param 	$CombArr
	 * @return	Admin Access pages
	 */
	public function  GetAdminAccess(){

		//Get Current module Information
		$moduleInfo = $this->getModuleInfo();
		//print_r($moduleInfo);exit;
        $iModuleId = (isset($moduleInfo[0]["iModuleId"]))? $moduleInfo[0]["iModuleId"] : '';
		//$iModuleId = $moduleInfo[0]["iModuleId"];

		//get All Accedss module Id of the logged in Admin
		$accmodulearr = $this->accesspages;
		//print_r($accmodulearr);
		$dispview = $this->dispview;
		//Prints($dispview);exit;

		$urlprefix = @explode("-",$_GET['file']);
		//Prints($_GET['view']);exit;
		/*
		if($urlprefix[0] != "aj" && $_GET['file'] != 'ge-noaccess'){
			if($dispview == 'index'){
				$listing = @explode(',',$accmodulearr[0]['tListing']);

				if(!@in_array($iModuleId,$listing)){
					header("Location:index.php?file=ge-noaccess&view=add&AX=Yes");
					exit;
				}
			}elseif($dispview == 'add'){
				$addstr = @explode(',',$accmodulearr[0]['tAdd']);

				if(!@in_array($iModuleId,$addstr)){
					header("Location:index.php?file=ge-noaccess&view=add&AX=Yes");

					exit;
				}
			}elseif($dispview == 'edit'){
				$updatestr = @explode(',',$accmodulearr[0]['tUpdate']);

				if(!@in_array($iModuleId,$updatestr)){
					header("Location:index.php?file=ge-noaccess&view=add&AX=Yes");
					exit;
				}
			}
		}*/

	}

	/* DBGeneral::getAdminAccessmodules()
	 * @Get Logged admin Access modules info
	 * @param
	 * @return	Admin Access modules array
	 */

	public function getAdminAccessmodules(){
		global $dbobj;
		/*$sql_access = "SELECT tListing,tAdd,tUpdate,tDelete,tActive,tInactive,tBlock,tSearch,iAdminId
						FROM ".PRJ_DB_PREFIX."_acc_mod_per
						WHERE iAdminId='".$_SESSION[''.PRJ_CONST_PREFIX.'_SESS_USERID']."'";*/
          $sql_access = "SELECT iModuleId
						FROM ".PRJ_DB_PREFIX."_modules
                              WHERE eStatus = 'Active'
						AND iParentId != 0";
		$db_access = $dbobj->MySQLSelect($sql_access);

          for($i=0;$i<count($db_access);$i++) {
               $access[$i] = $db_access[$i]['iModuleId'];
          }
          $str = @implode(",",$access);

          $db_access_page[0]['tListing'] = $str;
          $db_access_page[0]['tAdd'] = $str;
          $db_access_page[0]['tUpdate'] = $str;
          $db_access_page[0]['tDelete'] = $str;
          $db_access_page[0]['tActive'] = $str;
          $db_access_page[0]['tInactive'] = $str;
          $db_access_page[0]['tBlock'] = $str;
          $db_access_page[0]['tSearch'] = $str;

		return $db_access_page;
	}


	/* DBGeneral::getAccessModParent()
	 * @Get Logged admin Access Parent modules ID
	 * @param
	 * @return	Parent modules ID array
	 */
	public function getAccessModParent(){
		global $dbobj;
		$accesinfo = $this->accesspages;
		$sql_access = "SELECT iParentId,iModuleId,vLink
						FROM ".PRJ_DB_PREFIX."_modules
						WHERE eStatus = 'Active'
						AND (iModuleId IN(".@implode(',',$this->uniqReqMod)."))
						ORDER BY iParentId ASC";
		//GROUP BY iModuleId
		$db_access_page = $dbobj->MySQLSelect($sql_access);
		//Prints($db_access_page);exit;
		$temp = "";
		for($i=0;$i<count($db_access_page);$i++){
			if($temp != $db_access_page[$i]['iParentId']){
				$accessParentId[] = $db_access_page[$i]['iParentId'];
			}
			$temp = $db_access_page[$i]['iParentId'];
		}
		return $accessParentId;
	}


	/* DBGeneral::getAccessModUrls()
	 * @Get Logged admin Access modules Urls
	 * @param
	 * @return	Parent modules Urls array
	 */
	public function getAccessModUrls(){
		global $dbobj;
		$accesinfo = $this->accesspages;
		$sql_access = "SELECT iParentId,iModuleId,vLink
						FROm ".PRJ_DB_PREFIX."_modules
						WHERE eStatus = 'Active'
						AND (iModuleId IN(".@implode(',',$this->uniqReqMod)."))
						ORDER BY iParentId ASC";
		//GROUP BY iModuleId
		$db_access_page = $dbobj->MySQLSelect($sql_access);
		for($i=0;$i<count($db_access_page);$i++){
			$accessURLS[] = $db_access_page[$i]['vLink'];
		}
		return $accessURLS;
	}

	/* DBGeneral::getModuleInfo()
	 * @Get current module Information
	 * @param
	 * @return	Module Information
	 */
	public function getModuleInfo(){
		global $dbobj;
		$url = str_replace(SITE_FOLDER.ADMIN_FOLDER_CONST."/", "",$_SERVER['REQUEST_URI']);
		$url=  @explode("&",$url);

		$parenturl = @explode("=",$url[3]);
		if($parenturl[0] != ""){
			$this->parenturl = $parenturl[0];
		}else{
			$this->parenturl = "";
		}

        if(isset($url[3]) && $url[3] != '' && $parenturl[0] == 'parent'){
			$moduleurl = "index.php?file=".$parenturl[1];
		}else{
			$moduleurl = $url[0];
		}

		$label = array("ge-home","ge-settings","ge-backup","ge-source","ge-fullbkup","ge-restore","ge-help","ge-document","ge-access","ge-inbox","ge-comessage","ge-sentmails","ge-msgdetail","ge-noaccess","ge-sitemap");

		if(isset($_GET['file']) && in_array($_GET['file'],$label))
		{
			if($_GET['file'] == 'ge-source' || $_GET['file'] == 'ge-fullbkup' || $_GET['file'] == 'ge-restore'){
				$moduleurl = 'index.php?file=ge-backup';
			}
			if($_GET['file'] == "ge-inbox"  || $_GET['file'] == "ge-comessage" || $_GET['file'] == "ge-sentmails" || $_GET['file'] == "ge-msgdetail" || $_GET['file'] == "ge-noaccess"){
				$url = $moduleurl."&view=add&AX=Yes";
				$view = "add";
			}else{
				$url = $moduleurl."&view=edit&AX=Yes";
				$view = "edit";
			}
		}else{
			$url = $moduleurl."&view=index&AX=Yes";
			$view = GetVar('view');
		}
		//Prints($view);
		if($this->parenturl != ""){
			$this->dispview = $view;
		}else{

			$this->dispview = GetVar('view');
		}

		$sql_menu = "SELECT iParentId,iModuleId
					 FROM ".PRJ_DB_PREFIX."_modules
					 WHERE vLink='".$url."'
					 AND eStatus = 'Active'
					 AND iParentId <> '0'
					 order by iDisporder ASC";
		$db_menu_rs = $dbobj->MySQLSelect($sql_menu);

		return $db_menu_rs;
	}
}
?>