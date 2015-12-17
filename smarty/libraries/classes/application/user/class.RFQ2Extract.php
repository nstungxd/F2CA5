<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        RFQ2Extract
* GENERATION DATE:  25.04.2012
* CLASS FILE:       /var/www/B2B/libraries/classes/application/class.RFQ2Extract.php
* FOR MYSQL TABLE:  b2b_rfq2_extract
* FOR MYSQL DB:     b2b_auction_live
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*
*/

class RFQ2Extract
{


/**
*   @desc Variable Declaration with default value
*/

	protected $iRfq2ExtractId;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iRfq2ExtractId;  
	protected $_iRFQ2Id;  
	protected $_iBuyer2Id;  
	protected $_iBuyerId;  
	protected $_iSupplierId;  
	protected $_iInvoiceID;  
	protected $_iPurchaseOrderID;  
	protected $_vCurrency;  
	protected $_dReviewDate;  
	protected $_eFrom;  



/**
*   @desc   CONSTRUCTOR METHOD
*/

	function __construct()
	{
		global $dbobj;
		$this->_obj = $dbobj;

		$this->_iRfq2ExtractId = null; 
		$this->_iRFQ2Id = null; 
		$this->_iBuyer2Id = null; 
		$this->_iBuyerId = null; 
		$this->_iSupplierId = null; 
		$this->_iInvoiceID = null; 
		$this->_iPurchaseOrderID = null; 
		$this->_vCurrency = null; 
		$this->_dReviewDate = null; 
		$this->_eFrom = null; 
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


	public function getiRfq2ExtractId()
	{
		return $this->_iRfq2ExtractId;
	}

	public function getiRFQ2Id()
	{
		return $this->_iRFQ2Id;
	}

	public function getiBuyer2Id()
	{
		return $this->_iBuyer2Id;
	}

	public function getiBuyerId()
	{
		return $this->_iBuyerId;
	}

	public function getiSupplierId()
	{
		return $this->_iSupplierId;
	}

	public function getiInvoiceID()
	{
		return $this->_iInvoiceID;
	}

	public function getiPurchaseOrderID()
	{
		return $this->_iPurchaseOrderID;
	}

	public function getvCurrency()
	{
		return $this->_vCurrency;
	}

	public function getdReviewDate()
	{
		return $this->_dReviewDate;
	}

	public function geteFrom()
	{
		return $this->_eFrom;
	}


/**
*   @desc   SETTER METHODS
*/


	public function setiRfq2ExtractId($val)
	{
		 $this->_iRfq2ExtractId =  $val;
	}

	public function setiRFQ2Id($val)
	{
		 $this->_iRFQ2Id =  $val;
	}

	public function setiBuyer2Id($val)
	{
		 $this->_iBuyer2Id =  $val;
	}

	public function setiBuyerId($val)
	{
		 $this->_iBuyerId =  $val;
	}

	public function setiSupplierId($val)
	{
		 $this->_iSupplierId =  $val;
	}

	public function setiInvoiceID($val)
	{
		 $this->_iInvoiceID =  $val;
	}

	public function setiPurchaseOrderID($val)
	{
		 $this->_iPurchaseOrderID =  $val;
	}

	public function setvCurrency($val)
	{
		 $this->_vCurrency =  $val;
	}

	public function setdReviewDate($val)
	{
		 $this->_dReviewDate =  $val;
	}

	public function seteFrom($val)
	{
		 $this->_eFrom =  $val;
	}


/**
*   @desc   SELECT METHOD / LOAD
*/

	function select($id)
	{
			if(($id > 0) && (trim($id) != ''))
			{
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_rfq2_extract WHERE iRfq2ExtractId = $id";
			} else {
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_rfq2_extract WHERE iRfq2ExtractId=$this->_iRfq2ExtractId ";
		 }
		 $row =  $this->_obj->MySQLSelect($sql); 

		 $this->_iRfq2ExtractId = $row[0]['iRfq2ExtractId'];
		 $this->_iRFQ2Id = $row[0]['iRFQ2Id'];
		 $this->_iBuyer2Id = $row[0]['iBuyer2Id'];
		 $this->_iBuyerId = $row[0]['iBuyerId'];
		 $this->_iSupplierId = $row[0]['iSupplierId'];
		 $this->_iInvoiceID = $row[0]['iInvoiceID'];
		 $this->_iPurchaseOrderID = $row[0]['iPurchaseOrderID'];
		 $this->_vCurrency = $row[0]['vCurrency'];
		 $this->_dReviewDate = $row[0]['dReviewDate'];
		 $this->_eFrom = $row[0]['eFrom'];
 return $row;	
	}


/**
*   @desc   DELETE
*/

	function delete($id)
	{
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_rfq2_extract WHERE iRfq2ExtractId = $id";
		 $result = $this->_obj->sql_query($sql);
		 return $result;
	}


/**
*   @desc   INSERT
*/

	function insert($Data = Array())
	{
		 $this->_iRfq2ExtractId = '';
		 $this->iRfq2ExtractId = ""; // clear key for autoincrement
		 if(!is_array($Data) || count($Data)<1) {
		 $Data = array(
						 'iRFQ2Id'		=>	$this->_iRFQ2Id,
						'iBuyer2Id'		=>	$this->_iBuyer2Id,
						'iBuyerId'		=>	$this->_iBuyerId,
						'iSupplierId'		=>	$this->_iSupplierId,
						'iInvoiceID'		=>	$this->_iInvoiceID,
						'iPurchaseOrderID'		=>	$this->_iPurchaseOrderID,
						'vCurrency'		=>	$this->_vCurrency,
						'dReviewDate'		=>	$this->_dReviewDate,
						'eFrom'		=>	$this->_eFrom 				
);

		 }
		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_rfq2_extract",$Data,'insert');
		  return $result;	
	}


/**
*   @desc   UPDATE
*/

	function update($where)
	{

		 $Data = array(
						 'iRFQ2Id'		=>	$this->_iRFQ2Id,
						'iBuyer2Id'		=>	$this->_iBuyer2Id,
						'iBuyerId'		=>	$this->_iBuyerId,
						'iSupplierId'		=>	$this->_iSupplierId,
						'iInvoiceID'		=>	$this->_iInvoiceID,
						'iPurchaseOrderID'		=>	$this->_iPurchaseOrderID,
						'vCurrency'		=>	$this->_vCurrency,
						'dReviewDate'		=>	$this->_dReviewDate,
						'eFrom'		=>	$this->_eFrom 				
);

		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_rfq2_extract",$Data,'update',$where);
		  return $result;	

	}


	function updateData($data,$where)
	{
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_rfq2_extract",$data,"update",$where);
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
      $sql = "SELECT $feild FROM ".PRJ_DB_PREFIX."_rfq2_extract $cnt $limit";
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

      $sql =  "SELECT $fields FROM ".PRJ_DB_PREFIX."_rfq2_extract $jtbl $cnt $limit";
		$row = $this->_obj->MySQLSelect($sql);
		if($pg=="yes")
		{
			$sql_count =  "SELECT Count(*) as tot FROM ".PRJ_DB_PREFIX."_rfq2_extract $jtbl $cnt_count";
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