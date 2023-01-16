<?php

require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/ProductsDatabase.php";
require_once __DIR__ . "/../classes/UsersDatabase.php";
require_once __DIR__ . "/../classes/OrdersDatabase.php";



//kontrollera att användaren är inloggad som admin
$is_logged_in = isset($_SESSION["user"]);
$logged_in_user = $is_logged_in ? $_SESSION["user"] : null;
$is_admin = $is_logged_in && $logged_in_user->role == "admin";

if(!$is_admin){ //om dom inte är admin
    http_response_code(401); // access denied
    die("Access denied!!");
}


$products_db = new ProductsDatabase();
$users_db = new UsersDatabase();
$orders_db = new OrdersDatabase();
$orders = $orders_db->get_all();

$users = $users_db->get_all();
$products = $products_db->get_all();



Template::header("Admin area"); ?>

<h2> Create product </h2>

<form action="/admin-scripts/post-create-product.php" method="post" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Title"> <br>
    <textarea name="description" placeholder="Description"></textarea> <br>
    <input type="number" name="price" placeholder="Price">
    <input type="file" name="image" accept="image/*"><br>
    <input type="submit" value="Save">
</form>

<hr>

<h2> Products </h2>

<?php foreach ($products as $product) : ?>
    <p>
        <a href="/pages/admin-product.php?id=<?= $product->id ?>">
        <?= $product->title ?>
    </a>
    </p>
<?php endforeach; ?>
<hr>
<h2> Users </h2>

<?php foreach ($users as $user) : ?>
    <p>
        <a href="/pages/admin-user.php?username=<?= $user->username ?>"><?= $user->username ?></a>
        <i><?= $user->role ?></i>
    </p>

<?php endforeach; ?>


<h2>Orders</h2>

<?php foreach ($orders as $order) : ?>
    <div>
        <b>#<?= $order->id ?></b>
        <?= $order->order_date ?>
        <b>[<?= $order->status ?>]</b>
        <form action="/admin-scripts/post-edit-order.php" method="post">
            <input type="hidden" name="id" value="<?= $order->id ?>">
            <select name="status">
                <option disabled selected>Status</option>
                <option value="waiting">Väntar på att packeteras</option>
                <option value="Sent">Skickad</option>
            </select>
            <input type="submit" value="Edit">
        </form>

        <form action="/admin-scripts/post-delete-order.php" method="post">
            <input type="hidden" name="id" value="<?= $order->id ?>">
            <input type="submit" value="Delete order">

        </form>


    </div>
    <hr>

<?php endforeach; ?>




<?php



Template::footer();



?>

