<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        OrganizationPermission
* GENERATION DATE:  17.04.2010
* CLASS FILE:       /home/www/B2B/libraries/classes/application/class.OrganizationPermission.php
* FOR MYSQL TABLE:  b2b_organization_group_permission
* FOR MYSQL DB:     B2B
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*
*/

class OrganizationPermission
{


/**
*   @desc Variable Declaration with default value
*/

	protected $iPermissionID;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iPermissionID;
	protected $_iGroupID;
	protected $_iStatusID;
	protected $_ePermissionType;



/**
*   @desc   CONSTRUCTOR METHOD
*/

	function __construct()
	{
		global $dbobj;
		$this->_obj = $dbobj;

		$this->_iPermissionID = null;
		$this->_iGroupID = null;
		$this->_iStatusID = null;
		$this->_ePermissionType = null;
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


	public function getiPermissionID()
	{
		return $this->_iPermissionID;
	}

	public function getiGroupID()
	{
		return $this->_iGroupID;
	}

	public function getiStatusID()
	{
		return $this->_iStatusID;
	}

	public function getePermissionType()
	{
		return $this->_ePermissionType;
	}


/**
*   @desc   SETTER METHODS
*/


	public function setiPermissionID($val)
	{
		 $this->_iPermissionID =  $val;
	}

	public function setiGroupID($val)
	{
		 $this->_iGroupID =  $val;
	}

	public function setiStatusID($val)
	{
		 $this->_iStatusID =  $val;
	}

	public function setePermissionType($val)
	{
		 $this->_ePermissionType =  $val;
	}


/**
*   @desc   SELECT METHOD / LOAD
*/

	function select($id)
	{
		 $sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_organization_group_permission WHERE iPermissionID = $id";
		 $row =  $this->_obj->MySQLSelect($sql);

		 $this->_iPermissionID = $row[0]['iPermissionID'];
		 $this->_iGroupID = $row[0]['iGroupID'];
		 $this->_iStatusID = $row[0]['iStatusID'];
		 $this->_ePermissionType = $row[0]['ePermissionType'];
 return $row;
	}


/**
*   @desc   DELETE
*/

	function delete($id)
	{
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_organization_group_permission WHERE iPermissionID = $id";
		 return $result = $this->_obj->sql_query($sql);
	}

	function del($where)
	{
       $sql = "DELETE FROM ".PRJ_DB_PREFIX."_organization_group_permission WHERE 1 $where";
           //echo $sql;exit;
		 return $result = $this->_obj->sql_query($sql);
	}

/**
*   @desc   INSERT
*/

	function insert()
	{
		 $this->iPermissionID = ""; // clear key for autoincrement

		 $Data = array(
						 'iGroupID'		=>	$this->_iGroupID,
						'iStatusID'		=>	$this->_iStatusID,
						'ePermissionType'		=>	$this->_ePermissionType
);

		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_organization_group_permission",$Data,'insert');
		  return $result;
	}


/**
*   @desc   UPDATE
*/

	function update($id)
	{

		 $Data = array(
						 'iGroupID'		=>	$this->_iGroupID,
						'iStatusID'		=>	$this->_iStatusID,
						'ePermissionType'		=>	$this->_ePermissionType
);

		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_organization_group_permission",$Data,'update',$upd);
		  return $result;

	}

	/**
	*   @desc   SET ALL VARIABLE
	*/

	function setAllVar()
	{
		$MethodArr = get_class_methods($this);
		foreach($_REQUEST AS $KEY => $VAL)
		{
			$method = "set".$KEY;
			if(in_array($method , $MethodArr))
			{
			  @call_user_method($method,$this,$VAL);
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

   function getDetails($feild="*",$where="",$OrderBy="") {
           if($where != "") {
              $cnt = " Where 1 ".$where;
           }
           if($OrderBy != "") {
              $cnt .= " Order By ".$OrderBy;
           }
           $sql =  "SELECT $feild FROM b2b_organization_group_permission $cnt";
           $row =  $this->_obj->MySQLSelect($sql);
           return $row;
   }
}
?>