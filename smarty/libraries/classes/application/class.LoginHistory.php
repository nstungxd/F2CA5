<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        LoginHistory
* GENERATION DATE:  19.04.2010
* CLASS FILE:       /home/www/B2B/libraries/classes/application/class.LoginHistory.php
* FOR MYSQL TABLE:  b2b_login_history
* FOR MYSQL DB:     B2B
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*
*/

class LoginHistory
{


/**
*   @desc Variable Declaration with default value
*/

	protected $iLLogsId;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iLLogsId;
	protected $_iAdminId;
	protected $_vName;
	protected $_vUsername;
	protected $_eType;
	protected $_vIP;
	protected $_vSessionId;
	protected $_dLoginDate;
	protected $_dLogoutDate;


/**
*   @desc   CONSTRUCTOR METHOD
*/

	function __construct()
	{
		global $dbobj;
		$this->_obj = $dbobj;

		$this->_iLLogsId = null;
		$this->_iAdminId = null;
		$this->_vName = null;
		$this->_vUsername = null;
		$this->_eType = null;
		$this->_vIP = null;
		$this->_vSessionId = null;
		$this->_dLoginDate = null;
		$this->_dLogoutDate = null;
	}

/**
*   @desc   DECONSTRUCTOR METHOD
*/

	function __destruct()
	{
		unset($this->_dbobj);
	}



/**
*   @desc   GETTER METHODS
*/


	public function getiLLogsId()
	{
		return $this->_iLLogsId;
	}

	public function getiAdminId()
	{
		return $this->_iAdminId;
	}

	public function getvName()
	{
		return $this->_vName;
	}

	public function getvUsername()
	{
		return $this->_vUsername;
	}

	public function geteType()
	{
		return $this->_eType;
	}

	public function getvIP()
	{
		return $this->_vIP;
	}

	public function getvSessionId()
	{
		return $this->_vSessionId;
	}

	public function getdLoginDate()
	{
		return $this->_dLoginDate;
	}

	public function getdLogoutDate()
	{
		return $this->_dLogoutDate;
	}


/**
*   @desc   SETTER METHODS
*/


	public function setiLLogsId($val)
	{
		 $this->iLLogsId = $this->_iLLogsId =  $val;
	}

	public function setiAdminId($val)
	{
		 $this->_iAdminId =  $val;
	}

	public function setvName($val)
	{
		 $this->_vName =  $val;
	}

	public function setvUsername($val)
	{
		 $this->_vUsername =  $val;
	}

	public function seteType($val)
	{
		 $this->_eType =  $val;
	}

	public function setvIP($val)
	{
		 $this->_vIP =  $val;
	}

	public function setvSessionId($val)
	{
		$this->_vSessionId =  $val;
	}

	public function setdLoginDate($val)
	{
		 $this->_dLoginDate =  $val;
	}

	public function setdLogoutDate($val)
	{
		 $this->_dLogoutDate =  $val;
	}


/**
*   @desc   SELECT METHOD / LOAD
*/

	function select($id)
	{
		if(($id > 0) && (trim($id) != ''))
		{
			$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_login_history WHERE iLLogsId = $id";
		} else {
			$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_login_history WHERE iLLogsId=$this->_iLLogsId ";
		}
		$row =  $this->_obj->MySQLSelect($sql);

		$this->_iLLogsId = $row[0]['iLLogsId'];
		$this->_iAdminId = $row[0]['iAdminId'];
		$this->_vName = $row[0]['vName'];
		$this->_vUsername = $row[0]['vUsername'];
		$this->_eType = $row[0]['eType'];
		$this->_vIP = $row[0]['vIP'];
		$this->_vSessionId = $row[0]['vSessionId'];
		$this->_dLoginDate = $row[0]['dLoginDate'];
		$this->_dLogoutDate = $row[0]['dLogoutDate'];
		return $row;
	}


/**
*   @desc   DELETE
*/

	function delete($id)
	{
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_login_history WHERE iLLogsId = $id";
		 return $result = $this->_obj->sql_query($sql);
	}


/**
*   @desc   INSERT
*/

	function insert()
	{
		 $this->_iLLogsId = '';
		 $this->iLLogsId = ""; // clear key for autoincrement

		 $Data = array(
						 'iAdminId'		=>	$this->_iAdminId,
						'vName'		=>	$this->_vName,
						'vUsername'		=>	$this->_vUsername,
						'eType'		=>	$this->_eType,
						'vIP'		=>	$this->_vIP,
						'vSessionId'		=>	$this->_vSessionId,
						'dLoginDate'		=>	$this->_dLoginDate,
						'dLogoutDate'		=>	$this->_dLogoutDate
);

		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_login_history",$Data,'insert');
		  return $result;
	}


/**
*   @desc   UPDATE
*/

	function update($where)
	{
		 $Data = array(
						'iAdminId'		=>	$this->_iAdminId,
						'vName'		=>	$this->_vName,
						'vUsername'		=>	$this->_vUsername,
						'eType'		=>	$this->_eType,
						'vIP'		=>	$this->_vIP,
						'vSessionId'		=>	$this->_vSessionId,
						'dLoginDate'		=>	$this->_dLoginDate,
						'dLogoutDate'		=>	$this->_dLogoutDate
		);
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_login_history",$Data,'update',$where);
		return $result;
	}


	function updateData($data,$where)
	{
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_login_history",$data,"update",$where);
		return $result;
	}

	/**
	*   @desc   SET ALL VARIABLE
	*/
	function setAllVar($Data=array())
	{
		$MethodArr = get_class_methods($this);
		if(count($Data) > 0){
			foreach($Data AS $KEY => $VAL) {
				$method = "set".$KEY;
				if(in_array($method , $MethodArr))
				{
				  @call_user_method($method,$this,$VAL);
				}
			}
		}else{
			foreach($_REQUEST AS $KEY => $VAL) {
				$method = "set".$KEY;
				if(in_array($method , $MethodArr))
				{
				  @call_user_method($method,$this,$VAL);
				}
			}
		}
	}

	/**
	*   @desc   GET ALL VARIABLE
	*/

	function getAllVar()
	{
		$MethodArr = get_class_methods($this);
		$method_notArr=Array('getAllVar');
		$evalStr='';
		for($i=0;$i<count($MethodArr);$i++)
		{
			if(substr($MethodArr[$i] , 0 ,3) == 'get' && (!(in_array($MethodArr[$i],$method_notArr))))
			{
				$var_name = substr($MethodArr[$i] , 3 );
				$evalStr.= 'global $'.$var_name.'; $'.$var_name.' = $this->'.$MethodArr[$i]."();";
			}
		}
		eval($evalStr);
	}

   /**
	*   @desc   GET DETAILS
	*/

   function getDetails($feild="*",$where="",$orderBy="",$groupBy="",$limit="")
	{
       if($where != "") {
         $cnt = " Where 1 ".$where;
       }
       if($orderBy != "") {
         $cnt .= " Order By ".$orderBy;
       }
		 if($groupBy != "") {
         $cnt .= " Group By ".$groupBy;
       }
       $sql =  "SELECT $feild FROM b2b_login_history $cnt $limit";
		 $row =  $this->_obj->MySQLSelect($sql);
       return $row;
	}
}
?>