<?php

require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/UsersDatabase.php";
require_once __DIR__ . "/../classes/OrdersDatabase.php";
require_once __DIR__ . "/../classes/Template.php";


$is_logged_in = isset($_SESSION['user']);
$cart = $_SESSION['cart'];
$logged_in_user = $is_logged_in ? $_SESSION['user'] : null;


if(!$cart){
    header("Location: /Examensarbete/pages/cart.php");
}

if ($is_logged_in && count($cart) > 0) {

    $order = new Order($logged_in_user->id, "waiting", date("Y-m-d"));
    $db_orders = new OrdersDatabase();
    $order_id = $db_orders->create($order);

    if ($order_id == false) {
        die("Error creating order");
    }

    $success = true;

    foreach ($cart as $product) {
        $success = $success && $db_orders->create_order($order_id, $product->id);
    }


    if ($success) {

        unset($_SESSION["cart"]);
        header("Location: /pages/orders.php");
        die();

    } else {
        die("Error saving order");
    }

} else {

    die("invalid cart / user");

}

?>