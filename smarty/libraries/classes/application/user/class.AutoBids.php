<?php
/**
* -------------------------------------------------------
* CLASSNAME:        AutoBids
* GENERATION DATE:  21.06.2011
* CLASS FILE:       /home/www/B2B/libraries/classes/application/class.AutoBids.php
* FOR MYSQL TABLE:  b2b_autobid_master
* FOR MYSQL DB:     B2B_Auction
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*/

class AutoBids
{

/**
*   @desc Variable Declaration with default value
*/

	protected $iAutoBidId;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iAutoBidId;  
	protected $_iBuyer2Id;  
	protected $_iRFQ2Id;  
	protected $_fIntervalAdvancePc;  
	protected $_fIntervalAdvanceAmt;  
	protected $_fIntervalPricePc;  
	protected $_fIntervalPriceAmt;  
	protected $_fMaxAdvancePc;  
	protected $_fMaxAdvanceAmt;  
	protected $_fMaxPricePc;  
	protected $_fMaxPriceAmt;  
	protected $_fIntervalBidTotal;  
	protected $_fMaxBidTotal;  
	protected $_dADate;  
	protected $_eStatus;  



/**
*   @desc   CONSTRUCTOR METHOD
*/

	function __construct()
	{
		global $dbobj;
		$this->_obj = $dbobj;

		$this->_iAutoBidId = null; 
		$this->_iBuyer2Id = null; 
		$this->_iRFQ2Id = null; 
		$this->_fIntervalAdvancePc = null; 
		$this->_fIntervalAdvanceAmt = null; 
		$this->_fIntervalPricePc = null; 
		$this->_fIntervalPriceAmt = null; 
		$this->_fMaxAdvancePc = null; 
		$this->_fMaxAdvanceAmt = null; 
		$this->_fMaxPricePc = null; 
		$this->_fMaxPriceAmt = null; 
		$this->_fIntervalBidTotal = null; 
		$this->_fMaxBidTotal = null; 
		$this->_dADate = null; 
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


	public function getiAutoBidId()
	{
		return $this->_iAutoBidId;
	}

	public function getiBuyer2Id()
	{
		return $this->_iBuyer2Id;
	}

	public function getiRFQ2Id()
	{
		return $this->_iRFQ2Id;
	}

	public function getfIntervalAdvancePc()
	{
		return $this->_fIntervalAdvancePc;
	}

	public function getfIntervalAdvanceAmt()
	{
		return $this->_fIntervalAdvanceAmt;
	}

	public function getfIntervalPricePc()
	{
		return $this->_fIntervalPricePc;
	}

	public function getfIntervalPriceAmt()
	{
		return $this->_fIntervalPriceAmt;
	}

	public function getfMaxAdvancePc()
	{
		return $this->_fMaxAdvancePc;
	}

	public function getfMaxAdvanceAmt()
	{
		return $this->_fMaxAdvanceAmt;
	}

	public function getfMaxPricePc()
	{
		return $this->_fMaxPricePc;
	}

	public function getfMaxPriceAmt()
	{
		return $this->_fMaxPriceAmt;
	}

	public function getfIntervalBidTotal()
	{
		return $this->_fIntervalBidTotal;
	}

	public function getfMaxBidTotal()
	{
		return $this->_fMaxBidTotal;
	}

	public function getdADate()
	{
		return $this->_dADate;
	}

	public function geteStatus()
	{
		return $this->_eStatus;
	}


/**
*   @desc   SETTER METHODS
*/


	public function setiAutoBidId($val)
	{
		 $this->_iAutoBidId =  $val;
	}

	public function setiBuyer2Id($val)
	{
		 $this->_iBuyer2Id =  $val;
	}

	public function setiRFQ2Id($val)
	{
		 $this->_iRFQ2Id =  $val;
	}

	public function setfIntervalAdvancePc($val)
	{
		 $this->_fIntervalAdvancePc =  $val;
	}

	public function setfIntervalAdvanceAmt($val)
	{
		 $this->_fIntervalAdvanceAmt =  $val;
	}

	public function setfIntervalPricePc($val)
	{
		 $this->_fIntervalPricePc =  $val;
	}

	public function setfIntervalPriceAmt($val)
	{
		 $this->_fIntervalPriceAmt =  $val;
	}

	public function setfMaxAdvancePc($val)
	{
		 $this->_fMaxAdvancePc =  $val;
	}

	public function setfMaxAdvanceAmt($val)
	{
		 $this->_fMaxAdvanceAmt =  $val;
	}

	public function setfMaxPricePc($val)
	{
		 $this->_fMaxPricePc =  $val;
	}

	public function setfMaxPriceAmt($val)
	{
		 $this->_fMaxPriceAmt =  $val;
	}

	public function setfIntervalBidTotal($val)
	{
		 $this->_fIntervalBidTotal =  $val;
	}

	public function setfMaxBidTotal($val)
	{
		 $this->_fMaxBidTotal =  $val;
	}

	public function setdADate($val)
	{
		 $this->_dADate =  $val;
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
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_autobid_master WHERE iAutoBidId = $id";
			} else {
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_autobid_master WHERE iAutoBidId=$this->_iAutoBidId ";
		 }
		 $row =  $this->_obj->MySQLSelect($sql); 

		 $this->_iAutoBidId = $row[0]['iAutoBidId'];
		 $this->_iBuyer2Id = $row[0]['iBuyer2Id'];
		 $this->_iRFQ2Id = $row[0]['iRFQ2Id'];
		 $this->_fIntervalAdvancePc = $row[0]['fIntervalAdvancePc'];
		 $this->_fIntervalAdvanceAmt = $row[0]['fIntervalAdvanceAmt'];
		 $this->_fIntervalPricePc = $row[0]['fIntervalPricePc'];
		 $this->_fIntervalPriceAmt = $row[0]['fIntervalPriceAmt'];
		 $this->_fMaxAdvancePc = $row[0]['fMaxAdvancePc'];
		 $this->_fMaxAdvanceAmt = $row[0]['fMaxAdvanceAmt'];
		 $this->_fMaxPricePc = $row[0]['fMaxPricePc'];
		 $this->_fMaxPriceAmt = $row[0]['fMaxPriceAmt'];
		 $this->_fIntervalBidTotal = $row[0]['fIntervalBidTotal'];
		 $this->_fMaxBidTotal = $row[0]['fMaxBidTotal'];
		 $this->_dADate = $row[0]['dADate'];
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
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_autobid_master WHERE iAutoBidId = $id";
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
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_autobid_master WHERE $where";
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
		 $this->_iAutoBidId = '';
		 $this->iAutoBidId = ""; // clear key for autoincrement
		 if(!is_array($Data) || count($Data)<1) {
			 $Data = array(
						 'iBuyer2Id'		=>	$this->_iBuyer2Id,
						'iRFQ2Id'		=>	$this->_iRFQ2Id,
						'fIntervalAdvancePc'		=>	$this->_fIntervalAdvancePc,
						'fIntervalAdvanceAmt'		=>	$this->_fIntervalAdvanceAmt,
						'fIntervalPricePc'		=>	$this->_fIntervalPricePc,
						'fIntervalPriceAmt'		=>	$this->_fIntervalPriceAmt,
						'fMaxAdvancePc'		=>	$this->_fMaxAdvancePc,
						'fMaxAdvanceAmt'		=>	$this->_fMaxAdvanceAmt,
						'fMaxPricePc'		=>	$this->_fMaxPricePc,
						'fMaxPriceAmt'		=>	$this->_fMaxPriceAmt,
						'fIntervalBidTotal'		=>	$this->_fIntervalBidTotal,
						'fMaxBidTotal'		=>	$this->_fMaxBidTotal,
						'dADate'		=>	$this->_dADate,
						'eStatus'		=>	$this->_eStatus 				
				);
		}
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_autobid_master",$Data,'insert');
		return $result;	
	}


/**
*   @desc   UPDATE
*/

	function update($where)
	{

		 $Data = array(
						 'iBuyer2Id'		=>	$this->_iBuyer2Id,
						'iRFQ2Id'		=>	$this->_iRFQ2Id,
						'fIntervalAdvancePc'		=>	$this->_fIntervalAdvancePc,
						'fIntervalAdvanceAmt'		=>	$this->_fIntervalAdvanceAmt,
						'fIntervalPricePc'		=>	$this->_fIntervalPricePc,
						'fIntervalPriceAmt'		=>	$this->_fIntervalPriceAmt,
						'fMaxAdvancePc'		=>	$this->_fMaxAdvancePc,
						'fMaxAdvanceAmt'		=>	$this->_fMaxAdvanceAmt,
						'fMaxPricePc'		=>	$this->_fMaxPricePc,
						'fMaxPriceAmt'		=>	$this->_fMaxPriceAmt,
						'fIntervalBidTotal'		=>	$this->_fIntervalBidTotal,
						'fMaxBidTotal'		=>	$this->_fMaxBidTotal,
						'dADate'		=>	$this->_dADate,
						'eStatus'		=>	$this->_eStatus 				
			);
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_autobid_master",$Data,'update',$where);
		return $result;
	}


	function updateData($data,$where)
	{
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_autobid_master",$data,"update",$where);
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
      $sql = "SELECT $feild FROM ".PRJ_DB_PREFIX."_autobid_master $cnt $limit";
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

      $sql =  "SELECT $fields FROM ".PRJ_DB_PREFIX."_autobid_master $jtbl $cnt $limit";
		$row = $this->_obj->MySQLSelect($sql);
		if($pg=="yes")
		{
			$sql_count =  "SELECT Count(*) as tot FROM ".PRJ_DB_PREFIX."_autobid_master $jtbl $cnt_count";
			$row_count = $this->_obj->MySQLSelect($sql_count);
			$row['tot'] = $row_count[0]['tot'];
			if($groupBy != "") {
				$row['tot'] = @ count($row_count);
			}
		}
      return $row;
	}
	
}

?>