<!doctype html>
<html lang="en">

<head>
    <title>Regalame un Cafe</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="fonts/flaticon-covid/font/flaticon.css">
    <link rel="stylesheet" href="css/imgindex.css">
    <link rel="stylesheet" href="css/imageMain.css">
    <link rel="stylesheet" href="css/index.css">
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

<body class="App">

    <div class="content">

        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a href="../" class="navbar-brand"><img class="img-fluid" width="200" src="images/logo.png" alt="regalameuncafe.com"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <?php
                    if (isset($_SESSION["user_param"])) {
                    ?>
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <?php
                            if ($_SESSION["utype"] != "2") {
                                echo '<li class="nav-item"><a href="../mipagina/" class="nav-link itemActive" id="navInicio"><i class="fas fa-chart-line"></i> Analytics</a></li>
                  <li class="nav-item"><a href="../misfans/" class="nav-link itemActive" id="navFans"><i class="fas fa-grin-hearts"></i> Mis Fans</a></li>
                  <li class="nav-item"><a href="../misextras/" class="nav-link itemActive" id="navExtras"><i class="fas fa-gifts"></i> Extras</a></li>
                  <li class="nav-item"><a href="../misposts/" class="nav-link itemActive" id="navPosts"><i class="far fa-newspaper"></i> Posts</a></li>
                  <li class="nav-item"><a href="../comolovemifan/" class="nav-link itemActive" id="navPagina"><i class="fas fa-address-card"></i> Pagina</a></li>';
                            } else {
                                echo '<li class="nav-item"><a href="../explorar/" class="nav-link itemActive" id="navExplorar"><i class="fas fa-hat-wizard"></i> Explorar creadores</a></li>
                  <li class="nav-item"><a data-toggle="modal" href="" data-target="#crearCuentaCreador" class="nav-link itemActive" id="navFans"><i class="fas fa-magic"></i> Crear cuenta de creador</a></li>
                 ';
                            }
                            ?>
                            <li class="nav-item dropdown">
                                <div class="dropstart">
                                    <a class="nav-link dropdown-toggle itemActive" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-user-astronaut"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <?php
                                        if ($_SESSION["utype"] != "2") {
                                            echo '<li><a href="../micuenta/" class="dropdown-item">Mi cuenta</a></li>';
                                        } else {
                                            echo '<li><a href="../perfil/" class="dropdown-item">Mi cuenta</a></li>';
                                        }
                                        ?>
                                        <li><a href="../explorar/" class="dropdown-item">Apoyo a creadores</a></li>
                                        <?php
                                        if ($_SESSION["utype"] != "2") {
                                            $sqlp = "SELECT a.id_payments, a.id_extra, a.amount, a.amount_fee, a.amount_tax FROM payments as a INNER JOIN extras as b on a.id_extra=b.id_extra WHERE a.id_user=" . $_SESSION["user_param"] . " and a.status='completed'";
                                            $resultp = $conn->query($sqlp);

                                            if ($resultp->num_rows > 0) {
                                                echo '<li><a href="../mispagos/" class="dropdown-item">Mis pagos</a></li>';
                                            } else {
                                                echo '<li><a href="../mispagos/" class="dropdown-item disabled">Mis pagos</a></li>';
                                            }
                                        }
                                        ?>
                                        <li><a class="dropdown-item" href="../houstontenemosproblemas/"><i class="fas fa-tools fa-sm"></i> Soporte</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="../adios/"><i class="fas fa-toggle-off fa-sm"></i> Salir</a></a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    <?php
                    } else {
                    ?>
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item"><a href="explorar/" class="nav-link">Explora creadores</a></li>
                            <li class="nav-item">
                                <a class="nav-link border border-primary rounded p-2" data-bs-toggle="modal" href="#iniciarSesion" role="button">Entrar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="modal" href="#crearCuenta" role="button">Registrate <i class="fas fa-arrow-circle-right text-primary"></i></a>
                            </li>
                        </ul>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </nav>

        <main>
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

                                            <button type="button" class="btn btn-primary btn-outline-white phoneStylingBtn" id="comenzarBtn" data-bs-toggle="modal" data-bs-target="#comenzar" disabled>Empezar <i class="fas fa-play"></i></button>

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
                                el mundo.
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <img class="imgFullWidth" src="./images/creativity.png"></img>
        </main>

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

    <div class="modal fade" id="comenzar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="sign-up/">
                        <div class="form-group">
                            <input type="email" class="form-control input-lg" name="email" aria-describedby="emailHelp" autocomplete="off" placeholder="Ingresa tu correo electronico" required>
                            <input type="hidden" id="usernametxt" name="usernametxt">
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" class="form-control input-lg" name="password" placeholder="Ingresa una contraseña" autocomplete="off" required>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-dark text-center">Continuar <i class="fas fa-arrow-circle-right"></i></button>
                        </div>
                    </form>
                    <p class="text-center">
                        ¿Ya tienes cuenta?<button class="btn btn-link" data-bs-target="#iniciarSesion" data-bs-toggle="modal" data-bs-dismiss="modal">Inicia sesion</button>
                    </p>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="iniciarSesion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Entrar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="sign-in/">
                        <div class="form-group">
                            <input type="email" class="form-control input-lg" name="email_i" aria-describedby="emailHelp" placeholder="Ingresa tu correo electronico" required>
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" class="form-control input-lg" name="pwd_i" placeholder="Ingresa la contraseña" autocomplete="off" required>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-link btn-sm" data-bs-target="#contrasenaOlvidada" data-bs-toggle="modal" data-bs-dismiss="modal">¿Olvidaste la contraseña?</button>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-dark text-center">Entrar <i class="fas fa-arrow-circle-right"></i></button>
                        </div>
                    </form>
                    <p class="text-center">
                        ¿No tienes cuenta?<button class="btn btn-link" data-bs-target="#crearCuenta" data-bs-toggle="modal" data-bs-dismiss="modal">Crea una aqui <i class="far fa-smile-wink"></i></button>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="crearCuenta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="sign-up/">
                        <div class="form-group mb-2">
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
                        <div class="form-group mb-3">
                            <input type="password" class="form-control input-lg" name="password" placeholder="Ingresa una contraseña" autocomplete="off" required>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-dark text-center" id="comenzarBtnModal" disabled>Continuar <i class="fas fa-arrow-circle-right"></i></button>
                        </div>
                    </form>
                    <p class="text-center">
                        ¿Ya tienes cuenta?<button class="btn btn-link" data-bs-target="#iniciarSesion" data-bs-toggle="modal" data-bs-dismiss="modal">Inicia sesion</button>
                    </p>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="contrasenaOlvidada" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Olvidaste tu contraseña?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="olvidemicontrasena/">
                        <div class="form-group mb-3">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="js/coffee.js"></script>
    <script src="js/imgindex.js"></script>
</body>

</html>