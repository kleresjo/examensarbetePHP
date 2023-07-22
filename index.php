<?php // http://localhost:8888/

require_once __DIR__ . "/classes/Template.php";


Template::header(""); 
?>
<script src="https://kit.fontawesome.com/49654d2d6c.js" crossorigin="anonymous"></script>


<div class="index-div">
    <h2 class="index-title"> Om Shoppen </h2>
    <p class="index-p">
    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Recusandae voluptatem dicta libero perferendis, maiores saepe architecto neque magni officia expedita deleniti eveniet praesentium laboriosam aliquam quia hic sint vero provident. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed quam animi est deserunt voluptatibus nesciunt qui cum voluptates nisi ratione consequatur quo, quis repudiandae nam similique blanditiis perspiciatis maxime obcaecati. Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit laboriosam esse vitae rem labore libero quibusdam velit quos necessitatibus reiciendis dolore, consequuntur itaque, vero facere sequi excepturi sed cum ut? Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis sapiente velit optio earum aspernatur veritatis eligendi, suscipit itaque, recusandae enim, facilis vel dignissimos eius ut ipsam iure adipisci totam quae?
    </p>
</div>
<div>
    <img src="/assets/uploads/photo-1554303486-cb4b90a27751.webp" alt="" class="index-img">
</div>
<h2 class="index-title">Populära produkter</h2>

<div class="produkt-div-div">

</div>

<!-- kod för att hämta produkter från mitt API -->

<script>
    fetch('./products.json')
    
    .then(res => {
        return res.json();
    })

    .then(jsondata => {
         jsondata.forEach(product => {
            const productLine =  `<div class ="pp-produkt-div"><div class="produkt-card"><img id="produkt-image" src="${product.productImg}"></img>
            <div class="produkt-des">
            <p class="produkt-titel">${product.productName}</p>
            <p class="produkt-pris">${product.productPrice}:- </p>
            <p class="produkt-bes">${product.productDes}</p>
            </div>
            <div class="produkt-card-btns">
        <form action="/scripts/post-add-to-cart.php" method="post">
            <button type="submit" class="produkt-btn">LÄGG I VARUKORG</button>
        </form>
        <form action="/scripts/post-add-to-wishlist.php" method="post">
        <button type="submit" class="heart-btn"><i class="fa-solid fa-heart" class="fa-cart"></i></button>
        </form>
        </div>
            </div>
            </div>`
            document.querySelector('.produkt-div-div').insertAdjacentHTML('beforeend', productLine);
        });
    })

    .catch(error => console.log(error));

</script>

<?php
Template::footer();