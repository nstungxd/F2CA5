<?php
/**
 * @author hidden
 * @copyright 2010
 */
$configfile = '../libraries/config/routes.php';
if (!file_exists($configfile)){
	header('Location:../install.php');
}
?>