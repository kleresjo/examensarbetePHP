<?php

require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/ProductsDatabase.php";
require_once __DIR__ . "/../classes/Template.php";

$products_db = new ProductsDatabase();
$products = $products_db->get_all();

Template::header("Products");

foreach ($products as $product) : ?>

    <div>
        <img src="<?= $product->img_url ?>" alt="Product image">
        <div>
            <b><?= $product->title ?> </b><br>
            <i><?= $product->price ?> kr </i><br>
            <?= $product->description ?>


        <form action="/scripts/post-add-to-cart.php" method="post">
            <input type="hidden" name="product-id" value="<?= $product->id ?>">
            <input type="submit" value="Add to cart">
        </form>
</div>
    </div>

<?php
endforeach;

Template::footer();
