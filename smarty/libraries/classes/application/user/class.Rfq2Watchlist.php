<?php
/**
* -------------------------------------------------------
* CLASSNAME:        Rfq2Watchlist
* GENERATION DATE:  26.04.2011
* CLASS FILE:       /home/www/B2B/libraries/classes/application/class.Rfq2Watchlist.php
* FOR MYSQL TABLE:  b2b_buyer2_rfq2_watchlist
* FOR MYSQL DB:     B2B_Auction
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*/

class Rfq2Watchlist
{

/**
*   @desc Variable Declaration with default value
*/

	protected $iRfq2WatchlistId;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iRfq2WatchlistId;  
	protected $_iUserID;  
	protected $_iRFQ2Id;  



/**
*   @desc   CONSTRUCTOR METHOD
*/

	function __construct()
	{
		global $dbobj;
		$this->_obj = $dbobj;

		$this->_iRfq2WatchlistId = null; 
		$this->_iUserID = null; 
		$this->_iRFQ2Id = null; 
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


	public function getiRfq2WatchlistId()
	{
		return $this->_iRfq2WatchlistId;
	}

	public function getiUserID()
	{
		return $this->_iUserID;
	}

	public function getiRFQ2Id()
	{
		return $this->_iRFQ2Id;
	}


/**
*   @desc   SETTER METHODS
*/


	public function setiRfq2WatchlistId($val)
	{
		 $this->_iRfq2WatchlistId =  $val;
	}

	public function setiUserID($val)
	{
		 $this->_iUserID =  $val;
	}

	public function setiRFQ2Id($val)
	{
		 $this->_iRFQ2Id =  $val;
	}


/**
*   @desc   SELECT METHOD / LOAD
*/

	function select($id)
	{
			if(($id > 0) && (trim($id) != ''))
			{
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_buyer2_rfq2_watchlist WHERE iRfq2WatchlistId = $id";
			} else {
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_buyer2_rfq2_watchlist WHERE iRfq2WatchlistId=$this->_iRfq2WatchlistId ";
				}
		 $row =  $this->_obj->MySQLSelect($sql); 

		 $this->_iRfq2WatchlistId = $row[0]['iRfq2WatchlistId'];
		 $this->_iUserID = $row[0]['iUserID'];
		 $this->_iRFQ2Id = $row[0]['iRFQ2Id'];
 return $row;	
	}

/**
*   @desc   DELETE
*/
	function delete($id)
	{
		 if(trim($id)!='' && $id>0)
		 {
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_buyer2_rfq2_watchlist WHERE iRfq2WatchlistId = $id";
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
			$sql = "DELETE FROM ".PRJ_DB_PREFIX."_buyer2_rfq2_watchlist WHERE $where";
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
		 $this->_iRfq2WatchlistId = '';
		 $this->iRfq2WatchlistId = ""; // clear key for autoincrement
		 if(!is_array($Data) || count($Data)<1) {
			 $Data = array(
						 'iUserID'		=>	$this->_iUserID,
						'iRFQ2Id'		=>	$this->_iRFQ2Id 				
);

		 }
		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_buyer2_rfq2_watchlist",$Data,'insert');
		  return $result;	
	}


/**
*   @desc   UPDATE
*/

	function update($where)
	{

		 $Data = array(
						 'iUserID'		=>	$this->_iUserID,
						'iRFQ2Id'		=>	$this->_iRFQ2Id 				
);

		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_buyer2_rfq2_watchlist",$Data,'update',$where);
		  return $result;	

	}


	function updateData($data,$where)
	{
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_buyer2_rfq2_watchlist",$data,"update",$where);
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
      $sql = "SELECT $feild FROM ".PRJ_DB_PREFIX."_buyer2_rfq2_watchlist $cnt $limit";
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

      $sql =  "SELECT $fields FROM ".PRJ_DB_PREFIX."_buyer2_rfq2_watchlist $jtbl $cnt $limit";
		$row = $this->_obj->MySQLSelect($sql);
		if($pg=="yes")
		{
			if($groupBy != "") {
				if(stripos($fields,'distinct')!==false) {
					$fields = str_ireplace('distinct','',$fields);
				}
				$fields = "Count(*) as tot, $fields";
			}
			$sql_count =  "SELECT Count(*) as tot, $fields FROM ".PRJ_DB_PREFIX."_buyer2_rfq2_watchlist $jtbl $cnt_count";
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