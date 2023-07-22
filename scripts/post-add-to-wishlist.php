<?php

// ladda in klasser
require_once __DIR__ . "/../classes/ProductsDatabase.php";
require_once __DIR__ . "/../classes/Product.php";

session_start();

if(isset($_POST["product-id"])){
    // hämta producter (från databasen) vi klickat på
    $products_db = new ProductsDatabase();
    $product = $products_db->get_one($_POST["product-id"]);

    // skapa varukorg om den inte finns
    if(!isset($_SESSION["cart"])){
        $_SESSION["cart"] = [];
    }
    
    if($product){
        // lägg produkt i varukorg
        $_SESSION["cart"][] = $product;
        // redirect till pages->products
        header("Location: /pages/products.php");
        die();
    }
    
}
else{
    die("Invalid input");
}
die("Error adding product to cart");