<?php

require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/ProductsDatabase.php";
require_once __DIR__ . "/../classes/Template.php";

// skriver ut alla produkter i webshopen 

$products_db = new ProductsDatabase();
$products = $products_db->get_all();

Template::header(""); ?>

<div class="produkt-div-div">
<?php foreach ($products as $product) : ?>
    <div class="produkt-card">
        <img src="<?= $product->img_url ?>" alt="<?= $product->decsription ?>" id="produkt-image">
        <div class="produkt-des">
            <b class="produkt-titel"><?= $product->title ?> </b><br>
            <i class="produkt-pris"><?= $product->price ?> kr </i><br>
            <p class="produkt-bes"><?= $product->description ?></p>
            </div>
            
        <form action="/scripts/post-add-to-cart.php" method="post">
            <input type="hidden" name="product-id" value="<?= $product->id ?>">
            <input type="submit" value="LÄGG I VARUKORGEN" class="produkt-btn">
        </form>
</div>

<?php
endforeach; ?>
</div>

<?php Template::footer(); ?>
