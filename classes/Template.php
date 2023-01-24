<?php

require_once __DIR__ . "/User.php";
session_start();

class Template
{
    public static function header($title)
    {
        $is_logged_in = isset($_SESSION["user"]);
        $logged_in_user = $is_logged_in ? $_SESSION["user"] : null;
        $is_admin = $is_logged_in && ($logged_in_user->role == "admin");

        $cart_count = isset($_SESSION["cart"]) ? count($_SESSION["cart"]) : 0;

?>
        <!DOCTYPE html>
        <html lang="sve">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="/assets/style.css">
            <title> <?= $title ?> - Arkeologishoppen </title>

        </head>

        <body>
            <header class="header-title">
                <h1> <?= $title ?> </h1>
            </header>

            <nav class="meny-nav">
                <div class="meny-link">
                <a href="/">Hem</a>
                <a href="/pages/products.php">Webshop</a>
                <a href="/pages/cart.php">Kundvagn(<?= $cart_count ?>)</a>
                <?php if (!$is_logged_in) : ?>
                    <a href="/pages/login.php">Logga in</a>
                    <a href="/pages/register.php">Registera konto</a>
                <?php elseif ($is_admin) : ?>
                    <a href="/pages/admin.php">Admin</a>
                <?php endif; ?>
                <main>
                <?php if ($is_logged_in) : ?>
                    <a href="/pages/orders.php">Mitt konto</a>
                </div>

                    </div>
                <?php endif; ?>
            </main>
            </div>
            </nav>



        <?php }
    public static function footer()
    {
        ?>
            <footer>
                <div class="footer-div">
                <nav>
                <div class="footer-menu">
                <a href="/">Hem</a>
                <a href="/pages/products.php">Webshop</a>
                <a href="/pages/login.php">Logga in</a>
                <a href="/pages/register.php">Registrera konto</a>
                <p class="footer-p">Kontakta oss</p>
                <p class="footer-p">Jobba hos oss</p>
                <p class="footer-p">Copyright Arkeologshoppen 2023</p>
                </div>
              </div>
            </footer>

            <!-- <script src="/shop/assets/script.js"></script> -->



        </body>

        </html>
<?php }
}
