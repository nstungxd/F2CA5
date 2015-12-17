<?php
/**
* -------------------------------------------------------
* CLASSNAME:        ReportFiles
* GENERATION DATE:  06.09.2011
* CLASS FILE:       /home/www/B2B/libraries/classes/application/class.ReportFiles.php
* FOR MYSQL TABLE:  b2b_reportfiles
* FOR MYSQL DB:     B2B_Auction
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*/

class ReportFiles
{

/**
*   @desc Variable Declaration with default value
*/

	protected $iReportFileId;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iReportFileId;
	protected $_iReportId;
	protected $_iOrganizationID;
	protected $_params;
	protected $_vFilePath;
	protected $_dADate;



/**
*   @desc   CONSTRUCTOR METHOD
*/

	function __construct()
	{
		global $dbobj;
		$this->_obj = $dbobj;

		$this->_iReportFileId = null;
		$this->_iReportId = null;
		$this->_iOrganizationID = null;
		$this->_params = null;
		$this->_vFilePath = null;
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


	public function getiReportFileId()
	{
		return $this->_iReportFileId;
	}

	public function getiReportId()
	{
		return $this->_iReportId;
	}

	public function getiOrganizationID()
	{
		return $this->_iOrganizationID;
	}

	public function getparams()
	{
		return $this->_params;
	}

	public function getvFilePath()
	{
		return $this->_vFilePath;
	}

	public function getdADate()
	{
		return $this->_dADate;
	}


/**
*   @desc   SETTER METHODS
*/


	public function setiReportFileId($val)
	{
		 $this->_iReportFileId =  $val;
	}

	public function setiReportId($val)
	{
		 $this->_iReportId =  $val;
	}

	public function setiOrganizationID($val)
	{
		 $this->_iOrganizationID =  $val;
	}

	public function setparams($val)
	{
		 $this->_params =  $val;
	}

	public function setvFilePath($val)
	{
		 $this->_vFilePath =  $val;
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
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_reportfiles WHERE iReportFileId = $id";
			} else {
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_reportfiles WHERE iReportFileId=$this->_iReportFileId ";
		 }
		 $row =  $this->_obj->MySQLSelect($sql);

		 $this->_iReportFileId = $row[0]['iReportFileId'];
		 $this->_iReportId = $row[0]['iReportId'];
		 $this->_iOrganizationID = $row[0]['iOrganizationID'];
		 $this->_params = $row[0]['params'];
		 $this->_vFilePath = $row[0]['vFilePath'];
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
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_reportfiles WHERE iReportFileId = $id";
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
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_reportfiles WHERE $where";
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
		 $this->_iReportFileId = '';
		 $this->iReportFileId = ""; // clear key for autoincrement
		 if(!is_array($Data) || count($Data)<1) {
			 $Data = array(
						 'iReportId'		=>	$this->_iReportId,
						'iOrganizationID'		=>	$this->_iOrganizationID,
						'params'		=>	$this->_params,
						'vFilePath'		=>	$this->_vFilePath,
						'dADate'		=>	$this->_dADate
			);
		}
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_reportfiles",$Data,'insert');
		return $result;
	}


/**
*   @desc   UPDATE
*/

	function update($where)
	{

		$Data = array(
						'iReportId'		=>	$this->_iReportId,
						'iOrganizationID'		=>	$this->_iOrganizationID,
						'params'		=>	$this->_params,
						'vFilePath'		=>	$this->_vFilePath,
						'dADate'		=>	$this->_dADate
		);

		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_reportfiles",$Data,'update',$where);
		return $result;
	}


	function updateData($data,$where)
	{
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_reportfiles",$data,"update",$where);
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
      $sql = "SELECT $feild FROM ".PRJ_DB_PREFIX."_reportfiles $cnt $limit";
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

      $sql =  "SELECT $fields FROM ".PRJ_DB_PREFIX."_reportfiles $jtbl $cnt $limit";
		$row = $this->_obj->MySQLSelect($sql);
		if($pg=="yes")
		{
			$sql_count =  "SELECT Count(*) as tot FROM ".PRJ_DB_PREFIX."_reportfiles $jtbl $cnt_count";
			$row_count = $this->_obj->MySQLSelect($sql_count);
			$row['tot'] = $row_count[0]['tot'];
			if($groupBy != "") {
				$row['tot'] = @ count($row_count);
			}
		}
      return $row;
	}

}
//
?>