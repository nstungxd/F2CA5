<?php
/**
 * 	Home Page
 *	@Created Date	2nd-jan-09
 * 	@package		addhome.inc.php
 *	@section		main/general
 * 	@author		D i p a k
*/
define( '_'.PRJ_CONST_PREFIX.'XEC', 1);

$parts = dirname(__FILE__);
$partsarr = strstr($parts, '/cpanel');
$DirFile = str_replace($partsarr,"",$parts);

//Set here Base Path
define('SPATH_BASE',$DirFile);
include_once("".SPATH_BASE."/web.config.php");

$data=array();
// include_once(SITE_OFC.'ofc-library/open-flash-chart.php');

$bar = new bar_outline( 50, '#1D6DC2', '#000000' );
$max=0;

$sql = "SELECT pr.vProdName, count( ord.iOrderId ) AS Totodr
FROM ".PRJ_DB_PREFIX."_product AS pr, ".PRJ_DB_PREFIX."_order AS ord
WHERE pr.iProductId = ord.iProductId
GROUP BY ord.iProductId
ORDER BY ord.iOrderId DESC
LIMIT 0 , 5";

$db_sql =$dbobj->MySQLSelect($sql);

for($i=0;$i<count($db_sql);$i++)
{

	$data[] = substr(stripslashes($db_sql[$i]['vProdName']),0,8)."...";
	$Adata = $db_sql[$i]['Totodr'];
	$tip="Product Name : ".$db_sql[$i]['vProdName']."<br>";
	$tip.="Total Order : ".$db_sql[$i]['Totodr']."<br>";

  $bar->add_data_tip( $Adata, $tip );
	if($max != $db_sql[$i]['Totodr'])
	{
		if($max < $db_sql[$i]['Totodr'])
			$max = $db_sql[$i]['Totodr'];
	}
}

$g = new graph();
$g->bg_colour = 'FBFBFB';
$g->title( 'Most Ordered Product ', '{font-size: 18px;}' );
$g->set_tool_tip( '#tip#' );
$g->data_sets[] = $bar;
$g->set_x_labels( $data );
$g->set_x_label_style( 10, '#000000', 2, 1 );
$g->set_x_axis_steps( 1 );
$g->set_y_max($max);
$g->y_label_steps(5);
$g->set_y_label_style( 10, '#000000');
$g->set_y_legend( 'Total Order', 12, '#000000' );
echo $g->render();
?>
