<?php
/**
 * This Class is for Admin General Section
 * @package		class.general.php
 * @general		general
*/

Class General
{
	public function __construct(){}

	/**
	* @access	public
	* @Print Element input type
	*/

	public function PrintElement($Name,$Id,$Value,$Type,$msg='',$ext='',$Title='')
	{
	   $width = (isset($width))? $width : '';
		if($Type != 'checkbox' && $ext == '')
			$width ="style=\"width:220px\"";
		$div = "<input type=\"$Type\"  autocomplete=\"off\" validationmsg=\"$msg\"  ".$width." name=\"$Name\" id=\"$Id\" title=\"$Title\" value=\"".stripslashes($Value)."\" $ext />";
		return $div;
	}

	/**
	* @access	public
	* @Print File  Input type
	*/

	public	function PrintFile($Name,$Id,$Value,$Type,$msg='',$ext='')
	{
		$div = "<input type=\"$Type\"  style=\"width:200px\" validationmsg=\"$msg\"  name=\"$Name\" id=\"$Id\" value=\"$Value\" $ext/>";
	return $div;
	}

	/**
	* @access	public
	* @Print Textarea
	*/

	public function PrintTextArea($Name,$Id,$Value,$ext='',$msg='') {
		$div = "<textarea name=\"$Name\" id=\"$Id\"  validationmsg=\"$msg\" ".$ext.">".stripslashes($Value)."</textarea>";
	return $div;
	}

	/**
	* @$generalobj->RecompileArray
	* @Recompile the given Array
	* @param 	$arr
	* @return	$new_arr
	*/

	public function RecompileArray($arr)
	{
		$new_arr  = array();
		$i=0;
		if($arr != "")
		{
			foreach($arr as $key=>$val)
	  		{
	  	    	$new_arr[$i]= $arr[$key];
		    	$i++;
	  		}
		}
		return $new_arr;
	}

	/**
	* @Return the Table Informations
	* @$para 	$table,$where
	* @return	$db_sql
	**/

	public function getTableInfo($table,$where,$field="*",$var_limit="",$orderBy='',$groupby=""){
		global $dbobj;
		if($groupby != "") {
			$GroupBy = " GROUP BY ".$groupby."";
		} else {
			$GroupBy = "";
		}
		$sql= "select $field from $table where 1 $where ".$GroupBy." $orderBy $var_limit";
		// echo $sql."<br>"; exit;
		$db_sql =$dbobj->MySqlSelect($sql);
		return $db_sql;
	}

	/**
		* @getParentChildCombo
		* @Get Parent Child relationship Combo
		* @$fieldsArr,$iParentId,$old_cat,$iCatIdNot,$loop
		* @return	$reqCombo;
	*/

	public function getParentChildCombo($fieldsArr,$iParentId=0,$old_cat="",$iCatIdNot="0",$loop="1")
	{
		global $dbobj,$par_cat_arr;
		//print_r($fieldsArr);exit;
		if(isset($fieldsArr['loop']))
			$limit = $fieldsArr['loop'];
		else
			$limit = '0';
		//echo $limit;exit;
		$sql_query = "select ".$fieldsArr[tabfields]." from ".$fieldsArr[tableName]." where iParentId ='$iParentId' AND ".$fieldsArr[where]."";

		if($iCatIdNot!="" && $iCatIdNot != "0")
		{
			$sql_query .= " and ".$fieldsArr[compVal]." <> '$iCatIdNot'";
		}
		$sql_query .= " order by ".$fieldsArr[compText]."";
		$db_cat_rs = $dbobj->MySQLSelect($sql_query);
		$n=count($db_cat_rs);

		if($n>0)
		{
			for($i=0 ; $i<$n ; $i++)
			{
				$par_cat_arr[]=array(
				''.$fieldsArr[compVal].''	=> 	$db_cat_rs[$i][''.$fieldsArr[compVal].''],
				''.$fieldsArr[compText].'' 	=>  $old_cat."--|".$loop."|&nbsp;&nbsp;".$db_cat_rs[$i][''.$fieldsArr[compText].''], 'loop'=>$loop);
				if($limit == 0){
					$this->getParentChildCombo($fieldsArr, $db_cat_rs[$i][''.$fieldsArr[compVal].''], $old_cat."&nbsp;&nbsp;&nbsp;&nbsp;", $iCatIdNot,$loop+1);
				}else{
					if($loop <$limit)
					$this->getParentChildCombo($fieldsArr, $db_cat_rs[$i][''.$fieldsArr[compVal].''], $old_cat."&nbsp;&nbsp;&nbsp;&nbsp;", $iCatIdNot,$loop+1);
				}
			}
			$old_cat = "";
		}

		//echo '<pre>';
		//print_R($par_cat_arr);exit;
		$reqCombo = $this->getCatCombo($fieldsArr,$par_cat_arr);
		return $reqCombo;
	}


	/**
	* @getCatCombo
	* @get Parent child relation Combo
	* @param 	$fieldsArr,$par_cat_arr
	* @return	$html(Combo)
	*/

	public function getCatCombo($fieldsArr,$par_cat_arr)
	{
		$fieldVal = $fieldsArr['compVal'];
		$fieldtext =  $fieldsArr['compText'];
		$selected	= $fieldsArr['slectedVal'];
		$extra	= $fieldsArr['extra'];
		$validationmsg = "validationmsg = '".$fieldsArr['validationmsg']."'";
		//echo '<pre>';
		//print_R($par_cat_arr);
		if($fieldsArr['SelectText'] != '')
		$MyText		=	$fieldsArr['SelectText'];
		else
		$MyText		=	"-----My self parent category -----------";
		$html= '';
		if($fieldsArr['onchange']	!= '')
			$onChange = "onchange='".$fieldsArr['onchange']."'";
		$html.='<select  name="'.$fieldsArr[Name].'" id="'.$fieldsArr[ID].'" style="'.$fieldsArr[combStyle].'" class="input" '.$onChange.' '.$validationmsg.' '.$extra.'>';
			$html.='<option value="">'.$MyText.'</option>';
				for($i=0,$n=count($par_cat_arr) ; $i<$n ; $i++)
				{
					$class="";$sel_cat ="";
					if($par_cat_arr[$i][''.$fieldVal.''] == $selected){
						$sel_cat = "selected";
						}
					if($par_cat_arr[$i]['loop']==1)
						$class="selecttext";

						$html.='<option class="'.$class.'" value="'. $par_cat_arr[$i][''.$fieldVal.''] .'" '.$sel_cat.'>'. $par_cat_arr[$i][''.$fieldtext.''].'</option>';
				}
		$html.='</select>';
		return $html;
	}
		/**
	* @Return the State Array Information
	**/

	public function getStateArray()
	{
		global $dbobj;
		$db_state=array();
		$i=0;
		$sql = "select iStateId,vCountryCode,vStateCode,vState from ".PRJ_DB_PREFIX."_state_master where eStatus='Active' order by vState";
		$db_state=$dbobj->MySQLSelect($sql);

		$statArr = "";
		for($j=0; $j<count($db_state); $j++)
		{
			if($j == count($db_state) -1){
				$statArr .= "[['".addslashes($db_state[$j]['vCountryCode']) ."'],['".addslashes($db_state[$j]['iStateId'])."'],['".addslashes($db_state[$j]['vState'])."'] ,['".addslashes($db_state[$j]['vStateCode'])."'] ]";
			}
			else{
				$statArr .= "[['".addslashes($db_state[$j]['vCountryCode']) ."'],['".addslashes($db_state[$j]['iStateId'])."'],['".addslashes($db_state[$j]['vState'])."'] ,['".addslashes($db_state[$j]['vStateCode'])."'] ],";
			}
				$checkstate[]= $db_state[$j]['vStateCode'];
		}

		$retState=array();
		$retState[0]=$statArr;
		$retState[1]=$checkstate;

		return $retState;
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
	* @Return the Price
	**/

	public function make_price($price)
	{
		$price = number_format($price,2, '.', '');
		return "$".$price;
	}

	/**
	* @getCountTable
	* @get Count of records of a given table
	* @param 	$table,$where
	* @return	$db_cat_rs[0][tot]
	*/

	public function getCountTable($table,$where=" 1=1 ")
	{
		global $dbobj;
		$sql_query = "select count(*) as tot from $table where $where";
		//echo $sql_query;exit;
		$db_cat_rs = $dbobj->MySQLSelect($sql_query);
		return $db_cat_rs[0][tot];
	}

	/**
	@GenerateDispOrder

	*/
	public function GenerateDispOrder($table,$where,$mode)
	{
		global $dbobj;
		//print_r($dispArr);
		if($where != ''){
			$whr = " WHERE ".$where;
		}else{
			$whr = " WHERE 1=1";
		}
		$sql_query = "select count(*) as tot from ".$table.$whr;

		$db_cat_rs = $dbobj->MySQLSelect($sql_query);
		//print_R($db_cat_rs);

		if($mode == 'edit'){
			$cnt=$db_cat_rs[0][tot];
		}else{
			$cnt=$db_cat_rs[0][tot] + 1;
		}
		//echo $cnt;
		//exit;
		return $cnt;
	}

	/**
	* @getTableData
	* @get table data with specific fields & conditions
	* @author 	Jack Scott
	*/

	public function getTableData($tableName,$fieldName,$condition,$orderBy='')
	{
		global $dbobj;
	 $sql = "select ".$fieldName." from ".$tableName." ".$condition." ".$orderBy."";
		//echo $sql;
		$db_sql = $dbobj->MySQLSelect($sql);
		return $db_sql;
	}

	/* Get Image Url */
	public function ShowImage($imgArr)
   {
		global $cfgimg;
		$section 	=	$imgArr['section'];
		$type		=	$imgArr['type'];
		$imgInfo 	= 	$cfgimg[''.$section.''][''.$type.''];
		$type	 	=	$cfgimg[''.$section.''][''.$type.''];
		$imgpath 	=	$imgInfo['path'];
		$imgurl	 	=	$imgInfo['url'];
		$imgConfig	=	$imgInfo['imgconfig'];
		for($i=0;$i<count($imgConfig);$i++)
		{
			$imgid = $i+1;
			$img_path= $imgpath.$imgArr['id'].'/'.$imgid.'_'.$imgArr['name'];

			if(is_file($img_path))
         {
				$img_url[$imgConfig[$i]['ID']]= $imgurl.$imgArr['id'].'/'.$imgid.'_'.$imgArr['name'];
			}
         else
         {
				$img_url[$imgConfig[$i]['ID']]= "";
			}
		}
		return $img_url ;
	}

	/* Get Image Path */
	public function GetImagePath($imgArr)
   {
		global $cfgimg;
		$section 	=	$imgArr['section'];
		$type		=	$imgArr['type'];
		$imgInfo 	= 	$cfgimg[''.$section.''][''.$type.''];
		$type	 	=	$cfgimg[''.$section.''][''.$type.''];
		$imgpath 	=	$imgInfo['path'];
		$imgurl	 	=	$imgInfo['url'];
		$imgConfig	=	$imgInfo['imgconfig'];
		for($i=0;$i<count($imgConfig);$i++)
		{
			$imgid = $i+1;
			// $img_path= $imgpath.$imgArr['id'].'/'.$imgid.'_'.$imgArr['name'];
			$img_path= $imgpath.$imgArr['id'].'/'.$imgArr['name'];
			if(is_file($img_path))
         {
				// $img_url[$imgConfig[$i]['ID']]= $imgurl.$imgArr['id'].'/'.$imgid.'_'.$imgArr['name'];
				return $img_path;
			}
         else
         {
				// $img_url[$imgConfig[$i]['ID']]= "";
				return "";
			}
		}
		return $img_path;
	}

   public function getFileUrl($id,$filename)
   {
      $filepath = FILES_UPLOAD_URL.$id.'/'.$filename;
      //echo $filepath;//; exit;
      return $filepath;
      // FILES_UPLOAD_PATH;
   }

   public function getFilePath($id,$filename)
   {
      $filepath = FILES_UPLOAD_PATH.$id.'/'.$filename;
      //echo $filepath; //exit;
      return $filepath;
      // FILES_UPLOAD_PATH;
   }

	/**
	* @Return Unique Code
	* @$para 	$prefix,$length,$list,$table,$field
	* @return	$code
	*/

	public function UniqueID($prefix,$table,$field,$charlimit="3")
	{
		global $dbobj;
		$sql  	= "select MAX($field) as ID from $table";
          //print $sql;
		$db_sql = $dbobj->MySQLSelect($sql);
		//print_r($db_sql);
		if($db_sql[0]['ID'] == "" || $db_sql[0]['ID'] == "0"){
			$code = "0000000001";
		}else{
               $code = substr($db_sql[0]['ID'],$charlimit,strlen($db_sql[0]['ID'])-2);
               $code = $code+1;
               $codelen = strlen($code)-1;
			if(strlen($code) < $charlimit+$codelen){
				$pad = $charlimit+$codelen - strlen($code)+1;
				$code = str_pad($code,$pad,"0", STR_PAD_LEFT);
			}
		}
		//print_r($code);
		//exit;
		return $prefix.$code;
	}

	/**
	* @Create Random number
	* @$pass 	min and max length
	* @$para 	$prefix,$length,$list,$table,$field
	* @return	$rand num
	*/

	public function Randnum($start,$end)
	{
		$rnum = rand($start,$end);
		$encrynum = md5($rnum);
		return $encrynum;
	}

	public function getRandomCodes($len='8',$num="Both")
	{
	   if($num == 'Yes'){
        $seed='0123456789';
     }elseif($num == 'No'){
        $seed='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
     }else{
        $seed='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
     }

  	 $r = '';
  	 while(strlen($r) < $len)
  	 {
  	   	$r .= $seed{mt_rand(0,61)};
  	 }
  	 if(strlen($r) > 6)
  	 	 return $r;
	}
	/**
	* @Create an Array For Displaying in Combo
	* @para 	$table,$where,$combVal,$combText,$iCompId
	* @return	$retres
	*/

	public function getUniqueCode($table,$field)
	{
		global $dbobj;
		$code = $this->getRandomCodes('10',"Both");
		$sql = "Select $field from $table where $field='$code'";
		$dtls = $dbobj->MySqlSelect($sql);
		if($code == $dtls[0]['vInvoiceCode']){
			$code = $this->getUniqueCode($table,$field);
		} else {
			return $code;
		}
		return $code;
	}

	function getRelatedArr($table,$where,$combVal,$combText,$iCompId){
		global $dbobj;
		$rescatArr = $this->getTableInfo($table,$where,'*','','');

		$resarr = "";
		for($j=0; $j<count($rescatArr); $j++)
		{
			if($j == count($rescatArr) -1){
				$resarr .= "[['".addslashes($rescatArr[$j][''.$combVal.'']) ."'],['".addslashes($rescatArr[$j][''.$combText.''])."'],['".addslashes($rescatArr[$j][''.$iCompId.''])."']]";
			}else{
				$resarr .= "[['".addslashes($rescatArr[$j][''.$combVal.'']) ."'],['".addslashes($rescatArr[$j][''.$combText.''])."'],['".addslashes($rescatArr[$j][''.$iCompId.''])."']],";
			}
			$checkres[]= $rescatArr[$j][''.$combVal.''];
		}
		$retrest=array();
		$retres[0]=$resarr;
		$retres[1]=$checkres;
		return $retres;
	}

	/**
	* @Delete All Relted records from table on delete one table record
	* @$relDeleteArr
	* @return	$result
	*/

	public function deleteRelRecord($relDeleteArr)
   {
		global $cfgimg,$dbobj;

		$chkedArr =explode(",",$relDeleteArr['checkedArr']);
		if(count($relDeleteArr['tables']) > 0){
			for($i=0;$i<count($relDeleteArr['tables']);$i++){

				if(count($relDeleteArr['relTa']) > 0){
					$r="0";
					foreach($relDeleteArr['relTa'] as $reltable){
						$del_sql = "SELECT ".$reltable['relationId']." FROM ".$relDeleteArr['tables'][$i]." WHERE  ".$relDeleteArr['relation']."";
						$reltab = @explode(",",$reltable['reltable']);
						if($relDeleteArr['tables'][$i] == $reltab[0]){
							$sql_rel = "DELETE  FROM ".$reltab[1]." WHERE ".$reltable['relationId']." in(".$del_sql.")";
							$db_sql_rel = $dbobj->sql_query($sql_rel);
						}
						$r++;
					}
				}
				$db_res = $dbobj->MySQLDelete($relDeleteArr['tables'][$i],$relDeleteArr['relation']);
			}
		}
		//print_r($relDeleteArr);exit;
		if(count($relDeleteArr['extDelete']) > 0){
			for($j=0;$j<count($relDeleteArr['extDelete']);$j++){
				$sql = "select ".$relDeleteArr['extDelete'][$j]['field']." as ID from ".$relDeleteArr['extDelete'][$j]['table']." where 1 AND ".$relDeleteArr['relation']."";
				$db_sql = $dbobj->MySQLselect($sql);
				if($relDeleteArr['extDelete'][$j]['imgType'] != ''){
					$imgesfolder = $cfgimg[''.$relDeleteArr['imgFolder'].''];
					$extimgespath = $imgesfolder[''.$relDeleteArr['extDelete'][$j]['imgType'].'']['path'];
					for($k=0;$k<count($db_sql);$k++){
						$extpath = $extimgespath.$db_sql[$k]['ID'];
						$this->deleteFolder($extpath);
					}
				}
				$db_res = $dbobj->MySQLDelete($relDeleteArr['extDelete'][$j]['table'],$relDeleteArr['relation']);
			}
		}
		if($relDeleteArr['imgFolder'] != ''){

			for($chk=0;$chk<count($chkedArr);$chk++)
			{
				$imgesfolder = $cfgimg[''.$relDeleteArr['imgFolder'].''];
				$imgarr[] = $relDeleteArr['imgtypes'];
				for($j=0;$j<count($imgarr);$j++){
					$imgPath = $imgesfolder[''.$imgarr[$j].'']['path'];
					$path = $imgPath.$chkedArr[$chk];

					$this->deleteFolder($path);
				}
			}
		}
		if($relDeleteArr['xmlPath'] != ''){
			$xmlPath = $relDeleteArr['xmlPath'];
			for($chk=0;$chk<count($chkedArr);$chk++)
			{
				$path = $xmlPath.$chkedArr[$chk];
			}
			$this->deleteFolder($path);
		}
		if($relDeleteArr['epsPath'] != ''){
			$epsPath = $relDeleteArr['epsPath'];
			for($chk=0;$chk<count($chkedArr);$chk++)
			{
				$path = $epsPath.$chkedArr[$chk];

			}
			$this->deleteFolder($path);
		}
		if($relDeleteArr['swfPath'] != ''){
			$swfPath = $relDeleteArr['swfPath'];
			for($chk=0;$chk<count($chkedArr);$chk++)
			{
				$path = $swfPath.$chkedArr[$chk];
			}
			$this->deleteFolder($path);
		}
		return true;
	}

	//@ for cascading Active/Inactive
	public function activeRelRecord($relActiveArr,$estautsfield="eStatus")
	{
		global $dbobj;
		//print_r($relActiveArr[".$estautsfield."]);exit;
		if(count($relActiveArr['tables']) > 0){
			for($i=0;$i<count($relActiveArr['tables']);$i++){

				if(count($relActiveArr['relTa']) > 0){
					$r="0";
					foreach($relActiveArr['relTa'] as $reltable){
						$del_sql = "SELECT ".$reltable['relationId']." FROM ".$relActiveArr['tables'][$i]." WHERE  ".$relActiveArr['relation']."";
						$reltab = @explode(",",$reltable['reltable']);
						if($relActiveArr['tables'][$i] == $reltab[0]){
							//".$reltable['relationId']."
							$sql_rel = "UPDATE  ".$reltab[1]." SET ".$estautsfield."='".$relActiveArr['eStatus']."' WHERE ".$reltable['relationId']." in(".$del_sql.")";

							$db_sql_rel = $dbobj->sql_query($sql_rel);
						}
						$r++;
					}
				}
				$sql = "UPDATE ".$relActiveArr['tables'][$i]."
						SET ".$estautsfield."='".$relActiveArr['eStatus']."'
						WHERE ".$relActiveArr['relation']." ";
				//echo $sql;
				$sel_rec=$dbobj->sql_query($sql);
			}
		}
		return true;
	}

	/**
	* @Delete Folder Including its Sub Folder
	* @$dirname
	* @return	true
	*/

	public function deleteFolder($dirname)
	{
		if(is_dir($dirname))
			$dir_exist = opendir($dirname);
		if (!$dir_exist)
			return false;

		while($file = readdir($dir_exist))
		{
			if ($file != "." && $file != ".."){
				if (!is_dir($dirname."/".$file))
					unlink($dirname."/".$file);
				else
					$this->deleteFolder($dirname.'/'.$file);
			}
		}
		closedir($dir_exist);
		rmdir($dirname);
		return true;
	}

	public function get_directory_files($dir) {
		//echo $dir;exit;
		if($handle = opendir($dir)) {
		   $cnt_file=0;
		   while(false !== ($file = readdir($handle))) {
				if($file==".." || $file==".")
					continue;
				else
			   		$file_arr[$cnt_file]=$file;
				$cnt_file++;
		   }
		   closedir($handle);
		}

		return $file_arr;
	}

	//get session id for recent online
	public function get_session_id($sessid = '') {
	    if (!empty($sessid)) {
	      return session_id($sessid);
	    } else {
	      return session_id();
	    }
	}

	//Enter Data for Recent online
	public function recent_online()
	{
		global $dbobj, $DEFAULT_TIME;
		//
		@ date_default_timezone_set('UTC');
		//
      $memtype = (isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE']))? $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE']: '';
         /*print"<pre>";
         print_r($_SESSION);
         print "A".$memtype."A";
         exit;*/
         switch($memtype){
               case 'orguser':
                     $memtype = 'OU';
                     break;
                case 'orgadmin':
                     $memtype='OA';
                     break;
               case 'securitymanager':
                  $memtype = 'SM';

               break;
            }
	   if (isset($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'])  &&  $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'] !="") {
	      $wo_member_id = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ID'];
		  $wo_full_name = str_replace("&nbsp;"," ",$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_NAME']);
	   } else {
	      $wo_member_id = '';
		  $wo_full_name = 'Guest';
	   }
	   $wo_session_id = $this->get_session_id();
	   $wo_ip_address = $this->getIP();
	   if(isset($_SERVER['HTTP_REFERER'])) {
	    	$wo_last_page_url = SITE_FOLDER."".str_replace(SITE_URL_DUM,"",$_SERVER['HTTP_REFERER']);
	   } else {
	    	$wo_last_page_url = SITE_FOLDER."".str_replace(SITE_URL_DUM,"","");
	   }
		 // $wo_last_page_url = SITE_FOLDER."".str_replace(SITE_URL_DUM,"",$_SERVER['HTTP_REFERER']);
		//$_SERVER['HTTP_REFERER'];
		getenv('REQUEST_URI');
		//print_r($wo_last_page_url);
	    $current_time = time();
	    $xx_mins_ago = ($current_time - 900);
	 	$current_time = date("Y-m-d H:i:s");
		// remove entries that have expired
	   $del_sql="delete from ".PRJ_DB_PREFIX."_recent_online where vTimeLastClick < '" . $xx_mins_ago . "'";
		$del_rec=$dbobj->sql_query($del_sql);

		$sel_sql = "select count(*) as count1 from ".PRJ_DB_PREFIX."_recent_online where vSessionId = '" . $wo_session_id . "'";
		$sel_rec=$dbobj->MySQLselect($sel_sql);
		// echo $wo_session_id; exit;
		// prints($sel_rec);exit;
	   if ($sel_rec[0]['count1']>0) {
			$up_sql="update ".PRJ_DB_PREFIX."_recent_online set iCustomerId = '".$wo_member_id."', vCutomerName  = '".$wo_full_name."' , eType='" . $memtype . "', vIP  = '".$wo_ip_address."', vTimeLastClick=NOW(), vLastPageUrl  = '".addslashes($wo_last_page_url). "' where vSessionId  = '".$wo_session_id."'";
			// echo $up_sql;exit;
			$up_rec=$dbobj->sql_query($up_sql);
		} else {
		   $ins_sql= "INSERT INTO `".PRJ_DB_PREFIX."_recent_online` ( `iCustomerId` , `vCutomerName` ,`eType`, `vSessionId` , `vIP` , `vTimeEntry` , `vTimeLastClick` , `vLastPageUrl` )
			            VALUES ('" . $wo_member_id . "', '" . $wo_full_name . "','" . $memtype . "', '" . $wo_session_id . "', '" . $wo_ip_address . "', NOW(), NOW(), '" . $wo_last_page_url . "');";
         // echo $ins_sql; exit;
		   $ins_rec=$dbobj->sql_query($ins_sql);
	   }
		//
		if(trim($DEFAULT_TIME)!='') {
			@ date_default_timezone_set("$DEFAULT_TIME");
		}
		//
	}

	public function getlogoutset()
	{
		global $dbobj;
		$sessid = session_id();
		$sql = "Select * from ".PRJ_DB_PREFIX."_recent_online where vSessionId='$sessid' AND eSetLogout='Yes'";
		$vl = $dbobj->MySqlSelect($sql);
		return $vl;
	}

	//gte Ip for recent online
	public function getIP()
	{
		if (getenv('HTTP_CLIENT_IP')) {
				$ip = getenv('HTTP_CLIENT_IP');
			}
			elseif (getenv('HTTP_X_FORWARDED_FOR')) {
				$ip = getenv('HTTP_X_FORWARDED_FOR');
			}
			elseif (getenv('HTTP_X_FORWARDED')) {
				$ip = getenv('HTTP_X_FORWARDED');
			}
			elseif (getenv('HTTP_FORWARDED_FOR')) {
				$ip = getenv('HTTP_FORWARDED_FOR');
			}
			elseif (getenv('HTTP_FORWARDED')) {
				$ip = getenv('HTTP_FORWARDED');
			}
			else {
				$ip = $_SERVER['REMOTE_ADDR'];
			}
			return $ip;
	}

	/*
	* @Name: getPostForm
	* @Parameter: POST_Arr,msg,action
 	* @Description: to get back data after posting and return to same page
	* @Return: posted data
	*/

	 public function getPostForm($POST_Arr,$msg="",$action="")
    {
        $str ='
        <html>
        <form name="frm1" action="'.$action.'" method=post>';
        foreach($POST_Arr as $key => $value){
            if(is_array($value)){
                foreach($value as $k=>$v) {
                    $str .='<br><input type="Hidden" name="'.$k.'" value="'.stripslashes($v). '">';
                }
            }else{
                $str .='<br><input type="Hidden" name="'.$key.'" value="'.stripslashes($value). '">';
            }
        }
        $str .='<input type="Hidden" name=var_msg value="'. $msg . '">
        </form>
        <script>
            document.frm1.submit();
        </script>
        </html>';
        echo $str ;
        exit;
    }

	public function random_text($len=8)
	  {
		 $seed='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		 $r = '';
		 while(strlen($r) < $len)
		 {
			$r .= $seed{mt_rand(0,61)};
		 }
		 if(strlen($r) > 6)
			 return $r;
	}

   public function getTabFlds($fld,$tbl,$cndt,$ord='')
	{
		global $dbobj;
	 	//$sql = "select ".$fld." from ".$tbl." ".$cndt." ".$ord."";
	 	$sql = "Select ".$fld." from ".$tbl." where ".$cndt.$ord;
//		echo $sql; //exit;
		$db_sql = $dbobj->MySQLSelect($sql);
		return $db_sql;
	}

	public function getMemberLogged($sess_id)
	{
		global $dbobj;
		$sql = "SELECT iloginId FROM ".PRJ_DB_PREFIX."_tra_login WHERE vSessionId = '".$sess_id."'";
		//echo $sql;
		$db_sql= $dbobj->MySQLSelect($sql);
		return $db_sql;
	}

      // Date : 08/09/2008
    // Used to get all the Request Variables
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

    # Date : 08/09/2008
    # Used to check Duplicate value
    public function checkDuplicate($iDbKeyName, $TableName, $db_duplicateFieldArr, $vRedirectFile, $msg, $iDbKeyValue='', $con=' or ')
    {
        global $dbobj;
        if($iDbKeyValue!='')
        {
            $ssql=" and $iDbKeyName <> '".$iDbKeyValue."'";
        }
        if(is_array($db_duplicateFieldArr)) {
            foreach ($db_duplicateFieldArr as $k=>$v)
            {
                $ssql_field[]=" $k = '".$v."' ";
            }
        }
        $ssql.= " and ( ".@implode($con , $ssql_field).")";
        $sql="select count($iDbKeyName) as tot from $TableName where 1 ".$ssql;
        //echo $sql;exit;
        $db_cnt = $dbobj->MySqlSelect($sql);
        if($db_cnt[0]['tot'] > 0)
        {
            $_POST['duplicate'] = 1;
            $this->getPostForm($_POST, $msg, $vRedirectFile);
            exit;
        }
    }

    /* Generate Random password for admin on forgot password */
	public function GenerateAdminPass($length='4'){
		$list="ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		//$list="0123456789";
		mt_srand((double)microtime()*1000000);
	    $newstring="";
	    if($length>0){
	        while(strlen($newstring)<$length){
	            $newstring.=$list[mt_rand(0, strlen($list)-1)];
	        }
	    }
		$code = $newstring;
		return $code;
	}

	public function sortarray($ary,$fld)
	{
		for($l=0;$l<count($ary);$l++) {
			for($ln=$l+1; $ln<count($ary); $ln++){
				if($ary[$ln][$fld] < $ary[$l][$fld])
				{
					$tmp = $ary[$ln];
					$ary[$ln] = $ary[$l];
					$ary[$l] = $tmp;
				}
			}
		}
		return $ary;
	}

    public function getCurrency($where='')
    {
          global $dbobj;
          if($where != '')
               $where=' Where '.$where;
          $sql = "Select iCurrencyID,vCode from ".PRJ_DB_PREFIX."_currency_master $where";
          $currency = $dbobj->MySqlSelect($sql);
          return $currency;
    }

	public function genUniqueCode($vl)
	{
		$code = "";
		$ts = @explode(" ",$vl[1]);
		$dval = @explode("-",$ts[0]);
		$tval = @explode(":",$ts[1]);
		$val = @mktime($tval[0],$tval[1],$tval[2],$dval[1],$dval[2],$dval[1],$dval[0]);
		$code = $vl[0].$val;
		return $code;
	}

	function xml2array($contents, $get_attributes = 1, $priority = 'tag')
	{
        $parser = xml_parser_create('');
        xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, "UTF-8");
        xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
        xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
        xml_parse_into_struct($parser, trim($contents), $xml_values);
        xml_parser_free($parser);
        if (!$xml_values) {
            return; //
        }
        $xml_array = array();
        $parents = array();
        $opened_tags = array();
        $arr = array();
        $current = & $xml_array;
        $repeated_tag_index = array();
        foreach ($xml_values as $data) {
            unset($attributes, $value);
            extract($data);
            $result = array();
            $attributes_data = array();
            if (isset($value)) {
                if ($priority == 'tag')
                    $result = $value;
                else
                    $result['value'] = $value;
            }
            if (isset($attributes) and $get_attributes) {
                foreach ($attributes as $attr => $val) {
                    if ($priority == 'tag')
                        $attributes_data[$attr] = $val;
                    else
                        $result['attr'][$attr] = $val; //Set all the attributes in a array called 'attr'
                }
            }
            if ($type == "open") {
                $parent[$level - 1] = & $current;
                if (!is_array($current) or (!in_array($tag, array_keys($current)))) {
                    $current[$tag] = $result;
                    if ($attributes_data)
                        $current[$tag . '_attr'] = $attributes_data;
                    $repeated_tag_index[$tag . '_' . $level] = 1;
                    $current = & $current[$tag];
                }
                else {
                    if (isset($current[$tag][0])) {
                        $current[$tag][$repeated_tag_index[$tag . '_' . $level]] = $result;
                        $repeated_tag_index[$tag . '_' . $level]++;
                    } else {
                        $current[$tag] = array(
                            $current[$tag],
                            $result
                        );
                        $repeated_tag_index[$tag . '_' . $level] = 2;
                        if (isset($current[$tag . '_attr'])) {
                            $current[$tag]['0_attr'] = $current[$tag . '_attr'];
                            unset($current[$tag . '_attr']);
                        }
                    }
                    $last_item_index = $repeated_tag_index[$tag . '_' . $level] - 1;
                    $current = & $current[$tag][$last_item_index];
                }
            } elseif ($type == "complete") {
                if (!isset($current[$tag])) {
                    $current[$tag] = $result;
                    $repeated_tag_index[$tag . '_' . $level] = 1;
                    if ($priority == 'tag' and $attributes_data)
                        $current[$tag . '_attr'] = $attributes_data;
                }
                else {
                    if (isset($current[$tag][0]) and is_array($current[$tag])) {
                        $current[$tag][$repeated_tag_index[$tag . '_' . $level]] = $result;
                        if ($priority == 'tag' and $get_attributes and $attributes_data) {
                            $current[$tag][$repeated_tag_index[$tag . '_' . $level] . '_attr'] = $attributes_data;
                        }
                        $repeated_tag_index[$tag . '_' . $level]++;
                    } else {
                        $current[$tag] = array(
                            $current[$tag],
                            $result
                        );
                        $repeated_tag_index[$tag . '_' . $level] = 1;
                        if ($priority == 'tag' and $get_attributes) {
                            if (isset($current[$tag . '_attr'])) {
                                $current[$tag]['0_attr'] = $current[$tag . '_attr'];
                                unset($current[$tag . '_attr']);
                            }
                            if ($attributes_data) {
                                $current[$tag][$repeated_tag_index[$tag . '_' . $level] . '_attr'] = $attributes_data;
                            }
                        }
                        $repeated_tag_index[$tag . '_' . $level]++; //0 and 1 index is already taken
                    }
                }
            } elseif ($type == 'close') {
                $current = & $parent[$level - 1];
            }
        }
        return ($xml_array);
    }

	function httpPost($url, $data, $method='POST') {
        $data_url = "";
        if (is_array($data) && count($data) > 0) {
            $data_url = http_build_query($data);
        } else {
            $data_url = $data;
        }
        $data_len = strlen($data_url);
        return array('contents' => file_get_contents($url, false, stream_context_create(array('http' => array('method' => $method, 'header' => "Connection: close\r\nContent-Length: $data_len\r\n", 'timeout' => 1000, 'content' => $data_url)))), 'headers' => $http_response_header);
    }

	function curl_get_file_contents($URL)
    {
		$c = curl_init();
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($c, CURLOPT_URL, $URL);
		$contents = curl_exec($c);
		curl_close($c);
		if ($contents) {
			return $contents;
		}
		return FALSE;
    }

	public function languageTranslation($src, $dest, $text, $fs='', $chk)
	{
		global $BING_TRANS_API, $FRENGLY_TRANS_USERNAME, $FRENGLY_TRANS_PASS;
		$dest = strtolower($dest);
		$src = strtolower($src);
		// using bing translation api
		$appId = $BING_TRANS_API;
		$org_txt = $text;
		$text = urlencode($text);
		$txt = '';
		if (trim($appId) != '' && ($fs == '' || $chk == 'y')) {
			# echo '<hr/>'."http://api.microsofttranslator.com/v2/Http.svc/Translate?appId=" . $appId . "&text=" . $text . "&from=$src&to=$dest".'<hr/>';
			$trans = $this->curl_get_file_contents("http://api.microsofttranslator.com/v2/Http.svc/Translate?appId=" . $appId . "&text=" . $text . "&from=$src&to=$dest");
			$tr = $this->xml2array($trans, 1);
			$txt = (isset($tr['string']) && is_string($tr['string'])) ? $tr['string'] : '';
			$txt = trim($txt);
		}
		if($chk == 'y') {
			$ntxt = $txt;
		}
		// using frengly.com api
		if ($txt == '' || strtolower($txt) == strtolower($org_txt) || $chk == 'y') {
			# echo '<hr/>'."http://www.frengly.com/controller?action=translateAnyAny&text=$text&s_langs=&lb_langs=$dest&dest=$dest&manualSrcLang=null&manualSrcLangLabel=null&action=none&crop_percent_size=100&input_convert_to=jpg&shipping=ar&wordSrc=$text&translated=&message=".'<hr/>';
			$username = $FRENGLY_TRANS_USERNAME;
			$password = $FRENGLY_TRANS_PASS;
			// $trans = file_get_contents("http://www.frengly.com/controller?action=translateREST&src=" . $src . "&dest=" . $dest . "&text=" . urlencode($text) . "&username=id.email003&password=hb@hb003");
			// $trans = file_get_contents("http://www.frengly.com/controller?action=translateAnyAny&crop_percent_size=100&input_convert_to=jpg&manualSrcLang=null&manualSrcLangLabel=null&lb_langs=$dest&s_langs=$src&src=$src&dest=$dest&text=".urlencode($text)."&username=id.email003&password=hb@hb003&wordSrc=".urlencode($text)."&shipping=ar&message=&translated=");
			# $trans = file_get_contents("http://www.frengly.com/controller?action=translateAnyAny&crop_percent_size=100&input_convert_to=jpg&manualSrcLang=null&manualSrcLangLabel=null&lb_langs=$dest&s_langs=$src&src=$src&dest=$dest&text=" . $text . "&username=" . $username . "&password=" . $password . "&wordSrc=" . $text . "&shipping=ar&message=&translated=");
			# $trans = $this->curl_get_file_contents("http://www.frengly.com/controller?action=translateAnyAny&crop_percent_size=100&input_convert_to=jpg&manualSrcLang=null&manualSrcLangLabel=null&lb_langs=$dest&s_langs=$src&src=$src&dest=$dest&text=" . $text . "&username=" . $username . "&password=" . $password . "&wordSrc=" . $text . "&shipping=ar&message=&translated=");
			$trans = $this->curl_get_file_contents("http://www.frengly.com/controller?action=translateAnyAny&text=$text&s_langs=&lb_langs=$dest&dest=$dest&manualSrcLang=null&manualSrcLangLabel=null&action=none&crop_percent_size=100&input_convert_to=jpg&shipping=ar&wordSrc=$text&translated=");
			$tr = $this->xml2array($trans, 0);
			$txt = utf8_decode($tr['response']['content']);     // return $tr['root']['translation'];
			$txt = trim($txt);
			if(strtolower($txt) == strtolower($org_txt) || trim($txt) == '') {
				$trans = $this->curl_get_file_contents("http://www.frengly.com/controller?action=translateREST&src=" . $src . "&dest=" . $dest . "&text=" . urlencode($text) . "&username=$FRENGLY_TRANS_USERNAME&password=$FRENGLY_TRANS_PASS");
				$tr = $this->xml2array($trans, 0);
				$txt = utf8_decode($tr['root']['details']['token']['dest']);     // return $tr['root']['translation'];
				$txt = trim($txt);
			}
		}
		if($txt == '' && $fs != '') {
			$trans = $this->curl_get_file_contents("http://api.microsofttranslator.com/v2/Http.svc/Translate?appId=" . $appId . "&text=" . $text . "&from=$src&to=$dest");
			$tr = $this->xml2array($trans, 1);
			$txt = (isset($tr['string']) && is_string($tr['string'])) ? $tr['string'] : '';
			$txt = trim($txt);
		}
		if($chk == 'y' && trim($ntxt) != trim($txt) && trim($ntxt)!='') {
			$txt = $ntxt;
		}
		//
		return $txt;
	}

}
?>