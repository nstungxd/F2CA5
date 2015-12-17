<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        purchaseorderline
* GENERATION DATE:  04.05.2010
* CLASS FILE:       /home/www/B2B/libraries/classes/application/class.purchaseorderline.php
* FOR MYSQL TABLE:  b2b_purchase_order_line
* FOR MYSQL DB:     B2B
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*
*/

class purchaseorderline
{


/**
*   @desc Variable Declaration with default value
*/

	protected $iOrderLineID;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iOrderLineID;
	protected $_iPurchaseOrderID;
	protected $_iLineNumber;
	protected $_eOrderType;
	protected $_vItemCode;
	protected $_tDescription;
	protected $_vUnitOfMeasure;
	protected $_iQuantity;
	protected $_fPrice;
	protected $_dETA;
	protected $_fAmount;
	protected $_fVAT;
	protected $_fOtherTax1;
	protected $_fLineTotal;
	protected $_eInvoiceStatus;



/**
*   @desc   CONSTRUCTOR METHOD
*/

	function __construct()
	{
		global $dbobj;
		$this->_obj = $dbobj;

		$this->_iOrderLineID = null;
		$this->_iPurchaseOrderID = null;
		$this->_iLineNumber = null;
		$this->_eOrderType = null;
		$this->_vItemCode = null;
		$this->_tDescription = null;
		$this->_vUnitOfMeasure = null;
		$this->_iQuantity = null;
		$this->_fPrice = null;
		$this->_dETA = null;
		$this->_fAmount = null;
		$this->_fVAT = null;
		$this->_fOtherTax1 = null;
		$this->_fLineTotal = null;
		$this->_eInvoiceStatus = null;
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


	public function getiOrderLineID()
	{
		return $this->_iOrderLineID;
	}

	public function getiPurchaseOrderID()
	{
		return $this->_iPurchaseOrderID;
	}

	public function getiLineNumber()
	{
		return $this->_iLineNumber;
	}

	public function geteOrderType()
	{
		return $this->_eOrderType;
	}

	public function getvItemCode()
	{
		return $this->_vItemCode;
	}

	public function gettDescription()
	{
		return $this->_tDescription;
	}

	public function getvUnitOfMeasure()
	{
		return $this->_vUnitOfMeasure;
	}

	public function getiQuantity()
	{
		return $this->_iQuantity;
	}

	public function getfPrice()
	{
		return $this->_fPrice;
	}

	public function getdETA()
	{
		return $this->_dETA;
	}

	public function getfAmount()
	{
		return $this->_fAmount;
	}

	public function getfVAT()
	{
		return $this->_fVAT;
	}

	public function getfOtherTax1()
	{
		return $this->_fOtherTax1;
	}

	public function getfLineTotal()
	{
		return $this->_fLineTotal;
	}

	public function geteInvoiceStatus()
	{
		return $this->_eInvoiceStatus;
	}


/**
*   @desc   SETTER METHODS
*/


	public function setiOrderLineID($val)
	{
		 $this->_iOrderLineID =  $val;
	}

	public function setiPurchaseOrderID($val)
	{
		 $this->_iPurchaseOrderID =  $val;
	}

	public function setiLineNumber($val)
	{
		 $this->_iLineNumber =  $val;
	}

	public function seteOrderType($val)
	{
		 $this->_eOrderType =  $val;
	}

	public function setvItemCode($val)
	{
		 $this->_vItemCode =  $val;
	}

	public function settDescription($val)
	{
		 $this->_tDescription =  $val;
	}

	public function setvUnitOfMeasure($val)
	{
		 $this->_vUnitOfMeasure =  $val;
	}

	public function setiQuantity($val)
	{
		 $this->_iQuantity =  $val;
	}

	public function setfPrice($val)
	{
		 $this->_fPrice =  $val;
	}

	public function setdETA($val)
	{
		 $this->_dETA =  $val;
	}

	public function setfAmount($val)
	{
		 $this->_fAmount =  $val;
	}

	public function setfVAT($val)
	{
		 $this->_fVAT =  $val;
	}

	public function setfOtherTax1($val)
	{
		 $this->_fOtherTax1 =  $val;
	}

	public function setfLineTotal($val)
	{
		 $this->_fLineTotal =  $val;
	}

	public function seteInvoiceStatus($val)
	{
		 $this->_eInvoiceStatus =  $val;
	}


/**
*   @desc   SELECT METHOD / LOAD
*/

	function select($id)
	{
			if(($id > 0) && (trim($id) != ''))
			{
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_purchase_order_line WHERE iOrderLineID = $id";
			} else {
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_purchase_order_line WHERE iOrderLineID=$this->_iOrderLineID ";
		 }
		 $row =  $this->_obj->MySQLSelect($sql);

		 $this->_iOrderLineID = $row[0]['iOrderLineID'];
		 $this->_iPurchaseOrderID = $row[0]['iPurchaseOrderID'];
		 $this->_iLineNumber = $row[0]['iLineNumber'];
		 $this->_eOrderType = $row[0]['eOrderType'];
		 $this->_vItemCode = $row[0]['vItemCode'];
		 $this->_tDescription = $row[0]['tDescription'];
		 $this->_vUnitOfMeasure = $row[0]['vUnitOfMeasure'];
		 $this->_iQuantity = $row[0]['iQuantity'];
		 $this->_fPrice = $row[0]['fPrice'];
		 $this->_dETA = $row[0]['dETA'];
		 $this->_fAmount = $row[0]['fAmount'];
		 $this->_fVAT = $row[0]['fVAT'];
		 $this->_fOtherTax1 = $row[0]['fOtherTax1'];
		 $this->_fLineTotal = $row[0]['fLineTotal'];
		 $this->_eInvoiceStatus = $row[0]['eInvoiceStatus'];
 return $row;
	}


/**
*   @desc   DELETE
*/

	function delete($id)
	{
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_purchase_order_line WHERE iOrderLineID = $id";
		 return $result = $this->_obj->sql_query($sql);
	}


/**
*   @desc   INSERT
*/

	function insert()
	{
		 $this->_iOrderLineID = '';
		 $this->iOrderLineID = ""; // clear key for autoincrement

		 $Data = array(
						 'iPurchaseOrderID'		=>	$this->_iPurchaseOrderID,
						'iLineNumber'		=>	$this->_iLineNumber,
						'eOrderType'		=>	$this->_eOrderType,
						'vItemCode'		=>	$this->_vItemCode,
						'tDescription'		=>	$this->_tDescription,
						'vUnitOfMeasure'		=>	$this->_vUnitOfMeasure,
						'iQuantity'		=>	$this->_iQuantity,
						'fPrice'		=>	$this->_fPrice,
						'dETA'		=>	$this->_dETA,
						'fAmount'		=>	$this->_fAmount,
						'fVAT'		=>	$this->_fVAT,
						'fOtherTax1'		=>	$this->_fOtherTax1,
						'fLineTotal'		=>	$this->_fLineTotal,
						'eInvoiceStatus'		=>	$this->_eInvoiceStatus
);
           //prints($Data);exit;
		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_purchase_order_line",$Data,'insert');
		  return $result;
	}


/**
*   @desc   UPDATE
*/

	function update($where)
	{

		 $Data = array(
						 'iPurchaseOrderID'		=>	$this->_iPurchaseOrderID,
						'iLineNumber'		=>	$this->_iLineNumber,
						'eOrderType'		=>	$this->_eOrderType,
						'vItemCode'		=>	$this->_vItemCode,
						'tDescription'		=>	$this->_tDescription,
						'vUnitOfMeasure'		=>	$this->_vUnitOfMeasure,
						'iQuantity'		=>	$this->_iQuantity,
						'fPrice'		=>	$this->_fPrice,
						'dETA'		=>	$this->_dETA,
						'fAmount'		=>	$this->_fAmount,
						'fVAT'		=>	$this->_fVAT,
						'fOtherTax1'		=>	$this->_fOtherTax1,
						'fLineTotal'		=>	$this->_fLineTotal,
						'eInvoiceStatus'		=>	$this->_eInvoiceStatus
);

		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_purchase_order_line",$Data,'update',$where);
		  return $result;

	}


	function updateData($data,$where)
	{
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_purchase_order_line",$data,"update",$where);
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
       $sql =  "SELECT $feild FROM ".PRJ_DB_PREFIX."_purchase_order_line $cnt $limit";
       //echo $sql;exit;
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

      $sql =  "SELECT $fields FROM ".PRJ_DB_PREFIX."_purchase_order_line $jtbl $cnt $limit";
		$row = $this->_obj->MySQLSelect($sql);
		if($pg=="yes")
		{
			$sql_count =  "SELECT Count(*) as tot FROM ".PRJ_DB_PREFIX."_purchase_order_line $jtbl $cnt_count";
			$row_count = $this->_obj->MySqlSelect($sql_count);
			$row[tot] = $row_count[0][tot];
		}
      return $row;
	}
}
?>