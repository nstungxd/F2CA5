<?php
	$sql = "select vName, vValue, vDefValue, eDisplayType from ".PRJ_DB_PREFIX."_configuration  order by iOrderBy";
	$db_setting_rs=$dbobj->MySQLselect($sql);
   // prints($db_setting_rs); exit;
   $sql = "select vName, vValue, vDefValue from ".PRJ_DB_PREFIX."_configuration where vName='ENABLE_AUCTION'";
	$auction_ed_ary = $dbobj->MySQLselect($sql);
   $auction_ed = 'No';
   if(is_array($auction_ed_ary) && count($auction_ed_ary)>0) {
      $auction_ed = $auction_ed_ary[0]['vValue'];
   }

	$n = count($db_setting_rs);
	for($i=0;$i<$n;$i++)
	{
		$field_name = $db_setting_rs[$i]["vName"];
		$vDefValue = $db_setting_rs[$i]["vDefValue"];
		if($db_setting_rs[$i]["eDisplayType"] == 'checkbox')
		{
			if(isset($_POST["$field_name"]) || $_POST["$field_name"] != "")
				$vValue = "Y";
			else
				$vValue = "N";
		}
		else if($db_setting_rs[$i]["eDisplayType"] == 'selectbox')
		{
			if(is_array($_POST["$field_name"]))
				$vValue = implode("|",$_POST["$field_name"]);
			else
				$vValue = $_POST["$field_name"];
		}
		else {
			$vValue = (isset($_POST["$field_name"]))? $_POST["$field_name"] : '';
      }
		if($vValue!="" && $vValue!="-9")
		{
			$vValue = $vValue;
		}
		else
		{
			$vValue = $vDefValue;
		}

		$data = array('vValue' => $vValue);
      $where = " vName = '".$field_name."'";
		$id = $dbobj->MySQLQueryPerform("".PRJ_DB_PREFIX."_configuration",$data,'update',$where);
      if($field_name == 'ENABLE_AUCTION') {
         include_once('edauc.php');
      }

        if($field_name == 'HAVE_HTACCESS') { 	### CHECK WHETHER REWRITE MOD ACTIVE / INACTIVE and DO THE NECESSARY CHANGES
            if($vValue == 'Yes') {
                $htaccessfile =  SPATH_BASE."/configfiles/.htaccess";
                $htaccessfileNamenew = SPATH_BASE."/.htaccess";
                copy($htaccessfile, $htaccessfileNamenew);
            }
        } else if($field_name == 'ENABLE_HTTPS') { 	### CHECK WHETHER HTTPS ENABLED
        		if($vValue == 'Yes') {
        			chmod(SPATH_ROOT."/.htaccess",0777);
					$htaccess_content = file_get_contents(SPATH_ROOT."/.htaccess");
					if(strpos($htaccess_content,"RewriteCond %{HTTPS} !=on") === false) {
						$htaccess_content = str_replace("RewriteEngine On","RewriteEngine On\nRewriteCond %{HTTPS} !=on\nRewriteRule (.*) https://%{HTTP_HOST}%{REQUEST_URI} [NC,R,L]",$htaccess_content);
						file_put_contents(SPATH_ROOT."/.htaccess",$htaccess_content);
					}
					chmod(SPATH_ROOT."/.htaccess",0774);
     			} else {
     				chmod(SPATH_ROOT."/.htaccess",0777);
     				$htaccess_content = file_get_contents(SPATH_ROOT."/.htaccess");
					if(strpos($htaccess_content,"RewriteCond %{HTTPS} !=on") !== false) {
						$htaccess_content = str_replace("RewriteEngine On\nRewriteCond %{HTTPS} !=on\nRewriteRule (.*) https://%{HTTP_HOST}%{REQUEST_URI} [NC,R,L]","RewriteEngine On",$htaccess_content);
						file_put_contents(SPATH_ROOT."/.htaccess",$htaccess_content);
					}
					chmod(SPATH_ROOT."/.htaccess",0774);
     			}
        }
	}

$var_msg = "Setting updated successfully.";
header("Location:index.php?file=ge-settings&view=edit&AX=Yes&var_msg=$var_msg");
exit;
?>