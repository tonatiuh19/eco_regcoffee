<?php
require_once('admin/cn.php');
session_start();

if (isset($_SESSION['uname'])){
	echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='mipagina/';
    </SCRIPT>");
}
?>
<!doctype html>
<html lang="en">
<head>
  <title>Regalame un Cafe</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    

  <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;700;900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">

  <link rel="stylesheet" href="css/jquery.fancybox.min.css">

  <link rel="stylesheet" href="css/bootstrap-datepicker.css">

  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
  <link rel="stylesheet" href="fonts/flaticon-covid/font/flaticon.css">

  <link rel="stylesheet" href="css/aos.css">

  <link rel="stylesheet" href="css/style.css">

  <link href="css/fontawesome/css/all.css" rel="stylesheet">
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">
  <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">

</head>
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">


  <div id="overlayer"></div>
  <div class="loader">
    <div class="spinner-border text-primary" role="status">
      <span class="sr-only">Cargando...</span>
    </div>
  </div>


  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>

    
    <header class="site-navbar light js-sticky-header site-navbar-target" role="banner">

      <div class="container">
        <div class="row align-items-center">

          <div class="col-6 col-xl-2">
            <div class="mb-0 site-logo"><a href="../" class="mb-0"><img class="img-fluid" src="images/logo.png" alt="regalameuncafe.com"></a></div>
          </div>

          <div class="col-12 col-md-10 d-none d-xl-block">
            <nav class="site-navigation position-relative text-right" role="navigation">

              <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                
                <li><a href="symptoms.html" class="nav-link">Explora creadores</a></li>
                <li><a data-toggle="modal" href="" data-target="#iniciarSesion" class="nav-link border border-primary rounded p-2">Entrar</a></li>
                <li><a data-toggle="modal" href="" data-target="#crearCuenta" class="nav-link">Registrate <i class="fas fa-arrow-circle-right text-primary"></i></a></li>
              </ul>
            </nav>
          </div>


          <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle float-right"><span class="icon-menu h3 text-black"></span></a></div>

        </div>
      </div>

    </header>

    

    <div class="hero-v1">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 mr-auto text-center text-lg-left">
            <span class="d-block subheading">A tus fans les va a encantar</span>
            <h1 class="heading mb-3">Forma sencilla y significativa de financiar tu trabajo creativo</h1>
            <p class="mb-5">Puedes aceptar apoyo de tus membresías, webinars, zooms, recibir un cafe, etc y construir una relación directa con tus fans.</p>
            <p class="mb-4">
            <div class="input-group input-focus">
              <div class="input-group-prepend">
                <span class="input-group-text bg-white font-weight-bold">regalameuncafe.com/</span>
              </div>
              <input type="search" placeholder="tunombre" class="form-control border-left-0" name="username" id="username" autofocus="autofocus" autocomplete="off">
              <div class="input-group-append">
                <button class="btn btn-primary btn-outline-white" type="button" id="comenzarBtn" data-toggle="modal" data-target="#comenzar" disabled>Empezar <i class="fas fa-play"></i></button>
              </div>
            </div>
            <div id="uname_response"></div>
            <div class="alert alert-danger" role="alert" id="alertExist"><small>Este nombre de usuario ya existe :(</small></div>
            <small id="emailHelp" class="form-text text-muted">Es gratis y toma menos de un minuto</small>
            </p>



          </div>
          <div class="col-lg-6">
            <figure class="illustration">
              <img src="images/creator.png" alt="Image" class="img-fluid">
              <!--<img src="https://media.giphy.com/media/W5TBpQMQmxhTaTmxjc/giphy.gif" name="canvas" alt="Image" class="img-fluid">-->
            </figure>
          </div>
          <div class="col-lg-6"></div>
        </div>
      </div>
    </div>


    <!-- MAIN -->
    
    <div class="site-section stats">
      <div class="container">
        <div class="row mb-3">
          <div class="col-lg-7 text-center mx-auto">
            <!--<h2 class="section-heading">Diseñado para personas, no para empresas</h2>
            <p>Comparte contenido exclusivo o simplemente brinda una forma de respaldar tu trabajo</p>-->
            <h2 class="section-heading">Dale a tu audiencia una forma fácil de agradecer</h2>
            <p>Comparte contenido exclusivo o simplemente brinda una forma de respaldar tu trabajo. Con solo un par de clicks, tus fans pueden comprarte un café, comprarte una membresia a tus "close friends" en instagram, comprar un e-book, etc, mas aparte dejar un mensaje. Ni siquiera tienen que crear una cuenta.</p>
          </div>
        </div>
        <div class="row"> 
          <div class="col-lg-4">
            <div class="data">
              <span class="icon text-primary">
                <span class="fas fa-magic"></span>
              </span>
              <strong class="d-block number">Control Total</strong>
              <span class="label">Tienes el 100% de propiedad de tus seguidores. Nunca les enviamos correos electrónicos y puede exportar la lista cuando lo desees.</span>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="data">
              <span class="icon text-primary">
                <span class="fas fa-users"></span>
              </span>
              <strong class="d-block number">Conciente a los tuyos</strong>
              <span class="label">Comienza una subcripcion para tus fans. Material exclusivo, apoyo mensual, acceso a codigo, etc.</span>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="data">
              <span class="icon text-primary">
                <span class="fas fa-heart"></span>
              </span>
              <strong class="d-block number">Servicio insuperable</strong>
              <span class="label">Se te pagara instantáneamente en 24 horas a tu cuenta. Puedes hablar siempre con un humano para que te ayude, o si solo quieres un consejo para arrancar a toda velocidad.</span>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-4 mb-lg-0">
            <figure class="img-play-vid">
              <img src="images/hero_1.jpg" alt="Image" class="img-fluid">
              <div class="absolute-block d-flex">
                <span class="text">Watch the Video</span>
                <a href="https://www.youtube.com/watch?v=9pVy8sRC440" data-fancybox class="btn-play">
                  <span class="icon-play"></span>
                </a>
              </div>
            </figure>
          </div>
          <div class="col-lg-5 ml-auto">
            <h2 class="mb-4 section-heading">What is Coronavirus?</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex officia quas, modi sit eligendi numquam!</p>
            <ul class="list-check list-unstyled mb-5">
              <li>Lorem ipsum dolor sit amet</li>
              <li>Consectetur adipisicing elit</li>
              <li>Unde doloremque</li>
            </ul>
            <p><a href="#" class="btn btn-primary">Learn more</a></p>
          </div>
        </div>
      </div>
    </div>

    <div class="container pb-5">
      <div class="row">
        <div class="col-lg-3">
          <div class="feature-v1 d-flex align-items-center">
            <div class="icon-wrap mr-3">
              <span class="flaticon-protection"></span>
            </div>
            <div>
              <h3>Protection</h3>
              <span class="d-block">Lorem ipsum dolor sit.</span>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="feature-v1 d-flex align-items-center">
            <div class="icon-wrap mr-3">
              <span class="flaticon-patient"></span>
            </div>
            <div>
              <h3>Prevention</h3>
              <span class="d-block">Lorem ipsum dolor sit.</span>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="feature-v1 d-flex align-items-center">
            <div class="icon-wrap mr-3">
              <span class="flaticon-hand-sanitizer"></span>
            </div>
            <div>
              <h3>Treatments</h3>
              <span class="d-block">Lorem ipsum dolor sit.</span>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="feature-v1 d-flex align-items-center">
            <div class="icon-wrap mr-3">
              <span class="flaticon-virus"></span>
            </div>
            <div>
              <h3>Symptoms</h3>
              <span class="d-block">Lorem ipsum dolor sit.</span>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="site-section bg-primary-light">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">

            <div class="row">
              <div class="col-6 col-lg-6 mt-lg-5">
                <div class="media-v1 bg-1">
                  <div class="icon-wrap">
                    <span class="flaticon-stay-at-home"></span>
                  </div>
                  <div class="body">
                    <h3>Stay at home</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio, debitis!</p>
                  </div>
                </div>

                <div class="media-v1 bg-1">
                  <div class="icon-wrap">
                    <span class="flaticon-patient"></span>
                  </div>
                  <div class="body">
                    <h3>Wear facemask</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio, debitis!</p>
                  </div>
                </div>
              </div>
              <div class="col-6 col-lg-6">
                <div class="media-v1 bg-1">
                  <div class="icon-wrap">
                    <span class="flaticon-social-distancing"></span>
                  </div>
                  <div class="body">
                    <h3>Keep social distancing</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio, debitis!</p>
                  </div>
                </div>

                <div class="media-v1 bg-1">
                  <div class="icon-wrap">
                    <span class="flaticon-hand-washing"></span>
                  </div>
                  <div class="body">
                    <h3>Wash your hands</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio, debitis!</p>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
          <div class="col-lg-5 ml-auto">
            <h2 class="section-heading mb-4">How to Prevent Coronavirus?</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque corporis doloribus consequatur fugit voluptatum ex rerum perspiciatis cupiditate, esse hic!</p>
            <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptas, error!</p>

            <ul class="list-check list-unstyled mb-5">
              <li>Lorem ipsum dolor sit amet</li>
              <li>Consectetur adipisicing elit</li>
              <li>Unde doloremque</li>
            </ul>

            <p><a href="#" class="btn btn-primary">Read more about prevention</a></p>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-lg-7 mx-auto text-center">
            <span class="subheading">What you need to do</span>
            <h2 class="mb-4 section-heading">How To Protect Yourself</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex officia quas, modi sit eligendi numquam!</p>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 ">
            <div class="row mt-5 pt-5">
              <div class="col-lg-6 do ">
                <h3>You should do</h3>
                <ul class="list-unstyled check">
                  <li>Stay at home</li>
                  <li>Wear mask</li>
                  <li>Use Sanitizer</li>
                  <li>Disinfect your home</li>
                  <li>Wash your hands</li>
                  <li>Frequent self-isolation</li>
                </ul>
              </div>
              <div class="col-lg-6 dont ">
                <h3>You should avoid</h3>
                <ul class="list-unstyled cross">
                  <li>Avoid infected people</li>
                  <li>Avoid animals</li>
                  <li>Avoid handshaking</li>
                  <li>Aviod infected surfaces</li>
                  <li>Don't touch your face</li>
                  <li>Avoid droplets</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <img src="images/protect.png" alt="Image" class="img-fluid">
          </div>
        </div>
      </div>
    </div>


    <div class="site-section bg-primary-light">
      <div class="container">
        <div class="row mb-5">
          <div class="col-lg-7 mx-auto text-center">
            <h2 class="mb-4 section-heading">Symptoms of Coronavirus</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex officia quas, modi sit eligendi numquam!</p>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 mb-4">
            <div class="symptom d-flex">
              <div class="img">
                <img src="images/symptom_high-fever.png" alt="Image" class="img-fluid">
              </div>
              <div class="text">
                <h3>High Fever</h3>
                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum ipsum repellendus animi modi iure provident, cupiditate perferendis voluptatem!</p>
              </div>
            </div>
          </div>
          <div class="col-lg-6 mb-4">
            <div class="symptom d-flex">
              <div class="img">
                <img src="images/symptom_cough.png" alt="Image" class="img-fluid">
              </div>
              <div class="text">
                <h3>Cough</h3>
                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla ullam illo laborum repellendus vel esse dolor, sunt exercitationem.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-6 mb-4">
            <div class="symptom d-flex">
              <div class="img">
                <img src="images/symptom_sore-troath.png" alt="Image" class="img-fluid">
              </div>
              <div class="text">
                <h3>Sore Troath</h3>
                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum esse voluptatum, vel inventore at! Ullam, libero reiciendis amet?</p>
              </div>
            </div>
          </div>

          <div class="col-lg-6 mb-4">
            <div class="symptom d-flex">
              <div class="img">
                <img src="images/symptom_headache.png" alt="Image" class="img-fluid">
              </div>
              <div class="text">
                <h3>Headache</h3>
                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus autem voluptatem ratione veniam rerum qui quibusdam reprehenderit quis.</p>
              </div>
            </div>
          </div>
        </div>

        <div class="row justify-content-md-center">
          <div class="col-lg-10">
            <div class="note row">

              <div class="col-lg-8 mb-4 mb-lg-0"><strong>Stay at home and call your doctor:</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium, eaque.</div>
              <div class="col-lg-4 text-lg-right">
                <a href="#" class="btn btn-primary"><span class="icon-phone mr-2 mt-3"></span>Help line</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-lg-7 mx-auto text-center">
            <h2 class="mb-4 section-heading">News &amp; Articles</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex officia quas, modi sit eligendi numquam!</p>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-4">
            <div class="post-entry">
              <a href="#" class="thumb">
                <span class="date">30 Jul, 2020</span>
                <img src="images/hero_1.jpg" alt="Image" class="img-fluid">
              </a>
              <div class="post-meta text-center">
                <a href="">
                  <span class="icon-user"></span>
                  <span>Admin</span>
                </a>
                <a href="#">
                  <span class="icon-comment"></span>
                  <span>3 Comments</span>
                </a>
              </div>
              <h3><a href="#">How Coronavirus Very Contigous</a></h3>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="post-entry">
              <a href="#" class="thumb">
                <span class="date">30 Jul, 2020</span>
                <img src="images/hero_2.jpg" alt="Image" class="img-fluid">
              </a>
              <div class="post-meta text-center">
                <a href="">
                  <span class="icon-user"></span>
                  <span>Admin</span>
                </a>
                <a href="#">
                  <span class="icon-comment"></span>
                  <span>3 Comments</span>
                </a>
              </div>
              <h3><a href="#">How Coronavirus Very Contigous</a></h3>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="post-entry">
              <a href="#" class="thumb">
                <span class="date">30 Jul, 2020</span>
                <img src="images/hero_1.jpg" alt="Image" class="img-fluid">
              </a>
              <div class="post-meta text-center">
                <a href="">
                  <span class="icon-user"></span>
                  <span>Admin</span>
                </a>
                <a href="#">
                  <span class="icon-comment"></span>
                  <span>3 Comments</span>
                </a>
              </div>
              <h3><a href="#">How Coronavirus Very Contigous</a></h3>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <h2 class="footer-heading mb-4">About</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Modi cumque tenetur inventore veniam, hic vel ipsa necessitatibus ducimus architecto fugiat!</p>
            <div class="my-5">
              <a href="#" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
              <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
              <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
              <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="row">
              <div class="col-lg-4">
                <h2 class="footer-heading mb-4">Quick Links</h2>
                <ul class="list-unstyled">
                  <li><a href="#">Symptoms</a></li>
                  <li><a href="#">Prevention</a></li>
                  <li><a href="#">FAQs</a></li>
                  <li><a href="#">About Coronavirus</a></li>
                  <li><a href="#">Contact Us</a></li>
                </ul>
              </div>
              <div class="col-lg-4">
                <h2 class="footer-heading mb-4">Helpful Link</h2>
                <ul class="list-unstyled">
                  <li><a href="#">Helathcare Professional</a></li>
                  <li><a href="#">LGU Facilities</a></li>
                  <li><a href="#">Protect Your Family</a></li>
                  <li><a href="#">World Health</a></li>
                </ul>
              </div>
              <div class="col-lg-4">
                <h2 class="footer-heading mb-4">Resources</h2>
                <ul class="list-unstyled">
                  <li><a href="#">WHO Website</a></li>
                  <li><a href="#">CDC Website</a></li>
                  <li><a href="#">Gov Website</a></li>
                  <li><a href="#">DOH Website</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!--<div class="row text-center">
          <div class="col-md-12">
            <div class="border-top pt-5">
              <p class="copyright"><small>
               
                Todos los derechos reservaods | This template is made with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
               </small></p>

              </div>
            </div>

          </div>
        </div>-->
      </div>
    </div>

  </div> <!-- .site-wrap -->

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.fancybox.min.js"></script>
  <script src="js/jquery.sticky.js"></script>
  <script src="js/isotope.pkgd.min.js"></script>


  <script src="js/main.js"></script>
  <script src="js/coffee.js"></script>

<div class="modal fade" id="comenzar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="sign-up/">
          <div class="form-group">
            <input type="email" class="form-control input-lg" name="email" aria-describedby="emailHelp" autocomplete="off" placeholder="Ingresa tu correo electronico" required>
            <input type="hidden" id="usernametxt" name="usernametxt">
          </div>
          <div class="form-group">
            <input type="password" class="form-control input-lg" name="password" placeholder="Ingresa una contraseña" autocomplete="off" required> 
          </div>
          <div class="form-group text-center">
            <button type="submit" class="btn btn-dark text-center">Continuar <i class="fas fa-arrow-circle-right"></i></button>
          </div>
        </form>
        <p class="text-center">
            ¿Ya tienes cuenta? <a href="#">Inicia sesion</a>
        </p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="iniciarSesion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Entrar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="sign-in/">
          <div class="form-group">
            <input type="email" class="form-control input-lg" name="email_i" aria-describedby="emailHelp" placeholder="Ingresa tu correo electronico" required>
          </div>
          <div class="form-group">
            <input type="password" class="form-control input-lg" name="pwd_i" placeholder="Ingresa la contraseña" autocomplete="off" required> 
          </div>
          <div class="form-group text-center">
            <button type="submit" class="btn btn-dark text-center">Entrar <i class="fas fa-arrow-circle-right"></i></button>
          </div>
        </form>
        <p class="text-center">
            ¿No tienes cuenta? <a href="" onclick="openRegister();return false;">Crea una aqui <i class="far fa-smile-wink"></i></a>
        </p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="crearCuenta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="sign-up/">
          <div class="form-group">
            <div class="input-group input-focus">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-white font-weight-bold">regalameuncafe.com/</span>
                </div>
                <input type="search" placeholder="tunombre" class="form-control border-left-0" name="usernametxt" id="usernameModal" autofocus="autofocus" autocomplete="off">
            </div>
            <div class="alert alert-warning" role="alert" id="alertExistModal"><small>Este nombre de usuario ya existe :(</small></div>
          </div>
          <div class="form-group">
            <input type="email" class="form-control input-lg" name="email" aria-describedby="emailHelp" autocomplete="off" placeholder="Ingresa tu correo electronico" required>
            
          </div>
          <div class="form-group">
            <input type="password" class="form-control input-lg" name="password" placeholder="Ingresa una contraseña" autocomplete="off" required> 
          </div>
          <div class="form-group text-center">
            <button type="submit" class="btn btn-dark text-center" id="comenzarBtnModal" disabled>Continuar <i class="fas fa-arrow-circle-right"></i></button>
          </div>
        </form>
        <p class="text-center">
            ¿Ya tienes cuenta? <a href="" onclick="openInicio();return false;">Inicia sesion</a>
        </p>
      </div>
    </div>
  </div>
</div>
</body>
</html>