<?php  
$iId = $_GET['iId'];
$hover_type = $_GET['hover_type'];
$lang= $gdbobj->getLanguage();
switch($hover_type){
	case "languagelebel":
		$sql ="SELECT *
				FROM ".PRJ_DB_PREFIX."_lang_lable
				WHERE iLabelId = '".$iId."'";
	break;
}
$dbsql = $dbobj->MySQLSelect($sql);
//Prints($dbsql);exit;
?>
<style>
.small-fonts{
font:Arial, Helvetica, sans-serif;
font-size:10px;
color:#999999;
}
</style>
<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr >
    <td align="left" valign="top" id="dispTooltipId_<?php  echo  $iId?>">
		<table width="100%" border="0" cellpadding="1"  cellspacing="1">
        <tr>
			<td valign="top" class="small-fonts">
				<table width="100%" border="0" cellpadding="1"  cellspacing="1">
				<tr>
				  <td><strong>Modified / Add date :</strong>
					<i><?php  echo  Time_Format($dbsql[0]['dDate'])?></i>
				  </td>
				</tr>
				<?php   for($l=0;$l<count($lang);$l++) {?>
               <tr>
   				  <td valign="top"><strong>Label Value [<?php  echo  $lang[$l]['vLanguage']?>]:</strong>
   					<?php  echo  nl2br(stripslashes($dbsql[0]['vValue_'.$lang[$l]['vLanguageCode'].'']))?>
   				  </td>
   				</tr>
            <?php   }?>
				</table>
			</td>
		</tr>

      </table>
	 </td>
</tr>
</table>
<script type="text/javascript">
//alert(document.getElementById('dispTooltipId_<?php  echo  $iId?>').offsetHeight);
parent.document.getElementById('tooltip_<?php  echo  $iId?>').style.height = (document.getElementById('dispTooltipId_<?php  echo  $iId?>').offsetHeight)+10+"px";
parent.document.getElementById('ifrasmes_<?php  echo  $iId?>').style.height = (document.getElementById('dispTooltipId_<?php  echo  $iId?>').offsetHeight)+10+"px";
</script>
<?php   exit;;?>