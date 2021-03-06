<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        OrganizationUserPermissionToVerify
* GENERATION DATE:  20.04.2010
* CLASS FILE:       /home/www/B2B/libraries/classes/application/class.OrganizationUserPermissionToVerify.php
* FOR MYSQL TABLE:  b2b_organization_user_permission_toverify
* FOR MYSQL DB:     B2B
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*
*/

class OrganizationUserPermissionToVerify
{


/**
*   @desc Variable Declaration with default value
*/

	protected $iVerifiedID;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iVerifiedID;
	protected $_iPermissionID;
	protected $_iUserID;
	protected $_tPermission;
	protected $_tAcceptancePermit;
	protected $_eFormCreation;
	protected $_eImportCreation;
	protected $_eVerify;
	protected $_vRFQ2Permits;
	protected $_vRFQ2BidPermits;
	protected $_vRFQ2AwardPermits;
	protected $_vRFQ2AwardAcceptPermits;
	protected $_eInvFPO;
	protected $_dDate;
	protected $_iCreatedBy;
	protected $_eCreatedBy;
	protected $_iVerifiedSMID;
	protected $_eVerifiedBy;
	protected $_iModifiedByID;
	protected $_eModifiedBy;
	protected $_dModifiedDate;
	protected $_dVerifiedDate;
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

		$this->_iVerifiedID = null;
		$this->_iPermissionID = null;
		$this->_iUserID = null;
		$this->_tPermission = null;
		$this->_tAcceptancePermit = null;
		$this->_eFormCreation = null;
		$this->_eImportCreation = null;
		$this->_eVerify = null;
		$this->_vRFQ2Permits = null;
		$this->_vRFQ2BidPermits = null;
		$this->_vRFQ2AwardPermits = null;
		$this->_vRFQ2AwardAcceptPermits = null;
		$this->_eInvFPO = null;
		$this->_dDate = null;
		$this->_iCreatedBy = null;
		$this->_eCreatedBy = null;
		$this->_iVerifiedSMID = null;
		$this->_eVerifiedBy = null;
		$this->_iModifiedByID = null;
		$this->_eModifiedBy = null;
		$this->_dModifiedDate = null;
		$this->_dVerifiedDate = null;
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


	public function getiVerifiedID()
	{
		return $this->_iVerifiedID;
	}

	public function getiPermissionID()
	{
		return $this->_iPermissionID;
	}

	public function getiUserID()
	{
		return $this->_iUserID;
	}

	public function gettPermission()
	{
		return $this->_tPermission;
	}

	public function gettAcceptancePermit()
	{
		return $this->_tAcceptancePermit;
	}

	public function geteFormCreation()
	{
		return $this->_eFormCreation;
	}

	public function geteImportCreation()
	{
		return $this->_eImportCreation;
	}

	public function geteVerify()
	{
		return $this->_eVerify;
	}

	public function getvRFQ2Permits()
	{
		return $this->_vRFQ2Permits;
	}

	public function getvRFQ2BidPermits()
	{
		return $this->_vRFQ2BidPermits;
	}

	public function getvRFQ2AwardPermits()
	{
		return $this->_vRFQ2AwardPermits;
	}

	public function getvRFQ2AwardAcceptPermits()
	{
		return $this->_vRFQ2AwardAcceptPermits;
	}

	public function geteInvFPO()
	{
		return $this->_eInvFPO;
	}

	public function getdDate()
	{
		return $this->_dDate;
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

	public function getdModifiedDate()
	{
		return $this->_dModifiedDate;
	}

	public function getdVerifiedDate()
	{
		return $this->_dVerifiedDate;
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


	public function setiVerifiedID($val)
	{
		 $this->_iVerifiedID =  $val;
	}

	public function setiPermissionID($val)
	{
		 $this->_iPermissionID =  $val;
	}

	public function setiUserID($val)
	{
		 $this->_iUserID =  $val;
	}

	public function settPermission($val)
	{
		 $this->_tPermission =  $val;
	}

	public function settAcceptancePermit($val)
	{
		 $this->_tAcceptancePermit =  $val;
	}

	public function seteFormCreation($val)
	{
		 $this->_eFormCreation =  $val;
	}

	public function seteImportCreation($val)
	{
		 $this->_eImportCreation =  $val;
	}

	public function seteVerify($val)
	{
		 $this->_eVerify =  $val;
	}

	public function setvRFQ2Permits($val)
	{
		 $this->_vRFQ2Permits =  $val;
	}

	public function setvRFQ2BidPermits($val)
	{
		 $this->_vRFQ2BidPermits =  $val;
	}

	public function setvRFQ2AwardPermits($val)
	{
		 $this->_vRFQ2AwardPermits =  $val;
	}

	public function setvRFQ2AwardAcceptPermits($val)
	{
		$this->_vRFQ2AwardAcceptPermits =  $val;
	}

	public function seteInvFPO($val)
	{
		$this->_eInvFPO = $val;
	}

	public function setdDate($val)
	{
		 $this->_dDate =  $val;
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
		 $this->_eVerifiedBy =  $val;
	}

	public function setiModifiedByID($val)
	{
		 $this->_iModifiedByID =  $val;
	}

	public function seteModifiedBy($val)
	{
		 $this->_eModifiedBy =  $val;
	}

	public function setdModifiedDate($val)
	{
		 $this->_dModifiedDate =  $val;
	}

	public function setdVerifiedDate($val)
	{
		 $this->_dVerifiedDate =  $val;
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

	function select($id)
	{
			if(($id > 0) && (trim($id) != ''))
			{
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_organization_user_permission_toverify WHERE iVerifiedID = $id";
			} else {
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_organization_user_permission_toverify WHERE iVerifiedID=$this->_iVerifiedID ";
		 }
		 $row =  $this->_obj->MySQLSelect($sql);

		 $this->_iVerifiedID = $row[0]['iVerifiedID'];
		 $this->_iPermissionID = $row[0]['iPermissionID'];
		 $this->_iUserID = $row[0]['iUserID'];
		 $this->_tPermission = $row[0]['tPermission'];
		 $this->_tAcceptancePermit = $row[0]['tAcceptancePermit'];
		 $this->_eFormCreation = $row[0]['eFormCreation'];
		 $this->_eImportCreation = $row[0]['eImportCreation'];
		 $this->_eVerify = $row[0]['eVerify'];
		 $this->_vRFQ2Permits = $row[0]['vRFQ2Permits'];
		 $this->_vRFQ2BidPermits = $row[0]['vRFQ2BidPermits'];
		 $this->_vRFQ2AwardPermits = $row[0]['vRFQ2AwardPermits'];
		 $this->_vRFQ2AwardAcceptPermits = $row[0]['vRFQ2AwardAcceptPermits'];
		 $this->_eInvFPO = $row[0]['eInvFPO'];
		 $this->_dDate = $row[0]['dDate'];
		 $this->_iCreatedBy = $row[0]['iCreatedBy'];
		 $this->_eCreatedBy = $row[0]['eCreatedBy'];
		 $this->_iVerifiedSMID = $row[0]['iVerifiedSMID'];
		 $this->_eVerifiedBy = $row[0]['eVerifiedBy'];
		 $this->_iModifiedByID = $row[0]['iModifiedByID'];
		 $this->_eModifiedBy = $row[0]['eModifiedBy'];
		 $this->_dModifiedDate = $row[0]['dModifiedDate'];
		 $this->_dVerifiedDate = $row[0]['dVerifiedDate'];
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
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_organization_user_permission_toverify WHERE iVerifiedID = $id";
		 return $result = $this->_obj->sql_query($sql);
	}


/**
*   @desc   INSERT
*/

	function insert()
	{
		 $this->_iVerifiedID = '';
		 $this->iVerifiedID = ""; // clear key for autoincrement

		 $Data = array(
						 'iPermissionID'		=>	$this->_iPermissionID,
						'iUserID'		=>	$this->_iUserID,
						'tPermission'		=>	$this->_tPermission,
						'tAcceptancePermit'		=>	$this->_tAcceptancePermit,
						'eFormCreation'		=>	$this->_eFormCreation,
						'eImportCreation'		=>	$this->_eImportCreation,
						'eVerify'		=>	$this->_eVerify,
						'vRFQ2Permits'		=>	$this->_vRFQ2Permits,
						'vRFQ2BidPermits'		=>	$this->_vRFQ2BidPermits,
						'vRFQ2AwardPermits'		=>	$this->_vRFQ2AwardPermits,
						'vRFQ2AwardAcceptPermits'		=>	$this->_vRFQ2AwardAcceptPermits,
						'eInvFPO'		=>	$this->_eInvFPO,
						'dDate'		=>	$this->_dDate,
						'iCreatedBy'		=>	$this->_iCreatedBy,
						'eCreatedBy'		=>	$this->_eCreatedBy,
						'iVerifiedSMID'		=>	$this->_iVerifiedSMID,
						'eVerifiedBy'		=>	$this->_eVerifiedBy,
						'iModifiedByID'		=>	$this->_iModifiedByID,
						'eModifiedBy'		=>	$this->_eModifiedBy,
						'dModifiedDate'		=>	$this->_dModifiedDate,
						'dVerifiedDate'		=>	$this->_dVerifiedDate,
						'dRejectedDate'		=>	$this->_dRejectedDate,
						'iRejectedById'		=>	$this->_iRejectedById,
						'eRejectedBy'		=>	$this->_eRejectedBy,
						'tReasonToReject'		=>	$this->_tReasonToReject,
						'eNeedToVerify'		=>	$this->_eNeedToVerify,
						'eStatus'		=>	$this->_eStatus
);

		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_organization_user_permission_toverify",$Data,'insert');
		  return $result;
	}


/**
*   @desc   UPDATE
*/

	function update($where)
	{

		 $Data = array(
						 'iPermissionID'		=>	$this->_iPermissionID,
						'iUserID'		=>	$this->_iUserID,
						'tPermission'		=>	$this->_tPermission,
						'tAcceptancePermit'		=>	$this->_tAcceptancePermit,
						'eFormCreation'		=>	$this->_eFormCreation,
						'eImportCreation'		=>	$this->_eImportCreation,
						'eVerify'		=>	$this->_eVerify,
						'vRFQ2Permits'		=>	$this->_vRFQ2Permits,
						'vRFQ2BidPermits'		=>	$this->_vRFQ2BidPermits,
						'vRFQ2AwardPermits'		=>	$this->_vRFQ2AwardPermits,
						'vRFQ2AwardAcceptPermits'		=>	$this->_vRFQ2AwardAcceptPermits,
						'eInvFPO'		=>	$this->_eInvFPO,
						'dDate'		=>	$this->_dDate,
						'iCreatedBy'		=>	$this->_iCreatedBy,
						'eCreatedBy'		=>	$this->_eCreatedBy,
						'iVerifiedSMID'		=>	$this->_iVerifiedSMID,
						'eVerifiedBy'		=>	$this->_eVerifiedBy,
						'iModifiedByID'		=>	$this->_iModifiedByID,
						'eModifiedBy'		=>	$this->_eModifiedBy,
						'dModifiedDate'		=>	$this->_dModifiedDate,
						'dVerifiedDate'		=>	$this->_dVerifiedDate,
						'dRejectedDate'		=>	$this->_dRejectedDate,
						'iRejectedById'		=>	$this->_iRejectedById,
						'eRejectedBy'		=>	$this->_eRejectedBy,
						'tReasonToReject'		=>	$this->_tReasonToReject,
						'eNeedToVerify'		=>	$this->_eNeedToVerify,
						'eStatus'		=>	$this->_eStatus
         );

		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_organization_user_permission_toverify",$Data,'update',$where);
		 return $result;
	}

	function updateData($data,$where)
	{
      //prints($data);exit;
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_organization_user_permission_toverify",$data,"update",$where);
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
       $sql =  "SELECT $feild FROM ".PRJ_DB_PREFIX."_organization_user_permission_toverify $cnt $limit";
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
      }
		if($orderBy != '') {
         $cnt .= " Order By ".$orderBy;
			$cnt_count .= " Order By ".$orderBy;
      }
      $sql =  "SELECT $fields FROM ".PRJ_DB_PREFIX."_organization_user_permission_toverify uv $jtbl $cnt $limit";
		// echo $sql."<br/>"; //exit;
		$row = $this->_obj->MySQLSelect($sql);
		if($pg=='yes')
		{
			$sql_count =  "SELECT Count(*) as tot FROM ".PRJ_DB_PREFIX."_organization_user_permission_toverify uv $jtbl $cnt_count";
			// echo $sql_count; // exit;
			$row_count = $this->_obj->MySqlSelect($sql_count);
       if($groupBy != '') {
				$row['tot'] = count($row_count);
			}
			else {
				$row['tot'] = $row_count[0]['tot'];
			}
			// $row['tot'] = $row_count[0]['tot'];
		}
      return $row;
	}

	function getHistory($iUserID)
	{
		$sql = "Select * from ".PRJ_DB_PREFIX."_organization_user_permission_toverify where iUserID=$iUserID Order By iVerifiedID ASC ";
		$vdtls = $this->_obj->MySQLSelect($sql);
		for($l=0;$l<count($vdtls);$l++) {
			if($vdtls[$l]['eCreatedBy'] == 'SM') {
				$sql = "Select CONCAT(vFirstName,' ',vLastName) as name from ".PRJ_DB_PREFIX."_security_manager where iSMID=".$vdtls[$l]['iCreatedBy'];
				$cusr = $this->_obj->MySQLSelect($sql);
				$vdtls[$l]['createdby'] = $cusr[0]['name'];
			} else if($vdtls[$l]['eCreatedBy'] == 'OA') {
				$sql = "Select CONCAT(vFirstName,' ',vLastName) as name from ".PRJ_DB_PREFIX."_organization_user where iUserID=".$vdtls[$l]['iCreatedBy'];
				$cusr = $this->_obj->MySQLSelect($sql);
				$vdtls[$l]['createdby'] = $cusr[0]['name'];
			}

			if($vdtls[$l]['eModifiedBy'] == 'SM') {
				$sql = "Select CONCAT(vFirstName,' ',vLastName) as name from ".PRJ_DB_PREFIX."_security_manager where iSMID=".$vdtls[$l]['iModifiedByID'];
				$musr = $this->_obj->MySQLSelect($sql);
				$vdtls[$l]['modifiedby'] = $musr[0]['name'];
			} else if($vdtls[$l]['eModifiedBy'] == 'OA') {
				$sql = "Select CONCAT(vFirstName,' ',vLastName) as name from ".PRJ_DB_PREFIX."_organization_user where iUserID=".$vdtls[$l]['iModifiedByID'];
				$musr = $this->_obj->MySQLSelect($sql);
				$vdtls[$l]['modifiedby'] = $musr[0]['name'];
			}

			if($vdtls[$l]['eVerifiedBy'] == 'SM') {
				$sql = "Select CONCAT(vFirstName,' ',vLastName) as name from ".PRJ_DB_PREFIX."_security_manager where iSMID=".$vdtls[$l]['iVerifiedSMID'];
				$vusr = $this->_obj->MySQLSelect($sql);
				$vdtls[$l]['verifiedby'] = $vusr[0]['name'];
			} else if($vdtls[$l]['eVerifiedBy'] == 'OA') {
				$sql = "Select CONCAT(vFirstName,' ',vLastName) as name from ".PRJ_DB_PREFIX."_organization_user where iUserID=".$vdtls[$l]['iVerifiedSMID'];
				$vusr = $this->_obj->MySQLSelect($sql);
				$vdtls[$l]['verifiedby'] = $vusr[0]['name'];
			}

			if($vdtls[$l]['eRejectedBy'] == 'SM') {
				$sql = "Select CONCAT(vFirstName,' ',vLastName) as name from ".PRJ_DB_PREFIX."_security_manager where iSMID=".$vdtls[$l]['iRejectedById'];
				$rusr = $this->_obj->MySQLSelect($sql);
				$vdtls[$l]['rejectedby'] = $rusr[0]['name'];
			} else if($vdtls[$l]['eRejectedBy'] == 'OA') {
				$sql = "Select CONCAT(vFirstName,' ',vLastName) as name from ".PRJ_DB_PREFIX."_organization_user where iUserID=".$vdtls[$l]['iRejectedById'];
				$rusr = $this->_obj->MySQLSelect($sql);
				$vdtls[$l]['rejectedby'] = $rusr[0]['name'];
			}
		}
		return $vdtls;
	}

}
?>