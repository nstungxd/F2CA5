<?php
/*
* -------------------------------------------------------
* CLASSNAME:        Buyer2_Supplier_Association_ToVerify
* GENERATION DATE:  26.02.2011
* CLASS FILE:       /home/design/design/www/B2B/libraries/classes/application/class.Buyer2_Supplier_Association_ToVerify.php
* FOR MYSQL TABLE:  b2b_buyer2_supplier_association_toverify
* FOR MYSQL DB:     B2B
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*/

class Buyer2_Supplier_Association_ToVerify
{

/**
*   @desc Variable Declaration with default value
*/

	protected $iVerifiedID;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iVerifiedID;
	protected $_iAssociationId;
	protected $_iBuyer2Id;
	protected $_iSupplierId;
	protected $_vACode;
	protected $_vAccount1;
	protected $_vAcc1Code;
	protected $_vCurrency1;
	protected $_vAccount2;
	protected $_vAcc2Code;
	protected $_vCurrency2;
	protected $_dADate;
	protected $_vFromIP;
	protected $_iCreatedByID;
	protected $_eCreatedBy;
	protected $_iModifiedByID;
	protected $_eModifiedBy;
	protected $_dModifiedDate;
	protected $_iRejectedByID;
	protected $_eRejectedBy;
	protected $_dRejectedDate;
	protected $_iVerifiedByID;
	protected $_eVerifiedBy;
	protected $_dVerifiedDate;
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
		$this->_iAssociationId = null;
		$this->_iBuyer2Id = null;
		$this->_iSupplierId = null;
		$this->_vACode = null;
		$this->_vAccount1 = null;
		$this->_vAcc1Code = null;
		$this->_vCurrency1 = null;
		$this->_vAccount2 = null;
		$this->_vAcc2Code = null;
		$this->_vCurrency2 = null;
		$this->_dADate = null;
		$this->_vFromIP = null;
		$this->_iCreatedByID = null;
		$this->_eCreatedBy = null;
		$this->_iModifiedByID = null;
		$this->_eModifiedBy = null;
		$this->_dModifiedDate = null;
		$this->_iRejectedByID = null;
		$this->_eRejectedBy = null;
		$this->_dRejectedDate = null;
		$this->_iVerifiedByID = null;
		$this->_eVerifiedBy = null;
		$this->_dVerifiedDate = null;
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

	public function getiAssociationId()
	{
		return $this->_iAssociationId;
	}

	public function getiBuyer2Id()
	{
		return $this->_iBuyer2Id;
	}

	public function getiSupplierId()
	{
		return $this->_iSupplierId;
	}

	public function getvACode()
	{
		return $this->_vACode;
	}

	public function getvAccount1()
	{
		return $this->_vAccount1;
	}

	public function getvAcc1Code()
	{
		return $this->_vAcc1Code;
	}

	public function getvCurrency1()
	{
		return $this->_vCurrency1;
	}

	public function getvAccount2()
	{
		return $this->_vAccount2;
	}

	public function getvAcc2Code()
	{
		return $this->_vAcc2Code;
	}

	public function getvCurrency2()
	{
		return $this->_vCurrency2;
	}

	public function getdADate()
	{
		return $this->_dADate;
	}

	public function getvFromIP()
	{
		return $this->_vFromIP;
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

	public function getdModifiedDate()
	{
		return $this->_dModifiedDate;
	}

	public function getiRejectedByID()
	{
		return $this->_iRejectedByID;
	}

	public function geteRejectedBy()
	{
		return $this->_eRejectedBy;
	}

	public function getdRejectedDate()
	{
		return $this->_dRejectedDate;
	}

	public function getiVerifiedByID()
	{
		return $this->_iVerifiedByID;
	}

	public function geteVerifiedBy()
	{
		return $this->_eVerifiedBy;
	}

	public function getdVerifiedDate()
	{
		return $this->_dVerifiedDate;
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

	public function setiAssociationId($val)
	{
		 $this->_iAssociationId =  $val;
	}

	public function setiBuyer2Id($val)
	{
		 $this->_iBuyer2Id =  $val;
	}

	public function setiSupplierId($val)
	{
		 $this->_iSupplierId =  $val;
	}

	public function setvACode($val)
	{
		 $this->_vACode =  $val;
	}

	public function setvAccount1($val)
	{
		 $this->_vAccount1 =  $val;
	}

	public function setvAcc1Code($val)
	{
		$this->_vAcc1Code =  $val;
	}

	public function setvCurrency1($val)
	{
		 $this->_vCurrency1 =  $val;
	}

	public function setvAccount2($val)
	{
		 $this->_vAccount2 =  $val;
	}

	public function setvAcc2Code($val)
	{
		$this->_vAcc2Code =  $val;
	}

	public function setvCurrency2($val)
	{
		 $this->_vCurrency2 =  $val;
	}

	public function setdADate($val)
	{
		 $this->_dADate =  $val;
	}

	public function setvFromIP($val)
	{
		 $this->_vFromIP =  $val;
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

	public function setdModifiedDate($val)
	{
		 $this->_dModifiedDate =  $val;
	}

	public function setiRejectedByID($val)
	{
		 $this->_iRejectedByID =  $val;
	}

	public function seteRejectedBy($val)
	{
		 $this->_eRejectedBy =  $val;
	}

	public function setdRejectedDate($val)
	{
		 $this->_dRejectedDate =  $val;
	}

	public function setiVerifiedByID($val)
	{
		 $this->_iVerifiedByID =  $val;
	}

	public function seteVerifiedBy($val)
	{
		 $this->_eVerifiedBy =  $val;
	}

	public function setdVerifiedDate($val)
	{
		 $this->_dVerifiedDate =  $val;
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
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_buyer2_supplier_association_toverify WHERE iVerifiedID = $id";
			} else {
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_buyer2_supplier_association_toverify WHERE iVerifiedID=$this->_iVerifiedID ";
		 }
		 $row =  $this->_obj->MySQLSelect($sql);

		 $this->_iVerifiedID = $row[0]['iVerifiedId'];
		 $this->_iAssociationId = $row[0]['iAssociationId'];
		 $this->_iBuyer2Id = $row[0]['iBuyer2Id'];
		 $this->_iSupplierId = $row[0]['iSupplierId'];
		 $this->_vACode = $row[0]['vACode'];
		 $this->_vAccount1 = $row[0]['vAccount1'];
		 $this->_vAcc1Code = $row[0]['vAcc1Code'];
		 $this->_vCurrency1 = $row[0]['vCurrency1'];
		 $this->_vAccount2 = $row[0]['vAccount2'];
		 $this->_vAcc2Code = $row[0]['vAcc2Code'];
		 $this->_vCurrency2 = $row[0]['vCurrency2'];
		 $this->_dADate = $row[0]['dADate'];
		 $this->_vFromIP = $row[0]['vFromIP'];
		 $this->_iCreatedByID = $row[0]['iCreatedByID'];
		 $this->_eCreatedBy = $row[0]['eCreatedBy'];
		 $this->_iModifiedByID = $row[0]['iModifiedByID'];
		 $this->_eModifiedBy = $row[0]['eModifiedBy'];
		 $this->_dModifiedDate = $row[0]['dModifiedDate'];
		 $this->_iRejectedByID = $row[0]['iRejectedByID'];
		 $this->_eRejectedBy = $row[0]['eRejectedBy'];
		 $this->_dRejectedDate = $row[0]['dRejectedDate'];
		 $this->_iVerifiedByID = $row[0]['iVerifiedByID'];
		 $this->_eVerifiedBy = $row[0]['eVerifiedBy'];
		 $this->_dVerifiedDate = $row[0]['dVerifiedDate'];
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
	  if(trim($id)!='' && $id>0)
     {
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_buyer2_supplier_association_toverify WHERE iAssociationId = $id";
		 return $result = $this->_obj->sql_query($sql);
     }
	}

   /**
   *   @desc   DELETE BY CONDITION
   */
   function del($where)
   {
      if(trim($where)!='')
      {
         $sql = "DELETE FROM ".PRJ_DB_PREFIX."_buyer2_supplier_association_toverify WHERE $where";
   		$result = $this->_obj->sql_query($sql);
         return $result;
      }
      return '';
	}

/**
*   @desc   INSERT
*/

	function insert($Data = Array())
	{
		 $this->_iVerifiedID = '';
		 $this->iVerifiedID = ""; // clear key for autoincrement
		 if(!is_array($Data) || count($Data)<1) {
			 $Data = array(
						 'iVerifiedId'		=>	$this->_iVerifiedID,
						'iAssociationId'		=>	$this->_iAssociationId,
						'iBuyer2Id'		=>	$this->_iBuyer2Id,
						'iSupplierId'		=>	$this->_iSupplierId,
						'vACode'		=>	$this->_vACode,
						'vAccount1'		=>	$this->_vAccount1,
						'vAcc1Code'		=>	$this->_vAcc1Code,
						'vCurrency1'		=>	$this->_vCurrency1,
						'vAccount2'		=>	$this->_vAccount2,
						'vAcc2Code'		=>	$this->_vAcc2Code,
						'vCurrency2'		=>	$this->_vCurrency2,
						'dADate'		=>	$this->_dADate,
						'vFromIP'		=>	$this->_vFromIP,
						'iCreatedByID'		=>	$this->_iCreatedByID,
						'eCreatedBy'		=>	$this->_eCreatedBy,
						'iModifiedByID'		=>	$this->_iModifiedByID,
						'eModifiedBy'		=>	$this->_eModifiedBy,
						'dModifiedDate'		=>	$this->_dModifiedDate,
						'iRejectedByID'		=>	$this->_iRejectedByID,
						'eRejectedBy'		=>	$this->_eRejectedBy,
						'dRejectedDate'		=>	$this->_dRejectedDate,
						'iVerifiedByID'		=>	$this->_iVerifiedByID,
						'eVerifiedBy'		=>	$this->_eVerifiedBy,
						'dVerifiedDate'		=>	$this->_dVerifiedDate,
						'tReasonToReject'		=>	$this->_tReasonToReject,
						'eNeedToVerify'		=>	$this->_eNeedToVerify,
						'eStatus'		=>	$this->_eStatus
);

		 }
		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_buyer2_supplier_association_toverify",$Data,'insert');
		  return $result;
	}


/**
*   @desc   UPDATE
*/

	function update($where)
	{

		 $Data = array(
						 'iVerifiedId'		=>	$this->_iVerifiedID,
						'iAssociationId'		=>	$this->_iAssociationId,
						'iBuyer2Id'		=>	$this->_iBuyer2Id,
						'iSupplierId'		=>	$this->_iSupplierId,
						'vACode'		=>	$this->_vACode,
						'vAccount1'		=>	$this->_vAccount1,
						'vAcc1Code'		=>	$this->_vAcc1Code,
						'vCurrency1'		=>	$this->_vCurrency1,
						'vAccount2'		=>	$this->_vAccount2,
						'vAcc2Code'		=>	$this->_vAcc2Code,
						'vCurrency2'		=>	$this->_vCurrency2,
						'dADate'		=>	$this->_dADate,
						'vFromIP'		=>	$this->_vFromIP,
						'iCreatedByID'		=>	$this->_iCreatedByID,
						'eCreatedBy'		=>	$this->_eCreatedBy,
						'iModifiedByID'		=>	$this->_iModifiedByID,
						'eModifiedBy'		=>	$this->_eModifiedBy,
						'dModifiedDate'		=>	$this->_dModifiedDate,
						'iRejectedByID'		=>	$this->_iRejectedByID,
						'eRejectedBy'		=>	$this->_eRejectedBy,
						'dRejectedDate'		=>	$this->_dRejectedDate,
						'iVerifiedByID'		=>	$this->_iVerifiedByID,
						'eVerifiedBy'		=>	$this->_eVerifiedBy,
						'dVerifiedDate'		=>	$this->_dVerifiedDate,
						'tReasonToReject'		=>	$this->_tReasonToReject,
						'eNeedToVerify'		=>	$this->_eNeedToVerify,
						'eStatus'		=>	$this->_eStatus
);

		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_buyer2_supplier_association_toverify",$Data,'update',$where);
		  return $result;

	}


	function updateData($data,$where)
	{
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_buyer2_supplier_association_toverify",$data,"update",$where);
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
      $sql = "SELECT $feild FROM ".PRJ_DB_PREFIX."_buyer2_supplier_association_toverify b2sav $cnt $limit";
      $row = $this->_obj->MySQLSelect($sql);
      return $row;
   }

   /**
	*   @desc   GET DETAILS WITH PAGING AND JOINED TABLE IF REQUIRED
	*/
   function getJoinTableInfo($jtbl,$fields="*",$where="",$orderBy="",$groupBy="",$limit="",$pg="")
   {
      $cnt = "";
      $cnt_count = "";
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

      $sql =  "SELECT $fields FROM ".PRJ_DB_PREFIX."_buyer2_supplier_association_toverify b2sav $jtbl $cnt $limit";
      // echo $sql; exit;
		$row = $this->_obj->MySQLSelect($sql);
		if($pg=="yes")
		{
			$sql_count =  "SELECT Count(*) as tot FROM ".PRJ_DB_PREFIX."_buyer2_supplier_association_toverify b2sav $jtbl $cnt_count";
			$row_count = $this->_obj->MySqlSelect($sql_count);
			$row['tot'] = $row_count[0]['tot'];
		}
      return $row;
	}

   function isVerifyReq($ary=array())
   {
      if(!(is_array($ary) && count($ary)>0)) {
         return 'nr';
      } else {
         if(! (($ary[0]['eStatus']=='Active' || $ary[0]['eStatus']=='Inactive') && $ary[0]['eNeedToVerify']!='Yes')) {
            return 'vreq';
         } else {
            return 'vnr';
         }
      }
   }

   /**
	*   @desc   CHECK FOR RECORD VERIFICATION
	*/
   function chkRecVrf($ary=array())
   {
      global $curORGID, $sess_usertype, $sess_usertype_short, $sess_id;

      $vsts = '';

      if(!(is_array($ary) && count($ary)>0)) {
         $vsts = 'nr';
         // header('Location: '.SITE_URL_DUM.'b2bprodtasoclist');
         // exit;
      } else if($sess_usertype!='securitymanager') {
         if($curORGID!=$ary[0]['iBuyer2Id'] && $curORGID!=$ary[0]['iBuyerId']) {
            $vsts = 'om';
            // header('Location: '.SITE_URL_DUM.'b2bprodtasoclist');
            // exit;
         }
      } else if(! (($ary[0]['eStatus']=='Active' || $ary[0]['eStatus']=='Inactive') && $ary[0]['eNeedToVerify']!='Yes')) {
         switch($ary[0]['eStatus'])
         {
            case 'Modified':
            case 'Deleted':
               if($sess_usertype_short==$ary[0]['eModifiedBy'] && $sess_id==$ary[0]['iModifiedByID']) {
                  $vsts = 'uhc';
               } else if($sess_usertype_short==$ary[0]['eModifiedBy'] || $sess_usertype=='securitymanager') {
                  $vsts = 'ucv';
               }
               break;
            case 'Need to Verify':
               if($sess_usertype_short==$ary[0]['eCreatedBy'] && $sess_id==$ary[0]['iCreatedByID']) {
                  $vsts = 'uhc';
               } else if($sess_usertype_short==$ary[0]['eCreatedBy'] || $sess_usertype=='securitymanager') {
                  $vsts = 'ucv';
               }
               break;
         }
         // pr($ary); exit;
         if($ary[0]['eNeedToVerify']=='Yes') {
            if($sess_usertype_short==$ary[0]['eModifiedBy'] && $sess_id==$ary[0]['iModifiedByID']) {
               $vsts = 'uhc';
            } else if($sess_usertype_short==$ary[0]['eModifiedBy'] || $sess_usertype=='securitymanager') {
               $vsts = 'ucv';
            }
         }
      }
      // echo $vsts; exit;
      return $vsts;
   }

   function getStatusMessage($status, $ntvrfy)
   {
      global $smarty;
      $msg = "";
      if($status=='Modified') {
         $msg = $smarty->get_template_vars('MSG_VERIFY_MODIFIED');
      } else if($status=='Delete' && $ntvrfy=='Yes') {
         $msg = $smarty->get_template_vars('MSG_VERIFY_TO_DELETE');
      } else if($status=='Active' && $ntvrfy=='Yes') {
         $msg = $smarty->get_template_vars('MSG_VERIFY_TO_MAKE_ACTIVE');
      } else if($status=='Inactive' && $ntvrfy=='Yes') {
         $msg = $smarty->get_template_vars('MSG_VERIFY_TO_MAKE_INACTIVE');
      } else if($status=='Need to Verify') {
         $msg = $smarty->get_template_vars('MSG_REC_IN_CREATE_STATUS_NEEDTOVERIFY');
      }
      return $msg;
   }

   function getHistory($id)
	{
		$sql = "Select * from ".PRJ_DB_PREFIX."_buyer2_supplier_association_toverify where iAssociationId=$id Order By iVerifiedID ASC ";
		$vdtls = $this->_obj->MySQLSelect($sql);
		for($l=0;$l<count($vdtls);$l++) {
			if($vdtls[$l]['eCreatedBy'] == 'SM') {
				$sql = "Select CONCAT(vFirstName,' ',vLastName) as name from ".PRJ_DB_PREFIX."_security_manager where iSMID=".$vdtls[$l]['iCreatedByID'];
				$cusr = $this->_obj->MySQLSelect($sql);
				$vdtls[$l]['createdby'] = $cusr[0]['name'];
			} else {
				$sql = "Select CONCAT(vFirstName,' ',vLastName) as name from ".PRJ_DB_PREFIX."_organization_user where iUserID=".$vdtls[$l]['iCreatedByID'];
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
				$sql = "Select CONCAT(vFirstName,' ',vLastName) as name from ".PRJ_DB_PREFIX."_security_manager where iSMID=".$vdtls[$l]['iVerifiedByID'];
				$vusr = $this->_obj->MySQLSelect($sql);
				$vdtls[$l]['verifiedby'] = $vusr[0]['name'];
			} else if($vdtls[$l]['eVerifiedBy'] == 'OA') {
				$sql = "Select CONCAT(vFirstName,' ',vLastName) as name from ".PRJ_DB_PREFIX."_organization_user where iUserID=".$vdtls[$l]['iVerifiedByID'];
				$vusr = $this->_obj->MySQLSelect($sql);
				$vdtls[$l]['verifiedby'] = $vusr[0]['name'];
			}

			if($vdtls[$l]['eRejectedBy'] == 'SM') {
				$sql = "Select CONCAT(vFirstName,' ',vLastName) as name from ".PRJ_DB_PREFIX."_security_manager where iSMID=".$vdtls[$l]['iRejectedByID'];
				$rusr = $this->_obj->MySQLSelect($sql);
				$vdtls[$l]['rejectedby'] = $rusr[0]['name'];
			} else if($vdtls[$l]['eRejectedBy'] == 'OA') {
				$sql = "Select CONCAT(vFirstName,' ',vLastName) as name from ".PRJ_DB_PREFIX."_organization_user where iUserID=".$vdtls[$l]['iRejectedByID'];
				$rusr = $this->_obj->MySQLSelect($sql);
				$vdtls[$l]['rejectedby'] = $rusr[0]['name'];
			}
		}
		return $vdtls;
	}
}
?>