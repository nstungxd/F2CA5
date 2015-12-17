<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        SecQuestion
* GENERATION DATE:  29.04.2010
* CLASS FILE:       /home/www/B2B/libraries/classes/application/class.SecQuestion.php
* FOR MYSQL TABLE:  b2b_sec_question
* FOR MYSQL DB:     B2B
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*
*/

class SecQuestion
{


/**
*   @desc Variable Declaration with default value
*/

	protected $iQuestionId;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iQuestionId;
	protected $_vQuestion_en;
	protected $_vQuestion_gr;
	protected $_vQuestion_fr;
	protected $_eStatus;



/**
*   @desc   CONSTRUCTOR METHOD
*/

	function __construct()
	{
		global $dbobj;
		$this->_obj = $dbobj;

		$this->_iQuestionId = null;
		$this->_vQuestion_en = null;
		$this->_vQuestion_gr = null;
		$this->_vQuestion_fr = null;
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


	public function getiQuestionId()
	{
		return $this->_iQuestionId;
	}

	public function getvQuestion_en()
	{
		return $this->_vQuestion_en;
	}

	public function getvQuestion_gr()
	{
		return $this->_vQuestion_gr;
	}

	public function getvQuestion_fr()
	{
		return $this->_vQuestion_fr;
	}

	public function geteStatus()
	{
		return $this->_eStatus;
	}


/**
*   @desc   SETTER METHODS
*/


	public function setiQuestionId($val)
	{
		 $this->_iQuestionId =  $val;
	}

	public function setvQuestion_en($val)
	{
		 $this->_vQuestion_en =  $val;
	}

	public function setvQuestion_gr($val)
	{
		 $this->_vQuestion_gr =  $val;
	}

	public function setvQuestion_fr($val)
	{
		 $this->_vQuestion_fr =  $val;
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
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_sec_question WHERE iQuestionId = $id";
			} else {
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_sec_question WHERE iQuestionId=$this->_iQuestionId ";
		 }
		 $row =  $this->_obj->MySQLSelect($sql);

		 $this->_iQuestionId = $row[0]['iQuestionId'];
		 $this->_vQuestion_en = $row[0]['vQuestion_en'];
		 $this->_vQuestion_gr = $row[0]['vQuestion_gr'];
		 $this->_vQuestion_fr = $row[0]['vQuestion_fr'];
		 $this->_eStatus = $row[0]['eStatus'];
 return $row;
	}


/**
*   @desc   DELETE
*/

	function delete($id)
	{
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_sec_question WHERE iQuestionId = $id";
		 return $result = $this->_obj->sql_query($sql);
	}


/**
*   @desc   INSERT
*/

	function insert()
	{
		 $this->_iQuestionId = '';
		 $this->iQuestionId = ""; // clear key for autoincrement

		 $Data = array(
						 'vQuestion_en'		=>	$this->_vQuestion_en,
						'vQuestion_gr'		=>	$this->_vQuestion_gr,
						'vQuestion_fr'		=>	$this->_vQuestion_fr,
						'eStatus'		=>	$this->_eStatus
);

		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_sec_question",$Data,'insert');
		  return $result;
	}


/**
*   @desc   UPDATE
*/

	function update($where)
	{

		 $Data = array(
						 'vQuestion_en'		=>	$this->_vQuestion_en,
						'vQuestion_gr'		=>	$this->_vQuestion_gr,
						'vQuestion_fr'		=>	$this->_vQuestion_fr,
						'eStatus'		=>	$this->_eStatus
);

		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_sec_question",$Data,'update',$where);
		  return $result;

	}


	function updateData($data,$where)
	{
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_sec_question",$data,"update",$where);
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
				  @ call_user_method($method, $this, stripslashes($VAL));
				}
			}
		}else{
			foreach($_REQUEST AS $KEY => $VAL) {
				$method = "set".$KEY;
				if(in_array($method , $MethodArr))
				{
				  @ call_user_method($method, $this, stripslashes($VAL));
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
       $sql =  "SELECT $feild FROM ".PRJ_DB_PREFIX."_sec_question $cnt $limit";
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
      }
		if($orderBy != "") {
         $cnt .= " Order By ".$orderBy;
			$cnt_count .=" Order By ".$orderBy;
      }

      $sql =  "SELECT $fields FROM ".PRJ_DB_PREFIX."_sec_question $jtbl $cnt $limit";
		$row = $this->_obj->MySQLSelect($sql);
		if($pg=="yes")
		{
			$sql_count =  "SELECT Count(*) as tot FROM ".PRJ_DB_PREFIX."_sec_question $jtbl $cnt_count";
			$row_count = $this->_obj->MySqlSelect($sql_count);
			$row[tot] = $row_count[0][tot];
		}
      return $row;
	}
}
?>