<?php

require_once __DIR__ . "/../classes/ProductsDatabase.php";
require_once __DIR__ . "/force-admin.php";

$success = false;

// Den här koden gör att man kan uppdatera produkter 

if(isset($_POST["title"]) && isset($_POST["description"]) && isset($_POST["price"])){
    $upload_directory = __DIR__ . "/../assets/uploads/";
    $upload_name = basename($_FILES["image"]["name"]); 
    $name_parts = explode(".", $upload_name); 
    $file_extension = end($name_parts); 
    $timestamp = time();  
    $file_name = "{$timestamp}.{$file_extension}"; 
    $full_upload_path = $upload_directory . $file_name;
    $full_relative_url = "/assets/uploads/{$file_name}";
    $success = move_uploaded_file($_FILES["image"]["tmp_name"], $full_upload_path);

    if($success){
        $product = new Product($_POST["title"], $_POST["description"], $_POST["price"], $full_relative_url);
        $products_db = new ProductsDatabase();
        $success = $products_db->create($product);
    }

}else{
    die("Invalid input");
}

// skickar en vidare till admin-sidan ifall uppdateringen fungerade

if($success){
    header("Location: /pages/admin.php");
    die();
}else{
    die("Error saving product");
}