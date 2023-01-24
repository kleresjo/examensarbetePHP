<?php
require_once __DIR__ . "/../classes/Template.php";
Template::header("In med slider här");
?>

<h2 class="konto-h2"> Registrera dig </h2>

    <form action="/scripts/post-register-user.php" method="post" class="skapa-produkt-card">
        <input type="text" name="username" placeholder="Användarnamn"><br>
        <input type="password" name="password" placeholder="Lösenord"><br>
        <input type="password" name="confirm-password" placeholder="Bekräfta lösenord"><br>
        <input type="submit" value="Skapa konto">
    </form>


<?php

Template::footer();
?>