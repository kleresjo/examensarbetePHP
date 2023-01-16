<?php

require_once __DIR__ . "/../classes/Template.php";

Template::header("Login");
if(isset($_GET["register"]) && $_GET["register"] == "success"){
    echo "<h2> User registered, log in </h2>";
}

if(isset($_GET["error"]) && $_GET["error"] == "wrong_pass") : ?>

<h2>Wrong username or password! </h2>
<?php endif; ?>


<form action="/scripts/post-login.php" method="post">
    <input type="text" name="username" placeholder="Username"><br>
    <input type="password" name="password" placeholder="Password"><br>
    <input type="submit" value="Login">
</form>

<a href="/pages/register.php"> Register account </a>

<?php

Template::footer();