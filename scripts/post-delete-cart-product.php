<!-- den här koden tömmer hela varukorgen -->
<?php

session_start();


if (isset($_SESSION["cart"])){
    $_SESSION["cart"] = [];

    header("Location: /pages/cart.php");
    die();


}