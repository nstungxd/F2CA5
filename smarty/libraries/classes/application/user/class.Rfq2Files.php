<?php
/*
* -------------------------------------------------------
* CLASSNAME:        Rfq2Files
* GENERATION DATE:  24.03.2011
* CLASS FILE:       /home/design/design/www/B2B/libraries/classes/application/class.Rfq2Files.php
* FOR MYSQL TABLE:  b2b_rfq2_files
* FOR MYSQL DB:     B2B
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*/

class Rfq2Files
{

/**
*   @desc Variable Declaration with default value
*/

	protected $iRfq2FileId;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iRfq2FileId;  
	protected $_iRFQ2Id;  
	protected $_vFile;  
	protected $_vExt;  
	protected $_dADate;  



/**
*   @desc   CONSTRUCTOR METHOD
*/

	function __construct()
	{
		global $dbobj;
		$this->_obj = $dbobj;

		$this->_iRfq2FileId = null; 
		$this->_iRFQ2Id = null; 
		$this->_vFile = null; 
		$this->_vExt = null; 
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


	public function getiRfq2FileId()
	{
		return $this->_iRfq2FileId;
	}

	public function getiRFQ2Id()
	{
		return $this->_iRFQ2Id;
	}

	public function getvFile()
	{
		return $this->_vFile;
	}

	public function getvExt()
	{
		return $this->_vExt;
	}

	public function getdADate()
	{
		return $this->_dADate;
	}


/**
*   @desc   SETTER METHODS
*/


	public function setiRfq2FileId($val)
	{
		 $this->_iRfq2FileId =  $val;
	}

	public function setiRFQ2Id($val)
	{
		 $this->_iRFQ2Id =  $val;
	}

	public function setvFile($val)
	{
		 $this->_vFile =  $val;
	}

	public function setvExt($val)
	{
		 $this->_vExt =  $val;
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
			$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_rfq2_files WHERE iRfq2FileId = $id";
		} else {
			$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_rfq2_files WHERE iRfq2FileId=$this->_iRfq2FileId ";
		}
		 $row =  $this->_obj->MySQLSelect($sql);
		 
		 $this->_iRfq2FileId = $row[0]['iRfq2FileId'];
		 $this->_iRFQ2Id = $row[0]['iRFQ2Id'];
		 $this->_vFile = $row[0]['vFile'];
		 $this->_vExt = $row[0]['vExt'];
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
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_rfq2_files WHERE iRfq2FileId = $id";
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
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_rfq2_files WHERE $where";
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
		$this->_iRfq2FileId = '';
		$this->iRfq2FileId = ""; // clear key for autoincrement
		if(!is_array($Data) || count($Data)<1) {
			$Data = array(
						'iRFQ2Id'		=>	$this->_iRFQ2Id,
						'vFile'		=>	$this->_vFile,
						'vExt'		=>	$this->_vExt,
						'dADate'		=>	$this->_dADate
					);
		}
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_rfq2_files",$Data,'insert');
		return $result;	
	}


/**
*   @desc   UPDATE
*/

	function update($where)
	{

		$Data = array(
						'iRFQ2Id'		=>	$this->_iRFQ2Id,
						'vFile'		=>	$this->_vFile,
						'vExt'		=>	$this->_vExt,
						'dADate'		=>	$this->_dADate
					);
		 
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_rfq2_files",$Data,'update',$where);
		return $result;	

	}


	function updateData($data,$where)
	{
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_rfq2_files",$data,"update",$where);
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
      $sql = "SELECT $feild FROM ".PRJ_DB_PREFIX."_rfq2_files rfq2f $cnt $limit";
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

      $sql =  "SELECT $fields FROM ".PRJ_DB_PREFIX."_rfq2_files rfq2f $jtbl $cnt $limit";
		$row = $this->_obj->MySQLSelect($sql);
		if($pg=="yes")
		{
			$sql_count =  "SELECT Count(*) as tot FROM ".PRJ_DB_PREFIX."_rfq2_files rfq2f $jtbl $cnt_count";
			$row_count = $this->_obj->MySQLSelect($sql_count);
			$row['tot'] = $row_count[0]['tot'];
		}
      return $row;
	}
}
?>