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
    if(listCards[key] == null){
        listCards[key] = products[key];
        listCards[key].quantity = 1;
    }
    reloadCard();
}
function reloadCard(){
    listCard.innerHTML = '';
    let count = 0;
    let totalPrice = 0;
    listCards.forEach((value, key) => {
        totalPrice = totalPrice + value.price;
        count = count + value.quantity;
    
        if(value != null){
            let newDiv = document.createElement('li');
            newDiv.innerHTML = `
                <div><img src="img/${value.image}"</div>
                <div>${value.name}</div>
                <div>
                    <button onclick="changeQuantity(${key}, ${value.quantity - 1})">-</button>
                    <div class="count">${value.quantity}</div>
                    <button onclick="changeQuantity(${key}, ${value.quantity + 1})">+</button>
                </div>

            `
            listCard.appendChild(newDiv);
        }
    
    })
    total.innerText = totalPrice.toLocaleString();
    quantity.innerText = count;
}

function changeQuantity(key, quantity){
    if(quantity == 0){
        delete listCards[key];
    }else{
        listCards[key].quantity = quantity;
        listCards[key].price = products[key].price * quantity;
    }
    reloadCard();
}