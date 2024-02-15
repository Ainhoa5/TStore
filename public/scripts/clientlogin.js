const btnSignIn = document.getElementById("sign-in"),
    btnSignUp = document.getElementById("sign-up"),
    formRegister = document.querySelector(".register"),
    formLogin = document.querySelector(".login");

    btnSignIn.addEventListener("click", e => {
        formRegister.classList.add("hide");
        formLogin.classList.remove("hide");
    })

    btnSignUp.addEventListener("click", e => {
        formLogin.classList.add("hide");
        formRegister.classList.remove("hide");
    })

//SCROLL
const sr = ScrollReveal({
    origin: 'top',
    distance: '85px',
    duration: 2200,
    reset: true
})

 sr.reveal ('.information',{delay:300});
 sr.reveal ('.form-information',{delay:300});
 sr.reveal ('.scroll',{delay:300});




//LOADER
function loader(){
    document.querySelector('.loader-container').classList.add('fade-out');
}

function fadeOut(){
    setInterval(loader, 1000);
}

window.onload = fadeOut;