<?php
/**
* -------------------------------------------------------
* CLASSNAME:        MessageQueue
* GENERATION DATE:  03.05.2011
* CLASS FILE:       /home/www/B2B/libraries/classes/application/class.MessageQueue.php
* FOR MYSQL TABLE:  b2b_message_queuing
* FOR MYSQL DB:     B2B_Auction
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*/

class MessageQueue
{

/**
*   @desc Variable Declaration with default value
*/

	protected $iMailID;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iMailID;  
	protected $_vSiteName;  
	protected $_vToEmail;  
	protected $_vSubject;  
	protected $_tMailContent;  
	protected $_vFromName;  
	protected $_dInsDate;  
	protected $_dSendDate;  
	protected $_eStatus;  



/**
*   @desc   CONSTRUCTOR METHOD
*/

	function __construct()
	{
		global $dbobj;
		$this->_obj = $dbobj;

		$this->_iMailID = null; 
		$this->_vSiteName = null; 
		$this->_vToEmail = null; 
		$this->_vSubject = null; 
		$this->_tMailContent = null; 
		$this->_vFromName = null; 
		$this->_dInsDate = null; 
		$this->_dSendDate = null; 
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

	public function getiMailID()
	{
		return $this->_iMailID;
	}

	public function getvSiteName()
	{
		return $this->_vSiteName;
	}

	public function getvToEmail()
	{
		return $this->_vToEmail;
	}

	public function getvSubject()
	{
		return $this->_vSubject;
	}

	public function gettMailContent()
	{
		return $this->_tMailContent;
	}

	public function getvFromName()
	{
		return $this->_vFromName;
	}

	public function getdInsDate()
	{
		return $this->_dInsDate;
	}

	public function getdSendDate()
	{
		return $this->_dSendDate;
	}

	public function geteStatus()
	{
		return $this->_eStatus;
	}


/**
*   @desc   SETTER METHODS
*/

	public function setiMailID($val)
	{
		 $this->_iMailID =  $val;
	}

	public function setvSiteName($val)
	{
		 $this->_vSiteName =  $val;
	}

	public function setvToEmail($val)
	{
		 $this->_vToEmail =  $val;
	}

	public function setvSubject($val)
	{
		 $this->_vSubject =  $val;
	}

	public function settMailContent($val)
	{
		 $this->_tMailContent =  $val;
	}

	public function setvFromName($val)
	{
		 $this->_vFromName =  $val;
	}

	public function setdInsDate($val)
	{
		 $this->_dInsDate =  $val;
	}

	public function setdSendDate($val)
	{
		 $this->_dSendDate =  $val;
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
		if(($id > 0) && (trim($id) != '')) {
			$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_message_queuing WHERE iMailID = $id";
		} else {
			$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_message_queuing WHERE iMailID=$this->_iMailID ";
		}
		$row =  $this->_obj->MySQLSelect($sql); 

		 $this->_iMailID = $row[0]['iMailID'];
		 $this->_vSiteName = $row[0]['vSiteName'];
		 $this->_vToEmail = $row[0]['vToEmail'];
		 $this->_vSubject = $row[0]['vSubject'];
		 $this->_tMailContent = $row[0]['tMailContent'];
		 $this->_vFromName = $row[0]['vFromName'];
		 $this->_dInsDate = $row[0]['dInsDate'];
		 $this->_dSendDate = $row[0]['dSendDate'];
		 $this->_eStatus = $row[0]['eStatus'];
		return $row;	
	}

/**
*   @desc   DELETE
*/
	function delete($id)
	{
		if(trim($id)!='' && $id>0)
		{
			$sql = "DELETE FROM ".PRJ_DB_PREFIX."_message_queuing WHERE iMailID = $id";
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
			$sql = "DELETE FROM ".PRJ_DB_PREFIX."_message_queuing WHERE $where";
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
		$this->_iMailID = '';
		$this->iMailID = ""; // clear key for autoincrement
		
		if(!is_array($Data) || count($Data)<1) {
			$Data = array(
						'vSiteName'		=>	$this->_vSiteName,
						'vToEmail'		=>	$this->_vToEmail,
						'vSubject'		=>	$this->_vSubject,
						'tMailContent'		=>	$this->_tMailContent,
						'vFromName'		=>	$this->_vFromName,
						'dInsDate'		=>	$this->_dInsDate,
						'dSendDate'		=>	$this->_dSendDate,
						'eStatus'		=>	$this->_eStatus 				
				);
			}
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_message_queuing",$Data,'insert');
		return $result;
	}


/**
*   @desc   UPDATE
*/

	function update($where)
	{
		$Data = array(
						'vSiteName'		=>	$this->_vSiteName,
						'vToEmail'		=>	$this->_vToEmail,
						'vSubject'		=>	$this->_vSubject,
						'tMailContent'		=>	$this->_tMailContent,
						'vFromName'		=>	$this->_vFromName,
						'dInsDate'		=>	$this->_dInsDate,
						'dSendDate'		=>	$this->_dSendDate,
						'eStatus'		=>	$this->_eStatus 				
			);
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_message_queuing",$Data,'update',$where);
		return $result;
	}


	function updateData($data,$where)
	{
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_message_queuing",$data,"update",$where);
		return $result;
	}

	/**
	*   @desc   SET ALL VARIABLE
	*/
	function setAllVar($Data=array())
	{
		$MethodArr = get_class_methods($this);
		if(count($Data) > 0) {
			foreach($Data AS $KEY => $VAL) {
				$method = "set".$KEY;
				if(in_array($method , $MethodArr))
				{
				  @call_user_method($method,$this,$VAL);
				}
			}
		} else {
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
      $sql = "SELECT $feild FROM ".PRJ_DB_PREFIX."_message_queuing $cnt $limit";
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

      $sql =  "SELECT $fields FROM ".PRJ_DB_PREFIX."_message_queuing $jtbl $cnt $limit";
		$row = $this->_obj->MySQLSelect($sql);
		if($pg=="yes")
		{
			$sql_count =  "SELECT Count(*) as tot FROM ".PRJ_DB_PREFIX."_message_queuing $jtbl $cnt_count";
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