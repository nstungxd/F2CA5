<?php
/**
 * Created by JetBrains PhpStorm.
 * User: TUNG
 * Date: 3/24/15
 * Time: 1:35 PM
 * To change this template use File | Settings | File Templates.
 */

session_start();

echo 'Welcome to page #2<br />';

echo $_SESSION['favcolor'];

?>
<br/>

    <?php
echo '<pre>';
$stack = $_SESSION['cart'];
print_r($stack  );
?>
<a href="page1.php">Return page 1</a>