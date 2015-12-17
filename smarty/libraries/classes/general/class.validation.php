<?php

Class Validation
{
	public function __construct(){}

   public function isEmpty($rArr) {
		$Data = $_POST['Data'];
      if($rArr){
         foreach($rArr as $key=>$val){
             if(is_array($val))
             {
                $allEmpty='yes';
                foreach($val as $keyInner=>$valInner)
                {
                    if(trim($_POST[$keyInner]) != '')
                    {
                        $allEmpty='no';
                        break;
                    }
                }
                //print $allEmpty;exit;
                if($allEmpty == 'yes')
                    $resArr[]= $valInner;
             }
             else{
                if((isset($_POST[$key]) && trim($_POST[$key])=='') || (isset($Data[$key]) && trim($Data[$key])=='')) {
						$resArr[]= $val;
                } else if(!isset($Data[$key]) && !isset($_POST[$key])) {
						$resArr[]= $val;
					 }
            }
         }
      }
      if(isset($resArr) && is_array($resArr)) {
         $resArr=array_unique($resArr);
      }
      // $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']='';
      $resArr = (isset($resArr))? $resArr : '';
      $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'] = $resArr;
      return $resArr;
   }

	public function isEmptyMul($rArr)
	{
		$resArr = array();
      if(is_array($rArr) && count($rArr)>0) {
         foreach($rArr as $key=>$val) {
				if(isset($_POST[$key]) && is_array($_POST[$key]) && count($_POST[$key])>0) {
					foreach($_POST[$key] as $k => $v) {
						if((isset($v) && trim($v) == '')) {
							$resArr[]= $val;
						}
					}
				} else if(isset($_POST['Data'][$key]) && is_array($_POST['Data'][$key]) && count($_POST['Data'][$key])>0) {
					foreach($_POST['Data'][$key] as $k => $v) {
						if((isset($v) && trim($v) == '')) {
							$resArr[]= $val;
						}
					}
				}
         }
      }
		$resArr = array_unique($resArr);
		if(is_array($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'])) {
			$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'] = array_merge($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'],$resArr);
		} else {
			$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'] = $resArr;
		}
      return $resArr;
   }

	public function isNumMul($rArr,$typ='')
	{	// $Data = $_POST['Data'];
		$vmsg = array();
      if(is_array($rArr) && count($rArr)>0) {
         foreach($rArr as $key=>$val) {
				if(is_array($_POST[$key]) && count($_POST[$key])>0) {
					foreach($_POST[$key] as $k => $v) {
						$v = str_replace(",","",$v);
						if($typ == 'empty') {
							if(!is_numeric(trim($v)) && trim($v)!='')
							{
								// $num[$ky] = $vldmsg[$ky];
								$vmsg[]= $val;
								$flg = 'er';
							}
						} else {
							if(!is_numeric(trim($v)))
							{
								// $num[$ky] = $vldmsg[$ky];
								$vmsg[]= $val;
								$flg = 'er';
							}
						}
					}
				}
         }
      }
//prints($vmsg);
//exit;
		if(is_array($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'])) {
			$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'] = array_merge($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'],$vmsg);
		} else {
			$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'] = $vmsg;
		}
                //prints($_SESSION);exit;
      return $flg;
   }

   public function CreateHtmlMsg($SessValArr)
	{
		$reqMSg = '';
      if($SessValArr){
         $reqMSg = '\nPlease enter the bellow required fileds : \n\n';
         //prints($SessValArr);
         foreach($SessValArr as $key=>$val){
            $reqMSg.= '* '.$val.'\n';
         }
      }
      return $reqMSg;
   }

    public function isNum($dtary,$vldmsg,$typ='')
   {
      $num = ''; //array();
      $flg = '';
		$vmsg = array();
      if(is_array($dtary))
      {
       //  prints($dtary);exit;
         foreach($dtary as $ky => $vl)
         {
         	$vl = str_replace(",","",$vl);
            if($typ == 'empty') {
                    if(!is_numeric(trim($vl)) && trim($vl)!='')
                    {
                            // $num[$ky] = $vldmsg[$ky];
                            //$vmsg[]= $val;
                            $vmsg[]= $vldmsg[$ky];
                            $flg = 'er';
                    }
            }
            else if(!is_numeric(trim($vl)))
            {
               $num[$ky] = $vldmsg[$ky];
					$vmsg[]= $vldmsg[$ky];
               $flg = 'er';
            }
         }
      }
      else if(!is_numeric(trim($dtary)))
      {
         $num = $vldmsg;
         $flg = 'er';
      }
      $num['error'] = $flg;
//prints($vmsg);exit;
		if(is_array($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'])) {
		  if(count($vmsg)>0)
			$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'] = array_merge($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'],$vmsg);
		} else {
			$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'] = $vmsg;
		}

      return  $num['error'];
   }

   public function isAlphaNum($dtary,$vldmsg,$typ='')
   {
      $str = ''; //array();
      $flg = '';
      $vmsg = array();
      if(is_array($dtary))
      {
         foreach($dtary as $ky => $vl)
         {
             if($typ == 'empty') {
                 if(!preg_match("/^([a-z0-9])+$/i", $vl) && trim($vl)!='')
                    {
                            $vmsg[]= $vldmsg[$ky];
                            $flg = 'er';
                    }
            }
            else if(!preg_match("/^([a-z0-9])+$/i", $vl))
            {
                $num[$ky] = $vldmsg[$ky];
                $vmsg[]= $vldmsg[$ky];
                $flg = 'er';
            }
         }
      }
      else if($typ == 'empty')
      {
          if(!preg_match("/^([a-z0-9])+$/i", $dtary) && trim($dtary)!='')
          {
            $vmsg[]=$vldmsg;
            $flg = 'er';
          }
      }else{
          if(!preg_match("/^([a-z0-9])+$/i", $dtary))
          {
            $vmsg[]=$vldmsg;
            $flg = 'er';
          }
      }
      $str['error'] = $flg;
		if(is_array($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'])) {
		  if(count($vmsg)>0)
			$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'] = array_merge($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'],$vmsg);
		} else {

			$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'] = $vmsg;
		}

      return  $str['error'];
   }

   public function isEmail($dtary, $vldmsg)
   {
      //$pattern = '/^([a-z0-9])(([-a-z0-9._])*([a-z0-9]))*\@([a-z0-9])*(\.([a-z0-9])([-a-z0-9_-])([a-z0-9])+)*$/i';
      $pattern = '/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is';
      $num = ''; //array();
      $flg = '';
      // prints($dtary); exit;
      if(is_array($dtary))
      {
         foreach($dtary as $ky => $vl)
         {
            if(!preg_match($pattern,trim($vl)))
            {
               $num[$ky] = $vldmsg[$ky];
               $vmsg[]= $vldmsg[$ky];
               $flg = 'er';
            }
         }
      }
      else if(!preg_match($pattern,trim($dtary)))
      {
         $num = $vldmsg;
         $flg = 'er';
      }
      //echo $flg; exit;
      $num['error'] = $flg;


      if($num['error']=='er') {
         if(is_array($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'])) {
			$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'] = array_merge($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'],$vldmsg);
		} else {
			 $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'] = $vldmsg;
		}
      }

      return $num['error'];   // echo preg_match('/^([a-z0-9])(([-a-z0-9._])*([a-z0-9]))*\@([a-z0-9])*(\.([a-z0-9])([-a-z0-9_-])([a-z0-9])+)*$/i','09_az..AZ@host.dOMain.cOM');

 }

   public function isEqual($vl1, $vl2, $vldmsg)
   {
      $equal = '';
      $flg = '';
      if(is_array($vl1))
      {
         foreach($vl1 as $ky => $vl)
         {
            if($vl1[$ky] !== $vl2[$ky])
            {

               $equal[$ky] = $vldmsg[$ky];
               $vmsg[]= $vldmsg[$ky];
               $flg = 'er';
            }
         }
      }
      else if($vl1 !== $vl2)
      {
         $equal = $vldmsg;
         $flg = 'er';
         if(is_array($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'])) {
				$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'] = array_merge($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'],$vldmsg);
			} else {
				$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'] = $vldmsg;
			}
      }
//       $equal['error'] = $flg;
     // $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION']='';

      return $flg;
   }

   public function maxLen($dtary, $ln, $vldmsg)
   {
      $maxln = '';
      $flg = '';
      //echo $dtary;exit;
      if(is_array($vldmsg))
      {
         foreach($vldmsg as $ky => $vl)
         {
            //echo $ky;
            //prints($ln[$ky]); exit;
            if(strlen($dtary[$ky]) > $ln[$ky])
            {
               $maxln[$ky] = $vldmsg[$ky];
               $flg = 'er';
            }
         }
      }
      else if(strlen($dtary) > $ln)
      {
         $maxln = $vldmsg;
         $flg = 'er';
      }

      $maxln['error'] = $flg;
      return $maxln;
   }

   public function ChekDupEmail($id,$flds,$tbl,$val,$msg)
   {  // prints($msg);exit;
 //echo $val;exit;
		global $dbobj;
		if($id!='') {
			$iId = (isset($_POST[$id]))? $_POST[$id] : '';
		}
		$flg = '';
		$wh = '';
		if(is_numeric($id) && $id>0) {
			$wh = " AND $flds <> $id ";
		}
		$sql = "Select COUNT($flds) as count  from $tbl  where vEmail like '$val' $wh ";
		$dt_exist = $dbobj->MySqlSelect($sql);
		$cnt= $dt_exist[0]['count'];

		if($tbl != PRJ_DB_PREFIX."_organization_user") {
			$sql = "select iUserID, vEmail from ".PRJ_DB_PREFIX."_organization_user where vEmail like '$val' "; 	// $cndt
			$usr_exist = $dbobj->MySqlSelect($sql);
		} else {
			$usr_exist = array();
		}

		if($tbl != PRJ_DB_PREFIX."_organization_master") {
			$sql = "select iOrganizationID, vEmail from ".PRJ_DB_PREFIX."_organization_master where vEmail like '$val' ";
			$or_exist = $dbobj->MySqlSelect($sql);
		} else {
			$or_exist = array();
		}

		if($tbl != PRJ_DB_PREFIX."_security_manager") {
			$sql = "select iSMID, vEmail from ".PRJ_DB_PREFIX."_security_manager where vEmail like '$val' ";
			$sm_exist = $dbobj->MySqlSelect($sql);
		} else {
			$sm_exist = array();
		}

		if($tbl != PRJ_DB_PREFIX."_administrator") {
			$sql = "select iAdminId, vEmail from ".PRJ_DB_PREFIX."_administrator where vEmail like '$val' ";
			$adm_exist = $dbobj->MySqlSelect($sql);
		} else {
			$adm_exist = array();
		}

		if(count($adm_exist)>0 || count($sm_exist)>0 || count($or_exist)>0 || count($usr_exist)>0 || $cnt>0) 	// || count($dt_exist)>0
		{
			// $rslt = 'dup';
			//$rslt[] = $smarty->get_template_vars('MSG_DUP_EMAIL');
			$rslt = 'er';
		} else {
			// $rslt = 'nodup';
			$rslt = '';
		}

/*		if($cnt>0)
		{
			$rslt = $smarty->get_template_vars('MSG_DUP_EMAIL');
			$flg = 'er';
		} else {
			$rslt = '';
		}
*/
		//prints($rslt);exit;
                /*if($rslt!='') {
			if(is_array($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'])) {
				 $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'] = array_merge($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'],$msg);
			} else {
				 $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_VALIDATION'] = $msg;
			}
		}*/
                //prints($_SESSION);exit;
		return $rslt;
	}

     public function ChekDupUserName($id, $flds, $tbl, $val, $vlmsg, $exchk='') {
        global $dbobj;
        $flg = '';
        if (is_numeric($id) && $id > 0) {
            $wh = " AND $flds <> $id ";
        }
        if($exchk != '') {
        	$wh .= $exchk;
        }
        $sql = "Select COUNT($flds) as count  from $tbl  where vUserName like '$val' $wh ";
        $dt_exist = $dbobj->MySqlSelect($sql);
        $cnt = $dt_exist[0]['count'];

        if ($cnt > 0) {
            $rslt = $vlmsg;
            $flg = 'er';
        } else {
            $rslt = '';
        }

        if ($rslt != '') {

            if (is_array($_SESSION['SESS_' . PRJ_CONST_PREFIX . '_VALIDATION'])) {
                $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_VALIDATION'] = array_merge($_SESSION['SESS_' . PRJ_CONST_PREFIX . '_VALIDATION'], $rslt);
            } else {
                $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_VALIDATION'] = $rslt;
            }
        }
        if ($flg == 'er') {
            return $flg;
        }
    }
      public function ChekDupGroupName($id, $flds, $tbl, $val, $vlmsg,$extVal) {

        global $dbobj;
        $flg = '';
        if (is_numeric($id) && $id > 0) {
            $wh = " AND iGroupID <> '".$id."'";
        }
        $sql = "Select COUNT($flds) as count  from $tbl  where vGroupName like '$val' $wh $extVal";
        $dt_exist = $dbobj->MySqlSelect($sql);
        $cnt = $dt_exist[0]['count'];

        if ($cnt > 0) {
            $rslt = $vlmsg;
            $flg = 'er';
        } else {
            $rslt = '';
        }

        if ($rslt != '') {

            if (is_array($_SESSION['SESS_' . PRJ_CONST_PREFIX . '_VALIDATION'])) {
                $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_VALIDATION'] = array_merge($_SESSION['SESS_' . PRJ_CONST_PREFIX . '_VALIDATION'], $rslt);
            } else {
                $errArra=array($rslt);
                $_SESSION['SESS_' . PRJ_CONST_PREFIX . '_VALIDATION'] = $errArra;
            }
        }
        if ($flg == 'er') {
            return $flg;
        }
    }
}

?>
