<?php

require_once('../admin/header.php');
if ($_SESSION["utype"] == "2") {
  echo ("<SCRIPT LANGUAGE='JavaScript'>
  window.location.href='../misapoyos/';
  </SCRIPT>");
}
?>
<script src="https://cdn.jsdelivr.net/gh/google/code-prettify@master/loader/run_prettify.js"></script>
<div class="site-section bg-primary-light">
  <div class="container">
    <div class="row py-5">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="container">
              <div class="row">
                <div class="col-sm-4 align-items-center justify-content-center">
                  <?php
                  $idUser = $_SESSION["user_param"];
                  $sql = "SELECT COUNT(a.id_payments) as 'cafes' FROM payments as a INNER JOIN extras as b on a.id_extra=b.id_extra WHERE a.id_user=" . $idUser . " and b.active=4 and a.status='completed'";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                      $countCoffe = $row["cafes"];
                    }
                    echo '<div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                                  <div class="card-body">
                                    <h5 class="card-title text-white">Nuevos Cafes<i class="fas fa-mug-hot text-white float-right"></i></h5>
                                    <p class="card-text">
                                      <span class="fa-stack">
                                          <span class="fa fa-circle fa-stack-2x"></span>
                                          <strong class="fa-stack-1x text-dark">
                                              ' . $countCoffe . '    
                                          </strong>
                                      </span>
                                      <a href="../misfans/" class="btn btn-white btn-sm p-1 mt-1 float-right">Ver mas</a>
                                    </p>
                                  </div>
                                </div>';
                  } else { ?>
                    <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                      <div class="card-body">
                        <h5 class="card-title text-white">Comparte tu link<i class="fas fa-mug-hot text-white float-right"></i></h5>
                        <p class="card-text">
                          <button class="btn btn-white btn-sm p-1 mt-1 float-right" onclick="copyLinkToClipboard('#linkToCopy')"><i class="fas fa-clone"></i> Copiar link</button>
                        </p>
                      </div>
                    </div>
                  <?php
                  }
                  ?>
                  <hr>
                  <?php
                  $sql2 = "SELECT a.id_payments, b.title, COUNT(b.id_extra) as 'cafes' FROM payments as a INNER JOIN extras as b on a.id_extra=b.id_extra WHERE a.id_user=" . $idUser . " and b.active<>2 and b.active<>0 and a.status='completed' GROUP BY b.id_extra ORDER BY cafes DESC LIMIT 3";
                  $result2 = $conn->query($sql2);

                  if ($result2->num_rows > 0) {
                    // output data of each row
                    while ($row2 = $result2->fetch_assoc()) {
                      echo '<div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                                    <div class="card-body">
                                      <h6 class="card-title text-white">' . $row2["title"] . ' <i class="fas fa-gifts fa-xs text-white float-right"></i></h6>
                                      <p class="card-text">
                                        <span class="fa-stack">
                                            <span class="fa fa-circle fa-stack-2x"></span>
                                            <strong class="fa-stack-1x text-dark">
                                            ' . $row2["cafes"] . '   
                                            </strong>
                                        </span>
                                        <a href="../misfans/" class="btn btn-white btn-sm p-1 mt-1 float-right">Ver mas</a>
                                      </p>
                                    </div>
                                  </div>';
                    }
                  } else {
                    echo '<div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                                    <div class="card-body">
                                      <h6 class="card-title text-white">Agrega un extra<i class="fas fa-gifts text-white float-right"></i></h6>
                                      <p class="card-text">
                                        
                                        <a href="../misextras/" class="btn btn-white btn-sm p-1 mt-1 float-right">Agregar</a>
                                      </p>
                                    </div>
                                  </div>';
                  }
                  ?>
                  <a href="../misfans/" class="btn btn-primary">Ver todo</a>
                </div>
                <div class="col-sm-8 d-flex align-items-center justify-content-center">
                  <canvas id="examChart" width="400" height="330"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <p></p>
    <h2>Agrega un boton en tu git, pagina, blog, etc.</h2>
    <div class="row pb-5" id="generarBoton">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="row">

              <div class="col-sm-6 d-flex align-items-center justify-content-center">
                <iframe id="FileFrame" src="about:blank" width="280" height="50" scrolling="no" frameBorder="0"></iframe>
                <script src="../developers/create.button.min.js"></script>
              </div>
              <div class="col-sm-6 bg-light">
                <pre class="prettyprint" id="p1">
  <xmp>
<script src="../developers/create.button.min.js"></script><iframe 
id="FileFrame" src="about:blank" width="280" height="50" scrolling="no" 
frameBorder="0"></iframe>
  </xmp>
</pre>
                <button class="btn btn-primary" onclick="copyToClipboard('#p1')" id="tt" data-clipboard-text="1"><i class="fas fa-clone"></i> Copiar</button>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
<?php
require_once('../admin/footer.php');
$session_value = basename(dirname(__FILE__));
$conn->close();
?>
<script type="text/javascript">
  var myTitle = '<?php echo $session_value; ?>';
  document.title = 'Regalame un Cafe';

  activateNavbarItem("navInicio");
</script>
<script src="../js/coffeeChart.js"></script>