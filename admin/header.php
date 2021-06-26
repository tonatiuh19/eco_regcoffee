<?php
require_once('cn.php');
if (!isset($_SESSION)) {
  session_start();
}
?>
<!doctype html>
<html lang="en">

<head>
  <title>Regalame un Cafe</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;700;900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="../fonts/icomoon/style.css">

  <link rel="stylesheet" href="../css/bootstrap.min.css">

  <link rel="stylesheet" href="../css/jquery.fancybox.min.css">

  <link rel="stylesheet" href="../fonts/flaticon/font/flaticon.css">
  <link rel="stylesheet" href="../fonts/flaticon-covid/font/flaticon.css">

  <link rel="stylesheet" href="../css/style.css">
  <link href="../css/fontawesome/css/all.css" rel="stylesheet">
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">
  <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js"></script>
</head>

<body class="App">


  <div class="content">

    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a href="../" class="navbar-brand"><img class="img-fluid" width="200" src="../images/logo.png" alt="regalameuncafe.com"></a>
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
                  <a class="nav-link dropdown-toggle itemActive" href="#" id="navAstronaut" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
              <li class="nav-item"><a href="../explorar/" class="nav-link">Explora creadores</a></li>
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
    <?php
    if (isset($_SESSION["user_param"])) {
      $sql = "SELECT a.id_users_payment FROM users_payment as a WHERE a.id_user=" . $_SESSION["user_param"] . "";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        $sqlc = "SELECT a.id_user,
        MAX(CASE WHEN a.id_categories = 1 THEN 1 ELSE 0 END) Video,
        MAX(CASE WHEN a.id_categories = 2 THEN 1 ELSE 0 END) Writter,
        MAX(CASE WHEN a.id_categories = 3 THEN 1 ELSE 0 END) Developer,
        MAX(CASE WHEN a.id_categories = 4 THEN 1 ELSE 0 END) Podcaster,
        MAX(CASE WHEN a.id_categories = 5 THEN 1 ELSE 0 END) Artist,
        MAX(CASE WHEN a.id_categories = 6 THEN 1 ELSE 0 END) Influencer,
        MAX(CASE WHEN a.id_categories = 7 THEN 1 ELSE 0 END) Other
      FROM users_categories as a
      WHERE a.active=1 AND a.id_user=" . $_SESSION["user_param"] . "
      GROUP BY a.id_user";
        $resultc = $conn->query($sqlc);

        if (!($resultc->num_rows > 0)) {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Registra una o mas categorias para que tus nuevos fans puedan ver a que te dedicas. <a href="../material/">Ir a perfil <i class="fas fa-arrow-circle-right"></i></a></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        }
      } else {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Es necesario captures tu cuenta Paypal o Clabe interbancaria para incluirte tu dinero. <a href="../micuenta/">Ir a perfil <i class="fas fa-arrow-circle-right"></i></a></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }
    }
    ?>
    <main>