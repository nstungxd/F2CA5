<?php
/**
* -------------------------------------------------------
* CLASSNAME:        RPTReports
* GENERATION DATE:  14.07.2011
* CLASS FILE:       /home/www/B2B/libraries/classes/application/class.RPTReports.php
* FOR MYSQL TABLE:  b2b_rptreports
* FOR MYSQL DB:     B2B_Auction
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*/

class RPTReports
{

/**
*   @desc Variable Declaration with default value
*/

	protected $iReportId;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iReportId;
	protected $_vReportName;
	protected $_tDescription;
	protected $_tParameters;
	protected $_tPath;
	protected $_eType;
	protected $_eStatus;


/**
*   @desc   CONSTRUCTOR METHOD
*/

	function __construct()
	{
		global $dbobj;
		$this->_obj = $dbobj;

		$this->_iReportId = null;
		$this->_vReportName = null;
		$this->_tDescription = null;
		$this->_tParameters = null;
		$this->_tPath = null;
		$this->_eType = null;
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


	public function getiReportId()
	{
		return $this->_iReportId;
	}

	public function getvReportName()
	{
		return $this->_vReportName;
	}

	public function gettDescription()
	{
		return $this->_tDescription;
	}

	public function gettParameters()
	{
		return $this->_tParameters;
	}

	public function gettPath()
	{
		return $this->_tPath;
	}

	public function geteType()
	{
		return $this->_eType;
	}


/**
*   @desc   SETTER METHODS
*/


	public function setiReportId($val)
	{
		 $this->_iReportId =  $val;
	}

	public function setvReportName($val)
	{
		 $this->_vReportName =  $val;
	}

	public function settDescription($val)
	{
		 $this->_tDescription =  $val;
	}

	public function settParameters($val)
	{
		 $this->_tParameters =  $val;
	}

	public function settPath($val)
	{
		 $this->_tPath =  $val;
	}

	public function seteType($val)
	{
		 $this->_eType =  $val;
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
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_rptreports WHERE iReportId = $id";
			} else {
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_rptreports WHERE iReportId=$this->_iReportId ";
		 }
		 $row =  $this->_obj->MySQLSelect($sql);

		 $this->_iReportId = $row[0]['iReportId'];
		 $this->_vReportName = $row[0]['vReportName'];
		 $this->_tDescription = $row[0]['tDescription'];
		 $this->_tParameters = $row[0]['tParameters'];
		 $this->_tPath = $row[0]['tPath'];
		 $this->_eType = $row[0]['eType'];
 return $row;
	}

/**
*   @desc   DELETE
*/
	function delete($id)
	{
		 if(trim($id)!='' && $id>0)
		 {
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_rptreports WHERE iReportId = $id";
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
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_rptreports WHERE $where";
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
		$this->_iReportId = '';
		$this->iReportId = ""; // clear key for autoincrement
		if(!is_array($Data) || count($Data)<1) {
			$Data = array(
						'vReportName'		=>	$this->_vReportName,
						'tDescription'		=>	$this->_tDescription,
						'tParameters'		=>	$this->_tParameters,
						'tPath'		=>	$this->_tPath,
						'eType'		=>	$this->_eType,
						'eStatus' 	=> $this->_eStatus
			);
		}
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_rptreports",$Data,'insert');
		return $result;
	}


/**
*   @desc   UPDATE
*/

	function update($where)
	{

		 $Data = array(
						 'vReportName'		=>	$this->_vReportName,
						'tDescription'		=>	$this->_tDescription,
						'tParameters'		=>	$this->_tParameters,
						'tPath'		=>	$this->_tPath,
						'eType'		=>	$this->_eType,
						'eStatus' 	=> $this->_eStatus
);

		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_rptreports",$Data,'update',$where);
		  return $result;

	}


	function updateData($data,$where)
	{
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_rptreports",$data,"update",$where);
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
      $sql = "SELECT $feild FROM ".PRJ_DB_PREFIX."_rptreports rpt $cnt $limit";
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

      $sql =  "SELECT $fields FROM ".PRJ_DB_PREFIX."_rptreports rpt $jtbl $cnt $limit";
		$row = $this->_obj->MySQLSelect($sql);
		if($pg=="yes")
		{
			$sql_count =  "SELECT Count(*) as tot FROM ".PRJ_DB_PREFIX."_rptreports rpt $jtbl $cnt_count";
			$row_count = $this->_obj->MySQLSelect($sql_count);
			$row['tot'] = $row_count[0]['tot'];
			if($groupBy != "") {
				$row['tot'] = @ count($row_count);
			}
		}
      return $row;
	}
}
?>