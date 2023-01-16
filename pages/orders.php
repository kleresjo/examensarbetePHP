<?php

require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/OrdersDatabase.php";
require_once __DIR__ . "/../classes/UsersDatabase.php";
require_once __DIR__ . "/../classes/ProductsDatabase.php";

$is_logged_in = isset($_SESSION['user']);
$logged_in_user = $is_logged_in ? $_SESSION['user'] : null;

Template::header("Order page");

$orders_db = new OrdersDatabase();

$orders = $orders_db->get_order_by_user_id($logged_in_user->id);

$products_db = new ProductsDatabase();
$all_products = [];
$order_value = 0;

?>

<h2>Mina beställningar</h2>

<?php
if (!$is_logged_in) : ?>
    <a href="/pages/register.php"></i>Login/register to place order</a>
<?php endif; ?>

<?php foreach ($orders as $order) : ?>

    <hr><br>
    <p>
        <b><p>ORDER-ID: </p></b><?=$order->id?>
        <b><p>STATUS: </p></b><?= $order->status ?>
        <b><p>DATUM: </p></b><?= $order->order_date?>
    </p>

    <?php echo("Innan");?>

    <?php 
    $products = $products_db->get_by_order_id($order->id);

     foreach ($products as $product) {
       $order_value += $product->price;
    } 
?>

<?php foreach ($products as $product) : ?>
    <?php array_push($all_products, $product); ?>

    <p>
        <img src="<?= $product->img_url ?>" width="100" height="100" alt="Product image">
        <i><?= $product->name ?></i>
        <i><?= $product->price ?> kr</i>
    </p>
<?php endforeach; ?>

<?php echo("Efter"); ?>

<b> Order value: <?= $order_value ?> kr</b>
<?php $order_value = 0; ?>

<hr>

<?php echo("Efter varje order"); ?>

<?php endforeach; ?>

<?php $products = $products_db->get_by_order_id($logged_in_user->id); ?>
<?php echo("Efter sista ordern"); ?>
<div>
<h2>Total value: <?= $sum = array_reduce($all_products, function ($arr, $value) {

                return $arr + $value->price;
            })  ?> Kr </h2>
</div>

<?php

Template::footer();
