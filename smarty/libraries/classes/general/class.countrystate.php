<?php
/**
 * This Class is for Country State relations
 * @package		class.general.php
 * @general		general
*/

Class CountryState
{
	public function __construct(){}


	/**
	* @Create an Array For Displaying in Combo
	* @para 	$table,$where,$combVal,$combText,$iCompId
	* @return	$retres
	*/

	public function getgeneralArr($table,$where,$combVal,$combText,$iCompId,$fields,$ext=""){
		global $generalobj;
		$rescatArr = $generalobj->getTableInfo($table,$where,$fields,'','');
		$resarr = "";
		$checkres = array();
		for($j=0; $j<count($rescatArr); $j++)
		{
			if($j == count($rescatArr) -1){
				$resarr .= "[";
				$resarr .= "['".addslashes($rescatArr[$j][''.$combVal.'']) ."'],['".addslashes($rescatArr[$j][''.$combText.''])."'],['".addslashes($rescatArr[$j][''.$iCompId.''])."']";
				if($ext != ""){
					$resarr .= ",['".addslashes($rescatArr[$j][''.$ext.''])."']";
				}
				$resarr .= "]";
			}else{
				$resarr .= "[";
				$resarr .= "['".addslashes($rescatArr[$j][''.$combVal.'']) ."'],['".addslashes($rescatArr[$j][''.$combText.''])."'],['".addslashes($rescatArr[$j][''.$iCompId.''])."']";
				if($ext != ""){
					$resarr .= ",['".addslashes($rescatArr[$j][''.$ext.''])."']";
				}
				$resarr .= "],";

				//$resarr .= "[['".addslashes($rescatArr[$j][''.$combVal.'']) ."'],['".addslashes($rescatArr[$j][''.$combText.''])."'],['".addslashes($rescatArr[$j][''.$iCompId.''])."']],";
			}
			$checkres[]= $rescatArr[$j][''.$combVal.''];
		}
		$retrest=array();
		$retres[0]=$resarr;
		$retres[1]=$checkres;
		return $retres;
	}

	/* Get City Array to display on combo */
	function getCityArr($table,$where,$combVal,$combText,$iCompId,$fields){
		global $generalobj;
		$comptemp="";
		$rescatArr = $generalobj->getTableInfo($table,$where,$fields,'',' ORDER BY '.$combVal.'');
		$resarr = "";
		for($j=0; $j<count($rescatArr); $j++)
		{
			if($comptemp != $rescatArr[$j][''.$iCompId.''] || $comptemp1 != $rescatArr[$j][''.$combVal.'']){
				if($j == count($rescatArr) -1){
					$resarr .= "[['".addslashes($rescatArr[$j][''.$combVal.'']) ."'],['".addslashes($rescatArr[$j][''.$combText.''])."'],['".addslashes($rescatArr[$j][''.$iCompId.''])."']]";
				}else{
					$resarr .= "[['".addslashes($rescatArr[$j][''.$combVal.'']) ."'],['".addslashes($rescatArr[$j][''.$combText.''])."'],['".addslashes($rescatArr[$j][''.$iCompId.''])."']],";
				}
			}
			$comptemp = $rescatArr[$j][''.$iCompId.''];
			$comptemp1 = $rescatArr[$j][''.$combVal.''];
			$checkres[]= $rescatArr[$j][''.$combVal.''];
		}
		$retrest=array();
		$retres[0]=$resarr;
		$retres[1]=$checkres;
		return $retres;
	}

	/* Get Zip Array to display on combo */
	function getZipArr($table,$where,$combVal,$combText,$iCompId,$extid,$fields){
		global $generalobj;
		$comptemp="";
		$rescatArr = $generalobj->getTableInfo($table,$where,$fields,'',' ORDER BY '.$combVal.'');
		$resarr = "";
		for($j=0; $j<count($rescatArr); $j++)
		{
			if($j == count($rescatArr) -1){
				$resarr .= "[['".addslashes($rescatArr[$j][''.$combVal.'']) ."'],['".addslashes($rescatArr[$j][''.$combText.''])."'],['".addslashes($rescatArr[$j][''.$iCompId.''])."'],['".addslashes($rescatArr[$j][''.$extid.''])."']]";
			}else{
				$resarr .= "[['".addslashes($rescatArr[$j][''.$combVal.'']) ."'],['".addslashes($rescatArr[$j][''.$combText.''])."'],['".addslashes($rescatArr[$j][''.$iCompId.''])."'],['".addslashes($rescatArr[$j][''.$extid.''])."']],";
			}

			$checkres[]= $rescatArr[$j][''.$combVal.''];
		}
		$retrest=array();
		$retres[0]=$resarr;
		$retres[1]=$checkres;
		return $retres;
	}

	/* New State City Combo By Ajax + File Write */

	/* Ends Here */
}
?>