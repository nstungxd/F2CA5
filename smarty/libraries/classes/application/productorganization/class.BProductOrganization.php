<?php
/*
* -------------------------------------------------------
* CLASSNAME:        BProductOrganization
* GENERATION DATE:  25.01.2011
* CLASS FILE:       D:\wamp\www\new\B2B/libraries/classes/application/class.BProductOrganization.php
* FOR MYSQL TABLE:  b2b_bproduct_organization
* FOR MYSQL DB:     B2B
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*/

class BProductOrganization
{

/**
*   @desc Variable Declaration with default value
*/

	protected $iProductId;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iProductId;
	protected $_vProductCode;
	protected $_vProductName;
	protected $_tDescription;
	protected $_vCurrency;
	protected $_fDefaultSchemeFeePc;
	protected $_fDefaultSchemeFeeFlat;
	protected $_iBankId;
	protected $_vBankAccount;
	protected $_eAvailability;



/**
*   @desc   CONSTRUCTOR METHOD
*/

	function __construct()
	{
		global $dbobj;
		$this->_obj = $dbobj;

		$this->_iProductId = null;
		$this->_vProductCode = null;
		$this->_vProductName = null;
		$this->_tDescription = null;
		$this->_vCurrency = null;
		$this->_fDefaultSchemeFeePc = null;
		$this->_fDefaultSchemeFeeFlat = null;
		$this->_iBankId = null;
		$this->_vBankAccount = null;
		$this->_eAvailability = null;
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


	public function getiProductId()
	{
		return $this->_iProductId;
	}

	public function getvProductCode()
	{
		return $this->_vProductCode;
	}

	public function getvProductName()
	{
		return $this->_vProductName;
	}

	public function gettDescription()
	{
		return $this->_tDescription;
	}

	public function getvCurrency()
	{
		return $this->_vCurrency;
	}

	public function getfDefaultSchemeFeePc()
	{
		return $this->_fDefaultSchemeFeePc;
	}

	public function getfDefaultSchemeFeeFlat()
	{
		return $this->_fDefaultSchemeFeeFlat;
	}

	public function getiBankId()
	{
		return $this->_iBankId;
	}

	public function getvBankAccount()
	{
		return $this->_vBankAccount;
	}

	public function geteAvailability()
	{
		return $this->_eAvailability;
	}


/**
*   @desc   SETTER METHODS
*/


	public function setiProductId($val)
	{
		 $this->_iProductId =  $val;
	}

	public function setvProductCode($val)
	{
		 $this->_vProductCode =  $val;
	}

	public function setvProductName($val)
	{
		 $this->_vProductName =  $val;
	}

	public function settDescription($val)
	{
		 $this->_tDescription =  $val;
	}

	public function setvCurrency($val)
	{
		 $this->_vCurrency =  $val;
	}

	public function setfDefaultSchemeFeePc($val)
	{
		 $this->_fDefaultSchemeFeePc =  $val;
	}

	public function setfDefaultSchemeFeeFlat($val)
	{
		 $this->_fDefaultSchemeFeeFlat =  $val;
	}

	public function setiBankId($val)
	{
		 $this->_iBankId =  $val;
	}

	public function setvBankAccount($val)
	{
		 $this->_vBankAccount =  $val;
	}

	public function seteAvailability($val)
	{
		 $this->_eAvailability =  $val;
	}


/**
*   @desc   SELECT METHOD / LOAD
*/

	function select($id)
	{
			if(($id > 0) && (trim($id) != ''))
			{
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_bproduct_organization WHERE iProductId = $id";
			} else {
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_bproduct_organization WHERE iProductId=$this->_iProductId ";
		 }
		 $row =  $this->_obj->MySQLSelect($sql);

		 $this->_iProductId = $row[0]['iProductId'];
		 $this->_vProductCode = $row[0]['vProductCode'];
		 $this->_vProductName = $row[0]['vProductName'];
		 $this->_tDescription = $row[0]['tDescription'];
		 $this->_vCurrency = $row[0]['vCurrency'];
		 $this->_fDefaultSchemeFeePc = $row[0]['fDefaultSchemeFeePc'];
		 $this->_fDefaultSchemeFeeFlat = $row[0]['fDefaultSchemeFeeFlat'];
		 $this->_iBankId = $row[0]['iBankId'];
		 $this->_vBankAccount = $row[0]['vBankAccount'];
		 $this->_eAvailability = $row[0]['eAvailability'];
 return $row;
	}


/**
*   @desc   DELETE
*/

	function delete($id)
	{
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_bproduct_organization WHERE iProductId = $id";
		 return $result = $this->_obj->sql_query($sql);
	}


/**
*   @desc   INSERT
*/

	function insert()
	{
		 $this->_iProductId = '';
		 $this->iProductId = ""; // clear key for autoincrement

		 $Data = array(
						 'vProductCode'		=>	$this->_vProductCode,
						'vProductName'		=>	$this->_vProductName,
						'tDescription'		=>	$this->_tDescription,
						'vCurrency'		=>	$this->_vCurrency,
						'fDefaultSchemeFeePc'		=>	$this->_fDefaultSchemeFeePc,
						'fDefaultSchemeFeeFlat'		=>	$this->_fDefaultSchemeFeeFlat,
						'iBankId'		=>	$this->_iBankId,
						'vBankAccount'		=>	$this->_vBankAccount,
						'eAvailability'		=>	$this->_eAvailability
);

		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_bproduct_organization",$Data,'insert');
		  return $result;
	}


/**
*   @desc   UPDATE
*/

	function update($where)
	{

		 $Data = array(
						 'vProductCode'		=>	$this->_vProductCode,
						'vProductName'		=>	$this->_vProductName,
						'tDescription'		=>	$this->_tDescription,
						'vCurrency'		=>	$this->_vCurrency,
						'fDefaultSchemeFeePc'		=>	$this->_fDefaultSchemeFeePc,
						'fDefaultSchemeFeeFlat'		=>	$this->_fDefaultSchemeFeeFlat,
						'iBankId'		=>	$this->_iBankId,
						'vBankAccount'		=>	$this->_vBankAccount,
						'eAvailability'		=>	$this->_eAvailability
);

		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_bproduct_organization",$Data,'update',$where);
		  return $result;

	}


	function updateData($data,$where)
	{
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_bproduct_organization",$data,"update",$where);
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
       $sql =  "SELECT $feild FROM ".PRJ_DB_PREFIX."_bproduct_organization bpo $cnt $limit";
       // echo $sql; exit;
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

      $sql =  "SELECT $fields FROM ".PRJ_DB_PREFIX."_bproduct_organization bpo $jtbl $cnt $limit";
		$row = $this->_obj->MySQLSelect($sql);
		if($pg=="yes")
		{
			$sql_count =  "SELECT Count(*) as tot FROM ".PRJ_DB_PREFIX."_bproduct_organization bpo $jtbl $cnt_count";
			$row_count = $this->_obj->MySqlSelect($sql_count);
			$row[tot] = $row_count[0][tot];
		}
      return $row;
	}
}
?>