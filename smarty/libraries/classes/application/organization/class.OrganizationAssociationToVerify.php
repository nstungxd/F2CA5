<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        OrganizationAssociationToVerify
* GENERATION DATE:  22.04.2010
* CLASS FILE:       /home/www/B2B/libraries/classes/application/class.OrganizationAssociationToVerify.php
* FOR MYSQL TABLE:  b2b_organization_association_toverify
* FOR MYSQL DB:     B2B
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*
*/

class OrganizationAssociationToVerify
{

/**
*   @desc Variable Declaration with default value
*/

	protected $iVerifiedID;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iVerifiedID;
	protected $_iAsociationID;
	protected $_vAssociationCode;
	protected $_iBuyerOrganizationID;
	protected $_iSupplierAssocationID;
	protected $_vBuyerCode;
	protected $_vSupplierCode;
	protected $_dCreatedDate;
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

		$this->_iVerifiedID = null;
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
	public function getiVerifiedID()
	{
		return $this->_iVerifiedID;
	}

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


	public function setiVerifiedID($val)
	{
		 $this->_iVerifiedID =  $val;
	}

	public function setiAsociationID($val)
	{
		 $this->_iAsociationID = $val;
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

	public function setiModifiedByID($val)
	{
		$this->_iModifiedByID = $val;
	}

	public function seteModifiedBy($val)
	{
		$this->_eModifiedBy = $val;
	}

	public function seteVerifiedBy($val)
	{
		$this->_eVerifiedBy = $val;
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

	function select($id)
	{
			if(($id > 0) && (trim($id) != ''))
			{
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_organization_association_toverify WHERE iVerifiedID = $id";
			} else {
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_organization_association_toverify WHERE iVerifiedID=$this->_iVerifiedID ";
		 }
		 $row =  $this->_obj->MySQLSelect($sql);

		$this->_iVerifiedID = $row[0]['iVerifiedID'];
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
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_organization_association_toverify WHERE iVerifiedID = $id";
		 return $result = $this->_obj->sql_query($sql);
	}

	function del($where)
	{
       $sql = "DELETE FROM ".PRJ_DB_PREFIX."_organization_association_toverify WHERE 1 $where";
           //echo $sql;exit;
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
						'iAsociationID'		=>	$this->_iAsociationID,
						'vAssociationCode'	=> $this->_vAssociationCode,
						'iBuyerOrganizationID'		=>	$this->_iBuyerOrganizationID,
						'iSupplierAssocationID'		=>	$this->_iSupplierAssocationID,
						'vBuyerCode'		=>	$this->_vBuyerCode,
						'vSupplierCode'		=>	$this->_vSupplierCode,
						'dCreatedDate'		=>	$this->_dCreatedDate,
						'dModifiedDate'		=>	$this->_dModifiedDate,
						'dVerifiedDate'		=>	$this->_dVerifiedDate,
						'iCreatedBy'		=>	$this->_iCreatedBy,
						'eCreatedBy'		=>	$this->_eCreatedBy,
						'iVerifiedSMID'		=>	$this->_iVerifiedSMID,
						'eVerifiedBy' 		=> $this->_eVerifiedBy,
						'iModifiedByID'				=> $this->_iModifiedByID,
						'eModifiedBy'					=> $this->_eModifiedBy,
						'iChangeNo' 		=> $this->_iChangeNo,
						'dRejectedDate'		=>	$this->_dRejectedDate,
						'iRejectedById'				=> $this->_iRejectedById,
						'eRejectedBy' 		=> $this->_eRejectedBy,
						'tReasonToReject' 		=> $this->_tReasonToReject,
                  'eNeedToVerify'	=> $this->_eNeedToVerify,
						'eStatus'		=>	$this->_eStatus
);

		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_organization_association_toverify",$Data,'insert');
		  return $result;
	}


/**
*   @desc   UPDATE
*/

	function update($where)
	{

		 $Data = array(
						 'iAsociationID'		=>	$this->_iAsociationID,
						 'vAssociationCode'	=> $this->_vAssociationCode,
						'iBuyerOrganizationID'		=>	$this->_iBuyerOrganizationID,
						'iSupplierAssocationID'		=>	$this->_iSupplierAssocationID,
						'vBuyerCode'		=>	$this->_vBuyerCode,
						'vSupplierCode'		=>	$this->_vSupplierCode,
						'dCreatedDate'		=>	$this->_dCreatedDate,
						'dModifiedDate'				=>	$this->_dModifiedDate,
						'dVerifiedDate'				=>	$this->_dVerifiedDate,
						'iCreatedBy'		=>	$this->_iCreatedBy,
						'eCreatedBy'		=>	$this->_eCreatedBy,
						'iVerifiedSMID'		=>	$this->_iVerifiedSMID,
						'eVerifiedBy' 					=> $this->_eVerifiedBy,
						'iModifiedByID'				=> $this->_iModifiedByID,
						'eModifiedBy'					=> $this->_eModifiedBy,
						'iChangeNo' 					=> $this->_iChangeNo,
						'dRejectedDate'		=>	$this->_dRejectedDate,
						'iRejectedById'				=> $this->_iRejectedById,
						'eRejectedBy' 		=> $this->_eRejectedBy,
						'tReasonToReject' 		=> $this->_tReasonToReject,
						'eNeedToVerify'	=> $this->_eNeedToVerify,
						'eStatus'		=>	$this->_eStatus
);

		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_organization_association_toverify",$Data,'update',$where);
		  return $result;

	}


	function updateData($data,$where)
	{
          //prints($data);exit;
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_organization_association_toverify",$data,"update",$where);
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
       $sql =  "SELECT $feild FROM ".PRJ_DB_PREFIX."_organization_association_toverify $cnt $limit";
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

      $sql =  "SELECT $fields FROM ".PRJ_DB_PREFIX."_organization_association_toverify oa $jtbl $cnt $limit";
		// echo $sql; exit;
		$row = $this->_obj->MySQLSelect($sql);

		if($pg=='yes')
		{
			$sql_count =  "SELECT Count(*) as tot FROM ".PRJ_DB_PREFIX."_organization_association_toverify oa $jtbl $cnt_count";
			$row_count = $this->_obj->MySqlSelect($sql_count);
         if($groupBy != '') {
				$row['tot'] = count($row_count);
			}
			else {
				$row['tot'] = $row_count[0]['tot'];
			}

			//$row['tot'] = $row_count[0]['tot'];
		}
      return $row;
	}

	function getHistory($vAsocCode)
	{
		global $smarty;
		//$sql = "Select GROUP_CONCAT(astv.eStatus) as sts, GROUP_CONCAT(astv.iVerifiedSMID) as verifyid, GROUP_CONCAT(astv.eVerifiedBy) as verifyby, GROUP_CONCAT(astv.dVerifiedDate) as verifydate, GROUP_CONCAT(astv.iRejectedById) as rejectid, GROUP_CONCAT(astv.eRejectedBy) as rejectby, GROUP_CONCAT(astv.dRejectedDate) as rejectdate, astv.* from ".PRJ_DB_PREFIX."_organization_association_toverify astv where astv.vAssociationCode='$vAsocCode' Group By astv.iChangeNo ORDER BY astv.iChangeNo, astv.iVerifiedID ASC ";
		// $sql = "Select GROUP_CONCAT(astv.eStatus) as sts, GROUP_CONCAT(astv.iModifiedByID) as modifyid, GROUP_CONCAT(astv.eModifiedBy) as modifyby, GROUP_CONCAT(astv.iVerifiedSMID) as verifyid, GROUP_CONCAT(astv.eVerifiedBy) as verifyby, GROUP_CONCAT(astv.dVerifiedDate) as verifydate, GROUP_CONCAT(astv.iRejectedById) as rejectid, GROUP_CONCAT(astv.eRejectedBy) as rejectby, GROUP_CONCAT(astv.dRejectedDate) as rejectdate, astv.* from ".PRJ_DB_PREFIX."_organization_association_toverify astv where astv.vAssociationCode='$vAsocCode' Group By astv.iChangeNo ORDER BY astv.iChangeNo, astv.iVerifiedID ASC ";
		$sql = "Select astv.eStatus as sts, astv.iModifiedByID as modifyid, astv.eModifiedBy as modifyby, astv.iVerifiedSMID as verifyid, astv.eVerifiedBy as verifyby, astv.dVerifiedDate as verifydate, astv.iRejectedById as rejectid, astv.eRejectedBy as rejectby, astv.dRejectedDate as rejectdate, astv.* from ".PRJ_DB_PREFIX."_organization_association_toverify astv where astv.vAssociationCode='$vAsocCode' ORDER BY astv.iChangeNo, astv.iVerifiedID ASC ";
		//echo $sql; exit;
		$vdtls = $this->_obj->MySQLSelect($sql);
		// prints($vdtls); exit;
//		for($ln=0;count($vdtls);$l++) {
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

				if($vdtls[$l]['eVerifiedBy'] != '')
				{
					$vrfyid = @explode(',',$vdtls[$l]['verifyid']);
					$vrfyby = @explode(',',$vdtls[$l]['verifyby']);
					$vrfydate = @explode(',',$vdtls[$l]['verifydate']);
					// $vdtls[$l]['verifiedby'] = $smarty->get_template_vars('LBL_VERIFIED_BY')." ";
					$vdtls[$l]['verifiedby'] = "";
					$vrfynm = array();
					for($ln=0;$ln<count($vrfyid);$ln++) {

						if($ln>1) {
							if($vdtls[$l]['eModifiedBy'] == 'SM') {
								$sql = "Select CONCAT(vFirstName,' ',vLastName) as name from ".PRJ_DB_PREFIX."_security_manager where iSMID=".$vdtls[$l]['iModifiedByID'];
								$musr = $this->_obj->MySQLSelect($sql);
								$vdtls[$l]['modifiedby'] = $musr[0]['name'];
							} else if($vdtls[$l]['eModifiedBy'] == 'OA') {
								$sql = "Select CONCAT(vFirstName,' ',vLastName) as name from ".PRJ_DB_PREFIX."_organization_user where iUserID=".$vdtls[$l]['iModifiedByID'];
								$musr = $this->_obj->MySQLSelect($sql);
								$vdtls[$l]['modifiedby'] = $musr[0]['name'];
							}
						}

						if($vrfyby[$ln] == 'SM') {
							$sql = "Select CONCAT(vFirstName,' ',vLastName) as name from ".PRJ_DB_PREFIX."_security_manager where iSMID=".$vrfyid[$ln];
							$vusr = $this->_obj->MySQLSelect($sql);
							if(trim($vusr[0]['name']) == '') { $vusr[0]['name'] = 'Someone'; }
							if(!in_array($vusr[0]['name']."($vrfyby[$ln])".'-'.DateTime($vrfydate[$ln],'0'),$vrfynm)) {
								$vrfynm[] = $vusr[0]['name']."($vrfyby[$ln])".'-'.DateTime($vrfydate[$ln],'0');
								if($vdtls[$l]['verifiedby'] != "") {
									$vdtls[$l]['verifiedby'] .= ', ';
									// $vdtls[$l]['verifiedby'] .= ' <br/> <label style="display:inline-block;width:105px;">&nbsp;</label> ';
									$vdtls[$l]['verifiedby'] .= '<br/>';
								}
								// $vdtls[$l]['verifiedby'] .= "<span style='display:inline-block; width:190px;'>".$vusr[0]['name']." ($vrfyby[$ln])"."</span> &nbsp; "; 	// .DateTime($vrfydate[$ln],'7');
								$vdtls[$l]['verifiedby'] .= $vusr[0]['name']." ($vrfyby[$ln]) ";
							}
						} else if($vrfyby[$ln] == 'OA') {
							$sql = "Select CONCAT(vFirstName,' ',vLastName) as name from ".PRJ_DB_PREFIX."_organization_user where iUserID=".$vrfyid[$ln];
							$vusr = $this->_obj->MySQLSelect($sql);
							if(trim($vusr[0]['name']) == '') { $vusr[0]['name'] = 'Someone'; }
							if(!in_array($vusr[0]['name']."($vrfyby[$ln])".'-'.DateTime($vrfydate[$ln],'0'),$vrfynm)){
								$vrfynm[] = $vusr[0]['name']."($vrfyby[$ln])".'-'.DateTime($vrfydate[$ln],'0');
								if($vdtls[$l]['verifiedby'] != "") {
									$vdtls[$l]['verifiedby'] .= ', ';
									// $vdtls[$l]['verifiedby'] .= ' <br/> <label style="display:inline-block;width:105px;">&nbsp;</label> ';
									$vdtls[$l]['verifiedby'] .= '<br/>';
								}
								// $vdtls[$l]['verifiedby'] .= "<span style='display:inline-block; width:190px;'>".$vusr[0]['name']." ($vrfyby[$ln])"."</span> &nbsp; "; 	// .DateTime($vrfydate[$ln],'7');
								$vdtls[$l]['verifiedby'] .= $vusr[0]['name']." ($vrfyby[$ln]) ";
							}
						}
					}
				}
				if($vdtls[$l]['eRejectedBy'] != '')
				{
					$rjtid = @explode(',',$vdtls[$l]['rejectid']);
					$rjtby = @explode(',',$vdtls[$l]['rejectby']);
					$rjtdate = @explode(',',$vdtls[$l]['rejectdate']);
					//$vdtls[$l]['rejectedby'] = $smarty->get_template_vars('LBL_REJECTED_BY')." ";
					$vdtls[$l]['rejectedby'] = "";
					$rjtnm = array();
					for($ln=0;$ln<count($rjtid);$ln++) {

						if($ln>1) {
							if($vdtls[$l]['eModifiedBy'] == 'SM') {
								$sql = "Select CONCAT(vFirstName,' ',vLastName) as name from ".PRJ_DB_PREFIX."_security_manager where iSMID=".$vdtls[$l]['iModifiedByID'];
								$musr = $this->_obj->MySQLSelect($sql);
								$vdtls[$l]['modifiedby'] = $musr[0]['name'];
							} else if($vdtls[$l]['eModifiedBy'] == 'OA') {
								$sql = "Select CONCAT(vFirstName,' ',vLastName) as name from ".PRJ_DB_PREFIX."_organization_user where iUserID=".$vdtls[$l]['iModifiedByID'];
								$musr = $this->_obj->MySQLSelect($sql);
								$vdtls[$l]['modifiedby'] = $musr[0]['name'];
							}
						}

						if($rjtby[$ln] == 'SM') {
							$sql = "Select CONCAT(vFirstName,' ',vLastName) as name from ".PRJ_DB_PREFIX."_security_manager where iSMID=".$rjtid[$ln];
							$rusr = $this->_obj->MySQLSelect($sql);
							if(trim($rusr[0]['name']) == '') { $rusr[0]['name'] = 'Someone'; }
							if(!in_array($rusr[0]['name']."($rjtby[$ln])".'-'.DateTime($rjtdate[$ln],'7'),$rjtnm)){
								$rjtnm[] = $rusr[0]['name']."($rjtby[$ln])".'-'.DateTime($rjtdate[$ln],'7');
								if($vdtls[$l]['rejectedby'] != "") {
									$vdtls[$l]['rejectedby'] .= ', ';
									// $vdtls[$l]['rejectedby'] .= ' <br/> <label style="display:inline-block;width:111px;">&nbsp;</label> ';
									$vdtls[$l]['rejectedby'] .= '<br/>';
								}
								//$vdtls[$l]['rejectedby'] .= $rusr[0]['name']." ($rjtby[$ln])"." at ".DateTime($rjtdate[$ln],'7');
								// $vdtls[$l]['rejectedby'] .= "<span style='display:inline-block; width:190px;'>".$rusr[0]['name']." ($rjtby[$ln])"."</span> &nbsp; "; 	// .DateTime($rjtdate[$ln],'7');
								$vdtls[$l]['rejectedby'] .= $rusr[0]['name']." ($rjtby[$ln]) ";
							}
						} else if($rjtby[$ln] == 'OA') {
							$sql = "Select CONCAT(vFirstName,' ',vLastName) as name from ".PRJ_DB_PREFIX."_organization_user where iUserID=".$rjtid[$ln];
							$rusr = $this->_obj->MySQLSelect($sql);
							if(trim($rusr[0]['name']) == '') { $rusr[0]['name'] = 'Someone'; }
							if(!in_array($rusr[0]['name']."($rjtby[$ln])".'-'.DateTime($rjtdate[$ln],'7'),$rjtnm)) {
								$rjtnm[] = $rusr[0]['name']."($rjtby[$ln])".'-'.DateTime($rjtdate[$ln],'7');
								if($vdtls[$l]['rejectedby'] != "") {
									$vdtls[$l]['rejectedby'] .= ', ';
									//$vdtls[$l]['rejectedby'] .= ' <br/> <label style="display:inline-block;width:111px;">&nbsp;</label> ';
									$vdtls[$l]['rejectedby'] .= '<br/>';
								}
								// $vdtls[$l]['rejectedby'] .= "<span style='display:inline-block; width:190px;'>".$rusr[0]['name']." ($rjtby[$ln])"."</span> &nbsp; "; 	// .DateTime($rjtdate[$ln],'7');
								$vdtls[$l]['rejectedby'] .= $rusr[0]['name']." ($rjtby[$ln]) ";
							}
						}
					}
				}
				// prints($vdtls[$l]);
			}
//		}
		// exit;
		return $vdtls;
	}

}
?>