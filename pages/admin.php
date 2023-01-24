<?php

require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/ProductsDatabase.php";
require_once __DIR__ . "/../classes/UsersDatabase.php";
require_once __DIR__ . "/../classes/OrdersDatabase.php";

// kontrollera att användaren är inloggad som admin
$is_logged_in = isset($_SESSION["user"]);
$logged_in_user = $is_logged_in ? $_SESSION["user"] : null;
$is_admin = $is_logged_in && $logged_in_user->role == "admin";

if(!$is_admin){ // om användaren inte är admin
    http_response_code(401);
    die("Access denied!!");
}

$products_db = new ProductsDatabase();
$users_db = new UsersDatabase();
$orders_db = new OrdersDatabase();
$orders = $orders_db->get_all();

$users = $users_db->get_all();
$products = $products_db->get_all();

// kod för att kunna skapa produkter

Template::header(""); ?>

<h2 class="konto-h2"> Skapa en produkt </h2>

<hr>

<form action="/admin-scripts/post-create-product.php" method="post" enctype="multipart/form-data" class="skapa-produkt-card">
    <input type="text" name="title" placeholder="Titel" id="produkt-input"> <br>
    <textarea name="description" placeholder="Beskrivning" id="produkt-input"></textarea> <br>
    <input type="number" name="price" placeholder="Pris" id="produkt-input">
    <input type="file" name="image" accept="image/*" id="edit-btn"><br>
    <input type="submit" value="Spara" class="produkt-btn">
</form>

<hr>

<!-- kod som skriver ut produkter -->

<h2 class="konto-h2"> Products </h2>

<?php foreach ($products as $product) : ?>
    <div class="skapa-produkt-card">
        <div class="produkt-card">
        <a href="/pages/admin-product.php?id=<?= $product->id ?>">
        <?= $product->title ?> <br>
        </div>
    </a>
</div> 

<?php endforeach; ?>

<hr>

<!-- skriver ut användare -->

<h2 class="konto-h2"> Users </h2>

<?php foreach ($users as $user) : ?>
    <p class="skapa-produkt-card">
        <a class="admin-user" href="/pages/admin-user.php?username=<?= $user->username ?>"><?= $user->username ?></a>
        <i><?= $user->role ?></i>
    </p>

<?php endforeach; ?>

<!-- skriver ut alla ordrar -->


<h2 class="konto-h2">Orders</h2>

<?php foreach ($orders as $order) : ?>
    <div class="skapa-produkt-card">
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
            <input type="submit" value="Spara" class="edit-btn">
        </form>

        <form action="/admin-scripts/post-delete-order.php" method="post">
            <input type="hidden" name="id" value="<?= $order->id ?>">
            <input type="submit" value="Radera beställning" class="produkt-btn">

        </form>
    </div>

    <hr>

<?php endforeach; ?>




<?php



Template::footer();



?>

