<?php
require_once('admin/cn.php');
session_start();

if (isset($_SESSION['uname'])) {
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
  <link rel="stylesheet" href="css/imgindex.css">

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

                <li><a href="explorar/" class="nav-link">Explora creadores</a></li>
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
                <span class="input-group-text bg-white font-weight-bold phoneStyling">regalameuncafe.com/</span>
              </div>
              <input type="search" placeholder="tunombre" class="form-control border-left-0 phoneStylingInput" name="username" id="username" autofocus="autofocus" autocomplete="off">
              <div class="input-group-append">
                <button class="btn btn-primary btn-outline-white phoneStylingBtn" type="button" id="comenzarBtn" data-toggle="modal" data-target="#comenzar" disabled>Empezar <i class="fas fa-play"></i></button>
              </div>
            </div>
            <div id="uname_response"></div>
            <div class="alert alert-danger" role="alert" id="alertExist"><small>Este nombre de usuario ya existe :(</small></div>
            <small id="emailHelp" class="form-text text-muted">Es gratis y toma menos de un minuto</small>
            </p>
            <img src="images/creator.png" alt="Image" class="img-fluid" id="img-phone" width="420">


          </div>
          <div class="col-lg-6">
            <figure class="illustration">
              <img src="images/creator.png" alt="Image" class="img-fluid" id="imgChangeBorder">
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
            <p>Comparte contenido exclusivo o simplemente brinda una forma de respaldar tu trabajo. Con solo un par de clicks, tus fans pueden comprarte un café, comprarte una membresia a tus "close friends" en instagram, comprar un e-book, etc, mas aparte dejar un mensaje. <span class="font-weight-bold"><u>Ni siquiera tienen que crear una cuenta.</u></span></p>
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

    <div class="site-section bg-primary-light">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">

            <div class="row">
              <div class="col-6 col-lg-6 mt-lg-5">
                <div class="media-v1 bg-1">
                  <img src="images/instagramCreator.png" class="img-fluid">
                  <!--<div class="body">
                    <h3>Stay at home</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio, debitis!</p>
                  </div>-->
                </div>
                <div class="media-v1 bg-1">
                  <img src="images/githubCreator.png" class="img-fluid">
                </div>

              </div>
              <div class="col-6 col-lg-6">
                <div class="media-v1 bg-1">
                  <img src="images/youtubeCreator.png" class="img-fluid">
                </div>
                <div class="media-v1 bg-1">
                  <img src="images/facebookCreator.png" class="img-fluid">
                </div>
              </div>

            </div>
          </div>
          <div class="col-lg-5 ml-auto">
            <h2 class="section-heading mb-4">Incluye tu link en todos lados</h2>
            <p>Dale la oportunidad a tu audiencia de agradecerte en todos lados, en todos los sitios donde tienes presencia.</p>
            <ul class="list-check list-unstyled mb-5">
              <li>Simple</li>
              <li>Rapido</li>
              <li>Ergonomico en User Experience</li>
            </ul>

            <p><a data-toggle="modal" href="" data-target="#iniciarSesion" class="btn btn-primary">Entrar</a> <a data-toggle="modal" href="" data-target="#crearCuenta" class="btn btn-primary">Registrate</a></p>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section bg-primary-light">
      <div class="container">
        <div class="row mb-5">
          <div class="col-lg-7 mx-auto text-center">
            <span class="subheading">Eleva tus ingresos</span>
            <h2 class="mb-4 section-heading">Incluye Extras, la forma creativa de vender y ofrecer mas de tu servicios</h2>
            <p>Como por ejemplo:</p>
          </div>
        </div>


        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="row">
                <div class="col-lg-6 mb-4">
                  <div class="symptom d-flex">

                    <div class="text">

                      <p>
                      <h3><i class="fas fa-gifts"></i> Consultas 1:1</h3>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="symptom d-flex">

                    <div class="text">

                      <p>
                      <h3><i class="fas fa-gifts"></i> Acceso a tus close friends con subscripcion por mes</h3>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="symptom d-flex">

                    <div class="text">

                      <p>
                      <h3><i class="fas fa-gifts"></i> Acceso a un grupo privado de Wtsp/Telegram</h3>
                      </p>
                    </div>
                  </div>
                </div>

                <div class="col-lg-6 mb-4">
                  <div class="symptom d-flex">

                    <div class="text">

                      <p>
                      <h3><i class="fas fa-gifts"></i> Vender playeras</h3>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="row">
                <div class="col-lg-6 mb-4">
                  <div class="symptom d-flex">

                    <div class="text">

                      <p>
                      <h3><i class="fas fa-gifts"></i> Post en twitter</h3>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="symptom d-flex">

                    <div class="text">

                      <p>
                      <h3><i class="fas fa-gifts"></i> Story en instagram</h3>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="symptom d-flex">

                    <div class="text">

                      <p>
                      <h3><i class="fas fa-gifts"></i> Ebooks</h3>
                      </p>
                    </div>
                  </div>
                </div>

                <div class="col-lg-6 mb-4">
                  <div class="symptom d-flex">

                    <div class="text">

                      <p>
                      <h3 class="text-danger">Y lo que a ti se te ocurra...</h3>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

        <!--<div class="row justify-content-md-center">
            <p>
              <a href="#" class="btn btn-primary">Entrar</a>
            </p>
        </div>-->
      </div>
    </div>


    <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-lg-7 mx-auto text-center">
            <h2 class="mb-4 section-heading">De creadores para creadores</h2>
            <h3>Hecho con <i class="icon-heart text-danger" aria-hidden="true"></i> para Mexico y Latinoamerica.</h3><br>
            <div class="img-blur">
              <img src="https://media.giphy.com/media/yoJC2El7xJkYCadlWE/giphy.gif" class="img-fluid" id='movieImg' alt="Para ti">
            </div>
            <br>

            <p><a data-toggle="modal" href="" data-target="#crearCuenta" class="btn btn-primary btn-sm">Comenzar mi pagina</a></p>
          </div>
        </div>
      </div>
    </div>

    <div class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <h2 class="footer-heading mb-4">Escribenos:</h2>
            <p><a href="mailto:dihola@regalameuncafe.com">dihola@regalameuncafe.com</a></p>
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
                &nbsp;
              </div>
              <div class="col-lg-4">
                &nbsp;
              </div>
              <div class="col-lg-4">
                <h2 class="footer-heading mb-4"></h2>
                <ul class="list-unstyled">
                  <li><a href="#">Terminos y condiciones</a></li>
                  <li><a href="#">Politicas de privacidad</a></li>
                  <li><a href="#">Empleo</a></li>
                  <li><a href="#">FAQ</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="row text-center">
          <div class="col-md-12">
            <div class="border-top pt-5">


            </div>
          </div>

        </div>
      </div>
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
  <script src="js/imgindex.js"></script>
  <script type="text/javascript">
    function openPasswordForgotten() {
      $('#iniciarSesion').modal('hide');
      $('#contrasenaOlvidada').modal('show');
    }
  </script>

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
              <button class="btn btn-link btn-sm" onclick="openPasswordForgotten()">¿Olvidaste la contraseña?</button>
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

  <div class="modal fade" id="contrasenaOlvidada" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿Olvidaste tu contraseña?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="olvidemicontrasena/">
            <div class="form-group">
              <label for="exampleInputEmail1">Escribe el correo electronico con el que te registraste:</label>
              <input type="email" class="form-control" id="exampleInputEmail1" name="email_o" aria-describedby="emailHelp" placeholder="" required>
            </div>
            <div class="form-group text-center">
              <button type="submit" class="btn btn-dark btn-sm">Continuar <i class="fas fa-arrow-circle-right"></i></button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
</body>

</html>