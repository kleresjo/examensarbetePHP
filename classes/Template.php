<?php

require_once __DIR__ . "/User.php";
session_start();

// den här koden kollar ifall man är inloggad och ifall man är admin eller inte och uppdaterar varukorgen
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

            <!-- Slider kod -->
<div class="slider-container">

<!-- bilder som kommer upp i slidern -->
<div class="mySlides fade">
  <img src="/assets/uploads/photo-1632821405254-a8166e7c201d.webp" class="slider-img">
</div>

<div class="mySlides fade">
  <img src="/assets/uploads/photo-1612773085209-476549690cd7.webp" class="slider-img">
</div>

<div class="mySlides fade">
  <img src="/assets/uploads/photo-1420824471541-fe7e0ae0baa4.jpeg" class="slider-img">
</div>
</div>
                   <!-- Menyn -->
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
        <!-- Footern -->
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

            <!-- Javascript för Slidern -->
 <script>
               let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none"; 
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1} 
  slides[slideIndex-1].style.display = "block"; 
  setTimeout(showSlides, 5000); // Byter bild car 5e sekund
}
            </script>
        </body>
        </html>
<?php }
}
