<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        Country
* GENERATION DATE:  20.03.2010
* CLASS FILE:       /home/www/B2B/libraries/classes/application/class.Country.php
* FOR MYSQL TABLE:  b2b_country_master
* FOR MYSQL DB:     B2B
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*
*/

class Country {


/**
*   @desc Variable Declaration with default value
*/

	protected $iCountryId;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iCountryId;
	protected $_vCountry;
	protected $_vCountryCode;
   protected $_iCountryISD;
   protected $_iCurrencyID;
	protected $_vCountryCodeISO_3;
	protected $_fVat;
	protected $_fOtherTax;
	protected $_fwhTax;
	protected $_vDescription;
	protected $_eStatus;



/**
*   @desc   CONSTRUCTOR METHOD
*/

	function __construct() {
		global $dbobj;
		$this->_obj = $dbobj;

		$this->_iCountryId = null;
		$this->_vCountry = null;
		$this->_vCountryCode = null;
		$this->_iCountryISD = null;
		$this->_iCurrencyID = null;
		$this->_vCountryCodeISO_3 = null;
		$this->_fVat = null;
		$this->_fOtherTax = null;
		$this->_fwhTax = null;
		$this->_vDescription = null;
		$this->_eStatus = null;
	}

/**
*   @desc   DECONSTRUCTOR METHOD
*/

	function __destruct() {
		unset($this->_dbobj);
	}



/**
*   @desc   GETTER METHODS
*/


	public function getiCountryId() {
		return $this->_iCountryId;
	}

	public function getvCountry() {
		return $this->_vCountry;
	}

	public function getvCountryCode() {
		return $this->_vCountryCode;
	}

     public function getiCountryISD() {
		return $this->_iCountryISD;
	}

     public function getiCurrencyID() {
		return $this->_iCurrencyID;
	}

	public function getvCountryCodeISO_3() {
		return $this->_vCountryCodeISO_3;
	}

	public function getvDescription() {
		return $this->_vDescription;
	}

	public function getfVat() {
		return $this->_fVat;
	}

	public function getfOtherTax() {
		return $this->_fOtherTax;
	}

	public function getfwhTax() {
		return $this->_fwhTax;
	}

	public function geteStatus() {
		return $this->_eStatus;
	}


/**
*   @desc   SETTER METHODS
*/


	public function setiCountryId($val) {
		 $this->_iCountryId =  $val;
	}

	public function setvCountry($val) {
		 $this->_vCountry =  $val;
	}

	public function setvCountryCode($val) {
		 $this->_vCountryCode =  $val;
	}

     public function setiCountryISD($val) {
		 $this->_iCountryISD =  $val;
	}

	public function setiCurrencyID($val) {
		 $this->_iCurrencyID = $val;
	}

	public function setvCountryCodeISO_3($val) {
		 $this->_vCountryCodeISO_3 =  $val;
	}

	public function setfVat($val) {
		$this->_fVat = $val;
	}

	public function setfOtherTax($val) {
		$this->_fOtherTax = $val;
	}

	public function setfwhTax($val) {
		$this->_fwhTax = $val;
	}

	public function setvDescription($val) {
		 $this->_vDescription =  $val;
	}

	public function seteStatus($val) {
		 $this->_eStatus =  $val;
	}


/**
*   @desc   SELECT METHOD / LOAD
*/

	function select($id) {
		 $sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_country_master WHERE iCountryId = $id";
		 $row =  $this->_obj->MySQLSelect($sql);

		 $this->_iCountryId = $row[0]['iCountryId'];
		 $this->_vCountry = $row[0]['vCountry'];
		 $this->_vCountryCode = $row[0]['vCountryCode'];
		 $this->_iCountryISD = $row[0]['iCountryISD'];
		 $this->_iCurrencyID = $row[0]['iCurrencyID'];
		 $this->_vCountryCodeISO_3 = $row[0]['vCountryCodeISO_3'];
		 $this->_fVat = $row[0]['fVat'];
		 $this->_fOtherTax = $row[0]['fOtherTax'];
		 $this->_fwhTax = $row[0]['fwhTax'];
		 $this->_vDescription = $row[0]['vDescription'];
		 $this->_eStatus = $row[0]['eStatus'];

           return $row;
	}


/**
*   @desc   DELETE
*/

	function delete($id) {
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_country_master WHERE iCountryId = $id";
		 return $result = $this->_obj->sql_query($sql);
	}


/**
*   @desc   INSERT
*/

	function insert() {
		 $this->iCountryId = ""; // clear key for autoincrement

		 $Data = array(
						'vCountry'				=>	$this->_vCountry,
						'vCountryCode'			=>	$this->_vCountryCode,
						'iCountryISD'			=>	$this->_iCountryISD,
						'iCurrencyID'			=>	$this->_iCurrencyID,
						'vCountryCodeISO_3'	=>	$this->_vCountryCodeISO_3,
						'fVat'					=>	$this->_fVat,
						'fOtherTax'				=>	$this->_fOtherTax,
						'fwhTax'					=>	$this->_fwhTax,
						'vDescription'			=>	$this->_vDescription,
						'eStatus'				=>	$this->_eStatus
                        );
           //prints($Data);exit;
		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_country_master",$Data,'insert');
		 return $result;
	}


/**
*   @desc   UPDATE
*/

	function update($upd)
	{
		 $Data = array(
						'vCountry'				=>	$this->_vCountry,
						'vCountryCode'			=>	$this->_vCountryCode,
						'iCountryISD'			=>	$this->_iCountryISD,
						'iCurrencyID'			=>	$this->_iCurrencyID,
						'vCountryCodeISO_3'	=>	$this->_vCountryCodeISO_3,
						'fVat'					=>	$this->_fVat,
						'fOtherTax'				=>	$this->_fOtherTax,
						'fwhTax'					=>	$this->_fwhTax,
						'vDescription'			=>	$this->_vDescription,
						'eStatus'				=>	$this->_eStatus
   		);
		//prints($Data);exit;
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_country_master",$Data,'update',$upd);
		return $result;
	}

	function getDetails($field='*',$where='',$orderBy='',$groupBy='',$limit='')
	{
       if($where != '') {
          $cnt = " Where 1 ".$where;
       }
		 if($groupBy != '') {
          $cnt .= " Group By ".$groupBy;
       }
		 if($orderBy != '') {
          $cnt .= " Order By ".$orderBy;
       }
       $sql =  "SELECT $field FROM ".PRJ_DB_PREFIX."_country_master $cnt $limit";
        //echo $sql;//exit;
		 $row =  $this->_obj->MySQLSelect($sql);
       return $row;
	}

	/**
	*   @desc   SET ALL VARIABLE
	*/

	function setAllVar($Arr) {
		$MethodArr = get_class_methods($this);
		foreach($Arr AS $KEY => $VAL) {
			$method = "set".$KEY;
			if(in_array($method , $MethodArr)) {
			  @call_user_method($method,$this,$VAL);
			}
		}
	}

	/**
	*   @desc   GET ALL VARIABLE
	*/

	function getAllVar() {
		$MethodArr = get_class_methods($this);
		$method_notArr=Array('getAllVar');
		$evalStr='';
		for($i=0;$i<count($MethodArr);$i++) {
			if(substr($MethodArr[$i] , 0 ,3) == 'get' && (!(in_array($MethodArr[$i],$method_notArr)))) {
				$var_name = substr($MethodArr[$i] , 3 );
				$evalStr.= 'global $'.$var_name.'; $'.$var_name.' = $this->'.$MethodArr[$i]."();";
			}
		}
		eval($evalStr);
	}

   /**
	*   @desc   GET COUNTRY DETAILS
	*/
   function getCountryDetail($feild='*',$where='',$OrderBy='')
	{
		if($where != '') {
			$cnt = " Where 1 ".$where;
		}
		if($OrderBy != '') {
			$cnt .= " Order By ".$OrderBy;
		}

		$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_country_master $cnt";
		$row =  $this->_obj->MySQLSelect($sql);

      $this->_iCountryId = $row[0]['iCountryId'];
		$this->_vCountry = $row[0]['vCountry'];
		$this->_vCountryCode = $row[0]['vCountryCode'];
      $this->_iCountryISD = $row[0]['iCountryISD'];
		$this->_iCurrencyID = $row[0]['iCurrencyID'];
		$this->_vCountryCodeISO_3 = $row[0]['vCountryCodeISO_3'];
		$this->_vDescription = $row[0]['vDescription'];
		$this->_fVat 			= $row[0]['fVat'];
		$this->_fOtherTax 	= $row[0]['fOtherTax'];
		$this->_fwhTax 		= $row[0]['fwhTax'];
		$this->_eStatus 		= $row[0]['eStatus'];

      return $row;
	}
}
?>