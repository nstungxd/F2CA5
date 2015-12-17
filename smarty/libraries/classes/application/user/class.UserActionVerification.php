<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        UserActionVerification
* GENERATION DATE:  19.04.2010
* CLASS FILE:       /home/www/B2B/libraries/classes/application/class.UserActionVerification.php
* FOR MYSQL TABLE:  b2b_user_action_verification
* FOR MYSQL DB:     B2B
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*
*/

class UserActionVerification
{


/**
*   @desc Variable Declaration with default value
*/

	protected $iVerifiedID;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iVerifiedID;
	protected $_iItemID;
	protected $_eSubject;
	protected $_eType;
	protected $_vAction;
	protected $_vMailSubject_en;
	protected $_vMailSubject_fr;
	protected $_tMailContent_en;
	protected $_tMailContent_fr;
   protected $_iOrganizationID;
   protected $_iCreatedBy;
	protected $_eCreatedType;
	protected $_eVerifiedBy;
	protected $_iVerifiedBy;
	protected $_dActionDate;
	protected $_dVerifyDate;
	protected $_vVerifyFromIP;



/**
*   @desc   CONSTRUCTOR METHOD
*/

	function __construct()
	{
		global $dbobj;
		$this->_obj = $dbobj;

		$this->_iVerifiedID = null;
		$this->_iItemID = null;
		$this->_eSubject = null;
		$this->_eType = null;
		$this->_vAction = null;
		$this->_vMailSubject_en = null;
		$this->_vMailSubject_fr = null;
		$this->_tMailContent_en = null;
		$this->_tMailContent_fr = null;
      $this->_iOrganizationID = null;
      $this->_iCreatedBy = null;
      $this->_eCreatedType = null;
		$this->_eVerifiedBy = null;
		$this->_iVerifiedBy = null;
		$this->_dActionDate = null;
		$this->_dVerifyDate = null;
		$this->_vVerifyFromIP = null;
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


	public function getiVerifiedID()
	{
		return $this->_iVerifiedID;
	}

	public function getiItemID()
	{
		return $this->_iItemID;
	}

	public function geteSubject()
	{
		return $this->_eSubject;
	}

	public function geteType()
	{
		return $this->_eType;
	}

	public function getvAction()
	{
		return $this->_vAction;
	}

	public function getvMailSubject_en()
	{
		return $this->_vMailSubject_en;
	}

	public function getvMailSubject_fr()
	{
		return $this->_vMailSubject_fr;
	}

	public function gettMailContent_en()
	{
		return $this->_tMailContent_en;
	}

	public function gettMailContent_fr()
	{
		return $this->_tMailContent_fr;
	}

     public function getiOrganizationID()
	{
		return $this->_iOrganizationID;
	}

     public function getiCreatedBy()
	{
		return $this->_iCreatedBy;
	}

	public function geteCreatedType()
	{
		return $this->_eCreatedType;
	}

	public function geteVerifiedBy()
	{
		return $this->_eVerifiedBy;
	}

	public function getiVerifiedBy()
	{
		return $this->_iVerifiedBy;
	}

	public function getdActionDate()
	{
		return $this->_dActionDate;
	}

	public function getdVerifyDate()
	{
		return $this->_dVerifyDate;
	}

	public function getvVerifyFromIP()
	{
		return $this->_vVerifyFromIP;
	}


/**
*   @desc   SETTER METHODS
*/


	public function setiVerifiedID($val)
	{
		 $this->_iVerifiedID =  $val;
	}

	public function setiItemID($val)
	{
		 $this->_iItemID =  $val;
	}

	public function seteSubject($val)
	{
		 $this->_eSubject =  $val;
	}

	public function seteType($val)
	{
		 $this->_eType =  $val;
	}

	public function setvAction($val)
	{
		 $this->_vAction =  $val;
	}

	public function setvMailSubject_en($val)
	{
		 $this->_vMailSubject_en =  $val;
	}

	public function setvMailSubject_fr($val)
	{
		 $this->_vMailSubject_fr =  $val;
	}

	public function settMailContent_en($val)
	{
		 $this->_tMailContent_en =  $val;
	}

	public function settMailContent_fr($val)
	{
		 $this->_tMailContent_fr =  $val;
	}

     public function setiOrganizationID($val)
	{
		 $this->_iOrganizationID =  $val;
	}

     public function setiCreatedBy($val)
	{
		 $this->_iCreatedBy =  $val;
	}

	public function seteCreatedType($val)
	{
		 $this->_eCreatedType =  $val;
	}

	public function seteVerifiedBy($val)
	{
		 $this->_eVerifiedBy =  $val;
	}

	public function setiVerifiedBy($val)
	{
		 $this->_iVerifiedBy =  $val;
	}

	public function setdActionDate($val)
	{
		 $this->_dActionDate =  $val;
	}

	public function setdVerifyDate($val)
	{
		 $this->_dVerifyDate =  $val;
	}

	public function setvVerifyFromIP($val)
	{
		 $this->_vVerifyFromIP =  $val;
	}


/**
*   @desc   SELECT METHOD / LOAD
*/

	function select($id)
	{
		 $sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_user_action_verification WHERE iVerifiedID = $id";
		 $row =  $this->_obj->MySQLSelect($sql);

		 $this->_iVerifiedID = $row[0]['iVerifiedID'];
		 $this->_iItemID = $row[0]['iItemID'];
		 $this->_eSubject = $row[0]['eSubject'];
		 $this->_eType = $row[0]['eType'];
		 $this->_vAction = $row[0]['_vAction'];
		 $this->_vMailSubject_en = $row[0]['vMailSubject_en'];
		 $this->_vMailSubject_fr = $row[0]['vMailSubject_fr'];
		 $this->_tMailContent_en = $row[0]['tMailContent_en'];
		 $this->_tMailContent_fr = $row[0]['tMailContent_fr'];
       $this->_iOrganizationID = $row[0]['iOrganizationID'];
       $this->_iCreatedBy = $row[0]['iCreatedBy'];
		 $this->_eCreatedType = $row[0]['eCreatedType'];
		 $this->_eVerifiedBy = $row[0]['eVerifiedBy'];
		 $this->_iVerifiedBy = $row[0]['iVerifiedBy'];
		 $this->_dActionDate = $row[0]['dActionDate'];
		 $this->_dVerifyDate = $row[0]['dVerifyDate'];
		 $this->_vVerifyFromIP = $row[0]['vVerifyFromIP'];
 return $row;
	}


/**
*   @desc   DELETE
*/

	function delete($id)
	{
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_user_action_verification WHERE iVerifiedID = $id";
		 return $result = $this->_obj->sql_query($sql);
	}


/**
*   @desc   DELETE BY CONDITION
*/

	function del($where)
	{
           $sql = "DELETE FROM ".PRJ_DB_PREFIX."_user_action_verification WHERE 1 $where";
           //echo $sql;exit;
		 return $result= $this->_obj->sql_query($sql);
	}


/**
*   @desc   INSERT
*/

	function insert($Data=array())
	{
		 $this->iVerifiedID = ""; // clear key for autoincrement
		if(is_array($Data) && count($Data)>0) {
			//
		} else {
		 	$Data = array(
						'iItemID'		=>	$this->_iItemID,
						'eSubject'		=>	$this->_eSubject,
						'eType'			=>	$this->_eType,
						'vAction'		=>	$this->_vAction,
						'vMailSubject_en'		=>	$this->_vMailSubject_en,
						'vMailSubject_fr'		=>	$this->_vMailSubject_fr,
						'tMailContent_en'		=>	$this->_tMailContent_en,
						'tMailContent_fr'		=>	$this->_tMailContent_fr,
						'iOrganizationID'		=>	$this->_iOrganizationID,
						'iCreatedBy'		=>	$this->_iCreatedBy,
						'eCreatedType'		=>	$this->_eCreatedType,
						'eVerifiedBy'		=>	$this->_eVerifiedBy,
						'iVerifiedBy'		=>	$this->_iVerifiedBy,
						'dActionDate'		=>	$this->_dActionDate,
						'dVerifyDate'		=>	$this->_dVerifyDate,
						'vVerifyFromIP'		=>	$this->_vVerifyFromIP
			);
		}

		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_user_action_verification",$Data,'insert');
		return $result;
	}


/**
*   @desc   UPDATE
*/

	function update($id)
	{

		 $Data = array(
						'iItemID'		=>	$this->_iItemID,
						'eSubject'		=>	$this->_eSubject,
						'eType'			=>	$this->_eType,
						'vAction'		=>	$this->_vAction,
						'vMailSubject_en'		=>	$this->_vMailSubject_en,
						'vMailSubject_fr'		=>	$this->_vMailSubject_fr,
						'tMailContent_en'		=>	$this->_tMailContent_en,
						'tMailContent_fr'		=>	$this->_tMailContent_fr,
						'iOrganizationID'		=>	$this->_iOrganizationID,
                  'iCreatedBy'		=>	$this->_iCreatedBy,
						'eCreatedType'		=>	$this->_eCreatedType,
						'eVerifiedBy'		=>	$this->_eVerifiedBy,
						'iVerifiedBy'		=>	$this->_iVerifiedBy,
						'dActionDate'		=>	$this->_dActionDate,
						'dVerifyDate'		=>	$this->_dVerifyDate,
						'vVerifyFromIP'	=>	$this->_vVerifyFromIP
);

		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_user_action_verification",$Data,'update',$upd);
		  return $result;

	}

	function updateData($data,$where)
	{
      //prints($data);exit;
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_user_action_verification",$data,"update",$where);
		return $result;
	}


	/**
	*   @desc   SET ALL VARIABLE
	*/

	function setAllVar($Data=array())
	{
      if(count($Data) <= 0) {
      	$Data=$_REQUEST;
      }
		$MethodArr = get_class_methods($this);
		foreach($Data AS $KEY => $VAL)
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

     function getDetails($feild="*",$where="",$OrderBy="",$GroupBy="") {
       if($where != "") {
          $cnt = " WHERE 1 ".$where;
       }

       if($GroupBy != "") {
         $groupby = " GROUP BY ".$GroupBy;
       }

       if($OrderBy != "") {
          $orderby = " ORDER BY ".$OrderBy;
       }

       $sql =  "SELECT $feild FROM b2b_user_action_verification $cnt $groupby $orderby";
		 $row =  $this->_obj->MySQLSelect($sql);
       return $row;
	}
}
?>