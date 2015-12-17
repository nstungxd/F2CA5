<?php  
/**
 * Class For Mailbox System
 * @package		class.mailbox.php
 * @general		general
 * @author		cyrus_dev@hotmail.com
 */


class Mailbox
{
	private $iFromId;		//From Id 

	private $eFromType;		//From Type


	public function __construct($iFromId,$eFromType)
	{
		//set from id
		$this->iFromId = $iFromId;

		//set from type admin,member
		$this->eFromType = $eFromType;
	}

   /**
	* @access	public
	* @Return Array of Message of Logged User
	*/

	public function MyInbox($count,$var_limit,$where)
	{
		global $dbobj;
		$sql = "SELECT inb.iMailId,inb.iFromId,inb.eFromType,inb.iToId,
					inb.eToType,inb.vSubject,inb.dMaildate,inb.eRead 
					FROM ".PRJ_DB_PREFIX."_inbox as inb
					WHERE inb.iToId = '".$this->iFromId."' $where 
					ORDER BY inb.iMailId DESC $var_limit";
		$db_sql = $dbobj->MySQLSelect($sql);
		
		if(count($db_sql) > 0){
			for($i=0;$i<count($db_sql);$i++){
				$msgarr[$i]['iMailId'] = $db_sql[$i]['iMailId'];
				$msgarr[$i]['iFromId'] = $db_sql[$i]['iFromId'];
				$msgarr[$i]['eFromType'] = $db_sql[$i]['eFromType'];
				$msgarr[$i]['iToId'] = $db_sql[$i]['iToId'];
				$msgarr[$i]['eToType'] = $db_sql[$i]['eToType'];
				$msgarr[$i]['vSubject'] = $db_sql[$i]['vSubject'];
				$msgarr[$i]['dMaildate'] = $db_sql[$i]['dMaildate'];
				$msgarr[$i]['eRead'] = $db_sql[$i]['eRead'];
				
				if($db_sql[$i]['eFromType'] == 'Member'){
					$sql_mem = "SELECT concat(klm.vFirstName,' ',klm.vLastName) as from_name  
							FROM ".PRJ_DB_PREFIX."_member klm
							WHERE klm.iMemberId = '".$db_sql[$i]['iFromId']."'";
					$db_mem = $dbobj->MySQLSelect($sql_mem);
					$msgarr[$i]['from_name'] = $db_mem[0]['from_name'];
				}
				else if($db_sql[$i]['eFromType'] == 'Customer'){
					$sql_mem = "SELECT concat(kc.vFirstname,' ',kc.vLastname) as from_name  
							FROM ".PRJ_DB_PREFIX."_rest_customer  kc
							WHERE kc.iCustomerId = '".$db_sql[$i]['iFromId']."'";
					$db_mem = $dbobj->MySQLSelect($sql_mem);
					$msgarr[$i]['from_name'] = $db_mem[0]['from_name'];
				}
				else if($db_sql[$i]['eFromType'] == 'Admin'){
					$sql_mem = "SELECT concat(kc.vFirstname,' ',kc.vLastname) as from_name  
							FROM ".PRJ_DB_PREFIX."_administrator  kc
							WHERE kc.iAdminId = '".$db_sql[$i]['iFromId']."'";
					$db_mem = $dbobj->MySQLSelect($sql_mem);
					$msgarr[$i]['from_name'] = $db_mem[0]['from_name'];
				}
			}
		}
		
		return $msgarr;
	}

	
   /**
	* @access	public
	* @Return Array of Sent Messages
	*/

public function SentMails($count,$var_limit,$where)
	{
		global $dbobj;

		if($count	==	'Yes'){	
			$field	=	" count(iMsgID) as tot ";	
		}else{
			$field	=	"iMsgID,iFromId,iToId,vSubject,dMaildate";	
		}

		$sql = "SELECT ".$field."
				FROM ".PRJ_DB_PREFIX."_admin_message_alert  				 
				$where GROUP BY vSubject ORDER BY  iMsgID DESC $var_limit";
		$db_sql = $dbobj->MySQLSelect($sql);

		return $db_sql;
	}
   /**
	* @access	public
	* @Return Array of Message Detail
	*/
	public function MailDetail($iMsgID,$viewtype)
	{
		global $dbobj;
		
		//echo  $iMailId;
		$sql = "SELECT hfma.iMsgID,hfma.iFromId,hfma.eFromType,hfma.iToId,hfma.vSubject,hfma.tBody,
			hfma.dMaildate,hfma.eRead,concat(hm.vFirstname,' ',hm.vLastname) as name,hm.vEmail
			FROM ".PRJ_DB_PREFIX."_admin_message_alert  AS hfma,".PRJ_DB_PREFIX."_member AS hm 
			WHERE (hfma.iToId = hm.iMemberId) AND hfma.iMsgID = '".$iMsgID."'";
		$db_sql = $dbobj->MySQLSelect($sql);
		return $db_sql;
	}
	public function MultipleMailDetail($subject)
	{
		global $dbobj;
		
		//echo  $iMailId;
		$sql = "SELECT hfma.iMsgID,hfma.iFromId,hfma.eFromType,hfma.iToId,hfma.vSubject,hfma.tBody,
			hfma.dMaildate,hfma.eRead,concat(hm.vFirstname,' ',hm.vLastname) as name,hm.vEmail
			FROM ".PRJ_DB_PREFIX."_admin_message_alert  AS hfma,".PRJ_DB_PREFIX."_member AS hm 
			WHERE (hfma.iToId = hm.iMemberId) AND hfma.vSubject = '".$subject."' GROUP BY hfma.iToId ORDER BY hfma.iMsgID ASC";
		$db_sql = $dbobj->MySQLSelect($sql);
		return $db_sql;
	}	
}

?>