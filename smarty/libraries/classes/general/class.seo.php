<?php
//class  for performing seo operation
class SEO
{
	//constructor intialize vars and functions
	function __construct($prefix,$scr,$id,$PageType="")
	{

		$this->prefix 	= $prefix;
		$this->scr 			= $scr;
		$this->id 			= $id;
		$this->PageType 			= $PageType;

		$this->secarr 	= $this->setsecinfo();
		$this->metainfo = $this->getsecmetainfo();
	}

	//function to set tables and primary ids
	function setsecinfo()
	{
		global $smarty;
		$prefix =	$this->prefix;
		$scr	=	$this->scr;
		$flag = "";
		$title = "";
		$table = "";
		$priId = "";
		$pridVal = "";
		//echo $scr;
		switch($prefix)
		{
			//Section
			case "c":
				switch($scr)
				{
					case "home":
						$title 	=	"Home";
						$flag 	=	0;
					break;
					case "aboutus":
						$title 	=	"About Us";
						$flag 	=	0;
					break;
					case "contactus":
						$title 	=	"Contact Us";
						$flag 	=	0;
					break;
					case "help":
						$title 	=	"Help";
						$flag 	=	0;
					break;
					case "privacypolicy":
						$title 	=	"Privacy Policy";
						$flag 	=	0;
					break;
					case "faq":
						$title 	=	"Frequently asked questions";
						$flag 	=	0;
					break;
					case "overview":
						$title 	=	"Overview";
						$flag 	=	0;
					break;
					case "overview":
						$title 	=	"Overview";
						$flag 	=	0;
					break;
					case "termsofservice":
						$title 	=	"Terms Of Service ";
						$flag 	=	0;
					break;

				}
			break;
			case "cus":
				switch($scr)
				{
					case "myaccount":
						$title 	=	"All Product";
						$flag 	=	0;
					break;
					case "login":
						$title 	=	"Customer Login";
						$flag 	=	0;
					break;
					case "register":
						$title 	=	"Customer Registration";
						$flag 	=	0;
					break;
					case "changepass":
						$title 	=	"Change Your Password";
						$flag 	=	0;
					break;
				}
		}

		$secarr['title'] 	= $title;
		$secarr['table'] 	= $table;
		$secarr['priId'] 	= $priId;
		$secarr['pridVal'] 	= $pridVal;
		$secarr['flag'] 	= $flag;
		return $secarr;
	}

	//get Section Metatag Info
	function getsecmetainfo()
	{
		global $dbobj,$SITE_NAME,$SITE_TITLE,$META_KEYWORD,$META_DESCRIPTION;

		$secarr = $this->secarr;


		if($secarr['flag']  =='0')
		{
			$tTitle 			= $secarr['title']." - ".$SITE_NAME;
			$tKeyword 			= $secarr['title'];
			$vMeta_Description 	= $secarr['title'];
		}
		else if($secarr['flag']  =='1')
		{

			$sql_seo 			= 	"SELECT tTitle,tKeyword,vMeta
												FROM ".$secarr['table']."
												WHERE ".$secarr['priId']." = '".$secarr['pridVal']."'";
			$db_seo 			=  	$dbobj->MySQLselect($sql_seo);

			$tTitle 			= 	$db_seo[0]['tTitle']." - ".$SITE_NAME;
			$tKeyword 			= 	$db_seo[0]['tKeyword'];
			$vMeta_Description 	= 	$db_seo[0]['vMeta'];

		}else{
			$tTitle 			= $SITE_TITLE;
			$tKeyword 			= $META_KEYWORD;
			$vMeta_Description 	= $META_DESCRIPTION;
		}
		//echo "<pre>";
		//print_r($tTitle);exit;

		$metaarr['tTitle']				=	$tTitle;
		$metaarr['tKeyword']			=	$tKeyword;
		$metaarr['vMeta_Description']	=	$vMeta_Description;
		return $metaarr;
	}

	//return Section Metatag Array
	function getmetaarray()
	{
		return $this->metainfo;
	}
}
?>