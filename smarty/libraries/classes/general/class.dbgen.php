<?php
/**
 * This Class is useful for db related general functions
 *
 * @package		class.dbgen.php
 * @section		general
 */

class DBGeneral
{
	/**
     * DBGeneral::__construct() it's the constructor.
	 * @Initialize all variable ,functions
	 */
	public function __construct(){
		$this->getGeneralVar();
	}

	/**
     * DBGeneral::getGeneralVar()
	 * @Initialize all variable that coming from get setting table
	 * @no return value but assign setting variable
	 */
	public function getGeneralVar()
	{
		global $dbobj;

		$listField = $dbobj->MySQLGetFieldsQuery("".PRJ_DB_PREFIX."_configuration");
        //prints($listField);exit;
		$wri_usql = "SELECT $listField FROM ".PRJ_DB_PREFIX."_configuration where eStatus='Active'";
		$wri_ures = $dbobj->MySQLSelect($wri_usql);
        //prints($wri_ures);exit;

		for($i=0;$i<count($wri_ures);$i++){
			$vName  = $wri_ures[$i]["vName"];
			$vValue  = $wri_ures[$i]["vValue"];
			global $$vName;
			$$vName=$vValue;
		}
	}

	public function genSiteConfigs()
	{
		global $dbobj;
		$dtls = array();
		$sql = "SELECT * FROM ".PRJ_DB_PREFIX."_configuration";
		$dtl = $dbobj->MySQLSelect($sql);
		if(is_array($dtl) && count($dtl)>0) {
			for($l=0;$l<count($dtl);$l++) {
				$dtls[$dtl[$l]['vName']] = $dtl[$l];
			}
		}
		return $dtls;
	}

	/*
	* @Name: getRequestVars
	* @Parameter: data
 	* @Description: Used to get all the Request Variables
	* @Return: Make Global all required variables
	*/
        public function getRequestVars()
        {
            $evalStr='';
            foreach($_REQUEST AS $KEY => $VAL)
            {
                if($KEY != "list-boxes")
                {
                    $evalStr.= 'global $'.$KEY.'; $'.$KEY.' = $_REQUEST[\''.$KEY.'\'];';
                }
            }
                    if($evalStr!='')
                    @eval($evalStr);
        }

	/*
	* @Name: encrypt
	* @Parameter: data
 	* @Description: To encrypt string
	* @Return: encrypted Data
	*/

	function encrypt($data)
	{
		for($i = 0, $key = 27, $c = 48; $i <= 255; $i++)
		{
			$c = 255 & ($key ^ ($c << 1));
			$table[$key] = $c;
			$key = 255 & ($key + 1);
		}
		$len = strlen($data);
		for($i = 0; $i < $len; $i++)
		{
			$data[$i] = chr($table[ord($data[$i])]);
		}
		return base64_encode($data);
	}

	/*
	* @Name: decrypt
	* @Parameter: data
 	* @Description: to decrypt string
	* @Return: decrypted Data
	*/

	function decrypt($data)
	{
		$data = base64_decode($data);
		for($i = 0, $key = 27, $c = 48; $i <= 255; $i++)
		{
			$c = 255 & ($key ^ ($c << 1));
			$table[$c] = $key;
			$key = 255 & ($key + 1);
		}
		$len = strlen($data);
		for($i = 0; $i < $len; $i++)
		{
			$data[$i] = chr($table[ord($data[$i])]);
		}
		return $data;
	}


	/**
         * DBGeneral::Recompile()
	 * @param 	$arr
	 * @return	$newArr
	 * @author  cyrus dev
	 */
	function Recompile($arr)
	{
		$new_arr  = array();
		$i=0;
		if($arr != "")
		{
			foreach($arr as $key=>$val){
		    $new_arr[$i]= $arr[$key];
		    $i++;
	  		}
		}
		return $new_arr;
	}


	/**
         * DBGeneral::mysqlEnumValues()
	 * @table, field
	 * @return fields enum values like 'Acitve','Inactive','Yes','No'
	 */
	public function mysqlEnumValues($table, $field)
	{
	   $sql = "SHOW COLUMNS FROM $table LIKE '$field' ";
	   $sql_res = mysql_query($sql)or die("Could not query:\n$sql");
	   $row = mysql_fetch_assoc($sql_res);
	   mysql_free_result($sql_res);
	   return explode("','",preg_replace("/.*\('(.*)'\)/", "\\1", $row["Type"]));
	}

	/**
     * DBGeneral::CheckField()
	 * @param tablename, objField
	 * @return true or false
	 */
	public function CheckField($tblName, $objField)
	{
		global $dbobj;
		$db = $dbobj->MySQLGetFields($tblName);

		$flag = false;
		if(in_array($objField, $db))
			$flag = true;
		return 	$flag;
	}


	/**
     * DBGeneral::getImplodeArray()
	 * @Implode the Passed Array Bu ","
	 * @param 	$arr,$field
	 * @return	$retArr
	 */

	function getImplodeArray($arr,$field){
		if(count($arr) > 0){
			$compArr = '';

			for($i=0;$i<count($arr);$i++){
				$compArr.= $arr[$i][''.$field.''].",";
			}
		}
		$retArr = substr($compArr,0,-1);
		return $retArr;
	}

	/**
	* @Return the Table Informations
	* @$para 	$table,$where
	* @return	$db_sql
	**/

	public function getreqtableinfo($table,$where="",$field="*",$var_limit="",$orderBy=''){
		global $dbobj;
		if($where != ''){
			$where_con = "where ".$where."";
		}else{
			$where_con = "";
		}
		$sql= "select $field from $table  $where_con $orderBy $var_limit";
         // print $sql;
		$db_sql =$dbobj->MySqlSelect($sql);
		return $db_sql;
	}

	/**
     * DBGeneral::getInfoTable()
	 * @tablename,iPrimaryId,iPriValue,eType,$extra
	 * get Table Information and assign each value to it's field
	*/
	 function getInfoTable($tablename,$iPrimaryId,$iPriValue,$eType="",$extra=""){
		global $dbobj;
		$sql_select = "SELECT * FROM $tablename WHERE $iPrimaryId = '".$iPriValue."' $extra";

		$db_select = $dbobj->MySQLSelect($sql_select);
		return $db_select;
	}

	/**
     * DBGeneral::getEnumSelect
	 * @param 	$tablename,$field,$Name,$Id,$Onchange,$val
	 * @return	Enum values in dropdown
	 */

	public function getEnumSelect($tablename,$field,$Name,$Id,$Onchange="",$val,$ext="",$validmsg="",$nulloption="",$notin="")
	{
		global	$$field;
		$sel_field=$val;
		if($Onchange!='')
			$Onchange="Onchange='$Onchange'";
		else
			$Onchange='';
		if($validmsg !=''){
			$validationmsg = 	" validationmsg='".$validmsg."'";
		}else{
			$validationmsg = 	"";
		}
		$notinArr = array();
		if($notin != ''){
			$notinArr = @ explode(",",$notin);
		}
		//echo $Onchange;
      // echo $field.'-'.$tablename;
		$enum_Arr = $this->mysqlEnumValues($tablename,$field);
      // prints($enum_Arr); exit;
		$enum_Arr_box = '<select name="'.$Name.'" '.$validationmsg.' id="'.$Id.'" '.$Onchange.' '.$ext.'>';
		if($nulloption != ""){
			$enum_Arr_box.='<option value="">'.$nulloption.'</option>';
		}
		  for($x=0;$x<count($enum_Arr);$x++)
		  {
		  	if($sel_field==$enum_Arr[$x])
				$sel="selected";
			else
				$sel="";
			 if(!@ in_array($enum_Arr[$x],$notinArr)){
			 	$enum_Arr_box.='<option '.$sel.' value="'.$enum_Arr[$x].'">'.$enum_Arr[$x].'</option>';
			 }
		  }
	  $enum_Arr_box.="</select>";
	  return $enum_Arr_box;
	}

	/**
     * DBGeneral::DynamicDropDown()
	 * @Pass the fields as an Array
	 * @param 	$CombArr
	 * @return	Dynamic DropDown
	 */

	public function DynamicDropDown($CombArr)
	{

		global $dbobj;
		$ID = $CombArr['ID'];
		$height = '';
		$onchange = '';
		if($CombArr['width'] != '')
			$width = $CombArr['width'];
		if($CombArr['height'] != '')
			$height = $CombArr['height'];
		if($CombArr['onchange']!="")
			$onchange = "onchange='".$CombArr['onchange']."'";
		if($CombArr['multiple_select'] != ""){
			$Name = $CombArr['Name'].'[]';
		    $multiple_select = "multiple";
		}else{
			$Name = $CombArr['Name'];
			$multiple_select="";
		}
		$extra = '';
		$Title = '';
		if($CombArr['extra'] != '')
			$extra = $CombArr['extra'];
   	if(isset($CombArr['title']) && $CombArr['title'] != '')
			$Title = $CombArr['title'];
		if($CombArr['selectedVal'] != '')
			$selectedVal = explode(",",$CombArr['selectedVal']);
		else
			$selectedVal = "";

		switch($CombArr['Type']) {
			case "Query":
				$groupby = '';
				$orderby = '';
			    if(isset($CombArr['groupby']) && $CombArr['groupby']!='')
				 		$groupby="group by ".$CombArr['groupby']."";
					if($CombArr['orderby']!='')
				 		$orderby="order by ".$CombArr['orderby']."";
					if($CombArr['extVal'] != "")
						$ssql = "".$CombArr['fieldId'].",".$CombArr['fieldName'].",".$CombArr['extVal']." ";
					else
						$ssql = "".$CombArr['fieldId'].",".$CombArr['fieldName']."";
					if($CombArr['where'] == '')
						$where=" 1=1 ";
					else
						$where=" ".$CombArr['where']."";
					$sql="SELECT $ssql FROM ".$CombArr['tableName']." where ".$where." ".$groupby." ".$orderby."";
					# echo $sql.'<br/>'; // exit;
					$catres = $dbobj->MySQLSelect($sql);
					//print_r($catres);
			break;
			case "Array":
					$catres = $CombArr['values'];
			break;
		}

		$groupdropdown = "";
		$clas = (isset($CombArr['class']))? $CombArr['class'] : '';
		$groupdropdown.= "<select  class=\"input1 ".$clas."\" name=\"$Name\" id=\"$ID\" validationmsg=\"".$CombArr['validationmsg']."\" $multiple_select style=\"width:$width;height:$height\" $onchange $extra title=\"$Title\">";
			if($CombArr['selectText'] != '')
				if($CombArr['selectText'] == 'All'){
					$groupdropdown.= "<option value=\"\" selected>".$CombArr['selectText']."</option>";
				}else{
					$groupdropdown.= "<option value=\"\">".$CombArr['selectText']."</option>";
				}


			for($g=0;$g<count($catres);$g++)
			{
				$cid = $catres[$g]["".$CombArr['fieldId'].""];
				$cname = $catres[$g]["".$CombArr['fieldName'].""];
				$extname = (isset($catres[$g]["".$CombArr['extVal'].""]))? $catres[$g]["".$CombArr['extVal'].""] : '';
				if ($CombArr['extVal'] != "")
					$vData = "$cname&nbsp;&nbsp;&nbsp;($extname)";
				else
					$vData = "$cname";
				if(@in_array($cid,$selectedVal)){
					$selected =  "selected";
				}else{
					$selected =  "";
				}
					$groupdropdown .= "<option value=\"$cid\" $selected >".stripslashes($vData)."</option>";
			}
		$groupdropdown .= "</select>";
		return $groupdropdown;
	}


	/**
	* @access	public
	* @Return Required Array for Display In Listing
	* @$para 	$table,$join="",$joinrel,$where
	* @return	$db_sql
	*/

	public function getJoinData($table,$join="",$joinrel,$where=" 1",$GroupBy="",$fields="*"){
		global $dbobj;
		$ext = "".($join != '')? "LEFT JOIN ".$join." ON(".$joinrel.")":" "."" ;
		if($GroupBy != ''){
			$groupby = " GROUP BY ".$GroupBy."";
		}else{
			$groupby = "";
		}
		$sql= "select ".$fields." from $table  $ext where $where $groupby";
		//echo $sql;
		$db_sql =$dbobj->MySqlSelect($sql);
		return $db_sql;
	}

   //Function To Get Active Language
	public function getLanguage(){
		global $dbobj;
		$sql 		= "SELECT iLanguageId,vLanguage,vLanguageCode
                  FROM ".PRJ_DB_PREFIX."_language
                  WHERE eStatus = 'Active'
                  ORDER BY iLanguageId";
		$db_sql		= $dbobj->MySQLSelect($sql);
		return $db_sql;
	}

   public function createdynfolder($path){
		//create image folder if not exists
		$pathfolder = explode("/",str_replace(SPATH_ROOT, "", $path));
		$realpath = "";
		for($p=0;$p<count($pathfolder);$p++){
			if($pathfolder[$p] != ''){
				$realpath = $realpath.$pathfolder[$p]."/";
				$makefolder = SPATH_ROOT."/".$realpath;
				if(!is_dir($makefolder)){
					$makefolder = @mkdir($makefolder,0777);
					chmod($makefolder, 0777);
				}
			}
		}
		//ends here
		return  $makefolder;
	}

     /**
     * DBGeneral::getMaxId()
	 * @tablename,iPrimaryId,iPriValue,eType,$extra
	 * get Last Insert Id
	*/
	public function getMaxId($tablename,$iPrimaryId){
		global $dbobj;
		$sql_select = "SELECT Max($iPrimaryId) as id FROM $tablename";

		$db_select = $dbobj->MySQLSelect($sql_select);
		return $db_select;
	}
}
?>