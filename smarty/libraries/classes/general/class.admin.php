<?php  
/**
 * This Class is for Admin Section
 * @package		class.admin.php
 * @general		general 
*/

Class Admin
{
	public function __construct(){}


	/**
	* @access	public
	* @Check Admin Authentification
	* @return	True/False
	*/

	public function chkAuth($userName,$password,$type=""){
		global $dbobj;
		if($type != ""){
			$wh = $type;
		}
		$listField	=$dbobj->MySQLGetFieldsQuery("".PRJ_DB_PREFIX."_administrator");
		//print_r($listField);exit;
		$sql = "select $listField from ".PRJ_DB_PREFIX."_administrator where vUsername= '".$userName."' AND vPassword = '".$password."' ".$wh."";
		$db_sql= $dbobj->MySQLSelect($sql);
		if(count($db_sql) > 0){
			if($db_sql[0]['eStatus'] == "Inactive"){
				$success=  "2";
			}else{
				$success=  "1";
				$_SESSION[''.PRJ_CONST_PREFIX.'_SESS_USERTYPE']="Admin";
				$_SESSION[''.PRJ_CONST_PREFIX.'_SESS_USERID']=$db_sql[0]['iAdminId'];
				$_SESSION[''.PRJ_CONST_PREFIX.'_SESS_NAME']=$db_sql[0]['vFirstName']." ".$db_sql[0]['vLastName'];
				$_SESSION[''.PRJ_CONST_PREFIX.'_SESS_USERNAME']=	$db_sql[0]['vUsername'];
				$_SESSION[''.PRJ_CONST_PREFIX.'_SESS_A_ROLE'] = $db_sql[0]['eType'];				
				$Data = array(
							'iAdminId'		=> $db_sql[0]['iAdminId'],
							'vName'			=> $_SESSION[''.PRJ_CONST_PREFIX.'_SESS_NAME'],
							'vUsername'		=> $db_sql[0]['vUsername'],
							'eType'			=> $db_sql[0]['eType'],
							'vIP'			=> $_SERVER['REMOTE_ADDR'],
							'dLoginDate'	=> date("Y-m-d H:i")
							);
				$iLogsId = $dbobj->MySQLQueryPerform(''.PRJ_DB_PREFIX.'_login_history',$Data,'insert');
				$_SESSION[''.PRJ_CONST_PREFIX.'_SESS_ID_LOG']=$iLogsId;
				$sql = "update ".PRJ_DB_PREFIX."_administrator set dLastAccess ='".date("Y-m-j H-i-s")."',
								iTotLogin = iTotLogin+1
								where iAdminId = '".$db_sql[0]['iAdminId']."'";
				$dbobj->sql_query($sql);
			}
		}else{
			$success=  "0";
		}
		return $success;
	}

	/**
	* @access	public
	* @Return Required Relation Array to Display on Listing.
	* @$para 	$parenttable,$primaryId,$where1,$relId,$reltable,$where2,$secondField,$tot
	* @return	$result
	*/

	public function getRelationArr($parenttable,$primaryId,$where1,$relId,$reltable,$where2,$secondField,$tot)
	{
		global $generalobj;
		//echo $parenttable;

		$MainArr = $generalobj->getTableInfo($parenttable,$where1,$relId.",".$primaryId);
		//print_r($MainArr);
		//exit;
		$SecArr = $generalobj->getTableInfo($reltable,$where2,$relId.",".$secondField);

		for($i=0; $i<count($MainArr); $i++)
		{
			$cnt = 1;
			for($j=0;$j<count($SecArr);$j++)
			{
				$val = @explode(",",$SecArr[$j]["".$relId.""]);
				if($SecArr[$j]["".$relId.""] == $MainArr[$i]["".$relId.""] || @in_array($MainArr[$i]["".$relId.""],$val))
				{

					$sArr[$i][ID] = $MainArr[$i]["".$relId.""];

					if($tot == "Yes")
						$sArr[$i]['total'] = $cnt;
					else
						$sArr[$i]['Name'] = $SecArr[$j]["".$secondField.""];

					$cnt++;
				}
			}
		}
		$result = $generalobj->RecompileArray($sArr);

		/*echo  "<pre>";
		print_r($result);
		exit;*/
		return $result;
	}

	function chkFPassword($vUserName){
		global $dbobj;
		if($vAnswer != '')

		$listField	=$dbobj->MySQLGetFieldsQuery("".PRJ_DB_PREFIX."_administrator");
		$sql = "select ca.iAdminId,concat(ca.vFirstName,' ',ca.vLAstName) as Name,ca.vUsername,ca.vPassword,ca.vEmail
				from ".PRJ_DB_PREFIX."_administrator ca where ca.vUsername= '".$vUserName."'";
		$db_sql= $dbobj->MySQLSelect($sql);
		return $db_sql;
	}

  	public function hcntlist($table,$where)
	{
		global $dbobj;
		$sql = "select count(*) as tot from $table $where";
		$db_sql= $dbobj->MySQLSelect($sql);
		return $db_sql;
	}

	//get last login of administrator
	public function lastlogin()
	{
		global $dbobj;
		$sql = "select vIP,dLoginDate from ".PRJ_DB_PREFIX."_login_history order by iLLogsId DESC LIMIT 1,1";
		$db_sql= $dbobj->MySQLSelect($sql);
		return $db_sql;
	}   
}
?>