<?php
/*
 * @package  Paging
 * @Last changed:   Feb 08 2008
 * PHP versions 4 and 5
 **/

class Paging
{
	private  $page_limit;	//set page limit
	private  $rec_limit;	//set rec limit per page
	private  $totRec;		//tot record for paging
	private  $totPages;		//total pages to display
	private  $start;
	private  $page_string;


	/**
	 *@ intiliaze paging class & vars
	 *@ no return values
	 */

	function __construct($tot_rec,$start,$functoCall='',$res_limits='')
	{
		//intiailaze variables here & methods
		$this->setStart($start);				//set start
		$this->setTotalRecord($tot_rec);		//set total record
		$this->setRecordLimit($res_limits);				//set record limit
		$this->setPageLimit();					//set total page limit
		$this->setTotalPages($tot_rec);			//set total pages
		$this->JSFunc = $functoCall;
	}

	/**
	 *@ private set start from
	 *@ return start value
	 */

	private function setStart($start){
	   if($start == "0")
			return $this->start = 0;
		else
			return $this->start = $start;
	}

	/**
	 *@ private set total record
	 *@ return total record
	 */

	private function setTotalRecord($tot_rec){
		if($tot_rec == "")
			return $this->totRec = 0;
		else
			return $this->totRec = $tot_rec;
	}

	/**
	 *@ private set total record limit per page
	 *@ return total record limit per page
	 */

	private function setRecordLimit($res_limits)
  {
		global 	$REC_LIMIT_FRONT;
		if($res_limits == ''){
              $this->rec_limit = $REC_LIMIT_FRONT;
        }else{
              $this->rec_limit = $res_limits;
        }
		return $this->rec_limit;
	}

	/**
	 *@ private set totapages of listing
	 *@ return total pages
	 */

	private function setTotalPages($tot_rec){
	    return $this->totPages = ceil($this->totRec/$this->rec_limit);
	}

	/**
	 *@ private set pagelimit
	 *@ return page limit
	 */

	private function setPageLimit(){
		global $FPLIMIT;
		return $this->page_limit = 1;
	}


	/**
	 *@ public display paging
	 *@ return paging string
	 */

	public function displayPaging()
	{
		$this->page_string = "";
		$page_limit = $this->page_limit;
		$tot_pages = $this->totPages;
		$loop_limit = (($page_limit > $tot_pages) ? $tot_pages : $page_limit) ;

		$start_loop = floor($this->start/$page_limit);

		if($start_loop != ($this->start/$page_limit))
			$start_loop = $start_loop * $page_limit+1;
		else
			$start_loop = ($start_loop-1) * $page_limit+1;

		$this->page_string.="<div id='paging' align='right'>";

		if($start_loop > $page_limit)
		{
			$prev_loop = $start_loop - 1;
			$this->page_string.="<a href='javascript:".$this->JSFunc."(\"".$prev_loop."\");' title='Previous' class = 'link2'><b>Previous</b></a>   <span class='margin1'>|</span>";
	    }
		for($loop=1 ; $loop<=$loop_limit ; $loop++)
		{
			if($start_loop > $tot_pages) break;
			if($start_loop == $this->start)
				$clas = "paging-active";
			else
				$clas = "paginglink";
			//$this->page_string.="<a href='javascript:".$this->JSFunc."(\"".$start_loop."\");' title=\"".$start_loop."\" class=".$clas." ><b>".$start_loop."</b></a>";
			//$this->page_string.="<a href='javascript:".$this->JSFunc."(\"".$start_loop."\");' title=\"".$start_loop."\" class=".$clas." ><b>".$start_loop."</b></a>";
			$this->page_string.="Page ".$start_loop." of ".$tot_pages."";
			$start_loop++;
		}

		if($start_loop<=$tot_pages)
			$this->page_string.="   <span class='margin1'>|</span><a href='javascript:".$this->JSFunc."(\"".$start_loop."\");'; title='Next' class = 'link2';><b>Next</b></a>&nbsp;";
		$this->page_string.="</div>";
		return $this->page_string;
	}

	/**
	 *@ public display paging message
	 *@ return paging message
	 */
	public function setMessage($msg)
	{
		global $smarty;
		
		$rec_limit = $this->rec_limit;
		if($this->start == '0' || $this->start == '' || $this->start < 0)
			$this->start = 1;

      $num_limit = ($this->start-1)*$rec_limit;

      $startrec = $num_limit;
		$lastrec = $startrec + $rec_limit;
		$startrec = $startrec + 1;
		if($lastrec > $this->totRec)
			$lastrec = $this->totRec;

		if($this->totRec > 0 ) {
			if(isset($smarty) && $smarty!='' && $smarty->get_template_vars('LBL_SHOWING')!='') {
				return $recmsg = $smarty->get_template_vars('LBL_SHOWING')." ".$startrec." - ".$lastrec." ".ucfirst(strtolower($msg))." of ".$this->totRec;
			} else {
				return $recmsg = $smarty->get_template_vars('LBL_SHOWING')." ".$startrec." - ".$lastrec." ".ucfirst(strtolower($msg))." of ".$this->totRec;
			}
		} else {
			if(isset($smarty) && $smarty!='' && $smarty->get_template_vars('LBL_SHOWING')!='') {
				return $recmsg = $smarty->get_template_vars('LBL_NO')." ".$msg." ".$smarty->get_template_vars('LBL_FOUND');
			} else {
				return $recmsg = "No ".$msg." Found";
			}
		}
	}

	public function displayPagingWithoutNo()
	{
		$this->page_string = "";
		$page_limit = $this->page_limit;
		$tot_pages = $this->totPages;
		$loop_limit = (($page_limit > $tot_pages) ? $tot_pages : $page_limit) ;

		$start_loop = floor($this->start/$page_limit);

		if($start_loop != ($this->start/$page_limit))
			$start_loop = $start_loop * $page_limit+1;
		else
			$start_loop = ($start_loop-1) * $page_limit+1;

		//$this->page_string.="<div id='paging' align='right'>";

		if($start_loop > $page_limit)
		{
			$prev_loop = $start_loop - 1;
			$npArr['prev']=$this->JSFunc."(\"".$prev_loop."\");";
	    }

		for($loop=1 ; $loop<=$loop_limit ; $loop++)
		{
			if($start_loop > $tot_pages) break;
			if($start_loop == $this->start)
				$clas = "paging-active";
			else
				$clas = "paginglink";
			//$this->page_string.="<a href='javascript:".$this->JSFunc."(\"".$start_loop."\");' title=\"".$start_loop."\" class=".$clas." ><b>".$start_loop."</b></a>";
			//$this->page_string.="<a href='javascript:".$this->JSFunc."(\"".$start_loop."\");' title=\"".$start_loop."\" class=".$clas." ><b>".$start_loop."</b></a>";
			//$this->page_string.="Page ".$start_loop." of ".$tot_pages."";
			$start_loop++;
		}
		//echo $start_loop."==>".$tot_pages;exit;
		if($start_loop <= $tot_pages)
			$npArr['next']=$this->JSFunc."(\"".$start_loop."\");";
		//$this->page_string.="</div>";
		return $npArr;
	}

	public function getListPG($pg)
   {
		global $smarty;
		
      $pgmsg = '';
		$total = $this->totRec;
		$limit = $this->rec_limit;
      if($pg == '' || $pg == 0)
      {
         $pg = 1;
      }
      //$totalpg = ceil($total/$limit);
		$totalpg = $this->totPages;
		
      if($totalpg > 1)
      {
			if(isset($smarty) && $smarty!='' && $smarty->get_template_vars('LBL_PAGES')!='') {
				$pgmsg .= $smarty->get_template_vars('LBL_PAGES').' : &nbsp;&nbsp;';
			} else {
				$pgmsg .= 'Pages : &nbsp;&nbsp;';
			}
         if($pg <= 5) {
            $st = 1;
         } else {
            $st = (int) (((int)($pg/5))*5);
			}
			if($pg%5>0 && $pg>5) {
				$st = $st+1;
			} else if($pg%5==0 && $pg>5) {
				$st = ($pg-4);
			}

         $lp = ((($st-1)+5) >= $totalpg)? $totalpg : (($st-1)+5);
         $prv = ($pg-1);
         $nxt = ($pg+1);

         if($pg > 1)
			{
            //$pgmsg .= "<li $class><a href='".SITE_URL_DUM.$pgnm."/$id/$prv' style='cursor:pointer;'>Previous</a></li>";
            $pgmsg .= "<a class='pointer' onclick='".$this->JSFunc."(1);' > &Iota;< </a><a class='pointer' onclick='".$this->JSFunc."($prv);'> < </a>";
//          break;
         }

         for($l=$st;$l<=$lp;$l++)
         {
            $class = '';
            if($l == $pg)
            {
					$pgmsg .= "<span>$l</span>";
            }
				else
				{
					$pgmsg .= "<a class='pointer' onclick='".$this->JSFunc."($l);'>$l</a>";
				}
         }
         if($pg < $totalpg)
         {
				$pgmsg .= "<a class='pointer' onclick='".$this->JSFunc."($nxt);'> > </a><a class='pointer' onclick='".$this->JSFunc."($totalpg);'> >&Iota; </a>";
         }
         $pgmsg .= '';
      }
      return $pgmsg;
   }
}
?>