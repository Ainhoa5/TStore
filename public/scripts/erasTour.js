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

//PRODUCTS
let products = [
    {
        id: 1,
        name: 'Product 01',
        image: '01.png',
        price: 12      
    },
    {
        id: 2,
        name: 'Product 02',
        image: '01.png',
        price: 12      
    },
    {
        id: 3,
        name: 'Product 03',
        image: '01.png',
        price: 12      
    },
    {
        id: 4,
        name: 'Product 04',
        image: '01.png',
        price: 12      
    },
    {
        id: 5,
        name: 'Product 05',
        image: '01.png',
        price: 12      
    },
    {
        id: 6,
        name: 'Product 06',
        image: '01.png',
        price: 12      
    }
];
let listCards = [];
function initApp(){
    products.forEach((value, key)=>{
        let newDiv = document.createElement('div');
        newDiv.classList.add('item');
        newDiv.innerHTML = `
            <img src="img/${value.image}"/>
            <div class="title">${value.name}</div>
            <div class="price">${value.price+"€"}</div>
            <button onclick="addToCard(${key})">Add To Card</button>
        `;
        list.appendChild(newDiv);
    })
}
initApp();
function addToCard(key) {
    let productId = products[key].id;
    if(!listCards[productId]){
        listCards[productId] = {...products[key], quantity: 1};
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
        let productTotalPrice = product.price * product.quantity;
        totalPrice += productTotalPrice;
        count += product.quantity;

        let newDiv = document.createElement('li');
        newDiv.innerHTML = `
            <div><img src="img/${product.image}"></div>
            <div>${product.name}</div>
            <div>
                <button onclick="changeQuantity(${product.id}, ${product.quantity - 1})">-</button>
                <div class="count">${product.quantity}</div>
                <button onclick="changeQuantity(${product.id}, ${product.quantity + 1})">+</button>
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
  distance: '85px',
  duration: 2200,
  reset: true
})


sr.reveal ('.container',{delay:400});

sr.reveal ('.middle-text',{});
sr.reveal ('.row-btn,.shop-content',{delay:200});

sr.reveal ('.review-content,.contact',{delay:200});