<?php
class Breadcrumb
{
	private $_trail;
	private $ts;

	//intialize variables here for breadcrumbs
	public function __construct(){}


	public function add($title,$link,$st = 'yes')
	{
		global $smarty;

		if($st == 'yes')
			$title = $smarty->get_template_vars($title);

		$this->_trail[] = array('title' => $title, 'link' => $link);

		$this->ts = '';

		for ($i=0, $n= sizeof($this->_trail); $i<$n; $i++) 
		{
			if (isset($this->_trail[$i]['link']) && $this->_trail[$i]['link'] != "")
			{
				$this->ts.= '<a href="' . $this->_trail[$i]['link'] . '" title="'.$this->_trail[$i]['title'].'">' . $this->_trail[$i]['title'] . '</a>';
			}
			else
			{
				$this->ts.= $this->_trail[$i]['title'];
			}
			if (($i+1) < $n) $this->ts .= " &raquo; ";
		}
		return $smarty->assign("bcst",$this->ts);
	}
}
?>
