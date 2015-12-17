<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        PurchaseOrderAttachment
* GENERATION DATE:  10.06.2010
* CLASS FILE:       /home/www/B2B/libraries/classes/application/class.PurchaseOrderAttachment.php
* FOR MYSQL TABLE:  b2b_purchase_order_attachment
* FOR MYSQL DB:     B2B
* -------------------------------------------------------
* AUTHOR:
* from: >> www.hiddenbrains.com
* -------------------------------------------------------
*
*/

class PurchaseOrderAttachment
{


/**
*   @desc Variable Declaration with default value
*/

	protected $iAttachmentID;   // KEY ATTR. WITH AUTOINCREMENT

	protected $_iAttachmentID;
	protected $_iPurchaseOrderID;
	protected $_vTitle;
	protected $_vFile;
	protected $_tDescription;
	protected $_dAdate;
	protected $_eRelatedTo;



/**
*   @desc   CONSTRUCTOR METHOD
*/

	function __construct()
	{
		global $dbobj;
		$this->_obj = $dbobj;

		$this->_iAttachmentID = null;
		$this->_iPurchaseOrderID = null;
		$this->_vTitle = null;
		$this->_vFile = null;
		$this->_tDescription = null;
		$this->_dAdate = null;
		$this->_eRelatedTo = null;
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


	public function getiAttachmentID()
	{
		return $this->_iAttachmentID;
	}

	public function getiPurchaseOrderID()
	{
		return $this->_iPurchaseOrderID;
	}

	public function getvTitle()
	{
		return $this->_vTitle;
	}

	public function getvFile()
	{
		return $this->_vFile;
	}

	public function gettDescription()
	{
		return $this->_tDescription;
	}

	public function getdAdate()
	{
		return $this->_dAdate;
	}

	public function geteRelatedTo()
	{
		return $this->_eRelatedTo;
	}


/**
*   @desc   SETTER METHODS
*/


	public function setiAttachmentID($val)
	{
		 $this->_iAttachmentID =  $val;
	}

	public function setiPurchaseOrderID($val)
	{
		 $this->_iPurchaseOrderID =  $val;
	}

	public function setvTitle($val)
	{
		 $this->_vTitle =  $val;
	}

	public function setvFile($val)
	{
		 $this->_vFile =  $val;
	}

	public function settDescription($val)
	{
		 $this->_tDescription =  $val;
	}

	public function setdAdate($val)
	{
		 $this->_dAdate =  $val;
	}

	public function seteRelatedTo($val)
	{
		 $this->_eRelatedTo =  $val;
	}


/**
*   @desc   SELECT METHOD / LOAD
*/

	function select($id)
	{
			if(($id > 0) && (trim($id) != ''))
			{
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_purchase_order_attachment WHERE iAttachmentID = $id";
			} else {
				$sql =  "SELECT * FROM ".PRJ_DB_PREFIX."_purchase_order_attachment WHERE iAttachmentID=$this->_iAttachmentID ";
		 }
		 $row =  $this->_obj->MySQLSelect($sql);

		 $this->_iAttachmentID = $row[0]['iAttachmentID'];
		 $this->_iPurchaseOrderID = $row[0]['iPurchaseOrderID'];
		 $this->_vTitle = $row[0]['vTitle'];
		 $this->_vFile = $row[0]['vFile'];
		 $this->_tDescription = $row[0]['tDescription'];
		 $this->_dAdate = $row[0]['dAdate'];
		 $this->_eRelatedTo = $row[0]['eRelatedTo'];
 return $row;
	}


/**
*   @desc   DELETE
*/

	function delete($id)
	{
		 $sql = "DELETE FROM ".PRJ_DB_PREFIX."_purchase_order_attachment WHERE iAttachmentID in($id)";
		 return $result = $this->_obj->sql_query($sql);
	}


/**
*   @desc   INSERT
*/

	function insert()
	{
		 $this->_iAttachmentID = '';
		 $this->iAttachmentID = ""; // clear key for autoincrement

		 $Data = array(
						 'iPurchaseOrderID'		=>	$this->_iPurchaseOrderID,
						'vTitle'		=>	$this->_vTitle,
						'vFile'		=>	$this->_vFile,
						'tDescription'		=>	$this->_tDescription,
						'dAdate'		=>	$this->_dAdate,
						'eRelatedTo'		=>	$this->_eRelatedTo
);

		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_purchase_order_attachment",$Data,'insert');
		  return $result;
	}


/**
*   @desc   UPDATE
*/

	function update($where)
	{

		 $Data = array(
						 'iPurchaseOrderID'		=>	$this->_iPurchaseOrderID,
						'vTitle'		=>	$this->_vTitle,
						'vFile'		=>	$this->_vFile,
						'tDescription'		=>	$this->_tDescription,
						'dAdate'		=>	$this->_dAdate,
						'eRelatedTo'		=>	$this->_eRelatedTo
);

		 $result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_purchase_order_attachment",$Data,'update',$where);
		  return $result;

	}


	function updateData($data,$where)
	{
		$result = $this->_obj->MySQLQueryPerform(PRJ_DB_PREFIX."_purchase_order_attachment",$data,"update",$where);
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
       if($groupBy != "") {
          $cnt .= " Group By ".$groupBy;
       }
       if($orderBy != "") {
          $cnt .= " Order By ".$orderBy;
       }
       $sql =  "SELECT $feild FROM ".PRJ_DB_PREFIX."_purchase_order_attachment $cnt $limit";
       //print $sql;
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
			$cnt_count .= " Group By ".$groupBy;
      }
		if($orderBy != "") {
         $cnt .= " Order By ".$orderBy;
      }

      $sql =  "SELECT $fields FROM ".PRJ_DB_PREFIX."_purchase_order_attachment $jtbl $cnt $limit";
		$row = $this->_obj->MySQLSelect($sql);
		if($pg=="yes")
		{
			$sql_count =  "SELECT Count(*) as tot FROM ".PRJ_DB_PREFIX."_purchase_order_attachment $jtbl $cnt_count";
			$row_count = $this->_obj->MySqlSelect($sql_count);
			$row[tot] = $row_count[0][tot];
		}
      return $row;
	}
}
?>