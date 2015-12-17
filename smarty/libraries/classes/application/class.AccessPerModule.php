<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        AccessPerModule
* GENERATION DATE:  10.04.2010
* CLASS FILE:       /home/www/B2B/libraries/classes/application/class.AccessPerModule.php
* FOR MYSQL TABLE:  b2b_acc_mod_per
* FOR MYSQL DB:     B2B
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*
*/

class AccessPerModule
{


/**
*   @desc Variable Declaration with default value
*/

	protected $iAMPerId;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iAMPerId;
	protected $_eAdminType;
	protected $_tListing;
	protected $_tAdd;
	protected $_tUpdate;
	protected $_tDelete;
	protected $_tActive;
	protected $_tInactive;
	protected $_tBlock;
	protected $_tSearch;
	protected $_iAdminId;



/**
*   @desc   CONSTRUCTOR METHOD
*/

	function __construct()
	{
		global $dbobj;
		$this->_obj = $dbobj;

		$this->_iAMPerId = null;
		$this->_eAdminType = null;
		$this->_tListing = null;
		$this->_tAdd = null;
		$this->_tUpdate = null;
		$this->_tDelete = null;
		$this->_tActive = null;
		$this->_tInactive = null;
		$this->_tBlock = null;
		$this->_tSearch = null;
		$this->_iAdminId = null;
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


	public function getiAMPerId()
	{
		return $this->_iAMPerId;
	}

	public function geteAdminType()
	{
		return $this->_eAdminType;
	}

	public function gettListing()
	{
		return $this->_tListing;
	}

	public function gettAdd()
	{
		return $this->_tAdd;
	}

	public function gettUpdate()
	{
		return $this->_tUpdate;
	}

	public function gettDelete()
	{
		return $this->_tDelete;
	}

	public function gettActive()
	{
		return $this->_tActive;
	}

	public function gettInactive()
	{
		return $this->_tInactive;
	}

	public function gettBlock()
	{
		return $this->_tBlock;
	}

	public function gettSearch()
	{
		return $this->_tSearch;
	}

	public function getiAdminId()
	{
		return $this->_iAdminId;
	}


/**
*   @desc   SETTER METHODS
*/


	public function setiAMPerId($val)
	{
		 $this->_iAMPerId =  $val;
	}

	public function seteAdminType($val)
	{
		 $this->_eAdminType =  $val;
	}

	public function settListing($val)
	{
		 $this->_tListing =  $val;
	}

	public function settAdd($val)
	{
		 $this->_tAdd =  $val;
	}

	public function settUpdate($val)
	{
		 $this->_tUpdate =  $val;
	}

	public function settDelete($val)
	{
		 $this->_tDelete =  $val;
	}

	public function settActive($val)
	{
		 $this->_tActive =  $val;
	}

	public function settInactive($val)
	{
		 $this->_tInactive =  $val;
	}

	public function settBlock($val)
	{
		 $this->_tBlock =  $val;
	}

	public function settSearch($val)
	{
		 $this->_tSearch =  $val;
	}

	public function setiAdminId($val)
	{
		 $this->_iAdminId =  $val;
	}


/**
*   @desc   SELECT METHOD / LOAD
*/

	function select($id)
	{
		 $sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_acc_mod_per WHERE iAMPerId = $id";
		 $row =  $this->_obj->MySQLSelect($sql);

		 $this->_iAMPerId = $row[0]['iAMPerId'];
		 $this->_eAdminType = $row[0]['eAdminType'];
		 $this->_tListing = $row[0]['tListing'];
		 $this->_tAdd = $row[0]['tAdd'];
		 $this->_tUpdate = $row[0]['tUpdate'];
		 $this->_tDelete = $row[0]['tDelete'];
		 $this->_tActive = $row[0]['tActive'];
		 $this->_tInactive = $row[0]['tInactive'];
		 $this->_tBlock = $row[0]['tBlock'];
		 $this->_tSearch = $row[0]['tSearch'];
		 $this->_iAdminId = $row[0]['iAdminId'];
         return $row;
	}


/**
*   @desc   DELETE
*/

	function delete($where='')
	{
           if($where != '') {
              $cnt = " Where 1 ".$where;
           }
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_acc_mod_per $cnt";
		 return $result = $this->_obj->sql_query($sql);
	}


/**
*   @desc   INSERT
*/

	function insert()
	{
		 $this->iAMPerId = ""; // clear key for autoincrement

		 $Data = array(
						 'eAdminType'		=>	$this->_eAdminType,
						'tListing'		=>	$this->_tListing,
						'tAdd'		=>	$this->_tAdd,
						'tUpdate'		=>	$this->_tUpdate,
						'tDelete'		=>	$this->_tDelete,
						'tActive'		=>	$this->_tActive,
						'tInactive'		=>	$this->_tInactive,
						'tBlock'		=>	$this->_tBlock,
						'tSearch'		=>	$this->_tSearch,
						'iAdminId'		=>	$this->_iAdminId
);
           //prints($Data);exit;
		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_acc_mod_per",$Data,'insert');
		  return $result;
	}


/**
*   @desc   UPDATE
*/

	function update($upd)
	{

		 $Data = array(
						 'eAdminType'		=>	$this->_eAdminType,
						'tListing'		=>	$this->_tListing,
						'tAdd'		=>	$this->_tAdd,
						'tUpdate'		=>	$this->_tUpdate,
						'tDelete'		=>	$this->_tDelete,
						'tActive'		=>	$this->_tActive,
						'tInactive'		=>	$this->_tInactive,
						'tBlock'		=>	$this->_tBlock,
						'tSearch'		=>	$this->_tSearch,
						'iAdminId'		=>	$this->_iAdminId
);
           //prints($Data);exit;
		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_acc_mod_per",$Data,'update',$upd);
		  return $result;

	}

	/**
	*   @desc   SET ALL VARIABLE
	*/

	function setAllVar($Arr)
	{
		$MethodArr = get_class_methods($this);
		foreach($Arr AS $KEY => $VAL)
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
	*   @desc   GET ACCESS_PER_MODULE DETAILS
	*/

     function getAcc_Per_ModDetail($feild='*',$where='',$OrderBy='') {
          if($where != '') {
             $cnt = " Where 1 ".$where;
          }
          if($OrderBy != '') {
             $cnt .= " Order By ".$OrderBy;
          }

         $sql =  "SELECT $feild FROM ".PRJ_DB_PREFIX."_acc_mod_per $cnt";
		 $row =  $this->_obj->MySQLSelect($sql);

		 $this->_iAMPerId = isset($row[0]['iAMPerId'])?$row[0]['iAMPerId']:"";
		 $this->_eAdminType = isset($row[0]['eAdminType'])?$row[0]['eAdminType']:'';
		 $this->_tListing = isset($row[0]['tListing'])?$row[0]['tListing']:"";
		 $this->_tAdd = isset($row[0]['tAdd'])?$row[0]['tAdd']:"";
		 $this->_tUpdate = isset($row[0]['tUpdate'])?$row[0]['tUpdate']:"";
		 $this->_tDelete = isset($row[0]['tDelete'])?$row[0]['tDelete']:"";
		 $this->_tActive = isset($row[0]['tActive'])?$row[0]['tActive']:"";
		 $this->_tInactive = isset($row[0]['tInactive'])?$row[0]['tInactive']:"";
		 $this->_tBlock = isset($row[0]['tBlock'])?$row[0]['tBlock']:"";
		 $this->_tSearch = isset($row[0]['tSearch'])?$row[0]['tSearch']:"";
		 $this->_iAdminId = isset($row[0]['iAdminId'])?$row[0]['iAdminId']:"";

           return $row;
	}
}
?>