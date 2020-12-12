<?php
require_once('cn.php');
if(!isset($_SESSION)) 
{ 
  session_start(); 
} 
if(!isset($_SESSION["user_param"])) 
{
	echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.location.href='../';
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

  <link rel="stylesheet" href="../fonts/icomoon/style.css">

  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/jquery-ui.css">
  <link rel="stylesheet" href="../css/owl.carousel.min.css">
  <link rel="stylesheet" href="../css/owl.theme.default.min.css">
  <link rel="stylesheet" href="../css/owl.theme.default.min.css">

  <link rel="stylesheet" href="../css/jquery.fancybox.min.css">

  <link rel="stylesheet" href="../css/bootstrap-datepicker.css">

  <link rel="stylesheet" href="../fonts/flaticon/font/flaticon.css">
  <link rel="stylesheet" href="../fonts/flaticon-covid/font/flaticon.css">

  <link rel="stylesheet" href="../css/aos.css">

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
            <div class="mb-0 site-logo"><a href="../" class="mb-0"><img class="img-fluid" src="../images/logo.png" alt="regalameuncafe.com"></a></div>
          </div>

          <div class="col-12 col-md-10 d-none d-xl-block">
            <nav class="site-navigation position-relative text-right" role="navigation">

              <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                <li><a href="../mipagina/" class="nav-link itemActive" id="navInicio"><i class="fas fa-hat-wizard"></i> Inicio</a></li>
                
                <li><a href="../misfans/" class="nav-link itemActive" id="navFans"><i class="fas fa-grin-hearts"></i> Mis Fans</a></li>
                <li><a href="../misextras/" class="nav-link itemActive" id="navExtras"><i class="fas fa-gifts"></i> Extras</a></li>


                <li><a href="../misposts/" class="nav-link itemActive" id="navPosts"><i class="far fa-newspaper"></i> Posts</a></li>
                <li><a href="../comolovemifan/" class="nav-link itemActive" id="navPagina"><i class="fas fa-address-card"></i> Pagina</a></li>
                <li class="has-children active">
                  <a href="#" class="nav-link itemActive" id="navAstronaut"><i class="fas fa-user-astronaut"></i></a>
                  <ul class="dropdown">
                    <li><a href="../micuenta/" class="nav-link">Mi cuenta</a></li>
                    <li><a href="../explorar/" class="nav-link">Apoyo a creadores</a></li>
                    <?php
                    $sqlp = "SELECT a.id_payments, a.id_extra, a.amount, a.amount_fee, a.amount_tax FROM payments as a INNER JOIN extras as b on a.id_extra=b.id_extra WHERE a.id_user=".$_SESSION["user_param"]." and a.status='completed'";
                    $resultp = $conn->query($sqlp);
                    
                    if ($resultp->num_rows > 0) {
                      echo '<li><a href="../mispagos/" class="nav-link">Mis pagos</a></li>';
                    } else {
                      echo '<li><a href="../mispagos/" class="nav-link disabled">Mis pagos</a></li>';
                    }
                    ?>
                    <li><a href="../houstontenemosproblemas/" class="nav-link"><i class="fas fa-tools fa-sm"></i> Soporte</a></li>
                    <li><a href="../adios/" class="nav-link"><i class="fas fa-toggle-off fa-sm"></i> Salir</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>


          <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle float-right"><span class="icon-menu h3 text-black"></span></a></div>

        </div>
      </div>

    </header>