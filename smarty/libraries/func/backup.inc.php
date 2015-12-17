<?php  
//Get All Directory names for the display On Source Back Up
function DirectoryListing($file)
{ 
  $listFileNames = array();
	if (is_dir($file))
	{
		$handle = opendir($file);
		while(false !== ($file1 = readdir($handle)))
			$files[] = $file1;
			natcasesort($files);
			reset($files);

			foreach($files as $filename)
			{
				if ($filename != "." && $filename != "..")
				{
					if(is_dir($file1 = $file."/".$filename))
						DirectoryListing($file1,$findFile);
						$listFileNames[]= $filename;
				}
	 		}
		 @closedir($handle);
	}
	return $listFileNames;
}

//Check files names while Downloading or Uploading
function chkfile($name)
{
		$file_folder_icons = ADMIN_ICONS;
		$icon="<img src=".$file_folder_icons."file.gif>";

		if(is_dir($name))
			$icon="<img src=".$file_folder_icons."icon_dir.gif alt='Directory'>";

		if (strpos($name,".exe"))
			$icon="<img src=".$file_folder_icons."icon_exe.gif alt='Exe File'>";
		if (strpos($name,".txt") || strpos($name,".ini") || strpos($name,".log"))
			$icon="<img src=".$file_folder_icons."icon_txt.gif alt='Text File'>";
		if (strpos($name,".php") || strpos($name,".php3"))
			$icon="<img src=".$file_folder_icons."icon_php.gif alt='PHP File'>";
		if (strpos($name,".asp") || strpos($name,".asa"))
			$icon="<img src=".$file_folder_icons."icon_php.gif alt='ASP File'>";
		if (strpos($name,".htm") || strpos($name,".html"))
			$icon="<img src=".$file_folder_icons."icon_htm.gif alt='Html File'>";
		if (strpos($name,".inc") || strpos($name,".tpl"))
			$icon="<img src=".$file_folder_icons."icon_inc.gif alt='Inc File'>";
		if (strpos($name,".inf") || strpos($name,".css"))
			$icon="<img src=".$file_folder_icons."icon_inf.gif>";
		if (strpos($name,".sql"))
			$icon="<img src=".$file_folder_icons."icon_inc.gif>";
		if (strpos($name,".cls"))
			$icon="<img src=".$file_folder_icons."icon_cls.gif>";
		if (strpos($name,".js"))
			$icon="<img src=".$file_folder_icons."icon_js.gif>";
		if (strpos($name,".cfg"))
			$icon="<img src=".$file_folder_icons."file.gif>";
		if (strpos($name,".jpg") || strpos($name,".JPG"))
			$icon="<img src=".$file_folder_icons."icon_jpg.gif>";
		if (strpos($name,".gif") || strpos($name,".bmp") || strpos($name,".ico"))
			$icon="<img src=".$file_folder_icons."icon_gif.gif>";
		if (strpos($name,".wav"))
			$icon="<img src=".$file_folder_icons."icon_wav.gif>";
		if (strpos($name,".mp3"))
			$icon="<img src=".$file_folder_icons."icon_mp3.gif>";
		if (strpos($name,".fla"))
			$icon="<img src=".$file_folder_icons."icon_flashworkfile.gif>";
		if (strpos($name,".swf") || strpos($name,".swi"))
			$icon="<img src=".$file_folder_icons."icon_flashfile.gif>";
		if (strpos($name,".doc"))
			$icon="<img src=".$file_folder_icons."icon_office_word.gif>";
		if (strpos($name,".ppt"))
			$icon="<img src=".$file_folder_icons."icon_office_powerpoint.gif>";
		if (strpos($name,".xls"))
			$icon="<img src=".$file_folder_icons."icon_office_excel.gif>";
		if (strpos($name,".xml") || strpos($name,".dtd") || strpos($name,".xsl"))
			$icon="<img src=".$file_folder_icons."icon_xml.gif>";
		if (strpos($name,".cmd") || strpos($name,".x"))
			$icon="<img src=".$file_folder_icons."icon_cmd.gif>";
		if (strpos($name,".zip")|| strpos($name,".rar"))
			$icon="<img src=".$file_folder_icons."icon_zip.gif>";
		if (strpos($name,".pdf"))
			$icon="<img src=".$file_folder_icons."icon_pdf.gif>";
		if (strpos($name,".psd"))
			$icon="<img src=".$file_folder_icons."icon_psd.gif>";
		if (strpos($name,".tar"))
			$icon="<img src=".$file_folder_icons."icon_tag-gz.gif>";
		return($icon);
}

//Take Source Back Up and make a Zip file
function source_backup($backup_file_folder_name)
{
	$backup_file_folder_path=SPATH_ROOT.$backup_file_folder_name;
	$day = date("Y-m-d_H-m-s");
	$backupfile = BACKUP_SOURCEPATH.$backup_file_folder_name.'_'.$day.'.tar.gz';
	exec('tar -czf '.$backupfile.' '.$backup_file_folder_path);
	return $backupfile;
}


//Get Size Of Directories on the projects
function getUserDirectorySize($dir) {
    $size = -1;
    if ($dh = @opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if ($file != "." and $file != "..") {
                $path = $dir."/".$file;
                if (is_dir($path)) {
                    $size += getUserDirectorySize("$path/");
                }
                elseif (is_file($path)) {
                    $size += filesize($path);
                }
            }
        }
        closedir($dh);
    }
    return $size;
}

//Get file/Directory size to Display on listing of the files.
function nicesize($size)
{
	$a = array("B", "KB", "MB", "GB", "TB", "PB");
	$pos = 0;
	while ($size >= 1024)
	{
		$size /= 1024;
		$pos++;
	}
	if($size==0)
	{
		return "-";
	}
	else
	{
		return round($size,2)." ".$a[$pos];
	}
}
?>