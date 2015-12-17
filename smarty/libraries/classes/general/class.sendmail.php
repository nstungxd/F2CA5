<?php
Class SendPHPMail
{

	function __construct($typ='')
	{
		require_once (SITE_CLASS_GEN.'mailer/class.phpmailer.php');
		$this->mail = new PHPMailer(); 	// true, New instance, with exceptions enabled
		if($typ == 'live') {
			$this->mail->SMTPKeepAlive = true;
		}
	}

	//function to send emails to whole site
	function Send($vType,$vSection,$ToEmail,$bodyArr,$postArr,$from="",$sub="",$returnContentOnly='No',$attach='',$h_append='',$attach_pre='')
	{
		global $dbobj,$MAIL_FOOTER,$SITE_URL,$SITE_TITLE,$ADMIN_EMAIL,$DEFAULT_LANGUAGE,$SITE_FROM_TITLE;
		$Subject = "";
		if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG'] == '') {
			$lang = $DEFAULT_LANGUAGE;
		} else {
			$lang = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG'];
		}

		$sql="SELECT iFormatId ,vSub_".$lang.",tBody_".$lang."
            FROM ".PRJ_DB_PREFIX."_email_template
            WHERE vType='$vType' AND eSection = '$vSection' ";

		$db_email=$dbobj->MySQLselect($sql);

		$headers = "MIME-Version: 1.0\r\n";
      //headers information
		if(trim($h_append) != '') {
			$headers .= $h_append;
		} else {
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		}

       /*if($from == "") {
	    	$headers .= "From: ".$SITE_TITLE." <".trim($ADMIN_EMAIL).">" . "\r\n";
	    } else {
	    	$headers .= "From: ".$SITE_TITLE." <".trim($from).">" . "\r\n";
	    }

      $headers .= 'Reply-To: '.$SITE_TITLE.' <'.trim($ADMIN_EMAIL).'>'. "\r\n".
   					'Return-Path: '.$SITE_TITLE.' <'.trim($ADMIN_EMAIL).'>' . "\r\n".
   					'X-Mailer: PHP/' . phpversion();
      */
      //echo $headers; exit;
      if($from == "") {
	    	$From_new = trim($ADMIN_EMAIL);
	   } else {
	    	$From_new = trim($from);
	   }

      if($sub == "") {
         $Subject = strtr( $db_email[0]["vSub_".$lang.""], "\r\n" , "  " );
      } else {
         $Subject = strtr( $sub, "\r\n" , "  " );
      }

		$this->body = $db_email[0]["tBody_".$lang.""];
		$this->body = nl2br(str_replace($bodyArr,$postArr, $this->body)); // str_replace($bodyArr,$postArr, $this->body); //
     	        $To = $ToEmail;
		$htmlMail = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml">
					<head>
					<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
					<title>'.(isset($this->xheaders['Subject']) ? $this->xheaders['Subject'] : $Subject).'</title>
					<style>
					body{color:#000000; font-family:Tahoma, Helvetica, sans-serif; font-size:11px;}
					</style>
					</head>
					<body>
					<table width="610" border="0" cellspacing="0" cellpadding="0" style="border:3px solid #525a5f;">
					<tr>
						<td><img src="'.SITE_IMAGES.'email-logo.gif" width="100%" height="100%" alt=""/></td>
					</tr>
               <tr><td>&nbsp;</td></tr>
					<tr>
						<td>
							<table width="90%" border="0" style="border:none; background: none;" align="center" cellspacing="0" cellpadding="0">
							<tr>
								<td style="padding:5px">'.$this->body.'</td>
							</tr>
							</table>
						</td>
					</tr>
					</table>
					</body>
					</html>';

        /*if($_SERVER["HTTP_HOST"]=="localhost" || $_SERVER["HTTP_HOST"]=="192.168.33.101") {
			$To = $To; 	// .", $ADMIN_EMAIL";
			$To = $ADMIN_EMAIL;
		} else {
			$To = $To;
        }*/

		if(trim($attach) != '' && trim($attach_pre) != '') {
			$htmlMail .= $attach_pre.$htmlMail.$attach;
		}

         // echo $To; //exit;
         // prints($this->body); exit;
         if($returnContentOnly == 'Yes') {
            return "Subject:".$Subject."<hr>".$htmlMail;
         } else {
            return $this->mail_phpmailer($To,$Subject,$htmlMail,$From_new,$format, $cc, $bcc, $SITE_TITLE,'atonce');
         	// return $res = @ mail($To,$Subject,$htmlMail,$headers);
         }
	}

	function SendMail($From, $To,$Subject,$vBody,$name)
	{
		global $obj,$MAIL_FOOTER,$SITE_URL,$SITE_TITLE;
		//headers information
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= 'From: '.trim($From).' <'.trim($From).'>' . "\r\n".
					'Reply-To: '.trim($From).' <'.trim($From).'>'. "\r\n".
					'Return-Path: '.trim($From).' <'.trim($From).'>' . "\r\n".
					'X-Mailer: PHP/' . phpversion();
		$Subject = strtr($Subject, "\r\n" , "  " );
		$this->body = $vBody;
		$ToEmail = $To;
		$htmlMail = '
						<table border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td>From  : '.$name.' ( '.trim($From).' )</td>
							</tr>
							<tr>
								<td>To  : '.trim($ToEmail).'</td>
							</tr>
							<tr>
								<td>Subject  : '.$Subject.'</td>
							</tr>
							<tr>
								<td>Body  : '.$this->body.'</td>
							</tr>
						</table>
					';
		##TEMPORARY COMMENT
		//$this->strTo = $this->xheaders['To'];

	//	echo $ToEmail ."<hr>". $headers."<hr>". $this->body."<hr>".$headers;die;
		$this->body=$htmlMail;
		$res = @mail( $ToEmail, $Subject, $this->body, $headers);

		/*if($_SERVER["HTTP_HOST"] != "192.168.32.150")
			$res = @mail( $ToEmail, $Subject, $this->body, $headers);*/
		return $res;
	}
	// To Send Mail
	function SendMailFriend($From, $To,$Subject,$vBody)
	{
		global $obj,$MAIL_FOOTER,$SITE_URL,$SITE_TITLE;
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= 'From: '.trim($From).' <'.trim($From).'>' . "\r\n".
					'Reply-To: '.trim($From).' <'.trim($From).'>'. "\r\n".
					'Return-Path: '.trim($From).' <'.trim($From).'>' . "\r\n".
					'X-Mailer: PHP/' . phpversion();
		$Subject = strtr($Subject, "\r\n" , "  " );
		$this->body = $vBody;
		$ToEmail = $To;

		$this->body=$vBody;
		//print_r($vBody);exit;
		//$res = @mail($ToEmail, $Subject, $this->body, $headers);

		//if($_SERVER["HTTP_HOST"] != "192.168.32.150")
		$res = @mail( $ToEmail, $Subject, $this->body, $headers);
		return $res;
	}

    function mail_phpmailer($to, $subject, $vBody, $from, $format="", $cc="", $bcc="", $fromname="", $toall='', $async_send='n')
	{
		global $ADMIN_EMAIL, $SMTP_SECURE_TYPE, $SMTP_PORT, $SMTP_HOST, $SMTP_USERNAME, $SMTP_PASSWORD, $ENABLE_MESSAGE_QUEUE, $SITE_NAME;
		//
		if($async_send == 'y') {
			$mlary[] = array('to'=>$to, 'subject'=>utf8_encode($subject), 'body'=>utf8_encode($vBody), 'from'=>$from, 'format'=>$format, 'cc'=>$cc, 'bcc'=>$bcc, 'fromname'=>utf8_encode($fromname), 'toall'=>$toall);
			# pr($mlary); exit;
			$mtx = json_encode($mlary);
			$tp = (is_array($to))? count($to) : $to;
			$file = SPATH_ROOT.'/tmp/'.md5('mc-'.session_id().''.uniqid('',true).''.$tp.$subject.$from).'.txt';
			if(file_exists($file)) { $file = SPATH_ROOT.'/tmp/'.md5('mc-'.session_id().''.uniqid('',true).''.$tp.$subject.$from).'-'.uniqid('',true).'.txt'; }
			file_put_contents($file, $mtx);
			$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MAIL_FILE'][] = $file;
			return true;
		}
		//
		#require_once (SITE_CLASS_GEN.'mailer/class.phpmailer.php');
		#$mail = new PHPMailer(); 	// true, New instance, with exceptions enabled
		$this->mail->ClearAllRecipients();
		$this->mail->ClearAttachments();
		$toemails = array();
		$toemails = @ explode(",", $to);
		$toemails = array_filter($toemails);
		// pr($toemails); exit;
		$toemails = array_unique($toemails);
		if($toall=='atonce') {
			foreach($toemails as $tomail) {
				if(trim($tomail) != "") { $this->mail->AddAddress(trim($tomail)); }
			}
		} else {
			$this->mail->AddAddress(trim($toemails[0]));
		}
		// foreach($to as $tomail) {
			// if($tomail != "") {
			if(count($toemails)>0) {
				$body = $vBody;
				$body = preg_replace('/\\\\/','', $body); //Strip backslashes

            if(trim($SMTP_SECURE_TYPE)!='' && trim($SMTP_PORT)!='' && trim($SMTP_HOST)!='' && trim($SMTP_USERNAME)!='' && trim($SMTP_PASSWORD)!='') {
   				$this->mail->IsSMTP(); // tell the class to use SMTP
   				$this->mail->SMTPAuth = true; // enable SMTP authentication
               $this->mail->SMTPSecure = $SMTP_SECURE_TYPE;    // tls    // ssl
   				$this->mail->Port = $SMTP_PORT;   //25  // 465; // set the SMTP server port
   				$this->mail->Host = $SMTP_HOST; // SMTP server
   				$this->mail->Username = $SMTP_USERNAME; // SMTP server username
   				$this->mail->Password = $SMTP_PASSWORD; // SMTP server password
               // $this->mail->AddReplyTo($ADMIN_EMAIL,"B2B Admins");
            }

				//$this->mail->IsSendmail(); // tell the class to use Sendmail
				//$this->mail->AddReplyTo("name@domain.com","First Last");
            $this->mail->AddReplyTo($ADMIN_EMAIL, $SITE_FROM_TITLE." Admins");

				$this->mail->From = $from;
				if($fromname!="") {
				  $this->mail->FromName = $fromname;
				} else {
				  $this->mail->FromName = $SITE_FROM_TITLE; 	// "B2B";
            }
				// $this->mail->AddAddress($tomail);
				if($bcc!="") $this->mail->AddBCC($bcc);
				if($cc!="") $this->mail->AddCC($cc);
				$this->mail->Subject = $subject;

				$this->mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
				$this->mail->WordWrap = 90; // set word wrap
            // pr($body);
				$this->mail->MsgHTML($body);
				$this->mail->IsHTML(true); // send as HTML
				/* // entry in message queue
				if(isset($ENABLE_MESSAGE_QUEUE) && $ENABLE_MESSAGE_QUEUE=='Yes')
				{
					$message = $this->mail->CreateBody();
					if(!isset($mqobj)) {
						include_once(SITE_CLASS_APPLICATION.'class.MessageQueue.php');
						$mqobj = new MessageQueue();
					}
					if(is_array($toemails) && count($toemails)>0) {
						foreach($toemails as $toeml) {
							$mdata = array('vSiteName'=>$SITE_NAME, 'vToEmail'=>$toeml, 'vSubject'=>$subject, 'tMailContent'=>$message, 'vFromName'=>$from, 'dInsDate'=>date('Y-m-d H:i:s'), 'eStatus'=>'InProcess');
							$rs = $mqobj->insert($mdata);
						}
					} else if(trim($toemails)!='') {
						$mdata = array('vSiteName'=>$SITE_NAME, 'vToEmail'=>$toemails, 'vSubject'=>$subject, 'tMailContent'=>$message, 'vFromName'=>$from, 'dInsDate'=>date('Y-m-d H:i:s'), 'eStatus'=>'InProcess');
						$rs = $mqobj->insert($mdata);
					}
				} */
				//
				$this->mail->Send();
            // echo "<hr/>".$tomail;
            // pr($this->mail->ErrorInfo);
			}
		// }
	}

	function SendWithAttachments($vType,$vSection,$ToEmail,$bodyArr,$postArr,$from="",$sub="",$returnContentOnly='No',$attachments, $async_send='n')
	{
		global $dbobj, $MAIL_FOOTER, $SITE_URL, $SITE_TITLE, $ADMIN_EMAIL, $DEFAULT_LANGUAGE, $SITE_FROM_TITLE, $SMTP_SECURE_TYPE, $SMTP_PORT, $SMTP_HOST, $SMTP_USERNAME, $SMTP_PASSWORD;
		//
		if($async_send == 'y') {
			function setvalues(&$val, $key) { $val = utf8_encode($val); }
			array_walk($postArr, 'setvalues');
			$mlary[] = array('type'=>$vType, 'vSection'=>$vSection, 'ToEmail'=>$ToEmail, 'bodyArr'=>$bodyArr, 'postArr'=>$postArr, 'from'=>$from, 'sub'=>utf8_encode($sub), 'returnContentOnly'=>$returnContentOnly, 'attachments'=>$attachments);
			# pr($mlary); exit;
			$mtx = json_encode($mlary);
			$tp = (is_array($ToEmail))? count($ToEmail) : $ToEmail;
			$file = SPATH_ROOT.'/tmp/'.md5('mc-'.session_id().''.uniqid('',true).''.$tp.$sub.$from).'.txt';
			if(file_exists($file)) { $file = SPATH_ROOT.'/tmp/'.md5('mc-'.session_id().''.uniqid('',true).''.$tp.$sub.$from).'-'.uniqid('',true).'.txt'; }
			file_put_contents($file, $mtx);
			$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_MAIL_FILE'][] = $file;
			return true;
		}
		//
		if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG'] == '') {
			$lang = $DEFAULT_LANGUAGE;
		} else {
			$lang = $_SESSION['SESS_'.PRJ_CONST_PREFIX.'_LANG'];
		}

		$sql="SELECT iFormatId ,vSub_".$lang.",tBody_".$lang." FROM ".PRJ_DB_PREFIX."_email_template WHERE vType='$vType' AND eSection = '$vSection' ";
		$db_email=$dbobj->MySQLselect($sql);

      //headers information
		// $headers = "MIME-Version: 1.0\r\n";
		// $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

       /*if($from == "") {
	    	$headers .= "From: ".$SITE_TITLE." <".trim($ADMIN_EMAIL).">" . "\r\n";
	    } else {
	    	$headers .= "From: ".$SITE_TITLE." <".trim($from).">" . "\r\n";
	    }

      $headers .= 'Reply-To: '.$SITE_TITLE.' <'.trim($ADMIN_EMAIL).'>'. "\r\n".
   					'Return-Path: '.$SITE_TITLE.' <'.trim($ADMIN_EMAIL).'>' . "\r\n".
   					'X-Mailer: PHP/' . phpversion();
      */
      //echo $headers; exit;
      if($from == "") {
	    	$From_new = trim($ADMIN_EMAIL);
	   } else {
	    	$From_new = trim($from);
	   }

      if($sub == "") {
         $Subject = strtr( $db_email[0]["vSub_".$lang.""], "\r\n" , "  " );
      } else {
         $Subject = strtr( $sub, "\r\n" , "  " );
      }

		$this->body = $db_email[0]["tBody_".$lang.""];
		$this->body = nl2br(str_replace($bodyArr,$postArr, $this->body)); // str_replace($bodyArr,$postArr, $this->body); //
     	$To = $ToEmail;
		$htmlMail = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml">
					<head>
					<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
					<title>'.$this->xheaders['Subject'].'</title>
					<style>
					body{color:#000000; font-family:Tahoma, Helvetica, sans-serif; font-size:11px;}
					</style>
					</head>
					<body>
					<table width="610" border="0" cellspacing="0" cellpadding="0" style="border:3px solid #525a5f;">
					<tr>
						<td align="left" style="color:#deecf7;"><img src="'.SITE_IMAGES.'logo.gif" alt=""/></td>
					</tr>
               <tr><td>&nbsp;</td></tr>
					<tr>
						<td>
							<table width="90%" border="0" style="border:none; background: none;" align="center" cellspacing="0" cellpadding="0">
							<tr>
								<td style="padding:5px">'.$this->body.'</td>
							</tr>
							</table>
						</td>
					</tr>
					</table>
					</body>
					</html>';

			/*if(strstr($_SERVER["HTTP_HOST"],"192.168.39") || $_SERVER["HTTP_HOST"] == "localhost") {
				$To = $To;
				$To = $ADMIN_EMAIL;
			} else {
				$To = $To;
			}*/

			#require_once (SITE_CLASS_GEN.'mailer/class.phpmailer.php');
			#$mail = new PHPMailer(true);
			$htmlMail = preg_replace('/\\\\/','', $htmlMail);

         //
         $this->mail->ClearAllRecipients();
		 $this->mail->ClearAttachments();
         if(trim($SMTP_SECURE_TYPE)!='' && trim($SMTP_PORT)!='' && trim($SMTP_HOST)!='' && trim($SMTP_USERNAME)!='' && trim($SMTP_PASSWORD)!='') {
				$this->mail->IsSMTP(); // tell the class to use SMTP
				$this->mail->SMTPAuth = true; // enable SMTP authentication
            $this->mail->SMTPSecure = $SMTP_SECURE_TYPE;    // tls    // ssl
				$this->mail->Port = $SMTP_PORT;   //25  // 465; // set the SMTP server port
				$this->mail->Host = $SMTP_HOST; // SMTP server
				$this->mail->Username = $SMTP_USERNAME; // SMTP server username
				$this->mail->Password = $SMTP_PASSWORD; // SMTP server password
            // $this->mail->AddReplyTo($ADMIN_EMAIL,"B2B Admins");
         }
         $this->mail->AddReplyTo($ADMIN_EMAIL, $SITE_FROM_TITLE." Admins");
         //

			$this->mail->From = $From_new;
			if($fromname!="")
				$this->mail->FromName = $fromname;
			else
				$this->mail->FromName = $SITE_FROM_TITLE; 	// "B2B";
			$this->mail->AddAddress($To);
			if($bcc!="") $this->mail->AddBCC($bcc);
			if($cc!="") $this->mail->AddCC($cc);
			$this->mail->Subject = $Subject;

			$this->mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
			$this->mail->WordWrap = 90; // set word wrap
			// prints($attachments); exit;
			for($l=0; $l<count($attachments); $l++) {
				$this->mail->AddAttachment($attachments[$l]['path'],$attachments[$l]['name']);
			}
			$this->mail->MsgHTML($htmlMail);
			$this->mail->IsHTML(true); // send as HTML

         //echo $To;//exit;
         // pr($this->body); exit;
         if($returnContentOnly == 'Yes') {
            //  return "Subject:".$Subject."<hr>".$htmlMail;
				return @ $this->mail->Send();
         } else {
				@ $this->mail->Send();
            // return $this->mail_phpmailer($To,$Subject,$htmlMail,$From_new,$format="", $cc="", $bcc="", $SITE_TITLE);
         	// return $res = @mail($To,$Subject,$htmlMail,$headers);
         }
	}

	function closeSMTPConnection()
	{
		$this->mail->SmtpClose();
	}

}
?>