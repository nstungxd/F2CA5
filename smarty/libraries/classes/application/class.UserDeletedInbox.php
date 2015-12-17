<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        UserDeletedInbox
* GENERATION DATE:  26.04.2010
* CLASS FILE:       /home/www/B2B/libraries/classes/application/class.UserDeletedInbox.php
* FOR MYSQL TABLE:  b2b_user_deleted_inbox
* FOR MYSQL DB:     B2B
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*
*/

class UserDeletedInbox
{


/**
*   @desc Variable Declaration with default value
*/

	protected $iDelInboxId;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iDelInboxId;
	protected $_iUserId;
	protected $_eUserType;
	protected $_iInboxId;
	protected $_eViewed;


/**
*   @desc   CONSTRUCTOR METHOD
*/

	function __construct()
	{
		global $dbobj;
		$this->_obj = $dbobj;

		$this->_iDelInboxId = null;
		$this->_iUserId = null;
		$this->_eUserType = null;
		$this->_iInboxId = null;
		$this->_eViewed = null;
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


	public function getiDelInboxId()
	{
		return $this->_iDelInboxId;
	}

	public function getiUserId()
	{
		return $this->_iUserId;
	}

	public function geteUserType()
	{
		return $this->_eUserType;
	}

	public function getiInboxId()
	{
		return $this->_iInboxId;
	}

	public function geteViewed()
	{
		return $this->_eViewed;
	}


/**
*   @desc   SETTER METHODS
*/


	public function setiDelInboxId($val)
	{
		 $this->_iDelInboxId =  $val;
	}

	public function setiUserId($val)
	{
		 $this->_iUserId =  $val;
	}

	public function seteUserType($val)
	{
		 $this->_eUserType =  $val;
	}

	public function setiInboxId($val)
	{
		 $this->_iInboxId =  $val;
	}

	public function seteViewed($val)
	{
		$this->_eViewed = $val;
	}


/**
*   @desc   SELECT METHOD / LOAD
*/

	function select($id)
	{
			if(($id > 0) && (trim($id) != ''))
			{
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_user_deleted_inbox WHERE iDelInboxId = $id";
			} else {
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_user_deleted_inbox WHERE iDelInboxId=$this->_iDelInboxId ";
		 }
		 $row =  $this->_obj->MySQLSelect($sql);

		$this->_iDelInboxId = $row[0]['iDelInboxId'];
		$this->_iUserId = $row[0]['iUserId'];
		$this->_eUserType = $row[0]['eUserType'];
		$this->_iInboxId = $row[0]['iInboxId'];
		$this->_eViewed = $row[0]['eViewed'];
		return $row;
	}


/**
*   @desc   DELETE
*/

	function delete($id)
	{
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_user_deleted_inbox WHERE iDelInboxId = $id";
		 return $result = $this->_obj->sql_query($sql);
	}


/**
*   @desc   INSERT
*/

	function insert()
	{
		 $this->_iDelInboxId = '';
		 $this->iDelInboxId = ""; // clear key for autoincrement

		$Data = array(
						'iUserId'		=>	$this->_iUserId,
						'eUserType'		=>	$this->_eUserType,
						'iInboxId'		=>	$this->_iInboxId,
						'eViewed'		=>	$this->_eViewed,
		);

		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_user_deleted_inbox",$Data,'insert');
		  return $result;
	}


/**
*   @desc   UPDATE
*/

	function update($where)
	{

		$Data = array(
						'iUserId'		=>	$this->_iUserId,
						'eUserType'		=>	$this->_eUserType,
						'iInboxId'		=>	$this->_iInboxId,
						'eViewed'		=>	$this->_eViewed,
		);

		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_user_deleted_inbox",$Data,'update',$where);
		return $result;

	}


	function updateData($data,$where)
	{
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_user_deleted_inbox",$data,"update",$where);
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
       if($groupBy != "") {
          $cnt .= " Group By ".$groupBy;
       }
       if($orderBy != "") {
          $cnt .= " Order By ".$orderBy;
       }
       $sql =  "SELECT $feild FROM ".PRJ_DB_PREFIX."_user_deleted_inbox $cnt $limit";
		 $row =  $this->_obj->MySQLSelect($sql);
       return $row;
	}

   /**
	*   @desc   GET DETAILS WITH PAGING AND JOINED TABLE IF REQUIRED
	*/
   function getJoinTableInfo($jtbl,$fields="*",$where="",$orderBy="",$groupBy="",$limit="",$pg="") {
		if($where != "") {
         $cnt = " Where 1 ".$where;
      }
		if($groupBy != "") {
         $cnt .= " Group By ".$groupBy;
      }
		if($orderBy != "") {
         $cnt .= " Order By ".$orderBy;
      }

      $sql =  "SELECT $fields FROM ".PRJ_DB_PREFIX."_user_deleted_inbox $jtbl $cnt $limit";
		$row = $this->_obj->MySQLSelect($sql);
		if($pg=="yes")
		{
			$sql_count =  "SELECT Count(*) as tot FROM ".PRJ_DB_PREFIX."_user_deleted_inbox $jtbl $cnt";
			$row_count = $this->_obj->MySqlSelect($sql_count);
			$row[tot] = $row_count[0][tot];
		}
      return $row;
	}
}
?>