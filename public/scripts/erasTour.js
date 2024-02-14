/*MÉTODO EN JS PARA EL HEADER DEL MENÚ*/
const header = document.querySelector("header");

window.addEventListener("scroll", function() {
    header.classList.toggle("sticky", this.window.scrollY > 80);
});



let openShopping = document.querySelector('.shopping');
let closeShopping = document.querySelector('.closeShopping');
let list = document.querySelector('.list');
let listCard = document.querySelector('.listCard');
let body = document.querySelector('body');
let total = document.querySelector('.total');
let quantity = document.querySelector('.quantity');



openShopping.addEventListener('click', ()=>{
    body.classList.add('active');
})

closeShopping.addEventListener('click', ()=>{
    body.classList.remove('active');
})
console.log(productos);
//productos


let listCards = [];
function initApp(){
    productos.forEach((value, key)=>{
        let newDiv = document.createElement('div');
        newDiv.classList.add('item');
        newDiv.innerHTML = `
        <img src="img/products/${value.ImagenURL}" onerror="this.onerror=null;this.src='img/products/default-placeholder.png';">
            <div class="title">${value.Nombre}</div>
            <div class="price">${value.Precio+"€"}</div>
            <button class="btn" onclick="addToCard(${key})">Add To Card</button>
        `;
        list.appendChild(newDiv);
    })
}
initApp();
function addToCard(key) {
    let productId = productos[key].ProductoID;
    if(!listCards[productId]){
        listCards[productId] = {...productos[key], quantity: 1};
    } else {
        listCards[productId].quantity++;
    }
    reloadCard();
}

function reloadCard(){
    listCard.innerHTML = '';
    let count = 0;
    let totalPrice = 0;

    Object.values(listCards).forEach((product) => {
        let productTotalPrice = product.Precio * product.quantity;
        totalPrice += productTotalPrice;
        count += product.quantity;

        let newDiv = document.createElement('li');
        newDiv.innerHTML = `
            <div><img src="img/products/${product.ImagenURL}" onerror="this.onerror=null;this.src='img/products/default-placeholder.png';"></div>
            <div>${product.Nombre}</div>
            <div>
                <button onclick="changeQuantity(${product.ProductoID}, ${product.quantity - 1})">-</button>
                <div class="count">${product.quantity}</div>
                <button onclick="changeQuantity(${product.ProductoID}, ${product.quantity + 1})">+</button>
            </div>
        `;
        listCard.appendChild(newDiv);
    });

    total.innerText = totalPrice.toLocaleString();
    quantity.innerText = count;
}


function changeQuantity(productId, quantity){
    if(quantity <= 0){
        delete listCards[productId];
    } else {
        listCards[productId].quantity = quantity;
    }
    reloadCard();
}

function finalizeOrder() {
    fetch('/order', { // Asegúrate de reemplazar esto con la URL correcta del servidor
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            productos: Object.values(listCards) // Convierte el objeto listCards a un array y lo envía
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log( data.message);
       alert(String(data.message));
        // Aquí puedes manejar la respuesta del servidor, como redirigir al usuario o mostrar un mensaje de éxito
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}


// MENU
let menu = document.querySelector('#menu-icon');
let navlist = document.querySelector('.navlist');
menu.onclick = () => {
    menu.classList.toggle('bx-x');
    navlist.classList.toggle('open');
};

window.onscroll = () => {
    menu.classList.remove('bx-x');
    navlist.classList.remove('open');
}


//SCROLL
const sr = ScrollReveal({
  origin: 'top',
  distance: '285px',
  duration: 2500,
  reset: false
})


sr.reveal ('.item',{delay:800});
sr.reveal ('.contact',{delay:800});




//LOADER
function loader(){
    document.querySelector('.loader-container').classList.add('fade-out');
}

function fadeOut(){
    setInterval(loader, 1200);
}

window.onload = fadeOut;