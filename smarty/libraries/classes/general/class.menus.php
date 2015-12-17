<?php
/**
 * This Class is useful for menus
 * @package		class.menus.php
 * @general		general
 */

class Menus
{
	private $menuArr;
	private $subArr;
	private $totRec;
	private $dispMenu;
	private $qView;
	private $quicksubArr;
	private $quickmenuArr;

	public function __construct(){
          global $accessobj;
		//Get required Access module Array (Need to Check Extends class is not working)
		$this->reqmodules	= $accessobj->gerAccesspagesArray();
	}

	/**
	* @access	public
	* @Return Array of Menus from Modules table
	* @author		cyrus_dev@hotmail.com
	* @return	true/false
	*/
	public function GetTopMenu()
	{
		global $dbobj;
		$sql_menu = "SELECT iModuleId as iMenuId ,iParentId,vModuleName as vMenuDisplay,
					vLink as vURL,tModuleDesc FROM ".PRJ_DB_PREFIX."_modules where eStatus  = 'Active'
					order by iDisporder ASC  ";
		$db_menu_rs = $dbobj->MySQLSelect($sql_menu);
		return $db_menu_rs;
	}

	/**
	* @access	private
	* @Return Array of submenus from Modules table
    * @author	cyrus_dev@hotmail.com
	* @param menuid
	* @return	array
	*/
	private function getSubMenus($id)
	{
		global $generalobj;
		$this->menuArr =	$this->GetTopMenu();

		$this->totRec = count($this->menuArr);
		$k=0;
		$this->subArr = array();

		for($i=0;$i<$this->totRec;$i++)
		{
			if($this->menuArr[$i]['iParentId'] == $id)
			{
					$this->subArr[$k]['vURL']		 	=	$this->menuArr[$i]['vURL'];
					$this->subArr[$k]['vMenuDisplay']	=	$this->menuArr[$i]['vMenuDisplay'];
					$this->subArr[$k]['iMenuId']	 	=	$this->menuArr[$i]['iMenuId'];
					$this->subArr[$k]['iParentId']	 	=	$this->menuArr[$i]['iParentId'];
					$this->subArr[$k]['vImage']			=	(isset($this->menuArr[$i]['vImage']))? $this->menuArr[$i]['vImage'] : "";
					$this->subArr[$k]['eStatus']		=	(isset($this->menuArr[$i]['eStatus']))? $this->menuArr[$i]['eStatus'] : "";
				$k++;
			}
		}

		return $generalobj->RecompileArray($this->subArr);
	}

	/**
	* @access	private
	* @Return Array of parent from Modules table
	* @author	cyrus_dev@hotmail.com
	* @param menuid
	* @return	array
	*/
	private function parentModules()
	{
		global $generalobj,$accessobj;
		$this->menuArr =	$this->GetTopMenu();

		$this->totRec = count($this->menuArr);
		$k=0;
		$this->parentArr = array();

          //Get required Access parent modules Array (Need to Check Extends class is not working)
		$this->accessParent = $accessobj->getAccessModParent();
      //prints($this->accessParent); exit;
		for($i=0;$i<$this->totRec;$i++)
		{
			if($this->menuArr[$i]['iParentId'] == 0)
			{
                    if(@in_array($this->menuArr[$i]['iMenuId'],$this->accessParent)) {

					$this->parentArr[$k]['vURL']		 	=	$this->menuArr[$i]['vURL'];
					$this->parentArr[$k]['vMenuDisplay']	=	$this->menuArr[$i]['vMenuDisplay'];
					$this->parentArr[$k]['iMenuId']	 		=	$this->menuArr[$i]['iMenuId'];
					$this->parentArr[$k]['iParentId']	 	=	$this->menuArr[$i]['iParentId'];
					$this->parentArr[$k]['vImage']			=	(isset($this->menuArr[$i]['vImage']))?$this->menuArr[$i]['vImage']:"";
					$this->parentArr[$k]['eStatus']			=	(isset($this->menuArr[$i]['eStatus']))?$this->menuArr[$i]['eStatus']:"";
                    }
					$k++;
			}
		}

		//echo "<pre>";
		//print_r($this->parentArr);

		return $generalobj->RecompileArray($this->parentArr);
	}

	/**
	* @access	Public
	* @To Disply Top Menu
	* @author	cyrus_dev@hotmail.com
	* @param menuid
	* @return	array
	*/
	public function displayMenu()
	{
		$ArrMenu =	$this->parentModules();

		$url = str_replace(SITE_FOLDER.ADMIN_FOLDER, "",$_SERVER['REQUEST_URI']);

		$submenudetail = $this->getSubMenudetail();
		$subParentId = array();
    $subParentId[0] = (isset($subParentId[0]))? $subParentId[0] : '';
    
		for($s=0;$s<count($submenudetail);$s++){
			$Urlarr= explode("&",$submenudetail[$s]['vURL']);
			$subFullUrl[]= $submenudetail[$s]['vURL'];
			$subUrl[]= $Urlarr[0];
			$subModId[]= $submenudetail[$s]['iMenuId'];
			$subParentId[]= $submenudetail[$s]['iParentId'];
		}

		$url=  explode("&",$url);
		$parenturl = (isset($url[3]))?explode("=",$url[3]):"";
		if(isset($url[3]) && $url[3] != '' && $parenturl[0] == 'parent') {
			$moduleurl = "index.php?file=".$parenturl[1];
		} else {
			$moduleurl = $url[0];
		}
		$this->dispMenu = '';
				$this->dispMenu.= '  <table width="100%" border="0" cellspacing="0" cellpadding="0">';
				$this->dispMenu.= '  <tr>';
				for($j=0; $j<9; $j++)
				{
				    if(isset($ArrMenu[$j]) && is_array($ArrMenu[$j]) && count($ArrMenu[$j]) > 0) {
    					$reqSubMenu = $this->getSubMenus($ArrMenu[$j]['iMenuId']);
                        if(is_array($reqSubMenu)){
                            foreach($reqSubMenu as $reqsuburl){
        						$reqsuburls[]=$reqsuburl['vURL'];
        					}
        					//echo "<pre>";
        					//print_r($reqsuburls);
        					$te =explode("&",$reqSubMenu[0]['vURL']);
        					if(@in_array($te[0],$subUrl))
        						$class = "top-nav-active";
        					else
        						$class = "top-nav";

        					if($subParentId[0] == $ArrMenu[$j]['iMenuId']){
        						if(@in_array($ArrMenu[$j]['vURL'],$subFullUrl)){
        							$reqURL = $ArrMenu[$j]['vURL'];

        						}else{
        							$reqURL = $subUrl[0];
        						}
        					}else{
        						//echo "<pre>";
        						//print_r($ArrMenu[$j]['vURL']);
        						if(@in_array($ArrMenu[$j]['vURL'],$reqsuburls)){
        								$reqURL = $ArrMenu[$j]['vURL'];
        						}else{
        							//$reqURL = $reqSubMenu[0]['vURL'];
        							$reqURL = $ArrMenu[$j]['vURL'];
        						}
        						//$reqURL = $ArrMenu[$j]['vURL'];
        					}
        					//echo $j."<hr>";

        					if($j < 8)
        					$wdth = ' width="150px"';
        					else
        					$wdth = '';
        					if($ArrMenu[$j]['vMenuDisplay'] != ''){
        						$dispMenus = ucwords($ArrMenu[$j]['vMenuDisplay']);
        					}else{
        						$dispMenus = '&nbsp;';
        					}
        					$this->dispMenu.= '  <td height="20" '.$wdth.'  align="center"><a href="'.$reqURL.'" class="'.$class.'">'.$dispMenus.'</a></td>';
                           if($j < 8){
                              $divclass = 'white-divider';
                           }else{
                              $divclass = '';
                           }
        					$this->dispMenu.= '  <td width="1" class="'.$divclass.'"  ><img src="'.ADMIN_IMAGES.'blank.gif" width="1" height="1"></td>';
                        }
					} else {
						$this->dispMenu.= '  <td height="20" '.$wdth.'  align="center"><a href="" class=""></a></td>';
                           if($j < 8){
                              $divclass = 'white-divider';
                           }else{
                              $divclass = '';
                           }
        					$this->dispMenu.= '  <td width="1" class=""  ><img src="'.ADMIN_IMAGES.'blank.gif" width="1" height="1"></td>';
					}

				}
				$this->dispMenu.= '  </tr>';

				if(count($ArrMenu) > 8){
					$this->dispMenu.= '  <tr><td class="white-divider" height="1" colspan="18" ><img src="'.ADMIN_IMAGES.'blank.gif" width="1" height="1"></td></tr>';
					$this->dispMenu.= '  <tr>';
					for($j=9; $j<18; $j++)
					{
						if(isset($ArrMenu[$j]) && is_array($ArrMenu[$j]) && count($ArrMenu[$j]) > 0)
						{
							$reqSubMenu = $this->getSubMenus($ArrMenu[$j]['iMenuId']);
							foreach($reqSubMenu as $reqsuburl){
								$reqsuburls[]=$reqsuburl['vURL'];
							}
							$te =explode("&",$reqSubMenu[0]['vURL']);
							if(@in_array($te[0],$subUrl))
								$class = "top-nav-active";
							else
								$class = "top-nav";
							//Old Link ===> $ArrMenu[$j]['vURL']
							//echo "<pre>";
							//print_r($subUrl);
							//print_r($ArrMenu[$j]['vURL']);
							if($subParentId[0] == $ArrMenu[$j]['iMenuId']){
								if(@in_array($ArrMenu[$j]['vURL'],$subFullUrl)){
									$reqURL = $ArrMenu[$j]['vURL'];
								}else{
									$reqURL = $subUrl[0];
								}
							}else{
								if(@in_array($ArrMenu[$j]['vURL'],$reqsuburls)){
									$reqURL = $ArrMenu[$j]['vURL'];
								}else{
									$reqURL = $reqSubMenu[0]['vURL'];
								}
								//$reqURL = $ArrMenu[$j]['vURL'];
							}
							$this->dispMenu.= '  <td height="20" width="100px"  align="center"><a href="'.$reqURL.'" class="'.$class.'">'.ucwords($ArrMenu[$j]['vMenuDisplay']).'</a></td>';
							$this->dispMenu.= '  <td class="white-divider"  width="1"><img src="'.ADMIN_IMAGES.'blank.gif" width="1" height="1"></td>';
						} else {
							$this->dispMenu.= '  <td height="20" width="100px"  align="center"><a href="" class=""></a></td>';
							$this->dispMenu.= '  <td class="white-divider"  width="1"><img src="'.ADMIN_IMAGES.'blank.gif" width="1" height="1"></td>';
						}
					}
					$this->dispMenu.= '  </tr>';
				}
				$this->dispMenu.= '  </table>';
		return $this->dispMenu;
	}

	/**
	* @access	Public
	* @Return Details of Main Module of the Recent File
	* @author	Andrew Dev
	*/
	public  function getSubMenudetail(){
		global $dbobj;

    	//Check for the Logged In Admin's Menu Permission
    	$url = str_replace(SITE_FOLDER.ADMIN_FOLDER, "",$_SERVER['REQUEST_URI']);
		$url=  explode("&",$url);

		$parenturl = (isset($url[3]))?explode("=",$url[3]):"";
		// prints($url); exit;
		if(isset($url[3]) && $url[3] != '' && $parenturl[0] == 'parent'){
			$moduleurl = "index.php?file=".$parenturl[1];
		}else{
			$moduleurl = $url[0];
		}
		// echo $moduleurl;
		$label = array("ge-home","ge-settings","ge-backup","ge-source","ge-fullbkup","ge-restore","ge-access","ge-inbox","ge-comessage","ge-sentmails","ge-msgdetail");

		if(in_array($_GET['file'],$label))
		{
			if($_GET['file'] == 'ge-source' || $_GET['file'] == 'ge-fullbkup' || $_GET['file'] == 'ge-restore'){
				$moduleurl = 'index.php?file=ge-backup';
			}
			if($_GET['file'] == "ge-comessage" || $_GET['file'] == "ge-sentmails" || $_GET['file'] == "ge-msgdetail"){
				 $moduleurl ="index.php?file=ge-sentmails";
			}
			$url = $moduleurl."&view=edit&AX=Yes";
		}
		else
		{
				$url = $moduleurl."&view=index&AX=Yes";
		}

		$sql_menu = "select *
					from ".PRJ_DB_PREFIX."_modules
					where vLink='".$url."'
					AND eStatus = 'Active'
					AND iParentId <> '0' order by iDisporder ASC";
				$db_menu_rs = $dbobj->MySQLSelect($sql_menu);
		// print_r($db_menu_rs); //exit;
//		$url = $moduleurl = $db_menu_rs[0]['vLink'];

$db_menusub = array();
		if(count($db_menu_rs))
		{
			if($db_menu_rs[0]['iParentId'] == '0')
			{
				$sql_sub = "select iModuleId as iMenuId ,vPath,iParentId,vModuleName as vMenuDisplay,
						vLink as vURL,tModuleDesc
						from ".PRJ_DB_PREFIX."_modules
						where iParentId='".$db_menu_rs[0]['iModuleId']."' AND eStatus = 'Active'
						order by iDisporder ASC";
				$db_menusub = $dbobj->MySQLSelect($sql_sub);
			}
			else
			{
				$sql_sub = "SELECT iModuleId as iMenuId ,vPath,iParentId,vModuleName as vMenuDisplay,
							vLink as vURL,tModuleDesc
							FROM ".PRJ_DB_PREFIX."_modules
							WHERE iParentId='".$db_menu_rs[0]['iParentId']."'
							AND eStatus = 'Active'
                                   AND (iModuleId IN(".@implode(',',$this->reqmodules)."))
                                   ORDER BY iDisporder ASC";
				$db_menusub = $dbobj->MySQLSelect($sql_sub);
			}
		}
		return $db_menusub;
	}

	/**
	* @access	public
	* @Return open all menu
	* @Created :Andrew Dev
	*/
	public function openAllMenu()
	{
		$ArrMenu =	$this->parentModules();
		$this->dispMenu = '';
		$this->dispMenu.= ' <table cellpadding="0" class="allmenu-bg" cellspacing="0" border="0" width="100%">';
		$this->dispMenu.= '<tr class="black-bg">';
			$this->dispMenu.= '<td>Open Quick Go To</td>';
			$this->dispMenu.= '<td align="right">';
			$this->dispMenu.= '<a href="#" id="minimize"  title="Minimize" class="whitelink-bold" onclick="return hideQuickMenu();return false;"><img src="'.ADMIN_IMAGES.'minimize-icon.gif" alt="Minimize" style="border:0px;cursor:pointer;">&nbsp;</a>';
			$this->dispMenu.= '<a href="#" id="maximize" title="Maximize" style="display:none" class="whitelink-bold" onclick="return getQuickMenu();return false;"><img src="'.ADMIN_IMAGES.'maximize-icon.gif" alt="Maximize" style="border:0px;cursor:pointer;">&nbsp;</a>';
			$this->dispMenu.= '<img src="'.ADMIN_IMAGES.'close-icon.gif" title="Close" alt="Close" onclick="hideDIV();"  style="border:0px;cursor:pointer;">&nbsp;';
			$this->dispMenu.= '</td>';
		$this->dispMenu.= '</tr>';

		$this->dispMenu.= '	<tr> ';
		$this->dispMenu.= '	<td colspan="2"> ';
		$this->dispMenu.= ' <div id="openqickview"> ';
		$this->dispMenu.= ' <table cellpadding="1" cellspacing="1" border="0" width="100%">';

		for($j=0; $j<count($ArrMenu); $j++)
		{
			$subarr = $this->getSubMenus($ArrMenu[$j]['iMenuId']);
			if($j % 3 == 0)
			$this->dispMenu.= '<tr>';
			if($j % 3==2){
				$class = "";
			}else{
				$class = "vr-dottedline";
			}
			$this->dispMenu.= '<td width="33%" valign="top" class="'.$class.'">';
			$this->dispMenu.= '<h2>'.ucwords($ArrMenu[$j]['vMenuDisplay']).'</h2>';
			$this->dispMenu.='<div id="menu"><ul>';
			for($x=0; $x<count($subarr); $x++)
			{
				$this->dispMenu.='<li><a href="'.$subarr[$x]['vURL'].'">'.$subarr[$x]['vMenuDisplay'].'</a></li>';
			}
			$this->dispMenu.='</ul></div>';
			$this->dispMenu.= '</td>';
			if($j % 3==2)
			$this->dispMenu.= '  </tr>';
		}
		$this->dispMenu.= '  </table> ';
		$this->dispMenu.= '</div>';
		$this->dispMenu.= '<td>';
		$this->dispMenu.= '<tr>';
		$this->dispMenu.= '<table>';

		return $this->dispMenu;
	}

	/**
	* @access	public
	* @Return Print Search Box in Listing
	* @Created :cyrus dev
	*/
	public function getSearchBox($Field_arr,$alpha_rs,$TableArr)
	{
		$AlphaChar = @explode(',',$alpha_rs);
		//print_R($AlphaChar);
		$sorton = (isset($sorton))? $sorton : '';
		$start = (isset($start))? $start : '';
		
        $sBox='';
		preg_match_all('/[0-9]/',$alpha_rs,$numchar);
		$sBox.= '<table width="758" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
					<td class="search-bg" valign="top">
						<table width="98%" border="0" style="margin-top:3px;" align="center" cellpadding="0" cellspacing="0">
						<tr>
							<td width="30%"><h1>Search</h1></td>
							<td width="67%"><div style="clear:both;float:left;padding-right:5px;margin-top:3px">Search for</div>
							<div id="keywordtextbox" style="float:left;"><input type="text" class="input-new" id="keyword" name="keyword"/></div>
                            <div style="float:left;padding-left:5px;padding-right:5px">In</div>';
							$sBox.= '<div style="float:left;"><select name="sOption" id="sOption" class="input" size="1" onchange="return dispCalnem(this.value,\''.$_GET['file'].'\',\''.$TableArr[0][0].'\');return false;">';
							for($i=0; $i<count($Field_arr); $i++)
							{
								if($Field_arr[$i]['4'] == 'Yes')
									$sBox.= "<option value=\"".$Field_arr[$i]['0']."\">".$Field_arr[$i]['2']."</option>";
							}
							$sBox.= '</select>';
                            $sorton_n = (isset($sorton))?$sorton:"";
                            $start_n = (isset($start))?$start:"";
							$sBox.= '&nbsp;<input type="Image" src="'.ADMIN_IMAGES.'btn-searchnow.gif" style="cursor:pointer" onclick="new AjaxListing({eStatus:\'Search\', sorton: \''.$sorton_n.'\', st: \''.$start_n.'\'});return false;" border="0" align="absmiddle" /></div></td>';
							$sBox.= '<td width="3%" align="center" valign="top"><img src="'.ADMIN_IMAGES.'close-img.gif" style="cursor:pointer" onclick="closeSearch();"  /></td>
						</tr>
						<tr>
							<td height="30" colspan="3">
								<table width="100%" border="0" cellspacing="1" cellpadding="1">';

								$sBox.= '<tr>';
								//print_r($AlphaChar);
								for($i=65;$i<=90;$i++)
								{

									//$extclass = 'searching';
									$sBox.= '<td width="28" align="center">';
									if(!@in_array(chr($i),$AlphaChar)){
										$sBox.= '<a href="#" onclick="return false;" class="serching-inactive" id="alch_'.$i.'">'.chr($i).'</a>';
									}else{
										$sBox.= '<a  href="#" class="searching" id="alch_'.$i.'" onclick="new AjaxListing({eStatus:\'Alpha\', sorton: \''.$sorton_n.'\', st: \''.$start_n.'\', alpha : \''.chr($i).'\', chId :\'alch_'.$i.'\'});">'.chr($i).'</a>';
									}
									$sBox.= '</td>';
								}
								$sBox.= '</tr>';
								$sBox.= '<tr>';
									$sBox.= '<td colspan="26" align="center">';
										$sBox.= '<table  border="0" cellspacing="1" cellpadding="1">';
										$sBox.= '<tr>';

											$sBox.= '<td width="50%" align="center">';
											if(count($numchar[0]) > 0){
												$sBox.= '<a  href="#"  class="searching" id="alch_1" onclick="new AjaxListing({eStatus:\'Num\', sorton: \''.$sorton.'\', st: \''.$start.'\', alpha : \'0-9\', chId :\'alch_1\'});">0-9</a>';
											}else{
												$sBox.= '<a  href="#"  class="serching-inactive" id="alch_1" onclick="return false;">0-9</a>';
											}

											$sBox.= '</td>';
										$sBox.= '</tr>';
										$sBox.= '</table>';
									$sBox.= '</td>';
								$sBox.= '</tr>
								</table>
							</td>
						</tr>
						</table>
					</td>
				</tr>
				</table>';
		return $sBox;
	}

	/**
	* @access	public
	* @Return print Icons Like Add/Search/View/Open all menu
	* @Created :cyrus dev
	*/
	public function getIcons($extPara)
	{
          global $accessobj;
		//Get Access module Array (Need to Check Extends class is not working)
		$this->accessmod	= $accessobj->getAdminAccessmodules();
		$modinfo = $accessobj->getModuleInfo();
		$iModId = $modinfo[0]['iModuleId'];
		//Declare active / Inactive / Delete access variable
		$addmod = @explode(',',$this->accessmod[0]['tAdd']);
        $icon = (isset($icon))? $icon : '';
        $var = (isset($var))? $var : '';

          if(@in_array($iModId,$addmod)) {
		  if($extPara[4] != '' && $extPara[4] !='ge-loginhistory' && $extPara[4] !='ge-emailtemplate') {
					$icon.= '<a href="index.php?file='.$extPara[4].'&view=add'.$var.'" accesskey="a" ><img src="'.ADMIN_IMAGES.'add-icon.gif" width="20" title="Add" height="20" border="0" /></a>';
			} else {
				$icon.= '<img src="'.ADMIN_IMAGES.'add-icon-in.gif" width="20" title="Add Inactive" height="20" border="0" />';
			}
          } else {
				$icon.= '<img src="'.ADMIN_IMAGES.'add-icon-in.gif" width="20" title="Add Inactive" height="20" border="0" />';
			}
            $searchmod = @explode(',',$this->accessmod[0]['tSearch']);
		//Prints($searchmod);
         if(@in_array($iModId,$searchmod)){
		  if(GetVar('AX') == "Yes") {
			 $icon.= '&nbsp;&nbsp;<a accesskey="r" onclick="openSearch();" style="cursor:pointer"><img src="'.ADMIN_IMAGES.'search-icon.gif" width="20" title="Search" height="20" border="0" /></a>';
		  }else{
			 $icon.= '&nbsp;&nbsp;<img src="'.ADMIN_IMAGES.'search-icon-in.gif" width="20" style="cursor:pointer" title="Search Inactive" height="20" border="0">';
		  }
         } else {
			 $icon.= '&nbsp;&nbsp;<img src="'.ADMIN_IMAGES.'search-icon-in.gif" width="20" style="cursor:pointer" title="Search Inactive" height="20" border="0">';
		  }
      $icon.= '&nbsp;&nbsp;<a accesskey="l" onclick="openMenu();" style="cursor:pointer"><img src="'.ADMIN_IMAGES.'openallmenu-a.gif" width="20" title="Open All Menu" height="20" border="0" /></a>';
		return $icon;
	}

	/**
	* @access	public
	* @Listing Grid Tool Bar
	* @Created :cyrus dev
	*/

	public function getGridToolBar($table)
	{
		global $gdbobj,$ADMIN_REC_LIMIT,$accessobj;
        $icon = (isset($icon))? $icon : '';
        $bar = (isset($bar))? $bar : '';
        $sorton = (isset($sorton))? $sorton : '';
        $start = (isset($start))? $start : '';

          //Get Access module Array (Need to Check Extends class is not working)
		$this->accessmod	= $accessobj->getAdminAccessmodules();

		$modinfo = $accessobj->getModuleInfo();

		$iModId = $modinfo[0]['iModuleId'];
		//Declare active / Inactive / Delete access variable
		$activemod = @explode(',',$this->accessmod[0]['tActive']);
		$inactivemod = @explode(',',$this->accessmod[0]['tInactive']);
		$deletemod = @explode(',',$this->accessmod[0]['tDelete']);
		$Blockmod = @explode(',',$this->accessmod[0]['tBlock']);

		$pageArr = array("10","20","30","40","50","60","70","80","90","100");
		$bar.= '<table width="100%" border="0" cellspacing="0" cellpadding="0">';
		$bar.= '<tr> ';
			$bar.= ' <td width="30%" height="29"> ';
					$bar.= ' <table width="100%" border="0" cellspacing="0" cellpadding="0">';
					$bar.= ' <tr> ';
						$bar.= ' <td width="50" align="center">';
							$bar.= ' <select class="input" id="vRecLimit" class="input" name="vRecLimit" size="1" onchange="new AjaxListing({eStatus:\'Search\', sorton: \''.$sorton.'\', st: \''.$start.'\'});" >';

							for($k=0; $k<count($pageArr); $k++)
							{

								if($ADMIN_REC_LIMIT == $pageArr[$k]){
									$selected = 'selected';
								}else{
									$selected = '';
								}
								$bar.= '<option '.$selected.' value="'.$pageArr[$k].'">'.$pageArr[$k].'</option>';
							}
							$bar.= ' </select>';
						$bar.= ' </td>';

						$bar.= '<td width="2"><img src="'.ADMIN_IMAGES.'divider-new.gif" border="0" /></td>';
					$bar.= '<td align="center" width="50"><img src="'.ADMIN_IMAGES.'previous-last-icon.gif" hspace="3" style="CURSOR:POINTER;" onclick="changePage(\'prevlast\');" border="0" align="absmiddle" /> <img src="'.ADMIN_IMAGES.'previous-icon.gif" id="imgPrev"  style="CURSOR:POINTER;" onclick="changePage(\'prev\');"  hspace="3" border="0" align="absmiddle" /> </td>';
					$bar.= '<td width="1"><img src="'.ADMIN_IMAGES.'divider-new.gif" border="0" /></td>';
					$bar.= '<td width="150" align="center">Page <span id="pgeno"></span>&nbsp;of <span id="divtotpages"></span> </td>';
					$bar.= '<td width="1"><img src="'.ADMIN_IMAGES.'divider-new.gif" border="0" /></td>';
					$bar.= '<td align="center" width="50"><img src="'.ADMIN_IMAGES.'next-icon.gif" style="CURSOR:POINTER;" onclick="changePage(\'next\');" id="imgNext"  hspace="3" border="0" align="absmiddle" /> <img src="'.ADMIN_IMAGES.'nextlast-icon.gif" hspace="3" id="imglast" style="CURSOR:POINTER;" onclick="changePage(\'last\');"   border="0" align="absmiddle" /> </td>';
					$bar.= '<td width="1"><img src="'.ADMIN_IMAGES.'divider-new.gif" border="0" /></td>';
					$bar.= ' </tr>';
					$bar.= ' </table>';
			$bar.= ' </td>';
			$bar.= ' <td width="20%" align="center">Go To Page: <span id="pgBox"></span></td>';
			$bar.= ' <td width="25%"  align="center" id="divrecmsg" class="errormsg"></td>';
			$bar.= ' <td align="right" width="25%">';

				$bar.= ' <select id="vStatus" onchange="new AjaxListing({eStatus: this.value, sorton: \''.$sorton.'\', st: \''.$start.'\'});"  class="input" name="vStatus" style="width:100px;">';
					$bar.= ' <option value="">Select Action</option>';
					$bar.= ' <option value="ShowAll">Show All</option>';

					$bStatus = $gdbobj->CheckField($table,'eStatus');
                    //Prints($bStatus);exit;
                         $eStatus_Arr=$gdbobj->mysqlEnumValues($table,'eStatus');

                         if(!$eStatus_Arr)
                         $eStatus_Arr= array('Active','Inactive','Block');
                         //Prints($eStatus_Arr);exit;
					if($bStatus){
						for($i=0;$i<count($eStatus_Arr);$i++){

                                   if($eStatus_Arr[$i] == 'Active'){
            								if(@in_array($iModId,$activemod))
               									if($_GET['file']!='rest-planlogs')
               									 	$disp = "Yes";
               							}elseif($eStatus_Arr[$i] == 'Inactive'){
               								if(@in_array($iModId,$inactivemod))
               									if($_GET['file']!='rest-planlogs')
               										$disp = "Yes";
               							}elseif($eStatus_Arr[$i] == 'Block'){
               								if(@in_array($iModId,$Blockmod))
               									$disp = "Yes";
               							}else{
               								$disp = "Yes";
               							}

                                     if($disp == "Yes"){
                                        if($eStatus_Arr[$i] != 'Pending' && $eStatus_Arr[$i] != 'isDelete'){
                                         if($_GET['file'] != 'or-order')
                                             $bar.= '<option value="'.$eStatus_Arr[$i].'">'.$eStatus_Arr[$i].'</option>';
                                     }else{

                                                  $bar.= '<option value="'.$eStatus_Arr[$i].'">Delete</option>';
                                        }
                                   }
						}
					}
                         if(@in_array($iModId,$deletemod))
						$deldisp = "Yes";
					if($deldisp == "Yes"){
                              if($_GET['file'] != 'ge-emailtemplate' && $_GET['file'] != 'ge-staticPages'){
                                   $bar.= '<option value="Delete">Delete</option>';
                              }
                         }
				$bar.= ' </select>	';
			$bar.= '</td>';
		$bar.= '</tr>';
		$bar.= '<tr><td colspan="4" style="cursor:move"><div id="move"></div></td></tr>';
		$bar.= '</table>';
		return $bar;
	}
}
?>