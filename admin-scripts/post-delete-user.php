<!-- den här koden raderar users -->
<?php
require_once __DIR__ . "/../classes/UsersDatabase.php";
require_once __DIR__ . "/force-admin.php";


$success = false;

if(isset($_POST["username"])){
    $users_db = new UsersDatabase();
    $success = $users_db->delete($_POST["username"]);

} else{
    die("Invlid input");
}

if($success){
    header("Location: /pages/admin.php");
    die();
} else{
    die("Error deleting product");
}