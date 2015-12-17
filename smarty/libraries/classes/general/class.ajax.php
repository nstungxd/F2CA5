<?php  
/*
 * @package  Ajax Listing
---------------------------------------------------------------------------------
 * @version  1.0 beta
---------------------------------------------------------------------------------
 * @Created Date : 03/05/08 (dd/mm/yy)
---------------------------------------------------------------------------------
 * Description:
	AjaxListing is class to List of ajax module that are coming from three
	database tabels ajaxlist_extra,ajax_fields,ajaxlist_table
	and make according to module xml
---------------------------------------------------------------------------------
 *	Methods are used
	 AjaxListing::AjaxListing(),AjaxListing::getExtraParamArray(), AjaxListing::getTableArray(),
	 AjaxListing::getFieldArray(), AjaxListing::getModuleInformation(),
	 AjaxListing::getTableName(), AjaxListing::getCountRecordSet(),
	 AjaxListing::getRecordArray(), AjaxListing::getSetMessage(),
     AjaxListing::getTableField(), AjaxListing::UpdateStatus(),AjaxListing::DeleteRecord()
     AjaxListing::SortList(), AjaxListing::SortImage()AjaxListing::MakeXml()
	 AjaxListing::encrptyArrayFields()
	 AjaxListing::setTableAndRelationforAlphaSearch()
	 AjaxListing::displayAjaxData()
	 add methods as u required....
---------------------------------------------------------------------------------
 **/

class AjaxListing
{
	var $vars; 		//for define all variables;

	var $ssql;		//for define extra condition in query;

	var $num_limit;	//for define num_limit

	var $var_limit;  //for define var_limit

	var $statusArr = array("Active","Inactive","Block","Cancelled","Fraud","Pending","InProcess","Expired","Closed");

	var $acnt = array();

	var $iacnt = array();
    var $getParam;
    var $start;
    var $rec_limit;
    var $sorton;
    var $tabfile;
    var $eStatus;
    var $checkedArr;

	/**
     * AjaxListing::AjaxListing() it's the constructor.
	 * @Initialize all variable that coming from get Variable
	 */

	public function AjaxListing()
	{
		global $dbobj;
        
		if(isset($GLOBALS["HTTP_GET_VARS"]))
			$arr=$GLOBALS["HTTP_GET_VARS"];
		else
			$arr=$GLOBALS["_GET"];

		foreach($arr as $vars => $res){$this->$vars = $res;}

		if(GetVar('tabfile') != 'planlogs')
		$this->ssql = "where 1 ";
        
		if($this->getParam != "")
			$this->ssql.= $this->getParam;
		if($this->start != 0)
		{
			$this->num_limit = ($this->start-1)*$this->rec_limit;
			$this->var_limit = " LIMIT $this->num_limit, $this->rec_limit";
	 	}
		else
		{
	  		$this->var_limit = " LIMIT 0, $this->rec_limit";
			$this->start = 1;
		}
 	//echo $this->keyword ;exit;

		if($this->sorton =='')
			$this->sorton ='0';

		if(isset($this->keyword) && $this->keyword != "")
		{
			//$this->keyword = iconv("ISO-8859-1",'UTF-8',$this->keyword);
                        $opt = explode(".",$this->option);
			if($this->eStatus == "Alpha"){
					$sql 	= "select vAlphaSearch  from ajaxlist_extra where vModuleName = '".$this->tabfile."'";
					$db_sql = $dbobj->MySQLSelect($sql);
					$this->ssql .= " and ".$db_sql[0]['vAlphaSearch']." like '$this->keyword%'";
			}elseif($this->eStatus == "Num"){
					$sql 	= "select vAlphaSearch  from ajaxlist_extra where vModuleName = '".$this->tabfile."'";
					$db_sql = $dbobj->MySQLSelect($sql);
					$this->ssql .= " and ".$db_sql[0]['vAlphaSearch']." REGEXP '^[".$this->keyword."]'";
			}else{
				if($this->option == 'log.dLoginDate' || $this->option == "log.dLogoutDate"){
					$this->ssql .= " and DATE(".$this->option.") >= '".date("Y-m-d",strtotime($this->keyword))."' AND DATE(".$this->option.")  <= '".date("Y-m-d",strtotime($this->keyword1))."'";
				}else if($this->option == 'log.eType' && $this->tabfile == 'loginhistory' )
				{
					$this->ssql .= " and ".stripslashes($this->option)."='$this->keyword'";
				}
				else{
					$estatus = explode(".",$this->option);
					if($estatus[1] == 'eStatus'){
						$this->ssql .= " and ".stripslashes($this->option)."='$this->keyword'";
					}else if($this->option =='thr.iThreadID'){
						$this->ssql .= " and ".stripslashes('htp.vAuthorName')." like '%$this->keyword%'";
					}else{
					$this->ssql .= " and ".stripslashes($this->option)." like '%$this->keyword%'";
					}
				}
			}
		}
		//echo $this->ssql;exit;
		if($this->tabfile !='')
			$this->file = $this->tabfile;
		else{
			$temp = explode("-",GetVar('file'));
			$this->file = $temp[1];
		}
		$this->ssql = $this->setExtraParma();
		if($this->eStatus == 'Delete')
			$this->DeleteRecord();
		else
			$this->UpdateStatus();
	}

	/**
	 * AjaxListing::setExtraParam()
     * set extra parameters
	 * @return this->sql
	 */


	 public function setExtraParma()
	 {
		//echo $this->file;exit;
	 	switch($this->file)
		{
		   	case "faq":
			   if($this->iFCId !='')
				 $this->ssql.=" AND iFCId= '".$this->iFCId."'";
		    break;
		}
		return $this->ssql;
	 }

 	/**
	 * AjaxListing::getExtraParamArray()
     * set extra array from table ajaxlist_extra according to module
	 * @return extra array
	 */

	public function getExtraParamArray()
	{
		global $dbobj;
		$ExtraPara = array();
		$db_extra = $this->getModuleInformation('ajaxlist_extra');
		$vImageURL = (isset($db_extra[0]['vImageURL']))?$db_extra[0]['vImageURL']:"";
		$vImagePath = (isset($db_extra[0]['vImagePath']))?$db_extra[0]['vImagePath']:"";
		global $$vImageURL, $$vImagePath;
		if(isset($db_extra[0]['eStatusIcon']) && $db_extra[0]['eStatusIcon'] == 'Icon')
			$eStatusIcon = 0;
		else
			$eStatusIcon = 1;

		$ExtraPara = array(isset($db_extra[0]['iExtraId'])?$db_extra[0]['iExtraId']:"",isset($db_extra[0]['vDefaultSorting'])?$db_extra[0]['vDefaultSorting']:"",
						   isset($db_extra[0]['vModuleHeading'])?$db_extra[0]['vModuleHeading']:"",isset($db_extra[0]['vRelationship'])?$db_extra[0]['vRelationship']:"",
						   isset($db_extra[0]['vAddURL'])?$db_extra[0]['vAddURL']:"",isset($eStatusIcon)?$eStatusIcon:"",isset($$vImageURL)?$$vImageURL:"",isset($$vImagePath)?$$vImagePath:"",
						   isset($db_extra[0]['vAlphaSearch'])?$db_extra[0]['vAlphaSearch']:"",isset($db_extra[0]['eAddEditAX'])?$db_extra[0]['eAddEditAX']:"");
		return $ExtraPara;
	}

 	/**
	 * AjaxListing::getTableArray()
     * set table array from table ajaxlist_table according to module
	 * @return table array
	 */

	public function getTableArray()
	{
		global $dbobj;
		$TableArr = array();
		$db_table = $this->getModuleInformation('ajaxlist_table');
		for($i=0;$i<count($db_table);$i++){
				$TableArr[] = array($db_table[$i]['vTableName'],$db_table[$i]['vSuffix']);
		}
		return $TableArr;
	}

	/**
	 * AjaxListing::getFieldArray()
     * set field array from table ajaxlist_field according to module
	 * @return field array
	 */

	public function getFieldArray()
	{
		global $dbobj;
		$Field_arr = array();
		$db_field = $this->getModuleInformation('ajaxlist_field');
        
		for($i=0;$i<count($db_field);$i++)
		{
            $db_field[$i]['eExtraWindow'] = (isset($db_field[$i]['eExtraWindow']))? $db_field[$i]['eExtraWindow'] : '';
            $db_field[$i]['eWindowType'] = (isset($db_field[$i]['eWindowType']))? $db_field[$i]['eWindowType'] : '';
            $db_field[$i]['eImgText'] = (isset($db_field[$i]['eImgText']))? $db_field[$i]['eImgText'] : '';
            $db_field[$i]['vImgText'] = (isset($db_field[$i]['vImgText']))? $db_field[$i]['vImgText'] : '';
            $db_field[$i]['eOutSide'] = (isset($db_field[$i]['eOutSide']))? $db_field[$i]['eOutSide'] : '';
            
			$Field_arr[] = array($db_field[$i]['vFieldName'],	$db_field[$i]['vDisplayInQuery'],
								 $db_field[$i]['vLable'],		$db_field[$i]['iSoringParam'],
								 $db_field[$i]['eSearch'],		$db_field[$i]['eAlignment'],
								 $db_field[$i]['vWidth']."%",	$db_field[$i]['vFunction'],
								 $db_field[$i]['vEditURL'], $db_field[$i]['eExtraWindow'],
								 $db_field[$i]['eWindowType'], $db_field[$i]['eImgText'],
								 $db_field[$i]['vImgText'], $db_field[$i]['eOutSide'],
								 $db_field[$i]['eInlineEdit'], $db_field[$i]['eInlineEditAllField'],
								 $db_field[$i]['eEditType'], $db_field[$i]['eSource']);
		}
		return $Field_arr;
	}

	/**
	 * AjaxListing::getModuleInformation()
     * gives Module Information
	 * @return module array
	 */

	public function getModuleInformation($tableName)
	{
		global $dbobj;
		$file =$this->file;
        $ssql='';
		if($tableName == 'ajaxlist_table')$ssql = 'order by iTableId';
		if($tableName == 'ajaxlist_field')$ssql = 'order by iOrderBy';
		$sql = "select * from $tableName where vModuleName = '".$file."' $ssql";
          //echo $sql;exit;
		$db_field = $dbobj->MySQLSelect($sql);
		return $db_field ;
	}

	/**
	 * AjaxListing::getTableName()
     * set table name according to module
	 * @return Table Name
	 */

	public function getTableName()
	{
		$TablePara = $this->getTableArray();
        $tablename = '';
		for($i=0,$nt = count($TablePara);$i<$nt;$i++)
		{
			$tablename .= $TablePara[$i][0]." `".$TablePara[$i][1]."`,";
		}
		$tablename = substr($tablename,0,-1);
		return $tablename;
	}

	/**
	 * AjaxListing::getCountRecordSet()
     * set count of recordset according to status,paging etc...
	 * @return total reocrds
	 */

	public function getCountRecordSet()
	{
		global $dbobj;
		$file1 = explode("-",$this->file);
		$file = $file1[1];
		$tablename = $this->getTableName();
		$disp_field =  $this->getTableField();
		$ExtraPara = $this->getExtraParamArray();
		$ssql = $this->ssql;
      if($tablename == PRJ_DB_PREFIX.'_login_history')
		{
         $sql_select = "select count(*) as tot from $tablename $ssql";
		}else{
		    $sql_select = "select count(*) as tot from $tablename $ssql";
		}



		//echo $this->keyword;exit;
		//echo GetVar('tabfile');exit;
		//echo $sql_select;exit;
		$db_select_rs  = $dbobj->MySQLSelect($sql_select);
		$totrec = $db_select_rs[0]['tot'];

    return $totrec;
	}

	/**
	 * AjaxListing::getRecordArray()
     * gives recordset according to status,paging and Module etc...
	 * @return record array
	 */

	public function getRecordArray()
	{
		global $dbobj;
		$file1 = explode("-",$this->file);
		$file = $file1[1];
		$disp_field =  $this->getTableField();
		$ExtraPara = $this->getExtraParamArray();
		$ssql = $this->ssql;
		$tablename = $this->getTableName();
		$var_limit = $this->var_limit;
		$sort =$this->SortList();
		//echo $sort;exit;
		//echo GetVar('tabfile');exit;
		//echo PRJ_DB_PREFIX.'_administrator';
		if($tablename == PRJ_DB_PREFIX.'_administrator `adm`')
		{
			$disp_field .= ',eType';
		}
		$sql_select = "select $disp_field from $tablename $ssql order by $sort $var_limit";
		// echo $sql_select; exit;
		$db_select_rs  = $dbobj->MySQLSelect($sql_select);
    	return $db_select_rs;
	}

	/**
	 * AjaxListing::getSetStatusMessage()
   * gives record message Accroding to Status Changes Condition
	 * @return record msg
	**/

	public function getSetStatusMessage()
	{
		//print_r($countChk);exit;
		$countChk =count(explode(",",$this->checkedArr));
		$recordlimit = ($this->start-1)*$this->rec_limit;
		$startrec = $recordlimit;
	//	echo $this->eStatus;exit;
		$lastrec = $startrec + $this->rec_limit;
		$startrec = $startrec + 1;
		$num_totrec = $this->getCountRecordSet();
		if($lastrec > $num_totrec)
			$lastrec = $num_totrec;
		$cnt = count($this->acnt);

		if($this->eStatus == 'Active' || $this->eStatus == 'Inactive')
			$tcount = $countChk - $cnt;
		else
			$tcount = $countChk;
		if($this->eStatus == 'Active' || $this->eStatus == 'Inactive' || $this->eStatus == 'Delete' || $this->eStatus == 'Show' || $this->eStatus == 'Block' || $this->eStatus == 'isDelete' || $this->eStatus == 'Approve' || $this->eStatus == 'Reject'){

			if($this->eStatus == 'Active'){
			$msgtitle = 'Activated';
			$msgtitle2 = 'Active';
			}
			elseif($this->eStatus == 'Inactive')
			{
			$msgtitle = 'Inactivated';
			$msgtitle2 = 'Inactive';
			}
			elseif($this->eStatus == 'Delete')
			{$msgtitle = 'Deleted';
			}
			elseif($this->eStatus == 'Show')
			{
			$msgtitle = 'Show';
			}
			elseif($this->eStatus == 'Block')
			{
				$msgtitle = 'Blocked';
				$msgtitle2 = 'Block';
			}
			elseif($this->eStatus == 'isDelete')
			{
				$msgtitle = 'Deleted';
				//$msgtitle2 = 'Block';
			}elseif($this->eStatus == 'Approve')
			{
				$msgtitle = 'Approved';
				$msgtitle2 = 'Approve';
			}elseif($this->eStatus == 'Reject')
			{
				$msgtitle = 'Rejected';
				$msgtitle2 = 'Reject';
			}

			if($cnt > 0)
				$statmsg.= "".$cnt." Record(s) Already ".$msgtitle2.".";
			if($tcount > 0)
				$statmsg.= "".$tcount." Record(s) ".$msgtitle." Successfully.";
		}else{
			$statmsg = "Search";
		}
		return $statmsg;
	}

	/**
	 * AjaxListing::getSetMessage()
     * gives record message Accroding Displaying Of records
	 * @return record msg
	 */

	public function getSetMessage()
	{
		$countChk =count(explode(",",$this->checkedArr));
		//print_r($countChk);exit;
		$recordlimit = ($this->start-1)*$this->rec_limit;
		$startrec = $recordlimit;
		$lastrec = $startrec + $this->rec_limit;
		$startrec = $startrec + 1;
		$num_totrec = $this->getCountRecordSet();

		if($lastrec > $num_totrec)
			$lastrec = $num_totrec;

		if($num_totrec > 0 )
			$recmsg = "Displaying ".$startrec." - ".$lastrec." records of ".$num_totrec;
		else
			$recmsg="No records found.";
		return $recmsg;
	}


	/**
	 * AjaxListing::getTableField()
     * gives module fields that are to be displayed
	 * @return module fields
	 */

	public function getTableField()
	{
		$FieldPara = $this->getFieldArray();
        $disp_field = '';
		for($i=0,$nt = count($FieldPara);$i<$nt;$i++)
		{
			$disp_field.= "".$FieldPara[$i][0]." AS ".$FieldPara[$i][1].",";
		}
		$disp_field = " ".substr($disp_field,0,-1);
		//echo '<pre>';
		//print_r($FieldPara);exit;
		return $disp_field;
	}

	 /**
	 * AjaxListing::SortList()
     * Sort List according to sort parameter
	 * @return sort
	 */

	public function SortList()
	{
		$sorton = $this->sorton;
		$FieldPara = $this->getFieldArray();
		$ExtraPara = $this->getExtraParamArray();

		if(isset($sorton) && $sorton != '0')
		{
			for($i=0;$i< count($FieldPara);$i++)
			{
				if($sorton == $FieldPara[$i][3] && $FieldPara[$i][3] != '0'){
					($this->stat==1)? $sort = $FieldPara[$i][0] : $sort = $FieldPara[$i][0]." DESC";
				}
			}
		}
		else
		{
			$sort = $ExtraPara[1];
		}
		return $sort;
	}

	 /**
	 * AjaxListing::SortImage()
     * to display of sorting image on field
	 * @return sort image
	 */

	public function SortImage()
	{
		if($this->stat == '1')
			$sort_img = "images/asc_order.gif";
		else
			$sort_img = "images/desc_order.gif";
		return $sort_img;
	}

	/**
	 * AjaxListing::UpdateStatus()
     * Update status
	 * @no return value
	 */

	public function UpdateStatus()
	{
		global $dbobj,$generalobj,$otherObj,$otherObj,$clipart,$proObj;
		$FieldPara = $this->getFieldArray();
		$iPrimaryId = isset($FieldPara[0][1])?$FieldPara[0][1]:"";
		$TablePara = $this->getTableArray();
		$staTable = isset($TablePara[0][0])?$TablePara[0][0]:"";
		$this->checkedArr;
		$disp_field =  $this->getTableField();
		$arr = explode(",",$disp_field);
		$ID = explode("AS",$arr[0]);
		$LID = explode(",",$this->checkedArr);
		$tablename = $this->getTableName();
		$cnt= array();
		$t=0;


		for($k=0;$k<count($LID);$k++)
		{
			$sql_select = "select eStatus from $tablename where ".$ID[0]."=".$LID[$k];
			$db_select_rs  = $dbobj->MySQLSelect($sql_select);
			$cnt[$k] = $db_select_rs[0]['eStatus'];
			$t++;
		}

		for($l=0;$l<count($cnt);$l++)
		{
			if($this->eStatus == $cnt[$l])
				$this->acnt[$l] = $l;
		}
		if($this->checkedArr !="")
		{
			$this->checkedArr = "'".str_replace(",","','",$this->checkedArr)."'";
			//echo $staTable;exit;
			if($staTable == "admin") {
				$data = array("eStatus" => $this->eStatus);
				$where = "$iPrimaryId in ($this->checkedArr) AND vUserName <> 'admin'";
				$dbobj->MySQLQueryPerform($staTable,$data,'update',$where);
			} else {
				//$this->checkedArr = "'".str_replace(",","','",$this->checkedArr)."'";
				$data = array("eStatus" => $this->eStatus);
				$where = "$iPrimaryId in ($this->checkedArr)";
				$dbobj->MySQLQueryPerform($staTable,$data,'update',$where);
			}
		}
	}

	/**
	 * AjaxListing::DeleteRecord()
     * Delete Record if status is delete
	 * @no return value
	 */

	public function DeleteRecord()
	{
		global $dbobj,$generalobj,$otherObj,$clipart;
		$FieldPara = $this->getFieldArray();
		$iPrimaryId = $FieldPara[0][1];
		$TablePara = $this->getTableArray();
		if(GetVar('tabfile') == 'planlogs'){
			$staTable = $TablePara[1][0];
		}else{
			$staTable = $TablePara[0][0];
		}
		//echo $iPrimaryId;
		//echo $staTable;exit;
		if($this->checkedArr !="")
		{
			$checkedArr = "".str_replace(",","','",$this->checkedArr)."";
			$checkedArr = "".str_replace(",","','",$this->checkedArr)."";


			$whe = "$iPrimaryId in ($this->checkedArr)";
			//$db_res = $dbobj->MySQLDelete($staTable,$whe);

               if($staTable == "".PRJ_DB_PREFIX."_country_master")
               {
                    $whe = "$iPrimaryId in ($this->checkedArr)";
				$relDeleteArr = array(
									"tables"	=> 	array("".PRJ_DB_PREFIX."_state_master"),
									"relation"	=>	" iCountryId in($this->checkedArr)",
									"checkedArr"=>	$this->checkedArr
									);

				//To Delete All Related record to This Id(s)
				$generalobj->deleteRelRecord($relDeleteArr);
               }
               $db_res = $dbobj->MySQLDelete($staTable,$whe);
		}
	}

   /**
	 * AjaxListing::MakeXml()
     * Make xml of Listing
	 * @return xml
	 */

	public function MakeXml()
	{
		global $dbobj,$comObj;
		$recordArray = $this->getRecordArray();
		$FieldPara = $this->getFieldArray();
		$num_totrec =$this->getCountRecordSet();
		$statusmsg = $this->getSetStatusMessage();
		$recmsg = $this->getSetMessage();
		$sort_img = $this->SortImage();
		$displayRec = count($recordArray);
		$xmlcontent ='<?xml version="1.0" encoding="UTF-8"?><list>';

		for($i=0;$i< count($recordArray);$i++)
		{
			for($j=0;$j<count($FieldPara);$j++)
			{
				//Check if Field is not blank
				if($recordArray[$i][$FieldPara[$j][1]] != "")
				{

					/*if no php public function like Date_Format_Local, make Price*/
					if($FieldPara[$j][7] == "0"){
   					 switch($this->file){
   							case "languagelebel":
   								//echo $FieldPara[$j][1];
   								if($FieldPara[$j][1] == 'vName')
                                                        {
   									$FieldValue = $this->displayAjaxData(stripslashes($comObj->GetMouseOverDetail($recordArray[$i]['vName'])));
   								}else{
   									$FieldValue = $this->displayAjaxData(stripslashes($recordArray[$i][$FieldPara[$j][1]]));
   								}
   							break;
							case "whoisonline":
   								//echo $FieldPara[$j][1];
								$FieldValue = str_replace("&","&amp;",$this->displayAjaxData(stripslashes($recordArray[$i][$FieldPara[$j][1]])));
   							break;
   							default:
   								$FieldValue = $this->displayAjaxData(stripslashes($recordArray[$i][$FieldPara[$j][1]]));
   							break;
   						}
						   //$FieldValue = $this->displayAjaxData(stripslashes($recordArray[$i][$FieldPara[$j][1]]));
					}else{
						switch($this->file)
						 {
						 	default:
							   $nonObjFunc = array('Time_Format','DateTime');
							   if(@in_array($FieldPara[$j][7],$nonObjFunc))
								  $FieldValue = $this->displayAjaxData(stripslashes($FieldPara[$j][7]($recordArray[$i][$FieldPara[$j][1]])));
								else
								  $FieldValue = $this->displayAjaxData(stripslashes($comObj->$FieldPara[$j][7]($recordArray[$i][$FieldPara[$j][1]])));
								break;
						 }
					}
					$xmlcontent .='<'.strtolower($FieldPara[$j][1]).'>'.$FieldValue.'</'.strtolower($FieldPara[$j][1]).'>';
				}
				else
				{
					$xmlcontent .='<'.strtolower($FieldPara[$j][1]).'> --- </'.strtolower($FieldPara[$j][1]).'>';
				}
			}
			if($this->file == 'admin')
			{
				$xmlcontent .='<eType>'.$recordArray[$i]['eType'].'</eType>';
			}
		}
		//exit;
	//	echo $this->sorton;exit;
		$xmlcontent .='<totrec>'.$pre.str_replace("&","&amp;",$num_totrec).'</totrec>';			// Total Record
		$xmlcontent .='<var_limit>'.$pre.str_replace("&","&amp;",$this->var_limit).'</var_limit>';	// var limit
		$xmlcontent .='<start>'.$pre.str_replace("&","&amp;",$this->start).'</start>';
		$xmlcontent .='<displayrec>'.$displayRec.'</displayrec>';
		$xmlcontent .='<recmsg>'.$recmsg.'</recmsg>';
		$xmlcontent .='<statusmsg>'.$statusmsg.'</statusmsg>';
		$xmlcontent .='<sort_img>'.$sort_img.'</sort_img>';
		$xmlcontent .='<stat>'.$this->stat.'</stat>';
		$xmlcontent .='<sorton>'.$this->sorton.'</sorton>';
		$xmlcontent.='</list>';
		return $xmlcontent;
	}


   /**
	 * AjaxListing::encrptyArrayFields()
     * @param field arrr
	 * @return encrypted fields
	 */

	public function encrptyArrayFields($field_arr)
	{
		$ret_arr =array();
		for($e=0, $ne=count($field_arr); $e<$ne ; $e++){
			$ret_arr[]= base64_encode($field_arr[$e]);
		}
		return "['".implode("','", $ret_arr)."']";
	}

	/**
	 * AjaxListing::setTableAndRelationforAlphaSearch()
	 * @return alphaSearch string
	 */

	function setTableAndRelationforAlphaSearch()
	{
		$ExtraPara_inc = $this->getExtraParamArray($this->file);
		$TableArr_inc = $this->getTableArray($this->file);
		$string = "";
		for($a=0;$a<count($TableArr_inc);$a++){
			$string .=  $TableArr_inc[$a][0]." as `".$TableArr_inc[$a][1]."` ,";
		}
		$string = substr($string,0,-1);
		$string .= "where 1=1 ";
		$string .= $ExtraPara_inc[3];
		return $string;
	}


  	/**
	 * AjaxListing::displayAjaxData()
	 * @return with ommited characters
	 */

	public function displayAjaxData($data,$flag=1)
	{
		// if flag=0 then data in simple form (direct coming from table)
		// if flag=1 then data coming from another public function (Data in table form,hyperlink form, image tag)
		if($flag==1)
		{
			//$data = str_replace("�","&oslash;",stripslashes($data));
			//$data = str_replace("�","&Oslash;",stripslashes($data));
			$data = "<![CDATA[".stripslashes($data)."]]>";
			//$data = htmlspecialchars($data);
			//$data = str_replace("&","&amp;",stripslashes($data));
			return $data;
		}
		else{
		    return $data;
			 return str_replace("&","&amp;",stripslashes($data));
		}
	}
}
?>