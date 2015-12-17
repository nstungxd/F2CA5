<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        OrganizationAssociation
* GENERATION DATE:  20.04.2010
* CLASS FILE:       /home/www/B2B/libraries/classes/application/class.OrganizationAssociation.php
* FOR MYSQL TABLE:  b2b_organization_association
* FOR MYSQL DB:     B2B
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*
*/

class OrganizationAssociation
{

/**
*   @desc Variable Declaration with default value
*/
	protected $iAsociationID;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iAsociationID;
	protected $_vAssociationCode;
	protected $_iBuyerOrganizationID;
	protected $_iSupplierAssocationID;
	protected $_vBuyerCode;
	protected $_vSupplierCode;
	protected $_dCreateDate;
	protected $_dModifiedDate;
	protected $_dVerifiedDate;
	protected $_iCreatedBy;
	protected $_eCreatedBy;
	protected $_iVerifiedSMID;
	protected $_eVerifiedBy;
	protected $_iModifiedByID;
	protected $_eModifiedBy;
	protected $_iChangeNo;
	protected $_dRejectedDate;
	protected $_iRejectedById;
	protected $_eRejectedBy;
	protected $_tReasonToReject;
   protected $_eNeedToVerify;
	protected $_eStatus;

/**
*   @desc   CONSTRUCTOR METHOD
*/
	function __construct()
	{
		global $dbobj;
		$this->_obj = $dbobj;

		$this->_iAsociationID = null;
		$this->_vAssociationCode = null;
		$this->_iBuyerOrganizationID = null;
		$this->_iSupplierAssocationID = null;
		$this->_vBuyerCode = null;
		$this->_vSupplierCode = null;
		$this->_dCreatedDate = null;
		$this->_dModifiedDate = null;
		$this->_dVerifiedDate = null;
		$this->_iCreatedBy = null;
		$this->_eCreatedBy = null;
		$this->_iVerifiedSMID = null;
		$this->_eVerifiedBy = null;
		$this->_iModifiedByID = null;
		$this->_eModifiedBy = null;
		$this->_iChangeNo = null;
		$this->_dRejectedDate = null;
		$this->_iRejectedById = null;
		$this->_eRejectedBy = null;
		$this->_tReasonToReject = null;
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
	public function getiAsociationID()
	{
		return $this->_iAsociationID;
	}

	public function getvAssociationCode()
	{
		return $this->_vAssociationCode;
	}

	public function getiBuyerOrganizationID()
	{
		return $this->_iBuyerOrganizationID;
	}

	public function getiSupplierAssocationID()
	{
		return $this->_iSupplierAssocationID;
	}

	public function getvBuyerCode()
	{
		return $this->_vBuyerCode;
	}

	public function getvSupplierCode()
	{
		return $this->_vSupplierCode;
	}

	public function getdCreatedDate()
	{
		return $this->_dCreatedDate;
	}

	public function getdModifiedDate()
	{
		return $this->_dModifiedDate;
	}

	public function getdVerifiedDate()
	{
		return $this->_dVerifiedDate;
	}

	public function getiCreatedBy()
	{
		return $this->_iCreatedBy;
	}

	public function geteCreatedBy()
	{
		return $this->_eCreatedBy;
	}

	public function getiVerifiedSMID()
	{
		return $this->_iVerifiedSMID;
	}

	public function geteVerifiedBy()
	{
		return $this->_eVerifiedBy;
	}

	public function getiModifiedByID()
	{
		return $this->_iModifiedByID;
	}

	public function geteModifiedBy()
	{
		return $this->_eModifiedBy;
	}

	public function getiChangeNo()
	{
		return $this->_iChangeNo;
	}

	public function getdRejectedDate()
	{
	  return $this->_dRejectedDate;
	}
	public function getiRejectedById()
	{
	  return $this->_iRejectedById;
	}
	public function geteRejectedBy()
	{
	  return $this->_eRejectedBy;
	}

	public function gettReasonToReject()
	{
		return $this->_tReasonToReject;
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
	public function setiAsociationID($val)
	{
		 $this->iAsociationID = $this->_iAsociationID =  $val;
	}

	public function setvAssociationCode($val)
	{
		 $this->_vAssociationCode = $val;
	}

	public function setiBuyerOrganizationID($val)
	{
		 $this->_iBuyerOrganizationID =  $val;
	}

	public function setiSupplierAssocationID($val)
	{
		 $this->_iSupplierAssocationID =  $val;
	}

	public function setvBuyerCode($val)
	{
		 $this->_vBuyerCode =  $val;
	}

	public function setvSupplierCode($val)
	{
		 $this->_vSupplierCode =  $val;
	}

	public function setdCreatedDate($val)
	{
		$this->_dCreatedDate =  $val;
	}

	public function setdModifiedDate($val)
	{
		$this->_dModifiedDate =  $val;
	}

	public function setdVerifiedDate($val)
	{
		$this->_dVerifiedDate =  $val;
	}

	public function setiCreatedBy($val)
	{
		$this->_iCreatedBy =  $val;
	}

	public function seteCreatedBy($val)
	{
		$this->_eCreatedBy =  $val;
	}

	public function setiVerifiedSMID($val)
	{
		 $this->_iVerifiedSMID =  $val;
	}

	public function seteVerifiedBy($val)
	{
		$this->_eVerifiedBy = $val;
	}

	public function setiModifiedByID($val)
	{
		$this->_iModifiedByID = $val;
	}

	public function seteModifiedBy($val)
	{
		$this->_eModifiedBy = $val;
	}

	public function setiChangeNo($val)
	{
		$this->_iChangeNo = $val;
	}

	public function setdRejectedDate($val)
	{
	  $this->_dRejectedDate =  $val;
	}
	public function setiRejectedById($val)
	{
	  $this->_iRejectedById =  $val;
	}
	public function seteRejectedBy($val)
	{
	  $this->_eRejectedBy =  $val;
	}

	public function settReasonToReject($val)
	{
		$this->_tReasonToReject =  $val;
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
	function select($id='')
	{
		if(($id > 0) && (trim($id) != ''))
		{
			$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_organization_association WHERE iAsociationID = $id";
		} else {
			$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_organization_association WHERE iAsociationID=$this->_iAsociationID ";
		}
		$row =  $this->_obj->MySQLSelect($sql);

		$this->_iAsociationID = $row[0]['iAsociationID'];
		$this->_vAssociationCode = $row[0]['vAssociationCode'];
		$this->_iBuyerOrganizationID = $row[0]['iBuyerOrganizationID'];
		$this->_iSupplierAssocationID = $row[0]['iSupplierAssocationID'];
		$this->_vBuyerCode = $row[0]['vBuyerCode'];
		$this->_vSupplierCode = $row[0]['vSupplierCode'];
		$this->_dCreatedDate = $row[0]['dCreatedDate'];
		$this->_dModifiedDate = $row[0]['dModifiedDate'];
		$this->_dVerifiedDate = $row[0]['dVerifiedDate'];
		$this->_iCreatedBy = $row[0]['iCreatedBy'];
		$this->_eCreatedBy = $row[0]['eCreatedBy'];
		$this->_iVerifiedSMID = $row[0]['iVerifiedSMID'];
		$this->_eVerifiedBy = $row[0]['eVerifiedBy'];
		$this->_eModifiedBy = $row[0]['iModifiedByID'];
		$this->_eModifiedBy = $row[0]['eModifiedBy'];
		$this->_iChangeNo = $row[0]['iChangeNo'];
		$this->_dRejectedDate = $row[0]['dRejectedDate'];
		$this->_iRejectedById = $row[0]['iRejectedById'];
		$this->_eRejectedBy = $row[0]['eRejectedBy'];
		$this->_tReasonToReject = $row[0]['tReasonToReject'];
      $this->_eNeedToVerify = $row[0]['eNeedToVerify'];
		$this->_eStatus = $row[0]['eStatus'];
		return $row;
	}


/**
*   @desc   DELETE
*/
	function delete($id)
	{
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_organization_association WHERE iAsociationID = $id";
		 return $result = $this->_obj->sql_query($sql);
	}

/**
*   @desc   DELETE BY CONDITION
*/

	function del($where)
	{
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_organization_association WHERE 1 $where";
		 //echo $sql;exit;
		 return $result = $this->_obj->sql_query($sql);
	}


/**
*   @desc   INSERT
*/
	function insert()
	{
		 $this->_iAsociationID = '';
		 $this->iAsociationID = ""; // clear key for autoincrement

		 $Data = array(
						'vAssociationCode'	=> $this->_vAssociationCode,
						'iBuyerOrganizationID'		=>	$this->_iBuyerOrganizationID,
						'iSupplierAssocationID'		=>	$this->_iSupplierAssocationID,
						'vBuyerCode'					=>	$this->_vBuyerCode,
						'vSupplierCode'				=>	$this->_vSupplierCode,
						'dCreatedDate'					=>	$this->_dCreatedDate,
						'dModifiedDate'				=>	$this->_dModifiedDate,
						'dVerifiedDate'				=>	$this->_dVerifiedDate,
						'iCreatedBy'					=>	$this->_iCreatedBy,
						'eCreatedBy'					=>	$this->_eCreatedBy,
						'iVerifiedSMID'				=> $this->_iVerifiedSMID,
						'eVerifiedBy' 					=> $this->_eVerifiedBy,
						'iModifiedByID'				=> $this->_iModifiedByID,
						'eModifiedBy'					=> $this->_eModifiedBy,
						'iChangeNo' 					=> $this->_iChangeNo,
						'dRejectedDate'		=>	$this->_dRejectedDate,
						'iRejectedById'				=> $this->_iRejectedById,
						'eRejectedBy' 		=> $this->_eRejectedBy,
						'tReasonToReject' 		=> $this->_tReasonToReject,
						'eNeedToVerify'				=> $this->_eNeedToVerify,
						'eStatus'						=> $this->_eStatus
		);
          //prints($Data);exit;
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_organization_association",$Data,'insert');
		return $result;
	}

/**
*   @desc   UPDATE
*/
	function update($where)
	{
		 $Data = array (
				'vAssociationCode'	=> $this->_vAssociationCode,
				'iBuyerOrganizationID'		=>	$this->_iBuyerOrganizationID,
				'iSupplierAssocationID'		=>	$this->_iSupplierAssocationID,
				'vBuyerCode'					=>	$this->_vBuyerCode,
				'vSupplierCode'				=>	$this->_vSupplierCode,
				'dCreatedDate'					=>	$this->_dCreatedDate,
				'dModifiedDate'				=>	$this->_dModifiedDate,
				'dVerifiedDate'				=>	$this->_dVerifiedDate,
				'iCreatedBy'					=>	$this->_iCreatedBy,
				'eCreatedBy'					=>	$this->_eCreatedBy,
				'iVerifiedSMID'				=> $this->_iVerifiedSMID,
				'eVerifiedBy' 					=> $this->_eVerifiedBy,
				'iModifiedByID'				=> $this->_iModifiedByID,
				'eModifiedBy'					=> $this->_eModifiedBy,
				'iChangeNo' 					=> $this->_iChangeNo,
				'dRejectedDate'		=>	$this->_dRejectedDate,
				'iRejectedById'				=> $this->_iRejectedById,
				'eRejectedBy' 		=> $this->_eRejectedBy,
				'tReasonToReject' 		=> $this->_tReasonToReject,
				'eNeedToVerify'				=> $this->_eNeedToVerify,
				'eStatus'						=> $this->_eStatus
			);
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_organization_association",$Data,'update',$where);
		return $result;
	}


	function updateData($data,$where)
	{
      // prints($where);exit;
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_organization_association",$data,"update",$where);
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
   function getDetails($field="*",$where="",$orderBy="",$groupBy="",$limit="")
	{
	     //echo $where;exit;
       if($where != "") {
          $cnt = " Where 1 ".$where;
       }
       if($groupBy != "") {
          $cnt .= " Group By ".$groupBy;
       }
       if($orderBy != "") {
          $cnt .= " Order By ".$orderBy;
       }

       $sql =  "SELECT $field FROM ".PRJ_DB_PREFIX."_organization_association $cnt $limit";
       // echo $sql; // exit;
		 $row =  $this->_obj->MySQLSelect($sql);
       return $row;
	}

	function getJoinTableInfo($jtbl,$fields='*',$where='',$orderBy='',$groupBy='',$limit='',$pg='')
	{
		if($where != '') {
         $cnt = " Where 1 ".$where;
			$cnt_count = " Where 1 ".$where;
      }
		if($groupBy != '') {
         $cnt .= " Group By ".$groupBy;
         $cnt_count.= " Group By ".$groupBy;
      }
		if($orderBy != '') {
         $cnt .= " Order By ".$orderBy;
			//$cnt_count .= " Order By ".$orderBy;
      }
      $sql =  "SELECT $fields FROM ".PRJ_DB_PREFIX."_organization_association oa $jtbl $cnt $limit";
		// echo $sql; // exit;
		$row = $this->_obj->MySQLSelect($sql);
		if($pg=='yes') {
			$sql_count = "SELECT Count(*) as tot FROM ".PRJ_DB_PREFIX."_organization_association oa $jtbl $cnt_count";
			// echo $sql_count ; exit;
			$row_count = $this->_obj->MySqlSelect($sql_count);
			//$row['tot'] = $row_count[0]['tot'];
               if($groupBy != '') {
               $row['tot'] = count($row_count);
               }
               else {
                  $row['tot'] = $row_count[0]['tot'];
               }
		}
      return $row;
	}

	function getUniqueCode($type)
	{
		$sql = "Select COUNT(*) as tot from ".PRJ_DB_PREFIX."_organization_association where dCreatedDate>'".date('Y-m-d')."'";
		// echo $sql; exit;
		$rw =  $this->_obj->MySQLSelect($sql);
		$num = ($rw[0]['tot']+1);
		if($num<10) {
			$num = '000'.$num;
		} else if($num<100) {
			$num = '00'.$num;
		} else if($num<1000) {
			$num = '0'.$num;
		}
		/*$t=0;
		if($type == 'Buyer') {
			$t=1;
		} else if($type == 'Supplier') {
			$t=2;
		} else if($type == 'Both') {
			$t=3;
		}*/
		$code = '001'.date('ymd').$type.$num;
		// echo $code; exit;
		return $code;
	}
}
?>