<?php

include(S_SECTIONS."/member/memberaccess.php");

/**
 * @author hidden
 * @copyright 2010
 */

if(!isset($UsrObj)) {
	require_once(SITE_CLASS_APPLICATION."user/class.OrganizationUser.php");
	$UsrObj = new OrganizationUser;
}

$key = (isset($_GET['q']))? $_GET['q'] : '';
$userid = (isset($_GET['userid']))? $_GET['userid'] : '';
$type = $_GET['type'];
$iId = $_GET['iId'];
$name = (isset($_GET['name']))? $_GET['name'] : '';
//$userid = $_GET['userid'];


if($name != '') {
    $where.=' AND (vFirstName LIKE "%'.$name.'%" OR vLastName LIKE "%'.$name.'%") AND eStatus = "Active"';
} else {
     $where.=' AND iUserID IN ('.$userid.') AND eStatus = "Active"';
}
if($_SESSION['SESS_'.PRJ_CONST_PREFIX.'_USER_TYPE_SHORT'] == 'OA') {
     $where .= " AND (iOrganizationID='".$_SESSION['SESS_'.PRJ_CONST_PREFIX.'_ORGID']."')";
} else {
	if(trim($iId) != '' && is_numeric($iId)) {
		$where .= " AND iOrganizationID=$iId";
	}
}

$where .= " AND eUserType = 'User'";
$res = $UsrObj->getDetails("CONCAT(vFirstName,' ',vLastName) as vTitle,iUserID as Id",$where);
// Prints($res);exit;
$html="";
?>
<?php  
if(count($res) > 0) {
   $i=0;
   $html='';
   $html.='<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="blue-hadd-bg">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
               <td width="5" height="26" >&nbsp;';
                         if($userid != '') {
						$html.='<input type="checkbox" class="radib-btn" name="uid_chkall" id="uid_chkall" style="vertical-align:middle;" checked="true"/>';
                         } else {
                              $html.='<input type="checkbox" class="radib-btn" name="uid_chkall" id="uid_chkall" style="vertical-align:middle;" />';
                         }
					$html.='</td>
               <td width="94%">Name</td>
              </tr>
            </table>
				</td>
          </tr>
          <tr>
            <td><div style="height:103px;" overflow:"auto" class="scrollbar " >
                <table width="100%" border="0" cellspacing="0" cellpadding="0">';
                if(is_array($res) && count($res)>0) {
                   foreach($res as $arr) {
                      $html.='<tr class="golden-bg">
                                <td width="5" height="26" >&nbsp;';
                                if($userid != '') {
                                    $html.='<input type="checkbox" class="radib-btn" name="uid[]" id="'.$arr['Id'].'" style="vertical-align:middle;" value="'.$arr['Id'].'" checked ="true""/>';
                                } else {
                                    $html.='<input type="checkbox" class="radib-btn" name="uid[]" id="'.$arr['Id'].'" style="vertical-align:middle;" value="'.$arr['Id'].'"/>';
                                }
                                    $html.='<input type="hidden" class="radib-btn" name="name[]" id="name_'.$arr['Id'].'" style="vertical-align:middle;" value="'.$arr['vTitle'].'" />
                                </td>
                                <td width="94%" height="26" >'.$arr['vTitle'].'</td>
                            </td>
                          </tr>';
                   }
                }
   $html.='</table></div></td>
          </tr>
        </table>
        <script>
        $("#insert_btn").show();$("delete_btn").show();$("#tUserID").show();$("#reset_btn").show();
        </script>
        ';
} else {
    $html.= $smarty->get_template_vars('LBL_USER_NOT_FOUND');
    $html.='<script>
           // $("#insert_btn").hide();$("delete_btn").hide();$("#tUserID").hide();$("#reset_btn").hide();
           </script>';
}
echo $html;
?>
<script>
    $('#uid_chkall').click( function () {
        orgs = $('input:checkbox[name="uid\[\]"]');
	if($(this).attr('checked')) {
		$.each(orgs, function (ln,el) {
                        $(this).attr('checked','checked');
		});
	} else {
		$.each(orgs, function (ln,el) {
			$(this).attr('checked','');
		});
	}
});

$(document).ready( function() {
	$(function() {
		var ead=10;
		$('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
	});
});
</script>
<?php  
exit;
?>