<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        EmailTemplate
* GENERATION DATE:  20.04.2010
* CLASS FILE:       /home/www/B2B/libraries/classes/application/class.EmailTemplate.php
* FOR MYSQL TABLE:  b2b_email_template
* FOR MYSQL DB:     B2B
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*
*/

class EmailTemplate
{


/**
*   @desc Variable Declaration with default value
*/

	protected $iFormatId;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iFormatId;
	protected $_vSub_en;
	protected $_vSub_fr;
	protected $_tBody_en;
	protected $_tBody_fr;
	protected $_vType;
	protected $_eSection;



/**
*   @desc   CONSTRUCTOR METHOD
*/

	function __construct()
	{
		global $dbobj;
		$this->_obj = $dbobj;

		$this->_iFormatId = null;
		$this->_vSub_en = null;
		$this->_vSub_fr = null;
		$this->_tBody_en = null;
		$this->_tBody_fr = null;
		$this->_vType = null;
		$this->_eSection = null;
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


	public function getiFormatId()
	{
		return $this->_iFormatId;
	}

	public function getvSub_en()
	{
		return $this->_vSub_en;
	}

	public function getvSub_fr()
	{
		return $this->_vSub_fr;
	}

	public function gettBody_en()
	{
		return $this->_tBody_en;
	}

	public function gettBody_fr()
	{
		return $this->_tBody_fr;
	}

	public function getvType()
	{
		return $this->_vType;
	}

	public function geteSection()
	{
		return $this->_eSection;
	}


/**
*   @desc   SETTER METHODS
*/


	public function setiFormatId($val)
	{
		 $this->iFormatId = $this->_iFormatId =  $val;
	}

	public function setvSub_en($val)
	{
		 $this->_vSub_en =  $val;
	}

	public function setvSub_fr($val)
	{
		 $this->_vSub_fr =  $val;
	}

	public function settBody_en($val)
	{
		 $this->_tBody_en =  $val;
	}

	public function settBody_fr($val)
	{
		 $this->_tBody_fr =  $val;
	}

	public function setvType($val)
	{
		 $this->_vType =  $val;
	}

	public function seteSection($val)
	{
		 $this->_eSection =  $val;
	}


/**
*   @desc   SELECT METHOD / LOAD
*/

	function select($id)
	{
			if(($id > 0) && (trim($id) != ''))
			{
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_email_template WHERE iFormatId = $id";
			} else {
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_email_template WHERE iFormatId=$this->_iFormatId ";
		 }
		 $row =  $this->_obj->MySQLSelect($sql);

		 $this->_iFormatId = $row[0]['iFormatId'];
		 $this->_vSub_en = $row[0]['vSub_en'];
		 $this->_vSub_fr = $row[0]['vSub_fr'];
		 $this->_tBody_en = $row[0]['tBody_en'];
		 $this->_tBody_fr = $row[0]['tBody_fr'];
		 $this->_vType = $row[0]['vType'];
		 $this->_eSection = $row[0]['eSection'];
 return $row;
	}


/**
*   @desc   DELETE
*/

	function delete($id)
	{
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_email_template WHERE iFormatId = $id";
		 return $result = $this->_obj->sql_query($sql);
	}


/**
*   @desc   INSERT
*/

	function insert()
	{
		 $this->_iFormatId = '';
		 $this->iFormatId = ""; // clear key for autoincrement

		 $Data = array(
						 'vSub_en'		=>	$this->_vSub_en,
						'vSub_fr'		=>	$this->_vSub_fr,
						'tBody_en'		=>	$this->_tBody_en,
						'tBody_fr'		=>	$this->_tBody_fr,
						'vType'		=>	$this->_vType,
						'eSection'		=>	$this->_eSection
);

		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_email_template",$Data,'insert');
		  return $result;
	}


/**
*   @desc   UPDATE
*/

	function update($where)
	{

		 $Data = array(
						 'vSub_en'		=>	$this->_vSub_en,
						'vSub_fr'		=>	$this->_vSub_fr,
						'tBody_en'		=>	$this->_tBody_en,
						'tBody_fr'		=>	$this->_tBody_fr,
						'vType'		=>	$this->_vType,
						'eSection'		=>	$this->_eSection
);

		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_email_template",$Data,'update',$where);
		  return $result;

	}


	function updateData($data,$where)
	{
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_email_template",$data,"update",$where);
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
       if($orderBy != "") {
          $cnt .= " Order By ".$orderBy;
       }
		 if($groupBy != "") {
          $cnt .= " Group By ".$groupBy;
       }
       $sql =  "SELECT $feild FROM ".PRJ_DB_PREFIX."_email_template $cnt $limit";
		 $row =  $this->_obj->MySQLSelect($sql);
       return $row;
	}
}
?>