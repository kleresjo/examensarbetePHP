<?php

require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/OrdersDatabase.php";
require_once __DIR__ . "/../classes/UsersDatabase.php";
require_once __DIR__ . "/../classes/ProductsDatabase.php";

$is_logged_in = isset($_SESSION['user']);
$logged_in_user = $is_logged_in ? $_SESSION['user'] : null;

Template::header("In med slider här");

$orders_db = new OrdersDatabase();

$orders = $orders_db->get_order_by_user_id($logged_in_user->id);

$products_db = new ProductsDatabase();
$all_products = [];
$order_value = 0;

?>
            <div class="logged-in-box">
                  <p class="log-in">Inloggad som:</p>
                     <b><?= $logged_in_user->username ?></b>
                    <form action="/scripts/post-logout.php" method="post">
                        <input class="logout-btn" type="submit" value="Logga ut">
                    </form>
                    </div>

<hr>
<br>
<h2 class="konto-h2">Mina beställningar:</h2>
<br>

<?php
if (!$is_logged_in) : ?>
    <a href="/pages/register.php"></i>Login/register to place order</a>
<?php endif; ?>

<?php foreach ($orders as $order) : ?>
    <hr>
<div class="order-card">
    <br>
    <p>
        <b><p>ORDER-ID: </p></b><?=$order->id?>
        <b><p>STATUS: </p></b><?= $order->status ?>
        <b><p>DATUM: </p></b><?= $order->order_date?>
    </p>

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


<b> Order value: <?= $order_value ?> kr</b>
<?php $order_value = 0; ?>
</div>
<hr>


<?php endforeach; ?>

<?php $products = $products_db->get_by_order_id($logged_in_user->id); ?>


<?php

Template::footer();
