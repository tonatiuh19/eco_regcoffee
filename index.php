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

  <link rel="stylesheet" href="css/imgindex.css">

  <link rel="stylesheet" href="css/imageMain.css">
  <link rel="stylesheet" href="css/index.css">

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

    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a href="../" class="navbar-brand"><img class="img-fluid" width="200" src="images/logo.png" alt="regalameuncafe.com"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item"><a href="explorar/" class="nav-link">Explora creadores</a></li>
            <li class="nav-item"><a data-toggle="modal" href="" data-target="#iniciarSesion" class="nav-link border border-primary rounded p-2">Entrar</a></li>
            <li class="nav-item"><a data-toggle="modal" href="" data-target="#crearCuenta" class="nav-link">Registrate <i class="fas fa-arrow-circle-right text-primary"></i></a></li>
          </ul>
        </div>
      </div>
    </nav>




    <div class="py-5">
      <div class="container pt-5">
        <div class="row ">
          <div class="col-sm-7">
            <div class="container">
              <div class="row">
                <div class="col-sm">
                  <h3>A tus fans les va encantar</h3>
                </div>
              </div>
              <div class="row">
                <div class="col-sm">
                  <h1 class="fw-bolder">
                    Forma sencilla y significativa de financiar tu trabajo
                    creativo
                  </h1>
                </div>
              </div>
              <div class="row pt-4">
                <div class="col-sm">
                  <h5>
                    Puedes aceptar apoyo de tus membresías, webinars, zooms,
                    recibir un cafe, etc. Poder construir una relación directa
                    con tus fans.
                  </h5>
                </div>
              </div>
              <div class="row">
                <div class="col-sm">
                  <div class="input-group">
                    <div class="input-group-text">
                      regalameuncafe.com/
                    </div>

                    <input type="search" placeholder="tunombre" class="form-control border-left-0 phoneStylingInput" name="username" id="username" autofocus="autofocus" autocomplete="off">
                    <button class="btn btn-primary btn-outline-white phoneStylingBtn" type="button" id="comenzarBtn" data-toggle="modal" data-target="#comenzar" disabled>Empezar <i class="fas fa-play"></i></button>
                  </div>
                  <p class="fs-6 fw-light mt-1">
                    Es gratis y toma menos de un minuto.
                  <div class="badge bg-danger text-wrap" id="alertExist">
                    El nombre de usuario ya existe
                    <ImSad2 />
                  </div>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-5">
            <img src="images/creator.png" class="img-fluid vert-move" />
          </div>
        </div>
      </div>
    </div>

    <div class="bg-light py-5">
      <div class="container py-5">
        <div class="row">
          <div class="col-sm text-center">
            <span class="fas fa-magic"></span>
            <h4 class="fw-bolder">Control total</h4>
            <h5 class="fs-5 pt-2">
              Tienes el 100% de propiedad de tus seguidores. Nunca les
              enviamos correos electrónicos y puede exportar la lista cuando
              lo desees.
            </h5>
          </div>
          <div class="col-sm text-center">
            <span class="fas fa-users"></span>
            <h4 class="fw-bolder">Conciente a los tuyos</h4>
            <h5 class="fs-5 pt-2">
              Comienza una suscripción para tus fans. material exclusivo,
              apoyo mensual, acceso a código, etc.
            </h5>
          </div>
          <div class="col-sm text-center">
            <span class="fas fa-heart"></span>
            <h4 class="fw-bolder">Servicio insuperable</h4>
            <h5 class="fs-5 pt-2">
              Puedes hablar siempre con un humano para que te ayude, o si solo
              quieres un consejo para arrancar a toda velocidad.
            </h5>
          </div>
        </div>
      </div>
    </div>
    <div class="py-5 bg-dark text-white">
      <div class="container">
        <div class="row text-center">
          <div class="col-sm">
            <FaHeartbeat fontSize="4.5em" />
            <h2 class="fw-bolder py-3">
              Dale a tu audiencia una forma fácil de agradecer
            </h2>

            <h5 class="px-5 fs-5">
              Brinda una forma de respaldar tu trabajo. Con solo un par de
              clicks, tus fans pueden apoyar tu creatividad, mas aparte dejar
              un mensaje.
              <p class="fw-bolder">
                Ni siquiera tienen que crear una cuenta.
              </p>
            </h5>
          </div>
        </div>
      </div>
    </div>

    <div class="bg-light py-5">
      <div class="container py-5">
        <div class="row ">
          <div class="flex-container">
            <div class="flex-items col-sm-7">
              <div class="container">
                <div class="row">
                  <div class="col-sm">
                    <img src="./images/link_facebook.png" class="img-thumbnail border border-dark" />
                  </div>
                  <div class="col-sm">
                    <img src="./images/link_instagram.png" class="img-thumbnail border border-dark" />
                  </div>
                  <div class="col-sm">
                    <img src="./images/link_instagram.png" class="img-thumbnail border border-dark" />
                  </div>
                </div>
              </div>
            </div>
            <div class="flex-items col-sm-5">
              <h2 class="fw-bolder pt-3">
                Incluye tu link en todas partes
              </h2>
              <h5 class="fs-5 py-3">
                Dale la oportunidad a tu audiencia de agradecerte en todos
                lados, en todos los sitios donde tienes presencia.
              </h5>
              <div class="list-group bg-light">
                <h5 class="fw-bolder">
                  <i class="fas fa-arrow-alt-circle-right"></i> Simple
                </h5>
                <h5 class="fw-bolder">
                  <i class="fas fa-arrow-alt-circle-right"></i> Rapido
                </h5>
                <h5 class="fw-bolder">
                  <i class="fas fa-arrow-alt-circle-right"></i> Ergonomico UI/UX
                </h5>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row text-center">
          <div class="col-sm">
            <h2 class="fw-bolder py-3">Donde mas lo necesites</h2>
          </div>
        </div>
        <div class="row text-center">
          <div class=" col-sm-4"></div>
          <div class="col-sm-4 ">
            <div class="slider bg-light">
              <div class="slide-track">
                <div class="slide">
                  <i class="fab fa-facebook fa-5x"></i>
                </div>
                <div class="slide">
                  <i class="fab fa-instagram fa-5x"></i>
                </div>
                <div class="slide">
                  <i class="fab fa-github fa-5x"></i>
                </div>
                <div class="slide">
                  <i class="fab fa-youtube fa-5x"></i>
                </div>
                <div class="slide">
                  <i class="fab fa-dailymotion fa-5x"></i>
                </div>
                <div class="slide">
                  <i class="fab fa-google fa-5x"></i>
                </div>
                <div class="slide">
                  <i class="fas fa-podcast fa-5x"></i>
                </div>
                <div class="slide">
                  <i class="fab fa-spotify fa-5x"></i>
                </div>
                <div class="slide">
                  <i class="fab fa-tiktok fa-5x"></i>
                </div>
                <div class="slide">
                  <i class="fab fa-bitbucket fa-5x"></i>
                </div>
                <div class="slide">
                  <i class="fab fa-facebook fa-5x"></i>
                </div>
                <div class="slide">
                  <i class="fab fa-instagram fa-5x"></i>
                </div>
                <div class="slide">
                  <i class="fab fa-github fa-5x"></i>
                </div>
                <div class="slide">
                  <i class="fab fa-youtube fa-5x"></i>
                </div>
                <div class="slide">
                  <i class="fab fa-dailymotion fa-5x"></i>
                </div>
                <div class="slide">
                  <i class="fab fa-google fa-5x"></i>
                </div>
                <div class="slide">
                  <i class="fas fa-podcast fa-5x"></i>
                </div>
                <div class="slide">
                  <i class="fab fa-spotify fa-5x"></i>
                </div>
                <div class="slide">
                  <i class="fab fa-tiktok fa-5x"></i>
                </div>
                <div class="slide">
                  <i class="fab fa-bitbucket fa-5x"></i>
                </div>
                <div class="slide">
                  <i class="fab fa-facebook fa-5x"></i>
                </div>
                <div class="slide">
                  <i class="fab fa-instagram fa-5x"></i>
                </div>
                <div class="slide">
                  <i class="fab fa-github fa-5x"></i>
                </div>
                <div class="slide">
                  <i class="fab fa-youtube fa-5x"></i>
                </div>
                <div class="slide">
                  <i class="fab fa-dailymotion fa-5x"></i>
                </div>
                <div class="slide">
                  <i class="fab fa-google fa-5x"></i>
                </div>
                <div class="slide">
                  <i class="fas fa-podcast fa-5x"></i>
                </div>
                <div class="slide">
                  <i class="fab fa-spotify fa-5x"></i>
                </div>
                <div class="slide">
                  <i class="fab fa-tiktok fa-5x"></i>
                </div>
                <div class="slide">
                  <i class="fab fa-bitbucket fa-5x"></i>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-4"></div>
        </div>
      </div>
    </div>

    <div class="bg-dark text-white py-5">
      <div class="container py-5">
        <div class="row text-center">
          <div class="col-sm-12">
            <h5 class="fs-5">Eleva tus ingresos</h5>
            <h2 class="fw-bolder">
              Incluye Extras, la forma creativa de vender y ofrecer mas de tu
              servicios
            </h2>
          </div>
        </div>
        <div class="row text-center">
          <h5 class="fs-5 ">Como por ejemplo:</h5>
          <div class="row row-cols-1 row-cols-md-2 g-4 text-dark text-start mt-n3">
            <div class="col">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title fw-bolder">
                    <i class="fas fa-arrow-alt-circle-right"></i> Consulta 1:1
                  </h6>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title fw-bolder">
                    <i class="fas fa-arrow-alt-circle-right"></i> Acceso a tus close friends con
                    subscripcion por mes
                  </h6>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title fw-bolder">
                    <i class="fas fa-arrow-alt-circle-right"></i> Acceso a un grupo privado de
                    Wtsp/Telegram
                  </h6>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title fw-bolder">
                    <i class="fas fa-arrow-alt-circle-right"></i> Post en twitter
                  </h6>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title fw-bolder">
                    <i class="fas fa-arrow-alt-circle-right"></i> Story en instagram
                  </h6>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title fw-bolder">
                    <i class="fas fa-arrow-alt-circle-right"></i> Ebooks
                  </h6>
                </div>
              </div>
            </div>
          </div>
          <div class="row row-cols-1 row-cols-md g-4 text-dark">
            <div class="col">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title fw-bolder">
                    <i class="fas fa-arrow-alt-circle-right"></i> Y lo que a ti se te ocurra...
                  </h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="bg-light py-5">
      <div class="container py-5">
        <div class="row text-center">
          <div class="col-sm">
            <h2 class="fw-bolder">De creadores para creadores</h2>
          </div>
        </div>
        <div class="row text-center">
          <div class="col-sm">
            <h2>
              Hecho con
              <i class="fas fa-heart text-danger"></i> para México y
              Latinoamerica.
            </h2>
          </div>
        </div>
      </div>
    </div>
    <img class="imgFullWidth" src="./images/creativity.png"></img>


  </div>

  <footer class="footer mt-auto py-3 bg-dark text-white">
    <div class="container">
      <div class="row">
        <div class="flex-container-s">
          <div class="flex-items-s col-sm">
            <div class="col-sm">
              <h5 class="fs-5">Escribenos:</h5>
            </div>
            <a href="#" class="btn btn-outline-light">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="btn btn-outline-light">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="#" class="btn btn-outline-light">
              <i class="far fa-envelope-open"></i>
            </a>
          </div>
          <div class="flex-items-s">
            <div class="row">
              <a class="btn btn-link text-white" href="#">
                Terminos y condiciones
              </a>
            </div>
            <div class="row">
              <a class="btn btn-link text-white" href="#">
                Aviso de privacidad
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
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