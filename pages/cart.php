<?php

require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/Template.php";

$products = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];

$total_sum = array_sum(array_column($products, 'price'));
$is_logged_in = isset($_SESSION["user"]);

Template::header("In med slider här"); ?>

<div  class="cart-produkt-card">
<?php if (count($products) == 0) : ?>
 <?php if ($is_logged_in) : ?>

     <div class="empty-cart">
          <a class="empty-cart-link" href="/pages/products.php">Lägg något i varukorgen!</a>
         </div>
          <?php endif; ?><?php endif; ?>

<?php foreach ($products as $product) : ?>

    <article class="cart-card">
        <img src="<?= $product->img_url ?>" height="150" width="100">
        <div>
            <b><?= $product->title ?></b>
            <?= $product->price ?> kr
            </form>
        </div>
    </article>

    <hr>

<?php endforeach; ?>
<?php if (count($products) > 0) : ?>

    <h3> Total: <?= $total_sum ?></h3>

    <?php if ($is_logged_in) : ?>
        <form action="/scripts/post-place-order.php" method="post">
            <input type="submit" value="Bekräfta köp" class="produkt-btn">
        </form>
        <form action="/scripts/post-delete-cart-product.php" method="post">
            <input type="submit" value="Radera varukorg" class="produkt-btn">
    </form>
    <?php else : ?>
        <a href="/pages/login.php"> Logga in för att lägga en beställning </a>
    <?php endif; ?>
<?php else : ?>

<?php endif; ?>

</div>

<?php Template::footer();


