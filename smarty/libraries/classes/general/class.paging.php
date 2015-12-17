<?php
/*
 * @package  Paging
 * @version  1.0 beta
 * @Last changed:   May 03 2008
 * PHP 5
 **/

class Paging extends Smarty
{
	var  $page_limit;	//set page limit 
	var  $rec_limit;	//set rec limit per page
	var  $totrec;		//tot record for paging
	var  $totpages;		//total pages to display
	var  $start;
	var  $page_string;
	var  $var_limit;


	/**
	 *@ intiliaze paging class & vars
	 *@ no return values
	 */

	public function __construct($tot_rec)
	{
		//intiailaze variables here & methods
		$this->setStart();				//set start
		$this->setTotalRecord($tot_rec);		//set total record
		$this->setRecordLimit();				//set record limit
		$this->setPageLimit();					//set total page limit
		$this->setTotalPages($tot_rec);			//set total pages
		
	}

	/**
	 *@ private set start from
	 *@ return start value
	 */

	public function setStart()
	{
		$start = GetVar('st');
		if($start == '')
			return $this->start = 1;
		else
			return $this->start = $start;
	}

	/**
	 *@ private set total record
	 *@ return total record
	 */

	 public function setTotalRecord($tot_rec)
	 {
		if($tot_rec == "")
			return $this->totRec = 0;
		else 
			return $this->totRec = $tot_rec;
	}

	/**
	 *@ private set total record limit per page
	 *@ return total record limit per page
	 */

	public function setRecordLimit()
	 {
		global 	$FRONT_REST_ITEM_LIMIT,$REC_LIMIT_FRONT;
	 	switch($_GET['file'])
		{
			case "c-detail":
			{
				$this->rec_limit = $FRONT_REST_ITEM_LIMIT;
				break;
			}
			default :
			{
				$this->rec_limit = $REC_LIMIT_FRONT;
				break;
			}
		}
		return $this->rec_limit;
	}

	/**
	 *@ private set totapages of listing
	 *@ return total pages
	 */

	 public function setTotalPages($tot_rec){
		return $this->totPages = ceil($this->totRec/$this->rec_limit);
		
	}

	/**
	 *@ private set pagelimit 
	 *@ return page limit
	 */

	 public function setPageLimit(){
		return $this->page_limit = 2;
	}


	/**
	 *@ public set setvarlimit 
	 *@ return var_limit
	 */

	 public function setVarlimit()
	 {
		if($this->start != 0)
		{
			$num_limit = ($this->start-1)*$this->rec_limit;
			$this->var_limit = " LIMIT $num_limit, ".$this->rec_limit."";
		}
		else
		{
			$this->var_limit = " LIMIT 0, ".$this->rec_limit."";
		}

		return $this->var_limit;
	 }

	/**
	 *@ public display paging 
	 *@ return paging string
	 */

	public function displayPaging()
	{
		//page string
		$this->page_string = "";

		//page limit;
		$page_limit = $this->page_limit;

		//total pages
		$tot_pages = $this->totPages;

		//loop limit
		$loop_limit = (($page_limit > $tot_pages) ? $tot_pages : $page_limit) ;

		//starting loop
		$start_loop = floor($this->start/$page_limit);

		//calculate start loop
		if($start_loop != ($this->start/$page_limit))
			$start_loop = $start_loop * $page_limit+1;
		else
			$start_loop = ($start_loop-1) * $page_limit+1;

		//pages link to set
		$REQUEST_URI = $_SERVER['REQUEST_URI'];
		$urltail = (str_replace(SITE_FOLDER, "", $REQUEST_URI));
		$urltrail = explode("/",$urltail);

		if(GetVar('st') == '')
			$pars = count($urltrail);
		else
			$pars = count($urltrail)-1;

		for($j=0; $j<$pars; $j++)
		{
			if($linkst !='')
			$linkst.="/";
			$linkst.= $urltrail[$j];
		}
		//ends here

		//set here prevlink
		$prevlink = SITE_URL_DUM.$linkst."/".($this->start-1);
		//

		//set here next link
		$nextlink = SITE_URL_DUM.$linkst."/".($this->start+1);
		//

		if($start_loop > $page_limit)
		{
			$prev_loop = $start_loop - 1;
			$this->page_string.="<a href='".$prevlink."' class='paginglink' title='Previous'><b>Previous</b></a>";
	    }

		for($loop=1 ; $loop<=$loop_limit ; $loop++)
		{
			$pagelink = SITE_URL_DUM.$linkst."/".$start_loop;
			if($start_loop > $tot_pages) break;
			if($start_loop == $this->start)
				$this->page_string.="<span class='paging-active' ><b>".$start_loop."</b></span>";
			else
				$this->page_string.="<a href='".$pagelink."' title=\"".$start_loop."\" class='paginglink' ><b>".$start_loop."</b></a>";
			$start_loop++;	
		}

		if($start_loop<=$tot_pages)
			$this->page_string.="<a href='".$nextlink."'; class='paginglink' title='Next'><b>Next</b></a>";
		return $this->page_string;
	}
	
	/**
	 *@ public display paging message
	 *@ return paging message
	 */
	public function setMessage($msg='')
	{
		$rec_limit = $this->rec_limit;
		$num_limit = ($this->start-1)*$rec_limit;
		$startrec = $num_limit;
		$lastrec = $startrec + $rec_limit;
		$startrec = $startrec + 1;
		if($lastrec > $this->totRec)
			$lastrec = $this->totRec;
		if($this->totRec > 0 ){
			return $recmsg = " Displaying ".$startrec." - ".$lastrec." ".strtolower($msg)." of ".$this->totRec;
		}else{
			return $recmsg="No ".strtolower($msg)." found";
		}
	}
}
?>