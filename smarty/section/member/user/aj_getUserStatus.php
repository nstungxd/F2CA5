<?php

include(S_SECTIONS."/member/memberaccess.php");

$iUserID=GetVar('iId');
if(!isset($orgUserPermObj)) {
    include_once(SITE_CLASS_APPLICATION."user/class.OrganizationUserPermission.php");
    $orgUserPermObj =	new OrganizationUserPermission();
}
if(!isset($orgUserPermVerifyObj)) {
    include_once(SITE_CLASS_APPLICATION."user/class.OrganizationUserPermissionToVerify.php");
    $orgUserPermVerifyObj =	new OrganizationUserPermissionToVerify();
}
$userRights=$orgUserPermObj->select($iUserID);
?>
<script type="text/javascript">
     
</script>
<?php exit; ?>