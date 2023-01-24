<?php // http://localhost:8888/

require_once __DIR__ . "/classes/Template.php";


Template::header(""); 
?>

<div class="index-div">
    <h2 class="index-title"> Om Arkeologishoppen </h2>
    <p class="index-p">
    Arkeologishoppen är en specialiserad webbutik som i första hand riktar sig till arkeologer, 
    osteologer och projektledare inom all arkeologisk verksamhet i Sverige och inom EU. 
    Företaget startade 2023 och tillhandahåller större och mindre verktyg samt dokumentationsmateriell 
    till arkeologiska utgrävningar i syfte att underlätta arbetet för arkeologer i fält och osteologen på labbet. 
    Efterbearbetning eller fyndhanteringen av artefakter och benmaterial är oerhört viktigt och Arkeologishoppen
    sortiment kan bistå i att underlätta arbetet med även detta.
    </p>
</div>
<div>
    <img src="/assets/uploads/photo-1554303486-cb4b90a27751.webp" alt="" class="index-img">
</div>
<h2 class="index-title">Senaste produkterna</h2>

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
            const productLine =  `<div class="produkt-card"><img id="produkt-image" src="${product.productImg}"></img>
            <p class="produkt-titel">${product.productName}</p>
            <p class="produkt-pris">${product.productPrice} kr</p>
            </div>`
            document.querySelector('.produkt-div-div').insertAdjacentHTML('beforeend', productLine);
        });
    })

    .catch(error => console.log(error));

</script>

<?php
Template::footer();