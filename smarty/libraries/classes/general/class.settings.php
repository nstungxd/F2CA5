<?php  
/**
 * This Class is useful for menus 
 * @package		class.settings.php
 * @general		general
 */


class Settings extends General
{
	private $ele;


	public function __construct(){}

	public function disValue($arr)
	{
		$type = $arr['eDisplayType'];
		$name = $arr['vName'];
		$value = $arr['vValue'];
		global $dbobj,$generalobj;

		switch($type)
		{
			case  "text":
			   $this->ele = $generalobj->PrintElement($name,$name,$value,"text");
				break;

			case  "textarea":
			   $this->ele = $generalobj->PrintTextArea($name,$name,$value,"cols='50' rows='4'");
			   break;

			case  "selectbox":
				$this->ele = '';
				
                $this->ele.= "<select name=".$name." id=".$name." class='input1' >";                
				if($arr["eSource"] == 'List')
				{
					$Source_Arr = explode(",",$arr["vSourceValue"]);
					$nSource_List = count($Source_Arr);
                    
					for($j=0;$j<$nSource_List;$j++)
					{
						$list_arr = (isset($Source_Arr[$j]))?explode("::",$Source_Arr[$j]):"";
                        
						if((!isset($list_arr[1])) || $list_arr[1] == ""){
						  $list_arr[1] = $list_arr[0];
						}
						if($value == $list_arr[0])
							$selected = "selected";
						else
							$selected = "";
                            
                        $value_val  = (isset($list_arr[0]))?$list_arr[0]:"";    
                        $disp_val = (isset($list_arr[1]))?$list_arr[1]:"";
                        //Prints($value_val);
						$this->ele.= "<option $selected value=".$value_val.">".$disp_val."</option>";
					}
				}
				else
				{
					$db_selectSource_rs = $dbobj->MySQLSelect($arr["vSourceValue"]);
					for($j=0;$j<count($db_selectSource_rs); $j++)
					{
						if($value == $db_selectSource_rs[$j]['vValue'])
							$selected = "selected";
						else
							$selected = "";
                        $value_val  = (isset($db_selectSource_rs[$j]['vValue']))?$db_selectSource_rs[$j]['vValue']:"";    
                        $disp_val = (isset($db_selectSource_rs[$j]['vText']))?$db_selectSource_rs[$j]['vText']:"";                                
						$this->ele.= "<option   value='".$value_val."' $selected>".$disp_val."</option>";
					}


				}
				$this->ele.= "</select>";


		}
		return  $this->ele;
	}
}
?>