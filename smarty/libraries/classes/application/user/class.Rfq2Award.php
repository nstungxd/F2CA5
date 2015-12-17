<?php
/**
* -------------------------------------------------------
* CLASSNAME:        Rfq2Award
* GENERATION DATE:  25.04.2011
* CLASS FILE:       /home/www/B2B/libraries/classes/application/class.Rfq2Award.php
* FOR MYSQL TABLE:  b2b_rfq2award_master
* FOR MYSQL DB:     B2B_Auction
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*/

class Rfq2Award
{

/**
*   @desc Variable Declaration with default value
*/

	protected $iAwardId;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iAwardId;
	protected $_iRFQ2Id;
	protected $_iBidId;
	protected $_vAwardNum;
	protected $_eBestBid;
	protected $_eOrgCreatedBy;
	protected $_iCreatedById;
	protected $_iModifiedById;
	protected $_iVerifiedById;
	protected $_iRejectedById;
	protected $_iStatusID;
	protected $_iaStatusID;
	protected $_dADate;
	protected $_eDelete;
	protected $_eSaved;



/**
*   @desc   CONSTRUCTOR METHOD
*/

	function __construct()
	{
		global $dbobj;
		$this->_obj = $dbobj;

		$this->_iAwardId = null;
		$this->_iRFQ2Id = null;
		$this->_iBidId = null;
		$this->_vAwardNum = null;
		$this->_eBestBid = null;
		$this->_eOrgCreatedBy = null;
		$this->_iCreatedById = null;
		$this->_iModifiedById = null;
		$this->_iVerifiedById = null;
		$this->_iRejectedById = null;
		$this->_iStatusID = null;
		$this->_iaStatusID = null;
		$this->_dADate = null;
		$this->_eDelete = null;
		$this->_eSaved = null;
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


	public function getiAwardId()
	{
		return $this->_iAwardId;
	}

	public function getiRFQ2Id()
	{
		return $this->_iRFQ2Id;
	}

	public function getiBidId()
	{
		return $this->_iBidId;
	}

	public function getvAwardNum()
	{
		return $this->_vAwardNum;
	}

	public function geteBestBid()
	{
		return $this->_eBestBid;
	}

	public function geteOrgCreatedBy()
	{
		return $this->_eOrgCreatedBy;
	}

	public function getiCreatedById()
	{
		return $this->_iCreatedById;
	}

	public function getiModifiedById()
	{
		return $this->_iModifiedById;
	}

	public function getiVerifiedById()
	{
		return $this->_iVerifiedById;
	}

	public function getiRejectedById()
	{
		return $this->_iRejectedById;
	}

	public function getiStatusID()
	{
		return $this->_iStatusID;
	}

	public function getiaStatusID()
	{
		return $this->_iaStatusID;
	}

	public function getdADate()
	{
		return $this->_dADate;
	}

	public function geteDelete()
	{
		return $this->_eDelete;
	}

	public function geteSaved()
	{
		return $this->_eSaved;
	}


/**
*   @desc   SETTER METHODS
*/


	public function setiAwardId($val)
	{
		 $this->_iAwardId =  $val;
	}

	public function setiRFQ2Id($val)
	{
		 $this->_iRFQ2Id =  $val;
	}

	public function setiBidId($val)
	{
		 $this->_iBidId =  $val;
	}

	public function setvAwardNum($val)
	{
		 $this->_vAwardNum =  $val;
	}

	public function seteBestBid($val)
	{
		 $this->_eBestBid =  $val;
	}

	public function seteOrgCreatedBy($val)
	{
		 $this->_eOrgCreatedBy =  $val;
	}

	public function setiCreatedById($val)
	{
		 $this->_iCreatedById =  $val;
	}

	public function setiModifiedById($val)
	{
		 $this->_iModifiedById =  $val;
	}

	public function setiVerifiedById($val)
	{
		 $this->_iVerifiedById =  $val;
	}

	public function setiRejectedById($val)
	{
		 $this->_iRejectedById =  $val;
	}

	public function setiStatusID($val)
	{
		 $this->_iStatusID =  $val;
	}

	public function setiaStatusID($val)
	{
		 $this->_iaStatusID =  $val;
	}

	public function setdADate($val)
	{
		 $this->_dADate =  $val;
	}

	public function seteDelete($val)
	{
		 $this->_eDelete =  $val;
	}

	public function seteSaved($val)
	{
		 $this->_eSaved =  $val;
	}


/**
*   @desc   SELECT METHOD / LOAD
*/

	function select($id)
	{
		if(($id > 0) && (trim($id) != ''))
		{
			$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_rfq2award_master WHERE iAwardId = $id";
		} else {
			$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_rfq2award_master WHERE iAwardId=$this->_iAwardId ";
		}
		$row =  $this->_obj->MySQLSelect($sql);

		 $this->_iAwardId = $row[0]['iAwardId'];
		 $this->_iRFQ2Id = $row[0]['iRFQ2Id'];
		 $this->_iBidId = $row[0]['iBidId'];
		 $this->_vAwardNum = $row[0]['vAwardNum'];
		 $this->_eBestBid = $row[0]['eBestBid'];
		 $this->_eOrgCreatedBy = $row[0]['eOrgCreatedBy'];
		 $this->_iCreatedById = $row[0]['iCreatedById'];
		 $this->_iModifiedById = $row[0]['iModifiedById'];
		 $this->_iVerifiedById = $row[0]['iVerifiedById'];
		 $this->_iRejectedById = $row[0]['iRejectedById'];
		 $this->_iStatusID = $row[0]['iStatusID'];
		 $this->_iaStatusID = $row[0]['iaStatusID'];
		 $this->_dADate = $row[0]['dADate'];
		 $this->_eDelete = $row[0]['eDelete'];
		 $this->_eSaved = $row[0]['eSaved'];
		return $row;
	}

/**
*   @desc   DELETE
*/
	function delete($id)
	{
		if(trim($id)!='' && $id>0)
		{
			$sql = "DELETE FROM ".PRJ_DB_PREFIX."_rfq2award_master WHERE iAwardId = $id";
			$result = $this->_obj->sql_query($sql);
			return $result;
		}
		return '';
	}

/**
*   @desc   DELETE BY CONDITION
*/
	function del($where)
	{
		if(trim($where)!='')
		{
			$sql = "DELETE FROM ".PRJ_DB_PREFIX."_rfq2award_master WHERE $where";
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
		$this->_iAwardId = '';
		$this->iAwardId = ""; // clear key for autoincrement

		if(!is_array($Data) || count($Data)<1) {
			$Data = array(
						'iRFQ2Id'		=>	$this->_iRFQ2Id,
						'iBidId'		=>	$this->_iBidId,
						'vAwardNum'		=>	$this->_vAwardNum,
						'eBestBid'		=>	$this->_eBestBid,
						'eOrgCreatedBy'		=>	$this->_eOrgCreatedBy,
						'iCreatedById'		=>	$this->_iCreatedById,
						'iModifiedById'		=>	$this->_iModifiedById,
						'iVerifiedById'		=>	$this->_iVerifiedById,
						'iRejectedById'		=>	$this->_iRejectedById,
						'iStatusID'		=>	$this->_iStatusID,
						'iaStatusID'		=>	$this->_iaStatusID,
						'dADate'		=>	$this->_dADate,
						'eDelete'		=>	$this->_eDelete,
						'eSaved'		=>	$this->_eSaved
			);
		}
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_rfq2award_master",$Data,'insert');
		return $result;
	}


/**
*   @desc   UPDATE
*/

	function update($where)
	{
		$Data = array(
						'iRFQ2Id'		=>	$this->_iRFQ2Id,
						'iBidId'		=>	$this->_iBidId,
						'vAwardNum'		=>	$this->_vAwardNum,
						'eBestBid'		=>	$this->_eBestBid,
						'eOrgCreatedBy'		=>	$this->_eOrgCreatedBy,
						'iCreatedById'		=>	$this->_iCreatedById,
						'iModifiedById'		=>	$this->_iModifiedById,
						'iVerifiedById'		=>	$this->_iVerifiedById,
						'iRejectedById'		=>	$this->_iRejectedById,
						'iStatusID'		=>	$this->_iStatusID,
						'iaStatusID'		=>	$this->_iaStatusID,
						'dADate'		=>	$this->_dADate,
						'eDelete'		=>	$this->_eDelete,
						'eSaved'		=>	$this->_eSaved
		);
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_rfq2award_master",$Data,'update',$where);
		return $result;
	}


	function updateData($data,$where)
	{
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_rfq2award_master",$data,"update",$where);
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
      $sql = "SELECT $feild FROM ".PRJ_DB_PREFIX."_rfq2award_master r2aw $cnt $limit";
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

      $sql =  "SELECT $fields FROM ".PRJ_DB_PREFIX."_rfq2award_master r2aw $jtbl $cnt $limit";
		// echo $sql;
		$row = $this->_obj->MySQLSelect($sql);
		if($pg=="yes")
		{
			if($groupBy != "") {
				if(stripos($fields,'distinct')!==false) {
					$fields = str_ireplace('distinct','',$fields);
				}
				$fields = "Count(*) as tot, $fields";
			}
			$sql_count =  "SELECT Count(*) as tot, $fields FROM ".PRJ_DB_PREFIX."_rfq2award_master r2aw $jtbl $cnt_count";
			// echo $sql_count; exit;
			$row_count = $this->_obj->MySQLSelect($sql_count);
			$row['tot'] = $row_count[0]['tot'];
			if($groupBy != "") {
				$row['tot'] = @ count($row_count);
			}
		}
      return $row;
	}

	function getrfq2award($orgid)
	{
		$sql = "SELECT awd.iAwardId,awd.vAwardNum,rfq2mas.vRFQ2Code,orgmas.vCompanyName,rfq2bid.fBidAdvanceTotal,rfq2bid.fBidPriceTotal,stamas.vStatus_en,awd.dADate
					FROM ".PRJ_DB_PREFIX."_rfq2award_master awd
					LEFT JOIN ".PRJ_DB_PREFIX."_rfq2_master rfq2mas ON awd.iRFQ2Id=rfq2mas.iRFQ2Id
					LEFT JOIN ".PRJ_DB_PREFIX."_rfq2_bids rfq2bid ON rfq2bid.iBidId=awd.iBidId
					LEFT JOIN ".PRJ_DB_PREFIX."_status_master stamas ON awd.iStatusID=stamas.iStatusID
					LEFT JOIN ".PRJ_DB_PREFIX."_organization_master orgmas ON rfq2bid.iBuyer2Id=orgmas.iOrganizationID
					WHERE rfq2mas.iOrganizationID=$orgid
					GROUP BY awd.iAwardId DESC
					LIMIT 0,3";
		$dtls = $this->_obj->MySQLSelect($sql);
		return $dtls;

	}

	function getrfq2awards($orgid)
	{
		$sql = "SELECT awd.iAwardId,awd.vAwardNum,rfq2mas.vRFQ2Code,orgmas.vCompanyName,rfq2bid.fBidAdvanceTotal,rfq2bid.fBidPriceTotal,stamas.vStatus_en,awd.dADate
			FROM ".PRJ_DB_PREFIX."_rfq2award_master awd
			LEFT JOIN ".PRJ_DB_PREFIX."_rfq2_master rfq2mas ON awd.iRFQ2Id=rfq2mas.iRFQ2Id
			LEFT JOIN ".PRJ_DB_PREFIX."_rfq2_bids rfq2bid ON rfq2bid.iBidId=awd.iBidId
			LEFT JOIN ".PRJ_DB_PREFIX."_status_master stamas ON awd.iaStatusID=stamas.iStatusID
			LEFT JOIN ".PRJ_DB_PREFIX."_organization_master orgmas ON rfq2bid.iBuyer2Id=orgmas.iOrganizationID
			WHERE rfq2bid.iBuyer2Id=$orgid AND awd.iStatusID>=(SELECT iStatusID FROM b2b_status_master WHERE vForAuction!='' AND vStatus_en='Auth3')
			GROUP BY awd.iAwardId DESC LIMIT 0,3";
		$dtls = $this->_obj->MySQLSelect($sql);
		return $dtls;
	}

	function getaward($orgid)
	{
		/*$sql ="SELECT DISTINCT

		(SELECT COUNT(award.iAwardId)
		FROM b2b_rfq2award_master award
		INNER JOIN b2b_status_master sm ON sm.iStatusID=award.iStatusID
		WHERE sm.vStatus_en='Verify' AND award.eDelete <>'Verified' ) AS tver,

		(SELECT COUNT(award.iAwardId)
		FROM b2b_rfq2award_master award
		INNER JOIN b2b_status_master sm ON sm.iStatusID=award.iStatusID
		WHERE sm.vStatus_en='Created' AND award.eDelete <>'Verified' ) AS tcer,

		(SELECT COUNT(award.iAwardId)
		FROM b2b_rfq2award_master award
		INNER JOIN b2b_status_master sm ON sm.iStatusID=award.iStatusID
		WHERE sm.vStatus_en='Auth1' AND award.eDelete <>'Verified' ) AS tauth1,

		(SELECT COUNT(award.iAwardId)
		FROM b2b_rfq2award_master award
		INNER JOIN b2b_status_master sm ON sm.iStatusID=award.iStatusID
		WHERE sm.vStatus_en='Auth2' AND award.eDelete <>'Verified' ) AS tauth2,

		(SELECT COUNT(award.iAwardId)
		FROM b2b_rfq2award_master award
		INNER JOIN b2b_status_master sm ON sm.iStatusID=award.iStatusID
		WHERE sm.vStatus_en='Auth3' AND award.eDelete <>'Verified' ) AS tauth3,

		(SELECT COUNT(award.iAwardId)
		FROM b2b_rfq2award_master award
		INNER JOIN b2b_status_master sm ON sm.iStatusID=award.iStatusID
		WHERE sm.vStatus_en='Accepted' AND award.eDelete <>'Verified' ) AS taccpted,

		(SELECT COUNT(award.iAwardId)
		FROM b2b_rfq2award_master award
		INNER JOIN b2b_status_master sm ON sm.iStatusID=award.iStatusID
		WHERE sm.vStatus_en='Rejected' AND award.eDelete <>'Verified' ) AS trejected,

		(SELECT COUNT(award.iAwardId)
		FROM b2b_rfq2award_master award
		INNER JOIN b2b_status_master sm ON sm.iStatusID=award.iStatusID
		WHERE award.eDelete <>'Verified') AS ttotal

		FROM b2b_rfq2award_master award
		INNER JOIN b2b_rfq2_master rfq2mas ON award.iRFQ2Id=rfq2mas.iRFQ2Id
		INNER JOIN b2b_organization_master om ON om.iOrganizationID=rfq2mas.iOrganizationID

		WHERE rfq2mas.iOrganizationID=$orgid AND award.eDelete <>'Verified'
		";*/
		//
		$sql = "SELECT COALESCE(COUNT(award.iAwardId),0) AS tot, sm.iStatusID
			FROM b2b_status_master sm
			LEFT JOIN b2b_rfq2award_master award ON (sm.iStatusID=award.iStatusID AND award.eDelete <>'Verified' AND award.iRFQ2Id IN (SELECT iRFQ2Id FROM b2b_rfq2_master WHERE iOrganizationID=$orgid AND eDelete!='Verified'))
			WHERE sm.vForAuction!=''
			GROUP BY sm.iStatusID";
		$dtls = $this->_obj->MySQLSelect($sql);
		$rtn = array();
		if(is_array($dtls) && count($dtls)>0) {
			for($l=0;$l<count($dtls);$l++) {
				$rtn[$dtls[$l]['iStatusID']] = $dtls[$l]['tot'];
			}
		}
		return $rtn;
	}
        
        function getsavedaward($orgid)	{
		
		$sql = "SELECT COALESCE(COUNT(iAwardId),0) AS tot, '0' AS iStatusID
                        FROM b2b_rfq2award_master
                        WHERE eDelete!='Verified' AND eSaved='Yes' ";
		$dtls = $this->_obj->MySQLSelect($sql);		
		return $dtls;
	}

	function getB2Award($orgid)
	{
		/*$sql ="SELECT DISTINCT

		(SELECT COUNT(award.iAwardId)
		FROM b2b_rfq2award_master award
		INNER JOIN b2b_status_master sm ON sm.iStatusID=award.iStatusID
		WHERE sm.vStatus_en='Created' AND award.eDelete <>'Verified' ) AS 'Create',

		(SELECT COUNT(award.iAwardId)
		FROM b2b_rfq2award_master award
		INNER JOIN b2b_status_master sm ON sm.iStatusID=award.iStatusID
		WHERE sm.vStatus_en='Verify' AND award.eDelete <>'Verified' ) AS 'Verify',

		(SELECT COUNT(award.iAwardId)
		FROM b2b_rfq2award_master award
		INNER JOIN b2b_status_master sm ON sm.iStatusID=award.iStatusID
		WHERE sm.vStatus_en='Auth1' AND award.eDelete <>'Verified' ) AS 'Auth1',

		(SELECT COUNT(award.iAwardId)
		FROM b2b_rfq2award_master award
		INNER JOIN b2b_status_master sm ON sm.iStatusID=award.iStatusID
		WHERE sm.vStatus_en='Auth2' AND award.eDelete <>'Verified' ) AS 'Auth2',

		(SELECT COUNT(award.iAwardId)
		FROM b2b_rfq2award_master award
		INNER JOIN b2b_status_master sm ON sm.iStatusID=award.iStatusID
		WHERE sm.vStatus_en='Auth3' AND award.eDelete <>'Verified' ) AS 'Auth3',

		(SELECT COUNT(award.iAwardId)
		FROM b2b_rfq2award_master award
		INNER JOIN b2b_status_master sm ON sm.iStatusID=award.iStatusID
		WHERE sm.vStatus_en='Accepted' AND award.eDelete <>'Verified' ) AS 'Accepted',

		(SELECT COUNT(award.iAwardId)
		FROM b2b_rfq2award_master award
		INNER JOIN b2b_status_master sm ON sm.iStatusID=award.iStatusID
		WHERE sm.vStatus_en='Rejected' AND award.eDelete <>'Verified' ) AS 'Rejected',

		(SELECT COUNT(award.iAwardId)
		FROM b2b_rfq2award_master award
		INNER JOIN b2b_status_master sm ON sm.iStatusID=award.iStatusID
		WHERE award.eDelete <>'Verified') AS 'ttol'

		FROM b2b_rfq2award_master award
		INNER JOIN b2b_rfq2_bids r2bid ON r2bid.iBidId=award.iBidId

		WHERE r2bid.iBuyer2Id=$orgid AND award.eDelete <>'Verified'
		AND award.iStatusID>=(SELECT iStatusID FROM b2b_status_master WHERE vForAuction!='' AND vStatus_en='Auth3')
		";*/
		/*
			SELECT COALESCE(COUNT(award.iAwardId),0) AS tot, sm.iStatusID
			FROM b2b_status_master sm
			LEFT JOIN b2b_rfq2award_master award ON (sm.iStatusID=award.iaStatusID AND award.eDelete <>'Verified' AND award.iStatusID>=(SELECT iStatusID FROM b2b_status_master WHERE vForAuction!='' AND vStatus_en='Auth3'))
			LEFT JOIN b2b_rfq2_bids r2bid ON (r2bid.iBidId=award.iBidId AND r2bid.iBuyer2Id=$orgid)
			WHERE sm.vForAuction!=''
			#AND award.iStatusID>=(SELECT iStatusID FROM b2b_status_master WHERE vForAuction!='' AND vStatus_en='Auth3')
			GROUP BY sm.iStatusID
		*/
		// echo $sql; exit;
		$sql = "(SELECT COALESCE(COUNT(iAwardId),0) AS tot, '0' AS iStatusID
					FROM b2b_rfq2award_master
					WHERE eDelete!='Verified'
					AND iStatusID>=(SELECT iStatusID FROM b2b_status_master WHERE vForAuction!='' AND vStatus_en='Auth3')
					AND iaStatusID=0 AND iBidId IN (SELECT iBidId FROM b2b_rfq2_bids WHERE iBuyer2Id=$orgid AND eDelete!='Verified'))
					UNION
					(SELECT COALESCE(COUNT(award.iAwardId),0) AS tot, sm.iStatusID
					FROM b2b_status_master sm
					LEFT JOIN b2b_rfq2award_master award ON (sm.iStatusID=award.iaStatusID AND award.eDelete <>'Verified' AND award.iStatusID>=(SELECT iStatusID FROM b2b_status_master WHERE vForAuction!='' AND vStatus_en='Auth3') AND award.iBidId IN (SELECT iBidId FROM b2b_rfq2_bids WHERE iBuyer2Id=$orgid AND eDelete!='Verified'))
					WHERE sm.vForAuction!=''
					#AND award.iStatusID>=(SELECT iStatusID FROM b2b_status_master WHERE vForAuction!='' AND vStatus_en='Auth3')
					GROUP BY sm.iStatusID)";
		// echo $sql; exit;
		$dtls = $this->_obj->MySQLSelect($sql);
		$rtn = array();
		if(is_array($dtls) && count($dtls)>0) {
			for($l=0;$l<count($dtls);$l++) {
				$rtn[$dtls[$l]['iStatusID']] = $dtls[$l]['tot'];
			}
		}
		return $rtn;
	}

	function getUniqueCode($type='')
	{
		$sql = "Select COUNT(*) as tot from ".PRJ_DB_PREFIX."_rfq2award_master where dCreatedDate>'".date('Y-m-d')."'";
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

	function getHistory($iAwardId, $orgid=0)
   {
		$oc = "";
		if($orgid>0) {
			$oc = " iOrganizationID = $orgid AND ";
		}
      $sql = "Select iVerifiedID,iItemID,eSubject,eType,vAction,vMailSubject_en,iOrganizationID,iCreatedBy,eCreatedType,eVerifiedBy,iVerifiedBy,dActionDate,dVerifyDate,vVerifyFromIP from ".PRJ_DB_PREFIX."_user_action_verification where $oc iItemID=$iAwardId AND eSubject='RFQ2 Award' Order By dActionDate ASC "; 	// AND eType!='Rejected'
		// echo $sql; exit;
		$dtls = $this->_obj->MySQLSelect($sql);
		for($l=0;$l<count($dtls);$l++)
		{
			$sql = "Select CONCAT(vFirstName,' ',vLastName) as name from ".PRJ_DB_PREFIX."_organization_user where iUserID=".$dtls[$l]['iCreatedBy'];
			$cusr = $this->_obj->MySQLSelect($sql);
			$dtls[$l]['createdby'] = $cusr[0]['name'];
			$sql = "Select CONCAT(vFirstName,' ',vLastName) as name from ".PRJ_DB_PREFIX."_organization_user where iUserID=".$dtls[$l]['iVerifiedBy'];
			$cusr = $this->_obj->MySQLSelect($sql);
			$dtls[$l]['verifiedby'] = $cusr[0]['name'];
		}
		return $dtls;
   }

	function chkAwardSts($bidId,$sts)
	{
		$rejdtls = $this->getDetails('*'," AND iBidId=$bidId AND iStatusID='$sts' ");
		if(is_array($rejdtls) && count($rejdtls)>0 && isset($rejdtls[0]['iAwardId']) && $rejdtls[0]['iAwardId']>0) {
			return 'ex';
		}
		return 'y';
	}
}
?>