<?php  
/**
 * This Class is for db connection to whole site
 *
 * @package		class.dbquery.php
 * @section		general
 * @author		cyrus_dev@hotmail.com
 */

class DBConnectionInstall
{
	private $DBASE="";
	private $CONN="";


	/**
	* @access	public
	* @check database connection
	* @return	true/false
	*/
	public function DBConnectionInstall($server="",$dbase="", $user="", $pass="")
	{
		$this->DBASE = $dbase;
      $this->SERVER = $server;
      $this->USERNAME = $user;
      $this->PASSWORD = $pass;
		$conn = mysql_connect($server,$user,$pass);
		if(!$conn) {
			$this->MySQLDie("Connection attempt failed");
		}
		$this->CONN = $conn;
		return true;
	}
    
    /**
	* @access	public
	* @check database connection
	* @return	true/false
	*/
	public function chkDbExist($dbase="")
	{
		$conn = $this->CONN;
		if(!mysql_select_db($dbase,$conn)) {
			$retval = 0;
		}else{
		    $retval = 1;
		}
		return $retval;
	}
    
    /**
	* @access	public
	* @check database connection
	* @return	true/false
	*/
	public function createDB($dbase="")
	{
		$conn = $this->CONN;
        $sql = 'CREATE DATABASE `'.$dbase.'` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;';
        $db_sql = mysql_query($sql);
        mysql_select_db($dbase,$conn);
		return $db_sql;
	}
    
    
    /**
	* @access	public
	* @check database connection
	* @return	true/false
	*/
	public function chooseDB($dbase="")
	{
		$conn = $this->CONN;
        mysql_select_db($dbase,$conn);
		return true;
	}

	/**
	* @access	public
	* @Close Database connection
	* @return	true/false
	*/
	public function MySQLClose()
	{
		$conn = $this->CONN ;
		$close = mysql_close($conn);
		if(!$close) {
			$this->MySQLDie("Connection close failed");
		}
		return true;
	}

	/**
	* @access	private
	* @Set Message for Die
	* @return	Message
	*/
	private function MySQLDie($text)
	{
		die($text);
	}

	/**
	* @access	public
	* @Retrive  Records
	* @param 	$sql query
	* @return	array
	*/
	public function MySQLSelect($sql="",$cached="")
	{

	  $chkurl = strpos("".PRJ_DB_PREFIX."/".$_SERVER['REQUEST_URI'],"/cpanel");
	  //$chkurl1 = strpos("mfm/".$_SERVER['REQUEST_URI'],"/csr");

	  //print_r($_GET['file']);
		$chkfile = $_GET['file'];
	  //$chkfile = $_GET('file');
	  //explode with "-" and find section
    $chkvar	=	explode("-",$chkfile);
    $chkprefix	=	$chkvar[0];
    if($chkprefix == 'mem')
      $chkurl2 = "1";

    if(empty($sql)) { return false; }
		if(empty($this->CONN)){return false;}
		$conn = $this->CONN;
	if($chkurl > 0 || $chkurl1 > 0 || $chkurl2 > 0){
      $results = mysql_query($sql,$conn);
    }else{
      if($cached != 'No'){
        $results = mysql_query($sql,$conn);

        //$results = $this->cache_array_new($sql);
        //$data = $results;
        //$direct = "1";
      }else{
        $results = mysql_query($sql,$conn);
      }
    }
   if($direct != '1'){
      if( (!$results) or (empty($results)) ) {
  			return false;
  		  }
  		  $count = 0;
  		  $data = array();
  		  while ($row = @mysql_fetch_assoc($results))
  		  {
  			 $data[$count] = $row;
  			 $count++;
  		  }
  		  @mysql_free_result($results);
    }
    return $data;
	}

	/**
	* @access	public
	* @get all fields from table
	* @param 	$table name
	* @return	all fields
	*/
	public function MySQLGetFields($table)
	{
		//$fields = mssql_list_fields($this->DBASE, $table, $this->CONN);
		$fields = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.Columns where TABLE_NAME = '".$table."'";
		$db_sql_col  = $this->sql_query($fields);
        
		if(count($db_sql_col) > 0){
			$i=0;
			foreach($db_sql_col as $reqarr){
			     
				if($primarykey=='Yes'){
					if($arrF !='')
							$arrF.= ",";
                            

					$arrF.= $db_sql_col[$i]['COLUMN_NAME'];
				}elseif($primarykey=='No'){
					//if(!stristr(mssql_field_flags($fields, $i),'primary_key')){
						if($arrF !='')
							$arrF.= ",";

						$arrF.= $db_sql_col[$i]['COLUMN_NAME'];
					//}
				}
                //Prints($arrF);
                //Prints($reqarr[$i]);exit;
				$arr[] = $db_sql_col[$i]['COLUMN_NAME'];
                
				$i++;
			}
		}
        //Prints($arr);exit;
		return $arr;
	}
	/**
	* @access	public
	* @get all fields from table
	* @param 	$table name
	* @return	all fields
	*/

	public function MySQLGetFieldsQuery($table,$primarykey='Yes')
	{

		//$fields = mssql_list_fields($this->DBASE, $table, $this->CONN);
		$fields = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.Columns where TABLE_NAME = '".$table."'";
		$db_sql_col  = $this->sql_query($fields);
        
		if(count($db_sql_col) > 0){
			$i=0;
			foreach($db_sql_col as $reqarr){
			     
				if($primarykey=='Yes'){
					if($arrF !='')
							$arrF.= ",";
                            

					$arrF.= $db_sql_col[$i]['COLUMN_NAME'];
				}elseif($primarykey=='No'){
					//if(!stristr(mssql_field_flags($fields, $i),'primary_key')){
						if($arrF !='')
							$arrF.= ",";

						$arrF.= $db_sql_col[$i]['COLUMN_NAME'];
					//}
				}
                //Prints($arrF);
                //Prints($reqarr[$i]);exit;
				$arr[] = $db_sql_col[$i]['COLUMN_NAME'];
                
				$i++;
			}
		}
        //Prints($arr);exit;
		return $arrF;
	}


	/**
	* @access	public
	* @insert update/Query
	* @param 	$table name
	* @return	all fields
	*/
	public function MySQLQueryPerform($table, $data, $action = 'insert', $parameters = '',$noprim='')
	{
		$conn = $this->CONN;
		reset($data);
	    if ($action == 'insert')
       {
         $query = 'insert into ' . $table . ' (';while (list($columns, ) = each($data)) {
	        $query .= $columns . ', ';
         }
	    $query = substr($query, 0, -2) . ') values (';reset($data);
		while (list(, $value) = each($data))
		{
			switch ((string)$value) {
			case 'null':
				$query .= 'null, ';
		    break;
		    default:
		    	$query .= '\'' . mysql_escape_string($value) . '\', ';
		    	break;
		     }
	    }
      //prints ($data); //exit;
		$query 		= substr($query, 0, -2) . ')'; //Insert Query ready
	  	// echo $query; // exit;
		$results 	= @mysql_query($query,$conn); //or die("Query failed: " . mysql_error());

                  if($noprim == ''){
                     $results 	= mysql_insert_id();
                  }

		if(!$results)
		   {
			 //$this->MySQLDie("Query went bad!");
			 return false;
		   }
	    }
		elseif ($action == 'update')
		{
	      $query = 'update ' . $table . ' set ';
	      while (list($columns, $value) = each($data))
		  {
	        switch ((string)$value)
			{
	          case 'null':
	            $query .= $columns .= ' = null, ';
	             break;
	          default:
	            $query .= $columns . ' = \'' .mysql_escape_string($value). '\', ';
	            break;
	        }
	     }

	    $query = substr($query, 0, -2) . ' where ' . $parameters; //Update Query ready
		 // prints($query);  exit;
		$results = @mysql_query($query,$conn) or die("Query failed: " . mysql_error());
		  if(!$results)
		  {
			 $this->MySQLDie("Query went bad!");
			 return false;
		  }
	    }
		return $results;
	}
     public function MySQLQueryPerform2($table, $data, $action = 'insert', $parameters = '',$noprim='')
	{
		$conn = $this->CONN;
		reset($data);
	    if ($action == 'insert')
       {
         $query = 'insert into ' . $table . ' (';while (list($columns, ) = each($data)) {
	        $query .= $columns . ', ';
         }
	    $query = substr($query, 0, -2) . ') values (';reset($data);
		while (list(, $value) = each($data))
		{
			switch ((string)$value) {
			case 'null':
				$query .= 'null, ';
		    break;
		    default:
		    	$query .= '\'' . mysql_escape_string($value) . '\', ';
		    	break;
		     }
	    }

		$query 		= substr($query, 0, -2) . ')'; //Insert Query ready
	  	  echo $query;// exit;
           return true;
		$results 	= @mysql_query($query,$conn); // or die("Query failed: " . mysql_error());
      if($noprim == ''){
         $results 	= mysql_insert_id();
      }

		if(!$results)
		   {
			 // $this->MySQLDie("Query went bad!");
			 return false;
		   }
	    }
		elseif ($action == 'update')
		{
	      $query = 'update ' . $table . ' set ';
	      while (list($columns, $value) = each($data))
		  {
	        switch ((string)$value)
			{
	          case 'null':
	            $query .= $columns .= ' = null, ';
	             break;
	          default:
	            $query .= $columns . ' = \'' .mysql_escape_string($value). '\', ';
	            break;
	        }
	     }
	    $query = substr($query, 0, -2) . ' where ' . $parameters; //Update Query ready
		   echo "<br>".$query;
             return true;
//// exit;
		$results = @mysql_query($query,$conn); //  or die("Query failed: " . mysql_error());
		  if(!$results)
		  {
			 // $this->MySQLDie("Query went bad!");
			 return false;
		  }
	    }
		return $results;
	}
	/**
	* @access	public
	* @Delete
	* @param 	$table,$where
	* @return	$query
	*/
	public function MySQLDelete( $table, $where)
	{
		$query = "DELETE FROM `$table` WHERE  $where";
		// echo $query;exit;
		$conn = $this->CONN;

		// or MySQLDie("DELETE ERROR ($query): " . mysql_error() )

		if( $conn )
			return mysql_query($query, $conn);
		return $query;
	}


	/**
	* @access	public
	* @Perform the query action
	* @param 	$sql;
	* @return	$data;
	*/

	public function sql_query($sql="")
	{	if(empty($sql)) { return false; }
		if(empty($this->CONN)) { return false; }
		$conn = $this->CONN;
        //prints($sql);
		$results = @mysql_query($sql,$conn) or die($sql."<hr>".@mysql_error()."query fail");
		if(!$results)
		{   $message = "Query went bad!";
			$this->error($message);
			return false;
		}
		if(!@eregi("^select",$sql)){
			return true; }
		else {
			$count = 0;
			$data = array();
			while ( $row = @mysql_fetch_array($results))	{
				$data[$count] = $row;
				$count++;
			}
			@mysql_free_result($results);
			return $data;
	 	}
	}

   public function Onlyquery($query) {
		//echo $query."<br/>"; //exit;
     $conn = mysqli_connect($this->SERVER,$this->USERNAME,$this->PASSWORD,$this->DBASE);
     if($result = mysqli_query($conn,$query)){

   			$count = 0;
   			$data = array();
   			while ( $row = mysqli_fetch_array($result))	{
   			   //print_r($row);exit;
   				$data[$count] = $row;
   				$count++;
   			}
            mysqli_free_result($result);
   			return $data;
   	}else {
   			print('error on:'.$query.mysqli_error($this));
      }
    }

	public function GetAllId($sql="")
	{
		$data = array();
		if(empty($sql)) { return false; }
		if(empty($this->CONN)) { return false; }
		$conn = $this->CONN;
		$results = mysql_query($sql,$conn) or die(mysql_error()."query fail");
		if(!$results)
		{   $message = "Query went bad!";
			$this->error($message);
			return false;
		}
		if(!eregi("^select",$sql)){
			return true; 
        }else{
			$count = 0;

			while ( $row = mysql_fetch_array($results))
			{
				$data[$count] = $row[0];
				$count++;
			}
			mysql_free_result($results);
			return $data;
	 	}
	}

	//Simply Insert the Query
	public function MySQLInsert ($sql="")
	{
		if(empty($sql)) { return false; }
		if(!eregi("^insert",$sql))
		{
			return false;
		}
		if(empty($this->CONN))
		{
			return false;
		}
		$conn = $this->CONN;
		$results = mysql_query($sql,$conn);
		if(!$results)
		{
			$this->error("<H2>No results!</H2>\n");
			return false;
		}
		$id = mysql_insert_id();
		return $id;
	}


	/**
	* @access	public
	* @insert  Query
	* @param 	$table name
	* @return	all fields
	*/
	public function MySQLInsertPerform($table, $data, $action = 'insert', $parameters = '')
	{
		$conn = $this->CONN;
		reset($data);
	    if ($action == 'insert'){$query = 'insert into ' . $table . ' (';while (list($columns, ) = each($data)) {
	        $query .= $columns . ', ';
	    }
	    $query = substr($query, 0, -2) . ') values (';reset($data);
		while (list(, $value) = each($data))
		{
			switch ((string)$value) {
			case 'null':
				$query .= 'null, ';
		    break;
		    default:
		    	$query .= '\'' . $value . '\', ';
		    	break;
		     }
	    }

		$query 		= substr($query, 0, -2) . ')'; //Insert Query ready
		$results 	= @mysql_query($query,$conn) or die("Query failed: " . mysql_error());
		if(!$results)
		   {
			 $this->MySQLDie("Query went bad!");
			 return false;
		   }
	    }
		return $results;
	}

	function MySQLSelectAssoc($sql="", $key='', $fetch=MYSQL_ASSOC)
	{
		$this->_COUNT++;
		if(empty($sql)) { return false; }
		if(!eregi("^select",$sql) && !eregi("^call",$sql))
		{
			echo "wrongquery<br>$sql<p>";
			echo "<H2>Wrong function silly!</H2>\n";
			return false;
		}
		if(empty($this->CONN)) { return false; }
		$conn = $this->CONN;
		$this->TESTCOUNT++;
		$results = @mysql_query($sql , $conn);
		if( (!$results) or (empty($results)) ) {
			return false;
		}
		$count = 0;
		$data = array();
		while ( $row = mysql_fetch_array($results,$fetch))
		{
			$data[$row[$key]][] = $row;
			$count++;
		}
		mysql_free_result($results);
		return $data;
	}
	//Get Cached the querry only for the Front Content Section
	public function cache_array_new($query) {

    global $dbobj,$TIME_ELAPSE;

    $TIME_ELAPSE = !isset($TIME_ELAPSE) ? 10000:$TIME_ELAPSE;

    $filename = SPATH_ROOT."/cache_files/".md5($query).".txt";
      if (!file_exists($filename)) {
      	$content=	$this->MySQLSelect($query,"No");//Result array set of $array=$db->query($query, "query");

        if (!$handle = fopen($filename, 'w+')) {	//If File is not exists than attemp to create it
      		echo "not created";
      		exit();
      	}
      	$content_file	=	serialize($content);
      	if (fwrite($handle, $content_file) === FALSE) {
      		echo "permision denied or file not exists";
      		exit();
      	}
      	chmod($filename,0777);
      	fclose($handle);
      } else {

        $time = filemtime($filename);
       	$time = $time + $TIME_ELAPSE;
      	$curTime = strtotime("now");
      	/*echo $curTime." < ".$time;
      	echo "<hr>";
      	echo $curTime < $time;*/
      	//echo "<pre>";
        if($curTime < $time) {

        	if (!$handle = fopen($filename, 'r')) {	//If File exists than attemp to create it

        		echo "not created";

        		exit();
        	}
        	$content	=	fread($handle, filesize($filename));
        	$content	=	unserialize($content);
        	//var_dump($content);
      	} else {
      	   $content=	$this->MySQLSelect($query,"No");	//Result array set of $array=$db->query($query, "query");

        	if (!$handle = fopen($filename, 'w+')) {	//If File is not exists than attemp to create it
        		echo "not created";
        		exit();
        	}

        	$content_file	=	serialize($content);

        	if (fwrite($handle, $content_file) === FALSE) {
        		echo "permision denied or file not exists";
        		exit();
        	}
        	chmod($filename,0777);
        	fclose($handle);

        }
      }
    return $content;
    }

	/*
	Optimize the full datatbase
	*/
	function FullDBOptmize()
	{
		$conn = $this->CONN;
		$alltables = mysql_query("SHOW TABLES",$conn) or die("Error: " . mysql_error());
		while ($table = mysql_fetch_assoc($alltables))
		  {
			foreach ($table as $db => $tablename)
			{
				$query="OPTIMIZE TABLE ".$tablename.";";
				$this->TESTCOUNT++;
				mysql_query($query,$conn) or die("Query failed: " . mysql_error());
				//echo "TABLE ".$tablename." OPTIMIZEED SUCCESSFULLY......<BR>";
			}
		 }
	}

   /**
	* @access	public
	* @Create New Field if Not Exist in a table with Language code and Add Post value To desired fields
	* @param 	$table,$fieldarr,$Data(Post Data)
	* @return	$fieldData
	*/
	public function getAlterTable($table,$fieldarr,$Data){
		global  $gdbobj;
		$db_lang =$gdbobj->getLanguage();
		for($i=0;$i<count($fieldarr);$i++){
			for($l=0;$l<count($db_lang);$l++){
				$field = $fieldarr[$i].'_'.$db_lang[$l][vLanguageCode];
				$sql = "SHOW COLUMNS FROM $table LIKE '".$field."'";
				$db_sql = mysql_query($sql);
				$count="0";
				$data = array();
				while ($row = @mysql_fetch_array($db_sql))	{
						$data[$count] = $row;
						$count++;
				}
				if(count($data) > 0){
					$fieldatt[0]['after']	 	= $fieldarr[$i].'_'.$db_lang[$l][vLanguageCode];;
					$fieldatt[0]['type'] 		= $data[0]['Type'];
					$fieldatt[0]['default']	= $data[0]['Default'];
				}
				$order = $fieldatt[0]['after'];
				$type  = $fieldatt[0]['type'];
				$default  = $fieldatt[0]['default'];

				if(count($data) == 0){
					$sql_alter = "ALTER TABLE $table ADD $field ".$type." ".$default." NOT NULL  AFTER ".$order."";
					$db_alter = mysql_query($sql_alter);
				}
				if(trim($Data["".$fieldarr[$i]."_".$db_lang[$l][vLanguageCode]]) == ''){
					$fieldValue	= $Data["".$fieldarr[$i]."_".$db_lang[0][vLanguageCode]];
				}else{
					$fieldValue	= $Data["".$fieldarr[$i]."_".$db_lang[$l][vLanguageCode]];
				}
				$fieldData["".$fieldarr[$i]."_".$db_lang[$l][vLanguageCode]]	=	addslashes($fieldValue);
			}
		}
		return $fieldData;
	}
}
?>