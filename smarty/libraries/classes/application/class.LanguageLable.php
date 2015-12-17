<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        LanguageLable
* GENERATION DATE:  08.04.2010
* CLASS FILE:       /home/www/B2B/libraries/classes/application/class.LanguageLable.php
* FOR MYSQL TABLE:  b2b_lang_lable
* FOR MYSQL DB:     B2B
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*
*/

class LanguageLable
{


/**
*   @desc Variable Declaration with default value
*/

	protected $iLabelId;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iLabelId;
	protected $_vName;
	protected $_vValue_en;
	protected $_vValue_fr;
	protected $_dDate;
	protected $_eStatus;



/**
*   @desc   CONSTRUCTOR METHOD
*/

	function __construct()
	{
		global $dbobj;
		$this->_obj = $dbobj;

		$this->_iLabelId = null;
		$this->_vName = null;
		$this->_vValue_en = null;
		$this->_vValue_fr = null;
		$this->_dDate = null;
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


	public function getiLabelId()
	{
		return $this->_iLabelId;
	}

	public function getvName()
	{
		return $this->_vName;
	}

	public function getvValue_en()
	{
		return $this->_vValue_en;
	}

	public function getvValue_fr()
	{
		return $this->_vValue_fr;
	}

	public function getdDate()
	{
		return $this->_dDate;
	}

	public function geteStatus()
	{
		return $this->_eStatus;
	}


/**
*   @desc   SETTER METHODS
*/


	public function setiLabelId($val)
	{
		 $this->_iLabelId =  $val;
	}

	public function setvName($val)
	{
		 $this->_vName =  $val;
	}

	public function setvValue_en($val)
	{
		 $this->_vValue_en =  $val;
	}

	public function setvValue_fr($val)
	{
		 $this->_vValue_fr =  $val;
	}

	public function setdDate($val)
	{
		 $this->_dDate =  $val;
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
		 $sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_lang_lable WHERE iLabelId = $id";
		 $row =  $this->_obj->MySQLSelect($sql);

		 $this->_iLabelId = $row[0]['iLabelId'];
		 $this->_vName = $row[0]['vName'];
		 $this->_vValue_en = $row[0]['vValue_en'];
		 $this->_vValue_fr = $row[0]['vValue_fr'];
		 $this->_dDate = $row[0]['dDate'];
		 $this->_eStatus = $row[0]['eStatus'];
 return $row;
	}


/**
*   @desc   DELETE
*/

	function delete($id)
	{
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_lang_lable WHERE iLabelId = $id";
		 return $result = $this->_obj->sql_query($sql);
	}


/**
*   @desc   INSERT
*/

	function insert()
	{
		 $this->iLabelId = ""; // clear key for autoincrement

		 $Data = array(
						 'vName'		=>	$this->_vName,
						'vValue_en'		=>	$this->_vValue_en,
						'vValue_fr'		=>	$this->_vValue_fr,
						'dDate'		=>	$this->_dDate,
						'eStatus'		=>	$this->_eStatus
);
           //prints($Data);exit;
		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_lang_lable",$Data,'insert');
		  return $result;
	}


/**
*   @desc   UPDATE
*/

	function update($upd)
	{

		 $Data = array(
						 'vName'		=>	$this->_vName,
						'vValue_en'		=>	$this->_vValue_en,
						'vValue_fr'		=>	$this->_vValue_fr,
						'dDate'		=>	$this->_dDate,
						'eStatus'		=>	$this->_eStatus
);
           //prints($Data);exit;
		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_lang_lable",$Data,'update',$upd);
		  return $result;

	}

	/**
	*   @desc   SET ALL VARIABLE
	*/

	function setAllVar($Arr)
	{
		$MethodArr = get_class_methods($this);
		foreach($Arr AS $KEY => $VAL)
		{
			$method = "set".$KEY;
			if(in_array($method , $MethodArr))
			{
			  @call_user_method($method,$this,$VAL);
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
	*   @desc   GET LANGUAGE LABLE DETAILS
	*/

     function getLangLableDetail($feild='*',$where='',$OrderBy='') {
          if($where != '') {
             $cnt = " Where 1 ".$where;
          }
          if($OrderBy != '') {
             $cnt .= " Order By ".$OrderBy;
          }

		 $sql =  "SELECT $feild FROM ".PRJ_DB_PREFIX."_lang_lable $cnt";
		 $row =  $this->_obj->MySQLSelect($sql);

		 $this->_iLabelId = $row[0]['iLabelId'];
		 $this->_vName = $row[0]['vName'];
		 $this->_vValue_en = $row[0]['vValue_en'];
		 $this->_vValue_fr = $row[0]['vValue_fr'];
		 $this->_dDate = $row[0]['dDate'];
		 $this->_eStatus = $row[0]['eStatus'];

           return $row;
	}
}
?>