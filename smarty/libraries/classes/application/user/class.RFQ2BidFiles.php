<?php
/**
* -------------------------------------------------------
* CLASSNAME:        RFQ2BidFiles
* GENERATION DATE:  16.04.2011
* CLASS FILE:       /home/www/B2B/libraries/classes/application/class.RFQ2BidFiles.php
* FOR MYSQL TABLE:  b2b_rfq2bid_files
* FOR MYSQL DB:     B2B_Auction
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*/

class RFQ2BidFiles
{

/**
*   @desc Variable Declaration with default value
*/

	protected $iBidFileId;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iBidFileId;  
	protected $_iBidId;  
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

		$this->_iBidFileId = null; 
		$this->_iBidId = null; 
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

	public function getiBidFileId()
	{
		return $this->_iBidFileId;
	}

	public function getiBidId()
	{
		return $this->_iBidId;
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

	public function setiBidFileId($val)
	{
		 $this->_iBidFileId =  $val;
	}

	public function setiBidId($val)
	{
		 $this->_iBidId =  $val;
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
			$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_rfq2bid_files WHERE iBidFileId = $id";
		} else {
			$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_rfq2bid_files WHERE iBidFileId=$this->_iBidFileId ";
		}
		$row =  $this->_obj->MySQLSelect($sql); 

		 $this->_iBidFileId = $row[0]['iBidFileId'];
		 $this->_iBidId = $row[0]['iBidId'];
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
			$sql = "DELETE FROM ".PRJ_DB_PREFIX."_rfq2bid_files WHERE iBidFileId = $id";
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
			$sql = "DELETE FROM ".PRJ_DB_PREFIX."_rfq2bid_files WHERE $where";
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
		$this->_iBidFileId = '';
		$this->iBidFileId = ""; // clear key for autoincrement
		
		if(!is_array($Data) || count($Data)<1) {
			$Data = array(
						'iBidId'		=>	$this->_iBidId,
						'vFile'		=>	$this->_vFile,
						'vExt'		=>	$this->_vExt,
						'dADate'		=>	$this->_dADate 				
			);
		}
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_rfq2bid_files",$Data,'insert');
		return $result;
	}


/**
*   @desc   UPDATE
*/

	function update($where)
	{
		$Data = array(
					'iBidId'		=>	$this->_iBidId,
					'vFile'		=>	$this->_vFile,
					'vExt'		=>	$this->_vExt,
					'dADate'		=>	$this->_dADate 				
		);
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_rfq2bid_files",$Data,'update',$where);
		return $result;
	}


	function updateData($data,$where)
	{
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_rfq2bid_files",$data,"update",$where);
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
				   @ call_user_method($method,$this,$VAL);
				}
			}
		} else {
			foreach($_REQUEST AS $KEY => $VAL) {
				$method = "set".$KEY;
				if(in_array($method , $MethodArr))
				{
				   @ call_user_method($method,$this,$VAL);
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
      $sql = "SELECT $feild FROM ".PRJ_DB_PREFIX."_rfq2bid_files r2bdf $cnt $limit";
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

      $sql =  "SELECT $fields FROM ".PRJ_DB_PREFIX."_rfq2bid_files r2bdf $jtbl $cnt $limit";
		$row = $this->_obj->MySQLSelect($sql);
		if($pg=="yes")
		{
			$sql_count =  "SELECT Count(*) as tot FROM ".PRJ_DB_PREFIX."_rfq2bid_files r2bdf $jtbl $cnt_count";
			$row_count = $this->_obj->MySQLSelect($sql_count);
			$row['tot'] = $row_count[0]['tot'];
		}
      return $row;
	}
}
?>