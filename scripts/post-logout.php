<!-- kod för att logga ut -->
<?php

session_start();
unset($_SESSION["user"]);
session_destroy();
header("Location: /");