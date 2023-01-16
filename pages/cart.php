<?php

require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/Template.php";

$products = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];

$total_sum = array_sum(array_column($products, 'price'));
$is_logged_in = isset($_SESSION["user"]);

Template::header("Cart"); ?>

<?php foreach ($products as $product) : ?>

    <article>
        <img src="<?= $product->img_url ?>" height="75" width="75">
        <div>
            <b><?= $product->title ?></b>
            <?= $product->price ?> kr
        <!-- in med en delete knapp här -->
        </div>
    </article>

<?php endforeach; ?>
<?php if (count($products) > 0) : ?>

    <h3> Total: <?= $total_sum ?></h3>

    <?php if ($is_logged_in) : ?>
        <form action="/scripts/post-place-order.php" method="post">
            <input type="submit" value="Place order">
        </form>
    <?php else : ?>
        <a href="/pages/login.php"> Login to place order </a>
    <?php endif; ?>
<?php else : ?>

<?php endif; ?>

<?php if (count($products) < 0) : ?>
    <a href="/pages/products.php"> Cart is empty</a>
<?php endif; ?>

<?php Template::footer();


