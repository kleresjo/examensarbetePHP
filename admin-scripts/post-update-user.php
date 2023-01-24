<!-- den här koden uppdaterar användare -->
<?php
require_once __DIR__ . "/../classes/UsersDatabase.php";
require_once __DIR__ . "/force-admin.php";

$success = false;

if(isset($_POST["role"]) && isset($_GET["username"])){
$user_db = new UsersDatabase();
$user = new User($_GET["username"], $_POST["role"]);
$success = $user_db->update($user);

}

else{
    die("Invalid input");
}
if($success){
    header("Location: /pages/admin.php");
    die();
}
else{
    die("Error updating user");
}