<?php
/*
* -------------------------------------------------------
* CLASSNAME:        Rfq2ProductBuyer2
* GENERATION DATE:  24.03.2011
* CLASS FILE:       /home/design/design/www/B2B/libraries/classes/application/class.Rfq2ProductBuyer2.php
* FOR MYSQL TABLE:  b2b_rfq2_product_buyer2
* FOR MYSQL DB:     B2B
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*/

class Rfq2ProductBuyer2
{

/**
*   @desc Variable Declaration with default value
*/

	protected $iRfq2ProductB2Id;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iRfq2ProductB2Id;  
	protected $_iRFQ2Id;  
	protected $_iProductId;  
	protected $_iBuyer2Id;  
	protected $_iAssociationId;  
	protected $_ePType;  
	protected $_dADate;  



/**
*   @desc   CONSTRUCTOR METHOD
*/

	function __construct()
	{
		global $dbobj;
		$this->_obj = $dbobj;

		$this->_iRfq2ProductB2Id = null; 
		$this->_iRFQ2Id = null; 
		$this->_iProductId = null; 
		$this->_iBuyer2Id = null; 
		$this->_iAssociationId = null; 
		$this->_ePType = null; 
		$this->_dADate = null; 
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


	public function getiRfq2ProductB2Id()
	{
		return $this->_iRfq2ProductB2Id;
	}

	public function getiRFQ2Id()
	{
		return $this->_iRFQ2Id;
	}

	public function getiProductId()
	{
		return $this->_iProductId;
	}

	public function getiBuyer2Id()
	{
		return $this->_iBuyer2Id;
	}

	public function getiAssociationId()
	{
		return $this->_iAssociationId;
	}

	public function getePType()
	{
		return $this->_ePType;
	}

	public function getdADate()
	{
		return $this->_dADate;
	}


/**
*   @desc   SETTER METHODS
*/


	public function setiRfq2ProductB2Id($val)
	{
		 $this->_iRfq2ProductB2Id =  $val;
	}

	public function setiRFQ2Id($val)
	{
		 $this->_iRFQ2Id =  $val;
	}

	public function setiProductId($val)
	{
		 $this->_iProductId =  $val;
	}

	public function setiBuyer2Id($val)
	{
		 $this->_iBuyer2Id =  $val;
	}

	public function setiAssociationId($val)
	{
		 $this->_iAssociationId =  $val;
	}

	public function setePType($val)
	{
		 $this->_ePType =  $val;
	}

	public function setdADate($val)
	{
		 $this->_dADate =  $val;
	}


/**
*   @desc   SELECT METHOD / LOAD
*/

	function select($id)
	{
			if(($id > 0) && (trim($id) != ''))
			{
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_rfq2_product_buyer2 WHERE iRfq2ProductB2Id = $id";
			} else {
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_rfq2_product_buyer2 WHERE iRfq2ProductB2Id=$this->_iRfq2ProductB2Id ";
		 }
		 $row =  $this->_obj->MySQLSelect($sql); 

		 $this->_iRfq2ProductB2Id = $row[0]['iRfq2ProductB2Id'];
		 $this->_iRFQ2Id = $row[0]['iRFQ2Id'];
		 $this->_iProductId = $row[0]['iProductId'];
		 $this->_iBuyer2Id = $row[0]['iBuyer2Id'];
		 $this->_iAssociationId = $row[0]['iAssociationId'];
		 $this->_ePType = $row[0]['ePType'];
		 $this->_dADate = $row[0]['dADate'];
 return $row;	
	}

/**
*   @desc   DELETE
*/
	function delete($id)
	{
		 if(trim($id)!='' && $id>0)
		 {
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_rfq2_product_buyer2 WHERE iRfq2ProductB2Id = $id";
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
			$sql = "DELETE FROM ".PRJ_DB_PREFIX."_rfq2_product_buyer2 WHERE $where";
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
		$this->_iRfq2ProductB2Id = '';
		$this->iRfq2ProductB2Id = ""; // clear key for autoincrement
		if(!is_array($Data) || count($Data)<1) {
			$Data = array(
						'iRFQ2Id'		=>	$this->_iRFQ2Id,
						'iProductId'		=>	$this->_iProductId,
						'iBuyer2Id'		=>	$this->_iBuyer2Id,
						'iAssociationId'		=>	$this->_iAssociationId,
						'ePType'		=>	$this->_ePType,
						'dADate'		=>	$this->_dADate
					);
			}
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_rfq2_product_buyer2",$Data,'insert');
		return $result;	
	}


/**
*   @desc   UPDATE
*/

	function update($where)
	{

		 $Data = array(
						 'iRFQ2Id'		=>	$this->_iRFQ2Id,
						'iProductId'		=>	$this->_iProductId,
						'iBuyer2Id'		=>	$this->_iBuyer2Id,
						'iAssociationId'		=>	$this->_iAssociationId,
						'ePType'		=>	$this->_ePType,
						'dADate'		=>	$this->_dADate 				
);

		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_rfq2_product_buyer2",$Data,'update',$where);
		  return $result;	

	}


	function updateData($data,$where)
	{
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_rfq2_product_buyer2",$data,"update",$where);
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
      $sql = "SELECT $feild FROM ".PRJ_DB_PREFIX."_rfq2_product_buyer2 rpb2 $cnt $limit";
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

      $sql =  "SELECT $fields FROM ".PRJ_DB_PREFIX."_rfq2_product_buyer2 rpb2 $jtbl $cnt $limit";
		$row = $this->_obj->MySQLSelect($sql);
		if($pg=="yes")
		{
			$sql_count =  "SELECT Count(*) as tot FROM ".PRJ_DB_PREFIX."_rfq2_product_buyer2 rpb2 $jtbl $cnt_count";
			$row_count = $this->_obj->MySQLSelect($sql_count);
			$row['tot'] = $row_count[0]['tot'];
		}
      return $row;
	}
}
?>