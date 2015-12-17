<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        B2Association
* GENERATION DATE:  09.02.2011
* CLASS FILE:       D:\wamp\www\nw\B2B/libraries/classes/application/class.B2Association.php
* FOR MYSQL TABLE:  b2b_buyer2_association_master
* FOR MYSQL DB:     b2b_new
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*
*/

class B2Association
{


/**
*   @desc Variable Declaration with default value
*/

	protected $iB2AssociationID;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iB2AssociationID;
	protected $_vAssociationCode;
	protected $_iBuyer2OrgID;
	protected $_iBuyerOrgID;
	protected $_iSupplierID;
	protected $_iBProductOrgID;
	protected $_iSProductOrgID;
	protected $_vAssociationType;
	protected $_vABScode;
	protected $_vProductOrgCode;
	protected $_iChangeNo;
	protected $_iCreatedByID;
	protected $_eCreatedBy;
	protected $_iModifiedByID;
	protected $_eModifiedBy;
	protected $_iVerifiedByID;
	protected $_eVerifiedBy;
	protected $_iRejectedByID;
	protected $_eRejectedBy;
	protected $_eNeedToVerify;
	protected $_eStatus;



/**
*   @desc   CONSTRUCTOR METHOD
*/

	function __construct()
	{
		global $dbobj;
		$this->_obj = $dbobj;

		$this->_iB2AssociationID = null;
		$this->_vAssociationCode = null;
		$this->_iBuyer2OrgID = null;
		$this->_iBuyerOrgID = null;
		$this->_iSupplierID = null;
		$this->_iBProductOrgID = null;
		$this->_iSProductOrgID = null;
		$this->_vAssociationType = null;
		$this->_vABScode = null;
		$this->_vProductOrgCode = null;
		$this->_iChangeNo = null;
		$this->_iCreatedByID = null;
		$this->_eCreatedBy = null;
		$this->_iModifiedByID = null;
		$this->_eModifiedBy = null;
		$this->_iVerifiedByID = null;
		$this->_eVerifiedBy = null;
		$this->_iRejectedByID = null;
		$this->_eRejectedBy = null;
		$this->_eNeedToVerify = null;
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


	public function getiB2AssociationID()
	{
		return $this->_iB2AssociationID;
	}

	public function getvAssociationCode()
	{
		return $this->_vAssociationCode;
	}

	public function getiBuyer2OrgID()
	{
		return $this->_iBuyer2OrgID;
	}

	public function getiBuyerOrgID()
	{
		return $this->_iBuyerOrgID;
	}

	public function getiSupplierID()
	{
		return $this->_iSupplierID;
	}

	public function getiBProductOrgID()
	{
		return $this->_iBProductOrgID;
	}

	public function getiSProductOrgID()
	{
		return $this->_iSProductOrgID;
	}

	public function getvAssociationType()
	{
		return $this->_vAssociationType;
	}

	public function getvABScode()
	{
		return $this->_vABScode;
	}

	public function getvProductOrgCode()
	{
		return $this->_vProductOrgCode;
	}

	public function getiChangeNo()
	{
		return $this->_iChangeNo;
	}

	public function getiCreatedByID()
	{
		return $this->_iCreatedByID;
	}

	public function geteCreatedBy()
	{
		return $this->_eCreatedBy;
	}

	public function getiModifiedByID()
	{
		return $this->_iModifiedByID;
	}

	public function geteModifiedBy()
	{
		return $this->_eModifiedBy;
	}

	public function getiVerifiedByID()
	{
		return $this->_iVerifiedByID;
	}

	public function geteVerifiedBy()
	{
		return $this->_eVerifiedBy;
	}

	public function getiRejectedByID()
	{
		return $this->_iRejectedByID;
	}

	public function geteRejectedBy()
	{
		return $this->_eRejectedBy;
	}

	public function geteNeedToVerify()
	{
		return $this->_eNeedToVerify;
	}

	public function geteStatus()
	{
		return $this->_eStatus;
	}


/**
*   @desc   SETTER METHODS
*/


	public function setiB2AssociationID($val)
	{
		 $this->_iB2AssociationID =  $val;
	}

	public function setvAssociationCode($val)
	{
		 $this->_vAssociationCode =  $val;
	}

	public function setiBuyer2OrgID($val)
	{
		 $this->_iBuyer2OrgID =  $val;
	}

	public function setiBuyerOrgID($val)
	{
		 $this->_iBuyerOrgID =  $val;
	}

	public function setiSupplierID($val)
	{
		 $this->_iSupplierID =  $val;
	}

	public function setiBProductOrgID($val)
	{
		 $this->_iBProductOrgID =  $val;
	}

	public function setiSProductOrgID($val)
	{
		 $this->_iSProductOrgID =  $val;
	}

	public function setvAssociationType($val)
	{
		 $this->_vAssociationType =  $val;
	}

	public function setvABScode($val)
	{
		 $this->_vABScode =  $val;
	}

	public function setvProductOrgCode($val)
	{
		 $this->_vProductOrgCode =  $val;
	}

	public function setiChangeNo($val)
	{
		 $this->_iChangeNo =  $val;
	}

	public function setiCreatedByID($val)
	{
		 $this->_iCreatedByID =  $val;
	}

	public function seteCreatedBy($val)
	{
		 $this->_eCreatedBy =  $val;
	}

	public function setiModifiedByID($val)
	{
		 $this->_iModifiedByID =  $val;
	}

	public function seteModifiedBy($val)
	{
		 $this->_eModifiedBy =  $val;
	}

	public function setiVerifiedByID($val)
	{
		 $this->_iVerifiedByID =  $val;
	}

	public function seteVerifiedBy($val)
	{
		 $this->_eVerifiedBy =  $val;
	}

	public function setiRejectedByID($val)
	{
		 $this->_iRejectedByID =  $val;
	}

	public function seteRejectedBy($val)
	{
		 $this->_eRejectedBy =  $val;
	}

	public function seteNeedToVerify($val)
	{
		 $this->_eNeedToVerify =  $val;
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
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_buyer2_association_master WHERE iB2AssociationID = $id";
			} else {
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_buyer2_association_master WHERE iB2AssociationID=$this->_iB2AssociationID ";
		 }
		 $row =  $this->_obj->MySQLSelect($sql);

		 $this->_iB2AssociationID = $row[0]['iB2AssociationID'];
		 $this->_vAssociationCode = $row[0]['vAssociationCode'];
		 $this->_iBuyer2OrgID = $row[0]['iBuyer2OrgID'];
		 $this->_iBuyerOrgID = $row[0]['iBuyerOrgID'];
		 $this->_iSupplierID = $row[0]['iSupplierID'];
		 $this->_iBProductOrgID = $row[0]['iBProductOrgID'];
		 $this->_iSProductOrgID = $row[0]['iSProductOrgID'];
		 $this->_vAssociationType = $row[0]['vAssociationType'];
		 $this->_vABScode = $row[0]['vABScode'];
		 $this->_vProductOrgCode = $row[0]['vProductOrgCode'];
		 $this->_iChangeNo = $row[0]['iChangeNo'];
		 $this->_iCreatedByID = $row[0]['iCreatedByID'];
		 $this->_eCreatedBy = $row[0]['eCreatedBy'];
		 $this->_iModifiedByID = $row[0]['iModifiedByID'];
		 $this->_eModifiedBy = $row[0]['eModifiedBy'];
		 $this->_iVerifiedByID = $row[0]['iVerifiedByID'];
		 $this->_eVerifiedBy = $row[0]['eVerifiedBy'];
		 $this->_iRejectedByID = $row[0]['iRejectedByID'];
		 $this->_eRejectedBy = $row[0]['eRejectedBy'];
		 $this->_eNeedToVerify = $row[0]['eNeedToVerify'];
		 $this->_eStatus = $row[0]['eStatus'];
 return $row;
	}


/**
*   @desc   DELETE
*/

	function delete($id)
	{
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_buyer2_association_master WHERE iB2AssociationID = $id";
		 return $result = $this->_obj->sql_query($sql);
	}


/**
*   @desc   INSERT
*/

	function insert()
	{
		 $this->_iB2AssociationID = '';
		 $this->iB2AssociationID = ""; // clear key for autoincrement

		 $Data = array(
						 'vAssociationCode'		=>	$this->_vAssociationCode,
						'iBuyer2OrgID'		=>	$this->_iBuyer2OrgID,
						'iBuyerOrgID'		=>	$this->_iBuyerOrgID,
						'iSupplierID'		=>	$this->_iSupplierID,
						'iBProductOrgID'		=>	$this->_iBProductOrgID,
						'iSProductOrgID'		=>	$this->_iSProductOrgID,
						'vAssociationType'		=>	$this->_vAssociationType,
						'vABScode'		=>	$this->_vABScode,
						'vProductOrgCode'		=>	$this->_vProductOrgCode,
						'iChangeNo'		=>	$this->_iChangeNo,
						'iCreatedByID'		=>	$this->_iCreatedByID,
						'eCreatedBy'		=>	$this->_eCreatedBy,
						'iModifiedByID'		=>	$this->_iModifiedByID,
						'eModifiedBy'		=>	$this->_eModifiedBy,
						'iVerifiedByID'		=>	$this->_iVerifiedByID,
						'eVerifiedBy'		=>	$this->_eVerifiedBy,
						'iRejectedByID'		=>	$this->_iRejectedByID,
						'eRejectedBy'		=>	$this->_eRejectedBy,
						'eNeedToVerify'		=>	$this->_eNeedToVerify,
						'eStatus'		=>	$this->_eStatus
);

		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_buyer2_association_master",$Data,'insert');
		  return $result;
	}


/**
*   @desc   UPDATE
*/

	function update($where)
	{

		 $Data = array(
						 'vAssociationCode'		=>	$this->_vAssociationCode,
						'iBuyer2OrgID'		=>	$this->_iBuyer2OrgID,
						'iBuyerOrgID'		=>	$this->_iBuyerOrgID,
						'iSupplierID'		=>	$this->_iSupplierID,
						'iBProductOrgID'		=>	$this->_iBProductOrgID,
						'iSProductOrgID'		=>	$this->_iSProductOrgID,
						'vAssociationType'		=>	$this->_vAssociationType,
						'vABScode'		=>	$this->_vABScode,
						'vProductOrgCode'		=>	$this->_vProductOrgCode,
						'iChangeNo'		=>	$this->_iChangeNo,
						'iCreatedByID'		=>	$this->_iCreatedByID,
						'eCreatedBy'		=>	$this->_eCreatedBy,
						'iModifiedByID'		=>	$this->_iModifiedByID,
						'eModifiedBy'		=>	$this->_eModifiedBy,
						'iVerifiedByID'		=>	$this->_iVerifiedByID,
						'eVerifiedBy'		=>	$this->_eVerifiedBy,
						'iRejectedByID'		=>	$this->_iRejectedByID,
						'eRejectedBy'		=>	$this->_eRejectedBy,
						'eNeedToVerify'		=>	$this->_eNeedToVerify,
						'eStatus'		=>	$this->_eStatus
);

		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_buyer2_association_master",$Data,'update',$where);
		  return $result;

	}


	function updateData($data,$where)
	{
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_buyer2_association_master",$data,"update",$where);
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
       $sql =  "SELECT $feild FROM ".PRJ_DB_PREFIX."_buyer2_association_master $cnt $limit";
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

      $sql =  "SELECT $fields FROM ".PRJ_DB_PREFIX."_buyer2_association_master $jtbl $cnt $limit";
		$row = $this->_obj->MySQLSelect($sql);
		if($pg=="yes")
		{
			$sql_count =  "SELECT Count(*) as tot FROM ".PRJ_DB_PREFIX."_buyer2_association_master $jtbl $cnt_count";
			$row_count = $this->_obj->MySqlSelect($sql_count);
			$row[tot] = $row_count[0][tot];
		}
      return $row;
	}
}
?>