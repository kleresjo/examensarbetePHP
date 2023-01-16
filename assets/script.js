document.addEventListener("DOMContentLoaded", () => {
    const showButtons = document.querySelectorAll(".show-product-details");

    for (const button of showButtons) {
        button.addEventListener("click", onClickProductDetails)
        
    }
});
async function onClickProductDetails(e){
    const id = this.dataset.id;

    /* console.log(id); */
    const response = await fetch(`/api/get-product.php?id=${id}`);
    const product = await response.json();


    const productDetailsContainer = document.getElementById("product-details");
    productDetailsContainer.hidden = false;
    document.getElementById("img-url").src = product.img_url;
    document.getElementById("title").innerText = product.title;
    document.getElementById("description").innerText = product.description;
    document.getElementById("price").innerText = product.price + " kr";
};