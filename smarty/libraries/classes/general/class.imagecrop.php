<?php  
class ImageCrop
{
	var $img;
	var $acHWArr = array();

	private function thumbnail($imgfile)
	{
		//detect image format

		$this->acHWArr			=	 getimagesize($imgfile);

		$this->img["format"]	=	ereg_replace(".*\.(.*)$","\\1",$imgfile);
		$this->img["format"]	=	strtoupper($this->img["format"]);
		if ($this->img["format"]=="JPG" || $this->img["format"]=="JPEG") {
			//JPEG
			$this->img["format"]="JPEG";
			$this->img["src"] = ImageCreateFromJPEG ($imgfile);

		} elseif ($this->img["format"]=="PNG") {
			//PNG
			$this->img["format"]="PNG";
			$this->img["src"] = ImageCreateFromPNG ($imgfile);
		} elseif ($this->img["format"]=="GIF") {
			//GIF
			$this->img["format"]="GIF";
			$this->img["src"] = ImageCreateFromGIF ($imgfile);
		} elseif ($this->img["format"]=="WBMP") {
			//WBMP
			$this->img["format"]="WBMP";
			$this->img["src"] = ImageCreateFromWBMP ($imgfile);
		} else {
			//DEFAULT
			echo "Not Supported File <a href='".$_SERVER[HTTP_REFERER]."'>Back</a>";
			exit();
		}

		@$this->img["lebar"] = imagesx($this->img["src"]);
		@$this->img["tinggi"] = imagesy($this->img["src"]);

		//default quality jpeg
		$this->img["quality"]=75;
	}

	public function size_height($size=100)
	{
		//height
			if($this->acHWArr[1] < $size){
				$size	=	$this->acHWArr[1];
			}
    	$this->img["tinggi_thumb"]	=	$size;
    	@$this->img["lebar_thumb"]	= 	($this->img["tinggi_thumb"]/$this->img["tinggi"])*$this->img["lebar"];
	}

	/* To FIx Height Width But It Will Make the Image Quality Bad. */
	public function size_width_height($height=100,$width=100)
	{
		//height
			if($this->acHWArr[1] < $height){
				$height	=	$this->acHWArr[1];
			}
		//width
		if($this->acHWArr[0] < $width){
				$width	=	$this->acHWArr[0];
		}

		$this->img["tinggi_thumb"]	=	$height;
    	$this->img["lebar_thumb"]	= 	$width;
	}

	public function size_width($size=100)
	{
		//width

		if($this->acHWArr[0] < $size){
				$size	=	$this->acHWArr[0];
		}

		$this->img["lebar_thumb"]=$size;

		@$this->img["tinggi_thumb"] = ($this->img["lebar_thumb"]/$this->img["lebar"])*$this->img["tinggi"];
	}

	public function size_auto($size=100)
	{
		//size

		if ($this->img["lebar"]>=$this->img["tinggi"]) {
				//Width
				if($this->acHWArr[0] < $size){
					$size = $this->acHWArr[0];
				}

    		$this->img["lebar_thumb"]=$size;
    		@$this->img["tinggi_thumb"] = ($this->img["lebar_thumb"]/$this->img["lebar"])*$this->img["tinggi"];
		} else {
				//Height
				if($this->acHWArr[1] < $size){
					$size = $this->acHWArr[1];
				}
	    	$this->img["tinggi_thumb"]=$size;
    		@$this->img["lebar_thumb"] = ($this->img["tinggi_thumb"]/$this->img["tinggi"])*$this->img["lebar"];
 		}
	}

	public function jpeg_quality($quality=75)
	{
		//jpeg quality
		$this->img["quality"]=$quality;
	}


	public function save($save="")
	{
		//save thumb
		if (empty($save)) $save=strtolower("./thumb.".$this->img["format"]);
		/* change ImageCreateTrueColor to ImageCreate if your GD not supported ImageCreateTrueColor function*/
		$this->img["des"] = ImageCreateTrueColor($this->img["lebar_thumb"],$this->img["tinggi_thumb"]);
    		@imagecopyresampled ($this->img["des"], $this->img["src"], 0, 0, 0, 0, $this->img["lebar_thumb"], $this->img["tinggi_thumb"], $this->img["lebar"], $this->img["tinggi"]);

		if ($this->img["format"]=="JPG" || $this->img["format"]=="JPEG") {
			//JPEG
			imageJPEG($this->img["des"],"$save",$this->img["quality"]);

		} elseif ($this->img["format"]=="PNG") {
			//PNG
			imagePNG($this->img["des"],"$save");
		} elseif ($this->img["format"]=="GIF") {
			//GIF
			imageGIF($this->img["des"],"$save");
		} elseif ($this->img["format"]=="WBMP") {
			//WBMP
			imageWBMP($this->img["des"],"$save");
		}

	}

	/**
	* @access	public
	* @Upload Inage On Desired Path
	* @para 	$ImageArr,$img_file,$ID,$OldImg
	* @return	$vImage
	*/

	public function ImageUpload($sec,$type,$ID,$img_file,$OldImg)
	{
		global $cfgimg;
		$temp_gallery 		=	SITE_TEMP_UPLOAD_PATH;
		$path				      =	$cfgimg[''.$sec.''][''.$type.'']['path'];
		$ImgConfg 			  = $cfgimg[''.$sec.''][''.$type.'']['imgconfig'];
		$ImgPath			    =	$path.$ID."/";
		$vImage_name		  =	$img_file['name'];
		$vImage				    =	$img_file['tmp_name'];


		if($vImage_name != '')
      {
			/* For Creating Folder Dyanmically*/
				$this->createImageFolder($ID,$path);
			/* Ends Here */
			$time_val 		= 	str_replace(".","",microtime());
			copy($vImage,$temp_gallery.$vImage_name);
			$size_arr = @getimagesize($temp_gallery."/".$vImage_name);
			$thumb	=	$this->thumbnail(SITE_TEMP_UPLOAD_PATH."".$vImage_name);
			//print_r($thumb);exit;
			$i=0;
			foreach($ImgConfg as $ImgConfg)
         {
			//for($i=0;$i<count($ImgConfg);$i++){
				$imagId = $i+1;
				if($ImgConfg['width'] == ""){
					//$width = $size_arr[0];
					copy($vImage,$ImgPath.$imagId."_".$time_val."_".$vImage_name);
				}else{

					$O_width  = $size_arr[0];
					$O_height = $size_arr[1];

					$width 		= $ImgConfg['width'];
					$height 	= $ImgConfg['height'];

					if($O_height > $O_width) {
						$this->size_height($height);
					}else {
						$this->size_width($width);
					}
					//$x = $this->getImageWithRatio($O_width,$O_height,$width,$height);
					$this->jpeg_quality(100);
					$this->save($ImgPath.$imagId."_".$time_val."_".$vImage_name);
				}

			/*	if($ImgConfg[$i]['height'] == ""){
					//$height = $size_arr[1];
				}else{
					$height = $ImgConfg[$i]['height'];

					$this->size_height($height);
					$this->jpeg_quality(100);
					$this->save($ImgPath.$imagId."_".$time_val."_".$vImage_name);
				}*/
				//echo $ImgPath;*/
				//echo $vImage_name."==>".$OldImg."<hr>";
				//if($vImage_name != $OldImg)
				@unlink($ImgPath.$imagId."_".$OldImg);
				$i++;
			}
			$vImage = $time_val."_".$vImage_name;
			@unlink(SITE_TEMP_UPLOAD_PATH."/".$vImage_name);
		}
		else
		{
			$vImage=$OldImg;
		}
		//exit;
		return $vImage;
	}

	/**
	* @access	public
	* @Upload 	Inage On Desired Path
	* @para 	$ImageArr,$img_file,$ID,$OldImg
	* @return	$vImage
	*/

	public function BannerImageUpload($sec,$type,$ID,$img_file,$OldImg)
	{
		global $cfgimg;
		$temp_gallery 		=	SITE_TEMP_UPLOAD_PATH;
		$path				=	$cfgimg[''.$sec.''][''.$type.'']['path'];

		//create temp gallery folder
		$this->createfolder($temp_gallery);

		//create image uploaded folder
		$this->createfolder($path);

		$ImgConfg 			= 	$cfgimg[''.$sec.''][''.$type.'']['imgconfig'];
		$ImgPath			=	$path.$ID."/";
		$vImage_name		=	$img_file['name'];
		$vImage				=	$img_file['tmp_name'];

		if($vImage_name != '')
		{
			/* For Creating Folder Dyanmically*/
				$this->createImageFolder($ID,$path);
			/* Ends Here */
			$time_val 		= 	str_replace(".","",microtime());
			copy($vImage,$temp_gallery.$vImage_name);
			$size_arr = @getimagesize($temp_gallery."/".$vImage_name);

			if(strtolower(substr($vImage_name,-3)) != "swf"){
				$thumb=$this->thumbnail(SITE_TEMP_UPLOAD_PATH."".$vImage_name);
				$i=0;
				foreach($ImgConfg as $ImgConfg){
				//for($i=0;$i<count($ImgConfg);$i++){
					$imagId = $i+1;
					if($ImgConfg['width'] == ""){
						$width = $size_arr[0];
						copy($vImage,$ImgPath.$imagId."_".$time_val."_".$vImage_name);
					}else{
						$width = $ImgConfg['width'];
						$this->size_width($width);
						$this->jpeg_quality(100);
						$this->save($ImgPath.$imagId."_".$time_val."_".$vImage_name);
					}

					//unlink old image
					if(($vImage_name != $OldImg)) // || ($OldImg=='' && $vImage_name==''))
					{
						@unlink($ImgPath.$imagId."_".$OldImg);
					}
					$i++;
				}
			}
			else
			{
				$i=0;
				foreach($ImgConfg as $ImgConfg)
				{
					$imagId = $i+1;
					copy($vImage,$ImgPath.$imagId."_".$time_val."_".$vImage_name);
					//unlink old image
					if($vImage_name != $OldImg)
					@unlink($ImgPath.$imagId."_".$OldImg);
					$i++;
				}
				//unlink old image
				//if($vImage_name != $OldImg)
				//@unlink($ImgPath.$imagId."_".$OldImg);
			}

			//unlink image from temporary gallery
			$vImage = $time_val."_".$vImage_name;
			@unlink(SITE_TEMP_UPLOAD_PATH."/".$vImage_name);
		}
		else
		{
			$vImage=$OldImg;
		}
		return $vImage;
	}

	//Generate 3 images of main


/**
	* @access	public
	* @Create Folder On desired Path
	* @para 	$ID,$path,$type
	* @return	Create Folder
	*/
	public function createImageFolder($ID,$path)
	{
		if(!is_dir($path.$ID)){
			$direc = @mkdir($path.$ID,0777);
			chmod($path.$ID, 0777);
		}
	}

	public function createfolder($path){
		//create image folder if not exists
		$pathfolder = explode("/",str_replace(SPATH_ROOT, "", $path));
		$realpath = "";
		for($p=0;$p<count($pathfolder);$p++){
			if($pathfolder[$p] != ''){
				$realpath = $realpath.$pathfolder[$p]."/";
				$makefolder = SPATH_ROOT."/".$realpath;
				if(!is_dir($makefolder)){
					$makefolder = @mkdir($makefolder,0777);
					@chmod($makefolder, 0777);
				}
			}
		}
		//ends here
		return  $makefolder;
	}

	public function getImageWithRatio($act_width, $act_height,$width=100,$height=100){
		$imagehw_a[0] = $width;
		$imagehw_a[1] = $height;
		if($act_height > $imagehw_a[1] and $act_width > $imagehw_a[0]){
			$r1 = $act_width/$imagehw_a[0];
			$r2 = $act_height/$imagehw_a[1];

			if($r2 >= $r1){
				//echo "asdasd";
				$ratio = (100*$imagehw_a[1]) / $act_height;
				$imagehw_a[0] = ($act_width * $ratio) / 100;
			}
			else{
				$ratio = (100*$imagehw_a[0]) / $act_width;
				$imagehw_a[1] = ($act_height * $ratio) / 100;
			}
		}
		else if($act_height > $imagehw_a[1] and $act_width < $imagehw_a[0]){
			$ratio = (100*$imagehw_a[1]) / $act_height;
			$imagehw_a[0] = ($act_width * $ratio) / 100;
		}
		else if($act_height < $imagehw_a[1] and $act_width > $imagehw_a[0]){
			$ratio = (100*$imagehw_a[0]) / $act_width;
			$imagehw_a[1] = ($act_height * $ratio) / 100;
		}
		else if($act_height < $imagehw_a[1] and $act_width < $imagehw_a[0]){
			$imagehw_a[0] = $act_width;
			$imagehw_a[1] = $act_height;
		}
		$imagehw_a[0] = intval($imagehw_a[0]);
		$imagehw_a[1] = intval($imagehw_a[1]);
		//echo print_r($imagehw_a);
		return $imagehw_a;
	}

	### GENERATE MULTIPLE IMAGE FROM THE CROPPED IMAGE.

	public function CroppedImageUpload($sec,$type,$ID,$img_file,$OldImg)
	{
		global $cfgimg;
		$temp_gallery 		=	SITE_TEMP_UPLOAD_PATH;
		$path				=	$cfgimg[''.$sec.''][''.$type.'']['path'];
		$ImgConfg 			= $cfgimg[''.$sec.''][''.$type.'']['imgconfig'];
		$ImgPath			=	$path.$ID."/";
		$vImage_name		=	$img_file;
		$vImage				=	$ImgPath."/3_".$img_file;
		if($img_file != ''){
			/* For Creating Folder Dyanmically*/
				$this->createImageFolder($ID,$path);
			/* Ends Here */
			$time_val 		= 	str_replace(".","",microtime());
			$size_arr = @getimagesize($ImgPath."/3_".$img_file);
			$thumb	=	$this->thumbnail($ImgPath."/3_".$img_file);
			$i=0;
			foreach($ImgConfg as $ImgConfg){
				$imagId = $i+1;
				if($ImgConfg['width'] == ""){
					//$width = $size_arr[0];
					copy($vImage,$ImgPath.$imagId."_".$vImage_name);
				}else{
					$O_width  = $size_arr[0];
					$O_height = $size_arr[1];

					$width 		= $ImgConfg['width'];
					$height 	= $ImgConfg['height'];

					if($O_height > $O_width) {
						$this->size_height($height);
					}else{
						$this->size_width($width);
					}
					//$x = $this->getImageWithRatio($O_width,$O_height,$width,$height);
					$this->jpeg_quality(100);

					$this->save($ImgPath.$imagId."_".$vImage_name);

				}
				$i++;
			}
			$vImage = $vImage_name;
		}else{
			$vImage=$OldImg;
		}
		return $vImage;
	}

   ##Upload Video Files
	public function videoSnapUpload($ID,$vid_file,$OldVid)
	{
		global $cfgimg;
		$temp_gallery 		=	SITE_TEMP_UPLOAD_PATH;
		$ffmpegPath = "usr/bin/ffmpeg";
		$vid_sec = 'video';
		$vid_type = 'video';
		$snap_sec = 'snapshots';
		$snap_type = 'snapshots';
		## Create Temp Gallery Folder if not Exist.
		$this->createfolder($temp_gallery);
		$video_path			=	$cfgimg[''.$vid_sec.''][''.$vid_type.'']['path'];
		$VidConfg 			= 	$cfgimg[''.$vid_sec.''][''.$vid_type.'']['imgconfig'];
		$snap_path			=	$cfgimg[''.$snap_sec.''][''.$snap_type.'']['path'];
		$SnapConfg 			= 	$cfgimg[''.$snap_sec.''][''.$snap_type.'']['imgconfig'];
		$videoPath			=	$video_path.$ID."/";
		$videoImagePath			=	$snap_path.$ID."/";
		$_file = $vid_file;
		$vFile_name		=	$_file['name'];
		$vFile			=	$_file['tmp_name'];

		//We seems to have problem with upload videos that have special characters in its name or path.
		//For example, videos with apostrophies, single quotes, double quotes, etc, so we have to sanitize.
		$vFile_name = preg_replace('/[^a-z09\.]/i','_',$vFile_name);
		$vFile_name = preg_replace('/\.+/','.',$vFile_name);


		if($vFile_name != ''){
			/* For Creating Folder Dyanmically*/
				$this->createfolder($videoPath);
			/* Ends Here */
			/* For Creating Folder Dyanmically*/
				$this->createfolder($videoImagePath);
			/* Ends Here */
			$time_val 		= 	"";
			$currVidName = $VidConfg[0]['ID']."_".str_replace(" ","_",$vFile_name);
			$StoreName = str_replace(" ","_",$vFile_name);
			$db_storeName = substr($StoreName,0,-4);
			copy($vFile,$temp_gallery.$currVidName);

			$FromVideoPath = $temp_gallery.$currVidName;
			$fileNameOnly = substr($currVidName,0,-4);
			$filesExtension = strtolower(substr($currVidName,-4));
			$video_inputpath = ''.$FromVideoPath.'';
			$video_outputpath= ''.$videoPath.$fileNameOnly.'.flv';

			$op_video_format = "flv";  	#[SET OUT PUT FLV FORMAT]#
			$widthheight =  $VidConfg[0]['width'].'x'.$VidConfg[0]['height'];
			$video_size = $widthheight;	#[SET THE SIZE OF THE O/P VIDEO]#
			$video_ar = "44100"; 		#[Set the audio sampling frequency (default = 44100 Hz)]#
			$video_ab =  "64k";			#[Set the audio bitrate in bit/s (default = 64k).]#
			$video_ac =  "1";			#[Set the number of audio channels (default = 1). ]#
			$video_b = "300k"; 			#[Set the video bitrate in bit/s (default = 200 kb/s).]#
			$video_r = "10";			#[Set frame rate (Hz value, fraction or abbreviation), (default = 25).]#

			if($filesExtension != '.flv'){
				$ss = ''.$ffmpegPath.' -i '.$video_inputpath.' -ab '.$video_ab.' -ac '.$video_ac.' -ar '.$video_ar.' -s '.$video_size.'  -f '.$op_video_format.' -b '.$video_b.' -r '.$video_r.' '.$video_outputpath.'';
            echo  $ss;
				$convert = system($ss,$retval);
			}else{
				copy($video_inputpath,$video_outputpath);
			}
			//unlink old image
			if($db_storeName != $OldVid)
				@unlink($videoPath.$VidConfg[0]['ID']."_".$OldVid.".flv");
			@unlink(SITE_TEMP_UPLOAD_PATH."/".$currVidName);
		}
      else
      {
			$vVideo=$OldVid;
		}
		return $vVideo;
	}

    /**
	* @access	public
	* @Upload Inage On Desired Path
	* @para 	$ImageArr,$img_file,$ID,$OldImg
	* @return	$vImage
	*/

	public function UploadFile($sec,$type,$ID,$img_file,$OldImg)
	{
		global $cfgimg;
		$temp_gallery 		=	SITE_TEMP_UPLOAD_PATH;
		$path				      =	$cfgimg[''.$sec.''][''.$type.'']['path'];
		$ImgConfg 			  = $cfgimg[''.$sec.''][''.$type.'']['imgconfig'];
		$ImgPath			    =	$path.$ID."/";
		$vImage_name		  =	$img_file['name'];
		$vImage				    =	$img_file['tmp_name'];

        //Prints($vImage_name);exit;
        $validArr = array(".jpg",'jpeg','.gif','.png','.ttf','.bmp','.pdf','.doc','.rtf','docx','.csv','.xml');
        $ext = substr($vImage_name,-4);
        //echo $ext;exit; 
        if(in_array(strtolower($ext),$validArr)){        
            
    		if($vImage_name != ''){
    		      //echo "ok";exit;
    			/* For Creating Folder Dyanmically*/
    				$this->createImageFolder($ID,$path);
    			/* Ends Here */
    			$time_val 		= 	str_replace(".","",microtime());
                            //print "$vImage,$temp_gallery.$vImage_name<br>";
    			copy($vImage,$temp_gallery.$vImage_name);
    			$size_arr = @getimagesize($temp_gallery."/".$vImage_name);
    			$i=0;
    			foreach($ImgConfg as $ImgConfg) {
    				$imagId = $i+1;
    				copy($vImage,$ImgPath.$imagId."_".$time_val."_".$vImage_name);
    				@unlink($ImgPath.$imagId."_".$OldImg);
    				$i++;
    			}
            //$vImage = $time_val."_".$vImage_name;
    			$vImage = $imagId."_".$time_val."_".$vImage_name;
    			@unlink(SITE_TEMP_UPLOAD_PATH."/".$vImage_name);
    		}
    		else
    		{
    			$vImage=$OldImg;
    		}        
        }else{
             //echo "ok11";exit;   
            $vImage='';
        }
        //echo $vImage;exit;
		//exit;
		return $vImage;
	}
}
?>