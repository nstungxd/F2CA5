<?php
/*
* -------------------------------------------------------
* CLASSNAME:        BankMaster
* GENERATION DATE:  29.01.2011
* CLASS FILE:       D:\wamp\www\new\B2B/libraries/classes/application/class.BankMaster.php
* FOR MYSQL TABLE:  b2b_bank_master
* FOR MYSQL DB:     b2b_new
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*/

class BankMaster
{

/**
*   @desc Variable Declaration with default value
*/

	protected $iBankId;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iBankId;  
	protected $_vBankName;  
	protected $_vAddressLine1;  
	protected $_vAddressLine2;  
	protected $_vAddressLine3;  
	protected $_vCountry;  
	protected $_vState;  
	protected $_vCity;  
	protected $_vZipcode;  
	protected $_vPhone;  
	protected $_vEmail;  
	protected $_vSwiftCode;  
	protected $_vRoutingCode1;  
	protected $_vRoutingCode2;  
	protected $_vRoutingCode3;  
	protected $_iScheme;  
	protected $_vIBAN;  
	protected $_vCurrency1;  
	protected $_vCurrency2;  
	protected $_vSettlement1;  
	protected $_vSettlement2;  
	protected $_vFee1;  
	protected $_vFee2;  
	protected $_dAddedDate;  
	protected $_vFromIP;  
	protected $_dModifiedDate;  
	protected $_eStatus;  



/**
*   @desc   CONSTRUCTOR METHOD
*/

	function __construct()
	{
		global $dbobj;
		$this->_obj = $dbobj;

		$this->_iBankId = null; 
		$this->_vBankName = null; 
		$this->_vAddressLine1 = null; 
		$this->_vAddressLine2 = null; 
		$this->_vAddressLine3 = null; 
		$this->_vCountry = null; 
		$this->_vState = null; 
		$this->_vCity = null; 
		$this->_vZipcode = null; 
		$this->_vPhone = null; 
		$this->_vEmail = null; 
		$this->_vSwiftCode = null; 
		$this->_vRoutingCode1 = null; 
		$this->_vRoutingCode2 = null; 
		$this->_vRoutingCode3 = null; 
		$this->_iScheme = null; 
		$this->_vIBAN = null; 
		$this->_vCurrency1 = null; 
		$this->_vCurrency2 = null; 
		$this->_vSettlement1 = null; 
		$this->_vSettlement2 = null; 
		$this->_vFee1 = null; 
		$this->_vFee2 = null; 
		$this->_dAddedDate = null; 
		$this->_vFromIP = null; 
		$this->_dModifiedDate = null; 
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


	public function getiBankId()
	{
		return $this->_iBankId;
	}

	public function getvBankName()
	{
		return $this->_vBankName;
	}

	public function getvAddressLine1()
	{
		return $this->_vAddressLine1;
	}

	public function getvAddressLine2()
	{
		return $this->_vAddressLine2;
	}

	public function getvAddressLine3()
	{
		return $this->_vAddressLine3;
	}

	public function getvCountry()
	{
		return $this->_vCountry;
	}

	public function getvState()
	{
		return $this->_vState;
	}

	public function getvCity()
	{
		return $this->_vCity;
	}

	public function getvZipcode()
	{
		return $this->_vZipcode;
	}

	public function getvPhone()
	{
		return $this->_vPhone;
	}

	public function getvEmail()
	{
		return $this->_vEmail;
	}

	public function getvSwiftCode()
	{
		return $this->_vSwiftCode;
	}

	public function getvRoutingCode1()
	{
		return $this->_vRoutingCode1;
	}

	public function getvRoutingCode2()
	{
		return $this->_vRoutingCode2;
	}

	public function getvRoutingCode3()
	{
		return $this->_vRoutingCode3;
	}

	public function getiScheme()
	{
		return $this->_iScheme;
	}

	public function getvIBAN()
	{
		return $this->_vIBAN;
	}

	public function getvCurrency1()
	{
		return $this->_vCurrency1;
	}

	public function getvCurrency2()
	{
		return $this->_vCurrency2;
	}

	public function getvSettlement1()
	{
		return $this->_vSettlement1;
	}

	public function getvSettlement2()
	{
		return $this->_vSettlement2;
	}

	public function getvFee1()
	{
		return $this->_vFee1;
	}

	public function getvFee2()
	{
		return $this->_vFee2;
	}

	public function getdAddedDate()
	{
		return $this->_dAddedDate;
	}

	public function getvFromIP()
	{
		return $this->_vFromIP;
	}

	public function getdModifiedDate()
	{
		return $this->_dModifiedDate;
	}

	public function geteStatus()
	{
		return $this->_eStatus;
	}


/**
*   @desc   SETTER METHODS
*/


	public function setiBankId($val)
	{
		 $this->_iBankId =  $val;
	}

	public function setvBankName($val)
	{
		 $this->_vBankName =  $val;
	}

	public function setvAddressLine1($val)
	{
		 $this->_vAddressLine1 =  $val;
	}

	public function setvAddressLine2($val)
	{
		 $this->_vAddressLine2 =  $val;
	}

	public function setvAddressLine3($val)
	{
		 $this->_vAddressLine3 =  $val;
	}

	public function setvCountry($val)
	{
		 $this->_vCountry =  $val;
	}

	public function setvState($val)
	{
		 $this->_vState =  $val;
	}

	public function setvCity($val)
	{
		 $this->_vCity =  $val;
	}

	public function setvZipcode($val)
	{
		 $this->_vZipcode =  $val;
	}

	public function setvPhone($val)
	{
		 $this->_vPhone =  $val;
	}

	public function setvEmail($val)
	{
		 $this->_vEmail =  $val;
	}

	public function setvSwiftCode($val)
	{
		 $this->_vSwiftCode =  $val;
	}

	public function setvRoutingCode1($val)
	{
		 $this->_vRoutingCode1 =  $val;
	}

	public function setvRoutingCode2($val)
	{
		 $this->_vRoutingCode2 =  $val;
	}

	public function setvRoutingCode3($val)
	{
		 $this->_vRoutingCode3 =  $val;
	}

	public function setiScheme($val)
	{
		 $this->_iScheme =  $val;
	}

	public function setvIBAN($val)
	{
		 $this->_vIBAN =  $val;
	}

	public function setvCurrency1($val)
	{
		 $this->_vCurrency1 =  $val;
	}

	public function setvCurrency2($val)
	{
		 $this->_vCurrency2 =  $val;
	}

	public function setvSettlement1($val)
	{
		 $this->_vSettlement1 =  $val;
	}

	public function setvSettlement2($val)
	{
		 $this->_vSettlement2 =  $val;
	}

	public function setvFee1($val)
	{
		 $this->_vFee1 =  $val;
	}

	public function setvFee2($val)
	{
		 $this->_vFee2 =  $val;
	}

	public function setdAddedDate($val)
	{
		 $this->_dAddedDate =  $val;
	}

	public function setvFromIP($val)
	{
		 $this->_vFromIP =  $val;
	}

	public function setdModifiedDate($val)
	{
		 $this->_dModifiedDate =  $val;
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
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_bank_master WHERE iBankId = $id";
			} else {
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_bank_master WHERE iBankId=$this->_iBankId ";
		 }
		 $row =  $this->_obj->MySQLSelect($sql); 

		 $this->_iBankId = $row[0]['iBankId'];
		 $this->_vBankName = $row[0]['vBankName'];
		 $this->_vAddressLine1 = $row[0]['vAddressLine1'];
		 $this->_vAddressLine2 = $row[0]['vAddressLine2'];
		 $this->_vAddressLine3 = $row[0]['vAddressLine3'];
		 $this->_vCountry = $row[0]['vCountry'];
		 $this->_vState = $row[0]['vState'];
		 $this->_vCity = $row[0]['vCity'];
		 $this->_vZipcode = $row[0]['vZipcode'];
		 $this->_vPhone = $row[0]['vPhone'];
		 $this->_vEmail = $row[0]['vEmail'];
		 $this->_vSwiftCode = $row[0]['vSwiftCode'];
		 $this->_vRoutingCode1 = $row[0]['vRoutingCode1'];
		 $this->_vRoutingCode2 = $row[0]['vRoutingCode2'];
		 $this->_vRoutingCode3 = $row[0]['vRoutingCode3'];
		 $this->_iScheme = $row[0]['iScheme'];
		 $this->_vIBAN = $row[0]['vIBAN'];
		 $this->_vCurrency1 = $row[0]['vCurrency1'];
		 $this->_vCurrency2 = $row[0]['vCurrency2'];
		 $this->_vSettlement1 = $row[0]['vSettlement1'];
		 $this->_vSettlement2 = $row[0]['vSettlement2'];
		 $this->_vFee1 = $row[0]['vFee1'];
		 $this->_vFee2 = $row[0]['vFee2'];
		 $this->_dAddedDate = $row[0]['dAddedDate'];
		 $this->_vFromIP = $row[0]['vFromIP'];
		 $this->_dModifiedDate = $row[0]['dModifiedDate'];
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
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_bank_master WHERE iBankId = $id";
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
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_bank_master WHERE $where";
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
		$this->_iBankId = '';
		$this->iBankId = ""; // clear key for autoincrement
		
		if(!is_array($Data) || count($Data)<1) {
				$Data = array(
						'vBankName'		=>	$this->_vBankName,
						'vAddressLine1'		=>	$this->_vAddressLine1,
						'vAddressLine2'		=>	$this->_vAddressLine2,
						'vAddressLine3'		=>	$this->_vAddressLine3,
						'vCountry'		=>	$this->_vCountry,
						'vState'		=>	$this->_vState,
						'vCity'		=>	$this->_vCity,
						'vZipcode'		=>	$this->_vZipcode,
						'vPhone'		=>	$this->_vPhone,
						'vEmail'		=>	$this->_vEmail,
						'vSwiftCode'		=>	$this->_vSwiftCode,
						'vRoutingCode1'		=>	$this->_vRoutingCode1,
						'vRoutingCode2'		=>	$this->_vRoutingCode2,
						'vRoutingCode3'		=>	$this->_vRoutingCode3,
						'iScheme'		=>	$this->_iScheme,
						'vIBAN'		=>	$this->_vIBAN,
						'vCurrency1'		=>	$this->_vCurrency1,
						'vCurrency2'		=>	$this->_vCurrency2,
						'vSettlement1'		=>	$this->_vSettlement1,
						'vSettlement2'		=>	$this->_vSettlement2,
						'vFee1'		=>	$this->_vFee1,
						'vFee2'		=>	$this->_vFee2,
						'dAddedDate'		=>	$this->_dAddedDate,
						'vFromIP'		=>	$this->_vFromIP,
						'dModifiedDate'		=>	$this->_dModifiedDate,
						'eStatus'		=>	$this->_eStatus 				
			);
		}
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_bank_master",$Data,'insert');
		return $result;	
	}


/**
*   @desc   UPDATE
*/

	function update($where)
	{

			$Data = array(
						 'vBankName'		=>	$this->_vBankName,
						'vAddressLine1'		=>	$this->_vAddressLine1,
						'vAddressLine2'		=>	$this->_vAddressLine2,
						'vAddressLine3'		=>	$this->_vAddressLine3,
						'vCountry'		=>	$this->_vCountry,
						'vState'		=>	$this->_vState,
						'vCity'		=>	$this->_vCity,
						'vZipcode'		=>	$this->_vZipcode,
						'vPhone'		=>	$this->_vPhone,
						'vEmail'		=>	$this->_vEmail,
						'vSwiftCode'		=>	$this->_vSwiftCode,
						'vRoutingCode1'		=>	$this->_vRoutingCode1,
						'vRoutingCode2'		=>	$this->_vRoutingCode2,
						'vRoutingCode3'		=>	$this->_vRoutingCode3,
						'iScheme'		=>	$this->_iScheme,
						'vIBAN'		=>	$this->_vIBAN,
						'vCurrency1'		=>	$this->_vCurrency1,
						'vCurrency2'		=>	$this->_vCurrency2,
						'vSettlement1'		=>	$this->_vSettlement1,
						'vSettlement2'		=>	$this->_vSettlement2,
						'vFee1'		=>	$this->_vFee1,
						'vFee2'		=>	$this->_vFee2,
						'dAddedDate'		=>	$this->_dAddedDate,
						'vFromIP'		=>	$this->_vFromIP,
						'dModifiedDate'		=>	$this->_dModifiedDate,
						'eStatus'		=>	$this->_eStatus 				
			);
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_bank_master",$Data,'update',$where);
		return $result;	
	}


	function updateData($data,$where)
	{
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_bank_master",$data,"update",$where);
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
       $sql =  "SELECT $feild FROM ".PRJ_DB_PREFIX."_bank_master $cnt $limit";
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

      $sql =  "SELECT $fields FROM ".PRJ_DB_PREFIX."_bank_master $jtbl $cnt $limit";
		$row = $this->_obj->MySQLSelect($sql);
		if($pg=="yes")
		{
			$sql_count =  "SELECT Count(*) as tot FROM ".PRJ_DB_PREFIX."_bank_master $jtbl $cnt_count";
			$row_count = $this->_obj->MySqlSelect($sql_count);
			$row[tot] = $row_count[0][tot];
		}
      return $row;
	}
}
?>