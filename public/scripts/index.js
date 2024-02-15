const header = document.querySelector("header");

window.addEventListener("scroll", function() {
    header.classList.toggle("sticky", this.window.scrollY > 80);
});

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

sr.reveal ('.about-img',{});
sr.reveal ('.about-text',{delay:250});

sr.reveal ('.middle-text',{});
sr.reveal ('.row-btn,.shop-content',{delay:250});

sr.reveal ('.slider',{delay:300});
sr.reveal ('.review-content,.contact',{delay:250});
sr.reveal ('.merch-container, .box',{delay:250});

//LOADER
function loader(){
    document.querySelector('.loader-container').classList.add('fade-out');
}

function fadeOut(){
    setInterval(loader, 1000);
}

window.onload = fadeOut;