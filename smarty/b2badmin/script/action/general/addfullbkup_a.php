<?php  
include_once(SITE_CLASS_GEN."class.backup.php");
$action=PostVar('action');
switch($action)
{
	case "tableBackup":
			# Variables have replaced original hard-coded values
			$dumper = new Mysqldumper(SITE_SERVER, SITE_USERNAME,SITE_PASS,SITE_DB); 
			$dumper->setDBtables($chk);
			$dumpfinished = $dumper->createDump("callBack");
			$msg=rawurlencode("Database Saved Successfully ");
			header("Location:index.php?file=ge-fullbkup&view=edit&AX=Yes&var_msg=$msg");
			exit;

	case "filedownload":
		if(!headers_sent())
		{
			ob_clean();
			ob_flush();
			header('Content-type: application/download');
			header('Content-Disposition: attachment; filename='.PostVar('filedown'));
			readfile(BACKUP_DBPATH.PostVar('filedown'));
			exit;
		}
		break;

	case "delete_db_file":
		for($i=0; $i<count($_POST[chkFull]); $i++)
		{
			$fileName=BACKUP_DBPATH.$_POST['chkFull'][$i];
			@unlink($fileName);
		}
		$msg=rawurlencode("DB backup file has been Deleted successfully.");
		header("Location:index.php?file=ge-fullbkup&view=edit&AX=Yes&var_msg=$msg");
		exit;
	break;

	case "sourcebackup":
		source_backup("");
		$msg=rawurlencode("Files/Folders Successfully Backup ");
		header("Location:index.php?file=ge-source&view=edit&AX=Yes&var_msg=$msg");
		exit;
}

?>