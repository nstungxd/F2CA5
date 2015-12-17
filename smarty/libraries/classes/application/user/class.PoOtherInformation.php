<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        PoOtherInformation
* GENERATION DATE:  15.07.2010
* CLASS FILE:       /home/www/B2B/libraries/classes/application/class.PoOtherInformation.php
* FOR MYSQL TABLE:  b2b_purchase_order_otherinformation
* FOR MYSQL DB:     B2B
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*
*/

class PoOtherInformation
{


/**
*   @desc Variable Declaration with default value
*/

	protected $iAdditionalInfoID;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iAdditionalInfoID;
	protected $_iPurchaseOrderID;
	protected $_tSourcingDocument;
	protected $_tGlobalAgreement;
	protected $_tPaymentTerms;
	protected $_tFOB;
	protected $_tDeliveryTerms;
	protected $_tShippingControl;
	protected $_tConditionsForPayment;
	protected $_tPenalties;
	protected $_tSpecialInstruction;
	protected $_tNote;



/**
*   @desc   CONSTRUCTOR METHOD
*/

	function __construct()
	{
		global $dbobj;
		$this->_obj = $dbobj;

		$this->_iAdditionalInfoID = null;
		$this->_iPurchaseOrderID = null;
		$this->_tSourcingDocument = null;
		$this->_tGlobalAgreement = null;
		$this->_tPaymentTerms = null;
		$this->_tFOB = null;
		$this->_tDeliveryTerms = null;
		$this->_tShippingControl = null;
		$this->_tConditionsForPayment = null;
		$this->_tPenalties = null;
		$this->_tSpecialInstruction = null;
		$this->_tNote = null;
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


	public function getiAdditionalInfoID()
	{
		return $this->_iAdditionalInfoID;
	}

	public function getiPurchaseOrderID()
	{
		return $this->_iPurchaseOrderID;
	}

	public function gettSourcingDocument()
	{
		return $this->_tSourcingDocument;
	}

	public function gettGlobalAgreement()
	{
		return $this->_tGlobalAgreement;
	}

	public function gettPaymentTerms()
	{
		return $this->_tPaymentTerms;
	}

	public function gettFOB()
	{
		return $this->_tFOB;
	}

	public function gettDeliveryTerms()
	{
		return $this->_tDeliveryTerms;
	}

	public function gettShippingControl()
	{
		return $this->_tShippingControl;
	}

	public function gettConditionsForPayment()
	{
		return $this->_tConditionsForPayment;
	}

	public function gettPenalties()
	{
		return $this->_tPenalties;
	}

	public function gettSpecialInstruction()
	{
		return $this->_tSpecialInstruction;
	}

	public function gettNote()
	{
		return $this->_tNote;
	}


/**
*   @desc   SETTER METHODS
*/


	public function setiAdditionalInfoID($val)
	{
		 $this->_iAdditionalInfoID =  $val;
	}

	public function setiPurchaseOrderID($val)
	{
		 $this->_iPurchaseOrderID =  $val;
	}

	public function settSourcingDocument($val)
	{
		 $this->_tSourcingDocument =  $val;
	}

	public function settGlobalAgreement($val)
	{
		 $this->_tGlobalAgreement =  $val;
	}

	public function settPaymentTerms($val)
	{
		 $this->_tPaymentTerms =  $val;
	}

	public function settFOB($val)
	{
		 $this->_tFOB =  $val;
	}

	public function settDeliveryTerms($val)
	{
		 $this->_tDeliveryTerms =  $val;
	}

	public function settShippingControl($val)
	{
		 $this->_tShippingControl =  $val;
	}

	public function settConditionsForPayment($val)
	{
		 $this->_tConditionsForPayment =  $val;
	}

	public function settPenalties($val)
	{
		 $this->_tPenalties =  $val;
	}

	public function settSpecialInstruction($val)
	{
		 $this->_tSpecialInstruction =  $val;
	}

	public function settNote($val)
	{
		 $this->_tNote =  $val;
	}


/**
*   @desc   SELECT METHOD / LOAD
*/

	function select($id)
	{
			if(($id > 0) && (trim($id) != ''))
			{
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_purchase_order_otherinformation WHERE iAdditionalInfoID = $id";
			} else {
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_purchase_order_otherinformation WHERE iAdditionalInfoID=$this->_iAdditionalInfoID ";
		 }
		 $row =  $this->_obj->MySQLSelect($sql);

		 $this->_iAdditionalInfoID = $row[0]['iAdditionalInfoID'];
		 $this->_iPurchaseOrderID = $row[0]['iPurchaseOrderID'];
		 $this->_tSourcingDocument = $row[0]['tSourcingDocument'];
		 $this->_tGlobalAgreement = $row[0]['tGlobalAgreement'];
		 $this->_tPaymentTerms = $row[0]['tPaymentTerms'];
		 $this->_tFOB = $row[0]['tFOB'];
		 $this->_tDeliveryTerms = $row[0]['tDeliveryTerms'];
		 $this->_tShippingControl = $row[0]['tShippingControl'];
		 $this->_tConditionsForPayment = $row[0]['tConditionsForPayment'];
		 $this->_tPenalties = $row[0]['tPenalties'];
		 $this->_tSpecialInstruction = $row[0]['tSpecialInstruction'];
		 $this->_tNote = $row[0]['tNote'];
 return $row;
	}


/**
*   @desc   DELETE
*/

	function delete($id)
	{
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_purchase_order_otherinformation WHERE iAdditionalInfoID = $id";
		 return $result = $this->_obj->sql_query($sql);
	}


/**
*   @desc   INSERT
*/

	function insert($Data)
	{
		 $this->_iAdditionalInfoID = '';
		 $this->iAdditionalInfoID = ""; // clear key for autoincrement

		if(is_array($Data) && count($Data)>0) {
		} else {
			$Data = array(
						 'iPurchaseOrderID'		=>	$this->_iPurchaseOrderID,
						'tSourcingDocument'		=>	$this->_tSourcingDocument,
						'tGlobalAgreement'		=>	$this->_tGlobalAgreement,
						'tPaymentTerms'		=>	$this->_tPaymentTerms,
						'tFOB'		=>	$this->_tFOB,
						'tDeliveryTerms'		=>	$this->_tDeliveryTerms,
						'tShippingControl'		=>	$this->_tShippingControl,
						'tConditionsForPayment'		=>	$this->_tConditionsForPayment,
						'tPenalties'		=>	$this->_tPenalties,
						'tSpecialInstruction'		=>	$this->_tSpecialInstruction,
						'tNote'		=>	$this->_tNote
			);
		}
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_purchase_order_otherinformation",$Data,'insert');
		return $result;
	}


/**
*   @desc   UPDATE
*/

	function update($where)
	{

		 $Data = array(
						 'iPurchaseOrderID'		=>	$this->_iPurchaseOrderID,
						'tSourcingDocument'		=>	$this->_tSourcingDocument,
						'tGlobalAgreement'		=>	$this->_tGlobalAgreement,
						'tPaymentTerms'		=>	$this->_tPaymentTerms,
						'tFOB'		=>	$this->_tFOB,
						'tDeliveryTerms'		=>	$this->_tDeliveryTerms,
						'tShippingControl'		=>	$this->_tShippingControl,
						'tConditionsForPayment'		=>	$this->_tConditionsForPayment,
						'tPenalties'		=>	$this->_tPenalties,
						'tSpecialInstruction'		=>	$this->_tSpecialInstruction,
						'tNote'		=>	$this->_tNote
);

		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_purchase_order_otherinformation",$Data,'update',$where);
		  return $result;

	}


	function updateData($data,$where)
	{
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_purchase_order_otherinformation",$data,"update",$where);
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
       $sql =  "SELECT $feild FROM ".PRJ_DB_PREFIX."_purchase_order_otherinformation $cnt $limit";
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

      $sql =  "SELECT $fields FROM ".PRJ_DB_PREFIX."_purchase_order_otherinformation $jtbl $cnt $limit";
		$row = $this->_obj->MySQLSelect($sql);
		if($pg=="yes")
		{
			$sql_count =  "SELECT Count(*) as tot FROM ".PRJ_DB_PREFIX."_purchase_order_otherinformation $jtbl $cnt_count";
			$row_count = $this->_obj->MySqlSelect($sql_count);
			$row[tot] = $row_count[0][tot];
		}
      return $row;
	}
}
?>