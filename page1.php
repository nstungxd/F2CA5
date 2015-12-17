<?php
/**
 * Created by JetBrains PhpStorm.
 * User: TUNG
 * Date: 3/24/15
 * Time: 1:33 PM
 * To change this template use File | Settings | File Templates.
 */
session_start();
require 'rb.php';
R::setup('mysql:host=localhost;dbname=vn91','root','');
$user=  R::getAll( 'select * from articoli');
$_SESSION['favcolor'] = 'green';

if (isset($_POST['addcart']))
{
    if(!isset($_SESSION['cart'])) $_SESSION['cart'] = array();
    $stack = $_SESSION['cart'];
    array_push($stack, $_POST['addcart']);
    $_SESSION['cart'] = $stack;
}
?>
<br/>

<form action="" method="post">
<?php
    foreach($user as $item)
    {
    ?>
       <a href="#"><?php echo $item['nome_articolo'] ?></a>
           <button type="submit" name="addcart" value="<?php echo $item['nome_articolo']  ?>" >Add cart</button>
           <br/>
    <?php
    }
?>
<a href="page2.php">Leave to page 2</a>
    </form>