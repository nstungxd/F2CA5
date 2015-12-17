<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        OrganizationUserPermission
* GENERATION DATE:  20.04.2010
* CLASS FILE:       /home/www/B2B/libraries/classes/application/class.OrganizationUserPermission.php
* FOR MYSQL TABLE:  b2b_organization_user_permission
* FOR MYSQL DB:     B2B
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*
*/

class OrganizationUserPermission
{


/**
*   @desc Variable Declaration with default value
*/

	protected $iPermissionID;   // KEY ATTR. WITH AUTOINCREMENT

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
	protected $_dRejectedDate;
	protected $_iVerifiedSMID;
	protected $_eVerifiedBy;
	protected $_iModifiedByID;
	protected $_eModifiedBy;
	protected $_dModifiedDate;
	protected $_dVerifiedDate;
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
		$this->_dRejectedDate = null;
		$this->_iVerifiedSMID = null;
		$this->_eVerifiedBy = null;
		$this->_iModifiedByID = null;
		$this->_eModifiedBy = null;
		$this->_dModifiedDate = null;
		$this->_dVerifiedDate = null;
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

	public function getdRejectedDate()
	{
		return $this->_dRejectedDate;
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

	public function setdRejectedDate($val)
	{
		 $this->_dRejectedDate =  $val;
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
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_organization_user_permission WHERE iPermissionID = $id";
			} else {
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_organization_user_permission WHERE iPermissionID=$this->_iPermissionID ";
		 }
		 $row =  $this->_obj->MySQLSelect($sql);

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
		 $this->_dRejectedDate = $row[0]['dRejectedDate'];
		 $this->_iVerifiedSMID = $row[0]['iVerifiedSMID'];
		 $this->_eVerifiedBy = $row[0]['eVerifiedBy'];
		 $this->_iModifiedByID = $row[0]['iModifiedByID'];
		 $this->_eModifiedBy = $row[0]['eModifiedBy'];
		 $this->_dModifiedDate = $row[0]['dModifiedDate'];
		 $this->_dVerifiedDate = $row[0]['dVerifiedDate'];
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
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_organization_user_permission WHERE iPermissionID = $id";
		 return $result = $this->_obj->sql_query($sql);
	}


/**
*   @desc   INSERT
*/

	function insert()
	{
		 $this->_iPermissionID = '';
		 $this->iPermissionID = ""; // clear key for autoincrement

		 $Data = array(
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
						'dRejectedDate'		=>	$this->_dRejectedDate,
						'iVerifiedSMID'		=>	$this->_iVerifiedSMID,
						'eVerifiedBy'		=>	$this->_eVerifiedBy,
						'iModifiedByID'		=>	$this->_iModifiedByID,
						'eModifiedBy'		=>	$this->_eModifiedBy,
						'dModifiedDate'		=>	$this->_dModifiedDate,
						'dVerifiedDate'		=>	$this->_dVerifiedDate,
						'iRejectedById'		=>	$this->_iRejectedById,
						'eRejectedBy'		=>	$this->_eRejectedBy,
						'tReasonToReject'		=>	$this->_tReasonToReject,
						'eNeedToVerify'		=>	$this->_eNeedToVerify,
						'eStatus'		=>	$this->_eStatus
         );

		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_organization_user_permission",$Data,'insert');
		 return $result;
	}


/**
*   @desc   UPDATE
*/

	function update($where)
	{

		 $Data = array(
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
						'dRejectedDate'		=>	$this->_dRejectedDate,
						'iVerifiedSMID'		=>	$this->_iVerifiedSMID,
						'eVerifiedBy'		=>	$this->_eVerifiedBy,
						'iModifiedByID'		=>	$this->_iModifiedByID,
						'eModifiedBy'		=>	$this->_eModifiedBy,
						'dModifiedDate'		=>	$this->_dModifiedDate,
						'dVerifiedDate'		=>	$this->_dVerifiedDate,
						'iRejectedById'		=>	$this->_iRejectedById,
						'eRejectedBy'		=>	$this->_eRejectedBy,
						'tReasonToReject'		=>	$this->_tReasonToReject,
						'eNeedToVerify'		=>	$this->_eNeedToVerify,
						'eStatus'		=>	$this->_eStatus
         );

		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_organization_user_permission",$Data,'update',$where);
		 return $result;
	}


	function updateData($data,$where)
	{
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_organization_user_permission",$data,"update",$where);
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
       $sql =  "SELECT $feild FROM ".PRJ_DB_PREFIX."_organization_user_permission $cnt $limit";
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
         $cnt_count .= " Group By ".$groupBy;
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

	function getUserPermits($iUserID,$ptyp='permits')
	{
		$fld = "tPermission";
		if($ptyp == 'acpt') {
			$fld = "tAcceptancePermit";
		}
		$sql =  "SELECT ePermissionType, iGroupID FROM ".PRJ_DB_PREFIX."_organization_user where iUserID=$iUserID";
		$udt =  $this->_obj->MySQLSelect($sql);
		if($udt[0]['ePermissionType'] == 'Group') {
			$iGroupID = $udt[0]['iGroupID'];
			$sql =  "SELECT $fld FROM ".PRJ_DB_PREFIX."_organization_group where iGroupID=$iGroupID";
		} else {
			$sql =  "SELECT $fld FROM ".PRJ_DB_PREFIX."_organization_user_permission where iUserID=$iUserID";
		}
		$dt =  $this->_obj->MySQLSelect($sql);
		$upermits = (isset($dt[0][$fld]))? $dt[0][$fld] : '';
		if(strpos($upermits, ';') !== false) {
			$upermits = @explode(';',$upermits);
		}
		$invprmts = '';
		$poprmts = '';
		if(is_array($upermits)) {
			if(strpos($upermits[0],'inv:') !== false){
				$invprmts = $upermits[0];
			}
			if(strpos($upermits[1],'po:') !== false){
				$poprmts = $upermits[1];
			}
		} else {
			if(strpos($upermits,'po:') !== false){
				$poprmts = $upermits;
			} else if(strpos($upermits,'inv:') !== false){
				$invprmts = $upermits;
			}
		}
		$poprmts = str_replace("po:", "", $poprmts);
		$invprmts = str_replace("inv:", "", $invprmts);
		$uprmts['po'] = array();
		$uprmts['inv'] = array();
		if($poprmts != '')
			$uprmts['po'] = @explode(',',$poprmts);
		if($invprmts != '')
			$uprmts['inv'] = @explode(',',$invprmts);
		// prints($uprmts); exit;
      return $uprmts;
	}

	function clearExtraPermits($iOrgId,$type)
	{
		$row = '';
		$usql = "Select * from ".PRJ_DB_PREFIX."_organization_user_permission where iUserID IN (Select iUserID from ".PRJ_DB_PREFIX."_organization_user where iOrganizationID=$iOrgId)";
		$usr = $this->_obj->MySQLSelect($usql);
		if($type == 'Buyer') {
			for($l=0;$l<count($usr);$l++) {
				if(trim($usr[$l]['tPermission']) != '') {
					$usr[$l]['tPermission'] = preg_replace('/inv:(.*);/',';',$usr[$l]['tPermission']);
					$usr[$l]['tAcceptancePermit'] = preg_replace('/po:(.*);/','',$usr[$l]['tAcceptancePermit']);
					$usr[$l]['eFormCreation'] = preg_replace('inv','',$usr[$l]['tAcceptancePermit']);
					$usr[$l]['eImportCreation'] = preg_replace('inv','',$usr[$l]['eImportCreation']);
					$usr[$l]['eVerify'] = preg_replace('ii:pa','',$usr[$l]['eVerify']);
					$sql = "Update ".PRJ_DB_PREFIX."_organization_user_permission set tPermission='".$usr[$l]['tPermission']."', tAcceptancePermit='".$usr[$l]['tAcceptancePermit']."', eFormCreation='".$usr[$l]['eFormCreation']."', eImportCreation='".$usr[$l]['eImportCreation']."', eVerify='".$usr[$l]['eVerify']."', eStatus='Active',eNeedToVerify='No' where iUserID=".$usr[$l]['iUserID'];
					$row =  $this->_obj->MySQLSelect($sql);
				}
			}
		} else if($type == 'Supplier') {
			for($l=0;$l<count($usr);$l++) {
				if(trim($usr[$l]['tPermission']) != '') {
					$usr[$l]['tPermission'] = preg_replace('/po:(.*)/','',$usr[$l]['tPermission']);
					$usr[$l]['tAcceptancePermit'] = preg_replace('/inv:(.*)/',';',$usr[$l]['tAcceptancePermit']);
					$usr[$l]['eFormCreation'] = preg_replace('po','',$usr[$l]['eFormCreation']);
					$usr[$l]['eImportCreation'] = preg_replace('po','',$usr[$l]['eImportCreation']);
					$usr[$l]['eVerify'] = preg_replace('pi:ia','',$usr[$l]['eVerify']);
					$sql = "Update ".PRJ_DB_PREFIX."_organization_user_permission set tPermission='".$usr[$l]['tPermission']."', tAcceptancePermit='".$usr[$l]['tAcceptancePermit']."', eFormCreation='".$usr[$l]['eFormCreation']."', eImportCreation='".$usr[$l]['eImportCreation']."', eVerify='".$usr[$l]['eVerify']."', eStatus='Active', eNeedToVerify='No' where iUserID=".$usr[$l]['iUserID'];
					$row =  $this->_obj->MySQLSelect($sql);
				}
			}
		}
		return $row;
	}

	/*function clearExPermits($iOrgId,$type,$dt)
	{
		global $statusmasterObj;
		$poisu = $statusmasterObj->getDetails('iStatusID'," AND eFor='PO' AND vStatus_en='Auth1' ");
		$pauth[] = $poisu[0]['iStatusID'];
		$poisu = $statusmasterObj->getDetails('iStatusID'," AND eFor='PO' AND vStatus_en='Auth2' ");
		$pauth[] = $poisu[0]['iStatusID'];
		$poisu = $statusmasterObj->getDetails('iStatusID'," AND eFor='PO' AND vStatus_en='Auth3' ");
		$pauth[] = $poisu[0]['iStatusID'];
		$ioisu = $statusmasterObj->getDetails('iStatusID'," AND eFor='Invoice' AND vStatus_en='Auth1' ");
		$iauth[] = $ioisu[0]['iStatusID'];
		$ioisu = $statusmasterObj->getDetails('iStatusID'," AND eFor='Invoice' AND vStatus_en='Auth2' ");
		$iauth[] = $ioisu[0]['iStatusID'];
		$ioisu = $statusmasterObj->getDetails('iStatusID'," AND eFor='Invoice' AND vStatus_en='Auth3' ");
		$iauth[] = $ioisu[0]['iStatusID'];
		$usql = "Select * from ".PRJ_DB_PREFIX."_organization_user_permission where iUserID IN (Select iUserID from ".PRJ_DB_PREFIX."_organization_user where iOrganizationID=$iOrgId)";
		$usr = $this->_obj->MySQLSelect($usql);
		$poisusts = @explode(',',$dt['vOrderStatusLevel']);
		$poactsts = @explode(',',$dt['vOrderAcceptanceLevel']);
		$ioisusts = @explode(',',$dt['vInvoiceStatusLevel']);
		$ioactsts = @explode(',',$dt['vInvoiceAcceptanceLevel']);
			for($l=0;$l<count($usr);$l++) {
				if(trim($usr[$l]['tPermission']) != '')
				{
					if(strpos($usr[$l]['tPermission'],';')!==false) {
						$tipermits = @explode(';',$usr[$l]['tPermission']);
					} else {
						if(strpos($usr[$l]['tPermission'],'po')!==false) {
							$tipermits[1] = $usr[$l]['tPermission'];
						} else if(strpos($usr[$l]['tPermission'],'inv')!==false) {
							$tipermits[0] = $usr[$l]['tPermission'];
						}
					}
					if(strpos($usr[$l]['tAcceptancePermit'],';')!==false) {
						$tapermits = @explode(';',$usr[$l]['tAcceptancePermit']);
					} else {
						if(strpos($usr[$l]['tAcceptancePermit'],'po')!==false) {
							$tapermits[1] = $usr[$l]['tAcceptancePermit'];
						} else if(strpos($usr[$l]['tAcceptancePermit'],'inv')!==false) {
							$tapermits[0] = $usr[$l]['tAcceptancePermit'];
						}
					}
					$tipermits[0] = str_replace('inv:','',$tipermits[0]);
					$tipermits[1] = str_replace('po:','',$tipermits[1]);
					$poisu_ary = @explode(',',$tipermits[1]);
					$ioisu_ary = @explode(',',$tipermits[0]);
					$tapermits[0] = str_replace('inv:','',$tapermits[0]);
					$tapermits[1] = str_replace('po:','',$tapermits[1]);
					$poact_ary = @explode(',',$tapermits[1]);
					$ioact_ary = @explode(',',$tapermits[0]);

					// need to remove values from above array which are not in the $dt's permittion array elements
					for($l=0;$l<count($poisu_ary);$l++) {
						if(!in_array($poisu_ary[$l],$poisusts) && in_array($poisu_ary[$l],$pauth)) {
							unset($poisu_ary[$l]);
						}
					}
					for($l=0;$l<count($ioisu_ary);$l++) {
						if(!in_array($ioisu_ary[$l],$ioisusts) && in_array($ioact_ary[$l],$iauth)) {
							unset($ioisu_ary[$l]);
						}
					}
					for($l=0;$l<count($poact_ary);$l++) {
						if(!in_array($poact_ary[$l],$poactsts) && in_array($poisu_ary[$l],$pauth)) {
							unset($poact_ary[$l]);
						}
					}
					for($l=0;$l<count($ioact_ary);$l++) {
						if(!in_array($ioact_ary[$l],$ioactsts) && in_array($ioact_ary[$l],$iauth)) {
							unset($ioact_ary[$l]);
						}
					}

					if(is_array($ioisu_ary)) {
						$ioisu = @implode(',',$ioisu_ary);
					} else {
						$ioisu = '';
					}
					if(is_array($poisu_ary)) {
						$poisu = @implode(',',$poisu_ary);
					} else {
						$poisu = '';
					}
					if(is_array($ioact_ary)) {
						$ioact = @implode(',',$ioact_ary);
					} else {
						$ioact = '';
					}
					if(is_array($poact_ary)) {
						$poact = @implode(',',$poact_ary);
					} else {
						$poact = '';
					}
					//
					$usr[$l]['tPermission'] = 'inv:'.$ioisu.';'.'po:'.$poisu;
					$usr[$l]['tAcceptancePermit'] = 'inv:'.$ioact.';'.'po:'.$poact;
					//$usr[$l]['tPermission'] = preg_replace('/inv:(.*);/',';',$usr[$l]['tPermission']);
					//$usr[$l]['tAcceptancePermit'] = preg_replace('/po:(.*);/','',$usr[$l]['tAcceptancePermit']);
					//$usr[$l]['eFormCreation'] = preg_replace('inv','',$usr[$l]['tAcceptancePermit']);
					//$usr[$l]['eImportCreation'] = preg_replace('inv','',$usr[$l]['eImportCreation']);
					//$usr[$l]['eVerify'] = preg_replace('ii:pa','',$usr[$l]['eVerify']);
					$sql = "Update ".PRJ_DB_PREFIX."_organization_user_permission set tPermission='".$usr[$l]['tPermission']."', tAcceptancePermit='".$usr[$l]['tAcceptancePermit']."', eStatus='Active', eNeedToVerify='No' where iUserID=".$usr[$l]['iUserID'];
					$row =  $this->_obj->MySQLSelect($sql);
				}
			}
		return $row;
	}*/

	function getUserRfq2Permits($iuserid)
	{
		$urfq2p = array();
		if(trim($iuserid)!='' && $iuserid>0)
		{
			global $statusmasterObj;
			$rfq2sts = $statusmasterObj->getDetails('iStatusID,vStatus_en'," AND vForAuction LIKE 'RFQ2,%' AND vStatus_en!='Rejected' ");
			if(is_array($rfq2sts) && count($rfq2sts)>0)
			{
				$up = $this->getDetails('vRFQ2Permits'," AND iUserID=$iuserid ");
				if(isset($up[0]['vRFQ2Permits']) && trim(isset($up[0]['vRFQ2Permits']))!='') {
					$uprmts = @ explode(',', $up[0]['vRFQ2Permits']);
				} else {
					$uprmts = array();
				}
				//
				for($l=0;$l<count($rfq2sts);$l++) {
					if(in_array($rfq2sts[$l]['iStatusID'],$uprmts)) {
						$urfq2p[$rfq2sts[$l]['vStatus_en']] = 'y';
					} else {
						$urfq2p[$rfq2sts[$l]['vStatus_en']] = 'n';
					}
				}
			}
		}
		// pr($urfq2p); exit;
		return $urfq2p;
	}

	function getUserR2Permits($iuserid,$pvtyp,$ptyp)
	{
		$urfq2p = array();
		if(trim($iuserid)!='' && $iuserid>0)
		{
			global $statusmasterObj;
			$rfq2sts = $statusmasterObj->getDetails('iStatusID,vStatus_en'," AND vForAuction LIKE '$pvtyp' AND vStatus_en!='Rejected' ");
			if(is_array($rfq2sts) && count($rfq2sts)>0)
			{
				$up = $this->getDetails("$ptyp"," AND iUserID=$iuserid ");
				if(isset($up[0][$ptyp]) && trim(isset($up[0][$ptyp]))!='') {
					$uprmts = @ explode(',', $up[0][$ptyp]);
				} else {
					$uprmts = array();
				}
				//
				for($l=0;$l<count($rfq2sts);$l++) {
					if(in_array($rfq2sts[$l]['iStatusID'],$uprmts)) {
						$urfq2p[$rfq2sts[$l]['vStatus_en']] = 'y';
					} else {
						$urfq2p[$rfq2sts[$l]['vStatus_en']] = 'n';
					}
				}
			}
		}
		// pr($urfq2p); exit;
		return $urfq2p;
	}
}
?>