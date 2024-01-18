<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Tienda de la página web Aromas&Recetas">
    <title>T-Store-Shop</title>
    <link rel="stylesheet" href="../style/tienda.css">
    <!--BOX ICONS-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!--GOOGLE FONTS-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;600;700&family=Lato:wght@300;400;700&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
            <!-- NOSCRIPT -->
            <noscript>
                <div style="background-color: white; color: black; padding: 10px; text-align: center;">
                    Parece que JavaScript no está habilitado en tu navegador. Algunas características de esta página no funcionarán correctamente sin JavaScript.
                </div>
            </noscript>
        <!--HEADER-->
        <header>
            <a href="../index.html" class="logo">
                <i class='bx bxs-album'></i>
                T-Store
            </a>
    
            <ul class="navlist">
                <li><a href="../index.html">Home</a></li>
                <li><a href="#" class="active">Reputation</a></li>
                <li><a href="#" >Speak Now</a></li>
                <li><a href="#" >1989</a></li>
                <li><a href="#">Midnights</a></li>
                <li><a href="#">Lover</a></li>
            </ul>
    
            <div class="nav-icons">
                <a href="#"><i class='bx bx-search-alt' ></i></a>
                <a href="#"><i class='bx bx-cart-alt'></i></a>
                <div class="bx bx-menu" id="menu-icon"></div>
            </div>
        </header>
     
    <!--TIENDA-->
    <section class="shop" id="shop">
        <div class="middle-text">
         <h4>Nuestra Tienda</h4>
         <h2>Los Productos Más Populares</h2>
        </div>
        
        <div class="shop-content">

              <!--Almendras-->
              <div class="row">
                <img src="../img/index/Tienda/Almendras.png">
                <h3>Almendras 200gr</h3> 
                <p>Almendras naturales de la cumbre.</p>
                    <div class="in-text">
                        <div class="price">
                            <h6>1.30€</h6>
                        </div>
                        <div class="s-btn">
                            <a href="/pages/tabla.html">Comprar Ahora</a>
                        </div>
                    </div>

                    <div class="top-icon">
                        <i class='bx bx-heart' ></i>
                    </div>

            </div>

              <!--Azucar-->
              <div class="row">
                <img src="../img/index/Tienda/Azucar.png">
                <h3>Azúcar</h3> 
                <p>Ázucar blanca refinada 500gr</p>
                    <div class="in-text">
                        <div class="price">
                            <h6>0.75€</h6>
                        </div>
                        <div class="s-btn">
                            <a href="/pages/tabla.html">Comprar Ahora</a>
                        </div>
                    </div>

                    <div class="top-icon">
                        <i class='bx bx-heart' ></i>
                    </div>

            </div>
        
              <!--Chocolate-->
              <div class="row">
                <img src="../img/index/Tienda/chocolate.png">
                <h3>Chocolate 100gr</h3> 
                <p>Chocolate cultivado en Mógan.</p>
                    <div class="in-text">
                        <div class="price">
                            <h6>1.40€</h6>
                        </div>
                        <div class="s-btn">
                            <a href="/pages/tabla.html">Comprar Ahora</a>
                        </div>
                    </div>

                    <div class="top-icon">
                        <i class='bx bx-heart' ></i>
                    </div>

            </div>





        </div>
 


     </section>

        
                 <!--Contact-->
        <section class="contact" id="contact">
        <div class="contact-content">
           <div class="contact-text">
                <h2>Contáctanos</h2>
                <p>
                    Para contactarnos, no dudes en utilizar la información proporcionada a continuación.
                    Puedes escribirnos a nuestra dirección de correo electrónico o llamarnos.
                    Además, te invitamos a seguirnos en nuestras redes sociales para mantenerte al tanto de nuestras últimas novedades y actualizaciones.
                   
                </p>
                <div class="social">
                    <a href="#" class="clr"><i class='bx bxl-instagram'></i></a>
                    <a href="#"><i class='bx bxl-facebook-circle'></i></a>
                    <a href="#"><i class='bx bxl-twitter'></i></a>
                    <a href="#"><i class='bx bxl-whatsapp'></i></a>
                    <a href="#"><i class='bx bx-envelope'></i></a>
                </div>
           </div>

           <div class="details">
              
                <div class="main-d">
                    <a href="#"><i class='bx bx-location-plus'></i>Las Palmas de Gran Canaria</a>
                </div>

            
                <div class="main-d">
                    <a href="#"><i class='bx bx-envelope'></i></i>Aromas&Recetas@gmail.com</i></a>
                </div>

             
                <div class="main-d">
                    <a href="#"><i class='bx bx-phone-call'></i>+34 726 15 43 19</i></a>
                </div>

           </div>
        </div>
    </section> 


    <!--Scroll top-->
    <a href="#" class="scroll">
        <i class='bx bxs-up-arrow'></i>
    </a>
    
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="/script/tienda.js"></script>
</body>
</html>