<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        StaticPage
* GENERATION DATE:  13.04.2010
* CLASS FILE:       /home/www/B2B/libraries/classes/application/class.StaticPage.php
* FOR MYSQL TABLE:  b2b_static_pages
* FOR MYSQL DB:     B2B
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*
*/

class StaticPage
{


/**
*   @desc Variable Declaration with default value
*/

	protected $iSPageId;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iSPageId;
	protected $_vFile;
	protected $_tContent_en;
	protected $_tContent_fr;



/**
*   @desc   CONSTRUCTOR METHOD
*/

	function __construct()
	{
		global $dbobj;
		$this->_obj = $dbobj;

		$this->_iSPageId = null;
		$this->_vFile = null;
		$this->_tContent_en = null;
		$this->_tContent_fr = null;
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


	public function getiSPageId()
	{
		return $this->_iSPageId;
	}

	public function getvFile()
	{
		return $this->_vFile;
	}

	public function gettContent_en()
	{
		return $this->_tContent_en;
	}

	public function gettContent_fr()
	{
		return $this->_tContent_fr;
	}


/**
*   @desc   SETTER METHODS
*/


	public function setiSPageId($val)
	{
		 $this->_iSPageId =  $val;
	}

	public function setvFile($val)
	{
		 $this->_vFile =  $val;
	}

	public function settContent_en($val)
	{
		 $this->_tContent_en =  $val;
	}

	public function settContent_fr($val)
	{
		 $this->_tContent_fr =  $val;
	}


/**
*   @desc   SELECT METHOD / LOAD
*/

	function select($id)
	{
		 $sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_static_pages WHERE iSPageId = $id";
		 $row =  $this->_obj->MySQLSelect($sql);

		 $this->_iSPageId = $row[0]['iSPageId'];
		 $this->_vFile = $row[0]['vFile'];
		 $this->_tContent_en = $row[0]['tContent_en'];
		 $this->_tContent_fr = $row[0]['tContent_fr'];
 return $row;
	}


/**
*   @desc   DELETE
*/

	function delete($id)
	{
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_static_pages WHERE iSPageId = $id";
		 return $result = $this->_obj->sql_query($sql);
	}


/**
*   @desc   INSERT
*/

	function insert()
	{
		 $this->iSPageId = ""; // clear key for autoincrement

		 $Data = array(
						 'vFile'		=>	$this->_vFile,
						'tContent_en'		=>	$this->_tContent_en,
						'tContent_fr'		=>	$this->_tContent_fr
);
           //prints($Data);exit;
		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_static_pages",$Data,'insert');
		  return $result;
	}


/**
*   @desc   UPDATE
*/

	function update($upd)
	{

		 $Data = array(
						 'vFile'		=>	$this->_vFile,
						'tContent_en'		=>	$this->_tContent_en,
						'tContent_fr'		=>	$this->_tContent_fr
);
           //prints($Data);exit;
		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_static_pages",$Data,'update',$upd);
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
	*   @desc   GET STATIC PAGES DETAILS
	*/

     function getStaticPageDetail($feild='*',$where='',$OrderBy='') {
          if($where != '') {
             $cnt = " Where 1 ".$where;
          }
          if($OrderBy != '') {
             $cnt .= " Order By ".$OrderBy;
          }

		 $sql =  "SELECT $feild FROM ".PRJ_DB_PREFIX."_static_pages $cnt";
		 $row =  $this->_obj->MySQLSelect($sql);

		 $this->_iSPageId = $row[0]['iSPageId'];
		 $this->_vFile = $row[0]['vFile'];
		 $this->_tContent_en = $row[0]['tContent_en'];
		 $this->_tContent_fr = $row[0]['tContent_fr'];

           return $row;
	}
}
?>