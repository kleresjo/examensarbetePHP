<?php

require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/ProductsDatabase.php";
require_once __DIR__ . "/../classes/Template.php";

// skriver ut alla produkter i webshopen 

$products_db = new ProductsDatabase();
$products = $products_db->get_all();

Template::header(""); ?>

<script src="https://kit.fontawesome.com/49654d2d6c.js" crossorigin="anonymous"></script>

<div class="produkt-div-div">
<?php foreach ($products as $product) : ?>
    <div class="produkt-card">
        <div class="produkt-card-img"><img src="<?= $product->img_url ?>" alt="<?= $product->decsription ?>" id="produkt-image"></div>
        <div class="produkt-des">
            <b class="produkt-titel"><?= $product->title ?> </b><br>
            <i class="produkt-pris"><?= $product->price ?>:- </i><br>
            <p class="produkt-bes"><?= $product->description ?></p>
            </div>
        <div class="produkt-card-btns">
        <form action="/scripts/post-add-to-cart.php" method="post">
            <input type="hidden" name="product-id" value="<?= $product->id ?>">
            <button type="submit" class="produkt-btn">LÄGG I VARUKORG</button>
        </form>

        <form action="/scripts/post-add-to-wishlist.php" method="post">
        <input type="hidden" name="product-id" value="<?= $product->id ?>">
        <button type="submit" class="heart-btn"><i class="fa-solid fa-heart" class="fa-cart"></i></button>
        </form>
        </div>
</div>

<?php
endforeach; ?>
</div>

<?php Template::footer(); ?>
