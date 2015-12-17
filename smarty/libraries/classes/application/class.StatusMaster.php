<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        StatusMaster
* GENERATION DATE:  04.05.2010
* CLASS FILE:       /home/www/B2B/libraries/classes/application/class.StatusMaster.php
* FOR MYSQL TABLE:  b2b_status_master
* FOR MYSQL DB:     B2B
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*
*/

class StatusMaster
{


/**
*   @desc Variable Declaration with default value
*/

	protected $iStatusID;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iStatusID;
	protected $_vStatus_en;
	protected $_vStatus_fr;
	protected $_vStatusMsg_en;
	protected $_vStatusMsg_fr;
	protected $_iDisplayOrder;
	protected $_eFor;
	protected $_eType;
	protected $_eStatus;



/**
*   @desc   CONSTRUCTOR METHOD
*/

	function __construct()
	{
		global $dbobj;
		$this->_obj = $dbobj;

		$this->_iStatusID = null;
		$this->_vStatus_en = null;
		$this->_vStatus_fr = null;
		$this->_vStatusMsg_en = null;
		$this->_vStatusMsg_fr = null;
		$this->_iDisplayOrder = null;
		$this->_eFor = null;
		$this->_eType = null;
		$this->_eStatus = null;
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


	public function getiStatusID()
	{
		return $this->_iStatusID;
	}

	public function getvStatus_en()
	{
		return $this->_vStatus_en;
	}

	public function getvStatus_fr()
	{
		return $this->_vStatus_fr;
	}

	public function getvStatusMsg_en()
	{
		return $this->_vStatusMsg_en;
	}

	public function getvStatusMsg_fr()
	{
		return $this->_vStatusMsg_fr;
	}

	public function getiDisplayOrder()
	{
		return $this->_iDisplayOrder;
	}

	public function geteFor()
	{
		return $this->_eFor;
	}

	public function geteType()
	{
		return $this->_eType;
	}

	public function geteStatus()
	{
		return $this->_eStatus;
	}


/**
*   @desc   SETTER METHODS
*/


	public function setiStatusID($val)
	{
		 $this->_iStatusID =  $val;
	}

	public function setvStatus_en($val)
	{
		 $this->_vStatus_en =  $val;
	}

	public function setvStatus_fr($val)
	{
		 $this->_vStatus_fr =  $val;
	}

	public function setvStatusMsg_en($val)
	{
		 $this->_vStatusMsg_en =  $val;
	}

	public function setvStatusMsg_fr($val)
	{
		 $this->_vStatusMsg_fr =  $val;
	}

	public function setiDisplayOrder($val)
	{
		 $this->_iDisplayOrder =  $val;
	}

	public function seteFor($val)
	{
		 $this->_eFor =  $val;
	}

	public function seteType($val)
	{
		 $this->_eType =  $val;
	}

	public function seteStatus($val)
	{
		 $this->_eStatus =  $val;
	}


/**
*   @desc   SELECT METHOD / LOAD
*/

	function select($id)
	{
			if(($id > 0) && (trim($id) != ''))
			{
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_status_master WHERE iStatusID = $id";
			} else {
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_status_master WHERE iStatusID=$this->_iStatusID ";
		 }
		 $row =  $this->_obj->MySQLSelect($sql);

		 $this->_iStatusID = $row[0]['iStatusID'];
		 $this->_vStatus_en = $row[0]['vStatus_en'];
		 $this->_vStatus_fr = $row[0]['vStatus_fr'];
		 $this->_vStatusMsg_en = $row[0]['vStatusMsg_en'];
		 $this->_vStatusMsg_fr = $row[0]['vStatusMsg_fr'];
		 $this->_iDisplayOrder = $row[0]['iDisplayOrder'];
		 $this->_eFor = $row[0]['eFor'];
		 $this->_eType = $row[0]['eType'];
		 $this->_eStatus = $row[0]['eStatus'];
 return $row;
	}


/**
*   @desc   DELETE
*/

	function delete($id)
	{
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_status_master WHERE iStatusID = $id";
		 return $result = $this->_obj->sql_query($sql);
	}


/**
*   @desc   INSERT
*/

	function insert()
	{
		 $this->_iStatusID = '';
		 $this->iStatusID = ""; // clear key for autoincrement

		 $Data = array(
						 'vStatus_en'		=>	$this->_vStatus_en,
						'vStatus_fr'		=>	$this->_vStatus_fr,
						'vStatusMsg_en'		=>	$this->_vStatusMsg_en,
						'vStatusMsg_fr'		=>	$this->_vStatusMsg_fr,
						'iDisplayOrder'		=>	$this->_iDisplayOrder,
						'eFor'		=>	$this->_eFor,
						'eType'		=>	$this->_eType,
						'eStatus'		=>	$this->_eStatus
);

		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_status_master",$Data,'insert');
		  return $result;
	}


/**
*   @desc   UPDATE
*/

	function update($where)
	{

		 $Data = array(
						 'vStatus_en'		=>	$this->_vStatus_en,
						'vStatus_fr'		=>	$this->_vStatus_fr,
						'vStatusMsg_en'		=>	$this->_vStatusMsg_en,
						'vStatusMsg_fr'		=>	$this->_vStatusMsg_fr,
						'iDisplayOrder'		=>	$this->_iDisplayOrder,
						'eFor'		=>	$this->_eFor,
						'eType'		=>	$this->_eType,
						'eStatus'		=>	$this->_eStatus
);

		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_status_master",$Data,'update',$where);
		  return $result;

	}


	function updateData($data,$where)
	{
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_status_master",$data,"update",$where);
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
		$cnt = "";
       if($where != "") {
          $cnt = " Where 1 ".$where;
       }
       if($groupBy != "") {
          $cnt .= " Group By ".$groupBy;
       }
       if($orderBy != "") {
          $cnt .= " Order By ".$orderBy;
       }
       $sql =  "SELECT $feild FROM ".PRJ_DB_PREFIX."_status_master $cnt $limit";
        //echo $sql."<br>";
		 $row =  $this->_obj->MySQLSelect($sql);
       return $row;
	}

   /**
	*   @desc   GET DETAILS WITH PAGING AND JOINED TABLE IF REQUIRED
	*/
   function getJoinTableInfo($jtbl,$fields="*",$where="",$orderBy="",$groupBy="",$limit="",$pg="") {
		if($where != "") {
         $cnt = " Where 1 ".$where;
			$cnt_count = " Where 1 ".$where;
      }
		if($groupBy != "") {
         $cnt .= " Group By ".$groupBy;
			$cnt_count .= " Group By ".$groupBy;
      }
		if($orderBy != "") {
         $cnt .= " Order By ".$orderBy;
      }

      $sql =  "SELECT $fields FROM ".PRJ_DB_PREFIX."_status_master $jtbl $cnt $limit";
		$row = $this->_obj->MySQLSelect($sql);
		if($pg=="yes")
		{
			$sql_count =  "SELECT Count(*) as tot FROM ".PRJ_DB_PREFIX."_status_master $jtbl $cnt_count";
			$row_count = $this->_obj->MySqlSelect($sql_count);
			$row[tot] = $row_count[0][tot];
		}
      return $row;
	}

	function getStatusDetails($ary,$itm='')
	{
		$ids = '';
		if(is_array($ary)){
               $ids=implode(",",$ary);
		} else if(is_numeric($ary)) {
               $ids=$ary;
		}
		if($ids != '')
		{
			  if ($itm != '')
				  $where=" AND eFor ='".$itm."'";
			  $userStatus = $this->getDetails('vStatus_'.$_SESSION["SESS_".PRJ_CONST_PREFIX."_LANG"].' as vStatus,vStatus_en,iStatusID', " and iStatusId in(".$ids.")".$where );
			  return $userStatus;
		}

	}
}
?>